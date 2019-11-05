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
						<th style="width: 100px">Aksi</th>
						<th>Soal</th>
					</tr>
				</thead>
				<tbody>
					<?php $no=1; foreach ($data as $value) { ?>
					<tr>
						<td><?php echo $no; ?></td>
						<td>
							<a href="#" data-toggle="modal" data-target="#detail<?php echo $value->id_soal; ?>" class="btn btn-info btn-xs"><i class="fa fa-eye"></i></a>
							<a href="#" data-toggle="modal" data-target="#ubah<?php echo $value->id_soal; ?>" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></a>
							<a href="#" data-toggle="modal" data-target="#hapus<?php echo $value->id_soal; ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
						</td>
						<td><?php echo $value->soal; ?></td>
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
				<h4 class="modal-title">Tambah Soal</h4>
			</div>
			<form method="post" action="<?php echo base_url('admin/insert_soal'); ?>">
			<div class="modal-body">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>Soal</label>
							<textarea name="soal" class="form-control" placeholder="Soal"></textarea>
						</div>
						<div class="form-group">
							<label>Pilihan A</label>
							<input type="text" name="pilihan_a" class="form-control" placeholder="Pilihan A">
						</div>
						<div class="form-group">
							<label>Pilihan B</label>
							<input type="text" name="pilihan_b" class="form-control" placeholder="Pilihan B">
						</div>
						<div class="form-group">
							<label>Pilihan C</label>
							<input type="text" name="pilihan_c" class="form-control" placeholder="Pilihan C">
						</div>
						<div class="form-group">
							<label>Pilihan D</label>
							<input type="text" name="pilihan_d" class="form-control" placeholder="Pilihan D">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Nilai Pilihan A</label>
							<input type="number" name="nilai_a" class="form-control" placeholder="Nilai Pilihan A">
						</div>
						<div class="form-group">
							<label>Nilai Pilihan B</label>
							<input type="number" name="nilai_b" class="form-control" placeholder="Nilai Pilihan B">
						</div>
						<div class="form-group">
							<label>Nilai Pilihan C</label>
							<input type="number" name="nilai_c" class="form-control" placeholder="Nilai Pilihan C">
						</div>
						<div class="form-group">
							<label>Nilai Pilihan D</label>
							<input type="number" name="nilai_d" class="form-control" placeholder="Nilai Pilihan D">
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
<div class="modal fade" id="detail<?php echo $value->id_soal; ?>" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Detail Soal</h4>
			</div>
			<div class="modal-body">
				<p><b><?php echo $value->soal; ?></b></p>
				<div class="row">
					<div class="col-md-6">
						<p>A. <?php echo $value->pilihan_a; ?> | Point <?php echo $value->nilai_a; ?></p>
						<p>B. <?php echo $value->pilihan_b; ?> | Point <?php echo $value->nilai_b; ?></p>
					</div>
					<div class="col-md-6">
						<p>C. <?php echo $value->pilihan_c; ?> | Point <?php echo $value->nilai_c; ?></p>
						<p>D. <?php echo $value->pilihan_d; ?> | Point <?php echo $value->nilai_d; ?></p>
					</div>
				</div>
			</div>
			<div class="modal-footer"></div>
		</div>
	</div>
</div>
<div class="modal fade" id="ubah<?php echo $value->id_soal; ?>" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Ubah Soal</h4>
			</div>
			<form method="post" action="<?php echo base_url('admin/update_soal'); ?>">
			<input type="hidden" name="id_soal" value="<?php echo $value->id_soal; ?>">
			<div class="modal-body">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>Soal</label>
							<textarea name="soal" class="form-control" placeholder="Soal"><?php echo $value->soal; ?></textarea>
						</div>
						<div class="form-group">
							<label>Pilihan A</label>
							<input type="text" name="pilihan_a" value="<?php echo $value->pilihan_a; ?>" class="form-control" placeholder="Pilihan A">
						</div>
						<div class="form-group">
							<label>Pilihan B</label>
							<input type="text" name="pilihan_b" value="<?php echo $value->pilihan_b; ?>" class="form-control" placeholder="Pilihan B">
						</div>
						<div class="form-group">
							<label>Pilihan C</label>
							<input type="text" name="pilihan_c" value="<?php echo $value->pilihan_c; ?>" class="form-control" placeholder="Pilihan C">
						</div>
						<div class="form-group">
							<label>Pilihan D</label>
							<input type="text" name="pilihan_d" value="<?php echo $value->pilihan_d; ?>" class="form-control" placeholder="Pilihan D">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Nilai Pilihan A</label>
							<input type="number" name="nilai_a" value="<?php echo $value->nilai_a; ?>" class="form-control" placeholder="Nilai Pilihan A">
						</div>
						<div class="form-group">
							<label>Nilai Pilihan B</label>
							<input type="number" name="nilai_b" value="<?php echo $value->nilai_b; ?>" class="form-control" placeholder="Nilai Pilihan B">
						</div>
						<div class="form-group">
							<label>Nilai Pilihan C</label>
							<input type="number" name="nilai_c" value="<?php echo $value->nilai_c; ?>" class="form-control" placeholder="Nilai Pilihan C">
						</div>
						<div class="form-group">
							<label>Nilai Pilihan D</label>
							<input type="number" name="nilai_d" value="<?php echo $value->nilai_d; ?>" class="form-control" placeholder="Nilai Pilihan D">
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
<div class="modal fade" id="hapus<?php echo $value->id_soal; ?>" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Hapus Soal</h4>
			</div>
			<form method="post" action="<?php echo base_url('admin/delete_soal'); ?>">
				<input type="hidden" name="id_soal" value="<?php echo $value->id_soal; ?>">
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
<?php  } ?>
