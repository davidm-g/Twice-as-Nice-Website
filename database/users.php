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
?>