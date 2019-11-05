<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class My_model extends CI_Model {

	public function auth($data) {
		$query = $this->db->get_where('m_user', $data);
		return $query;
	}

	public function email($data) {
		$query = $this->db->get_where('m_user', $data);
		return $query;
	}

	// Ujian
	public function registrasi_pemohon()
	{
		$this->db->select('*');
		$this->db->from('m_user');
		$this->db->join('m_jenis_kelamin','m_jenis_kelamin.id_jk = m_user.id_jk','left');
		$this->db->join('m_instansi','m_instansi.id_instansi = m_user.id_instansi','left');
		$this->db->join('m_pendidikan','m_pendidikan.id_pendidikan = m_user.id_pendidikan','left');
		$this->db->join('m_negara','m_negara.id_negara = m_user.id_negara','left');
		$this->db->where('m_user.id_tipe',4);
		if ($this->session->userdata('id_tipe')==2) {
			$this->db->where('m_user.id_instansi',$this->session->userdata('id_instansi'));
		}
		$this->db->order_by('m_user.id_user','asc');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_registrasi_pemohon($id)
	{
		$this->db->select('*');
		$this->db->from('m_user');
		$this->db->join('m_jenis_kelamin','m_jenis_kelamin.id_jk = m_user.id_jk','left');
		$this->db->join('m_instansi','m_instansi.id_instansi = m_user.id_instansi','left');
		$this->db->join('m_pendidikan','m_pendidikan.id_pendidikan = m_user.id_pendidikan','left');
		$this->db->join('m_negara','m_negara.id_negara = m_user.id_negara','left');
		$this->db->where('m_user.id_user',$id);
		$query = $this->db->get();
		return $query->result();
	}

	public function peserta_ujian()
	{
		$this->db->select('*');
		$this->db->from('m_user');
		$this->db->join('m_jenis_kelamin','m_jenis_kelamin.id_jk = m_user.id_jk','left');
		$this->db->join('m_instansi','m_instansi.id_instansi = m_user.id_instansi','left');
		$this->db->join('m_pendidikan','m_pendidikan.id_pendidikan = m_user.id_pendidikan','left');
		$this->db->join('m_negara','m_negara.id_negara = m_user.id_negara','left');
		$this->db->where('m_user.step !=',0);
		$this->db->order_by('m_user.id_user','desc');
		$query = $this->db->get();
		return $query->result();
	}

	public function detail_peserta_ujian($id)
	{
		$this->db->select('*');
		$this->db->from('m_user');
		$this->db->join('m_jenis_kelamin','m_jenis_kelamin.id_jk = m_user.id_jk','left');
		$this->db->join('m_instansi','m_instansi.id_instansi = m_user.id_instansi','left');
		$this->db->join('m_pendidikan','m_pendidikan.id_pendidikan = m_user.id_pendidikan','left');
		$this->db->join('m_negara','m_negara.id_negara = m_user.id_negara','left');
		$this->db->where('m_user.id_user',$id);
		$query = $this->db->get();
		return $query->result();
	}

	public function sertifikat_kompetensi($id)
	{
		$this->db->order_by('id_sk','asc');
		$query = $this->db->get_where('m_sertifikat_kompetensi', array('id_user' => $id));
		return $query->result();
	}

	public function medex($id)
	{
		$this->db->order_by('id_medex','asc');
		$query = $this->db->get_where('m_medex', array('id_user' => $id));
		return $query->result();
	}

	public function icao($id)
	{
		$this->db->order_by('id_icao','asc');
		$query = $this->db->get_where('m_icao', array('id_user' => $id));
		return $query->result();
	}

	public function pembayaran($id)
	{
		$this->db->order_by('id_pembayaran','asc');
		$query = $this->db->get_where('m_pembayaran', array('id_user' => $id));
		return $query->result();
	}

	public function aktifitas_ujian()
	{
		$this->db->select('*');
		$this->db->from('m_aktifitas_ujian');
		$this->db->join('m_bandara','m_bandara.id_bandara = m_aktifitas_ujian.id_bandara');
		$this->db->order_by('m_aktifitas_ujian.id_aktifitas_ujian','asc');
		$query = $this->db->get();
		return $query->result();
	}

	public function set_aktifitas_ujian()
	{
		$this->db->select('*');
		$this->db->from('m_set_ujian');
		$this->db->join('m_aktifitas_ujian','m_aktifitas_ujian.id_aktifitas_ujian = m_set_ujian.id_aktifitas_ujian','left');
		$this->db->join('m_user','m_user.id_user = m_set_ujian.id_user','left');
		$this->db->where('m_user.id_user',$this->session->userdata('id_user'));
		$query = $this->db->get();
		return $query->result();
	}

	public function get_pemohon()
	{
		$this->db->select('*');
		$this->db->from('m_pemohon');
		$this->db->join('m_user','m_user.id_user = m_pemohon.id_user');
		$this->db->join('m_jenis_kelamin','m_jenis_kelamin.id_jk = m_user.id_jk');
		$this->db->where('m_pemohon.id_aktifitas_ujian',$this->input->get('aktifitas'));
		$this->db->order_by('m_pemohon.id_pemohon','desc');
		$query = $this->db->get();
		return $query->result();
	}

	public function review_hasil_ujian()
	{
		$this->db->select('*');
		$this->db->from('m_set_ujian');
		$this->db->join('m_aktifitas_ujian','m_aktifitas_ujian.id_aktifitas_ujian = m_set_ujian.id_aktifitas_ujian','left');
		$this->db->join('m_user','m_user.id_user = m_set_ujian.id_user','left');
		$this->db->join('m_jenis_kelamin','m_jenis_kelamin.id_jk = m_user.id_jk','left');
		$this->db->join('m_instansi','m_instansi.id_instansi = m_user.id_instansi','left');
		$this->db->join('m_pendidikan','m_pendidikan.id_pendidikan = m_user.id_pendidikan','left');
		$this->db->join('m_negara','m_negara.id_negara = m_user.id_negara','left');
		$this->db->where('m_set_ujian.lulus !=',0);
		if ($this->session->userdata('id_tipe')==4) {
			$this->db->where('m_user.id_user',$this->session->userdata('id_user'));
		}
		if ($this->session->userdata('id_tipe')==2) {
			$this->db->where('m_user.id_instansi',$this->session->userdata('id_instansi'));
		}
		$this->db->order_by('m_user.id_user','desc');
		$query = $this->db->get();
		return $query->result();
	}
	// End Ujian

	// Personil
	public function personel()
	{
		$this->db->select('*');
		$this->db->from('m_user');
		$this->db->join('m_set_ujian','m_set_ujian.id_user = m_user.id_user','left');
		$this->db->join('m_jenis_kelamin','m_jenis_kelamin.id_jk = m_user.id_jk','left');
		$this->db->join('m_pendidikan','m_pendidikan.id_pendidikan = m_user.id_pendidikan','left');
		$this->db->join('m_instansi','m_instansi.id_instansi = m_user.id_instansi','left');
		$this->db->join('m_negara','m_negara.id_negara = m_user.id_instansi','left');
		$this->db->where('m_set_ujian.lulus',1);
		if ($this->session->userdata('id_tipe')==4) {
			$this->db->where('m_user.id_user',$this->session->userdata('id_user'));
		}
		if ($this->session->userdata('id_tipe')==2) {
			$this->db->where('m_user.id_instansi',$this->session->userdata('id_instansi'));
		}
		$this->db->order_by('m_user.id_user','desc');
		$query = $this->db->get();
		return $query->result();
	}
	// End Personil

	// Master Data
	public function soal()
	{
		$this->db->order_by('id_soal','asc');
		$query = $this->db->get('m_soal');
		return $query->result();
	}

	public function get_soal()
	{
		$this->db->where('id_soal', $this->input->get('soal'));
		$query = $this->db->get('m_soal');
		return $query->result();
	}

	public function soal_ujian()
	{
		$this->db->where('id_user',$this->session->userdata('id_user'));
		$query = $this->db->get('m_ujian');
		return $query->result();
	}

	public function soal_ujian_ulang()
	{
		$this->db->where('id_user',$this->session->userdata('id_user'));
		$query = $this->db->get('m_ujian_ulang');
		return $query->result();
	}

	public function soal_terjawab()
	{
		$this->db->where('id_user',$this->session->userdata('id_user'));
		$this->db->where('menjawab !=','');
		$query = $this->db->get('m_ujian');
		return $query->result();
	}

	public function soal_ujian_ulang_terjawab()
	{
		$this->db->where('id_user',$this->session->userdata('id_user'));
		$this->db->where('menjawab !=','');
		$query = $this->db->get('m_ujian_ulang');
		return $query->result();
	}

	public function selesai_ujian()
	{
		$this->db->where('id_user',$this->session->userdata('id_user'));
		$this->db->where('lulus !=',0);
		$query = $this->db->get('m_set_ujian');
		return $query->result();
	}

	public function get_soal_ujian()
	{
		$this->db->select('*');
		$this->db->from('m_ujian');
		$this->db->join('m_soal','m_soal.id_soal = m_ujian.id_soal','left');
		$this->db->join('m_user','m_user.id_user = m_ujian.id_user','left');
		$this->db->where('m_user.id_user',$this->session->userdata('id_user'));
		$this->db->limit(1);
		if ($this->input->get('soal')!='') {
			$this->db->where('m_ujian.id_soal',$this->input->get('soal'));
		}
		$query = $this->db->get();
		return $query->result();
	}

	public function get_soal_ujian_ulang()
	{
		$this->db->select('*');
		$this->db->from('m_ujian_ulang');
		$this->db->join('m_soal','m_soal.id_soal = m_ujian_ulang.id_soal','left');
		$this->db->join('m_user','m_user.id_user = m_ujian_ulang.id_user','left');
		$this->db->where('m_user.id_user',$this->session->userdata('id_user'));
		$this->db->limit(1);
		if ($this->input->get('soal')!='') {
			$this->db->where('m_ujian_ulang.id_soal',$this->input->get('soal'));
		}
		$query = $this->db->get();
		return $query->result();
	}

	public function kobu()
	{
		$this->db->order_by('id_kobu','asc');
		$query = $this->db->get('m_kobu');
		return $query->result();
	}

	public function negara()
	{
		$this->db->order_by('nama_negara','asc');
		$query = $this->db->get('m_negara');
		return $query->result();
	}

	public function pendidikan()
	{
		$this->db->order_by('id_pendidikan','asc');
		$query = $this->db->get('m_pendidikan');
		return $query->result();
	}

	public function bandara()
	{
		$this->db->select('*');
		$this->db->from('m_bandara');
		$this->db->join('m_kobu','m_kobu.id_kobu = m_bandara.id_kobu','left');
		$this->db->order_by('m_bandara.nama_bandara','asc');
		$query = $this->db->get();
		return $query->result();
	}

	public function instansi()
	{
		$this->db->order_by('nama_instansi','asc');
		if ($this->session->userdata('id_tipe')==2) {
			$this->db->where('id_instansi',$this->session->userdata('id_instansi'));
		}
		$query = $this->db->get('m_instansi');
		return $query->result();
	}

	public function rating()
	{
		$this->db->order_by('nama_rating','asc');
		$query = $this->db->get('m_rating');
		return $query->result();
	}

	public function pimpinan()
	{
		$this->db->order_by('nama_pimpinan','asc');
		$query = $this->db->get('m_pimpinan');
		return $query->result();
	}
	// End Master Data

	// Manajemen User
	public function jenis_kelamin()
	{
		$this->db->order_by('id_jk','asc');
		$query = $this->db->get('m_jenis_kelamin');
		return $query->result();
	}

	public function tipe_user()
	{
		$this->db->order_by('nama_tipe','asc');
		$query = $this->db->get('m_tipe');
		return $query->result();
	}

	public function register_tipe_user()
	{
		$this->db->order_by('nama_tipe','asc');
		$this->db->where('id_tipe',2);
		$this->db->or_where('id_tipe',3);
		$query = $this->db->get('m_tipe');
		return $query->result();
	}

	public function user()
	{
		$this->db->select('*');
		$this->db->from('m_user');
		$this->db->join('m_tipe','m_tipe.id_tipe = m_user.id_tipe','left');
		$this->db->join('m_instansi','m_instansi.id_instansi = m_user.id_instansi','left');
		$this->db->order_by('m_user.id_user','desc');
		$query = $this->db->get();
		return $query->result();
	}
	// End Manajemen User

	// Laporan
	public function laporan()
	{
		$this->db->select('*');
		$this->db->from('m_set_ujian');
		$this->db->join('m_aktifitas_ujian','m_aktifitas_ujian.id_aktifitas_ujian = m_set_ujian.id_aktifitas_ujian','left');
		$this->db->join('m_user','m_user.id_user = m_set_ujian.id_user','left');
		$this->db->join('m_jenis_kelamin','m_jenis_kelamin.id_jk = m_user.id_jk','left');
		$this->db->join('m_instansi','m_instansi.id_instansi = m_user.id_instansi','left');
		$this->db->join('m_pendidikan','m_pendidikan.id_pendidikan = m_user.id_pendidikan','left');
		$this->db->join('m_negara','m_negara.id_negara = m_user.id_negara','left');
		$this->db->where('m_set_ujian.lulus',1);
		$this->db->order_by('m_user.id_user','desc');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_laporan()
	{
		$this->db->select('*');
		$this->db->from('m_set_ujian');
		$this->db->join('m_aktifitas_ujian','m_aktifitas_ujian.id_aktifitas_ujian = m_set_ujian.id_aktifitas_ujian','left');
		$this->db->join('m_user','m_user.id_user = m_set_ujian.id_user','left');
		$this->db->join('m_jenis_kelamin','m_jenis_kelamin.id_jk = m_user.id_jk','left');
		$this->db->join('m_instansi','m_instansi.id_instansi = m_user.id_instansi','left');
		$this->db->join('m_pendidikan','m_pendidikan.id_pendidikan = m_user.id_pendidikan','left');
		$this->db->join('m_negara','m_negara.id_negara = m_user.id_negara','left');
		$this->db->where('m_user.id_user',$this->input->get('user'));
		$this->db->order_by('m_user.id_user','desc');
		$query = $this->db->get();
		return $query->result();
	}
	// End Laporan

	// Profile
	public function profile()
	{
		$this->db->select('*');
		$this->db->from('m_user');
		$this->db->join('m_tipe','m_tipe.id_tipe = m_user.id_tipe','left');
		$this->db->join('m_instansi','m_instansi.id_instansi = m_user.id_instansi','left');
		$this->db->where('m_user.id_user', $this->session->userdata('id_user'));
		$query = $this->db->get();
		return $query->result();
	}
	// End Profile
}