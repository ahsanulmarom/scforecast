<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Authmin_model extends CI_Model {

	public function __construct()
    {
        parent::__construct();
    }

	public function loginAdmin($usernameAdmin, $passwordAdmin) {
		$this->db->select('*');
		$this->db->where('username', $usernameAdmin);
		$this->db->where('password', $passwordAdmin);
		$this->db->from('admin');
		$this->db->limit(1);
		$query = $this->db->get();
		if ($query->num_rows() == 1) {
			return $query->result();
		}
		else{
			return false;
		}
	}

	public function getColomn($user){
		$query = $this->db->select('*')
			->from('admin')
			->where('username',$user)
			->get();
		if ($query->num_rows() > 0) {
			return $query->result();
		}else{
			return false;
		}
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

	public function getData($namaTabel) {
		$this->db->select('*');
		$this->db->from($namaTabel);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
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

	public function deleteData($namaTabel, $where, $data) {
		$this->db->where($where, $data);
		$this->db->delete($namaTabel);
	}

	public function updateData($where, $wheredata, $namaTabel, $data) {
		$this->db->where($where, $wheredata);
		$this->db->update($namaTabel, $data);
	}
}
?>