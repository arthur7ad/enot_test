-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Сен 06 2023 г., 01:57
-- Версия сервера: 8.0.30
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `enot`
--

-- --------------------------------------------------------

--
-- Структура таблицы `currency`
--

CREATE TABLE `currency` (
  `id` int NOT NULL,
  `code` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nominal` int NOT NULL DEFAULT '1',
  `name_ru` varchar(64) NOT NULL,
  `value` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `currency`
--

INSERT INTO `currency` (`id`, `code`, `nominal`, `name_ru`, `value`) VALUES
(1, 'AUD', 1, 'Австралийский доллар', '62.5517'),
(2, 'AZN', 1, 'Азербайджанский манат', '56.8352'),
(3, 'GBP', 1, 'Фунт стерлингов Соединенного королевства', '121.9247'),
(4, 'AMD', 100, 'Армянских драмов', '25.0447'),
(5, 'BYN', 1, 'Белорусский рубль', '29.8855'),
(6, 'BGN', 1, 'Болгарский лев', '53.5706'),
(7, 'BRL', 1, 'Бразильский реал', '19.5924'),
(8, 'HUF', 100, 'Венгерских форинтов', '27.2745'),
(9, 'VND', 10000, 'Вьетнамских донгов', '40.2969'),
(10, 'HKD', 1, 'Гонконгский доллар', '12.3539'),
(11, 'GEL', 1, 'Грузинский лари', '36.8048'),
(12, 'DKK', 1, 'Датская крона', '14.0585'),
(13, 'AED', 1, 'Дирхам ОАЭ', '26.3054'),
(14, 'USD', 1, 'Доллар США', '96.6199'),
(15, 'EUR', 1, 'Евро', '104.4171'),
(16, 'EGP', 10, 'Египетских фунтов', '31.2745'),
(17, 'INR', 10, 'Индийских рупий', '11.6955'),
(18, 'IDR', 10000, 'Индонезийских рупий', '63.3490'),
(19, 'KZT', 100, 'Казахстанских тенге', '21.1705'),
(20, 'CAD', 1, 'Канадский доллар', '71.1487'),
(21, 'QAR', 1, 'Катарский риал', '26.5439'),
(22, 'KGS', 10, 'Киргизских сомов', '10.9479'),
(23, 'CNY', 1, 'Китайский юань', '13.2861'),
(24, 'MDL', 10, 'Молдавских леев', '54.1512'),
(25, 'NZD', 1, 'Новозеландский доллар', '57.4599'),
(26, 'NOK', 10, 'Норвежских крон', '90.7425'),
(27, 'PLN', 1, 'Польский злотый', '23.3658'),
(28, 'RON', 1, 'Румынский лей', '21.0919'),
(29, 'XDR', 1, 'СДР (специальные права заимствования)', '128.5064'),
(30, 'SGD', 1, 'Сингапурский доллар', '71.3852'),
(31, 'TJS', 10, 'Таджикских сомони', '88.1295'),
(32, 'THB', 10, 'Таиландских батов', '27.5152'),
(33, 'TRY', 10, 'Турецких лир', '36.1840'),
(34, 'TMT', 1, 'Новый туркменский манат', '27.6057'),
(35, 'UZS', 10000, 'Узбекских сумов', '79.8380'),
(36, 'UAH', 10, 'Украинских гривен', '26.1633'),
(37, 'CZK', 10, 'Чешских крон', '43.2904'),
(38, 'SEK', 10, 'Шведских крон', '87.8451'),
(39, 'CHF', 1, 'Швейцарский франк', '109.2614'),
(40, 'RSD', 100, 'Сербских динаров', '88.9492'),
(41, 'ZAR', 10, 'Южноафриканских рэндов', '51.3215'),
(42, 'KRW', 1000, 'Вон Республики Корея', '73.2080'),
(43, 'JPY', 100, 'Японских иен', '65.9927');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `ID` int NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(64) NOT NULL,
  `salt` varchar(32) NOT NULL,
  `name` varchar(50) NOT NULL,
  `joined` datetime NOT NULL,
  `userGroup` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`ID`, `username`, `password`, `salt`, `name`, `joined`, `userGroup`) VALUES
(1, 'admin', '102d0be89b97763d896299beb7defee1c93237e0cc2140dcdee1833b158eb2e1', 'rijtd8fvwm', 'admin', '2023-08-24 23:47:27', 1),
(2, 'test', '415f6b2c08eab9c5e6e69e67736098d08a194dd7d30e887da769d36f8d17a349', 'a2i75jh34d', 'Тестер', '2023-09-04 23:43:12', 1),
(3, 'root', '61ad8e1d43c4cf5493fdfb8f48c088f4893bc12254c53350615247752ba9d841', 'lti0nx2rfy', 'Артур\\', '2023-09-04 23:50:21', 1),
(4, 'qq', 'bf72111021589cb94f87e4e5d7b6fae522484f3d85ef673fe0e6c964d31ff19c', 'wkt863oynd', 'Артур', '2023-09-05 23:21:32', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `usersSessions`
--

CREATE TABLE `usersSessions` (
  `ID` int NOT NULL,
  `userID` int NOT NULL,
  `hash` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `currency`
--
ALTER TABLE `currency`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `usersSessions`
--
ALTER TABLE `usersSessions`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `currency`
--
ALTER TABLE `currency`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `usersSessions`
--
ALTER TABLE `usersSessions`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
