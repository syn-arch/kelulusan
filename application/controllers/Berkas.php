<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class berkas extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('datatables');
		$this->load->model('siswa_m','sm');
		$this->load->model('berkas_m','bm');
		cek_login();
	}

	public function index()
	{
		$data['judul'] = "Berkas Kelulusan Siswa";
		$data['berkas'] = $this->bm->get_berkas();

		$this->load->view('template/header', $data);
		$this->load->view('kelulusan/berkas/index', $data);
		$this->load->view('template/footer');
	}

	public function hapus($id='')
	{
		$this->bm->delete($id);
		$this->session->set_flashdata('pesan', 'dihapus');
		redirect('kelulusan/berkas','refresh');
	}

	function get_berkas_json() {
		header('Content-Type: application/json');
		
		if($this->db->get_where('user', ['id_user' => $this->session->userdata('id_user')])->row_array()['petugas']){
		    echo $this->bm->get_berkas_petugas();
		}else{
		    echo $this->bm->get_all_berkas();    
		}
		
		
	}

	public function tambah()
	{
		$valid = $this->form_validation;
		$valid->set_rules('id_siswa', 'siswa', 'required');
		if (empty($_FILES['berkas']['name'])) {
			$valid->set_rules('berkas', 'berkas', 'required');
		}

		if ($valid->run()) {
			$this->bm->insert();
			$this->session->set_flashdata('pesan', 'ditambah');
			redirect('kelulusan/berkas','refresh');
		}

		$data['judul'] = "Tambah berkas";
		$data['siswa'] = $this->sm->get_siswa();

		$this->load->view('template/header', $data);
		$this->load->view('kelulusan/berkas/tambah', $data);
		$this->load->view('template/footer');
	}

	public function tambah_berkas($id_siswa)
	{
		$valid = $this->form_validation;
		$valid->set_rules('id_siswa', 'siswa', 'required');
		if (empty($_FILES['berkas']['name'])) {
			$valid->set_rules('berkas', 'berkas', 'required');
		}

		if ($valid->run()) {
			$this->bm->insert();
			$this->session->set_flashdata('pesan', 'ditambah');
			redirect('kelulusan/berkas','refresh');
		}

		$data['judul'] = "Tambah berkas";
		$data['siswa'] = $this->sm->get_siswa($id_siswa);

		$this->load->view('template/header', $data);
		$this->load->view('kelulusan/berkas/tambah_berkas', $data);
		$this->load->view('template/footer');
	}

	public function ubah($id)
	{
		$valid = $this->form_validation;
		$valid->set_rules('id_siswa', 'siswa', 'required');

		if ($valid->run()) {
			$this->bm->update($id);
			$this->session->set_flashdata('pesan', 'diubah');
			redirect('kelulusan/berkas','refresh');
		}

		$data['judul'] = "Ubah berkas";
		$data['berkas'] = $this->bm->get_berkas($id);
		$data['siswa'] = $this->sm->get_siswa();

		$this->load->view('template/header', $data);
		$this->load->view('kelulusan/berkas/ubah', $data);
		$this->load->view('template/footer');
	}

}