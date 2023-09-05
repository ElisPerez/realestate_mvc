      SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

      SET time_zone = "-05:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;

/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;

/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;

/*!40101 SET NAMES utf8mb4 */;

CREATE SCHEMA IF NOT EXISTS `realestate` DEFAULT CHARACTER
      SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;

USE `realestate`;

   CREATE TABLE IF NOT EXISTS `realestate`.`sellers` (
          `id` INT (11) NOT NULL AUTO_INCREMENT,
          `first_name` VARCHAR(45) NOT NULL,
          `last_name` VARCHAR(45) NOT NULL,
          `phone` VARCHAR(10) NOT NULL,
          PRIMARY KEY (`id`)
          ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

   CREATE TABLE IF NOT EXISTS `realestate`.`properties` (
          `id` INT (11) NOT NULL AUTO_INCREMENT,
          `title` VARCHAR(60) NOT NULL,
          `price` DECIMAL(10, 2) NOT NULL,
          `image` VARCHAR(200) NOT NULL,
          `description` LONGTEXT NULL,
          `rooms` INT (1) NOT NULL,
          `wc` INT (1) NOT NULL,
          `parking_lot` INT (1) NOT NULL,
          `create_at` DATE NOT NULL,
          `seller_id` INT (11) NOT NULL,
          PRIMARY KEY (`id`),
          INDEX `fk_properties_seller_idx` (`seller_id` ASC) VISIBLE,
          CONSTRAINT `fk_properties_sellers` FOREIGN KEY (`seller_id`) REFERENCES `realestate`.`sellers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
          ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

   CREATE TABLE IF NOT EXISTS `realestate`.`users` (
          `id` int NOT NULL AUTO_INCREMENT,
          `email` varchar(50) NOT NULL,
          `password` char(60) NOT NULL,
          PRIMARY KEY (`id`)
          ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

START TRANSACTION;

USE `realestate`;

   INSERT INTO `realestate`.`sellers` (`id`, `first_name`, `last_name`, `phone`)
   VALUES (1, 'Armando Esteban', 'Quito', '5551234567'),
          (2, 'Elsa', 'Pato', '5551234567'),
          (3, 'Luz', 'Rojas', '5551234567'),
          (4, 'Susana', 'Oria', '5551234567'),
          (8, 'Alan', 'Brito', '1231312343'),
          (9, 'Elsa', 'Polindo', '3839198234');

COMMIT;

START TRANSACTION;

USE `realestate`;

   INSERT INTO `realestate`.`users` (`id`, `email`, `password`)
   VALUES (
          1,
          'correo@correo.com',
          '$2y$10$VxBrGW7.7nFoj.g5cDLCZOrsd9Yzw.KgY1Z8bnWFOlFLdwRA5BcZG'
          );

COMMIT;

START TRANSACTION;

USE `realestate`;

   INSERT INTO `realestate`.`properties` (
          `id`,
          `title`,
          `price`,
          `image`,
          `description`,
          `rooms`,
          `wc`,
          `parking_lot`,
          `create_at`,
          `seller_id`
          )
   VALUES (
          1,
          'Casa en la playa',
          234.00,
          '657788d5b6c06ef659157bdabc2ea7a3.jpg',
          'Enim consectetur irure deserunt nisi ullamco pariatur dolore ad fugiat. Anim sit consequat elit et tempor aute velit. Eiusmod sunt eu adipisicing nulla dolor cupidatat mollit et do sunt labore pariatur duis. Irure mollit velit ea excepteur ex nisi quis quis. Excepteur consequat ut laboris voluptate ut esse non. Proident cillum ut reprehenderit exercitation occaecat. Consequat consequat et ullamco aliqua. Do laborum aliquip laborum non adipisicing eiusmod pariatur Lorem veniam id.',
          2,
          3,
          4,
          '2023-08-23',
          1
          ),
          (
          2,
          'Casa con piscina',
          123412.00,
          '780dbfc9a01694aac328fce95aac40f3.jpg',
          'Enim consectetur irure deserunt nisi ullamco pariatur dolore ad fugiat. Anim sit consequat elit et tempor aute velit. Eiusmod sunt eu adipisicing nulla dolor cupidatat mollit et do sunt labore pariatur duis. Irure mollit velit ea excepteur ex nisi quis quis. Excepteur consequat ut laboris voluptate ut esse non. Proident cillum ut reprehenderit exercitation occaecat. Consequat consequat et ullamco aliqua. Do laborum aliquip laborum non adipisicing eiusmod pariatur Lorem veniam id.',
          3,
          2,
          3,
          '2023-08-23',
          2
          ),
          (
          3,
          'Casa en el campo',
          2000000.00,
          '801e267d14b7c0ea56eaf303cfa70718.jpg',
          'Enim consectetur irure deserunt nisi ullamco pariatur dolore ad fugiat. Anim sit consequat elit et tempor aute velit. Eiusmod sunt eu adipisicing nulla dolor cupidatat mollit et do sunt labore pariatur duis. Irure mollit velit ea excepteur ex nisi quis quis. Excepteur consequat ut laboris voluptate ut esse non. Proident cillum ut reprehenderit exercitation occaecat. Consequat consequat et ullamco aliqua. Do laborum aliquip laborum non adipisicing eiusmod pariatur Lorem veniam id.',
          3,
          4,
          5,
          '2023-08-23',
          2
          ),
          (
          4,
          "Casa en la Montaña",
          2.00,
          '9b2952ac0171ab77c87d68b6d2c3171c.jpg',
          'Enim consectetur irure deserunt nisi ullamco pariatur dolore ad fugiat. Anim sit consequat elit et tempor aute velit. Eiusmod sunt eu adipisicing nulla dolor cupidatat mollit et do sunt labore pariatur duis. Irure mollit velit ea excepteur ex nisi quis quis. Excepteur consequat ut laboris voluptate ut esse non. Proident cillum ut reprehenderit exercitation occaecat. Consequat consequat et ullamco aliqua. Do laborum aliquip laborum non adipisicing eiusmod pariatur Lorem veniam id.',
          3,
          2,
          1,
          '2023-08-24',
          3
          ),
          (
          5,
          'Granja campestre',
          2.00,
          'f9379b5d1b32a28d68a887c957a7ae06.jpg',
          'Enim consectetur irure deserunt nisi ullamco pariatur dolore ad fugiat. Anim sit consequat elit et tempor aute velit. Eiusmod sunt eu adipisicing nulla dolor cupidatat mollit et do sunt labore pariatur duis. Irure mollit velit ea excepteur ex nisi quis quis. Excepteur consequat ut laboris voluptate ut esse non. Proident cillum ut reprehenderit exercitation occaecat. Consequat consequat et ullamco aliqua. Do laborum aliquip laborum non adipisicing eiusmod pariatur Lorem veniam id.',
          2,
          2,
          2,
          '2023-08-24',
          3
          ),
          (
          6,
          'Apartamento en la ciudad',
          3.00,
          '61fb7589e96a79108cdbca2b6dee51aa.jpg',
          'Enim consectetur irure deserunt nisi ullamco pariatur dolore ad fugiat. Anim sit consequat elit et tempor aute velit. Eiusmod sunt eu adipisicing nulla dolor cupidatat mollit et do sunt labore pariatur duis. Irure mollit velit ea excepteur ex nisi quis quis. Excepteur consequat ut laboris voluptate ut esse non. Proident cillum ut reprehenderit exercitation occaecat. Consequat consequat et ullamco aliqua. Do laborum aliquip laborum non adipisicing eiusmod pariatur Lorem veniam id.',
          2,
          3,
          2,
          '2023-08-24',
          4
          );

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;

/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;