-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2020 at 07:30 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `patman`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(30) NOT NULL,
  `hospital_id` int(30) NOT NULL,
  `admin_name` varchar(50) NOT NULL,
  `admin_username` varchar(50) NOT NULL,
  `admin_password` varchar(500) NOT NULL,
  `admin_gender` varchar(30) NOT NULL,
  `admin_age` int(4) NOT NULL,
  `admin_contact` bigint(10) NOT NULL,
  `admin_email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `hospital_id`, `admin_name`, `admin_username`, `admin_password`, `admin_gender`, `admin_age`, `admin_contact`, `admin_email`) VALUES
(1, 1, 'shubham', 'Admin', 'kanaki', 'male', 56, 7715016396, 'shubhamsv01@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `message` varchar(500) NOT NULL,
  `srno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`name`, `email`, `message`, `srno`) VALUES
('SOURABH KSHIRSAGAR', 'kshirsagarsourabh547@gmail.com', 'Hey Shubham u r bad boi', 1),
('SOURABH KSHIRSAGAR', 'kshirsagarsourabh547@gmail.com', 'Hey Shubham u r bad boi', 2);

-- --------------------------------------------------------

--
-- Table structure for table `hospital`
--

CREATE TABLE `hospital` (
  `hospital_id` int(30) NOT NULL,
  `hospital_name` varchar(30) NOT NULL,
  `pincode` bigint(7) NOT NULL,
  `address` varchar(500) NOT NULL,
  `specialization` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hospital`
--

INSERT INTO `hospital` (`hospital_id`, `hospital_name`, `pincode`, `address`, `specialization`) VALUES
(1, 'Fortis', 421301, 'Shill Road, Bail Bazaar, Kalyan, Mumbai, Maharashtra 421301', 'Bone'),
(2, 'Seven Hills', 400059, 'Marol Maroshi Rd, Shivaji Nagar JJC, Marol, Andheri East, Mumbai, Maharashtra 400059', 'All'),
(3, 'Pillai', 0, 'New Panvel', 'All'),
(4, 'PCE', 0, 'New Panvel', 'All'),
(5, 'mnm', 0, 'amma', ''),
(6, 'akka', 0, 'New Panvel', ''),
(7, 'Sdhivinayak', 0, 'SS III ROOM NO 370 SECTOR 5 KOPARKHAIRANE NAVI MUMBAI', ''),
(8, 'Kalyan', 0, 'Kalyan', '');

-- --------------------------------------------------------

--
-- Table structure for table `hospital_dr`
--

CREATE TABLE `hospital_dr` (
  `dr_id` int(30) NOT NULL,
  `hospital_id` int(30) NOT NULL,
  `dr_name` varchar(50) NOT NULL,
  `age` int(8) NOT NULL,
  `gender` varchar(30) NOT NULL,
  `specialization` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(500) NOT NULL,
  `contact_no` bigint(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `exp` varchar(10) NOT NULL,
  `designation` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hospital_dr`
--

INSERT INTO `hospital_dr` (`dr_id`, `hospital_id`, `dr_name`, `age`, `gender`, `specialization`, `username`, `password`, `contact_no`, `email`, `exp`, `designation`) VALUES
(7, 1, 'Kaustubh', 0, 'male', 'Security', 'kau@123', '827ccb0eea8a706c4c34a16891f84e7b', 9090909090, 'kshirsagarsourabh547@gmail.com', '', ''),
(8, 2, 'Dhiraj', 0, 'male', 'All', 'Dhiraj123', '827ccb0eea8a706c4c34a16891f84e7b', 9090909090, 'kshirsagarsourabh547@gmail.com', '', ''),
(9, 5, 'aksl', 0, 'female', 'all', 'asdfg', '827ccb0eea8a706c4c34a16891f84e7b', 9090909090, 'kshirsagarsourabh547@gmail.com', '', ''),
(10, 6, 'ajk', 0, 'other', 'na', 'naa123', '827ccb0eea8a706c4c34a16891f84e7b', 9019090909, 'kshirsagarsourabh547@gmail.com', '', ''),
(11, 1, 'Asmita Kshirsagar', 0, 'female', 'Child', 'asmita123', '827ccb0eea8a706c4c34a16891f84e7b', 7219499170, 'kshirsagarsourabh547@gmail.com', '', ''),
(12, 8, 'Shubham', 0, 'male', 'all', 'shubham1', '827ccb0eea8a706c4c34a16891f84e7b', 7715016396, 'kshirsagarsourabh547@gmail.com', '', ''),
(13, 1, 'Vijay Kshirsagar', 40, 'male', 'Bone', 'sou123', '827ccb0eea8a706c4c34a16891f84e7b', 7219499160, 'kshirsagarsourabh547@gmail.com', '11', 'djdn'),
(14, 1, 'Shubha', 40, 'male', 'bskj', 'shubh', '827ccb0eea8a706c4c34a16891f84e7b', 7715016396, 'kshirsagarsourabh547@gmail.com', '10', 'sjbjks'),
(15, 1, 'Viju', 38, 'male', 'child', 'viju', '2c9a47cfc9e87b15df08e947269c0b64', 7219499160, 'kshirsagarsourabh547@gmail.com', '10', 'acghss');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `pat_id` varchar(30) NOT NULL,
  `pat_name` varchar(40) NOT NULL,
  `pat_password` varchar(500) NOT NULL,
  `pat_contact` bigint(10) NOT NULL,
  `pat_email` varchar(50) NOT NULL,
  `pat_gender` varchar(30) NOT NULL,
  `bood_group` varchar(5) NOT NULL,
  `age` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`pat_id`, `pat_name`, `pat_password`, `pat_contact`, `pat_email`, `pat_gender`, `bood_group`, `age`) VALUES
('20ad4d76', 'SOURABH KSHIRSAGAR', '9e433e4d16d0cfdb8aaed61dbba4ea47', 8169403915, 'kshirsagarsourabh547@gmail.com', 'male', '', 0),
('35b90b45', 'SOURABH KSHIRSAGAR', '9e433e4d16d0cfdb8aaed61dbba4ea47', 8169403915, 'kshirsagarsourabh547@gmail.com', 'male', '', 0),
('369853df', 'Shreya', 'e8c8f45019430b6f79862746e96d6e70', 8169403915, 'kshirsagarsourabh547@gmail.com', 'male', '', 0),
('4ca4238a', 'SOURABH KSHIRSAGAR', '9e433e4d16d0cfdb8aaed61dbba4ea47', 9090909090, 'kshirsagarsourabh547@gmail.com', 'male', '', 0),
('51ddf505', 'Asmita', '9e433e4d16d0cfdb8aaed61dbba4ea47', 7219499170, 'kshirsagarsourabh547@gmail.com', 'male', '', 0),
('5f4a8d46', 'Geeta', '9e433e4d16d0cfdb8aaed61dbba4ea47', 8169403915, 'kshirsagarsourabh547@gmail.com', 'male', '', 0),
('647966b7', 'SOURABH KSHIRSAGAR', '9e433e4d16d0cfdb8aaed61dbba4ea47', 1233333333, 'kshirsagarsourabh547@gmail.com', 'male', '', 0),
('7693cfc7', 'SOURABH KSHIRSAGAR', '9e433e4d16d0cfdb8aaed61dbba4ea47', 8169403915, 'kshirsagarsourabh547@gmail.com', 'male', '', 0),
('c8349cc7', 'Ganesh Kanses', '827ccb0eea8a706c4c34a16891f84e7b', 8169403915, 'kshirsagarsourabh547@gmail.com', 'male', 'A+', 0),
('dc4876f3', 'Sahil', '9e433e4d16d0cfdb8aaed61dbba4ea47', 8169403915, 'kshirsagarsourabh547@gmail.com', 'male', '', 0),
('dfcd5e55', 'Asmita', '9e433e4d16d0cfdb8aaed61dbba4ea47', 7219499170, 'kshirsagarsourabh547@gmail.com', 'male', '', 0),
('f3ef77ac', 'Dhiraj', '9e433e4d16d0cfdb8aaed61dbba4ea47', 8169403915, 'kshirsagarsourabh547@gmail.com', 'male', '', 0),
('f61408e3', 'SOURABH KSHIRSAGAR', '9dcc594cc49c815d1248675bd2869e6b', 1111111111, 'kshirsagarsourabh547@gmail.com', 'male', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `prescription`
--

CREATE TABLE `prescription` (
  `prescription_id` int(30) NOT NULL,
  `dr_id` int(30) NOT NULL,
  `pat_id` varchar(30) NOT NULL,
  `heading` varchar(50) NOT NULL,
  `sub_heading` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `time` time NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prescription`
--

INSERT INTO `prescription` (`prescription_id`, `dr_id`, `pat_id`, `heading`, `sub_heading`, `message`, `date`, `time`) VALUES
(98, 7, '4ca4238a', 'Prescription Heading', 'Prescription SubHeading', 'Prescription Message', '2020-11-28', '03:50:00'),
(99, 7, '4ca4238a', 'hey', 'alive', 'Sourav Chandidas Ganguly (/sʃuːrəv ɡɛnɡuːlj/ (listen); born 8 July 1972), affectionately known as Dada (meaning \"elder brother\" in Bengali), is an Indian\n115 KB (9,489 words) - 18:34, 22 November 2020\nSourav\nSourav Chatterjee, Indian mathematician Sourav Das, Indian footballer Sourav De (born 1974), Indian film director, producer and screenwriter Sourav Dubey\n897 bytes (83 words) - 16:50, 13 August 2020\nSourav Chakraborty\nSourav Chakraborty (born 27 June 1990, in Kolkata) is an Indian footballer who plays as a Striker for Mohun Bagan in the I-League. Sourav started his\n3 KB (115 words) - 21:13, 1 November 2020\nSourav Das\n[1] Sourav Das is an Indian Professional footballer who plays as a midfielder for Mumbai City FC in the Indian Super League. He scored a brace in the first\n1 KB (81 words) - 05:51, 1 November 2020\nSourav Chatterjee\nSourav Chatterjee (born November 1979) is a mathematician, specializing in mathematical statistics and probability theory. Chatterjee is credited with\n6 KB (453 words) - 01:32, 24 October 2020\nEnglish cricket team in India in 2020–21\nconfirmed the changes to England\'s tour in August 2020. On 20 August 2020, Sourav Ganguly, president of the BCCI, said that India would host England to fulfil\n7 KB (545 words) - 14:58, 24 November 2020\nSourav Sarkar\nSourav Subrata Sarkar (born 15 December 1984) is an Indian first-class cricketer who plays for Bengal in domestic cricket. He is a right-arm medium-fast\n3 KB (48 words) - 15:58, 17 June 2020\nDona Ganguly\nand married her childhood friend and later Indian cricketer and skipper Sourav Ganguly, 39th president of Board of Control for Cricket in India. The couple\n7 KB (513 words) - 14:48, 28 June 2020\nSubhra Sourav Das\nSubhra Sourav Das is an Indian television and films actor based in Kolkata. He also worked at Kaushik Sen\'s theatre group Swapnasandhani. Das wanted to\n5 KB (240 words) - 12:33, 8 August 2020\nSourav De\nSourav De (born 4 August 1974) is an Indian film director, producer and screenwriter. Sourav made his directorial debut with as yet unreleased Mohulti\n2 KB (159 words) - 07:32, 22 September 2020\n2020 Asia Cup\ntensions between Pakistan and India. On 28 February 2020, the BCCI President Sourav Ganguly stated that \"the Asia Cup will be held in Dubai and both India and\n12 KB (1,035 words) - 08:31, 22 November 2020\nSourav Mukhopadhyay\nSourav Mukhopadhyay (Bengali:সৌরভ মুখোপাধ্যায়, born 24 April 1973) is a Bengali author from India. He has written several Bengali stories and novels for\n15 KB (1,706 words) - 09:58, 2 November 2020\nSourav Kothari\nSourav Kothari (born 16 November 1984) is an Indian player of English billiards. He was world champion in 2018. Kothari was born in Kolkota on 16 November\n6 KB (411 words) - 10:40, 28 November 2020\nList of presidents of the Board of Control for Cricket in India\n2019). \"Sourav Ganguly formally elected as the 39th president of BCCI\". India Today. Retrieved 23 October 2019. Times Now (23 October 2019). \"Sourav Ganguly\n7 KB (497 words) - 15:08, 6 November 2020\nIndian Super League\nbidding for the Kochi franchise. Another former Indian cricket player, Sourav Ganguly, along with a group of Indian businessmen and La Liga side Atlético\n81 KB (6,290 words) - 03:54, 28 November 2020\nMy11Circle\nFormer Indian national cricket team captain and current BCCI president Sourav Ganguly is the brand ambassador of My11Circle since May 2019. Ganguly continued\n6 KB (527 words) - 14:38, 21 November 2020\n1:30 am\na 2012 Bengali language Indian independent film written and directed by Sourav De. Nishi (Ena Saha) is a girl in her late teens being torn apart by a split\n4 KB (365 words) - 00:56, 25 May 2020\nSourav Pal\nSourav Pal is an Indian theoretical chemist, a professor of chemistry in IIT Bombay and is the director of the Indian Institute of Science Education and\n15 KB (1,660 words) - 20:54, 4 February 2020\nList of players who have scored 10,000 or more runs in One Day International cricket\n\"Sourav Ganguly | Cricket Players and Officials\". ESPNcricinfo. Archived from the original on 2015-08-29. Retrieved 21 Augus', '2020-11-28', '03:52:00'),
(102, 8, '20ad4d76', 'Prescription Heading', 'Prescription SubHeading', 'Prescription Message', '2020-11-28', '06:22:00'),
(103, 8, '7693cfc7', 'Prescription Heading', 'Prescription SubHeading', 'Prescription Message', '2020-11-28', '06:26:00'),
(104, 8, '20ad4d76', 'hii', 'j ', 'njk', '2020-11-28', '06:31:00'),
(105, 8, '369853df', 'Prescription Heading', 'Prescription SubHeading', 'Prescription Message', '2020-11-28', '07:11:00'),
(106, 8, 'c8349cc7', 'Prescription Heading', 'Prescription SubHeading', 'Prescription Message', '2020-11-28', '07:16:00'),
(107, 8, 'f61408e3', 'Prescription Heading', 'Prescription SubHeading', 'Prescription Message', '2020-11-28', '07:20:00'),
(108, 8, '35b90b45', 'Prescription Heading', 'Prescription SubHeading', 'Prescription Message', '2020-11-28', '07:23:00'),
(109, 8, '5f4a8d46', 'Prescription Heading', 'Prescription SubHeading', 'Prescription Message', '2020-11-28', '07:25:00'),
(110, 8, '647966b7', 'Prescription Heading', 'Prescription SubHeading', 'Prescription Message', '2020-11-28', '07:28:00'),
(111, 7, 'f3ef77ac', 'Prescription Heading', 'Prescription SubHeading', 'Prescription Message', '2020-11-29', '04:34:00'),
(112, 7, 'dfcd5e55', 'Prescription Heading', 'Prescription SubHeading', 'Prescription Message', '2020-11-29', '04:46:00'),
(114, 7, 'dc4876f3', 'Prescription Heading', 'Prescription SubHeading', 'Prescription Message', '2020-11-29', '04:55:00'),
(115, 7, '51ddf505', 'Prescription Heading', 'Prescription SubHeading', 'Prescription Message', '2020-11-29', '04:57:00'),
(116, 7, '4ca4238a', 'NA', 'NA', 'NA', '2020-11-29', '02:33:00'),
(117, 8, '369853df', 'Bone', 'Fracture', 'Plaster', '2020-11-29', '03:05:00'),
(118, 8, '369853df', 'Bone', 'Fracture', 'Plaster', '2020-11-29', '03:05:00'),
(119, 8, '369853df', 'Bone', 'Fracture', 'head break', '2020-11-29', '03:05:00'),
(120, 7, '4ca4238a', 'Maleria', '10-15', 'na', '2020-11-30', '04:28:00'),
(121, 7, 'c8349cc7', 'Prescription Heading', 'Prescription SubHeading', 'Prescription Message', '2020-11-30', '04:30:00'),
(122, 7, 'c8349cc7', 'sza', 'svvd', 'dvvd', '2020-11-30', '04:30:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD KEY `fk_admin_hospital_id` (`hospital_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`srno`);

--
-- Indexes for table `hospital`
--
ALTER TABLE `hospital`
  ADD PRIMARY KEY (`hospital_id`);

--
-- Indexes for table `hospital_dr`
--
ALTER TABLE `hospital_dr`
  ADD PRIMARY KEY (`dr_id`),
  ADD KEY `fk_hospital_id` (`hospital_id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`pat_id`);

--
-- Indexes for table `prescription`
--
ALTER TABLE `prescription`
  ADD PRIMARY KEY (`prescription_id`),
  ADD KEY `fk_prescr_dr_id` (`dr_id`),
  ADD KEY `fk_prescr_pat_id` (`pat_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `srno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hospital`
--
ALTER TABLE `hospital`
  MODIFY `hospital_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `hospital_dr`
--
ALTER TABLE `hospital_dr`
  MODIFY `dr_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `prescription`
--
ALTER TABLE `prescription`
  MODIFY `prescription_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `fk_admin_hospital_id` FOREIGN KEY (`hospital_id`) REFERENCES `hospital` (`hospital_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `hospital_dr`
--
ALTER TABLE `hospital_dr`
  ADD CONSTRAINT `fk_hospital_id` FOREIGN KEY (`hospital_id`) REFERENCES `hospital` (`hospital_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `prescription`
--
ALTER TABLE `prescription`
  ADD CONSTRAINT `fk_prescr_dr_id` FOREIGN KEY (`dr_id`) REFERENCES `hospital_dr` (`dr_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_prescr_pat_id` FOREIGN KEY (`pat_id`) REFERENCES `patient` (`pat_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
