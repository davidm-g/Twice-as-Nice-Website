<?php
    function userExists($db, $username, $password) {
        $password = sha1($password);
        $query = $db->prepare('SELECT * FROM users WHERE username = ? AND password = ?');
        $query->execute(array($username, $password));
        return $query !== false;
    }
?>