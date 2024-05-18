<?php
session_set_cookie_params(0, '/', 'localhost', false, true);
    session_start();
    require_once ('database/connection.php');
    require_once ('database/items.php');
    require_once('templates/common.php');   
    require_once('templates/categories.php');
    $db = getDatabaseConnection();
    $subcat_id = htmlspecialchars($_GET['id']);
    $subcat_name = getSubcategoryName($db, $subcat_id);
    $items = getItems($db);
    $cats = getCategories($db);
    $cat = getCategorySub($db, $subcat_id);
    output_header();
    output_categories($db, $cats);
?>
    <h1><a href="category_page.php?id=<?=htmlspecialchars($cat['id'])?>"><?=htmlspecialchars($cat['name'])?></a> -> <?=htmlspecialchars($subcat_name)?></h1>
    <aside id="random_items">
        <?php foreach ($items as $item) { 
            if(getSubcategoryId($db,$item['id']) == $subcat_id){
                if (isItemForSale($db, $item['id'])) {
                    outputItem($db, $item);
                }
            }
        } ?>    
    </aside>
<?php 
    output_footer();
?>