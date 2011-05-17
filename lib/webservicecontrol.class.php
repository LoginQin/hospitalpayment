<?php
include_once(dirname(__FILE__).'/nusoap.php');
/**
 *  Web Service Control Class 
 *  This Class achieve nusoap By a quickly way;
 *  It Packag Some Troublesome Method 
 *  @Author Qinwei 
 */
class WebServiceControl {
	var $server;

	public function __construct() {
		$server = new soap_server();
		$this->server = $server;
	}

	public function initWSDL($servername, $namespace) {
		$this->server->configureWSDL($servername, 'urn:'.$namespace);
		$this->server->wsdl->schemaTargetNamespace = 'urn:'.$namespace;
		$this->server->soap_defencoding='UTF-8'; 
		$this->server->xml_encoding='UTF-8';
		$this->server->decode_utf8=false;
	}

	public function qRegisterMethod($methodname, $input, $output, $namespace, $messages) {
		$this->server->register(
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

	public function createObjectMappingComplexType ($objectname, $propertytype_mapping ) {
		$name_type = array();
		foreach($propertytype_mapping as $property => $type ) {
			$name_type[$property] = array('name' => $property, 'type' => 'xsd:'.$type);
		}
		$this->server->wsdl->addComplexType(
			$objectname,
			'complexType',
			'struct',
			'sequence',
			'',
			$name_type
		);

		$this->server->wsdl->addComplexType(
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

	public	function startServer() {
		global $HTTP_RAW_POST_DATA;
		$HTTP_RAW_POST_DATA = isset( $HTTP_RAW_POST_DATA) ?  $HTTP_RAW_POST_DATA : '';
		$this->server->service($HTTP_RAW_POST_DATA);
	}

}

?>
