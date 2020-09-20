<?php if (!defined('myweb')) {
	exit();
} ?>
<?php

$link_list = $www . 'alternatif';
$link_update = $www . 'update_alternatif';

$gender_label = array('L' => 'Laki-laki', 'P' => 'Perempuan');
$no = 0;
$daftar = '';
$q = $con->query("SELECT * FROM alternatif ORDER BY nama");
while ($h = $q->fetch_array()) {
	$no++;
	$id = $h['id_alternatif'];

	$daftar .= '
	  <tr>
		<td class="text-center">' . $no . '</td>
		<td>' . htmlspecialchars($h['nama']) . '</td>
		<td>' . htmlspecialchars($h['alamat']) . '</td>
		<td>' . $gender_label[$h['gender']] . '</td>
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
		<h1 class="page-header" style="margin-top:0">Data Alternatif</h1>
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
							<th class="text-center">NAMA</th>
							<th class="text-center">ALAMAT</th>
							<th class="text-center">J. KELAMIN</th>
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