<?php
include_once('../common.php');
include_once(MODLES_PATH.'/Doctor.class.php'); //include the class

function getDoctorById($id) {
	$doctor = new Doctor();
	$doctor = $doctor->getDoctorById($id);
	if($doctor) {
		return $doctor;
	} else {
		return array();
	}
}

function getAllDoctor() {
	$doctor = new Doctor();
	$doctors = array();
	$doctors[] = $doctor->getAllDoctor();
	if($doctors) {
		return $doctors;
	} else {
		return array();
	}
}

function insertDoctor($data) {
	$doctor = new Doctor();
	return $doctor->insertDoctor($data);
}

function deleteDoctorById($id) {
	$doctor = new Doctor();
	$result = $doctor->deleteDoctorById($id);
	return $result;
}

function updateDoctor($data) {
	$doctor = new Doctor();
	$result = $doctor->updateDoctor($data);
	return $result;
	
}



?>
