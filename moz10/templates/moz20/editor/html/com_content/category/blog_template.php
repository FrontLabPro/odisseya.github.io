<?php
defined('_JEXEC') or die;
?>

<!--COMPONENT common -->
<?php
$view = new DesignerContent($this, $this->params);

$leadArticles = $this->lead_items;
$countLeadArticles = count($this->lead_items);
$introArticles = $this->intro_items;
$countIntroArticles = count($this->intro_items);

$sampleItems = sampleArticlesForPreview($componentCurrentTemplate);
$countSampleItems = count($sampleItems);

$startNav = (int)JRequest::getVar('start');
if ($startNav != 0 && isset($sampleItems[$startNav])) {
    $sampleItems = array_slice($sampleItems, $startNav);
}

if ($countSampleItems > 0) {
    $this->lead_items = null;

    /*foreach($leadArticles as $i => $item) {
        $sampleItems[] = $item;
    }
    $leadArticles = array_slice($sampleItems, 0, $countLeadArticles);

    $sampleItems = array_slice($sampleItems, $countLeadArticles);*/

    foreach($introArticles as $i => $item) {
        $sampleItems[] = $item;
    }

    $introArticles = array_slice($sampleItems, 0, ($countIntroArticles > $countSampleItems ? $countIntroArticles : $countSampleItems));
}


$this->articleTemplate = 'article_2';

ob_start();
?>

<div class="data-control-id-3035 bd-blog bd-page-width  <?php echo $this->pageclass_sfx; ?>" itemscope itemtype="http://schema.org/Blog"  >
    <div class="bd-container-inner">
<?php

$categoryTitle = '';
if ($this->params->get('show_category_title', 1) || strlen($this->params->get('page_subheading'))) {
    $categoryTitle = $this->escape($this->params->get('page_subheading'));
    if ($this->params->get('show_category_title') && strlen($this->category->title))
        $categoryTitle .= ' ' . $this->category->title;
}

$categoryInfo = '';
if ($this->params->def('show_description', 1) || $this->params->def('show_description_image', 1)) {
    if ($this->params->get('show_description_image') && $this->category->getParams()->get('image'))
        $categoryInfo .= ' <img src="' . $this->category->getParams()->get('image') . '" alt="" />';
    if ($this->params->get('show_description') && $this->category->description)
        $categoryInfo .= ' ' .JHtml::_('content.prepare', $this->category->description, '', 'com_content.category');
}

$pagination_list = array();
if (($this->params->def('show_pagination', 1) == 1 || $this->params->get('show_pagination') == 2)
    && $this->pagination->get('pages.total') > 1)
{
    $GLOBALS['theme_settings']['active_paginator'] = 'specific';
    $pagination_list = $this->pagination->getPagesLinks();
}

$pageHeading = $view->pageHeading;
?>



<?php if ($categoryTitle) : ?>
    <h2 class="data-control-id-1297133 bd-container-113 bd-tagstyles bd-bootstrap-img bd-img-responsive bd-bootstrap-tables bd-table-striped bd-table-bordered bd-table-hover bd-table-condensed bd-table-responsive">
    <?php echo $categoryTitle; ?>
</h2>
<?php endif; ?>


<?php if ($categoryInfo) : ?>
    <div class="data-control-id-1297145 bd-container-119 bd-tagstyles bd-bootstrap-img bd-img-responsive bd-bootstrap-tables bd-table-striped bd-table-bordered bd-table-hover bd-table-condensed bd-table-responsive">
    <?php echo $categoryInfo; ?>
</div>
<?php endif; ?>


 <?php
    $itemClass = 'separated-item-30 col-md-12 ';
    $mergedModes = '' . '1' . '' . '';
    $str = 'col-lg-1 col-md-1 col-sm-1 col-xs-1';
?>
<?php $leadingcount=0 ; ?>
<?php if (!empty($this->lead_items)) : ?>
<div class="data-control-id-2881 bd-grid-5 bd-margins">
  <div class="container-fluid">
    <div class="separated-grid row">
    <?php
        $leadingItemClass = preg_replace('/col-(lg|md|sm|xs)-\d+/', 'col-$1-' . 12, $str);
    ?>
    <?php foreach ($leadArticles as &$item) : ?>
        <div class="<?php echo $leadingItemClass; ?>" itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting">
            <div class="bd-griditem-30">
            <?php
                $this->item = &$item;
                echo $this->loadTemplate('item');
            ?>
            </div>
        </div>
        <?php $leadingcount++; ?>
    <?php endforeach; ?>
        </div>
   </div>
</div>
<?php endif; ?>
<?php
    $introcount = (count($this->intro_items));
    $counter = 0;
?>
<?php if (!empty($this->intro_items)) : ?>
<div class="data-control-id-2881 bd-grid-5 bd-margins">
  <div class="container-fluid">
    <div class="separated-grid row">
    <?php
        $introItemClass = $itemClass;
        if ('' === $mergedModes) {
            $str = str_replace('col-xs-1', 'col-xs-12', $str);
            $introItemClass = $introItemClass . preg_replace('/col-(lg|md|sm)-\d+/', 'col-$1-' . round(12 / min(12, max(1, $this->columns))), $str);
        }
    ?>
    <?php foreach ($introArticles as $key => &$item) : ?>
    <?php
        $rowcount = ((int) $key % (int) $this->columns) + 1;
        $row = $counter / $this->columns ;
    ?>
    <?php $counter++; ?>
    <div class="<?php echo $introItemClass; ?>" itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting">
        <div class="bd-griditem-30">
    <?php
        $this->item = &$item;
        echo $this->loadTemplate('item');
    ?>
        </div>
    </div>
    <?php endforeach; ?>
        </div>
    </div>
</div>
<?php endif; ?>

<?php if (!empty($this->link_items)) : ?>
    <div class="items-more">
        <?php echo $this->loadTemplate('links'); ?>
    </div>
<?php endif; ?>

<?php  if (!empty($this->children[$this->category->id])&& $this->maxLevel != 0) : ?>
    <div class="cat-children">
    <?php
        echo renderTemplateFromIncludes('article_2', array(array('header-text' => JTEXT::_('JGLOBAL_SUBCATEGORIES'),
            'content' => $this->loadTemplate('children'))));
    ?>
    </div>
<?php endif; ?>
<?php if (count($pagination_list) > 0) : ?>
    <div class="data-control-id-2919 bd-blogpagination-1">
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
$view = new DesignerContent($this, $this->params);

$leadArticles = $this->lead_items;
$countLeadArticles = count($this->lead_items);
$introArticles = $this->intro_items;
$countIntroArticles = count($this->intro_items);

$sampleItems = sampleArticlesForPreview($componentCurrentTemplate);
$countSampleItems = count($sampleItems);

$startNav = (int)JRequest::getVar('start');
if ($startNav != 0 && isset($sampleItems[$startNav])) {
    $sampleItems = array_slice($sampleItems, $startNav);
}

if ($countSampleItems > 0) {
    $this->lead_items = null;

    /*foreach($leadArticles as $i => $item) {
        $sampleItems[] = $item;
    }
    $leadArticles = array_slice($sampleItems, 0, $countLeadArticles);

    $sampleItems = array_slice($sampleItems, $countLeadArticles);*/

    foreach($introArticles as $i => $item) {
        $sampleItems[] = $item;
    }

    $introArticles = array_slice($sampleItems, 0, ($countIntroArticles > $countSampleItems ? $countIntroArticles : $countSampleItems));
}


$this->articleTemplate = 'article_10';

ob_start();
?>

<div class="data-control-id-1424399 bd-blog-9 bd-page-width  <?php echo $this->pageclass_sfx; ?>" itemscope itemtype="http://schema.org/Blog" /**/style="display:none"/**/ >
    <div class="bd-container-inner">
<?php

$categoryTitle = '';
if ($this->params->get('show_category_title', 1) || strlen($this->params->get('page_subheading'))) {
    $categoryTitle = $this->escape($this->params->get('page_subheading'));
    if ($this->params->get('show_category_title') && strlen($this->category->title))
        $categoryTitle .= ' ' . $this->category->title;
}

$categoryInfo = '';
if ($this->params->def('show_description', 1) || $this->params->def('show_description_image', 1)) {
    if ($this->params->get('show_description_image') && $this->category->getParams()->get('image'))
        $categoryInfo .= ' <img src="' . $this->category->getParams()->get('image') . '" alt="" />';
    if ($this->params->get('show_description') && $this->category->description)
        $categoryInfo .= ' ' .JHtml::_('content.prepare', $this->category->description, '', 'com_content.category');
}

$pagination_list = array();
if (($this->params->def('show_pagination', 1) == 1 || $this->params->get('show_pagination') == 2)
    && $this->pagination->get('pages.total') > 1)
{
    $GLOBALS['theme_settings']['active_paginator'] = 'specific';
    $pagination_list = $this->pagination->getPagesLinks();
}

$pageHeading = $view->pageHeading;
?>



<?php if ($categoryTitle) : ?>
    <h2 class="data-control-id-1424346 bd-container-138 bd-tagstyles bd-bootstrap-img bd-img-responsive bd-bootstrap-tables bd-table-striped bd-table-bordered bd-table-hover bd-table-condensed bd-table-responsive">
    <?php echo $categoryTitle; ?>
</h2>
<?php endif; ?>


<?php if ($categoryInfo) : ?>
    <div class="data-control-id-1424358 bd-container-139 bd-tagstyles bd-bootstrap-img bd-img-responsive bd-bootstrap-tables bd-table-striped bd-table-bordered bd-table-hover bd-table-condensed bd-table-responsive">
    <?php echo $categoryInfo; ?>
</div>
<?php endif; ?>


 <?php
    $itemClass = 'separated-item-4 col-md-6 ';
    $mergedModes = '' . '2' . '' . '';
    $str = 'col-lg-1 col-md-1 col-sm-1 col-xs-1';
?>
<?php $leadingcount=0 ; ?>
<?php if (!empty($this->lead_items)) : ?>
<div class="data-control-id-1424322 bd-grid-18 bd-margins">
  <div class="container-fluid">
    <div class="separated-grid row">
    <?php
        $leadingItemClass = preg_replace('/col-(lg|md|sm|xs)-\d+/', 'col-$1-' . 12, $str);
    ?>
    <?php foreach ($leadArticles as &$item) : ?>
        <div class="<?php echo $leadingItemClass; ?>" itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting">
            <div class="bd-griditem-4">
            <?php
                $this->item = &$item;
                echo $this->loadTemplate('item');
            ?>
            </div>
        </div>
        <?php $leadingcount++; ?>
    <?php endforeach; ?>
        </div>
   </div>
</div>
<?php endif; ?>
<?php
    $introcount = (count($this->intro_items));
    $counter = 0;
?>
<?php if (!empty($this->intro_items)) : ?>
<div class="data-control-id-1424322 bd-grid-18 bd-margins">
  <div class="container-fluid">
    <div class="separated-grid row">
    <?php
        $introItemClass = $itemClass;
        if ('' === $mergedModes) {
            $str = str_replace('col-xs-1', 'col-xs-12', $str);
            $introItemClass = $introItemClass . preg_replace('/col-(lg|md|sm)-\d+/', 'col-$1-' . round(12 / min(12, max(1, $this->columns))), $str);
        }
    ?>
    <?php foreach ($introArticles as $key => &$item) : ?>
    <?php
        $rowcount = ((int) $key % (int) $this->columns) + 1;
        $row = $counter / $this->columns ;
    ?>
    <?php $counter++; ?>
    <div class="<?php echo $introItemClass; ?>" itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting">
        <div class="bd-griditem-4">
    <?php
        $this->item = &$item;
        echo $this->loadTemplate('item');
    ?>
        </div>
    </div>
    <?php endforeach; ?>
        </div>
    </div>
</div>
<?php endif; ?>

<?php if (!empty($this->link_items)) : ?>
    <div class="items-more">
        <?php echo $this->loadTemplate('links'); ?>
    </div>
<?php endif; ?>

<?php  if (!empty($this->children[$this->category->id])&& $this->maxLevel != 0) : ?>
    <div class="cat-children">
    <?php
        echo renderTemplateFromIncludes('article_10', array(array('header-text' => JTEXT::_('JGLOBAL_SUBCATEGORIES'),
            'content' => $this->loadTemplate('children'))));
    ?>
    </div>
<?php endif; ?>
<?php if (count($pagination_list) > 0) : ?>
    <div class="data-control-id-1424360 bd-blogpagination-9">
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
$view = new DesignerContent($this, $this->params);

$leadArticles = $this->lead_items;
$countLeadArticles = count($this->lead_items);
$introArticles = $this->intro_items;
$countIntroArticles = count($this->intro_items);

$sampleItems = sampleArticlesForPreview($componentCurrentTemplate);
$countSampleItems = count($sampleItems);

$startNav = (int)JRequest::getVar('start');
if ($startNav != 0 && isset($sampleItems[$startNav])) {
    $sampleItems = array_slice($sampleItems, $startNav);
}

if ($countSampleItems > 0) {
    $this->lead_items = null;

    /*foreach($leadArticles as $i => $item) {
        $sampleItems[] = $item;
    }
    $leadArticles = array_slice($sampleItems, 0, $countLeadArticles);

    $sampleItems = array_slice($sampleItems, $countLeadArticles);*/

    foreach($introArticles as $i => $item) {
        $sampleItems[] = $item;
    }

    $introArticles = array_slice($sampleItems, 0, ($countIntroArticles > $countSampleItems ? $countIntroArticles : $countSampleItems));
}


$this->articleTemplate = 'article_4';

ob_start();
?>

<div class="data-control-id-3353 bd-blog-5 bd-page-width  <?php echo $this->pageclass_sfx; ?>" itemscope itemtype="http://schema.org/Blog" /**/style="display:none"/**/ >
    <div class="bd-container-inner">
<?php

$categoryTitle = '';
if ($this->params->get('show_category_title', 1) || strlen($this->params->get('page_subheading'))) {
    $categoryTitle = $this->escape($this->params->get('page_subheading'));
    if ($this->params->get('show_category_title') && strlen($this->category->title))
        $categoryTitle .= ' ' . $this->category->title;
}

$categoryInfo = '';
if ($this->params->def('show_description', 1) || $this->params->def('show_description_image', 1)) {
    if ($this->params->get('show_description_image') && $this->category->getParams()->get('image'))
        $categoryInfo .= ' <img src="' . $this->category->getParams()->get('image') . '" alt="" />';
    if ($this->params->get('show_description') && $this->category->description)
        $categoryInfo .= ' ' .JHtml::_('content.prepare', $this->category->description, '', 'com_content.category');
}

$pagination_list = array();
if (($this->params->def('show_pagination', 1) == 1 || $this->params->get('show_pagination') == 2)
    && $this->pagination->get('pages.total') > 1)
{
    $GLOBALS['theme_settings']['active_paginator'] = 'specific';
    $pagination_list = $this->pagination->getPagesLinks();
}

$pageHeading = $view->pageHeading;
?>

<?php if ($pageHeading) : ?>
    <h1 class="data-control-id-3231 bd-container-21 bd-tagstyles bd-bootstrap-img bd-img-responsive bd-bootstrap-tables bd-table-striped bd-table-bordered bd-table-hover bd-table-condensed bd-table-responsive"><?php echo $pageHeading; ?></h1>
<?php endif; ?>


<?php if ($categoryTitle) : ?>
    <h2 class="data-control-id-1296571 bd-container-86 bd-tagstyles bd-bootstrap-img bd-img-responsive bd-bootstrap-tables bd-table-striped bd-table-bordered bd-table-hover bd-table-condensed bd-table-responsive">
    <?php echo $categoryTitle; ?>
</h2>
<?php endif; ?>


<?php if ($categoryInfo) : ?>
    <div class="data-control-id-1296583 bd-container-97 bd-tagstyles bd-bootstrap-img bd-img-responsive bd-bootstrap-tables bd-table-striped bd-table-bordered bd-table-hover bd-table-condensed bd-table-responsive">
    <?php echo $categoryInfo; ?>
</div>
<?php endif; ?>


 <?php
    $itemClass = 'separated-item-46 col-md-12 ';
    $mergedModes = '' . '1' . '' . '';
    $str = 'col-lg-1 col-md-1 col-sm-1 col-xs-1';
?>
<?php $leadingcount=0 ; ?>
<?php if (!empty($this->lead_items)) : ?>
<div class="data-control-id-3199 bd-grid-7 bd-margins">
  <div class="container-fluid">
    <div class="separated-grid row">
    <?php
        $leadingItemClass = preg_replace('/col-(lg|md|sm|xs)-\d+/', 'col-$1-' . 12, $str);
    ?>
    <?php foreach ($leadArticles as &$item) : ?>
        <div class="<?php echo $leadingItemClass; ?>" itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting">
            <div class="bd-griditem-46">
            <?php
                $this->item = &$item;
                echo $this->loadTemplate('item');
            ?>
            </div>
        </div>
        <?php $leadingcount++; ?>
    <?php endforeach; ?>
        </div>
   </div>
</div>
<?php endif; ?>
<?php
    $introcount = (count($this->intro_items));
    $counter = 0;
?>
<?php if (!empty($this->intro_items)) : ?>
<div class="data-control-id-3199 bd-grid-7 bd-margins">
  <div class="container-fluid">
    <div class="separated-grid row">
    <?php
        $introItemClass = $itemClass;
        if ('' === $mergedModes) {
            $str = str_replace('col-xs-1', 'col-xs-12', $str);
            $introItemClass = $introItemClass . preg_replace('/col-(lg|md|sm)-\d+/', 'col-$1-' . round(12 / min(12, max(1, $this->columns))), $str);
        }
    ?>
    <?php foreach ($introArticles as $key => &$item) : ?>
    <?php
        $rowcount = ((int) $key % (int) $this->columns) + 1;
        $row = $counter / $this->columns ;
    ?>
    <?php $counter++; ?>
    <div class="<?php echo $introItemClass; ?>" itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting">
        <div class="bd-griditem-46">
    <?php
        $this->item = &$item;
        echo $this->loadTemplate('item');
    ?>
        </div>
    </div>
    <?php endforeach; ?>
        </div>
    </div>
</div>
<?php endif; ?>

<?php if (!empty($this->link_items)) : ?>
    <div class="items-more">
        <?php echo $this->loadTemplate('links'); ?>
    </div>
<?php endif; ?>

<?php  if (!empty($this->children[$this->category->id])&& $this->maxLevel != 0) : ?>
    <div class="cat-children">
    <?php
        echo renderTemplateFromIncludes('article_4', array(array('header-text' => JTEXT::_('JGLOBAL_SUBCATEGORIES'),
            'content' => $this->loadTemplate('children'))));
    ?>
    </div>
<?php endif; ?>
<?php if (count($pagination_list) > 0) : ?>
    <div class="data-control-id-3237 bd-blogpagination-3">
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
$view = new DesignerContent($this, $this->params);

$leadArticles = $this->lead_items;
$countLeadArticles = count($this->lead_items);
$introArticles = $this->intro_items;
$countIntroArticles = count($this->intro_items);

$sampleItems = sampleArticlesForPreview($componentCurrentTemplate);
$countSampleItems = count($sampleItems);

$startNav = (int)JRequest::getVar('start');
if ($startNav != 0 && isset($sampleItems[$startNav])) {
    $sampleItems = array_slice($sampleItems, $startNav);
}

if ($countSampleItems > 0) {
    $this->lead_items = null;

    /*foreach($leadArticles as $i => $item) {
        $sampleItems[] = $item;
    }
    $leadArticles = array_slice($sampleItems, 0, $countLeadArticles);

    $sampleItems = array_slice($sampleItems, $countLeadArticles);*/

    foreach($introArticles as $i => $item) {
        $sampleItems[] = $item;
    }

    $introArticles = array_slice($sampleItems, 0, ($countIntroArticles > $countSampleItems ? $countIntroArticles : $countSampleItems));
}


$this->articleTemplate = 'article_3';

ob_start();
?>

<div class="data-control-id-3194 bd-blog-3 bd-page-width  <?php echo $this->pageclass_sfx; ?>" itemscope itemtype="http://schema.org/Blog" /**/style="display:none"/**/ >
    <div class="bd-container-inner">
<?php

$categoryTitle = '';
if ($this->params->get('show_category_title', 1) || strlen($this->params->get('page_subheading'))) {
    $categoryTitle = $this->escape($this->params->get('page_subheading'));
    if ($this->params->get('show_category_title') && strlen($this->category->title))
        $categoryTitle .= ' ' . $this->category->title;
}

$categoryInfo = '';
if ($this->params->def('show_description', 1) || $this->params->def('show_description_image', 1)) {
    if ($this->params->get('show_description_image') && $this->category->getParams()->get('image'))
        $categoryInfo .= ' <img src="' . $this->category->getParams()->get('image') . '" alt="" />';
    if ($this->params->get('show_description') && $this->category->description)
        $categoryInfo .= ' ' .JHtml::_('content.prepare', $this->category->description, '', 'com_content.category');
}

$pagination_list = array();
if (($this->params->def('show_pagination', 1) == 1 || $this->params->get('show_pagination') == 2)
    && $this->pagination->get('pages.total') > 1)
{
    $GLOBALS['theme_settings']['active_paginator'] = 'specific';
    $pagination_list = $this->pagination->getPagesLinks();
}

$pageHeading = $view->pageHeading;
?>

<?php if ($pageHeading) : ?>
    <h1 class="data-control-id-3072 bd-container-18 bd-tagstyles bd-bootstrap-img bd-img-responsive bd-bootstrap-tables bd-table-striped bd-table-bordered bd-table-hover bd-table-condensed bd-table-responsive"><?php echo $pageHeading; ?></h1>
<?php endif; ?>


<?php if ($categoryTitle) : ?>
    <h2 class="data-control-id-1296481 bd-container-76 bd-tagstyles bd-bootstrap-img bd-img-responsive bd-bootstrap-tables bd-table-striped bd-table-bordered bd-table-hover bd-table-condensed bd-table-responsive">
    <?php echo $categoryTitle; ?>
</h2>
<?php endif; ?>


<?php if ($categoryInfo) : ?>
    <div class="data-control-id-1296493 bd-container-84 bd-tagstyles bd-bootstrap-img bd-img-responsive bd-bootstrap-tables bd-table-striped bd-table-bordered bd-table-hover bd-table-condensed bd-table-responsive">
    <?php echo $categoryInfo; ?>
</div>
<?php endif; ?>


 <?php
    $itemClass = 'separated-item-38 col-md-12 ';
    $mergedModes = '' . '1' . '' . '';
    $str = 'col-lg-1 col-md-1 col-sm-1 col-xs-1';
?>
<?php $leadingcount=0 ; ?>
<?php if (!empty($this->lead_items)) : ?>
<div class="data-control-id-3040 bd-grid-6 bd-margins">
  <div class="container-fluid">
    <div class="separated-grid row">
    <?php
        $leadingItemClass = preg_replace('/col-(lg|md|sm|xs)-\d+/', 'col-$1-' . 12, $str);
    ?>
    <?php foreach ($leadArticles as &$item) : ?>
        <div class="<?php echo $leadingItemClass; ?>" itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting">
            <div class="bd-griditem-38">
            <?php
                $this->item = &$item;
                echo $this->loadTemplate('item');
            ?>
            </div>
        </div>
        <?php $leadingcount++; ?>
    <?php endforeach; ?>
        </div>
   </div>
</div>
<?php endif; ?>
<?php
    $introcount = (count($this->intro_items));
    $counter = 0;
?>
<?php if (!empty($this->intro_items)) : ?>
<div class="data-control-id-3040 bd-grid-6 bd-margins">
  <div class="container-fluid">
    <div class="separated-grid row">
    <?php
        $introItemClass = $itemClass;
        if ('' === $mergedModes) {
            $str = str_replace('col-xs-1', 'col-xs-12', $str);
            $introItemClass = $introItemClass . preg_replace('/col-(lg|md|sm)-\d+/', 'col-$1-' . round(12 / min(12, max(1, $this->columns))), $str);
        }
    ?>
    <?php foreach ($introArticles as $key => &$item) : ?>
    <?php
        $rowcount = ((int) $key % (int) $this->columns) + 1;
        $row = $counter / $this->columns ;
    ?>
    <?php $counter++; ?>
    <div class="<?php echo $introItemClass; ?>" itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting">
        <div class="bd-griditem-38">
    <?php
        $this->item = &$item;
        echo $this->loadTemplate('item');
    ?>
        </div>
    </div>
    <?php endforeach; ?>
        </div>
    </div>
</div>
<?php endif; ?>

<?php if (!empty($this->link_items)) : ?>
    <div class="items-more">
        <?php echo $this->loadTemplate('links'); ?>
    </div>
<?php endif; ?>

<?php  if (!empty($this->children[$this->category->id])&& $this->maxLevel != 0) : ?>
    <div class="cat-children">
    <?php
        echo renderTemplateFromIncludes('article_3', array(array('header-text' => JTEXT::_('JGLOBAL_SUBCATEGORIES'),
            'content' => $this->loadTemplate('children'))));
    ?>
    </div>
<?php endif; ?>
<?php if (count($pagination_list) > 0) : ?>
    <div class="data-control-id-3078 bd-blogpagination-2">
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
$view = new DesignerContent($this, $this->params);

$leadArticles = $this->lead_items;
$countLeadArticles = count($this->lead_items);
$introArticles = $this->intro_items;
$countIntroArticles = count($this->intro_items);

$sampleItems = sampleArticlesForPreview($componentCurrentTemplate);
$countSampleItems = count($sampleItems);

$startNav = (int)JRequest::getVar('start');
if ($startNav != 0 && isset($sampleItems[$startNav])) {
    $sampleItems = array_slice($sampleItems, $startNav);
}

if ($countSampleItems > 0) {
    $this->lead_items = null;

    /*foreach($leadArticles as $i => $item) {
        $sampleItems[] = $item;
    }
    $leadArticles = array_slice($sampleItems, 0, $countLeadArticles);

    $sampleItems = array_slice($sampleItems, $countLeadArticles);*/

    foreach($introArticles as $i => $item) {
        $sampleItems[] = $item;
    }

    $introArticles = array_slice($sampleItems, 0, ($countIntroArticles > $countSampleItems ? $countIntroArticles : $countSampleItems));
}


$this->articleTemplate = 'article_11';

ob_start();
?>

<div class="data-control-id-1460430 bd-blog-10 bd-page-width  bd-no-margins <?php echo $this->pageclass_sfx; ?>" itemscope itemtype="http://schema.org/Blog" /**/style="display:none"/**/ >
    <div class="bd-container-inner">
<?php

$categoryTitle = '';
if ($this->params->get('show_category_title', 1) || strlen($this->params->get('page_subheading'))) {
    $categoryTitle = $this->escape($this->params->get('page_subheading'));
    if ($this->params->get('show_category_title') && strlen($this->category->title))
        $categoryTitle .= ' ' . $this->category->title;
}

$categoryInfo = '';
if ($this->params->def('show_description', 1) || $this->params->def('show_description_image', 1)) {
    if ($this->params->get('show_description_image') && $this->category->getParams()->get('image'))
        $categoryInfo .= ' <img src="' . $this->category->getParams()->get('image') . '" alt="" />';
    if ($this->params->get('show_description') && $this->category->description)
        $categoryInfo .= ' ' .JHtml::_('content.prepare', $this->category->description, '', 'com_content.category');
}

$pagination_list = array();
if (($this->params->def('show_pagination', 1) == 1 || $this->params->get('show_pagination') == 2)
    && $this->pagination->get('pages.total') > 1)
{
    $GLOBALS['theme_settings']['active_paginator'] = 'specific';
    $pagination_list = $this->pagination->getPagesLinks();
}

$pageHeading = $view->pageHeading;
?>



<?php if ($categoryTitle) : ?>
    <h2 class="data-control-id-1460377 bd-container-170 bd-tagstyles bd-bootstrap-img bd-img-responsive bd-bootstrap-tables bd-table-striped bd-table-bordered bd-table-hover bd-table-condensed bd-table-responsive">
    <?php echo $categoryTitle; ?>
</h2>
<?php endif; ?>


<?php if ($categoryInfo) : ?>
    <div class="data-control-id-1460389 bd-container-171 bd-tagstyles bd-bootstrap-img bd-img-responsive bd-bootstrap-tables bd-table-striped bd-table-bordered bd-table-hover bd-table-condensed bd-table-responsive">
    <?php echo $categoryInfo; ?>
</div>
<?php endif; ?>


 <?php
    $itemClass = 'separated-item-15 col-md-6 ';
    $mergedModes = '' . '2' . '' . '';
    $str = 'col-lg-1 col-md-1 col-sm-1 col-xs-1';
?>
<?php $leadingcount=0 ; ?>
<?php if (!empty($this->lead_items)) : ?>
<div class="data-control-id-1460353 bd-grid-21 bd-margins">
  <div class="container-fluid">
    <div class="separated-grid row">
    <?php
        $leadingItemClass = preg_replace('/col-(lg|md|sm|xs)-\d+/', 'col-$1-' . 12, $str);
    ?>
    <?php foreach ($leadArticles as &$item) : ?>
        <div class="<?php echo $leadingItemClass; ?>" itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting">
            <div class="bd-griditem-15">
            <?php
                $this->item = &$item;
                echo $this->loadTemplate('item');
            ?>
            </div>
        </div>
        <?php $leadingcount++; ?>
    <?php endforeach; ?>
        </div>
   </div>
</div>
<?php endif; ?>
<?php
    $introcount = (count($this->intro_items));
    $counter = 0;
?>
<?php if (!empty($this->intro_items)) : ?>
<div class="data-control-id-1460353 bd-grid-21 bd-margins">
  <div class="container-fluid">
    <div class="separated-grid row">
    <?php
        $introItemClass = $itemClass;
        if ('' === $mergedModes) {
            $str = str_replace('col-xs-1', 'col-xs-12', $str);
            $introItemClass = $introItemClass . preg_replace('/col-(lg|md|sm)-\d+/', 'col-$1-' . round(12 / min(12, max(1, $this->columns))), $str);
        }
    ?>
    <?php foreach ($introArticles as $key => &$item) : ?>
    <?php
        $rowcount = ((int) $key % (int) $this->columns) + 1;
        $row = $counter / $this->columns ;
    ?>
    <?php $counter++; ?>
    <div class="<?php echo $introItemClass; ?>" itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting">
        <div class="bd-griditem-15">
    <?php
        $this->item = &$item;
        echo $this->loadTemplate('item');
    ?>
        </div>
    </div>
    <?php endforeach; ?>
        </div>
    </div>
</div>
<?php endif; ?>

<?php if (!empty($this->link_items)) : ?>
    <div class="items-more">
        <?php echo $this->loadTemplate('links'); ?>
    </div>
<?php endif; ?>

<?php  if (!empty($this->children[$this->category->id])&& $this->maxLevel != 0) : ?>
    <div class="cat-children">
    <?php
        echo renderTemplateFromIncludes('article_11', array(array('header-text' => JTEXT::_('JGLOBAL_SUBCATEGORIES'),
            'content' => $this->loadTemplate('children'))));
    ?>
    </div>
<?php endif; ?>
<?php if (count($pagination_list) > 0) : ?>
    <div class="data-control-id-1460391 bd-blogpagination-10">
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
$view = new DesignerContent($this, $this->params);

$leadArticles = $this->lead_items;
$countLeadArticles = count($this->lead_items);
$introArticles = $this->intro_items;
$countIntroArticles = count($this->intro_items);

$sampleItems = sampleArticlesForPreview($componentCurrentTemplate);
$countSampleItems = count($sampleItems);

$startNav = (int)JRequest::getVar('start');
if ($startNav != 0 && isset($sampleItems[$startNav])) {
    $sampleItems = array_slice($sampleItems, $startNav);
}

if ($countSampleItems > 0) {
    $this->lead_items = null;

    /*foreach($leadArticles as $i => $item) {
        $sampleItems[] = $item;
    }
    $leadArticles = array_slice($sampleItems, 0, $countLeadArticles);

    $sampleItems = array_slice($sampleItems, $countLeadArticles);*/

    foreach($introArticles as $i => $item) {
        $sampleItems[] = $item;
    }

    $introArticles = array_slice($sampleItems, 0, ($countIntroArticles > $countSampleItems ? $countIntroArticles : $countSampleItems));
}


$this->articleTemplate = 'article_7';

ob_start();
?>

<div class="data-control-id-1258743 bd-blog-2 bd-page-width  <?php echo $this->pageclass_sfx; ?>" itemscope itemtype="http://schema.org/Blog" /**/style="display:none"/**/ >
    <div class="bd-container-inner">
<?php

$categoryTitle = '';
if ($this->params->get('show_category_title', 1) || strlen($this->params->get('page_subheading'))) {
    $categoryTitle = $this->escape($this->params->get('page_subheading'));
    if ($this->params->get('show_category_title') && strlen($this->category->title))
        $categoryTitle .= ' ' . $this->category->title;
}

$categoryInfo = '';
if ($this->params->def('show_description', 1) || $this->params->def('show_description_image', 1)) {
    if ($this->params->get('show_description_image') && $this->category->getParams()->get('image'))
        $categoryInfo .= ' <img src="' . $this->category->getParams()->get('image') . '" alt="" />';
    if ($this->params->get('show_description') && $this->category->description)
        $categoryInfo .= ' ' .JHtml::_('content.prepare', $this->category->description, '', 'com_content.category');
}

$pagination_list = array();
if (($this->params->def('show_pagination', 1) == 1 || $this->params->get('show_pagination') == 2)
    && $this->pagination->get('pages.total') > 1)
{
    $GLOBALS['theme_settings']['active_paginator'] = 'specific';
    $pagination_list = $this->pagination->getPagesLinks();
}

$pageHeading = $view->pageHeading;
?>

<?php if ($pageHeading) : ?>
    <h1 class="data-control-id-1258708 bd-container-4 bd-tagstyles bd-bootstrap-img bd-img-responsive bd-bootstrap-tables bd-table-striped bd-table-bordered bd-table-hover bd-table-condensed bd-table-responsive"><?php echo $pageHeading; ?></h1>
<?php endif; ?>


<?php if ($categoryTitle) : ?>
    <h2 class="data-control-id-1296742 bd-container-103 bd-tagstyles bd-bootstrap-img bd-img-responsive bd-bootstrap-tables bd-table-striped bd-table-bordered bd-table-hover bd-table-condensed bd-table-responsive">
    <?php echo $categoryTitle; ?>
</h2>
<?php endif; ?>


<?php if ($categoryInfo) : ?>
    <div class="data-control-id-1296754 bd-container-108 bd-tagstyles bd-bootstrap-img bd-img-responsive bd-bootstrap-tables bd-table-striped bd-table-bordered bd-table-hover bd-table-condensed bd-table-responsive">
    <?php echo $categoryInfo; ?>
</div>
<?php endif; ?>


 <?php
    $itemClass = 'separated-item-7 col-md-12 ';
    $mergedModes = '' . '1' . '' . '';
    $str = 'col-lg-1 col-md-1 col-sm-1 col-xs-1';
?>
<?php $leadingcount=0 ; ?>
<?php if (!empty($this->lead_items)) : ?>
<div class="data-control-id-1258698 bd-grid-1 bd-margins">
  <div class="container-fluid">
    <div class="separated-grid row">
    <?php
        $leadingItemClass = preg_replace('/col-(lg|md|sm|xs)-\d+/', 'col-$1-' . 12, $str);
    ?>
    <?php foreach ($leadArticles as &$item) : ?>
        <div class="<?php echo $leadingItemClass; ?>" itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting">
            <div class="bd-griditem-7">
            <?php
                $this->item = &$item;
                echo $this->loadTemplate('item');
            ?>
            </div>
        </div>
        <?php $leadingcount++; ?>
    <?php endforeach; ?>
        </div>
   </div>
</div>
<?php endif; ?>
<?php
    $introcount = (count($this->intro_items));
    $counter = 0;
?>
<?php if (!empty($this->intro_items)) : ?>
<div class="data-control-id-1258698 bd-grid-1 bd-margins">
  <div class="container-fluid">
    <div class="separated-grid row">
    <?php
        $introItemClass = $itemClass;
        if ('' === $mergedModes) {
            $str = str_replace('col-xs-1', 'col-xs-12', $str);
            $introItemClass = $introItemClass . preg_replace('/col-(lg|md|sm)-\d+/', 'col-$1-' . round(12 / min(12, max(1, $this->columns))), $str);
        }
    ?>
    <?php foreach ($introArticles as $key => &$item) : ?>
    <?php
        $rowcount = ((int) $key % (int) $this->columns) + 1;
        $row = $counter / $this->columns ;
    ?>
    <?php $counter++; ?>
    <div class="<?php echo $introItemClass; ?>" itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting">
        <div class="bd-griditem-7">
    <?php
        $this->item = &$item;
        echo $this->loadTemplate('item');
    ?>
        </div>
    </div>
    <?php endforeach; ?>
        </div>
    </div>
</div>
<?php endif; ?>

<?php if (!empty($this->link_items)) : ?>
    <div class="items-more">
        <?php echo $this->loadTemplate('links'); ?>
    </div>
<?php endif; ?>

<?php  if (!empty($this->children[$this->category->id])&& $this->maxLevel != 0) : ?>
    <div class="cat-children">
    <?php
        echo renderTemplateFromIncludes('article_7', array(array('header-text' => JTEXT::_('JGLOBAL_SUBCATEGORIES'),
            'content' => $this->loadTemplate('children'))));
    ?>
    </div>
<?php endif; ?>
<?php if (count($pagination_list) > 0) : ?>
    <div class="data-control-id-1258710 bd-blogpagination-6">
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
$view = new DesignerContent($this, $this->params);

$leadArticles = $this->lead_items;
$countLeadArticles = count($this->lead_items);
$introArticles = $this->intro_items;
$countIntroArticles = count($this->intro_items);

$sampleItems = sampleArticlesForPreview($componentCurrentTemplate);
$countSampleItems = count($sampleItems);

$startNav = (int)JRequest::getVar('start');
if ($startNav != 0 && isset($sampleItems[$startNav])) {
    $sampleItems = array_slice($sampleItems, $startNav);
}

if ($countSampleItems > 0) {
    $this->lead_items = null;

    /*foreach($leadArticles as $i => $item) {
        $sampleItems[] = $item;
    }
    $leadArticles = array_slice($sampleItems, 0, $countLeadArticles);

    $sampleItems = array_slice($sampleItems, $countLeadArticles);*/

    foreach($introArticles as $i => $item) {
        $sampleItems[] = $item;
    }

    $introArticles = array_slice($sampleItems, 0, ($countIntroArticles > $countSampleItems ? $countIntroArticles : $countSampleItems));
}


$this->articleTemplate = 'article_8';

ob_start();
?>

<div class="data-control-id-1453458 bd-blog-4 bd-page-width  <?php echo $this->pageclass_sfx; ?>" itemscope itemtype="http://schema.org/Blog" /**/style="display:none"/**/ >
    <div class="bd-container-inner">
<?php

$categoryTitle = '';
if ($this->params->get('show_category_title', 1) || strlen($this->params->get('page_subheading'))) {
    $categoryTitle = $this->escape($this->params->get('page_subheading'));
    if ($this->params->get('show_category_title') && strlen($this->category->title))
        $categoryTitle .= ' ' . $this->category->title;
}

$categoryInfo = '';
if ($this->params->def('show_description', 1) || $this->params->def('show_description_image', 1)) {
    if ($this->params->get('show_description_image') && $this->category->getParams()->get('image'))
        $categoryInfo .= ' <img src="' . $this->category->getParams()->get('image') . '" alt="" />';
    if ($this->params->get('show_description') && $this->category->description)
        $categoryInfo .= ' ' .JHtml::_('content.prepare', $this->category->description, '', 'com_content.category');
}

$pagination_list = array();
if (($this->params->def('show_pagination', 1) == 1 || $this->params->get('show_pagination') == 2)
    && $this->pagination->get('pages.total') > 1)
{
    $GLOBALS['theme_settings']['active_paginator'] = 'specific';
    $pagination_list = $this->pagination->getPagesLinks();
}

$pageHeading = $view->pageHeading;
?>



<?php if ($categoryTitle) : ?>
    <h2 class="data-control-id-1453405 bd-container-38 bd-tagstyles bd-bootstrap-img bd-img-responsive bd-bootstrap-tables bd-table-striped bd-table-bordered bd-table-hover bd-table-condensed bd-table-responsive">
    <?php echo $categoryTitle; ?>
</h2>
<?php endif; ?>


<?php if ($categoryInfo) : ?>
    <div class="data-control-id-1453417 bd-container-39 bd-tagstyles bd-bootstrap-img bd-img-responsive bd-bootstrap-tables bd-table-striped bd-table-bordered bd-table-hover bd-table-condensed bd-table-responsive">
    <?php echo $categoryInfo; ?>
</div>
<?php endif; ?>


 <?php
    $itemClass = 'separated-item-5 col-md-6 ';
    $mergedModes = '' . '2' . '' . '';
    $str = 'col-lg-1 col-md-1 col-sm-1 col-xs-1';
?>
<?php $leadingcount=0 ; ?>
<?php if (!empty($this->lead_items)) : ?>
<div class="data-control-id-1453381 bd-grid-14 bd-page-width  bd-margins">
  <div class="container-fluid">
    <div class="separated-grid row">
    <?php
        $leadingItemClass = preg_replace('/col-(lg|md|sm|xs)-\d+/', 'col-$1-' . 12, $str);
    ?>
    <?php foreach ($leadArticles as &$item) : ?>
        <div class="<?php echo $leadingItemClass; ?>" itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting">
            <div class="bd-griditem-5">
            <?php
                $this->item = &$item;
                echo $this->loadTemplate('item');
            ?>
            </div>
        </div>
        <?php $leadingcount++; ?>
    <?php endforeach; ?>
        </div>
   </div>
</div>
<?php endif; ?>
<?php
    $introcount = (count($this->intro_items));
    $counter = 0;
?>
<?php if (!empty($this->intro_items)) : ?>
<div class="data-control-id-1453381 bd-grid-14 bd-page-width  bd-margins">
  <div class="container-fluid">
    <div class="separated-grid row">
    <?php
        $introItemClass = $itemClass;
        if ('' === $mergedModes) {
            $str = str_replace('col-xs-1', 'col-xs-12', $str);
            $introItemClass = $introItemClass . preg_replace('/col-(lg|md|sm)-\d+/', 'col-$1-' . round(12 / min(12, max(1, $this->columns))), $str);
        }
    ?>
    <?php foreach ($introArticles as $key => &$item) : ?>
    <?php
        $rowcount = ((int) $key % (int) $this->columns) + 1;
        $row = $counter / $this->columns ;
    ?>
    <?php $counter++; ?>
    <div class="<?php echo $introItemClass; ?>" itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting">
        <div class="bd-griditem-5">
    <?php
        $this->item = &$item;
        echo $this->loadTemplate('item');
    ?>
        </div>
    </div>
    <?php endforeach; ?>
        </div>
    </div>
</div>
<?php endif; ?>

<?php if (!empty($this->link_items)) : ?>
    <div class="items-more">
        <?php echo $this->loadTemplate('links'); ?>
    </div>
<?php endif; ?>

<?php  if (!empty($this->children[$this->category->id])&& $this->maxLevel != 0) : ?>
    <div class="cat-children">
    <?php
        echo renderTemplateFromIncludes('article_8', array(array('header-text' => JTEXT::_('JGLOBAL_SUBCATEGORIES'),
            'content' => $this->loadTemplate('children'))));
    ?>
    </div>
<?php endif; ?>
<?php if (count($pagination_list) > 0) : ?>
    <div class="data-control-id-1453419 bd-blogpagination-7">
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
$view = new DesignerContent($this, $this->params);

$leadArticles = $this->lead_items;
$countLeadArticles = count($this->lead_items);
$introArticles = $this->intro_items;
$countIntroArticles = count($this->intro_items);

$sampleItems = sampleArticlesForPreview($componentCurrentTemplate);
$countSampleItems = count($sampleItems);

$startNav = (int)JRequest::getVar('start');
if ($startNav != 0 && isset($sampleItems[$startNav])) {
    $sampleItems = array_slice($sampleItems, $startNav);
}

if ($countSampleItems > 0) {
    $this->lead_items = null;

    /*foreach($leadArticles as $i => $item) {
        $sampleItems[] = $item;
    }
    $leadArticles = array_slice($sampleItems, 0, $countLeadArticles);

    $sampleItems = array_slice($sampleItems, $countLeadArticles);*/

    foreach($introArticles as $i => $item) {
        $sampleItems[] = $item;
    }

    $introArticles = array_slice($sampleItems, 0, ($countIntroArticles > $countSampleItems ? $countIntroArticles : $countSampleItems));
}


$this->articleTemplate = 'article_5';

ob_start();
?>

<div class="data-control-id-1522 bd-blog-7 <?php echo $this->pageclass_sfx; ?>" itemscope itemtype="http://schema.org/Blog" /**/style="display:none"/**/ >
    <div class="bd-container-inner">
<?php

$categoryTitle = '';
if ($this->params->get('show_category_title', 1) || strlen($this->params->get('page_subheading'))) {
    $categoryTitle = $this->escape($this->params->get('page_subheading'));
    if ($this->params->get('show_category_title') && strlen($this->category->title))
        $categoryTitle .= ' ' . $this->category->title;
}

$categoryInfo = '';
if ($this->params->def('show_description', 1) || $this->params->def('show_description_image', 1)) {
    if ($this->params->get('show_description_image') && $this->category->getParams()->get('image'))
        $categoryInfo .= ' <img src="' . $this->category->getParams()->get('image') . '" alt="" />';
    if ($this->params->get('show_description') && $this->category->description)
        $categoryInfo .= ' ' .JHtml::_('content.prepare', $this->category->description, '', 'com_content.category');
}

$pagination_list = array();
if (($this->params->def('show_pagination', 1) == 1 || $this->params->get('show_pagination') == 2)
    && $this->pagination->get('pages.total') > 1)
{
    $GLOBALS['theme_settings']['active_paginator'] = 'specific';
    $pagination_list = $this->pagination->getPagesLinks();
}

$pageHeading = $view->pageHeading;
?>

<?php if ($pageHeading) : ?>
    <h1 class="data-control-id-1400 bd-container-24 bd-tagstyles bd-bootstrap-img bd-img-responsive bd-bootstrap-tables bd-table-striped bd-table-bordered bd-table-hover bd-table-condensed bd-table-responsive"><?php echo $pageHeading; ?></h1>
<?php endif; ?>


<?php if ($categoryTitle) : ?>
    <h2 class="data-control-id-1295866 bd-container-58 bd-tagstyles bd-bootstrap-img bd-img-responsive bd-bootstrap-tables bd-table-striped bd-table-bordered bd-table-hover bd-table-condensed bd-table-responsive">
    <?php echo $categoryTitle; ?>
</h2>
<?php endif; ?>


<?php if ($categoryInfo) : ?>
    <div class="data-control-id-1295878 bd-container-60 bd-tagstyles bd-bootstrap-img bd-img-responsive bd-bootstrap-tables bd-table-striped bd-table-bordered bd-table-hover bd-table-condensed bd-table-responsive">
    <?php echo $categoryInfo; ?>
</div>
<?php endif; ?>


 <?php
    $itemClass = 'separated-item-12 col-md-12 ';
    $mergedModes = '' . '1' . '' . '';
    $str = 'col-lg-1 col-md-1 col-sm-1 col-xs-1';
?>
<?php $leadingcount=0 ; ?>
<?php if (!empty($this->lead_items)) : ?>
<div class="data-control-id-1368 bd-grid-8 bd-margins">
  <div class="container-fluid">
    <div class="separated-grid row">
    <?php
        $leadingItemClass = preg_replace('/col-(lg|md|sm|xs)-\d+/', 'col-$1-' . 12, $str);
    ?>
    <?php foreach ($leadArticles as &$item) : ?>
        <div class="<?php echo $leadingItemClass; ?>" itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting">
            <div class="bd-griditem-12">
            <?php
                $this->item = &$item;
                echo $this->loadTemplate('item');
            ?>
            </div>
        </div>
        <?php $leadingcount++; ?>
    <?php endforeach; ?>
        </div>
   </div>
</div>
<?php endif; ?>
<?php
    $introcount = (count($this->intro_items));
    $counter = 0;
?>
<?php if (!empty($this->intro_items)) : ?>
<div class="data-control-id-1368 bd-grid-8 bd-margins">
  <div class="container-fluid">
    <div class="separated-grid row">
    <?php
        $introItemClass = $itemClass;
        if ('' === $mergedModes) {
            $str = str_replace('col-xs-1', 'col-xs-12', $str);
            $introItemClass = $introItemClass . preg_replace('/col-(lg|md|sm)-\d+/', 'col-$1-' . round(12 / min(12, max(1, $this->columns))), $str);
        }
    ?>
    <?php foreach ($introArticles as $key => &$item) : ?>
    <?php
        $rowcount = ((int) $key % (int) $this->columns) + 1;
        $row = $counter / $this->columns ;
    ?>
    <?php $counter++; ?>
    <div class="<?php echo $introItemClass; ?>" itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting">
        <div class="bd-griditem-12">
    <?php
        $this->item = &$item;
        echo $this->loadTemplate('item');
    ?>
        </div>
    </div>
    <?php endforeach; ?>
        </div>
    </div>
</div>
<?php endif; ?>

<?php if (!empty($this->link_items)) : ?>
    <div class="items-more">
        <?php echo $this->loadTemplate('links'); ?>
    </div>
<?php endif; ?>

<?php  if (!empty($this->children[$this->category->id])&& $this->maxLevel != 0) : ?>
    <div class="cat-children">
    <?php
        echo renderTemplateFromIncludes('article_5', array(array('header-text' => JTEXT::_('JGLOBAL_SUBCATEGORIES'),
            'content' => $this->loadTemplate('children'))));
    ?>
    </div>
<?php endif; ?>
<?php if (count($pagination_list) > 0) : ?>
    <div class="data-control-id-1406 bd-blogpagination-4">
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
$view = new DesignerContent($this, $this->params);

$leadArticles = $this->lead_items;
$countLeadArticles = count($this->lead_items);
$introArticles = $this->intro_items;
$countIntroArticles = count($this->intro_items);

$sampleItems = sampleArticlesForPreview($componentCurrentTemplate);
$countSampleItems = count($sampleItems);

$startNav = (int)JRequest::getVar('start');
if ($startNav != 0 && isset($sampleItems[$startNav])) {
    $sampleItems = array_slice($sampleItems, $startNav);
}

if ($countSampleItems > 0) {
    $this->lead_items = null;

    /*foreach($leadArticles as $i => $item) {
        $sampleItems[] = $item;
    }
    $leadArticles = array_slice($sampleItems, 0, $countLeadArticles);

    $sampleItems = array_slice($sampleItems, $countLeadArticles);*/

    foreach($introArticles as $i => $item) {
        $sampleItems[] = $item;
    }

    $introArticles = array_slice($sampleItems, 0, ($countIntroArticles > $countSampleItems ? $countIntroArticles : $countSampleItems));
}


$this->articleTemplate = 'article_6';

ob_start();
?>

<div class="data-control-id-1773 bd-blog-8 <?php echo $this->pageclass_sfx; ?>" itemscope itemtype="http://schema.org/Blog" /**/style="display:none"/**/ >
    <div class="bd-container-inner">
<?php

$categoryTitle = '';
if ($this->params->get('show_category_title', 1) || strlen($this->params->get('page_subheading'))) {
    $categoryTitle = $this->escape($this->params->get('page_subheading'));
    if ($this->params->get('show_category_title') && strlen($this->category->title))
        $categoryTitle .= ' ' . $this->category->title;
}

$categoryInfo = '';
if ($this->params->def('show_description', 1) || $this->params->def('show_description_image', 1)) {
    if ($this->params->get('show_description_image') && $this->category->getParams()->get('image'))
        $categoryInfo .= ' <img src="' . $this->category->getParams()->get('image') . '" alt="" />';
    if ($this->params->get('show_description') && $this->category->description)
        $categoryInfo .= ' ' .JHtml::_('content.prepare', $this->category->description, '', 'com_content.category');
}

$pagination_list = array();
if (($this->params->def('show_pagination', 1) == 1 || $this->params->get('show_pagination') == 2)
    && $this->pagination->get('pages.total') > 1)
{
    $GLOBALS['theme_settings']['active_paginator'] = 'specific';
    $pagination_list = $this->pagination->getPagesLinks();
}

$pageHeading = $view->pageHeading;
?>

<?php if ($pageHeading) : ?>
    <h1 class="data-control-id-1651 bd-container-27 bd-tagstyles bd-bootstrap-img bd-img-responsive bd-bootstrap-tables bd-table-striped bd-table-bordered bd-table-hover bd-table-condensed bd-table-responsive"><?php echo $pageHeading; ?></h1>
<?php endif; ?>


<?php if ($categoryTitle) : ?>
    <h2 class="data-control-id-1296022 bd-container-68 bd-tagstyles bd-bootstrap-img bd-img-responsive bd-bootstrap-tables bd-table-striped bd-table-bordered bd-table-hover bd-table-condensed bd-table-responsive">
    <?php echo $categoryTitle; ?>
</h2>
<?php endif; ?>


<?php if ($categoryInfo) : ?>
    <div class="data-control-id-1296034 bd-container-73 bd-tagstyles bd-bootstrap-img bd-img-responsive bd-bootstrap-tables bd-table-striped bd-table-bordered bd-table-hover bd-table-condensed bd-table-responsive">
    <?php echo $categoryInfo; ?>
</div>
<?php endif; ?>


 <?php
    $itemClass = 'separated-item-23 col-md-12 ';
    $mergedModes = '' . '1' . '' . '';
    $str = 'col-lg-1 col-md-1 col-sm-1 col-xs-1';
?>
<?php $leadingcount=0 ; ?>
<?php if (!empty($this->lead_items)) : ?>
<div class="data-control-id-1619 bd-grid-9 bd-margins">
  <div class="container-fluid">
    <div class="separated-grid row">
    <?php
        $leadingItemClass = preg_replace('/col-(lg|md|sm|xs)-\d+/', 'col-$1-' . 12, $str);
    ?>
    <?php foreach ($leadArticles as &$item) : ?>
        <div class="<?php echo $leadingItemClass; ?>" itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting">
            <div class="bd-griditem-23">
            <?php
                $this->item = &$item;
                echo $this->loadTemplate('item');
            ?>
            </div>
        </div>
        <?php $leadingcount++; ?>
    <?php endforeach; ?>
        </div>
   </div>
</div>
<?php endif; ?>
<?php
    $introcount = (count($this->intro_items));
    $counter = 0;
?>
<?php if (!empty($this->intro_items)) : ?>
<div class="data-control-id-1619 bd-grid-9 bd-margins">
  <div class="container-fluid">
    <div class="separated-grid row">
    <?php
        $introItemClass = $itemClass;
        if ('' === $mergedModes) {
            $str = str_replace('col-xs-1', 'col-xs-12', $str);
            $introItemClass = $introItemClass . preg_replace('/col-(lg|md|sm)-\d+/', 'col-$1-' . round(12 / min(12, max(1, $this->columns))), $str);
        }
    ?>
    <?php foreach ($introArticles as $key => &$item) : ?>
    <?php
        $rowcount = ((int) $key % (int) $this->columns) + 1;
        $row = $counter / $this->columns ;
    ?>
    <?php $counter++; ?>
    <div class="<?php echo $introItemClass; ?>" itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting">
        <div class="bd-griditem-23">
    <?php
        $this->item = &$item;
        echo $this->loadTemplate('item');
    ?>
        </div>
    </div>
    <?php endforeach; ?>
        </div>
    </div>
</div>
<?php endif; ?>

<?php if (!empty($this->link_items)) : ?>
    <div class="items-more">
        <?php echo $this->loadTemplate('links'); ?>
    </div>
<?php endif; ?>

<?php  if (!empty($this->children[$this->category->id])&& $this->maxLevel != 0) : ?>
    <div class="cat-children">
    <?php
        echo renderTemplateFromIncludes('article_6', array(array('header-text' => JTEXT::_('JGLOBAL_SUBCATEGORIES'),
            'content' => $this->loadTemplate('children'))));
    ?>
    </div>
<?php endif; ?>
<?php if (count($pagination_list) > 0) : ?>
    <div class="data-control-id-1657 bd-blogpagination-5">
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