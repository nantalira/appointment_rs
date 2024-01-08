-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Jan 2024 pada 04.28
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `appointment_rs`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `akun`
--

CREATE TABLE `akun` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','dokter','pasien') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `akun`
--

INSERT INTO `akun` (`id`, `email`, `password`, `role`) VALUES
(8, 'admin@email.com', '$2y$10$FM.1ovaRdUQihqECbmPBkeExBhZaWuJmz44Y19nhaKP.4MNo.7yHm', 'admin'),
(11, '111202012712@mhs.dinus.ac.id', '$2y$10$HtAls527W9SCCItBFecgguclGEHG1baMPCIzTKx1Lt9YBpIkc6z6a', 'pasien'),
(12, 'ww@ss.co', '$2y$10$JfoISt7nRDIUzKo9l8sqo.ZA8mOXKLFLgwwZRBJ0E5FGVPJJ/4mGK', 'pasien'),
(16, 'dokter@gmail.com', '$2y$10$FM.1ovaRdUQihqECbmPBkeExBhZaWuJmz44Y19nhaKP.4MNo.7yHm', 'dokter'),
(21, 'kampoengbola6@gmail.com', '$2y$10$qS6CB06YfupX9sGp7NZICu8CG8uL5DY8JSOWmNPy.4TepM7cHcAy6', 'pasien'),
(22, 'safiardemak@kalijaga.com', '$2y$10$3O.4VSbeS4ibEAUtSWi75eUlJNp9klXM.hxdXp2w3UqbWs4Oi4k4C', 'pasien'),
(23, 'sdasd@dsad.com', '$2y$10$RunW57dUV8wvxpbW/PgtqOEX4SEvJ.FRvVZYPfoCunPkumPi3/Lfu', 'dokter'),
(24, 'sendi@gmail.com', '$2y$10$2rmKika1x7cl/I0kouE3I.qdOnIPHIIjT/B47zAzWytianb4u/aOm', 'dokter'),
(25, 'ardi@gmail.com', '$2y$10$V.PtdB54IILKkjem1SY3x.GdDYmk57QNI6JVCeUobiwGeh7IIhGB.', 'dokter'),
(31, 'pasien@email.com', '$2y$10$tNil7mMgqBTd6/rDpbVhhOLM9Rmc3IMUt3XnfAMbuLuUGpn5xqiia', 'pasien'),
(32, 'boyke@email.com', '$2y$10$MsIasrnvEycZ6RUBkYzPNeVrWu/G.R/Gp7L7o7OPs/90DcY4ntf4m', 'dokter');

-- --------------------------------------------------------

--
-- Struktur dari tabel `daftar_poli`
--

CREATE TABLE `daftar_poli` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_pasien` int(11) UNSIGNED NOT NULL,
  `id_jadwal` int(11) UNSIGNED NOT NULL,
  `keluhan` text NOT NULL,
  `no_antrian` int(11) UNSIGNED NOT NULL,
  `status` enum('daftar','selesai') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `daftar_poli`
--

INSERT INTO `daftar_poli` (`id`, `id_pasien`, `id_jadwal`, `keluhan`, `no_antrian`, `status`) VALUES
(15, 8, 5, 'Sakit umum', 1, 'selesai'),
(16, 7, 5, 'Sakit umum', 2, 'selesai'),
(19, 7, 1, 'Sakit gigi', 1, 'selesai'),
(20, 7, 1, 'Sakit gigi', 2, 'selesai'),
(22, 8, 1, 'Sakit gigi', 3, 'selesai'),
(23, 7, 1, 'Sakit gigi', 4, 'selesai'),
(24, 8, 1, 'Sakit gigi', 5, 'daftar'),
(25, 7, 6, 'Sakit gigi', 1, 'selesai'),
(26, 7, 1, 'Sakit gigi', 6, 'selesai'),
(31, 12, 10, 'Gatal diarea kemaluan', 1, 'selesai'),
(32, 12, 5, 'Sakit umum', 3, 'daftar'),
(33, 12, 10, 'Gatal diarea kemaluan', 2, 'daftar');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_periksa`
--

CREATE TABLE `detail_periksa` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_periksa` int(11) UNSIGNED NOT NULL,
  `id_obat` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `detail_periksa`
--

INSERT INTO `detail_periksa` (`id`, `id_periksa`, `id_obat`) VALUES
(1, 1, 1),
(2, 1, 3),
(3, 2, 3),
(4, 2, 4),
(8, 4, 1),
(9, 4, 3),
(10, 4, 4),
(11, 5, 4),
(12, 6, 3),
(13, 6, 4),
(14, 7, 5),
(15, 7, 6),
(16, 7, 10),
(17, 7, 11),
(18, 8, 9),
(19, 8, 10),
(20, 8, 11),
(21, 9, 7),
(22, 9, 8),
(23, 9, 9),
(26, 11, 11),
(27, 11, 14);

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokter`
--

CREATE TABLE `dokter` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_akun` int(11) UNSIGNED NOT NULL,
  `id_poli` int(11) UNSIGNED DEFAULT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_hp` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `dokter`
--

INSERT INTO `dokter` (`id`, `id_akun`, `id_poli`, `nama`, `alamat`, `no_hp`) VALUES
(1, 16, 1, 'Pak dokter', 'sadasdsa dasd', '07231398238'),
(6, 23, 4, 'sinaga', 'sorong', '01923891283'),
(7, 24, 4, 'Sendi', 'dkasdlkjsadlkj', '07213123123'),
(8, 25, 5, 'Ardi Hitam', 'papua pojok kanan atas', '0283712873'),
(11, 32, 8, 'Boyke', 'Jakarta', '231832809');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal_periksa`
--

CREATE TABLE `jadwal_periksa` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_dokter` int(11) UNSIGNED DEFAULT NULL,
  `hari` enum('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu') NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `jadwal_periksa`
--

INSERT INTO `jadwal_periksa` (`id`, `id_dokter`, `hari`, `jam_mulai`, `jam_selesai`) VALUES
(1, 6, 'Sabtu', '03:56:00', '20:54:00'),
(5, 1, 'Selasa', '10:31:00', '13:31:00'),
(6, 7, 'Kamis', '08:21:00', '21:21:00'),
(9, 8, 'Rabu', '11:33:00', '09:36:00'),
(10, 11, 'Senin', '12:45:00', '14:45:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `obat`
--

CREATE TABLE `obat` (
  `id` int(11) UNSIGNED NOT NULL,
  `nama_obat` varchar(50) NOT NULL,
  `kemasan` varchar(35) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `obat`
--

INSERT INTO `obat` (`id`, `nama_obat`, `kemasan`, `harga`) VALUES
(1, 'Bodrexin', 'Tablet', 3000),
(3, 'Paramex', 'Tablet', 5000),
(4, 'Hufagrip', 'botol', 20000),
(5, 'Azatioprin tablet 50 mg', 'ktk 10 x 10 tablet', 28000),
(6, 'Bromheksin tablet 8 mg', 'ktk 10 x 10 tablet', 6000),
(7, 'Cisapride tablet 10 mg', 'ktk 10 x 10 tablet', 178000),
(8, 'Domperidon Suspensi 5 mg/5 ml', 'btl 60 ml', 15200),
(9, 'Fenitoin kapsul 100 mg', 'btl 250 kapsul', 27000),
(10, 'Isoniazid tablet 300 mg', 'botol 1000 tablet', 116500),
(11, 'Ketorolac Injeksi 10 mg', 'ktk 5 amp @ 1 ml', 50000),
(14, 'Salep gatal', 'sacet', 15000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pasien`
--

CREATE TABLE `pasien` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_akun` int(11) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_ktp` varchar(255) NOT NULL,
  `no_hp` varchar(50) NOT NULL,
  `no_rm` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pasien`
--

INSERT INTO `pasien` (`id`, `id_akun`, `nama`, `alamat`, `no_ktp`, `no_hp`, `no_rm`) VALUES
(5, 11, 'dhiya ulhaq', 'Bintaro', '123456', '12312312312', '202312-1'),
(6, 12, 'dower', '123asdasd', '12314123', '07231398238', '202312-2'),
(7, 21, 'hafizh dhiya', 'Sambongsari', '23123123124', '0712871982791', '202312-3'),
(8, 22, 'NANTALIRA NIAR WIJAYA', 'skadjlakjd', '2313124124124', '07231398238', '202312-4'),
(12, 31, 'Pasien', 'Semarang', '1237128', '3213879', '202401-5');

-- --------------------------------------------------------

--
-- Struktur dari tabel `periksa`
--

CREATE TABLE `periksa` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_daftar_poli` int(11) UNSIGNED NOT NULL,
  `tgl_periksa` datetime NOT NULL,
  `catatan` text NOT NULL,
  `biaya_periksa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `periksa`
--

INSERT INTO `periksa` (`id`, `id_daftar_poli`, `tgl_periksa`, `catatan`, `biaya_periksa`) VALUES
(1, 15, '2024-01-01 00:00:00', 'wqdsdsda', 159000),
(2, 19, '2024-01-01 00:00:00', 'mantap', 175000),
(4, 22, '2024-01-01 00:00:00', 'asdasdasdsa', 179000),
(5, 20, '2024-01-01 00:00:00', 'asdasdasd', 170000),
(6, 16, '2024-01-01 00:00:00', 'joss', 175000),
(7, 23, '2024-01-02 00:00:00', 'minum sampai berbusa', 350500),
(8, 25, '2024-01-03 00:00:00', 'diminum sebelum naik haji', 343500),
(9, 26, '2024-01-06 00:00:00', 'diminum', 370200),
(11, 31, '2024-01-08 00:00:00', 'Salep dioleskan sehari 10 kali \r\nketorolac di suntikan 2 kali sehari', 215000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `poli`
--

CREATE TABLE `poli` (
  `id` int(11) UNSIGNED NOT NULL,
  `nama_poli` varchar(25) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `poli`
--

INSERT INTO `poli` (`id`, `nama_poli`, `keterangan`) VALUES
(1, 'poli umum', 'poli yang umum'),
(4, 'Poli Gigi', 'Poli yang gigi'),
(5, 'Poli Mata', 'Poli yang mata'),
(8, 'Poli Kelamin', 'Menangani berbagai penyakit kelamin');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `daftar_poli`
--
ALTER TABLE `daftar_poli`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pasien` (`id_pasien`),
  ADD KEY `id_jadwal` (`id_jadwal`);

--
-- Indeks untuk tabel `detail_periksa`
--
ALTER TABLE `detail_periksa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_periksa` (`id_periksa`),
  ADD KEY `id_obat` (`id_obat`);

--
-- Indeks untuk tabel `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_akun` (`id_akun`),
  ADD KEY `id_poli` (`id_poli`);

--
-- Indeks untuk tabel `jadwal_periksa`
--
ALTER TABLE `jadwal_periksa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_dokter` (`id_dokter`) USING BTREE;

--
-- Indeks untuk tabel `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_akun` (`id_akun`);

--
-- Indeks untuk tabel `periksa`
--
ALTER TABLE `periksa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_daftar_poli` (`id_daftar_poli`);

--
-- Indeks untuk tabel `poli`
--
ALTER TABLE `poli`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `akun`
--
ALTER TABLE `akun`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `daftar_poli`
--
ALTER TABLE `daftar_poli`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT untuk tabel `detail_periksa`
--
ALTER TABLE `detail_periksa`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `dokter`
--
ALTER TABLE `dokter`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `jadwal_periksa`
--
ALTER TABLE `jadwal_periksa`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `obat`
--
ALTER TABLE `obat`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `periksa`
--
ALTER TABLE `periksa`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `poli`
--
ALTER TABLE `poli`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `daftar_poli`
--
ALTER TABLE `daftar_poli`
  ADD CONSTRAINT `daftar_poli_ibfk_1` FOREIGN KEY (`id_pasien`) REFERENCES `pasien` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `daftar_poli_ibfk_2` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwal_periksa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `detail_periksa`
--
ALTER TABLE `detail_periksa`
  ADD CONSTRAINT `detail_periksa_ibfk_1` FOREIGN KEY (`id_periksa`) REFERENCES `periksa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_periksa_ibfk_2` FOREIGN KEY (`id_obat`) REFERENCES `obat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `dokter`
--
ALTER TABLE `dokter`
  ADD CONSTRAINT `dokter_ibfk_2` FOREIGN KEY (`id_akun`) REFERENCES `akun` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dokter_ibfk_3` FOREIGN KEY (`id_poli`) REFERENCES `poli` (`id`) ON DELETE CASCADE ON UPDATE SET NULL;

--
-- Ketidakleluasaan untuk tabel `jadwal_periksa`
--
ALTER TABLE `jadwal_periksa`
  ADD CONSTRAINT `jadwal_periksa_ibfk_1` FOREIGN KEY (`id_dokter`) REFERENCES `dokter` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pasien`
--
ALTER TABLE `pasien`
  ADD CONSTRAINT `pasien_ibfk_1` FOREIGN KEY (`id_akun`) REFERENCES `akun` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `periksa`
--
ALTER TABLE `periksa`
  ADD CONSTRAINT `periksa_ibfk_1` FOREIGN KEY (`id_daftar_poli`) REFERENCES `daftar_poli` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
