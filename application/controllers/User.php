<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
	{
        parent::__construct();
        if($this->session->userdata('level')!='admin')
        {
            redirect('auth');
        }
        $this->load->model('m_user', 'user');
    }

    public function index()
    {
        if ($this->session->level)
        {
            redirect('admin');
        }
    }

    public function add_user ()
    {
        $uname = $this->input->post('user');
        if ($this->user->getUsername($uname)->num_rows() > 0)
        {
            $this->session->set_flashdata('avaible', 'Username Sudah Ada');
            redirect('admin/add_user');
        }
        else
        {
            $data = $this->input->post();
            $add = $this->user->addUser($data);
            
            if ($add)
            {
                $this->session->set_flashdata('success', 'Tambah Data User Berhasil');
                redirect('admin/data_user');
            }
        }
    }

    public function del_user ($id)
    {
        $del = $this->user->delUser($id);
        if ($del)
        {
            $this->session->set_flashdata('success', 'Delete Data Berhasil');
            redirect('admin/data_user');
        }
    }

    public function update_user ()
    {
        $data = $this->input->post();
        $update = $this->user->updateUser($data);
        $uname = $this->input->post('username');

        if ($update)
        {
            $this->session->set_flashdata('success', 'Update Data Berhasil');
            redirect('admin/data_user');
        }
        else
        {
            $this->session->set_flashdata('failed', 'Update Data Gagal');
            redirect('admin/edit_user/'.$this->input->post('id'));
        }
    }
}