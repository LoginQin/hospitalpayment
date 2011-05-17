<?php
if(!defined('MODLES_PATH')) { include_once '../common.php'; }
include_once MODLES_PATH.'/func/register.func.php';
include_once MODLES_PATH.'/func/doctor.func.php';
include_once MODLES_PATH.'/func/medicine.func.php';
include_once MODLES_PATH.'/func/prescribe.func.php';
include_once MODLES_PATH.'/func/doctorvisit.func.php';

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
		$arr_where = array ('sign_name' => $sign_name, 'password' => $password );
		$result = getDoctorBy__($arr_where, 'LIMIT 1');
		if($result) {
			$_SESSION['id']  = $result['id'];
			$_SESSION['name'] = $result['name']; //医生姓名
			$_SESSION['username'] = $result['sign_name']; //医生登陆名称
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

	function insertIllnessByPatientId($patient_id, $illness = '', $medicine = '') { 
		$arr_where = array('patient_id' => $patient_id, 'state' => 0); //查出已挂号并且未处理的挂号单，如果没有状态，病人挂一次号，可以无限次看病
		$register = getRegisterBy__($arr_where, 'LIMIT 1'); //获取挂号信息
		if(!$register) {
			return -1; //病人没有挂号，或则挂号信息是已处理过的信息
			die();
		}

		$prescirbe_data = array('register_id' => $register['id'], 'patient_name'=>$register['patient_name'],  'doctor_name' => $_SESSION['name'], 'medicine' => $medicine );
		$pres_id = insertPrescribe($prescirbe_data); //插入处方表，返回处方id

		$doctor_visit = array('id' => $register['id'] , 'doctor_id' => $_SESSION['id'], 'name' => $_SESSION['name'], 'illness' => $illness , 'prescription_id' => $pres_id);
		insertDoctorVisit($doctor_visit);
		$updatedata = array('id' => $register['id'], 'state' => 1 ); //将状态设置为1，标志为已处理
		updateRegister($updatedata);
		return 1;
	}

}

?>
