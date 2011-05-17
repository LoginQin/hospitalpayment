<?php
include_once '../common.php';
$ini = parse_ini_file ( MAIN_PATH.'/config.ini');
//数据库配置
$_config = array();
$_config['db']['dbhost'] = $ini['dbhost'];     //主机
$_config['db']['dbuser'] = $ini['dbuser'];          //数据库用户名
$_config['db']['dbpw'] = $ini['dbpassword'];          //数据库密码
$_config['db']['dbcharset'] = $ini['dbcharset'];       //数据库编码 勿动！
$_config['db']['name'] = $ini['dbname']; //数据库名称

?>
