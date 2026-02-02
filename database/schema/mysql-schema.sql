/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
DROP TABLE IF EXISTS `activity_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `activity_log` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `log_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject_id` bigint unsigned DEFAULT NULL,
  `causer_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `causer_id` bigint unsigned DEFAULT NULL,
  `properties` json DEFAULT NULL,
  `batch_uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subject` (`subject_type`,`subject_id`),
  KEY `causer` (`causer_type`,`causer_id`),
  KEY `activity_log_log_name_index` (`log_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `administrateurs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `administrateurs` (
  `id_administrateur` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adresse` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_administrateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
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
  KEY `enseignant_matiere_classe_id_enseignant_index` (`id_enseignant`),
  KEY `enseignant_matiere_classe_id_matiere_index` (`id_matiere`),
  KEY `enseignant_matiere_classe_id_classe_index` (`id_classe`),
  KEY `enseignant_matiere_classe_active_index` (`active`),
  CONSTRAINT `enseignant_matiere_classe_id_classe_foreign` FOREIGN KEY (`id_classe`) REFERENCES `classes` (`id_classe`) ON DELETE CASCADE,
  CONSTRAINT `enseignant_matiere_classe_id_enseignant_foreign` FOREIGN KEY (`id_enseignant`) REFERENCES `enseignants` (`id_enseignant`) ON DELETE CASCADE,
  CONSTRAINT `enseignant_matiere_classe_id_matiere_foreign` FOREIGN KEY (`id_matiere`) REFERENCES `matieres` (`id_matiere`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `enseignants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `enseignants` (
  `id_enseignant` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adresse` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_enseignant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
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
DROP TABLE IF EXISTS `etudiants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `etudiants` (
  `id_etudiant` bigint unsigned NOT NULL AUTO_INCREMENT,
  `matricule` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_naissance` date NOT NULL,
  `genre` enum('M','F') COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_classe` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_etudiant`),
  UNIQUE KEY `etudiants_matricule_unique` (`matricule`),
  KEY `etudiants_id_classe_index` (`id_classe`),
  KEY `etudiants_matricule_index` (`matricule`),
  CONSTRAINT `etudiants_id_classe_foreign` FOREIGN KEY (`id_classe`) REFERENCES `classes` (`id_classe`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
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
  `type` enum('devoir','examen','controle','interrogation','projet') COLLATE utf8mb4_unicode_ci NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `model_has_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
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
DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
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
DROP TABLE IF EXISTS `role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telephone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci,
  `two_factor_enabled` tinyint(1) NOT NULL DEFAULT '0',
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `profile_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_id` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_profile_unique` (`profile_type`,`profile_id`),
  KEY `users_profile_type_profile_id_index` (`profile_type`,`profile_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (1,'2014_10_12_000000_create_users_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (2,'2014_10_12_100000_create_password_reset_tokens_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (3,'2014_10_12_100000_create_password_resets_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (4,'2014_10_12_200000_add_two_factor_columns_to_users_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (5,'2019_08_19_000000_create_failed_jobs_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (6,'2019_12_14_000001_create_personal_access_tokens_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (7,'2023_07_25_192911_create_classes_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (8,'2023_07_25_192912_create_administrateurs_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (9,'2023_07_25_192912_create_enseignants_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (10,'2023_07_25_192912_create_etudiants_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (11,'2023_07_25_192913_create_cours_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (12,'2023_07_25_192914_create_evaluations_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (13,'2023_07_25_192915_create_etudepaiements_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (14,'2023_07_25_192915_create_notes_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (15,'2023_07_25_192916_create_enseignpaiements_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (16,'2025_09_14_125323_create_clean_auth_system',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (17,'2025_09_15_133352_add_note_max_to_evaluations_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (18,'2025_09_15_142536_create_matieres_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (19,'2025_09_15_142607_create_enseignant_matiere_classe_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (20,'2025_09_15_143446_update_evaluations_table_for_matieres',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (21,'2025_09_15_154536_update_cours_table_for_matieres',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (22,'2025_09_15_154725_update_notes_table_for_matieres',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (23,'2025_09_15_154850_update_enseignpaiements_table_for_users',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (24,'2025_09_15_235842_add_unique_constraint_to_notes_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (25,'2025_09_23_204852_remove_redundant_columns_from_users_and_enseignants_tables',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (26,'2025_09_23_205110_fix_enseignant_matiere_classe_user_to_enseignant_id',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (27,'2025_09_24_120000_fix_evaluations_table_relationships',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (28,'2025_10_02_152321_update_evaluations_table_structure',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (29,'2025_11_24_200124_create_admin_allowed_ips_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (30,'2025_11_24_201331_add_remember_token_to_administrateurs_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (31,'2025_11_25_005820_add_role_to_administrateurs_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (32,'2025_11_25_115034_fix_null_created_at_in_admin_allowed_ips_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (33,'2025_11_25_210000_add_two_factor_to_administrateurs_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (34,'2025_11_25_220000_add_auth_fields_to_enseignants',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (35,'2025_12_05_103331_rename_mot_de_passe_to_password_in_users_tables',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (36,'2025_12_05_110453_unify_users_table_and_migrate_data',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (37,'2025_12_05_130000_cleanup_legacy_auth_columns',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (38,'2026_01_21_191532_create_permission_tables',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (39,'2026_01_21_191611_create_activity_log_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (40,'2026_01_21_191612_add_event_column_to_activity_log_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (41,'2026_01_21_191613_add_batch_uuid_column_to_activity_log_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (42,'2026_01_21_200142_create_sessions_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (43,'2026_01_21_220636_finalize_users_unification',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (44,'2026_01_22_180000_update_evaluations_type_enum',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (45,'2026_01_22_184000_make_users_name_nullable',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (46,'2026_01_22_184100_make_users_email_telephone_nullable',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (47,'2026_01_22_184200_make_users_password_nullable',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (48,'2026_01_22_190000_add_identity_fields_to_profiles',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (49,'2026_01_22_190100_migrate_identity_data_from_users_to_profiles',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (50,'2026_01_22_190200_make_profile_identity_fields_required',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (51,'2026_01_22_190300_add_unique_index_on_users_profile',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (52,'2026_01_22_200000_make_adresse_nullable',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (53,'2026_01_22_202603_drop_nom_prenom_from_users_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (55,'2026_01_22_210000_drop_role_column_from_users',2);
