<?php

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetCreator('GIFT POS');
$pdf->SetAuthor($this->session->nama);
$pdf->SetTitle('Laporan Transaksi Bulanan');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}
$pdf->SetFont('times', '', 10);
$pdf->AddPage();
$pdf->setCellPaddings(1, 1, 1, 1);
$pdf->setCellMargins(1, 1, 1, 1);
$pdf->SetFillColor(255, 255, 127);

$title="
<h2>Laporan Penjualan Pada Bulan ".$bulan." ".$tahun."</h2>
";

$ttal = null;
foreach ($data as $t)
{
    $ttal += $t->total;
}

$t_pnj = "<p>Total : Rp. ".number_format($ttal)."</p>";

$pdf->WriteHTMLCell(0,0,'','',$title,0,1,0,true,'C',true);
$pdf->WriteHTMLCell(0,0,'','',$t_pnj,0,1,0,true,'C',true);

$no = 1;
$table = '<table  border="1px" style="padding:2px;">';
$table .= '<tr>
                <th style="background-color:#cccccc; width:5%;">No </th>
				<th style="background-color:#cccccc; width:38%;">Nama Barang</th>
				<th style="background-color:#cccccc; width:12%;">Harga Awal (Rp)</th>
				<th style="background-color:#cccccc; width:12%;">Harga Jual (Rp)</th>
				<th style="background-color:#cccccc; width:9%;">Terjual</th>
				<th style="background-color:#cccccc; width:12%;">Sub Total (Rp)</th>
				<th style="background-color:#cccccc; width:12%;">Total Laba/Rugi (Rp)</th>
            </tr>';
			foreach($data as $row){
                $table .='<tr>
                    <td>'.$no.'</td>
                    <td>'.$row->nama_b.'</td>
                    <td>'.number_format($row->harga_awal).'</td>
                    <td>'.number_format($row->harga_jual).'</td>
                    <td>'.$row->jumlah.'</td>
                    <td>'.number_format($row->total).'</td>
                    <td>'.number_format($row->keuntungan).'</td>
                </tr>';
                $no++;
			}
$table .= '</table>';
$pdf->WriteHTMLCell(0,0,'','',$table,0,1,0,true,'C',true);
$pdf->lastPage();
ob_clean();
$pdf->Output("laporan-".$bulan." ".$tahun.".pdf", 'I');
