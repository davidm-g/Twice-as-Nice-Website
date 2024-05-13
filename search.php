<?php
    session_start();
    require_once ('database/connection.php');
    require_once ('database/items.php');
    require_once('templates/common.php');   
    require_once('templates/categories.php');
    $db = getDatabaseConnection();
    $query = $_GET['query'];
    $items = getSearchItems($db, $query);
    $cats = getCategories($db);
    output_header();
    output_categories($db, $cats);
?>
    <h1>Search results for "<?=$query?>"</h1>
    <aside id="random_items">
        <?php foreach ($items as $item) { 
            outputItem($db,$item);
        } ?>    
    </aside>
<?php 
    output_footer();
?>