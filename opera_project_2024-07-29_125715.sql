-- MySQL dump 10.13  Distrib 8.0.35, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: opera_project
-- ------------------------------------------------------
-- Server version	8.0.35

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
-- Table structure for table `action`
--

DROP TABLE IF EXISTS `action`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `action` (
  `id` int NOT NULL AUTO_INCREMENT,
  `goal_id` int NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `priority` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `due_date` datetime DEFAULT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_47CC8C92667D1AFE` (`goal_id`),
  CONSTRAINT `FK_47CC8C92667D1AFE` FOREIGN KEY (`goal_id`) REFERENCES `goal` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `action`
--

/*!40000 ALTER TABLE `action` DISABLE KEYS */;
INSERT INTO `action` VALUES (32,231,'Traiter 75 dossiers par journée productive (6.5h)','1','En cours',NULL,NULL,NULL,NULL),(33,232,'ouyvoytovoyutroè','1','En cours',NULL,NULL,NULL,NULL),(34,232,'oubyvtrci(-','1','En cours',NULL,NULL,NULL,NULL),(35,235,'Appeler Client pour confirmation délai','1','En cours',NULL,NULL,'2024-05-06 17:18:00',NULL);
/*!40000 ALTER TABLE `action` ENABLE KEYS */;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=161 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (156,'Objectif de production','Description de la Categorie 1','2024-04-29 12:35:27','2024-04-29 12:35:27'),(157,'Gestion des Réclamations de niveau 1','Description de la Categorie 2','2024-04-29 12:35:27','2024-04-29 12:35:27'),(158,'Objectif de productivité','Description de la Categorie 3','2024-04-29 12:35:27','2024-04-29 12:35:27'),(159,'Objectif comportemental','Description de la Categorie 4','2024-04-29 12:35:27','2024-04-29 12:35:27'),(160,'Gestion des réclamations de niveau 2','Description de la Categorie 5','2024-04-29 12:35:27','2024-04-29 12:35:27');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;

--
-- Table structure for table `config`
--

DROP TABLE IF EXISTS `config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `config` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `config`
--

/*!40000 ALTER TABLE `config` DISABLE KEYS */;
/*!40000 ALTER TABLE `config` ENABLE KEYS */;

--
-- Table structure for table `employee_sentiments`
--

DROP TABLE IF EXISTS `employee_sentiments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `employee_sentiments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `sentiment_value` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `comment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `intensity` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `manager` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `personal_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_2F26F4625D430949` (`personal_id`),
  CONSTRAINT `FK_2F26F4625D430949` FOREIGN KEY (`personal_id`) REFERENCES `personal` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=252 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee_sentiments`
--

/*!40000 ALTER TABLE `employee_sentiments` DISABLE KEYS */;
INSERT INTO `employee_sentiments` VALUES (241,'Sentiment 1','2024-04-29 12:35:34','Commentaire du sentiment 1','Categorie 1','Intensité 1',NULL,NULL),(242,'Sentiment 2','2024-04-29 12:35:34','Commentaire du sentiment 2','Categorie 2','Intensité 2',NULL,NULL),(243,'Sentiment 3','2024-04-29 12:35:34','Commentaire du sentiment 3','Categorie 3','Intensité 3',NULL,NULL),(244,'Sentiment 4','2024-04-29 12:35:34','Commentaire du sentiment 4','Categorie 4','Intensité 4',NULL,NULL),(245,'Sentiment 5','2024-04-29 12:35:34','Commentaire du sentiment 5','Categorie 5','Intensité 5',NULL,NULL),(246,'Sentiment 6','2024-04-29 12:35:34','Commentaire du sentiment 6','Categorie 6','Intensité 6',NULL,NULL),(247,'Sentiment 7','2024-04-29 12:35:34','Commentaire du sentiment 7','Categorie 7','Intensité 7',NULL,NULL),(248,'Sentiment 8','2024-04-29 12:35:34','Commentaire du sentiment 8','Categorie 8','Intensité 8',NULL,NULL),(249,'Sentiment 9','2024-04-29 12:35:34','Commentaire du sentiment 9','Categorie 9','Intensité 9',NULL,NULL),(250,'Sentiment 10','2024-04-29 12:35:34','Commentaire du sentiment 10','Categorie 10','Intensité 10',NULL,NULL),(251,'sad','2024-07-24 12:58:00','Estelle elle me fait des misères avec son chatgpt premium',NULL,NULL,NULL,314);
/*!40000 ALTER TABLE `employee_sentiments` ENABLE KEYS */;

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `feedback` (
  `id` int NOT NULL AUTO_INCREMENT,
  `interview_id` int DEFAULT NULL,
  `feedback_text` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `personal_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_D229445855D69D95` (`interview_id`),
  KEY `IDX_D22944585D430949` (`personal_id`),
  CONSTRAINT `FK_D229445855D69D95` FOREIGN KEY (`interview_id`) REFERENCES `interview` (`id`),
  CONSTRAINT `FK_D22944585D430949` FOREIGN KEY (`personal_id`) REFERENCES `personal` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `feedback`
--

/*!40000 ALTER TABLE `feedback` DISABLE KEYS */;
INSERT INTO `feedback` VALUES (15,95,'Feedback text pour l\'entretien95','2024-04-29 12:35:35','Type de feedback',NULL,NULL),(16,96,'Feedback text pour l\'entretien96','2024-04-29 12:35:35','Type de feedback',NULL,NULL),(17,97,'Feedback text pour l\'entretien97','2024-04-29 12:35:35','Type de feedback',NULL,NULL),(18,98,'Feedback text pour l\'entretien98','2024-04-29 12:35:35','Type de feedback',NULL,NULL),(19,99,'Feedback text pour l\'entretien99','2024-04-29 12:35:35','Type de feedback',NULL,NULL),(20,100,'Feedback text pour l\'entretien100','2024-04-29 12:35:35','Type de feedback',NULL,NULL),(25,105,'abcdefgh','2024-05-03 10:57:00','One to one','Terminé',314),(27,108,'lkjnlkj','2024-05-03 11:31:00','One to one','Terminé',314),(29,117,'Objectifs atteints hormis l\'activité optique','2024-07-31 23:31:00','Performance juin 2024','Terminé',314),(31,121,'oi uih pfiu hpifurpfpuyapy','2024-09-03 13:15:00','Performance aout 2024','Terminé',314),(32,122,'iute crita\"t\"\'\'\"(bv\"','2024-09-30 13:13:00','Performance août 2024','Terminé',314),(33,123,'yuerbcizro u p','2024-05-24 15:38:00','One to one','Terminé',314),(34,124,'gyDTXIXPUXYB','2024-05-25 11:00:00','One to one','Terminé',314);
/*!40000 ALTER TABLE `feedback` ENABLE KEYS */;

--
-- Table structure for table `goal`
--

DROP TABLE IF EXISTS `goal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `goal` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_id` int DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deadline` datetime DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `priority` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `personal_id` int DEFAULT NULL,
  `interview_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_FCDCEB2E12469DE2` (`category_id`),
  KEY `IDX_FCDCEB2E5D430949` (`personal_id`),
  KEY `IDX_FCDCEB2E55D69D95` (`interview_id`),
  CONSTRAINT `FK_FCDCEB2E12469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  CONSTRAINT `FK_FCDCEB2E55D69D95` FOREIGN KEY (`interview_id`) REFERENCES `interview` (`id`),
  CONSTRAINT `FK_FCDCEB2E5D430949` FOREIGN KEY (`personal_id`) REFERENCES `personal` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=241 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `goal`
--

/*!40000 ALTER TABLE `goal` DISABLE KEYS */;
INSERT INTO `goal` VALUES (231,156,'Saisir 75 dossiers pour 6h productif','2024-05-30 00:00:00','En cours','1',NULL,NULL,311,105),(232,160,'aAZERTYYYYY','2024-05-19 00:00:00','En cours','1',NULL,NULL,312,105),(233,156,'Finaliser le sprint 1 du projet OPERA','2024-05-17 00:00:00','En cours','1',NULL,NULL,311,116),(234,157,'Organiser meeting avec les dev','2024-05-07 00:00:00','En cours','1',NULL,NULL,311,105),(235,157,'Finalier le projet OPERA','2024-06-30 00:00:00','En cours','1',NULL,NULL,314,105),(236,156,'Traiter les réclamations de niveau 1 dans un délai de 48h','2024-12-31 00:00:00','En cours','1',NULL,NULL,314,117),(238,156,'Augmenter le nombre de dossier optique d 5 points par jour.','2024-09-30 00:00:00','En cours','1',NULL,NULL,314,117),(239,156,'Augmenter la production moyenne des dossiers optiques de 5 points','2024-09-30 00:00:00','En cours','1',NULL,NULL,314,117),(240,156,'Créer la procédure métier pour le poste Dentaire','2024-10-23 00:00:00','En cours','1',NULL,NULL,314,122);
/*!40000 ALTER TABLE `goal` ENABLE KEYS */;

--
-- Table structure for table `interview`
--

DROP TABLE IF EXISTS `interview`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `interview` (
  `id` int NOT NULL AUTO_INCREMENT,
  `interviewer_id` int DEFAULT NULL,
  `interviewee_id` int NOT NULL,
  `type_interview_id` int NOT NULL,
  `date` datetime DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_CF1D3C34B4C8B6CE` (`interviewee_id`),
  KEY `IDX_CF1D3C34D2952790` (`type_interview_id`),
  KEY `IDX_CF1D3C347906D9E8` (`interviewer_id`),
  CONSTRAINT `FK_CF1D3C347906D9E8` FOREIGN KEY (`interviewer_id`) REFERENCES `personal` (`id`),
  CONSTRAINT `FK_CF1D3C34B4C8B6CE` FOREIGN KEY (`interviewee_id`) REFERENCES `personal` (`id`),
  CONSTRAINT `FK_CF1D3C34D2952790` FOREIGN KEY (`type_interview_id`) REFERENCES `type_interview` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=131 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `interview`
--

/*!40000 ALTER TABLE `interview` DISABLE KEYS */;
INSERT INTO `interview` VALUES (95,315,315,136,'2024-04-29 12:35:34','En attente','Entretien annuel 5','Description de l\'entretien 5'),(96,316,319,136,'2024-04-29 12:35:34','En attente','Entretien annuel 6','Description de l\'entretien 6'),(97,317,315,136,'2024-04-29 12:35:34','En attente','Entretien annuel 7','Description de l\'entretien 7'),(98,318,314,135,'2024-04-29 12:35:34','En attente','Entretien annuel 8','Description de l\'entretien 8'),(99,319,311,136,'2024-04-29 12:35:34','En attente','Entretien annuel 9','Description de l\'entretien 9'),(100,320,316,136,'2024-04-29 12:35:34','En attente','Entretien annuel 10','Description de l\'entretien 10'),(101,NULL,316,136,'2024-05-02 09:52:00',NULL,NULL,NULL),(102,NULL,316,136,'2024-05-02 09:52:00',NULL,NULL,NULL),(103,NULL,316,136,'2024-05-02 09:52:00',NULL,NULL,NULL),(105,314,311,139,'2024-05-07 11:30:00','En attente de validation',NULL,NULL),(108,314,315,139,'2024-05-16 11:32:00','En attente de validation',NULL,NULL),(109,314,316,139,'2024-05-15 11:32:00','En attente de validation',NULL,NULL),(111,314,318,139,'2024-05-21 11:33:00','En attente de validation',NULL,NULL),(115,314,316,137,'2024-05-16 08:35:00','En attente de validation',NULL,NULL),(116,314,311,135,'2024-05-09 09:02:00','Planifié',NULL,NULL),(117,314,311,135,'2024-05-31 16:00:00','Planifié',NULL,NULL),(121,314,311,136,'2024-09-03 14:15:00','Planifié',NULL,NULL),(122,314,311,136,'2024-09-30 16:00:00','Planifié',NULL,NULL),(123,314,311,139,'2024-05-24 15:37:00','Planifié',NULL,NULL),(124,314,311,139,'2024-05-25 10:59:00','Planifié',NULL,NULL),(125,314,311,142,'2024-06-14 08:00:00','Planifié',NULL,NULL),(126,314,318,144,'2024-06-14 09:05:00','Planifié',NULL,NULL),(127,314,317,139,'2024-06-14 10:00:00','Planifié',NULL,NULL),(128,314,314,135,'2024-06-14 10:40:00','Planifié',NULL,NULL),(129,314,313,145,'2024-06-14 14:00:00','Planifié',NULL,NULL),(130,314,312,140,'2024-06-14 16:00:00','Planifié',NULL,NULL);
/*!40000 ALTER TABLE `interview` ENABLE KEYS */;

--
-- Table structure for table `manager`
--

DROP TABLE IF EXISTS `manager`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `manager` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fullname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `matricule` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `manager`
--

/*!40000 ALTER TABLE `manager` DISABLE KEYS */;
INSERT INTO `manager` VALUES (25,'Sabrina MONTASSAR','sabrina.montassar@yahoo.fr',NULL,NULL,NULL),(26,'Sabrina MONTASSAR','sabrina.montassar@yahoo.fr',NULL,NULL,NULL),(27,'Sabrina MONTASSAR','sabrina.montassar@yahoo.fr',NULL,NULL,NULL),(28,'Sabrina MONTASSAR','sabrina.montassar@yahoo.fr',NULL,NULL,NULL),(29,'Sabrina MONTASSAR','sabrina.montassar@yahoo.fr',NULL,NULL,NULL),(30,'Sabrina MONTASSAR','sabrina.montassar@yahoo.fr',NULL,NULL,NULL),(31,'Sabrina MONTASSAR','sabrina.montassar@yahoo.fr',NULL,NULL,NULL),(32,'Sabrina MONTASSAR','sabrina.montassar@yahoo.fr',NULL,NULL,NULL),(33,'Sabrina MONTASSAR','sabrina.montassar@yahoo.fr',NULL,NULL,NULL),(34,'Sabrina MONTASSAR','sabrina.montassar@yahoo.fr',NULL,NULL,NULL),(35,'Sabrina SAYARI ','sabrina_sayari_montassar@yahoo.fr','310258','Informatique',NULL),(36,'sabrine.montassar','sabrina.montassar.04@gmail.com',NULL,NULL,NULL);
/*!40000 ALTER TABLE `manager` ENABLE KEYS */;

--
-- Table structure for table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `messenger_messages` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `body` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messenger_messages`
--

/*!40000 ALTER TABLE `messenger_messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `messenger_messages` ENABLE KEYS */;

--
-- Table structure for table `password_reset_request`
--

DROP TABLE IF EXISTS `password_reset_request`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_request` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `token` varchar(180) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expires_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_C5D0A95A5F37A13B` (`token`),
  KEY `IDX_C5D0A95AA76ED395` (`user_id`),
  CONSTRAINT `FK_C5D0A95AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_request`
--

/*!40000 ALTER TABLE `password_reset_request` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_request` ENABLE KEYS */;

--
-- Table structure for table `personal`
--

DROP TABLE IF EXISTS `personal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `entry_date` datetime DEFAULT NULL,
  `exit_date` datetime DEFAULT NULL,
  `matricule` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `roles` json NOT NULL,
  `manager_id` int DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_connexion` datetime DEFAULT NULL,
  `type_contract` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `spc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_F18A6D84783E3463` (`manager_id`),
  CONSTRAINT `FK_F18A6D84783E3463` FOREIGN KEY (`manager_id`) REFERENCES `manager` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=321 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal`
--

/*!40000 ALTER TABLE `personal` DISABLE KEYS */;
INSERT INTO `personal` VALUES (311,'Djamil Sané','d.sane@opera.fr','$2y$13$aQ1QMjg7vqljXAsPU8P2cekS9nPiUqAfP9o9B7DX.e74hr1iqvzrS',NULL,NULL,'2023-06-01 00:00:00','2023-12-31 00:00:00','3102561','Equipe développement1','[\"ROLE_USER\"]',25,NULL,NULL,'','',''),(312,'Kémarha Chit','k.chit@opera.fr','$2y$13$aQ1QMjg7vqljXAsPU8P2cekS9nPiUqAfP9o9B7DX.e74hr1iqvzrS',NULL,NULL,'2023-06-01 00:00:00','2023-12-31 00:00:00','3102562','Equipe développement2','[\"ROLE_USER\"]',26,NULL,NULL,'','',''),(313,'Fabien Charrin','f.charrin@opera.fr','$2y$13$aQ1QMjg7vqljXAsPU8P2cekS9nPiUqAfP9o9B7DX.e74hr1iqvzrS',NULL,NULL,'2023-06-01 00:00:00','2023-12-31 00:00:00','3102563','Equipe développement3','[\"ROLE_USER\"]',27,NULL,NULL,'','',''),(314,'Sabrina Montassar','sabrina.montassar@yahoo.fr','$2y$13$aQ1QMjg7vqljXAsPU8P2cekS9nPiUqAfP9o9B7DX.e74hr1iqvzrS',NULL,NULL,'2023-06-01 00:00:00','2023-12-31 00:00:00','3102564','Equipe développement4','[\"ROLE_MANAGER\"]',28,NULL,NULL,'','',''),(315,'Yacine  Yacoubi','y.yacoubi@opera.fr','$2y$13$aQ1QMjg7vqljXAsPU8P2cekS9nPiUqAfP9o9B7DX.e74hr1iqvzrS',NULL,NULL,'2023-06-01 00:00:00','2023-12-31 00:00:00','3102565','Equipe développement5','[\"ROLE_USER\"]',29,NULL,NULL,'','',''),(316,'Eroudini Abdullatif','e.abdullatif@opera.fr','$2y$13$aQ1QMjg7vqljXAsPU8P2cekS9nPiUqAfP9o9B7DX.e74hr1iqvzrS',NULL,NULL,'2023-06-01 00:00:00','2023-12-31 00:00:00','3102566','Equipe développement6','[\"ROLE_USER\"]',30,NULL,NULL,'','',''),(317,'Madjdi Said','m.said@opera.fr','$2y$13$aQ1QMjg7vqljXAsPU8P2cekS9nPiUqAfP9o9B7DX.e74hr1iqvzrS',NULL,NULL,'2023-06-01 00:00:00','2023-12-31 00:00:00','3102567','Equipe développement7','[\"ROLE_USER\"]',31,NULL,NULL,'','',''),(318,'Lucas Berthet','l.berthet@opera.fr','$2y$13$aQ1QMjg7vqljXAsPU8P2cekS9nPiUqAfP9o9B7DX.e74hr1iqvzrS',NULL,NULL,'2023-06-01 00:00:00','2023-12-31 00:00:00','3102568','Equipe développement8','[\"ROLE_USER\"]',32,NULL,NULL,'','',''),(319,'Tim Decool','t.decool@opera.fr','$2y$13$aQ1QMjg7vqljXAsPU8P2cekS9nPiUqAfP9o9B7DX.e74hr1iqvzrS',NULL,NULL,'2023-06-01 00:00:00','2023-12-31 00:00:00','3102569','Equipe développement9','[\"ROLE_USER\"]',33,NULL,NULL,'','',''),(320,'Diégo Mazenc','d.mazenc@opera.fr','$2y$13$aQ1QMjg7vqljXAsPU8P2cekS9nPiUqAfP9o9B7DX.e74hr1iqvzrS',NULL,NULL,'2023-06-01 00:00:00','2023-12-31 00:00:00','31025610','Equipe développement10','[\"ROLE_ADMIN\"]',34,NULL,NULL,'','','');
/*!40000 ALTER TABLE `personal` ENABLE KEYS */;

--
-- Table structure for table `personal_team`
--

DROP TABLE IF EXISTS `personal_team`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_team` (
  `personal_id` int NOT NULL,
  `team_id` int NOT NULL,
  PRIMARY KEY (`personal_id`,`team_id`),
  KEY `IDX_F5EAA1225D430949` (`personal_id`),
  KEY `IDX_F5EAA122296CD8AE` (`team_id`),
  CONSTRAINT `FK_F5EAA122296CD8AE` FOREIGN KEY (`team_id`) REFERENCES `team` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_F5EAA1225D430949` FOREIGN KEY (`personal_id`) REFERENCES `personal` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_team`
--

/*!40000 ALTER TABLE `personal_team` DISABLE KEYS */;
INSERT INTO `personal_team` VALUES (312,16),(313,19),(314,16),(314,17),(314,20),(315,18),(316,16),(316,17),(316,18),(317,17),(317,18),(317,20),(319,19),(320,20);
/*!40000 ALTER TABLE `personal_team` ENABLE KEYS */;

--
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `post` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5A8A6C8DA76ED395` (`user_id`),
  CONSTRAINT `FK_5A8A6C8DA76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post`
--

/*!40000 ALTER TABLE `post` DISABLE KEYS */;
/*!40000 ALTER TABLE `post` ENABLE KEYS */;

--
-- Table structure for table `profile`
--

DROP TABLE IF EXISTS `profile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `profile` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `firstname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthdate` datetime NOT NULL,
  `profile_picture` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `personal_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8157AA0F5D430949` (`personal_id`),
  CONSTRAINT `FK_8157AA0F5D430949` FOREIGN KEY (`personal_id`) REFERENCES `personal` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profile`
--

/*!40000 ALTER TABLE `profile` DISABLE KEYS */;
INSERT INTO `profile` VALUES (74,NULL,'Sabrina','Montassar','Responsable de service','1979-04-24 00:00:00',NULL,NULL),(75,NULL,'Sabrina','Montassar','Responsable de service','1979-04-24 00:00:00',NULL,NULL),(76,NULL,'Sabrina','Montassar','Responsable de service','1979-04-24 00:00:00',NULL,NULL),(77,NULL,'Sabrina','Montassar','Responsable de service','1979-04-24 00:00:00',NULL,NULL),(78,NULL,'Sabrina','Montassar','Responsable de service','1979-04-24 00:00:00',NULL,NULL),(79,NULL,'Sabrina','Montassar','Responsable de service','1979-04-24 00:00:00',NULL,NULL),(80,NULL,'Sabrina','Montassar','Responsable de service','1979-04-24 00:00:00',NULL,NULL),(81,NULL,'Sabrina','Montassar','Responsable de service','1979-04-24 00:00:00',NULL,NULL),(82,NULL,'Sabrina','Montassar','Responsable de service','1979-04-24 00:00:00',NULL,NULL),(83,NULL,'Sabrina','Montassar','Responsable de service','1979-04-24 00:00:00',NULL,NULL);
/*!40000 ALTER TABLE `profile` ENABLE KEYS */;

--
-- Table structure for table `resource`
--

DROP TABLE IF EXISTS `resource`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `resource` (
  `id` int NOT NULL AUTO_INCREMENT,
  `personal_id` int DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_BC91F4165D430949` (`personal_id`),
  KEY `IDX_BC91F41612469DE2` (`category_id`),
  CONSTRAINT `FK_BC91F41612469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  CONSTRAINT `FK_BC91F4165D430949` FOREIGN KEY (`personal_id`) REFERENCES `personal` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resource`
--

/*!40000 ALTER TABLE `resource` DISABLE KEYS */;
INSERT INTO `resource` VALUES (61,NULL,159,'Ressource 1','Description de la ressource 1','/path/to/resource_1.pdf','2024-01-01 00:00:00','2024-02-01 00:00:00'),(62,NULL,156,'Ressource 2','Description de la ressource 2','/path/to/resource_2.pdf','2024-01-02 00:00:00','2024-02-02 00:00:00'),(63,NULL,160,'Ressource 3','Description de la ressource 3','/path/to/resource_3.pdf','2024-01-03 00:00:00','2024-02-03 00:00:00'),(64,NULL,158,'Ressource 4','Description de la ressource 4','/path/to/resource_4.pdf','2024-01-04 00:00:00','2024-02-04 00:00:00'),(65,NULL,157,'Ressource 5','Description de la ressource 5','/path/to/resource_5.pdf','2024-01-05 00:00:00','2024-02-05 00:00:00'),(66,NULL,160,'Ressource 6','Description de la ressource 6','/path/to/resource_6.pdf','2024-01-06 00:00:00','2024-02-06 00:00:00'),(67,NULL,159,'Ressource 7','Description de la ressource 7','/path/to/resource_7.pdf','2024-01-07 00:00:00','2024-02-07 00:00:00'),(68,NULL,160,'Ressource 8','Description de la ressource 8','/path/to/resource_8.pdf','2024-01-08 00:00:00','2024-02-08 00:00:00'),(69,NULL,157,'Ressource 9','Description de la ressource 9','/path/to/resource_9.pdf','2024-01-09 00:00:00','2024-02-09 00:00:00'),(71,314,156,'Management','Formation gestion des conflits','https://youtu.be/pDpufnm3NGw?si=ERQxtLlX8IE6-Wto','2024-05-08 21:35:00','2024-05-08 21:35:00'),(72,314,156,'Management','Formation gestion des conflits','https://youtu.be/pDpufnm3NGw?si=ERQxtLlX8IE6-Wto','2024-05-08 21:35:00','2024-05-08 21:35:00');
/*!40000 ALTER TABLE `resource` ENABLE KEYS */;

--
-- Table structure for table `resource_link`
--

DROP TABLE IF EXISTS `resource_link`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `resource_link` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resource_link`
--

/*!40000 ALTER TABLE `resource_link` DISABLE KEYS */;
/*!40000 ALTER TABLE `resource_link` ENABLE KEYS */;

--
-- Table structure for table `system_log`
--

DROP TABLE IF EXISTS `system_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `system_log` (
  `id` int NOT NULL AUTO_INCREMENT,
  `message` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `level` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `system_log`
--

/*!40000 ALTER TABLE `system_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `system_log` ENABLE KEYS */;

--
-- Table structure for table `task`
--

DROP TABLE IF EXISTS `task`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `task` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_527EDB25A76ED395` (`user_id`),
  CONSTRAINT `FK_527EDB25A76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `task`
--

/*!40000 ALTER TABLE `task` DISABLE KEYS */;
/*!40000 ALTER TABLE `task` ENABLE KEYS */;

--
-- Table structure for table `team`
--

DROP TABLE IF EXISTS `team`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `team` (
  `id` int NOT NULL AUTO_INCREMENT,
  `team_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `manager_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_C4E0A61F783E3463` (`manager_id`),
  CONSTRAINT `FK_C4E0A61F783E3463` FOREIGN KEY (`manager_id`) REFERENCES `manager` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `team`
--

/*!40000 ALTER TABLE `team` DISABLE KEYS */;
INSERT INTO `team` VALUES (16,'Team 1','Description ode l\'équipe 1','2024-01-01 00:00:00',35),(17,'Team 2','Description ode l\'équipe 2','2024-01-01 00:00:00',35),(18,'Team 3','Description ode l\'équipe 3','2024-01-01 00:00:00',35),(19,'Team 4','Description ode l\'équipe 4','2024-01-01 00:00:00',36),(20,'Team 5','Description ode l\'équipe 5','2024-01-01 00:00:00',35),(26,'Dev 06_2023','Stagiaires session juin 2023','2024-05-09 00:19:00',25);
/*!40000 ALTER TABLE `team` ENABLE KEYS */;

--
-- Table structure for table `team_member`
--

DROP TABLE IF EXISTS `team_member`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `team_member` (
  `id` int NOT NULL AUTO_INCREMENT,
  `team_id` int NOT NULL,
  `role_in_team` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `joined_at` datetime DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_6FFBDA1296CD8AE` (`team_id`),
  CONSTRAINT `FK_6FFBDA1296CD8AE` FOREIGN KEY (`team_id`) REFERENCES `team` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `team_member`
--

/*!40000 ALTER TABLE `team_member` DISABLE KEYS */;
INSERT INTO `team_member` VALUES (11,16,'Collaborateur','2024-04-29 12:35:34','Actif','Membre 1','Description du membre 1'),(12,19,'Collaborateur','2024-04-29 12:35:34','Actif','Membre 2','Description du membre 2'),(13,16,'Collaborateur','2024-04-29 12:35:34','Actif','Membre 3','Description du membre 3'),(14,16,'Collaborateur','2024-04-29 12:35:34','Actif','Membre 4','Description du membre 4'),(15,18,'Collaborateur','2024-04-29 12:35:34','Actif','Membre 5','Description du membre 5'),(16,16,'Collaborateur','2024-04-29 12:35:34','Actif','Membre 6','Description du membre 6'),(17,19,'Collaborateur','2024-04-29 12:35:34','Actif','Membre 7','Description du membre 7'),(18,20,'Collaborateur','2024-04-29 12:35:34','Actif','Membre 8','Description du membre 8'),(19,16,'Collaborateur','2024-04-29 12:35:34','Actif','Membre 9','Description du membre 9'),(20,17,'Collaborateur','2024-04-29 12:35:34','Actif','Membre 10','Description du membre 10');
/*!40000 ALTER TABLE `team_member` ENABLE KEYS */;

--
-- Table structure for table `team_member_personal`
--

DROP TABLE IF EXISTS `team_member_personal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `team_member_personal` (
  `team_member_id` int NOT NULL,
  `personal_id` int NOT NULL,
  PRIMARY KEY (`team_member_id`,`personal_id`),
  KEY `IDX_2509D410C292CD19` (`team_member_id`),
  KEY `IDX_2509D4105D430949` (`personal_id`),
  CONSTRAINT `FK_2509D4105D430949` FOREIGN KEY (`personal_id`) REFERENCES `personal` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_2509D410C292CD19` FOREIGN KEY (`team_member_id`) REFERENCES `team_member` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `team_member_personal`
--

/*!40000 ALTER TABLE `team_member_personal` DISABLE KEYS */;
INSERT INTO `team_member_personal` VALUES (11,319),(11,320),(12,312),(12,317),(12,320),(13,314),(13,317),(13,319),(14,314),(14,317),(14,318),(15,317),(15,318),(15,319),(16,311),(16,318),(16,319),(17,319),(17,320),(18,314),(18,315),(18,320),(19,312),(19,313),(19,315),(20,311),(20,316);
/*!40000 ALTER TABLE `team_member_personal` ENABLE KEYS */;

--
-- Table structure for table `type_interview`
--

DROP TABLE IF EXISTS `type_interview`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `type_interview` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `background_color` varchar(7) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duration` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=146 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `type_interview`
--

/*!40000 ALTER TABLE `type_interview` DISABLE KEYS */;
INSERT INTO `type_interview` VALUES (135,'Entretien annuel','Echange sur le sperformances annuels et les objectifs fixés lors de l\'entretien annuel de N-1','#ffa500',90),(136,'Entretien de performance','Vérification des résultats du collaborateur','#4682b4',20),(137,'Entretien de recrutement','Entretien d\'embauche','#d3f7bf',45),(138,'Entretien de recadrage','Entretien de recadrage','#9370db',60),(139,'One to One','Briefing régulier avec le collaborateur pour suivi des objectifs et plan d\'actions','#b3ffb3',30),(140,'Entretien professionnel','Entretien obligatoire tous les 2 ans. Permet de faire le point sur les formations et les','#ff5733',45),(141,'Entretien fin de contrat','Entretien obligatoire tous les 2 ans. Permet de faire le point sur les formations et les','#d2691e',60),(142,'Entretien d\'entrée','Premier entretien avec le collaborateur lors de son entrée dans l\'équipe','#87ceeb',60),(144,'Entretien fin période d\'essai','Entretien à la fin de la période d\'essai du collaborateur','#32cd32',30),(145,'Entretien trimestriel','Entretien tous les 3 mois pour suivi de performance','#ffd700',60);
/*!40000 ALTER TABLE `type_interview` ENABLE KEYS */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(180) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_1483A5E9E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (21,'user1@example.com','[\"ROLE_USER\"]','$2y$10$VlqLVdI/Zy3iJHLgZmb1H.kOismCUaFOfGZ3JiFlWqj5qc1QuQzHS','User 1'),(22,'user2@example.com','[\"ROLE_USER\"]','$2y$10$G/j97JmDWkvfbwFUqaZVWe.4A4n2DvUGeMeWTb0ZYxltfMaKAVPLq','User 2'),(23,'user3@example.com','[\"ROLE_USER\"]','$2y$10$Tt3wirycVg4xmx3u/SaoDukY/jU8MDUOLA5Zf.DRv1FPML3Jnhq3C','User 3'),(24,'user4@example.com','[\"ROLE_USER\"]','$2y$10$PRZBVkPAEJDoVDtvgT9cauW48j55rjCiBvz7rNeYA9XRxWUrA5bOW','User 4'),(25,'user5@example.com','[\"ROLE_USER\"]','$2y$10$M2LUIFEzA1RIGUycFPmNWe0qvvnClSgA1DUEP6vV/jsqI9TGHm.si','User 5'),(26,'user6@example.com','[\"ROLE_USER\"]','$2y$10$bp0ltbhS2qNe1gY0OCeHP.ProOhhXQKs71sRxSXNsc3ocwznsxRFK','User 6'),(27,'user7@example.com','[\"ROLE_USER\"]','$2y$10$z8xS9rHw5cUcBOVYbAbJAuMKzXQ0DtisyyqjBrG8v0FkU2bsoWrYi','User 7'),(28,'user8@example.com','[\"ROLE_USER\"]','$2y$10$Ytxt2Ye0SpqgKCddffFPQ.oFTCYVqJEaea8M9zhgP8jYVTjS9hugK','User 8'),(29,'user9@example.com','[\"ROLE_USER\"]','$2y$10$JROxELKFz5ZQcNTDfMAzH.bkNFZ1hpVDMHLYn5RTGnyNNQZk0E8kO','User 9'),(30,'user10@example.com','[\"ROLE_USER\"]','$2y$10$8rvZIP3uPoRzYsg1ogtOPO1yuW3ZSpEBXY/ySr7gEO4i2oTYfggSC','User 10');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

--
-- Table structure for table `workload`
--

DROP TABLE IF EXISTS `workload`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `workload` (
  `id` int NOT NULL AUTO_INCREMENT,
  `personal_id` int DEFAULT NULL,
  `workload_level` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `comment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hours` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_1203AA7B5D430949` (`personal_id`),
  CONSTRAINT `FK_1203AA7B5D430949` FOREIGN KEY (`personal_id`) REFERENCES `personal` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `workload`
--

/*!40000 ALTER TABLE `workload` DISABLE KEYS */;
INSERT INTO `workload` VALUES (11,314,'Level 1','2024-04-29 12:35:35','Comment for workload 1','Description for workload 1','2 hours'),(12,312,'Level 2','2024-04-29 12:35:35','Comment for workload 2','Description for workload 2','2 hours'),(13,311,'Level 3','2024-04-29 12:35:35','Comment for workload 3','Description for workload 3','2 hours'),(14,320,'Level 4','2024-04-29 12:35:35','Comment for workload 4','Description for workload 4','2 hours'),(15,318,'Level 5','2024-04-29 12:35:35','Comment for workload 5','Description for workload 5','2 hours'),(16,312,'Level 6','2024-04-29 12:35:35','Comment for workload 6','Description for workload 6','2 hours'),(17,314,'Level 7','2024-04-29 12:35:35','Comment for workload 7','Description for workload 7','2 hours'),(18,318,'Level 8','2024-04-29 12:35:35','Comment for workload 8','Description for workload 8','2 hours'),(19,317,'Level 9','2024-04-29 12:35:35','Comment for workload 9','Description for workload 9','2 hours'),(20,319,'Level 10','2024-04-29 12:35:35','Comment for workload 10','Description for workload 10','2 hours');
/*!40000 ALTER TABLE `workload` ENABLE KEYS */;

--
-- Dumping routines for database 'opera_project'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-07-29 12:57:22
