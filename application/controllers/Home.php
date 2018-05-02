<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Authuser_Model');
		$this->load->model('Authmin_model');
		$this->load->helper('url');

		$loggedin = $this->session->userdata('masukin');
	}

	public function	index() {
		if($this->session->userdata('masukin')['status'] != 'login'){
			$this->load->view("user/headfoot/header");
			$this->load->view("user/index"); 
			$this->load->view("user/headfoot/footer");
		}else{ 
			redirect("Home/indexlogin"); 
		}
	}

	public function	indexlogin(){
		$this->load->view("user/headfoot/headerlogin");
		$this->load->view("user/index"); 
		$this->load->view("user/headfoot/footer");
	}

	public function signup(){
		$this->load->view("user/signup");
	}

	public function do_signup() {
		$this->load->helper('form');
		$this->load->library('form_validation');
		$username = $this->input->post('username');
		$email = $this->input->post('email');
		$nama = $this->input->post('name');
		$password = $this->input->post('password'); 
		$repassword = $this->input->post('repassword');

		if(strlen($password) > 5) {
			if($password == $repassword) {
				$passenc = md5("m@120maH5An~7@mv4N" . $password . "5uKs3ZzZk4PepE3le@~~");
				$data_insert = array(
					'username' => $username, 
					'nama' => $nama,
					'email' => $email, 
					'password' => $passenc);

				$datasession = array(
					'username' => $username,
					'nama' => $nama,
					'email' => $email);

				$res = $this->db->insert('user', $data_insert);
				if($res>=1){
					$this->session->set_userdata('masukin',$datasession);
					redirect('Home/indexlogin');
				} else{
					$data['error'] = 'Email dan Username sudah terdaftar. Silakan Gunakan Email dan Username Lain!';
					$this->load->view('user/signup', $data);
				}
			} else {
				$data['error'] = 'Password tidak sama. Silakan Periksa kembali!';
				$this->load->view('user/signup', $data);
			}
		} else {
			$data['error'] = 'Password minimal 6 karakter!';
			$this->load->view('user/signup', $data);
		}
	}
	
	public function login(){
		$this->load->view("user/login");
	}

	public function do_login() {
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$passenc = md5("m@120maH5An~7@mv4N" . $password . "5uKs3ZzZk4PepE3le@~~");
			$where = array(
				'username' => $username,
				'password' => $passenc
				);
			$cek = $this->Authuser_Model->cek_login("user",$where)->num_rows();

			if($cek > 0){
				$data_session = array(
					'username' => $username,
					'status' => "login");
				$datanow = array(
					'lastLogin' => $this->Authmin_model->now());
				$this->Authuser_Model->updateData('username', $username, 'user', $datanow);
				$this->session->set_userdata('masukin', $data_session);
				redirect(base_url('Home/indexlogin'));
			}else{
				$data['error'] = 'Password Salah!';
				$this->load->view('user/login', $data);
			}
	}

	public function viewProfile(){
		$session = (string)($this->session->userdata('nama'));
		$profil = $this->Authuser_Model->GetProfile("where username = '$session'");
		$data = array(
			"username" => $profil[0]['username'],
			"email" => $profil[0]['email'],
			"nama" => $profil[0]['nama'],
			// "alamat" => $profil[0]['alamat'],
			 );
		$this->load->view('user/orderhistory', $data);
		var_dump($session);
		var_dump($data);
		var_dump($profil);
	}	

	public function logout(){
		$this->session->unset_userdata('masukin');
		$this->session->sess_destroy();
		redirect('Home/index');
	}
}