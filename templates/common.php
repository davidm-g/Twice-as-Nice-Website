<?php function output_header(){ ?>
    <!DOCTYPE html>
<html lang="en-US">
<head>
    <script src="https://kit.fontawesome.com/6e1a58f88e.js" crossorigin="anonymous"></script>
    <title>Second-Hand Website</title>
    <meta charset="UTF-8">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/layout.css" rel="stylesheet">
    <script src="scripts/modal_login.js" defer></script>
    <script src="scripts/modal_register.js" defer></script>
</head>
<body>
    <header>
        <h1><a href="index.php">Second-Hand Website</a></h1>
        <form>
            <input type="search" placeholder="Search...">
        </form>
        <div class="logreg">
            <?php if (isset($_SESSION['username'])) { ?>
                <a href="wishlist.html"><div class="wishlist">
                    <i class="fa-regular fa-heart" onmouseover="this.className='fa-solid fa-heart';" onmouseout="this.className='fa-regular fa-heart';"></i>
                </div></a>
                <a href="chat.html"><div class="chat">
                    <i class="fa-regular fa-message" onmouseover="this.className='fa-solid fa-message';" onmouseout="this.className='fa-regular fa-message';"></i>
                </div></a>
                <a href="profile.php"><button type="button" class="profile"><i class="fa-solid fa-user"></i></button></a>
                <a href="action_logout.php"><button type="button" class="logout">Logout</button></a>
            <?php } else { ?>
                <button type="button" id="register">Register</button>
                <button type="button" id="login">Login</button>
            <?php } ?>
        </div>
    </header>
    
    <div id="fadeLogin" class="hide"></div>
    <div id="loginmodal" class="hide">
        <h2 class="modalheader">Login</h2>
        <button id="closebtn">X</button>
        <form action="action_login.php" method="post">
            <label> Username <input type="text" name="username" ></label>
            <label> Password <input type="password" name="password" ></label>
            <button type="submit"> Login </button>
        </form>
    </div>
    
    <div id="fadeRegister" class="hide"></div>
    <div id="registermodal" class="hide">
        <h2 class="modalheader">Register</h2>
        <button id="closebtn">X</button>
        <form action="action_register.php" method="post">
            <label>Username:<input type="text" name="username" required></label>
            <label>First and Last names:<input type="text" name="name" required></label>
            <label>Email:<input type="email" name="email" required></label>
            <label>Password:<input type="password" name="password" required></label>
            <button type="submit"> Register </button>
        </form>
    </div>
 <?php } ?>

 <?php function output_footer(){ ?>
        </main>
    <footer>
        <p>&copy; 2024 Second-Hand Website. All rights reserved.</p>
    </footer>
    </body>
    </html>
  <?php } ?>
