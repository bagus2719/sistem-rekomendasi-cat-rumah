-- MySQL dump 10.13  Distrib 8.4.3, for Win64 (x86_64)
--
-- Host: localhost    Database: spk_interior
-- ------------------------------------------------------
-- Server version	8.4.3

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
-- Table structure for table `alternatif`
--

DROP TABLE IF EXISTS `alternatif`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `alternatif` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama_warna` varchar(255) NOT NULL,
  `kode_warna` varchar(255) DEFAULT NULL,
  `gambar_warna` varchar(255) DEFAULT NULL,
  `deskripsi` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alternatif`
--

LOCK TABLES `alternatif` WRITE;
/*!40000 ALTER TABLE `alternatif` DISABLE KEYS */;
INSERT INTO `alternatif` VALUES (1,'A1 Unbleached','A1',NULL,'Warna cat interior Jotun Majestic.','2026-07-03 08:35:36','2026-07-03 08:35:36'),(2,'A2 Soft Radiance','A2',NULL,'Warna cat interior Jotun Majestic.','2026-07-03 08:35:36','2026-07-03 08:35:36'),(3,'A3 Iconic','A3',NULL,'Warna cat interior Jotun Majestic.','2026-07-03 08:35:36','2026-07-03 08:35:36'),(4,'A4 Soft Dunes','A4',NULL,'Warna cat interior Jotun Majestic.','2026-07-03 08:35:36','2026-07-03 08:35:36'),(5,'A5 Green Tea','A5',NULL,'Warna cat interior Jotun Majestic.','2026-07-03 08:35:36','2026-07-03 08:35:36'),(6,'A6 Northern Mystic','A6',NULL,'Warna cat interior Jotun Majestic.','2026-07-03 08:35:36','2026-07-03 08:35:36'),(7,'A7 Pink Ambience','A7',NULL,'Warna cat interior Jotun Majestic.','2026-07-03 08:35:36','2026-07-03 08:35:36'),(8,'A8 Olive','A8',NULL,'Warna cat interior Jotun Majestic.','2026-07-03 08:35:36','2026-07-03 08:35:36');
/*!40000 ALTER TABLE `alternatif` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kriteria`
--

DROP TABLE IF EXISTS `kriteria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kriteria` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kode` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tipe` enum('benefit','cost') NOT NULL,
  `bobot` float NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kriteria_kode_unique` (`kode`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kriteria`
--

LOCK TABLES `kriteria` WRITE;
/*!40000 ALTER TABLE `kriteria` DISABLE KEYS */;
INSERT INTO `kriteria` VALUES (1,'C1','Fungsi Ruangan','benefit',0.440335,'2026-06-30 08:58:42','2026-06-30 08:58:42'),(2,'C2','Luas Ruangan','benefit',0.302271,'2026-06-30 08:58:42','2026-06-30 08:58:42'),(3,'C3','Pencahayaan','benefit',0.174223,'2026-06-30 08:58:42','2026-06-30 08:58:42'),(4,'C4','Nuansa / Mood','benefit',0.0831706,'2026-06-30 08:58:42','2026-06-30 08:58:42');
/*!40000 ALTER TABLE `kriteria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_05_24_181703_create_alternatives_table',1),(5,'2026_05_24_181703_create_criterias_table',1),(6,'2026_05_24_181704_create_alternative_values_table',1),(7,'2026_05_24_181705_create_ahp_comparisons_table',1),(8,'2026_05_24_181706_create_histories_table',1),(9,'2026_05_24_192006_create_sub_kriterias_table',1),(10,'2026_06_25_180301_update_alternatif_table_for_jotun_colors',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nilai_alternatif`
--

DROP TABLE IF EXISTS `nilai_alternatif`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `nilai_alternatif` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `alternatif_id` bigint unsigned NOT NULL,
  `kriteria_id` bigint unsigned NOT NULL,
  `nilai` float NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `nilai_alternatif_alternatif_id_foreign` (`alternatif_id`),
  KEY `nilai_alternatif_kriteria_id_foreign` (`kriteria_id`),
  CONSTRAINT `nilai_alternatif_alternatif_id_foreign` FOREIGN KEY (`alternatif_id`) REFERENCES `alternatif` (`id`) ON DELETE CASCADE,
  CONSTRAINT `nilai_alternatif_kriteria_id_foreign` FOREIGN KEY (`kriteria_id`) REFERENCES `kriteria` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nilai_alternatif`
--

LOCK TABLES `nilai_alternatif` WRITE;
/*!40000 ALTER TABLE `nilai_alternatif` DISABLE KEYS */;
INSERT INTO `nilai_alternatif` VALUES (1,1,1,5,'2026-07-03 08:35:36','2026-07-03 08:35:36'),(2,1,2,5,'2026-07-03 08:35:36','2026-07-03 08:35:36'),(3,1,3,5,'2026-07-03 08:35:36','2026-07-03 08:35:36'),(4,1,4,4,'2026-07-03 08:35:37','2026-07-03 08:35:37'),(5,2,1,5,'2026-07-03 08:35:37','2026-07-03 08:35:37'),(6,2,2,5,'2026-07-03 08:35:37','2026-07-03 08:35:37'),(7,2,3,5,'2026-07-03 08:35:37','2026-07-03 08:35:37'),(8,2,4,5,'2026-07-03 08:35:37','2026-07-03 08:35:37'),(9,3,1,4,'2026-07-03 08:35:37','2026-07-03 08:35:37'),(10,3,2,4,'2026-07-03 08:35:37','2026-07-03 08:35:37'),(11,3,3,4,'2026-07-03 08:35:37','2026-07-03 08:35:37'),(12,3,4,5,'2026-07-03 08:35:37','2026-07-03 08:35:37'),(13,4,1,5,'2026-07-03 08:35:37','2026-07-03 08:35:37'),(14,4,2,4,'2026-07-03 08:35:37','2026-07-03 08:35:37'),(15,4,3,4,'2026-07-03 08:35:37','2026-07-03 08:35:37'),(16,4,4,5,'2026-07-03 08:35:37','2026-07-03 08:35:37'),(17,5,1,4,'2026-07-03 08:35:37','2026-07-03 08:35:37'),(18,5,2,4,'2026-07-03 08:35:37','2026-07-03 08:35:37'),(19,5,3,4,'2026-07-03 08:35:37','2026-07-03 08:35:37'),(20,5,4,5,'2026-07-03 08:35:37','2026-07-03 08:35:37'),(21,6,1,3,'2026-07-03 08:35:37','2026-07-03 08:35:37'),(22,6,2,2,'2026-07-03 08:35:37','2026-07-03 08:35:37'),(23,6,3,2,'2026-07-03 08:35:37','2026-07-03 08:35:37'),(24,6,4,5,'2026-07-03 08:35:37','2026-07-03 08:35:37'),(25,7,1,4,'2026-07-03 08:35:37','2026-07-03 08:35:37'),(26,7,2,4,'2026-07-03 08:35:37','2026-07-03 08:35:37'),(27,7,3,4,'2026-07-03 08:35:37','2026-07-03 08:35:37'),(28,7,4,5,'2026-07-03 08:35:37','2026-07-03 08:35:37'),(29,8,1,4,'2026-07-03 08:35:37','2026-07-03 08:35:37'),(30,8,2,3,'2026-07-03 08:35:37','2026-07-03 08:35:37'),(31,8,3,3,'2026-07-03 08:35:37','2026-07-03 08:35:37'),(32,8,4,5,'2026-07-03 08:35:37','2026-07-03 08:35:37');
/*!40000 ALTER TABLE `nilai_alternatif` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `perbandingan_ahp`
--

DROP TABLE IF EXISTS `perbandingan_ahp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `perbandingan_ahp` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kriteria_1_id` bigint unsigned NOT NULL,
  `kriteria_2_id` bigint unsigned NOT NULL,
  `nilai` float NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `perbandingan_ahp_kriteria_1_id_foreign` (`kriteria_1_id`),
  KEY `perbandingan_ahp_kriteria_2_id_foreign` (`kriteria_2_id`),
  CONSTRAINT `perbandingan_ahp_kriteria_1_id_foreign` FOREIGN KEY (`kriteria_1_id`) REFERENCES `kriteria` (`id`) ON DELETE CASCADE,
  CONSTRAINT `perbandingan_ahp_kriteria_2_id_foreign` FOREIGN KEY (`kriteria_2_id`) REFERENCES `kriteria` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perbandingan_ahp`
--

LOCK TABLES `perbandingan_ahp` WRITE;
/*!40000 ALTER TABLE `perbandingan_ahp` DISABLE KEYS */;
INSERT INTO `perbandingan_ahp` VALUES (1,1,1,1,'2026-06-30 08:58:42','2026-06-30 08:58:42'),(2,1,2,2.24446,'2026-06-30 08:58:42','2026-06-30 08:58:42'),(3,1,3,2.78441,'2026-06-30 08:58:42','2026-06-30 08:58:42'),(4,1,4,3.55116,'2026-06-30 08:58:42','2026-06-30 08:58:42'),(5,2,1,0.445541,'2026-06-30 08:58:42','2026-06-30 08:58:42'),(6,2,2,1,'2026-06-30 08:58:42','2026-06-30 08:58:42'),(7,2,3,2.9722,'2026-06-30 08:58:42','2026-06-30 08:58:42'),(8,2,4,3.66524,'2026-06-30 08:58:42','2026-06-30 08:58:42'),(9,3,1,0.359143,'2026-06-30 08:58:42','2026-06-30 08:58:42'),(10,3,2,0.336452,'2026-06-30 08:58:42','2026-06-30 08:58:42'),(11,3,3,1,'2026-06-30 08:58:42','2026-06-30 08:58:42'),(12,3,4,3.4469,'2026-06-30 08:58:42','2026-06-30 08:58:42'),(13,4,1,0.281598,'2026-06-30 08:58:42','2026-06-30 08:58:42'),(14,4,2,0.272834,'2026-06-30 08:58:42','2026-06-30 08:58:42'),(15,4,3,0.290116,'2026-06-30 08:58:42','2026-06-30 08:58:42'),(16,4,4,1,'2026-06-30 08:58:42','2026-06-30 08:58:42');
/*!40000 ALTER TABLE `perbandingan_ahp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `riwayat`
--

DROP TABLE IF EXISTS `riwayat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `riwayat` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `input_data` json DEFAULT NULL,
  `hasil_rekomendasi` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `riwayat`
--

LOCK TABLES `riwayat` WRITE;
/*!40000 ALTER TABLE `riwayat` DISABLE KEYS */;
INSERT INTO `riwayat` VALUES (1,'{\"c1\": \"5\", \"c2\": \"1\", \"c3\": \"1\", \"c4\": \"2\"}','[{\"nama\": \"Jotun Sea Emerald\", \"score\": 0.5601953929644784}, {\"nama\": \"Jotun Sun\", \"score\": 0.516585660589307}, {\"nama\": \"Jotun Green Harmony\", \"score\": 0.4689419584129181}, {\"nama\": \"Jotun Egg White\", \"score\": 0.26246099216814545}, {\"nama\": \"Jotun Matrix\", \"score\": 0.24472291002002355}]','2026-06-30 10:36:49','2026-06-30 10:36:49'),(2,'{\"c1\": \"4\", \"c2\": \"3\", \"c3\": \"3\", \"c4\": \"2\"}','[{\"nama\": \"Jotun Sea Emerald\", \"score\": 0.6379166364007613}, {\"nama\": \"Jotun Sun\", \"score\": 0.4651358856042115}, {\"nama\": \"Jotun Green Harmony\", \"score\": 0.4297501106669967}, {\"nama\": \"Jotun Egg White\", \"score\": 0.2543236726886913}, {\"nama\": \"Jotun Matrix\", \"score\": 0.21318200437436577}]','2026-06-30 10:44:27','2026-06-30 10:44:27'),(3,'{\"c1\": \"5\", \"c2\": \"1\", \"c3\": \"1\", \"c4\": \"3\"}','[{\"nama\": \"Jotun Sea Emerald\", \"score\": 0.5327304577716828}, {\"nama\": \"Jotun Sun\", \"score\": 0.5152087271697195}, {\"nama\": \"Jotun Green Harmony\", \"score\": 0.4409745925797274}, {\"nama\": \"Jotun Egg White\", \"score\": 0.2613226817883785}, {\"nama\": \"Jotun Matrix\", \"score\": 0.2453223713633464}]','2026-07-01 10:03:26','2026-07-01 10:03:26');
/*!40000 ALTER TABLE `riwayat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text,
  `payload` longtext NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('KJaPBrebZOVbtfCeqbSPwDgjgVc1597JHaOze1QQ',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZzNlSTNkYlVtUk5uaXI5bmNwVHBVdkpDN25aa2QwTHhvUHRzTUxaYSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=',1783093054),('Sk1KZGOiQxMbcYp1EPj7jK977O08fbgUU2k11kZt',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36','YTo1OntzOjY6Il90b2tlbiI7czo0MDoieTl3cVA1WVlrbDIxOEFRVlFLSHlXejJzd0NEV3doZmRrYTY2cnB3TSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9yZWtvbWVuZGFzaSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MzoidXJsIjthOjE6e3M6ODoiaW50ZW5kZWQiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9kYXNoYm9hcmQiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=',1782925439);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sub_kriteria`
--

DROP TABLE IF EXISTS `sub_kriteria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sub_kriteria` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kriteria_id` bigint unsigned NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nilai` float NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sub_kriteria_kriteria_id_foreign` (`kriteria_id`),
  CONSTRAINT `sub_kriteria_kriteria_id_foreign` FOREIGN KEY (`kriteria_id`) REFERENCES `kriteria` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sub_kriteria`
--

LOCK TABLES `sub_kriteria` WRITE;
/*!40000 ALTER TABLE `sub_kriteria` DISABLE KEYS */;
INSERT INTO `sub_kriteria` VALUES (1,1,'Ruang Tamu',5,'2026-06-30 08:58:42','2026-06-30 08:58:42'),(2,1,'Kamar Tidur',4,'2026-06-30 08:58:42','2026-06-30 08:58:42'),(3,1,'Ruang Kerja',3,'2026-06-30 08:58:42','2026-06-30 08:58:42'),(4,1,'Ruang Makan',2,'2026-06-30 08:58:42','2026-06-30 08:58:42'),(5,1,'Kamar Mandi',1,'2026-06-30 08:58:42','2026-06-30 08:58:42'),(6,2,'Sempit (< 9 m²)',1,'2026-06-30 08:58:42','2026-07-03 08:28:14'),(7,2,'Sedang (9 - 16 m²)',3,'2026-06-30 08:58:42','2026-07-03 08:28:14'),(8,2,'Luas (> 16 m²)',5,'2026-06-30 08:58:42','2026-07-03 08:28:14'),(9,3,'Rendah (< 150 lux)',1,'2026-06-30 08:58:42','2026-07-03 08:28:14'),(10,3,'Sedang (150 - 300 lux)',3,'2026-06-30 08:58:42','2026-07-03 08:28:14'),(11,3,'Tinggi (> 300 lux)',5,'2026-06-30 08:58:42','2026-07-03 08:28:14'),(12,4,'Tenang',1,'2026-06-30 08:58:42','2026-06-30 08:58:42'),(13,4,'Hangat',2,'2026-06-30 08:58:42','2026-06-30 08:58:42'),(14,4,'Ceria',3,'2026-06-30 08:58:42','2026-06-30 08:58:42'),(15,4,'Elegan',4,'2026-06-30 08:58:42','2026-06-30 08:58:42'),(16,4,'Modern',5,'2026-06-30 08:58:42','2026-06-30 08:58:42');
/*!40000 ALTER TABLE `sub_kriteria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Administrator','admin@gmail.com','admin',NULL,'$2y$12$U/absHDGtYS79I32KSMHFO0iNmxuzgaWLRR6Se8JD2QUWozy1KjsO',NULL,'2026-06-30 08:58:42','2026-06-30 08:58:42'),(2,'User','user@gmail.com','user',NULL,'$2y$12$rhQDEqqBltVqAv.NQIP77OC6QzXrpWsV0J.qKJRojZyFaiJOvquKa',NULL,'2026-06-30 08:58:42','2026-06-30 08:58:42');
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

-- Dump completed on 2026-07-03 22:50:29
