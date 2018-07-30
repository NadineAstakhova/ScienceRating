-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 01 2018 г., 22:33
-- Версия сервера: 5.6.37
-- Версия PHP: 5.6.31

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
-- Структура таблицы `authors_of_publication`
--

CREATE TABLE `authors_of_publication` (
  `idPubAuthor` int(10) UNSIGNED NOT NULL,
  `fk_user` int(10) UNSIGNED NOT NULL,
  `fk_pub` int(10) UNSIGNED NOT NULL,
  `percent_of_writing` int(10) NOT NULL DEFAULT '100',
  `status` enum('new','confirmed','unconfirmed') NOT NULL DEFAULT 'new'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `authors_of_publication`
--

INSERT INTO `authors_of_publication` (`idPubAuthor`, `fk_user`, `fk_pub`, `percent_of_writing`, `status`) VALUES
(1, 15, 1, 100, 'confirmed');

-- --------------------------------------------------------

--
-- Структура таблицы `event_in_ranking`
--

CREATE TABLE `event_in_ranking` (
  `idRankEvent` int(10) UNSIGNED NOT NULL,
  `fk_rank_type` int(10) UNSIGNED NOT NULL,
  `fk_event_type` int(10) UNSIGNED NOT NULL,
  `fk_result_type` int(10) UNSIGNED NOT NULL,
  `mark` int(11) NOT NULL,
  `code` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `event_in_ranking`
--

INSERT INTO `event_in_ranking` (`idRankEvent`, `fk_rank_type`, `fk_event_type`, `fk_result_type`, `mark`, `code`) VALUES
(1, 1, 1, 6, 30, 'ДБ2'),
(2, 1, 2, 1, 15, 'ДБ3'),
(3, 1, 2, 2, 10, 'ДБ3'),
(4, 1, 2, 3, 5, 'ДБ3'),
(5, 1, 3, 1, 20, 'ДБ4'),
(6, 1, 3, 2, 15, 'ДБ4'),
(7, 1, 3, 3, 10, 'ДБ4'),
(8, 1, 6, 6, 5, 'ДБ12'),
(9, 1, 4, 6, 10, 'ДБ10'),
(10, 1, 5, 6, 15, 'ДБ11'),
(11, 1, 7, 6, 2, 'ДБ13'),
(12, 1, 8, 6, 5, 'ДБ15'),
(13, 1, 9, 6, 10, 'ДБ16'),
(14, 1, 10, 6, 5, NULL),
(15, 2, 1, 1, 20, 'ДБ1'),
(16, 2, 2, 1, 15, 'ДБ2'),
(17, 2, 11, 6, 2, 'ДБ6'),
(18, 2, 4, 6, 1, 'ДБ7'),
(19, 2, 6, 6, 1, 'ДБ7'),
(20, 2, 12, 6, 2, 'ДБ6'),
(21, 2, 13, 6, 10, 'ДБ2'),
(22, 3, 14, 6, 2, NULL),
(23, 3, 15, 7, 0, NULL),
(24, 3, 15, 8, 0, NULL),
(25, 3, 16, 7, 1, NULL),
(26, 3, 16, 8, 0, NULL);

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
-- Структура таблицы `members_of_event`
--

CREATE TABLE `members_of_event` (
  `idMember` int(10) UNSIGNED NOT NULL,
  `fk_member` int(10) UNSIGNED NOT NULL,
  `fk_event` int(10) UNSIGNED NOT NULL,
  `fk_res` int(10) UNSIGNED NOT NULL,
  `fk_role` int(10) UNSIGNED NOT NULL,
  `file` varchar(255) NOT NULL,
  `status` enum('new','confirmed','unconfirmed') NOT NULL DEFAULT 'new'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `members_of_event`
--

INSERT INTO `members_of_event` (`idMember`, `fk_member`, `fk_event`, `fk_res`, `fk_role`, `file`, `status`) VALUES
(1, 15, 1, 1, 1, 'jkhk', 'confirmed'),
(2, 15, 2, 1, 1, 'kj;', 'confirmed');

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
  `type_user` int(10) UNSIGNED NOT NULL,
  `surname_ukr` varchar(255) DEFAULT NULL,
  `name_ukr` varchar(255) DEFAULT NULL,
  `patronymic_ukr` varchar(255) DEFAULT NULL,
  `name_en` varchar(255) DEFAULT NULL,
  `surname_en` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `professor`
--

INSERT INTO `professor` (`id`, `name`, `patronymic`, `surname`, `phone`, `skype`, `status`, `type_user`, `surname_ukr`, `name_ukr`, `patronymic_ukr`, `name_en`, `surname_en`) VALUES
(1, 'Денис', 'Геннадиевич', 'Богуто', NULL, NULL, 0, 4, NULL, NULL, NULL, NULL, NULL),
(2, 'Георгий', 'Борисович', 'Галич', NULL, NULL, 0, 5, NULL, NULL, NULL, NULL, NULL),
(3, 'Марина', 'Александровна', 'Епик', NULL, NULL, 0, 6, NULL, NULL, NULL, NULL, NULL),
(4, 'Кирилл', 'Константинович', 'Кадомский', NULL, NULL, 0, 7, NULL, NULL, NULL, NULL, NULL),
(5, 'Николай', 'Владимирович', 'Крачковский', NULL, NULL, 0, 8, NULL, NULL, NULL, NULL, NULL),
(6, 'Наталья', 'Артуровна', 'Мацецка', NULL, NULL, 0, 9, NULL, NULL, NULL, NULL, NULL),
(7, 'Петр', 'Карпович', 'Николюк', NULL, NULL, 0, 10, NULL, NULL, NULL, NULL, NULL),
(8, 'Антон', 'Иванович', 'Парамонов', NULL, NULL, 0, 11, NULL, NULL, NULL, NULL, NULL),
(9, 'Олег', 'Сергеевич', 'Тимчук', NULL, NULL, 0, 12, NULL, NULL, NULL, NULL, NULL),
(10, 'Ирина', 'Владимировна', 'Украинец', NULL, NULL, 0, 13, NULL, NULL, NULL, NULL, NULL),
(11, 'Ярослав', 'Олегович', 'Шмырев', NULL, NULL, 0, 14, NULL, NULL, NULL, NULL, NULL),
(12, 'Альбус', NULL, 'Дамблдор', NULL, NULL, 0, 1, 'Дамблдор', 'Альбус', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `publication_in_ranking`
--

CREATE TABLE `publication_in_ranking` (
  `idPubRank` int(10) UNSIGNED NOT NULL,
  `fk_rank_type` int(10) UNSIGNED NOT NULL,
  `fk_type_pub` int(10) UNSIGNED NOT NULL,
  `mark` int(10) NOT NULL,
  `code` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `publication_in_ranking`
--

INSERT INTO `publication_in_ranking` (`idPubRank`, `fk_rank_type`, `fk_type_pub`, `mark`, `code`) VALUES
(1, 1, 5, 30, 'ДБ6'),
(2, 1, 6, 5, 'ДБ8'),
(3, 1, 7, 25, 'ДБ9'),
(4, 1, 8, 30, 'ДБ14'),
(5, 2, 1, 6, 'ДБ4'),
(6, 2, 2, 6, 'ДБ4'),
(7, 2, 8, 6, 'ДБ4'),
(8, 2, 3, 3, 'ДБ5'),
(9, 3, 9, 4, NULL),
(10, 3, 10, 2, NULL),
(11, 3, 11, 0, NULL),
(12, 3, 12, 0, NULL),
(13, 3, 13, 0, NULL),
(14, 3, 14, 0, NULL),
(15, 3, 15, 0, NULL),
(16, 3, 16, 3, NULL),
(17, 3, 17, 2, NULL),
(18, 3, 18, 2, NULL),
(19, 3, 19, 1, NULL),
(20, 3, 20, 0, NULL),
(21, 3, 21, 0, NULL),
(22, 3, 22, 0, NULL),
(23, 3, 23, 0, NULL),
(24, 3, 24, 0, NULL),
(25, 3, 25, 0, NULL),
(26, 3, 26, 0, NULL),
(27, 3, 27, 0, NULL),
(28, 3, 28, 0, NULL),
(29, 3, 29, 0, NULL),
(30, 3, 30, 0, NULL),
(31, 3, 31, 0, NULL),
(32, 3, 32, 0, NULL),
(33, 3, 33, 0, NULL),
(34, 3, 34, 0, NULL),
(35, 3, 35, 0, NULL),
(36, 3, 36, 0, NULL),
(37, 3, 37, 0, NULL),
(38, 3, 38, 2, NULL),
(39, 3, 38, 1, NULL),
(40, 3, 39, 0, NULL),
(41, 3, 40, 0, '0.1'),
(42, 3, 41, 0, NULL);

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
(5, 3, 1, 20, 'ДБ4'),
(13, 6, 1, 5, 'ДБ12'),
(14, 4, 1, 10, 'ДБ10'),
(15, 5, 1, 15, 'ДБ11'),
(16, 7, 1, 2, 'ДБ13'),
(18, 8, 1, 5, 'ДБ15'),
(19, 9, 1, 10, 'ДБ16'),
(20, 10, 1, 5, NULL),
(21, 1, 2, 20, 'ДБ1'),
(22, 2, 2, 15, 'ДБ2'),
(27, 11, 2, 2, 'ДБ6'),
(28, 4, 2, 1, 'ДБ7'),
(29, 6, 2, 1, 'ДБ7'),
(30, 12, 2, 2, 'ДБ6'),
(31, 13, 2, 10, 'ДБ2'),
(63, 14, 3, 1.5, NULL),
(65, 15, 3, 0.3, NULL),
(67, 16, 3, 0.5, NULL);

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
-- Структура таблицы `scient_event`
--

CREATE TABLE `scient_event` (
  `idScientEvent` int(10) UNSIGNED NOT NULL,
  `titleEvent` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `fk_type_res` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `scient_event`
--

INSERT INTO `scient_event` (`idScientEvent`, `titleEvent`, `date`, `fk_type_res`) VALUES
(1, 'Test', '2017', 1),
(2, 'Tessy2', '2018', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `scient_publication`
--

CREATE TABLE `scient_publication` (
  `idPublication` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `edition` varchar(255) DEFAULT NULL,
  `pages` int(11) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `file` varchar(255) NOT NULL,
  `fk_pub_type` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `scient_publication`
--

INSERT INTO `scient_publication` (`idPublication`, `title`, `edition`, `pages`, `date`, `file`, `fk_pub_type`) VALUES
(1, 'Test Article', 'M', 89, '2018', 'xdg', 8);

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
  `type_user` int(10) UNSIGNED NOT NULL,
  `surname_ukr` varchar(255) DEFAULT NULL,
  `name_ukr` varchar(255) DEFAULT NULL,
  `patronymic_ukr` varchar(255) DEFAULT NULL,
  `name_en` varchar(255) DEFAULT NULL,
  `surname_en` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `student`
--

INSERT INTO `student` (`id`, `name`, `patronymic`, `surname`, `FK_Group`, `registration_date`, `last_visit`, `status`, `type_user`, `surname_ukr`, `name_ukr`, `patronymic_ukr`, `name_en`, `surname_en`) VALUES
(1, 'Гарри', 'Джонович', 'Поттер', 26, '2018-05-01 00:00:00', '2018-05-01 00:00:00', 'active', 15, NULL, NULL, NULL, 'Harry', 'Potter');

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
-- Структура таблицы `type_of_publication`
--

CREATE TABLE `type_of_publication` (
  `idTypePub` int(10) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `type_of_publication`
--

INSERT INTO `type_of_publication` (`idTypePub`, `type`) VALUES
(1, 'Наукова стаття у фаховому виданні, що має iмпакт-фактор'),
(2, 'Наукова стаття у фаховому виданні, затвердженному ДАК Укр з фаху'),
(3, 'Наукова стаття в Вiснику студентського наукового товариства ДонНУ з фаху'),
(4, 'Наукова стаття у вітчизняному фаховому виданні'),
(5, 'Наукова стаття у виданні, яке входить до міжнародних науковометричних баз'),
(6, 'Наукова стаття у вітчизняному нефаховому виданні'),
(7, 'Наукова стаття у іноземному виданні'),
(8, 'Патент або авторське свідоцтво'),
(9, 'Видання за рекомендацiєю Вченої ради ДонНУ iмeнi Василя Стуса пiдручника для ВНЗ'),
(10, 'Видання за рекомендацiєю Вченої ради ДонНУ iмeнi Василя Стуса навчального посiбника для ВНЗ'),
(11, 'Розробка робочої навчальної програми нової дисциплiни, практики, затвердженої НМК факультету / Унiверситету (для загальноунiверситетських кафедр), курсу сертифiкатної освiтньої програми, тренiнгової програми.'),
(12, 'Розробка методичного забезпечення навчального процесу: друкований / електронний лекцiйний курс (з дисциплiни 3-5 кредитiв)'),
(13, 'Розробка методичного забезпечення навчального процесу: друкований / електронний лекцiйний  курс (з дисциплiни бiльше 5 кредитiв)'),
(14, 'Розробка методичного забезпечення навчального процесу: друкований / електронний комплекс лабораторних робiт/ практичних, ceмiнapcьких занять (з дисциплiни 3-5 кредитiв) '),
(15, 'Розробка методичного забезпечення навчального процесу: друкований / електронний комплекс лабораторних робiт/ практичних, ceмiнapcьких занять (з дисциплiни бiльше 5 кредитiв)'),
(16, 'Розробка дидактичного та методичного забезпечення дисциплiн за технологiями дистанцiйного навчання - МВОК'),
(17, 'Розробка дидактичного та методичного забезпечення дисциплiн за технологiями дистанцiйного навчання - Moodle'),
(18, 'Розробка навчальних програм та науковометодичного забезпечення дисциплiн iноземною мовою (окрiм росiйської) для спецiальностей немовної пiдготовки'),
(19, 'Викладання навчальної дисциплiни iноземною мовою (окрiм росiйської) для спецiальностей немовної пiдготовки'),
(20, 'Розробка конкурсних завадань до студентських олiмпiад. Обласний рiвень'),
(21, 'Розробка конкурсних завадань до студентських олiмпiад. Всеукраїнський рiвень'),
(22, 'Розробка конкурсних завадань до студентських олiмпiад. Мiжнародний рiвень'),
(23, 'Розробка конкурсних завадань до шкiльних олiмпiад. Обласний рiвень'),
(24, 'Розробка конкурсних завадань до шкiльних олiмпiад. Всеукраїнський рiвень'),
(25, 'Розробка конкурсних завадань до шкiльних олiмпiад. Мiжнародний рiвень'),
(26, 'Розробка конкурсних завадань до конкурсiв МАН. Обласний рiвень'),
(27, 'Розробка конкурсних завадань до конкурсiв МАН. Всеукраїнський рiвень'),
(28, 'Рецензування навчально-методичних матерiалiв: пiдручникiв'),
(29, 'Рецензування навчально-методичних матерiалiв: навчально-методичних посiбникiв'),
(30, 'Рецензування навчально-методичних матерiалiв: методичних вказiвок (рекомендацiй)'),
(31, 'Експертиза: нормативних документiв публiчного обговорення: локальнi'),
(32, 'Експертиза: нормативних документiв публiчного обговорення: загальноукраїнськi'),
(33, 'Експертиза: конкурсних робiт i проектiв'),
(34, 'Експертиза: конкурсних робiт МАН та студентських наукових робiт'),
(35, 'Редагування/лiтературне редагування: пiдручникiв'),
(36, 'Редагування/лiтературне редагування: навчальних посiбникiв'),
(37, 'Редагування/лiтературне редагування: монографiй'),
(38, 'Пiдгтовка документацiї для вiдкритя нових освiтнiх програм або лiцензування/акредитацiї: освiтньої програми/спецiальностi / аспiрантури/докторантури: Голова'),
(39, 'Розробка навчального плану пiдготовки: - Бакалавр – Магiстр -Аспiрант – Сертифiкатної програми/освiтнього проекту'),
(40, 'Складання програм та завдань для вступникiв на: - СО «Бакалавр»; - СО «Магiстр»'),
(41, 'Пiдгтовка документацiї для вiдкритя нових освiтнiх програм або лiцензування/акредитацiї: освiтньої програми/спецiальностi / аспiрантури/докторантури: Член проектної групи');

-- --------------------------------------------------------

--
-- Структура таблицы `type_of_result`
--

CREATE TABLE `type_of_result` (
  `idTypeRes` int(10) UNSIGNED NOT NULL,
  `type_of_res` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `type_of_result`
--

INSERT INTO `type_of_result` (`idTypeRes`, `type_of_res`) VALUES
(1, 'победитель'),
(2, '2 место'),
(3, '3 место'),
(4, 'призёр'),
(5, 'лауреат'),
(6, 'не обязательно'),
(7, 'голова'),
(8, 'секретар');

-- --------------------------------------------------------

--
-- Структура таблицы `type_of_role`
--

CREATE TABLE `type_of_role` (
  `idTypeRole` int(10) UNSIGNED NOT NULL,
  `type_of_role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `type_of_role`
--

INSERT INTO `type_of_role` (`idTypeRole`, `type_of_role`) VALUES
(1, 'участник'),
(2, 'тренер'),
(3, 'голова'),
(4, 'секретарь ');

-- --------------------------------------------------------

--
-- Структура таблицы `type_of_scient_event`
--

CREATE TABLE `type_of_scient_event` (
  `idTypeEvents` int(10) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `type_of_scient_event`
--

INSERT INTO `type_of_scient_event` (`idTypeEvents`, `type`) VALUES
(1, 'Диплом переможця та призера міжнародної студентської олімпіади з фаху'),
(2, 'Диплом переможця та призера всеукраїнської студентської олімпіади МОН України з фаху '),
(3, 'Диплом переможця та призера конкурсу наукових студентських робіт МОН України з фаху'),
(4, 'Участь у науковій міжнародній конференції (за умови опублікування тез доповідей)'),
(5, 'Участь у науковій конференції за межами України (за умови опублікування тез доповідей та наявності сертифікату про участь)'),
(6, 'Участь у науковій всеукраїнській конференції (за умови опублікування тез доповідей)'),
(7, 'Участь у науковій регіональній або вузівській конференції'),
(8, 'Рекомендація вченої ради факультету до вступу в аспірантуру (за наявності)'),
(9, 'Диплом магістра/спеціаліста з відзнакою'),
(10, 'Оцінка за реферат'),
(11, 'Iншi нагороди у накових конкурсах'),
(12, 'Сертифiкат та/або довiдка з iноземної мови'),
(13, 'Диплом переможця та/або призера конкурсу наукових студентських робiт МОН та НАН України, змагань, програм з фаху '),
(14, 'Викладання навчальної дисциплiни у якостi професора-вiзитера'),
(15, 'Робота в НМК/НМР: -	факультету'),
(16, 'Робота в НМК/НМР: -	Унiверситету');

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
(1, 'admin', '$2y$13$NjPiT83TbVVerShtwB2x5u1q65P4P.jXM0fs.1bu2mWdMZ60XFZKK', 'admin@mail.ru', 1, 'KLC896f8knhCyOrxn21VbBbjBe0wKtBmNWiG3RaF7zn8ib9wFRrufB9LKqcm'),
(2, 'methodist', '$2y$13$Fyu6rZXDOlAxLOiHUgmNce5nzJO6vFNTQGD0QWDoFCnVgl3r8BBEC', 'methodist@donnu.edu.ua', 3, 'WRWNACYLZWTMQQBQAmmRNFpJkFtx8ZWarJQ3SGCIB4NnRuIoCOi6ORAdgeBb'),
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
(14, 'ya.shmyriov', '$2y$10$UFC0pWEgpCIt8l1GSv.x4.W9pb2qayOylWC/w8t6bwApDbdJFtleq', 'ya.shmyriov@donnu.edu.ua', 1, NULL),
(15, 'harry', '$2y$13$NjPiT83TbVVerShtwB2x5u1q65P4P.jXM0fs.1bu2mWdMZ60XFZKK', 'harry@gmail.com', 2, 'Q8wPMgzkswJKDBbJaMhegzSaUJpDQfZV4E6wZJVSGHnpGurmPVHXI65BcnxW');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `access`
--
ALTER TABLE `access`
  ADD PRIMARY KEY (`idAccess`);

--
-- Индексы таблицы `authors_of_publication`
--
ALTER TABLE `authors_of_publication`
  ADD PRIMARY KEY (`idPubAuthor`),
  ADD KEY `fk_user_pub_auth` (`fk_user`),
  ADD KEY `fk_pub` (`fk_pub`);

--
-- Индексы таблицы `event_in_ranking`
--
ALTER TABLE `event_in_ranking`
  ADD PRIMARY KEY (`idRankEvent`),
  ADD KEY `fk_rank_types` (`fk_rank_type`),
  ADD KEY `fk_result_types` (`fk_result_type`),
  ADD KEY `fk_event_type` (`fk_event_type`);

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
-- Индексы таблицы `members_of_event`
--
ALTER TABLE `members_of_event`
  ADD PRIMARY KEY (`idMember`),
  ADD KEY `fk_member` (`fk_member`),
  ADD KEY `fk_event` (`fk_event`),
  ADD KEY `fk_result` (`fk_res`),
  ADD KEY `fk_role` (`fk_role`);

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
-- Индексы таблицы `publication_in_ranking`
--
ALTER TABLE `publication_in_ranking`
  ADD PRIMARY KEY (`idPubRank`),
  ADD KEY `fk_type_of_pub_rank` (`fk_type_pub`),
  ADD KEY `fk_type_of_rank` (`fk_rank_type`);

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
-- Индексы таблицы `scient_event`
--
ALTER TABLE `scient_event`
  ADD PRIMARY KEY (`idScientEvent`),
  ADD KEY `fk_type_of_event` (`fk_type_res`);

--
-- Индексы таблицы `scient_publication`
--
ALTER TABLE `scient_publication`
  ADD PRIMARY KEY (`idPublication`),
  ADD KEY `fk_type_of_pub` (`fk_pub_type`);

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
-- Индексы таблицы `type_of_publication`
--
ALTER TABLE `type_of_publication`
  ADD PRIMARY KEY (`idTypePub`);

--
-- Индексы таблицы `type_of_result`
--
ALTER TABLE `type_of_result`
  ADD PRIMARY KEY (`idTypeRes`);

--
-- Индексы таблицы `type_of_role`
--
ALTER TABLE `type_of_role`
  ADD PRIMARY KEY (`idTypeRole`);

--
-- Индексы таблицы `type_of_scient_event`
--
ALTER TABLE `type_of_scient_event`
  ADD PRIMARY KEY (`idTypeEvents`),
  ADD UNIQUE KEY `idtype_certificates_UNIQUE` (`idTypeEvents`);

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
-- AUTO_INCREMENT для таблицы `authors_of_publication`
--
ALTER TABLE `authors_of_publication`
  MODIFY `idPubAuthor` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `event_in_ranking`
--
ALTER TABLE `event_in_ranking`
  MODIFY `idRankEvent` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT для таблицы `group`
--
ALTER TABLE `group`
  MODIFY `idgroup` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT для таблицы `group_subject`
--
ALTER TABLE `group_subject`
  MODIFY `idGroup_subject` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `individual_works`
--
ALTER TABLE `individual_works`
  MODIFY `idInd_work` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `list_of_task`
--
ALTER TABLE `list_of_task`
  MODIFY `idList_of_task` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `members_of_event`
--
ALTER TABLE `members_of_event`
  MODIFY `idMember` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `messages`
--
ALTER TABLE `messages`
  MODIFY `id_Messages` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `professor`
--
ALTER TABLE `professor`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT для таблицы `publication_in_ranking`
--
ALTER TABLE `publication_in_ranking`
  MODIFY `idPubRank` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
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
-- AUTO_INCREMENT для таблицы `scient_event`
--
ALTER TABLE `scient_event`
  MODIFY `idScientEvent` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `scient_publication`
--
ALTER TABLE `scient_publication`
  MODIFY `idPublication` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `student`
--
ALTER TABLE `student`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `subject`
--
ALTER TABLE `subject`
  MODIFY `idSubject` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `type_of_publication`
--
ALTER TABLE `type_of_publication`
  MODIFY `idTypePub` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT для таблицы `type_of_result`
--
ALTER TABLE `type_of_result`
  MODIFY `idTypeRes` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `type_of_role`
--
ALTER TABLE `type_of_role`
  MODIFY `idTypeRole` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `type_of_scient_event`
--
ALTER TABLE `type_of_scient_event`
  MODIFY `idTypeEvents` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;
--
-- AUTO_INCREMENT для таблицы `type_of_works`
--
ALTER TABLE `type_of_works`
  MODIFY `idType` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `idUsers` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `authors_of_publication`
--
ALTER TABLE `authors_of_publication`
  ADD CONSTRAINT `fk_pub` FOREIGN KEY (`fk_pub`) REFERENCES `scient_publication` (`idPublication`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_pub_auth` FOREIGN KEY (`fk_user`) REFERENCES `users` (`idUsers`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `event_in_ranking`
--
ALTER TABLE `event_in_ranking`
  ADD CONSTRAINT `fk_event_type` FOREIGN KEY (`fk_event_type`) REFERENCES `type_of_scient_event` (`idTypeEvents`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_rank_types` FOREIGN KEY (`fk_rank_type`) REFERENCES `res_template` (`idTemplate`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_result_types` FOREIGN KEY (`fk_result_type`) REFERENCES `type_of_result` (`idTypeRes`) ON UPDATE CASCADE;

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
  ADD CONSTRAINT `FK_Task` FOREIGN KEY (`FK_Task`) REFERENCES `list_of_task` (`idList_of_task`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_student` FOREIGN KEY (`FK_Student`) REFERENCES `student` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `list_of_task`
--
ALTER TABLE `list_of_task`
  ADD CONSTRAINT `FK_Typework` FOREIGN KEY (`Type`) REFERENCES `type_of_works` (`idType`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_sub` FOREIGN KEY (`FK_Subject`) REFERENCES `subject` (`idSubject`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `members_of_event`
--
ALTER TABLE `members_of_event`
  ADD CONSTRAINT `fk_event` FOREIGN KEY (`fk_event`) REFERENCES `scient_event` (`idScientEvent`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_member` FOREIGN KEY (`fk_member`) REFERENCES `users` (`idUsers`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_result` FOREIGN KEY (`fk_res`) REFERENCES `type_of_result` (`idTypeRes`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_role` FOREIGN KEY (`fk_role`) REFERENCES `type_of_role` (`idTypeRole`) ON UPDATE CASCADE;

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
-- Ограничения внешнего ключа таблицы `publication_in_ranking`
--
ALTER TABLE `publication_in_ranking`
  ADD CONSTRAINT `fk_type_of_pub_rank` FOREIGN KEY (`fk_type_pub`) REFERENCES `type_of_publication` (`idTypePub`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_type_of_rank` FOREIGN KEY (`fk_rank_type`) REFERENCES `res_template` (`idTemplate`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `res_in_template`
--
ALTER TABLE `res_in_template`
  ADD CONSTRAINT `fkTemp` FOREIGN KEY (`fkTemp`) REFERENCES `res_template` (`idTemplate`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fkTypeR` FOREIGN KEY (`fkType`) REFERENCES `type_of_scient_event` (`idTypeEvents`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `scient_event`
--
ALTER TABLE `scient_event`
  ADD CONSTRAINT `fk_type_of_event` FOREIGN KEY (`fk_type_res`) REFERENCES `type_of_scient_event` (`idTypeEvents`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `scient_publication`
--
ALTER TABLE `scient_publication`
  ADD CONSTRAINT `fk_type_of_pub` FOREIGN KEY (`fk_pub_type`) REFERENCES `type_of_publication` (`idTypePub`) ON DELETE CASCADE ON UPDATE CASCADE;

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
