-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2016 at 06:28 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `paper`
--

-- --------------------------------------------------------

--
-- Table structure for table `action`
--

CREATE TABLE `action` (
  `action_id` int(11) NOT NULL,
  `action_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `action`
--

INSERT INTO `action` (`action_id`, `action_name`) VALUES
(1, 'all_user'),
(2, 'all_fit'),
(3, 'view_fit');

-- --------------------------------------------------------

--
-- Table structure for table `fit`
--

CREATE TABLE `fit` (
  `fit_id` int(11) NOT NULL,
  `string_id` varchar(500) DEFAULT NULL,
  `viewed` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fit`
--

INSERT INTO `fit` (`fit_id`, `string_id`, `viewed`) VALUES
(8, 'Thông báo danh sách sinh viên K.14 nộp bài thu hoạch tuần sinh hoạt công dân HK1-2016 22/11/16 Thông báo sinh viên', 1),
(9, 'Thông báo (lần cuối) về việc sinh viên chưa cung cấp số tài khoản để nhận các khoản học bổng, trợ cấp xã hội & dân tộc thiểu số 22/11/16 Thông báo sinh viên', 1),
(10, 'Tham gia cuộc thi Imagine Cup do Microsoft tổ chức. 18/11/16 Thông báo sinh viên', 1),
(11, 'TKB dự kiến HK2 2016-2017 để lấy ý kiến SV 18/11/16 Thông báo sinh viên', 1),
(12, 'Seminar Bảo mật Mạng máy tính 24/11/16 Thông báo sinh viên', 1),
(14, 'TB về việc họp lớp nhằm giải đáp các thắc mắc đăng ký môn học HK2 - dành cho K16 29/11/16 Thông báo sinh viên', 1);

-- --------------------------------------------------------

--
-- Table structure for table `note`
--

CREATE TABLE `note` (
  `note_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `role_name`) VALUES
(1, 'super_admin'),
(2, ' People'),
(3, 'fit_mod'),
(4, 'dashboard_admin'),
(5, 'backend_people');

-- --------------------------------------------------------

--
-- Table structure for table `role_action_map`
--

CREATE TABLE `role_action_map` (
  `role_id` int(11) NOT NULL,
  `action_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `todo`
--

CREATE TABLE `todo` (
  `todo_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `content` varchar(255) NOT NULL,
  `completed` tinyint(1) UNSIGNED DEFAULT '0',
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `todo`
--

INSERT INTO `todo` (`todo_id`, `user_id`, `content`, `completed`, `date_added`, `date_modified`) VALUES
(1, 2, 's', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 2, 'b', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 2, 'b', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 2, 'c', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 2, 'd', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 2, 'd', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 2, 'e', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 2, 'e', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 2, 'f', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 2, 'abc', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 2, 'sa', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 2, 'Lovely', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 2, 'lonely', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 2, 'well', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 2, 'gggg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 2, 'gggge', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 2, 'hihi', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `login` varchar(50) NOT NULL,
  `password` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `group_id` int(11) NOT NULL,
  `date_added` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `login`, `password`, `email`, `group_id`, `date_added`, `date_modified`) VALUES
(2, 'admin', '6fce5a7ecd7274fe3e5f624029df93cf27007f45c8b496e78c722f44c0657b0f', '', 42, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'anyone', '6fce5a7ecd7274fe3e5f624029df93cf27007f45c8b496e78c722f44c0657b0f', '', 43, NULL, NULL),
(4, 'dashboard_manager', '6fce5a7ecd7274fe3e5f624029df93cf27007f45c8b496e78c722f44c0657b0f', '', 0, NULL, NULL),
(5, 'fit_one', '6fce5a7ecd7274fe3e5f624029df93cf27007f45c8b496e78c722f44c0657b0f', '', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_action_map`
--

CREATE TABLE `user_action_map` (
  `user_id` int(11) NOT NULL,
  `action_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_action_map`
--

INSERT INTO `user_action_map` (`user_id`, `action_id`) VALUES
(3, 2),
(3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `user_role_map`
--

CREATE TABLE `user_role_map` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_role_map`
--

INSERT INTO `user_role_map` (`user_id`, `role_id`) VALUES
(2, 1),
(2, 2),
(2, 5),
(3, 2),
(3, 5),
(4, 4),
(4, 5),
(5, 3),
(5, 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `action`
--
ALTER TABLE `action`
  ADD PRIMARY KEY (`action_id`);

--
-- Indexes for table `fit`
--
ALTER TABLE `fit`
  ADD PRIMARY KEY (`fit_id`);

--
-- Indexes for table `note`
--
ALTER TABLE `note`
  ADD PRIMARY KEY (`note_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `role_action_map`
--
ALTER TABLE `role_action_map`
  ADD PRIMARY KEY (`role_id`,`action_id`);

--
-- Indexes for table `todo`
--
ALTER TABLE `todo`
  ADD PRIMARY KEY (`todo_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_action_map`
--
ALTER TABLE `user_action_map`
  ADD PRIMARY KEY (`user_id`,`action_id`);

--
-- Indexes for table `user_role_map`
--
ALTER TABLE `user_role_map`
  ADD PRIMARY KEY (`user_id`,`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `action`
--
ALTER TABLE `action`
  MODIFY `action_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `fit`
--
ALTER TABLE `fit`
  MODIFY `fit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `note`
--
ALTER TABLE `note`
  MODIFY `note_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `todo`
--
ALTER TABLE `todo`
  MODIFY `todo_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
