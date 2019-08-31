-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 31, 2019 at 05:13 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.8

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
-- Table structure for table `tbl_booking`
--

CREATE TABLE `tbl_booking` (
  `book_id` int(10) NOT NULL,
  `user_id` int(11) NOT NULL,
  `show_id` int(11) NOT NULL,
  `mv_id` int(11) NOT NULL,
  `thr_id` int(11) NOT NULL,
  `thr_screen_id` varchar(20) NOT NULL,
  `screen_seat_id` varchar(255) NOT NULL,
  `book_date` date NOT NULL,
  `book_pay` double NOT NULL,
  `book_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `mv_release_date` date DEFAULT NULL,
  `mv_thumb` varchar(255) NOT NULL,
  `thr_id` int(10) NOT NULL,
  `mv_status` tinyint(1) NOT NULL COMMENT 'TRUE => Exists, FALSE => Deleted',
  `rq_status` tinyint(1) NOT NULL COMMENT 'TRUE => Approved, FALSE => Pending'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_movie`
--

INSERT INTO `tbl_movie` (`mv_id`, `mv_name`, `mv_hero`, `mv_heroine`, `mv_lang`, `mv_director`, `mv_producer`, `mv_release_date`, `mv_thumb`, `thr_id`, `mv_status`, `rq_status`) VALUES
(1, 'Saaho', 'Prabhas', 'Shradhha Kapoor', 'Telugu', 'Sujeeth', 'Vamshi', '2019-08-30', '67445633a1646935a30e59f366ae01de.jpg', 2, 1, 1),
(2, 'Spiderman', 'Natham', 'Rosy', 'English', 'Disney', 'Dan Lin', '2019-08-28', '1faf5206880ff9e27ca02e0c83562293.jpg', 1, 1, 1),
(3, 'Mamangam', 'Mammootty', 'Anu Sithara', 'Malayalam', 'M. Padmakumar', 'Kavya Films', '2019-10-31', '43b380b1c064dd973af305c3b14341f5.jpg', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_review`
--

CREATE TABLE `tbl_review` (
  `rvw_id` int(10) NOT NULL,
  `mv_id` int(10) NOT NULL,
  `mv_review` text NOT NULL,
  `mv_rating` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_screens`
--

CREATE TABLE `tbl_screens` (
  `def_screen_id` bigint(255) NOT NULL,
  `thr_id` int(11) NOT NULL,
  `thr_screen_id` varchar(20) NOT NULL,
  `seat_number` int(4) NOT NULL,
  `thr_screen_name` varchar(20) NOT NULL,
  `thr_screen_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_screens`
--

INSERT INTO `tbl_screens` (`def_screen_id`, `thr_id`, `thr_screen_id`, `seat_number`, `thr_screen_name`, `thr_screen_status`) VALUES
(1, 2, 'carnival3901', 2, 'PlexA', 1),
(2, 1, 'casanova1', 5, 'CasPlexA', 1),
(3, 1, 'casanova2', 75, 'CasPlexB', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_seats`
--

CREATE TABLE `tbl_seats` (
  `def_seat_id` bigint(255) NOT NULL,
  `thr_screen_id` varchar(255) NOT NULL,
  `screen_seat_id` varchar(255) NOT NULL,
  `seat_book_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_seats`
--

INSERT INTO `tbl_seats` (`def_seat_id`, `thr_screen_id`, `screen_seat_id`, `seat_book_status`) VALUES
(1, 'carnival3901', 'carnival3901-1', 0),
(2, 'carnival3901', 'carnival3901-2', 0),
(3, 'casanova1', 'casanova1-1', 0),
(4, 'casanova1', 'casanova1-2', 0),
(5, 'casanova1', 'casanova1-3', 0),
(6, 'casanova1', 'casanova1-4', 0),
(7, 'casanova1', 'casanova1-5', 0),
(8, 'casanova2', 'casanova2-1', 0),
(9, 'casanova2', 'casanova2-2', 0),
(10, 'casanova2', 'casanova2-3', 0),
(11, 'casanova2', 'casanova2-4', 0),
(12, 'casanova2', 'casanova2-5', 0),
(13, 'casanova2', 'casanova2-6', 0),
(14, 'casanova2', 'casanova2-7', 0),
(15, 'casanova2', 'casanova2-8', 0),
(16, 'casanova2', 'casanova2-9', 0),
(17, 'casanova2', 'casanova2-10', 0),
(18, 'casanova2', 'casanova2-11', 0),
(19, 'casanova2', 'casanova2-12', 0),
(20, 'casanova2', 'casanova2-13', 0),
(21, 'casanova2', 'casanova2-14', 0),
(22, 'casanova2', 'casanova2-15', 0),
(23, 'casanova2', 'casanova2-16', 0),
(24, 'casanova2', 'casanova2-17', 0),
(25, 'casanova2', 'casanova2-18', 0),
(26, 'casanova2', 'casanova2-19', 0),
(27, 'casanova2', 'casanova2-20', 0),
(28, 'casanova2', 'casanova2-21', 0),
(29, 'casanova2', 'casanova2-22', 0),
(30, 'casanova2', 'casanova2-23', 0),
(31, 'casanova2', 'casanova2-24', 0),
(32, 'casanova2', 'casanova2-25', 0),
(33, 'casanova2', 'casanova2-26', 0),
(34, 'casanova2', 'casanova2-27', 0),
(35, 'casanova2', 'casanova2-28', 0),
(36, 'casanova2', 'casanova2-29', 0),
(37, 'casanova2', 'casanova2-30', 0),
(38, 'casanova2', 'casanova2-31', 0),
(39, 'casanova2', 'casanova2-32', 0),
(40, 'casanova2', 'casanova2-33', 0),
(41, 'casanova2', 'casanova2-34', 0),
(42, 'casanova2', 'casanova2-35', 0),
(43, 'casanova2', 'casanova2-36', 0),
(44, 'casanova2', 'casanova2-37', 0),
(45, 'casanova2', 'casanova2-38', 0),
(46, 'casanova2', 'casanova2-39', 0),
(47, 'casanova2', 'casanova2-40', 0),
(48, 'casanova2', 'casanova2-41', 0),
(49, 'casanova2', 'casanova2-42', 0),
(50, 'casanova2', 'casanova2-43', 0),
(51, 'casanova2', 'casanova2-44', 0),
(52, 'casanova2', 'casanova2-45', 0),
(53, 'casanova2', 'casanova2-46', 0),
(54, 'casanova2', 'casanova2-47', 0),
(55, 'casanova2', 'casanova2-48', 0),
(56, 'casanova2', 'casanova2-49', 0),
(57, 'casanova2', 'casanova2-50', 0),
(58, 'casanova2', 'casanova2-51', 0),
(59, 'casanova2', 'casanova2-52', 0),
(60, 'casanova2', 'casanova2-53', 0),
(61, 'casanova2', 'casanova2-54', 0),
(62, 'casanova2', 'casanova2-55', 0),
(63, 'casanova2', 'casanova2-56', 0),
(64, 'casanova2', 'casanova2-57', 0),
(65, 'casanova2', 'casanova2-58', 0),
(66, 'casanova2', 'casanova2-59', 0),
(67, 'casanova2', 'casanova2-60', 0),
(68, 'casanova2', 'casanova2-61', 0),
(69, 'casanova2', 'casanova2-62', 0),
(70, 'casanova2', 'casanova2-63', 0),
(71, 'casanova2', 'casanova2-64', 0),
(72, 'casanova2', 'casanova2-65', 0),
(73, 'casanova2', 'casanova2-66', 0),
(74, 'casanova2', 'casanova2-67', 0),
(75, 'casanova2', 'casanova2-68', 0),
(76, 'casanova2', 'casanova2-69', 0),
(77, 'casanova2', 'casanova2-70', 0),
(78, 'casanova2', 'casanova2-71', 0),
(79, 'casanova2', 'casanova2-72', 0),
(80, 'casanova2', 'casanova2-73', 0),
(81, 'casanova2', 'casanova2-74', 0),
(82, 'casanova2', 'casanova2-75', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_showtime`
--

CREATE TABLE `tbl_showtime` (
  `shw_id` int(10) NOT NULL,
  `mv_id` int(10) NOT NULL,
  `shw_time` time NOT NULL,
  `thr_id` int(10) NOT NULL,
  `thr_screen_id` varchar(20) NOT NULL,
  `shw_date` date NOT NULL,
  `shw_cost` double NOT NULL,
  `shw_status` tinyint(1) NOT NULL COMMENT 'TRUE => Exists, FALSE => Do Not Exist'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_showtime`
--

INSERT INTO `tbl_showtime` (`shw_id`, `mv_id`, `shw_time`, `thr_id`, `thr_screen_id`, `shw_date`, `shw_cost`, `shw_status`) VALUES
(1, 1, '09:15:00', 2, 'carnival3901', '2019-08-30', 179.99, 1),
(2, 1, '12:00:00', 2, 'carnival3901', '2019-08-31', 179.99, 1),
(3, 3, '17:10:00', 1, 'casanova1', '2019-10-31', 250.66, 1),
(4, 1, '18:00:00', 1, 'casanova1', '2019-08-31', 156, 1),
(5, 2, '18:00:00', 1, 'casanova2', '2019-08-31', 200, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_theater`
--

CREATE TABLE `tbl_theater` (
  `thr_id` int(11) NOT NULL,
  `thr_name` varchar(255) NOT NULL,
  `thr_uname` varchar(255) NOT NULL,
  `thr_pasd` varchar(255) NOT NULL,
  `thr_phone` bigint(12) NOT NULL,
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
(4, 'Alphin Felix', 'alphin123', 'd7217b5d7925ec0a9163d1b7a7dbb606', 'alphin@gmail.com', 7560843461, 'enduser'),
(5, 'Sanju', 'sanju07', 'c24526bfc0fe42d8b09a314e64d7b0d9', 'sanju@gmail.com', 9495117707, 'enduser');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_booking`
--
ALTER TABLE `tbl_booking`
  ADD PRIMARY KEY (`book_id`);

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
-- Indexes for table `tbl_screens`
--
ALTER TABLE `tbl_screens`
  ADD PRIMARY KEY (`def_screen_id`);

--
-- Indexes for table `tbl_seats`
--
ALTER TABLE `tbl_seats`
  ADD PRIMARY KEY (`def_seat_id`);

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
-- AUTO_INCREMENT for table `tbl_booking`
--
ALTER TABLE `tbl_booking`
  MODIFY `book_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_movie`
--
ALTER TABLE `tbl_movie`
  MODIFY `mv_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_review`
--
ALTER TABLE `tbl_review`
  MODIFY `rvw_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_screens`
--
ALTER TABLE `tbl_screens`
  MODIFY `def_screen_id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_seats`
--
ALTER TABLE `tbl_seats`
  MODIFY `def_seat_id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `tbl_showtime`
--
ALTER TABLE `tbl_showtime`
  MODIFY `shw_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_theater`
--
ALTER TABLE `tbl_theater`
  MODIFY `thr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
