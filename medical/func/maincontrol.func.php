<?php 
if(!defined('MAIN_PATH')) { include_once '../../common.php'; }
include_once MAIN_PATH.'/medical/MainControl.class.php';
/**
 * 如果要使用webservice 则将函数暴露出来提供给webservice注册。
 * 将函数独立作为一个文件的好处是，可以给webservice引用注册，也可以给本地调用
 */
function signIN($sign_name, $password) {
	$main = new MainControl();
	return $main->signIN($sign_name, $password);
}

function signOUT() {
	$main = new MainControl();
	return $main->signOUT();
}

function insertIllnessByPatientId($patient_id, $doctor_id, $illness , $medicine) {
	$main = new MainControl();
	return $main->insertIllnessByPatientId($patient_id, $doctor_id, $illness , $medicine);
}

function getPatientDataById($patient_id) {
	$main = new MainControl();
	return $main->getPatientDataById($patient_id);
}
function getHistoryDiacrisis($patient_id) {
	$main = new MainControl();
	return $main->getHistoryDiacrisis($patient_id);
}

?>
