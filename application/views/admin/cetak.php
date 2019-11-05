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
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body onload="window.print();">
	<div class="wrapper">
		<section class="invoice">
			<div class="row">
				<div class="col-xs-12">
					<h2 class="page-header">
						<i class="fa fa-globe"></i> Sistem Penentuan Kelas Unggulan
						<small class="pull-right">Date: <?php echo date('d/m/Y'); ?></small>
					</h2>
				</div>
			</div>
			<!-- <div class="row invoice-info">
				<div class="col-sm-4 invoice-col">
					From
					<address>
						<strong>Admin, Inc.</strong><br>
						795 Folsom Ave, Suite 600<br>
						San Francisco, CA 94107<br>
						Phone: (804) 123-5432<br>
						Email: info@almasaeedstudio.com
					</address>
				</div>
				<div class="col-sm-4 invoice-col">
					To
					<address>
						<strong>John Doe</strong><br>
						795 Folsom Ave, Suite 600<br>
						San Francisco, CA 94107<br>
						Phone: (555) 539-1037<br>
						Email: john.doe@example.com
					</address>
				</div>
				<div class="col-sm-4 invoice-col">
					<b>Invoice #007612</b><br>
					<br>
					<b>Order ID:</b> 4F3S8J<br>
					<b>Payment Due:</b> 2/22/2014<br>
					<b>Account:</b> 968-34567
				</div>
			</div> -->
			<div class="row">
				<div class="col-xs-12 table-responsive">
					<table class="table table-striped table-bordered">
						<thead>
							<tr>
								<th>Ranking</th>
								<th>Nama</th>
								<th>Vektor S</th>
								<th>Vektor V</th>
								<th>Status</th>

							</tr>
						</thead>
						<tbody>
							<?php $no=1; foreach ($data as $value) { ?>
							<tr>
								<td><?php echo $no; ?></td>
								<td><?php echo $value->nama_siswa; ?></td>
								<td><?php echo $value->vektor_s; ?></td>
								<td><?php echo $value->vektor_v; ?></td>
								<td><?php echo $value->status; ?></td>
							</tr>
							<?php $no++; } ?>
						</tbody>
					</table>
				</div>
			</div>
		</section>
	</div>
</body>
</html>
