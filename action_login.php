<?php
    session_start();                                         // starts the session

    require_once('database/connection.php');                 // database connection
    require_once('database/users.php');                      // user table queries

    $db = getDatabaseConnection();                           // connecting to the database

    if (userExists($db, $_POST['username'], $_POST['password'])) {  // test if user exists
        $_SESSION['username'] = $_POST['username'];  
        $_SESSION['picture'] = getProfilePic($db, $_POST['username']);  // set session variables
        $_SESSION['sortOrder'] = '0';                       // set default sort order
    }

    header('Location: index.php');         // redirect to the page we came from
    exit;
?>