<div class="col-xs-12">
	<div class="box box-primary">
		<div class="box-body">
		<?php echo $this->session->flashdata('pesan'); ?>
		<form method="post" action="<?php echo base_url('siswa/mulai-ujian'); ?>">
			<div class="col-md-10">
				<select name="unggulan" class="form-control" required>
					<option value="">Pilih</option>
					<?php foreach ($data as $row) { ?>
						<option value="<?php echo $row->id_unggulan; ?>"><?php echo $row->nama_unggulan; ?></option>
					<?php } ?>
				</select>
			</div>
			<div class="col-md-2">
				<button type="submit" class="btn btn-primary" style="width: 100%">Pilih</button>
			</div>
		</form>
		</div>
	</div>
</div>
