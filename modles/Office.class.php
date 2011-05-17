<?php
include_once ('db_table.class.php');
class Office extends Db_Table {
	var $table = 'offices';
	var $property_type = array( //Because Use The WebService So Map the type
		'id' => 'int',
		'name' => 'string',
		'category' => 'string'
	);

	function __construct() {
		parent :: __construct($this->table, $this->property_type);
	}

		function getOfficeById($id) {
		$tb = $this->getRowById($id);
		if($tb) {
			return $tb;
		} else {
			return array();
		}
	}

	function getAllOffice() {
		$tbs = array();
		$tbs[] = $this->getAllRows();
		if($tbs) {
			return $tbs;
		} else {
			return array();
		}
	}

	function insertOffice($data) {
		if(isset($data['id'])) unset($data['id']);
		return $this->insert($data);
	}

	function deleteOfficeById($id) {
		$where = "WHERE `id` = $id";
		$result = $this->delete($where);
		return $result;
	}

	function updateOffice($data) {
		$where = "WHERE `id` = ".$data['id'];
		$result = $this->update($data, $where);
		return $result;

	}



}

?>
