<?php
session_start();
require_once ('database/connection.php');
require_once ('database/items.php');

$db = getDatabaseConnection();

$item_id = htmlspecialchars($_POST['item_id']);
$username = htmlspecialchars($_SESSION['username']);

toggleWishlist($db, $item_id, $username);

echo isOnWishlist($db, $item_id, $username) ? 'fa-solid fa-heart' : 'fa-regular fa-heart';
?>