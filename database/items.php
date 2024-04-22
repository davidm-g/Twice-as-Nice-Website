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

    function getSize($db, $id) {
        $stmt = $db->prepare(
            "SELECT size from items
            WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $size_id = ($stmt->fetch())['size'];
        $stmt2 = $db->prepare(
            "SELECT name from sizes
            WHERE id = :size_id");
        $stmt2->execute([':size_id' => $size_id]);
        $size_name = $stmt2->fetch();
        return $size_name['name'];
    }
    
    function getCondition($db, $id) {
        $stmt = $db->prepare(
            "SELECT condition from items
            WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $cond_id = ($stmt->fetch())['condition'];
        $stmt2 = $db->prepare(
            "SELECT name from conditions
            WHERE id = :cond_id");
        $stmt2->execute([':cond_id' => $cond_id]);
        $cond_name = $stmt2->fetch();
        return $cond_name['name'];
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
    
    function getBrand($db, $id) {
        $stmt = $db->prepare(
            "SELECT brand from items
            WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $brand_id = ($stmt->fetch())['brand'];
        $stmt2 = $db->prepare(
            "SELECT name from brands
            WHERE id = :brand_id");
        $stmt2->execute([':brand_id' => $brand_id]);
        $brand_name = $stmt2->fetch();
        return $brand_name['name'];
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

    function addToWishlist($db, $item_id, $username) {
        $stmt = $db->prepare(
            "INSERT INTO wishlist (item_id, username) VALUES (:item_id, :username)"
        );
        $stmt->execute(['item_id' => $item_id, 'username' => $username]);
    }

    function removeFromWishlist($db, $item_id, $username) {
        $stmt = $db->prepare(
            "DELETE FROM wishlist WHERE item_id = :item_id AND username = :username"
        );
        $stmt->execute(['item_id' => $item_id, 'username' => $username]);
    }

    function isOnWishlist($db, $item_id, $username) {
        $stmt = $db->prepare(
            "SELECT * FROM wishlist WHERE item_id = :item_id AND username = :username"
        );
        $stmt->execute(['item_id' => $item_id, 'username' => $username]);
        $item = $stmt->fetch();
        return $item !== false;
    }

    function toggleWishlist($db, $item_id, $username) {
        if (isOnWishlist($db, $item_id, $username)) {
            removeFromWishlist($db, $item_id, $username);
        } else {
            addToWishlist($db, $item_id, $username);
        }
    }

    function outputItem($db, $item) {
            $img_url=getImage($db,$item['id']); 
            $price=getPrice($db,$item['id']);  ?>
        <div class='card' id='<?=$item['id']?>'>
            <a href="item_page.php?id=<?=$item['id']?>">
                <img src=<?=$img_url?> alt=<?=$item['description']?>>
            </a>
            <p><?= $item['name']?></p>
            <p><?= $price?> €</p>
            <?php if(isset($_SESSION['username'])) { ?>
                <i id="wish<?=$item['id']?>"
                    class="<?=(isOnWishlist($db, $item['id'], $_SESSION['username'])) ? 'fa-solid fa-heart' : 'fa-regular fa-heart'?>"
                >
                </i>
            <?php } ?>
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




