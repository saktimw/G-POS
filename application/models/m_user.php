<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_user extends CI_Model {

    public function ceklogin ($data)
    {
        $this->db->select('*');
        $this->db->from('tb_user');
        $this->db->where('username', $data['user']);
        $this->db->where('password', $data['pass']);
        return $this->db->get();
    }

    public function addUser ($data)
    {
        $param = array(
            'username' => $data['user'],
            'password' => $data['pass'],
            'nama' => $data['nama'],
            'level' => $data['level'],
        );
        return $this->db->insert('tb_user', $param);
    }

    public function getAllUser ()
    {
        $this->db->select('*');
        $this->db->from('tb_user');
        return $this->db->get();
    }

    public function getUsername ($uname)
    {
        $this->db->select('username');
        $this->db->from('tb_user');
        $this->db->where('username', $uname);
        return $this->db->get();        
    }

    public function getDataUser ($id)
    {
        $this->db->select('*');
        $this->db->from('tb_user');
        $this->db->where('id_user', $id);
        $this->db->limit('1');
        return $this->db->get();
    }

    public function delUser($id)
    {
        $this->db->where('id_user', $id);
        return $this->db->delete('tb_user');
    }

    public function updateUser($data)
    {
        $param = array(
            'username' => $data['user'],
            'password' => $data['pass'],
            'nama' => $data['nama'],
            'level' => $data['level'],
        );
        $this->db->where('id_user', $data['id']);
        return $this->db->update('tb_user', $param);
    }
}

?>