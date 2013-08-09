create table if not exists inboundMessages(
	`inboundMessageID` int(11) unsigned primary key auto_increment,
	`sourceAddress` varchar(15) DEFAULT NULL,
	`messageContent` text DEFAULT NULL,
	`externalTransactionID` varchar(250) UNIQUE DEFAULT NULL,
	`status` int(11) unsigned NOT NULL DEFAULT 305,
	`dateCreated` datetime NOT NULL,
	`dateModified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;