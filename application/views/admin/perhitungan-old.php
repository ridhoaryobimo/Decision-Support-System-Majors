<div class="col-xs-12">
	<div class="box box-primary">
		<div class="box-body">
			<?php echo $this->session->flashdata('pesan'); ?>
			<!-- <div class="row">
				<form method="post" action="<?php echo base_url('admin/perhitungan'); ?>">
				<div class="col-md-10">
					<select name="jurusan" class="form-control" required>
						<?php if (!$this->session->userdata('jurusan')) { ?>
						<option value="">Pilih</option>
						<?php foreach ($jurusan as $row) { ?>
							<option value="<?php echo $row->id_jurusan; ?>"><?php echo $row->nama_jurusan; ?></option>
						<?php } ?>
						<?php } else { ?>
						<?php foreach ($jurusan as $row) { ?>
							<?php if ($row->id_jurusan == $this->session->userdata('jurusan')) { ?>
							<option value="<?php echo $row->id_jurusan; ?>"><?php echo $row->nama_jurusan; ?></option>
							<?php } ?>
						<?php } ?>
						<?php foreach ($jurusan as $row) { ?>
							<?php if ($row->id_jurusan != $this->session->userdata('jurusan')) { ?>
							<option value="<?php echo $row->id_jurusan; ?>"><?php echo $row->nama_jurusan; ?></option>
							<?php } ?>
						<?php } ?>
						<?php } ?>
					</select>
				</div>
				<div class="col-md-2">
					<button type="submit" class="btn btn-primary" style="width: 100%">Pilih</button>
				</div>
				</form>
			</div>
			<hr> -->
			<form method="get" action="<?php echo base_url('admin/perhitungan'); ?>">
			<?php foreach ($siswa as $value) { ?>
			<input type="hidden" name="id_siswa[]" value="<?php echo $value->id_siswa; ?>">
			<?php } ?>
			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama</th>
						<th>Jenis Kelamin</th>
						<th>Tempat Lahir</th>
						<th>Tanggal Lahir</th>
						<th>Alamat</th>
						<th>Nilai</th>
					</tr>
				</thead>
				<tbody>
					<?php $no=1; foreach ($siswa as $value) { ?>
						<tr>
							<td><?php echo $no; ?></td>
							<td><?php echo $value->nama_siswa; ?></td>
							<td>
								<?php if ($value->jenis_kelamin=='L') {
									echo 'Laki-laki';
								} else {
									echo 'Perempuan';
								} ?>
							</td>
							<td><?php echo $value->tempat_lahir; ?></td>
							<td><?php echo $value->tanggal_lahir; ?></td>
							<td><?php echo $value->alamat; ?></td>
							<td>
								<a href="<?php echo base_url('admin/nilai/'.$value->id_siswa); ?>" class="btn btn-primary btn-xs">Nilai</a>
							</td>
						</tr>
					<?php $no++; } ?>
				</tbody>
			</table>
			<?php if (count($siswa)!=0) { ?>
			<div class="text-center">
				<button type="submit" class="btn btn-primary"><i class="fa fa-balance-scale"></i> Hitung</button>
			</div>
			<?php } ?>
			</form>
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">
			Hasil
		</div>
		<div class="panel-body">
			<?php if ($this->input->get('id_siswa')) { ?>
			<hr>
			<div class="panel-info">
				<div class="row">
				<?php foreach ($get_jurusan as $value) { ?>
				<div class="col-md-12">
				<div class="panel-heading">Normalisasi Bobot <i class="fa fa-chevron-right"></i> <?php echo $value->nama_jurusan; ?></div>
				<div class="panel-body">
					<?php  
						$this->db->order_by('id_kriteria','asc');
						$kriteria = $this->db->get_where('kriteria', array('id_jurusan' => $value->id_jurusan));
					?>
					<table class="table table-bordered table-striped">
						<tr>
							<th>No</th>
							<th>Kriteria</th>
							<th>Bobot Awal</th>
							<th>Bobot Baru</th>
						</tr>
						<?php $n=1; foreach ($kriteria->result() as $key) { ?>
						<tr>
							<td><?php echo $n; ?></td>
							<td><?php echo $key->nama_kriteria; ?></td>
							<td><?php echo $key->bobot; ?></td>
							<td>
								<?php  
								$this->db->select('SUM(bobot) as total');
								$this->db->from('kriteria');
								$this->db->where('id_jurusan', $value->id_jurusan);
								?>
								<?php echo $key->bobot /  $this->db->get()->row()->total; ?>
							</td>
						</tr>
						<?php $n++; } ?>
					</table>
				</div>
				</div>
				<?php } ?>
				</div>
			</div>
			<hr>
			<div class="panel-info">
				<div class="panel-heading">Detail</div>
				<div class="panel-body">
					<table class="table table-bordered table-striped">
						<tr>
							<th>No</th>
							<th>Siswa</th>
							<th>Bahasa Indonesia</th>
							<th>Matematika</th>
							<th>IPA</th>
							<th>Bahasa Inggris</th>
							<th>Ujian Peminatan</th>
							<th>Vektor S</th>
						</tr>
						<?php $i=1; foreach ($hasil_seleksi as $key) { ?>
						<tr>
							<td><?php echo $i; ?></td>
							<td><?php echo $key->nama_siswa; ?></td>
							<td><?php echo $key->nilai_bahasa_indonesia; ?></td>
							<td><?php echo $key->nilai_matematika; ?></td>
							<td><?php echo $key->nilai_ipa; ?></td>
							<td><?php echo $key->nilai_bahasa_inggris; ?></td>
							<td><?php echo $key->nilai_peminatan; ?></td>
							<td><?php echo $key->vektor_s; ?></td>
						</tr>
						<?php $i++; } ?>
					</table>
				</div>
			</div>
			<hr>
			<div class="panel-info">
				<div class="panel-heading">Hasil Seleksi</div>
				<div class="panel-body">
					<table class="table table-bordered table-striped">
						<tr>
							<th>Rangking</th>
							<th>Siswa</th>
							<th>Vektor S</th>
							<th>Vektor V</th>
							<th>Jurusan</th>
						</tr>
						<?php $i=1; foreach ($hasil_seleksi as $key) { ?>
						<tr>
							<td><?php echo $i; ?></td>
							<td><?php echo $key->nama_siswa; ?></td>
							<td><?php echo $key->vektor_s; ?></td>
							<td><?php echo $key->vektor_v; ?></td>
							<td><?php echo $key->nama_jurusan; ?></td>
						</tr>
						<?php $i++; } ?>
					</table>
					<?php  
						$query = $this->db->get_where('hasil_seleksi', array(
							'umumkan' => 1, 
						));
					?>
					<div class="text-center">
					<?php if ($query->num_rows()==0) { ?>
					<a href="#" data-toggle="modal" data-target="#umumkan" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Umumkan</a>
					<?php } else { ?>
					<a href="#" data-toggle="modal" data-target="#batal" class="btn btn-danger"><i class="fa fa-refresh"></i> Batal</a>
					<?php } ?>
					<a href="<?php echo base_url('admin/cetak'); ?>" class="btn btn-success"><i class="fa fa-print"></i> Cetak</a>
					<br>
					<small><i>* Klik umumkan untuk mengumumkan jurusan</i></small>
					</div>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>
</div>
<div class="modal fade" id="umumkan" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Umumkan</h4>
			</div>
			<form method="post" action="<?php echo base_url('admin/umumkan'); ?>">
				<div class="modal-body">
					<p>Apakah Anda Yakin Ingin Mengumumkan ?</p>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Ya</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="modal fade" id="batal" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Umumkan</h4>
			</div>
			<form method="post" action="<?php echo base_url('admin/batal'); ?>">
				<div class="modal-body">
					<p>Apakah Anda Yakin Ingin Membatalkan ?</p>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Ya</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
				</div>
			</form>
		</div>
	</div>
</div>