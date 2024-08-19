# Twice as Nice  <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/html5/html5-original.svg" title="HTML" alt="HTML Logo" width="55" height="55" align="right" />&nbsp; <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/css3/css3-original.svg" title="CSS" alt="CSS Logo" width="55" height="55" align="right" />&nbsp; <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/javascript/javascript-original.svg" title="JavaScript" alt="JavaScript Logo" width="55" height="55" align="right" />&nbsp; <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/php/php-original.svg" title="PHP" alt="PHP Logo" width="55" height="55" align="right" />&nbsp;
          
          
           

#### Project done in collaboration with:  
[Tomás Marques](https://github.com/Torpedoooo)  
[Pedro Lunet](https://github.com/PedroLunet)  

## Grade: 15.9/20

### Overview
A second hand shopping website with dynamically generated PHP pages and an SQLite database based on 2 main SQL files.

HTML and CSS provide all the styling that beautifies the website and makes its pages responsive.

JavaScript makes the website more interactive and with the resource to Ajax live search results and assynchronous data updates are possible;

Project done in the Web Languages and Technologies class of the 2nd year of L.EIC course.

### Installing and running the project:

1 - Install SQLite3 and PHP

    sudo apt-get install php-cli sqlite3 php-sqlite3 unzip wget

2 - Clone this repository
  
    git clone https://github.com/davidm-g/Twice-as-Nice-Website.git

3 - Navigate to the main directory
	
    cd Twice-as-Nice-Website/

4 - Open a localhost to access our webpages

    php -S localhost:9000

5 - Navigate to 'localhost:9000' on your favourite browser and explore our website

#### EXTRA
If you need to reset to the original project database just execute these commands:

    cd Twice-as-Nice-Website/database/
    sqlite3 site.db
        .read create.sql
        .read populate.sql
        .exit 

###  Instructions: [Project Description](/docs/instructions.pdf)

## Screenshots

### Main Page
![](/docs/SCREENSHOT_1.png)

### Register new account page
![](/docs/SCREENSHOT_2.png)

### Messages screen
![](/docs/SCREENSHOT_3.png)

## External Libraries

We have used the following external libraries:

- Font Awesome

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

Made by David Gonçalves | davidmgoncalves.pt@gmail.com  
<div id="badge"> <a href="https://www.linkedin.com/in/davidm-g"/> <img src="https://img.shields.io/badge/LinkedIn-blue?style=for-the-badge&logo=linkedin&logoColor=white" alt="LinkedIn Badge"/>&nbsp;
