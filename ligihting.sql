/*
SQLyog Ultimate v12.14 (64 bit)
MySQL - 10.4.17-MariaDB : Database - lighting_system
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`lighting_system` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `lighting_system`;

/*Table structure for table `doors` */

DROP TABLE IF EXISTS `doors`;

CREATE TABLE `doors` (
  `door_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rfid` varchar(50) DEFAULT NULL,
  `door_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`door_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `doors` */

insert  into `doors`(`door_id`,`rfid`,`door_name`) values 
(1,'1234','DOOR001'),
(2,'5647','DOOR002');

/*Table structure for table `schedules` */

DROP TABLE IF EXISTS `schedules`;

CREATE TABLE `schedules` (
  `schedule_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `door_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `schedule_name` varchar(50) DEFAULT NULL,
  `datetime_from` datetime DEFAULT NULL,
  `datetime_to` datetime DEFAULT NULL,
  PRIMARY KEY (`schedule_id`),
  KEY `door_id` (`door_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `schedules_ibfk_1` FOREIGN KEY (`door_id`) REFERENCES `doors` (`door_id`),
  CONSTRAINT `schedules_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `schedules` */

insert  into `schedules`(`schedule_id`,`door_id`,`user_id`,`schedule_name`,`datetime_from`,`datetime_to`) values 
(1,1,2,'TEST SCHEDULE','2021-04-17 12:52:11','2021-04-17 12:52:11'),
(2,2,2,'2ND SCHEDULE','2021-04-17 09:00:00','2021-04-17 10:00:00');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `lname` varchar(50) DEFAULT NULL,
  `fname` varchar(50) DEFAULT NULL,
  `mname` varchar(50) DEFAULT NULL,
  `sex` varchar(50) DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

/*Data for the table `users` */

insert  into `users`(`user_id`,`username`,`password`,`lname`,`fname`,`mname`,`sex`,`role`) values 
(1,'admin','a','dela cruz','juan',NULL,'male','ADMIN'),
(2,'user01','a','amparado','etienne',NULL,'MALE','USER'),
(10,'admin-x',NULL,'Charles Burton','Alana Harmon','Nola Potter','FEMALE','ADMINISTRATOR'),
(11,'testsss',NULL,'Charles Burton','Alana Harmon','Nola Potter','MALE','ADMINISTRATOR');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
