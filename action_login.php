<?php
    session_start();                                         // starts the session

    require_once('database/connection.php');                 // database connection
    require_once('database/users.php');                      // user table queries

    $db = getDatabaseConnection();                           // connecting to the database

    if (userExists($db, $_POST['username'], $_POST['password'])) {  // test if user exists
        $_SESSION['username'] = $_POST['username'];                 // store the username
    }
    
    header('Location: index.php');         // redirect to the page we came from
?>