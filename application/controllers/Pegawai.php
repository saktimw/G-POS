<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai extends CI_Controller {

	public function __construct()
	{
        parent::__construct();
        if($this->session->userdata('level')!='admin')
        {
            redirect('auth');
        }
        $this->load->model('m_pegawai', 'pegawai');

        $config['upload_path'] = './img/foto_pegawai/';
        $config['allowed_types'] = 'jpg|png';
        $config['max_size'] = 10048;
        $this->load->library('upload', $config);
    }

    public function index()
    {
        if ($this->session->level)
        {
            redirect('admin');
        }
    }

    public function add_pegawai ()
    {
        if ($_POST['tambah'])
        {
            if($this->upload->do_upload('foto'))
            {
                $data = $this->input->post();
                $foto = $this->upload->data('orig_name');
                $add = $this->pegawai->addPegawai($data, $foto);
                if ($add)
                {
                    $this->session->set_flashdata('success','Tambah Data Pegawai Berhasil');
                    redirect('admin/add_pegawai');
                }
                else
                {
                    $this->session->set_flashdata('failed','Tambah Data Pegawai Gagal');
                    redirect('admin/add_pegawai');
                }
            }
            else
            {
                $this->session->set_flashdata('failed','Tambah Data Pegawai Gagal');
                redirect('admin/add_pegawai');
            }
        }
    }

    public function del_pegawai ($id)
    {
        $del = $this->pegawai->delPegawai($id);
        if ($del)
        {
            $this->session->set_flashdata('success', 'Hapus Data Berhasil');
            redirect('admin/data_pegawai');
        }
    }

    public function update_pegawai ($id)
    {
        if ($this->upload->do_upload('foto'))
        {
            $data = $this->input->post();
            $foto = $this->upload->data('orig_name');
            $update = $this->pegawai->updatePegawai($data, $foto);
            
            if ($update)
            {
                $this->session->set_flashdata('success', 'Update Data Pegawai Berhasil');
                redirect('admin/data_pegawai');
            }
            else
            {
                $this->session->set_flashdata('failed', 'Update Data Pegawai Gagal');
                redirect('admin/edit_pegawai'.$id);
            }
        }

    }
}