<?php
    session_start();                                         // starts the session
    require_once('database/connection.php'); 
    require_once('database/items.php');  
    header('Content-Type: application/json');
    $db = getDatabaseConnection();
    $cat_id = htmlspecialchars($_GET['category_id']);
    $subcategories = getSubcategories($db, $cat_id);

    echo json_encode($subcategories);
