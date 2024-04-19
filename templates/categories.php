<?php
    require_once("database/items.php");

    function output_categories($db, $cats) { ?>
        <nav>
            <ul>
                <?php foreach($cats as $cat) { ?>
                    <li><a href="category_page.php?id=<?=$cat['id']?>"><?=$cat['name']?></a></li>
                <?php } ?>
            </ul>
        </nav>
        <main>
<?php }