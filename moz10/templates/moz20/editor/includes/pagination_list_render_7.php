<?php

function pagination_list_render_7($list)
{
    if (is_string($list)) return $list;
    // Initialise variables.
    $lang = JFactory::getLanguage();
    ob_start();
?>
    <ul class="data-control-id-1453418 bd-pagination-5 pagination">
    <?php if ($list['start']['active']) : ?>
        <li class="data-control-id-1453796 bd-paginationitem-5">
        <?php echo preg_replace("/class=(\"|\').*?(\"|\')/", "", $list['start']['data']); ?>
        </li>
    <?php endif; ?>
    <?php if ($list['previous']['active']) : ?>
        <li class="data-control-id-1453796 bd-paginationitem-5">
        <?php echo preg_replace("/class=(\"|\').*?(\"|\')/", "", $list['previous']['data']); ?>
        </li>
    <?php endif; ?>

    <?php foreach($list['pages'] as $page) : ?>
        <?php if (!$page['active']) : ?>
            <li class="active data-control-id-1453796 bd-paginationitem-5">
        <?php else : ?>
            <li class="data-control-id-1453796 bd-paginationitem-5">
        <?php endif; ?>
        <?php echo preg_replace("/class=(\"|\').*?(\"|\')/", "", $page['data']); ?>
        </li>
    <?php endforeach; ?>

    <?php if ($list['next']['active']) : ?>
        <li class="data-control-id-1453796 bd-paginationitem-5">
        <?php echo preg_replace("/class=(\"|\').*?(\"|\')/", "", $list['next']['data']); ?>
        </li>
    <?php endif; ?>
    <?php if ($list['end']['active']) : ?>
        <li class="data-control-id-1453796 bd-paginationitem-5">
        <?php echo preg_replace("/class=(\"|\').*?(\"|\')/", "", $list['end']['data']); ?>
        </li>
    <?php endif; ?>
</ul>
<?php
    return ob_get_clean();
}