<?php
session_start();
if(!isset($_SESSION['name'])) {
	header('Location : ../index.php');
	die();
}
echo '已登录';
?>
