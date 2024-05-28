<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jurusan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('datatables');
		$this->load->model('Jurusan_m','jm');
		cek_login();
	}

	public function index()
	{
		$data['judul'] = "Data Jurusan";
		$data['role'] = $this->jm->get_jurusan();

		$this->load->view('template/header', $data);
		$this->load->view('master/jurusan/index', $data);
		$this->load->view('template/footer');
	}

	public function hapus($id='')
	{
		$this->jm->delete($id);
		$this->session->set_flashdata('pesan', 'dihapus');
		redirect('master/jurusan','refresh');
	}

	function get_jurusan_json() {
		header('Content-Type: application/json');
		echo $this->jm->get_all_jurusan();
	}

	public function tambah()
	{
		$valid = $this->form_validation;
		$valid->set_rules('nama_jurusan','Nama Jurusan','required');
		$valid->set_rules('singkatan','Singkatan','required');

		if ($valid->run()) {
			$this->jm->insert();
			$this->session->set_flashdata('pesan', 'ditambah');
			redirect('master/jurusan','refresh');
		}

		$data['judul'] = "Tambah Jurusan";

		$this->load->view('template/header', $data);
		$this->load->view('master/jurusan/tambah', $data);
		$this->load->view('template/footer');
	}

	public function get_jurusan($id = '')
	{
		echo json_encode($this->jm->get_jurusan($id));
	}

	public function ubah($id_jurusan)
	{
		$valid = $this->form_validation;
		$valid->set_rules('nama_jurusan','Nama Jurusan','required');
		$valid->set_rules('singkatan','Singkatan','required');

		if ($valid->run()) {
			$this->jm->update($id_jurusan);
			$this->session->set_flashdata('pesan', 'diubah');
			redirect('master/jurusan','refresh');
		}

		$data['judul'] = "Ubah Jurusan";
		$data['jurusan'] = $this->jm->get_jurusan($id_jurusan);

		$this->load->view('template/header', $data);
		$this->load->view('master/jurusan/ubah', $data);
		$this->load->view('template/footer');
	}

}
