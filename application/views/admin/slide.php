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
						<th>Gambar</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>
					<?php $no=1; foreach ($data as $value) { ?>
					<tr>
						<td><?php echo $no; ?></td>
						<td>
							<a href="#" data-toggle="modal" data-target="#ubah<?php echo $value->id_slide; ?>" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></a>
							<a href="#" data-toggle="modal" data-target="#hapus<?php echo $value->id_slide; ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
						</td>
						<td>
							<a href="<?php echo base_url('assets/slide/'.$value->gambar); ?>" target="_blank"><img src="<?php echo base_url('assets/slide/'.$value->gambar); ?>" style="width: 120px"></a>
						</td>
						<td>
							<?php if ($value->status==1) {
								echo 'Aktif';
							} else {
								echo 'Tidak Aktif';
							} ?>
						</td>
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
				<h4 class="modal-title">Tambah Slide</h4>
			</div>
			<form method="post" action="<?php echo base_url('admin/insert_slide'); ?>" enctype="multipart/form-data">
			<div class="modal-body">
				<div class="form-group">
					<label>Gambar</label>
					<input type="file" name="userfile">
				</div>
				<div class="form-group">
					<label>Status</label>
					<select name="status" class="form-control">
						<option value="1">Aktif</option>
						<option value="0">Tidak Aktif</option>
					</select>
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
<div class="modal fade" id="ubah<?php echo $value->id_slide; ?>" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Ubah Slide</h4>
			</div>
			<form method="post" action="<?php echo base_url('admin/update_slide'); ?>" enctype="multipart/form-data">
			<input type="hidden" name="id_slide" value="<?php echo $value->id_slide; ?>">
			<div class="modal-body">
				<div class="form-group">
					<label>Gambar</label>
					<input type="file" name="userfile">
				</div>
				<div class="form-group">
					<label>Status</label>
					<select name="status" class="form-control">
						<option value="1">Aktif</option>
						<option value="0">Tidak Aktif</option>
					</select>
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
<div class="modal fade" id="hapus<?php echo $value->id_slide; ?>" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Hapus Slide</h4>
			</div>
			<form method="post" action="<?php echo base_url('admin/delete_slide'); ?>">
				<input type="hidden" name="id_slide" value="<?php echo $value->id_slide; ?>">
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