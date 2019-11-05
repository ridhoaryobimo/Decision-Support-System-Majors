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
						<th>Nama Unggulan</th>
						<th>Kuota Unggulan</th>
						<th>Status</th>
						<th style="width: 60px">Kriteria</th>
					</tr>
				</thead>
				<tbody>
					<?php $no=1; foreach ($data as $value) { ?>
					<tr>
						<td><?php echo $no; ?></td>
						<td>
							<a href="#" data-toggle="modal" data-target="#ubah<?php echo $value->id_unggulan; ?>" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></a>
							<a href="#" data-toggle="modal" data-target="#hapus<?php echo $value->id_unggulan; ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
						</td>
						<td><?php echo $value->nama_unggulan; ?></td>
						<td><?php echo $value->kuota_unggulan; ?></td>
						<td>
							<?php if ($value->status_unggulan==1) {
								echo 'Aktif';
							} else {
								echo 'Tidak Aktif';
							} ?>
						</td>
						<td>
							<a href="<?php echo base_url('admin/kriteria/'.$value->id_unggulan); ?>" class="btn btn-primary btn-xs">Kriteria</a>
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
				<h4 class="modal-title">Tambah Unggulan</h4>
			</div>
			<form method="post" action="<?php echo base_url('admin/insert_unggulan'); ?>">
			<div class="modal-body">
				<div class="form-group">
					<label>Nama unggulan</label>
					<input type="text" name="nama_unggulan" class="form-control" placeholder="Nama Unggulan">
				</div>
				<div class="form-group">
					<label>Kuota</label>
					<input type="number" name="kuota_unggulan" class="form-control" placeholder="Kuota Unggulan">
				</div>
				<div class="form-group">
					<label>Status</label>
					<select name="status_unggulan" class="form-control">
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
<div class="modal fade" id="ubah<?php echo $value->id_unggulan; ?>" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Ubah Unggulan</h4>
			</div>
			<form method="post" action="<?php echo base_url('admin/update_unggulan'); ?>">
			<input type="hidden" name="id_unggulan" value="<?php echo $value->id_unggulan; ?>">
			<div class="modal-body">
				<div class="form-group">
					<label>Nama Unggulan</label>
					<input type="text" name="nama_unggulan" value="<?php echo $value->nama_unggulan; ?>" class="form-control" placeholder="Nama Unggulan">
				</div>
				<div class="form-group">
					<label>Kuota</label>
					<input type="number" name="kuota_unggulan" value="<?php echo $value->kuota_unggulan; ?>" class="form-control" placeholder="Kuota Unggulan">
				</div>
				<div class="form-group">
					<label>Status</label>
					<select name="status_unggulan"  class="form-control">
						<?php if ($value->status_unggulan==1) {
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
<div class="modal fade" id="hapus<?php echo $value->id_unggulan; ?>" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Hapus Unggulan</h4>
			</div>
			<form method="post" action="<?php echo base_url('admin/delete_unggulan'); ?>">
				<input type="hidden" name="id_unggulan" value="<?php echo $value->id_unggulan; ?>">
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