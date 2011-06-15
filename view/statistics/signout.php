<?php
include '../../common.php';
include 'checkuseservice.inc.php';
session_start();
$signout = $main->signOUT();
echo $signout;
if($signout) {
	session_unset();
	header('Location: ../index.php');
} else {
	die('error');
}

?>
