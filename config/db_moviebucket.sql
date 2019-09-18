-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 18, 2019 at 09:03 AM
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
  `shw_id` int(11) NOT NULL,
  `mv_id` int(11) NOT NULL,
  `thr_id` int(11) NOT NULL,
  `thr_screen_id` varchar(20) NOT NULL,
  `screen_seat_id` varchar(255) NOT NULL,
  `book_date` datetime NOT NULL,
  `book_pay` double NOT NULL,
  `book_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_booking`
--

INSERT INTO `tbl_booking` (`book_id`, `user_id`, `shw_id`, `mv_id`, `thr_id`, `thr_screen_id`, `screen_seat_id`, `book_date`, `book_pay`, `book_status`) VALUES
(1, 6, 1, 3, 1, 'casanova1', 'casanova1-3', '2019-09-16 17:47:48', 180.26, 1),
(2, 6, 2, 2, 1, 'casanova1', 'casanova1-5', '2019-09-16 17:49:50', 250, 1),
(3, 4, 2, 2, 1, 'casanova1', 'casanova1-7', '2019-09-16 17:50:48', 250, 1),
(4, 7, 3, 3, 5, 'redcarpetcarn2', 'redcarpetcarn2-51', '2019-09-16 18:15:16', 300, 1),
(5, 7, 3, 3, 5, 'redcarpetcarn2', 'redcarpetcarn2-52', '2019-09-16 18:15:16', 300, 1),
(6, 7, 3, 3, 5, 'redcarpetcarn2', 'redcarpetcarn2-53', '2019-09-16 18:15:16', 300, 1),
(7, 3, 3, 3, 5, 'redcarpetcarn2', 'redcarpetcarn2-49', '2019-09-16 18:16:23', 400, 1),
(8, 3, 3, 3, 5, 'redcarpetcarn2', 'redcarpetcarn2-55', '2019-09-16 18:16:23', 400, 1),
(9, 3, 3, 3, 5, 'redcarpetcarn2', 'redcarpetcarn2-67', '2019-09-16 18:16:23', 400, 1),
(10, 3, 3, 3, 5, 'redcarpetcarn2', 'redcarpetcarn2-82', '2019-09-16 18:16:23', 400, 1);

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
(3, 'Mamangam', 'Mammootty', 'Anu Sithara', 'Malayalam', 'M. Padmakumar', 'Kavya Films', '2019-10-31', '43b380b1c064dd973af305c3b14341f5.jpg', 1, 1, 1),
(4, 'KGF 2', 'Yash', 'Amira', 'Kannada', 'Prashanth Neel', 'Yash Rangineni', '2020-01-14', '7fdc1a630c238af0815181f9faa190f5.jpg', 1, 1, 1);

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
(1, 1, 'casanova1', 10, 'CasPlex A', 1),
(2, 1, 'casanova2', 0, 'Screen-2', 0),
(3, 1, 'casanova3', 0, 'Screen-3', 0),
(4, 1, 'casanova4', 0, 'Screen-4', 0),
(5, 2, 'carnival3901', 0, 'Screen-1', 0),
(6, 2, 'carnival3902', 0, 'Screen-2', 0),
(7, 2, 'carnival3903', 0, 'Screen-3', 0),
(8, 3, 'aries7881', 0, 'Screen-1', 0),
(9, 3, 'aries7882', 0, 'Screen-2', 0),
(10, 3, 'aries7883', 0, 'Screen-3', 0),
(11, 3, 'aries7884', 0, 'Screen-4', 0),
(12, 3, 'aries7885', 0, 'Screen-5', 0),
(13, 4, 'wiltern111', 0, 'Screen-1', 0),
(14, 4, 'wiltern112', 0, 'Screen-2', 0),
(15, 5, 'redcarpetcarn1', 0, 'Screen-1', 0),
(16, 5, 'redcarpetcarn2', 100, 'Carpet 1', 1),
(17, 5, 'redcarpetcarn3', 0, 'Screen-3', 0),
(18, 5, 'redcarpetcarn4', 0, 'Screen-4', 0),
(19, 5, 'redcarpetcarn5', 0, 'Screen-5', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_seats`
--

CREATE TABLE `tbl_seats` (
  `def_seat_id` bigint(255) NOT NULL,
  `thr_screen_id` varchar(255) NOT NULL,
  `screen_seat_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_seats`
--

INSERT INTO `tbl_seats` (`def_seat_id`, `thr_screen_id`, `screen_seat_id`) VALUES
(1, 'casanova1', 'casanova1-1'),
(2, 'casanova1', 'casanova1-2'),
(3, 'casanova1', 'casanova1-3'),
(4, 'casanova1', 'casanova1-4'),
(5, 'casanova1', 'casanova1-5'),
(6, 'casanova1', 'casanova1-6'),
(7, 'casanova1', 'casanova1-7'),
(8, 'casanova1', 'casanova1-8'),
(9, 'casanova1', 'casanova1-9'),
(10, 'casanova1', 'casanova1-10'),
(11, 'redcarpetcarn2', 'redcarpetcarn2-1'),
(12, 'redcarpetcarn2', 'redcarpetcarn2-2'),
(13, 'redcarpetcarn2', 'redcarpetcarn2-3'),
(14, 'redcarpetcarn2', 'redcarpetcarn2-4'),
(15, 'redcarpetcarn2', 'redcarpetcarn2-5'),
(16, 'redcarpetcarn2', 'redcarpetcarn2-6'),
(17, 'redcarpetcarn2', 'redcarpetcarn2-7'),
(18, 'redcarpetcarn2', 'redcarpetcarn2-8'),
(19, 'redcarpetcarn2', 'redcarpetcarn2-9'),
(20, 'redcarpetcarn2', 'redcarpetcarn2-10'),
(21, 'redcarpetcarn2', 'redcarpetcarn2-11'),
(22, 'redcarpetcarn2', 'redcarpetcarn2-12'),
(23, 'redcarpetcarn2', 'redcarpetcarn2-13'),
(24, 'redcarpetcarn2', 'redcarpetcarn2-14'),
(25, 'redcarpetcarn2', 'redcarpetcarn2-15'),
(26, 'redcarpetcarn2', 'redcarpetcarn2-16'),
(27, 'redcarpetcarn2', 'redcarpetcarn2-17'),
(28, 'redcarpetcarn2', 'redcarpetcarn2-18'),
(29, 'redcarpetcarn2', 'redcarpetcarn2-19'),
(30, 'redcarpetcarn2', 'redcarpetcarn2-20'),
(31, 'redcarpetcarn2', 'redcarpetcarn2-21'),
(32, 'redcarpetcarn2', 'redcarpetcarn2-22'),
(33, 'redcarpetcarn2', 'redcarpetcarn2-23'),
(34, 'redcarpetcarn2', 'redcarpetcarn2-24'),
(35, 'redcarpetcarn2', 'redcarpetcarn2-25'),
(36, 'redcarpetcarn2', 'redcarpetcarn2-26'),
(37, 'redcarpetcarn2', 'redcarpetcarn2-27'),
(38, 'redcarpetcarn2', 'redcarpetcarn2-28'),
(39, 'redcarpetcarn2', 'redcarpetcarn2-29'),
(40, 'redcarpetcarn2', 'redcarpetcarn2-30'),
(41, 'redcarpetcarn2', 'redcarpetcarn2-31'),
(42, 'redcarpetcarn2', 'redcarpetcarn2-32'),
(43, 'redcarpetcarn2', 'redcarpetcarn2-33'),
(44, 'redcarpetcarn2', 'redcarpetcarn2-34'),
(45, 'redcarpetcarn2', 'redcarpetcarn2-35'),
(46, 'redcarpetcarn2', 'redcarpetcarn2-36'),
(47, 'redcarpetcarn2', 'redcarpetcarn2-37'),
(48, 'redcarpetcarn2', 'redcarpetcarn2-38'),
(49, 'redcarpetcarn2', 'redcarpetcarn2-39'),
(50, 'redcarpetcarn2', 'redcarpetcarn2-40'),
(51, 'redcarpetcarn2', 'redcarpetcarn2-41'),
(52, 'redcarpetcarn2', 'redcarpetcarn2-42'),
(53, 'redcarpetcarn2', 'redcarpetcarn2-43'),
(54, 'redcarpetcarn2', 'redcarpetcarn2-44'),
(55, 'redcarpetcarn2', 'redcarpetcarn2-45'),
(56, 'redcarpetcarn2', 'redcarpetcarn2-46'),
(57, 'redcarpetcarn2', 'redcarpetcarn2-47'),
(58, 'redcarpetcarn2', 'redcarpetcarn2-48'),
(59, 'redcarpetcarn2', 'redcarpetcarn2-49'),
(60, 'redcarpetcarn2', 'redcarpetcarn2-50'),
(61, 'redcarpetcarn2', 'redcarpetcarn2-51'),
(62, 'redcarpetcarn2', 'redcarpetcarn2-52'),
(63, 'redcarpetcarn2', 'redcarpetcarn2-53'),
(64, 'redcarpetcarn2', 'redcarpetcarn2-54'),
(65, 'redcarpetcarn2', 'redcarpetcarn2-55'),
(66, 'redcarpetcarn2', 'redcarpetcarn2-56'),
(67, 'redcarpetcarn2', 'redcarpetcarn2-57'),
(68, 'redcarpetcarn2', 'redcarpetcarn2-58'),
(69, 'redcarpetcarn2', 'redcarpetcarn2-59'),
(70, 'redcarpetcarn2', 'redcarpetcarn2-60'),
(71, 'redcarpetcarn2', 'redcarpetcarn2-61'),
(72, 'redcarpetcarn2', 'redcarpetcarn2-62'),
(73, 'redcarpetcarn2', 'redcarpetcarn2-63'),
(74, 'redcarpetcarn2', 'redcarpetcarn2-64'),
(75, 'redcarpetcarn2', 'redcarpetcarn2-65'),
(76, 'redcarpetcarn2', 'redcarpetcarn2-66'),
(77, 'redcarpetcarn2', 'redcarpetcarn2-67'),
(78, 'redcarpetcarn2', 'redcarpetcarn2-68'),
(79, 'redcarpetcarn2', 'redcarpetcarn2-69'),
(80, 'redcarpetcarn2', 'redcarpetcarn2-70'),
(81, 'redcarpetcarn2', 'redcarpetcarn2-71'),
(82, 'redcarpetcarn2', 'redcarpetcarn2-72'),
(83, 'redcarpetcarn2', 'redcarpetcarn2-73'),
(84, 'redcarpetcarn2', 'redcarpetcarn2-74'),
(85, 'redcarpetcarn2', 'redcarpetcarn2-75'),
(86, 'redcarpetcarn2', 'redcarpetcarn2-76'),
(87, 'redcarpetcarn2', 'redcarpetcarn2-77'),
(88, 'redcarpetcarn2', 'redcarpetcarn2-78'),
(89, 'redcarpetcarn2', 'redcarpetcarn2-79'),
(90, 'redcarpetcarn2', 'redcarpetcarn2-80'),
(91, 'redcarpetcarn2', 'redcarpetcarn2-81'),
(92, 'redcarpetcarn2', 'redcarpetcarn2-82'),
(93, 'redcarpetcarn2', 'redcarpetcarn2-83'),
(94, 'redcarpetcarn2', 'redcarpetcarn2-84'),
(95, 'redcarpetcarn2', 'redcarpetcarn2-85'),
(96, 'redcarpetcarn2', 'redcarpetcarn2-86'),
(97, 'redcarpetcarn2', 'redcarpetcarn2-87'),
(98, 'redcarpetcarn2', 'redcarpetcarn2-88'),
(99, 'redcarpetcarn2', 'redcarpetcarn2-89'),
(100, 'redcarpetcarn2', 'redcarpetcarn2-90'),
(101, 'redcarpetcarn2', 'redcarpetcarn2-91'),
(102, 'redcarpetcarn2', 'redcarpetcarn2-92'),
(103, 'redcarpetcarn2', 'redcarpetcarn2-93'),
(104, 'redcarpetcarn2', 'redcarpetcarn2-94'),
(105, 'redcarpetcarn2', 'redcarpetcarn2-95'),
(106, 'redcarpetcarn2', 'redcarpetcarn2-96'),
(107, 'redcarpetcarn2', 'redcarpetcarn2-97'),
(108, 'redcarpetcarn2', 'redcarpetcarn2-98'),
(109, 'redcarpetcarn2', 'redcarpetcarn2-99'),
(110, 'redcarpetcarn2', 'redcarpetcarn2-100');

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
(1, 3, '09:00:00', 1, 'casanova1', '2019-09-10', 180.26, 1),
(2, 2, '19:00:00', 1, 'casanova1', '2019-09-17', 250, 1),
(3, 3, '12:00:00', 5, 'redcarpetcarn2', '2019-09-18', 100, 1);

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
(4, 'The Wiltern', 'wiltern11', 'b025accb97d7e77ce4fd87af71dd0fc8', 45635333, 'contact@wiltern.com', 2, '3790 Wilshire Blvd, Los Angeles, CA 90010, USA', 1),
(5, 'Carnival RedCarpet', 'redcarpetcarn', '7c0ac50e95a235bea887b7a50df55346', 7845123654, 'redcarpetcarnival@outlook.com', 5, 'Kariyad', 1);

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
(5, 'Sanju', 'sanju07', 'c24526bfc0fe42d8b09a314e64d7b0d9', 'sanju@gmail.com', 9495117707, 'enduser'),
(6, 'Abijith', 'abi', '315eb115d98fcbad39ffc5edebd669c9', 'abijithtjayan@gmail.com', 8330045217, 'enduser'),
(7, 'Arun', 'arunmathew', 'f6e5dd1413bcdc46355583615eb2608f', 'mathewarun@gmail.com', 9037250473, 'enduser'),
(8, 'Rosbee Binny', 'rosbeebinny', 'a21666d276025251f7b743c0884f453a ', 'rosbeebinny@gmail.com', 8606107201, 'enduser');

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
  MODIFY `book_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_movie`
--
ALTER TABLE `tbl_movie`
  MODIFY `mv_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_review`
--
ALTER TABLE `tbl_review`
  MODIFY `rvw_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_screens`
--
ALTER TABLE `tbl_screens`
  MODIFY `def_screen_id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_seats`
--
ALTER TABLE `tbl_seats`
  MODIFY `def_seat_id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `tbl_showtime`
--
ALTER TABLE `tbl_showtime`
  MODIFY `shw_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_theater`
--
ALTER TABLE `tbl_theater`
  MODIFY `thr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
