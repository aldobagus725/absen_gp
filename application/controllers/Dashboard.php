<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Update per 0/04/2022
 */
class Dashboard extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('Users_model');
		$this->load->model('Sektor_model');
		$this->load->model('Absen_model');
		date_default_timezone_set('Asia/Singapore');
		if (!isset($_SESSION['admin'])) {
			redirect("admin/login");
		}
	}
	public function index(){
		$data = [
            'totalKehadiran' => $this->Absen_model->countAllThisDay(),
            'total_gp' => $this->Absen_model->countGPThisDay(),
            'total_katekisan' => $this->Absen_model->countKatekisanThisDay(),
		];
		$this->template->load('admin/template', 'admin/dashboard/dashboard', $data);
	}
}
