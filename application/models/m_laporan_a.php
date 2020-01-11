<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_laporan_a extends CI_Model {
    
    public function lap_bulan()
    {
        $this->db->select("MONTH(tanggal_beli) as bulan, YEAR(tanggal_beli) as tahun, SUM(qty) as terjual, SUM(subtotal) as total, SUM(subtotal - (harga_awal * qty)) as keuntungan");
        $this->db->from('tb_pembelian');
        $this->db->join('tb_detailpembelian', 'tb_pembelian.id_pembelian = tb_detailpembelian.id_pembelian');
        $this->db->group_by('MONTH(tanggal_beli)');
        $this->db->order_by('tanggal_beli', 'DESC');
        return $this->db->get();
    }

    public function lap_bulanan_detail($bulan, $tahun)
    {
        return $this->db->query("SELECT nama_b, tb_detailpembelian.harga_awal, tb_detailpembelian.harga_jual, sum(qty) as jumlah, SUM(subtotal) as total, SUM(subtotal - (tb_detailpembelian.harga_awal * qty)) as keuntungan from tb_pembelian JOIN tb_detailpembelian USING(id_pembelian) JOIN tb_barang USING(id_barang) where MONTH(tanggal_beli) = '$bulan' AND year(tanggal_beli)='$tahun' GROUP BY nama_b");
    }

    public function countTransaksi()
    {
        date_default_timezone_set('Asia/Jakarta');
        $bulan = date('m', time());
        $tahun = date('Y', time());

        $this->db->select('id_pembelian');
        $this->db->from('tb_pembelian');
        $this->db->where('MONTH(tanggal_beli)', $bulan);
        $this->db->where('YEAR(tanggal_beli)', $tahun);
        return $this->db->count_all_results();
    }

    public function countBrgTerjual()
    {
        date_default_timezone_set('Asia/Jakarta');
        $bulan = date('m', time());
        $tahun = date('Y', time());
        
        $this->db->select_sum('qty');
        $this->db->from('tb_pembelian');
        $this->db->join('tb_detailpembelian', 'tb_pembelian.id_pembelian = tb_detailpembelian.id_pembelian');
        $this->db->where('MONTH(tanggal_beli)', $bulan);
        $this->db->where('YEAR(tanggal_beli)', $tahun);
        return $this->db->get()->row();
    }
    
    public function labaRugiBulan()
    {
        date_default_timezone_set('Asia/Jakarta');
        $bulan = date('m', time());
        $tahun = date('Y', time());
        
        $this->db->select("SUM(subtotal - (harga_awal*qty)) as keuntungan");
        $this->db->from('tb_pembelian');
        $this->db->join('tb_detailpembelian', 'tb_pembelian.id_pembelian = tb_detailpembelian.id_pembelian');
        $this->db->where('MONTH(tanggal_beli)', $bulan);
        $this->db->where('YEAR(tanggal_beli)', $tahun);
        return $this->db->get()->row();
    }
    
    public function countTransaksiTgl($tgl)
    {
        $this->db->select("id_pembelian");
        $this->db->from("tb_pembelian");
        $this->db->where("DATE(tanggal_beli)", $tgl);
        return $this->db->count_all_results();
    }
    
    public function countBrgTerjualTgl($tgl)
    {
        $this->db->select("SUM(qty) as jumlah");
        $this->db->from("tb_pembelian");
        $this->db->join('tb_detailpembelian', 'tb_pembelian.id_pembelian = tb_detailpembelian.id_pembelian');
        $this->db->where("DATE(tanggal_beli)", $tgl);
        return $this->db->get();
    }

    public function labaRugiTgl($tgl)
    {
        $this->db->select("SUM(subtotal - (harga_awal * qty)) as keuntungan");
        $this->db->from("tb_pembelian");
        $this->db->join('tb_detailpembelian', 'tb_pembelian.id_pembelian = tb_detailpembelian.id_pembelian');
        $this->db->where("DATE(tanggal_beli)", $tgl);
        return $this->db->get();
    }
}
