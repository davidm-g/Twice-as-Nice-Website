<?php
session_start();
require_once('database/connection.php');
require_once('database/items.php');
require_once('database/messages.php');
$db = getDatabaseConnection();
$price = $_GET['price'];
$username = $_SESSION['username'];
$itemId = $_GET['item_id']; 
$messageId = $_GET['message_id']; // Get the message id from the URL
$seller = getSellerUsername($db, $itemId);
$otherUser = $_GET['user'];


update_message($db, $messageId);
create_offer_message($db, $username, $otherUser, $itemId, $price);


if ($username !== $seller) { // If the user is the buyer
    header("Location: checkout.php?item_id=$itemId&price=$price&user=$otherUser");
} else {
    header('Location: /messages.php?user=' . $otherUser . '&item=' . $itemId);
}
exit;
