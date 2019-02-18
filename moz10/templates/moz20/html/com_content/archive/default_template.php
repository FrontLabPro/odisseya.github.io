<?php
defined('_JEXEC') or die;
?>

<!--COMPONENT common -->

<?php
$component = new DesignerContent($this, $this->params);

$pageHeading = $component->pageHeading;
ob_start();
?>

<div class=" bd-blog bd-page-width  <?php echo $this->pageclass_sfx; ?>"  >
    <div class="bd-container-inner">
    
    <?php
        $GLOBALS['theme_settings']['active_paginator'] = 'specific';
        $pagination_list = $this->pagination->getPagesLinks();
    ?>
    
    <div class="bd-container-inner">
        <form id="adminForm" action="<?php echo JRoute::_('index.php')?>" method="post">
            <fieldset class="filters">
            <legend class="hidelabeltxt"><?php echo JText::_('JGLOBAL_FILTER_LABEL'); ?></legend>
            <div class="filter-search">
                <?php if ($this->params->get('filter_field') != 'hide') : ?>
                <label class="filter-search-lbl" for="filter-search"><?php echo JText::_('COM_CONTENT_TITLE_FILTER_LABEL').'&#160;'; ?></label>
                <input type="text" name="filter-search" id="filter-search" value="<?php echo $this->escape($this->filter); ?>" class="inputbox" onchange="document.getElementById('adminForm').submit();" />
                <?php endif; ?>

                <?php echo $this->form->monthField; ?>
                <?php echo $this->form->yearField; ?>
                <?php echo $this->form->limitField; ?>
                <button type="submit" class="button"><?php echo JText::_('JGLOBAL_FILTER_BUTTON'); ?></button>
            </div>
            <input type="hidden" name="view" value="archive" />
            <input type="hidden" name="option" value="com_content" />
            <input type="hidden" name="limitstart" value="0" />
            </fieldset>
            <div class=" bd-grid-5 bd-margins">
              <div class="container-fluid">
                <div class="separated-grid row">
            
            <?php foreach ($this->items as $i => $item) : ?>
                    <div class="separated-item-30 col-md-12 ">
                        <div class="bd-griditem-30">
                        <?php
                            $this->item = $item;
                            $this->articleTemplate = 'article_2';
                            echo $this->loadTemplate('item');
                        ?>
                        </div>
                    </div>
            <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php if (count($pagination_list) > 0) : ?>
    <div class=" bd-blogpagination-1">
        <?php
            echo renderTemplateFromIncludes('pagination_list_render_1', array($pagination_list));
        ?>
    </div>
<?php endif; ?>
    </div>
</div>

<?php
echo ob_get_clean();
?>
<!--COMPONENT common /-->
<?php
defined('_JEXEC') or die;
?>

<!--COMPONENT blog_9 -->

<?php
$component = new DesignerContent($this, $this->params);

$pageHeading = $component->pageHeading;
ob_start();
?>

<div class=" bd-blog-9 bd-page-width  <?php echo $this->pageclass_sfx; ?>" /**/style="display:none"/**/ >
    <div class="bd-container-inner">
    
    <?php
        $GLOBALS['theme_settings']['active_paginator'] = 'specific';
        $pagination_list = $this->pagination->getPagesLinks();
    ?>
    
    <div class="bd-container-inner">
        <form id="adminForm" action="<?php echo JRoute::_('index.php')?>" method="post">
            <fieldset class="filters">
            <legend class="hidelabeltxt"><?php echo JText::_('JGLOBAL_FILTER_LABEL'); ?></legend>
            <div class="filter-search">
                <?php if ($this->params->get('filter_field') != 'hide') : ?>
                <label class="filter-search-lbl" for="filter-search"><?php echo JText::_('COM_CONTENT_TITLE_FILTER_LABEL').'&#160;'; ?></label>
                <input type="text" name="filter-search" id="filter-search" value="<?php echo $this->escape($this->filter); ?>" class="inputbox" onchange="document.getElementById('adminForm').submit();" />
                <?php endif; ?>

                <?php echo $this->form->monthField; ?>
                <?php echo $this->form->yearField; ?>
                <?php echo $this->form->limitField; ?>
                <button type="submit" class="button"><?php echo JText::_('JGLOBAL_FILTER_BUTTON'); ?></button>
            </div>
            <input type="hidden" name="view" value="archive" />
            <input type="hidden" name="option" value="com_content" />
            <input type="hidden" name="limitstart" value="0" />
            </fieldset>
            <div class=" bd-grid-18 bd-margins">
              <div class="container-fluid">
                <div class="separated-grid row">
            
            <?php foreach ($this->items as $i => $item) : ?>
                    <div class="separated-item-4 col-md-6 ">
                        <div class="bd-griditem-4">
                        <?php
                            $this->item = $item;
                            $this->articleTemplate = 'article_10';
                            echo $this->loadTemplate('item');
                        ?>
                        </div>
                    </div>
            <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php if (count($pagination_list) > 0) : ?>
    <div class=" bd-blogpagination-9">
        <?php
            echo renderTemplateFromIncludes('pagination_list_render_9', array($pagination_list));
        ?>
    </div>
<?php endif; ?>
    </div>
</div>

<?php
echo ob_get_clean();
?>
<!--COMPONENT blog_9 /-->
<?php
defined('_JEXEC') or die;
?>

<!--COMPONENT blog_5 -->

<?php
$component = new DesignerContent($this, $this->params);

$pageHeading = $component->pageHeading;
ob_start();
?>

<div class=" bd-blog-5 bd-page-width  <?php echo $this->pageclass_sfx; ?>" /**/style="display:none"/**/ >
    <div class="bd-container-inner">
    
        <?php if ($pageHeading) : ?>
            <h1 class=" bd-container-21 bd-tagstyles bd-bootstrap-img bd-img-responsive bd-bootstrap-tables bd-table-striped bd-table-bordered bd-table-hover bd-table-condensed bd-table-responsive"><?php echo $pageHeading; ?></h1>
        <?php endif; ?>
    <?php
        $GLOBALS['theme_settings']['active_paginator'] = 'specific';
        $pagination_list = $this->pagination->getPagesLinks();
    ?>
    
    <div class="bd-container-inner">
        <form id="adminForm" action="<?php echo JRoute::_('index.php')?>" method="post">
            <fieldset class="filters">
            <legend class="hidelabeltxt"><?php echo JText::_('JGLOBAL_FILTER_LABEL'); ?></legend>
            <div class="filter-search">
                <?php if ($this->params->get('filter_field') != 'hide') : ?>
                <label class="filter-search-lbl" for="filter-search"><?php echo JText::_('COM_CONTENT_TITLE_FILTER_LABEL').'&#160;'; ?></label>
                <input type="text" name="filter-search" id="filter-search" value="<?php echo $this->escape($this->filter); ?>" class="inputbox" onchange="document.getElementById('adminForm').submit();" />
                <?php endif; ?>

                <?php echo $this->form->monthField; ?>
                <?php echo $this->form->yearField; ?>
                <?php echo $this->form->limitField; ?>
                <button type="submit" class="button"><?php echo JText::_('JGLOBAL_FILTER_BUTTON'); ?></button>
            </div>
            <input type="hidden" name="view" value="archive" />
            <input type="hidden" name="option" value="com_content" />
            <input type="hidden" name="limitstart" value="0" />
            </fieldset>
            <div class=" bd-grid-7 bd-margins">
              <div class="container-fluid">
                <div class="separated-grid row">
            
            <?php foreach ($this->items as $i => $item) : ?>
                    <div class="separated-item-46 col-md-12 ">
                        <div class="bd-griditem-46">
                        <?php
                            $this->item = $item;
                            $this->articleTemplate = 'article_4';
                            echo $this->loadTemplate('item');
                        ?>
                        </div>
                    </div>
            <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php if (count($pagination_list) > 0) : ?>
    <div class=" bd-blogpagination-3">
        <?php
            echo renderTemplateFromIncludes('pagination_list_render_3', array($pagination_list));
        ?>
    </div>
<?php endif; ?>
    </div>
</div>

<?php
echo ob_get_clean();
?>
<!--COMPONENT blog_5 /-->
<?php
defined('_JEXEC') or die;
?>

<!--COMPONENT blog_3 -->

<?php
$component = new DesignerContent($this, $this->params);

$pageHeading = $component->pageHeading;
ob_start();
?>

<div class=" bd-blog-3 bd-page-width  <?php echo $this->pageclass_sfx; ?>" /**/style="display:none"/**/ >
    <div class="bd-container-inner">
    
        <?php if ($pageHeading) : ?>
            <h1 class=" bd-container-18 bd-tagstyles bd-bootstrap-img bd-img-responsive bd-bootstrap-tables bd-table-striped bd-table-bordered bd-table-hover bd-table-condensed bd-table-responsive"><?php echo $pageHeading; ?></h1>
        <?php endif; ?>
    <?php
        $GLOBALS['theme_settings']['active_paginator'] = 'specific';
        $pagination_list = $this->pagination->getPagesLinks();
    ?>
    
    <div class="bd-container-inner">
        <form id="adminForm" action="<?php echo JRoute::_('index.php')?>" method="post">
            <fieldset class="filters">
            <legend class="hidelabeltxt"><?php echo JText::_('JGLOBAL_FILTER_LABEL'); ?></legend>
            <div class="filter-search">
                <?php if ($this->params->get('filter_field') != 'hide') : ?>
                <label class="filter-search-lbl" for="filter-search"><?php echo JText::_('COM_CONTENT_TITLE_FILTER_LABEL').'&#160;'; ?></label>
                <input type="text" name="filter-search" id="filter-search" value="<?php echo $this->escape($this->filter); ?>" class="inputbox" onchange="document.getElementById('adminForm').submit();" />
                <?php endif; ?>

                <?php echo $this->form->monthField; ?>
                <?php echo $this->form->yearField; ?>
                <?php echo $this->form->limitField; ?>
                <button type="submit" class="button"><?php echo JText::_('JGLOBAL_FILTER_BUTTON'); ?></button>
            </div>
            <input type="hidden" name="view" value="archive" />
            <input type="hidden" name="option" value="com_content" />
            <input type="hidden" name="limitstart" value="0" />
            </fieldset>
            <div class=" bd-grid-6 bd-margins">
              <div class="container-fluid">
                <div class="separated-grid row">
            
            <?php foreach ($this->items as $i => $item) : ?>
                    <div class="separated-item-38 col-md-12 ">
                        <div class="bd-griditem-38">
                        <?php
                            $this->item = $item;
                            $this->articleTemplate = 'article_3';
                            echo $this->loadTemplate('item');
                        ?>
                        </div>
                    </div>
            <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php if (count($pagination_list) > 0) : ?>
    <div class=" bd-blogpagination-2">
        <?php
            echo renderTemplateFromIncludes('pagination_list_render_2', array($pagination_list));
        ?>
    </div>
<?php endif; ?>
    </div>
</div>

<?php
echo ob_get_clean();
?>
<!--COMPONENT blog_3 /-->
<?php
defined('_JEXEC') or die;
?>

<!--COMPONENT blog_10 -->

<?php
$component = new DesignerContent($this, $this->params);

$pageHeading = $component->pageHeading;
ob_start();
?>

<div class=" bd-blog-10 bd-page-width  bd-no-margins <?php echo $this->pageclass_sfx; ?>" /**/style="display:none"/**/ >
    <div class="bd-container-inner">
    
    <?php
        $GLOBALS['theme_settings']['active_paginator'] = 'specific';
        $pagination_list = $this->pagination->getPagesLinks();
    ?>
    
    <div class="bd-container-inner">
        <form id="adminForm" action="<?php echo JRoute::_('index.php')?>" method="post">
            <fieldset class="filters">
            <legend class="hidelabeltxt"><?php echo JText::_('JGLOBAL_FILTER_LABEL'); ?></legend>
            <div class="filter-search">
                <?php if ($this->params->get('filter_field') != 'hide') : ?>
                <label class="filter-search-lbl" for="filter-search"><?php echo JText::_('COM_CONTENT_TITLE_FILTER_LABEL').'&#160;'; ?></label>
                <input type="text" name="filter-search" id="filter-search" value="<?php echo $this->escape($this->filter); ?>" class="inputbox" onchange="document.getElementById('adminForm').submit();" />
                <?php endif; ?>

                <?php echo $this->form->monthField; ?>
                <?php echo $this->form->yearField; ?>
                <?php echo $this->form->limitField; ?>
                <button type="submit" class="button"><?php echo JText::_('JGLOBAL_FILTER_BUTTON'); ?></button>
            </div>
            <input type="hidden" name="view" value="archive" />
            <input type="hidden" name="option" value="com_content" />
            <input type="hidden" name="limitstart" value="0" />
            </fieldset>
            <div class=" bd-grid-21 bd-margins">
              <div class="container-fluid">
                <div class="separated-grid row">
            
            <?php foreach ($this->items as $i => $item) : ?>
                    <div class="separated-item-15 col-md-6 ">
                        <div class="bd-griditem-15">
                        <?php
                            $this->item = $item;
                            $this->articleTemplate = 'article_11';
                            echo $this->loadTemplate('item');
                        ?>
                        </div>
                    </div>
            <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php if (count($pagination_list) > 0) : ?>
    <div class=" bd-blogpagination-10">
        <?php
            echo renderTemplateFromIncludes('pagination_list_render_10', array($pagination_list));
        ?>
    </div>
<?php endif; ?>
    </div>
</div>

<?php
echo ob_get_clean();
?>
<!--COMPONENT blog_10 /-->
<?php
defined('_JEXEC') or die;
?>

<!--COMPONENT blog_2 -->

<?php
$component = new DesignerContent($this, $this->params);

$pageHeading = $component->pageHeading;
ob_start();
?>

<div class=" bd-blog-2 bd-page-width  <?php echo $this->pageclass_sfx; ?>" /**/style="display:none"/**/ >
    <div class="bd-container-inner">
    
        <?php if ($pageHeading) : ?>
            <h1 class=" bd-container-4 bd-tagstyles bd-bootstrap-img bd-img-responsive bd-bootstrap-tables bd-table-striped bd-table-bordered bd-table-hover bd-table-condensed bd-table-responsive"><?php echo $pageHeading; ?></h1>
        <?php endif; ?>
    <?php
        $GLOBALS['theme_settings']['active_paginator'] = 'specific';
        $pagination_list = $this->pagination->getPagesLinks();
    ?>
    
    <div class="bd-container-inner">
        <form id="adminForm" action="<?php echo JRoute::_('index.php')?>" method="post">
            <fieldset class="filters">
            <legend class="hidelabeltxt"><?php echo JText::_('JGLOBAL_FILTER_LABEL'); ?></legend>
            <div class="filter-search">
                <?php if ($this->params->get('filter_field') != 'hide') : ?>
                <label class="filter-search-lbl" for="filter-search"><?php echo JText::_('COM_CONTENT_TITLE_FILTER_LABEL').'&#160;'; ?></label>
                <input type="text" name="filter-search" id="filter-search" value="<?php echo $this->escape($this->filter); ?>" class="inputbox" onchange="document.getElementById('adminForm').submit();" />
                <?php endif; ?>

                <?php echo $this->form->monthField; ?>
                <?php echo $this->form->yearField; ?>
                <?php echo $this->form->limitField; ?>
                <button type="submit" class="button"><?php echo JText::_('JGLOBAL_FILTER_BUTTON'); ?></button>
            </div>
            <input type="hidden" name="view" value="archive" />
            <input type="hidden" name="option" value="com_content" />
            <input type="hidden" name="limitstart" value="0" />
            </fieldset>
            <div class=" bd-grid-1 bd-margins">
              <div class="container-fluid">
                <div class="separated-grid row">
            
            <?php foreach ($this->items as $i => $item) : ?>
                    <div class="separated-item-7 col-md-12 ">
                        <div class="bd-griditem-7">
                        <?php
                            $this->item = $item;
                            $this->articleTemplate = 'article_7';
                            echo $this->loadTemplate('item');
                        ?>
                        </div>
                    </div>
            <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php if (count($pagination_list) > 0) : ?>
    <div class=" bd-blogpagination-6">
        <?php
            echo renderTemplateFromIncludes('pagination_list_render_6', array($pagination_list));
        ?>
    </div>
<?php endif; ?>
    </div>
</div>

<?php
echo ob_get_clean();
?>
<!--COMPONENT blog_2 /-->
<?php
defined('_JEXEC') or die;
?>

<!--COMPONENT blog_4 -->

<?php
$component = new DesignerContent($this, $this->params);

$pageHeading = $component->pageHeading;
ob_start();
?>

<div class=" bd-blog-4 bd-page-width  <?php echo $this->pageclass_sfx; ?>" /**/style="display:none"/**/ >
    <div class="bd-container-inner">
    
    <?php
        $GLOBALS['theme_settings']['active_paginator'] = 'specific';
        $pagination_list = $this->pagination->getPagesLinks();
    ?>
    
    <div class="bd-container-inner">
        <form id="adminForm" action="<?php echo JRoute::_('index.php')?>" method="post">
            <fieldset class="filters">
            <legend class="hidelabeltxt"><?php echo JText::_('JGLOBAL_FILTER_LABEL'); ?></legend>
            <div class="filter-search">
                <?php if ($this->params->get('filter_field') != 'hide') : ?>
                <label class="filter-search-lbl" for="filter-search"><?php echo JText::_('COM_CONTENT_TITLE_FILTER_LABEL').'&#160;'; ?></label>
                <input type="text" name="filter-search" id="filter-search" value="<?php echo $this->escape($this->filter); ?>" class="inputbox" onchange="document.getElementById('adminForm').submit();" />
                <?php endif; ?>

                <?php echo $this->form->monthField; ?>
                <?php echo $this->form->yearField; ?>
                <?php echo $this->form->limitField; ?>
                <button type="submit" class="button"><?php echo JText::_('JGLOBAL_FILTER_BUTTON'); ?></button>
            </div>
            <input type="hidden" name="view" value="archive" />
            <input type="hidden" name="option" value="com_content" />
            <input type="hidden" name="limitstart" value="0" />
            </fieldset>
            <div class=" bd-grid-14 bd-page-width  bd-margins">
              <div class="container-fluid">
                <div class="separated-grid row">
            
            <?php foreach ($this->items as $i => $item) : ?>
                    <div class="separated-item-5 col-md-6 ">
                        <div class="bd-griditem-5">
                        <?php
                            $this->item = $item;
                            $this->articleTemplate = 'article_8';
                            echo $this->loadTemplate('item');
                        ?>
                        </div>
                    </div>
            <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php if (count($pagination_list) > 0) : ?>
    <div class=" bd-blogpagination-7">
        <?php
            echo renderTemplateFromIncludes('pagination_list_render_7', array($pagination_list));
        ?>
    </div>
<?php endif; ?>
    </div>
</div>

<?php
echo ob_get_clean();
?>
<!--COMPONENT blog_4 /-->
<?php
defined('_JEXEC') or die;
?>

<!--COMPONENT blog_7 -->

<?php
$component = new DesignerContent($this, $this->params);

$pageHeading = $component->pageHeading;
ob_start();
?>

<div class=" bd-blog-7 <?php echo $this->pageclass_sfx; ?>" /**/style="display:none"/**/ >
    <div class="bd-container-inner">
    
        <?php if ($pageHeading) : ?>
            <h1 class=" bd-container-24 bd-tagstyles bd-bootstrap-img bd-img-responsive bd-bootstrap-tables bd-table-striped bd-table-bordered bd-table-hover bd-table-condensed bd-table-responsive"><?php echo $pageHeading; ?></h1>
        <?php endif; ?>
    <?php
        $GLOBALS['theme_settings']['active_paginator'] = 'specific';
        $pagination_list = $this->pagination->getPagesLinks();
    ?>
    
    <div class="bd-container-inner">
        <form id="adminForm" action="<?php echo JRoute::_('index.php')?>" method="post">
            <fieldset class="filters">
            <legend class="hidelabeltxt"><?php echo JText::_('JGLOBAL_FILTER_LABEL'); ?></legend>
            <div class="filter-search">
                <?php if ($this->params->get('filter_field') != 'hide') : ?>
                <label class="filter-search-lbl" for="filter-search"><?php echo JText::_('COM_CONTENT_TITLE_FILTER_LABEL').'&#160;'; ?></label>
                <input type="text" name="filter-search" id="filter-search" value="<?php echo $this->escape($this->filter); ?>" class="inputbox" onchange="document.getElementById('adminForm').submit();" />
                <?php endif; ?>

                <?php echo $this->form->monthField; ?>
                <?php echo $this->form->yearField; ?>
                <?php echo $this->form->limitField; ?>
                <button type="submit" class="button"><?php echo JText::_('JGLOBAL_FILTER_BUTTON'); ?></button>
            </div>
            <input type="hidden" name="view" value="archive" />
            <input type="hidden" name="option" value="com_content" />
            <input type="hidden" name="limitstart" value="0" />
            </fieldset>
            <div class=" bd-grid-8 bd-margins">
              <div class="container-fluid">
                <div class="separated-grid row">
            
            <?php foreach ($this->items as $i => $item) : ?>
                    <div class="separated-item-12 col-md-12 ">
                        <div class="bd-griditem-12">
                        <?php
                            $this->item = $item;
                            $this->articleTemplate = 'article_5';
                            echo $this->loadTemplate('item');
                        ?>
                        </div>
                    </div>
            <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php if (count($pagination_list) > 0) : ?>
    <div class=" bd-blogpagination-4">
        <?php
            echo renderTemplateFromIncludes('pagination_list_render_4', array($pagination_list));
        ?>
    </div>
<?php endif; ?>
    </div>
</div>

<?php
echo ob_get_clean();
?>
<!--COMPONENT blog_7 /-->
<?php
defined('_JEXEC') or die;
?>

<!--COMPONENT blog_8 -->

<?php
$component = new DesignerContent($this, $this->params);

$pageHeading = $component->pageHeading;
ob_start();
?>

<div class=" bd-blog-8 <?php echo $this->pageclass_sfx; ?>" /**/style="display:none"/**/ >
    <div class="bd-container-inner">
    
        <?php if ($pageHeading) : ?>
            <h1 class=" bd-container-27 bd-tagstyles bd-bootstrap-img bd-img-responsive bd-bootstrap-tables bd-table-striped bd-table-bordered bd-table-hover bd-table-condensed bd-table-responsive"><?php echo $pageHeading; ?></h1>
        <?php endif; ?>
    <?php
        $GLOBALS['theme_settings']['active_paginator'] = 'specific';
        $pagination_list = $this->pagination->getPagesLinks();
    ?>
    
    <div class="bd-container-inner">
        <form id="adminForm" action="<?php echo JRoute::_('index.php')?>" method="post">
            <fieldset class="filters">
            <legend class="hidelabeltxt"><?php echo JText::_('JGLOBAL_FILTER_LABEL'); ?></legend>
            <div class="filter-search">
                <?php if ($this->params->get('filter_field') != 'hide') : ?>
                <label class="filter-search-lbl" for="filter-search"><?php echo JText::_('COM_CONTENT_TITLE_FILTER_LABEL').'&#160;'; ?></label>
                <input type="text" name="filter-search" id="filter-search" value="<?php echo $this->escape($this->filter); ?>" class="inputbox" onchange="document.getElementById('adminForm').submit();" />
                <?php endif; ?>

                <?php echo $this->form->monthField; ?>
                <?php echo $this->form->yearField; ?>
                <?php echo $this->form->limitField; ?>
                <button type="submit" class="button"><?php echo JText::_('JGLOBAL_FILTER_BUTTON'); ?></button>
            </div>
            <input type="hidden" name="view" value="archive" />
            <input type="hidden" name="option" value="com_content" />
            <input type="hidden" name="limitstart" value="0" />
            </fieldset>
            <div class=" bd-grid-9 bd-margins">
              <div class="container-fluid">
                <div class="separated-grid row">
            
            <?php foreach ($this->items as $i => $item) : ?>
                    <div class="separated-item-23 col-md-12 ">
                        <div class="bd-griditem-23">
                        <?php
                            $this->item = $item;
                            $this->articleTemplate = 'article_6';
                            echo $this->loadTemplate('item');
                        ?>
                        </div>
                    </div>
            <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php if (count($pagination_list) > 0) : ?>
    <div class=" bd-blogpagination-5">
        <?php
            echo renderTemplateFromIncludes('pagination_list_render_5', array($pagination_list));
        ?>
    </div>
<?php endif; ?>
    </div>
</div>

<?php
echo ob_get_clean();
?>
<!--COMPONENT blog_8 /-->