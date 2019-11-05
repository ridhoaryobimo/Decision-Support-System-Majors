<div class="col-xs-12">
	<div class="box box-primary">
		<div class="box-body">
			<?php echo $this->session->flashdata('pesan'); ?>
			<div class="row">
			<?php foreach ($data as $value) { ?>
				<form method="post" action="<?php echo base_url('admin/update_informasi'); ?>">
					<div class="col-md-6">
						<div class="form-group">
							<label><?php echo $value->kategori; ?></label>
							<input type="hidden" name="id_informasi" value="<?php echo $value->id_informasi; ?>">
							<textarea id="editor<?php echo $value->id_informasi; ?>" name="keterangan" class="form-control"><?php echo $value->keterangan; ?></textarea>
						</div>
						<button type="submit" class="btn btn-primary" style="margin-bottom: 20px; width: 100%">Simpan</button>
					</div>
				</form>
			<?php } ?>
			</div>
		</div>
	</div>
</div>