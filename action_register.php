<?php
    session_start();                                         // starts the session

    require_once('database/connection.php');                 // database connection
    require_once('database/users.php');                      // user table queries

    $db = getDatabaseConnection();                           // connecting to the database

    addUser($db, $_POST['username'], $_POST['name'], $_POST['email'], $_POST['password']);
    
    header('Location: login.php');         // redirect to the page we came from
?>