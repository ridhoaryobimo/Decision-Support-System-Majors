<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $title; ?> - Sistem Penentuan Jurusan</title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	<meta content="" name="keywords">
	<meta content="" name="description">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,400i,600,700|Raleway:300,400,400i,500,500i,700,800,900" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/frontend/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/frontend/lib/nivo-slider/css/nivo-slider.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/frontend/lib/owlcarousel/owl.carousel.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/frontend/lib/owlcarousel/owl.transitions.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/frontend/lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/frontend/lib/animate/animate.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/frontend/lib/venobox/venobox.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/frontend/css/nivo-slider-theme.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/frontend/css/style.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/frontend/css/responsive.css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.css">
</head>
<body data-spy="scroll" data-target="#navbar-example">
	<div id="preloader"></div>
	<header>
		<div id="sticker" class="header-area">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<nav class="navbar navbar-default">
							<div class="navbar-header">
								<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".bs-example-navbar-collapse-1" aria-expanded="false">
									<span class="sr-only">Toggle navigation</span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
								<a class="navbar-brand page-scroll sticky-logo" href="<?php echo base_url(); ?>">
									<h1><span><img src="<?php echo base_url('assets/img/kemenag.png'); ?>" style="width: 50px"> </span>MTsN 1 KULON PROGO</h1>
								</a>
							</div>
							<div class="collapse navbar-collapse main-menu bs-example-navbar-collapse-1" id="navbar-example">
								<ul class="nav navbar-nav navbar-right">
									<li class="active">
										<a class="page-scroll" href="#home">Home</a>
									</li>
									<li>
										<a class="page-scroll" href="#blog">Berita</a>
									</li>
									<li>
										<a class="page-scroll" href="#visi_misi">Visi dan Misi</a>
									</li>
									<li>
										<a class="page-scroll" href="#profil">Profil</a>
									</li>
									<li>
										<a class="page-scroll" href="#agenda">Agenda</a>
									</li>
									<li>
										<a class="page-scroll" href="#portfolio">Galeri</a>
									</li>

									<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Download <span class="caret"></span></a>
										<ul class="dropdown-menu" role="menu">
											<?php 
												$this->db->order_by('id_download','desc'); 
												$download = $this->db->get_where('download', array('status' => 1));
											?>
											<?php foreach ($download->result() as $key) { ?>
											<li><a href="<?php echo base_url('assets/download/'.$key->download); ?>" target="_blank"><?php echo $key->nama; ?></a></li>
											<?php } ?>
										</ul> 
									</li>
									<li>
										<a class="page-scroll" href="#tentang_kami">Tentang Kami</a>
									</li>
									<li>
										<a class="page-scroll" href="#contact">Hubungi Kami</a>
									</li>
									<li>
										<a href="#" data-toggle="modal" data-target="#daftar">Daftar</a>
									</li>
									<li>
										<a href="#" data-toggle="modal" data-target="#login">Login</a>
									</li>
								</ul>
							</div>
						</nav>
					</div>
				</div>
			</div>
		</div>
	</header>
	<div id="home" class="slider-area">
		<div class="bend niceties preview-2">
			<div id="ensign-nivoslider" class="slides">
				<?php $no=1; foreach ($slide as $value) { ?>
				<img src="<?php echo base_url('assets/slide/'.$value->gambar); ?>" alt="" title="#slider-direction-1" />
				<img src="<?php echo base_url('assets/slide/'.$value->gambar); ?>" alt="" title="#slider-direction-2" />
				<img src="<?php echo base_url('assets/slide/'.$value->gambar); ?>" alt="" title="#slider-direction-3" />
				<?php $no++; } ?>
			</div>
			<?php $no=1; foreach ($slide as $value) { ?>
			<div id="slider-direction-1" class="slider-direction slider-one">
				<div class="container">
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="slider-content">
								<div class="layer-1-1 hidden-xs wow slideInDown" data-wow-duration="2s" data-wow-delay=".2s">
									<h2 class="title1">
										SMA N 2 TEBO
									</h2>
								</div>
								<div class="layer-1-2 wow slideInUp" data-wow-duration="2s" data-wow-delay=".1s">
									<h1 class="title2">
										Sistem Penentuan Jurusan
									</h1>
								</div>
								<div class="layer-1-3 hidden-xs wow slideInUp" data-wow-duration="2s" data-wow-delay=".2s">
									<!-- <a class="ready-btn right-btn page-scroll" href="#services">See Services</a> -->
									<a class="ready-btn page-scroll" href="#tentang_kami">Tentang Kami</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>
	<!-- End Slider Area -->

	<!-- Start About area -->
	<div id="tentang_kami" class="about-area area-padding">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="section-headline text-center">
						<h2>Tentang Kami</h2>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="well-left">
						<div class="single-well">
							<a href="#">
								<img src="<?php echo base_url(); ?>assets/frontend/img/about/Tentang.jpg" alt="" style="width: 100%">
							</a>
						</div>
					</div>
				</div>
				<?php foreach ($tentang_kami as $value) { ?>
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="well-middle">
						<div class="single-well">
							<hr>
							<?php echo $value->keterangan; ?>
							<!-- <ul>
								<li>
									<i class="fa fa-check"></i> Interior design Package
								</li>
								<li>
									<i class="fa fa-check"></i> Building House
								</li>
								<li>
									<i class="fa fa-check"></i> Reparing of Residentail Roof
								</li>
								<li>
									<i class="fa fa-check"></i> Renovaion of Commercial Office
								</li>
								<li>
									<i class="fa fa-check"></i> Make Quality Products
								</li>
							</ul> -->
						</div>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
	<div id="visi_misi" class="faq-area area-padding">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="section-headline text-center">
						<h2>Visi dan Misi</h2>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="faq-details">
						<div class="panel-group" id="accordion">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="check-title">
										<a data-toggle="collapse" class="active" data-parent="#accordion" href="#check1">
											<span class="acc-icons"></span>Visi dan Misi SMA N 2 TEBO
										</a>
									</h4>
								</div>
								<?php foreach ($visi_misi as $value) { ?>
								<div id="check1" class="panel-collapse collapse in">
									<div class="panel-body">
										<?php echo $value->keterangan; ?>
									</div>
								</div>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="profil" class="faq-area area-padding">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="section-headline text-center">
						<h2>Profil</h2>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="faq-details">
						<div class="panel-group" id="accordion">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="check-title">
										<a data-toggle="collapse" class="active" data-parent="#accordion" href="#check2">
											<span class="acc-icons"></span>Profil SMA N 2 TEBO
										</a>
									</h4>
								</div>
								<?php foreach ($profil as $value) { ?>
								<div id="check2" class="panel-collapse collapse in">
									<div class="panel-body">
										<?php echo $value->keterangan; ?>
									</div>
								</div>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="portfolio" class="portfolio-area area-padding fix">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="section-headline text-center">
						<h2>Galeri</h2>
					</div>
				</div>
			</div>
			<div class="row">
				<!-- Start Portfolio -page -->
				<!-- <div class="awesome-project-1 fix">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="awesome-menu ">
							<ul class="project-menu">
								<li>
									<a href="#" class="active" data-filter="*">All</a>
								</li>
								<?php foreach ($galeri as $value) { ?>
								<li>
									<a href="#" data-filter=".<?php echo $value->tanggal; ?>"><?php echo $value->judul; ?></a>
								</li>
								<?php } ?>
							</ul>
						</div>
					</div>
				</div> -->
				<div class="awesome-project-content">
					<?php foreach ($galeri as $value) { ?>
					<div class="col-md-4 col-sm-4 col-xs-12 design <?php echo $value->tanggal; ?>">
						<div class="single-awesome-project">
							<div class="awesome-img">
								<a href="#"><img src="<?php echo base_url('assets/galeri/'.$value->gambar); ?>" alt=""></a>
								<div class="add-actions text-center">
									<div class="project-dec">
										<a class="venobox" data-gall="myGallery" href="<?php echo base_url('assets/galeri/'.$value->gambar); ?>">
											<h4><?php echo $value->judul; ?></h4>
											<span><?php echo $value->tanggal; ?></span>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
	<div id="agenda" class="testimonials-area">
		<div class="testi-inner area-padding">
			<div class="testi-overly"></div>
			<div class="container ">
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<!-- Start testimonials Start -->
						<div class="testimonial-content text-center">
							<a class="quate" href="#"><i class="fa fa-calendar"></i></a>
							<!-- start testimonial carousel -->
							<div class="testimonial-carousel">
								<?php $no=1; foreach ($agenda as $value) { ?>
								<?php if ($no==1) { ?>
								<div class="single-testi">
									<div class="testi-text">
										<p>
											<?php echo $value->agenda; ?>
										</p>
										<h6><?php echo $value->tanggal; ?></h6>
									</div>
								</div>
								<?php } else { ?>
								<div class="single-testi">
									<div class="testi-text">
										<p>
											<?php echo $value->agenda; ?>
										</p>
										<h6><?php echo $value->tanggal; ?></h6>
									</div>
								</div>
								<?php } ?>
								<?php $no++; } ?>
							</div>
						</div>
						<!-- End testimonials end -->
					</div>
					<!-- End Right Feature -->
				</div>
			</div>
		</div>
	</div>
	<div id="blog" class="blog-area">
		<div class="blog-inner area-padding">
			<div class="blog-overly"></div>
			<div class="container ">
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="section-headline text-center">
							<h2>Berita</h2>
						</div>
					</div>
				</div>
				<div class="row">
					<?php foreach ($berita as $value) { ?>
					<div class="col-md-4 col-sm-4 col-xs-12" style="padding-bottom: 10px">
						<div class="single-blog">
							<div class="single-blog-img">
								<a href="#" data-toggle="modal" data-target="#berita<?php echo $value->id_berita; ?>">
									<img src="<?php echo base_url('assets/berita/'.$value->gambar); ?>" alt="">
								</a>
							</div>
							<div class="blog-meta">
								<span class="comments-type">
									<i class="fa fa-user"></i>
									<a href="#"><?php echo $value->ditulis; ?></a>
								</span>
								<span class="date-type">
									<i class="fa fa-calendar"></i><?php echo $value->tanggal; ?>
								</span>
							</div>
							<div class="blog-text">
								<h4>
									<a href="#" data-toggle="modal" data-target="#berita<?php echo $value->id_berita; ?>"><?php echo $value->judul; ?></a>
								</h4>
								<p>
									<?php echo character_limiter($value->deskripsi, 150); ?>
								</p>
							</div>
							<span>
								<a href="#" data-toggle="modal" data-target="#berita<?php echo $value->id_berita; ?>" class="ready-btn">Read more</a>
							</span>
						</div>
					</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
	<div id="contact" class="contact-area">
		<div class="contact-inner area-padding">
			<div class="contact-overly"></div>
			<div class="container ">
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="section-headline text-center">
							<h2>Hubungi Kami</h2>
						</div>
					</div>
				</div>
				<div class="row">
					<!-- Start contact icon column -->
					<div class="col-md-4 col-sm-4 col-xs-12">
						<div class="contact-icon text-center">
							<div class="single-icon">
								<i class="fa fa-mobile"></i>
								<p>
									Telp: (0274) 773723<br>
									<span>Senin-Kamis (08.00-15.00)</span>
									<br>
									<span>Jumat (08.00-11.00)</span>
								</p>
							</div>
						</div>
					</div>
					<!-- Start contact icon column -->
					<div class="col-md-4 col-sm-4 col-xs-12">
						<div class="contact-icon text-center">
							<div class="single-icon">
								<i class="fa fa-envelope-o"></i>
								<p>
									Email: mtsn1kulonprogo@gmail.com<br>
									<span>Web: www.mtsn1kulonprogo.sch.id/</span>
								</p>
							</div>
						</div>
					</div>
					<!-- Start contact icon column -->
					<div class="col-md-4 col-sm-4 col-xs-12">
						<div class="contact-icon text-center">
							<div class="single-icon">
								<i class="fa fa-map-marker"></i>
								<p>
									Lokasi: Area Sawah, Wates<br>
									<span> Kulon Progo Regency, Special Region of Yogyakarta.</span>
								</p>
							</div>
						</div>
					</div>
				</div>
				<div class="row">

					<!-- Start Google Map -->
					<div class="col-md-6 col-sm-6 col-xs-12">
						<!-- Start Map -->
						<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3952.3116220884335!2d110.14389431477855!3d-7.862420994335235!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7afb33df5d752b%3A0xcf6ab57be7382c47!2sMTs%20Negeri%201%20Kulon%20Progo!5e0!3m2!1sen!2sid!4v1571471740298!5m2!1sen!2sid" width="100%" height="380" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
						<!-- End Map -->
					</div>
					<!-- End Google Map -->

					<!-- Start  contact -->
					<div class="col-md-6 col-sm-6 col-xs-12">
						<div class="form contact-form">
							<div id="sendmessage">Your message has been sent. Thank you!</div>
							<div id="errormessage"></div>
							<form action="<?php echo base_url('welcome/insert_saran'); ?>" method="post" role="form" class="contactForm">
								<div class="form-group">
									<input type="text" name="nama" class="form-control" id="name" placeholder="Nama Anda" data-rule="minlen:4" data-msg="Isikan Nama Anda" />
									<div class="validation"></div>
								</div>
								<div class="form-group">
									<input type="text" class="form-control" name="no_hp" id="no_hp" placeholder="No.Hp Anda" data-rule="email" data-msg="Isikan No.Hp Anda" />
									<div class="validation"></div>
								</div>
								<div class="form-group">
									<textarea class="form-control" name="saran" rows="5" data-rule="required" data-msg="Isikan Saran" placeholder="Saran"></textarea>
									<div class="validation"></div>
								</div>
								<div class="text-center"><button type="submit">Kirim</button></div>
							</form>
						</div>
					</div>
					<!-- End Left contact -->
				</div>
			</div>
		</div>
	</div>
	<!-- End Contact Area -->

	<!-- Start Footer bottom Area -->
	<footer>
		<div class="footer-area">
			<div class="container">
				<div class="row">
					<!-- <div class="col-md-4 col-sm-4 col-xs-12">
						<div class="footer-content">
							<div class="footer-head">
								<div class="footer-logo">
									<h2><span>e</span>Business</h2>
								</div>

								<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis.</p>
								<div class="footer-icons">
									<ul>
										<li>
											<a href="#"><i class="fa fa-facebook"></i></a>
										</li>
										<li>
											<a href="#"><i class="fa fa-twitter"></i></a>
										</li>
										<li>
											<a href="#"><i class="fa fa-google"></i></a>
										</li>
										<li>
											<a href="#"><i class="fa fa-pinterest"></i></a>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div> -->
			<!-- 		<div class="col-md-4 col-sm-4 col-xs-12">
						<div class="footer-content">
							<div class="footer-head">
								<h4>information</h4>
								<p>
									Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.
								</p>
								<div class="footer-contacts">
									<p><span>Tel:</span> +123 456 789</p>
									<p><span>Email:</span> contact@example.com</p>
									<p><span>Working Hours:</span> 9am-5pm</p>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-12">
						<div class="footer-content">
							<div class="footer-head">
								<h4>Instagram</h4>
								<div class="flicker-img">
									<a href="#"><img src="<?php echo base_url(); ?>assets/frontend/img/portfolio/1.jpg" alt=""></a>
									<a href="#"><img src="<?php echo base_url(); ?>assets/frontend/img/portfolio/2.jpg" alt=""></a>
									<a href="#"><img src="<?php echo base_url(); ?>assets/frontend/img/portfolio/3.jpg" alt=""></a>
									<a href="#"><img src="<?php echo base_url(); ?>assets/frontend/img/portfolio/4.jpg" alt=""></a>
									<a href="#"><img src="<?php echo base_url(); ?>assets/frontend/img/portfolio/5.jpg" alt=""></a>
									<a href="#"><img src="<?php echo base_url(); ?>assets/frontend/img/portfolio/6.jpg" alt=""></a>
								</div>
							</div>
						</div>
					</div> -->
				</div>
			</div>
		</div>
		<div class="footer-area-bottom">
			<div class="container">
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="copyright text-center">
							<p>
								<strong>© 2019 - MTSN 1 KULON PROGO</strong>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
</footer>
	<a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
	<script src="<?php echo base_url(); ?>assets/frontend/lib/jquery/jquery.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/frontend/lib/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/frontend/lib/owlcarousel/owl.carousel.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/frontend/lib/venobox/venobox.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/frontend/lib/knob/jquery.knob.js"></script>
	<script src="<?php echo base_url(); ?>assets/frontend/lib/wow/wow.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/frontend/lib/parallax/parallax.js"></script>
	<script src="<?php echo base_url(); ?>assets/frontend/lib/easing/easing.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/frontend/lib/nivo-slider/js/jquery.nivo.slider.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>assets/frontend/lib/appear/jquery.appear.js"></script>
	<script src="<?php echo base_url(); ?>assets/frontend/lib/isotope/isotope.pkgd.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/frontend/contactform/contactform.js"></script>
	<script src="<?php echo base_url(); ?>assets/frontend/js/main.js"></script>
	<script src="<?php echo base_url(); ?>assets/adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
	<div class="modal fade" id="daftar" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Daftar</h4>
				</div>
				<form method="post" action="<?php echo base_url('welcome/proses_daftar'); ?>">
					<div class="modal-body">
						<div class="text-center">
							<img src="<?php echo base_url('assets/img/sma2.png'); ?>" style="width: 150px; padding-bottom: 10px">
							<p>Silahkan melakukan pendaftaran</p>
						</div>
						<div class="form-group">
							<label>Nama Siswa</label>
							<input type="text" name="nama_siswa" class="form-control" placeholder="Nama Siswa">
						</div>
						<div class="form-group">
							<label>Jenis Kelamin</label>
							<select name="jenis_kelamin" class="form-control">
								<option value="L">Laki-laki</option>
								<option value="P">Perempuan</option>
							</select>
						</div>
						<div class="form-group">
							<label>Tempat Lahir</label>
							<input type="text" name="tempat_lahir" class="form-control" placeholder="Tempat Lahir">
						</div>
						<div class="form-group">
							<label>Tanggal Lahir</label>
							<input type="text" name="tanggal_lahir" class="form-control" placeholder="Tanggal Lahir">
						</div>
						<div class="form-group">
							<label>Alamat</label>
							<textarea name="alamat" class="form-control" placeholder="Alamat"></textarea>
						</div>
						<div class="form-group">
							<label>No. Hp</label>
							<input type="text" name="no_hp" class="form-control" placeholder="No. Hp">
						</div>
						<div class="form-group">
							<label>Email</label>
							<input type="text" name="email" class="form-control" placeholder="Email">
						</div>
						<div class="form-group">
							<label>Username</label>
							<input type="text" name="username" class="form-control" placeholder="Username">
						</div>
						<div class="form-group">
							<label>Password</label>
							<input type="password" name="password" class="form-control" placeholder="Password">
						</div>
						<div class="form-group">
							<label>Ulangi Password</label>
							<input type="password" name="ulangi_password" class="form-control" placeholder="Ulangi Password">
						</div>
					</div>
					<div class="modal-footer">
						<div class="text-left">
							<button type="submit" class="btn btn-primary">Daftar</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="modal fade" id="login" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Login</h4>
				</div>
				<form method="post" action="<?php echo base_url('welcome/proses_login'); ?>">
					<div class="modal-body">
						<div class="text-center">
							<img src="<?php echo base_url('assets/img/kemenag.png'); ?>" style="width: 150px; padding-bottom: 10px">
							<p>Silahkan Login dengan Username dan Password anda</p>
						</div>
						<div class="form-group">
							<label>Username</label>
							<input type="text" name="username" class="form-control" placeholder="Username">
						</div>
						<div class="form-group">
							<label>Password</label>
							<input type="password" name="password" class="form-control" placeholder="Password">
						</div>
					</div>
					<div class="modal-footer">
						<div class="text-left">
							<button type="submit" class="btn btn-primary">Masuk</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<?php foreach ($berita as $value) { ?>
	<div class="modal fade" id="berita<?php echo $value->id_berita; ?>" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title"><?php echo $value->judul; ?></h4>
				</div>
				<div class="modal-body">
					<img src="<?php echo base_url('assets/berita/'.$value->gambar); ?>" alt="">
					<p style="text-align: justify;"><?php echo $value->deskripsi; ?></p>
					<small>
						<i class="fa fa-user"></i>
						<a><?php echo $value->ditulis; ?></a>
						&nbsp;&nbsp;&nbsp;
						<i class="fa fa-calendar"></i>
						<a><?php echo $value->tanggal; ?></a>
					</small>
				</div>
				<div class="modal-footer"></div>
			</div>
		</div>
	</div>
	<?php } ?>
</body>

</html>
