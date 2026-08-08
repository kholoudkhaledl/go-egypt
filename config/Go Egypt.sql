-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 07, 2026 at 07:24 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30
--
-- This is the single, merged database file for the project.
-- It replaces the old "go_egypt (6).sql" + "migration_new_tables.sql"
-- pair (those tables are already included here) so there is now only
-- ONE database/one file to import: `Go Egypt`.

--
-- Database: `Go Egypt`
--

CREATE DATABASE IF NOT EXISTS `Go Egypt` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `Go Egypt`;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- --------------------------------------------------------

--
-- Table structure for table `destinations`
--

CREATE TABLE `destinations` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `region` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `img_url` varchar(255) NOT NULL,
  `display_order` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `destinations`
--

INSERT INTO `destinations` (`id`, `title`, `category`, `region`, `description`, `img_url`, `display_order`) VALUES
(1, 'Great Pyramids of giza', 'Ancient Egypt', 'lower Egypt', 'The monumental ancient pyramids and the iconic Great Sphinx on the Giza plateau', 'https://images.unsplash.com/photo-1503177119275-0aa32b3a9368?q=80&w=600', 0),
(2, 'Karnak Temple Complex', 'Ancient Egypt', 'Upper Egypt', 'A vast open-air museum and monumental temple.', 'https://images.unsplash.com/photo-1568322445389-f64ac2515020?q=80&w=600', 0),
(3, 'Citadel of Saladin', 'Islamic & Coptic', 'Lower Egypt', 'A medieval Islamic-era fortification in Cairo.', 'https://images.unsplash.com/photo-1707590713861-2437f9a8a43c?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8Y2l0YWRlbHxlbnwwfHwwfHx8MA%3D%3D', 0),
(4, 'Temple of Hatshepsut', 'Ancient Egypt', 'Upper Egypt', 'A mortuary temple built during the reign of Pharaoh Hatshepsut.', 'https://i.pinimg.com/1200x/1c/b2/11/1cb211c06592a96a59b575f0eb4a55ef.jpg', 0),
(5, 'Abu Simbel Temples', 'Ancient Egypt', 'Upper Egypt', 'Two massive rock-cut temples built by King Ramses II in southern Aswan.', 'https://images.unsplash.com/photo-1742262379112-eacb2813ca6d?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8QWJ1JTIwU2ltYmVsJTIwVGVtcGxlc3xlbnwwfHwwfHx8MA%3D%3D', 0),
(6, 'Al-Muizz Street', 'Islamic & Coptic', 'Lower Egypt', 'One of the oldest streets in Cairo, filled with historic Islamic architecture.', 'https://i.pinimg.com/736x/58/1f/14/581f1476ead6de86c3c8accd981b3e6f.jpg', 0),
(7, 'The Hanging Church', 'Islamic & Coptic', 'Lower Egypt', 'One of the oldest Coptic churches in Egypt, located in Old Cairo.', 'https://i.pinimg.com/736x/b9/5a/17/b95a175e2d3ab617053303bc067d5b38.jpg', 0),
(8, 'Kaitbay Citadel', 'Coastal & Red Sea', 'Alexandria', 'A 15th-century defensive fortress located on the Mediterranean coast .', 'https://i.pinimg.com/1200x/31/83/53/318353932234d37db1d32cf77db84b24.jpg', 0),
(9, 'Ras Mohamed Reserve', 'Coastal & Red Sea', 'Red Sea & Sinai', 'A famous marine national park near Sharm El Sheikh known for coral reefs.', 'https://i.pinimg.com/1200x/50/34/9f/50349faab84ffdab763843f56b37c9c6.jpg', 0),
(10, 'Siwa Oasis', 'Oases & Desert', 'Western Desert', 'A scenic desert oasis known for its salt lakes and ancient oracle temples.', 'https://i.pinimg.com/736x/8f/09/f8/8f09f88d9342338a75c1a546ae6e3382.jpg', 0),
(11, 'White Desert', 'Oases & Desert', 'Western Desert', 'A unique desert area featuring surreal, chalk-white rock formations.', 'https://i.pinimg.com/736x/82/68/42/8268427f404a60272fe067f9b1a0c747.jpg', 0),
(12, 'Grand Egyptian Museum', 'Museums & Culture', 'Lower Egypt', 'The largest archaeological museum in the world dedicated to ancient Egypt.', 'https://i.pinimg.com/1200x/f2/c8/bd/f2c8bd058c9d15ae9133077dac3b3d1f.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `booking_ref` varchar(20) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `landmark_id` int(11) NOT NULL,
  `landmark_title` varchar(255) NOT NULL,
  `region` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `checkin_date` varchar(50) DEFAULT NULL,
  `checkout_date` varchar(50) DEFAULT NULL,
  `adults` int(11) NOT NULL DEFAULT 1,
  `children` int(11) NOT NULL DEFAULT 0,
  `hotel_name` varchar(255) DEFAULT NULL,
  `hotel_price_per_night` decimal(10,2) NOT NULL DEFAULT 0.00,
  `nights` int(11) NOT NULL DEFAULT 0,
  `entry_ticket_total` decimal(10,2) NOT NULL DEFAULT 0.00,
  `transportation_total` decimal(10,2) NOT NULL DEFAULT 0.00,
  `trans_cars` int(11) NOT NULL DEFAULT 1,
  `tour_guide_total` decimal(10,2) NOT NULL DEFAULT 0.00,
  `taxes_fees` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total_price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `nationality` varchar(50) DEFAULT NULL,
  `payment_method` varchar(50) NOT NULL,
  `card_last4` varchar(4) DEFAULT NULL,
  `wallet_number` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Migration for existing databases (run this ONCE if your `bookings` table
-- was created before the `trans_cars` column existed, e.g. via phpMyAdmin
-- or the MySQL CLI). It's safe to skip if you're importing this whole file
-- fresh into a new/empty database, since the CREATE TABLE above already
-- includes the column.
--
-- ALTER TABLE `bookings` ADD COLUMN `trans_cars` int(11) NOT NULL DEFAULT 1 AFTER `transportation_total`;

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `subject` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hotels`
--

CREATE TABLE `hotels` (
  `id` int(11) NOT NULL,
  `landmark_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `price_per_night` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hotels`
--

INSERT INTO `hotels` (`id`, `landmark_id`, `name`, `image`, `price_per_night`) VALUES
(1, 1, 'Marriott Mena House', '../assets/images-ExploreDetails/hotel1-giza.jpg', 150.00),
(2, 1, 'Pyramids View Inn', '../assets/images-ExploreDetails/hotel2-giza.jpeg', 90.00),
(3, 1, 'Giza Pyramids Palace', '../assets/images-ExploreDetails/hotel3-giza.webp', 110.00),
(4, 2, 'Steigenberger Nile Palace Luxor', '../assets/images-ExploreDetails/hotel1-Karnak.webp', 130.00),
(5, 2, 'Hilton Luxor Resort & Spa', '../assets/images-ExploreDetails/hotel2-Karnak.jpg', 140.00),
(6, 2, 'Old Palace Luxor', '../assets/images-ExploreDetails/hotel3-Karnak.jpg', 125.00),
(7, 3, 'Four Seasons Cairo at Nile Plaza', '../assets/images-ExploreDetails/hotel1-Citadel.webp', 180.00),
(8, 3, 'Steigenberger El Tahrir Cairo', '../assets/images-ExploreDetails/hotel2-Citadel.webp', 120.00),
(9, 3, 'Marriott Mena House (View)', '../assets/images-ExploreDetails/hotel3-Citadel.webp', 150.00),
(10, 4, 'Al Moudira Hotel Luxor', '../assets/images-ExploreDetails/hotel1-Hatshepsut.jpg', 160.00),
(11, 4, 'Sofitel Winter Palace Luxor', '../assets/images-ExploreDetails/hotel2-Hatshepsut.webp', 175.00),
(12, 4, 'Mara House Luxor', '../assets/images-ExploreDetails/hotel3-Hatshepsut.webp', 95.00),
(13, 5, 'Sofitel Legend Old Cataract Aswan', '../assets/images-ExploreDetails/hotel1-Simbel.jpg', 220.00),
(14, 5, 'Pyramisa Island Hotel Aswan', '../assets/images-ExploreDetails/hotel2-Simbel.webp', 135.00),
(15, 5, 'Basma Hotel Aswan', '../assets/images-ExploreDetails/hotel3-Simbel.webp', 105.00),
(16, 6, 'Le Riad Hotel de Charme', '../assets/images-ExploreDetails/hotel1-Muizz.jpg', 140.00),
(17, 6, 'Steigenberger El Tahrir Cairo', '../assets/images-ExploreDetails/hotel2-Muizz.webp', 120.00),
(18, 6, 'Meraki Inn Cairo', '../assets/images-ExploreDetails/hotel3-Muizz.webp', 85.00),
(19, 7, 'Steigenberger El Tahrir Cairo', '../assets/images-ExploreDetails/hotel1-Hanging.jpeg', 120.00),
(20, 7, 'Fairmont Nile City Cairo', '../assets/images-ExploreDetails/hotel2-Hanging.jpg', 160.00),
(21, 7, 'Triumph Luxury Hotel Cairo', '../assets/images-ExploreDetails/hotel3-Hanging.jpeg', 110.00),
(22, 8, 'Four Seasons Alexandria', '../assets/images-ExploreDetails/hotel1-Qaitbay1.webp', 190.00),
(23, 8, 'Helnan Palestine Hotel', '../assets/images-ExploreDetails/hotel2-Qaitbay1.jpg', 130.00),
(24, 8, 'Alexander the Great Hotel', '../assets/images-ExploreDetails/hotel3-Qaitbay1.webp', 80.00),
(25, 9, 'Four Seasons Sharm El Sheikh', '../assets/images-ExploreDetails/hotel1-Mohamed.webp', 250.00),
(26, 9, 'Sunrise Arabian Beach Resort', '../assets/images-ExploreDetails/hotel2-Mohamed.webp', 170.00),
(27, 9, 'Savoy Sharm El Sheikh', '../assets/images-ExploreDetails/hotel3-Mohamed.webp', 140.00),
(28, 10, 'Adrère Amellal Siwa', '../assets/images-ExploreDetails/hotel1-Siwa.jpeg', 200.00),
(29, 10, 'Albabenshal Siwa Hotel', '../assets/images-ExploreDetails/hotel2-Siwa.webp', 90.00),
(30, 10, 'Dream Lodge Siwa', '../assets/images-ExploreDetails/hotel3-Siwa.jpg', 75.00),
(31, 11, 'Badawya Tent Camp Farafra', '../assets/images-ExploreDetails/hotel1-White.jpg', 60.00),
(32, 11, 'Al Haize Oasis Hotel', '../assets/images-ExploreDetails/hotel2-White.webp', 70.00),
(33, 11, 'Desert Safari Camp', '../assets/images-ExploreDetails/hotel3-White.jpg', 65.00),
(34, 12, 'Marriott Mena House', '../assets/images-ExploreDetails/hotel1-Grand.jpg', 150.00),
(35, 12, 'Hyatt Regency Cairo West', '../assets/images-ExploreDetails/hotel2-Grand.webp', 130.00),
(36, 12, 'Steigenberger Pyramids', '../assets/images-ExploreDetails/hotel3-Grand.jpg', 95.00);

-- --------------------------------------------------------

--
-- Table structure for table `landmarks`
--

CREATE TABLE `landmarks` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `region` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `ticket_price` decimal(10,2) NOT NULL DEFAULT 20.00,
  `duration` varchar(50) DEFAULT '3 Hours',
  `best_time` varchar(100) DEFAULT 'Oct - Mar',
  `landmark_type` varchar(100) DEFAULT 'Historical'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `landmarks`
--

INSERT INTO `landmarks` (`id`, `name`, `region`, `description`, `image`, `ticket_price`, `duration`, `best_time`, `landmark_type`) VALUES
(1, 'Great Pyramids of Giza', 'Lower Egypt', 'The monumental ancient pyramids and the iconic Great Sphinx on the Giza plateau, one of the Seven Wonders of the Ancient World.', '../assets/images-ExploreDetails/giza1.webp', 20.00, '3 Hours', 'Oct - Mar', 'Historical'),
(2, 'Karnak Temple', 'Upper Egypt', 'A vast mix of decayed temples, chapels, pylons, and other buildings near Luxor, Egypt.', '../assets/images-ExploreDetails/Karnak1.jpg', 15.00, '2.5 Hours', 'Nov - Feb', 'Archaeological'),
(3, 'Citadel of Saladin', 'Cairo, Egypt', 'A medieval Islamic-era fortification in Cairo, Egypt, built by Salah ad-Din (Saladin) in the 12th century.', '../assets/images-ExploreDetails/Citadel1.jpg', 12.00, '2 Hours', 'All Year', 'Islamic History'),
(4, 'Temple of Hatshepsut', 'Luxor & Aswan', 'A mortuary temple built during the reign of Pharaoh Hatshepsut of the Eighteenth Dynasty of Egypt.', '../assets/images-ExploreDetails/Hatshepsut1.jpeg', 15.00, '2 Hours', 'Oct - Apr', 'Ancient Egypt'),
(5, 'Abu Simbel Temples', 'Luxor & Aswan', 'Two massive rock-cut temples built by King Ramses II in southern Aswan, famous for their colossal rock relief statues.', '../assets/images-ExploreDetails/Simbel1.webp', 25.00, '4 Hours', 'Oct - Mar', 'Ancient Egypt'),
(6, 'Al-Muizz Street', 'Cairo & Giza', 'One of the oldest streets in Cairo, filled with historic Islamic architecture, magnificent mosques, and traditional markets.', '../assets/images-ExploreDetails/Muizz.jpg', 10.00, '2.5 Hours', 'All Year', 'Islamic & Coptic'),
(7, 'The Hanging Church', 'Cairo & Giza', 'One of the oldest Coptic churches in Egypt, built on the ruins of the Babylon Fortress gatehouse in Old Cairo.', '../assets/images-ExploreDetails/Hanging1.jpg', 10.00, '2 Hours', 'All Year', 'Islamic & Coptic'),
(8, 'Kaitbay Citadel', 'Alexandria', 'A 15th-century defensive fortress located on the Mediterranean coast, built on the site of the ancient Lighthouse of Alexandria.', '../assets/images-ExploreDetails/Qaitbay1.jpg', 15.00, '2.5 Hours', 'All Year', 'Coastal & Red Sea'),
(9, 'Ras Mohamed Reserve', 'Sinai & Red Sea', 'A famous marine national park near Sharm El Sheikh known for coral reefs, rare marine life, and mangrove channels.', '../assets/images-ExploreDetails/Mohamed1.webp', 25.00, '5 Hours', 'All Year', 'Coastal & Red Sea'),
(10, 'Siwa Oasis', 'Western Desert', 'A scenic desert oasis known for its salt lakes, palm groves, hot springs, and ancient oracle temples.', '../assets/images-ExploreDetails/Siwa1.webp', 15.00, '4 Hours', 'Oct - Apr', 'Oases & Desert'),
(11, 'White Desert', 'Western Desert', 'A unique desert area featuring surreal, chalk-white rock formations sculpted by windstorms over thousands of years.', '../assets/images-ExploreDetails/White1.jpg', 20.00, '6 Hours', 'Oct - Mar', 'Oases & Desert'),
(12, 'Grand Egyptian Museum', 'Cairo & Giza', 'The largest archaeological museum in the world dedicated to ancient Egypt, housing thousands of priceless artifacts.', '../assets/images-ExploreDetails/Grand1.webp', 30.00, '3.5 Hours', 'All Year', 'Museums & Culture');

-- --------------------------------------------------------

--
-- Table structure for table `landmark_images`
--

CREATE TABLE `landmark_images` (
  `id` int(11) NOT NULL,
  `landmark_id` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `landmark_images`
--

INSERT INTO `landmark_images` (`id`, `landmark_id`, `image_path`) VALUES
(1, 1, '../assets/images-ExploreDetails/giza1.webp'),
(2, 1, '../assets/images-ExploreDetails/giza2.webp'),
(3, 1, '../assets/images-ExploreDetails/giza3.jpg'),
(4, 1, '../assets/images-ExploreDetails/giza4.jpg'),
(5, 2, '../assets/images-ExploreDetails/Karnak1.jpg'),
(6, 2, '../assets/images-ExploreDetails/Karnak2.webp'),
(7, 2, '../assets/images-ExploreDetails/Karnak3.jpg'),
(8, 2, '../assets/images-ExploreDetails/Karnak4.jpeg'),
(9, 3, '../assets/images-ExploreDetails/Citadel1.jpg'),
(10, 3, '../assets/images-ExploreDetails/Citadel2.jpg'),
(11, 3, '../assets/images-ExploreDetails/Citadel3.webp'),
(12, 3, '../assets/images-ExploreDetails/Citadel4.avif'),
(13, 4, '../assets/images-ExploreDetails/Hatshepsut1.jpeg'),
(14, 4, '../assets/images-ExploreDetails/Hatshepsut2.webp'),
(15, 4, '../assets/images-ExploreDetails/Hatshepsut3.jpg'),
(16, 4, '../assets/images-ExploreDetails/Hatshepsut4.jpg'),
(17, 5, '../assets/images-ExploreDetails/Simbel1.webp'),
(18, 5, '../assets/images-ExploreDetails/Simbel2.webp'),
(19, 5, '../assets/images-ExploreDetails/Simbel3.webp'),
(20, 5, '../assets/images-ExploreDetails/Simbel4.webp'),
(21, 6, '../assets/images-ExploreDetails/Muizz.jpg'),
(22, 6, '../assets/images-ExploreDetails/Muizz2.webp'),
(23, 6, '../assets/images-ExploreDetails/Muizz3.jpg'),
(24, 6, '../assets/images-ExploreDetails/Muizz4.webp'),
(25, 7, '../assets/images-ExploreDetails/Hanging1.jpg'),
(26, 7, '../assets/images-ExploreDetails/Hanging2.webp'),
(27, 7, '../assets/images-ExploreDetails/Hanging3.webp'),
(28, 7, '../assets/images-ExploreDetails/Hanging4.jpg'),
(29, 8, '../assets/images-ExploreDetails/Qaitbay1.jpg'),
(30, 8, '../assets/images-ExploreDetails/Qaitbay2.avif'),
(31, 8, '../assets/images-ExploreDetails/Qaitbay3.webp'),
(32, 8, '../assets/images-ExploreDetails/Qaitbay4.webp'),
(33, 9, '../assets/images-ExploreDetails/Mohamed1.webp'),
(34, 9, '../assets/images-ExploreDetails/Mohamed2.jpg'),
(35, 9, '../assets/images-ExploreDetails/Mohamed3.jpg'),
(36, 9, '../assets/images-ExploreDetails/Mohamed4.webp'),
(37, 10, '../assets/images-ExploreDetails/Siwa1.webp'),
(38, 10, '../assets/images-ExploreDetails/Siwa2.jpg'),
(39, 10, '../assets/images-ExploreDetails/Siwa3.webp'),
(40, 10, '../assets/images-ExploreDetails/Siwa4.webp'),
(41, 11, '../assets/images-ExploreDetails/White1.jpg'),
(42, 11, '../assets/images-ExploreDetails/White2.avif'),
(43, 11, '../assets/images-ExploreDetails/White3.webp'),
(44, 11, '../assets/images-ExploreDetails/White4.webp'),
(45, 12, '../assets/images-ExploreDetails/Grand1.webp'),
(46, 12, '../assets/images-ExploreDetails/Grand2.webp'),
(47, 12, '../assets/images-ExploreDetails/Grand3.webp'),
(48, 12, '../assets/images-ExploreDetails/Grand4.webp');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `Fname` varchar(100) NOT NULL,
  `Lname` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `Fname`, `Lname`, `email`, `phone`, `pass`) VALUES
(1, 'kholoud', 'khaled', 'kholoud@gmail.com', NULL, '12345'),
(2, 'k', 'kh', 'kh@gmail.com', NULL, '12345'),
(3, 'kholoud', 'mahmoud', 'kholoudmahmoud@gmail.com', '01027600312', '$2y$10$Htt2dcyCHjIertn47QLEqu0ANg3NRg7TqwYrQQitjQlMphU0GVIyq'),
(4, 'zienab', 'hassan', 'zoz@gmail.com', '01060335893', '$2y$10$b3cGUqldNv91n0CGmrMyxu5Rqg3g.jHPbIAMONh9O2g3f0KHhhZ0a');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `landmark_id` (`landmark_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `destinations`
--
ALTER TABLE `destinations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hotels`
--
ALTER TABLE `hotels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `landmark_id` (`landmark_id`);

--
-- Indexes for table `landmarks`
--
ALTER TABLE `landmarks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `landmark_images`
--
ALTER TABLE `landmark_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `landmark_id` (`landmark_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `destinations`
--
ALTER TABLE `destinations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `hotels`
--
ALTER TABLE `hotels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `landmarks`
--
ALTER TABLE `landmarks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `landmark_images`
--
ALTER TABLE `landmark_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`landmark_id`) REFERENCES `landmarks` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `hotels`
--
ALTER TABLE `hotels`
  ADD CONSTRAINT `hotels_ibfk_1` FOREIGN KEY (`landmark_id`) REFERENCES `landmarks` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `landmark_images`
--
ALTER TABLE `landmark_images`
  ADD CONSTRAINT `landmark_images_ibfk_1` FOREIGN KEY (`landmark_id`) REFERENCES `landmarks` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
