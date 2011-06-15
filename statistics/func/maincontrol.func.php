<?php 
if(!defined('MAIN_PATH')) { include_once '../common.php'; }
include_once MAIN_PATH.'/statistics/MainControl.class.php';

function signIN($sign_name, $password) {
	$main = new MainControl();
	return $main->signIN($sign_name, $password);
}

function signOUT() {
	$main = new MainControl();
	return $main->signOUT();
}

function checkTarff(){
	$main = new MainControl();
	return $main->checkTarff();
}

function checkMedicines(){
	$main = new MainControl();
	return $main->checkMedicines();
}


function getAllDoctorTotalPrices($time){
	$main = new MainControl();
	return $main -> getAllDoctorTotalPrices($time);
}

function getpriceby_office($time){
	$main = new MainControl();
	return $main -> getpricebyoffice($time);
}

function getpriceby_date($time,$time1){
	$main = new MainControl();
	return $main -> getpricebydate($time,$time1);
}
function getpriceby_register($time,$time1){
	$main = new MainControl();
	return $main -> getpricebyregister($time,$time1);
}
?>