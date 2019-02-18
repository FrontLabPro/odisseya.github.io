<?php
defined('_JEXEC') or die;
?>
<?php
$params = array();
if ($GLOBALS['theme_settings']['is_preview']) {
    $params['post_id_class'] = $article->id;
    if($this->item->params->get('show_intro', 1) == '1' || $this->item->fulltext == '') {
        $params['postcontent_editor_id'] = 'article-' . $this->item->id;
        $params['article_id'] = 'article-' . $this->item->id;
    }
}
?>

<!--COMPONENT common -->
<?php ob_start(); ?>

<div class="data-control-id-3035 bd-blog bd-page-width  <?php echo $this->pageclass_sfx; ?>" itemscope itemtype="http://schema.org/Article"  >
    <div class="bd-container-inner">
    
        <div class="data-control-id-2881 bd-grid-5 bd-margins">
          <div class="container-fluid">
            <div class="separated-grid row">
                <div class="separated-item-30 col-md-12 ">
                    
                    <div class="bd-griditem-30">
    <?php
    if (strlen($article->title)) {
        $params['header-text'] = $this->escape($article->title);
        if (strlen($article->titleLink))
            $params['header-link'] = $article->titleLink;
    }

    // Change the order of ""if"" statements to change the order of article metadata header items.
    if (strlen($article->created)) {
        $params['date-icons'][] = $article->createdDateInfo($article->created);
    }
    if (strlen($article->modified)) {
        $params['date-icons'][] = $article->modifiedDateInfo($article->modified);
    }
    if (strlen($article->published)) {
        $params['date-icons'][] = $article->publishedDateInfo($article->published);
    }

    if (strlen($article->author)) {
        $params['author-icon'] = $article->authorInfo($article->author, $article->authorLink);
    }

    if ($article->printIconVisible) {
        $params['print-icon'] = $article->printIconInfo();
    }
    if ($article->emailIconVisible) {
        $params['email-icon']= $article->emailIconInfo();
    }
    if ($article->editIconVisible) {
        $params['edit-icon'] = $article->editIconInfo();
    }
    if (strlen($article->hits)) {
        $params['hits-icons'] = $article->hitsInfo($article->hits);
    }

    // Build article content
    $content = '';
    if ('above full article' === $article->paginationPosition) {
        $params['pager'] = $article->pagination();
    }

    if (!$article->introVisible)
        $content .= $article->event('afterDisplayTitle');
    $content .= $article->event('beforeDisplayContent');
    if (strlen($article->toc))
        $content .= $article->toc($article->toc);
    if (strlen($article->text)) {
        if (strlen($article->images['fulltext']['image']))
            $params['data-image'] = $article->images['fulltext'];
        if ('above text' === $article->paginationPosition) {
            $params['pager'] = $article->pagination();
        }
        $content .= $article->text($article->text);
        if ('below text' === $article->paginationPosition) {
            $params['pager'] = $article->pagination();
        }
        if ($article->showLinks)
            $content .= $this->loadTemplate('links');
    }
    if ($article->introVisible)
        $content .= $article->intro($article->intro);
    if (strlen($article->readmore)) {
        $params['readmore-text'] = $article->readmore;
        $params['readmore-link'] = $article->readmoreLink;
    }
    if ('below full article' === $article->paginationPosition) {
        $params['pager'] = $article->pagination();
    }

    $content .= $article->event('afterDisplayContent');
    $params['content'] = processingShortcodes($content);

    // Change the order of ""if"" statements to change the order of article metadata footer items.
    // Build tags
    if (count(($article->tags)) > 0)
        $params['tags-icon'] = $article->tags;
    if (strlen($article->category)) {
        $params['category-icon'] = $article->categories($article->parentCategory, $article->parentCategoryLink, $article->category, $article->categoryLink);
    }
    echo renderTemplateFromIncludes('article_2', array($params));
    ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
echo ob_get_clean();
?>
<!--COMPONENT common /-->
<?php
defined('_JEXEC') or die;
?>
<?php
$params = array();
if ($GLOBALS['theme_settings']['is_preview']) {
    $params['post_id_class'] = $article->id;
    if($this->item->params->get('show_intro', 1) == '1' || $this->item->fulltext == '') {
        $params['postcontent_editor_id'] = 'article-' . $this->item->id;
        $params['article_id'] = 'article-' . $this->item->id;
    }
}
?>

<!--COMPONENT blog_9 -->
<?php ob_start(); ?>

<div class="data-control-id-1424399 bd-blog-9 bd-page-width  <?php echo $this->pageclass_sfx; ?>" itemscope itemtype="http://schema.org/Article" /**/style="display:none"/**/ >
    <div class="bd-container-inner">
    
        <div class="data-control-id-1424322 bd-grid-18 bd-margins">
          <div class="container-fluid">
            <div class="separated-grid row">
                <div class="separated-item-4 col-md-6 ">
                    
                    <div class="bd-griditem-4">
    <?php
    if (strlen($article->title)) {
        $params['header-text'] = $this->escape($article->title);
        if (strlen($article->titleLink))
            $params['header-link'] = $article->titleLink;
    }

    // Change the order of ""if"" statements to change the order of article metadata header items.
    if (strlen($article->created)) {
        $params['date-icons'][] = $article->createdDateInfo($article->created);
    }
    if (strlen($article->modified)) {
        $params['date-icons'][] = $article->modifiedDateInfo($article->modified);
    }
    if (strlen($article->published)) {
        $params['date-icons'][] = $article->publishedDateInfo($article->published);
    }

    if (strlen($article->author)) {
        $params['author-icon'] = $article->authorInfo($article->author, $article->authorLink);
    }

    if ($article->printIconVisible) {
        $params['print-icon'] = $article->printIconInfo();
    }
    if ($article->emailIconVisible) {
        $params['email-icon']= $article->emailIconInfo();
    }
    if ($article->editIconVisible) {
        $params['edit-icon'] = $article->editIconInfo();
    }
    if (strlen($article->hits)) {
        $params['hits-icons'] = $article->hitsInfo($article->hits);
    }

    // Build article content
    $content = '';
    if ('above full article' === $article->paginationPosition) {
        $params['pager'] = $article->pagination();
    }

    if (!$article->introVisible)
        $content .= $article->event('afterDisplayTitle');
    $content .= $article->event('beforeDisplayContent');
    if (strlen($article->toc))
        $content .= $article->toc($article->toc);
    if (strlen($article->text)) {
        if (strlen($article->images['fulltext']['image']))
            $params['data-image'] = $article->images['fulltext'];
        if ('above text' === $article->paginationPosition) {
            $params['pager'] = $article->pagination();
        }
        $content .= $article->text($article->text);
        if ('below text' === $article->paginationPosition) {
            $params['pager'] = $article->pagination();
        }
        if ($article->showLinks)
            $content .= $this->loadTemplate('links');
    }
    if ($article->introVisible)
        $content .= $article->intro($article->intro);
    if (strlen($article->readmore)) {
        $params['readmore-text'] = $article->readmore;
        $params['readmore-link'] = $article->readmoreLink;
    }
    if ('below full article' === $article->paginationPosition) {
        $params['pager'] = $article->pagination();
    }

    $content .= $article->event('afterDisplayContent');
    $params['content'] = processingShortcodes($content);

    // Change the order of ""if"" statements to change the order of article metadata footer items.
    // Build tags
    if (count(($article->tags)) > 0)
        $params['tags-icon'] = $article->tags;
    if (strlen($article->category)) {
        $params['category-icon'] = $article->categories($article->parentCategory, $article->parentCategoryLink, $article->category, $article->categoryLink);
    }
    echo renderTemplateFromIncludes('article_10', array($params));
    ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
echo ob_get_clean();
?>
<!--COMPONENT blog_9 /-->
<?php
defined('_JEXEC') or die;
?>
<?php
$params = array();
if ($GLOBALS['theme_settings']['is_preview']) {
    $params['post_id_class'] = $article->id;
    if($this->item->params->get('show_intro', 1) == '1' || $this->item->fulltext == '') {
        $params['postcontent_editor_id'] = 'article-' . $this->item->id;
        $params['article_id'] = 'article-' . $this->item->id;
    }
}
?>

<!--COMPONENT blog_5 -->
<?php ob_start(); ?>

<div class="data-control-id-3353 bd-blog-5 bd-page-width  <?php echo $this->pageclass_sfx; ?>" itemscope itemtype="http://schema.org/Article" /**/style="display:none"/**/ >
    <div class="bd-container-inner">
    
    <?php $pageHeading = strlen($article->pageHeading) ? $component->pageHeading($article->pageHeading) : ''; ?>
        <?php if ($pageHeading) : ?>
            <h1 class="data-control-id-3231 bd-container-21 bd-tagstyles bd-bootstrap-img bd-img-responsive bd-bootstrap-tables bd-table-striped bd-table-bordered bd-table-hover bd-table-condensed bd-table-responsive"><?php echo $pageHeading; ?></h1>
        <?php endif; ?>
        <div class="data-control-id-3199 bd-grid-7 bd-margins">
          <div class="container-fluid">
            <div class="separated-grid row">
                <div class="separated-item-46 col-md-12 ">
                    
                    <div class="bd-griditem-46">
    <?php
    if (strlen($article->title)) {
        $params['header-text'] = $this->escape($article->title);
        if (strlen($article->titleLink))
            $params['header-link'] = $article->titleLink;
    }

    // Change the order of ""if"" statements to change the order of article metadata header items.
    if (strlen($article->created)) {
        $params['date-icons'][] = $article->createdDateInfo($article->created);
    }
    if (strlen($article->modified)) {
        $params['date-icons'][] = $article->modifiedDateInfo($article->modified);
    }
    if (strlen($article->published)) {
        $params['date-icons'][] = $article->publishedDateInfo($article->published);
    }

    if (strlen($article->author)) {
        $params['author-icon'] = $article->authorInfo($article->author, $article->authorLink);
    }

    if ($article->printIconVisible) {
        $params['print-icon'] = $article->printIconInfo();
    }
    if ($article->emailIconVisible) {
        $params['email-icon']= $article->emailIconInfo();
    }
    if ($article->editIconVisible) {
        $params['edit-icon'] = $article->editIconInfo();
    }
    if (strlen($article->hits)) {
        $params['hits-icons'] = $article->hitsInfo($article->hits);
    }

    // Build article content
    $content = '';
    if ('above full article' === $article->paginationPosition) {
        $params['pager'] = $article->pagination();
    }

    if (!$article->introVisible)
        $content .= $article->event('afterDisplayTitle');
    $content .= $article->event('beforeDisplayContent');
    if (strlen($article->toc))
        $content .= $article->toc($article->toc);
    if (strlen($article->text)) {
        if (strlen($article->images['fulltext']['image']))
            $params['data-image'] = $article->images['fulltext'];
        if ('above text' === $article->paginationPosition) {
            $params['pager'] = $article->pagination();
        }
        $content .= $article->text($article->text);
        if ('below text' === $article->paginationPosition) {
            $params['pager'] = $article->pagination();
        }
        if ($article->showLinks)
            $content .= $this->loadTemplate('links');
    }
    if ($article->introVisible)
        $content .= $article->intro($article->intro);
    if (strlen($article->readmore)) {
        $params['readmore-text'] = $article->readmore;
        $params['readmore-link'] = $article->readmoreLink;
    }
    if ('below full article' === $article->paginationPosition) {
        $params['pager'] = $article->pagination();
    }

    $content .= $article->event('afterDisplayContent');
    $params['content'] = processingShortcodes($content);

    // Change the order of ""if"" statements to change the order of article metadata footer items.
    // Build tags
    if (count(($article->tags)) > 0)
        $params['tags-icon'] = $article->tags;
    if (strlen($article->category)) {
        $params['category-icon'] = $article->categories($article->parentCategory, $article->parentCategoryLink, $article->category, $article->categoryLink);
    }
    echo renderTemplateFromIncludes('article_4', array($params));
    ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
echo ob_get_clean();
?>
<!--COMPONENT blog_5 /-->
<?php
defined('_JEXEC') or die;
?>
<?php
$params = array();
if ($GLOBALS['theme_settings']['is_preview']) {
    $params['post_id_class'] = $article->id;
    if($this->item->params->get('show_intro', 1) == '1' || $this->item->fulltext == '') {
        $params['postcontent_editor_id'] = 'article-' . $this->item->id;
        $params['article_id'] = 'article-' . $this->item->id;
    }
}
?>

<!--COMPONENT blog_3 -->
<?php ob_start(); ?>

<div class="data-control-id-3194 bd-blog-3 bd-page-width  <?php echo $this->pageclass_sfx; ?>" itemscope itemtype="http://schema.org/Article" /**/style="display:none"/**/ >
    <div class="bd-container-inner">
    
    <?php $pageHeading = strlen($article->pageHeading) ? $component->pageHeading($article->pageHeading) : ''; ?>
        <?php if ($pageHeading) : ?>
            <h1 class="data-control-id-3072 bd-container-18 bd-tagstyles bd-bootstrap-img bd-img-responsive bd-bootstrap-tables bd-table-striped bd-table-bordered bd-table-hover bd-table-condensed bd-table-responsive"><?php echo $pageHeading; ?></h1>
        <?php endif; ?>
        <div class="data-control-id-3040 bd-grid-6 bd-margins">
          <div class="container-fluid">
            <div class="separated-grid row">
                <div class="separated-item-38 col-md-12 ">
                    
                    <div class="bd-griditem-38">
    <?php
    if (strlen($article->title)) {
        $params['header-text'] = $this->escape($article->title);
        if (strlen($article->titleLink))
            $params['header-link'] = $article->titleLink;
    }

    // Change the order of ""if"" statements to change the order of article metadata header items.
    if (strlen($article->created)) {
        $params['date-icons'][] = $article->createdDateInfo($article->created);
    }
    if (strlen($article->modified)) {
        $params['date-icons'][] = $article->modifiedDateInfo($article->modified);
    }
    if (strlen($article->published)) {
        $params['date-icons'][] = $article->publishedDateInfo($article->published);
    }

    if (strlen($article->author)) {
        $params['author-icon'] = $article->authorInfo($article->author, $article->authorLink);
    }

    if ($article->printIconVisible) {
        $params['print-icon'] = $article->printIconInfo();
    }
    if ($article->emailIconVisible) {
        $params['email-icon']= $article->emailIconInfo();
    }
    if ($article->editIconVisible) {
        $params['edit-icon'] = $article->editIconInfo();
    }
    if (strlen($article->hits)) {
        $params['hits-icons'] = $article->hitsInfo($article->hits);
    }

    // Build article content
    $content = '';
    if ('above full article' === $article->paginationPosition) {
        $params['pager'] = $article->pagination();
    }

    if (!$article->introVisible)
        $content .= $article->event('afterDisplayTitle');
    $content .= $article->event('beforeDisplayContent');
    if (strlen($article->toc))
        $content .= $article->toc($article->toc);
    if (strlen($article->text)) {
        if (strlen($article->images['fulltext']['image']))
            $params['data-image'] = $article->images['fulltext'];
        if ('above text' === $article->paginationPosition) {
            $params['pager'] = $article->pagination();
        }
        $content .= $article->text($article->text);
        if ('below text' === $article->paginationPosition) {
            $params['pager'] = $article->pagination();
        }
        if ($article->showLinks)
            $content .= $this->loadTemplate('links');
    }
    if ($article->introVisible)
        $content .= $article->intro($article->intro);
    if (strlen($article->readmore)) {
        $params['readmore-text'] = $article->readmore;
        $params['readmore-link'] = $article->readmoreLink;
    }
    if ('below full article' === $article->paginationPosition) {
        $params['pager'] = $article->pagination();
    }

    $content .= $article->event('afterDisplayContent');
    $params['content'] = processingShortcodes($content);

    // Change the order of ""if"" statements to change the order of article metadata footer items.
    // Build tags
    if (count(($article->tags)) > 0)
        $params['tags-icon'] = $article->tags;
    if (strlen($article->category)) {
        $params['category-icon'] = $article->categories($article->parentCategory, $article->parentCategoryLink, $article->category, $article->categoryLink);
    }
    echo renderTemplateFromIncludes('article_3', array($params));
    ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
echo ob_get_clean();
?>
<!--COMPONENT blog_3 /-->
<?php
defined('_JEXEC') or die;
?>
<?php
$params = array();
if ($GLOBALS['theme_settings']['is_preview']) {
    $params['post_id_class'] = $article->id;
    if($this->item->params->get('show_intro', 1) == '1' || $this->item->fulltext == '') {
        $params['postcontent_editor_id'] = 'article-' . $this->item->id;
        $params['article_id'] = 'article-' . $this->item->id;
    }
}
?>

<!--COMPONENT blog_10 -->
<?php ob_start(); ?>

<div class="data-control-id-1460430 bd-blog-10 bd-page-width  bd-no-margins <?php echo $this->pageclass_sfx; ?>" itemscope itemtype="http://schema.org/Article" /**/style="display:none"/**/ >
    <div class="bd-container-inner">
    
        <div class="data-control-id-1460353 bd-grid-21 bd-margins">
          <div class="container-fluid">
            <div class="separated-grid row">
                <div class="separated-item-15 col-md-6 ">
                    
                    <div class="bd-griditem-15">
    <?php
    if (strlen($article->title)) {
        $params['header-text'] = $this->escape($article->title);
        if (strlen($article->titleLink))
            $params['header-link'] = $article->titleLink;
    }

    // Change the order of ""if"" statements to change the order of article metadata header items.
    if (strlen($article->created)) {
        $params['date-icons'][] = $article->createdDateInfo($article->created);
    }
    if (strlen($article->modified)) {
        $params['date-icons'][] = $article->modifiedDateInfo($article->modified);
    }
    if (strlen($article->published)) {
        $params['date-icons'][] = $article->publishedDateInfo($article->published);
    }

    if (strlen($article->author)) {
        $params['author-icon'] = $article->authorInfo($article->author, $article->authorLink);
    }

    if ($article->printIconVisible) {
        $params['print-icon'] = $article->printIconInfo();
    }
    if ($article->emailIconVisible) {
        $params['email-icon']= $article->emailIconInfo();
    }
    if ($article->editIconVisible) {
        $params['edit-icon'] = $article->editIconInfo();
    }
    if (strlen($article->hits)) {
        $params['hits-icons'] = $article->hitsInfo($article->hits);
    }

    // Build article content
    $content = '';
    if ('above full article' === $article->paginationPosition) {
        $params['pager'] = $article->pagination();
    }

    if (!$article->introVisible)
        $content .= $article->event('afterDisplayTitle');
    $content .= $article->event('beforeDisplayContent');
    if (strlen($article->toc))
        $content .= $article->toc($article->toc);
    if (strlen($article->text)) {
        if (strlen($article->images['fulltext']['image']))
            $params['data-image'] = $article->images['fulltext'];
        if ('above text' === $article->paginationPosition) {
            $params['pager'] = $article->pagination();
        }
        $content .= $article->text($article->text);
        if ('below text' === $article->paginationPosition) {
            $params['pager'] = $article->pagination();
        }
        if ($article->showLinks)
            $content .= $this->loadTemplate('links');
    }
    if ($article->introVisible)
        $content .= $article->intro($article->intro);
    if (strlen($article->readmore)) {
        $params['readmore-text'] = $article->readmore;
        $params['readmore-link'] = $article->readmoreLink;
    }
    if ('below full article' === $article->paginationPosition) {
        $params['pager'] = $article->pagination();
    }

    $content .= $article->event('afterDisplayContent');
    $params['content'] = processingShortcodes($content);

    // Change the order of ""if"" statements to change the order of article metadata footer items.
    // Build tags
    if (count(($article->tags)) > 0)
        $params['tags-icon'] = $article->tags;
    if (strlen($article->category)) {
        $params['category-icon'] = $article->categories($article->parentCategory, $article->parentCategoryLink, $article->category, $article->categoryLink);
    }
    echo renderTemplateFromIncludes('article_11', array($params));
    ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
echo ob_get_clean();
?>
<!--COMPONENT blog_10 /-->
<?php
defined('_JEXEC') or die;
?>
<?php
$params = array();
if ($GLOBALS['theme_settings']['is_preview']) {
    $params['post_id_class'] = $article->id;
    if($this->item->params->get('show_intro', 1) == '1' || $this->item->fulltext == '') {
        $params['postcontent_editor_id'] = 'article-' . $this->item->id;
        $params['article_id'] = 'article-' . $this->item->id;
    }
}
?>

<!--COMPONENT blog_2 -->
<?php ob_start(); ?>

<div class="data-control-id-1258743 bd-blog-2 bd-page-width  <?php echo $this->pageclass_sfx; ?>" itemscope itemtype="http://schema.org/Article" /**/style="display:none"/**/ >
    <div class="bd-container-inner">
    
    <?php $pageHeading = strlen($article->pageHeading) ? $component->pageHeading($article->pageHeading) : ''; ?>
        <?php if ($pageHeading) : ?>
            <h1 class="data-control-id-1258708 bd-container-4 bd-tagstyles bd-bootstrap-img bd-img-responsive bd-bootstrap-tables bd-table-striped bd-table-bordered bd-table-hover bd-table-condensed bd-table-responsive"><?php echo $pageHeading; ?></h1>
        <?php endif; ?>
        <div class="data-control-id-1258698 bd-grid-1 bd-margins">
          <div class="container-fluid">
            <div class="separated-grid row">
                <div class="separated-item-7 col-md-12 ">
                    
                    <div class="bd-griditem-7">
    <?php
    if (strlen($article->title)) {
        $params['header-text'] = $this->escape($article->title);
        if (strlen($article->titleLink))
            $params['header-link'] = $article->titleLink;
    }

    // Change the order of ""if"" statements to change the order of article metadata header items.
    if (strlen($article->created)) {
        $params['date-icons'][] = $article->createdDateInfo($article->created);
    }
    if (strlen($article->modified)) {
        $params['date-icons'][] = $article->modifiedDateInfo($article->modified);
    }
    if (strlen($article->published)) {
        $params['date-icons'][] = $article->publishedDateInfo($article->published);
    }

    if (strlen($article->author)) {
        $params['author-icon'] = $article->authorInfo($article->author, $article->authorLink);
    }

    if ($article->printIconVisible) {
        $params['print-icon'] = $article->printIconInfo();
    }
    if ($article->emailIconVisible) {
        $params['email-icon']= $article->emailIconInfo();
    }
    if ($article->editIconVisible) {
        $params['edit-icon'] = $article->editIconInfo();
    }
    if (strlen($article->hits)) {
        $params['hits-icons'] = $article->hitsInfo($article->hits);
    }

    // Build article content
    $content = '';
    if ('above full article' === $article->paginationPosition) {
        $params['pager'] = $article->pagination();
    }

    if (!$article->introVisible)
        $content .= $article->event('afterDisplayTitle');
    $content .= $article->event('beforeDisplayContent');
    if (strlen($article->toc))
        $content .= $article->toc($article->toc);
    if (strlen($article->text)) {
        if (strlen($article->images['fulltext']['image']))
            $params['data-image'] = $article->images['fulltext'];
        if ('above text' === $article->paginationPosition) {
            $params['pager'] = $article->pagination();
        }
        $content .= $article->text($article->text);
        if ('below text' === $article->paginationPosition) {
            $params['pager'] = $article->pagination();
        }
        if ($article->showLinks)
            $content .= $this->loadTemplate('links');
    }
    if ($article->introVisible)
        $content .= $article->intro($article->intro);
    if (strlen($article->readmore)) {
        $params['readmore-text'] = $article->readmore;
        $params['readmore-link'] = $article->readmoreLink;
    }
    if ('below full article' === $article->paginationPosition) {
        $params['pager'] = $article->pagination();
    }

    $content .= $article->event('afterDisplayContent');
    $params['content'] = processingShortcodes($content);

    // Change the order of ""if"" statements to change the order of article metadata footer items.
    // Build tags
    if (count(($article->tags)) > 0)
        $params['tags-icon'] = $article->tags;
    if (strlen($article->category)) {
        $params['category-icon'] = $article->categories($article->parentCategory, $article->parentCategoryLink, $article->category, $article->categoryLink);
    }
    echo renderTemplateFromIncludes('article_7', array($params));
    ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
echo ob_get_clean();
?>
<!--COMPONENT blog_2 /-->
<?php
defined('_JEXEC') or die;
?>
<?php
$params = array();
if ($GLOBALS['theme_settings']['is_preview']) {
    $params['post_id_class'] = $article->id;
    if($this->item->params->get('show_intro', 1) == '1' || $this->item->fulltext == '') {
        $params['postcontent_editor_id'] = 'article-' . $this->item->id;
        $params['article_id'] = 'article-' . $this->item->id;
    }
}
?>

<!--COMPONENT blog_4 -->
<?php ob_start(); ?>

<div class="data-control-id-1453458 bd-blog-4 bd-page-width  <?php echo $this->pageclass_sfx; ?>" itemscope itemtype="http://schema.org/Article" /**/style="display:none"/**/ >
    <div class="bd-container-inner">
    
        <div class="data-control-id-1453381 bd-grid-14 bd-page-width  bd-margins">
          <div class="container-fluid">
            <div class="separated-grid row">
                <div class="separated-item-5 col-md-6 ">
                    
                    <div class="bd-griditem-5">
    <?php
    if (strlen($article->title)) {
        $params['header-text'] = $this->escape($article->title);
        if (strlen($article->titleLink))
            $params['header-link'] = $article->titleLink;
    }

    // Change the order of ""if"" statements to change the order of article metadata header items.
    if (strlen($article->created)) {
        $params['date-icons'][] = $article->createdDateInfo($article->created);
    }
    if (strlen($article->modified)) {
        $params['date-icons'][] = $article->modifiedDateInfo($article->modified);
    }
    if (strlen($article->published)) {
        $params['date-icons'][] = $article->publishedDateInfo($article->published);
    }

    if (strlen($article->author)) {
        $params['author-icon'] = $article->authorInfo($article->author, $article->authorLink);
    }

    if ($article->printIconVisible) {
        $params['print-icon'] = $article->printIconInfo();
    }
    if ($article->emailIconVisible) {
        $params['email-icon']= $article->emailIconInfo();
    }
    if ($article->editIconVisible) {
        $params['edit-icon'] = $article->editIconInfo();
    }
    if (strlen($article->hits)) {
        $params['hits-icons'] = $article->hitsInfo($article->hits);
    }

    // Build article content
    $content = '';
    if ('above full article' === $article->paginationPosition) {
        $params['pager'] = $article->pagination();
    }

    if (!$article->introVisible)
        $content .= $article->event('afterDisplayTitle');
    $content .= $article->event('beforeDisplayContent');
    if (strlen($article->toc))
        $content .= $article->toc($article->toc);
    if (strlen($article->text)) {
        if (strlen($article->images['fulltext']['image']))
            $params['data-image'] = $article->images['fulltext'];
        if ('above text' === $article->paginationPosition) {
            $params['pager'] = $article->pagination();
        }
        $content .= $article->text($article->text);
        if ('below text' === $article->paginationPosition) {
            $params['pager'] = $article->pagination();
        }
        if ($article->showLinks)
            $content .= $this->loadTemplate('links');
    }
    if ($article->introVisible)
        $content .= $article->intro($article->intro);
    if (strlen($article->readmore)) {
        $params['readmore-text'] = $article->readmore;
        $params['readmore-link'] = $article->readmoreLink;
    }
    if ('below full article' === $article->paginationPosition) {
        $params['pager'] = $article->pagination();
    }

    $content .= $article->event('afterDisplayContent');
    $params['content'] = processingShortcodes($content);

    // Change the order of ""if"" statements to change the order of article metadata footer items.
    // Build tags
    if (count(($article->tags)) > 0)
        $params['tags-icon'] = $article->tags;
    if (strlen($article->category)) {
        $params['category-icon'] = $article->categories($article->parentCategory, $article->parentCategoryLink, $article->category, $article->categoryLink);
    }
    echo renderTemplateFromIncludes('article_8', array($params));
    ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
echo ob_get_clean();
?>
<!--COMPONENT blog_4 /-->
<?php
defined('_JEXEC') or die;
?>
<?php
$params = array();
if ($GLOBALS['theme_settings']['is_preview']) {
    $params['post_id_class'] = $article->id;
    if($this->item->params->get('show_intro', 1) == '1' || $this->item->fulltext == '') {
        $params['postcontent_editor_id'] = 'article-' . $this->item->id;
        $params['article_id'] = 'article-' . $this->item->id;
    }
}
?>

<!--COMPONENT blog_7 -->
<?php ob_start(); ?>

<div class="data-control-id-1522 bd-blog-7 <?php echo $this->pageclass_sfx; ?>" itemscope itemtype="http://schema.org/Article" /**/style="display:none"/**/ >
    <div class="bd-container-inner">
    
    <?php $pageHeading = strlen($article->pageHeading) ? $component->pageHeading($article->pageHeading) : ''; ?>
        <?php if ($pageHeading) : ?>
            <h1 class="data-control-id-1400 bd-container-24 bd-tagstyles bd-bootstrap-img bd-img-responsive bd-bootstrap-tables bd-table-striped bd-table-bordered bd-table-hover bd-table-condensed bd-table-responsive"><?php echo $pageHeading; ?></h1>
        <?php endif; ?>
        <div class="data-control-id-1368 bd-grid-8 bd-margins">
          <div class="container-fluid">
            <div class="separated-grid row">
                <div class="separated-item-12 col-md-12 ">
                    
                    <div class="bd-griditem-12">
    <?php
    if (strlen($article->title)) {
        $params['header-text'] = $this->escape($article->title);
        if (strlen($article->titleLink))
            $params['header-link'] = $article->titleLink;
    }

    // Change the order of ""if"" statements to change the order of article metadata header items.
    if (strlen($article->created)) {
        $params['date-icons'][] = $article->createdDateInfo($article->created);
    }
    if (strlen($article->modified)) {
        $params['date-icons'][] = $article->modifiedDateInfo($article->modified);
    }
    if (strlen($article->published)) {
        $params['date-icons'][] = $article->publishedDateInfo($article->published);
    }

    if (strlen($article->author)) {
        $params['author-icon'] = $article->authorInfo($article->author, $article->authorLink);
    }

    if ($article->printIconVisible) {
        $params['print-icon'] = $article->printIconInfo();
    }
    if ($article->emailIconVisible) {
        $params['email-icon']= $article->emailIconInfo();
    }
    if ($article->editIconVisible) {
        $params['edit-icon'] = $article->editIconInfo();
    }
    if (strlen($article->hits)) {
        $params['hits-icons'] = $article->hitsInfo($article->hits);
    }

    // Build article content
    $content = '';
    if ('above full article' === $article->paginationPosition) {
        $params['pager'] = $article->pagination();
    }

    if (!$article->introVisible)
        $content .= $article->event('afterDisplayTitle');
    $content .= $article->event('beforeDisplayContent');
    if (strlen($article->toc))
        $content .= $article->toc($article->toc);
    if (strlen($article->text)) {
        if (strlen($article->images['fulltext']['image']))
            $params['data-image'] = $article->images['fulltext'];
        if ('above text' === $article->paginationPosition) {
            $params['pager'] = $article->pagination();
        }
        $content .= $article->text($article->text);
        if ('below text' === $article->paginationPosition) {
            $params['pager'] = $article->pagination();
        }
        if ($article->showLinks)
            $content .= $this->loadTemplate('links');
    }
    if ($article->introVisible)
        $content .= $article->intro($article->intro);
    if (strlen($article->readmore)) {
        $params['readmore-text'] = $article->readmore;
        $params['readmore-link'] = $article->readmoreLink;
    }
    if ('below full article' === $article->paginationPosition) {
        $params['pager'] = $article->pagination();
    }

    $content .= $article->event('afterDisplayContent');
    $params['content'] = processingShortcodes($content);

    // Change the order of ""if"" statements to change the order of article metadata footer items.
    // Build tags
    if (count(($article->tags)) > 0)
        $params['tags-icon'] = $article->tags;
    if (strlen($article->category)) {
        $params['category-icon'] = $article->categories($article->parentCategory, $article->parentCategoryLink, $article->category, $article->categoryLink);
    }
    echo renderTemplateFromIncludes('article_5', array($params));
    ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
echo ob_get_clean();
?>
<!--COMPONENT blog_7 /-->
<?php
defined('_JEXEC') or die;
?>
<?php
$params = array();
if ($GLOBALS['theme_settings']['is_preview']) {
    $params['post_id_class'] = $article->id;
    if($this->item->params->get('show_intro', 1) == '1' || $this->item->fulltext == '') {
        $params['postcontent_editor_id'] = 'article-' . $this->item->id;
        $params['article_id'] = 'article-' . $this->item->id;
    }
}
?>

<!--COMPONENT blog_8 -->
<?php ob_start(); ?>

<div class="data-control-id-1773 bd-blog-8 <?php echo $this->pageclass_sfx; ?>" itemscope itemtype="http://schema.org/Article" /**/style="display:none"/**/ >
    <div class="bd-container-inner">
    
    <?php $pageHeading = strlen($article->pageHeading) ? $component->pageHeading($article->pageHeading) : ''; ?>
        <?php if ($pageHeading) : ?>
            <h1 class="data-control-id-1651 bd-container-27 bd-tagstyles bd-bootstrap-img bd-img-responsive bd-bootstrap-tables bd-table-striped bd-table-bordered bd-table-hover bd-table-condensed bd-table-responsive"><?php echo $pageHeading; ?></h1>
        <?php endif; ?>
        <div class="data-control-id-1619 bd-grid-9 bd-margins">
          <div class="container-fluid">
            <div class="separated-grid row">
                <div class="separated-item-23 col-md-12 ">
                    
                    <div class="bd-griditem-23">
    <?php
    if (strlen($article->title)) {
        $params['header-text'] = $this->escape($article->title);
        if (strlen($article->titleLink))
            $params['header-link'] = $article->titleLink;
    }

    // Change the order of ""if"" statements to change the order of article metadata header items.
    if (strlen($article->created)) {
        $params['date-icons'][] = $article->createdDateInfo($article->created);
    }
    if (strlen($article->modified)) {
        $params['date-icons'][] = $article->modifiedDateInfo($article->modified);
    }
    if (strlen($article->published)) {
        $params['date-icons'][] = $article->publishedDateInfo($article->published);
    }

    if (strlen($article->author)) {
        $params['author-icon'] = $article->authorInfo($article->author, $article->authorLink);
    }

    if ($article->printIconVisible) {
        $params['print-icon'] = $article->printIconInfo();
    }
    if ($article->emailIconVisible) {
        $params['email-icon']= $article->emailIconInfo();
    }
    if ($article->editIconVisible) {
        $params['edit-icon'] = $article->editIconInfo();
    }
    if (strlen($article->hits)) {
        $params['hits-icons'] = $article->hitsInfo($article->hits);
    }

    // Build article content
    $content = '';
    if ('above full article' === $article->paginationPosition) {
        $params['pager'] = $article->pagination();
    }

    if (!$article->introVisible)
        $content .= $article->event('afterDisplayTitle');
    $content .= $article->event('beforeDisplayContent');
    if (strlen($article->toc))
        $content .= $article->toc($article->toc);
    if (strlen($article->text)) {
        if (strlen($article->images['fulltext']['image']))
            $params['data-image'] = $article->images['fulltext'];
        if ('above text' === $article->paginationPosition) {
            $params['pager'] = $article->pagination();
        }
        $content .= $article->text($article->text);
        if ('below text' === $article->paginationPosition) {
            $params['pager'] = $article->pagination();
        }
        if ($article->showLinks)
            $content .= $this->loadTemplate('links');
    }
    if ($article->introVisible)
        $content .= $article->intro($article->intro);
    if (strlen($article->readmore)) {
        $params['readmore-text'] = $article->readmore;
        $params['readmore-link'] = $article->readmoreLink;
    }
    if ('below full article' === $article->paginationPosition) {
        $params['pager'] = $article->pagination();
    }

    $content .= $article->event('afterDisplayContent');
    $params['content'] = processingShortcodes($content);

    // Change the order of ""if"" statements to change the order of article metadata footer items.
    // Build tags
    if (count(($article->tags)) > 0)
        $params['tags-icon'] = $article->tags;
    if (strlen($article->category)) {
        $params['category-icon'] = $article->categories($article->parentCategory, $article->parentCategoryLink, $article->category, $article->categoryLink);
    }
    echo renderTemplateFromIncludes('article_6', array($params));
    ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
echo ob_get_clean();
?>
<!--COMPONENT blog_8 /-->