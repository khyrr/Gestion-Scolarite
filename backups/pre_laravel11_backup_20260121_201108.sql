-- MySQL dump 10.13  Distrib 8.0.44, for Linux (x86_64)
--
-- Host: localhost    Database: gestionscolarité
-- ------------------------------------------------------
-- Server version	8.0.44-0ubuntu0.24.04.2

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
-- Table structure for table `activity_logs`
--

DROP TABLE IF EXISTS `activity_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `activity_logs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `action` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `resource` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resource_id` bigint unsigned DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `changes` json DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=167 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activity_logs`
--

LOCK TABLES `activity_logs` WRITE;
/*!40000 ALTER TABLE `activity_logs` DISABLE KEYS */;
INSERT INTO `activity_logs` VALUES (1,'admin',1,'logout','administrateur',1,'Admin logout',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-25 02:54:36','2025-11-25 02:54:36'),(2,'admin',NULL,'failed_login',NULL,NULL,'Failed login attempt for admin@ecole.com',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-25 02:55:34','2025-11-25 02:55:34'),(3,'admin',NULL,'failed_login',NULL,NULL,'Failed login attempt for admin@ecole.com',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-25 02:56:07','2025-11-25 02:56:07'),(4,'admin',1,'login','administrateur',1,'Admin login',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-25 02:56:19','2025-11-25 02:56:19'),(5,'admin',1,'logout','administrateur',1,'Admin logout',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-25 03:29:40','2025-11-25 03:29:40'),(6,'admin',2,'login','administrateur',2,'Admin login',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-25 03:30:33','2025-11-25 03:30:33'),(7,'admin',2,'logout','administrateur',2,'Admin logout',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-25 04:22:21','2025-11-25 04:22:21'),(8,'admin',1,'login','administrateur',1,'Admin login',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-25 04:22:42','2025-11-25 04:22:42'),(9,'admin',1,'logout','administrateur',1,'Admin logout',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-25 04:38:01','2025-11-25 04:38:01'),(10,'admin',1,'login','administrateur',1,'Admin login',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-25 04:38:18','2025-11-25 04:38:18'),(11,'admin',1,'logout','administrateur',1,'Admin logout',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-25 05:07:58','2025-11-25 05:07:58'),(12,'admin',2,'login','administrateur',2,'Admin login',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-25 05:08:12','2025-11-25 05:08:12'),(13,'admin',2,'logout','administrateur',2,'Admin logout',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-25 05:29:14','2025-11-25 05:29:14'),(14,'admin',1,'login','administrateur',1,'Admin login',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-25 05:29:29','2025-11-25 05:29:29'),(15,'admin',1,'2fa_challenge_passed','administrateur',1,'Passed 2FA challenge',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-25 05:30:36','2025-11-25 05:30:36'),(16,'admin',1,'logout','administrateur',1,'Admin logout',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-25 05:32:13','2025-11-25 05:32:13'),(17,'admin',2,'login','administrateur',2,'Admin login',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-25 05:32:35','2025-11-25 05:32:35'),(18,'admin',2,'2fa_enable','administrateur',2,'Enabled two-factor authentication',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-25 05:35:10','2025-11-25 05:35:10'),(19,'admin',2,'2fa_regenerate','administrateur',2,'Regenerated 2FA secret','{\"old\": {\"secret\": \"MHXJIUUDFUPJO2YO\", \"recovery_codes\": \"[\\\"5718031ae1b9\\\",\\\"c89e53563cfe\\\",\\\"adcb5722b8c4\\\",\\\"71767b989382\\\",\\\"385a66534979\\\",\\\"b0423597c99b\\\",\\\"ef4e7557ee0a\\\",\\\"2b33e24971cf\\\"]\"}, \"used_recovery\": false}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-25 05:36:42','2025-11-25 05:36:42'),(20,'admin',2,'2fa_enable','administrateur',2,'Enabled two-factor authentication',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-25 05:37:43','2025-11-25 05:37:43'),(21,'admin',2,'logout','administrateur',2,'Admin logout',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-25 05:37:53','2025-11-25 05:37:53'),(22,'admin',2,'login','administrateur',2,'Admin login',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-25 05:38:05','2025-11-25 05:38:05'),(23,'admin',2,'logout','administrateur',2,'Admin logout',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-25 05:41:49','2025-11-25 05:41:49'),(24,'admin',2,'login','administrateur',2,'Admin login',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-25 05:42:01','2025-11-25 05:42:01'),(25,'admin',2,'logout','administrateur',2,'Admin logout',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-25 05:47:19','2025-11-25 05:47:19'),(26,'admin',2,'login','administrateur',2,'Admin login',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-25 05:47:31','2025-11-25 05:47:31'),(27,'admin',2,'logout','administrateur',2,'Admin logout',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-25 05:50:53','2025-11-25 05:50:53'),(28,'admin',2,'login','administrateur',2,'Admin login',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-25 05:51:02','2025-11-25 05:51:02'),(29,'admin',2,'2fa_challenge_passed','administrateur',2,'Passed 2FA challenge',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-25 05:51:48','2025-11-25 05:51:48'),(30,'admin',2,'logout','administrateur',2,'Admin logout',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-25 05:55:33','2025-11-25 05:55:33'),(31,'admin',2,'login','administrateur',2,'Admin login',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-25 05:55:49','2025-11-25 05:55:49'),(32,'admin',2,'2fa_challenge_passed','administrateur',2,'Passed 2FA challenge',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-25 07:43:14','2025-11-25 07:43:14'),(33,'admin',2,'login','administrateur',2,'Admin login',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-25 08:04:31','2025-11-25 08:04:31'),(34,'admin',2,'2fa_challenge_passed','administrateur',2,'Passed 2FA challenge',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-25 08:19:07','2025-11-25 08:19:07'),(35,'admin',2,'2fa_regenerate','administrateur',2,'Regenerated 2FA secret','{\"old\": {\"secret\": \"FZ7SNT5OVKPLSLAY3BZCBNED\", \"recovery_codes\": \"[\\\"bed7ff75b387\\\",\\\"2d3392524a43\\\",\\\"6fd258cf676c\\\",\\\"2a102653cb88\\\",\\\"0ad1e66c9a60\\\",\\\"19ca037a492a\\\",\\\"8e2dbd4dfaea\\\",\\\"4286c0ebc45d\\\"]\"}, \"used_recovery\": false}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-25 08:24:23','2025-11-25 08:24:23'),(36,'admin',2,'logout','administrateur',2,'Admin logout',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-25 08:25:23','2025-11-25 08:25:23'),(37,'admin',2,'login','administrateur',2,'Admin login',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-25 08:25:33','2025-11-25 08:25:33'),(38,'admin',2,'2fa_enable','administrateur',2,'Enabled two-factor authentication',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-25 08:26:22','2025-11-25 08:26:22'),(39,'admin',2,'logout','administrateur',2,'Admin logout',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-25 08:26:41','2025-11-25 08:26:41'),(40,'admin',2,'login','administrateur',2,'Admin login',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-25 08:26:50','2025-11-25 08:26:50'),(41,'admin',2,'2fa_challenge_passed','administrateur',2,'Passed 2FA challenge',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-25 08:27:13','2025-11-25 08:27:13'),(42,'admin',2,'logout','administrateur',2,'Admin logout',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-25 08:48:37','2025-11-25 08:48:37'),(43,'admin',2,'login','administrateur',2,'Admin login',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-25 08:48:54','2025-11-25 08:48:54'),(44,'admin',2,'2fa_challenge_passed','administrateur',2,'Passed 2FA challenge',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-25 08:49:36','2025-11-25 08:49:36'),(45,'admin',2,'logout','administrateur',2,'Admin logout',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-25 09:02:11','2025-11-25 09:02:11'),(46,'admin',2,'login','administrateur',2,'Admin login',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-25 09:02:19','2025-11-25 09:02:19'),(47,'admin',2,'2fa_challenge_passed','administrateur',2,'Passed 2FA challenge',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-25 09:12:52','2025-11-25 09:12:52'),(48,'admin',2,'logout','administrateur',2,'Admin logout',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-25 09:12:56','2025-11-25 09:12:56'),(49,'admin',2,'login','administrateur',2,'Admin login',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-25 09:13:13','2025-11-25 09:13:13'),(50,'admin',2,'2fa_recovery_used','administrateur',2,'Used a 2FA recovery code','{\"consumed_code\": \"ead2d178d25f\"}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-25 09:17:51','2025-11-25 09:17:51'),(51,'admin',2,'2fa_regenerate_initiated','administrateur',2,'Initiated 2FA regeneration (pending verification)','{\"used_recovery\": false}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-25 09:25:40','2025-11-25 09:25:40'),(52,'admin',2,'2fa_regenerate_initiated','administrateur',2,'Initiated 2FA regeneration (pending verification)','{\"used_recovery\": false}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-25 09:25:50','2025-11-25 09:25:50'),(53,'admin',2,'2fa_regenerate_initiated','administrateur',2,'Initiated 2FA regeneration (pending verification)','{\"used_recovery\": false}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-25 09:26:37','2025-11-25 09:26:37'),(54,'admin',2,'2fa_regenerate_initiated','administrateur',2,'Initiated 2FA regeneration (pending verification)','{\"used_recovery\": false}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-25 09:35:22','2025-11-25 09:35:22'),(55,'admin',2,'2fa_regenerate_completed','administrateur',2,'Completed 2FA regeneration with new secret',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-25 09:46:51','2025-11-25 09:46:51'),(56,'admin',2,'logout','administrateur',2,'Admin logout',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-25 09:48:16','2025-11-25 09:48:16'),(57,'admin',1,'login','administrateur',1,'Admin login',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-25 09:48:33','2025-11-25 09:48:33'),(58,'admin',1,'2fa_challenge_passed','administrateur',1,'Passed 2FA challenge',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-25 09:48:47','2025-11-25 09:48:47'),(59,'admin',1,'update','admin_allowed_ip',3,'Toggled IP 196.178.85.211 active state from active to inactive','{\"is_active\": {\"new\": false, \"old\": true}}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-25 10:50:06','2025-11-25 10:50:06'),(60,'admin',1,'logout','administrateur',1,'Admin logout',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-25 11:55:55','2025-11-25 11:55:55'),(61,'admin',2,'login','administrateur',2,'Admin login',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-25 11:56:30','2025-11-25 11:56:30'),(62,'admin',2,'2fa_enable','administrateur',2,'Enabled two-factor authentication',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-25 12:09:19','2025-11-25 12:09:19'),(63,'admin',2,'login','administrateur',2,'Admin login',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-25 12:11:03','2025-11-25 12:11:03'),(64,'admin',2,'2fa_challenge_passed','administrateur',2,'Passed 2FA challenge',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-25 12:11:38','2025-11-25 12:11:38'),(65,'admin',2,'2fa_enable','administrateur',2,'Enabled two-factor authentication',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-25 12:27:38','2025-11-25 12:27:38'),(66,'admin',2,'2fa_regenerate_initiated','administrateur',2,'Initiated 2FA regeneration (pending verification)','{\"used_recovery\": false}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-25 12:27:47','2025-11-25 12:27:47'),(67,'admin',2,'logout','administrateur',2,'Admin logout',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-25 12:28:49','2025-11-25 12:28:49'),(68,'admin',2,'login','administrateur',2,'Admin login',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-25 12:28:51','2025-11-25 12:28:51'),(69,'admin',2,'2fa_challenge_passed','administrateur',2,'Passed 2FA challenge',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-25 12:28:51','2025-11-25 12:28:51'),(70,'admin',2,'login','administrateur',2,'Admin login',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-25 12:32:41','2025-11-25 12:32:41'),(71,'admin',2,'2fa_challenge_passed','administrateur',2,'Passed 2FA challenge',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-25 12:32:42','2025-11-25 12:32:42'),(72,'admin',2,'2fa_regenerate_initiated','administrateur',2,'Initiated 2FA regeneration (pending verification)','{\"used_recovery\": false}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-25 12:45:40','2025-11-25 12:45:40'),(73,'admin',2,'2fa_regenerate_initiated','administrateur',2,'Initiated 2FA regeneration (pending verification)','{\"used_recovery\": false}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-25 12:57:02','2025-11-25 12:57:02'),(74,'admin',2,'2fa_regenerate_initiated','administrateur',2,'Initiated 2FA regeneration (pending verification)','{\"used_recovery\": false}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-25 12:57:11','2025-11-25 12:57:11'),(75,'admin',2,'2fa_regenerate_initiated','administrateur',2,'Initiated 2FA regeneration (pending verification)','{\"used_recovery\": false}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-25 13:18:07','2025-11-25 13:18:07'),(76,'admin',2,'2fa_regenerate_initiated','administrateur',2,'Initiated 2FA regeneration (pending verification)','{\"used_recovery\": false}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-25 13:28:14','2025-11-25 13:28:14'),(77,'admin',2,'2fa_regenerate_initiated','administrateur',2,'Initiated 2FA regeneration (pending verification)','{\"used_recovery\": false}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-25 13:28:22','2025-11-25 13:28:22'),(78,'admin',2,'login','administrateur',2,'Admin login',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-26 12:11:55','2025-11-26 12:11:55'),(79,'admin',2,'2fa_challenge_passed','administrateur',2,'Passed 2FA challenge',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-26 12:11:55','2025-11-26 12:11:55'),(80,'admin',2,'2fa_regenerate_initiated','administrateur',2,'Initiated 2FA regeneration (pending verification)','{\"used_recovery\": false}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-26 12:12:01','2025-11-26 12:12:01'),(81,'admin',2,'2fa_regenerate_initiated','administrateur',2,'Initiated 2FA regeneration (pending verification)','{\"used_recovery\": false}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-26 12:24:24','2025-11-26 12:24:24'),(82,'admin',2,'2fa_regenerate_initiated','administrateur',2,'Initiated 2FA regeneration (pending verification)','{\"used_recovery\": false}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-26 12:37:34','2025-11-26 12:37:34'),(83,'admin',2,'2fa_regenerate_initiated','administrateur',2,'Initiated 2FA regeneration (pending verification)','{\"used_recovery\": false}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-26 12:37:34','2025-11-26 12:37:34'),(84,'admin',2,'2fa_regenerate_initiated','administrateur',2,'Initiated 2FA regeneration (pending verification)','{\"used_recovery\": false}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-26 12:38:25','2025-11-26 12:38:25'),(85,'admin',2,'login','administrateur',2,'Admin login',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-27 10:31:17','2025-11-27 10:31:17'),(86,'admin',2,'2fa_challenge_passed','administrateur',2,'Passed 2FA challenge',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-27 10:31:18','2025-11-27 10:31:18'),(87,'admin',2,'2fa_regenerate_initiated','administrateur',2,'Initiated 2FA regeneration (pending verification)','{\"used_recovery\": false}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-27 10:40:40','2025-11-27 10:40:40'),(88,'admin',2,'2fa_regenerate_completed','administrateur',2,'Completed 2FA regeneration with new secret','{\"used_pending_flow\": true}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-27 10:41:11','2025-11-27 10:41:11'),(89,'admin',2,'2fa_regenerate_initiated','administrateur',2,'Initiated 2FA regeneration (pending verification)','{\"used_recovery\": false}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-27 10:45:45','2025-11-27 10:45:45'),(90,'admin',2,'2fa_regenerate_initiated','administrateur',2,'Initiated 2FA regeneration (pending verification)','{\"used_recovery\": false}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-27 11:00:09','2025-11-27 11:00:09'),(91,'admin',2,'2fa_regenerate_completed','administrateur',2,'Completed 2FA regeneration with new secret','{\"used_pending_flow\": true}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-27 11:04:35','2025-11-27 11:04:35'),(92,'admin',2,'2fa_regenerate_initiated','administrateur',2,'Initiated 2FA regeneration (pending verification)','{\"used_recovery\": false}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-27 11:16:53','2025-11-27 11:16:53'),(93,'admin',2,'2fa_regenerate_initiated','administrateur',2,'Initiated 2FA regeneration (pending verification)','{\"used_recovery\": false}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-27 11:30:54','2025-11-27 11:30:54'),(94,'admin',2,'2fa_regenerate_initiated','administrateur',2,'Initiated 2FA regeneration (pending verification)','{\"used_recovery\": false}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-27 11:58:33','2025-11-27 11:58:33'),(95,'admin',2,'2fa_regenerate_initiated','administrateur',2,'Initiated 2FA regeneration (pending verification)','{\"used_recovery\": false}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-27 12:10:25','2025-11-27 12:10:25'),(96,'admin',2,'2fa_regenerate_initiated','administrateur',2,'Initiated 2FA regeneration (pending verification)','{\"used_recovery\": false}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-27 12:19:25','2025-11-27 12:19:25'),(97,'admin',2,'2fa_regenerate_initiated','administrateur',2,'Initiated 2FA regeneration (pending verification)','{\"used_recovery\": false}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-27 12:20:43','2025-11-27 12:20:43'),(98,'admin',2,'2fa_regenerate_initiated','administrateur',2,'Initiated 2FA regeneration (pending verification)','{\"used_recovery\": true}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-27 14:08:56','2025-11-27 14:08:56'),(99,'admin',2,'2fa_regenerate_initiated','administrateur',2,'Initiated 2FA regeneration (pending verification)','{\"used_recovery\": true}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-27 14:38:44','2025-11-27 14:38:44'),(100,'admin',2,'2fa_regenerate_completed','administrateur',2,'Completed 2FA regeneration with new secret','{\"used_pending_flow\": true}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-27 14:39:04','2025-11-27 14:39:04'),(101,'admin',2,'2fa_regenerate_initiated','administrateur',2,'Initiated 2FA regeneration (pending verification)','{\"used_recovery\": false}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-27 15:50:03','2025-11-27 15:50:03'),(102,'admin',2,'2fa_regenerate_initiated','administrateur',2,'Initiated 2FA regeneration (pending verification)','{\"used_recovery\": false}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-27 16:08:45','2025-11-27 16:08:45'),(103,'admin',2,'2fa_regenerate_completed','administrateur',2,'Completed 2FA regeneration with new secret','{\"used_pending_flow\": true}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-27 16:09:02','2025-11-27 16:09:02'),(104,'admin',2,'2fa_regenerate_initiated','administrateur',2,'Initiated 2FA regeneration (pending verification)','{\"used_recovery\": false}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-27 16:17:00','2025-11-27 16:17:00'),(105,'admin',2,'2fa_regenerate_completed','administrateur',2,'Completed 2FA regeneration with new secret','{\"used_pending_flow\": true}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-27 16:17:08','2025-11-27 16:17:08'),(106,'admin',2,'2fa_regenerate_initiated','administrateur',2,'Initiated 2FA regeneration (pending verification)','{\"used_recovery\": false}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-27 16:20:18','2025-11-27 16:20:18'),(107,'admin',2,'2fa_regenerate_completed','administrateur',2,'Completed 2FA regeneration with new secret','{\"used_pending_flow\": true}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-27 16:20:26','2025-11-27 16:20:26'),(108,'admin',2,'2fa_regenerate_initiated','administrateur',2,'Initiated 2FA regeneration (pending verification)','{\"used_recovery\": false}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-27 16:22:19','2025-11-27 16:22:19'),(109,'admin',2,'2fa_regenerate_completed','administrateur',2,'Completed 2FA regeneration with new secret','{\"used_pending_flow\": true}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-27 16:23:07','2025-11-27 16:23:07'),(110,'admin',2,'2fa_regenerate_initiated','administrateur',2,'Initiated 2FA regeneration (pending verification)','{\"used_recovery\": false}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-27 16:27:37','2025-11-27 16:27:37'),(111,'admin',2,'2fa_regenerate_completed','administrateur',2,'Completed 2FA regeneration with new secret','{\"used_pending_flow\": true}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-27 16:27:45','2025-11-27 16:27:45'),(112,'admin',2,'logout','administrateur',2,'Admin logout',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-27 17:50:56','2025-11-27 17:50:56'),(113,'admin',1,'login','administrateur',1,'Admin login',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-27 17:52:04','2025-11-27 17:52:04'),(114,'admin',1,'2fa_challenge_passed','administrateur',1,'Passed 2FA challenge',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-27 17:52:35','2025-11-27 17:52:35'),(115,'admin',1,'2fa_regenerate_initiated','administrateur',1,'Initiated 2FA regeneration (pending verification)','{\"used_recovery\": false}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-27 17:59:19','2025-11-27 17:59:19'),(116,'admin',1,'2fa_regenerate_completed','administrateur',1,'Completed 2FA regeneration with new secret','{\"used_pending_flow\": true}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-27 17:59:53','2025-11-27 17:59:53'),(117,'admin',1,'2fa_disabled_for_other','administrateur',2,'Disabled 2FA for admin secretaire@ecole.com',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-27 18:07:38','2025-11-27 18:07:38'),(118,'admin',1,'logout','administrateur',1,'Admin logout',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-27 18:07:54','2025-11-27 18:07:54'),(119,'admin',2,'login','administrateur',2,'Admin login',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-27 18:07:56','2025-11-27 18:07:56'),(120,'admin',2,'2fa_enable','administrateur',2,'Enabled two-factor authentication',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-27 18:08:10','2025-11-27 18:08:10'),(121,'admin',2,'logout','administrateur',2,'Admin logout',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-27 18:08:38','2025-11-27 18:08:38'),(122,'admin',1,'login','administrateur',1,'Admin login',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-27 18:08:53','2025-11-27 18:08:53'),(123,'admin',1,'2fa_challenge_passed','administrateur',1,'Passed 2FA challenge',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-27 18:09:10','2025-11-27 18:09:10'),(124,'admin',1,'logout','administrateur',1,'Admin logout',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-27 19:22:59','2025-11-27 19:22:59'),(125,'admin',2,'login','administrateur',2,'Admin login',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-27 19:28:20','2025-11-27 19:28:20'),(126,'admin',2,'2fa_challenge_passed','administrateur',2,'Passed 2FA challenge',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-27 19:28:21','2025-11-27 19:28:21'),(127,'admin',2,'logout','administrateur',2,'Admin logout',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-27 19:28:26','2025-11-27 19:28:26'),(128,'admin',2,'login','administrateur',2,'Admin login',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-27 19:38:49','2025-11-27 19:38:49'),(129,'admin',2,'2fa_challenge_passed','administrateur',2,'Passed 2FA challenge',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-27 19:38:51','2025-11-27 19:38:51'),(130,'admin',2,'logout','administrateur',2,'Admin logout',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-27 19:38:56','2025-11-27 19:38:56'),(131,'admin',2,'login','administrateur',2,'Admin login',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-27 19:43:56','2025-11-27 19:43:56'),(132,'admin',2,'2fa_challenge_passed','administrateur',2,'Passed 2FA challenge',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-27 19:43:57','2025-11-27 19:43:57'),(133,'admin',2,'login','administrateur',2,'Admin login',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-27 22:09:15','2025-11-27 22:09:15'),(134,'admin',2,'2fa_challenge_passed','administrateur',2,'Passed 2FA challenge',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-27 22:10:41','2025-11-27 22:10:41'),(135,'admin',2,'logout','administrateur',2,'Admin logout',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-27 22:11:08','2025-11-27 22:11:08'),(136,'admin',2,'login','administrateur',2,'Admin login',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-27 22:11:13','2025-11-27 22:11:13'),(137,'admin',2,'2fa_challenge_passed','administrateur',2,'Passed 2FA challenge',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-27 22:11:13','2025-11-27 22:11:13'),(138,'admin',2,'logout','administrateur',2,'Admin logout',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-27 22:16:41','2025-11-27 22:16:41'),(139,'admin',1,'login','administrateur',1,'Admin login',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-27 22:16:59','2025-11-27 22:16:59'),(140,'admin',1,'2fa_challenge_passed','administrateur',1,'Passed 2FA challenge',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','2025-11-27 22:17:25','2025-11-27 22:17:25'),(141,'admin',1,'login','administrateur',1,'Admin login',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-05 10:35:06','2025-12-05 10:35:06'),(142,'admin',1,'2fa_recovery_used','administrateur',1,'Used a 2FA recovery code','{\"recovery_code_consumed\": true}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-05 10:35:45','2025-12-05 10:35:45'),(143,'admin',2,'login','administrateur',2,'Admin login',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-05 11:45:32','2025-12-05 11:45:32'),(144,'admin',2,'2fa_recovery_used','administrateur',2,'Used a 2FA recovery code','{\"recovery_code_consumed\": true}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-05 11:46:02','2025-12-05 11:46:02'),(145,'admin',1,'login','administrateur',1,'Admin login',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-05 11:49:13','2025-12-05 11:49:13'),(146,'admin',1,'2fa_recovery_used','administrateur',1,'Used a 2FA recovery code','{\"recovery_code_consumed\": true}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-05 11:50:02','2025-12-05 11:50:02'),(147,'admin',2,'login','administrateur',2,'Admin login',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-05 12:22:33','2025-12-05 12:22:33'),(148,'admin',2,'login','administrateur',2,'Admin login',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-05 12:26:38','2025-12-05 12:26:38'),(149,'App\\Models\\User',2,'access_denied','control-panel-7SdjIKZ7fQFu/logs',NULL,'Unauthorized access attempt. Required role: super_admin. User role: admin',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-05 12:37:04','2025-12-05 12:37:04'),(150,'admin',1,'login','administrateur',1,'Admin login',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-05 12:39:50','2025-12-05 12:39:50'),(151,'admin',1,'login','administrateur',1,'Admin login',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-05 12:42:23','2025-12-05 12:42:23'),(152,'admin',1,'login','administrateur',1,'Admin login',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-05 21:00:54','2025-12-05 21:00:54'),(153,'admin',1,'2fa_enable','administrateur',1,'Enabled two-factor authentication',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-05 21:41:59','2025-12-05 21:41:59'),(154,'admin',1,'login','administrateur',1,'Admin login',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-05 22:21:58','2025-12-05 22:21:58'),(155,'admin',1,'2fa_challenge_passed','administrateur',1,'Passed 2FA challenge',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-05 22:21:58','2025-12-05 22:21:58'),(156,'admin',1,'update','admin_allowed_ip',3,'Toggled IP 196.178.85.211 active state from inactive to active','{\"is_active\": {\"new\": true, \"old\": false}}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-05 22:29:38','2025-12-05 22:29:38'),(157,'admin',1,'update','admin_allowed_ip',3,'Toggled IP 196.178.85.211 active state from active to inactive','{\"is_active\": {\"new\": false, \"old\": true}}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-05 22:29:45','2025-12-05 22:29:45'),(158,'admin',1,'update','admin_allowed_ip',3,'Toggled IP 196.178.85.211 active state from inactive to active','{\"is_active\": {\"new\": true, \"old\": false}}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-05 22:29:56','2025-12-05 22:29:56'),(159,'admin',1,'update','admin_allowed_ip',3,'Toggled IP 196.178.85.211 active state from active to inactive','{\"is_active\": {\"new\": false, \"old\": true}}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-05 22:29:59','2025-12-05 22:29:59'),(160,'admin',2,'login','administrateur',2,'Admin login',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-05 22:30:32','2025-12-05 22:30:32'),(161,'admin',1,'login','administrateur',1,'Admin login',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-05 22:30:58','2025-12-05 22:30:58'),(162,'admin',1,'2fa_challenge_passed','administrateur',1,'Passed 2FA challenge',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-05 22:30:59','2025-12-05 22:30:59'),(163,'admin',1,'2fa_enabled_for_other','administrateur',2,'Enabled 2FA for admin secretaire@ecole.com',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-05 22:33:34','2025-12-05 22:33:34'),(164,'admin',1,'2fa_disabled_for_other','administrateur',2,'Disabled 2FA for admin secretaire@ecole.com',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-05 22:33:57','2025-12-05 22:33:57'),(165,'admin',1,'update','admin_allowed_ip',3,'Toggled IP 196.178.85.211 active state from inactive to active','{\"is_active\": {\"new\": true, \"old\": false}}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-05 22:34:14','2025-12-05 22:34:14'),(166,'admin',1,'update','admin_allowed_ip',3,'Toggled IP 196.178.85.211 active state from active to inactive','{\"is_active\": {\"new\": false, \"old\": true}}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-05 22:34:58','2025-12-05 22:34:58');
/*!40000 ALTER TABLE `activity_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_allowed_ips`
--

DROP TABLE IF EXISTS `admin_allowed_ips`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin_allowed_ips` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `added_by` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admin_allowed_ips_ip_address_unique` (`ip_address`),
  KEY `admin_allowed_ips_added_by_foreign` (`added_by`),
  CONSTRAINT `admin_allowed_ips_added_by_foreign` FOREIGN KEY (`added_by`) REFERENCES `administrateurs` (`id_administrateur`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_allowed_ips`
--

LOCK TABLES `admin_allowed_ips` WRITE;
/*!40000 ALTER TABLE `admin_allowed_ips` DISABLE KEYS */;
INSERT INTO `admin_allowed_ips` VALUES (2,'127.0.0.1',NULL,1,NULL,NULL,NULL),(3,'196.178.85.211','mine',0,NULL,'2025-11-25 10:50:06','2025-12-05 22:34:58');
/*!40000 ALTER TABLE `admin_allowed_ips` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `administrateurs`
--

DROP TABLE IF EXISTS `administrateurs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `administrateurs` (
  `id_administrateur` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_enabled` tinyint(1) NOT NULL DEFAULT '0',
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_administrateur`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `administrateurs`
--

LOCK TABLES `administrateurs` WRITE;
/*!40000 ALTER TABLE `administrateurs` DISABLE KEYS */;
INSERT INTO `administrateurs` VALUES (1,'Directeur Principal','Mohamed','admin@ecole.com','2L37FXB2VARBL6PYWHYFV42K',1,'[\"33e7b4cabfea\",\"e4b6e2fe57be\",\"e0ee9c3c500d\",\"d430ad572755\",\"f50e026072bf\",\"07a8a9ab9057\",\"cc7ce9bb9a94\",\"1c6a9c2c69c5\"]','2025-11-25 01:46:15','2025-12-05 21:41:59'),(2,'Secrétaire Générale','Fatima','secretaire@ecole.com',NULL,0,NULL,'2025-11-25 01:46:15','2025-12-05 22:33:57'),(3,'Comptable','Ahmed','comptable@ecole.com',NULL,0,NULL,'2025-11-25 01:46:15','2025-11-25 01:46:15');
/*!40000 ALTER TABLE `administrateurs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `classes`
--

DROP TABLE IF EXISTS `classes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `classes` (
  `id_classe` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nom_classe` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `niveau` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom_classe_translations` json DEFAULT NULL,
  `niveau_translations` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_classe`),
  KEY `classes_niveau_index` (`niveau`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `classes`
--

LOCK TABLES `classes` WRITE;
/*!40000 ALTER TABLE `classes` DISABLE KEYS */;
INSERT INTO `classes` VALUES (1,'CP1','1',NULL,NULL,'2025-11-25 01:46:15','2025-11-25 01:46:15'),(2,'CP2','2',NULL,NULL,'2025-11-25 01:46:15','2025-11-25 01:46:15'),(3,'CE1','3',NULL,NULL,'2025-11-25 01:46:15','2025-11-25 01:46:15'),(4,'CE2','4',NULL,NULL,'2025-11-25 01:46:15','2025-11-25 01:46:15'),(5,'CM1','5',NULL,NULL,'2025-11-25 01:46:15','2025-11-25 01:46:15'),(6,'CM2','6',NULL,NULL,'2025-11-25 01:46:15','2025-11-25 01:46:15'),(7,'6ème A','7',NULL,NULL,'2025-11-25 01:46:15','2025-11-25 01:46:15'),(8,'6ème B','7',NULL,NULL,'2025-11-25 01:46:15','2025-11-25 01:46:15'),(9,'5ème A','8',NULL,NULL,'2025-11-25 01:46:15','2025-11-25 01:46:15'),(10,'5ème B','8',NULL,NULL,'2025-11-25 01:46:15','2025-11-25 01:46:15'),(11,'4ème A','9',NULL,NULL,'2025-11-25 01:46:15','2025-11-25 01:46:15'),(12,'4ème B','9',NULL,NULL,'2025-11-25 01:46:15','2025-11-25 01:46:15'),(13,'3ème A','10',NULL,NULL,'2025-11-25 01:46:15','2025-11-25 01:46:15'),(14,'3ème B','10',NULL,NULL,'2025-11-25 01:46:15','2025-11-25 01:46:15'),(15,'2nde A','11',NULL,NULL,'2025-11-25 01:46:15','2025-11-25 01:46:15'),(16,'2nde B','11',NULL,NULL,'2025-11-25 01:46:15','2025-11-25 01:46:15'),(17,'1ère L','12',NULL,NULL,'2025-11-25 01:46:15','2025-11-25 01:46:15'),(18,'1ère S','12',NULL,NULL,'2025-11-25 01:46:15','2025-11-25 01:46:15'),(19,'Terminale L','13',NULL,NULL,'2025-11-25 01:46:15','2025-11-25 01:46:15'),(20,'Terminale S','13',NULL,NULL,'2025-11-25 01:46:15','2025-11-25 01:46:15');
/*!40000 ALTER TABLE `classes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cours`
--

DROP TABLE IF EXISTS `cours`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cours` (
  `id_cours` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_matiere` bigint unsigned NOT NULL,
  `jour` enum('lundi','mardi','mercredi','jeudi','vendredi','samedi','dimanche') COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_debut` time NOT NULL,
  `date_fin` time NOT NULL,
  `id_enseignant` bigint unsigned NOT NULL,
  `id_classe` bigint unsigned NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_cours`),
  KEY `cours_id_classe_foreign` (`id_classe`),
  KEY `cours_id_enseignant_id_classe_index` (`id_enseignant`,`id_classe`),
  KEY `cours_jour_index` (`jour`),
  KEY `cours_id_matiere_foreign` (`id_matiere`),
  CONSTRAINT `cours_id_classe_foreign` FOREIGN KEY (`id_classe`) REFERENCES `classes` (`id_classe`),
  CONSTRAINT `cours_id_enseignant_foreign` FOREIGN KEY (`id_enseignant`) REFERENCES `enseignants` (`id_enseignant`),
  CONSTRAINT `cours_id_matiere_foreign` FOREIGN KEY (`id_matiere`) REFERENCES `matieres` (`id_matiere`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cours`
--

LOCK TABLES `cours` WRITE;
/*!40000 ALTER TABLE `cours` DISABLE KEYS */;
INSERT INTO `cours` VALUES (1,1,'mercredi','11:00:00','12:00:00',1,1,'Cours de Mathématiques pour la classe CP1','2025-11-25 01:46:16','2025-11-25 01:46:16'),(2,1,'mardi','11:00:00','12:00:00',1,2,'Cours de Mathématiques pour la classe CP2','2025-11-25 01:46:16','2025-11-25 01:46:16'),(3,5,'vendredi','16:00:00','17:00:00',1,1,'Cours de Sciences Physiques pour la classe CP1','2025-11-25 01:46:16','2025-11-25 01:46:16'),(4,5,'vendredi','08:00:00','09:00:00',1,2,'Cours de Sciences Physiques pour la classe CP2','2025-11-25 01:46:16','2025-11-25 01:46:16'),(5,2,'jeudi','09:00:00','10:00:00',2,4,'Cours de Français pour la classe CE2','2025-11-25 01:46:16','2025-11-25 01:46:16'),(6,2,'lundi','16:00:00','17:00:00',2,13,'Cours de Français pour la classe 3ème A','2025-11-25 01:46:16','2025-11-25 01:46:16'),(7,2,'jeudi','15:00:00','16:00:00',2,13,'Cours de Français pour la classe 3ème A','2025-11-25 01:46:16','2025-11-25 01:46:16'),(8,5,'mardi','16:00:00','17:00:00',2,4,'Cours de Sciences Physiques pour la classe CE2','2025-11-25 01:46:16','2025-11-25 01:46:16'),(9,5,'mardi','14:00:00','15:00:00',2,13,'Cours de Sciences Physiques pour la classe 3ème A','2025-11-25 01:46:16','2025-11-25 01:46:16'),(10,8,'vendredi','15:00:00','16:00:00',2,4,'Cours de Education Civique pour la classe CE2','2025-11-25 01:46:16','2025-11-25 01:46:16'),(11,8,'mardi','08:00:00','09:00:00',2,4,'Cours de Education Civique pour la classe CE2','2025-11-25 01:46:16','2025-11-25 01:46:16'),(12,8,'jeudi','11:00:00','12:00:00',2,13,'Cours de Education Civique pour la classe 3ème A','2025-11-25 01:46:16','2025-11-25 01:46:16'),(13,8,'mardi','10:00:00','11:00:00',2,13,'Cours de Education Civique pour la classe 3ème A','2025-11-25 01:46:16','2025-11-25 01:46:16'),(14,2,'jeudi','11:00:00','12:00:00',3,2,'Cours de Français pour la classe CP2','2025-11-25 01:46:16','2025-11-25 01:46:16'),(15,2,'vendredi','11:00:00','12:00:00',3,19,'Cours de Français pour la classe Terminale L','2025-11-25 01:46:16','2025-11-25 01:46:16'),(16,2,'mardi','14:00:00','15:00:00',3,19,'Cours de Français pour la classe Terminale L','2025-11-25 01:46:16','2025-11-25 01:46:16'),(17,3,'vendredi','11:00:00','12:00:00',3,2,'Cours de Anglais pour la classe CP2','2025-11-25 01:46:16','2025-11-25 01:46:16'),(18,3,'lundi','10:00:00','11:00:00',3,19,'Cours de Anglais pour la classe Terminale L','2025-11-25 01:46:16','2025-11-25 01:46:16'),(19,3,'jeudi','10:00:00','11:00:00',3,19,'Cours de Anglais pour la classe Terminale L','2025-11-25 01:46:16','2025-11-25 01:46:16'),(20,7,'jeudi','14:00:00','15:00:00',3,2,'Cours de Education Physique et Sportive pour la classe CP2','2025-11-25 01:46:16','2025-11-25 01:46:16'),(21,7,'lundi','09:00:00','10:00:00',3,2,'Cours de Education Physique et Sportive pour la classe CP2','2025-11-25 01:46:16','2025-11-25 01:46:16'),(22,7,'mercredi','16:00:00','17:00:00',3,19,'Cours de Education Physique et Sportive pour la classe Terminale L','2025-11-25 01:46:16','2025-11-25 01:46:16'),(23,1,'vendredi','08:00:00','09:00:00',4,1,'Cours de Mathématiques pour la classe CP1','2025-11-25 01:46:16','2025-11-25 01:46:16'),(24,1,'mardi','15:00:00','16:00:00',4,15,'Cours de Mathématiques pour la classe 2nde A','2025-11-25 01:46:16','2025-11-25 01:46:16'),(25,1,'vendredi','11:00:00','12:00:00',4,15,'Cours de Mathématiques pour la classe 2nde A','2025-11-25 01:46:16','2025-11-25 01:46:16'),(26,3,'jeudi','16:00:00','17:00:00',4,1,'Cours de Anglais pour la classe CP1','2025-11-25 01:46:16','2025-11-25 01:46:16'),(27,3,'lundi','08:00:00','09:00:00',4,15,'Cours de Anglais pour la classe 2nde A','2025-11-25 01:46:16','2025-11-25 01:46:16'),(28,6,'lundi','15:00:00','16:00:00',4,1,'Cours de Sciences de la Vie et de la Terre pour la classe CP1','2025-11-25 01:46:16','2025-11-25 01:46:16'),(29,6,'mardi','09:00:00','10:00:00',4,15,'Cours de Sciences de la Vie et de la Terre pour la classe 2nde A','2025-11-25 01:46:16','2025-11-25 01:46:16'),(30,6,'mercredi','16:00:00','17:00:00',4,15,'Cours de Sciences de la Vie et de la Terre pour la classe 2nde A','2025-11-25 01:46:16','2025-11-25 01:46:16'),(31,1,'mercredi','08:00:00','09:00:00',5,8,'Cours de Mathématiques pour la classe 6ème B','2025-11-25 01:46:16','2025-11-25 01:46:16'),(32,1,'mardi','14:00:00','15:00:00',5,9,'Cours de Mathématiques pour la classe 5ème A','2025-11-25 01:46:16','2025-11-25 01:46:16'),(33,1,'mercredi','14:00:00','15:00:00',5,9,'Cours de Mathématiques pour la classe 5ème A','2025-11-25 01:46:16','2025-11-25 01:46:16'),(34,7,'jeudi','11:00:00','12:00:00',5,8,'Cours de Education Physique et Sportive pour la classe 6ème B','2025-11-25 01:46:16','2025-11-25 01:46:16'),(35,7,'mercredi','10:00:00','11:00:00',5,8,'Cours de Education Physique et Sportive pour la classe 6ème B','2025-11-25 01:46:16','2025-11-25 01:46:16'),(36,7,'mercredi','10:00:00','11:00:00',5,9,'Cours de Education Physique et Sportive pour la classe 5ème A','2025-11-25 01:46:16','2025-11-25 01:46:16'),(37,7,'vendredi','10:00:00','11:00:00',5,9,'Cours de Education Physique et Sportive pour la classe 5ème A','2025-11-25 01:46:16','2025-11-25 01:46:16'),(38,10,'vendredi','09:00:00','10:00:00',5,8,'Cours de Informatique pour la classe 6ème B','2025-11-25 01:46:16','2025-11-25 01:46:16'),(39,10,'lundi','14:00:00','15:00:00',5,9,'Cours de Informatique pour la classe 5ème A','2025-11-25 01:46:16','2025-11-25 01:46:16');
/*!40000 ALTER TABLE `cours` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `enseignant_matiere_classe`
--

DROP TABLE IF EXISTS `enseignant_matiere_classe`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `enseignant_matiere_classe` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_enseignant` bigint unsigned NOT NULL,
  `id_matiere` bigint unsigned NOT NULL,
  `id_classe` bigint unsigned NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_enseignant_matiere_classe` (`id_enseignant`,`id_matiere`,`id_classe`),
  KEY `enseignant_matiere_classe_id_matiere_index` (`id_matiere`),
  KEY `enseignant_matiere_classe_id_classe_index` (`id_classe`),
  KEY `enseignant_matiere_classe_active_index` (`active`),
  CONSTRAINT `enseignant_matiere_classe_id_classe_foreign` FOREIGN KEY (`id_classe`) REFERENCES `classes` (`id_classe`) ON DELETE CASCADE,
  CONSTRAINT `enseignant_matiere_classe_id_enseignant_foreign` FOREIGN KEY (`id_enseignant`) REFERENCES `enseignants` (`id_enseignant`) ON DELETE CASCADE,
  CONSTRAINT `enseignant_matiere_classe_id_matiere_foreign` FOREIGN KEY (`id_matiere`) REFERENCES `matieres` (`id_matiere`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `enseignant_matiere_classe`
--

LOCK TABLES `enseignant_matiere_classe` WRITE;
/*!40000 ALTER TABLE `enseignant_matiere_classe` DISABLE KEYS */;
INSERT INTO `enseignant_matiere_classe` VALUES (1,1,1,1,1,'2025-11-25 01:46:15','2025-11-25 01:46:15'),(2,1,1,2,1,'2025-11-25 01:46:15','2025-11-25 01:46:15'),(3,1,5,1,1,'2025-11-25 01:46:15','2025-11-25 01:46:15'),(4,1,5,2,1,'2025-11-25 01:46:15','2025-11-25 01:46:15'),(5,2,2,4,1,'2025-11-25 01:46:15','2025-11-25 01:46:15'),(6,2,2,13,1,'2025-11-25 01:46:15','2025-11-25 01:46:15'),(7,2,5,4,1,'2025-11-25 01:46:15','2025-11-25 01:46:15'),(8,2,5,13,1,'2025-11-25 01:46:15','2025-11-25 01:46:15'),(9,2,8,4,1,'2025-11-25 01:46:15','2025-11-25 01:46:15'),(10,2,8,13,1,'2025-11-25 01:46:15','2025-11-25 01:46:15'),(11,3,2,2,1,'2025-11-25 01:46:15','2025-11-25 01:46:15'),(12,3,2,19,1,'2025-11-25 01:46:15','2025-11-25 01:46:15'),(13,3,3,2,1,'2025-11-25 01:46:15','2025-11-25 01:46:15'),(14,3,3,19,1,'2025-11-25 01:46:15','2025-11-25 01:46:15'),(15,3,7,2,1,'2025-11-25 01:46:15','2025-11-25 01:46:15'),(16,3,7,19,1,'2025-11-25 01:46:15','2025-11-25 01:46:15'),(17,4,1,1,1,'2025-11-25 01:46:15','2025-11-25 01:46:15'),(18,4,1,15,1,'2025-11-25 01:46:15','2025-11-25 01:46:15'),(19,4,3,1,1,'2025-11-25 01:46:15','2025-11-25 01:46:15'),(20,4,3,15,1,'2025-11-25 01:46:15','2025-11-25 01:46:15'),(21,4,6,1,1,'2025-11-25 01:46:15','2025-11-25 01:46:15'),(22,4,6,15,1,'2025-11-25 01:46:15','2025-11-25 01:46:15'),(23,5,1,8,1,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(24,5,1,9,1,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(25,5,7,8,1,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(26,5,7,9,1,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(27,5,10,8,1,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(28,5,10,9,1,'2025-11-25 01:46:16','2025-11-25 01:46:16');
/*!40000 ALTER TABLE `enseignant_matiere_classe` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `enseignants`
--

DROP TABLE IF EXISTS `enseignants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `enseignants` (
  `id_enseignant` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_enseignant`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `enseignants`
--

LOCK TABLES `enseignants` WRITE;
/*!40000 ALTER TABLE `enseignants` DISABLE KEYS */;
INSERT INTO `enseignants` VALUES (1,'El Moctar','Sidi Mohamed','elmoctar@ecole.com','+222 20 11 22 33','2025-11-25 01:46:15','2025-11-25 01:46:15',1),(2,'Mint Mohamedou','Aminetou','aminetou@ecole.com','+222 20 11 22 34','2025-11-25 01:46:15','2025-11-25 01:46:15',1),(3,'Ould Baba','Oumar','oumar@ecole.com','+222 20 11 22 35','2025-11-25 01:46:15','2025-11-25 01:46:15',1),(4,'Mint Ahmed','Khadija','khadija@ecole.com','+222 20 11 22 36','2025-11-25 01:46:15','2025-11-25 01:46:15',1),(5,'Ould Sid Ahmed','Mohamed Lemine','lemine@ecole.com','+222 20 11 22 37','2025-11-25 01:46:15','2025-11-25 01:46:15',1),(6,'mo','','mo@gmail.com','','2025-12-05 11:37:45','2025-12-05 11:37:45',1);
/*!40000 ALTER TABLE `enseignants` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `enseignpaiements`
--

DROP TABLE IF EXISTS `enseignpaiements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `enseignpaiements` (
  `id_paiements` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `typepaiement` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `montant` decimal(10,2) NOT NULL DEFAULT '0.00',
  `statut` enum('paye','non_paye','partiel') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non_paye',
  `date_paiement` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_paiements`),
  KEY `enseignpaiements_statut_index` (`statut`),
  KEY `enseignpaiements_user_id_foreign` (`user_id`),
  CONSTRAINT `enseignpaiements_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `enseignpaiements`
--

LOCK TABLES `enseignpaiements` WRITE;
/*!40000 ALTER TABLE `enseignpaiements` DISABLE KEYS */;
/*!40000 ALTER TABLE `enseignpaiements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `etudepaiements`
--

DROP TABLE IF EXISTS `etudepaiements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `etudepaiements` (
  `id_paiements` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_etudiant` bigint unsigned NOT NULL,
  `typepaye` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `montant` decimal(10,2) NOT NULL DEFAULT '0.00',
  `statut` enum('paye','non_paye','partiel') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non_paye',
  `date_paiement` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_paiements`),
  KEY `etudepaiements_id_etudiant_index` (`id_etudiant`),
  KEY `etudepaiements_statut_index` (`statut`),
  CONSTRAINT `etudepaiements_id_etudiant_foreign` FOREIGN KEY (`id_etudiant`) REFERENCES `etudiants` (`id_etudiant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `etudepaiements`
--

LOCK TABLES `etudepaiements` WRITE;
/*!40000 ALTER TABLE `etudepaiements` DISABLE KEYS */;
/*!40000 ALTER TABLE `etudepaiements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `etudiants`
--

DROP TABLE IF EXISTS `etudiants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `etudiants` (
  `id_etudiant` bigint unsigned NOT NULL AUTO_INCREMENT,
  `matricule` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_naissance` date NOT NULL,
  `genre` enum('masculin','feminin') COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_classe` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_etudiant`),
  UNIQUE KEY `etudiants_matricule_unique` (`matricule`),
  KEY `etudiants_id_classe_index` (`id_classe`),
  KEY `etudiants_nom_index` (`nom`),
  KEY `etudiants_matricule_index` (`matricule`),
  CONSTRAINT `etudiants_id_classe_foreign` FOREIGN KEY (`id_classe`) REFERENCES `classes` (`id_classe`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `etudiants`
--

LOCK TABLES `etudiants` WRITE;
/*!40000 ALTER TABLE `etudiants` DISABLE KEYS */;
INSERT INTO `etudiants` VALUES (1,'ETU0001','Ba','Aissata','2010-03-15','feminin','+222 30 11 22 33','Tevragh Zeina, Nouakchott','aissata.ba@etudiant.com',7,'2025-11-25 01:46:15','2025-11-25 01:46:15'),(2,'ETU0002','Ould Ahmed','Mohamed Salem','2010-07-22','masculin','+222 30 11 22 34','Ksar, Nouakchott','salem.ahmed@etudiant.com',7,'2025-11-25 01:46:15','2025-11-25 01:46:15'),(3,'ETU0003','Mint Sidi','Fatimata','2010-11-08','feminin','+222 30 11 22 35','El Mina, Nouakchott','fatimata.sidi@etudiant.com',7,'2025-11-25 01:46:15','2025-11-25 01:46:15'),(4,'ETU0004','Ould Baba','Ahmed Mahmoud','2010-01-12','masculin','+222 30 11 22 36','Sebkha, Nouakchott','ahmed.baba@etudiant.com',8,'2025-11-25 01:46:15','2025-11-25 01:46:15'),(5,'ETU0005','Sy','Mariama','2010-05-30','feminin','+222 30 11 22 37','Arafat, Nouakchott','mariama.sy@etudiant.com',8,'2025-11-25 01:46:15','2025-11-25 01:46:15'),(6,'ETU0006','Ould Mohamed','Sidi Mohamed','2009-09-14','masculin','+222 30 11 22 38','Toujounine, Nouakchott','sidi.mohamed@etudiant.com',9,'2025-11-25 01:46:15','2025-11-25 01:46:15'),(7,'ETU0007','Mint Vall','Aïcha','2009-02-28','feminin','+222 30 11 22 39','Dar Naim, Nouakchott','aicha.vall@etudiant.com',9,'2025-11-25 01:46:15','2025-11-25 01:46:15'),(8,'ETU0008','Kane','Ousmane','2005-12-10','masculin','+222 30 11 22 40','Riad, Nouakchott','ousmane.kane@etudiant.com',20,'2025-11-25 01:46:15','2025-11-25 01:46:15'),(9,'ETU0009','Mint Ebnou','Khadijetou','2005-08-16','feminin','+222 30 11 22 41','Hay Saken, Nouakchott','khadijetou.ebnou@etudiant.com',20,'2025-11-25 01:46:15','2025-11-25 01:46:15'),(10,'ETU0010','Diallo','Amadou','2012-04-25','masculin','+222 30 11 22 42','Medina, Nouakchott','amadou.diallo@etudiant.com',6,'2025-11-25 01:46:15','2025-11-25 01:46:15');
/*!40000 ALTER TABLE `etudiants` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `evaluations`
--

DROP TABLE IF EXISTS `evaluations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `evaluations` (
  `id_evaluation` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_matiere` bigint unsigned NOT NULL,
  `titre` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date NOT NULL,
  `date_debut` time DEFAULT NULL,
  `date_fin` time DEFAULT NULL,
  `id_classe` bigint unsigned NOT NULL,
  `type` enum('devoir','examen','controle') COLLATE utf8mb4_unicode_ci NOT NULL,
  `note_max` decimal(5,2) NOT NULL DEFAULT '20.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_evaluation`),
  KEY `evaluations_id_classe_index` (`id_classe`),
  KEY `evaluations_id_matiere_index` (`id_matiere`),
  KEY `evaluations_date_index` (`date`),
  KEY `evaluations_type_index` (`type`),
  CONSTRAINT `evaluations_id_classe_foreign` FOREIGN KEY (`id_classe`) REFERENCES `classes` (`id_classe`) ON DELETE CASCADE,
  CONSTRAINT `evaluations_id_matiere_foreign` FOREIGN KEY (`id_matiere`) REFERENCES `matieres` (`id_matiere`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `evaluations`
--

LOCK TABLES `evaluations` WRITE;
/*!40000 ALTER TABLE `evaluations` DISABLE KEYS */;
INSERT INTO `evaluations` VALUES (1,1,'Controle de Mathématiques - Séance 1','2025-09-09','13:30:00','15:30:00',1,'controle',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(2,1,'Devoir de Mathématiques - Séance 2','2025-09-16','15:30:00','17:30:00',1,'devoir',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(3,1,'Devoir de Mathématiques - Séance 3','2025-11-20','13:00:00','14:00:00',1,'devoir',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(4,1,'Controle de Mathématiques - Séance 1','2025-11-08','14:00:00','17:00:00',2,'controle',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(5,1,'Examen de Mathématiques - Séance 2','2025-10-26','10:30:00','11:30:00',2,'examen',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(6,5,'Devoir de Sciences Physiques - Séance 1','2025-09-11','13:30:00','15:30:00',1,'devoir',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(7,5,'Examen de Sciences Physiques - Séance 2','2025-11-07','09:30:00','12:30:00',1,'examen',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(8,5,'Controle de Sciences Physiques - Séance 1','2025-09-09','14:00:00','15:00:00',2,'controle',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(9,5,'Examen de Sciences Physiques - Séance 2','2025-09-14','15:30:00','16:30:00',2,'examen',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(10,2,'Examen de Français - Séance 1','2025-10-31','13:30:00','16:30:00',4,'examen',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(11,2,'Controle de Français - Séance 2','2025-10-13','13:00:00','16:00:00',4,'controle',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(12,2,'Devoir de Français - Séance 3','2025-10-23','13:30:00','16:30:00',4,'devoir',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(13,2,'Examen de Français - Séance 1','2025-11-15','10:00:00','13:00:00',13,'examen',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(14,2,'Controle de Français - Séance 2','2025-11-21','10:30:00','12:30:00',13,'controle',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(15,2,'Devoir de Français - Séance 3','2025-10-16','08:30:00','10:30:00',13,'devoir',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(16,2,'Examen de Français - Séance 1','2025-08-30','10:00:00','12:00:00',13,'examen',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(17,2,'Devoir de Français - Séance 2','2025-10-27','10:00:00','13:00:00',13,'devoir',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(18,2,'Examen de Français - Séance 3','2025-10-29','13:00:00','15:00:00',13,'examen',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(19,5,'Devoir de Sciences Physiques - Séance 1','2025-11-15','08:00:00','11:00:00',4,'devoir',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(20,5,'Devoir de Sciences Physiques - Séance 2','2025-10-05','09:30:00','11:30:00',4,'devoir',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(21,5,'Examen de Sciences Physiques - Séance 3','2025-11-05','15:30:00','17:30:00',4,'examen',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(22,5,'Devoir de Sciences Physiques - Séance 1','2025-11-06','09:00:00','11:00:00',13,'devoir',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(23,5,'Controle de Sciences Physiques - Séance 2','2025-10-01','09:00:00','12:00:00',13,'controle',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(24,8,'Examen de Education Civique - Séance 1','2025-09-06','15:00:00','16:00:00',4,'examen',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(25,8,'Controle de Education Civique - Séance 2','2025-11-20','09:00:00','12:00:00',4,'controle',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(26,8,'Controle de Education Civique - Séance 3','2025-09-15','10:00:00','11:00:00',4,'controle',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(27,8,'Examen de Education Civique - Séance 1','2025-08-27','13:00:00','14:00:00',4,'examen',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(28,8,'Devoir de Education Civique - Séance 2','2025-09-04','08:00:00','10:00:00',4,'devoir',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(29,8,'Controle de Education Civique - Séance 1','2025-10-27','14:00:00','17:00:00',13,'controle',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(30,8,'Devoir de Education Civique - Séance 2','2025-09-06','15:00:00','18:00:00',13,'devoir',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(31,8,'Devoir de Education Civique - Séance 3','2025-08-31','13:30:00','16:30:00',13,'devoir',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(32,8,'Controle de Education Civique - Séance 1','2025-11-04','14:00:00','16:00:00',13,'controle',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(33,8,'Examen de Education Civique - Séance 2','2025-09-01','15:00:00','16:00:00',13,'examen',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(34,2,'Devoir de Français - Séance 1','2025-09-26','09:00:00','10:00:00',2,'devoir',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(35,2,'Examen de Français - Séance 2','2025-10-07','13:30:00','15:30:00',2,'examen',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(36,2,'Devoir de Français - Séance 3','2025-10-10','10:30:00','13:30:00',2,'devoir',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(37,2,'Devoir de Français - Séance 1','2025-09-05','13:00:00','16:00:00',19,'devoir',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(38,2,'Controle de Français - Séance 2','2025-10-20','13:00:00','15:00:00',19,'controle',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(39,2,'Devoir de Français - Séance 3','2025-11-01','10:00:00','11:00:00',19,'devoir',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(40,2,'Examen de Français - Séance 1','2025-10-23','13:00:00','15:00:00',19,'examen',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(41,2,'Examen de Français - Séance 2','2025-09-07','14:00:00','16:00:00',19,'examen',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(42,3,'Examen de Anglais - Séance 1','2025-10-01','10:00:00','11:00:00',2,'examen',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(43,3,'Controle de Anglais - Séance 2','2025-11-19','15:30:00','17:30:00',2,'controle',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(44,3,'Controle de Anglais - Séance 1','2025-11-03','13:30:00','16:30:00',19,'controle',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(45,3,'Controle de Anglais - Séance 2','2025-10-03','08:30:00','10:30:00',19,'controle',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(46,3,'Examen de Anglais - Séance 1','2025-10-14','08:30:00','10:30:00',19,'examen',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(47,3,'Devoir de Anglais - Séance 2','2025-08-29','10:00:00','11:00:00',19,'devoir',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(48,7,'Controle de Education Physique et Sportive - Séance 1','2025-11-21','10:30:00','11:30:00',2,'controle',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(49,7,'Controle de Education Physique et Sportive - Séance 2','2025-08-28','08:00:00','09:00:00',2,'controle',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(50,7,'Devoir de Education Physique et Sportive - Séance 3','2025-09-06','14:00:00','15:00:00',2,'devoir',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(51,7,'Devoir de Education Physique et Sportive - Séance 1','2025-11-20','15:00:00','18:00:00',2,'devoir',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(52,7,'Examen de Education Physique et Sportive - Séance 2','2025-09-02','09:30:00','12:30:00',2,'examen',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(53,7,'Examen de Education Physique et Sportive - Séance 3','2025-10-13','08:30:00','11:30:00',2,'examen',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(54,7,'Controle de Education Physique et Sportive - Séance 1','2025-11-20','09:00:00','11:00:00',19,'controle',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(55,7,'Examen de Education Physique et Sportive - Séance 2','2025-09-18','14:30:00','15:30:00',19,'examen',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(56,7,'Examen de Education Physique et Sportive - Séance 3','2025-09-14','09:30:00','12:30:00',19,'examen',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(57,1,'Controle de Mathématiques - Séance 1','2025-08-31','14:30:00','15:30:00',1,'controle',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(58,1,'Examen de Mathématiques - Séance 2','2025-09-02','14:30:00','15:30:00',1,'examen',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(59,1,'Controle de Mathématiques - Séance 3','2025-10-14','13:00:00','15:00:00',1,'controle',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(60,1,'Controle de Mathématiques - Séance 1','2025-09-30','10:00:00','12:00:00',15,'controle',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(61,1,'Devoir de Mathématiques - Séance 2','2025-08-30','08:00:00','09:00:00',15,'devoir',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(62,1,'Controle de Mathématiques - Séance 1','2025-10-06','09:30:00','10:30:00',15,'controle',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(63,1,'Controle de Mathématiques - Séance 2','2025-09-19','15:30:00','17:30:00',15,'controle',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(64,3,'Examen de Anglais - Séance 1','2025-11-24','09:00:00','10:00:00',1,'examen',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(65,3,'Devoir de Anglais - Séance 2','2025-10-22','09:30:00','10:30:00',1,'devoir',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(66,3,'Devoir de Anglais - Séance 3','2025-09-05','08:00:00','09:00:00',1,'devoir',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(67,3,'Controle de Anglais - Séance 1','2025-10-05','08:00:00','11:00:00',15,'controle',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(68,3,'Controle de Anglais - Séance 2','2025-11-14','10:00:00','12:00:00',15,'controle',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(69,3,'Devoir de Anglais - Séance 3','2025-10-25','14:00:00','17:00:00',15,'devoir',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(70,6,'Controle de Sciences de la Vie et de la Terre - Séance 1','2025-09-12','10:00:00','13:00:00',1,'controle',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(71,6,'Devoir de Sciences de la Vie et de la Terre - Séance 2','2025-10-12','10:00:00','11:00:00',1,'devoir',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(72,6,'Examen de Sciences de la Vie et de la Terre - Séance 3','2025-10-23','08:30:00','10:30:00',1,'examen',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(73,6,'Controle de Sciences de la Vie et de la Terre - Séance 1','2025-11-07','10:30:00','12:30:00',15,'controle',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(74,6,'Examen de Sciences de la Vie et de la Terre - Séance 2','2025-09-03','13:00:00','14:00:00',15,'examen',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(75,6,'Devoir de Sciences de la Vie et de la Terre - Séance 3','2025-10-22','08:00:00','09:00:00',15,'devoir',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(76,6,'Examen de Sciences de la Vie et de la Terre - Séance 1','2025-09-23','10:30:00','12:30:00',15,'examen',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(77,6,'Devoir de Sciences de la Vie et de la Terre - Séance 2','2025-10-27','14:00:00','15:00:00',15,'devoir',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(78,6,'Examen de Sciences de la Vie et de la Terre - Séance 3','2025-10-09','14:00:00','16:00:00',15,'examen',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(79,1,'Examen de Mathématiques - Séance 1','2025-10-09','09:30:00','12:30:00',8,'examen',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(80,1,'Controle de Mathématiques - Séance 2','2025-09-22','09:00:00','10:00:00',8,'controle',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(81,1,'Examen de Mathématiques - Séance 3','2025-09-16','08:00:00','10:00:00',8,'examen',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(82,1,'Examen de Mathématiques - Séance 1','2025-09-07','10:00:00','13:00:00',9,'examen',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(83,1,'Controle de Mathématiques - Séance 2','2025-11-10','10:30:00','12:30:00',9,'controle',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(84,1,'Examen de Mathématiques - Séance 1','2025-10-25','15:00:00','17:00:00',9,'examen',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(85,1,'Controle de Mathématiques - Séance 2','2025-08-27','15:00:00','17:00:00',9,'controle',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(86,7,'Examen de Education Physique et Sportive - Séance 1','2025-09-28','15:00:00','17:00:00',8,'examen',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(87,7,'Examen de Education Physique et Sportive - Séance 2','2025-10-14','09:30:00','11:30:00',8,'examen',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(88,7,'Examen de Education Physique et Sportive - Séance 3','2025-09-14','10:30:00','12:30:00',8,'examen',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(89,7,'Controle de Education Physique et Sportive - Séance 1','2025-10-15','09:00:00','12:00:00',8,'controle',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(90,7,'Controle de Education Physique et Sportive - Séance 2','2025-11-22','09:30:00','12:30:00',8,'controle',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(91,7,'Controle de Education Physique et Sportive - Séance 1','2025-09-22','10:30:00','13:30:00',9,'controle',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(92,7,'Controle de Education Physique et Sportive - Séance 2','2025-11-13','08:00:00','10:00:00',9,'controle',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(93,7,'Devoir de Education Physique et Sportive - Séance 3','2025-10-27','10:00:00','13:00:00',9,'devoir',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(94,7,'Controle de Education Physique et Sportive - Séance 1','2025-09-11','08:30:00','11:30:00',9,'controle',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(95,7,'Controle de Education Physique et Sportive - Séance 2','2025-11-10','10:00:00','13:00:00',9,'controle',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(96,7,'Devoir de Education Physique et Sportive - Séance 3','2025-11-02','14:00:00','16:00:00',9,'devoir',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(97,10,'Examen de Informatique - Séance 1','2025-09-27','15:00:00','17:00:00',8,'examen',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(98,10,'Devoir de Informatique - Séance 2','2025-11-02','13:00:00','14:00:00',8,'devoir',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(99,10,'Examen de Informatique - Séance 1','2025-09-08','15:30:00','18:30:00',9,'examen',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(100,10,'Controle de Informatique - Séance 2','2025-08-30','10:30:00','13:30:00',9,'controle',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16'),(101,10,'Controle de Informatique - Séance 3','2025-11-07','10:30:00','13:30:00',9,'controle',20.00,'2025-11-25 01:46:16','2025-11-25 01:46:16');
/*!40000 ALTER TABLE `evaluations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `matieres`
--

DROP TABLE IF EXISTS `matieres`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `matieres` (
  `id_matiere` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nom_matiere` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_matiere` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `coefficient` int NOT NULL DEFAULT '1',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_matiere`),
  UNIQUE KEY `matieres_code_matiere_unique` (`code_matiere`),
  KEY `matieres_code_matiere_index` (`code_matiere`),
  KEY `matieres_active_index` (`active`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `matieres`
--

LOCK TABLES `matieres` WRITE;
/*!40000 ALTER TABLE `matieres` DISABLE KEYS */;
INSERT INTO `matieres` VALUES (1,'Mathématiques','MATH','Mathématiques générales',4,1,'2025-11-25 01:46:15','2025-11-25 01:46:15'),(2,'Français','FR','Langue française et littérature',3,1,'2025-11-25 01:46:15','2025-11-25 01:46:15'),(3,'Anglais','ANG','Langue anglaise',2,1,'2025-11-25 01:46:15','2025-11-25 01:46:15'),(4,'Histoire-Géographie','HG','Histoire et géographie',3,1,'2025-11-25 01:46:15','2025-11-25 01:46:15'),(5,'Sciences Physiques','PHY','Physique et chimie',3,1,'2025-11-25 01:46:15','2025-11-25 01:46:15'),(6,'Sciences de la Vie et de la Terre','SVT','Biologie et géologie',3,1,'2025-11-25 01:46:15','2025-11-25 01:46:15'),(7,'Education Physique et Sportive','EPS','Sport et éducation physique',1,1,'2025-11-25 01:46:15','2025-11-25 01:46:15'),(8,'Education Civique','EC','Education civique et morale',1,1,'2025-11-25 01:46:15','2025-11-25 01:46:15'),(9,'Arts Plastiques','ART','Arts visuels et plastiques',1,1,'2025-11-25 01:46:15','2025-11-25 01:46:15'),(10,'Informatique','INFO','Informatique et technologies',2,1,'2025-11-25 01:46:15','2025-11-25 01:46:15');
/*!40000 ALTER TABLE `matieres` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_reset_tokens_table',1),(3,'2014_10_12_100000_create_password_resets_table',1),(4,'2019_08_19_000000_create_failed_jobs_table',1),(5,'2019_12_14_000001_create_personal_access_tokens_table',1),(6,'2023_07_25_192911_create_classes_table',1),(7,'2023_07_25_192912_create_administrateurs_table',1),(8,'2023_07_25_192912_create_enseignants_table',1),(9,'2023_07_25_192912_create_etudiants_table',1),(10,'2023_07_25_192913_create_cours_table',1),(11,'2023_07_25_192914_create_evaluations_table',1),(12,'2023_07_25_192915_create_etudepaiements_table',1),(13,'2023_07_25_192915_create_notes_table',1),(14,'2023_07_25_192916_create_enseignpaiements_table',1),(15,'2025_09_14_125323_create_clean_auth_system',1),(16,'2025_09_15_133352_add_note_max_to_evaluations_table',1),(17,'2025_09_15_142536_create_matieres_table',1),(18,'2025_09_15_142607_create_enseignant_matiere_classe_table',1),(19,'2025_09_15_143446_update_evaluations_table_for_matieres',1),(20,'2025_09_15_154536_update_cours_table_for_matieres',1),(21,'2025_09_15_154725_update_notes_table_for_matieres',1),(22,'2025_09_15_154850_update_enseignpaiements_table_for_users',1),(23,'2025_09_15_160056_fix_enseignant_matiere_classe_table',1),(24,'2025_09_15_235842_add_unique_constraint_to_notes_table',1),(25,'2025_09_23_204852_remove_redundant_columns_from_users_and_enseignants_tables',1),(26,'2025_09_23_205110_fix_enseignant_matiere_classe_user_to_enseignant_id',1),(27,'2025_09_24_120000_fix_evaluations_table_relationships',1),(28,'2025_10_02_152321_update_evaluations_table_structure',1),(29,'2025_11_24_200124_create_admin_allowed_ips_table',1),(30,'2025_11_24_201331_add_remember_token_to_administrateurs_table',1),(31,'2025_11_25_005820_add_role_to_administrateurs_table',1),(32,'2025_11_25_210000_add_two_factor_to_administrateurs_table',2),(33,'2025_11_25_220000_add_auth_fields_to_enseignants',2),(34,'2025_11_25_230000_create_activity_logs_table',2),(35,'2025_11_25_115034_fix_null_created_at_in_admin_allowed_ips_table',3),(36,'2025_12_05_103331_rename_mot_de_passe_to_password_in_users_tables',4),(37,'2025_12_05_110453_unify_users_table_and_migrate_data',5),(38,'2025_12_05_130000_cleanup_legacy_auth_columns',6);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notes`
--

DROP TABLE IF EXISTS `notes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notes` (
  `id_note` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_matiere` bigint unsigned NOT NULL,
  `note` decimal(5,2) NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_etudiant` bigint unsigned NOT NULL,
  `id_evaluation` bigint unsigned NOT NULL,
  `id_classe` bigint unsigned NOT NULL,
  `commentaire` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_note`),
  UNIQUE KEY `unique_student_evaluation` (`id_etudiant`,`id_evaluation`),
  KEY `notes_id_evaluation_foreign` (`id_evaluation`),
  KEY `notes_id_etudiant_id_evaluation_index` (`id_etudiant`,`id_evaluation`),
  KEY `notes_id_classe_index` (`id_classe`),
  KEY `notes_id_matiere_foreign` (`id_matiere`),
  CONSTRAINT `notes_id_classe_foreign` FOREIGN KEY (`id_classe`) REFERENCES `classes` (`id_classe`),
  CONSTRAINT `notes_id_etudiant_foreign` FOREIGN KEY (`id_etudiant`) REFERENCES `etudiants` (`id_etudiant`),
  CONSTRAINT `notes_id_evaluation_foreign` FOREIGN KEY (`id_evaluation`) REFERENCES `evaluations` (`id_evaluation`),
  CONSTRAINT `notes_id_matiere_foreign` FOREIGN KEY (`id_matiere`) REFERENCES `matieres` (`id_matiere`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notes`
--

LOCK TABLES `notes` WRITE;
/*!40000 ALTER TABLE `notes` DISABLE KEYS */;
INSERT INTO `notes` VALUES (1,1,12.00,'examen',4,79,8,'Efforts à poursuivre.','2025-11-25 01:46:16','2025-11-25 01:46:16'),(2,1,16.00,'examen',5,79,8,'Travail satisfaisant, continuez.','2025-11-25 01:46:17','2025-11-25 01:46:17'),(3,1,13.50,'controle',4,80,8,'Efforts à poursuivre.','2025-11-25 01:46:17','2025-11-25 01:46:17'),(4,1,17.00,'controle',5,80,8,'Bien joué, quelques points à améliorer.','2025-11-25 01:46:17','2025-11-25 01:46:17'),(5,1,11.00,'examen',4,81,8,'Efforts à poursuivre.','2025-11-25 01:46:17','2025-11-25 01:46:17'),(6,1,11.00,'examen',5,81,8,'Quelques lacunes à combler.','2025-11-25 01:46:17','2025-11-25 01:46:17'),(7,1,18.00,'examen',6,82,9,'Excellent travail ! Félicitations.','2025-11-25 01:46:17','2025-11-25 01:46:17'),(8,1,2.00,'examen',7,82,9,'Travail insuffisant, il faut réviser.','2025-11-25 01:46:17','2025-11-25 01:46:17'),(9,1,19.00,'controle',6,83,9,'Excellent travail ! Félicitations.','2025-11-25 01:46:17','2025-11-25 01:46:17'),(10,1,17.50,'controle',7,83,9,'Bonne compréhension du sujet.','2025-11-25 01:46:17','2025-11-25 01:46:17'),(11,1,11.00,'examen',6,84,9,'Efforts à poursuivre.','2025-11-25 01:46:17','2025-11-25 01:46:17'),(12,1,14.50,'examen',7,84,9,'Bien joué, quelques points à améliorer.','2025-11-25 01:46:17','2025-11-25 01:46:17'),(13,1,11.00,'controle',6,85,9,'Travail moyen, peut mieux faire.','2025-11-25 01:46:17','2025-11-25 01:46:17'),(14,1,10.50,'controle',7,85,9,'Quelques lacunes à combler.','2025-11-25 01:46:17','2025-11-25 01:46:17'),(15,7,13.00,'examen',4,86,8,'Quelques lacunes à combler.','2025-11-25 01:46:17','2025-11-25 01:46:17'),(16,7,11.50,'examen',5,86,8,'Quelques lacunes à combler.','2025-11-25 01:46:17','2025-11-25 01:46:17'),(17,7,15.00,'examen',4,87,8,'Bonne compréhension du sujet.','2025-11-25 01:46:17','2025-11-25 01:46:17'),(18,7,14.00,'examen',5,87,8,'Bien joué, quelques points à améliorer.','2025-11-25 01:46:17','2025-11-25 01:46:17'),(19,7,14.50,'examen',4,88,8,'Bonne compréhension du sujet.','2025-11-25 01:46:17','2025-11-25 01:46:17'),(20,7,11.50,'examen',5,88,8,'Travail moyen, peut mieux faire.','2025-11-25 01:46:17','2025-11-25 01:46:17'),(21,7,13.50,'controle',4,89,8,'Travail acceptable, à améliorer.','2025-11-25 01:46:17','2025-11-25 01:46:17'),(22,7,16.00,'controle',5,89,8,'Travail satisfaisant, continuez.','2025-11-25 01:46:17','2025-11-25 01:46:17'),(23,7,10.50,'controle',4,90,8,'Efforts à poursuivre.','2025-11-25 01:46:17','2025-11-25 01:46:17'),(24,7,10.00,'controle',5,90,8,'Efforts à poursuivre.','2025-11-25 01:46:17','2025-11-25 01:46:17'),(25,7,8.50,'controle',6,91,9,'Beaucoup d\'efforts à fournir.','2025-11-25 01:46:17','2025-11-25 01:46:17'),(26,7,11.00,'controle',7,91,9,'Travail acceptable, à améliorer.','2025-11-25 01:46:17','2025-11-25 01:46:17'),(27,7,14.00,'controle',6,92,9,'Bien joué, quelques points à améliorer.','2025-11-25 01:46:17','2025-11-25 01:46:17'),(28,7,12.00,'controle',7,92,9,'Efforts à poursuivre.','2025-11-25 01:46:17','2025-11-25 01:46:17'),(29,7,12.50,'devoir',6,93,9,'Travail moyen, peut mieux faire.','2025-11-25 01:46:17','2025-11-25 01:46:17'),(30,7,17.00,'devoir',7,93,9,'Travail satisfaisant, continuez.','2025-11-25 01:46:17','2025-11-25 01:46:17'),(31,7,12.00,'controle',6,94,9,'Quelques lacunes à combler.','2025-11-25 01:46:17','2025-11-25 01:46:17'),(32,7,19.50,'controle',7,94,9,'Très belle performance, continuez ainsi.','2025-11-25 01:46:17','2025-11-25 01:46:17'),(33,7,13.00,'controle',6,95,9,'Travail moyen, peut mieux faire.','2025-11-25 01:46:17','2025-11-25 01:46:17'),(34,7,10.50,'controle',7,95,9,'Quelques lacunes à combler.','2025-11-25 01:46:17','2025-11-25 01:46:17'),(35,7,7.50,'devoir',6,96,9,'Beaucoup d\'efforts à fournir.','2025-11-25 01:46:17','2025-11-25 01:46:17'),(36,7,20.00,'devoir',7,96,9,'Travail exemplaire, bravo !','2025-11-25 01:46:17','2025-11-25 01:46:17'),(37,10,19.50,'examen',4,97,8,'Excellent travail ! Félicitations.','2025-11-25 01:46:17','2025-11-25 01:46:17'),(38,10,11.00,'examen',5,97,8,'Quelques lacunes à combler.','2025-11-25 01:46:17','2025-11-25 01:46:17'),(39,10,10.00,'devoir',4,98,8,'Travail moyen, peut mieux faire.','2025-11-25 01:46:17','2025-11-25 01:46:17'),(40,10,12.00,'devoir',5,98,8,'Travail acceptable, à améliorer.','2025-11-25 01:46:17','2025-11-25 01:46:17'),(41,10,10.50,'examen',6,99,9,'Travail acceptable, à améliorer.','2025-11-25 01:46:17','2025-11-25 01:46:17'),(42,10,13.00,'examen',7,99,9,'Quelques lacunes à combler.','2025-11-25 01:46:17','2025-11-25 01:46:17'),(43,10,10.50,'controle',6,100,9,'Quelques lacunes à combler.','2025-11-25 01:46:17','2025-11-25 01:46:17'),(44,10,3.00,'controle',7,100,9,'Nécessite plus de travail personnel.','2025-11-25 01:46:17','2025-11-25 01:46:17'),(45,10,11.00,'controle',6,101,9,'Travail moyen, peut mieux faire.','2025-11-25 01:46:17','2025-11-25 01:46:17'),(46,10,17.00,'controle',7,101,9,'Bon travail, bien maîtrisé.','2025-11-25 01:46:17','2025-11-25 01:46:17');
/*!40000 ALTER TABLE `notes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nom` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `telephone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `profile_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_id` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_profile_type_profile_id_index` (`profile_type`,`profile_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Mohamed Directeur Principal','Mohamed','Directeur Principal','admin@ecole.com','super_admin',NULL,1,'2025-11-25 01:46:15','$2y$10$2gMPaZDZkKrYEVrN.2oQ9ebTkHz22JepkYlLPUwl75a1Fp3p9NIG6','jRRqcX0AXi68URoqVp3h5RJl9OQk2r5ZxMGs5TcWDrQkCnyn4vhyCm8wpvu2','2025-11-25 01:46:15','2025-11-25 01:46:15','App\\Models\\Administrateur',1),(2,'Fatima Secrétaire Générale','Fatima','Secrétaire Générale','secretaire@ecole.com','admin',NULL,1,'2025-11-25 01:46:15','$2y$10$h67Mt4jV1gbI/fG8/O2G8.i/ZOwioaEnV4VppjorjtjI0q/c/6awi','twE8uWCl6lEan1rghiSE3QtU2ln9UH7NXcFcGKr7EQvwhzMvoSb7mlbqrKhq','2025-11-25 01:46:15','2025-11-25 01:46:15','App\\Models\\Administrateur',2),(3,'Ahmed Comptable','Ahmed','Comptable','comptable@ecole.com','admin',NULL,1,'2025-11-25 01:46:15','$2y$10$z4cUIMfrtGAmgNEBB8HSJOa5nMZ.sibMCBS6UZl0DZxqJmBhU.PhG',NULL,'2025-11-25 01:46:15','2025-11-25 01:46:15','App\\Models\\Administrateur',3),(4,'Sidi Mohamed El Moctar','Sidi Mohamed','El Moctar','elmoctar@ecole.com','teacher','+222 20 11 22 33',1,'2025-11-25 01:46:15','$2y$10$E8G/T/EUGnEHTZ.X/KKzIeIaFUjXZplIRDsEjltdF37gaJzTUXzR6',NULL,'2025-11-25 01:46:15','2025-11-25 01:46:15','App\\Models\\Enseignant',1),(5,'Aminetou Mint Mohamedou','Aminetou','Mint Mohamedou','aminetou@ecole.com','teacher','+222 20 11 22 34',1,'2025-11-25 01:46:15','$2y$10$qCLBEeaUKdzSTrnjb9828Ov8wPlZzohgmaFaGp48fsu97cwezT9gG',NULL,'2025-11-25 01:46:15','2025-11-25 01:46:15','App\\Models\\Enseignant',2),(6,'Oumar Ould Baba','Oumar','Ould Baba','oumar@ecole.com','teacher','+222 20 11 22 35',1,'2025-11-25 01:46:15','$2y$10$j1fEpwHcw8zHT/heaM.qk.pP0CR91ffCVHz6mIcKXGrs/BVnrhcgC',NULL,'2025-11-25 01:46:15','2025-11-25 01:46:15','App\\Models\\Enseignant',3),(7,'Khadija Mint Ahmed','Khadija','Mint Ahmed','khadija@ecole.com','teacher','+222 20 11 22 36',1,'2025-11-25 01:46:15','$2y$10$q9cxLAcCFA3v5RmSw0dbeepuHuB2RjRTvMlXY/Vpn5DgnfulAA15e',NULL,'2025-11-25 01:46:15','2025-11-25 01:46:15','App\\Models\\Enseignant',4),(8,'Mohamed Lemine Ould Sid Ahmed','Mohamed Lemine','Ould Sid Ahmed','lemine@ecole.com','teacher','+222 20 11 22 37',1,'2025-11-25 01:46:15','$2y$10$waTcfB5xuQav0pBGanmsHeRMMI6ShBJCRjR4egoAXe1klsZWIfIU.',NULL,'2025-11-25 01:46:15','2025-11-25 01:46:15','App\\Models\\Enseignant',5),(9,'Ba Aissata',NULL,NULL,'aissata.ba@etudiant.com','student',NULL,1,NULL,'$2y$10$aHbU5PCRMUPK72fIB3.HqOdgOnDRKD7YSmShU/syBVoAkdGh0sTCu',NULL,'2025-11-25 01:46:15','2025-11-25 01:46:15','App\\Models\\Etudiant',1),(10,'Ould Ahmed Mohamed Salem',NULL,NULL,'salem.ahmed@etudiant.com','student',NULL,1,NULL,'$2y$10$EIusvAkf6Cre1FBn0ik4teneeRbZZWyZZXlQ0ND1/pE9M9XwlXuLe',NULL,'2025-11-25 01:46:15','2025-11-25 01:46:15','App\\Models\\Etudiant',2),(11,'Mint Sidi Fatimata',NULL,NULL,'fatimata.sidi@etudiant.com','student',NULL,1,NULL,'$2y$10$jJ7SWPqIse9Ep1Sm5CINuuwTUKdscfKiTxdJvPzExlKubyDaUCrou',NULL,'2025-11-25 01:46:15','2025-11-25 01:46:15','App\\Models\\Etudiant',3),(12,'Ould Baba Ahmed Mahmoud',NULL,NULL,'ahmed.baba@etudiant.com','student',NULL,1,NULL,'$2y$10$WktBUcJqwx6pXuurb9QGDuVEwm8Y6Tz2vEBy6LAf2aRnlpG0Z06Ae',NULL,'2025-11-25 01:46:15','2025-11-25 01:46:15','App\\Models\\Etudiant',4),(13,'Sy Mariama',NULL,NULL,'mariama.sy@etudiant.com','student',NULL,1,NULL,'$2y$10$NJCLxglNCLtpYxyX4nary.mF0DvkX46I2e.x7T7W8J1TPmx4wHGA.',NULL,'2025-11-25 01:46:15','2025-11-25 01:46:15','App\\Models\\Etudiant',5),(14,'Ould Mohamed Sidi Mohamed',NULL,NULL,'sidi.mohamed@etudiant.com','student',NULL,1,NULL,'$2y$10$BQZZl50PxVu.NCW07x324u8l2zNRz0kPrZHH78avE8DiSMTrH/iHO',NULL,'2025-11-25 01:46:15','2025-11-25 01:46:15','App\\Models\\Etudiant',6),(15,'Mint Vall Aïcha',NULL,NULL,'aicha.vall@etudiant.com','student',NULL,1,NULL,'$2y$10$cKt48672Y3NY9XpdL1RAlet9edoZlXipSvLqAbGEVGalTFqE0Cv8y',NULL,'2025-11-25 01:46:15','2025-11-25 01:46:15','App\\Models\\Etudiant',7),(16,'Kane Ousmane',NULL,NULL,'ousmane.kane@etudiant.com','student',NULL,1,NULL,'$2y$10$WcDm8iVns0USDAlXVE2mauVNnWsc7QpTniPMQ3aTW6ZbM3H07x9qO',NULL,'2025-11-25 01:46:15','2025-11-25 01:46:15','App\\Models\\Etudiant',8),(17,'Mint Ebnou Khadijetou',NULL,NULL,'khadijetou.ebnou@etudiant.com','student',NULL,1,NULL,'$2y$10$YdSHuAxVtnTmRDR01Itud.QIds.1g9aQMM51IyxplYdMohZsW8tkm',NULL,'2025-11-25 01:46:15','2025-11-25 01:46:15','App\\Models\\Etudiant',9),(18,'Diallo Amadou',NULL,NULL,'amadou.diallo@etudiant.com','student',NULL,1,NULL,'$2y$10$9f715Ar6KCakMjqPeajSDe0r7eCSwxTaB/unQ6QUSPkls8mIwR5AW',NULL,'2025-11-25 01:46:15','2025-11-25 01:46:15','App\\Models\\Etudiant',10),(19,'mo',NULL,NULL,'mo@gmail.com','enseignant',NULL,1,NULL,'$2y$10$.SOAfQl6r.fGHy2Uja5rTOcMG0qICO1PxXVi2F7HJXuP897EDRKtu',NULL,'2025-12-05 11:37:45','2025-12-05 11:37:45','App\\Models\\Enseignant',6);
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

-- Dump completed on 2026-01-21 20:11:11
