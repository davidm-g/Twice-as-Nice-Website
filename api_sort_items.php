<?php
    session_start();                                         // starts the session
    require_once('database/connection.php'); 
    require_once('database/items.php');  
    header('Content-Type: application/json');
    $db = getDatabaseConnection();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $sortOrder = $_POST['sortOrder'];
    
        $_SESSION['sortOrder'] = $sortOrder;

        // Return a JSON response
        echo json_encode(['status' => 'success', 'message' => 'Items order changed']);
        exit;
    }
?>