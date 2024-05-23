-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2024-05-23 08:03:29
-- サーバのバージョン： 10.4.32-MariaDB
-- PHP のバージョン: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `enshu`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `livelist`
--

CREATE TABLE `livelist` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `artist` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `day` date DEFAULT NULL,
  `daytime` time DEFAULT NULL,
  `number_of_people` int(11) DEFAULT NULL,
  `flag` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- テーブルのデータのダンプ `livelist`
--

INSERT INTO `livelist` (`id`, `name`, `artist`, `address`, `day`, `daytime`, `number_of_people`, `flag`) VALUES
(1, 'aaa', 'a1', '東京都', '2024-06-22', '18:00:00', 800, 1),
(2, 'aaa', 'a1', '神奈川', '2024-06-23', '18:00:00', 500, 1),
(3, 'bbb', 'b1', '東京都', '2024-06-22', '18:00:00', 8000, 0),
(4, 'bbb', 'b1', '東京都', '2024-06-23', '18:00:00', 8000, 0),
(5, 'ccc', 'c1', '東京都', '2024-06-22', '15:00:00', 5000, 1),
(6, 'ccc', 'c1', '東京都', '2024-06-22', '18:00:00', 5000, 1),
(7, 'ddd', 'd1', '神奈川', '2024-06-22', '18:00:00', 500, 1),
(8, 'test', 'test', '神奈川', '2024-05-25', '18:15:00', NULL, 0),
(9, 'test', 'test', '神奈川', '2024-05-23', '18:30:00', NULL, 0),
(10, '春ツアー', 'モーニング娘。', '東京都', '2024-05-27', '18:00:00', NULL, 1);

-- --------------------------------------------------------

--
-- テーブルの構造 `user`
--

CREATE TABLE `user` (
  `no` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `pass` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- テーブルのデータのダンプ `user`
--

INSERT INTO `user` (`no`, `name`, `pass`) VALUES
(1, 'aaa', 'aaa123'),
(2, 'bbb', 'bbb123'),
(3, 'ccc', 'ccc123'),
(4, 'ddd', 'ddd123'),
(5, 'manager01', 'aaa!!!123'),
(7, 'test111', 'test111'),
(8, 'test222', 'test222'),
(9, 'qqq', 'qqq123');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `livelist`
--
ALTER TABLE `livelist`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`no`),
  ADD UNIQUE KEY `name` (`name`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `livelist`
--
ALTER TABLE `livelist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- テーブルの AUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
