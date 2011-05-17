<?php
if(!defined('MAIN_PATH')) { include_once '../../common.php'; }
include_once MAIN_PATH.'/payment/MainControl.class.php';
function signIN($name, $password) {
	$main = new MainControl();
	$result = $main->signIN($name, $password);
	return $result ? TRUE : FALSE;
}

function signOUT() {
	$main = new MainControl();
	$result = $main->signOUT();
	return $result ? TRUE : FALSE;
}

function registerNewPatient($name , $gender, $age , $illness = '') {
	$main = new MainControl();
	$result = $main->registerNewPatient($name, $gender, $age, $illness);
	return $result; //= 5 为正确输入。
}

function registerOldPatient($patient_id){
	$main = new MainControl();
	$result = $main->registerOldPatient($patient_id);
	return $result; //= 5 为注册成功。
	
}


?>
