-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 29 2017 г., 01:50
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
  `age` date DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `table_info_user`
--

INSERT INTO `table_info_user` (`id_user_reg`, `name`, `age`, `description`) VALUES
(75, 'Таня', '5458-03-12', 'Все Ок'),
(77, 'Олегич', '0255-10-02', 'Пролллшг');

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
(21, 75, 'photo/20171129013602959.jpg'),
(22, 75, 'photo/20171129014259762.jpg'),
(23, 77, 'photo/20171129014719722.jpg'),
(24, 77, 'photo/20171129014802204.jpg');

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
(75, 'Татьяна', '22Mj0Oon93KwY'),
(76, 'Евгений', '22jB.E6ThGcjQ'),
(77, 'Олег', '22jB.E6ThGcjQ');

--
-- Индексы сохранённых таблиц
---- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 29 2017 г., 02:01
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
  `age` date DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `table_info_user`
--

INSERT INTO `table_info_user` (`id_user_reg`, `name`, `age`, `description`) VALUES
(75, 'Таня', '5458-03-12', 'Все Ок'),
(77, 'Олегич', '0255-10-02', 'Пролллшг'),
(78, 'петька', '0002-05-12', '555  ++');

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
(22, 75, 'photo/20171129014259762.jpg'),
(23, 77, 'photo/20171129014719722.jpg'),
(24, 77, 'photo/20171129014802204.jpg'),
(25, 78, 'photo/20171129020100199.jpg');

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
(75, 'Татьяна', '22Mj0Oon93KwY'),
(76, 'Евгений', '22jB.E6ThGcjQ'),
(77, 'Олег', '22jB.E6ThGcjQ'),
(78, 'petia', '22jB.E6ThGcjQ');

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
  MODIFY `id_photo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT для таблицы `table_reg`
--
ALTER TABLE `table_reg`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


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
  MODIFY `id_photo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT для таблицы `table_reg`
--
ALTER TABLE `table_reg`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
