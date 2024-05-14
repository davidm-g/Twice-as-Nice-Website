<?php
    session_start();
    require_once ('database/connection.php');
    require_once ('database/items.php');
    require_once('templates/common.php');   
    require_once('database/users.php');
    require_once('templates/categories.php');
    $db = getDatabaseConnection();
    if (!isset($_SESSION['csrf'])) {
        $_SESSION['csrf'] = generate_random_token();
      }
    $username = htmlspecialchars($_SESSION['username']);
    $user= getUserByUsername($db, $username);
    $items = getItems($db);
    $cats = getCategories($db);
    output_header();
    output_categories($db, $cats);
?>
        <h1><?=$username?>'s profile</h1>
        <div id="photoContainer">
            <img id="photoPreview" src="<?=$_SESSION['picture']?>" alt="Add photo" />
            <input type="file" id="photoInput" accept="image/*" style="display: none;">
            <video id="webcamStream" width="125" height="125" autoplay style="display: none;"></video>
            <i id="capturePhoto" class="fa-solid fa-camera" style="display: none;"></i>
            <i id="removePhoto" class="fa-solid fa-trash" style="display: none;"></i>
        </div>
        <form action="action_profile.php" method="post">
        <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
            <input type="hidden" id="picture" name="picture" value="">
            <button type="submit" name="update_picture"> Update Picture </button>
        </form>
        <form action="action_profile.php" method="post">
            <label for="name">Name:</label><br>
            <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
            <input type="text" id="name" name="name" value="<?=$user['name']?>"><br>
            <button type="submit" name="update_name"> Update Name </button>
        </form>
        <form action="action_profile.php" method="post">
        <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" value="<?=$user['email']?>"><br>
            <button type="submit" name="update_email"> Update Email </button>
        </form>
        <form action="action_profile.php" method="post" id="password_update_form">
        <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
            <label for="current_password">Current Password:</label><br>
            <input type="password" id="current_password" name="current_password" required><br>
            <label for="new_password">New Password:</label><br>
            <input type="password" id="new_password" name="new_password" required><br>
            <label for="confirm_password">Confirm New Password:</label><br>
            <input type="password" id="confirm_password" name="confirm_password" required><br>
            <input type="hidden" name="update_password" value="1">
            <button type="submit"> Update Password </button>
        </form>
        

<?php if (isAdmin($_SESSION['username'],$db)) { ?>
    <form action="action_profile.php" method="post" onsubmit="return validateForm(event)">
    <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
    <label for="elevate_username">User to elevate to admin:</label><br>
    <input type="text" id="elevate_username" name="elevate_username" required><br>
    <input type="submit" name="elevate" value="Elevate to Admin">
</form>
    <form action="action_profile.php" method="post">
    <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
        <label for="new_category">New Category:</label><br>
        <input type="text" id="new_category" name="category" required><br>
        <button type="submit" name="add_category"> Add Category </button>
    </form>
    <form action="action_profile.php" method="post">
    <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
    <label for="category">Select a category to add a subcategory to:</label><br>
    <select id="category" name="category_id" required>
        <?php
        $stmt = $db->prepare("SELECT id, name FROM categories");
        $stmt->execute();
        $categories = $stmt->fetchAll();
        foreach ($categories as $category) {
            echo '<option value="' . htmlspecialchars($category['id']) . '">' . htmlspecialchars($category['name']) . '</option>';
        }
        ?>
    </select><br>
    <label for="subcategory">New Subcategory:</label><br>
    <input type="text" id="subcategory" name="subcategory" required><br>
    <button type="submit" name="add_subcategory"> Add Subcategory </button>
    </form>
    <form action="action_profile.php" method="post">
    <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
        <label for="size">New Size:</label><br>
        <input type="text" id="size" name="size" required><br>
        <button type="submit" name="add_size"> Add Size </button>
    </form>
    <form action="action_profile.php" method="post">
    <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
        <label for="brand">New Brand:</label><br>
        <input type="text" id="brand" name="brand" required><br>
        <button type="submit" name="add_brand"> Add Brand </button>
    </form>
    <form action="action_profile.php" method="post">
    <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
        <label for="condition">New Condition:</label><br>
        <input type="text" id="condition" name="condition" required><br>
        <button type="submit" name="add_condition"> Add Condition </button>
    </form>
<?php } ?>
<h1>Wardrobe</h1>
    <aside id="random_items">
        <?php foreach ($items as $item) { 
            if(getSeller($db,$item['id']) == $_SESSION['username']){
                if (isItemForSale($db, $item['id'])) {
                    outputItem($db, $item);?>
                    <p class="item-price">Price: <?=getPrice($db, $item['id'])?> €</p>
                    <form id="manage-item-<?=$item['id']?>">
                        <input type="hidden" name="item_id" value="<?=$item['id']?>">
                        <div id="new-price-<?=$item['id']?>" style="display: none;">
                            <input type="number" name="new_price" min="0" step="5" placeholder="New price" required>
                            <input type="button" onclick="changePrice('<?=$item['id']?>')" value="Submit New Price">
                        </div>
                        <button type="button" onclick="showNewPrice('<?=$item['id']?>')">Change Price</button>
                        <input type="button" onclick="deleteItem('<?=$item['id']?>')" value="Delete Item">
                    </form>
                <?php }
            }
        } ?>    
    </aside>
<a href="sell.php">Sell More Items!!!</a>
<script src="/scripts/manage_items.js" defer></script>
<script src="/scripts/verify_user.js" defer></script>    
<script src="/scripts/update_password.js" defer></script>  
<?php 
    output_footer();
?>