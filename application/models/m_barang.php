<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_barang extends CI_Model {

    var $table = 'tb_barang';
    var $column_order = array('kd_barang', 'nama_b','harga_awal_b','harga_jual_b','stok_min_b','stok_b','unit_b'); 
    var $column_search = array('kd_barang', 'nama_b','harga_awal_b','harga_jual_b','stok_min_b','stok_b','unit_b');
    var $order = array('kd_barang' => 'asc');

    private function _get_datatables_query()
    {
        
        $this->db->from($this->table);
        $this->db->where('hide', 'x');

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
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function getAllDataBarang()
    {
        $this->db->select('*');
        $this->db->from('tb_barang');
        $this->db->where('hide', 'x');
        return $this->db->get();
    }

    public function getDataBarangByKode($kd)
    {
        $this->db->select('*');
        $this->db->from('tb_barang');
        $this->db->where('kd_barang', $kd);
        $this->db->limit(1);
        return $this->db->get();
    }

    public function getDataBarangById($id = null){
        $this->db->select('*');
        $this->db->from('tb_barang');
        $this->db->where('id_barang', $id);
        $this->db->limit(1);
        return $this->db->get();
      }

      public function addBrg($data){
        $param  = array(
          'kd_barang'=>$data['kd_brg'],
          'nama_b' => $data['nama_brg'],
          'harga_awal_b' => $data['h_awal'],
          'harga_jual_b' => $data['h_jual'],
          'stok_min_b' => $data['stok_min'],
          'stok_b' => $data['stok'],
          'unit_b' => $data['unt_brg'],
          'hide' => 'x'
        );
        return $this->db->insert('tb_barang', $param);
    }

    public function hideBrg($id)
    {
        $param = array( 'hide' => 'v');
        $this->db->where('id_barang', $id);
        
        return $this->db->update('tb_barang', $param);
    }

    public function updateBrg($data)
    {
        $param = array(
            'nama_b' => $data['nama_brg'],
            'harga_awal_b' => $data['h_awal'],
            'harga_jual_b' => $data['h_jual'],
            'stok_min_b' => $data['stok_min'],
            'stok_b' => $data['stok'],
            'unit_b' => $data['unt_brg'],
            'hide' => 'x'
        );
        if (isset($data['id']))
        {
            $this->db->where('id_barang', $data['id']);
        }
        elseif (isset($data['kd_brg']))
        {
            $this->db->where('kd_barang', $data['kd_brg']);
        }
        return $this->db->update('tb_barang', $param);
    }

    public function brgTerlarisBulan($tgl = null)
    {
        date_default_timezone_set('Asia/Jakarta');
        if ($tgl != null)
        {
            $filter = explode('-', $tgl);
            $bulan = $filter[1];
            $tahun = $filter[0];
        }
        else
        {
            $bulan = date('m', time());
            $tahun = date('Y', time());
        }

        $this->db->select('nama_b, SUM(qty) as terlaris');
        $this->db->from('tb_barang');
        $this->db->join('tb_detailpembelian', 'tb_barang.id_barang = tb_detailpembelian.id_barang');
        $this->db->join('tb_pembelian', 'tb_pembelian.id_pembelian = tb_detailpembelian.id_pembelian');
        $this->db->group_by('nama_b');
        $this->db->order_by('terlaris', 'DESC');
        $this->db->where('MONTH(tanggal_beli)', $bulan);
        $this->db->where('YEAR(tanggal_beli)', $tahun);
        $this->db->limit(5);
        return $this->db->get();
    }
    
    public function brgTerlarisHari($tgl = null)
    {
        date_default_timezone_set('Asia/Jakarta');
        $tanggal = isset($tgl) ? $tgl : date('Y-m-d', time());
        
        $this->db->select('nama_b, SUM(qty) as terlaris');
        $this->db->from('tb_barang');
        $this->db->join('tb_detailpembelian', 'tb_barang.id_barang = tb_detailpembelian.id_barang');
        $this->db->join('tb_pembelian', 'tb_pembelian.id_pembelian = tb_detailpembelian.id_pembelian');
        $this->db->group_by('nama_b');
        $this->db->order_by('terlaris', 'DESC');
        $this->db->where('DATE(tanggal_beli)', $tanggal);
        $this->db->limit(5);
        
        return $this->db->get();
    }

    public function countStokMinimum()
    {
        return $this->db->query("SELECT count(id_barang) as jumlah fROM tb_barang WHERE stok_b <= stok_min_b AND hide='x'");
    }

    public function stockMinimum()
    {
        return $this->db->query("SELECT nama_b, stok_b, unit_b fROM tb_barang WHERE stok_b <= stok_min_b AND hide='x'");
    }

}