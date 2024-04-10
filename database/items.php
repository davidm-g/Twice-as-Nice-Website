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

    function getCategories($db) {
        $stmt = $db->prepare("SELECT * FROM categories");
        $stmt->execute();
        $categories = $stmt->fetchAll();
        return $categories;
    }
    
    function getSubcategories($db, $cat_id) {
        $stmt = $db->prepare(
            "SELECT * from subcategories
            WHERE category_id = :cat_id");
        $stmt->execute([':cat_id' => $cat_id]);
        $subcategories = $stmt->fetchAll();
        return $subcategories;
    }
?>
<?php 
function outputItem($db, $item_id) {
    $stmt = $db->prepare(
        "SELECT items.name, items.description, images.image_url, users.name AS seller, sizes.name AS size, conditions.name AS condition, brands.name AS brand
        FROM items
        LEFT JOIN images ON items.id = images.item_id
        LEFT JOIN users ON items.seller = users.username
        LEFT JOIN sizes ON items.size = sizes.id
        LEFT JOIN conditions ON items.condition = conditions.id
        LEFT JOIN brands ON items.brand = brands.id
        WHERE items.id = :item_id"
    );
    $stmt->execute([':item_id' => $item_id]);
    $item = $stmt->fetch();
?>
    <article>
        <h3><?= $item['name'] ?></h3>
        <a href="item_page.html">
        <img src=<?=$item['image_url']?> alt=<?=$item['description']?>>
        </a>
        <p>Seller: <?=$item['seller']?></p>
        <p>Size: <?=$item['size']?></p>
        <p>Condition: <?= $item['condition']?></p>
        <p>Brand: <?=$item['brand']?></p>
        <p>Description: <?= $item['description']?></p>
    </article>
<?php 
} 
?>