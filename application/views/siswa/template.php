<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo $title; ?> - Sistem Penentuan Kelas Unggulan</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/bower_components/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/bower_components/Ionicons/css/ionicons.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/dist/css/AdminLTE.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/dist/css/skins/_all-skins.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/bower_components/morris.js/morris.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/bower_components/jvectormap/jquery-jvectormap.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
</head>
<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">
		<header class="main-header">
			<a href="<?php echo base_url('siswa'); ?>" class="logo">
				<span class="logo-mini">
					<img src="<?php echo base_url('assets/img/kemenag.png'); ?>" style="height: 40px">
				</span>
				<span class="logo-lg"><img src="<?php echo base_url('assets/img/kemenag.png'); ?>" style="height: 40px"><b> MTSN 1 KP</b></span>
			</a>
			<nav class="navbar navbar-static-top">
				<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
					<span class="sr-only">Toggle navigation</span>
				</a>
				<div class="navbar-custom-menu">
					<ul class="nav navbar-nav">
						<li class="dropdown user user-menu">
							<?php  
								$query = $this->db->get_where('siswa', array('id_siswa' => $this->session->userdata('id_siswa')));
							?>
							<?php foreach ($query->result() as $value) { ?>
							<?php if ($value->foto=='') { ?>
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<img src="<?php echo base_url(); ?>assets/img/pp.jpg" class="user-image" alt="User Image">
								<span class="hidden-xs" style="text-transform: capitalize;"><?php echo $this->session->userdata('nama_siswa'); ?></span>
							</a>
							<?php } else { ?>
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<img src="<?php echo base_url('assets/img/'.$value->foto); ?>" class="user-image" alt="User Image">
								<span class="hidden-xs" style="text-transform: capitalize;"><?php echo $this->session->userdata('nama_siswa'); ?></span>
							</a>
							<?php } ?>
							<ul class="dropdown-menu">
								<li class="user-header">
									<?php if ($value->foto=='') { ?>
									<img src="<?php echo base_url(); ?>assets/img/pp.jpg" class="img-circle" alt="User Image">
									<?php } else { ?>
									<img src="<?php echo base_url('assets/img/'.$value->foto); ?>" class="img-circle" alt="User Image">
									<?php } ?>
									<p style="text-transform: capitalize;">
										<?php echo $this->session->userdata('nama_siswa'); ?>
										<small><?php echo $this->session->userdata('last_login'); ?></small>
									</p>
								</li>
								<li class="user-footer">
									<div class="pull-left">
										<a href="<?php echo base_url('siswa/profil'); ?>" class="btn btn-default btn-flat">Profile</a>
									</div>
									<div class="pull-right">
										<a href="<?php echo base_url('keluar'); ?>" class="btn btn-default btn-flat">Keluar</a>
									</div>
								</li>
							</ul>
							<?php } ?>
						</li>
					</ul>
				</div>
			</nav>
		</header>
		<aside class="main-sidebar">
			<section class="sidebar">
				<div class="user-panel">
					<?php  
						$query = $this->db->get_where('siswa', array('id_siswa' => $this->session->userdata('id_siswa')));
					?>
					<?php foreach ($query->result() as $value) { ?>
					<div class="pull-left image">
						<?php if ($value->foto=='') { ?>
						<img src="<?php echo base_url(); ?>assets/img/pp.jpg" class="img-circle" alt="User Image">
						<?php } else { ?>
						<img src="<?php echo base_url('assets/img/'.$value->foto); ?>" class="img-circle" alt="User Image">
						<?php } ?>
					</div>
					<?php } ?>
					<div class="pull-left info">
						<p style="text-transform: capitalize;"><?php echo $this->session->userdata('nama_siswa'); ?></p>
						<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
					</div>
				</div>
				<ul class="sidebar-menu" data-widget="tree">
					<li class="header">MANAJEMEN MENU</li>
					<li><a href="<?php echo base_url('siswa'); ?>"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
					<li><a href="<?php echo base_url('siswa/nilai-ujian-nasional'); ?>"><i class="fa fa-file-text-o"></i> <span>Nilai</span></a></li>
					<li><a href="<?php echo base_url('siswa/mulai-ujian'); ?>"><i class="fa fa-pencil"></i> <span>Ujian Psikotest</span></a></li>
					<li><a href="<?php echo base_url('siswa/pengumuman'); ?>"><i class="fa fa-list-alt"></i> <span>Pengumuman</span></a></li>
				</ul>
			</section>
		</aside>
		<div class="content-wrapper">
			<section class="content-header">
				<h1>
					<?php echo $title; ?>
					<!-- <small>Control panel</small> -->
				</h1>
				<ol class="breadcrumb">
					<li><a href="<?php echo base_url('siswa'); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
					<li class="active"><?php echo $title; ?></li>
				</ol>
			</section>
			<section class="content">
				<div class="row">
					<?php require_once $halaman.'.php'; ?>
				</div>
			</section>
		</div>
		<footer class="main-footer">
			<strong>© 2019 - MTSN 1 KULON PROGO <a href="https://adminlte.io"></a></strong>
		</footer>
	</div>
	<script src="<?php echo base_url(); ?>assets/adminlte/bower_components/jquery/dist/jquery.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/adminlte/bower_components/jquery-ui/jquery-ui.min.js"></script>
	<script>
		$.widget.bridge('uibutton', $.ui.button);
	</script>
	<script src="<?php echo base_url(); ?>assets/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/adminlte/bower_components/raphael/raphael.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/adminlte/bower_components/morris.js/morris.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/adminlte/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/adminlte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
	<script src="<?php echo base_url(); ?>assets/adminlte/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/adminlte/bower_components/moment/min/moment.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
	<script src="<?php echo base_url(); ?>assets/adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/adminlte/bower_components/fastclick/lib/fastclick.js"></script>
	<script src="<?php echo base_url(); ?>assets/adminlte/dist/js/adminlte.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/adminlte/dist/js/pages/dashboard.js"></script>
	<script src="<?php echo base_url(); ?>assets/adminlte/dist/js/demo.js"></script>
	<script src="<?php echo base_url(); ?>assets/adminlte/bower_components/ckeditor/ckeditor.js"></script>
	<script src="<?php echo base_url(); ?>assets/adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
	<script type="text/javascript">
		CKEDITOR.replace('editor1');
		CKEDITOR.replace('editor2');
		CKEDITOR.replace('editor3');
		CKEDITOR.replace('editor4');
	</script>
	<script>
		$(function () {
			$('#example0').DataTable({
				'paging'      : false,
				'lengthChange': false,
				'searching'   : false,
				'ordering'    : false,
				'info'        : true,
				'autoWidth'   : false
			})
			$('#example1').DataTable()
			$('#example2').DataTable({
				'paging'      : true,
				'lengthChange': false,
				'searching'   : false,
				'ordering'    : true,
				'info'        : true,
				'autoWidth'   : false
			})
		})
	</script>
</body>
</html>