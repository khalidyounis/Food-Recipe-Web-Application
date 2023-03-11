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
-- Table structure for table `method`
--

DROP TABLE IF EXISTS `method`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `method` (
  `method_id` int NOT NULL AUTO_INCREMENT,
  `recipe_id` int NOT NULL,
  `step` int NOT NULL,
  `description` varchar(500) NOT NULL,
  PRIMARY KEY (`method_id`),
  KEY `recipe_id` (`recipe_id`),
  CONSTRAINT `method_ibfk_1` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`recipe_id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `method`
--

LOCK TABLES `method` WRITE;
/*!40000 ALTER TABLE `method` DISABLE KEYS */;
INSERT INTO `method` VALUES (1,1,1,'Heat the oil in a large, heavy-based saucepan and fry the bacon until golden over a medium heat. Add the onions and garlic, frying until softened. Increase the heat and add the minced beef. Fry it until it has browned, breaking down any chunks of meat with a wooden spoon. Pour in the wine and boil until it has reduced in volume by about a third. Reduce the temperature and stir in the tomatoes, drained mushrooms, bay leaves, oregano, thyme and balsamic vinegar.'),(2,1,2,'Either blitz the sun-dried tomatoes in a small blender with a little of the oil to loosen, or just finely chop before adding to the pan. Season well with salt and pepper. Cover with a lid and simmer the Bolognese sauce over a gentle heat for 1-1Â½ hours until it\'s rich and thickened, stirring occasionally. At the end of the cooking time, stir in the basil and add any extra seasoning if necessary.'),(3,1,3,'Remove from the heat to \'settle\' while you cook the spaghetti in plenty of boiling salted water (for the time stated on the packet). Drain and divide between warmed plates. Scatter a little parmesan over the spaghetti before adding a good ladleful of the Bolognese sauce, finishing with a scattering of more cheese and a twist of black pepper.'),(4,2,1,'Heat the oil in a non-stick frying pan over a medium heat. Add the onions and stir-fry for 15â€“18 minutes, or until lightly browned and crispy.'),(5,2,2,'Put half the onions in a non-metallic mixing bowl with the yoghurt, ginger, garlic, chilli powder, cumin, cardamom, half of the salt, the lime juice, half of the chopped coriander and mint and the green chillies. Stir well to combine. Set aside the remaining coriander and mint for layering the biryani.'),(6,2,3,'Add the lamb to the mixture and stir to coat evenly. Cover and marinade in the fridge for 6â€“8 hours, or overnight if possible.'),(7,2,4,'Preheat the oven to 240C/Fan 220C/Gas 9'),(8,2,5,'Heat the cream and milk in a small saucepan, add the saffron, remove from the heat and leave to infuse for 30 minutes.'),(9,2,6,'Cook the rice in a large saucepan in plenty of boiling water with the remaining salt for 6â€“8 minutes, or until it is just cooked, but still has a bite. Drain the rice.'),(10,2,7,'Spread half of the lamb mixture evenly in a wide, heavy-based casserole and cover with a layer of half the rice. Sprinkle over half of the reserved onions and half of the reserved coriander and mint. Sprinkle over half of the saffron mixture. Repeat with the remaining lamb, rice, onions, herbs and saffron mixture.'),(11,2,8,'Cover with a tight fitting lid, turn down the oven to 200C/Fan 180C/Gas 6 and cook for 1 hour. Remove and allow to stand for 15â€“20 minutes before serving. Garnish with pomegranate seeds if desired.'),(12,3,1,'In a large bowl mix all the ingredients together except the rocket, then taste and adjust the seasoning, adding more salt if necessary. Toss in the rocket and serve immediately.'),(13,4,1,'Preheat the oven to 180C/350F/Gas 4.'),(14,4,2,'Pour the milk, cream and vanilla into a pan and boil for a minute. Remove from the heat and set aside to cool.'),(15,4,3,'Tip the eggs and sugar into a bowl and beat together until light and fluffy. Fold the flour into the mixture, a little at a time.'),(16,4,4,'Pour the cooled milk and cream onto the egg and sugar mixture, whisking lightly. Set aside.'),(17,4,5,'Place a little butter into an ovenproof dish and heat in the oven until foaming. Add the plums and brown sugar and bake for 5 minutes, then pour the batter into the dish and scatter with flaked almonds, if using'),(18,4,6,'Cook in the oven for about 30 minutes, until golden-brown and set but still light and soft inside.'),(19,4,7,'Dust with icing sugar and serve immediately with cream.'),(20,5,1,'To make the biscuit base, finely crush the biscuits by putting into a sealed plastic bag and bashing with a rolling pin (alternatively, pulse to crumbs using a food processor). Transfer to a mixing bowl and add the sugar, cardamom and salt, stirring well to combine.'),(21,5,2,'Pour the melted butter over the biscuit crumbs and mix, until thoroughly combined. Put half the crumb mixture in a 23cm/9in metal pie tin, and press evenly with your fingers. Build up the sides of the tin, compressing the base as much as possible to prevent it crumbling. Repeat with the rest of the mixture in the second tin'),(22,5,3,'Preheat the oven to 160C/325F/Gas 3. Put the pie bases in the freezer for 15 minutes. Remove and bake for 12 minutes, or until golden brown. Transfer to a wire rack to cool'),(23,5,4,'To make the filling, pour 177ml/6fl oz of cold water into a large bowl. In a separate bowl, mix the gelatine with half the sugar and sprinkle over the water. Leave to stand for a couple of minutes.'),(24,5,5,'Meanwhile, whip the cream with the remaining sugar to form medium stiff peaks. Set aside.'),(25,5,6,'Heat about a quarter of the mango pulp in a saucepan over a medium-low heat, until just warm. Make sure you do not boil it. Pour into the gelatine mixture and whisk, until well combined. The gelatine should dissolve completely. Gradually whisk in the remaining mango pulp.'),(26,5,7,'Beat the cream cheese in a bowl, until soft and smooth. Add to the mango mixture with the salt. Blend the mixture using a hand blender, until completely smooth. Gently tap the bowl on the kitchen counter once or twice to pop any air bubbles.'),(27,5,8,'Fold about a quarter of the mango mixture into the whipped cream using a spatula. Repeat with the rest of the cream, until no streaks remain.'),(28,5,9,'Divide the filling between the cooled bases, using a rubber spatula to smooth out the filling. Refrigerate overnight, or for at least 5 hours, until firm and chilled.');
/*!40000 ALTER TABLE `method` ENABLE KEYS */;
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
