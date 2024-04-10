<?php
    function getItems($db) {
        $stmt = $db->prepare("SELECT * FROM items");
        $stmt->execute();
        $items = $stmt->fetchAll();
        return $items;
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