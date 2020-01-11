<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kasir extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if(!$this->session->has_userdata('level')){
            redirect('auth');
        }
        $this->load->model('m_kasir','kasir');
        $this->load->model('m_laporan_k','laporan');
    }

    public function index()
    {
        $id = $this->session->id_user;
        $data = array(
            'jumlah_transaksi' => $this->kasir->countPembelian($id)->row('jumlah'),
            'terjual' => $this->kasir->countTerjual($id)->row('jumlah'),
            'top' => $this->kasir->terlarisH($id)->row('nama_b'),
            'stok' => $this->kasir->stok()->result()
        );
        $this->load->view('pegawai/header');
        $this->load->view('pegawai/dashboard');
        $this->load->view('pegawai/home', $data);
        $this->load->view('pegawai/footer');
    }

    public function transaksi()
    {
        date_default_timezone_set('Asia/Jakarta');
        $data = null;
        if(isset($_POST['beli'])){
            $data = $this->input->post();
            $idp = 'TRS-'.date('dmyHis', time());
            $param = array(
                'id_pembelian' => $idp,
                'id_user' => $this->session->userdata('id_user'),
                'tanggal_beli' => date('Y-m-d H:i:s', time())
            );

            unset($data['beli']);
            unset($data['nama']);

            $arr = array();
            foreach ($data as $key => $val)
            {
                foreach ($val as $k => $v)
                {
                    $arr[$k][$key] = $val[$k];
                    $arr[$k]['id_pembelian'] = $idp;
                }
            }
        
            $addPembelian = $this->kasir->addPembelian($param);
            if ($addPembelian)
            {
                $addDetail = $this->kasir->addDetailPembelian($arr);
                if ($addDetail)
                {
                    $this->session->set_flashdata('success', 'Transaksi Berhasil');
                    redirect('kasir/transaksi');
                }
                else
                {
                    $this->session->set_flashdata('failed', 'Transaksi Gagal');
                    redirect('kasir/transaksi');
                }
            }
        }
        $this->load->view('pegawai/header');
        $this->load->view('pegawai/dashboard');
        $this->load->view('pegawai/kasir/transaksi', $data);
        $this->load->view('pegawai/footer');      
    }

    public function namadankode_barang()
    {
        if (isset($_POST['data']))
        {
            $nm = $_POST['data'];
            $data = $this->kasir->getNamaDanKode($nm)->result();
            echo json_encode($data);
        }
    }

    public function get_barang()
    {
        if (isset($_POST['data']))
        {
            $nm = $_POST['data'];
            $data = $this->kasir->getDataBarang($nm)->result();
            echo json_encode($data);
        }
    }

    public function del_detail ($id = null)
    {
        $del = $this->kasir->delDetailPembelian($id);
        if ($del)
        {
            $this->session->set_flashdata('success', 'Delete Data Berhasil');
            redirect('kasir/transaksi');
        }
        else
        {
            $this->session->set_flashdata('failed', 'Delete Data Gagal');
            redirect('kasir/transaksi');
        }
    }
    
    public function del_pembelian ($id = null)
    {
        $del = $this->kasir->delPembelian($id);
        if ($del)
        {
            $this->session->set_flashdata('success', 'Delete Data Berhasil');
            redirect('kasir/transaksi');
        }
        else
        {
            $this->session->set_flashdata('failed', 'Delete Data Gagal');
            redirect('kasir/transaksi');
        }
    }
    
    public function detail_transaksi($id = null)
    {
        if ($id != null)
        {
            $data['detail'] = $this->kasir->getDetailPembelian($id);
            $data['id'] = $id;

            $this->load->view('pegawai/header');
            $this->load->view('pegawai/dashboard');
            $this->load->view('pegawai/kasir/detail_transaksi', $data);
            $this->load->view('pegawai/footer');
        }
    }

    public function ajaxTransaksi()
    {
        $list = $this->kasir->get_datatables();
        $data = array();
        $no = isset($_POST['start']) ? $_POST['start'] : null;
        foreach ($list as $beli) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $beli->id_pembelian;
            $row[] = indo_date($beli->tanggal_beli);
            $row[] = 'Rp. '.number_format($beli->total);
            $row[] = $beli->id_pembelian;

    
            $data[] = $row;
        }
    
        $draw = isset($_POST['draw']) ? $_POST['draw'] : null;
        $output = array(
                        "draw" => $draw,
                        "recordsTotal" => $this->kasir->count_all(),
                        "recordsFiltered" => $this->kasir->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function laporan()
    {
        $data['lap'] = $this->laporan->lapPertgl()->result();

        $this->load->view('pegawai/header');
        $this->load->view('pegawai/dashboard');
        $this->load->view('pegawai/kasir/laporan', $data);
        $this->load->view('pegawai/footer'); 
    }
}