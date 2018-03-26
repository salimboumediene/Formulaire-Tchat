-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 16 Mars 2018 à 18:12
-- Version du serveur :  10.1.16-MariaDB
-- Version de PHP :  7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `formation-php`
--

-- --------------------------------------------------------

--
-- Structure de la table `channel`
--

CREATE TABLE `channel` (
  `channel_id` int(10) NOT NULL,
  `channel_name` varchar(255) NOT NULL,
  `channel_descr` varchar(255) NOT NULL,
  `profile_id` int(10) NOT NULL,
  `channel_capacity` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `channel`
--

INSERT INTO `channel` (`channel_id`, `channel_name`, `channel_descr`, `profile_id`, `channel_capacity`) VALUES
(24, 'Demo', 'A channel example', 37, 5);

-- --------------------------------------------------------

--
-- Structure de la table `channel_message`
--

CREATE TABLE `channel_message` (
  `channel_message_id` int(10) NOT NULL,
  `channel_id` int(10) NOT NULL,
  `profile_id` int(10) NOT NULL,
  `timestamp` int(10) NOT NULL,
  `message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `channel_profile`
--

CREATE TABLE `channel_profile` (
  `channel_profile_id` int(10) NOT NULL,
  `channel_id` int(10) NOT NULL,
  `profile_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `channel_profile`
--

INSERT INTO `channel_profile` (`channel_profile_id`, `channel_id`, `profile_id`) VALUES
(1, 24, 38);

-- --------------------------------------------------------

--
-- Structure de la table `profile`
--

CREATE TABLE `profile` (
  `profile_id` int(11) NOT NULL,
  `profile_firstname` varchar(255) DEFAULT NULL,
  `profile_name` varchar(255) DEFAULT NULL,
  `profile_avatar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `profile`
--

INSERT INTO `profile` (`profile_id`, `profile_firstname`, `profile_name`, `profile_avatar`) VALUES
(37, NULL, NULL, NULL),
(38, NULL, NULL, NULL),
(39, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `role_id` int(10) NOT NULL,
  `role_name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `role`
--

INSERT INTO `role` (`role_id`, `role_name`) VALUES
(2, 'ADMIN'),
(1, 'SUPERADMIN'),
(3, 'USER'),
(4, 'VISITOR');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `user_id` int(10) NOT NULL,
  `user_pswd` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_role` int(11) DEFAULT '4',
  `user_profile` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`user_id`, `user_pswd`, `user_email`, `user_role`, `user_profile`) VALUES
(35, '$2y$10$KYLEAZb2lLeP/n710cNKKuCvM2KSqV2kV1vJoWaxTMRdrj9fyhu/O', 'a@a.fr', 4, 37),
(36, '$2y$10$gANGMpTpI6MUG9viP/UOM.ymzN8wR5TZrsej..NGhCCGF0lhhMs9m', 'b@b.fr', 4, 38),
(37, '$2y$10$SHy5FcSYFbs14Hm7jE6gKO9.t88/T5d/HL/rCxh15d8.9qtD8PTam', 'c@c.fr', 4, 39);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `channel`
--
ALTER TABLE `channel`
  ADD PRIMARY KEY (`channel_id`),
  ADD UNIQUE KEY `channel_name` (`channel_name`,`profile_id`),
  ADD KEY `profile_id` (`profile_id`);

--
-- Index pour la table `channel_message`
--
ALTER TABLE `channel_message`
  ADD PRIMARY KEY (`channel_message_id`),
  ADD KEY `profile_id` (`profile_id`),
  ADD KEY `channel_id` (`channel_id`);

--
-- Index pour la table `channel_profile`
--
ALTER TABLE `channel_profile`
  ADD PRIMARY KEY (`channel_profile_id`),
  ADD UNIQUE KEY `channel_id_2` (`channel_id`,`profile_id`),
  ADD KEY `channel_id` (`channel_id`),
  ADD KEY `profile_id` (`profile_id`);

--
-- Index pour la table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`profile_id`);

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`),
  ADD UNIQUE KEY `role_name` (`role_name`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`),
  ADD KEY `user_role` (`user_role`),
  ADD KEY `user_profile` (`user_profile`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `channel`
--
ALTER TABLE `channel`
  MODIFY `channel_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT pour la table `channel_message`
--
ALTER TABLE `channel_message`
  MODIFY `channel_message_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `channel_profile`
--
ALTER TABLE `channel_profile`
  MODIFY `channel_profile_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `profile`
--
ALTER TABLE `profile`
  MODIFY `profile_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT pour la table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `channel`
--
ALTER TABLE `channel`
  ADD CONSTRAINT `channel_ibfk_1` FOREIGN KEY (`profile_id`) REFERENCES `profile` (`profile_id`);

--
-- Contraintes pour la table `channel_message`
--
ALTER TABLE `channel_message`
  ADD CONSTRAINT `channel_message_ibfk_1` FOREIGN KEY (`channel_id`) REFERENCES `channel` (`channel_id`),
  ADD CONSTRAINT `channel_message_ibfk_2` FOREIGN KEY (`profile_id`) REFERENCES `profile` (`profile_id`);

--
-- Contraintes pour la table `channel_profile`
--
ALTER TABLE `channel_profile`
  ADD CONSTRAINT `channel_profile_ibfk_1` FOREIGN KEY (`channel_id`) REFERENCES `channel` (`channel_id`),
  ADD CONSTRAINT `channel_profile_ibfk_2` FOREIGN KEY (`profile_id`) REFERENCES `profile` (`profile_id`);

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`user_role`) REFERENCES `role` (`role_id`),
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`user_profile`) REFERENCES `profile` (`profile_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
