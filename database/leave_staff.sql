-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2022 at 12:37 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `leave_staff`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `UserName` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `updationDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `UserName`, `Password`, `updationDate`) VALUES
(1, 'admin', '827ccb0eea8a706c4c34a16891f84e7b', '2022-04-27 21:45:38');

-- --------------------------------------------------------

--
-- Table structure for table `tbldepartments`
--

CREATE TABLE `tbldepartments` (
  `id` int(11) NOT NULL,
  `DepartmentName` varchar(150) DEFAULT NULL,
  `DepartmentShortName` varchar(100) NOT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbldepartments`
--

INSERT INTO `tbldepartments` (`id`, `DepartmentName`, `DepartmentShortName`, `CreationDate`) VALUES
(2, 'Information Technologies', 'ICT', '2017-11-01 07:19:37'),
(3, 'Library', 'LIb', '2021-05-21 08:27:45');

-- --------------------------------------------------------

--
-- Table structure for table `tblemployees`
--

CREATE TABLE `tblemployees` (
  `emp_id` int(11) NOT NULL,
  `FirstName` varchar(150) NOT NULL,
  `LastName` varchar(150) NOT NULL,
  `EmailId` varchar(200) NOT NULL,
  `Password` varchar(180) NOT NULL,
  `Gender` varchar(100) NOT NULL,
  `Dob` varchar(100) NOT NULL,
  `Department` varchar(255) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `Av_leave` varchar(150) NOT NULL,
  `Phonenumber` char(11) NOT NULL,
  `Status` int(1) NOT NULL,
  `RegDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `role` varchar(30) NOT NULL,
  `location` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblemployees`
--

INSERT INTO `tblemployees` (`emp_id`, `FirstName`, `LastName`, `EmailId`, `Password`, `Gender`, `Dob`, `Department`, `Address`, `Av_leave`, `Phonenumber`, `Status`, `RegDate`, `role`, `location`) VALUES
(1, 'Janobe', 'Martins', 'janobe@janobe.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Male', '3 February, 1990', 'ICT', 'N NEPO', '30', '0248865955', 1, '2017-11-10 11:29:59', 'Staff', 'NO-IMAGE-AVAILABLE.jpg'),
(2, 'Edem', 'Mcwilliams', 'james@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Male', '3 February, 1990', 'ICT', 'N NEPO', '30', '8587944255', 1, '2017-11-10 13:40:02', 'Admin', 'photo2.jpg'),
(4, 'Nathaniel', 'Nkrumah', 'nat@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Male', '3 February, 1990', 'ICT', 'N NEPO', '30', '587944255', 1, '2017-11-10 13:40:02', 'Admin', 'NO-IMAGE-AVAILABLE.jpg'),
(5, 'Gideon', 'Annan', 'gideon@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Male', '3 February, 1990', 'ICT', 'N NEPO', '30', '587944255', 1, '2017-11-10 13:40:02', 'HOD', 'photo5.jpg'),
(7, 'Bridget', 'Gafa', 'bridget@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Female', '3 February, 1990', 'ICT', 'N NEPO', '5', '0596667981', 1, '2017-11-10 13:40:02', 'Staff', '1920_File_logo4.png'),
(8, 'Anna', 'Mensah', 'an@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Female', '3 February, 1990', 'ICT', 'N NEPO', '30', '587944255', 1, '2017-11-10 13:40:02', 'DVC', 'NO-IMAGE-AVAILABLE.jpg'),
(9, 'Patrick', 'Nachenga', 'pmkale@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'male', '01 February 1990', 'ICT', 'fgfgf fgfgf gf', '35', '0700000000', 1, '2022-04-28 22:02:44', 'Staff', 'NO-IMAGE-AVAILABLE.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tblleaves`
--

CREATE TABLE `tblleaves` (
  `id` int(11) NOT NULL,
  `LeaveType` varchar(110) NOT NULL,
  `ToDate` date NOT NULL,
  `FromDate` date NOT NULL,
  `Description` mediumtext NOT NULL,
  `PostingDate` date NOT NULL,
  `hod_remark` varchar(100) DEFAULT NULL,
  `principal_remark` varchar(100) NOT NULL,
  `principal_action_date` timestamp NULL DEFAULT NULL,
  `hod_action_date` timestamp NULL DEFAULT NULL,
  `dvc_action_date` timestamp NULL DEFAULT NULL,
  `hod_status` int(11) NOT NULL DEFAULT 0,
  `principal_status` int(11) NOT NULL DEFAULT 0,
  `IsRead` int(1) NOT NULL,
  `empid` int(11) DEFAULT NULL,
  `num_days` int(11) NOT NULL,
  `dvc_status` int(11) NOT NULL DEFAULT 0,
  `dvc_remark` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblleaves`
--

INSERT INTO `tblleaves` (`id`, `LeaveType`, `ToDate`, `FromDate`, `Description`, `PostingDate`, `hod_remark`, `principal_remark`, `principal_action_date`, `hod_action_date`, `dvc_action_date`, `hod_status`, `principal_status`, `IsRead`, `empid`, `num_days`, `dvc_status`, `dvc_remark`) VALUES
(13, 'Casual Leave', '2022-05-02', '2021-05-12', 'I want to take a leave.', '2021-05-20', 'Ok', 'ok', '2021-05-25 03:26:19', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 1, 1, 7, 3, 0, NULL),
(14, 'Medical Leave', '0000-00-00', '0000-00-00', 'Noted', '0000-00-00', 'Not this time', '', '2021-05-21 07:31:10', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 1, 6, 4, 0, NULL),
(16, 'Casual Leave', '0000-00-00', '0000-00-00', 'Nice Leave', '2021-05-20', 'Ok', 'Noted', '2021-05-25 03:42:18', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 1, 1, 7, 4, 0, NULL),
(17, 'Casual Leave', '0000-00-00', '0000-00-00', 'Just', '2021-05-21', 'Leave Approved', 'Noted', '2021-05-25 02:56:45', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 1, 1, 7, 5, 0, NULL),
(18, 'Casual Leave', '0000-00-00', '0000-00-00', 'dsds', '2022-04-28', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 7, 15, 0, ''),
(19, 'Casual Leave', '0000-00-00', '0000-00-00', 'dsds', '2022-04-28', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 7, 15, 0, ''),
(20, 'Medical Leave', '2022-04-14', '2022-04-01', 'dfdfd', '2022-04-28', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 7, 14, 0, ''),
(21, 'Casual Leave', '2022-04-05', '2022-04-03', 'dfdfd', '2022-04-28', 'cvcvcvcvc', '', '0000-00-00 00:00:00', '2022-04-29 05:52:08', '0000-00-00 00:00:00', 1, 0, 1, 7, 3, 0, ''),
(22, 'Medical Leave', '2022-05-04', '2022-05-01', 'fgdfg fdgdfg df d gdf g', '2022-04-29', 'yes am so sorry go and resh', 'go please', '2022-04-29 07:31:40', '2022-04-29 07:15:34', '0000-00-00 00:00:00', 1, 1, 2, 9, 4, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `tblleavetype`
--

CREATE TABLE `tblleavetype` (
  `id` int(11) NOT NULL,
  `LeaveType` varchar(200) DEFAULT NULL,
  `Description` mediumtext DEFAULT NULL,
  `date_from` varchar(200) NOT NULL,
  `date_to` varchar(200) NOT NULL,
  `CreationDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblleavetype`
--

INSERT INTO `tblleavetype` (`id`, `LeaveType`, `Description`, `date_from`, `date_to`, `CreationDate`) VALUES
(5, 'Casual Leave', 'Casual Leave', '2021-05-23', '2021-06-20', '2021-05-19 14:32:03'),
(6, 'Medical Leave', 'Medical Leave', '2021-05-05', '2021-05-28', '2021-05-19 15:29:05'),
(8, 'Other', 'Leave all staff', '31-05-2021', '04-06-2021', '2021-05-20 17:17:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbldepartments`
--
ALTER TABLE `tbldepartments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblemployees`
--
ALTER TABLE `tblemployees`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `tblleaves`
--
ALTER TABLE `tblleaves`
  ADD PRIMARY KEY (`id`),
  ADD KEY `UserEmail` (`empid`);

--
-- Indexes for table `tblleavetype`
--
ALTER TABLE `tblleavetype`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbldepartments`
--
ALTER TABLE `tbldepartments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblemployees`
--
ALTER TABLE `tblemployees`
  MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tblleaves`
--
ALTER TABLE `tblleaves`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tblleavetype`
--
ALTER TABLE `tblleavetype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
