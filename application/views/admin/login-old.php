<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title; ?> - Sistem Penentuan Jurusan</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.css'); ?>">
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body style="background: #f5f5f5">
	<div class="col-md-4 col-md-offset-4">
		<div class="panel panel-default">
			<form method="post" action="<?php echo base_url('auth/login'); ?>">
			<div class="panel-body" style="padding: 50px">
				<div class="text-center">
					<img src="<?php echo base_url('assets/img/sma2.png'); ?>" style="width: 150px">
				</div>
				<br>
				<div class="text-center">
					<p><small><i>Silahkan Login dengan Username dan Password anda</i></small></p>
				</div>
				<br>
				<?php echo $this->session->flashdata('pesan'); ?>
				<div class="form-group">
					<label class="fa fa-user"> Username</label>
					<input type="text" name="username" class="form-control" placeholder="Username">
				</div>
				<div class="form-group">
					<label class="fa fa-key"> Password</label>
					<input type="password" name="password" class="form-control" placeholder="Password">
				</div>
				<button type="submit" class="btn btn-primary">Masuk</button>
				<button type="reset" class="btn btn-danger">Reset</button>
			</div>
			</form>
		</div>
	</div>
	<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-3.3.1.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.js'); ?>"></script>
</body>
</html>