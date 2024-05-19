<?php
    session_set_cookie_params(0, '/', 'localhost', false, true);
    session_start();
    require_once('database/connection.php');
    require_once('database/items.php');
    require_once('templates/common.php');
    require_once('templates/categories.php');
    $db = getDatabaseConnection();
    if (!isset($_SESSION['csrf'])) {
        $_SESSION['csrf'] = generate_random_token();
    }
    $id = htmlspecialchars($_GET['id']);
    $cats = getCategories($db);
    output_header();
    output_categories($db, $cats);
    ?>
    <div id="item-details">
        <img id="item-image" src=<?= getImage($db, $id) ?> alt="Example Item image">
        <div id="item-info">
            <h2><?= getTitle($db, $id) ?></h2>
            <h2>€<span id="item-price"><?= getPrice($db, $id) ?></span></h2>
            <p>Brand: <span id="item-brand"><?= getBrand($db, $id) ?></span></p>
            <p>Category: <span id="item-category"><?= getCategory($db, $id) ?></span></p>
            <p>Condition: <span id="item-condition"><?= getCondition($db, $id) ?></span></p>
            <p>Size: <span id="item-size"><?= getSize($db, $id) ?></span></p>

            <div id="seller-info">
                <a href="seller.php?seller=<?= getSeller($db, $id) ?>"><img id="profile-pic" src=<?= getSellerImage($db, $id) ?> title="<?= getSellerName($db, $id) ?>" alt="Seller Profile Pic"></a>
                <button id="msg-button" onclick="messageSeller()"><i class="fa-solid fa-square-envelope"></i></i></i></button>
            </div>

            <?php if (isset($_SESSION['username'])) { ?>
                <div id="action-buttons">
                    <button id="cart-button" onclick="addToCart()"><i class="fa-solid fa-cart-plus"></i>Add to Cart</button>
                    <button id="negotiate-button" onclick="window.location.href='negotiate_price_page.html'"><i class="fa-solid fa-tag"></i>Negotiate Price</button>
                    <button id="btnwish<?= $id ?>" , style="background-color:<?= isOnWishlist($db, $id, $_SESSION['username']) ? '#4A4E69' : 'transparent' ?>; 
                        color:<?= isOnWishlist($db, $id, $_SESSION['username']) ? '#F2E9E4' : '#4A4E69' ?>">
                        <?= (isOnWishlist($db, $id, $_SESSION['username'])) ? 'Remove from Wishlist' : 'Add to Wishlist' ?>
                    </button>
                </div>
            <?php } ?>
        </div>
        <div id="descriptioncont">
            <p><span id="item-description"><?= getDescription($db, $id) ?></span></p>
        </div>
    </div>
    <?php
    output_footer();
    ?>