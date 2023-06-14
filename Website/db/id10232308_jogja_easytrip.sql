-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 25, 2019 at 03:47 AM
-- Server version: 10.3.16-MariaDB
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
-- Database: `id10232308_jogja_easytrip`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nama_admin` varchar(50) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `no_tlp` varchar(13) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama_admin`, `username`, `password`, `no_tlp`, `email`) VALUES
(1, 'admin', 'admin', 'admin', '0856668781', 'admin@email.com'),
(2, 'syarif', 'mshid', 'mshid09', '082220663250', 'syarif.nubageur@gmail.com'),
(3, 'abdul', 'abdul', 'abdul', '082224432243', 'abdul@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `gamhotel`
--

CREATE TABLE `gamhotel` (
  `id_gamhotel` int(11) NOT NULL,
  `id_hotel` int(11) NOT NULL,
  `gambar` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gamhotel`
--

INSERT INTO `gamhotel` (`id_gamhotel`, `id_hotel`, `gambar`) VALUES
(1, 1, 'Soto Pak Sholeh _Al-Barokah_.jpg'),
(2, 1, 'Soto Pak Sholeh _Al-Barokah_.jpg'),
(3, 1, 'default.jpg'),
(4, 1, 'default.jpg'),
(5, 1, 'default.jpg'),
(6, 1, 'default.jpg'),
(7, 1, 'default.jpg'),
(8, 1, 'default.jpg'),
(9, 1, 'default.jpg'),
(10, 1, 'default.jpg'),
(11, 1, 'default.jpg'),
(12, 1, 'default.jpg'),
(13, 1, 'default.jpg'),
(14, 1, 'default.jpg'),
(15, 1, 'default.jpg'),
(16, 1, 'default.jpg'),
(17, 1, 'default.jpg'),
(18, 1, 'default.jpg'),
(19, 1, 'default.jpg'),
(20, 1, 'default.jpg'),
(21, 1, 'default.jpg'),
(22, 1, 'default.jpg'),
(23, 1, 'default.jpg'),
(24, 1, 'default.jpg'),
(25, 1, 'default.jpg'),
(26, 1, 'default.jpg'),
(27, 1, 'default.jpg'),
(28, 1, 'default.jpg'),
(29, 1, 'default.jpg'),
(30, 1, 'default.jpg'),
(31, 1, 'default.jpg'),
(32, 1, 'default.jpg'),
(33, 1, 'default.jpg'),
(34, 1, 'default.jpg'),
(35, 1, 'default.jpg'),
(36, 1, 'default.jpg'),
(37, 1, 'default.jpg'),
(38, 1, 'default.jpg'),
(39, 1, 'default.jpg'),
(40, 1, 'default.jpg'),
(41, 1, 'default.jpg'),
(42, 1, 'default.jpg'),
(43, 1, 'default.jpg'),
(44, 1, 'default.jpg'),
(45, 1, 'default.jpg'),
(46, 1, 'default.jpg'),
(47, 1, 'default.jpg'),
(48, 1, 'default.jpg'),
(49, 1, 'default.jpg'),
(50, 1, 'default.jpg'),
(51, 1, 'default.jpg'),
(52, 1, 'default.jpg'),
(53, 1, 'default.jpg'),
(54, 1, 'default.jpg'),
(55, 1, 'default.jpg'),
(56, 1, 'default.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `gamkuliner`
--

CREATE TABLE `gamkuliner` (
  `id_gamkuliner` int(11) NOT NULL,
  `id_tpkuliner` int(11) NOT NULL,
  `gambar` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gamwisata`
--

CREATE TABLE `gamwisata` (
  `id_gamwisata` int(11) NOT NULL,
  `id_tpwisata` int(11) NOT NULL,
  `gambar` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hotel`
--

CREATE TABLE `hotel` (
  `id_hotel` int(11) NOT NULL,
  `nama_hotel` varchar(50) NOT NULL,
  `id_kab` int(11) NOT NULL,
  `fasilitas` varchar(200) NOT NULL,
  `latitude` varchar(50) NOT NULL,
  `longitude` varchar(50) NOT NULL,
  `deskripsi` text NOT NULL,
  `alamat` text NOT NULL,
  `gambar` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hotel`
--

INSERT INTO `hotel` (`id_hotel`, `nama_hotel`, `id_kab`, `fasilitas`, `latitude`, `longitude`, `deskripsi`, `alamat`, `gambar`) VALUES
(1, 'Hotel Santika Premiere Jogja', 1, 'Wi-Fi gratis,  Sarapan gratis,  Parkir gratis,  Kolam renang luar,  AC dan Bak air panas', '-7.782484027066342', '110.36972834346864', 'http://www.santika.com/id/indonesia/jogja/hotel-santika-premiere-jogja/', 'Jl. Jend. Sudirman No.19, Cokrodiningratan, Kota Yogyakarta.', 'GH1.jpg'),
(2, 'Swiss-Belboutique Yogyakarta', 1, '8 Ruang Pertemuan, Kolam renang atap, Tamansari Puspa Spa, Lantai bebas asap rokok, Ruang ibadah, Wi-Fi, Area merokok.', '-7.782606604418081', '110.3742388132033', 'www.swiss-belboutiqueyogyakarta.com', 'Jl. Jend. Sudirman No.69, Terban, Kota Yogyakarta.', 'GH2.jpg'),
(3, 'ZEN Rooms Sudirman Yogyakarta', 1, 'WiFi Gratis, AC, Shower.', '-7.782588998459194', '110.3734237569389', 'https://www.zenrooms.com/id/city/yogyakarta', 'Jl. Jend. Sudirman No.63, Terban, Kota Yogyakarta.', 'GH3.jpg'),
(4, 'Hotel Citradream Yogyakarta', 1, 'Wifi, parkir gratis, AC.', '-7.780195245542721', '110.36766237197492', 'Nyaman dan bersih', 'Jl. AM. Sangaji No.28, Cokrodiningratan, Jetis, Kota Yogyakarta.', 'GH4.jpg'),
(5, 'The Atrium Hotel and Resort Yogyakarta', 1, ' Kolam dalam ruangan,  Layanan binatu  Layanan kamar,  Cocok untuk anak-anak,  Restoran,  Jemputan bandara.', '-7.747432079992451', '110.36001002965543', 'https://www.theatriumhotelandresort.com/', 'Jl. Kb. Agung No.20, Mlati Dukuh, Sendangadi, Daerah Istimewa Yogyakarta.', 'GH5.jpg'),
(6, 'The Rich Jogja Hotel', 1, 'Kabar AC, Wifi, Air Panas, parkir luas.', '-7.7524485072749725', '110.36120562432382', 'Nyaman, bersih dan ramah-ramah.', 'Jl. Magelang No.KM.6 No.18, Kutu Patran, Sinduadi, Kec. Mlati, Yogyakarta.', 'GH6.jpg'),
(7, 'Sunrise Hotel Jombor Yogyakarta', 1, 'Wifi, AC, Air Panas.', '-7.7560775727599465', '110.35973644433591', 'Murah dan ramah-ramah', 'Jalan Magelang KM 6.5, Sinduadi, Mlati, Jombor Lor, Sendangadi, Kec. Mlati, Yogyakarta.', 'GH7.jpg'),
(8, 'Borobudur Hotel Jombor Selatan', 1, 'Tv, Kipas angin, wifi', '-7.791455', '110.37415599999997', 'bersih nyaman', 'Jalan Magelang KM. 6,3, Sendangadi, Mlati, Mlati Dukuh, Sendangadi, Kec. Mlati, Yogyakarta.', 'GH8.jpg'),
(9, 'Hotel Tentram', 1, 'Ac, wifi, air panas, makan 1x', '-7.773583', '110.368646', 'hoteltentrem.com', 'Jl. P. Mangkubumi No.72A, Cokrodiningratan, Kec. Jetis, Kota Yogyakarta.', 'GH9.jpg'),
(10, 'Nariska Suite Homestay', 1, 'kipas, wifi , air panas', '-7.755151', '110.341885', 'business.site', 'Jl. Jambon, RT.07/RW.23, Baturan, Trihanggo, Kec. Gamping,  Yogyakarta', 'GH10.jpg'),
(11, 'Cassa Mia Home Stay', 1, 'kipas angin, air panas, kolam renang', '-7.773463', '110.336142', 'cassamiahotel.com', 'Jl. Demak No.5, Karang Wetan, Nogotirto, Kec. Gamping, Yogyakarta.', 'GH11.jpg'),
(12, 'Hotel Crystal Lotus', 1, 'AC, wifi gratis, kolam renang, makan pagi gratis', '-7.759407', '110.362173', 'crystallotushotel.com', 'Jl. Magelang No.KM.5,2, Kutu Dukuh, Sinduadi, Kec. Mlati, Yogyakarta.', 'GH12.jpg'),
(13, 'Hotel Satoria Yogyakarta Adisucipto', 1, 'AC, Wifi, Air panas , kolam renang', '-7.783598', '110.422061', 'satoriahotel.com', 'Jl. Laksda Adisucipto No.Km. 8, Kalongan, Maguwoharjo,  Istimewa Yogyakarta.', 'GH13.jpg'),
(14, 'Hotel Grand Zuri Malioboro', 5, 'Kolam renang, Termasuk Akses Wi-Fi Gratis, Kolam Renang Outdoor, Antar-Jemput Bandara, Parkir Gratis, Kamar Bebas-Rokok, Bar.', '-7.787654833479377', '110.36695896266076', 'Grand Zuri Malioboro menawarkan kenyamanan modern di jantung Kota Yogyakarta dan berselang 5 menit jalan kaki dari Jalan Malioboro. Hotel ini memiliki sebuah restoran, kolam renang outdoor, spa, dan gym. Akses Wi-Fi gratis tersedia di seluruh areanya.', 'Jl. P. Mangkubumi No.18, Gowongan, Kec. Jetis, Kota Yogyakarta.', 'GH14.jpg'),
(15, 'Hotel Zamrud Malioboro', 5, 'AC, TV, Tempat tidur yang nyaman, Lemari\r\nKamar mandi, air panas/dingin, Saluran TV Kabel\r\nSaluran Telp, Bath, Toilet, Non Smoking Room.', '-7.794430001401234', '110.37111303387258', 'Zamrud Malioboro memiliki pelayanan istimewa dan fasilitas yang akan membuat pengalaman menginap Anda tidak terlupakan. Hotel ini menyediakan TV, AC, restoran, layanan kebersihan, resepsionis yang ramah, Wi-fi di tempat umum dan tempat parkir yang menjamin kenyamanan bagi Anda semua.', 'Jl. Tegal Panggung No.50, Tegal Panggung, Kec. Danurejan, Kota Yogyakarta, Daerah Istimewa Yogyakarta.', 'GH15.jpg'),
(16, 'Asana Grove Yogyakarta', 5, '- Tempat tidur yang nyaman , AC , TV , Peralatan mandi , Telepon, Toilet, Non Smoking Room, Internet Access.', '-7.792911278450153', '110.39459443269345', 'Hotel santai bertingkat rendah yang teduh ini berjarak 4 km dari Museum Benteng Vredeburg, 5 km dari istana kerajaan Keraton Ngayogyakarta Hadiningrat, dan 6 km dari Bandara Internasional Adisucipto.', 'Jl. Rukun Pertiwi No.53, Muja Muju, Kec. Umbulharjo, Kota Yogyakarta.', 'GH16.jpg'),
(17, 'POP! Hotel Timoho - Yogyakarta', 5, 'Tempat tidur yang nyaman, TV, Akses internet wifi, AC, Bath, Toilet, Internet Access.', '-7.798614765480432', '110.3914545717654', 'Hotel murah modern ini berjarak 12 menit berjalan kaki dari kebun binatang Gembira Loka dan 4 km dari istana Keraton Ngayogyakarta Hadiningrat, serta toko dan restoran di Jalan Malioboro yang ramai.', 'Jl. Ipda Tut Harsono No.11 Muja Muju, Umbulharjo, Kota Yogyakarta.', 'GH17.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_km`
--

CREATE TABLE `jenis_km` (
  `id_jeniskm` int(11) NOT NULL,
  `nama_jeniskm` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis_km`
--

INSERT INTO `jenis_km` (`id_jeniskm`, `nama_jeniskm`) VALUES
(1, 'Ekonomi'),
(2, 'Premium'),
(3, 'Deluxe');

-- --------------------------------------------------------

--
-- Table structure for table `kabupaten`
--

CREATE TABLE `kabupaten` (
  `id_kab` int(11) NOT NULL,
  `nama_kab` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kabupaten`
--

INSERT INTO `kabupaten` (`id_kab`, `nama_kab`) VALUES
(1, 'Sleman'),
(2, 'Bantul'),
(3, 'Gunungkidul'),
(4, 'Kulon Progo'),
(5, 'Yogyakarta');

-- --------------------------------------------------------

--
-- Table structure for table `km_hotel`
--

CREATE TABLE `km_hotel` (
  `id_kamar` int(11) NOT NULL,
  `id_hotel` int(11) NOT NULL,
  `id_jeniskm` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `gamkamar` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `km_hotel`
--

INSERT INTO `km_hotel` (`id_kamar`, `id_hotel`, `id_jeniskm`, `jumlah`, `harga`, `gamkamar`) VALUES
(1, 1, 1, 148, 731000, 'GMK1.jpg'),
(2, 2, 3, 150, 791852, 'GMK2.jpg'),
(3, 3, 1, 60, 444000, 'GMK3.jpg'),
(4, 4, 1, 110, 338533, NULL),
(5, 5, 1, 130, 539902, 'GMK5.jpg'),
(6, 6, 1, 100, 750000, 'GMK6.jpg'),
(7, 7, 1, 80, 576000, 'GMK7.jpg'),
(8, 8, 1, 78, 465000, NULL),
(9, 9, 1, 69, 437000, NULL),
(10, 10, 1, 27, 421000, NULL),
(11, 11, 1, 38, 370000, NULL),
(12, 12, 1, 45, 489000, 'GMK12.jpg'),
(13, 13, 1, 60, 760000, NULL),
(14, 14, 1, 138, 775000, NULL),
(15, 15, 1, 16, 173554, NULL),
(17, 17, 1, 126, 246280, 'GMK17.jpg'),
(18, 16, 1, 32, 650000, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mk_kuliner`
--

CREATE TABLE `mk_kuliner` (
  `id_mkkuliner` int(11) NOT NULL,
  `nama_mkkuliner` varchar(50) NOT NULL,
  `id_tpkuliner` int(11) NOT NULL,
  `gambar` varchar(50) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mk_kuliner`
--

INSERT INTO `mk_kuliner` (`id_mkkuliner`, `nama_mkkuliner`, `id_tpkuliner`, `gambar`, `harga`) VALUES
(1, 'Soto Bakso', 1, 'GMK1.jpg', 10000),
(2, 'Soto Ayam', 1, 'GMK2.jpg', 12000),
(3, 'Mie Bakso', 6, 'GMK3.jpg', 15000),
(4, 'Mie ayam', 6, 'GMK4.jpg', 10000),
(5, 'Soto Ceker', 1, 'GMK5.jpg', 8000),
(6, 'Soto Sapi', 1, 'GMK6.jpg', 14000),
(7, 'Sate Telur Puyuh', 2, 'GMK7.jpg', 2000),
(8, 'Sate Usus Ayam', 2, 'GMK8.jpg', 1500),
(9, 'Nasi Kucing', 2, 'GMK9.jpg', 3000);

-- --------------------------------------------------------

--
-- Table structure for table `tempat_kuliner`
--

CREATE TABLE `tempat_kuliner` (
  `id_tpkuliner` int(11) NOT NULL,
  `nama_tpkuliner` varchar(50) NOT NULL,
  `id_kab` int(11) NOT NULL,
  `latitude` varchar(50) NOT NULL,
  `longitude` varchar(50) NOT NULL,
  `deskripsi` text NOT NULL,
  `alamat` text NOT NULL,
  `gambar` varchar(50) NOT NULL,
  `jam_buka` time NOT NULL,
  `jam_tutup` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tempat_kuliner`
--

INSERT INTO `tempat_kuliner` (`id_tpkuliner`, `nama_tpkuliner`, `id_kab`, `latitude`, `longitude`, `deskripsi`, `alamat`, `gambar`, `jam_buka`, `jam_tutup`) VALUES
(1, 'Soto Pak Sholeh Al-Barokah', 1, '-7.751159', '110.370142', 'Enak, murah dan bersih', 'Jalan Ringroad Utara, Sariharjo, Kec. Ngaglik, Kabupaten Sleman, Yogyakarta.', 'GTK1.jpg', '10:00:00', '15:00:00'),
(2, 'Angkringan Siang Malam', 1, '-7.750772', '110.353079', 'murah ramah dan nyaman', 'Trini, Sinduadi, Kec. Mlati, Kabupaten Sleman, Daerah Istimewa Yogyakarta.', 'GTK2.jpg', '12:00:00', '00:00:00'),
(3, 'Tengkleng Pawon (Umi Nunung) 1', 1, '-7.752547', '110.37017600000001', 'bersih dan ramah', 'Jl. Monjali No.20, Sumberan, Sariharjo, Kec. Ngaglik, Kabupaten Sleman,  Yogyakarta.', 'GTK3.jpg', '10:00:00', '21:00:00'),
(4, 'Jogja Paradise Food Court', 1, '-7.752172', '110.362590', 'nyaman, bersih dan harga terjangkau', 'Jl. Magelang, Kutu Tegal, Sinduadi, Kec. Mlati, Kabupaten Sleman, Yogyakarta.', 'GTK4.jpg', '10:00:00', '21:00:00'),
(5, 'Kuliner Gudeg Pecel Pasar Beringharjo Bu Yamtini', 5, '-7.791455', '110.37415599999997', 'Murah dan bersih', 'Jl. Margo Mulyo Jalan Jendral Ahmad Yani, Ngupasan, Kec. Gondomanan, Kota Yogyakarta, Yogyakarta.', 'GTK5.jpg', '12:00:00', '20:00:00'),
(6, 'Taman Kuliner Condongcatur', 1, '-7.755722', '110.394444', 'ramah, harga terjangkau', 'Jl. Angga Jaya 3, Condong Catur, Depok,, Sleman, Yogyakarta, Condongcatur,Kec. Depok, Kabupaten Sleman, Yogyakarta.', 'GTK6.jpg', '10:00:00', '17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tempat_wisata`
--

CREATE TABLE `tempat_wisata` (
  `id_tpwisata` int(11) NOT NULL,
  `nama_tpwisata` varchar(50) NOT NULL,
  `id_kab` int(11) NOT NULL,
  `latitude` varchar(50) NOT NULL,
  `longitude` varchar(50) NOT NULL,
  `deskripsi` text NOT NULL,
  `alamat` text NOT NULL,
  `gambar` varchar(50) NOT NULL,
  `harga_tiket` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tempat_wisata`
--

INSERT INTO `tempat_wisata` (`id_tpwisata`, `nama_tpwisata`, `id_kab`, `latitude`, `longitude`, `deskripsi`, `alamat`, `gambar`, `harga_tiket`) VALUES
(1, 'Kebun Binatang Gembira Loka ZOO', 5, '-7.804114886255004', '110.39802229581449', 'Kebun binatang Jogja Bagus', 'Jl. Kebun Raya No.2, Rejowinangun, Kec. Kotagede, Kota Yogyakarta.', 'GW1.jpg', 35000),
(2, 'Taman Pelangi Jogja', 1, '-7.7505253290727865', '110.36870474545333', 'Nyaman aman dan menawan', 'Jl. Ringroad Utara, Jongkang, Sariharjo, Kec. Ngaglik, Yogyakarta.', 'GW2.jpg', 15000),
(3, 'Monumen Yogya Kembali', 1, '-7.749590812118987', '110.36960697351071', 'Nyaman dan bersih', 'Jl. Ringroad Utara, Jongkang, Sariharjo, Kec. Ngaglik, Yogyakarta.', 'GW3.jpg', 20000),
(4, 'Taman Wisata Sungai Kayen', 1, '-7.736786425411584', '110.38526101587388', 'Ramah lingkungan', 'Kayen, Condongcatur, Kec. Depok, Kabupaten Sleman, Daerah Istimewa Yogyakarta.', 'GW4.jpg', 5000),
(5, 'Kebun Buah Mangunan', 2, '-7.931754', '110.43216699999994', 'Pemandangannya indah, dapat melihat sunset atau sunrise', 'Jl. Imogiri - Dlingo, Sukorame, Mangunan, Dlingo, Bantul, Yogyakarta.', 'GW5.jpg', 10000),
(6, 'Hutan Pinus Mangunan Dlingo', 2, '-7.926741', '110.432018', 'Nyaman dan bersih lingkungan', 'Sukorame, Mangunan, Dlingo, Bantul, Daerah Istimewa Yogyakarta.', 'GW6.jpg', 10000),
(7, 'Pantai Parangkusumo', 2, '-8.022564', '110.32498299999997', 'indah pemandangannya, bersih', 'Jl. Pantai Parangkusumo, Pantai, Parangtritis, Kec. Kretek, Bantul, Yogyakarta.', 'GW7.jpg', 10000),
(8, 'West Lagoon', 1, '-7.759297', '110.330758', 'bersih dan nyaman', 'Sawahan, Nogotirto, Kec. Gamping, Kabupaten Sleman, Daerah Istimewa Yogyakarta.', 'GW8.jpg', 15000),
(9, 'Waduk Tambakboyo', 1, '-7.755152', '110.414015', 'Bersih dan pemandangannya indah', 'Condong Catur, Depok, Ngringin, Wedomartani, Kec. Ngemplak, Kabupaten Sleman, Yogyakarta.', 'GW9.jpg', 5000),
(10, 'D\'Walik', 5, '-7.816335', '110.386248', 'spot foto foto yang unik', 'Jl. Veteran No.200, Pandeyan, Kec. Umbulharjo, Kota Yogyakarta, Daerah Istimewa Yogyakarta.', 'GW10.jpg', 25000),
(11, 'Candi Perambanan', 1, '-7.751978', '110.49146700000006', 'Kompleks candi Hindu yang luas & dibangun pada abad ke-9 dengan struktur batu atas meruncing & patung.', 'Jl. Raya Solo - Yogyakarta No.16, Kranggan, Bokoharjo, Kec. Prambanan, Kabupaten Sleman,DIY.', 'GW11.jpg', 35000),
(12, 'Museum Benteng Vredeburg', 5, '-7.800252', '110.366301', 'Museum yang dulunya benteng kolonial ini menampilkan sejarah perjuangan kemerdekaan Indonesia.', 'Jl. Margo Mulyo No.6, Ngupasan, Kec. Gondomanan, Kota Yogyakarta, Daerah Istimewa Yogyakarta.', 'GW12.jpg', 10000),
(13, 'Wisata Merapi Yogyakarta', 1, '-7.557106', '110.438000', 'Tempat wisata full day yang sangat manantang untuk seluruh anggota keluarga. Wisata ini dimulai dari terminal jeep-jeep willys untuk naik ke gunung merapi. Routenya bayak pilihan tempat2 fenomenal yang ada di gunung merapi misalnya museum merapi yang menyi.mpan sisa sisa korbab keganasan lahar merapi, rumah mbah Marijan atau di bunker kali adem. Kalau lupa bawa bekal minuman di depan bunker kali adem ada tersedia kios2 makan dan minuman juga ada kios2 sovenir bagi yang ingin membawa oleh2. Setelah naik gunung kemudian diakhiri dengan off road di kali kuning dengan balapan jeep di dalam kali kuning untuk berbasah-basah ria, makanya kalau kesini jangan lupa membawa baju salin.. tempat ganti baju ada di terminal/pangkalan jeep. Tempan ganti cukup bersih. Kalau habis off road lapar di pangkalan jeep banyak yang jual makanan. Coba saja tempat ini membawa kengan bagi keluarga.', 'Area Hutan, Hargobinangun, Kec. Pakem, Kabupaten Sleman, Daerah Istimewa Yogyakarta.', 'GW13.jpg', 150000),
(14, 'Taman Wisata Kaliurang', 1, '-7.598790', '110.426358', 'Taman wisata keluarga yang udah ada dari dulu, tempatnya cukup luas, ada wahana permainan seperti flying fox, banyak patung2 binatang jadi bisa sekalian buat anak2 belajar mengenal hewan, ada terapi ikan juga.', 'Jl. Siaga, Kaliurang Barat, Hargobinangun, Kec. Pakem, Kabupaten Sleman, DIY.', 'GW14.jpg', 30000),
(15, 'The World Landmarks - Merapi Park Yogyakarta', 1, '-7.620855', '110.421632', 'Destinasi wisata yang unik dan menarik yang wajib anda kunjungi bersama keluarga saat berwisata ke Jogja. Di area taman yang cukup luas ini disajikan beberapa miniatur bangunan-bangunan terkenal di dunia seperti Menara Eiffel, Piramida, Big Bang, Patung Liberty, Menara miring Pisa, dan lain-lain. Lokasi wisata ini sangat instagramable karena banyaknya spot-spot cantik untuk berswafoto. Sebaiknya ke tempat ini pada waktu week days agar pengunjung tidak pada yang menyebabkan anda tidak bebas ber swafoto.', 'Jl. Kaliurang No.KM. 22.5, Banteng, Hargobinangun, Kec. Pakem, Kabupaten Sleman, DIY.', 'GW15.jpg', 19998);

-- --------------------------------------------------------

--
-- Table structure for table `transjogja`
--

CREATE TABLE `transjogja` (
  `id_transjogja` int(11) NOT NULL,
  `nama_transjogja` varchar(50) NOT NULL,
  `latitude` varchar(50) NOT NULL,
  `longitude` varchar(50) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transjogja`
--

INSERT INTO `transjogja` (`id_transjogja`, `nama_transjogja`, `latitude`, `longitude`, `alamat`) VALUES
(1, 'Halte Hartono Mall', '-7.758390056262953', '110.40055017225507', 'Sanggrahan, Condongcatur, Kec. Depok, Kabupaten Sleman, Daerah Istimewa Yogyakarta.'),
(2, 'Halte Balai Manggung', '-7.758091450443038', '110.38637106134229', 'Jl. Jogja Ring Road Utara, Manggung, Caturtunggal, Kec. Depok, Kabupaten Sleman Yogyakarta'),
(3, 'Halte UTY', '-7.7473875739074165', '110.3564273236193', 'Mlati Krajan, Sendangadi, Kec. Mlati, Kabupaten Sleman Yogyakarta'),
(4, 'Halte Trans Jogja Bandara Adisucipto', '-7.784597', '110.431610', 'Jl. Airport Adisucipto, Karangploso, Maguwoharjo, Kec. Depok, Kabupaten Sleman,  Yogyakarta.'),
(5, 'Halte Transjogja TVRI', '-7.765172', '110.361686', 'Ruko Permai Magelang, Jl. Magelang No.8, Kutu Asem, Sinduadi, Kec. Mlati, Kabupaten Sleman.'),
(6, 'Halte Jlagran', '-7.789441', '110.360220', 'Jl. Ps. Kembang, Pringgokusuman, Gedong Tengen, Kota Yogyakarta, Daerah Istimewa Yogyakarta.'),
(7, 'Halte Malioboro 1', '-7.790839', '110.366160', 'Jl. Malioboro, Sosromenduran, Gedong Tengen, Kota Yogyakarta.'),
(8, 'Halte Cik Di Tiro 1', '-7.782341', '110.375101', 'Jl. Cik Di Tiro, Terban, Kec. Gondokusuman, Kota Yogyakarta.'),
(9, 'Halte TJ Yos Sudarso', '-7.787291', '110.375375', 'Kotabaru, Kec. Gondokusuman, Kota Yogyakarta, Daerah Istimewa Yogyakarta.'),
(10, 'Halte Trans Jogja Malioboro 3', '-7.800004', '110.36502199999995', 'Ngupasan, Kec. Gondomanan, Kota Yogyakarta, Daerah Istimewa Yogyakarta.'),
(11, 'Halte Trans Jogja Katamso 1', '-7.808752', '110.369157', 'Kotabaru, Kec. Gondokusuman, Kota Yogyakarta, Daerah Istimewa Yogyakarta.'),
(12, 'Halte Trans Jogja Museum Perjuangan', '-7.814861', '110.371383', 'Jl. Kolonel Sugiyono No.29, Brontokusuman, Kec. Mergangsan, Kota Yogyakarta.'),
(13, 'Halte Transjogja Taman Siswa', '-7.813688', '110.376553', 'Jl. Taman Siswa, Wirogunan, Kec. Mergangsan, Kota Yogyakarta, Daerah Istimewa Yogyakarta.'),
(14, 'Trans Jogja bus stop Mandala Krida Stadium', '-7.797536', '110.383399', 'Jl. Kenari No.6, Semaki, Kec. Umbulharjo, Kota Yogyakarta, Daerah Istimewa Yogyakarta.'),
(15, 'Halte TransJogja Gedongkuning', '-7.807293', '110.402203', 'Jl. Gedongkuning No.173, Banguntapan, Kec. Banguntapan, Kota Yogyakarta.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `gamhotel`
--
ALTER TABLE `gamhotel`
  ADD PRIMARY KEY (`id_gamhotel`);

--
-- Indexes for table `gamkuliner`
--
ALTER TABLE `gamkuliner`
  ADD PRIMARY KEY (`id_gamkuliner`);

--
-- Indexes for table `gamwisata`
--
ALTER TABLE `gamwisata`
  ADD PRIMARY KEY (`id_gamwisata`);

--
-- Indexes for table `hotel`
--
ALTER TABLE `hotel`
  ADD PRIMARY KEY (`id_hotel`),
  ADD KEY `fk_id_kab` (`id_kab`);

--
-- Indexes for table `jenis_km`
--
ALTER TABLE `jenis_km`
  ADD PRIMARY KEY (`id_jeniskm`);

--
-- Indexes for table `kabupaten`
--
ALTER TABLE `kabupaten`
  ADD PRIMARY KEY (`id_kab`);

--
-- Indexes for table `km_hotel`
--
ALTER TABLE `km_hotel`
  ADD PRIMARY KEY (`id_kamar`),
  ADD KEY `fk_id_hotel` (`id_hotel`),
  ADD KEY `fk_id_jeniskm` (`id_jeniskm`);

--
-- Indexes for table `mk_kuliner`
--
ALTER TABLE `mk_kuliner`
  ADD PRIMARY KEY (`id_mkkuliner`),
  ADD KEY `fk_id_tpkuliner` (`id_tpkuliner`);

--
-- Indexes for table `tempat_kuliner`
--
ALTER TABLE `tempat_kuliner`
  ADD PRIMARY KEY (`id_tpkuliner`),
  ADD KEY `fk_id_kab` (`id_kab`);

--
-- Indexes for table `tempat_wisata`
--
ALTER TABLE `tempat_wisata`
  ADD PRIMARY KEY (`id_tpwisata`),
  ADD KEY `fk_id_kab` (`id_kab`);

--
-- Indexes for table `transjogja`
--
ALTER TABLE `transjogja`
  ADD PRIMARY KEY (`id_transjogja`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `gamhotel`
--
ALTER TABLE `gamhotel`
  MODIFY `id_gamhotel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `gamkuliner`
--
ALTER TABLE `gamkuliner`
  MODIFY `id_gamkuliner` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gamwisata`
--
ALTER TABLE `gamwisata`
  MODIFY `id_gamwisata` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hotel`
--
ALTER TABLE `hotel`
  MODIFY `id_hotel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `jenis_km`
--
ALTER TABLE `jenis_km`
  MODIFY `id_jeniskm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kabupaten`
--
ALTER TABLE `kabupaten`
  MODIFY `id_kab` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `km_hotel`
--
ALTER TABLE `km_hotel`
  MODIFY `id_kamar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `mk_kuliner`
--
ALTER TABLE `mk_kuliner`
  MODIFY `id_mkkuliner` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tempat_kuliner`
--
ALTER TABLE `tempat_kuliner`
  MODIFY `id_tpkuliner` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tempat_wisata`
--
ALTER TABLE `tempat_wisata`
  MODIFY `id_tpwisata` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hotel`
--
ALTER TABLE `hotel`
  ADD CONSTRAINT `hotel_ibfk_1` FOREIGN KEY (`id_kab`) REFERENCES `kabupaten` (`id_kab`);

--
-- Constraints for table `km_hotel`
--
ALTER TABLE `km_hotel`
  ADD CONSTRAINT `km_hotel_ibfk_1` FOREIGN KEY (`id_hotel`) REFERENCES `hotel` (`id_hotel`),
  ADD CONSTRAINT `km_hotel_ibfk_2` FOREIGN KEY (`id_jeniskm`) REFERENCES `jenis_km` (`id_jeniskm`);

--
-- Constraints for table `mk_kuliner`
--
ALTER TABLE `mk_kuliner`
  ADD CONSTRAINT `mk_kuliner_ibfk_1` FOREIGN KEY (`id_tpkuliner`) REFERENCES `tempat_kuliner` (`id_tpkuliner`);

--
-- Constraints for table `tempat_kuliner`
--
ALTER TABLE `tempat_kuliner`
  ADD CONSTRAINT `tempat_kuliner_ibfk_1` FOREIGN KEY (`id_kab`) REFERENCES `kabupaten` (`id_kab`);

--
-- Constraints for table `tempat_wisata`
--
ALTER TABLE `tempat_wisata`
  ADD CONSTRAINT `tempat_wisata_ibfk_1` FOREIGN KEY (`id_kab`) REFERENCES `kabupaten` (`id_kab`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
