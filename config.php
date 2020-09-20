<?php
error_reporting(0);
$db_host 		= 'localhost';
$db_user 		= 'root';
$db_password 	= '';
$db_name 		= 'saw2';
$www 			='http://localhost/saw/';

$con = @new mysqli($db_host, $db_user, $db_password, $db_name);
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
} 
?>