<?php
function joomlaposition_5() {
    $document = JFactory::getDocument();
    $view = $document->view;
    $isPreview  = $GLOBALS['theme_settings']['is_preview'];
    if (isset($GLOBALS['isModuleContentExists']) && false == $GLOBALS['isModuleContentExists'])
        $GLOBALS['isModuleContentExists'] = $view->containsModules('position-5') ? true : false;
?>
    <?php if ($isPreview || $view->containsModules('position-5')) : ?>

    <?php if ($isPreview && !$view->containsModules('position-5')) : ?>
    <!-- empty::begin -->
    <?php endif; ?>
    <div class="data-control-id-1367053 bd-joomlaposition-5 clearfix" <?php echo buildDataPositionAttr('position-5'); ?>>
        <?php echo $view->position('position-5', 'block%joomlaposition_block_5', '5'); ?>
    </div>
    <?php if ($isPreview && !$view->containsModules('position-5')) : ?>
    <!-- empty::end -->
    <?php endif; ?>
    <?php endif; ?>
<?php
}