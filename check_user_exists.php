<?php
require_once('database/connection.php');
require_once('database/users.php');

$db = getDatabaseConnection();

$username = htmlspecialchars($_GET['username']);

$stmt = $db->prepare("SELECT username FROM users WHERE username = :username");
$stmt->execute(['username' => $username]);
$user = $stmt->fetch();

if ($user) {
    echo 'true';
} else {
    echo 'false';
}