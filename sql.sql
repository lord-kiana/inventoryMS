CREATE DATABASE inventory_management;
USE inventory_management;


CREATE TABLE products (
    product_id INT AUTO_INCREMENT PRIMARY KEY,
    product_name VARCHAR(100) NOT NULL,
    category VARCHAR(50) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE stock (
    stock_id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT NOT NULL,
    location VARCHAR(100) NOT NULL,
    quantity INT DEFAULT 0,
    last_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES products(product_id)
);

CREATE TABLE stock (
    stock_id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT NOT NULL,
    location VARCHAR(100) NOT NULL,
    quantity INT DEFAULT 0,
    last_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES products(product_id)
);

CREATE TABLE orders (
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    order_type ENUM('incoming', 'outgoing') NOT NULL, -- differentiate incoming and outgoing orders
    order_status ENUM('pending', 'dispatched', 'received', 'cancelled') NOT NULL,
    supplier_customer_name VARCHAR(100), -- supplier for incoming orders or customer for outgoing orders
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE order_details (
    order_details_id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(order_id),
    FOREIGN KEY (product_id) REFERENCES products(product_id)
);

CREATE TABLE returns (
    return_id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    return_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (order_id) REFERENCES orders(order_id),
    FOREIGN KEY (product_id) REFERENCES products(product_id)
);


CREATE TABLE archive (
    archive_id INT AUTO_INCREMENT PRIMARY KEY,
    record_type ENUM('product', 'order', 'stock') NOT NULL, -- The type of record archived
    record_id INT NOT NULL, -- Refers to the original record (e.g., product_id, order_id)
    archive_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


INSERT INTO products (product_name, category, price) 
VALUES ('Widget A', 'Electronics', 19.99),
       ('Widget B', 'Furniture', 49.99),
       ('Widget C', 'Toys', 9.99);


INSERT INTO stock (product_id, location, quantity) 
VALUES (1, 'Warehouse 1', 100),
       (2, 'Warehouse 2', 50),
       (3, 'Warehouse 1', 200);

INSERT INTO orders (order_type, order_status, supplier_customer_name) 
VALUES ('incoming', 'pending', 'Supplier A');

-- Add details for this order
INSERT INTO order_details (order_id, product_id, quantity) 
VALUES (1, 1, 50),
       (1, 2, 30);

INSERT INTO orders (order_type, order_status, supplier_customer_name) 
VALUES ('outgoing', 'dispatched', 'Customer X');

-- Add details for this order
INSERT INTO order_details (order_id, product_id, quantity) 
VALUES (2, 1, 20),
       (2, 3, 10);

-- Deduct from Warehouse 1
UPDATE stock 
SET quantity = quantity - 50 
WHERE product_id = 1 AND location = 'Warehouse 1';

-- Add to Warehouse 2
UPDATE stock 
SET quantity = quantity + 50 
WHERE product_id = 1 AND location = 'Warehouse 2';

INSERT INTO returns (order_id, product_id, quantity) 
VALUES (2, 1, 5);

-- Archive a product
INSERT INTO archive (record_type, record_id) 
VALUES ('product', 1);

-- Archive an order
INSERT INTO archive (record_type, record_id) 
VALUES ('order', 2);
