-- MySQL dump 10.13  Distrib 5.5.35, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: champaholic
-- ------------------------------------------------------
-- Server version	5.5.35-0ubuntu0.12.04.2

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `achievements`
--

DROP TABLE IF EXISTS `achievements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `achievements` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `championship_id` int(10) unsigned NOT NULL,
  `competition_id` int(10) unsigned NOT NULL,
  `position` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `achievements_user_id_foreign` (`user_id`),
  KEY `achievements_championship_id_foreign` (`championship_id`),
  KEY `achievements_competition_id_foreign` (`competition_id`),
  CONSTRAINT `achievements_competition_id_foreign` FOREIGN KEY (`competition_id`) REFERENCES `competitions` (`id`),
  CONSTRAINT `achievements_championship_id_foreign` FOREIGN KEY (`championship_id`) REFERENCES `championships` (`id`),
  CONSTRAINT `achievements_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `achievements`
--

LOCK TABLES `achievements` WRITE;
/*!40000 ALTER TABLE `achievements` DISABLE KEYS */;
INSERT INTO `achievements` VALUES (5,1,7,8,1,'2015-03-16 16:36:40','2015-03-16 16:36:40'),(6,1,6,7,1,'2015-03-16 16:36:43','2015-03-16 16:36:43');
/*!40000 ALTER TABLE `achievements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `brackets`
--

DROP TABLE IF EXISTS `brackets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `brackets` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `championship_id` int(10) unsigned NOT NULL,
  `competition_id` int(10) unsigned NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vendor_account` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `brackets_championship_id_foreign` (`championship_id`),
  KEY `brackets_competition_id_foreign` (`competition_id`),
  CONSTRAINT `brackets_championship_id_foreign` FOREIGN KEY (`championship_id`) REFERENCES `championships` (`id`),
  CONSTRAINT `brackets_competition_id_foreign` FOREIGN KEY (`competition_id`) REFERENCES `competitions` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `brackets`
--

LOCK TABLES `brackets` WRITE;
/*!40000 ALTER TABLE `brackets` DISABLE KEYS */;
INSERT INTO `brackets` VALUES (1,6,7,NULL,NULL,NULL,'2015-03-10 18:05:33','2015-03-10 18:05:33');
/*!40000 ALTER TABLE `brackets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `championships`
--

DROP TABLE IF EXISTS `championships`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `championships` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `event_start` datetime NOT NULL,
  `image` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `thumb` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `location` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `published_at` datetime NOT NULL,
  `finished` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `championships_user_id_foreign` (`user_id`),
  KEY `championships_name_index` (`name`),
  KEY `championships_published_index` (`published`),
  CONSTRAINT `championships_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `championships`
--

LOCK TABLES `championships` WRITE;
/*!40000 ALTER TABLE `championships` DISABLE KEYS */;
INSERT INTO `championships` VALUES (1,1,' Campeonato 3 Campeonato 3','Campeonato 3 Campeonato 3 Campeonato 3','2014-12-18 19:24:44','/images/championships/1418730852.jpg','/images/championships/thumb_1418730852.jpg','Online','diego@diego.com.br',1,'2015-01-09 19:14:59',0,'2014-12-15 19:24:44','2015-01-09 19:14:59'),(2,3,'ajld akjsk jdasdjlkas jdlka j','Campeonato 2 Campeonato 2 Campeonato 2 Campeonato 2','2014-12-22 13:45:37','/images/championships/1418737537.jpg','/images/championships/thumb_1418737537.jpg','Online','',0,'0000-00-00 00:00:00',0,'2014-12-16 13:45:37','2014-12-16 13:45:37'),(3,1,'asd asdasd asd asdas','asd asdasd asd asdas','2014-12-22 16:29:00','/images/championships/1418920139.jpg','/images/championships/thumb_1418920139.jpg','iTAQUEAR','emailnaoexistente@naoconheco.com.br',0,'2015-01-30 14:49:04',0,'2014-12-18 16:29:00','2015-01-30 14:49:04'),(4,1,'zsxaczxdasd','as das edasd asda asd a das dasdas','2015-03-22 18:42:06','/images/championships/1420569725.jpg','/images/championships/thumb_1420569725.jpg','Online','',0,'0000-00-00 00:00:00',0,'2015-01-06 18:42:06','2015-01-06 18:42:06'),(5,1,' aquivai aquivaiaquivai aquivai','aquivai aquivai aquivai aquivai aquivai ','2015-03-22 12:42:57','/images/championships/1421844177.jpg','/images/championships/thumb_1421844177.jpg','22032015','',0,'0000-00-00 00:00:00',0,'2015-01-21 12:42:57','2015-01-21 12:42:57'),(6,1,'ONLINE WARRIOR - LIVE!','oj lkasdj lka jlkaj dlj asdj aslj dalskj dlasj ldkajsdas\r\nas \r\n\r\nas d\r\n\r\n\r\nas\r\nd \r\nasdoças dlkas kl kdalks dklaj klasjd lkjdasl djas\r\n\r\nas \r\nd\r\nas d\r\nsa\r\ndsaklj ldjasl dlas jdas\r\n\r\n','2015-03-22 17:04:53','/images/championships/1422896692.jpg','/images/championships/thumb_1422896692.jpg','Online','diego@diego.com.br',1,'2015-02-02 17:06:13',0,'2015-02-02 17:04:53','2015-02-02 17:06:13'),(7,1,'Campeonato de Teste 1','Campeonato de Teste 1 Campeonato de Teste 1 ','2015-03-22 17:57:59','/images/championships/1426021079.jpg','/images/championships/thumb_1426021079.jpg','sadfasddas','emailnaoexistente@naoconheco.com.br',1,'2015-03-10 18:05:30',0,'2015-03-10 17:57:59','2015-03-10 18:05:30');
/*!40000 ALTER TABLE `championships` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `competitions`
--

DROP TABLE IF EXISTS `competitions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `competitions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `championship_id` int(10) unsigned NOT NULL,
  `game_id` int(10) unsigned NOT NULL,
  `platform_id` int(10) unsigned NOT NULL,
  `format_id` int(10) unsigned NOT NULL,
  `start` datetime NOT NULL,
  `price` int(10) unsigned NOT NULL,
  `original_price` int(10) unsigned NOT NULL,
  `limit` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `competitions_championship_id_foreign` (`championship_id`),
  KEY `competitions_game_id_foreign` (`game_id`),
  KEY `competitions_platform_id_foreign` (`platform_id`),
  KEY `competitions_format_id_foreign` (`format_id`),
  CONSTRAINT `competitions_championship_id_foreign` FOREIGN KEY (`championship_id`) REFERENCES `championships` (`id`) ON DELETE CASCADE,
  CONSTRAINT `competitions_format_id_foreign` FOREIGN KEY (`format_id`) REFERENCES `formats` (`id`),
  CONSTRAINT `competitions_game_id_foreign` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`),
  CONSTRAINT `competitions_platform_id_foreign` FOREIGN KEY (`platform_id`) REFERENCES `platforms` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `competitions`
--

LOCK TABLES `competitions` WRITE;
/*!40000 ALTER TABLE `competitions` DISABLE KEYS */;
INSERT INTO `competitions` VALUES (1,1,1,1,1,'2014-12-18 19:25:18',2444,2200,99999,'2014-12-15 19:25:18','2014-12-15 19:25:18'),(2,3,1,1,1,'2014-12-28 16:48:56',1111,1000,99998,'2014-12-18 16:48:56','2014-12-18 17:47:23'),(6,4,1,1,1,'2015-03-22 18:51:48',2444,2200,12,'2015-01-06 18:51:48','2015-01-06 18:51:48'),(7,6,3,1,1,'2015-03-22 17:05:45',1000,900,99996,'2015-02-02 17:05:45','2015-03-02 17:02:22'),(8,7,1,1,1,'2015-03-22 17:58:39',2200,1980,99998,'2015-03-10 17:58:39','2015-03-13 17:35:36');
/*!40000 ALTER TABLE `competitions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coupons`
--

DROP TABLE IF EXISTS `coupons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `coupons` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `championship_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `join_id` int(10) unsigned DEFAULT NULL,
  `price` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `coupons_code_unique` (`code`),
  KEY `coupons_championship_id_foreign` (`championship_id`),
  KEY `coupons_user_id_foreign` (`user_id`),
  KEY `coupons_join_id_foreign` (`join_id`),
  CONSTRAINT `coupons_championship_id_foreign` FOREIGN KEY (`championship_id`) REFERENCES `championships` (`id`),
  CONSTRAINT `coupons_join_id_foreign` FOREIGN KEY (`join_id`) REFERENCES `joins` (`id`),
  CONSTRAINT `coupons_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coupons`
--

LOCK TABLES `coupons` WRITE;
/*!40000 ALTER TABLE `coupons` DISABLE KEYS */;
INSERT INTO `coupons` VALUES (2,'KQJ-I83-7BZ',6,NULL,NULL,2000,'2015-02-26 21:37:55','2015-02-27 19:19:55'),(3,'62I-M9F-LZK',6,NULL,NULL,1000,'2015-02-27 11:22:04','2015-02-27 19:15:00'),(4,'30S-TUH-9YR',6,NULL,NULL,2000,'2015-02-27 18:38:25','2015-02-27 19:13:15'),(5,'M98-4NI-FRL',6,NULL,NULL,15000,'2015-02-27 19:49:39','2015-02-27 19:50:14'),(6,'3SD-A8X-M79',6,NULL,NULL,14000,'2015-02-27 19:50:57','2015-02-27 19:51:46'),(7,'5OF-JZT-HW0',6,NULL,NULL,0,'2015-02-27 20:22:30','2015-02-27 20:22:30'),(8,'UXS-0QH-4I7',6,NULL,NULL,0,'2015-02-27 20:23:40','2015-02-27 20:23:40'),(9,'JHF-T58-YPD',6,NULL,NULL,0,'2015-02-27 20:27:44','2015-02-27 20:27:44'),(10,'IJL-PDQ-Y90',6,NULL,NULL,0,'2015-02-27 20:39:43','2015-02-27 20:39:43'),(11,'DU7-IYC-TL0',6,NULL,NULL,0,'2015-02-27 20:40:22','2015-02-27 20:40:22'),(13,'CX4-Q2U-LVH',6,NULL,NULL,1200,'2015-03-02 16:54:43','2015-03-02 16:54:43'),(14,'0TM-L1A-S7U',6,NULL,NULL,12300,'2015-03-02 16:56:59','2015-03-02 16:56:59'),(15,'63J-D1M-WTV',6,NULL,NULL,0,'2015-03-02 16:57:07','2015-03-02 16:57:07'),(16,'WKN-I0Q-FHA',6,NULL,NULL,1212,'2015-03-02 16:57:48','2015-03-02 17:04:26');
/*!40000 ALTER TABLE `coupons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `formats`
--

DROP TABLE IF EXISTS `formats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `formats` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `formats`
--

LOCK TABLES `formats` WRITE;
/*!40000 ALTER TABLE `formats` DISABLE KEYS */;
INSERT INTO `formats` VALUES (1,'Round Robin','0000-00-00 00:00:00','0000-00-00 00:00:00'),(2,'Double Elimination','0000-00-00 00:00:00','0000-00-00 00:00:00'),(3,'Single Elimination','0000-00-00 00:00:00','0000-00-00 00:00:00'),(4,'Swiss','0000-00-00 00:00:00','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `formats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `games`
--

DROP TABLE IF EXISTS `games`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `games` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `games`
--

LOCK TABLES `games` WRITE;
/*!40000 ALTER TABLE `games` DISABLE KEYS */;
INSERT INTO `games` VALUES (1,'FIFA 2014','images/games/fifa2014.jpg','0000-00-00 00:00:00','0000-00-00 00:00:00'),(2,'SUPER STREET FIGHTER IV:ARCADE EDITION v.2012','images/games/ssfivae.jpg','0000-00-00 00:00:00','0000-00-00 00:00:00'),(3,'ULTRA STREET FIGHTER IV','images/games/usfiv.png','0000-00-00 00:00:00','0000-00-00 00:00:00'),(4,'ULTIMATE MARVEL VS CAPCOM 3','images/games/umvc3.jpg','0000-00-00 00:00:00','0000-00-00 00:00:00'),(5,'MORTAL KOMBAT','images/games/mk.jpg','0000-00-00 00:00:00','0000-00-00 00:00:00'),(6,'THE KING OF FIGHTERS XIII','images/games/kofxiii.jpg','0000-00-00 00:00:00','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `games` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `join_id` int(10) unsigned NOT NULL,
  `competition_id` int(10) unsigned NOT NULL,
  `price` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `items_join_id_foreign` (`join_id`),
  KEY `items_competition_id_foreign` (`competition_id`),
  CONSTRAINT `items_competition_id_foreign` FOREIGN KEY (`competition_id`) REFERENCES `competitions` (`id`),
  CONSTRAINT `items_join_id_foreign` FOREIGN KEY (`join_id`) REFERENCES `joins` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `items`
--

LOCK TABLES `items` WRITE;
/*!40000 ALTER TABLE `items` DISABLE KEYS */;
INSERT INTO `items` VALUES (1,1,2,0),(2,1,7,0),(3,1,7,1000),(4,1,7,1000),(5,30,8,2200);
/*!40000 ALTER TABLE `items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `joins`
--

DROP TABLE IF EXISTS `joins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `joins` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `championship_id` int(10) unsigned NOT NULL,
  `status_id` int(10) unsigned NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `joins_user_id_foreign` (`user_id`),
  KEY `joins_championship_id_foreign` (`championship_id`),
  KEY `joins_status_id_foreign` (`status_id`),
  CONSTRAINT `joins_championship_id_foreign` FOREIGN KEY (`championship_id`) REFERENCES `championships` (`id`),
  CONSTRAINT `joins_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`),
  CONSTRAINT `joins_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `joins`
--

LOCK TABLES `joins` WRITE;
/*!40000 ALTER TABLE `joins` DISABLE KEYS */;
INSERT INTO `joins` VALUES (1,22,6,3,0,'2014-12-18 17:47:22','2015-02-27 19:50:14'),(2,22,6,3,0,'2015-02-09 13:17:33','2015-02-09 13:17:33'),(3,22,6,3,0,'2015-02-09 14:02:16','2015-02-09 14:02:16'),(4,22,6,3,0,'2015-03-02 14:18:49','2015-03-02 14:18:49'),(5,22,6,3,0,'2015-03-02 14:18:49','2015-03-02 14:18:49'),(6,22,6,3,0,'2015-03-02 14:18:49','2015-03-02 14:18:49'),(7,22,6,3,0,'2015-03-02 14:18:51','2015-03-02 14:18:51'),(8,22,6,3,0,'2015-03-02 14:18:51','2015-03-02 14:18:51'),(9,22,6,3,0,'2015-03-02 14:18:51','2015-03-02 14:18:51'),(10,22,6,3,0,'2015-03-02 14:18:51','2015-03-02 14:18:51'),(11,22,6,3,0,'2015-03-02 14:18:51','2015-03-02 14:18:51'),(12,22,6,3,0,'2015-03-02 14:18:51','2015-03-02 14:18:51'),(14,22,6,3,0,'2015-03-02 14:18:55','2015-03-02 14:18:55'),(15,22,6,3,0,'2015-03-02 14:18:55','2015-03-02 14:18:55'),(16,22,6,3,0,'2015-03-02 14:18:55','2015-03-02 14:18:55'),(17,22,6,3,0,'2015-03-02 14:18:55','2015-03-02 14:18:55'),(18,22,6,3,0,'2015-03-02 14:18:55','2015-03-02 14:18:55'),(19,22,6,3,0,'2015-03-02 14:18:55','2015-03-02 14:18:55'),(20,22,6,3,0,'2015-03-02 14:18:55','2015-03-02 14:18:55'),(21,22,6,3,0,'2015-03-02 14:18:55','2015-03-02 14:18:55'),(22,22,6,3,0,'2015-03-02 14:18:55','2015-03-02 14:18:55'),(23,22,6,3,0,'2015-03-02 14:18:55','2015-03-02 14:18:55'),(24,22,6,3,0,'2015-03-02 14:18:55','2015-03-02 14:18:55'),(25,22,6,3,0,'2015-03-02 14:18:55','2015-03-02 14:18:55'),(29,1,6,1,0,'2015-03-02 17:02:22','2015-03-02 17:04:26'),(30,1,7,1,0,'2015-03-13 17:35:36','2015-03-13 17:35:36');
/*!40000 ALTER TABLE `joins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES ('2014_02_13_203140_create_users_table',1),('2014_02_13_205646_create_championships_table',1),('2014_03_18_221206_create_profiles_table',1),('2014_04_22_214349_create_games_table',1),('2014_04_22_214630_create_platforms_table',1),('2014_04_23_211225_create_formats_table',1),('2014_04_24_210416_create_competitions_table',1),('2014_07_20_205400_create_statuses_table',1),('2014_07_21_204106_create_joins_table',1),('2014_07_22_115221_create_items_table',1),('2014_12_03_195915_create_password_reminders_table',1),('2015_02_03_181712_create_coupons_table',2),('2015_03_05_154801_create_brackets_table',3),('2015_03_16_124709_create_achievements_table',4);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reminders`
--

DROP TABLE IF EXISTS `password_reminders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_reminders` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_reminders_email_index` (`email`),
  KEY `password_reminders_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reminders`
--

LOCK TABLES `password_reminders` WRITE;
/*!40000 ALTER TABLE `password_reminders` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reminders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `platforms`
--

DROP TABLE IF EXISTS `platforms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `platforms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `platforms`
--

LOCK TABLES `platforms` WRITE;
/*!40000 ALTER TABLE `platforms` DISABLE KEYS */;
INSERT INTO `platforms` VALUES (1,'PS3','images/platforms/ps3.jpg','0000-00-00 00:00:00','0000-00-00 00:00:00'),(2,'XBOX 360','images/platforms/xbox360.jpg','0000-00-00 00:00:00','0000-00-00 00:00:00'),(3,'PC','images/platforms/pc.jpg','0000-00-00 00:00:00','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `platforms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profiles`
--

DROP TABLE IF EXISTS `profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profiles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `bio` text COLLATE utf8_unicode_ci NOT NULL,
  `psn` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `live` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `steam` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `moip_user` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `notify` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `profiles_user_id_foreign` (`user_id`),
  CONSTRAINT `profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profiles`
--

LOCK TABLES `profiles` WRITE;
/*!40000 ALTER TABLE `profiles` DISABLE KEYS */;
INSERT INTO `profiles` VALUES (4,21,'Opa, vou testar uma coisa aqui1111','teste101','teste101','teste101','',1,'2015-01-28 15:46:40','2015-01-28 19:30:24'),(6,1,'Segura esse perfil!','diegofelix_','Diego Flx','diego_felix','',1,'2015-02-09 18:50:45','2015-03-16 12:52:42');
/*!40000 ALTER TABLE `profiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `statuses`
--

DROP TABLE IF EXISTS `statuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `statuses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `statuses`
--

LOCK TABLES `statuses` WRITE;
/*!40000 ALTER TABLE `statuses` DISABLE KEYS */;
INSERT INTO `statuses` VALUES (1,'Aguardando pagamento','Estamos aguardando o pagamento.'),(2,'Em análise','Estamos analisando seu pagamento, a qualquer momento seu pagamento será confirmado.'),(3,'Pago','Já recebemos seu pagamento, agora você poderá participar do campeonato!'),(4,'Disponível','O prazo para disputa chegou ao fim, significa que não poderá receber seu dinheiro devolta.'),(5,'Em disputa','Uma pena que você esteja cancelando, esperamos que participe de outros campeonatos com a gente!'),(6,'Dinheiro devolvido','Já devolvemos seu dinheiro.'),(7,'Cancelado','Ocorreu algum erro com o Pagseguro ou com a instituição financeira, tente novamente.'),(8,'Chargeback debitado','Já devolvemos seu dinheiro.'),(9,'Em contestação','Aparentemente você pediu o estorno junto ao seu cartão de crédito, estamos verificando.');
/*!40000 ALTER TABLE `statuses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `picture` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `points` int(10) unsigned NOT NULL,
  `is_banned` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_organizer` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Diego Felix','diegofelix','diegoflx.oliveira@gmail.com','$2y$10$/RzGVFqr5nEo0I76DtJISeY/smJpN1x77h55c71on6cDR7pQ7dpfq','https://lh6.googleusercontent.com/-LfMmuv9QXh4/AAAAAAAAAAI/AAAAAAAAAOY/1wKOh84NVzM/s120-c/photo.jpg',0,0,'tiWtPyhmcQY3LWADlA3iiOW7It92yPS3laqdw26m3xNbpUA1LmyTXt1OQplP',1,'2014-12-15 19:17:24','2015-02-09 13:15:58'),(2,'Kailyn Homenick','torphy.justus','zulauf.annalise@borer.com','$2y$10$3wEQkkCzywLyXKNF6qU/0e8hlZqP5KfY5O.i3eKi3eFt2IvRetJk6','',0,0,NULL,0,'2014-12-15 19:17:24','2014-12-15 19:17:24'),(3,'Chyna Koss Jr.','cordie12','kennedi.nicolas@senger.org','$2y$10$EuZ3rgA0vsungfBPj2QXyuuI9TlxNWMqkJrQuR2wkcqVcX/mqN2R.','',0,0,'3284m4uXjvwdqyTJP6nPmcpVBK6Rtluy5JMUyoX9JxaaDMOw6rapLaTCvm3z',1,'2014-12-15 19:17:24','2014-12-16 13:45:46'),(4,'Corene Purdy','lilla.kohler','pquigley@kilback.com','$2y$10$g2twUTbhry55tPDbfkabG.MkFdan8Ypy/ZOFc2/p7hLUNwAo8tR.y','',0,0,NULL,0,'2014-12-15 19:17:24','2014-12-15 19:17:24'),(5,'Zelma Schuster','ybrekke','iwilkinson@auer.com','$2y$10$jL7axkvIL0n9cC17uRmKxOdgWXRYbvbCxQ5b8Q8xhYuh07tC.YZLK','',0,0,NULL,0,'2014-12-15 19:17:24','2014-12-15 19:17:24'),(6,'Katarina Swift','qkohler','medhurst.delia@hotmail.com','$2y$10$1iMk2cfyaLjQGNAcCDHeOeapFhTjtSh0iHP5xuz3MnJixYVnZjscO','',0,0,NULL,0,'2014-12-15 19:17:24','2014-12-15 19:17:24'),(7,'Gavin Rempel','udibbert','durgan.justus@yahoo.com','$2y$10$27emRu3ZBX.P4pWcxH2r3.kVF4l73/yyBvsyqslW1N8hWRH9HSTNO','',0,0,NULL,0,'2014-12-15 19:17:24','2014-12-15 19:17:24'),(8,'Alexane Predovic','hegmann.princess','marlin.fahey@gmail.com','$2y$10$IL6Eg2QrbR4ziDRpE4jmMO2M.FniOJXnQx2GvilJMAT/FQkDh6u/2','',0,0,NULL,0,'2014-12-15 19:17:24','2014-12-15 19:17:24'),(9,'Susan Hessel','sarai.dickinson','bconnelly@hotmail.com','$2y$10$2YlYb4IGuzoEWl.GdFh2VegIS7aHWFctWsYER/8b0rOArCip8NqHO','',0,0,NULL,0,'2014-12-15 19:17:24','2014-12-15 19:17:24'),(10,'Mrs. Jasen Brakus IV','ellie.pfannerstill','sophia.barton@cummingswelch.com','$2y$10$8HRJfgGknVSy4Wq.2FkeauRqYHcb9O5636GiLBatd.feIPdsbBCIu','',0,0,NULL,0,'2014-12-15 19:17:25','2014-12-15 19:17:25'),(11,'Create','create','createa@email.com','$2y$10$jU.P8U9OsJxXTEo.jRIEK.R3tQH7oXj9O6TXQhUWtLo.8yrKvsj4S','images/defaultUser.jpg',0,0,'DTkV4NzEk6BpUuq2UwWZLViyXcQqBB3l4q3I4K5EBULsOzKIPI481Wz27ZXx',0,'2014-12-16 13:16:23','2014-12-16 13:19:34'),(12,'Teste1','teste1','teste1@teste1.com.br','$2y$10$J3jYRRIfWRej6JNUKHUKzepGdW56w6TzQPRCovQ585zJchbWstSJC','images/defaultUser.jpg',0,0,NULL,0,'2015-01-28 14:33:43','2015-01-28 14:33:43'),(13,'teste2','teste2','teste2@teste2.com.br','$2y$10$eV0e9c0qMqq1LflBTVWO.ePnD/N.0q3IxntPvpVOOWp8Xkxc0zmhG','images/defaultUser.jpg',0,0,NULL,0,'2015-01-28 14:36:27','2015-01-28 14:36:27'),(14,'teste3','teste3','teste3@teste3.com.br','$2y$10$NdyAdJQW8GpjVBdKMNGvWe1XWn.zbwngCrIgslXaex19sge47slxG','images/defaultUser.jpg',0,0,NULL,0,'2015-01-28 14:38:55','2015-01-28 14:38:55'),(15,'teste4','teste4','teste4@teste4.com.br','$2y$10$oUJ/cPrbvbFfnFaS1/qEseDzaUrVlcwZ4iMC.2StyCoyecxAE2kTO','images/defaultUser.jpg',0,0,NULL,0,'2015-01-28 14:39:33','2015-01-28 14:39:33'),(16,'Teste5','teste5','teste5@teste5.com.br','$2y$10$71u9JRzwdhXARGezYvPQAOIlb5tjW2XII6O4zLMjDwyd1R8.Jo1RG','images/defaultUser.jpg',0,0,NULL,0,'2015-01-28 14:48:08','2015-01-28 14:48:08'),(17,'Teste6','teste6','teste6@teste6.com.br','$2y$10$cFEROcOZpVhgqotKho60YOzDwRt6zSpUe8k.252Sg8d.3uRbv710i','images/defaultUser.jpg',0,0,NULL,0,'2015-01-28 14:50:07','2015-01-28 14:50:07'),(18,'teste7','teste7','teste7@teste7.com.br','$2y$10$jDMSgzMCdTZR8XERewqSDOPNLEqT5Df6pRxLdIRn4sRMhM7opgv.a','images/defaultUser.jpg',0,0,NULL,0,'2015-01-28 14:51:06','2015-01-28 14:51:06'),(19,'Teste8','teste8','teste8@teste8.com.br','$2y$10$KoJ/T5HLI1A35TjhXobuLeWsTbZVtv1sIC6gofa3SVKs9H7Jb3itm','images/defaultUser.jpg',0,0,NULL,0,'2015-01-28 14:52:09','2015-01-28 14:52:09'),(20,'teste9','teste9','teste9@teste9.com.com','$2y$10$5rpGrq/jONDZYqsg0cjYJ.SoQ/4GLnsyGSsD.CY/bTbj1xqsEmWaK','images/defaultUser.jpg',0,0,NULL,0,'2015-01-28 14:53:00','2015-01-28 14:53:00'),(21,'teste10','teste10','teste10@teste10.com.br','$2y$10$JsPpvyYaENNAOhcsEJDkmupl3vIUyypoK9R0aZ6JcHVJTmruIBpjW','images/defaultUser.jpg',0,0,'6T6LyZcDTNwGTxeQhjvV357kzcZerMRldY5QYny6gSj4EA9OUCE6nmnXj2FD',0,'2015-01-28 14:53:29','2015-01-28 19:56:39'),(22,'Thaís Carvalho','thaiscflx','thais.cflx@gmail.com','$2y$10$npBWWCKM8GDP5kUZDI3Q6e6eRLI9kT53KfSFXSqbhcojYoTlG.fMW','images/defaultUser.jpg',0,0,NULL,0,'2015-02-09 13:16:59','2015-02-09 13:16:59');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-03-17 20:26:53
