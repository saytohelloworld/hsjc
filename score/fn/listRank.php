<?php
include('fn.php');

connDB();

$dorm_type = $_GET["dorm_type"];
$date = $_GET["date"];
$num = $_GET["num"];

// print_r (listRank($conn, $dorm_type, $date)[0]->score);

echo listRank($conn, $dorm_type, $date, $num);

$conn->close();