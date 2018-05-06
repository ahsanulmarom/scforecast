<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct() {
            parent::__construct();
            $this->CI =& get_instance();

            $this->load->model('Authmin_model');
            $loggedin = $this->session->userdata('loggedin');
            if (empty($loggedin) || $loggedin != true) {
            	
            }
        }

	public function index() {
		redirect('Dashboard');
	}

	public function loginadmin() {
		$usernameAdmin = htmlspecialchars($this->input->post('usernameAdmin'));
		$passwordAdmin = htmlspecialchars($this->input->post('passwordAdmin'));
		$passenc = $passwordAdmin;
		$isLogin = $this->Authmin_model->loginAdmin($usernameAdmin, $passenc);
		if($isLogin == true) {
			$loginadminData = array(
				'id' => $isLogin[0]->id,
				'username' => $isLogin[0]->username,
				'name' => $isLogin[0]->namaAdmin,
				'created' => $isLogin[0]->createdDate);
			$this->session->set_userdata('loggedin', $loginadminData);
			$this->index();
		} else {
			$data['title'] = 'Ihtiar Jaya SC Page';
			$data['error'] = 'Email dan Password salah!';
			$this->load->view('login', $data);
		}
	}

	public function logout() {
		$this->session->unset_userdata('loggedin');
		$this->session->sess_destroy();
		$this->index();
	}

	public function login() {
		$data['title'] = 'Ihtiar Jaya Forecasting Admin Portal';
		if($this->session->userdata('loggedin')) {
			redirect('Dashboard');
		} else {
			$this->load->view('login', $data);
		}
	}

	public function ubahpass($username) {
		$this->form_validation->set_rules('npassword','New Password','required|matches[cpassword]|min_length[5]');
		$this->form_validation->set_rules('cpassword','Confirm Password','required');
		$opass = $this->input->post('opassword');
		$npass = $this->input->post('npassword');
		$cpass = $this->input->post('cpassword');
		$data['password'] = $npass;

		$do = $this->Authmin_model->getColomn($username);

		if($do[0]->password == $opass) {
			if($cpass == $npass) {
				if(strlen($this->input->post('npassword')) >= 5) {
					$update = $this->Authmin_model->updateData('username', $username, 'admin', $data);
					$flash = $this->session->set_flashdata('success','Password berhasil diganti.');
				} else {
					$flash = $this->session->set_flashdata('error','Password gagal diubah, minimal 5 karakter.');
				}
			} else {
				$flash = $this->session->set_flashdata('error','Cek kembali isian anda.');
			}
		} else {
			$flash = $this->session->set_flashdata('error','Password salah.');
		}
		redirect('Dashboard/myprofile', $flash);
	}
}
?>