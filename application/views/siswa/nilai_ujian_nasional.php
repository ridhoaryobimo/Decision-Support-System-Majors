<div class="col-xs-12">
	<div class="box box-primary">
		<div class="box-body">
			<?php echo $this->session->flashdata('pesan'); ?>
			<?php if (count($data)==0) { ?>
				<form method="post" action="<?php echo base_url('siswa/insert_nilai'); ?>" enctype="multipart/form-data">
					<div class="form-group">
						<label>Nilai Rata-Rata Raport Keseluruhan</label>
						<input type="decimal" name="nilai_raport" class="form-control" placeholder="Nilai Rata-Rata Raport Keseluruhan">
					</div>
					<div class="form-group">
						<label>Nilai Rata-Rata Raport UN </label>
						<input type="decimal" name="nilai_raportun" class="form-control" placeholder="Nilai Rata-Rata Raport UN (Bahasa Indonesia,Bahasa Inggris, IPA, Matematika)">
					</div>
					<div class="form-group">
						<label>Nilai Wawancara</label>
						<input type="decimal" name="nilai_wawancara" class="form-control" placeholder="NIlai Wawancara">
					</div>
					<div class="form-group">
						<label>Kehadiran</label>
						<input type="decimal" name="kehadiran" class="form-control" placeholder="Kehadiran">
					</div>
					<div class="form-group">
						<label>Lampirkan Bukti</label>
						<input type="file" name="userfile">
					</div>
					<button type="submit" class="btn btn-primary">Simpan</button>
					<a href="<?php echo base_url('siswa'); ?>" class="btn btn-danger">Batal</a>
				</form>
			<?php } else { ?>
				<?php foreach ($data as $value) { ?>
					<div class="form-group">
						<label>Nilai Raport Keseluruhan</label>
						<input type="decimal" name="nilai_raport" value="<?php echo $value->nilai_raport; ?>" class="form-control" placeholder="Nilai Raport Keseluruhan" readonly>
					</div>
					<div class="form-group">
						<label>Nilai Raport UN </label>
						<input type="decimal" name="nilai_raportun" value="<?php echo $value->nilai_raportun; ?>" class="form-control" placeholder="Nilai Raport UN" readonly>
					</div>
					<div class="form-group">
						<label>Nilai Wawancara</label>
						<input type="decimal" name="nilai_wawancara" value="<?php echo $value->nilai_wawancara; ?>" class="form-control" placeholder="NIlai Wawancara" readonly>
					</div>
					<div class="form-group">
						<label>Kehadiran</label>
						<input type="decimal" name="kehadiran" value="<?php echo $value->kehadiran; ?>" class="form-control" placeholder="Kehadiran" readonly>
					</div>
					<div class="form-group">
						<label>Lampirkan Bukti</label><br>
						<a href="<?php echo base_url('assets/file/'.$value->bukti); ?>" target="_blank"><?php echo $value->bukti; ?></a>
					</div>
				<?php } ?>
			<?php } ?>
		</div>
	</div>
</div>