-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Авг 02 2022 г., 15:40
-- Версия сервера: 8.0.24
-- Версия PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `task_adtech`
--
CREATE DATABASE IF NOT EXISTS `task_adtech` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `task_adtech`;

-- --------------------------------------------------------

--
-- Структура таблицы `clicks`
--

CREATE TABLE `clicks` (
  `id` int NOT NULL,
  `id_offer` int NOT NULL,
  `id_sub` int NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `clicks`
--

INSERT INTO `clicks` (`id`, `id_offer`, `id_sub`, `date`) VALUES
(1, 1, 2, '2022-08-02 15:21:53'),
(2, 1, 2, '2022-08-02 15:22:11'),
(3, 1, 2, '2022-08-02 15:22:15'),
(4, 3, 2, '2022-08-02 15:34:03');

-- --------------------------------------------------------

--
-- Структура таблицы `commission`
--

CREATE TABLE `commission` (
  `id` int NOT NULL,
  `summ` float NOT NULL,
  `date_change` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `commission`
--

INSERT INTO `commission` (`id`, `summ`, `date_change`) VALUES
(1, 0.2, '2022-08-02 15:33:26');

-- --------------------------------------------------------

--
-- Структура таблицы `offers`
--

CREATE TABLE `offers` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `price` float NOT NULL,
  `url` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `theme` int NOT NULL,
  `enable` int NOT NULL DEFAULT '1',
  `total_clicks` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `offers`
--

INSERT INTO `offers` (`id`, `user_id`, `name`, `price`, `url`, `theme`, `enable`, `total_clicks`) VALUES
(1, 3, 'Вконтакте', 2, 'https://vk.com', 0, 0, 3),
(2, 3, 'Гугл', 3, 'https://www.google.ru', 2, 1, 0),
(3, 3, 'яндекс', 5, 'https://yandex.ru', 4, 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `reject`
--

CREATE TABLE `reject` (
  `id` int NOT NULL,
  `offer_id` int NOT NULL,
  `subscriber_id` int NOT NULL,
  `date_log` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `reject`
--

INSERT INTO `reject` (`id`, `offer_id`, `subscriber_id`, `date_log`) VALUES
(1, 1, 2, '2022-08-02 15:34:32'),
(2, 1, 2, '2022-08-02 15:34:33'),
(3, 1, 2, '2022-08-02 15:34:38');

-- --------------------------------------------------------

--
-- Структура таблицы `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` int NOT NULL,
  `offer_id` int NOT NULL,
  `subscriber_id` int NOT NULL,
  `new_url` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `count_clicks` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `offer_id`, `subscriber_id`, `new_url`, `count_clicks`) VALUES
(1, 1, 2, 'http://hw38new/cabinet/vendor?offer=1&sub=2', 3),
(2, 3, 2, 'http://hw38new/cabinet/vendor?offer=3&sub=2', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `login` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type_user` int NOT NULL,
  `enable` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `type_user`, `enable`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 10, 1),
(2, 'web', '202cb962ac59075b964b07152d234b70', 1, 1),
(3, 'adv', '202cb962ac59075b964b07152d234b70', 0, 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `clicks`
--
ALTER TABLE `clicks`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `commission`
--
ALTER TABLE `commission`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `reject`
--
ALTER TABLE `reject`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `clicks`
--
ALTER TABLE `clicks`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `commission`
--
ALTER TABLE `commission`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `offers`
--
ALTER TABLE `offers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `reject`
--
ALTER TABLE `reject`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
