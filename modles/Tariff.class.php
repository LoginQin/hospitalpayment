<?php
include_once ('db_table.class.php');
class Tariff extends Db_Table {
	var $table = 'tariff';
	var $property_type = array( //Because Use The WebService So Map the type
		'id' => 'int',
		'name' => 'string',
		'price' => 'float'
	);

	function __construct() {
		parent :: __construct($this->table, $this->property_type);
	}

	function getTariffById($id) {
		$tb = $this->getRowById($id);
		if($tb) {
			return $tb;
		} else {
			return array();
		}
	}

	function getAllTariff() {
		$tbs = array();
		$tbs[] = $this->getAllRows();
		if($tbs) {
			return $tbs;
		} else {
			return array();
		}
	}

	function insertTariff($data) {
		if(isset($data['id'])) unset($data['id']);
		return $this->insert($data);
	}

	function deleteTariffById($id) {
		$where = "WHERE `id` = $id";
		$result = $this->delete($where);
		return $result;
	}

	function updateTariff($data) {
		$where = "WHERE `id` = ".$data['id'];
		$result = $this->update($data, $where);
		return $result;

	}

	function getTariffBy__($arr_where, $limit = '', $order ='') {
		$result = $this->getRowBy__($arr_where, $limit , $order );
		if($result) {
			return $result;
		}else {
			return array();
		}
	}
}

?>
