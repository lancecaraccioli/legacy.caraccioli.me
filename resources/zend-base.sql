/*
SQLyog Community Edition- MySQL GUI v8.03 
MySQL - 5.1.30-community : Database - db_zendbase
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

USE `db_zendbase`;

/*Table structure for table `album` */

DROP TABLE IF EXISTS `album`;

CREATE TABLE `album` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cover_photo_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `album` */

insert  into `album`(`id`,`cover_photo_id`,`name`,`description`,`created_at`,`updated_at`) values (1,0,'New Album','Test','2009-07-14 16:36:51','2009-07-14 16:36:51');

/*Table structure for table `contact_request` */

DROP TABLE IF EXISTS `contact_request`;

CREATE TABLE `contact_request` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `last_name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `address_line_1` varchar(255) CHARACTER SET latin1 NOT NULL,
  `address_line_2` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `city` varchar(255) CHARACTER SET latin1 NOT NULL,
  `state` varchar(255) CHARACTER SET latin1 NOT NULL,
  `zip` varchar(255) CHARACTER SET latin1 NOT NULL,
  `country` varchar(255) CHARACTER SET latin1 NOT NULL,
  `phone` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `email` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `comments` text CHARACTER SET latin1,
  `deleted` char(1) CHARACTER SET latin1 NOT NULL DEFAULT '0',
  `updated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

/*Data for the table `contact_request` */

/*Table structure for table `content` */

DROP TABLE IF EXISTS `content`;

CREATE TABLE `content` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `content` text CHARACTER SET latin1,
  `slug` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

/*Data for the table `content` */

insert  into `content`(`id`,`title`,`content`,`slug`,`created`,`updated`,`deleted_at`) values (1,'Home','<div id=\\\\\\\"home\\\\\\\">\r\n  <h1>Benefits:</h1>\r\n  <p>Learn the steps needed to obtain a career in one of the most sought after industries\r\n   in America.</p>\r\n \r\n  <p>Learn from industry leaders who earn 100K - 260K per year in this exciting industry ...\r\n   plus company car, expense account, outstanding benefits package, and more. </p>\r\n\r\n  <h1>What You Will Learn:</h1>\r\n   <ul>\r\n       <li>How to get an interview</li>\r\n       <li>Create a resume to set yourself apart</li>\r\n       <li>Interviewing skills</li>\r\n       <li>What pharmaceutical companies are looking for</li>\r\n       <li>How to position yourself for success</li>\r\n       <li>Get on the inside  track</li>\r\n    </ul>\r\n\r\n     <a href=\\\\\\\"/registrations\\\\\\\" id=\\\\\\\"register\\\\\\\"><span class=\\\\\\\"novis\\\\\\\">Register Now</span></a>\r\n','home','2009-07-14 15:21:47','2009-07-15 08:48:58','2009-07-14 15:22:06'),(2,'Privacy Policy','<h1>Privacy Policy</h1>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi odio lectus, suscipit at ornare blandit, vulputate sed nulla. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer tortor risus, venenatis ut elementum ac, vehicula eget risus. In hac habitasse platea dictumst. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Phasellus vel massa velit, sit amet rutrum tortor. Nulla metus sapien, pellentesque at laoreet id, feugiat id felis. Aliquam porttitor facilisis nisi, quis bibendum neque mollis pulvinar. Quisque ligula nulla, eleifend et pharetra et, varius non diam. Cras hendrerit euismod odio, vel blandit tellus vehicula nec. Ut rutrum volutpat dignissim. Quisque id turpis nec nisl porttitor facilisis eget a libero. Cras bibendum ultrices lorem, vitae fermentum tellus luctus at. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; </p>\r\n\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi odio lectus, suscipit at ornare blandit, vulputate sed nulla. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer tortor risus, venenatis ut elementum ac, vehicula eget risus. In hac habitasse platea dictumst. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Phasellus vel massa velit, sit amet rutrum tortor. Nulla metus sapien, pellentesque at laoreet id, feugiat id felis. Aliquam porttitor facilisis nisi, quis bibendum neque mollis pulvinar. Quisque ligula nulla, eleifend et pharetra et, varius non diam. Cras hendrerit euismod odio, vel blandit tellus vehicula nec. Ut rutrum volutpat dignissim. Quisque id turpis nec nisl porttitor facilisis eget a libero. Cras bibendum ultrices lorem, vitae fermentum tellus luctus at. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; </p>','privacy-policy','2009-07-15 08:39:25','2009-07-15 08:39:25',NULL),(3,'Terms and Conditions','<h1>Terms and Conditions</h1>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi odio lectus, suscipit at ornare blandit, vulputate sed nulla. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer tortor risus, venenatis ut elementum ac, vehicula eget risus. In hac habitasse platea dictumst. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Phasellus vel massa velit, sit amet rutrum tortor. Nulla metus sapien, pellentesque at laoreet id, feugiat id felis. Aliquam porttitor facilisis nisi, quis bibendum neque mollis pulvinar. Quisque ligula nulla, eleifend et pharetra et, varius non diam. Cras hendrerit euismod odio, vel blandit tellus vehicula nec. Ut rutrum volutpat dignissim. Quisque id turpis nec nisl porttitor facilisis eget a libero. Cras bibendum ultrices lorem, vitae fermentum tellus luctus at. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; </p>\r\n\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi odio lectus, suscipit at ornare blandit, vulputate sed nulla. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer tortor risus, venenatis ut elementum ac, vehicula eget risus. In hac habitasse platea dictumst. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Phasellus vel massa velit, sit amet rutrum tortor. Nulla metus sapien, pellentesque at laoreet id, feugiat id felis. Aliquam porttitor facilisis nisi, quis bibendum neque mollis pulvinar. Quisque ligula nulla, eleifend et pharetra et, varius non diam. Cras hendrerit euismod odio, vel blandit tellus vehicula nec. Ut rutrum volutpat dignissim. Quisque id turpis nec nisl porttitor facilisis eget a libero. Cras bibendum ultrices lorem, vitae fermentum tellus luctus at. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; </p>','terms-and-conditions','2009-07-15 08:41:54','2009-07-15 08:41:54',NULL);

/*Table structure for table `event` */

DROP TABLE IF EXISTS `event`;

CREATE TABLE `event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `starts` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ends` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `title` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `thumbnail_file` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fullsize_file` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image_caption` text COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `event` */

insert  into `event`(`id`,`starts`,`ends`,`title`,`location`,`description`,`thumbnail_file`,`fullsize_file`,`image_caption`,`created`,`updated`,`deleted_at`) values (1,'2009-05-15 00:00:00','2009-05-15 00:00:00','Kfx2 test Event','Kfx squared','This is a test event used by kfx2 for testing.','/user/events/thumbnail/48c1ad670171bf41dfb62a63a0750e73.jpg','/user/events/fullsize/48c1ad670171bf41dfb62a63a0750e73.jpg','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.','2008-12-19 11:08:36','2009-05-08 10:04:56',NULL),(2,'2009-05-28 09:00:00','2009-05-28 00:00:00','Testing Events','Lorem ipsum dolor','Tst event','/user/events/thumbnail/6b30ccba7ac8ff85fc93f05c7f47db9b.jpg','/user/events/fullsize/6b30ccba7ac8ff85fc93f05c7f47db9b.jpg','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.','2008-12-22 15:14:20','2009-05-08 10:06:10',NULL),(3,'2009-05-01 00:00:00','2009-07-05 00:00:00','Launch of new website','Internet','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>','/user/events/thumbnail/1e23dde6fd55e40c9ad8f1f5adf72ea6.jpg','/user/events/fullsize/1e23dde6fd55e40c9ad8f1f5adf72ea6.jpg','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>','2009-01-12 18:58:37','2009-05-08 10:04:24',NULL),(4,'2009-04-14 00:00:00','2009-04-30 00:00:00','New test for KidZone.-,:','In the Blue Hills','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>','/user/events/thumbnail/44e3d3593d4c740ed33dfdf6d12608f7.jpg','/user/events/fullsize/44e3d3593d4c740ed33dfdf6d12608f7.jpg','Blue hills are so beautiful.  Blue hills are so beautiful.  Blue hills are so beautiful.  Blue hills are so beautiful.  Blue hills are so beautiful.  ','2009-01-16 21:58:54','2009-06-01 07:54:43',NULL),(6,'2009-04-17 08:00:00','2010-04-16 18:17:51','dfsfsdfsd','sdfsdfsd','sdfsfd',NULL,NULL,'','2009-04-16 18:17:51','2009-04-16 18:34:06',NULL),(7,'2009-11-25 00:00:00','2009-11-26 00:00:00','tesst','test','test',NULL,NULL,'','2009-04-16 18:33:46','2009-04-16 18:34:03','2009-04-16 18:34:03'),(8,'2009-06-09 00:00:00','2009-06-11 00:00:00','VBS Galaxy Trek at the North Campus','North Campus','<p>Vacation Bible School Galaxy Trek....<br />\r\nDiscover the secret world of the kingdom! <br />\r\n<br />\r\nAges 4 to 12 <br />\r\nNorth Campus:   June 9,10,11  <br />\r\n6PM to 830PM <br />\r\nFeaturing: The Jubilee Gang Thursday June 11 Family Night &ndash; Parent\'s welcome</p>','/user/events/thumbnail/c47138ade4ce2a142bdacbc82e6e7483.jpg','/user/events/fullsize/c47138ade4ce2a142bdacbc82e6e7483.jpg','','2009-05-27 09:37:14','2009-06-01 11:08:34',NULL),(9,'2009-07-06 00:00:00','2009-07-09 00:00:00','VBS Galaxy Trek at the South Campus','South Campus','<p>Vacation Bible School Galaxy Trek....<br />\r\nDiscover the secret world of the kingdom! <br />\r\n<br />\r\nAges 4 to 12 <br />\r\nSouth Campus:  July 6,7,8,9 <br />\r\n6PM to 830PM <br />\r\n<br />\r\nFeaturing: God Rocks <br />\r\nWednesday, July 8 Family Night &ndash; Parent&rsquo;s welcome</p>','/user/events/thumbnail/8df5065ffe26d229ff3351f8d3decf64.jpg','/user/events/fullsize/8df5065ffe26d229ff3351f8d3decf64.jpg','','2009-05-27 09:50:43','2009-06-01 11:08:24',NULL);

/*Table structure for table `event_category` */

DROP TABLE IF EXISTS `event_category`;

CREATE TABLE `event_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` mediumtext COLLATE utf8_unicode_ci,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `event_category` */

insert  into `event_category`(`id`,`name`,`description`,`created`,`updated`) values (5,'Nursery',NULL,'2009-04-16 13:46:08','2009-04-16 13:46:08'),(6,'Pre-School',NULL,'2009-04-16 13:46:17','2009-04-16 13:46:17'),(7,'Elementary',NULL,'2009-03-23 14:32:58','2009-03-23 14:32:58');

/*Table structure for table `event_category_membership` */

DROP TABLE IF EXISTS `event_category_membership`;

CREATE TABLE `event_category_membership` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) DEFAULT NULL,
  `event_category_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `event_category_membership` */

insert  into `event_category_membership`(`id`,`event_id`,`event_category_id`,`created`,`updated`) values (20,5,5,'2009-04-16 14:02:48','2009-04-16 14:02:48'),(21,5,7,'2009-04-16 14:02:48','2009-04-16 14:02:48'),(22,3,5,'2009-05-08 10:04:24','2009-05-08 10:04:24'),(23,3,6,'2009-05-08 10:04:24','2009-05-08 10:04:24'),(24,3,7,'2009-05-08 10:04:24','2009-05-08 10:04:24'),(25,1,5,'2009-05-08 10:04:56','2009-05-08 10:04:56'),(26,1,6,'2009-05-08 10:04:56','2009-05-08 10:04:56'),(27,2,5,'2009-05-08 10:06:10','2009-05-08 10:06:10'),(40,9,6,'2009-06-01 11:08:24','2009-06-01 11:08:24'),(41,9,7,'2009-06-01 11:08:24','2009-06-01 11:08:24'),(42,8,6,'2009-06-01 11:08:34','2009-06-01 11:08:34'),(43,8,7,'2009-06-01 11:08:34','2009-06-01 11:08:34');

/*Table structure for table `events` */

DROP TABLE IF EXISTS `events`;

CREATE TABLE `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `starts` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ends` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `title` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `thumbnail_file` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fullsize_file` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image_caption` text COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

/*Data for the table `events` */

/*Table structure for table `media` */

DROP TABLE IF EXISTS `media`;

CREATE TABLE `media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `media_album_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `caption` text,
  `thumbnail_file` varchar(255) DEFAULT NULL,
  `media_file` varchar(255) DEFAULT NULL,
  `orig_file_name` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `media` */

insert  into `media`(`id`,`media_album_id`,`name`,`type`,`caption`,`thumbnail_file`,`media_file`,`orig_file_name`,`created_at`,`updated_at`) values (1,1,'Test',NULL,NULL,NULL,NULL,NULL,'2009-07-14 16:38:10','2009-07-14 16:38:10');

/*Table structure for table `photo` */

DROP TABLE IF EXISTS `photo`;

CREATE TABLE `photo` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `photo_album_id` bigint(20) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` text,
  `thumbnail_file` varchar(255) DEFAULT NULL,
  `fullsize_file` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `photo_album_id_idx` (`photo_album_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

/*Data for the table `photo` */

/*Table structure for table `photo_album` */

DROP TABLE IF EXISTS `photo_album`;

CREATE TABLE `photo_album` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `cover_photo_id` bigint(20) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cover_photo_id_idx` (`cover_photo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `photo_album` */

/*Table structure for table `site_map` */

DROP TABLE IF EXISTS `site_map`;

CREATE TABLE `site_map` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `sym_link_id` int(11) NOT NULL DEFAULT '0',
  `root_id` int(11) NOT NULL DEFAULT '0',
  `parent_node_id` int(11) NOT NULL,
  `lft` int(11) NOT NULL,
  `rgt` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `theme` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `module` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `controller` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `action` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `display_in_navigation` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `user_entered_route` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_external_link` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `route_hash` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

/*Data for the table `site_map` */

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `password_plaintext` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `is_admin` tinyint(4) DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `user` */

insert  into `user`(`id`,`first_name`,`last_name`,`email`,`password`,`password_plaintext`,`is_admin`,`created`,`updated`,`deleted_at`) values (1,NULL,NULL,'admin@kfx2.com','27c2bd774a8a455906ff6650127dda40','kfx2009!',0,NULL,NULL,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
