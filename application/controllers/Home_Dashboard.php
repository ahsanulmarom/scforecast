<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_Dashboard extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Authuser_Model');
		$this->load->helper('url');

		$loggedin = $this->session->userdata('masukin');
	}

	public function menu(){
		$menu = array(
			'menu' => $this->Authuser_Model->getAllData('menu', 'nama', 'ASC'));
		if($this->session->userdata('masukin')) {
			$this->load->view("user/headfoot/headerlogin"); 
		} else {
			$this->load->view("user/headfoot/header"); 
		}
		$this->load->view("user/menu", $menu);
		$this->load->view("user/headfoot/footer");
	}	

	public function shoppingcart() {
		$this->load->view("user/headfoot/headerlogin");
		if (empty($this->session->userdata('masukin'))) {
			redirect('Home/login');
		} else {
			$sess = $this->session->userdata('masukin')['username'];
			$data['detail'] = $this->Authuser_Model->ambildetiluser($sess)[0];
			$data['kota'] = $this->Authuser_Model->get_all_kabupaten();
			$this->load->view("user/shoppingcart",$data);
		}
		$this->load->view("user/headfoot/footer");
	}

	public function review($kodeorder) { 
		$this->load->view("user/headfoot/headerlogin");
		if (empty($this->session->userdata('masukin'))) {
			redirect('Home/index');
		} else {
			if (empty($kodeorder)) { 
				redirect('Home/category'); 
			} 
			$orid = $this->Authuser_Model->getSomeOrder_byKode($kodeorder); 
			$usname = $orid[0]->username; 
			$uname = $this->session->userdata('masukin')['username']; 
			$barang = $this->Authuser_Model->hasil_beli($orid[0]->kode_order);  
			$i = array( 
				'kode'=>$kodeorder, 
				'nama'=>$orid[0]->nama, 
				'alamat'=>$orid[0]->alamat,  
				'kontak'=>$orid[0]->noTelp,  
				'status'=>$orid[0]->status,
				'tanggalkirim'=> $orid[0]->tanggalkirim,
				'barang'=>$barang);
			if (empty($this->session->userdata('masukin'))) { 
				redirect('Home/login'); 
			}elseif ($usname != $uname) { 
				redirect('Home_Dashboard/menu'); 
			}else{ 
				$this->load->view("user/review",$i); 
			} 
		}
	  $this->load->view("user/headfoot/footer");
	} 

	public function confirm($kode) {
		$this->load->view('user/headfoot/headerlogin');
		if (empty($this->session->userdata('masukin'))) {
			redirect('Home/index');
		} else {
		if (empty($kode)) { 
      		redirect('Home_Dashboard/menu'); 
    	}
    	$order = $this->Authuser_Model->getSomeOrder_byKode($kode);
    	$detilorder = array(
    		'kode' => $order[0]->kode_order,
    		'total' => $order[0]->totalbayar
				);
		$this->load->view("user/konfirmasi", $detilorder);
		}
		$this->load->view('user/headfoot/footer');
	}

	public function history() {
		$this->load->view("user/headfoot/headerlogin");

		if (empty($this->session->userdata('masukin'))) {
			redirect('Home/index');
		} else {
			$user = $this->session->userdata('masukin')['username'];
			$order = array(
				'orderan' => $this->Authuser_Model->getOrderUser($user)
				);
			$this->load->view('user/orderhistory', $order);
		}
		$this->load->view("user/headfoot/footer");
	}	
}