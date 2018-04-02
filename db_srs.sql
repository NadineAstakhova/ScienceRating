-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Апр 01 2018 г., 19:06
-- Версия сервера: 5.5.54
-- Версия PHP: 5.6.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `db_srs`
--

-- --------------------------------------------------------

--
-- Структура таблицы `access`
--

CREATE TABLE `access` (
  `idAccess` int(10) UNSIGNED NOT NULL,
  `type` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `access`
--

INSERT INTO `access` (`idAccess`, `type`) VALUES
(1, 'Professor'),
(2, 'Student'),
(3, 'Methodist');

-- --------------------------------------------------------

--
-- Структура таблицы `article_in_res`
--

CREATE TABLE `article_in_res` (
  `idArticle` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `publishing` varchar(255) DEFAULT NULL,
  `pages` int(11) DEFAULT NULL,
  `fkRes` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `group`
--

CREATE TABLE `group` (
  `idgroup` int(10) UNSIGNED NOT NULL,
  `name` varchar(45) NOT NULL,
  `status_group` enum('lock','unlock') DEFAULT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `year` enum('1','2','3','4','5','6') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `group`
--

INSERT INTO `group` (`idgroup`, `name`, `status_group`, `full_name`, `year`) VALUES
(26, 'ИИТ-2017', 'unlock', '122 \"КНиИТ\" - магистры', '1'),
(28, '2014-КН-Б', 'unlock', '6.050101 \"КН\" - тестировщики', '4'),
(30, '2014-КН-А', 'unlock', '6.050101 \"КН\" - программисты', '4'),
(31, '2014-КН-В', 'unlock', '6.050101 \"КН\" - дизайнеры', '4'),
(32, '2015-КН-А', 'unlock', '6.050101 \"КН\" - программисты', '3'),
(33, '2015-КН-Б', 'unlock', '6.050101 \"КН\" - тестировщики', '3'),
(35, '2015-КН-В', 'unlock', '6.050101 \"КН\" - дизайнеры', '3');

-- --------------------------------------------------------

--
-- Структура таблицы `group_subject`
--

CREATE TABLE `group_subject` (
  `idGroup_subject` int(10) UNSIGNED NOT NULL,
  `FK_Subject` int(10) UNSIGNED NOT NULL,
  `FK_Group` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `individual_works`
--

CREATE TABLE `individual_works` (
  `idInd_work` int(10) UNSIGNED NOT NULL,
  `File` varchar(200) NOT NULL,
  `FK_Task` int(10) UNSIGNED NOT NULL,
  `FK_Student` int(10) UNSIGNED NOT NULL,
  `Status` enum('new','accept','no accept') DEFAULT NULL,
  `Mark` int(3) DEFAULT NULL,
  `Completion_date` date DEFAULT NULL,
  `Attempts` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `list_of_task`
--

CREATE TABLE `list_of_task` (
  `idList_of_task` int(10) UNSIGNED NOT NULL,
  `Name_of_task` varchar(100) NOT NULL,
  `Date` date DEFAULT NULL,
  `FK_Subject` int(10) UNSIGNED NOT NULL,
  `After_Deadline` tinyint(1) DEFAULT NULL,
  `Mark` int(3) UNSIGNED DEFAULT NULL,
  `Attempts` int(10) UNSIGNED DEFAULT NULL,
  `Type` int(10) UNSIGNED NOT NULL,
  `Short_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `messages`
--

CREATE TABLE `messages` (
  `id_Messages` int(10) UNSIGNED NOT NULL,
  `new_task` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `FK_Prof` int(10) UNSIGNED NOT NULL,
  `id_work` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `professor`
--

CREATE TABLE `professor` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `patronymic` varchar(255) DEFAULT NULL,
  `surname` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `skype` varchar(32) DEFAULT NULL,
  `status` smallint(6) DEFAULT '0',
  `type_user` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `professor`
--

INSERT INTO `professor` (`id`, `name`, `patronymic`, `surname`, `phone`, `skype`, `status`, `type_user`) VALUES
(1, 'Денис', 'Геннадиевич', 'Богуто', NULL, NULL, 0, 4),
(2, 'Георгий', 'Борисович', 'Галич', NULL, NULL, 0, 5),
(3, 'Марина', 'Александровна', 'Епик', NULL, NULL, 0, 6),
(4, 'Кирилл', 'Константинович', 'Кадомский', NULL, NULL, 0, 7),
(5, 'Николай', 'Владимирович', 'Крачковский', NULL, NULL, 0, 8),
(6, 'Наталья', 'Артуровна', 'Мацецка', NULL, NULL, 0, 9),
(7, 'Петр', 'Карпович', 'Николюк', NULL, NULL, 0, 10),
(8, 'Антон', 'Иванович', 'Парамонов', NULL, NULL, 0, 11),
(9, 'Олег', 'Сергеевич', 'Тимчук', NULL, NULL, 0, 12),
(10, 'Ирина', 'Владимировна', 'Украинец', NULL, NULL, 0, 13),
(11, 'Ярослав', 'Олегович', 'Шмырев', NULL, NULL, 0, 14);

-- --------------------------------------------------------

--
-- Структура таблицы `res_in_template`
--

CREATE TABLE `res_in_template` (
  `idRes_in_template` int(10) UNSIGNED NOT NULL,
  `fkType` int(10) UNSIGNED NOT NULL,
  `fkTemp` int(10) UNSIGNED NOT NULL,
  `mark` float NOT NULL,
  `code` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `res_in_template`
--

INSERT INTO `res_in_template` (`idRes_in_template`, `fkType`, `fkTemp`, `mark`, `code`) VALUES
(1, 1, 1, 30, 'ДБ2'),
(2, 2, 1, 15, 'ДБ3'),
(3, 3, 1, 10, 'ДБ3'),
(4, 4, 1, 5, 'ДБ3'),
(5, 5, 1, 20, 'ДБ4'),
(6, 6, 1, 15, 'ДБ4'),
(7, 7, 1, 10, 'ДБ4'),
(10, 12, 1, 30, 'ДБ6'),
(11, 13, 1, 5, 'ДБ8'),
(12, 14, 1, 25, 'ДБ9'),
(13, 17, 1, 5, 'ДБ12'),
(14, 15, 1, 10, 'ДБ10'),
(15, 16, 1, 15, 'ДБ11'),
(16, 18, 1, 2, 'ДБ13'),
(17, 19, 1, 30, 'ДБ14'),
(18, 20, 1, 5, 'ДБ15'),
(19, 21, 1, 10, 'ДБ16'),
(20, 22, 1, 5, NULL),
(21, 1, 2, 20, 'ДБ1'),
(22, 2, 2, 15, 'ДБ2'),
(23, 8, 2, 6, 'ДБ4'),
(24, 9, 2, 6, 'ДБ4'),
(25, 19, 2, 6, 'ДБ4'),
(26, 10, 2, 3, 'ДБ5'),
(27, 23, 2, 2, 'ДБ6'),
(28, 15, 2, 1, 'ДБ7'),
(29, 17, 2, 1, 'ДБ7'),
(30, 24, 2, 2, 'ДБ6'),
(31, 25, 2, 10, 'ДБ2'),
(32, 26, 3, 3.5, NULL),
(33, 27, 3, 2, NULL),
(34, 28, 3, 0.2, NULL),
(35, 29, 3, 0.1, NULL),
(36, 30, 3, 0.2, NULL),
(37, 31, 3, 0.1, NULL),
(38, 32, 3, 0.2, NULL),
(39, 33, 3, 2.5, NULL),
(40, 34, 3, 1.7, NULL),
(41, 35, 3, 1.7, NULL),
(42, 36, 3, 0.7, NULL),
(43, 37, 3, 0.1, NULL),
(44, 38, 3, 0.2, NULL),
(45, 39, 3, 0.3, NULL),
(46, 40, 3, 0.1, NULL),
(47, 41, 3, 0.2, NULL),
(48, 42, 3, 0.3, NULL),
(49, 43, 3, 0.1, NULL),
(50, 44, 3, 0.2, NULL),
(51, 45, 3, 0.25, NULL),
(52, 46, 3, 0.2, NULL),
(53, 47, 3, 0.1, NULL),
(54, 48, 3, 0.3, NULL),
(55, 49, 3, 0.4, NULL),
(56, 50, 3, 0.2, NULL),
(57, 51, 3, 0.1, NULL),
(58, 52, 3, 0.4, NULL),
(59, 53, 3, 0.3, NULL),
(60, 54, 3, 0.2, NULL),
(61, 55, 3, 2, NULL),
(62, 56, 3, 1, NULL),
(63, 57, 3, 1.5, NULL),
(64, 58, 3, 0.1, NULL),
(65, 59, 3, 0.3, NULL),
(66, 60, 3, 0.2, NULL),
(67, 61, 3, 0.5, NULL),
(68, 62, 3, 0.4, NULL),
(69, 63, 3, 0.1, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `res_template`
--

CREATE TABLE `res_template` (
  `idTemplate` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `fileTemplate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `res_template`
--

INSERT INTO `res_template` (`idTemplate`, `title`, `fileTemplate`) VALUES
(1, 'Науковий рейтинг до аспірантури', ''),
(2, 'Науковий рейтинг до магістратури', ''),
(3, 'IНДИКАТОРИ ПЕРСОНАЛЬНОГО РЕЙТИНГУ ВИКЛАДАЧА', '');

-- --------------------------------------------------------

--
-- Структура таблицы `scientific_result`
--

CREATE TABLE `scientific_result` (
  `idRes` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `fkType` int(10) UNSIGNED NOT NULL,
  `date` varchar(255) DEFAULT NULL,
  `file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `scientific_result`
--

INSERT INTO `scientific_result` (`idRes`, `title`, `fkType`, `date`, `file`) VALUES
(19, 'test', 1, '2018', '/public/uploads/lab_2_T2FLS_2017.pdf'),
(20, '1234', 3, '12-12-12', '/public/uploads/_987-3242-5-PB.pdf'),
(21, '1', 1, '2015', '/public/uploads/2015-04_BGUIR Certificate.PDF');

-- --------------------------------------------------------

--
-- Структура таблицы `scient_res_owner`
--

CREATE TABLE `scient_res_owner` (
  `idOwner` int(10) UNSIGNED NOT NULL,
  `fkRes` int(10) UNSIGNED NOT NULL,
  `fkOwner` int(10) UNSIGNED NOT NULL,
  `role` enum('участник','призёр','победитель','тренер','30%','40%','50%','60%','70%') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `scient_res_owner`
--

INSERT INTO `scient_res_owner` (`idOwner`, `fkRes`, `fkOwner`, `role`) VALUES
(21, 20, 11, 'участник');

-- --------------------------------------------------------

--
-- Структура таблицы `student`
--

CREATE TABLE `student` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `patronymic` varchar(255) DEFAULT NULL,
  `surname` varchar(100) NOT NULL,
  `FK_Group` int(10) UNSIGNED NOT NULL,
  `registration_date` datetime DEFAULT NULL,
  `last_visit` datetime DEFAULT NULL,
  `status` enum('new','active','lock') DEFAULT NULL,
  `type_user` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `subject`
--

CREATE TABLE `subject` (
  `idSubject` int(10) UNSIGNED NOT NULL,
  `Name` varchar(100) NOT NULL,
  `FK_Professor` int(10) UNSIGNED NOT NULL,
  `Full_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `type_of_scient_res`
--

CREATE TABLE `type_of_scient_res` (
  `idType_certificates` int(10) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `type_of_participation` enum('1 место','2 место','3 место','') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `type_of_scient_res`
--

INSERT INTO `type_of_scient_res` (`idType_certificates`, `type`, `type_of_participation`) VALUES
(1, 'Диплом переможця та призера міжнародної студентської олімпіади з фаху', NULL),
(2, 'Диплом переможця та призера всеукраїнської студентської олімпіади МОН України з фаху ', '1 место'),
(3, 'Диплом переможця та призера всеукраїнської студентської олімпіади МОН України з фаху ', '2 место'),
(4, 'Диплом переможця та призера всеукраїнської студентської олімпіади МОН України з фаху ', '3 место'),
(5, 'Диплом переможця та призера конкурсу наукових студентських робіт МОН України з фаху', '1 место'),
(6, 'Диплом переможця та призера конкурсу наукових студентських робіт МОН України з фаху', '2 место'),
(7, 'Диплом переможця та призера конкурсу наукових студентських робіт МОН України з фаху', '3 место'),
(8, 'Наукова стаття у фаховому виданні, що має iмпакт-фактор', NULL),
(9, 'Наукова стаття у фаховому виданні, затвердженному ДАК Укр з фаху', NULL),
(10, 'Наукова стаття в Вiснику студентського наукового товариства ДонНУ з фаху', NULL),
(11, 'Наукова стаття у вітчизняному фаховому виданні', NULL),
(12, 'Наукова стаття у виданні, яке входить до міжнародних науковометричних баз', NULL),
(13, 'Наукова стаття у вітчизняному нефаховому виданні', NULL),
(14, 'Наукова стаття у іноземному виданні', NULL),
(15, 'Участь у науковій міжнародній конференції (за умови опублікування тез доповідей)', NULL),
(16, 'Участь у науковій конференції за межами України (за умови опублікування тез доповідей та наявності сертифікату про участь)', NULL),
(17, 'Участь у науковій всеукраїнській конференції (за умови опублікування тез доповідей)', NULL),
(18, 'Участь у науковій регіональній або вузівській конференції', NULL),
(19, 'Патент або авторське свідоцтво', NULL),
(20, 'Рекомендація вченої ради факультету до вступу в аспірантуру (за наявності)', NULL),
(21, 'Диплом магістра/спеціаліста з відзнакою', NULL),
(22, 'Оцінка за реферат', NULL),
(23, 'Iншi нагороди у накових конкурсах', NULL),
(24, 'Сертифiкат та/або довiдка з iноземної мови', NULL),
(25, 'Диплом переможця та/або призера конкурсу наукових студентських робiт МОН та НАН України, змагань, програм з фаху ', NULL),
(26, 'Видання за рекомендацiєю Вченої ради ДонНУ iмeнi Василя Стуса пiдручника для ВНЗ', NULL),
(27, 'Видання за рекомендацiєю Вченої ради ДонНУ iмeнi Василя Стуса навчального посiбника для ВНЗ', NULL),
(28, 'Розробка робочої навчальної програми нової дисциплiни, практики, затвердженої НМК факультету / Унiверситету (для загальноунiверситетських кафедр), курсу сертифiкатної освiтньої програми, тренiнгової програми.', NULL),
(29, 'Розробка методичного забезпечення навчального процесу: друкований / електронний лекцiйний курс (з дисциплiни 3-5 кредитiв)', NULL),
(30, 'Розробка методичного забезпечення навчального процесу: друкований / електронний лекцiйний  курс (з дисциплiни бiльше 5 кредитiв)', NULL),
(31, 'Розробка методичного забезпечення навчального процесу: друкований / електронний комплекс лабораторних робiт/ практичних, ceмiнapcьких занять (з дисциплiни 3-5 кредитiв) ', NULL),
(32, 'Розробка методичного забезпечення навчального процесу: друкований / електронний комплекс лабораторних робiт/ практичних, ceмiнapcьких занять (з дисциплiни бiльше 5 кредитiв)', NULL),
(33, 'Розробка дидактичного та методичного забезпечення дисциплiн за технологiями дистанцiйного навчання - МВОК', NULL),
(34, 'Розробка дидактичного та методичного забезпечення дисциплiн за технологiями дистанцiйного навчання - Moodle', NULL),
(35, 'Розробка навчальних програм та науковометодичного забезпечення дисциплiн iноземною мовою (окрiм росiйської) для спецiальностей немовної пiдготовки', NULL),
(36, 'Викладання навчальної дисциплiни iноземною мовою (окрiм росiйської) для спецiальностей немовної пiдготовки', NULL),
(37, 'Розробка конкурсних завадань до студентських олiмпiад. Обласний рiвень', NULL),
(38, 'Розробка конкурсних завадань до студентських олiмпiад. Всеукраїнський рiвень', NULL),
(39, 'Розробка конкурсних завадань до студентських олiмпiад. Мiжнародний рiвень', NULL),
(40, 'Розробка конкурсних завадань до шкiльних олiмпiад. Обласний рiвень', NULL),
(41, 'Розробка конкурсних завадань до шкiльних олiмпiад. Всеукраїнський рiвень', NULL),
(42, 'Розробка конкурсних завадань до шкiльних олiмпiад. Мiжнародний рiвень', NULL),
(43, 'Розробка конкурсних завадань до конкурсiв МАН. Обласний рiвень', NULL),
(44, 'Розробка конкурсних завадань до конкурсiв МАН. Всеукраїнський рiвень', NULL),
(45, 'Рецензування навчально-методичних матерiалiв: пiдручникiв', NULL),
(46, 'Рецензування навчально-методичних матерiалiв: навчально-методичних посiбникiв', NULL),
(47, 'Рецензування навчально-методичних матерiалiв: методичних вказiвок (рекомендацiй)', NULL),
(48, 'Експертиза: нормативних документiв публiчного обговорення: локальнi', NULL),
(49, 'Експертиза: нормативних документiв публiчного обговорення: загальноукраїнськi', NULL),
(50, 'Експертиза: конкурсних робiт i проектiв', NULL),
(51, 'Експертиза: конкурсних робiт МАН та студентських наукових робiт', NULL),
(52, 'Редагування/лiтературне редагування: пiдручникiв', NULL),
(53, 'Редагування/лiтературне редагування: навчальних посiбникiв', NULL),
(54, 'Редагування/лiтературне редагування: монографiй', NULL),
(55, 'Пiдгтовка документацiї для вiдкритя нових освiтнiх програм або лiцензування/акредитацiї: освiтньої програми/спецiальностi / аспiрантури/докторантури: Голова', NULL),
(56, 'Пiдгтовка документацiї для вiдкритя нових освiтнiх програм або лiцензування/акредитацiї: освiтньої програми/спецiальностi / аспiрантури/докторантури: Член проектної групи', NULL),
(57, 'Викладання навчальної дисциплiни у якостi професора-вiзитера', NULL),
(58, 'Розробка навчального плану пiдготовки: - Бакалавр – Магiстр -Аспiрант – Сертифiкатної програми/освiтнього проекту', NULL),
(59, 'Робота в НМК/НМР: -	факультету: голова', NULL),
(60, 'Робота в НМК/НМР: -	факультету: секретар', NULL),
(61, 'Робота в НМК/НМР: -	Унiверситету: голова', NULL),
(62, 'Робота в НМК/НМР: -	Унiверситету: секретар', NULL),
(63, 'Складання програм та завдань для вступникiв на: - СО «Бакалавр»; - СО «Магiстр»', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `type_of_works`
--

CREATE TABLE `type_of_works` (
  `idType` int(10) UNSIGNED NOT NULL,
  `Type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `type_of_works`
--

INSERT INTO `type_of_works` (`idType`, `Type`) VALUES
(1, 'Лабораторна_робота'),
(2, 'Індивідуальна_робота'),
(3, 'Тест'),
(4, 'Реферат'),
(5, 'Контрольна_робота');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `idUsers` int(10) UNSIGNED NOT NULL,
  `username` varchar(60) NOT NULL,
  `password` varchar(225) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `type` int(10) UNSIGNED NOT NULL,
  `remember_token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`idUsers`, `username`, `password`, `email`, `type`, `remember_token`) VALUES
(1, 'admin', '$2y$13$NjPiT83TbVVerShtwB2x5u1q65P4P.jXM0fs.1bu2mWdMZ60XFZKK', 'admin@mail.ru', 1, 'cOLQgS8WKQEA5DPMHLLYDaBVMfJq3CZnKKyiGdCTfJpgpR15HM3C9BbJGLFZ'),
(2, 'methodist', '$2y$13$Fyu6rZXDOlAxLOiHUgmNce5nzJO6vFNTQGD0QWDoFCnVgl3r8BBEC', 'methodist@donnu.edu.ua', 3, 'hfzDVPOZjVPbOaJ6eCiMT4qcmG3HVoLBrzUAgMmseuFSkW2cByrHt6TOjIHN'),
(3, 'podorozhniak', '$2y$13$Fyu6rZXDOlAxLOiHUgmNce5nzJO6vFNTQGD0QWDoFCnVgl3r8BBEC', 'podorozhniak.a@donnu.edu.ua', 3, NULL),
(4, 'd.boguto', '$2y$10$UFC0pWEgpCIt8l1GSv.x4.W9pb2qayOylWC/w8t6bwApDbdJFtleq', 'd.boguto@donnu.edu.ua', 1, NULL),
(5, 'g.galich', '$2y$10$UFC0pWEgpCIt8l1GSv.x4.W9pb2qayOylWC/w8t6bwApDbdJFtleq', 'g.galich@donnu.edu.ua', 1, NULL),
(6, 'm.yepik', '$2y$10$UFC0pWEgpCIt8l1GSv.x4.W9pb2qayOylWC/w8t6bwApDbdJFtleq', 'm.yepik@donnu.edu.ua', 1, NULL),
(7, 'k.kadomsky', '$2y$10$UFC0pWEgpCIt8l1GSv.x4.W9pb2qayOylWC/w8t6bwApDbdJFtleq', 'k.kadomsky@donnu.edu.ua', 1, NULL),
(8, 'm.krachkovskyi', '$2y$10$UFC0pWEgpCIt8l1GSv.x4.W9pb2qayOylWC/w8t6bwApDbdJFtleq', 'm.krachkovskyi@donnu.edu.ua', 1, NULL),
(9, 'n.pakhomova', '$2y$10$UFC0pWEgpCIt8l1GSv.x4.W9pb2qayOylWC/w8t6bwApDbdJFtleq', 'n.pakhomova@donnu.edu.ua', 1, NULL),
(10, 'p.nikolyuk', '$2y$10$UFC0pWEgpCIt8l1GSv.x4.W9pb2qayOylWC/w8t6bwApDbdJFtleq', 'p.nikolyuk@donnu.edu.ua', 1, NULL),
(11, 'a.paramonov', '$2y$10$UFC0pWEgpCIt8l1GSv.x4.W9pb2qayOylWC/w8t6bwApDbdJFtleq', 'a.paramonov@donnu.edu.ua', 1, NULL),
(12, 'o.tymchuk', '$2y$10$UFC0pWEgpCIt8l1GSv.x4.W9pb2qayOylWC/w8t6bwApDbdJFtleq', 'o.tymchuk@donnu.edu.ua', 1, NULL),
(13, 'i.ukrainets', '$2y$10$UFC0pWEgpCIt8l1GSv.x4.W9pb2qayOylWC/w8t6bwApDbdJFtleq', 'i.ukrainets@donnu.edu.ua', 1, NULL),
(14, 'ya.shmyriov', '$2y$10$UFC0pWEgpCIt8l1GSv.x4.W9pb2qayOylWC/w8t6bwApDbdJFtleq', 'ya.shmyriov@donnu.edu.ua', 1, NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `access`
--
ALTER TABLE `access`
  ADD PRIMARY KEY (`idAccess`);

--
-- Индексы таблицы `article_in_res`
--
ALTER TABLE `article_in_res`
  ADD PRIMARY KEY (`idArticle`),
  ADD UNIQUE KEY `idArticle_UNIQUE` (`idArticle`),
  ADD KEY `fkArtRes_idx` (`fkRes`);

--
-- Индексы таблицы `group`
--
ALTER TABLE `group`
  ADD PRIMARY KEY (`idgroup`);

--
-- Индексы таблицы `group_subject`
--
ALTER TABLE `group_subject`
  ADD PRIMARY KEY (`idGroup_subject`),
  ADD KEY `FK_group_idx` (`FK_Group`),
  ADD KEY `FK_subject_idx` (`FK_Subject`);

--
-- Индексы таблицы `individual_works`
--
ALTER TABLE `individual_works`
  ADD PRIMARY KEY (`idInd_work`),
  ADD KEY `FK_Task_idx` (`FK_Task`),
  ADD KEY `FK_student_idx` (`FK_Student`);

--
-- Индексы таблицы `list_of_task`
--
ALTER TABLE `list_of_task`
  ADD PRIMARY KEY (`idList_of_task`),
  ADD KEY `FK_sub_idx` (`FK_Subject`),
  ADD KEY `FK_TYPE_idx` (`Type`),
  ADD KEY `FK_Typework_idx` (`Type`);

--
-- Индексы таблицы `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id_Messages`),
  ADD KEY `FK_Proff_idx` (`FK_Prof`),
  ADD KEY `FK_work_idx` (`id_work`),
  ADD KEY `FK_workid_idx` (`id_work`);

--
-- Индексы таблицы `professor`
--
ALTER TABLE `professor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_user_status` (`status`),
  ADD KEY `FK_typeStudent_idx` (`type_user`);

--
-- Индексы таблицы `res_in_template`
--
ALTER TABLE `res_in_template`
  ADD PRIMARY KEY (`idRes_in_template`),
  ADD UNIQUE KEY `idRes_in_template_UNIQUE` (`idRes_in_template`),
  ADD KEY `fkTypeR_idx` (`fkType`),
  ADD KEY `fkTemp_idx` (`fkTemp`);

--
-- Индексы таблицы `res_template`
--
ALTER TABLE `res_template`
  ADD PRIMARY KEY (`idTemplate`),
  ADD UNIQUE KEY `idTemplate_UNIQUE` (`idTemplate`);

--
-- Индексы таблицы `scientific_result`
--
ALTER TABLE `scientific_result`
  ADD PRIMARY KEY (`idRes`),
  ADD UNIQUE KEY `idcertificates_UNIQUE` (`idRes`),
  ADD KEY `fkTypeC_idx` (`fkType`);

--
-- Индексы таблицы `scient_res_owner`
--
ALTER TABLE `scient_res_owner`
  ADD PRIMARY KEY (`idOwner`),
  ADD UNIQUE KEY `idCertificates_owner_UNIQUE` (`idOwner`),
  ADD KEY `fkCertificates_idx` (`fkRes`),
  ADD KEY `fkOwner_idx` (`fkOwner`);

--
-- Индексы таблицы `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_typeUser_idx` (`type_user`),
  ADD KEY `FK_Group_idx` (`FK_Group`),
  ADD KEY `FK_groupst_idx` (`FK_Group`);

--
-- Индексы таблицы `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`idSubject`),
  ADD KEY `FK_Prof_idx` (`FK_Professor`);

--
-- Индексы таблицы `type_of_scient_res`
--
ALTER TABLE `type_of_scient_res`
  ADD PRIMARY KEY (`idType_certificates`),
  ADD UNIQUE KEY `idtype_certificates_UNIQUE` (`idType_certificates`);

--
-- Индексы таблицы `type_of_works`
--
ALTER TABLE `type_of_works`
  ADD PRIMARY KEY (`idType`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idUsers`),
  ADD UNIQUE KEY `username_UNIQUE` (`username`),
  ADD KEY `FK_Type_idx` (`type`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `access`
--
ALTER TABLE `access`
  MODIFY `idAccess` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `article_in_res`
--
ALTER TABLE `article_in_res`
  MODIFY `idArticle` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `group`
--
ALTER TABLE `group`
  MODIFY `idgroup` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT для таблицы `group_subject`
--
ALTER TABLE `group_subject`
  MODIFY `idGroup_subject` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=199;
--
-- AUTO_INCREMENT для таблицы `individual_works`
--
ALTER TABLE `individual_works`
  MODIFY `idInd_work` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=293;
--
-- AUTO_INCREMENT для таблицы `list_of_task`
--
ALTER TABLE `list_of_task`
  MODIFY `idList_of_task` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;
--
-- AUTO_INCREMENT для таблицы `messages`
--
ALTER TABLE `messages`
  MODIFY `id_Messages` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `professor`
--
ALTER TABLE `professor`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT для таблицы `res_in_template`
--
ALTER TABLE `res_in_template`
  MODIFY `idRes_in_template` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;
--
-- AUTO_INCREMENT для таблицы `res_template`
--
ALTER TABLE `res_template`
  MODIFY `idTemplate` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `scientific_result`
--
ALTER TABLE `scientific_result`
  MODIFY `idRes` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT для таблицы `scient_res_owner`
--
ALTER TABLE `scient_res_owner`
  MODIFY `idOwner` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT для таблицы `student`
--
ALTER TABLE `student`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT для таблицы `subject`
--
ALTER TABLE `subject`
  MODIFY `idSubject` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT для таблицы `type_of_scient_res`
--
ALTER TABLE `type_of_scient_res`
  MODIFY `idType_certificates` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;
--
-- AUTO_INCREMENT для таблицы `type_of_works`
--
ALTER TABLE `type_of_works`
  MODIFY `idType` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `idUsers` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `article_in_res`
--
ALTER TABLE `article_in_res`
  ADD CONSTRAINT `fkArtRes` FOREIGN KEY (`fkRes`) REFERENCES `scientific_result` (`idRes`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `group_subject`
--
ALTER TABLE `group_subject`
  ADD CONSTRAINT `FK_group` FOREIGN KEY (`FK_Group`) REFERENCES `group` (`idgroup`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_subject` FOREIGN KEY (`FK_Subject`) REFERENCES `subject` (`idSubject`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `individual_works`
--
ALTER TABLE `individual_works`
  ADD CONSTRAINT `FK_student` FOREIGN KEY (`FK_Student`) REFERENCES `student` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Task` FOREIGN KEY (`FK_Task`) REFERENCES `list_of_task` (`idList_of_task`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `list_of_task`
--
ALTER TABLE `list_of_task`
  ADD CONSTRAINT `FK_sub` FOREIGN KEY (`FK_Subject`) REFERENCES `subject` (`idSubject`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Typework` FOREIGN KEY (`Type`) REFERENCES `type_of_works` (`idType`) ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `FK_Proff` FOREIGN KEY (`FK_Prof`) REFERENCES `professor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_workid` FOREIGN KEY (`id_work`) REFERENCES `individual_works` (`idInd_work`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `professor`
--
ALTER TABLE `professor`
  ADD CONSTRAINT `FK_typeStudent` FOREIGN KEY (`type_user`) REFERENCES `users` (`idUsers`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `res_in_template`
--
ALTER TABLE `res_in_template`
  ADD CONSTRAINT `fkTemp` FOREIGN KEY (`fkTemp`) REFERENCES `res_template` (`idTemplate`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fkTypeR` FOREIGN KEY (`fkType`) REFERENCES `type_of_scient_res` (`idType_certificates`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `scientific_result`
--
ALTER TABLE `scientific_result`
  ADD CONSTRAINT `fkTypeRes` FOREIGN KEY (`fkType`) REFERENCES `type_of_scient_res` (`idType_certificates`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `scient_res_owner`
--
ALTER TABLE `scient_res_owner`
  ADD CONSTRAINT `fkRes` FOREIGN KEY (`fkRes`) REFERENCES `scientific_result` (`idRes`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fkUser` FOREIGN KEY (`fkOwner`) REFERENCES `users` (`idUsers`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `FK_groupst` FOREIGN KEY (`FK_Group`) REFERENCES `group` (`idgroup`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_typeUser` FOREIGN KEY (`type_user`) REFERENCES `users` (`idUsers`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `subject`
--
ALTER TABLE `subject`
  ADD CONSTRAINT `FK_p` FOREIGN KEY (`FK_Professor`) REFERENCES `professor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_Type` FOREIGN KEY (`type`) REFERENCES `access` (`idAccess`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
