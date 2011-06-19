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
	return $result; //返回大于0的病人ID。
}

function registerOldPatient($patient_id){
	$main = new MainControl();
	$result = $main->registerOldPatient($patient_id);
	return $result; //= 5 为注册成功。
	
}

function insertTotalMedicalPriceToBill($patient_id, $total_medical_price) {
	$main = new MainControl();
	$result = $main->insertTotalMedicalPriceToBill($patient_id, $total_medical_price);
	return $result ? $result : 0;
}

function getFinalBillByPatientId($patient_id) {
	$main = new MainControl();
	$result = $main->getFinalBillByPatientId($patient_id);
	return $result ? $result : array();
}

function getPrescribeByPatientId($patient_id) {
	$main = new MainControl();
	$result = $main->getPrescribeByPatientId($patient_id);
	return $result ? $result : array();
}

function recordTakeMedicineData($patient_id, $medicine) {
	$main = new MainControl();
	$result = $main->recordTakeMedicineData($patient_id, $medicine);
	return $result ? $result : 0 ;
}


?>
