<?php
session_start();
require_once ('database/connection.php');
require_once ('database/items.php');

$db = getDatabaseConnection();

$username = htmlspecialchars($_SESSION['username']);
$item_id = htmlspecialchars($_POST['item_id']);
$type = htmlspecialchars($_POST['type']);

toggleWishlist($db, $item_id, $username);

if($type == '0') {
    echo isOnWishlist($db, $item_id, $username) ? 'fa-solid fa-heart' : 'fa-regular fa-heart';
} else {
    echo json_encode(['text' => isOnWishlist($db, $item_id, $username) ? 'Remove from Wishlist' : 'Add to Wishlist',
        'bgcolor' => isOnWishlist($db, $item_id, $username) ? '#4A4E69' : 'transparent',
        'color' => isOnWishlist($db, $item_id, $username) ? '#F2E9E4' : '#4A4E69']);
}
