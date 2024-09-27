-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 27, 2024 at 10:43 PM
-- Server version: 8.0.30
-- PHP Version: 8.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `car-rental-app`
--

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` int NOT NULL,
  `car_type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `daily_rent_price` decimal(8,2) NOT NULL,
  `availability` tinyint(1) NOT NULL,
  `image` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`id`, `name`, `brand`, `model`, `year`, `car_type`, `daily_rent_price`, `availability`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Audi A4', 'Audi', 'A4', 2020, 'Sedan', '100.00', 0, 'uploads/1726710113-Audi-A4-01.png', '2024-09-18 19:41:53', '2024-09-25 20:53:58'),
(3, 'BMW X5', 'BMW', 'X5', 2019, 'SUV', '120.00', 0, 'uploads/1726873099-BMW-X5-01.png', '2024-09-20 16:58:19', '2024-09-27 15:49:09'),
(4, 'Mercedes C-Class', 'Mercedes-Benz', 'C300', 2021, 'Sedan', '110.00', 1, 'uploads/1727282214-Mercedes-C-Class-01.png', '2024-09-25 10:36:54', '2024-09-25 10:36:54'),
(5, 'Tesla Model 3', 'Tesla', 'Model 3', 2022, 'Sedan', '130.00', 0, 'uploads/1727282370-Tesla-Model-3-01.png', '2024-09-25 10:39:30', '2024-09-27 15:50:08'),
(6, 'Ford Mustang', 'Ford', 'Mustang', 2021, 'Coupe', '150.00', 0, 'uploads/1727282439-Ford-Mustang-02 .png', '2024-09-25 10:40:39', '2024-09-27 14:23:21'),
(7, 'Porsche 911', 'Porsche', '911', 2021, 'Coupe', '250.00', 1, 'uploads/1727282516-Porsche-911-02.png', '2024-09-25 10:41:56', '2024-09-26 14:21:13'),
(8, 'Land Rover Defender', 'Land Rover', 'Defender', 2022, 'SUV', '200.00', 0, 'uploads/1727282636-Land-Rover-Defender-02.png', '2024-09-25 10:43:56', '2024-09-27 14:46:09'),
(9, 'Fiat 500', 'Fiat', '500', 2020, 'Hatchback', '60.00', 1, 'uploads/1727287637-Fiat-500-01.png', '2024-09-25 12:07:18', '2024-09-27 15:47:51'),
(14, 'Audi Q7', 'Audi', 'Q7', 2021, 'SUV', '150.00', 1, 'uploads/1727474272-Audi-Q7-02.png', '2024-09-27 15:57:52', '2024-09-27 15:57:52'),
(15, 'Dodge Challenger', 'Dodge', 'Challenger', 2020, 'Coupe', '140.00', 1, 'uploads/1727474921-Dodge-Challenger-02.png', '2024-09-27 16:08:41', '2024-09-27 16:08:41'),
(16, 'Nissan Altima', 'Nissan', 'Altima', 2021, 'Sedan', '85.00', 1, 'uploads/1727475241-Nissan-Altima-02.png', '2024-09-27 16:14:01', '2024-09-27 16:14:01'),
(17, 'Cadillac Escalade', 'Cadillac', 'Escalade', 2021, 'SUV', '180.00', 1, 'uploads/1727475734-Cadillac-Escalade-01.png', '2024-09-27 16:22:14', '2024-09-27 16:22:14');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(4, '2024_09_17_214215_create_users_table', 1),
(5, '2024_09_17_214242_create_cars_table', 1),
(6, '2024_09_17_214257_create_rentals_table', 1),
(8, '2024_09_17_221743_add_address_to_users_table', 2),
(9, '2024_09_20_205317_add_status_to_rentals_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rentals`
--

CREATE TABLE `rentals` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `car_id` bigint UNSIGNED NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `total_cost` decimal(8,2) NOT NULL,
  `status` enum('Pending','Ongoing','Completed','Canceled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rentals`
--

INSERT INTO `rentals` (`id`, `user_id`, `car_id`, `start_date`, `end_date`, `total_cost`, `status`, `created_at`, `updated_at`) VALUES
(1, 4, 1, '2024-09-25', '2024-09-28', '400.00', 'Ongoing', '2024-09-20 16:53:49', '2024-09-25 20:53:58'),
(2, 4, 3, '2024-09-20', '2024-09-25', '720.00', 'Completed', '2024-09-20 17:01:31', '2024-09-25 20:46:10'),
(3, 2, 1, '2024-09-20', '2024-09-21', '200.00', 'Completed', '2024-09-20 17:04:53', '2024-09-21 15:15:18'),
(4, 2, 1, '2024-09-22', '2024-09-22', '100.00', 'Completed', '2024-09-21 10:52:29', '2024-09-22 15:24:50'),
(5, 4, 1, '2024-09-29', '2024-09-30', '200.00', 'Pending', '2024-09-21 10:55:20', '2024-09-21 10:55:20'),
(6, 7, 3, '2024-09-26', '2024-09-27', '240.00', 'Canceled', '2024-09-21 10:57:23', '2024-09-21 18:03:47'),
(7, 7, 3, '2024-09-29', '2024-09-29', '120.00', 'Pending', '2024-09-21 11:50:04', '2024-09-21 15:04:20'),
(8, 7, 3, '2024-09-26', '2024-09-27', '240.00', 'Completed', '2024-09-21 12:07:32', '2024-09-27 15:47:02'),
(9, 6, 3, '2024-09-28', '2024-09-28', '120.00', 'Ongoing', '2024-09-21 15:19:14', '2024-09-27 15:49:09'),
(11, 6, 1, '2024-10-01', '2024-10-02', '200.00', 'Canceled', '2024-09-22 15:37:19', '2024-09-22 15:48:44'),
(12, 6, 3, '2024-09-30', '2024-10-02', '360.00', 'Pending', '2024-09-22 15:38:57', '2024-09-22 15:38:57'),
(13, 10, 1, '2024-10-02', '2024-10-03', '200.00', 'Pending', '2024-09-25 21:42:59', '2024-09-25 21:42:59'),
(14, 9, 1, '2024-10-01', '2024-10-01', '100.00', 'Pending', '2024-09-25 21:44:39', '2024-09-25 21:44:39'),
(15, 6, 5, '2024-09-26', '2024-09-27', '260.00', 'Completed', '2024-09-25 22:23:48', '2024-09-27 15:41:00'),
(16, 2, 5, '2024-09-28', '2024-09-29', '260.00', 'Ongoing', '2024-09-25 22:24:54', '2024-09-27 15:50:08'),
(18, 4, 7, '2024-09-26', '2024-09-26', '250.00', 'Completed', '2024-09-25 22:33:40', '2024-09-26 14:21:13'),
(19, 6, 6, '2024-09-27', '2024-09-27', '150.00', 'Canceled', '2024-09-27 04:27:32', '2024-09-27 04:39:06'),
(20, 6, 9, '2024-09-27', '2024-09-27', '60.00', 'Completed', '2024-09-27 04:39:46', '2024-09-27 15:47:51'),
(21, 4, 8, '2024-09-28', '2024-09-28', '200.00', 'Canceled', '2024-09-27 11:17:27', '2024-09-27 12:28:21'),
(22, 4, 8, '2024-09-29', '2024-09-29', '200.00', 'Pending', '2024-09-27 11:24:11', '2024-09-27 11:24:11'),
(23, 4, 7, '2024-10-02', '2024-10-05', '1000.00', 'Pending', '2024-09-27 12:30:45', '2024-09-27 12:30:45'),
(28, 17, 8, '2024-09-28', '2024-09-28', '200.00', 'Ongoing', '2024-09-27 14:43:06', '2024-09-27 14:46:09'),
(29, 17, 15, '2024-10-02', '2024-10-03', '280.00', 'Pending', '2024-09-27 16:36:21', '2024-09-27 16:36:21');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'customer',
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `phone`, `address`, `created_at`, `updated_at`) VALUES
(1, 'Mahdi', 'mahdi@test.com', '123456', 'admin', NULL, NULL, '2024-09-17 18:26:06', '2024-09-18 00:26:45'),
(2, 'Max', 'max@test.com', '123456', 'customer', '7895612438', 'Manchester', '2024-09-17 18:27:55', '2024-09-25 16:49:30'),
(3, 'K-A-Mahdi', 'mdmahdi45@gmail.com', '123456', 'admin', NULL, NULL, '2024-09-18 19:13:31', '2024-09-19 01:16:37'),
(4, 'Mahdi Ambia', 'mkambiamahdi023@gmail.com', '123456', 'customer', '01777307585', 'Shapla Super Market,Staion Road,Sreemangal', '2024-09-18 19:16:12', '2024-09-18 19:16:12'),
(5, 'Admin', 'admin@test.com', '123456', 'admin', '01258749639', 'Sylhet', '2024-09-18 20:43:02', '2024-09-19 02:45:58'),
(6, 'John', 'john@test.com', '123456', 'customer', '4587963258', 'New York', '2024-09-18 20:44:28', '2024-09-18 20:44:28'),
(7, 'Mike', 'mike@test.com', '123456', 'customer', '8745963254', 'Detroit', '2024-09-18 20:45:10', '2024-09-18 20:45:10'),
(9, 'Rafael Leo', 'Leo@test.com', '123456', 'customer', '08596742698', 'California', '2024-09-23 18:54:30', '2024-09-25 15:07:56'),
(10, 'Michael', 'michael@test.com', '123456', 'customer', '7985463281', 'Los Santos', '2024-09-25 14:49:01', '2024-09-25 15:09:13'),
(17, 'M.K.A. Mahdi', 'mkamahdi03@gmail.com', '123456', 'customer', '01687230998', 'Shapla Super Market, Station Road', '2024-09-27 14:41:55', '2024-09-27 16:34:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `rentals`
--
ALTER TABLE `rentals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rentals_user_id_foreign` (`user_id`),
  ADD KEY `rentals_car_id_foreign` (`car_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rentals`
--
ALTER TABLE `rentals`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `rentals`
--
ALTER TABLE `rentals`
  ADD CONSTRAINT `rentals_car_id_foreign` FOREIGN KEY (`car_id`) REFERENCES `cars` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `rentals_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
