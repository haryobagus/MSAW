<?php if(!isset($_SESSION['LOGIN_ID'])){?>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Menu</h3>
	</div>
	<a href="<?php echo $www;?>login" class="list-group-item <?php if($current_page=='login'){echo 'list-group-item-info';}?>">Login Administrator</a>
	<!-- <div class="list-group"> -->
		<!-- <a href="<?php echo $www;?>" class="list-group-item <?php if($current_page==''){echo 'list-group-item-info';}?>">Halaman Depan</a> -->
	<!-- </div> -->
</div>
<?php }else{?>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Menu User</h3>
	</div>
	<div class="list-group">
		<a href="<?php echo $www;?>" class="list-group-item <?php if($current_page==''){echo 'list-group-item-info';}?>"><i class="fas fa-home"></i> Halaman Depan</a>
		<a href="<?php echo $www;?>kriteria" class="list-group-item <?php if($current_page=='kriteria' or $current_page=='update_kriteria'){echo 'list-group-item-info';}?>"><i class="fas fa-table"></i> Data Kriteria</a>
		<a href="<?php echo $www;?>subkriteria" class="list-group-item <?php if($current_page=='subkriteria' or $current_page=='update_subkriteria'){echo 'list-group-item-info';}?>"><i class="fas fa-table"></i> Data Subkriteria</a>
		<a href="<?php echo $www;?>alternatif" class="list-group-item <?php if($current_page=='alternatif' or $current_page=='update_alternatif'){echo 'list-group-item-info';}?>"><i class="fas fa-table"></i> Data Alternatif</a>
		<a href="<?php echo $www;?>hasil" class="list-group-item <?php if($current_page=='hasil'){echo 'list-group-item-info';}?>"><i class="fas fa-calculator"></i> Hasil Seleksi</a>
		<!-- <a href="<?php echo $www;?>ubah_password" class="list-group-item <?php if($current_page=='ubah_password'){echo 'list-group-item-info';}?>">Ubah Password</a> -->
		<a href="<?php echo $www;?>logout.php" class="list-group-item"><i class="fas fa-sign-out-alt"></i> Logout</a>
	</div>
</div>
<?php } ?>