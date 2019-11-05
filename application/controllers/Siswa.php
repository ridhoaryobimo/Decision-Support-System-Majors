<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('id_siswa')) {
			redirect('/');
		}
	}

	public function index()
	{
		$data = array(
			'title' => 'Dashboard',
			'halaman' => 'dashboard', 
			'data' => $this->my_model->nilai(),
		);
		$this->load->view('siswa/template', $data);
	}

	public function profil()
	{
		$data = array(
			'title' => 'Profil',
			'halaman' => 'profil',
			'data' => $this->my_model->profil(),
		);
		$this->load->view('siswa/template', $data);
	}

	public function update_profil()
	{
		$data = array(
			'nama_siswa' => $this->input->post('nama_siswa'),
			'jenis_kelamin' => $this->input->post('jenis_kelamin'),
			'tempat_lahir' => $this->input->post('tempat_lahir'),
			'tanggal_lahir' => $this->input->post('tanggal_lahir'),
			'no_hp' => $this->input->post('no_hp'),
			'alamat' => $this->input->post('alamat'),
		);
		$res = $this->db->update('siswa', $data, array('id_siswa' => $this->session->userdata('id_siswa')));
		if ($res>=1) {
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible text-center" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Berhasil</strong> Menyimpan Data</div>');
			redirect('siswa/profil');
		} else {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible text-center" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Gagal</strong> Menyimpan Data</div>');
			redirect('siswa/profil');
		}
	}

	public function update_akun()
	{
		if ($this->input->post('password')!='') {
			$data = array(
				'email' => $this->input->post('email'),
				'username' => $this->input->post('username'),
				'password' => md5($this->input->post('password')),
			);
		} else {
			$data = array(
				'email' => $this->input->post('email'),
				'username' => $this->input->post('username'),
			);
		}
		$res = $this->db->update('siswa', $data, array('id_siswa' => $this->session->userdata('id_siswa')));
		if ($res>=1) {
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible text-center" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Berhasil</strong> Menyimpan Data</div>');
			redirect('siswa/profil');
		} else {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible text-center" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Gagal</strong> Menyimpan Data</div>');
			redirect('siswa/profil');
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
			$this->db->where('id_siswa', $this->session->userdata('id_siswa'));
			$query = $this->db->get('siswa');
			$row = $query->row();
			unlink("./assets/img/$row->foto");
			$image = $this->upload->data();
			$data = array(
				'foto' => $image['file_name'],
			);
			$res = $this->db->update('siswa', $data, array('id_siswa' => $this->session->userdata('id_siswa')));
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

	public function nilai_ujian_nasional()
	{
		$data = array(
			'title' => 'Nilai Ujian Nasional',
			'halaman' => 'nilai_ujian_nasional', 
			'data' => $this->my_model->nilai(),
		);
		$this->load->view('siswa/template', $data);
	}

	public function insert_nilai()
	{
		$name = 'Bukti-'.uniqid();
		$config['upload_path'] = './assets/file/';
		$config['allowed_types'] = 'pdf|docx|doc';
		$config['file_name'] = $name;

		$this->upload->initialize($config);

		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible text-center" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Gagal</strong> Uplod File, Format Disarankan pdf, docx, doc, Silahkan Ulangi Kembali</div>');
			redirect($this->agent->referrer());
		} else {
			$file = $this->upload->data();
			$data = array(
				'id_siswa' => $this->session->userdata('id_siswa'),
				'nilai_raport' => $this->input->post('nilai_raport'),
				'nilai_raportun' => $this->input->post('nilai_raportun'),
				'nilai_wawancara' => $this->input->post('nilai_wawancara'),
				'kehadiran' => $this->input->post('kehadiran'),
				'bukti' => $file['file_name'],
			);
			$res = $this->db->insert('nilai', $data);
			if ($res>=1) {
				$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible text-center" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Berhasil</strong> Menyimpan Data</div>');
				redirect('siswa');
			} else {
				$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible text-center" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Gagal</strong> Menyimpan Data</div>');
				redirect($this->agent->referrer());
			}
		}
	}

	public function ujian_peminatan()
	{
		$cek = $this->db->get_where('siswa', array(
			'id_siswa' => $this->session->userdata('id_siswa'),
		));
		foreach ($cek->result() as $key) {
			if ($key->ujian_unggulan==0) {
				$data = array(
					'title' => 'Ujian Peminatan',
					'halaman' => 'ujian_peminatan', 
					'data'  => $this->my_model->unggulan(),
				);
				$this->load->view('siswa/template', $data);
			} else {
				redirect('siswa/mulai-ujian');
			}
		}
	}

	public function mulai_ujian()
	{
		// $cek = $this->db->get_where('siswa', array(
		// 	'id_siswa' => $this->session->userdata('id_siswa'),
		// ));
		// foreach ($cek->result() as $key) {
		// 	if ($key->ujian_unggulan==0) {
		// 		$data1 = array(
		// 			'ujian_unggulan' => $this->input->post('unggulan'), 
		// 		);
		// 		$this->db->update('siswa', $data1, array('id_siswa' => $this->session->userdata('id_siswa')));
		// 	}
		// }
		$ujian = $this->db->get_where('ujian', array(
			'id_siswa' => $this->session->userdata('id_siswa'),
		));	
		if ($ujian->num_rows()==0) {
			$soal = $this->db->get('soal');
			foreach ($soal->result() as $value) {
				$data = array(
					'id_soal' => $value->id_soal, 
					'id_siswa' => $this->session->userdata('id_siswa'),
				);
				$this->db->insert('ujian', $data);
			}
		}
		$data = array(
			'title' => 'Ujian Peminatan',
			'halaman' => 'mulai_ujian', 
			'nav' => $this->my_model->nav_soal(),
			'profil' => $this->my_model->profil(),
			'data' => $this->my_model->get_soal(),
		);
		$this->load->view('siswa/template', $data);
	}

	public function insert_pilihan()
	{
		$data = array(
			'point'  => $this->input->post('pilihan'),
		);
		$res = $this->db->update('ujian', $data, array(
			'id_siswa' => $this->session->userdata('id_siswa'), 
			'id_soal' => $this->input->post('id_soal'),
		));
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

	public function selesai_ujian()
	{
		$this->db->select('SUM(point) as total');
		$this->db->from('ujian');
		$this->db->where('id_siswa',$this->session->userdata('id_siswa'));
		$nilai_psikotest = $this->db->get()->row()->total;
		$data1 = array(
			'selesai_ujian'  => 1,
		);
		$res = $this->db->update('siswa', $data1, array('id_siswa' => $this->session->userdata('id_siswa')));
		$data2 = array(
			'nilai_psikotest'  => $nilai_psikotest,
		);
		$res = $this->db->update('nilai', $data2, array('id_siswa' => $this->session->userdata('id_siswa')));
		if ($res>=1) {
			redirect($this->agent->referrer());
		} else {
			redirect($this->agent->referrer());
		}
	}


	public function pengumuman()
	{
		$data = array(
			'title' => 'Pengumuman',
			'halaman' => 'pengumuman',
			'unggulan' => $this->my_model->unggulan(),
			'data' => $this->my_model->hasil_seleksi_siswa(),
		);
		$this->load->view('siswa/template', $data);
	}
}