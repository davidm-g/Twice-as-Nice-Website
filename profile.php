<?php 
    session_start();
    require_once ('database/connection.php');
    $db = getDatabaseConnection();
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
        <a href="wishlist.html"><i class="fa-regular fa-heart"></i></a>
         <a href="messages.html"> <i class="fa-regular fa-message"></i></a>
         <a href="profile.html">Profile</a>
        <a href="register.html">Register</a>
        <a href="login.html">Login</a>
    </header>
    <main>
        <h1>John Doe's profile</h1>
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
        <section id="wardrobe">
        <h2>Wardrobe</h2>
        <article>
            <h4>Item: iPhone 12</h4>
            <p>Status: For Sale</p>
            <p>Price: $699.99</p>
        </article>
        <article>
            <h4>Item: Nike Shoes</h4>
            <p>Status: Sold</p>
            <p>Price: $99.99</p>
        </article>
        <a href="sell.php">Sell More Items!!!</a>
        </section>
        
    </main>
    <footer>
        <p>&copy; 2024 Second-Hand Website. All rights reserved.</p>
    </footer>
</body>
</html>