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
	`IsActive` 		BIT(1) 		NOT NULL 			DEFAULT 1,
    `Description` 	TEXT			NULL,
    `DateCreated`	TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `DateUpdated` 	TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=INNODB;

INSERT INTO `supplier`(
	`CompanyName`, `Address`, `Email`, `PhoneNumber`)
VALUES 
	('DHL', 'Daltonlaan 400', 'DHL@support.nl', '0611223344'),
    ('Sligro', 'Benschop 31', 'Sligro@support.nl', '0613223344'),
    ('Makro', 'IJselstein 2', 'Makro@support.nl', '0612223344'),
    ('UPS', 'Freekweg 2', 'Ups@support.nl', '0626275828'),
    ('Etail', 'Trilbaan 52', 'Etail@support.nl', '0628492018');
    
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

-- Family
drop table if exists `family`;
create table `family`(
	`Id`					INT				NOT NULL			AUTO_INCREMENT PRIMARY KEY,
    `Name`					Varchar(50)		NULL,
    `Code`					VARCHAR(255)	NOT NULL,
    `FamilyDescription`		VARCHAR(50)		NULL,
	`AmountOfAdults`		INT				NOT NULL,
    `AmountOfKids`			INT				NOT NULL,
    `AmountOfBabies` 		INT				NOT NULL,
    `TotalAmountOfPeople` 	INT				NOT NULL,
	`IsActive` 				BIT(1) 			NOT NULL 			DEFAULT 1,
    `Description` 			TEXT			NULL,
    `DateCreated`			TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `DateUpdated` 			TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=INNODB;

INSERT INTO `family`(
	`Name`, `Code`, `FamilyDescription`, `AmountOfAdults`, `AmountOfKids`, `AmountOfBabies`, `TotalAmountOfPeople`)
VALUES 
	('ZevenhuisGezin', 'G0001', 'Bijstandsgezin', 2, 2, 0, 4),
    ('BergkampGezin', 'G0002', 'Bijstandsgezin', 2, 1, 1, 4),
    ('HeuvelGezin', 'G0003', 'Bijstandsgezin', 2, 0, 0, 2),
    ('ScherderGezin', 'G0004', 'Bijstandsgezin', 1, 0, 2, 3),
    ('DeJongGezin', 'G0005', 'Bijstandsgezin', 1, 1, 0, 2),
    ('VanDerBergGezin', 'G0006', 'Alleengaande', 1, 0, 0, 1);    
    
-- Person
drop table if exists `person`;
create table `person`(
	`Id`			INT				NOT NULL			AUTO_INCREMENT PRIMARY KEY,
    `FamilyId`		int				NULL,
    `Callname`		VARCHAR(50)		NOT NULL,
    `Infix`			VARCHAR(10)		NULL,
	`LastName`		VARCHAR(50)		NOT NULL,
    `DateOfBirth`	DATE			NOT NULL,
    `TypeOfPerson` 	VARCHAR(50)		NOT NULL,
    `IsRepresentative` INT 			NOT NULL,
	`IsActive` 		BIT(1) 			NOT NULL 			DEFAULT 1,
    `Description` 	TEXT			NULL,
    `DateCreated`	TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `DateUpdated` 	TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT Person_Family FOREIGN KEY (`FamilyId`) REFERENCES `family`(`Id`)
) ENGINE=INNODB;

INSERT INTO `person`(
	`FamilyId`, `Callname`, `Infix`, `lastname`, `DateOfBirth`, `TypeOfPerson`, `IsRepresentative`)
VALUES 
	(null, 'Hans', 'van', 'Leeuwen', '1985-02-12', 'Manager','0'),
    (null, 'Jan', 'van der', 'Sluijs', '1993-04-30', 'Medewerker','0'),
    (null, 'Herman', 'den', 'Duiker', '1989-08-30', 'Vrijwilliger','0'),
    ('1', 'Johan', 'van', 'Zevenhuizen', '1990-05-20', 'Klant','1'),
    ('1', 'Sarah', 'den', 'Dolder', '1985-03-23', 'Klant','0'),
    ('1', 'Theo', 'van', 'Zevenhuizen', '2015-03-08', 'Klant','0'),
    ('1', 'Jantien', 'van', 'Zevenhuizen', '2016-09-20', 'Klant','0'),
    
    ('2', 'Arjan', ' ', 'Bergkamp', '1968-08-18', 'Klant','1'),
    ('2', 'Janneke', ' ', 'Sanders', '1969-02-02', 'Klant','0'),
    ('2', 'Stein', ' ', 'Bergkamp', '2009-02-02', 'Klant','0'),
    ('2', 'Judith', ' ', 'Bergkamp', '2022-02-05', 'Klant','0'),
    
    ('3', 'Mazin', 'van', 'Vliet', '1968-08-18', 'Klant','0'),
    ('3', 'Selma', 'van de', 'Heuvel', '1965-09-04', 'Klant','1'),
    
    ('4', 'Eva', ' ', 'Scherder', '2000-04-07', 'Klant','1'),
    ('4', 'Felicia', ' ', 'Scherder', '2021-11-29', 'Klant','0'),
    ('4', 'Devin', ' ', 'Scherder', '2023-03-01', 'Klant','0'),
    
    ('5', 'Frieda', 'de', 'Jong', '1980-09-04', 'Klant','1'),
    ('5', 'Simeon', 'de', 'Jong', '2018-05-23', 'Klant','0'),
    ('6', 'Hanna', 'van der', 'Berg', '1999-09-09', 'Klant','1');

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
    `Allergy`			VARCHAR(50)		NOT NULL,
    `AllergyDescription` varchar(255) NOT NULL,
    `AnafylacticRisk` varchar(50) NOT NULL,
	`IsActive` 		BIT(1) 		NOT NULL 			DEFAULT 1,
    `Description` 	TEXT			NULL,
    `DateCreated`	TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `DateUpdated` 	TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=INNODB;

INSERT INTO `allergy`(
	`Allergy`, `AllergyDescription`, `AnafylacticRisk`)
VALUES 
	('Gluten', 'Allergisch voor gluten', 'Zeer laag'),
    ('Pindas', 'Allergisch voor pindas', 'Hoog'),
    ('Schaaldieren', 'Allergisch voor schaaldieren', 'Redelijk hoog'),
    ('Hazelnoten', 'Allergisch voor hazelnoten', 'Laag'),
    ('Lactose', 'Allergisch voor lactose', 'Zeer laag'),
    ('Soja', 'Allergisch voor soja', 'Zeer laag');

-- AllergyPerPerson
drop table if exists `allergyPerPerson`;
create table `allergyPerPerson`(
	`Id`			INT			NOT NULL			AUTO_INCREMENT PRIMARY KEY,
    `PersonId`		INT			NOT NULL,
    `AllergyId` 	INT 		NOT NULL,
	`IsActive` 		BIT(1) 		NOT NULL 			DEFAULT 1,
    `Description` 	TEXT		NULL,
    `DateCreated`	TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `DateUpdated` 	TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	CONSTRAINT AllergyPerPerson_Person FOREIGN KEY (`PersonId`) REFERENCES `person`(`Id`),
	CONSTRAINT AllergyPerPerson_Allergy FOREIGN KEY (`AllergyId`) REFERENCES `allergy`(`Id`)
) ENGINE=INNODB;

INSERT INTO `allergyPerPerson`(
	`PersonId`, `AllergyId`)
VALUES 
	(4, 1),
    (5, 2),
    (6, 3),
    (7, 4),
    (8, 3),
    (9, 2),
    (10, 5),
    (12, 2),
    (13, 4),
    (14, 1),
    (15, 3),
    (16, 5),
	(17, 1),
    (17, 2),
    (18, 4),
	(19, 4);


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
    
-- FoodPackage
drop table if exists `foodPackage`;
create table `foodPackage`(
	`Id`			INT				NOT NULL			AUTO_INCREMENT PRIMARY KEY,
    `Product1Id`	INT,
    `Product2Id`	INT,
    `Product3Id`	INT,
	`AssemblyDate`	DATE 			NOT NULL,
    `DistributionDate`DATE			NOT NULL,
	`IsActive` 		BIT(1) 		NOT NULL 			DEFAULT 1,
    `Description` 	TEXT			NULL,
    `DateCreated`	TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `DateUpdated` 	TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	CONSTRAINT FoodPackage_Product1 FOREIGN KEY (`Product1Id`) REFERENCES `product`(`Id`),
	CONSTRAINT FoodPackage_Product2 FOREIGN KEY (`Product2Id`) REFERENCES `product`(`Id`),
	CONSTRAINT FoodPackage_Product3 FOREIGN KEY (`Product3Id`) REFERENCES `product`(`Id`)
) ENGINE=INNODB;

INSERT INTO `foodPackage`(
	`Product1Id`, `Product2Id`, `Product3Id`, `AssemblyDate`, `DistributionDate`)
VALUES 
	('2', '3', '6', '2023-06-19', '2023-06-20'),
    ('1', '4', '7', '2023-06-20', '2023-06-21'),
    ('4', '5', '6', '2023-06-22', '2023-06-23'),
    ('2', '5', '7', '2023-06-23', '2023-06-24'),
    ('4', 5, '6', '2023-06-23', '2023-06-23');

-- CustomerAllergyFoodpackege
drop table if exists `customerAllergyFoodpackege`;
create table `customerAllergyFoodpackege`(
	`Id`			INT				NOT NULL			AUTO_INCREMENT PRIMARY KEY,
    `FoodPackageId`	INT,
    `CustomerId`	INT,
    `AllergyId` 	INT,
	`IsActive` 		BIT(1) 		NOT NULL 			DEFAULT 1,
    `Description` 	TEXT			NULL,
    `DateCreated`	TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `DateUpdated` 	TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	CONSTRAINT customerAllergyFoodpackege_FoodPackage FOREIGN KEY (`FoodPackageId`) REFERENCES `foodPackage`(`Id`),
	CONSTRAINT customerAllergyFoodpackege_Customer FOREIGN KEY (`CustomerId`) REFERENCES `customer`(`Id`),
	CONSTRAINT customerAllergyFoodpackege_Allergy FOREIGN KEY (`AllergyId`) REFERENCES `allergy`(`Id`)
) ENGINE=INNODB;

INSERT INTO `customerAllergyFoodpackege`(
	`FoodPackageId`, `CustomerId`, `AllergyId`)
VALUES 
	('2', '1', '1'),
    ('5', '2', '2'),
    ('1', '4', '4');