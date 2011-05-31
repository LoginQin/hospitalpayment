<?php
include_once ('db_table.class.php');
class Register extends Db_Table {
	var $table = 'registers';
	var $property_type = array( //Because Use The WebService So Map the type
		'id' => 'int',
		'patient_id' => 'int',
		'patient_name' => 'string',
		'price' => 'float',
		'time' => 'string',
		'user_id' => 'int',
		'username' => 'string',
		'state' => 'int'
	);

	function __construct() {
		parent :: __construct($this->table, $this->property_type);
	}

	function getRegisterById($id) {
		$tb = $this->getRowById($id);
		if($tb) {
			return $tb;
		} else {
			return array();
		}
	}

	function getAllRegister() {
		$tbs = array();
		$tbs = $this->getAllRows();
		if($tbs) {
			return $tbs;
		} else {
			return array();
		}
	}

	function insertRegister($data) {
		if(isset($data['id'])) unset($data['id']);
		return $this->insert($data);
	}

	function deleteRegisterById($id) {
		$where = "WHERE `id` = $id";
		$result = $this->delete($where);
		return $result;
	}

	function updateRegister($data) {
		$where = "WHERE `id` = ".$data['id'];
		$result = $this->update($data, $where);
		return $result;

	}

	function getRegisterBy__($arr_where, $limit = '', $order ='') {
		$result = $this->getRowBy__($arr_where, $limit , $order );
		if($result) {
			return $result;
		}else {
			return array();
		}
	}

	function  getRegisterByPatientId($patient_id ){
		$arr_where = array('patient_id' => $patient_id , 'state' => 0 );
		$result = $this->getRowBy__($arr_where, $limit = 'LIMIT 1', $order = 'ORDER BY time DESC');
		return $result ? $result : array();
	}



}

?>
