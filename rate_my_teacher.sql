-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 02, 2018 at 08:48 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rate_my_teacher`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `faculty` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `faculty`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Nahida Rahman', 'nahidarahman@gmail.com', '$2y$10$yNfoTCnMFNgLyx/fcUmgTOXvOYnUVv8YNqFo1R.pv9QJV4AeSv.I6', 'CSE', 'e9uXKUhBHwLDnqe6l3zGIRtQleN78C4cONXB1EYEs5uGncwnweOaMR7lQjGb', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `faculty_id` int(10) UNSIGNED NOT NULL,
  `department_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `code`, `title`, `faculty_id`, `department_id`, `created_at`, `updated_at`) VALUES
(1, 'CCE-121', 'Object Oriented Programming', 1, 1, '2018-07-05 11:19:30', '2018-07-05 11:20:57'),
(2, 'CIT-111', 'Programming Language', 1, 1, '2018-07-06 04:46:47', '2018-07-09 02:25:40'),
(3, 'CCE-413', 'VLSI Design', 1, 1, '2018-07-06 10:19:49', '2018-07-06 10:19:49'),
(4, 'CCE-411', 'Algorithm Engineering', 1, 1, '2018-07-09 02:18:10', '2018-07-09 02:18:10'),
(5, 'CCE-415', 'Networking Routing and Switching', 1, 1, '2018-07-09 02:19:55', '2018-07-09 02:19:55'),
(6, 'CCE-417', 'Data Warehousing and Mining', 1, 1, '2018-07-09 02:21:06', '2018-07-09 02:21:06'),
(7, 'CIT-411', 'Compiler Design and Autometa Theory', 1, 2, '2018-07-09 02:22:57', '2018-07-09 02:24:39'),
(8, 'PHY-111', 'Physics-1', 1, 5, '2018-07-13 09:53:54', '2018-07-13 09:53:54');

-- --------------------------------------------------------

--
-- Table structure for table `course_teachers`
--

CREATE TABLE `course_teachers` (
  `id` int(10) UNSIGNED NOT NULL,
  `course_id` int(10) UNSIGNED NOT NULL,
  `teacher_id` int(10) UNSIGNED NOT NULL,
  `year` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_teachers`
--

INSERT INTO `course_teachers` (`id`, `course_id`, `teacher_id`, `year`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 2018, '2018-07-05 12:57:34', '2018-07-05 12:57:34'),
(2, 2, 1, 2018, '2018-07-06 04:47:24', '2018-07-06 04:47:24'),
(3, 4, 1, 2018, '2018-07-09 03:03:12', '2018-07-09 03:03:45'),
(4, 4, 4, 2018, '2018-07-09 03:04:35', '2018-07-09 03:04:35'),
(5, 3, 8, 2018, '2018-07-09 03:05:28', '2018-07-09 03:05:28'),
(6, 3, 5, 2018, '2018-07-09 03:06:12', '2018-07-09 03:06:12'),
(7, 5, 1, 2018, '2018-07-09 03:06:49', '2018-07-09 03:06:49'),
(8, 6, 5, 2018, '2018-07-09 03:07:10', '2018-07-09 03:07:10'),
(9, 6, 4, 2018, '2018-07-09 03:07:29', '2018-07-09 03:07:29'),
(10, 7, 6, 2018, '2018-07-09 03:08:16', '2018-07-09 03:08:16'),
(11, 1, 3, 2018, '2018-08-15 03:11:55', '2018-08-15 03:11:55');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `faculty_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `short_name`, `faculty_id`, `created_at`, `updated_at`) VALUES
(1, 'Computer Communication & Engineering', 'CCE', 1, '2018-07-05 10:56:20', '2018-07-05 10:57:36'),
(2, 'Computer Science and Information Technology', 'CIT', 1, '2018-07-09 02:24:16', '2018-07-09 02:30:33'),
(3, 'Electrical and Electronics Engineering', 'EEE', 1, '2018-07-09 02:32:02', '2018-07-09 02:32:02'),
(4, 'SMathematics', 'MAT', 1, '2018-07-09 02:32:50', '2018-07-13 03:01:08'),
(5, 'Physics and Mechanical Engineering', 'PHY', 1, '2018-07-09 02:33:54', '2018-07-09 02:33:54');

-- --------------------------------------------------------

--
-- Table structure for table `faculties`
--

CREATE TABLE `faculties` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faculties`
--

INSERT INTO `faculties` (`id`, `name`, `short_name`, `created_at`, `updated_at`) VALUES
(1, 'Computer Science & Engineering', 'CSE', '2018-07-05 10:40:34', '2018-07-05 10:42:11');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_07_05_145252_create_faculties_table', 1),
(4, '2018_07_05_145315_create_departments_table', 1),
(5, '2018_07_05_145333_create_admins_table', 1),
(6, '2018_07_05_145346_create_courses_table', 1),
(7, '2018_07_05_145359_create_students_table', 1),
(8, '2018_07_05_145411_create_teachers_table', 1),
(9, '2018_07_05_145436_create_course_teachers_table', 1),
(10, '2018_07_05_145506_create_review_questions_table', 1),
(11, '2018_07_05_145532_create_review_question_answers_table', 1),
(12, '2018_07_05_145557_create_total_reviews_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `review_questions`
--

CREATE TABLE `review_questions` (
  `id` int(10) UNSIGNED NOT NULL,
  `question` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `question_type` int(11) NOT NULL COMMENT '0 = Academic || 1 = Non-academic',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `review_questions`
--

INSERT INTO `review_questions` (`id`, `question`, `question_type`, `created_at`, `updated_at`) VALUES
(1, 'What type of presentation skill he have?', 0, '2018-07-05 11:34:40', '2018-07-17 12:28:35'),
(2, 'How is his  lecture quality?', 0, '2018-07-05 22:11:13', '2018-08-14 12:27:56'),
(3, 'Is he enter into the classroom and leave the classroom on time?', 0, '2018-07-16 08:16:02', '2018-07-16 08:16:02'),
(4, 'Is he regularly take his classes?', 0, '2018-07-16 08:19:02', '2018-07-16 08:19:02'),
(5, 'Is he complete his syllabus on time?', 0, '2018-07-16 08:20:05', '2018-07-16 09:09:13'),
(6, 'What type of question he make for exam?', 0, '2018-07-16 08:21:29', '2018-07-17 11:59:41'),
(7, 'Is he  take his practical classes timely?', 1, '2018-07-16 08:23:20', '2018-07-16 08:23:20'),
(8, 'What type of motivational speech he can give?', 1, '2018-07-16 08:25:11', '2018-07-17 12:04:53'),
(9, 'What kind of  personal guideline he can give if you need?', 1, '2018-07-16 08:27:12', '2018-07-17 12:06:27'),
(10, 'What kind of help he give to solve your problem if you face any kind of problem?', 1, '2018-07-16 08:28:19', '2018-07-17 12:27:31');

-- --------------------------------------------------------

--
-- Table structure for table `review_question_answers`
--

CREATE TABLE `review_question_answers` (
  `id` int(10) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `course_teacher_id` int(10) UNSIGNED NOT NULL,
  `teacher_id` int(10) UNSIGNED NOT NULL,
  `question_id` int(10) UNSIGNED NOT NULL,
  `rating` tinyint(4) NOT NULL,
  `year` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `review_question_answers`
--

INSERT INTO `review_question_answers` (`id`, `student_id`, `course_teacher_id`, `teacher_id`, `question_id`, `rating`, `year`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, 5, '2018', '2018-08-15 01:08:30', '2018-08-15 01:08:30'),
(2, 1, 1, 1, 2, 4, '2018', '2018-08-15 01:08:30', '2018-08-15 01:08:30'),
(3, 1, 1, 1, 3, 3, '2018', '2018-08-15 01:08:30', '2018-08-15 01:08:30'),
(4, 1, 1, 1, 4, 4, '2018', '2018-08-15 01:08:30', '2018-08-15 01:08:30'),
(5, 1, 1, 1, 5, 2, '2018', '2018-08-15 01:08:30', '2018-08-15 01:08:30'),
(6, 1, 1, 1, 6, 2, '2018', '2018-08-15 01:08:31', '2018-08-15 01:08:31'),
(7, 1, 1, 1, 7, 3, '2018', '2018-08-15 01:08:31', '2018-08-15 01:08:31'),
(8, 1, 1, 1, 8, 4, '2018', '2018-08-15 01:08:31', '2018-08-15 01:08:31'),
(9, 1, 1, 1, 9, 3, '2018', '2018-08-15 01:08:31', '2018-08-15 01:08:31'),
(10, 1, 1, 1, 10, 4, '2018', '2018-08-15 01:08:31', '2018-08-15 01:08:31'),
(11, 2, 1, 1, 1, 5, '2018', '2018-08-15 01:42:03', '2018-08-15 01:42:03'),
(12, 2, 1, 1, 2, 4, '2018', '2018-08-15 01:42:03', '2018-08-15 01:42:03'),
(13, 2, 1, 1, 3, 3, '2018', '2018-08-15 01:42:03', '2018-08-15 01:42:03'),
(14, 2, 1, 1, 4, 2, '2018', '2018-08-15 01:42:03', '2018-08-15 01:42:03'),
(15, 2, 1, 1, 5, 1, '2018', '2018-08-15 01:42:03', '2018-08-15 01:42:03'),
(16, 2, 1, 1, 6, 2, '2018', '2018-08-15 01:42:03', '2018-08-15 01:42:03'),
(17, 2, 1, 1, 7, 2, '2018', '2018-08-15 01:42:03', '2018-08-15 01:42:03'),
(18, 2, 1, 1, 8, 3, '2018', '2018-08-15 01:42:03', '2018-08-15 01:42:03'),
(19, 2, 1, 1, 9, 4, '2018', '2018-08-15 01:42:03', '2018-08-15 01:42:03'),
(20, 2, 1, 1, 10, 5, '2018', '2018-08-15 01:42:03', '2018-08-15 01:42:03');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `university_id` int(10) UNSIGNED NOT NULL,
  `registration_no` int(10) UNSIGNED NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `faculty_id` int(10) UNSIGNED NOT NULL,
  `session` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `level` int(11) NOT NULL DEFAULT '1',
  `semester` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `verify_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `university_id`, `registration_no`, `email`, `password`, `phone`, `faculty_id`, `session`, `level`, `semester`, `verify_token`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Nahida Rahman', 1402018, 5367, 'nahidarahman122@gmail.com', '$2y$10$yNfoTCnMFNgLyx/fcUmgTOXvOYnUVv8YNqFo1R.pv9QJV4AeSv.I6', '01942473372', 1, '2014-15', 4, '2', '1', 'EHk0tdX9gvg3ryTCk3CnLyi3pKTCXPsR1KvjWmWCQ4Qm4Ody0kubQ54m5a6t', '2018-07-05 12:30:28', '2018-09-01 03:51:15'),
(2, 'Shangita Das', 1402007, 5356, 'shangita@gmail.com', '$2y$10$yNfoTCnMFNgLyx/fcUmgTOXvOYnUVv8YNqFo1R.pv9QJV4AeSv.I6', '78686757', 1, '2014-15', 4, '2', '1', NULL, '2018-07-06 04:42:09', '2018-09-01 03:51:15'),
(3, 'tanima', 1402012, 5361, 'tanima12@gmail.com', '$2y$10$AAeZy.2Wd7B4nUAqrd4B8.iNhQLnE2fOV8UT3Dy2O45.IIoX4OsPC', '01915094763', 1, '2014-15', 4, '2', '1', 'BgcqnTLd20ARUggtU9yaMphz5XKf3vI9SVNqHs1hcBTX5H0ZJu2djkfajMAk', '2018-07-13 09:45:29', '2018-09-01 03:51:15'),
(5, NULL, 1402002, 5350, NULL, NULL, NULL, 1, NULL, 2, '1', '0', NULL, NULL, '2018-09-01 03:51:15');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `faculty_id` int(10) UNSIGNED NOT NULL,
  `department_id` int(10) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `first_name`, `last_name`, `phone`, `email`, `faculty_id`, `department_id`, `image`, `username`, `created_at`, `updated_at`) VALUES
(1, 'Sajal', 'Saha', '01736092609', 'sajal.cse.cce@gmail.com', 1, 1, '1530813628.jpg', 'sajal-1', '2018-07-05 12:00:28', '2018-07-09 02:36:27'),
(2, 'Chinmay', 'Bepery', '01922361666', 'chinmay.cse@pstu.ac.bd', 1, 2, NULL, 'chinmay-1', '2018-07-06 04:42:55', '2018-07-09 02:46:09'),
(3, 'Md.Samsuzzaman', 'sobuz', '01712653210', 'sobuzcse@gmail.com', 1, 1, NULL, 'md.samsuzzaman', '2018-07-09 02:38:30', '2018-07-09 02:38:30'),
(4, 'Sarna', 'Majumder', '01767265119', 'sarna.majumder90@gmail.com', 1, 1, NULL, 'sarna', '2018-07-09 02:40:29', '2018-07-09 02:40:29'),
(5, 'Golam Md. Muradul Bashir', NULL, '01828146192', 'murad98cseKuet@yahoo.com', 1, 1, NULL, 'golam-md.-muradul-bashir-1', '2018-07-09 02:43:55', '2018-07-09 11:16:28'),
(6, 'Moynul Islam Sayed', NULL, '01741646519', 'smoinul@pstu.ac.bd', 1, 2, NULL, 'moynul-islam-sayed', '2018-07-09 02:48:01', '2018-07-09 11:17:44'),
(7, 'Dr.Sayed Md.Galib', NULL, '01781408274', 'galib@pstu.ac.bd', 1, 2, NULL, 'dr.sayed-md.galib-1', '2018-07-09 02:50:15', '2018-07-09 11:16:03'),
(8, 'Dr.S.M.Taohidul Islam', NULL, '01719018370', 'staohidul@gmail.com', 1, 3, NULL, 'dr.s.m.taohidul-islam-1', '2018-07-09 02:52:19', '2018-07-09 11:15:46'),
(9, 'Md.Monibor Rahman', NULL, '01915094763', 'engr.monibur@gmail.com', 1, 3, NULL, 'md.monibor-rahman', '2018-07-09 02:54:08', '2018-07-09 11:17:13'),
(10, 'Muhammad Masud Rana', NULL, '01834545713', 'masud_eee10@yahoo.com', 1, 3, NULL, 'muhammad-masud-rana', '2018-07-09 02:55:41', '2018-07-09 11:18:20'),
(11, 'Dr.Md.Belal Hossain', NULL, '0172642733', 'bellal77pstu@yahoo.com', 1, 4, NULL, 'dr.md.belal-hossain', '2018-07-09 02:57:18', '2018-07-09 11:15:17'),
(12, 'Humaira', 'Takia', '01722501970', 'humairpme@pstu.ac.bd', 1, 5, NULL, 'humaira', '2018-07-09 02:58:55', '2018-07-09 02:58:55'),
(13, 'Dr.Olly Roy', 'Chowdhury', '01716335596', 'ollyroy18@gmail.com', 1, 5, NULL, 'dr.olly-roy', '2018-07-09 03:00:24', '2018-07-09 03:00:24');

-- --------------------------------------------------------

--
-- Table structure for table `total_reviews`
--

CREATE TABLE `total_reviews` (
  `id` int(10) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `course_teacher_id` int(10) UNSIGNED NOT NULL,
  `teacher_id` int(10) UNSIGNED NOT NULL,
  `rating` int(10) UNSIGNED NOT NULL,
  `year` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `total_reviews`
--

INSERT INTO `total_reviews` (`id`, `student_id`, `course_teacher_id`, `teacher_id`, `rating`, `year`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 68, '2018', '2018-08-15 01:08:31', '2018-08-15 01:08:31'),
(2, 2, 1, 1, 62, '2018', '2018-08-15 01:42:03', '2018-08-15 01:42:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `courses_code_unique` (`code`),
  ADD UNIQUE KEY `courses_title_unique` (`title`),
  ADD KEY `courses_faculty_id_foreign` (`faculty_id`),
  ADD KEY `courses_department_id_foreign` (`department_id`);

--
-- Indexes for table `course_teachers`
--
ALTER TABLE `course_teachers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_teachers_course_id_foreign` (`course_id`),
  ADD KEY `course_teachers_teacher_id_foreign` (`teacher_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `departments_name_unique` (`name`),
  ADD UNIQUE KEY `departments_short_name_unique` (`short_name`);

--
-- Indexes for table `faculties`
--
ALTER TABLE `faculties`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `faculties_name_unique` (`name`),
  ADD UNIQUE KEY `faculties_short_name_unique` (`short_name`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `review_questions`
--
ALTER TABLE `review_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `review_question_answers`
--
ALTER TABLE `review_question_answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `review_question_answers_student_id_foreign` (`student_id`),
  ADD KEY `review_question_answers_course_teacher_id_foreign` (`course_teacher_id`),
  ADD KEY `review_question_answers_teacher_id_foreign` (`teacher_id`),
  ADD KEY `review_question_answers_question_id_foreign` (`question_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `students_email_unique` (`email`),
  ADD KEY `students_faculty_id_foreign` (`faculty_id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `teachers_phone_unique` (`phone`),
  ADD UNIQUE KEY `teachers_email_unique` (`email`),
  ADD KEY `teachers_faculty_id_foreign` (`faculty_id`),
  ADD KEY `teachers_department_id_foreign` (`department_id`);

--
-- Indexes for table `total_reviews`
--
ALTER TABLE `total_reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `total_reviews_student_id_foreign` (`student_id`),
  ADD KEY `total_reviews_course_teacher_id_foreign` (`course_teacher_id`),
  ADD KEY `total_reviews_teacher_id_foreign` (`teacher_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `course_teachers`
--
ALTER TABLE `course_teachers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `faculties`
--
ALTER TABLE `faculties`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `review_questions`
--
ALTER TABLE `review_questions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `review_question_answers`
--
ALTER TABLE `review_question_answers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `total_reviews`
--
ALTER TABLE `total_reviews`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`),
  ADD CONSTRAINT `courses_faculty_id_foreign` FOREIGN KEY (`faculty_id`) REFERENCES `faculties` (`id`);

--
-- Constraints for table `course_teachers`
--
ALTER TABLE `course_teachers`
  ADD CONSTRAINT `course_teachers_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `course_teachers_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`);

--
-- Constraints for table `review_question_answers`
--
ALTER TABLE `review_question_answers`
  ADD CONSTRAINT `review_question_answers_course_teacher_id_foreign` FOREIGN KEY (`course_teacher_id`) REFERENCES `course_teachers` (`id`),
  ADD CONSTRAINT `review_question_answers_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `review_questions` (`id`),
  ADD CONSTRAINT `review_question_answers_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`),
  ADD CONSTRAINT `review_question_answers_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`);

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_faculty_id_foreign` FOREIGN KEY (`faculty_id`) REFERENCES `faculties` (`id`);

--
-- Constraints for table `teachers`
--
ALTER TABLE `teachers`
  ADD CONSTRAINT `teachers_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`),
  ADD CONSTRAINT `teachers_faculty_id_foreign` FOREIGN KEY (`faculty_id`) REFERENCES `faculties` (`id`);

--
-- Constraints for table `total_reviews`
--
ALTER TABLE `total_reviews`
  ADD CONSTRAINT `total_reviews_course_teacher_id_foreign` FOREIGN KEY (`course_teacher_id`) REFERENCES `course_teachers` (`id`),
  ADD CONSTRAINT `total_reviews_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`),
  ADD CONSTRAINT `total_reviews_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
