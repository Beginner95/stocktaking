--Users--
CREATE TABLE `stocktaking`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `login` VARCHAR(50) NOT NULL ,
  `password` VARCHAR(50) NOT NULL ,
  `first_name` VARCHAR(100) NOT NULL ,
  `last_name` VARCHAR(100) NOT NULL ,
  `second_name` VARCHAR(100) NULL DEFAULT NULL,
  `role` VARCHAR(100) NOT NULL DEFAULT 'manager',
  PRIMARY KEY (`id`),
  UNIQUE (`login`)
) ENGINE = InnoDB;

--Categories--
CREATE TABLE `stocktaking`.`categories` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `parent_id` INT NULL DEFAULT NULL ,
  `title` VARCHAR(255) NOT NULL ,
  `description` VARCHAR(255) NULL DEFAULT NULL,
  `date_added` DATETIME NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE (`title`)
) ENGINE = InnoDB;

--Manufacturers--
CREATE TABLE `stocktaking`.`manufacturers` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `title` VARCHAR(255) NOT NULL ,
  `description` VARCHAR(255) NULL DEFAULT NULL ,
  `date_added` DATETIME NOT NULL ,
  PRIMARY KEY (`id`), UNIQUE (`title`)
) ENGINE = InnoDB;

--Products--
CREATE TABLE `stocktaking`.`products` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `category_id` INT NULL DEFAULT NULL ,
  `manufacturer_id` INT NULL DEFAULT NULL ,
  `code` VARCHAR(50) NULL DEFAULT NULL ,
  `name` VARCHAR(255) NOT NULL ,
  `purchase_price` DECIMAL(15,4) NOT NULL DEFAULT '0.0000' ,
  `markup` DECIMAL(15,4) NOT NULL DEFAULT '0.0000' ,
  `price` DECIMAL(15,4) NOT NULL DEFAULT '0.0000' ,
  `quantity` INT NOT NULL ,
  `date_added` DATETIME NOT NULL ,
  PRIMARY KEY (`id`),
  UNIQUE (`name`)
) ENGINE = InnoDB;

--Orders--
CREATE TABLE `stocktaking`.`orders` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `quantity` INT NOT NULL ,
  `total_sum` DECIMAL(15,4) NOT NULL DEFAULT '0.0000' ,
  `date_added` DATETIME NOT NULL ,
  `user_id` INT NOT NULL ,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB;

--Order Products--
CREATE TABLE `stocktaking`.`order_products` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `code` VARCHAR(100) NOT NULL ,
  `name` VARCHAR(255) NOT NULL ,
  `price` DECIMAL(15,4) NOT NULL ,
  `quantity` INT NOT NULL ,
  `total_sum` DECIMAL(15,4) NOT NULL ,
  `product_id` INT NOT NULL ,
  `order_id` INT NOT NULL ,
PRIMARY KEY (`id`)
) ENGINE = InnoDB;