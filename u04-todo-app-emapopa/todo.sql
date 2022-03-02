-- Adminer 4.7.8 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `todo`;
CREATE TABLE `todo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `status` enum('done','not done') NOT NULL DEFAULT 'not done',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `todo` (`id`, `title`, `description`, `status`) VALUES
(8,	' test1',	'test1',	'done'),
(9,	'test 23',	'test 23',	'not done'),
(10,	'Ciao Bello',	'hejjjjj',	'done');

-- 2021-01-06 14:56:18
