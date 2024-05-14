<?php function output_header(){ ?>
    <!DOCTYPE html>
<html lang="en-US">
<head>
    <script src="https://kit.fontawesome.com/6e1a58f88e.js" crossorigin="anonymous"></script>
    <title>Second-Hand Website</title>
    <meta charset="UTF-8">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/layout.css" rel="stylesheet">
    <link href="css/item_page.css" rel="stylesheet">
    <script src="scripts/modal_login.js" defer></script>
    <?php if(isset($_SESSION['login'])): ?>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            ToggleLogin();
        });
    </script>
    <?php unset($_SESSION['login']);
    endif; ?>
    <script src="scripts/modal_register.js" defer></script>
    <script src="scripts/verify_password.js" defer></script>
    <script src="scripts/toggle_wishlist.js" defer></script>
    <script src="scripts/search.js" defer></script>
    <script src="scripts/check_empty_page.js" defer></script>
    <script src="scripts/picture_handler.js" defer></script>
    <script src="scripts/sort_menu.js" defer></script>
</head>
<body>
    <header>
        <h1><a href="index.php">Second-Hand Website</a></h1>
        <form id="searchbar">
            <input type="text" placeholder="Search">
            <ul id="itemList"></ul>
        </form>
        <div class="logreg">
            <?php if (isset($_SESSION['username'])) { ?>
                <a href="wishlist.php"><div class="wishlist">
                    <i class="fa-regular fa-heart" onmouseover="this.className='fa-solid fa-heart';" onmouseout="this.className='fa-regular fa-heart';"></i>
                </div></a>
                <a href="conversations.php"><div class="chat">
                    <i class="fa-regular fa-message" onmouseover="this.className='fa-solid fa-message';" onmouseout="this.className='fa-regular fa-message';"></i>
                </div></a>
                <a href="profile.php"><img id='userpic' src="<?=$_SESSION['picture']?>"/></a>
                <a href="action_logout.php"><button type="button" class="logout">Logout</button></a>
            <?php } else { ?>
                <button type="button" id="register">Register</button>
                <button type="button" id="login">Login</button>
            <?php } ?>
        </div>
    </header>
    <?php if (!isset($_SESSION['username'])) { ?>
        <div id="fadeLogin" class="hide"></div>
        <div id="loginmodal" class="hide">
            <h2 class="modalheader">Login</h2>
            <button id="closebtnL"><i class="fa-regular fa-circle-xmark"></i></button>
            <form action="action_login.php" method="post" id="loginfields">
            <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password"required>
                <button type="submit">Login</button>
            </form>
        </div>
                    
        <div id="fadeRegister" class="hide"></div>
        <div id="registermodal" class="hide">
            <h2 class="modalheader">Register</h2>
            <div id="photoContainer">
                <img id="photoPreview" src="database/images/PROFILE_PIC.jpg" alt="Add photo" />
                <input type="file" id="photoInput" accept="image/*" style="display: none;">
                <video id="webcamStream" width="125" height="125" autoplay style="display: none;"></video>
                <i id="capturePhoto" class="fa-solid fa-camera" style="display: none;"></i>
                <i id="removePhoto" class="fa-solid fa-trash" style="display: none;"></i>
            </div>
            <button id="closebtnR"><i class="fa-regular fa-circle-xmark"></i></button>
            <form action="action_register.php" method="post" id="registerfields" onsubmit="return verifyPassword()">
            <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
                <input type="hidden" id="picture" name="picture" value="">
                <input type="text" name="name" placeholder="Name" required>
                <input type="text" name="username" placeholder="Username" required>
                <input type="email" name="email" placeholder="email" required>
                <input type="password" name="password" id="password" placeholder="Password"required>
                <input type="password" name="confirm" id="confirm" placeholder="Confirm Password"required>
                <button type="submit">Register</button>
            </form>
        </div>
    <?php } ?>
 <?php } ?>

 <?php function output_footer(){ ?>
        </main>
    <footer>
        <p>&copy; 2024 Second-Hand Website. All rights reserved.</p>
    </footer>
    </body>
    </html>
  <?php } ?>
