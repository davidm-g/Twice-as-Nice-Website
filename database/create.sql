DROP TABLE IF EXISTS users;
CREATE TABLE users (
  username VARCHAR PRIMARY KEY,  
  name VARCHAR NOT NULL,
  password VARCHAR NOT NULL,  -- password in SHA-1 format
  email VARCHAR NOT NULL UNIQUE,
  role VARCHAR NOT NULL  -- 'user',  'admin'
);

DROP TABLE IF EXISTS categories;
CREATE TABLE categories (
  id INTEGER PRIMARY KEY,
  name VARCHAR NOT NULL UNIQUE
);

DROP TABLE IF EXISTS subcategories;
CREATE TABLE subcategories (
  id INTEGER PRIMARY KEY,
  name VARCHAR NOT NULL,
  category_id INTEGER NOT NULL REFERENCES categories
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
  name VARCHAR NOT NULL,
  seller VARCHAR NOT NULL REFERENCES users,
  size INTEGER  REFERENCES sizes,
  condition INTEGER NOT NULL REFERENCES conditions,
  description VARCHAR NOT NULL,
  brand INTEGER REFERENCES brands
);

DROP TABLE IF EXISTS item_categories;
CREATE TABLE item_categories (
  item_id INTEGER PRIMARY KEY REFERENCES items,
  category_id INTEGER REFERENCES categories,
  subcategory_id INTEGER REFERENCES subcategories
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
  buyer VARCHAR REFERENCES users,
  status VARCHAR NOT NULL,  -- 'for sale', 'sold'
  price FLOAT CHECK (price >= 0),
  transaction_date INTEGER
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
  username VARCHAR NOT NULL REFERENCES users,
  item_id INTEGER NOT NULL REFERENCES items,
  PRIMARY KEY (username, item_id)
);



DROP TABLE IF EXISTS shipping_forms;
CREATE TABLE shipping_forms (
  id INTEGER PRIMARY KEY,
  transaction_id INTEGER NOT NULL REFERENCES transactions,
  form_data VARCHAR NOT NULL
);

