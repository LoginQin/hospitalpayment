<?php
include_once "../common.php";
include_once MODLES_PATH.'/func/user.func.php'; //获取数据层函数, 这里用本地调用方法，本应该是作为远程调用的
include_once MODLES_PATH.'/func/patient.func.php';
include_once MODLES_PATH.'/func/tariff.func.php';
include_once MODLES_PATH.'/func/register.func.php';
include_once MODLES_PATH.'/func/bill.func.php';
include_once MODLES_PATH.'/func/medicine.func.php';
include_once MODLES_PATH.'/func/prescribe.func.php';
include_once MODLES_PATH.'/func/takemedicine.func.php';
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
				session_unset();
				return 1;
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

				$bill = array('register_id' => $register_id, 'time' => 'NOW()', 'patient_name' => $name, 'toll_collector' => $_SESSION['username'], 
						'total_price' => $register_price['price'], 'tariffs' => $register_price['id']);
				$bill_id = insertBill($bill); //只要挂号收费，就有收费单。挂号单另外。
				if($bill_id == 0) { //关联表，返回register_id 为0，因为bill表没有自增id列
						$step = 5;
				}else {
						return -5; //生成收费单失败
						die();
				}

				return  $patient_id ; // 如果step值=5，表示挂号成功。返回病人挂号ID
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

				$bill = array('register_id' => $register_id, 'time' => 'NOW()', 'patient_name' => $name, 'toll_collector' => $_SESSION['username'], 
						'tariffs' => $register_price['id'], 
						'total_price' => $register_price['price'] );
				$bill_id = insertBill($bill); //只要挂号收费，就有收费单。而挂号单另外。
				if($bill_id == 0) { //bill表中的register_id字段为外键，不是自增，所以返回register_id 为0
						$step = 5;
				}else {
						return -5; //生成收费单失败
						die();
				}

				return $step; // 如果返回值=5，表示挂号成功。
		}

		function getPrescribeByPatientId($patient_id) {
				$prescribe = array();
				$register = getRegisterByPatientId($patient_id); //获取病人挂号ID，注意这里是最近一次挂号的ID，
														   		//因为一个病人可以挂很多次号，结帐肯定结最近一次
				if($register) { 
						$arr_where = array('register_id' => $register['id']);
						$prescribe = getPrescribeBy__($arr_where); //根据最近的挂号ID获取到本次挂号的处方表
																	//，注意这里，同一次挂号可能有多个医生对其诊断，所以获取的处方是多个处方
				} 
				return $prescribe ? $prescribe : array();

		}

		function insertTotalMedicalPriceToBill($patient_id, $total_medical_price) {
				$register = getRegisterByPatientId($patient_id);
				$return = 0;
				if($register) {
					$arr_where = array('register_id' => $register['id']);
					$originalbill = getBillById($register['id']);
					$price = (float)$originalbill['total_price'] + (float)$total_medical_price;
					$data = array('register_id'=> $register['id'], 'total_price' => $price);
					$result = updateBill($data);
					$return = $result ? 1 : 0;
				}
				return $return;

		}

		private	function __insertTakeMedicine($patient_id, $medicine) { //插入取药表,medicine为二维数组
				$prescribe = $this->getPrescribeByPatientId($patient_id);
				$result = 0;
				if($prescribe && is_array($medicine)) {
						foreach($medicine as $value) {
								$value['register_id'] =  $prescribe[0]['register_id'];
								insertTakeMedicine($value);
						}
						$result = 1;
				}
				return $result ;
		}

		private	function __updateMedicine($name, $takecount) { //更新药品信息
				$medicine = getMedicineBy__(array('name' => $name), 'LIMIT 1');
				$return = 0;
				if($medicine) {
						$medicine['remaining_count'] = (int)$medicine['remaining_count'] - (int)$takecount;
						if($medicine['remaining_count'] > 0) {
								$return = updateMedicine($medicine) ? 1 : 0;
						}else {
								$return = 0;
						}
				}
				return $return;
		}

		function recordTakeMedicineData($patient_id, $medicine ) { //取药动作，包含更新药品信息和记录取药信息,medicine二维数组
				$update = 0;
				$result = 0;
				$medicine_count = count($medicine);
				$prescribe = $this->getPrescribeByPatientId($patient_id); //判断有没有处方信息，没有处方信息则取药无效
				if($prescribe != NULL  && $medicine_count > 0 ){
						foreach ( $medicine as $value) {
								$update += $this->__updateMedicine($value['name'], $value['count']);
						}
						if($update == $medicine_count) {
								$insert = $this->__insertTakeMedicine($patient_id, $medicine) ;
						}
						if($insert) $result = 1;
				}
				return $result;
			
		}

		function getFinalBillByPatientId($patient_id) {
				date_default_timezone_set('PRC');
				$register = getRegisterByPatientId($patient_id);
				$final_bill = array();
				if($register) { 
						$takemedicine = getTakeMedicineBy__(array('register_id' => $register['id']));
						$bill = getBillById($register['id']);
						$IN = 'IN('.$bill['tariffs'].')';
						$tariff = getTariffBy__(array('id' => $IN ));
						if($bill && $tariff) {
								$str_tariff ='';
								foreach($tariff as  $value) {
										$str_tariff .= ' | '.$value['name'].' : '. $value['price'].'元 ';
								}
								if(is_array($takemedicine)) {
										foreach($takemedicine as $value) {
										 	$str_tariff .= ' | '.$value['name'].' X'.$value['count'].' ';
										}
								}
								$final_bill = array(
										'patient_id' =>  $patient_id, 
										'patient_name' => $bill['patient_name'], 
										'toll_collector' => $bill['toll_collector'],
										'register_time' => $bill['time'],
										'bill_time' => date('Y-m-d H:i:s'),
										'tariff'=> $str_tariff,
										'total_price' => $bill['total_price']
								);

						}
				}
				return $final_bill;

		}


}



?>
