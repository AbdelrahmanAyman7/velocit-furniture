-- MySQL dump 10.13  Distrib 8.0.28, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: velocity
-- ------------------------------------------------------
-- Server version	8.0.27

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `idcategories` int NOT NULL AUTO_INCREMENT,
  `cname` varchar(450) DEFAULT NULL,
  `cdescription` varchar(450) DEFAULT NULL,
  `cimage` varchar(450) DEFAULT NULL,
  PRIMARY KEY (`idcategories`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Tables','tables with any qualities','1653157164tables.jpg'),(2,'Curtains','Curtains','1653162327curtains.png'),(3,'mirrors','mirrors','1653162340mirrors.jpg'),(4,'lamps','lamps','1653162351lamps.jpg'),(5,'bedroom','bedroom','1653162363bedroom.jpg');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `client_requests`
--

DROP TABLE IF EXISTS `client_requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `client_requests` (
  `idclient_requests` int NOT NULL AUTO_INCREMENT,
  `idclient` varchar(45) DEFAULT NULL,
  `from_location` varchar(450) DEFAULT NULL,
  `to_location` varchar(450) DEFAULT NULL,
  `delivery_date` varchar(450) DEFAULT NULL,
  `request_date` varchar(450) DEFAULT NULL,
  `offer_selected` varchar(45) DEFAULT NULL,
  `paid` varchar(45) DEFAULT '0',
  PRIMARY KEY (`idclient_requests`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `client_requests`
--

LOCK TABLES `client_requests` WRITE;
/*!40000 ALTER TABLE `client_requests` DISABLE KEYS */;
INSERT INTO `client_requests` VALUES (1,'1','al qahira','al gizah','2022-06-01','2022-05-21 20:38:24','2','1'),(2,'1','al qahira','al gizah','2022-06-02','2022-05-22 19:22:50','3','1'),(3,'1','al qahira','al gizah','2022-05-25','2022-05-22 19:47:56',NULL,'0');
/*!40000 ALTER TABLE `client_requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `client_requests_messages`
--

DROP TABLE IF EXISTS `client_requests_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `client_requests_messages` (
  `idclient_requests_messages` int NOT NULL AUTO_INCREMENT,
  `idclient` varchar(45) DEFAULT NULL,
  `idcompany` varchar(45) DEFAULT NULL,
  `idclientrequests` varchar(45) DEFAULT NULL,
  `qtitle` varchar(450) DEFAULT NULL,
  `qmessage` varchar(450) DEFAULT NULL,
  `qfile` varchar(450) DEFAULT NULL,
  `replymessage` varchar(450) DEFAULT NULL,
  `replyfile` varchar(450) DEFAULT NULL,
  PRIMARY KEY (`idclient_requests_messages`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `client_requests_messages`
--

LOCK TABLES `client_requests_messages` WRITE;
/*!40000 ALTER TABLE `client_requests_messages` DISABLE KEYS */;
INSERT INTO `client_requests_messages` VALUES (1,'1','5','1','procedure','how the procedure should be between us','16531757281652911612analysis.png','test test',NULL),(2,'1','5','2','question2','q','1653247567special-offer.png','done!!!!',NULL);
/*!40000 ALTER TABLE `client_requests_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `offers`
--

DROP TABLE IF EXISTS `offers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `offers` (
  `idoffers` int NOT NULL AUTO_INCREMENT,
  `idcompany` varchar(45) DEFAULT NULL,
  `price` varchar(45) DEFAULT NULL,
  `odescription` varchar(450) DEFAULT NULL,
  `idclientrequests` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idoffers`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `offers`
--

LOCK TABLES `offers` WRITE;
/*!40000 ALTER TABLE `offers` DISABLE KEYS */;
INSERT INTO `offers` VALUES (1,'3','545.25','it costs 15 hours','1'),(2,'5','245.25','it costs 14 hrs','1'),(3,'5','345.25','test','2');
/*!40000 ALTER TABLE `offers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `requests_elements`
--

DROP TABLE IF EXISTS `requests_elements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `requests_elements` (
  `idrequests_elements` int NOT NULL AUTO_INCREMENT,
  `idclientrequests` varchar(45) DEFAULT NULL,
  `idcategory` varchar(45) DEFAULT NULL,
  `quantity` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idrequests_elements`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `requests_elements`
--

LOCK TABLES `requests_elements` WRITE;
/*!40000 ALTER TABLE `requests_elements` DISABLE KEYS */;
INSERT INTO `requests_elements` VALUES (1,'1','1','20'),(2,'1','3','30'),(3,'1','5','50'),(4,'2','1','80'),(5,'2','3','60'),(6,'3','1','1'),(7,'3','2','30');
/*!40000 ALTER TABLE `requests_elements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `requests_files`
--

DROP TABLE IF EXISTS `requests_files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `requests_files` (
  `idrequests_files` int NOT NULL AUTO_INCREMENT,
  `idclientrequests` varchar(45) DEFAULT NULL,
  `file` varchar(450) DEFAULT NULL,
  PRIMARY KEY (`idrequests_files`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `requests_files`
--

LOCK TABLES `requests_files` WRITE;
/*!40000 ALTER TABLE `requests_files` DISABLE KEYS */;
INSERT INTO `requests_files` VALUES (1,'1','1653165504curtains.png'),(2,'1','1653165504mirrors.jpg'),(3,'2','16532473701653165504mirrors.jpg'),(4,'2','16532473701653165504curtains.png'),(5,'3','165324887616532473701653165504curtains.png'),(6,'3','165324887616532473701653165504mirrors.jpg');
/*!40000 ALTER TABLE `requests_files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `idusers` int NOT NULL AUTO_INCREMENT,
  `name` varchar(450) DEFAULT NULL,
  `email` varchar(450) DEFAULT NULL,
  `password` varchar(450) DEFAULT NULL,
  `phone` varchar(450) DEFAULT NULL,
  `image` varchar(450) DEFAULT NULL,
  `description` text,
  `regdate` varchar(450) DEFAULT NULL,
  `role` varchar(450) DEFAULT NULL,
  PRIMARY KEY (`idusers`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'client','client@client.com','123456789','+12345678901','1653134318icons8-male-user-40.png','','2022-05-21 11:56:38','client'),(2,'admin','admin@admin.com','123456789','+12345678901','1653134318icons8-male-user-40.png','','2022-05-21 11:58:38','admin'),(3,'company','company@company.com','123456789','+12345678901789456','1653134413rsz_1logo.jpg','we cover all egypt regions','2022-05-21 12:00:13','company'),(5,'company2','company2@company.com','123456789','+12345678901789456','1653170793mirrors.jpg','company2','2022-05-21 22:06:33','company');
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

-- Dump completed on 2022-05-22 22:51:05
