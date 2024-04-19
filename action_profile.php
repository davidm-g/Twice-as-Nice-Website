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
    elseif (isset($_POST['elevate'])) {
        $username = $_POST['elevate_username'];
        try {
            elevateToAdmin($username, $db);
        } catch (Exception $e) {
            $_SESSION['elevate_message'] = $e->getMessage();
        }
        
        
    }
    elseif (isset($_POST['add_category'])) {
        $category = $_POST['category'];
        addCategory($category, $db);
    } elseif (isset($_POST['add_subcategory'])) {
        $subcategory = $_POST['subcategory'];
        $categoryId = $_POST['category_id'];
        addSubcategory($subcategory, $categoryId, $db);
    } elseif (isset($_POST['add_size'])) {
        $size = $_POST['size'];
        addSize($size, $db);
    } elseif (isset($_POST['add_brand'])) {
        $brand = $_POST['brand'];
        addBrand($brand, $db);
    } elseif (isset($_POST['add_condition'])) {
        $condition = $_POST['condition'];
        addCondition($condition, $db);
    }
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
    
           
