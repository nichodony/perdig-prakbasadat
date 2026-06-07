-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Jun 2026 pada 06.24
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perdig`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE `buku` (
  `id_buku` int(11) NOT NULL,
  `judul` varchar(200) NOT NULL,
  `penulis` varchar(100) NOT NULL,
  `penerbit` varchar(100) DEFAULT NULL,
  `tahun_terbit` year(4) DEFAULT NULL,
  `stok` int(11) DEFAULT 0,
  `cover` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `id_kategori` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`id_buku`, `judul`, `penulis`, `penerbit`, `tahun_terbit`, `stok`, `cover`, `deskripsi`, `id_kategori`) VALUES
(4, 'Pulang', 'Tere Liye', 'Sabak Grip', '2017', 13, 'pulang.jpg', NULL, 1),
(6, '3726 MDPL', 'Nurwina Sari', 'Romancious', '2024', 4, '9397p4603v.jpg', 'Selain disibukkan dengan skripsi, Rangga, Ketua Panitia OSPEK Fakultas Kehutanan 2023 itu juga menyibukkan dirinya dengan mengagumi Andini. Seorang mahasiswi yang bercita-cita bisa mendaki Gunung Rinjani, sekaligus adik tingkat yang ia sebut sebagai manusia favorit.  Andini dikelilingi oleh banyak cinta, banyak manusia yang ingin dengannya, terutama Rangga dengan seluruh kesan istimewanya. Namun, dalam dirinya, ada manusia dulu yang entah masih jadi pemenang atau definisi lain dari itu.', 1),
(7, 'Carlo Acutis : Lima Jalan Autentik Menjadi Orang Kudus', 'Elis Handoko', 'Rumah Dehonian', '2025', 5, 'carlo.avif', 'Mungkinkah menjadi orang kudus di zaman para pemengaruh?  Di tengah zaman yang bising oleh citra, kecepatan, dan tuntutan untuk terus tampil, Santo Carlo Acutis hadir sebagai sosok yang menghadirkan kejernihan. Ia seorang remaja biasa, akrab dengan dunia digital, namun memiliki arah hidup yang jernih dan utuh. Ia bersekolah, bersahabat, menggunakan internet dan hatinya tertambat pada Tuhan.  Buku ini mengajak pembaca mengenal Carlo Acutis lebih dekat. Bukan sebagai figur suci yang jauh dan sulit ditiru, melainkan sebagai santo di sebelah rumah. Dari kehidupannya yang sederhana, kita diajak melihat bahwa kekudusan tidak lahir dari hal-hal luar biasa, tetapi tumbuh dari kerinduan yang jujur dan pilihan-pilihan kecil yang dijalani dengan setia.', 7),
(8, 'Playboy on the Table Nine', 'Rizki Fitrianti', 'Cloud Books', '2026', 3, '0epabl2i32.avif', 'ni kisah tentang seseorang yang belajar mencintai lagi setelah dunia berkali-kali meruntuhkannya. Galelio Jevano tidak pernah benar-benar memilih hidupnya hingga cinta dan kehilangan memaksanya bertarung dengan takdirnya. Sebagai mahasiswa Hukum yang aktif berorganisasi, ia selalu terlihat kuat. Nyatanya, ia sedang memikul luka.', 1),
(9, 'KUHP Edisi Terbaru & Terlengkap', 'Tim Adhyaksa', 'Moka Media', '2026', 4, 'v-dbvx-ezt.avif', 'Buku ini menyajikan kumpulan lengkap Kitab Undang-Undang Hukum Pidana (KUHP) dalam satu referensi yang praktis dan mudah dipahami. Buku ini dapat menjadi pilihan tepat bagi Anda untuk mempelajari KUHP yang di dalamnya sudah edisi terbaru dan dilengkapi penanda blocking untuk memudahkan Anda memahami perubahan dalam UU NOMOR 1 TAHUN 2023 TENTANG KITAB UNDANG-UNDANG HUKUM PIDANA yang disesuaikan dengan UU NOMOR 1 TAHUN 2026 TENTANG PENYESUAIAN PIDANA.', 8),
(10, 'Penuntun Pelajaran Matematika SD/MI Kelas 4', 'Sukino', 'Yrama Widya', '2020', 2, 'Sd_Mi_Kls.Iv_Penuntun_Pelajaran_Matematika.avif', 'Di era abad 21 ini, minimal ada 3 hal yang harus dimiliki oleh siswa, yaitu berpikir logis, berpikir kritis, dan kreatif. Di samping itu, siswa juga harus memiliki karakter baik berlandaskan enam profil pelajar Pancasila, yaitu beriman, bertakwa kepada Tuhan YME, dan berakhlak mulia, seperti berkebinekaan global, bergotong royong, kreatif, bernalar kritis, dan mandiri. Buku Penuntun Pelajaran Matematika untuk SD/MI Kelas IV ini disusun khusus untuk membantu siswa memiliki keterampilan berpikir Abad 21 dan berkarakter baik. Di samping itu, buku ini hadir untuk siswa yang ingin mengulang serta memperdalam materi Matematika kelas IV yang sudah dipelajari di sekolahnya masing-masing.', 9);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Fiksi'),
(7, 'Agama'),
(8, 'Hukum'),
(9, 'Pelajaran');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_peminjaman` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `status` enum('menunggu','disetujui','dipinjam','ditolak','dikembalikan') NOT NULL DEFAULT 'menunggu',
  `kode_peminjaman` varchar(50) DEFAULT NULL,
  `catatan_admin` text DEFAULT NULL,
  `tanggal_persetujuan` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `peminjaman`
--

INSERT INTO `peminjaman` (`id_peminjaman`, `id_user`, `id_buku`, `tanggal_pinjam`, `tanggal_kembali`, `status`, `kode_peminjaman`, `catatan_admin`, `tanggal_persetujuan`) VALUES
(11, 7, 4, '2026-06-06', '2026-06-13', 'dikembalikan', 'PERDIG-20260606-011', '\r\nSilahkan ambil buku di perpustakaan maksimal 3 hari setelah persetujuan.\r\n                    ', '2026-06-06 10:59:19'),
(12, 6, 4, '2026-06-06', '2026-06-13', 'dikembalikan', 'PERDIG-20260606-012', '\r\nSilahkan ambil buku di perpustakaan maksimal 3 hari setelah persetujuan.\r\n\r\n                    ', '2026-06-07 04:20:17'),
(13, 6, 6, '2026-06-07', '2026-06-14', 'ditolak', NULL, 'Buku sedang tidak tersedia saat ini.', NULL),
(14, 7, 8, '2026-06-07', '2026-06-14', 'menunggu', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ulasan`
--

CREATE TABLE `ulasan` (
  `id_ulasan` int(11) NOT NULL,
  `id_buku` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `ulasan` text DEFAULT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `ulasan`
--

INSERT INTO `ulasan` (`id_ulasan`, `id_buku`, `id_user`, `rating`, `ulasan`, `tanggal`) VALUES
(1, 4, 6, 5, 'Bukunya bagus bangettt', '2026-06-06 23:08:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `nama`, `username`, `password`, `role`, `email`, `no_hp`, `alamat`, `created_at`) VALUES
(1, 'Administrator', 'admin', '202cb962ac59075b964b07152d234b70', 'admin', 'admin@gmail.com', '08123456789', NULL, '2026-05-29 01:28:55'),
(6, 'Sultan Nicho', 'suli', '698d51a19d8a121ce581499d7b701668', 'user', 'suli@gmail.com', NULL, NULL, '2026-06-02 17:10:59'),
(7, 'niko adit', 'adit', 'bcbe3365e6ac95ea2c0343a2395834dd', 'user', 'nikhodit@gmail.com', '0812374635526', 'Sidoarjo', '2026-06-05 05:42:22');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_buku` (`id_buku`);

--
-- Indeks untuk tabel `ulasan`
--
ALTER TABLE `ulasan`
  ADD PRIMARY KEY (`id_ulasan`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_peminjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `ulasan`
--
ALTER TABLE `ulasan`
  MODIFY `id_ulasan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `buku_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE,
  ADD CONSTRAINT `peminjaman_ibfk_2` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
