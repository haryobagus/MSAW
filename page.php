<?php
$url_tmp = str_replace($www,'','http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']);
$url_tmp = explode('/',$url_tmp);
switch($url_tmp[0]){
	case 'login':
	case 'alternatif':
	case 'update_alternatif':
	case 'kriteria':
	case 'update_kriteria':
	case 'subkriteria':
	case 'update_subkriteria':
	case 'hasil':
		$_GET['hal'] = $url_tmp[0];
		break;
	default:
		$_GET['hal'] = '';
		break;
}

$page='';
if(isset($_GET['hal'])){
	$page=$_GET['hal'];
}
$current_page=$page;
$must_login = true;
switch($page){
	case 'login':
		$page="include 'includes/p_login.php';";$must_login = false;
		break;
	case 'alternatif':
		$page="include 'includes/p_alternatif.php';";
		break;
	case 'update_alternatif':
		$page="include 'includes/p_alternatif_update.php';";
		break;
	case 'kriteria':
		$page="include 'includes/p_kriteria.php';";
		break;
	case 'update_kriteria':
		$page="include 'includes/p_kriteria_update.php';";
		break;
	case 'subkriteria':
		$page="include 'includes/p_subkriteria.php';";
		break;
	case 'update_subkriteria':
		$page="include 'includes/p_subkriteria_update.php';";
		break;
	case 'klasifikasi':
		$page="include 'includes/p_klasifikasi.php';";
		break;
	case 'ubah_password':
		$page="include 'includes/p_ubah_password.php';";
		break;

	case 'hasil':
		$page="include 'includes/p_hasil.php';";
		break;
	case 'analisa':
		$page="include 'includes/p_analisa.php';";
		break;

	default:
		$page="include 'includes/p_home.php';";$must_login = false;
		break;
}
$CONTENT_["main"]=$page;
if($must_login==true and !isset($_SESSION['LOGIN_ID'])){
	exit("<script>location.href='".$www."';</script>");
}

?>