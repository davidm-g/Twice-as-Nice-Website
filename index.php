<?php
    require_once ('database/connection.php');
    require_once ('database/items.php');
    $db = getDatabaseConnection();

    $items = getItems($db);
?>

<!DOCTYPE html>
<html lang="en-US">
<head>
    <script src="https://kit.fontawesome.com/6e1a58f88e.js" crossorigin="anonymous"></script>
    <title>Second-Hand Website</title>
    <meta charset="UTF-8">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/layout.css" rel="stylesheet">
</head>
<body>
    <header>
        <h1><a href="index.php">Second-Hand Website</a></h1>
        <form action="search.php" method="get">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input action = "search.php" type="text" name="search" placeholder="search">
        </form>
        <a href="register.html"><button type="button" class="register">Register</button></a>
        <a href="login.html"><button type="button" class="login">Login</button></a>
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
        <h1>Item Feed</h1>
            <aside id="random_items">
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