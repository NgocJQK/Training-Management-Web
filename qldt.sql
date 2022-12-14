-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 31, 2022 at 09:47 AM
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qldt`
--

-- --------------------------------------------------------

--
-- Table structure for table `classroom`
--

CREATE TABLE `classroom` (
  `id` int(11) NOT NULL,
  `teaching_id` int(11) NOT NULL,
  `classroom_name` varchar(128) NOT NULL,
  `room_code` varchar(64) NOT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `num_of_student_max` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `classroom`
--

INSERT INTO `classroom` (`id`, `teaching_id`, `classroom_name`, `room_code`, `start_time`, `end_time`, `num_of_student_max`) VALUES
(1, 1, 'B1-308', 'B1-308', '07:00:00', '11:00:00', 30),
(2, 13, 'C2-306', 'C2-306', '13:00:00', '17:00:00', 30),
(3, 2, 'D9-401', 'D9-401', '13:00:00', '17:00:00', 30),
(4, 14, 'D9-402', 'D9-401', '13:00:00', '17:00:00', 30),
(5, 15, 'D9-403', 'D9-403', '13:00:00', '17:00:00', 30),
(6, 16, 'TC-507', 'TC-507', '07:00:00', '11:00:00', 35),
(7, 17, 'B1-302', 'B1-302', '07:00:00', '11:00:00', 40);

-- --------------------------------------------------------

--
-- Table structure for table `point`
--

CREATE TABLE `point` (
  `id` int(11) NOT NULL,
  `study_id` int(11) NOT NULL,
  `point_type` varchar(8) NOT NULL,
  `point` decimal(4,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `point`
--

INSERT INTO `point` (`id`, `study_id`, `point_type`, `point`) VALUES
(1, 1, 'QT', '8.50'),
(3, 1, 'CK', '7.25'),
(4, 2, 'QT', '6.00'),
(6, 2, 'CK', '9.00'),
(7, 3, 'QT', '5.00'),
(9, 3, 'CK', '7.00'),
(10, 4, 'QT', '8.50'),
(12, 4, 'CK', '7.25'),
(13, 5, 'QT', '6.00'),
(15, 5, 'CK', '9.00'),
(16, 6, 'QT', '5.00'),
(18, 6, 'CK', '7.00'),
(23, 13, 'QT', '5.50'),
(24, 13, 'CK', '8.50'),
(25, 19, 'QT', '9.00'),
(26, 19, 'CK', '8.00');

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `training_institute_code` varchar(32) NOT NULL,
  `training_majors_code` varchar(32) NOT NULL,
  `training_system_code` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `profile`
--
INSERT INTO `profile` (`id`, `user_id`, `training_institute_code`, `training_majors_code`, `training_system_code`) VALUES
(1, 4, 'IT', '', ''),
(2, 5, 'IT', '', ''),
(3, 8, 'IT', '', ''),
(4, 14, 'IT', 'ITE6', 'CTTT'),
(5, 15, 'IT', 'ITE6', 'CTTT');


-- --------------------------------------------------------

--
-- Table structure for table `studying`
--

CREATE TABLE `studying` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `subject_code` varchar(32) NOT NULL,
  `classroom_id` int(11) NOT NULL,
  `status` varchar(32) NOT NULL DEFAULT 'register',
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `studying`
--

INSERT INTO `studying` (`id`, `student_id`, `subject_code`, `classroom_id`, `status`, `start_date`, `end_date`) VALUES
(1, 4, 'ITE6IT2110', 2, 'studying', NULL, NULL),
(2, 4, 'ITE6IT2120', 4, 'studying', NULL, NULL),
(3, 4, 'ITE6IT2121', 5, 'studying', NULL, NULL),
(4, 5, 'ITE6IT2110', 2, 'studying', NULL, NULL),
(5, 5, 'ITE6IT2120', 4, 'studying', NULL, NULL),
(6, 5, 'ITE6IT2121', 5, 'studying', NULL, NULL),
(7, 6, 'ITE6IT2110', 2, 'studying', NULL, NULL),
(8, 6, 'ITE6IT2120', 4, 'studying', NULL, NULL),
(9, 6, 'ITE6IT2121', 5, 'studying', NULL, NULL),
(10, 7, 'ITE6IT2110', 2, 'studying', NULL, NULL),
(11, 7, 'ITE6IT2120', 4, 'studying', NULL, NULL),
(12, 7, 'ITE6IT2121', 5, 'studying', NULL, NULL),
(13, 5, 'IT3292', 1, 'register', NULL, NULL),
(14, 4, 'IT3292', 1, 'register', NULL, NULL),
(15, 4, 'IT3160', 3, 'register', NULL, NULL),
(16, 5, 'IT3160', 3, 'register', NULL, NULL),
(17, 4, 'IT3011', 6, 'register', NULL, NULL),
(18, 5, 'IT3011', 6, 'register', NULL, NULL),
(19, 4, 'IT3210', 7, 'register', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `id` int(11) NOT NULL,
  `training_majors_code` varchar(32) NOT NULL,
  `training_system_code` varchar(32) NOT NULL,
  `subject_code` varchar(32) NOT NULL,
  `subject_name` varchar(128) NOT NULL,
  `num_of_credit` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`id`, `training_majors_code`, `training_system_code`, `subject_code`, `subject_name`, `num_of_credit`) VALUES
(1, 'ITE6', 'CTTT', 'ITE6IT2110', 'Nh???p m??n CNTT & TT', 2),
(2, 'ITE6', 'CTTT', 'ITE6IT2120', 'Ki???n th???c m??y t??nh ', 2),
(3, 'ITE6', 'CTTT', 'ITE6IT2121', '??i???n t??? cho CNTT Lab', 2),
(4, 'ITE6', 'CTTT', 'ITE63011', 'C???u tr??c d??? li???u v?? thu???t to??n', 3),
(5, 'ITE6', 'CTTT', 'IT3210', 'C Programming Language', 2),
(6, 'ITE6', 'CTTT', 'IT3220', 'C Programming Introduction', 3),
(7, 'ITE6', 'CTTT', 'IT3280', 'Th???c h??nh ki???n tr??c m??y t??nh', 2),
(8, 'ITE6', 'CTTT', 'IT3283', 'Ki???n tr??c m??y t??nh', 3),
(9, 'ITE6', 'CTTT', 'IT3292', 'C?? s??? d??? li???u', 3),
(10, 'ITE6', 'CTTT', 'IT3230', 'L???p tr??nh C c?? b???n', 2),
(11, 'ITE6', 'CTTT', 'IT3160', 'Nh???p m??n Tr?? tu??? nh??n t???o', 3),
(12, 'ITE6', 'CTTT', 'IT3170', 'Thu???t to??n ???ng d???ng', 3),
(13, 'ITE6', 'CTTT', 'IT3103', 'L???p tr??nh h?????ng ?????i t?????ng', 3),
(14, 'ITE6', 'CTTT', 'IT2030', 'Technical Writing and Presentation', 3),
(15, 'ITE6', 'CTTT', 'IT4015', 'Nh???p m??n an to??n th??ng tin', 3),
(16, 'ITE6', 'CTTT', 'IT4082', 'K??? thu???t ph???n m???m', 3),
(17, 'ITE6', 'CTTT', 'IT3290', 'Th???c h??nh c?? s??? d??? li???u', 3),
(18, 'ITE6', 'CTTT', 'IT3362', 'Ky?? n??ng ITSS ho??c b????ng ti????ng Nh????t 1', 2),
(19, 'ITE6', 'CTTT', 'IT3420', '??i???n t??? cho CNTT', 3),
(20, 'ITE6', 'CTTT', 'IT4110', 'T??nh to??n khoa h???c', 3),
(21, 'ITE6', 'CTTT', 'IT4172', 'X??? l?? t??n hi???u', 3),
(22, 'IT1', 'CQ', 'IT2110', 'Nh???p m??n CNTT & TT', 3),
(23, 'IT1', 'CQ', 'IT12121', 'Ki???n th???c m??y t??nh', 3),
(24, 'IT1', 'CQ', 'IT2122', '??i???n t??? cho CNTT Lab', 3),
(25, 'IT1', 'CQ', 'IT3011', 'C???u tr??c d??? li???u v?? thu???t to??n', 2),
(26, 'IT1', 'CQ', 'IT3210', 'C Programming Language', 3),
(27, 'IT1', 'CQ', 'IT3220', 'C Programming Introduction', 2),
(28, 'IT1', 'CQ', 'IT3280', 'Th???c h??nh ki???n tr??c m??y t??nh', 2),
(29, 'IT1', 'CQ', 'IT3283', 'Ki???n tr??c m??y t??nh', 3),
(30, 'IT1', 'CQ', 'IT3170', 'Thu???t to??n ???ng d???ng', 2),
(31, 'IT1', 'CQ', 'IT3103', 'L???p tr??nh h?????ng ?????i t?????ng', 2),
(32, 'IT1', 'CQ', 'IT2030', 'Technical Writing and Presentation', 3),
(33, 'IT1', 'CQ', 'IT4015', 'Nh???p m??n an to??n th??ng tin', 3),
(34, 'ITE6', 'CTTT', 'MI1114', 'Gi???i t??ch I', 2),
(35, 'ITE6', 'CTTT', 'MI1124', 'Gi???i t??ch II', 3),
(36, 'ITE6', 'CTTT', 'MI1134', 'Gi???i t??ch III', 2),
(37, 'ITE6', 'CTTT', 'MI1144', 'Ph????ng tr??nh vi ph??n v?? chu???i', 3),
(38, 'ITE6', 'CTTT', 'MI2021', 'X??c su???t th???ng k??', 2),
(39, 'MI1', 'CQ', 'NE1110', 'V???t l?? ?????i c????ng I', 3),
(40, 'MI1', 'CQ', 'NE1120', 'V???t l?? ?????i c????ng II', 3),
(41, 'MI1', 'CQ', 'NE1130', 'V???t l?? ?????i c????ng III', 3),
(42, 'MI1', 'CQ', 'NE1140', 'V???t l?? k??? thu???t', 3),
(43, 'MI1', 'CQ', 'ED3220', 'K??? n??ng m???m', 2),
(44, 'MI1', 'CQ', 'ED3280', 'T??m l?? h???c ???ng d???ng', 2),
(45, 'MI1', 'CQ', 'EM1010', 'Qu???n tr??? h???c ?????i c????ng', 2),
(46, 'MI1', 'CQ', 'SSH1010', 'Tri???t h???c M??c-L??nin', 2),
(47, 'MI1', 'CQ', 'SSH1020', 'Kinh t??? ch??nh tr???', 3),
(48, 'MI1', 'CQ', 'SSH1030', 'L???ch s??? ?????ng CSVN', 3),
(49, 'MI1', 'CQ', 'SSH1040', 'CNXH khoa ho??c', 3),
(50, 'MI1', 'CQ', 'MI1114', 'Gi???i t??ch I', 3),
(51, 'MI1', 'CQ', 'MI1124', 'Gi???i t??ch II', 2),
(52, 'MI1', 'CQ', 'MI1134', 'Gi???i t??ch III', 3),
(53, 'MI1', 'CQ', 'MI1144', 'Ph????ng tr??nh vi ph??n v?? chu???i', 2),
(54, 'MI1', 'CQ', 'MI2021', 'X??c su???t th???ng k??', 3),
(55, 'MS1', 'CQ', 'MT2101', 'Th???y l???c trong CNMT', 2),
(56, 'MS1', 'CQ', 'MT2102', 'Th???y Nhi???t trong CNMT', 2),
(57, 'MS1', 'CQ', 'MT3103', 'Chuy???n kh???i trong CNMT', 3),
(58, 'MS1', 'CQ', 'MT3104', 'K??? thu???t ph???n ???ng', 2),
(59, 'MS1', 'CQ', 'MT3105', 'H??a sinh m??i tr?????ng', 2),
(60, 'MS1', 'CQ', 'MT3106', 'H??a h???c m??i tr?????ng', 3),
(61, 'MS1', 'CQ', 'MT3107', 'Vi sinh m??i tr?????ng', 2),
(62, 'MS1', 'CQ', 'MT3118', 'K??? thu???t ki???m so??t ?? nhi???m kh??ng kh??', 3),
(63, 'MS1', 'CQ', 'MT3118', 'K??? thu???t s??? l?? n?????c th???i', 2),
(64, 'MS1', 'CQ', 'VL2000', 'Nh???p m??n KH&KT v???t li???u', 3),
(65, 'MS1', 'CQ', 'VL2010', 'Nh???p m??n luy???n kim v?? k??? thu???t v???t li???u', 3),
(66, 'MS1', 'CQ', 'VL2013', 'Khoa h???c v???t li???u ?????i c????ng', 3),
(67, 'MS1', 'CQ', 'VL2020', 'Nhi???t ?????ng h???c v???t li???u', 2),
(68, 'MS1', 'CQ', 'VL2023', 'S??? h??nh th??nh t??? ch???c t??? vi v???t li???u', 2),
(69, 'MS1', 'CQ', 'VL2025', 'Ph????ng ph??p t??nh to??n v???t li???u', 2),
(70, 'MS1', 'CQ', 'VL2030', 'C?? s??? v???t li???u h???c', 2),
(71, 'MS1', 'CQ', 'VL2040', 'H??a h???c ch???t r???n', 3),
(72, 'MS1', 'CQ', 'VL2041', 'C??ng ngh??? v???t li???u kim lo???i', 3),
(73, 'MS1', 'CQ', 'VL2050', 'Ph????ng ph??p t??nh to??n v???t li???u', 3),
(74, 'ED1', 'CQ', 'EM1010', 'Qu???n tr??? h???c ?????i c????ng', 3),
(75, 'ED1', 'CQ', 'EM1100', 'Kinh t??? vi m?? ?????i c????ng', 2),
(76, 'ED1', 'CQ', 'EM1180', 'V??n h??a kinh doanh v?? tinh th???n kh???i nghi???p', 2),
(77, 'ED1', 'CQ', 'EM1300', 'Nh???p m??n Qu???n tr??? kinh doanh', 2),
(78, 'ED1', 'CQ', 'EM1410', 'Nh???p m??n Logistics v?? Qu???n l?? chu???i cung ???ng', 3),
(79, 'ED1', 'CQ', 'EM1420', 'C??c h??? th???ng c??ng nghi???p', 2),
(80, 'ED1', 'CQ', 'EM1500', 'Nh???p m??n T??i ch??nh ng??n h??ng', 3),
(81, 'ED1', 'CQ', 'EM1600', 'Nh???p m??n Kinh t??? c??ng nghi???p', 2),
(82, 'ED1', 'CQ', 'EM1700', 'Nh???p m??n K??? to??n', 2),
(83, 'HH1', 'CQ', 'HH1010', 'Ho?? h???c ?????i c????ng', 2),
(84, 'HH1', 'CQ', 'HH2000', 'Nh???p m??n k??? thu???t h??a h???c', 2),
(85, 'HH1', 'CQ', 'HH2004', 'Nh???p m??n K??? thu???t in v?? truy???n th??ng', 2),
(86, 'HH1', 'CQ', 'HH2010', 'C?? s??? h??a h???c v???t li???u', 3),
(87, 'HH1', 'CQ', 'HH2014', 'H??a sinh ?????i c????ng', 3),
(88, 'HH1', 'CQ', 'HH3000', 'H??a l?? 1 (C???u t???o ch???t)', 3),
(89, 'HH1', 'CQ', 'HH3001', 'H??a l?? 1 (m??y ho??)', 3),
(90, 'HH1', 'CQ', 'HH3002', 'H??a l?? (CN sinh h???c v?? th???c ph???m)', 2),
(91, 'HH1', 'CQ', 'HH3003', 'H??a l?? (CN m??i tr?????ng)', 2),
(92, 'HH1', 'CQ', 'HH3004', 'H??a l?? (v???t li???u)', 2),
(93, 'HH1', 'CQ', 'HH3120', 'H??a v?? c??', 2),
(94, 'HH1', 'CQ', 'HH3201', 'H??a h???u c??', 3),
(95, 'FL1', 'CQ', 'FL1010', 'Ti???ng Anh I', 2),
(96, 'FL2', 'CQ', 'FL1020', 'Ti???ng Anh II', 2),
(97, 'FL3', 'CQ', 'FL1023', 'Ng??? ??m th???c h??nh', 3),
(98, 'FL4', 'CQ', 'FL1109', 'Ti???ng Anh 3', 2),
(99, 'FL5', 'CQ', 'FL1147', 'Writing', 2),
(100, 'FL6', 'CQ', 'FL1145', 'Speaking', 3),
(101, 'FL7', 'CQ', 'FL1144', 'Listening', 2),
(102, 'ED1', 'CQ', 'ED3390', 'H??? th???ng qu???n l?? h???c t???p th??? h??? t????ng lai', 2),
(103, 'ED1', 'CQ', 'ED3410', 'L??nh ?????o t??? ch???c ????o t???o', 3),
(104, 'ED1', 'CQ', 'ED4054', 'L?? lu???n d???y h???c chuy??n ng??nh CNTT', 3),
(105, 'ED1', 'CQ', 'ED3220Q', 'K??? n??ng m???m', 3),
(106, 'ED1', 'CQ', 'ED2000', 'Nh???p m??n ng??nh C??ng ngh??? Gi??o d???c', 3),
(107, 'ED1', 'CQ', 'ED3040', 'T??m l?? h???c chuy??n ng??nh', 3),
(108, 'NE1', 'CQ', 'NE2001', 'Nh???p m??n ng??nh V???t l?? y khoa', 2),
(109, 'NE1', 'CQ', 'NE2000', 'Nh???p m??n KT H???t nh??n v?? VLMT', 2),
(110, 'NE1', 'CQ', 'NE3005', 'Gi???i ph???u v?? sinh l?? ng?????i ?????i c????ng', 3),
(111, 'NE1', 'CQ', 'NE3012', 'C?? s??? v???t l?? h???t nh??n', 2),
(112, 'NE1', 'CQ', 'NE3020', 'K??? thu???t h???t nh??n & v???t l?? m??i tr?????ng', 3),
(113, 'NE1', 'CQ', 'NE3044', '??i???n t??? h???t nh??n', 2),
(114, 'NE1', 'CQ', 'BF2701', 'Nh???p m??n k??? thu???t sinh h???c', 3),
(115, 'NE1', 'CQ', 'BF2703', 'Th?? nghi???m h??a sinh', 2),
(116, 'NE1', 'CQ', 'BF2901', 'Nh???p m??n c??ng ngh??? th???c ph???m', 3),
(117, 'NE1', 'CQ', 'BF3011', 'H??a sinh ?????i c????ng', 3),
(118, 'NE1', 'CQ', 'BF3015', 'Qu?? tr??nh v?? thi???t b??? chuy???n kh???i', 2),
(119, 'NE1', 'CQ', 'BF3040', 'Vi sinh th???c ph???m', 3);

-- --------------------------------------------------------

--
-- Table structure for table `teaching`
--

CREATE TABLE `teaching` (
  `id` int(11) NOT NULL,
  `lecturer_id` int(11) NOT NULL,
  `subject_code` varchar(32) NOT NULL,
  `status` varchar(32) NOT NULL DEFAULT 'inprogress'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teaching`
--

INSERT INTO `teaching` (`id`, `lecturer_id`, `subject_code`, `status`) VALUES
(1, 8, 'IT3292', 'inprogress'),
(2, 8, 'IT3160', 'inprogress'),
(3, 8, 'IT3290', 'inprogress'),
(4, 10, 'IT2120', 'inprogress'),
(5, 10, 'IT2121', 'inprogress'),
(6, 10, 'IT3011', 'inprogress'),
(7, 10, 'IT3210', 'inprogress'),
(8, 10, 'IT3220', 'inprogress'),
(9, 10, 'IT3230', 'inprogress'),
(10, 9, 'IT3280', 'inprogress'),
(11, 9, 'IT3283', 'inprogress'),
(12, 9, 'IT4082', 'inprogress'),
(13, 9, 'ITE6IT2110', 'finished'),
(14, 9, 'ITE6IT2120', 'finished'),
(15, 9, 'ITE6IT2121', 'finished'),
(16, 9, 'IT3011', 'inprogress'),
(17, 9, 'IT3210', 'inprogress');

-- --------------------------------------------------------

--
-- Table structure for table `training_institute`
--

CREATE TABLE `training_institute` (
  `id` int(11) NOT NULL,
  `training_institute_code` varchar(32) NOT NULL,
  `training_institute_name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `training_institute`
--

INSERT INTO `training_institute` (`id`, `training_institute_code`, `training_institute_name`) VALUES
(1, 'IT', 'Tr?????ng C??ng Ngh??? Th??ng Tin & Truy???n Th??ng'),
(2, 'DT', 'Tr?????ng ??i???n - ??i???n T???'),
(3, 'CK', 'Tr?????ng C?? Kh??'),
(4, 'MI', 'Vi???n To??n ???ng D???ng v?? Tin H???c'),
(5, 'DM', 'Vi???n D???t may - Da gi???y v?? Th???i trang'),
(6, 'MT', 'Vi???n Khoa h???c v?? C??ng ngh??? M??i tr?????ng'),
(7, 'VL', 'Vi???n Khoa h???c v?? K??? thu???t V???t li???u'),
(8, 'EM', 'Vi???n Kinh t??? v?? Qu???n l??'),
(9, 'HH', 'Vi???n K??? thu???t H??a h???c'),
(10, 'FL', 'Vi???n Ngo???i ng???'),
(11, 'ED', 'Vi???n S?? ph???m K??? thu???t'),
(12, 'NE', 'Vi???n V???t l?? K??? thu???t'),
(13, 'BF', 'Vi???n C??ng ngh??? Sinh h???c v?? C??ng ngh??? Th???c ph???m'),
(14, 'SSH', 'Khoa L?? lu???n Ch??nh tr???'),
(15, 'PE', 'Khoa Gi??o d???c Th??? ch???t'),
(16, 'MIL', 'Khoa Gi??o d???c Qu???c ph??ng & An ninh');

-- --------------------------------------------------------

--
-- Table structure for table `training_majors`
--

CREATE TABLE `training_majors` (
  `id` int(11) NOT NULL,
  `training_institute_code` varchar(32) NOT NULL,
  `training_system_code` varchar(32) NOT NULL,
  `training_majors_code` varchar(32) NOT NULL,
  `training_majors_name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `training_majors`
--

INSERT INTO `training_majors` (`id`, `training_institute_code`, `training_system_code`, `training_majors_code`, `training_majors_name`) VALUES
(1, 'IT', 'CTTT', 'ITE6', 'C??ng Ngh??? Th??ng Tin Vi???t Nh???t'),
(2, 'IT', 'CQ', 'IT1', 'Khoa H???c M??y T??nh'),
(3, 'IT', 'CQ', 'IT2', 'K??? Thu???t M??y T??nh'),
(4, 'DT', 'CQ', 'DT01', '??i???n T??? Vi???n Th??ng'),
(5, 'DT', 'CQ', 'DT02', '??i???u Khi???n v?? T??? ?????ng H??a'),
(6, 'DT', 'CQ', 'DT03', 'C?? ??i???n T??? '),
(7, 'HH', 'CQ', 'HH1', 'K??? Thu???t H??a H???c'),
(8, 'FL', 'CQ', 'FL1', 'Ti???ng Anh cho KHKT');
-- --------------------------------------------------------

--
-- Table structure for table `training_system`
--

CREATE TABLE `training_system` (
  `id` int(11) NOT NULL,
  `training_system_code` varchar(32) NOT NULL,
  `training_system_name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `training_system`
--

INSERT INTO `training_system` (`id`, `training_system_code`, `training_system_name`) VALUES
(1, 'CQ', 'Ch??nh quy'),
(2, 'CTTT', 'Ch????ng tr??nh ti??n ti???n'),
(3, 'LKQT', 'Li??n k???t qu???c t???');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(64) NOT NULL,
  `password` varchar(128) NOT NULL,
  `user_type` varchar(32) NOT NULL,
  `user_code` varchar(32) DEFAULT NULL,
  `fullname` varchar(128) NOT NULL,
  `dob` date NOT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `email` varchar(64) DEFAULT NULL,
  `address` varchar(512) DEFAULT NULL,
  `status` varchar(32) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `user_type`, `user_code`, `fullname`, `dob`, `phone_number`, `email`, `address`, `status`) VALUES
(1, 'admin', '123123', 'admin', NULL, 'Ho??ng Minh Ng???c', '2002-05-01', '0326813947', 'admin@gmail.com', 'H?? N???i', 'active'),
(4, '20200440', '123456', 'student', '20200440', 'Ho??ng Minh Ng???c', '2002-01-05', '0326813947', 'example2.test@gmail.com', 'Hai B?? Tr??ng, H?? N???i', 'active'),
(5, '20205052', '123456', 'student', '20205052', 'Nguy???n ?????c Anh', '2002-12-08', '0912345678', 'example3.test@gmail.com', 'H?? N???i', 'active'),
(6, '20205064', '123456', 'student', '20205064', '?????ng Quang ?????t', '2002-07-16', '0372002727', 'example4.test@gmail.com', 'Th??? tr???n V??ng Giang,H??ng Y??n', 'active'),
(7, '20205057', '123456', 'student', '20205057', 'L?? V??n B???o', '2002-10-29', '0374042972', 'example5.test@gmail.com', 'Th?????ng T??n, H?? N???i', 'active'),
(8, 'phuongnh', 'phuongnh', 'lecturer', 'phuongnh', 'Nguy???n H???ng Ph????ng', '1983-12-10', '0988888888', 'example6.test@gmail.com', 'H?? N???i', 'active'),
(9, 'tiennd', 'tiennd', 'lecturer', 'tiennd', 'Nguy???n ?????c Ti???n', '1982-07-30', '0911111111', 'example7.test@gmail.com', 'H?? N???i', 'active'),
(10, 'quangnh', 'quangnh', 'lecturer', 'quangnh', 'Nguy???n H???ng Quang', '1977-01-12', '0911111111', 'example8.test@gmail.com', 'H?? N???i', 'active'),
(11, 'ACC', '123456', 'lecturer', '001', 'Acc', '1986-05-01', '54364', 'fxdgsx@sdf.sfd', '??fsafda', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classroom`
--
ALTER TABLE `classroom`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `point`
--
ALTER TABLE `point`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `studying`
--
ALTER TABLE `studying`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teaching`
--
ALTER TABLE `teaching`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `training_institute`
--
ALTER TABLE `training_institute`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `training_majors`
--
ALTER TABLE `training_majors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `training_system`
--
ALTER TABLE `training_system`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

--
-- AUTO_INCREMENT for table `classroom`
--
ALTER TABLE `classroom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `point`
--
ALTER TABLE `point`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `studying`
--
ALTER TABLE `studying`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `teaching`
--
ALTER TABLE `teaching`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `training_institute`
--
ALTER TABLE `training_institute`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `training_majors`
--
ALTER TABLE `training_majors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `training_system`
--
ALTER TABLE `training_system`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
