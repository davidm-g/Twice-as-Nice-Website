<?php
    session_start();
    require_once ('database/connection.php');
    require_once ('database/items.php');
    require_once('templates/common.php');   
    require_once('templates/items.php'); 
    $db = getDatabaseConnection();
    $items = getItems($db);
    output_header();
    output_item_feed($items,$db);
    output_footer();

