-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 27 Apr 2025 pada 16.05
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restoran`
--

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `laporan`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `laporan` (
`kd_transaksi` int(11)
,`menu` varchar(100)
,`harga` int(11)
,`subtotal` int(11)
,`tgl_transaksi` datetime
,`no_meja` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `q_user`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `q_user` (
`kd_user` int(11)
,`nama` varchar(50)
,`no_hp` varchar(15)
,`username` varchar(50)
,`password` varchar(50)
,`level` varchar(10)
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kategori`
--

CREATE TABLE `tb_kategori` (
  `kd_kategori` int(11) NOT NULL,
  `kategori` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tb_kategori`
--

INSERT INTO `tb_kategori` (`kd_kategori`, `kategori`) VALUES
(1, 'Makanan Ringan'),
(2, 'Makanan Berat');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_menu`
--

CREATE TABLE `tb_menu` (
  `kd_menu` int(11) NOT NULL,
  `menu` varchar(100) NOT NULL,
  `jenis` varchar(20) NOT NULL,
  `harga` int(11) NOT NULL,
  `status` varchar(15) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `kd_kategori` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tb_menu`
--

INSERT INTO `tb_menu` (`kd_menu`, `menu`, `jenis`, `harga`, `status`, `foto`, `kd_kategori`) VALUES
(32, 'Ayam Goreng', 'Makanan', 19000, 'Tersedia', 'Screenshot (1).png', 1),
(44, 'Nasi Goreng', 'Makanan', 10000, 'Tersedia', 'd.jpeg', 2),
(49, 'Minas', 'Makanan', 18000, 'Tersedia', 'Mohammad Dimas Al Shiddiq_G1A023092.png', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pesanan`
--

CREATE TABLE `tb_pesanan` (
  `id_pesanan` int(11) NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `menu_pesanan` text NOT NULL,
  `total_harga` decimal(10,2) NOT NULL,
  `metode_pembayaran` varchar(50) NOT NULL,
  `status_pesanan` enum('Pending','Diproses','Selesai') DEFAULT 'Pending',
  `tanggal_pesan` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_reservation`
--

CREATE TABLE `tb_reservation` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `guests` int(11) DEFAULT NULL,
  `message` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_reservation`
--

INSERT INTO `tb_reservation` (`id`, `name`, `email`, `telephone`, `date`, `time`, `guests`, `message`) VALUES
(1, 'Mas Dimas', 'mas.dimas5758@gmail.com', '085379453969', '2025-04-29', '21:00:00', 5, 'Make me very good meal'),
(2, 'Mas Dimas', 'mas.dimas5758@gmail.com', '085379453969', '2025-04-09', '20:20:00', 2, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `kd_transaksi` int(11) NOT NULL,
  `kd_menu` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  `tgl_transaksi` datetime NOT NULL,
  `kd_user` int(11) NOT NULL,
  `no_meja` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`kd_transaksi`, `kd_menu`, `jumlah`, `subtotal`, `tgl_transaksi`, `kd_user`, `no_meja`) VALUES
(2, 13, 2, 30000, '2025-04-22 19:43:54', 18, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `kd_user` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`kd_user`, `nama`, `no_hp`, `username`, `password`, `level`) VALUES
(23, 'Mohammad Dimas Al Shiddiq', '082185333565', 'sky', 'kambing', 'user'),
(24, 'admin', '1', 'admin', 'admin', 'admin'),
(25, 'kasir', '1', 'kasir', 'kasir', 'kasir');

-- --------------------------------------------------------

--
-- Struktur untuk view `laporan`
--
DROP TABLE IF EXISTS `laporan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `laporan`  AS SELECT `tb_transaksi`.`kd_transaksi` AS `kd_transaksi`, `tb_menu`.`menu` AS `menu`, `tb_menu`.`harga` AS `harga`, `tb_transaksi`.`subtotal` AS `subtotal`, `tb_transaksi`.`tgl_transaksi` AS `tgl_transaksi`, `tb_transaksi`.`no_meja` AS `no_meja` FROM (`tb_transaksi` join `tb_menu`) WHERE `tb_transaksi`.`kd_menu` = `tb_menu`.`kd_menu` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `q_user`
--
DROP TABLE IF EXISTS `q_user`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `q_user`  AS SELECT `tb_user`.`kd_user` AS `kd_user`, `tb_user`.`nama` AS `nama`, `tb_user`.`no_hp` AS `no_hp`, `tb_user`.`username` AS `username`, `tb_user`.`password` AS `password`, `tb_user`.`level` AS `level` FROM `tb_user` ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_kategori`
--
ALTER TABLE `tb_kategori`
  ADD PRIMARY KEY (`kd_kategori`),
  ADD KEY `kd_kategori` (`kd_kategori`) USING BTREE;

--
-- Indeks untuk tabel `tb_menu`
--
ALTER TABLE `tb_menu`
  ADD PRIMARY KEY (`kd_menu`),
  ADD KEY `kd_kategori` (`kd_kategori`) USING BTREE;

--
-- Indeks untuk tabel `tb_pesanan`
--
ALTER TABLE `tb_pesanan`
  ADD PRIMARY KEY (`id_pesanan`);

--
-- Indeks untuk tabel `tb_reservation`
--
ALTER TABLE `tb_reservation`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD KEY `kd_user` (`kd_user`) USING BTREE,
  ADD KEY `kd_menu` (`kd_menu`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`kd_user`),
  ADD KEY `kd_user` (`kd_user`) USING BTREE;

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_kategori`
--
ALTER TABLE `tb_kategori`
  MODIFY `kd_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_menu`
--
ALTER TABLE `tb_menu`
  MODIFY `kd_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT untuk tabel `tb_pesanan`
--
ALTER TABLE `tb_pesanan`
  MODIFY `id_pesanan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_reservation`
--
ALTER TABLE `tb_reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `kd_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_menu`
--
ALTER TABLE `tb_menu`
  ADD CONSTRAINT `tb_menu_ibfk_1` FOREIGN KEY (`kd_kategori`) REFERENCES `tb_kategori` (`kd_kategori`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
