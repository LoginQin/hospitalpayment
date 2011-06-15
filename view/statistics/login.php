<?php 
include '../../common.php';
include 'checkuseservice.inc.php';
session_start();
$username = trim($_POST['username']);
$password = trim($_POST['password']);
$sign = $main->signIN( $username, $password);
if($sign) {
	$_SESSION['id'] = $sign;       //调用webservice的时候，是不能获取远程服务器的session的
	$_SESSION['name'] = $username; //本地服务器保存的session 用来验证用户是否登录。
	header('Location: ./index.php');
} else {
	header('Location: ../');
}
?>
