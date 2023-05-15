-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3308
-- Généré le :  sam. 06 mai 2023 à 19:37
-- Version du serveur :  5.7.28
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `pfa`
--

-- --------------------------------------------------------

--
-- Structure de la table `departements`
--

DROP TABLE IF EXISTS `departements`;
CREATE TABLE IF NOT EXISTS `departements` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `intitule` varchar(500) NOT NULL,
  `abreviation` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COMMENT='departements';

--
-- Déchargement des données de la table `departements`
--

INSERT INTO `departements` (`id`, `intitule`, `abreviation`) VALUES
(1, 'Genie Electrique', 'ELCT'),
(2, 'Genie Informatique', 'INF'),
(3, 'Genie Mecanique', 'MKNK'),
(4, 'Gestion , Finance & Comptabilité', 'GST'),
(5, 'Genie Civile', 'CIV'),
(6, 'Droit Politiquee', 'Droit'),
(7, 'Genie MecaniqueMecanique', 'Genie Mecanique'),
(8, 'MecaniqueMecanique', 'MecaniqueGenie Mecanique');

-- --------------------------------------------------------

--
-- Structure de la table `laboratoires`
--

DROP TABLE IF EXISTS `laboratoires`;
CREATE TABLE IF NOT EXISTS `laboratoires` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `intitule` varchar(100) DEFAULT NULL,
  `abreviation` varchar(100) DEFAULT NULL,
  `departement_id` int(20) DEFAULT NULL,
  `directeur_labo_id` int(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COMMENT='laboratoires';

--
-- Déchargement des données de la table `laboratoires`
--

INSERT INTO `laboratoires` (`id`, `intitule`, `abreviation`, `departement_id`, `directeur_labo_id`) VALUES
(1, 'Traitement Image', 'Tr.img', 1, 2),
(2, 'Traitement Signal', 'Tr.sign', 1, 2),
(3, 'Paroles audio', 'Prl', 1, 2),
(4, 'Siscom & Telecommunications', 'Sisc', 2, 3),
(5, 'Réseaux ', 'Rx', 2, 3),
(6, 'Developpement', 'Dev', 2, 3),
(7, 'Cloud', 'Cld', 2, 3),
(8, 'Intelligence Artificielle', 'Ai', 2, 3),
(9, 'Techniques et contrôle bancaire', 'BNK', 4, 5),
(11, 'ssddd', 'ssddd', 12, 12),
(12, 'ased1111', 'asedased', 11, 11),
(14, 'departemeased', 'asedd', 5, 39),
(15, 'isset($_POST[\'intitule\']) && !empty', 'departeme', 2, 37),
(16, 'Laboratoire test', 'Labtest', 2, 14),
(17, 'Laboratoire testé', 'Labtest2', 5, 37);

-- --------------------------------------------------------

--
-- Structure de la table `sujetsprojets`
--

DROP TABLE IF EXISTS `sujetsprojets`;
CREATE TABLE IF NOT EXISTS `sujetsprojets` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `intitule` varchar(100) DEFAULT NULL,
  `abreviation` varchar(100) DEFAULT NULL,
  `enseignant_id` int(20) DEFAULT NULL,
  `etudiant_id` int(20) DEFAULT NULL,
  `labo_id` int(20) DEFAULT NULL,
  `NiveauSujet` varchar(100) DEFAULT 'Master',
  `Description` varchar(1000) DEFAULT 'Description du sujet',
  `Detail` varchar(1000) DEFAULT 'Detail du sujet',
  `Objectif` varchar(1000) DEFAULT 'Objectif du sujet',
  `DatesDelais` varchar(100) DEFAULT 'Dates',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COMMENT='SujetsProjets';

--
-- Déchargement des données de la table `sujetsprojets`
--

INSERT INTO `sujetsprojets` (`id`, `intitule`, `abreviation`, `enseignant_id`, `etudiant_id`, `labo_id`, `NiveauSujet`, `Description`, `Detail`, `Objectif`, `DatesDelais`) VALUES
(1, 'SujetX Master labo.Electronique', 'sjt1.1', 11, 1, 1, 'Master', 'SujetX Master labo.Electronique', 'SujetX Master labo.Electronique', 'Sujet Master labo.Electronique', '2023-05-31'),
(2, 'SujetY Doctorat labo.Electronique', 'sjt1.2', 12, 1, 1, 'Doctorat', 'SujetY Doctorat labo.Electronique', 'SujetY Doctorat labo.Electronique', 'SujetY Doctorat labo.Electronique', '2023-05-31'),
(3, 'SujetYY Doctorat Traitement Signal ', 'sjt1.3', 13, 1, 1, 'Doctorat', 'SujetYY Doctorat Traitement Signal ', 'SujetYY Doctorat Traitement Signal ', 'SujetYY Doctorat Traitement Signal ', '2023-05-31'),
(4, 'SujetY MASTER labo.Electronique	', 'M;lab;ELEC', 4, 4, 4, 'Master de Recherche', 'SujetY MASTER labo.Electronique	SujetY MASTER labo.Electronique	SujetY MASTER labo.Electronique	', 'SujetY MASTER labo.Electronique	SujetY MASTER labo.Electronique	', 'SujetY MASTER labo.Electronique	SujetY MASTER labo.Electronique	SujetY MASTER labo.Electronique	', '2023-06-02'),
(5, 'isset($_POST[\'intitule\']) && !empty($_POST[\'intitule\']', 'isset($_PO', 44444, 4444, 4444, 'Master de Recherche', 'isset($_POST[\'intitule\']) && !empty($_POST[\'intitule\']', 'isset($_POST[\'intitule\']) && !empty($_POST[\'intitule\']', 'isset($_POST[\'intitule\']) && !empty($_POST[\'intitule\']', '2023-05-27'),
(6, 'http://localhost/cp/sujetedit.php?id=6http://local', 'http://localhost/cp/', 11, 121, 121, 'These de Doctorat', 'http://localhost/cp/sujetadd.phphttp://localhost/cp/sujetadd.phphttp://localhost/cp/sujetadd.php', 'http://localhost/cp/sujetadd.phphttp://localhost/cp/sujetadd.phphttp://localhost/cp/sujetadd.phphttp://localhost/cp/sujetadd.phphttp://localhost/cp/sujetadd.php', 'http://localhost/cp/sujetadd.php', '2023-05-31'),
(7, 'Sujetzz Doctorat Traitement Signal', 'DctTratSig', 12, 15, 15, 'These de Doctorat', 'Sujetzz Doctorat Traitement SignalSujetzz Doctorat Traitement SignalSujetzz Doctorat Traitement Signal', 'http://localhost/cp/sujetadd.php', 'http://localhost/cp/sujetadd.php', '2023-05-31');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `cin` int(20) DEFAULT NULL,
  `nom` varchar(100) DEFAULT 'anonyme',
  `prenom` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT 'Directeur.Labo@mail.com',
  `pwd` varchar(100) NOT NULL DEFAULT 'P@55w0rd',
  `telephone` varchar(100) NOT NULL DEFAULT 'telephone',
  `categorie` varchar(100) NOT NULL DEFAULT 'Etudiant',
  `sujet_id` int(20) NOT NULL DEFAULT '100',
  `actif` int(10) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `cin` (`cin`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COMMENT='users';

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `cin`, `nom`, `prenom`, `email`, `pwd`, `telephone`, `categorie`, `sujet_id`, `actif`) VALUES
(12, 12345678, 'Enseignant12345678', 'Enseignant12345678', 'Enseignant1234567.Labo.Elc@mail.com', '12345678', 'telephone', 'Maitre de Conference', 123456789, 1),
(13, 13131313, 'Enseignant13', 'Enseignant13', 'Enseignant13.Labo.Elc@mail.com', 'P@55w0rd', 'telephone', 'Maitre Assisstant', 3, 0),
(14, 2222222, 'anonyme2', 'jjjjj', 'Directeur.Labo@mail.com', 'P@55w0rd', 'telephone', 'Proffesseur', 100, 1),
(18, 5555555, 'lllllllllllllll', 'llllllllll', 'lllllllllll@gloimail.com', '55555555555', '555555555', 'Maitre de Conference', 2, 1),
(22, 111111, 'salam', 'salam', 'salam@gloimail.com', 'salamsalam', '55225522', 'Etudiant Mastere', 7, 1),
(24, 11111, 'salam', 'salam', 'salamsalam@gmail.com', 'ffffsalsamdss', '+216 29 675 983', 'Etudiant doctorat', 44, 1),
(25, 23333333, 'madder', 'Ines', 'sayari.naim@gmail.com', 'ojopiji', '55225522444', 'Maitre Assisstant', 41, 1),
(27, 11, 'madder', 'Ines', 'sayari.naim@gmail.com', 'sayari.naim@gmail.com', '55225522', 'Maitre de Conference', 7, 1),
(29, 3333333, 'sayari.naim', 'sayari.naim', 'sayari.naim@sayari.naim.com', 'sayari.naim', '02020202', 'Etudiant doctorat', 5, 1),
(33, 1010101010, 'kais', 'kais', 'kais.kais@gmail.com', '7747171', '01010101', 'enseignant', 101, 1),
(34, 5545, 'Enseignant123456', 'Enseignant12345', 'odo.trial@gmail.com', 'u,yluyi', 'uln,iuyni', 'Maitre de Conference', 444, 1),
(37, 1124666666, '1124666666', '1124666666', '1124666666@hhhh.hgt', '1124666666', '1124666666', 'Proffesseur', 2, 1),
(38, 19988776, 'Ajouter ', 'Ajouter ', 'Ajouter^@hot.ffr', 'Ajouter v', '123567890', 'Etudiant Mastere', 1, 1),
(39, 22222200, 'Ajouter2', 'Ajouter2', 'Ajouter2@hot.ffr', '2222222222222222222222', '222222222', 'Proffesseur', 3, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
