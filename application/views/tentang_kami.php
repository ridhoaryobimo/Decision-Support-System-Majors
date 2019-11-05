<ol class="breadcrumb">
	<li><a href="<?php echo base_url(); ?>">Beranda</a></li>
	<li class="active"><?php echo $title; ?></li>
</ol>
<div class="col-md-8 col-md-offset-2">
	<div class="panel panel-default">
		<!-- <div class="panel-heading"><?php echo $title; ?></div> -->
		<div class="panel-body">
			<?php echo $this->session->flashdata('pesan'); ?>
			<div class="col-md-12">
				<div class="text-center">
					<img src="<?php echo base_url('assets/img/sma2.png'); ?>" style="width: 10%">
				</div>
				<hr>
				<?php foreach ($data as $value) { ?>
					<?php echo $value->keterangan; ?>
				<?php } ?>
			</div>
		</div>
	</div>
</div>