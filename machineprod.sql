-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 18 avr. 2022 à 23:32
-- Version du serveur :  10.4.17-MariaDB
-- Version de PHP : 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `machineprod`
--

-- --------------------------------------------------------

--
-- Structure de la table `actions`
--

CREATE TABLE `actions` (
  `id` int(11) NOT NULL,
  `number` int(3) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `actions`
--

INSERT INTO `actions` (`id`, `number`, `name`) VALUES
(16, 16, 'Pulizia Stampo'),
(17, 17, 'Macchina in allarme'),
(25, 25, 'Diminsioni NC'),
(40, 40, 'Pezzi confromi'),
(42, 42, 'Datario non aggiornato'),
(43, 43, 'Non benestare'),
(44, 44, 'benestare'),
(45, 45, 'Materiale per produzione non funzionale'),
(46, 46, 'Mancanza materia prima'),
(47, 47, 'Mancanza personale'),
(48, 48, 'Mancanza del materiale accessorio di produzione'),
(49, 49, 'accettazione in deroga'),
(50, 50, 'Tolto Benestare'),
(53, 53, 'Continua da ordine precedente'),
(54, 54, 'Fine settimana'),
(55, 55, 'Manutenzione'),
(56, 56, 'Pressa stampo non funzionante'),
(57, 57, 'Fornitura campioni per validazione'),
(58, 58, 'Ordine sospeso'),
(60, 60, 'CQ'),
(61, 61, 'Avvio'),
(62, 62, 'Riavvio'),
(63, 63, 'Montaggio e smontaggio Stampo/Accessori'),
(64, 64, 'Macchina ferma per'),
(65, 65, 'Chiusiura impronta'),
(66, 66, 'Inizio bordo Macchina'),
(67, 67, 'Fine bordo Macchina'),
(68, 68, 'Fine produzione'),
(69, 69, 'Apertura impronta'),
(70, 70, 'Oi evaso'),
(71, 71, 'Carico/controllo materiale'),
(88, 88, 'Eol Non funzionante');

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `general_setting`
--

CREATE TABLE `general_setting` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `business_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_white_logo` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_black_logo` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `site_color` varchar(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color_secondary` varchar(9) COLLATE utf8mb4_unicode_ci NOT NULL,
  `favicon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_person_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_address` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `license_verify` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `general_setting`
--

INSERT INTO `general_setting` (`id`, `business_name`, `company_white_logo`, `company_black_logo`, `site_color`, `color_secondary`, `favicon`, `contact_person_name`, `contact`, `business_address`, `city`, `created_at`, `updated_at`, `license_verify`) VALUES
(1, 'Machine Productivity Beta', 'logo.png', 'logo.png', '#D9D7D9', '#52608b', 'logo.png', 'Hamza SAIH', '0652250366', 'Al amal street', 0, NULL, '2022-04-04 14:46:09', 1);

-- --------------------------------------------------------

--
-- Structure de la table `machines`
--

CREATE TABLE `machines` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `machines`
--

INSERT INTO `machines` (`id`, `name`, `status`) VALUES
(1, '001', 'C'),
(2, '002', 'E'),
(3, '003', 'F'),
(4, '045', 'C'),
(5, '095', 'F'),
(6, '088', 'F');

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Structure de la table `operation`
--

CREATE TABLE `operation` (
  `id` int(11) NOT NULL,
  `production_id` int(11) NOT NULL,
  `action_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `created_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `operation`
--

INSERT INTO `operation` (`id`, `production_id`, `action_id`, `user_id`, `quantity`, `created_at`) VALUES
(1, 6, 16, 12, 0, '2022-03-24'),
(2, 1, 25, 12, 0, '2022-03-24'),
(3, 1, 45, 1, 0, '2022-03-24'),
(4, 5, 50, 12, 0, '2022-03-24'),
(5, 6, 25, 12, 0, '2022-04-14'),
(6, 6, 25, 12, 0, '2022-04-14'),
(7, 6, 56, 12, 0, '2022-04-14'),
(8, 6, 71, 12, 10007, '2022-04-14'),
(9, 3, 16, 12, 444, '2022-04-16'),
(10, 1, 25, 12, 8000, '2022-04-16'),
(11, 1, 16, 12, 8500, '2022-04-16');

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `productions`
--

CREATE TABLE `productions` (
  `id` int(11) NOT NULL,
  `order_id` varchar(15) NOT NULL,
  `code_article` varchar(15) NOT NULL,
  `desc_article` varchar(100) NOT NULL,
  `stampo` int(4) NOT NULL,
  `machine_id` int(11) NOT NULL,
  `starting_date` date NOT NULL,
  `ending_date` date NOT NULL,
  `objectif` int(11) NOT NULL,
  `production_lotto` int(11) NOT NULL,
  `scarto` int(11) NOT NULL,
  `status` varchar(1) NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `productions`
--

INSERT INTO `productions` (`id`, `order_id`, `code_article`, `desc_article`, `stampo`, `machine_id`, `starting_date`, `ending_date`, `objectif`, `production_lotto`, `scarto`, `status`, `created_at`, `updated_at`) VALUES
(1, '22/672', '910730003AA', 'Falcone 40ML', 763, 1, '2022-03-22', '2022-03-31', 12000, 8500, 0, 'P', '2022-04-16', '2022-04-16'),
(2, '22/673', '910730003AA', 'Falcone 60ML', 763, 2, '2022-03-22', '2022-03-31', 12000, 0, 0, 'I', '2022-04-16', '2022-04-16'),
(3, '22/674', '910730003AA', 'Falcone 60ML', 763, 3, '2022-03-22', '2022-03-31', 12000, 4000, 0, 'C', '2022-04-16', '2022-04-16'),
(4, '22/675', '910730003AA', 'Falcone 60ML', 763, 4, '2022-03-22', '2022-03-31', 16000, 7100, 0, 'C', '2022-04-16', '2022-04-16'),
(5, '22/676', '910730003AA', 'Falcone 60ML', 763, 1, '2022-03-22', '2022-03-31', 50000, 450, 0, 'C', '2022-04-16', '2022-04-16'),
(6, '22/677', '910730003AA', 'Falcone 60ML', 763, 1, '2022-03-22', '2022-03-31', 12000, 455, 0, 'P', '2022-04-16', '2022-04-16');

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'admin', '2022-01-01 11:09:40', '2022-01-01 11:09:47'),
(2, 'operator', '2022-01-01 11:09:51', '2022-01-01 11:09:54'),
(23, 'test role', '2022-01-02 11:05:19', '2022-01-02 11:05:19');

-- --------------------------------------------------------

--
-- Structure de la table `role_user`
--

CREATE TABLE `role_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `role_user`
--

INSERT INTO `role_user` (`id`, `user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2022-01-01 11:09:17', '2022-01-02 11:09:23'),
(12, 12, 2, '2022-01-05 13:22:48', '2022-03-15 19:06:16'),
(17, 18, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` int(11) NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_verified` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'profile_holder.png',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `status`, `remember_token`, `device_token`, `is_verified`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Hamza', 540, '$2a$12$yV2EJvqCf4v7gma69k9eMeN9PLdQSeKqaUeCxqEA45VzIbVXtOh0C', 1, NULL, NULL, 1, 'profile_holder.png', '2022-01-01 11:10:16', '2022-01-16 00:36:23'),
(12, 'OP 01', 541, '$2a$12$yV2EJvqCf4v7gma69k9eMeN9PLdQSeKqaUeCxqEA45VzIbVXtOh0C', 1, NULL, 'N/A', 1, 'profile_holder.png', '2022-01-03 10:28:56', '2022-01-16 00:01:54'),
(18, 'Test eding', 999, '$2y$10$UUQ3IOzpUNEeA26sHpzGZOrVao1kHmWpueGeUdtZZuOCyw7kamXzS', 1, NULL, NULL, 1, 'profile_holder.png', '2022-03-22 19:02:09', '2022-04-04 17:51:49');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `actions`
--
ALTER TABLE `actions`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `general_setting`
--
ALTER TABLE `general_setting`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `machines`
--
ALTER TABLE `machines`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `operation`
--
ALTER TABLE `operation`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Index pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Index pour la table `productions`
--
ALTER TABLE `productions`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `actions`
--
ALTER TABLE `actions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `general_setting`
--
ALTER TABLE `general_setting`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `machines`
--
ALTER TABLE `machines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `operation`
--
ALTER TABLE `operation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `productions`
--
ALTER TABLE `productions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pour la table `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
