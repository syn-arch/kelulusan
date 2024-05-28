<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class berkas_m extends CI_Model {

	public function get_berkas($id = '')
	{
		$id_user = $this->session->userdata('id_user');
		$user = $this->db->get('user',['id_user' => $id_user])->row_array();

		if ($user['petugas']) {
		$id_jurusan = $user['id_jurusan'];
		
					$this->db->join('siswa', 'id_siswa', 'right');
					$this->db->join('kelas', 'siswa.id_kelas = kelas.id_kelas');
					$this->db->join('jurusan', 'jurusan.id_jurusan = siswa.id_jurusan');
					$this->db->where('siswa.id_jurusan', $id_jurusan);
			return $this->db->get('kelulusan')->result_array();
		}
		

		if ($id ==  '') {
					$this->db->join('siswa', 'id_siswa', 'right');
					$this->db->join('kelas', 'siswa.id_kelas = kelas.id_kelas');
					$this->db->join('jurusan', 'jurusan.id_jurusan = siswa.id_jurusan');
			return $this->db->get_where('kelulusan')->result_array();
		}else{
					$this->db->join('siswa', 'id_siswa', 'right');
					$this->db->join('kelas', 'siswa.id_kelas = kelas.id_kelas');
					$this->db->join('jurusan', 'jurusan.id_jurusan = siswa.id_jurusan');
			return $this->db->get_where('kelulusan', ['id_kelulusan' => $id])->row_array();
		}
	}

	public function _upload($url)
	{
		$config['upload_path'] = './assets/img/berkas/';
		$config['allowed_types'] = 'jpeg|jpg|png|pdf';
		$config['max_size'] = '2048';
		
		$this->load->library('upload', $config);
		
		if ( ! $this->upload->do_upload('berkas')){
			$error = $this->upload->display_errors();
			$this->session->set_flashdata('error', $error);
			redirect($url,'refresh');
		}

		return $this->upload->data('file_name');
	}
	
	public function get_berkas_petugas(){
	     $id_user = $this->session->userdata('id_user');
		$user = $this->db->get('user',['id_user' => $id_user])->row_array();

    		$id_jurusan = $user['id_jurusan'];
    		
    		$this->datatables->join('siswa', 'id_siswa' , 'right');
    		$this->datatables->join('kelas', 'siswa.id_kelas = kelas.id_kelas');
    		$this->datatables->select('id_kelulusan, nama_siswa, jk, nis, nama_kelas, id_siswa, verifikasi, status_lulus, id_siswa, berkas');
    		$this->datatables->where('siswa.id_jurusan', $id_jurusan);
    		$this->datatables->from('kelulusan');
    		return $this->datatables->generate();
	}
	

	public function get_all_berkas() {
    		$this->datatables->join('siswa', 'id_siswa' , 'right');
    		$this->datatables->join('kelas', 'siswa.id_kelas = kelas.id_kelas');
    		$this->datatables->select('id_kelulusan, nama_siswa, jk, nis, nama_kelas, id_siswa, verifikasi, status_lulus, id_siswa, berkas');
    		$this->datatables->from('kelulusan');
    		return $this->datatables->generate();    
	}

	public function delete($id)
	{
		$gb_lama = $this->db->get('kelulusan',['id_kelulusan' => $id])->row_array()['berkas'];
		unlink(FCPATH . 'assets/img/berkas/' . $gb_lama);
		$this->db->delete('kelulusan', ['id_kelulusan' => $id]);
	}

	public function insert()
	{
		$post = $this->input->post();

		$data = [
			'id_siswa' => $post['id_siswa'],
			'keterangan' => $post['keterangan'],
			'berkas' => $this->_upload('kelulusan/tambah_berkas')
		];

		$this->db->insert('kelulusan', $data);
	}

	public function update($id_kelulusan)
	{
		$post = $this->input->post();

		$data = [
			'id_siswa' => $post['id_siswa'],
			'keterangan' => $post['keterangan']
		];

		if ($_FILES['berkas']['name']) {
			$gb_lama = $this->db->get('kelulusan',['id_kelulusan' => $id_kelulusan])->row_array()['berkas'];
			unlink(FCPATH . 'assets/img/berkas/' . $gb_lama);
			$data['berkas'] = $this->_upload('kelulusan/ubah_berkas/' . $id_kelulusan);
		}

		$this->db->where('id_kelulusan', $id_kelulusan);
		$this->db->update('kelulusan', $data);
	}

	
}

/* End of file calon_berkas_m.php */
/* Location: ./application/models/calon_berkas_m.php */ ?>