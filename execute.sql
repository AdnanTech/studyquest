-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.14-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for studyquest
DROP DATABASE IF EXISTS `studyquest`;
CREATE DATABASE IF NOT EXISTS `studyquest` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `studyquest`;

-- Dumping structure for table studyquest.blog_members
DROP TABLE IF EXISTS `blog_members`;
CREATE TABLE IF NOT EXISTS `blog_members` (
  `memberID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`memberID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table studyquest.blog_members: ~0 rows (approximately)
/*!40000 ALTER TABLE `blog_members` DISABLE KEYS */;
INSERT INTO `blog_members` (`memberID`, `username`, `password`) VALUES
	(1, 'test', '$2a$12$ZIXefssUonycJB0UoCql9uZlsmVXptENCgHAcISu9HgF1llVgt9lq');
/*!40000 ALTER TABLE `blog_members` ENABLE KEYS */;

-- Dumping structure for table studyquest.blog_posts
DROP TABLE IF EXISTS `blog_posts`;
CREATE TABLE IF NOT EXISTS `blog_posts` (
  `postID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `postTitle` varchar(255) NOT NULL,
  `postDescription` mediumtext DEFAULT NULL,
  `postUser` varchar(255) NOT NULL,
  `postContent` mediumtext NOT NULL,
  `postDate` datetime DEFAULT NULL,
  PRIMARY KEY (`postID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table studyquest.blog_posts: ~1 rows (approximately)
/*!40000 ALTER TABLE `blog_posts` DISABLE KEYS */;
INSERT INTO `blog_posts` (`postID`, `postTitle`, `postDescription`, `postUser`, `postContent`, `postDate`) VALUES
	(1, 'What is Study Quest?', '<p>A blog overviewing our Level up Society Hackathon project, Study Quest.</p>', 'test', '<p>Study Quest is a gamified take on quizzes. It aims to eliminate the boring side of learning for children, leaving an entertaining way to educate students. Not only is Study Quest more interactive than textbooks, it also encourages students for revising and take quizzes by adding individual student progression, using an RPG style system to reward students with items such as swords, staffs and wands.</p>', '2021-07-18 13:42:41');
/*!40000 ALTER TABLE `blog_posts` ENABLE KEYS */;

-- Dumping structure for table studyquest.categories
DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `cat_id` int(8) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(255) DEFAULT NULL,
  `cat_description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`cat_id`),
  UNIQUE KEY `cat_name_unique` (`cat_name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table studyquest.categories: ~2 rows (approximately)
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` (`cat_id`, `cat_name`, `cat_description`) VALUES
	(1, 'Ask an Admin', 'A place where you can ask any questions to us!'),
	(2, 'Question Sets', 'A place where you can share question sets to one another.');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;

-- Dumping structure for table studyquest.posts
DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `post_id` int(8) NOT NULL AUTO_INCREMENT,
  `post_content` text DEFAULT NULL,
  `post_date` datetime DEFAULT NULL,
  `post_topic` int(8) DEFAULT NULL,
  `post_by` int(8) DEFAULT NULL,
  PRIMARY KEY (`post_id`),
  KEY `post_topic` (`post_topic`),
  KEY `post_by` (`post_by`),
  CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`post_topic`) REFERENCES `topics` (`topic_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`post_by`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table studyquest.posts: ~9 rows (approximately)
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` (`post_id`, `post_content`, `post_date`, `post_topic`, `post_by`) VALUES
	(1, 'Test post', '2021-07-17 15:12:24', 1, 11),
	(2, 'hello friend', '2021-07-17 15:12:38', 1, 11),
	(3, 'yo', '2021-07-17 15:14:08', 1, 8),
	(4, 'Hi! How do i share files?', '2021-07-17 15:15:05', 2, 8),
	(5, 'We have now added the game! check it out!\r\nhttp://localhost/studyquest.php', '2021-07-17 15:18:56', 3, 11),
	(6, 'testing', '2021-07-17 20:17:22', 1, 11),
	(9, 'Hey testing, I\'ve attatched the format as well as a sample question set below!', '2021-07-18 11:44:55', 2, 11),
	(11, 'Perfect, thanks adnan!', '2021-07-18 11:49:24', 2, 8),
	(12, 'Here is the question set for the Level up society hackathon.', '2021-07-18 11:55:07', 4, 11);
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;

-- Dumping structure for table studyquest.topics
DROP TABLE IF EXISTS `topics`;
CREATE TABLE IF NOT EXISTS `topics` (
  `topic_id` int(8) NOT NULL AUTO_INCREMENT,
  `topic_subject` varchar(255) DEFAULT NULL,
  `topic_date` datetime DEFAULT NULL,
  `topic_cat` int(8) DEFAULT NULL,
  `topic_by` int(8) DEFAULT NULL,
  PRIMARY KEY (`topic_id`),
  KEY `topic_cat` (`topic_cat`),
  KEY `topic_by` (`topic_by`),
  CONSTRAINT `topics_ibfk_1` FOREIGN KEY (`topic_cat`) REFERENCES `categories` (`cat_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `topics_ibfk_2` FOREIGN KEY (`topic_by`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table studyquest.topics: ~4 rows (approximately)
/*!40000 ALTER TABLE `topics` DISABLE KEYS */;
INSERT INTO `topics` (`topic_id`, `topic_subject`, `topic_date`, `topic_cat`, `topic_by`) VALUES
	(1, 'Hello World', '2021-07-17 15:12:24', 1, 11),
	(2, 'Sharing Files', '2021-07-17 15:15:05', 1, 8),
	(3, 'Adding the game', '2021-07-17 15:18:56', 2, 11),
	(4, 'Level Up Society Question Set', '2021-07-18 11:55:07', 2, 11);
/*!40000 ALTER TABLE `topics` ENABLE KEYS */;

-- Dumping structure for table studyquest.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(8) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(30) DEFAULT NULL,
  `user_pass` varchar(255) DEFAULT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `user_date` datetime DEFAULT NULL,
  `user_level` int(8) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_name_unique` (`user_name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table studyquest.users: ~2 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`user_id`, `user_name`, `user_pass`, `user_email`, `user_date`, `user_level`) VALUES
	(8, 'testing', 'dc724af18fbdd4e59189f5fe768a5f8311527050', 'test@test.com', '2021-07-17 11:43:40', 0),
	(11, 'adnan', 'd3a91c86221726cc029aacffc6563d4765946aca', 'adnan@adnan.com', '2021-07-17 11:56:58', 1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
