<?php
include_once('../common.php');
include_once(MODLES_PATH.'/TakeMedicine.class.php'); //include the class

function getTakeMedicineById($id) {
	$takem = new TakeMedicine();
	$takem = $takem->getTakeMedicineById($id);
	if($takem) {
		return $takem;
	} else {
		return array();
	}
}

function getAllTakeMedicine() {
	$takem = new TakeMedicine();
	$takems = array();
	$takems = $takem->getAllTakeMedicine();
	if($takems) {
		return $takems;
	} else {
		return array();
	}
}

function insertTakeMedicine($data) {
	$takem = new TakeMedicine();
	if(isset($data['id'])) unset($data['id']);
	return $takem->insertTakeMedicine($data);
}

function deleteTakeMedicineById($id) {
	$takem = new TakeMedicine();
	$result = $takem->deleteTakeMedicineById($id);
	return $result;
}

function updateTakeMedicine($data) {
	$takem = new TakeMedicine();
	$result = $takem->updateTakeMedicine($data);
	return $result;
	
}

function getTakeMedicineBy__($arr_where, $limit = '', $order ='') {
	$takem = new TakeMedicine();
	$result = $takem->getTakeMedicineBy__($arr_where, $limit , $order );
	return $result ? $result : array();
}

?>
