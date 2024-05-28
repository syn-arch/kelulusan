<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_m extends CI_Model {

	public function get_user($id='')
	{
		if ($id ==  '') {
			$this->db->join('petugas', 'id_user');
			return $this->db->get_where('user', ['id_role' => 1])->result_array();
		}else{
			$this->db->join('petugas', 'id_user');
			return $this->db->get_where('user', ['id_user' => $id])->row_array();
		}
	}

	function get_all_user() {
		$this->datatables->select('id_user, nama_petugas, email, telepon, nama_role');
		$this->datatables->from('user');
		$this->datatables->join('role', 'id_role');
		$this->datatables->join('petugas', 'id_user');
		return $this->datatables->generate();
	}

	public function delete($id)
	{	
					$this->db->join('petugas', 'id_user');
		$gb_lama = $this->db->get_where('user',['id_user' => $id])->row_array()['gambar'];
		unlink(FCPATH . 'assets/img/petugas/' . $gb_lama);
		$this->db->delete('user', ['id_user' => $id]);
		$this->db->delete('petugas', ['id_user' => $id]);
	}

	private function _upload_petugas()
	{
		$config['upload_path'] = './assets/img/petugas/';
		$config['allowed_types'] = 'jpeg|jpg|png';
		$config['max_size'] = '2048';
		
		$this->load->library('upload', $config);
		
		if ( ! $this->upload->do_upload('gambar')){
			$error = $this->upload->display_errors();
			$this->session->set_flashdata('error', $error);
			redirect('user','refresh');
		}

		return $this->upload->data('file_name');
	}

	public function insert()
	{
		$post = $this->input->post();

		$data = [
			'email' => $post['email'],
			'id_role' => $post['id_role'],
			'petugas' => $post['petugas'],
			'id_jurusan' => $post['id_jurusan'],
			'password' => password_hash($post['pw1'], PASSWORD_DEFAULT)
		];

		$user = $this->db->insert('user', $data);
		
		$id_user = $this->db->insert_id();

		$data_petugas = [
			'id_user' => $id_user,
			'nama_petugas' => $post['nama_petugas'],
			'alamat' => $post['alamat'],
			'telepon' => $post['telepon'],
			'jk' => $post['jk'],
			'gambar' => $this->_upload_petugas()
		];

		$this->db->insert('petugas', $data_petugas);

		
	}

	public function update($id_user, $id_petugas)
	{
		$post = $this->input->post();

		$data_petugas = [
			'nama_petugas' => $post['nama_petugas'],
			'alamat' => $post['alamat'],		
			'telepon' => $post['telepon'],
			'jk' => $post['jk']
		];

		if ($_FILES['gambar']['name']) {
			$gb_lama = $this->db->get_where('petugas',['id_petugas' => $id_petugas])->row_array()['gambar'];
			unlink(FCPATH . 'assets/petugas/' . $gb_lama);
			$data_petugas['gambar'] = $this->_upload_petugas();
		}

		$this->db->where('id_petugas', $id_petugas);
		$this->db->update('petugas', $data_petugas);

		$data['id_role'] =  $post['id_role'];
		$data['email'] =  $post['email'];
		$data['petugas'] =  $post['petugas'];
		$data['id_jurusan'] =  $post['id_jurusan'];

		$this->db->where('id_user', $id_user);
		$this->db->update('user', $data);
	}

	
}

/* End of file User_m.php */
/* Location: ./application/models/User_m.php */ ?>