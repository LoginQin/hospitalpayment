<?php
include_once ('db_table.class.php');
class DoctorVisit extends Db_Table {
	var $table = 'doctors_visiting';
	var $property_type = array( //Because Use The WebService So Map the type
		'id' => 'int',
		'doctor_id' => 'int',
		'name' => 'string',
		'illness' =>'string',
		'prescription_id' =>'int'
	);

	function __construct() {
		parent :: __construct($this->table, $this->property_type);
	}

	function getDoctorVisitById($id) {
		$tb = $this->getRowById($id);
		if($tb) {
			return $tb;
		} else {
			return array();
		}
	}

	function getAllDoctorVisit() {
		$tbs = array();
		$tbs[] = $this->getAllRows();
		if($tbs) {
			return $tbs;
		} else {
			return array();
		}
	}

	function insertDoctorVisit($data) {
		return $this->insert($data);
	}

	function deleteDoctorVisitById($id) {
		$where = "WHERE `id` = $id";
		$result = $this->delete($where);
		return $result;
	}

	function updateDoctorVisit($data) {
		$where = "WHERE `id` = ".$data['id'];
		$result = $this->update($data, $where);
		return $result;

	}



}

?>
