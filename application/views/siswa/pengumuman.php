<div class="col-xs-12">
	<div class="box box-primary">
		<div class="box-body">
			<?php echo $this->session->flashdata('pesan'); ?>
<!-- 			<div class="row">
				<form method="get" action="<?php echo base_url('siswa/pengumuman'); ?>">
				<div class="col-md-10">
					<select name="jurusan" class="form-control">
						<?php if ($this->input->get('jurusan')!='') { ?>
						<?php foreach ($jurusan as $row) { ?>
						<?php if ($row->id_jurusan == $this->input->get('jurusan')) { ?>
						<option value="<?php echo $row->id_jurusan; ?>"><?php echo $row->nama_jurusan; ?></option>
						<?php } ?>
						<?php } ?>
						<?php foreach ($jurusan as $row) { ?>
						<?php if ($row->id_jurusan != $this->input->get('jurusan')) { ?>
						<option value="<?php echo $row->id_jurusan; ?>"><?php echo $row->nama_jurusan; ?></option>
						<?php } ?>
						<?php } ?>
						<?php } else { ?>
						<option value="">Semua</option>
						<?php foreach ($jurusan as $row) { ?>
						<option value="<?php echo $row->id_jurusan; ?>"><?php echo $row->nama_jurusan; ?></option>
						<?php } ?>
						<?php } ?>
					</select>
				</div> -->
				<!-- <div class="col-md-2">
					<button type="submit" class="btn btn-primary" style="width: 100%">Tampilkan</button>
				</div> -->
			</form>
		<!-- </div> -->
		<hr>
		<table id="example1" class="table table-bordered table-striped">
			<thead>
					<tr>
						<th>Ranking</th>
						<th>Nama</th>
						<th>Status</th>
					</tr>
			</thead>
			<tbody>
				<?php $no=1; foreach ($data as $value) { ?>
					<tr>
						<td><?php echo $no; ?></td>
						<td><?php echo $value->nama_siswa; ?></td>
						<td><?php echo $value->status; ?></td>
					</tr>
					<?php $no++; } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>