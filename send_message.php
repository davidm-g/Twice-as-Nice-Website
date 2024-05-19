<?php
require_once ('database/connection.php');
require_once ('database/messages.php');
session_set_cookie_params(0, '/', 'localhost', false, true);
session_start();

$db = getDatabaseConnection();
$username = htmlspecialchars($_SESSION['username']);
$receiver = htmlspecialchars($_POST['receiver']);
$itemId = htmlspecialchars($_POST['item_id']);
$messageText = htmlspecialchars($_POST['message_text']);
$price = isset($_POST['price']) ? htmlspecialchars($_POST['price']) : null;

if ($price !== null) {
    remove_proposals($db, $username, $receiver, $itemId);
}

sendMessage($db, $username, $receiver, $itemId, $messageText, $price);

header("Location: messages.php?user=".urlencode($receiver)."&item=".urlencode($itemId));
exit;


