<?php
include_once ('db_table.class.php');
class Doctor extends Db_Table {
	var $table = 'doctors';
	var $property_type = array( //Because Use The WebService So Map the type
		'id' => 'int',
		'name' => 'string',
		'duty' => 'string',
		'office_id' =>'int',
		'sign_name' =>'string',
		'password' => 'string'
	);

	function __construct() {
		parent :: __construct($this->table, $this->property_type);
	}

	function getDoctorById($id) {
		$tb = $this->getRowById($id);
		if($tb) {
			return $tb;
		} else {
			return array();
		}
	}

	function getAllDoctor() {
		$tbs = array();
		$tbs = $this->getAllRows();
		if($tbs) {
			return $tbs;
		} else {
			return array();
		}
	}

	function insertDoctor($data) {
		if(isset($data['id'])) unset($data['id']);
		return $this->insert($data);
	}

	function deleteDoctorById($id) {
		$where = "WHERE `id` = $id";
		$result = $this->delete($where);
		return $result;
	}

	function updateDoctor($data) {
		$where = "WHERE `id` = ".$data['id'];
		$result = $this->update($data, $where);
		return $result;

	}

	function getDoctorBy__($arr_where, $limit = '', $order ='') {
		$result = $this->getRowBy__($arr_where, $limit , $order );
		if($result) {
			return $result;
		}else {
			return array();
		}
	}



}

?>
