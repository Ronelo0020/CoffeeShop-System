SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- --------------------------------------------------------
-- Table 1: users (Staff & Admin Accounts)
-- --------------------------------------------------------
CREATE TABLE `users` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(150) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `role` VARCHAR(20) NOT NULL DEFAULT 'staff',
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping initial users
INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`) VALUES
(5, 'Riverside Cafe', 'rs@gmail.com', '$2y$12$g3CM3sNi9ys9KdRC3t/T3O5sOFIBtKIkyoi6Vf2l6BIb/IX7WMdbi', 'admin'),
(6, 'Ronelo Mabayag Dacillo', 'dacilloronelo@gmail.com', '$2y$12$86nVaeKSNfx5pMRDlBlcWeBtK7eMNob2oXHwe4AW1cxOwQe8Zo2/C', 'staff');

-- --------------------------------------------------------
-- Table 2: products (Menu & Inventory)
-- --------------------------------------------------------
CREATE TABLE `products` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `product_name` VARCHAR(150) DEFAULT NULL,
  `price` DECIMAL(10,2) NOT NULL,
  `category` VARCHAR(100) DEFAULT NULL,
  `stock` INT(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping initial products
INSERT INTO `products` (`id`, `product_name`, `price`, `category`, `stock`) VALUES
(2, 'Cappuccino', 110.00, 'Coffee', 29),
(3, 'Spanish Latte', 135.00, 'Coffee', 25),
(4, 'Chocolate Cookie', 45.00, 'Snacks', 14),
(5, 'Clubhouse Sandwich', 85.00, 'Snacks', 6),
(7, 'Hot Brewed Coffee', 49.00, 'Hot Coffee', 10);

-- --------------------------------------------------------
-- Table 3: orders (Transactions)
-- --------------------------------------------------------
CREATE TABLE `orders` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `user_id` INT(11) NOT NULL,
  `payment_method` VARCHAR(20) NOT NULL DEFAULT 'Cash',
  `gcash_reference` VARCHAR(50) DEFAULT NULL,
  `payment_screenshot` VARCHAR(255) DEFAULT NULL,
  `total_amount` DECIMAL(10,2) NOT NULL,
  `payment` DECIMAL(10,2) DEFAULT NULL,
  `change_amount` DECIMAL(10,2) DEFAULT NULL,
  `order_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `gcash_reference` (`gcash_reference`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `fk_user_order` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping sample orders (Para sa Chart/Analytics niyo)
INSERT INTO `orders` (`id`, `user_id`, `payment_method`, `gcash_reference`, `payment_screenshot`, `total_amount`, `payment`, `change_amount`, `order_date`) VALUES
(1, 6, 'Cash', NULL, NULL, 45.00, 45.00, 0.00, '2026-03-30 21:07:36'),
(6, 5, 'GCash', '0021556789123', '1775276936_12cc5bc1ca954e6d49c8.jpg', 85.00, NULL, NULL, '2026-04-04 04:28:56');

-- --------------------------------------------------------
-- Table 4: order_items (Transaction Details)
-- --------------------------------------------------------
CREATE TABLE `order_items` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `order_id` INT(11) NOT NULL,
  `product_id` INT(11) NOT NULL,
  `quantity` INT(11) NOT NULL,
  `price` DECIMAL(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `fk_order_item` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_product_item` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping sample order items
INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(1, 1, 4, 1, 45.00),
(9, 6, 5, 1, 85.00);

COMMIT;