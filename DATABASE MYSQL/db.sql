/*
SQLyog Community v13.1.5  (64 bit)
MySQL - 10.4.11-MariaDB : Database - u1657744_spk_kredit_koperasi_kopcingkwa
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`u1657744_spk_kredit_koperasi_kopcingkwa` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `u1657744_spk_kredit_koperasi_kopcingkwa`;

/*Table structure for table `tb_alternatif` */

DROP TABLE IF EXISTS `tb_alternatif`;

CREATE TABLE `tb_alternatif` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_alternatif` varchar(10) DEFAULT NULL,
  `id_debitur` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_alternatif` */

insert  into `tb_alternatif`(`id`,`kode_alternatif`,`id_debitur`) values 
(1,'A1',1),
(2,'A2',2);

/*Table structure for table `tb_bobot_kriteria` */

DROP TABLE IF EXISTS `tb_bobot_kriteria`;

CREATE TABLE `tb_bobot_kriteria` (
  `key` varchar(100) DEFAULT NULL,
  `value` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_bobot_kriteria` */

insert  into `tb_bobot_kriteria`(`key`,`value`) values 
('c1','0.19'),
('c2','0.17'),
('c3','0.16'),
('c4','0.14'),
('c5','0.10'),
('c6','0.13'),
('c7','0.11');

/*Table structure for table `tb_debitur` */

DROP TABLE IF EXISTS `tb_debitur`;

CREATE TABLE `tb_debitur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_debitur` varchar(100) DEFAULT NULL,
  `nama_debitur` varchar(100) DEFAULT NULL,
  `alamat_debitur` varchar(100) DEFAULT NULL,
  `telepon` varchar(15) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` varchar(20) DEFAULT NULL,
  `pekerjaan` varchar(20) DEFAULT NULL,
  `id_pengguna` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_debitur` */

insert  into `tb_debitur`(`id`,`id_debitur`,`nama_debitur`,`alamat_debitur`,`telepon`,`tanggal_lahir`,`jenis_kelamin`,`pekerjaan`,`id_pengguna`) values 
(1,'DB00001','Komang Ayu Laksmi','Gianyar','081999897333','2000-01-13','L','Swasta',3),
(2,'DB00002','Nengah Suantra','Bedulu, Gianyar','081999897123','1998-01-20','P','PNS',4);

/*Table structure for table `tb_hasil` */

DROP TABLE IF EXISTS `tb_hasil`;

CREATE TABLE `tb_hasil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pinjaman` varchar(20) DEFAULT NULL,
  `alternatif` varchar(20) DEFAULT NULL,
  `c1` varchar(20) DEFAULT NULL,
  `c2` varchar(20) DEFAULT NULL,
  `c3` varchar(20) DEFAULT NULL,
  `c4` varchar(20) DEFAULT NULL,
  `c5` varchar(20) DEFAULT NULL,
  `c6` varchar(20) DEFAULT NULL,
  `c7` varchar(20) DEFAULT NULL,
  `hasil_akhir` varchar(20) DEFAULT NULL,
  `keputusan` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_hasil` */

/*Table structure for table `tb_hasil_normalisasi` */

DROP TABLE IF EXISTS `tb_hasil_normalisasi`;

CREATE TABLE `tb_hasil_normalisasi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pinjaman` varchar(20) DEFAULT NULL,
  `alternatif` varchar(10) DEFAULT NULL,
  `c1` varchar(20) DEFAULT NULL,
  `c2` varchar(20) DEFAULT NULL,
  `c3` varchar(20) DEFAULT NULL,
  `c4` varchar(20) DEFAULT NULL,
  `c5` varchar(20) DEFAULT NULL,
  `c6` varchar(20) DEFAULT NULL,
  `c7` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_hasil_normalisasi` */

/*Table structure for table `tb_kriteria` */

DROP TABLE IF EXISTS `tb_kriteria`;

CREATE TABLE `tb_kriteria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_kriteria` varchar(20) DEFAULT NULL,
  `nama_kriteria` varchar(100) DEFAULT NULL,
  `bobot` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_kriteria` */

insert  into `tb_kriteria`(`id`,`kode_kriteria`,`nama_kriteria`,`bobot`) values 
(1,'C1','Jumlah Pinjaman','0.19'),
(2,'C2','Jangka Waktu','0.17'),
(3,'C3','Jaminan','0.16'),
(4,'C4','Pendapatan Perbulan','0.14'),
(5,'C5','Riawayat Meminjam','0.10'),
(6,'C6','Pekerjaan','0.13'),
(7,'C7','Jenis Pinjaman','0.11');

/*Table structure for table `tb_pengguna` */

DROP TABLE IF EXISTS `tb_pengguna`;

CREATE TABLE `tb_pengguna` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pengguna` varchar(20) DEFAULT NULL,
  `nama` varchar(250) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `jabatan` varchar(15) DEFAULT NULL,
  `jenis_kelamin` varchar(15) DEFAULT NULL,
  `telepon` varchar(15) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_pengguna` */

insert  into `tb_pengguna`(`id`,`id_pengguna`,`nama`,`username`,`password`,`jabatan`,`jenis_kelamin`,`telepon`,`alamat`) values 
(1,'U001','I Nyoman Antara','admin','$2y$10$NQDDRFAV0dG7gfCZROtq8OXNhGdvZN7hsl25Xs96n3cl2s39djK2.','Admin','L','081999897555','Gianyar'),
(2,'U002','Wayan Sueca','ketua','$2y$10$MAD6CIaVyfTG2kvivAiSQej9Kejrck/O0PTaxiZZ32WiHNPQHOhAa','Ketua','L','081999897123','Tabanan'),
(3,'U003','Komang Ayu Laksmi','laksmi','$2y$10$UxEt6JlaBuX2v/4lVbApYOreVNJ5qdVJdrd6vtLF1CIsg4qhucyT.','Debitur','L','081999897333','Gianyar'),
(4,'U004','Nengah Suantra','suantra','$2y$10$uAYmQHGal3cKPMJiHt2QPu4qZ1cffP9hJVNut3eXjHn22EUunSrSC','Debitur','P','081999897123','Bedulu, Gianyar');

/*Table structure for table `tb_pinjaman` */

DROP TABLE IF EXISTS `tb_pinjaman`;

CREATE TABLE `tb_pinjaman` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pinjaman` varchar(20) DEFAULT NULL,
  `id_alternatif` int(11) DEFAULT NULL,
  `tanggal_pinjaman` date DEFAULT NULL,
  `jaminan` varchar(100) DEFAULT NULL,
  `jumlah_pinjaman` varchar(100) DEFAULT NULL,
  `pekerjaan` varchar(100) DEFAULT NULL,
  `jenis_pinjaman` varchar(100) DEFAULT NULL,
  `pendapatan_perbulan` varchar(100) DEFAULT NULL,
  `riwayat_meminjam` varchar(100) DEFAULT NULL,
  `jangka_waktu` varchar(100) DEFAULT NULL,
  `sudah_proses` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_pinjaman` */

insert  into `tb_pinjaman`(`id`,`id_pinjaman`,`id_alternatif`,`tanggal_pinjaman`,`jaminan`,`jumlah_pinjaman`,`pekerjaan`,`jenis_pinjaman`,`pendapatan_perbulan`,`riwayat_meminjam`,`jangka_waktu`,`sudah_proses`) values 
(1,'PNJ000001',1,'2022-04-14','10','2','21','25','14','20','5',0),
(2,'PNJ000002',2,'2022-04-15','10','3','23','24','14','18','8',0);

/*Table structure for table `tb_sub_kriteria` */

DROP TABLE IF EXISTS `tb_sub_kriteria`;

CREATE TABLE `tb_sub_kriteria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_kriteria` varchar(20) DEFAULT NULL,
  `nama_sub_kriteria` varchar(100) DEFAULT NULL,
  `nilai` float DEFAULT NULL,
  `bobot` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_sub_kriteria` */

insert  into `tb_sub_kriteria`(`id`,`kode_kriteria`,`nama_sub_kriteria`,`nilai`,`bobot`) values 
(1,'C1','500 Ribu s/d 1 Juta',10,'0.1'),
(2,'C1','Lebih dari 1 Juta s/d 10 Juta',20,'0.2'),
(3,'C1','Lebih dari 10 Juta s/d 50 Juta',30,'0.3'),
(4,'C1','Lebih dari 50 Juta',40,'0.4'),
(5,'C2','6 bulan s/d 12 bulan',10,'0.1'),
(6,'C2','Lebih dari 12 bulan s/d 18 bulan',20,'0.2'),
(7,'C2','Lebih dari 18 bulan s/d 24 bulan',30,'0.3'),
(8,'C2','Lebih dari 24 bulan s/d 60 bulan',40,'0.4'),
(9,'C3','1 juta s/d 10 juta',10,'0.1'),
(10,'C3','Lebih dari 10 juta s/d 100 juta',20,'0.2'),
(11,'C3','Lebih dari 100 juta s/d 500 juta',30,'0.3'),
(12,'C3','Lebih dari 500 juta',40,'0.4'),
(13,'C4','1 juta s/d 2 juta',5,'0.05'),
(14,'C4','Lebih dari 2 juta s/d 5 juta',12.5,'0.125'),
(15,'C4','Lebih dari 5 juta s/d 10 juta',20,'0.2'),
(16,'C4','Lebih dari 10 juta s/d 20 juta',27.5,'0.275'),
(17,'C4','Lebih dari 20 jut',35,'0.35'),
(18,'C5','Belum Pernah',40,'0.4'),
(19,'C5','Pernah Lancar',50,'0.5'),
(20,'C5','Pernah Macet',10,'0.1'),
(21,'C6','PNS',30,'0.3'),
(22,'C6','Swasta',20,'0.2'),
(23,'C6','Pengusaha',50,'0.5'),
(24,'C7','Modal Usaha',70,'0.7'),
(25,'C7','Konsumtif',30,'0.3');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
