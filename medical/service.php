<?php
include_once '../common.php';
include_once MAIN_PATH.'/lib/webservicecontrol.class.php';
include_once MEDICAL_PATH.'/func/maincontrol.func.php';
$webserver = new WebServiceControl();
$servername = $namespace = 'medical';
$webserver->initWSDL($servername, $namespace); // 初始化 WSDL
$returntype_mapping = array(
	'patient_id' => 'int',
	'patient_name' => 'string',
	'patient_age'=> 'int',
	'patient_gender' => 'string',
	'register_time' => 'string',
	'illness' => 'string',
	'register_state' => 'int'
);
$patient_history_mapping = array(
	'register_id' => 'int',
	'illness' => 'string',
	'time' => 'string',
	'patient_name' => 'string',
	'doctor_name' => 'string',
	'medicine' => 'string',
	'office_name' => 'stirng'
	);
$webserver->createObjectMappingComplexType('Patient', $returntype_mapping);
$webserver->createObjectMappingComplexType('PatientHistory', $patient_history_mapping);

$input = array('sign_name' => 'xsd:string', 'password' => 'xsd:string');
$output = array('return' => 'xsd:int');
$webserver->qRegisterMethod('signIN', $input, $output, $namespace, '登陆；输入用户名，密码；返回boolean');

$input = array();
$output = array('return' => 'xsd:int');
$webserver->qRegisterMethod('signOUT', $input, $output, $namespace, '退出，清空session：返回id 或 0');

$input = array('patien_id' => 'xsd:int', 'doctor_id' => 'xsd:int', 'illness' => 'xsd:string', 'medicine' => 'xsd:string');
$output = array('return' => 'xsd:int');
$webserver->qRegisterMethod('insertIllnessByPatientId', $input, $output, $namespace, '通过病人id，输入相关信息，返回1为成功');

$input = array('patient_id' => 'xsd:int');
$output = array('return' => 'tns:Patient');
$webserver->qRegisterMethod('getPatientDataById', $input, $output, $namespace, '通过病人ID，获取相关信息');

$input = array('patient_id' => 'xsd:int');
$output = array('return' => 'tns:PatientHistoryArray');
$webserver->qRegisterMethod('getHistoryDiacrisis', $input, $output, $namespace, '通过病人ID，获取病人病史数据');
$webserver->startServer();

?>
