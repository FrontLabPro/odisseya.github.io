<?php
function joomlaposition_block_8($caption, $content, $classes = '', $id = '', $extraClass = '')
{
    $hasCaption = (null !== $caption && strlen(trim($caption)) > 0);
    $hasContent = (null !== $content && strlen(trim($content)) > 0);
    $isPreview  = $GLOBALS['theme_settings']['is_preview'];
    if (!$hasCaption && !$hasContent)
        return '';
    if (!empty($id))
        $id = $isPreview ? (' data-block-id="' . $id . '"') : '';
    ob_start();
    ?>
    <div class="data-control-id-1339832 bd-block bd-own-margins <?php echo $classes; ?>" <?php echo $id; ?>>
    <?php if ($hasCaption) : ?>
    
    <div class="data-control-id-1339873 bd-blockheader bd-tagstyles bd-bootstrap-img bd-img-responsive bd-bootstrap-tables bd-table-striped bd-table-bordered bd-table-hover bd-table-condensed bd-table-responsive">
        <h4><?php echo $caption; ?></h4>
    </div>
    
<?php endif; ?>
    <?php if ($hasContent) : ?>
    
    <div class="bd-blockcontent bd-tagstyles bd-bootstrap-img bd-img-responsive bd-bootstrap-tables bd-table-striped bd-table-bordered bd-table-hover bd-table-condensed bd-table-responsive<?php echo $extraClass;?>">
        <?php echo funcPostprocessBlockContent($content); ?>
    </div>
    
<?php endif; ?>
</div>
    <?php
    return ob_get_clean();
}