<?php
include_once('../common.php');
include_once(MODLES_PATH.'/Bill.class.php'); //include the class

function getBillById($id) {
	$bill = new Bill();
	$bill = $bill->getBillById($id);
	if($bill) {
		return $bill;
	} else {
		return array();
	}
}

function getAllBill() {
	$bill = new Bill();
	$bills = array();
	$bills[] = $bill->getAllBill();
	if($bills) {
		return $bills;
	} else {
		return array();
	}
}

function insertBill($data) {
	$bill = new Bill();
	if(isset($data['id'])) unset($data['id']);
	return $bill->insertBill($data);
}

function deleteBillById($id) {
	$bill = new Bill();
	$result = $bill->deleteBillById($id);
	return $result;
}

function updateBill($data) {
	$bill = new Bill();
	$result = $bill->updateBill($data);
	return $result;
	
}

function getBillBy__($arr_where, $limit = '', $order ='') {
	$tb = new Bill();
	$billdata = $tb->getBillBy__($arr_where, $limit, $order);
	return $billdata ? $billdata : array();
}


?>
