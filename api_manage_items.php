<?php
    session_start();                                         // starts the session
    require_once('database/connection.php'); 
    require_once('database/items.php');  
    header('Content-Type: application/json');
    $db = getDatabaseConnection();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $item_id = $_POST['item_id'];
        $action = $_POST['action'];
    
        if ($action == 'change_price') {
            $new_price = $_POST['new_price'];
            $stmt = $db->prepare("UPDATE transactions SET price = :new_price WHERE item_id = :item_id");
            $stmt->execute(['new_price' => $new_price, 'item_id' => $item_id]);
            // Return a JSON response
            echo json_encode(['status' => 'success', 'message' => 'Price updated successfully']);
    exit;
        } elseif ($action == 'delete') {
            // Delete the item from the database
            $stmt = $db->prepare("DELETE FROM items WHERE id = :item_id");
            $stmt->execute(['item_id' => $item_id]);
            $stmt = $db->prepare("DELETE FROM transactions WHERE item_id = :item_id");
            $stmt->execute(['item_id' => $item_id]);
            // Return a JSON response
            echo json_encode(['status' => 'success', 'message' => 'Item deleted successfully']);
            exit;
        }
    }
?>