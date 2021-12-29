-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 04, 2021 at 02:15 AM
-- Server version: 10.6.4-MariaDB
-- PHP Version: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simplyeasyco`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `name` varchar(100) NOT NULL,
  `description` varchar(500) NOT NULL,
  `price` float(10,2) NOT NULL,
  `quantity` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`name`, `description`, `price`, `quantity`) VALUES
('Beer Flight with Glasses', 'Hand-made beer flights are perfect for any beer lover. Made out of local cedar, these beer flights are handcrafted, shaped, and stained in the beautiful Okanagan. They are made to order. Get yours now!', 50.00, 20),
('Blanket Ladder', 'The blanket ladder is to perfect decorative furniture for anyone who loves their blankets. Handcrafted from strong cedar, this ladder can hold many blankets. ', 75.00, 10),
('Gaming Baby Onesies', 'Did you just have a future gamer! Well, dress them up in the finest Gaming onesies around! All designs are made by SimplyEasy.', 39.99, 4),
('Valentines Music Plaque', 'Do you have a loved one you are struggling to get a gift for? Well, we have you covered with this perfect music plaque gift. We do the work, so you don\'t have to!', 49.99, 0);

-- --------------------------------------------------------

--
-- Table structure for table `prod_img`
--

CREATE TABLE `prod_img` (
  `prod_name` varchar(100) NOT NULL,
  `img_url` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `prod_img`
--

INSERT INTO `prod_img` (`prod_name`, `img_url`) VALUES
('Gaming Baby Onesies', 'images/babyonesie.jpg'),
('Beer Flight with Glasses', 'images/beerflight.jpg'),
('Blanket Ladder', 'images/blanketladder.jpg'),
('Valentines Music Plaque', 'images/musicplaque.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(25) NOT NULL,
  `password` varchar(50) DEFAULT NULL,
  `first_name` varchar(25) DEFAULT NULL,
  `last_name` varchar(25) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `start_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `first_name`, `last_name`, `email`, `start_date`) VALUES
('FreddieB', '*D37C49F9CBEFBF8B6F4B165AC703AA271E079004', 'Freddie', 'Banfield', 'freddiebanfield@googlemail.com', '2021-11-30 02:37:20'),
('Test', '*D37C49F9CBEFBF8B6F4B165AC703AA271E079004', 'test', 'test', 'test@gmail.com', '2021-11-30 02:37:57');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `name` varchar(100) NOT NULL,
  `description` varchar(500) NOT NULL,
  `view_count` int(11) NOT NULL,
  `like_count` int(11) NOT NULL,
  `url` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`name`, `description`, `view_count`, `like_count`, `url`) VALUES
('How to Customize Clothes using Cricut - 8 Easy Steps!', 'Hello DIYers, \r\n\r\nToday we customize and design clothes. We use baby onesies in this example but you can use anything from shirts, t-shits, tops, hoodies, dresses, crew necks and more.\r\n\r\nYou can add your own designs to any piece of clothing. Its so easy. With the cricut machine and the cricut press any thing is possible. You can mix up what ever color of vinyl, create great designs that look professional.', 0, 0, 'https://www.youtube.com/embed/VzYcmEGDJ7M');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `wish_id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`wish_id`, `username`) VALUES
(1, 'FreddieB'),
(2, 'Test');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist_prod`
--

CREATE TABLE `wishlist_prod` (
  `prod_name` varchar(100) NOT NULL,
  `quantity` int(9) NOT NULL,
  `total_price` float(10,2) NOT NULL,
  `wish_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `wishlist_prod`
--

INSERT INTO `wishlist_prod` (`prod_name`, `quantity`, `total_price`, `wish_id`) VALUES
('Blanket Ladder', 1, 75.00, 1),
('Gaming Baby Onesies', 1, 39.99, 1),
('Gaming Baby Onesies', 1, 39.99, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `prod_img`
--
ALTER TABLE `prod_img`
  ADD PRIMARY KEY (`img_url`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`wish_id`);

--
-- Indexes for table `wishlist_prod`
--
ALTER TABLE `wishlist_prod`
  ADD PRIMARY KEY (`wish_id`,`prod_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `wish_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `prod_img`
--
ALTER TABLE `prod_img`
  ADD CONSTRAINT `prod_img_name_FK` FOREIGN KEY (`prod_name`) REFERENCES `products` (`name`);

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `username_FK` FOREIGN KEY (`username`) REFERENCES `users` (`username`);

--
-- Constraints for table `wishlist_prod`
--
ALTER TABLE `wishlist_prod`
  ADD CONSTRAINT `prod_name_FK` FOREIGN KEY (`prod_name`) REFERENCES `products` (`name`),
  ADD CONSTRAINT `wishlist_id_FK` FOREIGN KEY (`wish_id`) REFERENCES `wishlist` (`wish_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
