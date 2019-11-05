<div class="col-xs-12">
	<div class="box box-primary">
		<div class="box-body">
			<?php echo $this->session->flashdata('pesan'); ?>
			<?php foreach ($data as $value) { ?>
				<form method="post" action="<?php echo base_url('admin/update_profil'); ?>" enctype="multipart/form-data">
					<div class="form-group">
						<?php if ($value->foto=='') { ?>
							<a href="#" data-toggle="modal" data-target="#foto"><img src="<?php echo base_url(); ?>assets/img/pp.jpg" class="img-rounded" alt="User Image" style="width: 170px"></a>
						<?php } else { ?>
							<a href="#" data-toggle="modal" data-target="#foto"><img src="<?php echo base_url('assets/img/'.$value->foto); ?>" class="img-rounded" alt="User Image" style="width: 170px"></a>
						<?php } ?>
					</div>
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
					<button type="submit" class="btn btn-primary">Simpan</button>
					<a href="<?php echo base_url('admin'); ?>" class="btn btn-danger">Batal</a>
				</form>
			<?php } ?>
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
			<form method="post" action="<?php echo base_url('admin/update_foto'); ?>" enctype="multipart/form-data">
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