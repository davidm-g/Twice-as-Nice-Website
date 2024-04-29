<?php
    session_start();
    require_once('templates/common.php');
    require_once('database/connection.php');
    require_once('database/messages.php');
    require_once('templates/categories.php');
    $db = getDatabaseConnection();
    $username = $_SESSION['username'];
    $conversations = getConversations($db, $username);
    $cats = getCategories($db);
    output_header();
    output_categories($db, $cats);
    foreach ($conversations as $conversation) {
        $otherUser = $conversation['other_user'];
        $itemId = $conversation['item_id']; ?>
        <div class='conversation'>
        <h2><a href="messages.php?user=<?= $otherUser ?>&item=<?= $itemId ?>">Conversation with <?= $otherUser ?> about item <?= $itemId ?></a></h2>
        </div>
     <?php } 
     output_footer();
     ?>