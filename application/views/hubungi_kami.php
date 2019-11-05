<ol class="breadcrumb">
	<li><a href="<?php echo base_url(); ?>">Beranda</a></li>
	<li class="active"><?php echo $title; ?></li>
</ol>
<div class="panel panel-default">
	<div class="panel-heading"><?php echo $title; ?></div>
	<div class="panel-body">
		<div class="row">
			<form method="post" action="<?php echo base_url('welcome/insert_saran'); ?>">
			<div class="col-md-8">
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1994.386228872517!2d102.10666455921557!3d-1.311921573000203!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x95fa589dc03906a9!2sSMAN+02+Tebo!5e0!3m2!1sen!2sid!4v1551232848931" width="100%" height="520" frameborder="0" style="border:0" allowfullscreen>
				</iframe>
			</div>
			<div class="col-md-4">
				<?php foreach ($data as $value) { ?>
					<?php echo $value->keterangan; ?>
				<?php } ?>
				<hr>
				<?php echo $this->session->flashdata('pesan'); ?>
				<div class="form-group">
					<label>Nama</label>
					<input type="text" name="nama" class="form-control" placeholder="Nama">
				</div>
				<div class="form-group">
					<label>No. Hp</label>
					<input type="text" name="no_hp" class="form-control" placeholder="No.Hp">
				</div>
				<div class="form-group">
					<label>Saran</label>
					<textarea name="saran" class="form-control" placeholder="Saran Anda"></textarea>
				</div>
				<button type="submit" class="btn btn-primary">Simpan</button>
				<a href="<?php echo base_url(); ?>" class="btn btn-danger">Reset</a>
			</div>
		</form>
		</div>
	</div>
</div>