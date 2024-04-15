<?php
    session_start();
    require_once ('database/connection.php');
    require_once ('database/items.php');
    require_once('templates/common.php');   
    require_once('templates/items.php'); 
    require_once('database/users.php');
    $db = getDatabaseConnection();
    output_header();
?>
    <section class="login-section">
        <h2>Login</h2>
        <form action="action_login.php" method="post">
            <label> Username <input type="text" name="username" ></label>
            <label> Password <input type="password" name="password" ></label>
            <button type="submit"> Login </button>
          </form>
    </section>
<?php 
    output_footer();
?>