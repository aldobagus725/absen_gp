<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Created by Rivaldo
 * KOMISI INFORKOM
 * GPIB KASIH KARUNIA BADUNG BALI
 * 26 Juni 2022
 */
class Admin extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('Users_model');
		$this->load->model('Usersrole_model');
		if (!isset($_SESSION['admin'])) {
			redirect("admin/login");
		}
	}
	public function index(){
		$data = [
			'allUser' => $this->Users_model->getAllAdmins(),
			'allRoles' => $this->Usersrole_model->getAllRole(),
		];
		$this->template->load('admin/template', 'admin/users/users', $data);
	}
    public function addForm(){
        $data = [
            'allRoles' => $this->Usersrole_model->getAllRole(),
		];
		$this->template->load('admin/template', 'admin/users/add_user', $data);
	}
	public function editForm($id){
		$data = [
			'user' => $this->Users_model->getOneAdmin($id),
            'allRoles' => $this->Usersrole_model->getAllRole(),
		];
		$this->template->load('admin/template', 'admin/users/edit_user',$data);
	}
    public function changePwdForm($id){
		$data = [
			'user' => $this->Users_model->getOneAdmin($id),
		];
		$this->template->load('admin/template', 'admin/users/edit_pass',$data);
	}
	public function set(){
		$post['username'] = trim($this->input->post('username',true));
		$post['password'] = trim(password_hash(base64_decode($this->input->post('password',true)), PASSWORD_DEFAULT));
		$post['id_role'] = trim($this->input->post('id_role',true));
		$adminChecker = $this->Users_model->getValidAdmin($post['username']);
		if ($adminChecker == true) {
			$submitStatus = $this->Users_model->setAdmin($post);
			if ($submitStatus) {
                $this->session->set_flashdata("success", "Data berhasil disimpan!");
			} else {
                $this->session->set_flashdata("danger", "Data gagal disimpan!");
			}
		} else {
            $this->session->set_flashdata("warning", "Data sudah ada!");
		}
        redirect('admin/users');
	}
	public function update($id){
		$post['username'] = trim($this->input->post('username',true));
        $post['id_role'] = trim($this->input->post('id_role',true));
		$submitStatus = $this->Users_model->updateAdmin($post, $id);
		if ($submitStatus == true) {
            $this->session->set_flashdata("success", "Data berhasil disimpan!");
		} else {
			$this->session->set_flashdata("danger", "Data gagal disimpan!");
		}
        redirect('admin/users');
	}
	public function delete($id){
		$delete_status = $this->Users_model->deleteAdmin($id);
		if ($delete_status == false) {
            $this->session->set_flashdata("danger", "Data gagal dihapus!");
		} else {
            $this->session->set_flashdata("success", "Data berhasil dihapus!");
		}
        redirect('admin/users');
	}
	public function changePassword($id){
		$password = password_hash(trim($this->input->post('password',true)), PASSWORD_DEFAULT);
		$passwordStatus = $this->Users_model->setAdminPassword($password, $id);
		if ($passwordStatus == true) {
            $this->session->set_flashdata("success", "Data berhasil disimpan!");
		} else {
            $this->session->set_flashdata("danger", "Data gagal disimpan!");
		}
        redirect('admin/users');
	}
}
