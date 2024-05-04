<?php
    require_once('database/connection.php');
    require_once('templates/categories.php');
    require_once('templates/common.php');
    require_once('database/items.php');
    $db = getDatabaseConnection();
    $cats = getCategories($db);

    // Start the session
    session_start();

    // Get the username from the session
    $username = $_SESSION['username'];

    // Get the item id and the price from the URL parameters
    $itemId = $_GET['item_id'];
    $price = $_GET['price'];

    // Fetch the item details from the database
    $stmt = $db->prepare("SELECT * FROM items WHERE id = :item_id");
    $stmt->execute([':item_id' => $itemId]);
    $item = $stmt->fetch(PDO::FETCH_ASSOC);

    output_header();
    output_categories($db, $cats);
?>

<h1>Checkout for <?= $item['name'] ?></h1>
<p>Seller: <?= $item['seller'] ?></p>

<form action="checkout.php" method="post">
    <input type="hidden" name="item_id" value="<?= $itemId ?>">
    <input type="hidden" name="price" value="<?= $price ?>">
    <label for="address">Address:</label><br>
    <input type="text" id="address" name="address" required><br>
    <label for="payment_method">Payment Method:</label><br>
    <select id="payment_method" name="payment_method" required>
        <option value="">Select a payment method</option>
        <option value="credit_card">Credit Card</option>
        <option value="paypal">PayPal</option>
    </select><br>
    <input type="submit" value="Confirm Payment">
</form>
<?php output_footer(); ?>