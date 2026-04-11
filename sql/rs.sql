SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+08:00"; -- Ginhimo ko +8 para sa oras sa Pilipinas

-- --------------------------------------------------------
-- Table 1: users (Accounts & Duty Schedule)
-- --------------------------------------------------------
CREATE TABLE `users` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(150) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `role` VARCHAR(20) NOT NULL DEFAULT 'staff',
  `duty_day` VARCHAR(20) DEFAULT 'Not Set',
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping accounts (Riverside Cafe Team)
INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `duty_day`) VALUES
(5, 'Riverside Cafe Admin', 'rs@gmail.com', '$2y$12$g3CM3sNi9ys9KdRC3t/T3O5sOFIBtKIkyoi6Vf2l6BIb/IX7WMdbi', 'admin', 'Everyday'),
(6, 'Ronelo Mabayag Dacillo', 'dacilloronelo@gmail.com', '$2y$12$86nVaeKSNfx5pMRDlBlcWeBtK7eMNob2oXHwe4AW1cxOwQe8Zo2/C', 'staff', 'Monday'),
(7, 'Mailen Salla Bulahan', 'mailen@gmail.com', '$2y$12$2hbZ791Ja30XiOPExCGrReBtsEFxoAReIDPzLbY6byV6jD0/6k9DK', 'staff', 'Tuesday');

-- --------------------------------------------------------
-- Table 2: staff_logs (Duty History & Duration)
-- --------------------------------------------------------
CREATE TABLE `staff_logs` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `staff_name` VARCHAR(100) NOT NULL,
  `login_time` DATETIME NOT NULL,
  `logout_time` DATETIME DEFAULT NULL,
  `duration` VARCHAR(50) DEFAULT NULL,
  `status` ENUM('On Duty', 'Out') DEFAULT 'On Duty',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------
-- Table 3: products (Riverside Menu)
-- --------------------------------------------------------
CREATE TABLE `products` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `product_name` VARCHAR(150) NOT NULL,
  `price` DECIMAL(10,2) NOT NULL,
  `category` VARCHAR(100) DEFAULT NULL,
  `stock` INT(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping products
INSERT INTO `products` (`id`, `product_name`, `price`, `category`, `stock`) VALUES
(2, 'Cappuccino', 110.00, 'Coffee', 29),
(3, 'Spanish Latte', 135.00, 'Coffee', 25),
(4, 'Chocolate Cookie', 45.00, 'Snacks', 14),
(5, 'Clubhouse Sandwich', 85.00, 'Snacks', 5),
(7, 'Hot Brewed Coffee', 49.00, 'Hot Coffee', 10);

-- --------------------------------------------------------
-- Table 4: orders (Sales Summary)
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

-- --------------------------------------------------------
-- Table 5: order_items (Sales Details)
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

COMMIT;