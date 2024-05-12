<?php
    session_start();
    require_once ('database/connection.php');
    require_once ('database/items.php');
    require_once('templates/common.php');   
    require_once('templates/categories.php');
    $db = getDatabaseConnection();
    $cat_id = $_GET['id'];
    $cat_name = getCategoryName($db, $cat_id);
    $items = getItems($db);
    $cats = getCategories($db);
    output_header();
    output_categories($db, $cats);
?>
    <h1><?=$cat_name?></h1>
    <aside id="random_items">
        <?php foreach ($items as $item) { 
            if(getCategoryId($db,$item['id']) == $cat_id){
                if (isItemForSale($db, $item['id'])) {
                    outputItem($db, $item);
                }
            }
        } ?>    
    </aside>
<?php 
    output_footer();
?>