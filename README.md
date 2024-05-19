# Twice as Nice

## Group ltw15g10

- Tomás Marques (up202206667) 33%
- David Gonçalves (up202208795) 33%
- João Lunet (up202207150) 33%

## Install Instructions

    git clone git@github.com:FEUP-LTW-2024/ltw-project-2024-ltw15g10.git
    cd ltw-project-2024-ltw15g10/
    php -S localhost:9000
    open the "localhost:9000" URL on your browser

## External Libraries

We have used the following external libraries:

- Font Awesome

## Screenshots

### Main Page
![](/docs/SCREENSHOT_1.png)

### Register new account page
![](/docs/SCREENSHOT_2.png)

### Messages screen
![](/docs/SCREENSHOT_3.png)

## Implemented Features

**General**:

- [X] Register a new account.
- [X] Log in and out.
- [X] Edit their profile, including their name, username, password, and email.

**Sellers**  should be able to:

- [X] List new items, providing details such as category, brand, model, size, and condition, along with images.
- [X] Track and manage their listed items.
- [X] Respond to inquiries from buyers regarding their items and add further information if needed.
- [X] Print shipping forms for items that have been sold.

**Buyers**  should be able to:

- [X] Browse items using filters like category, price, and condition.
- [X] Engage with sellers to ask questions or negotiate prices.
- [X] Add items to a wishlist or shopping cart.
- [X] Proceed to checkout with their shopping cart (simulate payment process).

**Admins**  should be able to:

- [X] Elevate a user to admin status.
- [X] Introduce new item categories, sizes, conditions, and other pertinent entities.
- [X] Oversee and ensure the smooth operation of the entire system.

**Security**:
We have been careful with the following security aspects:

- [X] **SQL injection**
- [X] **Cross-Site Scripting (XSS)**
- [X] **Cross-Site Request Forgery (CSRF)**

**Password Storage Mechanism**: 

    PASSWORD_DEFAULT --> bcrypt algorithm (default as of PHP 5.5.0)

**Aditional Requirements**:

We also implemented the following additional requirements (you can add more):

- [ ] **Rating and Review System**
- [ ] **Promotional Features**
- [ ] **Analytics Dashboard**
- [ ] **Multi-Currency Support**
- [ ] **Item Swapping**
- [ ] **API Integration**
- [ ] **Dynamic Promotions**
- [X] **User Preferences**
- [ ] **Shipping Costs**
- [X] **Real-Time Messaging System**
