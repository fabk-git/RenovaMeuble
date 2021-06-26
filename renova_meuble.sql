-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 26 juin 2021 à 18:31
-- Version du serveur :  10.4.18-MariaDB
-- Version de PHP : 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `renova_meuble`
--

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'rustique'),
(2, 'classique'),
(12, '70\'s'),
(15, 'industriel'),
(16, 'customisé'),
(17, 'chêne'),
(18, 'provençal'),
(19, 'laqué'),
(20, 'merisier');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20210616122120', '2021-06-16 14:21:36', 43),
('DoctrineMigrations\\Version20210616172614', '2021-06-16 19:26:44', 172),
('DoctrineMigrations\\Version20210617162140', '2021-06-17 18:22:19', 338),
('DoctrineMigrations\\Version20210617163707', '2021-06-17 18:37:16', 33),
('DoctrineMigrations\\Version20210620200714', '2021-06-20 22:10:59', 344),
('DoctrineMigrations\\Version20210622134806', '2021-06-22 15:48:20', 50),
('DoctrineMigrations\\Version20210624084522', '2021-06-24 10:45:34', 46);

-- --------------------------------------------------------

--
-- Structure de la table `meuble`
--

CREATE TABLE `meuble` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `prix` double NOT NULL,
  `created_at` datetime NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `meuble`
--

INSERT INTO `meuble` (`id`, `titre`, `description`, `prix`, `created_at`, `photo`, `image_name`, `updated_at`) VALUES
(1, 'bahut', '4 portes et 4 tiroirs', 650, '2021-06-17 22:14:11', NULL, 'bahut-classique-style-annee-80-60d755fe57819009323721.jfif', '2021-06-26 18:29:50'),
(3, 'table', 'avec 2 rallonges et 2 tiroirs', 75.56, '2021-06-18 14:50:41', NULL, 'table-avec-2-rallonges-et-2-tiroirs-60d4b7eed4130012882432.jfif', '2021-06-24 18:50:54'),
(4, 'bureau', 'avec 2 grands tiroirs', 250, '2021-06-19 18:46:18', NULL, 'bureau-avec-2-grands-tiroirs-60d7507047732533330478.jpg', '2021-06-26 18:06:08'),
(5, 'bureau', 'tiroir central', 650, '2021-06-20 17:30:35', NULL, 'bureau-avec-tiroir-central-60d7508a76b95604287998.jpg', '2021-06-26 18:06:34'),
(6, 'chaises et table', 'de type \"formica\"', 450, '2021-06-21 18:30:00', NULL, 'chaise-et-table-formica-60d4bbc19697b380524681.png', '2021-06-24 19:07:13'),
(7, 'placard', '2 portes de style moderne', 150, '2021-06-21 19:06:38', NULL, 'placard-60d754a6d5343186733267.jfif', '2021-06-26 18:24:06'),
(8, 'bureau', 'dessus en verre, laqué', 99, '2021-06-21 19:07:38', NULL, 'bureau-laque-en-verre-60d7558ec5866207453098.jpg', '2021-06-26 18:27:58'),
(9, 'bahut', '4 portes et 1 tiroir', 350, '2021-06-21 19:16:37', NULL, 'bahut-4-portes-et-1-tiroir-60d4bff47855d407347124.jfif', '2021-06-24 19:25:08'),
(10, 'meuble de bar', 'type caisson avec porte', 170, '2021-06-24 12:11:35', NULL, 'meuble-de-bar-60d48bea945f9164236074.jfif', '2021-06-24 15:43:06'),
(12, 'penderie', 'avec portes style vénitien', 1000, '2021-06-24 18:35:34', NULL, 'penderie-60d7500f0d137162569420.jpg', '2021-06-26 18:04:31'),
(15, 'table basse', 'pieds métal', 550, '2021-06-24 18:50:09', NULL, 'table-basse-avec-pieds-metal-60d7545947b47350012046.jfif', '2021-06-26 18:22:49');

-- --------------------------------------------------------

--
-- Structure de la table `meuble_category`
--

CREATE TABLE `meuble_category` (
  `meuble_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `meuble_category`
--

INSERT INTO `meuble_category` (`meuble_id`, `category_id`) VALUES
(1, 1),
(1, 17),
(1, 18),
(4, 2),
(6, 12),
(7, 15),
(7, 20),
(8, 15),
(8, 19),
(12, 12),
(15, 16);

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

CREATE TABLE `panier` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `meuble_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `panier`
--

INSERT INTO `panier` (`id`, `user_id`, `meuble_id`, `quantity`) VALUES
(5, 3, 1, 1),
(6, 3, 4, 2),
(8, 1, 1, 1),
(9, 4, 10, 2),
(10, 4, 1, 1),
(11, 2, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `first_name`, `last_name`) VALUES
(1, 'leroymerlin@dom.fr', '[\"ROLE_USER\"]', '$2y$13$22DEWCpFlaR96l26kFxLN.6Mc7RwAismrqHy5cSZuTC4VDQguGKaO', 'Merlin', 'Leroy'),
(2, 'billboquet@dom.fr', '[\"ROLE_USER\"]', '$2y$13$xGxDbyDwg8zd.8pFwmlLXukKSKRH57ITGTmXDgcpyIIRxAgcsMmhm', 'Bill', 'Boquet'),
(3, 'jeancerien@dom.fr', '[\"ROLE_USER\"]', '$2y$13$EFRtxe71oSyVhm1OAqvHh.yG2KaL/y0xEmeLFTPdEkHTvC6rOrFkC', 'Jean', 'Cérien'),
(4, 'admin@dom.fr', '[\"ROLE_ADMIN\"]', '$2y$13$k183qheEomHVrTOlXXbL9.bm/GcHKXDOCOI6zvsXfLDRW2MHukI2W', 'ad', 'min'),
(5, 'anneonim@dom.fr', '[\"ROLE_ADMIN\"]', '$2y$13$MiawjV3toK3iFFIPyMqgO.MmuduHMm7x87Opwng0kXf5Gjk6NNv1G', 'Anne', 'Onim');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `meuble`
--
ALTER TABLE `meuble`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `meuble_category`
--
ALTER TABLE `meuble_category`
  ADD PRIMARY KEY (`meuble_id`,`category_id`),
  ADD KEY `IDX_A1AA6B88E1780C00` (`meuble_id`),
  ADD KEY `IDX_A1AA6B8812469DE2` (`category_id`);

--
-- Index pour la table `panier`
--
ALTER TABLE `panier`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_24CC0DF2A76ED395` (`user_id`),
  ADD KEY `IDX_24CC0DF2E1780C00` (`meuble_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `meuble`
--
ALTER TABLE `meuble`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `panier`
--
ALTER TABLE `panier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `meuble_category`
--
ALTER TABLE `meuble_category`
  ADD CONSTRAINT `FK_A1AA6B8812469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_A1AA6B88E1780C00` FOREIGN KEY (`meuble_id`) REFERENCES `meuble` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `panier`
--
ALTER TABLE `panier`
  ADD CONSTRAINT `FK_24CC0DF2A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_24CC0DF2E1780C00` FOREIGN KEY (`meuble_id`) REFERENCES `meuble` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
