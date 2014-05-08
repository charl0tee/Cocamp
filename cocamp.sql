-- phpMyAdmin SQL Dump
-- version 4.1.13
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Jeu 08 Mai 2014 à 12:35
-- Version du serveur :  5.6.17
-- Version de PHP :  5.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `cocamp`
--

-- --------------------------------------------------------

--
-- Structure de la table `Annonce`
--

CREATE TABLE IF NOT EXISTS `Annonce` (
  `IdAnn` int(11) NOT NULL AUTO_INCREMENT,
  `TitreAnn` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `PrixAnn` decimal(10,0) DEFAULT NULL,
  `DateAnn` date DEFAULT NULL,
  `DescrAnn` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `CatAnn` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `IdMembre` int(11) NOT NULL,
  `IdLocal` int(11) NOT NULL,
  PRIMARY KEY (`IdAnn`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Contenu de la table `Annonce`
--

INSERT INTO `Annonce` (`IdAnn`, `TitreAnn`, `PrixAnn`, `DateAnn`, `DescrAnn`, `CatAnn`, `IdMembre`, `IdLocal`) VALUES
(1, 'Fiesta', '150', '2014-03-25', 'C''est la fête ce soir au 12 rue général Leclerc ! Barnabé sera le gogodanceur de la soirée et il vous servira des cocktails super trop bon de la vie !\r\n\r\nCa commencera à 18h et ça se terminera à 18h30, alors ne soyez pas en retard !   ', 'Evenement', 34, 1),
(16, 'vends ballon', '500', '2014-04-29', 'Je vends des superbes ballons colorés, pas cher, pas cher', 'PetiteAnnonce', 33, 1);

-- --------------------------------------------------------

--
-- Structure de la table `Commentaire`
--

CREATE TABLE IF NOT EXISTS `Commentaire` (
  `IdMembre` int(11) NOT NULL,
  `IdAnn` int(11) NOT NULL,
  `ContenuCom` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `DateCom` datetime DEFAULT NULL,
  PRIMARY KEY (`IdMembre`,`IdAnn`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `Image`
--

CREATE TABLE IF NOT EXISTS `Image` (
  `IdImage` int(11) NOT NULL AUTO_INCREMENT,
  `UrlImage` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `IdAnn` int(11) NOT NULL,
  PRIMARY KEY (`IdImage`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Contenu de la table `Image`
--

INSERT INTO `Image` (`IdImage`, `UrlImage`, `IdAnn`) VALUES
(1, '1', 1),
(16, '16', 16);

-- --------------------------------------------------------

--
-- Structure de la table `Localisation`
--

CREATE TABLE IF NOT EXISTS `Localisation` (
  `IdLocal` int(11) NOT NULL AUTO_INCREMENT,
  `VilleLocal` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `CodePostLocal` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`IdLocal`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Contenu de la table `Localisation`
--

INSERT INTO `Localisation` (`IdLocal`, `VilleLocal`, `CodePostLocal`) VALUES
(1, 'Montbéliard', '25200'),
(2, 'Audincourt', '25400'),
(3, 'Bethoncourt', '25200'),
(4, 'Sainte-Suzanne', '25630'),
(5, 'Allenjoie', '25490'),
(6, 'Arbouans', '25400'),
(7, 'Badevel', '25490'),
(8, 'Bart', '25420'),
(9, 'Bavans', '25550'),
(10, 'Brognard', '25600'),
(11, 'Courcelles-lès-Montbéliard', '25420'),
(12, 'Dambenois', '25600'),
(13, 'Dampierre-les-Bois', '25490'),
(14, 'Dasle', '25230'),
(15, 'Etupes', '25460'),
(16, 'Exincourt', '25400'),
(17, 'Fesches-le-Châtel', '25490'),
(18, 'Grand-Charmont', '25200'),
(19, 'Hérimoncourt', '25310'),
(20, 'Mandeure', '25350'),
(21, 'Mathay', '25700'),
(22, 'Nommay', '25600'),
(23, 'Seloncourt', '25230'),
(24, 'Sochaux', '25600'),
(25, 'Taillecourt', '25400'),
(26, 'Valentigney', '25700'),
(27, 'Vandoncourt', '25230'),
(28, 'Vieux-Charmont', '25600'),
(29, 'Voujeaucourt', '25420');

-- --------------------------------------------------------

--
-- Structure de la table `Membre`
--

CREATE TABLE IF NOT EXISTS `Membre` (
  `IdMembre` int(11) NOT NULL AUTO_INCREMENT,
  `NomMembre` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `PrenomMembre` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `MdpMembre` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `MailMembre` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ScolMembre` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `AgeMembre` int(2) DEFAULT NULL,
  `PhotoMembre` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`IdMembre`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Contenu de la table `Membre`
--

INSERT INTO `Membre` (`IdMembre`, `NomMembre`, `PrenomMembre`, `MdpMembre`, `MailMembre`, `ScolMembre`, `AgeMembre`, `PhotoMembre`) VALUES
(33, 'Habre', 'Charlotte', 'cocamp', 'charl0tee@hotmail.fr', 'Master 1 PSM', 21, '18'),
(34, 'Penneroux', 'Gabrielle', 'cocamp', 'plume412@hotmail.com', 'Master 1 PSM', 21, '34');

-- --------------------------------------------------------

--
-- Structure de la table `Message`
--

CREATE TABLE IF NOT EXISTS `Message` (
  `IdMessage` int(11) NOT NULL AUTO_INCREMENT,
  `IdSender` int(11) NOT NULL,
  `IdReceiver` int(11) NOT NULL,
  `ContenuMess` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `DateMess` datetime DEFAULT NULL,
  PRIMARY KEY (`IdMessage`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `Message`
--

INSERT INTO `Message` (`IdMessage`, `IdSender`, `IdReceiver`, `ContenuMess`, `DateMess`) VALUES
(5, 33, 33, 'Salut !', '2014-04-29 22:41:37');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
