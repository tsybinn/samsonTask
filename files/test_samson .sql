-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Окт 14 2020 г., 20:11
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
(2972, 701, 25, 'Картон'),
(2973, 700, 25, 'Картон'),
(2974, 506, 24, 'Цветная бумага'),
(2975, 507, 26, 'Картон цветной'),
(2976, 508, 26, 'Картон цветной'),
(2977, 800, 23, 'Бумага'),
(2978, 801, 23, 'Бумага'),
(2979, 201, 23, 'Бумага'),
(2980, 202, 23, 'Бумага'),
(2981, 302, 27, 'Принтеры'),
(2981, 302, 29, 'МФУ'),
(2982, 305, 27, 'Принтеры'),
(2982, 305, 29, 'МФУ');

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
(2972, 'Базовая', '8000.00'),
(2972, 'Москва', '8000.00'),
(2973, 'Базовая', '8000.00'),
(2973, 'Москва', '8000.00'),
(2974, 'Базовая', '1000.00'),
(2974, 'Москва', '5000.00'),
(2975, 'Базовая', '1000.00'),
(2975, 'Москва', '35100.00'),
(2976, 'Базовая', '8000.00'),
(2976, 'Москва', '5000.00'),
(2977, 'Базовая', '11.50'),
(2977, 'Москва', '12.50'),
(2978, 'Базовая', '18.50'),
(2978, 'Москва', '22.50'),
(2979, 'Базовая', '11.50'),
(2979, 'Москва', '12.50'),
(2980, 'Базовая', '18.50'),
(2980, 'Москва', '22.50'),
(2981, 'Базовая', '3010.00'),
(2981, 'Москва', '3500.00'),
(2982, 'Базовая', '3310.00'),
(2982, 'Москва', '2999.00');

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
(2972, 701, 'Картон'),
(2973, 700, 'Картон1'),
(2974, 506, 'Цветная бумага1'),
(2975, 507, 'Картон цветной'),
(2976, 508, 'Картон цветной1'),
(2977, 800, 'Бумага А5'),
(2978, 801, 'Бумага А2'),
(2979, 201, 'Бумага А4'),
(2980, 202, 'Бумага А3'),
(2981, 302, 'Принтер Canon'),
(2982, 305, 'Принтер HP');

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
(2972, 'Серый', 'Цвет'),
(2972, '600', 'Белизна'),
(2973, 'Серый', 'Цвет'),
(2973, '600', 'Белизна'),
(2974, 'красный', 'Цвет'),
(2974, '300', 'Белизна'),
(2975, '800', 'Плотность'),
(2975, '400', 'Белизна'),
(2976, 'черный', 'цвет'),
(2976, '400', 'Белизна'),
(2977, '100', 'Плотность'),
(2977, '150', 'Белизна'),
(2978, '90', 'Плотность'),
(2978, '100', 'Белизна'),
(2979, '100', 'Плотность'),
(2979, '150', 'Белизна'),
(2980, '90', 'Плотность'),
(2980, '100', 'Белизна'),
(2981, 'Лазерный', 'Тип'),
(2981, 'A4', 'Формат0'),
(2981, 'A3', 'Формат1'),
(2982, 'A3', 'Формат'),
(2982, 'Лазерный', 'Тип');

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
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2983;

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
