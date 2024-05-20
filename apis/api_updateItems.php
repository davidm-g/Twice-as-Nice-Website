<?php
    session_set_cookie_params(0, '/', 'localhost', false, true);
    session_start();
    require_once ('../database/connection.php');
    require_once ('../database/items.php');
    
    $db = getDatabaseConnection_folder();
    $items = getFilteredItems($db);

    $temp_string = '';
    foreach ($items as $item) { 
        if (isItemForSale($db, $item['id']) && getSellerUsername($db, $item['id']) != $_SESSION['username'])
        $temp_string .= outputItem($db,$item);
    }
    echo $temp_string;
    
  
    
