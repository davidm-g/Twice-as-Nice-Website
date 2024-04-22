<?php
session_start();
require_once('database/connection.php');
require_once('database/users.php');

$db = getDatabaseConnection();

$username = $_SESSION['username'];
$user = getUserByUsername($db, $username);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = $_POST['password'];
    if (password_verify($password, $user['password'])) {
        echo 'true';
    } else {
        echo 'false';
    }
}
