-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 15, 2025 at 12:18 PM
-- Server version: 8.0.33-0ubuntu0.20.04.2
-- PHP Version: 8.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mabook`
--

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `website` varchar(255) NOT NULL,
  `description` mediumtext NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`id`, `name`, `website`, `description`, `created_at`) VALUES
(1, 'Cahyo', 'cahyo.web.id', 'mantep cuy', '2012-02-12 00:00:00'),
(2, 'Wawan', 'wawan.web.id', 'oke', '2011-02-01 00:00:00'),
(3, 'Gunawan ', 'gunawan.cong', 'ya gunawan', '2025-06-14 21:36:58'),
(4, 'Stephen Cox', 'coxueueue.com', 'ya', '2025-06-14 21:37:35'),
(5, 'Jack Wildeyeeee', 'wileye.oye', 'Ya, oye', '2025-06-14 21:37:54'),
(6, 'Dave Ettiad', 'davecuy.co.us', 'Ya, anjay', '2025-06-14 21:38:29'),
(7, 'Wright Britton Oye', 'brrrpatapim.co.uk', 'Ya, okelhh', '2025-06-14 21:38:54'),
(11, 'Andrea Hirata', 'https://andreahirata.com', 'Penulis novel terkenal asal Indonesia, dikenal lewat karya-karya inspiratif seperti Laskar Pelangi.', '2025-06-15 14:13:41'),
(12, 'Tere Liye', 'tereliye.com', 'Penulis produktif Indonesia yang banyak menulis novel bergenre drama, fantasi, dan motivasi.', '2025-06-15 14:14:01'),
(13, 'J.K. Rowling', 'rowling.com', 'Penulis asal Inggris, pencipta seri novel Harry Potter yang sangat terkenal di seluruh dunia.', '2025-06-15 14:14:19'),
(14, 'George Orwell', 'https://orwellfoundation.com', 'Penulis dan jurnalis Inggris yang dikenal dengan karya distopia seperti 1984 dan Animal Farm.', '2025-06-15 14:14:32'),
(15, 'Yuval Noah Harari', 'https://www.ynharari.com', 'Sejarawan dan penulis asal Israel yang dikenal lewat buku Sapiens dan Homo Deus.', '2025-06-15 14:14:46');

-- --------------------------------------------------------

--
-- Table structure for table `bookmarks`
--

CREATE TABLE `bookmarks` (
  `id` bigint NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `book_id` bigint UNSIGNED NOT NULL,
  `last_page_read` int DEFAULT NULL,
  `last_read` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bookmarks`
--

INSERT INTO `bookmarks` (`id`, `user_id`, `book_id`, `last_page_read`, `last_read`) VALUES
(3, 3, 9, 1, '2025-06-15 16:57:39'),
(4, 3, 7, 0, '2025-06-14 16:58:01'),
(5, 3, 8, 3, '2025-06-15 18:34:17'),
(6, 3, 6, 2, '2025-06-15 17:41:59'),
(7, 4, 8, 3, '2025-06-15 18:11:58');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `exemplars` varchar(255) NOT NULL,
  `author_id` bigint UNSIGNED NOT NULL,
  `publisher_id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `year` varchar(255) NOT NULL,
  `file` mediumtext NOT NULL,
  `cover` mediumtext NOT NULL,
  `description` mediumtext NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `exemplars`, `author_id`, `publisher_id`, `category_id`, `year`, `file`, `cover`, `description`, `created_at`) VALUES
(1, 'Laskar Pelangi', '8', 1, 1, 2, '2025', '/docs/Laskar Pelangi-15-06-2025 08:09:09.pdf', '/images/cover/Laskar Pelangi-15-06-2025 08:09:09.jpg', 'Ya itu', '2011-07-28 00:00:00'),
(6, 'Bumi', '19', 12, 3, 2, '2025', '/docs/Bumi-15-06-2025 08:12:06pdf', '/images/cover/Bumi-15-06-2025 08:17:56.jpg', 'Novel pertama dalam serial \"Bumi\" karya Tere Liye. Serial ini bercerita tentang petualangan tiga remaja, Raib, Seli, dan Ali, yang memiliki kekuatan super dan terhubung dengan dunia paralel. ', '2025-06-15 15:12:06'),
(7, 'Harry Potter and the Philosopher\'s Stone', '221', 13, 5, 2, '1997', '/docs/Harry Potter and the Philosopher\'s Stone-15-06-2025 08:17:10pdf', '/images/cover/Harry Potter and the Philosopher\'s Stone-15-06-2025 08:17:10webp', 'Harry Potter and the Philosopher\'s Stone is a 2001 fantasy film directed by Chris Columbus and produced by David Heyman from a screenplay by Steve Kloves', '2025-06-15 15:17:10'),
(8, '1984', '123', 14, 5, 2, '1990', '/docs/1984-15-06-2025 08:19:13.pdf', '/images/cover/1984-15-06-2025 08:19:13.jpg', 'novel distopia karya George Orwell yang diterbitkan pada tahun 1949. Novel ini menceritakan tentang kehidupan di Oceania', '2025-06-15 15:19:13'),
(9, 'Sapiens: A Brief History of Humankind', '412', 13, 5, 3, '2005', '/docs/Sapiens: A Brief History of Humankind-15-06-2025 08:20:20.pdf', '/images/cover/Sapiens: A Brief History of Humankind-15-06-2025 08:20:20.jpg', 'Sapiens: Riwayat Singkat Umat Manusia atau Sapiens: A Brief History of Humankind adalah sebuah buku karya Yuval Noah Harari,', '2025-06-15 15:20:20');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`) VALUES
(2, 'Fiksi', 'Ya fiksi'),
(3, 'Saintek', 'ya saintek'),
(4, 'Non Fiksi', 'Kategori yang mencakup buku berdasarkan fakta dan kejadian nyata, seperti biografi dan buku sejarah.');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int NOT NULL,
  `comment` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `book_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `comment`, `book_id`, `user_id`, `created_at`) VALUES
(2, 'Mantep, oke juga', 8, 3, '2025-06-15 17:25:21'),
(3, 'Sip,  bagus.', 8, 3, '2025-06-15 17:25:58'),
(4, 'Oke juga ini', 6, 3, '2025-06-15 17:41:57'),
(5, 'Wokeh,  terinspirasi saya', 8, 4, '2025-06-15 18:11:48');

-- --------------------------------------------------------

--
-- Table structure for table `publishers`
--

CREATE TABLE `publishers` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `website` varchar(255) NOT NULL,
  `description` mediumtext NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `publishers`
--

INSERT INTO `publishers` (`id`, `name`, `website`, `description`, `created_at`) VALUES
(1, 'Elex Mediaaa', 'elex.comac', 'elekc', '2025-06-14 22:32:48'),
(3, 'Bentang Pustaka', 'https://bentangpustaka.com', 'Penerbit buku Indonesia yang menerbitkan berbagai buku fiksi dan non-fiksi berkualitas.', '2025-06-15 14:15:03'),
(4, 'Gramedia Pustaka Utama', 'https://gpu.id', 'Salah satu penerbit terbesar di Indonesia, terkenal dengan karya sastra dan buku populer.', '2025-06-15 14:15:15'),
(5, 'Bloomsbury Publishing', 'https://www.bloomsbury.com', 'Penerbit asal Inggris yang menerbitkan buku-buku besar seperti seri Harry Potter.', '2025-06-15 14:15:28');

-- --------------------------------------------------------

--
-- Table structure for table `read_points`
--

CREATE TABLE `read_points` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `book_id` bigint UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('ADMIN','USER') NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `username`, `password`, `role`, `created_at`) VALUES
(3, 'Wildan', 'me@wildani.dev', 'wildani', '$2y$10$WifBPxA4PJT19jttFOocleO7M495up/7w80lsT2EP9mMy/oIPUsBa', 'ADMIN', '2025-06-14 19:28:27'),
(4, 'Wawan Cahyo', 'wawan@mail.com', 'wawan', '$2y$10$v.mjf3fuD6X5.2A/H/LPQ.R8cZWNQEexk42UJQPPEQerclG9O9sZC', 'USER', '2025-06-14 20:03:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookmarks`
--
ALTER TABLE `bookmarks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `bookmarks_index_0` (`user_id`),
  ADD KEY `bookmarks_index_1` (`book_id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `books_index_0` (`author_id`),
  ADD KEY `books_index_1` (`publisher_id`),
  ADD KEY `books_index_2` (`category_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `book_id` (`book_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `publishers`
--
ALTER TABLE `publishers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `read_points`
--
ALTER TABLE `read_points`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `read_points_index_0` (`user_id`),
  ADD KEY `read_points_index_1` (`book_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_index_0` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `bookmarks`
--
ALTER TABLE `bookmarks`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `publishers`
--
ALTER TABLE `publishers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `read_points`
--
ALTER TABLE `read_points`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookmarks`
--
ALTER TABLE `bookmarks`
  ADD CONSTRAINT `bookmarks_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`),
  ADD CONSTRAINT `bookmarks_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`publisher_id`) REFERENCES `publishers` (`id`),
  ADD CONSTRAINT `books_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `books_ibfk_3` FOREIGN KEY (`author_id`) REFERENCES `authors` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `read_points`
--
ALTER TABLE `read_points`
  ADD CONSTRAINT `read_points_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `read_points_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
