<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title; ?> - Sistem Penentuan Jurusan</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.css'); ?>">
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"> 
</head>
<body style="background: #f5f5f5">
	<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#"><img src="<?php echo base_url('assets/img/sma2.png'); ?>" style="width: 25px"></a>
			</div>
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<p class="navbar-text" style="text-transform: uppercase;">SMA Negeri 2 Tebo</p>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<?php if ($this->session->userdata('id_siswa')) { ?>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="text-transform: uppercase;"><?php echo $this->session->userdata('nama_siswa'); ?> <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Halaman Depan</a></li>
							<!-- <li role="separator" class="divider"></li>
							<li><a href="#">Another action</a></li>
							<li role="separator" class="divider"></li>
							<li><a href="#">Something else here</a></li>
							<li role="separator" class="divider"></li> -->
							<li><a href="<?php echo base_url('keluar'); ?>"><i class="fa fa-sign-out"></i> Keluar</a></li>
						</ul>
					</li>
					<?php } ?>
				</ul>
			</div>
		</div>
	</nav>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-3">
				<div class="panel panel-default">
					<div class="panel-body text-center">
						<?php  
							$query = $this->db->get_where('siswa', array('id_siswa' => $this->session->userdata('id_siswa')));
						?>
						<?php foreach ($query->result() as $value) { ?>
						<?php if ($value->foto=='') { ?>
						<a href="#" data-toggle="modal" data-target="#foto"><img src="<?php echo base_url('assets/img/pp.jpg'); ?>" class="img-circle" style="width: 120px; height: 120px"></a>
						<?php } else { ?>
						<a href="#" data-toggle="modal" data-target="#foto"><img src="<?php echo base_url('assets/img/'.$value->foto); ?>" class="img-circle" style="width: 120px; height: 120px"> </a>
						<?php } ?>
						<h4 style="text-transform: uppercase;">
							<?php echo $value->nama_siswa; ?>
						</h4>
						<?php } ?>
						<p><a href="<?php echo base_url('siswa/profil'); ?>" class="btn btn-primary">Ubah Profil</a></p>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="list-group">
							<a href="<?php echo base_url('siswa'); ?>" class="list-group-item"><i class="fa fa-home"></i> Dashboard</a>
							<a href="<?php echo base_url('siswa/nilai-ujian-nasional'); ?>" class="list-group-item"><i class="fa fa-file-text-o"></i> Nilai Ujian Nasional</a>
							<a href="<?php echo base_url('siswa/ujian-peminatan'); ?>" class="list-group-item"><i class="fa fa-pencil"></i> Ujian Peminatan</a>
							<a href="<?php echo base_url('siswa/pengumuman'); ?>" class="list-group-item"><i class="fa fa-list-alt"></i> Pengumuman</a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-9">
				<?php require_once $halaman.'.php'; ?>
			</div>
			<div class="modal fade" id="foto" tabindex="-1" role="dialog">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title">Upload Foto</h4>
						</div>
						<form method="post" action="<?php echo base_url('siswa/update_foto'); ?>" enctype="multipart/form-data">
						<div class="modal-body">
							<input type="file" name="userfile">
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-primary">Simpan</button>
							<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
						</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-3.3.1.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.js'); ?>"></script>
</body>
</html>