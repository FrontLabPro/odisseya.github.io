<!DOCTYPE html>
<html lang="<?php echo $document->language; ?>" dir="ltr">
<head>
    <?php
        $base = $document->getBase();
        if (!empty($base)) {
            echo '<base href="' . $base . '" />';
            $document->setBase('');
        }
    ?>
    <link href="<?php echo JURI::base() . 'templates/' . JFactory::getApplication()->getTemplate(); ?>/images/designer/0395c4b7207c2a0b1bca99c3f8055f67_mojaika_10_logo.png" rel="icon" type="image/x-icon" />
    <script>
    var themeHasJQuery = !!window.jQuery;
</script>
<script src="<?php echo addThemeVersion($document->templateUrl . '/jquery.js'); ?>"></script>
<script>
    window._$ = jQuery.noConflict(themeHasJQuery);
</script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="<?php echo addThemeVersion($document->templateUrl . '/bootstrap.min.js'); ?>"></script>
<!--[if lte IE 9]>
<script src="<?php echo addThemeVersion($document->templateUrl . '/layout.ie.js'); ?>"></script>
<link rel="stylesheet" href="<?php echo addThemeVersion($document->templateUrl . '/layout.ie.css'); ?>" media="screen"/>
<![endif]-->
<link class="data-control-id-9" href='//fonts.googleapis.com/css?family=Artifika:regular|Ledger:regular|Nixie+One:regular&subset=latin' rel='stylesheet' type='text/css'>
<script src="<?php echo addThemeVersion($document->templateUrl . '/layout.core.js') ?>"></script>
    
    <?php echo $document->head; ?>
    <?php if ($GLOBALS['theme_settings']['is_preview'] || !file_exists($themeDir . '/css/bootstrap.min.css')) : ?>
    <link rel="stylesheet" href="<?php echo addThemeVersion($document->templateUrl . '/css/bootstrap.css'); ?>" media="screen" />
    <?php else : ?>
    <link rel="stylesheet" href="<?php echo addThemeVersion($document->templateUrl . '/css/bootstrap.min.css'); ?>" media="screen" />
    <?php endif; ?>
    <?php if ($GLOBALS['theme_settings']['is_preview'] || !file_exists($themeDir . '/css/template.min.css')) : ?>
    <link rel="stylesheet" href="<?php echo addThemeVersion($document->templateUrl . '/css/template.css'); ?>" media="screen" />
    <?php else : ?>
    <link rel="stylesheet" href="<?php echo addThemeVersion($document->templateUrl . '/css/template.min.css'); ?>" media="screen" />
    <?php endif; ?>
    <?php if(('edit' == JRequest::getVar('layout') && 'form' == JRequest::getVar('view')) ||
        ('com_config' == JRequest::getVar('option') && 'config.display.modules' == JRequest::getVar('controller'))) : ?>
    <link rel="stylesheet" href="<?php echo addThemeVersion($document->templateUrl . '/css/media.css'); ?>" media="screen" />
    <script src="<?php echo addThemeVersion($document->templateUrl . '/js/template.js'); ?>"></script>
    <?php endif; ?>
    <script src="<?php echo addThemeVersion($document->templateUrl . '/script.js'); ?>"></script>
    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&load=Geolink"
 type="text/javascript"></script>
</head>
<body class="data-control-id-43 bootstrap bd-body-9  bd-pagebackground bd-margins">
    <div class="data-control-id-1068481 bd-stretchtobottom-5 bd-stretch-to-bottom" data-control-selector=".bd-sheet-9"><div class="bd-sheet-9 bd-page-width   bd-sheetstyles-8 data-control-id-395">
    <div class="bd-container-inner">
        <div class="data-control-id-1295225 bd-flexalign-2 bd-no-margins bd-flexalign"><?php
// set messages
$title   = $this->title;

$code = 'Code';
$msg = 'Message';

if (method_exists($this->error, 'get' . $code))
$error = $this->error->{'get' . $code}();
else
$error = $this->error->get(strtolower($code));

if (method_exists($this->error, 'get' . $msg))
$message = $this->error->{'get' . $msg}();
else
$message = $this->error->get(strtolower($msg));


?>

<div class="data-control-id-2553 bd-text404-41 bd-tagstyles bd-bootstrap-img bd-img-responsive bd-bootstrap-tables bd-table-striped bd-table-bordered bd-table-hover bd-table-condensed bd-table-responsive  shape-only">
<?php  echo $error . ' - ' . $message ?>
</div></div>
    </div>
</div></div>
	
		
</body>
</html>