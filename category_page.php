<?php
    session_start();
    require_once ('database/connection.php');
    require_once ('database/items.php');
    require_once('templates/common.php');   
    require_once('templates/items.php'); 
    $db = getDatabaseConnection();
    output_header();
?>
        <h1>Electronics</h1>
        <article>
            <h2>iPhone 12</h2>
            <img src="database/images/IPHONE_12.jpg" alt="iPhone 12">
            <p>Seller: jdoe</p>
            <p>Size: Small</p>
            <p>Condition: New</p>
            <p>Brand: Apple</p>
            <p>Price: $699.99</p>
        </article>
        <article>
            <h2>Samsung Galaxy S21</h2>
            <img src="database/images/SAMSUNG_S21.jpg" alt="Samsung Galaxy S21">
            <p>Seller: asmith</p>
            <p>Size: Medium</p>
            <p>Condition: Used</p>
            <p>Brand: Samsung</p>
            <p>Price: $499.99</p>
        </article>
        <article>
            <h2>MacBook Pro</h2>
            <img src="database/images/MACBOOK_PRO.jpg" alt="MacBook Pro">
            <p>Seller: bjohnson</p>
            <p>Size: Large</p>
            <p>Condition: New</p>
            <p>Brand: Apple</p>
            <p>Price: $1299.99</p>
        </article>
<?php 
    output_footer();
?>