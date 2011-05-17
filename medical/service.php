<?php
include_once '../common.php';
include_once MAIN_PATH.'/lib/webservicecontrol.class.php';
include_once MEDICAL_PATH.'/func/maincontrol.func.php';
$webserver = new WebServiceControl();
$servername = $namespace = 'medical';
$webserver->initWSDL($servername, $namespace); // 初始化 WSDL
$input = array('sign_name' => 'xsd:string', 'password' => 'xsd:string');
$output = array('return' => 'xsd:boolean');
$webserver->qRegisterMethod('signIN', $input, $output, $namespace, '登陆；输入用户名，密码；返回boolean');

$input = array();
$output = array('return' => 'xsd:boolean');
$webserver->qRegisterMethod('signOUT', $input, $output, $namespace, '退出，清空session：返回boolean');

$input = array('patien_id' => 'xsd:int', 'illness' => 'xsd:string', 'medicine' => 'xsd:string');
$output = array('return' => 'xsd:int');
$webserver->qRegisterMethod('insertIllnessByPatientId', $input, $output, $namespace, '通过病人id，输入相关信息，返回1为成功');

$webserver->startServer();

?>
