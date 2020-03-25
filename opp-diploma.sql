-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 25 2020 г., 10:21
-- Версия сервера: 5.7.20
-- Версия PHP: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `opp-diploma`
--

-- --------------------------------------------------------

--
-- Структура таблицы `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `permissions` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `groups`
--

INSERT INTO `groups` (`id`, `name`, `permissions`) VALUES
(1, 'Srandart user', ''),
(2, 'Administrator', '{\"admin\":1}');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date_registr` timestamp NOT NULL,
  `status` varchar(255) NOT NULL,
  `group_id` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `date_registr`, `status`, `group_id`) VALUES
(1, 'admin', 'ashifin@live.com', '$2y$10$lcOQbS2LzugBARmzX810PuXgjxv1d9OgEjMMyoHimJGiik/rIqnc6', '2020-03-23 22:00:00', 'Профиль  админа', 2),
(3, 'john222', 'john@john.cpm', '$2y$10$jC5LKqaiBhDK6cxLddLBu.w0eLFkD63w/VRQKxVQk1RP4GA3X/uCG', '2020-03-24 10:24:56', 'Профиль джона11', 1),
(25, 'user', 'user@user.com', '$2y$10$/uVF68KL1bm.40V4fi4bN.yPm8tdjGb0oeu4dWzLU4F1keo7L6Qvq', '0000-00-00 00:00:00', 'Профиль простого юзера', 2),
(27, '123@mail.com', '123@mail.com', '$2y$10$KkdQiHe2VRdZRiiGadCWueQNssWoiK3dW7yAKvDCC9mHGp5NmoHaO', '0000-00-00 00:00:00', 'Профиль пользователя - 123@mail.com ', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `user_sessions`
--

CREATE TABLE `user_sessions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `hash` varchar(250) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user_sessions`
--

INSERT INTO `user_sessions` (`id`, `user_id`, `hash`) VALUES
(15, 1, '07b521f9b6512dbc5e3d3600cefbca2f7bca98787d82665fd6625c00f9ed3c4b'),
(17, 27, '9e909e6b9ce799e5e645e57bfe94b7126c3f67bb021eba93ca28243af88a1f65');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user_sessions`
--
ALTER TABLE `user_sessions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT для таблицы `user_sessions`
--
ALTER TABLE `user_sessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
