-- MySQL dump 10.13  Distrib 5.5.32, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: farmAfrica
-- ------------------------------------------------------
-- Server version	5.5.32-0ubuntu0.13.04.1

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
-- Table structure for table `inboundMessages`
--

DROP TABLE IF EXISTS `inboundMessages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inboundMessages` (
  `inboundMessageID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sourceAddress` varchar(15) DEFAULT NULL,
  `messageContent` text,
  `externalTransactionID` varchar(250) DEFAULT NULL,
  `status` int(11) unsigned NOT NULL DEFAULT '305',
  `dateCreated` datetime NOT NULL,
  `dateModified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`inboundMessageID`),
  UNIQUE KEY `externalTransactionID` (`externalTransactionID`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inboundMessages`
--

LOCK TABLES `inboundMessages` WRITE;
/*!40000 ALTER TABLE `inboundMessages` DISABLE KEYS */;
INSERT INTO `inboundMessages` VALUES (1,'254720512128','ENCORE test','10',306,'2013-08-03 10:31:17','2013-08-03 08:12:43'),(2,'254720512128','ENCORE tomatoes  Nairobi','16',306,'2013-08-03 10:31:17','2013-08-03 08:12:43'),(3,'254720512128','FARMAFRICA potatoes nakuru','17',306,'2013-08-03 10:31:17','2013-08-03 08:12:43'),(10,'254720512128','FARMAFRICA maize Mombasa','18',306,'2013-08-03 11:38:02','2013-08-03 08:38:03'),(35,'254728118599','Farmafrica tomatos nyeri\nVan someren erik desmond','19',306,'2013-08-03 11:58:02','2013-08-03 08:58:03'),(36,'254720167245','FARMAFRICA POTATOES NAIROBI','21',306,'2013-08-03 11:58:02','2013-08-03 08:58:03'),(37,'254728091976','FARMAFRICA potatoes nairobi','22',306,'2013-08-03 11:58:03','2013-08-03 08:58:03'),(38,'254717188449','Farmafrica sorghum kitale','23',306,'2013-08-03 11:58:03','2013-08-03 08:58:03'),(39,'254713004221','FARMAFRICA potatoes Nairobi','24',306,'2013-08-03 11:58:03','2013-08-03 08:58:03'),(40,'254726778628','FARMAFRICA potatoes','27',306,'2013-08-03 11:58:03','2013-08-03 08:58:03');
/*!40000 ALTER TABLE `inboundMessages` ENABLE KEYS */;
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
  `statusMessage` varchar(255) DEFAULT NULL,
  `dateCreated` datetime NOT NULL,
  `dateModified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `createdBy` int(11) unsigned NOT NULL,
  `modifiedBy` int(11) unsigned NOT NULL,
  PRIMARY KEY (`notificationID`),
  KEY `notificationTypeID` (`notificationTypeID`),
  CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`notificationTypeID`) REFERENCES `notificationTypes` (`notificationTypeID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT INTO `notifications` VALUES (1,1,'\n            <!DOCTYPE html>\n<html>\n	<head>\n		<title></title>\n		<meta charset=\"utf-8\" />\n		<style type=\"text/css\">\n			body {\n				font-family: \"Droid Sans\", \"Arial\", Sans-serif;\n				font-size: .9em;\n			}\n			header {\n				text-align: right;\n				font-size: 2em;\n				padding-bottom: 1%;\n				border-bottom: double purple;\n				color: darkgreen;\n			}\n			article{\n				padding: 1%;\n			}\n			.main-div{\n				background-color: #DCF5D4;\n				border-radius: 5px;\n				box-shadow: green 2px 2px 2px;\n				padding: 2%;\n			}\n			.intro{\n				font-size: 1.5em;\n				color: gray;\n			}\n		</style>\n	</head>\n	<body>\n		<div id=\"main\" class=\"main-div\">\n			<header>\n				\n			</header>\n			<article>\n				\n            <span class=\"intro\">Hello Test User!</span><br>\n                        <p>Your  Account has been created!</p>\n   \n		     	<p>Kindly follow this link (http://localhost/FarmAfrica/index.php/users/setPassword?e=dr@who.com&t=6bb96dd66eda3a77f1f798859e12c269d9367765) by clicking or pasting on your browser to access your account.</p>\n        \n                <p>\n                	You will be asked to choose a password, after which you will log in with the username: <strong>fmuya</strong>\n                </p>\n\n                <p>The link is valid only for 2 hour(s), after which it will expire. The link can only be used once.</p>\n            \n			</article>\n			<footer>\n				Best Regards,<br/>\n			   	The Good Guys at .<br/>\n\n			   	FarmAfrica LTD LTD.<br/>\n			   	<hr/>\n			   	This email is CONFIDENTIAL and was auto-generated by the  Application. Please do not reply.\n			</footer>\n		</div>\n	</body>\n</html>\n\n        ','dr@who.com','{\"fromEmailAddress\":\"\",\"fromName\":\"FarmAfrica\",\"subject\":\"User Account Information | New Account\"}',300,NULL,'2013-06-11 19:16:36','2013-06-11 16:16:36',1,1),(2,2,'Testing','254720512128',NULL,302,'{\"statusCode\":200,\"message\":\"Successfully sent SMS.\"}','2013-07-15 17:31:48','2013-07-15 16:02:03',1,1),(3,1,'\n            <!DOCTYPE html>\n<html>\n	<head>\n		<title></title>\n		<meta charset=\"utf-8\" />\n		<style type=\"text/css\">\n			body {\n				font-family: \"Droid Sans\", \"Arial\", Sans-serif;\n				font-size: .9em;\n			}\n			header {\n				text-align: right;\n				font-size: 2em;\n				padding-bottom: 1%;\n				border-bottom: double purple;\n				color: darkgreen;\n			}\n			article{\n				padding: 1%;\n			}\n			.main-div{\n				background-color: #DCF5D4;\n				border-radius: 5px;\n				box-shadow: green 2px 2px 2px;\n				padding: 2%;\n			}\n			.intro{\n				font-size: 1.5em;\n				color: gray;\n			}\n		</style>\n	</head>\n	<body>\n		<div id=\"main\" class=\"main-div\">\n			<header>\n				\n			</header>\n			<article>\n				\n            <span class=\"intro\">Hello Test User Onq!</span><br>\n                        <p>Your  Account has been created!</p>\n   \n		     	<p>Kindly follow this link (http://localhost/FarmAfrica/index.php/users/setPassword?e=UserOne@test.com&t=9e39ebd17436f808402d9fa8f9177b27b34b7109) by clicking or pasting on your browser to access your account.</p>\n        \n                <p>\n                	You will be asked to choose a password, after which you will log in with the username: <strong>testuser1</strong>\n                </p>\n\n                <p>The link is valid only for 2 hour(s), after which it will expire. The link can only be used once.</p>\n            \n			</article>\n			<footer>\n				Best Regards,<br/>\n			   	The Good Guys at .<br/>\n\n			   	FarmAfrica LTD.<br/>\n			   	<hr/>\n			   	This email is CONFIDENTIAL and was auto-generated by the FarmAfrica Application. Please do not reply.\n			</footer>\n		</div>\n	</body>\n</html>\n\n        ','UserOne@test.com','{\"fromEmailAddress\":\"no-reply@farmafrica.mygbiz.com\",\"fromName\":\"FarmAfrica\",\"subject\":\"User Account Information | New Account\"}',300,NULL,'2013-07-16 08:54:36','2013-07-16 05:54:36',1,1);
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `passwordRequests`
--

LOCK TABLES `passwordRequests` WRITE;
/*!40000 ALTER TABLE `passwordRequests` DISABLE KEYS */;
INSERT INTO `passwordRequests` VALUES (1,'6bb96dd66eda3a77f1f798859e12c269d9367765','dr@who.com',1,'2013-07-09 19:12:39',1,'2013-07-09 16:12:39',1),(2,'9e39ebd17436f808402d9fa8f9177b27b34b7109','UserOne@test.com',1,'2013-07-16 08:54:36',1,'2013-07-16 05:54:36',1);
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productTypes`
--

LOCK TABLES `productTypes` WRITE;
/*!40000 ALTER TABLE `productTypes` DISABLE KEYS */;
INSERT INTO `productTypes` VALUES (1,'Seeds',1,'2013-08-01 23:36:29',1,'2013-08-01 20:36:29',1);
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'Tomatoes','just tomatoes',1,1,'2013-08-02 23:17:11',1,'2013-08-02 20:17:11',1);
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services`
--

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` VALUES (1,'Query Products','Service to allow stakeholders to query particular products',1,'2013-08-03 10:50:54',1,'2013-08-03 07:50:54',1);
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `statusCategories`
--

LOCK TABLES `statusCategories` WRITE;
/*!40000 ALTER TABLE `statusCategories` DISABLE KEYS */;
INSERT INTO `statusCategories` VALUES (1,'General',1,'2013-05-17 15:00:43',1,'2013-05-17 12:00:43',1),(2,'API',1,'2013-05-17 16:50:36',1,'2013-05-17 13:50:36',1),(3,'Notifications',1,'2013-06-08 18:48:49',1,'2013-06-08 15:48:49',1),(4,'Users',1,'2013-07-03 19:09:14',1,'2013-07-03 16:09:14',1),(5,'Transactions',1,'2013-08-03 10:52:28',1,'2013-08-03 07:53:01',1);
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
INSERT INTO `statusCodes` VALUES (1,'Success',NULL,1,1,'2013-05-17 15:02:18',1,'2013-05-17 12:02:18',1),(2,'Failed',NULL,2,1,'2013-05-17 15:03:21',1,'2013-05-17 12:03:21',1),(200,'Requested model not found','Model in API request cannot be found',2,2,'2013-05-17 16:52:07',1,'2013-05-17 13:52:07',1),(201,'Model not provided','Model not provided in API request',2,2,'2013-05-17 16:54:27',1,'2013-05-17 13:54:27',1),(202,'Model attributes not provided',NULL,2,2,'2013-05-18 12:38:41',1,'2013-05-18 09:38:41',1),(203,'Model error occurred during create',NULL,2,2,'2013-05-18 13:07:20',1,'2013-05-18 10:07:20',1),(204,'Model created successfully',NULL,1,2,'2013-05-18 13:11:46',1,'2013-05-18 10:11:46',1),(205,'Requested record does not exist',NULL,2,2,'2013-05-18 14:51:58',1,'2013-05-18 11:51:58',1),(206,'Unable to parse model attributes',NULL,2,2,'2013-05-20 12:27:14',1,'2013-05-20 09:27:14',1),(207,'Model error occurred during update',NULL,2,2,'2013-05-20 14:28:57',1,'2013-05-20 11:28:57',1),(208,'Model updated successfully',NULL,1,2,'2013-05-20 14:34:03',1,'2013-05-20 11:34:03',1),(209,'Model error occurred during delete',NULL,2,2,'2013-05-20 16:00:11',1,'2013-05-20 13:00:11',1),(210,'User does not exist',NULL,2,2,'2013-06-08 18:01:11',1,'2013-06-08 15:01:11',1),(300,'New Notification','New notification',1,3,'2013-06-08 18:50:42',1,'2013-06-08 15:50:42',1),(301,'Failed to Send SMS notification',NULL,2,3,'2013-07-15 18:34:26',1,'2013-07-15 15:34:26',1),(302,'SMS Notification sent successfully',NULL,1,3,'2013-07-15 18:34:44',1,'2013-07-15 15:34:44',1),(303,'Poll SMS failed','Failed to poll for SMS',2,3,'2013-08-03 00:24:15',1,'2013-08-02 21:24:15',1),(304,'Poll SMS success','SMSes polled successfully from API',1,3,'2013-08-03 00:35:21',1,'2013-08-02 21:35:21',1),(305,'Unprocessed inbound SMS','Unprocessed inbound SMS',1,3,'2013-08-03 01:30:33',1,'2013-08-02 22:30:33',1),(306,'Successfully Processed inbound SMS',NULL,1,3,'2013-08-03 11:11:26',1,'2013-08-03 08:11:26',1),(400,'User password token expired','User password token expired',2,4,'2013-07-06 10:48:12',1,'2013-07-06 07:48:12',1),(401,'User password token does not exist','User password token does not exist',2,4,'2013-07-06 10:48:41',1,'2013-07-06 07:48:41',1),(402,'User password token is valid','User password token is valid',1,4,'2013-07-06 11:52:47',1,'2013-07-06 08:52:47',1),(403,'User password token is used','User password token is used',2,4,'2013-07-06 12:25:11',1,'2013-07-06 09:25:11',1),(500,'Unprocessed transaction',NULL,1,5,'2013-08-03 10:54:18',1,'2013-08-03 07:54:18',1);
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
  `initiatorMSISDN` varchar(15) DEFAULT NULL,
  `receiverID` int(11) unsigned DEFAULT NULL,
  `status` int(11) unsigned NOT NULL,
  `dateCreated` datetime NOT NULL,
  `dateModified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`transactionID`),
  KEY `serviceID` (`serviceID`),
  KEY `initiatorID` (`initiatorID`),
  KEY `receiverID` (`receiverID`),
  KEY `productID` (`productID`),
  CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`serviceID`) REFERENCES `services` (`serviceID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `transactions_ibfk_2` FOREIGN KEY (`initiatorID`) REFERENCES `users` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `transactions_ibfk_3` FOREIGN KEY (`receiverID`) REFERENCES `users` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `transactions_ibfk_4` FOREIGN KEY (`productID`) REFERENCES `products` (`productID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactions`
--

LOCK TABLES `transactions` WRITE;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
INSERT INTO `transactions` VALUES (1,1,NULL,NULL,'254720512128',NULL,500,'2013-08-03 11:12:43','2013-08-03 08:12:43'),(2,1,NULL,NULL,'254720512128',NULL,500,'2013-08-03 11:12:43','2013-08-03 08:12:43'),(3,1,NULL,NULL,'254720512128',NULL,500,'2013-08-03 11:12:43','2013-08-03 08:12:43'),(4,1,NULL,NULL,'254720512128',NULL,500,'2013-08-03 11:38:03','2013-08-03 08:38:03'),(5,1,NULL,NULL,'254728118599',NULL,500,'2013-08-03 11:58:03','2013-08-03 08:58:03'),(6,1,NULL,NULL,'254720167245',NULL,500,'2013-08-03 11:58:03','2013-08-03 08:58:03'),(7,1,NULL,NULL,'254728091976',NULL,500,'2013-08-03 11:58:03','2013-08-03 08:58:03'),(8,1,NULL,NULL,'254717188449',NULL,500,'2013-08-03 11:58:03','2013-08-03 08:58:03'),(9,1,NULL,NULL,'254713004221',NULL,500,'2013-08-03 11:58:03','2013-08-03 08:58:03'),(10,1,NULL,NULL,'254726778628',NULL,500,'2013-08-03 11:58:03','2013-08-03 08:58:03');
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userGroupMappings`
--

LOCK TABLES `userGroupMappings` WRITE;
/*!40000 ALTER TABLE `userGroupMappings` DISABLE KEYS */;
INSERT INTO `userGroupMappings` VALUES (1,13,1,1,'2013-07-20 12:02:29',2,'2013-07-20 09:05:38',2),(6,11,1,1,'2013-07-20 12:11:43',2,'2013-07-20 09:11:43',2);
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
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (11,'muya','Fred','Muya','kingkonig@gmail.com','254720512190','',1,'2013-05-18 13:22:39',11,'2013-06-16 10:48:02',11),(13,'alan','Alan','Gitau','alan.g@home.com','254720512122','',1,'2013-05-18 15:03:00',11,'2013-06-16 10:48:02',11),(14,'c4a','Coders','Africa Kenya','coders@africa.com','254734556778','',1,'2013-05-25 10:10:29',11,'2013-06-16 10:48:02',11),(15,'test','user','one','user@me.com','254720512128','',1,'2013-06-08 17:38:03',11,'2013-06-16 10:48:02',11),(32,'fmuya','Test','User','dr@who.com','254720512130','',1,'2013-06-11 19:16:35',11,'2013-06-16 10:48:02',11),(33,'testuser1','Test','User Onq','UserOne@test.com','','',1,'2013-07-16 08:54:35',1,'2013-07-16 05:54:35',1);
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

-- Dump completed on 2013-08-09 10:06:36
