<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Role extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Role_m','rm');
		$this->load->helper('bbc_helper');
		cek_login();
	}

	public function index()
	{
		$data['judul'] = "Pengaturan Akses";
		$data['role'] = $this->rm->get_role();

		$this->form_validation->set_rules('nama_role', 'Nama Role', 'required');

		if ($this->form_validation->run()) {
			$this->rm->insert();
			$this->session->set_flashdata('pesan', 'ditambah');
			redirect('role','refresh');
		}

		$this->load->view('template/header', $data, FALSE);		
		$this->load->view('role/index', $data, FALSE);		
		$this->load->view('template/footer', $data, FALSE);		
	}

	public function ubah($id = '')
	{
		$data['judul'] = "Ubah Akses Role";
						$this->db->order_by('urutan', 'asc');
		$data['menu'] = $this->db->get('menu')->result_array();

		$this->load->view('template/header', $data, FALSE);		
		$this->load->view('role/ubah', $data, FALSE);		
		$this->load->view('template/footer', $data, FALSE);	
	}

	public function ubah_akses_menu()
	{
		$post =  $this->input->post();

		$data = [
			'id_menu' => $post['id_menu'],
			'id_role' => $post['id_role']
		];

		$cek = $this->db->get_where('role_access_menu',$data);

		if ($cek->num_rows() < 1) {
			$this->db->insert('role_access_menu', $data);
		}else{
			$this->db->delete('role_access_menu', $data);
		}
	}

	public function ubah_akses_submenu()
	{
		$post =  $this->input->post();

		$data = [
			'id_submenu' => $post['id_submenu'],
			'id_role' => $post['id_role']
		];

		$cek = $this->db->get_where('role_access_submenu',$data);

		if ($cek->num_rows() < 1) {
			$this->db->insert('role_access_submenu', $data);
		}else{
			$this->db->delete('role_access_submenu', $data);
		}
	}

	public function hapus($id='')
	{
		$this->rm->delete($id);
		$this->session->set_flashdata('pesan', 'dihapus');
		redirect('role','refresh');	
	}

}

/* End of file Role.php */
/* Location: ./application/controllers/Role.php */ ?>