<div class="col-xs-12">
	<div class="box box-primary">
		<div class="box-body">
			<?php echo $this->session->flashdata('pesan'); ?>
			<?php foreach ($profil as $row) { ?>
			<?php if ($row->selesai_ujian==1) { ?>
			<div class="alert alert-info text-center">
				<strong>Pemberitahuan !</strong> Anda Sudah Mengikuti Ujian Peminatan, Dengan Nilai 
				<b>
				<?php  
					$this->db->select('SUM(point) as total');
					$this->db->from('ujian');
					$this->db->where('id_siswa',$this->session->userdata('id_siswa'));
					echo $this->db->get()->row()->total; 
				?>
				</b>
			</div>
			<?php } else { ?>
			<b>Nomor Soal</b>
			<nav aria-label="...">
				<ul class="pagination">
					<?php $no=1; foreach ($nav as $key) { ?>
						<?php if ($key->point!='' && $key->id_soal!=$this->input->get('soal')) {
							echo 
							'<li class="active">
							<a href='.base_url('siswa/mulai-ujian?soal='.$key->id_soal.'&nomor='.$no).'>'.$no.'</a>
							</li>';
						} elseif ($key->point!='' && $key->id_soal==$this->input->get('soal')) {
							echo
							'<li class="active">
							<a href='.base_url('siswa/mulai-ujian?soal='.$key->id_soal.'&nomor='.$no).'><i class="fa fa-check"></i> '.$no.'</a>
							</li>';
						} elseif ($key->id_soal==$this->input->get('soal')) {
							echo
							'<li>
							<a href='.base_url('siswa/mulai-ujian?soal='.$key->id_soal.'&nomor='.$no).'><i class="fa fa-check"></i> '.$no.'</a>
							</li>';
						} else {
							echo 
							'<li>
							<a href='.base_url('siswa/mulai-ujian?soal='.$key->id_soal.'&nomor='.$no).'>'.$no.'</a>
							</li>';
						} ?>
					<?php $no++; } ?>
				</ul>
			</nav>
			<form method="post" action="<?php echo base_url('siswa/insert_pilihan'); ?>">
			<?php $no=1; foreach ($data as $value) { ?>
			<input type="hidden" name="id_soal" value="<?php echo $value->id_soal; ?>">
			<div class="form-group">
				<label>
					<?php if ($this->input->get('nomor')=='') {
						echo '<p style="margin-bottom: 0px"><b>1. '.$value->soal.'</b></p>';
					} else {
						echo '<p style="margin-bottom: 0px"><b>'.$this->input->get('nomor').'. '.$value->soal.'</b></p>';
					} ?>
				</label>
				<div class="radio">
					<label>
						<?php if ($value->id_soal == $this->input->get('nomor')  && $value->nilai_a == $value->point) { ?>
						<input type="radio" name="pilihan" value="<?php echo $value->nilai_a; ?>" checked>
						<?php } else { ?>
						<input type="radio" name="pilihan" value="<?php echo $value->nilai_a; ?>">
						<?php } ?>
						A. <?php echo $value->pilihan_a; ?>
					</label>
				</div>
				<div class="radio">
					<label>
						<?php if ($value->id_soal == $this->input->get('nomor')  &&  $value->nilai_b == $value->point) { ?>
						<input type="radio" name="pilihan" value="<?php echo $value->nilai_b; ?>" checked>
						<?php } else { ?>
						<input type="radio" name="pilihan" value="<?php echo $value->nilai_b; ?>">
						<?php } ?>
						B. <?php echo $value->pilihan_b; ?>
					</label>
				</div>
				<div class="radio">
					<label>
						<?php if ($value->id_soal == $this->input->get('nomor')  &&  $value->nilai_c == $value->point) { ?>
						<input type="radio" name="pilihan" value="<?php echo $value->nilai_c; ?>" checked>
						<?php } else { ?>
						<input type="radio" name="pilihan" value="<?php echo $value->nilai_c; ?>">
						<?php } ?>
						C. <?php echo $value->pilihan_c; ?>
					</label>
				</div>
				<div class="radio">
					<label>
						<?php if ($value->id_soal == $this->input->get('nomor')  &&  $value->nilai_d == $value->point) { ?>
						<input type="radio" name="pilihan" value="<?php echo $value->nilai_d; ?>" checked>
						<?php } else { ?>
						<input type="radio" name="pilihan" value="<?php echo $value->nilai_d; ?>">
						<?php } ?>
						D. <?php echo $value->pilihan_d; ?>
					</label>
				</div>
			</div>
			<button type="submit" class="btn btn-primary">Jawab</button>
			<?php  
				$terjawab = $this->db->get_where('ujian', array(
					'id_siswa' => $this->session->userdata('id_siswa'), 
					'point !=' => '',
				));
			?>
			<?php if (count($nav) == $terjawab->num_rows()) {
				echo '<a href="#" data-toggle="modal" data-target="#selesai" class="btn btn-success">Selesai</a>';
			} ?>
			<?php $no++; } ?>
			</form>
		<?php } ?>
		<?php } ?>
		</div>
	</div>
</div>
<div class="modal fade" id="selesai" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Selesai Ujian</h4>
			</div>
			<div class="modal-body">
				<p>Yakin sudah selesai menjawab semua soal ?</p>
			</div>
			<form method="post" action="<?php echo base_url('siswa/selesai_ujian'); ?>">
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary">Ya</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
			</div>
			</form>
		</div>
	</div>
</div>
