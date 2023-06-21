-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1:3306
-- Üretim Zamanı: 21 Haz 2023, 13:07:55
-- Sunucu sürümü: 8.0.31
-- PHP Sürümü: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `picadict`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `friends`
--

DROP TABLE IF EXISTS `friends`;
CREATE TABLE IF NOT EXISTS `friends` (
  `Email` varchar(100) NOT NULL,
  `Femail` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Tablo döküm verisi `friends`
--

INSERT INTO `friends` (`Email`, `Femail`) VALUES
('didehan@canco.com', 'c.umut_donmez@hotmail.com'),
('c.umut_donmez@hotmail.com', 'didehan@canco.com'),
('zeynep@yılmaz.com', 'didehan@canco.com'),
('didehan@canco.com', 'zeynep@yılmaz.com'),
('zeynep@yılmaz.com', 'c.umut_donmez@hotmail.com'),
('c.umut_donmez@hotmail.com', 'zeynep@yılmaz.com'),
('yakup@han.com', 'zeynep@yılmaz.com'),
('zeynep@yılmaz.com', 'yakup@han.com'),
('debug@ctis.com', 'didehan@canco.com'),
('didehan@canco.com', 'debug@ctis.com'),
('orhan@efe.com', 'c.umut_donmez@hotmail.com'),
('c.umut_donmez@hotmail.com', 'orhan@efe.com'),
('didehan@canco.com', 'orhan@efe.com'),
('orhan@efe.com', 'didehan@canco.com'),
('yakup@han.com', 'c.umut_donmez@hotmail.com'),
('c.umut_donmez@hotmail.com', 'yakup@han.com'),
('yakup@han.com', 'orhan@efe.com'),
('orhan@efe.com', 'yakup@han.com'),
('didehan@canco.com', 'yakup@han.com'),
('yakup@han.com', 'didehan@canco.com'),
('debug@ctis.com', 'yakup@han.com'),
('yakup@han.com', 'debug@ctis.com'),
('zeynep@yılmaz.com', 'orhan@efe.com'),
('orhan@efe.com', 'zeynep@yılmaz.com'),
('debug@ctis.com', 'orhan@efe.com'),
('orhan@efe.com', 'debug@ctis.com'),
('debug@ctis.com', 'c.umut_donmez@hotmail.com'),
('c.umut_donmez@hotmail.com', 'debug@ctis.com');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `likedpost`
--

DROP TABLE IF EXISTS `likedpost`;
CREATE TABLE IF NOT EXISTS `likedpost` (
  `Email` varchar(100) NOT NULL,
  `postId` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Tablo döküm verisi `likedpost`
--

INSERT INTO `likedpost` (`Email`, `postId`) VALUES
('yakup@han.com', 'zeynep@yılmaz.com63f5ee60dee9084453a2d2eda093eaa2b4934e8f.jpeg'),
('debug@ctis.com', 'didehan@canco.comfeb443de4aedabd7346f1a9a6992a78105f625b2.jpeg'),
('debug@ctis.com', 'didehan@canco.com2667e079a1532563672c7d9b122a2ab193427407.jpeg'),
('c.umut_donmez@hotmail.com', 'didehan@canco.coma6f088247d6ca098e798455a852d206ada38efb6.jpeg'),
('orhan@efe.com', 'didehan@canco.com2667e079a1532563672c7d9b122a2ab193427407.jpeg');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `notification`
--

DROP TABLE IF EXISTS `notification`;
CREATE TABLE IF NOT EXISTS `notification` (
  `Email` varchar(100) NOT NULL,
  `NotiFrom` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Tablo döküm verisi `notification`
--

INSERT INTO `notification` (`Email`, `NotiFrom`) VALUES
('ykucuk@kesim.com', 'c.umut_donmez@hotmail.com');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `postId` varchar(200) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Img` varchar(255) NOT NULL,
  `Comment` varchar(1000) NOT NULL,
  `Heart` int NOT NULL,
  `Caption` varchar(100) NOT NULL,
  PRIMARY KEY (`postId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Tablo döküm verisi `posts`
--

INSERT INTO `posts` (`postId`, `Email`, `Img`, `Comment`, `Heart`, `Caption`) VALUES
('c.umut_donmez@hotmail.com61b4ac5ceb066a02e553a4706d75d64fe8016aa6.jpeg', 'c.umut_donmez@hotmail.com', '61b4ac5ceb066a02e553a4706d75d64fe8016aa6.jpeg', 'orhan@efe.com : nabers<br>', 0, 'Hocam Yorulduk'),
('c.umut_donmez@hotmail.comf3e06e314d89c64b0c6442fc4f7020b19f371808.jpeg', 'c.umut_donmez@hotmail.com', 'f3e06e314d89c64b0c6442fc4f7020b19f371808.jpeg', '', 0, 'Ctiske'),
('c.umut_donmez@hotmail.comc493889b17e7ae0449f86f549223ae4bf48a1feb.jpeg', 'c.umut_donmez@hotmail.com', 'c493889b17e7ae0449f86f549223ae4bf48a1feb.jpeg', '', 0, 'YETEEEERR'),
('debug@ctis.com13ceeaebd2be4230d6053355081f8df705642a75.jpeg', 'debug@ctis.com', '13ceeaebd2be4230d6053355081f8df705642a75.jpeg', '', 0, 'ünlü oldum'),
('didehan@canco.com2667e079a1532563672c7d9b122a2ab193427407.jpeg', 'didehan@canco.com', '2667e079a1532563672c7d9b122a2ab193427407.jpeg', 'c.umut_donmez@hotmail.com : harika<br>debug@ctis.com : merhaba<br>debug@ctis.com : adsfafds<br>debug@ctis.com : merhaba<br>debug@ctis.com : <b>hello</b><br>debug@ctis.com : <b>hello</b><br>debug@ctis.com : <b>hello</b><br>', 3, 'kedi molası'),
('didehan@canco.comfeb443de4aedabd7346f1a9a6992a78105f625b2.jpeg', 'didehan@canco.com', 'feb443de4aedabd7346f1a9a6992a78105f625b2.jpeg', '', 1, 'beyin yanması'),
('didehan@canco.coma6f088247d6ca098e798455a852d206ada38efb6.jpeg', 'didehan@canco.com', 'a6f088247d6ca098e798455a852d206ada38efb6.jpeg', '', 1, 'delirdik'),
('orhan@efe.com2f17358d83ea8ad7db14edf0130163b744943122.jpeg', 'orhan@efe.com', '2f17358d83ea8ad7db14edf0130163b744943122.jpeg', '', 0, 'başlangıç'),
('orhan@efe.comf61579b638fad1d6d001dd72a6cdc847a80c2e48.jpeg', 'orhan@efe.com', 'f61579b638fad1d6d001dd72a6cdc847a80c2e48.jpeg', '', 0, 'deniyoruz bişeyler'),
('orhan@efe.com01d561dc5f64acbd6c5023e586488db9d0cef742.jpeg', 'orhan@efe.com', '01d561dc5f64acbd6c5023e586488db9d0cef742.jpeg', '', 0, 'uyuyalım'),
('zeynep@yılmaz.com63f5ee60dee9084453a2d2eda093eaa2b4934e8f.jpeg', 'zeynep@yılmaz.com', '63f5ee60dee9084453a2d2eda093eaa2b4934e8f.jpeg', '', 1, 'slm'),
('zeynep@yılmaz.com0fd4017961e747b738f115ab9dca7943e1559e91.jpeg', 'zeynep@yılmaz.com', '0fd4017961e747b738f115ab9dca7943e1559e91.jpeg', '', 0, 'proje vakti'),
('c.umut_donmez@hotmail.com', 'c.umut_donmez@hotmail.com', '', '', 0, 'Hello'),
('c.umut_donmez@hotmail.comc0cd60ad316b770df808ce4eb4b25aea9effcf91.png', 'c.umut_donmez@hotmail.com', 'c0cd60ad316b770df808ce4eb4b25aea9effcf91.png', '', 0, '');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `Name` varchar(100) NOT NULL,
  `Surname` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Birthday` date NOT NULL,
  `Password` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `ProfilePicture` varchar(100) NOT NULL,
  PRIMARY KEY (`Email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`Name`, `Surname`, `Email`, `Birthday`, `Password`, `ProfilePicture`) VALUES
('Didehan', 'Topsakal', 'didehan@canco.com', '2002-01-24', '$2y$10$O3.ItORBS01NF48YaZqnQ.1L61wLJkV1luK0gKqvYXs3hNaZ.Yh9q', '96.png'),
('Zeynep Havva', 'Yılmaz', 'zeynep@yılmaz.com', '2002-03-11', '$2y$10$zQIsfGzOqAUHRQE9TXaH1OX4Ar73FNsgFWcQ/hHYaE6AHSHdphvfK', '95.png'),
('Yakup', 'Han', 'yakup@han.com', '2023-06-14', '$2y$10$YI8y6K0BDm/PH.75D5YRAu9xKWBjT.EnhJycHlM3lZcPCzEAI.s/e', '99.png'),
('Can Umut', 'Dönmez', 'c.umut_donmez@hotmail.com', '2023-06-29', '$2y$10$88wqpVQ0SXKnKxLHGjxSIOv.wOFG0dWEOl0yE3tKLCTNSz8hiHzdO', '1.png'),
('Debug', 'Ctis', 'debug@ctis.com', '2023-06-22', '$2y$10$ZKhPQ/lnbWIQJsF1VMb0yec5ahjaBNJ/sbHFIpypSXHywsBrhqktC', 'debug.jpeg'),
('Serkan', 'genc', 'sgenc@bilkent.edu.tr', '2023-06-27', '$2y$10$uR45IOb5m22T1ixfnylNIu.CXcxcqM8QgCPtOLNEUDH37uHeUQpdK', '98.png'),
('Orhan Efe', 'Gökdemir', 'orhan@efe.com', '2023-06-30', '$2y$10$RK1DGhZM26ORdgMSWhn7QuyMXWYuGAdQ24qtmKxg/TvjvUs/pNsAm', '92.png'),
('erkan', 'ucar', 'eucar@bilkent.edu.tr', '2023-06-07', '$2y$10$vsEJgFwpnuHc6nWool8WGOcQsdFy5Puby3gCcs73905t5dQqW5OYK', '92.png');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
