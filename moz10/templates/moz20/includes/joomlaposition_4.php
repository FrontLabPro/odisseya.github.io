<?php
function joomlaposition_4() {
    $document = JFactory::getDocument();
    $view = $document->view;
    $isPreview  = $GLOBALS['theme_settings']['is_preview'];
    if (isset($GLOBALS['isModuleContentExists']) && false == $GLOBALS['isModuleContentExists'])
        $GLOBALS['isModuleContentExists'] = $view->containsModules('position-4') ? true : false;
?>
    <?php if ($isPreview || $view->containsModules('position-4')) : ?>

    <?php if ($isPreview && !$view->containsModules('position-4')) : ?>
    <!-- empty::begin -->
    <?php endif; ?>
    <div class=" bd-joomlaposition-4 clearfix" <?php echo buildDataPositionAttr('position-4'); ?>>
        <?php echo $view->position('position-4', 'block%joomlaposition_block_4', '4'); ?>
    </div>
    <?php if ($isPreview && !$view->containsModules('position-4')) : ?>
    <!-- empty::end -->
    <?php endif; ?>
    <?php endif; ?>
<?php
}