<?php
    require_once('database/connection.php');
    require_once('templates/categories.php');
    require_once('templates/common.php');
    require_once('database/items.php');
    session_set_cookie_params(0, '/', 'localhost', false, true);
    $db = getDatabaseConnection();
    $cats = getCategories($db);
    session_start();
    if (!isset($_SESSION['csrf'])) {
        $_SESSION['csrf'] = generate_random_token();
    } 
    $username = htmlspecialchars($_SESSION['username']);
    $itemId = htmlspecialchars($_POST['item_id']);
    $price = htmlspecialchars($_POST['price']);
    $otherUser = htmlspecialchars($_POST['user']);
    $item = getItem($db, $itemId);
    output_header();
    output_categories($db, $cats);
?>

<h1>Checkout for <?= htmlspecialchars($item['name']) ?></h1>
<h1>Seller: <?= htmlspecialchars($item['seller']) ?></h1>
<h1>Price: <?= htmlspecialchars($price) ?> €</h1>
<div id="checkout-form">
<form action="apis/api_process_payment.php" method="post">
    <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
    <input type="hidden" name="item_id" value="<?= htmlspecialchars($itemId) ?>">
    <input type="hidden" name="price" value="<?= htmlspecialchars($price) ?>">
    <input type="hidden" name="other_user" value="<?= htmlspecialchars($otherUser) ?>">

    <label for="country">Country:</label><br>
    <input id="country" name="country" required><br>

    <label for="city">City:</label><br>
    <input id="city" name="city" required><br>

    <label for="zipcode">Zip Code:</label><br>
    <input id="zipcode" name="zipcode" required><br>

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

    <fieldset id="credit_card_info" style="display: none;">
        <label for="card_number">Card Number:</label><br>
        <input id="card_number" name="card_number"><br>
    </fieldset>

    <fieldset id="paypal_info" style="display: none;">
        <label for="paypal_email">PayPal Email:</label><br>
        <input id="paypal_email" name="paypal_email"><br>
    </fieldset>

    <fieldset id="bank_transfer_info" style="display: none;">
        <label for="bank_account">Bank Account Number:</label><br>
        <input id="bank_account" name="bank_account"><br>
    </fieldset>

    <input type="submit" value="Confirm Payment">
</form>
</div>
<script src="/scripts/payment_options.js" defer></script>
<?php output_footer(); ?>