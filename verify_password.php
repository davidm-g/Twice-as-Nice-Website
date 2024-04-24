<?php
session_start();
require_once('database/connection.php');
require_once('database/users.php');

$db = getDatabaseConnection();

$username = $_SESSION['username'];
$user = getUserByUsername($db, $username);
$password = $_POST['password'];
    if (password_verify($password, $user['password'])) {
        echo json_encode(true);
    } else {
        echo json_encode(false);
    }

