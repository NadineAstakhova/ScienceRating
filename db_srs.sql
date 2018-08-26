-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Авг 26 2018 г., 19:34
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

-- --------------------------------------------------------

--
-- Структура таблицы `publication_in_ranking`
--

CREATE TABLE `publication_in_ranking` (
  `idPubRank` int(10) UNSIGNED NOT NULL,
  `fk_rank_type` int(10) UNSIGNED NOT NULL,
  `fk_type_pub` int(10) UNSIGNED NOT NULL,
  `mark` float(5,2) NOT NULL,
  `code` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

-- --------------------------------------------------------

--
-- Структура таблицы `res_template`
--

CREATE TABLE `res_template` (
  `idTemplate` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `fileTemplate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

-- --------------------------------------------------------

--
-- Структура таблицы `type_of_result`
--

CREATE TABLE `type_of_result` (
  `idTypeRes` int(10) UNSIGNED NOT NULL,
  `type_of_res` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `type_of_role`
--

CREATE TABLE `type_of_role` (
  `idTypeRole` int(10) UNSIGNED NOT NULL,
  `type_of_role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `type_of_scient_event`
--

CREATE TABLE `type_of_scient_event` (
  `idTypeEvents` int(10) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `type_of_works`
--

CREATE TABLE `type_of_works` (
  `idType` int(10) UNSIGNED NOT NULL,
  `Type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `remember_token` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  MODIFY `idAccess` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `authors_of_publication`
--
ALTER TABLE `authors_of_publication`
  MODIFY `idPubAuthor` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
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
  MODIFY `idMember` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT для таблицы `messages`
--
ALTER TABLE `messages`
  MODIFY `id_Messages` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `professor`
--
ALTER TABLE `professor`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT для таблицы `publication_in_ranking`
--
ALTER TABLE `publication_in_ranking`
  MODIFY `idPubRank` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT для таблицы `res_in_template`
--
ALTER TABLE `res_in_template`
  MODIFY `idRes_in_template` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;
--
-- AUTO_INCREMENT для таблицы `res_template`
--
ALTER TABLE `res_template`
  MODIFY `idTemplate` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `scient_event`
--
ALTER TABLE `scient_event`
  MODIFY `idScientEvent` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT для таблицы `scient_publication`
--
ALTER TABLE `scient_publication`
  MODIFY `idPublication` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
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
  MODIFY `idTypeEvents` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT для таблицы `type_of_works`
--
ALTER TABLE `type_of_works`
  MODIFY `idType` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `idUsers` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
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
