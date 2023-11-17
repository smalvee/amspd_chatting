-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 19, 2023 at 09:47 AM
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
-- Database: `task`
--

-- --------------------------------------------------------

--
-- Table structure for table `chattings`
--

CREATE TABLE `chattings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `to_do_id` varchar(255) DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `chat_details` varchar(255) DEFAULT NULL,
  `chat_file` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chattings`
--

INSERT INTO `chattings` (`id`, `to_do_id`, `user_id`, `chat_details`, `chat_file`, `created_at`, `updated_at`) VALUES
(15, '37', 'superadmin@ampsd.com', 'I glad to see you', NULL, '2023-10-18 07:53:01', '2023-10-18 07:53:01'),
(16, '37', 'superadmin@ampsd.com', 'I glad to see you', NULL, '2023-10-18 07:53:08', '2023-10-18 07:53:08'),
(17, '37', 'p.manager@gmail.com', 'I am also', NULL, '2023-10-18 07:53:24', '2023-10-18 07:53:24'),
(18, '37', 'p.manager@gmail.com', 'its very hot today', NULL, '2023-10-18 07:53:39', '2023-10-18 07:53:39'),
(19, '37', 'superadmin@ampsd.com', 'yes', NULL, '2023-10-18 08:05:25', '2023-10-18 08:05:25'),
(20, '37', 'superadmin@ampsd.com', 'how are you?', NULL, '2023-10-18 08:12:58', '2023-10-18 08:12:58'),
(21, '37', 'p.manager@gmail.com', 'nice to meet you', NULL, '2023-10-18 08:15:12', '2023-10-18 08:15:12'),
(22, '37', 'superadmin@ampsd.com', 'hi', NULL, '2023-10-18 08:18:00', '2023-10-18 08:18:00'),
(23, '37', 'p.manager@gmail.com', 'hello', NULL, '2023-10-18 08:18:09', '2023-10-18 08:18:09'),
(24, '37', 'superadmin@ampsd.com', 'kmn asen?', NULL, '2023-10-18 08:18:46', '2023-10-18 08:18:46'),
(25, '37', 'p.manager@gmail.com', 'valo asi', NULL, '2023-10-18 08:19:24', '2023-10-18 08:19:24'),
(26, '37', 'superadmin@ampsd.com', 'amio valo asi', NULL, '2023-10-18 08:19:47', '2023-10-18 08:19:47'),
(27, '37', 'superadmin@ampsd.com', 'kmn asen?', NULL, '2023-10-18 08:27:34', '2023-10-18 08:27:34'),
(28, '37', 'superadmin@ampsd.com', 'valo asi', NULL, '2023-10-18 08:28:59', '2023-10-18 08:28:59'),
(29, '37', 'p.manager@gmail.com', 'amio valo asi', NULL, '2023-10-18 08:29:38', '2023-10-18 08:29:38'),
(30, '37', 'p.manager@gmail.com', 'amio valo asi', NULL, '2023-10-18 08:29:56', '2023-10-18 08:29:56'),
(31, '37', 'p.manager@gmail.com', 'amio valo asi', NULL, '2023-10-18 08:30:05', '2023-10-18 08:30:05'),
(32, '37', 'p.manager@gmail.com', 'amio valo asi', NULL, '2023-10-18 08:30:18', '2023-10-18 08:30:18'),
(33, '37', 'p.manager@gmail.com', 'amio valo asi', NULL, '2023-10-18 08:30:18', '2023-10-18 08:30:18'),
(34, '37', 'p.manager@gmail.com', 'amio valo asi', NULL, '2023-10-18 08:30:19', '2023-10-18 08:30:19'),
(35, '37', 'p.manager@gmail.com', 'amio valo asi', NULL, '2023-10-18 08:30:19', '2023-10-18 08:30:19'),
(36, '37', 'superadmin@ampsd.com', 'hello', NULL, '2023-10-18 08:31:19', '2023-10-18 08:31:19'),
(37, '37', 'p.manager@gmail.com', 'hi', NULL, '2023-10-18 08:31:33', '2023-10-18 08:31:33'),
(38, '37', 'superadmin@ampsd.com', 'how about you', NULL, '2023-10-18 08:34:19', '2023-10-18 08:34:19'),
(39, '37', 'p.manager@gmail.com', 'oh, I\'m good', NULL, '2023-10-18 08:34:41', '2023-10-18 08:34:41'),
(40, '37', 'superadmin@ampsd.com', 'nice', NULL, '2023-10-18 08:35:06', '2023-10-18 08:35:06'),
(41, '37', 'superadmin@ampsd.com', 'wow', NULL, '2023-10-18 08:35:24', '2023-10-18 08:35:24'),
(42, '37', 'superadmin@ampsd.com', 'hi vaia kmn asen?', NULL, '2023-10-18 08:42:11', '2023-10-18 08:42:11');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_07_13_154005_create_projects_table', 1),
(6, '2023_07_21_041421_create_role_wise_permissions_table', 1),
(7, '2023_07_21_102928_create_project_wise_user_infos_table', 1),
(8, '2023_07_24_124448_create_to_dos_table', 1),
(9, '2023_07_28_053834_create_task_groups_table', 1),
(10, '2023_09_23_121057_create_chat_table', 1),
(11, '2023_10_03_154131_create__chatting_table', 2),
(12, '2023_10_03_154131_create_chatting_table', 3),
(13, '2023_10_03_160013_create_chattings_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `name`, `created_at`, `updated_at`) VALUES
(4, '{\"en\":\"Project Felcon A\",\"jp\":\"Felcon A\"}', '2023-10-17 22:45:09', '2023-10-17 22:48:00'),
(5, '{\"en\":\"Project Felcon B\",\"jp\":\"Felcon B\"}', '2023-10-17 22:48:26', '2023-10-17 22:48:26');

-- --------------------------------------------------------

--
-- Table structure for table `project_wise_user_infos`
--

CREATE TABLE `project_wise_user_infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `project_wise_user_infos`
--

INSERT INTO `project_wise_user_infos` (`id`, `username`, `role`, `project_id`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(7, 'developer@gmail.com', 'Developer', 4, 9, 'Active', '2023-10-17 22:49:11', '2023-10-17 22:49:11'),
(8, 'p.manager@gmail.com', 'Project Manager', 4, 10, 'Active', '2023-10-17 22:49:49', '2023-10-17 22:49:49'),
(9, 'p.admin@gmail.com', 'Project Admin', 4, 11, 'Active', '2023-10-17 22:50:11', '2023-10-17 22:50:11'),
(10, 'developer.b@gmail.com', 'Developer', 5, 12, 'Active', '2023-10-17 22:58:11', '2023-10-17 22:58:11'),
(11, 'p.manager.b@gmail.com', 'Project Manager', 5, 13, 'Active', '2023-10-17 22:58:46', '2023-10-17 22:58:46'),
(12, 'p.admin.b@gmail.com', 'Project Admin', 5, 14, 'Active', '2023-10-17 22:59:15', '2023-10-17 22:59:15'),
(13, 'mahbub.afpa@gmail.com', 'Developer', 4, 15, 'Invite', '2023-10-18 09:45:02', '2023-10-18 09:45:02');

-- --------------------------------------------------------

--
-- Table structure for table `role_wise_permissions`
--

CREATE TABLE `role_wise_permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(255) DEFAULT NULL,
  `module` varchar(255) DEFAULT NULL,
  `permission` varchar(255) DEFAULT NULL,
  `permission_as` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_wise_permissions`
--

INSERT INTO `role_wise_permissions` (`id`, `role`, `module`, `permission`, `permission_as`, `created_at`, `updated_at`) VALUES
(34, 'Developer', 'todo', 'read', 'User', '2023-10-17 22:46:03', '2023-10-17 22:46:03'),
(35, 'Developer', 'todo', 'update', 'User', '2023-10-17 22:46:03', '2023-10-17 22:46:03'),
(36, 'Developer', 'todo-category', 'read', 'User', '2023-10-17 22:46:03', '2023-10-17 22:46:03'),
(37, 'Developer', 'todo-category', 'update', 'User', '2023-10-17 22:46:03', '2023-10-17 22:46:03'),
(47, 'Project Admin', 'user', 'create', 'Admin', '2023-10-17 22:47:26', '2023-10-17 22:47:26'),
(48, 'Project Admin', 'user', 'read', 'Admin', '2023-10-17 22:47:26', '2023-10-17 22:47:26'),
(49, 'Project Admin', 'user', 'update', 'Admin', '2023-10-17 22:47:26', '2023-10-17 22:47:26'),
(50, 'Project Admin', 'user', 'delete', 'Admin', '2023-10-17 22:47:26', '2023-10-17 22:47:26'),
(51, 'Project Admin', 'todo', 'create', 'Admin', '2023-10-17 22:47:26', '2023-10-17 22:47:26'),
(52, 'Project Admin', 'todo', 'read', 'Admin', '2023-10-17 22:47:26', '2023-10-17 22:47:26'),
(53, 'Project Admin', 'todo', 'update', 'Admin', '2023-10-17 22:47:26', '2023-10-17 22:47:26'),
(54, 'Project Admin', 'todo', 'delete', 'Admin', '2023-10-17 22:47:26', '2023-10-17 22:47:26'),
(55, 'Project Admin', 'todo-category', 'create', 'Admin', '2023-10-17 22:47:26', '2023-10-17 22:47:26'),
(56, 'Project Admin', 'todo-category', 'read', 'Admin', '2023-10-17 22:47:26', '2023-10-17 22:47:26'),
(57, 'Project Admin', 'todo-category', 'update', 'Admin', '2023-10-17 22:47:26', '2023-10-17 22:47:26'),
(58, 'Project Admin', 'todo-category', 'delete', 'Admin', '2023-10-17 22:47:26', '2023-10-17 22:47:26'),
(59, 'Project Admin', 'event', 'create', 'Admin', '2023-10-17 22:47:26', '2023-10-17 22:47:26'),
(60, 'Project Admin', 'event', 'read', 'Admin', '2023-10-17 22:47:26', '2023-10-17 22:47:26'),
(61, 'Project Admin', 'event', 'update', 'Admin', '2023-10-17 22:47:26', '2023-10-17 22:47:26'),
(62, 'Project Admin', 'event', 'delete', 'Admin', '2023-10-17 22:47:26', '2023-10-17 22:47:26'),
(74, 'Project Manager', 'user', 'create', 'User', '2023-10-18 08:47:57', '2023-10-18 08:47:57'),
(75, 'Project Manager', 'user', 'update', 'User', '2023-10-18 08:47:57', '2023-10-18 08:47:57'),
(76, 'Project Manager', 'user', 'delete', 'User', '2023-10-18 08:47:57', '2023-10-18 08:47:57'),
(77, 'Project Manager', 'todo', 'create', 'User', '2023-10-18 08:47:57', '2023-10-18 08:47:57'),
(78, 'Project Manager', 'todo', 'delete', 'User', '2023-10-18 08:47:57', '2023-10-18 08:47:57'),
(79, 'Project Manager', 'todo', 'update', 'User', '2023-10-18 08:47:57', '2023-10-18 08:47:57'),
(80, 'Project Manager', 'todo', 'read', 'User', '2023-10-18 08:47:57', '2023-10-18 08:47:57');

-- --------------------------------------------------------

--
-- Table structure for table `task_groups`
--

CREATE TABLE `task_groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `project_id` bigint(20) UNSIGNED DEFAULT NULL,
  `project_wise_user_info_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`project_wise_user_info_ids`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `task_groups`
--

INSERT INTO `task_groups` (`id`, `name`, `project_id`, `project_wise_user_info_ids`, `created_at`, `updated_at`) VALUES
(6, 'P F A TSG1', 4, '[7,8]', '2023-10-17 23:01:58', '2023-10-17 23:01:58'),
(7, 'P F A TSG2', 4, '[8]', '2023-10-17 23:02:15', '2023-10-17 23:02:15'),
(8, 'Group 2', 5, '[11]', '2023-10-18 05:20:39', '2023-10-18 05:20:39'),
(9, 'AB', 4, '[7,8]', '2023-10-18 09:45:22', '2023-10-18 23:28:22'),
(44, 'ABC1234', 4, '[7]', '2023-10-19 00:53:11', '2023-10-19 00:53:54');

-- --------------------------------------------------------

--
-- Table structure for table `to_dos`
--

CREATE TABLE `to_dos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED DEFAULT NULL,
  `group_id` bigint(20) UNSIGNED DEFAULT NULL,
  `display_at_task_list_status` varchar(255) DEFAULT NULL,
  `rebuild_view_member_status` varchar(255) DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `title_shown_in_task_list` varchar(255) DEFAULT NULL,
  `chat_function_status` varchar(255) DEFAULT NULL,
  `send_notice_mail_status` varchar(255) DEFAULT NULL,
  `display_after_deadline_expired_status` varchar(255) DEFAULT NULL,
  `display_deadline` date DEFAULT NULL,
  `submission_deadline_status` varchar(255) DEFAULT NULL,
  `submission_deadline` date DEFAULT NULL,
  `meeting_datetime_status` varchar(255) DEFAULT NULL,
  `meeting_datetime` date DEFAULT NULL,
  `place_info` longtext DEFAULT NULL,
  `sub_title` varchar(255) DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `attachments` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `submission_title` varchar(255) DEFAULT NULL,
  `display_theme_list_status` varchar(255) DEFAULT NULL,
  `presentation_screen_status` varchar(255) DEFAULT NULL,
  `presentation_screen_content` longtext DEFAULT NULL,
  `functional_display_frame_prod_status` varchar(255) DEFAULT NULL,
  `hide_submission_information_status` varchar(255) DEFAULT NULL,
  `signature` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `to_dos`
--

INSERT INTO `to_dos` (`id`, `project_id`, `group_id`, `display_at_task_list_status`, `rebuild_view_member_status`, `created_by`, `title_shown_in_task_list`, `chat_function_status`, `send_notice_mail_status`, `display_after_deadline_expired_status`, `display_deadline`, `submission_deadline_status`, `submission_deadline`, `meeting_datetime_status`, `meeting_datetime`, `place_info`, `sub_title`, `content`, `attachments`, `submission_title`, `display_theme_list_status`, `presentation_screen_status`, `presentation_screen_content`, `functional_display_frame_prod_status`, `hide_submission_information_status`, `signature`, `created_at`, `updated_at`) VALUES
(37, 4, 6, '1', '1', 9, 'Project Felcon A Task 1', '1', '1', '1', '2023-10-19', '1', '2023-10-26', '1', '2023-10-19', 'qwertyuio', NULL, 'qwertyui', '[\"public\\/file\\/668326.docx\",\"public\\/file\\/686740.jpg\"]', 'Project Felcon A Task 1', '1', '1', 'qwertyui', '1', '1', NULL, '2023-10-17 23:05:37', '2023-10-17 23:05:37'),
(38, 4, 6, '1', '1', 8, 'Test1', '1', '1', '1', '2023-10-01', '1', '2023-10-11', '1', '2023-10-26', 'qwerty', NULL, 'qawertg', '[]', 'wedrftg', '1', '1', 'aqwsedrftgy', '1', '1', NULL, '2023-10-18 05:19:38', '2023-10-18 05:19:38'),
(39, 5, 8, '1', '1', 11, 'Test2', '1', '1', '1', '2023-10-01', '1', '2023-10-01', '1', '2023-10-01', 'qwert', NULL, 'wert', '[]', 'sxdcfv', '1', '1', 'sdfg', '1', '1', NULL, '2023-10-18 05:21:36', '2023-10-18 05:21:36'),
(40, 4, 6, '1', '1', 8, 'P Manager', '1', '1', '1', '2023-10-01', '1', '2023-10-01', '1', '2023-10-01', 'wertyh', NULL, 'asdfgh', '[]', 'asdfgh', '1', '1', 'zsxdcfvbn', '1', '1', NULL, '2023-10-18 05:52:34', '2023-10-18 05:52:34'),
(42, 4, 7, NULL, NULL, NULL, 'Esse qui sit except', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '[]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-10-19 00:58:42', '2023-10-19 00:58:42');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `type`, `status`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'Active', 'Super Admin', 'superadmin@ampsd.com', NULL, '$2y$10$ZR0tF6E8UBQ8BqwiC.IMnuGZy7t1wFO1uoZOaPdBHNTYiIRqlAWWq', NULL, '2023-09-30 03:47:31', '2023-09-30 03:47:31'),
(2, 'Admin', 'Active', 'Admin', 'admin@ampsd.com', NULL, '$2y$10$FzWR9Jfb2sq0nImeoh2AhunKVxGEoA4OGkkZSRol8Sazlji/13tzi', NULL, '2023-09-30 03:47:31', '2023-09-30 03:47:31'),
(9, 'User', 'Active', 'User', 'developer@gmail.com', NULL, '$2y$10$DuT5ZOrZ7FgizZhz3vsnVe9rXfTYj9cOk6swN.brcYx5CLp3SPcu2', NULL, '2023-10-17 22:49:11', '2023-10-17 22:49:11'),
(10, 'User', 'Active', 'User', 'p.manager@gmail.com', NULL, '$2y$10$daRxuVezgmRtfe0BRNQXF.ATxqpYvDyygdXHKNKDPQRk/Nz6MS2s2', NULL, '2023-10-17 22:49:49', '2023-10-17 22:49:49'),
(11, 'Admin', 'Active', 'Admin', 'p.admin@gmail.com', NULL, '$2y$10$wsug8bnGoiPC85E8zoc.Qu2IYlWq3FMi7LIV6J1Vg2nuhHfIfwuCi', NULL, '2023-10-17 22:50:11', '2023-10-17 22:50:11'),
(12, 'User', 'Active', 'User', 'developer.b@gmail.com', NULL, '$2y$10$5cC82Yy4nEZUmZXEgiovMuHkqjEU7dbNmUvVm/FtryNqsO2NITzUy', NULL, '2023-10-17 22:58:11', '2023-10-17 22:58:11'),
(13, 'User', 'Active', 'User', 'p.manager.b@gmail.com', NULL, '$2y$10$oXosdM.bKWyjf8s8mTw8uerM7GKpZE1LxSX/P0XBa.d0vvxSXChTq', NULL, '2023-10-17 22:58:46', '2023-10-17 22:58:46'),
(14, 'Admin', 'Active', 'Admin', 'p.admin.b@gmail.com', NULL, '$2y$10$qFBmtfSFhmAOFKOtlDHGmOE7t0QnP.6x4plcq30emgMpBTwW9mGT2', NULL, '2023-10-17 22:59:15', '2023-10-17 22:59:15'),
(15, 'User', 'Invite', 'User', 'mahbub.afpa@gmail.com', NULL, '$2y$10$NBLv1DgmHZ11VDxgnXyBJuQz6QLYC5SF2IYFMdBL1qy1zAeRHsfRG', NULL, '2023-10-18 09:45:02', '2023-10-18 09:45:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chattings`
--
ALTER TABLE `chattings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_wise_user_infos`
--
ALTER TABLE `project_wise_user_infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_wise_permissions`
--
ALTER TABLE `role_wise_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task_groups`
--
ALTER TABLE `task_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `to_dos`
--
ALTER TABLE `to_dos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chattings`
--
ALTER TABLE `chattings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `project_wise_user_infos`
--
ALTER TABLE `project_wise_user_infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `role_wise_permissions`
--
ALTER TABLE `role_wise_permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `task_groups`
--
ALTER TABLE `task_groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `to_dos`
--
ALTER TABLE `to_dos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
