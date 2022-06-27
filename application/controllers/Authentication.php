<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Created by Rivaldo
 * KOMISI INFORKOM
 * GPIB KASIH KARUNIA BADUNG BALI
 * 26 Juni 2022
 */
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
			$this->load->view('admin/login');
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
			if (password_verify($password, $passwordValid->password)) {
				$_SESSION['admin'] = $this->Users_model->getAdminInfo($username);
				redirect('admin');
			} else {
				$this->session->set_flashdata("error", 'Username/password invalid! - 400');
			}
		} else {
			$this->session->set_flashdata("error", 'Username/password invalid! - 404');
		}
	}
	/**
	 * =========================================================== Logouts
	 */
	// Logout Admin
	public function logoutAdmin(){
		if (isset($_SESSION['admin'])) {
			$this->session->unset_userdata('admin');
		}
		redirect('admin/login');
	}
}
