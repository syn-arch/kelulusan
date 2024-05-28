<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		cek_login();
		$this->load->model('Profil_m','pm');
	}

	public function index()
	{
		$data['judul'] = "Profil Saya";
		$data['profil'] = $this->pm->get_profile();

		$this->load->view('template/header', $data, FALSE);		
		$this->load->view('profil/index', $data, FALSE);		
		$this->load->view('template/footer', $data, FALSE);		
	}

	public function ubah()
	{
		$data['judul'] = "Ubah Profil";
		$data['profil'] = $this->pm->get_profile();

		$valid = $this->form_validation;

		$valid->set_rules('nama_petugas', 'Nama Petugas', 'required');
		$valid->set_rules('alamat', 'Alamat', 'required');
		$valid->set_rules('telepon', 'Telepon', 'required');
		$valid->set_rules('email', 'E-mail', 'required|valid_email');
		$valid->set_rules('jk', 'Jenis Kelamin', 'required');

		if ($valid->run()) {
			$this->pm->update_profile();
			$this->session->set_flashdata('pesan', 'diubah');
			redirect('profil/ubah','refresh');
		}
		
		$this->load->view('template/header', $data, FALSE);		
		$this->load->view('profil/ubah', $data, FALSE);		
		$this->load->view('template/footer', $data, FALSE);		
	}

	public function ubah_login()
	{
		$this->form_validation->set_rules('username','Username','required');

		if ($this->form_validation->run()) {
			$this->pm->update_login();
			$this->session->set_flashdata('pesan', 'diubah');
			redirect('profil/ubah','refresh');
		}

		$data['judul'] = "Ubah Profil";
		$data['profil'] = $this->pm->get_profile();
		
		$this->load->view('template/header', $data, FALSE);		
		$this->load->view('profil/ubah', $data, FALSE);		
		$this->load->view('template/footer', $data, FALSE);		
	}

	public function ubah_password()
	{
		$data['judul'] = "Ubah Password";

		$valid = $this->form_validation;

		$valid->set_rules('password_lama', 'Password Lama', 'required');
		$valid->set_rules('password_baru', 'Password Baru', 'required|matches[konfirmasi_password_baru]');
		$valid->set_rules('konfirmasi_password_baru', 'Konfirmasi Password Baru', 'required|matches[password_baru]');

		if ($valid->run()) {
			$this->pm->change_password();
			$this->session->set_flashdata('pesan', 'diubah');
			redirect('profil/ubah_password','refresh');
		}
		
		$this->load->view('template/header', $data, FALSE);		
		$this->load->view('profil/ubah_password', $data, FALSE);		
		$this->load->view('template/footer', $data, FALSE);		
	}

}

/* End of file Profil.php */
/* Location: ./application/controllers/Profil.php */ ?>