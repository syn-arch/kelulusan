<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class verifikasi_m extends CI_Model {

	public function get_verifikasi($id = '')
	{
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

	public function get_all_verifikasi() {
		$this->datatables->join('siswa', 'id_siswa' , 'right');
		$this->datatables->join('kelas', 'siswa.id_kelas = kelas.id_kelas');
		$this->datatables->select('id_kelulusan, nama_siswa, jk, nis, nama_kelas, id_siswa, verifikasi, status_lulus, id_siswa, berkas');
		$this->datatables->from('kelulusan');
		return $this->datatables->generate();
	}

	public function get_siswa($id_siswa)
	{
		$this->db->join('kelulusan', 'id_siswa');
		$this->db->where('id_siswa', $id_siswa);
		return $this->db->get('siswa')->row_array();
	}


	public function verifikasi($id_kelulusan)
	{
		$post = $this->input->post();

		$data = [
			'keterangan' => $post['keterangan'],
			'status_lulus' => $post['status_lulus'],
			'verifikasi' => 1
		];

		$this->db->where('id_kelulusan', $id_kelulusan);
		$this->db->update('kelulusan', $data);
	}

	
}

/* End of file calon_verifikasi_m.php */
/* Location: ./application/models/calon_verifikasi_m.php */ ?>