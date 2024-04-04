DROP TABLE IF EXISTS users;
CREATE TABLE users (
  username VARCHAR PRIMARY KEY,  
  name VARCHAR,
  password VARCHAR,  -- password in SHA-2 format
  email VARCHAR,
  role VARCHAR  -- 'user',  'admin'
);

DROP TABLE IF EXISTS categories;
CREATE TABLE categories (
  id INTEGER PRIMARY KEY,
  name VARCHAR
);

DROP TABLE IF EXISTS sizes;
CREATE TABLE sizes (
  id INTEGER PRIMARY KEY,
  name VARCHAR
);

DROP TABLE IF EXISTS brands;
CREATE TABLE brands (
  id INTEGER PRIMARY KEY,
  name VARCHAR
);

DROP TABLE IF EXISTS conditions;
CREATE TABLE conditions (
  id INTEGER PRIMARY KEY,
  name VARCHAR
);

DROP TABLE IF EXISTS items;
CREATE TABLE items (
  id INTEGER PRIMARY KEY,
  seller VARCHAR REFERENCES users,
  size INTEGER REFERENCES sizes,
  condition INTEGER REFERENCES conditions,
  description VARCHAR,
  brand INTEGER REFERENCES brands
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
  item_id INTEGER REFERENCES items,
  image_url VARCHAR
);

DROP TABLE IF EXISTS transactions;
CREATE TABLE transactions (
  id INTEGER PRIMARY KEY,
  item_id INTEGER REFERENCES items,
  seller VARCHAR REFERENCES users,
  buyer VARCHAR REFERENCES users,
  status VARCHAR,  -- 'for sale', 'sold'
  price FLOAT,
  transaction_date INTEGER
);

DROP TABLE IF EXISTS messages;
CREATE TABLE messages (
  id INTEGER PRIMARY KEY,
  sender VARCHAR REFERENCES users,
  receiver VARCHAR REFERENCES users,
  item_id INTEGER REFERENCES items,
  message_text VARCHAR,
  timestamp INTEGER
);

DROP TABLE IF EXISTS wishlist;
CREATE TABLE wishlist (
  user_id VARCHAR REFERENCES users,
  item_id INTEGER REFERENCES items,
  PRIMARY KEY (user_id, item_id)
);

DROP TABLE IF EXISTS shopping_cart;
CREATE TABLE shopping_cart (
  user_id VARCHAR REFERENCES users,
  item_id INTEGER REFERENCES items,
  PRIMARY KEY (user_id, item_id)
);

DROP TABLE IF EXISTS shipping_forms;
CREATE TABLE shipping_forms (
  id INTEGER PRIMARY KEY,
  transaction_id INTEGER REFERENCES transactions,
  form_data VARCHAR
);

