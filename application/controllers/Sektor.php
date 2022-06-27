<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Created by Rivaldo
 * KOMISI INFORKOM
 * GPIB KASIH KARUNIA BADUNG BALI
 * 26 Juni 2022
 */
class Sektor extends CI_Controller{
	public function __construct(){
		parent::__construct();
		date_default_timezone_set('Asia/Singapore');
		$this->load->model('Sektor_model');
		if (!isset($_SESSION['admin'])) {
			redirect("admin/login");
		}
	}
	public function index(){
		$data = [
			'allSektor' => $this->Sektor_model->getAllSektors(),
		];
		$this->template->load('admin/template', 'admin/sektor/sektor', $data);
	}
	public function addForm(){
		$this->template->load('admin/template', 'admin/sektor/add_sektor');
	}
	public function editForm($id){
		$data = [
			'sektor' => $this->Sektor_model->getOneSektor($id),
		];
		$this->template->load('admin/template', 'admin/sektor/edit_sektor',$data);
	}
	// setSektor
	public function set($id = null){
		$post['sektor'] = trim($this->input->post('sektor',true));
		$combiChecker = $this->Sektor_model->validateSektor($post);
		if ($combiChecker == true) {
			$submitStatus = $this->Sektor_model->setSektor($post, $id);
			if ($submitStatus == true) {
				$this->session->set_flashdata("success", "Data berhasil disimpan!");
			} else {
				$this->session->set_flashdata("danger", "Data gagal disimpan!");
			}
		} else {
			$this->session->set_flashdata("warning", "Data sudah ada!");
		}
		redirect('admin/sektor');
	}
	public function delete($id){
		$delete_status = $this->Sektor_model->deleteSektor($id);
		if ($delete_status == false) {
			$this->session->set_flashdata("danger", "Data gagal dihapus!");
		} else {
			$this->session->set_flashdata("success", "Data berhasil dihapus!");
		}
		redirect('admin/sektor');
	}
}