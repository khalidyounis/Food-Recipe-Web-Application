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
-- Table structure for table `recipes`
--

DROP TABLE IF EXISTS `recipes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `recipes` (
  `recipe_id` int NOT NULL,
  `recipe_name` varchar(100) NOT NULL,
  `recipe_description` mediumtext,
  `recipe_type` varchar(45) NOT NULL,
  `preparation_time` varchar(45) NOT NULL,
  `cooking_time` varchar(45) NOT NULL,
  `serving` varchar(45) NOT NULL,
  `author` varchar(45) DEFAULT NULL,
  `image_path` longtext,
  `image_credits` mediumtext,
  PRIMARY KEY (`recipe_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recipes`
--

LOCK TABLES `recipes` WRITE;
/*!40000 ALTER TABLE `recipes` DISABLE KEYS */;
INSERT INTO `recipes` VALUES (1,'Spaghetti Bolognese','Once you’ve got this grown-up spag bol going the hob will do the rest. Any leftovers will taste even better the next day','main','30 mins','2 hours','6','Jo Pratt','spaghetti_polognese_large.webp','BBC Food'),(2,'Lamb Biryani','This lamb biryani is real centrepiece dish, but it\'s actually easy as anything to make. \nServe garnished with pomegranate seeds to make it look really special','main','overnight','2 hours','6','Sunil Vijayakar','lamb_biryani_large.webp','BBC Food'),(3,'Couscous Salad','A nutritious and satisfying vegan couscous salad packed with colour, flavour and texture, from dried cranberries, pistachios and pine nuts','starter','30 mins','10 mins','6','Nargisse Benkabbou','couscous_salad_large.webp','BBC Food'),(4,'Plum Clafoutis','Halved plums are covered in a light batter and then baked in the oven to make this traditional French dessert. \nBritish plums are at their best in September, so make the most of them then and try this simple pud','dessert','30 mins','1 hr','4','Samin Nosrat','plum_clafoutis_large.webp','BBC Food'),(5,'Mango Pie','This mouthwatering mango dessert is an Indian take on a traditional Thanksgiving pie','dessert','1 hr','1 hr','16','James Martin','mango_pie_large.webp','BBC Food');
/*!40000 ALTER TABLE `recipes` ENABLE KEYS */;
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
