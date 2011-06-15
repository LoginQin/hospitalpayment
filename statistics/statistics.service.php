<?php
include_once '../common.php';
include_once MAIN_PATH.'/lib/webservicecontrol.class.php';
include_once STATISTICS_PATH.'/func/maincontrol.func.php';
$webserver = new WebServiceControl();
$servername = $namespace = 'statistics';
$webserver->initWSDL($servername, $namespace); // 初始化 WSDL
//$returntype_mapping = array(
//	'patient_id' => 'int',
//	'patient_name' => 'string',
//	'patient_age'=> 'int',
//	'patient_gender' => 'string',
//	'register_time' => 'string',
//	'illness' => 'string',
//	'register_state' => 'int'
//);
$check_tarff = array(
	'id' => 'int',
	'name' => 'varchar',
	'price' => 'float'
	);
$check_medicines = array(
	'id' => 'int',
	'name' => 'varchar',
	'price' => 'float',
	'remaining_count' => 'int'
	);
$check_by_doctor = array(
	'name' => 'varchar',
	'count(*)' => 'int',
	'sum(total_price)' => 'float',
	'date(time)' => 'datetime'
	);
$check_by_office = array(
	'name' => 'varchar',
	'sum(total_price)' => 'float',
	'count(*)' => 'int',
	'date(time)' => 'datetime'
	);
$get_price_by_date = array(
	'date(time)' => 'datetime',
	'sum(total_price)' => 'float',
	'count(*)' => 'int',
	'price_contrast' => 'float',
	'num_contrast' => 'float'
	);
$get_price_by_register = array(
	'date(time)' => 'datetime',
	'sum(price)' => 'float',
	'count(*)' => 'int',
	'price_contrast' => 'float',
	'num_contrast' => 'float',
	'rate' => 'float'
	);

//$webserver->createObjectMappingComplexType('PatientHistory', $patient_history_mapping);
$webserver->createObjectMappingComplexType('gettarff', $check_tarff);//'gettarff'为定义的类型，像int，sting
$webserver->createObjectMappingComplexType('getmedicines', $check_medicines);
$webserver->createObjectMappingComplexType('checkbydoctor', $check_by_doctor);
$webserver->createObjectMappingComplexType('checkbyoffice', $check_by_office);
$webserver->createObjectMappingComplexType('checkbydate', $get_price_by_date);
$webserver->createObjectMappingComplexType('checkbyregister', $get_price_by_register);

$input = array('sign_name' => 'xsd:string', 'password' => 'xsd:string');
$output = array('return' => 'xsd:boolean');
$webserver->qRegisterMethod('signIN', $input, $output, $namespace, '登陆；输入用户名，密码；返回boolean');

$input = array();
$output = array('return' => 'xsd:boolean');
$webserver->qRegisterMethod('signOUT', $input, $output, $namespace, '退出，清空session：返回id 或 0');

$input = array();
$output = array('return' => 'tns:gettarff');
$webserver->qRegisterMethod('checkTarff', $input, $output, $namespace, '查询，获取收费价目');

$input = array();
$output = array('return' => 'tns:getmedicines');
$webserver->qRegisterMethod('checkMedicines', $input, $output, $namespace, '查询，获取药品信息');

$input = array('time' => 'xsd:datetime');
$output = array('return' => 'tns:checkbydoctor');
$webserver->qRegisterMethod('getAllDoctorTotalPrices', $input, $output, $namespace, '输入时间，获取按照医生分类的统计信息');

$input = array('time' => 'xsd:datetime');
$output = array('return' => 'tns:checkbyoffice');
$webserver->qRegisterMethod('getpricebyoffice', $input, $output, $namespace, '输入时间，获取按照科室分类的统计信息');

$input = array('time' => 'xsd:datetime','time1' => 'xsd:datetime');
$output = array('return' => 'tns:checkbydate');
$webserver->qRegisterMethod('getpricebydate', $input, $output, $namespace, '输入时间，获取按照日期分类的统计信息');

$input = array('time' => 'xsd:datetime','time1' => 'xsd:datetime');
$output = array('return' => 'tns:checkbyregister');
$webserver->qRegisterMethod('getpricebyregister', $input, $output, $namespace, '输入时间，获取按照挂号分类的统计信息');


$webserver->startServer();

?>
