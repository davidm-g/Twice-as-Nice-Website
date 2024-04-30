<?php
require_once ('database/connection.php');
require_once ('database/messages.php');
session_start();
$db = getDatabaseConnection();
// Get the current user's username
$username = $_SESSION['username'];

// Get the receiver, item_id, and message_text from the POST data
$receiver = $_POST['receiver'];
$itemId = $_POST['item_id'];
$messageText = isset($_POST['message_text']) ? $_POST['message_text'] : null;
$price = isset($_POST['new_price']) ? $_POST['new_price'] : null;


if ($price !== null) {
    // Set the price of the previous proposal to null and the message_text to 'Cancelled'
    remove_proposals($db, $username, $receiver, $itemId);
}

// Insert the new message into the database
sendMessage($db, $username, $receiver, $itemId, $messageText, $price);

// Return a JSON response
header('Content-Type: application/json');
echo json_encode(['status' => 'success']);
exit;
