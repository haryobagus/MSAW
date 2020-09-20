<?php

session_name('session_saw');
session_start();
define('myweb',true);

require_once 'config.php';
require_once 'function.php';
require_once 'page.php';
require_once 'template.php';
$con->close();
?>