<?php
include_once '../common.php';
include_once MAIN_PATH.'/payment/func/maincontrol.func.php';
include_once MAIN_PATH.'/lib/webservicecontrol.class.php';
$webserver = new WebServiceControl();
$servername = $namespace = 'payment';
$webserver->initWSDL($servername, $namespace); // 初始化 WSDL

$register = new Register();
$return_mapping = $register->getPropertyType();
$webserver->createObjectMappingComplexType('Register', $return_mapping ); //创建复杂数据类型

$patient = new Patient();
$return_mapping = $patient->getPropertyType();
$webserver->createObjectMappingComplexType('Patient', $return_mapping);

$return_mapping = array('id' => 'int', 'name' => 'string', 'price' => 'float', 'remaining_count' => 'int');
$webserver->createObjectMappingComplexType('Medicine', $return_mapping );

$prescribe = new Prescribe();
$return_mapping = $prescribe->getPropertyType();
$webserver->createObjectMappingComplexType('Prescribe', $return_mapping);

$return_mapping = array(
		'patient_id' =>  'int', 
		'patient_name' => 'string', 
		'toll_collector' => 'string',
		'register_time' => 'string',
		'bill_time' => 'string',
		'tariff'=> 'string',
		'total_price' => 'float'
);
$webserver->createObjectMappingComplexType('Bill', $return_mapping);

$return_mapping = array('name' => 'string', 'count' => 'int');
$webserver->createObjectMappingComplexType('MedicineRecord', $return_mapping); //取药记录


$input = array('sign_name' => 'xsd:string', 'password' => 'xsd:string');
$output = array('return' => 'xsd:boolean');
$webserver->qRegisterMethod('signIN', $input, $output, $namespace, '登陆；输入用户名，密码；返回boolean');

$input = array();
$output = array('return' => 'xsd:boolean');
$webserver->qRegisterMethod('signOUT', $input, $output, $namespace, '退出，清空session：返回boolean');

$input = array('name'=>'xsd:string', 'gender' => 'xsd:string', 'age'=>'xsd:int', 'illness'=>'xsd:string');
$output = array('return' => 'xsd:int');
$webserver->qRegisterMethod('registerNewPatient', $input, $output, $namespace, '为新病人挂号，输入相关信息，返回病人ID（大于0）为成功');

$input = array('patient_id' => 'xsd:int');
$output = array('return' => 'xsd:int');
$webserver->qRegisterMethod('registerOldPatient', $input, $output, $namespace, '为旧病人挂号，不需要填写病人信息，输入病人id; 返回5为成功');

$input = array();
$output = array('return' => 'tns:MedicineArray');
$webserver->qRegisterMethod('getAllMedicine', $input, $output, $namespace, '获取所有药物信息');

$input = array('patient_id' => 'xsd:int');
$output = array('return' => 'tns:Register');
$webserver->qRegisterMethod('getRegisterByPatientId', $input, $output, $namespace, '根据病人ID，获取该病人刚挂号的挂号单信息，没有返回0，挂号单已处理也返回0,所以再次挂号才能获得挂号信息');


$output = array('return' => 'tns:Patient');
$webserver->qRegisterMethod('getPatientById', $input, $output, $namespace, '根据病人ID，获取病人信息');

$output = array('return'=> 'tns:PrescribeArray');
$webserver->qRegisterMethod('getPrescribeByPatientId', $input, $output, $namespace, '根据病人ID，获取其最近挂号的处方信息，返回处方数组或者空');

$output = array('return' => 'tns:Bill');
$webserver->qRegisterMethod('getFinalBillByPatientId', $input, $output, $namespace, '根据病人ID获取最终的收费单信息');

$input = array('patient_id' => 'xsd:int', 'total_medical_price' => 'xsd:float');
$output = array('return' => 'xsd:int');
$webserver->qRegisterMethod('insertTotalMedicalPriceToBill', $input, $output, $namespace, '根据病人ID，将药品总价加入收费单据，成功返回1，否则为0');

$input = array('patient_id' => 'xsd:int', 'medicine_record' => 'tns:MedicineRecordArray');
$output = array('return' => 'xsd:int');
$webserver->qRegisterMethod('recordTakeMedicineData', $input, $output, $namespace, '根据病人ID，记录其取药信息，并更新药品剩余数量，如果取药数量大于药品剩余数量返回0，如果没有处方信息也返回0，成功返回1，需要参数：病人ID，药品记录数组');


$webserver->startServer();

?>
