<?php
session_start();

function cleanCookie() {
    setcookie("std_id", $_COOKIE["std_id"], time() - 14400, '/');
    setcookie("name", $_COOKIE["name"], time() - 14400, '/');
    setcookie("class", $_COOKIE["class"], time() - 14400, '/');
}

if (isset($_COOKIE["std_id"])) {
    if (isset($_SESSION[$_COOKIE["std_id"]]) && $_SESSION[$_COOKIE["std_id"]] === true) {
        if (isset($_GET["logout"])) {
            cleanCookie();
            unset($_SESSION[$_COOKIE["std_id"]]);
        } else {
            header("Location: /");
        }
    } else {
        cleanCookie();
    }
}
?>
<!DOCTYPE html>
<html lang="zh_CH">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>英语练习系统</title>
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/5.1.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container" style="max-width: 20em;margin-top: 10em;">
        <form action="login.php" method="POST">
            <div class="input-group mb-3">
                <span class="input-group-text">Class</span>
                <select class="form-select" name="class">
                    <option>class_21s00_jsj</option>
                    <option>class_21s01_jsj</option>
                </select>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text">Std ID</span>
                <input type="text" name="username" class="form-control" placeholder="Your student id">
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text">Passwd</span>
                <input type="password" name="password" class="form-control" placeholder="Your account password">
            </div>
            <p style="color: #afafaf;">You can directly login if you without a password.</p>
            <button type="submit" name="submit" class="btn btn-primary" style="float: right;">Login</button>
        </form>
    </div>
</body>
</html>
<?php
class StdDB extends SQLite3 {
    function __construct() {
        $this->open('../db/api_stdinfo.db');
    }
}

$db = new StdDB();

if (!isset($_POST["submit"])) { exit(); }
// foreach ($_POST as $key => $value) {
//     $posts[$key] = trim($value);
// }

$username = $_POST["username"];
$password = md5($_POST["password"]);
$class = $_POST["class"];
echo $class;

$query = "SELECT std_id, name, class FROM `$class` WHERE passwd = '$password' AND std_id = '$username'";

if ($db->query($query)) {
    $ret = $db->query($query);
} else {
    $error = 'Std ID Error.';
    exit();
}

if (3 === $ret->numColumns()) {
    while ($row = $ret->fetchArray(SQLITE3_ASSOC)) {
        $_SESSION[$row['std_id']] = true;
        setcookie("std_id", $row['std_id'], time() + 14400, '/');
        setcookie("name", $row['name'], time() + 14400, '/');
        setcookie("class", $row['class'], time() + 14400, '/');
    }
    header("Location: /");
} else {
    $error = '用户名密码错误';
    exit();
}
?>