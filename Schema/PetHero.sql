CREATE DATABASE IF NOT EXISTS pet_hero;

use pet_hero;

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
    startDate DATETIME,
    endDate DATETIME,
    keeperId INT NOT NULL,
    UNIQUE (id),
    CONSTRAINT PK_Id PRIMARY KEY (id),
    FOREIGN KEY (keeperId) REFERENCES keeper(id)
)Engine=InnoDB;

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

DROP procedure IF EXISTS `Keeper_GetAll`;

DELIMITER $$

CREATE PROCEDURE Keeper_GetAll (IN UserId INT)
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

DROP procedure IF EXISTS `Keeper_Add`;

DELIMITER $$

CREATE PROCEDURE Keeper_Add (IN sizeOfDog CHAR(10), IN dailyFee DOUBLE, IN userId INT)
BEGIN
	INSERT INTO keeper
        (keeper.sizeOfDog, keeper.dailyFee, keeper.userId)
    VALUES
        (sizeOfDog, dailyFee, userId);
END$$

DELIMITER ;

DROP procedure IF EXISTS `Event_GetByKeeperId`;

DELIMITER $$

CREATE PROCEDURE Event_GetByKeeperId (IN keeperId INT)
BEGIN
	SELECT event.id, event.status, event.startDate, event.endDate, event.keeperId
    FROM event
    WHERE (event.keeperId = keeperId);
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
END$$

DELIMITER ;

INSERT INTO user
	(name, email, password, role)
VALUES 
	('Rodolfo', 'owner@mail.com', 'owner', 'o'),
	('Ruperto', 'keeper@mail.com', 'keeper', 'k');
    
INSERT INTO keeper
	(sizeOfDog, dailyFee, userId)
VALUES 
	('small', 80.5, 2);

DELIMITER ;

CREATE TABLE IF NOT EXISTS owner
(
	id INT NOT NULL AUTO_INCREMENT,
    userId INT NOT NULL,
    UNIQUE (id),
    CONSTRAINT PK_Id PRIMARY KEY (id),
    FOREIGN KEY (userId) REFERENCES user(id)
)Engine=InnoDB;

DELIMITER ;

CREATE TABLE IF NOT EXISTS pet
(
	id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    video VARCHAR(1000) NOT NULL,
    picture VARCHAR(1000) NOT NULL,
    vaccinationScheduleImg VARCHAR(1000) NOT NULL,
    description VARCHAR(1000) NOT NULL,
    ownerId INT NOT NULL,
    UNIQUE (id),
    CONSTRAINT PK_Id PRIMARY KEY (id),
    FOREIGN KEY (ownerId) REFERENCES owner(id)
)Engine=InnoDB;

DELIMITER ;

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

DROP procedure IF EXISTS `Owner_GetByUserId`;

DELIMITER $$

CREATE PROCEDURE Owner_GetByUserId (IN UserId INT)
BEGIN
	SELECT owner.id, owner.userId
    FROM owner
    WHERE (owner.userId = UserId);
END$$

