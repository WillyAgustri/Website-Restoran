/*
SQLyog Community v13.1.6 (64 bit)
MySQL - 10.4.24-MariaDB : Database - restoran
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`restoran` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `restoran`;

/*Table structure for table `detail_pesanan` */

DROP TABLE IF EXISTS `detail_pesanan`;

CREATE TABLE `detail_pesanan` (
  `id_detail` int(10) NOT NULL AUTO_INCREMENT,
  `id_pesanan` int(10) NOT NULL,
  `id_pelanggan` int(10) NOT NULL,
  `tanggal` date NOT NULL,
  `total_pembayaran` int(20) NOT NULL,
  `total_pembelian` int(20) NOT NULL,
  `kembalian` int(10) NOT NULL,
  `status_pembayaran` enum('Terbayar','Belum Bayar') NOT NULL,
  PRIMARY KEY (`id_detail`),
  KEY `get_id_pelanggan` (`id_pelanggan`),
  KEY `get_id_pesanan` (`id_pesanan`),
  CONSTRAINT `get_id_pesanan` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan` (`id_pesanan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `detail_pesanan` */

/*Table structure for table `menu` */

DROP TABLE IF EXISTS `menu`;

CREATE TABLE `menu` (
  `id_menu` int(10) NOT NULL AUTO_INCREMENT,
  `nama_menu` varchar(70) DEFAULT NULL,
  `harga` int(15) DEFAULT NULL,
  `stok` int(10) DEFAULT NULL,
  PRIMARY KEY (`id_menu`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

/*Data for the table `menu` */

insert  into `menu`(`id_menu`,`nama_menu`,`harga`,`stok`) values 
(1,'Nasi Goreng',14000,12),
(2,'mie Goreng',15000,23),
(3,'Kepiting',23000,14);

/*Table structure for table `pelanggan` */

DROP TABLE IF EXISTS `pelanggan`;

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `user_role` enum('Admin','Karyawan','Pelanggan') NOT NULL,
  PRIMARY KEY (`id_pelanggan`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8mb4;

/*Data for the table `pelanggan` */

insert  into `pelanggan`(`id_pelanggan`,`username`,`nama`,`email`,`password`,`user_role`) values 
(63,'samuel','sam2','fda@gmail.com','adf','Admin'),
(70,'dsf','sdf','sdf','sdf','Pelanggan');

/*Table structure for table `pesanan` */

DROP TABLE IF EXISTS `pesanan`;

CREATE TABLE `pesanan` (
  `id_pesanan` int(10) NOT NULL AUTO_INCREMENT,
  `id_menu` int(10) DEFAULT NULL,
  `jumlah_pesanan` int(10) DEFAULT NULL,
  PRIMARY KEY (`id_pesanan`),
  KEY `get_id_menu` (`id_menu`),
  CONSTRAINT `get_id_menu` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id_menu`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `pesanan` */

insert  into `pesanan`(`id_pesanan`,`id_menu`,`jumlah_pesanan`) values 
(1,1,2),
(2,1,2);

/*Table structure for table `review_pelanggan` */

DROP TABLE IF EXISTS `review_pelanggan`;

CREATE TABLE `review_pelanggan` (
  `id_review` int(10) NOT NULL AUTO_INCREMENT,
  `ulasan` varchar(255) NOT NULL,
  `bintang_rating` int(10) NOT NULL,
  `id_pelanggan` int(10) DEFAULT NULL,
  PRIMARY KEY (`id_review`),
  KEY `id_pelanggan` (`id_pelanggan`)
) ENGINE=InnoDB AUTO_INCREMENT=402 DEFAULT CHARSET=utf8mb4;

/*Data for the table `review_pelanggan` */

/* Trigger structure for table `detail_pesanan` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `hitung_kembalian` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `hitung_kembalian` AFTER INSERT ON `detail_pesanan` FOR EACH ROW 
BEGIN
    DECLARE total_bayar INT;
    DECLARE total_pembelian INT;
    DECLARE kembalian INT;
    SELECT total_pembayaran, total_pembelian INTO total_bayar, total_pembelian FROM detail_pesanan WHERE id_detail = NEW.id_detail;
    SET kembalian = total_bayar - total_pembelian;
    UPDATE detail_pesanan SET kembalian = kembalian WHERE id_detail = NEW.id_detail;
END */$$


DELIMITER ;

/* Trigger structure for table `pelanggan` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `cek_update_admin` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `cek_update_admin` BEFORE UPDATE ON `pelanggan` FOR EACH ROW BEGIN
  DECLARE temp_user INT;
  SELECT count(id_pelanggan) INTO temp_user FROM pelanggan WHERE user_role = 'Admin';
  IF temp_user <1 THEN
    SIGNAL SQLSTATE '45000'
      SET MESSAGE_TEXT = 'Admin Harus ada 1!';
  END IF;
END */$$


DELIMITER ;

/* Trigger structure for table `pelanggan` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `cek_delete_admin` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `cek_delete_admin` BEFORE DELETE ON `pelanggan` FOR EACH ROW BEGIN
  DECLARE temp_user INT;
  SELECT count(id_pelanggan) INTO temp_user FROM pelanggan WHERE user_role = 'Admin';
  IF temp_user <= 1 THEN
    SIGNAL SQLSTATE '45000'
      SET MESSAGE_TEXT = 'Admin Harus ada 1!';
  END IF;
END */$$


DELIMITER ;

/* Trigger structure for table `pesanan` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `cek_stok` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `cek_stok` BEFORE INSERT ON `pesanan` FOR EACH ROW 
BEGIN
  DECLARE sisa_stok INT;
  SELECT stok INTO sisa_stok FROM menu WHERE id_menu = NEW.id_menu;
  IF sisa_stok < NEW.jumlah_pesanan THEN
    SIGNAL SQLSTATE '45000'
      SET MESSAGE_TEXT = 'Stok tidak mencukupi untuk pesanan ini';
  END IF;
END */$$


DELIMITER ;

/* Procedure structure for procedure `delete_menu` */

/*!50003 DROP PROCEDURE IF EXISTS  `delete_menu` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_menu`(IN menu_id INT)
BEGIN
  DELETE FROM menu WHERE id_menu = menu_id;
END */$$
DELIMITER ;

/* Procedure structure for procedure `delete_pelanggan` */

/*!50003 DROP PROCEDURE IF EXISTS  `delete_pelanggan` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_pelanggan`(in p_id_pelanggan INT)
BEGIN
  DELETE FROM pelanggan WHERE id_pelanggan = p_id_pelanggan;
END */$$
DELIMITER ;

/* Procedure structure for procedure `delete_pesanan` */

/*!50003 DROP PROCEDURE IF EXISTS  `delete_pesanan` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_pesanan`(IN id_pesanan INT)
BEGIN
  DELETE FROM pesanan WHERE id_pesanan = id_pesanan;
END */$$
DELIMITER ;

/* Procedure structure for procedure `hitung_menu` */

/*!50003 DROP PROCEDURE IF EXISTS  `hitung_menu` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `hitung_menu`()
BEGIN
  SELECT COUNT(id_menu) FROM menu ;
END */$$
DELIMITER ;

/* Procedure structure for procedure `hitung_role` */

/*!50003 DROP PROCEDURE IF EXISTS  `hitung_role` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `hitung_role`( in_role varchar(20))
BEGIN
  select count(id_pelanggan) as user_role from pelanggan where user_role = in_role;
END */$$
DELIMITER ;

/* Procedure structure for procedure `hitung_stok` */

/*!50003 DROP PROCEDURE IF EXISTS  `hitung_stok` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `hitung_stok`()
BEGIN
  SELECT sum(stok) FROM menu ;
END */$$
DELIMITER ;

/* Procedure structure for procedure `insert_menu` */

/*!50003 DROP PROCEDURE IF EXISTS  `insert_menu` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_menu`(
    IN p_nama_menu VARCHAR(255),
    IN p_harga INT,
    IN p_stok INT
)
BEGIN
	 INSERT INTO menu (nama_menu, harga, stok) VALUES (p_nama_menu, p_harga, p_stok);
	END */$$
DELIMITER ;

/* Procedure structure for procedure `insert_pelanggan` */

/*!50003 DROP PROCEDURE IF EXISTS  `insert_pelanggan` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_pelanggan`(
    IN p_username VARCHAR(255),
    IN p_nama varchar(255),
    IN p_email varchar(255),
    in p_password varchar(255),
    in p_user_role varchar(255)
)
BEGIN
	 INSERT INTO pelanggan (username, nama, email,password,user_role) VALUES (p_username, p_nama, p_email,p_password,p_user_role);
	END */$$
DELIMITER ;

/* Procedure structure for procedure `insert_pesanan` */

/*!50003 DROP PROCEDURE IF EXISTS  `insert_pesanan` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_pesanan`(
  IN p_id_menu INT,
  IN p_jumlah_pesanan INT
)
BEGIN
  INSERT INTO pesanan(id_menu, jumlah_pesanan)
  VALUES (p_id_menu, p_jumlah_pesanan);
END */$$
DELIMITER ;

/* Procedure structure for procedure `update_menu` */

/*!50003 DROP PROCEDURE IF EXISTS  `update_menu` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `update_menu`(
  IN p_id_menu INT,
  IN p_nama_menu VARCHAR(255),
  IN p_harga INT,
  IN p_stok INT
)
BEGIN
	  UPDATE menu
  SET nama_menu = p_nama_menu,
      harga = p_harga,
      stok = p_stok
  WHERE id_menu = p_id_menu;
	END */$$
DELIMITER ;

/* Procedure structure for procedure `update_pelanggan` */

/*!50003 DROP PROCEDURE IF EXISTS  `update_pelanggan` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `update_pelanggan`(
  in p_id_pelanggan int(10),
  IN p_username VARCHAR(255),
  IN p_nama varchar(40),
  IN p_email varchar(40),
  in p_password varchar(40),
  in p_user_role varchar(40)
)
BEGIN
  UPDATE pelanggan
  SET username = p_username,
      nama = p_nama,
      email = p_email,
      password = p_password,
      user_role = p_user_role
      
  WHERE id_pelanggan = p_id_pelanggan;
	END */$$
DELIMITER ;

/* Procedure structure for procedure `update_pesanan` */

/*!50003 DROP PROCEDURE IF EXISTS  `update_pesanan` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `update_pesanan`(
    IN id_pesanan_input INT,
    IN id_menu_input INT,
    IN jumlah_pesanan_input INT
)
BEGIN
    UPDATE pesanan 
    SET id_menu = id_menu_input, jumlah_pesanan = jumlah_pesanan_input
    WHERE id_pesanan = id_pesanan_input;
END */$$
DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
