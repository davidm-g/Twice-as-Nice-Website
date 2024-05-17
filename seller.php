<?php
    session_set_cookie_params(0, '/', 'localhost', false, true);
    session_start();
    require_once ('database/connection.php');
    require_once ('database/items.php');
    require_once('templates/common.php');   
    require_once('database/users.php');
    require_once('templates/categories.php');
    require_once('templates/transactions.php');
    $db = getDatabaseConnection();
    if (!isset($_SESSION['csrf'])) {
        $_SESSION['csrf'] = generate_random_token();
    }   
    $username = htmlspecialchars($_SESSION['username']);
    $user= getUserByUsername($db, $username);
    $cats = getCategories($db);
    output_header();
    output_categories($db, $cats);
?>
        <h1><?=$username?>'s profile</h1>
        
<?php
    $items = getItems($db);
    $cats = getCategories($db);
    outputItems($db, $items);
    output_footer();
?>