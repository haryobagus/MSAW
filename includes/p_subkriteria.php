<?php if (!defined('myweb')) {
	exit();
} ?>
<?php
$link_list = $www . 'subkriteria';
$link_update = $www . 'update_subkriteria';

$id_kriteria = '';
if (isset($_GET['kriteria'])) {
	$id_kriteria = $_GET['kriteria'];
}

$no = 0;
$daftar = '';
$q = $con->query("SELECT * FROM subkriteria WHERE id_kriteria='" . $id_kriteria . "' ORDER BY nilai");
while ($h = $q->fetch_array()) {
	$no++;
	$id = $h['id_subkriteria'];

	$daftar .= '
	  <tr>
		<td class="text-center">' . $no . '</td>
		<td>' . htmlspecialchars($h['nama']) . '</td>
		<td class="text-center">' . $h['nilai'] . '</td>
		<td class="text-center">
		<a href="' . $link_update . '/?id=' . $id . '&amp;action=edit" class="btn btn-default btn-xs">Edit</a>
		<a href="#" onclick="DeleteConfirm(\'' . $link_update . '/?id=' . $id . '&amp;action=delete\');return(false);" class="btn btn-danger btn-xs">Hapus</a>
		</td>
	  </tr>
	';
}
$list_kriteria = '<option value="">Pilih Kriteria</option>';
$q = $con->query("SELECT * FROM kriteria ORDER BY nama");
while ($h = $q->fetch_array()) {
	if ($h['id_kriteria'] == $id_kriteria) {
		$s = 'selected';
	} else {
		$s = '';
	}
	$list_kriteria .= '<option value="' . $h['id_kriteria'] . '" ' . $s . '>' . $h['nama'] . '</option>';
}

?>

<script language="javascript">
	function DeleteConfirm(url) {
		if (confirm("Anda yakin akan menghapus data ini ?")) {
			window.location.href = url;
		}
	}
</script>
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header" style="margin-top:0">Data Subkriteria</h1>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<form action="<?php echo $link_list; ?>/" name="" method="get" class="form-inline">
			<div class="form-group"><select name="kriteria" class="form-control" onchange="submit()"><?php echo $list_kriteria; ?></select>&nbsp;</div>
			<div class="form-group pull-right">
				<a href="<?php echo $link_update . '/?kriteria=' . $id_kriteria; ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Input Baru</a>&nbsp;
			</div>
		</form>
		<div style="height:10px;clear:both;"></div>
		<?php
		if ($daftar == '') {
			echo '<div class="alert alert-danger ">Data tidak ditemukan.</div>';
		} else {
		?>
			<div class="panel panel-default">
				<table class="table table-striped table-hover table-bordered">
					<thead>
						<tr>
							<th class="text-center" width="40">NO</th>
							<th class="text-center">NAMA SUBKRITERIA</th>
							<th class="text-center">NILAI</th>
							<th class="text-center" width="110">AKSI</th>
						</tr>
					</thead>
					<tbody>
						<?php echo $daftar; ?>
					</tbody>
				</table>
			</div>

		<?php } ?>

	</div>
</div>