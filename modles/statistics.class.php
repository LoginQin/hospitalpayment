<?php
include_once ('db_table.class.php');
class statistics extends Db_Table {
	var $table = 'statistics';
	var $property_type = array( //问题所在，此处应如何注册type
	'id' => 'int',
	'name' => 'varchar',
	'price' => 'float',
	'remaining_count' => 'int',
	'count(*)' => 'int',
	'sum(total_price)' => 'float',   
	'sum(price)' => 'float',
	'date(time)' => 'datetime',
	'price_contrast' => 'float',
	'num_contrast' => 'float',
	'rate' => 'float'
	); //Because Use The WebService So Map the type	

	function __construct() {
		parent :: __construct($this->table, $this->property_type);
	}
	function getAllDoctorTotalPrice($time){
		$sql = "SELECT name,count(*),sum(total_price),date(time) FROM `doctors` as a,`bills` as b
				where b.doctor_id = a.id and date(time) = '$time'
				group by name";
		$result = $this->fetch_all($sql);
		return $result ? $result : array();

	}
	function getpricebyoffice($time){
		$sql ="SELECT o.name,sum(total_price),count(*),date(time) FROM `bills` as b,`doctors` as d,`offices` as o
			   where b.doctor_id = d.id and d.office_id = o.id and date(time) = '$time'
			   group by o.id";
		$result = $this->fetch_all($sql);
		return $result ? $result : array();

	}
	function getpricebydate($time,$time1){
		$sql ="SELECT date(time),count(distinct id)
			   FROM `doctors_visiting`
			   where date(time) between '$time' and '$time1'
			   group by date(time)";
		$result = $this->fetch_all($sql);
		return $result ? $result : array();
	}
	function getbillprice($time,$time1){
		$sql ="SELECT date(time),sum(total_price) FROM `bills`
		       where date(time) between '$time' and '$time1'
			   group by date(time)";
		$result = $this->fetch_all($sql);
		return $result ? $result : array();
	}
	function getpricebyregister($time,$time1){
		$sql ="select date(time),sum(price),count(*) from `registers`
			   where date(time) between '$time' and '$time1'
			   group by date(time)";
		$result = $this->fetch_all($sql);
		return $result ? $result : array();

	}
}
?>
