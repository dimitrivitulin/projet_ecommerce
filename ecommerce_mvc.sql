-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 28, 2022 at 09:39 AM
-- Server version: 5.7.24
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce_mvc`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Terrarium'),
(2, 'Succulente'),
(3, 'Plantes d\'Intérieur');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adress` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telephone` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `pseudo`, `firstname`, `lastname`, `adress`, `telephone`, `email`, `password`) VALUES
(10, 'jean', 'DUPONT', 'Vitulin', NULL, '0771370098', 'tsardim972@htmail.com', 'ad70424dc8c6ad61f4ff691d297985d4f243e38a'),
(11, 'tsardim', 'Dimitri', 'Vitulin', NULL, '0771370098', 'sissi972@htmail.com', 'd57e2072b48d693c661d26f6193cb2b9137f76ac'),
(12, 'Nicolas', 'Prévost', 'Nicolas', NULL, '0606060606', 'nicolas@tmail.com', '0c120835008f6e42ad5f419926a681edb00b4e45'),
(17, 'Nicolas', 'Prévost', 'Nicolas', NULL, '0606060606', 'nicolas20@tmail.com', '0c120835008f6e42ad5f419926a681edb00b4e45'),
(18, 'Nicolas', 'Prévost', 'Nicolas', NULL, '0606060606', 'nicolas21@tmail.com', '0c120835008f6e42ad5f419926a681edb00b4e45'),
(19, 'Nicolas', 'Prévost', 'Nicolas', NULL, '0606060606', 'nicolas22@tmail.com', '0c120835008f6e42ad5f419926a681edb00b4e45'),
(21, 'Nicolas', 'Prévost', 'Nicolas', NULL, '0606060606', 'nicolas24@tmail.com', '0c120835008f6e42ad5f419926a681edb00b4e45'),
(23, 'Nicolas', 'Prévost', 'Nicolas', NULL, '0606060606', 'nicolas25@tmail.com', '0c120835008f6e42ad5f419926a681edb00b4e45'),
(25, 'Nicolas', 'Prévost', 'Nicolas', NULL, '0606060606', 'nicolas26@tmail.com', '0c120835008f6e42ad5f419926a681edb00b4e45'),
(27, 'Nicolas', 'Prévost', 'Nicolas', NULL, '0606060606', 'nicolas27@tmail.com', '0c120835008f6e42ad5f419926a681edb00b4e45'),
(29, 'Nicolas', 'Prévost', 'Nicolas', NULL, '0606060606', 'nicolas28@tmail.com', '0c120835008f6e42ad5f419926a681edb00b4e45'),
(30, 'Nicolas', 'Prévost', 'Nicolas', '18 rue des poissons', '0606060606', 'nicolas29@tmail.com', '0c120835008f6e42ad5f419926a681edb00b4e45'),
(32, 'Nicolas', 'Prévost', 'Nicolas', NULL, '0606060606', 'nicolas30@tmail.com', '0c120835008f6e42ad5f419926a681edb00b4e45'),
(33, 'Nicolas', 'Prévost', 'Nicolas', NULL, '0606060606', 'nicolas31@tmail.com', '0c120835008f6e42ad5f419926a681edb00b4e45');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `id_customers` int(11) DEFAULT NULL,
  `id_product` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `created-at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `id_customers`, `id_product`, `quantity`, `price`, `created-at`) VALUES
(1, 30, 5, 1, 5.95, '2022-02-08 12:33:22'),
(2, 30, 5, 1, 5.95, '2022-02-08 12:36:25'),
(3, 30, 5, 1, 5.95, '2022-02-08 12:37:59'),
(4, 30, 5, 1, 5.95, '2022-02-08 12:38:14'),
(5, 30, 6, 1, 3.95, '2022-02-08 12:38:14'),
(6, 30, 2, 1, 55, '2022-02-14 09:37:00'),
(7, 30, 2, 1, 55, '2022-02-14 09:37:00'),
(8, 30, 3, 1, 42, '2022-02-14 09:37:00');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `price` float NOT NULL,
  `category_id` int(11) NOT NULL,
  `stock` int(11) DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created-at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `description`, `price`, `category_id`, `stock`, `image`, `created-at`) VALUES
(1, 'Terrarium Fittonia et Ficus Ginseng', 'Originaire d\'Amérique du Sud, le Fittonia vit au pied des arbres des forêts tropicales et ne reçoit qu\'une lumière indirecte du soleil. Il arbore un feuillage persistant, coloré et d\'autant plus tacheté qu\'il bénéficiera d\'une belle lumière. Cette plante vivace s\'épanouit dans une atmosphère humide et chaude (température supérieure à 18°C).\r\nLe Ficus Ginseng se caractérise par ses racines imposantes et son feuillage également persistant. Comme le Fittonia, il aime les climats tropicaux.', 73, 1, 8, 'terrarium_fittonia_ginseng.jpg', '2022-01-29 12:49:05'),
(2, 'Terrarium Forrest Moon small', 'Le Forest Moon Small est le plus petit terrarium de la famille Moon ; sa base et sa cloche sont en verre et de forme ronde. Le FMS abrite un fittonia ainsi que des mousses, graviers & terreau.\r\nCette composition a été créée à la main avec amour dans nos ateliers parisiens. Elle fait partie de notre nouvelle collection capsule entièrement imaginée et conçue par Noam Levy.', 55, 1, 15, 'terrarium_forest_moon_small.jpg', '2022-01-29 12:49:05'),
(3, 'Terrarium Lumineux Fittonia', 'Originaire d\'Amérique du Sud, le Fittonia vit au pied des arbres des forêts tropicales et ne reçoit qu\'une lumière indirecte du soleil. Il arbore un feuillage persistant, coloré et d\'autant plus tacheté qu\'il bénéficiera d\'une belle lumière. Cette plante vivace s\'épanouit dans une atmosphère humide et chaude (température supérieure à 18°C).\r\nLe Tillandsia se caractérise par son feuillage, plus ou moins argenté, et recouvert de cellules capables d\'absorber l\'humidité ambiante. Comme le Fittonia, il aime les climats tropicaux.', 42, 1, 20, 'terrarium_lumineux_fittonia.jpg', '2022-01-29 12:49:05'),
(4, 'Terrarium XXL Rio', 'Une bonbonnière en verre de 40cm sur 30cm, un Bonsaï Retusa 6 ans, plusieurs plantes d\'accompagnement ainsi qu\'une jolie décoration unique avec de la mousse naturelle et petits cailloux est également présente. Une idée cadeau parfaite !\r\nIdéal pour décorer votre intérieur ou bureau, mais aussi pour offrir : anniversaire, cadeau client, salarié... Un petit jardin miniature qui ne s\'arrose que quelques fois dans l\'année, c\'est le cadeau rêvé !', 199, 1, 5, 'terrarium_rio_xxl.jpg', '2022-01-29 12:49:05'),
(5, 'Chaîne des cœurs', 'Fortement appréciée en suspension, cette plante, comme son nom l’indique, présente un chapelet des cœurs qui magnifiera votre intérieur.\r\nVivace succulente présentant de fines tiges pourpres, pendantes, de 1 m de long, portant d’élégantes petites feuilles cordiformes, de couleur vert bleuté éclairées de blanc argenté, pourprées au revers. Fleurs tubulaires de 2 cm de long, de couleur rose pourpre violacé.', 5.95, 2, 30, 'chaine_des_coeurs.jpg', '2022-01-29 13:24:18'),
(6, 'Crassula', 'Le Crassula est une plante succulente fortement appréciée pour ses feuilles épaisses présentant des formes, des couleurs ainsi que des textures très variées. Petites fleurs étoilées ou en entonnoir, regroupées en inflorescences terminales.', 3.95, 2, 50, 'crassula.jpg', '2022-01-29 13:24:18'),
(7, 'Echeveria', '\"L\'Echeveria est une plante succulente en rosette, très appréciée pour son feuillage aux coloris spectaculaires et ses fleurs sur tiges. Ces plantes sont à utiliser à l\'intérieur ou comme annuelle en massifs.\r\nFeuilles épaisses, linéaires, cylindriques ou triangulaires, de couleur vert moyen, gris bleuté ou encore vert pourpré. Longs pétiole portant des fleurs généralement groupées en bouquets ou en panicules et se parant de rouge, orange ou de jaune', 2.55, 2, 70, 'echeveria.jpg', '2022-01-29 13:24:18'),
(8, 'Cotyledon undulata', 'Vivace succulente très prisée pour ses délicates feuilles, en paires opposées, de couleur gris-vert, qui apportera une touche lumineuse à votre intérieur.\r\nPort compact à semi-dressé. Tiges souples et charnues portant des feuilles linéaires à obovales, épaisses, de couleur gris-vert et recouvertes d’une pruine cireuse ou poudreuse. Hampe florale portant des grappes de fleurs tubulaires de 2 cm de long, de couleur jaune, rouge ou orange.', 4.95, 2, 50, 'cotyledon_undulata.jpg', '2022-01-29 13:24:18'),
(9, 'Oiseau du Paradis', 'L\'Oiseau du Paradis (Strelitzia) est une plante vivace persistante appréciée pour ses grandes inflorescences spectaculaires et très élégantes, semblables à une tête d’oiseau tropical et qui apportent une véritable touche d’exotisme. À cultiver en véranda ou en serre chaude et à sortir l’été.\r\nStrelitzia reginae : port en touffe érigée. Pétioles de,5 à 1 m de long portant des feuilles oblongues, mesurant jusqu’à 50 cm de long, de couleur vert moyen, similaires à celles des bananiers. Fleurs de 3 à 10 cm de long, composées d’une corolle bleutée et d’un calice orange, jaillissant de bractées vertes d’une dizaine de centimètres.', 29.9, 3, 15, 'oiseau_du_paradis.jpg', '2022-01-29 13:33:23'),
(10, 'Monstera Monkey', 'Star montante des plantes d’intérieur, voici le cousin des célèbres Monstera Deliciosa. Ses majestueuses feuilles perforées de trous étonnants offrent un effet ultra-graphique. A la fois “jungle” et sophistiqué, le Monstera Monkey comblera tous ceux qui recherchent une déco très tendance. En suspension, pour habiller un mur comme une table de salle à manger ou une table de réunion, le Monstera Obliqua Monkey aime se déployer. Concentré de green et de déco, il possède un ultime atout pour nous faire craquer : son entretien d’une grande facilité. Un adorable petit monstre qu’on adopte sans hésiter.', 39.9, 3, 20, 'monsterra_monkey.jpg', '2022-01-29 13:33:23'),
(11, 'Pied d\'éléphant, Noline recourbée', 'Le Beaucarnea recurvata (synonyme : Nolina recurvata), est un arbuste succulent à croissance très lente et protégé dans la nature. Il est apprécié pour son tronc ridé et élargi à la base, en forme de pied d\'éléphant et pour son feuillage des plus décoratif. Ses feuilles persistantes mesurent jusqu’à 1,8 m. Elles sont étroites, linéaires, souples, en touffes au sommet du tronc et de couleur vert foncé. L’été, sur les sujets âgés, des panicules de petites fleurs de 6 pétales de couleur blanche, teintées de mauve, peuvent apparaître.\r\nConseils d’entretien : installez votre Beaucarnea recurvata dans une pièce bien éclairée, mais sans soleil direct. L’arrosage doit être régulier mais modéré. N’hésitez pas à laisser sécher le substrat entre deux arrosages. En hiver, espacez davantage les arrosages. En période de croissance, apportez de l’engrais liquide pour plantes vertes, tous les mois environ.', 14.9, 3, 15, 'pied_d_elephant_noline_recourbee.jpg', '2022-01-29 13:33:23'),
(12, 'Ficus elastica robusta', 'Il en impose, avec son port élancé, sa tige épaisse et ses feuilles généreuses. Le caoutchouc est une plante iconique qui apporte à toute déco sa touche verte à la fois simple et élégante. Avant chaque nouvelle feuille, une jolie surprise colorée : une enveloppe carmin très originale. Aussi pratique que décoratif, notre caoutchouc résiste à tout, même aux petites maladresses ou aux oublis d’arrosage. Ce ficus appartient surtout aux plantes dépolluantes: on adore son effet détox qui purifie l’air ! Disposé dans une chambre ou un bureau, c’est un excellent allié pour une atmosphère saine et zen.', 54.9, 3, 15, 'ficus_robusta.jpg', '2022-01-29 13:33:23'),
(13, 'Pothos', 'On aime le sublime feuillage du Pothos tacheté ! Très populaire, notre jolie plante doit sa célébrité à son apparence à couper le souffle, sa facilité d’entretien et sa capacité à métamorphoser votre intérieur en un paradis tropical luxuriant. Ses feuilles teintées de vert émeraude et mouchetées de nuances argentées font d’elle LA plante suspendue qui fait craquer tous les amoureux des plantes. Tombant en cascade depuis le haut d’un meuble, grimpant sur un treillis ou plutôt rampant sur le rebord d’une fenêtre, le Pothos tacheté s’intégrera à merveille à votre jungle urbaine et vous fera profiter de ses good vibes exotiques.', 29.9, 3, 30, 'pothos.jpg', '2022-01-29 13:33:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_customers` (`id_customers`),
  ADD KEY `id_product` (`id_product`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`id_customers`) REFERENCES `customers` (`id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
