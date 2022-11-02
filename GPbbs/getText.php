<?php
    include('./function.php');

    connDB();

    $id = $_POST['id'];

    getContent($conn, $id);

    $conn->close();
?>