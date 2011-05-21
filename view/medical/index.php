<?php
include_once '../../common.php';
session_start();
if(!isset($_SESSION['name'])) {
	header('Location: ../index.php');
	die();
}
$html = file_get_contents(MAIN_PATH.'/view/template/medical_index.html');
$html = str_replace('{action_url:patient_data}','getpatientdata.php', $html);
$html = str_replace('{label:title}','医生窗口',$html);
$html = str_replace('{label:username}', $_SESSION['name'], $html);
echo $html;
?>
