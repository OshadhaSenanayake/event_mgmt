-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 14, 2018 at 02:45 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `partydb`
--
CREATE DATABASE IF NOT EXISTS `partydb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `partydb`;

-- --------------------------------------------------------

--
-- Table structure for table `av_items`
--

CREATE TABLE `av_items` (
  `itemid` int(11) NOT NULL,
  `supplierid` int(11) NOT NULL,
  `itemname` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `av_suppliers`
--

CREATE TABLE `av_suppliers` (
  `avsupplierid` int(11) NOT NULL,
  `name` text NOT NULL,
  `contact` int(11) NOT NULL,
  `email` text NOT NULL,
  `rate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `av_suppliers`
--

INSERT INTO `av_suppliers` (`avsupplierid`, `name`, `contact`, `email`, `rate`) VALUES
(1, 'RESERVED', 0, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `caterers`
--

CREATE TABLE `caterers` (
  `catererid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `contact` int(10) NOT NULL,
  `email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `caterers`
--

INSERT INTO `caterers` (`catererid`, `name`, `contact`, `email`) VALUES
(1, 'RESERVED', 0, ''),
(2, 'Opulent Caterers', 2147483647, '');

-- --------------------------------------------------------

--
-- Table structure for table `deco`
--

CREATE TABLE `deco` (
  `decoid` int(11) NOT NULL,
  `itemname` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `descriptoin` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `eventid` int(10) NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `location` text NOT NULL,
  `date` varchar(255) NOT NULL,
  `start` varchar(255) NOT NULL,
  `end` varchar(255) NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `payment` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`eventid`, `event_name`, `location`, `date`, `start`, `end`, `userid`, `status`, `payment`) VALUES
(12, 'reserved', '', '', '', '', NULL, 0, 0),
(35, 'Partylk Launch', 'Colombo', '2018-07-15', '08:00', '10:00', 9, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `event_av`
--

CREATE TABLE `event_av` (
  `av_dealid` int(11) NOT NULL,
  `eventid` int(11) NOT NULL,
  `supplierid` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event_av`
--

INSERT INTO `event_av` (`av_dealid`, `eventid`, `supplierid`, `status`) VALUES
(24, 27, 1, 0),
(32, 35, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `event_avitems`
--

CREATE TABLE `event_avitems` (
  `eventid` int(11) NOT NULL,
  `itemid` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `notes` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `event_catering`
--

CREATE TABLE `event_catering` (
  `caterjobid` int(11) NOT NULL,
  `catererid` int(11) NOT NULL,
  `eventid` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event_catering`
--

INSERT INTO `event_catering` (`caterjobid`, `catererid`, `eventid`, `status`) VALUES
(1, 1, 0, 0),
(24, 2, 27, 0),
(32, 2, 35, 0);

-- --------------------------------------------------------

--
-- Table structure for table `event_food`
--

CREATE TABLE `event_food` (
  `id` int(11) NOT NULL,
  `eventid` int(11) NOT NULL,
  `itemid` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event_food`
--

INSERT INTO `event_food` (`id`, `eventid`, `itemid`, `quantity`) VALUES
(16, 35, 2, 100);

-- --------------------------------------------------------

--
-- Table structure for table `event_photography`
--

CREATE TABLE `event_photography` (
  `id` int(11) NOT NULL,
  `eventid` int(11) NOT NULL,
  `photgrapherid` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event_photography`
--

INSERT INTO `event_photography` (`id`, `eventid`, `photgrapherid`, `status`) VALUES
(2, 27, 2, 0),
(6, 35, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `event_venues`
--

CREATE TABLE `event_venues` (
  `eventid` int(11) NOT NULL,
  `venueid` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event_venues`
--

INSERT INTO `event_venues` (`eventid`, `venueid`, `status`) VALUES
(27, 0, 0),
(35, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `fooditems`
--

CREATE TABLE `fooditems` (
  `itemid` int(11) NOT NULL,
  `catererid` int(11) NOT NULL,
  `itemname` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `unit` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fooditems`
--

INSERT INTO `fooditems` (`itemid`, `catererid`, `itemname`, `price`, `unit`) VALUES
(1, 0, 'RESERVED', 0, ''),
(2, 2, 'Fried Rice', 300, 'Plates');

-- --------------------------------------------------------

--
-- Table structure for table `guests`
--

CREATE TABLE `guests` (
  `guestid` int(11) NOT NULL,
  `eventid` int(11) NOT NULL,
  `guestname` text NOT NULL,
  `rsvp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guests`
--

INSERT INTO `guests` (`guestid`, `eventid`, `guestname`, `rsvp`) VALUES
(3, 0, 'Guest 2', 1),
(4, 0, 'Guest 2', 0),
(41, 35, 'Oshadhi Munasinghe', 1),
(42, 35, 'Theshiya Reshini', 0),
(43, 35, 'Ruwanthi Liyanage', 2),
(44, 35, 'Shehan Kulathilake', 1);

-- --------------------------------------------------------

--
-- Table structure for table `photographer`
--

CREATE TABLE `photographer` (
  `photographerid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `contact` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `rate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `photographer`
--

INSERT INTO `photographer` (`photographerid`, `name`, `contact`, `email`, `rate`) VALUES
(1, 'RESERVED', 0, '', 0),
(2, 'as', 0, 'as', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userid` int(10) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact` int(10) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userid`, `fullname`, `email`, `contact`, `username`, `password`) VALUES
(1, 'Administrator', 'admin@localhost.com1', 1112345678, 'admin', 'pass'),
(9, 'School of Computing', 'info@ucsc.cmb.ac.lk', 1112345678, 'ucsc', 'ucsc'),
(10, 'Shehan Kulathilake', 'shehanhere@gmail.com', 2147483647, 'thekule', 'pass');

-- --------------------------------------------------------

--
-- Table structure for table `venues`
--

CREATE TABLE `venues` (
  `venueid` int(11) NOT NULL,
  `venue_name` text NOT NULL,
  `location` text NOT NULL,
  `rate` int(11) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `venues`
--

INSERT INTO `venues` (`venueid`, `venue_name`, `location`, `rate`, `description`) VALUES
(1, 'RESERVED', '', 0, ''),
(3, 'Hilton Hotel Hall 3', 'Colombo', 7000, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `av_items`
--
ALTER TABLE `av_items`
  ADD PRIMARY KEY (`itemid`);

--
-- Indexes for table `av_suppliers`
--
ALTER TABLE `av_suppliers`
  ADD PRIMARY KEY (`avsupplierid`);

--
-- Indexes for table `caterers`
--
ALTER TABLE `caterers`
  ADD PRIMARY KEY (`catererid`);

--
-- Indexes for table `deco`
--
ALTER TABLE `deco`
  ADD PRIMARY KEY (`decoid`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`eventid`);

--
-- Indexes for table `event_av`
--
ALTER TABLE `event_av`
  ADD PRIMARY KEY (`av_dealid`);

--
-- Indexes for table `event_catering`
--
ALTER TABLE `event_catering`
  ADD PRIMARY KEY (`caterjobid`);

--
-- Indexes for table `event_food`
--
ALTER TABLE `event_food`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_food` (`eventid`);

--
-- Indexes for table `event_photography`
--
ALTER TABLE `event_photography`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fooditems`
--
ALTER TABLE `fooditems`
  ADD PRIMARY KEY (`itemid`) USING BTREE;

--
-- Indexes for table `guests`
--
ALTER TABLE `guests`
  ADD PRIMARY KEY (`guestid`);

--
-- Indexes for table `photographer`
--
ALTER TABLE `photographer`
  ADD PRIMARY KEY (`photographerid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `venues`
--
ALTER TABLE `venues`
  ADD PRIMARY KEY (`venueid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `av_suppliers`
--
ALTER TABLE `av_suppliers`
  MODIFY `avsupplierid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `caterers`
--
ALTER TABLE `caterers`
  MODIFY `catererid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `eventid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `event_av`
--
ALTER TABLE `event_av`
  MODIFY `av_dealid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `event_catering`
--
ALTER TABLE `event_catering`
  MODIFY `caterjobid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `event_food`
--
ALTER TABLE `event_food`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `event_photography`
--
ALTER TABLE `event_photography`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `fooditems`
--
ALTER TABLE `fooditems`
  MODIFY `itemid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `guests`
--
ALTER TABLE `guests`
  MODIFY `guestid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `photographer`
--
ALTER TABLE `photographer`
  MODIFY `photographerid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `venues`
--
ALTER TABLE `venues`
  MODIFY `venueid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
