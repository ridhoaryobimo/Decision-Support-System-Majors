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
						<th style="width: 40px">Aksi</th>
						<th>Nama</th>
						<th>No. Hp</th>
						<th>Saran</th>
					</tr>
				</thead>
				<tbody>
					<?php $no=1; foreach ($data as $value) { ?>
						<tr>
							<td><?php echo $no; ?></td>
							<td>
								<a href="#" data-toggle="modal" data-target="#baca<?php echo $value->id_saran; ?>" class="btn btn-info btn-xs"><i class="fa fa-eye"></i></a>
								<a href="#" data-toggle="modal" data-target="#hapus<?php echo $value->id_saran; ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
							</td>
							<td><?php echo $value->nama; ?></td>
							<td><?php echo $value->no_hp; ?></td>
							<td><?php echo $value->saran; ?></td>
						</tr>
					<?php $no++; } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<?php foreach ($data as $value) { ?>
<div class="modal fade" id="baca<?php echo $value->id_saran; ?>" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Baca</h4>
			</div>
			<div class="modal-body">
				<table class="table table-bordered">
					<tr>
						<th>Nama</th>
						<td><?php echo $value->nama; ?></td>
					</tr>
					<tr>
						<th>No. Hp</th>
						<td><?php echo $value->no_hp; ?></td>
					</tr>
					<tr>
						<th>Saran</th>
						<td><?php echo $value->saran; ?></td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="hapus<?php echo $value->id_saran; ?>" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Hapus saran</h4>
			</div>
			<form method="post" action="<?php echo base_url('admin/delete_saran'); ?>">
				<input type="hidden" name="id_saran" value="<?php echo $value->id_saran; ?>">
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