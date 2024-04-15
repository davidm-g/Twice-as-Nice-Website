<?php
    session_start();
    require_once ('database/connection.php');
    require_once ('database/items.php');
    require_once('templates/common.php');   
    require_once('templates/items.php'); 
    $db = getDatabaseConnection();
    output_header();
?>
    <div id="item-details">
        <h2 id="item-description">Example Item</h2>
        <img id="item-image" src="example.jpg" alt="Example Item image">
        <p>Seller: <span id="item-seller">Example Seller</span></p>
        <p>Size: <span id="item-size">Medium</span></p>
        <p>Condition: <span id="item-condition">New</span></p>
        <p>Brand: <span id="item-brand">Example Brand</span></p>
        <p>Category: <span id="item-category">Example Category</span></p>
    </div>

    <button id="wishlist-button" onclick="addToWishlist()">Add to Wishlist</button>
    <button id="negotiate-button" onclick="window.location.href='negotiate_price_page.html'">Negotiate Price</button>
    <button id="cart-button" onclick="addToCart()">Add to Cart</button>
    <script>
        function addToWishlist() {
            // Add code here to send a request to your server to add the item to the user's wishlist
        }

        function addToCart() {
            // Add code here to send a request to your server to add the item to the user's shopping cart
        }
    </script>
<?php 
    output_footer();
?>