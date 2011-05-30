<?php
include_once ('db_table.class.php');
class User extends Db_Table {
	var $table = 'users';
	var $property_type = array( //Because Use The WebService So Map the type
		'id' => 'int',
		'username' => 'string',
		'password' => 'string',
		'power' => 'int'
	);

	function __construct() {
		parent :: __construct($this->table, $this->property_type);
	}

	function getUserById($id) {
		$tb = $this->getRowById($id);
		if($tb) {
			return $tb;
		} else {
			return array();
		}
	}

	function getUserBy__($arr_where, $limit = '', $order ='') {
		$result = $this->getRowBy__($arr_where, $limit , $order );
		if($result) {
			return $result;
		}else {
			return array();
		}
	}

	function getAllUser() {
		$tbs = array();
		$tbs = $this->getAllRows();
		if($tbs) {
			return $tbs;
		} else {
			return array();
		}
	}

	function insertUser($data) {
		if(isset($data['id'])) unset($data['id']);
		return $this->insert($data);
	}

	function deleteUserById($id) {
		$where = "WHERE `id` = $id";
		$result = $this->delete($where);
		return $result;
	}

	function updateUser($data) {
		$where = "WHERE `id` = ".$data['id'];
		$result = $this->update($data, $where);
		return $result;

	}
}

?>
