<?php
function hmenu_2() {
    $view = JFactory::getDocument()->view;
    $modulesContains = $view->containsModules('hmenu');
    $isPreview  = $GLOBALS['theme_settings']['is_preview'];
    if (isset($GLOBALS['isModuleContentExists']) && false == $GLOBALS['isModuleContentExists'])
        $GLOBALS['isModuleContentExists'] = $view->containsModules('hmenu') ? true : false;
    ?>
    <?php if ($isPreview || $modulesContains) : ?>
        
        <nav class=" bd-hmenu-2 bd-page-width "  data-responsive-menu="true" data-responsive-levels="expand on click" data-responsive-type="" data-offcanvas-delay="0ms" data-offcanvas-duration="700ms" data-offcanvas-timing-function="ease">
            <?php if ($view->containsModules('hmenu')) : ?>
            
                <div class=" bd-menuoverlay-2 bd-menu-overlay"></div>
                <div class=" bd-responsivemenu-2 collapse-button">
    <div class="bd-container-inner">
        <div class="bd-menuitem-15 ">
            <a  data-toggle="collapse"
                data-target=".bd-hmenu-2 .collapse-button + .navbar-collapse"
                href="#" onclick="return false;">
                    <span>Меню</span>
            </a>
        </div>
    </div>
</div>
                <div class="navbar-collapse collapse ">
				<a class=" bd-logo-6 animated bd-animation-13" href="/"><img class="img-responsive" src="//odisseya.github.io/moz10/templates/moz20/images/designer/2c4f323790c241e86a2fac327e52f261_mojaika_10_logo.png" alt="Клиника Марии Фроловой"></a>
<p class=" bd-textblock-17 animated bd-animation-1 bd-content-element" data-animation-name="pulse" data-animation-event="scrollloop" data-animation-duration="1000ms" data-animation-delay="0ms" data-animation-infinited="true">
    <span class="roistat-phone"><a href="tel:+7(495)788-03-03" draggable="false" class="roistat-phone">+7(495)788-03-03</a>&nbsp;</span><br>На связи 24/7&nbsp;</p>
            <?php echo $view->position('hmenu', '', '2', 'hmenu'); ?>
                <div class="bd-menu-close-icon">
    <a href="#" class="bd-icon  bd-icon-17"></a>
</div>
            
                </div>
            <?php else: ?>
                Please add a menu module in the 'hmenu' position
            <?php endif; ?>
        </nav>
        
    <?php endif; ?>
<?php
}