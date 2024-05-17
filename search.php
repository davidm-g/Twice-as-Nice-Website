<?php
    session_set_cookie_params(0, '/', 'localhost', false, true);
    session_start();
    require_once ('database/connection.php');
    require_once ('database/items.php');
    require_once('templates/common.php');   
    require_once('templates/categories.php');
    $db = getDatabaseConnection();
    if (!isset($_SESSION['csrf'])) {
        $_SESSION['csrf'] = generate_random_token();
    } 
    $query = htmlspecialchars($_GET['query']);
    $items = getSearchItems($db, $query);
    $cats = getCategories($db);
    output_header();
    output_categories($db, $cats);
?>
    <h1>Search results for "<?=htmlspecialchars($query)?>"</h1>
    <aside id="random_items">
        <?php foreach ($items as $item) { 
            outputItem($db,$item);
        } ?>    
    </aside>
<?php 
    output_footer();
?>