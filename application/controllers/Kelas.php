<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class kelas extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('datatables');
		$this->load->model('kelas_m','km');
		$this->load->model('jurusan_m','jm');
		cek_login();
	}

	public function index()
	{
		$data['judul'] = "Data Kelas";
		$data['kelas'] = $this->km->get_kelas();

		$this->load->view('template/header', $data);
		$this->load->view('master/kelas/index', $data);
		$this->load->view('template/footer');
	}

	public function hapus($id='')
	{
		$this->km->delete($id);
		$this->session->set_flashdata('pesan', 'dihapus');
		redirect('master/kelas','refresh');
	}

	public function tambah()
	{
		$valid = $this->form_validation;
		$valid->set_rules('nama_kelas','Nama kelas','required');
		$valid->set_rules('id_jurusan','Jurusan','required');

		if ($valid->run()) {
			$this->km->insert();
			$this->session->set_flashdata('pesan', 'ditambah');
			redirect('master/kelas','refresh');
		}

		$data['judul'] = "Tambah kelas";
		$data['jurusan'] = $this->jm->get_jurusan();

		$this->load->view('template/header', $data);
		$this->load->view('master/kelas/tambah', $data);
		$this->load->view('template/footer');
	}

	public function get_kelas($id = '')
	{
		echo json_encode($this->km->get_kelas($id));
	}

	public function ubah($id_kelas)
	{
		$valid = $this->form_validation;
		$valid->set_rules('nama_kelas','Nama kelas','required');
		$valid->set_rules('id_jurusan','Jurusan','required');

		if ($valid->run()) {
			$this->km->update($id_kelas);
			$this->session->set_flashdata('pesan', 'diubah');
			redirect('master/kelas','refresh');
		}

		$data['judul'] = "Ubah kelas";
		$data['jurusan'] = $this->jm->get_jurusan();
		$data['kelas'] = $this->km->get_kelas($id_kelas);

		$this->load->view('template/header', $data);
		$this->load->view('master/kelas/ubah', $data);
		$this->load->view('template/footer');
	}

}
