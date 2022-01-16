-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 14, 2022 at 02:46 PM
-- Server version: 8.0.27-0ubuntu0.20.04.1
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `orange`
--

-- --------------------------------------------------------

--
-- Table structure for table `o_posts`
--

CREATE TABLE `o_posts` (
  `id` int NOT NULL,
  `title` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `author` int NOT NULL,
  `status` int NOT NULL DEFAULT '5',
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `o_posts`
--

INSERT INTO `o_posts` (`id`, `title`, `description`, `author`, `status`, `updated`) VALUES
(1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam vehicula massa vel nibh laoreet efficitur. Morbi sodales auctor elit. In ac odio odio. Praesent vestibulum purus et lectus vulputate, vitae vestibulum lorem tempus. Fusce viverra pharetra faucibus. Aliquam et feugiat est. Maecenas libero diam, condimentum vel lacinia id, vulputate ac magna. Vestibulum purus augue, mattis a suscipit at, suscipit vitae arcu. Nam in massa et massa aliquet egestas. Donec ornare malesuada tortor, vitae blandit orci pellentesque quis. Maecenas molestie sit amet lectus vel lobortis. Nunc id tortor dignissim, sodales sapien id, porta orci. Duis malesuada vitae eros in posuere.</p>\r\n\r\n<p>Praesent iaculis leo in augue malesuada, eget interdum elit consectetur. Duis lacinia condimentum molestie. Pellentesque tristique dui nulla, quis accumsan nisl cursus sed. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nam pretium enim ac augue aliquet gravida. Fusce dapibus magna a dui aliquet, non ornare metus consectetur. Mauris mollis ante sed arcu dapibus pretium. Donec ut sapien nec velit tincidunt vehicula. Quisque ut cursus dolor, eu tempus nisi. Nullam nunc nisi, semper ac enim ac, semper condimentum dolor. Aenean ullamcorper erat id quam aliquam, at porttitor quam rhoncus. Proin mollis odio turpis, vitae ornare tellus auctor vitae. Vestibulum ullamcorper felis nibh, in venenatis tortor condimentum id. Aenean id orci maximus, tempor est sit amet, faucibus nibh. Praesent sollicitudin lobortis lobortis. Aliquam non mauris ut est lacinia placerat.</p>', 1, 5, '2022-01-14 08:52:40'),
(2, 'Title2', 'Description2', 1, 5, '2022-01-14 09:15:55');

-- --------------------------------------------------------

--
-- Table structure for table `o_users`
--

CREATE TABLE `o_users` (
  `id` int NOT NULL,
  `username` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `level` int NOT NULL,
  `status` int NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `o_users`
--

INSERT INTO `o_users` (`id`, `username`, `password`, `first_name`, `last_name`, `level`, `status`, `updated`) VALUES
(1, 'nipuna', '$2y$10$3YqHcRcKBcVVu1zrMpioHes1PRIwJTnUbawbA1tkB3YPtG73ErSZe', 'Nipuna', 'Dodantenna', 10, 5, '2022-01-14 08:27:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `o_posts`
--
ALTER TABLE `o_posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `o_users`
--
ALTER TABLE `o_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `o_posts`
--
ALTER TABLE `o_posts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `o_users`
--
ALTER TABLE `o_users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
