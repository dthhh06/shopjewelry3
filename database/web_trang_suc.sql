-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3307
-- Thời gian đã tạo: Th12 05, 2025 lúc 07:38 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `web_trang_suc`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `isDeleted` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`id`, `name`, `isDeleted`) VALUES
(1, 'Nhẫn', 0),
(2, 'Vòng Cổ', 0),
(3, 'Trâm Cài', 1),
(4, 'Bông tai', 0),
(5, 'Vòng tay', 0);

--
-- Bẫy `category`
--
DELIMITER $$
CREATE TRIGGER `category_delete_create` BEFORE INSERT ON `category` FOR EACH ROW SET NEW.isDeleted = 0
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `content` varchar(255) DEFAULT NULL,
  `isDeleted` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `contact`
--

INSERT INTO `contact` (`id`, `fullname`, `email`, `phone_number`, `content`, `isDeleted`) VALUES
(1, 'Diệu Thảo', 'dieuthao1809206@gmail.com', '0347367621', 'Shop đóng hàng không kỹ, móp méo hộp đựng đồ', 0),
(2, 'Cẩm Hà', 'camha@gmail.com', '0888888888', 'Sản phẩm rất tuyệt vời, đúng như mong đợi, sẽ quay lại ủng hộ', 0),
(3, 'ltdt', 'dieuthaole06@gmail.com', '0777777777', 'Nhẫn rất đẹp', 0);

--
-- Bẫy `contact`
--
DELIMITER $$
CREATE TRIGGER `contact_delete_create` BEFORE INSERT ON `contact` FOR EACH ROW SET NEW.isDeleted = 0
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `title` text DEFAULT NULL,
  `thumbnail` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `gallery`
--

INSERT INTO `gallery` (`id`, `title`, `thumbnail`) VALUES
(7, 'Dây chuyền bạc Game Of Thrones x mặt hình rồng đính đá pha lê đỏ', '../assets/imgs/Dây Chuyền Bạc Game Of Thrones x Mặt Hình Rồng Đính Pha Lê Đỏ.png'),
(13, 'Nhẫn tình yêu', '../assets/imgs/Nhẫn tình yêu.png'),
(14, 'Nhẫn vàng cao cấp', '../assets/imgs/Nhẫn vàng cao cấp.png'),
(15, 'Nhẫn vòng ADV', '../assets/imgs/Nhẫn vòng ADV.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `import`
--

CREATE TABLE `import` (
  `id` int(11) NOT NULL,
  `total_import_order` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `isDeleted` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `import`
--

INSERT INTO `import` (`id`, `total_import_order`, `user_id`, `supplier_id`, `created_at`, `isDeleted`) VALUES
(1, 112000000, 3, 1, '2025-11-20', 0),
(2, 973500000, 1, 2, '2025-11-20', 0),
(3, 2147483647, 1, 4, '2025-12-01', 1),
(4, 1600000000, 1, 4, '2025-12-01', 0),
(5, NULL, 1, 4, '2025-12-01', 1),
(6, 1000000000, 1, 5, '2025-12-01', 0),
(7, 200000000, 3, 6, '2025-12-01', 1),
(8, 100000000, 3, 6, '2025-12-01', 0);

--
-- Bẫy `import`
--
DELIMITER $$
CREATE TRIGGER `import_delete_create` BEFORE INSERT ON `import` FOR EACH ROW SET NEW.isDeleted = 0
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `import_time_create` BEFORE INSERT ON `import` FOR EACH ROW SET NEW.created_at = CURRENT_DATE
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `importdetail`
--

CREATE TABLE `importdetail` (
  `import_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `total_price` int(11) DEFAULT NULL,
  `isDeleted` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `importdetail`
--

INSERT INTO `importdetail` (`import_id`, `product_id`, `amount`, `price`, `total_price`, `isDeleted`) VALUES
(1, 2, 10, 700000, 7000000, 0),
(1, 3, 100, 700000, 70000000, 0),
(1, 4, 50, 700000, 35000000, 0),
(2, 6, 200, 3540000, 708000000, 0),
(2, 3, 35, 3540000, 123900000, 0),
(2, 4, 40, 3540000, 141600000, 0),
(8, 29, 10, 10000000, 100000000, 0);

--
-- Bẫy `importdetail`
--
DELIMITER $$
CREATE TRIGGER `add_amount_to_product` AFTER INSERT ON `importdetail` FOR EACH ROW UPDATE `product`
  SET `quantity` = `quantity` + NEW.`amount`
  WHERE `id` = NEW.`product_id`
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `calculate_import_order` AFTER INSERT ON `importdetail` FOR EACH ROW UPDATE `import` 
  SET `total_import_order` = (
    SELECT SUM(`total_price`)
    FROM `importdetail`
    WHERE `import_id` = NEW.`import_id`
  )
  WHERE `id` = NEW.`import_id`
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `calculate_import_total_price` BEFORE INSERT ON `importdetail` FOR EACH ROW SET NEW.`total_price` = NEW.`amount` * NEW.`price`
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `import_detail_create` BEFORE INSERT ON `importdetail` FOR EACH ROW SET NEW.isDeleted = 0
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `momo_payments`
--

CREATE TABLE `momo_payments` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `request_id` varchar(50) NOT NULL,
  `order_info` varchar(255) DEFAULT NULL,
  `order_type` varchar(50) DEFAULT NULL,
  `trans_id` varchar(50) DEFAULT NULL,
  `pay_url` text DEFAULT NULL,
  `result_code` int(11) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `signature` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `momo_payments`
--

INSERT INTO `momo_payments` (`id`, `order_id`, `amount`, `request_id`, `order_info`, `order_type`, `trans_id`, `pay_url`, `result_code`, `message`, `signature`, `created_at`) VALUES
(1, 1764787713, 47540000, '1764787713', 'Thanh toán MoMo ATM', 'paid', '4622711413', 'https://test-payment.momo.vn/v2/gateway/pay?t=TU9NT3wxNzY0Nzg3NzEz&s=28f936df797f4c464d3f7ddb3f5cd97867b1735ab11999477cf120cd93b25e9f', 0, 'Successful.', '1d401dabc991722d18cc95c160ce21ea021e7435de0908e2913cad2fb706305d', '2025-12-03 18:48:34'),
(2, 1764788267, 47540000, '1764788267', 'Thanh toán MoMo ATM', 'atm', NULL, 'https://test-payment.momo.vn/v2/gateway/pay?t=TU9NT3wxNzY0Nzg4MjY3&s=ace28ea0e0b268c23d5fb82d448cc64a08f2f41abdbd473edaaf58723b92eab0', NULL, NULL, '1d24da3dfe5427e931936f75cc9aea3e344f8ff01395e7308afc6985114cc1bc', '2025-12-03 18:57:48'),
(3, 1764788268, 47540000, '1764788268', 'Thanh toán MoMo ATM', 'paid', '4622712530', 'https://test-payment.momo.vn/v2/gateway/pay?t=TU9NT3wxNzY0Nzg4MjY4&s=59e2adf657a9a6980c21c93bf5d91d1389a037487c40110a1e94f2d44b2ff661', 0, 'Successful.', '5ac6fc2f181b6c91778f9edddf5dda77e0d5d668059260f13e707d73f3f2b285', '2025-12-03 18:57:49'),
(4, 1764826625, 47540000, '1764826625', 'Thanh toán MoMo ATM', 'atm', NULL, 'https://test-payment.momo.vn/v2/gateway/pay?t=TU9NT3wxNzY0ODI2NjI1&s=c1a93a806d080be997b0cb673d4fe03e1af756397c6e0624725b457f3c28a2ea', NULL, NULL, '6ec89fc34eb35075a8fb817daf8b25db0cdc82ad5c02156a3b4c04d96f053d5e', '2025-12-04 05:37:07'),
(5, 1764836608, 95040000, '1764836608', 'Thanh toán MoMo ATM', 'atm', NULL, NULL, NULL, NULL, '8ae62744bf354ca53ebd0b0247e2982ac41488066717cdb1a69f9f24c94452fa', '2025-12-04 08:23:29'),
(6, 1764836640, 95040000, '1764836640', 'Thanh toán MoMo ATM', 'atm', NULL, NULL, NULL, NULL, '0caea44889d9d9c1b77f066f7f13cb5a4308de824fc2caaf22d0e2840cecc9db', '2025-12-04 08:24:01'),
(7, 1764836694, 47540000, '1764836694', 'Thanh toán MoMo ATM', 'atm', NULL, 'https://test-payment.momo.vn/v2/gateway/pay?t=TU9NT3wxNzY0ODM2Njk0&s=98f64fd72410b913e707d0da7ed783815c53c6008187e76a81a62ef2882664dc', NULL, NULL, '6b6bca49713e1f155791695ec8da5e5ae351828742bcda400858bc7a9a5434f0', '2025-12-04 08:24:55'),
(8, 1764836695, 47540000, '1764836695', 'Thanh toán MoMo ATM', 'failed', '1764836720109', 'https://test-payment.momo.vn/v2/gateway/pay?t=TU9NT3wxNzY0ODM2Njk1&s=8c3fd30b04f2101b5c0d10c4d20bb43ceb1232bc5db288cc5486a9df325404e0', 1006, 'Giao dịch bị từ chối bởi người dùng.', '458dc6ec7c39220a3047066dafb7c0f6fac021b2c40dc154c473522f22170ea7', '2025-12-04 08:24:55'),
(9, 1764850074, 47540000, '1764850074', 'Thanh toán MoMo ATM', 'paid', '4623090568', 'https://test-payment.momo.vn/v2/gateway/pay?t=TU9NT3wxNzY0ODUwMDc0&s=92435c325dd70e9d6965dface1a80e9659075301ba7c66188d80feb2385c5e21', 0, 'Successful.', 'e647c390ce50162ae17a87072ee6228ca18ddff1f6c316c862154bfa07d0c603', '2025-12-04 12:07:55'),
(10, 1764898913, 47540000, '1764898913', 'Thanh toán MoMo ATM', 'atm', NULL, 'https://test-payment.momo.vn/v2/gateway/pay?t=TU9NT3wxNzY0ODk4OTEz&s=4341a45c722871114719d49c4df68ceb73bc7968a0d8ba5fd66c38e0b74ee0b4', NULL, NULL, '18aa1b4d7462696733cba459c4f77a37a4fb973d7a178531bb289c9448bcf187', '2025-12-05 01:41:54'),
(11, 1764898914, 47540000, '1764898914', 'Thanh toán MoMo ATM', 'paid', '4623132594', 'https://test-payment.momo.vn/v2/gateway/pay?t=TU9NT3wxNzY0ODk4OTE0&s=c12f944c00a93885bdc3d12838c2bad7d3c175d2d1ca6d0bf3c31f5a0a030bb6', 0, 'Successful.', 'd5a03fec2094a616ca1a18ce8bffb43b20dae7030570a03be171a2129ee1f0c6', '2025-12-05 01:41:54'),
(12, 1764899319, 47540000, '1764899319', 'Thanh toán MoMo ATM', 'paid', '4623132707', 'https://test-payment.momo.vn/v2/gateway/pay?t=TU9NT3wxNzY0ODk5MzE5&s=abf8b3d2da79942e55f2a784df4c70deec62689557a00f4f6dc899113b9c9e6f', 0, 'Successful.', 'f8b346940457a05e09daf9c13297c823fffa07bf63292516e14e1ba983d7de3b', '2025-12-05 01:48:39'),
(13, 1764899697, 47540000, '1764899697', 'Thanh toán MoMo ATM', 'atm', NULL, 'https://test-payment.momo.vn/v2/gateway/pay?t=TU9NT3wxNzY0ODk5Njk3&s=56ac5148ef561557bbb53aaff33bd2104ba12c09f7ad35f6a8856d2c387f94b1', NULL, NULL, 'a453357484fcc3cd127c0da637c4c1db1bcf2f1d23e6b002ea871f4f3039fae2', '2025-12-05 01:54:58'),
(14, 1764899698, 47540000, '1764899698', 'Thanh toán MoMo ATM', 'atm', NULL, 'https://test-payment.momo.vn/v2/gateway/pay?t=TU9NT3wxNzY0ODk5Njk4&s=c36de1c0652bbb23d0239d7b6191469c37c0833877aa711ff133f4dfa6a7aa01', NULL, NULL, '0609ac0e2fdd28b29501b4bfaa91346a00da1a5c83b879b205b8522d64528ad1', '2025-12-05 01:54:58'),
(15, 1764899808, 47540000, '1764899808', 'Thanh toán MoMo ATM', 'atm', NULL, 'https://test-payment.momo.vn/v2/gateway/pay?t=TU9NT3wxNzY0ODk5ODA4&s=9251af2b2cf42ebe9861bbcd3c6a90d0bbca32b551883085ed12c7178883c557', NULL, NULL, '107447d4ea6b02158362afa3291c415f6fab7f66d18561b416bbcc33ce17f846', '2025-12-05 01:56:49'),
(16, 1764899809, 47540000, '1764899809', 'Thanh toán MoMo ATM', 'failed', '1764900186746', 'https://test-payment.momo.vn/v2/gateway/pay?t=TU9NT3wxNzY0ODk5ODA5&s=263f4b0a136157c93e8bf41cd82c36fed01a9ea70495a5b794019ee2e3fece4a', 1006, 'Giao dịch bị từ chối bởi người dùng.', '8a3bcc96e2e9f33370500c48cb244a52131603cea8f1e32b993232d6badd585b', '2025-12-05 01:56:50'),
(17, 1764900230, 47540000, '1764900230', 'Thanh toán MoMo ATM', 'atm', NULL, 'https://test-payment.momo.vn/v2/gateway/pay?t=TU9NT3wxNzY0OTAwMjMw&s=f3d7956afb043bc91823dfb68ae70172c44ec7c77b60de51b76f511c6e40a80e', NULL, NULL, '33b226e3bf9bfa39035315a55cf1a062d5c2b7acf47fdddecfd7b0e367ad8b14', '2025-12-05 02:03:51'),
(18, 1764900231, 47540000, '1764900231', 'Thanh toán MoMo ATM', 'paid', '4623123525', 'https://test-payment.momo.vn/v2/gateway/pay?t=TU9NT3wxNzY0OTAwMjMx&s=7606cd7b1c7c0b05233d105d22ab9b9e78073a9c9680fee6e071aaeb970387d8', 0, 'Successful.', '9e3a9529a6cc9e7a080959c8c36abae45123b25113e509e9831934c7cba4266a', '2025-12-05 02:03:52'),
(19, 1764900925, 45165000, '1764900925', 'Thanh toán MoMo ATM', 'atm', NULL, 'https://test-payment.momo.vn/v2/gateway/pay?t=TU9NT3wxNzY0OTAwOTI1&s=6fa63661f6c02cb921174a0a338185fc7824d915608ea0155dcb4b7af2de2926', NULL, NULL, '0657223d2b00fe782e42e92298be8485fdc18c7f0991e9b5cf04db0ae1b27d0b', '2025-12-05 02:15:26'),
(20, 1764900926, 45165000, '1764900926', 'Thanh toán MoMo ATM', 'paid', '4623113969', 'https://test-payment.momo.vn/v2/gateway/pay?t=TU9NT3wxNzY0OTAwOTI2&s=8a2f1e84546c5919450f42bf5f6c8adc0b9761c831c91e51a8d1431a851d1b9a', 0, 'Successful.', '6f94131d35373e6cba0c8469411b365f3d0e338244ece4adc0b831732f35388f', '2025-12-05 02:15:27'),
(21, 1764911925, 42908750, '1764911925', 'Thanh toán MoMo ATM', 'paid', '4623232458', 'https://test-payment.momo.vn/v2/gateway/pay?t=TU9NT3wxNzY0OTExOTI1&s=1172a6f8f938dfa73405424a051fed334b5ab1f3c8a6000c339a749b1ed3467d', 0, 'Successful.', '3eb38bcc431ab5c2bb577f30181a12c3dc7cd1ae8f50357dfcb1bb10b9078443', '2025-12-05 05:18:46'),
(22, 1764911926, 42908750, '1764911926', 'Thanh toán MoMo ATM', 'atm', NULL, 'https://test-payment.momo.vn/v2/gateway/pay?t=TU9NT3wxNzY0OTExOTI2&s=4c9496d15d44f44e1da26439d6040d7fb3ec103d484f2ee972f9cf28c0d2bd84', NULL, NULL, '4ab8dd377d6e4350cb0e0d6659595abe08f821614ed4300ee8b115adf9ef21b1', '2025-12-05 05:18:47');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  `order_date` date DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `total_money` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `payment_method` varchar(20) DEFAULT NULL,
  `trans_id` varchar(50) DEFAULT NULL,
  `isDeleted` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `order`
--

INSERT INTO `order` (`id`, `fullname`, `email`, `phone_number`, `address`, `note`, `order_date`, `status`, `total_money`, `user_id`, `payment_method`, `trans_id`, `isDeleted`) VALUES
(1, 'Diệu Thảo', 'dieuthao1809206@gmail.com', '0347367621', 'Lê Văn Hiến, Đà Nẵng', 'Che tên sản phẩm', '2025-11-20', 0, 670000, 1, NULL, NULL, 0),
(2, 'Mỹ Linh', 'mylinh1234@gmail.com', '0999999999', 'Hoà Nhơn, Đà Nẵng', 'Đóng gói sản phẩm cẩn thận', '2025-11-20', 0, 4400000, 2, NULL, NULL, 0),
(3, 'Cẩm Hà', 'camha@gmail.com', '0888888888', 'Thượng Đức, Đà Nẵng', 'Vận chuyển cẩn thận', '2025-11-20', 0, 2518000, 3, NULL, NULL, 0),
(4, 'ltdt', 'dieuthaole06@gmail.com', '0777777777', 'Hòa Khánh, Đà Nẵng', 'Che tên sản phẩm', '2025-11-20', 0, 10785000, 4, NULL, NULL, 0),
(5, 'ltdt', 'dieuthaole06@gmail.com', '0777777777', '420/30 , Lê Văn Hiến, Việt Nam', 'Đóng gói cẩn thận', '2025-11-30', 0, NULL, 4, NULL, NULL, 0),
(6, 'ltdt', 'dieuthaole06@gmail.com', '0777777777', '420/30 , Lê Văn Hiến, Việt Nam', 'ok', '2025-12-01', 0, 1570900, 4, NULL, NULL, 0),
(7, 'ltdt', 'dieuthaole06@gmail.com', '0777777777', '420/30 Lê Văn Hiến, Levanhien, Việt Nam', 'okk', '2025-12-03', 0, 475040000, 4, NULL, NULL, 1),
(8, 'ltdt', 'dieuthaole06@gmail.com', '0777777777', 'Đà Nẵng, Lê Văn Hiến, 420/30 ', 'okkkk', '2025-12-03', 0, 95040000, 4, NULL, NULL, 0),
(9, 'ltdt', 'dieuthaole06@gmail.com', '0777777777', 'Đà Nẵng, Lê Văn Hiến, 420/30 ', 'okkkk', '2025-12-03', 0, 95040000, 4, NULL, NULL, 1),
(10, 'ltdt', 'dieuthaole06@gmail.com', '0777777777', '420/30 ', 'okkkk', '2025-12-03', 0, 95040000, 4, NULL, NULL, 1),
(11, 'ltdt', 'dieuthaole06@gmail.com', '0777777777', '420/30 ', 'aaaa', '2025-12-03', 0, 95040000, 4, NULL, NULL, 1),
(12, 'ltdt', 'dieuthaole06@gmail.com', '0777777777', '420/30 ', 'aaaa', '2025-12-03', 0, 95040000, 4, NULL, NULL, 1),
(13, 'ltdt', 'dieuthaole06@gmail.com', '0777777777', '420/30', 'aaaaaaaaa', '2025-12-03', 0, 95040000, 4, NULL, NULL, 1),
(14, 'ltdt', 'dieuthaole06@gmail.com', '0777777777', '420/30', 'aaaaaaaaa', '2025-12-03', 0, 95040000, 4, NULL, NULL, 1),
(15, 'ltdt', 'dieuthaole06@gmail.com', '0777777777', '420/30 ', 'okkkkkk', '2025-12-03', 0, 95040000, 4, NULL, NULL, 1),
(16, 'ltdt', 'dieuthaole06@gmail.com', '0777777777', '420/30 ', 'okkkkkk', '2025-12-03', 0, 95040000, 4, NULL, NULL, 1),
(17, 'ltdt', 'dieuthaole06@gmail.com', '0777777777', '420/30 ', 'aaaaaaaa', '2025-12-03', 0, 47540000, 4, NULL, NULL, 1),
(18, 'ltdt', 'dieuthaole06@gmail.com', '0777777777', '420/30 ', 'aaaaaaaa', '2025-12-03', 0, 47540000, 4, NULL, NULL, 1),
(19, 'ltdt', 'dieuthaole06@gmail.com', '0777777777', '420/30 ', 'aaaaaaaa', '2025-12-03', 0, 47540000, 4, NULL, NULL, 1),
(20, 'ltdt', 'dieuthaole06@gmail.com', '0777777777', '420/30 ', 'aaaaaaaa', '2025-12-03', 0, 47540000, 4, NULL, NULL, 1),
(21, 'ltdt', 'dieuthaole06@gmail.com', '0777777777', '420/30 ', 'aaaaaaaa', '2025-12-03', 0, 47540000, 4, NULL, NULL, 1),
(22, 'dth', 'thao@gmail.com', '0987654321', '420/30 Lê Văn Hiến', 'aaaaaaaaa', '2025-12-03', 0, 31400000, 5, NULL, NULL, 0),
(23, 'dth', 'thao@gmail.com', '0987654321', '420/30 Lê Văn Hiến', 'aaaaaaaaa', '2025-12-03', 0, 31400000, 5, NULL, NULL, 0),
(24, 'dth', 'thao@gmail.com', '0987654321', '', '', '2025-12-05', 0, 47540000, 5, 'momo', '4623123525', 0),
(25, 'dth', 'thao@gmail.com', '0987654321', '420/30 Lê Văn Hiến, Levanhien, Việt Nam', 'aaaa', '2025-12-05', 0, 95040000, 5, 'cod', NULL, 0),
(26, 'dth', 'thao@gmail.com', '0987654321', '', '', '2025-12-05', 0, 45165000, 5, 'momo', '4623113969', 0),
(27, 'dth', 'thao@gmail.com', '0987654321', '420/30 Lê Văn Hiến, Levanhien, Việt Nam', 'ccc', '2025-12-05', 0, 42908750, 5, 'momo', '4623232458', 0);

--
-- Bẫy `order`
--
DELIMITER $$
CREATE TRIGGER `auto_set_order_status` BEFORE INSERT ON `order` FOR EACH ROW SET NEW.status = 0
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `order_delete_create` BEFORE INSERT ON `order` FOR EACH ROW SET NEW.isDeleted = 0
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `order_time_create` BEFORE INSERT ON `order` FOR EACH ROW SET NEW.order_date = CURRENT_DATE
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orderdetail`
--

CREATE TABLE `orderdetail` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `num` int(11) DEFAULT NULL,
  `total_money` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `orderdetail`
--

INSERT INTO `orderdetail` (`id`, `order_id`, `product_id`, `price`, `num`, `total_money`) VALUES
(1, 1, 1, 315000, 2, 630000),
(2, 2, 2, 665000, 2, 1330000),
(3, 3, 3, 609000, 2, 1218000),
(4, 3, 4, 630000, 2, 1260000),
(5, 4, 4, 630000, 2, 1260000),
(6, 4, 2, 665000, 10, 6650000),
(7, 4, 1, 315000, 2, 630000),
(8, 4, 1, 315000, 7, 2205000),
(9, 2, 10, 870000, 1, 870000),
(10, 2, 6, 720000, 3, 2160000),
(11, 5, 2, 631750, 2, NULL),
(12, 6, 4, 510300, 3, 1530900),
(13, 7, 6, 475000000, 1, 475000000),
(14, 8, 7, 47500000, 2, 95000000),
(15, 9, 7, 45125000, 2, 95000000),
(16, 10, 7, 42868750, 2, 95000000),
(17, 11, 7, 40725313, 2, 95000000),
(18, 12, 7, 38689047, 2, 95000000),
(19, 13, 7, 36754595, 2, 95000000),
(20, 14, 7, 34916865, 2, 95000000),
(21, 15, 7, 33171022, 2, 95000000),
(22, 16, 7, 31512471, 2, 95000000),
(23, 17, 7, 29936847, 1, 47500000),
(24, 18, 7, 28440005, 1, 47500000),
(25, 19, 7, 27018005, 1, 47500000),
(26, 20, 7, 27018005, 1, 47500000),
(27, 21, 7, 27018005, 1, 47500000),
(28, 22, 12, 31360000, 1, 31360000),
(29, 23, 12, 30732800, 1, 31360000),
(30, 24, 2, 47500000, 1, 47500000),
(31, 25, 3, 95000000, 1, 95000000),
(32, 26, 2, 45125000, 1, 45125000),
(33, 27, 2, 42868750, 1, 42868750);

--
-- Bẫy `orderdetail`
--
DELIMITER $$
CREATE TRIGGER `auto_minus_quantity_product` AFTER INSERT ON `orderdetail` FOR EACH ROW BEGIN
  IF (SELECT `quantity` FROM `product` WHERE `id` = NEW.`product_id`) >= NEW.`num` THEN
    UPDATE `product` 
    SET `quantity` = `quantity` - NEW.`num` 
    WHERE `id` = NEW.`product_id`;
  END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `calculate_total_money_orderdetail` BEFORE INSERT ON `orderdetail` FOR EACH ROW SET NEW.`total_money` = NEW.`price` * NEW.`num`
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `calculate_total_order` AFTER INSERT ON `orderdetail` FOR EACH ROW UPDATE `order`
  SET `total_money` = (
    SELECT SUM(`total_money`)
    FROM `orderdetail`
    WHERE `orderdetail`.`order_id` = NEW.`order_id`
    GROUP BY `orderdetail`.`order_id`
  ) + 40000
  WHERE `id` = NEW.`order_id`
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `get_product_price` BEFORE INSERT ON `orderdetail` FOR EACH ROW SET NEW.`price` = (
    SELECT `price` 
    FROM `product` 
    WHERE NEW.`product_id` = `product`.`id`
  )
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `permission`
--

CREATE TABLE `permission` (
  `id` int(11) NOT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `permission`
--

INSERT INTO `permission` (`id`, `description`) VALUES
(1, 'Add users'),
(2, 'Edit users'),
(3, 'Delete users'),
(4, 'See users'),
(5, 'Add categories'),
(6, 'Edit categories'),
(7, 'Delete categories'),
(8, 'See categories'),
(9, 'Add roles'),
(10, 'Edit roles'),
(11, 'Delete roles'),
(12, 'See roles'),
(13, 'Add products'),
(14, 'Edit products'),
(15, 'Delete products'),
(16, 'See products'),
(17, 'Solve orders'),
(18, 'Delete orders'),
(19, 'See orders'),
(20, 'Add galleries'),
(21, 'Edit galleries'),
(22, 'Delete galleries'),
(23, 'See galleries'),
(24, 'Solve contacts'),
(25, 'Delete contacts'),
(26, 'See contacts'),
(27, 'Add imports'),
(28, 'Edit imports'),
(29, 'Delete imports'),
(30, 'See imports'),
(31, 'Edit permissions'),
(32, 'See permissions'),
(33, 'See statistics');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `discount` int(11) DEFAULT NULL,
  `thumbnail` varchar(500) DEFAULT NULL,
  `image1` varchar(500) DEFAULT NULL,
  `image2` varchar(500) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `deleted` int(11) DEFAULT NULL,
  `isShow` int(11) DEFAULT 1,
  `isOutstanding` int(11) DEFAULT 1,
  `isNew` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`id`, `title`, `price`, `category_id`, `discount`, `thumbnail`, `image1`, `image2`, `description`, `quantity`, `created_at`, `updated_at`, `deleted`, `isShow`, `isOutstanding`, `isNew`) VALUES
(1, 'Bông tai cao cấp Biz', 229635, 4, 10, '../assets/imgs/1764691895_bt3.1.jpg', '../assets/imgs/1764691895_1_bt3.2.jpg', '../assets/imgs/1764691895_2_bt3.jpg', 'Sản phẩm này rất đẹp', 0, '2025-11-20', '2025-12-02', 0, 1, 1, 1),
(2, ' Bông tai ngọc trai', 40725313, 4, 5, '../assets/imgs/1764694240_bt1.2.jpg', '../assets/imgs/1764694240_1_bt1.3.jpg', '../assets/imgs/1764694240_2_bt1.jpg', 'Sản phẩm hot nhất hiện nay', 5, '2025-11-20', '2025-12-05', 0, 1, 1, 1),
(3, 'Bông tai Louis Vuitton', 90250000, 4, 5, '../assets/imgs/1764694303_btLV.jpg', '../assets/imgs/1764694303_1_btLV1.jpg', '../assets/imgs/1764694303_2_btLV2.jpg', 'Sản phẩm hot nhất hiện nay', 49, '2025-11-20', '2025-12-05', 0, 1, 1, 1),
(4, 'Dây chuyền Cartier', 67900000, 2, 3, '../assets/imgs/1764694359_Dc_cartier.jpg', '../assets/imgs/1764694359_1_Dc_cartier1.jpg', '../assets/imgs/1764694359_2_Dc_cartier2.jpg', 'Sản phẩm hot nhất hiện nay', 50, '2025-11-20', '2025-12-02', 0, 1, 1, 1),
(5, 'Dây chuyền ngọc trai', 114000000, 2, 5, '../assets/imgs/1764694403_DCngoctrai.jpg', '../assets/imgs/1764694403_1_dcngoctrai.webp', '../assets/imgs/1764694403_2_dcngoctrai1.jpg', 'Sản phẩm hot nhất hiện nay', 50, '2025-11-20', '2025-12-02', 0, 1, 1, 1),
(6, 'Dây chuyền Tiffany & ', 451250000, 2, 5, '../assets/imgs/1764694560_dctiffanico.jpg', '../assets/imgs/1764694560_1_dctiffanico1.jpg', '../assets/imgs/1764694560_2_dctiffanico2.jpg', 'Dây chuyền thiết kế tinh xảo đến từ nhà model Tiffany & Co', 49, '2025-11-20', '2025-12-03', 0, 1, 1, 1),
(7, 'Lắc tay vàng', 25667105, 5, 5, '../assets/imgs/1764694825_lt2.3.jpg', '', '', 'Một chiếc lắc tay basic', 20, '2025-11-20', '2025-12-03', 0, 1, 1, 1),
(8, 'Lắc tay cỏ 4 lá ', 60000000, 5, 0, '../assets/imgs/1764694892_lt3..jpg', '../assets/imgs/1764694892_1_lt3.2.jpg', '../assets/imgs/1764694892_2_lt3.jpg', 'Lắc tay cỏ 4 lá', 20, '2025-11-20', '2025-12-03', 0, 1, 1, 1),
(9, 'Lắc tay vàng khắc tên', 98000000, 5, 2, '../assets/imgs/1764694948_lt4.1.webp', '../assets/imgs/1764694948_1_lt4.2.webp', '../assets/imgs/1764694948_2_lt4.webp', 'Lắc tay khắc tên', 20, '2025-11-20', '2025-12-03', 0, 1, 1, 1),
(10, 'Lắc tay đồng xu', 82650000, 5, 5, '../assets/imgs/1764695041_lt5.1.webp', '../assets/imgs/1764695041_1_lt5.2.webp', '../assets/imgs/1764695041_2_lt5.webp', 'Một thiết kế tinh xảo ', 10, '2025-11-20', '2025-12-03', 0, 1, 1, 1),
(11, 'Lắc tay Cartier', 60000000, 5, 0, '../assets/imgs/1764695172_lt7.1.jpg', '../assets/imgs/1764695172_1_lt7.2.jpg', '../assets/imgs/1764695172_2_lt7.jpg', 'Thiết kế xa xỉ đến từ Cartier', 10, '2025-11-20', '2025-12-03', 0, 1, 1, 1),
(12, 'Dây chuyền mặt trăng', 30118144, 2, 2, '../assets/imgs/1764695108_lt6.1.webp', '../assets/imgs/1764695108_1_lt6.webp', '../assets/imgs/1764695108_2_lt62.webp', 'Thiết kế nhỏ nhỏ xinh xinh', 18, '2025-11-20', '2025-12-03', 0, 1, 1, 1),
(13, 'Dây chuyền ba sợi', 45000000, 2, 10, '../assets/imgs/1764695978_vc1.2.jpg', '../assets/imgs/1764695978_1_vc1.3.jpg', '../assets/imgs/1764695978_2_vc1.jpg', 'Đây là một sợi dây chuyền có giá trị cao', 0, '2025-11-20', '2025-12-03', 0, 1, 1, 1),
(14, 'Lắc tay đính kim cương', 686000000, 5, 2, '../assets/imgs/1764695282_lt8.jpg', '../assets/imgs/1764695282_1_lt8.1.jpg', '../assets/imgs/1764695282_2_lt8.3.jpg', 'Lắc tay full kim cương biểu tượng của sự xa xỉ', 5, '2025-11-20', '2025-12-03', 0, 1, 1, 1),
(15, 'Nhẫn vàng đính kim cương', 490000000, 1, 2, '../assets/imgs/1764695353_n2.1.jpg', '../assets/imgs/1764695353_1_n2.2.jpg', '../assets/imgs/1764695353_2_N2.jpg', 'Nhẫn vàng kiểu đính kim cương ở giữa làm điểm nhấn ', 5, '2025-11-20', '2025-12-03', 0, 1, 1, 1),
(16, 'Nhẫn kim cương kiểu', 70000000, 1, 0, '../assets/imgs/1764695445_n3.1.jpg', '../assets/imgs/1764695445_1_n3.2.jpg', '../assets/imgs/1764695445_2_N3.jpg', 'Nhẫn kim cương với thiết kế uốn lượn tinh xảo', 20, '2025-11-20', '2025-12-03', 0, 1, 1, 1),
(17, 'Nhẫn chiếc lá', 90000000, 1, 0, '../assets/imgs/1764695524_n4.2.jpg', '../assets/imgs/1764695524_1_n4.3.jpg', '../assets/imgs/1764695524_2_n4.jpg', 'Thiết kế tạo điểm nhấn bởi những chiếc lá', 20, '2025-11-20', '2025-12-03', 0, 1, 1, 1),
(18, 'Nhẫn vàng Ý', 60000000, 1, 0, '../assets/imgs/1764695595_nhan2.jpg', '../assets/imgs/1764695595_1_nhan2.2.jpg', '../assets/imgs/1764695595_2_N2.jpg', 'Nhẫn kiểu ', 20, '2025-11-20', '2025-12-03', 0, 1, 1, 1),
(19, 'Dây chuyền kim cương Dior', 1000000000, 2, 0, '../assets/imgs/1764695668_vc3.webp', '../assets/imgs/1764695668_1_vc3.2.webp', '../assets/imgs/1764695668_2_vc3.1.webp', 'Một thiết kế cực kì kì công đến từ nhà model Dior', 3, '2025-11-20', '2025-12-03', 0, 1, 1, 1),
(29, 'Vòng tay Dior', 13835522, 5, 2, '../assets/imgs/1764581142_lactaydior.jpg', '../assets/imgs/1764581142_1_lactaydior1.jpg', '../assets/imgs/1764581142_2_lactaydior2.jpg', 'Lắc tay xinh xinh', 10, '2025-12-01', '2025-12-02', 0, 1, 1, 1);

--
-- Bẫy `product`
--
DELIMITER $$
CREATE TRIGGER `calculate_product_price` BEFORE INSERT ON `product` FOR EACH ROW SET NEW.`price` = NEW.`price` - ((NEW.`price` * NEW.`discount`) / 100)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `product_delete_create` BEFORE INSERT ON `product` FOR EACH ROW SET NEW.deleted = 0
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `product_time_create` BEFORE INSERT ON `product` FOR EACH ROW SET NEW.created_at = CURRENT_DATE
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `product_time_update` BEFORE UPDATE ON `product` FOR EACH ROW SET NEW.updated_at = CURRENT_DATE
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `set_default_product_quantity` BEFORE INSERT ON `product` FOR EACH ROW SET NEW.`quantity` = 0
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_product_price` BEFORE UPDATE ON `product` FOR EACH ROW SET NEW.`price` = NEW.`price` - ((NEW.`price` * NEW.`discount`) / 100)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `isDeleted` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `role`
--

INSERT INTO `role` (`id`, `name`, `isDeleted`) VALUES
(1, 'Quản lý', 0),
(2, 'Nhân viên', 0),
(3, 'Khách hàng', 0),
(4, 'Admin', 0);

--
-- Bẫy `role`
--
DELIMITER $$
CREATE TRIGGER `after_insert_row` AFTER INSERT ON `role` FOR EACH ROW INSERT INTO `role_permission` (`role_id`, `permission_id`) VALUES 
  (NEW.id, 1), (NEW.id, 2), (NEW.id, 3), (NEW.id, 4), (NEW.id, 5),
  (NEW.id, 6), (NEW.id, 7), (NEW.id, 8), (NEW.id, 9), (NEW.id, 10),
  (NEW.id, 11), (NEW.id, 12), (NEW.id, 13), (NEW.id, 14), (NEW.id, 15),
  (NEW.id, 16), (NEW.id, 17), (NEW.id, 18), (NEW.id, 19), (NEW.id, 20),
  (NEW.id, 21), (NEW.id, 22), (NEW.id, 23), (NEW.id, 24), (NEW.id, 25), 
  (NEW.id, 26), (NEW.id, 27), (NEW.id, 28), (NEW.id, 29), (NEW.id, 30), 
  (NEW.id, 31), (NEW.id, 32), (NEW.id, 33)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `role_delete_create` BEFORE INSERT ON `role` FOR EACH ROW SET NEW.isDeleted = 0
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `role_permission`
--

CREATE TABLE `role_permission` (
  `id` int(11) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `permission_id` int(11) DEFAULT NULL,
  `isAllowed` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `role_permission`
--

INSERT INTO `role_permission` (`id`, `role_id`, `permission_id`, `isAllowed`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 1),
(3, 1, 3, 1),
(4, 1, 4, 1),
(5, 1, 5, 1),
(6, 1, 6, 1),
(7, 1, 7, 1),
(8, 1, 8, 1),
(9, 1, 9, 1),
(10, 1, 10, 1),
(11, 1, 11, 1),
(12, 1, 12, 1),
(13, 1, 13, 1),
(14, 1, 14, 1),
(15, 1, 15, 1),
(16, 1, 16, 1),
(17, 1, 17, 1),
(18, 1, 18, 1),
(19, 1, 19, 1),
(20, 1, 20, 1),
(21, 1, 21, 1),
(22, 1, 22, 1),
(23, 1, 23, 1),
(24, 1, 24, 1),
(25, 1, 25, 1),
(26, 1, 26, 1),
(27, 1, 27, 1),
(28, 1, 28, 1),
(29, 1, 29, 1),
(30, 1, 30, 1),
(31, 1, 31, 1),
(32, 1, 32, 1),
(33, 1, 33, 1),
(34, 2, 1, 1),
(35, 2, 2, 1),
(36, 2, 3, 1),
(37, 2, 4, 1),
(38, 2, 5, 1),
(39, 2, 6, 1),
(40, 2, 7, 1),
(41, 2, 8, 1),
(42, 2, 9, 1),
(43, 2, 10, 1),
(44, 2, 11, 1),
(45, 2, 12, 1),
(46, 2, 13, 1),
(47, 2, 14, 1),
(48, 2, 15, 1),
(49, 2, 16, 1),
(50, 2, 17, 1),
(51, 2, 18, 1),
(52, 2, 19, 1),
(53, 2, 20, 1),
(54, 2, 21, 1),
(55, 2, 22, 1),
(56, 2, 23, 1),
(57, 2, 24, 1),
(58, 2, 25, 1),
(59, 2, 26, 1),
(60, 2, 27, 1),
(61, 2, 28, 1),
(62, 2, 29, 1),
(63, 2, 30, 1),
(64, 2, 31, 1),
(65, 2, 32, 1),
(66, 2, 33, 1),
(67, 3, 1, 0),
(68, 3, 2, 0),
(69, 3, 3, 0),
(70, 3, 4, 0),
(71, 3, 5, 0),
(72, 3, 6, 0),
(73, 3, 7, 0),
(74, 3, 8, 0),
(75, 3, 9, 0),
(76, 3, 10, 0),
(77, 3, 11, 0),
(78, 3, 12, 0),
(79, 3, 13, 0),
(80, 3, 14, 0),
(81, 3, 15, 0),
(82, 3, 16, 0),
(83, 3, 17, 0),
(84, 3, 18, 0),
(85, 3, 19, 0),
(86, 3, 20, 0),
(87, 3, 21, 0),
(88, 3, 22, 0),
(89, 3, 23, 1),
(90, 3, 24, 1),
(91, 3, 25, 1),
(92, 3, 26, 1),
(93, 3, 27, 1),
(94, 3, 28, 1),
(95, 3, 29, 1),
(96, 3, 30, 1),
(97, 3, 31, 1),
(98, 3, 32, 1),
(99, 3, 33, 1),
(100, 4, 1, 1),
(101, 4, 2, 1),
(102, 4, 3, 1),
(103, 4, 4, 1),
(104, 4, 5, 1),
(105, 4, 6, 1),
(106, 4, 7, 1),
(107, 4, 8, 1),
(108, 4, 9, 1),
(109, 4, 10, 1),
(110, 4, 11, 1),
(111, 4, 12, 1),
(112, 4, 13, 1),
(113, 4, 14, 1),
(114, 4, 15, 1),
(115, 4, 16, 1),
(116, 4, 17, 1),
(117, 4, 18, 1),
(118, 4, 19, 1),
(119, 4, 20, 1),
(120, 4, 21, 1),
(121, 4, 22, 1),
(122, 4, 23, 1),
(123, 4, 24, 1),
(124, 4, 25, 1),
(125, 4, 26, 1),
(126, 4, 27, 1),
(127, 4, 28, 1),
(128, 4, 29, 1),
(129, 4, 30, 1),
(130, 4, 31, 1),
(131, 4, 32, 1),
(132, 4, 33, 1);

--
-- Bẫy `role_permission`
--
DELIMITER $$
CREATE TRIGGER `role_permission_create_allow` BEFORE INSERT ON `role_permission` FOR EACH ROW SET NEW.isAllowed = 0
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `isDeleted` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `supplier`
--

INSERT INTO `supplier` (`id`, `name`, `address`, `contact`, `isDeleted`) VALUES
(1, 'DOJI', '396 Nguyễn Chí Thanh, P. 16, Quận 3', '0653322489', 0),
(2, 'PNG', '466 Hai Bà Trưng, P. Tân Định, Quận 1', '02846203198', 0),
(3, 'SJC', '418 - 420 Nguyễn Thị Minh Khai, Phường 5, Quận 3', '02835356561', 0),
(4, 'Tiffany & Co', '123 Trần Đại Nghĩa, Đà Nẵng', '0213456678', 0),
(5, 'Cartier', '567 Lê Văn Hiến', '0998765432', 0),
(6, 'Dior', '888 Nguyễn Văn Linh-Đà Nẵng', '099987654', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `deleted` int(11) DEFAULT NULL,
  `reset_token` varchar(255) DEFAULT NULL,
  `token_expiry` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`id`, `fullname`, `email`, `phone_number`, `password`, `role_id`, `created_at`, `updated_at`, `deleted`, `reset_token`, `token_expiry`) VALUES
(1, 'Diệu Thảo', 'dieuthao1809206@gmail.com', '0347367621', '$2a$12$L4AwLzAJb662zW1CD/tpHOVRnFIYQbj2q8rd.fdTrOk9Ccq0S7H82', 1, '2025-11-20', NULL, 0, NULL, NULL),
(2, 'Mỹ Linh', 'mylinh1234@gmail.com', '0999999999', '$2a$12$PPskDJkYOV/7EYk.W0/DGeeho0l69iOa1heL7x/2aO27X4VgNpRMS', 3, '2025-11-20', NULL, 0, NULL, NULL),
(3, 'Cẩm Hà', 'camha@gmail.com', '0888888888', '$2a$12$vpRbjSQCAOpjP7lg0NOrmOs9vzPF67GTjrC1AddtCea60HtuWloJK', 2, '2025-11-20', NULL, 0, NULL, NULL),
(4, 'ltdt', 'dieuthaole06@gmail.com', '0777777777', '$2a$12$vpRbjSQCAOpjP7lg0NOrmOs9vzPF67GTjrC1AddtCea60HtuWloJK', 3, '2025-11-20', NULL, 0, NULL, NULL),
(5, 'dth', 'thao@gmail.com', '0987654321', '$2y$10$fFuAwRxTuKvjvBWQS/S2l.VuU9J8YST7RVdgboZb6oTOlW6YTngl6', 3, '2025-12-03', NULL, 0, NULL, NULL);

--
-- Bẫy `user`
--
DELIMITER $$
CREATE TRIGGER `create_expiry_time` BEFORE UPDATE ON `user` FOR EACH ROW SET NEW.`token_expiry` = DATE_ADD(NOW(), INTERVAL 2 MINUTE)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `user_delete_create` BEFORE INSERT ON `user` FOR EACH ROW SET NEW.deleted = 0
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `user_time_create` BEFORE INSERT ON `user` FOR EACH ROW SET NEW.created_at = CURRENT_DATE
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `user_time_update` BEFORE UPDATE ON `user` FOR EACH ROW SET NEW.updated_at = CURRENT_DATE
$$
DELIMITER ;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `import`
--
ALTER TABLE `import`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Chỉ mục cho bảng `importdetail`
--
ALTER TABLE `importdetail`
  ADD KEY `product_id` (`product_id`),
  ADD KEY `import_id` (`import_id`);

--
-- Chỉ mục cho bảng `momo_payments`
--
ALTER TABLE `momo_payments`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Chỉ mục cho bảng `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `role_permission`
--
ALTER TABLE `role_permission`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permission_id` (`permission_id`),
  ADD KEY `role_id` (`role_id`);

--
-- Chỉ mục cho bảng `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `import`
--
ALTER TABLE `import`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `momo_payments`
--
ALTER TABLE `momo_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT cho bảng `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT cho bảng `orderdetail`
--
ALTER TABLE `orderdetail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT cho bảng `permission`
--
ALTER TABLE `permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT cho bảng `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `role_permission`
--
ALTER TABLE `role_permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT cho bảng `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `import`
--
ALTER TABLE `import`
  ADD CONSTRAINT `import_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `import_ibfk_2` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`);

--
-- Các ràng buộc cho bảng `importdetail`
--
ALTER TABLE `importdetail`
  ADD CONSTRAINT `importdetail_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `importdetail_ibfk_2` FOREIGN KEY (`import_id`) REFERENCES `import` (`id`);

--
-- Các ràng buộc cho bảng `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Các ràng buộc cho bảng `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD CONSTRAINT `orderdetail_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`),
  ADD CONSTRAINT `orderdetail_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Các ràng buộc cho bảng `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

--
-- Các ràng buộc cho bảng `role_permission`
--
ALTER TABLE `role_permission`
  ADD CONSTRAINT `role_permission_ibfk_1` FOREIGN KEY (`permission_id`) REFERENCES `permission` (`id`),
  ADD CONSTRAINT `role_permission_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);

--
-- Các ràng buộc cho bảng `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
