<?php
// Start the session
session_start();


require_once('database/connection.php'); 
$db = getDatabaseConnection();

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST['name'];
    $size = isset($_POST['size']) ? $_POST['size'] : null;
    $condition = $_POST['condition'];
    $brand = isset($_POST['brand']) ? $_POST['brand'] : null;
    $category = $_POST['category'];
    $subcategory = $_POST['subcategory'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $seller = $_SESSION['username']; // Assuming the username is stored in session

    // Handle file upload for images
    
    $images = $_FILES['images'];
    $imageUrls = [];
    $validImages = true;
    for ($i = 0; $i < count($images['name']); $i++) {
        $targetDir = "database/images/";
        $targetFile = $targetDir . basename($images["name"][$i]);
        $imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));
        if ($images["size"][$i] > 1500000) { // 1.5MB in bytes
            echo "Sorry, your file is too large.";
            $validImages = false;
            continue;
        }
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            echo "Sorry, only JPG, JPEG, PNG files are allowed.";
            $validImages = false;
            continue;
        }
        if (move_uploaded_file($images["tmp_name"][$i], $targetFile)) {
            $imageUrls[] = $targetFile;
        }
    }
    if ($validImages) {
    try {
        // Start transaction
        $db->beginTransaction();

        // Insert into items table
        $sql = "INSERT INTO items (name, seller, size, condition, description, brand) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $db->prepare($sql);
        $stmt->execute([$name, $seller, $size, $condition, $description, $brand]);
        $itemId = $db->lastInsertId();

        // Insert into transactions table
        $sql = "INSERT INTO transactions (item_id, seller, status, price) VALUES (?, ?, 'for sale', ?)";
        $stmt = $db->prepare($sql);
        $stmt->execute([$itemId, $seller, $price]);

        // Insert into item_categories table
        $sql = "INSERT INTO item_categories (item_id, category_id, subcategory_id) VALUES (?, ?, ?)";
        $stmt = $db->prepare($sql);
        $stmt->execute([$itemId, $category, $subcategory]);

        // Insert into images table
        foreach ($imageUrls as $imageUrl) {
            $sql = "INSERT INTO images (item_id, image_url) VALUES (?, ?)";
            $stmt = $db->prepare($sql);
            $stmt->execute([$itemId, $imageUrl]);
        }

        // Commit transaction
        $db->commit();

        // Redirect to a success page
        header("Location: profile.php");
    } catch (Exception $e) {
        // Rollback transaction if something goes wrong
        $db->rollback();
        echo "Error: " . $e->getMessage();
    }
    }
    else {
        echo "Error: Invalid images";
    }
}
?>