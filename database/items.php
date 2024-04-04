<?php
    function getItems($db) {
        $stmt = $db->prepare("SELECT * FROM items");
        $stmt->execute();
        $items = $stmt->fetchAll();
        return $items;
    }

    function getImage($db, $it_id) {
        $stmt = $db->prepare(
            "SELECT image_url from images
            WHERE item_id = $it_id");
        $stmt->execute();
        $img = $stmt->fetchAll();
        return $img;
    }

    function getSeller($db, $uname) {
        $stmt = $db->prepare(
            "SELECT name from users
            WHERE username = $uname");
        $stmt->execute();
        $nm = $stmt->fetchAll();
        return $nm;
    }

    function getSize($db, $sz) {
        $stmt = $db->prepare(
            "SELECT name from sizes
            WHERE id = $sz");
        $stmt->execute();
        $size = $stmt->fetchAll();
        return $size;
    }

    function getCondition($db, $cd) {
        $stmt = $db->prepare(
            "SELECT name from conditions
            WHERE id = $cd");
        $stmt->execute();
        $cond = $stmt->fetchAll();
        return $cond;
    }
    
    function getBrand($db, $bd) {
        $stmt = $db->prepare(
            "SELECT name from brands
            WHERE id = $bd");
        $stmt->execute();
        $brd = $stmt->fetchAll();
        return $brd;
    }

    function getPrice($db, $it_id) {
        $stmt = $db->prepare(
            "SELECT price from transactions
            WHERE item_id = $it_id");
        $stmt->execute();
        $prc = $stmt->fetchAll();
        return $prc;
    }
?>