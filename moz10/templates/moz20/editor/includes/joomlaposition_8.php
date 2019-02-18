<?php
function joomlaposition_8() {
    $document = JFactory::getDocument();
    $view = $document->view;
    $isPreview  = $GLOBALS['theme_settings']['is_preview'];
    if (isset($GLOBALS['isModuleContentExists']) && false == $GLOBALS['isModuleContentExists'])
        $GLOBALS['isModuleContentExists'] = $view->containsModules('position-8') ? true : false;
?>
    <?php if ($isPreview || $view->containsModules('position-8')) : ?>

    <?php if ($isPreview && !$view->containsModules('position-8')) : ?>
    <!-- empty::begin -->
    <?php endif; ?>
    <div class="data-control-id-1339833 bd-joomlaposition-8 bd-page-width  clearfix" <?php echo buildDataPositionAttr('position-8'); ?>>
        <?php echo $view->position('position-8', 'block%joomlaposition_block_8', '8'); ?>
    </div>
    <?php if ($isPreview && !$view->containsModules('position-8')) : ?>
    <!-- empty::end -->
    <?php endif; ?>
    <?php endif; ?>
<?php
}