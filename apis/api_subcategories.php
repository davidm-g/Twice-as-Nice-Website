<?php
    session_set_cookie_params(0, '/', 'localhost', false, true);
    session_start();                                         // starts the session
    require_once('../database/connection.php'); 
    require_once('../database/items.php');  
    header('Content-Type: application/json');
    $db = getDatabaseConnection_folder();
    $cat_id = htmlspecialchars($_GET['category_id']);
    $subcategories = getSubcategories($db, $cat_id);

    echo json_encode($subcategories);
