<?php
    // 连接数据库
    function connDB() {
        $db_host = '127.0.0.1';
        $db_user = 'root';
        $db_passwd = 'Admin233';
        $db_table = 'bbs';
        
        global $conn;
        $conn = new mysqli($db_host, $db_user, $db_passwd, $db_table);

        if ($conn->connect_error) {
            die(" [ 数据库连接失败 ]: " . $conn->connect_error);
        }
        $conn->query('set names utf8');
    }

    // 转义 Html 标签和特殊字符
    function search_fill($conn, $content){
        $string = mysqli_real_escape_string($conn, $content);
        $string = htmlspecialchars($content);

        return $string;
    }

    // 提交数据到数据库
    function postData($conn, $data1, $data2, $data3, $data4, $data5) {
        $data1 = search_fill($conn, $data1);
        $data2 = search_fill($conn, $data2);
        $data4 = search_fill($conn, $data4);
        $data5 = search_fill($conn, $data5);

        $postSQL = "INSERT INTO msg (name, email, time, title, text)
                    VALUES ('$data1', '$data2', '$data3', '$data4', '$data5')";
        
        if ($conn->query($postSQL) === TRUE) {
            // echo "[ 发布成功 ] ";
            updateData($conn);
        } else {
            echo "[ 发布失败 ]: " . $conn->error;
        }
    }

    // 更新数据
    function updateData($conn) {
        $updateSQL = "SELECT * FROM msg ORDER BY time DESC";
        $updateResult = $conn->query($updateSQL);

        if ($updateResult->num_rows > 0) {
            while ($row = $updateResult->fetch_assoc()) {
                echo '<div class="msg-box">
                            <p class="msg-title" data-id="'.$row["id"].'">'.$row["title"].'</p>
                            <div class="msg-info">
                                <p class="msg-nickname">'.$row["name"].'</p>
                                <p class="msg-time" title="'.$row["time"].'">'.explode(" ", $row["time"])[0].'</p>
                            </div>
                        </div>';
            }
        }
    }

    // 获取帖子内容
    function getContent($conn, $data1) {
        $getSQL = "SELECT * FROM msg WHERE id='$data1'";
        $getResult = $conn->query($getSQL);

        while($row = mysqli_fetch_array($getResult)) {
            echo $row['text'];
        }
    }
?>