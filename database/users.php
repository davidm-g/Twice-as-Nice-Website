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
