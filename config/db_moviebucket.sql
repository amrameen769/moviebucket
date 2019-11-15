-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 04, 2019 at 03:37 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

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
(1, 4, 3, 3, 5, 'redcarpetcarn2', 'redcarpetcarn2-74', '2019-10-03 00:01:00', 100, 1),
(2, 4, 3, 3, 5, 'redcarpetcarn2', 'redcarpetcarn2-75', '2019-10-03 00:01:00', 100, 1),
(3, 4, 1, 3, 1, 'casanova1', 'casanova1-5', '2019-10-03 00:02:48', 180.26, 1),
(4, 4, 1, 3, 1, 'casanova1', 'casanova1-6', '2019-10-03 00:02:48', 180.26, 1),
(5, 4, 3, 3, 5, 'redcarpetcarn2', 'redcarpetcarn2-43', '2019-10-03 00:04:14', 100, 1),
(6, 4, 3, 3, 5, 'redcarpetcarn2', 'redcarpetcarn2-44', '2019-10-03 00:04:14', 100, 1),
(7, 4, 3, 3, 5, 'redcarpetcarn2', 'redcarpetcarn2-45', '2019-10-03 00:04:14', 100, 1),
(8, 4, 3, 3, 5, 'redcarpetcarn2', 'redcarpetcarn2-46', '2019-10-03 00:04:14', 100, 1),
(9, 9, 1, 3, 1, 'casanova1', 'casanova1-3', '2019-10-03 13:27:39', 180.26, 1),
(10, 9, 1, 3, 1, 'casanova1', 'casanova1-4', '2019-10-03 13:27:39', 180.26, 1),
(11, 9, 1, 3, 1, 'casanova1', 'casanova1-7', '2019-10-03 13:27:39', 180.26, 1),
(12, 9, 1, 3, 1, 'casanova1', 'casanova1-8', '2019-10-03 13:27:39', 180.26, 1);

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
(4, 'KGF 2', 'Yash', 'Amira', 'Kannada', 'Prashanth Neel', 'Yash Rangineni', '2020-01-14', '7fdc1a630c238af0815181f9faa190f5.jpg', 1, 1, 1),
(5, 'Love Action Drama', 'Nivin Pauly', 'Nayanthara', 'Malayalam', 'Dhyaan Shreenivasan', 'Aju Varghese', '2019-09-05', '7338ab04e198911e6ec3d027180b7011.jpg', 5, 1, 1);

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
(15, 5, 'redcarpetcarn1', 600, 'RedCarpet Class C', 1),
(16, 5, 'redcarpetcarn2', 100, 'Carpet 1', 1),
(17, 5, 'redcarpetcarn3', 0, 'Screen-3', 0),
(18, 5, 'redcarpetcarn4', 0, 'Screen-4', 0),
(19, 5, 'redcarpetcarn5', 0, 'Screen-5', 0),
(20, 6, 'kavitha1', 0, 'Screen-1', 0),
(21, 6, 'kavitha2', 0, 'Screen-2', 0),
(22, 7, '7max1', 0, 'Screen-1', 0),
(23, 7, '7max2', 0, 'Screen-2', 0),
(24, 7, '7max3', 0, 'Screen-3', 0);

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
(110, 'redcarpetcarn2', 'redcarpetcarn2-100'),
(111, 'redcarpetcarn1', 'redcarpetcarn1-1'),
(112, 'redcarpetcarn1', 'redcarpetcarn1-2'),
(113, 'redcarpetcarn1', 'redcarpetcarn1-3'),
(114, 'redcarpetcarn1', 'redcarpetcarn1-4'),
(115, 'redcarpetcarn1', 'redcarpetcarn1-5'),
(116, 'redcarpetcarn1', 'redcarpetcarn1-6'),
(117, 'redcarpetcarn1', 'redcarpetcarn1-7'),
(118, 'redcarpetcarn1', 'redcarpetcarn1-8'),
(119, 'redcarpetcarn1', 'redcarpetcarn1-9'),
(120, 'redcarpetcarn1', 'redcarpetcarn1-10'),
(121, 'redcarpetcarn1', 'redcarpetcarn1-11'),
(122, 'redcarpetcarn1', 'redcarpetcarn1-12'),
(123, 'redcarpetcarn1', 'redcarpetcarn1-13'),
(124, 'redcarpetcarn1', 'redcarpetcarn1-14'),
(125, 'redcarpetcarn1', 'redcarpetcarn1-15'),
(126, 'redcarpetcarn1', 'redcarpetcarn1-16'),
(127, 'redcarpetcarn1', 'redcarpetcarn1-17'),
(128, 'redcarpetcarn1', 'redcarpetcarn1-18'),
(129, 'redcarpetcarn1', 'redcarpetcarn1-19'),
(130, 'redcarpetcarn1', 'redcarpetcarn1-20'),
(131, 'redcarpetcarn1', 'redcarpetcarn1-21'),
(132, 'redcarpetcarn1', 'redcarpetcarn1-22'),
(133, 'redcarpetcarn1', 'redcarpetcarn1-23'),
(134, 'redcarpetcarn1', 'redcarpetcarn1-24'),
(135, 'redcarpetcarn1', 'redcarpetcarn1-25'),
(136, 'redcarpetcarn1', 'redcarpetcarn1-26'),
(137, 'redcarpetcarn1', 'redcarpetcarn1-27'),
(138, 'redcarpetcarn1', 'redcarpetcarn1-28'),
(139, 'redcarpetcarn1', 'redcarpetcarn1-29'),
(140, 'redcarpetcarn1', 'redcarpetcarn1-30'),
(141, 'redcarpetcarn1', 'redcarpetcarn1-31'),
(142, 'redcarpetcarn1', 'redcarpetcarn1-32'),
(143, 'redcarpetcarn1', 'redcarpetcarn1-33'),
(144, 'redcarpetcarn1', 'redcarpetcarn1-34'),
(145, 'redcarpetcarn1', 'redcarpetcarn1-35'),
(146, 'redcarpetcarn1', 'redcarpetcarn1-36'),
(147, 'redcarpetcarn1', 'redcarpetcarn1-37'),
(148, 'redcarpetcarn1', 'redcarpetcarn1-38'),
(149, 'redcarpetcarn1', 'redcarpetcarn1-39'),
(150, 'redcarpetcarn1', 'redcarpetcarn1-40'),
(151, 'redcarpetcarn1', 'redcarpetcarn1-41'),
(152, 'redcarpetcarn1', 'redcarpetcarn1-42'),
(153, 'redcarpetcarn1', 'redcarpetcarn1-43'),
(154, 'redcarpetcarn1', 'redcarpetcarn1-44'),
(155, 'redcarpetcarn1', 'redcarpetcarn1-45'),
(156, 'redcarpetcarn1', 'redcarpetcarn1-46'),
(157, 'redcarpetcarn1', 'redcarpetcarn1-47'),
(158, 'redcarpetcarn1', 'redcarpetcarn1-48'),
(159, 'redcarpetcarn1', 'redcarpetcarn1-49'),
(160, 'redcarpetcarn1', 'redcarpetcarn1-50'),
(161, 'redcarpetcarn1', 'redcarpetcarn1-51'),
(162, 'redcarpetcarn1', 'redcarpetcarn1-52'),
(163, 'redcarpetcarn1', 'redcarpetcarn1-53'),
(164, 'redcarpetcarn1', 'redcarpetcarn1-54'),
(165, 'redcarpetcarn1', 'redcarpetcarn1-55'),
(166, 'redcarpetcarn1', 'redcarpetcarn1-56'),
(167, 'redcarpetcarn1', 'redcarpetcarn1-57'),
(168, 'redcarpetcarn1', 'redcarpetcarn1-58'),
(169, 'redcarpetcarn1', 'redcarpetcarn1-59'),
(170, 'redcarpetcarn1', 'redcarpetcarn1-60'),
(171, 'redcarpetcarn1', 'redcarpetcarn1-61'),
(172, 'redcarpetcarn1', 'redcarpetcarn1-62'),
(173, 'redcarpetcarn1', 'redcarpetcarn1-63'),
(174, 'redcarpetcarn1', 'redcarpetcarn1-64'),
(175, 'redcarpetcarn1', 'redcarpetcarn1-65'),
(176, 'redcarpetcarn1', 'redcarpetcarn1-66'),
(177, 'redcarpetcarn1', 'redcarpetcarn1-67'),
(178, 'redcarpetcarn1', 'redcarpetcarn1-68'),
(179, 'redcarpetcarn1', 'redcarpetcarn1-69'),
(180, 'redcarpetcarn1', 'redcarpetcarn1-70'),
(181, 'redcarpetcarn1', 'redcarpetcarn1-71'),
(182, 'redcarpetcarn1', 'redcarpetcarn1-72'),
(183, 'redcarpetcarn1', 'redcarpetcarn1-73'),
(184, 'redcarpetcarn1', 'redcarpetcarn1-74'),
(185, 'redcarpetcarn1', 'redcarpetcarn1-75'),
(186, 'redcarpetcarn1', 'redcarpetcarn1-76'),
(187, 'redcarpetcarn1', 'redcarpetcarn1-77'),
(188, 'redcarpetcarn1', 'redcarpetcarn1-78'),
(189, 'redcarpetcarn1', 'redcarpetcarn1-79'),
(190, 'redcarpetcarn1', 'redcarpetcarn1-80'),
(191, 'redcarpetcarn1', 'redcarpetcarn1-81'),
(192, 'redcarpetcarn1', 'redcarpetcarn1-82'),
(193, 'redcarpetcarn1', 'redcarpetcarn1-83'),
(194, 'redcarpetcarn1', 'redcarpetcarn1-84'),
(195, 'redcarpetcarn1', 'redcarpetcarn1-85'),
(196, 'redcarpetcarn1', 'redcarpetcarn1-86'),
(197, 'redcarpetcarn1', 'redcarpetcarn1-87'),
(198, 'redcarpetcarn1', 'redcarpetcarn1-88'),
(199, 'redcarpetcarn1', 'redcarpetcarn1-89'),
(200, 'redcarpetcarn1', 'redcarpetcarn1-90'),
(201, 'redcarpetcarn1', 'redcarpetcarn1-91'),
(202, 'redcarpetcarn1', 'redcarpetcarn1-92'),
(203, 'redcarpetcarn1', 'redcarpetcarn1-93'),
(204, 'redcarpetcarn1', 'redcarpetcarn1-94'),
(205, 'redcarpetcarn1', 'redcarpetcarn1-95'),
(206, 'redcarpetcarn1', 'redcarpetcarn1-96'),
(207, 'redcarpetcarn1', 'redcarpetcarn1-97'),
(208, 'redcarpetcarn1', 'redcarpetcarn1-98'),
(209, 'redcarpetcarn1', 'redcarpetcarn1-99'),
(210, 'redcarpetcarn1', 'redcarpetcarn1-100'),
(211, 'redcarpetcarn1', 'redcarpetcarn1-101'),
(212, 'redcarpetcarn1', 'redcarpetcarn1-102'),
(213, 'redcarpetcarn1', 'redcarpetcarn1-103'),
(214, 'redcarpetcarn1', 'redcarpetcarn1-104'),
(215, 'redcarpetcarn1', 'redcarpetcarn1-105'),
(216, 'redcarpetcarn1', 'redcarpetcarn1-106'),
(217, 'redcarpetcarn1', 'redcarpetcarn1-107'),
(218, 'redcarpetcarn1', 'redcarpetcarn1-108'),
(219, 'redcarpetcarn1', 'redcarpetcarn1-109'),
(220, 'redcarpetcarn1', 'redcarpetcarn1-110'),
(221, 'redcarpetcarn1', 'redcarpetcarn1-111'),
(222, 'redcarpetcarn1', 'redcarpetcarn1-112'),
(223, 'redcarpetcarn1', 'redcarpetcarn1-113'),
(224, 'redcarpetcarn1', 'redcarpetcarn1-114'),
(225, 'redcarpetcarn1', 'redcarpetcarn1-115'),
(226, 'redcarpetcarn1', 'redcarpetcarn1-116'),
(227, 'redcarpetcarn1', 'redcarpetcarn1-117'),
(228, 'redcarpetcarn1', 'redcarpetcarn1-118'),
(229, 'redcarpetcarn1', 'redcarpetcarn1-119'),
(230, 'redcarpetcarn1', 'redcarpetcarn1-120'),
(231, 'redcarpetcarn1', 'redcarpetcarn1-121'),
(232, 'redcarpetcarn1', 'redcarpetcarn1-122'),
(233, 'redcarpetcarn1', 'redcarpetcarn1-123'),
(234, 'redcarpetcarn1', 'redcarpetcarn1-124'),
(235, 'redcarpetcarn1', 'redcarpetcarn1-125'),
(236, 'redcarpetcarn1', 'redcarpetcarn1-126'),
(237, 'redcarpetcarn1', 'redcarpetcarn1-127'),
(238, 'redcarpetcarn1', 'redcarpetcarn1-128'),
(239, 'redcarpetcarn1', 'redcarpetcarn1-129'),
(240, 'redcarpetcarn1', 'redcarpetcarn1-130'),
(241, 'redcarpetcarn1', 'redcarpetcarn1-131'),
(242, 'redcarpetcarn1', 'redcarpetcarn1-132'),
(243, 'redcarpetcarn1', 'redcarpetcarn1-133'),
(244, 'redcarpetcarn1', 'redcarpetcarn1-134'),
(245, 'redcarpetcarn1', 'redcarpetcarn1-135'),
(246, 'redcarpetcarn1', 'redcarpetcarn1-136'),
(247, 'redcarpetcarn1', 'redcarpetcarn1-137'),
(248, 'redcarpetcarn1', 'redcarpetcarn1-138'),
(249, 'redcarpetcarn1', 'redcarpetcarn1-139'),
(250, 'redcarpetcarn1', 'redcarpetcarn1-140'),
(251, 'redcarpetcarn1', 'redcarpetcarn1-141'),
(252, 'redcarpetcarn1', 'redcarpetcarn1-142'),
(253, 'redcarpetcarn1', 'redcarpetcarn1-143'),
(254, 'redcarpetcarn1', 'redcarpetcarn1-144'),
(255, 'redcarpetcarn1', 'redcarpetcarn1-145'),
(256, 'redcarpetcarn1', 'redcarpetcarn1-146'),
(257, 'redcarpetcarn1', 'redcarpetcarn1-147'),
(258, 'redcarpetcarn1', 'redcarpetcarn1-148'),
(259, 'redcarpetcarn1', 'redcarpetcarn1-149'),
(260, 'redcarpetcarn1', 'redcarpetcarn1-150'),
(261, 'redcarpetcarn1', 'redcarpetcarn1-151'),
(262, 'redcarpetcarn1', 'redcarpetcarn1-152'),
(263, 'redcarpetcarn1', 'redcarpetcarn1-153'),
(264, 'redcarpetcarn1', 'redcarpetcarn1-154'),
(265, 'redcarpetcarn1', 'redcarpetcarn1-155'),
(266, 'redcarpetcarn1', 'redcarpetcarn1-156'),
(267, 'redcarpetcarn1', 'redcarpetcarn1-157'),
(268, 'redcarpetcarn1', 'redcarpetcarn1-158'),
(269, 'redcarpetcarn1', 'redcarpetcarn1-159'),
(270, 'redcarpetcarn1', 'redcarpetcarn1-160'),
(271, 'redcarpetcarn1', 'redcarpetcarn1-161'),
(272, 'redcarpetcarn1', 'redcarpetcarn1-162'),
(273, 'redcarpetcarn1', 'redcarpetcarn1-163'),
(274, 'redcarpetcarn1', 'redcarpetcarn1-164'),
(275, 'redcarpetcarn1', 'redcarpetcarn1-165'),
(276, 'redcarpetcarn1', 'redcarpetcarn1-166'),
(277, 'redcarpetcarn1', 'redcarpetcarn1-167'),
(278, 'redcarpetcarn1', 'redcarpetcarn1-168'),
(279, 'redcarpetcarn1', 'redcarpetcarn1-169'),
(280, 'redcarpetcarn1', 'redcarpetcarn1-170'),
(281, 'redcarpetcarn1', 'redcarpetcarn1-171'),
(282, 'redcarpetcarn1', 'redcarpetcarn1-172'),
(283, 'redcarpetcarn1', 'redcarpetcarn1-173'),
(284, 'redcarpetcarn1', 'redcarpetcarn1-174'),
(285, 'redcarpetcarn1', 'redcarpetcarn1-175'),
(286, 'redcarpetcarn1', 'redcarpetcarn1-176'),
(287, 'redcarpetcarn1', 'redcarpetcarn1-177'),
(288, 'redcarpetcarn1', 'redcarpetcarn1-178'),
(289, 'redcarpetcarn1', 'redcarpetcarn1-179'),
(290, 'redcarpetcarn1', 'redcarpetcarn1-180'),
(291, 'redcarpetcarn1', 'redcarpetcarn1-181'),
(292, 'redcarpetcarn1', 'redcarpetcarn1-182'),
(293, 'redcarpetcarn1', 'redcarpetcarn1-183'),
(294, 'redcarpetcarn1', 'redcarpetcarn1-184'),
(295, 'redcarpetcarn1', 'redcarpetcarn1-185'),
(296, 'redcarpetcarn1', 'redcarpetcarn1-186'),
(297, 'redcarpetcarn1', 'redcarpetcarn1-187'),
(298, 'redcarpetcarn1', 'redcarpetcarn1-188'),
(299, 'redcarpetcarn1', 'redcarpetcarn1-189'),
(300, 'redcarpetcarn1', 'redcarpetcarn1-190'),
(301, 'redcarpetcarn1', 'redcarpetcarn1-191'),
(302, 'redcarpetcarn1', 'redcarpetcarn1-192'),
(303, 'redcarpetcarn1', 'redcarpetcarn1-193'),
(304, 'redcarpetcarn1', 'redcarpetcarn1-194'),
(305, 'redcarpetcarn1', 'redcarpetcarn1-195'),
(306, 'redcarpetcarn1', 'redcarpetcarn1-196'),
(307, 'redcarpetcarn1', 'redcarpetcarn1-197'),
(308, 'redcarpetcarn1', 'redcarpetcarn1-198'),
(309, 'redcarpetcarn1', 'redcarpetcarn1-199'),
(310, 'redcarpetcarn1', 'redcarpetcarn1-200'),
(311, 'redcarpetcarn1', 'redcarpetcarn1-201'),
(312, 'redcarpetcarn1', 'redcarpetcarn1-202'),
(313, 'redcarpetcarn1', 'redcarpetcarn1-203'),
(314, 'redcarpetcarn1', 'redcarpetcarn1-204'),
(315, 'redcarpetcarn1', 'redcarpetcarn1-205'),
(316, 'redcarpetcarn1', 'redcarpetcarn1-206'),
(317, 'redcarpetcarn1', 'redcarpetcarn1-207'),
(318, 'redcarpetcarn1', 'redcarpetcarn1-208'),
(319, 'redcarpetcarn1', 'redcarpetcarn1-209'),
(320, 'redcarpetcarn1', 'redcarpetcarn1-210'),
(321, 'redcarpetcarn1', 'redcarpetcarn1-211'),
(322, 'redcarpetcarn1', 'redcarpetcarn1-212'),
(323, 'redcarpetcarn1', 'redcarpetcarn1-213'),
(324, 'redcarpetcarn1', 'redcarpetcarn1-214'),
(325, 'redcarpetcarn1', 'redcarpetcarn1-215'),
(326, 'redcarpetcarn1', 'redcarpetcarn1-216'),
(327, 'redcarpetcarn1', 'redcarpetcarn1-217'),
(328, 'redcarpetcarn1', 'redcarpetcarn1-218'),
(329, 'redcarpetcarn1', 'redcarpetcarn1-219'),
(330, 'redcarpetcarn1', 'redcarpetcarn1-220'),
(331, 'redcarpetcarn1', 'redcarpetcarn1-221'),
(332, 'redcarpetcarn1', 'redcarpetcarn1-222'),
(333, 'redcarpetcarn1', 'redcarpetcarn1-223'),
(334, 'redcarpetcarn1', 'redcarpetcarn1-224'),
(335, 'redcarpetcarn1', 'redcarpetcarn1-225'),
(336, 'redcarpetcarn1', 'redcarpetcarn1-226'),
(337, 'redcarpetcarn1', 'redcarpetcarn1-227'),
(338, 'redcarpetcarn1', 'redcarpetcarn1-228'),
(339, 'redcarpetcarn1', 'redcarpetcarn1-229'),
(340, 'redcarpetcarn1', 'redcarpetcarn1-230'),
(341, 'redcarpetcarn1', 'redcarpetcarn1-231'),
(342, 'redcarpetcarn1', 'redcarpetcarn1-232'),
(343, 'redcarpetcarn1', 'redcarpetcarn1-233'),
(344, 'redcarpetcarn1', 'redcarpetcarn1-234'),
(345, 'redcarpetcarn1', 'redcarpetcarn1-235'),
(346, 'redcarpetcarn1', 'redcarpetcarn1-236'),
(347, 'redcarpetcarn1', 'redcarpetcarn1-237'),
(348, 'redcarpetcarn1', 'redcarpetcarn1-238'),
(349, 'redcarpetcarn1', 'redcarpetcarn1-239'),
(350, 'redcarpetcarn1', 'redcarpetcarn1-240'),
(351, 'redcarpetcarn1', 'redcarpetcarn1-241'),
(352, 'redcarpetcarn1', 'redcarpetcarn1-242'),
(353, 'redcarpetcarn1', 'redcarpetcarn1-243'),
(354, 'redcarpetcarn1', 'redcarpetcarn1-244'),
(355, 'redcarpetcarn1', 'redcarpetcarn1-245'),
(356, 'redcarpetcarn1', 'redcarpetcarn1-246'),
(357, 'redcarpetcarn1', 'redcarpetcarn1-247'),
(358, 'redcarpetcarn1', 'redcarpetcarn1-248'),
(359, 'redcarpetcarn1', 'redcarpetcarn1-249'),
(360, 'redcarpetcarn1', 'redcarpetcarn1-250'),
(361, 'redcarpetcarn1', 'redcarpetcarn1-251'),
(362, 'redcarpetcarn1', 'redcarpetcarn1-252'),
(363, 'redcarpetcarn1', 'redcarpetcarn1-253'),
(364, 'redcarpetcarn1', 'redcarpetcarn1-254'),
(365, 'redcarpetcarn1', 'redcarpetcarn1-255'),
(366, 'redcarpetcarn1', 'redcarpetcarn1-256'),
(367, 'redcarpetcarn1', 'redcarpetcarn1-257'),
(368, 'redcarpetcarn1', 'redcarpetcarn1-258'),
(369, 'redcarpetcarn1', 'redcarpetcarn1-259'),
(370, 'redcarpetcarn1', 'redcarpetcarn1-260'),
(371, 'redcarpetcarn1', 'redcarpetcarn1-261'),
(372, 'redcarpetcarn1', 'redcarpetcarn1-262'),
(373, 'redcarpetcarn1', 'redcarpetcarn1-263'),
(374, 'redcarpetcarn1', 'redcarpetcarn1-264'),
(375, 'redcarpetcarn1', 'redcarpetcarn1-265'),
(376, 'redcarpetcarn1', 'redcarpetcarn1-266'),
(377, 'redcarpetcarn1', 'redcarpetcarn1-267'),
(378, 'redcarpetcarn1', 'redcarpetcarn1-268'),
(379, 'redcarpetcarn1', 'redcarpetcarn1-269'),
(380, 'redcarpetcarn1', 'redcarpetcarn1-270'),
(381, 'redcarpetcarn1', 'redcarpetcarn1-271'),
(382, 'redcarpetcarn1', 'redcarpetcarn1-272'),
(383, 'redcarpetcarn1', 'redcarpetcarn1-273'),
(384, 'redcarpetcarn1', 'redcarpetcarn1-274'),
(385, 'redcarpetcarn1', 'redcarpetcarn1-275'),
(386, 'redcarpetcarn1', 'redcarpetcarn1-276'),
(387, 'redcarpetcarn1', 'redcarpetcarn1-277'),
(388, 'redcarpetcarn1', 'redcarpetcarn1-278'),
(389, 'redcarpetcarn1', 'redcarpetcarn1-279'),
(390, 'redcarpetcarn1', 'redcarpetcarn1-280'),
(391, 'redcarpetcarn1', 'redcarpetcarn1-281'),
(392, 'redcarpetcarn1', 'redcarpetcarn1-282'),
(393, 'redcarpetcarn1', 'redcarpetcarn1-283'),
(394, 'redcarpetcarn1', 'redcarpetcarn1-284'),
(395, 'redcarpetcarn1', 'redcarpetcarn1-285'),
(396, 'redcarpetcarn1', 'redcarpetcarn1-286'),
(397, 'redcarpetcarn1', 'redcarpetcarn1-287'),
(398, 'redcarpetcarn1', 'redcarpetcarn1-288'),
(399, 'redcarpetcarn1', 'redcarpetcarn1-289'),
(400, 'redcarpetcarn1', 'redcarpetcarn1-290'),
(401, 'redcarpetcarn1', 'redcarpetcarn1-291'),
(402, 'redcarpetcarn1', 'redcarpetcarn1-292'),
(403, 'redcarpetcarn1', 'redcarpetcarn1-293'),
(404, 'redcarpetcarn1', 'redcarpetcarn1-294'),
(405, 'redcarpetcarn1', 'redcarpetcarn1-295'),
(406, 'redcarpetcarn1', 'redcarpetcarn1-296'),
(407, 'redcarpetcarn1', 'redcarpetcarn1-297'),
(408, 'redcarpetcarn1', 'redcarpetcarn1-298'),
(409, 'redcarpetcarn1', 'redcarpetcarn1-299'),
(410, 'redcarpetcarn1', 'redcarpetcarn1-300'),
(411, 'redcarpetcarn1', 'redcarpetcarn1-301'),
(412, 'redcarpetcarn1', 'redcarpetcarn1-302'),
(413, 'redcarpetcarn1', 'redcarpetcarn1-303'),
(414, 'redcarpetcarn1', 'redcarpetcarn1-304'),
(415, 'redcarpetcarn1', 'redcarpetcarn1-305'),
(416, 'redcarpetcarn1', 'redcarpetcarn1-306'),
(417, 'redcarpetcarn1', 'redcarpetcarn1-307'),
(418, 'redcarpetcarn1', 'redcarpetcarn1-308'),
(419, 'redcarpetcarn1', 'redcarpetcarn1-309'),
(420, 'redcarpetcarn1', 'redcarpetcarn1-310'),
(421, 'redcarpetcarn1', 'redcarpetcarn1-311'),
(422, 'redcarpetcarn1', 'redcarpetcarn1-312'),
(423, 'redcarpetcarn1', 'redcarpetcarn1-313'),
(424, 'redcarpetcarn1', 'redcarpetcarn1-314'),
(425, 'redcarpetcarn1', 'redcarpetcarn1-315'),
(426, 'redcarpetcarn1', 'redcarpetcarn1-316'),
(427, 'redcarpetcarn1', 'redcarpetcarn1-317'),
(428, 'redcarpetcarn1', 'redcarpetcarn1-318'),
(429, 'redcarpetcarn1', 'redcarpetcarn1-319'),
(430, 'redcarpetcarn1', 'redcarpetcarn1-320'),
(431, 'redcarpetcarn1', 'redcarpetcarn1-321'),
(432, 'redcarpetcarn1', 'redcarpetcarn1-322'),
(433, 'redcarpetcarn1', 'redcarpetcarn1-323'),
(434, 'redcarpetcarn1', 'redcarpetcarn1-324'),
(435, 'redcarpetcarn1', 'redcarpetcarn1-325'),
(436, 'redcarpetcarn1', 'redcarpetcarn1-326'),
(437, 'redcarpetcarn1', 'redcarpetcarn1-327'),
(438, 'redcarpetcarn1', 'redcarpetcarn1-328'),
(439, 'redcarpetcarn1', 'redcarpetcarn1-329'),
(440, 'redcarpetcarn1', 'redcarpetcarn1-330'),
(441, 'redcarpetcarn1', 'redcarpetcarn1-331'),
(442, 'redcarpetcarn1', 'redcarpetcarn1-332'),
(443, 'redcarpetcarn1', 'redcarpetcarn1-333'),
(444, 'redcarpetcarn1', 'redcarpetcarn1-334'),
(445, 'redcarpetcarn1', 'redcarpetcarn1-335'),
(446, 'redcarpetcarn1', 'redcarpetcarn1-336'),
(447, 'redcarpetcarn1', 'redcarpetcarn1-337'),
(448, 'redcarpetcarn1', 'redcarpetcarn1-338'),
(449, 'redcarpetcarn1', 'redcarpetcarn1-339'),
(450, 'redcarpetcarn1', 'redcarpetcarn1-340'),
(451, 'redcarpetcarn1', 'redcarpetcarn1-341'),
(452, 'redcarpetcarn1', 'redcarpetcarn1-342'),
(453, 'redcarpetcarn1', 'redcarpetcarn1-343'),
(454, 'redcarpetcarn1', 'redcarpetcarn1-344'),
(455, 'redcarpetcarn1', 'redcarpetcarn1-345'),
(456, 'redcarpetcarn1', 'redcarpetcarn1-346'),
(457, 'redcarpetcarn1', 'redcarpetcarn1-347'),
(458, 'redcarpetcarn1', 'redcarpetcarn1-348'),
(459, 'redcarpetcarn1', 'redcarpetcarn1-349'),
(460, 'redcarpetcarn1', 'redcarpetcarn1-350'),
(461, 'redcarpetcarn1', 'redcarpetcarn1-351'),
(462, 'redcarpetcarn1', 'redcarpetcarn1-352'),
(463, 'redcarpetcarn1', 'redcarpetcarn1-353'),
(464, 'redcarpetcarn1', 'redcarpetcarn1-354'),
(465, 'redcarpetcarn1', 'redcarpetcarn1-355'),
(466, 'redcarpetcarn1', 'redcarpetcarn1-356'),
(467, 'redcarpetcarn1', 'redcarpetcarn1-357'),
(468, 'redcarpetcarn1', 'redcarpetcarn1-358'),
(469, 'redcarpetcarn1', 'redcarpetcarn1-359'),
(470, 'redcarpetcarn1', 'redcarpetcarn1-360'),
(471, 'redcarpetcarn1', 'redcarpetcarn1-361'),
(472, 'redcarpetcarn1', 'redcarpetcarn1-362'),
(473, 'redcarpetcarn1', 'redcarpetcarn1-363'),
(474, 'redcarpetcarn1', 'redcarpetcarn1-364'),
(475, 'redcarpetcarn1', 'redcarpetcarn1-365'),
(476, 'redcarpetcarn1', 'redcarpetcarn1-366'),
(477, 'redcarpetcarn1', 'redcarpetcarn1-367'),
(478, 'redcarpetcarn1', 'redcarpetcarn1-368'),
(479, 'redcarpetcarn1', 'redcarpetcarn1-369'),
(480, 'redcarpetcarn1', 'redcarpetcarn1-370'),
(481, 'redcarpetcarn1', 'redcarpetcarn1-371'),
(482, 'redcarpetcarn1', 'redcarpetcarn1-372'),
(483, 'redcarpetcarn1', 'redcarpetcarn1-373'),
(484, 'redcarpetcarn1', 'redcarpetcarn1-374'),
(485, 'redcarpetcarn1', 'redcarpetcarn1-375'),
(486, 'redcarpetcarn1', 'redcarpetcarn1-376'),
(487, 'redcarpetcarn1', 'redcarpetcarn1-377'),
(488, 'redcarpetcarn1', 'redcarpetcarn1-378'),
(489, 'redcarpetcarn1', 'redcarpetcarn1-379'),
(490, 'redcarpetcarn1', 'redcarpetcarn1-380'),
(491, 'redcarpetcarn1', 'redcarpetcarn1-381'),
(492, 'redcarpetcarn1', 'redcarpetcarn1-382'),
(493, 'redcarpetcarn1', 'redcarpetcarn1-383'),
(494, 'redcarpetcarn1', 'redcarpetcarn1-384'),
(495, 'redcarpetcarn1', 'redcarpetcarn1-385'),
(496, 'redcarpetcarn1', 'redcarpetcarn1-386'),
(497, 'redcarpetcarn1', 'redcarpetcarn1-387'),
(498, 'redcarpetcarn1', 'redcarpetcarn1-388'),
(499, 'redcarpetcarn1', 'redcarpetcarn1-389'),
(500, 'redcarpetcarn1', 'redcarpetcarn1-390'),
(501, 'redcarpetcarn1', 'redcarpetcarn1-391'),
(502, 'redcarpetcarn1', 'redcarpetcarn1-392'),
(503, 'redcarpetcarn1', 'redcarpetcarn1-393'),
(504, 'redcarpetcarn1', 'redcarpetcarn1-394'),
(505, 'redcarpetcarn1', 'redcarpetcarn1-395'),
(506, 'redcarpetcarn1', 'redcarpetcarn1-396'),
(507, 'redcarpetcarn1', 'redcarpetcarn1-397'),
(508, 'redcarpetcarn1', 'redcarpetcarn1-398'),
(509, 'redcarpetcarn1', 'redcarpetcarn1-399'),
(510, 'redcarpetcarn1', 'redcarpetcarn1-400'),
(511, 'redcarpetcarn1', 'redcarpetcarn1-401'),
(512, 'redcarpetcarn1', 'redcarpetcarn1-402'),
(513, 'redcarpetcarn1', 'redcarpetcarn1-403'),
(514, 'redcarpetcarn1', 'redcarpetcarn1-404'),
(515, 'redcarpetcarn1', 'redcarpetcarn1-405'),
(516, 'redcarpetcarn1', 'redcarpetcarn1-406'),
(517, 'redcarpetcarn1', 'redcarpetcarn1-407'),
(518, 'redcarpetcarn1', 'redcarpetcarn1-408'),
(519, 'redcarpetcarn1', 'redcarpetcarn1-409'),
(520, 'redcarpetcarn1', 'redcarpetcarn1-410'),
(521, 'redcarpetcarn1', 'redcarpetcarn1-411'),
(522, 'redcarpetcarn1', 'redcarpetcarn1-412'),
(523, 'redcarpetcarn1', 'redcarpetcarn1-413'),
(524, 'redcarpetcarn1', 'redcarpetcarn1-414'),
(525, 'redcarpetcarn1', 'redcarpetcarn1-415'),
(526, 'redcarpetcarn1', 'redcarpetcarn1-416'),
(527, 'redcarpetcarn1', 'redcarpetcarn1-417'),
(528, 'redcarpetcarn1', 'redcarpetcarn1-418'),
(529, 'redcarpetcarn1', 'redcarpetcarn1-419'),
(530, 'redcarpetcarn1', 'redcarpetcarn1-420'),
(531, 'redcarpetcarn1', 'redcarpetcarn1-421'),
(532, 'redcarpetcarn1', 'redcarpetcarn1-422'),
(533, 'redcarpetcarn1', 'redcarpetcarn1-423'),
(534, 'redcarpetcarn1', 'redcarpetcarn1-424'),
(535, 'redcarpetcarn1', 'redcarpetcarn1-425'),
(536, 'redcarpetcarn1', 'redcarpetcarn1-426'),
(537, 'redcarpetcarn1', 'redcarpetcarn1-427'),
(538, 'redcarpetcarn1', 'redcarpetcarn1-428'),
(539, 'redcarpetcarn1', 'redcarpetcarn1-429'),
(540, 'redcarpetcarn1', 'redcarpetcarn1-430'),
(541, 'redcarpetcarn1', 'redcarpetcarn1-431'),
(542, 'redcarpetcarn1', 'redcarpetcarn1-432'),
(543, 'redcarpetcarn1', 'redcarpetcarn1-433'),
(544, 'redcarpetcarn1', 'redcarpetcarn1-434'),
(545, 'redcarpetcarn1', 'redcarpetcarn1-435'),
(546, 'redcarpetcarn1', 'redcarpetcarn1-436'),
(547, 'redcarpetcarn1', 'redcarpetcarn1-437'),
(548, 'redcarpetcarn1', 'redcarpetcarn1-438'),
(549, 'redcarpetcarn1', 'redcarpetcarn1-439'),
(550, 'redcarpetcarn1', 'redcarpetcarn1-440'),
(551, 'redcarpetcarn1', 'redcarpetcarn1-441'),
(552, 'redcarpetcarn1', 'redcarpetcarn1-442'),
(553, 'redcarpetcarn1', 'redcarpetcarn1-443'),
(554, 'redcarpetcarn1', 'redcarpetcarn1-444'),
(555, 'redcarpetcarn1', 'redcarpetcarn1-445'),
(556, 'redcarpetcarn1', 'redcarpetcarn1-446'),
(557, 'redcarpetcarn1', 'redcarpetcarn1-447'),
(558, 'redcarpetcarn1', 'redcarpetcarn1-448'),
(559, 'redcarpetcarn1', 'redcarpetcarn1-449'),
(560, 'redcarpetcarn1', 'redcarpetcarn1-450'),
(561, 'redcarpetcarn1', 'redcarpetcarn1-451'),
(562, 'redcarpetcarn1', 'redcarpetcarn1-452'),
(563, 'redcarpetcarn1', 'redcarpetcarn1-453'),
(564, 'redcarpetcarn1', 'redcarpetcarn1-454'),
(565, 'redcarpetcarn1', 'redcarpetcarn1-455'),
(566, 'redcarpetcarn1', 'redcarpetcarn1-456'),
(567, 'redcarpetcarn1', 'redcarpetcarn1-457'),
(568, 'redcarpetcarn1', 'redcarpetcarn1-458'),
(569, 'redcarpetcarn1', 'redcarpetcarn1-459'),
(570, 'redcarpetcarn1', 'redcarpetcarn1-460'),
(571, 'redcarpetcarn1', 'redcarpetcarn1-461'),
(572, 'redcarpetcarn1', 'redcarpetcarn1-462'),
(573, 'redcarpetcarn1', 'redcarpetcarn1-463'),
(574, 'redcarpetcarn1', 'redcarpetcarn1-464'),
(575, 'redcarpetcarn1', 'redcarpetcarn1-465'),
(576, 'redcarpetcarn1', 'redcarpetcarn1-466'),
(577, 'redcarpetcarn1', 'redcarpetcarn1-467'),
(578, 'redcarpetcarn1', 'redcarpetcarn1-468'),
(579, 'redcarpetcarn1', 'redcarpetcarn1-469'),
(580, 'redcarpetcarn1', 'redcarpetcarn1-470'),
(581, 'redcarpetcarn1', 'redcarpetcarn1-471'),
(582, 'redcarpetcarn1', 'redcarpetcarn1-472'),
(583, 'redcarpetcarn1', 'redcarpetcarn1-473'),
(584, 'redcarpetcarn1', 'redcarpetcarn1-474'),
(585, 'redcarpetcarn1', 'redcarpetcarn1-475'),
(586, 'redcarpetcarn1', 'redcarpetcarn1-476'),
(587, 'redcarpetcarn1', 'redcarpetcarn1-477'),
(588, 'redcarpetcarn1', 'redcarpetcarn1-478'),
(589, 'redcarpetcarn1', 'redcarpetcarn1-479'),
(590, 'redcarpetcarn1', 'redcarpetcarn1-480'),
(591, 'redcarpetcarn1', 'redcarpetcarn1-481'),
(592, 'redcarpetcarn1', 'redcarpetcarn1-482'),
(593, 'redcarpetcarn1', 'redcarpetcarn1-483'),
(594, 'redcarpetcarn1', 'redcarpetcarn1-484'),
(595, 'redcarpetcarn1', 'redcarpetcarn1-485'),
(596, 'redcarpetcarn1', 'redcarpetcarn1-486'),
(597, 'redcarpetcarn1', 'redcarpetcarn1-487'),
(598, 'redcarpetcarn1', 'redcarpetcarn1-488'),
(599, 'redcarpetcarn1', 'redcarpetcarn1-489'),
(600, 'redcarpetcarn1', 'redcarpetcarn1-490'),
(601, 'redcarpetcarn1', 'redcarpetcarn1-491'),
(602, 'redcarpetcarn1', 'redcarpetcarn1-492'),
(603, 'redcarpetcarn1', 'redcarpetcarn1-493'),
(604, 'redcarpetcarn1', 'redcarpetcarn1-494'),
(605, 'redcarpetcarn1', 'redcarpetcarn1-495'),
(606, 'redcarpetcarn1', 'redcarpetcarn1-496'),
(607, 'redcarpetcarn1', 'redcarpetcarn1-497'),
(608, 'redcarpetcarn1', 'redcarpetcarn1-498'),
(609, 'redcarpetcarn1', 'redcarpetcarn1-499'),
(610, 'redcarpetcarn1', 'redcarpetcarn1-500'),
(611, 'redcarpetcarn1', 'redcarpetcarn1-501'),
(612, 'redcarpetcarn1', 'redcarpetcarn1-502'),
(613, 'redcarpetcarn1', 'redcarpetcarn1-503'),
(614, 'redcarpetcarn1', 'redcarpetcarn1-504'),
(615, 'redcarpetcarn1', 'redcarpetcarn1-505'),
(616, 'redcarpetcarn1', 'redcarpetcarn1-506'),
(617, 'redcarpetcarn1', 'redcarpetcarn1-507'),
(618, 'redcarpetcarn1', 'redcarpetcarn1-508'),
(619, 'redcarpetcarn1', 'redcarpetcarn1-509'),
(620, 'redcarpetcarn1', 'redcarpetcarn1-510'),
(621, 'redcarpetcarn1', 'redcarpetcarn1-511'),
(622, 'redcarpetcarn1', 'redcarpetcarn1-512'),
(623, 'redcarpetcarn1', 'redcarpetcarn1-513'),
(624, 'redcarpetcarn1', 'redcarpetcarn1-514'),
(625, 'redcarpetcarn1', 'redcarpetcarn1-515'),
(626, 'redcarpetcarn1', 'redcarpetcarn1-516'),
(627, 'redcarpetcarn1', 'redcarpetcarn1-517'),
(628, 'redcarpetcarn1', 'redcarpetcarn1-518'),
(629, 'redcarpetcarn1', 'redcarpetcarn1-519'),
(630, 'redcarpetcarn1', 'redcarpetcarn1-520'),
(631, 'redcarpetcarn1', 'redcarpetcarn1-521'),
(632, 'redcarpetcarn1', 'redcarpetcarn1-522'),
(633, 'redcarpetcarn1', 'redcarpetcarn1-523'),
(634, 'redcarpetcarn1', 'redcarpetcarn1-524'),
(635, 'redcarpetcarn1', 'redcarpetcarn1-525'),
(636, 'redcarpetcarn1', 'redcarpetcarn1-526'),
(637, 'redcarpetcarn1', 'redcarpetcarn1-527'),
(638, 'redcarpetcarn1', 'redcarpetcarn1-528'),
(639, 'redcarpetcarn1', 'redcarpetcarn1-529'),
(640, 'redcarpetcarn1', 'redcarpetcarn1-530'),
(641, 'redcarpetcarn1', 'redcarpetcarn1-531'),
(642, 'redcarpetcarn1', 'redcarpetcarn1-532'),
(643, 'redcarpetcarn1', 'redcarpetcarn1-533'),
(644, 'redcarpetcarn1', 'redcarpetcarn1-534'),
(645, 'redcarpetcarn1', 'redcarpetcarn1-535'),
(646, 'redcarpetcarn1', 'redcarpetcarn1-536'),
(647, 'redcarpetcarn1', 'redcarpetcarn1-537'),
(648, 'redcarpetcarn1', 'redcarpetcarn1-538'),
(649, 'redcarpetcarn1', 'redcarpetcarn1-539'),
(650, 'redcarpetcarn1', 'redcarpetcarn1-540'),
(651, 'redcarpetcarn1', 'redcarpetcarn1-541'),
(652, 'redcarpetcarn1', 'redcarpetcarn1-542'),
(653, 'redcarpetcarn1', 'redcarpetcarn1-543'),
(654, 'redcarpetcarn1', 'redcarpetcarn1-544'),
(655, 'redcarpetcarn1', 'redcarpetcarn1-545'),
(656, 'redcarpetcarn1', 'redcarpetcarn1-546'),
(657, 'redcarpetcarn1', 'redcarpetcarn1-547'),
(658, 'redcarpetcarn1', 'redcarpetcarn1-548'),
(659, 'redcarpetcarn1', 'redcarpetcarn1-549'),
(660, 'redcarpetcarn1', 'redcarpetcarn1-550'),
(661, 'redcarpetcarn1', 'redcarpetcarn1-551'),
(662, 'redcarpetcarn1', 'redcarpetcarn1-552'),
(663, 'redcarpetcarn1', 'redcarpetcarn1-553'),
(664, 'redcarpetcarn1', 'redcarpetcarn1-554'),
(665, 'redcarpetcarn1', 'redcarpetcarn1-555'),
(666, 'redcarpetcarn1', 'redcarpetcarn1-556'),
(667, 'redcarpetcarn1', 'redcarpetcarn1-557'),
(668, 'redcarpetcarn1', 'redcarpetcarn1-558'),
(669, 'redcarpetcarn1', 'redcarpetcarn1-559'),
(670, 'redcarpetcarn1', 'redcarpetcarn1-560'),
(671, 'redcarpetcarn1', 'redcarpetcarn1-561'),
(672, 'redcarpetcarn1', 'redcarpetcarn1-562'),
(673, 'redcarpetcarn1', 'redcarpetcarn1-563'),
(674, 'redcarpetcarn1', 'redcarpetcarn1-564'),
(675, 'redcarpetcarn1', 'redcarpetcarn1-565'),
(676, 'redcarpetcarn1', 'redcarpetcarn1-566'),
(677, 'redcarpetcarn1', 'redcarpetcarn1-567'),
(678, 'redcarpetcarn1', 'redcarpetcarn1-568'),
(679, 'redcarpetcarn1', 'redcarpetcarn1-569'),
(680, 'redcarpetcarn1', 'redcarpetcarn1-570'),
(681, 'redcarpetcarn1', 'redcarpetcarn1-571'),
(682, 'redcarpetcarn1', 'redcarpetcarn1-572'),
(683, 'redcarpetcarn1', 'redcarpetcarn1-573'),
(684, 'redcarpetcarn1', 'redcarpetcarn1-574'),
(685, 'redcarpetcarn1', 'redcarpetcarn1-575'),
(686, 'redcarpetcarn1', 'redcarpetcarn1-576'),
(687, 'redcarpetcarn1', 'redcarpetcarn1-577'),
(688, 'redcarpetcarn1', 'redcarpetcarn1-578'),
(689, 'redcarpetcarn1', 'redcarpetcarn1-579'),
(690, 'redcarpetcarn1', 'redcarpetcarn1-580'),
(691, 'redcarpetcarn1', 'redcarpetcarn1-581'),
(692, 'redcarpetcarn1', 'redcarpetcarn1-582'),
(693, 'redcarpetcarn1', 'redcarpetcarn1-583'),
(694, 'redcarpetcarn1', 'redcarpetcarn1-584'),
(695, 'redcarpetcarn1', 'redcarpetcarn1-585'),
(696, 'redcarpetcarn1', 'redcarpetcarn1-586'),
(697, 'redcarpetcarn1', 'redcarpetcarn1-587'),
(698, 'redcarpetcarn1', 'redcarpetcarn1-588'),
(699, 'redcarpetcarn1', 'redcarpetcarn1-589'),
(700, 'redcarpetcarn1', 'redcarpetcarn1-590'),
(701, 'redcarpetcarn1', 'redcarpetcarn1-591'),
(702, 'redcarpetcarn1', 'redcarpetcarn1-592'),
(703, 'redcarpetcarn1', 'redcarpetcarn1-593'),
(704, 'redcarpetcarn1', 'redcarpetcarn1-594'),
(705, 'redcarpetcarn1', 'redcarpetcarn1-595'),
(706, 'redcarpetcarn1', 'redcarpetcarn1-596'),
(707, 'redcarpetcarn1', 'redcarpetcarn1-597'),
(708, 'redcarpetcarn1', 'redcarpetcarn1-598'),
(709, 'redcarpetcarn1', 'redcarpetcarn1-599'),
(710, 'redcarpetcarn1', 'redcarpetcarn1-600');

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
(3, 3, '12:00:00', 5, 'redcarpetcarn2', '2019-09-18', 100, 1),
(4, 4, '14:00:00', 5, 'redcarpetcarn1', '2019-09-28', 250.26, 1),
(5, 5, '17:00:00', 5, 'redcarpetcarn2', '2019-10-11', 146.66, 1);

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
  `thr_status` tinyint(1) NOT NULL COMMENT 'true => Existing, false => Deleted',
  `hash` varchar(255) NOT NULL,
  `verified` varchar(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_theater`
--

INSERT INTO `tbl_theater` (`thr_id`, `thr_name`, `thr_uname`, `thr_pasd`, `thr_phone`, `thr_mail`, `thr_screens`, `thr_location`, `thr_status`, `hash`, `verified`) VALUES
(1, 'Casanova', 'casanova', '03730c36678266f50229d3fdc0d6d0cb', 7542103277, 'cas@outlook.com', 4, 'Mumbai', 1, '', 'ACTIVE'),
(2, 'Carnival', 'carnival390', '3b5477ba1dbc0cb957cfaa2e6a6aaa6c', 7586978887, 'carnival390@gmail.com', 3, 'Cochin', 1, '', 'ACTIVE'),
(3, 'Aries', 'aries788', '54e553e1f26aba4f435548bd9645811a', 7845456544, 'aries788@gmail.com', 5, 'Trivandrum', 1, '', 'ACTIVE'),
(4, 'The Wiltern', 'wiltern11', 'b025accb97d7e77ce4fd87af71dd0fc8', 45635333, 'contact@wiltern.com', 2, '3790 Wilshire Blvd, Los Angeles, CA 90010, USA', 1, '', 'ACTIVE'),
(5, 'Carnival RedCarpet', 'redcarpetcarn', '7c0ac50e95a235bea887b7a50df55346', 7845123654, 'redcarpetcarnival@outlook.com', 5, 'Kariyad', 1, '', 'ACTIVE'),
(6, 'Kavitha Screens', 'kavitha', '01cd93dddf5f2beb2b118a2b8d4e459d', 7412589630, 'kavitha123@gmail.com', 2, 'Ernakulam', 0, '', 'ACTIVE'),
(7, '7Max Theaters', '7max', 'f35fe3a9044bc0b5a51d43d4de50007f', 9874563210, 'sevenmax@gmail.com', 3, 'Kochi', 1, '', 'ACTIVE'),
(8, 'San Screens', 'san666', '0b2994d4c7e7790b1b0b60097441e3ad', 8943199646, 'andrewssan666@gmail.com', 5, 'Moscow', 0, '8b1bd2ddfe4d0a6db8b808cfeece64fa', 'ACTIVE');

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
  `user_type` varchar(10) NOT NULL COMMENT 'admin,enduser,theater',
  `hash` varchar(255) DEFAULT NULL,
  `verified` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `user_name`, `user_uname`, `user_pasd`, `user_mail`, `user_phone`, `user_type`, `hash`, `verified`) VALUES
(1, 'Al Ameen AR', 'amrameen769', 'cf0d02ec99e61a64137b8a2c3b03e030', 'amrameen769@gmail.com', 8943199646, 'admin', NULL, 'ACTIVE'),
(2, 'Sibin', 'sibin29', '89cc7b7b2e7d21ad45d883771d795ed2', 'sibin292000@gmail.com', 9496332052, 'enduser', NULL, 'ACTIVE'),
(3, 'AB Dullah', 'dulla', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'ab@du.lla', 7559869362, 'enduser', NULL, 'ACTIVE'),
(4, 'Alphin Felix', 'alphin123', 'd7217b5d7925ec0a9163d1b7a7dbb606', 'alphinmay30@gmail.com', 7560843461, 'enduser', NULL, 'ACTIVE'),
(5, 'Sanju', 'sanju07', 'c24526bfc0fe42d8b09a314e64d7b0d9', 'sanju@gmail.com', 9495117707, 'enduser', NULL, 'ACTIVE'),
(6, 'Abijith', 'abi', '315eb115d98fcbad39ffc5edebd669c9', 'abijithtjayan@gmail.com', 8330045217, 'enduser', NULL, 'ACTIVE'),
(7, 'Arun', 'arunmathew', 'a10372605b860035a32286c3fa356e8e', 'mathewarun29@gmail.com', 9037250473, 'enduser', NULL, 'ACTIVE'),
(8, 'Rosbee Binny', 'rosbeebinny', 'a21666d276025251f7b743c0884f453a ', 'rosbeebinny@gmail.com', 8606107201, 'enduser', NULL, 'ACTIVE'),
(9, 'Arjun AR', 'bumblebee', '0157f36cc315a161a86b1f9e0c74040d', 'rithwikdancer@gmail.com', 9497188345, 'enduser', NULL, 'ACTIVE'),
(10, 'Ajesh', 'ajeshta', 'b9d4ee1c44ab7b696da717780426cea6', 'ajeshta02@gmail.com', 9995429368, 'enduser', NULL, 'ACTIVE'),
(11, 'Nandana Haridas', 'nandu', '4bca8cbee888c6a23e206e7e53f9933d', 'nanduharidas0101@gmail.com', 9400854543, 'enduser', NULL, 'ACTIVE'),
(12, 'Ameen', 'amrameen', '0b2994d4c7e7790b1b0b60097441e3ad', 'amrameen769@depaul.edu.in', 7025886445, 'enduser', 'a953a4410fdbcee14fdff378c5260710', 'ACTIVE');

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
  MODIFY `book_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_movie`
--
ALTER TABLE `tbl_movie`
  MODIFY `mv_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_review`
--
ALTER TABLE `tbl_review`
  MODIFY `rvw_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_screens`
--
ALTER TABLE `tbl_screens`
  MODIFY `def_screen_id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tbl_seats`
--
ALTER TABLE `tbl_seats`
  MODIFY `def_seat_id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=711;

--
-- AUTO_INCREMENT for table `tbl_showtime`
--
ALTER TABLE `tbl_showtime`
  MODIFY `shw_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_theater`
--
ALTER TABLE `tbl_theater`
  MODIFY `thr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
