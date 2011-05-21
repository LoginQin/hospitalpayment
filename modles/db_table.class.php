<?php
include_once('conn.php');
class Db_Table {
	var $db;
	var $table;
	var $property_type = array(); //Because Use The WebService So Map the type
	var $_id = 'id';

	public function  __construct($table, $property_type) {
		global $db;
		$this->db = $db;
		$this->table = $table;
		$this->property_type = $property_type;
	}

	protected function setTableId($id) {
		$this->_id = $id;
	}

	public function getPropertyType() {
		return $this->property_type;
	}

	public function getAllRows(){
		$result = array();
		$sql = 'SELECT * FROM `'.$this->table.'`';
		$this->db->fetch_all($sql, $result);
		return $result;
	}

	public function getRowById($id) {
		$sql = "SELECT * FROM `$this->table` WHERE `$this->_id`=$id LIMIT 1";
		$result = $this->db->query($sql);
		$result = $this->db->fetch_array($result);
		return $result;
	}

	public function delete($where) {
		return	$this->db->delete($this->table, $where);
	}

	public function update($data, $where) {
		return $this->db->update($this->table, $data, $where);
	}

	public function insert($data) {
		return $this->db->insert($this->table, $data);
	}

	public function fetch_array($sql) {
		$result =  $this->db->query($sql);
		$result = $this->db->fetch_array($result);
		return $result;
	}

	/**
	 * arr_where use like bellow:
	 * $arr_where = array('id' => 1)  or array('username' => 'login')
	 */
	function getRowBy__($arr_where, $limit = '', $order ='') {
		$num = count($arr_where);
		$where = '';
		if( $num > 1 ) {
			foreach ($arr_where as $col => $value) {
				if(is_string($value)) {
					$value_check = trim($value);
					$value_check = str_replace(' ', '', $value);
					if(stristr($value_check, 'IN(')) {
						$in = stristr($value_check, 'IN');
						$where .= ' `'.$col.'`'.' '.$in." AND";
					}else if(stristr($value, 'LIKE ')) {
						$like = stristr($value, 'LIKE');
						$where .= ' `'.$col.'` '.$like." AND";
					} else {
						$where .= ' `'.$col.'`'.' = \''.$value."' AND";
					}
				} else {
					$where .= ' `'.$col.'`'.' = '.$value.' AND';
				}
			}
			$where = substr($where, 0, -3 );  //remove the last AND

		} else {
			foreach ($arr_where as $col => $value) {
				if(is_string($value)) {
					$value_check = trim($value);
					$value_check = str_replace(' ','',$value);
					if(stristr($value_check,'IN(')) {
						$in = stristr($value_check, 'IN');
						$where = '`'.$col.'`'.' '.$in;
					}else if(stristr($value, 'LIKE ')) {
						$like = stristr($value, 'LIKE');
						$where = '`'.$col.'`'.' '.$like;

					}else {
						$where = '`'.$col.'`'.' = \''.$value."'";
					}
				} else {
					$where = '`'.$col.'`'.' = '.$value;
				}
			}
		}

		$sql = 'SELECT * FROM `'.$this->table.'`'." WHERE $where $limit $order";
		$result = array();
		if($limit) {
			$result = $this->db->query($sql);
			$result = $this->db->fetch_array($result);
		} else {
			$this->db->fetch_all($sql, $result);
		}
		return $result;

	}
}
?>
