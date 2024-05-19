<?php
    session_set_cookie_params(0, '/', 'localhost', false, true);
    session_start();                                         // starts the session

    require_once('../database/connection.php');                 // database connection
    require_once('../database/users.php');                      // user table queries

    $db = getDatabaseConnection_folder();   
    if ($_SESSION['csrf'] !== $_POST['csrf']) {
        die('Error: Invalid request. Please refresh the page and try again.');
    }                        
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_SESSION['username'];
        if (isset($_POST['update_name'])) {
            $name = preg_replace("/[^a-zA-Z0-9\s]/", "", $_POST['name']);
            updateName($name, $username, $db);
        }
        elseif (isset($_POST['update_email'])) {
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            updateEmail($email, $username, $db);
        }
        elseif (isset($_POST['update_password'])) {
            $password = $_POST['new_password'];
            updatePassword($password, $username, $db);
        }
        elseif (isset($_POST['update_picture'])) {
            $picture = $_POST['picture'];
            updatePicture($picture, $username, $db);
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