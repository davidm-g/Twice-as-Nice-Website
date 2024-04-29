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
$messageText = $_POST['message_text'];
$price = isset($_POST['price']) ? $_POST['price'] : null;

// If the new message includes a price, it's a new proposal
if ($price !== null) {
    // Set the price of the previous proposal to null and the message_text to 'Cancelled'
    remove_proposals($db, $username, $receiver, $itemId);
}

// Insert the new message into the database
sendMessage($db, $username, $receiver, $itemId, $messageText, $price);

// Redirect back to the conversations page
header("Location: messages.php?user=$receiver&item=$itemId");
exit;

