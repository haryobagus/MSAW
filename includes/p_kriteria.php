<?php if (!defined('myweb')) {
	exit();
} ?>
<?php
$link_list = $www . 'kriteria';
$link_update = $www . 'update_kriteria';

$atribut_label = array('benefit' => 'Benefit', 'cost' => 'Cost');
$bobot_label = array(strval(1) => 'Sangat Rendah', strval(2) => 'Rendah', strval(3) => 'Cukup', strval(4) => 'Tinggi', strval(5) => 'Sangat Tinggi');
$no = 0;
$daftar = '';
$q = $con->query("SELECT * FROM kriteria ORDER BY kode");
while ($h = $q->fetch_array()) {
	$no++;
	$id = $h['id_kriteria'];

	$daftar .= '
	  <tr>
		<td class="text-center">' . $no . '</td>
		<td>' . htmlspecialchars($h['kode']) . '</td>
		<td>' . htmlspecialchars($h['nama']) . '</td>
		<td>' . $atribut_label[$h['atribut']] . '</td>
		<td>' . $bobot_label[strval($h['bobot'])] . '</td>
		<td class="text-center">
		<a href="' . $link_update . '/?id=' . $id . '&amp;action=edit" class="btn btn-default btn-xs">Edit</a>
		<a href="#" onclick="DeleteConfirm(\'' . $link_update . '/?id=' . $id . '&amp;action=delete\');return(false);" class="btn btn-danger btn-xs">Hapus</a>
		</td>
	  </tr>
	';
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
		<h1 class="page-header" style="margin-top:0">Data Kriteria</h1>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<a href="<?php echo $link_update; ?>" class="btn btn-primary" style="float:right">Input Baru</a>
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
							<th class="text-center">KODE</th>
							<th class="text-center">NAMA KRITERIA</th>
							<th class="text-center">ATRIBUT</th>
							<th class="text-center">BOBOT</th>
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