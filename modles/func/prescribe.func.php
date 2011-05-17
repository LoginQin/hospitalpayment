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
	if(isset($data['id'])) unset($data['id']);
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

?>