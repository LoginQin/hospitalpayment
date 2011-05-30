<?php
include_once('../common.php');
include_once(MODLES_PATH.'/User.class.php');
/**
 * User function 
 */
function getUserById($id) {
	$user = new User;
	$user = $user->getRowById($id);
	if($user) {
		return $user;
	} else {
		return array();
	}
}

function getAllUser() {
	$user = new User;
	$users = array();
	$users = $user->getAllRows();
	if($users) {
		return $users;
	} else {
		return array();
	}
}

function insertUser($data) {
	$user = new User();
	if(isset($data['id'])) unset($data['id']);
	return $user->insert($data);
}

function deleteUserById($id) {
	$pa = new User();
	$where = "WHERE `id` = $id";
	$result = $pa->delete($where);
	return $result;
}

function updateUser($data) {
	$tb = new User();
	$where = "WHERE `id` = ".$data['id'];
	$result = $tb->update($data, $where);
	return $result;
	
}

function getUserBy__($arr_where, $limit = '', $order ='') {
	$tb = new User();
	$userdata = $tb->getUserBy__($arr_where, $limit, $order);
	return $userdata ? $userdata : array();
}
?>
