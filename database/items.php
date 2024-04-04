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
            WHERE item_id = :it_id");
        $stmt->execute([':it_id' => $it_id]);
        $img = $stmt->fetch();
        return $img['image_url'];
    }
    
    function getSeller($db, $uname) {
        $stmt = $db->prepare(
            "SELECT name from users
            WHERE username = :uname");
        $stmt->execute([':uname' => $uname]);
        $nm = $stmt->fetch();
        return $nm['name'];
    }
    
    function getSize($db, $sz) {
        $stmt = $db->prepare(
            "SELECT name from sizes
            WHERE id = :sz");
        $stmt->execute([':sz' => $sz]);
        $size = $stmt->fetch();
        return $size['name'];
    }

    function getCondition($db, $cd) {
        $stmt = $db->prepare(
            "SELECT name from conditions
            WHERE id = :cd");
        $stmt->execute([':cd' => $cd]);
        $cond = $stmt->fetch();
        return $cond['name'];
    }
    
    function getBrand($db, $bd) {
        $stmt = $db->prepare(
            "SELECT name from brands
            WHERE id = :bd");
        $stmt->execute([':bd' => $bd]);
        $brd = $stmt->fetch();
        return $brd['name'];
    }

    function getPrice($db, $it_id) {
        $stmt = $db->prepare(
            "SELECT price from transactions
            WHERE item_id = :it_id");
        $stmt->execute([':it_id' => $it_id]);
        $prc = $stmt->fetch();
        return $prc['price'];
    }

    
?>
<?php function outputItem($db,$item){ 
        $img_url=getImage($db,$item['id']); 
        $seller=getSeller($db,$item['seller']);
        $size=getSize($db,$item['size']);
        $condition=getCondition($db,$item['condition']);
        $brand=getBrand($db,$item['brand']);
        $price=getPrice($db,$item['id']);  ?>
    <article>
        <h3><?= $item['description'] ?></h3>
        <img src=<?=$img_url?> alt="iPhone 12">
        <p>Seller: <?=$seller?></p>
        <p>Size: <?=$size?></p>
        <p>Condition: <?= $condition?></p>
        <p>Brand: <?=$brand?></p>
        <p>Price: <?= $price?></p>
    </article>
<?php } ?>