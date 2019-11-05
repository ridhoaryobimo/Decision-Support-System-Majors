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
						<th style="width: 20px">No</th>
						<th style="width: 80px">Aksi</th>
						<th>Nama</th>
						<th>Username</th>
						<th>Last Login</th>
					</tr>
				</thead>
				<tbody>
					<?php $no=1; foreach ($data as $value) { ?>
					<tr>
						<td><?php echo $no; ?></td>
						<td>
							<a href="#" data-toggle="modal" data-target="#ubah<?php echo $value->id_admin; ?>" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></a>
							<a href="#" data-toggle="modal" data-target="#hapus<?php echo $value->id_admin; ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
						</td>
						<td><?php echo $value->nama_admin; ?></td>
						<td><?php echo $value->username; ?></td>
						<td><?php echo $value->last_login; ?></td>
					</tr>
					<?php $no++; } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<div class="modal fade" id="tambah" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Tambah Admin</h4>
			</div>
			<form method="post" action="<?php echo base_url('admin/insert_admin'); ?>">
			<div class="modal-body">
				<div class="form-group">
					<label>Nama Admin</label>
					<input type="text" name="nama_admin" class="form-control" placeholder="Nama Admin">
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
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary">Simpan</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
			</div>
			</form>
		</div>
	</div>
</div>
<?php foreach ($data as $value) { ?>
<div class="modal fade" id="ubah<?php echo $value->id_admin; ?>" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Ubah Admin</h4>
			</div>
			<form method="post" action="<?php echo base_url('admin/update_admin'); ?>">
			<input type="hidden" name="id_admin" value="<?php echo $value->id_admin; ?>">
			<div class="modal-body">
				<div class="form-group">
					<label>Nama Admin</label>
					<input type="text" name="nama_admin" value="<?php echo $value->nama_admin; ?>" class="form-control" placeholder="Nama Admin">
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
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary">Simpan</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
			</div>
			</form>
		</div>
	</div>
</div>
<div class="modal fade" id="hapus<?php echo $value->id_admin; ?>" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Hapus Admin</h4>
			</div>
			<form method="post" action="<?php echo base_url('admin/delete_admin'); ?>">
				<input type="hidden" name="id_admin" value="<?php echo $value->id_admin; ?>">
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