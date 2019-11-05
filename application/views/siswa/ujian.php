<div class="content-wrapper">
	<section class="content-header">
		<h1>
			<?php echo $title; ?>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
			<li class="active"><?php echo $title; ?></li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header">
						<?php echo $this->session->flashdata('pesan'); ?>
					</div>
					<div class="box-body">
						<?php if (count($ujian)==0) { ?>
							<?php echo '<div class="alert alert-danger"><strong>Pemberitahuan !</strong> Ujian Belum Dimulai</div>'; ?>
						<?php } else { ?>
							<?php if (count($selesai)==1) { ?>
							<div class="alert alert-info"><strong>Pemberitahuan !</strong> Ujian Sudah Selesai</div>
							<div class="panel panel-default">
							<div class="panel-body">
							<div class="row">
							<?php foreach ($ujian as $value) { ?>
							<div class="col-md-6">
								<ul class="nav nav-tabs" role="tablist">
									<li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">INFORMASI UJIAN</a></li>
								</ul>
								<br>
								<table class="table table-bordered table-striped">
									<tr>
										<th>Tanggal Ujian</th>
										<td><?php echo $value->tanggal; ?></td>
									</tr>
									<tr>
										<th>Aktifitas Ujian</th>
										<td><?php echo $value->nama_ujian; ?></td>
									</tr>
									<tr>
										<th>Jumlah Soal</th>
										<td>
											<?php  
											$jumlah = $this->db->get_where('m_ujian', array(
												'id_user' => $value->id_user, 
											));
											echo $jumlah->num_rows();
											?>
										</td>
									</tr>
									<tr>
										<th>Jawaban Benar</th>
										<td>
											<?php  
											$jumlah = $this->db->get_where('m_ujian', array(
												'id_user' => $value->id_user, 
												'betul' => 1,
											));
											echo $jumlah->num_rows();
											?>
										</td>
									</tr>
									<tr>
										<th>Jawaban Salah</th>
										<td>
											<?php  
											$jumlah = $this->db->get_where('m_ujian', array(
												'id_user' => $value->id_user, 
												'betul' => 0,
											));
											echo $jumlah->num_rows();
											?>
										</td>
									</tr>
									<tr>
										<th>Nilai Hasil Ujian</th>
										<td><?php echo $value->nilai; ?></td>
									</tr>
									<?php if ($value->recek==0) { ?>
										<tr>
											<th>Status</th>
											<td>
												<?php if ($value->lulus==1) {
													echo '<span class="label label-success">Lulus</span>';
												} else {
													echo '<span class="label label-danger">Tidak Lulus</span>';
												} ?>
											</td>
										</tr>
									<?php } ?>
									<?php if ($value->lulus==2 && $value->recek==0) { ?>
										<tr>
											<th>Ujian Ulang</th>
											<td>
												<a href="#" data-toggle="modal" data-target="#recek<?php echo $value->id_user; ?>" class="btn btn-info"><i class="fa fa-refresh"></i> Ujian Ulang</a>
											</td>
										</tr>
									<?php } ?>
								</table>
							</div>
							<div class="col-md-6">
								<ul class="nav nav-tabs" role="tablist">
									<li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">INFORMASI UJIAN ULANG</a></li>
								</ul>
								<br>
								<?php if ($value->recek==0) { ?>
									<div class="alert alert-success text-center">Belum Ada Informasi Ujian Ulang</div>
								<?php } else { ?>
									<table class="table table-bordered table-striped">
										<tr>
											<th>Tanggal Ujian</th>
											<td><?php echo $value->tanggal_ulangan; ?></td>
										</tr>
										<tr>
											<th>Aktifitas Ujian</th>
											<td><?php echo $value->nama_ujian; ?></td>
										</tr>
										<tr>
											<th>Jumlah Soal</th>
											<td>
												<?php  
												$jumlah = $this->db->get_where('m_ujian_ulang', array(
													'id_user' => $value->id_user, 
												));
												echo $jumlah->num_rows();
												?>
											</td>
										</tr>
										<tr>
											<th>Jawaban Benar</th>
											<td>
												<?php  
												$jumlah = $this->db->get_where('m_ujian_ulang', array(
													'id_user' => $value->id_user, 
													'betul' => 1,
												));
												echo $jumlah->num_rows();
												?>
											</td>
										</tr>
										<tr>
											<th>Jawaban Salah</th>
											<td>
												<?php  
												$jumlah = $this->db->get_where('m_ujian_ulang', array(
													'id_user' => $value->id_user, 
													'betul' => 0,
												));
												echo $jumlah->num_rows();
												?>
											</td>
										</tr>
										<tr>
											<th>Nilai Ujian Ulang</th>
											<td><?php echo $value->nilai_ulangan; ?></td>
										</tr>
										<tr>
											<th>Status</th>
											<td>
												<?php if ($value->lulus==1) {
													echo '<span class="label label-success">Lulus</span>';
												} else {
													echo '<span class="label label-danger">Tidak Lulus</span>';
												} ?>
											</td>
										</tr>
									</table>
								<?php } ?>
							</div>
							<?php } ?>
							</div>
							</div>
							</div>
							<?php } else { ?>
							<b>Nomor Soal</b>
							<nav aria-label="...">
								<ul class="pagination">
									<?php $no=1; foreach ($nav as $key) { ?>
									<?php if ($key->menjawab!='' && $key->id_soal!=$this->input->get('soal')) {
										echo 
										'<li class="active">
											<a href='.base_url('ujian?soal='.$key->id_soal.'&nomor='.$no).'>'.$no.'</a>
										</li>';
									} elseif ($key->menjawab!='' && $key->id_soal==$this->input->get('soal')) {
										echo
										'<li class="active">
											<a href='.base_url('ujian?soal='.$key->id_soal.'&nomor='.$no).'><i class="fa fa-check"></i> '.$no.'</a>
										</li>';
									} elseif ($key->id_soal==$this->input->get('soal')) {
										echo
										'<li>
											<a href='.base_url('ujian?soal='.$key->id_soal.'&nomor='.$no).'><i class="fa fa-check"></i> '.$no.'</a>
										</li>';
									} else {
										echo 
										'<li>
											<a href='.base_url('ujian?soal='.$key->id_soal.'&nomor='.$no).'>'.$no.'</a>
										</li>';
									} ?>
									<?php $no++; } ?>
								</ul>
							</nav>
							<?php $no=1; foreach ($data as $row) { ?>
							<form method="post" action="<?php echo base_url('page/insert_jawaban'); ?>">
							<input type="hidden" name="id_user" value="<?php echo $row->id_user; ?>">
							<input type="hidden" name="id_soal" value="<?php echo $row->id_soal; ?>">
							<div class="form-group">
								<label>
									<?php if ($this->input->get('nomor')=='') {
										echo '<h3 style="margin-bottom: 0px"><b>1. '.$row->soal.'</b></h3>';
									} else {
										echo '<h3 style="margin-bottom: 0px"><b>'.$this->input->get('nomor').'. '.$row->soal.'</b></h3>';
									} ?>		
								</label>
								<div class="radio">
									<label>
										<?php if ($row->menjawab=='A') {
											echo '<h4 style="margin-bottom: 0px"><b><input type="radio" name="menjawab" value="A" checked></b></h4>';
										} else {
											echo '<h4 style="margin-bottom: 0px"><b><input type="radio" name="menjawab" value="A"></b></h4>';
										} ?>
										<h4 style="margin-bottom: 0px"><b>A. <?php echo $row->pilihan_a; ?></b></h4>
									</label>
								</div>
								<div class="radio">
									<label>
										<?php if ($row->menjawab=='B') {
											echo '<h4 style="margin-bottom: 0px"><b><input type="radio" name="menjawab" value="B" checked></b></h4>';
										} else {
											echo '<h4 style="margin-bottom: 0px"><b><input type="radio" name="menjawab" value="B"></b></h4>';
										} ?>
										<h4 style="margin-bottom: 0px"><b>B. <?php echo $row->pilihan_b; ?></b></h4>
									</label>
								</div>
								<div class="radio">
									<label>
										<?php if ($row->menjawab=='C') {
											echo '<h4 style="margin-bottom: 0px"><b><input type="radio" name="menjawab" value="C" checked></b></h4>';
										} else {
											echo '<h4 style="margin-bottom: 0px"><b><input type="radio" name="menjawab" value="C"></b></h4>';
										} ?>
										<h4 style="margin-bottom: 0px"><b>C. <?php echo $row->pilihan_c; ?></b></h4>
									</label>
								</div>
								<div class="radio">
									<label>
										<?php if ($row->menjawab=='D') {
											echo '<h4 style="margin-bottom: 0px"><b><input type="radio" name="menjawab" value="D" checked></b></h4>';
										} else {
											echo '<h4 style="margin-bottom: 0px"><b><input type="radio" name="menjawab" value="D"></b></h4>';
										} ?>
										<h4 style="margin-bottom: 0px"><b>D. <?php echo $row->pilihan_d; ?></b></h4>
									</label>
								</div>
								<div class="radio">
									<label>
										<?php if ($row->menjawab=='E') {
											echo '<h4 style="margin-bottom: 0px"><b><input type="radio" name="menjawab" value="E" checked></b></h4>';
										} else {
											echo '<h4 style="margin-bottom: 0px"><b><input type="radio" name="menjawab" value="E"></b></h4>';
										} ?>
										<h4 style="margin-bottom: 0px"><b>E. <?php echo $row->pilihan_e; ?></b></h4>
									</label>
								</div>
								<button type="submit" class="btn btn-primary">Jawab</button>
								<?php if (count($nav) == count($terjawab)) {
									echo '<a href="#" data-toggle="modal" data-target="#selesai'.$row->id_user.'" class="btn btn-success">Selesai</a>';
								} ?>
							</div>
							</form>
							<?php $no++; } ?>
						<?php } ?>
						<?php } ?>
						<?php foreach ($ujian as $key) {
							if ($key->status_ujian==1) {
								echo '<div id="timer">';
							}
						} ?>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<?php foreach ($data as $row) { ?>
<div class="modal fade" id="selesai<?php echo $row->id_user; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Selesai Ujian</h4>
			</div>
			<div class="modal-body">
				<p>Yakin sudah selesai menjawab semua soal ?</p>
			</div>
			<form method="post" action="<?php echo base_url('page/selesai_ujian'); ?>">
			<input type="hidden" name="id_user" value="<?php echo $row->id_user; ?>">
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary">Ya</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
			</div>
			</form>
		</div>
	</div>
</div>
<?php } ?>