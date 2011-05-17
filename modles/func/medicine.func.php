<?php
include_once('../common.php');
include_once(MODLES_PATH.'/Medicine.class.php'); //include the class

function getMedicineById($id) {
	$med = new Medicine();
	$med = $med->getMedicineById($id);
	if($med) {
		return $med;
	} else {
		return array();
	}
}

function getAllMedicine() {
	$med = new Medicine();
	$meds = array();
	$meds[] = $med->getAllMedicine();
	if($meds) {
		return $meds;
	} else {
		return array();
	}
}

function insertMedicine($data) {
	$med = new Medicine();
	if(isset($data['id'])) unset($data['id']);
	return $med->insertMedicine($data);
}

function deleteMedicineById($id) {
	$med = new Medicine();
	$result = $med->deleteMedicineById($id);
	return $result;
}

function updateMedicine($data) {
	$med = new Medicine();
	$result = $med->updateMedicine($data);
	return $result;
	
}

?>
