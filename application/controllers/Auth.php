<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_user','user');

	}
	
	public function index()
	{
		if($this->session->has_userdata('level')){
			if ($this->session->level == 'admin'){
				redirect('admin');
			}elseif($this->session->level == 'kasir'){
				redirect('kasir');
			}
		}else{
			$this->load->view('login');
		}
	}

    public function proses_login(){
        if( $this->input->post('login')){
                $data = $this->input->post();
				$cek = $this->user->ceklogin($data);
				
				if ($cek->num_rows() >0)
				{
					if ($cek->row('level')=='admin')
					{
						$sess_data = array(
							'id_user' => $cek->row('id_user'),
							'nama' => $cek->row('nama'),
							'usernama' => $cek->row('usernama'),
							'level' => $cek->row('level')
						);
						$this->session->set_userdata($sess_data);
						redirect('admin');
					}
					elseif ($cek->row('level')=='kasir')
					{
						$sess_data = array(
							'id_user' => $cek->row('id_user'),
							'nama' => $cek->row('nama'),
							'usernama' => $cek->row('usernama'),
							'level' => $cek->row('level')
						);
						$this->session->set_userdata($sess_data);
						redirect('kasir');
					}
				}
				else
				{
					$this->session->set_flashdata('failed', 'Username atau Password Salah');
					redirect('auth');
             }
        }
	}
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('auth');
	}
}
