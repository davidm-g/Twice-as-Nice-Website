<?php
    session_start();
    require_once('templates/common.php');
    require_once('database/connection.php');
    require_once('database/messages.php');
    $db = getDatabaseConnection();
    $username = $_SESSION['username'];
    $conversations = getConversations($db, $username);
    output_header();
    foreach ($conversations as $conversation) {
        $otherUser = $conversation['other_user'];
        $itemId = $conversation['item_id']; ?>
        <div class='conversation'>
        <h2><a href="messages.php?user=<?= $otherUser ?>&item=<?= $itemId ?>">Conversation with <?= $otherUser ?> about item <?= $itemId ?></a></h2>
        </div>
     <?php } 
     output_footer();
     ?>