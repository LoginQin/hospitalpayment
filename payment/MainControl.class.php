<?php
include_once "../common.php";
include_once MODLES_PATH.'/func/user.func.php'; //获取数据层函数, 这里用本地调用方法，本应该是作为远程调用的
include_once MODLES_PATH.'/func/patient.func.php';
include_once MODLES_PATH.'/func/tariff.func.php';
include_once MODLES_PATH.'/func/register.func.php';
include_once MODLES_PATH.'/func/bill.func.php';
class MainControl {

	function __construct() {
		if(!isset($_SESSION)) {
			session_start();
		}
	}

	function checkLoginState() { // 检查登陆状态
		if(isset($_SESSION['username'])) {
			return TRUE;
		}else {
			return FALSE;
		}
	}

	function signIN($sign_name, $password) {  //登陆
		$arr_where = array ('username' => $sign_name, 'password' => $password );
		$result = getUserBy__($arr_where, 'LIMIT 1');
		if($result) {
			$_SESSION['id']  = $result['id'];
			$_SESSION['username'] = $result['username'];
			$_SESSION['power'] = $result['power'];
			return 1;
		} else {
			return 0;
		}

	}

	function signOUT() { // 退出
		if(isset($_SESSION['username'])) {
			unset($_SESSION);
			return 1;
		} else {
			return 0;
		}
	}

	function registerNewPatient($name, $gender, $age, $illness = '' ) { //挂号, 填写病人相关信息。（为新病人挂号）
		$step = 0;
		if(!$this->checkLoginState()) {
			return -1 ; die(); //未登录错误
		}
		$data = array('name' => $name, 'gender' => $gender, 'age' => $age, 'illness' => $illness );
		$patient_id = insertPatient($data);
		if($patient_id) {
			$step = 2;
		}else {
			return -2; // 插入病人信息失败
			die();
		}
		$register_price = getTariffBy__(array('name' => '挂号'), 'LIMIT 1');  //获取挂号价格
		if($register_price) {
			$step = 3;
		} else {
			return -3; //获取挂号价格失败
			die();
		}

		$register_data = array('patient_id' => $patient_id, 'patient_name' => $name, 'price' => $register_price['price'],
				'time' => 'NOW()', 'user_id'=> $_SESSION['id'], 'username' => $_SESSION['username']);
		$register_id = insertRegister($register_data); //插入挂号信息

		if($register_id) {
			$step = 4;
		} else {
			return -4; //插入挂号表失败
			die();
		}

		$bill = array('register_id' => $register_id, 'time' => 'NOW()', 'toll_collector' => $_SESSION['username'], 
			'total_price' => $register_price['price'], 'tariffs' => $register_price['id']);
		$bill_id = insertBill($bill); //只要挂号收费，就有收费单。挂号单另外。
		if($bill_id == 0) { //关联表，返回register_id 为0，因为bill表没有自增id列
			$step = 5;
		}else {
			return -5; //生成收费单失败
			die();
		}

		return $step; // 如果返回值=5，表示挂号成功。
	}

	function registerOldPatient($patient_id) { //为老病人挂号（已经有病人信息的，通过病人id号挂号）
		$step = 0;
		if(!$this->checkLoginState()) {
			return -1 ; die(); //未登录错误
		}
		$patient_data = getPatientById($patient_id);
		if($patient_data) {
			$step = 2;
			$name = $patient_data['name'];
		}else {
			return -2;die(); //获取病人信息失败，可能未注册登记
		}

		$register_price = getTariffBy__(array('name' => '挂号'), 'LIMIT 1');  //获取挂号价格
		if($register_price) {
			$step = 3;
		} else {
			return -3; //获取挂号价格失败,可能没有输入挂号价格。
			die();
		}

		$register_data = array('patient_id' => $patient_id, 'patient_name' => $name, 'price' => $register_price['price'],
				'time' => 'NOW()', 'user_id'=> $_SESSION['id'], 'username' => $_SESSION['username']);
		$register_id = insertRegister($register_data); //插入挂号信息

		if($register_id) {
			$step = 4;
		} else {
			return -4; //插入挂号表失败
			die();
		}

		$bill = array('register_id' => $register_id, 'time' => 'NOW()', 'toll_collector' => $_SESSION['username'], 
			'total_price' => $register_price['price']);
		$bill_id = insertBill($bill); //只要挂号收费，就有收费单。而挂号单另外。
		if($bill_id == 0) { //bill表中的register_id字段为外键，不是自增，所以返回register_id 为0
			$step = 5;
		}else {
			return -5; //生成收费单失败
			die();
		}

		return $step; // 如果返回值=5，表示挂号成功。
	}
}


?>
