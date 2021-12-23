-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Des 2019 pada 09.23
-- Versi server: 10.1.39-MariaDB
-- Versi PHP: 7.1.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `indogamestore`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `uname` varchar(30) NOT NULL,
  `pass` varchar(70) NOT NULL,
  `foto` text NOT NULL,
  `level` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `uname`, `pass`, `foto`, `level`) VALUES
(8, 'ropel', 'eec470e2f66e97a2ff82bcb62897375a', 'gundar.jpg', 'admin'),
(11, 'ropel1', '202cb962ac59075b964b07152d234b70', 'gundar.jpg', 'kasir');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id` int(11) NOT NULL,
  `nama` text NOT NULL,
  `jenis` text NOT NULL,
  `suplier` text NOT NULL,
  `modal` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `sisa` int(11) NOT NULL,
  `totalmodal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id`, `nama`, `jenis`, `suplier`, `modal`, `harga`, `jumlah`, `sisa`, `totalmodal`) VALUES
(3, 'Tiktak', 'Makan Ringan', 'Pt .Mulia', 5000, 6000, 0, 100, 500000),
(4, 'Toktok', 'Makanan Berat', 'Pt.lope', 8000, 9000, 0, 25, 200000),
(5, 'Bajigur', 'Makanan Berat', 'Pt.Bajigur', 3500, 5000, 9, 50, 175000),
(6, 'Lotek', 'Makanan Berat', 'Pt.lq', 4000, 6000, 8, 40, 160000),
(7, 'tiktak', 'Makan Ringan', 'pt multi', 3500, 6000, 0, 120, 420000),
(8, 'Kopi', 'Minuman', 'pt.pro', 5000, 9000, 90, 100, 500000),
(9, 'Kuaci', 'makanan ringan', 'Pt .Mulia', 5000, 6000, 100, 100, 500000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_laku`
--

CREATE TABLE `barang_laku` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `nama` text NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `total_harga` int(20) NOT NULL,
  `laba` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `barang_laku`
--

INSERT INTO `barang_laku` (`id`, `tanggal`, `nama`, `jumlah`, `harga`, `total_harga`, `laba`) VALUES
(78, '2019-12-02', 'Tiktak', 10, 7000, 70000, 20000),
(80, '2019-12-02', 'Tiktak', 10, 10000, 100000, 50000),
(81, '2019-12-02', 'Tiktak', 5, 10000, 50000, 25000),
(82, '2019-12-02', 'Tiktak', 5, 10000, 50000, 25000),
(83, '2019-12-03', 'Tiktak', 10, 10000, 100000, 50000),
(86, '2019-12-03', 'Tiktak', 10, 9000, 90000, 40000),
(87, '2019-12-05', 'Tiktak', 10, 9000, 90000, 40000),
(88, '2019-12-05', 'Bajigur', 10, 12000, 120000, 85000),
(89, '2019-12-06', 'Bajigur', 3, 9000, 27000, 16500),
(90, '2019-12-06', 'Tiktak', 20, 10000, 200000, 100000),
(91, '2019-12-06', 'Lotek', 10, 5000, 50000, 10000),
(92, '2019-12-07', 'Tiktak', 3, 6000, 18000, 3000),
(93, '2019-12-08', 'Bajigur', 20, 10000, 200000, 130000),
(94, '2019-12-09', 'tiktak', 5, 7000, 35000, 10000),
(95, '2019-12-10', 'Tiktak', 2, 7000, 14000, 4000),
(96, '2019-12-11', 'Tiktak', 3, 7000, 21000, 6000),
(97, '2019-12-12', 'Tiktak', 2, 7000, 14000, 4000),
(98, '2019-12-13', 'Bajigur', 3, 7000, 21000, 10500),
(99, '2019-12-14', 'Lotek', 3, 7000, 21000, 9000),
(100, '2019-12-16', 'Toktok', 4, 7000, 28000, -4000),
(101, '2019-12-17', 'Toktok', 4, 7000, 28000, -4000),
(102, '2019-12-19', 'Bajigur', 2, 10000, 20000, 13000),
(103, '2019-12-21', 'Lotek', 2, 10000, 20000, 12000),
(104, '2019-12-21', 'Tiktak', 2, 10000, 20000, 10000),
(105, '2019-12-22', 'Toktok', 2, 10000, 20000, 4000),
(106, '2019-12-25', 'Toktok', 4, 10000, 40000, 8000),
(107, '2019-12-28', 'Tiktak', 5, 10000, 50000, 25000),
(108, '2019-12-25', 'Tiktak', 6, 10000, 60000, 30000),
(109, '2019-12-28', 'Tiktak', 2, 10000, 20000, 10000),
(110, '2019-12-29', 'Toktok', 9, 10000, 90000, 18000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `keperluan` text NOT NULL,
  `nama` text NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `barang_laku`
--
ALTER TABLE `barang_laku`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `barang_laku`
--
ALTER TABLE `barang_laku`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT untuk tabel `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
