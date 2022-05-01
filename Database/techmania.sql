-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2021 at 07:32 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `techmania`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `product_id`, `user_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(20, 1, 23, 2, 15000, '2021-11-18 10:30:51', '2021-11-22 07:53:14'),
(21, 4, 23, 1, 12750, '2021-11-18 10:30:54', '2021-11-18 10:30:54');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(4, '2021_10_27_063923_create_password_resets_table', 1),
(5, '2021_10_27_171554_create_products_table', 2),
(6, '2021_10_27_182849_create_cart_table', 3),
(7, '2021_10_27_202706_create_orders_table', 4),
(8, '2021_11_04_171623_create_cart_table', 5),
(9, '2021_11_05_153314_create_orders_table', 6),
(10, '2021_11_07_172616_create_ratings_table', 7),
(11, '2021_11_15_181159_create_cart_table', 8),
(12, '2021_11_15_190223_create_cart_table', 9),
(13, '2021_11_15_191841_create_products_table', 10),
(14, '2021_11_15_195538_create_orders_table', 11);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `product_id`, `quantity`, `price`, `user_id`, `status`, `payment_method`, `payment_status`, `address`, `created_at`, `updated_at`) VALUES
(8, 1, 2, 16060, 23, 'Pending', 'COD', 'Pending', 'Shahbag', '2021-11-16 12:43:23', '2021-11-16 12:43:23'),
(9, 4, 3, 40860, 23, 'Pending', 'COD', 'Pending', 'Shahbag', '2021-11-16 12:43:23', '2021-11-16 12:43:23');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gallery` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `category`, `description`, `gallery`, `created_at`, `updated_at`) VALUES
(1, 'Razer Kraken', 7500, 'Headphone', '7.1 Razer Kraken Gaming Headset: Lightweight Aluminum Frame, Retractable Noise Isolating Microphone, For PC, PS4, PS5, Switch, Xbox One, Xbox Series X & S, Mobile, 3.5 mm Audio Jack.', 'https://www.techinn.com/f/13747/137472838/razer-kraken-ultimate-gaming-headset.jpg', NULL, NULL),
(2, 'Razer DeathAdder Essential', 4800, 'Mouse', 'Razer DeathAdder Essential Gaming Mouse. Optical 6400 DPI, 5 Programmable sensors, Mechanical Switches, Rubber Side Grips.', 'https://www.techlandbd.com/image/cache/catalog/Mouse%20Pad/Razer/DeathAdder%20Essential%20Mouse%20Goliathus%20Speed%20Pikachu/razer-deathadder-essential-goliathus-pikachu-combo-1-1000x1000.jpg', NULL, NULL),
(3, 'Redragon K568', 6999, 'Keyboard', '87 High-quality mechanical switches, RGB full color LED backlit keys, Full key anti-ghosting, Golden plated USB port and Spill-proof design.', 'https://www.techlandbd.com/image/cache/catalog/Keyboard/Redragon/K568%20DARK%20AVENGER/redragon-k568-dark-avenger-rgb-keyboard-2-1000x1000.jpg', NULL, NULL),
(4, '\r\nCorsair H150', 12750, 'CPU Cooler', 'The CORSAIR H150 RGB all-in-one liquid CPU cooler delivers strong, dependable cooling and stunning lighting, with three CORSAIR SP120 RGB ELITE PWM fans, a 360mm radiator, and 37 RGB LEDs.', 'https://www.techlandbd.com/image/cache/catalog/Cooler/corsair/corsair-h150-rgb-cpu-cooler-1000x1000.jpg', NULL, NULL),
(8, 'NZXT Kraken X53 240mm', 13300, 'CPU Cooler', 'The NZXT Kraken X53 RGB 240mm All-in-One Liquid CPU Cooler is a stunning must-have for any build with the addition of NZXT RGB fans. With a re-designed cap and larger infinity mirror ring LED, the Kraken X53 RGB delivers an amazing experience in luminous.', 'https://www.techlandbd.com/image/cache/catalog/CPU-Cooler/NZXT/Kraken%20X53%20RGB/Kraken-X53-RGB-1-1000x1000.jpg', NULL, NULL),
(10, 'Redragon GM200', 2950, 'Microphone', 'The Redragon GM200 QUASAR features a unique patented design and it is origins from battle concept airship, be personally on the scene. It has a high-quality Omni-9765 condenser mic unit, Omnidirectional, delicate, and rich sound pickup.', 'https://www.techlandbd.com/image/cache/catalog/Microphone/REDRAGON/GM200/redragon-gm200-gaming-stream-microphone-1-1000x1000.jpg', NULL, NULL),
(12, 'Logitech K380', 2500, 'Keyboard', 'Logitech K380 Multi-Device Bluetooth Keyboard – Windows, Mac, Chrome OS, Android, iPad, iPhone, Apple TV Compatible – with Flow Cross-Computer Control and Easy-Switch up to 3 Devices.', 'https://www.techlandbd.com/image/cache/catalog/Keyboard/Logitech/logitech-k380-bluetooth-multi-device-keyboard-1000x1000.png', NULL, NULL),
(13, 'Cooler Master MA610P', 4500, 'CPU Cooler', 'Cooler Master MasterAir MA610P ARGB CPU Air Cooler featured with 6 Uniform Heat PipesDual SickleFlow 120 ARGB, Unique Top Cover with ARGB Illumination, ARGB Controller. This CPU Cooler is Certified with ASUS, MSI, GIGABYTE, ASRock ARGB Features and RM 299', 'https://www.techlandbd.com/image/cache/catalog/CPU-Cooler/COOLER%20MASTE/MASTERAIR%20MA610P/cooler-master-masterair-ma610p-rgb-cpu-cooler-pri-1000x1000.png', NULL, NULL),
(14, 'Logitech MX Master 3', 11800, 'Mouse', 'MX Master 3 is an advanced Master series mouse, designed for creatives and engineered for coders. It has 7 buttons: Left/Right-click, Back/Forward, App-Switch, Wheel mode-shift, Middle click. Scroll 1,000 lines in 1 second. The MagSpeed Electromagnetic sc', 'https://www.startech.com.bd/image/cache/catalog/mouse/logitech/mx-master-3/mx-master-3-mild-grey-3-4-front-500x500.jpg', NULL, NULL),
(15, 'Logitech G733', 19999, 'Headphone', 'The Logitech G733 Lightspeed RGB gaming headset combines stunning design with an array of unique features to ensure an immersive gaming experience. Equipped with a powerful microphone, this gaming headset enables rich and clear voice capture.', 'https://images.hermanmiller.group/m/7d940bbc3c5864f1/W-HM_LGM_20322_F3_transparent.png?trim=auto&blend-mode=darken&blend=f8f8f8&trim-sd=1&bg=f8f8f8&auto=format&w=2000&h=1000&q=60', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prod_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stars_rated` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`id`, `user_id`, `prod_id`, `stars_rated`, `created_at`, `updated_at`) VALUES
(2, '23', '1', '2', '2021-11-07 12:26:35', '2021-11-22 07:55:40'),
(3, '24', '1', '3', '2021-11-08 07:47:45', '2021-11-08 07:47:45');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `email_verification_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `is_active`, `email_verification_code`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(23, 'Hasibul', 'Hossain', 'hasibulhossainshajeeb@gmail.com', '1', 'Qd9Bh0Y7NntOwmdG0enytInseSw6gg9esuoyKvWK', '2021-10-27 13:03:48', '$2y$10$J.F5UwfJOAWqd1HsdSIkI.OaH8pvNWAEvKlcGNgewW/HhweYAz9Z.', NULL, '2021-10-27 13:03:30', '2021-10-27 13:03:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
