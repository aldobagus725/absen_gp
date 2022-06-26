<?php defined('BASEPATH') or exit('No direct script access allowed');

class UsersArea extends CI_Controller{
	public function __construct(){
		parent::__construct();
		date_default_timezone_set('Asia/Singapore');
		$this->load->model('Usersarea_model');
		$this->load->model('Masterarea_model');
		$this->load->model('Activitylog_model');
		if (!isset($_SESSION['admin'])) {
			redirect("admin/login");
		}
	}
	public function index(){
		$data = [
			'allProvinsi' => $this->Masterarea_model->getAllProvinsi(),
			'allArea' => $this->Usersarea_model->getAllArea(),
		];
		$id = $_SESSION['admin']->id;
		$activity = "Admin #". $id . " masuk dashboard area";
		$this->Activitylog_model->setLog($id,$activity);
		$this->template->load('backend/template', 'backend/users_area/users_area', $data);
	}
	// setArea
	public function set($id = null){
		$id_admin = $_SESSION['admin']->id;
		$post['nama_area'] = trim($this->input->post('nama_area'));
		$post['idprop'] = trim($this->input->post('idprop',true)); 
		$post['idkabu'] = trim($this->input->post('idkabu',true)); 
		$post['idkeca'] = trim($this->input->post('idkeca',true)); 
		$post['idkelu'] = trim($this->input->post('idkelu',true)); 
		$status =''; $title='';
		$text='';$type='';$icon='';
		$combiChecker = $this->Usersarea_model->AreaChecker($post);
		if ($combiChecker == false) {
			$submitStatus = $this->Usersarea_model->setArea($post, $id);
			if ($submitStatus) {
				$status ='success'; $title='Success';
				$text='Data berhasil disimpan!';$type='success';$icon='success';
				$activity = "Admin #". $id_admin . " membuat area baru - ".$post['nama_area']." -> SUCCESS";
			} else {
				$status ='failed'; $title='Gagal!';
				$text='Data gagal disimpan!';$type='error';$icon='error';
				$activity = "Admin #". $id_admin . " membuat area baru - ".$post['nama_area']." -> FAILED";
			}
		} else {
			$status ='failed'; $title='Gagal!';
			$text='Gagal! Data sudah ada!';$type='error';$icon='error';
			$activity = "Admin #". $id_admin . " membuat area baru - ".$post['nama_area']." -> FAILED (EXIST)";
		}
		$callback = array(
			'status' => $status,
			'title' => $title,
			'text' => $text,
			'type' => $type,
			'icon' => $icon,
		);
		
		$this->Activitylog_model->setLog($id_admin,$activity);
		echo json_encode($callback);
	}
	public function delete($id){
		$id_admin = $_SESSION['admin']->id;
		$status =''; $title='';
		$text='';$type='';$icon='';
		$delete_status = $this->Usersarea_model->deleteArea($id);
		if ($delete_status == true) {
			$status ='failed'; $title='Gagal!';
			$text='Data gagal dihapus!';$type='error';$icon='error';
			$activity = "Admin #". $id_admin . " delete area - ".$id." -> FAILED";
		} else {
			$status ='created'; $title='Success!';
			$text='Data berhasil dihapus!';$type='success';$icon='success';
			$activity = "Admin #". $id_admin . " delete area - ".$id." -> SUCCESS";
		}
		$callback = array(
			'status' => $status,
			'title' => $title,
			'text' => $text,
			'type' => $type,
			'icon' => $icon,
		);
		$this->Activitylog_model->setLog($id_admin,$activity);
		echo json_encode($callback);
	}
	/**
	 * MASTER AREA
	 */

	 // All Provinsi
	public function pageAllProvinsi(){
		$data = [
			'null' => null,
		];
		$id = $_SESSION['admin']->id;
		$activity = "Admin #" . $id . " masuk dashboard provinsi";
		$this->Activitylog_model->setLog($id, $activity);
		$this->template->load('backend/template', 'backend/users_area/provinsi', $data);
	}
	// All Kabupaten
	public function pageAllKabupaten(){
		$data = [
			'allProvinsi' => $this->Masterarea_model->getAllProvinsi(),
		];
		$id = $_SESSION['admin']->id;
		$activity = "Admin #" . $id . " masuk dashboard kabupaten";
		$this->Activitylog_model->setLog($id, $activity);
		$this->template->load('backend/template', 'backend/users_area/kabupaten', $data);
	}
	// All Kecamatan
	public function pageAllKecamatan(){
		$data = [
			'allProvinsi' => $this->Masterarea_model->getAllProvinsi(),
		];
		$id = $_SESSION['admin']->id;
		$activity = "Admin #" . $id . " masuk dashboard kecamatan";
		$this->Activitylog_model->setLog($id, $activity);
		$this->template->load('backend/template', 'backend/users_area/kecamatan', $data);
	}
	// All Kelurahan
	public function pageAllKelurahan(){
		$data = [
			'allProvinsi' => $this->Masterarea_model->getAllProvinsi(),
		];
		$id = $_SESSION['admin']->id;
		$activity = "Admin #" . $id . " masuk dashboard kelurahan";
		$this->Activitylog_model->setLog($id, $activity);
		$this->template->load('backend/template', 'backend/users_area/kelurahan', $data);
	}
	/**
	 * SERVERSIDE CONTROLLER FOR AJAX DATATABLES
	 */
	// Provinsi
	public function GetMasterProvinsi(){
		$list = $this->Masterarea_model->GetDataMasterProvinsi();
		$data = array();
		foreach ($list as $field) {
			$row = array();
			$row[] = $field->idprop;
			$row[] = $field->kdprop;
			$row[] = $field->nama_prop;
			$data[] = $row;
		}
		$output = array(
			"draw" => @$_POST['draw'],
			"recordsTotal" => $this->Masterarea_model->CountAllProvinsi(),
			"recordsFiltered" => $this->Masterarea_model->CountFilteredProvinsi(),
			"data" => $data,
		);
		echo json_encode($output);
	}
	// Kabupaten
	public function GetMasterKabupaten(){
		$list = $this->Masterarea_model->GetDataMasterKabupaten();
		$data = array();
		foreach ($list as $field) {
			$row = array();
			$row[] = $field->idkabu;
			$row[] = $field->kdkabu;
			$row[] = $field->nama_kabu;
			$row[] = $field->nama_prop;
			$row[] = $field->idprop;
			$data[] = $row;
		}
		$output = array(
			"draw" => @$_POST['draw'],
			"recordsTotal" => $this->Masterarea_model->CountAllKabupaten(),
			"recordsFiltered" => $this->Masterarea_model->CountFilteredKabupaten(),
			"data" => $data,
		);
		echo json_encode($output);
	}
	// Kecamatan
	public function GetMasterKecamatan(){
		$list = $this->Masterarea_model->GetDataMasterKecamatan();
		$data = array();
		foreach ($list as $field) {
			$row = array();
			$row[] = $field->idkeca;
			$row[] = $field->kdkeca;
			$row[] = $field->nama_keca;
			$row[] = $field->nama_kabu;
			$row[] = $field->nama_prop;
			$row[] = $field->idprop;
			$row[] = $field->idkabu;
			$data[] = $row;
		}
		$output = array(
			"draw" => @$_POST['draw'],
			"recordsTotal" => $this->Masterarea_model->CountAllKecamatan(),
			"recordsFiltered" => $this->Masterarea_model->CountFilteredKecamatan(),
			"data" => $data,
		);
		echo json_encode($output);
	}
	// Kelurahan
	public function GetMasterKelurahan(){
		$list = $this->Masterarea_model->GetDataMasterKelurahan();
		$data = array();
		foreach ($list as $field) {
			$row = array();
			$row[] = $field->idkelu;
			$row[] = $field->kdkelu;
			$row[] = $field->nama_kelu;
			$row[] = $field->nama_keca;
			$row[] = $field->nama_kabu;
			$row[] = $field->nama_prop;
			$row[] = $field->idprop;
			$row[] = $field->idkabu;
			$row[] = $field->idkeca;
			$data[] = $row;
		}
		$output = array(
			"draw" => @$_POST['draw'],
			"recordsTotal" => $this->Masterarea_model->CountAllKelurahan(),
			"recordsFiltered" => $this->Masterarea_model->CountFilteredKelurahan(),
			"data" => $data,
		);
		echo json_encode($output);
	}
	// Ajax Getters for Select2
	public function getAjaxProvinsi(){
		$data = $this->Masterarea_model->getAllProvinsiAjax(['nama_prop' => $this->input->get('nama_prop',true)]);
		echo json_encode($data);
	}
	public function getAjaxKabupaten($idprop){
		$data = $this->Masterarea_model->getKabupatenByProvinsi(['nama_kabu' => $this->input->get('nama_kabu',true)], $idprop);
		echo json_encode($data);
	}
	public function getAjaxKecamatan($idkabu){
		$data = $this->Masterarea_model->getKecamatanByKabupaten(['nama_keca' => $this->input->get('nama_keca',true)], $idkabu);
		echo json_encode($data);
	}
	public function getAjaxKelurahan($idkeca){
		$data = $this->Masterarea_model->getKelurahanByKecamatan(['nama_kelu' => $this->input->get('nama_kelu',true)], $idkeca);
		echo json_encode($data);
	}
	// Setters
	// Setters provinsi
	public function setProvinsi($id = null){
		$id_admin = $_SESSION['admin']->id;
		$post['nama_prop'] = trim($this->input->post('nama_prop',true));
		$post['kdprop'] = trim($this->input->post('kdprop',true));
		$status='';$title='';
		$text='';$type='';$icon='';
		$combiChecker = $this->Masterarea_model->provinsiChecker($post);
		if ($combiChecker == false) {
			$submitStatus = $this->Masterarea_model->setProvinsi($post, $id);
			if ($submitStatus) {
				$status='success';$title='Success';
				$text='Provinsi berhasil disimpan!';$type='success';$icon='success';
				$activity = "Admin #" . $id_admin . " membuat provinsi baru - " . $post['nama_prop'] . " -> SUCCESS";
			} else {
				$status='failed';$title='Gagal!';
				$text='Provinsi gagal disimpan!';$type='error';$icon='error';
				$activity = "Admin #" . $id_admin . " membuat provinsi baru - " . $post['nama_prop'] . " -> FAILED";			
			}
		} else {
			$status='failed';$title='Gagal!';
			$text='Gagal! provinsi sudah ada!';$type='error';$icon='error';
			$activity = "Admin #" . $id_admin . " membuat provinsi baru - " . $post['nama_prop'] . " -> FAILED (EXIST)";

		}
		$callback = array(
			'status' => $status,
			'title' => $title,
			'text' => $text,
			'type' => $type,
			'icon' => $icon,
		);
		$this->Activitylog_model->setLog($id_admin, $activity);
		echo json_encode($callback);
	}
	// Setters kabupaten
	public function setKabupaten($id = null){
		$id_admin = $_SESSION['admin']->id;
		$post['kdkabu'] = trim($this->input->post('kdkabu',true));
		$post['nama_kabu'] = trim($this->input->post('nama_kabu',true));
		$post['idprop'] = trim($this->input->post('idprop',true)); 
		$status='';$title='';
		$text='';$type='';$icon='';
		$combiChecker = $this->Masterarea_model->kabupatenChecker($post);
		if ($combiChecker == false) {
			$submitStatus = $this->Masterarea_model->setKabupaten($post, $id);
			if ($submitStatus) {
				$status='success';$title='Success';
				$text='Kabupaten berhasil disimpan!';$type='success';$icon='success';
				$activity = "Admin #" . $id_admin . " membuat kabupaten baru - " . $post['nama_kabu'] . " -> SUCCESS";
			} else {
				$status='failed';$title='Gagal!';
				$text='Kabupaten gagal disimpan!';$type='error';$icon='error';
				$activity = "Admin #" . $id_admin . " membuat kabupaten baru - " . $post['nama_kabu'] . " -> FAILED";
			}
		} else {
			$status='failed';$title='Gagal!';
			$text='Gagal! Kabupaten sudah ada!';$type='error';$icon='error';
			$activity = "Admin #" . $id_admin . " membuat kabupaten baru - " . $post['nama_kabu'] . " -> FAILED (EXIST)";
		}
		$callback = array(
			'status' => $status,
			'title' => $title,
			'text' => $text,
			'type' => $type,
			'icon' => $icon,
		);
		$this->Activitylog_model->setLog($id_admin, $activity);
		echo json_encode($callback);
	}
	// Setters kecamatan
	public function setKecamatan($id = null){
		$id_admin = $_SESSION['admin']->id;
		$post['kdkeca'] = trim($this->input->post('kdkeca',true));
		$post['nama_keca'] = trim($this->input->post('nama_keca',true));
		$post['idprop'] = trim($this->input->post('idprop',true)); 
		$post['idkabu'] = trim($this->input->post('idkabu',true));
		$status='';$title='';
		$text='';$type='';$icon='';
		$combiChecker = $this->Masterarea_model->kecamatanChecker($post);
		if ($combiChecker == false) {
			$submitStatus = $this->Masterarea_model->setKecamatan($post, $id);
			if ($submitStatus) {
				$status='success';$title='Success';
				$text='Kecamatan berhasil disimpan!';$type='success';$icon='success';
				$activity = "Admin #" . $id_admin . " membuat Kecamatan baru - " . $post['nama_keca'] . " -> SUCCESS";
			} else {
				$status='failed';$title='Gagal!';
				$text='Kecamatan gagal disimpan!';$type='error';$icon='error';
				$activity = "Admin #" . $id_admin . " membuat Kecamatan baru - " . $post['nama_keca'] . " -> FAILED";
			}
		} else {
			$status='failed';$title='Gagal!';
			$text='Gagal! Kabupaten sudah ada!';$type='error';$icon='error';
			$activity = "Admin #" . $id_admin . " membuat Kecamatan baru - " . $post['nama_keca'] . " -> FAILED (EXIST)";
		}
		$callback = array(
			'status' => $status,
			'title' => $title,
			'text' => $text,
			'type' => $type,
			'icon' => $icon,
		);
		$this->Activitylog_model->setLog($id_admin, $activity);
		echo json_encode($callback);
	}
	// Setters kelurahan
	public function setKelurahan($id = null){
		$id_admin = $_SESSION['admin']->id;
		$post['kdkelu'] = trim($this->input->post('kdkelu',true));
		$post['nama_kelu'] = trim($this->input->post('nama_kelu',true));
		$post['idprop'] = trim($this->input->post('idprop',true));
		$post['idkabu'] = trim($this->input->post('idkabu',true));
		$post['idkeca'] = trim($this->input->post('idkeca',true));
		$status='';$title='';
		$text='';$type='';$icon='';
		$combiChecker = $this->Masterarea_model->kelurahanChecker($post);
		if ($combiChecker == false) {
			$submitStatus = $this->Masterarea_model->setKelurahan($post, $id);
			if ($submitStatus) {
				$status='success';$title='Success';
				$text='Kelurahan berhasil disimpan!';$type='success';$icon='success';
				$activity = "Admin #" . $id_admin . " membuat Kelurahan baru - " . $post['nama_kelu'] . " -> SUCCESS";
			} else {
				$status='failed';$title='Gagal!';
				$text='Kelurahan gagal disimpan!';$type='error';$icon='error';
				$activity = "Admin #" . $id_admin . " membuat Kelurahan baru - " . $post['nama_kelu'] . " -> FAILED";
			}
		} else {
			$status='failed';$title='Gagal!';
			$text='Gagal! Kelurahan sudah ada!';$type='error';$icon='error';
			$activity = "Admin #" . $id_admin . " membuat Kelurahan baru - " . $post['nama_kelu'] . " -> FAILED (EXIST)";
		}
		$callback = array(
			'status' => $status,
			'title' => $title,
			'text' => $text,
			'type' => $type,
			'icon' => $icon,
		);
		$this->Activitylog_model->setLog($id_admin, $activity);
		echo json_encode($callback);
	}
	// Delete
	// Delete Provinsi
	public function deleteProvinsi($id){
		$id_admin = $_SESSION['admin']->id;
		$delete_status = $this->Masterarea_model->deleteProvinsi($id);
		$status='';$title='';
		$text='';$type='';$icon='';
		if ($delete_status == true) {
			$status='failed';$title='Gagal!';
			$text='Data gagal dihapus!';$type='error';$icon='error';
			$activity = "Admin #" . $id_admin . " delete provinsi - " . $id . " -> FAILED";
			$this->Activitylog_model->setLog($id_admin, $activity);
		} else {
			$status='created';$title='Success!';
			$text='Data berhasil dihapus!';$type='success';$icon='success';
			$activity = "Admin #" . $id_admin . " delete provinsi - " . $id . " -> SUCCESS";
		}
		$callback = array(
			'status' => $status,
			'title' => $title,
			'text' => $text,
			'type' => $type,
			'icon' => $icon,
		);
		$this->Activitylog_model->setLog($id_admin, $activity);
		echo json_encode($callback);
	}
	// Delete Kabupaten
	public function deleteKabupaten($id){
		$id_admin = $_SESSION['admin']->id;
		$status='';$title='';
		$text='';$type='';$icon='';
		$delete_status = $this->Masterarea_model->deleteKabupaten($id);
		if ($delete_status == true) {
			$status='failed';$title='Gagal!';
			$text='Data gagal dihapus!';$type='error';$icon='error';
			$activity = "Admin #" . $id_admin . " delete kabupaten - " . $id . " -> FAILED";
			$this->Activitylog_model->setLog($id_admin, $activity);
		} else {
			$status='created';$title='Success!';
			$text='Data berhasil dihapus!';$type='success';$icon='success';
			$activity = "Admin #" . $id_admin . " delete kabupaten - " . $id . " -> SUCCESS";
		}
		$callback = array(
			'status' => $status,
			'title' => $title,
			'text' => $text,
			'type' => $type,
			'icon' => $icon,
		);
		$this->Activitylog_model->setLog($id_admin, $activity);
		echo json_encode($callback);
	}
	// Delete Kecamatan
	public function deleteKecamatan($id){
		$id_admin = $_SESSION['admin']->id;
		$status='';$title='';
		$text='';$type='';$icon='';
		$delete_status = $this->Masterarea_model->deleteKecamatan($id);
		if ($delete_status == true) {
			$status='failed';$title='Gagal!';
			$text='Data gagal dihapus!';$type='error';$icon='error';
			$activity = "Admin #" . $id_admin . " delete Kecamatan - " . $id . " -> FAILED";
			$this->Activitylog_model->setLog($id_admin, $activity);
		} else {
			$status='created';$title='Success!';
			$text='Data berhasil dihapus!';$type='success';$icon='success';
			$activity = "Admin #" . $id_admin . " delete Kecamatan - " . $id . " -> SUCCESS";
		}
		$callback = array(
			'status' => $status,
			'title' => $title,
			'text' => $text,
			'type' => $type,
			'icon' => $icon,
		);
		$this->Activitylog_model->setLog($id_admin, $activity);
		echo json_encode($callback);
	}
	// Delete kelurahan
	public function deleteKelurahan($id){
		$status='';$title='';
		$text='';$type='';$icon='';
		$id_admin = $_SESSION['admin']->id;
		$delete_status = $this->Masterarea_model->deleteKelurahan($id);
		if ($delete_status == true) {
			$status='failed';$title='Gagal!';
			$text='Data gagal dihapus!';$type='error';$icon='error';
			$activity = "Admin #" . $id_admin . " delete Kelurahan - " . $id . " -> FAILED";
			$this->Activitylog_model->setLog($id_admin, $activity);
		} else {
			$status='created';$title='Success!';
			$text='Data berhasil dihapus!';$type='success';$icon='success';
			$activity = "Admin #" . $id_admin . " delete Kelurahan - " . $id . " -> SUCCESS";
		}
		$callback = array(
			'status' => $status,
			'title' => $title,
			'text' => $text,
			'type' => $type,
			'icon' => $icon,
		);
		$this->Activitylog_model->setLog($id_admin, $activity);
		echo json_encode($callback);
	}
}