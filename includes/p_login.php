<?php
$error = '';
if (isset($_COOKIE['error_login'])) {
	$error = $_COOKIE['error_login'];
}
?>

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header" style="margin-top:0">Login Administrator</h1>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-body">
				<?php
				if (!empty($error)) {
					echo '<div class="alert alert-danger">' . $error . '</div>';
				}
				?>
				<form class="form-horizontal" action="<?php echo $www; ?>login.php" method="post" id="form_edit">
					<div class="form-group">
						<label for="nama" class="col-sm-3 control-label">Username <span class="required">*</span></label>
						<div class="col-sm-9">
							<input type="text" class="form-control" name="username" value="admin" required>
						</div>
					</div>
					<div class="form-group">
						<label for="nama" class="col-sm-3 control-label">Password <span class="required">*</span></label>
						<div class="col-sm-9">
							<input type="password" class="form-control" name="password" value="admin" required>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-9">
							<button type="submit" name="submit" class="btn btn-success"> Login</button>
							<button type="button" name="cancel" class="btn btn-default" onclick="location.href='<?php echo $www; ?>'">Batal</button>
						</div>
					</div>
				</form>
			</div>
		</div>


	</div>
</div>