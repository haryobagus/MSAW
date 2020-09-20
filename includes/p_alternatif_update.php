<?php if (!defined('myweb')) {
	exit();
} ?>
<?php
$link_list = $www . 'alternatif';
$link_update = $www . 'update_alternatif';

$kriteria = array();
$subkriteria = array();
$q = $con->query("SELECT * FROM kriteria ORDER BY nama");
while ($h = $q->fetch_array()) {
	$kriteria[] = array($h['id_kriteria'], $h['nama']);
}

if (isset($_POST['save'])) {
	$id = $_POST['id'];
	$action = $_POST['action'];
	$nama = $_POST['nama'];
	$gender = $_POST['gender'];
	$alamat = $_POST['alamat'];

	if (empty($nama) or empty($gender) or empty($alamat)) {
		$error = 'Masih ada beberapa kesalahan. Silahkan periksa lagi form di bawah ini.';
	} else {

		if ($action == 'add') {
			$stmt = $con->prepare("INSERT INTO alternatif(nama, gender, alamat) VALUES(?, ?, ?)");
			$stmt->bind_param("sss", $nama, $gender, $alamat);
			$stmt->execute();
			$stmt->close();
			$id_alternatif = $con->insert_id;
			$stmt = $con->prepare("INSERT INTO nilai(id_alternatif, id_subkriteria) VALUES(?, ?)");
			for ($i = 0; $i < count($kriteria); $i++) {
				$id_subkriteria = $_POST['kriteria_' . $kriteria[$i][0]];
				$stmt->bind_param("ii", $id_alternatif, $id_subkriteria);
				$stmt->execute();
			}
			$stmt->close();
			exit("<script>location.href='" . $link_list . "';</script>");
		}


		if ($action == 'edit') {
			$stmt = $con->prepare("UPDATE alternatif SET nama=?, gender=?, alamat=? WHERE id_alternatif=?");
			$stmt->bind_param("sssi", $nama, $gender, $alamat, $id);
			$stmt->execute();
			$stmt->close();
			$id_alternatif = $id;
			$con->query("DELETE FROM nilai WHERE id_alternatif='" . escape($id) . "'");
			$stmt = $con->prepare("INSERT INTO nilai(id_alternatif, id_subkriteria) VALUES(?, ?)");
			for ($i = 0; $i < count($kriteria); $i++) {
				$id_subkriteria = $_POST['kriteria_' . $kriteria[$i][0]];
				$stmt->bind_param("ii", $id_alternatif, $id_subkriteria);
				$stmt->execute();
			}
			$stmt->close();
			exit("<script>location.href='" . $link_list . "';</script>");
		}
	}
} else {
	$nama = '';
	$gender = '';
	$alamat = '';
	if (empty($_GET['action'])) {
		$action = 'add';
	} else {
		$action = $_GET['action'];
	}
	if ($action == 'edit') {
		$id = $_GET['id'];
		$q = $con->query("SELECT * FROM alternatif WHERE id_alternatif='" . escape($id) . "'");
		$h = $q->fetch_array();
		$nama = $h['nama'];
		$gender = $h['gender'];
		$alamat = $h['alamat'];
		$q = $con->query("SELECT * FROM nilai WHERE id_alternatif='" . escape($id) . "'");
		while ($h = $q->fetch_array()) {
			$subkriteria[] = $h['id_subkriteria'];
		}
	}


	if ($action == 'delete') {
		$id = $_GET['id'];
		$con->query("DELETE FROM alternatif WHERE id_alternatif='" . escape($id) . "'");
		exit("<script>location.href='" . $link_list . "';</script>");
	}
}


$daftar_kriteria = '';
for ($i = 0; $i < count($kriteria); $i++) {
	$list_subkriteria = '<option value=""></option>';
	$q = $con->query("SELECT * FROM subkriteria WHERE id_kriteria='" . $kriteria[$i][0] . "'");
	while ($h = $q->fetch_array()) {
		if (in_array($h['id_subkriteria'], $subkriteria)) {
			$s = 'selected';
		} else {
			$s = '';
		}
		$list_subkriteria .= '<option value="' . $h['id_subkriteria'] . '" ' . $s . '>' . $h['nama'] . '</option>';
	}
	$daftar_kriteria .= '
		<div class="form-group">
			<label for="nama" class="col-sm-3 control-label">' . $kriteria[$i][1] . ' <span class="required">*</span></label>
			<div class="col-sm-9">
			<select name="kriteria_' . $kriteria[$i][0] . '" class="form-control" required>' . $list_subkriteria . '</select>
			</div>
		</div>
	';
}

if ($action == 'add') {
	$header = 'Input Data Alternatif';
} else {
	$header = 'Edit Data Alternatif';
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
						<label for="nama" class="col-sm-3 control-label">Nama <span class="required">*</span></label>
						<div class="col-sm-9">
							<input type="text" class="form-control" name="nama" value="<?php echo htmlspecialchars($nama); ?>" required>
						</div>
					</div>
					<div class="form-group">
						<label for="nama" class="col-sm-3 control-label">J. Kelamin <span class="required">*</span></label>
						<div class="col-sm-9">
							<select name="gender" class="form-control" required>
								<option value=""></option>
								<option value="L" <?php if ($gender == 'L') {
														echo 'selected';
													} ?>>Laki-laki</option>
								<option value="P" <?php if ($gender == 'P') {
														echo 'selected';
													} ?>>Perempuan</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="nama" class="col-sm-3 control-label">Alamat <span class="required">*</span></label>
						<div class="col-sm-9">
							<input type="text" class="form-control" name="alamat" value="<?php echo htmlspecialchars($alamat); ?>" required>
						</div>
					</div>
					<?php echo $daftar_kriteria; ?>
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