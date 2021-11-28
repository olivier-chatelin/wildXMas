-- MySQL dump 10.13  Distrib 8.0.27, for Linux (x86_64)
--
-- Host: localhost    Database: x-mas
-- ------------------------------------------------------
-- Server version	8.0.27-0ubuntu0.20.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `csv_file`
--

DROP TABLE IF EXISTS `csv_file`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `csv_file` (
  `id` int NOT NULL AUTO_INCREMENT,
  `csv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `csv_file`
--

LOCK TABLES `csv_file` WRITE;
/*!40000 ALTER TABLE `csv_file` DISABLE KEYS */;
/*!40000 ALTER TABLE `csv_file` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `default_reward`
--

DROP TABLE IF EXISTS `default_reward`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `default_reward` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `default_reward`
--

LOCK TABLES `default_reward` WRITE;
/*!40000 ALTER TABLE `default_reward` DISABLE KEYS */;
INSERT INTO `default_reward` VALUES (21,'eurRem'),(22,'eurReg'),(23,'frRem'),(24,'frReg');
/*!40000 ALTER TABLE `default_reward` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `default_reward_reward`
--

DROP TABLE IF EXISTS `default_reward_reward`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `default_reward_reward` (
  `default_reward_id` int NOT NULL,
  `reward_id` int NOT NULL,
  PRIMARY KEY (`default_reward_id`,`reward_id`),
  KEY `IDX_1A4A2FC475048406` (`default_reward_id`),
  KEY `IDX_1A4A2FC4E466ACA1` (`reward_id`),
  CONSTRAINT `FK_1A4A2FC475048406` FOREIGN KEY (`default_reward_id`) REFERENCES `default_reward` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_1A4A2FC4E466ACA1` FOREIGN KEY (`reward_id`) REFERENCES `reward` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `default_reward_reward`
--

LOCK TABLES `default_reward_reward` WRITE;
/*!40000 ALTER TABLE `default_reward_reward` DISABLE KEYS */;
/*!40000 ALTER TABLE `default_reward_reward` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctrine_migration_versions`
--

LOCK TABLES `doctrine_migration_versions` WRITE;
/*!40000 ALTER TABLE `doctrine_migration_versions` DISABLE KEYS */;
INSERT INTO `doctrine_migration_versions` VALUES ('DoctrineMigrations\\Version20211120092413','2021-11-24 01:00:58',1044),('DoctrineMigrations\\Version20211120193636','2021-11-24 01:00:59',38),('DoctrineMigrations\\Version20211120215547','2021-11-24 01:00:59',28),('DoctrineMigrations\\Version20211120220805','2021-11-24 01:00:59',45),('DoctrineMigrations\\Version20211120223438','2021-11-24 01:00:59',58),('DoctrineMigrations\\Version20211121211219','2021-11-24 01:00:59',414),('DoctrineMigrations\\Version20211123202103','2021-11-24 01:01:00',162),('DoctrineMigrations\\Version20211123210550','2021-11-24 01:01:00',98),('DoctrineMigrations\\Version20211123215454','2021-11-24 01:01:00',95),('DoctrineMigrations\\Version20211123222621','2021-11-24 01:01:00',271),('DoctrineMigrations\\Version20211126055400','2021-11-26 06:54:08',53),('DoctrineMigrations\\Version20211128152148','2021-11-28 16:21:56',129),('DoctrineMigrations\\Version20211128180203','2021-11-28 19:02:12',145);
/*!40000 ALTER TABLE `doctrine_migration_versions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `instructor`
--

DROP TABLE IF EXISTS `instructor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `instructor` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_remote` tinyint(1) NOT NULL,
  `is_french` tinyint(1) NOT NULL,
  `csv_file_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_31FC43DDE7927C74` (`email`),
  UNIQUE KEY `UNIQ_31FC43DDBED78269` (`csv_file_id`),
  CONSTRAINT `FK_31FC43DDBED78269` FOREIGN KEY (`csv_file_id`) REFERENCES `csv_file` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `instructor`
--

LOCK TABLES `instructor` WRITE;
/*!40000 ALTER TABLE `instructor` DISABLE KEYS */;
INSERT INTO `instructor` VALUES (33,'olivier.chatelin@wildcodeschool.com','[\"ROLE_USER\"]','$argon2id$v=19$m=65536,t=4,p=1$waYp8c9IZBt44OOmDQ7IHA$WC9ic5TvcVqkMaIOV3HgyWzakqPMaA05MQvln/1ZJNw',0,1,NULL),(34,'fr-rem@gmail.com','[\"ROLE_USER\"]','$argon2id$v=19$m=65536,t=4,p=1$s9I0AphO6rOgMeDddHqbPA$z8Qqmr6yIK9AqQOyeXpUfcTScEJa+6uogLPHCa2Fbac',1,1,NULL),(35,'fr-reg@gmail.com','[\"ROLE_USER\"]','$argon2id$v=19$m=65536,t=4,p=1$pEQ7KnABDfptOsm+WQep/g$EwRZMsD39ZitYlpCirTJvdZjXXQmkaMpYpFLuOZanmU',0,1,NULL),(36,'eur-reg@gmail.com','[\"ROLE_USER\"]','$argon2id$v=19$m=65536,t=4,p=1$c3tbTxwqpA9xHrde1Vap2A$xU5V19uwHv+Q0il0OR45PMFRF5TWoFIgS7/tsXYxHJ4',0,0,NULL),(37,'eur-rem@gmail.com','[\"ROLE_USER\"]','$argon2id$v=19$m=65536,t=4,p=1$ZiTE+MumnQUfi7Zc2RIg4w$gwk7hpjpTT7SBxRs9mf3/dxC7D7GJ3bH/rRF99V9IKk',1,0,NULL),(38,'camille.sabatier@wildcodeschool.com','[\"ROLE_SUPER_ADMIN\", \"ROLE_ADMIN\", \"ROLE_USER\"]','$argon2id$v=19$m=65536,t=4,p=1$SJ7JTV10KckhioumjfJ5UA$FTadzBFl03JO/AhFBgQrZxizYEMikCMRCW72pkZDyKw',0,1,NULL);
/*!40000 ALTER TABLE `instructor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `instructor_reward`
--

DROP TABLE IF EXISTS `instructor_reward`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `instructor_reward` (
  `instructor_id` int NOT NULL,
  `reward_id` int NOT NULL,
  PRIMARY KEY (`instructor_id`,`reward_id`),
  KEY `IDX_3169AD0F8C4FC193` (`instructor_id`),
  KEY `IDX_3169AD0FE466ACA1` (`reward_id`),
  CONSTRAINT `FK_3169AD0F8C4FC193` FOREIGN KEY (`instructor_id`) REFERENCES `instructor` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_3169AD0FE466ACA1` FOREIGN KEY (`reward_id`) REFERENCES `reward` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `instructor_reward`
--

LOCK TABLES `instructor_reward` WRITE;
/*!40000 ALTER TABLE `instructor_reward` DISABLE KEYS */;
INSERT INTO `instructor_reward` VALUES (38,368),(38,369),(38,370),(38,371),(38,372),(38,373),(38,374),(38,375),(38,376),(38,377),(38,378),(38,379),(38,380),(38,381),(38,382),(38,383),(38,384),(38,385),(38,386),(38,387),(38,388);
/*!40000 ALTER TABLE `instructor_reward` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reward`
--

DROP TABLE IF EXISTS `reward`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reward` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_good` tinyint(1) NOT NULL,
  `is_remote_friendly` tinyint(1) NOT NULL,
  `scheduled_at` date DEFAULT NULL,
  `is_french` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=389 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reward`
--

LOCK TABLES `reward` WRITE;
/*!40000 ALTER TABLE `reward` DISABLE KEYS */;
INSERT INTO `reward` VALUES (368,'Recevoir un badge','https://i.ibb.co/DMDJCZg/badge.png',1,1,NULL,1),(369,'Here\'s a new badge especially for you','https://i.ibb.co/DMDJCZg/badge.png',1,1,NULL,0),(370,'Porter un objet de Noël toute la journée','https://i.ibb.co/rFwFRrn/t-l-chargement-1-1.jpg',1,1,NULL,1),(371,'Réussir un codewars choisi par ton formateur','https://i.ibb.co/GVyC3Ct/t-l-chargement-2.jpg',1,1,NULL,1),(372,'Faire une quête d\'un autre cursus','https://i.ibb.co/1X5tQ5P/photo-portrait-bearded-student-playing-260nw-1869601915.png',1,1,NULL,1),(373,'échanger sa veille','https://i.ibb.co/LnxrG0y/les-objectifs-de-la-veille-technologique-300x300.jpg',1,1,NULL,1),(374,'Réaliser et animer un dojo','https://i.ibb.co/7z0nF8Z/Seattle-Budokan-Dojo-judo-demo-04.jpg',0,1,NULL,1),(375,'Recevoir un objet wild','https://i.ibb.co/drfcF9y/t-l-chargement.png',1,1,NULL,1),(376,'Faire son daily en anglais','https://i.ibb.co/xSnHyXJ/joey.jpg',1,1,NULL,1),(377,'Devenir le délégué de la semaine','https://i.ibb.co/r7mBbDj/cea32b77cc47ad7a0d51c4eb3c8c52e5b87bf9fc.jpg',1,1,NULL,1),(378,'Coder toute la journée avec un autre IDE','https://i.ibb.co/qFWy7Tz/Coding-html-and-css-in-IDE-macro-Software-development-Software-source-code.jpg',1,1,NULL,1),(379,'MODIFIER TON PSEUDO EN \"PÈRE NOËL\" et répondre à toutes les demandes de ta promo','https://i.ibb.co/BzLXp3K/le-pere-noel-est-une-ordure-28-decembre.jpg',0,1,NULL,1),(380,'animer un live coding','https://i.ibb.co/zZCj14Y/1035918.jpg',0,1,NULL,1),(381,'Short day de 30 min','https://i.ibb.co/bKwTL8n/images-1.jpg',1,1,NULL,1),(382,'se déguiser en son formateur','https://i.ibb.co/T0671cW/maurice-moss-it-crowd.jpg',1,1,NULL,1),(383,'Faire une veille en plus','https://i.ibb.co/hXSmtxb/t-l-chargement.jpg',0,1,NULL,1),(384,'Choisis le jeu de ce soir','https://i.ibb.co/qkP52Py/images.jpg',1,0,NULL,1),(385,'Ton formateur te fait ton café toute la journée','https://i.ibb.co/Drd9dxK/6944-full.png',1,0,NULL,1),(386,'Bon pour  une grasse mat\' (accord avec ton formateur et ton SEM','https://i.ibb.co/Srb2rS6/2000003627084.jpg',1,1,NULL,1),(387,'faire un gâteau ou emporter des bonbons','https://i.ibb.co/3yNHYbM/g-teau-maxi-fiesta-en-bonbons.jpg',1,0,NULL,1),(388,'Make a cake or bring some candies','https://i.ibb.co/mBjJ505/g-teau-maxi-fiesta-en-bonbons.jpg',1,0,NULL,0);
/*!40000 ALTER TABLE `reward` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `student` (
  `id` int NOT NULL AUTO_INCREMENT,
  `instructor_id` int DEFAULT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B723AF338C4FC193` (`instructor_id`),
  CONSTRAINT `FK_B723AF338C4FC193` FOREIGN KEY (`instructor_id`) REFERENCES `instructor` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=977 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student`
--

LOCK TABLES `student` WRITE;
/*!40000 ALTER TABLE `student` DISABLE KEYS */;
/*!40000 ALTER TABLE `student` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student_reward`
--

DROP TABLE IF EXISTS `student_reward`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `student_reward` (
  `student_id` int NOT NULL,
  `reward_id` int NOT NULL,
  PRIMARY KEY (`student_id`,`reward_id`),
  KEY `IDX_C0E7AAD3CB944F1A` (`student_id`),
  KEY `IDX_C0E7AAD3E466ACA1` (`reward_id`),
  CONSTRAINT `FK_C0E7AAD3CB944F1A` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_C0E7AAD3E466ACA1` FOREIGN KEY (`reward_id`) REFERENCES `reward` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student_reward`
--

LOCK TABLES `student_reward` WRITE;
/*!40000 ALTER TABLE `student_reward` DISABLE KEYS */;
/*!40000 ALTER TABLE `student_reward` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-11-28 20:34:04
