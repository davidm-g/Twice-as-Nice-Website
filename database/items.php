<?php
function getItems($db)
{
    $direction = ($_SESSION['direction'] == '1') ? 'DESC' : 'ASC';
    if ($_SESSION['sortOrder'] == '1') {
        $stmt = $db->prepare("SELECT * FROM items 
                JOIN transactions ON transactions.item_id = items.id
                WHERE transactions.status = 'for sale'
                ORDER BY price COLLATE NOCASE $direction");
    } else if ($_SESSION['sortOrder'] == '2') {
        $stmt = $db->prepare("SELECT * FROM items ORDER BY name COLLATE NOCASE $direction");
    } else {
        $stmt = $db->prepare("SELECT * FROM items ORDER BY id COLLATE NOCASE $direction");
    }
    $stmt->execute();
    $items = $stmt->fetchAll();
    return $items;
}

function getFilteredItems($db)
{   if ($_SESSION['sortOrder'] == '1') { $sortOrder = 'price'; }
    else if ($_SESSION['sortOrder'] == '2') { $sortOrder = 'name'; }
    else { $sortOrder = 'id'; }
    $direction = ($_SESSION['direction'] == '1') ? 'DESC' : 'ASC';
    $query = "SELECT * FROM items 
        JOIN transactions ON transactions.item_id = items.id
        JOIN item_categories ON item_categories.item_id = items.id
        WHERE transactions.status = 'for sale'";
    if(isset($_SESSION['search']) && !empty($_SESSION['search'])) {
        $query .= " AND name LIKE '%" . $_SESSION['search'] . "%'";
    }
    if(isset($_SESSION['category']) && !empty($_SESSION['category'])) {
        if(strpos($_SESSION['category'], 'sub') === 0)
            $query .= " AND subcategory_id = " . substr($_SESSION['category'], 3);
        else
            $query .= " AND category_id = " . substr($_SESSION['category'], 3);
    }
    if(isset($_SESSION['brands']) && count($_SESSION['brands']) > 0) {
        $query .= " AND brand IN ( " . implode(',', $_SESSION['brands']) . " )";
    }
    if(isset($_SESSION['sizes']) && count($_SESSION['sizes']) > 0) {
        $query .= " AND size IN ( " . implode(',', $_SESSION['sizes']) . " )";
    }
    if(isset($_SESSION['conditions']) && count($_SESSION['conditions']) > 0) {
        $query .= " AND condition IN ( " . implode(',', $_SESSION['conditions']) . " )";
    }
    if(isset($_SESSION['price']) && !empty($_SESSION['price'])) {
        $parts = explode('-', $_SESSION['price']);
        $min = $parts[0];
        $max = $parts[1];
        if(empty($min))
            $query .= " AND price <= " . $max;
        else if(empty($max))
            $query .= " AND price >= " . $min;
        else
            $query .= " AND price >= " . $min . " AND price <= " . $max;
    }
    $query .= " ORDER BY $sortOrder COLLATE NOCASE $direction";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $items = $stmt->fetchAll();
    return $items;
}

function getImage($db, $it_id)
{
    $stmt = $db->prepare(
        "SELECT image_url from images
            WHERE item_id = :it_id"
    );
    $stmt->execute([':it_id' => $it_id]);
    $img = $stmt->fetch();
    return $img['image_url'];
}

function getSellerImage($db, $it_id)
{
    $stmt = $db->prepare(
        "SELECT seller from items
            WHERE id = :it_id"
    );
    $stmt->execute([':it_id' => $it_id]);
    $uname = ($stmt->fetch())['seller'];
    $stmt2 = $db->prepare(
        "SELECT profile_pic from users
            WHERE username = :uname"
    );
    $stmt2->execute([':uname' => $uname]);
    $img = $stmt2->fetch();
    return $img['profile_pic'];
}

function getSeller($db, $it_id)
{
    $stmt = $db->prepare(
        "SELECT seller from items
            WHERE id = :it_id"
    );
    $stmt->execute([':it_id' => $it_id]);
    $uname = ($stmt->fetch())['seller'];
    return $uname;
}

function getSellerName($db, $id)
{
    $stmt = $db->prepare(
        "SELECT seller from items
            WHERE id = :id"
    );
    $stmt->execute([':id' => $id]);
    $uname = ($stmt->fetch())['seller'];
    $stmt2 = $db->prepare(
        "SELECT name from users
            WHERE username = :uname"
    );
    $stmt2->execute([':uname' => $uname]);
    $nm = $stmt2->fetch();
    return $nm['name'];
}

function getSize($db, $id)
{
    $stmt = $db->prepare(
        "SELECT size from items
            WHERE id = :id"
    );
    $stmt->execute([':id' => $id]);
    $size_id = ($stmt->fetch())['size'];
    $stmt2 = $db->prepare(
        "SELECT name from sizes
            WHERE id = :size_id"
    );
    $stmt2->execute([':size_id' => $size_id]);
    $size_name = $stmt2->fetch();
    return $size_name['name'];
}

function getCondition($db, $id)
{
    $stmt = $db->prepare(
        "SELECT condition from items
            WHERE id = :id"
    );
    $stmt->execute([':id' => $id]);
    $cond_id = ($stmt->fetch())['condition'];
    $stmt2 = $db->prepare(
        "SELECT name from conditions
            WHERE id = :cond_id"
    );
    $stmt2->execute([':cond_id' => $cond_id]);
    $cond_name = $stmt2->fetch();
    return $cond_name['name'];
}

function getCategory($db, $id)
{
    $stmt = $db->prepare(
        "SELECT category_id from item_categories
            WHERE item_id = :id"
    );
    $stmt->execute([':id' => $id]);
    $cat_id = ($stmt->fetch())['category_id'];
    $stmt2 = $db->prepare(
        "SELECT name from categories
            WHERE id = :cat_id"
    );
    $stmt2->execute([':cat_id' => $cat_id]);
    $cat = $stmt2->fetch();
    return $cat['name'];
}

function getCategorySub($db, $subcat_id)
{
    $stmt = $db->prepare(
        "SELECT category_id from subcategories
            WHERE id = :subcat_id"
    );
    $stmt->execute([':subcat_id' => $subcat_id]);
    $cat_id = ($stmt->fetch())['category_id'];
    $stmt2 = $db->prepare(
        "SELECT * from categories
            WHERE id = :cat_id"
    );
    $stmt2->execute([':cat_id' => $cat_id]);
    $cat = $stmt2->fetch();
    return $cat;
}

function getCategoryNameSub($db, $subcat_id)
{
    $stmt = $db->prepare(
        "SELECT category_id from subcategories
            WHERE id = :subcat_id"
    );
    $stmt->execute([':subcat_id' => $subcat_id]);
    $cat_id = ($stmt->fetch())['category_id'];
    $stmt2 = $db->prepare(
        "SELECT name from categories
            WHERE id = :cat_id"
    );
    $stmt2->execute([':cat_id' => $cat_id]);
    $cat = $stmt2->fetch();
    return $cat['name'];
}

function getCategoryId($db, $id)
{
    $stmt = $db->prepare(
        "SELECT category_id from item_categories
            WHERE item_id = :id"
    );
    $stmt->execute([':id' => $id]);
    $cat_id = ($stmt->fetch());
    return $cat_id['category_id'];
}

function getCategoryName($db, $cat_id)
{
    $stmt = $db->prepare(
        "SELECT name from categories
            WHERE id = :cat_id"
    );
    $stmt->execute([':cat_id' => $cat_id]);
    $cat_nm = ($stmt->fetch());
    return $cat_nm['name'];
}

function getSubcategoryId($db, $id)
{
    $stmt = $db->prepare(
        "SELECT subcategory_id from item_categories
            WHERE item_id = :id"
    );
    $stmt->execute([':id' => $id]);
    $subcat_id = ($stmt->fetch());
    return $subcat_id['subcategory_id'];
}

function getSubcategoryName($db, $subcat_id)
{
    $stmt = $db->prepare(
        "SELECT name from subcategories
            WHERE id = :subcat_id"
    );
    $stmt->execute([':subcat_id' => $subcat_id]);
    $subcat_nm = ($stmt->fetch());
    return $subcat_nm['name'];
}

function getBrand($db, $id)
{
    $stmt = $db->prepare(
        "SELECT brand from items
            WHERE id = :id"
    );
    $stmt->execute([':id' => $id]);
    $brand_id = ($stmt->fetch())['brand'];
    $stmt2 = $db->prepare(
        "SELECT name from brands
            WHERE id = :brand_id"
    );
    $stmt2->execute([':brand_id' => $brand_id]);
    $brand_name = $stmt2->fetch();
    return $brand_name['name'];
}

function getTitle($db, $id)
{
    $stmt = $db->prepare(
        "SELECT name from items
            WHERE id = :id"
    );
    $stmt->execute([':id' => $id]);
    $tt = $stmt->fetch();
    return $tt['name'];
}

function getPrice($db, $it_id)
{
    $stmt = $db->prepare(
        "SELECT price from transactions
            WHERE item_id = :it_id"
    );
    $stmt->execute([':it_id' => $it_id]);
    $prc = $stmt->fetch();
    return $prc['price'];
}

function getDescription($db, $it_id)
{
    $stmt = $db->prepare(
        "SELECT description from items
            WHERE id = :it_id"
    );
    $stmt->execute([':it_id' => $it_id]);
    $dsc = $stmt->fetch();
    return $dsc['description'];
}

function getSizeName($db, $id)
{
    $stmt = $db->prepare(
        "SELECT name from sizes
            WHERE id = :id"
    );
    $stmt->execute([':id' => $id]);
    $size = $stmt->fetch();
    return $size['name'];
}

function getSizes($db)
{
    $stmt = $db->prepare("SELECT * FROM sizes");
    $stmt->execute();
    $sizes = $stmt->fetchAll();
    return $sizes;
}

function getConditionName($db, $id)
{
    $stmt = $db->prepare(
        "SELECT name from conditions
            WHERE id = :id"
    );
    $stmt->execute([':id' => $id]);
    $condition = $stmt->fetch();
    return $condition['name'];
}

function getConditions($db)
{
    $stmt = $db->prepare("SELECT * FROM conditions");
    $stmt->execute();
    $conditions = $stmt->fetchAll();
    return $conditions;
}

function getBrandName($db, $id)
{
    $stmt = $db->prepare(
        "SELECT name from brands
            WHERE id = :id"
    );
    $stmt->execute([':id' => $id]);
    $brand = $stmt->fetch();
    return $brand['name'];
}

function getBrands($db)
{
    $stmt = $db->prepare("SELECT * FROM brands");
    $stmt->execute();
    $brands = $stmt->fetchAll();
    return $brands;
}
function getCategories($db)
{
    $stmt = $db->prepare("SELECT * FROM categories");
    $stmt->execute();
    $categories = $stmt->fetchAll();
    return $categories;
}

function getSubcategories($db, $cat_id)
{
    $stmt = $db->prepare(
        "SELECT * from subcategories
            WHERE category_id = :cat_id"
    );
    $stmt->execute([':cat_id' => $cat_id]);
    $subcategories = $stmt->fetchAll();
    return $subcategories;
}

function addToWishlist($db, $item_id, $username)
{
    $stmt = $db->prepare(
        "INSERT INTO wishlist (item_id, username) VALUES (:item_id, :username)"
    );
    $stmt->execute(['item_id' => $item_id, 'username' => $username]);
}

function removeFromWishlist($db, $item_id, $username)
{
    $stmt = $db->prepare(
        "DELETE FROM wishlist WHERE item_id = :item_id AND username = :username"
    );
    $stmt->execute(['item_id' => $item_id, 'username' => $username]);
}

function isOnWishlist($db, $item_id, $username)
{
    $stmt = $db->prepare(
        "SELECT * FROM wishlist WHERE item_id = :item_id AND username = :username"
    );
    $stmt->execute(['item_id' => $item_id, 'username' => $username]);
    $item = $stmt->fetch();
    return $item !== false;
}

function toggleWishlist($db, $item_id, $username)
{
    if (isOnWishlist($db, $item_id, $username)) {
        removeFromWishlist($db, $item_id, $username);
    } else {
        addToWishlist($db, $item_id, $username);
    }
}

function getSearchItems($db, $query)
{
    $items = [];
    if (!empty($query)) {

        $stmt = $db->prepare("SELECT * FROM items WHERE name LIKE :query");

        $stmt->bindValue(':query', '%' . $query . '%');

        $stmt->execute();

        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    return $items;
}

function getOrders($db)
{
    $stmt = $db->prepare("SELECT * FROM orders");
    $stmt->execute();
    $orders = $stmt->fetchAll();
    return $orders;
}

function getApplied($db) {
    $stmt = $db->prepare("SELECT * FROM applied_filters");
    $stmt->execute();
    $applied = $stmt->fetchAll();
    return $applied;
}

function addFilter($db, $id, $name)
{
    // Check if a filter with the given id already exists
    $stmt = $db->prepare("SELECT * FROM applied_filters WHERE id = :id");
    $stmt->execute([':id' => $id]);
    $filter = $stmt->fetch();

    if ($filter) {
        // If a filter with the given id exists, update it
        updateFilter($db, $id, $name);
    } else {
        // If no filter with the given id exists, add a new one
        $stmt = $db->prepare("INSERT INTO applied_filters (id, name) VALUES (:id, :name)");
        $stmt->execute([':id' => $id, ':name' => $name]);
    }
}

function removeFilter($db, $id)
{
    $stmt = $db->prepare("DELETE FROM applied_filters WHERE id = :id");
    $stmt->execute([':id' => $id]);
}

function updateFilter($db, $id, $name)
{
    $stmt = $db->prepare("UPDATE applied_filters SET name = :name WHERE id = :id");
    $stmt->execute([':id' => $id, ':name' => $name]);
}

function outputItem($db, $item)
{
    $img_url = getImage($db, $item['id']);
    $price = getPrice($db, $item['id']);  ?>
    <div class='card' id='<?= $item['id'] ?>'>
        <a href="item_page.php?id=<?= $item['id'] ?>">
            <img src=<?= $img_url ?> alt=<?= $item['description'] ?>>
        </a>
        <p><?= $item['name'] ?></p>
        <p class="item-price" id="item-price-<?= $item['id'] ?>"> <?= $price ?> €</p>
        <?php if (isset($_SESSION['username'])) { ?>
            <i id="wish<?= $item['id'] ?>" class="<?= (isOnWishlist($db, $item['id'], $_SESSION['username'])) ? 'fa-solid fa-heart' : 'fa-regular fa-heart' ?>">
            </i>
        <?php } ?>
    </div>
<?php }

function outputItems($db, $items)
{ ?>
    <h1>Item Feed</h1>
    <div id="feed_menu">
        <div id='sort_menu'>
            <h2>Order by</h2><i id="sort_btn" class="fa-solid fa-sort-up"></i>
            <div id="sort_options">
                <?php foreach (getOrders($db) as $order) { ?>
                    <h3 id="order<?= $order['id'] ?>" style="background-color:<?= ($_SESSION['sortOrder'] == $order['id']) ? '#C9ADA7' : '' ?>"><?= $order['order_name'] ?></h3>
                <?php } ?>
                <h3 id="reset_order" style="display: <?= ($_SESSION['sortOrder'] > '0') ? 'flex' : 'none' ?>">Reset order</h3>
            </div>
        </div>
        <div id='filter_menu'>
            <h2>Filter by</h2><i id="filter_btn" class="fa-solid fa-filter"></i>
            <ul id="filter_options">
                <li>
                    <h3>Brand</h3>
                    <div id="drop-filter1">
                        <?php foreach (getBrands($db) as $brand) { ?>
                            <div id="choicebrd<?= $brand['id'] ?>"><?= $brand['name'] ?></div>
                        <?php } ?>
                    </div>
                </li>
                <li>
                    <h3>Size</h3>
                    <div id="drop-filter2">
                        <?php foreach (getSizes($db) as $size) { ?>
                            <div id="choicesz<?= $size['id'] ?>"><?= $size['name'] ?></div>
                        <?php } ?>
                    </div>
                </li>
                <li>
                    <h3>Condition</h3>
                    <div id="drop-filter3">
                        <?php foreach (getConditions($db) as $condition) { ?>
                            <div id="choicecond<?= $condition['id'] ?>"><?= $condition['name'] ?></div>
                        <?php } ?>
                    </div>
                </li>
                <li>
                    <h3>Price</h3>
                    <div id="drop-filter4">
                        <form id="price_filter">
                            <input type="number" id="min_price" placeholder="Min price" step="10" min="0">
                            <input type="number" id="max_price" placeholder="Max price" step="10" min="0">
                            <button id="choiceprc" type="submit">Type ENTER to apply</button>
                        </form>
                    </div>
                </li>
            </ul>
            <h3 id="reset_filters" style="display: <?= getApplied($db) ? 'flex' : 'none' ?>">Reset filters</h3>
        </div>
        <ul id="applied_filters">
            <?php foreach (getApplied($db) as $appf) { ?>
                <li id="choicerem<?= $appf['id'] ?>"><?= $appf['name'] ?></li>
            <?php } ?>
        </ul>
    </div>
    <aside id="random_items">
        <?php foreach ($items as $item) {
            if (isItemForSale($db, $item['id'])) {
                outputItem($db, $item);
            }
        } ?>
    </aside>
<?php }
function getSellerUsername($db, $itemId)
{
    $stmt = $db->prepare("SELECT seller FROM items WHERE id = :item_id");
    $stmt->execute([':item_id' => $itemId]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['seller'];
}

function getItem($db, $itemId)
{
    $stmt = $db->prepare("SELECT * FROM items WHERE id = :item_id");
    $stmt->execute([':item_id' => $itemId]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getItemName($db, $itemId)
{
    $stmt = $db->prepare("SELECT name FROM items WHERE id = :item_id");
    $stmt->execute([':item_id' => $itemId]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['name'];
}

function getTransaction($db, $itemId)
{
    $stmt = $db->prepare("SELECT * FROM transactions WHERE item_id = :item_id");
    $stmt->execute([':item_id' => $itemId]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function updateTransactionStatus($db, $buyer, $itemId)
{
    $stmt = $db->prepare("UPDATE transactions SET status = 'sold', buyer = :buyer WHERE item_id = :item_id AND status = 'for sale'");
    $stmt->execute([':buyer' => $buyer, ':item_id' => $itemId]);
}

function deleteItem($db, $itemId)
{
    $stmt = $db->prepare("DELETE FROM items WHERE id = :item_id");
    $stmt->execute([':item_id' => $itemId]);
}

function isItemForSale($db, $itemId)
{
    $stmt = $db->prepare("SELECT status FROM transactions WHERE item_id = :item_id");
    $stmt->execute([':item_id' => $itemId]);
    $transaction = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($transaction && $transaction['status'] == 'for sale') {
        return true;
    } else {
        return false;
    }
}


