-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 17, 2021 at 12:30 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `m`
--

-- --------------------------------------------------------

--
-- Table structure for table `cash_advances`
--

CREATE TABLE `cash_advances` (
  `id` int(11) NOT NULL,
  `requested_by` varchar(150) NOT NULL,
  `amount` int(11) NOT NULL,
  `requested_at` datetime NOT NULL DEFAULT current_timestamp(),
  `applied_at` datetime DEFAULT NULL,
  `approved_at` datetime DEFAULT NULL,
  `approved_by` varchar(150) DEFAULT NULL,
  `message` text NOT NULL,
  `status` varchar(150) NOT NULL DEFAULT 'pending',
  `approved_amount` int(11) DEFAULT NULL,
  `receiving_date` date DEFAULT NULL,
  `type` varchar(150) NOT NULL,
  `purpose` varchar(150) NOT NULL,
  `remarks` varchar(150) NOT NULL,
  `emp_signature` varchar(150) NOT NULL,
  `approver_signature` varchar(150) NOT NULL,
  `final_signature` varchar(150) NOT NULL,
  `final_approved_at` datetime DEFAULT NULL,
  `final_approved_by` varchar(150) NOT NULL,
  `reject_signature` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cash_advances`
--

INSERT INTO `cash_advances` (`id`, `requested_by`, `amount`, `requested_at`, `applied_at`, `approved_at`, `approved_by`, `message`, `status`, `approved_amount`, `receiving_date`, `type`, `purpose`, `remarks`, `emp_signature`, `approver_signature`, `final_signature`, `final_approved_at`, `final_approved_by`, `reject_signature`) VALUES
(4, 'JM BERNALES', 20000, '2020-06-28 11:44:19', '2020-06-29 00:00:00', '2020-08-01 18:58:32', 'HRAdmin', 'JM BERNALES would like to request a Cash Advance.', 'rejected', 0, NULL, '', '', 'denied', '', '', '', NULL, '', ''),
(5, 'JM BERNALES', 100000, '2020-06-28 13:26:38', '2020-06-28 00:00:00', '2020-06-28 13:26:56', 'HRAdmin', 'JM BERNALES would like to request a Cash Advance.', 'rejected', 0, NULL, '', '', 'amount  not applicable', '', '', '', NULL, '', ''),
(12, 'Keyl Bernales', 5000, '2021-01-09 23:26:42', '2021-01-12 00:00:00', '2021-02-16 02:54:02', 'HRAdmin', 'Keyl Bernales would like to request a Cash Advance.', 'rejected', NULL, NULL, '', 'badly needed', 'no type specified', '', '', '', NULL, '', ''),
(15, 'JM BERNALES', 8000, '2021-01-11 11:10:59', '2021-01-15 00:00:00', '2021-02-17 11:39:16', 'HRAdmin', 'JM BERNALES would like to request a Cash Advance.', 'accepted', 5000, '2021-02-17', 'Official', 'hospital bill', '', '', 'sig.JPG', '', NULL, '', ''),
(16, 'JM BERNALES', 50000, '2021-02-09 11:57:48', '2021-02-11 00:00:00', '2021-02-17 12:15:21', 'Eric Atanacio', 'JM BERNALES would like to request a Cash Advance.', 'rejected', 0, NULL, 'Official', 'I want cash advance', 'amount too high', '', 'Sig-2021-02-17-Atanacio.JPG', '', NULL, '', 'Sig-2021-02-17-Atanacio.JPG'),
(17, 'JM BERNALES', 200000, '2021-02-12 23:07:51', '2021-02-12 00:00:00', '2021-02-17 12:13:03', 'HRAdmin', 'JM BERNALES would like to request a Cash Advance.', 'rejected', NULL, NULL, 'Personal', 'want cash', 'Amount not applicable', '', '', '', NULL, '', 'sig.JPG'),
(18, 'JM BERNALES', 5000, '2021-02-16 01:20:16', '2021-02-17 00:00:00', '2021-02-17 12:57:49', 'HRAdmin', 'JM BERNALES would like to request a Cash Advance.', 'final_approved', 3500, '2021-02-17', 'Personal', 'Internet Bill', '', '', 'sig.JPG', 'Sig-2021-02-17-Atanacio.JPG', '2021-02-17 12:58:30', 'Eric Atanacio', ''),
(22, 'JM BERNALES', 1000, '2021-02-17 13:12:46', '2021-02-18 00:00:00', '2021-02-17 13:14:59', 'HRAdmin', 'JM BERNALES would like to request a Cash Advance.', 'accepted', 1000, '2021-02-18', 'Official', 'insufficient funds', '', 'Sig-2021-02-16-Bernales.JPG', 'sig.JPG', '', NULL, '', ''),
(23, 'JM BERNALES', 500, '2021-02-17 13:16:10', '2021-02-19 00:00:00', NULL, NULL, 'JM BERNALES would like to request a Cash Advance.', 'pending', NULL, NULL, 'Personal', 'I need it badly', '', 'Sig-2021-02-16-Bernales.JPG', '', '', NULL, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `leaves`
--

CREATE TABLE `leaves` (
  `id` int(11) NOT NULL,
  `requested_by` varchar(150) NOT NULL,
  `requested_at` datetime NOT NULL DEFAULT current_timestamp(),
  `date_from` date NOT NULL,
  `date_to` date NOT NULL,
  `type` varchar(150) NOT NULL,
  `approved_at` datetime DEFAULT NULL,
  `approved_by` varchar(150) DEFAULT NULL,
  `recommended_by` varchar(150) DEFAULT NULL,
  `reason` text NOT NULL,
  `status` varchar(150) NOT NULL DEFAULT 'pending',
  `employment` varchar(50) NOT NULL,
  `withpay` varchar(50) NOT NULL,
  `department` varchar(50) NOT NULL,
  `endorsed_by` varchar(50) NOT NULL,
  `approve_manager` varchar(50) NOT NULL,
  `recommended_at` datetime DEFAULT NULL,
  `endorsed_at` datetime DEFAULT NULL,
  `approve_manager_at` datetime DEFAULT NULL,
  `remarks` varchar(150) NOT NULL,
  `emp_signature` varchar(150) NOT NULL,
  `recommendor_signature` varchar(100) NOT NULL,
  `endorser_signature` varchar(100) NOT NULL,
  `approver_signature` varchar(100) NOT NULL,
  `final_signature` varchar(100) NOT NULL,
  `recommendor_position` varchar(100) NOT NULL,
  `endorser_position` varchar(100) NOT NULL,
  `reject_signature` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `leaves`
--

INSERT INTO `leaves` (`id`, `requested_by`, `requested_at`, `date_from`, `date_to`, `type`, `approved_at`, `approved_by`, `recommended_by`, `reason`, `status`, `employment`, `withpay`, `department`, `endorsed_by`, `approve_manager`, `recommended_at`, `endorsed_at`, `approve_manager_at`, `remarks`, `emp_signature`, `recommendor_signature`, `endorser_signature`, `approver_signature`, `final_signature`, `recommendor_position`, `endorser_position`, `reject_signature`) VALUES
(2, 'JM BERNALES', '2020-06-27 12:28:44', '2020-06-28', '2020-06-30', 'Sick Leave', '2020-06-27 20:42:49', 'HRAdmin', NULL, 'im sick', 'accepted', '', '', '', '', '', NULL, NULL, NULL, '', '', '', '', '', '', '', '', ''),
(3, 'Dannel Ponan', '2020-06-28 11:14:14', '2020-06-29', '2020-06-30', 'Casual Leave', '2020-06-28 11:21:16', 'HRAdmin', NULL, 'rest', 'rejected', '', '', '', '', '', NULL, NULL, NULL, 'Denied', '', '', '', '', '', '', '', ''),
(4, 'Dannel Ponan', '2020-06-28 11:18:54', '2020-06-28', '2020-06-30', 'Earned Leave', '2020-06-28 11:19:47', 'HRAdmin', 'romel', 'vacation', 'accepted', '', '', '', '', '', NULL, NULL, NULL, '', '', '', '', '', '', '', '', ''),
(5, 'JM BERNALES', '2020-08-01 16:40:00', '2020-08-04', '2020-08-08', 'Earned Leave', '2021-02-02 00:40:41', 'Jose Manalo', 'Jose Manalo', 'Gusto ko lang', 'rejected', '', '', '', '', '', '2021-02-01 16:42:15', NULL, NULL, 'Not Valid reason', '', '', '', '', '', '', '', ''),
(7, 'JM BERNALES', '2020-11-21 17:45:52', '2020-11-21', '2020-11-23', 'Sick Leave', '2021-02-01 14:14:33', 'HRAdmin', 'Jose Manalo', 'gusto ko eh ', 'endorsed', '', 'No', '', 'Joy Buena', 'Milo Dixon', '2021-02-01 12:41:00', '2021-02-01 13:53:59', '2021-02-01 14:05:07', '', '', '', '', '', '', '', '', ''),
(8, 'JM BERNALES', '2020-12-14 10:42:16', '2020-12-16', '2020-12-19', 'Paternity Leave', '2021-02-01 14:15:43', 'HRAdmin', 'Jose Manalo', 'Manganganak', 'recommended', 'Full-Time', 'Yes', 'Computer Studies Department', '', '', '2021-02-01 12:42:17', NULL, NULL, '', '', '', '', '', '', '', '', ''),
(9, 'JM BERNALES', '2021-02-02 16:38:03', '2021-02-10', '2021-02-13', 'Sick Leave', '2021-02-02 16:43:38', 'HRAdmin', NULL, 'may sakit ako ', 'accepted', 'Full-Time', 'Yes', 'Computer Studies Department', 'Joy Buena', 'Milo Dixon', NULL, '2021-02-02 16:40:11', '2021-02-02 16:42:16', '', '', '', '', '', '', '', '', ''),
(10, 'JM BERNALES', '2021-02-04 00:22:18', '2021-02-10', '2021-02-15', 'Sick Leave', '2021-02-17 14:24:14', 'Jose Manalo', 'Jose Manalo', 'admitted ', 'rejected', 'Part-Time', 'No', 'Computer Studies Department', 'Joy Buena', '', '2021-02-04 07:25:47', '2021-02-04 07:26:40', NULL, '', '', '', '', '', '', '', '', 'Sig-2021-02-17-Manalo.JPG'),
(11, 'keyl bernales', '2021-02-09 12:03:51', '2021-02-10', '2021-02-15', 'Service Incentive Leave', '2021-02-09 12:09:19', 'HRAdmin', 'rex santiago', 'i want a leave', 'accepted', 'Regular', 'Yes', 'Engineering and Architecture Department', '', 'Milo Dixon', '2021-02-09 12:06:54', NULL, '2021-02-09 12:08:30', '', '', '', '', '', '', '', '', ''),
(13, 'James Smith', '2021-02-17 14:07:32', '2021-02-18', '2021-02-19', 'Sick Leave', '2021-02-17 14:56:29', 'HRAdmin', 'Jose Manalo', 'Sinat', 'accepted', 'Regular', 'No', 'Computer Studies Department', 'Joy Buena', 'Milo Dixon', '2021-02-17 14:24:34', '2021-02-17 14:37:41', '2021-02-17 14:51:49', '', 'sig0.JPG', 'Sig-2021-02-17-Manalo.JPG', 'Sig-2021-02-17-Buena.jpg', 'Sig-2021-02-17-Dixon.JPG', 'sig.JPG', 'Department Head', 'School Nurse', '');

-- --------------------------------------------------------

--
-- Table structure for table `ncst-departments`
--

CREATE TABLE `ncst-departments` (
  `id` int(11) NOT NULL,
  `department` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ncst-departments`
--

INSERT INTO `ncst-departments` (`id`, `department`, `type`) VALUES
(1, 'Campus Manager Department', 'Office'),
(3, 'Human Resource', 'Office'),
(4, 'Academics Department', 'Office'),
(5, 'Guidance', 'Office'),
(6, 'Library', 'Office'),
(7, 'Computer Studies Department', 'Course'),
(8, 'Engineering and Architecture Department', 'Course'),
(9, 'Criminal Justice Department', 'Course'),
(11, 'Psychology Department', ''),
(12, 'Nurse Department', ''),
(13, 'Faculty', ''),
(14, 'Administration', '');

-- --------------------------------------------------------

--
-- Table structure for table `ncst-positions`
--

CREATE TABLE `ncst-positions` (
  `id` int(11) NOT NULL,
  `position` varchar(50) NOT NULL,
  `Department` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ncst-positions`
--

INSERT INTO `ncst-positions` (`id`, `position`, `Department`) VALUES
(1, 'Supervisor', ''),
(3, 'Instructor', ''),
(5, 'College Dean', ''),
(6, 'Department Head', ''),
(7, 'Staff', ''),
(8, 'HR', ''),
(13, 'School Nurse', ''),
(14, 'Campus Manager', ''),
(15, 'Faculty', ''),
(16, 'Department Coordinator', '');

-- --------------------------------------------------------

--
-- Table structure for table `official_businesses`
--

CREATE TABLE `official_businesses` (
  `id` int(11) NOT NULL,
  `requested_by` varchar(150) NOT NULL,
  `requested_at` datetime NOT NULL DEFAULT current_timestamp(),
  `date` date NOT NULL,
  `office_to_visit` varchar(150) NOT NULL,
  `person_to_visit` varchar(150) NOT NULL,
  `purpose_of_visit` text NOT NULL,
  `mode_of_transport` varchar(150) NOT NULL,
  `approved_at` datetime DEFAULT NULL,
  `approved_by` varchar(150) DEFAULT NULL,
  `recommended_by` varchar(150) DEFAULT NULL,
  `status` varchar(150) NOT NULL DEFAULT 'pending',
  `employee_id` varchar(50) NOT NULL,
  `department` varchar(150) NOT NULL,
  `designation` varchar(150) NOT NULL,
  `eta` time NOT NULL,
  `etd` time NOT NULL,
  `origin` varchar(150) NOT NULL,
  `origin_etd` time NOT NULL,
  `destination` varchar(150) NOT NULL,
  `desti_eta` time NOT NULL,
  `remarks` varchar(150) NOT NULL,
  `emp_signature` varchar(150) NOT NULL,
  `recommendor_signature` varchar(100) NOT NULL,
  `approver_signature` varchar(100) NOT NULL,
  `recommendor_position` varchar(100) NOT NULL,
  `reject_signature` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `official_businesses`
--

INSERT INTO `official_businesses` (`id`, `requested_by`, `requested_at`, `date`, `office_to_visit`, `person_to_visit`, `purpose_of_visit`, `mode_of_transport`, `approved_at`, `approved_by`, `recommended_by`, `status`, `employee_id`, `department`, `designation`, `eta`, `etd`, `origin`, `origin_etd`, `destination`, `desti_eta`, `remarks`, `emp_signature`, `recommendor_signature`, `approver_signature`, `recommendor_position`, `reject_signature`) VALUES
(2, 'Dannel Ponan', '2020-06-28 11:21:51', '2020-06-29', 'malacanang', 'prrd', 'bash', 'Public Vehicle', '2020-06-28 11:22:48', 'HRAdmin', 'romel', 'accepted', '', '', '', '00:00:00', '00:00:00', '', '00:00:00', '', '00:00:00', '', '', '', '', '', ''),
(4, 'JM BERNALES', '2020-11-24 14:23:41', '2020-11-25', 'SM dasma', 'lili', 'propose', 'Personal Vehicle', NULL, NULL, NULL, 'pending', '', '', '', '00:00:00', '00:00:00', '', '00:00:00', '', '00:00:00', '', '', '', '', '', ''),
(5, 'JM BERNALES', '2021-02-01 23:50:43', '2021-02-12', 'HR Office', 'Ms. Caroline', 'Business', 'Personal Vehicle', '2021-02-13 23:28:32', 'HRAdmin', 'Jose Manalo', 'rejected', '2020-1234', 'Computer Studies Department', 'NCST IRT', '09:30:00', '09:00:00', 'Home', '09:05:00', 'School', '09:35:00', '', '', '', '', '', ''),
(6, 'keyl bernales', '2021-02-02 00:03:15', '2021-02-18', 'Secretary Office', 'Ms. Joana', 'Date', 'School Vehicle', '2021-02-17 16:41:21', 'HRAdmin', 'rex santiago', 'accepted', '2020-0002', 'Engineering and Architecture Department', 'Manila ', '12:00:00', '10:00:00', 'Home', '10:00:00', 'School', '13:00:00', '', '', '', 'sig.JPG', '', ''),
(7, 'James Smith', '2021-02-17 16:27:30', '2021-02-18', 'Faculty', 'Sir. Josh ', 'Get Documents', 'Personal Vehicle', '2021-02-17 16:55:47', 'HRAdmin', 'Jose Manalo', 'accepted', '2001-2001', 'Computer Studies Department', 'IRT Campus', '17:30:00', '16:26:00', 'School', '16:27:00', 'School', '17:30:00', '', 'sig0.JPG', 'Sig-2021-02-17-Manalo.JPG', 'sig.JPG', 'Department Head', '');

-- --------------------------------------------------------

--
-- Table structure for table `overtimes`
--

CREATE TABLE `overtimes` (
  `id` int(11) NOT NULL,
  `requested_by` varchar(150) NOT NULL,
  `requested_at` datetime NOT NULL DEFAULT current_timestamp(),
  `date` date NOT NULL,
  `hours` float NOT NULL,
  `reason` text NOT NULL,
  `approved_at` datetime DEFAULT NULL,
  `recommended_by` varchar(150) NOT NULL,
  `approved_by` varchar(150) DEFAULT NULL,
  `status` varchar(150) NOT NULL DEFAULT 'pending',
  `department` varchar(150) NOT NULL,
  `position` varchar(150) NOT NULL,
  `employee_id` varchar(50) NOT NULL,
  `remarks` varchar(150) NOT NULL,
  `emp_signature` varchar(150) NOT NULL,
  `recommendor_position` varchar(100) NOT NULL,
  `recommendor_signature` varchar(100) NOT NULL,
  `approver_signature` varchar(100) NOT NULL,
  `reject_signature` varchar(100) NOT NULL,
  `recommended_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `overtimes`
--

INSERT INTO `overtimes` (`id`, `requested_by`, `requested_at`, `date`, `hours`, `reason`, `approved_at`, `recommended_by`, `approved_by`, `status`, `department`, `position`, `employee_id`, `remarks`, `emp_signature`, `recommendor_position`, `recommendor_signature`, `approver_signature`, `reject_signature`, `recommended_at`) VALUES
(3, 'qwe', '2020-06-26 20:59:10', '2020-06-26', 3, 'NCST System', '2021-02-09 08:54:57', '', 'HRAdmin', 'recommended', '', '', '', '', '', '', '', '', '', NULL),
(4, 'JM BERNALES', '2020-08-01 18:54:05', '2020-08-02', 5, 'dagdag income', '2020-08-01 18:59:28', '', 'HRAdmin', 'rejected', '', '', '', '', '', '', '', '', '', NULL),
(6, 'JM BERNALES', '2020-11-24 15:10:30', '2020-11-25', 3, 'sick', NULL, '', NULL, 'pending', '', '', '', '', '', '', '', '', '', NULL),
(7, 'JM BERNALES', '2021-02-02 10:13:50', '2021-02-03', 5, 'Finishing Outputs', '2021-02-02 10:44:45', 'Jose Manalo', 'HRAdmin', 'pending', 'Computer Studies Department', 'Instructor', '2020-1234', '', '', '', '', '', '', NULL),
(8, 'keyl bernales', '2021-02-02 10:14:55', '2021-02-02', 2, 'salary increase', '2021-02-15 03:28:52', 'rex santiago', 'HRAdmin', 'accepted', 'Engineering and Architecture Department', 'Instructor', '2020-0002', '', '', '', '', '', '', NULL),
(9, 'keyl bernales', '2021-02-02 11:38:55', '2021-02-02', 3, 'Encoding', NULL, '', NULL, 'pending', 'Engineering and Architecture Department', 'Instructor', '2020-0002', '', '', '', '', '', '', NULL),
(11, 'James Smith', '2021-02-17 17:06:17', '2021-02-18', 2, 'rushing deadlines', '2021-02-17 17:24:25', 'Jose Manalo', 'HRAdmin', 'accepted', 'Computer Studies Department', 'Instructor', '2001-2001', '', 'sig0.JPG', 'Department Head', 'Sig-2021-02-17-Manalo.JPG', 'sig.JPG', '', '2021-02-17 17:15:58'),
(12, 'James Smith', '2021-02-17 17:07:01', '2021-02-20', 4, 'badly need overtime', NULL, 'Jose Manalo', NULL, 'recommended', 'Computer Studies Department', 'Instructor', '2001-2001', '', 'sig0.JPG', 'Department Head', 'Sig-2021-02-17-Manalo.JPG', '', '', '2021-02-17 17:16:02'),
(13, 'James Smith', '2021-02-17 17:07:22', '2021-02-20', 15, 'testing', '2021-02-17 17:15:51', '', 'Jose Manalo', 'rejected', 'Computer Studies Department', 'Instructor', '2001-2001', 'invalid reason', 'sig0.JPG', '', '', '', 'Sig-2021-02-17-Manalo.JPG', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pending-user`
--

CREATE TABLE `pending-user` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `employee_id` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `department` varchar(50) NOT NULL,
  `position` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pending-user`
--

INSERT INTO `pending-user` (`id`, `firstname`, `lastname`, `employee_id`, `address`, `contact`, `email`, `password`, `department`, `position`) VALUES
(3, 'sample', 'sample2', '2019-2019', 'sample sample', '09000000000', 'sample@sample.sample', 'Qwerqwer1', 'Engineering and Architecture Department', 'Supervisor'),
(7, 'Danilo', 'Albay', '0001-0001', 'Dasmarinas Cavite', '09155008412', 'danilo.albay@gmail.com', 'Qwerqwer1', 'Computer Studies Department', 'Instructor');

-- --------------------------------------------------------

--
-- Table structure for table `substitutions`
--

CREATE TABLE `substitutions` (
  `id` int(11) NOT NULL,
  `requested_by` varchar(150) NOT NULL,
  `requested_at` datetime NOT NULL DEFAULT current_timestamp(),
  `date` datetime NOT NULL,
  `instructor` varchar(150) NOT NULL,
  `subject` varchar(150) NOT NULL,
  `section` varchar(150) NOT NULL,
  `time` time NOT NULL,
  `hours` int(11) NOT NULL,
  `absent_instructor` varchar(150) NOT NULL,
  `approved_at` datetime DEFAULT NULL,
  `recommended_by` varchar(150) NOT NULL,
  `approved_by` varchar(150) DEFAULT NULL,
  `status` varchar(150) NOT NULL DEFAULT 'pending',
  `department` varchar(150) NOT NULL,
  `position` varchar(150) NOT NULL,
  `noted_by` varchar(150) NOT NULL,
  `noted_at` datetime DEFAULT NULL,
  `remarks` varchar(150) NOT NULL,
  `noter_signature` varchar(150) NOT NULL,
  `approver_signature` varchar(150) NOT NULL,
  `emp_signature` varchar(150) NOT NULL,
  `noter_position` varchar(100) NOT NULL,
  `approver_position` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `substitutions`
--

INSERT INTO `substitutions` (`id`, `requested_by`, `requested_at`, `date`, `instructor`, `subject`, `section`, `time`, `hours`, `absent_instructor`, `approved_at`, `recommended_by`, `approved_by`, `status`, `department`, `position`, `noted_by`, `noted_at`, `remarks`, `noter_signature`, `approver_signature`, `emp_signature`, `noter_position`, `approver_position`) VALUES
(1, 'qwe', '2020-06-26 21:16:00', '2020-06-26 00:00:00', 'Joe', 'IT 66', '6', '21:11:00', 6, 'June', '2020-06-26 21:27:55', '', 'HRAdmin', 'rejected', '', '', '', NULL, 'Denied', '', '', '', '', ''),
(2, 'JM BERNALES', '2020-11-21 17:43:34', '2020-11-21 00:00:00', 'trina', 'IT 66', 'qwe', '17:43:00', 2, 'gapit', NULL, '', NULL, 'pending', 'Computer Studies Department', '', '', NULL, '', '', '', '', '', ''),
(3, 'marco lizo', '2021-02-07 20:00:58', '2021-02-08 00:00:00', 'Sir. John', 'COMP001', 'BSIT11A1', '09:00:00', 3, 'Sir. Paul', '2021-02-09 09:00:49', '', 'yanny venz', 'accepted', 'Faculty', '', 'marco lizo', '2021-02-09 08:56:27', '', '', '', '', '', ''),
(4, 'James Smith', '2021-02-16 13:33:11', '2021-02-17 00:00:00', 'Sir. James Smith', 'ENG101', '11A1', '14:30:00', 2, 'Ms. Riza Fardo', '2021-02-16 13:50:22', '', 'Yanny Venz', 'accepted', 'Computer Studies Department', '', 'Marco Lizo', '2021-02-16 13:44:18', '', 'college-dean.JPG', 'dept-coor.JPG', 'sig0.JPG', '', ''),
(5, 'Marco Lizo', '2021-02-16 13:57:22', '2021-02-19 00:00:00', 'Ms. Jasmine', 'FIL002', '21A1', '16:00:00', 1, 'Mr. Jason Orina', '2021-02-16 14:05:53', '', 'Marco Lizo', 'rejected', 'Faculty', '', '', NULL, 'Not applicable', '', 'college-dean.JPG', 'college-dean.JPG', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `undertimes`
--

CREATE TABLE `undertimes` (
  `id` int(11) NOT NULL,
  `requested_by` varchar(150) NOT NULL,
  `requested_at` datetime NOT NULL DEFAULT current_timestamp(),
  `date` datetime NOT NULL,
  `time_in` time NOT NULL,
  `time_out` time NOT NULL,
  `reason` text NOT NULL,
  `approved_at` datetime DEFAULT NULL,
  `recommended_by` varchar(150) NOT NULL,
  `approved_by` varchar(150) DEFAULT NULL,
  `status` varchar(150) NOT NULL DEFAULT 'pending',
  `sick` varchar(50) NOT NULL,
  `employee_id` varchar(50) NOT NULL,
  `department` varchar(50) NOT NULL,
  `endorser_position` varchar(50) NOT NULL,
  `emp_signature` varchar(150) NOT NULL,
  `reco_signature` varchar(150) NOT NULL,
  `adm_signature` varchar(150) NOT NULL,
  `remarks` varchar(150) NOT NULL,
  `recommended_at` datetime DEFAULT NULL,
  `reject_signature` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `undertimes`
--

INSERT INTO `undertimes` (`id`, `requested_by`, `requested_at`, `date`, `time_in`, `time_out`, `reason`, `approved_at`, `recommended_by`, `approved_by`, `status`, `sick`, `employee_id`, `department`, `endorser_position`, `emp_signature`, `reco_signature`, `adm_signature`, `remarks`, `recommended_at`, `reject_signature`) VALUES
(2, 'JM BERNALES', '2020-08-01 18:55:43', '2020-08-11 00:00:00', '19:00:00', '22:00:00', 'ayaw ko na mag work', '2020-08-01 18:59:19', '', 'HRAdmin', 'accepted', '', '', '', '', '', '', '', '', NULL, ''),
(5, 'JM BERNALES', '2020-12-14 16:10:30', '2020-12-17 00:00:00', '16:00:00', '20:00:00', 'slacking off', '2021-02-01 21:20:32', 'Jose Manalo', 'Jose Manalo', 'pending', 'no', '2020-1234', 'Computer Studies Department', 'Supervisor', '', '', '', '', NULL, ''),
(10, 'JM BERNALES', '2021-02-01 16:37:19', '2021-02-01 00:00:00', '16:30:00', '17:30:00', 'early out', '2021-02-01 22:20:41', 'Joy Buena', 'HRAdmin', 'pending', 'yes', '2020-1234', 'Computer Studies Department', 'School Nurse', '', '', '', '', NULL, ''),
(11, 'keyl bernales', '2021-02-02 17:06:14', '2021-02-02 00:00:00', '07:00:00', '18:06:00', 'sdadadad', '2021-02-15 10:39:33', 'rex santiago', 'HRAdmin', 'rejected', 'no', '2020-0002', 'Engineering and Architecture Department', 'Supervisor', '', '', 'sig.JPG', 'Reason not clear', NULL, ''),
(12, 'keyl bernales', '2021-02-02 17:06:38', '2021-02-17 00:00:00', '17:06:00', '18:06:00', 'siiisck', '2021-02-02 17:08:51', 'Joy Buena', NULL, 'endorsed', 'yes', '2020-0002', 'Engineering and Architecture Department', '', '', '', '', '', NULL, ''),
(17, 'James Smith', '2021-02-17 18:06:15', '2021-02-17 00:00:00', '16:00:00', '18:30:00', 'emergency', NULL, 'Jose Manalo', NULL, 'endorsed', 'no', '2001-2001', 'Computer Studies Department', 'Department Head', 'sig0.JPG', 'Sig-2021-02-17-Manalo.JPG', '', '', '2021-02-17 18:28:11', ''),
(18, 'James Smith', '2021-02-17 18:07:28', '2021-02-18 00:00:00', '17:00:00', '18:00:00', 'suddenly ill', '2021-02-17 18:47:13', 'Joy Buena', 'HRAdmin', 'accepted', 'yes', '2001-2001', 'Computer Studies Department', 'School Nurse', 'sig0.JPG', 'Sig-2021-02-17-Buena.jpg', 'sig.JPG', '', '2021-02-17 18:38:00', ''),
(19, 'James Smith', '2021-02-17 18:07:55', '2021-02-10 00:00:00', '18:07:00', '18:07:00', 'testing for reject', '2021-02-17 18:25:25', '', 'Jose Manalo', 'rejected', 'no', '2001-2001', 'Computer Studies Department', '', 'sig0.JPG', '', '', 'Reason not applicable', NULL, 'Sig-2021-02-17-Manalo.JPG'),
(20, 'James Smith', '2021-02-17 18:08:56', '2021-02-20 00:00:00', '18:08:00', '20:08:00', 'early out', NULL, '', NULL, 'pending', 'no', '2001-2001', 'Computer Studies Department', '', 'sig0.JPG', '', '', '', NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `department` varchar(50) NOT NULL,
  `position` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `employee_id` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `created_msg` varchar(150) NOT NULL,
  `signature` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `user_name`, `password`, `role`, `name`, `department`, `position`, `firstname`, `lastname`, `email`, `employee_id`, `address`, `contact`, `created_msg`, `signature`) VALUES
(5, 'admin', '123', 'hr', 'HRAdmin', 'Human Resource', 'Administrator', 'Juan', 'Dela Cruz', 'delacruz.juan@gmail.com', '2020-0001', '', '0', 'This account was created by the Administrator.', 'sig.JPG'),
(6, 'user1', '1234', 'employee', 'JM BERNALES', 'Computer Studies Department', 'Instructor', 'Jm', 'Bernales', 'bernales.jm@gmail.com', '2020-1234', 'Cavite', '09123456781', 'This account was created by the Administrator.', 'Sig-2021-02-16-Bernales.JPG'),
(7, '20210104', 'Daichi', '', 'Karube Daichi', 'Campus Manager Department', 'College Dean', 'Karube', 'Daichi', 'karube@gmail.com', '20210104', 'Tokyo Japan', '09155008412', 'This account was created by the Administrator.', ''),
(62, '2001-2001', 'Qwerqwer1', 'employee', 'James Smith', 'Computer Studies Department', 'Instructor', 'James', 'Smith', 'keyl@gmail.com', '2001-2001', 'Silang Cavite', '09770436418', 'This account was created by this User.', 'sig0.JPG'),
(63, '2021-2101', 'Manalo', 'employee', 'Jose Manalo', 'Computer Studies Department', 'Department Head', 'Jose', 'Manalo', 'jose.manalo@yahoo.com', '2021-2101', '1441 Dasmarinas Cavite', '09123456789', 'This account was created by the Administrator.', 'Sig-2021-02-17-Manalo.JPG'),
(64, '2021-2102', 'Buena', 'employee', 'Joy Buena', 'Nurse Department', 'School Nurse', 'Joy', 'Buena', 'joy.buena@gmail.com', '2021-2102', 'Brgy 1 Salitran Cavite', '09123456788', 'This account was created by the Administrator.', 'Sig-2021-02-17-Buena.jpg'),
(65, '2021-2103', 'Dixon', 'employee', 'Milo Dixon', 'Campus Manager Department', 'Campus Manager', 'Milo', 'Dixon', 'dixon.milo@gmail.com', '2021-2103', 'Paliparan Cavite', '09123456787', 'This account was created by the Administrator.', 'Sig-2021-02-17-Dixon.JPG'),
(66, '2020-0002', 'bernales', 'employee', 'keyl bernales', 'Engineering and Architecture Department', 'Instructor', 'keyl', 'bernales', 'keyl.bernales@yahoo.com', '2020-0002', 'Bulihan Silang Cavite', '09770436418', 'This account was created by the Administrator.', ''),
(67, '2020-0003', 'santiago', 'employee', 'rex santiago', 'Engineering and Architecture Department', 'Department Head', 'rex', 'santiago', 'santiago12@gmail.com', '2020-0003', 'GMA Cavite', '09123456786', 'This account was created by the Administrator.', ''),
(68, '2020-0004', 'lizo', 'employee', 'Marco Lizo', 'Faculty', 'College Dean', 'marco', 'lizo', 'lizo.marco@gmail.com', '2020-0004', 'Alta Tierra GMA ', '09123456785', 'This account was created by the Administrator.', 'college-dean.JPG'),
(69, '2020-0005', 'venz', 'employee', 'Yanny Venz', 'Computer Studies Department', 'Department Coordinator', 'yanny', 'venz', 'yanny.venz1@yahoo.com', '2020-0005', 'Tahanan Village GMA', '09123456784', 'This account was created by the Administrator.', 'dept-coor.JPG'),
(70, '0001-0001', 'Atanacio', 'employee', 'Eric Atanacio', 'Administration', 'Director of Administration', 'Eric', 'Atanacio', 'atanacio.eric@gmail.com', '0001-0001', 'Amafel Bldg. Dasmarinas', '09123456799', 'This account was created by the Administrator.', 'Sig-2021-02-17-Atanacio.JPG');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cash_advances`
--
ALTER TABLE `cash_advances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leaves`
--
ALTER TABLE `leaves`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ncst-departments`
--
ALTER TABLE `ncst-departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ncst-positions`
--
ALTER TABLE `ncst-positions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `official_businesses`
--
ALTER TABLE `official_businesses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `overtimes`
--
ALTER TABLE `overtimes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pending-user`
--
ALTER TABLE `pending-user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `substitutions`
--
ALTER TABLE `substitutions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `undertimes`
--
ALTER TABLE `undertimes`
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
-- AUTO_INCREMENT for table `cash_advances`
--
ALTER TABLE `cash_advances`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `leaves`
--
ALTER TABLE `leaves`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `ncst-departments`
--
ALTER TABLE `ncst-departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `ncst-positions`
--
ALTER TABLE `ncst-positions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `official_businesses`
--
ALTER TABLE `official_businesses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `overtimes`
--
ALTER TABLE `overtimes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `pending-user`
--
ALTER TABLE `pending-user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `substitutions`
--
ALTER TABLE `substitutions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `undertimes`
--
ALTER TABLE `undertimes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
