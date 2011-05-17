<?php
include_once('../common.php');
include_once(MODLES_PATH.'/Patient.class.php'); //include the class
/**
 * 暴露模型的公有方法，以方便给Web Server提供函数给另一层，并且也能本地化引用。
 */
function getPatientById($id) {
	$patient = new Patient();
	$patient = $patient->getRowById($id);
	if($patient) {
		return $patient;
	} else {
		return array();
	}
}

function getAllPatient() {
	$patient = new Patient();
	$patients = array();
	$patients[] = $patient->getAllRows();
	if($patients) {
		return $patients;
	} else {
		return array();
	}
}

function insertPatient($data) {
	$patient = new Patient();
	if(isset($data['id'])) unset($data['id']);
	return $patient->insert($data);
}

function deletePatientById($id) {
	$pa = new Patient();
	$where = "WHERE `id` = $id";
	$result = $pa->delete($where);
	return $result;
}

function updatePatient($data) {
	$tb = new Patient();
	$where = "WHERE `id` = ".$data['id'];
	$result = $tb->update($data, $where);
	return $result;
	
}

?>
