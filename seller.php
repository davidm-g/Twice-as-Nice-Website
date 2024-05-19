<?php
    session_set_cookie_params(0, '/', 'localhost', false, true);
    session_start();
    require_once ('database/connection.php');
    require_once ('database/items.php');
    require_once('templates/common.php');   
    require_once('database/users.php');
    require_once('templates/categories.php');
    require_once('templates/transactions.php');
    $db = getDatabaseConnection();
    if (!isset($_SESSION['csrf'])) {
        $_SESSION['csrf'] = generate_random_token();
    }   
    $seller = $_GET['seller'];
    $items = getItems($db);
    output_header();
    output_categories($db, $cats);
?>
    <h1><?= getNameSeller($db, $seller) ?>'s profile</h1>
    <aside id="random_items">
    <?php foreach ($items as $item) { 
        if(getSeller($db, $item['id']) == $seller){
            if (isItemForSale($db, htmlspecialchars($item['id']))) {
                outputItem($db, $item);
            }
        }
    } ?>
    </aside>
<?php
    output_footer();
?>