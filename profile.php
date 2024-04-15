<?php
    session_start();
    require_once ('database/connection.php');
    require_once ('database/items.php');
    require_once('templates/common.php');   
    require_once('templates/items.php'); 
    require_once('database/users.php');
    require_once('templates/transactions.php');
    $db = getDatabaseConnection();
    $username = $_SESSION['username'];
    output_header();
?>
        <h1><?=$username?>'s profile</h1>
        <form action="action_profile.php" method="post">
            <label for="name">Name:</label><br>
            <input type="text" id="name" name="name" value="John Doe"><br>
            <button type="submit"> Update Name </button>
        </form>
        <form action="action_profile.php" method="post">
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username" value="jdoe"><br>
            <button type="submit"> Update Username </button>
        </form>
        <form action="action_profile.php" method="post">
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" value="jdoe@example.com"><br>
            <button type="submit"> Update Email </button>
        </form>
        <form action="action_profile.php" method="post">
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" value="password"><br>
            <button type="submit"> Update Password </button>
        </form>
        

<?php if (isAdmin($_SESSION['username'],$db)) { ?>
    <form action="action_profile.php" method="post">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required><br>
        <button type="submit" name="elevate"> Elevate to Admin </button>
    </form>
    <form action="action_profile.php" method="post">
        <label for="category">New Category:</label><br>
        <input type="text" id="category" name="category" required><br>
        <button type="submit" name="add_category"> Add Category </button>
    </form>
    <form action="action_profile.php" method="post">
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
        <label for="size">New Size:</label><br>
        <input type="text" id="size" name="size" required><br>
        <button type="submit" name="add_size"> Add Size </button>
    </form>
    <form action="action_profile.php" method="post">
        <label for="brand">New Brand:</label><br>
        <input type="text" id="brand" name="brand" required><br>
        <button type="submit" name="add_brand"> Add Brand </button>
    </form>
    <form action="action_profile.php" method="post">
        <label for="condition">New Condition:</label><br>
        <input type="text" id="condition" name="condition" required><br>
        <button type="submit" name="add_condition"> Add Condition </button>
    </form>
<?php } ?>
<section id="wardrobe">
    <h2>Wardrobe</h2>
    <?php output_wardrobe($username, $db); ?>
</section>
<a href="sell.php">Sell More Items!!!</a>
<script src="/scripts/manage_items.js" defer></script>   
<?php 
    output_footer();
?>