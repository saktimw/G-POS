<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_laporan_k extends CI_Model {

    public function laporan_transaksi($tgl = null)
    {
        $id = $this->session->id_user;
        $this->db->select("kd_barang , nama_b, tanggal_beli, harga_awal, harga_jual, SUM(qty) as qty, SUM(subtotal) as total");
        $this->db->from('tb_barang');
        $this->db->join('tb_detailpembelian', 'tb_detailpembelian.id_barang = tb_barang.id_barang');
        $this->db->join('tb_pembelian', 'tb_detailpembelian.id_pembelian = tb_pembelian.id_pembelian');
        $this->db->where('DATE(tanggal_beli)', $tgl);
        $this->db->where('id_user', $id);
        $this->db->group_by('kd_barang');
        return $this->db->get();
    }

    public function report_transaksi()
    {
        $this->db->select("b.tgl_penjualan, SUM(b.jumlah) as 'jumlah', b.sub_total, SUM(b.jumlah * b.harga_awal_b) as 'keuntungan', SUM((b.harga_jual_b - b.harga_awal_b)/b.harga_jual_b) as 'selisih'");
        $this->db->from('tb_barang as a');
        $this->db->join('tb_detailpembelian as b', ' b.id_barang = a.id_barang');
        $this->db->group_by('tgl_penjualan');
        $query = $this->db->get();
        return $query;
        }

    public function lapPertgl()
    {
        $id = $this->session->id_user;
        return $this->db->query("SELECT DATE(tanggal_beli) as tgl, SUM(qty) as jumlah, SUM(subtotal) as total FROM `tb_pembelian` JOIN `tb_detailpembelian` ON `tb_pembelian`.`id_pembelian` = `tb_detailpembelian`.`id_pembelian` WHERE id_user='$id' group by tgl");
    }
    
    public function delLapHari($id = null)
    {
        $this->db->where('tgl_penjualan', $id);
        return $this->db->delete('tb_detailpembelian');
    }
}