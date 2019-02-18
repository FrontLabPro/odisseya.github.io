<?php
function joomlaposition_6() {
    $document = JFactory::getDocument();
    $view = $document->view;
    $isPreview  = $GLOBALS['theme_settings']['is_preview'];
    if (isset($GLOBALS['isModuleContentExists']) && false == $GLOBALS['isModuleContentExists'])
        $GLOBALS['isModuleContentExists'] = $view->containsModules('position-6') ? true : false;
?>
    <?php if ($isPreview || $view->containsModules('position-6')) : ?>

    <?php if ($isPreview && !$view->containsModules('position-6')) : ?>
    <!-- empty::begin -->
    <?php endif; ?>
    <div class="data-control-id-1367154 bd-joomlaposition-6 clearfix" <?php echo buildDataPositionAttr('position-6'); ?>>
        <?php echo $view->position('position-6', 'block%joomlaposition_block_6', '6'); ?>
    </div>
    <?php if ($isPreview && !$view->containsModules('position-6')) : ?>
    <!-- empty::end -->
    <?php endif; ?>
    <?php endif; ?>
<?php
}