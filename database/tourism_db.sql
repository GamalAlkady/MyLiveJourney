-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2025 at 05:28 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tourism_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `activations`
--

CREATE TABLE `activations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activations`
--

INSERT INTO `activations` (`id`, `user_id`, `token`, `ip_address`, `created_at`, `updated_at`) VALUES
(3, 6, 'iR2MpLG145SpJsb0HaIFI9tCfgJwO4QYkxjCjJqQZWzWvxB4fG2bNtOTSmH63PLF', '0.0.0.0', '2025-11-02 15:44:37', '2025-11-02 15:44:37');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tour_id` int(11) NOT NULL,
  `guide_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `total_price` int(20) NOT NULL,
  `seats` int(11) NOT NULL,
  `status` enum('approved','disapproved','pending','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `tour_id`, `guide_id`, `user_id`, `total_price`, `seats`, `status`, `created_at`, `updated_at`) VALUES
('BK-20251013-2RRRH', 2, NULL, 2, 3000, 10, 'approved', '2025-10-13 16:44:32', '2025-10-13 18:18:17'),
('BK-20251013-FYYXV', 2, NULL, 2, 1500, 5, 'disapproved', '2025-10-13 19:41:10', '2025-10-27 15:23:02'),
('BK-20251013-JDQWM', 1, NULL, 2, 110, 5, 'disapproved', '2025-10-13 20:17:03', '2025-11-02 18:25:01'),
('BK-20251013-YTQWV', 1, NULL, 2, 110, 5, 'approved', '2025-10-13 16:10:06', '2025-10-13 20:20:41'),
('BK-20251025-Q1RV7', 4, NULL, 2, 1500, 5, 'approved', '2025-10-25 14:41:57', '2025-10-27 15:26:55'),
('BK-20251025-YYJAO', 4, NULL, 2, 2400, 8, 'approved', '2025-10-25 15:01:39', '2025-10-25 16:38:53'),
('BK-20251031-QSNVX', 5, NULL, 2, 132, 4, 'pending', '2025-10-31 18:23:29', '2025-10-31 18:26:12'),
('BK-20251103-BIPDL', 7, NULL, 2, 1089, 33, 'approved', '2025-11-03 08:07:30', '2025-11-03 08:07:40');

-- --------------------------------------------------------

--
-- Table structure for table `chat_messages`
--

CREATE TABLE `chat_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `chat_room_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chat_rooms`
--

CREATE TABLE `chat_rooms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guide_id` bigint(20) UNSIGNED NOT NULL,
  `tour_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chat_rooms`
--

INSERT INTO `chat_rooms` (`id`, `name`, `guide_id`, `tour_id`, `created_at`, `updated_at`) VALUES
(2, NULL, 3, 4, '2025-10-25 13:50:05', '2025-10-25 13:50:05'),
(3, NULL, 3, 5, '2025-10-26 14:32:59', '2025-10-26 14:32:59'),
(4, NULL, 1, 6, '2025-10-31 20:05:01', '2025-10-31 20:05:01'),
(5, NULL, 1, 7, '2025-11-03 07:49:33', '2025-11-03 07:49:33');

-- --------------------------------------------------------

--
-- Table structure for table `chat_room_user`
--

CREATE TABLE `chat_room_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `chat_room_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `last_read_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chat_room_user`
--

INSERT INTO `chat_room_user` (`id`, `chat_room_id`, `user_id`, `created_at`, `updated_at`, `last_read_at`) VALUES
(1, 2, 2, '2025-10-25 16:38:53', '2025-10-31 19:22:36', '2025-10-31 19:22:36'),
(2, 3, 3, '2025-10-26 14:32:59', '2025-10-27 17:34:01', '2025-10-27 17:34:01'),
(3, 2, 3, '2025-10-26 18:05:09', '2025-10-27 17:33:58', '2025-10-27 17:33:58'),
(4, 4, 1, '2025-10-31 20:05:01', '2025-10-31 20:05:01', NULL),
(5, 5, 1, '2025-11-03 07:49:33', '2025-11-03 07:49:33', NULL),
(6, 5, 2, '2025-11-03 08:07:41', '2025-11-03 08:07:41', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `conversations`
--

CREATE TABLE `conversations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `session_key` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `conversations`
--

INSERT INTO `conversations` (`id`, `user_id`, `session_key`, `title`, `created_at`, `updated_at`) VALUES
(1, NULL, 'session_key', NULL, '2025-10-22 17:45:38', '2025-10-22 17:45:38'),
(2, NULL, NULL, NULL, '2025-10-22 17:48:46', '2025-10-22 17:48:46'),
(3, NULL, NULL, NULL, '2025-10-22 18:00:50', '2025-10-22 18:00:50'),
(4, NULL, NULL, NULL, '2025-10-22 18:29:42', '2025-10-22 18:29:42'),
(5, NULL, NULL, NULL, '2025-10-22 18:39:34', '2025-10-22 18:39:34'),
(6, NULL, NULL, NULL, '2025-10-22 18:45:32', '2025-10-22 18:45:32'),
(7, NULL, NULL, NULL, '2025-10-22 19:04:38', '2025-10-22 19:04:38'),
(8, NULL, NULL, NULL, '2025-10-22 19:05:42', '2025-10-22 19:05:42'),
(9, NULL, '82e1bf30-8186-4102-9365-618af6e4203b', NULL, '2025-10-22 19:11:50', '2025-10-22 19:11:50'),
(10, NULL, '82e1bf30-8186-4102-9365-618af6e4203b', NULL, '2025-10-22 19:14:02', '2025-10-22 19:14:02'),
(11, NULL, '82e1bf30-8186-4102-9365-618af6e4203b', NULL, '2025-10-22 19:15:40', '2025-10-22 19:15:40'),
(12, NULL, '82e1bf30-8186-4102-9365-618af6e4203b', NULL, '2025-10-22 19:16:10', '2025-10-22 19:16:10'),
(13, NULL, '82e1bf30-8186-4102-9365-618af6e4203b', NULL, '2025-10-22 19:18:36', '2025-10-22 19:18:36'),
(14, NULL, '82e1bf30-8186-4102-9365-618af6e4203b', NULL, '2025-10-22 19:19:54', '2025-10-22 19:19:54'),
(15, NULL, '4a416ab7-37b3-4a0e-a4fd-450badfdfdfd', NULL, '2025-10-26 15:37:43', '2025-10-26 15:37:43');

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Riyadh', '2025-10-11 14:05:02', '2025-10-11 14:05:02'),
(2, 'Jeddah', '2025-10-11 14:05:02', '2025-10-11 14:05:02'),
(3, 'AlUla', '2025-10-11 14:05:02', '2025-10-11 14:05:02'),
(4, 'Abha', '2025-10-11 14:05:02', '2025-10-11 14:05:02'),
(5, 'Al Khobar', '2025-10-11 14:05:02', '2025-10-11 14:05:02');

-- --------------------------------------------------------

--
-- Table structure for table `email_log`
--

CREATE TABLE `email_log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` datetime NOT NULL,
  `from` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `to` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cc` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bcc` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attachments` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `email_log`
--

INSERT INTO `email_log` (`id`, `date`, `from`, `to`, `cc`, `bcc`, `subject`, `body`, `headers`, `attachments`) VALUES
(1, '2025-10-09 22:05:12', 'TourMate <tourmate@example.com>', 'admin@user.com', NULL, NULL, 'Sorry to see you go...', '--spcGZu2s\r\nContent-Type: text/plain; charset=utf-8\r\nContent-Transfer-Encoding: quoted-printable\r\n\r\n[TourMate](http://localhost)\r\n\r\n# Hello lruecker,\r\n\r\nWe are very sorry =\r\nto see you go. We wanted to let you know that your account has been deleted=\r\n. Thank for the time we shared. You have 31 days to restore your account.=\r\n\r\n\r\nRestore Account: http://127.0.0.1:8000/re-activate/1\r\n\r\nWe hope to =\r\nsee you again!\r\n\r\nRegards,TourMate\r\n\r\nIf you=E2=80=99re having trouble =\r\nclicking the \"Restore Account\" button, copy and paste the URL below\r\ninto =\r\nyour web browser: [http://127.0.0.1:8000/re-activate/1](http://127.0.0.1:80=\r\n00/re-activate/1)\r\n\r\n=C2=A9 2025 TourMate. All rights reserved.\r\n\r\n--spcGZu2s\r\nContent-Type: text/html; charset=utf-8\r\nContent-Transfer-Encoding: quoted-printable\r\n\r\n<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.=\r\nw3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\r\n<html xmlns=3D\"http://www.=\r\nw3.org/1999/xhtml\">\r\n<head>\r\n<meta name=3D\"viewport\" content=3D\"width=3Dd=\r\nevice-width, initial-scale=3D1.0\">\r\n<meta http-equiv=3D\"Content-Type\" cont=\r\nent=3D\"text/html; charset=3DUTF-8\">\r\n</head>\r\n<body style=3D\"box-sizing: =\r\nborder-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Rob=\r\noto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'=\r\nSegoe UI Symbol\'; position: relative; -webkit-text-size-adjust: none; backg=\r\nround-color: #ffffff; color: #718096; height: 100%; line-height: 1.4; margi=\r\nn: 0; padding: 0; width: 100% !important;\">\r\n<style>\r\n@media only screen =\r\nand (max-width: 600px) {\r\n.inner-body {\r\nwidth: 100% !important;\r\n}\r\n=\r\n\r\n.footer {\r\nwidth: 100% !important;\r\n}\r\n}\r\n\r\n@media only screen and =\r\n(max-width: 500px) {\r\n.button {\r\nwidth: 100% !important;\r\n}\r\n}\r\n</styl=\r\ne>\r\n\r\n<table class=3D\"wrapper\" width=3D\"100%\" cellpadding=3D\"0\" cellspaci=\r\nng=3D\"0\" role=3D\"presentation\" style=3D\"box-sizing: border-box; font-family=\r\n: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, =\r\nsans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; posit=\r\nion: relative; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -prema=\r\niler-width: 100%; background-color: #edf2f7; margin: 0; padding: 0; width: =\r\n100%;\">\r\n<tr>\r\n<td align=3D\"center\" style=3D\"box-sizing: border-box; font=\r\n-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, =\r\nArial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'=\r\n; position: relative;\">\r\n<table class=3D\"content\" width=3D\"100%\" cellpaddi=\r\nng=3D\"0\" cellspacing=3D\"0\" role=3D\"presentation\" style=3D\"box-sizing: borde=\r\nr-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, =\r\nHelvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe=\r\n UI Symbol\'; position: relative; -premailer-cellpadding: 0; -premailer-cell=\r\nspacing: 0; -premailer-width: 100%; margin: 0; padding: 0; width: 100%;\">=\r\n\r\n<tr>\r\n<td class=3D\"header\" style=3D\"box-sizing: border-box; font-family=\r\n: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, =\r\nsans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; posit=\r\nion: relative; padding: 25px 0; text-align: center;\">\r\n<a href=3D\"http://l=\r\nocalhost\" style=3D\"box-sizing: border-box; font-family: -apple-system, Blin=\r\nkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Co=\r\nlor Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; color:=\r\n #3d4852; font-size: 19px; font-weight: bold; text-decoration: none; displa=\r\ny: inline-block;\">\r\nTourMate\r\n</a>\r\n</td>\r\n</tr>\r\n\r\n<!-- Email Body -=\r\n->\r\n<tr>\r\n<td class=3D\"body\" width=3D\"100%\" cellpadding=3D\"0\" cellspacing=\r\n=3D\"0\" style=3D\"box-sizing: border-box; font-family: -apple-system, BlinkMa=\r\ncSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color=\r\n Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; -premaile=\r\nr-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%; backgr=\r\nound-color: #edf2f7; border-bottom: 1px solid #edf2f7; border-top: 1px soli=\r\nd #edf2f7; margin: 0; padding: 0; width: 100%;\">\r\n<table class=3D\"inner-bo=\r\ndy\" align=3D\"center\" width=3D\"570\" cellpadding=3D\"0\" cellspacing=3D\"0\" role=\r\n=3D\"presentation\" style=3D\"box-sizing: border-box; font-family: -apple-syst=\r\nem, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'=\r\nApple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative=\r\n; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 5=\r\n70px; background-color: #ffffff; border-color: #e8e5ef; border-radius: 2px;=\r\n border-width: 1px; box-shadow: 0 2px 0 rgba(0, 0, 150, 0.025), 2px 4px 0 r=\r\ngba(0, 0, 150, 0.015); margin: 0 auto; padding: 0; width: 570px;\">\r\n<!-- B=\r\nody content -->\r\n<tr>\r\n<td class=3D\"content-cell\" style=3D\"box-sizing: bo=\r\nrder-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Robot=\r\no, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Se=\r\ngoe UI Symbol\'; position: relative; max-width: 100vw; padding: 32px;\">\r\n<h=\r\n1 style=3D\"box-sizing: border-box; font-family: -apple-system, BlinkMacSyst=\r\nemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoj=\r\ni\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; color: #3d4852=\r\n; font-size: 18px; font-weight: bold; margin-top: 0; text-align: left;\">Hel=\r\nlo lruecker,</h1>\r\n<p style=3D\"box-sizing: border-box; font-family: -apple=\r\n-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-ser=\r\nif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: rel=\r\native; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left=\r\n;\">We are very sorry to see you go. We wanted to let you know that your acc=\r\nount has been deleted. Thank for the time we shared. You have 31 days to re=\r\nstore your account.</p>\r\n<table class=3D\"action\" align=3D\"center\" width=3D=\r\n\"100%\" cellpadding=3D\"0\" cellspacing=3D\"0\" role=3D\"presentation\" style=3D\"b=\r\nox-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Seg=\r\noe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe U=\r\nI Emoji\', \'Segoe UI Symbol\'; position: relative; -premailer-cellpadding: 0;=\r\n -premailer-cellspacing: 0; -premailer-width: 100%; margin: 30px auto; padd=\r\ning: 0; text-align: center; width: 100%;\">\r\n<tr>\r\n<td align=3D\"center\" st=\r\nyle=3D\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFo=\r\nnt, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', =\r\n\'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative;\">\r\n<table width=\r\n=3D\"100%\" border=3D\"0\" cellpadding=3D\"0\" cellspacing=3D\"0\" role=3D\"presenta=\r\ntion\" style=3D\"box-sizing: border-box; font-family: -apple-system, BlinkMac=\r\nSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color =\r\nEmoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative;\">\r\n<tr>=\r\n\r\n<td align=3D\"center\" style=3D\"box-sizing: border-box; font-family: -appl=\r\ne-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-se=\r\nrif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: re=\r\nlative;\">\r\n<table border=3D\"0\" cellpadding=3D\"0\" cellspacing=3D\"0\" role=3D=\r\n\"presentation\" style=3D\"box-sizing: border-box; font-family: -apple-system,=\r\n BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'App=\r\nle Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative;\">=\r\n\r\n<tr>\r\n<td style=3D\"box-sizing: border-box; font-family: -apple-system, =\r\nBlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Appl=\r\ne Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative;\">=\r\n\r\n<a href=3D\"http://127.0.0.1:8000/re-activate/1\" class=3D\"button button-b=\r\nlue\" target=3D\"_blank\" rel=3D\"noopener\" style=3D\"box-sizing: border-box; fo=\r\nnt-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica=\r\n, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbo=\r\nl\'; position: relative; -webkit-text-size-adjust: none; border-radius: 4px;=\r\n color: #fff; display: inline-block; overflow: hidden; text-decoration: non=\r\ne; background-color: #2d3748; border-bottom: 8px solid #2d3748; border-left=\r\n: 18px solid #2d3748; border-right: 18px solid #2d3748; border-top: 8px sol=\r\nid #2d3748;\">Restore Account</a>\r\n</td>\r\n</tr>\r\n</table>\r\n</td>\r\n</tr>=\r\n\r\n</table>\r\n</td>\r\n</tr>\r\n</table>\r\n<p style=3D\"box-sizing: border-box=\r\n; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helve=\r\ntica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI S=\r\nymbol\'; position: relative; font-size: 16px; line-height: 1.5em; margin-top=\r\n: 0; text-align: left;\">We hope to see you again!</p>\r\n<!-- Salutation -->=\r\n\r\n<p style=3D\"box-sizing: border-box; font-family: -apple-system, BlinkMac=\r\nSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color =\r\nEmoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; font-size:=\r\n 16px; line-height: 1.5em; margin-top: 0; text-align: left;\">Regards,<br>To=\r\nurMate</p>\r\n<!-- Subcopy -->\r\n<table class=3D\"subcopy\" width=3D\"100%\" cel=\r\nlpadding=3D\"0\" cellspacing=3D\"0\" role=3D\"presentation\" style=3D\"box-sizing:=\r\n border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Ro=\r\nboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', =\r\n\'Segoe UI Symbol\'; position: relative; border-top: 1px solid #e8e5ef; margi=\r\nn-top: 25px; padding-top: 25px;\">\r\n<tr>\r\n<td style=3D\"box-sizing: border-=\r\nbox; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, He=\r\nlvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe U=\r\nI Symbol\'; position: relative;\">\r\n<p style=3D\"box-sizing: border-box; font=\r\n-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, =\r\nArial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'=\r\n; position: relative; line-height: 1.5em; margin-top: 0; text-align: left; =\r\nfont-size: 14px;\">If you=E2=80=99re having trouble clicking the \"Restore Ac=\r\ncount\" button, copy and paste the URL below\r\ninto your web browser: <a hre=\r\nf=3D\"http://127.0.0.1:8000/re-activate/1\" style=3D\"box-sizing: border-box; =\r\nfont-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helveti=\r\nca, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Sym=\r\nbol\'; position: relative; color: #3869d4;\">http://127.0.0.1:8000/re-activat=\r\ne/1</a></p>\r\n</td>\r\n</tr>\r\n</table>\r\n\r\n\r\n\r\n</td>\r\n</tr>\r\n</table>=\r\n\r\n</td>\r\n</tr>\r\n\r\n<tr>\r\n<td style=3D\"box-sizing: border-box; font-fami=\r\nly: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial=\r\n, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; pos=\r\nition: relative;\">\r\n<table class=3D\"footer\" align=3D\"center\" width=3D\"570\"=\r\n cellpadding=3D\"0\" cellspacing=3D\"0\" role=3D\"presentation\" style=3D\"box-siz=\r\ning: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\'=\r\n, Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoj=\r\ni\', \'Segoe UI Symbol\'; position: relative; -premailer-cellpadding: 0; -prem=\r\nailer-cellspacing: 0; -premailer-width: 570px; margin: 0 auto; padding: 0; =\r\ntext-align: center; width: 570px;\">\r\n<tr>\r\n<td class=3D\"content-cell\" ali=\r\ngn=3D\"center\" style=3D\"box-sizing: border-box; font-family: -apple-system, =\r\nBlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Appl=\r\ne Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; ma=\r\nx-width: 100vw; padding: 32px;\">\r\n<p style=3D\"box-sizing: border-box; font=\r\n-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, =\r\nArial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'=\r\n; position: relative; line-height: 1.5em; margin-top: 0; color: #b0adc5; fo=\r\nnt-size: 12px; text-align: center;\">=C2=A9 2025 TourMate. All rights reserv=\r\ned.</p>\r\n\r\n</td>\r\n</tr>\r\n</table>\r\n</td>\r\n</tr>\r\n</table>\r\n</td>\r\n=\r\n</tr>\r\n</table>\r\n</body>\r\n</html>\r\n--spcGZu2s--\r\n', 'From: TourMate <tourmate@example.com>\r\nTo: admin@user.com\r\nSubject: Sorry to see you go...\r\n', NULL),
(2, '2025-10-09 22:07:01', 'TourMate <tourmate@example.com>', 'admin@user.com', NULL, NULL, 'Sorry to see you go...', '--EKl67Hk2\r\nContent-Type: text/plain; charset=utf-8\r\nContent-Transfer-Encoding: quoted-printable\r\n\r\n[TourMate](http://localhost)\r\n\r\n# Hello lruecker,\r\n\r\nWe are very sorry =\r\nto see you go. We wanted to let you know that your account has been deleted=\r\n. Thank for the time we shared. You have 31 days to restore your account.=\r\n\r\n\r\nRestore Account: http://127.0.0.1:8000/re-activate/1\r\n\r\nWe hope to =\r\nsee you again!\r\n\r\nRegards,TourMate\r\n\r\nIf you=E2=80=99re having trouble =\r\nclicking the \"Restore Account\" button, copy and paste the URL below\r\ninto =\r\nyour web browser: [http://127.0.0.1:8000/re-activate/1](http://127.0.0.1:80=\r\n00/re-activate/1)\r\n\r\n=C2=A9 2025 TourMate. All rights reserved.\r\n\r\n--EKl67Hk2\r\nContent-Type: text/html; charset=utf-8\r\nContent-Transfer-Encoding: quoted-printable\r\n\r\n<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.=\r\nw3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\r\n<html xmlns=3D\"http://www.=\r\nw3.org/1999/xhtml\">\r\n<head>\r\n<meta name=3D\"viewport\" content=3D\"width=3Dd=\r\nevice-width, initial-scale=3D1.0\">\r\n<meta http-equiv=3D\"Content-Type\" cont=\r\nent=3D\"text/html; charset=3DUTF-8\">\r\n</head>\r\n<body style=3D\"box-sizing: =\r\nborder-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Rob=\r\noto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'=\r\nSegoe UI Symbol\'; position: relative; -webkit-text-size-adjust: none; backg=\r\nround-color: #ffffff; color: #718096; height: 100%; line-height: 1.4; margi=\r\nn: 0; padding: 0; width: 100% !important;\">\r\n<style>\r\n@media only screen =\r\nand (max-width: 600px) {\r\n.inner-body {\r\nwidth: 100% !important;\r\n}\r\n=\r\n\r\n.footer {\r\nwidth: 100% !important;\r\n}\r\n}\r\n\r\n@media only screen and =\r\n(max-width: 500px) {\r\n.button {\r\nwidth: 100% !important;\r\n}\r\n}\r\n</styl=\r\ne>\r\n\r\n<table class=3D\"wrapper\" width=3D\"100%\" cellpadding=3D\"0\" cellspaci=\r\nng=3D\"0\" role=3D\"presentation\" style=3D\"box-sizing: border-box; font-family=\r\n: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, =\r\nsans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; posit=\r\nion: relative; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -prema=\r\niler-width: 100%; background-color: #edf2f7; margin: 0; padding: 0; width: =\r\n100%;\">\r\n<tr>\r\n<td align=3D\"center\" style=3D\"box-sizing: border-box; font=\r\n-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, =\r\nArial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'=\r\n; position: relative;\">\r\n<table class=3D\"content\" width=3D\"100%\" cellpaddi=\r\nng=3D\"0\" cellspacing=3D\"0\" role=3D\"presentation\" style=3D\"box-sizing: borde=\r\nr-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, =\r\nHelvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe=\r\n UI Symbol\'; position: relative; -premailer-cellpadding: 0; -premailer-cell=\r\nspacing: 0; -premailer-width: 100%; margin: 0; padding: 0; width: 100%;\">=\r\n\r\n<tr>\r\n<td class=3D\"header\" style=3D\"box-sizing: border-box; font-family=\r\n: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, =\r\nsans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; posit=\r\nion: relative; padding: 25px 0; text-align: center;\">\r\n<a href=3D\"http://l=\r\nocalhost\" style=3D\"box-sizing: border-box; font-family: -apple-system, Blin=\r\nkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Co=\r\nlor Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; color:=\r\n #3d4852; font-size: 19px; font-weight: bold; text-decoration: none; displa=\r\ny: inline-block;\">\r\nTourMate\r\n</a>\r\n</td>\r\n</tr>\r\n\r\n<!-- Email Body -=\r\n->\r\n<tr>\r\n<td class=3D\"body\" width=3D\"100%\" cellpadding=3D\"0\" cellspacing=\r\n=3D\"0\" style=3D\"box-sizing: border-box; font-family: -apple-system, BlinkMa=\r\ncSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color=\r\n Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; -premaile=\r\nr-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%; backgr=\r\nound-color: #edf2f7; border-bottom: 1px solid #edf2f7; border-top: 1px soli=\r\nd #edf2f7; margin: 0; padding: 0; width: 100%;\">\r\n<table class=3D\"inner-bo=\r\ndy\" align=3D\"center\" width=3D\"570\" cellpadding=3D\"0\" cellspacing=3D\"0\" role=\r\n=3D\"presentation\" style=3D\"box-sizing: border-box; font-family: -apple-syst=\r\nem, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'=\r\nApple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative=\r\n; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 5=\r\n70px; background-color: #ffffff; border-color: #e8e5ef; border-radius: 2px;=\r\n border-width: 1px; box-shadow: 0 2px 0 rgba(0, 0, 150, 0.025), 2px 4px 0 r=\r\ngba(0, 0, 150, 0.015); margin: 0 auto; padding: 0; width: 570px;\">\r\n<!-- B=\r\nody content -->\r\n<tr>\r\n<td class=3D\"content-cell\" style=3D\"box-sizing: bo=\r\nrder-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Robot=\r\no, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Se=\r\ngoe UI Symbol\'; position: relative; max-width: 100vw; padding: 32px;\">\r\n<h=\r\n1 style=3D\"box-sizing: border-box; font-family: -apple-system, BlinkMacSyst=\r\nemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoj=\r\ni\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; color: #3d4852=\r\n; font-size: 18px; font-weight: bold; margin-top: 0; text-align: left;\">Hel=\r\nlo lruecker,</h1>\r\n<p style=3D\"box-sizing: border-box; font-family: -apple=\r\n-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-ser=\r\nif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: rel=\r\native; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left=\r\n;\">We are very sorry to see you go. We wanted to let you know that your acc=\r\nount has been deleted. Thank for the time we shared. You have 31 days to re=\r\nstore your account.</p>\r\n<table class=3D\"action\" align=3D\"center\" width=3D=\r\n\"100%\" cellpadding=3D\"0\" cellspacing=3D\"0\" role=3D\"presentation\" style=3D\"b=\r\nox-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Seg=\r\noe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe U=\r\nI Emoji\', \'Segoe UI Symbol\'; position: relative; -premailer-cellpadding: 0;=\r\n -premailer-cellspacing: 0; -premailer-width: 100%; margin: 30px auto; padd=\r\ning: 0; text-align: center; width: 100%;\">\r\n<tr>\r\n<td align=3D\"center\" st=\r\nyle=3D\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFo=\r\nnt, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', =\r\n\'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative;\">\r\n<table width=\r\n=3D\"100%\" border=3D\"0\" cellpadding=3D\"0\" cellspacing=3D\"0\" role=3D\"presenta=\r\ntion\" style=3D\"box-sizing: border-box; font-family: -apple-system, BlinkMac=\r\nSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color =\r\nEmoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative;\">\r\n<tr>=\r\n\r\n<td align=3D\"center\" style=3D\"box-sizing: border-box; font-family: -appl=\r\ne-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-se=\r\nrif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: re=\r\nlative;\">\r\n<table border=3D\"0\" cellpadding=3D\"0\" cellspacing=3D\"0\" role=3D=\r\n\"presentation\" style=3D\"box-sizing: border-box; font-family: -apple-system,=\r\n BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'App=\r\nle Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative;\">=\r\n\r\n<tr>\r\n<td style=3D\"box-sizing: border-box; font-family: -apple-system, =\r\nBlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Appl=\r\ne Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative;\">=\r\n\r\n<a href=3D\"http://127.0.0.1:8000/re-activate/1\" class=3D\"button button-b=\r\nlue\" target=3D\"_blank\" rel=3D\"noopener\" style=3D\"box-sizing: border-box; fo=\r\nnt-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica=\r\n, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbo=\r\nl\'; position: relative; -webkit-text-size-adjust: none; border-radius: 4px;=\r\n color: #fff; display: inline-block; overflow: hidden; text-decoration: non=\r\ne; background-color: #2d3748; border-bottom: 8px solid #2d3748; border-left=\r\n: 18px solid #2d3748; border-right: 18px solid #2d3748; border-top: 8px sol=\r\nid #2d3748;\">Restore Account</a>\r\n</td>\r\n</tr>\r\n</table>\r\n</td>\r\n</tr>=\r\n\r\n</table>\r\n</td>\r\n</tr>\r\n</table>\r\n<p style=3D\"box-sizing: border-box=\r\n; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helve=\r\ntica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI S=\r\nymbol\'; position: relative; font-size: 16px; line-height: 1.5em; margin-top=\r\n: 0; text-align: left;\">We hope to see you again!</p>\r\n<!-- Salutation -->=\r\n\r\n<p style=3D\"box-sizing: border-box; font-family: -apple-system, BlinkMac=\r\nSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color =\r\nEmoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; font-size:=\r\n 16px; line-height: 1.5em; margin-top: 0; text-align: left;\">Regards,<br>To=\r\nurMate</p>\r\n<!-- Subcopy -->\r\n<table class=3D\"subcopy\" width=3D\"100%\" cel=\r\nlpadding=3D\"0\" cellspacing=3D\"0\" role=3D\"presentation\" style=3D\"box-sizing:=\r\n border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Ro=\r\nboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', =\r\n\'Segoe UI Symbol\'; position: relative; border-top: 1px solid #e8e5ef; margi=\r\nn-top: 25px; padding-top: 25px;\">\r\n<tr>\r\n<td style=3D\"box-sizing: border-=\r\nbox; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, He=\r\nlvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe U=\r\nI Symbol\'; position: relative;\">\r\n<p style=3D\"box-sizing: border-box; font=\r\n-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, =\r\nArial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'=\r\n; position: relative; line-height: 1.5em; margin-top: 0; text-align: left; =\r\nfont-size: 14px;\">If you=E2=80=99re having trouble clicking the \"Restore Ac=\r\ncount\" button, copy and paste the URL below\r\ninto your web browser: <a hre=\r\nf=3D\"http://127.0.0.1:8000/re-activate/1\" style=3D\"box-sizing: border-box; =\r\nfont-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helveti=\r\nca, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Sym=\r\nbol\'; position: relative; color: #3869d4;\">http://127.0.0.1:8000/re-activat=\r\ne/1</a></p>\r\n</td>\r\n</tr>\r\n</table>\r\n\r\n\r\n\r\n</td>\r\n</tr>\r\n</table>=\r\n\r\n</td>\r\n</tr>\r\n\r\n<tr>\r\n<td style=3D\"box-sizing: border-box; font-fami=\r\nly: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial=\r\n, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; pos=\r\nition: relative;\">\r\n<table class=3D\"footer\" align=3D\"center\" width=3D\"570\"=\r\n cellpadding=3D\"0\" cellspacing=3D\"0\" role=3D\"presentation\" style=3D\"box-siz=\r\ning: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\'=\r\n, Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoj=\r\ni\', \'Segoe UI Symbol\'; position: relative; -premailer-cellpadding: 0; -prem=\r\nailer-cellspacing: 0; -premailer-width: 570px; margin: 0 auto; padding: 0; =\r\ntext-align: center; width: 570px;\">\r\n<tr>\r\n<td class=3D\"content-cell\" ali=\r\ngn=3D\"center\" style=3D\"box-sizing: border-box; font-family: -apple-system, =\r\nBlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Appl=\r\ne Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; ma=\r\nx-width: 100vw; padding: 32px;\">\r\n<p style=3D\"box-sizing: border-box; font=\r\n-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, =\r\nArial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'=\r\n; position: relative; line-height: 1.5em; margin-top: 0; color: #b0adc5; fo=\r\nnt-size: 12px; text-align: center;\">=C2=A9 2025 TourMate. All rights reserv=\r\ned.</p>\r\n\r\n</td>\r\n</tr>\r\n</table>\r\n</td>\r\n</tr>\r\n</table>\r\n</td>\r\n=\r\n</tr>\r\n</table>\r\n</body>\r\n</html>\r\n--EKl67Hk2--\r\n', 'From: TourMate <tourmate@example.com>\r\nTo: admin@user.com\r\nSubject: Sorry to see you go...\r\n', NULL),
(3, '2025-10-09 22:07:54', 'TourMate <tourmate@example.com>', 'admin@user.com', NULL, NULL, 'Sorry to see you go...', '--g8ecRTHd\r\nContent-Type: text/plain; charset=utf-8\r\nContent-Transfer-Encoding: quoted-printable\r\n\r\n[TourMate](http://localhost)\r\n\r\n# Hello lruecker,\r\n\r\nWe are very sorry =\r\nto see you go. We wanted to let you know that your account has been deleted=\r\n. Thank for the time we shared. You have 31 days to restore your account.=\r\n\r\n\r\nRestore Account: http://127.0.0.1:8000/re-activate/1\r\n\r\nWe hope to =\r\nsee you again!\r\n\r\nRegards,TourMate\r\n\r\nIf you=E2=80=99re having trouble =\r\nclicking the \"Restore Account\" button, copy and paste the URL below\r\ninto =\r\nyour web browser: [http://127.0.0.1:8000/re-activate/1](http://127.0.0.1:80=\r\n00/re-activate/1)\r\n\r\n=C2=A9 2025 TourMate. All rights reserved.\r\n\r\n--g8ecRTHd\r\nContent-Type: text/html; charset=utf-8\r\nContent-Transfer-Encoding: quoted-printable\r\n\r\n<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.=\r\nw3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\r\n<html xmlns=3D\"http://www.=\r\nw3.org/1999/xhtml\">\r\n<head>\r\n<meta name=3D\"viewport\" content=3D\"width=3Dd=\r\nevice-width, initial-scale=3D1.0\">\r\n<meta http-equiv=3D\"Content-Type\" cont=\r\nent=3D\"text/html; charset=3DUTF-8\">\r\n</head>\r\n<body style=3D\"box-sizing: =\r\nborder-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Rob=\r\noto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'=\r\nSegoe UI Symbol\'; position: relative; -webkit-text-size-adjust: none; backg=\r\nround-color: #ffffff; color: #718096; height: 100%; line-height: 1.4; margi=\r\nn: 0; padding: 0; width: 100% !important;\">\r\n<style>\r\n@media only screen =\r\nand (max-width: 600px) {\r\n.inner-body {\r\nwidth: 100% !important;\r\n}\r\n=\r\n\r\n.footer {\r\nwidth: 100% !important;\r\n}\r\n}\r\n\r\n@media only screen and =\r\n(max-width: 500px) {\r\n.button {\r\nwidth: 100% !important;\r\n}\r\n}\r\n</styl=\r\ne>\r\n\r\n<table class=3D\"wrapper\" width=3D\"100%\" cellpadding=3D\"0\" cellspaci=\r\nng=3D\"0\" role=3D\"presentation\" style=3D\"box-sizing: border-box; font-family=\r\n: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, =\r\nsans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; posit=\r\nion: relative; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -prema=\r\niler-width: 100%; background-color: #edf2f7; margin: 0; padding: 0; width: =\r\n100%;\">\r\n<tr>\r\n<td align=3D\"center\" style=3D\"box-sizing: border-box; font=\r\n-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, =\r\nArial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'=\r\n; position: relative;\">\r\n<table class=3D\"content\" width=3D\"100%\" cellpaddi=\r\nng=3D\"0\" cellspacing=3D\"0\" role=3D\"presentation\" style=3D\"box-sizing: borde=\r\nr-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, =\r\nHelvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe=\r\n UI Symbol\'; position: relative; -premailer-cellpadding: 0; -premailer-cell=\r\nspacing: 0; -premailer-width: 100%; margin: 0; padding: 0; width: 100%;\">=\r\n\r\n<tr>\r\n<td class=3D\"header\" style=3D\"box-sizing: border-box; font-family=\r\n: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, =\r\nsans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; posit=\r\nion: relative; padding: 25px 0; text-align: center;\">\r\n<a href=3D\"http://l=\r\nocalhost\" style=3D\"box-sizing: border-box; font-family: -apple-system, Blin=\r\nkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Co=\r\nlor Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; color:=\r\n #3d4852; font-size: 19px; font-weight: bold; text-decoration: none; displa=\r\ny: inline-block;\">\r\nTourMate\r\n</a>\r\n</td>\r\n</tr>\r\n\r\n<!-- Email Body -=\r\n->\r\n<tr>\r\n<td class=3D\"body\" width=3D\"100%\" cellpadding=3D\"0\" cellspacing=\r\n=3D\"0\" style=3D\"box-sizing: border-box; font-family: -apple-system, BlinkMa=\r\ncSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color=\r\n Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; -premaile=\r\nr-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%; backgr=\r\nound-color: #edf2f7; border-bottom: 1px solid #edf2f7; border-top: 1px soli=\r\nd #edf2f7; margin: 0; padding: 0; width: 100%;\">\r\n<table class=3D\"inner-bo=\r\ndy\" align=3D\"center\" width=3D\"570\" cellpadding=3D\"0\" cellspacing=3D\"0\" role=\r\n=3D\"presentation\" style=3D\"box-sizing: border-box; font-family: -apple-syst=\r\nem, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'=\r\nApple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative=\r\n; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 5=\r\n70px; background-color: #ffffff; border-color: #e8e5ef; border-radius: 2px;=\r\n border-width: 1px; box-shadow: 0 2px 0 rgba(0, 0, 150, 0.025), 2px 4px 0 r=\r\ngba(0, 0, 150, 0.015); margin: 0 auto; padding: 0; width: 570px;\">\r\n<!-- B=\r\nody content -->\r\n<tr>\r\n<td class=3D\"content-cell\" style=3D\"box-sizing: bo=\r\nrder-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Robot=\r\no, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Se=\r\ngoe UI Symbol\'; position: relative; max-width: 100vw; padding: 32px;\">\r\n<h=\r\n1 style=3D\"box-sizing: border-box; font-family: -apple-system, BlinkMacSyst=\r\nemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoj=\r\ni\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; color: #3d4852=\r\n; font-size: 18px; font-weight: bold; margin-top: 0; text-align: left;\">Hel=\r\nlo lruecker,</h1>\r\n<p style=3D\"box-sizing: border-box; font-family: -apple=\r\n-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-ser=\r\nif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: rel=\r\native; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left=\r\n;\">We are very sorry to see you go. We wanted to let you know that your acc=\r\nount has been deleted. Thank for the time we shared. You have 31 days to re=\r\nstore your account.</p>\r\n<table class=3D\"action\" align=3D\"center\" width=3D=\r\n\"100%\" cellpadding=3D\"0\" cellspacing=3D\"0\" role=3D\"presentation\" style=3D\"b=\r\nox-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Seg=\r\noe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe U=\r\nI Emoji\', \'Segoe UI Symbol\'; position: relative; -premailer-cellpadding: 0;=\r\n -premailer-cellspacing: 0; -premailer-width: 100%; margin: 30px auto; padd=\r\ning: 0; text-align: center; width: 100%;\">\r\n<tr>\r\n<td align=3D\"center\" st=\r\nyle=3D\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFo=\r\nnt, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', =\r\n\'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative;\">\r\n<table width=\r\n=3D\"100%\" border=3D\"0\" cellpadding=3D\"0\" cellspacing=3D\"0\" role=3D\"presenta=\r\ntion\" style=3D\"box-sizing: border-box; font-family: -apple-system, BlinkMac=\r\nSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color =\r\nEmoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative;\">\r\n<tr>=\r\n\r\n<td align=3D\"center\" style=3D\"box-sizing: border-box; font-family: -appl=\r\ne-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-se=\r\nrif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: re=\r\nlative;\">\r\n<table border=3D\"0\" cellpadding=3D\"0\" cellspacing=3D\"0\" role=3D=\r\n\"presentation\" style=3D\"box-sizing: border-box; font-family: -apple-system,=\r\n BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'App=\r\nle Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative;\">=\r\n\r\n<tr>\r\n<td style=3D\"box-sizing: border-box; font-family: -apple-system, =\r\nBlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Appl=\r\ne Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative;\">=\r\n\r\n<a href=3D\"http://127.0.0.1:8000/re-activate/1\" class=3D\"button button-b=\r\nlue\" target=3D\"_blank\" rel=3D\"noopener\" style=3D\"box-sizing: border-box; fo=\r\nnt-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica=\r\n, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbo=\r\nl\'; position: relative; -webkit-text-size-adjust: none; border-radius: 4px;=\r\n color: #fff; display: inline-block; overflow: hidden; text-decoration: non=\r\ne; background-color: #2d3748; border-bottom: 8px solid #2d3748; border-left=\r\n: 18px solid #2d3748; border-right: 18px solid #2d3748; border-top: 8px sol=\r\nid #2d3748;\">Restore Account</a>\r\n</td>\r\n</tr>\r\n</table>\r\n</td>\r\n</tr>=\r\n\r\n</table>\r\n</td>\r\n</tr>\r\n</table>\r\n<p style=3D\"box-sizing: border-box=\r\n; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helve=\r\ntica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI S=\r\nymbol\'; position: relative; font-size: 16px; line-height: 1.5em; margin-top=\r\n: 0; text-align: left;\">We hope to see you again!</p>\r\n<!-- Salutation -->=\r\n\r\n<p style=3D\"box-sizing: border-box; font-family: -apple-system, BlinkMac=\r\nSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color =\r\nEmoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; font-size:=\r\n 16px; line-height: 1.5em; margin-top: 0; text-align: left;\">Regards,<br>To=\r\nurMate</p>\r\n<!-- Subcopy -->\r\n<table class=3D\"subcopy\" width=3D\"100%\" cel=\r\nlpadding=3D\"0\" cellspacing=3D\"0\" role=3D\"presentation\" style=3D\"box-sizing:=\r\n border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Ro=\r\nboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', =\r\n\'Segoe UI Symbol\'; position: relative; border-top: 1px solid #e8e5ef; margi=\r\nn-top: 25px; padding-top: 25px;\">\r\n<tr>\r\n<td style=3D\"box-sizing: border-=\r\nbox; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, He=\r\nlvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe U=\r\nI Symbol\'; position: relative;\">\r\n<p style=3D\"box-sizing: border-box; font=\r\n-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, =\r\nArial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'=\r\n; position: relative; line-height: 1.5em; margin-top: 0; text-align: left; =\r\nfont-size: 14px;\">If you=E2=80=99re having trouble clicking the \"Restore Ac=\r\ncount\" button, copy and paste the URL below\r\ninto your web browser: <a hre=\r\nf=3D\"http://127.0.0.1:8000/re-activate/1\" style=3D\"box-sizing: border-box; =\r\nfont-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helveti=\r\nca, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Sym=\r\nbol\'; position: relative; color: #3869d4;\">http://127.0.0.1:8000/re-activat=\r\ne/1</a></p>\r\n</td>\r\n</tr>\r\n</table>\r\n\r\n\r\n\r\n</td>\r\n</tr>\r\n</table>=\r\n\r\n</td>\r\n</tr>\r\n\r\n<tr>\r\n<td style=3D\"box-sizing: border-box; font-fami=\r\nly: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial=\r\n, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; pos=\r\nition: relative;\">\r\n<table class=3D\"footer\" align=3D\"center\" width=3D\"570\"=\r\n cellpadding=3D\"0\" cellspacing=3D\"0\" role=3D\"presentation\" style=3D\"box-siz=\r\ning: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\'=\r\n, Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoj=\r\ni\', \'Segoe UI Symbol\'; position: relative; -premailer-cellpadding: 0; -prem=\r\nailer-cellspacing: 0; -premailer-width: 570px; margin: 0 auto; padding: 0; =\r\ntext-align: center; width: 570px;\">\r\n<tr>\r\n<td class=3D\"content-cell\" ali=\r\ngn=3D\"center\" style=3D\"box-sizing: border-box; font-family: -apple-system, =\r\nBlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Appl=\r\ne Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; ma=\r\nx-width: 100vw; padding: 32px;\">\r\n<p style=3D\"box-sizing: border-box; font=\r\n-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, =\r\nArial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'=\r\n; position: relative; line-height: 1.5em; margin-top: 0; color: #b0adc5; fo=\r\nnt-size: 12px; text-align: center;\">=C2=A9 2025 TourMate. All rights reserv=\r\ned.</p>\r\n\r\n</td>\r\n</tr>\r\n</table>\r\n</td>\r\n</tr>\r\n</table>\r\n</td>\r\n=\r\n</tr>\r\n</table>\r\n</body>\r\n</html>\r\n--g8ecRTHd--\r\n', 'From: TourMate <tourmate@example.com>\r\nTo: admin@user.com\r\nSubject: Sorry to see you go...\r\n', NULL);
INSERT INTO `email_log` (`id`, `date`, `from`, `to`, `cc`, `bcc`, `subject`, `body`, `headers`, `attachments`) VALUES
(4, '2025-10-09 22:19:05', 'TourMate <tourmate@example.com>', 'admin@user.com', NULL, NULL, 'Sorry to see you go...', '--Is6JMPIz\r\nContent-Type: text/plain; charset=utf-8\r\nContent-Transfer-Encoding: quoted-printable\r\n\r\n[TourMate](http://localhost)\r\n\r\n# Hello lruecker,\r\n\r\nWe are very sorry =\r\nto see you go. We wanted to let you know that your account has been deleted=\r\n. Thank for the time we shared. You have 31 days to restore your account.=\r\n\r\n\r\nRestore Account: http://127.0.0.1:8000/re-activate/1\r\n\r\nWe hope to =\r\nsee you again!\r\n\r\nRegards,TourMate\r\n\r\nIf you=E2=80=99re having trouble =\r\nclicking the \"Restore Account\" button, copy and paste the URL below\r\ninto =\r\nyour web browser: [http://127.0.0.1:8000/re-activate/1](http://127.0.0.1:80=\r\n00/re-activate/1)\r\n\r\n=C2=A9 2025 TourMate. All rights reserved.\r\n\r\n--Is6JMPIz\r\nContent-Type: text/html; charset=utf-8\r\nContent-Transfer-Encoding: quoted-printable\r\n\r\n<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.=\r\nw3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\r\n<html xmlns=3D\"http://www.=\r\nw3.org/1999/xhtml\">\r\n<head>\r\n<meta name=3D\"viewport\" content=3D\"width=3Dd=\r\nevice-width, initial-scale=3D1.0\">\r\n<meta http-equiv=3D\"Content-Type\" cont=\r\nent=3D\"text/html; charset=3DUTF-8\">\r\n</head>\r\n<body style=3D\"box-sizing: =\r\nborder-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Rob=\r\noto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'=\r\nSegoe UI Symbol\'; position: relative; -webkit-text-size-adjust: none; backg=\r\nround-color: #ffffff; color: #718096; height: 100%; line-height: 1.4; margi=\r\nn: 0; padding: 0; width: 100% !important;\">\r\n<style>\r\n@media only screen =\r\nand (max-width: 600px) {\r\n.inner-body {\r\nwidth: 100% !important;\r\n}\r\n=\r\n\r\n.footer {\r\nwidth: 100% !important;\r\n}\r\n}\r\n\r\n@media only screen and =\r\n(max-width: 500px) {\r\n.button {\r\nwidth: 100% !important;\r\n}\r\n}\r\n</styl=\r\ne>\r\n\r\n<table class=3D\"wrapper\" width=3D\"100%\" cellpadding=3D\"0\" cellspaci=\r\nng=3D\"0\" role=3D\"presentation\" style=3D\"box-sizing: border-box; font-family=\r\n: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, =\r\nsans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; posit=\r\nion: relative; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -prema=\r\niler-width: 100%; background-color: #edf2f7; margin: 0; padding: 0; width: =\r\n100%;\">\r\n<tr>\r\n<td align=3D\"center\" style=3D\"box-sizing: border-box; font=\r\n-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, =\r\nArial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'=\r\n; position: relative;\">\r\n<table class=3D\"content\" width=3D\"100%\" cellpaddi=\r\nng=3D\"0\" cellspacing=3D\"0\" role=3D\"presentation\" style=3D\"box-sizing: borde=\r\nr-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, =\r\nHelvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe=\r\n UI Symbol\'; position: relative; -premailer-cellpadding: 0; -premailer-cell=\r\nspacing: 0; -premailer-width: 100%; margin: 0; padding: 0; width: 100%;\">=\r\n\r\n<tr>\r\n<td class=3D\"header\" style=3D\"box-sizing: border-box; font-family=\r\n: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, =\r\nsans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; posit=\r\nion: relative; padding: 25px 0; text-align: center;\">\r\n<a href=3D\"http://l=\r\nocalhost\" style=3D\"box-sizing: border-box; font-family: -apple-system, Blin=\r\nkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Co=\r\nlor Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; color:=\r\n #3d4852; font-size: 19px; font-weight: bold; text-decoration: none; displa=\r\ny: inline-block;\">\r\nTourMate\r\n</a>\r\n</td>\r\n</tr>\r\n\r\n<!-- Email Body -=\r\n->\r\n<tr>\r\n<td class=3D\"body\" width=3D\"100%\" cellpadding=3D\"0\" cellspacing=\r\n=3D\"0\" style=3D\"box-sizing: border-box; font-family: -apple-system, BlinkMa=\r\ncSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color=\r\n Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; -premaile=\r\nr-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%; backgr=\r\nound-color: #edf2f7; border-bottom: 1px solid #edf2f7; border-top: 1px soli=\r\nd #edf2f7; margin: 0; padding: 0; width: 100%;\">\r\n<table class=3D\"inner-bo=\r\ndy\" align=3D\"center\" width=3D\"570\" cellpadding=3D\"0\" cellspacing=3D\"0\" role=\r\n=3D\"presentation\" style=3D\"box-sizing: border-box; font-family: -apple-syst=\r\nem, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'=\r\nApple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative=\r\n; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 5=\r\n70px; background-color: #ffffff; border-color: #e8e5ef; border-radius: 2px;=\r\n border-width: 1px; box-shadow: 0 2px 0 rgba(0, 0, 150, 0.025), 2px 4px 0 r=\r\ngba(0, 0, 150, 0.015); margin: 0 auto; padding: 0; width: 570px;\">\r\n<!-- B=\r\nody content -->\r\n<tr>\r\n<td class=3D\"content-cell\" style=3D\"box-sizing: bo=\r\nrder-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Robot=\r\no, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Se=\r\ngoe UI Symbol\'; position: relative; max-width: 100vw; padding: 32px;\">\r\n<h=\r\n1 style=3D\"box-sizing: border-box; font-family: -apple-system, BlinkMacSyst=\r\nemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoj=\r\ni\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; color: #3d4852=\r\n; font-size: 18px; font-weight: bold; margin-top: 0; text-align: left;\">Hel=\r\nlo lruecker,</h1>\r\n<p style=3D\"box-sizing: border-box; font-family: -apple=\r\n-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-ser=\r\nif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: rel=\r\native; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left=\r\n;\">We are very sorry to see you go. We wanted to let you know that your acc=\r\nount has been deleted. Thank for the time we shared. You have 31 days to re=\r\nstore your account.</p>\r\n<table class=3D\"action\" align=3D\"center\" width=3D=\r\n\"100%\" cellpadding=3D\"0\" cellspacing=3D\"0\" role=3D\"presentation\" style=3D\"b=\r\nox-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Seg=\r\noe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe U=\r\nI Emoji\', \'Segoe UI Symbol\'; position: relative; -premailer-cellpadding: 0;=\r\n -premailer-cellspacing: 0; -premailer-width: 100%; margin: 30px auto; padd=\r\ning: 0; text-align: center; width: 100%;\">\r\n<tr>\r\n<td align=3D\"center\" st=\r\nyle=3D\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFo=\r\nnt, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', =\r\n\'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative;\">\r\n<table width=\r\n=3D\"100%\" border=3D\"0\" cellpadding=3D\"0\" cellspacing=3D\"0\" role=3D\"presenta=\r\ntion\" style=3D\"box-sizing: border-box; font-family: -apple-system, BlinkMac=\r\nSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color =\r\nEmoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative;\">\r\n<tr>=\r\n\r\n<td align=3D\"center\" style=3D\"box-sizing: border-box; font-family: -appl=\r\ne-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-se=\r\nrif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: re=\r\nlative;\">\r\n<table border=3D\"0\" cellpadding=3D\"0\" cellspacing=3D\"0\" role=3D=\r\n\"presentation\" style=3D\"box-sizing: border-box; font-family: -apple-system,=\r\n BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'App=\r\nle Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative;\">=\r\n\r\n<tr>\r\n<td style=3D\"box-sizing: border-box; font-family: -apple-system, =\r\nBlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Appl=\r\ne Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative;\">=\r\n\r\n<a href=3D\"http://127.0.0.1:8000/re-activate/1\" class=3D\"button button-b=\r\nlue\" target=3D\"_blank\" rel=3D\"noopener\" style=3D\"box-sizing: border-box; fo=\r\nnt-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica=\r\n, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbo=\r\nl\'; position: relative; -webkit-text-size-adjust: none; border-radius: 4px;=\r\n color: #fff; display: inline-block; overflow: hidden; text-decoration: non=\r\ne; background-color: #2d3748; border-bottom: 8px solid #2d3748; border-left=\r\n: 18px solid #2d3748; border-right: 18px solid #2d3748; border-top: 8px sol=\r\nid #2d3748;\">Restore Account</a>\r\n</td>\r\n</tr>\r\n</table>\r\n</td>\r\n</tr>=\r\n\r\n</table>\r\n</td>\r\n</tr>\r\n</table>\r\n<p style=3D\"box-sizing: border-box=\r\n; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helve=\r\ntica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI S=\r\nymbol\'; position: relative; font-size: 16px; line-height: 1.5em; margin-top=\r\n: 0; text-align: left;\">We hope to see you again!</p>\r\n<!-- Salutation -->=\r\n\r\n<p style=3D\"box-sizing: border-box; font-family: -apple-system, BlinkMac=\r\nSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color =\r\nEmoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; font-size:=\r\n 16px; line-height: 1.5em; margin-top: 0; text-align: left;\">Regards,<br>To=\r\nurMate</p>\r\n<!-- Subcopy -->\r\n<table class=3D\"subcopy\" width=3D\"100%\" cel=\r\nlpadding=3D\"0\" cellspacing=3D\"0\" role=3D\"presentation\" style=3D\"box-sizing:=\r\n border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Ro=\r\nboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', =\r\n\'Segoe UI Symbol\'; position: relative; border-top: 1px solid #e8e5ef; margi=\r\nn-top: 25px; padding-top: 25px;\">\r\n<tr>\r\n<td style=3D\"box-sizing: border-=\r\nbox; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, He=\r\nlvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe U=\r\nI Symbol\'; position: relative;\">\r\n<p style=3D\"box-sizing: border-box; font=\r\n-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, =\r\nArial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'=\r\n; position: relative; line-height: 1.5em; margin-top: 0; text-align: left; =\r\nfont-size: 14px;\">If you=E2=80=99re having trouble clicking the \"Restore Ac=\r\ncount\" button, copy and paste the URL below\r\ninto your web browser: <a hre=\r\nf=3D\"http://127.0.0.1:8000/re-activate/1\" style=3D\"box-sizing: border-box; =\r\nfont-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helveti=\r\nca, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Sym=\r\nbol\'; position: relative; color: #3869d4;\">http://127.0.0.1:8000/re-activat=\r\ne/1</a></p>\r\n</td>\r\n</tr>\r\n</table>\r\n\r\n\r\n\r\n</td>\r\n</tr>\r\n</table>=\r\n\r\n</td>\r\n</tr>\r\n\r\n<tr>\r\n<td style=3D\"box-sizing: border-box; font-fami=\r\nly: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial=\r\n, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; pos=\r\nition: relative;\">\r\n<table class=3D\"footer\" align=3D\"center\" width=3D\"570\"=\r\n cellpadding=3D\"0\" cellspacing=3D\"0\" role=3D\"presentation\" style=3D\"box-siz=\r\ning: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\'=\r\n, Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoj=\r\ni\', \'Segoe UI Symbol\'; position: relative; -premailer-cellpadding: 0; -prem=\r\nailer-cellspacing: 0; -premailer-width: 570px; margin: 0 auto; padding: 0; =\r\ntext-align: center; width: 570px;\">\r\n<tr>\r\n<td class=3D\"content-cell\" ali=\r\ngn=3D\"center\" style=3D\"box-sizing: border-box; font-family: -apple-system, =\r\nBlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Appl=\r\ne Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; ma=\r\nx-width: 100vw; padding: 32px;\">\r\n<p style=3D\"box-sizing: border-box; font=\r\n-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, =\r\nArial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'=\r\n; position: relative; line-height: 1.5em; margin-top: 0; color: #b0adc5; fo=\r\nnt-size: 12px; text-align: center;\">=C2=A9 2025 TourMate. All rights reserv=\r\ned.</p>\r\n\r\n</td>\r\n</tr>\r\n</table>\r\n</td>\r\n</tr>\r\n</table>\r\n</td>\r\n=\r\n</tr>\r\n</table>\r\n</body>\r\n</html>\r\n--Is6JMPIz--\r\n', 'From: TourMate <tourmate@example.com>\r\nTo: admin@user.com\r\nSubject: Sorry to see you go...\r\n', NULL),
(5, '2025-10-09 22:20:04', 'TourMate <tourmate@example.com>', 'admin@user.com', NULL, NULL, 'Sorry to see you go...', '--gegeBhcu\r\nContent-Type: text/plain; charset=utf-8\r\nContent-Transfer-Encoding: quoted-printable\r\n\r\n[TourMate](http://localhost)\r\n\r\n# Hello lruecker,\r\n\r\nWe are very sorry =\r\nto see you go. We wanted to let you know that your account has been deleted=\r\n. Thank for the time we shared. You have 31 days to restore your account.=\r\n\r\n\r\nRestore Account: http://127.0.0.1:8000/re-activate/1\r\n\r\nWe hope to =\r\nsee you again!\r\n\r\nRegards,TourMate\r\n\r\nIf you=E2=80=99re having trouble =\r\nclicking the \"Restore Account\" button, copy and paste the URL below\r\ninto =\r\nyour web browser: [http://127.0.0.1:8000/re-activate/1](http://127.0.0.1:80=\r\n00/re-activate/1)\r\n\r\n=C2=A9 2025 TourMate. All rights reserved.\r\n\r\n--gegeBhcu\r\nContent-Type: text/html; charset=utf-8\r\nContent-Transfer-Encoding: quoted-printable\r\n\r\n<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.=\r\nw3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\r\n<html xmlns=3D\"http://www.=\r\nw3.org/1999/xhtml\">\r\n<head>\r\n<meta name=3D\"viewport\" content=3D\"width=3Dd=\r\nevice-width, initial-scale=3D1.0\">\r\n<meta http-equiv=3D\"Content-Type\" cont=\r\nent=3D\"text/html; charset=3DUTF-8\">\r\n</head>\r\n<body style=3D\"box-sizing: =\r\nborder-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Rob=\r\noto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'=\r\nSegoe UI Symbol\'; position: relative; -webkit-text-size-adjust: none; backg=\r\nround-color: #ffffff; color: #718096; height: 100%; line-height: 1.4; margi=\r\nn: 0; padding: 0; width: 100% !important;\">\r\n<style>\r\n@media only screen =\r\nand (max-width: 600px) {\r\n.inner-body {\r\nwidth: 100% !important;\r\n}\r\n=\r\n\r\n.footer {\r\nwidth: 100% !important;\r\n}\r\n}\r\n\r\n@media only screen and =\r\n(max-width: 500px) {\r\n.button {\r\nwidth: 100% !important;\r\n}\r\n}\r\n</styl=\r\ne>\r\n\r\n<table class=3D\"wrapper\" width=3D\"100%\" cellpadding=3D\"0\" cellspaci=\r\nng=3D\"0\" role=3D\"presentation\" style=3D\"box-sizing: border-box; font-family=\r\n: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, =\r\nsans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; posit=\r\nion: relative; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -prema=\r\niler-width: 100%; background-color: #edf2f7; margin: 0; padding: 0; width: =\r\n100%;\">\r\n<tr>\r\n<td align=3D\"center\" style=3D\"box-sizing: border-box; font=\r\n-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, =\r\nArial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'=\r\n; position: relative;\">\r\n<table class=3D\"content\" width=3D\"100%\" cellpaddi=\r\nng=3D\"0\" cellspacing=3D\"0\" role=3D\"presentation\" style=3D\"box-sizing: borde=\r\nr-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, =\r\nHelvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe=\r\n UI Symbol\'; position: relative; -premailer-cellpadding: 0; -premailer-cell=\r\nspacing: 0; -premailer-width: 100%; margin: 0; padding: 0; width: 100%;\">=\r\n\r\n<tr>\r\n<td class=3D\"header\" style=3D\"box-sizing: border-box; font-family=\r\n: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, =\r\nsans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; posit=\r\nion: relative; padding: 25px 0; text-align: center;\">\r\n<a href=3D\"http://l=\r\nocalhost\" style=3D\"box-sizing: border-box; font-family: -apple-system, Blin=\r\nkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Co=\r\nlor Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; color:=\r\n #3d4852; font-size: 19px; font-weight: bold; text-decoration: none; displa=\r\ny: inline-block;\">\r\nTourMate\r\n</a>\r\n</td>\r\n</tr>\r\n\r\n<!-- Email Body -=\r\n->\r\n<tr>\r\n<td class=3D\"body\" width=3D\"100%\" cellpadding=3D\"0\" cellspacing=\r\n=3D\"0\" style=3D\"box-sizing: border-box; font-family: -apple-system, BlinkMa=\r\ncSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color=\r\n Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; -premaile=\r\nr-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%; backgr=\r\nound-color: #edf2f7; border-bottom: 1px solid #edf2f7; border-top: 1px soli=\r\nd #edf2f7; margin: 0; padding: 0; width: 100%;\">\r\n<table class=3D\"inner-bo=\r\ndy\" align=3D\"center\" width=3D\"570\" cellpadding=3D\"0\" cellspacing=3D\"0\" role=\r\n=3D\"presentation\" style=3D\"box-sizing: border-box; font-family: -apple-syst=\r\nem, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'=\r\nApple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative=\r\n; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 5=\r\n70px; background-color: #ffffff; border-color: #e8e5ef; border-radius: 2px;=\r\n border-width: 1px; box-shadow: 0 2px 0 rgba(0, 0, 150, 0.025), 2px 4px 0 r=\r\ngba(0, 0, 150, 0.015); margin: 0 auto; padding: 0; width: 570px;\">\r\n<!-- B=\r\nody content -->\r\n<tr>\r\n<td class=3D\"content-cell\" style=3D\"box-sizing: bo=\r\nrder-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Robot=\r\no, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Se=\r\ngoe UI Symbol\'; position: relative; max-width: 100vw; padding: 32px;\">\r\n<h=\r\n1 style=3D\"box-sizing: border-box; font-family: -apple-system, BlinkMacSyst=\r\nemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoj=\r\ni\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; color: #3d4852=\r\n; font-size: 18px; font-weight: bold; margin-top: 0; text-align: left;\">Hel=\r\nlo lruecker,</h1>\r\n<p style=3D\"box-sizing: border-box; font-family: -apple=\r\n-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-ser=\r\nif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: rel=\r\native; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left=\r\n;\">We are very sorry to see you go. We wanted to let you know that your acc=\r\nount has been deleted. Thank for the time we shared. You have 31 days to re=\r\nstore your account.</p>\r\n<table class=3D\"action\" align=3D\"center\" width=3D=\r\n\"100%\" cellpadding=3D\"0\" cellspacing=3D\"0\" role=3D\"presentation\" style=3D\"b=\r\nox-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Seg=\r\noe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe U=\r\nI Emoji\', \'Segoe UI Symbol\'; position: relative; -premailer-cellpadding: 0;=\r\n -premailer-cellspacing: 0; -premailer-width: 100%; margin: 30px auto; padd=\r\ning: 0; text-align: center; width: 100%;\">\r\n<tr>\r\n<td align=3D\"center\" st=\r\nyle=3D\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFo=\r\nnt, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', =\r\n\'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative;\">\r\n<table width=\r\n=3D\"100%\" border=3D\"0\" cellpadding=3D\"0\" cellspacing=3D\"0\" role=3D\"presenta=\r\ntion\" style=3D\"box-sizing: border-box; font-family: -apple-system, BlinkMac=\r\nSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color =\r\nEmoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative;\">\r\n<tr>=\r\n\r\n<td align=3D\"center\" style=3D\"box-sizing: border-box; font-family: -appl=\r\ne-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-se=\r\nrif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: re=\r\nlative;\">\r\n<table border=3D\"0\" cellpadding=3D\"0\" cellspacing=3D\"0\" role=3D=\r\n\"presentation\" style=3D\"box-sizing: border-box; font-family: -apple-system,=\r\n BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'App=\r\nle Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative;\">=\r\n\r\n<tr>\r\n<td style=3D\"box-sizing: border-box; font-family: -apple-system, =\r\nBlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Appl=\r\ne Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative;\">=\r\n\r\n<a href=3D\"http://127.0.0.1:8000/re-activate/1\" class=3D\"button button-b=\r\nlue\" target=3D\"_blank\" rel=3D\"noopener\" style=3D\"box-sizing: border-box; fo=\r\nnt-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica=\r\n, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbo=\r\nl\'; position: relative; -webkit-text-size-adjust: none; border-radius: 4px;=\r\n color: #fff; display: inline-block; overflow: hidden; text-decoration: non=\r\ne; background-color: #2d3748; border-bottom: 8px solid #2d3748; border-left=\r\n: 18px solid #2d3748; border-right: 18px solid #2d3748; border-top: 8px sol=\r\nid #2d3748;\">Restore Account</a>\r\n</td>\r\n</tr>\r\n</table>\r\n</td>\r\n</tr>=\r\n\r\n</table>\r\n</td>\r\n</tr>\r\n</table>\r\n<p style=3D\"box-sizing: border-box=\r\n; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helve=\r\ntica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI S=\r\nymbol\'; position: relative; font-size: 16px; line-height: 1.5em; margin-top=\r\n: 0; text-align: left;\">We hope to see you again!</p>\r\n<!-- Salutation -->=\r\n\r\n<p style=3D\"box-sizing: border-box; font-family: -apple-system, BlinkMac=\r\nSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color =\r\nEmoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; font-size:=\r\n 16px; line-height: 1.5em; margin-top: 0; text-align: left;\">Regards,<br>To=\r\nurMate</p>\r\n<!-- Subcopy -->\r\n<table class=3D\"subcopy\" width=3D\"100%\" cel=\r\nlpadding=3D\"0\" cellspacing=3D\"0\" role=3D\"presentation\" style=3D\"box-sizing:=\r\n border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Ro=\r\nboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', =\r\n\'Segoe UI Symbol\'; position: relative; border-top: 1px solid #e8e5ef; margi=\r\nn-top: 25px; padding-top: 25px;\">\r\n<tr>\r\n<td style=3D\"box-sizing: border-=\r\nbox; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, He=\r\nlvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe U=\r\nI Symbol\'; position: relative;\">\r\n<p style=3D\"box-sizing: border-box; font=\r\n-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, =\r\nArial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'=\r\n; position: relative; line-height: 1.5em; margin-top: 0; text-align: left; =\r\nfont-size: 14px;\">If you=E2=80=99re having trouble clicking the \"Restore Ac=\r\ncount\" button, copy and paste the URL below\r\ninto your web browser: <a hre=\r\nf=3D\"http://127.0.0.1:8000/re-activate/1\" style=3D\"box-sizing: border-box; =\r\nfont-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helveti=\r\nca, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Sym=\r\nbol\'; position: relative; color: #3869d4;\">http://127.0.0.1:8000/re-activat=\r\ne/1</a></p>\r\n</td>\r\n</tr>\r\n</table>\r\n\r\n\r\n\r\n</td>\r\n</tr>\r\n</table>=\r\n\r\n</td>\r\n</tr>\r\n\r\n<tr>\r\n<td style=3D\"box-sizing: border-box; font-fami=\r\nly: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial=\r\n, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; pos=\r\nition: relative;\">\r\n<table class=3D\"footer\" align=3D\"center\" width=3D\"570\"=\r\n cellpadding=3D\"0\" cellspacing=3D\"0\" role=3D\"presentation\" style=3D\"box-siz=\r\ning: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\'=\r\n, Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoj=\r\ni\', \'Segoe UI Symbol\'; position: relative; -premailer-cellpadding: 0; -prem=\r\nailer-cellspacing: 0; -premailer-width: 570px; margin: 0 auto; padding: 0; =\r\ntext-align: center; width: 570px;\">\r\n<tr>\r\n<td class=3D\"content-cell\" ali=\r\ngn=3D\"center\" style=3D\"box-sizing: border-box; font-family: -apple-system, =\r\nBlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Appl=\r\ne Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; ma=\r\nx-width: 100vw; padding: 32px;\">\r\n<p style=3D\"box-sizing: border-box; font=\r\n-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, =\r\nArial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'=\r\n; position: relative; line-height: 1.5em; margin-top: 0; color: #b0adc5; fo=\r\nnt-size: 12px; text-align: center;\">=C2=A9 2025 TourMate. All rights reserv=\r\ned.</p>\r\n\r\n</td>\r\n</tr>\r\n</table>\r\n</td>\r\n</tr>\r\n</table>\r\n</td>\r\n=\r\n</tr>\r\n</table>\r\n</body>\r\n</html>\r\n--gegeBhcu--\r\n', 'From: TourMate <tourmate@example.com>\r\nTo: admin@user.com\r\nSubject: Sorry to see you go...\r\n', NULL),
(6, '2025-10-13 21:18:29', 'TourMate <tourmate@example.com>', 'user@user.com', NULL, NULL, 'Booking Approved Confirmation', '--YOcE9z63\r\nContent-Type: text/plain; charset=utf-8\r\nContent-Transfer-Encoding: quoted-printable\r\n\r\n[TourMate](http://localhost)\r\n\r\n# Hellojohnpaul84!\r\n\r\nYour booking requ=\r\nest has been successfully Approved\r\n\r\nThank you for using our application=\r\n!\r\n\r\nRegards,TourMate\r\n\r\n=C2=A9 2025 TourMate. All rights reserved.\r\n\r\n--YOcE9z63\r\nContent-Type: text/html; charset=utf-8\r\nContent-Transfer-Encoding: quoted-printable\r\n\r\n<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.=\r\nw3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\r\n<html xmlns=3D\"http://www.=\r\nw3.org/1999/xhtml\">\r\n<head>\r\n<meta name=3D\"viewport\" content=3D\"width=3Dd=\r\nevice-width, initial-scale=3D1.0\">\r\n<meta http-equiv=3D\"Content-Type\" cont=\r\nent=3D\"text/html; charset=3DUTF-8\">\r\n</head>\r\n<body style=3D\"box-sizing: =\r\nborder-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Rob=\r\noto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'=\r\nSegoe UI Symbol\'; position: relative; -webkit-text-size-adjust: none; backg=\r\nround-color: #ffffff; color: #718096; height: 100%; line-height: 1.4; margi=\r\nn: 0; padding: 0; width: 100% !important;\">\r\n<style>\r\n@media only screen =\r\nand (max-width: 600px) {\r\n.inner-body {\r\nwidth: 100% !important;\r\n}\r\n=\r\n\r\n.footer {\r\nwidth: 100% !important;\r\n}\r\n}\r\n\r\n@media only screen and =\r\n(max-width: 500px) {\r\n.button {\r\nwidth: 100% !important;\r\n}\r\n}\r\n</styl=\r\ne>\r\n\r\n<table class=3D\"wrapper\" width=3D\"100%\" cellpadding=3D\"0\" cellspaci=\r\nng=3D\"0\" role=3D\"presentation\" style=3D\"box-sizing: border-box; font-family=\r\n: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, =\r\nsans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; posit=\r\nion: relative; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -prema=\r\niler-width: 100%; background-color: #edf2f7; margin: 0; padding: 0; width: =\r\n100%;\">\r\n<tr>\r\n<td align=3D\"center\" style=3D\"box-sizing: border-box; font=\r\n-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, =\r\nArial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'=\r\n; position: relative;\">\r\n<table class=3D\"content\" width=3D\"100%\" cellpaddi=\r\nng=3D\"0\" cellspacing=3D\"0\" role=3D\"presentation\" style=3D\"box-sizing: borde=\r\nr-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, =\r\nHelvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe=\r\n UI Symbol\'; position: relative; -premailer-cellpadding: 0; -premailer-cell=\r\nspacing: 0; -premailer-width: 100%; margin: 0; padding: 0; width: 100%;\">=\r\n\r\n<tr>\r\n<td class=3D\"header\" style=3D\"box-sizing: border-box; font-family=\r\n: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, =\r\nsans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; posit=\r\nion: relative; padding: 25px 0; text-align: center;\">\r\n<a href=3D\"http://l=\r\nocalhost\" style=3D\"box-sizing: border-box; font-family: -apple-system, Blin=\r\nkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Co=\r\nlor Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; color:=\r\n #3d4852; font-size: 19px; font-weight: bold; text-decoration: none; displa=\r\ny: inline-block;\">\r\nTourMate\r\n</a>\r\n</td>\r\n</tr>\r\n\r\n<!-- Email Body -=\r\n->\r\n<tr>\r\n<td class=3D\"body\" width=3D\"100%\" cellpadding=3D\"0\" cellspacing=\r\n=3D\"0\" style=3D\"box-sizing: border-box; font-family: -apple-system, BlinkMa=\r\ncSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color=\r\n Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; -premaile=\r\nr-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%; backgr=\r\nound-color: #edf2f7; border-bottom: 1px solid #edf2f7; border-top: 1px soli=\r\nd #edf2f7; margin: 0; padding: 0; width: 100%;\">\r\n<table class=3D\"inner-bo=\r\ndy\" align=3D\"center\" width=3D\"570\" cellpadding=3D\"0\" cellspacing=3D\"0\" role=\r\n=3D\"presentation\" style=3D\"box-sizing: border-box; font-family: -apple-syst=\r\nem, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'=\r\nApple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative=\r\n; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 5=\r\n70px; background-color: #ffffff; border-color: #e8e5ef; border-radius: 2px;=\r\n border-width: 1px; box-shadow: 0 2px 0 rgba(0, 0, 150, 0.025), 2px 4px 0 r=\r\ngba(0, 0, 150, 0.015); margin: 0 auto; padding: 0; width: 570px;\">\r\n<!-- B=\r\nody content -->\r\n<tr>\r\n<td class=3D\"content-cell\" style=3D\"box-sizing: bo=\r\nrder-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Robot=\r\no, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Se=\r\ngoe UI Symbol\'; position: relative; max-width: 100vw; padding: 32px;\">\r\n<h=\r\n1 style=3D\"box-sizing: border-box; font-family: -apple-system, BlinkMacSyst=\r\nemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoj=\r\ni\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; color: #3d4852=\r\n; font-size: 18px; font-weight: bold; margin-top: 0; text-align: left;\">Hel=\r\nlojohnpaul84!</h1>\r\n<p style=3D\"box-sizing: border-box; font-family: -appl=\r\ne-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-se=\r\nrif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: re=\r\nlative; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: lef=\r\nt;\">Your booking request has been successfully Approved</p>\r\n<p style=3D\"b=\r\nox-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Seg=\r\noe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe U=\r\nI Emoji\', \'Segoe UI Symbol\'; position: relative; font-size: 16px; line-heig=\r\nht: 1.5em; margin-top: 0; text-align: left;\">Thank you for using our applic=\r\nation!</p>\r\n<!-- Salutation -->\r\n<p style=3D\"box-sizing: border-box; font=\r\n-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, =\r\nArial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'=\r\n; position: relative; font-size: 16px; line-height: 1.5em; margin-top: 0; t=\r\next-align: left;\">Regards,<br>TourMate</p>\r\n<!-- Subcopy -->\r\n\r\n\r\n\r\n</=\r\ntd>\r\n</tr>\r\n</table>\r\n</td>\r\n</tr>\r\n\r\n<tr>\r\n<td style=3D\"box-sizing:=\r\n border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Ro=\r\nboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', =\r\n\'Segoe UI Symbol\'; position: relative;\">\r\n<table class=3D\"footer\" align=3D=\r\n\"center\" width=3D\"570\" cellpadding=3D\"0\" cellspacing=3D\"0\" role=3D\"presenta=\r\ntion\" style=3D\"box-sizing: border-box; font-family: -apple-system, BlinkMac=\r\nSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color =\r\nEmoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; -premailer=\r\n-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 570px; margin=\r\n: 0 auto; padding: 0; text-align: center; width: 570px;\">\r\n<tr>\r\n<td clas=\r\ns=3D\"content-cell\" align=3D\"center\" style=3D\"box-sizing: border-box; font-f=\r\namily: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Ar=\r\nial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; =\r\nposition: relative; max-width: 100vw; padding: 32px;\">\r\n<p style=3D\"box-si=\r\nzing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI=\r\n\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emo=\r\nji\', \'Segoe UI Symbol\'; position: relative; line-height: 1.5em; margin-top:=\r\n 0; color: #b0adc5; font-size: 12px; text-align: center;\">=C2=A9 2025 TourM=\r\nate. All rights reserved.</p>\r\n\r\n</td>\r\n</tr>\r\n</table>\r\n</td>\r\n</tr>=\r\n\r\n</table>\r\n</td>\r\n</tr>\r\n</table>\r\n</body>\r\n</html>\r\n--YOcE9z63--\r\n', 'From: TourMate <tourmate@example.com>\r\nTo: user@user.com\r\nSubject: Booking Approved Confirmation\r\n', NULL),
(7, '2025-10-13 23:18:16', 'TourMate <tourmate@example.com>', 'user@user.com', NULL, NULL, 'Booking Approved Confirmation', '--a5h3K8eW\r\nContent-Type: text/plain; charset=utf-8\r\nContent-Transfer-Encoding: quoted-printable\r\n\r\n[TourMate](http://localhost)\r\n\r\n# Hellojohnpaul84!\r\n\r\nYour booking requ=\r\nest has been successfully Approved\r\n\r\nThank you for using our application=\r\n!\r\n\r\nRegards,TourMate\r\n\r\n=C2=A9 2025 TourMate. All rights reserved.\r\n\r\n--a5h3K8eW\r\nContent-Type: text/html; charset=utf-8\r\nContent-Transfer-Encoding: quoted-printable\r\n\r\n<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.=\r\nw3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\r\n<html xmlns=3D\"http://www.=\r\nw3.org/1999/xhtml\">\r\n<head>\r\n<meta name=3D\"viewport\" content=3D\"width=3Dd=\r\nevice-width, initial-scale=3D1.0\">\r\n<meta http-equiv=3D\"Content-Type\" cont=\r\nent=3D\"text/html; charset=3DUTF-8\">\r\n</head>\r\n<body style=3D\"box-sizing: =\r\nborder-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Rob=\r\noto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'=\r\nSegoe UI Symbol\'; position: relative; -webkit-text-size-adjust: none; backg=\r\nround-color: #ffffff; color: #718096; height: 100%; line-height: 1.4; margi=\r\nn: 0; padding: 0; width: 100% !important;\">\r\n<style>\r\n@media only screen =\r\nand (max-width: 600px) {\r\n.inner-body {\r\nwidth: 100% !important;\r\n}\r\n=\r\n\r\n.footer {\r\nwidth: 100% !important;\r\n}\r\n}\r\n\r\n@media only screen and =\r\n(max-width: 500px) {\r\n.button {\r\nwidth: 100% !important;\r\n}\r\n}\r\n</styl=\r\ne>\r\n\r\n<table class=3D\"wrapper\" width=3D\"100%\" cellpadding=3D\"0\" cellspaci=\r\nng=3D\"0\" role=3D\"presentation\" style=3D\"box-sizing: border-box; font-family=\r\n: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, =\r\nsans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; posit=\r\nion: relative; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -prema=\r\niler-width: 100%; background-color: #edf2f7; margin: 0; padding: 0; width: =\r\n100%;\">\r\n<tr>\r\n<td align=3D\"center\" style=3D\"box-sizing: border-box; font=\r\n-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, =\r\nArial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'=\r\n; position: relative;\">\r\n<table class=3D\"content\" width=3D\"100%\" cellpaddi=\r\nng=3D\"0\" cellspacing=3D\"0\" role=3D\"presentation\" style=3D\"box-sizing: borde=\r\nr-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, =\r\nHelvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe=\r\n UI Symbol\'; position: relative; -premailer-cellpadding: 0; -premailer-cell=\r\nspacing: 0; -premailer-width: 100%; margin: 0; padding: 0; width: 100%;\">=\r\n\r\n<tr>\r\n<td class=3D\"header\" style=3D\"box-sizing: border-box; font-family=\r\n: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, =\r\nsans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; posit=\r\nion: relative; padding: 25px 0; text-align: center;\">\r\n<a href=3D\"http://l=\r\nocalhost\" style=3D\"box-sizing: border-box; font-family: -apple-system, Blin=\r\nkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Co=\r\nlor Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; color:=\r\n #3d4852; font-size: 19px; font-weight: bold; text-decoration: none; displa=\r\ny: inline-block;\">\r\nTourMate\r\n</a>\r\n</td>\r\n</tr>\r\n\r\n<!-- Email Body -=\r\n->\r\n<tr>\r\n<td class=3D\"body\" width=3D\"100%\" cellpadding=3D\"0\" cellspacing=\r\n=3D\"0\" style=3D\"box-sizing: border-box; font-family: -apple-system, BlinkMa=\r\ncSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color=\r\n Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; -premaile=\r\nr-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%; backgr=\r\nound-color: #edf2f7; border-bottom: 1px solid #edf2f7; border-top: 1px soli=\r\nd #edf2f7; margin: 0; padding: 0; width: 100%;\">\r\n<table class=3D\"inner-bo=\r\ndy\" align=3D\"center\" width=3D\"570\" cellpadding=3D\"0\" cellspacing=3D\"0\" role=\r\n=3D\"presentation\" style=3D\"box-sizing: border-box; font-family: -apple-syst=\r\nem, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'=\r\nApple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative=\r\n; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 5=\r\n70px; background-color: #ffffff; border-color: #e8e5ef; border-radius: 2px;=\r\n border-width: 1px; box-shadow: 0 2px 0 rgba(0, 0, 150, 0.025), 2px 4px 0 r=\r\ngba(0, 0, 150, 0.015); margin: 0 auto; padding: 0; width: 570px;\">\r\n<!-- B=\r\nody content -->\r\n<tr>\r\n<td class=3D\"content-cell\" style=3D\"box-sizing: bo=\r\nrder-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Robot=\r\no, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Se=\r\ngoe UI Symbol\'; position: relative; max-width: 100vw; padding: 32px;\">\r\n<h=\r\n1 style=3D\"box-sizing: border-box; font-family: -apple-system, BlinkMacSyst=\r\nemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoj=\r\ni\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; color: #3d4852=\r\n; font-size: 18px; font-weight: bold; margin-top: 0; text-align: left;\">Hel=\r\nlojohnpaul84!</h1>\r\n<p style=3D\"box-sizing: border-box; font-family: -appl=\r\ne-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-se=\r\nrif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: re=\r\nlative; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: lef=\r\nt;\">Your booking request has been successfully Approved</p>\r\n<p style=3D\"b=\r\nox-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Seg=\r\noe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe U=\r\nI Emoji\', \'Segoe UI Symbol\'; position: relative; font-size: 16px; line-heig=\r\nht: 1.5em; margin-top: 0; text-align: left;\">Thank you for using our applic=\r\nation!</p>\r\n<!-- Salutation -->\r\n<p style=3D\"box-sizing: border-box; font=\r\n-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, =\r\nArial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'=\r\n; position: relative; font-size: 16px; line-height: 1.5em; margin-top: 0; t=\r\next-align: left;\">Regards,<br>TourMate</p>\r\n<!-- Subcopy -->\r\n\r\n\r\n\r\n</=\r\ntd>\r\n</tr>\r\n</table>\r\n</td>\r\n</tr>\r\n\r\n<tr>\r\n<td style=3D\"box-sizing:=\r\n border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Ro=\r\nboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', =\r\n\'Segoe UI Symbol\'; position: relative;\">\r\n<table class=3D\"footer\" align=3D=\r\n\"center\" width=3D\"570\" cellpadding=3D\"0\" cellspacing=3D\"0\" role=3D\"presenta=\r\ntion\" style=3D\"box-sizing: border-box; font-family: -apple-system, BlinkMac=\r\nSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color =\r\nEmoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; -premailer=\r\n-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 570px; margin=\r\n: 0 auto; padding: 0; text-align: center; width: 570px;\">\r\n<tr>\r\n<td clas=\r\ns=3D\"content-cell\" align=3D\"center\" style=3D\"box-sizing: border-box; font-f=\r\namily: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Ar=\r\nial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; =\r\nposition: relative; max-width: 100vw; padding: 32px;\">\r\n<p style=3D\"box-si=\r\nzing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI=\r\n\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emo=\r\nji\', \'Segoe UI Symbol\'; position: relative; line-height: 1.5em; margin-top:=\r\n 0; color: #b0adc5; font-size: 12px; text-align: center;\">=C2=A9 2025 TourM=\r\nate. All rights reserved.</p>\r\n\r\n</td>\r\n</tr>\r\n</table>\r\n</td>\r\n</tr>=\r\n\r\n</table>\r\n</td>\r\n</tr>\r\n</table>\r\n</body>\r\n</html>\r\n--a5h3K8eW--\r\n', 'From: TourMate <tourmate@example.com>\r\nTo: user@user.com\r\nSubject: Booking Approved Confirmation\r\n', NULL);
INSERT INTO `email_log` (`id`, `date`, `from`, `to`, `cc`, `bcc`, `subject`, `body`, `headers`, `attachments`) VALUES
(8, '2025-10-13 23:20:41', 'TourMate <tourmate@example.com>', 'user@user.com', NULL, NULL, 'Booking Approved Confirmation', '--kUKxmALz\r\nContent-Type: text/plain; charset=utf-8\r\nContent-Transfer-Encoding: quoted-printable\r\n\r\n[TourMate](http://localhost)\r\n\r\n# Hellojohnpaul84!\r\n\r\nYour booking requ=\r\nest has been successfully Approved\r\n\r\nThank you for using our application=\r\n!\r\n\r\nRegards,TourMate\r\n\r\n=C2=A9 2025 TourMate. All rights reserved.\r\n\r\n--kUKxmALz\r\nContent-Type: text/html; charset=utf-8\r\nContent-Transfer-Encoding: quoted-printable\r\n\r\n<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.=\r\nw3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\r\n<html xmlns=3D\"http://www.=\r\nw3.org/1999/xhtml\">\r\n<head>\r\n<meta name=3D\"viewport\" content=3D\"width=3Dd=\r\nevice-width, initial-scale=3D1.0\">\r\n<meta http-equiv=3D\"Content-Type\" cont=\r\nent=3D\"text/html; charset=3DUTF-8\">\r\n</head>\r\n<body style=3D\"box-sizing: =\r\nborder-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Rob=\r\noto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'=\r\nSegoe UI Symbol\'; position: relative; -webkit-text-size-adjust: none; backg=\r\nround-color: #ffffff; color: #718096; height: 100%; line-height: 1.4; margi=\r\nn: 0; padding: 0; width: 100% !important;\">\r\n<style>\r\n@media only screen =\r\nand (max-width: 600px) {\r\n.inner-body {\r\nwidth: 100% !important;\r\n}\r\n=\r\n\r\n.footer {\r\nwidth: 100% !important;\r\n}\r\n}\r\n\r\n@media only screen and =\r\n(max-width: 500px) {\r\n.button {\r\nwidth: 100% !important;\r\n}\r\n}\r\n</styl=\r\ne>\r\n\r\n<table class=3D\"wrapper\" width=3D\"100%\" cellpadding=3D\"0\" cellspaci=\r\nng=3D\"0\" role=3D\"presentation\" style=3D\"box-sizing: border-box; font-family=\r\n: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, =\r\nsans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; posit=\r\nion: relative; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -prema=\r\niler-width: 100%; background-color: #edf2f7; margin: 0; padding: 0; width: =\r\n100%;\">\r\n<tr>\r\n<td align=3D\"center\" style=3D\"box-sizing: border-box; font=\r\n-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, =\r\nArial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'=\r\n; position: relative;\">\r\n<table class=3D\"content\" width=3D\"100%\" cellpaddi=\r\nng=3D\"0\" cellspacing=3D\"0\" role=3D\"presentation\" style=3D\"box-sizing: borde=\r\nr-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, =\r\nHelvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe=\r\n UI Symbol\'; position: relative; -premailer-cellpadding: 0; -premailer-cell=\r\nspacing: 0; -premailer-width: 100%; margin: 0; padding: 0; width: 100%;\">=\r\n\r\n<tr>\r\n<td class=3D\"header\" style=3D\"box-sizing: border-box; font-family=\r\n: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, =\r\nsans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; posit=\r\nion: relative; padding: 25px 0; text-align: center;\">\r\n<a href=3D\"http://l=\r\nocalhost\" style=3D\"box-sizing: border-box; font-family: -apple-system, Blin=\r\nkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Co=\r\nlor Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; color:=\r\n #3d4852; font-size: 19px; font-weight: bold; text-decoration: none; displa=\r\ny: inline-block;\">\r\nTourMate\r\n</a>\r\n</td>\r\n</tr>\r\n\r\n<!-- Email Body -=\r\n->\r\n<tr>\r\n<td class=3D\"body\" width=3D\"100%\" cellpadding=3D\"0\" cellspacing=\r\n=3D\"0\" style=3D\"box-sizing: border-box; font-family: -apple-system, BlinkMa=\r\ncSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color=\r\n Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; -premaile=\r\nr-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%; backgr=\r\nound-color: #edf2f7; border-bottom: 1px solid #edf2f7; border-top: 1px soli=\r\nd #edf2f7; margin: 0; padding: 0; width: 100%;\">\r\n<table class=3D\"inner-bo=\r\ndy\" align=3D\"center\" width=3D\"570\" cellpadding=3D\"0\" cellspacing=3D\"0\" role=\r\n=3D\"presentation\" style=3D\"box-sizing: border-box; font-family: -apple-syst=\r\nem, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'=\r\nApple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative=\r\n; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 5=\r\n70px; background-color: #ffffff; border-color: #e8e5ef; border-radius: 2px;=\r\n border-width: 1px; box-shadow: 0 2px 0 rgba(0, 0, 150, 0.025), 2px 4px 0 r=\r\ngba(0, 0, 150, 0.015); margin: 0 auto; padding: 0; width: 570px;\">\r\n<!-- B=\r\nody content -->\r\n<tr>\r\n<td class=3D\"content-cell\" style=3D\"box-sizing: bo=\r\nrder-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Robot=\r\no, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Se=\r\ngoe UI Symbol\'; position: relative; max-width: 100vw; padding: 32px;\">\r\n<h=\r\n1 style=3D\"box-sizing: border-box; font-family: -apple-system, BlinkMacSyst=\r\nemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoj=\r\ni\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; color: #3d4852=\r\n; font-size: 18px; font-weight: bold; margin-top: 0; text-align: left;\">Hel=\r\nlojohnpaul84!</h1>\r\n<p style=3D\"box-sizing: border-box; font-family: -appl=\r\ne-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-se=\r\nrif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: re=\r\nlative; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: lef=\r\nt;\">Your booking request has been successfully Approved</p>\r\n<p style=3D\"b=\r\nox-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Seg=\r\noe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe U=\r\nI Emoji\', \'Segoe UI Symbol\'; position: relative; font-size: 16px; line-heig=\r\nht: 1.5em; margin-top: 0; text-align: left;\">Thank you for using our applic=\r\nation!</p>\r\n<!-- Salutation -->\r\n<p style=3D\"box-sizing: border-box; font=\r\n-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, =\r\nArial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'=\r\n; position: relative; font-size: 16px; line-height: 1.5em; margin-top: 0; t=\r\next-align: left;\">Regards,<br>TourMate</p>\r\n<!-- Subcopy -->\r\n\r\n\r\n\r\n</=\r\ntd>\r\n</tr>\r\n</table>\r\n</td>\r\n</tr>\r\n\r\n<tr>\r\n<td style=3D\"box-sizing:=\r\n border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Ro=\r\nboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', =\r\n\'Segoe UI Symbol\'; position: relative;\">\r\n<table class=3D\"footer\" align=3D=\r\n\"center\" width=3D\"570\" cellpadding=3D\"0\" cellspacing=3D\"0\" role=3D\"presenta=\r\ntion\" style=3D\"box-sizing: border-box; font-family: -apple-system, BlinkMac=\r\nSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color =\r\nEmoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; -premailer=\r\n-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 570px; margin=\r\n: 0 auto; padding: 0; text-align: center; width: 570px;\">\r\n<tr>\r\n<td clas=\r\ns=3D\"content-cell\" align=3D\"center\" style=3D\"box-sizing: border-box; font-f=\r\namily: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Ar=\r\nial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; =\r\nposition: relative; max-width: 100vw; padding: 32px;\">\r\n<p style=3D\"box-si=\r\nzing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI=\r\n\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emo=\r\nji\', \'Segoe UI Symbol\'; position: relative; line-height: 1.5em; margin-top:=\r\n 0; color: #b0adc5; font-size: 12px; text-align: center;\">=C2=A9 2025 TourM=\r\nate. All rights reserved.</p>\r\n\r\n</td>\r\n</tr>\r\n</table>\r\n</td>\r\n</tr>=\r\n\r\n</table>\r\n</td>\r\n</tr>\r\n</table>\r\n</body>\r\n</html>\r\n--kUKxmALz--\r\n', 'From: TourMate <tourmate@example.com>\r\nTo: user@user.com\r\nSubject: Booking Approved Confirmation\r\n', NULL),
(9, '2025-10-22 17:58:42', 'MyLiveJourney <tourmate@example.com>', 'gamal333re@gmail.com', NULL, NULL, 'Activation required', '--twlsmHgF\r\nContent-Type: text/plain; charset=utf-8\r\nContent-Transfer-Encoding: quoted-printable\r\n\r\n[MyLiveJourney](http://localhost)\r\n\r\n# Welcome!\r\n\r\nYou need to activate=\r\n your email before you can start using all of our services.\r\n\r\nActivate: =\r\nhttp://127.0.0.1:8000/activate/WLtpmOAzjjpCdJwZw2gZ32kT7aXRvmxGeoWF9SfZNSfT=\r\nd1aQOu3P5re5cIGtgA2m\r\n\r\nThank you for using our application!\r\n\r\nRegards=\r\n,MyLiveJourney\r\n\r\nIf you=E2=80=99re having trouble clicking the \"Activate=\r\n\" button, copy and paste the URL below\r\ninto your web browser: [http://127=\r\n.0.0.1:8000/activate/WLtpmOAzjjpCdJwZw2gZ32kT7aXRvmxGeoWF9SfZNSfTd1aQOu3P5r=\r\ne5cIGtgA2m](http://127.0.0.1:8000/activate/WLtpmOAzjjpCdJwZw2gZ32kT7aXRvmxG=\r\neoWF9SfZNSfTd1aQOu3P5re5cIGtgA2m)\r\n\r\n=C2=A9 2025 MyLiveJourney. All right=\r\ns reserved.\r\n\r\n--twlsmHgF\r\nContent-Type: text/html; charset=utf-8\r\nContent-Transfer-Encoding: quoted-printable\r\n\r\n<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.=\r\nw3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\r\n<html xmlns=3D\"http://www.=\r\nw3.org/1999/xhtml\">\r\n<head>\r\n<meta name=3D\"viewport\" content=3D\"width=3Dd=\r\nevice-width, initial-scale=3D1.0\">\r\n<meta http-equiv=3D\"Content-Type\" cont=\r\nent=3D\"text/html; charset=3DUTF-8\">\r\n</head>\r\n<body style=3D\"box-sizing: =\r\nborder-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Rob=\r\noto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'=\r\nSegoe UI Symbol\'; position: relative; -webkit-text-size-adjust: none; backg=\r\nround-color: #ffffff; color: #718096; height: 100%; line-height: 1.4; margi=\r\nn: 0; padding: 0; width: 100% !important;\">\r\n<style>\r\n@media only screen =\r\nand (max-width: 600px) {\r\n.inner-body {\r\nwidth: 100% !important;\r\n}\r\n=\r\n\r\n.footer {\r\nwidth: 100% !important;\r\n}\r\n}\r\n\r\n@media only screen and =\r\n(max-width: 500px) {\r\n.button {\r\nwidth: 100% !important;\r\n}\r\n}\r\n</styl=\r\ne>\r\n\r\n<table class=3D\"wrapper\" width=3D\"100%\" cellpadding=3D\"0\" cellspaci=\r\nng=3D\"0\" role=3D\"presentation\" style=3D\"box-sizing: border-box; font-family=\r\n: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, =\r\nsans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; posit=\r\nion: relative; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -prema=\r\niler-width: 100%; background-color: #edf2f7; margin: 0; padding: 0; width: =\r\n100%;\">\r\n<tr>\r\n<td align=3D\"center\" style=3D\"box-sizing: border-box; font=\r\n-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, =\r\nArial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'=\r\n; position: relative;\">\r\n<table class=3D\"content\" width=3D\"100%\" cellpaddi=\r\nng=3D\"0\" cellspacing=3D\"0\" role=3D\"presentation\" style=3D\"box-sizing: borde=\r\nr-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, =\r\nHelvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe=\r\n UI Symbol\'; position: relative; -premailer-cellpadding: 0; -premailer-cell=\r\nspacing: 0; -premailer-width: 100%; margin: 0; padding: 0; width: 100%;\">=\r\n\r\n<tr>\r\n<td class=3D\"header\" style=3D\"box-sizing: border-box; font-family=\r\n: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, =\r\nsans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; posit=\r\nion: relative; padding: 25px 0; text-align: center;\">\r\n<a href=3D\"http://l=\r\nocalhost\" style=3D\"box-sizing: border-box; font-family: -apple-system, Blin=\r\nkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Co=\r\nlor Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; color:=\r\n #3d4852; font-size: 19px; font-weight: bold; text-decoration: none; displa=\r\ny: inline-block;\">\r\nMyLiveJourney\r\n</a>\r\n</td>\r\n</tr>\r\n\r\n<!-- Email B=\r\nody -->\r\n<tr>\r\n<td class=3D\"body\" width=3D\"100%\" cellpadding=3D\"0\" cellsp=\r\nacing=3D\"0\" style=3D\"box-sizing: border-box; font-family: -apple-system, Bl=\r\ninkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple =\r\nColor Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; -pre=\r\nmailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%; b=\r\nackground-color: #edf2f7; border-bottom: 1px solid #edf2f7; border-top: 1px=\r\n solid #edf2f7; margin: 0; padding: 0; width: 100%;\">\r\n<table class=3D\"inn=\r\ner-body\" align=3D\"center\" width=3D\"570\" cellpadding=3D\"0\" cellspacing=3D\"0\"=\r\n role=3D\"presentation\" style=3D\"box-sizing: border-box; font-family: -apple=\r\n-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-ser=\r\nif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: rel=\r\native; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-wid=\r\nth: 570px; background-color: #ffffff; border-color: #e8e5ef; border-radius:=\r\n 2px; border-width: 1px; box-shadow: 0 2px 0 rgba(0, 0, 150, 0.025), 2px 4p=\r\nx 0 rgba(0, 0, 150, 0.015); margin: 0 auto; padding: 0; width: 570px;\">\r\n<=\r\n!-- Body content -->\r\n<tr>\r\n<td class=3D\"content-cell\" style=3D\"box-sizin=\r\ng: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', =\r\nRoboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\'=\r\n, \'Segoe UI Symbol\'; position: relative; max-width: 100vw; padding: 32px;\">=\r\n\r\n<h1 style=3D\"box-sizing: border-box; font-family: -apple-system, BlinkMa=\r\ncSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color=\r\n Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; color: #3=\r\nd4852; font-size: 18px; font-weight: bold; margin-top: 0; text-align: left;=\r\n\">Welcome!</h1>\r\n<p style=3D\"box-sizing: border-box; font-family: -apple-s=\r\nystem, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif=\r\n, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relat=\r\nive; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;\"=\r\n>You need to activate your email before you can start using all of our serv=\r\nices.</p>\r\n<table class=3D\"action\" align=3D\"center\" width=3D\"100%\" cellpad=\r\nding=3D\"0\" cellspacing=3D\"0\" role=3D\"presentation\" style=3D\"box-sizing: bor=\r\nder-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto=\r\n, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Seg=\r\noe UI Symbol\'; position: relative; -premailer-cellpadding: 0; -premailer-ce=\r\nllspacing: 0; -premailer-width: 100%; margin: 30px auto; padding: 0; text-a=\r\nlign: center; width: 100%;\">\r\n<tr>\r\n<td align=3D\"center\" style=3D\"box-siz=\r\ning: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\'=\r\n, Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoj=\r\ni\', \'Segoe UI Symbol\'; position: relative;\">\r\n<table width=3D\"100%\" border=\r\n=3D\"0\" cellpadding=3D\"0\" cellspacing=3D\"0\" role=3D\"presentation\" style=3D\"b=\r\nox-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Seg=\r\noe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe U=\r\nI Emoji\', \'Segoe UI Symbol\'; position: relative;\">\r\n<tr>\r\n<td align=3D\"ce=\r\nnter\" style=3D\"box-sizing: border-box; font-family: -apple-system, BlinkMac=\r\nSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color =\r\nEmoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative;\">\r\n<table=\r\n border=3D\"0\" cellpadding=3D\"0\" cellspacing=3D\"0\" role=3D\"presentation\" sty=\r\nle=3D\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFon=\r\nt, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'=\r\nSegoe UI Emoji\', \'Segoe UI Symbol\'; position: relative;\">\r\n<tr>\r\n<td styl=\r\ne=3D\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont=\r\n, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'S=\r\negoe UI Emoji\', \'Segoe UI Symbol\'; position: relative;\">\r\n<a href=3D\"http:=\r\n//127.0.0.1:8000/activate/WLtpmOAzjjpCdJwZw2gZ32kT7aXRvmxGeoWF9SfZNSfTd1aQO=\r\nu3P5re5cIGtgA2m\" class=3D\"button button-blue\" target=3D\"_blank\" rel=3D\"noop=\r\nener\" style=3D\"box-sizing: border-box; font-family: -apple-system, BlinkMac=\r\nSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color =\r\nEmoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; -webkit-te=\r\nxt-size-adjust: none; border-radius: 4px; color: #fff; display: inline-bloc=\r\nk; overflow: hidden; text-decoration: none; background-color: #2d3748; bord=\r\ner-bottom: 8px solid #2d3748; border-left: 18px solid #2d3748; border-right=\r\n: 18px solid #2d3748; border-top: 8px solid #2d3748;\">Activate</a>\r\n</td>=\r\n\r\n</tr>\r\n</table>\r\n</td>\r\n</tr>\r\n</table>\r\n</td>\r\n</tr>\r\n</table>=\r\n\r\n<p style=3D\"box-sizing: border-box; font-family: -apple-system, BlinkMac=\r\nSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color =\r\nEmoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; font-size:=\r\n 16px; line-height: 1.5em; margin-top: 0; text-align: left;\">Thank you for =\r\nusing our application!</p>\r\n<!-- Salutation -->\r\n<p style=3D\"box-sizing: =\r\nborder-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Rob=\r\noto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'=\r\nSegoe UI Symbol\'; position: relative; font-size: 16px; line-height: 1.5em; =\r\nmargin-top: 0; text-align: left;\">Regards,<br>MyLiveJourney</p>\r\n<!-- Subc=\r\nopy -->\r\n<table class=3D\"subcopy\" width=3D\"100%\" cellpadding=3D\"0\" cellspa=\r\ncing=3D\"0\" role=3D\"presentation\" style=3D\"box-sizing: border-box; font-fami=\r\nly: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial=\r\n, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; pos=\r\nition: relative; border-top: 1px solid #e8e5ef; margin-top: 25px; padding-t=\r\nop: 25px;\">\r\n<tr>\r\n<td style=3D\"box-sizing: border-box; font-family: -app=\r\nle-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-s=\r\nerif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: r=\r\nelative;\">\r\n<p style=3D\"box-sizing: border-box; font-family: -apple-system=\r\n, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Ap=\r\nple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; =\r\nline-height: 1.5em; margin-top: 0; text-align: left; font-size: 14px;\">If y=\r\nou=E2=80=99re having trouble clicking the \"Activate\" button, copy and paste=\r\n the URL below\r\ninto your web browser: <a href=3D\"http://127.0.0.1:8000/ac=\r\ntivate/WLtpmOAzjjpCdJwZw2gZ32kT7aXRvmxGeoWF9SfZNSfTd1aQOu3P5re5cIGtgA2m\" st=\r\nyle=3D\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFo=\r\nnt, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', =\r\n\'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; color: #3869d4;\">h=\r\nttp://127.0.0.1:8000/activate/WLtpmOAzjjpCdJwZw2gZ32kT7aXRvmxGeoWF9SfZNSfTd=\r\n1aQOu3P5re5cIGtgA2m</a></p>\r\n</td>\r\n</tr>\r\n</table>\r\n\r\n\r\n\r\n</td>\r\n<=\r\n/tr>\r\n</table>\r\n</td>\r\n</tr>\r\n\r\n<tr>\r\n<td style=3D\"box-sizing: border=\r\n-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, H=\r\nelvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe =\r\nUI Symbol\'; position: relative;\">\r\n<table class=3D\"footer\" align=3D\"center=\r\n\" width=3D\"570\" cellpadding=3D\"0\" cellspacing=3D\"0\" role=3D\"presentation\" s=\r\ntyle=3D\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemF=\r\nont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\',=\r\n \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; -premailer-cellpa=\r\ndding: 0; -premailer-cellspacing: 0; -premailer-width: 570px; margin: 0 aut=\r\no; padding: 0; text-align: center; width: 570px;\">\r\n<tr>\r\n<td class=3D\"co=\r\nntent-cell\" align=3D\"center\" style=3D\"box-sizing: border-box; font-family: =\r\n-apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sa=\r\nns-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; positio=\r\nn: relative; max-width: 100vw; padding: 32px;\">\r\n<p style=3D\"box-sizing: b=\r\norder-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Robo=\r\nto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'S=\r\negoe UI Symbol\'; position: relative; line-height: 1.5em; margin-top: 0; col=\r\nor: #b0adc5; font-size: 12px; text-align: center;\">=C2=A9 2025 MyLiveJourne=\r\ny. All rights reserved.</p>\r\n\r\n</td>\r\n</tr>\r\n</table>\r\n</td>\r\n</tr>=\r\n\r\n</table>\r\n</td>\r\n</tr>\r\n</table>\r\n</body>\r\n</html>\r\n--twlsmHgF--\r\n', 'From: MyLiveJourney <tourmate@example.com>\r\nTo: gamal333re@gmail.com\r\nSubject: Activation required\r\n', NULL),
(10, '2025-10-25 17:42:26', 'MyLiveJourney <tourmate@example.com>', 'user@user.com', NULL, NULL, 'Booking Approved Confirmation', '--dz7kotlo\r\nContent-Type: text/plain; charset=utf-8\r\nContent-Transfer-Encoding: quoted-printable\r\n\r\n[MyLiveJourney](http://localhost)\r\n\r\n# Hellojohnpaul84!\r\n\r\nYour booking=\r\n request has been successfully Approved\r\n\r\nThank you for using our applic=\r\nation!\r\n\r\nRegards,MyLiveJourney\r\n\r\n=C2=A9 2025 MyLiveJourney. All right=\r\ns reserved.\r\n\r\n--dz7kotlo\r\nContent-Type: text/html; charset=utf-8\r\nContent-Transfer-Encoding: quoted-printable\r\n\r\n<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.=\r\nw3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\r\n<html xmlns=3D\"http://www.=\r\nw3.org/1999/xhtml\">\r\n<head>\r\n<meta name=3D\"viewport\" content=3D\"width=3Dd=\r\nevice-width, initial-scale=3D1.0\">\r\n<meta http-equiv=3D\"Content-Type\" cont=\r\nent=3D\"text/html; charset=3DUTF-8\">\r\n</head>\r\n<body style=3D\"box-sizing: =\r\nborder-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Rob=\r\noto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'=\r\nSegoe UI Symbol\'; position: relative; -webkit-text-size-adjust: none; backg=\r\nround-color: #ffffff; color: #718096; height: 100%; line-height: 1.4; margi=\r\nn: 0; padding: 0; width: 100% !important;\">\r\n<style>\r\n@media only screen =\r\nand (max-width: 600px) {\r\n.inner-body {\r\nwidth: 100% !important;\r\n}\r\n=\r\n\r\n.footer {\r\nwidth: 100% !important;\r\n}\r\n}\r\n\r\n@media only screen and =\r\n(max-width: 500px) {\r\n.button {\r\nwidth: 100% !important;\r\n}\r\n}\r\n</styl=\r\ne>\r\n\r\n<table class=3D\"wrapper\" width=3D\"100%\" cellpadding=3D\"0\" cellspaci=\r\nng=3D\"0\" role=3D\"presentation\" style=3D\"box-sizing: border-box; font-family=\r\n: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, =\r\nsans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; posit=\r\nion: relative; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -prema=\r\niler-width: 100%; background-color: #edf2f7; margin: 0; padding: 0; width: =\r\n100%;\">\r\n<tr>\r\n<td align=3D\"center\" style=3D\"box-sizing: border-box; font=\r\n-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, =\r\nArial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'=\r\n; position: relative;\">\r\n<table class=3D\"content\" width=3D\"100%\" cellpaddi=\r\nng=3D\"0\" cellspacing=3D\"0\" role=3D\"presentation\" style=3D\"box-sizing: borde=\r\nr-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, =\r\nHelvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe=\r\n UI Symbol\'; position: relative; -premailer-cellpadding: 0; -premailer-cell=\r\nspacing: 0; -premailer-width: 100%; margin: 0; padding: 0; width: 100%;\">=\r\n\r\n<tr>\r\n<td class=3D\"header\" style=3D\"box-sizing: border-box; font-family=\r\n: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, =\r\nsans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; posit=\r\nion: relative; padding: 25px 0; text-align: center;\">\r\n<a href=3D\"http://l=\r\nocalhost\" style=3D\"box-sizing: border-box; font-family: -apple-system, Blin=\r\nkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Co=\r\nlor Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; color:=\r\n #3d4852; font-size: 19px; font-weight: bold; text-decoration: none; displa=\r\ny: inline-block;\">\r\nMyLiveJourney\r\n</a>\r\n</td>\r\n</tr>\r\n\r\n<!-- Email B=\r\nody -->\r\n<tr>\r\n<td class=3D\"body\" width=3D\"100%\" cellpadding=3D\"0\" cellsp=\r\nacing=3D\"0\" style=3D\"box-sizing: border-box; font-family: -apple-system, Bl=\r\ninkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple =\r\nColor Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; -pre=\r\nmailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%; b=\r\nackground-color: #edf2f7; border-bottom: 1px solid #edf2f7; border-top: 1px=\r\n solid #edf2f7; margin: 0; padding: 0; width: 100%;\">\r\n<table class=3D\"inn=\r\ner-body\" align=3D\"center\" width=3D\"570\" cellpadding=3D\"0\" cellspacing=3D\"0\"=\r\n role=3D\"presentation\" style=3D\"box-sizing: border-box; font-family: -apple=\r\n-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-ser=\r\nif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: rel=\r\native; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-wid=\r\nth: 570px; background-color: #ffffff; border-color: #e8e5ef; border-radius:=\r\n 2px; border-width: 1px; box-shadow: 0 2px 0 rgba(0, 0, 150, 0.025), 2px 4p=\r\nx 0 rgba(0, 0, 150, 0.015); margin: 0 auto; padding: 0; width: 570px;\">\r\n<=\r\n!-- Body content -->\r\n<tr>\r\n<td class=3D\"content-cell\" style=3D\"box-sizin=\r\ng: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', =\r\nRoboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\'=\r\n, \'Segoe UI Symbol\'; position: relative; max-width: 100vw; padding: 32px;\">=\r\n\r\n<h1 style=3D\"box-sizing: border-box; font-family: -apple-system, BlinkMa=\r\ncSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color=\r\n Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; color: #3=\r\nd4852; font-size: 18px; font-weight: bold; margin-top: 0; text-align: left;=\r\n\">Hellojohnpaul84!</h1>\r\n<p style=3D\"box-sizing: border-box; font-family: =\r\n-apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sa=\r\nns-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; positio=\r\nn: relative; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align=\r\n: left;\">Your booking request has been successfully Approved</p>\r\n<p style=\r\n=3D\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont,=\r\n \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Se=\r\ngoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; font-size: 16px; line=\r\n-height: 1.5em; margin-top: 0; text-align: left;\">Thank you for using our a=\r\npplication!</p>\r\n<!-- Salutation -->\r\n<p style=3D\"box-sizing: border-box;=\r\n font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvet=\r\nica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Sy=\r\nmbol\'; position: relative; font-size: 16px; line-height: 1.5em; margin-top:=\r\n 0; text-align: left;\">Regards,<br>MyLiveJourney</p>\r\n<!-- Subcopy -->\r\n=\r\n\r\n\r\n\r\n</td>\r\n</tr>\r\n</table>\r\n</td>\r\n</tr>\r\n\r\n<tr>\r\n<td style=3D\"=\r\nbox-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Se=\r\ngoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe =\r\nUI Emoji\', \'Segoe UI Symbol\'; position: relative;\">\r\n<table class=3D\"foote=\r\nr\" align=3D\"center\" width=3D\"570\" cellpadding=3D\"0\" cellspacing=3D\"0\" role=\r\n=3D\"presentation\" style=3D\"box-sizing: border-box; font-family: -apple-syst=\r\nem, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'=\r\nApple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative=\r\n; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 5=\r\n70px; margin: 0 auto; padding: 0; text-align: center; width: 570px;\">\r\n<tr=\r\n>\r\n<td class=3D\"content-cell\" align=3D\"center\" style=3D\"box-sizing: border=\r\n-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, H=\r\nelvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe =\r\nUI Symbol\'; position: relative; max-width: 100vw; padding: 32px;\">\r\n<p sty=\r\nle=3D\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFon=\r\nt, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'=\r\nSegoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; line-height: 1.5em;=\r\n margin-top: 0; color: #b0adc5; font-size: 12px; text-align: center;\">=\r\n=C2=A9 2025 MyLiveJourney. All rights reserved.</p>\r\n\r\n</td>\r\n</tr>\r\n</=\r\ntable>\r\n</td>\r\n</tr>\r\n</table>\r\n</td>\r\n</tr>\r\n</table>\r\n</body>\r\n</=\r\nhtml>\r\n--dz7kotlo--\r\n', 'From: MyLiveJourney <tourmate@example.com>\r\nTo: user@user.com\r\nSubject: Booking Approved Confirmation\r\n', NULL),
(11, '2025-10-25 19:38:59', 'MyLiveJourney <tourmate@example.com>', 'user@user.com', NULL, NULL, 'Booking Approved Confirmation', '--9HQfk9Du\r\nContent-Type: text/plain; charset=utf-8\r\nContent-Transfer-Encoding: quoted-printable\r\n\r\n[MyLiveJourney](http://localhost)\r\n\r\n# Hellojohnpaul84!\r\n\r\nYour booking=\r\n request has been successfully Approved\r\n\r\nThank you for using our applic=\r\nation!\r\n\r\nRegards,MyLiveJourney\r\n\r\n=C2=A9 2025 MyLiveJourney. All right=\r\ns reserved.\r\n\r\n--9HQfk9Du\r\nContent-Type: text/html; charset=utf-8\r\nContent-Transfer-Encoding: quoted-printable\r\n\r\n<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.=\r\nw3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\r\n<html xmlns=3D\"http://www.=\r\nw3.org/1999/xhtml\">\r\n<head>\r\n<meta name=3D\"viewport\" content=3D\"width=3Dd=\r\nevice-width, initial-scale=3D1.0\">\r\n<meta http-equiv=3D\"Content-Type\" cont=\r\nent=3D\"text/html; charset=3DUTF-8\">\r\n</head>\r\n<body style=3D\"box-sizing: =\r\nborder-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Rob=\r\noto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'=\r\nSegoe UI Symbol\'; position: relative; -webkit-text-size-adjust: none; backg=\r\nround-color: #ffffff; color: #718096; height: 100%; line-height: 1.4; margi=\r\nn: 0; padding: 0; width: 100% !important;\">\r\n<style>\r\n@media only screen =\r\nand (max-width: 600px) {\r\n.inner-body {\r\nwidth: 100% !important;\r\n}\r\n=\r\n\r\n.footer {\r\nwidth: 100% !important;\r\n}\r\n}\r\n\r\n@media only screen and =\r\n(max-width: 500px) {\r\n.button {\r\nwidth: 100% !important;\r\n}\r\n}\r\n</styl=\r\ne>\r\n\r\n<table class=3D\"wrapper\" width=3D\"100%\" cellpadding=3D\"0\" cellspaci=\r\nng=3D\"0\" role=3D\"presentation\" style=3D\"box-sizing: border-box; font-family=\r\n: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, =\r\nsans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; posit=\r\nion: relative; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -prema=\r\niler-width: 100%; background-color: #edf2f7; margin: 0; padding: 0; width: =\r\n100%;\">\r\n<tr>\r\n<td align=3D\"center\" style=3D\"box-sizing: border-box; font=\r\n-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, =\r\nArial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'=\r\n; position: relative;\">\r\n<table class=3D\"content\" width=3D\"100%\" cellpaddi=\r\nng=3D\"0\" cellspacing=3D\"0\" role=3D\"presentation\" style=3D\"box-sizing: borde=\r\nr-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, =\r\nHelvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe=\r\n UI Symbol\'; position: relative; -premailer-cellpadding: 0; -premailer-cell=\r\nspacing: 0; -premailer-width: 100%; margin: 0; padding: 0; width: 100%;\">=\r\n\r\n<tr>\r\n<td class=3D\"header\" style=3D\"box-sizing: border-box; font-family=\r\n: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, =\r\nsans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; posit=\r\nion: relative; padding: 25px 0; text-align: center;\">\r\n<a href=3D\"http://l=\r\nocalhost\" style=3D\"box-sizing: border-box; font-family: -apple-system, Blin=\r\nkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Co=\r\nlor Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; color:=\r\n #3d4852; font-size: 19px; font-weight: bold; text-decoration: none; displa=\r\ny: inline-block;\">\r\nMyLiveJourney\r\n</a>\r\n</td>\r\n</tr>\r\n\r\n<!-- Email B=\r\nody -->\r\n<tr>\r\n<td class=3D\"body\" width=3D\"100%\" cellpadding=3D\"0\" cellsp=\r\nacing=3D\"0\" style=3D\"box-sizing: border-box; font-family: -apple-system, Bl=\r\ninkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple =\r\nColor Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; -pre=\r\nmailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%; b=\r\nackground-color: #edf2f7; border-bottom: 1px solid #edf2f7; border-top: 1px=\r\n solid #edf2f7; margin: 0; padding: 0; width: 100%;\">\r\n<table class=3D\"inn=\r\ner-body\" align=3D\"center\" width=3D\"570\" cellpadding=3D\"0\" cellspacing=3D\"0\"=\r\n role=3D\"presentation\" style=3D\"box-sizing: border-box; font-family: -apple=\r\n-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-ser=\r\nif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: rel=\r\native; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-wid=\r\nth: 570px; background-color: #ffffff; border-color: #e8e5ef; border-radius:=\r\n 2px; border-width: 1px; box-shadow: 0 2px 0 rgba(0, 0, 150, 0.025), 2px 4p=\r\nx 0 rgba(0, 0, 150, 0.015); margin: 0 auto; padding: 0; width: 570px;\">\r\n<=\r\n!-- Body content -->\r\n<tr>\r\n<td class=3D\"content-cell\" style=3D\"box-sizin=\r\ng: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', =\r\nRoboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\'=\r\n, \'Segoe UI Symbol\'; position: relative; max-width: 100vw; padding: 32px;\">=\r\n\r\n<h1 style=3D\"box-sizing: border-box; font-family: -apple-system, BlinkMa=\r\ncSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color=\r\n Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; color: #3=\r\nd4852; font-size: 18px; font-weight: bold; margin-top: 0; text-align: left;=\r\n\">Hellojohnpaul84!</h1>\r\n<p style=3D\"box-sizing: border-box; font-family: =\r\n-apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sa=\r\nns-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; positio=\r\nn: relative; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align=\r\n: left;\">Your booking request has been successfully Approved</p>\r\n<p style=\r\n=3D\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont,=\r\n \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Se=\r\ngoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; font-size: 16px; line=\r\n-height: 1.5em; margin-top: 0; text-align: left;\">Thank you for using our a=\r\npplication!</p>\r\n<!-- Salutation -->\r\n<p style=3D\"box-sizing: border-box;=\r\n font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvet=\r\nica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Sy=\r\nmbol\'; position: relative; font-size: 16px; line-height: 1.5em; margin-top:=\r\n 0; text-align: left;\">Regards,<br>MyLiveJourney</p>\r\n<!-- Subcopy -->\r\n=\r\n\r\n\r\n\r\n</td>\r\n</tr>\r\n</table>\r\n</td>\r\n</tr>\r\n\r\n<tr>\r\n<td style=3D\"=\r\nbox-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Se=\r\ngoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe =\r\nUI Emoji\', \'Segoe UI Symbol\'; position: relative;\">\r\n<table class=3D\"foote=\r\nr\" align=3D\"center\" width=3D\"570\" cellpadding=3D\"0\" cellspacing=3D\"0\" role=\r\n=3D\"presentation\" style=3D\"box-sizing: border-box; font-family: -apple-syst=\r\nem, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'=\r\nApple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative=\r\n; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 5=\r\n70px; margin: 0 auto; padding: 0; text-align: center; width: 570px;\">\r\n<tr=\r\n>\r\n<td class=3D\"content-cell\" align=3D\"center\" style=3D\"box-sizing: border=\r\n-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, H=\r\nelvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe =\r\nUI Symbol\'; position: relative; max-width: 100vw; padding: 32px;\">\r\n<p sty=\r\nle=3D\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFon=\r\nt, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'=\r\nSegoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; line-height: 1.5em;=\r\n margin-top: 0; color: #b0adc5; font-size: 12px; text-align: center;\">=\r\n=C2=A9 2025 MyLiveJourney. All rights reserved.</p>\r\n\r\n</td>\r\n</tr>\r\n</=\r\ntable>\r\n</td>\r\n</tr>\r\n</table>\r\n</td>\r\n</tr>\r\n</table>\r\n</body>\r\n</=\r\nhtml>\r\n--9HQfk9Du--\r\n', 'From: MyLiveJourney <tourmate@example.com>\r\nTo: user@user.com\r\nSubject: Booking Approved Confirmation\r\n', NULL),
(12, '2025-10-27 18:23:09', 'MyLiveJourney <tourmate@example.com>', 'user@user.com', NULL, NULL, 'Booking Rejected Confirmation', '--kOC3pcWk\r\nContent-Type: text/plain; charset=utf-8\r\nContent-Transfer-Encoding: quoted-printable\r\n\r\n[MyLiveJourney](http://localhost)\r\n\r\n# Hellojohnpaul84!\r\n\r\nYour booking=\r\n request has been rejected.\r\n\r\nThank you for using our application!\r\n\r\n=\r\nRegards,MyLiveJourney\r\n\r\n=C2=A9 2025 MyLiveJourney. All rights reserved.=\r\n\r\n\r\n--kOC3pcWk\r\nContent-Type: text/html; charset=utf-8\r\nContent-Transfer-Encoding: quoted-printable\r\n\r\n<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.=\r\nw3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\r\n<html xmlns=3D\"http://www.=\r\nw3.org/1999/xhtml\">\r\n<head>\r\n<meta name=3D\"viewport\" content=3D\"width=3Dd=\r\nevice-width, initial-scale=3D1.0\">\r\n<meta http-equiv=3D\"Content-Type\" cont=\r\nent=3D\"text/html; charset=3DUTF-8\">\r\n</head>\r\n<body style=3D\"box-sizing: =\r\nborder-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Rob=\r\noto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'=\r\nSegoe UI Symbol\'; position: relative; -webkit-text-size-adjust: none; backg=\r\nround-color: #ffffff; color: #718096; height: 100%; line-height: 1.4; margi=\r\nn: 0; padding: 0; width: 100% !important;\">\r\n<style>\r\n@media only screen =\r\nand (max-width: 600px) {\r\n.inner-body {\r\nwidth: 100% !important;\r\n}\r\n=\r\n\r\n.footer {\r\nwidth: 100% !important;\r\n}\r\n}\r\n\r\n@media only screen and =\r\n(max-width: 500px) {\r\n.button {\r\nwidth: 100% !important;\r\n}\r\n}\r\n</styl=\r\ne>\r\n\r\n<table class=3D\"wrapper\" width=3D\"100%\" cellpadding=3D\"0\" cellspaci=\r\nng=3D\"0\" role=3D\"presentation\" style=3D\"box-sizing: border-box; font-family=\r\n: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, =\r\nsans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; posit=\r\nion: relative; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -prema=\r\niler-width: 100%; background-color: #edf2f7; margin: 0; padding: 0; width: =\r\n100%;\">\r\n<tr>\r\n<td align=3D\"center\" style=3D\"box-sizing: border-box; font=\r\n-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, =\r\nArial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'=\r\n; position: relative;\">\r\n<table class=3D\"content\" width=3D\"100%\" cellpaddi=\r\nng=3D\"0\" cellspacing=3D\"0\" role=3D\"presentation\" style=3D\"box-sizing: borde=\r\nr-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, =\r\nHelvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe=\r\n UI Symbol\'; position: relative; -premailer-cellpadding: 0; -premailer-cell=\r\nspacing: 0; -premailer-width: 100%; margin: 0; padding: 0; width: 100%;\">=\r\n\r\n<tr>\r\n<td class=3D\"header\" style=3D\"box-sizing: border-box; font-family=\r\n: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, =\r\nsans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; posit=\r\nion: relative; padding: 25px 0; text-align: center;\">\r\n<a href=3D\"http://l=\r\nocalhost\" style=3D\"box-sizing: border-box; font-family: -apple-system, Blin=\r\nkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Co=\r\nlor Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; color:=\r\n #3d4852; font-size: 19px; font-weight: bold; text-decoration: none; displa=\r\ny: inline-block;\">\r\nMyLiveJourney\r\n</a>\r\n</td>\r\n</tr>\r\n\r\n<!-- Email B=\r\nody -->\r\n<tr>\r\n<td class=3D\"body\" width=3D\"100%\" cellpadding=3D\"0\" cellsp=\r\nacing=3D\"0\" style=3D\"box-sizing: border-box; font-family: -apple-system, Bl=\r\ninkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple =\r\nColor Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; -pre=\r\nmailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%; b=\r\nackground-color: #edf2f7; border-bottom: 1px solid #edf2f7; border-top: 1px=\r\n solid #edf2f7; margin: 0; padding: 0; width: 100%;\">\r\n<table class=3D\"inn=\r\ner-body\" align=3D\"center\" width=3D\"570\" cellpadding=3D\"0\" cellspacing=3D\"0\"=\r\n role=3D\"presentation\" style=3D\"box-sizing: border-box; font-family: -apple=\r\n-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-ser=\r\nif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: rel=\r\native; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-wid=\r\nth: 570px; background-color: #ffffff; border-color: #e8e5ef; border-radius:=\r\n 2px; border-width: 1px; box-shadow: 0 2px 0 rgba(0, 0, 150, 0.025), 2px 4p=\r\nx 0 rgba(0, 0, 150, 0.015); margin: 0 auto; padding: 0; width: 570px;\">\r\n<=\r\n!-- Body content -->\r\n<tr>\r\n<td class=3D\"content-cell\" style=3D\"box-sizin=\r\ng: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', =\r\nRoboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\'=\r\n, \'Segoe UI Symbol\'; position: relative; max-width: 100vw; padding: 32px;\">=\r\n\r\n<h1 style=3D\"box-sizing: border-box; font-family: -apple-system, BlinkMa=\r\ncSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color=\r\n Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; color: #3=\r\nd4852; font-size: 18px; font-weight: bold; margin-top: 0; text-align: left;=\r\n\">Hellojohnpaul84!</h1>\r\n<p style=3D\"box-sizing: border-box; font-family: =\r\n-apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sa=\r\nns-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; positio=\r\nn: relative; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align=\r\n: left;\">Your booking request has been rejected.</p>\r\n<p style=3D\"box-sizi=\r\nng: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\',=\r\n Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji=\r\n\', \'Segoe UI Symbol\'; position: relative; font-size: 16px; line-height: 1.5=\r\nem; margin-top: 0; text-align: left;\">Thank you for using our application!<=\r\n/p>\r\n<!-- Salutation -->\r\n<p style=3D\"box-sizing: border-box; font-family=\r\n: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, =\r\nsans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; posit=\r\nion: relative; font-size: 16px; line-height: 1.5em; margin-top: 0; text-ali=\r\ngn: left;\">Regards,<br>MyLiveJourney</p>\r\n<!-- Subcopy -->\r\n\r\n\r\n\r\n</td=\r\n>\r\n</tr>\r\n</table>\r\n</td>\r\n</tr>\r\n\r\n<tr>\r\n<td style=3D\"box-sizing: b=\r\norder-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Robo=\r\nto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'S=\r\negoe UI Symbol\'; position: relative;\">\r\n<table class=3D\"footer\" align=3D\"c=\r\nenter\" width=3D\"570\" cellpadding=3D\"0\" cellspacing=3D\"0\" role=3D\"presentati=\r\non\" style=3D\"box-sizing: border-box; font-family: -apple-system, BlinkMacSy=\r\nstemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Em=\r\noji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; -premailer-c=\r\nellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 570px; margin: =\r\n0 auto; padding: 0; text-align: center; width: 570px;\">\r\n<tr>\r\n<td class=\r\n=3D\"content-cell\" align=3D\"center\" style=3D\"box-sizing: border-box; font-fa=\r\nmily: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Ari=\r\nal, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; p=\r\nosition: relative; max-width: 100vw; padding: 32px;\">\r\n<p style=3D\"box-siz=\r\ning: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\'=\r\n, Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoj=\r\ni\', \'Segoe UI Symbol\'; position: relative; line-height: 1.5em; margin-top: =\r\n0; color: #b0adc5; font-size: 12px; text-align: center;\">=C2=A9 2025 MyLive=\r\nJourney. All rights reserved.</p>\r\n\r\n</td>\r\n</tr>\r\n</table>\r\n</td>\r\n<=\r\n/tr>\r\n</table>\r\n</td>\r\n</tr>\r\n</table>\r\n</body>\r\n</html>\r\n--kOC3pcWk--\r\n', 'From: MyLiveJourney <tourmate@example.com>\r\nTo: user@user.com\r\nSubject: Booking Rejected Confirmation\r\n', NULL);
INSERT INTO `email_log` (`id`, `date`, `from`, `to`, `cc`, `bcc`, `subject`, `body`, `headers`, `attachments`) VALUES
(13, '2025-10-27 18:26:55', 'MyLiveJourney <tourmate@example.com>', 'user@user.com', NULL, NULL, 'Booking Approved Confirmation', '--jneDYRdw\r\nContent-Type: text/plain; charset=utf-8\r\nContent-Transfer-Encoding: quoted-printable\r\n\r\n[MyLiveJourney](http://localhost)\r\n\r\n# Hellojohnpaul84!\r\n\r\nYour booking=\r\n request has been successfully Approved\r\n\r\nThank you for using our applic=\r\nation!\r\n\r\nRegards,MyLiveJourney\r\n\r\n=C2=A9 2025 MyLiveJourney. All right=\r\ns reserved.\r\n\r\n--jneDYRdw\r\nContent-Type: text/html; charset=utf-8\r\nContent-Transfer-Encoding: quoted-printable\r\n\r\n<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.=\r\nw3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\r\n<html xmlns=3D\"http://www.=\r\nw3.org/1999/xhtml\">\r\n<head>\r\n<meta name=3D\"viewport\" content=3D\"width=3Dd=\r\nevice-width, initial-scale=3D1.0\">\r\n<meta http-equiv=3D\"Content-Type\" cont=\r\nent=3D\"text/html; charset=3DUTF-8\">\r\n</head>\r\n<body style=3D\"box-sizing: =\r\nborder-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Rob=\r\noto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'=\r\nSegoe UI Symbol\'; position: relative; -webkit-text-size-adjust: none; backg=\r\nround-color: #ffffff; color: #718096; height: 100%; line-height: 1.4; margi=\r\nn: 0; padding: 0; width: 100% !important;\">\r\n<style>\r\n@media only screen =\r\nand (max-width: 600px) {\r\n.inner-body {\r\nwidth: 100% !important;\r\n}\r\n=\r\n\r\n.footer {\r\nwidth: 100% !important;\r\n}\r\n}\r\n\r\n@media only screen and =\r\n(max-width: 500px) {\r\n.button {\r\nwidth: 100% !important;\r\n}\r\n}\r\n</styl=\r\ne>\r\n\r\n<table class=3D\"wrapper\" width=3D\"100%\" cellpadding=3D\"0\" cellspaci=\r\nng=3D\"0\" role=3D\"presentation\" style=3D\"box-sizing: border-box; font-family=\r\n: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, =\r\nsans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; posit=\r\nion: relative; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -prema=\r\niler-width: 100%; background-color: #edf2f7; margin: 0; padding: 0; width: =\r\n100%;\">\r\n<tr>\r\n<td align=3D\"center\" style=3D\"box-sizing: border-box; font=\r\n-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, =\r\nArial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'=\r\n; position: relative;\">\r\n<table class=3D\"content\" width=3D\"100%\" cellpaddi=\r\nng=3D\"0\" cellspacing=3D\"0\" role=3D\"presentation\" style=3D\"box-sizing: borde=\r\nr-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, =\r\nHelvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe=\r\n UI Symbol\'; position: relative; -premailer-cellpadding: 0; -premailer-cell=\r\nspacing: 0; -premailer-width: 100%; margin: 0; padding: 0; width: 100%;\">=\r\n\r\n<tr>\r\n<td class=3D\"header\" style=3D\"box-sizing: border-box; font-family=\r\n: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, =\r\nsans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; posit=\r\nion: relative; padding: 25px 0; text-align: center;\">\r\n<a href=3D\"http://l=\r\nocalhost\" style=3D\"box-sizing: border-box; font-family: -apple-system, Blin=\r\nkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Co=\r\nlor Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; color:=\r\n #3d4852; font-size: 19px; font-weight: bold; text-decoration: none; displa=\r\ny: inline-block;\">\r\nMyLiveJourney\r\n</a>\r\n</td>\r\n</tr>\r\n\r\n<!-- Email B=\r\nody -->\r\n<tr>\r\n<td class=3D\"body\" width=3D\"100%\" cellpadding=3D\"0\" cellsp=\r\nacing=3D\"0\" style=3D\"box-sizing: border-box; font-family: -apple-system, Bl=\r\ninkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple =\r\nColor Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; -pre=\r\nmailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%; b=\r\nackground-color: #edf2f7; border-bottom: 1px solid #edf2f7; border-top: 1px=\r\n solid #edf2f7; margin: 0; padding: 0; width: 100%;\">\r\n<table class=3D\"inn=\r\ner-body\" align=3D\"center\" width=3D\"570\" cellpadding=3D\"0\" cellspacing=3D\"0\"=\r\n role=3D\"presentation\" style=3D\"box-sizing: border-box; font-family: -apple=\r\n-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-ser=\r\nif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: rel=\r\native; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-wid=\r\nth: 570px; background-color: #ffffff; border-color: #e8e5ef; border-radius:=\r\n 2px; border-width: 1px; box-shadow: 0 2px 0 rgba(0, 0, 150, 0.025), 2px 4p=\r\nx 0 rgba(0, 0, 150, 0.015); margin: 0 auto; padding: 0; width: 570px;\">\r\n<=\r\n!-- Body content -->\r\n<tr>\r\n<td class=3D\"content-cell\" style=3D\"box-sizin=\r\ng: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', =\r\nRoboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\'=\r\n, \'Segoe UI Symbol\'; position: relative; max-width: 100vw; padding: 32px;\">=\r\n\r\n<h1 style=3D\"box-sizing: border-box; font-family: -apple-system, BlinkMa=\r\ncSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color=\r\n Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; color: #3=\r\nd4852; font-size: 18px; font-weight: bold; margin-top: 0; text-align: left;=\r\n\">Hellojohnpaul84!</h1>\r\n<p style=3D\"box-sizing: border-box; font-family: =\r\n-apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sa=\r\nns-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; positio=\r\nn: relative; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align=\r\n: left;\">Your booking request has been successfully Approved</p>\r\n<p style=\r\n=3D\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont,=\r\n \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Se=\r\ngoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; font-size: 16px; line=\r\n-height: 1.5em; margin-top: 0; text-align: left;\">Thank you for using our a=\r\npplication!</p>\r\n<!-- Salutation -->\r\n<p style=3D\"box-sizing: border-box;=\r\n font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvet=\r\nica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Sy=\r\nmbol\'; position: relative; font-size: 16px; line-height: 1.5em; margin-top:=\r\n 0; text-align: left;\">Regards,<br>MyLiveJourney</p>\r\n<!-- Subcopy -->\r\n=\r\n\r\n\r\n\r\n</td>\r\n</tr>\r\n</table>\r\n</td>\r\n</tr>\r\n\r\n<tr>\r\n<td style=3D\"=\r\nbox-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Se=\r\ngoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe =\r\nUI Emoji\', \'Segoe UI Symbol\'; position: relative;\">\r\n<table class=3D\"foote=\r\nr\" align=3D\"center\" width=3D\"570\" cellpadding=3D\"0\" cellspacing=3D\"0\" role=\r\n=3D\"presentation\" style=3D\"box-sizing: border-box; font-family: -apple-syst=\r\nem, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'=\r\nApple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative=\r\n; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 5=\r\n70px; margin: 0 auto; padding: 0; text-align: center; width: 570px;\">\r\n<tr=\r\n>\r\n<td class=3D\"content-cell\" align=3D\"center\" style=3D\"box-sizing: border=\r\n-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, H=\r\nelvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe =\r\nUI Symbol\'; position: relative; max-width: 100vw; padding: 32px;\">\r\n<p sty=\r\nle=3D\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFon=\r\nt, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'=\r\nSegoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; line-height: 1.5em;=\r\n margin-top: 0; color: #b0adc5; font-size: 12px; text-align: center;\">=\r\n=C2=A9 2025 MyLiveJourney. All rights reserved.</p>\r\n\r\n</td>\r\n</tr>\r\n</=\r\ntable>\r\n</td>\r\n</tr>\r\n</table>\r\n</td>\r\n</tr>\r\n</table>\r\n</body>\r\n</=\r\nhtml>\r\n--jneDYRdw--\r\n', 'From: MyLiveJourney <tourmate@example.com>\r\nTo: user@user.com\r\nSubject: Booking Approved Confirmation\r\n', NULL),
(14, '2025-11-02 16:43:02', 'MyLiveJourney <tourmate@example.com>', 'gamal333ge@gmail.com', NULL, NULL, 'Activation required', '--p7gk9ZP5\r\nContent-Type: text/plain; charset=utf-8\r\nContent-Transfer-Encoding: quoted-printable\r\n\r\n[MyLiveJourney](http://localhost)\r\n\r\n# Welcome!\r\n\r\nYou need to activate=\r\n your email before you can start using all of our services.\r\n\r\nActivate: =\r\nhttp://127.0.0.1:8000/en/activate/TPAWrKhhWg1xW39UcRpNst6Kd6FDpfmDzY4SHyGQk=\r\nwjMtRuuYNGZ6TPLnAoP2Wh3\r\n\r\nThank you for using our application!\r\n\r\nRega=\r\nrds,MyLiveJourney\r\n\r\nIf you=E2=80=99re having trouble clicking the \"Activ=\r\nate\" button, copy and paste the URL below\r\ninto your web browser: [http://=\r\n127.0.0.1:8000/en/activate/TPAWrKhhWg1xW39UcRpNst6Kd6FDpfmDzY4SHyGQkwjMtRuu=\r\nYNGZ6TPLnAoP2Wh3](http://127.0.0.1:8000/en/activate/TPAWrKhhWg1xW39UcRpNst6=\r\nKd6FDpfmDzY4SHyGQkwjMtRuuYNGZ6TPLnAoP2Wh3)\r\n\r\n=C2=A9 2025 MyLiveJourney. =\r\nAll rights reserved.\r\n\r\n--p7gk9ZP5\r\nContent-Type: text/html; charset=utf-8\r\nContent-Transfer-Encoding: quoted-printable\r\n\r\n<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.=\r\nw3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\r\n<html xmlns=3D\"http://www.=\r\nw3.org/1999/xhtml\">\r\n<head>\r\n<meta name=3D\"viewport\" content=3D\"width=3Dd=\r\nevice-width, initial-scale=3D1.0\">\r\n<meta http-equiv=3D\"Content-Type\" cont=\r\nent=3D\"text/html; charset=3DUTF-8\">\r\n</head>\r\n<body style=3D\"box-sizing: =\r\nborder-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Rob=\r\noto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'=\r\nSegoe UI Symbol\'; position: relative; -webkit-text-size-adjust: none; backg=\r\nround-color: #ffffff; color: #718096; height: 100%; line-height: 1.4; margi=\r\nn: 0; padding: 0; width: 100% !important;\">\r\n<style>\r\n@media only screen =\r\nand (max-width: 600px) {\r\n.inner-body {\r\nwidth: 100% !important;\r\n}\r\n=\r\n\r\n.footer {\r\nwidth: 100% !important;\r\n}\r\n}\r\n\r\n@media only screen and =\r\n(max-width: 500px) {\r\n.button {\r\nwidth: 100% !important;\r\n}\r\n}\r\n</styl=\r\ne>\r\n\r\n<table class=3D\"wrapper\" width=3D\"100%\" cellpadding=3D\"0\" cellspaci=\r\nng=3D\"0\" role=3D\"presentation\" style=3D\"box-sizing: border-box; font-family=\r\n: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, =\r\nsans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; posit=\r\nion: relative; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -prema=\r\niler-width: 100%; background-color: #edf2f7; margin: 0; padding: 0; width: =\r\n100%;\">\r\n<tr>\r\n<td align=3D\"center\" style=3D\"box-sizing: border-box; font=\r\n-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, =\r\nArial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'=\r\n; position: relative;\">\r\n<table class=3D\"content\" width=3D\"100%\" cellpaddi=\r\nng=3D\"0\" cellspacing=3D\"0\" role=3D\"presentation\" style=3D\"box-sizing: borde=\r\nr-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, =\r\nHelvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe=\r\n UI Symbol\'; position: relative; -premailer-cellpadding: 0; -premailer-cell=\r\nspacing: 0; -premailer-width: 100%; margin: 0; padding: 0; width: 100%;\">=\r\n\r\n<tr>\r\n<td class=3D\"header\" style=3D\"box-sizing: border-box; font-family=\r\n: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, =\r\nsans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; posit=\r\nion: relative; padding: 25px 0; text-align: center;\">\r\n<a href=3D\"http://l=\r\nocalhost\" style=3D\"box-sizing: border-box; font-family: -apple-system, Blin=\r\nkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Co=\r\nlor Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; color:=\r\n #3d4852; font-size: 19px; font-weight: bold; text-decoration: none; displa=\r\ny: inline-block;\">\r\nMyLiveJourney\r\n</a>\r\n</td>\r\n</tr>\r\n\r\n<!-- Email B=\r\nody -->\r\n<tr>\r\n<td class=3D\"body\" width=3D\"100%\" cellpadding=3D\"0\" cellsp=\r\nacing=3D\"0\" style=3D\"box-sizing: border-box; font-family: -apple-system, Bl=\r\ninkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple =\r\nColor Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; -pre=\r\nmailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%; b=\r\nackground-color: #edf2f7; border-bottom: 1px solid #edf2f7; border-top: 1px=\r\n solid #edf2f7; margin: 0; padding: 0; width: 100%;\">\r\n<table class=3D\"inn=\r\ner-body\" align=3D\"center\" width=3D\"570\" cellpadding=3D\"0\" cellspacing=3D\"0\"=\r\n role=3D\"presentation\" style=3D\"box-sizing: border-box; font-family: -apple=\r\n-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-ser=\r\nif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: rel=\r\native; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-wid=\r\nth: 570px; background-color: #ffffff; border-color: #e8e5ef; border-radius:=\r\n 2px; border-width: 1px; box-shadow: 0 2px 0 rgba(0, 0, 150, 0.025), 2px 4p=\r\nx 0 rgba(0, 0, 150, 0.015); margin: 0 auto; padding: 0; width: 570px;\">\r\n<=\r\n!-- Body content -->\r\n<tr>\r\n<td class=3D\"content-cell\" style=3D\"box-sizin=\r\ng: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', =\r\nRoboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\'=\r\n, \'Segoe UI Symbol\'; position: relative; max-width: 100vw; padding: 32px;\">=\r\n\r\n<h1 style=3D\"box-sizing: border-box; font-family: -apple-system, BlinkMa=\r\ncSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color=\r\n Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; color: #3=\r\nd4852; font-size: 18px; font-weight: bold; margin-top: 0; text-align: left;=\r\n\">Welcome!</h1>\r\n<p style=3D\"box-sizing: border-box; font-family: -apple-s=\r\nystem, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif=\r\n, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relat=\r\nive; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;\"=\r\n>You need to activate your email before you can start using all of our serv=\r\nices.</p>\r\n<table class=3D\"action\" align=3D\"center\" width=3D\"100%\" cellpad=\r\nding=3D\"0\" cellspacing=3D\"0\" role=3D\"presentation\" style=3D\"box-sizing: bor=\r\nder-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto=\r\n, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Seg=\r\noe UI Symbol\'; position: relative; -premailer-cellpadding: 0; -premailer-ce=\r\nllspacing: 0; -premailer-width: 100%; margin: 30px auto; padding: 0; text-a=\r\nlign: center; width: 100%;\">\r\n<tr>\r\n<td align=3D\"center\" style=3D\"box-siz=\r\ning: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\'=\r\n, Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoj=\r\ni\', \'Segoe UI Symbol\'; position: relative;\">\r\n<table width=3D\"100%\" border=\r\n=3D\"0\" cellpadding=3D\"0\" cellspacing=3D\"0\" role=3D\"presentation\" style=3D\"b=\r\nox-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Seg=\r\noe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe U=\r\nI Emoji\', \'Segoe UI Symbol\'; position: relative;\">\r\n<tr>\r\n<td align=3D\"ce=\r\nnter\" style=3D\"box-sizing: border-box; font-family: -apple-system, BlinkMac=\r\nSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color =\r\nEmoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative;\">\r\n<table=\r\n border=3D\"0\" cellpadding=3D\"0\" cellspacing=3D\"0\" role=3D\"presentation\" sty=\r\nle=3D\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFon=\r\nt, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'=\r\nSegoe UI Emoji\', \'Segoe UI Symbol\'; position: relative;\">\r\n<tr>\r\n<td styl=\r\ne=3D\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont=\r\n, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'S=\r\negoe UI Emoji\', \'Segoe UI Symbol\'; position: relative;\">\r\n<a href=3D\"http:=\r\n//127.0.0.1:8000/en/activate/TPAWrKhhWg1xW39UcRpNst6Kd6FDpfmDzY4SHyGQkwjMtR=\r\nuuYNGZ6TPLnAoP2Wh3\" class=3D\"button button-blue\" target=3D\"_blank\" rel=3D\"n=\r\noopener\" style=3D\"box-sizing: border-box; font-family: -apple-system, Blink=\r\nMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Col=\r\nor Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; -webkit=\r\n-text-size-adjust: none; border-radius: 4px; color: #fff; display: inline-b=\r\nlock; overflow: hidden; text-decoration: none; background-color: #2d3748; b=\r\norder-bottom: 8px solid #2d3748; border-left: 18px solid #2d3748; border-ri=\r\nght: 18px solid #2d3748; border-top: 8px solid #2d3748;\">Activate</a>\r\n</t=\r\nd>\r\n</tr>\r\n</table>\r\n</td>\r\n</tr>\r\n</table>\r\n</td>\r\n</tr>\r\n</table>=\r\n\r\n<p style=3D\"box-sizing: border-box; font-family: -apple-system, BlinkMac=\r\nSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color =\r\nEmoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; font-size:=\r\n 16px; line-height: 1.5em; margin-top: 0; text-align: left;\">Thank you for =\r\nusing our application!</p>\r\n<!-- Salutation -->\r\n<p style=3D\"box-sizing: =\r\nborder-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Rob=\r\noto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'=\r\nSegoe UI Symbol\'; position: relative; font-size: 16px; line-height: 1.5em; =\r\nmargin-top: 0; text-align: left;\">Regards,<br>MyLiveJourney</p>\r\n<!-- Subc=\r\nopy -->\r\n<table class=3D\"subcopy\" width=3D\"100%\" cellpadding=3D\"0\" cellspa=\r\ncing=3D\"0\" role=3D\"presentation\" style=3D\"box-sizing: border-box; font-fami=\r\nly: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial=\r\n, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; pos=\r\nition: relative; border-top: 1px solid #e8e5ef; margin-top: 25px; padding-t=\r\nop: 25px;\">\r\n<tr>\r\n<td style=3D\"box-sizing: border-box; font-family: -app=\r\nle-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-s=\r\nerif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: r=\r\nelative;\">\r\n<p style=3D\"box-sizing: border-box; font-family: -apple-system=\r\n, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Ap=\r\nple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; =\r\nline-height: 1.5em; margin-top: 0; text-align: left; font-size: 14px;\">If y=\r\nou=E2=80=99re having trouble clicking the \"Activate\" button, copy and paste=\r\n the URL below\r\ninto your web browser: <a href=3D\"http://127.0.0.1:8000/en=\r\n/activate/TPAWrKhhWg1xW39UcRpNst6Kd6FDpfmDzY4SHyGQkwjMtRuuYNGZ6TPLnAoP2Wh3\"=\r\n style=3D\"box-sizing: border-box; font-family: -apple-system, BlinkMacSyste=\r\nmFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji=\r\n\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; color: #3869d4;=\r\n\">http://127.0.0.1:8000/en/activate/TPAWrKhhWg1xW39UcRpNst6Kd6FDpfmDzY4SHyG=\r\nQkwjMtRuuYNGZ6TPLnAoP2Wh3</a></p>\r\n</td>\r\n</tr>\r\n</table>\r\n\r\n\r\n\r\n</t=\r\nd>\r\n</tr>\r\n</table>\r\n</td>\r\n</tr>\r\n\r\n<tr>\r\n<td style=3D\"box-sizing: =\r\nborder-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Rob=\r\noto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'=\r\nSegoe UI Symbol\'; position: relative;\">\r\n<table class=3D\"footer\" align=3D\"=\r\ncenter\" width=3D\"570\" cellpadding=3D\"0\" cellspacing=3D\"0\" role=3D\"presentat=\r\nion\" style=3D\"box-sizing: border-box; font-family: -apple-system, BlinkMacS=\r\nystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color E=\r\nmoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; -premailer-=\r\ncellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 570px; margin:=\r\n 0 auto; padding: 0; text-align: center; width: 570px;\">\r\n<tr>\r\n<td class=\r\n=3D\"content-cell\" align=3D\"center\" style=3D\"box-sizing: border-box; font-fa=\r\nmily: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Ari=\r\nal, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; p=\r\nosition: relative; max-width: 100vw; padding: 32px;\">\r\n<p style=3D\"box-siz=\r\ning: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\'=\r\n, Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoj=\r\ni\', \'Segoe UI Symbol\'; position: relative; line-height: 1.5em; margin-top: =\r\n0; color: #b0adc5; font-size: 12px; text-align: center;\">=C2=A9 2025 MyLive=\r\nJourney. All rights reserved.</p>\r\n\r\n</td>\r\n</tr>\r\n</table>\r\n</td>\r\n<=\r\n/tr>\r\n</table>\r\n</td>\r\n</tr>\r\n</table>\r\n</body>\r\n</html>\r\n--p7gk9ZP5--\r\n', 'From: MyLiveJourney <tourmate@example.com>\r\nTo: gamal333ge@gmail.com\r\nSubject: Activation required\r\n', NULL),
(15, '2025-11-02 18:44:38', 'MyLiveJourney <tourmate@example.com>', 'm@user.com', NULL, NULL, 'مطلوب تفعيل الحساب', '--irg4-9MX\r\nContent-Type: text/plain; charset=utf-8\r\nContent-Transfer-Encoding: quoted-printable\r\n\r\n[MyLiveJourney](http://localhost)\r\n\r\n# =D8=A3=D9=87=D9=84=D8=A7=D9=8B =\r\n=D8=A8=D9=83!\r\n\r\n=D9=8A=D8=AC=D8=A8 =D8=B9=D9=84=D9=8A=D9=83 =D8=AA=D9=\r\n=81=D8=B9=D9=8A=D9=84 =D8=A8=D8=B1=D9=8A=D8=AF=D9=83 =D8=A7=D9=84=D8=A5=\r\n=D9=84=D9=83=D8=AA=D8=B1=D9=88=D9=86=D9=8A =D9=82=D8=A8=D9=84 =D8=A3=D9=\r\n=86 =D8=AA=D8=AA=D9=85=D9=83=D9=86 =D9=85=D9=86 =D8=A7=D8=B3=D8=AA=D8=AE=\r\n=D8=AF=D8=A7=D9=85 =D8=AC=D9=85=D9=8A=D8=B9 =D8=AE=D8=AF=D9=85=D8=A7=D8=\r\n=AA=D9=86=D8=A7.\r\n\r\n=D8=AA=D9=81=D8=B9=D9=8A=D9=84: http://127.0.0.1:8000=\r\n/ar/activate/iR2MpLG145SpJsb0HaIFI9tCfgJwO4QYkxjCjJqQZWzWvxB4fG2bNtOTSmH63P=\r\nLF\r\n\r\n=D8=B4=D9=83=D8=B1=D8=A7=D9=8B =D9=84=D8=A7=D8=B3=D8=AA=D8=AE=D8=\r\n=AF=D8=A7=D9=85=D9=83 =D8=AA=D8=B7=D8=A8=D9=8A=D9=82=D9=86=D8=A7!\r\n\r\nRega=\r\nrds,MyLiveJourney\r\n\r\nIf you=E2=80=99re having trouble clicking the \"=\r\n=D8=AA=D9=81=D8=B9=D9=8A=D9=84\" button, copy and paste the URL below\r\ninto=\r\n your web browser: [http://127.0.0.1:8000/ar/activate/iR2MpLG145SpJsb0HaIFI=\r\n9tCfgJwO4QYkxjCjJqQZWzWvxB4fG2bNtOTSmH63PLF](http://127.0.0.1:8000/ar/activ=\r\nate/iR2MpLG145SpJsb0HaIFI9tCfgJwO4QYkxjCjJqQZWzWvxB4fG2bNtOTSmH63PLF)\r\n\r\n=\r\n=C2=A9 2025 MyLiveJourney. All rights reserved.\r\n\r\n--irg4-9MX\r\nContent-Type: text/html; charset=utf-8\r\nContent-Transfer-Encoding: quoted-printable\r\n\r\n<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.=\r\nw3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\r\n<html xmlns=3D\"http://www.=\r\nw3.org/1999/xhtml\">\r\n<head>\r\n<meta name=3D\"viewport\" content=3D\"width=3Dd=\r\nevice-width, initial-scale=3D1.0\">\r\n<meta http-equiv=3D\"Content-Type\" cont=\r\nent=3D\"text/html; charset=3DUTF-8\">\r\n</head>\r\n<body style=3D\"box-sizing: =\r\nborder-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Rob=\r\noto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'=\r\nSegoe UI Symbol\'; position: relative; -webkit-text-size-adjust: none; backg=\r\nround-color: #ffffff; color: #718096; height: 100%; line-height: 1.4; margi=\r\nn: 0; padding: 0; width: 100% !important;\">\r\n<style>\r\n@media only screen =\r\nand (max-width: 600px) {\r\n.inner-body {\r\nwidth: 100% !important;\r\n}\r\n=\r\n\r\n.footer {\r\nwidth: 100% !important;\r\n}\r\n}\r\n\r\n@media only screen and =\r\n(max-width: 500px) {\r\n.button {\r\nwidth: 100% !important;\r\n}\r\n}\r\n</styl=\r\ne>\r\n\r\n<table class=3D\"wrapper\" width=3D\"100%\" cellpadding=3D\"0\" cellspaci=\r\nng=3D\"0\" role=3D\"presentation\" style=3D\"box-sizing: border-box; font-family=\r\n: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, =\r\nsans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; posit=\r\nion: relative; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -prema=\r\niler-width: 100%; background-color: #edf2f7; margin: 0; padding: 0; width: =\r\n100%;\">\r\n<tr>\r\n<td align=3D\"center\" style=3D\"box-sizing: border-box; font=\r\n-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, =\r\nArial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'=\r\n; position: relative;\">\r\n<table class=3D\"content\" width=3D\"100%\" cellpaddi=\r\nng=3D\"0\" cellspacing=3D\"0\" role=3D\"presentation\" style=3D\"box-sizing: borde=\r\nr-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, =\r\nHelvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe=\r\n UI Symbol\'; position: relative; -premailer-cellpadding: 0; -premailer-cell=\r\nspacing: 0; -premailer-width: 100%; margin: 0; padding: 0; width: 100%;\">=\r\n\r\n<tr>\r\n<td class=3D\"header\" style=3D\"box-sizing: border-box; font-family=\r\n: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, =\r\nsans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; posit=\r\nion: relative; padding: 25px 0; text-align: center;\">\r\n<a href=3D\"http://l=\r\nocalhost\" style=3D\"box-sizing: border-box; font-family: -apple-system, Blin=\r\nkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Co=\r\nlor Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; color:=\r\n #3d4852; font-size: 19px; font-weight: bold; text-decoration: none; displa=\r\ny: inline-block;\">\r\nMyLiveJourney\r\n</a>\r\n</td>\r\n</tr>\r\n\r\n<!-- Email B=\r\nody -->\r\n<tr>\r\n<td class=3D\"body\" width=3D\"100%\" cellpadding=3D\"0\" cellsp=\r\nacing=3D\"0\" style=3D\"box-sizing: border-box; font-family: -apple-system, Bl=\r\ninkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple =\r\nColor Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; -pre=\r\nmailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%; b=\r\nackground-color: #edf2f7; border-bottom: 1px solid #edf2f7; border-top: 1px=\r\n solid #edf2f7; margin: 0; padding: 0; width: 100%;\">\r\n<table class=3D\"inn=\r\ner-body\" align=3D\"center\" width=3D\"570\" cellpadding=3D\"0\" cellspacing=3D\"0\"=\r\n role=3D\"presentation\" style=3D\"box-sizing: border-box; font-family: -apple=\r\n-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-ser=\r\nif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: rel=\r\native; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-wid=\r\nth: 570px; background-color: #ffffff; border-color: #e8e5ef; border-radius:=\r\n 2px; border-width: 1px; box-shadow: 0 2px 0 rgba(0, 0, 150, 0.025), 2px 4p=\r\nx 0 rgba(0, 0, 150, 0.015); margin: 0 auto; padding: 0; width: 570px;\">\r\n<=\r\n!-- Body content -->\r\n<tr>\r\n<td class=3D\"content-cell\" style=3D\"box-sizin=\r\ng: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', =\r\nRoboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\'=\r\n, \'Segoe UI Symbol\'; position: relative; max-width: 100vw; padding: 32px;\">=\r\n\r\n<h1 style=3D\"box-sizing: border-box; font-family: -apple-system, BlinkMa=\r\ncSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color=\r\n Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; color: #3=\r\nd4852; font-size: 18px; font-weight: bold; margin-top: 0; text-align: left;=\r\n\">=D8=A3=D9=87=D9=84=D8=A7=D9=8B =D8=A8=D9=83!</h1>\r\n<p style=3D\"box-sizin=\r\ng: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', =\r\nRoboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\'=\r\n, \'Segoe UI Symbol\'; position: relative; font-size: 16px; line-height: 1.5e=\r\nm; margin-top: 0; text-align: left;\">=D9=8A=D8=AC=D8=A8 =D8=B9=D9=84=D9=\r\n=8A=D9=83 =D8=AA=D9=81=D8=B9=D9=8A=D9=84 =D8=A8=D8=B1=D9=8A=D8=AF=D9=83 =\r\n=D8=A7=D9=84=D8=A5=D9=84=D9=83=D8=AA=D8=B1=D9=88=D9=86=D9=8A =D9=82=D8=\r\n=A8=D9=84 =D8=A3=D9=86 =D8=AA=D8=AA=D9=85=D9=83=D9=86 =D9=85=D9=86 =D8=\r\n=A7=D8=B3=D8=AA=D8=AE=D8=AF=D8=A7=D9=85 =D8=AC=D9=85=D9=8A=D8=B9 =D8=AE=\r\n=D8=AF=D9=85=D8=A7=D8=AA=D9=86=D8=A7.</p>\r\n<table class=3D\"action\" align=\r\n=3D\"center\" width=3D\"100%\" cellpadding=3D\"0\" cellspacing=3D\"0\" role=3D\"pres=\r\nentation\" style=3D\"box-sizing: border-box; font-family: -apple-system, Blin=\r\nkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Co=\r\nlor Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; -prema=\r\niler-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%; mar=\r\ngin: 30px auto; padding: 0; text-align: center; width: 100%;\">\r\n<tr>\r\n<td=\r\n align=3D\"center\" style=3D\"box-sizing: border-box; font-family: -apple-syst=\r\nem, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'=\r\nApple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative=\r\n;\">\r\n<table width=3D\"100%\" border=3D\"0\" cellpadding=3D\"0\" cellspacing=3D\"0=\r\n\" role=3D\"presentation\" style=3D\"box-sizing: border-box; font-family: -appl=\r\ne-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-se=\r\nrif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: re=\r\nlative;\">\r\n<tr>\r\n<td align=3D\"center\" style=3D\"box-sizing: border-box; fo=\r\nnt-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica=\r\n, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbo=\r\nl\'; position: relative;\">\r\n<table border=3D\"0\" cellpadding=3D\"0\" cellspaci=\r\nng=3D\"0\" role=3D\"presentation\" style=3D\"box-sizing: border-box; font-family=\r\n: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, =\r\nsans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; posit=\r\nion: relative;\">\r\n<tr>\r\n<td style=3D\"box-sizing: border-box; font-family:=\r\n -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, s=\r\nans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; positi=\r\non: relative;\">\r\n<a href=3D\"http://127.0.0.1:8000/ar/activate/iR2MpLG145Sp=\r\nJsb0HaIFI9tCfgJwO4QYkxjCjJqQZWzWvxB4fG2bNtOTSmH63PLF\" class=3D\"button butto=\r\nn-blue\" target=3D\"_blank\" rel=3D\"noopener\" style=3D\"box-sizing: border-box;=\r\n font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvet=\r\nica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Sy=\r\nmbol\'; position: relative; -webkit-text-size-adjust: none; border-radius: 4=\r\npx; color: #fff; display: inline-block; overflow: hidden; text-decoration: =\r\nnone; background-color: #2d3748; border-bottom: 8px solid #2d3748; border-l=\r\neft: 18px solid #2d3748; border-right: 18px solid #2d3748; border-top: 8px =\r\nsolid #2d3748;\">=D8=AA=D9=81=D8=B9=D9=8A=D9=84</a>\r\n</td>\r\n</tr>\r\n</tabl=\r\ne>\r\n</td>\r\n</tr>\r\n</table>\r\n</td>\r\n</tr>\r\n</table>\r\n<p style=3D\"box-=\r\nsizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe =\r\nUI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI E=\r\nmoji\', \'Segoe UI Symbol\'; position: relative; font-size: 16px; line-height:=\r\n 1.5em; margin-top: 0; text-align: left;\">=D8=B4=D9=83=D8=B1=D8=A7=D9=8B =\r\n=D9=84=D8=A7=D8=B3=D8=AA=D8=AE=D8=AF=D8=A7=D9=85=D9=83 =D8=AA=D8=B7=D8=\r\n=A8=D9=8A=D9=82=D9=86=D8=A7!</p>\r\n<!-- Salutation -->\r\n<p style=3D\"box-si=\r\nzing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI=\r\n\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emo=\r\nji\', \'Segoe UI Symbol\'; position: relative; font-size: 16px; line-height: 1=\r\n.5em; margin-top: 0; text-align: left;\">Regards,<br>MyLiveJourney</p>\r\n<!-=\r\n- Subcopy -->\r\n<table class=3D\"subcopy\" width=3D\"100%\" cellpadding=3D\"0\" c=\r\nellspacing=3D\"0\" role=3D\"presentation\" style=3D\"box-sizing: border-box; fon=\r\nt-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica,=\r\n Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol=\r\n\'; position: relative; border-top: 1px solid #e8e5ef; margin-top: 25px; pad=\r\nding-top: 25px;\">\r\n<tr>\r\n<td style=3D\"box-sizing: border-box; font-family=\r\n: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, =\r\nsans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; posit=\r\nion: relative;\">\r\n<p style=3D\"box-sizing: border-box; font-family: -apple-=\r\nsystem, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-seri=\r\nf, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: rela=\r\ntive; line-height: 1.5em; margin-top: 0; text-align: left; font-size: 14px;=\r\n\">If you=E2=80=99re having trouble clicking the \"=D8=AA=D9=81=D8=B9=D9=\r\n=8A=D9=84\" button, copy and paste the URL below\r\ninto your web browser: <a=\r\n href=3D\"http://127.0.0.1:8000/ar/activate/iR2MpLG145SpJsb0HaIFI9tCfgJwO4QY=\r\nkxjCjJqQZWzWvxB4fG2bNtOTSmH63PLF\" style=3D\"box-sizing: border-box; font-fam=\r\nily: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Aria=\r\nl, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; po=\r\nsition: relative; color: #3869d4;\">http://127.0.0.1:8000/ar/activate/iR2MpL=\r\nG145SpJsb0HaIFI9tCfgJwO4QYkxjCjJqQZWzWvxB4fG2bNtOTSmH63PLF</a></p>\r\n</td>=\r\n\r\n</tr>\r\n</table>\r\n\r\n\r\n\r\n</td>\r\n</tr>\r\n</table>\r\n</td>\r\n</tr>\r\n=\r\n\r\n<tr>\r\n<td style=3D\"box-sizing: border-box; font-family: -apple-system, =\r\nBlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Appl=\r\ne Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative;\">=\r\n\r\n<table class=3D\"footer\" align=3D\"center\" width=3D\"570\" cellpadding=3D\"0\"=\r\n cellspacing=3D\"0\" role=3D\"presentation\" style=3D\"box-sizing: border-box; f=\r\nont-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetic=\r\na, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symb=\r\nol\'; position: relative; -premailer-cellpadding: 0; -premailer-cellspacing:=\r\n 0; -premailer-width: 570px; margin: 0 auto; padding: 0; text-align: center=\r\n; width: 570px;\">\r\n<tr>\r\n<td class=3D\"content-cell\" align=3D\"center\" styl=\r\ne=3D\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont=\r\n, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'S=\r\negoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; max-width: 100vw; pa=\r\ndding: 32px;\">\r\n<p style=3D\"box-sizing: border-box; font-family: -apple-sy=\r\nstem, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif,=\r\n \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relati=\r\nve; line-height: 1.5em; margin-top: 0; color: #b0adc5; font-size: 12px; tex=\r\nt-align: center;\">=C2=A9 2025 MyLiveJourney. All rights reserved.</p>\r\n\r\n=\r\n</td>\r\n</tr>\r\n</table>\r\n</td>\r\n</tr>\r\n</table>\r\n</td>\r\n</tr>\r\n</tab=\r\nle>\r\n</body>\r\n</html>\r\n--irg4-9MX--\r\n', 'From: MyLiveJourney <tourmate@example.com>\r\nTo: m@user.com\r\nSubject: =?utf-8?Q?=D9=85=D8=B7=D9=84=D9=88=D8=A8_=D8=AA=D9=81?=\r\n =?utf-8?Q?=D8=B9=D9=8A=D9=84_=D8=A7=D9=84=D8=AD=D8=B3=D8=A7=D8=A8?=\r\n', NULL),
(16, '2025-11-02 21:25:10', 'MyLiveJourney <tourmate@example.com>', 'user@user.com', NULL, NULL, 'Booking Rejected Confirmation', '--IAeBXJJG\r\nContent-Type: text/plain; charset=utf-8\r\nContent-Transfer-Encoding: quoted-printable\r\n\r\n[MyLiveJourney](http://localhost)\r\n\r\n# Hellojohnpaul84!\r\n\r\nYour booking=\r\n request has been rejected.\r\n\r\nThank you for using our application!\r\n\r\n=\r\nRegards,MyLiveJourney\r\n\r\n=C2=A9 2025 MyLiveJourney. All rights reserved.=\r\n\r\n\r\n--IAeBXJJG\r\nContent-Type: text/html; charset=utf-8\r\nContent-Transfer-Encoding: quoted-printable\r\n\r\n<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.=\r\nw3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\r\n<html xmlns=3D\"http://www.=\r\nw3.org/1999/xhtml\">\r\n<head>\r\n<meta name=3D\"viewport\" content=3D\"width=3Dd=\r\nevice-width, initial-scale=3D1.0\">\r\n<meta http-equiv=3D\"Content-Type\" cont=\r\nent=3D\"text/html; charset=3DUTF-8\">\r\n</head>\r\n<body style=3D\"box-sizing: =\r\nborder-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Rob=\r\noto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'=\r\nSegoe UI Symbol\'; position: relative; -webkit-text-size-adjust: none; backg=\r\nround-color: #ffffff; color: #718096; height: 100%; line-height: 1.4; margi=\r\nn: 0; padding: 0; width: 100% !important;\">\r\n<style>\r\n@media only screen =\r\nand (max-width: 600px) {\r\n.inner-body {\r\nwidth: 100% !important;\r\n}\r\n=\r\n\r\n.footer {\r\nwidth: 100% !important;\r\n}\r\n}\r\n\r\n@media only screen and =\r\n(max-width: 500px) {\r\n.button {\r\nwidth: 100% !important;\r\n}\r\n}\r\n</styl=\r\ne>\r\n\r\n<table class=3D\"wrapper\" width=3D\"100%\" cellpadding=3D\"0\" cellspaci=\r\nng=3D\"0\" role=3D\"presentation\" style=3D\"box-sizing: border-box; font-family=\r\n: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, =\r\nsans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; posit=\r\nion: relative; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -prema=\r\niler-width: 100%; background-color: #edf2f7; margin: 0; padding: 0; width: =\r\n100%;\">\r\n<tr>\r\n<td align=3D\"center\" style=3D\"box-sizing: border-box; font=\r\n-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, =\r\nArial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'=\r\n; position: relative;\">\r\n<table class=3D\"content\" width=3D\"100%\" cellpaddi=\r\nng=3D\"0\" cellspacing=3D\"0\" role=3D\"presentation\" style=3D\"box-sizing: borde=\r\nr-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, =\r\nHelvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe=\r\n UI Symbol\'; position: relative; -premailer-cellpadding: 0; -premailer-cell=\r\nspacing: 0; -premailer-width: 100%; margin: 0; padding: 0; width: 100%;\">=\r\n\r\n<tr>\r\n<td class=3D\"header\" style=3D\"box-sizing: border-box; font-family=\r\n: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, =\r\nsans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; posit=\r\nion: relative; padding: 25px 0; text-align: center;\">\r\n<a href=3D\"http://l=\r\nocalhost\" style=3D\"box-sizing: border-box; font-family: -apple-system, Blin=\r\nkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Co=\r\nlor Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; color:=\r\n #3d4852; font-size: 19px; font-weight: bold; text-decoration: none; displa=\r\ny: inline-block;\">\r\nMyLiveJourney\r\n</a>\r\n</td>\r\n</tr>\r\n\r\n<!-- Email B=\r\nody -->\r\n<tr>\r\n<td class=3D\"body\" width=3D\"100%\" cellpadding=3D\"0\" cellsp=\r\nacing=3D\"0\" style=3D\"box-sizing: border-box; font-family: -apple-system, Bl=\r\ninkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple =\r\nColor Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; -pre=\r\nmailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%; b=\r\nackground-color: #edf2f7; border-bottom: 1px solid #edf2f7; border-top: 1px=\r\n solid #edf2f7; margin: 0; padding: 0; width: 100%;\">\r\n<table class=3D\"inn=\r\ner-body\" align=3D\"center\" width=3D\"570\" cellpadding=3D\"0\" cellspacing=3D\"0\"=\r\n role=3D\"presentation\" style=3D\"box-sizing: border-box; font-family: -apple=\r\n-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-ser=\r\nif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: rel=\r\native; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-wid=\r\nth: 570px; background-color: #ffffff; border-color: #e8e5ef; border-radius:=\r\n 2px; border-width: 1px; box-shadow: 0 2px 0 rgba(0, 0, 150, 0.025), 2px 4p=\r\nx 0 rgba(0, 0, 150, 0.015); margin: 0 auto; padding: 0; width: 570px;\">\r\n<=\r\n!-- Body content -->\r\n<tr>\r\n<td class=3D\"content-cell\" style=3D\"box-sizin=\r\ng: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', =\r\nRoboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\'=\r\n, \'Segoe UI Symbol\'; position: relative; max-width: 100vw; padding: 32px;\">=\r\n\r\n<h1 style=3D\"box-sizing: border-box; font-family: -apple-system, BlinkMa=\r\ncSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color=\r\n Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; color: #3=\r\nd4852; font-size: 18px; font-weight: bold; margin-top: 0; text-align: left;=\r\n\">Hellojohnpaul84!</h1>\r\n<p style=3D\"box-sizing: border-box; font-family: =\r\n-apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sa=\r\nns-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; positio=\r\nn: relative; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align=\r\n: left;\">Your booking request has been rejected.</p>\r\n<p style=3D\"box-sizi=\r\nng: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\',=\r\n Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji=\r\n\', \'Segoe UI Symbol\'; position: relative; font-size: 16px; line-height: 1.5=\r\nem; margin-top: 0; text-align: left;\">Thank you for using our application!<=\r\n/p>\r\n<!-- Salutation -->\r\n<p style=3D\"box-sizing: border-box; font-family=\r\n: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, =\r\nsans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; posit=\r\nion: relative; font-size: 16px; line-height: 1.5em; margin-top: 0; text-ali=\r\ngn: left;\">Regards,<br>MyLiveJourney</p>\r\n<!-- Subcopy -->\r\n\r\n\r\n\r\n</td=\r\n>\r\n</tr>\r\n</table>\r\n</td>\r\n</tr>\r\n\r\n<tr>\r\n<td style=3D\"box-sizing: b=\r\norder-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Robo=\r\nto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'S=\r\negoe UI Symbol\'; position: relative;\">\r\n<table class=3D\"footer\" align=3D\"c=\r\nenter\" width=3D\"570\" cellpadding=3D\"0\" cellspacing=3D\"0\" role=3D\"presentati=\r\non\" style=3D\"box-sizing: border-box; font-family: -apple-system, BlinkMacSy=\r\nstemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Em=\r\noji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; -premailer-c=\r\nellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 570px; margin: =\r\n0 auto; padding: 0; text-align: center; width: 570px;\">\r\n<tr>\r\n<td class=\r\n=3D\"content-cell\" align=3D\"center\" style=3D\"box-sizing: border-box; font-fa=\r\nmily: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Ari=\r\nal, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; p=\r\nosition: relative; max-width: 100vw; padding: 32px;\">\r\n<p style=3D\"box-siz=\r\ning: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\'=\r\n, Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoj=\r\ni\', \'Segoe UI Symbol\'; position: relative; line-height: 1.5em; margin-top: =\r\n0; color: #b0adc5; font-size: 12px; text-align: center;\">=C2=A9 2025 MyLive=\r\nJourney. All rights reserved.</p>\r\n\r\n</td>\r\n</tr>\r\n</table>\r\n</td>\r\n<=\r\n/tr>\r\n</table>\r\n</td>\r\n</tr>\r\n</table>\r\n</body>\r\n</html>\r\n--IAeBXJJG--\r\n', 'From: MyLiveJourney <tourmate@example.com>\r\nTo: user@user.com\r\nSubject: Booking Rejected Confirmation\r\n', NULL);
INSERT INTO `email_log` (`id`, `date`, `from`, `to`, `cc`, `bcc`, `subject`, `body`, `headers`, `attachments`) VALUES
(17, '2025-11-03 11:07:50', 'MyLiveJourney <tourmate@example.com>', 'user@user.com', NULL, NULL, 'Booking Approved Confirmation', '--u9FUsVr_\r\nContent-Type: text/plain; charset=utf-8\r\nContent-Transfer-Encoding: quoted-printable\r\n\r\n[MyLiveJourney](http://localhost)\r\n\r\n# Hellojohnpaul84!\r\n\r\nYour booking=\r\n request has been successfully Approved\r\n\r\nThank you for using our applic=\r\nation!\r\n\r\nRegards,MyLiveJourney\r\n\r\n=C2=A9 2025 MyLiveJourney. All right=\r\ns reserved.\r\n\r\n--u9FUsVr_\r\nContent-Type: text/html; charset=utf-8\r\nContent-Transfer-Encoding: quoted-printable\r\n\r\n<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.=\r\nw3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\r\n<html xmlns=3D\"http://www.=\r\nw3.org/1999/xhtml\">\r\n<head>\r\n<meta name=3D\"viewport\" content=3D\"width=3Dd=\r\nevice-width, initial-scale=3D1.0\">\r\n<meta http-equiv=3D\"Content-Type\" cont=\r\nent=3D\"text/html; charset=3DUTF-8\">\r\n</head>\r\n<body style=3D\"box-sizing: =\r\nborder-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Rob=\r\noto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'=\r\nSegoe UI Symbol\'; position: relative; -webkit-text-size-adjust: none; backg=\r\nround-color: #ffffff; color: #718096; height: 100%; line-height: 1.4; margi=\r\nn: 0; padding: 0; width: 100% !important;\">\r\n<style>\r\n@media only screen =\r\nand (max-width: 600px) {\r\n.inner-body {\r\nwidth: 100% !important;\r\n}\r\n=\r\n\r\n.footer {\r\nwidth: 100% !important;\r\n}\r\n}\r\n\r\n@media only screen and =\r\n(max-width: 500px) {\r\n.button {\r\nwidth: 100% !important;\r\n}\r\n}\r\n</styl=\r\ne>\r\n\r\n<table class=3D\"wrapper\" width=3D\"100%\" cellpadding=3D\"0\" cellspaci=\r\nng=3D\"0\" role=3D\"presentation\" style=3D\"box-sizing: border-box; font-family=\r\n: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, =\r\nsans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; posit=\r\nion: relative; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -prema=\r\niler-width: 100%; background-color: #edf2f7; margin: 0; padding: 0; width: =\r\n100%;\">\r\n<tr>\r\n<td align=3D\"center\" style=3D\"box-sizing: border-box; font=\r\n-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, =\r\nArial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'=\r\n; position: relative;\">\r\n<table class=3D\"content\" width=3D\"100%\" cellpaddi=\r\nng=3D\"0\" cellspacing=3D\"0\" role=3D\"presentation\" style=3D\"box-sizing: borde=\r\nr-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, =\r\nHelvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe=\r\n UI Symbol\'; position: relative; -premailer-cellpadding: 0; -premailer-cell=\r\nspacing: 0; -premailer-width: 100%; margin: 0; padding: 0; width: 100%;\">=\r\n\r\n<tr>\r\n<td class=3D\"header\" style=3D\"box-sizing: border-box; font-family=\r\n: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, =\r\nsans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; posit=\r\nion: relative; padding: 25px 0; text-align: center;\">\r\n<a href=3D\"http://l=\r\nocalhost\" style=3D\"box-sizing: border-box; font-family: -apple-system, Blin=\r\nkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Co=\r\nlor Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; color:=\r\n #3d4852; font-size: 19px; font-weight: bold; text-decoration: none; displa=\r\ny: inline-block;\">\r\nMyLiveJourney\r\n</a>\r\n</td>\r\n</tr>\r\n\r\n<!-- Email B=\r\nody -->\r\n<tr>\r\n<td class=3D\"body\" width=3D\"100%\" cellpadding=3D\"0\" cellsp=\r\nacing=3D\"0\" style=3D\"box-sizing: border-box; font-family: -apple-system, Bl=\r\ninkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple =\r\nColor Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; -pre=\r\nmailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%; b=\r\nackground-color: #edf2f7; border-bottom: 1px solid #edf2f7; border-top: 1px=\r\n solid #edf2f7; margin: 0; padding: 0; width: 100%;\">\r\n<table class=3D\"inn=\r\ner-body\" align=3D\"center\" width=3D\"570\" cellpadding=3D\"0\" cellspacing=3D\"0\"=\r\n role=3D\"presentation\" style=3D\"box-sizing: border-box; font-family: -apple=\r\n-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-ser=\r\nif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: rel=\r\native; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-wid=\r\nth: 570px; background-color: #ffffff; border-color: #e8e5ef; border-radius:=\r\n 2px; border-width: 1px; box-shadow: 0 2px 0 rgba(0, 0, 150, 0.025), 2px 4p=\r\nx 0 rgba(0, 0, 150, 0.015); margin: 0 auto; padding: 0; width: 570px;\">\r\n<=\r\n!-- Body content -->\r\n<tr>\r\n<td class=3D\"content-cell\" style=3D\"box-sizin=\r\ng: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', =\r\nRoboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\'=\r\n, \'Segoe UI Symbol\'; position: relative; max-width: 100vw; padding: 32px;\">=\r\n\r\n<h1 style=3D\"box-sizing: border-box; font-family: -apple-system, BlinkMa=\r\ncSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color=\r\n Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; color: #3=\r\nd4852; font-size: 18px; font-weight: bold; margin-top: 0; text-align: left;=\r\n\">Hellojohnpaul84!</h1>\r\n<p style=3D\"box-sizing: border-box; font-family: =\r\n-apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sa=\r\nns-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; positio=\r\nn: relative; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align=\r\n: left;\">Your booking request has been successfully Approved</p>\r\n<p style=\r\n=3D\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont,=\r\n \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Se=\r\ngoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; font-size: 16px; line=\r\n-height: 1.5em; margin-top: 0; text-align: left;\">Thank you for using our a=\r\npplication!</p>\r\n<!-- Salutation -->\r\n<p style=3D\"box-sizing: border-box;=\r\n font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvet=\r\nica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Sy=\r\nmbol\'; position: relative; font-size: 16px; line-height: 1.5em; margin-top:=\r\n 0; text-align: left;\">Regards,<br>MyLiveJourney</p>\r\n<!-- Subcopy -->\r\n=\r\n\r\n\r\n\r\n</td>\r\n</tr>\r\n</table>\r\n</td>\r\n</tr>\r\n\r\n<tr>\r\n<td style=3D\"=\r\nbox-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \'Se=\r\ngoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe =\r\nUI Emoji\', \'Segoe UI Symbol\'; position: relative;\">\r\n<table class=3D\"foote=\r\nr\" align=3D\"center\" width=3D\"570\" cellpadding=3D\"0\" cellspacing=3D\"0\" role=\r\n=3D\"presentation\" style=3D\"box-sizing: border-box; font-family: -apple-syst=\r\nem, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'=\r\nApple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; position: relative=\r\n; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 5=\r\n70px; margin: 0 auto; padding: 0; text-align: center; width: 570px;\">\r\n<tr=\r\n>\r\n<td class=3D\"content-cell\" align=3D\"center\" style=3D\"box-sizing: border=\r\n-box; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, H=\r\nelvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe =\r\nUI Symbol\'; position: relative; max-width: 100vw; padding: 32px;\">\r\n<p sty=\r\nle=3D\"box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFon=\r\nt, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'=\r\nSegoe UI Emoji\', \'Segoe UI Symbol\'; position: relative; line-height: 1.5em;=\r\n margin-top: 0; color: #b0adc5; font-size: 12px; text-align: center;\">=\r\n=C2=A9 2025 MyLiveJourney. All rights reserved.</p>\r\n\r\n</td>\r\n</tr>\r\n</=\r\ntable>\r\n</td>\r\n</tr>\r\n</table>\r\n</td>\r\n</tr>\r\n</table>\r\n</body>\r\n</=\r\nhtml>\r\n--u9FUsVr_--\r\n', 'From: MyLiveJourney <tourmate@example.com>\r\nTo: user@user.com\r\nSubject: Booking Approved Confirmation\r\n', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `laravel2step`
--

CREATE TABLE `laravel2step` (
  `id` int(10) UNSIGNED NOT NULL,
  `userId` bigint(20) UNSIGNED NOT NULL,
  `authCode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `authCount` int(11) NOT NULL,
  `authStatus` tinyint(1) NOT NULL DEFAULT 0,
  `authDate` datetime DEFAULT NULL,
  `requestDate` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `laravel_blocker`
--

CREATE TABLE `laravel_blocker` (
  `id` int(10) UNSIGNED NOT NULL,
  `typeId` int(10) UNSIGNED NOT NULL,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `userId` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `laravel_blocker_types`
--

CREATE TABLE `laravel_blocker_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `laravel_logger_activity`
--

CREATE TABLE `laravel_logger_activity` (
  `id` int(10) UNSIGNED NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `userType` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `route` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ipAddress` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `userAgent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referer` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `methodType` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `conversation_id` bigint(20) UNSIGNED NOT NULL,
  `role` enum('model','guide','user','assistant','system') COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`meta`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `conversation_id`, `role`, `content`, `meta`, `created_at`, `updated_at`) VALUES
(1, 2, 'user', 'hi', NULL, '2025-10-22 17:48:46', '2025-10-22 17:48:46'),
(2, 3, 'user', 'hi', NULL, '2025-10-22 18:00:50', '2025-10-22 18:00:50'),
(3, 4, 'user', 'hi', NULL, '2025-10-22 18:29:42', '2025-10-22 18:29:42'),
(4, 5, 'user', 'hi', NULL, '2025-10-22 18:39:34', '2025-10-22 18:39:34'),
(5, 6, 'user', 'hi', NULL, '2025-10-22 18:45:32', '2025-10-22 18:45:32'),
(6, 6, 'model', 'مرحباً! أنا هنا لأساعدك في التخطيط لرحلتك القادمة أو الإجابة عن أي أسئلة سياحية قد تكون لديك. كيف يمكنني مساعدتك اليوم؟', NULL, '2025-10-22 18:45:41', '2025-10-22 18:45:41'),
(7, 7, 'user', 'hi', NULL, '2025-10-22 19:04:38', '2025-10-22 19:04:38'),
(8, 7, 'model', 'أهلاً بك! كيف يمكنني مساعدتك في التخطيط لرحلتك السياحية اليوم؟ 😊', NULL, '2025-10-22 19:05:28', '2025-10-22 19:05:28'),
(9, 8, 'user', 'hello', NULL, '2025-10-22 19:05:42', '2025-10-22 19:05:42'),
(10, 8, 'model', 'أهلاً بك! أنا مساعدك السياحي الخبير، وسعيد جداً بمساعدتك في التخطيط لرحلتك.\n\nلدينا معلومات عن مناطق رائعة مثل: الرياض، جدة، العلا، أبها، والخبر، بالإضافة إلى أماكن سياحية متنوعة.\n\nكيف يمكنني مساعدتك اليوم؟ هل تبحث عن مكان معين، أو نوع من الأماكن (تاريخية، طبيعية، ثقافية، ترفيهية، دينية)، أو لديك أسئلة عن مدينة معينة؟', NULL, '2025-10-22 19:05:52', '2025-10-22 19:05:52'),
(11, 9, 'user', 'hello', NULL, '2025-10-22 19:11:50', '2025-10-22 19:11:50'),
(12, 9, 'model', 'أهلاً بك! أنا هنا لمساعدتك في التخطيط لرحلتك. كيف يمكنني مساعدتك اليوم؟', NULL, '2025-10-22 19:11:54', '2025-10-22 19:11:54'),
(13, 10, 'user', 'اخبرني عنك', NULL, '2025-10-22 19:14:02', '2025-10-22 19:14:02'),
(14, 10, 'model', 'عذراً، حدث خطأ أثناء محاولة الاتصال بخدمة الذكاء الاصطناعي. الرجاء المحاولة مرة أخرى.', NULL, '2025-10-22 19:14:28', '2025-10-22 19:14:28'),
(15, 11, 'user', 'جيد', NULL, '2025-10-22 19:15:40', '2025-10-22 19:15:40'),
(16, 11, 'model', 'رائع! يسعدني أنك وجدت المعلومات مفيدة.\n\nإذا كان لديك أي أسئلة أخرى حول المناطق السياحية المتاحة مثل الرياض، جدة، العلا، أبها، أو الخبر، أو تود معرفة المزيد عن الأماكن التاريخية، الطبيعية، الثقافية، الترفيهية، أو الدينية، فلا تتردد في سؤالي! أنا هنا لمساعدتك في التخطيط لرحلتك. 😊', NULL, '2025-10-22 19:15:57', '2025-10-22 19:15:57'),
(17, 12, 'user', 'جيد', NULL, '2025-10-22 19:16:10', '2025-10-22 19:16:10'),
(18, 12, 'model', 'أهلاً بك! يسعدني أن أكون مساعدك السياحي.\n\nكيف يمكنني مساعدتك في التخطيط لرحلتك القادمة؟ هل تبحث عن معلومات حول مناطق معينة، أو أنواع أماكن (تاريخية، طبيعية، ثقافية، ترفيهية، دينية)، أو أماكن محددة؟', NULL, '2025-10-22 19:16:18', '2025-10-22 19:16:18'),
(19, 13, 'user', 'هذا رائع', NULL, '2025-10-22 19:18:36', '2025-10-22 19:18:36'),
(20, 13, 'model', 'يسعدني أنك أعجبت بذلك! 😊 إذا كان لديك أي أسئلة أخرى حول الأماكن السياحية في الرياض، جدة، العلا، أبها، أو الخبر، فلا تتردد في سؤالي.', NULL, '2025-10-22 19:18:39', '2025-10-22 19:18:39'),
(21, 14, 'user', 'انا حاليا اختبرك لاعرف مدى معرفتك', NULL, '2025-10-22 19:19:54', '2025-10-22 19:19:54'),
(22, 14, 'model', 'أهلاً بك! أنا هنا لمساعدتك كخبير سياحي.\n\nأنا جاهز للإجابة على أي أسئلة لديك بناءً على المعلومات السياحية المتاحة لدي. كيف يمكنني مساعدتك اليوم؟', NULL, '2025-10-22 19:20:00', '2025-10-22 19:20:00'),
(23, 14, 'user', 'اريد معرفة المناطق المتوفرة في موقعكم', NULL, '2025-10-22 19:34:32', '2025-10-22 19:34:32'),
(24, 14, 'model', 'بالتأكيد! المناطق المتوفرة لدينا حالياً هي:\n\n*   **Riyadh**\n*   **Jeddah**\n*   **AlUla**\n*   **Abha**\n*   **Al Khobar**\n\nهل تود معرفة المزيد عن أي من هذه المناطق؟', NULL, '2025-10-22 19:34:36', '2025-10-22 19:34:36'),
(25, 14, 'user', 'hello', NULL, '2025-10-23 14:43:11', '2025-10-23 14:43:11'),
(26, 14, 'model', 'أهلاً بك! كيف يمكنني مساعدتك اليوم؟', NULL, '2025-10-23 14:43:23', '2025-10-23 14:43:23'),
(27, 14, 'user', 'hello', NULL, '2025-10-23 16:21:37', '2025-10-23 16:21:37'),
(28, 14, 'user', 'hello', NULL, '2025-10-23 16:23:53', '2025-10-23 16:23:53'),
(29, 14, 'user', 'hello', NULL, '2025-10-23 16:29:25', '2025-10-23 16:29:25'),
(30, 14, 'user', 'hello', NULL, '2025-10-23 16:35:03', '2025-10-23 16:35:03'),
(31, 14, 'model', 'عذراً، حدث خطأ أثناء محاولة الاتصال بخدمة الذكاء الاصطناعي. الرجاء المحاولة مرة أخرى.', NULL, '2025-10-23 16:35:15', '2025-10-23 16:35:15'),
(32, 14, 'user', 'hello', NULL, '2025-10-23 16:35:53', '2025-10-23 16:35:53'),
(33, 14, 'model', 'أهلاً بك مرة أخرى! كيف يمكنني مساعدتك كخبير سياحي اليوم؟', NULL, '2025-10-23 16:35:59', '2025-10-23 16:35:59'),
(34, 15, 'user', 'hello', NULL, '2025-10-26 15:37:43', '2025-10-26 15:37:43'),
(35, 15, 'model', 'أهلاً بك! أنا هنا لمساعدتك في التخطيط لرحلتك.\n\nلدي معلومات عن مناطق رائعة مثل: الرياض، جدة، العلا، أبها، والخبر.\n\nويمكنني أن أطلعك على أماكن مذهلة مثل:\n*   **الرياض بوليفارد** (ترفيهي في الرياض)\n*   **قلعة المصمك** (تاريخي في الرياض)\n*   **كورنيش جدة** (طبيعي في جدة)\n*   **الحِجر (مدائن صالح)** (تاريخي في العلا)\n*   **صخرة الفيل** (طبيعي في العلا)\n*   **جبل السودة** (طبيعي في أبها)\n\nكيف يمكنني مساعدتك اليوم؟ هل تبحث عن مكان معين، أو نوع من الأنشطة، أو لديك وجهة معينة في ذهنك؟', NULL, '2025-10-26 15:37:48', '2025-10-26 15:37:48'),
(36, 14, 'user', 'hi', NULL, '2025-10-26 17:57:25', '2025-10-26 17:57:25'),
(37, 14, 'model', 'أهلاً بك! كيف يمكنني مساعدتك اليوم؟', NULL, '2025-10-26 17:57:27', '2025-10-26 17:57:27'),
(38, 14, 'user', 'مرحبا', NULL, '2025-11-01 13:39:21', '2025-11-01 13:39:21'),
(39, 14, 'model', 'مرحباً بك! كيف يمكنني مساعدتك كخبير سياحي اليوم؟', NULL, '2025-11-01 13:39:26', '2025-11-01 13:39:26');

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
(3, '2016_01_15_105324_create_roles_table', 1),
(4, '2016_01_15_114412_create_role_user_table', 1),
(5, '2016_01_26_115212_create_permissions_table', 1),
(6, '2016_01_26_115523_create_permission_role_table', 1),
(7, '2016_02_09_132439_create_permission_user_table', 1),
(8, '2017_03_09_082449_create_social_logins_table', 1),
(9, '2017_03_09_082526_create_activations_table', 1),
(10, '2017_03_20_213554_create_themes_table', 1),
(11, '2017_03_21_042918_create_profiles_table', 1),
(12, '2017_11_04_103444_create_laravel_logger_activity_table', 1),
(13, '2017_12_09_070937_create_two_step_auth_table', 1),
(14, '2019_02_19_032636_create_laravel_blocker_types_table', 1),
(15, '2019_02_19_045158_create_laravel_blocker_table', 1),
(16, '2019_08_19_000000_create_failed_jobs_table', 1),
(17, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(18, '2020_08_31_172541_create_districts_table', 1),
(19, '2020_08_31_204233_create_placetypes_table', 1),
(20, '2020_09_13_202927_create_places_table', 1),
(21, '2020_09_23_031311_create_tours_table', 1),
(22, '2020_09_23_034558_create_place_tour_table', 1),
(23, '2020_10_09_015653_create_bookings_table', 1),
(24, '2023_02_26_001638_create_email_log', 1),
(25, '2025_10_11_175524_update_tours_table', 2),
(26, '2025_10_22_200138_create_conversations_table', 3),
(27, '2025_10_22_200253_create_messages_table', 3),
(31, '2025_10_23_202735_create_chat_rooms_table', 4),
(32, '2025_10_23_202813_create_chat_messages_table', 4),
(33, '2025_10_23_203618_create_chat_room_user_table', 4),
(34, '2025_10_26_171437_add_column_chat_room_user_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `slug`, `description`, `model`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'View Users', 'view.users', 'Can view users', 'App\\Models\\User', '2025-10-09 17:53:09', '2025-10-09 17:53:09', NULL),
(2, 'Create Users', 'create.users', 'Can create new users', 'App\\Models\\User', '2025-10-09 17:53:09', '2025-10-09 17:53:09', NULL),
(3, 'Update Users', 'update.users', 'Can update users', 'App\\Models\\User', '2025-10-09 17:53:09', '2025-10-09 17:53:09', NULL),
(4, 'Delete Users', 'delete.users', 'Can delete users', 'App\\Models\\User', '2025-10-09 17:53:09', '2025-10-09 17:53:09', NULL),
(5, 'View Districts', 'view.districts', 'Can view districts', 'App\\Models\\District', '2025-10-09 17:53:09', '2025-10-09 17:53:09', NULL),
(6, 'Create Districts', 'create.districts', 'Can create new districts', 'App\\Models\\District', '2025-10-09 17:53:09', '2025-10-09 17:53:09', NULL),
(7, 'Update Districts', 'update.districts', 'Can update districts', 'App\\Models\\District', '2025-10-09 17:53:09', '2025-10-09 17:53:09', NULL),
(8, 'Delete Districts', 'delete.districts', 'Can delete districts', 'App\\Models\\District', '2025-10-09 17:53:09', '2025-10-09 17:53:09', NULL),
(9, 'View Place Types', 'view.placetypes', 'Can view place types', 'App\\Models\\PlaceType', '2025-10-09 17:53:09', '2025-10-09 17:53:09', NULL),
(10, 'Create Place Types', 'create.placetypes', 'Can create new place types', 'App\\Models\\PlaceType', '2025-10-09 17:53:09', '2025-10-09 17:53:09', NULL),
(11, 'Update Place Types', 'update.placetypes', 'Can update place types', 'App\\Models\\PlaceType', '2025-10-09 17:53:09', '2025-10-09 17:53:09', NULL),
(12, 'Delete Place Types', 'delete.placetypes', 'Can delete place types', 'App\\Models\\PlaceType', '2025-10-09 17:53:09', '2025-10-09 17:53:09', NULL),
(13, 'View Places', 'view.places', 'Can view places', 'App\\Models\\Place', '2025-10-09 17:53:09', '2025-10-09 17:53:09', NULL),
(14, 'Create Places', 'create.places', 'Can create new places', 'App\\Models\\Place', '2025-10-09 17:53:09', '2025-10-09 17:53:09', NULL),
(15, 'Update Places', 'update.places', 'Can update places', 'App\\Models\\Place', '2025-10-09 17:53:09', '2025-10-09 17:53:09', NULL),
(16, 'Delete Places', 'delete.places', 'Can delete places', 'App\\Models\\Place', '2025-10-09 17:53:09', '2025-10-09 17:53:09', NULL),
(17, 'View Tours', 'view.tours', 'Can view tours', 'App\\Models\\Tour', '2025-10-09 17:53:09', '2025-10-09 17:53:09', NULL),
(18, 'Create Tours', 'create.tours', 'Can create new tours', 'App\\Models\\Tour', '2025-10-09 17:53:09', '2025-10-09 17:53:09', NULL),
(19, 'Update Tours', 'update.tours', 'Can update tours', 'App\\Models\\Tour', '2025-10-09 17:53:09', '2025-10-09 17:53:09', NULL),
(20, 'Delete Tours', 'delete.tours', 'Can delete tours', 'App\\Models\\Tour', '2025-10-09 17:53:09', '2025-10-09 17:53:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `id` int(10) UNSIGNED NOT NULL,
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, '2025-10-09 19:03:39', '2025-10-09 19:03:39', NULL),
(2, 2, 1, '2025-10-09 19:03:39', '2025-10-09 19:03:39', NULL),
(3, 3, 1, '2025-10-09 19:03:39', '2025-10-09 19:03:39', NULL),
(4, 4, 1, '2025-10-09 19:03:39', '2025-10-09 19:03:39', NULL),
(5, 5, 1, '2025-10-09 19:03:39', '2025-10-09 19:03:39', NULL),
(6, 6, 1, '2025-10-09 19:03:39', '2025-10-09 19:03:39', NULL),
(7, 7, 1, '2025-10-09 19:03:39', '2025-10-09 19:03:39', NULL),
(8, 8, 1, '2025-10-09 19:03:39', '2025-10-09 19:03:39', NULL),
(9, 9, 1, '2025-10-09 19:03:39', '2025-10-09 19:03:39', NULL),
(10, 10, 1, '2025-10-09 19:03:39', '2025-10-09 19:03:39', NULL),
(11, 11, 1, '2025-10-09 19:03:39', '2025-10-09 19:03:39', NULL),
(12, 12, 1, '2025-10-09 19:03:39', '2025-10-09 19:03:39', NULL),
(13, 13, 1, '2025-10-09 19:03:39', '2025-10-09 19:03:39', NULL),
(14, 14, 1, '2025-10-09 19:03:39', '2025-10-09 19:03:39', NULL),
(15, 15, 1, '2025-10-09 19:03:39', '2025-10-09 19:03:39', NULL),
(16, 16, 1, '2025-10-09 19:03:39', '2025-10-09 19:03:39', NULL),
(17, 17, 1, '2025-10-09 19:03:39', '2025-10-09 19:03:39', NULL),
(18, 18, 1, '2025-10-09 19:03:39', '2025-10-09 19:03:39', NULL),
(19, 19, 1, '2025-10-09 19:03:39', '2025-10-09 19:03:39', NULL),
(20, 20, 1, '2025-10-09 19:03:39', '2025-10-09 19:03:39', NULL),
(21, 1, 3, '2025-10-09 19:03:39', '2025-10-09 19:03:39', NULL),
(22, 5, 3, '2025-10-09 19:03:39', '2025-10-09 19:03:39', NULL),
(23, 9, 3, '2025-10-09 19:03:39', '2025-10-09 19:03:39', NULL),
(24, 13, 3, '2025-10-09 19:03:39', '2025-10-09 19:03:39', NULL),
(25, 17, 3, '2025-10-09 19:03:39', '2025-10-09 19:03:39', NULL),
(26, 18, 3, '2025-10-12 18:22:50', '2025-10-12 18:22:50', NULL),
(27, 19, 3, '2025-10-12 18:22:50', '2025-10-12 18:22:50', NULL),
(28, 20, 3, '2025-10-12 18:22:50', '2025-10-12 18:22:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permission_user`
--

CREATE TABLE `permission_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `permission_id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `places`
--

CREATE TABLE `places` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `district_id` bigint(20) UNSIGNED NOT NULL,
  `placetype_id` bigint(20) UNSIGNED NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `places`
--

INSERT INTO `places` (`id`, `name`, `district_id`, `placetype_id`, `description`, `image`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Riyadh Boulevard', 1, 4, 'One of the most popular entertainment zones in Riyadh, featuring events, restaurants, and live shows.', '2025-10-15-68efeac47b0c4.jpg', 1, '2025-10-11 14:05:02', '2025-10-15 15:41:08'),
(2, 'Masmak Fortress', 1, 1, 'A historical fortress located in the old city of Riyadh, symbolizing the unification of Saudi Arabia.', '2025-10-11-68ea916fc62f8.jpg', 1, '2025-10-11 14:05:02', '2025-10-11 14:18:39'),
(3, 'Jeddah Corniche', 2, 2, 'A beautiful seafront promenade in Jeddah with beaches, parks, and cafes.', '2025-10-15-68efeb38e59dd.jpg', 1, '2025-10-11 14:05:02', '2025-10-15 15:43:05'),
(4, 'Hegra (Madain Saleh)', 3, 1, 'A UNESCO World Heritage site featuring Nabataean tombs carved into rock formations in AlUla.', '2025-10-15-68efecc9b9b83.jpeg', 1, '2025-10-11 14:05:02', '2025-10-15 15:49:45'),
(5, 'Elephant Rock', 3, 2, 'A naturally shaped rock resembling an elephant, one of AlUla’s most iconic landmarks.', '2025-10-15-68efecd5bc52e.jpg', 1, '2025-10-11 14:05:02', '2025-10-15 15:49:57'),
(6, 'Jabal Sawda', 4, 2, 'The highest mountain in Saudi Arabia, located in the Asir region with stunning scenic views.', '2025-10-15-68efece55bd3d.jpeg', 1, '2025-10-11 14:05:02', '2025-10-15 15:50:13');

-- --------------------------------------------------------

--
-- Table structure for table `placetypes`
--

CREATE TABLE `placetypes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `placetypes`
--

INSERT INTO `placetypes` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Historical', '2025-10-11 14:05:02', '2025-10-11 14:05:02'),
(2, 'Natural', '2025-10-11 14:05:02', '2025-10-11 14:05:02'),
(3, 'Cultural', '2025-10-11 14:05:02', '2025-10-11 14:05:02'),
(4, 'Entertainment', '2025-10-11 14:05:02', '2025-10-11 14:05:02');

-- --------------------------------------------------------

--
-- Table structure for table `place_tour`
--

CREATE TABLE `place_tour` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `place_id` int(11) NOT NULL,
  `tour_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `place_tour`
--

INSERT INTO `place_tour` (`id`, `place_id`, `tour_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 3, 1, NULL, NULL),
(3, 2, 2, NULL, NULL),
(4, 6, 2, NULL, NULL),
(5, 7, 2, NULL, NULL),
(6, 2, 3, NULL, NULL),
(7, 4, 3, NULL, NULL),
(8, 7, 3, NULL, NULL),
(9, 4, 4, NULL, NULL),
(10, 3, 5, NULL, NULL),
(11, 6, 5, NULL, NULL),
(12, 4, 6, NULL, NULL),
(13, 2, 7, NULL, NULL),
(14, 3, 7, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `theme_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `contact` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bio` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter_username` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `github_username` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar_status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `user_id`, `theme_id`, `contact`, `location`, `bio`, `twitter_username`, `github_username`, `avatar`, `avatar_status`, `created_at`, `updated_at`) VALUES
(1, 4, 1, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-10-09 18:05:45', '2025-10-09 18:05:45'),
(2, 6, 1, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-10-09 18:09:58', '2025-10-09 18:09:58'),
(3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-10-09 18:22:17', '2025-10-31 13:45:55'),
(4, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-10-09 18:22:17', '2025-10-09 18:22:17'),
(5, 3, 1, NULL, NULL, NULL, NULL, NULL, '/images/profile/3/avatar/avatar.jpg', 0, '2025-10-09 18:22:17', '2025-11-01 17:56:15'),
(6, 4, 1, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-10-22 14:58:52', '2025-10-22 14:58:52'),
(7, 5, 1, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-11-02 13:43:07', '2025-11-02 13:43:07'),
(8, 6, 1, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-11-02 15:44:43', '2025-11-02 15:44:43');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `level` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `slug`, `description`, `level`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', 'admin', 'Admin Role', 5, '2025-10-09 17:53:09', '2025-10-09 17:53:09', NULL),
(2, 'User', 'user', 'User Role', 0, '2025-10-09 17:53:09', '2025-10-09 17:53:09', NULL),
(3, 'Guide', 'guide', 'Guide Role', 3, '2025-10-09 17:53:09', '2025-10-09 17:53:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`id`, `role_id`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 2, 2, '2025-10-09 19:06:47', '2025-10-09 19:06:47', NULL),
(3, 3, 3, '2025-10-09 19:06:47', '2025-10-09 19:06:47', NULL),
(5, 1, 1, '2025-10-09 19:20:26', '2025-10-09 19:20:26', NULL),
(6, 2, 4, '2025-10-22 15:01:53', '2025-10-22 15:01:53', NULL),
(7, 2, 5, '2025-11-02 13:44:01', '2025-11-02 13:44:01', NULL),
(8, 3, 6, '2025-11-02 15:44:37', '2025-11-02 15:44:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `social_logins`
--

CREATE TABLE `social_logins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `provider` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `social_id` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `themes`
--

CREATE TABLE `themes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notes` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `taggable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `taggable_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `themes`
--

INSERT INTO `themes` (`id`, `name`, `link`, `notes`, `status`, `taggable_type`, `taggable_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Default', 'null', NULL, 1, 'theme', 1, '2025-10-09 17:58:47', '2025-10-09 17:58:47', NULL),
(2, 'Darkly', 'https://maxcdn.bootstrapcdn.com/bootswatch/4.3.1/darkly/bootstrap.min.css', NULL, 1, 'theme', 2, '2025-10-09 17:58:47', '2025-10-09 17:58:47', NULL),
(3, 'Cyborg', 'https://maxcdn.bootstrapcdn.com/bootswatch/4.3.1/cyborg/bootstrap.min.css', NULL, 1, 'theme', 3, '2025-10-09 17:58:47', '2025-10-09 17:58:47', NULL),
(4, 'Cosmo', 'https://maxcdn.bootstrapcdn.com/bootswatch/4.3.1/cosmo/bootstrap.min.css', NULL, 1, 'theme', 4, '2025-10-09 17:58:47', '2025-10-09 17:58:47', NULL),
(5, 'Cerulean', 'https://maxcdn.bootstrapcdn.com/bootswatch/4.3.1/cerulean/bootstrap.min.css', NULL, 1, 'theme', 5, '2025-10-09 17:58:47', '2025-10-09 17:58:47', NULL),
(6, 'Flatly', 'https://maxcdn.bootstrapcdn.com/bootswatch/4.3.1/flatly/bootstrap.min.css', NULL, 1, 'theme', 6, '2025-10-09 17:58:47', '2025-10-09 17:58:47', NULL),
(7, 'Journal', 'https://maxcdn.bootstrapcdn.com/bootswatch/4.3.1/journal/bootstrap.min.css', NULL, 1, 'theme', 7, '2025-10-09 17:58:47', '2025-10-09 17:58:47', NULL),
(8, 'Lumen', 'https://maxcdn.bootstrapcdn.com/bootswatch/4.3.1/lumen/bootstrap.min.css', NULL, 1, 'theme', 8, '2025-10-09 17:58:47', '2025-10-09 17:58:47', NULL),
(9, 'Paper', 'https://maxcdn.bootstrapcdn.com/bootswatch/4.3.1/paper/bootstrap.min.css', NULL, 1, 'theme', 9, '2025-10-09 17:58:47', '2025-10-09 17:58:47', NULL),
(10, 'Readable', 'https://maxcdn.bootstrapcdn.com/bootswatch/4.3.1/readable/bootstrap.min.css', NULL, 1, 'theme', 10, '2025-10-09 17:58:47', '2025-10-09 17:58:47', NULL),
(11, 'Sandstone', 'https://maxcdn.bootstrapcdn.com/bootswatch/4.3.1/sandstone/bootstrap.min.css', NULL, 1, 'theme', 11, '2025-10-09 17:58:47', '2025-10-09 17:58:47', NULL),
(12, 'Simplex', 'https://maxcdn.bootstrapcdn.com/bootswatch/4.3.1/simplex/bootstrap.min.css', NULL, 1, 'theme', 12, '2025-10-09 17:58:47', '2025-10-09 17:58:47', NULL),
(13, 'Slate', 'https://maxcdn.bootstrapcdn.com/bootswatch/4.3.1/slate/bootstrap.min.css', NULL, 1, 'theme', 13, '2025-10-09 17:58:47', '2025-10-09 17:58:47', NULL),
(14, 'Spacelab', 'https://maxcdn.bootstrapcdn.com/bootswatch/4.3.1/spacelab/bootstrap.min.css', NULL, 1, 'theme', 14, '2025-10-09 17:58:47', '2025-10-09 17:58:47', NULL),
(15, 'Superhero', 'https://maxcdn.bootstrapcdn.com/bootswatch/4.3.1/superhero/bootstrap.min.css', NULL, 1, 'theme', 15, '2025-10-09 17:58:47', '2025-10-09 17:58:47', NULL),
(16, 'United', 'https://maxcdn.bootstrapcdn.com/bootswatch/4.3.1/united/bootstrap.min.css', NULL, 1, 'theme', 16, '2025-10-09 17:58:47', '2025-10-09 17:58:47', NULL),
(17, 'Yeti', 'https://maxcdn.bootstrapcdn.com/bootswatch/4.3.1/yeti/bootstrap.min.css', NULL, 1, 'theme', 17, '2025-10-09 17:58:47', '2025-10-09 17:58:47', NULL),
(18, 'Bootstrap 4.3.1', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css', NULL, 1, 'theme', 18, '2025-10-09 17:58:47', '2025-10-09 17:58:47', NULL),
(19, 'Materialize', 'https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.css', NULL, 1, 'theme', 19, '2025-10-09 17:58:47', '2025-10-09 17:58:47', NULL),
(20, 'Material Design for Bootstrap (MDB) 4.8.7', 'https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.7/css/mdb.css', NULL, 1, 'theme', 20, '2025-10-09 17:58:47', '2025-10-09 17:58:47', NULL),
(21, 'mdbootstrap', 'https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.3.1/css/mdb.min.css', NULL, 1, 'theme', 21, '2025-10-09 17:58:47', '2025-10-09 17:58:47', NULL),
(22, 'Litera', 'https://maxcdn.bootstrapcdn.com/bootswatch/4.3.1/litera/bootstrap.min.css', NULL, 1, 'theme', 22, '2025-10-09 17:58:47', '2025-10-09 17:58:47', NULL),
(23, 'Lux', 'https://maxcdn.bootstrapcdn.com/bootswatch/4.3.1/lux/bootstrap.min.css', NULL, 1, 'theme', 23, '2025-10-09 17:58:47', '2025-10-09 17:58:47', NULL),
(24, 'Materia', 'https://maxcdn.bootstrapcdn.com/bootswatch/4.3.1/materia/bootstrap.min.css', NULL, 1, 'theme', 24, '2025-10-09 17:58:47', '2025-10-09 17:58:47', NULL),
(25, 'Minty', 'https://maxcdn.bootstrapcdn.com/bootswatch/4.3.1/minty/bootstrap.min.css', NULL, 1, 'theme', 25, '2025-10-09 17:58:47', '2025-10-09 17:58:47', NULL),
(26, 'Pulse', 'https://maxcdn.bootstrapcdn.com/bootswatch/4.3.1/pulse/bootstrap.min.css', NULL, 1, 'theme', 26, '2025-10-09 17:58:47', '2025-10-09 17:58:47', NULL),
(27, 'Sketchy', 'https://maxcdn.bootstrapcdn.com/bootswatch/4.3.1/sketchy/bootstrap.min.css', NULL, 1, 'theme', 27, '2025-10-09 17:58:47', '2025-10-09 17:58:47', NULL),
(28, 'Solar', 'https://maxcdn.bootstrapcdn.com/bootswatch/4.3.1/solar/bootstrap.min.css', NULL, 1, 'theme', 28, '2025-10-09 17:58:47', '2025-10-09 17:58:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tours`
--

CREATE TABLE `tours` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guide_id` bigint(20) UNSIGNED NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `max_seats` int(11) NOT NULL DEFAULT 10,
  `remaining_seats` int(11) NOT NULL DEFAULT 0,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `status` enum('available','full','in_progress','completed','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'available',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tours`
--

INSERT INTO `tours` (`id`, `title`, `description`, `guide_id`, `start_date`, `end_date`, `max_seats`, `remaining_seats`, `price`, `status`, `created_at`, `updated_at`) VALUES
(1, 'tour 1', '<div>tour 2</div>', 1, '2025-10-12 19:57:33', '2025-10-16 22:58:00', 10, 0, '22.00', 'completed', '2025-10-11 17:03:40', '2025-10-31 19:11:31'),
(2, 'tour guide', NULL, 3, '2025-10-12 21:26:02', '2025-10-15 00:26:00', 30, 20, '300.00', 'completed', '2025-10-12 18:26:27', '2025-10-31 19:09:30'),
(3, 'tour3', '<div>fdgdfgfdgfd</div>', 1, '2025-10-14 07:49:08', '2025-10-15 22:49:00', 45, 45, '500.00', 'in_progress', '2025-10-14 16:49:35', '2025-10-25 15:22:34'),
(4, 'tour 3', '<div>test tour</div>', 3, '2025-10-26 16:44:42', '2025-10-30 19:45:00', 20, 2, '300.00', 'in_progress', '2025-10-25 13:50:05', '2025-10-31 19:10:09'),
(5, 'جولة1', '<div>جولة 1</div>', 3, '2025-10-27 17:29:40', '2025-10-29 20:29:00', 44, 44, '33.00', 'in_progress', '2025-10-26 14:32:59', '2025-10-31 19:10:09'),
(6, 'fggg', '<div>444444444444</div>', 1, '2025-10-31 23:04:42', '2025-11-06 02:04:00', 44, 44, '55.00', 'available', '2025-10-31 20:05:01', '2025-10-31 20:05:01'),
(7, 'ewr', '<div>333333333333</div>', 1, '2025-11-04 10:49:09', '2025-11-06 13:49:00', 33, 0, '33.00', 'full', '2025-11-03 07:49:33', '2025-11-03 08:07:41');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activated` tinyint(1) NOT NULL DEFAULT 0,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `signup_ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `signup_confirmation_ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `signup_sm_ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin_ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `first_name`, `last_name`, `email`, `email_verified_at`, `password`, `activated`, `token`, `signup_ip_address`, `signup_confirmation_ip_address`, `signup_sm_ip_address`, `admin_ip_address`, `updated_ip_address`, `deleted_ip_address`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'lruecker', 'Gerda', 'Ruecker', 'admin@user.com', NULL, '$2y$10$29GLRz1VhyhulCgG45s/WuLuUDtuKdJ9KJMPsuqUD2bKobyjCacYG', 1, 'SEYMVURx2EtMuhhpDpuVff2g32Dtc9zs6ifJ3PjrZ034zlv9wl01PX60gYs0PRju', '199.62.19.229', '42.111.31.234', NULL, NULL, '0.0.0.0', NULL, 'vUmAPPH6YAklTsfcbXPIYpMMbiPMsO7PLtQ7CQGPMYLZ4i2fLn3YV7bVRG84', '2025-10-09 18:22:17', '2025-10-09 19:18:36', NULL),
(2, 'johnpaul84', 'Adrien', 'Huel', 'user@user.com', NULL, '$2y$10$3w3JpmYSJASJNAp6iT7ITucy4vxd15L/ryD7rWjHR7kje6MtTnKrW', 1, 'rbtPvoZzrLLdYuZKTGkzeT4uBHSs0BCHFMLlev2N2Jnj2E1jt1ikhYEE9C4x9zAP', '60.130.4.123', '4.218.15.43', NULL, NULL, NULL, NULL, 'RvYAdqGpQONz6HwXjAVbWmUfmOz0ZBe5uTAL3g8daMb64wplPqB57NceEYoG', '2025-10-09 18:22:17', '2025-10-09 18:22:17', NULL),
(3, 'slangworth', 'Jessy', 'Hagenes', 'guide@user.com', NULL, '$2y$10$i8zJmMdYI1e.0V5zf4p3xuNPwh5Yj//TgW3GvbNs0L49B3f.lLKfW', 1, 'FoswB5d9Sa4AUdFGSASSUM3i2X0qgd3IGF9oR51aQpA03Q4anse5uFIWKy4bdae1', '85.47.76.97', '103.232.17.211', NULL, NULL, NULL, NULL, 'e91WFL3mPHkYnIUOKY5UGRYb1J4Z8irT5GO0xqI2ymJyj6PLS6Lrd1Wuwunc', '2025-10-09 18:22:17', '2025-10-09 18:22:17', NULL),
(4, 'Gamal_Alkady', 'Gamal', 'Alkady', 'gamal333re@gmail.com', NULL, '$2y$10$vDnPMdYWEWh4FcrhbFk45epThtvm11Lrr2BqXKyeTwrL/DTPTTFYi', 1, 'AMcFgjKhOMhcEa2S7D7rdzOCrxwMZaPqAqJTQwmlC727y7L31OxgGxPUYulKmRsr', '0.0.0.0', '0.0.0.0', NULL, NULL, NULL, NULL, NULL, '2025-10-22 14:58:36', '2025-10-22 15:01:53', NULL),
(5, 'gamal_alqadi', 'Gamal', 'Alqadi', 'gamal333ge@gmail.com', NULL, '$2y$10$ZAzlI3Bm11i2l2pWbFF43OjhkGzDk1HP4PgAlZsULkIG0PMh5du2y', 1, 'gZ7r9M4r5tZ8lF4SpSsOy5ABp1uAMWYCe0ZI0qg9opLRkGleMIpbmAF7yc0fdlJB', '0.0.0.0', '0.0.0.0', NULL, NULL, NULL, NULL, NULL, '2025-11-02 13:42:51', '2025-11-02 13:44:01', NULL),
(6, 'ggggggggg', 'mmm', 'mmmmm', 'm@user.com', NULL, '$2y$10$SFROdmFVRWSR9hD8iwo5qucohtVdbAfrdOwx15FTdIIFpgGFvQUPK', 0, 'tF2Xvx7AlvKQxITFcsLAXeXIQGXfbU2F9CAwNx4AlqHIfaHZsCaSdYChHbZOyO06', '0.0.0.0', NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-02 15:44:37', '2025-11-02 15:44:37', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activations`
--
ALTER TABLE `activations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activations_user_id_index` (`user_id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat_messages`
--
ALTER TABLE `chat_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chat_messages_chat_room_id_foreign` (`chat_room_id`),
  ADD KEY `chat_messages_user_id_foreign` (`user_id`);

--
-- Indexes for table `chat_rooms`
--
ALTER TABLE `chat_rooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chat_rooms_guide_id_foreign` (`guide_id`);

--
-- Indexes for table `chat_room_user`
--
ALTER TABLE `chat_room_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chat_room_user_chat_room_id_foreign` (`chat_room_id`),
  ADD KEY `chat_room_user_user_id_foreign` (`user_id`);

--
-- Indexes for table `conversations`
--
ALTER TABLE `conversations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `districts_name_unique` (`name`);

--
-- Indexes for table `email_log`
--
ALTER TABLE `email_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `laravel2step`
--
ALTER TABLE `laravel2step`
  ADD PRIMARY KEY (`id`),
  ADD KEY `laravel2step_userid_index` (`userId`);

--
-- Indexes for table `laravel_blocker`
--
ALTER TABLE `laravel_blocker`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `laravel_blocker_value_unique` (`value`),
  ADD KEY `laravel_blocker_typeid_index` (`typeId`),
  ADD KEY `laravel_blocker_userid_index` (`userId`);

--
-- Indexes for table `laravel_blocker_types`
--
ALTER TABLE `laravel_blocker_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `laravel_blocker_types_slug_unique` (`slug`);

--
-- Indexes for table `laravel_logger_activity`
--
ALTER TABLE `laravel_logger_activity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_conversation_id_foreign` (`conversation_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_slug_unique` (`slug`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permission_role_permission_id_index` (`permission_id`),
  ADD KEY `permission_role_role_id_index` (`role_id`);

--
-- Indexes for table `permission_user`
--
ALTER TABLE `permission_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permission_user_permission_id_index` (`permission_id`),
  ADD KEY `permission_user_user_id_index` (`user_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `places`
--
ALTER TABLE `places`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `placetypes`
--
ALTER TABLE `placetypes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `place_tour`
--
ALTER TABLE `place_tour`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `profiles_contact_unique` (`contact`),
  ADD KEY `profiles_theme_id_foreign` (`theme_id`),
  ADD KEY `profiles_user_id_index` (`user_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_slug_unique` (`slug`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_user_role_id_index` (`role_id`),
  ADD KEY `role_user_user_id_index` (`user_id`);

--
-- Indexes for table `social_logins`
--
ALTER TABLE `social_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `social_logins_user_id_index` (`user_id`);

--
-- Indexes for table `themes`
--
ALTER TABLE `themes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `themes_name_unique` (`name`),
  ADD UNIQUE KEY `themes_link_unique` (`link`),
  ADD KEY `themes_taggable_type_taggable_id_index` (`taggable_type`,`taggable_id`),
  ADD KEY `themes_id_index` (`id`);

--
-- Indexes for table `tours`
--
ALTER TABLE `tours`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tours_guide_id_foreign` (`guide_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_name_unique` (`name`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activations`
--
ALTER TABLE `activations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `chat_messages`
--
ALTER TABLE `chat_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `chat_rooms`
--
ALTER TABLE `chat_rooms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `chat_room_user`
--
ALTER TABLE `chat_room_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `conversations`
--
ALTER TABLE `conversations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `email_log`
--
ALTER TABLE `email_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `laravel2step`
--
ALTER TABLE `laravel2step`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `laravel_blocker`
--
ALTER TABLE `laravel_blocker`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `laravel_blocker_types`
--
ALTER TABLE `laravel_blocker_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `laravel_logger_activity`
--
ALTER TABLE `laravel_logger_activity`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `permission_role`
--
ALTER TABLE `permission_role`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `permission_user`
--
ALTER TABLE `permission_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `places`
--
ALTER TABLE `places`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `placetypes`
--
ALTER TABLE `placetypes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `place_tour`
--
ALTER TABLE `place_tour`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `social_logins`
--
ALTER TABLE `social_logins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `themes`
--
ALTER TABLE `themes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tours`
--
ALTER TABLE `tours`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activations`
--
ALTER TABLE `activations`
  ADD CONSTRAINT `activations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `chat_messages`
--
ALTER TABLE `chat_messages`
  ADD CONSTRAINT `chat_messages_chat_room_id_foreign` FOREIGN KEY (`chat_room_id`) REFERENCES `chat_rooms` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `chat_messages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `chat_rooms`
--
ALTER TABLE `chat_rooms`
  ADD CONSTRAINT `chat_rooms_guide_id_foreign` FOREIGN KEY (`guide_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `chat_room_user`
--
ALTER TABLE `chat_room_user`
  ADD CONSTRAINT `chat_room_user_chat_room_id_foreign` FOREIGN KEY (`chat_room_id`) REFERENCES `chat_rooms` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `chat_room_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `laravel2step`
--
ALTER TABLE `laravel2step`
  ADD CONSTRAINT `laravel2step_userid_foreign` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `laravel_blocker`
--
ALTER TABLE `laravel_blocker`
  ADD CONSTRAINT `laravel_blocker_typeid_foreign` FOREIGN KEY (`typeId`) REFERENCES `laravel_blocker_types` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_conversation_id_foreign` FOREIGN KEY (`conversation_id`) REFERENCES `conversations` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `permission_user`
--
ALTER TABLE `permission_user`
  ADD CONSTRAINT `permission_user_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permission_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `profiles`
--
ALTER TABLE `profiles`
  ADD CONSTRAINT `profiles_theme_id_foreign` FOREIGN KEY (`theme_id`) REFERENCES `themes` (`id`),
  ADD CONSTRAINT `profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `social_logins`
--
ALTER TABLE `social_logins`
  ADD CONSTRAINT `social_logins_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tours`
--
ALTER TABLE `tours`
  ADD CONSTRAINT `tours_guide_id_foreign` FOREIGN KEY (`guide_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
