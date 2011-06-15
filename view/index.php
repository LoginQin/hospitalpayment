<?php
include_once '../common.php';
$action = 'medical/login.php';
$action_admin = 'statistics/login.php';
$login_html = file_get_contents('template/login.html');
$login_html = str_replace('{action_url:doctor}', $action, $login_html);
$login_html = str_replace('{action_url:admin}', $action_admin, $login_html);

echo $login_html;
?>
