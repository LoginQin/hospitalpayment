<?php
if(!defined('MODLES_PATH')) { include_once '../common.php'; }
include_once MODLES_PATH.'/func/register.func.php';
include_once MODLES_PATH.'/func/doctor.func.php';
include_once MODLES_PATH.'/func/medicine.func.php';
include_once MODLES_PATH.'/func/prescribe.func.php';
include_once MODLES_PATH.'/func/doctorvisit.func.php';
include_once MODLES_PATH.'/func/patient.func.php';
include_once MODLES_PATH.'/func/office.func.php';
include_once MODLES_PATH.'/func/bill.func.php';
include_once MODLES_PATH.'/func/takemedicine.func.php';
include_once MODLES_PATH.'/func/user.func.php';
include_once MODLES_PATH.'/func/tariff.func.php';
include_once MODLES_PATH.'/func/isdate.func.php';

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
	function checkTableByTableName($table_name){
			function for_each($str){
			foreach($str as $v1)
			{   
				echo "<tr>";
				foreach($v1 as $v2){
					echo "<td>".$v2."</td>";					
			}
				echo "</tr>";
	        }
		}
			switch($table_name){
				case 'bills': 
					$bills = getAllBill();
					echo "<table align='center' bordercolor='#EAEAEA' border='1'>";
					echo "<tr>";
						echo "<td bgcolor='#EAEAEA'>挂号ID</td>";
						echo "<td bgcolor='#EAEAEA'>挂号时间</td>";
						echo "<td bgcolor='#EAEAEA'>病人姓名</td>";
						echo "<td bgcolor='#EAEAEA'>经手人ID</td>";
						echo "<td bgcolor='#EAEAEA'>医生ID</td>";
						echo "<td bgcolor='#EAEAEA'>收费项目ID</td>";
						echo "<td bgcolor='#EAEAEA'>总价格</td>";
					echo "</tr>"; 
					for_each($bills);
					echo "</table>";
					break;
				case 'doctors': 
					$doctors = getAllDoctor();
					echo "<table align='center' bordercolor='#EAEAEA' border='1'>";
					echo "<tr>";
						echo "<td bgcolor='#EAEAEA'>编号</td>";
						echo "<td bgcolor='#EAEAEA'>姓名</td>";
						echo "<td bgcolor='#EAEAEA'>职位</td>";
						echo "<td bgcolor='#EAEAEA'>科室号</td>";
						echo "<td bgcolor='#EAEAEA'>用户名</td>";
						echo "<td bgcolor='#EAEAEA'>密码</td>";
					echo "</tr>"; 
					foreach($doctors as $v1)
					{   
						echo "<tr>";
						foreach($v1 as $v2){
								echo "<td>".$v2."</td>";
								
							}
						echo "</tr>";
					};
					echo "</table>";
					break;
				case 'doctorvisiting': 
					$doctorvisit = getAllDoctorVisit();
					echo "<table align='center' bordercolor='#EAEAEA' border='1'>";
					echo "<tr>";
						echo "<td bgcolor='#EAEAEA'>挂号ID</td>";
						echo "<td bgcolor='#EAEAEA'>医生ID</td>";
						echo "<td bgcolor='#EAEAEA'>病人姓名</td>";
						echo "<td bgcolor='#EAEAEA'>病症</td>";
						echo "<td bgcolor='#EAEAEA'>处方ID</td>";
						echo "<td bgcolor='#EAEAEA'>就诊时间</td>";
					echo "</tr>"; 
					for_each($doctorvisit);
					echo "</table>";
					break;

				case 'medicines': 
					$medicines = getAllMedicine();
					echo "<table align='center' bordercolor='#EAEAEA' border='1'>";
					echo "<tr>";
						echo "<td bgcolor='#EAEAEA'>药品ID</td>";
						echo "<td bgcolor='#EAEAEA'>药品名称</td>";
						echo "<td bgcolor='#EAEAEA'>单价</td>";
						echo "<td bgcolor='#EAEAEA'>库存</td>";
					echo "</tr>"; 
					for_each($medicines);
					echo "</table>";
					break;
				case 'offices': 
					$offices = getAllOffice();
					echo "<table align='center' bordercolor='#EAEAEA' border='1'>";
					echo "<tr>";
						echo "<td bgcolor='#EAEAEA'>科室号</td>";
						echo "<td bgcolor='#EAEAEA'>科室名称</td>";
						echo "<td bgcolor='#EAEAEA'>类别</td>";
					echo "</tr>"; 
					for_each($offices);
					echo "</table>";
					break;
				case 'patients': 
					$patients = getAllPatient();
					echo "<table align='center' bordercolor='#EAEAEA' border='1'>";
					echo "<tr>";
						echo "<td bgcolor='#EAEAEA'>病人ID</td>";
						echo "<td bgcolor='#EAEAEA'>病人姓名</td>";
						echo "<td bgcolor='#EAEAEA'>性别</td>";
						echo "<td bgcolor='#EAEAEA'>年龄</td>";
						echo "<td bgcolor='#EAEAEA'>病症</td>";
					echo "</tr>"; 
					for_each($patients);
					echo "</table>";
					break;
				case 'prescribes': 
					$prescribes = getAllPrescribe();
					echo "<table align='center' bordercolor='#EAEAEA' border='1'>";
					echo "<tr>";
						echo "<td bgcolor='#EAEAEA'>处方ID</td>";
						echo "<td bgcolor='#EAEAEA'>挂号ID</td>";
						echo "<td bgcolor='#EAEAEA'>病人姓名</td>";
						echo "<td bgcolor='#EAEAEA'>医生姓名</td>";
						echo "<td bgcolor='#EAEAEA'>处方</td>";
					echo "</tr>"; 
					for_each($prescribes);
					echo "</table>";
					break;
				case 'registers': 
					$registers = getAllRegister();
					echo "<table align='center' bordercolor='#EAEAEA' border='1'>";
					echo "<tr>";
						echo "<td bgcolor='#EAEAEA'>挂号ID</td>";
						echo "<td bgcolor='#EAEAEA'>病人ID</td>";
						echo "<td bgcolor='#EAEAEA'>病人姓名</td>";
						echo "<td bgcolor='#EAEAEA'>挂号价格</td>";
						echo "<td bgcolor='#EAEAEA'>挂号时间</td>";
						echo "<td bgcolor='#EAEAEA'>经手人ID</td>";
						echo "<td bgcolor='#EAEAEA'>经手人姓名</td>";
						echo "<td bgcolor='#EAEAEA'>处理状态</td>";
					echo "</tr>";
					for_each($registers);
					echo "</table>";
					break;
				case 'takemedicines': 
					$takemedicines = getAllTakeMedicine();
					echo "<table align='center' bordercolor='#EAEAEA' border='1'>";
					echo "<tr>";
						echo "<td bgcolor='#EAEAEA'>取药ID</td>";
						echo "<td bgcolor='#EAEAEA'>处方ID</td>";
						echo "<td bgcolor='#EAEAEA'>病人姓名</td>";
						echo "<td bgcolor='#EAEAEA'>总价</td>";
					echo "</tr>";
					for_each($takemedicines);
					echo "</table>";
					break;
				case 'tariff': 
					$tariff = getAllTariff();
					echo "<table align='center' bordercolor='#EAEAEA' border='1'>";
					echo "<tr>";
						echo "<td bgcolor='#EAEAEA'>收费项目ID</td>";
						echo "<td bgcolor='#EAEAEA'>收费项目</td>";
						echo "<td bgcolor='#EAEAEA'>收费价格</td>";
					echo "</tr>"; 
					for_each($tariff);
					echo "</table>";
					break;
				case 'users': 
					$users = getAllUser();
					echo "<table align='center' bordercolor='#EAEAEA' border='1'>";
					echo "<tr>";
						echo "<td bgcolor='#EAEAEA'>用户ID</td>";
						echo "<td bgcolor='#EAEAEA'>用户名</td>";
						echo "<td bgcolor='#EAEAEA'>密码</td>";
						echo "<td bgcolor='#EAEAEA'>权限</td>";
					echo "</tr>"; 
					for_each($users);
					echo "</table>";
					break;
			}
 	}
	function getAllDoctorTotalPrices($time){
			$result = getAllDoctorTotalPrice($time);
			if(count($result)==0) echo "<div align = 'center'>查无此类记录</div>";
			else {
				echo "<table align='center' bordercolor='#EAEAEA' border='1'>";
				echo "<tr>";
					echo "<td bgcolor='#EAEAEA'>医生姓名</td>";
					echo "<td bgcolor='#EAEAEA'>就诊人数</td>";
					echo "<td bgcolor='#EAEAEA'>日总收入</td>";
					echo "<td bgcolor='#EAEAEA'>时间</td>";
				echo "</tr>"; 
				foreach($result as $v1)
					{   
						echo "<tr>";
						foreach($v1 as $v2){
							echo "<td>".$v2."</td>";					
					}
						echo "</tr>";
					}
					echo "</table>";
				}
		}
	function getpricebyoffice($time){
			$result = getpricebyoffice($time);
			if(count($result)==0) echo "<div align = 'center'>查无此类记录</div>";
			else {
				echo "<table align='center' bordercolor='#EAEAEA' border='1'>";
				echo "<tr>";
					echo "<td bgcolor='#EAEAEA'>科室</td>";
					echo "<td bgcolor='#EAEAEA'>日总收入</td>";
					echo "<td bgcolor='#EAEAEA'>就诊人数</td>";
					echo "<td bgcolor='#EAEAEA'>时间</td>";
				echo "</tr>"; 
				foreach($result as $v1)
					{   
						echo "<tr>";
						foreach($v1 as $v2){
							echo "<td>".$v2."</td>";					
					}
						echo "</tr>";
					}
				echo "</table>";
				}
		}
	function getpricebydate($time,$time1){
			$result = getpricebydate($time,$time1);
			if(count($result)==0) echo "<div align = 'center'>查无此类记录</div>";
			else {
				echo "<table align='center' bordercolor='#EAEAEA' border='1'>";
				echo "<tr>";
					echo "<td bgcolor='#EAEAEA'>日期</td>";
					echo "<td bgcolor='#EAEAEA'>日总收入</td>";
					echo "<td bgcolor='#EAEAEA'>就诊人数</td>";
					
				echo "</tr>"; 
				foreach($result as $v1)
					{   
						echo "<tr>";
						foreach($v1 as $v2){
							echo "<td>".$v2."</td>";					
					}
						echo "</tr>";
					}
				echo "</table>";
				}
		}
}
?>