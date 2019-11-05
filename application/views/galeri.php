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
			<div class="col-sm-6 col-md-2">
				<div class="thumbnail">
					<img src="<?php echo base_url('assets/galeri/'.$value->gambar); ?>" alt="" style="width: 100%; height: 200px" >
					<!-- <div class="caption">
						<h3><?php echo $value->judul; ?></h3>
						<p><?php echo character_limiter($value->deskripsi, 120); ?></p>
						<p><a href="<?php echo base_url('galeri/detail/'.$value->id_galeri); ?>" class="btn btn-primary" role="button">Selengkapnya</a></p>
					</div> -->
				</div>
			</div>
			<?php } ?>
		</div>
	</div>
</div>