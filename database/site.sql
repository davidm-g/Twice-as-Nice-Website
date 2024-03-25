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