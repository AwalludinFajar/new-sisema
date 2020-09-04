-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 29, 2020 at 08:19 PM
-- Server version: 5.7.29-0ubuntu0.18.04.1
-- PHP Version: 5.6.40-24+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `logistic_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `ref_group_menu`
--

CREATE TABLE `ref_group_menu` (
  `id_group_menu` int(11) NOT NULL,
  `id_user_group` int(11) DEFAULT NULL,
  `id_menu` int(11) DEFAULT NULL,
  `role` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ref_group_menu`
--

INSERT INTO `ref_group_menu` (`id_group_menu`, `id_user_group`, `id_menu`, `role`) VALUES
(50, 4, 106, 'CUDVP'),
(53, 4, 113, 'CUDVP'),
(54, 4, 124, 'CUDVP'),
(55, 4, 116, 'CUDVP'),
(84, 1, 1, 'CUDVP'),
(85, 1, 32, 'CUDVP'),
(86, 1, 121, 'CUDVP'),
(87, 1, 7, 'CUDVP'),
(88, 1, 8, 'CUDVP'),
(89, 1, 116, 'CUDVP'),
(90, 1, 130, 'CUDVP'),
(91, 1, 131, 'CUDVP'),
(96, 3, 116, 'V'),
(97, 3, 130, 'CDV'),
(98, 5, 116, 'V'),
(99, 5, 131, 'CDV');

-- --------------------------------------------------------

--
-- Table structure for table `ref_menu`
--

CREATE TABLE `ref_menu` (
  `id_menu` int(11) NOT NULL,
  `parrent` int(11) DEFAULT NULL,
  `nama_menu` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `urutan` varchar(255) DEFAULT NULL,
  `class_active` varchar(255) DEFAULT NULL,
  `icon` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ref_menu`
--

INSERT INTO `ref_menu` (`id_menu`, `parrent`, `nama_menu`, `link`, `urutan`, `class_active`, `icon`) VALUES
(1, 0, 'Settings', '', '8', '', 'icon-cog3'),
(7, 121, 'Users', 'ref_users', '0', '', 'icon-people'),
(8, 121, 'Roles', 'ref_role', '1', '', 'icon-key'),
(32, 1, 'Menus', 'ref_menu', '1', NULL, 'icon-grid'),
(116, 0, 'Report', 'report', '8', NULL, NULL),
(121, 1, 'Management', '#', '4', NULL, 'icon-people'),
(130, 0, 'Reciveing', '/load_reciveing', '2', NULL, NULL),
(131, 0, 'Storage', '/load_storage', '4', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ref_profil_app`
--

CREATE TABLE `ref_profil_app` (
  `id_ref_profil_app` int(11) NOT NULL,
  `nama_aplikasi` text,
  `logo` varchar(255) DEFAULT NULL,
  `background` varchar(255) DEFAULT NULL,
  `header` varchar(255) DEFAULT NULL,
  `lgo_width` int(11) DEFAULT NULL,
  `lgo_height` int(11) DEFAULT NULL,
  `hdr_width` int(11) DEFAULT NULL,
  `hdr_height` int(11) DEFAULT NULL,
  `text_j_header` int(11) DEFAULT NULL,
  `note_lo` text,
  `note_bg` text,
  `note_hd` text,
  `update_by` varchar(100) DEFAULT NULL,
  `update_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ref_profil_app`
--

INSERT INTO `ref_profil_app` (`id_ref_profil_app`, `nama_aplikasi`, `logo`, `background`, `header`, `lgo_width`, `lgo_height`, `hdr_width`, `hdr_height`, `text_j_header`, `note_lo`, `note_bg`, `note_hd`, `update_by`, `update_time`) VALUES
(1, 'Kendali Realisasi Anggaran', 'dagri-logo1.png', 'back_baru3.png', 'heder1.png', 75, 95, 1366, 70, 1, '', '', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ref_users`
--

CREATE TABLE `ref_users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` tinytext,
  `nama_lengkap` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `hp` varchar(50) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `create_by` varchar(100) DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `update_by` varchar(100) DEFAULT NULL,
  `status_aktif` enum('Y','N') DEFAULT 'N' COMMENT 'Y / N',
  `id_user_group` int(11) DEFAULT NULL,
  `ip` varchar(255) NOT NULL,
  `logout_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ref_users`
--

INSERT INTO `ref_users` (`id`, `username`, `password`, `nama_lengkap`, `email`, `hp`, `create_time`, `create_by`, `update_time`, `update_by`, `status_aktif`, `id_user_group`, `ip`, `logout_time`) VALUES
(1, '25252525', '856008f9f26bd8fb28130e546dd0a791d6dacae0', 'ngadmine', 'yosep.rohayadi@gmail.com', '6281320327642', NULL, NULL, NULL, NULL, 'Y', 1, '::1', '2020-08-29 19:43:40'),
(2, 'admin', '739201c2619e55bdd08bfb7ffd80d044c3289674', 'Admin', 'yosep.rohayadi@gmail.com', '6281320327642', '2018-04-24 10:08:28', NULL, '2018-04-24 10:08:29', NULL, 'Y', 3, '::1', '2020-08-28 20:37:57'),
(3, 'test', '739201c2619e55bdd08bfb7ffd80d044c3289674', 'testing nama1', 'test@tets.com1', '01', '2018-04-24 10:14:00', 'Admin', '2020-08-28 20:18:56', 'ngadmine', 'Y', 5, '::1', '2020-08-29 19:45:29'),
(5, '3845834578', '739201c2619e55bdd08bfb7ffd80d044c3289674', 'nama ini nama', 'email@email.email', '92385834753495', '2020-08-28 19:36:32', 'Yosep Rohayadi', NULL, NULL, 'N', 4, '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `ref_user_group`
--

CREATE TABLE `ref_user_group` (
  `id_user_group` int(11) NOT NULL,
  `nama_user_group` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ref_user_group`
--

INSERT INTO `ref_user_group` (`id_user_group`, `nama_user_group`) VALUES
(1, 'SUPERADMIN'),
(3, 'Reciveing'),
(4, 'Kitting or Buyer'),
(5, 'Storage');

-- --------------------------------------------------------

--
-- Table structure for table `tab_recive_storage`
--

CREATE TABLE `tab_recive_storage` (
  `id` int(11) NOT NULL,
  `no_rv` varchar(255) NOT NULL,
  `id_user_reciveing` int(11) NOT NULL,
  `name_user_reciveing` varchar(255) NOT NULL,
  `date_reciveing` datetime NOT NULL,
  `id_user_storage` int(11) NOT NULL,
  `name_user_storage` varchar(255) NOT NULL,
  `date_storage` datetime NOT NULL,
  `flag` enum('0','1') NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tab_rv`
--

CREATE TABLE `tab_rv` (
  `id` int(11) NOT NULL,
  `no_rv` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ref_group_menu`
--
ALTER TABLE `ref_group_menu`
  ADD PRIMARY KEY (`id_group_menu`);

--
-- Indexes for table `ref_menu`
--
ALTER TABLE `ref_menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `ref_profil_app`
--
ALTER TABLE `ref_profil_app`
  ADD PRIMARY KEY (`id_ref_profil_app`);

--
-- Indexes for table `ref_users`
--
ALTER TABLE `ref_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ref_user_group`
--
ALTER TABLE `ref_user_group`
  ADD PRIMARY KEY (`id_user_group`);

--
-- Indexes for table `tab_recive_storage`
--
ALTER TABLE `tab_recive_storage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tab_rv`
--
ALTER TABLE `tab_rv`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ref_group_menu`
--
ALTER TABLE `ref_group_menu`
  MODIFY `id_group_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `ref_menu`
--
ALTER TABLE `ref_menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `ref_profil_app`
--
ALTER TABLE `ref_profil_app`
  MODIFY `id_ref_profil_app` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ref_users`
--
ALTER TABLE `ref_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ref_user_group`
--
ALTER TABLE `ref_user_group`
  MODIFY `id_user_group` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tab_recive_storage`
--
ALTER TABLE `tab_recive_storage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tab_rv`
--
ALTER TABLE `tab_rv`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
