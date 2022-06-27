<?php
class Absen_model extends CI_Model{
	/**
 * Created by Rivaldo
 * KOMISI INFORKOM
 * GPIB KASIH KARUNIA BADUNG BALI
 * 26 Juni 2022
 */
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
	// Counters
	public function countGPThisDay(){
		$this->db->where('is_katekisan =', "false");
		$this->db->where('DATE(created_at)', date("Y-m-d",time()));
		$count = $this->db->count_all_results('absen_gp');
		return $count;
	}
	public function countKatekisanThisDay(){
		$this->db->where('is_katekisan =', "true");
		$this->db->where('DATE(created_at)', date("Y-m-d",time()));
		$count = $this->db->count_all_results('absen_gp');
		return $count;
	}
	public function countAllThisDay(){
		$this->db->where('DATE(created_at)', date("Y-m-d",time()));
		$count = $this->db->count_all_results('absen_gp');
		return $count;
	}
	// Reports
	public function getAllAbsenThisDay(){
		$this->db	->join('sektor', 'sektor.id = absen_gp.id_sektor')
					->select('absen_gp.*, sektor.sektor ')
					->from('absen_gp')
					->where('DATE(absen_gp.created_at)', date("Y-m-d",time()));
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}
	// Custom Reports per Date
	public function getAllAbsenCustomDate($fromDate = null, $toDate = null){
		$this->db	->join('sektor', 'sektor.id = absen_gp.id_sektor')
					->select('absen_gp.*, sektor.sektor ')
					->from('absen_gp');
		if ($fromDate != null || $toDate != null){
			$this->db->where('DATE(absen_gp.created_at) >=', $fromDate);
			$this->db->where('DATE(absen_gp.created_at) <=', $toDate);
		}
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}		
	}
	// Counters
	public function countGPCustomDate($fromDate = null, $toDate = null){
		$this->db->where('is_katekisan =', "false");
		if ($fromDate != null || $toDate != null){
			$this->db->where('DATE(created_at) >=', $fromDate);
			$this->db->where('DATE(created_at) <=', $toDate);
		}
		$count = $this->db->count_all_results('absen_gp');
		return $count;
	}
	public function countKatekisanCustomDate($fromDate = null, $toDate = null){
		$this->db->where('is_katekisan =', "true");
		if ($fromDate != null || $toDate != null){
			$this->db->where('DATE(created_at) >=', $fromDate);
			$this->db->where('DATE(created_at) <=', $toDate);
		}
		$count = $this->db->count_all_results('absen_gp');
		return $count;
	}
	public function countAllCustomDate($fromDate = null, $toDate = null){
		if ($fromDate != null || $toDate != null){
			$this->db->where('DATE(created_at) >=', $fromDate);
			$this->db->where('DATE(created_at) <=', $toDate);
		}
		$count = $this->db->count_all_results('absen_gp');
		return $count;
	}
}
