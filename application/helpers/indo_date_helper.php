<?php

function indo_date($tanggal)
{
	$bulan = array (
		1 =>   'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	);
	$tgl = strtotime($tanggal);
	$tgl_new = date('Y-m-d', $tgl);
	$pecahkan = explode('-', $tgl_new);
	return $pecahkan[2].' ' .$bulan[ (int)$pecahkan[1] ].' '. $pecahkan[0];
}

function indo_bulan($tanggal)
{
	$bulan = array (
		1 =>   'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	);

	return $bulan[(int) $tanggal];
}

function hari_ini(){
	$hari = array(
		'Monday' => 'Senin',
		'Tuesday' => 'Selasa',
		'Wednesday' => 'Rabu',
		'Thursday' => 'Kamis',
		'Friday' => 'jum\'at',
		'Saturday' => 'Sabtu',
		'Sunday' => 'Minggu',
	);

	$bulan = array (
		1 =>   'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	);

	$date = explode('-', date('l-d-m-Y', time()));
	return $hari[(string) $date[0]].', '.$date[1].' '.$bulan[(int) $date[2]].' '.$date[3];
}

?>