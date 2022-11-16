<?php
include('fn.php');

connDB();

$name = $_POST["name"];
$dorm_type = $_POST["dorm_type"];
$floor = $_POST["floor"];
$score = $_POST["score"];

echo newScore($conn, $name, $dorm_type, $floor, $score);

$conn->close();