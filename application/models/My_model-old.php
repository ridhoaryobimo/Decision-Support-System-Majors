<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class My_model extends CI_Model {

	public function masuk($data) {
		$query = $this->db->get_where('siswa', $data);
		return $query;
	}

	public function masuk_admin($data) {
		$query = $this->db->get_where('admin', $data);
		return $query;
	}

	public function profil()
	{
		$this->db->where('id_siswa', $this->session->userdata('id_siswa'));
		$query = $this->db->get('siswa');
		return $query->result();
	}

	public function profil_admin()
	{
		$this->db->where('id_admin', $this->session->userdata('id_admin'));
		$query = $this->db->get('admin');
		return $query->result();
	}

	public function nilai()
	{
		$this->db->where('id_siswa', $this->session->userdata('id_siswa'));
		$query = $this->db->get('nilai');
		return $query->result();
	}

	public function siswa()
	{
		$this->db->order_by('id_siswa','desc');
		$query = $this->db->get('siswa');
		return $query->result();
	}

	public function get_siswa()
	{
		$this->db->select('*');
		$this->db->from('nilai');
		$this->db->join('siswa','siswa.id_siswa = nilai.id_siswa','left');
		$this->db->order_by('siswa.id_siswa','desc');
		$this->db->where('nilai.nilai_peminatan !=', '');
		$query = $this->db->get();
		return $query->result();
	}

	public function jurusan()
	{
		$this->db->order_by('id_jurusan','desc');
		$query = $this->db->get('jurusan');
		return $query->result();
	}

	public function get_jurusan()
	{
		$this->db->order_by('id_jurusan','asc');
		// $this->db->where('id_jurusan', $this->session->userdata('jurusan'));
		$query = $this->db->get('jurusan');
		return $query->result();
	}

	public function kriteria($id_jurusan)
	{
		$this->db->order_by('id_kriteria','desc');
		$this->db->where('id_jurusan', $id_jurusan);
		$query = $this->db->get('kriteria');
		return $query->result();
	}

	public function nilai_siswa($id_siswa)
	{
		$this->db->select('*');
		$this->db->from('nilai');
		$this->db->join('siswa','siswa.id_siswa = nilai.id_siswa','left');
		$this->db->order_by('siswa.id_siswa','desc');
		$this->db->where('nilai.id_siswa', $id_siswa);
		$query = $this->db->get();
		return $query->result();
	}

	public function soal()
	{
		$this->db->select('*');
		$this->db->from('soal');
		$this->db->join('jurusan','jurusan.id_jurusan = soal.id_jurusan','left');
		$this->db->order_by('soal.id_soal','asc');
		$query = $this->db->get();
		return $query->result();
	}

	public function nav_soal()
	{
		$this->db->select('*');
		$this->db->from('soal');
		$this->db->join('ujian','ujian.id_soal = soal.id_soal','left');
		$this->db->where('ujian.id_siswa',$this->session->userdata('id_siswa'));
		$this->db->order_by('ujian.id_soal','asc');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_soal()
	{
		// $this->db->order_by('id_soal','asc');
		// $this->db->limit(1);
		// if ($this->input->get('soal')!='') {
		// 	$this->db->where('id_soal',$this->input->get('soal'));
		// }
		// $query = $this->db->get('soal');
		// return $query->result();
		$this->db->select('*');
		$this->db->from('soal');
		$this->db->join('ujian','ujian.id_soal = soal.id_soal','left');
		$this->db->limit(1);
		$this->db->order_by('ujian.id_soal','asc');
		if ($this->input->get('soal')!='') {
			$this->db->where('ujian.id_soal',$this->input->get('soal'));
		}
		$this->db->where('ujian.id_siswa',$this->session->userdata('id_siswa'));
		$query = $this->db->get();
		return $query->result();
	}

	public function informasi()
	{
		$this->db->order_by('id_informasi','desc');
		$query = $this->db->get('informasi');
		return $query->result();
	}

	public function visi_misi()
	{
		$this->db->where('id_informasi',1);
		$query = $this->db->get('informasi');
		return $query->result();
	}

	public function profil_info()
	{
		$this->db->where('id_informasi',2);
		$query = $this->db->get('informasi');
		return $query->result();
	}

	public function direktori()
	{
		$this->db->where('id_direktori',2);
		$query = $this->db->get('direktori');
		return $query->result();
	}

	public function download()
	{
		$this->db->order_by('id_download','desc');
		$query = $this->db->get('download');
		return $query->result();
	}

	public function agenda()
	{
		$this->db->where('status',1);
		$query = $this->db->get('agenda');
		return $query->result();
	}

	public function tentang_kami()
	{
		$this->db->where('id_informasi',3);
		$query = $this->db->get('informasi');
		return $query->result();
	}

	public function hubungi_kami()
	{
		$this->db->where('id_informasi',4);
		$query = $this->db->get('informasi');
		return $query->result();
	}

	public function saran()
	{
		$this->db->order_by('id_saran','desc');
		$query = $this->db->get('saran');
		return $query->result();
	}

	public function slide()
	{
		$this->db->order_by('id_slide','desc');
		$query = $this->db->get('slide');
		return $query->result();
	}

	public function slide_aktif()
	{
		$this->db->where('status',1);
		$this->db->order_by('id_slide','desc');
		$query = $this->db->get('slide');
		return $query->result();
	}

	public function berita()
	{
		$this->db->order_by('id_berita','desc');
		$query = $this->db->get('berita');
		return $query->result();
	}

	public function front_berita()
	{
		$this->db->order_by('id_berita','desc');
		$this->db->limit(3);
		$query = $this->db->get('berita');
		return $query->result();
	}

	public function detail_berita($id_berita)
	{
		$this->db->where('id_berita', $id_berita);
		$query = $this->db->get('berita');
		return $query->result();
	}

	public function pengumuman()
	{
		$this->db->order_by('id_pengumuman','desc');
		$query = $this->db->get('pengumuman');
		return $query->result();
	}

	public function galeri()
	{
		$this->db->order_by('id_galeri','desc');
		$query = $this->db->get('galeri');
		return $query->result();
	}

	public function user_admin()
	{
		$this->db->order_by('id_admin','desc');
		$query = $this->db->get('admin');
		return $query->result();
	}

	public function hasil_seleksi()
	{
		$this->db->select('*');
		$this->db->from('hasil_seleksi');
		$this->db->join('siswa','siswa.id_siswa = hasil_seleksi.id_siswa','left');
		$this->db->join('nilai','nilai.id_siswa = siswa.id_siswa','left');
		$this->db->join('jurusan','jurusan.id_jurusan = hasil_seleksi.id_jurusan','left');
		// if ($this->input->get('jurusan')) {
		// 	$this->db->where('hasil_seleksi.id_jurusan', $this->input->get('jurusan'));
		// }
		$this->db->order_by('hasil_seleksi.vektor_s','desc');
		$query = $this->db->get();
		return $query->result();
	}

	public function hasil_seleksi_siswa()
	{
		$this->db->select('*');
		$this->db->from('hasil_seleksi');
		$this->db->join('siswa','siswa.id_siswa = hasil_seleksi.id_siswa','left');
		$this->db->join('nilai','nilai.id_siswa = siswa.id_siswa','left');
		$this->db->join('jurusan','jurusan.id_jurusan = hasil_seleksi.id_jurusan','left');
		if ($this->input->get('jurusan')) {
			$this->db->where('hasil_seleksi.id_jurusan', $this->input->get('jurusan'));
		}
		$this->db->where('hasil_seleksi.umumkan',1);
		$this->db->order_by('hasil_seleksi.vektor_s','desc');
		$query = $this->db->get();
		return $query->result();
	}

	public function detail()
	{
		$this->db->select('*');
		$this->db->from('nilai');
		$this->db->join('siswa','siswa.id_siswa = nilai.id_siswa','left');
		$this->db->order_by('siswa.id_siswa','desc');
		$this->db->where('nilai.nilai_peminatan !=','');
		if ($this->session->userdata('jurusan')) {
			$this->db->where('siswa.ujian_jurusan', $this->session->userdata('jurusan'));
		}
		$query = $this->db->get();
		return $query->result();
	}
}