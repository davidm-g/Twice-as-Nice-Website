<?php
session_set_cookie_params(0, '/', 'localhost', false, true);
session_start();
require_once('database/connection.php');
require_once('database/items.php');
require_once('database/messages.php');

$db = getDatabaseConnection();

$price = htmlspecialchars($_GET['price']);
$username = htmlspecialchars($_SESSION['username']);
$itemId = htmlspecialchars($_GET['item_id']);
$messageId = htmlspecialchars($_GET['message_id']); // Get the message id from the URL
$seller = getSellerUsername($db, $itemId);
$otherUser = htmlspecialchars($_GET['user']);

update_message($db, $messageId);
create_offer_message($db, $username, $otherUser, $itemId, $price);

// Prepare the redirect URL
if ($username !== $seller) { // If the user is the buyer
    $redirectUrl = 'checkout.php?item_id=' . urlencode($itemId) . '&price=' . urlencode($price) . '&user=' . urlencode($otherUser);
} else {
    $redirectUrl = '/messages.php?user=' . urlencode($otherUser) . '&item=' . urlencode($itemId);
}

// Redirect the user
header('Location: ' . $redirectUrl);
exit;

