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
                <?php if (isset($_SESSION['username'])) { ?>
                    <button id="msg-button" onclick="window.location.href = 'messages.php?user=<?= getSeller($db, $id) ?>&item=<?= $id ?>'"><i class="fa-solid fa-square-envelope"></i></button>
                    <?php } ?>
            </div>

            <?php if (isset($_SESSION['username'])) { ?>
                <div id="action-buttons">

                <form method="POST" action="checkout.php" id="checkoutForm" style="display:none">
                    <input type="hidden" name="item_id" value="<?= $id ?>">
                    <input type="hidden" name="price" value="<?= getPrice($db, $id) ?>">
                    <input type="hidden" name="user" value="<?= getSeller($db, $id) ?>">
                </form>

                    <button id="buy-button" onclick="document.getElementById('checkoutForm').submit();"><i class="fa-solid fa-shopping-cart"></i>Buy Now</button>
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