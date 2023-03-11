-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: localhost    Database: easy_recipes
-- ------------------------------------------------------
-- Server version	8.0.30

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
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `display_name` varchar(45) NOT NULL,
  `user_type` varchar(5) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` mediumtext NOT NULL,
  `user_status` int NOT NULL,
  `system_date` varchar(45) NOT NULL,
  `system_time` varchar(45) NOT NULL,
  `update_date` varchar(45) DEFAULT NULL,
  `update_time` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Is-Haka Mkwawa','user','ishaka@easyrecipes.com','$2y$10$BCq99VValM0ySxRO6T/29ewKKssfJsyHNTHpj8KsVs4OZ98HwSsyS',1,'10/09/2022','19:16:42','',''),(2,'Shelley Allsopp','user','shelley@easyrecipes.com','$2y$10$HOGHgM4r8WTXN13Hw45eoOvF3SaH2WDrybXGPMS.Hqpo74uTdjoKC',1,'10/09/2022','19:36:30','',''),(3,'Cheylea Hopkinson','user','cheyleya@easyrecipes.com','$2y$10$3vvjac3oTQP4nWhSKoro..n4aeNch1aXfuLGF80xKDXjKHFW.zJyC',1,'10/09/2022','19:38:38','',''),(4,'Ghafer Khan','user','ghafer@easyrecipes.com','$2y$10$2cVMaI1gwGtrbi7..fUuc.M4TMWHXgZovHPsn.QtVEvj6q5zsbbJa',1,'10/09/2022','19:40:09','',''),(5,'Khalid Younis','user','khalid@easyrecipes.com','$2y$10$cgjy0RtS/f0h6jOVGu6TdepsMtFY6Gu4ajrJt1hMprf1sWsDvdKL6',1,'10/09/2022','19:41:05','','');
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

-- Dump completed on 2022-10-09 21:41:36
