<?php
?>

<div class="elgg-module elgg-module-aside">
    <div class="elgg-head">
        <h3><?php echo elgg_echo('celebrations:list_monthly'); ?></h3>
    </div>
    <div>
        <?php
            for($i = 1; $i <= 12; $i += 1) {
                $url = $CONFIG->wwwroot . "mod/celebrations/index.php?month=".$i."&filterid=".$filterid;
                $item = new ElggMenuItem(elgg_echo("month:{$i}"), elgg_echo("month:{$i}"), $url);
                $item->setContext('celebrations');
                $item->setSection('a');
                $celebrations_monthly .= elgg_view('navigation/menu/elements/item', array('item' => $item));
            }
            echo $celebrations_monthly;
        ?>
    </div>
</div>
