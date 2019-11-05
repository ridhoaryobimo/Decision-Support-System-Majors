<div class="col-xs-12">
	<div class="box box-primary">
		<div class="box-header">
			<h3 class="box-title">
				<a href="#" data-toggle="modal" data-target="#tambah" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah</a>
			</h3>
		</div>
		<div class="box-body">
			<?php echo $this->session->flashdata('pesan'); ?>
			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>No</th>
						<th style="width: 80px">Aksi</th>
						<th>Nama</th>
						<th>Jenis Kelamin</th>
						<th>Tempat Lahir</th>
						<th>Tanggal Lahir</th>
						<th>Alamat</th>
						<th>Nilai</th>
					</tr>
				</thead>
				<tbody>
					<?php $no=1; foreach ($data as $value) { ?>
					<tr>
						<td><?php echo $no; ?></td>
						<td>
							<a href="#" data-toggle="modal" data-target="#ubah<?php echo $value->id_siswa; ?>" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></a>
							<a href="#" data-toggle="modal" data-target="#hapus<?php echo $value->id_siswa; ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
						</td>
						<td><?php echo $value->nama_siswa; ?></td>
						<td><?php echo $value->jenis_kelamin; ?></td>
						<td><?php echo $value->tempat_lahir; ?></td>
						<td><?php echo $value->tanggal_lahir; ?></td>
						<td><?php echo $value->alamat; ?></td>
						<td>
							<a href="<?php echo base_url('admin/nilai/'.$value->id_siswa); ?>" class="btn btn-primary btn-xs">Nilai</a>
						</td>
					</tr>
					<?php $no++; } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<div class="modal fade" id="tambah" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Tambah Siswa</h4>
			</div>
			<form method="post" action="<?php echo base_url('admin/insert_siswa'); ?>">
			<div class="modal-body">
				<div class="row">
					<div class="col-md-6">
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
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>No. Hp</label>
							<input type="text" name="no_hp" class="form-control" placeholder="No. Hp">
						</div>
						<div class="form-group">
							<label>Email</label>
							<input type="email" name="email" class="form-control" placeholder="Email">
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
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary">Simpan</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
			</div>
			</form>
		</div>
	</div>
</div>
<?php foreach ($data as $value) { ?>
<div class="modal fade" id="ubah<?php echo $value->id_siswa; ?>" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Ubah Siswa</h4>
			</div>
			<form method="post" action="<?php echo base_url('admin/update_siswa'); ?>">
			<input type="hidden" name="id_siswa" value="<?php echo $value->id_siswa; ?>">
			<div class="modal-body">
				<div class="row">
					<div class="col-md-6">
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
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>No. Hp</label>
							<input type="text" name="no_hp" value="<?php echo $value->no_hp; ?>" class="form-control" placeholder="No. Hp">
						</div>
						<div class="form-group">
							<label>Email</label>
							<input type="email" name="email" value="<?php echo $value->email; ?>" class="form-control" placeholder="Email">
						</div>
						<div class="form-group">
							<label>Username</label>
							<input type="text" name="username" value="<?php echo $value->username; ?>" class="form-control" placeholder="Username">
						</div>
						<div class="form-group">
							<label>Password Baru</label>
							<input type="password" name="password" class="form-control" placeholder="Password Baru">
						</div>
						<div class="form-group">
							<label>Ulangi Password Baru</label>
							<input type="password" name="ulangi_password" class="form-control" placeholder="Ulangi Password Baru">
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary">Simpan</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
			</div>
			</form>
		</div>
	</div>
</div>
<div class="modal fade" id="hapus<?php echo $value->id_siswa; ?>" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Hapus Siswa</h4>
			</div>
			<form method="post" action="<?php echo base_url('admin/delete_siswa'); ?>">
				<input type="hidden" name="id_siswa" value="<?php echo $value->id_siswa; ?>">
				<div class="modal-body">
					<p>Apakah Anda Yakin Ingin Menghapus ?</p>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Ya</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
				</div>
			</form>
		</div>
	</div>
</div>
<?php } ?>