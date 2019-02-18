<?php
defined('_JEXEC') or die;
?>

<!--COMPONENT common -->

<?php
$view = new DesignerContent($this, $this->params);

$pageHeading = $view->pageHeading;
$this->articleTemplate = 'article_2';

ob_start();
?>

<div class=" bd-blog bd-page-width  <?php echo $this->pageclass_sfx; ?>" itemscope itemtype="http://schema.org/Blog"  >
    <div class="bd-container-inner">

<?php
$pagination_list = array();
if ($this->params->def('show_pagination', 2) == 1
    || ($this->params->get('show_pagination') == 2
        && $this->pagination->get('pages.total') > 1))
{
    $GLOBALS['theme_settings']['active_paginator'] = 'specific';
    $pagination_list = $this->pagination->getPagesLinks();
}
?>
<?php $str = 'col-lg-1 col-md-1 col-sm-1 col-xs-1'; ?>

<?php $leadingcount = 0; ?>
<?php if (!empty($this->lead_items)) : ?>
    <div class=" bd-grid-5 bd-margins">
      <div class="container-fluid">
        <div class="separated-grid row">
        <?php
            $leadingItemClass = preg_replace('/col-(lg|md|sm|xs)-\d+/', 'col-$1-' . 12, $str);
        ?>
        <?php foreach ($this->lead_items as $item) : ?>
            <div class="<?php echo $leadingItemClass; ?>" itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting">
                <div class="bd-griditem-30">
                <?php
                    $this->item = $item;
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
$introcount = count($this->intro_items);
$counter = 0;
?>
<?php if (!empty($this->intro_items)) : ?>
    <div class=" bd-grid-5 bd-margins">
      <div class="container-fluid">
        <div class="separated-grid row">
    <?php foreach ($this->intro_items as $key => $item) : ?>
        <?php
            $key = ($key - $leadingcount) + 1;
            $rowcount = (((int)$key - 1) % (int)$this->columns) + 1;
            $row = $counter / $this->columns;
            $counter++;
        ?>
        <?php
            
            $itemClass = 'separated-item-30 col-md-12 ';
            $mergedModes = '' . '1' . '' . '';
            if ('' === $mergedModes) {
                $str = str_replace('col-xs-1', 'col-xs-12', $str);
                $itemClass = $itemClass . preg_replace('/col-(lg|md|sm)-\d+/', 'col-$1-' . round(12 / min(12, max(1, $this->columns))), $str);
            }
        ?>
        <div class="<?php echo $itemClass; ?>" itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting">
            <div class="bd-griditem-30">
        <?php
            $this->item = $item;
            echo $this->loadTemplate('item');
        ?>
            </div>
        </div>
    <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php endif; ?>
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
$view = new DesignerContent($this, $this->params);

$pageHeading = $view->pageHeading;
$this->articleTemplate = 'article_10';

ob_start();
?>

<div class=" bd-blog-9 bd-page-width  <?php echo $this->pageclass_sfx; ?>" itemscope itemtype="http://schema.org/Blog" /**/style="display:none"/**/ >
    <div class="bd-container-inner">

<?php
$pagination_list = array();
if ($this->params->def('show_pagination', 2) == 1
    || ($this->params->get('show_pagination') == 2
        && $this->pagination->get('pages.total') > 1))
{
    $GLOBALS['theme_settings']['active_paginator'] = 'specific';
    $pagination_list = $this->pagination->getPagesLinks();
}
?>
<?php $str = 'col-lg-1 col-md-1 col-sm-1 col-xs-1'; ?>

<?php $leadingcount = 0; ?>
<?php if (!empty($this->lead_items)) : ?>
    <div class=" bd-grid-18 bd-margins">
      <div class="container-fluid">
        <div class="separated-grid row">
        <?php
            $leadingItemClass = preg_replace('/col-(lg|md|sm|xs)-\d+/', 'col-$1-' . 12, $str);
        ?>
        <?php foreach ($this->lead_items as $item) : ?>
            <div class="<?php echo $leadingItemClass; ?>" itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting">
                <div class="bd-griditem-4">
                <?php
                    $this->item = $item;
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
$introcount = count($this->intro_items);
$counter = 0;
?>
<?php if (!empty($this->intro_items)) : ?>
    <div class=" bd-grid-18 bd-margins">
      <div class="container-fluid">
        <div class="separated-grid row">
    <?php foreach ($this->intro_items as $key => $item) : ?>
        <?php
            $key = ($key - $leadingcount) + 1;
            $rowcount = (((int)$key - 1) % (int)$this->columns) + 1;
            $row = $counter / $this->columns;
            $counter++;
        ?>
        <?php
            
            $itemClass = 'separated-item-4 col-md-6 ';
            $mergedModes = '' . '2' . '' . '';
            if ('' === $mergedModes) {
                $str = str_replace('col-xs-1', 'col-xs-12', $str);
                $itemClass = $itemClass . preg_replace('/col-(lg|md|sm)-\d+/', 'col-$1-' . round(12 / min(12, max(1, $this->columns))), $str);
            }
        ?>
        <div class="<?php echo $itemClass; ?>" itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting">
            <div class="bd-griditem-4">
        <?php
            $this->item = $item;
            echo $this->loadTemplate('item');
        ?>
            </div>
        </div>
    <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php endif; ?>
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
$view = new DesignerContent($this, $this->params);

$pageHeading = $view->pageHeading;
$this->articleTemplate = 'article_4';

ob_start();
?>

<div class=" bd-blog-5 bd-page-width  <?php echo $this->pageclass_sfx; ?>" itemscope itemtype="http://schema.org/Blog" /**/style="display:none"/**/ >
    <div class="bd-container-inner">

    <?php if ($pageHeading) : ?>
        <h1 class=" bd-container-21 bd-tagstyles bd-bootstrap-img bd-img-responsive bd-bootstrap-tables bd-table-striped bd-table-bordered bd-table-hover bd-table-condensed bd-table-responsive"><?php echo $pageHeading; ?></h1>
    <?php endif; ?>
<?php
$pagination_list = array();
if ($this->params->def('show_pagination', 2) == 1
    || ($this->params->get('show_pagination') == 2
        && $this->pagination->get('pages.total') > 1))
{
    $GLOBALS['theme_settings']['active_paginator'] = 'specific';
    $pagination_list = $this->pagination->getPagesLinks();
}
?>
<?php $str = 'col-lg-1 col-md-1 col-sm-1 col-xs-1'; ?>

<?php $leadingcount = 0; ?>
<?php if (!empty($this->lead_items)) : ?>
    <div class=" bd-grid-7 bd-margins">
      <div class="container-fluid">
        <div class="separated-grid row">
        <?php
            $leadingItemClass = preg_replace('/col-(lg|md|sm|xs)-\d+/', 'col-$1-' . 12, $str);
        ?>
        <?php foreach ($this->lead_items as $item) : ?>
            <div class="<?php echo $leadingItemClass; ?>" itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting">
                <div class="bd-griditem-46">
                <?php
                    $this->item = $item;
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
$introcount = count($this->intro_items);
$counter = 0;
?>
<?php if (!empty($this->intro_items)) : ?>
    <div class=" bd-grid-7 bd-margins">
      <div class="container-fluid">
        <div class="separated-grid row">
    <?php foreach ($this->intro_items as $key => $item) : ?>
        <?php
            $key = ($key - $leadingcount) + 1;
            $rowcount = (((int)$key - 1) % (int)$this->columns) + 1;
            $row = $counter / $this->columns;
            $counter++;
        ?>
        <?php
            
            $itemClass = 'separated-item-46 col-md-12 ';
            $mergedModes = '' . '1' . '' . '';
            if ('' === $mergedModes) {
                $str = str_replace('col-xs-1', 'col-xs-12', $str);
                $itemClass = $itemClass . preg_replace('/col-(lg|md|sm)-\d+/', 'col-$1-' . round(12 / min(12, max(1, $this->columns))), $str);
            }
        ?>
        <div class="<?php echo $itemClass; ?>" itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting">
            <div class="bd-griditem-46">
        <?php
            $this->item = $item;
            echo $this->loadTemplate('item');
        ?>
            </div>
        </div>
    <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php endif; ?>
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
$view = new DesignerContent($this, $this->params);

$pageHeading = $view->pageHeading;
$this->articleTemplate = 'article_3';

ob_start();
?>

<div class=" bd-blog-3 bd-page-width  <?php echo $this->pageclass_sfx; ?>" itemscope itemtype="http://schema.org/Blog" /**/style="display:none"/**/ >
    <div class="bd-container-inner">

    <?php if ($pageHeading) : ?>
        <h1 class=" bd-container-18 bd-tagstyles bd-bootstrap-img bd-img-responsive bd-bootstrap-tables bd-table-striped bd-table-bordered bd-table-hover bd-table-condensed bd-table-responsive"><?php echo $pageHeading; ?></h1>
    <?php endif; ?>
<?php
$pagination_list = array();
if ($this->params->def('show_pagination', 2) == 1
    || ($this->params->get('show_pagination') == 2
        && $this->pagination->get('pages.total') > 1))
{
    $GLOBALS['theme_settings']['active_paginator'] = 'specific';
    $pagination_list = $this->pagination->getPagesLinks();
}
?>
<?php $str = 'col-lg-1 col-md-1 col-sm-1 col-xs-1'; ?>

<?php $leadingcount = 0; ?>
<?php if (!empty($this->lead_items)) : ?>
    <div class=" bd-grid-6 bd-margins">
      <div class="container-fluid">
        <div class="separated-grid row">
        <?php
            $leadingItemClass = preg_replace('/col-(lg|md|sm|xs)-\d+/', 'col-$1-' . 12, $str);
        ?>
        <?php foreach ($this->lead_items as $item) : ?>
            <div class="<?php echo $leadingItemClass; ?>" itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting">
                <div class="bd-griditem-38">
                <?php
                    $this->item = $item;
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
$introcount = count($this->intro_items);
$counter = 0;
?>
<?php if (!empty($this->intro_items)) : ?>
    <div class=" bd-grid-6 bd-margins">
      <div class="container-fluid">
        <div class="separated-grid row">
    <?php foreach ($this->intro_items as $key => $item) : ?>
        <?php
            $key = ($key - $leadingcount) + 1;
            $rowcount = (((int)$key - 1) % (int)$this->columns) + 1;
            $row = $counter / $this->columns;
            $counter++;
        ?>
        <?php
            
            $itemClass = 'separated-item-38 col-md-12 ';
            $mergedModes = '' . '1' . '' . '';
            if ('' === $mergedModes) {
                $str = str_replace('col-xs-1', 'col-xs-12', $str);
                $itemClass = $itemClass . preg_replace('/col-(lg|md|sm)-\d+/', 'col-$1-' . round(12 / min(12, max(1, $this->columns))), $str);
            }
        ?>
        <div class="<?php echo $itemClass; ?>" itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting">
            <div class="bd-griditem-38">
        <?php
            $this->item = $item;
            echo $this->loadTemplate('item');
        ?>
            </div>
        </div>
    <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php endif; ?>
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
$view = new DesignerContent($this, $this->params);

$pageHeading = $view->pageHeading;
$this->articleTemplate = 'article_11';

ob_start();
?>

<div class=" bd-blog-10 bd-page-width  bd-no-margins <?php echo $this->pageclass_sfx; ?>" itemscope itemtype="http://schema.org/Blog" /**/style="display:none"/**/ >
    <div class="bd-container-inner">

<?php
$pagination_list = array();
if ($this->params->def('show_pagination', 2) == 1
    || ($this->params->get('show_pagination') == 2
        && $this->pagination->get('pages.total') > 1))
{
    $GLOBALS['theme_settings']['active_paginator'] = 'specific';
    $pagination_list = $this->pagination->getPagesLinks();
}
?>
<?php $str = 'col-lg-1 col-md-1 col-sm-1 col-xs-1'; ?>

<?php $leadingcount = 0; ?>
<?php if (!empty($this->lead_items)) : ?>
    <div class=" bd-grid-21 bd-margins">
      <div class="container-fluid">
        <div class="separated-grid row">
        <?php
            $leadingItemClass = preg_replace('/col-(lg|md|sm|xs)-\d+/', 'col-$1-' . 12, $str);
        ?>
        <?php foreach ($this->lead_items as $item) : ?>
            <div class="<?php echo $leadingItemClass; ?>" itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting">
                <div class="bd-griditem-15">
                <?php
                    $this->item = $item;
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
$introcount = count($this->intro_items);
$counter = 0;
?>
<?php if (!empty($this->intro_items)) : ?>
    <div class=" bd-grid-21 bd-margins">
      <div class="container-fluid">
        <div class="separated-grid row">
    <?php foreach ($this->intro_items as $key => $item) : ?>
        <?php
            $key = ($key - $leadingcount) + 1;
            $rowcount = (((int)$key - 1) % (int)$this->columns) + 1;
            $row = $counter / $this->columns;
            $counter++;
        ?>
        <?php
            
            $itemClass = 'separated-item-15 col-md-6 ';
            $mergedModes = '' . '2' . '' . '';
            if ('' === $mergedModes) {
                $str = str_replace('col-xs-1', 'col-xs-12', $str);
                $itemClass = $itemClass . preg_replace('/col-(lg|md|sm)-\d+/', 'col-$1-' . round(12 / min(12, max(1, $this->columns))), $str);
            }
        ?>
        <div class="<?php echo $itemClass; ?>" itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting">
            <div class="bd-griditem-15">
        <?php
            $this->item = $item;
            echo $this->loadTemplate('item');
        ?>
            </div>
        </div>
    <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php endif; ?>
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
$view = new DesignerContent($this, $this->params);

$pageHeading = $view->pageHeading;
$this->articleTemplate = 'article_7';

ob_start();
?>

<div class=" bd-blog-2 bd-page-width  <?php echo $this->pageclass_sfx; ?>" itemscope itemtype="http://schema.org/Blog" /**/style="display:none"/**/ >
    <div class="bd-container-inner">

    <?php if ($pageHeading) : ?>
        <h1 class=" bd-container-4 bd-tagstyles bd-bootstrap-img bd-img-responsive bd-bootstrap-tables bd-table-striped bd-table-bordered bd-table-hover bd-table-condensed bd-table-responsive"><?php echo $pageHeading; ?></h1>
    <?php endif; ?>
<?php
$pagination_list = array();
if ($this->params->def('show_pagination', 2) == 1
    || ($this->params->get('show_pagination') == 2
        && $this->pagination->get('pages.total') > 1))
{
    $GLOBALS['theme_settings']['active_paginator'] = 'specific';
    $pagination_list = $this->pagination->getPagesLinks();
}
?>
<?php $str = 'col-lg-1 col-md-1 col-sm-1 col-xs-1'; ?>

<?php $leadingcount = 0; ?>
<?php if (!empty($this->lead_items)) : ?>
    <div class=" bd-grid-1 bd-margins">
      <div class="container-fluid">
        <div class="separated-grid row">
        <?php
            $leadingItemClass = preg_replace('/col-(lg|md|sm|xs)-\d+/', 'col-$1-' . 12, $str);
        ?>
        <?php foreach ($this->lead_items as $item) : ?>
            <div class="<?php echo $leadingItemClass; ?>" itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting">
                <div class="bd-griditem-7">
                <?php
                    $this->item = $item;
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
$introcount = count($this->intro_items);
$counter = 0;
?>
<?php if (!empty($this->intro_items)) : ?>
    <div class=" bd-grid-1 bd-margins">
      <div class="container-fluid">
        <div class="separated-grid row">
    <?php foreach ($this->intro_items as $key => $item) : ?>
        <?php
            $key = ($key - $leadingcount) + 1;
            $rowcount = (((int)$key - 1) % (int)$this->columns) + 1;
            $row = $counter / $this->columns;
            $counter++;
        ?>
        <?php
            
            $itemClass = 'separated-item-7 col-md-12 ';
            $mergedModes = '' . '1' . '' . '';
            if ('' === $mergedModes) {
                $str = str_replace('col-xs-1', 'col-xs-12', $str);
                $itemClass = $itemClass . preg_replace('/col-(lg|md|sm)-\d+/', 'col-$1-' . round(12 / min(12, max(1, $this->columns))), $str);
            }
        ?>
        <div class="<?php echo $itemClass; ?>" itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting">
            <div class="bd-griditem-7">
        <?php
            $this->item = $item;
            echo $this->loadTemplate('item');
        ?>
            </div>
        </div>
    <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php endif; ?>
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
$view = new DesignerContent($this, $this->params);

$pageHeading = $view->pageHeading;
$this->articleTemplate = 'article_8';

ob_start();
?>

<div class=" bd-blog-4 bd-page-width  <?php echo $this->pageclass_sfx; ?>" itemscope itemtype="http://schema.org/Blog" /**/style="display:none"/**/ >
    <div class="bd-container-inner">

<?php
$pagination_list = array();
if ($this->params->def('show_pagination', 2) == 1
    || ($this->params->get('show_pagination') == 2
        && $this->pagination->get('pages.total') > 1))
{
    $GLOBALS['theme_settings']['active_paginator'] = 'specific';
    $pagination_list = $this->pagination->getPagesLinks();
}
?>
<?php $str = 'col-lg-1 col-md-1 col-sm-1 col-xs-1'; ?>

<?php $leadingcount = 0; ?>
<?php if (!empty($this->lead_items)) : ?>
    <div class=" bd-grid-14 bd-page-width  bd-margins">
      <div class="container-fluid">
        <div class="separated-grid row">
        <?php
            $leadingItemClass = preg_replace('/col-(lg|md|sm|xs)-\d+/', 'col-$1-' . 12, $str);
        ?>
        <?php foreach ($this->lead_items as $item) : ?>
            <div class="<?php echo $leadingItemClass; ?>" itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting">
                <div class="bd-griditem-5">
                <?php
                    $this->item = $item;
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
$introcount = count($this->intro_items);
$counter = 0;
?>
<?php if (!empty($this->intro_items)) : ?>
    <div class=" bd-grid-14 bd-page-width  bd-margins">
      <div class="container-fluid">
        <div class="separated-grid row">
    <?php foreach ($this->intro_items as $key => $item) : ?>
        <?php
            $key = ($key - $leadingcount) + 1;
            $rowcount = (((int)$key - 1) % (int)$this->columns) + 1;
            $row = $counter / $this->columns;
            $counter++;
        ?>
        <?php
            
            $itemClass = 'separated-item-5 col-md-6 ';
            $mergedModes = '' . '2' . '' . '';
            if ('' === $mergedModes) {
                $str = str_replace('col-xs-1', 'col-xs-12', $str);
                $itemClass = $itemClass . preg_replace('/col-(lg|md|sm)-\d+/', 'col-$1-' . round(12 / min(12, max(1, $this->columns))), $str);
            }
        ?>
        <div class="<?php echo $itemClass; ?>" itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting">
            <div class="bd-griditem-5">
        <?php
            $this->item = $item;
            echo $this->loadTemplate('item');
        ?>
            </div>
        </div>
    <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php endif; ?>
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
$view = new DesignerContent($this, $this->params);

$pageHeading = $view->pageHeading;
$this->articleTemplate = 'article_5';

ob_start();
?>

<div class=" bd-blog-7 <?php echo $this->pageclass_sfx; ?>" itemscope itemtype="http://schema.org/Blog" /**/style="display:none"/**/ >
    <div class="bd-container-inner">

    <?php if ($pageHeading) : ?>
        <h1 class=" bd-container-24 bd-tagstyles bd-bootstrap-img bd-img-responsive bd-bootstrap-tables bd-table-striped bd-table-bordered bd-table-hover bd-table-condensed bd-table-responsive"><?php echo $pageHeading; ?></h1>
    <?php endif; ?>
<?php
$pagination_list = array();
if ($this->params->def('show_pagination', 2) == 1
    || ($this->params->get('show_pagination') == 2
        && $this->pagination->get('pages.total') > 1))
{
    $GLOBALS['theme_settings']['active_paginator'] = 'specific';
    $pagination_list = $this->pagination->getPagesLinks();
}
?>
<?php $str = 'col-lg-1 col-md-1 col-sm-1 col-xs-1'; ?>

<?php $leadingcount = 0; ?>
<?php if (!empty($this->lead_items)) : ?>
    <div class=" bd-grid-8 bd-margins">
      <div class="container-fluid">
        <div class="separated-grid row">
        <?php
            $leadingItemClass = preg_replace('/col-(lg|md|sm|xs)-\d+/', 'col-$1-' . 12, $str);
        ?>
        <?php foreach ($this->lead_items as $item) : ?>
            <div class="<?php echo $leadingItemClass; ?>" itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting">
                <div class="bd-griditem-12">
                <?php
                    $this->item = $item;
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
$introcount = count($this->intro_items);
$counter = 0;
?>
<?php if (!empty($this->intro_items)) : ?>
    <div class=" bd-grid-8 bd-margins">
      <div class="container-fluid">
        <div class="separated-grid row">
    <?php foreach ($this->intro_items as $key => $item) : ?>
        <?php
            $key = ($key - $leadingcount) + 1;
            $rowcount = (((int)$key - 1) % (int)$this->columns) + 1;
            $row = $counter / $this->columns;
            $counter++;
        ?>
        <?php
            
            $itemClass = 'separated-item-12 col-md-12 ';
            $mergedModes = '' . '1' . '' . '';
            if ('' === $mergedModes) {
                $str = str_replace('col-xs-1', 'col-xs-12', $str);
                $itemClass = $itemClass . preg_replace('/col-(lg|md|sm)-\d+/', 'col-$1-' . round(12 / min(12, max(1, $this->columns))), $str);
            }
        ?>
        <div class="<?php echo $itemClass; ?>" itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting">
            <div class="bd-griditem-12">
        <?php
            $this->item = $item;
            echo $this->loadTemplate('item');
        ?>
            </div>
        </div>
    <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php endif; ?>
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
$view = new DesignerContent($this, $this->params);

$pageHeading = $view->pageHeading;
$this->articleTemplate = 'article_6';

ob_start();
?>

<div class=" bd-blog-8 <?php echo $this->pageclass_sfx; ?>" itemscope itemtype="http://schema.org/Blog" /**/style="display:none"/**/ >
    <div class="bd-container-inner">

    <?php if ($pageHeading) : ?>
        <h1 class=" bd-container-27 bd-tagstyles bd-bootstrap-img bd-img-responsive bd-bootstrap-tables bd-table-striped bd-table-bordered bd-table-hover bd-table-condensed bd-table-responsive"><?php echo $pageHeading; ?></h1>
    <?php endif; ?>
<?php
$pagination_list = array();
if ($this->params->def('show_pagination', 2) == 1
    || ($this->params->get('show_pagination') == 2
        && $this->pagination->get('pages.total') > 1))
{
    $GLOBALS['theme_settings']['active_paginator'] = 'specific';
    $pagination_list = $this->pagination->getPagesLinks();
}
?>
<?php $str = 'col-lg-1 col-md-1 col-sm-1 col-xs-1'; ?>

<?php $leadingcount = 0; ?>
<?php if (!empty($this->lead_items)) : ?>
    <div class=" bd-grid-9 bd-margins">
      <div class="container-fluid">
        <div class="separated-grid row">
        <?php
            $leadingItemClass = preg_replace('/col-(lg|md|sm|xs)-\d+/', 'col-$1-' . 12, $str);
        ?>
        <?php foreach ($this->lead_items as $item) : ?>
            <div class="<?php echo $leadingItemClass; ?>" itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting">
                <div class="bd-griditem-23">
                <?php
                    $this->item = $item;
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
$introcount = count($this->intro_items);
$counter = 0;
?>
<?php if (!empty($this->intro_items)) : ?>
    <div class=" bd-grid-9 bd-margins">
      <div class="container-fluid">
        <div class="separated-grid row">
    <?php foreach ($this->intro_items as $key => $item) : ?>
        <?php
            $key = ($key - $leadingcount) + 1;
            $rowcount = (((int)$key - 1) % (int)$this->columns) + 1;
            $row = $counter / $this->columns;
            $counter++;
        ?>
        <?php
            
            $itemClass = 'separated-item-23 col-md-12 ';
            $mergedModes = '' . '1' . '' . '';
            if ('' === $mergedModes) {
                $str = str_replace('col-xs-1', 'col-xs-12', $str);
                $itemClass = $itemClass . preg_replace('/col-(lg|md|sm)-\d+/', 'col-$1-' . round(12 / min(12, max(1, $this->columns))), $str);
            }
        ?>
        <div class="<?php echo $itemClass; ?>" itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting">
            <div class="bd-griditem-23">
        <?php
            $this->item = $item;
            echo $this->loadTemplate('item');
        ?>
            </div>
        </div>
    <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php endif; ?>
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