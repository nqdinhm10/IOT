-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 03, 2022 lúc 10:28 AM
-- Phiên bản máy phục vụ: 10.4.21-MariaDB
-- Phiên bản PHP: 7.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `sensor`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dht22`
--

CREATE TABLE `dht22` (
  `id` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `temperature` float NOT NULL,
  `humidity` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `dht22`
--

INSERT INTO `dht22` (`id`, `datetime`, `temperature`, `humidity`) VALUES
(1, '2022-02-17 17:18:26', 30.8, 91.8),
(2, '2022-02-23 10:20:06', 30.5, 91.2),
(3, '2022-02-23 10:20:41', 29.2, 93.1),
(4, '2022-02-23 10:27:56', 31.5, 91.2),
(5, '2022-02-23 10:29:05', 29.2, 93.1),
(6, '2022-02-23 10:39:46', 28.2, 94.2),
(7, '2022-02-23 10:45:38', 30.5, 91.2),
(8, '2022-02-23 10:47:38', 28.2, 91.2),
(9, '2022-02-26 15:59:49', 30.5, 93.1),
(10, '2022-02-26 16:00:03', 30.5, 91.2),
(11, '2022-02-26 16:30:17', 30.5, 91.2),
(12, '2022-02-27 09:09:09', 30.5, 93.1),
(13, '2022-02-27 09:10:39', 31.5, 91.2),
(14, '2022-02-27 10:59:07', 30.5, 94.2),
(15, '2022-02-27 18:32:29', 30.5, 93.1),
(16, '2022-02-27 18:33:08', 29.2, 94.2),
(17, '2022-02-28 16:56:31', 30.5, 91.2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `mq135`
--

CREATE TABLE `mq135` (
  `datetime` datetime NOT NULL,
  `quality` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `mq135`
--

INSERT INTO `mq135` (`datetime`, `quality`) VALUES
('2022-02-17 15:16:46', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `userId` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userEmail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userPhone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userPass` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` int(10) NOT NULL,
  `status` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`userId`, `userName`, `userEmail`, `userPhone`, `userPass`, `image`, `level`, `status`) VALUES
('nguyennhi0200', 'Nguyễn Thị Yến Nhi', 'nguyennhi0200@gmail.com', '0522944955', '123456', '3ebe17c5c3.jpg', 1, 0),
('nqdinhm10', 'Nguyễn Quan Dinh', 'nqdinhm10@gmail.com', '0987939081', '7813384ab02fb324726a636f9d9a5889', 'b8b38040ca.jpg', 0, 0);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `dht22`
--
ALTER TABLE `dht22`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `mq135`
--
ALTER TABLE `mq135`
  ADD PRIMARY KEY (`datetime`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `dht22`
--
ALTER TABLE `dht22`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
