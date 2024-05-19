<?php
session_set_cookie_params(0, '/', 'localhost', false, true);
session_start();
require_once('../database/connection.php');
require_once('../database/items.php');
$db = getDatabaseConnection_folder();
if ($_SESSION['csrf'] !== $_POST['csrf']) {
    die('Error: Invalid request. Please refresh the page and try again.');
}
$itemId = htmlspecialchars($_POST['item_id']);
$otherUser = htmlspecialchars($_POST['other_user']);
$buyer = $_SESSION['username']; 
$price = htmlspecialchars($_POST['price']);
$otherUser = htmlspecialchars($_POST['other_user']);
$country = htmlspecialchars($_POST['country']);
$city = htmlspecialchars($_POST['city']);
$zipcode = htmlspecialchars($_POST['zipcode']);
$address = htmlspecialchars($_POST['address']);
$paymentMethod = htmlspecialchars($_POST['payment_method']);

updateTransactionStatus($db, $buyer, $itemId);

$_SESSION['payment_success'] = "Your payment has been successfully processed!";
$label = "---------------------------------\n";
$label .= "Shipping Label\n";
$label .= "---------------------------------\n";
$label .= "Item ID: " . htmlspecialchars($itemId) . "\n";
$label .= "Price: " . htmlspecialchars($price) . " €\n";
$label .= "Buyer: " . $_SESSION['username'] . "\n";
$label .= "Seller: " . htmlspecialchars($otherUser) . "\n";
$label .= "Shipping Address: " . htmlspecialchars($country) . ", " . htmlspecialchars($city) . ", " . htmlspecialchars($zipcode) . ", " . htmlspecialchars($address) . "\n";
$label .= "Payment Method: " . htmlspecialchars($paymentMethod) . "\n";
$label .= "Date: " . date('Y-m-d H:i:s') . "\n";
$label .= "---------------------------------\n";

// Store the label in the session so it can be displayed on the next page
$_SESSION['shipping_label'] = $label;

header('Location: ../label_confirmation.php?user=' . urlencode($otherUser) . '&item=' . urlencode($itemId)); // Redirect back to the messages page
