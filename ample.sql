-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 14, 2025 at 08:11 PM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ample`
--

-- --------------------------------------------------------

--
-- Table structure for table `catagory`
--

DROP TABLE IF EXISTS `catagory`;
CREATE TABLE IF NOT EXISTS `catagory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `created_by` int(2) DEFAULT NULL,
  `update_at` date DEFAULT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `catagory`
--

INSERT INTO `catagory` (`id`, `name`, `description`, `created_by`, `update_at`, `create_at`) VALUES
(1, 'Red Gnuts', 'These are red Gnuts', 1, NULL, '2025-05-18 15:27:28'),
(2, 'White Gnuts', 'These are white gnuts', 1, NULL, '2025-05-18 15:27:56'),
(3, 'Kaiso', '', 1, NULL, '2025-05-18 15:28:07');

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

DROP TABLE IF EXISTS `expense`;
CREATE TABLE IF NOT EXISTS `expense` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ex_date` date NOT NULL,
  `expense_for` varchar(50) NOT NULL,
  `amount` float(15,2) NOT NULL DEFAULT '0.00',
  `expense_cat` int(10) NOT NULL,
  `ex_description` text NOT NULL,
  `added_by` int(4) DEFAULT NULL,
  `added_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `expense`
--

INSERT INTO `expense` (`id`, `ex_date`, `expense_for`, `amount`, `expense_cat`, `ex_description`, `added_by`, `added_date`) VALUES
(1, '2025-05-15', 'KCCA Licence', 350000.00, 1, 'KCCA Licence payment', 1, '2025-05-18 21:40:18');

-- --------------------------------------------------------

--
-- Table structure for table `expense_catagory`
--

DROP TABLE IF EXISTS `expense_catagory`;
CREATE TABLE IF NOT EXISTS `expense_catagory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `added_by` int(4) NOT NULL,
  `added_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `factory_products`
--

DROP TABLE IF EXISTS `factory_products`;
CREATE TABLE IF NOT EXISTS `factory_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) NOT NULL,
  `product_id` varchar(50) NOT NULL,
  `brand_name` varchar(50) NOT NULL,
  `catagory_id` int(11) NOT NULL,
  `catagory_name` varchar(100) NOT NULL,
  `sku` varchar(50) NOT NULL,
  `quantity` int(10) NOT NULL,
  `alert_quantity` int(4) NOT NULL,
  `product_expense` float(15,2) NOT NULL DEFAULT '0.00',
  `sell_price` float(15,2) NOT NULL DEFAULT '0.00',
  `added_by` int(4) NOT NULL,
  `last_update_at` date NOT NULL,
  `added_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

DROP TABLE IF EXISTS `invoice`;
CREATE TABLE IF NOT EXISTS `invoice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_number` varchar(100) DEFAULT NULL,
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(50) DEFAULT NULL,
  `order_date` date DEFAULT NULL,
  `sub_total` float(15,2) NOT NULL DEFAULT '0.00',
  `discount` float(15,2) NOT NULL DEFAULT '0.00',
  `pre_cus_due` float(15,2) NOT NULL DEFAULT '0.00',
  `net_total` float(15,2) NOT NULL DEFAULT '0.00',
  `paid_amount` float(15,2) NOT NULL DEFAULT '0.00',
  `due_amount` float(15,2) NOT NULL DEFAULT '0.00',
  `payment_type` varchar(20) NOT NULL,
  `return_status` varchar(30) NOT NULL DEFAULT 'no',
  `last_update` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_details`
--

DROP TABLE IF EXISTS `invoice_details`;
CREATE TABLE IF NOT EXISTS `invoice_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_no` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `price` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `invoice_no` (`invoice_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

DROP TABLE IF EXISTS `member`;
CREATE TABLE IF NOT EXISTS `member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` varchar(50) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `con_num` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `total_buy` float(15,2) NOT NULL DEFAULT '0.00',
  `total_paid` float(15,2) NOT NULL DEFAULT '0.00',
  `total_due` float(15,2) NOT NULL DEFAULT '0.00',
  `reg_date` date NOT NULL,
  `update_by` int(8) DEFAULT NULL,
  `update_at` date DEFAULT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `member_id` (`member_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `paymethode`
--

DROP TABLE IF EXISTS `paymethode`;
CREATE TABLE IF NOT EXISTS `paymethode` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `added_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `paymethode`
--

INSERT INTO `paymethode` (`id`, `name`, `added_by`, `added_time`) VALUES
(1, 'Cash', NULL, '2025-05-18 15:48:51'),
(2, 'Mobile Money', NULL, '2025-05-18 15:48:51'),
(3, 'Bank Transfer', NULL, '2025-05-22 22:47:57');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) NOT NULL,
  `product_id` varchar(50) DEFAULT NULL,
  `brand_name` varchar(255) DEFAULT NULL,
  `catagory_id` int(10) NOT NULL,
  `catagory_name` varchar(100) DEFAULT NULL,
  `product_source` varchar(20) DEFAULT NULL,
  `sku` varchar(50) DEFAULT NULL,
  `quantity` int(10) DEFAULT '0',
  `alert_quanttity` int(3) DEFAULT NULL,
  `buy_price` varchar(10) DEFAULT NULL,
  `sell_price` varchar(10) DEFAULT NULL,
  `added_by` int(4) DEFAULT NULL,
  `last_update_at` date DEFAULT NULL,
  `added_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_payment`
--

DROP TABLE IF EXISTS `purchase_payment`;
CREATE TABLE IF NOT EXISTS `purchase_payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `suppliar_id` int(11) DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `payment_amount` float(15,2) NOT NULL DEFAULT '0.00',
  `payment_type` varchar(20) DEFAULT NULL,
  `pay_description` text NOT NULL,
  `added_by` int(4) DEFAULT NULL,
  `last_update` date DEFAULT NULL,
  `added_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_products`
--

DROP TABLE IF EXISTS `purchase_products`;
CREATE TABLE IF NOT EXISTS `purchase_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `product_name` varchar(100) DEFAULT NULL,
  `purchase_date` date DEFAULT NULL,
  `purchase_suppliar` int(11) DEFAULT NULL,
  `suppliar_name` varchar(255) DEFAULT NULL,
  `prev_quantity` int(11) DEFAULT NULL,
  `purchase_quantity` int(11) DEFAULT NULL,
  `purchase_price` float(15,2) DEFAULT '0.00',
  `purchase_sell_price` float(15,2) DEFAULT '0.00',
  `purchase_subtotal` float(15,2) DEFAULT '0.00',
  `prev_total_due` float(15,2) DEFAULT '0.00',
  `purchase_net_total` float(15,2) DEFAULT '0.00',
  `purchase_paid_bill` float(15,2) DEFAULT '0.00',
  `purchase_due_bill` float(15,2) DEFAULT '0.00',
  `purchase_pamyent_by` varchar(20) DEFAULT NULL,
  `return_status` varchar(50) NOT NULL DEFAULT 'no',
  `added_by` int(4) DEFAULT NULL,
  `added_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_return`
--

DROP TABLE IF EXISTS `purchase_return`;
CREATE TABLE IF NOT EXISTS `purchase_return` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sell_id` int(11) DEFAULT NULL,
  `suppliar_id` int(11) DEFAULT NULL,
  `suppliar_name` varchar(50) NOT NULL,
  `return_date` date NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(200) NOT NULL,
  `return_quantity` int(11) NOT NULL,
  `subtotal` float(15,2) NOT NULL DEFAULT '0.00',
  `discount` float(15,2) NOT NULL DEFAULT '0.00',
  `netTotal` float(15,2) NOT NULL DEFAULT '0.00',
  `create_by` int(4) NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sell_payment`
--

DROP TABLE IF EXISTS `sell_payment`;
CREATE TABLE IF NOT EXISTS `sell_payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
  `payment_date` date NOT NULL,
  `payment_amount` float(15,2) NOT NULL DEFAULT '0.00',
  `payment_type` varchar(20) NOT NULL,
  `pay_description` text NOT NULL,
  `added_by` int(4) NOT NULL,
  `last_update` date DEFAULT NULL,
  `added_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sell_return`
--

DROP TABLE IF EXISTS `sell_return`;
CREATE TABLE IF NOT EXISTS `sell_return` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `invoice_id` int(11) DEFAULT NULL,
  `return_date` date DEFAULT NULL,
  `amount` float(15,2) NOT NULL DEFAULT '0.00',
  `added_by` int(11) DEFAULT NULL,
  `added_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

DROP TABLE IF EXISTS `staff`;
CREATE TABLE IF NOT EXISTS `staff` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `designation` varchar(50) DEFAULT NULL,
  `con_no` varchar(15) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `address` text,
  `added_by` int(4) DEFAULT NULL,
  `added_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `suppliar`
--

DROP TABLE IF EXISTS `suppliar`;
CREATE TABLE IF NOT EXISTS `suppliar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `suppliar_id` varchar(50) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `address` text,
  `con_num` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `total_buy` float(15,2) NOT NULL DEFAULT '0.00',
  `total_paid` float(15,2) NOT NULL DEFAULT '0.00',
  `total_due` float(15,2) NOT NULL DEFAULT '0.00',
  `reg_date` date DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL,
  `update_at` date DEFAULT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `user_role` varchar(10) DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL,
  `last_update_at` int(11) DEFAULT NULL,
  `added_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `user_role`, `update_by`, `last_update_at`, `added_date`) VALUES
(1, 'admin@c4bgeneralstores.com', '21232f297a57a5a743894a0e4a801fc3', 'admin', 1, 0, '2023-08-24 18:00:00');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
