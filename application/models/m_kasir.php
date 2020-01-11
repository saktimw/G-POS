<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kasir extends CI_Model {

    // var $table = 'tb_transaksi';
    var $column_order = array('tb_pembelian.id_pembelian','tanggal_beli'); 
    var $column_search = array('tb_pembelian.id_pembelian','tanggal_beli');
    var $order = array('tanggal_beli' => 'desc');

    public function _get_datatables_query()
    {
        date_default_timezone_set('Asia/jakarta');
        $tgl = date('Y-m-d', time());

        $user = $this->session->userdata('id_user');
        $this->db->select('tb_pembelian.id_pembelian, tanggal_beli, SUM(tb_detailpembelian.subtotal) as total');
        $this->db->from('tb_pembelian');
        $this->db->join('tb_detailpembelian', 'tb_pembelian.id_pembelian = tb_detailpembelian.id_pembelian');
        $this->db->where('id_user', $user);
        $this->db->where('DATE(tanggal_beli)', $tgl);
        $this->db->group_by('id_pembelian');

        $i = 0;
    
        foreach ($this->column_search as $item) // loop column 
        {
            if(isset($_POST['search']['value'])) // if datatable send POST for search
            {
                
                if ($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
        
        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if (isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        $length = isset($_POST['length']) ? $_POST['length'] : null;
        $start = isset($_POST['start']) ? $_POST['start'] : null;
        
        if  ($length != -1)
        {
            $this->db->limit($length, $start);
            $query = $this->db->get();
            return $query->result();
        }
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from('tb_pembelian');
        $this->db->join('tb_detailpembelian', 'tb_pembelian.id_pembelian = tb_detailpembelian.id_pembelian');
        return $this->db->count_all_results();
    }
    
    public function addPembelian($data)
    {
        return $this->db->insert('tb_pembelian', $data);
    }

    public function addDetailPembelian($data)
    {
        return $this->db->insert_batch('tb_detailpembelian', $data);
    }

    public function getDetailPembelian ($id = null)
    {
        $this->db->select("id_detailbeli, tb_barang.nama_b, qty, harga_jual, subtotal");
        $this->db->from("tb_detailpembelian");
        $this->db->join("tb_barang", "tb_detailpembelian.id_barang = tb_barang.id_barang");
        $this->db->where("id_pembelian", $id);
        return $this->db->get();
    }

    public function delDetailPembelian ($id = null)
    {
        $this->db->where('id_detailbeli', $id);
        return $this->db->delete('tb_detailpembelian');
    }

    public function delPembelian ($id = null)
    {
        $this->db->where('id_pembelian', $id);
        return $this->db->delete('tb_pembelian');
    }

    public function getNamaDanKode($nm)
    {
        $this->db->select('id_barang, nama_b');
        $this->db->from('tb_barang');
        $this->db->like('nama_b', $nm);
        $this->db->like('hide', 'x');
        $this->db->or_like('kd_barang', $nm);
        $this->db->like('hide', 'x');
        $this->db->limit(7);
        return $this->db->get();
    }

    public function getDataBarang($nm)
    {
        $this->db->select('id_barang, harga_awal_b, harga_jual_b, stok_b');
        $this->db->from('tb_barang');
        $this->db->where('nama_b', $nm);
        $this->db->limit(1);
        return $this->db->get();
    }

    public function countPembelian($id = null)
    {
        return $this->db->query("SELECT count(id_pembelian) as jumlah FROM tb_pembelian WHERE DATE(tanggal_beli) = curdate() AND id_user = '$id'");
    }

    public function countTerjual($id = null)
    {
      return $this->db->query("SELECT sum(qty) as jumlah FROM tb_detailpembelian JOIN tb_pembelian USING(id_pembelian) WHERE DATE(tanggal_beli) = curdate() AND id_user = '$id'");
    }

    public function terlarisH($id = null)
    {
        return $this->db->query("SELECT nama_b, qty FROM tb_detailpembelian JOIN tb_barang USING(id_barang) JOIN tb_pembelian USING(id_pembelian) WHERE DATE(tanggal_beli) = curdate() AND id_user = '$id' ORDER BY qty DESC LIMIT 1");
    } 

    public function stok()
    {
        $this->db->select('nama_b, stok_b');
        $this->db->from('tb_barang');
        $this->db->where('stok_b <= stok_min_b', null);
        $this->db->where('hide', 'x');
        $this->db->order_by('stok_b','ASC');
        $this->db->limit(10);
        return $this->db->get();
    }
}