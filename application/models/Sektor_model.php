<?php
class Sektor_model extends CI_Model{
    public function __construct()
    {
        date_default_timezone_set('Asia/Makassar');
        parent::__construct();
    }
    // Get All Sektor - Admin / Anggota GP
	public function getAllSektors(){
		$this->db->select('*')
			->from('sektor');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}
	// Validate Admin before entry - Admin
	public function validateSektor($post){
		$this->db->select('sektor')
			->where('sektor', $post['sektor']);
		$query = $this->db->get('sektor');
		if ($query->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	// Add Sektor - Admin
	public function setSektor($post){
		$this->db->trans_begin();
		if (!$this->db->insert('sektor', array(
			'sektor' => $post['sektor'],
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
	// Update Sektor - Admin
	public function updateSektor($post, $id){
		$this->db->trans_begin();
		$this->db->where('id', $id);
		if (!$this->db->update('sektor', array(
			'sektor' => $post['username'],
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
	// Delete Sektor - Admin
	public function deleteSektor($id){
		return $this->db->delete('sektor',  array('id' => $id));
	}
}
