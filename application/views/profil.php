<ol class="breadcrumb">
	<li><a href="<?php echo base_url(); ?>">Beranda</a></li>
	<li class="active"><?php echo $title; ?></li>
</ol>
<div class="panel panel-default">
	<div class="panel-heading"><?php echo $title; ?></div>
	<div class="panel-body">
		<?php echo $this->session->flashdata('pesan'); ?>
		<div class="col-md-2">
			<img src="<?php echo base_url('assets/img/sma2.png'); ?>" style="width: 90%">
		</div>
		<div class="col-md-10">
			<?php foreach ($data as $value) { ?>
			<?php echo $value->keterangan; ?>
			<?php } ?>
		</div>
	</div>
</div>