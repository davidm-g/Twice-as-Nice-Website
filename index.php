<?php
    session_start();
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
    <link href="css/main_page.css" rel="stylesheet">
</head>
<body>
    <header>
        <h1><a href="index.php">Second-Hand Website</a></h1>
        <form action="search.php" method="get">
            <input type="text" name="search" placeholder="Search for items...">
            <input type="submit" value="Search">
        </form>
        <?php if (isset($_SESSION['username'])) { ?>
            <a href="profile.php"><button type="button" class="profile"><i class="fa-solid fa-user"></i></button></a>
            <a href="action_logout.php"><button type="button" class="logout">Logout</button></a>
        <?php } else { ?>
            <a href="login.php"><button type="button" class="login">Login</button></a>
            <a href="register.html"><button type="button" class="register">Register</button></a>
        <?php } ?>
    </header>
    <nav>
        <ul>
          <li><a href="electronics.html">Electronics</a></li>
          <li><a href="books.html">Books</a></li>
          <li><a href="clothes.html">Clothing</a></li>
          <li><a href="kitchen.html">Home & Kitchen</a></li>
          <li><a href="sports.html">Sports & Outdoors</a></li>
        </ul>
    </nav>
    <main>
    <aside id="random_items">
        <h1>Item Feed</h1>
            <?php foreach ($items as $item) { 
                outputItem($db,$item['id']);
             } ?>    
    </aside>

    </main>
<footer>
    <p>&copy; 2024 Second-Hand Website. All rights reserved.</p>
</footer>
</body>
</html>