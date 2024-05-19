<?php
    session_set_cookie_params(0, '/', 'localhost', false, true);
    session_start();
    require_once ('../database/connection.php');
    require_once ('../database/items.php');
    
    $db = getDatabaseConnection_folder();
    $items = getFilteredItems($db);

    $temp_string = '';
    foreach ($items as $item) { 
        $temp_string .= outputItem($db,$item);
    }
    echo $temp_string;
    
  
    
