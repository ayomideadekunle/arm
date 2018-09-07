-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 07, 2018 at 03:12 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apartment_rental_mgt`
--
CREATE DATABASE IF NOT EXISTS `apartment_rental_mgt` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `apartment_rental_mgt`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `apartment`
--

CREATE TABLE `apartment` (
  `id` int(11) NOT NULL,
  `building_id` int(11) NOT NULL,
  `size` varchar(255) NOT NULL,
  `apartmentNumber` varchar(255) NOT NULL,
  `apartmentType` varchar(255) NOT NULL,
  `rentalFee` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `apartment`
--

INSERT INTO `apartment` (`id`, `building_id`, `size`, `apartmentNumber`, `apartmentType`, `rentalFee`, `status`) VALUES
(1, 1, '12', '001A', 'Duplex', '120000', 1),
(2, 1, '12', '002B', 'Duplex', '80000', 0);

-- --------------------------------------------------------

--
-- Table structure for table `apartmentChange`
--

CREATE TABLE `apartmentChange` (
  `id` int(11) NOT NULL,
  `lease_id` int(11) NOT NULL,
  `tenant_id` int(11) NOT NULL,
  `leavingAprtmentid` int(11) NOT NULL,
  `newApartment` varchar(255) NOT NULL,
  `changeDate` date NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `apartmentChange`
--

INSERT INTO `apartmentChange` (`id`, `lease_id`, `tenant_id`, `leavingAprtmentid`, `newApartment`, `changeDate`, `status`) VALUES
(1, 1, 1, 1, '2', '2018-08-23', 1);

-- --------------------------------------------------------

--
-- Table structure for table `building`
--

CREATE TABLE `building` (
  `id` int(11) NOT NULL,
  `buildingName` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `cityStateZip` varchar(255) NOT NULL,
  `isDeleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `building`
--

INSERT INTO `building` (`id`, `buildingName`, `address`, `cityStateZip`, `isDeleted`) VALUES
(1, 'Adekunle Ajasin', 'No 45, Idi Oro Street Apete, Ibadan', '23042', 0),
(2, 'Barrack Building', 'No 45, Awotan Apete, Ibadan', '23041', 0);

-- --------------------------------------------------------

--
-- Table structure for table `lease`
--

CREATE TABLE `lease` (
  `id` int(11) NOT NULL,
  `tenant_id` int(11) NOT NULL,
  `building_id` int(11) NOT NULL,
  `apartment_id` int(11) NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `balance` varchar(255) NOT NULL,
  `securityDeposit` varchar(255) NOT NULL,
  `period` varchar(255) NOT NULL,
  `rentalDate` text NOT NULL,
  `status` int(11) NOT NULL,
  `isnotified` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lease`
--

INSERT INTO `lease` (`id`, `tenant_id`, `building_id`, `apartment_id`, `startDate`, `endDate`, `balance`, `securityDeposit`, `period`, `rentalDate`, `status`, `isnotified`) VALUES
(1, 1, 1, 2, '2018-08-10', '2019-08-12', '3000', '8000', '12', '2018-08-10', 1, 1),
(2, 2, 1, 2, '2018-08-10', '2019-08-12', '3000', '8000', '12', '2018-08-10', 0, 0),
(5, 3, 1, 2, '2018-08-10', '2019-08-12', '3000', '8000', '12', '2018-08-10', 0, 0),
(6, 4, 1, 2, '2018-08-10', '2019-08-12', '3000', '8000', '12', '2018-08-10', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `maintenance`
--

CREATE TABLE `maintenance` (
  `id` int(11) NOT NULL,
  `tenant_id` int(11) NOT NULL,
  `apartment_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `request` text NOT NULL,
  `sent_date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `maintenance`
--

INSERT INTO `maintenance` (`id`, `tenant_id`, `apartment_id`, `category_id`, `request`, `sent_date`) VALUES
(1, 1, 2, 1, 'Maintenance Test', '2018:08:11');

-- --------------------------------------------------------

--
-- Table structure for table `maintenance_category`
--

CREATE TABLE `maintenance_category` (
  `id` int(11) NOT NULL,
  `categoryName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `maintenance_category`
--

INSERT INTO `maintenance_category` (`id`, `categoryName`) VALUES
(1, 'Pest & Insect Control');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `sender` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `user`, `sender`, `message`, `subject`, `date`) VALUES
(1, 1, 'Admin', 'Test Message', 'Test Subject', '2018-07-25'),
(2, 1, 'waLkEr Apartment Management', 'Your request for change of apartment has been granted', 'Apartment Change Request', '2018-08-11'),
(3, 3, 'waLkEr Apartment Management', 'Your contract will soon be renewed', 'Renewal of Contract Notice', '2018-08-12'),
(5, 3, 'waLkEr Apartment Management', 'Your contract will soon be renewed', 'Renewal of Contract Notice', '2018-08-12'),
(7, 1, 'waLkEr Apartment Management', 'Your contract will soon be renewed', 'Renewal of Contract Notice', '2018-08-24');

-- --------------------------------------------------------

--
-- Table structure for table `renewal`
--

CREATE TABLE `renewal` (
  `id` int(11) NOT NULL,
  `lease_id` int(11) NOT NULL,
  `renewalDate` text NOT NULL,
  `renewalPeriod` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `requestcategory`
--

CREATE TABLE `requestcategory` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `requestcategory`
--

INSERT INTO `requestcategory` (`id`, `type`) VALUES
(1, 'Change Apartment'),
(2, 'Terminate Lease'),
(3, 'Maintenance'),
(4, 'Renewal');

-- --------------------------------------------------------

--
-- Table structure for table `securityRefund`
--

CREATE TABLE `securityRefund` (
  `id` int(11) NOT NULL,
  `refundAmount` varchar(255) NOT NULL,
  `refundReason` text NOT NULL,
  `date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `securityRefund`
--

INSERT INTO `securityRefund` (`id`, `refundAmount`, `refundReason`, `date`) VALUES
(1, '12000', 'Testing', '2018-07-26');

-- --------------------------------------------------------

--
-- Table structure for table `termination`
--

CREATE TABLE `termination` (
  `id` int(11) NOT NULL,
  `tenant_id` int(11) NOT NULL,
  `leavingDate` date NOT NULL,
  `leavingReason` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `termination`
--

INSERT INTO `termination` (`id`, `tenant_id`, `leavingDate`, `leavingReason`) VALUES
(2, 1, '2018-08-30', 'Who wants to know');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `currentAddress` varchar(255) NOT NULL,
  `cityStateZip` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `phone`, `currentAddress`, `cityStateZip`, `password`, `role`) VALUES
(1, 'Lawal', 'Opeyemi', 'lawalopeyemi@gmail.com', '08130518823', 'NW23/142, Atowoda Nalende, Ibadan', 23041, '62d70e1801e11d1a9e6f22e813cd70c0', 'tenant'),
(2, 'Adekunle', 'Ayomide', 'ayomidekunle@gmail.com', '08128045472', 'Akowo Compound Oniyanrin, Ibadan', 23041, '09cf2ab8ba3b7e7558df11972ef80d39', 'tenant'),
(3, 'Salako', 'Adekunle', 'adekunle@gmail.com', '08130518823', 'NW23/142, Atowoda Nalende, Ibadan', 23041, '62d70e1801e11d1a9e6f22e813cd70c0', 'tenant'),
(4, 'Damilola', 'John', 'twodbk@gmail.com', '08128045472', 'Akowo Compound Oniyanrin, Ibadan', 23041, '09cf2ab8ba3b7e7558df11972ef80d39', 'tenant');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apartment`
--
ALTER TABLE `apartment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apartmentChange`
--
ALTER TABLE `apartmentChange`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `building`
--
ALTER TABLE `building`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lease`
--
ALTER TABLE `lease`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `maintenance`
--
ALTER TABLE `maintenance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `maintenance_category`
--
ALTER TABLE `maintenance_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `renewal`
--
ALTER TABLE `renewal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requestcategory`
--
ALTER TABLE `requestcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `securityRefund`
--
ALTER TABLE `securityRefund`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `termination`
--
ALTER TABLE `termination`
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
-- AUTO_INCREMENT for table `apartment`
--
ALTER TABLE `apartment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `apartmentChange`
--
ALTER TABLE `apartmentChange`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `building`
--
ALTER TABLE `building`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `lease`
--
ALTER TABLE `lease`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `maintenance`
--
ALTER TABLE `maintenance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `maintenance_category`
--
ALTER TABLE `maintenance_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `renewal`
--
ALTER TABLE `renewal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `requestcategory`
--
ALTER TABLE `requestcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `securityRefund`
--
ALTER TABLE `securityRefund`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `termination`
--
ALTER TABLE `termination`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
