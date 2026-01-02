-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3307
-- Thời gian đã tạo: Th1 02, 2026 lúc 03:58 PM
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
(4, 'Bông tai', 0),
(5, 'Vòng tay', 0),
(6, 'Tiara', 1);

--
-- Bẫy `category`
--
DELIMITER $$
CREATE TRIGGER `category_delete_create` BEFORE INSERT ON `category` FOR EACH ROW SET NEW.isDeleted = 0
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `rating` int(1) NOT NULL DEFAULT 5,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `comments`
--

INSERT INTO `comments` (`id`, `product_id`, `user_id`, `fullname`, `comment`, `rating`, `created_at`) VALUES
(1, 2, 0, 'dth', 'Bông tai này rất xinh', 5, '2025-12-11 23:51:47'),
(0, 0, 5, 'dth', 'ok', 5, '2025-12-31 02:55:57'),
(0, 0, 5, 'dth', 'Giao hàng hơi lâu nha', 4, '2025-12-31 02:56:34');

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
(1, 'Diệu Thảo', 'dieuthao1809206@gmail.com', '0347367621', 'Tôi đã mua nhẫn cưới tại Arelia và phải nói rằng dịch vụ ở đây quá tuyệt vời. Nhân viên tư vấn rất nhiệt tình và am hiểu, giúp vợ chồng tôi chọn được chiếc nhẫn hoàn hảo, đúng ý mà không hề cảm thấy áp lực.', 0),
(2, 'Cẩm Hà', 'camha@gmail.com', '0888888888', 'Sản phẩm rất tuyệt vời, đúng như mong đợi, sẽ quay lại ủng hộChiếc vòng cổ tôi mua tại Arelia đã đeo hơn một năm mà vẫn sáng bóng như mới. Trang sức rất chắc chắn và tinh xảo, xứng đáng với giá tiền và sự tin tưởng tuyệt đối của tôi.', 0),
(3, 'ltdt', 'dieuthaole06@gmail.com', '0777777777', 'Mỗi lần ghé thăm Arelia đều là một trải nghiệm đáng nhớ vì không gian đẹp và mẫu mã quá đa dạng. Tôi chắc chắn sẽ giới thiệu Arelia cho bạn bè và người thân khi họ cần mua trang sức cao cấp.', 0),
(4, 'Mỹ Linh', 'linh@gmail.com', '0129837645', 'Trang sức tại Arelia rất tinh tế và sang trọng. Tôi rất hài lòng vì được nhân viên tư vấn nhiệt tình, giúp tôi chọn được món quà ý nghĩa nhất.', 0);

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
  `product_id` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `sort_order` int(11) DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(7, 200000000, 3, 6, '2025-12-01', 1),
(8, 100000000, 3, 6, '2025-12-01', 0),
(9, 3000000, 1, 7, '2026-01-02', 0),
(10, 10000000, 1, 7, '2026-01-02', 0);

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
(8, 29, 10, 10000000, 100000000, 0),
(9, 30, 10, 300000, 3000000, 0),
(10, 32, 20, 500000, 10000000, 0);

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
(22, 1764911926, 42908750, '1764911926', 'Thanh toán MoMo ATM', 'atm', NULL, 'https://test-payment.momo.vn/v2/gateway/pay?t=TU9NT3wxNzY0OTExOTI2&s=4c9496d15d44f44e1da26439d6040d7fb3ec103d484f2ee972f9cf28c0d2bd84', NULL, NULL, '4ab8dd377d6e4350cb0e0d6659595abe08f821614ed4300ee8b115adf9ef21b1', '2025-12-05 05:18:47'),
(23, 1764948436, 40765313, '1764948436', 'Thanh toán MoMo ATM', 'atm', NULL, 'https://test-payment.momo.vn/v2/gateway/pay?t=TU9NT3wxNzY0OTQ4NDM2&s=490e78636d4383ec7f49a04ffd9063677b3859ea60292fe82349a62577039073', NULL, NULL, '27ccf815aa5bdb07169e53011a12f9fe4c966d68e659b6c066a6172b3116f8f6', '2025-12-05 15:27:17'),
(24, 1764948437, 40765313, '1764948437', 'Thanh toán MoMo ATM', 'paid', '4623559786', 'https://test-payment.momo.vn/v2/gateway/pay?t=TU9NT3wxNzY0OTQ4NDM3&s=1a1d94e9c4181689625017100450de7a11bb9ebde8614de4a2ad330060aa0cfc', 0, 'Successful.', '0dabcae7a2374892e5fe9c1377eada37ab0571676ef0c1372bcf0042b5b00e20', '2025-12-05 15:27:18'),
(25, 1765022704, 30158144, '1765022704', 'Thanh toán MoMo ATM', 'atm', NULL, 'https://test-payment.momo.vn/v2/gateway/pay?t=TU9NT3wxNzY1MDIyNzA0&s=98fa4371c419e263955684fccc906541f9693f142d72cce16c2bd1642aa53577', NULL, NULL, '98d89b79896a19fc3e9c3a02b0405bf4b7373558fee5948a6a7a6216f581111b', '2025-12-06 12:05:05'),
(26, 1765022705, 30158144, '1765022705', 'Thanh toán MoMo ATM', 'failed', '1765022905669', 'https://test-payment.momo.vn/v2/gateway/pay?t=TU9NT3wxNzY1MDIyNzA1&s=8a7a73c6cb2b2220133cc19e6dead114e29acdddfaf042d0113404239b460b67', 1006, 'Giao dịch bị từ chối bởi người dùng.', 'e8ce80e13caf8fadab9c8ff377f23e218a86418c93a0d43fb611ac54876b87cf', '2025-12-06 12:05:06'),
(27, 1765022961, 68847191, '1765022961', 'Thanh toán MoMo ATM', 'atm', NULL, NULL, NULL, NULL, '62534b39771599aa411c01c9830ee79d31e2afc8ea27232e56fe5107b91e82ab', '2025-12-06 12:09:22'),
(28, 1765023124, 38729047, '1765023124', 'Thanh toán MoMo ATM', 'atm', NULL, 'https://test-payment.momo.vn/v2/gateway/pay?t=TU9NT3wxNzY1MDIzMTI0&s=1d66a2426d034742856f2377b10295ea9b7a26da73b6aad66d41848254c69cf7', NULL, NULL, 'b29a153e73ee637fa0c8f5fbbc2ce90a98bcbf3b22e578ff34894b3e2b91b534', '2025-12-06 12:12:05'),
(29, 1765023125, 38729047, '1765023125', 'Thanh toán MoMo ATM', 'paid', '4624151771', 'https://test-payment.momo.vn/v2/gateway/pay?t=TU9NT3wxNzY1MDIzMTI1&s=83ea33dbaa4c94b5dda9f882fb9b9e5d61737c92808e35f2d2a24e5d43ead679', 0, 'Successful.', '181978ed1c302e6d030a722a922a03d7394f548be182836bb81675a0b64d986b', '2025-12-06 12:12:06'),
(30, 1765201686, 4790000, '1765201686', 'Thanh toán MoMo ATM', 'atm', NULL, 'https://test-payment.momo.vn/v2/gateway/pay?t=TU9NT3wxNzY1MjAxNjg2&s=7b91ea4d323f6d12002aac85c92040589e759575c32059bd54c20f9f537bc716', NULL, NULL, '2814327283aad409b2984425c616db6d14f46a0d713b9e3277aac09f2140a7d2', '2025-12-08 13:48:08'),
(31, 1765201688, 4790000, '1765201688', 'Thanh toán MoMo ATM', 'atm', NULL, 'https://test-payment.momo.vn/v2/gateway/pay?t=TU9NT3wxNzY1MjAxNjg4&s=9ffa17aa15134a191cbd2ef9bae40300539a0a845bb0a9d216fe9386349013e5', NULL, NULL, 'fd20f2438debdd73fa1807fc3b6d1c7e8e295121306f9faee8f72babd087dc7f', '2025-12-08 13:48:08'),
(32, 1765201688, 4790000, '1765201688', 'Thanh toán MoMo ATM', 'atm', NULL, NULL, NULL, NULL, 'fd20f2438debdd73fa1807fc3b6d1c7e8e295121306f9faee8f72babd087dc7f', '2025-12-08 13:48:09'),
(33, 1765201689, 4790000, '1765201689', 'Thanh toán MoMo ATM', 'atm', NULL, 'https://test-payment.momo.vn/v2/gateway/pay?t=TU9NT3wxNzY1MjAxNjg5&s=9f7cf6503877d0d339c3f4f90c46b4f476cbc604c6b1aae29b5f405f8c3f4b4e', NULL, NULL, 'b07c01b29e094ef844d8cbbe549f69cf2c8e2c521e7bedb2c75ac09367fff466', '2025-12-08 13:48:10'),
(34, 1765201690, 4790000, '1765201690', 'Thanh toán MoMo ATM', 'atm', NULL, 'https://test-payment.momo.vn/v2/gateway/pay?t=TU9NT3wxNzY1MjAxNjkw&s=80ffc7f6f0e36caf28d9f8f50891076fa603f7809b523bfd478639ccb73f5531', NULL, NULL, 'd817d37e9d20884e2382405c9acc28412ff3a2d2be1dbeaf6fe8c30e80e2cb73', '2025-12-08 13:48:11'),
(35, 1765201691, 4790000, '1765201691', 'Thanh toán MoMo ATM', 'atm', NULL, 'https://test-payment.momo.vn/v2/gateway/pay?t=TU9NT3wxNzY1MjAxNjkx&s=ab50910d1dca32c41db025f563620923a59e993d1b809008b9934ce6a24cbcb5', NULL, NULL, '19b83b3cb3137ecf4a36a5cd418f411ebe65fd18b51727602b033844c2b3fbce', '2025-12-08 13:48:12'),
(36, 1765201692, 4790000, '1765201692', 'Thanh toán MoMo ATM', 'atm', NULL, 'https://test-payment.momo.vn/v2/gateway/pay?t=TU9NT3wxNzY1MjAxNjky&s=aef200813b6e41b119c594b8dbf9c5d1333ca5216c257c2c0eb1646eb8e4bfaf', NULL, NULL, 'd3339df65d85a88a6ba5487d7cb9a32a8e410e758063c5f654195112f280b099', '2025-12-08 13:48:13'),
(37, 1765201693, 4790000, '1765201693', 'Thanh toán MoMo ATM', 'atm', NULL, 'https://test-payment.momo.vn/v2/gateway/pay?t=TU9NT3wxNzY1MjAxNjkz&s=1474bd64389222dd9a4f9128382d8e01e1d2d316f6a8dea958312545861a67fa', NULL, NULL, '2669510d2ca0694c4da0184a75bbae7070579cf944d18fefd5df39228eafe034', '2025-12-08 13:48:14'),
(38, 1765201694, 4790000, '1765201694', 'Thanh toán MoMo ATM', 'atm', NULL, 'https://test-payment.momo.vn/v2/gateway/pay?t=TU9NT3wxNzY1MjAxNjk0&s=3bf2583b6acaad332d43fc0cbb3eb72f50a2cc4df4d36030c8112910a2832ab7', NULL, NULL, '47a9fb39ff0d31d1e039ad3ed75e190cdfae4b822cb664290518b71045702d59', '2025-12-08 13:48:15'),
(39, 1765201695, 4790000, '1765201695', 'Thanh toán MoMo ATM', 'atm', NULL, 'https://test-payment.momo.vn/v2/gateway/pay?t=TU9NT3wxNzY1MjAxNjk1&s=84f90ba04b350a4e1d4307801cbbb3322638703c6d40ea52b11b17f4c2cc0c8d', NULL, NULL, '95bddb41da4cdf874ad51889996de7e2d18502803b8a3653e0c747618aac7808', '2025-12-08 13:48:16'),
(40, 1765201696, 4790000, '1765201696', 'Thanh toán MoMo ATM', 'atm', NULL, 'https://test-payment.momo.vn/v2/gateway/pay?t=TU9NT3wxNzY1MjAxNjk2&s=c322b1cb2590392ef0a3f8d01f92765d976539dc1045f49673d7446d74470c4b', NULL, NULL, 'd0efd2ed92a0ce803a6e391a4979b9dfa4c5f17643d1c533498371da02eb0a8a', '2025-12-08 13:48:17'),
(41, 1765201697, 4790000, '1765201697', 'Thanh toán MoMo ATM', 'atm', NULL, 'https://test-payment.momo.vn/v2/gateway/pay?t=TU9NT3wxNzY1MjAxNjk3&s=46ceb9cf389ed24df7b92e709e3a0f1eaa24b8aac7981bde8273a10cf151037f', NULL, NULL, '12ea120149b4df3ad1ef6a318e9d7f5b16a08ce5ce20a11a7e5629d379402a03', '2025-12-08 13:48:18'),
(42, 1765201698, 4790000, '1765201698', 'Thanh toán MoMo ATM', 'atm', NULL, 'https://test-payment.momo.vn/v2/gateway/pay?t=TU9NT3wxNzY1MjAxNjk4&s=488d9ca803f78aa2f147985f08a30496737730403b0bc6eefea373951dda928c', NULL, NULL, '7b390cf68daf2465de552c47c7ed8cb8d252662775c8f308e19f98fc4c2c0ead', '2025-12-08 13:48:20'),
(43, 1765201700, 4790000, '1765201700', 'Thanh toán MoMo ATM', 'atm', NULL, 'https://test-payment.momo.vn/v2/gateway/pay?t=TU9NT3wxNzY1MjAxNzAw&s=4294ffff66e5be7e1e4377ce2910a409f5c3de2c99f002fd257cee14952e135f', NULL, NULL, 'ad1a86b22f95d7c1c17dcb0c61df54b3dea34c3be08e8ac8b0ff10c2db873278', '2025-12-08 13:48:21'),
(44, 1765201701, 4790000, '1765201701', 'Thanh toán MoMo ATM', 'atm', NULL, 'https://test-payment.momo.vn/v2/gateway/pay?t=TU9NT3wxNzY1MjAxNzAx&s=4333b8cdc7a037758088e385031bba4bd7059a62fa399e2e78f2addfa556a819', NULL, NULL, '24fcad8d15a636de36539bf54ce817cbd177dc98fcc98a1ee0c811aca4a92e6b', '2025-12-08 13:48:22'),
(45, 1765201702, 4790000, '1765201702', 'Thanh toán MoMo ATM', 'atm', NULL, 'https://test-payment.momo.vn/v2/gateway/pay?t=TU9NT3wxNzY1MjAxNzAy&s=47ab96df9cd4f66b30f34187f6442df546a426f66919758c2447ffb075636ea8', NULL, NULL, '2b92413b87736e26b9869ec784e67da2996039eb9aca172e75e8454ba4446a6f', '2025-12-08 13:48:23'),
(46, 1765201703, 4790000, '1765201703', 'Thanh toán MoMo ATM', 'atm', NULL, 'https://test-payment.momo.vn/v2/gateway/pay?t=TU9NT3wxNzY1MjAxNzAz&s=a548e94e8beb79fa33d7ca4e8567dacca1addc5cf6198ce007c44325dd947c9f', NULL, NULL, '3974c93af6ec7f3b69b9338f71f8316a5688af8462293ba4b8d2cc34bde394e7', '2025-12-08 13:48:24'),
(47, 1765201704, 4790000, '1765201704', 'Thanh toán MoMo ATM', 'atm', NULL, 'https://test-payment.momo.vn/v2/gateway/pay?t=TU9NT3wxNzY1MjAxNzA0&s=9f7b316edfd2fa59b98c1ff3b2d3fc3d8732fe09f52e08c65f2c054ef2891043', NULL, NULL, 'ad2e0e1b3811afc9c7e62bd106561c853eb818ea7ee4f0668572b3b695dca583', '2025-12-08 13:48:24'),
(48, 1765201704, 4790000, '1765201704', 'Thanh toán MoMo ATM', 'atm', NULL, NULL, NULL, NULL, 'ad2e0e1b3811afc9c7e62bd106561c853eb818ea7ee4f0668572b3b695dca583', '2025-12-08 13:48:25'),
(49, 1765201724, 4790000, '1765201724', 'Thanh toán MoMo ATM', 'atm', NULL, 'https://test-payment.momo.vn/v2/gateway/pay?t=TU9NT3wxNzY1MjAxNzI0&s=74337ef8a3c4fbb710452dcf426373a93f29c58947a6fe22611d0347b2971def', NULL, NULL, 'b5a05833de837b22625e6efdcee2fd1b2d43b1e19032e1cf80ff00b386412755', '2025-12-08 13:48:45'),
(50, 1765201725, 4790000, '1765201725', 'Thanh toán MoMo ATM', 'atm', NULL, 'https://test-payment.momo.vn/v2/gateway/pay?t=TU9NT3wxNzY1MjAxNzI1&s=ad3efcdfda6f0b31bbaa7b0327020d58983a2adba0ca54fa90238430c64d8576', NULL, NULL, '9d19826070f5c11bc2927f1ea03eaa35416280ed7df3bb689b4caf84995d9a7f', '2025-12-08 13:48:46'),
(51, 1765201733, 4790000, '1765201733', 'Thanh toán MoMo ATM', 'atm', NULL, 'https://test-payment.momo.vn/v2/gateway/pay?t=TU9NT3wxNzY1MjAxNzMz&s=86e16eb4caadb27e25bbd9c0994695a525a2af33fe8cfbabf902d060e5bfe9e7', NULL, NULL, '1c32930e5bc2b873745f62fd321320c6bdb2e12f964ffa4feaef473137fa80c5', '2025-12-08 13:48:54'),
(52, 1765201734, 4790000, '1765201734', 'Thanh toán MoMo ATM', 'paid', '4625699469', 'https://test-payment.momo.vn/v2/gateway/pay?t=TU9NT3wxNzY1MjAxNzM0&s=085f6765c02f714fdd27702e7f56508558fcd49985e6c3e656aaa0be5b5ee484', 0, 'Successful.', '0c696b0f7b3c655d0f944fbf4d269036614723fba9d179f0d5614a376556a22c', '2025-12-08 13:48:55'),
(53, 1765468350, 7040000, '1765468350', 'Thanh toán MoMo ATM', 'paid', '4627316478', 'https://test-payment.momo.vn/v2/gateway/pay?t=TU9NT3wxNzY1NDY4MzUw&s=64d99e623befa4abe30612790fb281dc26554b08f2c8df5a3e2c4f1b7f15c835', 0, 'Successful.', 'd8f908fe0047b153447df0396efb5dad8270af3af8e5c265e9d38b30899bdb5c', '2025-12-11 15:52:31'),
(54, 1765468351, 7040000, '1765468351', 'Thanh toán MoMo ATM', 'atm', NULL, 'https://test-payment.momo.vn/v2/gateway/pay?t=TU9NT3wxNzY1NDY4MzUx&s=39b1f9fdb3831c771fed834f80b0d288d9e9ea3f48dd95cc3e1518f938a39f6e', NULL, NULL, 'f657cba2009bb52f72577aaa0f3e4a88300a80285b3678ffb9ced0eb5172e55d', '2025-12-11 15:52:32'),
(55, 1767249846, 60325050, '1767249846', 'Thanh toán MoMo ATM', 'atm', NULL, NULL, NULL, NULL, 'eca41e0ca28916de8e004410fd4d59bb354c364ba3c0024b71cc84670220273c', '2026-01-01 06:44:07'),
(56, 1767249847, 60325050, '1767249847', 'Thanh toán MoMo ATM', 'atm', NULL, NULL, NULL, NULL, '1e600e6ed1753513e18633ff69546b4de0cc7f52734fabe60a3a9dbff5e1175e', '2026-01-01 06:44:07'),
(57, 1767249974, 13076300, '1767249974', 'Thanh toán MoMo ATM', 'atm', NULL, NULL, NULL, NULL, '5d65d515d8d8a021f2b2a44207a453557053fabd8ad6d6829bfe00a1b0ca85b7', '2026-01-01 06:46:15'),
(58, 1767249975, 13076300, '1767249975', 'Thanh toán MoMo ATM', 'atm', NULL, NULL, NULL, NULL, 'ba5069abb4a72c2e31210e878d313051ec5339c643fcc754d3c5105f26afc154', '2026-01-01 06:46:15'),
(59, 1767250006, 13076300, '1767250006', 'Thanh toán MoMo ATM', 'atm', NULL, NULL, NULL, NULL, '082a4ed2e8d740e881fc34f2697f9f537c5c626ebb01f9f8744c272655aefd36', '2026-01-01 06:46:47'),
(60, 1767250162, 13076300, '1767250162', 'Thanh toán MoMo ATM', 'atm', NULL, NULL, NULL, NULL, '5f5e55f524459d648c2d76fec6a80063414590c1d2b1d716079f178c6aa7e934', '2026-01-01 06:49:22'),
(61, 1767250176, 490000, '1767250176', 'Thanh toán MoMo ATM', 'atm', NULL, NULL, NULL, NULL, '8cb6cf761fb87b53bd01acb40217026e8ffe1ec0b8861df4ccc49818c7ca6cfb', '2026-01-01 06:49:36'),
(62, 1767250186, 490000, '1767250186', 'Thanh toán MoMo ATM', 'atm', NULL, NULL, NULL, NULL, '49cc7f95780c2b68fe790c2bb5dfa0ddc153e26b1a5b170f1803ff6c2d58485f', '2026-01-01 06:49:47'),
(63, 1767253743, 18217750, '1767253743', 'Thanh toán MoMo ATM', 'atm', NULL, 'https://test-payment.momo.vn/v2/gateway/pay?t=TU9NT3wxNzY3MjUzNzQz&s=cf13e30b2c6d60d3e19aebf84d1889c85361c0b01646421291b5a6da305ebb14', NULL, NULL, '3aa4d04d6f6f97d150c576e75357bffde416f17728f9bb990e0fbdbaaabbf7b9', '2026-01-01 07:49:04'),
(64, 1767253744, 18217750, '1767253744', 'Thanh toán MoMo ATM', 'atm', NULL, 'https://test-payment.momo.vn/v2/gateway/pay?t=TU9NT3wxNzY3MjUzNzQ0&s=ba894b0c1e819ee37271276c5bd869d917ed1c82ed7fc95d70ac46dafc713196', NULL, NULL, '1221781bfaf3a65c0b5e0092de5f94dda66969fe45d48957650de7bf1a81d980', '2026-01-01 07:49:05'),
(65, 1767253949, 12626300, '1767253949', 'Thanh toán MoMo ATM', 'atm', NULL, 'https://test-payment.momo.vn/v2/gateway/pay?t=TU9NT3wxNzY3MjUzOTQ5&s=d0291a58914958825d5d3a8542fe1c16f645fbe41c9d0ed07b1fc32eb9fe556a', NULL, NULL, '01527d22ef3d4c1aad0147e941f2675bb65e3167a8075e49f4d3adb63e46b606', '2026-01-01 07:52:30'),
(66, 1767253950, 12626300, '1767253950', 'Thanh toán MoMo ATM', 'failed', '1767254370122', 'https://test-payment.momo.vn/v2/gateway/pay?t=TU9NT3wxNzY3MjUzOTUw&s=a8b81258947e8147fb963f2aef81af7fba63c3529b3c5d52970884e44dbf66ba', 1006, 'Giao dịch bị từ chối bởi người dùng.', '36fedd5bae612964d1ee953df92997edb9a0121186b69e46fcf26b1af2462f03', '2026-01-01 07:52:31'),
(67, 1767254690, 12626300, '1767254690', 'Thanh toán MoMo ATM', 'atm', NULL, 'https://test-payment.momo.vn/v2/gateway/pay?t=TU9NT3wxNzY3MjU0Njkw&s=662fbfdc5376ad44c8249c3b1323cc2b97e1ea6ab63a121200491548f89c9dc0', NULL, NULL, '00d240d258272db2319ed6db9fe1893a1a3a92827d578a3dd19e88fdb3190171', '2026-01-01 08:04:50'),
(68, 1767254690, 12626300, '1767254690', 'Thanh toán MoMo ATM', 'atm', NULL, NULL, NULL, NULL, '00d240d258272db2319ed6db9fe1893a1a3a92827d578a3dd19e88fdb3190171', '2026-01-01 08:04:51'),
(69, 1767254719, 18217750, '1767254719', 'Thanh toán MoMo ATM', 'atm', NULL, 'https://test-payment.momo.vn/v2/gateway/pay?t=TU9NT3wxNzY3MjU0NzE5&s=3f383a77b218f564fad48f46cfd15f2faf97550d00f681b769fa7fcbb88f2f60', NULL, NULL, '553b821dfc8615cc54d50d28633a98c5c57214b1f14ac933bab8d3fa7d338cba', '2026-01-01 08:05:20'),
(70, 1767254720, 18217750, '1767254720', 'Thanh toán MoMo ATM', 'failed', '1767255047744', 'https://test-payment.momo.vn/v2/gateway/pay?t=TU9NT3wxNzY3MjU0NzIw&s=dea81acd1a96fe61fb2f612e662f47a90e2f8cea238fa8cf88c3aa3b2e0fa0e8', 1006, 'Giao dịch bị từ chối bởi người dùng.', 'c2f19e2c9f2189ce79b4272a13221f0cb878af4bb53829255debabed9529f0cb', '2026-01-01 08:05:20'),
(71, 1767255070, 18217750, '1767255070', 'Thanh toán MoMo ATM', 'atm', NULL, 'https://test-payment.momo.vn/v2/gateway/pay?t=TU9NT3wxNzY3MjU1MDcw&s=56795f9d1b67c441041f20be024269d800220776791c9851f9f5ca822b957528', NULL, NULL, '8dd650e03e7d04458478ffe9b56e0d23f84123b34f6b7f8707112c6567c552a4', '2026-01-01 08:11:10'),
(72, 1767255070, 18217750, '1767255070', 'Thanh toán MoMo ATM', 'atm', NULL, NULL, NULL, NULL, '8dd650e03e7d04458478ffe9b56e0d23f84123b34f6b7f8707112c6567c552a4', '2026-01-01 08:11:11'),
(73, 1767255396, 12626300, '1767255396', 'Thanh toán MoMo ATM', 'atm', NULL, 'https://test-payment.momo.vn/v2/gateway/pay?t=TU9NT3wxNzY3MjU1Mzk2&s=e8d4ef46196d41f0e8cb27631135fea8c9d8e573f7770206fe9a8cd303cf1d26', NULL, NULL, 'aa1f1b2db405337279e2d93363dba53a16e2eaf040f2170a619fa6a67a6be133', '2026-01-01 08:16:36'),
(74, 1767255411, 12626300, '1767255411', 'Thanh toán MoMo ATM', 'atm', NULL, 'https://test-payment.momo.vn/v2/gateway/pay?t=TU9NT3wxNzY3MjU1NDEx&s=64f97c1afce138b2576a1439d00789725038d35a6856e4218475e49d8b3d2484', NULL, NULL, '367ff1116fb33d60b5734e988613a3ed4aa69aab7829ac260af716c8736adc78', '2026-01-01 08:16:51'),
(75, 1767337141, 404500, '1767337141', 'Thanh toán MoMo ATM', 'atm', NULL, 'https://test-payment.momo.vn/v2/gateway/pay?t=TU9NT3wxNzY3MzM3MTQx&s=01c351a9d25f3faede8a487b5feb5735fd903f94f36b0e1cf61ad30e459d611a', NULL, NULL, '9efeea64e9eca4fc433e7d7e140ee7e3ca6ceb763d6bb7027fe26982fa7266fb', '2026-01-02 06:59:01'),
(76, 2147483647, 404500, '17673380092681', 'Thanh toán MoMo ATM', 'atm', NULL, 'https://test-payment.momo.vn/v2/gateway/pay?t=TU9NT3wxNzY3MzM4MDA5MjY4MQ&s=a6c50e837c4352ff285d17308f27207081650130d6653bccaae3406c983d4e2a', NULL, NULL, '79974279600388875bc1b7e316b3bb93ca413ab2260e423021240df5094d2ad9', '2026-01-02 07:13:30'),
(77, 2147483647, 404500, '17673380109507', 'Thanh toán MoMo ATM', 'atm', NULL, 'https://test-payment.momo.vn/v2/gateway/pay?t=TU9NT3wxNzY3MzM4MDEwOTUwNw&s=c9407040db66c792f559cb6ebc63435f4c99c3a9c97e7b15e926f796cf87f912', NULL, NULL, 'af93d2b0611d78ba5f94f9d2dfdbb20d7f4814e6ab2474db8900ce3b7fd890f8', '2026-01-02 07:13:30'),
(78, 2147483647, 404500, '17673401001886', 'Thanh toán MoMo ATM', 'atm', NULL, 'https://test-payment.momo.vn/v2/gateway/pay?t=TU9NT3wxNzY3MzQwMTAwMTg4Ng&s=f430ae139527f9e82f62f99ccba9ca1f91ecde7ab61ebea6c9e263d2116d449b', NULL, NULL, '7e02e578203cd87d6166aa621f7de81634411d6ac244075f06eb95e4c41af5c7', '2026-01-02 07:48:21'),
(79, 2147483647, 404500, '17673401015396', 'Thanh toán MoMo ATM', 'atm', NULL, 'https://test-payment.momo.vn/v2/gateway/pay?t=TU9NT3wxNzY3MzQwMTAxNTM5Ng&s=5adafc862be922608baef245e17d7f0f45fa9c0b445c544f2b513aab81d36b87', NULL, NULL, '3985b3f9ea1981dc5892b5d9b051c985f2e1ed6b0be527313c4fef44a83ebb73', '2026-01-02 07:48:21'),
(80, 2147483647, 404500, '17673404735031', 'Thanh toán MoMo ATM', 'atm', NULL, 'https://test-payment.momo.vn/v2/gateway/pay?t=TU9NT3wxNzY3MzQwNDczNTAzMQ&s=10633fe2347af4171cee41c12c17651f320661d711c6c932f457fabe58887795', NULL, NULL, '1525a901312ef21e96f7669b8657b6cb67ae6a6357aff6706ead66ad69e1d895', '2026-01-02 07:54:33'),
(81, 2147483647, 404500, '17673404732024', 'Thanh toán bằng ví MoMo', 'atm', NULL, 'momo://app?action=payWithApp&isScanQR=true&serviceType=qr&sid=TU9NT3wxNzY3MzQwNDczMjAyNA&v=3.0&sr=0&sig=e0876f507612db5b19743d94f0a1bc9afec1d0612bbc9ff5c6b9ecf2', NULL, NULL, '0452e7cfd53e63f51b2180449a0726a841190ba73d43dc7c689f7d6b4d24842e', '2026-01-02 07:54:34'),
(82, 2147483647, 404500, '17673405426673', 'Thanh toán bằng ví MoMo', 'atm', NULL, 'momo://app?action=payWithApp&isScanQR=true&serviceType=qr&sid=TU9NT3wxNzY3MzQwNTQyNjY3Mw&v=3.0&sr=0&sig=73996df97efd50351ebd7bfca2bdfa0d5cb13405127372b98ad2fcba', NULL, NULL, '879bebba93de084e21386262a5d4727d7dea8e5ce4065b289f6c06eb3548ef27', '2026-01-02 07:55:42'),
(83, 2147483647, 404500, '17673410353333', 'Thanh toán MoMo ATM', 'atm', NULL, 'https://test-payment.momo.vn/v2/gateway/pay?t=TU9NT3wxNzY3MzQxMDM1MzMzMw&s=c929d87e74c1f1c84022cc2edd845e9855f942591ec1aecf1bb06cf5d6d6bfdc', NULL, NULL, 'deba2e4d3eaacbcc93c22bf0e52be4d0bd81c3cb526b64b0fae3da58538efc42', '2026-01-02 08:03:55'),
(84, 2147483647, 404500, '17673410358533', 'Thanh toán bằng ví MoMo', 'atm', NULL, 'momo://app?action=payWithApp&isScanQR=true&serviceType=qr&sid=TU9NT3wxNzY3MzQxMDM1ODUzMw&v=3.0&sr=0&sig=8b3efaa81a10d995cc71340f570ac7a748a262344837441fec037a8d', NULL, NULL, '901d455ec9659866fb58196c7477124b2fa489fa32dda888f34d5c3f86b95034', '2026-01-02 08:03:55'),
(85, 2147483647, 404500, '17673411765084', 'Thanh toán bằng ví MoMo', 'qr', NULL, 'momo://app?action=payWithApp&isScanQR=true&serviceType=qr&sid=TU9NT3wxNzY3MzQxMTc2NTA4NA&v=3.0&sr=0&sig=02a2f0e7ee18ed72b6fae51e2ebe08ba8ea75b1040d0f1cec9d5e93a', NULL, NULL, 'd7ce72e9f6f9c153a3bd4258931fb890336b4ba3bcb94b9a686bd07567b8201d', '2026-01-02 08:06:16'),
(86, 2147483647, 404500, '17673412316733', 'Thanh toán bằng ví MoMo', 'qr', NULL, 'momo://app?action=payWithApp&isScanQR=true&serviceType=qr&sid=TU9NT3wxNzY3MzQxMjMxNjczMw&v=3.0&sr=0&sig=6171c5467e9de5c014f61197b0f61be97c13da58c7ba4aec2553fa87', NULL, NULL, '0c5d05e012d2cd248e0601abc97bdd822fa819a04ac76a575f1e2c4adaed0ad2', '2026-01-02 08:07:12'),
(87, 2147483647, 404500, '17673414098386', 'Thanh toán đơn hàng trang sức Arelia', 'qr', NULL, 'momo://app?action=payWithApp&isScanQR=false&serviceType=app&sid=TU9NT3wxNzY3MzQxNDA5ODM4Ng&v=3.0', NULL, NULL, 'ce87973b373f1713a7ed23555eb5d9dcf2116d74100aa65f4cea1d51310c3a80', '2026-01-02 08:10:09'),
(88, 2147483647, 404500, '17673414095950', 'Thanh toán MoMo ATM', 'qr', NULL, 'https://test-payment.momo.vn/v2/gateway/pay?t=TU9NT3wxNzY3MzQxNDA5NTk1MA&s=7b048f6f9db696234b1bab98828c1fcd32dc8ecb2afc0da4fac63ee2eeff9e06', NULL, NULL, 'b0c7726e56b938ba58c99e09ea9b2fbc3a77778975f519a6570a3ce51b3a3ee4', '2026-01-02 08:10:09'),
(89, 2147483647, 404500, '17673414394877', 'Thanh toán đơn hàng trang sức Arelia', 'qr', NULL, 'momo://app?action=payWithApp&isScanQR=false&serviceType=app&sid=TU9NT3wxNzY3MzQxNDM5NDg3Nw&v=3.0', NULL, NULL, '22db934a29a59d233c68be9aa795a89356ca3ae4187cd78bc9db36f9b802488e', '2026-01-02 08:10:39'),
(90, 2147483647, 404500, '17673419119718', 'Thanh toán đơn hàng trang sức Arelia', 'qr', NULL, 'momo://app?action=payWithApp&isScanQR=false&serviceType=app&sid=TU9NT3wxNzY3MzQxOTExOTcxOA&v=3.0', NULL, NULL, 'b55e9770169db3baf952be8cb5c15132ce8873f925edf686f5607dd8a687f464', '2026-01-02 08:18:31'),
(91, 2147483647, 404500, '17673421456871', 'Thanh toán đơn hàng trang sức Arelia', 'qr', NULL, 'momo://app?action=payWithApp&isScanQR=false&serviceType=app&sid=TU9NT3wxNzY3MzQyMTQ1Njg3MQ&v=3.0', NULL, NULL, '49513f9eb09f52cc728036b3d83e1ccd2fd1defb0cfe3b694656dcaddeb96fa2', '2026-01-02 08:22:25'),
(92, 2147483647, 404500, '17673421508361', 'Thanh toán đơn hàng trang sức Arelia', 'qr', NULL, 'momo://app?action=payWithApp&isScanQR=false&serviceType=app&sid=TU9NT3wxNzY3MzQyMTUwODM2MQ&v=3.0', NULL, NULL, '1819752bf09df1fe9556f25b306ac340f2603c60884c5af053e464f2695601ca', '2026-01-02 08:22:30'),
(93, 2147483647, 404500, '17673421543456', 'Thanh toán đơn hàng trang sức Arelia', 'qr', NULL, 'momo://app?action=payWithApp&isScanQR=false&serviceType=app&sid=TU9NT3wxNzY3MzQyMTU0MzQ1Ng&v=3.0', NULL, NULL, 'f52acbbc6dd615e823fe0e85c086bbcdee9b78dde79e7b916217882ed69f5243', '2026-01-02 08:22:34'),
(94, 2147483647, 404500, '17673421557896', 'Thanh toán đơn hàng trang sức Arelia', 'qr', NULL, 'momo://app?action=payWithApp&isScanQR=false&serviceType=app&sid=TU9NT3wxNzY3MzQyMTU1Nzg5Ng&v=3.0', NULL, NULL, '2d45bfd44ae36fd4f9ab72b2b8123e08c13a835bf870efb60ffc05e63c3b324d', '2026-01-02 08:22:35'),
(95, 2147483647, 404500, '17673425475830', 'Thanh toán đơn hàng Arelia Jewelry', 'qr', NULL, 'https://test-payment.momo.vn/v2/gateway/pay?t=TU9NT3wxNzY3MzQyNTQ3NTgzMA&s=973a7501b23298de6c74521d56c173ea53bfda23bd75d626d4e5d7b7e0b8bfb1', NULL, NULL, '57d79a20ea3bb15ccf3f5f206988186b0a05468c15f372ecc4ce6e9e71e6f1e9', '2026-01-02 08:29:08'),
(96, 2147483647, 404500, '17673425885219', 'Thanh toán đơn hàng Arelia Jewelry', 'qr', NULL, 'https://test-payment.momo.vn/v2/gateway/pay?t=TU9NT3wxNzY3MzQyNTg4NTIxOQ&s=aa0d6b9555c4a6a6ee868d1b202f8fbd9eaeb6248073c745a87461322334e285', NULL, NULL, 'c501af9b6fab6f4d492f1a0ad15a8650713de153449087f3a134e96e08f41c73', '2026-01-02 08:29:48'),
(97, 2147483647, 404500, '17673434779831', 'Thanh toán đơn hàng Arelia Jewelry', 'qr', NULL, 'https://test-payment.momo.vn/v2/gateway/pay?t=TU9NT3wxNzY3MzQzNDc3OTgzMQ&s=dbe53bec3265d43277801cb26635e7e14a1b0e82affd97d7f136ee413ddcd6b9', NULL, NULL, '9b22631bff62625115f146cb4d9b7734d49d445eb2ca48f9bc1614f631cd5901', '2026-01-02 08:44:38'),
(98, 2147483647, 404500, '17673437314514', 'Thanh toán đơn hàng Arelia Jewelry', 'qr', NULL, 'https://test-payment.momo.vn/v2/gateway/pay?t=TU9NT3wxNzY3MzQzNzMxNDUxNA&s=3693e8510e7d1915de0be64bb3ebf70d906b8a841e6769810844424a8b5c20c9', NULL, NULL, '8dbc8c575b4c00b6a9dd06f3839ebb39cfe3be907cf136cb02c99840b6584fb6', '2026-01-02 08:48:52'),
(99, 2147483647, 404500, '17673437346831', 'Thanh toán đơn hàng Arelia Jewelry', 'qr', NULL, 'https://test-payment.momo.vn/v2/gateway/pay?t=TU9NT3wxNzY3MzQzNzM0NjgzMQ&s=283809b6bb7f0c96dfd16cc191c2fabcaa0954c9f129713ea769ce6e261102eb', NULL, NULL, 'ffe69de320b7febd1daf7435e73393ce2f56f7bff822dea480536143473f0971', '2026-01-02 08:48:54'),
(100, 2147483647, 404500, '17673442068067', 'Thanh toán đơn hàng Arelia Jewelry', 'qr', NULL, 'https://test-payment.momo.vn/v2/gateway/pay?t=TU9NT3wxNzY3MzQ0MjA2ODA2Nw&s=9d5794a94e61d1e73ec41072eabf79ef464c40d5f00983a90022392c35759877', NULL, NULL, 'af575e9c6ea626a5e468c300f30f80562ee3c3c2d04ad3602f2a53a2e80de658', '2026-01-02 08:56:46'),
(101, 2147483647, 1902052, '17673567651280', 'Thanh toán đơn hàng Arelia Jewelry', 'qr', NULL, 'https://test-payment.momo.vn/v2/gateway/pay?t=TU9NT3wxNzY3MzU2NzY1MTI4MA&s=964c4b853966abf78fa4de44f85a941a57679a724977d7271a05647912e72892', NULL, NULL, 'ef125a5a41e61e09167bee967b675819cc0e3376531add869a59aa95a22700c1', '2026-01-02 12:26:05'),
(102, 2147483647, 16664720, '17673585494748', 'Thanh toán đơn hàng Arelia Jewelry', 'qr', NULL, 'https://test-payment.momo.vn/v2/gateway/pay?t=TU9NT3wxNzY3MzU4NTQ5NDc0OA&s=371f7e4858010ff3be5158d7123c837a1313f1a263811e1f778658f47a3f1911', NULL, NULL, 'd20a091df2df8ee697cda549241ee700630f2fd727b41159f6b5ac238cc460b6', '2026-01-02 12:55:49'),
(103, 2147483647, 1197431, '17673641663500', 'Thanh toán đơn hàng Arelia Jewelry', 'qr', NULL, 'https://test-payment.momo.vn/v2/gateway/pay?t=TU9NT3wxNzY3MzY0MTY2MzUwMA&s=b581ce9cee70cda75472f6ee6cb491984828222eb5a42a7eae99a38f33fb1717', NULL, NULL, 'e8e75256e31204cb83540e41275efca75a1dea70773b747c1412c39923b8348b', '2026-01-02 14:29:27'),
(104, 2147483647, 698835, '17673642809983', 'Thanh toán đơn hàng Arelia Jewelry', 'qr', NULL, 'https://test-payment.momo.vn/v2/gateway/pay?t=TU9NT3wxNzY3MzY0MjgwOTk4Mw&s=9fe041e4504fb0c602c7e896852aae3e85c1bf96d8be6d8d35610640826ec5c9', NULL, NULL, 'a536120af739db309bc7c97ba82b96cd6230fbf5128f6c444fb28df99dbb9b76', '2026-01-02 14:31:20'),
(105, 2147483647, 520299, '17673652749254', 'Thanh toán đơn hàng Arelia Jewelry', 'qr', NULL, 'https://test-payment.momo.vn/v2/gateway/pay?t=TU9NT3wxNzY3MzY1Mjc0OTI1NA&s=643f09bd93eb8aba60b6ef397b81628b47966c6591ecf604a4d8fd4d0e361f5f', NULL, NULL, '4f3c5d43c9f1debd74f46612b2691fe9ee9ebb937cb949067e004ab89912cd9a', '2026-01-02 14:47:54'),
(106, 2147483647, 515496, '17673656962000', 'Thanh toán đơn hàng Arelia Jewelry', 'qr', NULL, 'https://test-payment.momo.vn/v2/gateway/pay?t=TU9NT3wxNzY3MzY1Njk2MjAwMA&s=7a267dde06f574f8a522f809b07453a8076d24d24552d927ea769f8d20f5cb77', NULL, NULL, 'b396dfa394914ab996495ac3d2e4d171ea9ca8cd029810414686105f30961cdf', '2026-01-02 14:54:56');

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
(5, 'ltdt', 'dieuthaole06@gmail.com', '0777777777', '420/30 , Lê Văn Hiến, Việt Nam', 'Đóng gói cẩn thận', '2025-11-30', 0, NULL, 4, NULL, NULL, 1),
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
(27, 'dth', 'thao@gmail.com', '0987654321', '420/30 Lê Văn Hiến, Levanhien, Việt Nam', 'ccc', '2025-12-05', 0, 42908750, 5, 'momo', '4623232458', 0),
(28, 'dth', 'thao@gmail.com', '0987654321', '420/30 Lê Văn Hiến, Đà Nẵng, Việt Nam', '111', '2025-12-05', 1, 40765313, 5, 'momo', '4623559786', 0),
(29, 'dth', 'thao@gmail.com', '0987654321', '420/30 Lê Văn Hiến, Đà Nẵng, Việt Nam', 'ok', '2025-12-06', 0, 38729047, 5, 'momo', '4624151771', 0),
(30, 'ltdt', 'dieuthaole06@gmail.com', '0777777777', '420/30 Lê Văn Hiến, Đà Nẵng, Việt Nam', 'okk', '2025-12-08', 0, 48060000, 4, 'cod', NULL, 0),
(31, 'ltdt', 'dieuthaole06@gmail.com', '0777777777', '420/30 Lê Văn Hiến, Đà Nẵng, Việt Nam', 'ok', '2025-12-08', 1, 4790000, 4, 'momo', '4625699469', 0),
(32, 'ltdt', 'dieuthaole06@gmail.com', '0777777777', '420/30, lvh, dn', 'aaa', '2025-12-11', 1, 7040000, 4, 'momo', '4627316478', 0),
(34, 'Diệu Thảo', 'dieuthao1809206@gmail.com', '0347367621', '420/30 Lê Văn Hiến, Đà Nẵng, Việt Nam', 'ok', '2026-01-01', 0, 18622750, 1, 'cod', NULL, 0),
(36, 'Diệu Thảo', 'dieuthao1809206@gmail.com', '0347367621', '420/30 Lê Văn Hiến, Đà Nẵng, Việt Nam', 'kkk', '2026-01-01', 0, 18607810, 1, 'cod', NULL, 0),
(37, 'Diệu Thảo', 'dieuthao1809206@gmail.com', '0347367621', '420/30, lvh, dn', 'kkkk', '2026-01-02', 0, 404500, 1, 'momo', '4641434077', 0),
(38, 'Diệu Thảo', 'dieuthao1809206@gmail.com', '0347367621', '420/30 Lê Văn Hiến, Đà Nẵng, Việt Nam', 'kkk', '2026-01-02', 0, 404500, 1, 'momo', '4641447123', 0),
(39, 'Diệu Thảo', 'dieuthao1809206@gmail.com', '0347367621', '420/30 Lê Văn Hiến, Đà Nẵng, Việt Nam', '', '2026-01-02', 0, 1902052, 1, 'momo', '4641564522', 0),
(40, 'Diệu Thảo', 'dieuthao1809206@gmail.com', '0347367621', '420/30 Lê Văn Hiến, Đà Nẵng, Việt Nam', '', '2026-01-02', 0, 16664720, 1, 'momo', '4641607605', 0),
(41, 'Diệu Thảo', 'dieuthao1809206@gmail.com', '0347367621', '420/30 Lê Văn Hiến, Đà Nẵng, Việt Nam', '', '2026-01-02', 0, 1197431, 1, 'momo', '4641601886', 0),
(42, 'ltdt', 'dieuthaole06@gmail.com', '0777777777', '420/30 Lê Văn Hiến, Đà Nẵng, Việt Nam', '', '2026-01-02', 0, 698835, 4, 'momo', '4641593609', 0),
(43, 'ltdt', 'dieuthaole06@gmail.com', '0777777777', '420/30, lvh, dn', 'qqq', '2026-01-02', 0, 42908750, 4, 'cod', NULL, 0),
(44, 'Mỹ Linh', 'linh@gmail.com', '0129837645', '123, bn, dn', 'okk', '2026-01-02', 0, 520299, 6, 'momo', '4641623826', 0),
(45, 'Mỹ Linh', 'linh@gmail.com', '0129837645', '123, bn, dn', 'aa', '2026-01-02', 0, 515496, 6, 'momo', '4641605195', 0);

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
(33, 27, 2, 42868750, 1, 42868750),
(34, 28, 2, 40725313, 1, 40725313),
(35, 29, 2, 38689047, 1, 38689047),
(36, 30, 15, 48020000, 1, 48020000),
(37, 31, 2, 4750000, 1, 4750000),
(38, 32, 16, 7000000, 1, 7000000),
(39, 33, 1, 450000, 1, 450000),
(40, 34, 3, 8573750, 1, 8573750),
(41, 34, 9, 9604000, 1, 9604000),
(42, 34, 1, 405000, 1, 405000),
(43, 35, 3, 8145063, 1, 8145063),
(44, 36, 3, 7737810, 1, 7737810),
(45, 36, 5, 10830000, 1, 10830000),
(46, 37, 1, 364500, 1, 364500),
(47, 38, 1, 328050, 1, 364500),
(48, 39, 30, 490050, 1, 490050),
(49, 39, 32, 686001, 2, 1372002),
(50, 40, 1, 490000, 1, 490000),
(51, 40, 9, 9411920, 1, 9411920),
(52, 40, 14, 6722800, 1, 6722800),
(53, 41, 32, 672281, 1, 672281),
(54, 41, 30, 485150, 1, 485150),
(55, 42, 32, 658835, 1, 658835),
(56, 43, 6, 42868750, 1, 42868750),
(57, 44, 30, 480299, 1, 480299),
(58, 45, 30, 475496, 1, 475496);

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
  `description` varchar(255) NOT NULL,
  `group_name` varchar(100) DEFAULT 'Other',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `permission`
--

INSERT INTO `permission` (`id`, `description`, `group_name`, `created_at`) VALUES
(1, 'Add users', 'User', '2025-12-30 14:37:40'),
(2, 'Edit users', 'User', '2025-12-30 14:37:40'),
(3, 'Delete users', 'User', '2025-12-30 14:37:40'),
(4, 'See users', 'User', '2025-12-30 14:37:40'),
(5, 'Add categories', 'Category', '2025-12-30 14:37:40'),
(6, 'Edit categories', 'Category', '2025-12-30 14:37:40'),
(7, 'Delete categories', 'Category', '2025-12-30 14:37:40'),
(8, 'See categories', 'Category', '2025-12-30 14:37:40'),
(9, 'Add products', 'Product', '2025-12-30 14:37:40'),
(10, 'Edit products', 'Product', '2025-12-30 14:37:40'),
(11, 'Delete products', 'Product', '2025-12-30 14:37:40'),
(12, 'See products', 'Product', '2025-12-30 14:37:40'),
(13, 'Solve orders', 'Order', '2025-12-30 14:37:40'),
(14, 'Delete orders', 'Order', '2025-12-30 14:37:40'),
(15, 'See orders', 'Order', '2025-12-30 14:37:40'),
(16, 'Add galleries', 'Gallery', '2025-12-30 14:37:40'),
(17, 'Edit galleries', 'Gallery', '2025-12-30 14:37:40'),
(18, 'Delete galleries', 'Gallery', '2025-12-30 14:37:40'),
(19, 'See galleries', 'Gallery', '2025-12-30 14:37:40'),
(20, 'Solve contacts', 'Contact', '2025-12-30 14:37:40'),
(21, 'Delete contacts', 'Contact', '2025-12-30 14:37:40'),
(22, 'See contacts', 'Contact', '2025-12-30 14:37:40'),
(23, 'Add contact', 'Contact', '2025-12-30 14:37:40'),
(24, 'Add imports', 'Import', '2025-12-30 14:37:40'),
(25, 'Edit imports', 'Import', '2025-12-30 14:37:40'),
(26, 'Delete imports', 'Import', '2025-12-30 14:37:40'),
(27, 'See imports', 'Import', '2025-12-30 14:37:40'),
(28, 'Edit permissions', 'Permission', '2025-12-30 14:37:40'),
(29, 'See permissions', 'Permission', '2025-12-30 14:37:40'),
(30, 'See statistics', 'Statistic', '2025-12-30 14:37:40'),
(31, 'View own orders', 'Statistic', '2025-12-30 14:37:40');

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
(1, 'Bông tai cao cấp Biz', 480200, 4, 2, '../assets/imgs/1767353952_bt3.2.jpg', '../assets/imgs/1767353952_1_bt3.jpg', '../assets/imgs/1767353952_2_bt3.1.jpg', 'Sản phẩm này rất đẹp', 5, '2025-11-20', '2026-01-02', 0, 1, 1, 1),
(2, ' Bông tai ngọc trai', 4750000, 4, 5, '../assets/imgs/1765213508_bt1.2.jpg', '../assets/imgs/1765213508_1_bt1.3.jpg', '../assets/imgs/1765213508_2_bt1.jpg', 'Sản phẩm hot nhất hiện nay', 19, '2025-11-20', '2025-12-09', 0, 1, 1, 1),
(3, 'Bông tai Louis Vuitton', 7350920, 4, 5, '../assets/imgs/1764694303_btLV.jpg', '', '', 'Sản phẩm hot nhất hiện nay', 46, '2025-11-20', '2026-01-01', 0, 1, 1, 1),
(4, 'Dây chuyền Cartier', 6586300, 2, 3, '../assets/imgs/1764694359_Dc_cartier.jpg', '', '', 'Sản phẩm hot nhất hiện nay', 50, '2025-11-20', '2025-12-06', 0, 1, 1, 1),
(5, 'Dây chuyền ngọc trai', 10288500, 2, 5, '../assets/imgs/1764694403_DCngoctrai.jpg', '', '', 'Sản phẩm hot nhất hiện nay', 49, '2025-11-20', '2026-01-01', 0, 1, 1, 1),
(6, 'Dây chuyền Tiffany & ', 40725313, 2, 5, '../assets/imgs/1764694560_dctiffanico.jpg', '', '', 'Dây chuyền thiết kế tinh xảo đến từ nhà model Tiffany & Co', 48, '2025-11-20', '2026-01-02', 0, 1, 1, 1),
(7, 'Lắc tay vàng', 25667105, 5, 5, '../assets/imgs/1764694825_lt2.3.jpg', '', '', 'Một chiếc lắc tay basic', 20, '2025-11-20', '2025-12-03', 0, 1, 1, 1),
(8, 'Lắc tay cỏ 4 lá ', 6000000, 5, 0, '../assets/imgs/1764694892_lt3..jpg', '', '', 'Lắc tay cỏ 4 lá', 20, '2025-11-20', '2025-12-06', 0, 1, 1, 1),
(9, 'Lắc tay vàng khắc tên', 9223682, 5, 2, '../assets/imgs/1764694948_lt4.1.webp', '', '', 'Lắc tay khắc tên', 18, '2025-11-20', '2026-01-02', 0, 1, 1, 1),
(10, 'Lắc tay đồng xu', 7851750, 5, 5, '../assets/imgs/1764695041_lt5.1.webp', '', '', 'Một thiết kế tinh xảo ', 10, '2025-11-20', '2025-12-06', 0, 1, 1, 1),
(11, 'Lắc tay Cartier', 6000000, 5, 0, '../assets/imgs/1764695172_lt7.1.jpg', '', '', 'Thiết kế xa xỉ đến từ Cartier', 10, '2025-11-20', '2025-12-06', 0, 1, 1, 1),
(12, 'Dây chuyền mặt trăng', 30118144, 2, 2, '../assets/imgs/1764695108_lt6.1.webp', '../assets/imgs/1764695108_1_lt6.webp', '../assets/imgs/1764695108_2_lt62.webp', 'Thiết kế nhỏ nhỏ xinh xinh', 18, '2025-11-20', '2025-12-03', 0, 1, 1, 1),
(13, 'Dây chuyền ba sợi', 45000000, 2, 10, '../assets/imgs/1764695978_vc1.2.jpg', '../assets/imgs/1764695978_1_vc1.3.jpg', '../assets/imgs/1764695978_2_vc1.jpg', 'Đây là một sợi dây chuyền có giá trị cao', 0, '2025-11-20', '2025-12-03', 0, 1, 1, 1),
(14, 'Lắc tay đính kim cương', 6588344, 5, 2, '../assets/imgs/1764695282_lt8.jpg', '', '', 'Lắc tay full kim cương biểu tượng của sự xa xỉ', 4, '2025-11-20', '2026-01-02', 0, 1, 1, 1),
(15, 'Nhẫn vàng đính kim cương', 47059600, 1, 2, '../assets/imgs/1764695353_n2.1.jpg', '', '', 'Nhẫn vàng kiểu đính kim cương ở giữa làm điểm nhấn ', 4, '2025-11-20', '2025-12-08', 0, 1, 1, 1),
(16, 'Nhẫn kim cương kiểu', 7000000, 1, 0, '../assets/imgs/1764695445_n3.1.jpg', '', '', 'Nhẫn kim cương với thiết kế uốn lượn tinh xảo', 19, '2025-11-20', '2025-12-11', 0, 1, 1, 1),
(17, 'Nhẫn chiếc lá', 9000000, 1, 0, '../assets/imgs/1764695524_n4.2.jpg', '', '', 'Thiết kế tạo điểm nhấn bởi những chiếc lá', 20, '2025-11-20', '2025-12-06', 0, 1, 1, 1),
(18, 'Nhẫn vàng Ý', 6000000, 1, 0, '../assets/imgs/1764695595_nhan2.jpg', '', '', 'Nhẫn kiểu ', 20, '2025-11-20', '2025-12-06', 0, 1, 1, 1),
(19, 'Dây chuyền kim cương Dior', 10000000, 2, 0, '../assets/imgs/1764695668_vc3.webp', '', '', 'Một thiết kế cực kì kì công đến từ nhà model Dior', 3, '2025-11-20', '2025-12-06', 0, 1, 1, 1),
(29, 'Vòng tay Dior', 13835522, 5, 2, '../assets/imgs/1764581142_lactaydior.jpg', '../assets/imgs/1764581142_1_lactaydior1.jpg', '../assets/imgs/1764581142_2_lactaydior2.jpg', 'Lắc tay xinh xinh', 10, '2025-12-01', '2025-12-02', 0, 1, 1, 1),
(30, 'Vòng tay Louis Vuitton', 470741, 5, 1, '../assets/imgs/1767344751_122026.jpg', '../assets/imgs/1767344751_1_122026.2.jpg', '../assets/imgs/1767344751_2_122026.1.jpg', 'Vòng tay đến từ nhà model xa xỉ Louis Vuitton', 6, '2026-01-02', '2026-01-02', 0, 1, 1, 1),
(32, 'Dây chuyền 18K', 645658, 2, 2, '../assets/imgs/1767347188_dc111.jpg', '../assets/imgs/1767347188_1_dc112.jpg', '../assets/imgs/1767347188_2_dc113.jpg', 'Dây chuyền 18K', 36, '2026-01-02', '2026-01-02', 0, 1, 1, 1);

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
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `isDeleted` tinyint(4) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `role`
--

INSERT INTO `role` (`id`, `name`, `description`, `isDeleted`, `created_at`) VALUES
(1, 'Admin', 'Quản trị viên cao nhất - có toàn quyền hệ thống', 0, '2025-12-30 14:37:40'),
(2, 'Staff', 'Nhân viên - quản lý sản phẩm, đơn hàng, nhập hàng, liên hệ', 0, '2025-12-30 14:37:40'),
(3, 'Customer', 'Khách hàng - chỉ xem sản phẩm và gửi liên hệ', 0, '2025-12-30 14:37:40');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `role_permission`
--

CREATE TABLE `role_permission` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `isAllowed` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(32, 2, 5, 1),
(33, 2, 6, 1),
(34, 2, 7, 1),
(35, 2, 8, 1),
(36, 2, 9, 1),
(37, 2, 10, 1),
(38, 2, 11, 1),
(39, 2, 12, 1),
(40, 2, 13, 1),
(41, 2, 14, 1),
(42, 2, 15, 1),
(43, 2, 16, 1),
(44, 2, 17, 1),
(45, 2, 18, 1),
(46, 2, 19, 1),
(47, 2, 20, 1),
(48, 2, 21, 1),
(49, 2, 22, 1),
(50, 2, 23, 1),
(51, 2, 24, 1),
(52, 2, 25, 1),
(53, 2, 26, 1),
(54, 2, 27, 1),
(55, 2, 30, 1),
(56, 2, 31, 1),
(63, 3, 12, 1),
(64, 3, 19, 1),
(65, 3, 23, 1),
(66, 3, 31, 1);

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
(6, 'Dior', '888 Nguyễn Văn Linh-Đà Nẵng', '099987654', 0),
(7, 'Louis Vuitton', '234 Hoàng Diệu - TP Đà Nẵng', '0192837465', 0);

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
  `token_expiry` datetime DEFAULT NULL,
  `avatar` varchar(255) DEFAULT '/public/assets/imgs/user.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`id`, `fullname`, `email`, `phone_number`, `password`, `role_id`, `created_at`, `updated_at`, `deleted`, `reset_token`, `token_expiry`, `avatar`) VALUES
(1, 'Diệu Thảo', 'dieuthao1809206@gmail.com', '0347367621', '$2a$12$L4AwLzAJb662zW1CD/tpHOVRnFIYQbj2q8rd.fdTrOk9Ccq0S7H82', 1, '2025-11-20', '2025-12-30', 0, NULL, '2025-12-30 21:39:40', '../assets/imgs/user.jpg'),
(2, 'Mỹ Linh', 'mylinh1234@gmail.com', '0999999999', '$2a$12$PPskDJkYOV/7EYk.W0/DGeeho0l69iOa1heL7x/2aO27X4VgNpRMS', 2, '2025-11-20', '2025-12-31', 0, NULL, '2025-12-31 01:47:41', '/assets/imgs/user.jpg'),
(3, 'Cẩm Hà', 'camha@gmail.com', '0888888888', '$2a$12$vpRbjSQCAOpjP7lg0NOrmOs9vzPF67GTjrC1AddtCea60HtuWloJK', 3, '2025-11-20', '2025-12-30', 0, NULL, '2025-12-30 21:37:17', '../assets/imgs/user.jpg'),
(4, 'ltdt', 'dieuthaole06@gmail.com', '0777777777', '$2a$12$vpRbjSQCAOpjP7lg0NOrmOs9vzPF67GTjrC1AddtCea60HtuWloJK', 2, '2025-11-20', '2025-12-31', 0, NULL, '2025-12-31 01:47:57', '../assets/imgs/avatars/1765623461_Screenshot 2025-05-10 214743.png'),
(5, 'dth', 'thao@gmail.com', '0987654321', '$2y$10$2i3KGWRUAPY.LOgfulm5feFf2W036ZiMoLPrB/ieuLUWw.vBo1T1q', 3, '2025-12-03', '2025-12-30', 0, NULL, '2025-12-30 21:37:17', '../assets/imgs/avatars/1765474371_1.jpg'),
(6, 'Mỹ Linh', 'linh@gmail.com', '0129837645', '$2y$10$.0ChxLNOgHmB19C6Mb8P9.ncko2tkcemCTajS3u9TowN/N2FhvEEm', 3, '2025-12-13', '2025-12-30', 0, NULL, '2025-12-30 21:37:17', '../assets/imgs/avatars/1765623949_Screenshot 2025-12-13 180538.png');

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_product_id` (`product_id`);

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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Chỉ mục cho bảng `role_permission`
--
ALTER TABLE `role_permission`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_role_perm` (`role_id`,`permission_id`),
  ADD KEY `permission_id` (`permission_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `import`
--
ALTER TABLE `import`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `momo_payments`
--
ALTER TABLE `momo_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT cho bảng `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT cho bảng `orderdetail`
--
ALTER TABLE `orderdetail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT cho bảng `permission`
--
ALTER TABLE `permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT cho bảng `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `role_permission`
--
ALTER TABLE `role_permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT cho bảng `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `gallery`
--
ALTER TABLE `gallery`
  ADD CONSTRAINT `fk_gallery_product` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `role_permission_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_permission_ibfk_2` FOREIGN KEY (`permission_id`) REFERENCES `permission` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
