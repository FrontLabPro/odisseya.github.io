<?php
function joomlaposition_14() {
    $document = JFactory::getDocument();
    $view = $document->view;
    $isPreview  = $GLOBALS['theme_settings']['is_preview'];
    if (isset($GLOBALS['isModuleContentExists']) && false == $GLOBALS['isModuleContentExists'])
        $GLOBALS['isModuleContentExists'] = $view->containsModules('position-14') ? true : false;
?>
    <?php if ($isPreview || $view->containsModules('position-14')) : ?>

    <?php if ($isPreview && !$view->containsModules('position-14')) : ?>
    <!-- empty::begin -->
    <?php endif; ?>
    <div class=" bd-joomlaposition-14 bd-page-width  clearfix" <?php echo buildDataPositionAttr('position-14'); ?>>
        <?php echo $view->position('position-14', 'block%joomlaposition_block_14', '14'); ?>
    </div>
    <?php if ($isPreview && !$view->containsModules('position-14')) : ?>
    <!-- empty::end -->
    <?php endif; ?>
    <?php endif; ?>
<?php
}