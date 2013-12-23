-- phpMyAdmin SQL Dump
-- version 4.0.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 22, 2013 at 07:08 PM
-- Server version: 5.1.70-cll
-- PHP Version: 5.3.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dwakeatb_p4_dwakeat_biz`
--

-- --------------------------------------------------------

--
-- Table structure for table `tales`
--

CREATE TABLE IF NOT EXISTS `tales` (
  `tale_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `complete` tinyint(1) NOT NULL,
  `current_author` int(11) NOT NULL,
  `place` int(11) NOT NULL,
  PRIMARY KEY (`tale_id`),
  UNIQUE KEY `tale_id` (`tale_id`),
  KEY `current_user` (`current_author`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tales`
--

INSERT INTO `tales` (`tale_id`, `title`, `complete`, `current_author`, `place`) VALUES
(2, 'genesis tale', 1, 16, 4),
(3, 'Test tale for library view', 1, 16, 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `current_tale` int(11) DEFAULT NULL,
  `created` int(11) NOT NULL,
  `modified` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_id` (`user_id`),
  KEY `current_tale` (`current_tale`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `current_tale`, `created`, `modified`, `token`) VALUES
(12, 'keat', 'mkeating2225@gmail.com', 'a0a2b6f0c73c2122a5ed7f5458abf40080f2fcff', NULL, 1386966179, 1386966179, '4d987d035736e25aac84212b31ed43ff54a87c37'),
(14, 'tester1', 'humbletales@gmail.com', 'bf0ac8f4177843110d4ab9f9bd9a61231fa692d2', NULL, 1387509759, 1387509759, 'bac759e1a5f552be52fef8279092e7b3fa6bdc87'),
(15, 'tester2', 'humbletales2@gmail.com', 'bf0ac8f4177843110d4ab9f9bd9a61231fa692d2', NULL, 1387562913, 1387562913, '8b323935afd618c1997277bcc268acd179219304'),
(16, 'tester3', 'humbletales3@gmail.com', 'bf0ac8f4177843110d4ab9f9bd9a61231fa692d2', NULL, 1387562929, 1387562929, 'b1a44917bba57b06b611714dfc1efb55b3bfb95f');

-- --------------------------------------------------------

--
-- Table structure for table `users_tales`
--

CREATE TABLE IF NOT EXISTS `users_tales` (
  `user_id` int(11) NOT NULL,
  `tale_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `section` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`tale_id`),
  KEY `user_id` (`user_id`,`tale_id`),
  KEY `users_tales_ibfk_2` (`tale_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_tales`
--

INSERT INTO `users_tales` (`user_id`, `tale_id`, `content`, `section`) VALUES
(12, 2, ' begins here', 1),
(12, 3, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque vestibulum nisl dictum, elementum orci id, aliquet felis. Morbi suscipit et ante at auctor. Phasellus urna eros, consequat quis nisi nec, auctor tincidunt tortor. Maecenas imperdiet tempor mauris, non tincidunt lacus volutpat a. Vestibulum facilisis euismod velit sed consectetur. Duis ac sapien blandit, tincidunt massa in, cursus sem. Integer ac ligula nisl. Donec sagittis lorem eget tortor interdum tincidunt. Aenean risus augue, porttitor a rhoncus et, hendrerit et ligula. Fusce vitae risus libero. Morbi massa turpis, ullamcorper nec ante at, molestie faucibus arcu. Nam quis convallis dolor. Nunc nunc risus, viverra et convallis ut, accumsan iaculis turpis. Sed tempus ligula accumsan magna pretium ultricies. Integer at augue sapien. Proin fringilla blandit lorem at tristique.\r\n\r\nFusce interdum odio in elit rutrum, at dapibus massa aliquet. Suspendisse quam erat, imperdiet fermentum lacinia eget, lacinia at massa. Interdum et malesuada fames ac ante ipsum primis in faucibus. Aenean convallis fringilla vulputate. Duis interdum euismod nunc et placerat. Etiam ultrices, purus in dictum scelerisque, nisi libero fermentum lectus, vitae bibendum lacus nisl sit amet leo. Nullam ut orci placerat, gravida velit ac, bibendum velit. Suspendisse dapibus ligula id facilisis ultricies. Donec vel nisl tempor, iaculis.', 1),
(14, 2, 'it continues on', 2),
(14, 3, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque vestibulum nisl dictum, elementum orci id, aliquet felis. Morbi suscipit et ante at auctor. Phasellus urna eros, consequat quis nisi nec, auctor tincidunt tortor. Maecenas imperdiet tempor mauris, non tincidunt lacus volutpat a. Vestibulum facilisis euismod velit sed consectetur. Duis ac sapien blandit, tincidunt massa in, cursus sem. Integer ac ligula nisl. Donec sagittis lorem eget tortor interdum tincidunt. Aenean risus augue, porttitor a rhoncus et, hendrerit et ligula. Fusce vitae risus libero. Morbi massa turpis, ullamcorper nec ante at, molestie faucibus arcu. Nam quis convallis dolor. Nunc nunc risus, viverra et convallis ut, accumsan iaculis turpis. Sed tempus ligula accumsan magna pretium ultricies. Integer at augue sapien. Proin fringilla blandit lorem at tristique.\r\n\r\nFusce interdum odio in elit rutrum, at dapibus massa aliquet. Suspendisse quam erat, imperdiet fermentum lacinia eget, lacinia at massa. Interdum et malesuada fames ac ante ipsum primis in faucibus. Aenean convallis fringilla vulputate. Duis interdum euismod nunc et placerat. Etiam ultrices, purus in dictum scelerisque, nisi libero fermentum lectus, vitae bibendum lacus nisl sit amet leo. Nullam ut orci placerat, gravida velit ac, bibendum velit. Suspendisse dapibus ligula id facilisis ultricies. Donec vel nisl tempor, iaculis.', 2),
(15, 2, 'and continues....', 3),
(15, 3, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque vestibulum nisl dictum, elementum orci id, aliquet felis. Morbi suscipit et ante at auctor. Phasellus urna eros, consequat quis nisi nec, auctor tincidunt tortor. Maecenas imperdiet tempor mauris, non tincidunt lacus volutpat a. Vestibulum facilisis euismod velit sed consectetur. Duis ac sapien blandit, tincidunt massa in, cursus sem. Integer ac ligula nisl. Donec sagittis lorem eget tortor interdum tincidunt. Aenean risus augue, porttitor a rhoncus et, hendrerit et ligula. Fusce vitae risus libero. Morbi massa turpis, ullamcorper nec ante at, molestie faucibus arcu. Nam quis convallis dolor. Nunc nunc risus, viverra et convallis ut, accumsan iaculis turpis. Sed tempus ligula accumsan magna pretium ultricies. Integer at augue sapien. Proin fringilla blandit lorem at tristique.\r\n\r\nFusce interdum odio in elit rutrum, at dapibus massa aliquet. Suspendisse quam erat, imperdiet fermentum lacinia eget, lacinia at massa. Interdum et malesuada fames ac ante ipsum primis in faucibus. Aenean convallis fringilla vulputate. Duis interdum euismod nunc et placerat. Etiam ultrices, purus in dictum scelerisque, nisi libero fermentum lectus, vitae bibendum lacus nisl sit amet leo. Nullam ut orci placerat, gravida velit ac, bibendum velit. Suspendisse dapibus ligula id facilisis ultricies. Donec vel nisl tempor, iaculis.', 3),
(16, 2, 'and ends. ', 4),
(16, 3, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque vestibulum nisl dictum, elementum orci id, aliquet felis. Morbi suscipit et ante at auctor. Phasellus urna eros, consequat quis nisi nec, auctor tincidunt tortor. Maecenas imperdiet tempor mauris, non tincidunt lacus volutpat a. Vestibulum facilisis euismod velit sed consectetur. Duis ac sapien blandit, tincidunt massa in, cursus sem. Integer ac ligula nisl. Donec sagittis lorem eget tortor interdum tincidunt. Aenean risus augue, porttitor a rhoncus et, hendrerit et ligula. Fusce vitae risus libero. Morbi massa turpis, ullamcorper nec ante at, molestie faucibus arcu. Nam quis convallis dolor. Nunc nunc risus, viverra et convallis ut, accumsan iaculis turpis. Sed tempus ligula accumsan magna pretium ultricies. Integer at augue sapien. Proin fringilla blandit lorem at tristique.\r\n\r\nFusce interdum odio in elit rutrum, at dapibus massa aliquet. Suspendisse quam erat, imperdiet fermentum lacinia eget, lacinia at massa. Interdum et malesuada fames ac ante ipsum primis in faucibus. Aenean convallis fringilla vulputate. Duis interdum euismod nunc et placerat. Etiam ultrices, purus in dictum scelerisque, nisi libero fermentum lectus, vitae bibendum lacus nisl sit amet leo. Nullam ut orci placerat, gravida velit ac, bibendum velit. Suspendisse dapibus ligula id facilisis ultricies. Donec vel nisl tempor, iaculis.', 4);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tales`
--
ALTER TABLE `tales`
  ADD CONSTRAINT `tales_ibfk_1` FOREIGN KEY (`current_author`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`current_tale`) REFERENCES `tales` (`tale_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `users_tales`
--
ALTER TABLE `users_tales`
  ADD CONSTRAINT `users_tales_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `users_tales_ibfk_2` FOREIGN KEY (`tale_id`) REFERENCES `tales` (`tale_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
