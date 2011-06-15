<?php
include_once '../common.php';
include_once(MODLES_PATH.'/statistics.class.php'); //include the class

function getAllDoctorTotalPrice($time){
	$tb = new statistics();
	$data = $tb->getAllDoctorTotalPrice($time);
	return $data ? $data : array(); 
}
function getpricebyoffice($time){
	$tb = new statistics();
	$data = $tb->getpricebyoffice($time);
	return $data ? $data : array(); 
}
function getpricebydate($time,$time1){
	$tb = new statistics();
	$data = $tb->getpricebydate($time,$time1);
	return $data ? $data : array(); 
}
function getpricebyregister($time,$time1){
	$tb = new statistics();
	$data = $tb->getpricebyregister($time,$time1);
	return $data ? $data : array(); 
}
function getbillprice($time,$time1){
	$tb = new statistics();
	$data = $tb->getbillprice($time,$time1);
	return $data ? $data : array(); 
}

?>