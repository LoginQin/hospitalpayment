<?php
include_once('../common.php');
include_once(MODLES_PATH.'/DoctorVisit.class.php'); //include the class

function getDoctorVisitById($id) {
	$dv = new DoctorVisit();
	$dv = $dv->getDoctorVisitById($id);
	if($dv) {
		return $dv;
	} else {
		return array();
	}
}

function getAllDoctorVisit() {
	$dv = new DoctorVisit();
	$dvs = array();
	$dvs[] = $dv->getAllDoctorVisit();
	if($dvs) {
		return $dvs;
	} else {
		return array();
	}
}

function insertDoctorVisit($data) {
	$dv = new DoctorVisit();
	return $dv->insertDoctorVisit($data);
}

function deleteDoctorVisitById($id) {
	$dv = new DoctorVisit();
	$result = $dv->deleteDoctorVisitById($id);
	return $result;
}

function updateDoctorVisit($data) {
	$dv = new DoctorVisit();
	$result = $dv->updateDoctorVisit($data);
	return $result;
	
}

function getDoctorVisitBy__($arr_where, $limit = '', $order ='') {
	$tb = new DoctorVisit();
	$data = $tb->getDoctorVisitBy__($arr_where, $limit, $order);
	return $data ? $data : array();
}



?>
