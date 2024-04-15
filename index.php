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
outputItems($db, $items);
output_footer(); ?>