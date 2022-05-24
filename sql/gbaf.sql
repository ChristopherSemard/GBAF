-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           5.7.36 - MySQL Community Server (GPL)
-- SE du serveur:                Win64
-- HeidiSQL Version:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Listage de la structure de la table gbaf. comments
CREATE TABLE IF NOT EXISTS `comments` (
  `id_comment` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_partner` int(11) NOT NULL,
  `date_add` datetime NOT NULL,
  `comment` varchar(500) NOT NULL,
  PRIMARY KEY (`id_comment`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

-- Listage des données de la table gbaf.comments : 1 rows
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT IGNORE INTO `comments` (`id_comment`, `id_user`, `id_partner`, `date_add`, `comment`) VALUES
	(5, 1, 1, '2022-05-24 15:08:39', 'Salut ceci est un commentaire'),
	(6, 1, 1, '2022-05-24 16:12:29', 'dfjigerhqgrhqegrhqegr'),
	(7, 1, 2, '2022-05-24 16:14:33', 'dfjigerhqgrhqegrhqegr'),
	(8, 1, 2, '2022-05-24 16:14:36', 'shhgs');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;

-- Listage de la structure de la table gbaf. partners
CREATE TABLE IF NOT EXISTS `partners` (
  `id_partner` int(11) NOT NULL AUTO_INCREMENT,
  `partner` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `description` varchar(2000) NOT NULL,
  `logo` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_partner`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Listage des données de la table gbaf.partners : 4 rows
/*!40000 ALTER TABLE `partners` DISABLE KEYS */;
INSERT IGNORE INTO `partners` (`id_partner`, `partner`, `slug`, `description`, `logo`) VALUES
	(1, 'Formation&co\r\n', 'formation-and-co', 'Formation&co est une association française présente sur tout le territoire.\r\nNous proposons à des personnes issues de tout milieu de devenir entrepreneur grâce à un crédit et un accompagnement professionnel et personnalisé.\r\nNotre proposition : \r\n- un financement jusqu’à 30 000€ ;\r\n- un suivi personnalisé et gratuit ;\r\n- une lutte acharnée contre les freins sociétaux et les stéréotypes.\r\n\r\nLe financement est possible, peu importe le métier : coiffeur, banquier, éleveur de chèvres… . Nous collaborons avec des personnes talentueuses et motivées.\r\nVous n’avez pas de diplômes ? Ce n’est pas un problème pour nous ! Nos financements s’adressent à tous.\r\n', '../assets/images/formation_co.png'),
	(2, 'Protectpeople\r\n', 'protect-people', 'Protectpeople finance la solidarité nationale.\r\nNous appliquons le principe édifié par la Sécurité sociale française en 1945 : permettre à chacun de bénéficier d’une protection sociale.\r\n\r\nChez Protectpeople, chacun cotise selon ses moyens et reçoit selon ses besoins.\r\nProectecpeople est ouvert à tous, sans considération d’âge ou d’état de santé.\r\nNous garantissons un accès aux soins et une retraite.\r\nChaque année, nous collectons et répartissons 300 milliards d’euros.\r\nNotre mission est double :\r\nsociale : nous garantissons la fiabilité des données sociales ;\r\néconomique : nous apportons une contribution aux activités économiques.\r\n', '../assets/images/protectpeople.png'),
	(3, 'Dsa France\r\n', 'dsa-france', 'Dsa France accélère la croissance du territoire et s’engage avec les collectivités territoriales.\r\nNous accompagnons les entreprises dans les étapes clés de leur évolution.\r\nNotre philosophie : s’adapter à chaque entreprise.\r\nNous les accompagnons pour voir plus grand et plus loin et proposons des solutions de financement adaptées à chaque étape de la vie des entreprises.\r\n', '../assets/images/Dsa_france.png'),
	(4, 'CDE\r\n', 'cde', 'La CDE (Chambre Des Entrepreneurs) accompagne les entreprises dans leurs démarches de formation. \r\nSon président est élu pour 3 ans par ses pairs, chefs d’entreprises et présidents des CDE.\r\n', '../assets/images/CDE.png');
/*!40000 ALTER TABLE `partners` ENABLE KEYS */;

-- Listage de la structure de la table gbaf. users
CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(60) NOT NULL,
  `question` int(11) NOT NULL DEFAULT '0',
  `reponse` varchar(100) NOT NULL,
  PRIMARY KEY (`id_user`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Listage des données de la table gbaf.users : 1 rows
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT IGNORE INTO `users` (`id_user`, `nom`, `prenom`, `username`, `password`, `question`, `reponse`) VALUES
	(1, 'Semard', 'Christopher', 'Christopher', '$2y$10$yxflUnzXi6FkUU7OV.EwE.qWRaStkyLWJEf1ENVwPdQ5nwerlnRhW', 0, 'Rouen');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Listage de la structure de la table gbaf. votes
CREATE TABLE IF NOT EXISTS `votes` (
  `id_user` int(11) NOT NULL,
  `id_partner` int(11) NOT NULL,
  `vote` int(11) NOT NULL,
  UNIQUE KEY `id_user` (`id_user`),
  UNIQUE KEY `id_partner` (`id_partner`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- Listage des données de la table gbaf.votes : 0 rows
/*!40000 ALTER TABLE `votes` DISABLE KEYS */;
/*!40000 ALTER TABLE `votes` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
