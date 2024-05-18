<?php
session_set_cookie_params(0, '/', 'localhost', false, true);
session_start();
require_once('database/connection.php');
require_once('database/items.php');
$db = getDatabaseConnection();
if ($_SESSION['csrf'] !== $_POST['csrf']) {
    die('Error: Invalid request. Please refresh the page and try again.');
}
$itemId = htmlspecialchars($_POST['item_id']);
$otherUser = htmlspecialchars($_POST['other_user']);
$buyer = $_SESSION['username']; 

updateTransactionStatus($db, $buyer, $itemId);

$_SESSION['payment_success'] = "Your payment has been successfully processed!";

header('Location: /messages.php?user=' . urlencode($otherUser) . '&item=' . urlencode($itemId)); // Redirect back to the messages page
