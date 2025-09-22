CREATE DATABASE bakery_db;

USE bakery_db;

CREATE TABLE orders (
  id INT AUTO_INCREMENT PRIMARY KEY,
  customer_name VARCHAR(100),
  item VARCHAR(100),
  quantity INT,
  address TEXT,
  order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);