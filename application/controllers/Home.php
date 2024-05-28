<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$this->load->view('public/index');
	}

	public function cek()
	{
		$this->load->view('public/cek');
	}

	public function cek_kelulusan()
	{
		$post = $this->input->post();

		$this->db->select('*');
		$this->db->join('siswa', 'id_siswa');
		$this->db->where('tgl', $post['tgl']);
		$this->db->where('no_peserta_ujian', $post['no_peserta_ujian']);
		echo json_encode($this->db->get('kelulusan')->row_array());
	}
}
