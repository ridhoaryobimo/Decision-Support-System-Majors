<?php  
	$siswa = $this->db->get('siswa');
	$unggulan = $this->db->get('unggulan');
	$hasil_seleksi = $this->db->get('hasil_seleksi');
	$soal = $this->db->get('soal');
?>

<div class="col-lg-4 col-xs-4">
	<div class="small-box bg-aqua">
		<div class="inner">
			<h3><?php echo $siswa->num_rows(); ?></h3>
			<p>Siswa</p>
		</div>
		<div class="icon">
			<i class="fa fa-users"></i>
		</div>
		<a href="<?php echo base_url('admin/siswa'); ?>" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
	</div>
</div>
<div class="col-lg-4 col-xs-4">
	<div class="small-box bg-green">
		<div class="inner">
			<h3><?php echo $unggulan->num_rows(); ?></h3>
			<p>Unggulan</p>
		</div>
		<div class="icon">
			<i class="fa fa-cogs"></i>
		</div>
		<a href="<?php echo base_url('admin/unggulan'); ?>" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
	</div>
</div>
<div class="col-lg-4 col-xs-4">
	<div class="small-box bg-yellow">
		<div class="inner">
			<h3><?php echo $soal-> num_rows(); ?></h3>
			<p>Soal</p>
		</div>
		<div class="icon">
			<i class="fa fa-list"></i>
		</div>
		<a href="<?php echo base_url('admin/soal'); ?>" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
	</div>
</div>
<div class="col-lg-6 col-xs-6">
	<div class="small-box bg-red">
		<div class="inner">
			<h3><?php echo $hasil_seleksi->num_rows(); ?></h3>
			<p>Perhitungan</p>
		</div>
		<div class="icon">
			<!-- <i class="ion ion-pie-graph"></i> -->
			<i class="ion ion-stats-bars"></i>
		</div>
		<a href="<?php echo base_url('admin/perhitungan'); ?>" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
	</div>
</div>
<div class="col-lg-6 col-xs-6">
	<div class="small-box bg-blue">
		<div class="inner">
			<h3>5</h3>
			<p>Saran</p>
		</div>
		<div class="icon">
			<!-- <i class="ion ion-pie-graph"></i> -->
			<i class="fa fa-envelope-o"></i>
		</div>
		<a href="<?php echo base_url('admin/saran'); ?>" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
	</div>
</div>