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
						<th>Download</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>
					<?php $no=1; foreach ($data as $value) { ?>
					<tr>
						<td><?php echo $no; ?></td>
						<td>
							<a href="#" data-toggle="modal" data-target="#ubah<?php echo $value->id_download; ?>" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></a>
							<a href="#" data-toggle="modal" data-target="#hapus<?php echo $value->id_download; ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
						</td>
						<td>
							<?php echo $value->nama; ?>
						</td>
						<td>
							<a href="#" data-toggle="modal" data-target="#file<?php echo $value->id_download; ?>"><?php echo $value->download; ?></a>
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
				<h4 class="modal-title">Tambah Download</h4>
			</div>
			<form method="post" action="<?php echo base_url('admin/insert_download'); ?>" enctype="multipart/form-data">
			<div class="modal-body">
				<div class="form-group">
					<label>Nama</label>
					<input type="text" name="nama" class="form-control" placeholder="nama">
				</div>
				<div class="form-group">
					<label>Downlaod</label>
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
<div class="modal fade" id="ubah<?php echo $value->id_download; ?>" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Ubah Download</h4>
			</div>
			<form method="post" action="<?php echo base_url('admin/update_download'); ?>" enctype="multipart/form-data">
			<input type="hidden" name="id_download" value="<?php echo $value->id_download; ?>">
			<div class="modal-body">
				<div class="form-group">
					<label>Nama</label>
					<input type="text" name="nama" value="<?php echo $value->nama; ?>" class="form-control" placeholder="nama">
				</div>
				<div class="form-group">
					<label>Status</label>
					<select name="status" class="form-control">
						<?php if ($value->status==1) {
							echo '<option value="1">Aktif</option>
							<option value="0">Tidak Aktif</option>';
						} else {
							echo '<option value="0">Tidak Aktif</option>
							<option value="1">Aktif</option>';
						} ?>
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
<div class="modal fade" id="file<?php echo $value->id_download; ?>" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Ubah File Download</h4>
			</div>
			<form method="post" action="<?php echo base_url('admin/update_file_download'); ?>" enctype="multipart/form-data">
				<input type="hidden" name="id_download" value="<?php echo $value->id_download; ?>">
				<div class="modal-body">
					<div class="form-group">
						<label>Download</label><br>
						<a href="<?php echo base_url('assets/download/'.$value->download); ?>" target="_blank"><?php echo $value->download; ?></a>
					</div>
					<div class="form-group">
						<label>Ganti Download</label>
						<input type="file" name="userfile">
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
<div class="modal fade" id="hapus<?php echo $value->id_download; ?>" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Hapus Download</h4>
			</div>
			<form method="post" action="<?php echo base_url('admin/delete_download'); ?>">
				<input type="hidden" name="id_download" value="<?php echo $value->id_download; ?>">
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