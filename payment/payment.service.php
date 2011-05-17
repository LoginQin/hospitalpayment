<?php
include_once '../common.php';
include_once MAIN_PATH.'/payment/func/maincontrol.func.php';
include_once MAIN_PATH.'/lib/webservicecontrol.class.php';
$webserver = new WebServiceControl();
$servername = $namespace = 'payment';
$webserver->initWSDL($servername, $namespace); // 初始化 WSDL
$input = array('sign_name' => 'xsd:string', 'password' => 'xsd:string');
$output = array('return' => 'xsd:boolean');
$webserver->qRegisterMethod('signIN', $input, $output, $namespace, '登陆；输入用户名，密码；返回boolean');

$input = array();
$output = array('return' => 'xsd:boolean');
$webserver->qRegisterMethod('signOUT', $input, $output, $namespace, '退出，清空session：返回boolean');

$input = array('name'=>'xsd:string', 'gender' => 'xsd:string', 'age'=>'xsd:int', 'illness'=>'xsd:string');
$output = array('return' => 'xsd:int');
$webserver->qRegisterMethod('registerNewPatient', $input, $output, $namespace, '为新病人挂号，输入相关信息，返回5为成功');

$input = array('patient_id' => 'xsd:int');
$output = array('return' => 'xsd:int');
$webserver->qRegisterMethod('registerOldPatient', $input, $output, $namespace, '为旧病人挂号，不需要填写病人信息，输入病人id; 返回5为成功');



$webserver->startServer();

?>