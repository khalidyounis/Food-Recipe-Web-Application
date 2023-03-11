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
-- Table structure for table `ingredients`
--

DROP TABLE IF EXISTS `ingredients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ingredients` (
  `ingredients_id` int NOT NULL,
  `recipe_id` int NOT NULL,
  `ingredient` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ingredients_id`),
  KEY `recipe_id` (`recipe_id`),
  CONSTRAINT `ingredients_ibfk_1` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`recipe_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ingredients`
--

LOCK TABLES `ingredients` WRITE;
/*!40000 ALTER TABLE `ingredients` DISABLE KEYS */;
INSERT INTO `ingredients` VALUES (1,1,'2 tbsp olive oil or sun-dried tomato oil from the jar'),(2,1,'6 rashers of smoked streaky bacon, chopped'),(3,1,'2 large onions, chopped'),(4,1,'3 garlic cloves, crushed'),(5,1,'1kg/2¼lb lean minced beef'),(6,1,'2 large glasses of red wine'),(7,1,'2x400g cans chopped tomatoes'),(8,1,'1x290g jar antipasti marinated mushrooms, drained'),(9,1,'2 fresh or dried bay leaves'),(10,1,'1 tsp dried oregano or a small handful of fresh leaves, chopped'),(11,1,'1 tsp dried thyme or a small handful of fresh leaves, chopped'),(12,1,'Drizzle balsamic vinegar'),(13,1,'12-14 sun-dried tomato halves, in oil'),(14,1,'Salt and freshly ground black pepper'),(15,1,'A good handful of fresh basil leaves, torn into small pieces'),(16,1,'800g-1kg/1¾-2¼lb dried spaghetti'),(17,1,'Lots of freshly grated parmesan, to serve'),(18,2,'3 tbsp finely grated garlic'),(19,2,'1–2 tsp Kashmiri red chilli powder'),(20,2,'5 tsp ground cumin'),(21,2,'1 tsp ground cardamom seeds'),(22,2,'4 tsp sea salt'),(23,2,'1 lime, juice only'),(24,2,'30g/1oz coriander leaves and stalks, finely chopped'),(25,2,'30g/1oz mint leaves, finely chopped'),(26,2,'3–4 green chillies, finely chopped'),(27,2,'800g/1lb 12oz boneless lamb tenderloin or leg, cut into bite-sized pieces'),(28,2,'4 tbsp double cream'),(29,2,'1½ tbsp full-fat milk'),(30,2,'1 tsp saffron strands (a large pinch)'),(31,2,'400g/14oz basmati rice'),(32,2,'2 tbsp pomegranate seeds, to garnish (optional)'),(33,3,'225g/8oz couscous, prepared according to the packet instructions'),(34,3,'8 small preserved lemons, flesh and rind finely chopped'),(35,3,'180g/6⅓oz dried cranberries'),(36,3,'120g/4⅓oz pine nuts, toasted'),(37,3,'160g/5¾oz unsalted shelled pistachio nuts, roughly chopped'),(38,3,'125ml/4fl oz olive oil'),(39,3,'60g/2¼oz flatleaf parsley, finely chopped'),(40,3,'4 garlic cloves, crushed'),(41,3,'4 tbsp red wine vinegar'),(42,3,'1 red onion, finely chopped'),(43,3,'1 tsp salt, or to taste'),(44,3,'80g/2¾oz rocket leaves'),(45,4,'125ml/4½fl oz milk'),(46,4,'125ml/4½fl oz double cream'),(47,4,'2-3 drops vanilla essence'),(48,4,'4 free-range eggs'),(49,4,'170g/6oz caster sugar'),(50,4,'1 tbsp plain flour'),(51,4,'30g/1oz butter'),(52,4,'500g/1lb 2oz plums, cut in half, stones removed'),(53,4,'2 tbsp brown sugar'),(54,4,'30g/1oz flaked almonds (optional)'),(55,4,'icing sugar, for dusting'),(56,4,'double cream, to serve'),(57,5,'For the biscuit base'),(58,5,'280g/10oz digestive biscuits'),(59,5,'65g/2¼oz granulated sugar'),(60,5,'¼ tsp ground cardamom'),(61,5,'128g/4½oz unsalted butter, melted'),(62,5,'large pinch sea salt'),(63,5,'For the mango custard filling'),(64,5,'100g/3½ oz granulated sugar'),(65,5,'2 tbsp plus ¼ tsp powdered gelatine'),(66,5,'120ml/4fl oz double cream'),(67,5,'115g/4 oz cream cheese, at room temperature'),(68,5,'850g tin Alfonso mango pulp'),(69,5,'large pinch sea salt');
/*!40000 ALTER TABLE `ingredients` ENABLE KEYS */;
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
