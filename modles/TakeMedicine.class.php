<?php
include_once ('db_table.class.php');
class TakeMedicine extends Db_Table {
	var $table = 'takemedicines';
	var $property_type = array( //Because Use The WebService So Map the type
		'id' => 'int',
		'register_id' => 'int',
		'name' => 'string',
		'count' =>'int'
	);

	function __construct() {
		parent :: __construct($this->table, $this->property_type);
	}

	function getTakeMedicineById($id) {
		$tb = $this->getRowById($id);
		if($tb) {
			return $tb;
		} else {
			return array();
		}
	}

	function getAllTakeMedicine() {
		$tbs = array();
		$tbs = $this->getAllRows();
		if($tbs) {
			return $tbs;
		} else {
			return array();
		}
	}

	function insertTakeMedicine($data) {
		if(isset($data['id'])) unset($data['id']);
		return $this->insert($data);
	}

	function deleteTakeMedicineById($id) {
		$where = "WHERE `id` = $id";
		$result = $this->delete($where);
		return $result;
	}

	function updateTakeMedicine($data) {
		$where = "WHERE `id` = ".$data['id'];
		$result = $this->update($data, $where);
		return $result;

	}

	function getTakeMedicineBy__($arr_where, $limit = '', $order ='') {
		$result = $this->getRowBy__($arr_where, $limit , $order );
		if($result) {
			return $result;
		}else {
			return array();
		}
	}

}

?>
