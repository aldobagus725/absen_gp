<?php
class Absen_model extends CI_Model{
    public function __construct()
    {
        date_default_timezone_set('Asia/Makassar');
        parent::__construct();
    }
	// Admin Methods
    // Get All Absen - Admin
	public function getAllAbsen(){
		$this->db->select('absen_gp.*, sektor.sektor ')
			->from('users')
			->join('sektor', 'sektor.id = sektor.id_sektor');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}
	// Add Absen - Anggota GP
	public function absenMasuk($post){
		$this->db->trans_begin();
		if (!$this->db->insert('absen_gp', array(
			'id_sektor' => $post['id_sektor'],
			'nama_lengkap' => $post['nama_lengkap'],
			'nomor_telepon' => $post['nomor_telepon'],
			'is_katekisan' => $post['is_katekisan'],
			'created_at' => date('Y-m-d H:i:s',time()),
			'updated_at' => date('Y-m-d H:i:s',time()),
		))) {
			log_message('error', print_r($this->db->error(), true));
		}
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return false;
		} else {
			$this->db->trans_commit();
			return true;
		}
	}
	// Validate Absen - Anggota GP
    public function validateAbsen($post){
        $this->db->select('nama_lengkap')
            ->from('absen_gp')
            ->like('nama_lengkap', $post['nama_lengkap'])
			->where('id_sektor', $post['id_sektor'])
			->where('DATE(created_at)', date("Y-m-d",time()));
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return false;
		} else {
			return true;
		}
        // return $this->db->get()->row();
    }
}
