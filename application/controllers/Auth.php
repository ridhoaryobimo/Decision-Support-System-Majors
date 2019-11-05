<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function index()
	{
		$data = array(
			'title' => 'Login',
		);
		$this->load->view('admin/login', $data);
	}

	public function login()
	{
		$data = array (
			'username' => $this->input->post('username', TRUE),
			'password' => md5($this->input->post('password', TRUE))
		);
		$hasil = $this->my_model->masuk_admin($data);
		if ($hasil->num_rows() == 1) {
			foreach ($hasil->result() as $sess) {
				$sess_data['logged_in'] = 'Sudah Login';
				$sess_data['id_admin'] = $sess->id_admin;
				$sess_data['nama_admin'] = $sess->nama_admin;
				$this->session->set_userdata($sess_data);
			}
			$data = array(
				'last_login' => date('d/m/Y - h:i:s'), 
			);
			$this->db->update('admin', $data, array('id_admin' => $sess->id_admin));
			$sess_data2['last_login'] = $sess->last_login;
			$this->session->set_userdata($sess_data2);
			redirect('admin');
		}
		$this->session->set_flashdata('pesan', 
			'<div class="alert alert-danger text-center"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> Username & Password Salah</div>'
		);
		redirect('auth');
	}
}