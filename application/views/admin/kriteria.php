<ol class="breadcrumb">
	<li><a href="<?php echo base_url('admin'); ?>">Dashboard</a></li>
	<li><a href="<?php echo base_url('admin/unggulan'); ?>">Unggulan</a></li>
	<li class="active"><?php echo $title; ?></li>
</ol>
<div class="panel panel-default">
	<div class="panel-heading">
		<?php echo $title; ?> &nbsp;&nbsp;&nbsp;
		<a href="#" data-toggle="modal" data-target="#tambah" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah</a>
	</div>
	<div class="panel-body">
		<?php echo $this->session->flashdata('pesan'); ?>
		<table id="tbl" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th style="width: 20px">No</th>
					<th style="width: 80px">Aksi</th>
					<th>Kriteria</th>
					<th>Bobot</th>
				</tr>
			</thead>
			<tbody>
				<?php $no=1; foreach ($data as $value) { ?>
				<tr>
					<td><?php echo $no; ?></td>
					<td>
						<a href="#" data-toggle="modal" data-target="#ubah<?php echo $value->id_kriteria; ?>" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></a>
						<a href="#" data-toggle="modal" data-target="#hapus<?php echo $value->id_kriteria; ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
					</td>
					<td><?php echo $value->nama_kriteria; ?></td>
					<td><?php echo $value->bobot; ?></td>
				</tr>
				<?php $no++; } ?>
			</tbody>
		</table>
	</div>
</div>
<div class="modal fade" id="tambah" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Tambah Kriteria</h4>
			</div>
			<form method="post" action="<?php echo base_url('admin/insert_kriteria'); ?>">
			<input type="hidden" name="id_unggulan" value="<?php echo $id_unggulan; ?>">
			<div class="modal-body">
				<div class="form-group">
					<label>Nama Kriteria</label>
					<input type="text" name="nama_kriteria" class="form-control" placeholder="Nama Kriteria">
				</div>
				<div class="form-group">
					<label>Bobot</label>
					<input type="number" name="bobot" class="form-control" placeholder="Bobot">
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
<div class="modal fade" id="ubah<?php echo $value->id_kriteria; ?>" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Ubah Kriteria</h4>
			</div>
			<form method="post" action="<?php echo base_url('admin/update_kriteria'); ?>">
			<input type="hidden" name="id_kriteria" value="<?php echo $value->id_kriteria; ?>">
			<div class="modal-body">
				<div class="form-group">
					<label>Nama Kriteria</label>
					<input type="text" name="nama_kriteria" value="<?php echo $value->nama_kriteria; ?>" class="form-control" placeholder="Nama Kriteria">
				</div>
				<div class="form-group">
					<label>Bobot</label>
					<input type="number" name="bobot" value="<?php echo $value->bobot; ?>" class="form-control" placeholder="Bobot">
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
<div class="modal fade" id="hapus<?php echo $value->id_kriteria; ?>" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Hapus Kriteria</h4>
			</div>
			<form method="post" action="<?php echo base_url('admin/delete_kriteria'); ?>">
				<input type="hidden" name="id_kriteria" value="<?php echo $value->id_kriteria; ?>">
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