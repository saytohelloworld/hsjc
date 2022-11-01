<?php
    include('function.php');

    connDB();

    search($conn, $_GET["key"]);

    $conn->close();
?>