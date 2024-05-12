<?php
    session_start();                                         
    require_once('database/connection.php'); 
    require_once('database/users.php');  
    $db = getDatabaseConnection();
    header('Content-Type: application/json');
    $query = $_GET['query'];

    if (!empty($query)) {
        
        $stmt = $db->prepare("SELECT items.* FROM items 
                              JOIN transactions ON items.id = transactions.item_id 
                              WHERE items.name LIKE :query AND transactions.status = 'for sale'");

        $stmt->bindValue(':query', '%' . $query . '%');

        $stmt->execute();

        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        
        $items = [];
    }
    
    echo json_encode($items);
?>