<?php  
	$ujian_ulang = $this->db->get_where('m_set_ujian', array(
		'id_user' => $this->session->userdata('id_user'),
		'recek' => 1,
	));
?>
<li class="treeview">
	<a href="#">
		<i class="fa fa-pencil"></i>
		<span>Ujian</span>
		<span class="pull-right-container">
			<i class="fa fa-angle-left pull-right"></i>
		</span>
	</a>
	<ul class="treeview-menu">
		<li>
			<?php if ($ujian_ulang->num_rows()==1) {
				echo '<a href='.base_url('ujian/ulang').'><i class="fa fa-circle-o"></i>  Mulai Ujian</a>';
			} else {
				echo '<a href='.base_url('ujian').'><i class="fa fa-circle-o"></i>  Mulai Ujian</a>';
			} ?>
		</li>
		<li><a href="<?php echo base_url('review/hasil/ujian'); ?>"><i class="fa fa-circle-o"></i> Review Hasil Ujian</a></li>
	</ul>
</li>
<li>
	<a href="<?php echo base_url('personel'); ?>">
		<i class="fa fa-user"></i> <span>Personel</span>
	</a>
</li>
<li class="treeview">
	<a href="#">
		<i class="fa fa-user-plus"></i>
		<span>Manajemen User</span>
		<span class="pull-right-container">
			<i class="fa fa-angle-left pull-right"></i>
		</span>
	</a>
	<ul class="treeview-menu">
		<li>
			<a href="<?php echo base_url('profile'); ?>"><i class="fa fa-circle-o"></i> Ubah Profile User</a>
		</li>
	</ul>
</li>