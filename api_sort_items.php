<?php
    session_start();                                         // starts the session
    require_once('database/connection.php'); 
    require_once('database/items.php');  
    header('Content-Type: application/json');
    $db = getDatabaseConnection();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if(isset($_POST['sortOrder']))$_SESSION['sortOrder'] = $_POST['sortOrder'];
        
        if(isset($_POST['direction']))$_SESSION['direction'] = $_POST['direction'];
    
        // Return a JSON response
        echo json_encode(['status' => 'success', 'message' => 'Items order changed']);
        exit;
    }
?>