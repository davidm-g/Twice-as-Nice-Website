<?php
session_start();
require_once('database/connection.php');
require_once('database/items.php');
$db = getDatabaseConnection();
$itemId = $_POST['item_id'];
$otherUser = $_POST['other_user'];
$buyer = $_SESSION['username']; // Assuming the buyer is the current logged in user

updateTransactionStatus($db, $buyer, $itemId);


$_SESSION['payment_success'] = "Your payment has been successfully processed!";

header('Location: /messages.php?user=' . $otherUser . '&item=' . $itemId); // Redirect back to the messages page
?>