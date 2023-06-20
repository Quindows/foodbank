drop database if exists `foodbank`;
create database `foodbank`;

use `foodbank`;

-- Supplier
drop table if exists `supplier`;
create table `supplier`(
	`Id`			INT				NOT NULL			AUTO_INCREMENT PRIMARY KEY,
    `CompanyName`	VARCHAR(50)		NOT NULL,
    `Address`		VARCHAR(50)		NOT NULL,
	`Email`			VARCHAR(50)		NOT NULL,
    `Phonenumber`	VARCHAR(10)		NOT NULL,
	`IsActive` 		TINYINT(1) 		NOT NULL 			DEFAULT 1,
    `Description` 	TEXT			NULL,
    `DateCreated`	TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `DateUpdated` 	TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=INNODB;

INSERT INTO `supplier`(
	`CompanyName`, `Address`, `Email`, `PhoneNumber`)
VALUES 
	('DHL', 'Daltonlaan 400', 'DHL@support.nl', '0611223344'),
    ('Sligro', 'Benschop 31', 'Sligro@support.nl', '0613223344'),
    ('Makro', 'Ijselstein 2', 'Makro@support.nl', '0612223344');
    
-- Delivery
drop table if exists `delivery`;
create table `delivery`(
	`Id`			INT				NOT NULL			AUTO_INCREMENT PRIMARY KEY,
    `Status`		VARCHAR(50)		NOT NULL,
    `TimeOfDeparture`DATETIME       NOT NULL,
	`TimeOfArrival`	DATETIME		NOT NULL,
	`IsActive` 		TINYINT(1) 		NOT NULL 			DEFAULT 1,
    `Description` 	TEXT			NULL,
    `DateCreated`	TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `DateUpdated` 	TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=INNODB;

-- Delivery and Supplier table
drop table if exists `deliverySupplier`;
create table `deliverySupplier`(
	`Id`			INT				NOT NULL			AUTO_INCREMENT PRIMARY KEY,
	`SupplierId`	INT,
    `DeliveryId`	INT,
	`IsActive` 		TINYINT(1) 		NOT NULL 			DEFAULT 1,
    `Description` 	TEXT			NULL,
    `DateCreated`	TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `DateUpdated` 	TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT DeliverySupplier_Supplier FOREIGN KEY (`SupplierId`) REFERENCES `supplier`(`Id`),
	CONSTRAINT DeliverySupplier_Delivery FOREIGN KEY (`DeliveryId`) REFERENCES `delivery`(`Id`)
) ENGINE=INNODB;


-- Person
drop table if exists `person`;
create table `person`(
	`Id`			INT				NOT NULL			AUTO_INCREMENT PRIMARY KEY,
    `Callname`		VARCHAR(50)		NOT NULL,
    `Infix`			VARCHAR(10)		NULL,
	`LastName`		VARCHAR(50)		NOT NULL,
	`IsActive` 		TINYINT(1) 		NOT NULL 			DEFAULT 1,
    `Description` 	TEXT			NULL,
    `DateCreated`	TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `DateUpdated` 	TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=INNODB;

INSERT INTO `person`(
	`Callname`, `Infix`, `lastname`)
VALUES 
	('Levi', null, 'tas'),
    ('Daan', 'de', 'Bruijn'),
    ('Claudia', null, 'Nijholt'),
    ('Quintin', null, 'Blume');

-- User
drop table if exists `user`;
create table `user` (	
	`Id`			INT				NOT NULL			AUTO_INCREMENT PRIMARY KEY,
    `PersonId`		INT,
    `Password`		VARCHAR(10)		NOT NULL,
	`IsActive` 		TINYINT(1) 		NOT NULL 			DEFAULT 1,
    `Description` 	TEXT			NULL,
    `DateCreated`	TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `DateUpdated` 	TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT User_Person FOREIGN KEY (`PersonId`) REFERENCES `person`(`Id`)
) ENGINE=INNODB;

INSERT INTO `user`(
	`PersonId`, `Password`)
VALUES 
	('1', 'test1'),
    ('2', 'test2'),
    ('3', 'test3'),
    ('4', 'test4');

-- Role
drop table if exists `role`;
create table `role`(
	`Id`			INT				NOT NULL			AUTO_INCREMENT PRIMARY KEY,
    `Name`			VARCHAR(50)		NOT NULL,
	`IsActive` 		TINYINT(1) 		NOT NULL 			DEFAULT 1,
    `Description` 	TEXT			NULL,
    `DateCreated`	TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `DateUpdated` 	TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=INNODB;

INSERT INTO `role`(
	`Name`)
VALUES 
	('Management'),
    ('Warehouse employee'),
    ('volunteer');

-- User and Role table
drop table if exists `userRole`;
create table `userRole`(
	`Id`			INT				NOT NULL			AUTO_INCREMENT PRIMARY KEY,
    `UserId`		INT,
    `RoleId`		INT,
	`IsActive` 		TINYINT(1) 		NOT NULL 			DEFAULT 1,
    `Description` 	TEXT			NULL,
    `DateCreated`	TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `DateUpdated` 	TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT UserRole_User FOREIGN KEY (`UserId`) REFERENCES `user`(`Id`),
    CONSTRAINT UserRole_Role FOREIGN KEY (`RoleId`) REFERENCES `role`(`Id`)
) ENGINE=INNODB;

INSERT INTO `userRole`(
	`UserId`, `RoleId`)
VALUES
	(1, 1),
    (2, 2),
    (3, 3),
    (4, 3);


-- Allergy
drop table if exists `allergy`;
create table `allergy`(
	`Id`			INT				NOT NULL			AUTO_INCREMENT PRIMARY KEY,
    `Name`			VARCHAR(50)		NOT NULL,
	`IsActive` 		TINYINT(1) 		NOT NULL 			DEFAULT 1,
    `Description` 	TEXT			NULL,
    `DateCreated`	TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `DateUpdated` 	TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=INNODB;

-- Customer
drop table if exists `customer`;
create table `customer`(
	`Id`			INT				NOT NULL			AUTO_INCREMENT PRIMARY KEY,
    `FamilyName`			VARCHAR(50)		NOT NULL,
    `Address`		VARCHAR(50) 	NOT NULL,
    `AmountOfAdults`INT(2)			NOT NULL,
    `AmountOfKids`	INT(2)			NULL,
    `AmountOfBabies`INT(2)			NULL,
	`IsActive` 		TINYINT(1) 		NOT NULL 			DEFAULT 1,
    `Description` 	TEXT			NULL,
    `DateCreated`	TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `DateUpdated` 	TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=INNODB;

-- Contact
drop table if exists `contact`;
create table `contact`(
	`Id`			INT				NOT NULL			AUTO_INCREMENT PRIMARY KEY,
    `CustomerId`	INT,
	`Email`			VARCHAR(50)		NOT NULL,
    `Phonenumber`	VARCHAR(10)		NOT NULL,
	`IsActive` 		TINYINT(1) 		NOT NULL 			DEFAULT 1,
    `Description` 	TEXT			NULL,
    `DateCreated`	TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `DateUpdated` 	TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	CONSTRAINT Contact_Customer FOREIGN KEY (`CustomerId`) REFERENCES `customer`(`Id`)
) ENGINE=INNODB;

-- Product
drop table if exists `product`;
create table `product`(
 	`Id`			INT				NOT NULL			AUTO_INCREMENT PRIMARY KEY,
    `ProductName`	VARCHAR(50)		NOT NULL,
	`IsActive` 		TINYINT(1) 		NOT NULL 			DEFAULT 1,
    `Description` 	TEXT			NULL,
    `DateCreated`	TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `DateUpdated` 	TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=INNODB;

INSERT INTO `product`(
	`ProductName`)
VALUES
	('Cheese toast'),
    ('Apple'),
    ('Cereal'),
    ('Meat stew'),
    ('Spaghetti'),
    ('Roasted eggplant'),
    ('Drum sticks'),
    ('Rissoto'),
    ('Lasagne');
    
-- FoodPackage
drop table if exists `foodPackage`;
create table `foodPackage`(
	`Id`			INT				NOT NULL			AUTO_INCREMENT PRIMARY KEY,
    `Product1Id`	INT,
    `Product2Id`	INT,
    `Product3Id`	INT,
	`AssemblyDate`	DATE 			NOT NULL,
    `DistributionDate`DATE			NOT NULL,
	`IsActive` 		TINYINT(1) 		NOT NULL 			DEFAULT 1,
    `Description` 	TEXT			NULL,
    `DateCreated`	TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `DateUpdated` 	TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	CONSTRAINT FoodPackage_Product1 FOREIGN KEY (`Product1Id`) REFERENCES `product`(`Id`),
	CONSTRAINT FoodPackage_Product2 FOREIGN KEY (`Product2Id`) REFERENCES `product`(`Id`),
	CONSTRAINT FoodPackage_Product3 FOREIGN KEY (`Product3Id`) REFERENCES `product`(`Id`)
) ENGINE=INNODB;

-- CustomerAllergyFoodpackege
drop table if exists `customerAllergyFoodpackege`;
create table `customerAllergyFoodpackege`(
	`Id`			INT				NOT NULL			AUTO_INCREMENT PRIMARY KEY,
    `FoodPackageId`	INT,
    `CustomerId`	INT,
    `AllergyId` 	INT,
	`IsActive` 		TINYINT(1) 		NOT NULL 			DEFAULT 1,
    `Description` 	TEXT			NULL,
    `DateCreated`	TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `DateUpdated` 	TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	CONSTRAINT customerAllergyFoodpackege_FoodPackage FOREIGN KEY (`FoodPackageId`) REFERENCES `foodPackage`(`Id`),
	CONSTRAINT customerAllergyFoodpackege_Customer FOREIGN KEY (`CustomerId`) REFERENCES `customer`(`Id`),
	CONSTRAINT customerAllergyFoodpackege_Allergy FOREIGN KEY (`AllergyId`) REFERENCES `allergy`(`Id`)
) ENGINE=INNODB;

