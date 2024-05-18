<?php
session_set_cookie_params(0, '/', 'localhost', false, true);
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
$cats = getCategories($db);
$username = htmlspecialchars($_SESSION['username']);
$otherUser = htmlspecialchars($_GET['user']);
$itemId = htmlspecialchars($_GET['item']);
$transaction = getTransaction($db, $itemId);
$itemName = htmlspecialchars(getItemName($db, $itemId));
$seller = htmlspecialchars(getSellerUsername($db, $itemId));
date_default_timezone_set('Europe/Lisbon');
$messages = getMessages($db, $username, $otherUser, $itemId);

output_header();
output_categories($db, $cats);

if (isset($_SESSION['payment_success'])) {
    echo "<p class='success'>" . htmlspecialchars($_SESSION['payment_success']) . "</p>";
    unset($_SESSION['payment_success']);
}
?>

<div class='messages'>
    <h2>Messages with <a href="seller.php"><?= htmlspecialchars($otherUser) ?></a> about <?= htmlspecialchars($itemName) ?></h2>
    <div class="msg-container">
        <?php foreach ($messages as $message) {
            $class = $message['sender'] === $username ? 'user' : 'other_user';
            $date = date('F j, Y, g:i a', $message['timestamp']);
        ?>
            <p id="message-<?= htmlspecialchars($message['id']) ?>" class="<?= htmlspecialchars($class) ?>">
                <?php if ($message['price'] === null) { ?>
                    <strong><?= htmlspecialchars($message['sender']) ?>:</strong>
                <?php } ?>
                <?php if ($message['offer_accepted'] && $transaction['status'] != 'sold') { ?>
                    <?php if ($username !== $seller) { ?>
                        <a href='checkout.php?price=<?= htmlspecialchars($message['price']) ?>&item_id=<?= htmlspecialchars($itemId) ?>&user=<?= htmlspecialchars($otherUser) ?>' class='accept-offer'>Proceed to checkout</a>
                    <?php } else { ?>
                        You accepted the offer of <?= htmlspecialchars($message['price']) ?> €.
                    <?php } ?>
                <?php } else { ?>
                    <?php if ($message['price'] !== null && $transaction['status'] == 'sold') { ?>
                        Item Sold!
                    <?php } else if ($message['price'] !== null) { ?>
                        <?php if ($message['sender'] === $username) { ?>
                            You sent a proposal for <?= htmlspecialchars($message['price']) ?> €
                        <?php } else { ?>
                            <?php if ($username === $seller) { ?>
                                Buyer's proposal: <?= htmlspecialchars($message['price']) ?> €
                            <?php } else { ?>
                                Seller's proposal: <?= htmlspecialchars($message['price']) ?> €
                            <?php } ?>
                            <br>
                            <?php if ($transaction['status'] != 'sold') { ?>
                                <a href='api_accept_offer.php?price=<?= htmlspecialchars($message['price']) ?>&item_id=<?= htmlspecialchars($itemId) ?>&message_id=<?= htmlspecialchars($message['id']) ?>&user=<?= htmlspecialchars($otherUser) ?>' class='accept-offer'>Accept Offer</a>
                                <button onclick="showCounterOfferForm(<?= htmlspecialchars($itemId) ?>)" class='counter-offer'>Counter Offer</button>
                                <div id="counter-offer-<?= htmlspecialchars($itemId) ?>" class="counter-offer-form">
                                    <form id="counter-offer-form-<?= htmlspecialchars($itemId) ?>" onsubmit="event.preventDefault(); sendCounterOffer(<?= htmlspecialchars($itemId) ?>, '<?= htmlspecialchars($otherUser) ?>');">
                                        <input type="number" name="new_price" placeholder="New Price" required>
                                        <button type="submit">Submit New Price</button>
                                    </form>
                                </div>
                            <?php } ?>
                        <?php } ?>
                    <?php } else { ?>
                        <?= htmlspecialchars($message['message_text']) ?>
                    <?php } ?>
                <?php } ?>
                <br><small>Sent on <?= htmlspecialchars($date) ?></small>
            </p>
        <?php } ?>
    </div>
    <form action="send_message.php" method="post">
        <input type="hidden" name="receiver" value="<?= htmlspecialchars($otherUser) ?>">
        <input type="hidden" name="item_id" value="<?= htmlspecialchars($itemId) ?>">
        <input type="text" name="message_text" placeholder="Write your message here..." required>
        <input type="submit" value="Send">
    </form>
    <?php if ($username != $seller && $transaction['status'] != 'sold') { ?>
        <form action="send_message.php" method="post" id="negotiateFields">
            <input type="hidden" name="receiver" value="<?= htmlspecialchars($otherUser) ?>">
            <input type="hidden" name="item_id" value="<?= htmlspecialchars($itemId) ?>">
            <input type="number" name="price" placeholder="Proposed Price" required>
            <button type="submit">Send Proposal</button>
        </form>
    <?php } ?>
</div>
<script src="/scripts/negotiate_price.js" defer></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var msgContainer = document.querySelector('.msg-container');
        msgContainer.scrollTop = msgContainer.scrollHeight;
    });

    function showCounterOfferForm(itemId) {
        document.getElementById('counter-offer-' + itemId).style.display = 'block';
    }

    function sendCounterOffer(itemId, otherUser) {
        const form = document.getElementById('counter-offer-form-' + itemId);
        const newPrice = form.new_price.value;
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'api_counter_offer.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status === 200) {
                location.reload();
            } else {
                alert('Failed to send counter offer. Please try again.');
            }
        };
        xhr.send('item_id=' + itemId + '&user=' + otherUser + '&new_price=' + newPrice + '&csrf=<?= $_SESSION['csrf'] ?>');
    }
</script>

<?php 
output_footer();
?>
