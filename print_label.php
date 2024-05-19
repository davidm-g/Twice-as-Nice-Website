<?php
session_start();

require_once ('templates/common.php'); 

// Check if the shipping label is set
if (!isset($_SESSION['shipping_label'])) {
    die('No shipping label found');
}

// Get the shipping label
$label = $_SESSION['shipping_label'];

// Unset the shipping label so it doesn't get displayed again
unset($_SESSION['shipping_label']);


?>
<link href="css/label.css" rel="stylesheet">
<div id="shipping-label">
    <h2>Shipping Label</h2>
    <?php echo nl2br(htmlspecialchars($label)); ?>
</div>
<a id="print-button" href="javascript:window.print();">Print Shipping Label</a>
<script src="scripts/shipping_label.js" defer></script>
