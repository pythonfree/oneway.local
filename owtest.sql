-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Сен 17 2021 г., 15:05
-- Версия сервера: 5.7.29
-- Версия PHP: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `owtest`
--

-- --------------------------------------------------------

--
-- Структура таблицы `likes`
--

CREATE TABLE `likes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_photo` int(11) NOT NULL,
  `ip` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `likes`
--

INSERT INTO `likes` (`id`, `id_photo`, `ip`) VALUES
(202, 1, '127.0.0.1');

-- --------------------------------------------------------

--
-- Структура таблицы `photos`
--

CREATE TABLE `photos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_star` int(11) NOT NULL,
  `photo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `photos`
--

INSERT INTO `photos` (`id`, `id_star`, `photo`) VALUES
(1, 1, 'img_slider-1.jpg'),
(2, 1, 'img_slider-2.jpg'),
(3, 1, 'img_slider-3.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `stars`
--

CREATE TABLE `stars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(500) NOT NULL,
  `main_photo` varchar(100) NOT NULL,
  `location` varchar(500) NOT NULL,
  `person_descr` text NOT NULL,
  `content` text NOT NULL,
  `b_day` date DEFAULT NULL,
  `profession` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `stars`
--

INSERT INTO `stars` (`id`, `name`, `main_photo`, `location`, `person_descr`, `content`, `b_day`, `profession`) VALUES
(1, 'Emilia Clarke', 'img_person-1.jpg', 'Лондон, Великобритания', 'Британская актриса. Наиболее известна по роли Дайнерис Таргарие в телесериале \"Игра престолов\" и Сары Коннор в фильме \"Терминатор: Генезис\".', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptates explicabo nulla rerum odit debitis placeat, illum est, eligendi beatae ea laborum eum error non.</p><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus minus, voluptates ratione amet saepe quas!</p>', '1986-10-26', 'актриса');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `likes`
--
ALTER TABLE `likes`
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `photos`
--
ALTER TABLE `photos`
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `stars`
--
ALTER TABLE `stars`
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `likes`
--
ALTER TABLE `likes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=203;

--
-- AUTO_INCREMENT для таблицы `photos`
--
ALTER TABLE `photos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `stars`
--
ALTER TABLE `stars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
