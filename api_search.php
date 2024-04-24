<?php
    session_start();                                         
    require_once('database/connection.php'); 
    require_once('database/users.php');  
    $db = getDatabaseConnection();
    header('Content-Type: application/json');
    $query = $_GET['query'];

    if (!empty($query)) {
        
        $stmt = $db->prepare("SELECT * FROM items WHERE name LIKE :query");

        $stmt->bindValue(':query', '%' . $query . '%');

        $stmt->execute();

        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        
        $items = [];
    }

    echo json_encode($items);
?>