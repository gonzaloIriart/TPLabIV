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

DELIMITER ;

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