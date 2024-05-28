<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		cek_login();
	}

	public function index()
	{
		$data['judul'] = "Dashboard";
		$data['jurusan'] = $this->db->get('jurusan')->num_rows();
		$data['kelas'] = $this->db->get('kelas')->num_rows();
		$data['siswa'] = $this->db->get('siswa')->num_rows();
		$data['petugas'] = $this->db->get('user')->num_rows();

		$this->load->view('template/header', $data);
		$this->load->view('dashboard', $data);
		$this->load->view('template/footer');
	}
}
