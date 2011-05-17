<?php
include_once ('db_table.class.php');
class Bill extends Db_Table {
	var $table = 'bills';
	var $property_type = array( //Because Use The WebService So Map the type
		'register_id' => 'int',
		'time' => 'string',
		'patient_name' => 'string',
		'toll_collector' =>'string',
		'doctor_id' =>'int',
		'tariffs' =>'string',
		'total_price' => 'float'
	);

	function __construct() {
		parent :: __construct($this->table, $this->property_type);
		parent :: setTableId('register_id');
	}

	function getBillById($id) {
		$tb = $this->getRowById($id);
		if($tb) {
			return $tb;
		} else {
			return array();
		}
	}

	function getAllBill() {
		$tbs = array();
		$tbs[] = $this->getAllRows();
		if($tbs) {
			return $tbs;
		} else {
			return array();
		}
	}

	function insertBill($data) {
		return $this->insert($data);
	}

	function deleteBillById($id) {
		$where = "WHERE `register_id` = $id";
		$result = $this->delete($where);
		return $result;
	}

	function updateBill($data) {
		$where = "WHERE `register_id` = ".$data['register_id'] ;
		$result = $this->update($data, $where);
		return $result;
	}

	function getBillBy__($arr_where, $limit = '', $order ='') {
		$result = $this->getRowBy__($arr_where, $limit , $order );
		if($result) {
			return $result;
		}else {
			return array();
		}
	}
}

?>
