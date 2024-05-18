<?php
require_once ('database/connection.php');
require_once ('database/messages.php');
session_set_cookie_params(0, '/', 'localhost', false, true);
session_start();
$db = getDatabaseConnection();
// Get the current user's username
$username = htmlspecialchars($_SESSION['username']);

// Get the receiver, item_id, and message_text from the POST data
$receiver = htmlspecialchars($_POST['receiver']);
$itemId = htmlspecialchars($_POST['item_id']);
$messageText = htmlspecialchars($_POST['message_text']);
$price = isset($_POST['price']) ? htmlspecialchars($_POST['price']) : null;

// If the new message includes a price, it's a new proposal
if ($price !== null) {
    // Set the price of the previous proposal to null and the message_text to 'Cancelled'
    remove_proposals($db, $username, $receiver, $itemId);
}

// Insert the new message into the database
sendMessage($db, $username, $receiver, $itemId, $messageText, $price);

// Redirect back to the conversations page
header("Location: messages.php?user=".urlencode($receiver)."&item=".urlencode($itemId));
exit;

