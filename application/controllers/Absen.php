<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Created by Rivaldo
 * KOMISI INFORKOM
 * GPIB KASIH KARUNIA BADUNG BALI
 * 26 Juni 2022
 */
class Absen extends CI_Controller{
	public function __construct(){
		date_default_timezone_set('Asia/Singapore');
		parent::__construct();
		$this->load->model('Absen_model');
		$this->load->model('Sektor_model');
	}
	// Index for Anggota GP
	public function index(){
		$data = [
			'sektor' => $this->Sektor_model->getAllSektors(),
		];
        $this->load->view('users/absen.php', $data);
	}
	// Masukin Absen - Anggota GP
    public function absenGp(){
		$post['id_sektor'] = trim($this->input->post('sektor'));
		$post['nama_lengkap'] = trim($this->input->post('nama_lengkap'));
		$post['nomor_telepon'] = trim($this->input->post('nomor_telepon'));
		$post['is_katekisan'] = trim($this->input->post('is_katekisan'));
		$checker = $this->Absen_model->validateAbsen($post);
		// var_dump($checker);
		// die();
		if ($checker == true) {
			$absenMasuk = $this->Absen_model->absenMasuk($post);
			if ($absenMasuk == true){
				$this->status_absen('success','Halo '.$post['nama_lengkap']." ! Absenmu sudah masuk!, Selamat beribadah");
			} else {
				$this->status_absen('failed','Absen gagal!, silakan coba lagi!');
			}
		} else {
			$this->status_absen('warning','Kamu sudah absen! silakan beribadah!');
		}
    }
	// Status Absen - Anggota GP
	public function status_absen($status,$message){
		$this->session->set_flashdata($status, $message);
		$this->load->view('users/absen_status');
	}
	// Some Admin Methods
	// Absen Hari Ini
	public function getAbsenThisDay(){
		$data = [
            'totalKehadiran' => $this->Absen_model->countAllThisDay(),
            'total_gp' => $this->Absen_model->countGPThisDay(),
            'total_katekisan' => $this->Absen_model->countKatekisanThisDay(),
			'absens' => $this->Absen_model->getAllAbsenThisDay(),
			'hadirSektor' => $this->Absen_model->countPerSektorThisDay(),
		];
		$this->template->load('admin/template', 'admin/absen/absen_hari_ini', $data);
	}
	// Absen Custom
	public function getAbsenCustomDate(){
		$fromDate = trim($this->input->post('fromDate'));
		$toDate = trim($this->input->post('toDate'));
		$data = [
			'tanggalAbsen' => $fromDate . " s/d ". $toDate,
            'totalKehadiran' => $this->Absen_model->countAllCustomDate($fromDate, $toDate),
            'total_gp' => $this->Absen_model->countGPCustomDate($fromDate, $toDate),
            'total_katekisan' => $this->Absen_model->countKatekisanCustomDate($fromDate, $toDate),
			'absens' => $this->Absen_model->getAllAbsenCustomDate($fromDate, $toDate),
			'hadirSektor' => $this->Absen_model->countPerCustomDate($fromDate, $toDate),
		];
		$this->template->load('admin/template', 'admin/absen/absen_custom', $data);
	}
}
