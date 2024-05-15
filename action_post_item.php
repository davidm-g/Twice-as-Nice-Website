<?php
// Start the session
session_start();


require_once('database/connection.php'); 
$db = getDatabaseConnection();
if ($_SESSION['csrf'] !== $_POST['csrf']) {
    die('Error: Invalid request. Please refresh the page and try again.');
}
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = htmlspecialchars($_POST['name']);
    $size = isset($_POST['size']) ? htmlspecialchars($_POST['size']) : null;
    $condition = htmlspecialchars($_POST['condition']);
    $brand = isset($_POST['brand']) ? htmlspecialchars($_POST['brand']) : null;
    $category = htmlspecialchars($_POST['category']);
    $subcategory = htmlspecialchars($_POST['subcategory']);
    $price = htmlspecialchars($_POST['price']);
    $description = htmlspecialchars($_POST['description']);
    $seller = htmlspecialchars($_SESSION['username']); 

    // Handle file upload for images
    
    $images = $_FILES['images'];
    $imageUrls = [];
    $validImages = true;
    for ($i = 0; $i < count($images['name']); $i++) {
        $targetDir = "database/images/";
        $imageName = filter_var(str_replace(' ', '_', $images["name"][$i]), FILTER_SANITIZE_STRING);
        $targetFile = $targetDir . basename($imageName);
        $imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));
        if ($images["size"][$i] > 1500000) { // 1.5MB in bytes
            echo "<script>alert('Sorry, your file is too large.');</script>";
            $validImages = false;
            continue;
        }
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            echo "<script>alert('Sorry, only JPG, JPEG, PNG files are allowed.');</script>";
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
