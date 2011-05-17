<?php
include_once '../common.php';
$action = 'medical/login.php';
$login_html = file_get_contents('template/login.html');
$login_html = str_replace('{action_url:doctor}', $action, $login_html);
echo $login_html;
?>
