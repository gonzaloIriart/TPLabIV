CREATE DATABASE IF NOT EXISTS pet_hero;

use pet_hero;

CREATE TABLE IF NOT EXISTS user (
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(100),
    password VARCHAR(100),
    email VARCHAR(100),
    role CHAR,
    CONSTRAINT PK_Id PRIMARY KEY (id)
)Engine=InnoDB;


CREATE TABLE IF NOT EXISTS keeper
(
	id INT NOT NULL AUTO_INCREMENT,
    dogSize VARCHAR(10) NOT NULL,
    dailyFee DOUBLE NOT NULL,
    userId INT NOT NULL,
    CONSTRAINT PK_Id PRIMARY KEY (id),
    FOREIGN KEY (userId) REFERENCES user(id)
)Engine=InnoDB;

DROP procedure IF EXISTS `User_GetByEmail`;

DELIMITER $$

CREATE PROCEDURE User_GetByEmail (IN email VARCHAR(100))
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
	SELECT keeper.userId, keeper.dailyFee, keeper.dogSize
    FROM keeper
    WHERE (keeper.userId = UserId);
END$$

DELIMITER ;

DROP procedure IF EXISTS `Keeper_Add`;

DELIMITER $$

CREATE PROCEDURE Keeper_Add (IN dogSize CHAR(10), IN dailyFee DOUBLE, IN userId INT)
BEGIN
	INSERT INTO keeper
        (keeper.dogSize, keeper.dailyFee, keeper.userId)
    VALUES
        (dogSize, dailyFee, userId);
END$$

DELIMITER ;

INSERT INTO user
	(name, password, email, role)
VALUES 
	('Rodolfo', 'owner', 'owner@mail.com', 'o'),
	('Ruperto', 'keeper', 'keeper@mail.com', 'k');
    
INSERT INTO keeper
	(dogSize, dailyFee, userId)
VALUES 
	('smaill', 80.5, 2);