<?php
include_once ('db_table.class.php');
class Patient extends Db_Table {
	var $table = 'patients';
	var $property_type = array( //Because Use The WebService So Map the type
		'id' => 'int',
		'name' => 'string',
		'gender' => 'string',
		'age' => 'int',
		'illness' => 'string'
	);

	function __construct() {
		parent :: __construct($this->table, $this->property_type);
	}

		function getPatientById($id) {
		$tb = $this->getRowById($id);
		if($tb) {
			return $tb;
		} else {
			return array();
		}
	}

	function getAllPatient() {
		$tbs = array();
		$tbs = $this->getAllRows();
		if($tbs) {
			return $tbs;
		} else {
			return array();
		}
	}

	function insertPatient($data) {
		if(isset($data['id'])) unset($data['id']);
		return $this->insert($data);
	}

	function deletePatientById($id) {
		$where = "WHERE `id` = $id";
		$result = $this->delete($where);
		return $result;
	}

	function updatePatient($data) {
		$where = "WHERE `id` = ".$data['id'];
		$result = $this->update($data, $where);
		return $result;

	}



}

?>
