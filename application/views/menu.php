<?php if ($halaman=='beranda') { ?>
<li class="active"><a href="<?php echo base_url(); ?>">Home <span class="sr-only">(current)</span></a></li>
<li><a href="<?php echo base_url('berita'); ?>">Berita</a></li>
<li><a href="<?php echo base_url('visi-misi'); ?>">Visi dan Misi</a></li>
<li><a href="<?php echo base_url('profil'); ?>">Profil</a></li>
<li><a href="<?php echo base_url('agenda'); ?>">Agenda</a></li>
<li><a href="<?php echo base_url('galeri'); ?>">Galeri</a></li>
<li class="dropdown">
	<a href="<?php echo base_url('download'); ?>"class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Download <span class="caret"></span></a>
	<ul class="dropdown-menu">
		<?php 
		$this->db->order_by('id_download','desc'); 
		$download = $this->db->get_where('download', array('status' => 1));
		?>
		<?php foreach ($download->result() as $key) { ?>
			<li><a href="<?php echo base_url('assets/download/'.$key->download); ?>" target="_blank"><?php echo $key->nama; ?></a></li>
			<li role="separator" class="divider"></li>
		<?php } ?>
	</ul>
</li>
<li><a href="<?php echo base_url('tentang-kami'); ?>">Tentang Kami</a></li>
<li><a href="<?php echo base_url('hubungi-kami'); ?>">Hubungi Kami</a></li>
<?php } elseif ($halaman=='berita') { ?>
<li><a href="<?php echo base_url(); ?>">Home <span class="sr-only">(current)</span></a></li>
<li class="active"><a href="<?php echo base_url('berita'); ?>">Berita</a></li>
<li><a href="<?php echo base_url('visi-misi'); ?>">Visi dan Misi</a></li>
<li><a href="<?php echo base_url('profil'); ?>">Profil</a></li>
<li><a href="<?php echo base_url('agenda'); ?>">Agenda</a></li>
<li><a href="<?php echo base_url('galeri'); ?>">Galeri</a></li>
<li class="dropdown">
	<a href="<?php echo base_url('download'); ?>"class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Download <span class="caret"></span></a>
	<ul class="dropdown-menu">
		<?php 
		$this->db->order_by('id_download','desc'); 
		$download = $this->db->get_where('download', array('status' => 1));
		?>
		<?php foreach ($download->result() as $key) { ?>
			<li><a href="<?php echo base_url('assets/download/'.$key->download); ?>" target="_blank"><?php echo $key->nama; ?></a></li>
			<li role="separator" class="divider"></li>
		<?php } ?>
	</ul>
</li>
<li><a href="<?php echo base_url('tentang-kami'); ?>">Tentang Kami</a></li>
<li><a href="<?php echo base_url('hubungi-kami'); ?>">Hubungi Kami</a></li>
<?php } elseif ($halaman=='berita') { ?>
<li><a href="<?php echo base_url(); ?>">Home <span class="sr-only">(current)</span></a></li>
<li class="active"><a href="<?php echo base_url('berita'); ?>">Berita</a></li>
<li><a href="<?php echo base_url('visi-misi'); ?>">Visi dan Misi</a></li>
<li><a href="<?php echo base_url('profil'); ?>">Profil</a></li>
<li><a href="<?php echo base_url('agenda'); ?>">Agenda</a></li>
<li><a href="<?php echo base_url('galeri'); ?>">Galeri</a></li>
<li class="dropdown">
	<a href="<?php echo base_url('download'); ?>"class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Download <span class="caret"></span></a>
	<ul class="dropdown-menu">
		<?php 
		$this->db->order_by('id_download','desc'); 
		$download = $this->db->get_where('download', array('status' => 1));
		?>
		<?php foreach ($download->result() as $key) { ?>
			<li><a href="<?php echo base_url('assets/download/'.$key->download); ?>" target="_blank"><?php echo $key->nama; ?></a></li>
			<li role="separator" class="divider"></li>
		<?php } ?>
	</ul>
</li>
<li><a href="<?php echo base_url('tentang-kami'); ?>">Tentang Kami</a></li>
<li><a href="<?php echo base_url('hubungi-kami'); ?>">Hubungi Kami</a></li>
<?php } elseif ($halaman=='visi_misi') { ?>
<li><a href="<?php echo base_url(); ?>">Home <span class="sr-only">(current)</span></a></li>
<li><a href="<?php echo base_url('berita'); ?>">Berita</a></li>
<li class="active"><a href="<?php echo base_url('visi-misi'); ?>">Visi dan Misi</a></li>
<li><a href="<?php echo base_url('profil'); ?>">Profil</a></li>
<li><a href="<?php echo base_url('agenda'); ?>">Agenda</a></li>
<li><a href="<?php echo base_url('galeri'); ?>">Galeri</a></li>
<li class="dropdown">
	<a href="<?php echo base_url('download'); ?>"class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Download <span class="caret"></span></a>
	<ul class="dropdown-menu">
		<?php 
		$this->db->order_by('id_download','desc'); 
		$download = $this->db->get_where('download', array('status' => 1));
		?>
		<?php foreach ($download->result() as $key) { ?>
			<li><a href="<?php echo base_url('assets/download/'.$key->download); ?>" target="_blank"><?php echo $key->nama; ?></a></li>
			<li role="separator" class="divider"></li>
		<?php } ?>
	</ul>
</li>
<li><a href="<?php echo base_url('tentang-kami'); ?>">Tentang Kami</a></li>
<li><a href="<?php echo base_url('hubungi-kami'); ?>">Hubungi Kami</a></li>
<?php } elseif ($halaman=='profil') { ?>
<li><a href="<?php echo base_url(); ?>">Home <span class="sr-only">(current)</span></a></li>
<li><a href="<?php echo base_url('berita'); ?>">Berita</a></li>
<li><a href="<?php echo base_url('visi-misi'); ?>">Visi dan Misi</a></li>
<li class="active"><a href="<?php echo base_url('profil'); ?>">Profil</a></li>
<li><a href="<?php echo base_url('agenda'); ?>">Agenda</a></li>
<li><a href="<?php echo base_url('galeri'); ?>">Galeri</a></li>
<li class="dropdown">
	<a href="<?php echo base_url('download'); ?>"class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Download <span class="caret"></span></a>
	<ul class="dropdown-menu">
		<?php 
		$this->db->order_by('id_download','desc'); 
		$download = $this->db->get_where('download', array('status' => 1));
		?>
		<?php foreach ($download->result() as $key) { ?>
			<li><a href="<?php echo base_url('assets/download/'.$key->download); ?>" target="_blank"><?php echo $key->nama; ?></a></li>
			<li role="separator" class="divider"></li>
		<?php } ?>
	</ul>
</li>
<li><a href="<?php echo base_url('tentang-kami'); ?>">Tentang Kami</a></li>
<li><a href="<?php echo base_url('hubungi-kami'); ?>">Hubungi Kami</a></li>
<?php } elseif ($halaman=='agenda') { ?>
<li><a href="<?php echo base_url(); ?>">Home <span class="sr-only">(current)</span></a></li>
<li><a href="<?php echo base_url('berita'); ?>">Berita</a></li>
<li><a href="<?php echo base_url('visi-misi'); ?>">Visi dan Misi</a></li>
<li><a href="<?php echo base_url('profil'); ?>">Profil</a></li>
<li class="active"><a href="<?php echo base_url('agenda'); ?>">Agenda</a></li>
<li><a href="<?php echo base_url('galeri'); ?>">Galeri</a></li>
<li class="dropdown">
	<a href="<?php echo base_url('download'); ?>"class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Download <span class="caret"></span></a>
	<ul class="dropdown-menu">
		<?php 
		$this->db->order_by('id_download','desc'); 
		$download = $this->db->get_where('download', array('status' => 1));
		?>
		<?php foreach ($download->result() as $key) { ?>
			<li><a href="<?php echo base_url('assets/download/'.$key->download); ?>" target="_blank"><?php echo $key->nama; ?></a></li>
			<li role="separator" class="divider"></li>
		<?php } ?>
	</ul>
</li>
<li><a href="<?php echo base_url('tentang-kami'); ?>">Tentang Kami</a></li>
<li><a href="<?php echo base_url('hubungi-kami'); ?>">Hubungi Kami</a></li>
<?php } elseif ($halaman=='galeri') { ?>
<li><a href="<?php echo base_url(); ?>">Home <span class="sr-only">(current)</span></a></li>
<li><a href="<?php echo base_url('berita'); ?>">Berita</a></li>
<li><a href="<?php echo base_url('visi-misi'); ?>">Visi dan Misi</a></li>
<li><a href="<?php echo base_url('profil'); ?>">Profil</a></li>
<li><a href="<?php echo base_url('agenda'); ?>">Agenda</a></li>
<li class="active"><a href="<?php echo base_url('galeri'); ?>">Galeri</a></li>
<li class="dropdown">
	<a href="<?php echo base_url('download'); ?>"class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Download <span class="caret"></span></a>
	<ul class="dropdown-menu">
		<?php 
		$this->db->order_by('id_download','desc'); 
		$download = $this->db->get_where('download', array('status' => 1));
		?>
		<?php foreach ($download->result() as $key) { ?>
			<li><a href="<?php echo base_url('assets/download/'.$key->download); ?>" target="_blank"><?php echo $key->nama; ?></a></li>
			<li role="separator" class="divider"></li>
		<?php } ?>
	</ul>
</li>
<li><a href="<?php echo base_url('tentang-kami'); ?>">Tentang Kami</a></li>
<li><a href="<?php echo base_url('hubungi-kami'); ?>">Hubungi Kami</a></li>
<?php } elseif ($halaman=='tentang_kami') { ?>
<li><a href="<?php echo base_url(); ?>">Home <span class="sr-only">(current)</span></a></li>
<li><a href="<?php echo base_url('berita'); ?>">Berita</a></li>
<li><a href="<?php echo base_url('visi-misi'); ?>">Visi dan Misi</a></li>
<li><a href="<?php echo base_url('profil'); ?>">Profil</a></li>
<li><a href="<?php echo base_url('agenda'); ?>">Agenda</a></li>
<li><a href="<?php echo base_url('galeri'); ?>">Galeri</a></li>
<li class="dropdown">
	<a href="<?php echo base_url('download'); ?>"class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Download <span class="caret"></span></a>
	<ul class="dropdown-menu">
		<?php 
		$this->db->order_by('id_download','desc'); 
		$download = $this->db->get_where('download', array('status' => 1));
		?>
		<?php foreach ($download->result() as $key) { ?>
			<li><a href="<?php echo base_url('assets/download/'.$key->download); ?>" target="_blank"><?php echo $key->nama; ?></a></li>
			<li role="separator" class="divider"></li>
		<?php } ?>
	</ul>
</li>
<li class="active"><a href="<?php echo base_url('tentang-kami'); ?>">Tentang Kami</a></li>
<li><a href="<?php echo base_url('hubungi-kami'); ?>">Hubungi Kami</a></li>
<?php } elseif ($halaman=='hubungi_kami') { ?>
<li><a href="<?php echo base_url(); ?>">Home <span class="sr-only">(current)</span></a></li>
<li><a href="<?php echo base_url('berita'); ?>">Berita</a></li>
<li><a href="<?php echo base_url('visi-misi'); ?>">Visi dan Misi</a></li>
<li><a href="<?php echo base_url('profil'); ?>">Profil</a></li>
<li><a href="<?php echo base_url('agenda'); ?>">Agenda</a></li>
<li><a href="<?php echo base_url('galeri'); ?>">Galeri</a></li>
<li class="dropdown">
	<a href="<?php echo base_url('download'); ?>"class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Download <span class="caret"></span></a>
	<ul class="dropdown-menu">
		<?php 
		$this->db->order_by('id_download','desc'); 
		$download = $this->db->get_where('download', array('status' => 1));
		?>
		<?php foreach ($download->result() as $key) { ?>
			<li><a href="<?php echo base_url('assets/download/'.$key->download); ?>" target="_blank"><?php echo $key->nama; ?></a></li>
			<li role="separator" class="divider"></li>
		<?php } ?>
	</ul>
</li>
<li><a href="<?php echo base_url('tentang-kami'); ?>">Tentang Kami</a></li>
<li class="active"><a href="<?php echo base_url('hubungi-kami'); ?>">Hubungi Kami</a></li>
<?php } else { ?>
<li><a href="<?php echo base_url(); ?>">Home <span class="sr-only">(current)</span></a></li>
<li><a href="<?php echo base_url('berita'); ?>">Berita</a></li>
<li><a href="<?php echo base_url('visi-misi'); ?>">Visi dan Misi</a></li>
<li><a href="<?php echo base_url('profil'); ?>">Profil</a></li>
<li><a href="<?php echo base_url('agenda'); ?>">Agenda</a></li>
<li><a href="<?php echo base_url('galeri'); ?>">Galeri</a></li>
<li class="dropdown">
	<a href="<?php echo base_url('download'); ?>"class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Download <span class="caret"></span></a>
	<ul class="dropdown-menu">
		<?php 
		$this->db->order_by('id_download','desc'); 
		$download = $this->db->get_where('download', array('status' => 1));
		?>
		<?php foreach ($download->result() as $key) { ?>
			<li><a href="<?php echo base_url('assets/download/'.$key->download); ?>" target="_blank"><?php echo $key->nama; ?></a></li>
			<li role="separator" class="divider"></li>
		<?php } ?>
	</ul>
</li>
<li><a href="<?php echo base_url('tentang-kami'); ?>">Tentang Kami</a></li>
<li><a href="<?php echo base_url('hubungi-kami'); ?>">Hubungi Kami</a></li>
<?php } ?>