<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class m_pegawai extends CI_Model {

    public function addPegawai ($data, $foto)
    {
        $param = array(
            'nama_p' => $this->input->post('nama'),
            'jekel_p' => $this->input->post('jekel'),
            'tempat_lahir_p' => $this->input->post('tpt_l'),
            'tgl_lahir_p' => $this->input->post('tgl_l'),
            'alamat_p' => $this->input->post('alamat'),
            'no_telp_p' => $this->input->post('notelp'),
            'foto_p' => $foto,
        );
        return $this->db->insert('tb_pegawai', $param);
    }
    public function getDataPegawai()
    {
        $this->db->select('id_pegawai, foto_p, nama_p, alamat_p, no_telp_p');
        $this->db->from('tb_pegawai');
        return $this->db->get();
    }

    public function getAllPegawai($id = null)
    {
        $this->db->select('*');
        $this->db->from('tb_pegawai');
        $this->db->where('id_pegawai', $id);
        $this->db->limit(1);
        return $this->db->get();
    }

    public function getPegawai($id)
    {
        $this->db->select('*');
        $this->db->from('tb_pegawai');
        $this->db->where('id_pegawai', $id);
        return $this->db->get();
    }
    public function delPegawai($id)
    {
        $this->db->where('id_pegawai', $id);
        return $this->db->delete('tb_pegawai');
    }

    public function updatePegawai($data, $foto)
    {
        $param = array(
            'nama_p' => $this->input->post('nama'),
            'jekel_p' => $this->input->post('jekel'),
            'tempat_lahir_p' => $this->input->post('tpt_l'),
            'tgl_lahir_p' => $this->input->post('tgl_l'),
            'alamat_p' => $this->input->post('alamat'),
            'no_telp_p' => $this->input->post('notelp'),
            'foto_p' => $foto,
        );
        $this->db->where('id_pegawai', $data['id']);
        return $this->db->update('tb_pegawai', $param);
    }
}

?>