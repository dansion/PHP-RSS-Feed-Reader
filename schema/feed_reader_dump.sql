-- MySQL dump 10.11
--
-- Host: localhost    Database: feed_reader
-- ------------------------------------------------------
-- Server version	5.0.45-community-nt

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
-- Table structure for table `web_feeds`
--

DROP TABLE IF EXISTS `web_feeds`;
CREATE TABLE `web_feeds` (
  `feed_id` int(11) NOT NULL auto_increment,
  `feed_name` varchar(255) collate latin1_general_ci NOT NULL,
  `feed_link` varchar(255) collate latin1_general_ci NOT NULL,
  `created` timestamp NULL default NULL,
  `modified` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`feed_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `web_feeds`
--

LOCK TABLES `web_feeds` WRITE;
/*!40000 ALTER TABLE `web_feeds` DISABLE KEYS */;
INSERT INTO `web_feeds` VALUES (1,'Reddit','http://rss.reddit.com/ ','2008-12-10 10:29:50','2008-12-10 10:53:24'),(2,'Digg','http://feeds.digg.com/digg/popular.rss ','2008-12-09 17:16:10','2008-12-09 17:16:10'),(3,'BBC','http://newsrss.bbc.co.uk/rss/newsonline_uk_edition/uk/rss.xml ','2008-12-09 17:16:25','2008-12-10 10:50:10');
/*!40000 ALTER TABLE `web_feeds` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2008-12-10 17:46:06
