-- MySQL dump 10.13  Distrib 5.5.60, for linux-glibc2.12 (x86_64)
--
-- Host: localhost    Database: taskforce
-- ------------------------------------------------------
-- Server version	5.5.60

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
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `icon` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `city`
--

DROP TABLE IF EXISTS `city`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `city` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `latitude` decimal(8,6) DEFAULT NULL,
  `longitude` decimal(8,6) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1109 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `city`
--

LOCK TABLES `city` WRITE;
/*!40000 ALTER TABLE `city` DISABLE KEYS */;
/*!40000 ALTER TABLE `city` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `correspondence`
--

DROP TABLE IF EXISTS `correspondence`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `correspondence` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sender_id` int(11) NOT NULL,
  `recipient_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `recipient_id` (`recipient_id`),
  KEY `sender_id` (`sender_id`),
  KEY `task_id` (`task_id`),
  CONSTRAINT `correspondence_ibfk_1` FOREIGN KEY (`recipient_id`) REFERENCES `user` (`id`),
  CONSTRAINT `correspondence_ibfk_2` FOREIGN KEY (`sender_id`) REFERENCES `user` (`id`),
  CONSTRAINT `correspondence_ibfk_3` FOREIGN KEY (`task_id`) REFERENCES `task` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `correspondence`
--

LOCK TABLES `correspondence` WRITE;
/*!40000 ALTER TABLE `correspondence` DISABLE KEYS */;
/*!40000 ALTER TABLE `correspondence` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events_feed`
--

DROP TABLE IF EXISTS `events_feed`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `events_feed` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` text NOT NULL,
  `created_at` datetime NOT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `events_feed_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events_feed`
--

LOCK TABLES `events_feed` WRITE;
/*!40000 ALTER TABLE `events_feed` DISABLE KEYS */;
/*!40000 ALTER TABLE `events_feed` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `favorites`
--

DROP TABLE IF EXISTS `favorites`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `favorites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `choosing_id` int(11) NOT NULL,
  `selected_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `choosing_id` (`choosing_id`),
  KEY `selected_id` (`selected_id`),
  CONSTRAINT `favorites_ibfk_1` FOREIGN KEY (`choosing_id`) REFERENCES `user` (`id`),
  CONSTRAINT `favorites_ibfk_2` FOREIGN KEY (`selected_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `favorites`
--

LOCK TABLES `favorites` WRITE;
/*!40000 ALTER TABLE `favorites` DISABLE KEYS */;
/*!40000 ALTER TABLE `favorites` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `response`
--

DROP TABLE IF EXISTS `response`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `response` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` text NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `task_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `task_id` (`task_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `response_ibfk_1` FOREIGN KEY (`task_id`) REFERENCES `task` (`id`),
  CONSTRAINT `response_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `response`
--

LOCK TABLES `response` WRITE;
/*!40000 ALTER TABLE `response` DISABLE KEYS */;
/*!40000 ALTER TABLE `response` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rewiew`
--

DROP TABLE IF EXISTS `rewiew`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rewiew` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` text NOT NULL,
  `estimate` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `task_id` (`task_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `rewiew_ibfk_1` FOREIGN KEY (`task_id`) REFERENCES `task` (`id`),
  CONSTRAINT `rewiew_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rewiew`
--

LOCK TABLES `rewiew` WRITE;
/*!40000 ALTER TABLE `rewiew` DISABLE KEYS */;
/*!40000 ALTER TABLE `rewiew` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` VALUES (1,'customer','2019-12-16 21:13:30'),(2,'executor','2019-12-16 21:13:30');
/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subscription`
--

DROP TABLE IF EXISTS `subscription`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscription` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `subscription_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subscription`
--

LOCK TABLES `subscription` WRITE;
/*!40000 ALTER TABLE `subscription` DISABLE KEYS */;
/*!40000 ALTER TABLE `subscription` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `task`
--

DROP TABLE IF EXISTS `task`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `task` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `short` text NOT NULL,
  `description` text NOT NULL,
  `address` text,
  `budget` int(11) NOT NULL,
  `deadline` datetime NOT NULL,
  `status` int(11) DEFAULT NULL,
  `latitude` decimal(8,6) DEFAULT NULL,
  `longitude` decimal(8,6) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `owner_id` int(11) DEFAULT NULL,
  `executor_id` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  KEY `owner_id` (`owner_id`),
  KEY `executor_id` (`executor_id`),
  KEY `city_id` (`city_id`),
  CONSTRAINT `task_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  CONSTRAINT `task_ibfk_2` FOREIGN KEY (`owner_id`) REFERENCES `user` (`id`),
  CONSTRAINT `task_ibfk_3` FOREIGN KEY (`executor_id`) REFERENCES `user` (`id`),
  CONSTRAINT `task_ibfk_4` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `task`
--

LOCK TABLES `task` WRITE;
/*!40000 ALTER TABLE `task` DISABLE KEYS */;
/*!40000 ALTER TABLE `task` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `task_image`
--

DROP TABLE IF EXISTS `task_image`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `task_image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `image_path` varchar(150) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `task_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `task_id` (`task_id`),
  CONSTRAINT `task_image_ibfk_1` FOREIGN KEY (`task_id`) REFERENCES `task` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `task_image`
--

LOCK TABLES `task_image` WRITE;
/*!40000 ALTER TABLE `task_image` DISABLE KEYS */;
/*!40000 ALTER TABLE `task_image` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tuning`
--

DROP TABLE IF EXISTS `tuning`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tuning` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tuning`
--

LOCK TABLES `tuning` WRITE;
/*!40000 ALTER TABLE `tuning` DISABLE KEYS */;
/*!40000 ALTER TABLE `tuning` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `birthday` date DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `skype` varchar(50) DEFAULT NULL,
  `messenger` varchar(50) DEFAULT NULL,
  `about` text,
  `password` varchar(150) NOT NULL,
  `address` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `city_id` int(11) DEFAULT NULL,
  `role_id` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `city_id` (`city_id`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `user_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`),
  CONSTRAINT `user_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_category`
--

DROP TABLE IF EXISTS `user_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `user_category_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `user_category_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_category`
--

LOCK TABLES `user_category` WRITE;
/*!40000 ALTER TABLE `user_category` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_image`
--

DROP TABLE IF EXISTS `user_image`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image_path` varchar(150) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_image_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_image`
--

LOCK TABLES `user_image` WRITE;
/*!40000 ALTER TABLE `user_image` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_image` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_tuning`
--

DROP TABLE IF EXISTS `user_tuning`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_tuning` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  `tuning_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tuning_id` (`tuning_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_tuning_ibfk_1` FOREIGN KEY (`tuning_id`) REFERENCES `tuning` (`id`),
  CONSTRAINT `user_tuning_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_tuning`
--

LOCK TABLES `user_tuning` WRITE;
/*!40000 ALTER TABLE `user_tuning` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_tuning` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-01-23 12:21:57
