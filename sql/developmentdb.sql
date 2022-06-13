-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Jun 13, 2022 at 08:16 PM
-- Server version: 10.6.5-MariaDB-1:10.6.5+maria~focal
-- PHP Version: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `developmentdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `car`
--

CREATE TABLE `car` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `registrationNumber` varchar(128) NOT NULL,
  `brand` varchar(128) NOT NULL,
  `model` varchar(128) NOT NULL,
  `year` int(11) NOT NULL,
  `price` varchar(128) NOT NULL,
  `image` varchar(2000) NOT NULL,
  `categoryId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `car`
--

INSERT INTO `car` (`id`, `userId`, `registrationNumber`, `brand`, `model`, `year`, `price`, `image`, `categoryId`) VALUES
(1, 1, '647918572', 'Toyota', 'Aygo', 2010, '23000', 'https://voorraad.autodatawheelerdelta.nl/static-storage1/autodata/images/occasions-module/17/17074117_1.jpg?3959582501', 5),
(2, 1, '847192752', 'Honda', 'S2000', 2018, '30000', 'https://www.autoblog.nl/files/2020/04/Honda-S2000-CR.jpg', 10),
(19, 1, '647281927', 'Ford', 'Focus', 2017, '213000', 'https://media.autoweek.nl/m/uqry8mqbi42g_800.jpg', 7),
(20, 1, '162847162', 'BMW', '5 Series', 2015, '30000', 'https://upload.wikimedia.org/wikipedia/commons/thumb/5/52/BMW_G30_FL_IMG_5351.jpg/1920px-BMW_G30_FL_IMG_5351.jpg', 14),
(23, 2, '471629482', 'Hyundai', 'KONA', 2017, '21200', 'https://cdn.jdpower.com/JDPA_2020%20Hyundai%20Kona%20Ultimate%20White%20Front%20View.jpg', 6),
(24, 2, '562817265', 'Mazda', ' CX-5', 2015, '19000', 'https://nieuws.mazda.nl/wp-content/uploads/2020/11/cx-5-2021-nov20.jpg', 6),
(25, 2, '572817264', 'Peugeot', '306', 1999, '15000', 'https://s1.cdn.autoevolution.com/images/gallery/PEUGEOT306Cabriolet-2679_2.jpg', 10),
(26, 2, '375839285', 'Volkswagen', 'Polo', 28000, '2018', 'https://content.presspage.com/uploads/1397/1920_volkswagenpolor-line4-2.jpg?10000', 15);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(5, 'Micro'),
(6, 'SUV'),
(7, 'Hatchback'),
(8, 'Pickup'),
(9, 'Minivan'),
(10, 'Convertible'),
(11, 'Supercar'),
(12, 'Truck'),
(13, 'Coupe'),
(14, 'Sedan'),
(15, 'Compact');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `role`) VALUES
(1, 'username', '$2y$10$DQlV0u9mFmtOWsOdxXX9H.4kgzEB3E8o97s.S.Pdy4klUAdBvtVh.', 'username@password.com', 'Admin'),
(2, 'paxer2k', '$2a$10$gnjzzOAkjSsel3VXajWyu.t6328.QUCkRmprl.D/oJg2u0F9m9I42', 'test123@test.nl', 'User');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `car`
--
ALTER TABLE `car`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`),
  ADD KEY `categoryId` (`categoryId`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `car`
--
ALTER TABLE `car`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `car`
--
ALTER TABLE `car`
  ADD CONSTRAINT `car_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `car_ibfk_2` FOREIGN KEY (`categoryId`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
