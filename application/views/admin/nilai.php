<div class="col-xs-12">
	<div class="box box-primary">
		<div class="box-body">
			<?php echo $this->session->flashdata('pesan'); ?>
			<table id="example0" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th style="width: 30px">Aksi</th>
						<th>Nama</th>
						<th>Bukti</th>
						<th>Nilai Raport</th>
						<th>Nilai Raport UN</th>
						<th>Kehadiran</th>
						<th>Nilai Wawancara</th>
						<th>Nilai Psikotest</th>
					</tr>
				</thead>
				<tbody>
					<?php $no=1; foreach ($data as $value) { ?>
					<tr>
						<td>
							<a href="#" data-toggle="modal" data-target="#ubah<?php echo $value->id_nilai; ?>" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></a>
						</td>
						<td><?php echo $value->nama_siswa; ?></td>
						<td><a href="<?php echo base_url('assets/file/'.$value->bukti); ?>" target="_blank"><?php echo $value->bukti; ?></a></td>
						<td><?php echo $value->nilai_raport; ?></td>
						<td><?php echo $value->nilai_raportun; ?></td>
						<td><?php echo $value->kehadiran; ?></td>
						<td><?php echo $value->nilai_wawancara; ?></td>
						<td><?php echo $value->nilai_psikotest; ?></td>
					</tr>
					<?php $no++; } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<?php foreach ($data as $value) { ?>
<div class="modal fade" id="ubah<?php echo $value->id_nilai; ?>" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Ubah Nilai</h4>
			</div>
			<form method="post" action="<?php echo base_url('admin/update_nilai'); ?>">
			<input type="hidden" name="id_nilai" value="<?php echo $value->id_nilai; ?>">
			<div class="modal-body">
				<div class="form-group">
					<label>Nilai Raport</label>
					<input type="text" name="nilai_raport" value="<?php echo $value->nilai_raport; ?>" class="form-control" placeholder="Nilai Raport">
				</div>
				<div class="form-group">
					<label>Nilai Raport UN</label>
					<input type="text" name="nilai_raportun" value="<?php echo $value->nilai_raportun; ?>" class="form-control" placeholder="Nilai Raport UN">
				</div>
				<div class="form-group">
					<label>Kehadiran</label>
					<input type="text" name="kehadiran" value="<?php echo $value->kehadiran; ?>" class="form-control" placeholder="Kehadiran">
				</div>
				<div class="form-group">
					<label>Nilai Wawancara</label>
					<input type="text" name="nilai_wawancara" value="<?php echo $value->nilai_wawancara; ?>" class="form-control" placeholder="Nilai Wawancara">
				</div>
				<div class="form-group">
					<label>Nilai Psikotest</label>
					<input type="text" name="nilai_psikotest" value="<?php echo $value->nilai_psikotest; ?>" class="form-control" placeholder="Nilai Psikotest">
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
<?php } ?>