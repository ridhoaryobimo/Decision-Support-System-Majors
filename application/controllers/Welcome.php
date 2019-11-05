<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		$data = array(
			'title' => 'Beranda',
			'halaman' => 'beranda', 
			'slide' => $this->my_model->slide_aktif(),
			'berita' => $this->my_model->front_berita(),
			'visi_misi' => $this->my_model->visi_misi(),
			'tentang_kami' => $this->my_model->tentang_kami(),
			'profil' => $this->my_model->profil_info(),
			'pengumuman' => $this->my_model->pengumuman(),
			'agenda' => $this->my_model->agenda(),
			'galeri' => $this->my_model->galeri(),
		);
		$this->load->view('template', $data);
	}

	public function index2()
	{
		$data = array(
			'title' => 'Beranda',
			'halaman' => 'beranda', 
			'slide' => $this->my_model->slide_aktif(),
			'berita' => $this->my_model->front_berita(),
			'pengumuman' => $this->my_model->pengumuman(),
		);
		$this->load->view('template-old', $data);
	}

	public function daftar()
	{
		$data = array(
			'title' => 'Daftar',
			'halaman' => 'daftar', 
		);
		$this->load->view('template-old', $data);
	}

	public function proses_daftar()
	{
		$data = array(
			'nama_siswa' => $this->input->post('nama_siswa'),
			'jenis_kelamin' => $this->input->post('jenis_kelamin'),
			'tempat_lahir' => $this->input->post('tempat_lahir'),
			'tanggal_lahir' => $this->input->post('tanggal_lahir'),
			'no_hp' => $this->input->post('no_hp'),
			'alamat' => $this->input->post('alamat'),
			'email' => $this->input->post('email'),
			'username' => $this->input->post('username'),
			'password' => md5($this->input->post('password')),
		);
		$res = $this->db->insert('siswa', $data);
		if ($res>=1) {
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible text-center" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Berhasil</strong> Menyimpan Data</div>');
			redirect($this->agent->referrer());
		} else {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible text-center" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Gagal</strong> Menyimpan Data</div>');
			redirect($this->agent->referrer());
		}
	}

	public function login()
	{
		$data = array(
			'title' => 'Login',
			'halaman' => 'login', 
		);
		$this->load->view('template-old', $data);
	}

	public function proses_login()
	{
		$data = array (
			'username' => $this->input->post('username', TRUE),
			'password' => md5($this->input->post('password', TRUE))
		);
		$hasil = $this->my_model->masuk($data);
		if ($hasil->num_rows() == 1) {
			foreach ($hasil->result() as $sess) {
				$sess_data['logged_in'] = 'Sudah Login';
				$sess_data['id_siswa'] = $sess->id_siswa;
				$sess_data['nama_siswa'] = $sess->nama_siswa;
				$this->session->set_userdata($sess_data);
			}
			$data = array(
				'last_login' => date('d/m/Y - h:i:s'), 
			);
			$this->db->update('siswa', $data, array('id_siswa' => $sess->id_siswa));
			$sess_data2['last_login'] = $sess->last_login;
			$this->session->set_userdata($sess_data2);
			redirect('siswa');
		}
		$this->session->set_flashdata('pesan', 
			'<div class="alert alert-danger text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> Username & Password Salah</div>'
		);
		redirect('login');
	}

	public function keluar()
	{
		$this->session->sess_destroy();
		redirect('/');
	}

	public function berita()
	{
		$data = array(
			'title' => 'Berita',
			'halaman' => 'berita', 
			'data' => $this->my_model->berita(),
		);
		$this->load->view('template-old', $data);
	}

	public function detail_berita($id_berita)
	{
		$data = array(
			'title' => 'Detail Berita',
			'halaman' => 'detail_berita', 
			'data' => $this->my_model->detail_berita($id_berita),
		);
		$this->load->view('template', $data);
	}

	public function visi_misi()
	{
		$data = array(
			'title' => 'Visi dan Misi',
			'halaman' => 'visi_misi', 
			'data' => $this->my_model->visi_misi(),
		);
		$this->load->view('template-old', $data);
	}

	public function profil()
	{
		$data = array(
			'title' => 'Profil',
			'halaman' => 'profil', 
			'data' => $this->my_model->profil_info(),
		);
		$this->load->view('template-old', $data);
	}

	public function direktori()
	{
		$data = array(
			'title' => 'Direktori',
			'halaman' => 'direktori', 
		);
		$this->load->view('template', $data);
	}

	public function download()
	{
		$data = array(
			'title' => 'Download',
			'halaman' => 'download', 
		);
		$this->load->view('template', $data);
	}

	public function agenda()
	{
		$data = array(
			'title' => 'Agenda',
			'halaman' => 'agenda', 
			'data' => $this->my_model->agenda(),
		);
		$this->load->view('template-old', $data);
	}

	public function galeri()
	{
		$data = array(
			'title' => 'Galeri',
			'halaman' => 'galeri', 
			'data' => $this->my_model->galeri(),
		);
		$this->load->view('template-old', $data);
	}

	public function tentang_kami()
	{
		$data = array(
			'title' => 'Tentang Kami',
			'halaman' => 'tentang_kami', 
			'data' => $this->my_model->tentang_kami(),
		);
		$this->load->view('template-old', $data);
	}

	public function hubungi_kami()
	{
		$data = array(
			'title' => 'Hubungi Kami',
			'halaman' => 'hubungi_kami', 
			'data' => $this->my_model->hubungi_kami(),
		);
		$this->load->view('template-old', $data);
	}

	public function saran()
	{
		$data = array(
			'title' => 'Hubungi Kami',
			'halaman' => 'saran', 
			'data' => $this->my_model->saran(),
		);
		$this->load->view('template', $data);
	}

	public function insert_saran()
	{
		$data = array(
			'nama' => $this->input->post('nama'),
			'no_hp' => $this->input->post('no_hp'),
			'saran' => $this->input->post('saran'),
		);
		$res = $this->db->insert('saran', $data);
		if ($res>=1) {
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible text-center" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Berhasil</strong> Menyimpan Data</div>');
			redirect($this->agent->referrer());
		} else {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible text-center" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Gagal</strong> Menyimpan Data</div>');
			redirect($this->agent->referrer());
		}
	}
}

