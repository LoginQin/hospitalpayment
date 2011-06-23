<?php
include '../../common.php';
include 'checkuseservice.inc.php';
if(!isset($_SESSION)) session_start();
if(!isset($_SESSION['Did'])) header('Location: ../index.php');
$illness = trim($_POST['illness']);
$medicine = trim($_POST['prescribe']);
$patient_id = trim($_POST['patient_id']);
if($illness == '' || $medicine == '') {
	echo '请认真对待病人，病历信息不能为空。';
}else {
	$result = $main->insertIllnessByPatientId($patient_id, $_SESSION['Did'], $illness, $medicine);
	echo $result;
	if($result) {
		echo '诊断信息保存成功！';
	}else {
		echo '诊断信息保存失败！';
	}
}

?>
