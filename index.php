<?php
    require_once ('database/connection.php');
    require_once ('database/items.php');
    $db = getDatabaseConnection();

    $items = getItems($db);
?>

<!DOCTYPE html>
<html lang="en-US">
<head>
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
        <button onclick="location.href='login.html'">Login</button>
        <button onclick="location.href='register.html'">Register</button>
        <a href="profile.html">Profile</a>
    </header>
    <nav>
        <ul>
          <li><a href="electronics.html">Electronics</a></li>
          <li><a href="#books">Books</a></li>
          <li><a href="#clothing">Clothing</a></li>
          <li><a href="#home-kitchen">Home & Kitchen</a></li>
          <li><a href="#sports-outdoors">Sports & Outdoors</a></li>
        </ul>
      </nav>
    <main>
    <aside id="random_items">
        <h1>Item Feed</h1>
            <?php foreach ($items as $item) { 
                outputItem($db,$item);
             } ?>    
    </aside>
    </main>
<footer>
    <p>&copy; 2024 Second-Hand Website. All rights reserved.</p>
</footer>
</body>
</html>