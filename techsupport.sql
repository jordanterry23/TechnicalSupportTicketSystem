-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 07, 2023 at 08:41 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `techsupport`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `show_all_tickets` ()   SELECT 
	t.ticket_id,
    s.status as "Status",
    t.timestamp as "Time Stamp",
    u.first_name as "First Name",
    u.last_name as "Last Name",
    u.email as "Email",
    u.phone_number as "Phone Number",
    d.device_type as "Device Type",
    t.description as "Problem Description"
FROM `tickets` as `t`

INNER JOIN `users` as u
on t.user_id = u.user_id

INNER JOIN `devicetypes` as d
on d.device_type_id = t.device_type_id

INNER JOIN `status` as s
on s.status_id = t.status_id

INNER JOIN `techteams` as techs
on techs.tech_id = t.tech_id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `show_tech_tickets` (IN `techID` INT)   SELECT 
	t.ticket_id,
    s.status as "Status",
    t.timestamp as "Time Stamp",
    u.first_name as "First Name",
    u.last_name as "Last Name",
    u.email as "Email",
    u.phone_number as "Phone Number",
    d.device_type as "Device Type",
    t.description as "Problem Description"
FROM `tickets` as `t`

INNER JOIN `users` as u
on t.user_id = u.user_id

INNER JOIN `devicetypes` as d
on d.device_type_id = t.device_type_id

INNER JOIN `status` as s
on s.status_id = t.status_id

INNER JOIN `techteams` as techs
on techs.tech_id = t.tech_id
WHERE t.tech_id = techID$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `devicetypes`
--

CREATE TABLE `devicetypes` (
  `device_type_id` int(11) NOT NULL,
  `device_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `devicetypes`
--

INSERT INTO `devicetypes` (`device_type_id`, `device_type`) VALUES
(1, 'Windows Laptop'),
(2, 'Windows PC'),
(3, 'Macbook'),
(4, 'Mac'),
(5, 'Linux Laptop'),
(6, 'Linux PC'),
(7, 'Apple iPhone');

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `note_id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `note` varchar(500) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `author_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `status_id` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `description` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`status_id`, `status`, `description`) VALUES
(1, 'Open', 'Ticket is open and currently being processed.'),
(2, 'Waiting on response', 'Technician has responded and is requiring a response from you.'),
(3, 'Escalated', 'This ticket has been escalated to a manager.'),
(4, 'Closed', 'This ticket has been closed because the problem has been solved, or a replacement has been received.');

-- --------------------------------------------------------

--
-- Table structure for table `techteams`
--

CREATE TABLE `techteams` (
  `tech_id` int(11) NOT NULL,
  `manager_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `techteams`
--

INSERT INTO `techteams` (`tech_id`, `manager_id`) VALUES
(2, 1),
(18, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `ticket_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL,
  `device_type_id` int(11) NOT NULL,
  `description` varchar(500) NOT NULL,
  `tech_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`ticket_id`, `timestamp`, `user_id`, `device_type_id`, `description`, `tech_id`, `status_id`) VALUES
(1, '2023-03-31 16:49:03', 5, 1, 'It\'s broken.', 1, 1),
(2, '2023-03-31 17:22:12', 5, 4, 'Mouse no longer works.', 2, 2),
(3, '2023-03-31 17:22:22', 5, 6, 'Wont start', 1, 1),
(4, '2023-03-31 20:13:07', 4, 2, 'Freezes every time I open any Word documents.\r\n\r\nNeed to update to newer version of Office.', 2, 3),
(5, '2023-03-31 20:20:35', 6, 1, 'My HDD is full and I need a bigger one, please.\r\nFixed.', 2, 4),
(6, '2023-04-01 06:31:58', 5, 6, 'locked up', 0, 1),
(7, '2023-04-24 16:04:10', 1, 2, 'testing', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `user_type` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `password`, `phone_number`, `user_type`) VALUES
(1, 'John', 'Smith', 'jsmith@techsupport.com', 'testing', '7890123456', 1),
(2, 'Jason', 'Bourne', 'jbourne@techsupport.com', 'testing', '4567891230', 2),
(3, 'J. Quincy', 'Magoo', 'jmagoo@magoo.com', 'helpmeoutplz', '9876543210', 3),
(4, 'Oscar', 'Wilde', 'owilde@school.com', 'newguy', '1234567890', 4),
(5, 'Clark', 'Kent', 'clark@dailyplanet.com', 'loislane', '', 4),
(6, 'Candace', 'Speers Terry', 'sperry@test.com', 'clyde', '', 3),
(7, 'Jordan', 'Terry', 'jordan@test.com', 'testing', '', 4),
(8, 'Pax', 'East', 'peast@pax.com', 'testing', '', 4),
(16, 'Bruce', 'Wayne', 'bwayne@wayne.com', 'batman', '1234567890', 3),
(18, 'Gordan', 'Freeman', 'gfreeman@techsupport.com', 'testing', '1234567890', 2),
(20, 'Clark', 'Kent', 'ckent@dailyplanet.com', 'testing', '1234567890', 3);

--
-- Triggers `users`
--
DELIMITER $$
CREATE TRIGGER `add_to_tech_teams` AFTER INSERT ON `users` FOR EACH ROW IF(NEW.user_type = 2)
THEN
	INSERT INTO techteams (tech_id, manager_id) 
    VALUES (NEW.user_id, 1);
END IF
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `usertypes`
--

CREATE TABLE `usertypes` (
  `user_type_id` int(11) NOT NULL,
  `user_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usertypes`
--

INSERT INTO `usertypes` (`user_type_id`, `user_type`) VALUES
(3, 'faculty'),
(1, 'manager'),
(4, 'student'),
(2, 'technician');

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_technicians`
-- (See below for the actual view)
--
CREATE TABLE `view_technicians` (
`tech_id` int(11)
,`first_name` varchar(50)
,`last_name` varchar(50)
,`email` varchar(50)
,`password` varchar(50)
,`phone_number` varchar(15)
,`manager_id` int(11)
,`manager_first_name` varchar(50)
,`manager_last_name` varchar(50)
,`manager_email` varchar(50)
,`manager_phone` varchar(15)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_users`
-- (See below for the actual view)
--
CREATE TABLE `view_users` (
`user_id` int(11)
,`first_name` varchar(50)
,`last_name` varchar(50)
,`email` varchar(50)
,`password` varchar(50)
,`phone_number` varchar(15)
,`user_type` varchar(50)
);

-- --------------------------------------------------------

--
-- Structure for view `view_technicians`
--
DROP TABLE IF EXISTS `view_technicians`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_technicians`  AS SELECT `tech`.`user_id` AS `tech_id`, `tech`.`first_name` AS `first_name`, `tech`.`last_name` AS `last_name`, `tech`.`email` AS `email`, `tech`.`password` AS `password`, `tech`.`phone_number` AS `phone_number`, `manager`.`user_id` AS `manager_id`, `manager`.`first_name` AS `manager_first_name`, `manager`.`last_name` AS `manager_last_name`, `manager`.`email` AS `manager_email`, `manager`.`phone_number` AS `manager_phone` FROM ((`users` `tech` join `techteams` `team` on(`tech`.`user_id` = `team`.`tech_id`)) join `users` `manager` on(`manager`.`user_id` = `team`.`manager_id`))  ;

-- --------------------------------------------------------

--
-- Structure for view `view_users`
--
DROP TABLE IF EXISTS `view_users`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_users`  AS SELECT `u`.`user_id` AS `user_id`, `u`.`first_name` AS `first_name`, `u`.`last_name` AS `last_name`, `u`.`email` AS `email`, `u`.`password` AS `password`, `u`.`phone_number` AS `phone_number`, `type`.`user_type` AS `user_type` FROM (`users` `u` join `usertypes` `type` on(`type`.`user_type_id` = `u`.`user_type`))  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `devicetypes`
--
ALTER TABLE `devicetypes`
  ADD PRIMARY KEY (`device_type_id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`note_id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`ticket_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `FK_user_type_constraint` (`user_type`);

--
-- Indexes for table `usertypes`
--
ALTER TABLE `usertypes`
  ADD PRIMARY KEY (`user_type_id`),
  ADD UNIQUE KEY `user_type` (`user_type`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `devicetypes`
--
ALTER TABLE `devicetypes`
  MODIFY `device_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `note_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `usertypes`
--
ALTER TABLE `usertypes`
  MODIFY `user_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_user_type_constraint` FOREIGN KEY (`user_type`) REFERENCES `usertypes` (`user_type_id`) ON DELETE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
