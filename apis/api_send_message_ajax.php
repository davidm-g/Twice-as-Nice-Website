<?php
    require_once ('../database/connection.php');
    require_once ('../database/messages.php');
    session_set_cookie_params(0, '/', 'localhost', false, true);
    session_start();
    $db = getDatabaseConnection_folder();
    // Get the current user's username
    $username = htmlspecialchars($_SESSION['username']);

    // Get the receiver, item_id, and message_text from the POST data
    $receiver = htmlspecialchars($_POST['receiver']);
    $itemId = htmlspecialchars($_POST['item_id']);
    $messageText = isset($_POST['message_text']) ? htmlspecialchars($_POST['message_text']) : null;
    $price = isset($_POST['new_price']) ? htmlspecialchars($_POST['new_price']) : null;

    if ($price !== null) {
        // Set the price of the previous proposal to null and the message_text to 'Cancelled offer'
        remove_proposals($db, $username, $receiver, $itemId);
    }

    // Insert the new message into the database
    sendMessage($db, $username, $receiver, $itemId, $messageText, $price);

    // Return a JSON response
    header('Content-Type: application/json');
    echo json_encode(['status' => 'success']);
    exit;
