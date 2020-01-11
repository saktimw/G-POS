<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('level')!='kasir')
        {
            redirect('auth');
        }
        $this->load->library('pdf_report');
        $this->load->model('m_laporan_k', 'lapkasir');
    }

    public function index()
    {
        $this->load->view('pegawai/header');
        $this->load->view('pegawai/dashboard');
        $this->load->view('pegawai/kasir/laporan');
		$this->load->view('pegawai/footer');
    }

    public function pdf_laphari($tgl = null)
    {
        $data = array(
            'data' => $this->lapkasir->laporan_transaksi($tgl)->result(),
            'tgl' => $tgl
        );
        $this->load->view('pegawai/kasir/laporan/r_harian', $data);
    }

    public function detail_laporan($tgl = null)
    {
        $data = array(
            'detail' => $this->lapkasir->laporan_transaksi($tgl)->result()
        );
        $this->load->view('pegawai/header');
        $this->load->view('pegawai/dashboard');
        $this->load->view('pegawai/kasir/detail_laporan', $data);
        $this->load->view('pegawai/footer');
    }
    
    public function del($id)
    {
        $del = $this->lapkasir->delLapHari($id);
    
        $this->load->view('pegawai/header');
        $this->load->view('pegawai/dashboard');
        $this->load->view('pegawai/kasir/laporan');
        $this->load->view('pegawai/footer');
    }
}