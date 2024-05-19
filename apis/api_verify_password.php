<?php
session_set_cookie_params(0, '/', 'localhost', false, true);
session_start();
require_once('../database/connection.php');
require_once('../database/users.php');

$db = getDatabaseConnection_folder();

$username = $_SESSION['username'];
$user = getUserByUsername($db, $username);
$password = $_POST['password'];
    if (password_verify($password, $user['password'])) {
        echo json_encode(true);
    } else {
        echo json_encode(false);
    }

