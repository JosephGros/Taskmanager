-- Lägg till din exporterade SQL kod här
-- Adminer 4.8.1 MySQL 5.5.5-10.4.32-MariaDB-1:10.4.32+maria~ubu2004 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

CREATE DATABASE IF NOT EXISTS taskmanager /*!40100 DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci */;
USE taskmanager;

CREATE TABLE IF NOT EXISTS tasks (
  taskId int(11) NOT NULL AUTO_INCREMENT,
  taskTitle varchar(100) DEFAULT NULL,
  taskDiscription text DEFAULT NULL,
  taskStatus tinyint(4) DEFAULT 0,
  userId int(11) DEFAULT NULL,
  PRIMARY KEY (taskId),
  KEY tasks_ibfk_4 (userId),
  CONSTRAINT tasks_ibfk_4 FOREIGN KEY (userId) REFERENCES users (userId)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO tasks (`taskId`, `taskTitle`, `taskDiscription`, `taskStatus`, `userId`) VALUES
(64,	'svfvsv',	'fsvsvfvsfvfsv',	1,	3),
(65,	'svsvsv',	'svsvsvsfv',	1,	3),
(66,	'sfvsvfv',	'sfvsfvsv',	0,	3),
(67,	'sfvsvsfvf',	'sfvsvsvsfv',	0,	3),
(76,	'diska',	'I salem',	0,	4),
(88,	'cfc',	'cefnc c',	0,	1),
(93,	'Main quest',	'Destroy the ring in mount doom',	0,	16),
(94,	'Visit Bilbo',	'Visit Bilbo in the Shire.',	1,	16),
(95,	'Frodo',	'Make Frodo take the ring to Mount Doom and destroy it',	0,	16),
(96,	'Fight Balrog',	'Fight and kill Balrog and become Gandalf the white.',	0,	16);

CREATE TABLE IF NOT EXISTS users (
  userId int(11) NOT NULL AUTO_INCREMENT,
  username varchar(50) NOT NULL,
  password varchar(100) NOT NULL,
  firstName varchar(50) NOT NULL,
  lastName varchar(50) NOT NULL,
  email varchar(100) NOT NULL,
  PRIMARY KEY (userId),
  UNIQUE KEY username (username),
  UNIQUE KEY email (email)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO users (`userId`, `username`, `password`, `firstName`, `lastName`, `email`) VALUES
(1,	'Joseph',	'$2y$10$azs8LRLnp0NneGmWEJvMP.M0HiK5ldiRZGnNJkLmt7uwxINpx4F2m',	'Joseph',	'Gros',	'wiley.joseph.gros@gmail.com'),
(2,	'Golden.anna',	'$2y$10$dTCgCo.5ZtzVJGv7m7B5H.bQBLFyxayUvqJjzNlStM0HmBdTykrta',	'Anna',	'Holmqvist',	'golden.anna@hotmail.com'),
(3,	'JosephGros',	'$2y$10$zLEaURL1U47RgCJ7CFxvJ.97MPe42mzgKn3EDi9hshDJtSg39H/uC',	'Joseph',	'Gros',	'w.joseph.gros@gmail.com'),
(4,	'mona',	'$2y$10$OOcWnw30VxIb095g9HdBUO7zh9zDohF7mq0rMkcnhHOlbAMTvzlG.',	'mona',	'ternelius',	'mona.ternelius@sll.se'),
(11,	'Kimpa',	'$2y$10$Cl2Dm.2Lf93auJgOP74uAOlV5Sbh3aGMsWDJdvIVUdzkBtorMLdZu',	'Kimpish',	'larsson',	'larsson@hallÃ¥.com'),
(16,	'Gandalf',	'$2y$10$bAQ3Hpz2e2znR4yL2i/0DO6FLSJrZCnB/voU6pvVFYRV7eocrqkbG',	'Gandalf',	'the Grey',	'gandalf-rules@gmail.com');

-- 2024-01-27 15:44:39
