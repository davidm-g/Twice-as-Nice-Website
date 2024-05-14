<?php
    session_start();
    require_once('templates/common.php');
    require_once('database/connection.php');
    require_once('database/messages.php');
    require_once('templates/categories.php');
    require_once('database/items.php');
    $db = getDatabaseConnection();
    if (!isset($_SESSION['csrf'])) {
        $_SESSION['csrf'] = generate_random_token();
    } 
    $username = htmlspecialchars($_SESSION['username']);
    $conversations = getConversations($db, $username);
    $cats = getCategories($db);
    output_header();
    output_categories($db, $cats);
    foreach ($conversations as $conversation) {
        $otherUser = htmlspecialchars($conversation['other_user']);
        $itemId = htmlspecialchars($conversation['item_id']);
        $itemName = htmlspecialchars(getItemName($db,$itemId));
        if (isItemForSale($db, $itemId)) { ?>
        <div class='conversation'>
            <h2><a href="messages.php?user=<?= $otherUser ?>&item=<?= $itemId ?>">Conversation with <?= $otherUser ?> about <?= $itemName ?></a></h2>
        </div>
    <?php } else { ?>
        <div class='conversation'>
            <h2><?= $itemName ?> has been sold</h2>
        </div>
    <?php }
    }
    output_footer();
?>