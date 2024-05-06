-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2024. Máj 06. 23:16
-- Kiszolgáló verziója: 10.4.28-MariaDB
-- PHP verzió: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `kerteszetiaruhaz`
--
CREATE DATABASE IF NOT EXISTS `kerteszetiaruhaz` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci;
USE `kerteszetiaruhaz`;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `baskets`
--

DROP TABLE IF EXISTS `baskets`;
CREATE TABLE `baskets` (
  `basket_id` int(11) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `order_date` datetime NOT NULL DEFAULT '2024-05-06 20:34:04',
  `finished_order` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- TÁBLA KAPCSOLATAI `baskets`:
--   `user_id`
--       `users` -> `id`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `basket_items`
--

DROP TABLE IF EXISTS `basket_items`;
CREATE TABLE `basket_items` (
  `basket` int(11) NOT NULL,
  `product` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- TÁBLA KAPCSOLATAI `basket_items`:
--   `basket`
--       `baskets` -> `basket_id`
--   `product`
--       `products` -> `product_id`
--

--
-- Eseményindítók `basket_items`
--
DROP TRIGGER IF EXISTS `reserved_insert`;
DELIMITER $$
CREATE TRIGGER `reserved_insert` AFTER INSERT ON `basket_items` FOR EACH ROW BEGIN
            DECLARE available_stock INT;            
            SELECT in_stock INTO available_stock FROM products WHERE product_id = NEW.product; 
            IF available_stock >= NEW.amount THEN                
                UPDATE products SET in_stock = in_stock - NEW.amount, reserved = reserved + NEW.amount WHERE product_id = NEW.product;
            END IF;
        END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `descriptions`
--

DROP TABLE IF EXISTS `descriptions`;
CREATE TABLE `descriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `scientific_name` varchar(40) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- TÁBLA KAPCSOLATAI `descriptions`:
--   `scientific_name`
--       `plants` -> `scientific_name`
--

--
-- A tábla adatainak kiíratása `descriptions`
--

INSERT INTO `descriptions` (`id`, `scientific_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Pelargonium peltatum', 'A Pelargonium peltatum, vagy más néven lógó muskátli, lenyűgöző szépségű lombos növény. Különleges, lógó habitusa vonzza a tekinteteket, és virágai hosszan nyílnak. Ideális választás erkélyek, teraszok vagy akár kertek díszítésére. Könnyen gondozható, és hosszú ideig virágzik, így garantáltan örömöt fog szerezni kertjében.', NULL, NULL),
(2, 'Viola x wittrockiana', 'A Viola x wittrockiana, vagy közismert nevén árvácska, az egyik legkedveltebb tavaszi virág. Színpompás virágai frissességet és vidámságot hoznak bármely kertbe vagy erkélyre. Jól tűri az enyhe hideget, és hosszú virágzási időszakban részesíti gazdáját. Egyszerűen gondozható és sokszínű, így tökéletes választás a kert szerelmeseinek.', NULL, NULL),
(3, 'Paeonia officinalis', 'A Paeonia officinalis, vagy közismert nevén pünkösdi rózsa, elegancia és romantika szimbóluma. Csodálatos virágai, melyeket már évszázadok óta termesztenek, bármely kertet feldobják. Virágzása rövid, de az évek során egyre több hajtást hoz, így egyre impozánsabbá válik. Bámulatos illatával és lenyűgöző megjelenésével garantáltan lenyűgözi a látogatókat.', NULL, NULL),
(4, 'Rosa hybrid', 'A Rosa Hybrid egy kivételes rózsafajta, amely széles körben elérhető különböző színű és formájú virágokkal. Ezek a hibrid rózsák rendkívül vonzóak a kertekben és kerti tervezésekben. Kínálják a klasszikus rózsák szépségét és illatát, miközben gyakran ellenállóbbak és kevésbé igényesek, mint a hagyományos fajták. A Rosa Hybridek gyakran virágzanak és könnyen gondozhatók, így ideális választás minden rózsa szerelmese számára, aki egy különleges, mégis könnyen kezelhető növényt keres.', NULL, NULL),
(5, 'Rosa Austiger', 'Az Austiger Rosa hybrid egy igazi kertészeti remekmű. Ez a hibrid rózsa kivételesen szép virágokkal rendelkezik, melyek rendkívül bájosak és illatosak. Különleges vonalvezetése és gazdag színvilága lenyűgözi a rózsa szerelmeseit. Ideális választás kerti ágyások, kerítések vagy akár konténeres ültetések díszítésére. Gazdag virágzási időszakkal és könnyű gondozással büszkélkedhet, így minden kertész álma.', NULL, NULL),
(6, 'Rosa Lady of Shalott', 'A Lady of Shalott Rosa egy különleges és bájos rózsa, melynek virágai egyszerre romantikusak és elegánsak. A virágok sárga és barack árnyalatai romantikus hangulatot teremtenek a kertben. Ez a fajta könnyen gondozható és ellenálló, így ideális választás lehet minden kertész számára, aki egy gyönyörű, ám kevésbé igényes rózsát keres.', NULL, NULL),
(7, 'Salvia officinalis', 'Az officinalis salvia, vagy közismert nevén kerti zsálya, egy kiválóan használható fűszernövény és dísznövény egyaránt. A jellegzetes, ezüstös-zöld levelek és az általa termelt kék-lila virágok egyaránt vonzóvá teszik a kertet. Kiválóan alkalmas szárításra, fűszerként való használatra és kerti illatok előhívására egyaránt.', NULL, NULL),
(8, 'Salvia rosmarinus', 'A rosmarinus salvia, vagy rozmaring, egy sokoldalú növény, melyet gyakran használnak fűszerezésre és gyógyászati célokra egyaránt. A növény jellegzetes tűszerű levelei és kék-lila virágai minden konyhát és kertet feldobnak. Könnyen nevelhető és télálló, így ideális választás lehet minden olyan kertész számára, aki szeretné kihasználni a rozmaring sokoldalúságát.', NULL, NULL),
(9, 'Cucumis sativus', 'A Cucumis sativus, vagy közismert nevén uborka, egy friss és ropogós zöldség, melyet számos ételben és salátában használnak. Az uborka hűsítő és hidratáló, így ideális választás lehet a nyári hónapokban. Egyszerűen termeszthető és bő termést hoz, így minden kertész számára ajánlott.', NULL, NULL),
(10, 'Cucurbita pepo Goldena', 'A Goldena Cucurbita pepo egy különleges és díszes tökfajta, melynek aranyszínű és apró tököcskéi varázslatos megjelenést kölcsönöznek a kertnek. Ezek a dekoratív tököcskék ideálisak őszi dekorációkhoz és rendezvények díszítéséhez egyaránt. Egyszerűen termeszthető és hosszú ideig eltartható.', NULL, NULL),
(11, 'Cucurbita pepo', 'A Cucurbita pepo, vagy közismert nevén a pepók tökfajtákat többféle formában és méretben tartalmazza, beleértve a sárga és zöld tököket is. Ezek a tökfélék ideálisak az őszi szezonban, és számos ételkészítési célra használhatók. Gazdag ízükkel és textúrájukkal kiemelkedőek a levesekben, pitékben és más sütési receptekben. Egyszerűen termeszthetők és nagy termést hoznak, így kedvelt választás minden kertész számára, aki szereti az őszi zöldségeket és dekorációkat.', NULL, NULL),
(12, 'Cucurbita pepo Lajkonik', 'A Lajkonik Cucurbita pepo egy hagyományos tökfajta, melynek gyümölcsei hosszúkásak és sötétzöldek. A tökök ideálisak levesekhez, pitékhez és más őszi ételkészítményekhez. Könnyen termeszthető és nagy mennyiségű termést hoz, így ideális választás minden konyhakertben.', NULL, NULL);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- TÁBLA KAPCSOLATAI `failed_jobs`:
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- TÁBLA KAPCSOLATAI `migrations`:
--

--
-- A tábla adatainak kiíratása `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_01_14_125414_create_plant_categories_table', 1),
(6, '2024_01_14_125445_create_units_table', 1),
(7, '2024_01_14_125503_create_plants_table', 1),
(8, '2024_01_14_125504_create_products_table', 1),
(9, '2024_01_14_125520_create_purchases_table', 1),
(10, '2024_01_14_125526_create_purchase_items_table', 1),
(11, '2024_01_14_125702_create_suppliances_table', 1),
(12, '2024_01_30_140908__create_baskets_table', 1),
(13, '2024_01_30_141017_create_basket_items_table', 1),
(14, '2024_02_13_094933_create_product_prices_table', 1),
(15, '2024_03_01_121720_create_pictures_table', 1),
(16, '2024_03_11_165622_grand_total_calculation', 1),
(17, '2024_03_15_080806_stock_handling', 1),
(18, '2024_03_17_140632_prize_change_saver', 1),
(19, '2024_04_04_160039_create_descriptions_table', 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- TÁBLA KAPCSOLATAI `password_reset_tokens`:
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- TÁBLA KAPCSOLATAI `personal_access_tokens`:
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `pictures`
--

DROP TABLE IF EXISTS `pictures`;
CREATE TABLE `pictures` (
  `product` int(11) NOT NULL,
  `picture_path` varchar(255) NOT NULL,
  `purpose` char(255) NOT NULL DEFAULT 'P',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- TÁBLA KAPCSOLATAI `pictures`:
--   `product`
--       `products` -> `product_id`
--

--
-- A tábla adatainak kiíratása `pictures`
--

INSERT INTO `pictures` (`product`, `picture_path`, `purpose`, `created_at`, `updated_at`) VALUES
(1000, 'kepek/termekek/Futomuskatli/Futomuskatli1.jpg', 'B', NULL, NULL),
(1000, 'kepek/termekek/Futomuskatli/Futomuskatli2.jpg', 'P', NULL, NULL),
(1000, 'kepek/termekek/Futomuskatli/Futomuskatli3.jpg', 'P', NULL, NULL),
(1000, 'kepek/termekek/Futomuskatli/Futomuskatli4.jpg', 'P', NULL, NULL),
(1000, 'kepek/termekek/Futomuskatli/Futomuskatli5.jpg', 'P', NULL, NULL),
(1001, 'kepek/termekek/kertiarvacska/kertiarvacska1.jpg', 'P', NULL, NULL),
(1001, 'kepek/termekek/kertiarvacska/kertiarvacska2.jpg', 'B', NULL, NULL),
(1001, 'kepek/termekek/kertiarvacska/kertiarvacska3.jpg', 'P', NULL, NULL),
(1001, 'kepek/termekek/kertiarvacska/kertiarvacska4.jpg', 'P', NULL, NULL),
(1001, 'kepek/termekek/kertiarvacska/kertiarvacska5.jpg', 'P', NULL, NULL),
(1002, 'kepek/termekek/kertibazsarozsa/kertibazsarozsa1.jpg', 'B', NULL, NULL),
(1002, 'kepek/termekek/kertibazsarozsa/kertibazsarozsa2.jpg', 'P', NULL, NULL),
(1002, 'kepek/termekek/kertibazsarozsa/kertibazsarozsa3.jpg', 'P', NULL, NULL),
(1002, 'kepek/termekek/kertibazsarozsa/kertibazsarozsa4.jpg', 'P', NULL, NULL),
(1002, 'kepek/termekek/kertibazsarozsa/kertibazsarozsa5.jpg', 'P', NULL, NULL),
(1003, 'kepek/termekek/vorosrozsa/vorosrozsa1.jpg', 'P', NULL, NULL),
(1003, 'kepek/termekek/vorosrozsa/vorosrozsa2.jpg', 'B', NULL, NULL),
(1003, 'kepek/termekek/vorosrozsa/vorosrozsa3.jpg', 'P', NULL, NULL),
(1003, 'kepek/termekek/vorosrozsa/vorosrozsa4.jpg', 'P', NULL, NULL),
(1003, 'kepek/termekek/vorosrozsa/vorosrozsa5.jpg', 'P', NULL, NULL),
(1004, 'kepek/termekek/queenofsweden/queenofsweden1.jpg', 'P', NULL, NULL),
(1004, 'kepek/termekek/queenofsweden/queenofsweden2.jpg', 'P', NULL, NULL),
(1004, 'kepek/termekek/queenofsweden/queenofsweden3.jpg', 'B', NULL, NULL),
(1004, 'kepek/termekek/queenofsweden/queenofsweden4.jpg', 'P', NULL, NULL),
(1004, 'kepek/termekek/queenofsweden/queenofsweden5.jpg', 'P', NULL, NULL),
(1005, 'kepek/termekek/ladyofshalott/ladyofshalott1.jpg', 'B', NULL, NULL),
(1005, 'kepek/termekek/ladyofshalott/ladyofshalott2.jpg', 'P', NULL, NULL),
(1005, 'kepek/termekek/ladyofshalott/ladyofshalott3.jpg', 'P', NULL, NULL),
(1005, 'kepek/termekek/ladyofshalott/ladyofshalott4.jpg', 'P', NULL, NULL),
(1005, 'kepek/termekek/ladyofshalott/ladyofshalott5.jpg', 'P', NULL, NULL),
(1006, 'kepek/termekek/orvosizsalya/orvosizsalya1.jpg', 'P', NULL, NULL),
(1006, 'kepek/termekek/orvosizsalya/orvosizsalya2.jpg', 'P', NULL, NULL),
(1006, 'kepek/termekek/orvosizsalya/orvosizsalya3.jpg', 'B', NULL, NULL),
(1006, 'kepek/termekek/orvosizsalya/orvosizsalya4.jpg', 'P', NULL, NULL),
(1006, 'kepek/termekek/orvosizsalya/orvosizsalya5.jpg', 'P', NULL, NULL),
(1007, 'kepek/termekek/rozmaring/rozmaring1.jpg', 'P', NULL, NULL),
(1007, 'kepek/termekek/rozmaring/rozmaring2.jpg', 'P', NULL, NULL),
(1007, 'kepek/termekek/rozmaring/rozmaring3.jpg', 'P', NULL, NULL),
(1007, 'kepek/termekek/rozmaring/rozmaring4.jpg', 'B', NULL, NULL),
(1008, 'kepek/termekek/uborka/uborka1.jpg', 'B', NULL, NULL),
(1008, 'kepek/termekek/uborka/uborka2.jpg', 'P', NULL, NULL),
(1008, 'kepek/termekek/uborka/uborka3.jpg', 'P', NULL, NULL),
(1008, 'kepek/termekek/uborka/uborka4.jpg', 'P', NULL, NULL),
(1009, 'kepek/termekek/sargacukkini/sargacukkini1.jpg', 'B', NULL, NULL),
(1009, 'kepek/termekek/sargacukkini/sargacukkini2.jpg', 'P', NULL, NULL),
(1009, 'kepek/termekek/sargacukkini/sargacukkini3.jpg', 'P', NULL, NULL),
(1009, 'kepek/termekek/sargacukkini/sargacukkini4.jpg', 'P', NULL, NULL),
(1010, 'kepek/termekek/zoldcukkini/zoldcukkini1.jpg', 'B', NULL, NULL),
(1010, 'kepek/termekek/zoldcukkini/zoldcukkini2.jpg', 'P', NULL, NULL),
(1010, 'kepek/termekek/zoldcukkini/zoldcukkini3.jpg', 'P', NULL, NULL),
(1010, 'kepek/termekek/zoldcukkini/zoldcukkini4.jpg', 'P', NULL, NULL),
(1011, 'kepek/termekek/csikoscukkini/csikoscukkini1.jpg', 'P', NULL, NULL),
(1011, 'kepek/termekek/csikoscukkini/csikoscukkini2.jpg', 'B', NULL, NULL),
(1011, 'kepek/termekek/csikoscukkini/csikoscukkini3.jpg', 'P', NULL, NULL),
(1012, 'kepek/termekek/queenofsweden/queenofsweden1.jpg', 'P', NULL, NULL),
(1012, 'kepek/termekek/queenofsweden/queenofsweden2.jpg', 'B', NULL, NULL),
(1012, 'kepek/termekek/queenofsweden/queenofsweden3.jpg', 'P', NULL, NULL),
(1012, 'kepek/termekek/queenofsweden/queenofsweden4.jpg', 'P', NULL, NULL),
(1012, 'kepek/termekek/queenofsweden/queenofsweden5.jpg', 'P', NULL, NULL),
(1013, 'kepek/termekek/ladyofshalott/ladyofshalott1.jpg', 'P', NULL, NULL),
(1013, 'kepek/termekek/ladyofshalott/ladyofshalott2.jpg', 'P', NULL, NULL),
(1013, 'kepek/termekek/ladyofshalott/ladyofshalott3.jpg', 'P', NULL, NULL),
(1013, 'kepek/termekek/ladyofshalott/ladyofshalott4.jpg', 'P', NULL, NULL),
(1013, 'kepek/termekek/ladyofshalott/ladyofshalott5.jpg', 'B', NULL, NULL),
(1014, 'kepek/termekek/orvosizsalya/orvosizsalya1.jpg', 'P', NULL, NULL),
(1014, 'kepek/termekek/orvosizsalya/orvosizsalya2.jpg', 'B', NULL, NULL),
(1014, 'kepek/termekek/orvosizsalya/orvosizsalya3.jpg', 'P', NULL, NULL),
(1014, 'kepek/termekek/orvosizsalya/orvosizsalya4.jpg', 'P', NULL, NULL),
(1014, 'kepek/termekek/orvosizsalya/orvosizsalya5.jpg', 'P', NULL, NULL);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `plants`
--

DROP TABLE IF EXISTS `plants`;
CREATE TABLE `plants` (
  `scientific_name` varchar(40) NOT NULL,
  `name` varchar(30) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `plant_category` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- TÁBLA KAPCSOLATAI `plants`:
--   `plant_category`
--       `plant_categories` -> `plant_category`
--

--
-- A tábla adatainak kiíratása `plants`
--

INSERT INTO `plants` (`scientific_name`, `name`, `created_at`, `updated_at`, `plant_category`) VALUES
('Cucumis sativus', 'Uborka', NULL, NULL, 104),
('Cucurbita pepo', 'Zöld Cukkini', NULL, NULL, 104),
('Cucurbita pepo Goldena', 'Sárga Cukkini', NULL, NULL, 104),
('Cucurbita pepo Lajkonik', 'Csíkos Cukkini', NULL, NULL, 104),
('Paeonia officinalis', 'Kerti bazsarózsa', NULL, NULL, 107),
('Pelargonium peltatum', 'Futómuskátli', NULL, NULL, 100),
('Rosa Austiger', 'Queen of Sweden', NULL, NULL, 106),
('Rosa hybrid', 'Vörös rózsa', NULL, NULL, 106),
('Rosa Lady of Shalott', 'Lady of shalott', NULL, NULL, 106),
('Salvia officinalis', 'Orvosi zsálya', NULL, NULL, 105),
('Salvia rosmarinus', 'Rozmaring', NULL, NULL, 105),
('Viola x wittrockiana', 'Kerti árvácska', NULL, NULL, 100);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `plant_categories`
--

DROP TABLE IF EXISTS `plant_categories`;
CREATE TABLE `plant_categories` (
  `plant_category` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- TÁBLA KAPCSOLATAI `plant_categories`:
--

--
-- A tábla adatainak kiíratása `plant_categories`
--

INSERT INTO `plant_categories` (`plant_category`, `name`, `created_at`, `updated_at`) VALUES
(100, 'Egynyáriak', NULL, NULL),
(101, 'Évelő növények', NULL, NULL),
(102, 'Sziklakerti növények', NULL, NULL),
(103, 'Bogyós gyümölcsök', NULL, NULL),
(104, 'Zöldségek', NULL, NULL),
(105, 'Fűszernövények', NULL, NULL),
(106, 'Rózsák', NULL, NULL),
(107, 'Bazsarózsák', NULL, NULL),
(108, 'Liliomok', NULL, NULL),
(109, 'Jácint', NULL, NULL),
(110, 'Egyéb hagymások', NULL, NULL);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `scientific_name` varchar(40) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `type` tinyint(1) NOT NULL DEFAULT 0,
  `color` varchar(20) DEFAULT NULL,
  `unit` bigint(20) UNSIGNED NOT NULL,
  `price` int(11) NOT NULL,
  `in_stock` int(11) NOT NULL,
  `reserved` int(11) NOT NULL,
  `priority` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- TÁBLA KAPCSOLATAI `products`:
--   `scientific_name`
--       `plants` -> `scientific_name`
--   `unit`
--       `units` -> `unit_id`
--

--
-- A tábla adatainak kiíratása `products`
--

INSERT INTO `products` (`product_id`, `scientific_name`, `status`, `type`, `color`, `unit`, `price`, `in_stock`, `reserved`, `priority`, `created_at`, `updated_at`) VALUES
(1000, 'Pelargonium peltatum', 1, 1, 'piros', 200, 1300, 50, 0, 1, NULL, NULL),
(1001, 'Viola x wittrockiana', 1, 1, 'lila', 202, 3000, 50, 0, 0, NULL, NULL),
(1002, 'Paeonia officinalis', 1, 1, 'rózsaszin', 203, 1000, 50, 0, 1, NULL, NULL),
(1003, 'Rosa hybrid', 1, 1, 'vörös', 201, 1700, 50, 0, 1, NULL, NULL),
(1004, 'Rosa Austiger', 1, 1, 'rózsaszín', 204, 5000, 50, 0, 0, NULL, NULL),
(1005, 'Rosa Lady of Shalott', 1, 1, 'narancs', 202, 2600, 50, 0, 1, NULL, NULL),
(1006, 'Salvia officinalis', 1, 1, 'lila', 201, 900, 50, 0, 0, NULL, NULL),
(1007, 'Salvia rosmarinus', 1, 1, 'lila', 200, 690, 50, 0, 1, NULL, NULL),
(1008, 'Cucumis sativus', 1, 1, 'zöld', 203, 1800, 50, 0, 0, NULL, NULL),
(1009, 'Cucurbita pepo Goldena', 1, 1, 'sárga', 202, 6200, 50, 0, 0, NULL, NULL),
(1010, 'Cucurbita pepo', 1, 1, 'zöld', 200, 5200, 50, 0, 1, NULL, NULL),
(1011, 'Cucurbita pepo Lajkonik', 1, 1, 'csíkos', 204, 3500, 50, 0, 0, NULL, NULL),
(1012, 'Rosa Austiger', 1, 1, 'piros', 201, 3200, 50, 0, 0, NULL, NULL),
(1013, 'Rosa Lady of Shalott', 1, 1, 'narancs', 204, 2200, 50, 0, 0, NULL, NULL),
(1014, 'Salvia officinalis', 1, 1, 'fehér', 203, 1000, 50, 0, 0, NULL, NULL);

--
-- Eseményindítók `products`
--
DROP TRIGGER IF EXISTS `prize_update_product_create`;
DELIMITER $$
CREATE TRIGGER `prize_update_product_create` AFTER INSERT ON `products` FOR EACH ROW BEGIN
            INSERT INTO product_prices (product, change_date, new_price, created_at, updated_at)
            VALUES (NEW.product_id, NOW(), NEW.price, NOW(), NOW());
        END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `prize_update_saver`;
DELIMITER $$
CREATE TRIGGER `prize_update_saver` AFTER UPDATE ON `products` FOR EACH ROW BEGIN
                IF OLD.price <> NEW.price THEN
                    INSERT INTO product_prices (product, change_date, new_price, created_at, updated_at)
                    VALUES (NEW.product_id, NOW(), NEW.price, NOW(), NOW());
                END IF;
            END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `product_prices`
--

DROP TABLE IF EXISTS `product_prices`;
CREATE TABLE `product_prices` (
  `product` int(11) NOT NULL,
  `change_date` datetime NOT NULL DEFAULT '2024-05-06 20:34:04',
  `new_price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- TÁBLA KAPCSOLATAI `product_prices`:
--   `product`
--       `products` -> `product_id`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `purchases`
--

DROP TABLE IF EXISTS `purchases`;
CREATE TABLE `purchases` (
  `purchase_number` bigint(20) UNSIGNED NOT NULL,
  `buyer` bigint(20) UNSIGNED NOT NULL,
  `shopping_date` datetime NOT NULL DEFAULT '2024-05-06 20:34:03',
  `grand_total` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ;

--
-- TÁBLA KAPCSOLATAI `purchases`:
--   `buyer`
--       `users` -> `id`
--

--
-- A tábla adatainak kiíratása `purchases`
--

INSERT INTO `purchases` (`purchase_number`, `buyer`, `shopping_date`, `grand_total`, `created_at`, `updated_at`) VALUES
(10000000, 1, '2023-05-17 00:00:00', NULL, NULL, NULL),
(10000001, 2, '2024-01-05 00:00:00', NULL, NULL, NULL),
(10000002, 2, '2023-11-29 00:00:00', NULL, NULL, NULL),
(10000003, 3, '2023-07-06 00:00:00', NULL, NULL, NULL),
(10000004, 2, '2023-03-13 00:00:00', NULL, NULL, NULL),
(10000011, 2, '2024-05-02 20:58:47', NULL, '2024-05-02 14:58:48', '2024-05-02 14:58:48'),
(10000012, 2, '2024-05-02 20:59:51', NULL, '2024-05-02 14:59:52', '2024-05-02 14:59:52'),
(10000013, 2, '2024-05-02 21:00:27', NULL, '2024-05-02 15:00:28', '2024-05-02 15:00:28'),
(10000014, 2, '2024-05-02 21:01:32', NULL, '2024-05-02 15:01:33', '2024-05-02 15:01:33'),
(10000015, 2, '2024-05-02 21:02:05', NULL, '2024-05-02 15:02:06', '2024-05-02 15:02:06'),
(10000016, 2, '2024-05-02 21:03:55', NULL, '2024-05-02 15:03:57', '2024-05-02 15:03:57'),
(10000017, 2, '2024-05-02 22:43:06', NULL, '2024-05-02 16:43:06', '2024-05-02 16:43:06'),
(10000018, 2, '2024-05-02 22:44:31', NULL, '2024-05-02 16:44:32', '2024-05-02 16:44:32'),
(10000019, 2, '2024-05-02 22:45:04', NULL, '2024-05-02 16:45:05', '2024-05-02 16:45:05'),
(10000020, 2, '2024-05-02 22:47:01', NULL, '2024-05-02 16:47:03', '2024-05-02 16:47:03'),
(10000021, 2, '2024-05-02 22:48:01', NULL, '2024-05-02 16:48:02', '2024-05-02 16:48:02'),
(10000022, 2, '2024-05-02 22:51:07', 690, '2024-05-02 16:51:08', '2024-05-02 16:51:08'),
(10000023, 2, '2024-05-03 00:38:52', 17600, '2024-05-02 18:38:53', '2024-05-02 18:38:53'),
(10000024, 2, '2024-05-03 00:39:22', NULL, '2024-05-02 18:39:23', '2024-05-02 18:39:23'),
(10000025, 2, '2024-05-03 00:39:23', 11800, '2024-05-02 18:39:24', '2024-05-02 18:39:24'),
(10000026, 2, '2024-05-03 00:39:24', 11800, '2024-05-02 18:39:25', '2024-05-02 18:39:25'),
(10000027, 2, '2024-05-03 01:02:18', 1800, '2024-05-02 19:02:19', '2024-05-02 19:02:19'),
(10000028, 2, '2024-05-03 01:05:32', 5200, '2024-05-02 19:05:33', '2024-05-02 19:05:33'),
(10000029, 2, '2024-05-03 05:51:10', 4800, '2024-05-02 23:51:11', '2024-05-02 23:51:11'),
(10000030, 2, '2024-05-03 13:00:18', 7200, '2024-05-03 07:00:20', '2024-05-03 07:00:20'),
(10000031, 2, '2024-05-03 13:00:20', 7200, '2024-05-03 07:00:22', '2024-05-03 07:00:22');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `purchase_items`
--

DROP TABLE IF EXISTS `purchase_items`;
CREATE TABLE `purchase_items` (
  `purchase_number` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- TÁBLA KAPCSOLATAI `purchase_items`:
--   `product_id`
--       `products` -> `product_id`
--   `purchase_number`
--       `purchases` -> `purchase_number`
--

--
-- A tábla adatainak kiíratása `purchase_items`
--

INSERT INTO `purchase_items` (`purchase_number`, `product_id`, `quantity`, `created_at`, `updated_at`) VALUES
(10000000, 1006, 5, NULL, NULL),
(10000000, 1008, 4, NULL, NULL),
(10000001, 1002, 5, NULL, NULL),
(10000001, 1006, 21, NULL, NULL),
(10000001, 1007, 21, NULL, NULL),
(10000001, 1008, 2, NULL, NULL),
(10000002, 1002, 2, NULL, NULL),
(10000002, 1003, 2, NULL, NULL),
(10000002, 1008, 2, NULL, NULL),
(10000002, 1009, 2, NULL, NULL),
(10000023, 1000, 4, '2024-05-02 18:38:55', '2024-05-02 18:38:55'),
(10000023, 1001, 3, '2024-05-02 18:38:56', '2024-05-02 18:38:56'),
(10000023, 1003, 2, '2024-05-02 18:38:57', '2024-05-02 18:38:57'),
(10000025, 1002, 1, '2024-05-02 18:39:26', '2024-05-02 18:39:26'),
(10000025, 1008, 6, '2024-05-02 18:39:28', '2024-05-02 18:39:28'),
(10000026, 1002, 1, '2024-05-02 18:39:27', '2024-05-02 18:39:27'),
(10000026, 1008, 6, '2024-05-02 18:39:29', '2024-05-02 18:39:29'),
(10000027, 1008, 1, '2024-05-02 19:02:21', '2024-05-02 19:02:21'),
(10000028, 1000, 4, '2024-05-02 19:05:35', '2024-05-02 19:05:35'),
(10000029, 1001, 1, '2024-05-02 23:51:13', '2024-05-02 23:51:13'),
(10000029, 1006, 2, '2024-05-02 23:51:14', '2024-05-02 23:51:14'),
(10000030, 1008, 4, '2024-05-03 07:00:21', '2024-05-03 07:00:21'),
(10000031, 1008, 4, '2024-05-03 07:00:23', '2024-05-03 07:00:23');

--
-- Eseményindítók `purchase_items`
--
DROP TRIGGER IF EXISTS `grand_total_calculation_delete`;
DELIMITER $$
CREATE TRIGGER `grand_total_calculation_delete` AFTER DELETE ON `purchase_items` FOR EACH ROW BEGIN
                    DECLARE total DECIMAL(10,2);
                    DECLARE purchase_id INT;

                    -- Retrieve the corresponding purchase_id
                    SELECT purchase_number INTO purchase_id FROM purchase_items
                    WHERE OLD.purchase_number = purchase_number LIMIT 1;

                    -- Calculate the total
                    SELECT SUM(products.price * purchase_items.quantity) INTO total
                    FROM purchase_items
                    INNER JOIN products ON purchase_items.product_id = products.product_id
                    WHERE purchase_items.purchase_number = OLD.purchase_number;

                    -- Update the grand_total in the purchases table
                    UPDATE purchases SET grand_total = total WHERE purchase_number = purchase_id;
                END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `grand_total_calculation_insert`;
DELIMITER $$
CREATE TRIGGER `grand_total_calculation_insert` AFTER INSERT ON `purchase_items` FOR EACH ROW BEGIN
                DECLARE total DECIMAL(10,2);
                DECLARE purchase_id INT;

                -- Retrieve the corresponding purchase_id
                SELECT purchase_number INTO purchase_id FROM purchase_items
                WHERE NEW.purchase_number = purchase_number LIMIT 1;

                -- Calculate the total
                SELECT SUM(products.price * purchase_items.quantity) INTO total
                FROM purchase_items
                INNER JOIN products ON purchase_items.product_id = products.product_id
                WHERE purchase_items.purchase_number = NEW.purchase_number;

                -- Update the grand_total in the purchases table
                UPDATE purchases SET grand_total = total WHERE purchase_number = purchase_id;
            END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `grand_total_calculation_update`;
DELIMITER $$
CREATE TRIGGER `grand_total_calculation_update` AFTER UPDATE ON `purchase_items` FOR EACH ROW BEGIN
                DECLARE total DECIMAL(10,2);
                DECLARE purchase_id INT;

                -- Retrieve the corresponding purchase_id
                SELECT purchase_number INTO purchase_id FROM purchase_items
                 WHERE NEW.purchase_number = purchase_number LIMIT 1;

                -- Calculate the total
                SELECT SUM(products.price * purchase_items.quantity) INTO total
                FROM purchase_items
                INNER JOIN products ON purchase_items.product_id = products.product_id
                WHERE purchase_items.purchase_number = NEW.purchase_number;

                -- Update the grand_total in the purchases table
                UPDATE purchases SET grand_total = total WHERE purchase_number = purchase_id;
            END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `suppliances`
--

DROP TABLE IF EXISTS `suppliances`;
CREATE TABLE `suppliances` (
  `product` int(11) NOT NULL,
  `suppliance_date` datetime NOT NULL DEFAULT '2024-05-06 20:34:04',
  `number_of_items` int(11) NOT NULL,
  `purchase_price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- TÁBLA KAPCSOLATAI `suppliances`:
--   `product`
--       `products` -> `product_id`
--

--
-- Eseményindítók `suppliances`
--
DROP TRIGGER IF EXISTS `product_added`;
DELIMITER $$
CREATE TRIGGER `product_added` AFTER INSERT ON `suppliances` FOR EACH ROW BEGIN
            DECLARE available_stock INT;            
            SELECT in_stock INTO available_stock FROM products WHERE product_id = NEW.product;                          
            UPDATE products SET in_stock = in_stock + NEW.number_of_items WHERE product_id = NEW.product;
            
        END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `units`
--

DROP TABLE IF EXISTS `units`;
CREATE TABLE `units` (
  `unit_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- TÁBLA KAPCSOLATAI `units`:
--

--
-- A tábla adatainak kiíratása `units`
--

INSERT INTO `units` (`unit_id`, `name`, `created_at`, `updated_at`) VALUES
(200, '12 cm cserép', NULL, NULL),
(201, '5l cserép', NULL, NULL),
(202, '5g', NULL, NULL),
(203, '100g', NULL, NULL),
(204, 'gyökércsomagolt', NULL, NULL);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `permission` int(11) NOT NULL DEFAULT 2,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- TÁBLA KAPCSOLATAI `users`:
--

--
-- A tábla adatainak kiíratása `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `permission`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Vásárló', 'vasarlo@gmail.com', NULL, '$2y$12$jF2fRavtuzxP0pN77OhOi.MpJLHo8czZG4KR6px/py6dsDfIUHU4C', 2, NULL, NULL, NULL),
(2, 'Tóth Béla', 'belus@gmail.com', NULL, '$2y$12$U1X11.eNuGJQHW5ZDzyHx.EsKAES0PtzTBgSDDQaw93NyI.NMR2KO', 2, NULL, NULL, NULL),
(3, 'Horváth Ilona', 'ilcsi@gmail.com', NULL, '$2y$12$6oeRAnhSJeIlduWR5YYrweoea44wnD7aCbvbriLuewK2MNI51TQQ.', 2, NULL, NULL, NULL),
(4, 'Admin', 'admin@gmail.com', NULL, '$2y$12$DMeTV/JCk9Uk2WGy3A/IleF6KT8DVVOUOTpaFx7EI9jRHpmWYcPDC', 1, NULL, NULL, NULL),
(5, 'SuperAdmin', 'sadmin@gmail.com', NULL, '$2y$12$VvuE5NRlqc5H9a0nDGNLIuaUkX2YLWBS4gkvxBmNggd8h8YBcXA4m', 0, NULL, NULL, NULL),
(6, 'Vendég', 'vendeg@gmail.com', NULL, '$2y$12$jjOULSHs7O997ttcvPwfKOpT2ID0Lz9SGdRP7WFUaV5jWV.uHvoBS', 0, NULL, NULL, NULL),
(7, 'Törlendő', 'torlendo@gmail.com', NULL, '$2y$12$is9XDoz7ZVMxvLb05pWLXeBOxZCfkGu/gXOccBelykizBdeCeBTyG', 2, NULL, NULL, NULL);

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `baskets`
--
ALTER TABLE `baskets`
  ADD PRIMARY KEY (`basket_id`),
  ADD KEY `baskets_user_id_foreign` (`user_id`);

--
-- A tábla indexei `basket_items`
--
ALTER TABLE `basket_items`
  ADD PRIMARY KEY (`product`,`basket`),
  ADD KEY `basket_items_basket_foreign` (`basket`);

--
-- A tábla indexei `descriptions`
--
ALTER TABLE `descriptions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `descriptions_scientific_name_unique` (`scientific_name`);

--
-- A tábla indexei `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- A tábla indexei `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- A tábla indexei `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- A tábla indexei `pictures`
--
ALTER TABLE `pictures`
  ADD PRIMARY KEY (`product`,`picture_path`);

--
-- A tábla indexei `plants`
--
ALTER TABLE `plants`
  ADD PRIMARY KEY (`scientific_name`),
  ADD UNIQUE KEY `plants_scientific_name_unique` (`scientific_name`),
  ADD KEY `plants_plant_category_foreign` (`plant_category`);

--
-- A tábla indexei `plant_categories`
--
ALTER TABLE `plant_categories`
  ADD PRIMARY KEY (`plant_category`);

--
-- A tábla indexei `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `products_scientific_name_foreign` (`scientific_name`),
  ADD KEY `products_unit_foreign` (`unit`);

--
-- A tábla indexei `product_prices`
--
ALTER TABLE `product_prices`
  ADD PRIMARY KEY (`product`,`change_date`);

--
-- A tábla indexei `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`purchase_number`),
  ADD KEY `purchases_buyer_foreign` (`buyer`);

--
-- A tábla indexei `purchase_items`
--
ALTER TABLE `purchase_items`
  ADD PRIMARY KEY (`purchase_number`,`product_id`),
  ADD KEY `purchase_items_product_id_foreign` (`product_id`);

--
-- A tábla indexei `suppliances`
--
ALTER TABLE `suppliances`
  ADD PRIMARY KEY (`product`,`suppliance_date`);

--
-- A tábla indexei `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`unit_id`);

--
-- A tábla indexei `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `baskets`
--
ALTER TABLE `baskets`
  MODIFY `basket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100000;

--
-- AUTO_INCREMENT a táblához `descriptions`
--
ALTER TABLE `descriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT a táblához `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT a táblához `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `plant_categories`
--
ALTER TABLE `plant_categories`
  MODIFY `plant_category` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT a táblához `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1015;

--
-- AUTO_INCREMENT a táblához `purchases`
--
ALTER TABLE `purchases`
  MODIFY `purchase_number` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `units`
--
ALTER TABLE `units`
  MODIFY `unit_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=205;

--
-- AUTO_INCREMENT a táblához `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `baskets`
--
ALTER TABLE `baskets`
  ADD CONSTRAINT `baskets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Megkötések a táblához `basket_items`
--
ALTER TABLE `basket_items`
  ADD CONSTRAINT `basket_items_basket_foreign` FOREIGN KEY (`basket`) REFERENCES `baskets` (`basket_id`),
  ADD CONSTRAINT `basket_items_product_foreign` FOREIGN KEY (`product`) REFERENCES `products` (`product_id`);

--
-- Megkötések a táblához `descriptions`
--
ALTER TABLE `descriptions`
  ADD CONSTRAINT `descriptions_scientific_name_foreign` FOREIGN KEY (`scientific_name`) REFERENCES `plants` (`scientific_name`);

--
-- Megkötések a táblához `pictures`
--
ALTER TABLE `pictures`
  ADD CONSTRAINT `pictures_product_foreign` FOREIGN KEY (`product`) REFERENCES `products` (`product_id`);

--
-- Megkötések a táblához `plants`
--
ALTER TABLE `plants`
  ADD CONSTRAINT `plants_plant_category_foreign` FOREIGN KEY (`plant_category`) REFERENCES `plant_categories` (`plant_category`);

--
-- Megkötések a táblához `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_scientific_name_foreign` FOREIGN KEY (`scientific_name`) REFERENCES `plants` (`scientific_name`),
  ADD CONSTRAINT `products_unit_foreign` FOREIGN KEY (`unit`) REFERENCES `units` (`unit_id`);

--
-- Megkötések a táblához `product_prices`
--
ALTER TABLE `product_prices`
  ADD CONSTRAINT `product_prices_product_foreign` FOREIGN KEY (`product`) REFERENCES `products` (`product_id`);

--
-- Megkötések a táblához `purchases`
--
ALTER TABLE `purchases`
  ADD CONSTRAINT `purchases_buyer_foreign` FOREIGN KEY (`buyer`) REFERENCES `users` (`id`);

--
-- Megkötések a táblához `purchase_items`
--
ALTER TABLE `purchase_items`
  ADD CONSTRAINT `purchase_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `purchase_items_purchase_number_foreign` FOREIGN KEY (`purchase_number`) REFERENCES `purchases` (`purchase_number`);

--
-- Megkötések a táblához `suppliances`
--
ALTER TABLE `suppliances`
  ADD CONSTRAINT `suppliances_product_foreign` FOREIGN KEY (`product`) REFERENCES `products` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
