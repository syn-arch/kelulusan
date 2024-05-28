<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil_m extends CI_Model {

	public function get_profile()
	{
		$this->db->join('petugas', 'id_user');
		$this->db->join('role', 'user.id_role=role.id_role');
		return $this->db->get_where('user',['id_user' => $this->session->userdata('id_user')])->row_array();
	}

	public function change_password()
	{
		$post = $this->input->post();
		$id_user = $this->session->userdata('id_user');

		$pw_lama = $this->db->get_where('user',['id_user' => $id_user])->row_array()['password'];

		if (password_verify($post['password_lama'], $pw_lama)) {

			$this->db->where('id_user', $id_user);
			$this->db->update('user', ['password' => password_hash($post['password_baru'], PASSWORD_DEFAULT)]);
			
		}else{
			$this->session->set_flashdata('error', 'Password lama tidak sama!');
			redirect('profil/ubah_password','refresh');
		}
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
			redirect('profil/ubah','refresh');
		}

		return $this->upload->data('file_name');
	}

	public function update_profile()
	{
		$post = $this->input->post();
		$id_user = $this->session->userdata('id_user');
		$id_petugas = $this->db->get('petugas',['id_user' => $id_user])->row_array()['id_petugas'];

		$data = [
			'nama_petugas' => $post['nama_petugas'],
			'alamat' => $post['alamat'],
			'telepon' => $post['telepon'],
			'jk' => $post['jk']
		];

		if ($_FILES['gambar']['name']) {
			$gb_lama = $this->db->get_where('petugas',['id_petugas' => $id_petugas])->row_array()['gambar'];
			unlink(FCPATH . 'assets/img/petugas/' . $gb_lama);
			$data['gambar'] = $this->_upload_petugas();
		}


		$this->db->where('id_petugas', $id_petugas);
		$this->db->update('petugas', $data);

		$this->db->where('id_user', $id_user);
		$this->db->update('user', ['email' => $post['email']]);
	}

}

/* End of file Profil_m.php */
/* Location: ./application/models/Profil_m.php */ ?>