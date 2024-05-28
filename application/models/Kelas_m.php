<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class kelas_m extends CI_Model {

	public function get_kelas($id='')
	{
		if ($id ==  '') {
					$this->db->join('jurusan', 'id_jurusan');
			return $this->db->get('kelas')->result_array();
		}else{
					$this->db->join('jurusan', 'id_jurusan');
			return $this->db->get_where('kelas', ['id_kelas' => $id])->row_array();
		}
	}

	function get_all_kelas() {
		$this->datatables->select('nama_kelas, singkatan, id_kelas');
		$this->datatables->from('kelas');
		return $this->datatables->generate();
	}

	public function delete($id='')
	{
		$this->db->delete('kelas', ['id_kelas' => $id]);
	}

	public function insert()
	{
		$post = $this->input->post();

		$data = [
		    'id_kelas' => $post['id_kelas'],
			'nama_kelas' => $post['nama_kelas'],
			'id_jurusan' => $post['id_jurusan']
		];
		$this->db->insert('kelas', $data);
	}

	public function update($id_kelas)
	{
		$post = $this->input->post();

		$data = [
			'nama_kelas' => $post['nama_kelas'],
			'id_jurusan' => $post['id_jurusan']
		];

		$this->db->where('id_kelas', $id_kelas);
		$this->db->update('kelas', $data);
	}

	
}

/* End of file kelas_m.php */
/* Location: ./application/models/kelas_m.php */ ?>