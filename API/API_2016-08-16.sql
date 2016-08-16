# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.51)
# Database: API
# Generation Time: 2016-08-16 07:49:31 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table User
# ------------------------------------------------------------

DROP TABLE IF EXISTS `User`;

CREATE TABLE `User` (
  `user_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_account` varchar(255) DEFAULT '',
  `user_password` varchar(255) DEFAULT '',
  `user_email` varchar(255) DEFAULT '',
  `user_phone` varchar(25) DEFAULT NULL,
  `user_address` varchar(255) DEFAULT NULL,
  `user_name` varchar(30) DEFAULT NULL,
  `user_token` varchar(255) DEFAULT '',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `User` WRITE;
/*!40000 ALTER TABLE `User` DISABLE KEYS */;

INSERT INTO `User` (`user_id`, `user_account`, `user_password`, `user_email`, `user_phone`, `user_address`, `user_name`, `user_token`)
VALUES
	(6,'Leo','aabb1122','swingman1125@gmail.com','0912614572','é•·æ¦®è·¯ä¸€æ®µ100è™Ÿ','Mars',''),
	(7,'Array[account]','aabb1122','swingman1125@gmail.com','0912614572','é•·æ¦®è·¯ä¸€æ®µ100è™Ÿ','Mars',''),
	(8,'Leo','aabb1122','swingman1125@gmail.com','0912614572','é•·æ¦®è·¯ä¸€æ®µ100è™Ÿ','Mars',''),
	(9,'Leo','aabb1122','swingman1125@gmail.com','0912614572','長榮路一段100號','Mars','');

/*!40000 ALTER TABLE `User` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
