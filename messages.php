<?php
    session_start();
    require_once('templates/common.php');
    require_once('database/connection.php');
    require_once('database/messages.php');

    $db = getDatabaseConnection();

    // Get the current user's username, the other user's username, and the item_id
    $username = $_SESSION['username'];
    $otherUser = $_GET['user'];
    $itemId = $_GET['item'];

    // Get the messages
    $messages = getMessages($db, $username, $otherUser, $itemId);
    output_header();
?>

<div class='messages'>
    <h2>Messages with <?= $otherUser ?> about item <?= $itemId ?></h2>
    <?php foreach($messages as $message){ 
        $class = $message['sender'] === $username ? 'user' : 'other_user';
    ?>
        <p class="<?= $class ?>"><strong><?= $message['sender'] ?>:</strong> <?= $message['message_text'] ?></p>
    <?php }?>
</div>
<?php output_footer(); ?>