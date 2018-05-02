<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct() {
            parent::__construct();
            $this->CI =& get_instance();

            $this->load->model('Authmin_model');
            $loggedin = $this->session->userdata('loggedin');
            if (empty($loggedin) || $loggedin != true) {
            	
            }
        }

	public function index() {
		redirect('admin/Dashboard');
	}

	public function loginadmin() {
		$usernameAdmin = htmlspecialchars($this->input->post('usernameAdmin'));
		$passwordAdmin = htmlspecialchars($this->input->post('passwordAdmin'));
		$passenc = md5("m@120maH5An~7@mv4N" . $passwordAdmin . "5uKs3ZzZk4PepE3le@~~");
		$isLogin = $this->Authmin_model->loginAdmin($usernameAdmin, $passenc);
		if($isLogin == true) {
			$loginadminData = array(
				'id' => $isLogin[0]->id,
				'username' => $isLogin[0]->username,
				'name' => $isLogin[0]->adminName,
				'role' => $isLogin[0]->role,
				'created' => $isLogin[0]->timeCreated,
				'time' => $isLogin[0]->lastLogin);
			$this->session->set_userdata('loggedin', $loginadminData);
			$timeLogin = array('lastLogin' => $this->Authmin_model->now());
			$this->Authmin_model->updateData('id', $isLogin[0]->id, 'admin', $timeLogin);
			$this->index();
		} else {
			$data['title'] = 'Baleni Admin Portal';
			$data['error'] = 'Email dan Password salah!';
			$this->load->view('admin/login', $data);
		}
	}

	public function logoutadmin() {
		$this->session->unset_userdata('loggedin');
		$this->session->sess_destroy();
		$this->index();
	}

	public function login() {
		$data['title'] = 'Baleni Admin Portal';
		if($this->session->userdata('loggedin')) {
			redirect('admin/Dashboard');
		} else {
			$this->load->view('admin/login', $data);
		}
	}

	public function ubahpass($username) {
		$this->form_validation->set_rules('npassword','New Password','required|matches[cpassword]|min_length[5]');
		$this->form_validation->set_rules('cpassword','Confirm Password','required');
		$opass = md5("m@120maH5An~7@mv4N" . $this->input->post('opassword') . "5uKs3ZzZk4PepE3le@~~");
		$npass = md5("m@120maH5An~7@mv4N" . $this->input->post('npassword') . "5uKs3ZzZk4PepE3le@~~");
		$cpass = md5("m@120maH5An~7@mv4N" . $this->input->post('cpassword') . "5uKs3ZzZk4PepE3le@~~");
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
		redirect('admin/Dashboard/myprofile', $flash);
	}
}
?>