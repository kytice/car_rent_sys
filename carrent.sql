-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: carrent
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

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
-- Table structure for table `cars`
--

DROP TABLE IF EXISTS `cars`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cars` (
  `CarID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `RegNum` varchar(12) DEFAULT NULL,
  `TypeID` tinyint(3) unsigned DEFAULT NULL,
  `Make` varchar(15) DEFAULT NULL,
  `Model` varchar(15) DEFAULT NULL,
  `Capacity` tinyint(3) unsigned DEFAULT NULL,
  `Trans` enum('Automatic','Manual') DEFAULT NULL,
  `Mileage` int(10) unsigned DEFAULT NULL,
  `FuelType` enum('Petrol','Diesel','Electric','Hybrid') DEFAULT NULL,
  PRIMARY KEY (`CarID`),
  KEY `TypeID` (`TypeID`),
  CONSTRAINT `cars_ibfk_1` FOREIGN KEY (`TypeID`) REFERENCES `types` (`TypeID`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cars`
--

LOCK TABLES `cars` WRITE;
/*!40000 ALTER TABLE `cars` DISABLE KEYS */;
INSERT INTO `cars` VALUES (1,'211D1234',1,'Toyota','Yaris',5,'Automatic',5000,'Petrol'),(2,'241KY234',1,'Renault','Clio',5,'Manual',3000,'Petrol'),(3,'211L8765',1,'Hyundai','i20',5,'Automatic',6000,'Diesel'),(4,'222C5678',2,'Volkswagen','Polo',5,'Manual',2000,'Diesel'),(5,'231KY876',2,'Ford','Fiesta',5,'Automatic',1000,'Electric'),(6,'222M4321',2,'Skoda','Octavia',5,'Automatic',2500,'Petrol'),(7,'241KY4321',3,'Audi','A4',5,'Automatic',3500,'Electric'),(8,'221CW987',3,'Porsche','911',2,'Automatic',2200,'Petrol'),(9,'232D8765',4,'BMW','2 Series',5,'Manual',2000,'Diesel'),(10,'241L87654',4,'Ford','Mustang',4,'Automatic',6000,'Petrol'),(11,'212LD4321',5,'Toyota','Sienna',7,'Manual',4000,'Diesel'),(12,'221KY5678',5,'Honda','Odyssey',7,'Automatic',3200,'Electric');
/*!40000 ALTER TABLE `cars` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservations`
--

DROP TABLE IF EXISTS `reservations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reservations` (
  `ResID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `CarID` smallint(5) unsigned DEFAULT NULL,
  `FName` varchar(20) DEFAULT NULL,
  `SName` varchar(20) DEFAULT NULL,
  `DriverLicense` varchar(20) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `Phone` varchar(15) DEFAULT NULL,
  `ResDate` date DEFAULT curdate(),
  `PickupDate` date DEFAULT NULL,
  `EstReturnDate` date DEFAULT NULL,
  `ActReturnDate` date DEFAULT NULL,
  `Cost` decimal(7,2) DEFAULT NULL,
  `Status` enum('Reserved','Dropped Off','Picked Up') DEFAULT 'Reserved',
  PRIMARY KEY (`ResID`),
  KEY `CarID` (`CarID`),
  CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`CarID`) REFERENCES `cars` (`CarID`)
) ENGINE=InnoDB AUTO_INCREMENT=1011 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservations`
--

LOCK TABLES `reservations` WRITE;
/*!40000 ALTER TABLE `reservations` DISABLE KEYS */;
INSERT INTO `reservations` VALUES (1001,1,'John','Smith','D12345678','john.smith@example.com','+353 87 123 456','2024-08-01','2024-08-05','2024-08-15',NULL,350.00,'Picked Up'),(1002,5,'Michael','Garcia','M45678901','michael.garcia@outlook.com','+353 86 567 890','2024-08-10','2024-08-15','2024-08-25',NULL,750.00,'Picked Up'),(1003,7,'Liam','Wilson','L67890123','liam.wilson@example.com','+353 87 789 012','2024-08-20','2024-08-25','2024-09-05',NULL,950.00,'Picked Up'),(1004,10,'Olivia','Miller','O8901234','olivia.miller@example.com','+353 85 012 345','2024-08-22','2024-08-27','2024-09-07',NULL,1250.00,'Picked Up'),(1005,2,'Emily','Johnson','E23456789','emily.johnson@example.ie','+353 85 234 567','2024-08-17','2024-08-25','2024-09-05',NULL,450.00,'Reserved'),(1006,4,'Sophia','Brown','B34567890','sophia.brown@ukmail.com','+44 20 7123 456','2024-08-25','2024-09-01','2024-09-11',NULL,650.00,'Reserved'),(1007,6,'Isabella','Murphy','I56789012','isabella.murphy@irishmail.ie','+353 83 678 901','2024-08-30','2024-09-05','2024-09-15',NULL,850.00,'Reserved'),(1008,9,'David','Taylor','D7890123','david.taylor@domain.com','+353 86 901 234','2024-09-01','2024-09-10','2024-09-20',NULL,1150.00,'Reserved'),(1009,3,'Ahmed','Khan','A90123456','ahmed.khan@pakmail.com','+92 321 456 789','2024-08-05','2024-08-10','2024-08-20','2024-08-20',550.00,'Dropped Off'),(1010,8,'Emily','Davis','E012345600','emily.davis@usmail.com','+1 555 890 1234','2024-08-08','2024-08-15','2024-08-25','2024-08-25',1050.00,'Dropped Off');
/*!40000 ALTER TABLE `reservations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `types`
--

DROP TABLE IF EXISTS `types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `types` (
  `TypeID` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `TypeName` varchar(10) DEFAULT NULL,
  `DailyRate` decimal(5,2) DEFAULT NULL,
  PRIMARY KEY (`TypeID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `types`
--

LOCK TABLES `types` WRITE;
/*!40000 ALTER TABLE `types` DISABLE KEYS */;
INSERT INTO `types` VALUES (1,'Economy',45.00),(2,'Standard',60.00),(3,'Luxury',100.00),(4,'Sport',75.00),(5,'Minivan',90.00);
/*!40000 ALTER TABLE `types` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-08-18 17:35:22
