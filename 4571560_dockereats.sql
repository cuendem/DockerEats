-- MySQL dump 10.16  Distrib 10.1.48-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: fdb1029.awardspace.net    Database: 4571560_dockereats
-- ------------------------------------------------------
-- Server version	8.0.32

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `ALLERGENS`
--

DROP TABLE IF EXISTS `ALLERGENS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ALLERGENS` (
  `id_allergen` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_allergen`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ALLERGENS`
--

LOCK TABLES `ALLERGENS` WRITE;
/*!40000 ALTER TABLE `ALLERGENS` DISABLE KEYS */;
INSERT INTO `ALLERGENS` VALUES (1,'Gluten'),(2,'Crustaceans'),(3,'Eggs'),(4,'Fish'),(5,'Peanuts'),(6,'Soy'),(7,'Milk'),(8,'Nuts'),(9,'Celery'),(10,'Mustard'),(11,'Sesame'),(12,'Sulphites'),(13,'Lupin'),(14,'Molluscs');
/*!40000 ALTER TABLE `ALLERGENS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ALLERGENS_PRODUCTS`
--

DROP TABLE IF EXISTS `ALLERGENS_PRODUCTS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ALLERGENS_PRODUCTS` (
  `id_product` int NOT NULL,
  `id_allergen` int NOT NULL,
  PRIMARY KEY (`id_product`,`id_allergen`),
  KEY `fkallergen_idx` (`id_allergen`),
  KEY `fkproduct_idx` (`id_product`),
  CONSTRAINT `fkallergen` FOREIGN KEY (`id_allergen`) REFERENCES `ALLERGENS` (`id_allergen`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fkproduct` FOREIGN KEY (`id_product`) REFERENCES `PRODUCTS` (`id_product`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ALLERGENS_PRODUCTS`
--

LOCK TABLES `ALLERGENS_PRODUCTS` WRITE;
/*!40000 ALTER TABLE `ALLERGENS_PRODUCTS` DISABLE KEYS */;
INSERT INTO `ALLERGENS_PRODUCTS` VALUES (1,1),(2,1),(3,1),(5,1),(6,1),(7,1),(8,1),(9,1),(12,1),(20,1),(33,1),(35,1),(37,1),(38,1),(40,1),(46,1),(47,1),(48,1),(50,1),(54,1),(62,1),(63,1),(65,1),(63,2),(66,2),(1,3),(3,3),(4,3),(7,3),(9,3),(14,3),(31,3),(33,3),(34,3),(37,3),(38,3),(40,3),(46,3),(47,3),(50,3),(63,3),(4,4),(5,4),(10,4),(46,4),(48,4),(54,4),(63,4),(66,4),(63,5),(10,6),(11,6),(18,6),(54,6),(63,6),(1,7),(2,7),(3,7),(4,7),(6,7),(7,7),(8,7),(12,7),(15,7),(17,7),(19,7),(20,7),(31,7),(32,7),(33,7),(34,7),(35,7),(37,7),(38,7),(39,7),(40,7),(46,7),(47,7),(48,7),(50,7),(51,7),(53,7),(62,7),(63,7),(2,8),(32,8),(34,8),(37,8),(40,8),(63,8),(1,9),(3,9),(13,9),(16,9),(49,9),(55,9),(63,9),(1,10),(3,10),(9,10),(14,10),(50,10),(63,10),(1,11),(61,11),(63,11),(43,12),(44,12),(52,12),(53,12),(63,12),(53,13),(63,13),(63,14),(66,14);
/*!40000 ALTER TABLE `ALLERGENS_PRODUCTS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `CATEGORIES`
--

DROP TABLE IF EXISTS `CATEGORIES`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CATEGORIES` (
  `id_category` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_category`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CATEGORIES`
--

LOCK TABLES `CATEGORIES` WRITE;
/*!40000 ALTER TABLE `CATEGORIES` DISABLE KEYS */;
INSERT INTO `CATEGORIES` VALUES (1,'Healthy'),(2,'Meat'),(3,'Fish'),(4,'American'),(5,'Asian'),(6,'Italian'),(7,'Mexican'),(8,'Vegan'),(9,'Exotic'),(10,'Alcoholic'),(11,'French'),(12,'Comfort');
/*!40000 ALTER TABLE `CATEGORIES` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `CATEGORIES_PRODUCTS`
--

DROP TABLE IF EXISTS `CATEGORIES_PRODUCTS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CATEGORIES_PRODUCTS` (
  `id_category` int NOT NULL,
  `id_product` int NOT NULL,
  PRIMARY KEY (`id_category`,`id_product`),
  KEY `id_product` (`id_product`),
  CONSTRAINT `CATEGORIES_PRODUCTS_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `CATEGORIES` (`id_category`) ON DELETE CASCADE,
  CONSTRAINT `CATEGORIES_PRODUCTS_ibfk_2` FOREIGN KEY (`id_product`) REFERENCES `PRODUCTS` (`id_product`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CATEGORIES_PRODUCTS`
--

LOCK TABLES `CATEGORIES_PRODUCTS` WRITE;
/*!40000 ALTER TABLE `CATEGORIES_PRODUCTS` DISABLE KEYS */;
INSERT INTO `CATEGORIES_PRODUCTS` VALUES (2,1),(4,1),(4,2),(6,2),(1,3),(2,3),(4,3),(1,4),(2,4),(6,4),(3,5),(4,6),(2,7),(7,7),(2,8),(6,8),(2,9),(4,9),(3,10),(5,10),(9,10),(4,11),(8,11),(4,12),(6,12),(1,13),(8,13),(1,14),(4,14),(4,15),(1,16),(8,16),(9,16),(2,17),(4,17),(4,18),(1,19),(8,19),(2,20),(7,20),(1,21),(8,21),(4,22),(9,22),(4,23),(12,23),(4,24),(6,25),(9,25),(1,26),(5,26),(8,26),(1,27),(8,27),(1,28),(8,28),(4,29),(1,30),(8,30),(7,31),(4,32),(6,32),(4,33),(4,34),(4,35),(1,36),(8,36),(4,37),(11,37),(7,38),(11,38),(9,39),(11,40),(7,41),(9,41),(10,41),(9,42),(10,42),(8,43),(10,43),(6,44),(10,44),(11,44),(4,45),(9,45),(10,45),(12,45),(2,46),(5,46),(9,46),(2,47),(4,47),(1,48),(3,48),(1,49),(8,49),(11,49),(2,50),(9,50),(12,51),(12,52),(1,53),(9,53),(12,53),(2,54),(5,54),(9,54),(12,54),(1,55),(2,55),(12,55),(5,61),(9,61),(4,62),(12,62),(9,63),(10,63),(5,65),(12,65),(1,66),(3,66);
/*!40000 ALTER TABLE `CATEGORIES_PRODUCTS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `CONTAINERS`
--

DROP TABLE IF EXISTS `CONTAINERS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CONTAINERS` (
  `id_container` int NOT NULL AUTO_INCREMENT,
  `id_order` int NOT NULL,
  PRIMARY KEY (`id_container`),
  KEY `fk_CONTAINERS_ORDERS1_idx` (`id_order`),
  CONSTRAINT `fk_CONTAINERS_ORDERS1` FOREIGN KEY (`id_order`) REFERENCES `ORDERS` (`id_order`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CONTAINERS`
--

LOCK TABLES `CONTAINERS` WRITE;
/*!40000 ALTER TABLE `CONTAINERS` DISABLE KEYS */;
INSERT INTO `CONTAINERS` VALUES (4,2),(5,2),(10,5),(13,8),(14,8),(15,8),(16,9),(17,9),(18,10),(19,10),(20,10),(21,10),(22,10),(23,11),(24,11),(25,11),(31,13),(32,13),(33,13),(34,14),(35,14),(36,14),(37,14),(38,15),(39,16),(40,16),(41,17),(42,18),(43,18),(44,18),(45,18),(46,19),(47,20),(48,20),(49,21),(50,22),(52,24),(53,25),(54,26),(55,27),(56,28),(57,29),(58,29);
/*!40000 ALTER TABLE `CONTAINERS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `CONTAINER_PARTS`
--

DROP TABLE IF EXISTS `CONTAINER_PARTS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CONTAINER_PARTS` (
  `id_part` int NOT NULL AUTO_INCREMENT,
  `id_container` int NOT NULL,
  `id_product` int NOT NULL,
  PRIMARY KEY (`id_part`),
  KEY `fk_CONTAINER_PARTS_CONTAINERS1_idx` (`id_container`),
  KEY `fk_CONTAINER_PARTS_PRODUCTS1_idx` (`id_product`),
  CONSTRAINT `fk_CONTAINER_PARTS_CONTAINERS1` FOREIGN KEY (`id_container`) REFERENCES `CONTAINERS` (`id_container`) ON DELETE CASCADE,
  CONSTRAINT `fk_CONTAINER_PARTS_PRODUCTS1` FOREIGN KEY (`id_product`) REFERENCES `PRODUCTS` (`id_product`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=230 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CONTAINER_PARTS`
--

LOCK TABLES `CONTAINER_PARTS` WRITE;
/*!40000 ALTER TABLE `CONTAINER_PARTS` DISABLE KEYS */;
INSERT INTO `CONTAINER_PARTS` VALUES (13,4,48),(14,4,15),(15,4,23),(16,4,31),(17,5,5),(18,5,20),(19,5,26),(20,5,34),(37,10,47),(38,10,20),(39,10,26),(40,10,62),(49,13,5),(50,13,61),(51,13,24),(52,13,36),(53,14,2),(54,14,13),(55,14,21),(56,14,34),(57,15,9),(58,15,20),(59,15,30),(60,15,31),(61,16,9),(62,16,20),(63,16,23),(64,16,32),(65,17,1),(66,17,14),(67,17,42),(68,17,31),(69,18,48),(70,18,61),(71,18,26),(72,18,32),(73,19,55),(74,19,17),(75,19,30),(76,19,33),(77,20,48),(78,20,16),(79,20,43),(80,20,32),(81,21,47),(82,21,14),(83,21,29),(84,21,31),(85,22,1),(86,22,11),(87,22,22),(88,22,35),(89,23,4),(90,23,20),(91,23,30),(92,23,32),(93,24,7),(94,24,16),(95,24,42),(96,24,32),(97,25,54),(98,25,14),(99,25,22),(100,25,62),(121,31,7),(122,31,12),(123,31,45),(124,31,39),(125,32,1),(126,32,19),(127,32,24),(128,32,33),(129,33,5),(130,33,11),(131,33,21),(132,33,62),(133,34,54),(134,34,61),(135,34,26),(136,34,39),(137,35,47),(138,35,17),(139,35,30),(140,35,38),(141,36,1),(142,36,17),(143,36,23),(144,36,39),(145,37,6),(146,37,14),(147,37,23),(148,37,36),(149,38,10),(150,38,14),(151,38,28),(152,38,32),(153,39,4),(154,39,11),(155,39,23),(156,39,33),(157,40,4),(158,40,20),(159,40,25),(160,40,40),(161,41,1),(162,41,17),(163,41,27),(164,41,36),(165,42,9),(166,42,20),(167,42,43),(168,42,31),(169,43,9),(170,43,17),(171,43,21),(172,43,38),(173,44,10),(174,44,11),(175,44,45),(176,44,33),(177,45,7),(178,45,11),(179,45,29),(180,45,38),(181,46,2),(182,46,15),(183,46,28),(184,46,32),(185,47,47),(186,47,12),(187,47,28),(188,47,32),(189,48,3),(190,48,61),(191,48,41),(192,48,40),(193,49,46),(194,49,14),(195,49,44),(196,49,62),(197,50,50),(198,50,13),(199,50,29),(200,50,62),(202,52,45),(203,52,54),(204,52,11),(205,52,62),(206,53,46),(207,53,14),(208,53,52),(209,53,37),(210,54,1),(211,54,45),(212,54,35),(213,54,17),(214,55,1),(215,55,17),(216,55,45),(217,55,35),(218,56,38),(219,56,53),(220,56,2),(221,56,11),(222,57,34),(223,57,2),(224,57,15),(225,57,24),(226,58,55),(227,58,18),(228,58,52),(229,58,35);
/*!40000 ALTER TABLE `CONTAINER_PARTS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `COUNTRIES`
--

DROP TABLE IF EXISTS `COUNTRIES`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `COUNTRIES` (
  `iso_code` varchar(3) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`iso_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `COUNTRIES`
--

LOCK TABLES `COUNTRIES` WRITE;
/*!40000 ALTER TABLE `COUNTRIES` DISABLE KEYS */;
INSERT INTO `COUNTRIES` VALUES ('CH','Switzerland'),('CN','China'),('CZ','Czechia'),('DE','Germany'),('ES','Spain'),('FR','France'),('GB','United Kingdom'),('GR','Greece'),('IT','Italy'),('JP','Japan'),('KR','South Korea'),('RU','Russia'),('US','United States');
/*!40000 ALTER TABLE `COUNTRIES` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `COUPONS`
--

DROP TABLE IF EXISTS `COUPONS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `COUPONS` (
  `id_coupon` int NOT NULL AUTO_INCREMENT,
  `code` varchar(15) NOT NULL,
  `discount` int NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date DEFAULT NULL,
  `discount_type` int NOT NULL,
  PRIMARY KEY (`id_coupon`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `COUPONS`
--

LOCK TABLES `COUPONS` WRITE;
/*!40000 ALTER TABLE `COUPONS` DISABLE KEYS */;
INSERT INTO `COUPONS` VALUES (1,'TENOFF',10,'2024-12-09','2024-12-22',1),(2,'JERMA985',15,'2024-12-09',NULL,2),(4,'ACTUALLYFREE',100,'2024-12-27','2025-01-03',2),(6,'HALFOFF',50,'2025-01-02','2025-02-02',2),(7,'DEVYAT',3,'2025-01-02',NULL,1),(8,'FIVE',5,'2025-01-04','2025-01-11',2);
/*!40000 ALTER TABLE `COUPONS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `COUPONS_ORDERS`
--

DROP TABLE IF EXISTS `COUPONS_ORDERS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `COUPONS_ORDERS` (
  `id_coupon` int NOT NULL,
  `id_order` int NOT NULL,
  PRIMARY KEY (`id_coupon`,`id_order`),
  KEY `fk_COUPONS_has_ORDERS_ORDERS1_idx` (`id_order`),
  KEY `fk_COUPONS_has_ORDERS_COUPONS1_idx` (`id_coupon`),
  CONSTRAINT `fk_COUPONS_has_ORDERS_COUPONS1` FOREIGN KEY (`id_coupon`) REFERENCES `COUPONS` (`id_coupon`) ON DELETE CASCADE,
  CONSTRAINT `fk_COUPONS_has_ORDERS_ORDERS1` FOREIGN KEY (`id_order`) REFERENCES `ORDERS` (`id_order`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `COUPONS_ORDERS`
--

LOCK TABLES `COUPONS_ORDERS` WRITE;
/*!40000 ALTER TABLE `COUPONS_ORDERS` DISABLE KEYS */;
INSERT INTO `COUPONS_ORDERS` VALUES (1,2),(2,2),(1,5),(2,5),(2,8),(2,13),(6,14),(4,16),(7,17),(8,24),(7,27),(8,27);
/*!40000 ALTER TABLE `COUPONS_ORDERS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ESTABLISHMENTS`
--

DROP TABLE IF EXISTS `ESTABLISHMENTS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ESTABLISHMENTS` (
  `id_establishment` int NOT NULL AUTO_INCREMENT,
  `iso_code` varchar(3) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `address` varchar(100) NOT NULL,
  PRIMARY KEY (`id_establishment`),
  KEY `fk_ESTABLISHMENT_COUNTRY_idx` (`iso_code`),
  CONSTRAINT `fk_ESTABLISHMENT_COUNTRY` FOREIGN KEY (`iso_code`) REFERENCES `COUNTRIES` (`iso_code`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ESTABLISHMENTS`
--

LOCK TABLES `ESTABLISHMENTS` WRITE;
/*!40000 ALTER TABLE `ESTABLISHMENTS` DISABLE KEYS */;
INSERT INTO `ESTABLISHMENTS` VALUES (1,'KR','Hana','1 Gwangdeok-ro, Gongju, South Korea'),(2,'DE','Zwei','45 Großenhainer Straße, Frankfurt, Germany'),(3,'ES','Tres','12 Calle Cervantes, Alcalá de Henares, Spain'),(4,'JP','Shi','7-15 Kuromon, Ikebukuro, Tokyo, Japan'),(5,'FR','Cinq','13 Rue de la Liberté, Mondovi, France'),(6,'CN','Liu','10 Wangfujing Street, Beijing, China'),(7,'GB','Seven','73 Market Street, Thornton, England'),(8,'US','Eight','8 Main Street, New Bedford, Massachusetts, USA'),(9,'RU','Devyat\'','22 Dostoevsky Street, Moscow, Russia'),(10,'IT','Dieci','12 Via Dante, Florence, Italy'),(11,'CH','Öufi','13 Hesse Strasse, Calw, Switzerland'),(12,'GR','Dódeka','1 Main Road, Ios, Greece'),(13,'CZ','Třináct','5 Kafka Street, Prague, Czechia');
/*!40000 ALTER TABLE `ESTABLISHMENTS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `EXTRAS`
--

DROP TABLE IF EXISTS `EXTRAS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `EXTRAS` (
  `id_extra` int NOT NULL,
  `id_product` int NOT NULL,
  `name` varchar(45) NOT NULL,
  `price` decimal(5,2) NOT NULL,
  PRIMARY KEY (`id_extra`),
  KEY `fkproduct_idx` (`id_product`),
  CONSTRAINT `fk_extra_product` FOREIGN KEY (`id_product`) REFERENCES `PRODUCTS` (`id_product`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `EXTRAS`
--

LOCK TABLES `EXTRAS` WRITE;
/*!40000 ALTER TABLE `EXTRAS` DISABLE KEYS */;
/*!40000 ALTER TABLE `EXTRAS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `INGREDIENTS`
--

DROP TABLE IF EXISTS `INGREDIENTS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `INGREDIENTS` (
  `id_ingredient` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `price` decimal(5,2) NOT NULL,
  PRIMARY KEY (`id_ingredient`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `INGREDIENTS`
--

LOCK TABLES `INGREDIENTS` WRITE;
/*!40000 ALTER TABLE `INGREDIENTS` DISABLE KEYS */;
/*!40000 ALTER TABLE `INGREDIENTS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `INGREDIENTS_ALLERGENS`
--

DROP TABLE IF EXISTS `INGREDIENTS_ALLERGENS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `INGREDIENTS_ALLERGENS` (
  `id_ingredient` int NOT NULL,
  `id_allergen` int NOT NULL,
  PRIMARY KEY (`id_ingredient`,`id_allergen`),
  KEY `fk_INGREDIENTS_has_ALLERGENS_ALLERGENS1_idx` (`id_allergen`),
  KEY `fk_INGREDIENTS_has_ALLERGENS_INGREDIENTS1_idx` (`id_ingredient`),
  CONSTRAINT `fk_INGREDIENTS_has_ALLERGENS_ALLERGENS1` FOREIGN KEY (`id_allergen`) REFERENCES `ALLERGENS` (`id_allergen`) ON DELETE CASCADE,
  CONSTRAINT `fk_INGREDIENTS_has_ALLERGENS_INGREDIENTS1` FOREIGN KEY (`id_ingredient`) REFERENCES `INGREDIENTS` (`id_ingredient`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `INGREDIENTS_ALLERGENS`
--

LOCK TABLES `INGREDIENTS_ALLERGENS` WRITE;
/*!40000 ALTER TABLE `INGREDIENTS_ALLERGENS` DISABLE KEYS */;
/*!40000 ALTER TABLE `INGREDIENTS_ALLERGENS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `INGREDIENTS_CATEGORIES`
--

DROP TABLE IF EXISTS `INGREDIENTS_CATEGORIES`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `INGREDIENTS_CATEGORIES` (
  `INGREDIENTS_id_ingredient` int NOT NULL,
  `CATEGORIES_id_category` int NOT NULL,
  PRIMARY KEY (`INGREDIENTS_id_ingredient`,`CATEGORIES_id_category`),
  KEY `fk_INGREDIENTS_has_CATEGORIES_CATEGORIES1_idx` (`CATEGORIES_id_category`),
  KEY `fk_INGREDIENTS_has_CATEGORIES_INGREDIENTS1_idx` (`INGREDIENTS_id_ingredient`),
  CONSTRAINT `fk_INGREDIENTS_has_CATEGORIES_CATEGORIES1` FOREIGN KEY (`CATEGORIES_id_category`) REFERENCES `CATEGORIES` (`id_category`) ON DELETE CASCADE,
  CONSTRAINT `fk_INGREDIENTS_has_CATEGORIES_INGREDIENTS1` FOREIGN KEY (`INGREDIENTS_id_ingredient`) REFERENCES `INGREDIENTS` (`id_ingredient`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `INGREDIENTS_CATEGORIES`
--

LOCK TABLES `INGREDIENTS_CATEGORIES` WRITE;
/*!40000 ALTER TABLE `INGREDIENTS_CATEGORIES` DISABLE KEYS */;
/*!40000 ALTER TABLE `INGREDIENTS_CATEGORIES` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `INGREDIENTS_CONTAINER_PARTS`
--

DROP TABLE IF EXISTS `INGREDIENTS_CONTAINER_PARTS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `INGREDIENTS_CONTAINER_PARTS` (
  `INGREDIENTS_id_ingredient` int NOT NULL,
  `CONTAINER_PARTS_id_part` int NOT NULL,
  `quantity` int DEFAULT NULL,
  PRIMARY KEY (`INGREDIENTS_id_ingredient`,`CONTAINER_PARTS_id_part`),
  KEY `fk_INGREDIENTS_has_CONTAINER_PARTS_CONTAINER_PARTS1_idx` (`CONTAINER_PARTS_id_part`),
  KEY `fk_INGREDIENTS_has_CONTAINER_PARTS_INGREDIENTS1_idx` (`INGREDIENTS_id_ingredient`),
  CONSTRAINT `fk_INGREDIENTS_has_CONTAINER_PARTS_CONTAINER_PARTS1` FOREIGN KEY (`CONTAINER_PARTS_id_part`) REFERENCES `CONTAINER_PARTS` (`id_part`) ON DELETE CASCADE,
  CONSTRAINT `fk_INGREDIENTS_has_CONTAINER_PARTS_INGREDIENTS1` FOREIGN KEY (`INGREDIENTS_id_ingredient`) REFERENCES `INGREDIENTS` (`id_ingredient`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `INGREDIENTS_CONTAINER_PARTS`
--

LOCK TABLES `INGREDIENTS_CONTAINER_PARTS` WRITE;
/*!40000 ALTER TABLE `INGREDIENTS_CONTAINER_PARTS` DISABLE KEYS */;
/*!40000 ALTER TABLE `INGREDIENTS_CONTAINER_PARTS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `INGREDIENTS_PRODUCTS`
--

DROP TABLE IF EXISTS `INGREDIENTS_PRODUCTS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `INGREDIENTS_PRODUCTS` (
  `INGREDIENTS_id_ingredient` int NOT NULL,
  `PRODUCTS_id_product` int NOT NULL,
  PRIMARY KEY (`INGREDIENTS_id_ingredient`,`PRODUCTS_id_product`),
  KEY `fk_INGREDIENTS_has_PRODUCTS_PRODUCTS1_idx` (`PRODUCTS_id_product`),
  KEY `fk_INGREDIENTS_has_PRODUCTS_INGREDIENTS1_idx` (`INGREDIENTS_id_ingredient`),
  CONSTRAINT `fk_INGREDIENTS_has_PRODUCTS_INGREDIENTS1` FOREIGN KEY (`INGREDIENTS_id_ingredient`) REFERENCES `INGREDIENTS` (`id_ingredient`) ON DELETE CASCADE,
  CONSTRAINT `fk_INGREDIENTS_has_PRODUCTS_PRODUCTS1` FOREIGN KEY (`PRODUCTS_id_product`) REFERENCES `PRODUCTS` (`id_product`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `INGREDIENTS_PRODUCTS`
--

LOCK TABLES `INGREDIENTS_PRODUCTS` WRITE;
/*!40000 ALTER TABLE `INGREDIENTS_PRODUCTS` DISABLE KEYS */;
/*!40000 ALTER TABLE `INGREDIENTS_PRODUCTS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `LOGS`
--

DROP TABLE IF EXISTS `LOGS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `LOGS` (
  `id_log` int NOT NULL AUTO_INCREMENT,
  `timestamp` datetime NOT NULL,
  `id_user` int NOT NULL,
  `action` varchar(255) NOT NULL,
  PRIMARY KEY (`id_log`),
  KEY `fk_user_idx` (`id_user`),
  CONSTRAINT `fk_user` FOREIGN KEY (`id_user`) REFERENCES `USERS` (`id_user`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=482 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `LOGS`
--

LOCK TABLES `LOGS` WRITE;
/*!40000 ALTER TABLE `LOGS` DISABLE KEYS */;
INSERT INTO `LOGS` VALUES (1,'2024-12-24 18:24:26',1,'Login'),(2,'2024-12-24 18:52:08',1,'Added product 36 to container'),(3,'2024-12-24 18:52:13',1,'Added product 10 to container'),(4,'2024-12-24 18:52:18',1,'Added product 23 to container'),(5,'2024-12-24 18:52:24',1,'Added product 18 to container'),(6,'2024-12-24 18:52:29',1,'Added container to cart'),(7,'2024-12-24 18:53:11',1,'Used coupon JERMA985'),(9,'2024-12-24 18:58:00',1,'Created order 1'),(10,'2024-12-24 19:41:34',1,'Removed all products from container'),(11,'2024-12-24 19:42:01',1,'Added product 35 to container'),(12,'2024-12-24 19:42:28',1,'Generated a lucky container'),(13,'2024-12-24 19:42:33',1,'Added container to cart'),(14,'2024-12-24 19:42:37',1,'Generated a lucky container'),(15,'2024-12-24 19:42:41',1,'Added container to cart'),(16,'2024-12-24 19:42:45',1,'Generated a lucky container'),(17,'2024-12-24 19:42:48',1,'Added container to cart'),(18,'2024-12-24 19:43:03',1,'Used coupon FREEMEAL'),(19,'2024-12-24 19:44:31',1,'Created order 2'),(20,'2024-12-24 20:09:14',1,'Logout'),(21,'2024-12-24 20:09:17',2,'Login'),(22,'2024-12-24 20:09:25',2,'Added product 10 to container'),(23,'2024-12-24 20:09:30',2,'Added product 11 to container'),(24,'2024-12-24 20:09:36',2,'Added product 36 to container'),(25,'2024-12-24 20:09:44',2,'Added product 27 to container'),(26,'2024-12-24 20:09:48',2,'Added container to cart'),(27,'2024-12-24 20:10:05',2,'Created order 3'),(28,'2024-12-24 20:10:07',2,'Logout'),(29,'2024-12-24 20:10:10',1,'Login'),(30,'2024-12-24 20:12:18',1,'Deleted order 2'),(31,'2024-12-24 20:14:07',1,'Deleted order 1'),(32,'2024-12-24 20:14:36',1,'Deleted order 3'),(33,'2024-12-24 20:23:20',1,'Logout'),(43,'2024-12-24 20:24:17',1,'Login'),(44,'2024-12-24 20:38:50',1,'Deleted container 2'),(45,'2024-12-24 20:39:20',1,'Deleted container 1'),(46,'2024-12-24 20:39:22',1,'Deleted container 3'),(47,'2024-12-24 20:40:25',1,'Logout'),(48,'2024-12-24 20:40:30',2,'Login'),(49,'2024-12-24 20:40:35',2,'Generated a lucky container'),(50,'2024-12-24 20:40:40',2,'Added container to cart'),(51,'2024-12-24 20:40:50',2,'Generated a lucky container'),(52,'2024-12-24 20:40:54',2,'Added container to cart'),(53,'2024-12-24 20:41:04',2,'Used coupon JERMA985'),(54,'2024-12-24 20:41:09',2,'Used coupon FREEMEAL'),(55,'2024-12-24 20:41:30',2,'Created order 2'),(56,'2024-12-24 20:41:37',2,'Logout'),(57,'2024-12-24 20:41:40',1,'Login'),(58,'2024-12-24 20:48:18',1,'Added product 31 to container'),(59,'2024-12-24 20:48:22',1,'Added product 23 to container'),(60,'2024-12-24 20:48:30',1,'Added product 48 to container'),(61,'2024-12-24 20:48:35',1,'Added product 15 to container'),(62,'2024-12-24 20:48:38',1,'Added container to cart'),(63,'2024-12-24 20:48:43',1,'Added product 34 to container'),(64,'2024-12-24 20:48:50',1,'Added product 26 to container'),(65,'2024-12-24 20:48:59',1,'Added product 5 to container'),(66,'2024-12-24 20:49:06',1,'Added product 20 to container'),(67,'2024-12-24 20:49:10',1,'Added container to cart'),(68,'2024-12-24 20:50:10',1,'Used coupon FREEMEAL'),(69,'2024-12-24 20:50:16',1,'Used coupon JERMA985'),(70,'2024-12-24 20:52:08',1,'Used coupon JERMA985'),(71,'2024-12-24 20:52:14',1,'Used coupon FREEMEAL'),(72,'2024-12-24 20:53:02',1,'Used coupon FREEMEAL'),(73,'2024-12-24 20:53:07',1,'Used coupon JERMA985'),(74,'2024-12-24 20:53:18',1,'Created order 3'),(75,'2024-12-24 20:53:29',1,'Deleted container 6'),(76,'2024-12-24 20:53:35',1,'Deleted order 3'),(77,'2024-12-25 19:36:40',1,'Login'),(78,'2024-12-25 20:02:01',1,'Generated a lucky container'),(79,'2024-12-25 20:02:04',1,'Added container to cart'),(80,'2024-12-25 20:02:08',1,'Generated a lucky container'),(81,'2024-12-25 20:02:12',1,'Added container to cart'),(82,'2024-12-25 20:02:31',1,'Used coupon FREEMEAL'),(83,'2024-12-25 20:03:25',1,'Created order 4'),(84,'2024-12-25 20:10:59',1,'Deleted container 9'),(85,'2024-12-25 20:23:05',1,'Deleted order 4'),(86,'2024-12-25 20:23:17',1,'Marked product 3 as deleted'),(87,'2024-12-25 20:23:19',1,'Unmarked product 3 as deleted'),(88,'2024-12-25 20:40:38',1,'Created product 62'),(89,'2024-12-25 21:01:44',1,'Generated a lucky container'),(90,'2024-12-25 21:01:48',1,'Added container to cart'),(91,'2024-12-25 21:09:06',1,'Used coupon FREEMEAL'),(92,'2024-12-25 21:09:37',1,'Used coupon JERMA985'),(93,'2024-12-25 21:14:21',1,'Added product 35 to container'),(94,'2024-12-25 21:18:44',1,'Added product 34 to container'),(95,'2024-12-25 21:19:30',1,'Removed all products from container'),(96,'2024-12-25 21:19:43',1,'Created order 5'),(97,'2024-12-25 21:27:53',1,'Added product 9 to container'),(98,'2024-12-25 21:27:59',1,'Added product 6 to container'),(99,'2024-12-25 21:28:30',1,'Removed main from container'),(100,'2024-12-25 21:29:18',1,'Added product 34 to container'),(101,'2024-12-25 21:29:22',1,'Removed dessert from container'),(102,'2024-12-26 19:26:45',1,'Login'),(103,'2024-12-26 21:52:19',1,'Login'),(104,'2024-12-26 21:52:25',1,'Generated a lucky container'),(105,'2024-12-26 21:52:25',1,'Added container to cart'),(106,'2024-12-26 21:52:39',1,'Removed container from cart'),(107,'2024-12-26 21:53:11',1,'Logout'),(108,'2024-12-27 12:48:18',1,'Login'),(109,'2024-12-27 16:49:57',1,'Login'),(110,'2024-12-27 16:59:27',1,'Generated a lucky container'),(111,'2024-12-27 16:59:27',1,'Added container to cart'),(112,'2024-12-27 19:53:09',1,'Created order 6'),(113,'2024-12-27 19:53:22',1,'Deleted order 6'),(114,'2024-12-27 20:35:14',1,'Updated sale 3'),(115,'2024-12-27 20:36:43',1,'Updated sale 3'),(116,'2024-12-27 20:36:56',1,'Updated sale 3'),(117,'2024-12-27 20:37:08',1,'Updated sale 3'),(118,'2024-12-27 20:37:25',1,'Updated sale 3'),(119,'2024-12-27 20:37:40',1,'Updated sale 3'),(120,'2024-12-27 21:04:42',1,'Created sale 4'),(121,'2024-12-27 21:07:55',1,'Updated sale 4'),(122,'2024-12-27 21:09:45',1,'Created sale 5'),(123,'2024-12-27 21:10:02',1,'Generated a lucky container'),(124,'2024-12-27 21:10:02',1,'Added container to cart'),(125,'2024-12-27 21:10:28',1,'Removed container from cart'),(126,'2024-12-27 21:10:33',1,'Deleted sale 5'),(127,'2024-12-27 21:50:51',1,'Created sale 6'),(128,'2024-12-27 21:57:55',1,'Created sale 7'),(129,'2024-12-27 21:57:59',1,'Deleted sale 7'),(130,'2024-12-27 21:59:04',1,'Created sale 8'),(131,'2024-12-27 21:59:09',1,'Deleted sale 8'),(132,'2024-12-27 22:53:32',1,'Created coupon 3'),(133,'2024-12-27 22:54:26',1,'Deleted coupon 3'),(134,'2024-12-27 22:54:38',1,'Created coupon 4'),(135,'2024-12-27 22:54:52',1,'Generated a lucky container'),(136,'2024-12-27 22:54:52',1,'Added container to cart'),(137,'2024-12-27 22:55:02',1,'Used coupon ACTUALLYFREE'),(138,'2024-12-27 22:55:11',1,'Created order 7'),(139,'2024-12-27 22:56:13',1,'Updated coupon 1'),(140,'2024-12-27 22:56:43',1,'Updated coupon 1'),(141,'2024-12-27 22:56:53',1,'Updated coupon 2'),(142,'2024-12-27 22:57:13',1,'Created coupon 5'),(143,'2024-12-27 22:57:45',1,'Updated coupon 1'),(144,'2024-12-27 22:58:00',1,'Generated a lucky container'),(145,'2024-12-27 22:58:00',1,'Added container to cart'),(146,'2024-12-27 22:58:16',1,'Removed container from cart'),(147,'2024-12-27 22:58:17',1,'Logout'),(148,'2024-12-28 11:56:57',1,'Login'),(149,'2024-12-28 11:57:58',1,'Deleted order 7'),(150,'2024-12-28 13:03:19',1,'Deleted user 7'),(151,'2024-12-28 13:16:47',1,'Updated user 2'),(152,'2024-12-28 13:17:17',1,'Updated user 2'),(153,'2024-12-28 13:17:40',1,'Updated user 2'),(154,'2024-12-28 13:17:52',1,'Updated user 2'),(155,'2024-12-28 13:18:11',1,'Updated user 2'),(156,'2024-12-28 13:19:02',1,'Updated user 4'),(157,'2024-12-28 13:21:34',1,'Updated user 5'),(158,'2024-12-28 13:23:29',1,'Logout'),(159,'2024-12-28 13:23:53',1,'Login'),(160,'2024-12-28 13:25:06',1,'Login'),(161,'2024-12-28 13:25:23',1,'Updated user 4'),(162,'2024-12-28 13:28:41',1,'Created product 63'),(163,'2024-12-28 13:29:16',1,'Added product 63 to container'),(164,'2024-12-28 13:29:23',1,'Generated a lucky container'),(165,'2024-12-28 13:29:32',1,'Added product 63 to container'),(166,'2024-12-28 13:29:39',1,'Added container to cart'),(167,'2024-12-28 13:29:58',1,'Used coupon JERMA985'),(168,'2024-12-28 13:30:09',1,'Used coupon ACTUALLYFREE'),(169,'2024-12-28 13:30:24',1,'Logout'),(170,'2024-12-28 13:30:27',1,'Login'),(171,'2024-12-28 13:30:37',1,'Marked product 63 as deleted'),(172,'2024-12-29 16:43:31',1,'Login'),(173,'2024-12-29 16:47:59',1,'Updated product 63'),(174,'2024-12-29 16:56:44',1,'Updated product 55'),(175,'2024-12-29 16:56:59',1,'Updated product 55'),(176,'2024-12-29 17:28:42',1,'Updated product 55'),(177,'2024-12-29 17:28:47',1,'Updated product 55'),(178,'2024-12-29 19:24:44',1,'Updated product 11'),(179,'2024-12-29 19:24:47',1,'Updated product 11'),(180,'2024-12-29 19:31:28',1,'Updated product 63'),(181,'2024-12-29 19:32:01',1,'Updated product 63'),(182,'2024-12-29 19:38:03',1,'Logout'),(183,'2024-12-29 19:38:07',2,'Login'),(184,'2024-12-29 19:38:19',2,'Generated a lucky container'),(185,'2024-12-29 19:38:24',2,'Added container to cart'),(186,'2024-12-29 19:38:24',2,'Generated a lucky container'),(187,'2024-12-29 19:38:24',2,'Added container to cart'),(188,'2024-12-29 19:38:24',2,'Generated a lucky container'),(189,'2024-12-29 19:38:24',2,'Added container to cart'),(190,'2024-12-29 19:38:31',2,'Removed container from cart'),(191,'2024-12-29 19:38:38',2,'Generated a lucky container'),(192,'2024-12-29 19:38:38',2,'Added container to cart'),(193,'2024-12-29 19:39:14',2,'Used coupon JERMA985'),(194,'2024-12-29 19:39:23',2,'Created order 8'),(195,'2024-12-29 19:39:27',2,'Logout'),(196,'2024-12-29 19:39:36',4,'Login'),(197,'2024-12-29 19:39:47',4,'Generated a lucky container'),(198,'2024-12-29 19:39:52',4,'Added container to cart'),(199,'2024-12-29 19:39:52',4,'Generated a lucky container'),(200,'2024-12-29 19:39:52',4,'Added container to cart'),(201,'2024-12-29 19:39:57',4,'Created order 9'),(202,'2024-12-29 19:39:59',4,'Logout'),(203,'2024-12-29 19:40:01',1,'Login'),(204,'2024-12-30 17:22:33',1,'Login'),(205,'2024-12-30 17:22:44',1,'Generated a lucky container'),(206,'2024-12-30 17:22:50',1,'Added container to cart'),(207,'2024-12-30 17:23:05',1,'Used coupon ACTUALLYFREE'),(208,'2024-12-30 17:25:51',1,'Generated a lucky container'),(209,'2024-12-30 17:25:51',1,'Added container to cart'),(210,'2024-12-30 17:25:51',1,'Generated a lucky container'),(211,'2024-12-30 17:25:51',1,'Added container to cart'),(212,'2024-12-30 17:25:51',1,'Generated a lucky container'),(213,'2024-12-30 17:25:52',1,'Added container to cart'),(214,'2024-12-30 17:25:52',1,'Generated a lucky container'),(215,'2024-12-30 17:25:52',1,'Added container to cart'),(216,'2024-12-30 17:38:01',1,'Created order 10'),(217,'2024-12-30 18:14:13',1,'Logout'),(218,'2024-12-30 18:14:21',5,'Login'),(219,'2024-12-30 18:14:30',5,'Generated a lucky container'),(220,'2024-12-30 18:14:30',5,'Added container to cart'),(221,'2024-12-30 18:14:30',5,'Generated a lucky container'),(222,'2024-12-30 18:14:30',5,'Added container to cart'),(223,'2024-12-30 18:14:31',5,'Generated a lucky container'),(224,'2024-12-30 18:14:31',5,'Added container to cart'),(225,'2024-12-30 18:22:44',5,'Created order 11'),(226,'2024-12-30 18:46:07',5,'Logout'),(227,'2024-12-30 18:46:10',1,'Login'),(228,'2024-12-30 20:12:09',1,'Created order 12'),(229,'2024-12-30 20:12:28',1,'Deleted order 12'),(230,'2024-12-30 20:25:27',1,'Removed container from cart'),(231,'2024-12-30 20:25:29',1,'Removed container from cart'),(232,'2024-12-30 20:25:30',1,'Removed container from cart'),(233,'2024-12-30 20:25:31',1,'Removed container from cart'),(234,'2024-12-30 20:25:32',1,'Removed container from cart'),(235,'2024-12-30 20:25:34',1,'Logout'),(236,'2024-12-30 20:25:59',3,'Login'),(237,'2024-12-30 20:26:18',3,'Logout'),(238,'2024-12-30 20:26:21',2,'Login'),(239,'2024-12-30 20:33:30',2,'Used coupon JERMA985'),(240,'2024-12-30 20:34:15',2,'Removed container from cart'),(241,'2024-12-30 20:34:16',2,'Removed container from cart'),(242,'2024-12-30 21:30:45',2,'Logout'),(243,'2024-12-30 21:30:48',1,'Login'),(244,'2024-12-30 22:12:27',1,'Updated product 53'),(245,'2024-12-30 22:13:01',1,'Updated product 52'),(246,'2024-12-30 22:13:54',1,'Updated product 63'),(247,'2024-12-30 23:20:20',1,'Unmarked product 63 as deleted'),(248,'2024-12-30 23:20:55',1,'Marked product 63 as deleted'),(249,'2024-12-30 23:32:32',1,'Updated product 3'),(250,'2024-12-30 23:34:08',1,'Logout'),(251,'2025-01-02 12:29:45',1,'Login'),(252,'2025-01-02 12:36:31',1,'Logout'),(253,'2025-01-02 12:36:34',2,'Login'),(254,'2025-01-02 12:36:49',2,'Generated a lucky container'),(255,'2025-01-02 12:36:49',2,'Added container to cart'),(256,'2025-01-02 12:36:49',2,'Generated a lucky container'),(257,'2025-01-02 12:36:49',2,'Added container to cart'),(258,'2025-01-02 12:36:49',2,'Generated a lucky container'),(259,'2025-01-02 12:36:49',2,'Added container to cart'),(260,'2025-01-02 12:37:12',2,'Used coupon JERMA985'),(261,'2025-01-02 12:37:18',2,'Created order 13'),(262,'2025-01-02 12:37:23',2,'Logout'),(263,'2025-01-02 12:37:26',1,'Login'),(264,'2025-01-02 12:37:48',1,'Created coupon 6'),(265,'2025-01-02 12:38:10',1,'Logout'),(266,'2025-01-02 12:38:13',4,'Login'),(267,'2025-01-02 12:38:22',4,'Generated a lucky container'),(268,'2025-01-02 12:38:22',4,'Added container to cart'),(269,'2025-01-02 12:38:42',4,'Generated a lucky container'),(270,'2025-01-02 12:38:49',4,'Added container to cart'),(271,'2025-01-02 12:38:49',4,'Generated a lucky container'),(272,'2025-01-02 12:38:49',4,'Added container to cart'),(273,'2025-01-02 12:38:49',4,'Generated a lucky container'),(274,'2025-01-02 12:38:49',4,'Added container to cart'),(275,'2025-01-02 12:38:57',4,'Used coupon HALFOFF'),(276,'2025-01-02 12:39:10',4,'Created order 14'),(277,'2025-01-02 12:39:13',4,'Logout'),(278,'2025-01-02 12:39:16',1,'Login'),(279,'2025-01-02 12:43:16',1,'Logout'),(280,'2025-01-02 12:43:19',2,'Login'),(281,'2025-01-02 12:43:28',2,'Login'),(282,'2025-01-02 12:44:30',2,'Login'),(283,'2025-01-02 12:44:46',2,'Used coupon JERMA985'),(284,'2025-01-02 12:45:01',2,'Logout'),(285,'2025-01-02 12:45:04',1,'Login'),(286,'2025-01-02 12:50:57',1,'Logout'),(287,'2025-01-02 12:51:12',5,'Login'),(288,'2025-01-02 12:51:22',5,'Generated a lucky container'),(289,'2025-01-02 12:51:22',5,'Added container to cart'),(290,'2025-01-02 12:51:44',5,'Removed container from cart'),(291,'2025-01-02 12:51:53',5,'Generated a lucky container'),(292,'2025-01-02 12:51:53',5,'Added container to cart'),(293,'2025-01-02 12:52:29',5,'Created order 15'),(294,'2025-01-02 12:55:44',5,'Generated a lucky container'),(295,'2025-01-02 12:55:44',5,'Added container to cart'),(296,'2025-01-02 12:55:44',5,'Generated a lucky container'),(297,'2025-01-02 12:55:44',5,'Added container to cart'),(298,'2025-01-02 12:56:04',5,'Used coupon ACTUALLYFREE'),(299,'2025-01-02 12:56:16',5,'Created order 16'),(300,'2025-01-02 12:56:29',5,'Logout'),(301,'2025-01-02 12:56:31',1,'Login'),(302,'2025-01-02 12:56:55',1,'Created coupon 7'),(303,'2025-01-02 12:57:02',1,'Deleted coupon 5'),(304,'2025-01-02 12:57:32',1,'Logout'),(305,'2025-01-02 12:57:35',2,'Login'),(306,'2025-01-02 12:57:45',2,'Generated a lucky container'),(307,'2025-01-02 12:57:45',2,'Added container to cart'),(308,'2025-01-02 12:58:00',2,'Used coupon DEVYAT'),(309,'2025-01-02 12:58:08',2,'Created order 17'),(310,'2025-01-02 15:07:39',1,'Login'),(311,'2025-01-02 15:53:04',2,'Login'),(312,'2025-01-02 17:09:57',2,'Logout'),(313,'2025-01-02 17:10:01',5,'Login'),(314,'2025-01-02 17:14:13',5,'Logout'),(315,'2025-01-02 17:14:16',4,'Login'),(316,'2025-01-02 17:14:36',4,'Created review 7'),(317,'2025-01-02 17:14:37',4,'Deleted review 7'),(318,'2025-01-02 17:15:10',4,'Created review 8'),(319,'2025-01-02 17:15:14',4,'Logout'),(320,'2025-01-02 17:15:18',3,'Login'),(321,'2025-01-02 17:15:35',3,'Generated a lucky container'),(322,'2025-01-02 17:15:42',3,'Added container to cart'),(323,'2025-01-02 17:15:42',3,'Generated a lucky container'),(324,'2025-01-02 17:15:42',3,'Added container to cart'),(325,'2025-01-02 17:15:43',3,'Generated a lucky container'),(326,'2025-01-02 17:15:43',3,'Added container to cart'),(327,'2025-01-02 17:15:43',3,'Generated a lucky container'),(328,'2025-01-02 17:15:43',3,'Added container to cart'),(329,'2025-01-02 17:15:43',3,'Generated a lucky container'),(330,'2025-01-02 17:15:43',3,'Added container to cart'),(331,'2025-01-02 17:16:05',3,'Removed container from cart'),(332,'2025-01-02 17:16:18',3,'Created order 18'),(333,'2025-01-02 17:16:50',3,'Created review 9'),(334,'2025-01-02 17:16:54',3,'Logout'),(335,'2025-01-02 17:16:59',1,'Login'),(336,'2025-01-02 17:17:34',1,'Created review 10'),(337,'2025-01-02 17:36:40',1,'Created product 65'),(338,'2025-01-02 17:36:49',1,'Marked product 64 as deleted'),(339,'2025-01-02 17:36:51',1,'Unmarked product 64 as deleted'),(340,'2025-01-02 17:37:00',1,'Updated product 65'),(341,'2025-01-02 17:47:05',1,'Logout'),(342,'2025-01-02 17:47:33',9,'Login'),(343,'2025-01-02 17:47:35',9,'Logout'),(344,'2025-01-02 17:47:41',9,'Login'),(345,'2025-01-02 17:47:51',9,'Changed profile picture'),(346,'2025-01-02 17:47:56',9,'Logout'),(347,'2025-01-02 17:48:22',10,'Login'),(348,'2025-01-02 17:48:29',10,'Changed profile picture'),(349,'2025-01-02 17:48:31',10,'Logout'),(350,'2025-01-02 17:48:55',11,'Login'),(351,'2025-01-02 17:49:02',11,'Changed profile picture'),(352,'2025-01-02 17:49:03',11,'Logout'),(353,'2025-01-02 17:49:24',12,'Login'),(354,'2025-01-02 17:49:44',12,'Generated a lucky container'),(355,'2025-01-02 17:49:44',12,'Added container to cart'),(356,'2025-01-02 17:49:48',12,'Created order 19'),(357,'2025-01-02 17:50:25',12,'Created review 11'),(358,'2025-01-02 17:50:28',12,'Logout'),(359,'2025-01-02 17:50:31',9,'Login'),(360,'2025-01-02 17:50:47',9,'Generated a lucky container'),(361,'2025-01-02 17:50:47',9,'Added container to cart'),(362,'2025-01-02 17:50:47',9,'Generated a lucky container'),(363,'2025-01-02 17:50:47',9,'Added container to cart'),(364,'2025-01-02 17:50:51',9,'Created order 20'),(365,'2025-01-02 17:51:01',9,'Generated a lucky container'),(366,'2025-01-02 17:51:01',9,'Added container to cart'),(367,'2025-01-02 17:51:25',9,'Created order 21'),(368,'2025-01-02 17:51:27',9,'Logout'),(369,'2025-01-02 17:51:31',9,'Login'),(370,'2025-01-02 17:51:52',9,'Created review 12'),(371,'2025-01-02 17:52:11',9,'Created review 13'),(372,'2025-01-02 17:52:13',9,'Logout'),(373,'2025-01-02 17:52:24',10,'Login'),(374,'2025-01-02 17:52:43',10,'Generated a lucky container'),(375,'2025-01-02 17:52:43',10,'Added container to cart'),(376,'2025-01-02 17:52:43',10,'Generated a lucky container'),(377,'2025-01-02 17:52:50',10,'Generated a lucky container'),(378,'2025-01-02 17:52:50',10,'Added container to cart'),(379,'2025-01-02 17:52:53',10,'Removed container from cart'),(380,'2025-01-02 17:52:59',10,'Created order 22'),(381,'2025-01-02 17:53:33',10,'Created review 14'),(382,'2025-01-02 17:53:37',10,'Logout'),(383,'2025-01-04 08:09:09',1,'Login'),(384,'2025-01-04 09:00:49',1,'Added product 36 to container'),(385,'2025-01-04 09:13:58',1,'Removed dessert from container'),(386,'2025-01-04 09:17:05',1,'Added product 14 to container'),(387,'2025-01-04 09:17:11',1,'Removed branch from container'),(388,'2025-01-04 09:17:43',1,'Updated product 65'),(389,'2025-01-04 09:18:19',1,'Updated sale 1'),(390,'2025-01-04 09:28:46',1,'Created sale 9'),(391,'2025-01-04 09:29:15',1,'Created sale 10'),(392,'2025-01-04 09:32:54',1,'Added product 45 to container'),(393,'2025-01-04 09:33:06',1,'Added product 54 to container'),(394,'2025-01-04 09:33:19',1,'Added product 11 to container'),(395,'2025-01-04 09:33:38',1,'Added product 62 to container'),(396,'2025-01-04 09:33:48',1,'Added container to cart'),(397,'2025-01-04 09:41:31',1,'Created coupon 8'),(398,'2025-01-04 09:41:41',1,'Used coupon FIVE'),(399,'2025-01-04 09:42:02',1,'Created order 23'),(400,'2025-01-04 09:43:58',1,'Created order 24'),(401,'2025-01-04 10:04:38',1,'Logout'),(402,'2025-01-04 10:05:03',12,'Login'),(403,'2025-01-04 10:12:11',12,'Logout'),(404,'2025-01-04 10:12:14',1,'Login'),(405,'2025-01-04 10:36:25',1,'Logout'),(406,'2025-01-04 10:57:19',10,'Login'),(407,'2025-01-04 10:57:38',10,'Removed container from cart'),(408,'2025-01-04 11:18:06',10,'Logout'),(409,'2025-01-04 11:18:09',1,'Login'),(410,'2025-01-04 13:17:32',1,'Login'),(411,'2025-01-04 13:20:10',1,'Login'),(412,'2025-01-04 13:32:53',1,'Login'),(413,'2025-01-04 13:36:55',1,'Added product 54 to container'),(414,'2025-01-04 13:37:07',1,'Added product 22 to container'),(415,'2025-01-04 13:37:19',1,'Added product 61 to container'),(416,'2025-01-04 13:37:31',1,'Removed all products from container'),(417,'2025-01-04 13:37:41',1,'Generated a lucky container'),(418,'2025-01-04 13:37:50',1,'Added container to cart'),(419,'2025-01-04 13:38:40',1,'Created order 25'),(420,'2025-01-04 13:38:56',1,'Removed container from cart'),(421,'2025-01-04 13:51:02',1,'Generated a lucky container'),(422,'2025-01-04 13:51:02',1,'Added container to cart'),(423,'2025-01-04 13:53:37',1,'Removed container from cart'),(424,'2025-01-04 14:00:33',1,'Added product 31 to container'),(425,'2025-01-04 14:00:46',1,'Generated a lucky container'),(426,'2025-01-04 14:00:54',1,'Added container to cart'),(427,'2025-01-04 14:36:04',1,'Removed container from cart'),(428,'2025-01-04 14:36:11',1,'Recovered order 25'),(429,'2025-01-04 14:36:14',1,'Removed container from cart'),(430,'2025-01-05 12:26:33',1,'Logout'),(431,'2025-01-05 12:27:18',13,'Login'),(432,'2025-01-05 12:28:47',13,'Changed username from InternetUser to Internet User'),(433,'2025-01-05 12:28:47',13,'Changed profile picture'),(434,'2025-01-05 12:29:15',13,'Added product 35 to container'),(435,'2025-01-05 12:31:44',13,'Login'),(436,'2025-01-05 12:33:43',13,'Added product 1 to container'),(437,'2025-01-05 12:37:14',13,'Login'),(438,'2025-01-05 12:37:44',13,'Added product 1 to container'),(439,'2025-01-05 12:37:51',13,'Added product 29 to container'),(440,'2025-01-05 12:37:54',13,'Removed drink from container'),(441,'2025-01-05 12:38:01',13,'Added product 45 to container'),(442,'2025-01-05 12:38:06',13,'Added product 35 to container'),(443,'2025-01-05 12:38:15',13,'Added product 17 to container'),(444,'2025-01-05 12:38:22',13,'Added container to cart'),(445,'2025-01-05 12:40:28',13,'Created order 26'),(446,'2025-01-05 12:41:35',13,'Created review 15'),(447,'2025-01-05 12:42:08',13,'Logout'),(448,'2025-01-05 12:42:12',1,'Login'),(449,'2025-01-05 12:44:32',1,'Created product 66'),(450,'2025-01-05 12:51:56',1,'Logout'),(451,'2025-01-05 12:52:01',13,'Login'),(452,'2025-01-05 12:52:07',13,'Recovered order 26'),(453,'2025-01-05 12:52:14',13,'Used coupon DEVYAT'),(454,'2025-01-05 12:52:19',13,'Used coupon FIVE'),(455,'2025-01-05 12:56:24',13,'Created order 27'),(456,'2025-01-05 12:56:46',13,'Created review 16'),(457,'2025-01-05 12:56:59',13,'Updated review 15'),(458,'2025-01-05 13:54:40',2,'Login'),(459,'2025-01-05 13:55:14',13,'Login'),(460,'2025-01-05 13:56:08',2,'Added product 38 to container'),(461,'2025-01-05 13:56:14',2,'Added product 53 to container'),(462,'2025-01-05 13:56:20',2,'Added product 2 to container'),(463,'2025-01-05 13:56:24',2,'Added product 11 to container'),(464,'2025-01-05 13:56:29',2,'Added container to cart'),(465,'2025-01-05 13:56:52',2,'Created order 28'),(466,'2025-01-05 13:57:34',2,'Created review 17'),(467,'2025-01-05 13:57:43',2,'Logout'),(468,'2025-01-05 13:59:04',13,'Logout'),(469,'2025-01-05 13:59:07',1,'Login'),(470,'2025-01-05 20:49:46',13,'Login'),(471,'2025-01-05 20:53:15',13,'Added product 34 to container'),(472,'2025-01-05 20:53:19',13,'Added product 2 to container'),(473,'2025-01-05 20:53:22',13,'Added product 15 to container'),(474,'2025-01-05 20:53:25',13,'Added product 24 to container'),(475,'2025-01-05 20:53:53',13,'Added container to cart'),(476,'2025-01-05 20:53:55',13,'Generated a lucky container'),(477,'2025-01-05 20:53:57',13,'Added container to cart'),(478,'2025-01-05 20:54:36',13,'Created order 29'),(479,'2025-01-05 20:55:00',13,'Logout'),(480,'2025-01-05 20:55:03',1,'Login'),(481,'2025-01-05 20:56:39',1,'Logout');
/*!40000 ALTER TABLE `LOGS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ORDERS`
--

DROP TABLE IF EXISTS `ORDERS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ORDERS` (
  `id_order` int NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `id_establishment` int DEFAULT NULL,
  `date_order` date NOT NULL,
  `delivery_address` varchar(255) DEFAULT NULL,
  `payment_type` varchar(10) NOT NULL,
  `card_number` varchar(16) DEFAULT NULL,
  `expiration_date` varchar(5) DEFAULT NULL,
  `cvc` varchar(3) DEFAULT NULL,
  `card_holder` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_order`),
  KEY `fk_ORDERS_ESTABLISHMENTS1_idx` (`id_establishment`),
  KEY `fk_ORDERS_USERS1_idx` (`id_user`),
  CONSTRAINT `fk_ORDERS_ESTABLISHMENTS1` FOREIGN KEY (`id_establishment`) REFERENCES `ESTABLISHMENTS` (`id_establishment`),
  CONSTRAINT `fk_ORDERS_USERS1` FOREIGN KEY (`id_user`) REFERENCES `USERS` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ORDERS`
--

LOCK TABLES `ORDERS` WRITE;
/*!40000 ALTER TABLE `ORDERS` DISABLE KEYS */;
INSERT INTO `ORDERS` VALUES (2,2,NULL,'2024-12-24','Jaume Balmes, Molins de Rei, 08750, BCN, Spain','Card',NULL,NULL,NULL,NULL),(5,1,1,'2024-12-25',NULL,'Cash',NULL,NULL,NULL,NULL),(8,2,NULL,'2024-12-29','Carrer de Jaume Balmes, 3, 2º 2ª, Molins de Rei, 08750, Barcelona, España','Cash',NULL,NULL,NULL,NULL),(9,4,1,'2024-12-29',NULL,'PayPal',NULL,NULL,NULL,NULL),(10,1,1,'2024-12-30',NULL,'PayPal',NULL,NULL,NULL,NULL),(11,5,NULL,'2024-12-30','a, a, 00001, a, a','Card',NULL,NULL,NULL,NULL),(13,2,1,'2025-01-02',NULL,'Cash',NULL,NULL,NULL,NULL),(14,4,4,'2025-01-02',NULL,'PayPal',NULL,NULL,NULL,NULL),(15,5,NULL,'2025-01-02','Carrer de Jaume Balmes, 3, 2º 2ª, Molins de Rei, 08750, Barcelona, España','PayPal',NULL,NULL,NULL,NULL),(16,5,NULL,'2025-01-02','Carrer de Jaume Balmes, 3, 2º 2ª, Molins de Rei, 08750, Barcelona, España','Cash',NULL,NULL,NULL,NULL),(17,2,NULL,'2025-01-02','Carrer de Jaume Balmes, 3, 2º 2ª, Molins de Rei, 08750, Barcelona, España','PayPal',NULL,NULL,NULL,NULL),(18,3,NULL,'2025-01-02','ff, f, 55555, fff, f','PayPal',NULL,NULL,NULL,NULL),(19,12,1,'2025-01-02',NULL,'Cash',NULL,NULL,NULL,NULL),(20,9,1,'2025-01-02',NULL,'PayPal',NULL,NULL,NULL,NULL),(21,9,NULL,'2025-01-02','Carrer de Jaume Balmes, 3, 2º 2ª, Molins de Rei, 08750, Barcelona, España','Card',NULL,NULL,NULL,NULL),(22,10,8,'2025-01-02',NULL,'PayPal',NULL,NULL,NULL,NULL),(24,1,NULL,'2025-01-04','Carrer de Jaume Balmes, 3, 2º 2ª, Molins de Rei, 08750, Barcelona, España','Cash',NULL,NULL,NULL,NULL),(25,1,1,'2025-01-04',NULL,'Cash',NULL,NULL,NULL,NULL),(26,13,NULL,'2025-01-05','Internet Street, 453, Net, 01936, New York, America','Card',NULL,NULL,NULL,NULL),(27,13,NULL,'2025-01-05','Internet Street, 453, Net, 01936, New York, España','Cash',NULL,NULL,NULL,NULL),(28,2,1,'2025-01-05',NULL,'Cash',NULL,NULL,NULL,NULL),(29,13,1,'2025-01-05',NULL,'Cash',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `ORDERS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `PRODUCTS`
--

DROP TABLE IF EXISTS `PRODUCTS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PRODUCTS` (
  `id_product` int NOT NULL AUTO_INCREMENT,
  `id_type` int NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `price` decimal(5,2) NOT NULL,
  `deleted` int DEFAULT '0',
  PRIMARY KEY (`id_product`),
  KEY `fk_PRODUCTS_TYPES1_idx` (`id_type`),
  CONSTRAINT `fk_PRODUCTS_TYPES1` FOREIGN KEY (`id_type`) REFERENCES `TYPES` (`id_type`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PRODUCTS`
--

LOCK TABLES `PRODUCTS` WRITE;
/*!40000 ALTER TABLE `PRODUCTS` DISABLE KEYS */;
INSERT INTO `PRODUCTS` VALUES (1,1,'Hamburger',5.99,0),(2,1,'Pizza',9.99,0),(3,1,'Chicken Sandwich',4.99,0),(4,1,'Caesar Salad',6.49,0),(5,1,'Fish N\' Chips',10.99,0),(6,1,'Mac N\' Cheese',9.99,0),(7,1,'Tacos',12.99,0),(8,1,'Spaghetti',8.49,0),(9,1,'Hot Dog',4.99,0),(10,1,'Sushi',5.99,0),(11,2,'French Fries',3.99,0),(12,2,'Garlic Bread',1.99,0),(13,2,'Side Salad',3.99,0),(14,2,'Coleslaw',2.49,0),(15,2,'Mashed Potatoes',3.99,0),(16,2,'Rice Pilaf',4.49,0),(17,2,'Poutine',5.99,0),(18,2,'Sweet Potato Fries',4.99,0),(19,2,'Corn on the Cob',3.49,0),(20,2,'Nachos con Queso',4.99,0),(21,3,'Lemonade',3.49,0),(22,3,'Iced Tea',3.49,0),(23,3,'Soda',2.99,0),(24,3,'Milkshake',5.49,0),(25,3,'Coffee',2.99,0),(26,3,'Green Tea',3.49,0),(27,3,'Smoothie',5.99,0),(28,3,'Mineral Water',0.99,0),(29,3,'Hot Chocolate',4.49,0),(30,3,'Sparkling Water',1.99,0),(31,4,'Flan',2.99,0),(32,4,'Ice Cream',3.49,0),(33,4,'Brownies',4.99,0),(34,4,'Cheesecake',5.99,0),(35,4,'Apple Pie',5.49,0),(36,4,'Fruit Salad',3.49,0),(37,4,'Chocolate Cake',5.99,0),(38,4,'Cupcakes',2.49,0),(39,4,'Pudding',4.99,0),(40,4,'Macarons',4.99,0),(41,3,'Margarita',8.99,0),(42,3,'Mojito',6.49,0),(43,3,'Beer',2.99,0),(44,3,'Wine',4.99,0),(45,3,'Whiskey',8.99,0),(46,1,'Okonomiyaki',7.99,0),(47,1,'Sliders',8.99,0),(48,1,'Stargazey Pie',7.49,0),(49,1,'Ratatouille',11.49,0),(50,1,'Gyro',6.49,0),(51,3,'Pilk',0.99,0),(52,3,'Lean',0.99,0),(53,3,'Frosty Freezy Freeze',19.99,0),(54,1,'Ramen',9.85,0),(55,1,'Soup',6.99,0),(61,2,'Wasabi Peas',2.99,0),(62,4,'OREO™ Pie',7.99,0),(63,4,'Pot of Greed',999.99,1),(65,4,'Deer Crackers',2.99,0),(66,1,'Fried Fish',6.99,0);
/*!40000 ALTER TABLE `PRODUCTS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `REVIEWS`
--

DROP TABLE IF EXISTS `REVIEWS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `REVIEWS` (
  `id_review` int NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `id_order` int NOT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `stars` decimal(2,1) NOT NULL,
  `published_date` date NOT NULL,
  PRIMARY KEY (`id_review`),
  KEY `fk_REVIEW_USERS1_idx` (`id_user`),
  KEY `fk_REVIEW_ORDERS1_idx` (`id_order`),
  CONSTRAINT `fk_REVIEW_ORDERS1` FOREIGN KEY (`id_order`) REFERENCES `ORDERS` (`id_order`) ON DELETE CASCADE,
  CONSTRAINT `fk_REVIEW_USERS1` FOREIGN KEY (`id_user`) REFERENCES `USERS` (`id_user`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `REVIEWS`
--

LOCK TABLES `REVIEWS` WRITE;
/*!40000 ALTER TABLE `REVIEWS` DISABLE KEYS */;
INSERT INTO `REVIEWS` VALUES (1,2,17,'My go-to place for any food-related needs. Or container-related ones.',4.0,'2025-01-02'),(2,2,2,'Ever since I tried DockerEats, I never eat anywhere else. Not even my home.',5.0,'2025-01-02'),(3,2,8,'Just perfect. The degree of customization is amazing. You are in control of everything.',4.5,'2025-01-02'),(4,5,16,'Pretty great. A little bit costly, but I found a coupon that makes the entire order free...',4.5,'2025-01-02'),(5,5,11,'Needs more meat options. I hate vegan people',3.5,'2025-01-02'),(6,5,15,'Delivery is great and fast. Pick-up is awful because there is just one establishment per country.',3.5,'2025-01-02'),(8,4,9,'Worthy of the Mishima Clan...',3.5,'2025-01-02'),(9,3,18,'LIFE IS PAIN I HATE',5.0,'2025-01-02'),(10,1,5,'100% recommended, and not just because I\'m the owner and CEO. Buy our products!',5.0,'2025-01-02'),(11,12,19,'Eh. Way too pricey.',2.5,'2025-01-02'),(12,9,20,'Oauaurgrghhh oogaghhh',4.5,'2025-01-02'),(13,9,21,'Brurughgh oooruurhg agg gh oauruhhghh',3.5,'2025-01-02'),(14,10,22,'Reminds me a bit of my Pizzeria... The food is very good.',4.5,'2025-01-02'),(15,13,26,'Very recommended and fast, works well and runs perfectly on its newest host.',4.0,'2025-01-05'),(16,13,27,'Food so good I had to order the exact same container twice. Coupons are great!',5.0,'2025-01-05'),(17,2,28,'The mobile interface works well enough.',3.5,'2025-01-05');
/*!40000 ALTER TABLE `REVIEWS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `SALES`
--

DROP TABLE IF EXISTS `SALES`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SALES` (
  `id_sale` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `discount` int NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date DEFAULT NULL,
  `discount_type` int NOT NULL,
  `product_type` int DEFAULT '0',
  `category_affected` int DEFAULT '0',
  `scope` int NOT NULL,
  PRIMARY KEY (`id_sale`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `SALES`
--

LOCK TABLES `SALES` WRITE;
/*!40000 ALTER TABLE `SALES` DISABLE KEYS */;
INSERT INTO `SALES` VALUES (1,'Release Party','DockerEats has just been released! To commemorate this, all orders made will have a 5% discount applied!',5,'2024-12-09','2025-01-03',2,0,0,1),(2,'Vegapocalypse','Healthy is the new black! Let\'s commemorate Earth Day together! All Vegan category products have a 25% discount!',25,'2024-12-09',NULL,2,0,8,2),(3,'Fish Festival','Enjoy 3€ of discount on all fish related products! The sea has never tasted better!',3,'2024-12-09',NULL,1,0,3,2),(4,'Alcoholism','Enjoy a 50% off on all alcoholic products! Uh, do try to drink moderately, though...',50,'2024-12-27','2025-01-03',2,0,10,2),(6,'Comforting Daze','90% off on all comfort drinks! Don\'t worry about what you\'ll drink and just focus on the food!',90,'2024-12-27','2025-01-03',2,3,12,2),(9,'Comfort 50','',50,'2025-01-04','2025-01-11',2,0,12,2),(10,'Comfort Drink','',3,'2025-01-04','2025-01-11',1,3,12,2);
/*!40000 ALTER TABLE `SALES` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `SALES_CONTAINER_PARTS`
--

DROP TABLE IF EXISTS `SALES_CONTAINER_PARTS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SALES_CONTAINER_PARTS` (
  `id_sale` int NOT NULL,
  `id_part` int NOT NULL,
  PRIMARY KEY (`id_sale`,`id_part`),
  KEY `fkpart_idx` (`id_part`),
  CONSTRAINT `fkpart` FOREIGN KEY (`id_part`) REFERENCES `CONTAINER_PARTS` (`id_part`) ON DELETE CASCADE,
  CONSTRAINT `fksale` FOREIGN KEY (`id_sale`) REFERENCES `SALES` (`id_sale`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `SALES_CONTAINER_PARTS`
--

LOCK TABLES `SALES_CONTAINER_PARTS` WRITE;
/*!40000 ALTER TABLE `SALES_CONTAINER_PARTS` DISABLE KEYS */;
INSERT INTO `SALES_CONTAINER_PARTS` VALUES (3,13),(3,17),(2,19),(2,39),(3,49),(2,52),(2,54),(2,55),(2,59),(6,63),(4,67),(3,69),(2,71),(2,75),(3,77),(2,78),(4,79),(2,86),(2,91),(2,94),(4,95),(6,123),(2,126),(3,129),(2,130),(2,131),(2,135),(2,139),(6,143),(6,147),(2,148),(3,149),(2,151),(2,154),(6,155),(2,163),(2,164),(4,167),(2,171),(3,173),(2,174),(6,175),(2,178),(2,183),(2,187),(4,191),(4,195),(2,198),(9,202),(10,202),(9,203),(2,204),(9,205),(9,208),(10,208),(9,211),(10,211),(9,216),(10,216),(9,219),(10,219),(2,221),(9,226),(9,228),(10,228);
/*!40000 ALTER TABLE `SALES_CONTAINER_PARTS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `SALES_ORDERS`
--

DROP TABLE IF EXISTS `SALES_ORDERS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SALES_ORDERS` (
  `id_sale` int NOT NULL,
  `id_order` int NOT NULL,
  PRIMARY KEY (`id_sale`,`id_order`),
  KEY `fk_OFFERS_has_ORDERS_ORDERS1_idx` (`id_order`),
  KEY `fk_OFFERS_has_ORDERS_OFFERS1_idx` (`id_sale`),
  CONSTRAINT `fk_OFFERS_has_ORDERS_OFFERS1` FOREIGN KEY (`id_sale`) REFERENCES `SALES` (`id_sale`) ON DELETE CASCADE,
  CONSTRAINT `fk_OFFERS_has_ORDERS_ORDERS1` FOREIGN KEY (`id_order`) REFERENCES `ORDERS` (`id_order`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `SALES_ORDERS`
--

LOCK TABLES `SALES_ORDERS` WRITE;
/*!40000 ALTER TABLE `SALES_ORDERS` DISABLE KEYS */;
INSERT INTO `SALES_ORDERS` VALUES (1,2),(1,5),(1,8),(1,9),(1,10),(1,11),(1,13),(1,14),(1,15),(1,16),(1,17),(1,18),(1,19),(1,20),(1,21),(1,22);
/*!40000 ALTER TABLE `SALES_ORDERS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TYPES`
--

DROP TABLE IF EXISTS `TYPES`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TYPES` (
  `id_type` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_type`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TYPES`
--

LOCK TABLES `TYPES` WRITE;
/*!40000 ALTER TABLE `TYPES` DISABLE KEYS */;
INSERT INTO `TYPES` VALUES (1,'Main'),(2,'Branch'),(3,'Drink'),(4,'Dessert');
/*!40000 ALTER TABLE `TYPES` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `USERS`
--

DROP TABLE IF EXISTS `USERS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `USERS` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(45) NOT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `USERS`
--

LOCK TABLES `USERS` WRITE;
/*!40000 ALTER TABLE `USERS` DISABLE KEYS */;
INSERT INTO `USERS` VALUES (1,'admin','$2y$10$/3h0suPmndNFSOvY12XgXO6C9jrQt5ZpRWXkf9f8u5afkxg2yuSXW','admin@gmail.com'),(2,'cuendem','$2y$10$B8dzE/A.j0fMsVaM.PunseEpZaIJjYgCAU8lcfJvCL5Rr9L03Fr3W','cuendem05@gmail.com'),(3,'Jerma985','$2y$10$MGXhzZFRXnDp1Gr7.zGi6OKULXN5ggSc5dUKTLPTfLqXrvFR3.I9q','jerma@gmail.com'),(4,'Heihachi','$2y$10$vIIHeJC15AO6P8xubGEydeldoLy3ugewo97ucI4AqlNIlOHXEzhO.','heihachi@gmail.com'),(5,'Marselo','$2y$10$d.aVYsi/mdytstvW.KC92eRfbaOttU5vkgYol46cAER4J1o8uwNBC','marselo@gmail.com'),(9,'Zombie from PvZ','$2y$10$JLLXq78CEkBczkISfWIWN.mQ2qGIK5GbfSmPrKZKbHkW0Y9zcVKjy','zombie@gmail.com'),(10,'Freddy Fazbear','$2y$10$FfHMZSYu3UZNDNR1FOYf3ez7uSpiByBpthmazrQHktEbqE2OK5fAm','fnaf@gmail.com'),(11,'Ryan Gosling','$2y$10$vlVsbgMOuIUjUBvBHIAbx.IJRo1d8gC6qNYICQniuvrxGxBGoDFI6','ryan@gmail.com'),(12,'John Doe','$2y$10$WWknIKbpa9XmP35wqx30bODiOnoJlpZ1GIr1Jqh6zRjh6NzG6L8C2','john@gmail.com'),(13,'Internet User','$2y$10$fNQFr5G6PmaXovUt63j9mOn6TPbXanDW9h.pCfkXhCyIDgl4Fgbkm','internet@gmail.com');
/*!40000 ALTER TABLE `USERS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database '4571560_dockereats'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-01-05 22:05:22
