<?php
    session_start();                                         // starts the session

    require_once('../database/connection.php');                 // database connection
    require_once('../database/users.php');                      // user table queries

    $db = getDatabaseConnection_folder();                           // connecting to the database
    if ($_SESSION['csrf'] !== $_POST['csrf']) {
        die('Error: Invalid request. Please refresh the page and try again.');
    }
    $username = htmlspecialchars($_POST['username']);
    $password = $_POST['password'];

    if (userExists($db, $username, $password)) {  // test if user exists
        $_SESSION['username'] = $username;  
        $_SESSION['picture'] = getProfilePic($db, $username);  
        $_SESSION['sortOrder'] = '0';   
        $_SESSION['direction'] = '0';                       // set default sort direction = ASC
        $_SESSION['brands'] = array();
        $_SESSION['sizes'] = array();
        $_SESSION['conditions'] = array(); 
        $_SESSION['price'] = '';     
        $_SESSION['search'] = '';                           
        $_SESSION['category'] = '';                         
    }
    
    header('Location: ../index.php');         // redirect to the page we came from
    exit;
