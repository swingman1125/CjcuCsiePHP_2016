# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.51)
# Database: ApiSampleDatabase
# Generation Time: 2016-08-25 07:41:37 +0000
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
  `user_name` varchar(50) NOT NULL DEFAULT '',
  `user_password` varchar(50) DEFAULT '',
  `user_email` varchar(100) NOT NULL DEFAULT '',
  `user_photo` varchar(50) NOT NULL DEFAULT '',
  `user_created_time` datetime NOT NULL,
  `user_updated_time` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `User` WRITE;
/*!40000 ALTER TABLE `User` DISABLE KEYS */;

INSERT INTO `User` (`user_id`, `user_name`, `user_password`, `user_email`, `user_photo`, `user_created_time`, `user_updated_time`)
VALUES
	(11,'aaa','kobe0725','bbb@gmail.com','57be8d51058a3.png','2016-08-25 08:14:07',NULL),
	(10,'Leo','aabb1122','aaa@gmail.com','57be8d51058a3.png','2016-08-25 08:12:15',NULL),
	(9,'Leo','aabb1122','aaa@gmail.com','12_124141312312.jpg','2016-08-25 06:03:34','2016-08-25 09:40:03');

/*!40000 ALTER TABLE `User` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table User_Token
# ------------------------------------------------------------

DROP TABLE IF EXISTS `User_Token`;

CREATE TABLE `User_Token` (
  `user_token_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_token` varchar(100) NOT NULL DEFAULT '',
  `user_id` int(11) NOT NULL,
  `user_token_created_time` datetime NOT NULL,
  `user_token_updated_time` datetime DEFAULT NULL,
  PRIMARY KEY (`user_token_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `User_Token` WRITE;
/*!40000 ALTER TABLE `User_Token` DISABLE KEYS */;

INSERT INTO `User_Token` (`user_token_id`, `user_token`, `user_id`, `user_token_created_time`, `user_token_updated_time`)
VALUES
	(1,'lPsWQin6FF5JREBku5ZqFuvhhYA=',9,'2016-08-25 06:03:34',NULL),
	(2,'vNzkg5ix5/a7+8cNZZGyF9mfxpY=',10,'2016-08-25 08:12:15',NULL),
	(3,'zHKH16sEkoVoWGS0oZrRqQ94qVQ=',11,'2016-08-25 08:14:07',NULL);

/*!40000 ALTER TABLE `User_Token` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
