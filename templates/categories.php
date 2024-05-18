<?php
    require_once("database/items.php");

    function output_subcategories($db, $cat_id) {
        $subcats = getSubcategories($db, $cat_id);
        foreach($subcats as $subcat) { ?>
            <a id="choicecatssub<?= $subcat['id'] ?>"><?=$subcat['name']?></a>
        <?php }
    }

    function output_categories($db, $cats) { ?>
        <nav>
            <ul>
                <?php foreach($cats as $cat) { ?>
                    <li>
                        <a id="choicecatscat<?= $cat['id'] ?>"><?=$cat['name']?></a>
                        <div class="dropdown-content">
                            <?=output_subcategories($db, $cat['id'])?>
                        </div>
                    </li>
                <?php } ?>
            </ul>
        </nav>
        <main>
<?php }