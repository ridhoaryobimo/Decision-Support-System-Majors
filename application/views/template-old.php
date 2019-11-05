<!-- <!DOCTYPE html>
<html>
<head>
	<title><?php echo $title; ?> - Sistem Penentuan Jurusan</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.css'); ?>">
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"> 
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/dataTables.bootstrap.min.css'); ?>">
</head>
<body class="bg">
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
					<?php include 'menu.php'; ?>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<?php if (!$this->session->userdata('id_siswa')) { ?>
					<?php if ($halaman=='daftar') { ?>
					<li class="active"><a href="<?php echo base_url('daftar'); ?>">Daftar</a></li>
					<li><a href="<?php echo base_url('login'); ?>">Login</a></li>
					<?php } elseif ($halaman=='login') { ?>
					<li><a href="<?php echo base_url('daftar'); ?>">Daftar</a></li>
					<li class="active"><a href="<?php echo base_url('login'); ?>">Login</a></li>
					<?php } else { ?>
					<li><a href="<?php echo base_url('daftar'); ?>">Daftar</a></li>
					<li><a href="<?php echo base_url('login'); ?>">Login</a></li>
					<?php } ?>
					<?php } ?>
					<?php if ($this->session->userdata('id_siswa')) { ?>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="text-transform: uppercase;"><?php echo $this->session->userdata('nama_siswa'); ?> <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="<?php echo base_url('siswa'); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
							<!-- <li role="separator" class="divider"></li>
							<li><a href="#">Another action</a></li>
							<li role="separator" class="divider"></li><li><a href="#">Something else here</a></li>
							<li role="separator" class="divider"></li> -->
	<!-- 						<li><a href="<?php echo base_url('keluar'); ?>"><i class="fa fa-sign-out"></i> Keluar</a></li>
						</ul>
					</li>
					<?php } ?>
				</ul>
			</div>
		</div>
	</nav>
	<div class="container-fluid">
		<?php require_once $halaman.'.php'; ?>
	</div>
	<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-3.3.1.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.dataTables.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/dataTables.bootstrap.min.js'); ?>"></script>
	<?php include 'footer.php'; ?>
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
</body>
</html> -->