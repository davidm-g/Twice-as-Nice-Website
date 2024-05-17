<?php
    session_set_cookie_params(0, '/', 'localhost', false, true);
    session_start();
    require_once ('database/connection.php');
    require_once ('database/items.php');
    require_once('templates/common.php');   
    require_once('templates/categories.php');
    $db = getDatabaseConnection();
    $cat_id = htmlspecialchars($_GET['id']);
    $cat_name = htmlspecialchars(getCategoryName($db, $cat_id));
    $items = getItems($db);
    $cats = getCategories($db);
    output_header();
    output_categories($db, $cats);
?>
    <h1><?= $cat_name ?></h1>
    <aside id="random_items">
        <?php foreach ($items as $item) { 
            if(getCategoryId($db,htmlspecialchars($item['id'])) == $cat_id){
                if (isItemForSale($db, htmlspecialchars($item['id']))) {
                    outputItem($db, $item);
                }
            }
        } ?>    
    </aside>
<?php 
    output_footer();
?>