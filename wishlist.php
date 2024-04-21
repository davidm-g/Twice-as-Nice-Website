<?php
    session_start();
    require_once ('database/connection.php');
    require_once ('database/items.php');
    require_once('templates/common.php');   
    require_once('templates/categories.php');
    $db = getDatabaseConnection();
    $items = getItems($db);
    $cats = getCategories($db);
    output_header();
    output_categories($db, $cats);
?>
    <h1><?=$_SESSION['username']?>'s Wishlist</h1>
    <aside id="random_items">
        <?php foreach ($items as $item) { 
            if(isOnWishlist($db,$item['id'],$_SESSION['username']))
                outputItem($db,$item);
        } ?>    
    </aside>
<?php 
    output_footer();
?>