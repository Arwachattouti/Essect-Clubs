-- XAMPP-Lite
-- version 8.4.1
-- https://xampplite.sf.net/
--
-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 21 mars 2025 à 06:53
-- Version du serveur : 11.4.4-MariaDB-log
-- Version de PHP : 8.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `finalclubsessect`
--

-- --------------------------------------------------------

--
-- Structure de la table `adhesions`
--

CREATE TABLE `adhesions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `club_id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `birthdate` date NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `gender` enum('Homme','Femme') NOT NULL,
  `skills` text DEFAULT NULL,
  `hobbies` text DEFAULT NULL,
  `reason` text DEFAULT NULL,
  `statut` enum('accepté','en attente','refusé') DEFAULT 'en attente',
  `cv_pdf_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `adhesions`
--

INSERT INTO `adhesions` (`id`, `user_id`, `club_id`, `full_name`, `birthdate`, `email`, `phone`, `gender`, `skills`, `hobbies`, `reason`, `statut`, `cv_pdf_path`) VALUES
(25, 36, 3, 'rayen souli', '1222-12-12', 'rayen@gmail.com', '12121212', 'Homme', 'a', 'a', 'a', 'accepté', '1742056858_cv1 - Copy.pdf'),
(38, 55, 1, 'arwa chattouti', '1111-11-11', 'arwa@gmail.com', '95415251', 'Femme', 'gfjgj', 'gj', 'ygjj', 'accepté', '1742507054_cv1.pdf'),
(49, 54, 1, 'chef oucema', '5122-02-14', 'oucema@gmail.com', '11412512', 'Homme', 'g', 'g', 'hh', 'refusé', '1742511549_1742511358_1742507122_cv1 - Copy.pdf'),
(52, 57, 1, 'mohamed', '1111-11-11', 'mohamed@gmail.com', '01020145', 'Homme', 'dedee', 'fv', 'f', 'en attente', '1742521956_cv1 - Copy (3).pdf'),
(53, 57, 2, 'mohamed', '1111-11-11', 'mohamed@gmail.com', '01020145', 'Homme', 'dcd', 'dc', 'dcd', 'en attente', '1742522056_cv1 - Copy copy.pdf'),
(54, 61, 2, 'amin', '4522-02-15', 'amin@gmail.com', '15959595', 'Homme', 'gfb', 'dfdf', 'rg', 'en attente', '1742524369_digital.docx');

--
-- Déclencheurs `adhesions`
--
DELIMITER $$
CREATE TRIGGER `after_adhesion_accepted` AFTER UPDATE ON `adhesions` FOR EACH ROW BEGIN
    IF NEW.statut = 'accepté' THEN
        INSERT INTO club_members (user_id, club_id, adhesion_id, date_adhesion, statut_membre)
        VALUES (NEW.user_id, NEW.club_id, NEW.id, NOW(), 'actif');
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `clubs`
--

CREATE TABLE `clubs` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `date_creation` date NOT NULL,
  `facebook_link` varchar(255) DEFAULT NULL,
  `instagram_link` varchar(255) DEFAULT NULL,
  `nb_membre` int(11) DEFAULT 0,
  `nb_partenaires` int(11) DEFAULT 0,
  `img_slide1` varchar(255) NOT NULL,
  `img_slide2` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `clubs`
--

INSERT INTO `clubs` (`id`, `nom`, `logo`, `description`, `date_creation`, `facebook_link`, `instagram_link`, `nb_membre`, `nb_partenaires`, `img_slide1`, `img_slide2`) VALUES
(1, 'InfoLab', 'infolab.jpg', 'Club InfoLab ESSECT est  une organisation à but non lucratif à l\'ESSECT. Il regroupe des étudiants passionnés de technologie, design, communication et organisation d’événements pour les aider à développer leurs compétences et enrichir leur parcours. Il propose des formations, ateliers et événements pour favoriser la collaboration et l’innovation  .', '2022-09-25', 'https://www.facebook.com/profile.php?id=100086193647142', 'https://www.instagram.com/infolab_essect/', 5, 0, '1.png', '2.png'),
(2, 'Radio', 'radio.png', '**Radio ESSECT – Votre Voix, Notre Fréquence** est la plateforme médiatique de l’ESSECT, Organisation à but non lucratif offrant aux étudiants un espace d’expression à travers actualités, débats, interviews et émissions culturelles. Elle couvre la vie universitaire tout en proposant du contenu éducatif et divertissant.', '2025-02-17', 'https://www.facebook.com/profile.php?id=61572903947925', 'https://radio.com', 0, 0, '2.jpg', '2.jpg'),
(3, 'Enactus', 'enactus.png', 'Enactus ESSECT est une organisation estudiantine qui fait partie du réseau Enactus Tunisia, visant à promouvoir l’entrepreneuriat social parmi les étudiants de l’ESSECT. À travers des projets innovants et durables, ses membres mettent en œuvre des solutions à impact positif sur la société et l’environnement.', '2010-11-20', 'https://www.facebook.com/enactusessectunis', 'https://www.instagram.com/enactors.essect/', 3, 0, '3.png', 'enactor.png');

-- --------------------------------------------------------

--
-- Structure de la table `club_bureau_members`
--

CREATE TABLE `club_bureau_members` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `club_id` int(11) NOT NULL,
  `responsabilite` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `club_bureau_members`
--

INSERT INTO `club_bureau_members` (`id`, `user_id`, `club_id`, `responsabilite`) VALUES
(3, 22, 1, 'Responsable rh'),
(4, 23, 1, 'Secrétaire Générale'),
(5, 25, 1, 'Présidente'),
(6, 18, 1, 'Chef Département Communication'),
(7, 20, 1, 'Chef Département événements'),
(8, 21, 1, 'Chef Département Design'),
(9, 26, 1, 'Vice Président et Trésorier'),
(10, 48, 2, 'Président'),
(11, 49, 2, 'Exécutive'),
(12, 50, 2, 'Vice Président'),
(13, 51, 2, 'Secrétaire Générale'),
(14, 43, 2, 'Responsable rh'),
(15, 44, 2, 'Responsable Evénementiel'),
(16, 45, 2, 'Responsable Diffusion'),
(17, 46, 2, 'Responsable Finance'),
(18, 47, 2, 'Responsable Marketing'),
(19, 36, 3, 'Président'),
(20, 37, 3, 'Vice Président'),
(21, 38, 3, 'Secrétaire Générale'),
(22, 39, 3, 'Responsable en communication et marketing'),
(23, 42, 3, 'Responsable rh'),
(25, 40, 3, 'Responsable Relations extérieures'),
(26, 41, 3, 'Responsable de projet');

-- --------------------------------------------------------

--
-- Structure de la table `club_events`
--

CREATE TABLE `club_events` (
  `id` int(11) NOT NULL,
  `club_id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `image_principale` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `lieu` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` enum('à venir','en cours','terminé') DEFAULT 'à venir',
  `participants` int(11) DEFAULT 0,
  `capacity` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `club_events`
--

INSERT INTO `club_events` (`id`, `club_id`, `titre`, `image_principale`, `date`, `lieu`, `description`, `status`, `participants`, `capacity`) VALUES
(8, 1, 'Réussir mon pfe ', '/clubs/public/img/clubsessect/1.jpg', '2024-11-23', 'Amphi 1, ESSECT', 'Quelle journée inspirante lors de notre événement **&amp;quot;Réussir mon PFE 2.0&amp;quot;** !  \r\nUn immense merci à nos incroyables enseignants et étudiants pour avoir partagé leurs connaissances et expériences.  \r\nEnsemble, nous avons acquis de précieuses idées qui nous guideront vers la réussite ! 🚀🎓', 'terminé', 150, 200),
(9, 1, 'Linkedin Conférence ', '/clubs/public/img/clubsessect/event2infolab.jpg', '2024-11-13', 'Amphi 2, ESSECT', '✨ Lancement de notre tout premier événement InfoLab à l&#039;ESSECT : **L’IA au service du Personal Branding** ! ✨  \r\n\r\nNous avons eu le plaisir d’organiser une session riche en conseils pratiques sur la création d’une **marque personnelle unique**, l’**optimisation des profils LinkedIn**, et l’**utilisation des outils d’IA** pour le **réseautage stratégique** et la **gestion de l’identité numérique**.  \r\n\r\nUn grand merci à nos expertes, **Mme Karima Tekaya** et **Mme Marwa Ben Othman**, pour avoir partagé avec notre communauté des outils et stratégies concrets.  \r\n\r\n🚀 Ce n’est que le début d’une série d’événements impactants à venir !', 'terminé', 100, 100),
(10, 1, 'Google Offered Programs', '/clubs/public/img/clubsessect/event3infolab.jpg', '2024-02-28', 'Amphi 2, ESSECT', 'L&#039;événement **Google Offered Programs** a présenté les opportunités de formation et de certification offertes par Google pour développer ses compétences et booster sa carrière. 🚀', 'terminé', 100, 100),
(11, 1, 'Digital Marketing', '/clubs/public/img/clubsessect/event4infolab.jpg', '2023-02-21', 'Amphi 2, ESSECT', '🎉🤖 Surprise ! Cher(e)s étudiant(e)s de l&#039;ESSECT! 🚀 Vous êtes convié(e)s à une expérience exceptionnelle au sein de notre club école. Préparez-vous à être ébloui(e)s par l&#039;événement surprise dédié au marketing digital à l&#039;ère de l&#039;intelligence artificielle!', 'terminé', 100, 100),
(14, 3, 'SME', '/clubs/public/img/clubsessect/sme.jpg', '2024-11-20', 'Amphi 2, ESSECT', 'Celebrate Global Entrepreneurship Week with Enactus ESSECT! Join us for inspiring sessions featuring industry experts:\r\nAli Jardek: Digital Content Creator 🎮\r\nRamzi Saoud: Analyst &amp; Trader 📊\r\nWassim Mzoughi: Content Creator &amp; Speaker 🎤', 'terminé', 50, 50),
(15, 3, 'Championnat National Enactus', '/clubs/public/img/clubsessect/champonsit.jpg', '2024-03-03', 'Olympysky', 'Participez au Championnat National Enactus et vivez une compétition unique alliant football et impact social ! ⚽️🔥 Avec 8 équipes en lice, chaque match sera une démonstration de talent et de stratégie. Pour 135 DT par équipe, tentez de remporter des prix tout en partageant des valeurs de travail d&#039;équipe et de dépassement de soi. Ne ratez pas cette opportunité de briller ! 🚀⏳ #EnactusNationalChampionship #Football #Enactus #ESSECT', 'terminé', 50, 50);

-- --------------------------------------------------------

--
-- Structure de la table `club_members`
--

CREATE TABLE `club_members` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `club_id` int(11) NOT NULL,
  `adhesion_id` int(11) DEFAULT NULL,
  `date_adhesion` timestamp NOT NULL DEFAULT current_timestamp(),
  `statut_membre` enum('actif','inactif') DEFAULT 'actif',
  `departement_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `club_members`
--

INSERT INTO `club_members` (`id`, `user_id`, `club_id`, `adhesion_id`, `date_adhesion`, `statut_membre`, `departement_id`) VALUES
(33, 22, 1, NULL, '2025-03-14 23:56:15', 'actif', 8),
(35, 56, 3, NULL, '2025-03-15 17:06:13', 'actif', 9),
(39, 21, 1, NULL, '2025-03-15 20:30:11', 'actif', 6),
(47, 55, 1, 38, '2025-03-21 00:13:04', 'actif', 6),
(48, 57, 1, NULL, '2025-03-21 01:48:47', 'actif', 0),
(49, 57, 1, NULL, '2025-03-21 01:48:47', 'actif', 7),
(50, 36, 3, 25, '2025-03-21 01:56:45', 'actif', 0),
(51, 36, 3, 25, '2025-03-21 01:56:45', 'actif', 10);

--
-- Déclencheurs `club_members`
--
DELIMITER $$
CREATE TRIGGER `update_club_statistics` AFTER INSERT ON `club_members` FOR EACH ROW BEGIN
    UPDATE clubs
    SET nb_membre = (SELECT COUNT(*) FROM club_members WHERE club_id = NEW.club_id)
    WHERE id = NEW.club_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `departements`
--

CREATE TABLE `departements` (
  `id` int(11) NOT NULL,
  `club_id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `departements`
--

INSERT INTO `departements` (`id`, `club_id`, `nom`, `description`) VALUES
(6, 1, 'Design', 'Responsable de la création visuelle, du développement graphique et de l&#039;esthétique des projets, garantissant une expérience visuelle cohérente et attractive.'),
(7, 1, 'Communication ', 'Gère les stratégies de communication interne et externe, assurant la diffusion efficace des messages et l&#039;engagement des publics cibles.'),
(8, 1, 'Événements ', 'Organise et coordonne les événements, en veillant à leur bon déroulement, leur impact et leur visibilité pour l&#039;institution ou l&#039;organisation.'),
(9, 3, 'Projet et prospection ', 'Département projet : est la clé de plusieurs étapes :  l&#039;identification d&#039;une problématique, la recherche de solutions, la création de prototypes pour la faisabilité, et enfin, la mise en œuvre sur le marché.  L&#039;équipe a pour mission d&#039;accomplir le projet en alignant ses objectifs sur les principes de développement durable.'),
(10, 3, 'Relations externes', 'Département Relations Externes :  est le moteur de financement de notre projet en travaillant avec des sponsors et en établissant des partenariats, tout en coordonnant la planification des événements.'),
(11, 3, 'Département Communication et Marketing', 'Ce département a pour mission d’accroître la notoriété de notre club tout en mettant en avant nos projets et événements. Il veille à assurer une communication efficace par le biais de la conception d&#039;affiches, de la production de vidéos et de la rédaction de contenus.');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `consent` tinyint(1) DEFAULT 0,
  `role` enum('étudiant','chef','administrateur') DEFAULT 'étudiant',
  `club_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `phone`, `profile_image`, `consent`, `role`, `club_id`) VALUES
(18, 'wassim jha', 'wassim@gmail.com', '$2y$12$vJDxvoajkBy6WSyngK78MOuqvK8aMmgmpBSKzZcV4lhbA4WzHBY9G', '00000000', 'comm.png', 0, 'étudiant', NULL),
(20, 'iheb baccar', 'iheb@gmail.com', '$2y$12$8qIPfdaAah9YiOj2C3UGDeTvIy.m6dOYgK9IWvpR0huelnQo0GYVO', '00000001', 'event.png', 0, 'étudiant', NULL),
(21, 'Maha Noureddine', 'maha@gmail.com', '$2y$12$12A7fgEKASgn4b.Cg/VMXuwPNHHSr/hfqm5Drr0zWux4OZuF0SyQ.', '00000002', 'design.png', 0, 'étudiant', NULL),
(22, 'Amenallah Robanna', 'robanna@gmail.com', '$2y$12$mrdN9ffS5j1YXGxq1DO8jOLp3funXJxeNpj7tWn6g2iIX0QmKpQXO', '00000012', 'rh.png', 0, 'étudiant', NULL),
(23, 'Yasmine ben sta', 'yasmine@gmail.com', '$2y$12$XhtrV3D8ztX5t3kwIcJYUunxegR1XWH7sHwfZ1at9F/QCYKDClHU6', '00000004', 'secr.png', 0, 'étudiant', NULL),
(25, 'Nour Cherni', 'nour@gmail.com', '$2y$12$N1U12DDmtUz2zrakWlgqy.LMSlQYoAKeuydzXoimVoZl7eVk5.pGa', '00000005', 'presidente.png', 0, 'étudiant', NULL),
(26, 'Saief Bouali', 'saief@gmail.com', '$2y$12$g4UdWAr0FWOqE7MLUyJe2ebcdU5Y4yYwWlQ0D/BRyNhzuLHndGCVi', '00000006', 'vice-presidente.png', 0, 'étudiant', NULL),
(36, 'rayen souli', 'rayen@gmail.com', '$2y$12$8QvIVI2dP4mHK3y2nJ.2z.skCJzo6P.sSUMwwrVgK9QY6BngheTX.', '12121212', 'rayen souli.png', 0, 'étudiant', NULL),
(37, 'fedi hamdi', 'fedi@gmail.com', '$2y$12$wBy2hLLpnFGMnkD44GIC3uckzbuQPaDHn7QLFUly0Qy1XXq13eMWW', '15151515', 'fedi hamdi.png', 0, 'étudiant', NULL),
(38, 'mariem wannem', 'mariem@gmail.com', '$2y$12$S.B8VriUvzshnlHCs/P5s.AD0iUceU8NhLrfbbhcosc9O7oFJ0eE.', '14141414', 'mariem wannem.png', 0, 'étudiant', NULL),
(39, 'mouhib ben hassen', 'mouhib@gmail.com', '$2y$12$Ru/F8EmPQ9sGLxV9KyCHaeh9zIZl0IQoznHEXJBnMXaqEPTCGZ4W2', '16161616', 'mouhib.png', 0, 'étudiant', NULL),
(40, 'rifae guelmani', 'rifae@gmail.com', '$2y$12$RRHpZFNrg3HbneK1.EsFtuWhS4SUK6xz4WqWoKWYSTff6mL2WEecW', '18181818', 'rifae.png', 0, 'étudiant', NULL),
(41, 'souheil ben chaabene', 'souheil@gmail.com', '$2y$12$wW6M1m1Bhp8aj9W1MN0Liu0a8mok4MhZTmqNSRt51OXvbfCuoDhvq', '14181516', 'souhaeil.png', 0, 'étudiant', NULL),
(42, 'alia gudeiche', 'alia@gmail.com', '$2y$12$/QU0iPCOS6dVsBYhaaPo8e3BjJ6uTZStUtLKbcCMdCvKAwwGO2gM.', '16131418', 'alia.png', 0, 'étudiant', NULL),
(43, 'abdi islem', 'abdi@gmail.com', '$2y$12$iMqxAMG81T4Ekn96na0A8.K63t39KUQe1UTJaX8kqJsmXxAlAGoRK', '13131614', 'abdi.png', 0, 'étudiant', NULL),
(44, 'bibani ghassen', 'ghassen@gmail.com', '$2y$12$4Dzi5ouvgY.t/B4fkC7gne34e6.HRz8reUdpDym3Hqi92AT3grN5K', '15141816', 'ghassen.png', 0, 'étudiant', NULL),
(45, 'belhoula oumaima', 'oumaima@gmail.com', '$2y$12$YKkN9C.Hkrmty0RxdbgY5O2NGTKpMa8ZnAzxu.0T2HQEOaF6Mq9Yy', '12131212', 'oumaima.png', 0, 'étudiant', NULL),
(46, 'hamidou fares', 'fares@gmail.com', '$2y$12$5b./lT1azwgNhAiEFbzfzOu0jN3VmGT0.OAAIkATYEtfQKs.9PynS', '11155555', 'fares.png', 0, 'étudiant', NULL),
(47, 'bennaceur eya', 'eya@gmail.com', '$2y$12$FhoDb4TAC79kwkuMkTtbJO4tlKflqCRI6WeMh.URQ1LiDbL5JJ1l.', '14155415', 'eya.png', 0, 'étudiant', NULL),
(48, 'abdekkrim oucema', 'oucema@gmail.com', '$2y$12$BVpYH7zBjaqoSSrSUBfl3O/J7uJH8RddZIMsgMzTitPJ3sHP9Bg.W', '11412512', 'oussema.png', 0, 'étudiant', NULL),
(49, 'adouni mohamedali', 'dali@gmail.com', '$2y$12$eguOCqKU0rzm/rwuwd5t4OZKUpDq5DEdlAKafYJ.RKToW1wBAnAua', '13625948', 'dali.png', 0, 'étudiant', NULL),
(50, 'hachicha elyes', 'elyes@gmail.com', '$2y$12$b0YC3bFzqdVDtFc5guxRheMcWupc82360xt9pFMORvpo8nVv.v6Lq', '16262615', 'elyes.png', 0, 'étudiant', NULL),
(51, 'thabet fatma', 'fatma@gmail.com', '$2y$12$mOOh./1msvuZdAUS0ExHKOBCqQpP3/BKZHxy4XQIIYLDjExFMIMre', '14784784', 'fatma.png', 0, 'étudiant', NULL),
(52, 'chef nour', 'chefnour@gmail.com', '$2y$12$ZNSKIq8cpXMkz0Ae0CtozOJSUufSNOrvEylR.wUqUaugQZQhitoGq', '12514161', NULL, 0, 'chef', 1),
(53, 'chef rayen', 'chefrayen@gmail.com', '$2y$12$qYysY1c2GFJvXqZV9NAcvejQ23IjsrOBnBpkRYLfHDCLqZAp/Ldhq', '13161514', NULL, 0, 'chef', 3),
(54, 'chefoucema', 'chefoucema@gmail.com', '$2y$12$Q2CXnv62ZbaBgFP9X1QgLOGPtKQF2ZlhwrYAliExh/5wHp2ZRToKi', '16181419', NULL, 0, 'chef', 2),
(55, 'arwa chattouti', 'arwa@gmail.com', '$2y$12$As0L/WWQcNiSHFT/pYgLZ.D/UqKGhNPURHsK1GpDi/RJ8IpmMMSWa', '95415251', 'arwa.jpg', 0, 'étudiant', NULL),
(56, 'ghalia rahal', 'ghalia@gmail.com', '$2y$12$pEU7pGPm8iPplXyNo0SbvOe4oJTcjyC8reqtJPxz7SJHt35Io.OCG', '95847586', 'ghalia.jpg', 0, 'étudiant', NULL),
(57, 'mohamed', 'mohamed@gmail.com', '$2y$12$t922/wNijlhUW0BGrwAb7.trDLQCw72AnD3QeSnBM.dxUy3GEOuhK', '01020145', 'radio.png', 0, 'étudiant', NULL),
(58, 'admin', 'admin@gmail.com', '$2y$12$mupqnHW1tgwFrJBo63gI/.O1FXR.e/5deyVH6w0SVPENVOGeu8jkK', '11111111', '0.jpg', 0, 'administrateur', NULL),
(59, 'sarra', 'sarra@gmail.com', '$2y$12$ozC70ViYD0xuyJ4uDzoReu3MWjqvfyTdqBrH0FJbtBZNcIxk/BBtO', '14251425', '1.png', 0, 'étudiant', NULL),
(61, 'amin', 'amin@gmail.com', '$2y$12$4pAghgjUvuWKxflYCA2e7.TX4679FVUfDzN0RRncUaeYI3srw/NGK', '15959595', 'rayen souli.png', 0, 'étudiant', NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `adhesions`
--
ALTER TABLE `adhesions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`,`club_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `club_id` (`club_id`);

--
-- Index pour la table `clubs`
--
ALTER TABLE `clubs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nom` (`nom`);

--
-- Index pour la table `club_bureau_members`
--
ALTER TABLE `club_bureau_members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `club_id` (`club_id`);

--
-- Index pour la table `club_events`
--
ALTER TABLE `club_events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `club_id` (`club_id`);

--
-- Index pour la table `club_members`
--
ALTER TABLE `club_members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `club_id` (`club_id`),
  ADD KEY `departement_id` (`departement_id`),
  ADD KEY `fk_adhesion` (`adhesion_id`);

--
-- Index pour la table `departements`
--
ALTER TABLE `departements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `club_id` (`club_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD KEY `fk_club` (`club_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `adhesions`
--
ALTER TABLE `adhesions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT pour la table `clubs`
--
ALTER TABLE `clubs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `club_bureau_members`
--
ALTER TABLE `club_bureau_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT pour la table `club_events`
--
ALTER TABLE `club_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `club_members`
--
ALTER TABLE `club_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT pour la table `departements`
--
ALTER TABLE `departements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `adhesions`
--
ALTER TABLE `adhesions`
  ADD CONSTRAINT `adhesions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `adhesions_ibfk_2` FOREIGN KEY (`club_id`) REFERENCES `clubs` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `club_bureau_members`
--
ALTER TABLE `club_bureau_members`
  ADD CONSTRAINT `club_bureau_members_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `club_bureau_members_ibfk_2` FOREIGN KEY (`club_id`) REFERENCES `clubs` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `club_events`
--
ALTER TABLE `club_events`
  ADD CONSTRAINT `club_events_ibfk_1` FOREIGN KEY (`club_id`) REFERENCES `clubs` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `club_members`
--
ALTER TABLE `club_members`
  ADD CONSTRAINT `club_members_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `club_members_ibfk_2` FOREIGN KEY (`club_id`) REFERENCES `clubs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_adhesion` FOREIGN KEY (`adhesion_id`) REFERENCES `adhesions` (`id`) ON DELETE SET NULL;

--
-- Contraintes pour la table `departements`
--
ALTER TABLE `departements`
  ADD CONSTRAINT `departements_ibfk_1` FOREIGN KEY (`club_id`) REFERENCES `clubs` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_club` FOREIGN KEY (`club_id`) REFERENCES `clubs` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
