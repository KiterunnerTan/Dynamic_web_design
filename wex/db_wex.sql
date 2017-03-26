-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2017 at 04:03 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.5.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;


--
-- Database: `db_wex`
--

-- --------------------------------------------------------

--
-- Table structure for table `db_category`
--

CREATE TABLE `db_category` (
  `id` int(11) NOT NULL COMMENT 'Category ID',
  `name` varchar(255) NOT NULL COMMENT 'Category name',
  `description` text NOT NULL COMMENT 'Category description',
  `image` varchar(255) NOT NULL COMMENT 'Default image'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Table for item category';

--
-- Dumping data for table `db_category`
--

INSERT INTO `db_category` (`id`, `name`, `description`, `image`) VALUES
(1, 'Home & Garden', 'Home and Garden', 'homegarden.jpg'),
(2, 'Sports, Leisure, & Travel', 'Sports, leisure, and travel', 'sportstravel.jpg'),
(3, 'Phones, Tablet, Telecom', 'Phones, mobile phones, tablet, telecom', 'pnonestablet.jpg'),
(4, 'Video Games & Consoles', 'Video games and consoles', 'gamesconsole.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `db_category_subcategory`
--

CREATE TABLE `db_category_subcategory` (
  `id` int(11) NOT NULL COMMENT 'Subcategory ID',
  `category_id` int(11) NOT NULL COMMENT 'Category ID',
  `name` varchar(255) NOT NULL COMMENT 'Subcategory name',
  `description` text NOT NULL COMMENT 'SUbcategory description',
  `image` varchar(255) NOT NULL COMMENT 'Default image'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Table for item subcategory';

--
-- Dumping data for table `db_category_subcategory`
--

INSERT INTO `db_category_subcategory` (`id`, `category_id`, `name`, `description`, `image`) VALUES
(1, 1, 'Kitchen', 'Kitchen', 'kitchen.jpg'),
(2, 2, 'Bikes', 'Bikes', 'bikes.jpg'),
(3, 2, 'Outdoors', 'Outdoors', 'outdoor.jpg'),
(4, 3, 'Tablets', 'Tablets', 'tablet.jpg'),
(5, 4, 'Xbox', 'Xbox', 'xbox.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `db_items_offers`
--

CREATE TABLE `db_items_offers` (
  `id` int(11) NOT NULL COMMENT 'Item ID',
  `name` varchar(100) NOT NULL COMMENT 'Item name',
  `category` int(11) NOT NULL COMMENT 'Item category ID',
  `subcategory` int(11) DEFAULT NULL COMMENT 'Item subcategory ID',
  `price` float NOT NULL COMMENT 'Item price',
  `description` text COMMENT 'Item description',
  `owner` int(11) NOT NULL COMMENT 'Owner ID',
  `views` int(11) NOT NULL COMMENT 'Total Views',
  `active` tinyint(4) NOT NULL COMMENT '1 to show, 0 to not show',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Last Update'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Store the items offered';

--
-- Dumping data for table `db_items_offers`
--

INSERT INTO `db_items_offers` (`id`, `name`, `category`, `subcategory`, `price`, `description`, `owner`, `views`, `active`, `timestamp`) VALUES
(1, 'Big Pan', 1, 1, 10, 'This is a big pan.', 1, 0, 1, '2017-02-26 22:53:56'),
(2, 'Bike', 2, 2, 100, 'New Bike', 1, 0, 1, '2017-02-26 22:47:56'),
(3, 'Tent', 2, 3, 50, 'Tent', 1, 0, 1, '2017-02-26 22:36:56'),
(4, 'iPad', 3, 4, 80, 'iPad', 1, 0, 1, '2017-02-26 22:59:57'),
(5, 'Xbox 360 Slim 250GB 2 Controllers', 4, 5, 40, 'Xbox', 1, 0, 1, '2017-02-26 22:53:57');

-- --------------------------------------------------------

--
-- Table structure for table `db_items_offers_comments`
--

CREATE TABLE `db_items_offers_comments` (
  `id` int(11) NOT NULL COMMENT 'Comment ID',
  `items_offers_id` int(11) NOT NULL COMMENT 'Item ID',
  `rating` char(1) NOT NULL COMMENT 'Item rating',
  `comments` text NOT NULL COMMENT 'Comment'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `db_items_offers_images`
--

CREATE TABLE `db_items_offers_images` (
  `id` int(11) NOT NULL COMMENT 'Image ID',
  `items_offers_id` int(11) NOT NULL COMMENT 'Item ID',
  `image` varchar(200) NOT NULL COMMENT 'Image name',
  `isdefault` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Default image or not'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `db_items_offers_images`
--

INSERT INTO `db_items_offers_images` (`id`, `items_offers_id`, `image`, `isdefault`) VALUES
(1, 1, 'pan.jpg', 1),
(2, 1, 'test2.jpg', 0),
(3, 2, 'bike.jpg', 1),
(4, 3, 'tent.jpg', 1),
(5, 4, 'ipad.jpg', 1),
(6, 5, 'xbox.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `db_items_requests`
--

CREATE TABLE `db_items_requests` (
  `id` int(11) NOT NULL COMMENT 'Item ID',
  `name` varchar(100) NOT NULL COMMENT 'Item name',
  `category` int(11) NOT NULL COMMENT 'Item category ID',
  `subcategory` int(11) DEFAULT NULL COMMENT 'Item subcategory ID',
  `description` text COMMENT 'Item description',
  `start_date` date DEFAULT NULL COMMENT 'Request start date',
  `end_date` date DEFAULT NULL COMMENT 'Request end date',
  `owner` int(11) NOT NULL COMMENT 'Owner ID',
  `views` int(11) NOT NULL COMMENT 'Total Views',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Last Update'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Store the items requested';

--
-- Dumping data for table `db_items_requests`
--

INSERT INTO `db_items_requests` (`id`, `name`, `category`, `subcategory`, `description`, `start_date`, `end_date`, `owner`, `views`, `timestamp`) VALUES
(1, 'XBOX', 4, 5, 'I need a Xbox', NULL, NULL, 2, 0, '2017-02-20 01:38:57'),
(2, 'House', 1, NULL, 'Need house for 1 week', NULL, NULL, 2, 0, '2017-02-20 01:34:06'),
(3, 'Laptop', 3, 4, 'I need laptop to use in a conference for 2 days. If you can help me, please contact me. Thank you', '2017-03-02', '2017-03-04', 2, 0, '2017-03-02 19:25:59'),
(9, 'Phone', 3, 0, 'Need Phone for 3 days', '2017-03-01', '2017-03-04', 2, 0, '2017-03-03 00:27:14'),
(10, 'Television', 1, 1, 'I Need TV', '2017-03-03', '2017-03-05', 2, 0, '2017-03-03 11:23:32'),
(11, 'Mouse', 3, 0, 'I need mouse', '2017-03-01', '2017-03-04', 2, 0, '2017-03-03 12:16:15');

-- --------------------------------------------------------

--
-- Table structure for table `db_points_convert`
--

CREATE TABLE `db_points_convert` (
  `id` int(11) NOT NULL COMMENT 'Points converter ID',
  `type` char(1) NOT NULL COMMENT 'Transaction type (o for Offer, r for Request, d for Default)',
  `rating` char(1) NOT NULL COMMENT 'Reputation (Positive, Neutral, Negative)',
  `multiplier` float NOT NULL COMMENT 'Multiplier'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Table for points converter';

--
-- Dumping data for table `db_points_convert`
--

INSERT INTO `db_points_convert` (`id`, `type`, `rating`, `multiplier`) VALUES
(1, 'o', '+', 0.01),
(2, 'o', '0', 0),
(3, 'o', '-', 1),
(4, 'r', '+', 0.1),
(5, 'r', '0', 0.03),
(6, 'r', '-', 0),
(7, 'd', '0', 100);

-- --------------------------------------------------------

--
-- Table structure for table `db_transactions`
--

CREATE TABLE `db_transactions` (
  `id` int(11) NOT NULL,
  `items_offers_id` int(11) NOT NULL,
  `borrower_id` int(11) NOT NULL,
  `lender_rating` tinyint(4) DEFAULT NULL,
  `lender_points` int(11) DEFAULT NULL,
  `borrower_rating` tinyint(4) DEFAULT NULL,
  `borrower_points` int(11) DEFAULT NULL,
  `transaction_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Table for transactions';

-- --------------------------------------------------------

--
-- Table structure for table `db_user`
--

CREATE TABLE `db_user` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `addr1` varchar(255) DEFAULT NULL,
  `addr2` varchar(255) DEFAULT NULL,
  `addr3` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `postcode` varchar(10) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Table for users';

--
-- Dumping data for table `db_user`
--

INSERT INTO `db_user` (`id`, `email`, `password`, `name`, `addr1`, `addr2`, `addr3`, `phone`, `city`, `postcode`, `image`) VALUES
(1, 'admin@admin.com', '$2y$10$tWhRszRpegNcBCQfm5pIF.sotrSqO/5HtTIS0mqwITBp3E6vIiItO', 'Administrator', '32/7 Blackwood Crescent', '', '', '07570000000', 'Edinburgh', 'EH9 1QX', 'uploads\\4a0e6c0a163b333a5ddb358a3617344e.jpg'),
(2, 'admin1@admin.com', '$2a$07$pcBbb7cr9SKxBgPyjo77E.Qdsvz8.d.44RBmhsXPpJiv/xFn3TeHu', 'Administrator  A', '32', '', '', '', 'Edinburgh', 'EH9 1QX', 'uploads\\abc0ed5dab921f30909f231189005a47.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `db_category`
--
ALTER TABLE `db_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `db_category_subcategory`
--
ALTER TABLE `db_category_subcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `db_items_offers`
--
ALTER TABLE `db_items_offers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `db_items_offers_comments`
--
ALTER TABLE `db_items_offers_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `db_items_offers_images`
--
ALTER TABLE `db_items_offers_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `db_items_requests`
--
ALTER TABLE `db_items_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `db_points_convert`
--
ALTER TABLE `db_points_convert`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `db_transactions`
--
ALTER TABLE `db_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `db_user`
--
ALTER TABLE `db_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `db_category`
--
ALTER TABLE `db_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Category ID', AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `db_category_subcategory`
--
ALTER TABLE `db_category_subcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Subcategory ID', AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `db_items_offers`
--
ALTER TABLE `db_items_offers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Item ID', AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `db_items_offers_comments`
--
ALTER TABLE `db_items_offers_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Comment ID';
--
-- AUTO_INCREMENT for table `db_items_offers_images`
--
ALTER TABLE `db_items_offers_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Image ID', AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `db_items_requests`
--
ALTER TABLE `db_items_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Item ID', AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `db_points_convert`
--
ALTER TABLE `db_points_convert`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Points converter ID', AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `db_transactions`
--
ALTER TABLE `db_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `db_user`
--
ALTER TABLE `db_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
