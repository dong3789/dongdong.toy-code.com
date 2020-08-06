<?php 
$host = 'dongdong.toy-code.com';
$name = 'dongdong';
$pw = 'dong123!@';
$db_name = 'dongdong';

try {
	$conn = new PDO('mysql:host='.$host.';
					dbname='.$db_name.';
					charset=utf8', 
					$name, 
					$pw);
	$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $error) {
	echo $error->getMessage();
}

session_start();
?>
