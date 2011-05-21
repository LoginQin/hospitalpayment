<?php
include '../../common.php';
include 'checkuseservice.inc.php';
if(!isset($_SESSION)) session_start();
$html =  file_get_contents(MAIN_PATH.'/view/template/patient.html');
$_html_history = file_get_contents(MAIN_PATH.'/view/template/patient_history.html');
$patient_id = trim($_POST['patient_id']);
$patient = $main->getPatientDataById($patient_id);
$patient_history = $main->getHistoryDiacrisis($patient_id);
if($patient) {
	$state = $patient['register_state'] ? '<span style="color:red">已诊断</span>' : '<span style="color:green">尚未诊断</span>';
	$html = str_replace('{label:name}', $patient['patient_name'], $html);
	$html = str_replace('{label:gender}', $patient['patient_gender'], $html);
	$html = str_replace('{label:age}', $patient['patient_age'], $html);
	$html = str_replace('{label:register_time}', $patient['register_time'], $html);
	$html = str_replace('{label:illness}', $patient['illness'], $html);
	$html = str_replace('{label:prescribe}', '' , $html);
	$html = str_replace('{label:register_state}', $state, $html);
	$html = str_replace('{label:patient_id}', $patient['patient_id'], $html);

	if($patient_history){
		$num = 1;
		$html_h = '';
		foreach($patient_history as $history) {
			$html_history = $_html_history;
			$html_history = str_replace('{label:history_title}', '诊断记录-'.$num, $html_history);
			$html_history = str_replace('{label:history_doctor_name}', $history['doctor_name'] ,$html_history);
			$html_history = str_replace('{label:history_diacrisis_time}', $history['time'], $html_history);
			$html_history = str_replace('{label:history_illness}', $history['illness'], $html_history);
			$html_history = str_replace('{label:history_prescribe}', $history['medicine'], $html_history);
			$html_history = str_replace('{label:history_office_name}', $history['office_name'], $html_history);
			$html_h .= $html_history;
			$num++;

		}
		$html = str_replace('{table:diacrisis_history}', $html_h, $html);

	} else {
		$html = str_replace('{table:diacrisis_history}', '', $html);
	}

} else {
	$html = '没有该病人信息！';
}
echo $html;
?>
