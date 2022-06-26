<?php
class Users_model extends CI_Model{
    public function __construct()
    {
        date_default_timezone_set('Asia/Makassar');
        parent::__construct();
    }
    // Get All Admins
	public function getAllAdmins(){
		$this->db->select('users.*, users_role.role ')
			->from('users')
			->join('users_role', 'users_role.id = users.id_role');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}
	// Validating Admin to determine whether the username exist or not
	public function getValidAdmin($username){
		$this->db->select('username')
			->where('username', $username);
		$query = $this->db->get('users');
		if ($query->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	// Validating Admin's Password
	public function getAdminPassword($username){
		$this->db->select('username, password')
			->from('users')
			->where('username', $username);
		return $this->db->get()->row();
	}
	// If all goes well for login, we get just the ID and the username for session existance
	// Getting Admin Info
	public function getAdminInfo($username){
		$this->db->select("users.*, users_role.role")
			->from('users')
			->join('users_role', 'users_role.id = users.id_role')
			->where('users.username', $username);
		return $this->db->get()->row();
	}

	// Getting Admin's Full profile
	public function getAdminProfile($username){
		$this->db->join('users_role', 'users_role.id_role = users.id_role')
			->select('users.id,users.username,users_role.role,users.no_telp')
			->from('users')
			->where('username', $username);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}
	// Adding More Admins to the system
	public function setAdmin($post){
		$this->db->trans_begin();
		if (!$this->db->insert('users', array(
			'id_role' => $post['id_role'],
			'username' => $post['username'],
			'password' => $post['password'],
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
	// Update Admins
	public function updateAdmin($post, $id){
		$this->db->trans_begin();
		$this->db->where('id', $id);
		if (!$this->db->update('users', array(
			'username' => $post['username'],
			'id_role' => $post['id_role'],
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
	// Set Admin's Password
	public function setAdminPassword($password, $id)
	{
		$this->db->trans_begin();
		$this->db->where('id', $id);
		if (!$this->db->update('users', array(
			'password' => $password
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
	// Delete Admin to the system
	public function deleteAdmin($id){
		$this->db->where('id', $id);
		$this->db->delete('users');
	}
}
