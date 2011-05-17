<?php
/**
 * This File Register The Method Which Want To Be Public For Web Service And
 * Generate The WSDL 
 */
include_once '../common.php'; 
include_once 'lib/nusoap.php';  // Because include common.php,It change the include_path depend on it
include_once MODLES_PATH.'/func/patient.func.php';
//error_reporting(0);
$server = new soap_server();
$servername = $namespace = 'payment';
initWSDL($server, $servername, $namespace);

$propertytype_mapping = array(
		'id' => 'string',
		'name' => 'string',
		'gender' =>'string',
		'age' =>'int',
		'illness' => 'string'
	);

createObjectMappingComplexType($server, 'Patient', $propertytype_mapping);

$input = array('id'=> 'xsd:int');
$output = array('return' => 'tns:Patient');
qRegisterMethod($server, 'getPatientById' , $input, $output, $namespace, '根据id获取的病人信息');

$input = array();
$output = array('return' => 'tns: PatientArray');
qRegisterMethod($server, 'getAllPatient', $input, $output, $namespace, '获取所有病人信息');

$input = array('data' => 'tns:Patient');
$output = array('return' => 'xsd:int');
qRegisterMethod($server,'insertPatient', $input, $output, $namespace, '添加病人信息');

$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA);





function initWSDL(&$server, $servername, $namespace) {
	$server->configureWSDL($servername, 'urn:'.$namespace);
	$server->wsdl->schemaTargetNamespace = 'urn:'.$namespace;
	$server->soap_defencoding='UTF-8'; 
	$server->xml_encoding='UTF-8';
	$server->decode_utf8=false;
}



function qRegisterMethod(&$server, $methodname, $input, $output, $namespace, $messages) {
	$server->register(
		$methodname,
		$input,
		$output,
		'urn:'.$namespace,
		'urn:'.$namespace.'#'.$methodname,
		'rpc',
		'encoded',
		$messages

	);
}

function createObjectMappingComplexType (&$server, $objectname, $propertytype_mapping ) {
	$name_type = array();
	foreach($propertytype_mapping as $property => $type ) {
		$name_type[$property] = array('name' => $property, 'type' => 'xsd:'.$type);
	}
	$server->wsdl->addComplexType(
		$objectname,
		'complexType',
		'struct',
		'sequence',
		'',
		$name_type
	);

	$server->wsdl->addComplexType(
		$objectname.'Array',
		'complexType',
		'array',
		'',
		'SOAP-ENC:Array',
		array(),
		array(
			array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:'.$objectname.'[]')
		),
		'tns:'.$objectname
	);

}

?>
