<?php
/**
 * This File Register The Method Which Want To Be Public For Web Service And
 * Generate The WSDL 
 */
include_once ('../common.php'); 
include_once ('lib/nusoap.php');  // Because include common.php,It change the include_path depend on it
include_once (MODLES_PATH.'/func/user.func.php');
//error_reporting(0);
$server = new soap_server();
$server->configureWSDL('payment', 'urn:payment');
$server->wsdl->schemaTargetNamespace = 'urn:payment';
$server->soap_defencoding='UTF-8'; 
$server->xml_encoding='UTF-8';
$server->decode_utf8=false;

$server->wsdl->addComplexType(
	'User',
	'complexType',
	'struct',
	'sequence',
	'',
	array(
		'id' => array('name' => 'id', 'type' => 'xsd:string'),
		'username' => array( 'name' => 'username','type' =>'xsd:string'),
		'password' => array( 'name' => 'password', 'type' =>'xsd:string'),
		'power' => array( 'name'=> 'power', 'type' => 'xsd:int')

	)
);
$server->wsdl->addComplexType(
	'UserArray',
	'complexType',
	'array',
	'',
	'SOAP-ENC:Array',
	array(),
	array(
		array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:User[]')
	),
	'tns:User'
);
$server->register('getUserById',
	array('id'=> 'xsd:int'),
	array('return' => 'tns:User'),
	'urn:payment',
	'urn:payment#getUserById',
	'rpc',
	'encoded',
	'根据id获取的用户信息'
);

$server->register(
	'getAllUser',
	array(),
	array('return' => 'tns:UserArray'),
	'urn:payment',
	'urn:payment#getAllUser',
	'rpc',
	'encoded',
	'获取所有用户信息'

);

$server->register(
	'insertUser',
	array('data' => 'tns:User'),
	array('return' => 'xsd:int'),
	'urn:payment',
	'urn:payment#insertUser',
	'rpc',
	'encoded',
	'添加用户'

);

$server->register(
	'deleteUserById',
	array('id'=> 'xsd:int'),
	array('return' => 'xsd:boolean'),
	'urn:payment',
	'urn:payment#deleteUserById',
	'rpc',
	'encoded',
	'根据id删除用户信息'
);

$server->register(
	'updateUser',
	array('data' => 'tns:User'),
	array('return' => 'xsd:boolean'),
	'urn:payment',
	'urn:payment#updateUser',
	'rpc',
	'encoded',
	'通过id修改用户信息'

);



$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA);

?>
