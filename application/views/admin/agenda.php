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
						<th>Tanggal</th>
						<th>Agenda</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>
					<?php $no=1; foreach ($data as $value) { ?>
					<tr>
						<td><?php echo $no; ?></td>
						<td>
							<a href="#" data-toggle="modal" data-target="#ubah<?php echo $value->id_agenda; ?>" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></a>
							<a href="#" data-toggle="modal" data-target="#hapus<?php echo $value->id_agenda; ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
						</td>
						<td><?php echo $value->tanggal; ?></td>
						<td><?php echo $value->agenda; ?></td>
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
				<h4 class="modal-title">Tambah Agenda</h4>
			</div>
			<form method="post" action="<?php echo base_url('admin/insert_agenda'); ?>">
			<div class="modal-body">
				<div class="form-group">
					<label>Tanggal</label>
					<input id="datepicker" type="text" name="tanggal" class="form-control" placeholder="Tanggal">
				</div>
				<div class="form-group">
					<label>Agenda</label>
					<input type="text" name="agenda" class="form-control" placeholder="Agenda">
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
<div class="modal fade" id="ubah<?php echo $value->id_agenda; ?>" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Ubah Agenda</h4>
			</div>
			<form method="post" action="<?php echo base_url('admin/update_agenda'); ?>">
			<input type="hidden" name="id_agenda" value="<?php echo $value->id_agenda; ?>">
			<div class="modal-body">
				<div class="form-group">
					<label>Tanggal</label>
					<input id="datepicker2" type="text" name="tanggal" value="<?php echo $value->tanggal; ?>" class="form-control" placeholder="Tanggal">
				</div>
				<div class="form-group">
					<label>Agenda</label>
					<input type="text" name="agenda" value="<?php echo $value->agenda; ?>" class="form-control" placeholder="Agenda">
				</div>
				<div class="form-group">
					<label>Status</label>
					<select name="status"  class="form-control">
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
<div class="modal fade" id="hapus<?php echo $value->id_agenda; ?>" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Hapus Agenda</h4>
			</div>
			<form method="post" action="<?php echo base_url('admin/delete_agenda'); ?>">
				<input type="hidden" name="id_agenda" value="<?php echo $value->id_agenda; ?>">
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