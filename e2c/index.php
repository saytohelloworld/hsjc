<?php
session_start();

if (!isset($_COOKIE["std_id"]) && !isset($_SESSION[$_COOKIE["std_id"]]) && $_SESSION[$_COOKIE["std_id"]] != true) {
    header("Location: /fn/login.php");
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
    <link rel="stylesheet" href="/static/style.css">
</head>
<body>
    <main>
        <div class="left">
            <div class="std">
                <div class="bg"></div>
                <p class="class"><span>班级：</span><?php echo urldecode($_COOKIE["class"])?></p>
                <p class="name"><span>姓名：</span><?php echo urldecode($_COOKIE["name"])?></p>
                <p class="id"><?php echo urldecode($_COOKIE["std_id"])?></p>
            </div>
            <div class="text-center">
                <button type="button" class="btn" id="std-passwd">更改密码</button>
                <button type="button" class="btn" id="std-logout" onclick="window.location.href='/fn/login.php?logout'">退出账号</button>
            </div>
            <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action">排名与统计</a>
                <a href="#" class="list-group-item list-group-item-action">入场卷 <span class="badge bg-secondary">0</span></a>
            </div>
            <div class="setting card">
                <div class="card-body">
                <form action="index.php" method="get">
                    <div class="row">
                        <div class="col-5">
                            <label for="limit">题量：</label>
                            <input type="number" class="form-control" id="limit" name="limit" min=10 value=10 placeholder="≧10">
                        </div>
                        <div class="col">
                            <label for="entype">题型：</label>
                            <select class="form-select" id="entype" name="entype">
                                <option>e2c</option>
                            </select>
                        </div>
                    </div>
                    <p class="text-end"><button type="submit" class="btn btn-success" style="margin-top: 20px;">开始练习</button></p>
                </form>
                </div>
            </div>
        </div>
        <div class="right">
            <div class="container answerArea card">
                <div class="card-body">
                <?php                
                    function show($json_proene2c) {
                        for ($i=0; $i<sizeof($json_proene2c); $i++)
                        {
                            echo '<div class="card">';
                            echo '<div class="card-header"><h5><i>'.$json_proene2c[$i][0].".</i>".$json_proene2c[$i][1]."</h5></div>";
                            echo '<div class="card-body">';
                            echo '<div class="row">';
            
                            echo '<div class="col">';
                            echo '<div class="form-check">';
                            echo '<input type="radio" class="form-check-input" id="radio'.$json_proene2c[$i][0].'-1" name="optradio'.$json_proene2c[$i][0].'" value="'.$json_proene2c[$i][0].'-'.$json_proene2c[$i][2].'-'.$json_proene2c[$i][6].'" onclick=disabledx(this) >';
                            echo '<label class="form-check-label" for="radio'.$json_proene2c[$i][0].'-1">'.$json_proene2c[$i][2].'</label>';
                            echo '</div>';
                            echo '</div>';
            
                            echo '<div class="col">';
                            echo '<div class="form-check">';
                            echo '<input type="radio" class="form-check-input" id="radio'.$json_proene2c[$i][0].'-2" name="optradio'.$json_proene2c[$i][0].'" value="'.$json_proene2c[$i][0].'-'.$json_proene2c[$i][3].'-'.$json_proene2c[$i][6].'" onclick=disabledx(this)>';
                            echo '<label class="form-check-label" for="radio'.$json_proene2c[$i][0].'-2">'.$json_proene2c[$i][3].'</label>';
                            echo '</div>';
                            echo '</div>';
            
                            echo '<div class="col">';
                            echo '<div class="form-check">';
                            echo '<input type="radio" class="form-check-input" id="radio'.$json_proene2c[$i][0].'-3" name="optradio'.$json_proene2c[$i][0].'" value="'.$json_proene2c[$i][0].'-'.$json_proene2c[$i][4].'-'.$json_proene2c[$i][6].'" onclick=disabledx(this)>';
                            echo '<label class="form-check-label" for="radio'.$json_proene2c[$i][0].'-3">'.$json_proene2c[$i][4].'</label>';
                            echo '</div>';
                            echo '</div>';
            
                            echo '<div class="col">';
                            echo '<div class="form-check">';
                            echo '<input type="radio" class="form-check-input" id="radio'.$json_proene2c[$i][0].'-4" name="optradio'.$json_proene2c[$i][0].'" value="'.$json_proene2c[$i][0].'-'.$json_proene2c[$i][5].'-'.$json_proene2c[$i][6].'" onclick=disabledx(this)>';
                            echo '<label class="form-check-label" for="radio'.$json_proene2c[$i][0].'-4">'.$json_proene2c[$i][5].'</label>';
                            echo "</div>";
                            echo "</div>";
            
                            echo "</div>";
            
                            echo "</div>";
                            //echo '<div class="card-footer">答案:'.$json_proene2c[$i][6].$json_proene2c[$i][7].'</div>';
                            echo '<div class="card-footer"><i>答案:</i><span id="optradio'.$json_proene2c[$i][0].'"></span></div>';
                            echo "</div>";
                            echo "<br />";
                        }
                    }

                    if (isset($_GET["limit"]) && isset($_GET["entype"])) {
                        $url_proene2c="http://www.101001000.cc:8000/api/global/proen/ex/read?limit=".$_GET["limit"]."&entype=".$_GET["entype"];
                        $html_proene2c = file_get_contents($url_proene2c);
                        $json_proene2c = json_decode($html_proene2c, true);
                        echo '<p>答题区：</p>';
                        show($json_proene2c);
                    } else {
                        echo '<div class="container col-10">
                                    <h2 class="text-center">注意事项</h2>
                                    <hr>
                                    <p>一旦开始刷题，并且鼠标已经点击过作答区域，则<mark>开始计时</mark>！</p>
                                    <p>答题过程中，<mark>鼠标不准离开作答区域范围</mark>，否则将视为<mark>无效作答</mark>。</p>
                                    <p>作答只有一次机会，一旦<mark>选择了答案</mark>，则<mark>无法修改</mark>，请注意答题。</p>
                                </div>';
                    }
                ?>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <script src="https://cdn.staticfile.org/jquery/3.6.1/jquery.min.js"></script>
        <script src="https://cdn.staticfile.org/popper.js/2.9.3/umd/popper.min.js"></script>
        <script src="https://cdn.staticfile.org/twitter-bootstrap/5.1.1/js/bootstrap.min.js"></script>
        <script src="/static/script.js"></script>
    </footer>
</body>
</html>