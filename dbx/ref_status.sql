/*
SQLyog Ultimate
MySQL - 10.1.34-MariaDB : Database - absensi_dagri
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `absence` */

DROP TABLE IF EXISTS `absence`;

CREATE TABLE `absence` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `status_kategori_id` smallint(6) DEFAULT NULL,
  `abid` varchar(10) NOT NULL,
  `abname` varchar(200) NOT NULL,
  `state` tinyint(4) NOT NULL DEFAULT '1',
  `kd_ula` smallint(6) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `create_by` varchar(30) DEFAULT NULL,
  `modif_date` datetime DEFAULT NULL,
  `modif_by` varchar(30) DEFAULT NULL,
  `value` float DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `abid_idx` (`abid`) USING BTREE,
  KEY `abname` (`abname`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

/*Data for the table `absence` */

insert  into `absence`(`id`,`status_kategori_id`,`abid`,`abname`,`state`,`kd_ula`,`create_date`,`create_by`,`modif_date`,`modif_by`,`value`) values 
(1,3,'AB_1','Izin Sakit',0,NULL,'2014-03-20 10:09:50','admin','2018-01-30 01:02:17','superesidik',1),
(7,3,'AB_2','Sakit Akibat Kecelakaan Dalam Tugas',0,NULL,'2014-06-04 16:46:25','admin','2018-01-30 01:02:25','superesidik',0),
(8,11,'AB_3','Cuti Tahunan',1,11,'2014-06-04 16:46:37','admin','2017-07-27 12:25:19','krisnu',0),
(9,17,'AB_4','Cuti Melahirkan Anak Ke-1 sampai dengan Anak ke-3 ',1,17,'2014-06-04 16:47:10','admin','2018-01-30 01:05:02','superesidik',0),
(10,7,'AB_5','Cuti Bersalin Anak Ke-3 Dst',0,NULL,'2014-06-04 16:47:32','admin','2018-01-30 01:03:12','superesidik',0),
(11,10,'AB_6','Cuti Sakit',1,NULL,'2014-06-04 16:47:50','admin','2017-07-27 12:40:37','krisnu',0),
(12,8,'AB_7','Cuti Besar',1,8,'2014-06-04 16:48:02','admin','2017-07-27 12:25:47','krisnu',0),
(13,9,'AB_8','CLTN/MPP',1,9,'2014-06-04 16:48:18','admin','2018-06-21 03:42:04','aribi',0),
(16,1,'AB_11','Ijin Tidak Masuk Kerja Dengan Alasan Sah',0,NULL,'2014-06-04 16:49:39','admin','2018-01-30 01:05:17','superesidik',1.5),
(17,12,'AB_12','Pembatalan Absensi',1,NULL,'2014-06-04 16:50:20','admin','2017-07-27 12:30:23','krisnu',5),
(18,6,'AB_13','Penugasan Dari Pimpinan (Dalam / Luar Negeri)',1,NULL,'2014-06-04 16:53:06','admin','2017-07-27 12:31:32','krisnu',0),
(19,2,'AB_14','Cuti Alasan Penting',1,2,'2014-07-08 13:19:08','admin','2017-07-27 12:29:52','krisnu',0),
(20,14,'AB_15','Pendidikan dan Pelatihan',1,NULL,'2014-07-21 15:19:56','admin','2017-07-27 12:33:46','krisnu',0),
(24,4,'AB_16','Tugas Belajar',1,NULL,'2014-08-14 19:26:14','admin','2017-07-27 12:29:31','krisnu',0),
(26,12,'AB_18','Meninggal',1,NULL,'2015-05-07 12:52:12','admin','2017-07-27 12:29:23','krisnu',5),
(27,12,'AB_19','DPK',1,NULL,'2015-05-07 13:00:27','admin','2017-07-27 12:28:59','krisnu',5),
(28,12,'AB_20','Cuti Bersama',1,NULL,'2017-04-21 17:11:52','admin','2018-01-30 01:06:39','superesidik',0);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
