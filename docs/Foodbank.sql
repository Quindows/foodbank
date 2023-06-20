drop database if exists `foodbank`;
create database `foodbank`;

use `foodbank`;

-- Supplier
drop table if exists `supplier`;
create table `supplier`(
	`Id`			INT				NOT NULL			AUTO_INCREMENT PRIMARY KEY,
    `CompanyName`	VARCHAR(50)		NOT NULL,
    `Address`		VARCHAR(50)		NOT NULL,
    `Name`			VARCHAR(50)		NOT NULL,
	`Email`			VARCHAR(50)		NOT NULL,
    `Phonenumber`	VARCHAR(10)		NOT NULL,
	`IsActive` 		BIT(1) 		NOT NULL 			DEFAULT 1,
    `Description` 	TEXT			NULL,
    `DateCreated`	TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `DateUpdated` 	TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=INNODB;

INSERT INTO `supplier`(
	`CompanyName`, `Address`, `Name`, `Email`, `PhoneNumber`)
VALUES 
	('DHL', 'Daltonlaan 400', 'Henk', 'DHL@support.nl', '0611223344'),
    ('Sligro', 'Benschop 31', 'Dave', 'Sligro@support.nl', '0613223344'),
    ('Makro', 'IJselstein 2', 'Marko', 'Makro@support.nl', '0612223344'),
    ('UPS', 'Freekweg 2', 'Russel', 'Ups@support.nl', '0626275828'),
<<<<<<< HEAD
    ('Etail', 'Trilbaan 52', 'Simon', 'Etail@support.nl', 0628492018);
=======
    ('Etail', 'Trilbaan 52', 'Simon', 'Etail@support.nl', '0628492018');
>>>>>>> a57d1f6f5cc3e21364319ee781a3f21300212794
    
-- Delivery
drop table if exists `delivery`;
create table `delivery`(
	`Id`			INT				NOT NULL			AUTO_INCREMENT PRIMARY KEY,
    `Status`		VARCHAR(50)		NOT NULL,
    `TimeOfDeparture`DATETIME       NOT NULL,
	`TimeOfArrival`	DATETIME		NULL,
	`IsActive` 		BIT(1) 		NOT NULL 			DEFAULT 1,
    `Description` 	TEXT			NULL,
    `DateCreated`	TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `DateUpdated` 	TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=INNODB;

INSERT INTO `delivery`(
	`Status`, `TimeOfDeparture`, `TimeOfArrival`)
VALUES 
	('Arrived', '2023-06-15 19:30:00', '2023-06-19 12:14:30'),
    ('Arrived', '2023-06-17 09:45:00', '2023-06-20 14:26:45'),
    ('Arrived', '2023-06-17 10:30:00', '2023-06-20 15:48:23'),
    ('Departed', '2023-06-19 15:30:00', null),
    ('Planned', '2023-06-21 10:30:00', null);

-- Delivery and Supplier table
drop table if exists `deliverySupplier`;
create table `deliverySupplier`(
	`Id`			INT				NOT NULL			AUTO_INCREMENT PRIMARY KEY,
	`SupplierId`	INT,
    `DeliveryId`	INT,
	`IsActive` 		BIT(1) 		NOT NULL 			DEFAULT 1,
    `Description` 	TEXT			NULL,
    `DateCreated`	TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `DateUpdated` 	TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT DeliverySupplier_Supplier FOREIGN KEY (`SupplierId`) REFERENCES `supplier`(`Id`),
	CONSTRAINT DeliverySupplier_Delivery FOREIGN KEY (`DeliveryId`) REFERENCES `delivery`(`Id`)
) ENGINE=INNODB;

INSERT INTO `deliverySupplier`(
	`SupplierId`, `DeliveryId`)
VALUES 
	('1', '1'),
    ('2', '2'),
    ('3', '3'),
    ('4', '4'),
    ('5', '5');
    
    
-- Person
drop table if exists `person`;
create table `person`(
	`Id`			INT				NOT NULL			AUTO_INCREMENT PRIMARY KEY,
    `Callname`		VARCHAR(50)		NOT NULL,
    `Infix`			VARCHAR(10)		NULL,
	`LastName`		VARCHAR(50)		NOT NULL,
	`IsActive` 		BIT(1) 		NOT NULL 			DEFAULT 1,
    `Description` 	TEXT			NULL,
    `DateCreated`	TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `DateUpdated` 	TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=INNODB;

INSERT INTO `person`(
	`Callname`, `Infix`, `lastname`)
VALUES 
	('Levi', null, 'tas'),
    ('Daniel', null, 'Bruijn'),
    ('Claudia', null, 'Nijholt'),
    ('Quintin', null, 'Blume'),
    ('Bruce', null, 'Lee');

-- User
drop table if exists `user`;
create table `user` (	
	`Id`			INT				NOT NULL			AUTO_INCREMENT PRIMARY KEY,
    `PersonId`		INT,
    `Password`		VARCHAR(10)		NOT NULL,
	`IsActive` 		BIT(1) 		NOT NULL 			DEFAULT 1,
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
    ('4', 'test4'),
    ('5', 'test5');

-- Role
drop table if exists `role`;
create table `role`(
	`Id`			INT				NOT NULL			AUTO_INCREMENT PRIMARY KEY,
    `Name`			VARCHAR(50)		NOT NULL,
	`IsActive` 		BIT(1) 		NOT NULL 			DEFAULT 1,
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
	`IsActive` 		BIT(1) 		NOT NULL 			DEFAULT 1,
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
    (4, 3),
    (5, 3);


-- Allergy
drop table if exists `allergy`;
create table `allergy`(
	`Id`			INT				NOT NULL			AUTO_INCREMENT PRIMARY KEY,
    `Name`			VARCHAR(50)		NOT NULL,
	`IsActive` 		BIT(1) 		NOT NULL 			DEFAULT 1,
    `Description` 	TEXT			NULL,
    `DateCreated`	TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `DateUpdated` 	TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=INNODB;

INSERT INTO `allergy`(
	`Name`)
VALUES 
	('Gluten'),
    ('Peanut'),
    ('Shellfish'),
    ('Hazelnut'),
    ('Lactose');

-- Customer
drop table if exists `customer`;
create table `customer`(
	`Id`			INT				NOT NULL			AUTO_INCREMENT PRIMARY KEY,
    `FamilyName`			VARCHAR(50)		NOT NULL,
    `Address`		VARCHAR(50) 	NOT NULL,
    `AmountOfAdults`INT(2)			NOT NULL,
    `AmountOfKids`	INT(2)			NULL,
    `AmountOfBabies`INT(2)			NULL,
    `ExtraWish`VARCHAR(100)			NULL,
	`IsActive` 		BIT(1) 		NOT NULL 			DEFAULT 1,
    `Description` 	TEXT			NULL,
    `DateCreated`	TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `DateUpdated` 	TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=INNODB;

INSERT INTO `customer`(
	`FamilyName`, `Address`, `AmountOfAdults`, `AmountOfKids`, `AmountOfBabies`, `ExtraWish`)
VALUES 
	('Bruijn', 'Hertogweg 27', '3', null, null, 'Geen komkommer'),
    ('Tas', 'Baanweg 104', '4', '1', null, 'Geen perzik'),
    ('Blume', 'Prins HendrikLaan 420', '2', '1', null, null),
    ('Nijholt', 'Werkweg 271', '4', '1', null, 'Geen groente'),
    ('Lee', 'Leerbaanweg 82', '1', '2', '1', null);

-- Contact
drop table if exists `contact`;
create table `contact`(
	`Id`			INT				NOT NULL			AUTO_INCREMENT PRIMARY KEY,
    `CustomerId`	INT,
	`Email`			VARCHAR(50)		NOT NULL,
    `Phonenumber`	VARCHAR(10)		NOT NULL,
	`IsActive` 		BIT(1) 		NOT NULL 			DEFAULT 1,
    `Description` 	TEXT			NULL,
    `DateCreated`	TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `DateUpdated` 	TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	CONSTRAINT Contact_Customer FOREIGN KEY (`CustomerId`) REFERENCES `customer`(`Id`)
) ENGINE=INNODB;

INSERT INTO `contact`(
	`CustomerId`, `Email`, `Phonenumber`)
VALUES 
	('1', 'bruijn@family.com', '0646274919'),
    ('2', 'tas@family.org', '0628482917'),
    ('3', 'blume@family.nl', '0638482716'),
    ('4', 'nijholt@family.dom', '0628482616'),
    ('5', 'lee@family.hiya', '0628482716');

-- Product
drop table if exists `product`;
create table `product`(
 	`Id`			INT				NOT NULL			AUTO_INCREMENT PRIMARY KEY,
    `ProductName`	VARCHAR(50)		NOT NULL,
	`IsActive` 		BIT(1) 		NOT NULL 			DEFAULT 1,
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

-- CustomerAllergyFoodpackege
drop table if exists `customerAllergyFoodpackage`;
create table `customerAllergyFoodpackage`(
	`Id`			INT				NOT NULL			AUTO_INCREMENT PRIMARY KEY,
    `ProductId`		INT,
    `CustomerId`	INT,
    `AllergyId` 	INT,
	`IsActive` 		BIT(1) 		NOT NULL 			DEFAULT 1,
    `Description` 	TEXT			NULL,
    `DateCreated`	TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `DateUpdated` 	TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT customerAllergyFoodpackege_Product FOREIGN KEY (`productId`) REFERENCES `product`(`Id`),
	CONSTRAINT customerAllergyFoodpackege_Customer FOREIGN KEY (`CustomerId`) REFERENCES `customer`(`Id`),
	CONSTRAINT customerAllergyFoodpackege_Allergy FOREIGN KEY (`AllergyId`) REFERENCES `allergy`(`Id`)
) ENGINE=INNODB;

INSERT INTO `customerAllergyFoodpackage`(
	`FoodPackageProductId`, `CustomerId`, `AllergyId`)
VALUES 
	('2', '1', '1'),
    ('3', '2', '2'),
    ('1', '4', '4');
