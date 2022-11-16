<?php
include('fn.php');

connDB();

$dorm_type = $_GET["dorm_type"];
$date = $_GET["date"];

echo queryScore($conn, $dorm_type, $date);


$conn->close();