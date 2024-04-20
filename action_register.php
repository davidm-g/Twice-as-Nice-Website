<?php
    session_start();                                         // starts the session

    require_once('database/connection.php');                 // database connection
    require_once('database/users.php');                      // user table queries

    $db = getDatabaseConnection();                           // connecting to the database

    addUser($db, $_POST['username'], $_POST['name'], $_POST['email'], $_POST['password']); // add user to the database
    
    $_SESSION['login'] = true;                   // set session login to true
    header('Location: index.php');                  // redirect to index.php
?>