<?php function article_2($data) {
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
        
        <article class=" bd-article-2"<?php echo $attr; ?><?php echo $postIdClass; ?>>
            <h2 class=" bd-postheader-15"  itemprop="name">
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
	
		<div class=" bd-layoutbox-47 bd-page-width  bd-no-margins clearfix">
    <div class="bd-container-inner">
        <?php if (isset($data['date-icons']) && count($data['date-icons'])) : ?>
<div class=" bd-posticondate-20 bd-no-margins">
    <span class=" bd-icon bd-icon-105"><span><?php
        $count = count($data['date-icons']);
        foreach ($data['date-icons'] as $key => $icon) {
            echo $icon;
            if ($key !== $count - 1) echo ' | ';
        }
    ?></span></span>
</div>
<?php endif; ?>
	
		<?php if (isset($data['author-icon']) && strlen($data['author-icon'])) : ?>
<div class=" bd-posticonauthor-24 bd-no-margins">
    <span class=" bd-icon bd-icon-168"><span><?php echo $data['author-icon']; ?></span></span>
</div>
<?php endif; ?>
	
		<?php if (isset($data['category-icon']) && strlen($data['category-icon'])) : ?>
<div class=" bd-posticoncategory-27">
    <span class=" bd-icon bd-icon-171"><span><?php echo $data['category-icon']; ?></span></span>
</div>
<?php endif; ?>
    </div>
</div>
	
		<?php if (isset($data['data-image'])) : ?>
<?php
    $image = $data['data-image'];
    $caption = $image['caption'];
    $floatClass = $image['float'] ? ( 'pull-' . $image['float']) : '';
    ?>
<div class=" bd-postimage-1 <?php echo $floatClass; ?>">
    
    <?php if (isset($image['link']) && $image['link'] !== '') : ?>
    <a href="<?php echo $image['link']; ?>">
        <?php endif; ?>
        <img src="<?php echo $image['image']; ?>" alt="<?php echo $image['alt']; ?>" class="   img-responsive" itemprop="image"/>
        <?php if (isset($image['link']) && $image['link'] !== '') : ?>
    </a>
    <?php endif; ?>
    
    <?php if ($caption): ?>
    <div class=" bd-container-50 bd-tagstyles bd-bootstrap-img bd-img-responsive bd-bootstrap-tables bd-table-striped bd-table-bordered bd-table-hover bd-table-condensed bd-table-responsive ">
        <?php echo $caption; ?>
    </div>
    <?php endif; ?>
</div>
<?php endif; ?>
	
		<?php
    $attr = '';
    if (isset($data['postcontent_editor_id'])) {
        $attr = ' data-editable-id="' . $data['postcontent_editor_id'] . '"';
    }
?>
<div class=" bd-postcontent-2 bd-tagstyles bd-custom-blockquotes bd-bootstrap-img bd-img-responsive bd-bootstrap-tables bd-table-striped bd-table-bordered bd-table-hover bd-table-condensed bd-table-responsive bd-contentlayout-offset" <?php echo $attr; ?> itemprop="articleBody">
    <?php if (isset($data['content']) && strlen($data['content'])):
        $content = funcPostprocessPostContent($data['content']);
        echo funcContentRoutesCorrector($content);
    endif; ?>
</div>
	
		<div class=" bd-layoutbox-49 bd-page-width  bd-no-margins clearfix">
    <div class="bd-container-inner">
        <?php if (isset($data['tags-icon'])) : ?>
<div class=" bd-posticontags-30 bd-no-margins">
            <span class=" bd-icon bd-icon-174"><span>
            <?php foreach($data['tags-icon'] as $key => $item) : ?>
            <?php $separator = ($key !== count($data['tags-icon']) - 1) ? ',' : ''; ?>
            <a href="<?php echo $item['href'];?>" itemprop="keywords">
                <?php echo $item['title'] . $separator; ?>
            </a>
            <?php endforeach; ?>
            </span></span>
</div>
<?php endif; ?>
	
		<?php if (isset($data['readmore-link']) && isset($data['readmore-text']) ) : ?>
<a class="bd-postreadmore-2 bd-button-47 " href="<?php echo $data['readmore-link'] ?>" >
    <?php echo $data['readmore-text'] ?></a>
<?php endif; ?>
    </div>
</div>
        </article>
        <div class="bd-container-inner"><?php if (isset($data['pager'])) : ?>
<div class=" bd-pager-2">
    <ul class=" bd-pagination-6 pager">
        <?php if (preg_match('/<li[^>]*previous[^>]*>([\S\s]*?)<\/li>/', $data['pager'], $prevMatches)) : ?>
        <li class=" bd-paginationitem-6"><?php echo funcContentRoutesCorrector($prevMatches[1]); ?></li>
        <?php endif; ?>
        <?php if (preg_match('/<li[^>]*next[^>]*>([\S\s]*?)<\/li>/', $data['pager'], $nextMatches)) : ?>
        <li class=" bd-paginationitem-6"><?php echo funcContentRoutesCorrector($nextMatches[1]); ?></li>
        <?php endif; ?>
    </ul>
</div>
<?php endif; ?></div>
        
<?php
    return ob_get_clean();
}