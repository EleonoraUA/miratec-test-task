-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Час створення: Лют 11 2016 р., 01:57
-- Версія сервера: 5.6.26
-- Версія PHP: 5.5.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База даних: `users`
--

-- --------------------------------------------------------

--
-- Структура таблиці `avatars`
--

CREATE TABLE IF NOT EXISTS `avatars` (
  `id` int(11) NOT NULL,
  `pixels` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `file_name` varchar(120) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп даних таблиці `avatars`
--

INSERT INTO `avatars` (`id`, `pixels`, `user_id`, `file_name`) VALUES
(49, '500', 42, 'uploads/42/500_298897092.jpg'),
(50, '150', 42, 'uploads/42/150_298897092.jpg'),
(51, '50', 42, 'uploads/42/50_298897092.jpg'),
(52, '500', 43, 'uploads/43/500_Code-Tag-Long-Shadow-Minimal-HD-Wallpaper.jpg'),
(53, '150', 43, 'uploads/43/150_Code-Tag-Long-Shadow-Minimal-HD-Wallpaper.jpg'),
(54, '50', 43, 'uploads/43/50_Code-Tag-Long-Shadow-Minimal-HD-Wallpaper.jpg');

-- --------------------------------------------------------

--
-- Структура таблиці `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `patronymic` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(25) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп даних таблиці `user`
--

INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `patronymic`, `email`, `phone`, `password`) VALUES
(42, 'This', 'is', 'Test', 'test@example.com', '+380(50)123-123-23', '81dc9bdb52d04dc20036dbd83'),
(43, 'Elya', 'Korobova', 'Vadymivna', 'eleonoria96@gmail.com', '0984176612', '827ccb0eea8a706c4c34a1689');

--
-- Індекси збережених таблиць
--

--
-- Індекси таблиці `avatars`
--
ALTER TABLE `avatars`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Індекси таблиці `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- AUTO_INCREMENT для збережених таблиць
--

--
-- AUTO_INCREMENT для таблиці `avatars`
--
ALTER TABLE `avatars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT для таблиці `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=44;
--
-- Обмеження зовнішнього ключа збережених таблиць
--

--
-- Обмеження зовнішнього ключа таблиці `avatars`
--
ALTER TABLE `avatars`
  ADD CONSTRAINT `avatars_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
