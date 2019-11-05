<?php  
	$siswa = $this->db->get('siswa');
	$jurusan = $this->db->get('jurusan');
	$saran = $this->db->get('saran');
?>
<div class="panel panel-default">
	<div class="panel-body text-center">
		<div class="row">
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">Siswa</div>
					<div class="panel-body">
						<h3><i class="fa fa-users"></i> <?php echo $siswa->num_rows(); ?></h3>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">Jurusan</div>
					<div class="panel-body">
						<h3><i class="fa fa-cogs"></i> <?php echo $jurusan->num_rows(); ?></h3>
						</div>
					</div>
				</div>
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">Saran</div>
					<div class="panel-body">
						<h3><i class="fa fa-envelope"></i> <?php echo $saran->num_rows(); ?></h3>
						</div>
					</div>
				</div>
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">Jurusan</div>
					<div class="panel-body">
						<h3><i class="fa fa-cogs"></i> <?php echo $jurusan->num_rows(); ?></h3>
						</div>
					</div>
				</div>
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">Jurusan</div>
					<div class="panel-body">
						<h3><i class="fa fa-cogs"></i> <?php echo $jurusan->num_rows(); ?></h3>
						</div>
					</div>
				</div>
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">Jurusan</div>
					<div class="panel-body">
						<h3><i class="fa fa-cogs"></i> <?php echo $jurusan->num_rows(); ?></h3>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>