<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Role_m extends CI_Model {

	public function get_role($id='')
	{
		if ($id ==  '') {
			return $this->db->get('role')->result_array();
		}else{
			return $this->db->get_where('role', ['id_role' => $id])->row_array();
		}
	}

	public function insert()
	{
		$post = $this->input->post();

		$data = [
			'nama_role' => $post['nama_role']
		];

		$this->db->insert('role', $data);
	}

	public function get_access_menu($id)
	{
		$this->db->from('role');
		$this->db->join('role_access_menu', 'id_role');
		$this->db->join('menu', 'role_access_menu.id_menu = menu.id_menu');
		$this->db->where('id_role', $id);
		return $this->db->get()->result_array();
	}

	public function delete($id='')
	{
		$this->db->delete('role', ['id_role' => $id]);
		$this->db->delete('role_access_menu', ['id_role' => $id]);
	}



}

/* End of file role_m.php */
/* Location: ./application/models/role_m.php */ ?>