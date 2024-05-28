<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function index()
	{
		if ($this->session->userdata('login')) {
			redirect('dashboard','refresh');
		}

		$valid = $this->form_validation;

		$valid->set_rules('email', 'email', 'required');
		$valid->set_rules('password', 'Password', 'required');

		if ($valid->run() == TRUE) {

			$post = $this->input->post();

			$email = $post['email'];
			$password = $post['password'];

					$this->db->join('petugas', 'id_user');
			$user = $this->db->get_where('user', ['email' => $email])->row_array();

			if ($user) {

				if (password_verify($password, $user['password'])) {

					$data = [
						'login' => true,
						'id_user' => $user['id_user'],
						'id_role' => $user['id_role'],
						'nama_petugas' => $user['nama_petugas'],
						'gambar' => $user['gambar']
					];

					$this->session->set_userdata($data);

					redirect('dashboard','refresh');
					
				}else{
					$this->session->set_flashdata('error', 'email atau password anda salah!');
					redirect('login','refresh');
				}
				
			}else{
				$this->session->set_flashdata('error', 'email atau password anda salah!');
				redirect('login','refresh');
			}

		}

		$this->load->view('auth/login');
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('login','refresh');
	}
}
