<div class="col-md-8 col-md-offset-2">
<div class="panel panel-default">
	<!-- <div class="panel-heading"><?php echo $title; ?></div> -->
	<br>
	<div class="panel-body">
		<?php echo $this->session->flashdata('pesan'); ?>
		<div class="row">
			<form method="post" action="<?php echo base_url('welcome/proses_daftar'); ?>">
				<div class="col-md-12">
					<div class="text-center">
							<img src="<?php echo base_url('assets/img/sma2.png'); ?>" style="width: 150px">
						</div>
						<br>
						<?php echo $this->session->flashdata('pesan'); ?>
						<div class="text-center">
							<p><small><i>Silahkan melakukan pendaftaran</i></small></p>
						</div>
					<div class="form-group">
						<label>Nama Siswa</label>
						<input type="text" name="nama_siswa" class="form-control" placeholder="Nama Siswa">
					</div>
					<div class="form-group">
						<label>Jenis Kelamin</label>
						<select name="jenis_kelamin" class="form-control">
							<option value="L">Laki-laki</option>
							<option value="P">Perempuan</option>
						</select>
					</div>
					<div class="form-group">
						<label>Tempat Lahir</label>
						<input type="text" name="tempat_lahir" class="form-control" placeholder="Tempat Lahir">
					</div>
					<div class="form-group">
						<label>Tanggal Lahir</label>
						<input type="text" name="tanggal_lahir" class="form-control" placeholder="Tanggal Lahir">
					</div>
					<div class="form-group">
						<label>Alamat</label>
						<textarea name="alamat" class="form-control" placeholder="Alamat"></textarea>
					</div>
					<div class="form-group">
						<label>No. Hp</label>
						<input type="text" name="no_hp" class="form-control" placeholder="No. Hp">
					</div>
					<div class="form-group">
						<label>Email</label>
						<input type="text" name="email" class="form-control" placeholder="Email">
					</div>
					<div class="form-group">
						<label>Username</label>
						<input type="text" name="username" class="form-control" placeholder="Username">
					</div>
					<div class="form-group">
						<label>Password</label>
						<input type="password" name="password" class="form-control" placeholder="Password">
					</div>
					<div class="form-group">
						<label>Ulangi Password</label>
						<input type="password" name="ulangi_password" class="form-control" placeholder="Ulangi Password">
					</div>
				</div>
				<div class="col-md-12">
					<button type="submit" class="btn btn-primary">Daftar</button>
					<a href="<?php echo base_url(); ?>" class="btn btn-danger">Batal</a>
				</div>
			</form>
		</div>
	</div>
</div>
</div>