-- MySQL dump 10.13  Distrib 5.6.17, for Win32 (x86)
--
-- Host: localhost    Database: lt
-- ------------------------------------------------------
-- Server version	5.6.17

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
-- Table structure for table `lt_content`
--

DROP TABLE IF EXISTS `lt_content`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lt_content` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(32) NOT NULL DEFAULT '',
  `content` text,
  `count` int(11) NOT NULL DEFAULT '0',
  `mokuai` tinyint(4) NOT NULL DEFAULT '0',
  `imagename` varchar(32) NOT NULL DEFAULT '',
  `imagepath` varchar(50) NOT NULL DEFAULT '',
  `created_at` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `lt_content_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `lt_user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lt_content`
--

LOCK TABLES `lt_content` WRITE;
/*!40000 ALTER TABLE `lt_content` DISABLE KEYS */;
INSERT INTO `lt_content` VALUES (38,27,'123','&lt;p&gt;12312312&lt;br/&gt;&lt;/p&gt;',1,1,'','','2016-04-08'),(39,27,'111','&lt;p&gt;111&lt;br/&gt;&lt;/p&gt;',0,2,'','','2016-04-08');
/*!40000 ALTER TABLE `lt_content` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lt_discuss`
--

DROP TABLE IF EXISTS `lt_discuss`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lt_discuss` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `content` text,
  `content_id` int(10) unsigned NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `parentid` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `content_id` (`content_id`),
  CONSTRAINT `lt_discuss_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `lt_user` (`id`) ON DELETE CASCADE,
  CONSTRAINT `lt_discuss_ibfk_2` FOREIGN KEY (`content_id`) REFERENCES `lt_content` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lt_discuss`
--

LOCK TABLES `lt_discuss` WRITE;
/*!40000 ALTER TABLE `lt_discuss` DISABLE KEYS */;
INSERT INTO `lt_discuss` VALUES (36,27,'&lt;p&gt;dasdas&lt;/p&gt;&lt;p&gt;&lt;img alt=&quot;1460091564211673.jpg&quot; src=&quot;/ueditor/php/upload/image/20160408/1460091564211673.jpg&quot; style=&quot;width: 100px; height: 100px;&quot; title=&quot;1460091564211673.jpg&quot; height=&quot;100&quot; border=&quot;0&quot; vspace=&quot;0&quot; width=&quot;100&quot;/&gt;&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;/ueditor/php/upload/image/20160408/1460091564453425.jpg&quot; style=&quot;width: 1040px; height: 806px;&quot; title=&quot;1460091564453425.jpg&quot; height=&quot;806&quot; width=&quot;1040&quot;/&gt;&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;/ueditor/php/upload/image/20160408/1460091564411383.jpg&quot; style=&quot;&quot; title=&quot;1460091564411383.jpg&quot;/&gt;&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;/ueditor/php/upload/image/20160408/1460091564154785.jpg&quot; style=&quot;&quot; title=&quot;1460091564154785.jpg&quot;/&gt;&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;/ueditor/php/upload/image/20160408/1460091564377948.jpg&quot; style=&quot;&quot; title=&quot;1460091564377948.jpg&quot;/&gt;&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;/ueditor/php/upload/image/20160408/1460091564964858.jpg&quot; style=&quot;&quot; title=&quot;1460091564964858.jpg&quot;/&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;',38,'2016-04-08 13:00:17',0);
/*!40000 ALTER TABLE `lt_discuss` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lt_perm`
--

DROP TABLE IF EXISTS `lt_perm`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lt_perm` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `perm` varchar(32) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lt_perm`
--

LOCK TABLES `lt_perm` WRITE;
/*!40000 ALTER TABLE `lt_perm` DISABLE KEYS */;
INSERT INTO `lt_perm` VALUES (1,'xs'),(2,'yt'),(3,'hm'),(4,'bg'),(5,'bj'),(6,'hh'),(7,'tj'),(8,'ly'),(9,'wl'),(10,'yl'),(11,'tx'),(12,'yj'),(13,'bx'),(14,'txzl'),(15,'hyjt'),(16,'ysbj'),(17,'fsrm');
/*!40000 ALTER TABLE `lt_perm` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lt_problem`
--

DROP TABLE IF EXISTS `lt_problem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lt_problem` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `problem` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lt_problem`
--

LOCK TABLES `lt_problem` WRITE;
/*!40000 ALTER TABLE `lt_problem` DISABLE KEYS */;
INSERT INTO `lt_problem` VALUES (1,'父亲'),(2,'母亲'),(3,'高中'),(4,'初中');
/*!40000 ALTER TABLE `lt_problem` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lt_user`
--

DROP TABLE IF EXISTS `lt_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lt_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL DEFAULT '',
  `password` char(32) NOT NULL DEFAULT '',
  `perm` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `softdelete` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lt_user`
--

LOCK TABLES `lt_user` WRITE;
/*!40000 ALTER TABLE `lt_user` DISABLE KEYS */;
INSERT INTO `lt_user` VALUES (27,'admin123','0192023a7bbd73250516f069df18b500',1,'2016-04-08 11:56:27',0);
/*!40000 ALTER TABLE `lt_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lt_user_info`
--

DROP TABLE IF EXISTS `lt_user_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lt_user_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `name` varchar(20) NOT NULL DEFAULT '',
  `gender` enum('F','M') NOT NULL DEFAULT 'M',
  `birthday` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `mobile` varchar(20) NOT NULL DEFAULT '',
  `email` varchar(50) NOT NULL DEFAULT '',
  `sign` varchar(255) NOT NULL DEFAULT '',
  `imagename` varchar(32) NOT NULL DEFAULT '',
  `imagepath` varchar(200) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `lt_user_info_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `lt_user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lt_user_info`
--

LOCK TABLES `lt_user_info` WRITE;
/*!40000 ALTER TABLE `lt_user_info` DISABLE KEYS */;
INSERT INTO `lt_user_info` VALUES (4,27,'叶超','M','2016-05-08 00:00:00','14790085992','499375021@qq.com','这是一个测试','','/Uploads/2016-04-08/s57072c29623c9.jpg');
/*!40000 ALTER TABLE `lt_user_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lt_user_perm`
--

DROP TABLE IF EXISTS `lt_user_perm`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lt_user_perm` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `perm_id` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `perm_id` (`perm_id`),
  CONSTRAINT `lt_user_perm_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `lt_user` (`id`) ON DELETE CASCADE,
  CONSTRAINT `lt_user_perm_ibfk_2` FOREIGN KEY (`perm_id`) REFERENCES `lt_perm` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lt_user_perm`
--

LOCK TABLES `lt_user_perm` WRITE;
/*!40000 ALTER TABLE `lt_user_perm` DISABLE KEYS */;
/*!40000 ALTER TABLE `lt_user_perm` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lt_user_problem`
--

DROP TABLE IF EXISTS `lt_user_problem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lt_user_problem` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `problem_id` int(10) unsigned NOT NULL DEFAULT '0',
  `problems` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `problem_id` (`problem_id`),
  CONSTRAINT `lt_user_problem_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `lt_user` (`id`) ON DELETE CASCADE,
  CONSTRAINT `lt_user_problem_ibfk_2` FOREIGN KEY (`problem_id`) REFERENCES `lt_problem` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lt_user_problem`
--

LOCK TABLES `lt_user_problem` WRITE;
/*!40000 ALTER TABLE `lt_user_problem` DISABLE KEYS */;
INSERT INTO `lt_user_problem` VALUES (37,27,1,'123'),(38,27,2,'123'),(39,27,3,'123'),(40,27,1,'123'),(41,27,2,'123'),(42,27,3,'123');
/*!40000 ALTER TABLE `lt_user_problem` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lt_user_remember`
--

DROP TABLE IF EXISTS `lt_user_remember`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lt_user_remember` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `remember` varchar(60) NOT NULL DEFAULT '',
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `lt_user_remember_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `lt_user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lt_user_remember`
--

LOCK TABLES `lt_user_remember` WRITE;
/*!40000 ALTER TABLE `lt_user_remember` DISABLE KEYS */;
/*!40000 ALTER TABLE `lt_user_remember` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-04-08 14:34:47
