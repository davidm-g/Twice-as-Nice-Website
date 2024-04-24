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
    function addUser($db, $pic, $un, $nm, $em, $pw) {
        if(empty($pic)) {
            $pic = 'database/images/PROFILE_PIC.jpg';
        }
        $hash = password_hash($pw, PASSWORD_DEFAULT);
        $stmt = $db->prepare(
            "INSERT OR IGNORE INTO users (username, name, password, email, role, profile_pic) VALUES
            ('$un', '$nm', '$hash', '$em', 'user', '$pic')"
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

    function updateName($name, $username, $db) {
        $stmt = $db->prepare("UPDATE users SET name = :name WHERE username = :username");
        $stmt->execute(['name' => $name, 'username' => $username]);
    }

    function updateUsername($newUsername, $username, $db) {
        $stmt = $db->prepare("UPDATE users SET username = :newUsername WHERE username = :username");
        $stmt->execute(['newUsername' => $newUsername, 'username' => $username]);
    }

    function updateEmail($email, $username, $db) {
        $stmt = $db->prepare("UPDATE users SET email = :email WHERE username = :username");
        $stmt->execute(['email' => $email, 'username' => $username]);
    }

    function updatePassword($password, $username, $db) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $db->prepare("UPDATE users SET password = :password WHERE username = :username");
        $stmt->execute(['password' => $hashedPassword, 'username' => $username]);
    }

    function updatePicture($picture, $username, $db) {
        if (empty($picture)) {
            return;
        }
        $stmt = $db->prepare("UPDATE users SET profile_pic = :picture WHERE username = :username");
        $stmt->execute(['picture' => $picture, 'username' => $username]);
        $_SESSION['picture'] = $picture;
    }
    
    function getUserByUsername($db, $username) {
        $stmt = $db->prepare('SELECT * FROM users WHERE username = ?');
        $stmt->execute(array($username));
        $user = $stmt->fetch();
        return $user;
    }

    function getProfilePic($db, $username) {
        $stmt = $db->prepare("SELECT profile_pic FROM users WHERE username = :uname");
        $stmt->execute([':uname' => $username]);
        $pic = $stmt->fetch();
        return $pic['profile_pic'];
    }
