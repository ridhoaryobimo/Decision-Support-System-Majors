<ol class="breadcrumb">
	<li><a href="<?php echo base_url(); ?>">Dashboard</a></li>
	<li class="active"><?php echo $title; ?></li>
</ol>
<div class="panel panel-default">
	<div class="panel-heading"><?php echo $title; ?></div>
	<div class="panel-body">
		<?php echo $this->session->flashdata('pesan'); ?>
		<table id="tbl" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th style="width: 15px">No</th>
					<th style="width: 80px">Tanggal</th>
					<th>Agenda</th>
				</tr>
			</thead>
			<tbody>
				<?php $no=1; foreach ($data as $value) { ?>
				<tr>
					<td><?php echo $no; ?></td>
					<td><?php echo $value->tanggal; ?></td>
					<td><?php echo $value->agenda; ?></td>
				</tr>
				<?php $no++; } ?>
			</tbody>
		</table>
	</div>
</div>