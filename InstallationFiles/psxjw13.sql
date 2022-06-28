CREATE DATABASE  IF NOT EXISTS `psxjw13_C1B` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `psxjw13_C1B`;
-- MySQL dump 10.13  Distrib 5.6.24, for Win32 (x86)
--
-- Host: mysql.cs.nott.ac.uk    Database: psxjw13_C1B
-- ------------------------------------------------------
-- Server version	5.5.60-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Fines`
--

DROP TABLE IF EXISTS `Fines`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Fines` (
  `Fine_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Fine_Amount` int(11) NOT NULL,
  `Fine_Points` int(11) NOT NULL,
  `Incident_ID` int(11) NOT NULL,
  PRIMARY KEY (`Fine_ID`),
  KEY `Incident_ID` (`Incident_ID`),
  CONSTRAINT `fk_fines` FOREIGN KEY (`Incident_ID`) REFERENCES `Incident` (`Incident_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Fines`
--

LOCK TABLES `Fines` WRITE;
/*!40000 ALTER TABLE `Fines` DISABLE KEYS */;
INSERT INTO `Fines` VALUES (1,2000,6,3),(2,50,0,2),(3,500,3,4);
/*!40000 ALTER TABLE `Fines` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Incident`
--

DROP TABLE IF EXISTS `Incident`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Incident` (
  `Incident_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Vehicle_ID` int(11) DEFAULT NULL,
  `People_ID` int(11) DEFAULT NULL,
  `Incident_Date` date NOT NULL,
  `Incident_Report` varchar(500) NOT NULL,
  `Offence_ID` int(11) DEFAULT NULL,
  PRIMARY KEY (`Incident_ID`),
  KEY `fk_incident_vehicle` (`Vehicle_ID`),
  KEY `fk_incident_people` (`People_ID`),
  KEY `fk_incident_offence` (`Offence_ID`),
  CONSTRAINT `fk_incident_offence` FOREIGN KEY (`Offence_ID`) REFERENCES `Offence` (`Offence_ID`),
  CONSTRAINT `fk_incident_people` FOREIGN KEY (`People_ID`) REFERENCES `People` (`People_ID`),
  CONSTRAINT `fk_incident_vehicle` FOREIGN KEY (`Vehicle_ID`) REFERENCES `Vehicle` (`Vehicle_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Incident`
--

LOCK TABLES `Incident` WRITE;
/*!40000 ALTER TABLE `Incident` DISABLE KEYS */;
INSERT INTO `Incident` VALUES (1,15,4,'2017-12-01','40mph in a 30 limit',1),(2,20,8,'2017-11-01','Double parked',4),(3,13,4,'2017-09-17','110mph on motorway',1),(4,14,2,'2017-08-22','Failure to stop at a red light - travelling 25mph',8),(5,13,4,'2017-10-17','Not wearing a seatbelt on the M1',3);
/*!40000 ALTER TABLE `Incident` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Login_Details`
--

DROP TABLE IF EXISTS `Login_Details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Login_Details` (
  `Username` varchar(20) NOT NULL,
  `password` varchar(45) NOT NULL,
  `Admin` int(11) NOT NULL,
  PRIMARY KEY (`Username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Login_Details`
--

LOCK TABLES `Login_Details` WRITE;
/*!40000 ALTER TABLE `Login_Details` DISABLE KEYS */;
INSERT INTO `Login_Details` VALUES ('Daniels','copper99',1),('McNulty','plod123',0),('Moreland','fuzz42',0);
/*!40000 ALTER TABLE `Login_Details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Offence`
--

DROP TABLE IF EXISTS `Offence`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Offence` (
  `Offence_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Offence_description` varchar(50) NOT NULL,
  `Offence_maxFine` int(11) NOT NULL,
  `Offence_maxPoints` int(11) NOT NULL,
  PRIMARY KEY (`Offence_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Offence`
--

LOCK TABLES `Offence` WRITE;
/*!40000 ALTER TABLE `Offence` DISABLE KEYS */;
INSERT INTO `Offence` VALUES (1,'Speeding',1000,3),(2,'Speeding on a motorway',2500,6),(3,'Seat belt offence',500,0),(4,'Illegal parking',500,0),(5,'Drink driving',10000,11),(6,'Driving without a licence',10000,0),(7,'Driving without a licence',10000,0),(8,'Traffic light offences',1000,3),(9,'Cycling on pavement',500,0),(10,'Failure to have control of vehicle',1000,3),(11,'Dangerous driving',1000,11),(12,'Careless driving',5000,6),(13,'Dangerous cycling',2500,0);
/*!40000 ALTER TABLE `Offence` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `People`
--

DROP TABLE IF EXISTS `People`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `People` (
  `People_ID` int(11) NOT NULL AUTO_INCREMENT,
  `People_First_Name` varchar(45) NOT NULL,
  `People_Second_Name` varchar(45) NOT NULL,
  `People_address` varchar(50) DEFAULT NULL,
  `People_licence` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`People_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `People`
--

LOCK TABLES `People` WRITE;
/*!40000 ALTER TABLE `People` DISABLE KEYS */;
INSERT INTO `People` VALUES (1,'James','Smith','23 Barnsdale Road, Leicester','SMITH92LDOFJJ829'),(2,'Jennifer','Allen','46 Bramcote Drive, Nottingham','ALLEN88K23KLR9B3'),(3,'John','Myers','323 Derby Road, Nottingham','MYERS99JDW8REWL3'),(4,'James','Smith','26 Devonshire Avenue, Nottingham','SMITHR004JFS20TR'),(5,'Terry','Brown','7 Clarke Rd, Nottingham','BROWND3PJJ39DLFG'),(6,'Mary','Adams','38 Thurman St, Nottingham','ADAMSH9O3JRHH107'),(7,'Neil','Becker','6 Fairfax Close, Nottingham','BECKE88UPR840F9R'),(8,'Angela','Smith','30 Avenue Road, Grantham','SMITH222LE9FJ5DS'),(9,'Xene','Medora','22 House Drive, West Bridgford','MEDORH914ANBB223');
/*!40000 ALTER TABLE `People` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Vehicle`
--

DROP TABLE IF EXISTS `Vehicle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Vehicle` (
  `Vehicle_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Vehicle_type` varchar(20) NOT NULL,
  `Vehicle_colour` varchar(20) NOT NULL,
  `Vehicle_licence` varchar(7) DEFAULT NULL,
  `People_ID` int(11) DEFAULT NULL,
  PRIMARY KEY (`Vehicle_ID`),
  KEY `FK_People` (`People_ID`),
  CONSTRAINT `FK_People` FOREIGN KEY (`People_ID`) REFERENCES `People` (`People_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Vehicle`
--

LOCK TABLES `Vehicle` WRITE;
/*!40000 ALTER TABLE `Vehicle` DISABLE KEYS */;
INSERT INTO `Vehicle` VALUES (12,'Ford Fiesta','Blue','LB15AJL',3),(13,'Ferrari 458','Red','MY64PRE',4),(14,'Vauxhall Astra','Silver','FD65WPQ',2),(15,'Honda Civic','Green','FJ17AUG',4),(16,'Toyota Prius','Silver','FP16KKE',1),(17,'Ford Mondeo','Black','FP66KLM',5),(18,'Ford Focus','White','DJ14SLE',6),(20,'Nissan Pulsar','Red','NY64KWD',8),(21,'Renault Scenic','Silver','BC16OEA',7),(22,'Hyundai i30','Grey','AD223NG',NULL);
/*!40000 ALTER TABLE `Vehicle` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-12-22 20:59:26
