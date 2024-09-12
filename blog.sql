-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 31, 2024 at 09:13 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`) VALUES
(7, 'HTML', 'HTML'),
(8, 'CSS', 'CSS'),
(9, 'JS', 'JS'),
(10, 'No Image', 'No Image'),
(11, 'For Testing', 'For Testing'),
(13, 'ishakkkk', 'hjklllllllllllllllllllllllllllllllllllllllllllllllllllll'),
(16, 'ishak', 'jnjbnkjb');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `content` longtext DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) NOT NULL,
  `category_id` bigint(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `slug`, `description`, `content`, `image`, `user_id`, `category_id`, `created_at`, `updated_at`) VALUES
(10, 'Post Two', 'post-two', 'desco', 'cont', NULL, 1, 7, '2024-06-28 07:06:27', '2024-06-28 07:06:27'),
(16, 'Post Three', 'post-three', 'oubib', 'uobbubuobb', NULL, 1, 9, '2024-06-28 16:33:57', '2024-06-28 16:33:57'),
(22, 'Post Four', 'post-four', 'ojqncoqncoqs', 'c oqjcnqo', NULL, 1, 10, '2024-06-28 16:47:06', '2024-06-28 16:47:06'),
(23, 'Post 6', 'post-6', 'qcnqnsc', 'cnnqc', NULL, 1, 10, '2024-06-28 16:48:41', '2024-06-28 16:48:41'),
(24, 'Post 7', 'post-7', 'ofozefhbozbf', 'ocbcbucbuouc', NULL, 1, 11, '2024-06-28 16:49:11', '2024-06-28 16:49:11'),
(39, 'Post 8', 'post-8', 'ljlbbjl', 'khbkhj', NULL, 1, 8, '2024-06-28 21:39:09', '2024-06-28 21:39:09'),
(40, 'knlnk', 'knlnk', 'km,m,', 'mkm,,', '/posts/laravel.png', 1, 11, '2024-07-03 13:39:46', '2024-07-03 13:39:46');

-- --------------------------------------------------------

--
-- Table structure for table `post_tag`
--

CREATE TABLE `post_tag` (
  `id` bigint(20) NOT NULL,
  `post_id` bigint(20) NOT NULL,
  `tag_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `post_tag`
--

INSERT INTO `post_tag` (`id`, `post_id`, `tag_id`) VALUES
(3, 10, 15),
(6, 16, 17),
(7, 16, 18),
(11, 22, 15),
(12, 22, 16),
(13, 22, 17),
(14, 22, 18),
(15, 23, 16),
(16, 23, 17),
(17, 24, 15),
(18, 24, 17),
(19, 24, 18),
(29, 39, 16),
(30, 39, 17),
(31, 40, 17);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`, `slug`, `description`) VALUES
(15, 'Tag One', 'tag-one', 'desco'),
(16, 'Tag Two', 'tag-two', 'desco'),
(17, 'Tag Three', 'tag-three', '3'),
(18, 'Tag Four', 'tag-four', '4');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `bio` text NOT NULL,
  `status` enum('yes','no') NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `mobile`, `bio`, `status`) VALUES
(1, 'Rayan', 'rayan@example.com', '$2y$10$8mPxqiZuyVDOJZ8DfzHRU.RO1DbhJlhcb3tba.AmyBhvmI/ltWc/y', '0555', 'hola hol hola hxhxhxjjxjxjxjjxjxjjxjjxjxjjxxhx uxjxjxjjx xhhxhx', 'yes'),
(2, 'Salah', 'salah@example.com', '2222', '0666', '', 'yes'),
(3, 'Ishak', 'ishak@example.com', '$2y$10$7YFHU.fSm6WljQL3k8MVQOsTYyybBr3hqYMq75xEmlP2fFjVsUHwy', '0888', '', 'no'),
(11, 'mohamed', 'med@gg.cc', '$2y$10$2bkbBrdoM8.drqhT5G2L7uS3JYHnCvm3gtPRqIbl7Q9it1xMDtcuq', '0777', '', 'no');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `post_tag`
--
ALTER TABLE `post_tag`
  ADD PRIMARY KEY (`id`),
  ADD KEY `INDEX` (`post_id`,`tag_id`) USING BTREE,
  ADD KEY `post_tag_ibfk_2` (`tag_id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `post_tag`
--
ALTER TABLE `post_tag`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `post_tag`
--
ALTER TABLE `post_tag`
  ADD CONSTRAINT `post_tag_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `post_tag_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
