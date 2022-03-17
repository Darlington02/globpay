<?php

$db_host = 'localhost';
$db_user = 'root';
$db_pwd = '';
$db_name = 'globpay';

$cxn = mysqli_connect($db_host, $db_user, $db_pwd) or die(mysqli_error($cxn));

// use connection to select database
mysqli_select_db($cxn, $db_name) or die(mysqli_error($cxn));