<?php if (!defined('myweb')) {
	exit();
} ?>
<?php
$link_list = $www . 'kriteria';
$link_update = $www . 'update_kriteria';

if (isset($_POST['save'])) {
	$id = $_POST['id'];
	$action = $_POST['action'];
	$kode = $_POST['kode'];
	$nama = $_POST['nama'];
	$atribut = $_POST['atribut'];
	$bobot = $_POST['bobot'];

	if (empty($kode) or empty($nama) or empty($atribut) or empty($bobot)) {
		$error = 'Masih ada beberapa kesalahan. Silahkan periksa lagi form di bawah ini.';
	} else {
		if ($action == 'add') {
			$q = $con->query("SELECT * FROM kriteria WHERE kode='" . $kode . "'");
			if ($q->num_rows > 0) {
				$error = '<strong>Error !</strong> Kode sudah terdaftar sebelumnya. Silahkan gunakan kode yang lain.';
			} else {
				$stmt = $con->prepare("INSERT INTO kriteria(kode, nama, atribut, bobot) VALUES(?, ?, ?, ?)");
				$stmt->bind_param("sssi", $kode, $nama, $atribut, $bobot);
				$stmt->execute();
				$stmt->close();
				exit("<script>location.href='" . $link_list . "';</script>");
			}
		}
		if ($action == 'edit') {
			$q = $con->query("SELECT * FROM kriteria WHERE id_kriteria='" . $id . "'");
			$h = $q->fetch_array();
			$kode_tmp = $h['kode'];
			$q = $con->query("SELECT * FROM kriteria WHERE kode='" . $kode . "' and kode<>'" . $kode_tmp . "'");
			if ($q->num_rows > 0) {
				$error = '<strong>Error !</strong> Kode sudah terdaftar sebelumnya. Silahkan gunakan kode yang lain.';
			} else {
				$stmt = $con->prepare("UPDATE kriteria SET kode=?, nama=?, atribut=?, bobot=? WHERE id_kriteria=?");
				$stmt->bind_param("sssdi", $kode, $nama, $atribut, $bobot, $id);
				$stmt->execute();
				$stmt->close();
				exit("<script>location.href='" . $link_list . "';</script>");
			}
		}
	}
} else {
	$kode = '';
	$nama = '';
	$atribut = '';
	$bobot = '';
	if (empty($_GET['action'])) {
		$action = 'add';
	} else {
		$action = $_GET['action'];
	}
	if ($action == 'edit') {
		$id = $_GET['id'];
		$q = $con->query("SELECT * FROM kriteria WHERE id_kriteria='" . escape($id) . "'");
		$h = $q->fetch_array();
		$kode = $h['kode'];
		$nama = $h['nama'];
		$atribut = $h['atribut'];
		$bobot = $h['bobot'];
	}
	if ($action == 'delete') {
		$id = $_GET['id'];
		$con->query("DELETE FROM kriteria WHERE id_kriteria='" . escape($id) . "'");
		$con->query("DELETE FROM subkriteria WHERE id_kriteria='" . escape($id) . "'");
		exit("<script>location.href='" . $link_list . "';</script>");
	}
}

if ($action == 'add') {
	$header = 'Input Data Kriteria';
} else {
	$header = 'Edit Data Kriteria';
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
						<label for="nama" class="col-sm-3 control-label">Kode <span class="required">*</span></label>
						<div class="col-sm-9">
							<input type="text" class="form-control" name="kode" value="<?php echo htmlspecialchars($kode); ?>" required>
						</div>
					</div>
					<div class="form-group">
						<label for="nama" class="col-sm-3 control-label">Nama Kriteria <span class="required">*</span></label>
						<div class="col-sm-9">
							<input type="text" class="form-control" name="nama" value="<?php echo htmlspecialchars($nama); ?>" required>
						</div>
					</div>
					<div class="form-group">
						<label for="nama" class="col-sm-3 control-label">Atribut <span class="required">*</span></label>
						<div class="col-sm-9">
							<select name="atribut" class="form-control" required>
								<option value=""></option>
								<option value="benefit" <?php if ($atribut == 'benefit') {
															echo 'selected';
														} ?>>Benefit</option>
								<option value="cost" <?php if ($atribut == 'cost') {
															echo 'selected';
														} ?>>Cost</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="nama" class="col-sm-3 control-label">Bobot <span class="required">*</span></label>
						<div class="col-sm-9">
							<select name="bobot" class="form-control" required>
								<option value=""></option>
								<option value="0.2" <?php if ($bobot == 0.2) {
														echo 'selected';
													} ?>>Sangat Rendah</option>
								<option value="0.5" <?php if ($bobot == 0.5) {
														echo 'selected';
													} ?>>Rendah</option>
								<option value="3" <?php if ($bobot == 3) {
														echo 'selected';
													} ?>>Cukup</option>
								<option value="4" <?php if ($bobot == 4) {
														echo 'selected';
													} ?>>Tinggi</option>
								<option value="5" <?php if ($bobot == 5) {
														echo 'selected';
													} ?>>Sangat Tinggi</option>
							</select>
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