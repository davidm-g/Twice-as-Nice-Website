<?php
    session_start();
    require_once ('database/connection.php');
    require_once ('database/items.php');
    require_once('templates/common.php');   
    require_once('database/users.php');
    require_once('templates/categories.php');
    require_once('templates/transactions.php');
    $db = getDatabaseConnection();
    $username = $_SESSION['username'];
    $user= getUserByUsername($db, $username);
    $cats = getCategories($db);
    output_header();
    output_categories($db, $cats);
?>
        <h1><?=$username?>'s profile</h1>
        
<?php
    session_start();
    require_once ('database/connection.php');
    require_once ('database/items.php');
    require_once ('templates/common.php');   
    require_once ('templates/categories.php');
    require_once ('database/users.php');
    $db = getDatabaseConnection();
    $items = getItems($db);
    $cats = getCategories($db);
    outputItems($db, $items);
    output_footer();
?>