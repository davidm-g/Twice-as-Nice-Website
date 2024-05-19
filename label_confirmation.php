<?php
session_start();

require_once ('templates/common.php'); 

// Check if the payment was successful
if (!isset($_SESSION['payment_success'])) {
    die('No payment found');
}

// Get the success message
$message = $_SESSION['payment_success'];

// Unset the success message so it doesn't get displayed again
unset($_SESSION['payment_success']);

output_header();
?>

<p><?php echo htmlspecialchars($message); ?></p>
<p>Do you want to print the shipping label?</p>
<button id="yes-button" onclick="window.location.href='print_label.php';">Yes</button>
<button id="no-button" onclick="window.location.href='../messages.php?user=<?php echo urlencode($_GET['user']); ?>&item=<?php echo urlencode($_GET['item']); ?>';">No</button>

<?php
output_footer();
?>