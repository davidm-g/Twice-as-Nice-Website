<?php
    session_start();
    require_once ('database/connection.php');
    require_once ('database/items.php');
    require_once('templates/common.php');  
    require_once('templates/categories.php'); 
    $db = getDatabaseConnection();
    $id = $_GET['id'];
    $cats = getCategories($db);
    output_header();
    output_categories($db, $cats);
?>
    <div id="item-details">
        <img id="item-image" src=<?=getImage($db, $id)?> alt="Example Item image">
        <div id="item-info">
        <h2><?=getTitle($db, $id)?></h2>
        <p>Seller: <span id="item-seller"><?=getSeller($db, $id)?></span></p>
        <p>Size: <span id="item-size"><?=getSize($db, $id)?></span></p>
        <p>Condition: <span id="item-condition"><?=getCondition($db, $id)?></span></p>
        <p>Brand: <span id="item-brand"><?=getBrand($db, $id)?></span></p>
        <p>Category: <span id="item-category"><?=getCategory($db, $id)?></span></p>
        <div id="buttons">
            <button id="cart-button" onclick="addToCart()"><i class="fa-solid fa-cart-plus"></i>Add to Cart</button>
            <button id="negotiate-button" onclick="window.location.href='negotiate_price_page.html'"><i class="fa-solid fa-tag"></i>Negotiate Price</button>
            <button id="wishlist-button" onclick="addToWishlist()"><i class="fa-regular fa-heart"></i>Add to Wishlist</button>
        </div>
        </div>
        <div id="descriptioncont">
            <p>Description: <span id="item-description"><?=getDescription($db, $id)?></span></p>
        </div>    
    </div>

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