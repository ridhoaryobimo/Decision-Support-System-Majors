<?php if (count($data)==0) { ?>
<div class="col-lg-4 col-xs-4">
	<div class="small-box bg-aqua">
		<div class="inner">
			<h3>0</h3>
			<p>Nilai Rata-Rata Raport Keseluruhan</p>
		</div>
		<div class="icon">
			<i class="fa fa-file-text-o"></i>
		</div>
		<a href="<?php echo base_url('siswa/nilai-ujian-nasional'); ?>" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
	</div>
</div>
<div class="col-lg-4 col-xs-4">
	<div class="small-box bg-green">
		<div class="inner">
			<h3>0</h3>
			<p>Nilai Rata-Rata Raport UN</p>
		</div>
		<div class="icon">
			<i class="fa fa-file-text-o"></i>
		</div>
		<a href="<?php echo base_url('siswa/nilai-ujian-nasional'); ?>" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
	</div>
</div>
<div class="col-lg-4 col-xs-4">
	<div class="small-box bg-yellow">
		<div class="inner">
			<h3>0</h3>
			<p>Nilai Psikotest</p>
		</div>
		<div class="icon">
			<i class="fa fa-file-text-o"></i>
		</div>
		<a href="<?php echo base_url('siswa/nilai-ujian-nasional'); ?>" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
	</div>
</div>
<div class="col-lg-6 col-xs-6">
	<div class="small-box bg-red">
		<div class="inner">
			<h3>0</h3>
			<p>Nilai Wawancara</p>
		</div>
		<div class="icon">
			<i class="fa fa-file-text-o"></i>
		</div>
		<a href="<?php echo base_url('siswa/nilai-ujian-nasional'); ?>" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
	</div>
</div>
<div class="col-lg-6 col-xs-6">
	<div class="small-box bg-red">
		<div class="inner">
			<h3>0</h3>
			<p>Kehadiran</p>
		</div>
		<div class="icon">
			<i class="fa fa-file-text-o"></i>
		</div>
		<a href="#" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
	</div>
</div>
<?php } else { ?>
<?php foreach ($data as $value) { ?>
<div class="col-lg-4 col-xs-4">
	<div class="small-box bg-aqua">
		<div class="inner">
			<h3><?php echo $value->nilai_raport; ?></h3>
			<p>Nilai Rata-Rata Nilai Raport</p>
		</div>
		<div class="icon">
			<i class="fa fa-file-text-o"></i>
		</div>
		<a href="<?php echo base_url('siswa/nilai-ujian-nasional'); ?>" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
	</div>
</div>
<div class="col-lg-4 col-xs-4">
	<div class="small-box bg-green">
		<div class="inner">
			<h3><?php echo $value->nilai_raportun; ?></h3>
			<p>Nilai Rata-Rata Raport UN</p>
		</div>
		<div class="icon">
			<i class="fa fa-file-text-o"></i>
		</div>
		<a href="<?php echo base_url('siswa/nilai-ujian-nasional'); ?>" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
	</div>
</div>
<div class="col-lg-4 col-xs-4">
	<div class="small-box bg-yellow">
		<div class="inner">
			<h3><?php echo $value->nilai_wawancara; ?></h3>
			<p>Nilai Wawancara</p>
		</div>
		<div class="icon">
			<i class="fa fa-file-text-o"></i>
		</div>
		<a href="<?php echo base_url('siswa/nilai-ujian-nasional'); ?>" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
	</div>
</div>
<div class="col-lg-6 col-xs-6">
	<div class="small-box bg-blue">
		<div class="inner">
			<h3><?php echo $value->kehadiran; ?></h3>
			<p>Kehadiran</p>
		</div>
		<div class="icon">
			<i class="fa fa-file-text-o"></i>
		</div>
		<a href="<?php echo base_url('siswa/nilai-ujian-nasional'); ?>" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
	</div>
</div>
<div class="col-lg-6 col-xs-6">
	<div class="small-box bg-red">
		<div class="inner">
			<h3>
				<!-- <?php  
					$this->db->select('SUM(point) as total');
					$this->db->from('ujian');
					$this->db->where('id_siswa',$this->session->userdata('id_siswa'));
					echo $this->db->get()->row()->total; 
				?> -->
				<?php echo $value->nilai_psikotest; ?>
			</h3>
			<p>Nilai Psikotest</p>
		</div>
		<div class="icon">
			<i class="fa fa-file-text-o"></i>
		</div>
		<a href="#" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
	</div>
</div>
<?php } ?>
<?php } ?>