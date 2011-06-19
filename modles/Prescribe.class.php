<?php
include_once ('db_table.class.php');
class Prescribe extends Db_Table {
	var $table = 'prescribes';
	var $property_type = array( //Because Use The WebService So Map the type
		'id' => 'int',
		'register_id' => 'int',
		'patient_name' => 'string',
		'doctor_name' =>'string',
		'medicine' =>'string'
	);

	function __construct() {
		parent :: __construct($this->table, $this->property_type);
	}

	function getPrescribeById($id) {
		$tb = $this->getRowById($id);
		if($tb) {
			return $tb;
		} else {
			return array();
		}
	}

	function getPrescribeBy__($arr_where, $limit = '', $order ='') {
		$result = $this->getRowBy__($arr_where, $limit, $order);
		if($result) {
			return $result;
		}else {
			return array();
		}
	}

	function getAllPrescribe() {
		$tbs = array();
		$tbs = $this->getAllRows();
		if($tbs) {
			return $tbs;
		} else {
			return array();
		}
	}

	function insertPrescribe($data) {
		return $this->insert($data);
	}

	function deletePrescribeById($id) {
		$where = "WHERE `id` = $id";
		$result = $this->delete($where);
		return $result;
	}

	function updatePrescribe($data) {
		$where = "WHERE `id` = ".$data['id'];
		$result = $this->update($data, $where);
		return $result;

	}



}

?>
