-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 18 2017 г., 01:09
-- Версия сервера: 5.6.34
-- Версия PHP: 7.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `HW4`
--

-- --------------------------------------------------------

--
-- Структура таблицы `table_info_user`
--

CREATE TABLE `table_info_user` (
  `id_user_reg` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `age` int(11) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `table_info_user`
--

INSERT INTO `table_info_user` (`id_user_reg`, `name`, `age`, `description`) VALUES
(0, 'Юра', 11, '44'),
(62, '', 0, ''),
(63, '44', 111, ''),
(64, 'peta', 15, 'fghhjj');

-- --------------------------------------------------------

--
-- Структура таблицы `table_phpto`
--

CREATE TABLE `table_phpto` (
  `id_photo` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `path_photo` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `table_phpto`
--

INSERT INTO `table_phpto` (`id_photo`, `id_user`, `path_photo`) VALUES
(5, 62, 'photo/20171118005137792.png'),
(6, 62, 'photo/20171118005520778.png'),
(7, 62, 'photo/20171118005531395.png'),
(8, 64, 'photo/20171118010109115.png');

-- --------------------------------------------------------

--
-- Структура таблицы `table_reg`
--

CREATE TABLE `table_reg` (
  `id_user` int(11) NOT NULL,
  `login` varchar(30) NOT NULL,
  `pass` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `table_reg`
--

INSERT INTO `table_reg` (`id_user`, `login`, `pass`) VALUES
(62, 'tania', '22SeiY1TsoJZU'),
(63, 'Алексей', '22jB.E6ThGcjQ'),
(64, 'petia', '22jB.E6ThGcjQ');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `table_info_user`
--
ALTER TABLE `table_info_user`
  ADD PRIMARY KEY (`id_user_reg`),
  ADD UNIQUE KEY `table_info_user_id_user_reg_uindex` (`id_user_reg`);

--
-- Индексы таблицы `table_phpto`
--
ALTER TABLE `table_phpto`
  ADD PRIMARY KEY (`id_photo`),
  ADD UNIQUE KEY `table_phpto_id_photo_uindex` (`id_photo`);

--
-- Индексы таблицы `table_reg`
--
ALTER TABLE `table_reg`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `table_reg_id_user_uindex` (`id_user`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `table_phpto`
--
ALTER TABLE `table_phpto`
  MODIFY `id_photo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `table_reg`
--
ALTER TABLE `table_reg`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
