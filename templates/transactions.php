<?php
function get_transactions($username, $db) {
    $stmt = $db->prepare("SELECT t.*, i.name as item_name, img.image_url FROM transactions t JOIN items i ON t.item_id = i.id LEFT JOIN images img ON i.id = img.item_id WHERE t.seller = :username");
    $stmt->execute(['username' => $username]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
} ?>

<?php function output_transaction($transaction) { ?>
    <article>
        <h4>Item: <?php echo htmlspecialchars($transaction['item_name']); ?></h4>
        <?php if (!empty($transaction['image_url'])){ ?>
            <img src="<?php echo htmlspecialchars($transaction['image_url']); ?>" alt="<?php echo htmlspecialchars($transaction['item_name']); ?>">
        <?php } ?>
        <p>Status: <?php echo htmlspecialchars($transaction['status']); ?></p>
        <?php if ($transaction['status'] !== 'sold'){ ?>
        <p class="item-price">Price: <?php echo htmlspecialchars($transaction['price']); ?> €</p>
        <form id="manage-item-<?php echo htmlspecialchars($transaction['item_id']); ?>">
            <input type="hidden" name="item_id" value="<?php echo htmlspecialchars($transaction['item_id']); ?>">
            <div id="new-price-<?php echo htmlspecialchars($transaction['item_id']); ?>" style="display: none;">
                <input type="number" name="new_price" min="0" step="5" placeholder="New price" required>
                <input type="button" onclick="changePrice('<?php echo htmlspecialchars($transaction['item_id']); ?>')" value="Submit New Price">
            </div>
            <button type="button" onclick="showNewPrice('<?php echo htmlspecialchars($transaction['item_id']); ?>')">Change Price</button>
            <input type="button" onclick="deleteItem('<?php echo htmlspecialchars($transaction['item_id']); ?>')" value="Delete Item">
        </form>
        <?php } ?>
    </article>
<?php } ?>


<?php function output_wardrobe($username, $db) {
    $transactions = get_transactions($username, $db);
    foreach ($transactions as $transaction) {
        output_transaction($transaction);
    }
}
?>
