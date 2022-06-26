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
}
