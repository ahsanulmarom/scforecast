<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct() {
            parent::__construct();

            $this->load->model('Authmin_model');
            if (!$this->session->userdata('loggedin')) {
            	redirect('admin/Auth/login');
            }
        }

	public function index() {
		$data['title'] = 'Baleni Dashboard';
		$dataload = array(
			'topmenu' => $this->Authmin_model->getTopMenu(),
			'title' => 'Baleni Dashboard',
			'total' => $this->Authmin_model->getTotalOrderMenu());
		$this->load->view('admin/headfoot/sider',$data);
		$this->load->view('admin/headfoot/header');
		$this->load->view('admin/dashboard',$dataload);
		$this->load->view('admin/headfoot/footer');
	}

	public function myprofile() {
		$data['title'] = 'My Profile';
		$this->load->view('admin/headfoot/sider',$data);
		$this->load->view('admin/headfoot/header');
		$this->load->view('admin/profil');
		$this->load->view('admin/headfoot/footer');
	}

	public function manageAdmin() {
		$data['title'] = 'Manage Admin';
		$dataadmin = array(
			'admin'=> $this->Authmin_model->getAllData('admin', 'lastLogin', 'DESC'));
		$this->load->view('admin/headfoot/sider',$data);
		$this->load->view('admin/headfoot/header');
		$this->load->view('admin/listadmin', $dataadmin);
		$this->load->view('admin/headfoot/footer');
	}

	public function manageUser() {
		$data['title'] = 'Manage User';
		$datauser = array(
			'user'=> $this->Authmin_model->getAllData('user', 'lastLogin', 'DESC'));
		$this->load->view('admin/headfoot/sider',$data);
		$this->load->view('admin/headfoot/header');
		$this->load->view('admin/listuser', $datauser);
		$this->load->view('admin/headfoot/footer');
	}

	public function category() {
		$data['title'] = 'Manage Category';
		$datacategory = array(
			'kategori' => $this->Authmin_model->getAllData('kategori', 'namaKategori', 'ASC'),
			'title' => 'Manage Category');
		$this->load->view('admin/headfoot/sider',$data);
		$this->load->view('admin/headfoot/header');
		$this->load->view('admin/category', $datacategory);
		$this->load->view('admin/headfoot/footer');
	}

	public function addMenu() {
		$data['title'] = 'Add Menu';
		$datacategory = array(
			'namakategori' => $this->Authmin_model->getAllData('kategori','namaKategori', 'ASC'),
			'title' => 'Add Menu');
		$this->load->view('admin/headfoot/sider',$data);
		$this->load->view('admin/headfoot/header');
		$this->load->view('admin/addMenu', $datacategory);
		$this->load->view('admin/headfoot/footer');
	}

	public function insertMenu() {
		$kode = htmlspecialchars($this->input->post('kodemenu'));
		$nama = htmlspecialchars(strtoupper($this->input->post('namamenu')));
		$kategori = $this->input->post('kategorimenu');
		$harga = $this->input->post('hargamenu');
		$deskripsi = htmlspecialchars($this->input->post('deskripmenu'));

		$config = array(
				'upload_path'=> './assets/fotomenu/',
				'allowed_types'=>'gif|jpg|png|jpeg',
				'max_size'=>2048,
				'overwrite'=>true,
				'file_name'=> $kategori . '_' . $this->input->post('kodemenu'));
		$this->upload->initialize($config);
		$upload = $this->upload->do_upload('previewimage');

		if($upload) {
			$datainsert = array(
				'kode' => $kode,
				'nama' => $nama,
				'kategori' => $kategori,
				'harga' => $harga,
				'deskripsi' => $deskripsi,
				'image' => 'assets/fotomenu/'.$this->upload->data('file_name'));

			$insert = $this->Authmin_model->InsertData('menu', $datainsert);
			if($insert) {
				$this->session->set_flashdata('success', ' '. $nama . " berhasil ditambahkan ke menu.");
				redirect('admin/Dashboard/addMenu');
			} else {
				$this->session->set_flashdata('error','Menu gagal ditambahkan, cek kode makanan.');
				redirect('admin/Dashboard/addMenu');
			}
		} else {
				$this->session->set_flashdata('error','Gagal upload Gambar. Maksimal gambar adalah 2MB');
				redirect('admin/Dashboard/addMenu');
		}
	}

	public function addCategory() {
		$newcategory = htmlspecialchars(strtoupper(str_replace (" ", "", $this->input->post('newcategory'))));
		$datainsert = array('namaKategori' => $newcategory);
		$hasil = $this->Authmin_model->InsertData('kategori', $datainsert);
		if($hasil) {
			$this->session->set_flashdata('success','Kategori ' . $newcategory . " berhasil ditambahkan.");
			redirect('admin/Dashboard/category');
		} else {
			$this->session->set_flashdata('error','Kategori gagal ditambahkan!');
			redirect('admin/Dashboard/category');
		}
	}

	public function deleteCategory($id) {
		$this->Authmin_model->deleteData('kategori', 'id', $id);
		$this->session->set_flashdata('success','Kategori berhasil Dihapus.');
			redirect('admin/Dashboard/category');
	}

	public function addAdmin() {
		$data['title'] = 'Add Admin';
		$this->load->view('admin/headfoot/sider',$data);
		$this->load->view('admin/headfoot/header');
		$this->load->view('admin/addAdmin');
		$this->load->view('admin/headfoot/footer');
	}

	public function insertAdmin() {
		$email = htmlspecialchars($this->input->post('emailnewadmin'));
		$password = htmlspecialchars($this->input->post('passwordnewadmin'));
		$passenc = md5("m@120maH5An~7@mv4N" . $password . "5uKs3ZzZk4PepE3le@~~");
		$name = htmlspecialchars($this->input->post('namenewadmin'));
		$role = $this->input->post('rolenewadmin');

		$datainsert = array(
			'username' => $email,
			'password' => $passenc,
			'adminName' => $name,
			'role' => $role);

		$hasil = $this->Authmin_model->InsertData('admin', $datainsert);
		if($hasil) {
			$this->session->set_flashdata('success','Admin ' . $email . " berhasil ditambahkan.");
			redirect('admin/Dashboard/addAdmin');
		} else {
			$this->session->set_flashdata('error','Admin gagal ditambahkan. Email sudah digunakan!');
			redirect('admin/Dashboard/addAdmin');
		}
	}

	public function deleteadmin($id) {
		$this->Authmin_model->deleteData('admin', 'id', $id);
		$this->session->set_flashdata('success','Admin berhasil Dihapus.');
			redirect('admin/Dashboard/manageAdmin');
	}

	public function manageMenu() {
		$data['title'] = 'Manage Menu';
		$datamenu = array(
			'menu' => $this->Authmin_model->getAllData('menu', 'nama', 'ASC'));
		$this->load->view('admin/headfoot/sider',$data);
		$this->load->view('admin/headfoot/header');
		$this->load->view('admin/listMenu', $datamenu);
		$this->load->view('admin/headfoot/footer');
	}

		public function deleteMenu($kode) {
		$this->Authmin_model->deleteData('menu', 'kode', $kode);
		$this->session->set_flashdata('success','menu berhasil Dihapus.');
			redirect('admin/Dashboard/managemenu');
	}

	public function editMenu($kode) {
		$data['title'] = 'Edit Menu';
		$dataSelMenu= array(
			'kategori' => $this->Authmin_model->getAllData('kategori','namaKategori', 'ASC'),
			'kategoripil' => $this->Authmin_model->getData('kategori'),
			'barang' => $this->Authmin_model->getSelData('menu', 'kode', $kode),
			'title' => 'Edit Menu');
		$this->load->view('admin/headfoot/sider',$data);
		$this->load->view('admin/headfoot/header');
		$this->load->view('admin/editMenu', $dataSelMenu);
		$this->load->view('admin/headfoot/footer');
	}

	public function updateMenu() {
		$kode = htmlspecialchars($this->input->post('kodemenu'));
		$nama = htmlspecialchars(strtoupper($this->input->post('namamenu')));
		$kategori = $this->input->post('kategorimenu');
		$harga = $this->input->post('hargamenu');
		$deskripsi = htmlspecialchars($this->input->post('deskripmenu'));

		$config = array(
				'upload_path'=> './assets/fotomenu/',
				'allowed_types'=>'gif|jpg|png|jpeg',
				'max_size'=>2048,
				'overwrite'=>true,
				'file_name'=> $kategori . '_' . $this->input->post('kodemenu'));
		$this->upload->initialize($config);
		$upload = $this->upload->do_upload('previewimage');

		if($upload) {
			$dataupdate = array(
				'nama' => $nama,
				'kategori' => $kategori,
				'harga' => $harga,
				'deskripsi' => $deskripsi,
				'image' => 'assets/fotomenu/'.$this->upload->data('file_name'));

			$update = $this->Authmin_model->updateData('kode', $kode, 'menu', $dataupdate);
			$this->session->set_flashdata('success', ' '. $nama . " berhasil diupdate.");
			redirect('admin/Dashboard/addMenu');
		} else {
				$this->session->set_flashdata('error','Gagal upload Gambar. Maksimal gambar adalah 2MB');
				redirect('admin/Dashboard/addMenu');
		}
	}

	public function manageorders() {
		$data['title'] = 'Manage Order';
		$dataorder = array(
			'orderan' => $this->Authmin_model->getorder(),
			'title' => 'Manage Order');
		$this->load->view('admin/headfoot/sider',$data);
		$this->load->view('admin/headfoot/header');
		$this->load->view('admin/listorder', $dataorder);
		$this->load->view('admin/headfoot/footer');
	}

	public function orderdetilinfo($id) {
        $order = $this->Authmin_model->get_order_id($id);
        $order_det = $this->Authmin_model->getDetilOrder($id);
        $data =array(
            'kode'=>$order[0]->kode_order,
            'tanggal'=>$order[0]->tanggalorder,
            'tanggalkirim'=>$order[0]->tanggalkirim,
            'alamat'=>$order[0]->alamat,
            'total'=>$order[0]->totalbayar,
            'status'=>$order[0]->status,
            'buktibayar'=>$order[0]->image,
            'sudahbayar'=>$order[0]->jumlahbayar,
            'barang'=>$order_det
            );
        echo json_encode($data);
	}

	public function updatestatus($kode) {
		$data = array(
			'status' => $this->input->post('status')
			);
		$update = $this->Authmin_model->updateData('kode_order', $kode, 'order', $data);
		if ($this->input->post('status') == 'Pesanan Ditolak/Dibatalkan') {
			$flash = $this->session->set_flashdata('error', 'Status Pemesanan ' . $kode . ' diubah menjadi ' . $this->input->post('status'));
		} else {
			$flash = $this->session->set_flashdata('success', 'Status Pemesanan ' . $kode . ' berhasil diubah menjadi ' . $this->input->post('status'));
		}
		redirect('admin/Dashboard/manageorders', $flash);
	}

}