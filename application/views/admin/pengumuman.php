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
						<th>Judul</th>
						<th>File</th>
						<th>Tanggal</th>
					</tr>
				</thead>
				<tbody>
					<?php $no=1; foreach ($data as $value) { ?>
					<tr>
						<td><?php echo $no; ?></td>
						<td>
							<a href="#" data-toggle="modal" data-target="#ubah<?php echo $value->id_pengumuman; ?>" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></a>
							<a href="#" data-toggle="modal" data-target="#hapus<?php echo $value->id_pengumuman; ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
						</td>
						<td><?php echo $value->judul_pengumuman; ?></td>
						<td>
							<a href="#" data-toggle="modal" data-target="#gambar<?php echo $value->id_pengumuman; ?>"><?php echo $value->file; ?></a>
						</td>
						<td><?php echo $value->tanggal; ?></td>
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
				<h4 class="modal-title">Tambah Pengumuman</h4>
			</div>
			<form method="post" action="<?php echo base_url('admin/insert_pengumuman'); ?>" enctype="multipart/form-data">
			<div class="modal-body">
				<div class="form-group">
					<label>Judul</label>
					<input type="text" name="judul_pengumuman" class="form-control" placeholder="Judul">
				</div>
				<div class="form-group">
					<label>File</label>
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
<?php foreach ($data as $value) { ?>
<div class="modal fade" id="ubah<?php echo $value->id_pengumuman; ?>" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Ubah Pengumuman</h4>
			</div>
			<form method="post" action="<?php echo base_url('admin/update_pengumuman'); ?>" enctype="multipart/form-data">
			<input type="hidden" name="id_pengumuman" value="<?php echo $value->id_pengumuman; ?>">
			<div class="modal-body">
				<div class="form-group">
					<label>Judul</label>
					<input type="text" name="judul_pengumuman" value="<?php echo $value->judul_pengumuman; ?>" class="form-control" placeholder="Judul">
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
<div class="modal fade" id="gambar<?php echo $value->id_pengumuman; ?>" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Ubah File Pengumuman</h4>
			</div>
			<form method="post" action="<?php echo base_url('admin/update_file_pengumuman'); ?>" enctype="multipart/form-data">
				<input type="hidden" name="id_pengumuman" value="<?php echo $value->id_pengumuman; ?>">
				<div class="modal-body">
					<div class="form-group">
						<label>File</label><br>
						<a href="<?php echo base_url('assets/pengumuman/'.$value->file); ?>" target="_blank"><?php echo $value->file; ?></a>
					</div>
					<div class="form-group">
						<label>Ganti File</label>
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
<div class="modal fade" id="hapus<?php echo $value->id_pengumuman; ?>" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Hapus pengumuman</h4>
			</div>
			<form method="post" action="<?php echo base_url('admin/delete_pengumuman'); ?>">
				<input type="hidden" name="id_pengumuman" value="<?php echo $value->id_pengumuman; ?>">
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
