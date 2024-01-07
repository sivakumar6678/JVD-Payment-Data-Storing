-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 06, 2024 at 09:46 AM
-- Server version: 8.0.17
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `paymentdetails`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(20) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_logs`
--

CREATE TABLE `payment_logs` (
  `Date` datetime NOT NULL,
  `Admission_Number` varchar(11) COLLATE utf8mb4_general_ci NOT NULL,
  `Name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `Fees_Type` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  `Amount_paid` decimal(10,0) NOT NULL,
  `Date_of_payment` date NOT NULL,
  `UTR_Number` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `studentdetails`
--

CREATE TABLE `studentdetails` (
  `ID` int(11) NOT NULL,
  `Admission_Number` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `Scholorship_Id` bigint(50) DEFAULT NULL,
  `Name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `Year` int(11) NOT NULL,
  `Branch` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `Jvd` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Phone_Number` bigint(20) DEFAULT NULL,
  `Admission_Fees` int(20) DEFAULT NULL,
  `Admission_Special_Fee` int(40) NOT NULL,
  `Tution_fee` bigint(20) DEFAULT NULL,
  `Special_fee` bigint(20) DEFAULT NULL,
  `UCS_fee` bigint(20) DEFAULT NULL,
  `Accommodation` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Email_Id` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `CET_Qualified` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Due_Amount` int(11) DEFAULT NULL,
  `Hostel_Fee` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Triggers `studentdetails`
--
DELIMITER $$
CREATE TRIGGER `update_due_amoun` BEFORE UPDATE ON `studentdetails` FOR EACH ROW BEGIN
    SET NEW.Due_Amount = COALESCE(NEW.Tution_fee, 0) + COALESCE(NEW.Special_fee, 0) + COALESCE(NEW.UCS_fee, 0);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_due_amount` BEFORE UPDATE ON `studentdetails` FOR EACH ROW BEGIN
    IF NEW.Tution_fee <> OLD.Tution_fee OR NEW.Special_fee <> OLD.Special_fee OR NEW.UCS_fee <> OLD.UCS_fee THEN
        SET NEW.Due_Amount = COALESCE(NEW.Tution_fee, 0) + COALESCE(NEW.Special_fee, 0) + COALESCE(NEW.UCS_fee, 0);
    END IF;
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `payment_logs`
--
ALTER TABLE `payment_logs`
  ADD KEY `fk_admission_number` (`Admission_Number`);

--
-- Indexes for table `studentdetails`
--
ALTER TABLE `studentdetails`
  ADD PRIMARY KEY (`Admission_Number`),
  ADD UNIQUE KEY `ID` (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `studentdetails`
--
ALTER TABLE `studentdetails`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=778;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `payment_logs`
--
ALTER TABLE `payment_logs`
  ADD CONSTRAINT `fk_admission_number` FOREIGN KEY (`Admission_Number`) REFERENCES `studentdetails` (`Admission_Number`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
