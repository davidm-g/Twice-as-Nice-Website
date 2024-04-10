<?php

    session_start();
    require_once('database/connection.php');
    require_once('database/items.php');
    $db = getDatabaseConnection();
// Fetch sizes, conditions, brands, categories, and subcategories from the database
    $sizes = getSizes($db);
    $conditions = getConditions($db);
    $brands = getBrands($db);
    $categories = getCategories($db);
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
<script src="https://kit.fontawesome.com/6e1a58f88e.js" crossorigin="anonymous"></script>
    <title>Second-Hand Website</title>
    <meta charset="UTF-8">
</head>
<body>
    <header>
        <a href="index.php">Second-Hand Website</a>
        <form action="search.php" method="get">
            <input type="text" name="search" placeholder="Search for items...">
            <input type="submit" value="Search">
        </form>
        <a href="wishlist.html"><i class="fa-regular fa-heart"></i></i></a>
         <a href="messages.html"> <i class="fa-regular fa-message"></i></a>
         <a href="profile.html">Profile</a>
        <a href="register.html">Register</a>
        <a href="login.html">Login</a>
    </header>
    <main>
        <h1>Sell an Item</h1>
                <form action="action_post_item.php" method="post" enctype="multipart/form-data">
            <label for="name">Name:</label><br>
            <input type="text" id="name" name="name"><br>
            <label for="size">Size:</label><br>
            <select id="size" name="size">
                <?php foreach ($sizes as $size) { ?>
                    <option value="<?php echo $size['id']; ?>"><?php echo $size['name']; ?></option>
                <?php } ?>
            </select><br>
            <label for="condition">Condition:</label><br>
            <select id="condition" name="condition">
                <?php foreach ($conditions as $condition) { ?>
                    <option value="<?php echo $condition['id']; ?>"><?php echo $condition['name']; ?></option>
                <?php } ?>
            </select><br>
            <label for="brand">Brand:</label><br>
            <select id="brand" name="brand">
                <?php foreach ($brands as $brand) { ?>
                    <option value="<?php echo $brand['id']; ?>"><?php echo $brand['name']; ?></option>
                <?php } ?>
            </select><br>
            <label for="category">Category:</label><br>
            <select id="category" name="category">
            <option selected disabled>Select a category</option>
                <?php foreach ($categories as $category) { ?>
                    <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                <?php } ?>
            </select><br>
            <label for="subcategory">Subcategory:</label><br>
            <select id="subcategory" name="subcategory">
                <!-- Subcategories will be populated based on the selected category using JavaScript -->
            </select><br>
            <label for="price">Price:</label><br>
            <input type="number" id="price" name="price" step="5"><br>
            <label for="images">Images:</label><br>
            <input type="file" id="images" name="images[]" multiple><br>
            <label for="description">Description:</label><br>
            <textarea id="description" name="description"></textarea><br>
            <input type="submit" value="Post Item">
        </form>
    </main>
    <footer>
        <p>&copy; 2024 Second-Hand Website. All rights reserved.</p>
    </footer>
    <script src="/scripts/select_subdirectories.js"></script>
</body>
</html>

