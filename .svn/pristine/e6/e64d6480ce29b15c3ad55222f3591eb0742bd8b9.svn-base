-- INITIAL DATABASE CONFIG
--
-- Database: `student_f13g06`
--

-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(30) DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `gender` enum('M','F') DEFAULT NULL COMMENT 'Optional',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- 

CREATE TABLE IF NOT EXISTS `listings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  overall_rating int(4) NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--

CREATE TABLE IF NOT EXISTS `destinations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `type` ENUM('country','region','city') NULL,
  `parent_id` int(11) NOT NULL,
  `region_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `lat` float(10,6) NOT NULL,
  `long` float(10,6) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--

CREATE TABLE IF NOT EXISTS `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--

CREATE TABLE IF NOT EXISTS `reviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `review` text NOT NULL,
  `rating` int(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;


--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `users_roles`
--
CREATE TABLE IF NOT EXISTS `users_roles` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
   created_at timestamp NULL DEFAULT NULL,
   updated_at timestamp NULL DEFAULT NULL,
   deleted_at timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `ratings`
--

CREATE TABLE IF NOT EXISTS `ratings` (
  `id` int(60) NOT NULL AUTO_INCREMENT,
  `rating_category_id` int(11) NOT NULL,
  `value` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `review_id` int(11) NOT NULL,
  `listing_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `listingsratingcategories`
--

CREATE TABLE IF NOT EXISTS `listings_ratings_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `listing_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `listings_destinations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `listing_id` int(11) NOT NULL,
  `destination_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `listings_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `listing_id` int(11) NOT NULL,
  `image_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `reviews_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `review_id` int(11) NOT NULL,
  `image_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE  `destinations` CHANGE  `parent_id`  `parent_id` INT( 11 ) NULL ,
CHANGE  `region_id`  `region_id` INT( 11 ) NULL ,
CHANGE  `country_id`  `country_id` INT( 11 ) NULL ,
CHANGE  `lat`  `lat` FLOAT( 10, 6 ) NULL ,
CHANGE  `long`  `long` FLOAT( 10, 6 ) NULL;

ALTER TABLE  `users_roles` CHANGE  `role_id`  `roles_id` INT( 11 ) NOT NULL;

INSERT INTO  `roles` (`id` ,`name` ,`created_at` ,`updated_at` ,`deleted_at`)
VALUES 
(NULL ,  'admin', NOW( ) , NOW( ) , NOW( )), 
(NULL ,  'contributor', NOW( ) , NOW( ) , NOW( ));

ALTER TABLE `roles`
  DROP `created_at`,
  DROP `updated_at`,
  DROP `deleted_at`;

ALTER TABLE  `users_roles` CHANGE  `user_id`  `user_id` INT( 11 ) NOT NULL;
ALTER TABLE users_roles DROP PRIMARY KEY;

-- seed destinations
INSERT INTO `destinations` 
(id, `name` , `type` , `parent_id` , `region_id` , `country_id` , `description`)
VALUES 
(1,'United States', 'country', NULL , NULL , NULL , 'A big country'), 
(2,'Canada', 'country', NULL , NULL , NULL , 'Northern place'),
(3,'Mexico', 'country', NULL , NULL , NULL , 'Northern place'),
(4,'West Coast', 'region', 1 , NULL , 1 , 'Left coast'),
(5,'Southern California', 'region', 13 , 13 , 1 , ''),
(6,'Northern California', 'region', 13 , 14 , 1 , ''),
(7,'San Francisco Bay Area', 'region', 6 , 6 , 1 , ''),
(8,'San Francisco', 'city', 7 , 7 , 1 , ''),
(9,'East Bay', 'region', 7 , 7 , 1 , ''),
(10,'South Bay', 'region', 7 , 7 , 1 , ''),
(11,'Peninsula', 'region', 7 , 7 , 1 , ''),
(12,'Los Angeles', 'region', 1 , NULL , 1 , ''),
(13,'California', 'region', 4 , 4 , 1 , ''),
(14,'Pacific Northwest', 'region', 4 , 4 , 1 , ''),
(15,'Oregon', 'region', 14 , 14 , 1 , ''),
(16,'Washington', 'region', 14 , 14 , 1 , ''),
(17,'Idaho', 'region', 14 , 14 , 1 , ''),
(18,'Oakland', 'city', 9 , 9 , 1 , ''),
(19,'Berkeley', 'city', 9 , 9 , 1 , ''),
(20,'San Jose', 'city', 10 , 10 , 1 , ''),
(21,'Palo Alto', 'city', 10 , 10 , 1 , ''),
(22,'Mountian View', 'city', 11 , 11 , 1 , '')
;

-- change listings types to ENUM
ALTER TABLE `listings` CHANGE `type` `type` ENUM( 'eatery', 'gym', 'sports', 'outdoor' ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL;

INSERT INTO `listings` 
(`id` ,`name` ,`description`,`type`)
VALUES 
(NULL , 'Ginkgo Energy Smoothie Shop', 'lorem ipsum dolor', 'eatery'), 
(NULL , 'Golden Gate Yoga', 'lorem ipsum dolor', 'gym'),
(NULL , 'Healthy Delights', 'lorem ipsum dolor', 'eatery'),
(NULL , 'Delicious Yogurt', 'lorem ipsum dolor', 'eatery'),
(NULL , 'CrossFit SF', 'lorem ipsum dolor', 'gym'),
(NULL , 'San Francisco Indoor Soccer League', 'lorem ipsum dolor', 'sports'),
(NULL , 'YMCA San Francisco', 'lorem ipsum dolor', 'gym'),
(NULL , 'Golden Gate Park Bike Trails', 'lorem ipsum dolor', 'outdoor')
;

ALTER TABLE  `listings` ADD  `destinations_id` INT( 11 ) NOT NULL AFTER  `id`;

-- add listings relationship & parent_id to reviews table
ALTER TABLE  `reviews` ADD  `listings_id` INT( 11 ) NOT NULL;
ALTER TABLE  `reviews` ADD  `parent_id` INT( 11 ) NOT NULL;

-- fix ratings database schema to match UML
ALTER TABLE `listings_ratings_categories` DROP `listing_id`;
ALTER TABLE  `listings_ratings_categories` ADD  `displayName` VARCHAR( 255 ) NOT NULL ,
ADD  `minValue` INT( 4 ) NOT NULL DEFAULT  '1',
ADD  `maxValue` INT( 4 ) NOT NULL DEFAULT  '5';

-- redo healthy-rating
ALTER TABLE  `listings` ADD  `healthy_rating` INT( 4 ) NULL;

-- add listings_ratings table
CREATE TABLE IF NOT EXISTS `listings_ratings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `listings_ratings_categories_id` int(11) NOT NULL,
  `value` int(4) DEFAULT NULL,
  `listings_id` int(11) NOT NULL,
  `num_ratings` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- change ratings table to use relationship 
ALTER TABLE  `ratings` CHANGE  `rating_category_id`  `listings_ratings_id` INT( 11 ) NOT NULL;

-- redo ratings table
DROP TABLE ratings;
CREATE TABLE IF NOT EXISTS `users_ratings` (
  `id` int(60) NOT NULL AUTO_INCREMENT,
  `listings_ratings_id` int(11) NOT NULL,
  `value` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `listings_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- need individual records for overall_ratings and healthy_ratings
ALTER TABLE  `listings_ratings_categories` CHANGE  `displayName`  `displayName` VARCHAR( 255 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL;
INSERT INTO  `listings_ratings_categories` (
`id` ,
`name` ,
`displayName` ,
`minValue` ,
`maxValue`
)
VALUES (
NULL ,  'overall_rating', NULL ,  '1',  '5'
), (
NULL ,  'healthy_rating', NULL ,  '1',  '5'
);

-- getting rid of region/country - all destinations are cities now
ALTER TABLE `destinations`
  DROP `type`,
  DROP `region_id`,
  DROP `country_id`,
  DROP `deleted_at`;

-- ak
-- add user_id in listing_images
ALTER TABLE  `listings_images` ADD  `user_id` INT( 11 ) NOT NULL;

--
ALTER TABLE  `reviews` CHANGE  `parent_id`  `user_id` INT( 11 ) NOT NULL;

ALTER TABLE  `images` CHANGE  `filename`  `filepath` VARCHAR( 255 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL;

ALTER TABLE  `images` DROP  `deleted_at`;

ALTER TABLE  `images` ADD  `filetype` VARCHAR( 10 ) NULL;

ALTER TABLE  `images` ADD  `user_id` INT( 11 ) NULL;

ALTER TABLE  `reviews_images` CHANGE  `review_id`  `reviews_id` INT( 11 ) NOT NULL ,
CHANGE  `image_id`  `images_id` INT( 11 ) NOT NULL;

ALTER TABLE  `listings_images` CHANGE  `listing_id`  `listings_id` INT( 11 ) NOT NULL ,
CHANGE  `image_id`  `images_id` INT( 11 ) NOT NULL;

-- don't need these 2 categories anymore
ALTER TABLE `listings`
  DROP `overall_rating`,
  DROP `healthy_rating`;

-- add address to listings
ALTER TABLE  `listings` ADD  `address1` VARCHAR( 500 ) NULL AFTER  `type` ,
ADD  `address2` VARCHAR( 500 ) NULL AFTER  `address1` ,
ADD  `city` VARCHAR( 255 ) NULL AFTER  `address2` ,
ADD  `state` VARCHAR( 2 ) NULL AFTER  `city` ,
ADD  `zip` VARCHAR( 10 ) NULL AFTER  `state`;

-- and phone
ALTER TABLE  `listings` ADD  `phone` INT( 20 ) NULL;

-- rename min/max on categories
ALTER TABLE  `listings_ratings_categories` CHANGE  `minValue`  `min` INT( 4 ) NOT NULL DEFAULT  '1',
CHANGE  `maxValue`  `max` INT( 4 ) NOT NULL DEFAULT  '5';

ALTER TABLE `listings_ratings_categories`
  DROP `displayName`;

ALTER TABLE  `listings_ratings_categories` ADD  `type` VARCHAR( 20 ) NULL;

INSERT INTO `listings_ratings_categories` (`name` ,`min` ,`max`,`type`)
VALUES 
('Ambience',  '1',  '5', NULL),
('Value',  '1',  '5', NULL),

('Calorie Burner',  '1',  '5', 'gym'),
('Weights',  '1',  '5', 'gym'),
('Staff Knowledge',  '1',  '5', 'gym'),

('Scenery',  '1',  '5', 'outdoors'),
('Terrain Difficulty',  '1',  '5', 'outdoors'),
('Accessibility',  '1',  '5', 'outdoors'),

('Vegetarian Friendly',  '1',  '5', 'eatery'),
('Low Fat',  '1',  '5', 'eatery'),
('High Energy',  '1',  '5', 'eatery'),

('Competition',  '1',  '5', 'sports'),
('Variety',  '1',  '5', 'sports'),
('Equipment',  '1',  '5', 'sports');

-- remove all non-cities
DELETE FROM `destinations` WHERE `destinations`.`id` = 1;
DELETE FROM `destinations` WHERE `destinations`.`id` = 2;
DELETE FROM `destinations` WHERE `destinations`.`id` = 3;
DELETE FROM `destinations` WHERE `destinations`.`id` = 4;
DELETE FROM `destinations` WHERE `destinations`.`id` = 5;
DELETE FROM `destinations` WHERE `destinations`.`id` = 6;
DELETE FROM `destinations` WHERE `destinations`.`id` = 7;
DELETE FROM `destinations` WHERE `destinations`.`id` = 9;
DELETE FROM `destinations` WHERE `destinations`.`id` = 10;
DELETE FROM `destinations` WHERE `destinations`.`id` = 11;
DELETE FROM `destinations` WHERE `destinations`.`id` = 13;
DELETE FROM `destinations` WHERE `destinations`.`id` = 14;
DELETE FROM `destinations` WHERE `destinations`.`id` = 15;
DELETE FROM `destinations` WHERE `destinations`.`id` = 16;
DELETE FROM `destinations` WHERE `destinations`.`id` = 17;

UPDATE  `listings_ratings_categories` SET  `name` =  'Overall Rating' WHERE  `listings_ratings_categories`.`id` =1;

UPDATE  `listings_ratings_categories` SET  `name` =  'Healthy Rating' WHERE  `listings_ratings_categories`.`id` =2;

ALTER TABLE `listings_ratings` CHANGE `value` `value` DECIMAL( 4, 3 ) NULL DEFAULT NULL ;

ALTER TABLE `destinations` ADD `state` VARCHAR( 2 ) NULL;
UPDATE `destinations` SET `state` = 'CA' WHERE `destinations`.`id` =8;
UPDATE `destinations` SET `state` = 'CA' WHERE `destinations`.`id` =12;
UPDATE `destinations` SET `state` = 'CA' WHERE `destinations`.`id` =18;
UPDATE `destinations` SET `state` = 'CA' WHERE `destinations`.`id` =19;
UPDATE `destinations` SET `state` = 'CA' WHERE `destinations`.`id` =20;
UPDATE `destinations` SET `state` = 'CA' WHERE `destinations`.`id` =21;
UPDATE `destinations` SET `state` = 'CA' WHERE `destinations`.`id` =22;
UPDATE `destinations` SET `state` = 'MA' WHERE `destinations`.`id` =23;

-- changing phone field to varchar (allow text characters like ( ) - etc.
ALTER TABLE `listings` CHANGE `phone` `phone` VARCHAR( 20 ) NULL DEFAULT NULL; 
UPDATE listings SET phone = NULL;

-- add images mapping table for destinations
CREATE TABLE IF NOT EXISTS `destinations_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `destinations_id` int(11) NOT NULL,
  `images_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- need these back
ALTER TABLE `listings` ADD `overall_rating` DECIMAL( 4, 3 ) NULL ,
ADD `healthy_rating` DECIMAL( 4, 3 ) NULL;

-- clear all ratings
UPDATE `listings_ratings` SET num_ratings = NULL, value = 0;

UPDATE  `destinations` SET  `id` =  '10',
`lat` = NULL ,
`long` = NULL ,
`created_at` = NULL ,
`updated_at` = NULL WHERE  `destinations`.`id` =20 LIMIT 1;

-- db changes for destinations page

UPDATE  `listings` SET  `destinations_id` =  '8',
`updated_at` = NULL ,
`deleted_at` = NULL ,
`healthy_rating` = NULL WHERE  `listings`.`id` =  '1' LIMIT 1;

UPDATE  `listings` SET  `destinations_id` =  '8',
`updated_at` = NULL ,
`deleted_at` = NULL ,
`healthy_rating` = NULL WHERE  `listings`.`id` =  '2' LIMIT 1;

UPDATE  `listings` SET  `destinations_id` =  '8',
`updated_at` = NULL ,
`deleted_at` = NULL ,
`healthy_rating` = NULL WHERE  `listings`.`id` =  '3' LIMIT 1;

UPDATE  `listings` SET  `destinations_id` =  '8',
`updated_at` = NULL ,
`deleted_at` = NULL ,
`healthy_rating` = NULL WHERE  `listings`.`id` =  '4' LIMIT 1;

UPDATE  `listings` SET  `destinations_id` =  '8',
`updated_at` = NULL ,
`deleted_at` = NULL ,
`healthy_rating` = NULL WHERE  `listings`.`id` =  '5' LIMIT 1;

UPDATE  `listings` SET  `destinations_id` =  '8',
`updated_at` = NULL ,
`deleted_at` = NULL ,
`healthy_rating` = NULL WHERE  `listings`.`id` =  '6' LIMIT 1;

UPDATE  `listings` SET  `destinations_id` =  '8',
`updated_at` = NULL ,
`deleted_at` = NULL ,
`healthy_rating` = NULL WHERE  `listings`.`id` =  '7' LIMIT 1;

UPDATE  `listings` SET  `destinations_id` =  '8',
`updated_at` = NULL ,
`deleted_at` = NULL ,
`healthy_rating` = NULL WHERE  `listings`.`id` =  '8' LIMIT 1;

INSERT INTO `listings` 
(`id` ,`name` ,`description`,`type`, `destinations_id`)
VALUES 
(NULL , 'Golden Gate Park', 'lorem ipsum dolor', 'outdoor', '8'), 
(NULL , 'Ocean Beach', 'lorem ipsum dolor', 'outdoor', '8'),
(NULL , 'Sunset Recreation Center', 'lorem ipsum dolor', 'sports', '8'),
(NULL , 'Boys and Girls Club', 'lorem ipsum dolor', 'sports', '8')
;

UPDATE  `destinations` SET  `id` =  '10',
`lat` = NULL ,
`long` = NULL ,
`created_at` = NULL ,
`updated_at` = NULL WHERE  `destinations`.`id` =20 LIMIT 1;

UPDATE  `destinations` 
SET  `description` = 'A lively and beautiful city by the bay, San Francisco is on the cutting edge of cuisine and modern culture.  Known for its’ beautiful landmarks and colorful population, there is no lack of things to do and see here.  There’s something for the art lover, the culture enthusiast, the scenery viewers and explorer; and all with available healthy and natural dining options and places to work out and get fit. It’s a small bustling berg all pact into a strip of area surrounded by great beaches; a great experience for any newcomer.' 
WHERE  `destinations`.`id` =8;

UPDATE  `destinations` 
SET  `description` = 'A bustling city influenced by both Spanish culture and the nearby Silicon Valley. San Jose has many fantastic historic landmarks, which combine with the ideals of the tech industry into a lively modern persona. It has something for everyone, whether those interests are to see grand Latin influenced buildings and design or to dive in head first into the booming technology and innovations in the area. The city has top class cuisine and hotels, a trip there will certainly end with remorse in leaving the comfort you will grow to expect. ' 
WHERE  `destinations`.`id` =10;

UPDATE  `destinations` 
SET  `description` = 'Known as "The City of Angels", Los Angeles is the central point for all the worlds most famous celebrities. The city offers many interesting attractions and sites to entertain any film enthusiast, health fanatic, or aspiring urbanite.  The influence of the star studded scene is felt in the outgoing, but health conscience culture of the city. Access to great places to work out and eateries to get great healthy and delicious cuisine that is considers among the best in the world. The city is a great destination for anyone interesting in getting swept into lifestyle of the crème de la crème.' 
WHERE  `destinations`.`id` =12;