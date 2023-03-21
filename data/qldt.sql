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
(1, 'ITE6', 'CTTT', 'ITE6IT2110', 'Nhập môn CNTT & TT', 2),
(2, 'ITE6', 'CTTT', 'ITE6IT2120', 'Kiến thức máy tính ', 2),
(3, 'ITE6', 'CTTT', 'ITE6IT2121', 'Điện tử cho CNTT Lab', 2),
(4, 'ITE6', 'CTTT', 'ITE63011', 'Cấu trúc dữ liệu và thuật toán', 3),
(5, 'ITE6', 'CTTT', 'IT3210', 'C Programming Language', 2),
(6, 'ITE6', 'CTTT', 'IT3220', 'C Programming Introduction', 3),
(7, 'ITE6', 'CTTT', 'IT3280', 'Thực hành kiến trúc máy tính', 2),
(8, 'ITE6', 'CTTT', 'IT3283', 'Kiến trúc máy tính', 3),
(9, 'ITE6', 'CTTT', 'IT3292', 'Cơ sở dữ liệu', 3),
(10, 'ITE6', 'CTTT', 'IT3230', 'Lập trình C cơ bản', 2),
(11, 'ITE6', 'CTTT', 'IT3160', 'Nhập môn Trí tuệ nhân tạo', 3),
(12, 'ITE6', 'CTTT', 'IT3170', 'Thuật toán ứng dụng', 3),
(13, 'ITE6', 'CTTT', 'IT3103', 'Lập trình hướng đối tượng', 3),
(14, 'ITE6', 'CTTT', 'IT2030', 'Technical Writing and Presentation', 3),
(15, 'ITE6', 'CTTT', 'IT4015', 'Nhập môn an toàn thông tin', 3),
(16, 'ITE6', 'CTTT', 'IT4082', 'Kỹ thuật phần mềm', 3),
(17, 'ITE6', 'CTTT', 'IT3290', 'Thực hành cơ sở dữ liệu', 3),
(18, 'ITE6', 'CTTT', 'IT3362', 'Kỹ năng ITSS học bằng tiếng Nhật 1', 2),
(19, 'ITE6', 'CTTT', 'IT3420', 'Điện tử cho CNTT', 3),
(20, 'ITE6', 'CTTT', 'IT4110', 'Tính toán khoa học', 3),
(21, 'ITE6', 'CTTT', 'IT4172', 'Xử lý tín hiệu', 3),
(22, 'IT1', 'CQ', 'IT2110', 'Nhập môn CNTT & TT', 3),
(23, 'IT1', 'CQ', 'IT12121', 'Kiến thức máy tính', 3),
(24, 'IT1', 'CQ', 'IT2122', 'Điện tử cho CNTT Lab', 3),
(25, 'IT1', 'CQ', 'IT3011', 'Cấu trúc dữ liệu và thuật toán', 2),
(26, 'IT1', 'CQ', 'IT3210', 'C Programming Language', 3),
(27, 'IT1', 'CQ', 'IT3220', 'C Programming Introduction', 2),
(28, 'IT1', 'CQ', 'IT3280', 'Thực hành kiến trúc máy tính', 2),
(29, 'IT1', 'CQ', 'IT3283', 'Kiến trúc máy tính', 3),
(30, 'IT1', 'CQ', 'IT3170', 'Thuật toán ứng dụng', 2),
(31, 'IT1', 'CQ', 'IT3103', 'Lập trình hướng đối tượng', 2),
(32, 'IT1', 'CQ', 'IT2030', 'Technical Writing and Presentation', 3),
(33, 'IT1', 'CQ', 'IT4015', 'Nhập môn an toàn thông tin', 3),
(34, 'ITE6', 'CTTT', 'MI1114', 'Giải tích I', 2),
(35, 'ITE6', 'CTTT', 'MI1124', 'Giải tích II', 3),
(36, 'ITE6', 'CTTT', 'MI1134', 'Giải tích III', 2),
(37, 'ITE6', 'CTTT', 'MI1144', 'Phương trình vi phân và chuỗi', 3),
(38, 'ITE6', 'CTTT', 'MI2021', 'Xác suất thống kê', 2),
(39, 'MI1', 'CQ', 'NE1110', 'Vật lý đại cương I', 3),
(40, 'MI1', 'CQ', 'NE1120', 'Vật lý đại cương II', 3),
(41, 'MI1', 'CQ', 'NE1130', 'Vật lý đại cương III', 3),
(42, 'MI1', 'CQ', 'NE1140', 'Vật lí kỹ thuật', 3),
(43, 'MI1', 'CQ', 'ED3220', 'Kỹ năng mềm', 2),
(44, 'MI1', 'CQ', 'ED3280', 'Tâm lý học ứng dụng', 2),
(45, 'MI1', 'CQ', 'EM1010', 'Quản trị học đại cương', 2),
(46, 'MI1', 'CQ', 'SSH1010', 'Triết học Mác-Lênin', 2),
(47, 'MI1', 'CQ', 'SSH1020', 'Kinh tế chính trị', 3),
(48, 'MI1', 'CQ', 'SSH1030', 'Lịch sử Đảng CSVN', 3),
(49, 'MI1', 'CQ', 'SSH1040', 'CNXH khoa học', 3),
(50, 'MI1', 'CQ', 'MI1114', 'Giải tích I', 3),
(51, 'MI1', 'CQ', 'MI1124', 'Giải tích II', 2),
(52, 'MI1', 'CQ', 'MI1134', 'Giải tích III', 3),
(53, 'MI1', 'CQ', 'MI1144', 'Phương trình vi phân và chuỗi', 2),
(54, 'MI1', 'CQ', 'MI2021', 'Xác suất thống kê', 3),
(55, 'MS1', 'CQ', 'MT2101', 'Thủy lực trong CNMT', 2),
(56, 'MS1', 'CQ', 'MT2102', 'Thủy Nhiệt trong CNMT', 2),
(57, 'MS1', 'CQ', 'MT3103', 'Chuyển khối trong CNMT', 3),
(58, 'MS1', 'CQ', 'MT3104', 'Kỹ thuật phản ứng', 2),
(59, 'MS1', 'CQ', 'MT3105', 'Hóa sinh môi trường', 2),
(60, 'MS1', 'CQ', 'MT3106', 'Hóa học môi trường', 3),
(61, 'MS1', 'CQ', 'MT3107', 'Vi sinh môi trường', 2),
(62, 'MS1', 'CQ', 'MT3118', 'Kỹ thuật kiểm soát ô nhiễm không khí', 3),
(63, 'MS1', 'CQ', 'MT3118', 'Kỹ thuật sử lí nước thải', 2),
(64, 'MS1', 'CQ', 'VL2000', 'Nhập môn KH&KT vật liệu', 3),
(65, 'MS1', 'CQ', 'VL2010', 'Nhập môn luyện kim và kỹ thuật vật liệu', 3),
(66, 'MS1', 'CQ', 'VL2013', 'Khoa học vật liệu đại cương', 3),
(67, 'MS1', 'CQ', 'VL2020', 'Nhiệt động học vật liệu', 2),
(68, 'MS1', 'CQ', 'VL2023', 'Sự hình thành tổ chức tế vi vật liệu', 2),
(69, 'MS1', 'CQ', 'VL2025', 'Phương pháp tính toán vật liệu', 2),
(70, 'MS1', 'CQ', 'VL2030', 'Cơ sở vật liệu học', 2),
(71, 'MS1', 'CQ', 'VL2040', 'Hóa học chất rắn', 3),
(72, 'MS1', 'CQ', 'VL2041', 'Công nghệ vật liệu kim loại', 3),
(73, 'MS1', 'CQ', 'VL2050', 'Phương pháp tính toán vật liệu', 3),
(74, 'ED1', 'CQ', 'EM1010', 'Quản trị học đại cương', 3),
(75, 'ED1', 'CQ', 'EM1100', 'Kinh tế vi mô đại cương', 2),
(76, 'ED1', 'CQ', 'EM1180', 'Văn hóa kinh doanh và tinh thần khởi nghiệp', 2),
(77, 'ED1', 'CQ', 'EM1300', 'Nhập môn Quản trị kinh doanh', 2),
(78, 'ED1', 'CQ', 'EM1410', 'Nhập môn Logistics và Quản lý chuỗi cung ứng', 3),
(79, 'ED1', 'CQ', 'EM1420', 'Các hệ thống công nghiệp', 2),
(80, 'ED1', 'CQ', 'EM1500', 'Nhập môn Tài chính ngân hàng', 3),
(81, 'ED1', 'CQ', 'EM1600', 'Nhập môn Kinh tế công nghiệp', 2),
(82, 'ED1', 'CQ', 'EM1700', 'Nhập môn Kế toán', 2),
(83, 'HH1', 'CQ', 'HH1010', 'Hoá học đại cương', 2),
(84, 'HH1', 'CQ', 'HH2000', 'Nhập môn kỹ thuật hóa học', 2),
(85, 'HH1', 'CQ', 'HH2004', 'Nhập môn Kỹ thuật in và truyền thông', 2),
(86, 'HH1', 'CQ', 'HH2010', 'Cơ sở hóa học vật liệu', 3),
(87, 'HH1', 'CQ', 'HH2014', 'Hóa sinh đại cương', 3),
(88, 'HH1', 'CQ', 'HH3000', 'Hóa lý 1 (Cấu tạo chất)', 3),
(89, 'HH1', 'CQ', 'HH3001', 'Hóa lý 1 (máy hoá)', 3),
(90, 'HH1', 'CQ', 'HH3002', 'Hóa lý (CN sinh học và thực phẩm)', 2),
(91, 'HH1', 'CQ', 'HH3003', 'Hóa lý (CN môi trường)', 2),
(92, 'HH1', 'CQ', 'HH3004', 'Hóa lý (vật liệu)', 2),
(93, 'HH1', 'CQ', 'HH3120', 'Hóa vô cơ', 2),
(94, 'HH1', 'CQ', 'HH3201', 'Hóa hữu cơ', 3),
(95, 'FL1', 'CQ', 'FL1010', 'Tiếng Anh I', 2),
(96, 'FL2', 'CQ', 'FL1020', 'Tiếng Anh II', 2),
(97, 'FL3', 'CQ', 'FL1023', 'Ngữ âm thực hành', 3),
(98, 'FL4', 'CQ', 'FL1109', 'Tiếng Anh 3', 2),
(99, 'FL5', 'CQ', 'FL1147', 'Writing', 2),
(100, 'FL6', 'CQ', 'FL1145', 'Speaking', 3),
(101, 'FL7', 'CQ', 'FL1144', 'Listening', 2),
(102, 'ED1', 'CQ', 'ED3390', 'Hệ thống quản lý học tập thế hệ tương lai', 2),
(103, 'ED1', 'CQ', 'ED3410', 'Lãnh đạo tổ chức đào tạo', 3),
(104, 'ED1', 'CQ', 'ED4054', 'Lý luận dạy học chuyên ngành CNTT', 3),
(105, 'ED1', 'CQ', 'ED3220Q', 'Kỹ năng mềm', 3),
(106, 'ED1', 'CQ', 'ED2000', 'Nhập môn ngành Công nghệ Giáo dục', 3),
(107, 'ED1', 'CQ', 'ED3040', 'Tâm lý học chuyên ngành', 3),
(108, 'NE1', 'CQ', 'NE2001', 'Nhập môn ngành Vật lý y khoa', 2),
(109, 'NE1', 'CQ', 'NE2000', 'Nhập môn KT Hạt nhân và VLMT', 2),
(110, 'NE1', 'CQ', 'NE3005', 'Giải phẫu và sinh lý người đại cương', 3),
(111, 'NE1', 'CQ', 'NE3012', 'Cơ sở vật lý hạt nhân', 2),
(112, 'NE1', 'CQ', 'NE3020', 'Kỹ thuật hạt nhân & vật lý môi trường', 3),
(113, 'NE1', 'CQ', 'NE3044', 'Điện tử hạt nhân', 2),
(114, 'NE1', 'CQ', 'BF2701', 'Nhập môn kỹ thuật sinh học', 3),
(115, 'NE1', 'CQ', 'BF2703', 'Thí nghiệm hóa sinh', 2),
(116, 'NE1', 'CQ', 'BF2901', 'Nhập môn công nghệ thực phẩm', 3),
(117, 'NE1', 'CQ', 'BF3011', 'Hóa sinh đại cương', 3),
(118, 'NE1', 'CQ', 'BF3015', 'Quá trình và thiết bị chuyển khối', 2),
(119, 'NE1', 'CQ', 'BF3040', 'Vi sinh thực phẩm', 3);

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
(1, 'IT', 'Trường Công Nghệ Thông Tin & Truyền Thông'),
(2, 'DT', 'Trường Điện - Điện Tử'),
(3, 'CK', 'Trường Cơ Khí'),
(4, 'MI', 'Viện Toán Ứng Dụng và Tin Học'),
(5, 'DM', 'Viện Dệt may - Da giầy và Thời trang'),
(6, 'MT', 'Viện Khoa học và Công nghệ Môi trường'),
(7, 'VL', 'Viện Khoa học và Kỹ thuật Vật liệu'),
(8, 'EM', 'Viện Kinh tế và Quản lý'),
(9, 'HH', 'Viện Kỹ thuật Hóa học'),
(10, 'FL', 'Viện Ngoại ngữ'),
(11, 'ED', 'Viện Sư phạm Kỹ thuật'),
(12, 'NE', 'Viện Vật lý Kỹ thuật'),
(13, 'BF', 'Viện Công nghệ Sinh học và Công nghệ Thực phẩm'),
(14, 'SSH', 'Khoa Lý luận Chính trị'),
(15, 'PE', 'Khoa Giáo dục Thể chất'),
(16, 'MIL', 'Khoa Giáo dục Quốc phòng & An ninh');

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
(1, 'IT', 'CTTT', 'ITE6', 'Công Nghệ Thông Tin Việt Nhật'),
(2, 'IT', 'CQ', 'IT1', 'Khoa Học Máy Tính'),
(3, 'IT', 'CQ', 'IT2', 'Kỹ Thuật Máy Tính'),
(4, 'DT', 'CQ', 'DT01', 'Điện Tử Viễn Thông'),
(5, 'DT', 'CQ', 'DT02', 'Điều Khiển và Tự Động Hóa'),
(6, 'DT', 'CQ', 'DT03', 'Cơ Điện Tử '),
(7, 'HH', 'CQ', 'HH1', 'Kỹ Thuật Hóa Học'),
(8, 'FL', 'CQ', 'FL1', 'Tiếng Anh cho KHKT');
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
(1, 'CQ', 'Chính quy'),
(2, 'CTTT', 'Chương trình tiên tiến'),
(3, 'LKQT', 'Liên kết quốc tế');

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
(1, 'admin', '123123', 'admin', NULL, 'Hoàng Minh Ngọc', '2002-05-01', '0326813947', 'admin@gmail.com', 'Hà Nội', 'active'),
(4, '20200440', '123456', 'student', '20200440', 'Hoàng Minh Ngọc', '2002-01-05', '0326813947', 'example2.test@gmail.com', 'Hai Bà Trưng, Hà Nội', 'active'),
(5, '20205052', '123456', 'student', '20205052', 'Nguyễn Đức Anh', '2002-12-08', '0912345678', 'example3.test@gmail.com', 'Hà Nội', 'active'),
(6, '20205064', '123456', 'student', '20205064', 'Đặng Quang Đạt', '2002-07-16', '0372002727', 'example4.test@gmail.com', 'Thị trấn Văng Giang,Hưng Yên', 'active'),
(7, '20205057', '123456', 'student', '20205057', 'Lê Văn Bảo', '2002-10-29', '0374042972', 'example5.test@gmail.com', 'Thường Tín, Hà Nội', 'active'),
(8, 'phuongnh', 'phuongnh', 'lecturer', 'phuongnh', 'Nguyễn Hồng Phương', '1983-12-10', '0988888888', 'example6.test@gmail.com', 'Hà Nội', 'active'),
(9, 'tiennd', 'tiennd', 'lecturer', 'tiennd', 'Nguyễn Đức Tiến', '1982-07-30', '0911111111', 'example7.test@gmail.com', 'Hà Nội', 'active'),
(10, 'quangnh', 'quangnh', 'lecturer', 'quangnh', 'Nguyễn Hồng Quang', '1977-01-12', '0911111111', 'example8.test@gmail.com', 'Hà Nội', 'active'),
(11, 'ACC', '123456', 'lecturer', '001', 'Acc', '1986-05-01', '54364', 'fxdgsx@sdf.sfd', 'âfsafda', 'active');

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
