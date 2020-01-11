<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('level') != 'admin')
		{
			redirect('auth');
		}
		$this->load->library('pdf_report');
		$this->load->model('m_user', 'user');
		$this->load->model('m_pegawai', 'pegawai');
		$this->load->model('m_barang', 'barang');
		$this->load->model('m_laporan_a', 'lapadmin');

		date_default_timezone_set('Asia/Jakarta');
	}
	
	public function index()
	{
		$data = array(
			'transaksi' => $this->lapadmin->countTransaksi(),
			'terjual' => $this->lapadmin->countBrgTerjual(),
			'laba' => $this->lapadmin->labaRugiBulan(),
			'stoknotice' => $this->barang->countStokMinimum()->row('jumlah')
		);

		$this->load->view('admin/header');
        $this->load->view('admin/dashboard');
        $this->load->view('admin/home', $data);
		$this->load->view('admin/footer');
	}

	//Data User
	public function data_user()
	{
		$data = array(
			'user' => $this->user->getAllUser()->result()
		);
		$this->load->view('admin/header');
		$this->load->view('admin/dashboard');
		$this->load->view('admin/user/data_user.php', $data);
		$this->load->view('admin/footer');
	}

	public function add_user()
	{
		$data = array(
			'title' => 'Tambah Data User',
			'button' => 'tambah',
			'link' => 'user/add_user'
		);

		$this->load->view('admin/header');
		$this->load->view('admin/dashboard');
		$this->load->view('admin/user/user.php', $data);
		$this->load->view('admin/footer');
	}

	public function edit_user($id = null)
	{
		if (isset($id))
		{
			$data = array(
				'user' => $this->user->getDataUser($id)->row(),
				'title' => 'Edit Data User',
				'button' => 'edit',
				'link' => 'user/update_user'
			);

			$this->load->view('admin/header');
			$this->load->view('admin/dashboard');
			$this->load->view('admin/user/user.php', $data);
			$this->load->view('admin/footer');
		}
		else
		{
			reirect('admin/data_user');
		}
	}

	//Data Pegawai
	public function data_pegawai ()
	{
		$data = array(
			'pegawai' => $this->pegawai->getDataPegawai()->result(),
		);

		$this->load->view('admin/header');
		$this->load->view('admin/dashboard');
		$this->load->view('admin/pegawai/data_pegawai.php', $data);
		$this->load->view('admin/footer');
	}

	public function add_pegawai()
	{
		$data = array(
			'title' => 'Tambah Data Pegawai',
			'button' => 'tambah',
			'link' => 'pegawai/add_pegawai'
		);

		$this->load->view('admin/header');
		$this->load->view('admin/dashboard');
		$this->load->view('admin/pegawai/pegawai.php', $data);
		$this->load->view('admin/footer');
	}

	public function edit_pegawai($id = null)
	{
		if ($id != null)
		{
			$data = array(
				'pegawai' => $this->pegawai->getAllPegawai($id)->row(),
				'title' => 'Edit Data Pegawai',
				'button' => 'edit',
				'link' => 'pegawai/update_pegawai'
			);

			$this->load->view('admin/header');
			$this->load->view('admin/dashboard');
			$this->load->view('admin/pegawai/pegawai.php', $data);
			$this->load->view('admin/footer');
		}
		else
		{
			redirect('admin/data_pegawai');
		}
	}

	public function detail_pegawai($id = null)
	{
		if ($id != null)
		{
			$data = array(
				'detail' => $this->pegawai->getAllPegawai($id)->row()
			);
			$this->load->view('admin/header');
			$this->load->view('admin/dashboard');
			$this->load->view('admin/pegawai/detail.php', $data);
			$this->load->view('admin/footer');
		}
		else
		{
			redirect('admin/data_pegawai');
		}
	}

	// Data Barang

	public function export_barang(){
		$excel = new PHPExcel();
		$barang = $this->barang->getAllDataBarang()->result();
		$style_col = array(
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
			)
		);

		// set row pertama sebagai judul
		$excel->setActiveSheetIndex(0)->setCellValue('A1', "Kode Barang");
		$excel->setActiveSheetIndex(0)->setCellValue('B1', "Nama Barang");
		$excel->setActiveSheetIndex(0)->setCellValue('C1', "Harga Awal");
		$excel->setActiveSheetIndex(0)->setCellValue('D1', "Harga Jual");
		$excel->setActiveSheetIndex(0)->setCellValue('E1', "Stok Minimum");
		$excel->setActiveSheetIndex(0)->setCellValue('F1', "Stok");
		$excel->setActiveSheetIndex(0)->setCellValue('G1', "Unit");
		
		
		$numrow = 2;
		foreach ($barang as $brg)
		{
			$excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $brg->kd_barang);
			$excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $brg->nama_b);
			$excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $brg->harga_awal_b);
			$excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $brg->harga_jual_b);
			$excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $brg->stok_min_b);
			$excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $brg->stok_b);
			$excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $brg->unit_b);
			$numrow++;
		}
		// set alignment jadi tengah
		$excel->getActiveSheet()->getStyle('A1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('B1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('C1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('D1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('E1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('F1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('G1')->applyFromArray($style_col);

		//set width kolom
		$excel->getActiveSheet()->getColumnDimension('A')->setWidth(20); 
		$excel->getActiveSheet()->getColumnDimension('B')->setWidth(20); 
		$excel->getActiveSheet()->getColumnDimension('C')->setWidth(15); 
		$excel->getActiveSheet()->getColumnDimension('D')->setWidth(15); 
		$excel->getActiveSheet()->getColumnDimension('E')->setWidth(5); 
		$excel->getActiveSheet()->getColumnDimension('F')->setWidth(5);

		// Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
		$excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
		
		// Set orientasi kertas jadi LANDSCAPE
		$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		// Set judul file excel
		$excel->getActiveSheet(0)->setTitle("Barang-".date('d-m-Y', time()));
		$excel->setActiveSheetIndex(0);
		// Proses file excel
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="Barang'.date('d-m-Y', time()).'.xlsx"'); // Set nama file excel nya
		header('Cache-Control: max-age=0');
		$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
		$write->save('php://output');
		redirect('admin/data_barang');
	}

	public function import_barang()
	{
		if ($_POST['import'])
		{
			if (isset($_FILES['file']['name']))
			{
				$lokasi = $_FILES['file']['tmp_name']; 
				$object = PHPExcel_IOFactory::load($lokasi);
				foreach ($object->getWorksheetIterator() as $worksheet)
				{
					$maxrow = $worksheet->getHighestRow();

					for($row = 2; $row <= $maxrow; $row++ )
					{
						$kd_barang = (string) htmlspecialchars(trim($worksheet->getCellByColumnAndRow(0, $row)->getValue()));
						$nama_barang = (string) htmlspecialchars(trim($worksheet->getCellByColumnAndRow(1, $row)->getValue()));
						$harga_awal = (int) htmlspecialchars(trim($worksheet->getCellByColumnAndRow(2, $row)->getValue()));
						$harga_jual = (int) htmlspecialchars(trim($worksheet->getCellByColumnAndRow(3, $row)->getValue()));
						$stok_min = (int) htmlspecialchars(trim($worksheet->getCellByColumnAndRow(4, $row)->getValue()));
						$stok = (int) htmlspecialchars(trim($worksheet->getCellByColumnAndRow(5, $row)->getValue()));
						$unit = (string) htmlspecialchars(trim($worksheet->getCellByColumnAndRow(6, $row)->getValue()));
						$data = array(
							'kd_brg' => $kd_barang,
							'nama_brg' => $nama_barang,
							'h_awal' => $harga_awal,
							'h_jual' => $harga_jual,
							'stok_min' => $stok_min,
							'stok' => $stok,
							'unt_brg' => $unit
						);
						if (!empty($kd_barang) && !empty($nama_barang))
						{
							if ($this->barang->getDataBarangByKode($kd_barang)->num_rows() > 0)
							{
								$this->barang->updateBrg($data);
							}
							else
							{
								$this->barang->addBrg($data);
							}
						}
					}

				} 
			}
			$this->session->set_flashdata('success', 'Import Data Berhasil');
			redirect('admin/data_barang');
		}
	}

	public function add_barang()
	{
		$data = array(
			'title' => 'Tambah',
			'link' => 'barang/add_brg',
			'button' => 'tambah'
		);
		
		$this->load->view('admin/header');
        $this->load->view('admin/dashboard');
        $this->load->view('admin/barang/barang', $data);
		$this->load->view('admin/footer');
	}

	public function edit_barang($id = null)
	{
		$data = array(
			'title' => 'Edit',
			'link' => 'barang/edit_brg',
			'button' => 'edit',
			'db' => $this->barang->getDataBarangById($id)->row()
		);
		
		$this->load->view('admin/header');
        $this->load->view('admin/dashboard');
        $this->load->view('admin/barang/barang', $data);
		$this->load->view('admin/footer');
	}

	public function data_barang()
	{
		$this->load->view('admin/header');
        $this->load->view('admin/dashboard');
        $this->load->view('admin/barang/data_barang.php');
		$this->load->view('admin/footer');
	}

	public function barang()
    {
        $list = $this->barang->get_datatables();
        $data = array();
        $no = isset($_POST['start']) ? $_POST['start'] : null;
        foreach ($list as $barang) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $barang->kd_barang;
            $row[] = $barang->nama_b;
            $row[] = number_format($barang->harga_awal_b);
            $row[] = number_format($barang->harga_jual_b);
            $row[] = $barang->stok_min_b;
            $row[] = $barang->stok_b;
            $row[] = $barang->unit_b;
            $row[] = $barang->id_barang;
 
            $data[] = $row;
        }
 
		$draw = isset($_POST['draw']) ? $_POST['draw'] : null;
        $output = array(
					"draw" => $draw,
					"recordsTotal" => $this->barang->count_all(),
					"recordsFiltered" => $this->barang->count_filtered(),
					"data" => $data,
                );
        //output to json format
        echo json_encode($output);
	}

	public function laporan_bulanan()
    {
		$data = array(
			'data' => $this->lapadmin->lap_bulan()->result()
		);
		$this->load->view('admin/header');
        $this->load->view('admin/dashboard');
		$this->load->view('admin/laporan/laporan_bulan', $data);
		$this->load->view('admin/footer');
	}
	
	// laporan
	public function data_lap_bulanan ($filter = null)
	{
		$param = explode('-', $filter);
		$bulan = $param[0];
		$tahun = $param[1];

		$data = array(
			'data' => $this->lapadmin->lap_bulanan_detail($bulan, $tahun)->result(),
			'bulan' => $bulan,
			'tahun' => $tahun	
		);

		$this->load->view('admin/header');
		$this->load->view('admin/dashboard');
		$this->load->view('admin/laporan/detail_bulanan', $data);
		$this->load->view('admin/footer');
	}

	public function lapbulan_pdf($filter = null)
	{
		$this->load->helper('indo_date');
		$param = explode('-', $filter);
		$bulanText = indo_bulan($param[0]);
		$bulan = $param[0];
		$tahun = $param[1];

		$data = array(
			'data' => $this->lapadmin->lap_bulanan_detail($bulan, $tahun)->result(),
			'bulan' => $bulanText,
			'tahun' => $tahun	
		);

		$this->load->view('admin/laporan/lap_bulan', $data);
	}

	// rekap barang
	public function rekap_barang()
	{
		$data = array(
			'bulan' => $this->barang->brgTerlarisBulan(),
			'hari' => $this->barang->brgTerlarisHari(),
			'stok' => $this->barang->stockMinimum()
		);

		$this->load->view('admin/header');
		$this->load->view('admin/dashboard');
		$this->load->view('admin/laporan/rekap_barang', $data);
		$this->load->view('admin/footer');
	}
	
	public function rekap_by_tanggal()
	{
		$tgl = isset($_POST['date']) ? date('Y-m-d', strtotime($_POST['date'])) : date('Y-m-d', time());
		$arr = array();
		$arr['transaksi'] = $this->lapadmin->countTransaksiTgl($tgl);
		$arr['barang'] = $this->lapadmin->countBrgTerjualTgl($tgl)->row('jumlah');
		$arr['untung'] = $this->lapadmin->labaRugiTgl($tgl)->row('keuntungan');
		echo json_encode($arr);
	}
}