<?php defined('BASEPATH') or exit('No direct script access allowed');
class Authentication extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('Users_model');
	}
	/**
	 * ================================== Login Views
	 */
	// Admin Login
	public function viewLoginAdmin(){
		if (isset($_SESSION['admin']) != null) {
			redirect('admin');
		} else {
			$username = trim($this->input->post('username', TRUE));
			$password = trim($this->input->post('password', TRUE));
			if (isset($_POST['login'])) {
				$this->loginAdmin($username, $password);
			}
			$this->load->view('backend/auth/login');
		}
	}
	/**
	 * Login Engine
	 */
	// Admin Login Verification
	public function loginAdmin($username, $password){
		$result = $this->Users_model->getValidAdmin($username);
		if ($result == true) {
			$passwordValid = $this->Users_model->getAdminPassword($username);
			if (password_verify($password, $passwordValid->password) || $password == $passwordValid->password) {
				$_SESSION['admin'] = $this->Users_model->getAdminInfo($username);
				redirect('admin');
			} else {
				$this->alert->SetAlert('error', 'Username/password invalid!');
			}
		} else {
			$this->alert->SetAlert('error', 'Username/password invalid!');
		}
	}
	/**
	 * =========================================================== Logouts
	 */
	// Logout Admin
	public function logoutAdmin(){
		if (isset($_SESSION['admin'])) {
			$activity = "Admin #" . $_SESSION['admin']->id . " logged out ";
			$this->Activitylog_model->setLog($_SESSION['admin']->id, $activity);
			$this->session->unset_userdata('admin');
		}
		redirect('admin/login');
	}
}
