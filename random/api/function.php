<?php
    // 连接数据库
    function connDB() {
        // $db_host = '127.0.0.1';
        // $db_user = 'root';
        // $db_passwd = 'Admin233';
        // $db_table = 'api_stdinfo';
        
        // global $conn;
        // $conn = new mysqli($db_host, $db_user, $db_passwd, $db_table);

        // if ($conn->connect_error) {
        //     die(" [ 数据库连接失败 ]: " . $conn->connect_error);
        // }w

        global $conn;

        class myDB extends SQLite3 {
            function __construct() {
                $this->open('api_stdinfo.db');
            }
        }

        $conn = new myDB();

        if(!$conn) {
            echo $conn->lastErrorMsg();
        }
    }

    // 获取数据
    function getData($conn, $data) {
        $arr = array();
        $a;

        if(!empty($data) && $data != 'undefined') {
            $result = $conn->query(<<<EOF
                SELECT * FROM $data;
            EOF);

            while($row = $result->fetchArray(SQLITE3_ASSOC)) {
                $count = count($row);
                for($i=0;$i<$count;$i++) {
                    unset($row[$i]);
                }
                array_push($arr, $row);
            }

            $conn->close();

            $a = json_encode($arr, JSON_UNESCAPED_UNICODE);
        } else {
            $a = json_encode(0);
        }

        return $a;
    }
?>
