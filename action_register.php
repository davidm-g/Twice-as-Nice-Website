<?php
    session_start();                                         // starts the session

    require_once('database/connection.php');                 // database connection
    require_once('database/users.php');                      // user table queries

    $db = getDatabaseConnection();                           // connecting to the database
    if ($_SESSION['csrf'] !== $_POST['csrf']) {
        die('Error: Invalid request. Please refresh the page and try again.');
    }
    $picture = htmlspecialchars($_POST['picture']);
    $username = htmlspecialchars($_POST['username']);
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    addUser($db, $picture, $username, $name, $email, $password); // add user to the database
    
    $_SESSION['login'] = true;
    if (!isset($_SESSION['csrf'])) {
        $_SESSION['csrf'] = generate_random_token();
    }                   
    header('Location: index.php');                  // redirect to index.php
