-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 26, 2024 at 12:53 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pereira_sea_caterers`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `ph_number` int(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `ph_number`, `email`, `password`) VALUES
(2, 'admin', 986473821, 'admin@12.com', '1c6637a8f2e1f75e06ff9984894d6bd16a3a36a9');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `item_id` int(255) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `categories` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`item_id`, `Name`, `categories`, `Description`, `image`) VALUES
(1, 'Chutney-sandwich', 'Starter', 'veg', 'chutney-sandwich-9-186334.jpg'),
(4, 'Jelly', 'Dessert', 'veg', 'jelly-dessert.jpg'),
(7, 'Beef croquettes', 'Starter', 'Non-veg', 'beef_croquettes.jpg'),
(8, 'Forminhas', 'Starter', 'Veg', 'forminhas.jpg'),
(9, 'Chutney-bread', 'Starter', 'Veg', 'chutney bread.jpg'),
(10, 'Toast Sardine', 'Starter', 'Non-veg', 'toast S.jpg'),
(11, 'Pulao', 'Main Course', 'Veg', 'pulao.jpeg'),
(12, 'Chicken Xacuti', 'Main Course', 'Non-veg', 'chicken Xacuti.jpg'),
(13, 'Chicken Green', 'Main Course', 'Non-veg', 'Goan Green Chicken.jpg'),
(14, 'Beef Xacuti', 'Main Course', 'Non-veg', 'hq720.jpg'),
(15, 'Beef Roast', 'Main Course', 'Non-veg', 'beaf roast.jpg'),
(16, 'Chana Masala', 'Main Course', 'Veg', 'chana masala.jpg'),
(17, 'Chow Chow', 'Main Course', 'Non-veg', 'chow chow.jpg'),
(18, 'Green Salad', 'Main Course', 'Veg', 'salad.jpg'),
(19, 'Bread ', 'Main Course', 'veg', 'bread-machine-dinner-rolls-07.jpg'),
(20, 'Fruit Custard', 'Dessert', 'Non-veg', 'Custard.jpeg'),
(21, 'Toast', 'Starter', 'Non-veg', 'toast.jpg'),
(22, 'Peas Pulao', 'Main Course', 'Veg', 'peas puloa.jpg'),
(23, 'Veg kurma', 'Main Course', 'Veg', 'veg kurma.jpg'),
(24, 'Sanna', 'Main Course', 'Veg', 'Sanna.jpg'),
(25, 'Pudding', 'Dessert', 'Non-veg', 'pudding.jpg'),
(26, 'Biryani', 'Main Course', 'Non veg', 'Goan Green Chicken.jpg'),
(28, 'Bebinca', 'Dessert', 'Non-veg', 'bebinca.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `number` int(255) NOT NULL,
  `message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `name`, `email`, `number`, `message`) VALUES
(3, 54, 'gildon', 'b21616@fragnelcollege.edu.in', 2147483647, 'The food was good!! Liked it '),
(5, 54, 'gildon', 'b21616@fragnelcollege.edu.in', 2147483647, 'Alvis'),
(6, 54, 'gildon1', 'b21616@fragnelcollege.edu.in', 2147483647, 'hfbhoew rgfh');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `payid` int(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `package_name` varchar(255) DEFAULT NULL,
  `starter_Name` varchar(255) DEFAULT NULL,
  `MainCourse_Name` varchar(255) DEFAULT NULL,
  `Dessert_Name` varchar(255) DEFAULT NULL,
  `total_item` varchar(255) DEFAULT NULL,
  `deliver_date` date DEFAULT NULL,
  `deliver_time` time NOT NULL,
  `amount` varchar(20) DEFAULT NULL,
  `txnid` varchar(255) DEFAULT NULL,
  `pid` int(11) DEFAULT NULL,
  `payer_email` varchar(40) DEFAULT NULL,
  `currency` varchar(10) DEFAULT NULL,
  `mobile` varchar(15) NOT NULL,
  `address` varchar(455) DEFAULT NULL,
  `venue` varchar(255) NOT NULL,
  `payment_date` datetime DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`payid`, `user_id`, `name`, `package_name`, `starter_Name`, `MainCourse_Name`, `Dessert_Name`, `total_item`, `deliver_date`, `deliver_time`, `amount`, `txnid`, `pid`, `payer_email`, `currency`, `mobile`, `address`, `venue`, `payment_date`, `status`) VALUES
(44, 43, 'Macwyn', 'Package 2', 'Beef croquettes,Forminhas', 'Chicken Xacuti,Chicken Green,Beef Xacuti,Beef Roast,Chana Masala,Chow Chow,Green Salad,Bread,Peas Pulao,Veg kurma', 'Fruit Custard,Pudding', ' (260 x 20)  ', '2024-03-31', '10:43:00', '5252.18', 'pay_Nk8ZVajbAdD11v', 109, 'b21625@fragnelcollege.edu.in', 'INR', '2147483647', '23, Velsao, Verna, Goa, India - 403722', 'God\'s Garden, Verna Goa', '2024-03-09 10:43:44', 'success'),
(46, 51, 'alvis', 'Package 2', 'Beef croquettes,Forminhas,Toast Sardine', 'pork sorpotel,Chicken Xacuti,Chicken Green,Beef Xacuti,Beef Roast,Chana Masala,Chow Chow,Green Salad,Peas Pulao,Veg kurma', 'jelly,Fruit Custard', ' (260 x 50)  ', '2024-04-20', '10:30:00', '13130.18', 'pay_NnhBSH47wT3UX7', 121, 'b21601@fragnelcollege.edu.in', 'INR', '2147483647', '211, jbkjdb, Verna, Goa, India - 403602', '211, jbkjdb, Verna, Goa, India - 403602 (Home Address) ', '2024-03-18 10:32:14', 'success'),
(47, 50, 'gildon', 'Package 2', 'Beef croquettes,Forminhas,Toast Sardine', 'pork sorpotel,Chicken Xacuti,Chicken Green,Beef Xacuti,Beef Roast,Chana Masala,Chow Chow,Green Salad,Bread,Peas Pulao', 'Fruit Custard,Pudding', ' (260 x 20)  ', '2024-04-05', '16:58:00', '5252.18', 'pay_NpiLa4iwfYqdrw', 123, 'b21616@fragnelcollege.edu.in', 'INR', '22678125', '39, verna, Verna, Goa, India - 476567', 'God\'s Garden, Verna Goa', '2024-03-23 12:58:31', 'success'),
(48, 53, 'jayden', 'Package 2', 'Beef croquettes,Forminhas,Toast Sardine', 'pork sorpotel,Chicken Xacuti,Chicken Green,Beef Xacuti,Beef Roast,Chow Chow,Green Salad,Peas Pulao,Veg kurma,Sanna', 'jelly,Fruit Custard', ' (260 x 30)  ', '2024-03-30', '18:16:00', '7878.18', 'pay_NpihfDss3SWXbj', 124, 'b21616@fragnelcollege.edu.in', 'INR', '2147483647', '32, old goa, Old-Goa, Goa, India - 403402', '32, old goa, Old-Goa, Goa, India - 403402 (Home Address) ', '2024-03-23 13:19:26', 'success'),
(49, 54, 'gildon', 'Package 2', 'Beef croquettes,Forminhas,Toast Sardine', 'pork sorpotel,Chicken Xacuti,Chicken Green,Beef Xacuti,Beef Roast,Chana Masala,Chow Chow,Green Salad,Bread,Peas Pulao', 'jelly,Fruit Custard', ' (260 x 20)  ', '2024-04-10', '19:01:00', '5252.18', 'pay_NqcanQdQM5kB4i', 125, 'b21616@fragnelcollege.edu.in', 'INR', '2147483647', '39, verna, Goa-velha, Goa, India - 111111', 'God\'s Garden, Verna Goa', '2024-03-25 19:59:45', 'success'),
(50, 54, 'gildon', 'Silver', 'chutney-sandwich,Beef croquettes,Forminhas', 'Pulao,Chicken Xacuti,Beef Xacuti,Beef Roast,Chana Masala,Chow Chow,Green Salad,Bread', 'jelly', ' (250 x 20)  ', '2024-04-04', '13:25:00', '5050.18', 'pay_NquTW2flXFoU5n', 126, 'b21616@fragnelcollege.edu.in', 'INR', '2147483647', '39, verna, Goa-velha, Goa, India - 111111', 'Coco Loco Lawns, Agacaim Goa', '2024-03-26 13:29:21', 'success');

-- --------------------------------------------------------

--
-- Table structure for table `package`
--

CREATE TABLE `package` (
  `Package_ID` int(255) NOT NULL,
  `Package_Name` varchar(255) NOT NULL,
  `starter_Name` varchar(255) NOT NULL,
  `MainCourse_Name` varchar(255) NOT NULL,
  `Dessert_Name` varchar(255) NOT NULL,
  `number_of_starter` int(255) NOT NULL,
  `number_of_MainCourse` int(255) NOT NULL,
  `number_of_Dessert` int(255) NOT NULL,
  `price` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `package`
--

INSERT INTO `package` (`Package_ID`, `Package_Name`, `starter_Name`, `MainCourse_Name`, `Dessert_Name`, `number_of_starter`, `number_of_MainCourse`, `number_of_Dessert`, `price`) VALUES
(13, 'Silver', 'chutney-sandwich,Beef croquettes,Forminhas,Chutney-bread', 'Pulao,Chicken Xacuti,Beef Xacuti,Beef Roast,Chana Masala,Chow Chow,Green Salad,Bread ,Peas Pulao,Sanna', 'jelly,Fruit Custard', 3, 8, 1, 250),
(14, 'Gold', 'chutney-sandwich,Beef croquettes,Forminhas,Chutney-bread,Toast', 'Pulao,Chicken Xacuti,Beef Xacuti,Chana Masala,Chow Chow,Green Salad,Bread ,Veg kurma,Sanna,Biryani', 'jelly,Fruit Custard,Pudding', 3, 9, 2, 290),
(15, 'Platinum', 'chutney-sandwich,Beef croquettes,Forminhas,Chutney-bread,Toast Sardine', 'Pulao,Chicken Xacuti,Chicken Green,Beef Xacuti,Beef Roast,Chana Masala,Chow Chow,Green Salad,Bread ,Peas Pulao,Veg kurma,Sanna,Biryani', 'jelly,Fruit Custard,Pudding,Bebinca', 4, 10, 3, 340);

-- --------------------------------------------------------

--
-- Table structure for table `selectpackage`
--

CREATE TABLE `selectpackage` (
  `id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `Package_name` varchar(250) NOT NULL,
  `pid` int(255) NOT NULL,
  `starter_Name` varchar(255) NOT NULL,
  `MainCourse_Name` varchar(255) NOT NULL,
  `Dessert_Name` varchar(255) NOT NULL,
  `price` int(255) NOT NULL,
  `quantity` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `selectpackage`
--

INSERT INTO `selectpackage` (`id`, `user_id`, `Package_name`, `pid`, `starter_Name`, `MainCourse_Name`, `Dessert_Name`, `price`, `quantity`) VALUES
(73, 36, 'Package 2', 11, 'Beef croquettes,Toast Sardine,Toast', 'pork sorpotel,Chicken Xacuti,Chicken Green,Beef Xacuti,Beef Roast,Chana Masala,Chow Chow,Green Salad,Bread,Peas Pulao', 'Fruit Custard,Pudding', 260, 20),
(79, 42, 'Package 2', 11, '', '', '', 260, 20),
(110, 44, 'Package 2', 11, 'Beef croquettes,Forminhas,Toast Sardine', 'pork sorpotel,Chicken Xacuti,Chicken Green,Beef Xacuti,Beef Roast,Chana Masala,Chow Chow,Green Salad,Bread,Peas Pulao', 'jelly,Fruit Custard', 260, 1000);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `ph_number` int(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `verification_code` varchar(255) NOT NULL,
  `is_verified` int(10) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_name`, `email`, `ph_number`, `password`, `address`, `verification_code`, `is_verified`) VALUES
(43, 'Macwyn', 'b21625@fragnelcollege.edu.in', 2147483647, '6216f8a75fd5bb3d5f22b6f9958cdede3fc086c2', '23, Velsao, Verna, Goa, India - 403722', '6d170f397ddee7230127241e36f851cd', 1),
(46, 'karan', 'b21623@fragnelcollege.edu.in', 2147483647, '36fbfd93758a1eb5ba1aa90aa5de41c43560fd15', '69, red light area, Pilar, Goa, India - 403108', '12faa734545a11bc63bb10c8da218b5a', 1),
(51, 'alvis', 'b21601@fragnelcollege.edu.in', 2147483647, '6216f8a75fd5bb3d5f22b6f9958cdede3fc086c2', '211, jbkjdb, Verna, Goa, India - 403602', '4bd4f56d9e77f91b8f411c4ed9144151', 1),
(54, 'gildon', 'b21616@fragnelcollege.edu.in', 2147483647, '6216f8a75fd5bb3d5f22b6f9958cdede3fc086c2', '39, verna, Goa-velha, Goa, India - 111111', '61cdbcb75b831e865a7ad99cdfd48448', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`payid`);

--
-- Indexes for table `package`
--
ALTER TABLE `package`
  ADD PRIMARY KEY (`Package_ID`);

--
-- Indexes for table `selectpackage`
--
ALTER TABLE `selectpackage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `item_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `payid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `package`
--
ALTER TABLE `package`
  MODIFY `Package_ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `selectpackage`
--
ALTER TABLE `selectpackage`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
