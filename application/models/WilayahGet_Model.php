
<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class WilayahGet_Model extends CI_Model {

	public function __construct()
    {
        parent::__construct();
    }

	public function getKelurahan($id) {
		$this->db->select('nama');
		$this->db->where('id', $id);
		$this->db->from('wilayah_desa');
		$this->db->limit(1);
		$query = $this->db->get();
		if ($query->num_rows() == 1) {
			return $query->result();
		}
		else{
			return false;
		}
	}

	public function getKecamatan($id) {
		$this->db->select('nama');
		$this->db->where('id', $id);
		$this->db->from('wilayah_kecamatan');
		$this->db->limit(1);
		$query = $this->db->get();
		if ($query->num_rows() == 1) {
			return $query->result();
		}
		else{
			return false;
		}
	}

	public function getKota($id) {
		$this->db->select('nama');
		$this->db->where('id', $id);
		$this->db->from('wilayah_kabupaten');
		$this->db->limit(1);
		$query = $this->db->get();
		if ($query->num_rows() == 1) {
			return $query->result();
		}
		else{
			return false;
		}
	}
}
?>