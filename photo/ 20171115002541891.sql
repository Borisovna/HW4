-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Окт 31 2017 г., 22:11
-- Версия сервера: 5.6.34
-- Версия PHP: 7.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `burgers`
--

-- --------------------------------------------------------

--
-- Структура таблицы `info_user`
--

CREATE TABLE `info_user` (
  `id_user` int(10) NOT NULL,
  `name` varchar(15) NOT NULL,
  `email` varchar(25) NOT NULL,
  `phone` int(11) DEFAULT NULL,
  `street` varchar(30) DEFAULT NULL,
  `home` int(11) DEFAULT NULL,
  `appt` int(11) DEFAULT NULL,
  `part` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `info_user`
--

INSERT INTO `info_user` (`id_user`, `name`, `email`, `phone`, `street`, `home`, `appt`, `part`) VALUES
(1, 'tania', '0121mymail@gmail.com', 1234568, 'Qwer', 15, 1, 5),
(2, 'vasia', '753mail@gmail.com', 5555555, 'Adgfjkl', 888, 1, 5),
(3, 'alex', 'alex@mail.com', NULL, NULL, NULL, NULL, NULL),
(4, 'nadia', 'nadia@gmail.com', 789654, 'nadiaStreet', 777, 3, 88),
(5, 'qwsvj', '755l@gmail.com', 789456, 'Lkioj', 7, 0, 8),
(8, 'Oleg', '012157df@gmai.com', 7, 'Греческая', 5, 0, 6),
(9, 'Masha', 'Mashaf@gmai.com', 7, 'Греческая88', 51, 0, 61),
(10, 'Meha', 'Meha@gmai.com', 7, 'Греческая88', 51, 0, 61),
(12, 'Vasilisa', 'Vasilisa@mail.com', 874456, 'Trasdb', 1, 0, 2),
(13, 'Alex', 'Alex@mail.com', 753159, 'Asd', 4785, 0, 54),
(14, 'Oleg', 'Oleg@mail.ru', 753159, 'Asd', 4785, 0, 54),
(15, 'Masha', 'Masha@mail.ru', 753159, 'Asd', 4785, 0, 54),
(16, 'Roma', 'roma@mail.com', 4455555, 'Lore', 44, 0, 777),
(17, 'Filia', 'Filia@mail.com', 4455555, 'Lore', 44, 0, 777),
(18, 'Yra', 'yra@mail.com', 7, 'Довбуша', 10, 0, 15);

-- --------------------------------------------------------

--
-- Структура таблицы `order`
--

CREATE TABLE `order` (
  `id_order` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `comment` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `order`
--

INSERT INTO `order` (`id_order`, `id_user`, `comment`) VALUES
(1, 1, 'бургер 300 р'),
(2, 1, 'est xochy'),
(3, 4, 'бургер 300'),
(4, 8, 'бургер 300'),
(5, 8, 'бургер 300'),
(6, 9, 'бургер 300'),
(7, 10, 'бургер 300'),
(8, 10, 'бургер 300'),
(9, 2, 'бургер 300'),
(10, 4, 'бургер 300'),
(11, 1, 'бургер 300'),
(12, 1, 'бургера мне'),
(17, 8, 'бургера мне999'),
(18, 12, 'Бургер 300р.шт'),
(19, 12, 'Бургер 300р.шт'),
(20, 12, 'Бургер 600р.шт'),
(21, 12, 'Бургер 600р.шт'),
(22, 1, 'Бургер 600р.шт'),
(23, 1, 'Бургер 600р.шт'),
(24, 1, 'Бургер 600р.шт'),
(25, 1, 'Бургер 600р.шт'),
(26, 1, 'Бургер 600р.шт'),
(27, 1, 'Бургер 600р.шт'),
(28, 1, 'Бургер 600р.шт'),
(29, 1, 'Бургер 600р.шт'),
(30, 1, 'Бургер 600р.шт'),
(31, 3, 'Бургера мне 300р.'),
(32, 3, 'Бургера мне 300р.'),
(33, 3, 'Бургера мне 300р.'),
(34, 1, 'Бургера мне 300р.'),
(35, 1, 'Бургера мне 300р.'),
(36, 1, 'Бургера мне 300р.'),
(37, 14, 'Бургера мне 300р.'),
(38, 14, 'Бургера мне 300р.'),
(39, 14, 'Бургера мне 300р.'),
(40, 14, 'Бургера мне 300р.'),
(41, 14, 'Бургера мне 300р.'),
(42, 14, 'Бургера мне 300р.'),
(43, 14, 'Бургера мне 300р.'),
(44, 14, 'Бургера мне 300р.'),
(45, 14, 'Бургера мне 300р.'),
(46, 14, 'Бургера мне 300р.'),
(47, 15, 'Бургера мне 300р.'),
(48, 1, '111'),
(49, 16, '555'),
(50, 17, 'Бургер'),
(51, 18, 'Кушать'),
(52, 18, 'Кушать');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `info_user`
--
ALTER TABLE `info_user`
  ADD PRIMARY KEY (`id_user`);

--
-- Индексы таблицы `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id_order`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `info_user`
--
ALTER TABLE `info_user`
  MODIFY `id_user` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT для таблицы `order`
--
ALTER TABLE `order`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
