-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3307
-- Thời gian đã tạo: Th12 01, 2025 lúc 02:26 PM
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
(3, 'Trâm Cài', 0),
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
(1, 'Dây chuyền bạc ba mặt tròn đính đá', '../assets/imgs/Dây Chuyền Bạc  Ba Mặt Tròn Đính Đá.png'),
(2, 'Dây chuyền bạc đính ngọc trai', '../assets/imgs/Dây Chuyền Bạc  Đính Ngọc Trai.png'),
(3, 'Dây chuyền bạc mạ vàng hồng 14k mặt hình chữ 0', '../assets/imgs/Dây Chuyền Bạc  Mạ Vàng Hồng 14k Mặt Hình Chữ O.png'),
(4, 'Dây chuyền bạc mặt trái tiêm nhiều màu', '../assets/imgs/Dây Chuyền Bạc  Mặt Trái Tim Nhiều Màu.png'),
(5, 'Dây chuyền bạc vô cực', '../assets/imgs/Dây Chuyền Bạc  Vô Cực.png'),
(6, 'Dây chuyền bạc Disney x mặt dây xe bí ngô', '../assets/imgs/Dây Chuyền Bạc Disney x Mặt Dây Xe Bí Ngô.png'),
(7, 'Dây chuyền bạc Game Of Thrones x mặt hình rồng đính đá pha lê đỏ', '../assets/imgs/Dây Chuyền Bạc Game Of Thrones x Mặt Hình Rồng Đính Pha Lê Đỏ.png'),
(8, 'Dây chuyền bạc mạ vàng 14k chuỗi đính ngọc trai', '../assets/imgs/Dây Chuyền Bạc Mạ Vàng 14K Chuỗi Đính Ngọc Trai.png'),
(9, 'Dây chuyền bạc mạ vàng 14k mặt bông hoa đính đá', '../assets/imgs/Dây Chuyền Bạc Mạ Vàng 14k Mặt Bông Hoa Đính Đá.png'),
(10, 'Dây chuyền bạc mạ vàng 14k mặt tròn đính đá', '../assets/imgs/Dây Chuyền Bạc Mạ Vàng 14k Mặt Tròn Đính Đá.png'),
(11, 'Nhẫn gắn kim cương cao cấp', '../assets/imgs/Nhẫn gắn kim cương cao cấp.png'),
(12, 'Nhẫn ngọc trai cao cấp', '../assets/imgs/Nhẫn ngọc trai cao cấp.png'),
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
  `isDeleted` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `order`
--

INSERT INTO `order` (`id`, `fullname`, `email`, `phone_number`, `address`, `note`, `order_date`, `status`, `total_money`, `user_id`, `isDeleted`) VALUES
(1, 'Diệu Thảo', 'dieuthao1809206@gmail.com', '0347367621', 'Lê Văn Hiến, Đà Nẵng', 'Che tên sản phẩm', '2025-11-20', 0, 670000, 1, 0),
(2, 'Mỹ Linh', 'mylinh1234@gmail.com', '0999999999', 'Hoà Nhơn, Đà Nẵng', 'Đóng gói sản phẩm cẩn thận', '2025-11-20', 0, 4400000, 2, 0),
(3, 'Cẩm Hà', 'camha@gmail.com', '0888888888', 'Thượng Đức, Đà Nẵng', 'Vận chuyển cẩn thận', '2025-11-20', 0, 2518000, 3, 0),
(4, 'ltdt', 'dieuthaole06@gmail.com', '0777777777', 'Hòa Khánh, Đà Nẵng', 'Che tên sản phẩm', '2025-11-20', 0, 10785000, 4, 0),
(5, 'ltdt', 'dieuthaole06@gmail.com', '0777777777', '420/30 , Lê Văn Hiến, Việt Nam', 'Đóng gói cẩn thận', '2025-11-30', 0, NULL, 4, 0),
(6, 'ltdt', 'dieuthaole06@gmail.com', '0777777777', '420/30 , Lê Văn Hiến, Việt Nam', 'ok', '2025-12-01', 0, 1570900, 4, 0);

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
(12, 6, 4, 510300, 3, 1530900);

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
(1, 'Bông tai cao cấp Biz', 315000, 4, 10, '../assets/imgs/img1.png', NULL, NULL, 'Sản phẩm này rất đẹp', 0, '2025-11-20', NULL, 0, 1, 1, 1),
(2, 'Nhẫn vòng ADV', 600163, 1, 5, '../assets/imgs/Nhẫn vòng ADV.png', NULL, NULL, 'Sản phẩm hot nhất hiện nay', 8, '2025-11-20', '2025-11-30', 0, 1, 1, 1),
(3, 'Nhẫn vàng cao cấp', 460952, 1, 13, '../assets/imgs/Nhẫn vàng cao cấp.png', NULL, NULL, 'Sản phẩm hot nhất hiện nay', 135, '2025-11-20', '2025-11-20', 0, 1, 1, 1),
(4, 'Nhẫn hồng khắc tê', 459270, 1, 10, '../assets/imgs/Nhẫn hồng khắc tê.png', NULL, NULL, 'Sản phẩm hot nhất hiện nay', 87, '2025-11-20', '2025-12-01', 0, 1, 1, 1),
(5, 'Nhẫn tình yêu', 644000, 1, 8, '../assets/imgs/Nhẫn tình yêu.png', NULL, NULL, 'Sản phẩm hot nhất hiện nay', 0, '2025-11-20', NULL, 0, 1, 1, 1),
(6, 'Trâm Cài Tóc Bằng Gỗ Cao Cấp', 648000, 3, 10, '../assets/imgs/Trâm Cài Tóc Bằng Gỗ Cao Cấp.png', NULL, NULL, 'Sản phẩm tốt nhất cho người giàu', 200, '2025-11-20', '2025-11-20', 0, 1, 1, 1),
(7, 'Dây chuyền bạc Moments mạ vàng 14K vô cực', 540000, 2, 10, '../assets/imgs/Dây Chuyền Bạc Moments Mạ Vàng 14K Vô Cực.png', NULL, NULL, 'Đây là một sợi dây chuyền có giá trị cao', 0, '2025-11-20', NULL, 0, 1, 1, 1),
(8, 'Dây chuyền bạc mặt trái tim', 600000, 2, 0, '../assets/imgs/Dây Chuyền Bạc Mặt Trái Tim.png', NULL, NULL, 'Đây là một sợi dây chuyền có giá trị cao', 0, '2025-11-20', NULL, 0, 1, 1, 1),
(9, 'Nhẫn Bạc Moments Vương Miện Đính Đá', 750000, 1, 0, '../assets/imgs/Nhẫn Bạc Moments Vương Miện Đính Đá.png', NULL, NULL, 'Đây là một sợi dây chuyền có giá trị cao', 0, '2025-11-20', NULL, 0, 1, 1, 1),
(10, 'Nhẫn Bạc Mặt Đính Đá Hình Ngôi Sao', 870000, 2, 0, '../assets/imgs/Nhẫn Bạc Mặt Đính Đá Hình Ngôi Sao.png', NULL, NULL, 'Đây là một sợi dây chuyền có giá trị cao', 0, '2025-11-20', NULL, 0, 1, 1, 1),
(11, 'Dây chuyền bạc mặt trái tim', 600000, 2, 0, '../assets/imgs/Dây Chuyền Bạc Mặt Trái Tim.png', NULL, NULL, 'Đây là một sợi dây chuyền có giá trị cao', 0, '2025-11-20', NULL, 0, 1, 1, 1),
(12, 'Trâm Cài Tóc Hoa Mai Trắng', 320000, 3, 0, '../assets/imgs/Trâm Cài Tóc Hoa Mai Trắng.png', NULL, NULL, 'Đây là một Trâm Cài Tóc Đơn Giản', 0, '2025-11-20', NULL, 0, 1, 1, 1),
(13, 'Trâm Cài Tóc Ngọc Bích Đơn Giản', 576000, 3, 10, '../assets/imgs/Trâm Cài Tóc Ngọc Bích Đơn GIẢN.png', NULL, NULL, 'Đây là một sợi dây chuyền có giá trị cao', 0, '2025-11-20', NULL, 0, 1, 1, 1),
(14, 'Trâm Phượng Hoàng Cổ Thi tua rua đèn lồng gắn ngọc', 999999, 3, 0, '../assets/imgs/Trâm Phượng Hoàng Cổ Thi tua rua đèn lồng gắn ngọc.png', NULL, NULL, 'Trâm Phượng Hoàng Cổ Thi tua rua đèn lồng gắn ngọc là sản phẩm được làm thủ công chất liệu bạc ta 99\r\n\r\n* Thông tin chi tiết về sản phẩm\r\n\r\n– Chất liệu : bạc 99\r\n\r\n– Kích thước : dài 17cm\r\n\r\n– Trọng lượng : ~ 45garm', 0, '2025-11-20', NULL, 0, 1, 1, 1),
(15, 'Hoa Tai Bạc Timeless Dạng Rơi Chuỗi Đá', 800000, 4, 0, '../assets/imgs/Hoa Tai Bạc Timeless Dạng Rơi Chuỗi Đá.png', NULL, NULL, 'Tôn lên khuôn mặt của bạn với Bông Tai Thả Tám Viên Đá Lấp Lánh của chúng tôi. Chế tác từ bạc sterling, những chiếc bông tai này có một hàng gồm 8 viên đá cubic zirconia trong suốt, treo nhẹ nhàng theo cặp. Thiết kế độc đáo này cho phép phối phong cách linh hoạt, trong khi nút tai hình trái tim đảm bảo sự vững chắc. Thể hiện bản thân với cặp bông tai nhẹ nhàng, lấp lánh này - hoàn hảo để thêm một chút sang trọng cho bất kỳ dịp nào. Được bán theo cặp, những chiếc bông tai thả bạc sterling này là ', 0, '2025-11-20', NULL, 0, 1, 1, 1),
(16, 'Hoa Tai Bạc Timeless Dạng Rơi Đính Ngọc Trai', 700000, 4, 0, '../assets/imgs/Hoa Tai Bạc Timeless Dạng Rơi Đính Ngọc Trai.png', NULL, NULL, 'Biến sự thanh lịch thành khẩu hiệu của bạn với Bông Tai Hạt Nước Ngọt được Xử Lý của chúng tôi. Chế tác từ bạc sterling, những chiếc bông tai thả này có một dãy bốn hạt nước ngọt được xử lý trên mỗi chiếc. Hình mô tả chuỗi kết nối từng viên ngọc, tạo ra một trò chơi chiều sâu độc đáo. Có ý đồ khác nhau về kích thước, những viên ngọc này tượng trưng cho vẻ đẹp, tình yêu và sự khôn ngoan. Hoàn hảo kết hợp với nút tai hình trái tim, những chiếc bông tai này là một bổ sung cổ điển cho bộ sưu tập tra', 0, '2025-11-20', NULL, 0, 1, 1, 1),
(17, 'Hoa Tai Bạc Timeless Dạng Vòng Đính Đá Pha Lê Xanh', 900000, 4, 0, '../assets/imgs/Hoa Tai Bạc Timeless Dạng Vòng Đính Đá Pha Lê Xanh.png', NULL, NULL, 'Diễn đạt sâu sắc tình yêu của bạn với Hoa Tai Bạc Timeless Dạng Vòng Đính Đá Pha Lê Xanh. Những chiếc bông tai bạc  thanh lịch này mỗi chiếc đều có một viên đá Pha lê Xanh hình Chữ Nhật lấp lánh ở trung tâm tạo nên một diện mạo hiện đại và cao cấp.', 0, '2025-11-20', NULL, 0, 1, 1, 1),
(18, 'Hoa Tai Bạc Timeless Đính Ngọc Trai Cỡ Lớn', 600000, 4, 0, '../assets/imgs/Hoa Tai Bạc Timeless Đính Ngọc Trai Cỡ Lớn.png', NULL, NULL, 'Giữ cho nó cổ điển với Bông Tai Cài Ngọc Nước Ngọt 7mm bằng bạc sterling này. Những viên ngọc lấp lánh có kích thước 7mm, được đặt một cách tinh tế, thể hiện sự thanh lịch vĩnh cửu. Được đảm bảo bằng nút tai hình trái tim, cặp bông tai này vừa cổ điển vừa hiện đại. Là một sự bổ sung hoàn hảo cho bộ sưu tập bông tai của bạn, những chiếc bông tai cài ngọc này tôn vinh vẻ đẹp, sự khôn ngoan và tình yêu được tượng trưng bởi ngọc nước ngọt được xử lý. Lưu ý rằng mỗi viên ngọc nước ngọt được xử lý là ', 0, '2025-11-20', NULL, 0, 1, 1, 1),
(19, 'Hoa Tai Bạc Timeless Vòng Đá Phối Ngọc Trai', 600000, 4, 0, '../assets/imgs/Hoa Tai Bạc Timeless Vòng Đá Phối Ngọc Trai.png', NULL, NULL, 'Kết hợp sự thanh lịch và hiện đại với Bông Tai Cài Ngọc Nước Ngọt & Vòng Tròn Lấp Lánh bằng bạc sterling của chúng tôi. Thiết kế độc đáo với một viên ngọc lấp lánh được đặt trong một vòng tròn lấp lánh bằng cubic zirconia trong suốt. Viên ngọc lệch tâm tạo nên một chút không đối xứng, được bổ sung bởi nút tai hình trái tim. Được bán theo cặp, những chiếc bông tai này kết hợp giữa ngọc truyền thống với thiết kế hiện đại, tôn vinh vẻ đẹp, sự khôn ngoan và tình yêu. Lưu ý rằng mỗi viên ngọc nước ng', 0, '2025-11-20', NULL, 0, 1, 1, 1),
(20, 'Dây Chuyền Bạc Disney x Mặt Dây Xe Bí Ngô', 600000, 2, 0, '../assets/imgs/Dây Chuyền Bạc Disney x Mặt Dây Xe Bí Ngô.png', NULL, NULL, 'Theo đuổi lời kêu gọi của chiếc bóng với Dây Chuyền Disney Cinderella Carriage Collier từ bộ sưu tập Disney x Pandora. Chiếc dây chuyền bạc sterling này có một mặt nạ tinh tế được lấy cảm hứng từ chiếc xe bí ngô phù thủy của Cinderella, với một viên đá hình lá cẩm màu xanh được bao quanh bởi các chi tiết mở xoắn. Những viên đá cubic zirconia nhỏ lấp lánh trên bánh xe và thân bí ngô. Mặt nạ được cố định trên dây chuyền và có thể điều chỉnh được thành ba chiều dài. Kết hợp nó với đôi bông tai nút ', 0, '2025-11-20', NULL, 0, 1, 1, 1),
(21, 'Hoa Tai Bạc Disney x Xe Bí Ngô', 600000, 2, 0, '../assets/imgs/Hoa Tai Bạc Disney x Xe Bí Ngô.png', NULL, NULL, '', 0, '2025-11-20', NULL, 0, 1, 1, 1),
(22, 'Nhẫn Bạc Moments Đá Tháng Sinh Tháng 9 Pha Lê Xanh Dương', 600000, 1, 0, '../assets/imgs/Nhẫn Bạc Moments Đá Tháng Sinh Tháng 9 Pha Lê Xanh Dương.png', NULL, NULL, 'Đeo một biểu tượng của sự vĩnh cửu với Nhẫn Blue Eternity Circle. Chiếc nhẫn bạc sterling này có một viên đá pha lê màu xanh lấp lánh được đặt bằng móng vuốt. Dải nhẫn bóng mịn xoay quanh viên đá trung tâm trong một mô hình vô cùng mở rộng. Cho dù bạn muốn mang theo một lời nhắc về tình yêu vĩnh cửu hay một biểu tượng của niềm vui vô tận trải qua từng khoảnh khắc, chiếc nhẫn vô cùng màu sắc này sẽ mang đến ý nghĩa lấp lánh cho diện mạo của bạn.', 0, '2025-11-20', NULL, 0, 1, 1, 1),
(23, 'Dây Chuyền Bạc Game Of Thrones x Mặt Hình Rồng Đính Pha Lê Đỏ', 600000, 2, 0, '../assets/imgs/Dây Chuyền Bạc Game Of Thrones x Mặt Hình Rồng Đính Pha Lê Đỏ.png', NULL, NULL, 'Đối mặt với các yếu tố với Dây Chuyền Dây Nhà Rồng trong trò chơi Ngôi Nhà của Rồng. Được làm từ bạc Sterling, dây chuyền có độ dài có thể điều chỉnh này có một mặt dây chuyền biểu thị một con rồng trong trò chơi Ngôi Nhà của Rồng nằm cuộn tròn với cánh rộng và đuôi vòng quanh một viên đá nhân tạo màu đỏ. Một viên đá màu đỏ khác lấp lánh từ đầu của dây chuyền mặt dây chuyền. Đeo chiếc mặt dây chuyền này như một biểu tượng cho những bí ẩn vĩ đại và mạnh mẽ của thế giới - cả trong hư cấu và thực t', 0, '2025-11-20', NULL, 0, 1, 1, 1),
(24, 'Nhẫn Bạc Timeless Lượn Sóng', 600000, 2, 0, '../assets/imgs/Nhẫn Bạc Timeless Lượn Sóng.png', NULL, NULL, 'Được chế tác từ bạc sterling, chiếc Nhẫn Polished Wave của chúng tôi uốn cong để giống như sự chuyển động của một đợt sóng, với bề mặt được đánh bóng mịn. Xếp chồng nhiều chiếc nhẫn bạc sterling cùng nhau hoặc kết hợp với phiên bản pavé trong các gam màu kim loại khác nhau để tạo nên một diện mạo đương đại mà bạn sẽ yêu thích suốt nhiều năm tới.', 0, '2025-11-20', NULL, 0, 1, 1, 1),
(29, 'Vòng tay Dior', 14406000, 5, 2, '../assets/imgs/1764581142_lactaydior.jpg', '../assets/imgs/1764581142_1_lactaydior1.jpg', '../assets/imgs/1764581142_2_lactaydior2.jpg', 'Lắc tay xinh xinh', 10, '2025-12-01', '2025-12-01', 0, 1, 1, 1);

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
(4, 'ltdt', 'dieuthaole06@gmail.com', '0777777777', '$2a$12$vpRbjSQCAOpjP7lg0NOrmOs9vzPF67GTjrC1AddtCea60HtuWloJK', 3, '2025-11-20', NULL, 0, NULL, NULL);

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
-- AUTO_INCREMENT cho bảng `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `orderdetail`
--
ALTER TABLE `orderdetail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
