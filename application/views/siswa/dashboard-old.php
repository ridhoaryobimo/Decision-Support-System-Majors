<div class="panel panel-default">
	<div class="panel-body text-center">
		<div class="row">
			<?php if (count($data)==0) { ?>
			<div class="col-md-3">
				<div class="panel panel-default">
					<div class="panel-heading">Nilai Ujian Bahasa Indonesia</div>
					<div class="panel-body">
						<h3><i class="fa fa-file-text-o"></i> 0</h3>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="panel panel-default">
					<div class="panel-heading">Nilai Ujian Matematika</div>
					<div class="panel-body">
						<h3><i class="fa fa-file-text-o"></i> 0</h3>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="panel panel-default">
					<div class="panel-heading">Nilai Ujian Bahasa Inggris</div>
					<div class="panel-body">
						<h3><i class="fa fa-file-text-o"></i> 0</h3>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="panel panel-default">
					<div class="panel-heading">Nilai Ujian Ipa</div>
					<div class="panel-body">
						<h3><i class="fa fa-file-text-o"></i> 0</h3>
					</div>
				</div>
			</div>
			<?php } else { ?>
			<?php foreach ($data as $value) { ?>
			<div class="col-md-3">
				<div class="panel panel-default">
					<div class="panel-heading">Nilai Ujian Bahasa Indonesia</div>
					<div class="panel-body">
						<h3><i class="fa fa-file-text-o"></i> <?php echo $value->nilai_bahasa_indonesia; ?></h3>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="panel panel-default">
					<div class="panel-heading">Nilai Ujian Matematika</div>
					<div class="panel-body">
						<h3><i class="fa fa-file-text-o"></i> <?php echo $value->nilai_matematika; ?></h3>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="panel panel-default">
					<div class="panel-heading">Nilai Ujian Bahasa Inggris</div>
					<div class="panel-body">
						<h3><i class="fa fa-file-text-o"></i> <?php echo $value->nilai_bahasa_inggris; ?></h3>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="panel panel-default">
					<div class="panel-heading">Nilai Ujian Ipa</div>
					<div class="panel-body">
						<h3><i class="fa fa-file-text-o"></i> <?php echo $value->nilai_ipa; ?></h3>
					</div>
				</div>
			</div>
			<?php } ?>
			<?php } ?>
		</div>
	</div>
</div>