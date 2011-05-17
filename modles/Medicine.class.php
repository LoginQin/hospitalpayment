<?php
include_once ('db_table.class.php');
class Medicine extends Db_Table {
	var $table = 'medicines';
	var $property_type = array( //Because Use The WebService So Map the type
		'id' => 'int',
		'name' => 'string',
		'price' => 'float',
		'remaining_cout' => 'int'
	);

	function __construct() {
		parent :: __construct($this->table, $this->property_type);
	}

	function getMedicineById($id) {
		$tb = $this->getRowById($id);
		if($tb) {
			return $tb;
		} else {
			return array();
		}
	}

	function getAllMedicine() {
		$tbs = array();
		$tbs[] = $this->getAllRows();
		if($tbs) {
			return $tbs;
		} else {
			return array();
		}
	}

	function insertMedicine($data) {
		if(isset($data['id'])) unset($data['id']);
		return $this->insert($data);
	}

	function deleteMedicineById($id) {
		$where = "WHERE `id` = $id";
		$result = $this->delete($where);
		return $result;
	}

	function updateMedicine($data) {
		$where = "WHERE `id` = ".$data['id'];
		$result = $this->update($data, $where);
		return $result;

	}



}

?>
