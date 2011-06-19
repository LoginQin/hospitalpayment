<?php
// Pull in the NuSOAP code
require_once('../lib/nusoap.php');
// Create the client instance
$client = new soapclient('http://127.0.0.1/hospitalpayment/payment/payment.service.php?wsdl', true);
// Check for an error
$err = $client->getError();
if ($err) {
    // Display the error
    echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
    // At this point, you know the call that follows will fail
}
// Create the proxy
$proxy = $client->getProxy();
 echo $proxy->signIN('Login', '123');
//echo $proxy->registerNewPatient('AAAA','男', 25, '');
//print_r($proxy->getAllMedicine());
//print_r($proxy->getPatientById(10071));
//print_r($proxy->getRegisterByPatientId(10069));
// Call the SOAP method
//print_r($proxy->getFinalBillByPatientId(10073));
$medicine = array(
		array('name' => '白加黑', 'count' => 10 ),
		array('name' => '康泰克', 'count' => 20)
);
echo $proxy->recordTakeMedicineData(10073, $medicine);
//$result = $proxy->getUserById(1);
//$result2 = $proxy->getUserById(2);
//print_r($result2);
//$result = $proxy->getAllUser();
//print_r($result);
// Check for a fault
$data = array(
		'id'=> 3,
		'name' => 'Qinwei',
		'gender' => '男',
		'age'=> 28
	);

//$id = $proxy->insertUser($data); echo $id;
//echo $proxy->insertPatient($data);
//echo $proxy->deletePatientById(2); 

/*
if ($proxy->fault) {
    echo '<h2>Fault</h2><pre>';
    print_r($result);
    echo '</pre>';
} else {
    // Check for errors
    $err = $proxy->getError();
    if ($err) {
        // Display the error
        echo '<h2>Error</h2><pre>' . $err . '</pre>';
    } else {
        // Display the result
        echo '<h2>Result</h2><pre>';
        print_r($result);
    echo '</pre>';
    }
}
 */
// Display the request and response
echo '<h2>Request</h2>';
echo '<pre>' . htmlspecialchars($proxy->request, ENT_QUOTES) . '</pre>';
echo '<h2>Response</h2>';
echo '<pre>' . htmlspecialchars($proxy->response, ENT_QUOTES) . '</pre>';
// Display the debug messages
echo '<h2>Debug</h2>';
echo '<pre>' . htmlspecialchars($proxy->debug_str, ENT_QUOTES) . '</pre>';
?>


