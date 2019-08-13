-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 13, 2019 at 08:08 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_moviebucket`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_movie`
--

CREATE TABLE `tbl_movie` (
  `mv_id` int(10) NOT NULL,
  `mv_name` varchar(255) NOT NULL,
  `mv_hero` varchar(255) NOT NULL,
  `mv_heroine` varchar(255) NOT NULL,
  `mv_lang` varchar(255) NOT NULL,
  `mv_director` varchar(255) NOT NULL,
  `mv_producer` varchar(255) NOT NULL,
  `rq_status` tinyint(1) NOT NULL COMMENT 'TRUE =>Admin Approved, FALSE => Pending',
  `thr_id` int(255) NOT NULL,
  `mv_status` tinyint(1) NOT NULL COMMENT 'TRUE => Exists, FALSE => Deleted'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_movie`
--

INSERT INTO `tbl_movie` (`mv_id`, `mv_name`, `mv_hero`, `mv_heroine`, `mv_lang`, `mv_director`, `mv_producer`, `rq_status`, `thr_id`, `mv_status`) VALUES
(1, 'Spiderman', 'Natham', 'Rosy', 'English', 'Disney', 'Dan Lin', 1, 1, 1),
(2, 'Dear Comrade', 'Vijay Devarakonda', 'Rashmika Mandana', 'Telugu', 'Prashanth Neel', 'Vijay K', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_review`
--

CREATE TABLE `tbl_review` (
  `rvw_id` int(10) NOT NULL,
  `mv_id` int(10) NOT NULL,
  `mv_review` text NOT NULL,
  `mv_rating` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_shows`
--

CREATE TABLE `tbl_shows` (
  `thr_id` int(10) NOT NULL,
  `shw_id` int(10) NOT NULL,
  `thr_screen_no` tinyint(3) NOT NULL,
  `shw_status` tinyint(1) NOT NULL COMMENT 'TRUE => Exists, FALSE => Do not Exist'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_shows`
--

INSERT INTO `tbl_shows` (`thr_id`, `shw_id`, `thr_screen_no`, `shw_status`) VALUES
(1, 1, 1, 0),
(1, 2, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_showtime`
--

CREATE TABLE `tbl_showtime` (
  `shw_id` int(10) NOT NULL,
  `mv_id` int(10) NOT NULL,
  `shw_time` time NOT NULL,
  `thr_screen_no` tinyint(3) NOT NULL,
  `shw_date` date NOT NULL,
  `shw_status` tinyint(1) NOT NULL COMMENT 'TRUE => Exists, FALSE => Do Not Exist'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_showtime`
--

INSERT INTO `tbl_showtime` (`shw_id`, `mv_id`, `shw_time`, `thr_screen_no`, `shw_date`, `shw_status`) VALUES
(1, 1, '04:00:00', 1, '2019-08-01', 0),
(2, 1, '04:00:00', 2, '2019-08-01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_theater`
--

CREATE TABLE `tbl_theater` (
  `thr_id` int(11) NOT NULL,
  `thr_name` varchar(255) NOT NULL,
  `thr_uname` varchar(255) NOT NULL,
  `thr_pasd` varchar(255) NOT NULL,
  `thr_phone` bigint(20) NOT NULL,
  `thr_mail` varchar(255) NOT NULL,
  `thr_screens` tinyint(3) NOT NULL,
  `thr_location` varchar(255) NOT NULL,
  `thr_status` tinyint(1) NOT NULL COMMENT 'true => Existing, false => Deleted'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_theater`
--

INSERT INTO `tbl_theater` (`thr_id`, `thr_name`, `thr_uname`, `thr_pasd`, `thr_phone`, `thr_mail`, `thr_screens`, `thr_location`, `thr_status`) VALUES
(1, 'Casanova', 'casanova', '03730c36678266f50229d3fdc0d6d0cb', 7542103277, 'cas@outlook.com', 4, 'Mumbai', 1),
(2, 'Carnival', 'carnival390', '3b5477ba1dbc0cb957cfaa2e6a6aaa6c', 7586978887, 'carnival390@gmail.com', 3, 'Cochin', 1),
(3, 'Aries', 'aries788', '54e553e1f26aba4f435548bd9645811a', 7845456544, 'aries788@gmail.com', 5, 'Trivandrum', 1),
(4, 'The Wiltern', 'wiltern11', 'b025accb97d7e77ce4fd87af71dd0fc8', 45635333, 'contact@wiltern.com', 2, '3790 Wilshire Blvd, Los Angeles, CA 90010, USA', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_uname` varchar(255) NOT NULL,
  `user_pasd` varchar(255) NOT NULL,
  `user_mail` varchar(255) NOT NULL,
  `user_phone` bigint(12) NOT NULL,
  `user_type` varchar(10) NOT NULL COMMENT 'admin,enduser,theater'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `user_name`, `user_uname`, `user_pasd`, `user_mail`, `user_phone`, `user_type`) VALUES
(1, 'Al Ameen AR', 'amrameen769', 'cf0d02ec99e61a64137b8a2c3b03e030', 'amrameen769@gmail.com', 8943199646, 'admin'),
(2, 'Sibin', 'sibin29', '89cc7b7b2e7d21ad45d883771d795ed2', 'sibin29@gmail.com', 9496332052, 'enduser'),
(3, 'AB Dullah', 'dulla', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'ab@du.lla', 7559869362, 'enduser'),
(4, 'Alphin Felix', 'alphin123', 'd7217b5d7925ec0a9163d1b7a7dbb606', 'alphin@gmail.com', 7560843461, 'enduser');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_movie`
--
ALTER TABLE `tbl_movie`
  ADD PRIMARY KEY (`mv_id`);

--
-- Indexes for table `tbl_review`
--
ALTER TABLE `tbl_review`
  ADD PRIMARY KEY (`rvw_id`);

--
-- Indexes for table `tbl_showtime`
--
ALTER TABLE `tbl_showtime`
  ADD PRIMARY KEY (`shw_id`);

--
-- Indexes for table `tbl_theater`
--
ALTER TABLE `tbl_theater`
  ADD PRIMARY KEY (`thr_id`),
  ADD UNIQUE KEY `thr_uname` (`thr_uname`),
  ADD UNIQUE KEY `thr_mail` (`thr_mail`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_uname` (`user_uname`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_movie`
--
ALTER TABLE `tbl_movie`
  MODIFY `mv_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_review`
--
ALTER TABLE `tbl_review`
  MODIFY `rvw_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_showtime`
--
ALTER TABLE `tbl_showtime`
  MODIFY `shw_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_theater`
--
ALTER TABLE `tbl_theater`
  MODIFY `thr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
