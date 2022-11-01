<?php
    function connDB() {
        $db_host = '127.0.0.1';
        $db_user = 'root';
        $db_passwd = 'Admin233';
        $db_table = 'search';
        
        global $conn;
        $conn = new mysqli($db_host, $db_user, $db_passwd, $db_table);

        if ($conn->connect_error) {
            die(" [ 数据库连接失败 ]: " . $conn->connect_error);
        }

        $conn->query('set names utf8');
    }
?>