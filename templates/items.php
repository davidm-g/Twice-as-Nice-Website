<?php function output_item_feed($items,$db){ ?>
    <aside id="random_items">
        <h1>Item Feed</h1>
            <?php foreach ($items as $item) { 
                outputItem($db,$item['id']);
             } ?>    
    </aside>
<?php } ?>