-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 28, 2022 at 06:53 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eaglenetra`
--

-- --------------------------------------------------------

--
-- Table structure for table `emergency_numbers`
--

CREATE TABLE `emergency_numbers` (
  `id` int(255) NOT NULL,
  `uid` varchar(255) NOT NULL,
  `smart_card_id` varchar(255) NOT NULL,
  `emergency_contact` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `emergency_numbers`
--

INSERT INTO `emergency_numbers` (`id`, `uid`, `smart_card_id`, `emergency_contact`, `created_at`, `modified_at`) VALUES
(1, 'EMERGENCY_NUM_26181e4df25bdc53d669b07f9ab29372_1672137359', 'SMARTCARD_26b932f91f19b9bb5f82d9630b0febc2_1672137359', '7812345678', '2022-12-27 16:05:59', '2022-12-27 16:05:59'),
(2, 'EMERGENCY_NUM_0b55c133745744e4c0c98a4228ba6db3_1672137359', 'SMARTCARD_26b932f91f19b9bb5f82d9630b0febc2_1672137359', '9681391540', '2022-12-27 16:05:59', '2022-12-27 16:05:59'),
(3, 'EMERGENCY_NUM_4e8081a2cca9630aa64394a6e312109f_1672137359', 'SMARTCARD_26b932f91f19b9bb5f82d9630b0febc2_1672137359', '7812345678', '2022-12-27 16:05:59', '2022-12-27 16:05:59');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `id` int(255) NOT NULL,
  `uid` varchar(255) NOT NULL,
  `smart_card_id` varchar(255) NOT NULL,
  `tag` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `created_on` datetime NOT NULL,
  `modified_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `uid`, `smart_card_id`, `tag`, `longitude`, `latitude`, `created_on`, `modified_at`) VALUES
(1, 'LOCATION_bb4889e96c53546d87fc2420cf78c8e9_1672137534', 'SMARTCARD_26b932f91f19b9bb5f82d9630b0febc2_1672137359', NULL, '19.560591017950745', '61.53711434642541', '2022-12-27 16:08:54', '2022-12-27 16:08:54'),
(2, 'LOCATION_12a04868529a9401a758c220280b084e_1672137556', 'SMARTCARD_26b932f91f19b9bb5f82d9630b0febc2_1672137359', NULL, '34.560591017', '91.537112345', '2022-12-27 16:09:16', '2022-12-27 16:09:16'),
(3, 'LOCATION_0c54899796bf0fb0ea3da3fa8345b48c_1672137627', 'SMARTCARD_26b932f91f19b9bb5f82d9630b0febc2_1672137359', NULL, '55.560591017', '67.537112345', '2022-12-27 16:10:27', '2022-12-27 16:10:27'),
(4, 'LOCATION_fe5ae5148c0db424a8cd81b979cb31cd_1672137646', 'SMARTCARD_26b932f91f19b9bb5f82d9630b0febc2_1672137359', NULL, '20.560591017', '30.537112345', '2022-12-27 16:10:46', '2022-12-27 16:10:46'),
(5, 'LOCATION_5fd85f83e06d243c9cc23ec799f41a57_1672137651', 'SMARTCARD_26b932f91f19b9bb5f82d9630b0febc2_1672137359', NULL, '20.560591017', '30.537112345', '2022-12-27 16:10:51', '2022-12-27 16:10:51');

-- --------------------------------------------------------

--
-- Table structure for table `otp`
--

CREATE TABLE `otp` (
  `id` int(255) NOT NULL,
  `uid` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `otp` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `otp`
--

INSERT INTO `otp` (`id`, `uid`, `user_id`, `otp`, `created_at`, `modified_at`) VALUES
(1, 'OTP_13985e53e6e6d5112c38a280f0561e9c_1672137283', 'USER_05060f79f3c5be9b24cc5a7fd4f8a504_1672137283', '9069', '2022-12-27 16:04:43', '2022-12-27 16:04:43'),
(2, 'OTP_16991e100e30fc8dadf2a862aab3216b_1672137688', 'USER_18e6a6bf5aa912269439db748f073e05_1672137688', '9597', '2022-12-27 16:11:28', '2022-12-27 16:11:28');

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` int(11) NOT NULL,
  `uid` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `validity` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `uid`, `price`, `validity`, `created_at`, `updated_at`) VALUES
(1, 'PACKAGE_7bb087b5f0f8d2c5a65113742815329c_1672137750', '399', '84 days', '2022-12-27 16:12:30', '2022-12-27 16:12:30'),
(2, 'PACKAGE_7797f20efb12c237afdfe37dc4305ec3_1672137770', '799', '180 days', '2022-12-27 16:12:50', '2022-12-27 16:12:50');

-- --------------------------------------------------------

--
-- Table structure for table `safe_area`
--

CREATE TABLE `safe_area` (
  `id` int(255) NOT NULL,
  `uid` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `safe_area_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `Latitude` varchar(255) NOT NULL,
  `alert_on_exit` tinyint(1) NOT NULL,
  `alert_on_entry` tinyint(1) NOT NULL,
  `safe_area_radius` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `safe_area`
--

INSERT INTO `safe_area` (`id`, `uid`, `user_id`, `safe_area_name`, `address`, `longitude`, `Latitude`, `alert_on_exit`, `alert_on_entry`, `safe_area_radius`, `status`, `created_at`, `updated_at`) VALUES
(1, 'SAFEAREA_8f086e2d16773db28c8ebce59213e38f_1672137420', 'USER_05060f79f3c5be9b24cc5a7fd4f8a504_1672137283', 'school', 'kolkata,', '345.453453', '432.2314123', 1, 1, '300', 'active', '2022-12-27 10:37:00', '2022-12-27 10:37:00');

-- --------------------------------------------------------

--
-- Table structure for table `smart_card`
--

CREATE TABLE `smart_card` (
  `id` int(255) NOT NULL,
  `uid` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `device_id` varchar(255) NOT NULL,
  `card_number` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `age` varchar(255) NOT NULL,
  `profile_image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `smart_card`
--

INSERT INTO `smart_card` (`id`, `uid`, `user_id`, `name`, `device_id`, `card_number`, `class`, `age`, `profile_image`, `created_at`, `modified_at`) VALUES
(1, 'SMARTCARD_26b932f91f19b9bb5f82d9630b0febc2_1672137359', 'USER_05060f79f3c5be9b24cc5a7fd4f8a504_1672137283', 'Sk Rohan', '12345', '9681391540', '6', '10', 'assets/5848d7f8925e724e947b7b5e2acbb4a0.png', '2022-12-27 10:35:59', '2022-12-27 10:35:59');

-- --------------------------------------------------------

--
-- Table structure for table `splash_screen`
--

CREATE TABLE `splash_screen` (
  `id` int(255) NOT NULL,
  `uid` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `heading` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `updated_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `splash_screen`
--

INSERT INTO `splash_screen` (`id`, `uid`, `image`, `heading`, `description`, `status`, `created_at`, `modified_at`, `created_by`, `updated_by`) VALUES
(1, '467323', 'images/aqua.jpg', 'Smart id card', 'lorem ipsam dolar isat joreel kolmfn ', 'active', '2022-12-14 13:47:28', '2022-12-14 13:47:28', 'user', 'user'),
(2, '029335', 'images/mountain.jpg', 'Route Tracking', 'lorem ipsam dolar isat joreel kolmfn ', 'active', '2022-12-14 13:47:28', '2022-12-14 13:47:28', 'user', 'user'),
(3, '234567', 'images/pond.jpg', 'Geo fencing', 'lorem ipsam dolar isat joreel kolmfn ', 'active', '2022-12-14 13:47:28', '2022-12-14 13:47:28', 'user', 'user'),
(4, '345678', 'images/pond.jpg', 'Geo fencing', 'lorem ipsam dolar isat joreel kolmfn ', 'deactive', '2022-12-14 13:47:28', '2022-12-14 13:47:28', 'user', 'user'),
(5, '456234', 'images/pond.jpg', 'Geo fencing', 'lorem ipsam dolar isat joreel kolmfn ', 'deactive', '2022-12-14 13:47:28', '2022-12-14 13:47:28', 'user', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` int(255) NOT NULL,
  `uid` varchar(255) NOT NULL,
  `smart_card_id` varchar(255) NOT NULL,
  `package_id` varchar(255) NOT NULL,
  `expiry_date` datetime NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `uid`, `smart_card_id`, `package_id`, `expiry_date`, `status`, `created_at`, `modified_at`) VALUES
(2, 'SUBSCRIPTION_359ec74e28cba4e6075db6aa583075df_1672138019', 'SMARTCARD_26b932f91f19b9bb5f82d9630b0febc2_1672137359', 'PACKAGE_7bb087b5f0f8d2c5a65113742815329c_1672137750', '2023-03-21 16:16:59', 'active', '2022-12-27 16:16:59', '2022-12-27 16:16:59');

-- --------------------------------------------------------

--
-- Table structure for table `tracking_for`
--

CREATE TABLE `tracking_for` (
  `id` int(255) NOT NULL,
  `uid` varchar(255) NOT NULL,
  `tracking_for` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tracking_for`
--

INSERT INTO `tracking_for` (`id`, `uid`, `tracking_for`, `created_at`, `modified_at`) VALUES
(1, '1', 'Kids', '2022-12-16 10:47:35', '2022-12-16 10:47:35'),
(2, '2', 'Employees', '2022-12-16 10:49:07', '2022-12-16 10:49:07');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(255) NOT NULL,
  `uid` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `relationship` varchar(255) NOT NULL DEFAULT 'parent',
  `tracking_for_id` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `uid`, `user_type`, `name`, `email`, `relationship`, `tracking_for_id`, `phone_number`, `image`, `created_at`, `modified_at`) VALUES
(1, 'USER_05060f79f3c5be9b24cc5a7fd4f8a504_1672137283', 'user_primary', 'sk rohan ali', 'rohan@gmail.com', 'parent', '1', '6290353314', 'assets/9324f468f096dc33845cba45f9997387.png', '2022-12-27 16:04:43', '2022-12-27 16:04:43'),
(2, 'USER_18e6a6bf5aa912269439db748f073e05_1672137688', 'user_secondary', 'rohan', '', 'uncle', '', '7890654321', '', '2022-12-27 16:11:28', '2022-12-27 16:11:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `emergency_numbers`
--
ALTER TABLE `emergency_numbers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `otp`
--
ALTER TABLE `otp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `safe_area`
--
ALTER TABLE `safe_area`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `smart_card`
--
ALTER TABLE `smart_card`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `splash_screen`
--
ALTER TABLE `splash_screen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tracking_for`
--
ALTER TABLE `tracking_for`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `emergency_numbers`
--
ALTER TABLE `emergency_numbers`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `otp`
--
ALTER TABLE `otp`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `safe_area`
--
ALTER TABLE `safe_area`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `smart_card`
--
ALTER TABLE `smart_card`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `splash_screen`
--
ALTER TABLE `splash_screen`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tracking_for`
--
ALTER TABLE `tracking_for`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
