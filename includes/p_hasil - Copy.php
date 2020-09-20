<?php

# baca jumlah kriteria
$q = $con->query("SELECT COUNT(*) AS jml FROM kriteria");
$h = $q->fetch_array();
$jumlah_kriteria = $h['jml']; //mysqli_num_rows(mysqli_query($con,"select * from kriteria"));
# baca jumlah alternatif
$q = $con->query("SELECT COUNT(*) AS jml FROM alternatif");
$h = $q->fetch_array();
$jumlah_alternatif = $h['jml']; //mysqli_num_rows(mysqli_query($con,"select * from alternatif"));

# baca data alternatif
$alternatif = array();
$nama_alternatif = array();
$title = '';
$q = $con->query("SELECT * FROM alternatif ORDER BY nama");
while($h = $q->fetch_array()){
	$alternatif[] = array($h['id_alternatif'], $h['nama']);
	$nama_alternatif[$h['id_alternatif']] = $h['nama'];
	$title .= '<td class="text-center" width="240">'.strtoupper($h['nama']).'</td>';
}

# baca data kriteria dan nilai bobot dari form input analisa
$kriteria = array();
$q = $con->query("SELECT * FROM kriteria ORDER BY kode");
while($h = $q->fetch_array()){
	$kriteria[] = array($h['id_kriteria'], $h['kode'], $h['nama'], $h['atribut'], $h['bobot']);
}

$no=0;
$daftar='<th class="text-center" width="40">NO</th><th class="text-center" width="150">NAMA</th>';
for($i=0;$i<count($kriteria);$i++){
	$daftar.='<th class="text-center" width="200">'.$kriteria[$i][2].'</th>';
}
$daftar='<thead><tr>'.$daftar.'</tr></thead><tbody>';
for($i=0;$i<count($alternatif);$i++){
	$no++;
	$daftar.='<tr><td class="text-center">'.$no.'</td><td>'.$alternatif[$i][1].'</td>';
	for($ii=0;$ii<count($kriteria);$ii++){
		$q=mysqli_query($con,"select subkriteria.nama from nilai inner join subkriteria on nilai.id_subkriteria=subkriteria.id_subkriteria where nilai.id_alternatif='".$alternatif[$i][0]."' and subkriteria.id_kriteria='".$kriteria[$ii][0]."'");
		$h=mysqli_fetch_array($q);
		$subkriteria=$h['nama'];
		$daftar.='<td>'.$subkriteria.'</td>';
	}
	$daftar.='</tr>';
}
$daftar.='</tbody>';

$no=0;
$daftar_1='<th class="text-center" width="40">NO</th><th class="text-center" width="150">NAMA</th>';
for($i=0;$i<count($kriteria);$i++){
	$daftar_1.='<th class="text-center" width="100">'.$kriteria[$i][1].'</th>';
}
$daftar_1='<thead><tr>'.$daftar_1.'</tr></thead><tbody>';
for($i=0;$i<count($alternatif);$i++){
	$no++;
	$daftar_1.='<tr><td class="text-center">'.$no.'</td><td>'.$alternatif[$i][1].'</td>';
	for($ii=0;$ii<count($kriteria);$ii++){
		$q = $con->query("SELECT subkriteria.nilai FROM nilai inner join subkriteria on nilai.id_subkriteria=subkriteria.id_subkriteria WHERE nilai.id_alternatif='".$alternatif[$i][0]."' and subkriteria.id_kriteria='".$kriteria[$ii][0]."'");
		$h = $q->fetch_array();
		$nilai=$h['nilai'];
		# catat nilai subkriteria ke dalam matriks
		$matriks_x[$i+1][$ii+1]=$nilai;
		$daftar_1.='<td class="text-center">'.$nilai.'</td>';
	}
	$daftar_1.='</tr>';
}
$daftar_1.='</tbody>';

# Perbaikan Bobot (M-SAW)
$tbobot = $kriteria[1][4] + $kriteria[2][4] + $kriteria[3][4] + $kriteria[4][4] + $kriteria[0][4];

$w1 = $kriteria[0][4]/$tbobot;
$w2 = $kriteria[1][4]/$tbobot;
$w3 = $kriteria[2][4]/$tbobot;
$w4 = $kriteria[3][4]/$tbobot;
$w5 = $kriteria[4][4]/$tbobot;

//kalau benefit + kalau cost - faktor pangkat nya.
if($kriteria[0][3]=="benefit"){
	$w1 = round($w1,3);
}else{
	$w1 = round($w1,3)*-1;
}

if($kriteria[1][3]=="benefit"){
	$w2 = round($w2,3);
}else{
	$w2 = round($w2,3)*-1;
}

if($kriteria[2][3]=="benefit"){
	$w3 = round($w3,3);
}else{
	$w3 = round($w3,3)*-1;
}

if($kriteria[3][3]=="benefit"){
	$w4 = round($w4,3);
}else{
	$w4 = round($w4,3)*-1;
}

if($kriteria[4][3]=="benefit"){
	$w5 = round($w5,3);
}else{
	$w5 = round($w5,3)*-1;
}






# NORMALISASI 
$no=0;
$daftar_2='<th class="text-center" width="40">NO</th><th class="text-center" width="150">NAMA</th>';
for($i=0;$i<count($kriteria);$i++){
	$daftar_2.='<th class="text-center">'.$kriteria[$i][1].'</th>';
}
$daftar_2='<thead><tr>'.$daftar_2.'</tr></thead><tbody>';
for($i=0;$i<count($alternatif);$i++){
	$no++;
	$daftar_2.='<tr><td class="text-center">'.$no.'</td><td>'.$alternatif[$i][1].'</td>';
	for($ii=0;$ii<count($kriteria);$ii++){
		$arr=array();
		for($j=0;$j<count($alternatif);$j++){ # alternatif
			$arr[]=$matriks_x[$j+1][$ii+1];
		}
		if($kriteria[$ii][3]=='benefit'){
			if($matriks_x[$i+1][$ii+1]>0){$jml=$matriks_x[$i+1][$ii+1]/max($arr);}else{$jml=0;}
		}else{
			if(min($arr)>0){$jml=min($arr)/$matriks_x[$i+1][$ii+1];}else{$jml=0;}
		}
		$matriks_1[$i+1][$ii+1]=round($jml,3);
		$daftar_2.='<td class="text-center">'.round($jml,3).'</td>';
	}
	$daftar_2.='</tr>';
}
$daftar_2.='</tbody>';

$thasil = 0;

for($i=0;$i<count($alternatif);$i++){
	$jml=0;
	//vektor S
	$jml=pow($matriks_1[$i+1][1],$w1)*pow($matriks_1[$i+1][2],$w2)*pow($matriks_1[$i+1][3],$w3)*pow($matriks_1[$i+1][4],$w4)*pow($matriks_1[$i+1][5],$w5);

	$thasil = $thasil + $jml;
	$hasil[]=array(round($jml,3),$alternatif[$i][0]);
}
$thasil = round($thasil,3);

for($i=0;$i<count($alternatif);$i++){
	//Perangkingan(V)
	$jml=$hasil[$i][0] / $thasil;
	$hasil2[]=array(round($jml,3),$alternatif[$i][0]);
}

rsort($hasil2);
$no = 0;

$daftar_3='<th class="text-center" width="40">NO</th><th class="text-center">NAMA</th><th class="text-center" width="100">NILAI</th><th class="text-center" width="100">RANK</th>';
$daftar_3='<thead><tr>'.$daftar_3.'</tr></thead><tbody>';
for($i=0;$i<count($hasil2);$i++){
	$no++;
	$daftar_3.='
	<tr>
	<td class="text-center">'.$no.'</td>
	<td>'.$nama_alternatif[$hasil2[$i][1]].'</td>
	<td class="text-center">'.$hasil2[$i][0].'</td>
	<td class="text-center">'.$no.'</td>
	</tr>
	';


}
$daftar_3.='</tbody>';


?>
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header" style="margin-top:0">Hasil Seleksi</h1>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Nilai Alternatif</h3>
			</div>
			<div style="overflow-x:auto;width:100%;">
			<table class="table table-striped table-hover table-bordered" style="table-layout: fixed; width: 100%;">
				<?php echo $daftar;?>
			</table>
			</div>
		</div>
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Konversi</h3>
			</div>
			<div style="overflow-x:auto;width:100%;">
			<table class="table table-striped table-hover table-bordered" style="table-layout: fixed; width: 100%;">
				<?php echo $daftar_1;?>
			</table>
			</div>
		</div>
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Normalisasi</h3>
			</div>
			<div style="overflow-x:auto;width:100%;">
			<table class="table table-striped table-hover table-bordered" style="table-layout: fixed; width: 100%;">
				<?php echo $daftar_2;?>
			</table>
			</div>
		</div>
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Hasil Akhir</h3>
			</div>
			<div style="overflow-x:auto;width:100%;">
			<table class="table table-striped table-hover table-bordered" style="table-layout: fixed; width: 100%;">
				<?php echo $daftar_3;?>
			</table>
			</div>
		</div>
	</div>
</div>