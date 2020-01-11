<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller {
    public function __construct(){
        parent::__construct();
        if($this->session->userdata('level')!='admin')
        {
            redirect('auth');
        }
        $this->load->model('m_barang','barang');
    }
    
    
    public function add_brg(){
        if (isset($_POST['tambah']))
        {
            $kd = $this->input->post('kd_brg');
            if ($this->barang->getDataBarangByKode($kd)->num_rows() > 0)
            {
                $this->session->set_flashdata('avaible','Kode Barang Sudah Ada !');
                redirect('admin/add_barang');
            }
            else
            {
                $data = $this->input->post(NULL, TRUE);
                $add = $this->barang->addBrg($data);
                
                if ($add)
                {
                    $this->session->set_flashdata('success', 'Tambah Data Barang berhasil');
                    redirect('admin/add_barang');
                }
                else
                {
                    $this->session->set_flashdata('failed', 'Gagal Tambah Barang');
                    redirect('admin/add_barang');
                }
            }
        }
        else
        {
            redirect('admin/data_barang');
        }
    }

    public function edit_brg($id = null)
    {
        if (isset($id))
        {
			$inputan = $this->input->post(NULL, TRUE);
            $upd = $this->barang->updateBrg($inputan);
            
            if ($upd)
            {
                $this->session->set_flashdata('success', 'Update Data Barang Berhasil');
                redirect('admin/data_barang');
            }
            else
            {
                $this->session->set_flashdata('failed', 'Upadate Data Barang Gagal');
                redirect('admin/edit_barang/'.$id);
            }
        }
        else
        {
            redirect('admin/data_barang');
        }
    }

	public function del_brg ($id)
    {
        $hide = $this->barang->hideBrg($id);
        if ($hide)
        {
            $this->session->set_flashdata('success', 'Delete Data Berhasil');
            redirect('admin/data_barang');
        }
        else
        {
            $this->session->set_flashdata('failed', 'Delete Data Gagal');
            redirect('admin/data_barang');
        }
    }
    
    public function barang_terlaris()
    {
        if (isset($_POST['data']))
        {
            $tgl = $this->input->post('data');
            $brg = $this->barang->brgTerlarisHari($tgl)->result();
            $row = array();
            foreach ($brg as $b)
            {
                $row[] = $b;
            }
            echo json_encode($row);
        }
    }

    public function barang_terlaris_bulan()
    {
        if (isset($_POST['data']))
        {
            $tgl = $this->input->post('data');
            $brg = $this->barang->brgTerlarisBulan($tgl)->result();
            $row = array();
            foreach ($brg as $b)
            {
                $row[] = $b;
            }
            echo json_encode($row);
        }
    }
}