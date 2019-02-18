<?php function article_10($data) {
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
        
        <article class="data-control-id-1424364 bd-article-10"<?php echo $attr; ?><?php echo $postIdClass; ?>>
            <div class="data-control-id-1424534 bd-hoverbox-7 bd-effect-over-left">
  <div class="bd-slidesWrapper">
    <div class="bd-backSlide"><div class="data-control-id-1424520 bd-container-147 bd-tagstyles bd-bootstrap-img bd-img-responsive bd-bootstrap-tables bd-table-striped bd-table-bordered bd-table-hover bd-table-condensed bd-table-responsive">
    <h2 class="data-control-id-1424576 bd-postheader-17"  itemprop="name">
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
	
		<?php if (isset($data['date-icons']) && count($data['date-icons'])) : ?>
<div class="data-control-id-1424574 bd-posticondate-36">
    <span class="data-control-id-1424573 "><span><?php
        $count = count($data['date-icons']);
        foreach ($data['date-icons'] as $key => $icon) {
            echo $icon;
            if ($key !== $count - 1) echo ' | ';
        }
    ?></span></span>
</div>
<?php endif; ?>
	
		<?php if (isset($data['data-image'])) : ?>
<?php
    $image = $data['data-image'];
    $caption = $image['caption'];
    $floatClass = $image['float'] ? ( 'pull-' . $image['float']) : '';
    ?>
<div class="data-control-id-1424548 bd-postimage-9 bd-imagescaling bd-imagescaling-6 <?php echo $floatClass; ?>">
    
    <?php if (isset($image['link']) && $image['link'] !== '') : ?>
    <a href="<?php echo $image['link']; ?>">
        <?php endif; ?>
        <img src="<?php echo $image['image']; ?>" alt="<?php echo $image['alt']; ?>" class="data-control-id-1424535 bd-imagestyles-31" itemprop="image"/>
        <?php if (isset($image['link']) && $image['link'] !== '') : ?>
    </a>
    <?php endif; ?>
    
    <?php if ($caption): ?>
    <div class="data-control-id-1424547 bd-container-149 bd-tagstyles bd-bootstrap-img bd-img-responsive bd-bootstrap-tables bd-table-striped bd-table-bordered bd-table-hover bd-table-condensed bd-table-responsive ">
        <?php echo $caption; ?>
    </div>
    <?php endif; ?>
</div>
<?php endif; ?>
    <?php
echo <<<'CUSTOM_CODE'

CUSTOM_CODE;
?>
 </div></div>
    <div class="bd-overSlide"
        
        
        ><div class="data-control-id-1424532 bd-container-148 bd-tagstyles bd-bootstrap-img bd-img-responsive bd-bootstrap-tables bd-table-striped bd-table-bordered bd-table-hover bd-table-condensed bd-table-responsive">
    <?php
    $attr = '';
    if (isset($data['postcontent_editor_id'])) {
        $attr = ' data-editable-id="' . $data['postcontent_editor_id'] . '"';
    }
?>
<div class="data-control-id-1424588 bd-postcontent-14 bd-tagstyles bd-bootstrap-img bd-img-responsive bd-bootstrap-tables bd-table-striped bd-table-bordered bd-table-hover bd-table-condensed bd-table-responsive bd-contentlayout-offset" <?php echo $attr; ?> itemprop="articleBody">
    <?php if (isset($data['content']) && strlen($data['content'])):
        $content = funcPostprocessPostContent($data['content']);
        echo funcContentRoutesCorrector($content);
    endif; ?>
</div>
    <?php
echo <<<'CUSTOM_CODE'

CUSTOM_CODE;
?>
 </div></div>
  </div>
</div>
        </article>
        <div class="bd-container-inner"><?php if (isset($data['pager'])) : ?>
<div class="data-control-id-1424363 bd-pager-10">
    <ul class="data-control-id-1424362 bd-pagination-8 pager">
        <?php if (preg_match('/<li[^>]*previous[^>]*>([\S\s]*?)<\/li>/', $data['pager'], $prevMatches)) : ?>
        <li class="data-control-id-1424641 bd-paginationitem-8"><?php echo funcContentRoutesCorrector($prevMatches[1]); ?></li>
        <?php endif; ?>
        <?php if (preg_match('/<li[^>]*next[^>]*>([\S\s]*?)<\/li>/', $data['pager'], $nextMatches)) : ?>
        <li class="data-control-id-1424641 bd-paginationitem-8"><?php echo funcContentRoutesCorrector($nextMatches[1]); ?></li>
        <?php endif; ?>
    </ul>
</div>
<?php endif; ?></div>
        
<?php
    return ob_get_clean();
}