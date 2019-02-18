<?php
function joomlaposition_12() {
    $document = JFactory::getDocument();
    $view = $document->view;
    $isPreview  = $GLOBALS['theme_settings']['is_preview'];
    if (isset($GLOBALS['isModuleContentExists']) && false == $GLOBALS['isModuleContentExists'])
        $GLOBALS['isModuleContentExists'] = $view->containsModules('position-12') ? true : false;
?>
    <?php if ($isPreview || $view->containsModules('position-12')) : ?>

    <?php if ($isPreview && !$view->containsModules('position-12')) : ?>
    <!-- empty::begin -->
    <?php endif; ?>
    <div class=" bd-joomlaposition-12 bd-page-width  clearfix" <?php echo buildDataPositionAttr('position-12'); ?>>
        <?php echo $view->position('position-12', 'block%joomlaposition_block_12', '12'); ?>
    </div>
    <?php if ($isPreview && !$view->containsModules('position-12')) : ?>
    <!-- empty::end -->
    <?php endif; ?>
    <?php endif; ?>
<?php
}