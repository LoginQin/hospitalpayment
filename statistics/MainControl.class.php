<?php
if(!defined('MODLES_PATH')) { include_once '../common.php'; }
include_once MODLES_PATH.'/func/medicine.func.php';
include_once MODLES_PATH.'/func/user.func.php';
include_once MODLES_PATH.'/func/tariff.func.php';
include_once MODLES_PATH.'/func/isdate.func.php';
include_once MODLES_PATH.'/func/statistics.func.php';

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
	$arr_where = array ('username' => $sign_name, 'password' => $password , 'power' => 0);
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

function checkTarff(){
	$tariff = getAllTariff();
	if(count($tariff)==0) return array();
	else return $tariff;
}
function checkMedicines(){
	$medicines = getAllMedicine();
	if(count($medicines)==0) return array();
	else return $medicines;
}
function getAllDoctorTotalPrices($time){
		$result = getAllDoctorTotalPrice($time);
		if(count($result)==0) return array();
		else return $result;
	}
function getpricebyoffice($time){
		$result = getpricebyoffice($time);
		if(count($result)==0) return array();
		else{ 
				$a=0;
				foreach ($result as $v1){
					foreach ($v1 as $k => $v2){
						 if($k == 'count(*)') $a+=$v2;
					}
				}
				foreach($result as $k3 => $v3)
				{
					foreach($v3 as $k4 => $v4)
					{
						if($k4 == 'count(*)') $result[$k3]['contrast'] = number_format($v4 / $a,3);
					}
				}	
			return $result;
			}	
	}

function getpricebydate($time,$time1){
		$result = getpricebydate($time,$time1);
		$num_result = getpatientnum($time,$time1);
		$register_result = getpricebyregister($time,$time1);
		$count_num_result = count($num_result);
		if(count($result)==0) return array();
		else
		{	
			$k = 0;
			$k1 = 0;
			$k4 = 0;
			foreach($result as $k2 => $v2)
			{//如果挂号的日期和就诊日期不同 则本日就诊病人为空，即result数组指针前移，而num_result数组不移动，知道两者日期相同为止；
				if($k1 < $count_num_result && $result[$k2]['date(time)'] == $num_result[$k1]['date(time)'])
				{
					$result[$k2]['patient_num'] = $num_result[$k1]['count(distinct id)'];
					$k1++;
				}
				else
				{
					$result[$k2]['patient_num'] = 0;
				}
			}
			foreach($result as $k3 => $v3)
			{		
					$result[$k3]['price_contrast'] =number_format($result[$k3]['sum(total_price)'] /$result[0]['sum(total_price)'], 3);
					$result[$k3]['num_contrast'] = $result[0]['patient_num']!=0 ? number_format($result[$k3]['patient_num'] /$result[0]['patient_num'],3):'∞' ;	
					//如果挂号的日期和就诊日期不同 则本日掉诊人数为空，即register_result数组指针前移，而num_result数组不移动，知道两者日期相同为止；
					if($k < $count_num_result && $register_result[$k]['date(time)'] == $num_result[$k4]['date(time)'])
					{
						$result[$k3]['out_num'] = $register_result[$k]['count(*)'] - $num_result[$k4]['count(distinct id)'];
						$result[$k3]['out_rate'] =  number_format(($register_result[$k]['count(*)'] - $num_result[$k4]['count(distinct id)']) / $register_result[$k]['count(*)'],3);
						$k++;
						$k4++;
					}
					else
					{
						$result[$k2]['out_num'] = $register_result[$k]['count(*)'];
						$result[$k2]['out_rate'] = '1.000';
						$k++;
					}									
			}	
			return $result;
		}
	}
function getpricebyregister($time,$time1){
		$result = getpricebyregister($time,$time1);
		$num_result = getpatientnum($time,$time1);
		$count_result = count($result);
		$count_num_result = count($num_result);
		if(count($result)==0) return array();
		else
		{
			$k2 = 0;
			$k3 = 0;
			while ($k2 < $count_result)
			{
					$result[$k2]['price_contrast'] = number_format($result[$k2]['sum(price)'] /$result[0]['sum(price)'],3);
					$result[$k2]['num_contrast'] = number_format($result[$k2]['count(*)'] /$result[0]['count(*)'],3);
					//如果挂号的日期和就诊日期不同 则本日掉诊人数为空，即result数组指针前移，而num_result数组不移动，知道两者日期相同为止；
					if($k3 < $count_num_result && $result[$k2]['date(time)'] == $num_result[$k3]['date(time)'])
					{
						$result[$k2]['out_num'] = $result[$k2]['count(*)'] - $num_result[$k3]['count(distinct id)'];
						$result[$k2]['out_rate'] = number_format(($result[$k2]['count(*)'] - $num_result[$k3]['count(distinct id)']) / $result[$k2]['count(*)'],3);
						$k3++;
					}
					else
					{
						$result[$k2]['out_num'] = $result[$k2]['count(*)'];
						$result[$k2]['out_rate'] = '1.000';
					}
				$k2++;
			}
			return $result;
		}
	}
}
?>
