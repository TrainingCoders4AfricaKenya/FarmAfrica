-- MySQL dump 10.13  Distrib 5.5.31, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: farmAfrica
-- ------------------------------------------------------
-- Server version	5.5.31-0ubuntu0.13.04.1

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
-- Table structure for table `entityActions`
--

DROP TABLE IF EXISTS `entityActions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `entityActions` (
  `entityActionID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `entityActionName` varchar(20) NOT NULL,
  `description` varchar(200) NOT NULL,
  `status` int(11) unsigned NOT NULL,
  `dateCreated` datetime NOT NULL,
  `createdBy` int(11) unsigned NOT NULL,
  `dateModified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modifiedBy` int(11) unsigned NOT NULL,
  PRIMARY KEY (`entityActionID`),
  UNIQUE KEY `entityActionName` (`entityActionName`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entityActions`
--

LOCK TABLES `entityActions` WRITE;
/*!40000 ALTER TABLE `entityActions` DISABLE KEYS */;
/*!40000 ALTER TABLE `entityActions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups` (
  `groupID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `groupName` varchar(45) NOT NULL,
  `description` varchar(200) NOT NULL,
  `status` int(11) unsigned NOT NULL,
  `dateCreated` datetime NOT NULL,
  `createdBy` int(11) unsigned NOT NULL,
  `dateModified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modifiedBy` int(11) unsigned NOT NULL,
  PRIMARY KEY (`groupID`),
  UNIQUE KEY `groupName` (`groupName`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` VALUES (1,'Super Administrators','Super Admin Group',1,'2013-05-31 18:36:00',2,'2013-05-31 15:36:18',2);
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `moduleActions`
--

DROP TABLE IF EXISTS `moduleActions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `moduleActions` (
  `moduleActionID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `moduleID` int(11) unsigned NOT NULL,
  `entityActionID` int(11) unsigned NOT NULL,
  `status` int(11) unsigned NOT NULL,
  `dateCreated` datetime NOT NULL,
  `createdBy` int(11) unsigned NOT NULL,
  `dateModified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modifiedBy` int(11) unsigned NOT NULL,
  PRIMARY KEY (`moduleActionID`),
  UNIQUE KEY `moduleAction` (`moduleID`,`entityActionID`),
  KEY `entityActionID` (`entityActionID`),
  CONSTRAINT `moduleActions_ibfk_1` FOREIGN KEY (`moduleID`) REFERENCES `modules` (`moduleID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `moduleActions_ibfk_2` FOREIGN KEY (`entityActionID`) REFERENCES `entityActions` (`entityActionID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `moduleActions`
--

LOCK TABLES `moduleActions` WRITE;
/*!40000 ALTER TABLE `moduleActions` DISABLE KEYS */;
/*!40000 ALTER TABLE `moduleActions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `modules`
--

DROP TABLE IF EXISTS `modules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `modules` (
  `moduleID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `moduleName` varchar(45) NOT NULL,
  `description` varchar(200) NOT NULL,
  `status` int(11) unsigned NOT NULL,
  `dateCreated` datetime NOT NULL,
  `createdBy` int(11) unsigned NOT NULL,
  `dateModified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modifiedBy` int(11) unsigned NOT NULL,
  PRIMARY KEY (`moduleID`),
  UNIQUE KEY `moduleName` (`moduleName`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `modules`
--

LOCK TABLES `modules` WRITE;
/*!40000 ALTER TABLE `modules` DISABLE KEYS */;
/*!40000 ALTER TABLE `modules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notificationTypes`
--

DROP TABLE IF EXISTS `notificationTypes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notificationTypes` (
  `notificationTypeID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `notificationTypeName` varchar(30) NOT NULL,
  `status` int(11) unsigned NOT NULL,
  `dateCreated` datetime NOT NULL,
  `createdBy` int(11) unsigned NOT NULL,
  `dateModified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modifiedBy` int(11) unsigned NOT NULL,
  PRIMARY KEY (`notificationTypeID`),
  UNIQUE KEY `notificationTypeName` (`notificationTypeName`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notificationTypes`
--

LOCK TABLES `notificationTypes` WRITE;
/*!40000 ALTER TABLE `notificationTypes` DISABLE KEYS */;
INSERT INTO `notificationTypes` VALUES (1,'Email',1,'2013-06-08 18:46:41',1,'2013-06-08 15:46:41',1),(2,'SMS',1,'2013-06-08 18:46:47',1,'2013-06-08 15:46:47',1);
/*!40000 ALTER TABLE `notificationTypes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notifications` (
  `notificationID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `notificationTypeID` int(11) unsigned NOT NULL,
  `message` text,
  `destinationAddress` varchar(100) DEFAULT NULL,
  `messageDetails` text,
  `status` int(11) unsigned NOT NULL,
  `dateCreated` datetime NOT NULL,
  `dateModified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `createdBy` int(11) unsigned NOT NULL,
  `modifiedBy` int(11) unsigned NOT NULL,
  PRIMARY KEY (`notificationID`),
  KEY `notificationTypeID` (`notificationTypeID`),
  CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`notificationTypeID`) REFERENCES `notificationTypes` (`notificationTypeID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `passwordRequests`
--

DROP TABLE IF EXISTS `passwordRequests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `passwordRequests` (
  `passwordRequestID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `token` varchar(256) NOT NULL,
  `identifier` varchar(150) NOT NULL,
  `status` int(11) unsigned NOT NULL,
  `dateCreated` datetime NOT NULL,
  `createdBy` int(11) unsigned NOT NULL,
  `dateModified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modifiedBy` int(11) unsigned NOT NULL,
  PRIMARY KEY (`passwordRequestID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `passwordRequests`
--

LOCK TABLES `passwordRequests` WRITE;
/*!40000 ALTER TABLE `passwordRequests` DISABLE KEYS */;
/*!40000 ALTER TABLE `passwordRequests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `permissionID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `moduleActionID` int(11) unsigned NOT NULL,
  `groupID` int(11) unsigned NOT NULL,
  `status` int(11) unsigned NOT NULL,
  `dateCreated` datetime NOT NULL,
  `createdBy` int(11) unsigned NOT NULL,
  `dateModified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modifiedBy` int(11) unsigned NOT NULL,
  PRIMARY KEY (`permissionID`),
  UNIQUE KEY `permission` (`moduleActionID`,`groupID`),
  KEY `groupID` (`groupID`),
  CONSTRAINT `permissions_ibfk_1` FOREIGN KEY (`moduleActionID`) REFERENCES `moduleActions` (`moduleActionID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `permissions_ibfk_2` FOREIGN KEY (`groupID`) REFERENCES `groups` (`groupID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productTypes`
--

DROP TABLE IF EXISTS `productTypes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `productTypes` (
  `productTypeID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `productTypeName` varchar(45) NOT NULL,
  `status` int(11) unsigned NOT NULL,
  `dateCreated` datetime NOT NULL,
  `createdBy` int(11) unsigned NOT NULL,
  `dateModified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modifiedBy` int(11) unsigned NOT NULL,
  PRIMARY KEY (`productTypeID`),
  UNIQUE KEY `productTypeName` (`productTypeName`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productTypes`
--

LOCK TABLES `productTypes` WRITE;
/*!40000 ALTER TABLE `productTypes` DISABLE KEYS */;
/*!40000 ALTER TABLE `productTypes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `productID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `productName` varchar(45) NOT NULL,
  `description` varchar(200) NOT NULL,
  `productTypeID` int(11) unsigned NOT NULL,
  `status` int(11) unsigned NOT NULL,
  `dateCreated` datetime NOT NULL,
  `createdBy` int(11) unsigned NOT NULL,
  `dateModified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modifiedBy` int(11) unsigned NOT NULL,
  PRIMARY KEY (`productID`),
  UNIQUE KEY `productName` (`productName`),
  KEY `productTypeID` (`productTypeID`),
  CONSTRAINT `products_ibfk_1` FOREIGN KEY (`productTypeID`) REFERENCES `productTypes` (`productTypeID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `services` (
  `serviceID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `serviceName` varchar(45) NOT NULL,
  `description` varchar(200) NOT NULL,
  `status` int(11) unsigned NOT NULL,
  `dateCreated` datetime NOT NULL,
  `createdBy` int(11) unsigned NOT NULL,
  `dateModified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modifiedBy` int(11) unsigned NOT NULL,
  PRIMARY KEY (`serviceID`),
  UNIQUE KEY `serviceName` (`serviceName`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services`
--

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
/*!40000 ALTER TABLE `services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `statusCategories`
--

DROP TABLE IF EXISTS `statusCategories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `statusCategories` (
  `statusCategoryID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `categoryName` varchar(30) NOT NULL,
  `status` int(11) unsigned NOT NULL,
  `dateCreated` datetime NOT NULL,
  `createdBy` int(11) unsigned NOT NULL,
  `dateModified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modifiedBy` int(11) unsigned NOT NULL,
  PRIMARY KEY (`statusCategoryID`),
  UNIQUE KEY `categoryName` (`categoryName`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `statusCategories`
--

LOCK TABLES `statusCategories` WRITE;
/*!40000 ALTER TABLE `statusCategories` DISABLE KEYS */;
INSERT INTO `statusCategories` VALUES (1,'General',1,'2013-05-17 15:00:43',1,'2013-05-17 12:00:43',1),(2,'API',1,'2013-05-17 16:50:36',1,'2013-05-17 13:50:36',1),(3,'Notifications',1,'2013-06-08 18:48:49',1,'2013-06-08 15:48:49',1);
/*!40000 ALTER TABLE `statusCategories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `statusCodes`
--

DROP TABLE IF EXISTS `statusCodes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `statusCodes` (
  `statusID` int(11) unsigned NOT NULL,
  `statusDesc` varchar(150) NOT NULL,
  `description` text,
  `statusTypeID` int(11) unsigned NOT NULL,
  `statusCategoryID` int(11) unsigned NOT NULL,
  `dateCreated` datetime NOT NULL,
  `createdBy` int(11) unsigned NOT NULL,
  `dateModified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modifiedBy` int(11) unsigned NOT NULL,
  PRIMARY KEY (`statusID`),
  UNIQUE KEY `statusDesc` (`statusDesc`),
  UNIQUE KEY `statusDesc_2` (`statusDesc`),
  KEY `statusTypeID` (`statusTypeID`),
  KEY `statusCategoryID` (`statusCategoryID`),
  CONSTRAINT `statusCodes_ibfk_1` FOREIGN KEY (`statusTypeID`) REFERENCES `statusTypes` (`statusTypeID`),
  CONSTRAINT `statusCodes_ibfk_2` FOREIGN KEY (`statusCategoryID`) REFERENCES `statusCategories` (`statusCategoryID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `statusCodes`
--

LOCK TABLES `statusCodes` WRITE;
/*!40000 ALTER TABLE `statusCodes` DISABLE KEYS */;
INSERT INTO `statusCodes` VALUES (1,'Success',NULL,1,1,'2013-05-17 15:02:18',1,'2013-05-17 12:02:18',1),(2,'Failed',NULL,2,1,'2013-05-17 15:03:21',1,'2013-05-17 12:03:21',1),(200,'Requested model not found','Model in API request cannot be found',2,2,'2013-05-17 16:52:07',1,'2013-05-17 13:52:07',1),(201,'Model not provided','Model not provided in API request',2,2,'2013-05-17 16:54:27',1,'2013-05-17 13:54:27',1),(202,'Model attributes not provided',NULL,2,2,'2013-05-18 12:38:41',1,'2013-05-18 09:38:41',1),(203,'Model error occurred during create',NULL,2,2,'2013-05-18 13:07:20',1,'2013-05-18 10:07:20',1),(204,'Model created successfully',NULL,1,2,'2013-05-18 13:11:46',1,'2013-05-18 10:11:46',1),(205,'Requested record does not exist',NULL,2,2,'2013-05-18 14:51:58',1,'2013-05-18 11:51:58',1),(206,'Unable to parse model attributes',NULL,2,2,'2013-05-20 12:27:14',1,'2013-05-20 09:27:14',1),(207,'Model error occurred during update',NULL,2,2,'2013-05-20 14:28:57',1,'2013-05-20 11:28:57',1),(208,'Model updated successfully',NULL,1,2,'2013-05-20 14:34:03',1,'2013-05-20 11:34:03',1),(209,'Model error occurred during delete',NULL,2,2,'2013-05-20 16:00:11',1,'2013-05-20 13:00:11',1),(210,'User does not exist',NULL,2,2,'2013-06-08 18:01:11',1,'2013-06-08 15:01:11',1),(300,'New Notification','New notification',1,3,'2013-06-08 18:50:42',1,'2013-06-08 15:50:42',1);
/*!40000 ALTER TABLE `statusCodes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `statusTypes`
--

DROP TABLE IF EXISTS `statusTypes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `statusTypes` (
  `statusTypeID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `statusTypeName` varchar(30) NOT NULL,
  `status` int(11) unsigned NOT NULL,
  `dateCreated` datetime NOT NULL,
  `createdBy` int(11) unsigned NOT NULL,
  `dateModified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modifiedBy` int(11) unsigned NOT NULL,
  PRIMARY KEY (`statusTypeID`),
  UNIQUE KEY `statusTypeName` (`statusTypeName`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `statusTypes`
--

LOCK TABLES `statusTypes` WRITE;
/*!40000 ALTER TABLE `statusTypes` DISABLE KEYS */;
INSERT INTO `statusTypes` VALUES (1,'SUCCESS',1,'2013-05-17 15:01:37',1,'2013-05-17 12:01:37',1),(2,'FAILED',1,'2013-05-17 15:03:02',1,'2013-05-17 12:03:02',1);
/*!40000 ALTER TABLE `statusTypes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transactions` (
  `transactionID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `serviceID` int(11) unsigned DEFAULT NULL,
  `productID` int(11) unsigned DEFAULT NULL,
  `initiatorID` int(11) unsigned DEFAULT NULL,
  `receiverID` int(11) unsigned DEFAULT NULL,
  `status` int(11) unsigned NOT NULL,
  `dateCreated` datetime NOT NULL,
  `createdBy` int(11) unsigned NOT NULL,
  `dateModified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modifiedBy` int(11) unsigned NOT NULL,
  PRIMARY KEY (`transactionID`),
  KEY `serviceID` (`serviceID`),
  KEY `initiatorID` (`initiatorID`),
  KEY `receiverID` (`receiverID`),
  KEY `productID` (`productID`),
  CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`serviceID`) REFERENCES `services` (`serviceID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `transactions_ibfk_2` FOREIGN KEY (`initiatorID`) REFERENCES `users` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `transactions_ibfk_3` FOREIGN KEY (`receiverID`) REFERENCES `users` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `transactions_ibfk_4` FOREIGN KEY (`productID`) REFERENCES `products` (`productID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactions`
--

LOCK TABLES `transactions` WRITE;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userGroupMappings`
--

DROP TABLE IF EXISTS `userGroupMappings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `userGroupMappings` (
  `userGroupMappingID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userID` int(11) unsigned NOT NULL,
  `groupID` int(11) unsigned NOT NULL,
  `status` int(11) unsigned NOT NULL,
  `dateCreated` datetime NOT NULL,
  `createdBy` int(11) unsigned NOT NULL,
  `dateModified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modifiedBy` int(11) unsigned NOT NULL,
  PRIMARY KEY (`userGroupMappingID`),
  KEY `userID` (`userID`),
  KEY `groupID` (`groupID`),
  CONSTRAINT `userGroupMappings_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `userGroupMappings_ibfk_2` FOREIGN KEY (`groupID`) REFERENCES `groups` (`groupID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userGroupMappings`
--

LOCK TABLES `userGroupMappings` WRITE;
/*!40000 ALTER TABLE `userGroupMappings` DISABLE KEYS */;
/*!40000 ALTER TABLE `userGroupMappings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userProfiles`
--

DROP TABLE IF EXISTS `userProfiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `userProfiles` (
  `userProfileID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userID` int(11) unsigned NOT NULL,
  `dateOfBirth` datetime DEFAULT NULL,
  `dateCreated` datetime NOT NULL,
  `createdBy` int(11) unsigned NOT NULL,
  `dateModified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modifiedBy` int(11) unsigned NOT NULL,
  PRIMARY KEY (`userProfileID`),
  UNIQUE KEY `userID` (`userID`),
  CONSTRAINT `userProfiles_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userProfiles`
--

LOCK TABLES `userProfiles` WRITE;
/*!40000 ALTER TABLE `userProfiles` DISABLE KEYS */;
/*!40000 ALTER TABLE `userProfiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `userID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userName` varchar(30) NOT NULL,
  `firstName` varchar(45) NOT NULL,
  `lastName` varchar(45) NOT NULL,
  `emailAddress` varchar(100) DEFAULT NULL,
  `phoneNumber` varchar(15) DEFAULT NULL,
  `password` varchar(256) NOT NULL,
  `status` int(11) unsigned NOT NULL,
  `dateCreated` datetime NOT NULL,
  `createdBy` int(11) unsigned NOT NULL,
  `dateModified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modifiedBy` int(11) unsigned NOT NULL,
  PRIMARY KEY (`userID`),
  UNIQUE KEY `userName` (`userName`),
  UNIQUE KEY `emailAddress` (`emailAddress`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (11,'muya','Fred','Muya','kingkonig@gmail.com','254720512190','',1,'2013-05-18 13:22:39',2,'2013-06-08 14:40:33',2),(13,'alan','Alan','Gitau','alan.g@home.com','254720512122','',1,'2013-05-18 15:03:00',2,'2013-05-18 12:03:00',2),(14,'c4a','Coders','Africa Kenya','coders@africa.com','254734556778','',1,'2013-05-25 10:10:29',2,'2013-06-08 14:39:53',2),(15,'test','user','one','user@me.com','254720512128','',1,'2013-06-08 17:38:03',2,'2013-06-08 14:38:03',2);
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

-- Dump completed on 2013-06-10 18:28:28
