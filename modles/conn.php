<?php
include  dirname(__FILE__).'./config/config.php';
include  dirname(__FILE__).'./lib/mysql.class.php';
global $db;
$db = new db();
$db->connect($_config['db']['dbhost'], $_config['db']['dbuser'], $_config['db']['dbpw'], $_config['db']['name'], $_config['db']['dbcharset']);

?>
