<?php
    session_set_cookie_params(0, '/', 'localhost', false, true);
    session_start();
    require_once ('database/connection.php');
    require_once ('database/items.php');
    require_once ('templates/common.php');   
    require_once ('templates/categories.php');
    require_once ('database/users.php');
    $db = getDatabaseConnection();
    if (!isset($_SESSION['csrf'])) {
        $_SESSION['csrf'] = generate_random_token();
    }   
    $items = getFilteredItems($db);
    $cats = getCategories($db);

output_header();
output_categories($db, $cats);
outputItems($db, $items);
output_footer(); 
