<?php
    include("../config.php");

    // 搜索方法，通过传入的 keyText 使用 SQL 的 LIKE 模糊搜索数据库数据
    function search($conn, $keyText) {
        if ($keyText == '') {
            die(json_encode(array('status' => 00, 'msg' => '未输入搜索内容')));
        }

        $keyText = str_replace('"', '', $keyText);

        $res = $conn->query("SELECT * FROM site WHERE keyTitle LIKE '%$keyText%'");

        if ($res->num_rows > 0) {
            $arr = array();

            while($row = $res->fetch_assoc()) {
                $count = count($row);

                for($i = 0; $i < $count; $i++) {
                    unset($row[$i]);
                }

                array_push($arr, $row);
            }

            echo json_encode($arr, JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode(array('status' => 01, 'msg' => '搜索不到该内容'));
        }
    }
?>