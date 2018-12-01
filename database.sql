CREATE DATABASE IF NOT EXISTS `laragram` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `laragram`;

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `user_id` int(255) DEFAULT NULL,
  `image_id` int(255) DEFAULT NULL,
  `content` mediumtext COLLATE utf8_spanish_ci,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_comments_users` (`user_id`),
  KEY `fk_comments_images` (`image_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE IF NOT EXISTS `follows` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `follower` int(255) DEFAULT NULL,
  `followed` int(255) DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_follower` (`follower`),
  KEY `fk_followed` (`followed`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE IF NOT EXISTS `images` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `user_id` int(255) DEFAULT NULL,
  `image_path` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `description` mediumtext COLLATE utf8_spanish_ci,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_images_users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE IF NOT EXISTS `likes` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `user_id` int(255) DEFAULT NULL,
  `image_id` int(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_likes_users` (`user_id`),
  KEY `fk_likes_images` (`image_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `username` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `biography` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `remember_token` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

ALTER TABLE `comments`
  ADD CONSTRAINT `fk_comments_images` FOREIGN KEY (`image_id`) REFERENCES `images` (`id`),
  ADD CONSTRAINT `fk_comments_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

ALTER TABLE `images`
  ADD CONSTRAINT `fk_images_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

ALTER TABLE `likes`
  ADD CONSTRAINT `fk_likes_images` FOREIGN KEY (`image_id`) REFERENCES `images` (`id`),
  ADD CONSTRAINT `fk_likes_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;


INSERT INTO `users` (`id`, `fullname`, `username`, `email`, `password`, `image`, `biography`, `created_at`, `updated_at`, `remember_token`) VALUES
(23, 'Milan Bechtelar', 'milanbechtelar', 'effertz.camila@example.com', '$2y$10$FJtmDH0U9wD85NT9d4WP1u.jBLP7oIa78Py6q4Qw3wWcJgHPmz7DS', 'default-user-image.png', NULL, '2018-11-30 16:00:57', '2018-11-30 16:00:57', 'Yr0USyaY8FlNzhJN8mieDV2Ub6Vl9w8NcHCNa5CQoqSll2skfuOtd1wWGcHh'),
(24, 'Jamil Schowalter', 'Jamilschowalter', 'murphy.neil@example.com', '$2y$10$Dt5jqf3xsTDj8MjlVoO14uXTrdaqOzLLWXbbH.e5z5wfqE1UeGzfK', 'default-user-image.png', NULL, '2018-11-30 16:01:24', '2018-11-30 16:01:24', 'QdL0oCiL7GC58dzfumJgKu6nBLvymJ0tu7Hsv7yXnmUNI3NitbhMnm9lu4qL'),
(25, 'Annabel Stantonn', 'Annabelstanton', 'fritsch.tremaine@example.net', '$2y$10$gz2/vfxMK/vqqqYHkqKpheV4UI/pVUdeh.ttU6qsy9SB01snw5dqa', 'default-user-image.png', NULL, '2018-11-30 16:01:47', '2018-11-30 16:01:47', 'mCbIqg17rN2aSz3swga1zG09pOikkQRAoPNsw8Zo1WQYCBz7qdJW0wEGg2wR'),
(26, 'Junior Heller', 'Juniorheller', 'rconnelly@example.net', '$2y$10$jqv9mjUhQuUAfE8CnkRv..wxk.OqatMJ0Xa1tPbchm3rd5FKKgLIC', 'default-user-image.png', NULL, '2018-11-30 16:02:15', '2018-11-30 16:02:15', 'QVKGdX7fYZA551NDZe8xpeVVJWQxXzxAdct5khdr5qpP1YmWXkqRM4hufGRf'),
(27, 'Stone Auer', 'Stoneauer', 'paolo.bogisich@example.com', '$2y$10$57EmnvlNCoYUVlbvVePCP.q5sLS8Agsb29jRH7Z3OtC4BytO2iv7y', 'default-user-image.png', NULL, '2018-11-30 16:02:35', '2018-11-30 16:02:35', 'xLO8cQoH9w5i4tUbUluzQ1to5Vw8SYwNIdOzbd6c3BvUKCtrkVh8MjU1Qpj2'),
(28, 'Virgie Nikolaus', 'Virgienikolaus', 'xbayer@example.com', '$2y$10$1U88IgeeojwGqZoLFtvgbOBivLXwhl0x8UXH.WYHnQJ/nR.EEVlba', 'default-user-image.png', NULL, '2018-11-30 16:02:53', '2018-11-30 16:02:53', 'nwhpdYvixKawQbLD0nC7FdmjAvaTeezh8AHbMeJ6hLsxkvNhZPVMbAYp0uOW'),
(29, 'Irving Pouros', 'Irvingpouros', 'emmitt.jenkins@example.com', '$2y$10$RCIV5VbCfZrc167AG3Jxk.GNS3XGcu7RIEzGtejnX.Lf/xBV/JuD2', 'default-user-image.png', NULL, '2018-11-30 16:03:12', '2018-11-30 16:03:12', 'qF7Leg45MHLXq4KtziSHId32vjZgqhmVaOROOboboYEqkW49jmt5cnEmXA9N'),
(30, 'Kaylee Fay', 'Kayleefay', 'wilkinson.kyla@example.net', '$2y$10$ttm294ulrqALonorGr0KzOQdbmroIrmDDovci13uG817Co.TlFTCu', 'default-user-image.png', NULL, '2018-11-30 16:03:47', '2018-11-30 16:03:47', 'Jby8lmYC2D6N5AWacIjQTQHHx36IcldAKGT8V8VB5q9pKYmUkEthi96tOHEw'),
(31, 'Moses Howe', 'Moseshowe', 'lottie.roberts@example.net', '$2y$10$FWRfEi.eljm1ED1L6qYEVeyoakBAEV.7k8zuGnoddZLKJaDh/Xw6O', 'default-user-image.png', NULL, '2018-11-30 16:04:10', '2018-11-30 16:04:10', 'D2x0egjPSLZLzpKPc8LNOBH9YxLXTzxXYgNg8z094P4UL1clBgmYNgTMPqR6'),
(32, 'Lenny Spencer', 'Lennyspencer', 'leola89@example.net', '$2y$10$/eTvhBdXGoZAQri5v8c.y.ej3TNpUv8wNGXeiihKmtngEzDT.mxJ6', 'default-user-image.png', NULL, '2018-11-30 16:04:29', '2018-11-30 16:04:29', 'IbGLbW2XP9IK92jhFO2FX3Pjb1ECuvJnIb67Qy1IafLLpfmZbGfErDvtES2U'),
(33, 'Cleta Glover', 'Cletaglover', 'darion.rowe@example.org', '$2y$10$ETsHyAiCV2XPSELmrC9YeOkBp4mMQ8Sj92OAgy0CP8hewdh0RYgUy', 'default-user-image.png', NULL, '2018-11-30 16:05:04', '2018-11-30 16:05:04', 'AmmRiNU1pXTT8qUNGpQmrReMNLGfMzszGONW1CWoMvgr3Dz3PXYTiLKPhslD'),
(34, 'Brenna Schroeder', 'Brennaschroeder', 'rosario.heidenreich@example.net', '$2y$10$qfOlgYMaLhuUyF2J1lf.J.2tDiqlb760AZUjOh.233z34taND5QGq', '1543614316estrecharse la mano.jpg', 'lorem ipsum dolor sit amet', '2018-11-30 16:05:27', '2018-11-30 21:45:16', 'ZiYFd2YRKjjypvDcBuQ47ZZVwbIMF8ddCLn7K6KTv0VSOWcF5K6nJ5Q3fa2z'),
(35, 'Marisol Tremblay', 'Marisoltremblay', 'selina32@example.com', '$2y$10$JlT2IsJP1wYOdWcl.ApifOqqJOXQ5pqXRA970I22Do/2PK3s6rKyK', 'default-user-image.png', NULL, '2018-11-30 16:05:51', '2018-11-30 16:05:51', 'lbipfYYj3ZLdbdDTM2v2IBN6WMjEvYZzGuisv56Tjn8jGS07dC90UGPuIUrQ'),
(36, 'Hayden McKenzie', 'Haydenmckenzie', 'oconnell.arvel@example.org', '$2y$10$Q4oiEFdeuVqp0Hx/3.vM3ObSVGQtV3q9byMQ9sSHfDog.zB86yUm6', 'default-user-image.png', NULL, '2018-11-30 16:06:33', '2018-11-30 16:06:33', 'kV9tiI5OVfTmL9okszVlvyEGC6sDHlHkT8dXHYY6VrinI2ICXOtqsyI3q3aq'),
(37, 'Joey Goodwin', 'Joeygoodwin', 'aliyah39@example.com', '$2y$10$fwo6O3gfsQSYwPnh3erh..s1hvnfSbG8zKZrkZLLHAbYKz3cUoB6G', 'default-user-image.png', NULL, '2018-11-30 16:30:20', '2018-11-30 16:30:20', 'ih0j4s64VdWTZzIOsRW35aAg64iG6bMS5VS0acADF9EQ34JtmiMLs9FkJJKR'),
(38, 'Amber Luettgen', 'Amberluettgen', 'schmeler.margarete@example.com', '$2y$10$re6bkPpNly9st6ow1quJJuOrfmY5Uc9HDLDN.GW9stgkLCgUD5rce', '1543596452entrepreneur-733545_1920.jpg', 'Hey there i\'m a web designer', '2018-11-30 16:31:12', '2018-11-30 16:47:32', NULL),
(39, 'Fabiola Barrows', 'Fabiolabarrows', 'purdy.genesis@example.net', '$2y$10$VKP0GfwfiUhjJICa9Uj1XuDqKaC6/yjdbWGb0VMD/pIKBK0YRYu1.', '1543629288Gracias por tu compra.jpg', 'My biography', '2018-12-01 00:09:27', '2018-12-01 01:54:48', NULL);

INSERT INTO `images` (`id`, `user_id`, `image_path`, `description`, `created_at`, `updated_at`) VALUES
(4, 35, '1543593966computer-767776_1920.jpg', 'Lorem ipsum dolor sit amet', '2018-11-30 16:06:06', '2018-11-30 16:06:06'),
(5, 36, '1543594005apple-606761.jpg', 'lorem ipsum dolor sit amet', '2018-11-30 16:06:45', '2018-11-30 16:06:45'),
(6, 37, '1543595435apple-1839873_1920.jpg', 'lorem ipsum dolor sit amet', '2018-11-30 16:30:35', '2018-11-30 16:30:35'),
(7, 37, '1543595445digital-marketing-1725340_1920.jpg', 'lorem ipsum dolor sit amet', '2018-11-30 16:30:45', '2018-11-30 16:30:45'),
(8, 38, '1543595487cms-265125_1920.jpg', 'lorem ipsum dolor sit amet', '2018-11-30 16:31:27', '2018-11-30 16:31:27'),
(9, 38, '1543595498cms-265126_1920.jpg', 'lorem ipsum dolor sit amet', '2018-11-30 16:31:38', '2018-11-30 16:31:38'),
(10, 38, '1543595598computer-767776_1920.jpg', 'lorem ipsum dolor sit amet', '2018-11-30 16:33:18', '2018-11-30 16:33:18'),
(11, 34, '1543614274home-office-593383_1920.jpg', 'Lorem ipsum dolor sit amet', '2018-11-30 21:44:34', '2018-11-30 21:44:34'),
(12, 39, '1543628991busy-2049242_1920.jpg', 'lorem ipsum dolor sit amet', '2018-12-01 01:49:51', '2018-12-01 01:49:51'),
(13, 39, '1543629238computer-767776_1920.jpg', 'lorem ipsum dolor sit amet', '2018-12-01 01:53:58', '2018-12-01 01:53:58');

INSERT INTO `comments` (`id`, `user_id`, `image_id`, `content`, `created_at`, `updated_at`) VALUES
(1, 38, 10, 'hey', '2018-11-30 16:35:29', '2018-11-30 16:35:29'),
(2, 38, 5, 'Awesome', '2018-11-30 16:37:01', '2018-11-30 16:37:01'),
(3, 38, 9, 'Nice', '2018-11-30 16:52:53', '2018-11-30 16:52:53');

INSERT INTO `follows` (`id`, `follower`, `followed`, `updated_at`, `created_at`) VALUES
(10, 34, 37, '2018-11-30', '2018-11-30'),
(13, 39, 34, '2018-12-01', '2018-12-01'),
(15, 41, 39, '2018-12-01', '2018-12-01'),
(12, 39, 38, '2018-12-01', '2018-12-01'),
(14, 39, 36, '2018-12-01', '2018-12-01');

INSERT INTO `likes` (`id`, `user_id`, `image_id`, `created_at`, `updated_at`) VALUES
(1, 38, 8, '2018-11-30 16:47:43', '2018-11-30 16:47:43'),
(2, 38, 9, '2018-11-30 16:52:57', '2018-11-30 16:52:57'),
(5, 38, 4, '2018-11-30 16:54:13', '2018-11-30 16:54:13'),
(6, 38, 5, '2018-11-30 16:54:22', '2018-11-30 16:54:22'),
(7, 38, 6, '2018-11-30 16:54:25', '2018-11-30 16:54:25'),
(8, 38, 7, '2018-11-30 16:54:27', '2018-11-30 16:54:27'),
(9, 34, 10, '2018-11-30 21:45:26', '2018-11-30 21:45:26'),
(10, 34, 8, '2018-11-30 21:45:30', '2018-11-30 21:45:30'),
(11, 34, 7, '2018-11-30 21:45:32', '2018-11-30 21:45:32'),
(13, 39, 9, '2018-12-01 00:15:22', '2018-12-01 00:15:22'),
(14, 39, 8, '2018-12-01 00:15:25', '2018-12-01 00:15:25'),
(15, 39, 12, '2018-12-01 01:54:34', '2018-12-01 01:54:34');