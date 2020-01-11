-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Jan 2019 pada 15.08
-- Versi server: 10.1.35-MariaDB
-- Versi PHP: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_poskonter`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_barang`
--

CREATE TABLE `tb_barang` (
  `id_barang` int(11) NOT NULL,
  `kd_barang` varchar(50) NOT NULL,
  `nama_b` varchar(200) NOT NULL,
  `harga_awal_b` int(15) NOT NULL,
  `harga_jual_b` int(15) NOT NULL,
  `stok_min_b` int(10) NOT NULL,
  `stok_b` int(5) NOT NULL,
  `unit_b` varchar(20) NOT NULL,
  `hide` enum('x','v') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_barang`
--

INSERT INTO `tb_barang` (`id_barang`, `kd_barang`, `nama_b`, `harga_awal_b`, `harga_jual_b`, `stok_min_b`, `stok_b`, `unit_b`, `hide`) VALUES
(68, 'A1', 'AXIS 1 GB', 11500, 14000, 4, 13, 'PCS', 'x'),
(69, 'A2', 'AXIS 2 GB', 20500, 23000, 4, 6, 'PCS', 'x'),
(70, 'A3', 'AXIS 3 GB', 26500, 30000, 2, 5, 'PCS', 'x'),
(71, 'A5', 'AXIS 5 GB', 39500, 44000, 1, 3, 'PCS', 'x'),
(72, 'VA1M', 'VC AXIS 1 GB 5 HARI', 8750, 10000, 5, 8, 'PCS', 'x'),
(73, 'VA1', 'VC AXIS 1 GB', 13600, 16000, 5, 3, 'PCS', 'x'),
(74, 'VA2', 'VC AXIS 2 GB', 23000, 26000, 5, 10, 'PCS', 'x'),
(75, 'VA3', 'VC AXIS 3 GB', 29000, 32000, 3, 10, 'PCS', 'x'),
(76, 'VA5', 'VC AXIS 5 GB', 43250, 46000, 2, 4, 'PCS', 'x'),
(77, 'VA8', 'VC AXIS 8 GB', 59000, 64000, 1, 3, 'PCS', 'x'),
(78, 'VA4O', 'VC AXIS 4 GB OWSEM', 18000, 23000, 2, 5, 'PCS', 'x'),
(79, 'VA8O', 'VC AXIS 8 GB OWSEM', 30000, 35000, 2, 3, 'PCS', 'x'),
(80, 'VA16O', 'VC AXIS 16 GB OWSEM', 47000, 52000, 1, 3, 'PCS', 'x'),
(81, 'X4,5', 'XL 4,5 GB', 27000, 30000, 5, 18, 'PCS', 'x'),
(82, 'X8', 'XL 8 GB', 37000, 40000, 5, 10, 'PCS', 'x'),
(83, 'X15', 'XL 15 GB', 57500, 60000, 3, 7, 'PCS', 'x'),
(84, 'X25', 'XL 25 GB', 85000, 90000, 1, 1, 'PCS', 'x'),
(85, 'I1M', 'ISAT 1 GB MINI', 13250, 15000, 3, 4, 'PCS', 'x'),
(86, 'I2M', 'ISAT 2 GB MINI', 29250, 31000, 3, 5, 'PCS', 'x'),
(87, 'I1U', 'ISAT 1 GB UNLIMITED', 18250, 21000, 3, 3, 'PCS', 'x'),
(88, 'I2U', 'ISAT 2 GB UNLIMITED', 30000, 33000, 3, 1, 'PCS', 'x'),
(89, 'I3U', 'ISAT 3 GB UNLIMITED', 42500, 45000, 1, 2, 'PCS', 'x'),
(90, 'I7U', 'ISAT 7GB UNLIMITED', 58500, 62000, 1, 3, 'PCS', 'x'),
(91, 'I10U', 'ISAT 10 UNLIMITED', 75500, 79000, 1, -1, 'PCS', 'x'),
(92, 'VI1M7H', 'VC ISAT 1 GB 7 HARI', 8250, 9000, 5, 7, 'PCS', 'x'),
(93, 'VI1M7HU', 'VC ISAT 1 GB 7 HARI YOUTUBE', 12000, 14000, 3, 8, 'PCS', 'x'),
(94, 'VI1M15H', 'VC ISAT 1GB 15 HARI', 11000, 13000, 3, 4, 'PCS', 'x'),
(95, 'VI1M', 'VC ISAT 1GB MINI', 14400, 17000, 4, 19, 'PCS', 'x'),
(96, 'VI2M', 'VC ISAT 2GB MINI', 31000, 33000, 4, 10, 'PCS', 'x'),
(97, 'VI1U', 'VC ISAT 1GB UNLIMITED', 20250, 22000, 4, 1, 'PCS', 'x'),
(98, 'VI2U', 'VC ISAT 2GB UNLIMITED', 32250, 35000, 3, 19, 'PCS', 'x'),
(99, 'VI3U', 'VC ISAT 3GB UNLIMITED', 44000, 46000, 3, 9, 'PCS', 'x'),
(100, 'VI7U', 'VC ISAT 7GB UNLIMITED', 61000, 64000, 2, 2, 'PCS', 'x'),
(101, 'VI10U', 'VC ISAT 10GB UNLIMITED', 77500, 81000, 1, 4, 'PCS', 'x'),
(102, 'VI30', 'VC ISAT 30GB', 59000, 70000, 1, 4, 'PCS', 'x'),
(103, 'S10', 'SIMPATI REGULER', 13000, 20000, 2, 7, 'PCS', 'x'),
(104, 'S16', 'SMARTFREN 16GB', 35500, 40000, 2, 4, 'PCS', 'x'),
(105, 'SU', 'SMARTFREN UNLIMITED', 62000, 75000, 2, 5, 'PCS', 'x'),
(106, 'VS3', 'VC SMARTFREN 3GB', 10500, 12000, 2, 4, 'PCS', 'x'),
(107, 'VS10', 'VC SMARTFREN 10GB', 23750, 27000, 3, 5, 'PCS', 'x'),
(108, 'VS16', 'VC SMARTFREN 16GB', 34250, 40000, 2, 4, 'PCS', 'x'),
(109, 'VS30', 'VC SMARTFREN 30GB', 54750, 60000, 1, 3, 'PCS', 'x'),
(110, 'VSU', 'VC SMARTFREN UNLIMITED', 61000, 65000, 2, 3, 'PCS', 'x'),
(111, 'T4', 'TELKOMSEL 4GB', 18000, 27000, 4, 7, 'PCS', 'x'),
(112, 'T7,5', 'TELKOMSEL 7,5GB', 35000, 45000, 4, 3, 'PCS', 'x'),
(113, 'T10', 'TELKOMSEL 10GB', 35000, 50000, 4, 0, 'PCS', 'x'),
(114, 'VT5', 'VC TELKOMSEL 5GB', 60000, 65000, 1, 0, 'PCS', 'x'),
(115, 'TR1', 'TRI AON 1GB', 17000, 20000, 1, 2, 'PCS', 'x'),
(116, 'TR2', 'TRI AON 2GB', 30000, 34000, 1, 3, 'PCS', 'x'),
(117, 'TR3', 'TRI AON 3GB', 44000, 49000, 1, 1, 'PCS', 'x'),
(118, 'TBM1', 'TRI BM 1GB', 13000, 15000, 1, 3, 'PCS', 'x'),
(119, 'TBM3', 'TRI BM 3GB', 24000, 28000, 1, 1, 'PCS', 'x'),
(120, 'VTR1', 'VC TRI AON 1GB', 17000, 20000, 2, 5, 'PCS', 'x'),
(121, 'VTR2', 'VC TRI AON 2GB', 30000, 34000, 2, 3, 'PCS', 'x'),
(122, 'VTR3', 'VC TRI AON 3GB', 44000, 49000, 1, 2, 'PCS', 'x'),
(123, 'VTBM1', 'VC TRI BM 1GB', 12250, 16000, 2, 5, 'PCS', 'x'),
(124, 'VTGM2N', 'VC TRI GM 2GB NEW', 19000, 22000, 2, 3, 'PCS', 'x'),
(125, 'VTBM3', 'VC TRI BM 3GB', 23500, 28000, 2, 3, 'PCS', 'x'),
(126, 'VTGM4', 'VC TRI GM 4GB', 33500, 38000, 1, 2, 'PCS', 'x'),
(127, 'IP3', 'INDOSAT REGULER', 3000, 7000, 3, 10, 'PCS', 'x'),
(128, 'AX0', 'AXIS REGULER', 1000, 3000, 1, 4, 'PCS', 'x'),
(129, 'AS5', 'AS REGULER', 15000, 18000, 2, 6, 'PCS', 'x'),
(130, 'XL0', 'XL REGULER', 0, 3000, 1, 9, 'PCS', 'x'),
(131, 'TR2K', 'TRI REGULER', 3000, 5000, 1, 0, 'PCS', 'x');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_detailpembelian`
--

CREATE TABLE `tb_detailpembelian` (
  `id_detailbeli` int(11) NOT NULL,
  `id_pembelian` varchar(50) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `harga_awal` int(15) NOT NULL,
  `harga_jual` int(15) NOT NULL,
  `qty` int(11) NOT NULL,
  `subtotal` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_detailpembelian`
--

INSERT INTO `tb_detailpembelian` (`id_detailbeli`, `id_pembelian`, `id_barang`, `harga_awal`, `harga_jual`, `qty`, `subtotal`) VALUES
(3, 'TRS-050119142029', 73, 13600, 16000, 1, 16000),
(4, 'TRS-050119142029', 73, 13600, 16000, 1, 16000),
(5, 'TRS-050119142029', 73, 13600, 16000, 1, 16000),
(6, 'TRS-050119142111', 106, 10500, 12000, 1, 12000),
(7, 'TRS-050119145850', 69, 20500, 23000, 1, 23000),
(8, 'TRS-050119145850', 69, 20500, 23000, 1, 23000),
(9, 'TRS-050119145850', 69, 20500, 23000, 1, 23000),
(10, 'TRS-050119145850', 69, 20500, 23000, 1, 23000),
(11, 'TRS-050119145850', 69, 20500, 23000, 1, 23000),
(12, 'TRS-050119145850', 69, 20500, 23000, 1, 23000),
(13, 'TRS-050119145901', 88, 30000, 33000, 1, 33000),
(14, 'TRS-050119145901', 88, 30000, 33000, 1, 33000),
(15, 'TRS-050119145914', 74, 23000, 26000, 1, 26000),
(16, 'TRS-050119145914', 74, 23000, 26000, 1, 26000),
(17, 'TRS-050119145914', 74, 23000, 26000, 1, 26000),
(18, 'TRS-050119145914', 74, 23000, 26000, 1, 26000),
(19, 'TRS-050119145914', 74, 23000, 26000, 1, 26000),
(20, 'TRS-050119145914', 74, 23000, 26000, 1, 26000),
(21, 'TRS-050119150022', 77, 59000, 64000, 1, 64000),
(22, 'TRS-050119150255', 73, 13600, 16000, 1, 16000),
(23, 'TRS-050119150255', 75, 29000, 32000, 1, 32000),
(24, 'TRS-050119150255', 91, 75500, 79000, 1, 79000),
(25, 'TRS-050119150255', 85, 13250, 15000, 1, 15000),
(26, 'TRS-050119150255', 86, 29250, 31000, 1, 31000),
(27, 'TRS-050119150255', 87, 18250, 21000, 1, 21000),
(28, 'TRS-050119150255', 88, 30000, 33000, 1, 33000),
(29, 'TRS-050119150255', 89, 42500, 45000, 1, 45000),
(30, 'TRS-050119150255', 90, 58500, 62000, 1, 62000),
(31, 'TRS-050119150255', 81, 27000, 30000, 1, 30000),
(32, 'TRS-050119150255', 82, 37000, 40000, 1, 40000),
(33, 'TRS-050119150255', 83, 57500, 60000, 1, 60000),
(34, 'TRS-050119150255', 84, 85000, 90000, 1, 90000),
(35, 'TRS-050119150255', 130, 0, 3000, 1, 3000),
(36, 'TRS-050119150255', 116, 30000, 34000, 1, 34000),
(37, 'TRS-050119150255', 115, 17000, 20000, 1, 20000),
(38, 'TRS-050119150255', 117, 44000, 49000, 1, 49000),
(39, 'TRS-050119150255', 118, 13000, 15000, 1, 15000),
(40, 'TRS-050119150255', 119, 24000, 28000, 1, 28000),
(41, 'TRS-050119150255', 120, 17000, 20000, 1, 20000),
(42, 'TRS-050119150556', 111, 18000, 27000, 1, 27000),
(43, 'TRS-050119150556', 112, 35000, 45000, 1, 45000),
(44, 'TRS-050119150556', 113, 35000, 50000, 1, 50000),
(45, 'TRS-050119150556', 114, 60000, 65000, 1, 65000),
(46, 'TRS-050119150556', 127, 3000, 7000, 1, 7000),
(47, 'TRS-050119150556', 92, 8250, 9000, 1, 9000),
(48, 'TRS-050119150556', 93, 12000, 14000, 1, 14000),
(49, 'TRS-050119150556', 94, 11000, 13000, 1, 13000),
(50, 'TRS-050119150556', 95, 14400, 17000, 1, 17000),
(51, 'TRS-050119150556', 96, 31000, 33000, 1, 33000),
(52, 'TRS-050119150556', 97, 20250, 22000, 1, 22000);

--
-- Trigger `tb_detailpembelian`
--
DELIMITER $$
CREATE TRIGGER `Kurang_Stok` AFTER INSERT ON `tb_detailpembelian` FOR EACH ROW BEGIN
	UPDATE tb_barang SET stok_b=stok_b-NEW.qty
    where id_barang=NEW.id_barang;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `hapus` AFTER DELETE ON `tb_detailpembelian` FOR EACH ROW BEGIN
	UPDATE tb_barang set stok_b = stok_b + OLD.qty WHERE
    id_barang = OLD.id_barang;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pegawai`
--

CREATE TABLE `tb_pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `nama_p` varchar(100) NOT NULL,
  `jekel_p` enum('l','p') NOT NULL,
  `tempat_lahir_p` varchar(100) NOT NULL,
  `tgl_lahir_p` date NOT NULL,
  `alamat_p` text NOT NULL,
  `no_telp_p` varchar(20) NOT NULL,
  `foto_p` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_pegawai`
--

INSERT INTO `tb_pegawai` (`id_pegawai`, `nama_p`, `jekel_p`, `tempat_lahir_p`, `tgl_lahir_p`, `alamat_p`, `no_telp_p`, `foto_p`) VALUES
(2, 'ana', 'p', 'kudus', '2018-11-13', 'kudus, undaan', '0856787697', 'ana.jpg'),
(3, 'Maula', 'l', 'kudus', '2018-12-12', 'aa', '546536464', 'Untitled-2.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pembelian`
--

CREATE TABLE `tb_pembelian` (
  `id_pembelian` varchar(50) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tanggal_beli` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_pembelian`
--

INSERT INTO `tb_pembelian` (`id_pembelian`, `id_user`, `tanggal_beli`) VALUES
('TRS-050119142029', 10, '2019-01-05 14:20:29'),
('TRS-050119142111', 10, '2019-01-05 14:21:11'),
('TRS-050119145850', 10, '2019-01-05 14:58:50'),
('TRS-050119145901', 10, '2019-01-05 14:59:01'),
('TRS-050119145914', 10, '2019-01-05 14:59:14'),
('TRS-050119150022', 10, '2019-01-05 15:00:22'),
('TRS-050119150255', 10, '2019-01-05 15:02:55'),
('TRS-050119150556', 10, '2019-01-05 15:05:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `level` enum('admin','kasir') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `username`, `password`, `nama`, `level`) VALUES
(7, 'admin', '12345', 'Maula', 'admin'),
(10, 'ichl', 'ichl', 'ichl', 'kasir');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indeks untuk tabel `tb_detailpembelian`
--
ALTER TABLE `tb_detailpembelian`
  ADD PRIMARY KEY (`id_detailbeli`),
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `id_pembelian` (`id_pembelian`);

--
-- Indeks untuk tabel `tb_pegawai`
--
ALTER TABLE `tb_pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indeks untuk tabel `tb_pembelian`
--
ALTER TABLE `tb_pembelian`
  ADD PRIMARY KEY (`id_pembelian`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_barang`
--
ALTER TABLE `tb_barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT untuk tabel `tb_detailpembelian`
--
ALTER TABLE `tb_detailpembelian`
  MODIFY `id_detailbeli` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT untuk tabel `tb_pegawai`
--
ALTER TABLE `tb_pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_detailpembelian`
--
ALTER TABLE `tb_detailpembelian`
  ADD CONSTRAINT `tb_detailpembelian_ibfk_1` FOREIGN KEY (`id_pembelian`) REFERENCES `tb_pembelian` (`id_pembelian`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
