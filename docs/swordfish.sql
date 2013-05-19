-- MySQL dump 10.13  Distrib 5.1.60, for unknown-linux-gnu (x86_64)
--
-- Host: localhost    Database: swordfish
-- ------------------------------------------------------
-- Server version	5.1.60-log

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
-- Table structure for table `default_dict`
--

DROP TABLE IF EXISTS `default_dict`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `default_dict` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `word` char(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `word` (`word`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `default_dict`
--

LOCK TABLES `default_dict` WRITE;
/*!40000 ALTER TABLE `default_dict` DISABLE KEYS */;
/*!40000 ALTER TABLE `default_dict` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ext_dict`
--

DROP TABLE IF EXISTS `ext_dict`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ext_dict` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `word` char(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `word` (`word`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ext_dict`
--

LOCK TABLES `ext_dict` WRITE;
/*!40000 ALTER TABLE `ext_dict` DISABLE KEYS */;
/*!40000 ALTER TABLE `ext_dict` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stop_word`
--

DROP TABLE IF EXISTS `stop_word`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stop_word` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `word` char(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `word` (`word`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stop_word`
--

LOCK TABLES `stop_word` WRITE;
/*!40000 ALTER TABLE `stop_word` DISABLE KEYS */;
INSERT INTO `stop_word` VALUES (1,'的'),(2,'一个'),(3,'了'),(4,'在'),(5,'自己'),(6,'是'),(7,'和'),(8,'会'),(9,'都'),(10,'没有'),(11,'着');
/*!40000 ALTER TABLE `stop_word` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-05-19 23:20:43
