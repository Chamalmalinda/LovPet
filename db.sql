CREATE DATABASE lovpet_db;
USE lovpet_db;

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  fullname VARCHAR(100),
  email VARCHAR(100) UNIQUE,
  address VARCHAR(255),
  contact VARCHAR(20),
  role ENUM('buyer', 'seller') NOT NULL,
  password VARCHAR(255),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE pets (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
  category VARCHAR(50),
  breed VARCHAR(100),
  gender VARCHAR(10),
  age INT,
  color VARCHAR(50),
  address VARCHAR(255),
  contact VARCHAR(20),
  vaccinated VARCHAR(10),
  price DECIMAL(10,2),
  description TEXT,
  image VARCHAR(255)
);

CREATE TABLE lost_notices (
  id INT AUTO_INCREMENT PRIMARY KEY,
  pet_name VARCHAR(100) NOT NULL,
  breed VARCHAR(100) NOT NULL,
  location VARCHAR(255) NOT NULL,
  contact VARCHAR(15) NOT NULL,
  description TEXT NOT NULL,
  image VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS pets (
  id INT AUTO_INCREMENT PRIMARY KEY,
  image VARCHAR(255),
  name VARCHAR(100),
  category VARCHAR(50),
  breed VARCHAR(100),
  gender VARCHAR(10),
  age INT,
  color VARCHAR(50),
  address VARCHAR(255),
  contact VARCHAR(20),
  vaccinated VARCHAR(10),
  price DECIMAL(10,2),
  description TEXT
);

CREATE TABLE feedbacks (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  message TEXT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE products (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  brand VARCHAR(100) NOT NULL,
  quantity VARCHAR(50) NOT NULL,
  price DECIMAL(10, 2) NOT NULL,
  description TEXT,
  image LONGBLOB NOT NULL
);

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `total_amount` decimal(10,2) NOT NULL,
  `items_count` int(11) NOT NULL DEFAULT 1,
  `status` enum('Pending','Completed','Cancelled','Processing') NOT NULL DEFAULT 'Pending',
  `payment_method` varchar(50) DEFAULT NULL,
  `delivery_address` text DEFAULT NULL,
  `contact_number` varchar(20) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `order_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `item_type` enum('pet','product') NOT NULL DEFAULT 'pet',
  `item_id` int(11) DEFAULT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_breed` varchar(255) DEFAULT NULL,
  `item_price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `item_image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE pets ADD seller_id INT NOT NULL;











