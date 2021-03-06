<?php function article_5($data) {
    ob_start();
    $attr = '';
    if (isset($data['article_id'])) {
        $attr = ' id="' . $data['postcontent_editor_id'] . '"';
    }
    $postIdClass = '';
    if (isset($data['post_id_class'])) {
        $postIdClass = ' data-post-value="data-post-id-' . $data['post_id_class'] . '"';
    }
    ?>
        
        <article class="data-control-id-1444 bd-article-5"<?php echo $attr; ?><?php echo $postIdClass; ?>>
            <h2 class="data-control-id-1285 bd-postheader-5"  itemprop="name">
    <?php if (isset($data['header-text']) && strlen($data['header-text'])) : ?>
        <?php if (isset($data['header-link']) && strlen($data['header-link'])) : ?>
            <a <?php echo funcBuildRoute($data['header-link'], 'href'); ?>>
                <?php echo $data['header-text'];?>
            </a>
        <?php else: ?>
            <?php echo $data['header-text']; ?>
        <?php endif; ?>
    <?php endif; ?>
</h2>
<?php if (isset($data['header-badge']) && strlen($data['header-badge'])) : ?>
    <?php echo $data['header-badge']; ?>
<?php endif; ?>
	
		<div class="data-control-id-1309 bd-layoutcontainer-20 bd-columns bd-no-margins">
    <div class="bd-container-inner">
        <div class="container-fluid">
            <div class="row ">
                <div class="data-control-id-1305 bd-columnwrapper-45 
 col-md-6">
    <div class="bd-layoutcolumn-45 bd-column" ><div class="bd-vertical-align-wrapper"><?php if (isset($data['date-icons']) && count($data['date-icons'])) : ?>
<div class="data-control-id-1293 bd-posticondate-10">
    <span class="data-control-id-1292 bd-icon bd-icon-54"><span><?php
        $count = count($data['date-icons']);
        foreach ($data['date-icons'] as $key => $icon) {
            echo $icon;
            if ($key !== $count - 1) echo ' | ';
        }
    ?></span></span>
</div>
<?php endif; ?></div></div>
</div>
	
		<div class="data-control-id-1307 bd-columnwrapper-46 
 col-md-6">
    <div class="bd-layoutcolumn-46 bd-column" ><div class="bd-vertical-align-wrapper"><?php if (isset($data['author-icon']) && strlen($data['author-icon'])) : ?>
<div class="data-control-id-1302 bd-posticonauthor-11">
    <span class="data-control-id-1301 bd-icon bd-icon-56"><span><?php echo $data['author-icon']; ?></span></span>
</div>
<?php endif; ?></div></div>
</div>
            </div>
        </div>
    </div>
</div>
	
		<?php
    $attr = '';
    if (isset($data['postcontent_editor_id'])) {
        $attr = ' data-editable-id="' . $data['postcontent_editor_id'] . '"';
    }
?>
<div class="data-control-id-1342 bd-postcontent-5 bd-tagstyles bd-bootstrap-img bd-img-responsive bd-bootstrap-tables bd-table-striped bd-table-bordered bd-table-hover bd-table-condensed bd-table-responsive  bd-contentlayout-offset" <?php echo $attr; ?> itemprop="articleBody">
    <?php if (isset($data['content']) && strlen($data['content'])):
        $content = funcPostprocessPostContent($data['content']);
        echo funcContentRoutesCorrector($content);
    endif; ?>
</div>
        </article>
        <div class="bd-container-inner"><?php if (isset($data['pager'])) : ?>
<div class="data-control-id-1413 bd-pager-5">
    <ul class="data-control-id-1412 bd-pagination pager">
        <?php if (preg_match('/<li[^>]*previous[^>]*>([\S\s]*?)<\/li>/', $data['pager'], $prevMatches)) : ?>
        <li class="data-control-id-1411 bd-paginationitem-1"><?php echo funcContentRoutesCorrector($prevMatches[1]); ?></li>
        <?php endif; ?>
        <?php if (preg_match('/<li[^>]*next[^>]*>([\S\s]*?)<\/li>/', $data['pager'], $nextMatches)) : ?>
        <li class="data-control-id-1411 bd-paginationitem-1"><?php echo funcContentRoutesCorrector($nextMatches[1]); ?></li>
        <?php endif; ?>
    </ul>
</div>
<?php endif; ?></div>
        
<?php
    return ob_get_clean();
}