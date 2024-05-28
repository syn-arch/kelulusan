<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class siswa extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('datatables');
		$this->load->model('Siswa_m','sm');
		$this->load->model('Jurusan_m','jm');
		$this->load->model('Kelas_m','km');
		cek_login();
	}

	public function index()
	{
		$data['judul'] = "Data Siswa";
		$data['siswa'] = $this->sm->get_siswa();

		$this->load->view('template/header', $data);
		$this->load->view('master/siswa/index', $data);
		$this->load->view('template/footer');
	}
	
    public function hapus_bulk()
    {
    	foreach($_POST["id_siswa"] as $id)
        {
        	$this->db->delete('siswa', ['id_siswa' => $id]);
        }
    }

	public function hapus($id='')
	{
		$this->sm->delete($id);
		$this->session->set_flashdata('pesan', 'dihapus');
		redirect('master/siswa','refresh');
	}

	function get_siswa_json() {
		header('Content-Type: application/json');
		echo $this->sm->get_all_siswa();
	}

	public function tambah()
	{
		$valid = $this->form_validation;
		$valid->set_rules('nama_siswa', 'nama siswa', 'required');
		$valid->set_rules('nis', 'nis', 'required');
		$valid->set_rules('jk', 'jk', 'required');
		$valid->set_rules('id_jurusan', 'jurusan', 'required');
		$valid->set_rules('id_kelas', 'kelas', 'required');
		$valid->set_rules('no_peserta_ujian', 'no peserta ujian', 'required');

		if ($valid->run()) {
			$this->sm->insert();
			$this->session->set_flashdata('pesan', 'ditambah');
			redirect('master/siswa','refresh');
		}

		$data['judul'] = "Tambah Siswa";
		$data['jurusan'] = $this->jm->get_jurusan();
		$data['kelas'] = $this->km->get_kelas();

		$this->load->view('template/header', $data);
		$this->load->view('master/siswa/tambah', $data);
		$this->load->view('template/footer');
	}

	public function ubah($id_siswa)
	{
		$valid = $this->form_validation;
		$valid->set_rules('nama_siswa','Nama Siswa','required');

		if ($valid->run()) {
			$this->sm->update($id_siswa);
			$this->session->set_flashdata('pesan', 'diubah');
			redirect('master/siswa','refresh');
		}

		$data['judul'] = "Ubah Siswa";
		$data['siswa'] = $this->sm->get_siswa($id_siswa);
		$data['kelas'] = $this->km->get_kelas();
		$data['jurusan'] = $this->jm->get_jurusan();

		$this->load->view('template/header', $data);
		$this->load->view('master/siswa/ubah', $data);
		$this->load->view('template/footer');
	}

}