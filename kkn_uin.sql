/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 10.4.27-MariaDB : Database - kkn_uin
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`kkn_uin` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `kkn_uin`;

/*Table structure for table `kkn_daftar` */

DROP TABLE IF EXISTS `kkn_daftar`;

CREATE TABLE `kkn_daftar` (
  `kode_kkn_daftar` int(11) NOT NULL AUTO_INCREMENT,
  `kode_tahapan` int(11) DEFAULT NULL,
  `kode_mahasiswa` int(11) DEFAULT NULL,
  `kode_tkk_daftar` int(11) DEFAULT NULL,
  `nama_keluarga` varchar(50) DEFAULT NULL,
  `hubungan` varchar(25) DEFAULT NULL,
  `notelp` varchar(20) DEFAULT NULL,
  `status_persetujuan` varchar(1) DEFAULT NULL,
  `file_pasfoto` varchar(100) DEFAULT NULL,
  `file_mahaad` varchar(100) DEFAULT NULL,
  `file_transkrip` varchar(100) DEFAULT NULL,
  `file_sempro` varchar(100) DEFAULT NULL,
  `status_aktif` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`kode_kkn_daftar`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `kkn_daftar` */

/*Table structure for table `kkn_master_desa` */

DROP TABLE IF EXISTS `kkn_master_desa`;

CREATE TABLE `kkn_master_desa` (
  `kode_desa` int(11) NOT NULL AUTO_INCREMENT,
  `kode_kecamatan` int(11) DEFAULT NULL,
  `nama_desa` varchar(50) DEFAULT NULL,
  `rt` varchar(3) DEFAULT NULL,
  `nama_ketua` varchar(50) DEFAULT NULL,
  `notelp` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`kode_desa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `kkn_master_desa` */

/*Table structure for table `kkn_master_kabupaten` */

DROP TABLE IF EXISTS `kkn_master_kabupaten`;

CREATE TABLE `kkn_master_kabupaten` (
  `kode_kabupaten` int(11) NOT NULL AUTO_INCREMENT,
  `kode_provinsi` int(11) DEFAULT NULL,
  `nama_kabupaten` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`kode_kabupaten`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `kkn_master_kabupaten` */

/*Table structure for table `kkn_master_kecamatan` */

DROP TABLE IF EXISTS `kkn_master_kecamatan`;

CREATE TABLE `kkn_master_kecamatan` (
  `kode_kecamatan` int(11) NOT NULL AUTO_INCREMENT,
  `kode_kabupaten` int(11) DEFAULT NULL,
  `nama_kecamatan` varchar(50) DEFAULT NULL,
  `nama_camat` varchar(50) DEFAULT NULL,
  `notelp` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`kode_kecamatan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `kkn_master_kecamatan` */

/*Table structure for table `kkn_master_negara` */

DROP TABLE IF EXISTS `kkn_master_negara`;

CREATE TABLE `kkn_master_negara` (
  `kode_negara` int(11) NOT NULL AUTO_INCREMENT,
  `nama_negara` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`kode_negara`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `kkn_master_negara` */

/*Table structure for table `kkn_master_provinsi` */

DROP TABLE IF EXISTS `kkn_master_provinsi`;

CREATE TABLE `kkn_master_provinsi` (
  `kode_provinsi` int(11) NOT NULL AUTO_INCREMENT,
  `kode_negara` int(11) DEFAULT NULL,
  `nama_provinsi` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`kode_provinsi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `kkn_master_provinsi` */

/*Table structure for table `kkn_master_tahap` */

DROP TABLE IF EXISTS `kkn_master_tahap`;

CREATE TABLE `kkn_master_tahap` (
  `kode_kkn_tahap` int(11) NOT NULL AUTO_INCREMENT,
  `jenis_kkn` varchar(20) DEFAULT NULL,
  `tahap_ke` int(11) DEFAULT NULL,
  `kode_semester` int(11) DEFAULT NULL,
  `waktu_pembukaan` datetime DEFAULT NULL,
  `waktu_penutupan` datetime DEFAULT NULL,
  `status_aktif` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`kode_kkn_tahap`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `kkn_master_tahap` */

insert  into `kkn_master_tahap`(`kode_kkn_tahap`,`jenis_kkn`,`tahap_ke`,`kode_semester`,`waktu_pembukaan`,`waktu_penutupan`,`status_aktif`) values 
(1,'Tematik',1,1,'2023-12-25 00:00:00','2023-12-27 23:59:00','1'),
(2,'Tematik',2,1,'2023-12-28 00:00:00','2023-12-29 23:59:00','0');

/*Table structure for table `master_dosen` */

DROP TABLE IF EXISTS `master_dosen`;

CREATE TABLE `master_dosen` (
  `kode_dosen` int(11) NOT NULL AUTO_INCREMENT,
  `nidn` varchar(10) DEFAULT NULL,
  `nip` varchar(15) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `jabatan` varchar(50) DEFAULT NULL,
  `notelp` varchar(20) DEFAULT NULL,
  `jk` varchar(1) DEFAULT NULL,
  `status_aktif` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`kode_dosen`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `master_dosen` */

/*Table structure for table `master_mahasiswa` */

DROP TABLE IF EXISTS `master_mahasiswa`;

CREATE TABLE `master_mahasiswa` (
  `kode_mahasiswa` int(11) NOT NULL AUTO_INCREMENT,
  `nim` varchar(20) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `fakultas` varchar(50) DEFAULT NULL,
  `prodi` varchar(50) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `notelp` varchar(20) DEFAULT NULL,
  `jk` varchar(1) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL,
  `status_aktif` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`kode_mahasiswa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `master_mahasiswa` */

/*Table structure for table `master_semester` */

DROP TABLE IF EXISTS `master_semester`;

CREATE TABLE `master_semester` (
  `kode_semester` int(11) NOT NULL AUTO_INCREMENT,
  `semester_akademik` varchar(10) DEFAULT NULL,
  `semester` varchar(7) DEFAULT NULL,
  `tahun_akademik` varchar(10) DEFAULT NULL,
  `status_aktif` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`kode_semester`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `master_semester` */

insert  into `master_semester`(`kode_semester`,`semester_akademik`,`semester`,`tahun_akademik`,`status_aktif`) values 
(1,'20231','Ganjil','2023/2024','1'),
(2,'20232','Genap','2023/2024','0'),
(5,'20241','Ganjil','2024/2025','0'),
(6,'20242','Genap','2024/2025','0');

/*Table structure for table `master_user` */

DROP TABLE IF EXISTS `master_user`;

CREATE TABLE `master_user` (
  `kode_user` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL,
  `status_aktif` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`kode_user`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `master_user` */

insert  into `master_user`(`kode_user`,`nama`,`email`,`password`,`status_aktif`) values 
(1,'M. Robi Dinnoor','robidinnoor@uin-antasari.ac.id','$2y$10$lfopBwtjhbGS9jbCSx3ikO7YMEgPo6zTz2SNVoogP0zEGuImDNeim','0'),
(2,'MUHAMMAD ROBI DINNOOR','robidinnoor1992@gmail.com','$2y$10$LVJIem3WbKoCOGnueQ4lDOy/rkmwIe0Kb9mUjzcKC1ImtDIfUmQIG','1'),
(3,'Muhammad Fajar Maulana','briar_bulldog@yahoo.com','$2y$10$LVJIem3WbKoCOGnueQ4lDOy/rkmwIe0Kb9mUjzcKC1ImtDIfUmQIG','1');

/*Table structure for table `tkk_daftar` */

DROP TABLE IF EXISTS `tkk_daftar`;

CREATE TABLE `tkk_daftar` (
  `kode_tkk_daftar` int(11) NOT NULL AUTO_INCREMENT,
  `kode_tkk_tahap` int(11) DEFAULT NULL,
  `kode_mahasiswa` int(11) DEFAULT NULL,
  `kode_dosen` int(11) DEFAULT NULL,
  `tanggal_daftar` datetime DEFAULT NULL,
  `status_lulus` varchar(5) DEFAULT NULL,
  `nilai_n1` float DEFAULT NULL,
  `no_sertifikat` varchar(20) DEFAULT NULL,
  `tanggal_expired` datetime DEFAULT NULL,
  `status_aktif` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`kode_tkk_daftar`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tkk_daftar` */

/*Table structure for table `tkk_master_tahap` */

DROP TABLE IF EXISTS `tkk_master_tahap`;

CREATE TABLE `tkk_master_tahap` (
  `kode_tkk_tahap` int(11) NOT NULL AUTO_INCREMENT,
  `kode_semester` int(11) DEFAULT NULL,
  `tahap_ke` int(11) DEFAULT NULL,
  `waktu_pembukaan` datetime DEFAULT NULL,
  `waktu_penutupan` datetime DEFAULT NULL,
  `status_aktif` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`kode_tkk_tahap`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tkk_master_tahap` */

insert  into `tkk_master_tahap`(`kode_tkk_tahap`,`kode_semester`,`tahap_ke`,`waktu_pembukaan`,`waktu_penutupan`,`status_aktif`) values 
(1,1,1,'2023-12-14 00:00:00','2023-12-16 23:59:00','1'),
(2,1,2,'2023-12-17 00:00:00','2023-12-18 23:59:00','0'),
(3,2,1,'2023-12-19 00:00:00','2023-12-20 23:59:00','0'),
(4,2,2,'2023-12-21 00:05:00','2023-12-24 23:59:00','0'),
(6,2,3,'2023-12-25 00:00:00','2023-12-26 23:59:00','0');

/*Table structure for table `view_kkn_master_tahap` */

DROP TABLE IF EXISTS `view_kkn_master_tahap`;

/*!50001 DROP VIEW IF EXISTS `view_kkn_master_tahap` */;
/*!50001 DROP TABLE IF EXISTS `view_kkn_master_tahap` */;

/*!50001 CREATE TABLE  `view_kkn_master_tahap`(
 `kode_kkn_tahap` int(11) ,
 `jenis_kkn` varchar(20) ,
 `tahap_ke` int(11) ,
 `waktu_pembukaan` datetime ,
 `waktu_penutupan` datetime ,
 `status_aktif_tahapan_kkn` varchar(1) ,
 `kode_semester` int(11) ,
 `semester_akademik` varchar(10) ,
 `semester` varchar(7) ,
 `tahun_akademik` varchar(10) ,
 `status_aktif_semester` varchar(1) 
)*/;

/*Table structure for table `view_tkk_master_tahap` */

DROP TABLE IF EXISTS `view_tkk_master_tahap`;

/*!50001 DROP VIEW IF EXISTS `view_tkk_master_tahap` */;
/*!50001 DROP TABLE IF EXISTS `view_tkk_master_tahap` */;

/*!50001 CREATE TABLE  `view_tkk_master_tahap`(
 `kode_tkk_tahap` int(11) ,
 `tahap_ke` int(11) ,
 `waktu_pembukaan` datetime ,
 `waktu_penutupan` datetime ,
 `status_aktif_tahapan_tkk` varchar(1) ,
 `kode_semester` int(11) ,
 `semester_akademik` varchar(10) ,
 `semester` varchar(7) ,
 `tahun_akademik` varchar(10) ,
 `status_aktif_semester` varchar(1) 
)*/;

/*View structure for view view_kkn_master_tahap */

/*!50001 DROP TABLE IF EXISTS `view_kkn_master_tahap` */;
/*!50001 DROP VIEW IF EXISTS `view_kkn_master_tahap` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_kkn_master_tahap` AS select `kkn_master_tahap`.`kode_kkn_tahap` AS `kode_kkn_tahap`,`kkn_master_tahap`.`jenis_kkn` AS `jenis_kkn`,`kkn_master_tahap`.`tahap_ke` AS `tahap_ke`,`kkn_master_tahap`.`waktu_pembukaan` AS `waktu_pembukaan`,`kkn_master_tahap`.`waktu_penutupan` AS `waktu_penutupan`,`kkn_master_tahap`.`status_aktif` AS `status_aktif_tahapan_kkn`,`master_semester`.`kode_semester` AS `kode_semester`,`master_semester`.`semester_akademik` AS `semester_akademik`,`master_semester`.`semester` AS `semester`,`master_semester`.`tahun_akademik` AS `tahun_akademik`,`master_semester`.`status_aktif` AS `status_aktif_semester` from (`master_semester` join `kkn_master_tahap` on(`master_semester`.`kode_semester` = `kkn_master_tahap`.`kode_semester`)) */;

/*View structure for view view_tkk_master_tahap */

/*!50001 DROP TABLE IF EXISTS `view_tkk_master_tahap` */;
/*!50001 DROP VIEW IF EXISTS `view_tkk_master_tahap` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_tkk_master_tahap` AS select `tkk_master_tahap`.`kode_tkk_tahap` AS `kode_tkk_tahap`,`tkk_master_tahap`.`tahap_ke` AS `tahap_ke`,`tkk_master_tahap`.`waktu_pembukaan` AS `waktu_pembukaan`,`tkk_master_tahap`.`waktu_penutupan` AS `waktu_penutupan`,`tkk_master_tahap`.`status_aktif` AS `status_aktif_tahapan_tkk`,`master_semester`.`kode_semester` AS `kode_semester`,`master_semester`.`semester_akademik` AS `semester_akademik`,`master_semester`.`semester` AS `semester`,`master_semester`.`tahun_akademik` AS `tahun_akademik`,`master_semester`.`status_aktif` AS `status_aktif_semester` from (`master_semester` join `tkk_master_tahap` on(`master_semester`.`kode_semester` = `tkk_master_tahap`.`kode_semester`)) */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
