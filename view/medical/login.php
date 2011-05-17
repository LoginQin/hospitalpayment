<?php 
include '../../common.php';
session_start();
$ini = parse_ini_file ( MAIN_PATH.'/config.ini');
if($ini['MEDICAL_SERVER_OPEN']) { //使用远程调用
	include MAIN_PATH.'/lib/nusoap.php';
	$client = new soapclient($ini['URL_MEDICAL_WSDL'], true);
	$err = $client->getError();
	if ($err) {
		// Display the error
		echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
		// At this point, you know the call that follows will fail
		die();
	}
	$main = $client->getProxy();

}else {//使用本地调用
	include MAIN_PATH.'/medical/maincontrol.class.php';
	$main = new MainControl();
}
$username = trim($_POST['username']);
$password = trim($_POST['password']);
$sign = $main->signIN( $username, $password);

if($sign) {
	$_SESSION['name'] = $username; //本地服务器保存的session 用来验证用户是否登录。
	header('Location: ./index.php');
} else {
	header('Location: ../');
}
?>
