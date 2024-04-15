<?php
    session_start();
    require_once ('database/connection.php');
    require_once ('database/items.php');
    require_once('templates/common.php');   
    require_once('templates/items.php'); 
    $db = getDatabaseConnection();
    output_header();
    $id = $_GET['id'];
?>
    <div id="item-details">
        <h2><?=getTitle($db, $id)?></h2>
        <img id="item-image" src=<?=getImage($db, $id)?> alt="Example Item image">
        <p>Description: <span id="item-description"><?=getDescription($db, $id)?></span></p>
        <p>Seller: <span id="item-seller"><?=getSeller($db, $id)?></span></p>
        <p>Size: <span id="item-size"><?=getSize($db, $id)?></span></p>
        <p>Condition: <span id="item-condition"><?=getCondition($db, $id)?></span></p>
        <p>Brand: <span id="item-brand"><?=getBrand($db, $id)?></span></p>
        <p>Category: <span id="item-category"><?=getCategory($db, $id)?></span></p>
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