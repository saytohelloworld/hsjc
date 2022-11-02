<?php
	include('./function.php');

	connDB();

	ini_set('date.timezone', 'Asia/Shanghai');

	$name = $_POST['name'];
	$email = $_POST['email'];
	$time = date('Y-m-d H:i:s');
	$title = $_POST['title'];
	$text = $_POST['text'];
	
	if (!empty($title) && !empty($text)) {
		postData($conn, $name, $email, $time, $title, $text);
	} else {
		return 0;
	};

	$conn->close();
?>