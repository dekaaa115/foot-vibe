-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.4.3 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for foot_vibe
CREATE DATABASE IF NOT EXISTS `foot_vibe` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `foot_vibe`;

-- Dumping structure for table foot_vibe.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table foot_vibe.cache: ~6 rows (approximately)
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
	('laravel-cache-356a192b7913b04c54574d18c28d46e6395428ab', 'i:1;', 1780226190),
	('laravel-cache-356a192b7913b04c54574d18c28d46e6395428ab:timer', 'i:1780226190;', 1780226190),
	('laravel-cache-da4b9237bacccdf19c0760cab7aec4a8359010b0', 'i:8;', 1779032033),
	('laravel-cache-da4b9237bacccdf19c0760cab7aec4a8359010b0:timer', 'i:1779032033;', 1779032033),
	('laravel-cache-livewire-rate-limiter:a17961fa74e9275d529f489537f179c05d50c2f3', 'i:1;', 1780226261),
	('laravel-cache-livewire-rate-limiter:a17961fa74e9275d529f489537f179c05d50c2f3:timer', 'i:1780226261;', 1780226261);

-- Dumping structure for table foot_vibe.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table foot_vibe.cache_locks: ~0 rows (approximately)

-- Dumping structure for table foot_vibe.carts
CREATE TABLE IF NOT EXISTS `carts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `carts_user_id_foreign` (`user_id`),
  KEY `carts_product_id_foreign` (`product_id`),
  CONSTRAINT `carts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table foot_vibe.carts: ~0 rows (approximately)
INSERT INTO `carts` (`id`, `user_id`, `product_id`, `size`, `quantity`, `created_at`, `updated_at`) VALUES
	(1, 2, 2, '42', 1, '2026-05-17 08:35:23', '2026-05-17 08:35:23');

-- Dumping structure for table foot_vibe.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table foot_vibe.categories: ~8 rows (approximately)
INSERT INTO `categories` (`id`, `name`, `slug`, `image`, `created_at`, `updated_at`) VALUES
	(1, 'Running', 'running', 'categories/01KRV5A4TCT5K35ZEWRS5N4WFT.png', '2026-05-17 07:26:45', '2026-05-17 07:26:45'),
	(2, 'Slippers', 'slippers', 'categories/01KRV83HY89J4JWBEPWHSAC4DJ.png', '2026-05-17 08:15:35', '2026-05-17 08:15:35'),
	(3, 'Lifestyle', 'lifestyle', 'categories/01KRV84GJRAY7BYJS39BVMBSK8.png', '2026-05-17 08:16:06', '2026-05-17 08:16:06'),
	(4, 'Basketball', 'basketball', 'categories/01KRV870VNQB6FEQG8SBR4T8KS.png', '2026-05-17 08:17:29', '2026-05-17 08:17:29'),
	(5, 'Skate', 'skate', 'categories/01KRV88SGQBGDY948CSMWD97DZ.png', '2026-05-17 08:18:27', '2026-05-17 08:18:27'),
	(6, 'Formal', 'formal', 'categories/01KRV8AFQ4XCPG8S0MK2609KCS.png', '2026-05-17 08:19:22', '2026-05-17 08:19:22'),
	(7, 'Outdoor', 'outdoor', 'categories/01KRV8BWYC0NSQZZRQVGMN3FZ0.png', '2026-05-17 08:20:08', '2026-05-17 08:20:08'),
	(8, 'Sports', 'sports', 'categories/01KRV8E67VFP31YW3B04DRF49M.png', '2026-05-17 08:21:23', '2026-05-17 08:21:23');

-- Dumping structure for table foot_vibe.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table foot_vibe.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table foot_vibe.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table foot_vibe.jobs: ~0 rows (approximately)

-- Dumping structure for table foot_vibe.job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table foot_vibe.job_batches: ~0 rows (approximately)

-- Dumping structure for table foot_vibe.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table foot_vibe.migrations: ~16 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '0001_01_01_000001_create_cache_table', 1),
	(3, '0001_01_01_000002_create_jobs_table', 1),
	(4, '2026_05_16_180042_create_products_table', 1),
	(5, '2026_05_17_030459_add_profile_fields_to_users_table', 1),
	(6, '2026_05_17_034717_add_profile_photo_to_users_table', 1),
	(7, '2026_05_17_034957_create_orders_table', 1),
	(8, '2026_05_17_034958_create_order_items_table', 1),
	(9, '2026_05_17_041400_create_vouchers_table', 1),
	(10, '2026_05_17_041401_add_payment_and_voucher_to_orders_table', 1),
	(11, '2026_05_17_044424_add_shipping_cost_to_orders_table', 1),
	(12, '2026_05_17_051434_add_resi_and_address_to_orders_table', 1),
	(13, '2026_05_17_055504_create_carts_table', 1),
	(14, '2026_05_17_061518_create_categories_table', 1),
	(15, '2026_05_17_063110_update_category_and_product_tables', 1),
	(16, '2026_05_17_072115_add_images_to_products_table', 1),
	(17, '2026_05_17_091105_add_is_popular_to_products_table', 1),
	(18, '2026_05_17_133226_create_reviews_table', 1);

-- Dumping structure for table foot_vibe.orders
CREATE TABLE IF NOT EXISTS `orders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `order_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_amount` decimal(12,2) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'processing',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `proof_of_payment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `voucher_id` bigint unsigned DEFAULT NULL,
  `discount_amount` decimal(12,2) NOT NULL DEFAULT '0.00',
  `shipping_cost` decimal(12,2) NOT NULL DEFAULT '0.00',
  `tracking_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_address` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `orders_order_number_unique` (`order_number`),
  KEY `orders_user_id_foreign` (`user_id`),
  KEY `orders_voucher_id_foreign` (`voucher_id`),
  CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `orders_voucher_id_foreign` FOREIGN KEY (`voucher_id`) REFERENCES `vouchers` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table foot_vibe.orders: ~3 rows (approximately)
INSERT INTO `orders` (`id`, `user_id`, `order_number`, `total_amount`, `status`, `created_at`, `updated_at`, `proof_of_payment`, `voucher_id`, `discount_amount`, `shipping_cost`, `tracking_number`, `delivery_address`) VALUES
	(1, 2, '#FV-20260517-25DJP', 7045000.00, 'delivered', '2026-05-17 08:29:42', '2026-05-17 08:30:21', 'payments/DxdQyCoLZRQrE3EWfz6QeM3IxdZDwkAhkvDmxpR5.jpg', 1, 400000.00, 45000.00, 'CM94991389774', 'Jalan Pramuka No. 148, Purwokerto Selatan, Banyumas, Jawa Tengah'),
	(2, 2, '#FV-20260517-UQTF2', 14445000.00, 'delivered', '2026-05-17 09:30:44', '2026-05-17 09:31:11', 'payments/gbGvkKQi1n0Vuujq1C36ZdSgzxXmNXq35LoDTWky.jpg', 1, 400000.00, 45000.00, 'CM94991389123', 'Jalan Pramuka No. 148, Purwokerto Selatan, Banyumas, Jawa Tengah'),
	(3, 4, '#FV-20260531-CW6ZX', 9045000.00, 'delivered', '2026-05-31 04:27:03', '2026-05-31 04:28:05', 'payments/jzyuLbh661H5GQTKORJB7tMajJ5bmoKyGFOC99CU.jpg', 1, 400000.00, 45000.00, 'CM94991389774', 'jalan purwokerto indonesia');

-- Dumping structure for table foot_vibe.order_items
CREATE TABLE IF NOT EXISTS `order_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_items_order_id_foreign` (`order_id`),
  KEY `order_items_product_id_foreign` (`product_id`),
  CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table foot_vibe.order_items: ~3 rows (approximately)
INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`, `size`, `created_at`, `updated_at`) VALUES
	(1, 1, 2, 1, 7400000.00, '42', '2026-05-17 08:29:42', '2026-05-17 08:29:42'),
	(2, 2, 2, 2, 7400000.00, '42', '2026-05-17 09:30:44', '2026-05-17 09:30:44'),
	(3, 3, 1, 2, 4700000.00, '43', '2026-05-31 04:27:03', '2026-05-31 04:27:03');

-- Dumping structure for table foot_vibe.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table foot_vibe.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table foot_vibe.products
CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `price` decimal(10,2) NOT NULL,
  `original_price` decimal(10,2) DEFAULT NULL,
  `stock` int NOT NULL DEFAULT '0',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `images` json DEFAULT NULL,
  `sizes` json DEFAULT NULL,
  `is_popular` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `category_id` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `products_slug_unique` (`slug`),
  KEY `products_category_id_foreign` (`category_id`),
  CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table foot_vibe.products: ~7 rows (approximately)
INSERT INTO `products` (`id`, `name`, `slug`, `description`, `price`, `original_price`, `stock`, `image`, `images`, `sizes`, `is_popular`, `created_at`, `updated_at`, `category_id`) VALUES
	(1, 'Adidas EVO SL', 'adidas-evo-sl', '<h2><strong>Sepatu dengan inspirasi kecepatan yang didesain untuk budaya cepat.</strong></h2><p>Rasakan sensasi kecepatan dengan Adizero Evo SL. Terinspirasi oleh inovasi sepatu pemecah rekor dalam lini running Adizero—khususnya Pro Evo 1—Evo SL ini didesain untuk berlari maupun bergaya. Memadukan teknologi Adizero dengan estetika khas perlombaan yang mencolok dan unik, sepatu ini adalah evolusi kecepatan dalam semua aspek kehidupan. Lapisan foam LIGHTSTRIKE PRO yang responsif pada midsole memberikan kenyamanan dan bantalan untuk pengembalian energi yang optimal.&nbsp;</p>', 4700000.00, 4900000.00, 23, 'products/01KRV8KQJ2FZK1P2YPVZ8J9MCB.avif', '["products/01KRV8KQJ4SEXGDC3114JBH3E7.avif", "products/01KRV8KQJ7PWQXZS6WTVDTER8N.avif", "products/01KRV8KQJ9X424N4FD30WFV02B.avif", "products/01KRV8KQJCQAGXJ631KXT62Q57.avif"]', '"41,42,43,44,45,46,47"', 1, '2026-05-17 08:24:25', '2026-05-31 04:27:03', 1),
	(2, 'Puma Speedcat McLaren', 'puma-speedcat-mclaren', '<p>PUMAAA MEKLERENNNN NIHHH BOSSSS SENGGOLLLLLL DONGGGGGGGGGG!!!!!!!!!!!!!!!!!!!!!!</p>', 7400000.00, NULL, 7, 'products/01KRV8RK7QTY4HC503D67YZEA5.avif', '["products/01KRV8RK7TC8BM8FDJ4MET7JJZ.avif", "products/01KRV8RK7WJSKCXD5A9647ZG99.avif", "products/01KRV8RK8017W41DAG0S3932DT.avif", "products/01KRV8RK82HKVZ41C73ETW2GHV.avif", "products/01KRV8RK86D7Y7NT8A6PGRH2DH.avif", "products/01KRV8RK89GYXRHX4WTQQ1FX4G.avif"]', '"40,41,42,43,44,45"', 1, '2026-05-17 08:27:04', '2026-05-17 09:30:44', 3),
	(3, 'EIGER TIGERCLAW 2.5', 'eiger-tigerclaw-25', '<p>Saat hiking ringan dan beraktivitas sehari-hari, kamu bisa mengandalkan sepatu low-cut Tiger Claw 2.5. Sepatu low-cut dari EIGER Mountaineering ini memiliki teknologi heel support system yang berfungsi untuk menunjang kaki dengan menyangga pergelangan kaki agar tetap stabil saat berjalan. Tiger Claw 2.5 juga didukung dengan outsole berbahan rubber untuk cengkraman yang lebih baik. Bagian dalam sepatunya didukung dengan insole Ortholite® yang memberikan bantalan, breathable (memiliki daya evaporasi tinggi yang mampu menguapkan kelembapan sehingga cepat kering), dan ringan untuk menjaga kaki tetap nyaman. Dilengkapi juga dengan rubber toe protector yang berfungsi untuk perlindungan pada kaki bagian depan dari gesekan dan benturan.&nbsp;</p>', 724000.00, NULL, 50, 'products/01KRV96Z8EWYPWKCYHZ6E21Z20.jpg', '["products/01KRV96Z8JCAN9ERJ8DDRQ21YZ.jpg", "products/01KRV96Z8MC70KDHCT8D6E46P2.jpg", "products/01KRV96Z8QCS8TB1MV6Z3HBE4F.jpg", "products/01KRV96Z8TQS3VYFYX6ANRD5HR.jpg", "products/01KRV96Z8YC5FK6MVC9YEWGV0Z.jpg", "products/01KRV96Z91YBE58ARBCDXQ9EHZ.jpg", "products/01KRV96Z944QDH55C1NS2FWKYM.jpg"]', '"40,41,42,43,44,45,46"', 1, '2026-05-17 08:34:56', '2026-05-17 08:34:56', 7),
	(4, 'Nike Air Jordan 1 Mid', 'nike-air-jordan-1-mid', '<p>Inspired by the original AJ1, this mid-top edition maintains the iconic look you love while choice colours and crisp leather give it a distinct identity.</p><p>Benefits</p><ul><li>Leather, synthetic leather and textile upper for a supportive feel.</li><li>Foam midsole and Nike Air cushioning provide lightweight comfort.</li><li>Rubber outsole with pivot circle gives you durable traction.</li></ul><p>Product details</p><ul><li>Colour Shown: Black/Aura/White/Squadron Blue</li><li>Style: DQ8426-002</li><li>Country/Region of Origin: Indonesia</li></ul><p><br></p>', 1900000.00, 1939000.00, 37, 'products/01KS58TA9TZVCTJ03G445MEA1F.avif', '["products/01KS58TAAF2X313J4E0AN43K4G.avif", "products/01KS58TAAHFFCYYRRFH858ND0D.avif", "products/01KS58TAAMAKYPDAA3WTYNYP9X.avif", "products/01KS58TAAPQSP1RG45GN3J12FH.avif", "products/01KS58TAARSGCBHF289YDYS1FP.avif", "products/01KS58TAAV0R2ZCC2Z0PX40B7P.avif", "products/01KS58TAAZ0W88EEN65BT3RVRY.avif"]', '"41,42,43,44,45"', 1, '2026-05-21 05:40:25', '2026-05-21 05:40:45', 3),
	(5, 'Nike Calm Slide', 'nike-calm-slide', '<p>Enjoy a calm, comfortable experience—wherever your day off takes you. Made from soft yet supportive foam, the minimal design makes these slides easy to style with or without socks. And they\'ve got a textured footbed to help keep your feet in place.</p><p>Benefits</p><ul><li>Contoured design is made from a single piece of foam for a smooth, seamless feel.</li><li>Subtle texture pattern on the footbed adds grip even when wet.</li><li>Outer shell is made from water-friendly foam that is easy to clean.</li><li>Rubber outsole gives you excellent traction even on slippery surfaces.</li></ul><p>Product details</p><ul><li>Colour Shown: Black/Black</li><li>Style: FD4116-001</li><li>Country/Region of Origin: Indonesia</li></ul><p>&nbsp;</p>', 689000.00, 551200.00, 15, 'products/01KS5931SYF0DX517R18ZM8981.avif', '["products/01KS5931T2EMC3K5AQDH1FRGZ6.avif", "products/01KS5931T4JX7F3HGEBZ1WZ5FW.avif", "products/01KS5931T7NE7K86D9MD1XSWPX.avif", "products/01KS5931TAQDY3WST41G6K04YA.avif", "products/01KS5931TDBSMS04A1H4ATR68D.avif", "products/01KS5931TF43F0Q38PGZEP340V.avif", "products/01KS5931TJ0M27CHZZ03QXPYBT.avif"]', '"40,41,42,43,44,45"', 1, '2026-05-21 05:45:11', '2026-05-21 05:45:11', 2),
	(6, 'Mizuno Wave Rider 10', 'mizuno-wave-rider-10', '<p>Mizuno Wave Rider 10 Green</p><p>Sepatu Lari</p><p>Beri kesegaran tampilanmu dengan Mizuno Wave Rider 10 Green. Sepatu ini ringan, nyaman, dan dilengkapi midsole responsif untuk bantalan optimal, sementara desain breathable menjaga kaki tetap nyaman sepanjang hari. Jadikan sneakers ini bagian dari gaya aktifmu, hanya di JD Sports Indonesia.</p><p><br><strong>Warna:</strong><br>Green&nbsp;</p>', 2499000.00, 999200.00, 20, 'products/01KS598WDNBB32BX201351599E.jpg', '["products/01KS598WDQH4RHQY8PWFKJP2PH.jpg", "products/01KS598WDTZB44X62SZDNV2C4W.jpg", "products/01KS598WDXRH118EGHYG2SD081.jpg", "products/01KS598WE0N2S2S3PTQ0JHJ91C.jpg", "products/01KS598WE3YG7TA39XT5HRPYX0.jpg"]', '"41,42,43,44,45"', 1, '2026-05-21 05:48:22', '2026-05-21 05:48:22', 8),
	(7, 'Nappa Milano', 'nappa-milano', '<p>Details of brogues model on brush off leather material bring out the venerable side of classic. Time-honored, it hearkens back to an era of top hats. This specific style on color black will compete your classy outfits.</p><p>Material: Brush off Leather</p><p>Lining: Lambskin</p><p>Outsole: Fiber Rubber</p><p>Construction: Cementing with stitched outsole&nbsp;</p>', 889000.00, NULL, 25, 'products/01KS59CXFTNGA1N1T2XZRJ9GAK.webp', '["products/01KS59CXFXAPZC7DWH0D0HEFQM.webp", "products/01KS59CXFZ8BCAQ9G1HPF8H98P.webp", "products/01KS59CXG2P1ZAHJY4P5MTNWX0.webp", "products/01KS59CXG5Y5EPR04YDARH371W.webp", "products/01KS59CXG7GM7AKE2N4JCV9V8J.webp"]', '"41,42,43,44,45"', 1, '2026-05-21 05:50:35', '2026-05-21 05:50:35', 6);

-- Dumping structure for table foot_vibe.reviews
CREATE TABLE IF NOT EXISTS `reviews` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `rating` int NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reviews_user_id_foreign` (`user_id`),
  KEY `reviews_product_id_foreign` (`product_id`),
  CONSTRAINT `reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table foot_vibe.reviews: ~1 rows (approximately)
INSERT INTO `reviews` (`id`, `user_id`, `product_id`, `rating`, `comment`, `image`, `created_at`, `updated_at`) VALUES
	(1, 2, 2, 5, 'PUMA MEKLEREN GACOR BANGET EUYYY!!!!!!!!!!', 'reviews/EDNyELtuj7Ty59gHiS1wxXpNz8GjKDKMtxkkzdjd.jpg', '2026-05-17 08:31:42', '2026-05-17 08:31:42'),
	(2, 4, 1, 5, 'bagus sekali', 'reviews/3JSrmwrRSfiCjisoukzYSN34sKbQzO899EqKwpxf.jpg', '2026-05-31 05:02:02', '2026-05-31 05:02:02');

-- Dumping structure for table foot_vibe.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table foot_vibe.sessions: ~1 rows (approximately)
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('4VLUb6wNSQUKOoQSCMMO4ScCWsXvfhvKJhSMAU2l', 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiQ0tOZzFJaUsybzJkb0FtVzdnQTF4a0FOc3dqTHo5a3pBNmEzQjhSWiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyOToiaHR0cDovLzEyNy4wLjAuMTo4MDAwL3Byb2ZpbGUiO31zOjk6Il9wcmV2aW91cyI7YToyOntzOjM6InVybCI7czoyOToiaHR0cDovLzEyNy4wLjAuMTo4MDAwL3Byb2ZpbGUiO3M6NToicm91dGUiO3M6NzoicHJvZmlsZSI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjU7fQ==', 1780230024);

-- Dumping structure for table foot_vibe.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `profile_photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table foot_vibe.users: ~5 rows (approximately)
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `phone_number`, `date_of_birth`, `address`, `profile_photo`) VALUES
	(1, 'Admin FootVibe', 'admin@footvibe.com', NULL, '$2y$12$eAeOJ.2DLQI3Zt/hIoH4Wum1Ql9ePT83rqGedawM2TpqKQPcKZKdm', NULL, '2026-05-17 07:19:25', '2026-05-17 07:19:25', '082114232235', NULL, NULL, NULL),
	(2, 'Muhammad Deka Maulana', 'muhammaddeka115@gmail.com', '2026-05-17 07:21:38', '$2y$12$xgHVik3rVmCWB..plNrcEenu6Cmh7s5dLDlcZ2vUYf8PxihkA.Jfi', 'Cmyuj0tADOMgwBi0lYg6l5rTkPqoeh1VFcDBxriYPJydhveOdy2zxWLAQPIw', '2026-05-17 07:21:28', '2026-05-22 09:18:55', '082114232235', '2002-02-22', 'Jalan Pramuka No. 148, Purwokerto Selatan, Banyumas, Jawa Tengah', 'profile-photos/MuMMilKOmPehtSl9PmKl2rpfBepRHrS4jkLaPWbK.jpg'),
	(3, 'Najwa Humairah', '2311102134@ittelkom-pwt.ac.id', '2026-05-31 01:55:15', '$2y$12$tlJopy2iteXVEhVMq8NE0eExylS7JuAgq8ikcQQIU6FXKJxT5CCI2', NULL, '2026-05-31 01:54:08', '2026-05-31 01:55:15', NULL, NULL, NULL, NULL),
	(4, 'Deka Liebert', 'liebert@gmail.com', '2026-05-31 04:17:26', '$2y$12$4I8leIZbF06xRWmVC4oXOeIvs.mBUPYDumy9BMeJCsTR40rz.3WtC', NULL, '2026-05-31 04:17:16', '2026-05-31 05:19:24', '082114232235', '2002-06-11', 'jalan purwokerto indonesia', 'profile-photos/Is9jktFkxNFzKOdQBZcUjsU5g3uHb6ei8KQG3lEf.jpg'),
	(5, 'Super Deka', 'super@gmail.com', '2026-05-31 05:20:24', '$2y$12$sdOX85vbdz6EZ7xSkQrMPOdlFmywUjl2NX/N7ijTGk3boqeYVcNF.', NULL, '2026-05-31 05:20:11', '2026-05-31 05:20:24', NULL, NULL, NULL, NULL);

-- Dumping structure for table foot_vibe.vouchers
CREATE TABLE IF NOT EXISTS `vouchers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount_amount` decimal(12,2) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `vouchers_code_unique` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table foot_vibe.vouchers: ~1 rows (approximately)
INSERT INTO `vouchers` (`id`, `code`, `discount_amount`, `is_active`, `created_at`, `updated_at`) VALUES
	(1, 'DEKAGANTENG', 400000.00, 1, '2026-05-17 07:20:15', '2026-05-17 07:20:23');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
