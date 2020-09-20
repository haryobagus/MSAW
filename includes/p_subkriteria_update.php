<?php if (!defined('myweb')) {
	exit();
} ?>
<?php
$link_list = $www . 'subkriteria';
$link_update = $www . 'update_subkriteria';

if (isset($_POST['save'])) {
	$id = $_POST['id'];
	$action = $_POST['action'];
	$nama = $_POST['nama'];
	$id_kriteria = $_POST['kriteria'];
	$nilai = $_POST['nilai'];

	if (empty($nama) or empty($id_kriteria)) {
		$error = 'Masih ada beberapa kesalahan. Silahkan periksa lagi form di bawah ini.';
	} else {
		//nambah
		if ($action == 'add') {
			$stmt = $con->prepare("INSERT INTO subkriteria(nama, id_kriteria, nilai) VALUES(?, ?, ?)");
			$stmt->bind_param("sid", $nama, $id_kriteria, $nilai);
			$stmt->execute();
			$stmt->close();
			exit("<script>location.href='" . $link_list . "/?kriteria=" . $id_kriteria . "';</script>");
		}
		//edit
		if ($action == 'edit') {
			$stmt = $con->prepare("UPDATE subkriteria SET nama=?, id_kriteria=?, nilai=? WHERE id_subkriteria=?");
			$stmt->bind_param("sidi", $nama, $id_kriteria, $nilai, $id);
			$stmt->execute();
			$stmt->close();
			exit("<script>location.href='" . $link_list . "/?kriteria=" . $id_kriteria . "';</script>");
		}
	}
} else {
	$nama = '';
	$id_kriteria = '';
	$nilai = '';
	if (empty($_GET['action'])) {
		$action = 'add';
	} else {
		$action = $_GET['action'];
	}
	if ($action == 'add') {
		$id_kriteria = '';
		if (isset($_GET['kriteria'])) {
			$id_kriteria = $_GET['kriteria'];
		}
	}
	if ($action == 'edit') {
		$id = $_GET['id'];
		$q = $con->query("SELECT * FROM subkriteria WHERE id_subkriteria='" . escape($id) . "'");
		$h = $q->fetch_array();
		$nama = $h['nama'];
		$id_kriteria = $h['id_kriteria'];
		$nilai = $h['nilai'];
	}
	if ($action == 'delete') {
		$id = $_GET['id'];
		$con->query("DELETE FROM subkriteria WHERE id_subkriteria='" . escape($id) . "'");
		exit("<script>location.href='" . $link_list . "';</script>");
	}
}
$list_kriteria = '<option value=""></option>';
$q = $con->query("SELECT * FROM kriteria ORDER BY nama");
while ($h = $q->fetch_array()) {
	if ($h['id_kriteria'] == $id_kriteria) {
		$s = 'selected';
	} else {
		$s = '';
	}
	$list_kriteria .= '<option value="' . $h['id_kriteria'] . '" ' . $s . '>' . $h['nama'] . '</option>';
}

if ($action == 'add') {
	$header = 'Input Data Subkriteria';
} else {
	$header = 'Edit Data Subkriteria';
}

?>
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header" style="margin-top:0"><?php echo $header; ?></h1>
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
				<form class="form-horizontal" action="<?php echo $link_update; ?>" method="post" id="form_edit">
					<input name="id" type="hidden" value="<?php echo $id; ?>">
					<input name="action" type="hidden" value="<?php echo $action; ?>">
					<div class="form-group">
						<label for="nama" class="col-sm-3 control-label">Kriteria <span class="required">*</span></label>
						<div class="col-sm-9">
							<select class="form-control" name="kriteria" required>
								<?php echo $list_kriteria; ?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="nama" class="col-sm-3 control-label">Nama Subkriteria <span class="required">*</span></label>
						<div class="col-sm-9">
							<input type="text" class="form-control" name="nama" value="<?php echo htmlspecialchars($nama); ?>" required>
						</div>
					</div>
					<div class="form-group">
						<label for="nama" class="col-sm-3 control-label">Nilai </label>
						<div class="col-sm-9">
							<input type="text" class="form-control" name="nilai" value="<?php echo htmlspecialchars($nilai); ?>">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-9">
							<button type="submit" name="save" class="btn btn-success"> Simpan</button>
							<button type="button" name="cancel" class="btn btn-default" onclick="location.href='<?php echo $link_list; ?>'">Batal</button>
						</div>
					</div>
				</form>
			</div>
		</div>


	</div>
</div>