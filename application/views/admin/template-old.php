<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title; ?> - Sistem Penentuan Jurusan</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.css'); ?>">
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/dataTables.bootstrap.min.css'); ?>">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">  
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css'); ?>">
</head>
<body style="background: #f5f5f5;">
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
					<?php if ($this->session->userdata('id_admin')) { ?>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="text-transform: uppercase;"><?php echo $this->session->userdata('nama_admin'); ?> <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="<?php echo base_url('admin/profil'); ?>"><i class="fa fa-user"></i> Profil</a></li>
							<li role="separator" class="divider"></li>
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
					<div class="panel-heading">Manajemen Konten</div>
					<div class="panel-body">
						<div class="list-group">
							<a href="<?php echo base_url('admin'); ?>" class="list-group-item"><i class="fa fa-home"></i> Dashboard</a>
							<a href="<?php echo base_url('admin/informasi'); ?>" class="list-group-item"><i class="fa fa-info"></i> Informasi</a>
							<a href="<?php echo base_url('admin/slide'); ?>" class="list-group-item"><i class="fa fa-sliders"></i> Slide</a>
							<a href="<?php echo base_url('admin/berita'); ?>" class="list-group-item"><i class="fa fa-newspaper-o"></i> Berita</a>
							<a href="<?php echo base_url('admin/pengumuman'); ?>" class="list-group-item"><i class="fa fa-newspaper-o"></i> Pengumuman</a>
							<a href="<?php echo base_url('admin/agenda'); ?>" class="list-group-item"><i class="fa fa-list"></i> Agenda</a>
							<a href="<?php echo base_url('admin/galeri'); ?>" class="list-group-item"><i class="fa fa-camera-retro"></i> Galeri</a>
							<a href="<?php echo base_url('admin/download'); ?>" class="list-group-item"><i class="fa fa-line-chart"></i> Download</a>
							<a href="<?php echo base_url('admin/saran'); ?>" class="list-group-item"><i class="fa fa-envelope-o"></i> Saran</a>
						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">Manajemen Penjurusan</div>
					<div class="panel-body">
						<div class="list-group">
							<a href="<?php echo base_url('admin/siswa'); ?>" class="list-group-item"><i class="fa fa-users"></i> Siswa</a>
							<a href="<?php echo base_url('admin/jurusan'); ?>" class="list-group-item"><i class="fa fa-cogs"></i> Jurusan</a>
							<a href="<?php echo base_url('admin/soal'); ?>" class="list-group-item"><i class="fa fa-list"></i> Soal</a>
							<a href="<?php echo base_url('admin/perhitungan'); ?>" class="list-group-item"><i class="fa fa-line-chart"></i> Perhitungan</a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-9">
				<?php require_once $halaman.'.php'; ?>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-3.3.1.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.dataTables.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/dataTables.bootstrap.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/ckeditor/ckeditor.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js'); ?>"></script>
	<script type="text/javascript">
		CKEDITOR.replace('editor1');
		CKEDITOR.replace('editor2');
		CKEDITOR.replace('editor3');
		CKEDITOR.replace('editor4');
	</script>
	<?php  
		$berita = $this->db->get('berita');
	?>
	<?php foreach ($berita->result() as $key) { ?>
	<script type="text/javascript">
		CKEDITOR.replace('editor<?php echo $key->id_berita; ?>');
	</script>
	<?php } ?>
	<script>
		$(function () {
			$('#tbl').DataTable({
				"paging": true,
				"lengthChange": true,
				"searching": true,
				"ordering": true,
				"info": true,
				"autoWidth": true
			});
		});
	</script>
	<script>
		$('#datepicker').datepicker({
			autoclose: true,
			format: 'dd/mm/yyyy',
		});
		$('#datepicker2').datepicker({
			autoclose: true,
			format: 'dd/mm/yyyy',
		});
	</script>
</body>
</html>