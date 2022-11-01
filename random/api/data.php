<?php
    header("content-Type: text/html; charset=utf-8");
    
    include("function.php");    
    
    connDB();

    $db_table = $_GET["table"];

    echo getData($conn, $db_table);
?>
