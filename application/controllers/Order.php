<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Authuser_Model');
		$this->load->model('WilayahGet_Model');
		$this->load->helper('url');

		$loggedin = $this->session->userdata('masukin');
	}

	function add(){
		$addtocart = array(
			'id' =>$this->input->post('id'),
			'name'=>$this->input->post('name'),
			'price'=>$this->input->post('price'),
			'qty'=> $this->input->post('qty'),
			'deskripsi'=>$this->input->post('deskripsi')
			);
		$this->cart->insert($addtocart);
		redirect('Home_Dashboard/shoppingcart');
	}

	function remove($rowid){
		if ($rowid==="all"){
			$this->cart->destroy();
		}else{
			$data = array(
			'rowid' => $rowid,
			'qty' => 0
			);
			$this->cart->update($data);
		}

		redirect('Home_Dashboard/shoppingcart');
	}

	function update_cart(){
	// Recieve post values,calcute them and update
	$cart_info = $_POST['cart'] ;
	foreach( $cart_info as $id => $cart){
		$rowid = $cart['rowid'];
		$price = $cart['price'];
		$amount = $price * $cart['qty'];
		$qty = $cart['qty'];

		$data = array(
		'rowid' => $rowid,
		'price' => $price,
		'amount' => $amount,
		'qty' => $qty
		);

		$this->cart->update($data);
	}
	redirect('Home_Dashboard/shoppingcart');
	// var_dump($cart_info);
	}

	function add_ajax_kec($id_kab){
        $query = $this->db->get_where('wilayah_kecamatan',array('kabupaten_id'=>$id_kab));
        $data = "<option value=''> -- Pilih Kecamatan -- </option>";
        foreach ($query->result() as $value) {
            $data .= "<option value='".$value->id."'>".$value->nama."</option>";
        }
        echo $data;
    }

    function add_ajax_des($id_kec){
      $query = $this->db->get_where('wilayah_desa',array('kecamatan_id'=>$id_kec));
      $data = "<option value=''> - Pilih Kelurahan - </option>";
      foreach ($query->result() as $value) {
          $data .= "<option value='".$value->id."'>".$value->nama."</option>";
      }
      echo $data;
  	}

	function saveOrder(){
		$user = $this->Authuser_Model->ambildetiluser($this->session->userdata('masukin')['username']);
		$kelurahan = $this->WilayahGet_Model->getKelurahan($this->input->post('des'));
		$kecamatan = $this->WilayahGet_Model->getKecamatan($this->input->post('kec'));
		$kota = $this->WilayahGet_Model->getKota($this->input->post('kab'));
		$this->form_validation->set_rules('alamat','Alamat Penerima','required|trim|min_length[5]');
		$nama = $this->input->post('nama');
		$alamat = $this->input->post('alamat').', '.$kelurahan[0]->nama.', '.$kecamatan[0]->nama.', '.$kota[0]->nama;
		$tanggalkirim = $this->input->post('tglkirim');
		$telp = $this->input->post('telp');
		do{
		        $kode = $this->randString(3);
		        $num = $this->Authuser_Model->cekrand($kode);
			} while($num>=1);

		if ($this->form_validation->run()) {
			$order = array(			
				'usercustomer'=>$this->session->userdata('masukin')['username'],
				'kode_order'=>$kode,
				'alamat'=>$alamat,
				'noTelp'=>$telp,
				'tanggalkirim'=> $tanggalkirim,
				'totalbayar'=>($this->input->post('subtotal')+$kode));
			$orid = $this->Authuser_Model->insertData('order',$order);
			if ($cart = $this->cart->contents()) {
				foreach ($cart as $c) {
					$detil = array(
						'orderid'=>$kode,
						'kodebarang'=>$c['id'],
						'kuantitas'=>$c['qty'],
						'harga'=>$c['price'],
						'deskripsi_order'=>$c['deskripsi']);
				$this->Authuser_Model->insertData('detil_order',$detil);
				}
			$this->cart->destroy();
			}
		}else{
			echo validation_errors();
			redirect('Home_Dashboard/shoppingcart');
		}
		redirect('Home_Dashboard/review/'.$kode);
	}

	function randString($panjang){
		 $characters = '1234567890';
		 $string = '';
		 $max = strlen($characters) - 1;
		 for ($i = 0; $i < $panjang; $i++) {
		      $string .= $characters[mt_rand(0, $max)];
		 }
		 return $string;
	}

	public function saveBayar() {
		$kode = htmlspecialchars($this->input->post('kode'));
		$nama = htmlspecialchars($this->input->post('namabayar'));
		$jumlah = $this->input->post('jumlahbayar');

		$config = array(
				'upload_path'=> './assets/buktibayar/',
				'allowed_types'=>'gif|jpg|png|jpeg',
				'max_size'=>2048,
				'overwrite'=>true,
				'file_name'=> 'BAYAR_' . $this->input->post('kode'));
		$this->upload->initialize($config);
		$upload = $this->upload->do_upload('buktibayar');

		if($upload) {
			$datainsert = array(
				'kode' => $kode,
				'username' => $this->session->userdata('masukin')['username'],
				'namabayar' => $nama,
				'jumlahbayar' => $jumlah,
				'image' => 'assets/buktibayar/'.$this->upload->data('file_name'));

			$insert = $this->Authuser_Model->InsertData('buktibayar', $datainsert);

			$dataupdate = array(
				'status' => 'Pembayaran Telah Dilakukan');
			$update = $this->Authuser_Model->updateData('kode_order', $kode, 'order', $dataupdate);

			if($insert) {
				$this->session->set_flashdata('success', 'Pesanan ' . $kode . " berhasil dikonfirmasi. Pembayaran Anda menunggu konfirmasi admin.");
				redirect('Home_Dashboard/confirm/'.$kode);
			} else {
				$this->session->set_flashdata('error','Gagal Konfirmasi Pembayaran, pastikan isian benar! Cek Status Pesanan Anda!');
				redirect('Home_Dashboard/confirm/'.$kode);
			}
		} else {
				$this->session->set_flashdata('error','Gagal upload bukti bayar. Maksimal gambar adalah 2MB');
				redirect('Home_Dashboard/confirm/'.$kode);
		}
	}
}