<?php
if(!defined('MODLES_PATH')) { include_once '../common.php'; }
include_once MODLES_PATH.'/func/register.func.php';
include_once MODLES_PATH.'/func/doctor.func.php';
include_once MODLES_PATH.'/func/medicine.func.php';
include_once MODLES_PATH.'/func/prescribe.func.php';
include_once MODLES_PATH.'/func/doctorvisit.func.php';
include_once MODLES_PATH.'/func/patient.func.php';
include_once MODLES_PATH.'/func/office.func.php';

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
			return $result['id'];
		} else {
			return 0;
		}

	}

	function signOUT() { // 退出
		session_unset();
		return 1;
	}

	function insertIllnessByPatientId($patient_id, $doctor_id, $illness = '', $medicine = '') { 
		$arr_where = array('patient_id' => $patient_id); //
		$register = getRegisterBy__($arr_where, 'LIMIT 1', 'ORDER BY time DESC'); //获取最近挂号信息
		if(!$register) {
			return -1; //病人没有挂号
			die();
		}
		$doctor = getDoctorById($doctor_id);
		$prescirbe_data = array('register_id' => $register['id'], 'patient_name'=>$register['patient_name'],
		  	'doctor_name' => $doctor['name'], 'medicine' => $medicine );
		$pres_id = insertPrescribe($prescirbe_data); //插入处方表，返回处方id

		$doctor_visit = array('id' => $register['id'] , 'doctor_id' => $doctor['id'], 
			'name' => $register['patient_name'], 'illness' => $illness , 'prescription_id' => $pres_id, 'time' => 'NOW()');
		insertDoctorVisit($doctor_visit);
		$updatedata = array('id' => $register['id'], 'state' => 1 ); //将状态设置为1，标志为已处理
		updateRegister($updatedata);
		return 1;
	}

	function getPatientDataById($patient_id) {
		$return = array();
		$arr_where = array('patient_id' => $patient_id );
		$register = getRegisterBy__($arr_where, 'LIMIT 1', 'ORDER BY time DESC'); //获取最近一次挂号信息
		if(!$register) {
			return array();
			die();
		}
		$return['patient_id'] = $register['patient_id']; 
		$patient = getPatientById($patient_id);
		$return['patient_name'] = $patient['name'] ;
		$return['patient_age'] = $patient['age']; 
		$return['patient_gender'] = $patient['gender']; 
		$return['register_time'] = $register['time'];
		$return['illness'] = $patient['illness'];
		$return['register_state'] = $register['state'];
		return $return;

	}

	function getHistoryDiacrisis($patient_id) {
		$return = array();
		$arr_where = array('patient_id' => $patient_id);
		$register = getRegisterBy__($arr_where);
		$in = 'IN (';
		if(is_array($register) ) {
			foreach($register as $key => $value) {
				$in .= $value['id'].',' ;
			}
			$in = substr($in, 0, -1);
			$in .= ')';
		}

		$arr_where = array('id' => $in);
		$docv = getDoctorVisitBy__($arr_where, '', 'ORDER BY time ASC');
		if(is_array($docv)) {
			foreach($docv as $value) {
				$return[$value['prescription_id']]['register_id'] = $value['id'];
				$return[$value['prescription_id']]['illness'] = $value['illness'];
				$office = getOfficeByDoctorId($value['doctor_id']);
				$return[$value['prescription_id']]['office_name'] = $office ? $office['name'] : '' ;
				$return[$value['prescription_id']]['time'] = $value['time'];
			}
		}
		$arr_where = array('register_id' => $in);
		$pre = getPrescribeBy__($arr_where);
		if(is_array($pre)) {
			foreach ($pre as $value) {
				$return[$value['id']]['patient_name'] = $value['patient_name'];
				$return[$value['id']]['doctor_name'] = $value['doctor_name'];
				$return[$value['id']]['medicine'] = $value['medicine'];


			}
		}
		return $return;
	}
 
}

?>
