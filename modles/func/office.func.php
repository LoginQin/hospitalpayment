<?php
include_once('../common.php');
include_once(MODLES_PATH.'/Office.class.php'); //include the class

function getOfficeById($id) {
	$offic = new Office();
	$offic = $offic->getOfficeById($id);
	if($offic) {
		return $offic;
	} else {
		return array();
	}
}

function getAllOffice() {
	$offic = new Office();
	$offics = array();
	$offics[] = $offic->getAllOffice();
	if($offics) {
		return $offics;
	} else {
		return array();
	}
}

function insertOffice($data) {
	$offic = new Office();
	if(isset($data['id'])) unset($data['id']);
	return $offic->insertOffice($data);
}

function deleteOfficeById($id) {
	$offic = new Office();
	$result = $offic->deleteOfficeById($id);
	return $result;
}

function updateOffice($data) {
	$offic = new Office();
	$result = $offic->updateOffice($data);
	return $result;
	
}

function getOfficeByDoctorId($doctor_id) {
	$tb = new Office();
	$data = $tb->getOfficeByDoctorId($doctor_id);
	return $data ? $data : array();
}


?>
