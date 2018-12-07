-- MySQL dump 10.13  Distrib 5.7.24, for Linux (x86_64)
--
-- Host: localhost    Database: biuletyn
-- ------------------------------------------------------
-- Server version	5.7.24-0ubuntu0.18.04.1

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
-- Current Database: `biuletyn`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `biuletyn` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `biuletyn`;

--
-- Table structure for table `cinema`
--

DROP TABLE IF EXISTS `cinema`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cinema` (
  `title` varchar(60) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cinema`
--

LOCK TABLES `cinema` WRITE;
/*!40000 ALTER TABLE `cinema` DISABLE KEYS */;
INSERT INTO `cinema` VALUES ('Fajny film test','2018-12-12');
/*!40000 ALTER TABLE `cinema` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `modification`
--

DROP TABLE IF EXISTS `modification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `modification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author` varchar(30) NOT NULL,
  `time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_news` int(11) NOT NULL DEFAULT '-1',
  `modified_cinema` tinyint(1) DEFAULT '0',
  `action` enum('create','update','delete') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `author` (`author`),
  KEY `modified_news` (`modified_news`),
  CONSTRAINT `modification_ibfk_1` FOREIGN KEY (`author`) REFERENCES `user` (`login`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `modification`
--

LOCK TABLES `modification` WRITE;
/*!40000 ALTER TABLE `modification` DISABLE KEYS */;
INSERT INTO `modification` VALUES (1,'W_Sadowski','2018-12-07 12:16:50',12,0,'update'),(2,'W_Sadowski','2018-12-07 12:16:54',7,0,'update'),(3,'W_Sadowski','2018-12-07 12:17:14',14,0,'create'),(4,'S_Thom','2018-12-07 12:17:39',12,0,'update'),(5,'S_Thom','2018-12-07 12:17:45',14,0,'update'),(6,'S_Thom','2018-12-07 12:17:51',-1,1,'update'),(7,'S_Thom','2018-12-07 12:18:12',12,0,'update'),(8,'S_Thom','2018-12-07 12:18:27',6,0,'update');
/*!40000 ALTER TABLE `modification` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(60) CHARACTER SET utf8 NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `content` text CHARACTER SET utf8 NOT NULL,
  `type` enum('statement','contest') NOT NULL DEFAULT 'statement',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news`
--

LOCK TABLES `news` WRITE;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
INSERT INTO `news` VALUES (6,'Title title title tescik','2018-12-05 00:00:00','W przeciwieństwie do rozpowszechnionych opinii, Lorem Ipsum nie jest tylko przypadkowym tekstem. Ma ono korzenie w klasycznej łacińskiej literaturze z 45 roku przed Chrystusem, czyli ponad 2000 lat temu! Richard McClintock, wykładowca łaciny na uniwersytecie Hampden-Sydney w Virginii, przyjrzał się uważniej jednemu z najbardziej niejasnych słów w Lorem Ipsum – consectetur –<h1>Tekst</h1>  i po wielu poszukiwaniach odnalazł niezaprzeczalne źródło: Lorem Ipsum pochodzi z fragmentów (1.10.32 i 1.10.33) „de Finibus Bonorum et Malorum”, czyli „O granicy dobra i zła”, napisanej właśnie w 45 p.n.e. przez Cycerona. Jest to bardzo popularna w czasach renesansu rozprawa na temat etyki. Pierwszy wiersz Lorem Ipsum, „Lorem ipsum dolor sit amet...” pochodzi właśnie z sekcji 1.10.32.\r\n\r\nStandardowy blok Lorem Ipsum, używany od XV wieku, jest odtworzony niżej dla zainteresowanych. Fragmenty 1.10.32 i 1.10.33 z „de Finibus Bonorum et Malorum” Cycerona, są odtworzone w dokładnej, oryginalnej formie, wraz z angielskimi tłumaczeniami H. Rackhama z 1914 roku','statement'),(7,'titleeexd','2018-12-05 00:00:00','W przeciwieństwie do rozpowszechnionych opinii, Lorem Ipsum nie jest tylko przypadkowym tekstem. Ma ono korzenie w klasycznej łacińskiej literaturze z 45 roku przed Chrystusem, czyli ponad 2000 lat temu! Richard McClintock, wykładowca łaciny na uniwersytecie Hampden-Sydney w Virginii, przyjrzał się uważniej jednemu z najbardziej niejasnych słów w Lorem Ipsum – consectetur –<h1>Tekst</h1>  i po wielu poszukiwaniach odnalazł niezaprzeczalne źródło: Lorem Ipsum pochodzi z fragmentów (1.10.32 i 1.10.33) „de Finibus Bonorum et Malorum”, czyli „O granicy dobra i zła”, napisanej właśnie w 45 p.n.e. przez Cycerona. Jest to bardzo popularna w czasach renesansu rozprawa na temat etyki. Pierwszy wiersz Lorem Ipsum, „Lorem ipsum dolor sit amet...” pochodzi właśnie z sekcji 1.10.32.\r\n\r\nStandardowy blok Lorem Ipsum, używany od qwefqXV wieku, jest odtworzony niżej dla zainteresowanych. Fragmenty 1.10.32 i 1.10.33 z „de Finibus Bonorum et Malorum” Cycerona, są odtworzone w dokładnej, oryginalnej formie, wraz z angielskimi tłumaczeniami H. Rackhama z 1914 roku wdwwd ewdwe','statement'),(8,'RAJD PIESZY','2018-12-05 00:00:00','W przeciwieństwie do rozpowszechnionych opinii, Lorem Ipsum nie jest tylko przypadkowym tekstem. Ma ono korzenie w klasycznej łacińskiej literaturze z 45 roku przed Chrystusem, czyli ponad 2000 lat temu! Richard McClintock, wykładowca łaciny na uniwersytecie Hampden-Sydney w Virginii, przyjrzał się uważniej jednemu z najbardziej niejasnych słów w Lorem Ipsum – consectetur –<h1>Tekst</h1>  i po wielu poszukiwaniach odnalazł niezaprzeczalne źródło: Lorem Ipsum pochodzi z fragmentów (1.10.32 i 1.10.33) „de Finibus Bonorum et Malorum”, czyli „O granicy dobra i zła”, napisanej właśnie w 45 p.n.e. przez Cycerona. Jest to bardzo popularna w czasach renesansu rozprawa na temat etyki. Pierwszy wiersz Lorem Ipsum, „Lorem ipsum dolor sit amet...” pochodzi właśnie z sekcji 1.10.32.\r\n\r\nStandardowy blok Lorem Ipsum, używany od XV wieku, jest odtworzony niżej dla zainteresowanych. Fragmenty 1.10.32 i 1.10.33 z „de Finibus Bonorum et Malorum” Cycerona, są odtworzone w dokładnej, oryginalnej formie, wraz z angielskimi tłumaczeniami H. Rackhama z 1914 roku \r\nStandardowy blok Lorem Ipsum, używany od XV wieku, jest odtworzony niżej dla zainteresowanych. Fragmenty 1.10.32 i 1.10.33 z „de Finibus Bonorum et Malorum” Cycerona, są odtworzone w dokładnej, oryginalnej formie, wraz z angielskimi tłumaczeniami H. Rackhama z 1914 roku \r\nStandardowy blok Lorem Ipsum, używany od XV wieku, jest odtworzony niżej dla zainteresowanych. Fragmenty 1.10.32 i 1.10.33 z „de Finibus Bonorum et Malorum” Cycerona, są odtworzone w dokładnej, oryginalnej formie, wraz z angielskimi tłumaczeniami H. Rackhama z 1914 roku \r\nW przeciwieństwie do rozpowszechnionych opinii, Lorem Ipsum nie jest tylko przypadkowym tekstem. Ma ono korzenie w klasycznej łacińskiej literaturze z 45 roku przed Chrystusem, czyli ponad 2000 lat temu! Richard McClintock, wykładowca łaciny na uniwersytecie Hampden-Sydney w Virginii, przyjrzał się uważniej jednemu z najbardziej niejasnych słów w Lorem Ipsum – consectetur –<h1>Tekst</h1>  i po wielu poszukiwaniach odnalazł niezaprzeczalne źródło: Lorem Ipsum pochodzi z fragmentów (1.10.32 i 1.10.33) „de Finibus Bonorum et Malorum”, czyli „O granicy dobra i zła”, napisanej właśnie w 45 p.n.e. przez Cycerona. Jest to bardzo popularna w czasach renesansu rozprawa na temat etyki. Pierwszy wiersz Lorem Ipsum, „Lorem ipsum dolor sit amet...” pochodzi właśnie z sekcji 1.10.32.\r\n\r\nStandardowy blok Lorem Ipsum, używany od XV wieku, jest odtworzony niżej dla zainteresowanych. Fragmenty 1.10.32 i 1.10.33 z „de Finibus Bonorum et Malorum” Cycerona, są odtworzone w dokładnej, oryginalnej formie, wraz z angielskimi tłumaczeniami H. Rackhama z 1914 roku \r\nStandardowy blok Lorem Ipsum, używany od XV wieku, jest odtworzony niżej dla zainteresowanych. Fragmenty 1.10.32 i 1.10.33 z „de Finibus Bonorum et Malorum” Cycerona, są odtworzone w dokładnej, oryginalnej formie, wraz z angielskimi tłumaczeniami H. Rackhama z 1914 roku \r\nStandardowy blok Lorem Ipsum, używany od XV wieku, jest odtworzony niżej dla zainteresowanych. Fragmenty 1.10.32 i 1.10.33 z „de Finibus Bonorum et Malorum” Cycerona, są odtworzone w dokładnej, oryginalnej formie, wraz z angielskimi tłumaczeniami H. Rackhama z 1914 roku ','contest'),(10,'sdfsfsdffg','2018-12-07 00:00:00',' jhbdfkjhwefbkj jhbdfkjhwefbkj jhbdfkjhwefbkj jhbdfkjhwefbkj jhbdfkjhwefbkj jhbdfkjhwefbkj jhbdfkjhwefbkj jhbdfkjhwefbkj jhbdfkjhwefbkj jhbdfkjhwefbkj jhbdfkjhwefbkj jhbdfkjhwefbkj jhbdfkjhwefbkj jhbdfkjhwefbkj jhbdfkjhwefbkj jhbdfkjhwefbkj jhbdfkjhwefbkj jhbdfkjhwefbkj jhbdfkjhwefbkj jhbdfkjhwefbkj jhbdfkjhwefbkj jhbdfkjhwefbkj jhbdfkjhwefbkj jhbdfkjhwefbkj jhbdfkjhwefbkj jhbdfkjhwefbkj jhbdfkjhwefbkj','contest'),(12,'TESTOWY TYTULcww','2018-12-07 00:00:00','DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TdcdEKSTU scwdDUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DsdUZO edweTEhgjhyuKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU wdsxwdewqfqwef','statement'),(14,'fdfewfwefrfewr','2018-12-07 00:00:00','DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU DUZO TEKSTU ','contest');
/*!40000 ALTER TABLE `news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `login` varchar(30) NOT NULL,
  `password` char(64) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  PRIMARY KEY (`login`),
  UNIQUE KEY `login` (`login`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES ('S_Thom','$2y$10$vVIePhp2eJ4oGPZCqLRu5eEalgrNeNlddnZC9tbcft6.IZZMV2thC','admin'),('Test','$2y$10$z.zjCUUZmMqAdGFjHwd6y.HEP/YgAYVoLCzmqfmX8nPHZGVwXP12q','user'),('W_Sadowski','$2y$10$7RQ2dF6GbzkKvh.hCy16BeeR2vEd4m4BGDQ/yGkaeHdkEk0i1K.rW','admin');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-12-07 12:19:24
