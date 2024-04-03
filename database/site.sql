CREATE TABLE users (
  username VARCHAR PRIMARY KEY,  
  name VARCHAR,
  password VARCHAR,  -- password in SHA-2 format
  email VARCHAR,
  role VARCHAR  -- 'user',  'admin'
);

CREATE TABLE categories (
  id INTEGER PRIMARY KEY,
  name VARCHAR
);

CREATE TABLE sizes (
  id INTEGER PRIMARY KEY,
  name VARCHAR
);

CREATE TABLE brands (
  id INTEGER PRIMARY KEY,
  name VARCHAR
);


CREATE TABLE conditions (
  id INTEGER PRIMARY KEY,
  name VARCHAR
);

CREATE TABLE items (
  id INTEGER PRIMARY KEY,
  seller VARCHAR REFERENCES users,
  size INTEGER REFERENCES sizes,
  condition INTEGER REFERENCES conditions,
  description VARCHAR,
  brand VARCHAR REFERENCES brands
);

CREATE TABLE item_categories (
  item_id INTEGER REFERENCES items,
  category_id INTEGER REFERENCES categories,
  PRIMARY KEY (item_id, category_id)
);

CREATE TABLE images (
  id INTEGER PRIMARY KEY,
  item_id INTEGER REFERENCES items,
  image_url VARCHAR
);

CREATE TABLE transactions (
  id INTEGER PRIMARY KEY,
  item_id INTEGER REFERENCES items,
  seller VARCHAR REFERENCES users,
  buyer VARCHAR REFERENCES users,
  status VARCHAR,  -- 'for sale', 'sold'
  price FLOAT,
  transaction_date INTEGER
);

CREATE TABLE messages (
  id INTEGER PRIMARY KEY,
  sender VARCHAR REFERENCES users,
  receiver VARCHAR REFERENCES users,
  item_id INTEGER REFERENCES items,
  message_text VARCHAR,
  timestamp INTEGER
);

CREATE TABLE wishlist (
  user_id VARCHAR REFERENCES users,
  item_id INTEGER REFERENCES items,
  PRIMARY KEY (user_id, item_id)
);

CREATE TABLE shopping_cart (
  user_id VARCHAR REFERENCES users,
  item_id INTEGER REFERENCES items,
  PRIMARY KEY (user_id, item_id)
);

CREATE TABLE shipping_forms (
  id INTEGER PRIMARY KEY,
  transaction_id INTEGER REFERENCES transactions,
  form_data VARCHAR
);

INSERT INTO users (username, name, password, email, role) VALUES
('jdoe', 'John Doe', '99fb2f48c6af4761f904fc85f95eb56190e5d40b1f44ec3a9c1fa319', 'jdoe@example.com', 'user'),
('asmith', 'Alice Smith', '99fb2f48c6af4761f904fc85f95eb56190e5d40b1f44ec3a9c1fa319', 'asmith@example.com', 'user'),
('bturner', 'Bob Turner', '99fb2f48c6af4761f904fc85f95eb56190e5d40b1f44ec3a9c1fa319', 'bturner@example.com', 'admin'),
('cjohnson', 'Charlie Johnson', '99fb2f48c6af4761f904fc85f95eb56190e5d40b1f44ec3a9c1fa319', 'cjohnson@example.com', 'admin'),
('ewhite', 'Emily White',  '99fb2f48c6af4761f904fc85f95eb56190e5d40b1f44ec3a9c1fa319', 'ewhite@example.com', 'user');

INSERT INTO categories (id, name) VALUES
(1, 'Electronics'),
(2, 'Books'),
(3, 'Clothing'),
(4, 'Home & Kitchen'),
(5, 'Sports & Outdoors');

INSERT INTO sizes (id, name) VALUES
(1, 'Small'),
(2, 'Medium'),
(3, 'Large'),
(4, 'X-Large'),
(5, 'XX-Large');

INSERT INTO brands (id, name) VALUES
(1, 'Apple'),
(2, 'Samsung'),
(3, 'Sony'),
(4, 'Nike'),
(5, 'Adidas');

INSERT INTO conditions (id, name) VALUES
(1, 'New'),
(2, 'Like New'),
(3, 'Used'),
(4, 'Fair'),
(5, 'Poor');
-- Inserting data into items
INSERT INTO items (id, seller, size, condition, description, brand) VALUES 
(1, 'jdoe', 1, 1, 'iPhone 12', 1),
(2, 'asmith', 2, 1, 'Samsung Galaxy S21', 2),
(3, 'bturner', 3, 1, 'Sony PlayStation 5', 3),
(4, 'cjohnson', 4, 1, 'Nike Running Shoes', 4),
(5, 'ewhite', 5, 1, 'Adidas Sports T-Shirt', 5);

-- Inserting data into items_categories
INSERT INTO items_categories (item_id, category_id) VALUES 
(1, 1), -- iPhone 12 belongs to Electronics
(2, 1), -- Samsung Galaxy S21 belongs to Electronics
(3, 1), -- Sony PlayStation 5 belongs to Electronics
(4, 3), -- Nike Running Shoes belongs to Clothing
(5, 3); -- Adidas Sports T-Shirt belongs to Clothing

-- Inserting data into transactions
INSERT INTO transactions (id, item_id, seller, buyer, status, price, transaction_date) VALUES 
(1, 1, 'jdoe', NULL, 'for sale', 699.99, 1711371741),
(2, 2, 'asmith', NULL, 'for sale', 799.99, 1711371741),
(3, 3, 'bturner', NULL, 'for sale', 499.99, 1708866141),
(4, 4, 'cjohnson', NULL, 'for sale', 99.99, 1706187741),
(5, 5, 'ewhite', NULL, 'for sale', 29.99, 1705150941 );