<?php
include('fn.php');

connDB();


echo listDate($conn, $_GET['dorm_type']);

$conn->close();