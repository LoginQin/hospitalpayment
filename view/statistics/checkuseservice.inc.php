<?php
//检测是否调用远程webservice
$ini = parse_ini_file ( MAIN_PATH.'/config.ini');
if($ini['STATIC_SERVER_OPEN']) { //使用远程调用
	include MAIN_PATH.'/lib/nusoap.php';
	$client = new soapclient($ini['URL_STATIC_WSDL'], true);
	$err = $client->getError();
	if ($err) {
		// Display the error
		echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
		// At this point, you know the call that follows will fail
		die();
	}
	$main = $client->getProxy();

}else {//使用本地调用
	include MAIN_PATH.'/statistics/maincontrol.class.php';
	$main = new MainControl();
}
?>
