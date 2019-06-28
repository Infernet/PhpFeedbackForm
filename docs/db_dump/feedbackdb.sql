-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Июн 28 2019 г., 14:56
-- Версия сервера: 10.3.16-MariaDB
-- Версия PHP: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `feedbackdb`
--

-- --------------------------------------------------------

--
-- Структура таблицы `feedback`
--

CREATE TABLE `feedback` (
  `idFeedback` int(11) NOT NULL,
  `fk_name_id` int(11) NOT NULL,
  `fk_email_id` int(11) NOT NULL,
  `fk_message_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `feedback`
--

INSERT INTO `feedback` (`idFeedback`, `fk_name_id`, `fk_email_id`, `fk_message_id`) VALUES
(26, 8, 1, 1),
(27, 9, 2, 2),
(28, 10, 3, 3);

-- --------------------------------------------------------

--
-- Дублирующая структура для представления `feedbackview`
-- (См. Ниже фактическое представление)
--
CREATE TABLE `feedbackview` (
`feedback id` int(11)
,`name` varchar(100)
,`email` varchar(100)
,`message` varchar(1000)
);

-- --------------------------------------------------------

--
-- Структура таблицы `useremail`
--

CREATE TABLE `useremail` (
  `idEmail` int(11) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `useremail`
--

INSERT INTO `useremail` (`idEmail`, `email`) VALUES
(1, 'ben64@mail.ru'),
(2, 'petr_3467@rambler.ru'),
(3, 'super_job@yandex.ru');

-- --------------------------------------------------------

--
-- Структура таблицы `usermessage`
--

CREATE TABLE `usermessage` (
  `idMessage` int(11) NOT NULL,
  `message` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `usermessage`
--

INSERT INTO `usermessage` (`idMessage`, `message`) VALUES
(1, 'Hello, World!!!'),
(2, 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nobis dicta velit necessitatibus cupiditate, nesciunt eius doloribus aut debitis odit quam placeat atque inventore aspernatur quos sint perspiciatis modi deleniti aperiam?\r\nOdio repellendus culpa eveniet repellat accusamus ipsum non pariatur? Iste voluptates odit facere numquam fugit, consectetur culpa, quasi voluptatem dignissimos deleniti illum aspernatur provident ex porro fugiat, magni recusandae officia.\r\nMolestiae illo ducimus maxime possimus asperiores aut atque minima tempore soluta reprehenderit error quaerat blanditiis illum magni officiis molestias ullam obcaecati aperiam, voluptate fugit earum. Fugit dolorem earum laborum doloremque.\r\nQuod nemo, fugit sit ea deserunt perspiciatis quibusdam vitae cupiditate animi, corrupti aut. Nesciunt veritatis minus cupiditate delectus impedit nisi. Delectus mollitia, eos ad aliquam magni iusto necessitatibus fugit quisquam.\r\nVoluptates ea maxime natus dicta, ullam eos quae, totam '),
(3, 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nobis dicta velit necessitatibus cupiditate, nesciunt eius doloribus aut debitis odit quam placeat atque inventore aspernatur quos sint perspiciatis modi deleniti aperiam?\r\nOdio repellendus culpa eveniet repellat accusamus ipsum non pariatur? Iste voluptates odit facere numquam fugit, consectetur culpa, quasi voluptatem dignissimos deleniti illum aspernatur provident ex porro fugiat, magni recusandae officia.');

-- --------------------------------------------------------

--
-- Структура таблицы `username`
--

CREATE TABLE `username` (
  `nameId` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `username`
--

INSERT INTO `username` (`nameId`, `name`) VALUES
(8, 'Ben'),
(10, 'Василий'),
(9, 'Петр');

-- --------------------------------------------------------

--
-- Структура для представления `feedbackview`
--
DROP TABLE IF EXISTS `feedbackview`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `feedbackview`  AS  select `feedback`.`idFeedback` AS `feedback id`,`username`.`name` AS `name`,`useremail`.`email` AS `email`,`usermessage`.`message` AS `message` from (((`feedback` join `username` on(`feedback`.`fk_name_id` = `username`.`nameId`)) join `useremail` on(`feedback`.`fk_email_id` = `useremail`.`idEmail`)) join `usermessage` on(`feedback`.`fk_message_id` = `usermessage`.`idMessage`)) ;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`idFeedback`),
  ADD KEY `fk_fkEmailId_idEmail` (`fk_email_id`),
  ADD KEY `fk_fkNameId_nameId` (`fk_name_id`),
  ADD KEY `fk_fkMessageId_idMessage` (`fk_message_id`);

--
-- Индексы таблицы `useremail`
--
ALTER TABLE `useremail`
  ADD PRIMARY KEY (`idEmail`),
  ADD UNIQUE KEY `uniqueEmailIndex` (`email`);

--
-- Индексы таблицы `usermessage`
--
ALTER TABLE `usermessage`
  ADD PRIMARY KEY (`idMessage`),
  ADD UNIQUE KEY `uniqueMessageIndex` (`message`);

--
-- Индексы таблицы `username`
--
ALTER TABLE `username`
  ADD PRIMARY KEY (`nameId`),
  ADD UNIQUE KEY `uniqueNameIndex` (`name`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `feedback`
--
ALTER TABLE `feedback`
  MODIFY `idFeedback` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT для таблицы `useremail`
--
ALTER TABLE `useremail`
  MODIFY `idEmail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `usermessage`
--
ALTER TABLE `usermessage`
  MODIFY `idMessage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `username`
--
ALTER TABLE `username`
  MODIFY `nameId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `fk_fkEmailId_idEmail` FOREIGN KEY (`fk_email_id`) REFERENCES `useremail` (`idEmail`),
  ADD CONSTRAINT `fk_fkMessageId_idMessage` FOREIGN KEY (`fk_message_id`) REFERENCES `usermessage` (`idMessage`),
  ADD CONSTRAINT `fk_fkNameId_nameId` FOREIGN KEY (`fk_name_id`) REFERENCES `username` (`nameId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
