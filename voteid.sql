-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 05, 2016 at 07:24 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `voteid`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `hitung_all` ()  BEGIN
	SELECT b.urut_calon,b.id_calon,b.identifier_id AS Angkatan, b.nama_calon, b.identifier_type AS Tipe, COUNT(a.pilihan1) AS Jumlah
	FROM pilihan a RIGHT JOIN calon b ON a.pilihan1=b.id_calon OR a.pilihan2=b.id_calon
GROUP BY b.id_calon;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `login` (`USER` VARCHAR(32), `PASS` VARCHAR(64))  BEGIN
	/*Declare semua*/
	DECLARE role TINYINT;
    
    /*Mencari Role dari User*/
    SET role = (SELECT `id_role` FROM ADMINS WHERE `user_admins`= USER AND `pass_admins`= PASS);
		IF role IS NULL THEN
			SELECT '0' AS ROLE;
		ELSE
			SELECT role AS ROLE;
		END IF;
    
    /*Log Login*/
    INSERT INTO `voteid`.`log_login` (`user_admins`)
	VALUES (USER);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `login_pemilih` (IN `TOKEN2` CHAR(7), IN `TPS` CHAR(2))  BEGIN

	DECLARE EXIT HANDLER FOR 1062
	SELECT '1' AS RESULT;
	
         
    SET @flag = (SELECT flag FROM voteid.token WHERE token=TOKEN2  LIMIT 1);
    SET @waktu_generate = (SELECT waktu FROM voteid.token WHERE token=TOKEN2  LIMIT 1);
    SET @waktu = (SELECT CURTIME());
    SET @selisih = (SELECT TIMEDIFF(@waktu_generate,@waktu));
    
 /* SELECT @flag,@waktu_generate,@waktu,@selisih;
*/ 
    IF @flag=1 OR @selisih>10 OR @flag IS NULL THEN
		SELECT '1' AS RESULT;
	        
    ELSE 
		INSERT INTO pilihan (token,tps,waktu,hari) VALUES(TOKEN2,TPS,waktu,hari);        
		UPDATE voteid.token SET flag='1' WHERE token=TOKEN2;
		SELECT '0' AS RESULT;
    END IF;


END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `memilih` (IN `token` CHAR(7), IN `pil1` CHAR(2), IN `pil2` CHAR(2))  BEGIN

	UPDATE pilihan
    SET pilihan1 = pil1, pilihan2 = pil2 
    WHERE pilihan.token = token;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pilih_blm` (IN `token2` CHAR(7))  BEGIN
	SET @angkatan = (SELECT identifier_id FROM voteid.token WHERE token=token2);
	SELECT * FROM calon WHERE identifier_id=@angkatan AND identifier_type='BLM';

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `token_generator` (IN `TPS` CHAR(2), IN `ANGKATAN` CHAR(2))  BEGIN
	DECLARE bawah TINYINT;
    DECLARE atas tinyint;
	DECLARE acak2 INT;
    DECLARE acak INT;
    DECLARE random CHAR(32);
    DECLARE token CHAR(7);
    DECLARE waktu TIME;
    DECLARE hari DATE;

DECLARE EXIT HANDLER FOR 1062
CALL token_generator(TPS,ANGKATAN); 

SET atas = 1;
SET bawah = 65536;
SET acak = (SELECT FLOOR(RAND()*(bawah-atas)+1));
SET random = MD5(acak);
SET acak2 = (SELECT FLOOR(RAND()*(27-1)+1));
SET token = (SELECT CONCAT(ANGKATAN,TPS,(SELECT SUBSTRING(random,acak2,3))));
SET waktu = (SELECT CURTIME());
SET hari = (SELECT CURDATE());

INSERT INTO token VALUES (token,tps,waktu,hari,'0',ANGKATAN);
SELECT token;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id_admins` int(11) NOT NULL,
  `user_admins` varchar(32) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `name_admins` varchar(45) DEFAULT NULL,
  `id_role` tinyint(2) NOT NULL,
  `remember_token` varchar(255) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id_admins`, `user_admins`, `password`, `name_admins`, `id_role`, `remember_token`, `updated_at`) VALUES
(1, '5201', '$2y$10$vqwHbAIOXonE1sxeAYtTl.8Ki1wGKEtiT1ybjAMQ2cxuSNnfpVT0i', 'superuserdooperation', 77, 'DVArL1f9wGE8tOm1yD2uF5L0HP6vjFB23z1rV5NWIJ5vEW9K3Z6CaOcRO7wI', '2016-05-07 23:12:23'),
(2, '5202', '$2y$10$DBEgenP32eAshCYLwcIIHOPFxh88jFsPdA.PnThsHRBS4TpjWFPh2', 'Mochammad Rizki', 77, '3erfykC3oY97CesMDqfCP9EIw81qYyNn0Ygg80E20grRHJWEprpo2O3KvGRS', '2015-11-25 02:33:55'),
(3, '5203', '$2y$10$Vcs.qP2oVI2z8AqNrIcQsemnYPeoqZ4iyckmABFJcYo6j/pkdQyYa', 'supri', 77, 'esyJIOqbgajLXn2y8YExfTJHaT7gw2CCk6ru1JxG9J8BZ9vaetGkK6FrpDOo', '2015-11-25 02:34:19'),
(4, '5204', '$2y$10$c0w..A1MSXKWgQtjqq9gz.DjbwoOMhuErf00yDIP/jDFXu3M8ohMq', 'yanto', 77, 'KsO1tUN7rl3POn0bhrVELcyw6fXQUO1B5a1FAZQiNiiYVER2MC3WLJM7nezt', '2015-11-24 19:35:17'),
(5, '5205', '$2y$10$zDO1jNm6uoBtoKKn1vEnq.VgicCfQS1RjCajELCxlWzgoiH0..zqe', 'joko', 77, '', '2015-11-25 02:34:57'),
(6, '5206', '$2y$10$g0TO15araClWvMm83LVCQ.FoVRD5BvDnv7HL.F.kE22QGFYzUr/e.', 'rowie', 77, 'uw2LWfPp5RrUXOQolSeJHNQmMPLUIvW9eLpj5dXyiktqYyLBVfBqiCWWQNXI', '2015-11-24 19:35:35');

-- --------------------------------------------------------

--
-- Table structure for table `calon`
--

CREATE TABLE `calon` (
  `id_calon` int(11) NOT NULL,
  `urut_calon` tinyint(2) NOT NULL,
  `nama_calon` varchar(32) NOT NULL,
  `nama_wakil` varchar(32) DEFAULT NULL,
  `photopath_calon` mediumtext,
  `identifier_id` int(11) DEFAULT NULL,
  `identifier_type` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `calon`
--

INSERT INTO `calon` (`id_calon`, `urut_calon`, `nama_calon`, `nama_wakil`, `photopath_calon`, `identifier_id`, `identifier_type`) VALUES
(1, 1, 'Yudha Eka Putra S.', 'Calista Segalita', '/assets/calon/bem1.JPG', NULL, 'PRESBEM'),
(2, 2, 'Cindy Novia Dimantri', 'Muhammad Misbakhul M.', '/assets/calon/bem2.JPG', NULL, 'PRESBEM'),
(3, 1, 'SITI AFIFATUS', NULL, '/assets/calon/2013/1.jpg', 13, 'BLM'),
(4, 2, 'MONIKA ADITIA P R', NULL, '/assets/calon/2013/2.jpg', 13, 'BLM'),
(5, 3, 'M HAMZAH', NULL, '/assets/calon/2013/3.jpg', 13, 'BLM'),
(6, 4, 'AYUNDA ZILUL', NULL, '/assets/calon/2013/4.jpg', 13, 'BLM'),
(7, 5, 'NUR RAHMAWATI', NULL, '/assets/calon/2013/5.jpg', 13, 'BLM'),
(8, 6, 'HANIN DHANY R', NULL, '/assets/calon/2013/6.jpg', 13, 'BLM'),
(9, 1, 'IMROATUL HASANAH', NULL, '/assets/calon/2014/1.jpg', 14, 'BLM'),
(10, 2, 'RENATA SASKIA', NULL, '/assets/calon/2014/2.jpg', 14, 'BLM'),
(11, 3, 'PUTRA AGATA LESMANA', NULL, '/assets/calon/2014/3.jpg', 14, 'BLM'),
(12, 4, 'AMALIA SYAFITRI', NULL, '/assets/calon/2014/4.jpg', 14, 'BLM'),
(13, 5, 'FITRAH BINTAN HARISMA', NULL, '/assets/calon/2014/5.jpg', 14, 'BLM'),
(14, 6, 'YUHANA DUHANITA FIRDAUSIANA', NULL, '/assets/calon/2014/6.jpg', 14, 'BLM'),
(15, 7, 'SHABRINA AYU M', NULL, '/assets/calon/2014/7.jpg', 14, 'BLM'),
(16, 8, 'DEVI PUSPASARI', NULL, '/assets/calon/2014/8.jpg', 14, 'BLM'),
(17, 9, 'KARTIKA NURIL I', NULL, '/assets/calon/2014/9.jpg', 14, 'BLM'),
(18, 10, 'KIKI AWALUL', NULL, '/assets/calon/2014/10.jpg', 14, 'BLM'),
(19, 11, 'ANA RISKHATUL F', NULL, '/assets/calon/2014/11.jpg', 14, 'BLM'),
(20, 1, 'NISRINA MAHFUDHAH', NULL, '/assets/calon/2015/1.jpg', 15, 'BLM'),
(21, 2, 'ACHMAD MARALDA A G', NULL, '/assets/calon/2015/2.jpg', 15, 'BLM'),
(22, 3, 'AIS ASSANA', NULL, '/assets/calon/2015/3.jpg', 15, 'BLM'),
(23, 4, 'IROHATUL A''ILA', NULL, '/assets/calon/2015/4.jpg', 15, 'BLM'),
(24, 5, 'DELLA SAFERA P', NULL, '/assets/calon/2015/5.jpg', 15, 'BLM'),
(25, 6, 'NIMAS AYU M', NULL, '/assets/calon/2015/6.jpg', 15, 'BLM'),
(26, 7, 'RIZKI RAKHMA D', NULL, NULL, 15, 'BLM'),
(27, 8, 'FENTI NUR A A', NULL, NULL, 15, 'BLM'),
(28, 9, 'MUNYATI SULAM', NULL, NULL, 15, 'BLM');

-- --------------------------------------------------------

--
-- Table structure for table `calon_identifier`
--

CREATE TABLE `calon_identifier` (
  `identifier_id` varchar(10) NOT NULL,
  `identifier_name` varchar(45) NOT NULL,
  `identifier_desc` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `calon_identifier`
--

INSERT INTO `calon_identifier` (`identifier_id`, `identifier_name`, `identifier_desc`) VALUES
('13', 'ID_TAHUN', 'Identifikasi BLM berdasarkan tahun'),
('14', 'ID_TAHUN', 'Identifikasi BLM berdasarkan tahun'),
('15', 'ID_TAHUN', 'Identifikasi BLM berdasarkan tahun'),
('S0', 'ID_STATUS', 'Identifikasi BLM Berdasarkan Statuta');

-- --------------------------------------------------------

--
-- Table structure for table `log_login`
--

CREATE TABLE `log_login` (
  `id_log_login` int(11) NOT NULL,
  `user_admins` varchar(32) NOT NULL,
  `timestamp_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `log_login`
--

INSERT INTO `log_login` (`id_log_login`, `user_admins`, `timestamp_login`) VALUES
(1, 'sudo', '2015-11-15 09:18:37'),
(2, 'sudo', '2015-11-15 09:19:48'),
(3, 'sudo', '2015-11-15 09:21:11'),
(4, 'sudo', '2015-11-15 09:28:51'),
(5, 'sudo', '2015-11-15 09:29:17'),
(6, 'caku', '2015-11-15 09:29:45'),
(7, 'caku', '2015-11-15 09:31:47'),
(8, 'caku', '2015-11-15 09:32:13'),
(9, 'caku', '2015-11-15 09:34:36'),
(10, '0', '2015-11-17 12:32:33'),
(11, 'caku', '2015-11-17 12:34:04'),
(12, 'caku', '2015-11-17 12:34:28');

-- --------------------------------------------------------

--
-- Table structure for table `pilihan`
--

CREATE TABLE `pilihan` (
  `token` char(7) NOT NULL,
  `tps` char(3) NOT NULL,
  `waktu` time NOT NULL,
  `hari` date NOT NULL,
  `pilihan1` tinyint(2) DEFAULT '0',
  `pilihan2` tinyint(2) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pilihan`
--

INSERT INTO `pilihan` (`token`, `tps`, `waktu`, `hari`, `pilihan1`, `pilihan2`) VALUES
('1212522', '12', '00:00:00', '0000-00-00', 2, 0),
('12125c6', '12', '00:00:00', '0000-00-00', 1, 0),
('1312243', '12', '00:00:00', '0000-00-00', 0, 0),
('131236a', '12', '00:00:00', '0000-00-00', 0, 0),
('13124ac', '12', '00:00:00', '0000-00-00', 2, 3),
('1312532', '12', '00:00:00', '0000-00-00', 0, 0),
('1312e4a', '12', '00:00:00', '0000-00-00', 0, 0),
('1312e8a', '12', '00:00:00', '0000-00-00', 0, 0),
('1312ea9', '12', '00:00:00', '0000-00-00', 0, 0),
('1312f0c', '12', '00:00:00', '0000-00-00', 1, 3),
('1312f8a', '12', '00:00:00', '0000-00-00', 1, 5),
('141205a', '12', '00:00:00', '0000-00-00', 0, 0),
('14120ec', '12', '00:00:00', '0000-00-00', 0, 0),
('1412173', '12', '00:00:00', '0000-00-00', 0, 0),
('141232b', '12', '00:00:00', '0000-00-00', 0, 0),
('1412645', '12', '00:00:00', '0000-00-00', 2, 18),
('14126f7', '12', '00:00:00', '0000-00-00', 0, 0),
('141275b', '12', '00:00:00', '0000-00-00', 0, 0),
('14127c9', '12', '00:00:00', '0000-00-00', 0, 0),
('1412ac9', '12', '00:00:00', '0000-00-00', 0, 0),
('1412be9', '12', '00:00:00', '0000-00-00', 0, 0),
('1412cd9', '12', '00:00:00', '0000-00-00', 1, 9),
('1412d21', '12', '00:00:00', '0000-00-00', 0, 0),
('1412e46', '12', '00:00:00', '0000-00-00', 0, 0),
('1412f9f', '12', '00:00:00', '0000-00-00', 0, 0),
('1412fd4', '12', '00:00:00', '0000-00-00', 0, 0),
('151207e', '12', '00:00:00', '0000-00-00', 2, 26),
('1512092', '12', '00:00:00', '0000-00-00', 2, 21),
('S01230b', '12', '00:00:00', '0000-00-00', 1, 0),
('S0128a4', '12', '00:00:00', '0000-00-00', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id_role` tinyint(2) NOT NULL,
  `role_desc` tinytext,
  `admin_view` tinyint(2) NOT NULL DEFAULT '0',
  `tps_view` tinyint(2) NOT NULL DEFAULT '0',
  `user_view` tinyint(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id_role`, `role_desc`, `admin_view`, `tps_view`, `user_view`) VALUES
(1, 'AdminUser', 1, 0, 0),
(2, 'TPS Admin User', 0, 1, 0),
(3, 'Bilik User View', 0, 0, 1),
(77, 'Super Admin', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `token`
--

CREATE TABLE `token` (
  `token` char(7) NOT NULL,
  `tps` char(2) NOT NULL,
  `waktu` time NOT NULL,
  `hari` date NOT NULL,
  `flag` char(1) NOT NULL DEFAULT '0',
  `identifier_id` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `token`
--

INSERT INTO `token` (`token`, `tps`, `waktu`, `hari`, `flag`, `identifier_id`) VALUES
('1212522', '12', '00:22:46', '2015-11-24', '1', '12'),
('12125c6', '12', '05:37:21', '2016-05-06', '1', '12'),
('1312243', '12', '20:12:15', '2015-11-24', '1', '13'),
('131236a', '12', '10:17:13', '2015-11-25', '1', '13'),
('13124ac', '12', '20:10:23', '2015-11-24', '1', '13'),
('1312532', '12', '10:11:15', '2015-11-25', '1', '13'),
('1312e4a', '12', '10:18:46', '2015-11-25', '1', '13'),
('1312e8a', '12', '10:16:36', '2015-11-25', '1', '13'),
('1312ea9', '12', '10:06:46', '2015-11-25', '1', '13'),
('1312f0c', '12', '01:18:28', '2015-11-24', '1', '13'),
('1312f8a', '12', '00:23:10', '2015-11-24', '1', '13'),
('141205a', '12', '06:22:06', '2016-05-06', '1', '14'),
('14120ec', '12', '05:44:50', '2016-05-06', '1', '14'),
('1412173', '12', '09:46:20', '2015-11-25', '1', '14'),
('141232b', '12', '13:15:02', '2016-05-08', '1', '14'),
('1412645', '12', '21:06:58', '2015-11-24', '1', '14'),
('14126f7', '12', '09:48:25', '2015-11-25', '1', '14'),
('141275b', '12', '11:54:00', '2016-05-06', '1', '14'),
('14127c9', '12', '10:03:29', '2015-11-25', '1', '14'),
('1412ac9', '12', '11:56:55', '2015-11-25', '1', '14'),
('1412be9', '12', '09:45:33', '2015-11-25', '1', '14'),
('1412cd9', '12', '06:29:32', '2016-05-06', '1', '14'),
('1412d21', '12', '06:26:15', '2016-05-06', '1', '14'),
('1412e46', '12', '11:50:42', '2016-05-06', '1', '14'),
('1412f9f', '12', '06:23:33', '2016-05-06', '1', '14'),
('1412fd4', '12', '10:22:21', '2015-11-25', '1', '14'),
('151207e', '12', '00:23:52', '2015-11-24', '1', '15'),
('1512092', '12', '19:25:28', '2015-11-24', '1', '15'),
('S0120fe', '12', '00:09:33', '2015-11-24', '1', 'S0'),
('S012151', '12', '00:05:41', '2015-11-24', '1', 'S0'),
('S0122f8', '12', '00:17:35', '2015-11-24', '1', 'S0'),
('S01230b', '12', '00:27:14', '2015-11-24', '1', 'S0'),
('S0124a3', '12', '00:14:35', '2015-11-24', '1', 'S0'),
('S0128a4', '12', '21:08:06', '2015-11-24', '1', 'S0'),
('S0129a5', '12', '00:16:50', '2015-11-24', '1', 'S0'),
('S012fb9', '12', '00:08:39', '2015-11-24', '1', 'S0');

-- --------------------------------------------------------

--
-- Table structure for table `tps`
--

CREATE TABLE `tps` (
  `id_tps` int(11) NOT NULL,
  `no_TPS` varchar(10) NOT NULL,
  `lokasi` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id_admins`),
  ADD UNIQUE KEY `user_admins_UNIQUE` (`user_admins`);

--
-- Indexes for table `calon`
--
ALTER TABLE `calon`
  ADD PRIMARY KEY (`id_calon`);

--
-- Indexes for table `calon_identifier`
--
ALTER TABLE `calon_identifier`
  ADD PRIMARY KEY (`identifier_id`);

--
-- Indexes for table `log_login`
--
ALTER TABLE `log_login`
  ADD PRIMARY KEY (`id_log_login`);

--
-- Indexes for table `pilihan`
--
ALTER TABLE `pilihan`
  ADD PRIMARY KEY (`token`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indexes for table `token`
--
ALTER TABLE `token`
  ADD PRIMARY KEY (`token`);

--
-- Indexes for table `tps`
--
ALTER TABLE `tps`
  ADD PRIMARY KEY (`id_tps`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id_admins` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `calon`
--
ALTER TABLE `calon`
  MODIFY `id_calon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `log_login`
--
ALTER TABLE `log_login`
  MODIFY `id_log_login` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `tps`
--
ALTER TABLE `tps`
  MODIFY `id_tps` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
