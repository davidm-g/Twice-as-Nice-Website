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

    function getSeller($db, $id) {
        $stmt = $db->prepare(
            "SELECT seller from items
            WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $uname = ($stmt->fetch())['seller'];
        $stmt2 = $db->prepare(
            "SELECT name from users
            WHERE username = :uname");
        $stmt2->execute([':uname' => $uname]);
        $nm = $stmt2->fetch();
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

    function getCategory($db, $id) {
        $stmt = $db->prepare(
            "SELECT category_id from item_categories
            WHERE item_id = :id");
        $stmt->execute([':id' => $id]);
        $cat_id = ($stmt->fetch())['category_id'];
        $stmt2 = $db->prepare(
            "SELECT name from categories
            WHERE id = :cat_id");
        $stmt2->execute([':cat_id' => $cat_id]);
        $cat = $stmt2->fetch();
        return $cat['name'];
    }

    function getCategoryId($db, $id) {
        $stmt = $db->prepare(
            "SELECT category_id from item_categories
            WHERE item_id = :id");
        $stmt->execute([':id' => $id]);
        $cat_id = ($stmt->fetch());
        return $cat_id['category_id'];
    }

    function getCategoryName($db, $cat_id) {
        $stmt = $db->prepare(
            "SELECT name from categories
            WHERE id = :cat_id");
        $stmt->execute([':cat_id' => $cat_id]);
        $cat_nm = ($stmt->fetch());
        return $cat_nm['name'];
    }
    
    function getBrand($db, $bd) {
        $stmt = $db->prepare(
            "SELECT name from brands
            WHERE id = :bd");
        $stmt->execute([':bd' => $bd]);
        $brd = $stmt->fetch();
        return $brd['name'];
    }

    function getTitle($db, $id) {
        $stmt = $db->prepare(
            "SELECT name from items
            WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $tt = $stmt->fetch();
        return $tt['name'];
    }

    function getPrice($db, $it_id) {
        $stmt = $db->prepare(
            "SELECT price from transactions
            WHERE item_id = :it_id");
        $stmt->execute([':it_id' => $it_id]);
        $prc = $stmt->fetch();
        return $prc['price'];
    }

    function getDescription($db, $it_id) {
        $stmt = $db->prepare(
            "SELECT description from items
            WHERE id = :it_id");
        $stmt->execute([':it_id' => $it_id]);
        $dsc = $stmt->fetch();
        return $dsc['description'];
    }
    
    function getSizes($db) {
        $stmt = $db->prepare("SELECT * FROM sizes");
        $stmt->execute();
        $sizes = $stmt->fetchAll();
        return $sizes;
    }
    
    function getConditions($db) {
        $stmt = $db->prepare("SELECT * FROM conditions");
        $stmt->execute();
        $conditions = $stmt->fetchAll();
        return $conditions;
    }
    
    function getBrands($db) {
        $stmt = $db->prepare("SELECT * FROM brands");
        $stmt->execute();
        $brands = $stmt->fetchAll();
        return $brands;
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
function outputItem($db, $item) {
        $img_url=getImage($db,$item['id']); 
        $price=getPrice($db,$item['id']);  ?>
    <div id='card'>
        <a href="item_page.php?id=<?=$item['id']?>">
            <img src=<?=$img_url?> alt=<?=$item['description']?>>
        </a>
        <p><?= $item['name']?></p>
        <p><?= $price?> €</p>
    </div>
<?php }

function outputItems($db, $items) { ?>
    <h1>Item Feed</h1>
        <aside id="random_items">
            <?php foreach ($items as $item) { 
                outputItem($db,$item);
            } ?>    
        </aside>
<?php } 




