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
?>

<div class="conversation-container"> <!-- Container for all conversation containers -->
<?php
foreach ($conversations as $conversation) {
    $otherUser = htmlspecialchars($conversation['other_user']);
    $itemId = htmlspecialchars($conversation['item_id']);
    $itemName = htmlspecialchars(getItemName($db,$itemId));
    if (isItemForSale($db, $itemId)) { ?>
        <a href="messages.php?user=<?= $otherUser ?>&item=<?= $itemId ?>" class='conversation-link'>
            <div class='conversation'> <!-- Removed custom-margin class -->
                <h3><?= $itemName ?></h3>
                <p><?= $otherUser ?></p>
            </div>
        </a>
    <?php } else { ?>
        <div class='conversation'> <!-- Removed custom-margin class -->
            <h2>Item not available.</h2>
        </div>
    <?php }
}
?>
</div> <!-- Close conversation-container -->
<?php
    output_footer();
?>
