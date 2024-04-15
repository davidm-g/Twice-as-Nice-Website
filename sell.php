<?php
    session_start();
    require_once ('database/connection.php');
    require_once ('database/items.php');
    require_once('templates/common.php');   
    require_once('templates/items.php'); 
    require_once('database/users.php');
    $db = getDatabaseConnection();
// Fetch sizes, conditions, brands, categories, and subcategories from the database
    $sizes = getSizes($db);
    $conditions = getConditions($db);
    $brands = getBrands($db);
    $categories = getCategories($db);
    
    output_header();
?>
        <h1>Sell an Item</h1>
                <form action="action_post_item.php" method="post" enctype="multipart/form-data">
            <label for="name">Name:</label><br>
            <input type="text" id="name" name="name"><br>
            <label for="size">Size:</label><br>
            <select id="size" name="size">
                <option selected disabled>Select a size if applicable</option>
                <?php foreach ($sizes as $size) { ?>
                    <option value="<?php echo $size['id']; ?>"><?php echo $size['name']; ?></option>
                <?php } ?>
            </select><br>
            <label for="condition">Condition:</label><br>
            <select id="condition" name="condition" required>
                <?php foreach ($conditions as $condition) { ?>
                    <option value="<?php echo $condition['id']; ?>"><?php echo $condition['name']; ?></option>
                <?php } ?>
            </select><br>
            <label for="brand">Brand:</label><br>
            <select id="brand" name="brand">
                <option selected disabled>Select a brand if applicable</option>
                <?php foreach ($brands as $brand) { ?>
                    <option value="<?php echo $brand['id']; ?>"><?php echo $brand['name']; ?></option>
                <?php } ?>
            </select><br>
            <label for="category">Category:</label><br>
            <select id="category" name="category" required>
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
            <input type="number" id="price" name="price" step="5" required><br>
            <label for="images">Images:</label><br>
            <input type="file" id="images" name="images[]" multiple required><br>
            <label for="description">Description:</label><br>
            <textarea id="description" name="description" required></textarea><br>
            <input type="submit" value="Post Item">
        </form>
        <script src="/scripts/select_subdirectories.js"></script>
<?php 
    output_footer();
?>

