<?php
include_once('../common.php');
include_once(MODLES_PATH.'/Tariff.class.php'); //include the class

function getTariffById($id) {
	$tar = new Tariff();
	$tar = $tar->getTariffById($id);
	if($tar) {
		return $tar;
	} else {
		return array();
	}
}

function getAllTariff() {
	$tar = new Tariff();
	$tars = array();
	$tars[] = $tar->getAllTariff();
	if($tars) {
		return $tars;
	} else {
		return array();
	}
}

function insertTariff($data) {
	$tar = new Tariff();
	if(isset($data['id'])) unset($data['id']);
	return $tar->insertTariff($data);
}

function deleteTariffById($id) {
	$tar = new Tariff();
	$result = $tar->deleteTariffById($id);
	return $result;
}

function updateTariff($data) {
	$tar = new Tariff();
	$result = $tar->updateTariff($data);
	return $result;

}

function getTariffBy__($arr_where, $limit = '', $order ='') {
	$tar = new Tariff();
	$result = $tar-> getTariffBy__($arr_where, $limit, $order);
	return $result ? $result : array();
}

?>
