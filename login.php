<?php

session_name('session_saw');
session_start();
require_once 'config.php';
require_once 'function.php';

if(isset($_POST["submit"])){
	if(empty($_POST['username']) or empty($_POST['password'])){
		setcookie('error_login','Masukkan username dan password anda',time()+10);
		exit("<script>window.location='".$www."login';</script>");
	}
	$username = $_POST['username'];
	$password = md5($_POST['password']);
	$q = $con->query("SELECT * FROM user WHERE username='".escape($username)."' AND password='".$password."'");
	if ($q->num_rows > 0) {
		$h = $q->fetch_array();
		$_SESSION['LOGIN_ID']=$h['id_user'];
		exit("<script>window.location='".$www."';</script>");
	}else{
		setcookie('error_login','Username dan password yang anda masukkan salah',time()+10);
		exit("<script>window.location='".$www."login';</script>");
	}

}

?>