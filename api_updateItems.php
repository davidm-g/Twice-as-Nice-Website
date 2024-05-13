<?php
    session_start();
    require_once ('database/connection.php');
    require_once ('database/items.php');
    $db = getDatabaseConnection();
    $items = getItems($db);

    $temp_string = '';
    foreach ($items as $item) { 
        $temp_string .= outputItem($db,$item);
    }
    echo $temp_string;
?>