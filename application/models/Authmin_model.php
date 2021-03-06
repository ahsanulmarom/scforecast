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

	public function getsumforecast($bulan, $tahun) {
		$this->db->select('sum(forecast) as jumlah');
		$this->db->from('forecast');
		$this->db->where('bulan', $bulan);
		$this->db->where('tahun', $tahun);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result();
		}
		else{
			return false;
		}
	}

	public function getsumdemand($bulan, $tahun, $kode) {
		$this->db->select('avg(demand) as jumlahdemand, avg(leadtime) as jumlahlead, avg(cost) as jumlahcost');
		$this->db->from('demandharian');
		$this->db->where('month(tanggal)', $bulan);
		$this->db->where('year(tanggal)', $tahun);
		$this->db->where('kodebarang', $kode);
		$query = $this->db->get();
		if ($query && $query->num_rows() == 1) {
			return $query->result();
		}
		else{
			return false;
		}
	}

	public function getdemandcost($bulan, $tahun, $kode) {
		$this->db->select('sum(demand) as jumlahdemand, avg(cost) as jumlahcost');
		$this->db->from('demandharian');
		$this->db->where('month(tanggal)', $bulan);
		$this->db->where('year(tanggal)', $tahun);
		$this->db->where('kodebarang', $kode);
		$query = $this->db->get();
		if ($query && $query->num_rows() == 1) {
			return $query->result();
		}
		else{
			return false;
		}
	}

	public function getdemandlead($bulan, $tahun, $kode) {
		$this->db->select('stddev(demand) as sd, stddev(leadtime) as sl');
		$this->db->from('demandharian');
		$this->db->where('month(tanggal)', $bulan);
		$this->db->where('year(tanggal)', $tahun);
		$this->db->where('kodebarang', $kode);
		$query = $this->db->get();
		if ($query && $query->num_rows() == 1) {
			return $query->result();
		}
		else{
			return false;
		}
	}

	public function getdatapegawai() {
		$this->db->select('*');
		$this->db->from('agregat');
		$this->db->order_by('id');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		else{
			return false;
		}
	}

	public function getlogharian() {
		$this->db->select('*');
		$this->db->from('demandharian');
		$this->db->order_by('tanggal');
		$this->db->order_by('kodebarang');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		else{
			return false;
		}
	}

	public function getabcsys($bulan, $tahun) {
		$query1 = "SET @sum := 0;";
        $this->db->query($query1);
		$this->db->select(//'rop, 
			'abcsys.bulan, abcsys.tahun, abcsys.kodebarang, cost, abcsys.demandbulan, abcsys.namabarang, abcsys.demandcost, (@sum := @sum + abcsys.demandcost) AS CumulativeSum, 
			(@sum/(SELECT sum(abcsys.demandcost) FROM abcsys where abcsys.bulan='.$bulan.' and abcsys.tahun='.$tahun.')*100) as prosentase');
		$this->db->from('abcsys');
		//$this->db->join('abcrop', 'abcrop.kodebarang = abcsys.kodebarang');
		$this->db->where('abcsys.bulan', $bulan);
		$this->db->where('abcsys.tahun', $tahun);
		//$this->db->where('abcrop.bulan', $bulan);
		//$this->db->where('abcrop.tahun', $tahun);
		$this->db->order_by('demandcost', 'desc');
		$query = $this->db->get();
		if ($query && $query->num_rows() > 0) {
			return $query->result_array();
		}
		else{
			return false;
		}
	}

	public function getrop($bulan, $tahun) {
		$this->db->select('*');
		$this->db->from('abcrop');
		$this->db->where('bulan', $bulan);
		$this->db->where('tahun', $tahun);
		$this->db->order_by('kodebarang');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		else{
			return false;
		}
	}
	
	public function getDemandForecast($namaTabel, $syarat, $urut, $asc) {
		$this->db->select('*');
		$this->db->from($namaTabel);
		$this->db->where('type', $syarat);
		$this->db->order_by($urut, $asc);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		else{
			return false;
		}
	}

	public function getlastforecast($bulan, $tahun, $type) {
		$this->db->select('*');
		$this->db->from('forecast');
		$this->db->where('bulan', $bulan);
		$this->db->where('tahun', $tahun);
		$this->db->where('type', $type);
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

	public function agregatcek($bulan, $tahun) {
		$this->db->select('*');
		$this->db->from('agregat');
		$this->db->where('bulan', $bulan);
		$this->db->where('tahun', $tahun);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return true;
		}
		else{
			return false;
		}
	}

	public function cekrop($bulan, $tahun, $kode) {
		$this->db->select('*');
		$this->db->from('abcrop');
		$this->db->where('bulan', $bulan);
		$this->db->where('tahun', $tahun);
		$this->db->where('kodebarang', $kode);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return true;
		}
		else{
			return false;
		}
	}

	public function cekabc($bulan, $tahun, $kode) {
		$this->db->select('*');
		$this->db->from('abcsys');
		$this->db->where('bulan', $bulan);
		$this->db->where('tahun', $tahun);
		$this->db->where('kodebarang', $kode);
		$query = $this->db->get();
		if ($query && $query->num_rows() == 1) {
			return true;
		}
		else{
			return false;
		}
	}

	public function ceklog($tanggal, $kode) {
		$this->db->select('*');
		$this->db->from('demandharian');
		$this->db->where('tanggal', $tanggal);
		$this->db->where('kodebarang', $kode);
		$query = $this->db->get();
		if ($query && $query->num_rows() == 1) {
			return true;
		}
		else{
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

	public function updateData2($where1, $wheredata1, $where2, $wheredata2, $namaTabel, $data) {
		$this->db->where($where1, $wheredata1);
		$this->db->where($where2, $wheredata2);
		$this->db->update($namaTabel, $data);
	}

	public function updateData3($where1, $wheredata1, $where2, $wheredata2, $where3, $wheredata3, $namaTabel, $data) {
		$this->db->where($where1, $wheredata1);
		$this->db->where($where2, $wheredata2);
		$this->db->where($where3, $wheredata3);
		$this->db->update($namaTabel, $data);
	}

	function std_deviation($arr){
    $arrsize=count($arr);
    $mu=array_sum($arr)/$arr_size;
    $ans=0;
    foreach($arr as $elem){
        $ans+=pow(($elem-$mu),2);
    }
    return $ans/$arr_size;
}
}
?>