-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Окт 12 2020 г., 21:27
-- Версия сервера: 5.7.31
-- Версия PHP: 7.0.33-29+ubuntu19.10.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `test_samson`
--

-- --------------------------------------------------------

--
-- Структура таблицы `a_category`
--

CREATE TABLE `a_category` (
  `id_prod` int(50) DEFAULT NULL,
  `code_prod` int(5) NOT NULL,
  `id_list_categ` int(50) DEFAULT NULL,
  `name` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `a_category`
--

INSERT INTO `a_category` (`id_prod`, `code_prod`, `id_list_categ`, `name`) VALUES
(2587, 201, 23, 'Бумага'),
(2588, 202, 23, 'Бумага'),
(2589, 302, 27, 'Принтеры'),
(2589, 302, 29, 'МФУ'),
(2590, 305, 27, 'Принтеры'),
(2590, 305, 29, 'МФУ'),
(2591, 701, 25, 'Картон'),
(2592, 700, 25, 'Картон'),
(2593, 506, 24, 'Цветная бумага'),
(2594, 507, 26, 'Картон цветной'),
(2595, 508, 26, 'Картон цветной'),
(2596, 509, 28, 'Принтеры лазерные'),
(2597, 600, 28, 'Принтеры лазерные');

-- --------------------------------------------------------

--
-- Структура таблицы `a_price`
--

CREATE TABLE `a_price` (
  `id_prod` int(5) NOT NULL,
  `type_price` char(10) NOT NULL,
  `value_price` decimal(8,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `a_price`
--

INSERT INTO `a_price` (`id_prod`, `type_price`, `value_price`) VALUES
(2587, 'Базовая', '11.50'),
(2587, 'Москва', '12.50'),
(2588, 'Базовая', '18.50'),
(2588, 'Москва', '22.50'),
(2589, 'Базовая', '3010.00'),
(2589, 'Москва', '3500.00'),
(2590, 'Базовая', '3310.00'),
(2590, 'Москва', '2999.00'),
(2591, 'Базовая', '8000.00'),
(2591, 'Москва', '8000.00'),
(2592, 'Базовая', '8000.00'),
(2592, 'Москва', '8000.00'),
(2593, 'Базовая', '1.00'),
(2593, 'Москва', '5.00'),
(2594, 'Базовая', '1000.00'),
(2594, 'Москва', '35100.00'),
(2595, 'Базовая', '8000.00'),
(2595, 'Москва', '5000.00'),
(2596, 'Базовая', '1000.00'),
(2596, 'Москва', '35100.00'),
(2597, 'Базовая', '1000.00'),
(2597, 'Москва', '35100.00');

-- --------------------------------------------------------

--
-- Структура таблицы `a_product`
--

CREATE TABLE `a_product` (
  `id` int(10) NOT NULL,
  `code_prod` int(10) NOT NULL,
  `name` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `a_product`
--

INSERT INTO `a_product` (`id`, `code_prod`, `name`) VALUES
(2587, 201, 'Бумага А4'),
(2588, 202, 'Бумага А3'),
(2589, 302, 'Принтер Canon'),
(2590, 305, 'Принтер HP'),
(2591, 701, 'Картон'),
(2592, 700, 'Картон1'),
(2593, 506, 'Цветная бумага_1'),
(2594, 507, 'Картон цветной'),
(2595, 508, 'Картон цветной1'),
(2596, 509, 'Принтер лазерный1'),
(2597, 600, 'Принтер лазерный2');

-- --------------------------------------------------------

--
-- Структура таблицы `a_property`
--

CREATE TABLE `a_property` (
  `id_prod` int(10) NOT NULL,
  `value_prop` char(50) NOT NULL,
  `type_prop` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `a_property`
--

INSERT INTO `a_property` (`id_prod`, `value_prop`, `type_prop`) VALUES
(2587, '100', 'Плотность'),
(2587, '150', 'Белизна'),
(2588, '90', 'Плотность'),
(2588, '100', 'Белизна'),
(2589, 'Лазерный', 'Тип'),
(2589, 'A4', 'Формат0'),
(2589, 'A3', 'Формат1'),
(2590, 'A3', 'Формат'),
(2590, 'Лазерный', 'Тип'),
(2591, 'Серый', 'Цвет'),
(2591, '600', 'Белизна'),
(2592, 'Серый', 'Цвет'),
(2592, '600', 'Белизна'),
(2593, 'красный', 'Цвет'),
(2593, '300', 'Белизна'),
(2594, '800', 'Плотность'),
(2594, '400', 'Белизна'),
(2595, 'черный', 'цвет'),
(2595, '400', 'Белизна'),
(2596, '800', 'Плотность'),
(2596, '400', 'Белизна'),
(2597, 'A5', 'Формат'),
(2597, '400', 'Чернота');

-- --------------------------------------------------------

--
-- Структура таблицы `list_category`
--

CREATE TABLE `list_category` (
  `id` int(20) NOT NULL,
  `name_categ` char(20) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `list_category`
--

INSERT INTO `list_category` (`id`, `name_categ`, `parent_id`) VALUES
(22, 'goods', NULL),
(23, 'Бумага', 22),
(24, 'Цветная бумага', 23),
(25, 'Картон', 23),
(26, 'Картон цветной', 25),
(27, 'Принтеры', 22),
(28, 'Принтеры лазерные', 27),
(29, 'МФУ', 22);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `a_category`
--
ALTER TABLE `a_category`
  ADD KEY `a_category_id_prod_index` (`id_prod`),
  ADD KEY `a_category_id_list_categ_index` (`id_list_categ`);

--
-- Индексы таблицы `a_price`
--
ALTER TABLE `a_price`
  ADD KEY `a_price` (`id_prod`);

--
-- Индексы таблицы `a_product`
--
ALTER TABLE `a_product`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `a_property`
--
ALTER TABLE `a_property`
  ADD KEY `properys_product_id_fk` (`id_prod`);

--
-- Индексы таблицы `list_category`
--
ALTER TABLE `list_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `list_category_parent_id_index` (`parent_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `a_product`
--
ALTER TABLE `a_product`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2598;

--
-- AUTO_INCREMENT для таблицы `list_category`
--
ALTER TABLE `list_category`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `a_category`
--
ALTER TABLE `a_category`
  ADD CONSTRAINT `a_category_ibfk_1` FOREIGN KEY (`id_prod`) REFERENCES `a_product` (`id`),
  ADD CONSTRAINT `a_category_ibfk_2` FOREIGN KEY (`id_list_categ`) REFERENCES `list_category` (`id`);

--
-- Ограничения внешнего ключа таблицы `a_price`
--
ALTER TABLE `a_price`
  ADD CONSTRAINT `a_price` FOREIGN KEY (`id_prod`) REFERENCES `a_product` (`id`);

--
-- Ограничения внешнего ключа таблицы `a_property`
--
ALTER TABLE `a_property`
  ADD CONSTRAINT `properys_product_id_fk` FOREIGN KEY (`id_prod`) REFERENCES `a_product` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
