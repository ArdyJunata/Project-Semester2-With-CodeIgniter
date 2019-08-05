-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Agu 2019 pada 20.02
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `login_ci`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `cart`
--

INSERT INTO `cart` (`id`, `quantity`, `total_price`, `item_id`, `user_id`) VALUES
(25, 1, 3100000, 7, 14),
(32, 1, 4500000, 1, 4),
(33, 1, 1250000, 2, 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Model Kit'),
(2, 'Gundam');

-- --------------------------------------------------------

--
-- Struktur dari tabel `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `image` varchar(100) NOT NULL,
  `date_upload` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `items`
--

INSERT INTO `items` (`id`, `name`, `price`, `quantity`, `category_id`, `user_id`, `image`, `date_upload`) VALUES
(1, 'Pg Astray Blue Frame', 4500000, 3, 1, 13, 'PG ASTRAY BLUE FRAME.jpg', 1564041723),
(2, 'Pg Exia Repair', 1250000, 3, 2, 13, 'PG EXIA REPAIR.jpg', 1564041723),
(8, 'ashiap', 2000, 1, 1, 4, 'PG_SEVEN_SWORD1.jpg', 1564847686);

-- --------------------------------------------------------

--
-- Struktur dari tabel `items_ordered`
--

CREATE TABLE `items_ordered` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `buyer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `items_ordered`
--

INSERT INTO `items_ordered` (`id`, `order_id`, `item_id`, `quantity`, `buyer_id`) VALUES
(17, 15, 1, 1, 4),
(18, 16, 1, 2, 4),
(19, 16, 2, 1, 4),
(20, 17, 1, 2, 4),
(21, 18, 1, 3, 4),
(22, 19, 1, 3, 4),
(23, 21, 1, 1, 4),
(24, 24, 7, 1, 14),
(25, 25, 1, 1, 4),
(26, 26, 2, 1, 4),
(27, 27, 1, 1, 4),
(28, 28, 1, 1, 4),
(29, 29, 1, 1, 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `buyer_id` int(11) NOT NULL,
  `total_price` int(100) NOT NULL,
  `bank` varchar(100) NOT NULL,
  `date_order` datetime NOT NULL,
  `due_date` datetime NOT NULL,
  `note` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `orders`
--

INSERT INTO `orders` (`order_id`, `payment_id`, `buyer_id`, `total_price`, `bank`, `date_order`, `due_date`, `note`, `status`) VALUES
(15, 1, 4, 4500000, 'BCA', '2019-08-01 12:50:46', '2019-08-02 12:50:46', '', 'canceled'),
(16, 1, 4, 10250000, 'BSM', '2019-08-01 13:07:30', '2019-08-02 13:07:30', '', 'canceled'),
(17, 1, 4, 9000000, 'BRI', '2019-08-01 13:34:07', '2019-08-02 13:34:07', '', 'refund process'),
(18, 1, 4, 13500000, 'BCA', '2019-08-02 14:25:03', '2019-08-03 14:25:03', '', 'paid'),
(19, 1, 4, 13500000, 'BCA', '2019-08-02 14:25:47', '2019-08-03 14:25:47', '', 'unpaid'),
(20, 1, 4, 4500000, 'BRI', '2019-08-02 14:32:13', '2019-08-03 14:32:13', '', 'unpaid'),
(21, 1, 4, 4500000, 'BRI', '2019-08-02 14:32:34', '2019-08-03 14:32:34', '', 'unpaid'),
(24, 1, 14, 3100000, 'BRI', '2019-08-02 14:42:12', '2019-08-03 14:42:12', '', 'paid'),
(25, 1, 4, 4500000, 'BCA', '2019-08-03 09:35:04', '2019-08-04 09:35:04', '', 'unpaid'),
(26, 2, 4, 1250000, '-', '2019-08-03 09:38:38', '2019-08-04 09:38:38', '', 'unpaid'),
(27, 2, 4, 4500000, '-', '2019-08-03 09:41:51', '2019-08-04 09:41:51', '', 'unpaid'),
(28, 2, 4, 4500000, '-', '2019-08-03 09:42:56', '2019-08-04 09:42:56', '', 'refund process'),
(29, 2, 4, 4500000, '-', '2019-08-03 11:50:33', '2019-08-04 11:50:33', '', 'unpaid');

-- --------------------------------------------------------

--
-- Struktur dari tabel `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `payment`
--

INSERT INTO `payment` (`payment_id`, `name`) VALUES
(1, 'Transfer'),
(2, 'Cash On Delivery');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rating`
--

CREATE TABLE `rating` (
  `id` int(11) NOT NULL,
  `ratedIndex` tinyint(4) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `rating`
--

INSERT INTO `rating` (`id`, `ratedIndex`, `user_id`) VALUES
(5, 2, 3),
(6, 4, 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `refund`
--

CREATE TABLE `refund` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `buyer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `refund`
--

INSERT INTO `refund` (`id`, `order_id`, `buyer_id`) VALUES
(1, 28, 4),
(2, 28, 4),
(3, 28, 4),
(4, 17, 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `password` varchar(256) NOT NULL,
  `country` varchar(100) NOT NULL,
  `province` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `address1` varchar(100) NOT NULL,
  `postal_code` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `image`, `password`, `country`, `province`, `city`, `address1`, `postal_code`, `role_id`, `is_active`, `date_created`) VALUES
(3, 'Ardy Junata', 'ardyjunata53@gmail.com', 'caltex_logo.png', '$2y$10$PRAUTc2F2iNMJvOc1CJcqO7Owb/czJIZMapkOSSN9eRUn1J2HTkXO', '', '', '', '', 0, 1, 1, 1563718594),
(4, 'Fahturrahman Bambang', 'fahturrahman18ti@mahasiswa.pcr.ac.id', 'default.jpg', '$2y$10$lLB0atxK2sRmPj1Qio6fwOV1yd4fudcRsTwD7vNiDJaOVESqkIBuK', 'Indonesia', 'Riau', 'Pekanbaru', 'Jalan Rowosari', 29212, 2, 1, 1563779386),
(13, 'tyo', 'prastyo18ti@mahasiswa.pcr.ac.id', 'default.jpg', '$2y$10$qjpDyTnuf.hVedMctWYvu.k4r46YCDaPNxTBvehy0kMIbT7bHLSTC', '', '', '', '', 0, 1, 1, 1564041723),
(14, 'Ardy Junata - Facebook', '2215154358607449', 'default.jpg', '0', 'Indonesia', '', '', 'Inhil Tembilahan', 29213, 2, 1, 1564070663),
(15, 'ridho', 'ridho18ti@mahasiswa.pcr.ac.id', 'default.jpg', '$2y$10$cz3ege95UUTLfTm5a38agu5zh3U8AgJECkSQJv8FvLPIrKPqc8h9q', '', '', '', '', 0, 2, 1, 1564847722),
(16, 'jody', 'jody18ti@mahasiswa.pcr.ac.id', 'default.jpg', '$2y$10$5ecUa4.044NFsswQ25RSOeh3pDYfL6v0EH74Z2NJPCZNEgFdRbrNy', '', '', '', '', 0, 2, 1, 1564933155);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(3, 2, 2),
(4, 1, 3),
(5, 1, 6),
(6, 1, 2),
(7, 2, 8);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'admin'),
(2, 'User'),
(3, 'Menu'),
(6, 'Users'),
(8, 'commerce');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Administrator'),
(2, 'User');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `url` varchar(100) NOT NULL,
  `icon` varchar(100) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Dashboard', 'admin', 'fas fa-fw fa-tachometer-alt', 1),
(2, 2, 'My Profile', 'user', 'fas fa-fw fa-user', 1),
(3, 2, 'Edit Profile', 'user/edit', 'fas fa-fw fa-user-edit', 1),
(11, 6, 'User Active', 'admin/userActive', 'far fa-fw fa-user', 1),
(15, 3, 'Menu Management', 'menu', 'fa fa-fw fa-folder', 1),
(16, 3, 'Submenu Management', 'menu/submenu', 'fas fa-fw fa-folder-open', 1),
(17, 8, 'Buy Product', 'commerce', 'fas fa-fw fa-coins', 1),
(18, 8, 'Cart', 'commerce/cart', 'fas fa-fw fa-shopping-cart', 1),
(19, 8, 'Wishlist', 'commerce/wishlist', 'fas fa-fw fa-list', 1),
(20, 8, 'Sell Product', 'commerce/sell', 'fas fa-fw fa-money-check-alt', 1),
(21, 8, 'My Products', 'commerce/userItems', 'fas fa-fw  fa-caret-square-down', 1),
(22, 8, 'Ordered', 'commerce/ordered', 'fas fa-fw fa-sort', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `wishlist`
--

INSERT INTO `wishlist` (`id`, `item_id`, `user_id`) VALUES
(3, 1, 4);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `user_id_2` (`user_id`);

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `items_ordered`
--
ALTER TABLE `items_ordered`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `buyer_id` (`buyer_id`);

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `payment_id` (`payment_id`),
  ADD KEY `payment_id_2` (`payment_id`),
  ADD KEY `buyer_id` (`buyer_id`);

--
-- Indeks untuk tabel `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indeks untuk tabel `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ratedIndex` (`ratedIndex`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `refund`
--
ALTER TABLE `refund`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `buyer_id` (`buyer_id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indeks untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `menu_id` (`menu_id`);

--
-- Indeks untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_id` (`menu_id`);

--
-- Indeks untuk tabel `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `item_id` (`item_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `items_ordered`
--
ALTER TABLE `items_ordered`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT untuk tabel `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `rating`
--
ALTER TABLE `rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `refund`
--
ALTER TABLE `refund`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Ketidakleluasaan untuk tabel `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `items_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Ketidakleluasaan untuk tabel `items_ordered`
--
ALTER TABLE `items_ordered`
  ADD CONSTRAINT `items_ordered_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `items_ordered_ibfk_2` FOREIGN KEY (`buyer_id`) REFERENCES `user` (`id`);

--
-- Ketidakleluasaan untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`payment_id`) REFERENCES `payment` (`payment_id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`buyer_id`) REFERENCES `user` (`id`);

--
-- Ketidakleluasaan untuk tabel `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `rating_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Ketidakleluasaan untuk tabel `refund`
--
ALTER TABLE `refund`
  ADD CONSTRAINT `refund_ibfk_1` FOREIGN KEY (`buyer_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `refund_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`);

--
-- Ketidakleluasaan untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD CONSTRAINT `user_access_menu_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `user_role` (`id`),
  ADD CONSTRAINT `user_access_menu_ibfk_2` FOREIGN KEY (`menu_id`) REFERENCES `user_menu` (`id`);

--
-- Ketidakleluasaan untuk tabel `user_role`
--
ALTER TABLE `user_role`
  ADD CONSTRAINT `user_role_ibfk_1` FOREIGN KEY (`id`) REFERENCES `user` (`role_id`);

--
-- Ketidakleluasaan untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD CONSTRAINT `user_sub_menu_ibfk_1` FOREIGN KEY (`menu_id`) REFERENCES `user_menu` (`id`);

--
-- Ketidakleluasaan untuk tabel `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
