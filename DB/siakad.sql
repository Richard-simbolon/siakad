-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 21, 2019 at 01:19 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `siakad`
--

-- --------------------------------------------------------

--
-- Table structure for table `Cashtree`
--

CREATE TABLE `Cashtree` (
  `name` bigint(20) UNSIGNED NOT NULL,
  `back` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelas` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `id` int(11) NOT NULL,
  `row_status` enum('active','deleted','notactive','') NOT NULL,
  `nama` varchar(250) NOT NULL,
  `nik` varchar(50) NOT NULL,
  `tempat_lahir` varchar(250) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `agama` enum('islam','protestan','katolik','hindu','budha','khonghucu') NOT NULL,
  `jenis_kelamin` enum('laki-laki','perempuan','','') NOT NULL,
  `nidn_nup_nidk` varchar(100) NOT NULL,
  `nip` varchar(100) NOT NULL,
  `npwp` varchar(100) NOT NULL,
  `status` enum('aktif','tidak aktif','','') NOT NULL,
  `nama_ibu` varchar(250) NOT NULL,
  `ikatan_kerja` varchar(250) NOT NULL,
  `status_pegawai` varchar(100) NOT NULL,
  `jenis_pegawai` varchar(100) NOT NULL,
  `no_sk_cpns` varchar(100) NOT NULL,
  `tanggal_sk_cpns` date NOT NULL,
  `no_sk_pengangkatan` varchar(100) NOT NULL,
  `tgl_sk_pengangkatan` date NOT NULL,
  `lembaga_pengangkatan` varchar(250) NOT NULL,
  `pangkat_golongan` varchar(100) NOT NULL,
  `sumber_gaji` varchar(250) NOT NULL,
  `alamat` varchar(500) NOT NULL,
  `dusun` varchar(100) NOT NULL,
  `kelurahan` varchar(250) NOT NULL,
  `kecamatan` varchar(250) NOT NULL,
  `rt` varchar(100) NOT NULL,
  `rw` varchar(100) NOT NULL,
  `kode_pos` varchar(100) NOT NULL,
  `telepon` varchar(50) NOT NULL,
  `no_hp` varchar(50) NOT NULL,
  `email` varchar(250) NOT NULL,
  `created_by` varchar(250) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_by` varchar(250) NOT NULL,
  `modified_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dosen_keluarga`
--

CREATE TABLE `dosen_keluarga` (
  `id` int(11) NOT NULL,
  `row_status` enum('active','deleted','notactive','') NOT NULL,
  `dosen_id` int(11) NOT NULL,
  `status_pernikahan` enum('Belum Menikah','Sudah Menikah','Janda','Duda') NOT NULL,
  `nama_pasangan` varchar(250) NOT NULL,
  `nip_pasangan` varchar(100) NOT NULL,
  `tmt_pns` varchar(250) NOT NULL,
  `pekerjaan` varchar(250) NOT NULL,
  `created_by` varchar(250) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_by` varchar(250) NOT NULL,
  `modified_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dosen_penugasan`
--

CREATE TABLE `dosen_penugasan` (
  `id` int(11) NOT NULL,
  `row_status` enum('active','deleted','notactive','') NOT NULL,
  `dosen_id` int(11) NOT NULL,
  `tahun_ajaran` varchar(50) NOT NULL,
  `program_studi_id` int(11) NOT NULL,
  `no_surat_tugas` varchar(250) NOT NULL,
  `tanggal_surat_tugas` date NOT NULL,
  `home_base` bit(1) NOT NULL,
  `created_by` varchar(250) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_by` varchar(250) NOT NULL,
  `modified_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dosen_riwayat_fungsional`
--

CREATE TABLE `dosen_riwayat_fungsional` (
  `id` int(11) NOT NULL,
  `row_status` enum('active','deleted','notactive','') NOT NULL,
  `dosen_id` int(11) NOT NULL,
  `jabatan` varchar(250) NOT NULL,
  `sk_jabatan` varchar(250) NOT NULL,
  `tmt_jabatan` date NOT NULL,
  `created_by` varchar(250) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_by` varchar(250) NOT NULL,
  `modified_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dosen_riwayat_kepangkatan`
--

CREATE TABLE `dosen_riwayat_kepangkatan` (
  `id` int(11) NOT NULL,
  `row_status` enum('active','deleted','notactive','') NOT NULL,
  `dosen_id` int(11) NOT NULL,
  `pangkat` varchar(250) NOT NULL,
  `sk_pangkat` varchar(250) NOT NULL,
  `tanggal_sk_pangkat` date NOT NULL,
  `tmt_sk_pangkat` date NOT NULL,
  `masa_kerja` varchar(50) NOT NULL,
  `created_by` varchar(250) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_by` varchar(250) NOT NULL,
  `modified_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dosen_riwayat_pendidikan`
--

CREATE TABLE `dosen_riwayat_pendidikan` (
  `id` int(11) NOT NULL,
  `row_status` enum('active','deleted','notactive','') NOT NULL,
  `dosen_id` int(11) NOT NULL,
  `bidang_studi` varchar(250) NOT NULL,
  `jenjang` varchar(50) NOT NULL,
  `gelar` varchar(50) NOT NULL,
  `perguruan_tinggi` varchar(500) NOT NULL,
  `fakultas` varchar(250) NOT NULL,
  `tahun_lulus` varchar(100) NOT NULL,
  `sks` int(11) NOT NULL,
  `ipk` varchar(50) NOT NULL,
  `created_by` varchar(250) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_by` varchar(250) NOT NULL,
  `modified_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dosen_riwayat_penelitian`
--

CREATE TABLE `dosen_riwayat_penelitian` (
  `id` int(11) NOT NULL,
  `row_status` enum('active','deleted','notactive','') NOT NULL,
  `dosen_id` int(11) NOT NULL,
  `judul_penelitian` varchar(500) NOT NULL,
  `bidang_ilmu` varchar(250) NOT NULL,
  `lembaga` varchar(250) NOT NULL,
  `tahun` varchar(50) NOT NULL,
  `created_by` varchar(250) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_by` varchar(250) NOT NULL,
  `modified_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dosen_riwayat_sertifikasi`
--

CREATE TABLE `dosen_riwayat_sertifikasi` (
  `id` int(11) NOT NULL,
  `row_status` enum('active','deleted','notactive','') NOT NULL,
  `dosen_id` int(11) NOT NULL,
  `nomor` varchar(250) NOT NULL,
  `bidang_studi` varchar(250) NOT NULL,
  `jenis_sertifikasi` varchar(250) NOT NULL,
  `tahun_sertifikasi` varchar(50) NOT NULL,
  `no_sk_sertifikasi` varchar(250) NOT NULL,
  `created_by` varchar(250) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_by` varchar(250) NOT NULL,
  `modified_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kelas_perkuliahan`
--

CREATE TABLE `kelas_perkuliahan` (
  `id` int(11) NOT NULL,
  `row_status` enum('active','deleted','notactive','') NOT NULL,
  `program_studi_id` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL,
  `mata_kuliah_id` int(11) NOT NULL,
  `kelas_id` int(11) NOT NULL,
  `pembahasan` varchar(500) NOT NULL,
  `tanggal_efektif` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `tanggal_akhir_efektif` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` varchar(250) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_by` varchar(250) NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kurikulum`
--

CREATE TABLE `kurikulum` (
  `id` int(11) NOT NULL,
  `row_status` enum('active','deleted','notactive','') NOT NULL,
  `nama_kurikulum` varchar(500) NOT NULL,
  `program_studi_id` int(11) NOT NULL,
  `mulai_berlaku` varchar(100) NOT NULL,
  `jumlah_sks` int(11) NOT NULL,
  `jumlah_bobot_mata_kuliah_wajib` int(11) NOT NULL,
  `jumlah_bobot_mata_kuliah_pilihan` int(11) NOT NULL,
  `created_by` varchar(250) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_by` varchar(250) NOT NULL,
  `modified_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kurikulum_mata_kuliah`
--

CREATE TABLE `kurikulum_mata_kuliah` (
  `id` int(11) NOT NULL,
  `row_status` enum('active','deleted','notactive','') NOT NULL,
  `mata_kuliah_id` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `is_wajib` bit(1) NOT NULL,
  `created_by` varchar(250) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_by` varchar(250) NOT NULL,
  `modified_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` int(11) NOT NULL,
  `row_status` enum('active','deleted','notactive','') NOT NULL,
  `nama` varchar(500) NOT NULL,
  `nama_ibu` varchar(255) NOT NULL,
  `password` varchar(250) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `nisn` varchar(20) NOT NULL,
  `nim` varchar(100) NOT NULL,
  `npwp` varchar(20) NOT NULL,
  `email` varchar(250) NOT NULL,
  `jk` enum('laki-laki','perempuan','','') NOT NULL,
  `agama` enum('islam','protestan','katolik','hindu','budha','khonghucu') NOT NULL,
  `tempat_lahir` varchar(250) NOT NULL,
  `tangal_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `dusun` varchar(250) NOT NULL,
  `kelurahan` varchar(250) NOT NULL,
  `kecamatan` varchar(250) NOT NULL,
  `rt` varchar(20) NOT NULL,
  `rw` varchar(20) NOT NULL,
  `kode_pos` varchar(20) NOT NULL,
  `jenis_tinggal` varchar(200) NOT NULL,
  `is_penerima_kps` tinyint(1) NOT NULL,
  `no_kps` varchar(100) NOT NULL,
  `kewarganegaraan` int(250) NOT NULL,
  `no_telepon` varchar(50) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `alat_transportasi` varchar(250) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` varchar(250) NOT NULL,
  `modified_date` datetime NOT NULL,
  `modified_by` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa_orang_tua`
--

CREATE TABLE `mahasiswa_orang_tua` (
  `id` int(11) NOT NULL,
  `row_status` enum('active','notactive','deleted','') NOT NULL,
  `mahasiswa_id` int(11) NOT NULL,
  `pendidikan_id` int(11) NOT NULL,
  `kategori` enum('ayah','ibu','wali','') NOT NULL,
  `nik` varchar(20) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `tempat_lahir` varchar(250) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `penghasilan` varchar(200) NOT NULL,
  `created_by` varchar(250) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_by` varchar(250) NOT NULL,
  `modified_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa_orang_tua_wali`
--

CREATE TABLE `mahasiswa_orang_tua_wali` (
  `id` int(11) NOT NULL,
  `row_status` enum('active','notactive','deleted','') NOT NULL,
  `mahasiswa_id` int(11) NOT NULL,
  `pendidikan_id` int(11) NOT NULL,
  `kategori` enum('ayah','ibu','wali','') NOT NULL,
  `nik` varchar(20) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `tempat_lahir` varchar(250) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `penghasilan` varchar(200) NOT NULL,
  `created_by` varchar(250) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_by` varchar(250) NOT NULL,
  `modified_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa_pendidikan`
--

CREATE TABLE `mahasiswa_pendidikan` (
  `id` int(11) NOT NULL,
  `row_status` enum('active','notactive','deleted','') NOT NULL,
  `mahasiswa_id` int(11) NOT NULL,
  `jenis_pendaftaran_id` int(11) NOT NULL,
  `periode` varchar(200) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `program_studi_id` int(11) NOT NULL,
  `created_by` varchar(250) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_by` varchar(250) NOT NULL,
  `modified_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `master_agama`
--

CREATE TABLE `master_agama` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('enabled','disabled','','') COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `master_agama`
--

INSERT INTO `master_agama` (`id`, `title`, `status`, `updated_at`, `created_at`, `created_by`, `updated_by`) VALUES
(2, 'Kristen', 'enabled', '2019-10-16 09:11:09', '2019-10-16 09:11:09', NULL, NULL),
(3, 'Islam', 'enabled', '2019-10-16 09:11:20', '2019-10-16 09:11:20', NULL, NULL),
(4, 'Katolik', 'enabled', '2019-10-16 09:11:28', '2019-10-16 09:11:28', NULL, NULL),
(5, 'Hindu', 'enabled', '2019-10-16 09:11:35', '2019-10-16 09:11:35', NULL, NULL),
(6, 'Budha', 'enabled', '2019-10-16 09:11:40', '2019-10-16 09:11:40', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `master_alat_transportasi`
--

CREATE TABLE `master_alat_transportasi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `row_status` enum('active','deleted','notactive') COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `update_by` timestamp NULL DEFAULT NULL,
  `created_by` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `master_alat_transportasi`
--

INSERT INTO `master_alat_transportasi` (`id`, `title`, `row_status`, `updated_at`, `created_at`, `update_by`, `created_by`) VALUES
(1, 'Angkutan Umum/Bus/Pete-pete', 'active', '2019-10-20 00:34:27', '2019-10-20 00:34:27', NULL, NULL),
(2, 'Kerete Api', 'active', '2019-10-20 00:34:56', '2019-10-20 00:34:56', NULL, NULL),
(3, 'Ojek', 'active', '2019-10-20 00:35:02', '2019-10-20 00:35:02', NULL, NULL),
(4, 'Mobil/Bus antar jempt', 'active', '2019-10-20 00:35:28', '2019-10-20 00:35:28', NULL, NULL),
(5, 'Sepeda Motor', 'active', '2019-10-20 00:35:47', '2019-10-20 00:35:47', NULL, NULL),
(6, 'Sepeda', 'active', '2019-10-20 00:35:56', '2019-10-20 00:35:56', NULL, NULL),
(7, 'Andong/bendi/sado/dokar/delman/becak', 'active', '2019-10-20 00:36:38', '2019-10-20 00:36:38', NULL, NULL),
(8, 'Mobil pribadi', 'active', '2019-10-20 00:36:52', '2019-10-20 00:36:52', NULL, NULL),
(9, 'Kuda', 'active', '2019-10-20 00:36:58', '2019-10-20 00:36:58', NULL, NULL),
(10, 'Lainnya', 'active', '2019-10-20 00:37:03', '2019-10-20 00:37:03', NULL, NULL),
(11, 'Perahu penyeberangan/rakit/getek', 'active', '2019-10-20 00:37:17', '2019-10-20 00:37:17', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `master_jenis_kelamin`
--

CREATE TABLE `master_jenis_kelamin` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `master_jenis_kelamin`
--

INSERT INTO `master_jenis_kelamin` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'Laki-Laki', '2019-10-17 00:15:37', '2019-10-17 00:15:37'),
(2, 'Perempuan', '2019-10-17 00:15:55', '2019-10-17 00:15:55');

-- --------------------------------------------------------

--
-- Table structure for table `master_jenis_tinggal`
--

CREATE TABLE `master_jenis_tinggal` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `row_status` enum('active','deleted','notactive') COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `update_by` timestamp NULL DEFAULT NULL,
  `created_by` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `master_jenis_tinggal`
--

INSERT INTO `master_jenis_tinggal` (`id`, `title`, `row_status`, `updated_at`, `created_at`, `update_by`, `created_by`) VALUES
(1, 'Bersama Orang Tua', 'active', '2019-10-19 23:42:57', '2019-10-19 23:42:57', NULL, NULL),
(2, 'Wali', 'active', '2019-10-20 00:09:41', '2019-10-20 00:09:41', NULL, NULL),
(3, 'Kost', 'active', '2019-10-20 00:09:47', '2019-10-20 00:09:47', NULL, NULL),
(4, 'Asrama', 'active', '2019-10-20 00:10:45', '2019-10-20 00:10:45', NULL, NULL),
(5, 'Panti Asuhan', 'active', '2019-10-20 00:10:55', '2019-10-20 00:10:55', NULL, NULL),
(6, 'Lainnya', 'active', '2019-10-20 00:11:03', '2019-10-20 00:11:03', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `master_kebutuhan_khusus`
--

CREATE TABLE `master_kebutuhan_khusus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `row_status` enum('active','deleted','notactive') COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `update_by` timestamp NULL DEFAULT NULL,
  `created_by` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `master_kebutuhan_khusus`
--

INSERT INTO `master_kebutuhan_khusus` (`id`, `title`, `row_status`, `updated_at`, `created_at`, `update_by`, `created_by`) VALUES
(1, 'A - Tuna netra', 'active', '2019-10-20 06:11:15', '2019-10-20 06:11:15', NULL, NULL),
(2, 'B - Tuna rungu', 'active', '2019-10-20 06:11:28', '2019-10-20 06:11:28', NULL, NULL),
(3, 'C - Tuna grahita ringan', 'active', '2019-10-20 06:11:39', '2019-10-20 06:11:39', NULL, NULL),
(4, 'C1 - Tuna grahita ringan', 'active', '2019-10-20 06:11:50', '2019-10-20 06:11:50', NULL, NULL),
(5, 'D - Tuna daksa ringan', 'active', '2019-10-20 06:11:58', '2019-10-20 06:11:58', NULL, NULL),
(6, 'D1 - Tuna daksa sedang', 'active', '2019-10-20 06:12:07', '2019-10-20 06:12:07', NULL, NULL),
(7, 'E - Tuna laras', 'active', '2019-10-20 06:12:16', '2019-10-20 06:12:16', NULL, NULL),
(8, 'F - Tuna wicara', 'active', '2019-10-20 06:12:27', '2019-10-20 06:12:27', NULL, NULL),
(9, 'H - Hiperaktif', 'active', '2019-10-20 06:12:39', '2019-10-20 06:12:39', NULL, NULL),
(10, 'I - Cerdas Istimewa', 'active', '2019-10-20 06:12:48', '2019-10-20 06:12:48', NULL, NULL),
(11, 'J - Bakat Istimewa', 'active', '2019-10-20 06:12:56', '2019-10-20 06:12:56', NULL, NULL),
(12, 'K - Kesulitan Belajar', 'active', '2019-10-20 06:13:04', '2019-10-20 06:13:04', NULL, NULL),
(13, 'N - Narkoba', 'active', '2019-10-20 06:13:14', '2019-10-20 06:13:14', NULL, NULL),
(14, 'O - Indigo', 'active', '2019-10-20 06:13:22', '2019-10-20 06:13:22', NULL, NULL),
(15, 'P - Down Syndrome', 'active', '2019-10-20 06:13:31', '2019-10-20 06:13:31', NULL, NULL),
(16, 'Q - Autis', 'active', '2019-10-20 06:13:40', '2019-10-20 06:13:40', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `master_pekerjaan`
--

CREATE TABLE `master_pekerjaan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `row_status` enum('active','deleted','notactive') COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `update_by` timestamp NULL DEFAULT NULL,
  `created_by` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `master_pekerjaan`
--

INSERT INTO `master_pekerjaan` (`id`, `title`, `row_status`, `updated_at`, `created_at`, `update_by`, `created_by`) VALUES
(1, 'Tidak bekerja', 'active', '2019-10-20 00:59:48', '2019-10-20 00:59:48', NULL, NULL),
(2, 'Nelayan', 'active', '2019-10-20 00:59:59', '2019-10-20 00:59:59', NULL, NULL),
(3, 'Petani', 'active', '2019-10-20 01:00:07', '2019-10-20 01:00:07', NULL, NULL),
(4, 'Peternak', 'active', '2019-10-20 01:00:14', '2019-10-20 01:00:14', NULL, NULL),
(5, 'PNS/TNI/Polri', 'active', '2019-10-20 01:00:32', '2019-10-20 01:00:32', NULL, NULL),
(6, 'Karyawan Swasta', 'active', '2019-10-20 01:00:41', '2019-10-20 01:00:41', NULL, NULL),
(7, 'Pedagang Kecil', 'active', '2019-10-20 01:00:50', '2019-10-20 01:00:50', NULL, NULL),
(8, 'Pedagang Besar', 'active', '2019-10-20 01:00:58', '2019-10-20 01:00:58', NULL, NULL),
(9, 'Wiraswasta', 'active', '2019-10-20 01:01:05', '2019-10-20 01:01:05', NULL, NULL),
(10, 'Wirausaha', 'active', '2019-10-20 01:01:12', '2019-10-20 01:01:12', NULL, NULL),
(11, 'Buruh', 'active', '2019-10-20 01:01:19', '2019-10-20 01:01:19', NULL, NULL),
(12, 'Pensiunan', 'active', '2019-10-20 01:01:25', '2019-10-20 01:01:25', NULL, NULL),
(13, 'Sudah Meninggal', 'active', '2019-10-20 01:01:33', '2019-10-20 01:01:33', NULL, NULL),
(14, 'Lainnya', 'active', '2019-10-20 01:01:40', '2019-10-20 01:01:40', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `master_pendidikan`
--

CREATE TABLE `master_pendidikan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `row_status` enum('active','deleted','notactive') COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `update_by` timestamp NULL DEFAULT NULL,
  `created_by` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `master_pendidikan`
--

INSERT INTO `master_pendidikan` (`id`, `title`, `row_status`, `updated_at`, `created_at`, `update_by`, `created_by`) VALUES
(1, 'Tidak sekolah', 'active', '2019-10-20 01:08:17', '2019-10-20 01:08:17', NULL, NULL),
(2, 'PAUD', 'active', '2019-10-20 01:08:24', '2019-10-20 01:08:24', NULL, NULL),
(3, 'TK / sederajat', 'active', '2019-10-20 01:08:31', '2019-10-20 01:08:31', NULL, NULL),
(4, 'Putus SD', 'active', '2019-10-20 01:08:41', '2019-10-20 01:08:41', NULL, NULL),
(5, 'SD / sederajat', 'active', '2019-10-20 01:08:50', '2019-10-20 01:08:50', NULL, NULL),
(6, 'SMP / sederajat', 'active', '2019-10-20 01:09:02', '2019-10-20 01:09:02', NULL, NULL),
(7, 'SMA / sederajat', 'active', '2019-10-20 01:09:10', '2019-10-20 01:09:10', NULL, NULL),
(8, 'Paket A', 'active', '2019-10-20 01:09:18', '2019-10-20 01:09:18', NULL, NULL),
(9, 'Paket B', 'active', '2019-10-20 01:09:23', '2019-10-20 01:09:23', NULL, NULL),
(10, 'Paket C', 'active', '2019-10-20 01:09:27', '2019-10-20 01:09:27', NULL, NULL),
(11, 'D1', 'active', '2019-10-20 01:09:41', '2019-10-20 01:09:41', NULL, NULL),
(12, 'D2', 'active', '2019-10-20 01:09:45', '2019-10-20 01:09:45', NULL, NULL),
(13, 'D3', 'active', '2019-10-20 01:09:51', '2019-10-20 01:09:51', NULL, NULL),
(14, 'D4', 'active', '2019-10-20 01:09:56', '2019-10-20 01:09:56', NULL, NULL),
(15, 'S1', 'active', '2019-10-20 01:10:06', '2019-10-20 01:10:06', NULL, NULL),
(16, 'Profesi', 'active', '2019-10-20 01:10:13', '2019-10-20 01:10:13', NULL, NULL),
(17, 'Sp - 1', 'active', '2019-10-20 01:10:27', '2019-10-20 01:10:27', NULL, NULL),
(18, 'S2', 'active', '2019-10-20 01:10:39', '2019-10-20 01:10:39', NULL, NULL),
(19, 'S2 Terapan', 'active', '2019-10-20 01:10:53', '2019-10-20 01:10:53', NULL, NULL),
(20, 'Sp-2', 'active', '2019-10-20 01:11:07', '2019-10-20 01:11:07', NULL, NULL),
(21, 'S3', 'active', '2019-10-20 01:11:33', '2019-10-20 01:11:33', NULL, NULL),
(22, 'S3 terapan', 'active', '2019-10-20 01:11:45', '2019-10-20 01:11:45', NULL, NULL),
(23, 'Nonformal', 'active', '2019-10-20 01:11:57', '2019-10-20 01:11:57', NULL, NULL),
(24, 'Informal', 'active', '2019-10-20 01:12:07', '2019-10-20 01:12:07', NULL, NULL),
(25, 'Lainnya', 'active', '2019-10-20 01:12:12', '2019-10-20 01:12:12', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `master_penghasilan`
--

CREATE TABLE `master_penghasilan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `row_status` enum('active','deleted','notactive') COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `update_by` timestamp NULL DEFAULT NULL,
  `created_by` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `master_penghasilan`
--

INSERT INTO `master_penghasilan` (`id`, `title`, `row_status`, `updated_at`, `created_at`, `update_by`, `created_by`) VALUES
(1, 'Kurang dari Rp. 500,000', 'active', '2019-10-20 01:51:01', '2019-10-20 01:51:01', NULL, NULL),
(2, 'Rp. 500,000 - Rp. 999,999', 'active', '2019-10-20 01:51:13', '2019-10-20 01:51:13', NULL, NULL),
(3, 'Rp. 1,000,000 - Rp. 1,999,999', 'active', '2019-10-20 01:51:21', '2019-10-20 01:51:21', NULL, NULL),
(4, 'Rp. 2,000,000 - Rp. 4,999,999', 'active', '2019-10-20 01:51:31', '2019-10-20 01:51:31', NULL, NULL),
(5, 'Rp. 5,000,000 - Rp. 20,000,000', 'active', '2019-10-20 01:51:40', '2019-10-20 01:51:40', NULL, NULL),
(6, 'Lebih dari Rp. 20,000,000', 'active', '2019-10-20 01:51:49', '2019-10-20 01:51:49', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mata_kuliah`
--

CREATE TABLE `mata_kuliah` (
  `id` int(11) NOT NULL,
  `row_status` enum('active','deleted','notactive','') NOT NULL,
  `kode_mata_kuliah` varchar(50) NOT NULL,
  `nama_mata_kuliah` varchar(500) NOT NULL,
  `program_studi_id` int(11) NOT NULL,
  `jenis_mata_kuliah_id` int(11) NOT NULL,
  `bobot_mata_kuliah` int(11) NOT NULL,
  `bobot_tatap_muka` int(11) NOT NULL,
  `bobot_praktikum` int(11) NOT NULL,
  `bobot_praktek_lapangan` int(11) NOT NULL,
  `bobot_simulasi` int(11) NOT NULL,
  `metode_pembelajaran` varchar(500) NOT NULL,
  `tanggal_mulai_efektif` date NOT NULL,
  `taggal_akhir_efektif` date NOT NULL,
  `created_by` varchar(250) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_by` varchar(250) NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mata_kuliah`
--

INSERT INTO `mata_kuliah` (`id`, `row_status`, `kode_mata_kuliah`, `nama_mata_kuliah`, `program_studi_id`, `jenis_mata_kuliah_id`, `bobot_mata_kuliah`, `bobot_tatap_muka`, `bobot_praktikum`, `bobot_praktek_lapangan`, `bobot_simulasi`, `metode_pembelajaran`, `tanggal_mulai_efektif`, `taggal_akhir_efektif`, `created_by`, `created_at`, `modified_by`, `updated_at`) VALUES
(2, 'active', 'P0000', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:23:40', '1', '2019-10-19 07:23:40'),
(3, 'active', 'P0001', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:23:40', '1', '2019-10-19 07:23:40'),
(4, 'active', 'P0002', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:23:40', '1', '2019-10-19 07:23:40'),
(5, 'active', 'P0003', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:23:40', '1', '2019-10-19 07:23:40'),
(6, 'active', 'P0004', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:23:40', '1', '2019-10-19 07:23:40'),
(7, 'active', 'P0005', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:18', '1', '2019-10-19 07:24:18'),
(8, 'active', 'P0006', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(9, 'active', 'P0007', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(10, 'active', 'P0008', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(11, 'active', 'P0009', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(12, 'active', 'P00010', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(13, 'active', 'P00011', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(14, 'active', 'P00012', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(15, 'active', 'P00013', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(16, 'active', 'P00014', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(17, 'active', 'P00015', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(18, 'active', 'P00016', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(19, 'active', 'P00017', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(20, 'active', 'P00018', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(21, 'active', 'P00019', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(22, 'active', 'P00020', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(23, 'active', 'P00021', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(24, 'active', 'P00022', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(25, 'active', 'P00023', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(26, 'active', 'P00024', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(27, 'active', 'P00025', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(28, 'active', 'P00026', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(29, 'active', 'P00027', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(30, 'active', 'P00028', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(31, 'active', 'P00029', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(32, 'active', 'P00030', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(33, 'active', 'P00031', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(34, 'active', 'P00032', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(35, 'active', 'P00033', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(36, 'active', 'P00034', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(37, 'active', 'P00035', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(38, 'active', 'P00036', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(39, 'active', 'P00037', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(40, 'active', 'P00038', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(41, 'active', 'P00039', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(42, 'active', 'P00040', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(43, 'active', 'P00041', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(44, 'active', 'P00042', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(45, 'active', 'P00043', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(46, 'active', 'P00044', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(47, 'active', 'P00045', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(48, 'active', 'P00046', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(49, 'active', 'P00047', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(50, 'active', 'P00048', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(51, 'active', 'P00049', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(52, 'active', 'P00050', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(53, 'active', 'P00051', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(54, 'active', 'P00052', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(55, 'active', 'P00053', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(56, 'active', 'P00054', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(57, 'active', 'P00055', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(58, 'active', 'P00056', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(59, 'active', 'P00057', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(60, 'active', 'P00058', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(61, 'active', 'P00059', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(62, 'active', 'P00060', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(63, 'active', 'P00061', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(64, 'active', 'P00062', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(65, 'active', 'P00063', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(66, 'active', 'P00064', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(67, 'active', 'P00065', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(68, 'active', 'P00066', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(69, 'active', 'P00067', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(70, 'active', 'P00068', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(71, 'active', 'P00069', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(72, 'active', 'P00070', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(73, 'active', 'P00071', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(74, 'active', 'P00072', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(75, 'active', 'P00073', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(76, 'active', 'P00074', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(77, 'active', 'P00075', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(78, 'active', 'P00076', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(79, 'active', 'P00077', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(80, 'active', 'P00078', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(81, 'active', 'P00079', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(82, 'active', 'P00080', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(83, 'active', 'P00081', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(84, 'active', 'P00082', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(85, 'active', 'P00083', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(86, 'active', 'P00084', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(87, 'active', 'P00085', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(88, 'active', 'P00086', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(89, 'active', 'P00087', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(90, 'active', 'P00088', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(91, 'active', 'P00089', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(92, 'active', 'P00090', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(93, 'active', 'P00091', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(94, 'active', 'P00092', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(95, 'active', 'P00093', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(96, 'active', 'P00094', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(97, 'active', 'P00095', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(98, 'active', 'P00096', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(99, 'active', 'P00097', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(100, 'active', 'P00098', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19'),
(101, 'active', 'P00099', 'Mata Kuliah 1', 1, 1, 10, 20, 30, 10, 10, 'Tatap Muka', '2019-10-19', '2019-10-19', '1', '2019-10-19 07:24:19', '1', '2019-10-19 07:24:19');

-- --------------------------------------------------------

--
-- Table structure for table `mata_kuliah_jenis`
--

CREATE TABLE `mata_kuliah_jenis` (
  `id` int(11) NOT NULL,
  `row_status` enum('active','deleted','notactive','') NOT NULL,
  `nama_jenis_mata_kuliah` varchar(250) NOT NULL,
  `created_by` varchar(250) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_by` varchar(250) NOT NULL,
  `modified_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` set('active','delete') COLLATE utf8mb4_unicode_ci NOT NULL,
  `createdby` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(15, '2014_10_12_100000_create_password_resets_table', 1),
(22, '2019_10_16_153436_create_master_agama2', 2),
(23, '2019_10_17_061549_create_master_jenis_kelamin', 3),
(24, '2019_10_20_061853_create_master_jenis_tinggal', 4),
(26, '2019_10_20_071821_create_master_alat_transportasi', 5),
(27, '2019_10_20_075209_create_master_pekerjaan', 6),
(28, '2019_10_20_080642_create_master_pendidikan', 7),
(29, '2019_10_20_084829_create_master_penghasilan', 8),
(30, '2019_10_20_130919_create_master_kebutuhan_khusus', 9);

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

CREATE TABLE `module` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `link` varchar(200) NOT NULL,
  `mval` varchar(100) NOT NULL,
  `description` varchar(200) NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `create_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`id`, `title`, `link`, `mval`, `description`, `status`, `updated_at`, `created_at`, `create_by`) VALUES
(19, 'Master_Agama', 'Master/Agama', 'Agama', 'Master Agama', 1, '2019-10-20 08:35:59', '2019-10-16 00:24:56', NULL),
(20, 'Master_JenisKelamin', 'Master/JenisKelamin', 'JenisKelamin', 'Jenis Kelamin', 0, '2019-10-20 08:34:31', '2019-10-16 23:14:01', NULL),
(22, 'Master_MataKuliah', 'Master/MataKuliah', 'MataKuliah', 'MataKuliah', 1, '2019-10-20 08:36:04', '2019-10-17 01:23:41', NULL),
(23, 'Master_Jenis_Tinggal', 'Master/Jenis/Tinggal', 'Tinggal', 'Jenis Tinggal', 1, '2019-10-20 08:36:10', '2019-10-19 23:07:52', NULL),
(24, 'Master_AlatTransportasi', 'Master/AlatTransportasi', 'AlatTransportasi', 'Master Alat Transportasi', 1, '2019-10-20 08:36:12', '2019-10-20 00:13:21', NULL),
(25, 'Master_Pekerjaan', 'Master/Pekerjaan', 'Pekerjaan', 'Master Pekerjaan', 1, '2019-10-20 08:36:15', '2019-10-20 00:48:40', NULL),
(26, 'Master_Pendidikan', 'Master/Pendidikan', 'Pendidikan', 'Master Pekerjaan', 1, '2019-10-20 08:36:17', '2019-10-20 01:04:46', NULL),
(27, 'Master_Penghasilan', 'Master/Penghasilan', 'Penghasilan', 'Master Penghasilan', 1, '2019-10-20 08:50:02', '2019-10-20 01:42:35', NULL),
(28, 'Master_KebutuhanKhusus', 'Master/KebutuhanKhusus', 'KebutuhanKhusus', 'Kebutuhan Khusus', 1, '2019-10-20 13:10:31', '2019-10-20 06:07:08', NULL),
(29, 'Data_Mahasiswa', 'Data/Mahasiswa', 'Mahasiswa', 'Data Mahasiswa', NULL, '2019-10-20 06:19:52', '2019-10-20 06:19:52', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `program_studi`
--

CREATE TABLE `program_studi` (
  `id` int(11) NOT NULL,
  `row_status` enum('active','deleted','notactive','') NOT NULL,
  `kode_program_studi` varchar(50) NOT NULL,
  `nama_program_studi` varchar(500) NOT NULL,
  `created_by` varchar(250) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_by` varchar(250) NOT NULL,
  `modified_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `substansi_kuliah`
--

CREATE TABLE `substansi_kuliah` (
  `id` int(11) NOT NULL,
  `row_status` enum('active','deleted','notactive','') NOT NULL,
  `kode_mata_kuliah` varchar(50) NOT NULL,
  `nama_mata_kuliah` varchar(500) NOT NULL,
  `program_studi_id` int(11) NOT NULL,
  `bobot_mata_kuliah` int(11) NOT NULL,
  `bobot_tatap_muka` int(11) NOT NULL,
  `bobot_praktikum` int(11) NOT NULL,
  `bobot_praktek_lapangan` int(11) NOT NULL,
  `bobot_simulasi` int(11) NOT NULL,
  `created_by` varchar(250) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_by` varchar(250) NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Cashtree`
--
ALTER TABLE `Cashtree`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dosen_keluarga`
--
ALTER TABLE `dosen_keluarga`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dosen_id` (`dosen_id`);

--
-- Indexes for table `dosen_penugasan`
--
ALTER TABLE `dosen_penugasan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dosen_id` (`dosen_id`);

--
-- Indexes for table `dosen_riwayat_fungsional`
--
ALTER TABLE `dosen_riwayat_fungsional`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dosen_id` (`dosen_id`);

--
-- Indexes for table `dosen_riwayat_kepangkatan`
--
ALTER TABLE `dosen_riwayat_kepangkatan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dosen_id` (`dosen_id`);

--
-- Indexes for table `dosen_riwayat_pendidikan`
--
ALTER TABLE `dosen_riwayat_pendidikan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dosen_id` (`dosen_id`);

--
-- Indexes for table `dosen_riwayat_penelitian`
--
ALTER TABLE `dosen_riwayat_penelitian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dosen_id` (`dosen_id`);

--
-- Indexes for table `dosen_riwayat_sertifikasi`
--
ALTER TABLE `dosen_riwayat_sertifikasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dosen_id` (`dosen_id`);

--
-- Indexes for table `kelas_perkuliahan`
--
ALTER TABLE `kelas_perkuliahan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `program_studi_id` (`program_studi_id`);

--
-- Indexes for table `kurikulum`
--
ALTER TABLE `kurikulum`
  ADD PRIMARY KEY (`id`),
  ADD KEY `program_studi_id` (`program_studi_id`);

--
-- Indexes for table `kurikulum_mata_kuliah`
--
ALTER TABLE `kurikulum_mata_kuliah`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mata_kuliah_id` (`mata_kuliah_id`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mahasiswa_orang_tua_wali`
--
ALTER TABLE `mahasiswa_orang_tua_wali`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mahasiswa_pendidikan`
--
ALTER TABLE `mahasiswa_pendidikan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_agama`
--
ALTER TABLE `master_agama`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_alat_transportasi`
--
ALTER TABLE `master_alat_transportasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_jenis_kelamin`
--
ALTER TABLE `master_jenis_kelamin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_jenis_tinggal`
--
ALTER TABLE `master_jenis_tinggal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_kebutuhan_khusus`
--
ALTER TABLE `master_kebutuhan_khusus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_pekerjaan`
--
ALTER TABLE `master_pekerjaan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_pendidikan`
--
ALTER TABLE `master_pendidikan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_penghasilan`
--
ALTER TABLE `master_penghasilan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  ADD PRIMARY KEY (`id`),
  ADD KEY `program_studi_id` (`program_studi_id`),
  ADD KEY `jenis_mata_kuliah_id` (`jenis_mata_kuliah_id`);

--
-- Indexes for table `mata_kuliah_jenis`
--
ALTER TABLE `mata_kuliah_jenis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `program_studi`
--
ALTER TABLE `program_studi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `substansi_kuliah`
--
ALTER TABLE `substansi_kuliah`
  ADD PRIMARY KEY (`id`),
  ADD KEY `program_studi_id` (`program_studi_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Cashtree`
--
ALTER TABLE `Cashtree`
  MODIFY `name` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dosen`
--
ALTER TABLE `dosen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dosen_keluarga`
--
ALTER TABLE `dosen_keluarga`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dosen_penugasan`
--
ALTER TABLE `dosen_penugasan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dosen_riwayat_fungsional`
--
ALTER TABLE `dosen_riwayat_fungsional`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dosen_riwayat_kepangkatan`
--
ALTER TABLE `dosen_riwayat_kepangkatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dosen_riwayat_pendidikan`
--
ALTER TABLE `dosen_riwayat_pendidikan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dosen_riwayat_penelitian`
--
ALTER TABLE `dosen_riwayat_penelitian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dosen_riwayat_sertifikasi`
--
ALTER TABLE `dosen_riwayat_sertifikasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kurikulum`
--
ALTER TABLE `kurikulum`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kurikulum_mata_kuliah`
--
ALTER TABLE `kurikulum_mata_kuliah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `master_agama`
--
ALTER TABLE `master_agama`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `master_alat_transportasi`
--
ALTER TABLE `master_alat_transportasi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `master_jenis_kelamin`
--
ALTER TABLE `master_jenis_kelamin`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `master_jenis_tinggal`
--
ALTER TABLE `master_jenis_tinggal`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `master_kebutuhan_khusus`
--
ALTER TABLE `master_kebutuhan_khusus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `master_pekerjaan`
--
ALTER TABLE `master_pekerjaan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `master_pendidikan`
--
ALTER TABLE `master_pendidikan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `master_penghasilan`
--
ALTER TABLE `master_penghasilan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `module`
--
ALTER TABLE `module`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
