<?php
/**
 * This File Register The Method Which Want To Be Public For Web Service And
 * Generate The WSDL 
 */
include_once '../common.php'; 
include_once 'lib/webservicecontrol.class.php';  // Because include common.php,It change the include_path depend on it
include_once MODLES_PATH.'/func/patient.func.php'; //Include The Function Which Want To Be  A Public Service 
//error_reporting(0);
$webserver = new WebServiceControl();
$servername = $namespace = 'payment';
$webserver->initWSDL($servername, $namespace); // 初始化 WSDL


$patient = new Patient();
$propertytype_mapping = $patient->getPropertyType(); //获取对象每个属性的类型

/**
 * 创建自定义结构
 * 将对象属性映射为WSDL可识别的结构（创建传递对象类型，如果包含多个对象，将自动转化为对象数组传递）
 */
$webserver->createObjectMappingComplexType('Patient', $propertytype_mapping);

$input = array('id'=> 'xsd:int'); //系统内部类型用 xsd: 区别
$output = array('return' => 'tns:Patient'); //自定义结构用 tns: 区别
$webserver->qRegisterMethod('getPatientById' , $input, $output, $namespace, '根据id获取的病人信息'); // 注册公开函数

$input = array();
$output = array('return' => 'tns: PatientArray'); //返回的是Patient数组，为了方便，这里将语法规定这么写: [ObjectName]Array
$webserver->qRegisterMethod('getAllPatient', $input, $output, $namespace, '获取所有病人信息');

$input = array('data' => 'tns:Patient');
$output = array('return' => 'xsd:int');
$webserver->qRegisterMethod('insertPatient', $input, $output, $namespace, '添加病人信息');

$input = array('data' => 'tns:Patient');
$output = array('return' => 'xsd:boolean');
$webserver->qRegisterMethod('updatePatient', $input, $output, $namespace, '修改病人信息');

$input = array('id' => 'xsd:int');
$output = array('return' => 'xsd:boolean');
$webserver->qRegisterMethod('deletePatientById', $input, $output, $namespace, '根据id, 删除病人信息');


$webserver->startServer(); //开始webService服务

?>
