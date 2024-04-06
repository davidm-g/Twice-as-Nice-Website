DROP TABLE IF EXISTS users;
CREATE TABLE users (
  username VARCHAR PRIMARY KEY,  
  name VARCHAR NOT NULL,
  password VARCHAR NOT NULL,  -- password in SHA-2 format
  email VARCHAR NOT NULL UNIQUE,
  role VARCHAR NOT NULL  -- 'user',  'admin'
);

DROP TABLE IF EXISTS categories;
CREATE TABLE categories (
  id INTEGER PRIMARY KEY,
  name VARCHAR NOT NULL UNIQUE
);

DROP TABLE IF EXISTS sizes;
CREATE TABLE sizes (
  id INTEGER PRIMARY KEY,
  name VARCHAR NOT NULL UNIQUE
);

DROP TABLE IF EXISTS brands;
CREATE TABLE brands (
  id INTEGER PRIMARY KEY,
  name VARCHAR NOT NULL UNIQUE
);

DROP TABLE IF EXISTS conditions;
CREATE TABLE conditions (
  id INTEGER PRIMARY KEY,
  name VARCHAR NOT NULL UNIQUE
);

DROP TABLE IF EXISTS items;
CREATE TABLE items (
  id INTEGER PRIMARY KEY,
  seller VARCHAR NOT NULL REFERENCES users,
  size INTEGER NOT NULL REFERENCES sizes,
  condition INTEGER NOT NULL REFERENCES conditions,
  description VARCHAR NOT NULL,
  brand INTEGER NOT NULL REFERENCES brands
);

DROP TABLE IF EXISTS item_categories;
CREATE TABLE item_categories (
  item_id INTEGER REFERENCES items,
  category_id INTEGER REFERENCES categories,
  PRIMARY KEY (item_id, category_id)
);

DROP TABLE IF EXISTS images;
CREATE TABLE images (
  id INTEGER PRIMARY KEY,
  item_id INTEGER NOT NULL REFERENCES items,
  image_url VARCHAR NOT NULL
);

DROP TABLE IF EXISTS transactions;
CREATE TABLE transactions (
  id INTEGER PRIMARY KEY,
  item_id INTEGER NOT NULL REFERENCES items,
  seller VARCHAR NOT NULL REFERENCES users,
  buyer VARCHAR NOT NULL REFERENCES users,
  status VARCHAR NOT NULL,  -- 'for sale', 'sold'
  price FLOAT CHECK (price >= 0),
  transaction_date INTEGER NOT NULL
);

DROP TABLE IF EXISTS messages;
CREATE TABLE messages (
  id INTEGER PRIMARY KEY,
  sender VARCHAR NOT NULL REFERENCES users,
  receiver VARCHAR NOT NULL REFERENCES users,
  item_id INTEGER NOT NULL REFERENCES items,
  message_text VARCHAR NOT NULL,
  price FLOAT CHECK (price >= 0),  
  timestamp INTEGER NOT NULL
);

DROP TABLE IF EXISTS wishlist;
CREATE TABLE wishlist (
  user_id VARCHAR NOT NULL REFERENCES users,
  item_id INTEGER NOT NULL REFERENCES items,
  PRIMARY KEY (user_id, item_id)
);

DROP TABLE IF EXISTS shopping_cart;
CREATE TABLE shopping_cart (
  user_id VARCHAR NOT NULL REFERENCES users,
  item_id INTEGER NOT NULL REFERENCES items,
  PRIMARY KEY (user_id, item_id)
);

DROP TABLE IF EXISTS shipping_forms;
CREATE TABLE shipping_forms (
  id INTEGER PRIMARY KEY,
  transaction_id INTEGER NOT NULL REFERENCES transactions,
  form_data VARCHAR NOT NULL
);

