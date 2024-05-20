<?php
session_set_cookie_params(0, '/', 'localhost', false, true);
session_start();
require_once('../database/connection.php');
require_once('../database/items.php');
require_once('../database/messages.php');

$db = getDatabaseConnection_folder();

$price = htmlspecialchars($_GET['price']);
$username = htmlspecialchars($_SESSION['username']);
$itemId = htmlspecialchars($_GET['item_id']);
$messageId = htmlspecialchars($_GET['message_id']); // Get the message id from the URL
$seller = getSellerUsername($db, $itemId);
$otherUser = htmlspecialchars($_GET['user']);

update_message($db, $messageId);
create_offer_message($db, $username, $otherUser, $itemId, $price);


    $redirectUrl = '../messages.php?user=' . urlencode($otherUser) . '&item=' . urlencode($itemId);


// Redirect the user
header('Location: ' . $redirectUrl);
exit;

