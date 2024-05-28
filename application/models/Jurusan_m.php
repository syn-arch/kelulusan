<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jurusan_m extends CI_Model {

	public function get_jurusan($id='')
	{
		if ($id ==  '') {
			return $this->db->get('jurusan')->result_array();
		}else{
			return $this->db->get_where('jurusan', ['id_jurusan' => $id])->row_array();
		}
	}

	function get_all_jurusan() {
		$this->datatables->select('nama_jurusan, singkatan, id_jurusan');
		$this->datatables->from('jurusan');
		return $this->datatables->generate();
	}

	public function delete($id='')
	{
		$this->db->delete('jurusan', ['id_jurusan' => $id]);
	}

	public function insert()
	{
		$post = $this->input->post();

		$data = [
		    'id_jurusan' => $post['id_jurusan'],
			'nama_jurusan' => $post['nama_jurusan'],
			'singkatan' => $post['singkatan']
		];
		$this->db->insert('jurusan', $data);
	}

	public function update($id_jurusan)
	{
		$post = $this->input->post();

		$data = [
			'nama_jurusan' => $post['nama_jurusan'],
			'singkatan' => $post['singkatan']
		];

		$this->db->where('id_jurusan', $id_jurusan);
		$this->db->update('jurusan', $data);
	}

	
}

/* End of file jurusan_m.php */
/* Location: ./application/models/jurusan_m.php */ ?>