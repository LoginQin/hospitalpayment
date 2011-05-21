<?php
include_once('../common.php');
include_once(MODLES_PATH.'/Prescribe.class.php'); //include the class

function getPrescribeById($id) {
	$pre = new Prescribe();
	$pre = $pre->getPrescribeById($id);
	if($pre) {
		return $pre;
	} else {
		return array();
	}
}

function getAllPrescribe() {
	$pre = new Prescribe();
	$pres = array();
	$pres[] = $pre->getAllPrescribe();
	if($pres) {
		return $pres;
	} else {
		return array();
	}
}

function insertPrescribe($data) {
	$pre = new Prescribe();
	return $pre->insertPrescribe($data);
}

function deletePrescribeById($id) {
	$pre = new Prescribe();
	$result = $pre->deletePrescribeById($id);
	return $result;
}

function updatePrescribe($data) {
	$pre = new Prescribe();
	$result = $pre->updatePrescribe($data);
	return $result;
	
}

function getPrescribeBy__($arr_where, $limit = '', $order ='') {
	$tb = new Prescribe();
	$userdata = $tb->getPrescribeBy__($arr_where, $limit, $order);
	return $userdata ? $userdata : array();
}


?>
