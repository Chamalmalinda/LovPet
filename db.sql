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

ALTER TABLE pets ADD seller_id INT NOT NULL;











