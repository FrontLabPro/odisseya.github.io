<?php
function hmenu_2() {
    $view = JFactory::getDocument()->view;
    $modulesContains = $view->containsModules('hmenu');
    $isPreview  = $GLOBALS['theme_settings']['is_preview'];
    if (isset($GLOBALS['isModuleContentExists']) && false == $GLOBALS['isModuleContentExists'])
        $GLOBALS['isModuleContentExists'] = $view->containsModules('hmenu') ? true : false;
    ?>
    <?php if ($isPreview || $modulesContains) : ?>
        
        <nav class="data-control-id-1347473 bd-hmenu-2 bd-page-width "  data-responsive-menu="true" data-responsive-levels="expand on click" data-responsive-type="" data-offcanvas-delay="0ms" data-offcanvas-duration="700ms" data-offcanvas-timing-function="ease">
            <?php if ($view->containsModules('hmenu')) : ?>
            
                <div class="data-control-id-1347948 bd-menuoverlay-2 bd-menu-overlay"></div>
                <div class="data-control-id-1347448 bd-responsivemenu-2 collapse-button">
    <div class="bd-container-inner">
        <div class="bd-menuitem-15 data-control-id-1347887">
            <a  data-toggle="collapse"
                data-target=".bd-hmenu-2 .collapse-button + .navbar-collapse"
                href="#" onclick="return false;">
                    <span>Меню</span>
            </a>
        </div>
    </div>
</div>
                <div class="navbar-collapse collapse ">
            <?php echo $view->position('hmenu', '', '2', 'hmenu'); ?>
                <div class="bd-menu-close-icon">
    <a href="#" class="bd-icon data-control-id-1347941 bd-icon-17"></a>
</div>
            
                </div>
            <?php else: ?>
                Please add a menu module in the 'hmenu' position
            <?php endif; ?>
        </nav>
        
    <?php endif; ?>
<?php
}