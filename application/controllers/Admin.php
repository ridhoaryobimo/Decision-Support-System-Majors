<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('id_admin')) {
			redirect('auth');
		}
		date_default_timezone_set("Asia/Bangkok");
	}

	public function index()
	{
		$data = array(
			'title' => 'Dashboard',
			'halaman' => 'dashboard', 
		);
		$this->load->view('admin/template', $data);
	}

	public function profil()
	{
		$data = array(
			'title' => 'Profil',
			'halaman' => 'profil',
			'data' => $this->my_model->profil_admin(),
		);
		$this->load->view('admin/template', $data);
	}

	public function update_profil()
	{
		$name = 'foto-'.uniqid();
		$config['upload_path'] = './assets/img/';
		$config['allowed_types'] = 'png|jpg|jpeg';
		$config['file_name'] = $name;

		$this->upload->initialize($config);

		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible text-center" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Gagal</strong> Update Foto, Format Disarankan png,jpg, jpeg, Silahkan Ulangi Kembali</div>');
			redirect('siswa');
		} else {
			$this->db->where('id_admin', $this->session->userdata('id_admin'));
			$query = $this->db->get('admin');
			$row = $query->row();
			unlink("./assets/img/$row->foto");
			$image = $this->upload->data();
			if ($this->input->post('password')!='') {
				$data = array(
					'nama_admin' => $this->input->post('nama_admin'),
					'username' => $this->input->post('username'),
					'password' => md5($this->input->post('password')),
					'foto' => $image['file_name'],
				);
			} else {
				$data = array(
					'nama_admin' => $this->input->post('nama_admin'),
					'username' => $this->input->post('username'),
					'foto' => $image['file_name'],
				);
			}
			$res = $this->db->update('admin', $data, array('id_admin' => $this->session->userdata('id_admin')));
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

	public function update_foto()
	{
		$name = 'foto-'.uniqid();
		$config['upload_path'] = './assets/img/';
		$config['allowed_types'] = 'png|jpg|jpeg';
		$config['file_name'] = $name;

		$this->upload->initialize($config);

		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible text-center" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Gagal</strong> Update Foto, Format Disarankan png,jpg, jpeg, Silahkan Ulangi Kembali</div>');
			redirect('siswa');
		} else {
			$this->db->where('id_admin', $this->session->userdata('id_admin'));
			$query = $this->db->get('admin');
			$row = $query->row();
			unlink("./assets/img/$row->foto");
			$image = $this->upload->data();
			$data = array(
				'foto' => $image['file_name'],
			);
			$res = $this->db->update('admin', $data, array('id_admin' => $this->session->userdata('id_admin')));
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

	public function informasi()
	{
		$data = array(
			'title' => 'Informasi',
			'halaman' => 'informasi', 
			'data' => $this->my_model->informasi(),
		);
		$this->load->view('admin/template', $data);
	}

	public function update_informasi()
	{
		$data = array(
			'keterangan' => $this->input->post('keterangan'),
		);
		$res = $this->db->update('informasi', $data, array('id_informasi' => $this->input->post('id_informasi')));
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

	public function slide()
	{
		$data = array(
			'title' => 'Slide',
			'halaman' => 'slide', 
			'data' => $this->my_model->slide(),
		);
		$this->load->view('admin/template', $data);
	}

	public function insert_slide()
	{
		$name = 'slide-'.uniqid();
		$config['upload_path'] = './assets/slide/';
		$config['allowed_types'] = 'png|jpg|jpeg';
		$config['file_name'] = $name;

		$this->upload->initialize($config);

		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible text-center" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Gagal</strong> Menyimpan Slide, Format Disarankan png,jpg, jpeg, Silahkan Ulangi Kembali</div>');
			redirect($this->agent->referrer());
		} else {
			$image = $this->upload->data();
			$data = array(
				'gambar' => $image['file_name'],
				'status' => $this->input->post('status'),
			);
			$res = $this->db->insert('slide', $data);
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

	public function update_slide()
	{
		$name = 'slide-'.uniqid();
		$config['upload_path'] = './assets/slide/';
		$config['allowed_types'] = 'png|jpg|jpeg';
		$config['file_name'] = $name;

		$this->upload->initialize($config);

		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible text-center" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Gagal</strong> Menyimpan Slide, Format Disarankan png,jpg, jpeg, Silahkan Ulangi Kembali</div>');
			redirect($this->agent->referrer());
		} else {
			$this->db->where('id_slide', $this->input->post('id_slide'));
			$query = $this->db->get('slide');
			$row = $query->row();
			unlink("./assets/slide/$row->gambar");
			$image = $this->upload->data();
			$data = array(
				'gambar' => $image['file_name'],
				'status' => $this->input->post('status'),
			);
			$res = $this->db->update('slide', $data, array('id_slide' => $this->input->post('id_slide')));
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

	public function delete_slide()
	{
		$this->db->where('id_slide', $this->input->post('id_slide'));
		$query = $this->db->get('slide');
		$row = $query->row();
		unlink("./assets/slide/$row->gambar");
		$res = $this->db->delete('slide', array('id_slide' => $this->input->post('id_slide')));
		if ($res>=1) {
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible text-center" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Berhasil</strong> Menghapus Data</div>');
			redirect($this->agent->referrer());
		} else {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible text-center" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Gagal</strong> Menghapus Data</div>');
			redirect($this->agent->referrer());
		}
	}

	public function berita()
	{
		$data = array(
			'title' => 'Berita',
			'halaman' => 'berita',
			'data' => $this->my_model->berita(), 
		);
		$this->load->view('admin/template', $data);
	}

	public function insert_berita()
	{
		$name = 'berita-'.uniqid();
		$config['upload_path'] = './assets/berita/';
		$config['allowed_types'] = 'png|jpg|jpeg';
		$config['file_name'] = $name;

		$this->upload->initialize($config);

		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible text-center" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Gagal</strong> Menyimpan Berita, Format Disarankan png,jpg, jpeg, Silahkan Ulangi Kembali</div>');
			redirect($this->agent->referrer());
		} else {
			$image = $this->upload->data();
			$data = array(
				'judul' => $this->input->post('judul'),
				'deskripsi' => $this->input->post('deskripsi'),
				'ditulis' => $this->session->userdata('nama_admin'),
				'tanggal' => date('d/m/Y h:i:s'),
				'gambar' => $image['file_name'],
			);
			$res = $this->db->insert('berita', $data);
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

	public function update_berita()
	{
		$data = array(
			'judul' => $this->input->post('judul'),
			'deskripsi' => $this->input->post('deskripsi'),
			'ditulis' => $this->session->userdata('nama_admin'),
			'tanggal' => date('d/m/Y h:i:s'),
		);
		$res = $this->db->update('berita', $data, array('id_berita' => $this->input->post('id_berita')));
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

	public function update_gambar_berita()
	{
		$name = 'berita-'.uniqid();
		$config['upload_path'] = './assets/berita/';
		$config['allowed_types'] = 'png|jpg|jpeg';
		$config['file_name'] = $name;

		$this->upload->initialize($config);

		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible text-center" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Gagal</strong> Menyimpan Berita, Format Disarankan png,jpg, jpeg, Silahkan Ulangi Kembali</div>');
			redirect($this->agent->referrer());
		} else {
			$this->db->where('id_berita', $this->input->post('id_berita'));
			$query = $this->db->get('berita');
			$row = $query->row();
			unlink("./assets/berita/$row->gambar");
			$image = $this->upload->data();
			$data = array(
				'gambar' => $image['file_name'],
			);
			$res = $this->db->update('berita', $data, array('id_berita' => $this->input->post('id_berita')));
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

	public function delete_berita()
	{
		$this->db->where('id_berita', $this->input->post('id_berita'));
		$query = $this->db->get('berita');
		$row = $query->row();
		unlink("./assets/berita/$row->gambar");
		$res = $this->db->delete('berita', array('id_berita' => $this->input->post('id_berita')));
		if ($res>=1) {
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible text-center" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Berhasil</strong> Menghapus Data</div>');
			redirect($this->agent->referrer());
		} else {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible text-center" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Gagal</strong> Menghapus Data</div>');
			redirect($this->agent->referrer());
		}
	}

	public function pengumuman()
	{
		$data = array(
			'title' => 'Pengumuman',
			'halaman' => 'pengumuman',
			'data' => $this->my_model->pengumuman(), 
		);
		$this->load->view('admin/template', $data);
	}

	public function insert_pengumuman()
	{
		$name = 'pengumuman-'.uniqid();
		$config['upload_path'] = './assets/pengumuman/';
		$config['allowed_types'] = 'pdf|docx|doc';
		$config['file_name'] = $name;

		$this->upload->initialize($config);

		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible text-center" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Gagal</strong> Menyimpan Pengumuman, Format Disarankan pdf, docx, doc, Silahkan Ulangi Kembali</div>');
			redirect($this->agent->referrer());
		} else {
			$file = $this->upload->data();
			$data = array(
				'judul_pengumuman' => $this->input->post('judul_pengumuman'),
				'tanggal' => date('d/m/Y h:i:s'),
				'file' => $file['file_name'],
			);
			$res = $this->db->insert('pengumuman', $data);
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

	public function update_pengumuman()
	{
		$data = array(
			'judul_pengumuman' => $this->input->post('judul_pengumuman'),
			'tanggal' => date('d/m/Y h:i:s'),
		);
		$res = $this->db->update('pengumuman', $data, array('id_pengumuman' => $this->input->post('id_pengumuman')));
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

	public function update_file_pengumuman()
	{
		$name = 'pengumuman-'.uniqid();
		$config['upload_path'] = './assets/pengumuman/';
		$config['allowed_types'] = 'pdf|docx|doc';
		$config['file_name'] = $name;

		$this->upload->initialize($config);

		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible text-center" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Gagal</strong> Menyimpan Pengumuman, Format Disarankan pdf, docx, doc, Silahkan Ulangi Kembali</div>');
			redirect($this->agent->referrer());
		} else {
			$file = $this->upload->data();
			$this->db->where('id_pengumuman', $this->input->post('id_pengumuman'));
			$query = $this->db->get('pengumuman');
			$row = $query->row();
			unlink("./assets/pengumuman/$row->file");
			$data = array(
				'file' => $file['file_name'],
			);
			$res = $this->db->update('pengumuman', $data, array('id_pengumuman' => $this->input->post('id_pengumuman')));
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

	public function agenda()
	{
		$data = array(
			'title' => 'Agenda',
			'halaman' => 'agenda', 
			'data' => $this->my_model->agenda(),
		);
		$this->load->view('admin/template', $data);
	}

	public function insert_agenda()
	{
		$data = array(
			'agenda' => $this->input->post('agenda'),
			'tanggal' => $this->input->post('tanggal'),
			'status' => $this->input->post('status'),
		);
		$res = $this->db->insert('agenda', $data);
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

	public function update_agenda()
	{
		$data = array(
			'agenda' => $this->input->post('agenda'),
			'tanggal' => $this->input->post('tanggal'),
			'status' => $this->input->post('status'),
		);
		$res = $this->db->update('agenda', $data, array('id_agenda' => $this->input->post('id_agenda')));
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

	public function delete_agenda()
	{
		$res = $this->db->delete('agenda', array('id_agenda' => $this->input->post('id_agenda')));
		if ($res>=1) {
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible text-center" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Berhasil</strong> Menghapus Data</div>');
			redirect($this->agent->referrer());
		} else {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible text-center" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Gagal</strong> Menghapus Data</div>');
			redirect($this->agent->referrer());
		}
	}


	public function galeri()
	{
		$data = array(
			'title' => 'Galeri',
			'halaman' => 'galeri', 
			'data' => $this->my_model->galeri(),
		);
		$this->load->view('admin/template', $data);
	}

	public function insert_galeri()
	{
		$name = 'galeri-'.uniqid();
		$config['upload_path'] = './assets/galeri/';
		$config['allowed_types'] = 'png|jpg|jpeg';
		$config['file_name'] = $name;

		$this->upload->initialize($config);

		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible text-center" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Gagal</strong> Menyimpan Galeri, Format Disarankan png,jpg, jpeg, Silahkan Ulangi Kembali</div>');
			redirect($this->agent->referrer());
		} else {
			$image = $this->upload->data();
			$data = array(
				'judul' => $this->input->post('judul'),
				'tanggal' => date('d/m/Y h:i:s'),
				'gambar' => $image['file_name'],
			);
			$res = $this->db->insert('galeri', $data);
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

	public function update_galeri()
	{
		$data = array(
			'judul' => $this->input->post('judul'),
			'tanggal' => date('d/m/Y h:i:s'),
		);
		$res = $this->db->update('galeri', $data, array('id_galeri' => $this->input->post('id_galeri')));
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

	public function update_gambar_galeri()
	{
		$name = 'galeri-'.uniqid();
		$config['upload_path'] = './assets/galeri/';
		$config['allowed_types'] = 'png|jpg|jpeg';
		$config['file_name'] = $name;

		$this->upload->initialize($config);

		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible text-center" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Gagal</strong> Menyimpan Galeri, Format Disarankan png, jpg, jpeg, Silahkan Ulangi Kembali</div>');
			redirect($this->agent->referrer());
		} else {
			$this->db->where('id_galeri', $this->input->post('id_galeri'));
			$query = $this->db->get('galeri');
			$row = $query->row();
			unlink("./assets/galeri/$row->gambar");
			$image = $this->upload->data();
			$data = array(
				'gambar' => $image['file_name'],
			);
			$res = $this->db->update('galeri', $data, array('id_galeri' => $this->input->post('id_galeri')));
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

	public function delete_galeri()
	{
		$this->db->where('id_galeri', $this->input->post('id_galeri'));
		$query = $this->db->get('galeri');
		$row = $query->row();
		unlink("./assets/galeri/$row->gambar");
		$res = $this->db->delete('galeri', array('id_galeri' => $this->input->post('id_galeri')));
		if ($res>=1) {
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible text-center" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Berhasil</strong> Menghapus Data</div>');
			redirect($this->agent->referrer());
		} else {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible text-center" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Gagal</strong> Menghapus Data</div>');
			redirect($this->agent->referrer());
		}
	}

	public function download()
	{
		$data = array(
			'title' => 'Download',
			'halaman' => 'download', 
			'data' => $this->my_model->download(),
		);
		$this->load->view('admin/template', $data);
	}

	public function insert_download()
	{
		$name = 'slide-'.uniqid();
		$config['upload_path'] = './assets/download/';
		$config['allowed_types'] = 'pdf|docx|doc';
		$config['file_name'] = $name;

		$this->upload->initialize($config);

		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible text-center" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Gagal</strong> Menyimpan Slide, Format Disarankan pdf, docx, doc, Silahkan Ulangi Kembali</div>');
			redirect($this->agent->referrer());
		} else {
			$image = $this->upload->data();
			$data = array(
				'nama' => $this->input->post('nama'),
				'download' => $image['file_name'],
				'status' => $this->input->post('status'),
			);
			$res = $this->db->insert('download', $data);
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

	public function update_download()
	{
		$data = array(
			'nama' => $this->input->post('nama'),
			'status' => $this->input->post('status'),
		);
		$res = $this->db->update('download', $data, array('id_download' => $this->input->post('id_download')));
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

	public function update_file_download()
	{
		$name = 'download-'.uniqid();
		$config['upload_path'] = './assets/slide/';
		$config['allowed_types'] = 'pdf|docx|doc';
		$config['file_name'] = $name;

		$this->upload->initialize($config);

		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible text-center" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Gagal</strong> Menyimpan Slide, Format Disarankan pdf, docx, doc, Silahkan Ulangi Kembali</div>');
			redirect($this->agent->referrer());
		} else {
			$this->db->where('id_download', $this->input->post('id_download'));
			$query = $this->db->get('download');
			$row = $query->row();
			unlink("./assets/slide/$row->download");
			$image = $this->upload->data();
			$data = array(
				'download' => $image['file_name'],
			);
			$res = $this->db->update('download', $data, array('id_download' => $this->input->post('id_download')));
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

	public function delete_download()
	{
		$this->db->where('id_download', $this->input->post('id_download'));
		$query = $this->db->get('download');
		$row = $query->row();
		unlink("./assets/download/$row->download");
		$res = $this->db->delete('download', array('id_download' => $this->input->post('id_download')));
		if ($res>=1) {
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible text-center" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Berhasil</strong> Menghapus Data</div>');
			redirect($this->agent->referrer());
		} else {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible text-center" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Gagal</strong> Menghapus Data</div>');
			redirect($this->agent->referrer());
		}
	}

	public function saran()
	{
		$data = array(
			'title' => 'Saran',
			'halaman' => 'saran', 
			'data' => $this->my_model->saran(),
		);
		$this->load->view('admin/template', $data);
	}

	public function delete_saran()
	{
		$res = $this->db->delete('saran', array('id_saran' => $this->input->post('id_saran')));
		if ($res>=1) {
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible text-center" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Berhasil</strong> Menghapus Data</div>');
			redirect($this->agent->referrer());
		} else {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible text-center" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Gagal</strong> Menghapus Data</div>');
			redirect($this->agent->referrer());
		}
	}

	public function siswa()
	{
		$data = array(
			'title' => 'Siswa',
			'halaman' => 'siswa', 
			'data' => $this->my_model->siswa(),
		);
		$this->load->view('admin/template', $data);
	}

	public function nilai($id_siswa)
	{
		$data = array(
			'title' => 'Nilai',
			'halaman' => 'nilai',
			'id_unggulan' => $id_siswa, 
			'data' => $this->my_model->nilai_siswa($id_siswa),
		);
		$this->load->view('admin/template', $data);
	}

	public function update_nilai()
	{
		$data = array(
			'nilai_raport' => $this->input->post('nilai_raport'),
			'nilai_raportun' => $this->input->post('nilai_raportun'),
			'kehadiran' => $this->input->post('kehadiran'),
			'nilai_wawancara' => $this->input->post('nilai_wawancara'),
			'nilai_psikotest' => $this->input->post('nilai_psikotest'),
		);
		$res = $this->db->update('nilai', $data, array('id_nilai' => $this->input->post('id_nilai')));
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

	public function unggulan()
	{
		$data = array(
			'title' => 'Unggulan',
			'halaman' => 'unggulan', 
			'data' => $this->my_model->unggulan(),
		);
		$this->load->view('admin/template', $data);
	}

	public function insert_unggulan()
	{
		$data = array(
			'nama_unggulan' => $this->input->post('nama_unggulan'),
			'kuota_unggulan' => $this->input->post('kuota_unggulan'),
			'status_unggulan' => $this->input->post('status_unggulan'),
		);
		$res = $this->db->insert('unggulan', $data);
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

	public function update_unggulan()
	{
		$data = array(
			'nama_unggulan' => $this->input->post('nama_unggulan'),
			'kuota_unggulan' => $this->input->post('kuota_unggulan'),
			'status_unggulan' => $this->input->post('status_unggulan'),
		);
		$res = $this->db->update('unggulan', $data, array('id_unggulan' => $this->input->post('id_unggulan')));
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

	public function delete_unggulan()
	{
		$res = $this->db->delete('unggulan', array('id_unggulan' => $this->input->post('id_unggulan')));
		if ($res>=1) {
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible text-center" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Berhasil</strong> Menghapus Data</div>');
			redirect($this->agent->referrer());
		} else {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible text-center" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Gagal</strong> Menghapus Data</div>');
			redirect($this->agent->referrer());
		}
	}

	public function kriteria($id_unggulan)
	{
		$data = array(
			'title' => 'Kriteria',
			'halaman' => 'kriteria',
			'id_unggulan' => $id_unggulan, 
			'data' => $this->my_model->kriteria($id_unggulan),
		);
		$this->load->view('admin/template', $data);
	}

	public function insert_kriteria()
	{
		$data = array(
			'id_unggulan' => $this->input->post('id_unggulan'),
			'nama_kriteria' => $this->input->post('nama_kriteria'),
			'bobot' => $this->input->post('bobot'),
		);
		$res = $this->db->insert('kriteria', $data);
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

	public function update_kriteria()
	{
		$data = array(
			'nama_kriteria' => $this->input->post('nama_kriteria'),
			'bobot' => $this->input->post('bobot'),
		);
		$res = $this->db->update('kriteria', $data, array('id_kriteria' => $this->input->post('id_kriteria')));
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

	public function delete_kriteria()
	{
		$res = $this->db->delete('kriteria', array('id_kriteria' => $this->input->post('id_kriteria')));
		if ($res>=1) {
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible text-center" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Berhasil</strong> Menghapus Data</div>');
			redirect($this->agent->referrer());
		} else {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible text-center" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Gagal</strong> Menghapus Data</div>');
			redirect($this->agent->referrer());
		}
	}

	public function insert_siswa()
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

	public function update_siswa()
	{
		if ($this->input->post('password')!='') {
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
		} else {
			$data = array(
				'nama_siswa' => $this->input->post('nama_siswa'),
				'jenis_kelamin' => $this->input->post('jenis_kelamin'),
				'tempat_lahir' => $this->input->post('tempat_lahir'),
				'tanggal_lahir' => $this->input->post('tanggal_lahir'),
				'no_hp' => $this->input->post('no_hp'),
				'alamat' => $this->input->post('alamat'),
				'email' => $this->input->post('email'),
				'username' => $this->input->post('username'),
			);
		}
		$res = $this->db->update('siswa', $data, array('id_siswa' => $this->input->post('id_siswa')));
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

	public function delete_siswa()
	{
		$res = $this->db->delete('siswa', array('id_siswa' => $this->input->post('id_siswa')));
		if ($res>=1) {
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible text-center" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Berhasil</strong> Menghapus Data</div>');
			redirect($this->agent->referrer());
		} else {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible text-center" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Gagal</strong> Menghapus Data</div>');
			redirect($this->agent->referrer());
		}
	}

	public function soal()
	{
		$data = array(
			'title' => 'Soal',
			'halaman' => 'soal', 
			'unggulan' => $this->my_model->unggulan(),
			'data' => $this->my_model->soal(),
		);
		$this->load->view('admin/template', $data);
	}

	public function insert_soal()
	{
		$data = array(
			'soal' => $this->input->post('soal'),
			'pilihan_a' => $this->input->post('pilihan_a'),
			'pilihan_b' => $this->input->post('pilihan_b'),
			'pilihan_c' => $this->input->post('pilihan_c'),
			'pilihan_d' => $this->input->post('pilihan_d'),
			'nilai_a' => $this->input->post('nilai_a'),
			'nilai_b' => $this->input->post('nilai_b'),
			'nilai_c' => $this->input->post('nilai_c'),
			'nilai_d' => $this->input->post('nilai_d'),
			'id_unggulan' => $this->input->post('id_unggulan'),
		);
		$res = $this->db->insert('soal', $data);
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

	public function update_soal()
	{
		$data = array(
			'soal' => $this->input->post('soal'),
			'pilihan_a' => $this->input->post('pilihan_a'),
			'pilihan_b' => $this->input->post('pilihan_b'),
			'pilihan_c' => $this->input->post('pilihan_c'),
			'pilihan_d' => $this->input->post('pilihan_d'),
			'nilai_a' => $this->input->post('nilai_a'),
			'nilai_b' => $this->input->post('nilai_b'),
			'nilai_c' => $this->input->post('nilai_c'),
			'nilai_d' => $this->input->post('nilai_d'),
			'id_unggulan' => $this->input->post('id_unggulan'),
		);
		$res = $this->db->update('soal', $data, array('id_soal' => $this->input->post('id_soal')));
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

	public function delete_soal()
	{
		$res = $this->db->delete('soal', array('id_soal' => $this->input->post('id_soal')));
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

	public function perhitungan()
	{
		if ($this->input->get('id_siswa')) {
			$user = $this->input->get('id_siswa');
			$result = array();
			foreach($user AS $key => $val) {
				$nilai_raport = $this->db->get_where('kriteria', array(
					'id_unggulan' => 1,
					'nama_kriteria' => 'Nilai Raport',
				));
				$nilai_raportun = $this->db->get_where('kriteria', array(
					'id_unggulan' => 1,
					'nama_kriteria' => 'Nilai Raport UN',
				));
				$nilai_wawancara = $this->db->get_where('kriteria', array(
					'id_unggulan' => 1,
					'nama_kriteria' => 'Kehadiran',
				));
				$kehadiran = $this->db->get_where('kriteria', array(
					'id_unggulan' => 1,
					'nama_kriteria' => 'Nilai Wawancara',
				));
				$ujian_psikotest = $this->db->get_where('kriteria', array(
					'id_unggulan' => 1,
					'nama_kriteria' => 'Nilai Psikotest',
				));
				// menentukan bobot bhs untuk unggulan bhs
				foreach ($nilai_raport->result() as $row) {
					$a1 = $row->bobot;
					$this->db->select('SUM(bobot) as total');
					$this->db->from('kriteria');
					$this->db->where('id_unggulan', $row->id_unggulan);
					$b1 = $a1 / $this->db->get()->row()->total; 
				}
				foreach ($nilai_raportun->result() as $row) {
					$a2 = $row->bobot;
					$this->db->select('SUM(bobot) as total');
					$this->db->from('kriteria');
					$this->db->where('id_unggulan', $row->id_unggulan);
					$b2 = $a2 / $this->db->get()->row()->total;
				}
				foreach ($nilai_wawancara->result() as $row) {
					$a3 = $row->bobot;
					$this->db->select('SUM(bobot) as total');
					$this->db->from('kriteria');
					$this->db->where('id_unggulan', $row->id_unggulan);
					$b3 = $a3 / $this->db->get()->row()->total;
				}
				foreach ($kehadiran->result() as $row) {
					$a4 = $row->bobot;
					$this->db->select('SUM(bobot) as total');
					$this->db->from('kriteria');
					$this->db->where('id_unggulan', $row->id_unggulan);
					$b4 = $a4 / $this->db->get()->row()->total;
				}
				foreach ($ujian_psikotest->result() as $row) {
					$a5 = $row->bobot;
					$this->db->select('SUM(bobot) as total');
					$this->db->from('kriteria');
					$this->db->where('id_unggulan', $row->id_unggulan);
					$b5 = $a5 / $this->db->get()->row()->total;
				}
			}
			// foreach($user AS $key => $val) {
			// 	$bahasa_indonesia = $this->db->get_where('kriteria', array(
			// 		'id_unggulan' => 2,
			// 		'nama_kriteria' => 'Bahasa Indonesia',
			// 	));
			// 	$matematika = $this->db->get_where('kriteria', array(
			// 		'id_unggulan' => 2,
			// 		'nama_kriteria' => 'Matematika',
			// 	));
			// 	$ipa = $this->db->get_where('kriteria', array(
			// 		'id_unggulan' => 2,
			// 		'nama_kriteria' => 'IPA',
			// 	));
			// 	$bahasa_inggris = $this->db->get_where('kriteria', array(
			// 		'id_unggulan' => 2,
			// 		'nama_kriteria' => 'Bahasa Inggris',
			// 	));
			// 	$ujian_peminatan = $this->db->get_where('kriteria', array(
			// 		'id_unggulan' => 2,
			// 		'nama_kriteria' => 'Ujian Peminatan',
			// 	));
			// 	foreach ($bahasa_indonesia->result() as $row) {
			// 		$aa1 = $row->bobot;
			// 		$this->db->select('SUM(bobot) as total');
			// 		$this->db->from('kriteria');
			// 		$this->db->where('id_unggulan', $row->id_unggulan);
			// 		$bb1 = $aa1 / $this->db->get()->row()->total;
			// 	}
			// 	foreach ($matematika->result() as $row) {
			// 		$aa2 = $row->bobot;
			// 		$this->db->select('SUM(bobot) as total');
			// 		$this->db->from('kriteria');
			// 		$this->db->where('id_unggulan', $row->id_unggulan);
			// 		$bb2 = $aa2 / $this->db->get()->row()->total;
			// 	}
			// 	foreach ($ipa->result() as $row) {
			// 		$aa3 = $row->bobot;
			// 		$this->db->select('SUM(bobot) as total');
			// 		$this->db->from('kriteria');
			// 		$this->db->where('id_unggulan', $row->id_unggulan);
			// 		$bb3 = $aa3 / $this->db->get()->row()->total;
			// 	}
			// 	foreach ($bahasa_inggris->result() as $row) {
			// 		$aa4 = $row->bobot;
			// 		$this->db->select('SUM(bobot) as total');
			// 		$this->db->from('kriteria');
			// 		$this->db->where('id_unggulan', $row->id_unggulan);
			// 		$bb4 = $aa4 / $this->db->get()->row()->total;
			// 	}
			// 	foreach ($ujian_peminatan->result() as $row) {
			// 		$aa5 = $row->bobot;
			// 		$this->db->select('SUM(bobot) as total');
			// 		$this->db->from('kriteria');
			// 		$this->db->where('id_unggulan', $row->id_unggulan);
			// 		$bb5 = $aa5 / $this->db->get()->row()->total;
			// 	}
			// }
			// foreach($user AS $key => $val) {
			// 	$bahasa_indonesia = $this->db->get_where('kriteria', array(
			// 		'id_unggulan' => 3,
			// 		'nama_kriteria' => 'Bahasa Indonesia',
			// 	));
			// 	$matematika = $this->db->get_where('kriteria', array(
			// 		'id_unggulan' => 3,
			// 		'nama_kriteria' => 'Matematika',
			// 	));
			// 	$ipa = $this->db->get_where('kriteria', array(
			// 		'id_unggulan' => 3,
			// 		'nama_kriteria' => 'IPA',
			// 	));
			// 	$bahasa_inggris = $this->db->get_where('kriteria', array(
			// 		'id_unggulan' => 3,
			// 		'nama_kriteria' => 'Bahasa Inggris',
			// 	));
			// 	$ujian_peminatan = $this->db->get_where('kriteria', array(
			// 		'id_unggulan' => 3,
			// 		'nama_kriteria' => 'Ujian Peminatan',
			// 	));
			// 	foreach ($bahasa_indonesia->result() as $row) {
			// 		$aaa1 = $row->bobot;
			// 		$this->db->select('SUM(bobot) as total');
			// 		$this->db->from('kriteria');
			// 		$this->db->where('id_unggulan', $row->id_unggulan);
			// 		$bbb1 = $aaa1 / $this->db->get()->row()->total;
			// 	}
			// 	foreach ($matematika->result() as $row) {
			// 		$aaa2 = $row->bobot;
			// 		$this->db->select('SUM(bobot) as total');
			// 		$this->db->from('kriteria');
			// 		$this->db->where('id_unggulan', $row->id_unggulan);
			// 		$bbb2 = $aaa2 / $this->db->get()->row()->total;
			// 	}
			// 	foreach ($ipa->result() as $row) {
			// 		$aaa3 = $row->bobot;
			// 		$this->db->select('SUM(bobot) as total');
			// 		$this->db->from('kriteria');
			// 		$this->db->where('id_unggulan', $row->id_unggulan);
			// 		$bbb3 = $aaa3 / $this->db->get()->row()->total;
			// 	}
			// 	foreach ($bahasa_inggris->result() as $row) {
			// 		$aaa4 = $row->bobot;
			// 		$this->db->select('SUM(bobot) as total');
			// 		$this->db->from('kriteria');
			// 		$this->db->where('id_unggulan', $row->id_unggulan);
			// 		$bbb4 = $aaa4 / $this->db->get()->row()->total;
			// 	}
			// 	foreach ($ujian_peminatan->result() as $row) {
			// 		$aaa5 = $row->bobot;
			// 		$this->db->select('SUM(bobot) as total');
			// 		$this->db->from('kriteria');
			// 		$this->db->where('id_unggulan', $row->id_unggulan);
			// 		$bbb5 = $aaa5 / $this->db->get()->row()->total;
			// 	}
			// }
			$this->db->select('*');
			$this->db->from('nilai');
			$this->db->join('siswa','siswa.id_siswa = nilai.id_siswa','left');
			$this->db->order_by('siswa.id_siswa','desc');
			$this->db->where('nilai.nilai_psikotest !=','');
			$xyz = $this->db->get();
			foreach ($xyz->result() as $abc) {
				$data1 = array(
					'id_siswa' => $abc->id_siswa, 
					'vektor_s' => pow($abc->nilai_raport, $b1)*pow($abc->nilai_raportun, $b2)*pow($abc->kehadiran, $b3)*pow($abc->nilai_wawancara, $b4)*pow($abc->nilai_psikotest, $b5),
					// 'vektor_s_ipa' => pow($abc->nilai_bahasa_indonesia, $bb1)*pow($abc->nilai_matematika, $bb2)*pow($abc->nilai_ipa, $bb3)*pow($abc->nilai_bahasa_inggris, $bb4)*pow($abc->nilai_peminatan, $bb5),
					// 'vektor_s_ips' => pow($abc->nilai_bahasa_indonesia, $bbb1)*pow($abc->nilai_matematika, $bbb2)*pow($abc->nilai_ipa, $bbb3)*pow($abc->nilai_bahasa_inggris, $bbb4)*pow($abc->nilai_peminatan, $bbb5),
				);
				$cek = $this->db->get_where('hasil_seleksi', array('id_siswa' => $abc->id_siswa));
				if ($cek->num_rows()==0) {
					$this->db->insert('hasil_seleksi', $data1);
				}
			}
		}
		if ($this->input->get('id_siswa')) {
		$this->db->select('*');
		$this->db->from('nilai');
		$this->db->join('siswa','siswa.id_siswa = nilai.id_siswa','left');
		$this->db->order_by('siswa.id_siswa','desc');
		$this->db->where('nilai.nilai_psikotest !=','');
		$xyz = $this->db->get();
		foreach ($xyz->result() as $abc) {
			$cek = $this->db->get_where('hasil_seleksi', array('id_siswa' => $abc->id_siswa));
			if ($cek->num_rows() > 0) {
				$this->db->select('vektor_s as total_vs');
				$this->db->where('id_siswa', $abc->id_siswa);
				$this->db->from('hasil_seleksi');
				$a = $this->db->get()->row()->total_vs;

				 $this->db->select('SUM(vektor_s) as total_vs');
				 $this->db->from('hasil_seleksi');
				 $b = $this->db->get()->row()->total_vs;

				// $this->db->select('SUM(vektor_s_ipa) as total_vs_ipa');
				// $this->db->where('id_siswa', $abc->id_siswa);
				// $this->db->from('hasil_seleksi');
				// $b = $this->db->get()->row()->total_vs_ipa;

				// $this->db->select('SUM(vektor_s_ips) as total_vs_ips');
				// $this->db->where('id_siswa', $abc->id_siswa);
				// $this->db->from('hasil_seleksi');
				// $c = $this->db->get()->row()->total_vs_ips;
				// $d = $a+$b+$c;
				foreach ($cek->result() as $value) {
					$bhs = $value->vektor_s / $b;
					// $ipa = $value->vektor_s_ipa / $d;
					// $ips = $value->vektor_s_ips / $d;
					$data2 = array(
						'vektor_v' => $bhs, 
						// 'vektor_v_ipa' => $ipa,
						// 'vektor_v_ips' => $ips,
					);
					$this->db->update('hasil_seleksi', $data2, array('id_siswa' => $abc->id_siswa));
					

				 $this->db->select('count(id_siswa) as total');
				 $this->db->from('hasil_seleksi');
				 $c = $this->db->get()->row()->total;

				 $this->db->select('sum(vektor_v) as total');
				 $this->db->from('hasil_seleksi');
				 $d = $this->db->get()->row()->total;

				 $rata = $d/$c;
				 $ratamasing = $bhs;
				
	
				 foreach ($cek->result() as $value) {
					$ku = $ratamasing;
					if ($ratamasing < $rata) {
				 	$data3 = ('Masuk Kelas Biasa');
				  } elseif ($ratamasing > $rata) {
				  	$data3 = ('Masuk Kelas Unggulan');
				  };

					 $data3 = array(
						'status' => $data3);
					}

					// if ($bhs > $ipa || $bhs > $ipa) {
					// 	$data3 = array(
					// 		'id_unggulan' => 1, 
					// 	);
					// } elseif ($ipa > $bhs || $ipa > $ips) {
					// 	$data3 = array(
					// 		'id_unggulan' => 2, 
					// 	);
					// } elseif ($ips > $bhs || $ips > $ipa) {
					// 	$data3 = array(
					// 		'id_unggulan' => 3, 
					// 	);
					// }
					$this->db->update('hasil_seleksi', $data3, array('id_siswa' => $abc->id_siswa));
				}
			}
		}
		}
		$data = array(
			'title' => 'Perhitungan',
			'halaman' => 'perhitungan', 
			'siswa' => $this->my_model->get_siswa(),
			'unggulan' => $this->my_model->unggulan(),
			'get_unggulan' => $this->my_model->get_unggulan(),
			'hasil_seleksi' => $this->my_model->hasil_seleksi(),
			'hasil_seleksi_unggulan_ku' => $this->my_model->hasil_seleksi_unggulan_ku(),
			// 'hasil_seleksi_unggulan_ipa' => $this->my_model->hasil_seleksi_unggulan_ipa(),
			// 'hasil_seleksi_unggulan_ips' => $this->my_model->hasil_seleksi_unggulan_ips(),
			'hasil_seleksi_final_ku' => $this->my_model->hasil_seleksi_final_ku(),
			// 'hasil_seleksi_final_ipa' => $this->my_model->hasil_seleksi_final_ipa(),
			// 'hasil_seleksi_final_ips' => $this->my_model->hasil_seleksi_final_ips(),
		);
		$this->load->view('admin/template', $data);
	}

	public function umumkan()
	{
		// $query_ipa = $this->db->get_where('unggulan', array('id_unggulan' => 2));
		// foreach ($query_ipa->result() as $key) {
		// 	$this->db->limit($key->kuota_unggulan);
		// 	$this->db->order_by('vektor_v_ipa','desc');
		// 	$ipa = $this->db->get('hasil_seleksi');
		// 	foreach ($ipa->result() as $value) {
		// 		$data = array(
		// 			'id_unggulan' => $key->id_unggulan,
		// 			'umumkan' => 1,
		// 		);
		// 		$res = $this->db->update('hasil_seleksi', $data, array('id_siswa' => $value->id_siswa));
		// 		$query_bhs = $this->db->get_where('unggulan', array('id_unggulan' => 3));
		// 		foreach ($query_bhs->result() as $key2) {
		// 			$this->db->limit($key2->kuota_unggulan);
		// 			$this->db->order_by('vektor_v_ips','desc');
		// 			$this->db->where('id_siswa !=',$value->id_siswa);
		// 			$bhs = $this->db->get('hasil_seleksi');
		// 			foreach ($bhs->result() as $value2) {
		// 				$data2 = array(
		// 					'id_unggulan' => $key2->id_unggulan,
		// 					'umumkan' => 1,
		// 				);
		// 				$res = $this->db->update('hasil_seleksi', $data2, array('id_siswa' => $value2->id_siswa));
		// 			}
		// 		}
		// 	}
		// }
		$data = array(
			'umumkan' => 1,
		);
		$res = $this->db->update('hasil_seleksi', $data, array('umumkan' => 0));
		if ($res>=1) {
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible text-center" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Berhasil</strong> Menyimpan Data</div>');
			// $data3 = array(
			// 	'id_unggulan' => 1,
			// 	'umumkan' => 1,
			// );
			// $res = $this->db->update('hasil_seleksi', $data3, array('id_unggulan' => 0));
			redirect($this->agent->referrer());
		} else {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible text-center" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Gagal</strong> Menyimpan Data</div>');
			redirect($this->agent->referrer());
		}
	}

	public function cetak()
	{
		$data = array(
			'title' => 'Cetal Hasil Seleksi',
			'halaman' => 'cetak', 
			'data' => $this->my_model->hasil_seleksi(),
		);
		$this->load->view('admin/cetak', $data);
	}

	public function batal()
	{
		$data = array(
			'umumkan' => 0,
		);
		$res = $this->db->update('hasil_seleksi', $data, array('umumkan' => 1));
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

	public function user_admin()
	{
		$data = array(
			'title' => 'User',
			'halaman' => 'user_admin', 
			'data' => $this->my_model->user_admin(),
		);
		$this->load->view('admin/template', $data);
	}

	public function insert_admin()
	{
		$data = array(
			'nama_admin' => $this->input->post('nama_admin'),
			'username' => $this->input->post('username'),
			'password' => md5($this->input->post('password')),
		);
		$res = $this->db->insert('admin', $data);
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

	public function update_admin()
	{
		if ($this->input->post('password')!='') {
			$data = array(
				'nama_admin' => $this->input->post('nama_admin'),
				'username' => $this->input->post('username'),
				'password' => md5($this->input->post('password')),
			);
		} else {
			$data = array(
				'nama_admin' => $this->input->post('nama_admin'),
				'username' => $this->input->post('username'),
			);
		}
		$res = $this->db->update('admin', $data, array('id_admin' => $this->input->post('id_admin')));
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

	public function delete_admin()
	{
		$res = $this->db->delete('admin', array('id_admin' => $this->input->post('id_admin')));
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