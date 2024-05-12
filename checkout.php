<?php
    require_once('database/connection.php');
    require_once('templates/categories.php');
    require_once('templates/common.php');
    require_once('database/items.php');
    $db = getDatabaseConnection();
    $cats = getCategories($db);
    session_start();
    $username = $_SESSION['username'];
    $itemId = $_GET['item_id'];
    $price = $_GET['price'];
    $otherUser = $_GET['user'];
    $item = getItem($db, $itemId);
    output_header();
    output_categories($db, $cats);
?>

<h1>Checkout for <?= $item['name'] ?></h1>
<p>Seller: <?= $item['seller'] ?></p>
<p>Price: <?= $price ?> €</p>

<form action="api_process_payment.php" method="post">
    <input type="hidden" name="item_id" value="<?= $itemId ?>">
    <input type="hidden" name="price" value="<?= $price ?>">
    <input type="hidden" name="other_user" value="<?= $otherUser ?>">
    <label for="address">Address:</label><br>
    <textarea id="address" name="address" required></textarea><br>
    <label for="payment_method">Payment Method:</label><br>
    <select id="payment_method" name="payment_method" required>
        <option value="">Select a payment method</option>
        <option value="credit_card">Credit Card</option>
        <option value="debit_card">Debit Card</option>
        <option value="paypal">PayPal</option>
        <option value="bank_transfer">Bank Transfer</option>
    </select><br>
    <input type="submit" value="Confirm Payment">
</form>
<?php output_footer(); ?>