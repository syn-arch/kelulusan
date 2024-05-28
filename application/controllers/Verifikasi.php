<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class verifikasi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		cek_login();
		$this->load->library('datatables');
		$this->load->model('siswa_m','sm');
		$this->load->model('verifikasi_m','vm');
	}

	public function index()
	{
		$data['judul'] = "Verifikasi Kelulusan";
		$data['verifikasi'] = $this->vm->get_verifikasi();

		$this->load->view('template/header', $data);
		$this->load->view('kelulusan/verifikasi/index', $data);
		$this->load->view('template/footer');
	}

	public function hapus($id='')
	{
		$this->vm->delete($id);
		$this->session->set_flashdata('pesan', 'dihapus');
		redirect('kelulusan/verifikasi','refresh');
	}

	function get_verifikasi_json() {
		header('Content-Type: application/json');
		echo $this->vm->get_all_verifikasi();
	}

	public function verifikasi($id_siswa, $id_kelulusan)
	{
		$valid = $this->form_validation;
		$valid->set_rules('id_siswa', 'siswa', 'required');
		$valid->set_rules('status_lulus', 'Status Kelulusan', 'required');

		if ($valid->run()) {
			$this->vm->verifikasi($id_kelulusan);
			$this->session->set_flashdata('pesan', 'diverifikasi');
			redirect('kelulusan/verifikasi','refresh');
		}

		$data['judul'] = "Verifikasi Kelulusan";
		$data['siswa'] = $this->vm->get_siswa($id_siswa);

		$this->load->view('template/header', $data);
		$this->load->view('kelulusan/verifikasi/verifikasi', $data);
		$this->load->view('template/footer');
	}


}