-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 01 2022 г., 13:48
-- Версия сервера: 5.7.33
-- Версия PHP: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `prom`
--

-- --------------------------------------------------------

--
-- Структура таблицы `technic`
--

CREATE TABLE `technic` (
  `id` int(11) UNSIGNED NOT NULL,
  `departament` varchar(50) NOT NULL,
  `category` varchar(40) NOT NULL,
  `inventory` int(11) UNSIGNED NOT NULL,
  `title` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `technic`
--

INSERT INTO `technic` (`id`, `departament`, `category`, `inventory`, `title`) VALUES
(1, 'Отдел информационных ресурсов и технологий', 'ПК', 174, 'GEG Prestige 41240A'),
(2, 'Отдел информационных ресурсов и технологий', 'ПК', 175, 'GEG Prestige 41240A'),
(3, 'Отдел защиты информации', 'ПК', 176, 'GEG Prestige 41240A	'),
(4, 'Отдел защиты информации', 'Сервер', 336, 'GEG Express 200L 155E'),
(5, 'Отдел информационных ресурсов и технологий', 'Антенна', 418, 'Hengshanlao 1500VA'),
(6, 'Информационно-аналитический отдел', 'Маршрутизатор', 791, 'CISCO 1760'),
(7, 'Информационно-аналитический отдел', 'ИБП', 316, 'BLACK UPS 1500VA'),
(8, 'Отдел информационных ресурсов и технологий', 'Принтер', 207, 'AUTONOMIC MB 4016'),
(9, 'Отдел защиты информации', 'ИБП', 317, 'BLACK UPS 1500VA'),
(10, 'Отдел информационных ресурсов и технологий', 'Коммутатор', 796, 'Catalyst'),
(11, 'Информационно-аналитический отдел', 'МФУ', 108, 'Xerox Workcentre Pro 128'),
(12, 'Информационно-аналитический отдел', 'Сервер', 517, 'IBM x3650 Rack mount 2 U'),
(13, 'Отдел информационных ресурсов и технологий', 'Сервер', 615, 'IBM x3650 Rack mount 2 U'),
(14, 'Отдел информационных ресурсов и технологий', 'Принтер', 588, 'Xerox Workcentre Pro 128'),
(15, 'Отдел информационных ресурсов и технологий', 'Принтер', 589, 'Xerox PHASER'),
(16, 'Отдел информационных ресурсов и технологий', 'Принтер', 590, 'Xerox PHASER'),
(17, 'Отдел защиты информации', 'Сервер', 337, 'IBM System x3650 M2'),
(18, 'Отдел защиты информации', 'Сервер', 338, 'IBM System x3650 M2'),
(19, 'Информационно-аналитический отдел', 'Коммутатор', 4813, 'HP StorageWorks 4/16 SAN'),
(20, 'Информационно-аналитический отдел', 'Коммутатор', 4814, 'HP StorageWorks 4/16 SAN'),
(21, 'Информационно-аналитический отдел', 'ПК', 244, 'DEPO Neos 430'),
(22, 'Информационно-аналитический отдел', 'ПК', 245, 'DEPO Neos 430'),
(23, 'Информационно-аналитический отдел', 'ПК', 246, 'DEPO Neos 430'),
(24, 'Отдел информационных ресурсов и технологий', 'ПК', 335, 'DEPO Neos 430'),
(25, 'Отдел информационных ресурсов и технологий', 'ПК', 339, 'DEPO Neos 430'),
(26, 'Отдел защиты информации', 'Монитор', 500, 'Acer V193Abm'),
(27, 'Отдел защиты информации', 'Монитор', 503, 'Acer V193Abm'),
(28, 'Отдел защиты информации', 'Монитор', 504, 'Acer V193Abm'),
(29, 'Отдел информационных ресурсов и технологий', 'Монитор', 507, 'Acer V193Abm'),
(30, 'Отдел защиты информации', 'Ноутбук', 6242, 'Aquarius Cmp NS735'),
(31, 'Отдел защиты информации', 'Ноутбук', 6250, 'Aquarius Cmp NS735'),
(32, 'Отдел защиты информации', 'Ноутбук', 6255, 'Aquarius Cmp NS735'),
(33, 'Информационно-аналитический отдел', 'Планшет', 5961, 'Samsung Galaxy'),
(34, 'Информационно-аналитический отдел', 'Планшет', 5959, 'Samsung Galaxy'),
(35, 'Отдел информационных ресурсов и технологий', 'Антенна', 409, 'Hengshanlao 1500VA');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `technic`
--
ALTER TABLE `technic`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `inventory` (`inventory`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `technic`
--
ALTER TABLE `technic`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
