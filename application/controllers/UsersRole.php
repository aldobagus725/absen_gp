<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Created by Rivaldo
 * KOMISI INFORKOM
 * GPIB KASIH KARUNIA BADUNG BALI
 * 26 Juni 2022
 */
class UsersRole extends CI_Controller{
	public function __construct(){
		parent::__construct();
		date_default_timezone_set('Asia/Singapore');
		$this->load->model('Usersrole_model');
		if (!isset($_SESSION['admin'])) {
			redirect("admin/login");
		}
	}
	public function index(){
		$data = [
			'allRoles' => $this->Usersrole_model->getAllRole(),
		];
		$this->template->load('admin/template', 'admin/users_role/users_role', $data);
	}
	public function addForm(){
		$this->template->load('admin/template', 'admin/users_role/add_users_role',);
	}
	public function editForm($id){
		$data = [
            'role' => $this->Usersrole_model->getOneRole($id),
		];
		$this->template->load('admin/template', 'admin/users_role/edit_users_role',$data);
	}
	public function set($id = null){
		$post['role'] = trim($this->input->post('role'));
		$submitStatus = $this->Usersrole_model->setRole($post, $id);
		if ($submitStatus) {
			$this->session->set_flashdata("success", "Data berhasil disimpan!");
		} else {
			$this->session->set_flashdata("danger", "Data gagal disimpan!");
		}
		redirect('admin/role');
	}
	public function delete($id){
		$delete_status = $this->Usersrole_model->deleteRole($id);
		if ($delete_status == false) {
			$this->session->set_flashdata("danger", "Data gagal dihapus!");
		} else {
			$this->session->set_flashdata("success", "Data berhasil dihapus!");
		}
		redirect('admin/role');
	}
}