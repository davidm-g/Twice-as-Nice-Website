PRAGMA foreign_keys = ON;

INSERT OR IGNORE INTO users (username, name, password, email, role, profile_pic) VALUES
    ('jdoe', 'John Doe', '$2y$10$UUFh9FCRBXEs7w4Kx27Ma.X7UOCXEzMPbk6w7zd5EH6.QFcirwseK', 'jdoe@example.com', 'user', 'database/images/PROFILE_PIC.jpg'),
    ('asmith', 'Alice Smith', '$2y$10$UUFh9FCRBXEs7w4Kx27Ma.X7UOCXEzMPbk6w7zd5EH6.QFcirwseK', 'asmith@example.com', 'user', 'database/images/PROFILE_PIC.jpg'),
    ('bturner', 'Bob Turner', '$2y$10$UUFh9FCRBXEs7w4Kx27Ma.X7UOCXEzMPbk6w7zd5EH6.QFcirwseK', 'bturner@example.com', 'admin', 'database/images/PROFILE_PIC.jpg'),
    ('cjohnson', 'Charlie Johnson', '$2y$10$UUFh9FCRBXEs7w4Kx27Ma.X7UOCXEzMPbk6w7zd5EH6.QFcirwseK', 'cjohnson@example.com', 'admin', 'database/images/PROFILE_PIC.jpg'),
    ('ewhite', 'Emily White',  '$2y$10$UUFh9FCRBXEs7w4Kx27Ma.X7UOCXEzMPbk6w7zd5EH6.QFcirwseK', 'ewhite@example.com', 'user', 'database/images/PROFILE_PIC.jpg'),
    ('fthompson', 'Frank Thompson', '$2y$10$UUFh9FCRBXEs7w4Kx27Ma.X7UOCXEzMPbk6w7zd5EH6.QFcirwseK', 'fthompson@example.com', 'user', 'database/images/PROFILE_PIC.jpg'),
    ('ganderson', 'Grace Anderson', '$2y$10$UUFh9FCRBXEs7w4Kx27Ma.X7UOCXEzMPbk6w7zd5EH6.QFcirwseK', 'ganderson@example.com', 'admin', 'database/images/PROFILE_PIC.jpg'),
    ('hmartin', 'Harry Martin', '$2y$10$UUFh9FCRBXEs7w4Kx27Ma.X7UOCXEzMPbk6w7zd5EH6.QFcirwseK', 'hmartin@example.com', 'user', 'database/images/PROFILE_PIC.jpg'),
    ('ijackson', 'Ivy Jackson', '$2y$10$UUFh9FCRBXEs7w4Kx27Ma.X7UOCXEzMPbk6w7zd5EH6.QFcirwseK', 'ijackson@example.com', 'admin', 'database/images/PROFILE_PIC.jpg'),
    ('jthomas', 'Jack Thomas', '$2y$10$UUFh9FCRBXEs7w4Kx27Ma.X7UOCXEzMPbk6w7zd5EH6.QFcirwseK', 'jthomas@example.com', 'user', 'database/images/PROFILE_PIC.jpg');
    

INSERT OR IGNORE INTO categories (id, name) VALUES
    (1, 'Electronics'),
    (2, 'Books'),
    (3, 'Clothing'),
    (4, 'Home & Kitchen'),
    (5, 'Sports & Outdoors');

INSERT OR IGNORE INTO sizes (id, name) VALUES
    (1, 'Small'),
    (2, 'Medium'),
    (3, 'Large'),
    (4, 'X-Large'),
    (5, 'XX-Large');

INSERT OR IGNORE INTO brands (id, name) VALUES
    (1, 'Apple'),
    (2, 'Samsung'),
    (3, 'Sony'),
    (4, 'Nike'),
    (5, 'Adidas'),
    (6, 'Ikea');

INSERT OR IGNORE INTO conditions (id, name) VALUES
    (1, 'New'),
    (2, 'Like New'),
    (3, 'Used'),
    (4, 'Fair'),
    (5, 'Poor');

INSERT OR IGNORE INTO items (id, name, seller, size, condition, description, brand) VALUES 
    (1, 'iPhone 12', 'jdoe', 1, 1, 'Brand new iPhone 12', 1),
    (2, 'Samsung Galaxy S21', 'asmith', 2, 1, 'Latest Samsung Galaxy S21', 2),
    (3, 'Sony PlayStation 5', 'bturner', 3, 1, 'New Sony PlayStation 5', 3),
    (4, 'Nike Shoes', 'cjohnson', 4, 1, 'Comfortable Nike Shoes', 4),
    (5, 'Adidas Sports T-Shirt', 'ewhite', 5, 1, 'Adidas T-Shirt for sports', 5),
    (6, 'Apple Watch Series 6', 'jdoe', 1, 1, 'Latest Apple Watch', 1),
    (7, 'Samsung Galaxy Buds Pro', 'ganderson', 1, 1, 'Wireless earbuds', 2),
    (8, 'Sony WH-1000XM5 Headphones', 'bturner', 1, 1, 'Noise-canceling headphones', 3),
    (9, 'Nike Alphafly 3', 'cjohnson', 2, 1, 'The fastest sneakers', 4),
    (10, 'Ikea Desk', 'ganderson', 2, 1, 'Furniture', 6);

-- Inserting data into transactions
INSERT OR IGNORE INTO transactions (id, item_id, seller, buyer, status, price, transaction_date) VALUES 
    (1, 1, 'jdoe', NULL, 'for sale', 799.99, 1711371741),
    (2, 2, 'asmith', NULL, 'for sale', 799.99, 1711371741),
    (3, 3, 'bturner', NULL, 'for sale', 549.99, 1708866141),
    (4, 4, 'cjohnson', NULL, 'for sale', 2749.99, 1706187741),
    (5, 5, 'ewhite', NULL, 'for sale', 14.99, 1705150941 ),
    (6, 6, 'jdoe', NULL, 'for sale', 399.99, 1711371741),
    (7, 7, 'ganderson', NULL, 'for sale', 199.99, 1711371741),
    (8, 8, 'bturner', NULL, 'for sale', 299.99, 1708866141),
    (9, 9, 'cjohnson', NULL, 'for sale', 309.99, 1706187741),
    (10, 10, 'ganderson', NULL, 'for sale', 179.99, 1705150941);

INSERT OR IGNORE INTO images (id, item_id, image_url) VALUES
    (1, 1, 'database/images/IPHONE_12.jpg'),
    (2, 2, 'database/images/SAMSUNG_S21.jpg'),
    (3, 3, 'database/images/PS5.jpg'),
    (4, 4, 'database/images/NIKE_SHOES.jpeg'),
    (5, 5, 'database/images/ADIDAS_TEE.jpg'),
    (6, 6, 'database/images/WATCH_6.jpg'),
    (7, 7, 'database/images/BUDS_PRO.jpg'),
    (8, 8, 'database/images/WH-1000XM5.jpg'),
    (9, 9, 'database/images/ALPHAFLY3.jpeg'),
    (10, 10, 'database/images/IKEA_DESK.jpg');

INSERT INTO subcategories (name, category_id) 
    SELECT "Other", id FROM categories;

INSERT OR IGNORE INTO subcategories (name, category_id) VALUES
    ("Smartphones", 1),
    ("Gaming Consoles", 1),
    ("Shoes", 3),
    ("T-Shirts", 3);

INSERT OR IGNORE INTO item_categories (item_id, category_id, subcategory_id) VALUES
    (1, 1, (SELECT id FROM subcategories WHERE name = 'Smartphones')), -- iPhone 12 belongs to Smartphones
    (2, 1, (SELECT id FROM subcategories WHERE name = 'Smartphones')), -- Samsung Galaxy S21 belongs to Smartphones
    (3, 1, (SELECT id FROM subcategories WHERE name = 'Gaming Consoles')), -- Sony PlayStation 5 belongs to Gaming Consoles
    (4, 3, (SELECT id FROM subcategories WHERE name = 'Shoes')), -- Nike Shoes belongs to Shoes
    (5, 3, (SELECT id FROM subcategories WHERE name = 'T-Shirts')), -- Adidas Sports T-Shirt belongs to T-Shirts
    (6, 1, (SELECT id FROM subcategories WHERE name = 'Smartphones')), -- Apple Watch Series 6 belongs to Smartphones
    (7, 1, (SELECT id FROM subcategories WHERE name = 'Other' AND category_id = 1)), -- Samsung Galaxy Buds Pro belongs to Other
    (8, 1, (SELECT id FROM subcategories WHERE name = 'Other' AND category_id = 1)), -- Sony WH-1000XM5 Headphones belongs to Other
    (9, 3, (SELECT id FROM subcategories WHERE name = 'Shoes')), -- Nike AlphaFly 3 belongs to Shoes
    (10, 4, (SELECT id FROM subcategories WHERE name = 'Other' AND category_id = 4)); -- Ikea Desk belongs to Home & Kitchen