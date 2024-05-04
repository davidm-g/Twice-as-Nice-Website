<?php
session_start();
require_once('database/connection.php');
require_once('database/items.php');
$db = getDatabaseConnection();
$price = $_GET['price'];
$username = $_SESSION['username'];
$itemId = $_GET['item_id']; 
$messageId = $_GET['message_id']; // Get the message id from the URL
$seller = getSellerUsername($db, $itemId);
$otherUser = $_GET['user'];


$stmt = $db->prepare("UPDATE messages SET price=NULL, message_text='Offer accepted.' WHERE id = :message_id");
$stmt->execute([':message_id' => $messageId]);
// Create a new message with the accepted offer price
$stmt = $db->prepare("INSERT INTO messages (sender, receiver, item_id, price, offer_accepted, timestamp) VALUES (:sender, :receiver, :item_id, :price, 1, :timestamp)");
$stmt->execute([
    ':sender' => $username,
    ':receiver' => $otherUser,
    ':item_id' => $itemId,
    ':price' => $price,
    ':timestamp' => time()
]);

// Redirect to a success page or the checkout page
if ($username !== $seller) { // If the user is the buyer
    header('Location: checkout.php?item_id=$itemId&price=$price');
} else {
    header('Location: /messages.php?user=' . $otherUser . '&item=' . $itemId);
}
exit;
?>