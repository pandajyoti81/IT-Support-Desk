-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 15, 2023 at 05:20 AM
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
-- Database: `itsupportdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminlogin`
--

CREATE TABLE `adminlogin` (
  `adminid` int(60) NOT NULL,
  `username` varchar(60) NOT NULL,
  `password` varchar(65) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adminlogin`
--

INSERT INTO `adminlogin` (`adminid`, `username`, `password`) VALUES
(1, 'Jyoti', 'Tttt4');

-- --------------------------------------------------------

--
-- Table structure for table `complaintype`
--

CREATE TABLE `complaintype` (
  `complainid` int(60) NOT NULL,
  `complaintype` varchar(60) NOT NULL,
  `complainstatus` varchar(65) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `complaintype`
--

INSERT INTO `complaintype` (`complainid`, `complaintype`, `complainstatus`) VALUES
(31, 'CPU', 'Active'),
(32, 'Monitor', 'Active'),
(33, 'screen', 'Active'),
(34, 'cable', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `complaintypedescription`
--

CREATE TABLE `complaintypedescription` (
  `complaindescid` int(60) NOT NULL,
  `complaintypeid` int(60) NOT NULL,
  `complaindesc` varchar(65) NOT NULL,
  `complaindescstatus` varchar(60) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `complaintypedescription`
--

INSERT INTO `complaintypedescription` (`complaindescid`, `complaintypeid`, `complaindesc`, `complaindescstatus`) VALUES
(7, 31, 'sedfw', 'Active'),
(8, 31, 'no light', 'Active'),
(9, 33, 'yyyyyyyyyyyyyyyyuujj', 'Active'),
(10, 31, 'out of ink', 'Active'),
(11, 32, 'hhhhhhhh', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `departmentdetails`
--

CREATE TABLE `departmentdetails` (
  `deptid` int(60) NOT NULL,
  `department` varchar(60) NOT NULL,
  `deptstatus` varchar(65) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departmentdetails`
--

INSERT INTO `departmentdetails` (`deptid`, `department`, `deptstatus`) VALUES
(58, 'HR', 'Active'),
(60, 'Marketing', 'Active'),
(67, 'cable', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `itteam`
--

CREATE TABLE `itteam` (
  `itteamid` int(60) NOT NULL,
  `username` varchar(60) NOT NULL,
  `password` varchar(65) NOT NULL,
  `name` varchar(60) NOT NULL,
  `mobile` varchar(60) NOT NULL,
  `emailid` varchar(60) NOT NULL,
  `createdt` date DEFAULT current_timestamp(),
  `status` varchar(60) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `itteam`
--

INSERT INTO `itteam` (`itteamid`, `username`, `password`, `name`, `mobile`, `emailid`, `createdt`, `status`) VALUES
(23, 'Anand01', 'Ssss4', 'Anand', '7777777778', 'anand81@gmail.com', '2023-12-13', 'Active'),
(25, 'tushar02', 'Uuuu3', 'Tushar', '7777777777', 'pandajyoti81@gmail.com', '2023-12-13', 'Active'),
(26, 'rajesh09', 'Uuuu8', 'Rajesh', '9090090909', 'rajesu@gmail.com', '2023-12-13', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `usercomplain`
--

CREATE TABLE `usercomplain` (
  `usercomplainid` int(60) NOT NULL,
  `deptid` int(60) NOT NULL,
  `userid` int(65) NOT NULL,
  `complaintypeid` int(60) NOT NULL,
  `complaindescid` int(200) NOT NULL,
  `itteamid` int(60) NOT NULL,
  `emailid` varchar(60) NOT NULL,
  `complaindt` date NOT NULL,
  `complaintime` varchar(60) NOT NULL,
  `resolvedt` date NOT NULL,
  `resolvetime` varchar(60) NOT NULL,
  `complainstatus` varchar(60) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usercomplain`
--

INSERT INTO `usercomplain` (`usercomplainid`, `deptid`, `userid`, `complaintypeid`, `complaindescid`, `itteamid`, `emailid`, `complaindt`, `complaintime`, `resolvedt`, `resolvetime`, `complainstatus`) VALUES
(24, 58, 31, 31, 7, 23, 'pandajyoti81@gmail.com', '2023-12-13', '13:14:36pm', '2023-12-14', '18:17:28pm', 'Resolve'),
(25, 60, 32, 31, 8, 26, 'ramesh72@gmail.com', '2023-12-13', '15:19:02pm', '2023-12-13', '15:22:17pm', 'Resolve'),
(27, 58, 31, 31, 7, 23, 'pandajyoti81@gmail.com', '2023-12-13', '15:19:35pm', '2023-12-13', '15:21:14pm', 'Resolve'),
(30, 58, 31, 31, 8, 23, 'pandajyoti81@gmail.com', '2023-12-13', '17:17:33pm', '2023-12-14', '18:17:44pm', 'Resolve'),
(31, 58, 31, 31, 7, 25, 'pandajyoti81@gmail.com', '2023-12-13', '17:19:04pm', '0000-00-00', '', 'Pending'),
(32, 58, 31, 31, 8, 23, 'pandajyoti81@gmail.com', '2023-12-14', '15:59:42pm', '2023-12-14', '18:17:44pm', 'Resolve'),
(33, 58, 31, 31, 10, 23, 'pandajyoti81@gmail.com', '2023-12-14', '17:35:04pm', '0000-00-00', '', 'Pending'),
(34, 58, 31, 31, 10, 23, 'pandajyoti81@gmail.com', '2023-12-14', '17:36:32pm', '0000-00-00', '', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `userdetails`
--

CREATE TABLE `userdetails` (
  `userid` int(60) NOT NULL,
  `deptid` int(60) NOT NULL,
  `username` varchar(60) NOT NULL,
  `userip` varchar(60) NOT NULL,
  `systemname` varchar(60) NOT NULL,
  `mobile` varchar(60) NOT NULL,
  `emailid` varchar(60) NOT NULL,
  `usercreatedt` date DEFAULT current_timestamp(),
  `status` varchar(60) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userdetails`
--

INSERT INTO `userdetails` (`userid`, `deptid`, `username`, `userip`, `systemname`, `mobile`, `emailid`, `usercreatedt`, `status`) VALUES
(31, 58, 'Shivam', '2001:0db8:85a3:0000:0000:8a2e:0370:7334', 'dell', '9556743875', 'pandajyoti81@gmail.com', '2023-12-13', 'Active'),
(32, 60, 'Ramesh', '19.117.63.126', 'Dell', '6565656565', 'ramesh72@gmail.com', '2023-12-13', 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminlogin`
--
ALTER TABLE `adminlogin`
  ADD PRIMARY KEY (`adminid`);

--
-- Indexes for table `complaintype`
--
ALTER TABLE `complaintype`
  ADD PRIMARY KEY (`complainid`);

--
-- Indexes for table `complaintypedescription`
--
ALTER TABLE `complaintypedescription`
  ADD PRIMARY KEY (`complaindescid`),
  ADD KEY `complaintypeid` (`complaintypeid`),
  ADD KEY `complaintypeid_2` (`complaintypeid`);

--
-- Indexes for table `departmentdetails`
--
ALTER TABLE `departmentdetails`
  ADD PRIMARY KEY (`deptid`);

--
-- Indexes for table `itteam`
--
ALTER TABLE `itteam`
  ADD PRIMARY KEY (`itteamid`);

--
-- Indexes for table `usercomplain`
--
ALTER TABLE `usercomplain`
  ADD PRIMARY KEY (`usercomplainid`),
  ADD KEY `complaindescid` (`complaindescid`),
  ADD KEY `deptid` (`deptid`),
  ADD KEY `userid` (`userid`),
  ADD KEY `complaintypeid` (`complaintypeid`),
  ADD KEY `itteamid` (`itteamid`);

--
-- Indexes for table `userdetails`
--
ALTER TABLE `userdetails`
  ADD PRIMARY KEY (`userid`),
  ADD KEY `deptid` (`deptid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adminlogin`
--
ALTER TABLE `adminlogin`
  MODIFY `adminid` int(60) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `complaintype`
--
ALTER TABLE `complaintype`
  MODIFY `complainid` int(60) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `complaintypedescription`
--
ALTER TABLE `complaintypedescription`
  MODIFY `complaindescid` int(60) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `departmentdetails`
--
ALTER TABLE `departmentdetails`
  MODIFY `deptid` int(60) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `itteam`
--
ALTER TABLE `itteam`
  MODIFY `itteamid` int(60) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `usercomplain`
--
ALTER TABLE `usercomplain`
  MODIFY `usercomplainid` int(60) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `userdetails`
--
ALTER TABLE `userdetails`
  MODIFY `userid` int(60) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `complaintypedescription`
--
ALTER TABLE `complaintypedescription`
  ADD CONSTRAINT `complaintypedescription_ibfk_1` FOREIGN KEY (`complaintypeid`) REFERENCES `complaintype` (`complainid`);

--
-- Constraints for table `usercomplain`
--
ALTER TABLE `usercomplain`
  ADD CONSTRAINT `usercomplain_ibfk_1` FOREIGN KEY (`itteamid`) REFERENCES `itteam` (`itteamid`),
  ADD CONSTRAINT `usercomplain_ibfk_2` FOREIGN KEY (`deptid`) REFERENCES `departmentdetails` (`deptid`),
  ADD CONSTRAINT `usercomplain_ibfk_3` FOREIGN KEY (`userid`) REFERENCES `userdetails` (`userid`),
  ADD CONSTRAINT `usercomplain_ibfk_4` FOREIGN KEY (`complaindescid`) REFERENCES `complaintypedescription` (`complaindescid`),
  ADD CONSTRAINT `usercomplain_ibfk_5` FOREIGN KEY (`complaintypeid`) REFERENCES `complaintype` (`complainid`);

--
-- Constraints for table `userdetails`
--
ALTER TABLE `userdetails`
  ADD CONSTRAINT `userdetails_ibfk_1` FOREIGN KEY (`deptid`) REFERENCES `departmentdetails` (`deptid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
