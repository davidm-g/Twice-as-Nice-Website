<?php
    session_start();                                         // starts the session

    require_once('database/connection.php');                 // database connection
    require_once('database/users.php');                      // user table queries

    $db = getDatabaseConnection();                           // connecting to the database
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        if (isset($_POST['name'])) {
            $name = preg_replace("/[^a-zA-Z0-9\s]/", "", $_POST['name']);
            
        }

        elseif (isset($_POST['username'])) {
            $username = preg_replace("/[^a-zA-Z0-9_\-]/", "", $_POST['username']);
            
        }

        elseif (isset($_POST['email'])) {
            $email = preg_replace("/[^a-zA-Z0-9@.]/", "", $_POST['email']);
            
        }

        elseif (isset($_POST['password'])) {
            $password = $_POST['password'];
            
        }
        elseif (isset($_POST['elevate'])) {
            $username = preg_replace("/[^a-zA-Z0-9_\-]/", "", $_POST['elevate_username']);
            elevateToAdmin($username, $db);
        }
        elseif (isset($_POST['add_category'])) {
            $category = preg_replace("/[^a-zA-Z0-9\s]/", "", $_POST['category']);
            addCategory($category, $db);
        } elseif (isset($_POST['add_subcategory'])) {
            $subcategory = preg_replace("/[^a-zA-Z0-9\s]/", "", $_POST['subcategory']);
            $categoryId = preg_replace("/[^0-9]/", "", $_POST['category_id']);
            addSubcategory($subcategory, $categoryId, $db);
        } elseif (isset($_POST['add_size'])) {
            $size = preg_replace("/[^a-zA-Z0-9]/", "", $_POST['size']);
            addSize($size, $db);
        } elseif (isset($_POST['add_brand'])) {
            $brand = preg_replace("/[^a-zA-Z0-9\s]/", "", $_POST['brand']);
            addBrand($brand, $db);
        } elseif (isset($_POST['add_condition'])) {
            $condition = preg_replace("/[^a-zA-Z0-9\s]/", "", $_POST['condition']);
            addCondition($condition, $db);
        }
    }
    header('Location: ' . preg_replace("/[^a-zA-Z0-9:\/.]/", "", $_SERVER['HTTP_REFERER']));
    exit;