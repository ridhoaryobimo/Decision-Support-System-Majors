<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
	<ol class="carousel-indicators">
		<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
		<li data-target="#carousel-example-generic" data-slide-to="1"></li>
		<li data-target="#carousel-example-generic" data-slide-to="2"></li>
	</ol>
	<div class="carousel-inner" role="listbox">
		<?php $no=1; foreach ($slide as $value) { ?>
		<?php if ($no==1) { ?>
		<div class="item active">
			<img src="<?php echo base_url('assets/slide/'.$value->gambar); ?>" alt="Slide" style="width: 100%; height: 50%">
			<div class="carousel-caption">
			</div>
		</div>
		<?php } ?>
		<?php if ($no > 1) { ?>
		<div class="item">
			<img src="<?php echo base_url('assets/slide/'.$value->gambar); ?>" alt="Slide" style="width: 100%; height: 50%">
		</div>
		<?php } ?>
		<?php $no++; } ?>
	</div>
	<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
		<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
		<span class="sr-only">Previous</span>
	</a>
	<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
		<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
		<span class="sr-only">Next</span>
	</a>
</div>
<br>
<div class="row">
	<div class="col-md-3">
		<ul class="nav nav-tabs" role="tablist">
			<li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Informasi</a></li>
		</ul>
		<br>
		<div class="list-group">
			<?php foreach ($pengumuman as $value) { ?>
			<a href="<?php echo base_url('assets/pengumuman/'.$value->file); ?>" class="list-group-item active">
				<h4 class="list-group-item-heading" style="text-transform: capitalize;"><i class="fa fa-bullhorn fa-2x"></i> <?php echo $value->judul_pengumuman; ?></h4>
				<p class="list-group-item-text"><i class="fa fa-clock-o"></i> <?php echo $value->tanggal; ?></p>
				<p><small><i>* Klik Download Pengumuman</i></small></p>
			</a>
			<?php } ?>
		</div>
	</div>
	<div class="col-md-9">
		<ul class="nav nav-tabs" role="tablist">
			<li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Berita</a></li>
		</ul>
		<br>
		<div class="row">
			<?php foreach ($berita as $value) { ?>
			<div class="col-sm-6 col-md-3">
				<div class="thumbnail">
					<img src="<?php echo base_url('assets/berita/'.$value->gambar); ?>" alt="...">
					<div class="caption">
						<h3><?php echo $value->judul; ?></h3>
						<p><?php echo character_limiter($value->deskripsi, 120); ?></p>
						<p><a href="<?php echo base_url('berita/detail/'.$value->id_berita); ?>" class="btn btn-primary" role="button">Selengkapnya</a></p>
					</div>
				</div>
			</div>
			<?php } ?>
		</div>
		<!-- <div class="embed-responsive embed-responsive-4by3">
	  		<iframe class="embed-responsive-item" src="<?php echo base_url('assets/img/stand.mp4'); ?>"></iframe>
		</div> -->
	</div>
</div>