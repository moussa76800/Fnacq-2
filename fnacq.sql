-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 11 Mai 2022 à 20:15
-- Version du serveur :  5.6.20
-- Version de PHP :  5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `fnacq`
--

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
`id` int(11) NOT NULL,
  `articleId` int(11) NOT NULL,
  `author` varchar(50) NOT NULL,
  `comment` varchar(256) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Contenu de la table `comments`
--

INSERT INTO `comments` (`id`, `articleId`, `author`, `comment`, `created_at`) VALUES
(20, 1, 'moussa', 'bingo', '2022-01-11 21:02:24'),
(21, 2, 'Michel', 'Je trouve que ce langage est le meilleur pour d&eacute;velopper .', '2022-01-11 22:19:57'),
(22, 11, 'moussa', 'Le covid, quelle mis&egrave;re !!', '2022-01-11 22:35:13'),
(23, 10, 'moussa', 'bravooo!!', '2022-01-11 22:46:06'),
(24, 10, 'Marc', '&agrave; m&eacute;diter !!', '2022-01-11 22:46:46'),
(25, 10, 'Michel', 'Cette article est tr&egrave;s instructif !!', '2022-01-12 18:42:29'),
(26, 11, 'Marc', 'Apr&egrave;s le Covid Macron,voici le Covid Omnicron !\r\nQuelle merde !!!', '2022-01-12 19:50:54'),
(27, 10, 'Michel', 'a quand,le prochain article ?', '2022-01-13 21:53:30'),
(28, 11, 'Michel', 'superbe post .', '2022-01-13 22:39:01'),
(29, 1, 'Marc', 'Java est le langage de l''an 2000..', '2022-01-13 22:40:00'),
(30, 3, 'Marc', 'Le langage C est un langage de programmation qui est toujours d''actualit&eacute;.', '2022-01-15 09:47:34'),
(31, 3, 'moussa', 'Je rejoins ce qu''&agrave; mentionner Marc &agrave; propos de ce langage de programmation.', '2022-01-15 09:49:31'),
(32, 1, 'moussa', 'bbbbbb', '2022-01-24 13:42:49'),
(33, 11, 'Chennou', 'J''ai eu la covid et franchement c''est flippant !!!', '2022-04-03 17:42:16');

-- --------------------------------------------------------

--
-- Structure de la table `detail_order`
--

CREATE TABLE IF NOT EXISTS `detail_order` (
  `id_article` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `order_id` int(11) NOT NULL,
  `quantity_article` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `detail_order`
--

INSERT INTO `detail_order` (`id_article`, `category`, `order_id`, `quantity_article`) VALUES
(4, 'livre', 10, 3),
(26, 'livre', 10, 1),
(6, 'hifi', 10, 1),
(3, 'informatique', 11, 1),
(26, 'livre', 11, 4),
(2, 'hifi', 11, 1);

-- --------------------------------------------------------

--
-- Structure de la table `hifi`
--

CREATE TABLE IF NOT EXISTS `hifi` (
`id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `article` varchar(256) NOT NULL,
  `marque` varchar(256) NOT NULL,
  `price` int(128) NOT NULL,
  `image` varchar(150) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `hifi`
--

INSERT INTO `hifi` (`id`, `category`, `article`, `marque`, `price`, `image`) VALUES
(1, 'hifi', 'Casque Bluetooth', 'Yamaha', 49, 'casque.jpg'),
(2, 'hifi', 'Enceinte Bluetooth', 'Sony', 99, 'enceinteBluetooth.jpg'),
(6, 'hifi', 'Micro Chaine', 'Grundig', 149, 'microChaine.jpg'),
(7, 'hifi', 'Home Cinema', 'Philips', 158, 'homeCinema.jpg'),
(9, 'hifi', 'Mini Amplificateur', 'Samsung', 200, 'miniAmplificateur.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `informatique`
--

CREATE TABLE IF NOT EXISTS `informatique` (
`id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `article` varchar(256) NOT NULL,
  `marque` varchar(256) NOT NULL,
  `price` int(40) NOT NULL,
  `image` varchar(256) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `informatique`
--

INSERT INTO `informatique` (`id`, `category`, `article`, `marque`, `price`, `image`) VALUES
(1, 'informatique', 'Clavier-Gamer', 'Yamaha', 49, 'clavierGamer.jpg'),
(2, 'informatique', 'Sony', 'PC', 399, 'pc.jpg'),
(3, 'informatique', 'PC Portable', 'Samsung', 200, 'pcPortable.jpg'),
(4, 'informatique', 'Souris Optique', 'Philips', 15, 'sourisOptique.jpg'),
(5, 'informatique', 'Tour-Gaming', 'Grundig', 149, 'tourGaming.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `livres`
--

CREATE TABLE IF NOT EXISTS `livres` (
`id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `title` varchar(150) NOT NULL,
  `authors` varchar(150) NOT NULL,
  `numbersOfPages` int(11) NOT NULL,
  `price` float NOT NULL,
  `image` varchar(150) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Contenu de la table `livres`
--

INSERT INTO `livres` (`id`, `category`, `title`, `authors`, `numbersOfPages`, `price`, `image`) VALUES
(1, 'livre', 'Algorithmes selon H2PROG', 'H2PROG', 300, 48, 'algo.png'),
(2, 'livre', 'La France d''avant ', 'Robert Paul', 300, 30, 'france.png'),
(3, 'livre', 'Je progresse en informatique', 'Nathan', 158, 60, 'jeprogresseenInformatique.jpg'),
(4, 'livre', 'JS Client VS JS Serveur', 'Laurent Fabius', 249, 56, 'JS.png'),
(5, 'livre', 'Le virus informatique d''Asie', 'Lee Chao', 333, 35, 'virus.png'),
(26, 'livre', 'Le livre de la jungle', 'Disney', 2, 22, '71853_2252_livre de la jungle.jpg'),
(27, 'livre', 'Le mechant', 'Albert Camus', 111, 88, '78521_images.jpg'),
(28, 'livre', 'Harry Potter et le magicien d''Oz', 'Bart simpson', 354, 89, '18114_potter.jpg'),
(29, 'livre', 'La gloire de mon père', 'Pagnol Marcel', 189, 35, '28785_pagnoljpg.jpg'),
(30, 'livre', 'La bête humaine', 'Zola Emile', 301, 53, '51489_LaBeteHumaine.jpg'),
(32, 'livre', 'On ne badine pas avec l''amour', 'Musset Alfred', 89, 25, '80284_musset.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `order`
--

CREATE TABLE IF NOT EXISTS `order` (
`id_order` int(11) NOT NULL,
  `date_order` date NOT NULL,
  `login` varchar(50) NOT NULL,
  `total_prix` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Contenu de la table `order`
--

INSERT INTO `order` (`id_order`, `date_order`, `login`, `total_prix`) VALUES
(10, '2022-05-11', 'youbrf', 339),
(11, '2022-05-09', 'youbrf', 387);

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
`id` int(11) NOT NULL,
  `author` varchar(256) NOT NULL,
  `title` varchar(256) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Contenu de la table `posts`
--

INSERT INTO `posts` (`id`, `author`, `title`, `content`, `image`, `created_at`) VALUES
(1, 'Martin', 'Apprendre le language PHP', '\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Atque itaque totam ex sed ratione sit exercitationem, doloribus sequi ullam distinctio voluptatem id tenetur, voluptatibus in cum officia impedit veniam nesciunt!\r\nNam, rerum sed minus, consequuntur ducimus asperiores ipsa consequatur vitae similique sequi nostrum iusto quaerat cumque. Ratione minus dignissimos deleniti laboriosam, aliquam ullam et, id tenetur, ab iste quidem. Laboriosam?\r\nAliquid ullam vitae ratione reiciendis sunt? Ab aperiam, repudiandae quasi officia sit eligendi cupiditate perferendis? Ipsam accusamus numquam, exercitationem deserunt reiciendis nobis optio explicabo incidunt harum \r\n\r\n', 'php.png', '2021-12-28 00:00:00'),
(2, 'Loana', 'Apprendre le language Java', '\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Atque itaque totam ex sed ratione sit exercitationem, doloribus sequi ullam distinctio voluptatem id tenetur, voluptatibus in cum officia impedit veniam nesciunt!\r\nNam, rerum sed minus, consequuntur ducimus asperiores ipsa consequatur vitae similique sequi nostrum iusto quaerat cumque. Ratione minus dignissimos deleniti laboriosam, aliquam ullam et, id tenetur, ab iste quidem. Laboriosam?\r\n', 'java.png', '2021-12-28 00:00:00'),
(3, 'Bertrand', 'Apprendre le language C', '\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Atque itaque totam ex sed ratione sit exercitationem, doloribus sequi ullam distinctio voluptatem id tenetur, voluptatibus in cum officia impedit veniam nesciunt!\r\nNam, rerum sed minus, consequuntur ducimus asperiores ipsa consequatur vitae similique sequi nostrum iusto quaerat cumque. Ratione minus dignissimos deleniti laboriosam, aliquam ullam et, id tenetur, ab iste quidem. Laboriosam?\r\nAliquid ullam vitae ratione reiciendis sunt? Ab aperiam, repudiandae quasi ', 'c.jpg', '2021-12-28 00:00:00'),
(10, 'Moussa', 'Comment poster un article dans le blog ?', 'Écrire un article de blog, ce n’est pas « écrire du texte » et « le mettre en ligne ». Pour avoir une chance que votre article soit lu, il vous faut respecter les codes de la publication web. Pour cela, mieux vaut avoir une méthode aboutie pour éviter d’oublier les points essentiels.  Voici comment je procède et comment vous pouvez faire vous-aussi, je vous indique au passage les outils qui me facilitent la tâche.', '54281_blog.jpg', '2022-01-04 00:00:00'),
(11, 'Youssef', 'Après le Covid-19, pour un nouveau modèle d''aménagement urbain ! ', 'Il y a encore quelques semaines, qui aurait pu se douter que l''on en arriverait là ? Un virus venu de Chine, comme les précédents du reste, provoquant à travers la planète la plus grande crise sanitaire jamais observée depuis cent ans avec des répercussions économiques et sociales dont on ne mesure pas encore tous les effets dévastateurs pour les pays et les populations ! Le Covid-19, ce virus ainsi appelé nous rappelle que le monde dans lequel nous vivons est fragile et que son émergence est liée aux désordres écologiques que nous observons depuis plusieurs années.', '49682_corona.jpg', '2022-01-05 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `tchat`
--

CREATE TABLE IF NOT EXISTS `tchat` (
`id` int(11) NOT NULL,
  `user` varchar(256) CHARACTER SET utf8 NOT NULL,
  `message` varchar(256) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=120 ;

--
-- Contenu de la table `tchat`
--

INSERT INTO `tchat` (`id`, `user`, `message`) VALUES
(25, 'MERCI', 'MERCI'),
(26, 'MERCI', 'MERCI'),
(27, 'PAPA', 'PAPA'),
(28, 'PAPA', 'PAPA'),
(29, 'MAMAN', 'MERCI MAMAN'),
(30, '', ''),
(31, 'francois ', 'magnifique site !!!'),
(32, 'LOULOU DE CACHAREL', 'mmmm'),
(33, 'LOULOU DE CACHAREL', 'mmmm'),
(34, 'gilles verdes', 'je trouve ce site repugnant'),
(35, 'louli', 'loulo'),
(36, 'louli', 'loulo'),
(37, 'louli', 'loulo'),
(38, 'mamannon', 'meeee'),
(39, 'apa', 'apa'),
(40, 'charles dubois', 'ingenieux'),
(41, 'oooooo', ''),
(42, 'oooooo', ''),
(43, 'merde', 'merdre'),
(44, 'merde', 'merdre'),
(45, 'momo', 'momo'),
(46, 'momo', 'momo'),
(47, 'maman', 'maman'),
(48, 'maman', 'maman'),
(49, 'maman', 'maman'),
(50, 'maman', 'maman'),
(51, 'chennou', 'youssef'),
(52, 'chennou', 'youssef'),
(53, 'chennou', 'youssef'),
(54, 'arbibl', 'loo'),
(55, 'arbibl', 'loo'),
(56, 'arbibl', 'loo'),
(57, 'arbibl', 'loo'),
(58, 'arbibl', 'loo'),
(59, 'arbibl', 'loo'),
(60, 'arbibl', 'loo'),
(61, 'MICHEL', 'AU REVOIR\r\n'),
(62, '', ''),
(63, 'POISSON', 'poisson'),
(64, 'POISSON', 'poisson'),
(65, '', ''),
(66, '', ''),
(67, '', ''),
(68, 'LOULOU DE CACHAREL', 'SUPER SITE !!!'),
(69, 'non', 'non'),
(70, 'non', 'non'),
(71, 'OUI', 'OUI'),
(72, 'OUI', 'OUI'),
(73, '', ''),
(74, '', ''),
(75, '', ''),
(76, '', ''),
(77, 'PPPPPP', ''),
(78, 'OOOO', ''),
(79, 'OOOO', ''),
(80, 'moussa', 'POPO'),
(81, 'moussa', 'POPO'),
(82, 'moussa', 'POPO'),
(83, '', ''),
(84, '', ''),
(85, 'michel', 'super beau site,je recommandes !!!'),
(86, 'lolo', 'lolo'),
(87, 'Robert', 'Je vous conseille d''acheter chez ce vrai FNACQ .....'),
(88, 'Robert', 'Je vous conseille d''acheter chez ce vrai FNACQ .....'),
(89, 'Robert', 'bah,c''est encore moi,il n''y a plus personnes sur ce site....'),
(90, 'toto', 'TOTO'),
(91, 'Marc', 'je trouve ce site ,super génial !!'),
(92, '', ''),
(93, '', ''),
(94, '', ''),
(95, '', ''),
(96, '', ''),
(97, '', ''),
(98, '', ''),
(99, '', ''),
(100, '', ''),
(101, '', ''),
(102, '', ''),
(103, '', ''),
(104, '', ''),
(105, '', ''),
(106, '', ''),
(107, '', ''),
(108, '', ''),
(109, '', ''),
(110, 'moussa', 'papa'),
(111, 'Marc', 'comment allez-vous ?'),
(112, 'Marc', 'comment allez-vous ?'),
(113, 'Marc', 'Avez-vous aimer le roman de Paul ??'),
(114, 'Marc', 'Avez-vous aimer le roman de Paul ??'),
(115, 'moussa', 'Bonjour,\r\nComment trouvez-vous ce site ?\r\n'),
(116, 'Michel', 'Bonjour le peuple,\r\n\r\nalors quoi de beau ?\r\nLa guerre !!!'),
(117, 'Michel', 'whaou ! \r\nQuelle super site !!!'),
(118, 'Marc', 'poisson il est mort'),
(119, 'Chennou', 'Bonjour,\r\n\r\nje suis nouveau..');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE IF NOT EXISTS `utilisateur` (
  `login` varchar(50) CHARACTER SET utf8 NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` varchar(50) NOT NULL,
  `image` varchar(100) NOT NULL,
  `est_valide` int(1) NOT NULL,
  `clef` int(11) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `adresse` varchar(40) NOT NULL,
  `code_postal` int(11) NOT NULL,
  `date_de_naissance` date NOT NULL,
  `date_creation` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`login`, `password`, `email`, `role`, `image`, `est_valide`, `clef`, `nom`, `prenom`, `adresse`, `code_postal`, `date_de_naissance`, `date_creation`) VALUES
('admin', '$2y$10$AMKvJKteLcSSWkycDA.VIu2XJGLOb.X3/8veiXL/C/dmYp6MOE7CW', 'admin@gmail.com', 'administrateur', 'profil/homme.jpg', 1, 525, 'admin', 'admin', 'admin', 1111, '2023-05-16', '2021-11-01'),
('moussa', '$2y$10$E9RzHK1/TxXDUx/fCMFfa.kgj2URXyeHQewSWSCOslEv1Tm8Xu/Wi', 'moussa@gmail.com', 'utilisateur', 'profil/homme.jpg', 1, 1149, 'moussa', 'moussa', 'moussa', 1546, '2023-05-20', '2022-01-12'),
('youbrf', '$2y$10$Kevy.u0gaFxLgb94HJ1upuUf5M6j8PDFf1LnxVMrCTk4ou20lCFWG', 'youchawa@gmail.com', 'utilisateur', 'profil/youbrf/64447_windows-11-fond-ecran-wallpaper-2-scaled.jpg', 1, 7204, 'ch', 'you', 'famezjk', 4543, '2023-05-14', '2021-10-12');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
 ADD PRIMARY KEY (`id`), ADD KEY `articleId` (`articleId`);

--
-- Index pour la table `detail_order`
--
ALTER TABLE `detail_order`
 ADD KEY `detail cmd` (`order_id`);

--
-- Index pour la table `hifi`
--
ALTER TABLE `hifi`
 ADD PRIMARY KEY (`id`);

--
-- Index pour la table `informatique`
--
ALTER TABLE `informatique`
 ADD PRIMARY KEY (`id`);

--
-- Index pour la table `livres`
--
ALTER TABLE `livres`
 ADD PRIMARY KEY (`id`);

--
-- Index pour la table `order`
--
ALTER TABLE `order`
 ADD PRIMARY KEY (`id_order`), ADD KEY `login cmd` (`login`);

--
-- Index pour la table `posts`
--
ALTER TABLE `posts`
 ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tchat`
--
ALTER TABLE `tchat`
 ADD PRIMARY KEY (`id`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
 ADD PRIMARY KEY (`login`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT pour la table `hifi`
--
ALTER TABLE `hifi`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `informatique`
--
ALTER TABLE `informatique`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `livres`
--
ALTER TABLE `livres`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT pour la table `order`
--
ALTER TABLE `order`
MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT pour la table `posts`
--
ALTER TABLE `posts`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT pour la table `tchat`
--
ALTER TABLE `tchat`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=120;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`articleId`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `detail_order`
--
ALTER TABLE `detail_order`
ADD CONSTRAINT `detail cmd` FOREIGN KEY (`order_id`) REFERENCES `order` (`id_order`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `order`
--
ALTER TABLE `order`
ADD CONSTRAINT `login cmd` FOREIGN KEY (`login`) REFERENCES `utilisateur` (`login`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
