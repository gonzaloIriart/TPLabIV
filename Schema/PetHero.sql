CREATE DATABASE IF NOT EXISTS pet_hero;

use pet_hero;

-- TABLES --

CREATE TABLE IF NOT EXISTS user (
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(100),
    email VARCHAR(100),
    password VARCHAR(100),
    role CHAR,
    CONSTRAINT PK_Id PRIMARY KEY (id),
    CONSTRAINT UC_Email UNIQUE (email)
)Engine=InnoDB;

CREATE TABLE IF NOT EXISTS keeper
(
	id INT NOT NULL AUTO_INCREMENT,
    sizeOfDog VARCHAR(10) NOT NULL,
    dailyFee DOUBLE NOT NULL,
    userId INT NOT NULL,
    UNIQUE (id),
    CONSTRAINT PK_Id PRIMARY KEY (id),
    FOREIGN KEY (userId) REFERENCES user(id)
)Engine=InnoDB;

CREATE TABLE IF NOT EXISTS event
(
    id INT NOT NULL AUTO_INCREMENT,
    status VARCHAR(20),
    startDate DATETIME ,
    endDate DATETIME ,
    keeperId INT NOT NULL,
    UNIQUE (id),
    CONSTRAINT PK_Id PRIMARY KEY (id),
    FOREIGN KEY (keeperId) REFERENCES keeper(id)
)Engine=InnoDB;

CREATE TABLE IF NOT EXISTS owner
(
	id INT NOT NULL AUTO_INCREMENT,
    userId INT NOT NULL,
    UNIQUE (id),
    CONSTRAINT PK_Id PRIMARY KEY (id),
    FOREIGN KEY (userId) REFERENCES user(id)
)Engine=InnoDB;

CREATE TABLE IF NOT EXISTS pet
(
	id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    size varchar (10) NOT NULL,
    video VARCHAR(1000) NOT NULL,
    picture VARCHAR(1000) NOT NULL,
    vaccinationScheduleImg VARCHAR(1000) NOT NULL,
    description VARCHAR(1000) NOT NULL,
    ownerId INT NOT NULL,
    UNIQUE (id),
    CONSTRAINT PK_Id PRIMARY KEY (id),
    FOREIGN KEY (ownerId) REFERENCES owner(id)
)Engine=InnoDB;

CREATE TABLE IF NOT EXISTS reserve (
    id INT NOT NULL AUTO_INCREMENT,
    totalFee DOUBLE NOT NULL,
    advancePayment INT NOT NULL,
    petId INT NOT NULL,
    eventId INT NOT NULL,
    paymentId INT,
    CONSTRAINT PK_Id PRIMARY KEY (id),
    FOREIGN KEY (petId) REFERENCES pet(id),
    FOREIGN KEY (eventId) REFERENCES event(id),
    FOREIGN KEY (paymentId) REFERENCES payment(id)
)Engine=InnoDB;

CREATE TABLE IF NOT EXISTS payment (
    id INT NOT NULL AUTO_INCREMENT,
    receipt BLOB,
    ownerId INT NOT NULL,
    reserveId INT NOT NULL,
    bankAccountId INT NOT NULL,
    UNIQUE (id),
    CONSTRAINT PK_Id PRIMARY KEY (id),
    FOREIGN KEY (ownerId) REFERENCES owner(id),
    FOREIGN KEY (reserveId) REFERENCES reserve(id),
    FOREIGN KEY (bankAccountId) REFERENCES bankAccount(id)
)Engine=InnoDB;

CREATE TABLE IF NOT EXISTS bankAccount (
    id INT NOT NULL AUTO_INCREMENT,
    cbu VARCHAR(20),
    alias VARCHAR(20),
    bank VARCHAR(20),
    keeperId INT NOT NULL,
    UNIQUE (id),
    CONSTRAINT PK_Id PRIMARY KEY (id),
    FOREIGN KEY (keeperId) REFERENCES keeper(id)
)Engine=InnoDB;


-- STORE PROCEDURES --

-- User

DROP procedure IF EXISTS `User_GetByEmail`;

DELIMITER $$

CREATE PROCEDURE User_GetByEmail (IN Email VARCHAR(100))
BEGIN
	SELECT user.id, user.name, user.password, user.email, user.role
    FROM user
    WHERE (user.email = email);
END$$

DELIMITER ;

DROP procedure IF EXISTS `User_GetById`;

DELIMITER $$

CREATE PROCEDURE User_GetById (IN id INT)
BEGIN
	SELECT user.id, user.name, user.password, user.email, user.role
    FROM user
    WHERE (user.id = id);
END$$

DELIMITER ;

DROP procedure IF EXISTS `User_Add`;

DELIMITER $$

CREATE PROCEDURE User_Add (IN name CHAR(100), IN email VARCHAR(100), IN password VARCHAR(100), IN role CHAR)
BEGIN
	INSERT INTO user
        (user.name, user.email, user.password, user.role)
    VALUES
        (name, email, password, role);
END$$

DELIMITER ;

-- KEEPER

DROP procedure IF EXISTS `Keeper_GetAll`;

DELIMITER $$

CREATE PROCEDURE Keeper_GetAll ()
BEGIN
	SELECT keeper.id, keeper.dailyFee, keeper.sizeOfDog, keeper.userId
    FROM keeper;
END$$

DELIMITER ;

DROP procedure IF EXISTS `Keeper_GetByUserId`;

DELIMITER $$

CREATE PROCEDURE Keeper_GetByUserId (IN UserId INT)
BEGIN
	SELECT keeper.id, keeper.dailyFee, keeper.sizeOfDog, keeper.userId
    FROM keeper
    WHERE (keeper.userId = UserId);
END$$

DELIMITER ;

DROP procedure IF EXISTS `Keeper_GetById`;

DELIMITER $$

CREATE PROCEDURE Keeper_GetById (IN Id INT)
BEGIN
	SELECT keeper.id, keeper.dailyFee, keeper.sizeOfDog, keeper.userId
    FROM keeper
    WHERE (keeper.id = Id);
END$$

DELIMITER ;


DROP procedure IF EXISTS `Keeper_GetByEventAvailableDates`;

DELIMITER $$

CREATE PROCEDURE Keeper_GetByEventAvailableDates (IN startDate DATE, IN endDate DATE)
BEGIN
	SELECT DISTINCT k.id, k.dailyFee, k.sizeOfDog, k.userId
    FROM keeper k
    JOIN event e on k.id = e.keeperId
    WHERE (e.status = 'unavailable' OR e.status = 'reserved'OR e.status = 'pending') AND
			(startDate BETWEEN e.startDate AND e.endDate OR
			endDate BETWEEN e.startDate AND e.endDate OR
            (startDate > e.startDate AND endDate < e.endDate) OR
            (startDate < e.startDate AND endDate > e.endDate));
END$$

DELIMITER ;

DROP procedure IF EXISTS `Keeper_Add`;

DELIMITER $$

CREATE PROCEDURE Keeper_Add (IN sizeOfDog CHAR(10), IN dailyFee DOUBLE, IN userId INT)
BEGIN
	INSERT INTO keeper
        (keeper.sizeOfDog, keeper.dailyFee, keeper.userId)
    VALUES
        (sizeOfDog, dailyFee, userId);
END$$

DELIMITER;

-- EVENT

DROP procedure IF EXISTS `Event_GetByKeeperId`;

DELIMITER $$

CREATE PROCEDURE Event_GetByKeeperId (IN keeperId INT)
BEGIN
	SELECT event.id, event.status, event.startDate, event.endDate, event.keeperId
    FROM event
    WHERE (event.keeperId = keeperId);
END$$

DELIMITER ;

DROP procedure IF EXISTS `Event_GetById`;

DELIMITER $$

CREATE PROCEDURE Event_GetById (IN eventId INT)
BEGIN
	SELECT event.id, event.status, event.startDate, event.endDate, event.keeperId
    FROM event
    WHERE event.id = eventId;
END$$

DELIMITER ;


DROP procedure IF EXISTS `Event_UpdateStatus`;

DELIMITER $$

CREATE PROCEDURE Event_UpdateStatus (IN eventId INT, IN status VARCHAR(20))
BEGIN
    UPDATE event e
    SET e.status = status
    WHERE e.Id = eventId;
END$$

DELIMITER ;

DROP procedure IF EXISTS `Event_Add`;

DELIMITER $$

CREATE PROCEDURE Event_Add (IN status VARCHAR(20), IN startDate DATETIME, IN endDate DATETIME, IN keeperId INT)
BEGIN
	INSERT INTO event
        (event.status, event.startDate, event.endDate, event.keeperId)
    VALUES
        (status, startDate, endDate, keeperId);
        
	SELECT LAST_INSERT_ID();
END$$

DELIMITER ;
DROP procedure IF EXISTS `Event_DeleteById`;

DELIMITER $$

CREATE PROCEDURE Event_DeleteById (IN eventId INT)
BEGIN
	DELETE event
    FROM event
    WHERE event.Id = eventId;
END$$

DELIMITER ;

-- RESERVE

DROP procedure IF EXISTS `Reserve_Add`;

DELIMITER $$

CREATE PROCEDURE Reserve_Add (IN totalFee DOUBLE, IN advancePayment INT, IN petId INT, IN eventId INT)
BEGIN
	INSERT INTO reserve
        (reserve.totalFee, reserve.advancePayment, reserve.petId, reserve.eventId)
    VALUES
        (totalFee, advancePayment, petId, eventId);
END$$

DELIMITER ;

DROP procedure IF EXISTS `Reserve_GetById`;

DELIMITER $$

CREATE PROCEDURE Reserve_GetById (IN reserveId INT)
BEGIN
	SELECT reserve.totalFee, reserve.advancePayment, reserve.petId, reserve.eventId
    FROM reserve r
    WHERE r.Id = reserveId;
END$$

DELIMITER ;

DROP procedure IF EXISTS `Reserve_DeleteById`;

DELIMITER $$

CREATE PROCEDURE Reserve_DeleteById (IN reserveId INT)
BEGIN
	DELETE reserve, event
    FROM reserve
    INNER JOIN event ON reserve.eventId = event.id
    WHERE reserve.Id = reserveId;
END$$

DELIMITER ;

DROP procedure IF EXISTS `Reserve_GetAllByKeeperId`;

DELIMITER $$


CREATE PROCEDURE Reserve_GetAllByKeeperId (IN keeperId INT)
BEGIN
	SELECT r.id, r.totalFee, r.advancePayment, r.petId, r.eventId
    FROM reserve r
    INNER JOIN event e ON r.eventId = e.id
    WHERE e.keeperId = keeperId AND e.status = 'pending';
END$$

DELIMITER ;

-- OWNER

DROP procedure IF EXISTS `Owner_Add`;

DELIMITER $$
CREATE PROCEDURE Owner_Add (IN userId INT)
BEGIN
	INSERT INTO owner
        (owner.userId)
    VALUES
        (userId);
END$$

DELIMITER ;

DROP procedure IF EXISTS `Owner_GetBId`;

DELIMITER $$

CREATE PROCEDURE Owner_GetByUserId (IN id INT)
BEGIN
	SELECT owner.id, owner.userId
    FROM owner
    WHERE (owner.id = id);
END$$

DELIMITER ;

DROP procedure IF EXISTS `Owner_GetByUserId`;

DELIMITER $$

CREATE PROCEDURE Owner_GetByUserId (IN UserId INT)
BEGIN
	SELECT owner.id, owner.userId
    FROM owner
    WHERE (owner.userId = UserId);
END$$

DELIMITER ;

-- PET

DROP procedure IF EXISTS `Pet_Add`;

DELIMITER $$

CREATE PROCEDURE Pet_Add (IN ownerId INT, IN name VARCHAR(50), IN size VARCHAR(50), IN video VARCHAR(1000), IN picture VARCHAR(1000), IN vaccinationScheduleImg VARCHAR(1000), IN description VARCHAR(1000))
BEGIN
	INSERT INTO pet
        (pet.ownerId , pet.name, pet.size , pet.video , pet.picture , pet.vaccinationScheduleImg, pet.description)
    VALUES
        (ownerId, name, size, video, picture, vaccinationScheduleImg, description);
END$$

DELIMITER ;

DROP procedure IF EXISTS `Pet_GetByOwnerId`;

DELIMITER $$

CREATE PROCEDURE Pet_GetByOwnerId (IN OwnerId INT)
BEGIN
	SELECT * 
    FROM pet
    WHERE (pet.ownerId = OwnerId);
END$$

DELIMITER ;

DROP procedure IF EXISTS `Pet_GetById`;

DELIMITER $$

CREATE PROCEDURE Pet_GetById (IN Id INT)
BEGIN
	SELECT * 
    FROM pet
    WHERE (pet.id = Id);
END$$

DELIMITER ;

-- BANK ACCOUNT

DROP procedure IF EXISTS `BankAccount_GetById`;

DELIMITER $$

CREATE PROCEDURE BankAccount_GetById (IN id INT)
BEGIN
	SELECT b.id, b.alias, b.cbu, b.bank, b.keeperId
    FROM bankAccount b
    WHERE (b.id = id);
END$$

DELIMITER ;

DROP procedure IF EXISTS `BankAccount_GetByKeeperId`;

DELIMITER $$

CREATE PROCEDURE BankAccount_GetByKeeperId (IN id INT)
BEGIN
	SELECT b.id, b.alias, b.cbu, b.bank, b.keeperId
    FROM bankAccount b
    WHERE (b.keeperId = id);
END$$

DELIMITER ;

DROP procedure IF EXISTS `BankAccount_Add`;

DELIMITER $$

CREATE PROCEDURE BankAccount_Add (IN alias VARCHAR(20),IN cbu VARCHAR(20),IN bank VARCHAR(20), IN keeperId INT)
BEGIN
	INSERT INTO bankAccount
    (bankAccount.alias, bankAccount.cbu, bankAccount.bank, bankAccount.keeperId)
    VALUES 
    (alias, cbu, bank, keeperId);
END$$

DELIMITER ;

-- PAYMENT

DROP procedure IF EXISTS `Payment_Add`;

DELIMITER $$

CREATE PROCEDURE Payment_Add (IN ownerId INT, IN reserveId INT, IN bankAccountId INT)
BEGIN
	INSERT INTO payment    
		(payment.ownerId, payment.reserveId, payment.bankAccountId)
    VALUES
        (ownerId, reserveId, bankAccountId);
END$$

DELIMITER;

DROP procedure IF EXISTS `Payment_AddReceipt`;

DELIMITER $$

CREATE PROCEDURE Payment_AddReceipt (IN paymentId INT, IN receipt BLOB)
BEGIN
	UPDATE payment   
    SET payment.receipt = receipt
    WHERE payment.id = paymentId;
END$$

DELIMITER ;

-- INSERTS --

INSERT INTO user
	(name, email, password, role)
VALUES 
	('Rodolfo', 'owner@mail.com', 'owner', 'o'),
	('Ruperto', 'keeper@mail.com', 'keeper', 'k');
    
INSERT INTO keeper
	(sizeOfDog, dailyFee, userId)
VALUES 
	('small', 80.5, 2);
    
    INSERT INTO owner
	(userId)
VALUES 
	(1);
    
INSERT INTO pet (pet.ownerId , pet.name, pet.size , pet.video , pet.picture , pet.vaccinationScheduleImg, pet.description)
VALUES (1, 'pipo', 'small', 'video', 'foto', 'asd', 'asd'),
		(1, 'pupi', 'big', 'video2', 'foto2', 'asd2', 'asd2');

INSERT INTO event (status, startDate, endDate, keeperId) 
VALUES  ('unavailable', '2022-10-20', '2022-10-25', 1),
		('pending', '2022-11-04', '2022-11-09', 1),
		('unavailable', '2022-10-10', '2022-10-13', 1);
        
INSERT INTO reserve (totalFee, advancePayment, petId, eventId)
VALUES (500, 50, 1, 2);
