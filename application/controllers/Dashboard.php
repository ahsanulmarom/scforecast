<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct() {
            parent::__construct();

            $this->load->model('Authmin_model');
            if (!$this->session->userdata('loggedin')) {
            	redirect('Home/login');
            }
        }

	public function index() {
		$data['title'] = 'Ihtiar Jaya SC Page';
		$this->load->view('headfoot/sider',$data);
		$this->load->view('headfoot/header');
		$this->load->view('dashboard',$data);
		$this->load->view('headfoot/footer');
	}

	public function myprofile() {
		$data['title'] = 'My Profile';
		$this->load->view('headfoot/sider',$data);
		$this->load->view('headfoot/header');
		$this->load->view('profil');
		$this->load->view('headfoot/footer');
	}

	public function forecast() {
		$data['title'] = 'Forecast Now!!!';
		$this->load->view('headfoot/sider',$data);
		$this->load->view('headfoot/header');
		$this->load->view('forecast');
		$this->load->view('headfoot/footer');
	}

	public function highDemandForecast() {
		$data['title'] = 'High Demand Forecast';
		$dataforecast = array(
			'demand' => $this->Authmin_model->getDemandForecast('forecast', 1, 'id', 'ASC'),
			'barang' => 'Kursi Tamu, Dipan, dan Lemari',
			'title' => 'High Demand Forecast');
		$this->load->view('headfoot/sider',$data);
		$this->load->view('headfoot/header');
		$this->load->view('forecasttabel', $dataforecast);
		$this->load->view('headfoot/footer');
	}

	public function mediumDemandForecast() {
		$data['title'] = 'Medium Demand Forecast';
		$dataforecast = array(
			'demand' => $this->Authmin_model->getDemandForecast('forecast', 2, 'id', 'ASC'),
			'barang' => 'Bufet, Lemari Pakaian',
			'title' => 'Medium Demand Forecast');
		$this->load->view('headfoot/sider',$data);
		$this->load->view('headfoot/header');
		$this->load->view('forecasttabel', $dataforecast);
		$this->load->view('headfoot/footer');
	}

	public function lowDemandForecast() {
		$data['title'] = 'Low Demand Forecast';
		$dataforecast = array(
			'demand' => $this->Authmin_model->getDemandForecast('forecast', 3, 'id', 'ASC'),
			'barang' => 'Nakas, Meja Rias, Meja Makan, dan Sofa',
			'title' => 'Low Demand Forecast');
		$this->load->view('headfoot/sider',$data);
		$this->load->view('headfoot/header');
		$this->load->view('forecasttabel', $dataforecast);
		$this->load->view('headfoot/footer');
	}

	public function jumlahpegawai() {
		$data['title'] = 'Forecast Jumlah Pegawai';
		$dataagregat = array(
			'pegawai' => $this->Authmin_model->getdatapegawai(),
			'title' => 'Forecast Jumlah Pegawai');
		$this->load->view('headfoot/sider',$data);
		$this->load->view('headfoot/header');
		$this->load->view('agregattabel', $dataagregat);
		$this->load->view('headfoot/footer');
	}

	public function logharian() {
		$data['title'] = 'Log Demand Harian';
		$datalog = array(
			'log' => $this->Authmin_model->getlogharian(),
			'title' => 'Log Demand Harian');
		$this->load->view('headfoot/sider',$data);
		$this->load->view('headfoot/header');
		$this->load->view('loghariantabel', $datalog);
		$this->load->view('headfoot/footer');
	}

	public function classification($bulan, $tahun) {
		$data['title'] = 'ABC Classification';
		$datalog = array(
			'log' => $this->Authmin_model->getabcsys($bulan, $tahun),
			'title' => 'ABC Classification');
		//echo $this->db->last_query();
		$this->load->view('headfoot/sider',$data);
		$this->load->view('headfoot/header');
		$this->load->view('abcclass', $datalog);
		$this->load->view('headfoot/footer');
	}

	public function rop($bulan, $tahun) {
		$data['title'] = 'Reorder Point';
		$datarop = array(
			'rop' => $this->Authmin_model->getrop($bulan, $tahun),
			'title' => 'Reorder Point');
		$this->load->view('headfoot/sider',$data);
		$this->load->view('headfoot/header');
		$this->load->view('rop', $datarop);
		$this->load->view('headfoot/footer');
	}

	public function tampilrop() {
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		redirect("Dashboard/rop/".$bulan."/".$tahun);
	}

	public function tampilabc() {
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		redirect("Dashboard/classification/".$bulan."/".$tahun);
	}

	public function formdemand() {
		$data['title'] = 'Input Demand';
		$this->load->view('headfoot/sider',$data);
		$this->load->view('headfoot/header');
		$this->load->view('demands');
		$this->load->view('headfoot/footer');
	}

	public function insertdemand() {
		$tanggal = $this->input->post('tanggal');
		$kode = $this->input->post('kodebarang');
		$namabarang = $this->input->post('namabarang');
		$demand = $this->input->post('demand');
		$lead = $this->input->post('leadtime');
		$cost = $this->input->post('cost');
		$time = strtotime($tanggal);
		$bulan = date("m",$time);
		$tahun = date("Y",$time);
		$ceklog = $this->Authmin_model->ceklog($tanggal, $kode);

		if ($ceklog) {
			$this->session->set_flashdata('error','Data sudah diinput sebelumnya');
			redirect('Dashboard/formdemand');
		} else {
		$datainsert = array(
					'tanggal' => $tanggal,
					'kodebarang' => $kode,
					'namabarang' => $namabarang,
					'demand' => $demand,
					'leadtime' => $lead,
					'cost' => $cost);
		$insert = $this->Authmin_model->insertData('demandharian', $datainsert);
		$sumdemand = $this->Authmin_model->getsumdemand($bulan, $tahun, $kode);
		$demandcost = $this->Authmin_model->getdemandcost($bulan, $tahun, $kode);
		$demandlead = $this->Authmin_model->getdemandlead($bulan, $tahun, $kode);
		$cekrop = $this->Authmin_model->cekrop($bulan,$tahun,$kode);
		$cekabc = $this->Authmin_model->cekabc($bulan,$tahun,$kode);
		
		if ($insert) {
			if ($cekrop) {
				$dataupdaterop = array(
					'demandbulan' => $sumdemand[0]->jumlahdemand,
					'lead' => $sumdemand[0]->jumlahlead,
					'costbulan' => $sumdemand[0]->jumlahcost,
					'sd' => (double)$demandlead[0]->sd,
					'sl' => (double)$demandlead[0]->sl);
				$updaterop = $this->Authmin_model->updateData3('bulan', $bulan, 'tahun', $tahun, 'kodebarang', $kode, 'abcrop', $dataupdaterop);
				} else {
					$datainsertrop = array(
						'bulan' => $bulan,
						'tahun' => $tahun,
						'kodebarang' => $kode,
						'namabarang' => $namabarang,
						'demandbulan' => $sumdemand[0]->jumlahdemand,
						'lead' => $sumdemand[0]->jumlahlead,
						'costbulan' => $sumdemand[0]->jumlahcost,
						'sd' => $demandlead[0]->sd,
						'sl' => $demandlead[0]->sl);
				$insertrop = $this->Authmin_model->insertData('abcrop', $datainsertrop);
				//echo $this->db->last_query();
			}

			if ($cekabc) {
				$dataupdateabc = array(
					'demandbulan' => $demandcost[0]->jumlahdemand,
					'cost' => $demandcost[0]->jumlahcost,);
				$updaterop = $this->Authmin_model->updateData3('bulan', $bulan, 'tahun', $tahun, 'kodebarang', $kode, 'abcsys', $dataupdateabc);
				//echo $this->db->last_query();
				$this->session->set_flashdata('success', 'Data berhasil ditambahkan');
				redirect('Dashboard/logharian');
				} else {
					$datainsertabc = array(
						'bulan' => $bulan,
						'tahun' => $tahun,
						'kodebarang' => $kode,
						'namabarang' => $namabarang,
						'demandbulan' => $sumdemand[0]->jumlahdemand,
						'cost' => $sumdemand[0]->jumlahcost);
				$insertrop = $this->Authmin_model->insertData('abcsys', $datainsertabc);
				//echo $this->db->last_query();
				$this->session->set_flashdata('success', 'Data berhasil ditambahkan');
				redirect('Dashboard/logharian');
			}
		} else {
			$this->session->set_flashdata('error','Gagal Menambahkan Data');
			redirect('Dashboard/formdemand');
		}
		}
	}

	public function forecastnow() {
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		$demand = $this->input->post('demand');
		$alpha = $this->input->post('alpha');
		$tipe = $this->input->post('tipe');
		$bulan0 = 0;
		$hasil = 0;
		$dataupdate['demand'] = $demand;

		if($bulan == 1) {
			$bulan0 = 12;
			$tahun = $tahun-1;
		} else {
			$bulan0 = $bulan-1;
		}

		if ($this->Authmin_model->getlastforecast($bulan, $tahun, $tipe)) {
			$this->session->set_flashdata('error','Forecast Gagal. Data Sudah Ada.');
			redirect('Dashboard/forecast');
		} else {
		$update = $this->Authmin_model->updateData3('bulan', $bulan0, 'tahun', $tahun, 'type', $tipe, 'forecast', $dataupdate);

			$lastforecast = $this->Authmin_model->getlastforecast($bulan0, $tahun, $tipe);
			$lsvalue = $lastforecast[0]->forecast;
			if ($lastforecast) {
				$hasil = $lsvalue+($alpha*($demand - $lsvalue));
				$datainsert = array(
					'bulan' => $bulan,
					'tahun' => $tahun,
					'alfa' => $alpha,
					'forecast' => $hasil,
					'type' => $tipe);
				$insert = $this->Authmin_model->insertData('forecast', $datainsert);

				$sumforecast = $this->Authmin_model->getsumforecast($bulan, $tahun);
				$cekagregat = $this->Authmin_model->agregatcek($bulan, $tahun);
				
				if ($cekagregat) {
					$dataupdateagregat['forecasting'] = $sumforecast[0]->jumlah;
					$updateagregat = $this->Authmin_model->updateData2('bulan', $bulan, 'tahun', $tahun, 'agregat', $dataupdateagregat);
				} else {
					$datainsertagregat = array(
						'bulan' => $bulan,
						'tahun' => $tahun,
						'forecasting' => $sumforecast[0]->jumlah);
					$insertagregat = $this->Authmin_model->insertData('agregat', $datainsertagregat);
				}

				if ($insert) {
					$this->session->set_flashdata('success', 'Forecast berhasil dilakukan ');
					if ($tipe == 1) {
						redirect('Dashboard/highDemandForecast');
					} else if ($tipe == 2) {
						redirect('Dashboard/mediumDemandForecast');
					} else if ($tipe == 3) {
						redirect('Dashboard/lowDemandForecast');
					}
				} else {
					$this->session->set_flashdata('error','Gagal insert. Cek isian anda.');
					redirect('Dashboard/forecast');
				}
			} else {
					$this->session->set_flashdata('error','Forecast Gagal. Forecast bulan sebelumnya belum dimasukkan.');
					redirect('Dashboard/forecast');
			}
		}
	}
}