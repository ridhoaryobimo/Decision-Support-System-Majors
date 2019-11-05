<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('id_user')) {
			redirect('auth');
		}
		date_default_timezone_set("Asia/Jakarta");
		$this->form_validation->set_message('matches', '<small style="color: red">Password Tidak Sama</small>');
		$this->form_validation->set_message('required', '<small style="color: red">Tidak Boleh Kosong</small>');
		$this->form_validation->set_message('is_unique', '<small style="color: red">Sudah Terpakai</small>');
	}

	public function index()
	{
		if ($this->session->userdata('id_tipe')==1 || $this->session->userdata('id_tipe')==5) {
			$page = 'dashboard_adm';
		} elseif ($this->session->userdata('id_tipe')==2) {
			$page = 'dashboard_ins';
		} else {
			$page = 'dashboard_personil';
			$model = $this->my_model->set_aktifitas_ujian();
			$selesai = $this->my_model->selesai_ujian();
		}
		if ($this->session->userdata('id_tipe')==4) {
			$data = array(
				'title' => 'Dashboard', 
				'page' => $page,
				'selesai' => $selesai,
				'data' => $model,
			);
		} else {
			$data = array(
				'title' => 'Dashboard', 
				'page' => $page,
			);
		}
		$this->load->view('template', $data);
	}

	// Ujian
	public function ujian()
	{
		$data = array(
			'title' => 'Ujian', 
			'page' => 'ujian',
			'ujian' => $this->my_model->set_aktifitas_ujian(),
			'nav' => $this->my_model->soal_ujian(),
			'terjawab' => $this->my_model->soal_terjawab(),
			'selesai' => $this->my_model->selesai_ujian(),
			'data' => $this->my_model->get_soal_ujian(),
		);
		$this->load->view('template', $data);
	}

	public function ujian_ulang()
	{
		$data = array(
			'title' => 'Ujian Ulang', 
			'page' => 'ujian_ulang',
			'ujian' => $this->my_model->set_aktifitas_ujian(),
			'nav' => $this->my_model->soal_ujian_ulang(),
			'terjawab' => $this->my_model->soal_ujian_ulang_terjawab(),
			'selesai' => $this->my_model->selesai_ujian(),
			'data' => $this->my_model->get_soal_ujian_ulang(),
		);
		$this->load->view('template', $data);
	}

	public function peserta_ujian()
	{
		$data = array(
			'title' => 'Peserta Ujian', 
			'page' => 'peserta_ujian',
			'aktifitas' => $this->my_model->aktifitas_ujian(),
			'data' => $this->my_model->peserta_ujian(),
		);
		$this->load->view('template', $data);
	}

	public function detail_peserta_ujian($id)
	{
		$data = array(
			'title' => 'Detail Peserta Ujian', 
			'page' => 'detail_peserta_ujian',
			'id' => $id,
			'sk' => $this->my_model->sertifikat_kompetensi($id),
			'medex' => $this->my_model->medex($id),
			'icao' => $this->my_model->icao($id),
			'pembayaran' => $this->my_model->pembayaran($id),
			'data' => $this->my_model->detail_peserta_ujian($id),
		);
		$this->load->view('template', $data);
	}

	public function approve_peserta()
	{
		$data = array(
			'step' => 3, 
		);
		$res = $this->db->update('m_user', $data, array('id_user' => $this->input->post('id_user')));
		if ($res>=1) {
			$this->session->set_flashdata('pesan',
				'<div class="alert alert-success text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Berhasil Approve Peserta</div>'
			);
			redirect('peserta/ujian');
		} else {
			$this->session->set_flashdata('pesan',
				'<div class="alert alert-danger text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Gagal Approve Peserta</div>'
			);
			redirect($this->agent->referrer());
		}
	}

	public function reject_peserta()
	{
		$data = array(
			'step' => 2,
			'catatan' =>  $this->input->post('catatan'),
		);
		$res = $this->db->update('m_user', $data, array('id_user' => $this->input->post('id_user')));
		if ($res>=1) {
			$this->session->set_flashdata('pesan',
				'<div class="alert alert-success text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Berhasil Reject Peserta</div>'
			);
			redirect('peserta/ujian');
		} else {
			$this->session->set_flashdata('pesan',
				'<div class="alert alert-danger text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Gagal Reject Peserta</div>'
			);
			redirect($this->agent->referrer());
		}
	}

	public function insert_set_ujian()
	{
		$this->form_validation->set_rules('id_user', 'id_user', 'required');
		$this->form_validation->set_rules('id_aktifitas_ujian', 'id_aktifitas_ujian', 'required');
		if ($this->form_validation->run() == FALSE) {
			$this->peserta_ujian();
		} else {
			$user = $this->input->post('id_user');
			$result = array();
			foreach($user AS $key => $val) {
				$data = array(
					'id_aktifitas_ujian' => $this->input->post('id_aktifitas_ujian'),
					'id_user' => $this->input->post('id_user')[$key],
				);
				$query = $this->db->get_where('m_set_ujian', array(
					'id_user' => $this->input->post('id_user')[$key],
				));
				if ($query->num_rows()==0) {
					$res = $this->db->insert('m_set_ujian', $data);
					$this->db->order_by('rand()');
					$this->db->limit(5);
					$query = $this->db->get('m_soal');
					foreach ($query->result() as $value) {
						$soal = array(
							'id_soal' => $value->id_soal, 
							'id_user' => $this->input->post('id_user')[$key],
						);
						$res = $this->db->insert('m_ujian', $soal);
					}
				} else {
					$res = $this->db->update('m_set_ujian', $data, array(
						'id_user' => $this->input->post('id_user')[$key],
					));
				}
			}
			if ($res>=1) {
				$this->session->set_flashdata('pesan',
					'<div class="alert alert-success text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Berhasil Menyimpan Data</div>'
				);
				redirect($this->agent->referrer());
			} else {
				$this->session->set_flashdata('pesan',
					'<div class="alert alert-danger text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Gagal Menyimpan Data</div>'
				);
				redirect($this->agent->referrer());
			}
		}
	}

	public function insert_set_ujian_ulang()
	{
		$recek = array(
			'recek' => 1, 
			'lulus' => 0,
		);
		$res = $this->db->update('m_set_ujian', $recek, array('id_user' => $this->input->post('id_user')));
		$this->db->order_by('rand()');
		$this->db->limit(5);
		$query = $this->db->get('m_soal');
		foreach ($query->result() as $value) {
			$soal = array(
				'id_soal' => $value->id_soal, 
				'id_user' => $this->input->post('id_user'),
			);
			$res = $this->db->insert('m_ujian_ulang', $soal);
		}
		if ($res>=1) {
			// $this->session->set_flashdata('pesan',
			// 	'<div class="alert alert-success text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Berhasil Menyimpan Data</div>'
			// );
			redirect('ujian/ulang');
		} else {
			$this->session->set_flashdata('pesan',
				'<div class="alert alert-danger text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Gagal Menyimpan Data</div>'
			);
			redirect($this->agent->referrer());
		}
	}

	public function insert_jawaban()
	{
		if ($this->input->post('menjawab')=='') {
			$this->session->set_flashdata('pesan',
				'<div class="alert alert-danger text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Belum Memilih Jawaban</div>'
			);
			redirect($this->agent->referrer());
		} else {
			$soal = $this->db->get_where('m_soal', array(
				'id_soal' => $this->input->post('id_soal'),
				'jawaban' =>  $this->input->post('menjawab'),
			));
			$data = array(
				'menjawab' =>  $this->input->post('menjawab'),
				'betul' => $soal->num_rows,
			);
			$res = $this->db->update('m_ujian', $data, array(
				'id_user' => $this->input->post('id_user'),
				'id_soal' => $this->input->post('id_soal'),
			));
			if ($res>=1) {
				$this->session->set_flashdata('pesan',
					'<div class="alert alert-success text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Berhasil Menyimpan Data</div>'
				);
				redirect($this->agent->referrer());
			} else {
				$this->session->set_flashdata('pesan',
					'<div class="alert alert-danger text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Gagal Menyimpan Data</div>'
				);
				redirect($this->agent->referrer());
			}
		}
	}

	public function insert_jawaban_ulang()
	{
		if ($this->input->post('menjawab')=='') {
			$this->session->set_flashdata('pesan',
				'<div class="alert alert-danger text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Belum Memilih Jawaban</div>'
			);
			redirect($this->agent->referrer());
		} else {
			$soal = $this->db->get_where('m_soal', array(
				'id_soal' => $this->input->post('id_soal'),
				'jawaban' =>  $this->input->post('menjawab'),
			));
			$data = array(
				'menjawab' =>  $this->input->post('menjawab'),
				'betul' => $soal->num_rows,
			);
			$res = $this->db->update('m_ujian_ulang', $data, array(
				'id_user' => $this->input->post('id_user'),
				'id_soal' => $this->input->post('id_soal'),
			));
			if ($res>=1) {
				$this->session->set_flashdata('pesan',
					'<div class="alert alert-success text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Berhasil Menyimpan Data</div>'
				);
				redirect($this->agent->referrer());
			} else {
				$this->session->set_flashdata('pesan',
					'<div class="alert alert-danger text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Gagal Menyimpan Data</div>'
				);
				redirect($this->agent->referrer());
			}
		}
	}

	public function selesai_ujian()
	{
		$jawab = $this->db->get_where('m_ujian', array('id_user' => $this->input->post('id_user')));
		foreach ($jawab->result() as $value) {
			$soal = $this->db->get_where('m_soal', array(
				'id_soal' => $value->id_soal,
				'jawaban' => $value->menjawab,
			));
		}
		$jml_soal_ujian = $this->db->get_where('m_ujian', array(
			'id_user' => $this->input->post('id_user'),
		));
		$point_soal = 100 / $jml_soal_ujian->num_rows();

		$this->db->select('SUM(betul) as total');
		$this->db->where('id_user', $this->input->post('id_user'));
		$this->db->from('m_ujian');
		$betul = $this->db->get()->row()->total;
		$cek = $betul * $point_soal;
		if ($cek >= 70) {
			$data = array(
				'tanggal' => date('d/m/Y'),
				'nilai' => $betul * $point_soal,
				'lulus' => 1,
			);
		} else {
			$data = array(
				'tanggal' => date('d/m/Y'),
				'nilai' => $betul * $point_soal,
				'lulus' => 2,
			);
		}
		$res = $this->db->update('m_set_ujian', $data, array('id_user' => $this->input->post('id_user')));
		if ($res>=1) {
			// $this->session->set_flashdata('pesan',
			// 	'<div class="alert alert-success text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Berhasil Menyimpan Data</div>'
			// );
			redirect('/');
		} else {
			$this->session->set_flashdata('pesan',
				'<div class="alert alert-danger text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Gagal Menyimpan Data</div>'
			);
			redirect($this->agent->referrer());
		}
	}

	public function selesai_ujian_ulang()
	{
		$jawab = $this->db->get_where('m_ujian_ulang', array('id_user' => $this->input->post('id_user')));
		foreach ($jawab->result() as $value) {
			$soal = $this->db->get_where('m_soal', array(
				'id_soal' => $value->id_soal,
				'jawaban' => $value->menjawab,
			));
		}
		$jml_soal_ujian = $this->db->get_where('m_ujian_ulang', array(
			'id_user' => $this->input->post('id_user'),
		));
		$point_soal = 100 / $jml_soal_ujian->num_rows();

		$this->db->select('SUM(betul) as total');
		$this->db->where('id_user', $this->input->post('id_user'));
		$this->db->from('m_ujian_ulang');
		$betul = $this->db->get()->row()->total;
		$cek = $betul * $point_soal;
		if ($cek >= 70) {
			$data = array(
				'tanggal_ulangan' => date('d/m/Y'),
				'nilai_ulangan' => $betul * $point_soal,
				'lulus' => 1,
			);
		} else {
			$data = array(
				'tanggal_ulangan' => date('d/m/Y'),
				'nilai_ulangan' => $betul * $point_soal,
				'lulus' => 2,
			);
		}
		$res = $this->db->update('m_set_ujian', $data, array('id_user' => $this->input->post('id_user')));
		if ($res>=1) {
			// $this->session->set_flashdata('pesan',
			// 	'<div class="alert alert-success text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Berhasil Menyimpan Data</div>'
			// );
			redirect('/');
		} else {
			$this->session->set_flashdata('pesan',
				'<div class="alert alert-danger text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Gagal Menyimpan Data</div>'
			);
			redirect($this->agent->referrer());
		}
	}

	public function registrasi_pemohon()
	{
		$data = array(
			'title' => 'Registrasi Pemohon', 
			'page' => 'registrasi_pemohon',
			'data' => $this->my_model->registrasi_pemohon(),
		);
		$this->load->view('template', $data);
	}

	public function syarat_administrasi($id)
	{
		$data = array(
			'title' => 'Syarat Administrasi', 
			'page' => 'syarat_administrasi',
			'id' => $id,
			'sk' => $this->my_model->sertifikat_kompetensi($id),
			'medex' => $this->my_model->medex($id),
			'icao' => $this->my_model->icao($id),
			'pembayaran' => $this->my_model->pembayaran($id),
			'data' => $this->my_model->get_registrasi_pemohon($id),
		);
		$this->load->view('template', $data);
	}

	public function upload_foto()
	{
		$name = 'foto-'.$this->input->post('nama').'-'.uniqid();
		$config['upload_path'] = './assets/file/';
		$config['allowed_types'] = 'jpg|jpeg|png|pdf';
		$config['file_name'] = $name;

		$this->upload->initialize($config);

		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('pesan',
				'<div class="alert alert-danger text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				Gagal, format file disarakankan jpg, jpeg, png dan pdf, silahkan ulangi kembali</div>'
			);
			redirect($this->agent->referrer(), $error);
		} else {	
			$file = $this->upload->data();
			$this->db->where('id_user', $this->input->post('id_user'));
			$query = $this->db->get('m_user');
			$row = $query->row();
			unlink("./assets/file/$row->foto");
			$data = array(
				'foto' => $file['file_name'],
			);
			$res = $this->db->update('m_user', $data, array('id_user' => $this->input->post('id_user')));
			if ($res>=1) {
				$this->session->set_flashdata('pesan',
					'<div class="alert alert-success text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Berhasil Menyimpan Data</div>'
				);
				redirect($this->agent->referrer());
			} else {
				$this->session->set_flashdata('pesan',
					'<div class="alert alert-danger text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Gagal Menyimpan Data</div>'
				);
				redirect($this->agent->referrer());
			}
		}
	}

	public function upload_ktp()
	{
		$name = 'ktp-'.$this->input->post('nama').'-'.uniqid();
		$config['upload_path'] = './assets/file/';
		$config['allowed_types'] = 'jpg|jpeg|png|pdf';
		$config['file_name'] = $name;

		$this->upload->initialize($config);

		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('pesan',
				'<div class="alert alert-danger text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				Gagal, format file disarakankan jpg, jpeg, png dan pdf, silahkan ulangi kembali</div>'
			);
			redirect($this->agent->referrer(), $error);
		} else {	
			$file = $this->upload->data();
			$this->db->where('id_user', $this->input->post('id_user'));
			$query = $this->db->get('m_user');
			$row = $query->row();
			unlink("./assets/file/$row->ktp");
			$data = array(
				'ktp' => $file['file_name'],
			);
			$res = $this->db->update('m_user', $data, array('id_user' => $this->input->post('id_user')));
			if ($res>=1) {
				$this->session->set_flashdata('pesan',
					'<div class="alert alert-success text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Berhasil Menyimpan Data</div>'
				);
				redirect($this->agent->referrer());
			} else {
				$this->session->set_flashdata('pesan',
					'<div class="alert alert-danger text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Gagal Menyimpan Data</div>'
				);
				redirect($this->agent->referrer());
			}
		}
	}

	public function upload_ijazah()
	{
		$name = 'ijazah-'.$this->input->post('nama').'-'.uniqid();
		$config['upload_path'] = './assets/file/';
		$config['allowed_types'] = 'jpg|jpeg|png|pdf';
		$config['file_name'] = $name;

		$this->upload->initialize($config);

		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('pesan',
				'<div class="alert alert-danger text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				Gagal, format file disarakankan jpg, jpeg, png dan pdf, silahkan ulangi kembali</div>'
			);
			redirect($this->agent->referrer(), $error);
		} else {	
			$file = $this->upload->data();
			$this->db->where('id_user', $this->input->post('id_user'));
			$query = $this->db->get('m_user');
			$row = $query->row();
			unlink("./assets/file/$row->ijazah");
			$data = array(
				'ijazah' => $file['file_name'],
			);
			$res = $this->db->update('m_user', $data, array('id_user' => $this->input->post('id_user')));
			if ($res>=1) {
				$this->session->set_flashdata('pesan',
					'<div class="alert alert-success text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Berhasil Menyimpan Data</div>'
				);
				redirect($this->agent->referrer());
			} else {
				$this->session->set_flashdata('pesan',
					'<div class="alert alert-danger text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Gagal Menyimpan Data</div>'
				);
				redirect($this->agent->referrer());
			}
		}
	}

	public function insert_sertifikat_kompentensi()
	{
		$name = 'sertifikat-kompetensi-'.$this->input->post('id_user').'-'.uniqid();
		$config['upload_path'] = './assets/file/';
		$config['allowed_types'] = 'jpg|jpeg|png|pdf';
		$config['file_name'] = $name;

		$this->upload->initialize($config);

		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('pesan',
				'<div class="alert alert-danger text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				Gagal, format file disarakankan jpg, jpeg, png dan pdf, silahkan ulangi kembali</div>'
			);
			redirect($this->agent->referrer(), $error);
		} else {	
			$file = $this->upload->data();
			$data = array(
				'id_user' => $this->input->post('id_user'),
				'no_sertifikat' => $this->input->post('no_sertifikat'),
				'tgl_terbit' => $this->input->post('tgl_terbit'),
				'file_sertifikat' => $file['file_name'],
				'catatan' => $this->input->post('catatan'),
			);
			$res = $this->db->insert('m_sertifikat_kompetensi', $data);
			if ($res>=1) {
				$this->session->set_flashdata('pesan',
					'<div class="alert alert-success text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Berhasil Menyimpan Data</div>'
				);
				redirect($this->agent->referrer());
			} else {
				$this->session->set_flashdata('pesan',
					'<div class="alert alert-danger text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Gagal Menyimpan Data</div>'
				);
				redirect($this->agent->referrer());
			}
		}
	}

	public function update_sertifikat_kompentensi()
	{
		if (empty($_FILES['userfile']['name'])) {
			$data = array(
				'no_sertifikat' => $this->input->post('no_sertifikat'),
				'tgl_terbit' => $this->input->post('tgl_terbit'),
				'catatan' => $this->input->post('catatan'),
			);
			$res = $this->db->update('m_sertifikat_kompetensi', $data, array('id_sk' => $this->input->post('id_sk')));
			if ($res>=1) {
				$this->session->set_flashdata('pesan',
					'<div class="alert alert-success text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Berhasil Menyimpan Data</div>'
				);
				redirect($this->agent->referrer());
			} else {
				$this->session->set_flashdata('pesan',
					'<div class="alert alert-danger text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Gagal Menyimpan Data</div>'
				);
				redirect($this->agent->referrer());
			}
		} else {
			$name = 'sertifikat-kompetensi-'.$this->input->post('id_user').'-'.uniqid();
			$config['upload_path'] = './assets/file/';
			$config['allowed_types'] = 'jpg|jpeg|png|pdf';
			$config['file_name'] = $name;

			$this->upload->initialize($config);

			if ( ! $this->upload->do_upload())
			{
				$error = array('error' => $this->upload->display_errors());
				$this->session->set_flashdata('pesan',
					'<div class="alert alert-danger text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Gagal, format file disarakankan jpg, jpeg, png dan pdf, silahkan ulangi kembali</div>'
				);
				redirect($this->agent->referrer(), $error);
			} else {	
				$file = $this->upload->data();
				$this->db->where('id_sk', $this->input->post('id_sk'));
				$query = $this->db->get('m_sertifikat_kompetensi');
				$row = $query->row();
				unlink("./assets/file/$row->file_sertifikat");
				$data = array(
					'no_sertifikat' => $this->input->post('no_sertifikat'),
					'tgl_terbit' => $this->input->post('tgl_terbit'),
					'file_sertifikat' => $file['file_name'],
					'catatan' => $this->input->post('catatan'),
				);
				$res = $this->db->update('m_sertifikat_kompetensi', $data, array('id_sk' => $this->input->post('id_sk')));
				if ($res>=1) {
					$this->session->set_flashdata('pesan',
						'<div class="alert alert-success text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Berhasil Menyimpan Data</div>'
					);
					redirect($this->agent->referrer());
				} else {
					$this->session->set_flashdata('pesan',
						'<div class="alert alert-danger text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Gagal Menyimpan Data</div>'
					);
					redirect($this->agent->referrer());
				}
			}
		}
	}

	public function delete_sertifikat_kompentensi()
	{
		$this->db->where('id_sk', $this->input->post('id_sk'));
		$query = $this->db->get('m_sertifikat_kompetensi');
		$row = $query->row();
		unlink("./assets/file/$row->file_sertifikat");
		$res = $this->db->delete('m_sertifikat_kompetensi', array('id_sk' => $this->input->post('id_sk')));
		if ($res>=1) {
			$this->session->set_flashdata('pesan',
				'<div class="alert alert-success text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Berhasil Menghapus Data</div>'
			);
			redirect($this->agent->referrer());
		} else {
			$this->session->set_flashdata('pesan',
				'<div class="alert alert-danger text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Gagal Menghapus Data</div>'
			);
			redirect($this->agent->referrer());
		}
	}

	public function insert_medex()
	{
		$name = 'medex-'.$this->input->post('id_user').'-'.uniqid();
		$config['upload_path'] = './assets/file/';
		$config['allowed_types'] = 'jpg|jpeg|png|pdf';
		$config['file_name'] = $name;

		$this->upload->initialize($config);

		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('pesan',
				'<div class="alert alert-danger text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				Gagal, format file disarakankan jpg, jpeg, png dan pdf, silahkan ulangi kembali</div>'
			);
			redirect($this->agent->referrer(), $error);
		} else {	
			$file = $this->upload->data();
			$data = array(
				'id_user' => $this->input->post('id_user'),
				'tgl_dikeluarkan' => $this->input->post('tgl_dikeluarkan'),
				'tgl_berlaku' => $this->input->post('tgl_berlaku'),
				'file_sertifikat' => $file['file_name'],
				'catatan' => $this->input->post('catatan'),
			);
			$res = $this->db->insert('m_medex', $data);
			if ($res>=1) {
				$this->session->set_flashdata('pesan',
					'<div class="alert alert-success text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Berhasil Menyimpan Data</div>'
				);
				redirect($this->agent->referrer());
			} else {
				$this->session->set_flashdata('pesan',
					'<div class="alert alert-danger text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Gagal Menyimpan Data</div>'
				);
				redirect($this->agent->referrer());
			}
		}
	}

	public function update_medex()
	{
		if (empty($_FILES['userfile']['name'])) {
			$data = array(
				'tgl_dikeluarkan' => $this->input->post('tgl_dikeluarkan'),
				'tgl_berlaku' => $this->input->post('tgl_berlaku'),
				'catatan' => $this->input->post('catatan'),
			);
			$res = $this->db->update('m_medex', $data, array('id_medex' => $this->input->post('id_medex')));
			if ($res>=1) {
				$this->session->set_flashdata('pesan',
					'<div class="alert alert-success text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Berhasil Menyimpan Data</div>'
				);
				redirect($this->agent->referrer());
			} else {
				$this->session->set_flashdata('pesan',
					'<div class="alert alert-danger text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Gagal Menyimpan Data</div>'
				);
				redirect($this->agent->referrer());
			}
		} else {
			$name = 'medex-'.$this->input->post('id_user').'-'.uniqid();
			$config['upload_path'] = './assets/file/';
			$config['allowed_types'] = 'jpg|jpeg|png|pdf';
			$config['file_name'] = $name;

			$this->upload->initialize($config);

			if ( ! $this->upload->do_upload())
			{
				$error = array('error' => $this->upload->display_errors());
				$this->session->set_flashdata('pesan',
					'<div class="alert alert-danger text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Gagal, format file disarakankan jpg, jpeg, png dan pdf, silahkan ulangi kembali</div>'
				);
				redirect($this->agent->referrer(), $error);
			} else {	
				$file = $this->upload->data();
				$this->db->where('id_medex', $this->input->post('id_medex'));
				$query = $this->db->get('m_medex');
				$row = $query->row();
				unlink("./assets/file/$row->file_sertifikat");
				$data = array(
					'tgl_dikeluarkan' => $this->input->post('tgl_dikeluarkan'),
					'tgl_berlaku' => $this->input->post('tgl_berlaku'),
					'file_sertifikat' => $file['file_name'],
					'catatan' => $this->input->post('catatan'),
				);
				$res = $this->db->update('m_medex', $data, array('id_medex' => $this->input->post('id_medex')));
				if ($res>=1) {
					$this->session->set_flashdata('pesan',
						'<div class="alert alert-success text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Berhasil Menyimpan Data</div>'
					);
					redirect($this->agent->referrer());
				} else {
					$this->session->set_flashdata('pesan',
						'<div class="alert alert-danger text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Gagal Menyimpan Data</div>'
					);
					redirect($this->agent->referrer());
				}
			}
		}
	}

	public function delete_medex()
	{
		$this->db->where('id_medex', $this->input->post('id_medex'));
		$query = $this->db->get('m_medex');
		$row = $query->row();
		unlink("./assets/file/$row->file_sertifikat");
		$res = $this->db->delete('m_medex', array('id_medex' => $this->input->post('id_medex')));
		if ($res>=1) {
			$this->session->set_flashdata('pesan',
				'<div class="alert alert-success text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Berhasil Menghapus Data</div>'
			);
			redirect($this->agent->referrer());
		} else {
			$this->session->set_flashdata('pesan',
				'<div class="alert alert-danger text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Gagal Menghapus Data</div>'
			);
			redirect($this->agent->referrer());
		}
	}

	public function insert_icao()
	{
		$name = 'icao-'.$this->input->post('id_user').'-'.uniqid();
		$config['upload_path'] = './assets/file/';
		$config['allowed_types'] = 'jpg|jpeg|png|pdf';
		$config['file_name'] = $name;

		$this->upload->initialize($config);

		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('pesan',
				'<div class="alert alert-danger text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				Gagal, format file disarakankan jpg, jpeg, png dan pdf, silahkan ulangi kembali</div>'
			);
			redirect($this->agent->referrer(), $error);
		} else {	
			$file = $this->upload->data();
			$data = array(
				'id_user' => $this->input->post('id_user'),
				'tgl_dikeluarkan' => $this->input->post('tgl_dikeluarkan'),
				'tgl_berlaku' => $this->input->post('tgl_berlaku'),
				'level' => $this->input->post('level'),
				'file_sertifikat' => $file['file_name'],
				'catatan' => $this->input->post('catatan'),
			);
			$res = $this->db->insert('m_icao', $data);
			if ($res>=1) {
				$this->session->set_flashdata('pesan',
					'<div class="alert alert-success text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Berhasil Menyimpan Data</div>'
				);
				redirect($this->agent->referrer());
			} else {
				$this->session->set_flashdata('pesan',
					'<div class="alert alert-danger text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Gagal Menyimpan Data</div>'
				);
				redirect($this->agent->referrer());
			}
		}
	}

	public function update_icao()
	{
		if (empty($_FILES['userfile']['name'])) {
			$data = array(
				'tgl_dikeluarkan' => $this->input->post('tgl_dikeluarkan'),
				'tgl_berlaku' => $this->input->post('tgl_berlaku'),
				'level' => $this->input->post('level'),
				'catatan' => $this->input->post('catatan'),
			);
			$res = $this->db->update('m_icao', $data, array('id_icao' => $this->input->post('id_icao')));
			if ($res>=1) {
				$this->session->set_flashdata('pesan',
					'<div class="alert alert-success text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Berhasil Menyimpan Data</div>'
				);
				redirect($this->agent->referrer());
			} else {
				$this->session->set_flashdata('pesan',
					'<div class="alert alert-danger text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Gagal Menyimpan Data</div>'
				);
				redirect($this->agent->referrer());
			}
		} else {
			$name = 'icao-'.$this->input->post('id_user').'-'.uniqid();
			$config['upload_path'] = './assets/file/';
			$config['allowed_types'] = 'jpg|jpeg|png|pdf';
			$config['file_name'] = $name;

			$this->upload->initialize($config);

			if ( ! $this->upload->do_upload())
			{
				$error = array('error' => $this->upload->display_errors());
				$this->session->set_flashdata('pesan',
					'<div class="alert alert-danger text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Gagal, format file disarakankan jpg, jpeg, png dan pdf, silahkan ulangi kembali</div>'
				);
				redirect($this->agent->referrer(), $error);
			} else {	
				$file = $this->upload->data();
				$this->db->where('id_icao', $this->input->post('id_icao'));
				$query = $this->db->get('m_icao');
				$row = $query->row();
				unlink("./assets/file/$row->file_sertifikat");
				$data = array(
					'tgl_dikeluarkan' => $this->input->post('tgl_dikeluarkan'),
					'tgl_berlaku' => $this->input->post('tgl_berlaku'),
					'level' => $this->input->post('level'),
					'file_sertifikat' => $file['file_name'],
					'catatan' => $this->input->post('catatan'),
				);
				$res = $this->db->update('m_icao', $data, array('id_icao' => $this->input->post('id_icao')));
				if ($res>=1) {
					$this->session->set_flashdata('pesan',
						'<div class="alert alert-success text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Berhasil Menyimpan Data</div>'
					);
					redirect($this->agent->referrer());
				} else {
					$this->session->set_flashdata('pesan',
						'<div class="alert alert-danger text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Gagal Menyimpan Data</div>'
					);
					redirect($this->agent->referrer());
				}
			}
		}
	}

	public function delete_icao()
	{
		$this->db->where('id_icao', $this->input->post('id_icao'));
		$query = $this->db->get('m_icao');
		$row = $query->row();
		unlink("./assets/file/$row->file_sertifikat");
		$res = $this->db->delete('m_icao', array('id_icao' => $this->input->post('id_icao')));
		if ($res>=1) {
			$this->session->set_flashdata('pesan',
				'<div class="alert alert-success text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Berhasil Menghapus Data</div>'
			);
			redirect($this->agent->referrer());
		} else {
			$this->session->set_flashdata('pesan',
				'<div class="alert alert-danger text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Gagal Menghapus Data</div>'
			);
			redirect($this->agent->referrer());
		}
	}

	public function insert_pembayaran()
	{
		$name = 'pembayaran-'.$this->input->post('id_user').'-'.uniqid();
		$config['upload_path'] = './assets/file/';
		$config['allowed_types'] = 'jpg|jpeg|png|pdf';
		$config['file_name'] = $name;

		$this->upload->initialize($config);

		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('pesan',
				'<div class="alert alert-danger text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				Gagal, format file disarakankan jpg, jpeg, png dan pdf, silahkan ulangi kembali</div>'
			);
			redirect($this->agent->referrer(), $error);
		} else {	
			$file = $this->upload->data();
			$data = array(
				'id_user' => $this->input->post('id_user'),
				'jumlah_tagihan' => $this->input->post('jumlah_tagihan'),
				'tgl_pembayaran' => $this->input->post('tgl_pembayaran'),
				'bukti_pembayaran' => $file['file_name'],
				'catatan' => $this->input->post('catatan'),
			);
			$res = $this->db->insert('m_pembayaran', $data);
			if ($res>=1) {
				$this->session->set_flashdata('pesan',
					'<div class="alert alert-success text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Berhasil Menyimpan Data</div>'
				);
				redirect($this->agent->referrer());
			} else {
				$this->session->set_flashdata('pesan',
					'<div class="alert alert-danger text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Gagal Menyimpan Data</div>'
				);
				redirect($this->agent->referrer());
			}
		}
	}

	public function update_pembayaran()
	{
		if (empty($_FILES['userfile']['name'])) {
			$data = array(
				'jumlah_tagihan' => $this->input->post('jumlah_tagihan'),
				'tgl_pembayaran' => $this->input->post('tgl_pembayaran'),
				'catatan' => $this->input->post('catatan'),
			);
			$res = $this->db->update('m_pembayaran', $data, array('id_pembayaran' => $this->input->post('id_pembayaran')));
			if ($res>=1) {
				$this->session->set_flashdata('pesan',
					'<div class="alert alert-success text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Berhasil Menyimpan Data</div>'
				);
				redirect($this->agent->referrer());
			} else {
				$this->session->set_flashdata('pesan',
					'<div class="alert alert-danger text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Gagal Menyimpan Data</div>'
				);
				redirect($this->agent->referrer());
			}
		} else {
			$name = 'pembayaran-'.$this->input->post('id_user').'-'.uniqid();
			$config['upload_path'] = './assets/file/';
			$config['allowed_types'] = 'jpg|jpeg|png|pdf';
			$config['file_name'] = $name;

			$this->upload->initialize($config);

			if ( ! $this->upload->do_upload())
			{
				$error = array('error' => $this->upload->display_errors());
				$this->session->set_flashdata('pesan',
					'<div class="alert alert-danger text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Gagal, format file disarakankan jpg, jpeg, png dan pdf, silahkan ulangi kembali</div>'
				);
				redirect($this->agent->referrer(), $error);
			} else {	
				$file = $this->upload->data();
				$this->db->where('id_pembayaran', $this->input->post('id_pembayaran'));
				$query = $this->db->get('m_pembayaran');
				$row = $query->row();
				unlink("./assets/file/$row->file_sertifikat");
				$data = array(
					'jumlah_tagihan' => $this->input->post('jumlah_tagihan'),
					'tgl_pembayaran' => $this->input->post('tgl_pembayaran'),
					'file_sertifikat' => $file['file_name'],
					'catatan' => $this->input->post('catatan'),
				);
				$res = $this->db->update('m_pembayaran', $data, array('id_pembayaran' => $this->input->post('id_pembayaran')));
				if ($res>=1) {
					$this->session->set_flashdata('pesan',
						'<div class="alert alert-success text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Berhasil Menyimpan Data</div>'
					);
					redirect($this->agent->referrer());
				} else {
					$this->session->set_flashdata('pesan',
						'<div class="alert alert-danger text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Gagal Menyimpan Data</div>'
					);
					redirect($this->agent->referrer());
				}
			}
		}
	}

	public function delete_pembayaran()
	{
		$this->db->where('id_pembayaran', $this->input->post('id_pembayaran'));
		$query = $this->db->get('m_pembayaran');
		$row = $query->row();
		unlink("./assets/file/$row->bukti_pembayaran");
		$res = $this->db->delete('m_pembayaran', array('id_pembayaran' => $this->input->post('id_pembayaran')));
		if ($res>=1) {
			$this->session->set_flashdata('pesan',
				'<div class="alert alert-success text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Berhasil Menghapus Data</div>'
			);
			redirect($this->agent->referrer());
		} else {
			$this->session->set_flashdata('pesan',
				'<div class="alert alert-danger text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Gagal Menghapus Data</div>'
			);
			redirect($this->agent->referrer());
		}
	}

	public function tambah_pemohon()
	{
		$data = array(
			'title' => 'Registrasi Pemohon', 
			'page' => 'tambah_pemohon',
			'bandara' => $this->my_model->bandara(),
			'negara' => $this->my_model->negara(),
			'jk' => $this->my_model->jenis_kelamin(),
			'pendidikan' => $this->my_model->pendidikan(),
		);
		$this->load->view('template', $data);
	}

	public function insert_registrasi_pemohon()
	{
		$this->form_validation->set_rules('id_jk', 'id_jk', 'required');
		$this->form_validation->set_rules('id_negara', 'id_negara', 'required');
		$this->form_validation->set_rules('id_pendidikan', 'id_pendidikan', 'required');
		$this->form_validation->set_rules('nama', 'nama', 'required');
		$this->form_validation->set_rules('no_identitas', 'no_identitas', 'required');
		$this->form_validation->set_rules('tempat_lahir', 'tempat_lahir', 'required');
		$this->form_validation->set_rules('tanggal_lahir', 'tanggal_lahir', 'required');
		$this->form_validation->set_rules('alamat', 'alamat', 'required');
		$this->form_validation->set_rules('no_telp', 'no_telp', '');
		$this->form_validation->set_rules('bahasa_inggris', 'bahasa_inggris', 'required');
		$this->form_validation->set_rules('tinggi', 'tinggi', 'required');
		$this->form_validation->set_rules('berat', 'berat', 'required');
		$this->form_validation->set_rules('rambut', 'rambut', 'required');
		$this->form_validation->set_rules('mata', 'mata', 'required');
		$this->form_validation->set_rules('memiliki_lisensi', 'memiliki_lisensi', 'required');
		$this->form_validation->set_rules('pernah_gagal', 'pernah_gagal', 'required');
		$this->form_validation->set_rules('email', 'email', 'required|is_unique[m_user.email]');
		$this->form_validation->set_rules('username', 'username', 'required|is_unique[m_user.username]');
		$this->form_validation->set_rules('password', 'password', 'required|matches[ulangi_password]');
		$this->form_validation->set_rules('ulangi_password', 'ulangi_password', 'required|matches[password]');
		if ($this->form_validation->run() == FALSE) {
			$this->tambah_pemohon();
		} else {
			$data = array(
				'id_jk' => $this->input->post('id_jk'),
				'id_tipe' => 4,
				'id_instansi' => $this->session->userdata('id_instansi'),
				'id_negara' => $this->input->post('id_negara'),
				'id_pendidikan' => $this->input->post('id_pendidikan'),
				'nama' => $this->input->post('nama'),
				'no_identitas' => $this->input->post('no_identitas'),
				'tempat_lahir' => $this->input->post('tempat_lahir'),
				'tanggal_lahir' => $this->input->post('tanggal_lahir'),
				'alamat' => $this->input->post('alamat'),
				'no_telp' => $this->input->post('no_telp'),
				'bahasa_inggris' => $this->input->post('bahasa_inggris'),
				'tinggi' => $this->input->post('tinggi'),
				'berat' => $this->input->post('berat'),
				'rambut' => $this->input->post('rambut'),
				'mata' => $this->input->post('mata'),
				'memiliki_lisensi' => $this->input->post('memiliki_lisensi'),
				'pernah_gagal' => $this->input->post('pernah_gagal'),
				'email' => $this->input->post('email'),
				'username' => $this->input->post('username'),
				'password' => md5($this->input->post('password')),
				'status' => 1,
				'pernyataan' => $this->input->post('pernyataan'),
			);
			$res = $this->db->insert('m_user', $data);
			if ($res>=1) {
				$this->session->set_flashdata('pesan',
					'<div class="alert alert-success text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Berhasil Menyimpan Data</div>'
				);
				redirect('registrasi/pemohon');
			} else {
				$this->session->set_flashdata('pesan',
					'<div class="alert alert-danger text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Gagal Menyimpan Data</div>'
				);
				redirect($this->agent->referrer());
			}
		}
	}

	public function ubah_pemohon($id)
	{
		$data = array(
			'title' => 'Registrasi Pemohon', 
			'page' => 'ubah_pemohon',
			'bandara' => $this->my_model->bandara(),
			'negara' => $this->my_model->negara(),
			'pendidikan' => $this->my_model->pendidikan(),
			'jk' => $this->my_model->jenis_kelamin(),
			'data' => $this->my_model->get_registrasi_pemohon($id),
		);
		$this->load->view('template', $data);
	}

	public function update_registrasi_pemohon()
	{
		if ($this->input->post('password')!='') {
			$data = array(
				'id_jk' => $this->input->post('id_jk'),
				'id_instansi' => $this->session->userdata('id_instansi'),
				'id_negara' => $this->input->post('id_negara'),
				'id_pendidikan' => $this->input->post('id_pendidikan'),
				'nama' => $this->input->post('nama'),
				'no_identitas' => $this->input->post('no_identitas'),
				'tempat_lahir' => $this->input->post('tempat_lahir'),
				'tanggal_lahir' => $this->input->post('tanggal_lahir'),
				'alamat' => $this->input->post('alamat'),
				'no_telp' => $this->input->post('no_telp'),
				'bahasa_inggris' => $this->input->post('bahasa_inggris'),
				'tinggi' => $this->input->post('tinggi'),
				'berat' => $this->input->post('berat'),
				'rambut' => $this->input->post('rambut'),
				'mata' => $this->input->post('mata'),
				'memiliki_lisensi' => $this->input->post('memiliki_lisensi'),
				'pernah_gagal' => $this->input->post('pernah_gagal'),
				'email' => $this->input->post('email'),
				'username' => $this->input->post('username'),
				'password' => md5($this->input->post('password')),
				'pernyataan' => $this->input->post('pernyataan'),
				'password' => md5($this->input->post('password')),
			);
		} else {
			$data = array(
				'id_jk' => $this->input->post('id_jk'),
				'id_instansi' => $this->session->userdata('id_instansi'),
				'id_negara' => $this->input->post('id_negara'),
				'id_pendidikan' => $this->input->post('id_pendidikan'),
				'nama' => $this->input->post('nama'),
				'no_identitas' => $this->input->post('no_identitas'),
				'tempat_lahir' => $this->input->post('tempat_lahir'),
				'tanggal_lahir' => $this->input->post('tanggal_lahir'),
				'alamat' => $this->input->post('alamat'),
				'no_telp' => $this->input->post('no_telp'),
				'bahasa_inggris' => $this->input->post('bahasa_inggris'),
				'tinggi' => $this->input->post('tinggi'),
				'berat' => $this->input->post('berat'),
				'rambut' => $this->input->post('rambut'),
				'mata' => $this->input->post('mata'),
				'memiliki_lisensi' => $this->input->post('memiliki_lisensi'),
				'pernah_gagal' => $this->input->post('pernah_gagal'),
				'email' => $this->input->post('email'),
				'username' => $this->input->post('username'),
				'password' => md5($this->input->post('password')),
				'pernyataan' => $this->input->post('pernyataan'),
			);
		}
		$res = $this->db->update('m_user', $data, array('id_user' => $this->input->post('id_user')));
		if ($res>=1) {
			$this->session->set_flashdata('pesan',
				'<div class="alert alert-success text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Berhasil Merubah Data</div>'
			);
			redirect($this->agent->referrer());
		} else {
			$this->session->set_flashdata('pesan',
				'<div class="alert alert-danger text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Gagal Merubah Data, Silahkan Ulangi Kembali</div>'
			);
			redirect($this->agent->referrer());
		}
	}

	public function delete_registrasi_pemohon()
	{
		$res = $this->db->delete('m_user', array('id_user' => $this->input->post('id_user')));
		if ($res>=1) {
			$this->session->set_flashdata('pesan',
				'<div class="alert alert-success text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Berhasil Menghapus Data</div>'
			);
			redirect($this->agent->referrer());
		} else {
			$this->session->set_flashdata('pesan',
				'<div class="alert alert-danger text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Gagal Menghapus Data</div>'
			);
			redirect($this->agent->referrer());
		}
	}

	public function kirim_admin()
	{
		$user = $this->input->post('id_user');
		$result = array();
		foreach($user AS $key => $val) {
			$data = array(
				'step' => 1,
				'id_user' => $this->input->post('id_user')[$key],
			);
			$res = $this->db->update('m_user', $data, array('id_user' => $this->input->post('id_user')[$key]));
		}
		if ($res>=1) {
			$this->session->set_flashdata('pesan',
				'<div class="alert alert-success text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Berhasil Mengirim Data</div>'
			);
			redirect($this->agent->referrer());
		} else {
			$this->session->set_flashdata('pesan',
				'<div class="alert alert-danger text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Gagal Mengirim Data, Silahkan Pilih Peserta Yang Akan Dikirim</div>'
			);
			redirect($this->agent->referrer());
		}
	}

	public function registrasi_lisensi_2()
	{
		$data = array(
			'title' => 'Registrasi Lisensi', 
			'page' => 'registrasi_lisensi_2',
			'bandara' => $this->my_model->bandara(),
			'negara' => $this->my_model->negara(),
		);
		$this->load->view('template', $data);
	}

	public function aktifitas_ujian()
	{
		$data = array(
			'title' => 'Aktifitas Ujian',
			'page' => 'aktifitas_ujian',
			'bandara' => $this->my_model->bandara(),
			'data' => $this->my_model->aktifitas_ujian(),
		);
		$this->load->view('template', $data);
	}

	public function insert_aktifitas_ujian()
	{
		$data = array(
			'nama_ujian' => $this->input->post('nama_ujian'),
			'tanggal_ujian' => $this->input->post('tanggal_ujian'),
			'jam_ujian' => $this->input->post('jam_ujian'),
			'id_bandara' => $this->input->post('id_bandara'),
			'alamat_ujian' => $this->input->post('alamat_ujian'),
		);
		$res = $this->db->insert('m_aktifitas_ujian', $data);
		if ($res>=1) {
			$this->session->set_flashdata('pesan',
				'<div class="alert alert-success text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Berhasil Menambah Data</div>'
			);
			redirect($this->agent->referrer());
		} else {
			$this->session->set_flashdata('pesan',
				'<div class="alert alert-danger text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Gagal Menambah Data</div>'
			);
			redirect($this->agent->referrer());
		}
	}

	public function update_aktifitas_ujian()
	{
		$data = array(
			'nama_ujian' => $this->input->post('nama_ujian'),
			'tanggal_ujian' => $this->input->post('tanggal_ujian'),
			'jam_ujian' => $this->input->post('jam_ujian'),
			'id_bandara' => $this->input->post('id_bandara'),
			'alamat_ujian' => $this->input->post('alamat_ujian'),
		);
		$res = $this->db->update('m_aktifitas_ujian', $data, array('id_aktifitas_ujian' => $this->input->post('id_aktifitas_ujian')));
		if ($res>=1) {
			$this->session->set_flashdata('pesan',
				'<div class="alert alert-success text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Berhasil Merubah Data</div>'
			);
			redirect($this->agent->referrer());
		} else {
			$this->session->set_flashdata('pesan',
				'<div class="alert alert-danger text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Gagal Merubah Data</div>'
			);
			redirect($this->agent->referrer());
		}
	}

	public function delete_aktifitas_ujian()
	{
		$res = $this->db->delete('m_aktifitas_ujian', array('id_aktifitas_ujian' => $this->input->post('id_aktifitas_ujian')));
		if ($res>=1) {
			$this->session->set_flashdata('pesan',
				'<div class="alert alert-success text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Berhasil Menghapus Data</div>'
			);
			redirect($this->agent->referrer());
		} else {
			$this->session->set_flashdata('pesan',
				'<div class="alert alert-danger text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Gagal Menghapus Data</div>'
			);
			redirect($this->agent->referrer());
		}
	}

	public function pelaksanaan_ujian()
	{
		$data = array(
			'title' => 'Pelaksanaan Ujian',
			'page' => 'pelaksanaan_ujian',
			'data' => $this->my_model->aktifitas_ujian(),
		);
		$this->load->view('template', $data);
	}

	public function mulai_aktifitas_ujian()
	{
		$data = array(
			'waktu' => $this->input->post('waktu'),
			'status_ujian' => 1, 
		);
		$res = $this->db->update('m_aktifitas_ujian', $data, array('id_aktifitas_ujian' => $this->input->post('id_aktifitas_ujian')));
		if ($res>=1) {
			$this->session->set_flashdata('pesan',
				'<div class="alert alert-success text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Berhasil Memulai Ujian</div>'
			);
			redirect($this->agent->referrer());
		} else {
			$this->session->set_flashdata('pesan',
				'<div class="alert alert-danger text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Gagal Memulai Ujian</div>'
			);
			redirect($this->agent->referrer());
		}
	}

	public function selesai_aktifitas_ujian()
	{
		session_start();
		unset($_SESSION["mulai"]);
		$data = array(
			'waktu' => 0,
			'status_ujian' => 0, 
		);
		$res = $this->db->update('m_aktifitas_ujian', $data, array('id_aktifitas_ujian' => $this->input->post('id_aktifitas_ujian')));
		if ($res>=1) {
			$this->session->set_flashdata('pesan',
				'<div class="alert alert-success text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Berhasil Menyelesaikan Ujian</div>'
			);
			redirect($this->agent->referrer());
		} else {
			$this->session->set_flashdata('pesan',
				'<div class="alert alert-danger text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Gagal Menyelesaikan Ujian</div>'
			);
			redirect($this->agent->referrer());
		}
	}

	public function selesai_aktifitas_ujian2()
	{
		session_start();
		unset($_SESSION["mulai"]);
		$data = array(
			'waktu' => 0,
			'status_ujian' => 0, 
		);
		$res = $this->db->update('m_aktifitas_ujian', $data, array('status_ujian' => 1));
		if ($res>=1) {
			$this->session->set_flashdata('pesan',
				'<div class="alert alert-success text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Berhasil Menyelesaikan Ujian</div>'
			);
			redirect($this->agent->referrer());
		} else {
			$this->session->set_flashdata('pesan',
				'<div class="alert alert-danger text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Gagal Menyelesaikan Ujian</div>'
			);
			redirect($this->agent->referrer());
		}
	}

	public function review_hasil_ujian()
	{
		$data = array(
			'title' => 'Review Hasil Ujian',
			'page' => 'review_hasil_ujian',
			'data' => $this->my_model->review_hasil_ujian(),
		);
		$this->load->view('template', $data);
	}
	// End Ujian

	// Personil
	public function personel()
	{
		$data = array(
			'title' => 'Personel',
			'page' => 'personel',
			'data' => $this->my_model->personel(),
		);
		$this->load->view('template', $data);
	}
	// End Personil

	// Master Data
	public function soal()
	{
		$data = array(
			'title' => 'Soal',
			'page' => 'bank_soal',
			'data' => $this->my_model->soal(),
		);
		$this->load->view('template', $data);
	}

	public function insert_soal()
	{
		$data = array(
			'soal' => $this->input->post('soal'),
			'jawaban' => $this->input->post('jawaban'),
			'pilihan_a' => $this->input->post('pilihan_a'),
			'pilihan_b' => $this->input->post('pilihan_b'),
			'pilihan_c' => $this->input->post('pilihan_c'),
			'pilihan_d' => $this->input->post('pilihan_d'),
			'pilihan_e' => $this->input->post('pilihan_e'),
		);
		$res = $this->db->insert('m_soal', $data);
		if ($res>=1) {
			$this->session->set_flashdata('pesan',
				'<div class="alert alert-success text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Berhasil Menambah Data</div>'
			);
			redirect($this->agent->referrer());
		} else {
			$this->session->set_flashdata('pesan',
				'<div class="alert alert-danger text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Gagal Menambah Data</div>'
			);
			redirect($this->agent->referrer());
		}
	}

	public function update_soal()
	{
		$data = array(
			'soal' => $this->input->post('soal'),
			'jawaban' => $this->input->post('jawaban'),
			'pilihan_a' => $this->input->post('pilihan_a'),
			'pilihan_b' => $this->input->post('pilihan_b'),
			'pilihan_c' => $this->input->post('pilihan_c'),
			'pilihan_d' => $this->input->post('pilihan_d'),
			'pilihan_e' => $this->input->post('pilihan_e'),
		);
		$res = $this->db->update('m_soal', $data, array('id_soal' => $this->input->post('id_soal')));
		if ($res>=1) {
			$this->session->set_flashdata('pesan',
				'<div class="alert alert-success text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Berhasil Merubah Data</div>'
			);
			redirect($this->agent->referrer());
		} else {
			$this->session->set_flashdata('pesan',
				'<div class="alert alert-danger text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Gagal Merubah Data</div>'
			);
			redirect($this->agent->referrer());
		}
	}

	public function delete_soal()
	{
		$res = $this->db->delete('m_soal', array('id_soal' => $this->input->post('id_soal')));
		if ($res>=1) {
			$this->session->set_flashdata('pesan',
				'<div class="alert alert-success text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Berhasil Menghapus Data</div>'
			);
			redirect($this->agent->referrer());
		} else {
			$this->session->set_flashdata('pesan',
				'<div class="alert alert-danger text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Gagal Menghapus Data</div>'
			);
			redirect($this->agent->referrer());
		}
	}

	public function negara()
	{
		$data = array(
			'title' => 'Kebangsaan', 
			'page' => 'negara',
			'data' => $this->my_model->negara(),
		);
		$this->load->view('template', $data);
	}

	public function insert_negara()
	{
		$data = array(
			'nama_negara' => $this->input->post('nama_negara'),
		);
		$res = $this->db->insert('m_negara', $data);
		if ($res>=1) {
			$this->session->set_flashdata('pesan',
				'<div class="alert alert-success text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Berhasil Menambah Data</div>'
			);
			redirect($this->agent->referrer());
		} else {
			$this->session->set_flashdata('pesan',
				'<div class="alert alert-danger text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Gagal Menambah Data</div>'
			);
			redirect($this->agent->referrer());
		}
	}

	public function update_negara()
	{
		$data = array(
			'nama_negara' => $this->input->post('nama_negara'),
		);
		$res = $this->db->update('m_negara', $data, array('id_negara' => $this->input->post('id_negara')));
		if ($res>=1) {
			$this->session->set_flashdata('pesan',
				'<div class="alert alert-success text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Berhasil Merubah Data</div>'
			);
			redirect($this->agent->referrer());
		} else {
			$this->session->set_flashdata('pesan',
				'<div class="alert alert-danger text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Gagal Merubah Data</div>'
			);
			redirect($this->agent->referrer());
		}
	}

	public function delete_negara()
	{
		$res = $this->db->delete('m_negara', array('id_negara' => $this->input->post('id_negara')));
		if ($res>=1) {
			$this->session->set_flashdata('pesan',
				'<div class="alert alert-success text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Berhasil Menghapus Data</div>'
			);
			redirect($this->agent->referrer());
		} else {
			$this->session->set_flashdata('pesan',
				'<div class="alert alert-danger text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Gagal Menghapus Data</div>'
			);
			redirect($this->agent->referrer());
		}
	}

	public function bandara()
	{
		$data = array(
			'title' => 'Lokasi',
			'page' => 'bandara',
			'kobu' => $this->my_model->kobu(),
			'data' => $this->my_model->bandara(),
		);
		$this->load->view('template', $data);
	}

	public function insert_bandara()
	{
		$data = array(
			'id_kobu' => $this->input->post('id_kobu'),
			'kode_bandara' => $this->input->post('kode_bandara'),
			'nama_bandara' => $this->input->post('nama_bandara'),
			'kota' => $this->input->post('kota'),
			'provinsi' => $this->input->post('provinsi'),
		);
		$res = $this->db->insert('m_bandara', $data);
		if ($res>=1) {
			$this->session->set_flashdata('pesan',
				'<div class="alert alert-success text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Berhasil Menambah Data</div>'
			);
			redirect($this->agent->referrer());
		} else {
			$this->session->set_flashdata('pesan',
				'<div class="alert alert-danger text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Gagal Menambah Data</div>'
			);
			redirect($this->agent->referrer());
		}
	}

	public function update_bandara()
	{
		$data = array(
			'id_kobu' => $this->input->post('id_kobu'),
			'kode_bandara' => $this->input->post('kode_bandara'),
			'nama_bandara' => $this->input->post('nama_bandara'),
			'kota' => $this->input->post('kota'),
			'provinsi' => $this->input->post('provinsi'),
		);
		$res = $this->db->update('m_bandara', $data, array('id_bandara' => $this->input->post('id_bandara')));
		if ($res>=1) {
			$this->session->set_flashdata('pesan',
				'<div class="alert alert-success text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Berhasil Merubah Data</div>'
			);
			redirect($this->agent->referrer());
		} else {
			$this->session->set_flashdata('pesan',
				'<div class="alert alert-danger text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Gagal Merubah Data</div>'
			);
			redirect($this->agent->referrer());
		}
	}

	public function delete_bandara()
	{
		$res = $this->db->delete('m_bandara', array('id_bandara' => $this->input->post('id_bandara')));
		if ($res>=1) {
			$this->session->set_flashdata('pesan',
				'<div class="alert alert-success text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Berhasil Menghapus Data</div>'
			);
			redirect($this->agent->referrer());
		} else {
			$this->session->set_flashdata('pesan',
				'<div class="alert alert-danger text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Gagal Menghapus Data</div>'
			);
			redirect($this->agent->referrer());
		}
	}

	public function instansi()
	{
		if ($this->session->userdata('kode_tipe_user')=='INS') {
			$model = $this->my_model->get_instansi();
		} else {
			$model = $this->my_model->instansi();
		}
		$data = array(
			'title' => 'Instansi',
			'page' => 'instansi',
			'data' => $model,
		);
		$this->load->view('template', $data);
	}

	public function insert_instansi()
	{
		$data = array(
			'nama_instansi' => $this->input->post('nama_instansi'),
			'alamat_instansi' => $this->input->post('alamat_instansi'),
			'kota' => $this->input->post('kota'),
			'provinsi' => $this->input->post('provinsi'),
		);
		$res = $this->db->insert('m_instansi', $data);
		if ($res>=1) {
			$this->session->set_flashdata('pesan',
				'<div class="alert alert-success text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Berhasil Menambah Data</div>'
			);
			redirect($this->agent->referrer());
		} else {
			$this->session->set_flashdata('pesan',
				'<div class="alert alert-danger text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Gagal Menambah Data</div>'
			);
			redirect($this->agent->referrer());
		}
	}

	public function update_instansi()
	{
		$data = array(
			'nama_instansi' => $this->input->post('nama_instansi'),
			'alamat_instansi' => $this->input->post('alamat_instansi'),
			'kota' => $this->input->post('kota'),
			'provinsi' => $this->input->post('provinsi'),
		);
		$res = $this->db->update('m_instansi', $data, array('id_instansi' => $this->input->post('id_instansi')));
		if ($res>=1) {
			$this->session->set_flashdata('pesan',
				'<div class="alert alert-success text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Berhasil Merubah Data</div>'
			);
			redirect($this->agent->referrer());
		} else {
			$this->session->set_flashdata('pesan',
				'<div class="alert alert-danger text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Gagal Merubah Data</div>'
			);
			redirect($this->agent->referrer());
		}
	}

	public function delete_instansi()
	{
		$res = $this->db->delete('m_instansi', array('id_instansi' => $this->input->post('id_instansi')));
		if ($res>=1) {
			$this->session->set_flashdata('pesan',
				'<div class="alert alert-success text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Berhasil Menghapus Data</div>'
			);
			redirect($this->agent->referrer());
		} else {
			$this->session->set_flashdata('pesan',
				'<div class="alert alert-danger text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Gagal Menghapus Data</div>'
			);
			redirect($this->agent->referrer());
		}
	}

	public function rating()
	{
		$data = array(
			'title' => 'Rating',
			'page' => 'rating',
			'data' => $this->my_model->rating(),
		);
		$this->load->view('template', $data);
	}

	public function insert_rating()
	{
		$data = array(
			'kode_rating' => $this->input->post('kode_rating'),
			'nama_rating' => $this->input->post('nama_rating'),
		);
		$res = $this->db->insert('m_rating', $data);
		if ($res>=1) {
			$this->session->set_flashdata('pesan',
				'<div class="alert alert-success text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Berhasil Menambah Data</div>'
			);
			redirect($this->agent->referrer());
		} else {
			$this->session->set_flashdata('pesan',
				'<div class="alert alert-danger text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Gagal Menambah Data</div>'
			);
			redirect($this->agent->referrer());
		}
	}

	public function update_rating()
	{
		$data = array(
			'kode_rating' => $this->input->post('kode_rating'),
			'nama_rating' => $this->input->post('nama_rating'),
		);
		$res = $this->db->update('m_rating', $data, array('id_rating' => $this->input->post('id_rating')));
		if ($res>=1) {
			$this->session->set_flashdata('pesan',
				'<div class="alert alert-success text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Berhasil Merubah Data</div>'
			);
			redirect($this->agent->referrer());
		} else {
			$this->session->set_flashdata('pesan',
				'<div class="alert alert-danger text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Gagal Merubah Data</div>'
			);
			redirect($this->agent->referrer());
		}
	}

	public function delete_rating()
	{
		$res = $this->db->delete('m_rating', array('id_rating' => $this->input->post('id_rating')));
		if ($res>=1) {
			$this->session->set_flashdata('pesan',
				'<div class="alert alert-success text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Berhasil Menghapus Data</div>'
			);
			redirect($this->agent->referrer());
		} else {
			$this->session->set_flashdata('pesan',
				'<div class="alert alert-danger text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Gagal Menghapus Data</div>'
			);
			redirect($this->agent->referrer());
		}
	}

	// public function tipe_soal()
	// {
	// 	$data = array(
	// 		'title' => 'Tipe Soal',
	// 		'page' => 'tipe_soal',
	// 		'data' => $this->my_model->m_tipe_soal(),
	// 	);
	// 	$this->load->view('template', $data);
	// }

	// public function insert_tipe_soal()
	// {
	// 	$data = array(
	// 		'nama_tipe_soal' => $this->input->post('nama_tipe_soal'),
	// 		'jml_soal_pilihan_ganda' => $this->input->post('jml_soal_pilihan_ganda'),
	// 		'jml_soal_essay' => $this->input->post('jml_soal_essay'),
	// 		'jml_soal_bs' => $this->input->post('jml_soal_bs'),
	// 		'jml_soal_isian_singkat' => $this->input->post('jml_soal_isian_singkat'),
	// 	);
	// 	$res = $this->db->insert('m_tipe_soal', $data);
	// 	if ($res>=1) {
	// 		$this->session->set_flashdata('pesan',
	// 			'<div class="alert alert-success text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Berhasil Menambah Data</div>'
	// 		);
	// 		redirect('tipe-soal');
	// 	} else {
	// 		$this->session->set_flashdata('pesan',
	// 			'<div class="alert alert-danger text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Gagal Menambah Data</div>'
	// 		);
	// 		redirect('tipe-soal');
	// 	}
	// }

	// public function update_tipe_soal()
	// {
	// 	$data = array(
	// 		'nama_tipe_soal' => $this->input->post('nama_tipe_soal'),
	// 		'jml_soal_pilihan_ganda' => $this->input->post('jml_soal_pilihan_ganda'),
	// 		'jml_soal_essay' => $this->input->post('jml_soal_essay'),
	// 		'jml_soal_bs' => $this->input->post('jml_soal_bs'),
	// 		'jml_soal_isian_singkat' => $this->input->post('jml_soal_isian_singkat'),
	// 	);
	// 	$res = $this->db->update('m_tipe_soal', $data, array('idx' => $this->input->post('idx')));
	// 	if ($res>=1) {
	// 		$this->session->set_flashdata('pesan',
	// 			'<div class="alert alert-success text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Berhasil Merubah Data</div>'
	// 		);
	// 		redirect('tipe-soal');
	// 	} else {
	// 		$this->session->set_flashdata('pesan',
	// 			'<div class="alert alert-danger text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Gagal Merubah Data</div>'
	// 		);
	// 		redirect('tipe-soal');
	// 	}
	// }

	// public function delete_tipe_soal()
	// {
	// 	$res = $this->db->delete('m_tipe_soal', array('idx' => $this->input->post('idx')));
	// 	if ($res>=1) {
	// 		$this->session->set_flashdata('pesan',
	// 			'<div class="alert alert-success text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Berhasil Menghapus Data</div>'
	// 		);
	// 		redirect('tipe-soal');
	// 	} else {
	// 		$this->session->set_flashdata('pesan',
	// 			'<div class="alert alert-danger text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Gagal Menghapus Data</div>'
	// 		);
	// 		redirect('tipe-soal');
	// 	}
	// }

	public function pimpinan()
	{
		$data = array(
			'title' => 'Pimpinan',
			'page' => 'pimpinan',
			'data' => $this->my_model->pimpinan(),
		);
		$this->load->view('template', $data);
	}

	public function insert_pimpinan()
	{
		$data = array(
			'nip' => $this->input->post('nip'),
			'nama_pimpinan' => $this->input->post('nama_pimpinan'),
			'posisi' => $this->input->post('posisi'),
		);
		$res = $this->db->insert('m_pimpinan', $data);
		if ($res>=1) {
			$this->session->set_flashdata('pesan',
				'<div class="alert alert-success text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Berhasil Menambah Data</div>'
			);
			redirect($this->agent->referrer());
		} else {
			$this->session->set_flashdata('pesan',
				'<div class="alert alert-danger text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Gagal Menambah Data</div>'
			);
			redirect($this->agent->referrer());
		}
	}

	public function update_pimpinan()
	{
		$data = array(
			'nip' => $this->input->post('nip'),
			'nama_pimpinan' => $this->input->post('nama_pimpinan'),
			'posisi' => $this->input->post('posisi'),
		);
		$res = $this->db->update('m_pimpinan', $data, array('id_pimpinan' => $this->input->post('id_pimpinan')));
		if ($res>=1) {
			$this->session->set_flashdata('pesan',
				'<div class="alert alert-success text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Berhasil Merubah Data</div>'
			);
			redirect($this->agent->referrer());
		} else {
			$this->session->set_flashdata('pesan',
				'<div class="alert alert-danger text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Gagal Merubah Data</div>'
			);
			redirect($this->agent->referrer());
		}
	}

	public function delete_pimpinan()
	{
		$res = $this->db->delete('m_pimpinan', array('id_pimpinan' => $this->input->post('id_pimpinan')));
		if ($res>=1) {
			$this->session->set_flashdata('pesan',
				'<div class="alert alert-success text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Berhasil Menghapus Data</div>'
			);
			redirect($this->agent->referrer());
		} else {
			$this->session->set_flashdata('pesan',
				'<div class="alert alert-danger text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Gagal Menghapus Data</div>'
			);
			redirect($this->agent->referrer());
		}
	}
	// End Master Data

	// Manajemen User
	public function user()
	{
		$data = array(
			'title' => 'List User', 
			'page' => 'user',
			'data' => $this->my_model->user(),
		);
		$this->load->view('template', $data);
	}

	public function tambah_user()
	{
		$data = array(
			'title' => 'Tambah User', 
			'page' => 'tambah_user',
			'tipe' => $this->my_model->tipe_user(),
			'instansi' => $this->my_model->instansi(),
		);
		$this->load->view('template', $data);
	}

	public function insert_user()
	{
		if ($this->input->post('id_tipe')==2) {
			$this->form_validation->set_rules('nama', 'nama', 'required');
			$this->form_validation->set_rules('id_tipe', 'id_tipe', 'required');
			$this->form_validation->set_rules('id_instansi', 'id_instansi', 'required');
			$this->form_validation->set_rules('alamat', 'alamat', 'required');
			$this->form_validation->set_rules('no_telp', 'no_telp', '');
			// $this->form_validation->set_rules('no_hp', 'no_hp', 'required');
			$this->form_validation->set_rules('email', 'email', 'required|is_unique[m_user.email]');
			$this->form_validation->set_rules('username', 'username', 'required|is_unique[m_user.username]');
			$this->form_validation->set_rules('password', 'password', 'required|matches[ulangi_password]');
			$this->form_validation->set_rules('ulangi_password', 'ulangi_password', 'required|matches[password]');
			if ($this->form_validation->run() == FALSE) {
				$this->tambah_user();
			} else {
				$name = 'surat-keterangan-'.$this->input->post('nama').'-'.uniqid();
				$config['upload_path'] = './assets/file/';
				$config['allowed_types'] = 'pdf';
				$config['file_name'] = $name;

				$this->upload->initialize($config);

				if ( ! $this->upload->do_upload())
				{
					$error = array('error' => $this->upload->display_errors());
					$this->session->set_flashdata('pesan',
						'<div class="alert alert-danger text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						Gagal menambah data, format file disarakankan pdf, silahkan ulangi kembali</div>'
					);
					redirect($this->agent->referrer(), $error);
				} else {	
					$file = $this->upload->data();
					$data = array( 
						'nama' => $this->input->post('nama'), 
						'id_tipe' => $this->input->post('id_tipe'),  
						'id_instansi' => $this->input->post('id_instansi'),  
						'alamat' => $this->input->post('alamat'),
						'no_telp' => $this->input->post('no_telp'),  
						// 'no_hp' => $this->input->post('no_hp'),
						'email' => $this->input->post('email'),
						'username' => $this->input->post('username'),
						'password' => md5($this->input->post('password')),
						'status' => $this->input->post('status'),
						'surat_keterangan' => $file['file_name'],
					);
					$res = $this->db->insert('m_user', $data);
					if ($res>=1) {
						$this->session->set_flashdata('pesan',
							'<div class="alert alert-info text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							Berhasil menambah data</div>'
						);
						redirect('user');
					} else {
						$this->session->set_flashdata('danger',
							'<div class="alert alert-danger text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							Gagal menambah data, silahkan ulangi kembali</div>'
						);
						redirect($this->agent->referrer());
					}
				}
			}
		} else {
			$this->form_validation->set_rules('nama', 'nama', 'required');
			$this->form_validation->set_rules('id_tipe', 'id_tipe', 'required');
			$this->form_validation->set_rules('alamat', 'alamat', 'required');
			$this->form_validation->set_rules('no_telp', 'no_telp', '');
			// $this->form_validation->set_rules('no_hp', 'no_hp', 'required');
			$this->form_validation->set_rules('email', 'email', 'required|is_unique[m_user.email]');
			$this->form_validation->set_rules('username', 'username', 'required|is_unique[m_user.username]');
			$this->form_validation->set_rules('password', 'password', 'required|matches[ulangi_password]');
			$this->form_validation->set_rules('ulangi_password', 'ulangi_password', 'required|matches[password]');
			if ($this->form_validation->run() == FALSE) {
				$this->tambah_user();
			} else {
				$data = array( 
					'nama' => $this->input->post('nama'), 
					'id_tipe' => $this->input->post('id_tipe'),  
					'alamat' => $this->input->post('alamat'),
					'no_telp' => $this->input->post('no_telp'),  
					// 'no_hp' => $this->input->post('no_hp'),
					'email' => $this->input->post('email'),
					'username' => $this->input->post('username'),
					'password' => md5($this->input->post('password')),
					'status' => $this->input->post('status'),
				);
				$res = $this->db->insert('m_user', $data);
				if ($res>=1) {
					$this->session->set_flashdata('pesan',
						'<div class="alert alert-info text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Berhasil menambah data</div>'
					);
					redirect('user');
				} else {
					$this->session->set_flashdata('pesan',
						'<div class="alert alert-danger text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Gagal menambah data, silahkan ulangi kembali</div>'
					);
					redirect($this->agent->referrer());
				}
			}
		}
	}

	public function update_user()
	{
		$this->form_validation->set_rules('nama', 'nama', 'required');
		$this->form_validation->set_rules('alamat', 'alamat', 'required');
		$this->form_validation->set_rules('no_telp', 'no_telp', '');
		$this->form_validation->set_rules('email', 'email', 'required');
		$this->form_validation->set_rules('password', 'password', 'matches[ulangi_password]');
		$this->form_validation->set_rules('ulangi_password', 'ulangi_password', 'matches[password]');
		if ($this->form_validation->run() == FALSE) {
			$this->user();
		} else {
			if ($this->input->post('password')!='') {
				$data = array( 
					'nama' => $this->input->post('nama'),    
					'alamat' => $this->input->post('alamat'),
					'no_telp' => $this->input->post('no_telp'),
					'email' => $this->input->post('email'),
					'password' => md5($this->input->post('password')), 
					'status' => $this->input->post('status'),
				);
			} else {
				$data = array( 
					'nama' => $this->input->post('nama'),    
					'alamat' => $this->input->post('alamat'),
					'no_telp' => $this->input->post('no_telp'),
					'email' => $this->input->post('email'), 
					'status' => $this->input->post('status'),
				);
			}
			$res = $this->db->update('m_user', $data, array('id_user' => $this->input->post('id_user')));
			if ($res>=1) {
				$this->session->set_flashdata('pesan',
					'<div class="alert alert-success text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Berhasil merubah data</div>'
				);
				if ($this->input->post('status')==1) {
					$ci = get_instance();
					$ci->load->library('email');
					$config['protocol'] = "smtp";
					$config['smtp_host'] = "mail.smtp2go.com";
					$config['smtp_port'] = "2525";
					$config['smtp_user'] = "cah.selodev@gmail.com"; 
					$config['smtp_pass'] = "akuada170312";
					$config['charset'] = "utf-8";
					$config['mailtype'] = "html";
					$config['newline'] = "\r\n";
					$ci->email->initialize($config);
					$link = base_url('auth/');
					$ci->email->from('cah.selodev@gmail.com', 'Direktorat Jendral Perhubungan Udara');
					$ci->email->to($this->input->post('email'));
					$ci->email->subject('Informasi Registrasi | Direktorat Jendral Perhubungan Udara');
					$ci->email->message('Hi, '.' '.$this->input->post('nama').' '.'akun anda sudah aktif, sekarang anda dapat masuk dengan akun yang telah anda daftarkan'.'<br/>'.$link.'<br>'.'<b>Salam Admin</b>');
					$ci->email->send();
				}
				redirect($this->agent->referrer());
			} else {
				$this->session->set_flashdata('danger',
					'<div class="alert alert-danger text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Gagal merubah data, silahkan periksa & ulangi kembali</div>'
				);
				redirect($this->agent->referrer());
			}
		}
	}

	public function delete_user()
	{
		$this->db->where('id_user', $this->input->post('id_user'));
		$query = $this->db->get('m_user');
		$row = $query->row();
		unlink("./assets/file/$row->surat_keterangan");
		$res = $this->db->delete('m_user', array('id_user' => $this->input->post('id_user')));
		if ($res>=1) {
			$this->session->set_flashdata('pesan',
				'<div class="alert alert-success text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				Berhasil Menghapus Data</div>'
			);
			redirect($this->agent->referrer());
		} else {
			$this->session->set_flashdata('danger',
				'<div class="alert alert-danger text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				Gagal Menghapus Data</div>'
			);
			redirect($this->agent->referrer());
		}
	}

	public function tipe_user()
	{
		$data = array(
			'title' => 'Tipe User', 
			'page' => 'tipe_user',
			'data' => $this->my_model->tipe_user(),
		);
		$this->load->view('template', $data);
	}

	public function insert_tipe_user()
	{
		$data = array(
			'nama_tipe' => $this->input->post('nama_tipe'),
		);
		$res = $this->db->insert('m_tipe', $data);
		if ($res>=1) {
			$this->session->set_flashdata('pesan',
				'<div class="alert alert-success text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Berhasil Menambah Data</div>'
			);
			redirect($this->agent->referrer());
		} else {
			$this->session->set_flashdata('pesan',
				'<div class="alert alert-danger text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Gagal Menambah Data</div>'
			);
			redirect($this->agent->referrer());
		}
	}

	public function update_tipe_user()
	{
		$data = array(
			'nama_tipe' => $this->input->post('nama_tipe'),
		);
		$res = $this->db->update('m_tipe', $data, array('id_tipe' => $this->input->post('id_tipe')));
		if ($res>=1) {
			$this->session->set_flashdata('pesan',
				'<div class="alert alert-success text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Berhasil Merubah Data</div>'
			);
			redirect($this->agent->referrer());
		} else {
			$this->session->set_flashdata('pesan',
				'<div class="alert alert-danger text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Gagal Merubah Data</div>'
			);
			redirect($this->agent->referrer());
		}
	}

	public function delete_tipe_user()
	{
		$res = $this->db->delete('m_tipe', array('id_tipe' => $this->input->post('id_tipe')));
		if ($res>=1) {
			$this->session->set_flashdata('pesan',
			'<div class="alert alert-success text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			Berhasil Menghapus Data</div>'
		);
		redirect($this->agent->referrer());
		}else{
			$this->session->set_flashdata('pesan',
			'<div class="alert alert-danger text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			Gagal Menghapus Data</div>'
		);
		redirect($this->agent->referrer());
		}
	}
	// End Manajemen User

	// Laporan
	public function laporan()
	{
		$data = array(
			'title' => 'Laporan', 
			'page' => 'laporan',
			'data' => $this->my_model->laporan(),
		);
		$this->load->view('template', $data);
	}

	public function berita_acara()
	{
		$data = array(
			'title' => 'Berita Acara', 
			'page' => 'berita_acara',
			'data' => $this->my_model->laporan(),
		);
		$this->load->view('berita_acara', $data);
	}

	public function cetak_kartu()
	{
		$data = array(
			'title' => 'Cetak Kartu', 
			'page' => 'cetak_kartu',
			'data' => $this->my_model->get_laporan(),
		);
		$this->load->view('cetak_kartu', $data);
	}

	public function cetak_buku()
	{
		$data = array(
			'title' => 'Cetak Buku', 
			'page' => 'cetak_buku',
			'data' => $this->my_model->get_laporan(),
		);
		$this->load->view('cetak_buku', $data);
	}
	// End Laporan

	// Profile
	public function profile()
	{
		$data = array(
			'title' => 'Profile', 
			'page' => 'profile',
			'data' => $this->my_model->profile(),
		);
		$this->load->view('template', $data);
	}

	public function update_profile()
	{
		$this->form_validation->set_rules('nama', 'nama', 'required');
		$this->form_validation->set_rules('alamat', 'alamat', 'required');
		$this->form_validation->set_rules('no_telp', 'no_telp', '');
		$this->form_validation->set_rules('email', 'email', 'required');
		$this->form_validation->set_rules('password', 'password', 'matches[ulangi_password]');
		$this->form_validation->set_rules('ulangi_password', 'ulangi_password', 'matches[password]');
		if ($this->form_validation->run() == FALSE) {
			$this->profile();
		} else {
			if ($this->input->post('password')!='') {
				$data = array( 
					'nama' => $this->input->post('nama'),   
					'alamat' => $this->input->post('alamat'),
					'no_telp' => $this->input->post('no_telp'),
					'email' => $this->input->post('email'),
					'password' => md5($this->input->post('password')), 
					'status' => $this->input->post('status'),
				);
			} else {
				$data = array( 
					'nama' => $this->input->post('nama'),   
					'alamat' => $this->input->post('alamat'),
					'no_telp' => $this->input->post('no_telp'),
					'email' => $this->input->post('email'), 
					'status' => $this->input->post('status'),
				);
			}
			$res = $this->db->update('m_user', $data, array('id_user' => $this->input->post('id_user')));
			if ($res>=1) {
				$this->session->set_flashdata('pesan',
					'<div class="alert alert-success text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Berhasil merubah data</div>'
				);
				redirect($this->agent->referrer());
			} else {
				$this->session->set_flashdata('danger',
					'<div class="alert alert-danger text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Gagal merubah data, silahkan periksa & ulangi kembali</div>'
				);
				redirect($this->agent->referrer());
			}
		}
	}
	// End Profile
}