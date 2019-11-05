<ol class="breadcrumb">
	<li><a href="<?php echo base_url(); ?>">Beranda</a></li>
	<li class="active"><?php echo $title; ?></li>
</ol>
<div class="panel panel-default">
	<div class="panel-heading"><?php echo $title; ?></div>
	<div class="panel-body">
		<?php echo $this->session->flashdata('pesan'); ?>
		<div class="row">
			<?php foreach ($data as $value) { ?>
			<div class="col-md-3">
				<img src="<?php echo base_url('assets/berita/'.$value->gambar); ?>" alt="..." style="width: 100%">
			</div>
			<div class="col-md-9">
				<h3><?php echo $value->judul; ?></h3>
				<p><?php echo $value->deskripsi; ?></p>
			</div>
			<?php } ?>
		</div>
	</div>
</div>