<?php
    
    function userExists($db, $username, $password) {
        $hash = $db->prepare('SELECT password FROM users WHERE username = ?');
        $hash->execute(array($username));
        $result = $hash->fetch(); // Fetch the result
        if ($result && password_verify($password, $result['password'])) {
            return true;
        } else {
            return false;
        }
    }    
    function addUser($db, $un, $nm, $em, $pw) {
        $hash = password_hash($pw, PASSWORD_DEFAULT);
        $stmt = $db->prepare(
            "INSERT OR IGNORE INTO users (username, name, password, email, role) VALUES
            ('$un', '$nm', '$hash', '$em', 'user')"
        );
        $stmt->execute();
    }

    function isAdmin($username,$db) {
    $stmt = $db->prepare("SELECT role FROM users WHERE username = :username");
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch();
    return $user && $user['role'] === 'admin';
    }
    function elevateToAdmin($username, $db) {
        $stmt = $db->prepare("UPDATE users SET role = 'admin' WHERE username = :username");
        $stmt->execute(['username' => $username]);
    }
    
    function addCategory($category, $db) {
        $stmt = $db->prepare("INSERT INTO categories (name) VALUES (:name)");
        $stmt->execute(['name' => $category]);
    }
    
    function addSubcategory($subcategory, $categoryId, $db) {
        $stmt = $db->prepare("INSERT INTO subcategories (name, category_id) VALUES (:name, :category_id)");
        $stmt->execute(['name' => $subcategory, 'category_id' => $categoryId]);
    }
    
    function addSize($size, $db) {
        $stmt = $db->prepare("INSERT INTO sizes (name) VALUES (:name)");
        $stmt->execute(['name' => $size]);
    }
    
    function addBrand($brand, $db) {
        $stmt = $db->prepare("INSERT INTO brands (name) VALUES (:name)");
        $stmt->execute(['name' => $brand]);
    }
    
    function addCondition($condition, $db) {
        $stmt = $db->prepare("INSERT INTO conditions (name) VALUES (:name)");
        $stmt->execute(['name' => $condition]);
    }
