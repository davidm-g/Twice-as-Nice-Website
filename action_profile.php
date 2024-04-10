<?php
    session_start();                                         // starts the session

    require_once('database/connection.php');                 // database connection
    require_once('database/users.php');                      // user table queries

    $db = getDatabaseConnection();                           // connecting to the database
    
    if (isset($_POST['name'])) {

    }

    elseif (isset($_POST['username'])) {

    }

    elseif (isset($_POST['email'])) {

    }

    elseif (isset($_POST['password'])) {

    }

    header('Location: ' . $_SERVER['HTTP_REFERER']);         // redirects to the previous page
