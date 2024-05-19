<?php
require_once('database/connection.php');
require_once('database/messages.php');

header('Content-Type: application/json');

// Ensure the request has the necessary parameters
if (isset($_GET['user']) && isset($_GET['item']) && isset($_GET['last_message_id'])) {
    $db = getDatabaseConnection();
    $user = htmlspecialchars($_GET['user']);
    $item = htmlspecialchars($_GET['item']);
    $lastMessageId = intval($_GET['last_message_id']);

    $messages = getNewMessages($db, $user, $item, $lastMessageId);

    echo json_encode($messages);
} else {
    echo json_encode([]);
}
