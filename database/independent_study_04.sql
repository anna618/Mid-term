-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- 主機： localhost
-- 產生時間： 2021 年 09 月 26 日 17:16
-- 伺服器版本： 10.4.20-MariaDB
-- PHP 版本： 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫: `independent_study_04`
--

-- --------------------------------------------------------

--
-- 資料表結構 `db_evaluation`
--

CREATE TABLE `db_evaluation` (
  `id` int(10) NOT NULL,
  `order_id` int(10) NOT NULL,
  `content` varchar(50) NOT NULL,
  `images` varchar(50) DEFAULT NULL,
  `star` int(10) NOT NULL,
  `created_time` datetime NOT NULL,
  `deleted_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `db_evaluation`
--

INSERT INTO `db_evaluation` (`id`, `order_id`, `content`, `images`, `star`, `created_time`, `deleted_time`) VALUES
(1, 5, '好吃', '', 5, '2021-09-14 11:25:52', '2021-09-14 11:25:58'),
(2, 5, '好吃', '1631590682.jpg', 3, '2021-09-14 11:38:02', NULL);

-- --------------------------------------------------------

--
-- 資料表結構 `db_message_board`
--

CREATE TABLE `db_message_board` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `petSitter_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `created_time` datetime NOT NULL,
  `deleted_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `db_message_board`
--

INSERT INTO `db_message_board` (`id`, `user_id`, `petSitter_id`, `title`, `content`, `created_time`, `deleted_time`) VALUES
(1, 13, 8, '寵物住宿寄養 | 星心寶貝寄養趣', '很用心的照顧家裡的狗狗，希望下次還有機會給妳服務	', '2021-09-13 12:00:01', '2021-09-13 14:50:16'),
(2, 1, 2, '寵物住宿寄養 | Jurmol’s House', '我們家的狗狗寄養了4個晚上，每天都會傳照片給我看狗狗的狀態，感覺每天都過的很開心，很謝謝這幾天得照顧～', '2021-09-13 12:00:44', '2021-09-13 18:18:45'),
(3, 2, 4, '寵物住宿寄養 | 星心寶貝寄養趣', '非常細心的照顧，每天都會傳照片給主人看讓他放心，狗狗也適應的很好', '2021-09-13 11:18:59', NULL),
(4, 3, 8, '寵物住宿寄養 | 捉迷腸', '蔡先生非常用心細心，讓第一次把兒子給不認識的人照顧的我，真的感到非常非常非常的安心放心！隨時回傳寶貝的狀況，吃飯上廁所狀況也都會告訴主人，真的非常值得！寶貝心情也非常的好~~大推有機會一定還會再將寶貝交給蔡先生照顧！	', '2021-09-13 11:24:40', NULL),
(5, 4, 12, '寵物住宿寄養 | Mini’s Boarding House', '這幾天以來很謝謝你們細心的照顧 每天都會傳送玩樂的影片及美味可口的鮮食 ', '2021-09-13 11:18:24', NULL),
(6, 5, 2, '遛狗服務 | Melissa Walks With Dogs', '走馬路時 會注意要讓狗狗走裡面比較不危險。 會跟狗狗說說話 並且讓狗狗先走完公園一圈後，再讓狗狗走自己喜歡的 看看松鼠， 讓狗狗運動 跟興趣都可以做：）', '2021-09-13 11:18:09', NULL),
(7, 7, 2, '寵物住宿寄養 | 星心寶貝寄養趣', '真的是找到最喜歡的保姆。 溫柔貼心Debbie感覺也很快樂', '2021-09-13 11:16:31', NULL),
(8, 8, 12, '寵物住宿寄養 | 台南開心狗開心貓住宿', 'Chloe很用心的陪伴跟照顧，每天都會上傳陪伴bubble的照片跟影片，讓我們很安心。非常值得推薦及再訪', '2021-09-13 11:17:48', NULL),
(9, 9, 4, '寵物住宿寄養 | 近桃園機場南崁果林小毛宅', 'She did a wonderful job taking care of my dog for 4 nights. She really loves dogs.', '2021-09-13 11:20:35', NULL),
(10, 10, 2, '寵物住宿寄養 | 星心寶貝寄養趣', '謝謝這麼照顧我狗狗', '2021-09-13 11:20:54', NULL),
(11, 11, 2, '寵物住宿寄養 | Jurmol’s House', '感謝細心照顧 Angel很開心 讓我們出門在外也能很安心	', '2021-09-13 11:21:14', NULL),
(12, 12, 2, '寵物住宿寄養 | Mini’s Boarding House', '非常感謝，每日都有照片與影片分享，非常放心	', '2021-09-13 11:21:35', NULL);

-- --------------------------------------------------------

--
-- 資料表結構 `db_message_board_images`
--

CREATE TABLE `db_message_board_images` (
  `id` int(10) UNSIGNED NOT NULL,
  `message_board_id` int(10) UNSIGNED NOT NULL,
  `image_name` varchar(50) NOT NULL,
  `created_time` datetime NOT NULL,
  `deleted_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `db_message_board_images`
--

INSERT INTO `db_message_board_images` (`id`, `message_board_id`, `image_name`, `created_time`, `deleted_time`) VALUES
(1, 1, '1631503647.jpeg', '2021-09-13 11:27:27', '2021-09-13 14:50:16'),
(2, 2, '1631502375.jpeg', '2021-09-13 11:06:15', '2021-09-13 18:18:45'),
(3, 3, '1631502421.jpeg', '2021-09-13 11:07:01', NULL),
(4, 4, '1631502449.jpeg', '2021-09-13 11:07:29', NULL),
(5, 5, '1631502473.jpeg', '2021-09-13 11:07:53', NULL),
(6, 6, '1631502507.jpeg', '2021-09-13 11:08:27', NULL),
(7, 7, '1631502534.jpeg', '2021-09-13 11:08:54', NULL),
(8, 8, '1631502898.jpeg', '2021-09-13 11:14:58', NULL),
(9, 9, '1631503225.jpeg', '2021-09-13 11:20:25', NULL),
(10, 10, '1631503254.jpeg', '2021-09-13 11:20:54', NULL),
(11, 11, '1631503274.jpeg', '2021-09-13 11:21:14', NULL),
(12, 12, '1631503295.jpeg', '2021-09-13 11:21:35', NULL);

-- --------------------------------------------------------

--
-- 資料表結構 `db_order`
--

CREATE TABLE `db_order` (
  `id` int(11) NOT NULL,
  `pet_id` int(11) NOT NULL,
  `pre_time` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `buyer_id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `deleted_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `db_order`
--

INSERT INTO `db_order` (`id`, `pet_id`, `pre_time`, `address`, `price`, `buyer_id`, `seller_id`, `status`, `created_time`, `deleted_time`) VALUES
(1, 1, '2021-09-13 08:00-12:00', '桃園市中壢區民族路三段390號', 500, 1, 2, 3, '2021-09-12 02:17:54', NULL),
(2, 3, '2021-09-13 12:00-14:00', '桃園市中壢區中正路1215號', 500, 3, 4, 2, '2021-09-13 16:02:45', NULL),
(3, 1, '2021-09-14 12:00-16:00', '桃園市中壢區延平路477號', 600, 4, 5, 3, '2021-09-13 16:04:07', NULL),
(4, 2, '2021-09-20 00:00-04:00', '桃園市中壢區中美路115號', 500, 5, 4, 3, '2021-09-13 16:05:15', NULL),
(5, 2, '2021-09-14 14:00-16:00', '7-11', 8000, 3, 4, 1, '2021-09-14 11:13:16', NULL),
(6, 3, '2021-09-14 14:00-16:00', '全家', 800, 2, 3, 3, '2021-09-14 11:25:08', '2021-09-14 11:25:36'),
(7, 3, '2021-09-30 12:00-14:00', '北車', 2000, 3, 4, 3, '2021-09-14 11:37:30', '2021-09-14 11:37:47');

-- --------------------------------------------------------

--
-- 資料表結構 `db_order_type`
--

CREATE TABLE `db_order_type` (
  `id` int(11) NOT NULL,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `db_order_type`
--

INSERT INTO `db_order_type` (`id`, `type`) VALUES
(1, '交易進行中'),
(2, '完成交易'),
(3, '取消交易');

-- --------------------------------------------------------

--
-- 資料表結構 `db_pet`
--

CREATE TABLE `db_pet` (
  `id` int(5) UNSIGNED NOT NULL,
  `user_id` int(4) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `DOB` date NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `images` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_time` datetime NOT NULL,
  `deleted_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `db_pet`
--

INSERT INTO `db_pet` (`id`, `user_id`, `name`, `gender`, `DOB`, `content`, `images`, `created_time`, `deleted_time`) VALUES
(1, 1, 'Money', 'female', '2016-08-18', '活潑、愛吃', 'pet_1.jpeg', '2021-08-31 15:56:31', NULL),
(2, 2, 'Lucy', 'male', '2014-04-14', '膽小、害怕、內向', 'pet_2.jpeg', '2021-08-31 15:56:31', NULL),
(3, 3, 'Andy', 'female', '2019-02-18', '挑食、不怕生、親狗', 'pet_3.jpeg', '2021-08-31 15:59:20', NULL),
(4, 3, 'Amy', 'male', '2015-11-19', '怕打雷、親人親狗', 'pet_4.jpeg', '2021-08-31 15:59:20', NULL),
(5, 5, 'Jojo', 'male', '2021-06-18', '不親人、喜歡跟小狗玩', 'dog.jpeg', '2021-08-31 16:01:10', NULL),
(6, 4, 'Yumi', 'female', '2015-07-22', '討厭洗澡、喜歡玩水', 'pet_6.jpeg', '2021-09-13 00:59:13', NULL),
(7, 1, 'Coco', 'male', '2015-10-16', '愛吃鬼', 'pet_7.jpeg', '2021-09-13 01:00:05', NULL),
(8, 4, 'pippi', 'male', '2016-07-07', '愛撒嬌、超愛草原', 'pet_8.jpeg', '2021-09-13 01:01:04', NULL),
(9, 5, 'Honey', 'male', '2014-10-28', '喜歡曬太陽、討厭小小狗', 'pet_9.jpeg', '2021-09-13 01:02:24', NULL),
(10, 3, 'Fany', 'male', '2013-10-17', '喜歡玩水、吃水果', 'pet_10.jpeg', '2021-09-13 01:03:05', NULL),
(11, 2, 'Andy', 'female', '2018-03-02', '討厭剪指甲', 'pet_11.jpeg', '2021-09-13 01:04:09', NULL),
(12, 6, 'Hanry', 'male', '2021-05-01', '喜歡繞圈圈', 'pet_12.jpeg', '2021-09-13 01:05:25', NULL);

-- --------------------------------------------------------

--
-- 資料表結構 `db_petsitter_worktime`
--

CREATE TABLE `db_petsitter_worktime` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(25) CHARACTER SET latin1 NOT NULL,
  `price` int(5) NOT NULL,
  `start_event` datetime NOT NULL,
  `end_event` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `db_petsitter_worktime`
--

INSERT INTO `db_petsitter_worktime` (`id`, `title`, `price`, `start_event`, `end_event`) VALUES
(53, 'free', 900, '2021-09-02 08:00:00', '2021-09-02 12:00:00'),
(54, 'free ', 900, '2021-08-31 12:00:00', '2021-08-31 16:00:00'),
(55, 'free', 900, '2021-08-30 16:00:00', '2021-08-30 20:00:00'),
(56, 'Booked', 900, '2021-09-02 16:00:00', '2021-09-02 20:00:00'),
(57, 'Booked', 900, '2021-09-03 12:00:00', '2021-09-03 16:00:00');

-- --------------------------------------------------------

--
-- 資料表結構 `db_user`
--

CREATE TABLE `db_user` (
  `id` int(4) UNSIGNED NOT NULL,
  `account` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `DOB` date NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `images` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 1 COMMENT '1 general\r\n2 babysitter',
  `created_time` datetime NOT NULL,
  `deleted_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `db_user`
--

INSERT INTO `db_user` (`id`, `account`, `password`, `name`, `gender`, `address`, `DOB`, `phone`, `images`, `status`, `created_time`, `deleted_time`) VALUES
(1, 'kiwi@test.com', '123456', 'Kiwi', 'male', '新北市三峽區', '1999-08-27', '0911000111', 'user_1.jpeg', 1, '2021-08-31 14:43:34', NULL),
(2, 'banana@test.com', '123456', 'Banana', 'female', '台北市大同區', '1991-11-12', '0911000222', 'user_2.jpeg', 2, '2021-08-31 15:17:53', NULL),
(3, 'apple@test.com', '123456', 'Apple', 'male', '台北市中正區', '2001-04-18', '0911000333', 'user_3.jpeg', 1, '2021-08-31 15:27:22', NULL),
(4, 'orange@test.com', '123456', 'Orange', 'male', '新北市蘆洲區', '1988-06-19', '0911000444', 'user_4.jpeg', 2, '2021-08-31 15:31:03', NULL),
(5, 'cantaloupe@test.com', '123456', 'Cantaloupe', 'male', '新北市新莊區', '2004-11-30', '0911000555', 'user_5.jpeg', 1, '2021-08-31 15:31:03', NULL),
(7, 'Hery@test.com', '123456', 'Hery', 'male', '新北市新莊區', '1972-03-26', '0911000111', 'user_6.jpeg', 1, '2021-09-13 08:45:28', NULL),
(8, 'hamburger@test.com', '123456', 'Hamburger', 'male', '新北市土城區', '1968-09-27', '0911000222', 'user_7.jpeg', 2, '2021-09-13 08:48:55', NULL),
(9, 'juice@test.com', '123456', 'Juice', 'female', '台北市信義區', '1984-10-25', '0900111666', 'user_8.jpeg', 1, '2021-09-13 08:49:58', NULL),
(10, 'lenmon@tset.com', '123456', 'Lenmon', 'male', '台北市中正區', '1987-12-29', '0911222333', 'user_9.jpeg', 1, '2021-09-13 08:51:25', NULL),
(11, 'pinapple@test.com', '123456', 'Pinapple', 'male', '新北市淡水區', '1971-02-22', '0911000888', 'user_10.jpeg', 1, '2021-09-13 08:52:21', NULL),
(12, 'milk@test.com', '123456', 'Milk', 'male', '新北市汐止區', '1983-11-02', '0900111999', 'user_11.jpeg', 2, '2021-09-13 08:53:16', NULL),
(13, 'mango@test.com', '123456', 'Mango', 'female', '新北市九份區', '1972-08-09', '0900111999', 'user_12.jpeg', 1, '2021-09-13 08:54:39', NULL);

-- --------------------------------------------------------

--
-- 資料表結構 `users`
--

CREATE TABLE `users` (
  `id` int(4) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_time` datetime NOT NULL,
  `deleted_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `gender`, `password`, `created_time`, `deleted_time`) VALUES
(2, 'dog', 'admin@gmail.com', 'male', '827ccb0eea8a706c4c34a16891f84e7b', '2021-08-19 15:56:54', NULL);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `db_evaluation`
--
ALTER TABLE `db_evaluation`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `db_message_board`
--
ALTER TABLE `db_message_board`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `db_message_board_images`
--
ALTER TABLE `db_message_board_images`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `db_order`
--
ALTER TABLE `db_order`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `db_order_type`
--
ALTER TABLE `db_order_type`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `db_pet`
--
ALTER TABLE `db_pet`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `db_petsitter_worktime`
--
ALTER TABLE `db_petsitter_worktime`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `db_user`
--
ALTER TABLE `db_user`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `db_evaluation`
--
ALTER TABLE `db_evaluation`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `db_message_board`
--
ALTER TABLE `db_message_board`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `db_message_board_images`
--
ALTER TABLE `db_message_board_images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `db_order`
--
ALTER TABLE `db_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `db_order_type`
--
ALTER TABLE `db_order_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `db_pet`
--
ALTER TABLE `db_pet`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `db_petsitter_worktime`
--
ALTER TABLE `db_petsitter_worktime`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `db_user`
--
ALTER TABLE `db_user`
  MODIFY `id` int(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `users`
--
ALTER TABLE `users`
  MODIFY `id` int(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
