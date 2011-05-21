<?php
include_once('../common.php');
include_once(MODLES_PATH.'/Register.class.php'); //include the class

function getRegisterById($id) {
	$reg = new Register();
	$reg = $reg->getRegisterById($id);
	if($reg) {
		return $reg;
	} else {
		return array();
	}
}

function getAllRegister() {
	$reg = new Register();
	$regs = array();
	$regs[] = $reg->getAllRegister();
	if($regs) {
		return $regs;
	} else {
		return array();
	}
}

function insertRegister($data) {
	$reg = new Register();
	if(isset($data['id'])) unset($data['id']);
	return $reg->insertRegister($data);
}

function deleteRegisterById($id) {
	$reg = new Register();
	$result = $reg->deleteRegisterById($id);
	return $result;
}

function updateRegister($data) {
	$reg = new Register();
	$result = $reg->updateRegister($data);
	return $result;
	
}

function getRegisterBy__($arr_where, $limit = '', $order ='') {
	$tb = new Register();
	$userdata = $tb->getRegisterBy__($arr_where, $limit, $order);
	return $userdata ? $userdata : array();
}



?>
