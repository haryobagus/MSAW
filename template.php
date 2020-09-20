<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<meta name="description" content="">
	<meta name="keywords" content="">
	<title>Penerimaan Beasiswa</title>
	<link href="<?php echo $www;?>css/bootstrap.css" rel="stylesheet">
	<link href="<?php echo $www;?>css/bootstrap-theme.min.css" rel="stylesheet">
	<link href="<?php echo $www;?>css/style.css" rel="stylesheet">
	<link href="<?php echo $www;?>css/fontawesome/css/all.css" rel="stylesheet">
	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	<script src="<?php echo $www;?>js/jquery-latest.min.js" type="text/javascript"></script>
	<script src="<?php echo $www;?>js/bootstrap.min.js"></script>
</head>
<body>
	<div style="background:url(<?php echo $www;?>images/bg.jpg) no-repeat fixed;margin-top:-10px;padding-top:20px;">
		<div class="container main container-fluid">
			<div class="row">
				<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 sidebar-leftx">
					<?php include 'sidebar.php';?>
				</div>

				<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9 middle">
					<?php eval($CONTENT_["main"]);?>
					<div style="clear: both;height:50px;"></div>

				</div>
			</div>
			<div class="container-fluid footer">
				<?php include 'footer.php';?>
			</div>
		</div>
	</div>
</body>
</html>