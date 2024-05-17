<?php
    session_set_cookie_params(0, '/', 'localhost', false, true);
    session_start();
    require_once ('database/connection.php');
    require_once ('database/items.php');
    require_once('templates/common.php');   
    require_once('database/users.php');
    require_once('templates/categories.php');
    $db = getDatabaseConnection();
    if (!isset($_SESSION['csrf'])) {
        $_SESSION['csrf'] = generate_random_token();
    } 
    $cats = getCategories($db);
    output_header();
    output_categories($db, $cats);
?>
    <section class="register-section">
        <h2>Register</h2>
        <form action="action_register.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <label for="name">First and Last names:</label>
            <input type="text" id="name" name="name" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <input type="submit" value="Register">
        </form>
    </section>
<?php 
    output_footer();
?>