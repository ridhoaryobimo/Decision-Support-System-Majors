<div class="col-xs-12">
	<div class="box box-primary">
		<div class="box-body">
			<?php echo $this->session->flashdata('pesan'); ?>
			<ul class="nav nav-tabs" role="tablist">
				<li role="presentation" class="active">
					<a href="#a" aria-controls="a" role="tab" data-toggle="tab">Data Diri</a>
				</li>
				<li role="presentation">
					<a href="#b" aria-controls="b" role="tab" data-toggle="tab">Akun</a>
				</li>
			</ul>
			<br>
			<div class="tab-content">
				<div role="tabpanel" class="tab-pane active" id="a">
					<div class="row">
						<form method="post" action="<?php echo base_url('siswa/update_profil'); ?>">
							<?php foreach ($data as $value) { ?>
								<div class="col-md-6">
									<div class="form-group">
										<?php if ($value->foto=='') { ?>
											<a href="#" data-toggle="modal" data-target="#foto"><img src="<?php echo base_url(); ?>assets/img/pp.jpg" class="img-rounded" alt="User Image" style="width: 170px"></a>
										<?php } else { ?>
											<a href="#" data-toggle="modal" data-target="#foto"><img src="<?php echo base_url('assets/img/'.$value->foto); ?>" class="img-rounded" alt="User Image" style="width: 170px"></a>
										<?php } ?>
									</div>
									<div class="form-group">
										<label>Nama Siswa</label>
										<input type="text" name="nama_siswa" value="<?php echo $value->nama_siswa; ?>" class="form-control" placeholder="Nama Siswa">
									</div>
									<div class="form-group">
										<label>Jenis Kelamin</label>
										<select name="jenis_kelamin" class="form-control">
											<?php if ($value->jenis_kelamin=='L') {
												echo '<option value="L">Laki-laki</option>
												<option value="P">Perempuan</option>';
											} else {
												echo '<option value="P">Perempuan</option>
												<option value="L">Laki-laki</option>';
											} ?>
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Tempat Lahir</label>
										<input type="text" name="tempat_lahir" value="<?php echo $value->tempat_lahir; ?>" class="form-control" placeholder="Tempat Lahir">
									</div>
									<div class="form-group">
										<label>Tanggal Lahir</label>
										<input type="text" name="tanggal_lahir" value="<?php echo $value->tanggal_lahir; ?>" class="form-control" placeholder="Tanggal Lahir">
									</div>
									<div class="form-group">
										<label>Alamat</label>
										<textarea name="alamat" class="form-control" placeholder="Alamat"><?php echo $value->alamat; ?></textarea>
									</div>
									<div class="form-group">
										<label>No. Hp</label>
										<input type="text" name="no_hp" value="<?php echo $value->no_hp; ?>" class="form-control" placeholder="No. Hp">
									</div>
								</div>
							<?php } ?>
							<div class="col-md-12">
								<button type="submit" class="btn btn-primary">Simpan</button>
								<a href="<?php echo base_url('siswa'); ?>" class="btn btn-danger">Batal</a>
							</div>
						</form>
					</div>
				</div>
				<div role="tabpanel" class="tab-pane" id="b">
					<form method="post" action="<?php echo base_url('siswa/update_akun'); ?>">
						<div class="form-group">
							<label>Email</label>
							<input type="text" name="email" value="<?php echo $value->email; ?>" class="form-control" placeholder="Email">
						</div>
						<div class="form-group">
							<label>Username</label>
							<input type="text" name="username" value="<?php echo $value->username; ?>" class="form-control" placeholder="Username">
						</div>
						<div class="form-group">
							<label>Password Baru</label>
							<input type="password" name="password" class="form-control" placeholder="Password">
						</div>
						<div class="form-group">
							<label>Ulangi Password Baru</label>
							<input type="password" name="ulangi_password" class="form-control" placeholder="Ulangi Password">
						</div>
						<button type="submit" class="btn btn-primary">Simpan</button>
						<a href="<?php echo base_url('siswa'); ?>" class="btn btn-danger">Batal</a>
					</form>
				</div>
			</div>
		</div>
	</div>
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