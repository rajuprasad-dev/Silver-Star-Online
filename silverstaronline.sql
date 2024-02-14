-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 14, 2024 at 01:10 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `silverstaronline`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(100) NOT NULL,
  `unique_id` bigint(20) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date_time` varchar(200) NOT NULL,
  `last_login` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `unique_id`, `photo`, `name`, `email`, `phone`, `password`, `date_time`, `last_login`) VALUES
(1, 1585231921, '61c6884db20eb6ac70fe0246da515e03_admin_profile_pic.jpg', 'ABC', 'rktech50@gmail.com', '7021379952', '1eb0072c383aa73bd496f3ad7fa536a44c591680', '04-10-2021 10:55:46 am', NULL),
(2, 1428030901, 'ab37aca8fd879a57f95b135e620cd45f_admin_profile_pic.png', 'Incinc Media', 'incincmedia@gmail.com', '7498847799', '1eb0072c383aa73bd496f3ad7fa536a44c591680', '03-03-2023 02:30:16 pm', NULL),
(3, 1560337935, 'b6611268437604b0c3b902086453e604_admin_profile_pic.png', 'dinnis kuttikkat', 'dinnis@gmail.com', '08452825985', '10e6f7e8b281fdf5084f754b7e997a7728cb8bf7', '14-12-2023 03:40:30 pm', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `captain`
--

CREATE TABLE `captain` (
  `id` int(255) NOT NULL,
  `unique_id` bigint(20) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `name` varchar(150) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` varchar(200) NOT NULL,
  `dob` varchar(150) NOT NULL,
  `doj` varchar(150) NOT NULL,
  `aadhar` varchar(200) NOT NULL,
  `pancard` varchar(200) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(180) NOT NULL,
  `state` varchar(180) NOT NULL,
  `pincode` int(150) NOT NULL,
  `vaccination` varchar(100) NOT NULL,
  `status` int(10) NOT NULL DEFAULT 1,
  `active` int(11) NOT NULL DEFAULT 0,
  `otp` int(20) NOT NULL DEFAULT 0,
  `otp_time` varchar(200) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `captain`
--

INSERT INTO `captain` (`id`, `unique_id`, `photo`, `name`, `gender`, `email`, `phone`, `dob`, `doj`, `aadhar`, `pancard`, `address`, `city`, `state`, `pincode`, `vaccination`, `status`, `active`, `otp`, `otp_time`, `date_time`) VALUES
(1, 7021379952, '5aff0742aaa4e6e340c3bb07293b4831_profile_photo.png', 'Raju Prasad', 'Male', 'rktech50@gmail.com', '7021379952', '2021-12-02', '2021-12-02', '12345678912', 'abc123ab12', 'Sakinaka', 'Mumbai', 'Maharashtra', 400070, 'Fully Vaccinated', 1, 0, 0, '', '2021-12-02 07:28:18'),
(2, 1234567890, '', 'Saabmall Captain', 'Male', 'saabmall2021@gmail.com', '9123456789', '2021-12-13', '2021-12-13', '9892565787', 'Hello ', '', 'Mumbai', 'Maharashtra', 400072, 'Non-Vaccinated', 1, 0, 0, '1639674677', '2021-12-13 14:53:54');

-- --------------------------------------------------------

--
-- Table structure for table `captain_payments`
--

CREATE TABLE `captain_payments` (
  `id` int(255) NOT NULL,
  `captain_id` int(200) NOT NULL,
  `month` varchar(150) NOT NULL,
  `total_delivery` int(100) NOT NULL,
  `total_amount` int(200) NOT NULL,
  `payment_mode` varchar(200) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `captain_payments`
--

INSERT INTO `captain_payments` (`id`, `captain_id`, `month`, `total_delivery`, `total_amount`, `payment_mode`, `date_time`) VALUES
(1, 1, 'Dec 2021', 8, 190, 'Paid Through Online', '2021-12-05 16:46:48'),
(2, 1, 'Nov 2021', 1, 20, 'Paid Through Cheque', '2021-12-05 16:51:30');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(255) NOT NULL,
  `customer_id` int(255) NOT NULL,
  `product_id` int(255) NOT NULL,
  `quantity` int(255) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `customer_id`, `product_id`, `quantity`, `date_time`) VALUES
(3, 1, 19, 12, '2024-02-05 04:42:12'),
(4, 1, 209, 2, '2024-02-05 04:42:29'),
(5, 1, 77, 5, '2024-02-05 13:01:22');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(255) NOT NULL,
  `name` varchar(120) NOT NULL,
  `icon` varchar(200) NOT NULL,
  `color` varchar(100) NOT NULL,
  `date_time` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `icon`, `color`, `date_time`) VALUES
(17, 'Latest Beauty', '4e884fdfed88996e418d147b0580af83_category_icon.png', '#aaebff', '12-12-2021 12:25:53 pm'),
(18, 'New Collection', 'c692bc566b82a5e9e09624627bcf21da_category_icon.png', '#d6b9b9', '15-12-2021 02:22:30 pm'),
(20, 'Masalas & More', 'section-image1.png', '#ff7c7c', '15-12-2021 02:31:06 pm'),
(21, 'Biscuits', 'section-image4.png', '#ffe986', '15-12-2021 02:36:00 pm'),
(22, 'Meat', 'section-image3.png', '#6eafff', '15-12-2021 02:37:09 pm'),
(28, 'coco powder', 'fa597b532c2c067cce015036fc2d7532_category_icon.png', '#00ff80', '20-12-2023 01:25:44 pm'),
(29, 'coco powder2', '5afedfc38f4c64832780fc326625e140_category_icon.png', '#00ff80', '22-12-2023 02:22:30 pm'),
(30, 'Painting', '2a5ea9b261516273a3910ab6dad9ed84_category_icon.jpeg', '#00ff80', '22-12-2023 03:11:54 pm');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` int(255) NOT NULL,
  `coupon` varchar(200) NOT NULL,
  `discount` int(150) NOT NULL,
  `min_value` int(150) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `coupon`, `discount`, `min_value`, `date_time`) VALUES
(2, 'Aklu20off', 323, 300, '2023-11-15 15:18:14'),
(3, 'saabmall', 150, 3000, '2021-11-14 18:26:08'),
(4, 'abcd', 1000, 2000, '2023-12-20 08:37:36');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(255) NOT NULL,
  `name` varchar(200) NOT NULL,
  `phone` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(150) NOT NULL,
  `state` varchar(150) NOT NULL,
  `pincode` int(100) NOT NULL,
  `landmark` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `otp` int(20) DEFAULT NULL,
  `otp_time` varchar(200) DEFAULT NULL,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `phone`, `email`, `address`, `city`, `state`, `pincode`, `landmark`, `status`, `otp`, `otp_time`, `date_time`, `password`) VALUES
(1, 'Raju Prasad', '7021379952', 'rktech50@gmail.com', 'Sakinaka', 'Mumbai', 'Maharashtra', 400070, 'testing', 0, 1204, '1696518399', '2021-11-28 15:17:34', 'r');

-- --------------------------------------------------------

--
-- Table structure for table `deliveries`
--

CREATE TABLE `deliveries` (
  `id` int(255) NOT NULL,
  `customer_id` int(255) NOT NULL,
  `order_id` int(255) NOT NULL,
  `captain_id` int(255) NOT NULL,
  `position` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `charges` int(100) NOT NULL,
  `status` enum('Pending','Started','Cancelled','Delivered') NOT NULL DEFAULT 'Pending',
  `pickup_time` varchar(200) NOT NULL,
  `expected_delivery` varchar(100) NOT NULL,
  `delivered_time` varchar(200) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `deliveries`
--

INSERT INTO `deliveries` (`id`, `customer_id`, `order_id`, `captain_id`, `position`, `charges`, `status`, `pickup_time`, `expected_delivery`, `delivered_time`, `date_time`) VALUES
(1, 3, 1, 2, '', 55, 'Delivered', '', '', '', '2021-12-14 16:54:45'),
(2, 3, 2, 2, '', 55, 'Cancelled', '', '', '', '2021-12-14 16:54:49'),
(3, 3, 3, 2, '', 55, 'Pending', '', '', '', '2021-12-17 16:02:46'),
(4, 1, 17, 1, '', 40, 'Pending', '', '', '', '2021-12-19 20:05:49');

-- --------------------------------------------------------

--
-- Table structure for table `featured_hotdeals`
--

CREATE TABLE `featured_hotdeals` (
  `id` int(255) NOT NULL,
  `product_id` int(255) NOT NULL,
  `type` int(10) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `featured_hotdeals`
--

INSERT INTO `featured_hotdeals` (`id`, `product_id`, `type`, `date_time`) VALUES
(8, 99, 1, '2021-12-12 09:06:03'),
(9, 50, 1, '2021-12-12 09:06:03'),
(10, 98, 1, '2021-12-12 09:06:34'),
(11, 95, 2, '2021-12-12 09:07:42'),
(12, 89, 2, '2021-12-12 09:07:42'),
(13, 65, 2, '2021-12-12 09:07:42'),
(14, 64, 2, '2021-12-12 09:07:42'),
(15, 63, 2, '2021-12-12 09:07:42'),
(16, 96, 1, '2021-12-12 09:11:17'),
(17, 94, 1, '2021-12-12 09:11:17'),
(18, 93, 1, '2021-12-12 09:11:17'),
(19, 88, 1, '2021-12-12 09:11:17'),
(20, 90, 2, '2021-12-12 09:11:42'),
(21, 87, 2, '2021-12-12 09:11:42'),
(22, 74, 2, '2021-12-12 09:11:42');

-- --------------------------------------------------------

--
-- Table structure for table `ordered_products`
--

CREATE TABLE `ordered_products` (
  `id` int(100) NOT NULL,
  `customer_id` int(100) NOT NULL,
  `product_id` int(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `date_time` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ordered_products`
--

INSERT INTO `ordered_products` (`id`, `customer_id`, `product_id`, `quantity`, `date_time`) VALUES
(1, 1, 87, 1, '2021-12-20 00:44:32'),
(2, 1, 95, 1, '2021-12-20 08:20:51'),
(3, 1, 19, 1, '2023-11-06 11:20:07'),
(4, 15, 23, 1, '2023-11-06 11:20:10'),
(6, 16, 23, 1, '2023-11-06 11:40:36'),
(7, 16, 63, 1, '2023-11-06 11:40:44'),
(8, 19, 19, 1, '2023-11-15 18:42:32'),
(9, 19, 50, 1, '2023-11-15 18:46:05'),
(10, 19, 51, 1, '2023-11-15 18:47:22'),
(11, 19, 65, 1, '2023-11-15 18:51:00'),
(15, 1, 50, 1, '2023-11-18 13:37:04');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(255) NOT NULL,
  `customer_id` int(255) NOT NULL,
  `address` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `order_id` varchar(150) NOT NULL,
  `cart_amount` double NOT NULL,
  `discount_amt` double NOT NULL,
  `delivery_charges` double NOT NULL,
  `coupon_code` varchar(200) DEFAULT NULL,
  `coupon_discount` double DEFAULT NULL,
  `final_amount` double NOT NULL,
  `payment_method` enum('COD','Razorpay') NOT NULL,
  `payment_status` enum('Pending','Paid','Failed','COD') NOT NULL,
  `payment_id` varchar(255) NOT NULL,
  `order_status` enum('Pending','Placed','Packed','Shipped','Out','Delivered','Cancelled') NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `orderd_products_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `address`, `order_id`, `cart_amount`, `discount_amt`, `delivery_charges`, `coupon_code`, `coupon_discount`, `final_amount`, `payment_method`, `payment_status`, `payment_id`, `order_status`, `date_time`, `orderd_products_id`) VALUES
(1, 3, '{\"name\":\"shivam rai\",\"address\":\"Ashok Nagar Powai\\n, Mumbai, Maharashtra - 400072\",\"phone\":\"8652477976\",\"expected_delivery\":\"Delivery by Today\"}', '1639415655191', 154, 154, 55, '', 0, 209, 'Razorpay', 'Paid', 'pay_IX2PL3aHqKHGvX', 'Delivered', '2021-12-13 17:14:15', 0),
(2, 3, '{\"name\":\"shivam rai\",\"address\":\"Ashok Nagar Powai\\n, Mumbai, Maharashtra - 400072\",\"phone\":\"8652477976\",\"expected_delivery\":\"Delivery by Today\"}', '1639491610683', 69, 69, 55, '', 0, 124, 'Razorpay', 'Paid', 'pay_IXNye52g7ZB5M1', 'Cancelled', '2021-12-14 14:20:11', 0),
(3, 3, '{\"name\":\"shivam rai\",\"address\":\"Ashok Nagar Powai\\n, Mumbai, Maharashtra - 400072\",\"phone\":\"8652477976\",\"expected_delivery\":\"Delivery by Today\"}', '1639756895678', 18, 18, 55, '', 0, 73, 'Razorpay', 'Paid', 'pay_IYbJ22bcnty7kg', 'Out', '2021-12-17 16:01:36', 0),
(5, 6, '{\"name\":\"Akash\",\"address\":\"Ashok Nagar Marol Military Road, Mumbai, Maharashtra - 400072\",\"phone\":\"8898997827\",\"expected_delivery\":\"Delivery by Today\"}', '1639859610500', 52, 52, 55, '', 0, 107, 'Razorpay', 'Paid', 'pay_IZ4TNexmmGim4m', 'Placed', '2021-12-18 20:33:31', 0),
(6, 7, '{\"name\":\"Akash\",\"address\":\"Ashok Nagar Marol Military Road, Mumbai, Maharashtra - 400072\",\"phone\":\"8291651762\",\"expected_delivery\":\"Delivery by Today\"}', '1639860170339', 154, 154, 55, '', 0, 209, 'Razorpay', 'Paid', 'pay_IZ4dMdFpLmngAy', 'Placed', '2021-12-18 20:42:51', 0),
(7, 1, '{\"name\":\"Raju Prasad\",\"address\":\"Sakinaka, Mumbai, Maharashtra - 400070\",\"phone\":\"7021379952\",\"expected_delivery\":\"Delivery by Today\"}', '1639860211098', 138, 138, 40, '', 0, 178, 'Razorpay', 'Pending', '', 'Delivered', '2021-12-18 20:43:29', 0),
(8, 7, '{\"name\":\"Akash\",\"address\":\"Ashok Nagar Marol Military Road, Mumbai, Maharashtra - 400072\",\"phone\":\"8291651762\",\"expected_delivery\":\"Delivery by Today\"}', '1639861198821', 172, 172, 55, '', 0, 227, 'COD', 'COD', '', 'Cancelled', '2021-12-18 20:59:59', 0),
(9, 1, '{\"name\":\"Raju Prasad\",\"address\":\"Sakinaka, Mumbai, Maharashtra - 400070\",\"phone\":\"7021379952\",\"expected_delivery\":\"Delivery by Today\"}', '1639937039395', 674, 674, 40, '', 0, 714, 'COD', 'COD', '', 'Placed', '2021-12-19 18:03:59', 0),
(10, 1, '{\"name\":\"Raju Prasad\",\"address\":\"Sakinaka, Mumbai, Maharashtra - 400070\",\"phone\":\"7021379952\",\"expected_delivery\":\"Delivery by Today\"}', '1639937365580', 15, 15, 40, '', 0, 55, 'COD', 'COD', '', 'Placed', '2021-12-19 18:09:25', 0),
(11, 1, '{\"name\":\"Raju Prasad\",\"address\":\"Sakinaka, Mumbai, Maharashtra - 400070\",\"phone\":\"7021379952\",\"expected_delivery\":\"Delivery by Today\"}', '1639937560762', 85, 85, 40, '', 0, 125, 'COD', 'COD', '', 'Placed', '2021-12-19 18:12:40', 0),
(12, 1, '{\"name\":\"Raju Prasad\",\"address\":\"Sakinaka, Mumbai, Maharashtra - 400070\",\"phone\":\"7021379952\",\"expected_delivery\":\"Delivery by Today\"}', '1639937771202', 276, 276, 40, '', 0, 316, 'COD', 'COD', '', 'Placed', '2021-12-19 18:16:11', 0),
(13, 1, '{\"name\":\"Raju Prasad\",\"address\":\"Sakinaka, Mumbai, Maharashtra - 400070\",\"phone\":\"7021379952\",\"expected_delivery\":\"Delivery by Today\"}', '1639938056174', 15, 15, 40, '', 0, 55, 'COD', 'COD', '', 'Cancelled', '2021-12-19 18:20:56', 0),
(14, 1, '{\"name\":\"Raju Prasad\",\"address\":\"Sakinaka, Mumbai, Maharashtra - 400070\",\"phone\":\"7021379952\",\"expected_delivery\":\"Delivery by Today\"}', '1639940454275', 15, 15, 40, '', 0, 55, 'Razorpay', 'Paid', 'pay_IZRQd0NWMaA68y', 'Placed', '2021-12-19 19:00:54', 0),
(15, 1, '{\"name\":\"Raju Prasad\",\"address\":\"Sakinaka, Mumbai, Maharashtra - 400070\",\"phone\":\"7021379952\",\"expected_delivery\":\"Delivery by Today\"}', '1639940701068', 52, 52, 40, '', 0, 92, 'Razorpay', 'Pending', '', 'Pending', '2021-12-19 19:05:01', 0),
(16, 1, '{\"name\":\"Raju Prasad\",\"address\":\"Sakinaka, Mumbai, Maharashtra - 400070\",\"phone\":\"7021379952\",\"expected_delivery\":\"Delivery by Today\"}', '1639940705961', 52, 52, 40, '', 0, 92, 'Razorpay', 'Paid', 'pay_IZRVHpbfhYnUvb', 'Delivered', '2021-12-19 19:05:05', 0),
(17, 1, '{\"name\":\"Raju Prasad\",\"address\":\"Sakinaka, Mumbai, Maharashtra - 400070\",\"phone\":\"7021379952\",\"expected_delivery\":\"Delivery by Today\"}', '1639940958792', 38, 38, 40, '', 0, 78, 'Razorpay', 'Paid', 'pay_IZRZU6IOP5UpMq', 'Out', '2021-12-19 19:09:18', 0),
(22, 15, 'welocme', '123', 100, 10, 5, 'DISCOUNT10', 10, 95, 'Razorpay', 'Paid', 'PAY123', 'Delivered', '2023-11-06 09:00:00', 1),
(23, 15, 'welocme', 'ORD202311061135022609', 100, 10, 5, 'DISCOUNT10', 10, 95, 'Razorpay', 'Paid', 'PAY123', 'Delivered', '2023-11-06 09:00:00', 1),
(24, 15, 'welocme', 'ORD202311061136459475', 100, 10, 5, 'DISCOUNT10', 10, 95, 'Razorpay', 'Paid', 'PAY123', 'Delivered', '2023-11-06 09:00:00', 1),
(25, 15, 'welocme', 'ORD202311061138447722', 100, 10, 5, 'DISCOUNT10', 10, 95, 'Razorpay', 'Paid', 'PAY123', 'Delivered', '2023-11-06 09:00:00', 1),
(26, 16, 'welocme', 'ORD202311061141107809', 100, 10, 5, 'DISCOUNT10', 10, 95, 'Razorpay', 'Paid', 'PAY123', 'Delivered', '2023-11-06 09:00:00', 1),
(27, 19, '', 'ORD202311181144503837', 100, 10, 5, 'DISCOUNT10', 10, 95, 'Razorpay', 'Paid', 'PAY123', 'Delivered', '2023-11-06 09:00:00', 1),
(28, 1, 'ranubai shinde chawl kajupada kurla w\nkajupada kurla w', 'ORD202311181416554329', 100, 10, 5, 'DISCOUNT10', 10, 95, 'Razorpay', 'Paid', 'PAY123', 'Delivered', '2023-11-06 09:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pincode`
--

CREATE TABLE `pincode` (
  `id` int(255) NOT NULL,
  `pincode` int(100) NOT NULL,
  `charges` int(100) NOT NULL,
  `expected_on` varchar(150) NOT NULL,
  `date_time` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pincode`
--

INSERT INTO `pincode` (`id`, `pincode`, `charges`, `expected_on`, `date_time`) VALUES
(3, 400070, 40, 'Delivery by Today', '10-11-2021 09:40:05 pm'),
(4, 400072, 55, 'Delivery by Today', '10-11-2021 09:40:12 pm'),
(5, 400076, 100, 'Delivery by Today', '10-11-2021 09:40:28 pm');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(255) NOT NULL,
  `category` varchar(200) NOT NULL,
  `subcategory` varchar(200) DEFAULT NULL,
  `name` varchar(200) NOT NULL,
  `size` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `additional_information` varchar(255) DEFAULT NULL,
  `shipping_and_return` varchar(255) DEFAULT NULL,
  `stock` int(255) DEFAULT NULL,
  `quantity` int(255) NOT NULL,
  `quantity_unit` varchar(50) NOT NULL,
  `original_price` int(200) NOT NULL,
  `selling_price` int(200) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category`, `subcategory`, `name`, `size`, `description`, `additional_information`, `shipping_and_return`, `stock`, `quantity`, `quantity_unit`, `original_price`, `selling_price`, `date_time`) VALUES
(19, '17', '34', 'Watermelon (Tarbooj)', 'M-L-XL', 'In the heart of the tranquil forest, where the sun\'s rays gently filtered through the dense canopy, nature revealed its true splendor. The leaves whispered secrets in the breeze, and the scent of earth and wildflowers', 'When it comes to purchasing a product, additional information acts as the guiding star, offering a deeper understanding and aiding in informed decisions. ', 'Shipping and returns are the dynamic duo of online shopping. Quick and reliable shipping enhances the excitement of receiving a chosen item, while a hassle-free return policy provides a safety net for any unexpected hiccups.', 1, 1, 'piece', 164, 164, '2023-11-09 12:39:00'),
(23, '17', '34', 'Orange (Santra)', '', '', '', '', 1, 1, 'kg', 80, 80, '2021-12-13 06:14:16'),
(50, '17', '34', 'Apple', '', '', '', '', 1, 1, 'kg', 180, 180, '2021-12-13 06:12:18'),
(51, '17', '34', 'Banana (Kela)', '', '', '', '', 1, 1, 'item', 40, 40, '2021-12-13 06:12:31'),
(55, '17', '34', 'Pineapple (Anaanas)', '', '', '', '', 1, 1, 'piece', 95, 95, '2021-12-13 06:12:46'),
(63, '17', '33', 'Onion (Kanda)', '', '', '', '', 1, 1, 'kg', 40, 40, '2021-12-13 06:12:56'),
(64, '17', '33', 'Tomato (Tamatar)', '', '', '', '', 1, 1, 'kg', 78, 78, '2021-12-13 06:13:06'),
(65, '17', '33', 'Potato (Batata)', '', '', '', '', 1, 1, 'kg', 38, 38, '2021-12-13 06:13:15'),
(66, '17', '33', 'Green Capsicim (Shimla Mirch)', '', '', '', '', 1, 250, 'gm', 28, 28, '2021-12-13 06:13:27'),
(67, '17', '33', 'Cucumber (Kakdi)', '', '', '', '', 1, 500, 'gm', 40, 40, '2021-12-13 06:13:37'),
(68, '17', '33', 'White Radish (Mula)', '', '', '', '', 1, 250, 'gm', 17, 17, '2021-12-13 06:13:50'),
(69, '17', '33', 'Lady Finger (Bhindi)', '', '', '', '', 1, 250, 'gm', 24, 24, '2021-12-13 06:14:01'),
(70, '17', '33', 'Carrot (Gajar)', '', '', '', '', 1, 500, 'gm', 40, 40, '2021-12-13 06:08:20'),
(71, '17', '33', 'Cauliflower (Phool Gobhi)', '', '', '', '', 1, 1, 'piece', 30, 30, '2021-12-13 06:08:31'),
(72, '17', '33', 'Beetroot (Beet)', '', '', '', '', 1, 250, 'gm', 17, 17, '2021-12-13 06:08:47'),
(73, '17', '33', 'Cabbage (Patta Gobi)', '', '', '', '', 1, 1, 'piece', 38, 38, '2021-12-13 06:08:59'),
(74, '17', '33', 'Coconut (Naryal)', '', '', '', '', 1, 1, 'piece', 52, 52, '2021-12-13 06:09:21'),
(75, '17', '33', 'Brinjal (Baingan)', '', '', '', '', 0, 250, 'gm', 19, 20, '2021-12-13 06:09:32'),
(76, '17', '33', 'Bharta Brinjal (Bharta Baingan)', '', '', '', '', 1, 500, 'gm', 38, 38, '2021-12-13 06:09:42'),
(77, '17', '33', 'Baby Potato (Chote Batate)', '', '', '', '', 1, 500, 'gm', 27, 27, '2021-12-13 06:09:53'),
(78, '17', '33', 'Vari Brinjal (Vanga)', '', '', '', '', 1, 500, 'gm', 44, 44, '2021-12-13 06:10:06'),
(79, '17', '33', 'Raw Banana (Kacche Kele)', '', '', '', '', 1, 250, 'gm', 15, 15, '2021-12-13 06:10:17'),
(80, '17', '33', 'Sweet Potato (Ratala)', '', '', '', '', 1, 500, 'gm', 43, 44, '2021-12-13 06:07:12'),
(81, '17', '33', 'Ridge Gourd (Dodka)', '', '', '', '', 1, 500, 'gm', 35, 35, '2021-12-13 06:07:22'),
(82, '17', '33', 'Green Peas (Matar)', '', '', '', '', 1, 250, 'gm', 59, 59, '2021-12-13 06:07:02'),
(83, '17', '33', 'Cowpea Beans (Chavli)', '', '', '', '', 1, 250, 'gm', 28, 28, '2021-12-13 06:06:51'),
(84, '17', '33', 'Bitter Gourd (Karela)', '', '', '', '', 1, 250, 'gm', 14, 14, '2021-12-13 06:06:40'),
(85, '17', '33', 'Sponge Gourd (Ghosale)', '', '', '', '', 1, 500, 'kg', 53, 53, '2021-12-13 06:06:27'),
(86, '17', '33', 'Green Chilli (Hari Mirch)', '', '', '', '', 1, 100, 'gm', 10, 10, '2021-12-13 06:06:15'),
(87, '17', '33', 'Lemon (Nimbu)', '', '', '', '', 1, 200, 'gm', 15, 15, '2021-12-13 06:06:03'),
(88, '17', '33', 'Ginger (Ale)', '', '', '', '', 1, 200, 'kg', 18, 18, '2021-12-13 06:05:50'),
(89, '17', '33', 'Garlic (Lehsun)', '', '', '', '', 1, 100, 'kg', 18, 18, '2021-12-13 06:05:37'),
(90, '17', '33', 'Spinach (Palak)', '', '', '', '', 1, 250, 'gm', 69, 69, '2021-12-13 06:03:35'),
(91, '17', '33', 'Curry Leaves (Kadi Patta)', '', '', '', '', 1, 50, 'gm', 10, 10, '2021-12-13 06:03:45'),
(92, '17', '33', 'Peeled Garlic (Lehsun)', '', '', '', '', 1, 100, 'gm', 60, 60, '2021-12-13 06:03:57'),
(93, '17', '33', 'Mint Leaves (Pudina)', '', '', '', '', 1, 100, 'gm', 10, 10, '2021-12-13 06:03:25'),
(94, '17', '34', 'Chikoo ', '', '', '', '', 1, 250, 'gm', 25, 25, '2021-12-13 06:02:18'),
(95, '17', '34', 'Kiwi', '', '', '', '', 1, 3, 'piece', 85, 85, '2021-12-13 06:02:08'),
(96, '17', '34', 'Mosambi ', '', '', '', '', 1, 500, 'gm', 35, 36, '2021-12-13 06:02:00'),
(97, '17', '34', 'Guava (Peru)', '', '', '', '', 1, 500, 'gm', 45, 45, '2021-12-13 06:01:49'),
(98, '17', '34', 'Papaya (Papita)', '', '', '', '', 1, 1, 'piece', 85, 85, '2021-12-13 06:01:37'),
(99, '17', '34', 'Pomegranate (Anar)', '', '', '', '', 1000, 500, 'gm', 120, 120, '2021-12-16 04:54:10'),
(100, '18', '35', 'Amul gold Pasteurised Full Cream Milk ', '', '', '', '', 1, 500, 'ml', 29, 29, '2021-12-15 20:49:51'),
(101, '18', '35', 'Amul Taaza Milky Milk ', '', '', '', '', 1, 500, 'ml', 24, 24, '2021-12-15 20:50:47'),
(102, '18', '35', 'Mother Dairy Toned Milk ', '', '', '', '', 1, 500, 'ml', 24, 24, '2021-12-15 20:51:51'),
(103, '18', '35', 'Mother Dairy Pasteurised Homogenised Cow Milk ', '', '', '', '', 2, 500, 'ml', 24, 24, '2021-12-15 20:52:35'),
(104, '18', '35', 'Amul Taaza Toned Milk', '', '', '', '', 1, 1, 'litre', 66, 66, '2021-12-15 20:53:22'),
(105, '18', '35', 'Amul Gold Homogenised Standardised Milk ', '', '', '', '', 2, 1, 'ml', 70, 70, '2021-12-15 20:54:04'),
(106, '18', '35', 'Mother Dairy Toned Milk Tetra Pack 1 Ltr', '', '', '', '', 1, 1, 'litre', 68, 68, '2021-12-15 20:54:48'),
(107, '18', '36', 'Epigamia Origins Classic Curd ', '', '', '', '', 1, 400, 'gm', 65, 65, '2021-12-15 20:55:39'),
(108, '18', '36', 'Chitale Bandhu Full Cream Shrikhand Amba', '', '', '', '', 1, 500, 'gm', 135, 135, '2021-12-15 20:56:42'),
(109, '18', '36', 'Chitale Bandhu Full Cream Shrikhand Kesar ', '', '', '', '', 1, 250, 'gm', 73, 73, '2021-12-15 20:57:30'),
(110, '18', '36', 'Chitale Bandhu Full Cream Shrikhand Amba 250 Gm', '', '', '', '', 1, 250, 'gm', 73, 73, '2021-12-15 20:58:18'),
(111, '18', '36', 'Chitale Bandhu Full Cream Shrikhand Kesar', '', '', '', '', 1, 5000, 'gm', 135, 135, '2021-12-15 20:59:11'),
(112, '18', '36', 'Chitale Bandhu Full Cream Shrikhand Badampista', '', '', '', '', 2, 250, 'gm', 74, 74, '2021-12-15 21:07:42'),
(113, '18', '36', 'Chitale Bandhu Full Cream Shrikhand Elaichi ', '', '', '', '', 1, 250, 'gm', 70, 70, '2021-12-15 21:09:05'),
(114, '18', '36', 'Amul Shrikhand Elaichi ', '', '', '', '', 1, 200, 'gm', 45, 45, '2021-12-15 21:10:24'),
(115, '18', '37', 'Britannia Brown Bread ', '', '', '', '', 1, 400, 'gm', 42, 42, '2021-12-15 21:11:33'),
(116, '18', '37', 'Britannia 100% Whole Wheat Bread ', '', '', '', '', 1, 400, 'gm', 45, 45, '2021-12-15 21:12:19'),
(117, '18', '37', 'Modern 100% Whole Wheat Brown Bread', '', '', '', '', 1, 400, 'gm', 45, 45, '2021-12-15 21:13:08'),
(118, '18', '37', 'Modern Multigrain Bread ', '', '', '', '', 1, 400, 'gm', 55, 55, '2021-12-15 21:13:51'),
(119, '18', '37', 'Britannia Pav', '', '', '', '', 1, 250, 'gm', 22, 22, '2021-12-15 21:14:34'),
(120, '18', '37', 'Modern Wow Pav ', '', '', '', '', 1, 1, 'piece', 25, 25, '2021-12-15 21:15:27'),
(121, '18', '38', 'Amul Pasteurised Butter', '', '', '', '', 1, 100, 'gm', 50, 50, '2021-12-15 21:16:40'),
(122, '18', '38', 'Amul Pasteurised Butter', '', '', '', '', 1, 500, 'gm', 245, 245, '2021-12-15 21:17:33'),
(123, '18', '38', 'Amul Garlic & Herbs Butter ', '', '', '', '', 1, 100, 'gm', 51, 51, '2021-12-15 21:18:13'),
(124, '18', '38', 'Amul Lite Milk Fat Cheese Spread 100 gm', '', '', '', '', 1, 100, 'gm', 40, 40, '2021-12-15 21:19:06'),
(125, '18', '37', 'Amul Processed Cheese Slices ', '', '', '', '', 2, 200, 'gm', 125, 125, '2021-12-15 21:19:55'),
(126, '18', '38', 'Britannia Cheese Slices', '', '', '', '', 1, 200, 'gm', 155, 155, '2021-12-15 21:20:52'),
(127, '18', '38', 'Amul Processed Cheese Block', '', '', '', '', 1, 200, 'gm', 110, 110, '2021-12-15 21:22:05'),
(128, '18', '38', 'Go Pizza Cheese', '', '', '', '', 1, 200, 'gm', 140, 140, '2021-12-15 21:22:54'),
(129, '18', '39', 'Classic Eggs 6 Pcs', '', '', '', '', 1, 6, 'piece', 59, 59, '2021-12-15 21:24:13'),
(130, '18', '39', 'Classic Eggs ', '', '', '', '', 1, 12, 'piece', 115, 115, '2021-12-15 21:25:00'),
(131, '18', '39', 'Brown Eggs ', '', '', '', '', 1, 6, 'piece', 75, 75, '2021-12-15 21:25:37'),
(132, '18', '39', 'Brown Eggs ', '', '', '', '', 1, 12, 'piece', 150, 150, '2021-12-15 21:26:20'),
(133, '18', '40', 'Gowardhan Fresh Paneer', '', '', '', '', 2, 200, 'gm', 89, 89, '2021-12-15 21:27:05'),
(134, '18', '40', 'D\'lecta Dairy Cream ', '', '', '', '', 1, 200, 'ml', 54, 54, '2021-12-15 21:28:12'),
(135, '18', '40', 'D\'lecta Dairy Whipping Cream', '', '', '', '', 1, 1, 'kg', 450, 451, '2021-12-15 21:28:54'),
(136, '18', '40', 'Amul Fresh Cream', '', '', '', '', 1, 250, 'ml', 63, 63, '2021-12-15 21:29:40'),
(137, '18', '40', 'Amul Fresh Paneer', '', '', '', '', 1, 200, 'gm', 76, 76, '2021-12-15 21:30:36'),
(138, '18', '40', 'Amul Malai Paneer ', '', '', '', '', 1, 200, 'gm', 74, 74, '2021-12-15 21:31:31'),
(139, '18', '41', 'Amul Masti Spiced Buttermilk ', '', '', '', '', 1, 1, 'litre', 50, 50, '2021-12-15 21:32:57'),
(140, '18', '41', 'Amul Rose Flavoured Lassi ', '', '', '', '', 1, 250, 'ml', 20, 20, '2021-12-15 21:34:15'),
(141, '18', '41', 'Amul Kool Badam Flavoured Drink 180 ml', '', '', '', '', 1, 180, 'ml', 20, 20, '2021-12-15 21:37:03'),
(142, '18', '41', 'Nescafe Chilled Latte Cold Coffee 180 ml', '', '', '', '', 1, 180, 'ml', 35, 35, '2021-12-15 21:37:47'),
(143, '19', '42', 'Aashirvaad Superior MP Atta ', '', '', '', '', 1, 5, 'kg', 250, 250, '2021-12-15 21:39:10'),
(144, '19', '42', 'Nature Fresh Sampoorna Chakki Atta', '', '', '', '', 1, 5, 'kg', 245, 245, '2021-12-15 21:40:04'),
(145, '19', '42', 'Fortune Chakki Fresh Atta ', '', '', '', '', 1, 5, 'kg', 211, 211, '2021-12-15 21:41:15'),
(146, '19', '42', 'Aashirvaad Select Sharbati Atta', '', '', '', '', 1, 5, 'kg', 305, 305, '2021-12-15 21:42:12'),
(147, '19', '42', 'Aashirvaad Multigrain Atta', '', '', '', '', 1, 1, 'kg', 64, 64, '2021-12-15 21:43:00'),
(148, '19', '42', 'Pillsbury Multigrain Atta ', '', '', '', '', 1, 5, 'kg', 295, 295, '2021-12-15 21:44:01'),
(149, '19', '42', 'Pillsbury Chakki Fresh Atta', '', '', '', '', 1, 5, 'kg', 245, 245, '2021-12-15 21:45:24'),
(150, '19', '43', 'Maya Besan ', '', '', '', '', 1, 1, 'kg', 117, 117, '2021-12-15 21:46:27'),
(151, '19', '43', 'Tata Sampann 100% Chana Dal Fine Besan ', '', '', '', '', 1, 500, 'gm', 64, 64, '2021-12-15 21:48:18'),
(152, '19', '43', 'Maya Rava ', '', '', '', '', 1, 1, 'kg', 50, 50, '2021-12-15 21:47:59'),
(153, '19', '43', 'Maya Premium Sooji ', '', '', '', '', 1, 1, 'kg', 49, 49, '2021-12-16 09:18:38'),
(154, '19', '43', 'Maya Maida', '', '', '', '', 1, 500, 'gm', 26, 26, '2021-12-16 09:19:30'),
(155, '19', '44', 'Maya Surti Kolam Rice', '', '', '', '', 1, 5, 'kg', 447, 447, '2021-12-16 09:32:29'),
(156, '19', '44', 'India Gate Basmati Rice - Feast Rozzana', '', '', '', '', 1, 1, 'kg', 96, 96, '2021-12-16 09:33:39'),
(157, '19', '44', 'Dawat Basmati Rice - Rozana Super ', '', '', '', '', 1, 1, 'kg', 79, 79, '2021-12-16 09:34:33'),
(158, '19', '44', 'Fortune Rozana Basmati Rice', '', '', '', '', 1, 1, 'kg', 130, 130, '2021-12-16 09:35:22'),
(159, '19', '44', 'Kohinoor Basmati Rice - Charminar Rozana ', '', '', '', '', 1, 1, 'kg', 105, 105, '2021-12-16 09:36:03'),
(160, '19', '44', 'India Gate Basmati Rice - Super', '', '', '', '', 1, 1, 'kg', 182, 182, '2021-12-16 09:36:51'),
(161, '19', '44', 'Dawat Basmati Rice - Super', '', '', '', '', 1, 1, 'kg', 185, 185, '2021-12-16 09:37:42'),
(162, '19', '44', 'Kohinoor Dubar Basmati Rice', '', '', '', '', 1, 1, 'kg', 125, 125, '2021-12-16 09:38:27'),
(163, '19', '44', 'India Gate Basmati Rice - Mogra ', '', '', '', '', 1, 5, 'kg', 345, 345, '2021-12-16 09:40:01'),
(164, '19', '44', 'India Gate Regular Choice Basmati Rice Medium ', '', '', '', '', 1, 5, 'kg', 425, 425, '2021-12-16 09:41:00'),
(165, '19', '44', 'Maya Basmati Mini Mogra Rice', '', '', '', '', 1, 5, 'kg', 217, 217, '2021-12-16 09:41:59'),
(166, '19', '48', 'Gemini Refined Sunflower Oil ', '', '', '', '', 1, 5, 'litre', 1155, 1155, '2021-12-16 09:43:18'),
(167, '19', '48', 'Fortune Sunlite Refined Sunflower Oil ', '', '', '', '', 1, 1, 'litre', 205, 205, '2021-12-16 09:47:04'),
(168, '19', '48', 'Fortune Sunlite Refined Sunflower Oil', '', '', '', '', 1, 5, 'litre', 975, 975, '2021-12-16 09:48:02'),
(169, '19', '48', 'Dhara Health Refined Sunflower Oil', '', '', '', '', 1, 1, 'litre', 225, 225, '2021-12-16 09:48:48'),
(170, '19', '48', 'Sundrop Refined Sunflower Oil', '', '', '', '', 1, 1, 'litre', 215, 215, '2021-12-16 09:49:38'),
(171, '19', '48', 'Saffola Active Blended Vegetable Oil', '', '', '', '', 1, 1, 'litre', 220, 220, '2021-12-16 09:50:19'),
(172, '19', '45', 'Borges Extra Light Olive Oil', '', '', '', '', 1, 1, 'litre', 1350, 1350, '2021-12-16 09:51:21'),
(173, '19', '45', 'Bertolli Extra Light Olive Oil', '', '', '', '', 1, 2, 'litre', 2999, 2999, '2021-12-16 09:52:10'),
(174, '19', '45', 'Figaro Olive Oil ', '', '', '', '', 1, 100, 'ml', 165, 165, '2021-12-16 09:53:00'),
(175, '19', '45', 'Figaro Olive Oil ', '', '', '', '', 1, 500, 'ml', 599, 599, '2021-12-16 09:53:47'),
(176, '19', '45', 'Figaro Olive Oil ', '', '', '', '', 1, 1, 'litre', 999, 999, '2021-12-16 09:54:28'),
(177, '19', '46', 'Gowardhan Cow Ghee (Pouch) ', '', '', '', '', 1, 500, 'ml', 295, 295, '2021-12-16 09:55:34'),
(178, '19', '46', 'Gowardhan Pure Cow Ghee (Jar)', '', '', '', '', 1, 500, 'ml', 305, 305, '2021-12-16 09:56:18'),
(179, '19', '46', 'Chitale Bandhu Cow Ghee ', '', '', '', '', 1, 500, 'ml', 295, 295, '2021-12-16 09:57:06'),
(180, '19', '46', 'Amul Pure Ghee', '', '', '', '', 1, 1, 'litre', 485, 485, '2021-12-16 09:57:45'),
(181, '19', '46', 'Sagar Pure Ghee 1Ltr', '', '', '', '', 1, 1, 'litre', 485, 485, '2021-12-16 09:58:19'),
(182, '19', '47', 'Maya Premium Toor Dal ', '', '', '', '', 1, 500, 'gm', 85, 85, '2021-12-16 09:59:12'),
(183, '19', '47', 'Tata Sampann Unpolished Toor Dal (Arhar Dal) ', '', '', '', '', 1, 500, 'gm', 91, 91, '2021-12-16 09:59:57'),
(184, '19', '47', 'Maya Premium Toor dal', '', '', '', '', 1, 1, 'gm', 149, 149, '2021-12-16 10:00:49'),
(185, '19', '47', 'Tata Sampann Unpolished Moong Dal Split', '', '', '', '', 1, 1, 'kg', 175, 175, '2021-12-16 10:01:41'),
(186, '19', '47', 'Maya Moong Dal Whole ', '', '', '', '', 1, 500, 'gm', 83, 83, '2021-12-16 10:02:33'),
(187, '19', '47', 'Maya Pemium Chana Dal ', '', '', '', '', 1, 500, 'gm', 59, 59, '2021-12-16 10:04:06'),
(188, '20', '49', 'Maya Whole Spice Jeera ', '', '', '', '', 1, 100, 'gm', 30, 30, '2021-12-16 10:05:28'),
(189, '20', '49', 'Maya Whole Spice Jeera ', '', '', '', '', 1, 200, 'gm', 57, 57, '2021-12-16 10:06:10'),
(190, '20', '49', 'Everest Cumin Powder ', '', '', '', '', 1, 50, 'gm', 30, 30, '2021-12-16 10:06:59'),
(191, '20', '49', 'Everest Tikhalal Hot & Red Chilli Powder ', '', '', '', '', 1, 100, 'gm', 47, 47, '2021-12-16 10:08:07'),
(192, '20', '49', 'Everest Tikhalal Hot & Red Chilli Powder ', '', '', '', '', 1, 200, 'gm', 94, 94, '2021-12-16 10:09:03'),
(193, '20', '49', 'Everest Kutilal Chilli Powder', '', '', '', '', 1, 100, 'gm', 47, 47, '2021-12-16 10:10:02'),
(194, '20', '49', 'Everest Kashmirilal Brilliant red Chilli Powder ', '', '', '', '', 1, 100, 'gm', 78, 78, '2021-12-16 10:10:41'),
(195, '20', '49', 'Everest Coriander Powder ', '', '', '', '', 1, 200, 'gm', 64, 64, '2021-12-16 10:13:34'),
(196, '20', '49', 'Everest Turmeric Powder ', '', '', '', '', 1, 200, 'gm', 62, 62, '2021-12-16 10:14:18'),
(197, '20', '49', 'Everest Pav Bhaji Masala Powder', '', '', '', '', 1, 50, 'gm', 37, 37, '2021-12-16 10:15:04'),
(198, '20', '49', 'Everest Chaat Masala Powder ', '', '', '', '', 1, 100, 'gm', 65, 65, '2021-12-16 10:15:46'),
(199, '20', '49', 'Tata Vacuum Evaporated iodised Salt', '', '', '', '', 1, 1, 'kg', 22, 22, '2021-12-16 10:16:26'),
(200, '20', '49', 'Tata Salt Lite, 15% Low Sodium Iodised Salt', '', '', '', '', 1, 1, 'kg', 40, 40, '2021-12-16 10:17:04'),
(201, '21', '50', 'Cadbury Original Oreo Chocolatey Sandwich Biscuits ', '', '', '', '', 1, 120, 'gm', 30, 30, '2021-12-16 10:17:58'),
(202, '21', '50', 'Cadbury Oreo Strawberry Cream Biscuits', '', '', '', '', 1, 46, 'gm', 10, 10, '2021-12-16 10:18:44'),
(203, '21', '50', 'Cadbury Oreo Strawberry Creme Sandwich Biscuits ', '', '', '', '', 1, 120, 'gm', 30, 30, '2021-12-16 10:21:24'),
(204, '21', '50', 'Parle Fab! Bourbon Chocolate Flavoured Sandwich Biscuits', '', '', '', '', 1, 150, 'gm', 30, 30, '2021-12-16 10:21:05'),
(205, '21', '50', 'Britannia Bourbon Cream Biscuits ', '', '', '', '', 1, 150, 'gm', 35, 35, '2021-12-16 10:22:09'),
(206, '21', '50', 'Britannia Treat Jim Jam Cream Biscuits ', '', '', '', '', 1, 150, 'gm', 35, 35, '2021-12-16 10:22:48'),
(207, '22', '51', 'Chicken Skinless Curry Cut (Small Pieces) ', '', '', '', '', 1, 500, 'gm', 175, 175, '2021-12-16 10:23:39'),
(208, '22', '51', ' Chicken Breast Boneless ', '', '', '', '', 1, 450, 'gm', 260, 260, '2021-12-16 10:24:19'),
(209, '17', '0', 'TRY123', NULL, '<p>msdklsklsd</p>', NULL, NULL, 80, 1, 'gm', 100, 80, '2024-02-05 08:09:22');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int(255) NOT NULL,
  `product_id` int(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image`, `date_time`) VALUES
(38, 19, 'https://ascella.qodeinteractive.com/wp-content/uploads/2022/12/slider-list-img-new-5.jpg', '2023-11-16 08:23:21'),
(69, 50, 'https://ascella.qodeinteractive.com/wp-content/uploads/2022/12/slider-list-img-new-6.jpg', '2023-11-08 11:12:10'),
(70, 51, 'https://ascella.qodeinteractive.com/wp-content/uploads/2022/12/slider-list-img-new-2.jpg', '2023-11-08 11:12:10'),
(84, 65, 'https://ascella.qodeinteractive.com/wp-content/uploads/2022/12/slider-list-img-new-7.jpg', '2023-11-08 11:08:38'),
(86, 66, 'https://ascella.qodeinteractive.com/wp-content/uploads/2022/12/slider-list-img-new-6.jpg', '2023-11-08 11:08:38'),
(87, 67, 'https://ascella.qodeinteractive.com/wp-content/uploads/2022/12/slider-list-img-new-2.jpg', '2023-11-08 11:08:38'),
(88, 68, 'https://ascella.qodeinteractive.com/wp-content/uploads/2022/12/slider-list-img-new-5.jpg', '2023-11-08 11:08:38'),
(89, 69, 'https://ascella.qodeinteractive.com/wp-content/uploads/2023/01/slider-list-img-new-10.jpg', '2023-11-08 11:08:38'),
(93, 73, 'https://ascella.qodeinteractive.com/wp-content/uploads/2022/12/slider-list-img-new-7.jpg', '2023-11-08 11:08:38'),
(94, 74, 'https://ascella.qodeinteractive.com/wp-content/uploads/2022/12/slider-list-img-new-6.jpg', '2023-11-08 11:08:38'),
(95, 75, 'https://ascella.qodeinteractive.com/wp-content/uploads/2022/12/slider-list-img-new-2.jpg', '2023-11-08 11:08:38'),
(96, 76, 'https://ascella.qodeinteractive.com/wp-content/uploads/2022/12/slider-list-img-new-5.jpg', '2023-11-08 11:08:38'),
(97, 77, 'https://ascella.qodeinteractive.com/wp-content/uploads/2023/01/slider-list-img-new-10.jpg', '2023-11-08 11:08:38'),
(101, 81, 'https://ascella.qodeinteractive.com/wp-content/uploads/2022/12/slider-list-img-new-7.jpg', '2023-11-08 11:08:38'),
(102, 82, 'https://ascella.qodeinteractive.com/wp-content/uploads/2022/12/slider-list-img-new-6.jpg', '2023-11-08 11:08:38'),
(103, 83, 'https://ascella.qodeinteractive.com/wp-content/uploads/2022/12/slider-list-img-new-2.jpg', '2023-11-08 11:08:38'),
(104, 84, 'https://ascella.qodeinteractive.com/wp-content/uploads/2022/12/slider-list-img-new-5.jpg', '2023-11-08 11:08:38'),
(105, 85, 'https://ascella.qodeinteractive.com/wp-content/uploads/2023/01/slider-list-img-new-10.jpg', '2023-11-08 11:08:38'),
(109, 89, 'https://ascella.qodeinteractive.com/wp-content/uploads/2022/12/slider-list-img-new-7.jpg', '2023-11-08 11:08:38'),
(110, 90, 'https://ascella.qodeinteractive.com/wp-content/uploads/2022/12/slider-list-img-new-6.jpg', '2023-11-08 11:08:38'),
(111, 91, 'https://ascella.qodeinteractive.com/wp-content/uploads/2022/12/slider-list-img-new-2.jpg', '2023-11-08 11:08:38'),
(112, 92, 'https://ascella.qodeinteractive.com/wp-content/uploads/2022/12/slider-list-img-new-5.jpg', '2023-11-08 11:08:38'),
(113, 93, 'https://ascella.qodeinteractive.com/wp-content/uploads/2023/01/slider-list-img-new-10.jpg', '2023-11-08 11:08:38'),
(117, 97, 'https://ascella.qodeinteractive.com/wp-content/uploads/2022/12/slider-list-img-new-7.jpg', '2023-11-08 11:08:38'),
(118, 98, 'https://ascella.qodeinteractive.com/wp-content/uploads/2022/12/slider-list-img-new-6.jpg', '2023-11-08 11:08:38'),
(119, 99, 'https://ascella.qodeinteractive.com/wp-content/uploads/2022/12/slider-list-img-new-2.jpg', '2023-11-08 11:08:38'),
(120, 100, 'https://ascella.qodeinteractive.com/wp-content/uploads/2022/12/slider-list-img-new-5.jpg', '2023-11-08 11:08:38'),
(121, 101, 'https://ascella.qodeinteractive.com/wp-content/uploads/2023/01/slider-list-img-new-10.jpg', '2023-11-08 11:26:06'),
(125, 105, 'https://ascella.qodeinteractive.com/wp-content/uploads/2022/12/slider-list-img-new-7.jpg', '2023-11-08 11:26:06'),
(126, 106, 'https://ascella.qodeinteractive.com/wp-content/uploads/2022/12/slider-list-img-new-6.jpg', '2023-11-08 11:26:06'),
(127, 107, 'https://ascella.qodeinteractive.com/wp-content/uploads/2022/12/slider-list-img-new-2.jpg', '2023-11-08 11:26:06'),
(128, 108, 'https://ascella.qodeinteractive.com/wp-content/uploads/2022/12/slider-list-img-new-5.jpg', '2023-11-08 11:26:06'),
(129, 109, 'https://ascella.qodeinteractive.com/wp-content/uploads/2023/01/slider-list-img-new-10.jpg', '2023-11-08 11:26:06'),
(133, 113, 'https://ascella.qodeinteractive.com/wp-content/uploads/2022/12/slider-list-img-new-7.jpg', '2023-11-08 11:26:06'),
(134, 114, 'https://ascella.qodeinteractive.com/wp-content/uploads/2022/12/slider-list-img-new-6.jpg', '2023-11-08 11:26:06'),
(135, 115, 'https://ascella.qodeinteractive.com/wp-content/uploads/2022/12/slider-list-img-new-2.jpg', '2023-11-08 11:26:06'),
(136, 116, 'https://ascella.qodeinteractive.com/wp-content/uploads/2022/12/slider-list-img-new-5.jpg', '2023-11-08 11:26:06'),
(137, 117, 'https://ascella.qodeinteractive.com/wp-content/uploads/2023/01/slider-list-img-new-10.jpg', '2023-11-08 11:26:06'),
(141, 121, 'https://ascella.qodeinteractive.com/wp-content/uploads/2022/12/slider-list-img-new-7.jpg', '2023-11-08 11:26:06'),
(142, 122, 'https://ascella.qodeinteractive.com/wp-content/uploads/2022/12/slider-list-img-new-6.jpg', '2023-11-08 11:26:06'),
(143, 123, 'https://ascella.qodeinteractive.com/wp-content/uploads/2022/12/slider-list-img-new-2.jpg', '2023-11-08 11:26:06'),
(144, 124, 'https://ascella.qodeinteractive.com/wp-content/uploads/2022/12/slider-list-img-new-5.jpg', '2023-11-08 11:26:06'),
(145, 125, 'fcdfd54536e4ebb24ce48fc7b82f92d4_product_image.jpg', '2021-12-15 21:19:55'),
(146, 126, '7a04ce6fc4d0d43e43c05a8a9ac81cce_product_image.jpg', '2021-12-15 21:20:52'),
(147, 127, '4bb8fd6a70c5eff3549ed6b6723e5ae4_product_image.jpg', '2021-12-15 21:22:05'),
(148, 128, '7c5b4d195cb88f40cb64b5bdefce2df9_product_image.jpeg', '2021-12-15 21:22:54'),
(149, 129, 'b5ec6e3f83d403689a95840f1356fd13_product_image.jpg', '2021-12-15 21:23:45'),
(150, 130, '4cecd811b9a87249a19a267889974814_product_image.jpg', '2021-12-15 21:25:00'),
(151, 131, 'e4b4dcb4791a40c8c481d071a3eab4fb_product_image.jpg', '2021-12-15 21:25:37'),
(152, 132, '977bd75265d1ea391facb6762ca7bda9_product_image.jpg', '2021-12-15 21:26:20'),
(153, 133, 'fd1968c6d45bc61a0861287ba5c264da_product_image.jpg', '2021-12-15 21:27:05'),
(154, 134, '46193d850460b6effa802207dfe456ec_product_image.jpg', '2021-12-15 21:28:12'),
(155, 135, '9682db8477f656606e17e454500862be_product_image.jpg', '2021-12-15 21:28:54'),
(156, 136, '6b6fd68bb73927bc504da254c90ec811_product_image.jpg', '2021-12-15 21:29:40'),
(157, 137, 'a383e31b8f66f81eb592ece3d77e860a_product_image.jpg', '2021-12-15 21:30:36'),
(158, 138, '474c57e31b944bb73c13e46f7b24080d_product_image.jpg', '2021-12-15 21:31:31'),
(159, 139, '23eb3eeab64feb081e9d419847a1432a_product_image.jpg', '2021-12-15 21:32:57'),
(160, 140, 'd63128d8f3c635f8953eadf38ec5a646_product_image.jpg', '2021-12-15 21:34:15'),
(161, 141, '7c07cc8909e5db5f02b427c256ab345d_product_image.png', '2021-12-15 21:37:03'),
(162, 142, 'b55b501e239e99acf29b61bdd1597d44_product_image.jpg', '2021-12-15 21:37:47'),
(163, 143, '72c1de859296252de27fd4398f4ee002_product_image.jpg', '2021-12-15 21:39:10'),
(164, 144, '5e0cb4ba4790edf9bf99bbf343cedd9e_product_image.jpg', '2021-12-15 21:40:04'),
(165, 145, 'c89904266ea3d11242871c5acf660c30_product_image.jpg', '2021-12-15 21:40:50'),
(166, 146, 'eb7749c38ad7507124dd6db3eb90ede3_product_image.png', '2021-12-15 21:42:12'),
(167, 147, 'bfd1e05639f58ee0f3ec9debe548caf2_product_image.jpg', '2021-12-15 21:43:00'),
(168, 148, 'a00d827f8faeda00d9c7b111933ac6ab_product_image.jpg', '2021-12-15 21:44:01'),
(169, 149, 'be526f45fdfa62105b650b6394275bdc_product_image.jpg', '2021-12-15 21:44:53'),
(170, 150, '50afab2d7e8ead351e5736246a076a63_product_image.jpg', '2021-12-15 21:46:27'),
(171, 151, '5e8da8eafec55e4a6e03c80c61786749_product_image.png', '2021-12-15 21:47:12'),
(172, 152, '2e489b3bc71324d8bae95f4813e244a7_product_image.jpg', '2021-12-15 21:47:59'),
(173, 153, 'de5db68e9b25592e1f31f0d5f23f068d_product_image.jpg', '2021-12-16 09:18:38'),
(174, 154, 'a88905ad0a8b74e2859eef46cb6e8a0a_product_image.jpg', '2021-12-16 09:19:30'),
(175, 155, '0e086aa5f53fc815a8adeb1a19ea1692_product_image.jpg', '2021-12-16 09:32:29'),
(176, 156, 'c44566dc66501fab70f2c10d0ef861ff_product_image.jpg', '2021-12-16 09:33:39'),
(177, 157, '732f4cbb5013d00ab9842064adf6359a_product_image.jpg', '2021-12-16 09:34:34'),
(178, 158, '033fa9d81b2774af7896dc3d6acb07b3_product_image.jpg', '2021-12-16 09:35:22'),
(179, 159, '9d447fc2326e12b3b8d1631850e5c47e_product_image.jpeg', '2021-12-16 09:36:03'),
(180, 160, 'f8297e5368650205965bfec00da8ed0a_product_image.jpg', '2021-12-16 09:36:51'),
(181, 161, '4578338df82361fb3943e2c07d374ef0_product_image.jpg', '2021-12-16 09:37:42'),
(182, 162, 'adcea21192e234a0244ee9bd8618115a_product_image.jpg', '2021-12-16 09:38:27'),
(183, 163, '4093197c5f8c0eceb05c7f24efb78ed8_product_image.jpg', '2021-12-16 09:40:01'),
(184, 164, '1fd5f0573a13bbe8dc45aff888329058_product_image.jpg', '2021-12-16 09:41:00'),
(185, 165, 'a1d22fb4b9fb5dcd3c1c643e212e0af6_product_image.jpg', '2021-12-16 09:41:59'),
(186, 166, 'ef474c08de5f01d12a09a5ca39f5fe1e_product_image.jpg', '2021-12-16 09:43:18'),
(187, 167, 'b4a18ac9527ca2eb4de4c023c47e967d_product_image.jpg', '2021-12-16 09:47:04'),
(188, 168, '35784dd6531b1f8863eac8ae032dd5e1_product_image.jpg', '2021-12-16 09:48:02'),
(189, 169, '0be7200f4f6c4627723cfa971fa6339e_product_image.jpg', '2021-12-16 09:48:48'),
(190, 170, '78c6331319125185890a7377b513396c_product_image.png', '2021-12-16 09:49:38'),
(191, 171, '02011f7f305823c7af3fe90db94dd2b9_product_image.jpg', '2021-12-16 09:50:19'),
(192, 172, '9f43028a98f550b4a1eaccccfd049186_product_image.jpg', '2021-12-16 09:51:21'),
(193, 173, 'f40b5f67529c6e35ec39f2974f4750da_product_image.jpg', '2021-12-16 09:52:10'),
(194, 174, '26ff8b4ffe924da8067404ad443ed442_product_image.jpg', '2021-12-16 09:53:00'),
(195, 175, '171ab42fee9e968265aa78ef5d929fcc_product_image.jpg', '2021-12-16 09:53:47'),
(196, 176, 'e29fb98918a296bb0bc2b946b27aef37_product_image.jpg', '2021-12-16 09:54:28'),
(197, 177, 'b9fda4347e649c25e63bfcbfb5ac290f_product_image.jpg', '2021-12-16 09:55:34'),
(198, 178, '2bd4254814cc94a512242fa725692fc4_product_image.jpg', '2021-12-16 09:56:18'),
(199, 179, 'e47d636cde65a6e1ff4e9426c240d738_product_image.jpg', '2021-12-16 09:57:06'),
(200, 180, '8dfbc94f0507d02249f29e242355013d_product_image.jpg', '2021-12-16 09:57:45'),
(201, 181, 'e6be893ad0ac34ada57f7a6996e7cb01_product_image.jpg', '2021-12-16 09:58:19'),
(202, 182, '05317e90271fcc5232eba67a4f0db7bd_product_image.jpg', '2021-12-16 09:59:12'),
(203, 183, 'f9427eb5d448980ecb5eac885bd84562_product_image.jpg', '2021-12-16 09:59:57'),
(204, 184, 'cacd7263f171620e3e7014217786f774_product_image.jpg', '2021-12-16 10:00:49'),
(205, 185, 'bf499d071ddb78023b7b3c974e447a7a_product_image.jpg', '2021-12-16 10:01:41'),
(206, 186, 'f985f473a3823112ef82a57be728d2bc_product_image.jpg', '2021-12-16 10:02:33'),
(207, 187, '24eab406e79a5780698a84d2914ed1ad_product_image.jpg', '2021-12-16 10:04:06'),
(208, 188, '77d1f868569524e9578b989cd59c1950_product_image.jpg', '2021-12-16 10:05:28'),
(209, 189, '14f375c94bdc400a23d75fdefc77c74b_product_image.jpg', '2021-12-16 10:06:10'),
(210, 190, '196631fd95dda3448d7070ac3eb6808e_product_image.png', '2021-12-16 10:06:59'),
(211, 191, '90aa191100ee488c1a93e3f552aa2ee1_product_image.jpg', '2021-12-16 10:08:07'),
(212, 192, 'c49c525e7892c54afa830a1cdc84704e_product_image.jpg', '2021-12-16 10:09:03'),
(213, 193, '35b584afbd607e22dda08aa3729d944d_product_image.jpg', '2021-12-16 10:10:02'),
(214, 194, '26f2416f041e50bc05d293847682f699_product_image.png', '2021-12-16 10:10:41'),
(215, 195, '93ad6dce80e321458d91548016187562_product_image.jpg', '2021-12-16 10:13:34'),
(216, 196, '1911bc55704e134b5749fecb5ecbdf06_product_image.jpg', '2021-12-16 10:14:18'),
(217, 197, '242d7b3e2df5bdfc87ac1e90d8bbd8ff_product_image.png', '2021-12-16 10:15:04'),
(218, 198, 'ac17f00454c18987ab857643bba8d4f0_product_image.jpg', '2021-12-16 10:15:46'),
(219, 199, '55d9f0a2d90849af84e8c93cc0bb2757_product_image.jpg', '2021-12-16 10:16:26'),
(220, 200, 'e928e5bb406b3db9bbf75d84b129d9c5_product_image.jpg', '2021-12-16 10:17:04'),
(222, 202, '876b261cccdde644508c6e2ff75355d5_product_image.jpg', '2021-12-16 10:18:44'),
(223, 203, '125f11683cf5be1cac3f91f21342fe78_product_image.jpg', '2021-12-16 10:19:35'),
(224, 201, '98706732414433b9d685fe2158d77a1d_product_image.jpg', '2021-12-16 10:20:15'),
(225, 204, '236bebf3c119b15831e02d7d70644c72_product_image.jpg', '2021-12-16 10:21:05'),
(226, 205, '1cb99f4b826c253d744d773c90a05c03_product_image.jpg', '2021-12-16 10:22:09'),
(227, 206, '2802077c9b16e02ae89a97351a92cbaa_product_image.jpg', '2021-12-16 10:22:48'),
(228, 207, '776d3ee3a502d50b06f48abfb3a20321_product_image.jpg', '2021-12-16 10:23:39'),
(229, 208, '1d6f833201d4e9c3718e4a04a7635fea_product_image.jpg', '2021-12-16 10:24:19'),
(230, 19, 'https://ascella.qodeinteractive.com/wp-content/uploads/2022/12/slider-list-img-new-2.jpg', '2023-11-08 11:12:10'),
(231, 19, 'https://ascella.qodeinteractive.com/wp-content/uploads/2022/12/slider-list-img-new-6.jpg', '2023-11-16 07:43:46'),
(232, 209, '7cd50e43304a84a087cd2988d1713db7_product_image.png', '2024-02-05 08:09:22');

-- --------------------------------------------------------

--
-- Table structure for table `query`
--

CREATE TABLE `query` (
  `id` int(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `query` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `date_time` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE `site_settings` (
  `s_id` int(11) NOT NULL,
  `setting_name` varchar(100) NOT NULL,
  `setting_data` longtext NOT NULL,
  `date_time` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`s_id`, `setting_name`, `setting_data`, `date_time`) VALUES
(1, 'Privacy Policy', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In iaculis nibh sed mi accumsan consequat. Ut vitae felis sed velit mattis consectetur rutrum quis turpis. Nam rhoncus erat a orci ornare accumsan. Sed non nisi et mauris porttitor porta a id eros. Cras nec imperdiet mi. Sed et feugiat lacus, eu facilisis eros. Phasellus dictum orci ac accumsan finibus. Phasellus ac sapien eu erat convallis fermentum. Morbi enim massa, porta et tortor id, pharetra dignissim velit.</p><p>Donec sed iaculis dolor, eu posuere tortor. Cras pharetra venenatis elit in dignissim. Nullam ullamcorper lectus gravida porttitor maximus. Sed porta dignissim dapibus. Praesent erat orci, gravida non ornare eget, feugiat nec eros. Suspendisse cursus, ex sit amet faucibus porta, turpis lacus congue orci, facilisis mollis lacus ligula lobortis turpis. Nulla at diam non mauris mattis pretium eu id ligula.</p><p>Praesent arcu sem, pretium nec sodales in, cursus vitae lacus. Etiam ac congue libero, vitae tristique libero. Donec suscipit varius sapien, eget condimentum metus ornare eget. Donec vel diam lacinia, condimentum neque vitae, dapibus ipsum. Maecenas ultricies condimentum arcu, sit amet auctor libero imperdiet congue. Sed sit amet sapien ornare, sagittis velit ut, tristique dolor. Sed ultricies molestie mi, in sodales nibh dictum vel. Nullam pulvinar condimentum viverra.</p><p>Sed cursus venenatis nisl sed efficitur. Nunc efficitur, mauris vitae auctor sagittis, arcu augue hendrerit mauris, nec sollicitudin neque augue nec tortor. Proin varius magna massa, a fringilla mi gravida nec. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse eget dui id augue varius sagittis nec id ante. In hac habitasse platea dictumst. Proin vehicula in felis vel commodo. Sed hendrerit ante ac massa tincidunt, eu malesuada mi tempor. Phasellus ligula dui, viverra a enim eget, consectetur gravida urna. Suspendisse id purus ligula.</p><p>Suspendisse elit metus, semper a nisl eu, dictum scelerisque nisi. Mauris nec lacus sit amet ligula rhoncus ornare. Etiam ultricies, orci quis dignissim fermentum, lacus turpis congue odio, eget consectetur nisi lorem quis ex. Aliquam non sem eget purus ultrices accumsan eget eget velit. Mauris ut felis in metus lobortis aliquam et et ipsum. Sed semper justo velit, at suscipit risus molestie ac. Maecenas commodo felis ac varius lobortis. Vivamus posuere consectetur tellus, in aliquet tellus aliquet non. Pellentesque euismod tristique libero et vestibulum. Cras rhoncus auctor neque, a pulvinar diam iaculis sed. Proin sagittis erat eros, et sollicitudin est suscipit bibendum. Curabitur odio dolor, commodo a aliquet vitae, eleifend in mi. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Etiam ut lacinia metus. Nam ut dui vel risus elementum volutpat venenatis id felis.</p><p>In vel tincidunt purus. Integer sed metus nec enim ornare molestie nec et mi. Nam nunc orci, mollis non sem eget, pellentesque bibendum sem. Proin euismod tortor nisl, nec rutrum tellus commodo vel. Maecenas scelerisque mi vel risus dapibus laoreet. Mauris sed ante eu lectus finibus fringilla vitae efficitur massa. Vestibulum ut ante augue. Aenean ut ligula vel nibh convallis aliquam. Phasellus venenatis malesuada consequat. Nunc efficitur mi in tempus feugiat. Nam ac diam egestas, hendrerit augue non, eleifend sem. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nunc non risus vulputate, dictum velit at, consequat ipsum. Aenean varius elit vel sem porta, sit amet suscipit urna convallis. Vivamus vel orci non massa auctor mattis faucibus sed tellus.</p><p>Praesent sodales quam justo, at suscipit tortor fringilla a. Cras risus enim, elementum vel lectus eu, bibendum ornare nibh. Suspendisse faucibus scelerisque odio, eu gravida odio luctus sit amet. Sed scelerisque, ipsum non cursus posuere, magna augue tempor odio, eu faucibus velit felis et tortor. Nullam dapibus massa lacus, et consequat nisl egestas sit amet. Donec porta quis augue sed fringilla. Nunc vel nulla sem.</p><p>Pellentesque dapibus aliquam lacus nec consectetur. Proin quis ex et justo porttitor tempus sed a ante. Curabitur eu est et magna sollicitudin bibendum. Proin ac quam quis mi scelerisque feugiat id eu ligula. Maecenas vehicula dignissim nibh ac commodo. Vivamus commodo posuere ante sed volutpat. Donec luctus, arcu laoreet porttitor aliquam, ligula velit congue urna, vestibulum vehicula ligula arcu ac quam. Nulla quis mauris vitae ligula tincidunt malesuada sed ut ipsum. Sed viverra tellus sed nisi venenatis maximus. Donec egestas metus vestibulum dignissim fringilla. Vivamus iaculis suscipit mollis.</p><p>In vel mi dapibus, porttitor mi eget, ullamcorper mi. Nullam non tempor tortor. Aliquam aliquet sem rhoncus maximus fermentum. Sed dapibus condimentum varius. Etiam tempor nisi ante, ac volutpat lectus ullamcorper eu. Nam rutrum mollis est quis blandit. Pellentesque et tristique justo. Fusce lobortis lacus id eros consectetur pulvinar. Cras finibus nisl diam, ut facilisis massa vestibulum sed. Nam pharetra eu ex in laoreet. Cras aliquam nulla id mattis suscipit. Curabitur tincidunt quam in ullamcorper convallis. In tristique justo ultricies nibh ultrices, placerat auctor lorem pulvinar. Aenean tempor placerat tempus. Pellentesque faucibus enim metus, id aliquam purus porta quis.</p><p>Etiam scelerisque dignissim ex et commodo. Donec id sem viverra, mattis magna ut, malesuada justo. Nulla lobortis turpis lacus, luctus varius risus eleifend et. Vestibulum dapibus auctor nisi, ut condimentum enim iaculis quis. Sed lorem sem, tempor id sodales at, ultrices a leo. Cras aliquam consequat sapien vel viverra. Aenean at arcu vitae metus condimentum convallis. Proin porta turpis nec massa cursus, vel sollicitudin massa finibus.</p><p>Donec eu nisl vulputate, lacinia tellus ac, condimentum magna. Donec dui nunc, fermentum sit amet velit sed, accumsan maximus quam. Sed aliquam risus sit amet consequat scelerisque. Aliquam vel diam arcu. Integer porttitor lorem sit amet metus blandit pharetra. Integer scelerisque lacinia nisl at rhoncus. Sed ut aliquam velit.</p><p>Curabitur suscipit enim velit, vitae luctus eros faucibus blandit. Donec ipsum quam, pharetra eget volutpat suscipit, auctor a arcu. Donec semper diam interdum dui rhoncus, ut vehicula risus faucibus. Fusce blandit laoreet facilisis. Sed rhoncus dolor tortor, vitae egestas risus ultrices quis. Donec rhoncus quam at leo lacinia efficitur. Phasellus at bibendum nibh. Etiam euismod auctor dui facilisis sodales. Praesent dapibus nibh non ipsum hendrerit sodales. Sed ullamcorper venenatis erat in pellentesque. Nulla suscipit porttitor consectetur.</p><p>Vivamus condimentum molestie mollis. Nunc justo sem, scelerisque ut magna sed, luctus vehicula nunc. Nulla id pulvinar sapien. Donec vehicula maximus nulla id pharetra. Mauris neque ipsum, aliquet vitae dui ut, dignissim venenatis arcu. Curabitur gravida, odio nec mollis tincidunt, lectus nisl egestas nulla, sit amet ultricies leo enim a lectus. Pellentesque tincidunt condimentum ultricies. Morbi quis luctus est. Mauris nunc ligula, efficitur tincidunt mollis vel, porttitor quis urna. Phasellus neque erat, pulvinar in nunc vel, tincidunt pharetra libero. Morbi rhoncus dui a malesuada vehicula.</p><p>Fusce ornare tellus et nisl rutrum bibendum. Quisque cursus lacus non turpis semper auctor. Quisque convallis enim nec turpis fermentum, eget elementum erat tempus. Ut scelerisque ante vel risus sagittis, vel accumsan neque elementum. Integer tellus eros, maximus sed felis vitae, tincidunt maximus diam. Quisque pellentesque, sapien sit amet posuere pharetra, nisi quam pharetra nulla, vel venenatis ante sem pretium neque. In hac habitasse platea dictumst. Nam non tempor lectus, eget ultricies turpis. Maecenas eu vehicula urna. Fusce tempor id tellus non pellentesque. Etiam tincidunt, arcu fringilla semper vulputate, quam eros luctus ipsum, dignissim sodales enim ligula sit amet nunc.</p><p>Ut at molestie nibh, quis accumsan mi. Nullam viverra eros non volutpat faucibus. Quisque nec auctor felis. Nam id vulputate felis. Ut finibus, urna et eleifend rhoncus, erat odio gravida enim, efficitur facilisis nulla nisi ultrices dui. Nam at ultricies odio. In elementum nisi sed mi interdum, ut lacinia metus pellentesque. Nulla facilisi. Curabitur porttitor interdum turpis at porta. Pellentesque sagittis pellentesque erat, sed congue purus rhoncus eget. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Cras aliquet nisl ante, suscipit fringilla nunc aliquet et.</p><p>Donec lobortis sem eu est elementum, vel mollis lorem placerat. Quisque pellentesque laoreet dui, ut vestibulum justo ullamcorper quis. Pellentesque ut urna nec ante commodo ultricies. Maecenas ut nisi id velit commodo eleifend. Sed iaculis neque mauris, eget congue massa fermentum eget. Proin feugiat dolor quis lectus tristique pretium. Sed mattis metus eget felis ultricies vehicula. Mauris scelerisque maximus enim ac efficitur. Aliquam erat volutpat. Praesent gravida sit amet leo sit amet luctus. Nulla facilisi. Vivamus lacinia eu nisi sed semper.</p><p>Aenean urna lectus, tincidunt ut felis ut, auctor maximus nulla. Nunc cursus mauris ut ante semper, quis placerat est porta. Nam vitae euismod nibh. Nunc libero mauris, volutpat sit amet nisi vel, volutpat consequat magna. Aliquam convallis, augue eu pharetra dignissim, ante justo porttitor purus, eget aliquam magna dolor a turpis. Mauris blandit sit amet neque sed egestas. Nam quis sem nisi. Mauris consequat lacinia metus, a egestas sem imperdiet nec. In aliquet leo felis, nec pellentesque dui vestibulum sed. Interdum et malesuada fames ac ante ipsum primis in faucibus.</p><p>Morbi dapibus, turpis vel dapibus ornare, enim mauris interdum est, eget molestie mi odio ut quam. Curabitur sed justo lectus. Vivamus vehicula, leo vel ullamcorper venenatis, ipsum odio faucibus turpis, at venenatis eros augue vel leo. Suspendisse mattis, massa sed interdum faucibus, nisi diam consequat arcu, et blandit lectus augue facilisis lectus. Sed cursus eros eu augue placerat porta. Donec dapibus quam ut tortor sollicitudin, non convallis felis aliquam. Suspendisse porta dignissim mattis. Aenean suscipit vitae diam ac convallis. Fusce a mollis metus. Duis auctor cursus magna, mollis dapibus magna lacinia id.</p><p>In sed aliquam libero. Cras semper, libero eu malesuada efficitur, augue leo faucibus tellus, in iaculis augue libero non lacus. Proin in euismod ante. Donec fermentum lectus vel luctus sollicitudin. Phasellus efficitur pulvinar ornare. In ullamcorper mauris elit, quis consectetur diam varius sit amet. Ut facilisis turpis nec magna porttitor, quis ornare metus tincidunt. Duis mattis volutpat neque vitae luctus. Suspendisse a tellus diam. Donec sem sem, dapibus vitae euismod id, aliquet a est. In mollis congue ornare. Etiam imperdiet, nunc a mollis malesuada, tellus erat hendrerit ligula, id vehicula dui lorem lacinia tortor. Cras iaculis mattis gravida. Sed fermentum ex leo, eu euismod tellus laoreet non.</p><p>Nulla ullamcorper nisi lobortis, bibendum ante ut, suscipit quam. Donec rutrum mattis erat, et hendrerit libero finibus a. In fringilla ante vitae cursus rutrum. In hac habitasse platea dictumst. Duis sed ipsum mi. Pellentesque vitae lacinia justo. In euismod diam non tortor vestibulum varius. Proin varius tincidunt est quis sagittis. In non arcu vitae ex efficitur dictum. Quisque enim sem, iaculis a nibh et, vulputate accumsan tortor. Proin porttitor accumsan odio eu pharetra. Phasellus in magna vitae est egestas rutrum. Curabitur vel purus sit amet nisi varius tristique pulvinar ut orci. Curabitur id aliquam dui. Cras dictum scelerisque turpis, semper vulputate augue euismod vitae. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>', '06-12-2021 11:37:05 pm'),
(2, 'Terms & Conditions', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In iaculis nibh sed mi accumsan consequat. Ut vitae felis sed velit mattis consectetur rutrum quis turpis. Nam rhoncus erat a orci ornare accumsan. Sed non nisi et mauris porttitor porta a id eros. Cras nec imperdiet mi. Sed et feugiat lacus, eu facilisis eros. Phasellus dictum orci ac accumsan finibus. Phasellus ac sapien eu erat convallis fermentum. Morbi enim massa, porta et tortor id, pharetra dignissim velit.</p><p>Donec sed iaculis dolor, eu posuere tortor. Cras pharetra venenatis elit in dignissim. Nullam ullamcorper lectus gravida porttitor maximus. Sed porta dignissim dapibus. Praesent erat orci, gravida non ornare eget, feugiat nec eros. Suspendisse cursus, ex sit amet faucibus porta, turpis lacus congue orci, facilisis mollis lacus ligula lobortis turpis. Nulla at diam non mauris mattis pretium eu id ligula.</p><p>Praesent arcu sem, pretium nec sodales in, cursus vitae lacus. Etiam ac congue libero, vitae tristique libero. Donec suscipit varius sapien, eget condimentum metus ornare eget. Donec vel diam lacinia, condimentum neque vitae, dapibus ipsum. Maecenas ultricies condimentum arcu, sit amet auctor libero imperdiet congue. Sed sit amet sapien ornare, sagittis velit ut, tristique dolor. Sed ultricies molestie mi, in sodales nibh dictum vel. Nullam pulvinar condimentum viverra.</p><p>Sed cursus venenatis nisl sed efficitur. Nunc efficitur, mauris vitae auctor sagittis, arcu augue hendrerit mauris, nec sollicitudin neque augue nec tortor. Proin varius magna massa, a fringilla mi gravida nec. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse eget dui id augue varius sagittis nec id ante. In hac habitasse platea dictumst. Proin vehicula in felis vel commodo. Sed hendrerit ante ac massa tincidunt, eu malesuada mi tempor. Phasellus ligula dui, viverra a enim eget, consectetur gravida urna. Suspendisse id purus ligula.</p><p>Suspendisse elit metus, semper a nisl eu, dictum scelerisque nisi. Mauris nec lacus sit amet ligula rhoncus ornare. Etiam ultricies, orci quis dignissim fermentum, lacus turpis congue odio, eget consectetur nisi lorem quis ex. Aliquam non sem eget purus ultrices accumsan eget eget velit. Mauris ut felis in metus lobortis aliquam et et ipsum. Sed semper justo velit, at suscipit risus molestie ac. Maecenas commodo felis ac varius lobortis. Vivamus posuere consectetur tellus, in aliquet tellus aliquet non. Pellentesque euismod tristique libero et vestibulum. Cras rhoncus auctor neque, a pulvinar diam iaculis sed. Proin sagittis erat eros, et sollicitudin est suscipit bibendum. Curabitur odio dolor, commodo a aliquet vitae, eleifend in mi. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Etiam ut lacinia metus. Nam ut dui vel risus elementum volutpat venenatis id felis.</p><p>In vel tincidunt purus. Integer sed metus nec enim ornare molestie nec et mi. Nam nunc orci, mollis non sem eget, pellentesque bibendum sem. Proin euismod tortor nisl, nec rutrum tellus commodo vel. Maecenas scelerisque mi vel risus dapibus laoreet. Mauris sed ante eu lectus finibus fringilla vitae efficitur massa. Vestibulum ut ante augue. Aenean ut ligula vel nibh convallis aliquam. Phasellus venenatis malesuada consequat. Nunc efficitur mi in tempus feugiat. Nam ac diam egestas, hendrerit augue non, eleifend sem. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nunc non risus vulputate, dictum velit at, consequat ipsum. Aenean varius elit vel sem porta, sit amet suscipit urna convallis. Vivamus vel orci non massa auctor mattis faucibus sed tellus.</p><p>Praesent sodales quam justo, at suscipit tortor fringilla a. Cras risus enim, elementum vel lectus eu, bibendum ornare nibh. Suspendisse faucibus scelerisque odio, eu gravida odio luctus sit amet. Sed scelerisque, ipsum non cursus posuere, magna augue tempor odio, eu faucibus velit felis et tortor. Nullam dapibus massa lacus, et consequat nisl egestas sit amet. Donec porta quis augue sed fringilla. Nunc vel nulla sem.</p><p>Pellentesque dapibus aliquam lacus nec consectetur. Proin quis ex et justo porttitor tempus sed a ante. Curabitur eu est et magna sollicitudin bibendum. Proin ac quam quis mi scelerisque feugiat id eu ligula. Maecenas vehicula dignissim nibh ac commodo. Vivamus commodo posuere ante sed volutpat. Donec luctus, arcu laoreet porttitor aliquam, ligula velit congue urna, vestibulum vehicula ligula arcu ac quam. Nulla quis mauris vitae ligula tincidunt malesuada sed ut ipsum. Sed viverra tellus sed nisi venenatis maximus. Donec egestas metus vestibulum dignissim fringilla. Vivamus iaculis suscipit mollis.</p><p>In vel mi dapibus, porttitor mi eget, ullamcorper mi. Nullam non tempor tortor. Aliquam aliquet sem rhoncus maximus fermentum. Sed dapibus condimentum varius. Etiam tempor nisi ante, ac volutpat lectus ullamcorper eu. Nam rutrum mollis est quis blandit. Pellentesque et tristique justo. Fusce lobortis lacus id eros consectetur pulvinar. Cras finibus nisl diam, ut facilisis massa vestibulum sed. Nam pharetra eu ex in laoreet. Cras aliquam nulla id mattis suscipit. Curabitur tincidunt quam in ullamcorper convallis. In tristique justo ultricies nibh ultrices, placerat auctor lorem pulvinar. Aenean tempor placerat tempus. Pellentesque faucibus enim metus, id aliquam purus porta quis.</p><p>Etiam scelerisque dignissim ex et commodo. Donec id sem viverra, mattis magna ut, malesuada justo. Nulla lobortis turpis lacus, luctus varius risus eleifend et. Vestibulum dapibus auctor nisi, ut condimentum enim iaculis quis. Sed lorem sem, tempor id sodales at, ultrices a leo. Cras aliquam consequat sapien vel viverra. Aenean at arcu vitae metus condimentum convallis. Proin porta turpis nec massa cursus, vel sollicitudin massa finibus.</p><p>Donec eu nisl vulputate, lacinia tellus ac, condimentum magna. Donec dui nunc, fermentum sit amet velit sed, accumsan maximus quam. Sed aliquam risus sit amet consequat scelerisque. Aliquam vel diam arcu. Integer porttitor lorem sit amet metus blandit pharetra. Integer scelerisque lacinia nisl at rhoncus. Sed ut aliquam velit.</p><p>Curabitur suscipit enim velit, vitae luctus eros faucibus blandit. Donec ipsum quam, pharetra eget volutpat suscipit, auctor a arcu. Donec semper diam interdum dui rhoncus, ut vehicula risus faucibus. Fusce blandit laoreet facilisis. Sed rhoncus dolor tortor, vitae egestas risus ultrices quis. Donec rhoncus quam at leo lacinia efficitur. Phasellus at bibendum nibh. Etiam euismod auctor dui facilisis sodales. Praesent dapibus nibh non ipsum hendrerit sodales. Sed ullamcorper venenatis erat in pellentesque. Nulla suscipit porttitor consectetur.</p><p>Vivamus condimentum molestie mollis. Nunc justo sem, scelerisque ut magna sed, luctus vehicula nunc. Nulla id pulvinar sapien. Donec vehicula maximus nulla id pharetra. Mauris neque ipsum, aliquet vitae dui ut, dignissim venenatis arcu. Curabitur gravida, odio nec mollis tincidunt, lectus nisl egestas nulla, sit amet ultricies leo enim a lectus. Pellentesque tincidunt condimentum ultricies. Morbi quis luctus est. Mauris nunc ligula, efficitur tincidunt mollis vel, porttitor quis urna. Phasellus neque erat, pulvinar in nunc vel, tincidunt pharetra libero. Morbi rhoncus dui a malesuada vehicula.</p><p>Fusce ornare tellus et nisl rutrum bibendum. Quisque cursus lacus non turpis semper auctor. Quisque convallis enim nec turpis fermentum, eget elementum erat tempus. Ut scelerisque ante vel risus sagittis, vel accumsan neque elementum. Integer tellus eros, maximus sed felis vitae, tincidunt maximus diam. Quisque pellentesque, sapien sit amet posuere pharetra, nisi quam pharetra nulla, vel venenatis ante sem pretium neque. In hac habitasse platea dictumst. Nam non tempor lectus, eget ultricies turpis. Maecenas eu vehicula urna. Fusce tempor id tellus non pellentesque. Etiam tincidunt, arcu fringilla semper vulputate, quam eros luctus ipsum, dignissim sodales enim ligula sit amet nunc.</p><p>Ut at molestie nibh, quis accumsan mi. Nullam viverra eros non volutpat faucibus. Quisque nec auctor felis. Nam id vulputate felis. Ut finibus, urna et eleifend rhoncus, erat odio gravida enim, efficitur facilisis nulla nisi ultrices dui. Nam at ultricies odio. In elementum nisi sed mi interdum, ut lacinia metus pellentesque. Nulla facilisi. Curabitur porttitor interdum turpis at porta. Pellentesque sagittis pellentesque erat, sed congue purus rhoncus eget. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Cras aliquet nisl ante, suscipit fringilla nunc aliquet et.</p><p>Donec lobortis sem eu est elementum, vel mollis lorem placerat. Quisque pellentesque laoreet dui, ut vestibulum justo ullamcorper quis. Pellentesque ut urna nec ante commodo ultricies. Maecenas ut nisi id velit commodo eleifend. Sed iaculis neque mauris, eget congue massa fermentum eget. Proin feugiat dolor quis lectus tristique pretium. Sed mattis metus eget felis ultricies vehicula. Mauris scelerisque maximus enim ac efficitur. Aliquam erat volutpat. Praesent gravida sit amet leo sit amet luctus. Nulla facilisi. Vivamus lacinia eu nisi sed semper.</p><p>Aenean urna lectus, tincidunt ut felis ut, auctor maximus nulla. Nunc cursus mauris ut ante semper, quis placerat est porta. Nam vitae euismod nibh. Nunc libero mauris, volutpat sit amet nisi vel, volutpat consequat magna. Aliquam convallis, augue eu pharetra dignissim, ante justo porttitor purus, eget aliquam magna dolor a turpis. Mauris blandit sit amet neque sed egestas. Nam quis sem nisi. Mauris consequat lacinia metus, a egestas sem imperdiet nec. In aliquet leo felis, nec pellentesque dui vestibulum sed. Interdum et malesuada fames ac ante ipsum primis in faucibus.</p><p>Morbi dapibus, turpis vel dapibus ornare, enim mauris interdum est, eget molestie mi odio ut quam. Curabitur sed justo lectus. Vivamus vehicula, leo vel ullamcorper venenatis, ipsum odio faucibus turpis, at venenatis eros augue vel leo. Suspendisse mattis, massa sed interdum faucibus, nisi diam consequat arcu, et blandit lectus augue facilisis lectus. Sed cursus eros eu augue placerat porta. Donec dapibus quam ut tortor sollicitudin, non convallis felis aliquam. Suspendisse porta dignissim mattis. Aenean suscipit vitae diam ac convallis. Fusce a mollis metus. Duis auctor cursus magna, mollis dapibus magna lacinia id.</p><p>In sed aliquam libero. Cras semper, libero eu malesuada efficitur, augue leo faucibus tellus, in iaculis augue libero non lacus. Proin in euismod ante. Donec fermentum lectus vel luctus sollicitudin. Phasellus efficitur pulvinar ornare. In ullamcorper mauris elit, quis consectetur diam varius sit amet. Ut facilisis turpis nec magna porttitor, quis ornare metus tincidunt. Duis mattis volutpat neque vitae luctus. Suspendisse a tellus diam. Donec sem sem, dapibus vitae euismod id, aliquet a est. In mollis congue ornare. Etiam imperdiet, nunc a mollis malesuada, tellus erat hendrerit ligula, id vehicula dui lorem lacinia tortor. Cras iaculis mattis gravida. Sed fermentum ex leo, eu euismod tellus laoreet non.</p><p>Nulla ullamcorper nisi lobortis, bibendum ante ut, suscipit quam. Donec rutrum mattis erat, et hendrerit libero finibus a. In fringilla ante vitae cursus rutrum. In hac habitasse platea dictumst. Duis sed ipsum mi. Pellentesque vitae lacinia justo. In euismod diam non tortor vestibulum varius. Proin varius tincidunt est quis sagittis. In non arcu vitae ex efficitur dictum. Quisque enim sem, iaculis a nibh et, vulputate accumsan tortor. Proin porttitor accumsan odio eu pharetra. Phasellus in magna vitae est egestas rutrum. Curabitur vel purus sit amet nisi varius tristique pulvinar ut orci. Curabitur id aliquam dui. Cras dictum scelerisque turpis, semper vulputate augue euismod vitae. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>', '07-12-2021 12:04:10 am'),
(3, 'About Us', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In iaculis nibh sed mi accumsan consequat. Ut vitae felis sed velit mattis consectetur rutrum quis turpis. Nam rhoncus erat a orci ornare accumsan. Sed non nisi et mauris porttitor porta a id eros. Cras nec imperdiet mi. Sed et feugiat lacus, eu facilisis eros. Phasellus dictum orci ac accumsan finibus. Phasellus ac sapien eu erat convallis fermentum. Morbi enim massa, porta et tortor id, pharetra dignissim velit.</p><p>Donec sed iaculis dolor, eu posuere tortor. Cras pharetra venenatis elit in dignissim. Nullam ullamcorper lectus gravida porttitor maximus. Sed porta dignissim dapibus. Praesent erat orci, gravida non ornare eget, feugiat nec eros. Suspendisse cursus, ex sit amet faucibus porta, turpis lacus congue orci, facilisis mollis lacus ligula lobortis turpis. Nulla at diam non mauris mattis pretium eu id ligula.</p><p>Praesent arcu sem, pretium nec sodales in, cursus vitae lacus. Etiam ac congue libero, vitae tristique libero. Donec suscipit varius sapien, eget condimentum metus ornare eget. Donec vel diam lacinia, condimentum neque vitae, dapibus ipsum. Maecenas ultricies condimentum arcu, sit amet auctor libero imperdiet congue. Sed sit amet sapien ornare, sagittis velit ut, tristique dolor. Sed ultricies molestie mi, in sodales nibh dictum vel. Nullam pulvinar condimentum viverra.</p><p>Sed cursus venenatis nisl sed efficitur. Nunc efficitur, mauris vitae auctor sagittis, arcu augue hendrerit mauris, nec sollicitudin neque augue nec tortor. Proin varius magna massa, a fringilla mi gravida nec. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse eget dui id augue varius sagittis nec id ante. In hac habitasse platea dictumst. Proin vehicula in felis vel commodo. Sed hendrerit ante ac massa tincidunt, eu malesuada mi tempor. Phasellus ligula dui, viverra a enim eget, consectetur gravida urna. Suspendisse id purus ligula.</p><p>Suspendisse elit metus, semper a nisl eu, dictum scelerisque nisi. Mauris nec lacus sit amet ligula rhoncus ornare. Etiam ultricies, orci quis dignissim fermentum, lacus turpis congue odio, eget consectetur nisi lorem quis ex. Aliquam non sem eget purus ultrices accumsan eget eget velit. Mauris ut felis in metus lobortis aliquam et et ipsum. Sed semper justo velit, at suscipit risus molestie ac. Maecenas commodo felis ac varius lobortis. Vivamus posuere consectetur tellus, in aliquet tellus aliquet non. Pellentesque euismod tristique libero et vestibulum. Cras rhoncus auctor neque, a pulvinar diam iaculis sed. Proin sagittis erat eros, et sollicitudin est suscipit bibendum. Curabitur odio dolor, commodo a aliquet vitae, eleifend in mi. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Etiam ut lacinia metus. Nam ut dui vel risus elementum volutpat venenatis id felis.</p><p>In vel tincidunt purus. Integer sed metus nec enim ornare molestie nec et mi. Nam nunc orci, mollis non sem eget, pellentesque bibendum sem. Proin euismod tortor nisl, nec rutrum tellus commodo vel. Maecenas scelerisque mi vel risus dapibus laoreet. Mauris sed ante eu lectus finibus fringilla vitae efficitur massa. Vestibulum ut ante augue. Aenean ut ligula vel nibh convallis aliquam. Phasellus venenatis malesuada consequat. Nunc efficitur mi in tempus feugiat. Nam ac diam egestas, hendrerit augue non, eleifend sem. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nunc non risus vulputate, dictum velit at, consequat ipsum. Aenean varius elit vel sem porta, sit amet suscipit urna convallis. Vivamus vel orci non massa auctor mattis faucibus sed tellus.</p><p>Praesent sodales quam justo, at suscipit tortor fringilla a. Cras risus enim, elementum vel lectus eu, bibendum ornare nibh. Suspendisse faucibus scelerisque odio, eu gravida odio luctus sit amet. Sed scelerisque, ipsum non cursus posuere, magna augue tempor odio, eu faucibus velit felis et tortor. Nullam dapibus massa lacus, et consequat nisl egestas sit amet. Donec porta quis augue sed fringilla. Nunc vel nulla sem.</p><p>Pellentesque dapibus aliquam lacus nec consectetur. Proin quis ex et justo porttitor tempus sed a ante. Curabitur eu est et magna sollicitudin bibendum. Proin ac quam quis mi scelerisque feugiat id eu ligula. Maecenas vehicula dignissim nibh ac commodo. Vivamus commodo posuere ante sed volutpat. Donec luctus, arcu laoreet porttitor aliquam, ligula velit congue urna, vestibulum vehicula ligula arcu ac quam. Nulla quis mauris vitae ligula tincidunt malesuada sed ut ipsum. Sed viverra tellus sed nisi venenatis maximus. Donec egestas metus vestibulum dignissim fringilla. Vivamus iaculis suscipit mollis.</p><p>In vel mi dapibus, porttitor mi eget, ullamcorper mi. Nullam non tempor tortor. Aliquam aliquet sem rhoncus maximus fermentum. Sed dapibus condimentum varius. Etiam tempor nisi ante, ac volutpat lectus ullamcorper eu. Nam rutrum mollis est quis blandit. Pellentesque et tristique justo. Fusce lobortis lacus id eros consectetur pulvinar. Cras finibus nisl diam, ut facilisis massa vestibulum sed. Nam pharetra eu ex in laoreet. Cras aliquam nulla id mattis suscipit. Curabitur tincidunt quam in ullamcorper convallis. In tristique justo ultricies nibh ultrices, placerat auctor lorem pulvinar. Aenean tempor placerat tempus. Pellentesque faucibus enim metus, id aliquam purus porta quis.</p><p>Etiam scelerisque dignissim ex et commodo. Donec id sem viverra, mattis magna ut, malesuada justo. Nulla lobortis turpis lacus, luctus varius risus eleifend et. Vestibulum dapibus auctor nisi, ut condimentum enim iaculis quis. Sed lorem sem, tempor id sodales at, ultrices a leo. Cras aliquam consequat sapien vel viverra. Aenean at arcu vitae metus condimentum convallis. Proin porta turpis nec massa cursus, vel sollicitudin massa finibus.</p><p>Donec eu nisl vulputate, lacinia tellus ac, condimentum magna. Donec dui nunc, fermentum sit amet velit sed, accumsan maximus quam. Sed aliquam risus sit amet consequat scelerisque. Aliquam vel diam arcu. Integer porttitor lorem sit amet metus blandit pharetra. Integer scelerisque lacinia nisl at rhoncus. Sed ut aliquam velit.</p><p>Curabitur suscipit enim velit, vitae luctus eros faucibus blandit. Donec ipsum quam, pharetra eget volutpat suscipit, auctor a arcu. Donec semper diam interdum dui rhoncus, ut vehicula risus faucibus. Fusce blandit laoreet facilisis. Sed rhoncus dolor tortor, vitae egestas risus ultrices quis. Donec rhoncus quam at leo lacinia efficitur. Phasellus at bibendum nibh. Etiam euismod auctor dui facilisis sodales. Praesent dapibus nibh non ipsum hendrerit sodales. Sed ullamcorper venenatis erat in pellentesque. Nulla suscipit porttitor consectetur.</p><p>Vivamus condimentum molestie mollis. Nunc justo sem, scelerisque ut magna sed, luctus vehicula nunc. Nulla id pulvinar sapien. Donec vehicula maximus nulla id pharetra. Mauris neque ipsum, aliquet vitae dui ut, dignissim venenatis arcu. Curabitur gravida, odio nec mollis tincidunt, lectus nisl egestas nulla, sit amet ultricies leo enim a lectus. Pellentesque tincidunt condimentum ultricies. Morbi quis luctus est. Mauris nunc ligula, efficitur tincidunt mollis vel, porttitor quis urna. Phasellus neque erat, pulvinar in nunc vel, tincidunt pharetra libero. Morbi rhoncus dui a malesuada vehicula.</p><p>Fusce ornare tellus et nisl rutrum bibendum. Quisque cursus lacus non turpis semper auctor. Quisque convallis enim nec turpis fermentum, eget elementum erat tempus. Ut scelerisque ante vel risus sagittis, vel accumsan neque elementum. Integer tellus eros, maximus sed felis vitae, tincidunt maximus diam. Quisque pellentesque, sapien sit amet posuere pharetra, nisi quam pharetra nulla, vel venenatis ante sem pretium neque. In hac habitasse platea dictumst. Nam non tempor lectus, eget ultricies turpis. Maecenas eu vehicula urna. Fusce tempor id tellus non pellentesque. Etiam tincidunt, arcu fringilla semper vulputate, quam eros luctus ipsum, dignissim sodales enim ligula sit amet nunc.</p><p>Ut at molestie nibh, quis accumsan mi. Nullam viverra eros non volutpat faucibus. Quisque nec auctor felis. Nam id vulputate felis. Ut finibus, urna et eleifend rhoncus, erat odio gravida enim, efficitur facilisis nulla nisi ultrices dui. Nam at ultricies odio. In elementum nisi sed mi interdum, ut lacinia metus pellentesque. Nulla facilisi. Curabitur porttitor interdum turpis at porta. Pellentesque sagittis pellentesque erat, sed congue purus rhoncus eget. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Cras aliquet nisl ante, suscipit fringilla nunc aliquet et.</p><p>Donec lobortis sem eu est elementum, vel mollis lorem placerat. Quisque pellentesque laoreet dui, ut vestibulum justo ullamcorper quis. Pellentesque ut urna nec ante commodo ultricies. Maecenas ut nisi id velit commodo eleifend. Sed iaculis neque mauris, eget congue massa fermentum eget. Proin feugiat dolor quis lectus tristique pretium. Sed mattis metus eget felis ultricies vehicula. Mauris scelerisque maximus enim ac efficitur. Aliquam erat volutpat. Praesent gravida sit amet leo sit amet luctus. Nulla facilisi. Vivamus lacinia eu nisi sed semper.</p><p>Aenean urna lectus, tincidunt ut felis ut, auctor maximus nulla. Nunc cursus mauris ut ante semper, quis placerat est porta. Nam vitae euismod nibh. Nunc libero mauris, volutpat sit amet nisi vel, volutpat consequat magna. Aliquam convallis, augue eu pharetra dignissim, ante justo porttitor purus, eget aliquam magna dolor a turpis. Mauris blandit sit amet neque sed egestas. Nam quis sem nisi. Mauris consequat lacinia metus, a egestas sem imperdiet nec. In aliquet leo felis, nec pellentesque dui vestibulum sed. Interdum et malesuada fames ac ante ipsum primis in faucibus.</p><p>Morbi dapibus, turpis vel dapibus ornare, enim mauris interdum est, eget molestie mi odio ut quam. Curabitur sed justo lectus. Vivamus vehicula, leo vel ullamcorper venenatis, ipsum odio faucibus turpis, at venenatis eros augue vel leo. Suspendisse mattis, massa sed interdum faucibus, nisi diam consequat arcu, et blandit lectus augue facilisis lectus. Sed cursus eros eu augue placerat porta. Donec dapibus quam ut tortor sollicitudin, non convallis felis aliquam. Suspendisse porta dignissim mattis. Aenean suscipit vitae diam ac convallis. Fusce a mollis metus. Duis auctor cursus magna, mollis dapibus magna lacinia id.</p><p>In sed aliquam libero. Cras semper, libero eu malesuada efficitur, augue leo faucibus tellus, in iaculis augue libero non lacus. Proin in euismod ante. Donec fermentum lectus vel luctus sollicitudin. Phasellus efficitur pulvinar ornare. In ullamcorper mauris elit, quis consectetur diam varius sit amet. Ut facilisis turpis nec magna porttitor, quis ornare metus tincidunt. Duis mattis volutpat neque vitae luctus. Suspendisse a tellus diam. Donec sem sem, dapibus vitae euismod id, aliquet a est. In mollis congue ornare. Etiam imperdiet, nunc a mollis malesuada, tellus erat hendrerit ligula, id vehicula dui lorem lacinia tortor. Cras iaculis mattis gravida. Sed fermentum ex leo, eu euismod tellus laoreet non.</p><p>Nulla ullamcorper nisi lobortis, bibendum ante ut, suscipit quam. Donec rutrum mattis erat, et hendrerit libero finibus a. In fringilla ante vitae cursus rutrum. In hac habitasse platea dictumst. Duis sed ipsum mi. Pellentesque vitae lacinia justo. In euismod diam non tortor vestibulum varius. Proin varius tincidunt est quis sagittis. In non arcu vitae ex efficitur dictum. Quisque enim sem, iaculis a nibh et, vulputate accumsan tortor. Proin porttitor accumsan odio eu pharetra. Phasellus in magna vitae est egestas rutrum. Curabitur vel purus sit amet nisi varius tristique pulvinar ut orci. Curabitur id aliquam dui. Cras dictum scelerisque turpis, semper vulputate augue euismod vitae. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>', '06-12-2021 11:33:33 pm'),
(4, 'Refund Policy', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In iaculis nibh sed mi accumsan consequat. Ut vitae felis sed velit mattis consectetur rutrum quis turpis. Nam rhoncus erat a orci ornare accumsan. Sed non nisi et mauris porttitor porta a id eros. Cras nec imperdiet mi. Sed et feugiat lacus, eu facilisis eros. Phasellus dictum orci ac accumsan finibus. Phasellus ac sapien eu erat convallis fermentum. Morbi enim massa, porta et tortor id, pharetra dignissim velit.</p><p>Donec sed iaculis dolor, eu posuere tortor. Cras pharetra venenatis elit in dignissim. Nullam ullamcorper lectus gravida porttitor maximus. Sed porta dignissim dapibus. Praesent erat orci, gravida non ornare eget, feugiat nec eros. Suspendisse cursus, ex sit amet faucibus porta, turpis lacus congue orci, facilisis mollis lacus ligula lobortis turpis. Nulla at diam non mauris mattis pretium eu id ligula.</p><p>Praesent arcu sem, pretium nec sodales in, cursus vitae lacus. Etiam ac congue libero, vitae tristique libero. Donec suscipit varius sapien, eget condimentum metus ornare eget. Donec vel diam lacinia, condimentum neque vitae, dapibus ipsum. Maecenas ultricies condimentum arcu, sit amet auctor libero imperdiet congue. Sed sit amet sapien ornare, sagittis velit ut, tristique dolor. Sed ultricies molestie mi, in sodales nibh dictum vel. Nullam pulvinar condimentum viverra.</p><p>Sed cursus venenatis nisl sed efficitur. Nunc efficitur, mauris vitae auctor sagittis, arcu augue hendrerit mauris, nec sollicitudin neque augue nec tortor. Proin varius magna massa, a fringilla mi gravida nec. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse eget dui id augue varius sagittis nec id ante. In hac habitasse platea dictumst. Proin vehicula in felis vel commodo. Sed hendrerit ante ac massa tincidunt, eu malesuada mi tempor. Phasellus ligula dui, viverra a enim eget, consectetur gravida urna. Suspendisse id purus ligula.</p><p>Suspendisse elit metus, semper a nisl eu, dictum scelerisque nisi. Mauris nec lacus sit amet ligula rhoncus ornare. Etiam ultricies, orci quis dignissim fermentum, lacus turpis congue odio, eget consectetur nisi lorem quis ex. Aliquam non sem eget purus ultrices accumsan eget eget velit. Mauris ut felis in metus lobortis aliquam et et ipsum. Sed semper justo velit, at suscipit risus molestie ac. Maecenas commodo felis ac varius lobortis. Vivamus posuere consectetur tellus, in aliquet tellus aliquet non. Pellentesque euismod tristique libero et vestibulum. Cras rhoncus auctor neque, a pulvinar diam iaculis sed. Proin sagittis erat eros, et sollicitudin est suscipit bibendum. Curabitur odio dolor, commodo a aliquet vitae, eleifend in mi. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Etiam ut lacinia metus. Nam ut dui vel risus elementum volutpat venenatis id felis.</p><p>In vel tincidunt purus. Integer sed metus nec enim ornare molestie nec et mi. Nam nunc orci, mollis non sem eget, pellentesque bibendum sem. Proin euismod tortor nisl, nec rutrum tellus commodo vel. Maecenas scelerisque mi vel risus dapibus laoreet. Mauris sed ante eu lectus finibus fringilla vitae efficitur massa. Vestibulum ut ante augue. Aenean ut ligula vel nibh convallis aliquam. Phasellus venenatis malesuada consequat. Nunc efficitur mi in tempus feugiat. Nam ac diam egestas, hendrerit augue non, eleifend sem. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nunc non risus vulputate, dictum velit at, consequat ipsum. Aenean varius elit vel sem porta, sit amet suscipit urna convallis. Vivamus vel orci non massa auctor mattis faucibus sed tellus.</p><p>Praesent sodales quam justo, at suscipit tortor fringilla a. Cras risus enim, elementum vel lectus eu, bibendum ornare nibh. Suspendisse faucibus scelerisque odio, eu gravida odio luctus sit amet. Sed scelerisque, ipsum non cursus posuere, magna augue tempor odio, eu faucibus velit felis et tortor. Nullam dapibus massa lacus, et consequat nisl egestas sit amet. Donec porta quis augue sed fringilla. Nunc vel nulla sem.</p><p>Pellentesque dapibus aliquam lacus nec consectetur. Proin quis ex et justo porttitor tempus sed a ante. Curabitur eu est et magna sollicitudin bibendum. Proin ac quam quis mi scelerisque feugiat id eu ligula. Maecenas vehicula dignissim nibh ac commodo. Vivamus commodo posuere ante sed volutpat. Donec luctus, arcu laoreet porttitor aliquam, ligula velit congue urna, vestibulum vehicula ligula arcu ac quam. Nulla quis mauris vitae ligula tincidunt malesuada sed ut ipsum. Sed viverra tellus sed nisi venenatis maximus. Donec egestas metus vestibulum dignissim fringilla. Vivamus iaculis suscipit mollis.</p><p>In vel mi dapibus, porttitor mi eget, ullamcorper mi. Nullam non tempor tortor. Aliquam aliquet sem rhoncus maximus fermentum. Sed dapibus condimentum varius. Etiam tempor nisi ante, ac volutpat lectus ullamcorper eu. Nam rutrum mollis est quis blandit. Pellentesque et tristique justo. Fusce lobortis lacus id eros consectetur pulvinar. Cras finibus nisl diam, ut facilisis massa vestibulum sed. Nam pharetra eu ex in laoreet. Cras aliquam nulla id mattis suscipit. Curabitur tincidunt quam in ullamcorper convallis. In tristique justo ultricies nibh ultrices, placerat auctor lorem pulvinar. Aenean tempor placerat tempus. Pellentesque faucibus enim metus, id aliquam purus porta quis.</p><p>Etiam scelerisque dignissim ex et commodo. Donec id sem viverra, mattis magna ut, malesuada justo. Nulla lobortis turpis lacus, luctus varius risus eleifend et. Vestibulum dapibus auctor nisi, ut condimentum enim iaculis quis. Sed lorem sem, tempor id sodales at, ultrices a leo. Cras aliquam consequat sapien vel viverra. Aenean at arcu vitae metus condimentum convallis. Proin porta turpis nec massa cursus, vel sollicitudin massa finibus.</p><p>Donec eu nisl vulputate, lacinia tellus ac, condimentum magna. Donec dui nunc, fermentum sit amet velit sed, accumsan maximus quam. Sed aliquam risus sit amet consequat scelerisque. Aliquam vel diam arcu. Integer porttitor lorem sit amet metus blandit pharetra. Integer scelerisque lacinia nisl at rhoncus. Sed ut aliquam velit.</p><p>Curabitur suscipit enim velit, vitae luctus eros faucibus blandit. Donec ipsum quam, pharetra eget volutpat suscipit, auctor a arcu. Donec semper diam interdum dui rhoncus, ut vehicula risus faucibus. Fusce blandit laoreet facilisis. Sed rhoncus dolor tortor, vitae egestas risus ultrices quis. Donec rhoncus quam at leo lacinia efficitur. Phasellus at bibendum nibh. Etiam euismod auctor dui facilisis sodales. Praesent dapibus nibh non ipsum hendrerit sodales. Sed ullamcorper venenatis erat in pellentesque. Nulla suscipit porttitor consectetur.</p><p>Vivamus condimentum molestie mollis. Nunc justo sem, scelerisque ut magna sed, luctus vehicula nunc. Nulla id pulvinar sapien. Donec vehicula maximus nulla id pharetra. Mauris neque ipsum, aliquet vitae dui ut, dignissim venenatis arcu. Curabitur gravida, odio nec mollis tincidunt, lectus nisl egestas nulla, sit amet ultricies leo enim a lectus. Pellentesque tincidunt condimentum ultricies. Morbi quis luctus est. Mauris nunc ligula, efficitur tincidunt mollis vel, porttitor quis urna. Phasellus neque erat, pulvinar in nunc vel, tincidunt pharetra libero. Morbi rhoncus dui a malesuada vehicula.</p><p>Fusce ornare tellus et nisl rutrum bibendum. Quisque cursus lacus non turpis semper auctor. Quisque convallis enim nec turpis fermentum, eget elementum erat tempus. Ut scelerisque ante vel risus sagittis, vel accumsan neque elementum. Integer tellus eros, maximus sed felis vitae, tincidunt maximus diam. Quisque pellentesque, sapien sit amet posuere pharetra, nisi quam pharetra nulla, vel venenatis ante sem pretium neque. In hac habitasse platea dictumst. Nam non tempor lectus, eget ultricies turpis. Maecenas eu vehicula urna. Fusce tempor id tellus non pellentesque. Etiam tincidunt, arcu fringilla semper vulputate, quam eros luctus ipsum, dignissim sodales enim ligula sit amet nunc.</p><p>Ut at molestie nibh, quis accumsan mi. Nullam viverra eros non volutpat faucibus. Quisque nec auctor felis. Nam id vulputate felis. Ut finibus, urna et eleifend rhoncus, erat odio gravida enim, efficitur facilisis nulla nisi ultrices dui. Nam at ultricies odio. In elementum nisi sed mi interdum, ut lacinia metus pellentesque. Nulla facilisi. Curabitur porttitor interdum turpis at porta. Pellentesque sagittis pellentesque erat, sed congue purus rhoncus eget. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Cras aliquet nisl ante, suscipit fringilla nunc aliquet et.</p><p>Donec lobortis sem eu est elementum, vel mollis lorem placerat. Quisque pellentesque laoreet dui, ut vestibulum justo ullamcorper quis. Pellentesque ut urna nec ante commodo ultricies. Maecenas ut nisi id velit commodo eleifend. Sed iaculis neque mauris, eget congue massa fermentum eget. Proin feugiat dolor quis lectus tristique pretium. Sed mattis metus eget felis ultricies vehicula. Mauris scelerisque maximus enim ac efficitur. Aliquam erat volutpat. Praesent gravida sit amet leo sit amet luctus. Nulla facilisi. Vivamus lacinia eu nisi sed semper.</p><p>Aenean urna lectus, tincidunt ut felis ut, auctor maximus nulla. Nunc cursus mauris ut ante semper, quis placerat est porta. Nam vitae euismod nibh. Nunc libero mauris, volutpat sit amet nisi vel, volutpat consequat magna. Aliquam convallis, augue eu pharetra dignissim, ante justo porttitor purus, eget aliquam magna dolor a turpis. Mauris blandit sit amet neque sed egestas. Nam quis sem nisi. Mauris consequat lacinia metus, a egestas sem imperdiet nec. In aliquet leo felis, nec pellentesque dui vestibulum sed. Interdum et malesuada fames ac ante ipsum primis in faucibus.</p><p>Morbi dapibus, turpis vel dapibus ornare, enim mauris interdum est, eget molestie mi odio ut quam. Curabitur sed justo lectus. Vivamus vehicula, leo vel ullamcorper venenatis, ipsum odio faucibus turpis, at venenatis eros augue vel leo. Suspendisse mattis, massa sed interdum faucibus, nisi diam consequat arcu, et blandit lectus augue facilisis lectus. Sed cursus eros eu augue placerat porta. Donec dapibus quam ut tortor sollicitudin, non convallis felis aliquam. Suspendisse porta dignissim mattis. Aenean suscipit vitae diam ac convallis. Fusce a mollis metus. Duis auctor cursus magna, mollis dapibus magna lacinia id.</p><p>In sed aliquam libero. Cras semper, libero eu malesuada efficitur, augue leo faucibus tellus, in iaculis augue libero non lacus. Proin in euismod ante. Donec fermentum lectus vel luctus sollicitudin. Phasellus efficitur pulvinar ornare. In ullamcorper mauris elit, quis consectetur diam varius sit amet. Ut facilisis turpis nec magna porttitor, quis ornare metus tincidunt. Duis mattis volutpat neque vitae luctus. Suspendisse a tellus diam. Donec sem sem, dapibus vitae euismod id, aliquet a est. In mollis congue ornare. Etiam imperdiet, nunc a mollis malesuada, tellus erat hendrerit ligula, id vehicula dui lorem lacinia tortor. Cras iaculis mattis gravida. Sed fermentum ex leo, eu euismod tellus laoreet non.</p><p>Nulla ullamcorper nisi lobortis, bibendum ante ut, suscipit quam. Donec rutrum mattis erat, et hendrerit libero finibus a. In fringilla ante vitae cursus rutrum. In hac habitasse platea dictumst. Duis sed ipsum mi. Pellentesque vitae lacinia justo. In euismod diam non tortor vestibulum varius. Proin varius tincidunt est quis sagittis. In non arcu vitae ex efficitur dictum. Quisque enim sem, iaculis a nibh et, vulputate accumsan tortor. Proin porttitor accumsan odio eu pharetra. Phasellus in magna vitae est egestas rutrum. Curabitur vel purus sit amet nisi varius tristique pulvinar ut orci. Curabitur id aliquam dui. Cras dictum scelerisque turpis, semper vulputate augue euismod vitae. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>', '06-12-2021 11:36:15 pm'),
(5, 'Payment Methods', 'Razorpay,COD', '07-12-2021 09:55:40 am'),
(6, 'App Version', '1.01', '07-12-2021 12:17:34 am'),
(7, 'Store Status', '1', '07-12-2021 12:29:38 am');

-- --------------------------------------------------------

--
-- Table structure for table `site_slider`
--

CREATE TABLE `site_slider` (
  `id` int(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `sequence` int(50) NOT NULL,
  `date_time` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `site_slider`
--

INSERT INTO `site_slider` (`id`, `image`, `sequence`, `date_time`) VALUES
(8, 'first-slider.png', 8, '12-12-2021 10:33:52 pm'),
(9, 'second-slider.png', 9, '12-12-2021 10:34:10 pm');

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `id` int(255) NOT NULL,
  `category` int(255) NOT NULL,
  `name` varchar(120) NOT NULL,
  `icon` varchar(200) NOT NULL,
  `date_time` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`id`, `category`, `name`, `icon`, `date_time`) VALUES
(33, 17, 'Fresh Vegetables', '9140bd49fa188b152fd5751ca396114f_subcategory_icon.png', '12-12-2021 12:27:11 pm'),
(34, 17, 'Fresh Fruits', 'b62bf33efc40e772f9ab40bc84788dd8_subcategory_icon.png', '12-12-2021 12:27:54 pm'),
(35, 18, 'Milk', 'de27928c3fffe7f8014ded448cb8e389_subcategory_icon.png', '15-12-2021 02:51:36 pm'),
(36, 18, 'Curd & Yogurts', 'd8ac194a3f797385a2388403b95cba58_subcategory_icon.png', '16-12-2021 01:24:09 am'),
(37, 18, 'Breads & Buns', 'e0eb872420b43b490373d5f8c41870a3_subcategory_icon.png', '16-12-2021 01:36:41 am'),
(38, 18, 'Butter & Cheese', '684b339eb0c7b6200ac476a347a2f3be_subcategory_icon.png', '16-12-2021 01:37:34 am'),
(39, 18, 'Eggs', 'ad5f5688f306a0a976f9ddbe97cd0372_subcategory_icon.png', '16-12-2021 01:37:54 am'),
(40, 18, 'Paneer & Cream', 'cab5464bfb2e1ce41b3f24fae5c46186_subcategory_icon.png', '16-12-2021 01:44:56 am'),
(41, 18, 'Milk Based Drinks', '588291e928830d99a8fd9497baccff40_subcategory_icon.png', '16-12-2021 01:50:14 am'),
(42, 19, 'Atta', '429d01e94528cdd3d6aa638f31ecddeb_subcategory_icon.png', '16-12-2021 01:57:29 am'),
(43, 19, 'Other Flours', '3876633ff71d449dfa65cce0a5a5d01a_subcategory_icon.png', '16-12-2021 02:00:05 am'),
(44, 19, 'Rice & Cerials', '709d3912ad6b3dc439fa91f50070b48c_subcategory_icon.png', '16-12-2021 02:04:31 am'),
(45, 19, 'Olive Oils', '265210e050f3e0d81af0435cc9c7926f_subcategory_icon.png', '16-12-2021 02:08:37 am'),
(46, 19, 'Ghee', '87aef60b6f22b5de46d7a67ee5beb4ab_subcategory_icon.png', '16-12-2021 02:10:56 am'),
(47, 19, 'Toor, Moong & Chana Dal', 'd2eee64fba590a2d6b8ee9a01a1205f9_subcategory_icon.png', '16-12-2021 02:13:47 am'),
(48, 19, 'Edible Oils', '792567bbf7112ec4d06f7f678777c8c6_subcategory_icon.png', '16-12-2021 02:16:20 am'),
(49, 20, 'Masalas & More', '1c36bf43f4900d09f1a82f37ff0304b4_subcategory_icon.png', '16-12-2021 02:16:59 am'),
(50, 21, 'Biscuits', 'bc9acfc7c9d460bb07f128595a56fb2c_subcategory_icon.png', '16-12-2021 02:17:22 am'),
(51, 22, 'Meat', '389da6f224a046ea73f7a16b79f401dc_subcategory_icon.png', '16-12-2021 02:17:56 am'),
(52, 28, 'coco-powder', 'ef59423b91e813e1e8123a715cc2526b_subcategory_icon.png', '20-12-2023 02:16:44 pm'),
(53, 29, 'coco-powder22', 'ea58f4b0df2c4f5f88bef27aac2af31e_subcategory_icon.png', '22-12-2023 02:23:14 pm'),
(54, 30, 'abc', '004c71ef8ea00c3d52ebc457172708f1_subcategory_icon.jpeg', '22-12-2023 03:14:15 pm');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(255) NOT NULL,
  `customer_id` int(255) NOT NULL,
  `product_id` int(255) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `customer_id`, `product_id`, `date_time`) VALUES
(18, 7, 90, '2021-12-18 20:38:23'),
(19, 7, 95, '2021-12-18 20:46:36'),
(20, 7, 89, '2021-12-18 20:50:58'),
(21, 1, 64, '2021-12-18 20:51:02'),
(22, 1, 99, '2021-12-18 20:51:10'),
(23, 1, 98, '2021-12-18 20:51:12'),
(24, 1, 96, '2021-12-18 20:51:16'),
(25, 1, 94, '2021-12-18 20:51:17'),
(26, 1, 93, '2021-12-18 20:51:21'),
(27, 1, 88, '2021-12-18 20:51:22'),
(28, 1, 74, '2021-12-19 19:04:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `captain`
--
ALTER TABLE `captain`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_id` (`unique_id`);

--
-- Indexes for table `captain_payments`
--
ALTER TABLE `captain_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deliveries`
--
ALTER TABLE `deliveries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `featured_hotdeals`
--
ALTER TABLE `featured_hotdeals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ordered_products`
--
ALTER TABLE `ordered_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pincode`
--
ALTER TABLE `pincode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `query`
--
ALTER TABLE `query`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `site_slider`
--
ALTER TABLE `site_slider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `captain`
--
ALTER TABLE `captain`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `captain_payments`
--
ALTER TABLE `captain_payments`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `deliveries`
--
ALTER TABLE `deliveries`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `featured_hotdeals`
--
ALTER TABLE `featured_hotdeals`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `ordered_products`
--
ALTER TABLE `ordered_products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `pincode`
--
ALTER TABLE `pincode`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=210;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=233;

--
-- AUTO_INCREMENT for table `query`
--
ALTER TABLE `query`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `site_slider`
--
ALTER TABLE `site_slider`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
