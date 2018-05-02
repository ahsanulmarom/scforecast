
<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Authuser_model extends CI_Model {

	public function __construct()
    {
        parent::__construct();
    }

	public function cek_login($table,$where){		
		return $this->db->get_where($table,$where);
	}

	public function getAllData($namaTabel, $urut, $asc) {
		$this->db->select('*');
		$this->db->from($namaTabel);
		$this->db->order_by($urut, $asc);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		else{
			return false;
		}
	}

	public function GetProfile($where){
			$data = $this->db->get('user ' . $where);
			return $data->result_array();
	}	

	public function ambildetiluser($username) {
		$this->db->select('*');
		$this->db->where('username', $username);
		$this->db->from('user');
		$this->db->limit(1);
		$query = $this->db->get();
		if ($query->num_rows() == 1) {
			return $query->result();
		}
		else{
			return false;
		}
	}	

	public function insertData($namaTabel, $data) {
		try{
			$hasil = $this->db->insert($namaTabel, $data);
			if (!$hasil) {
				throw new Exception('error in query');
				return false;
			}
			return $hasil;
		} catch(Exception $e) {
			return false;
		}
	}

	function cekrand($kode){
		$this->db->where('kode_order', $kode);
        $this->db->from('order');
        $num = $this->db->count_all_results();
        return $num;
	}

	function get_all_kabupaten() {
		$this->db->select('*');
		$this->db->from('wilayah_kabupaten');
		$query = $this->db->get();
		return $query->result();
	}

	function getSomeOrder_byKode($param){
		$query = $this->db->select('*')
			->join('user','user.username=order.usercustomer')
			->where('kode_order',$param)
			->from('order')
			->get();
		return ($query->num_rows() >0)? $query->result() : false;
	}

	function hasil_beli($id){
		$this->db->select('*');
		$this->db->join('menu','menu.kode=detil_order.kodebarang');
		$this->db->where('orderid',$id);
		$this->db->from('detil_order');
		$query = $this->db->get();
		if($query->num_rows() >0) {
			return $query->result();
		}
		return false;
	}

	public function updateData($where, $wheredata, $namaTabel, $data) {
		$this->db->where($where, $wheredata);
		$this->db->update($namaTabel, $data);
	}

	public function getOrderUser($username) {
		$this->db->select('*');
		$this->db->where('usercustomer',$username);
		$this->db->from('order');
		$query = $this->db->get();
		if($query->num_rows() >0) {
			return $query->result_array();
		}
		return false;
	}
}
?>