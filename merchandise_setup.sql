-- Chess Club Merchandise Table Setup
-- Run this SQL script in your MySQL database

-- Create the merchandise table
CREATE TABLE IF NOT EXISTS `merchandise` (
    `id` INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `description` TEXT,
    `price` DECIMAL(10,2) NOT NULL,
    `image` VARCHAR(255),
    `is_available` BOOLEAN DEFAULT TRUE,
    `stock_quantity` INT(11) DEFAULT 0,
    `created_at` DATETIME NOT NULL,
    `updated_at` DATETIME NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert sample merchandise data
INSERT INTO `merchandise` (`name`, `description`, `price`, `image`, `is_available`, `stock_quantity`, `created_at`, `updated_at`) VALUES
('Chess Club T-Shirt', 'Premium cotton T-shirt with exclusive Chess Club design. Available in various sizes.', 25.00, '/images/merch_tshirt.jpg', 1, 50, NOW(), NOW()),
('Chess Mug', 'Ceramic mug featuring elegant chess piece design. Perfect for coffee or tea.', 12.00, '/images/merch_mug.jpg', 1, 30, NOW(), NOW()),
('Chess Set', 'Classic wooden chess set for club members. Includes board and pieces.', 40.00, '/images/merch_set.jpg', 1, 20, NOW(), NOW()),
('Chess Club Cap', 'Stylish cap with embroidered Chess Club logo. Adjustable fit.', 15.00, NULL, 1, 25, NOW(), NOW()),
('Chess Timer', 'Digital chess timer for tournament play. Easy to use and reliable.', 35.00, NULL, 0, 0, NOW(), NOW()),
('Chess Strategy Book', 'Comprehensive guide to chess strategies and tactics for all levels.', 18.00, NULL, 1, 3, NOW(), NOW());

-- Verify the data was inserted
SELECT * FROM `merchandise`; 