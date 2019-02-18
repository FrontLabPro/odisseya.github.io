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
<link class="" href='//fonts.googleapis.com/css?family=Artifika:regular|Ledger:regular|Nixie+One:regular&subset=latin' rel='stylesheet' type='text/css'>
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
<body class=" bootstrap bd-body-2  bd-pagebackground bd-margins">
    <header class=" bd-headerarea-1 bd-margins">
      <script>
(function(w, d, s, h, id) {
    w.roistatProjectId = id; w.roistatHost = h;
    var p = d.location.protocol == "https:" ? "https://" : "http://";
    var u = /^.*roistat_visit=[^;]+(.*)?$/.test(d.cookie) ? "/dist/module.js" : "/api/site/1.0/"+id+"/init";
    var js = d.createElement(s); js.charset="UTF-8"; js.async = 1; js.src = p+h+u; var js2 = d.getElementsByTagName(s)[0]; js2.parentNode.insertBefore(js, js2);
})(window, document, 'script', 'cloud.roistat.com', 'cd4d55726a0132aabcbaadebea95a695');
</script>
  <!-- BEGIN JIVOSITE CODE {literal} -->
<script type='text/javascript'>
(function(){ var widget_id = 'e0XZXGyHma';var d=document;var w=window;function l(){var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true;s.src = '//code.jivosite.com/script/geo-widget/'+widget_id; var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss);}if(d.readyState=='complete'){l();}else{if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})();
</script>
  <!-- BEGIN CLICKTEX CODE {literal} -->
<script type="text/javascript" charset="utf-8" async="async" src="//www.clicktex.ru/code/45256"></script>
<!-- {/literal} END CLICKTEX CODE -->
<!-- {/literal} END JIVOSITE CODE -->
<!-- BEGIN JIVOSITE INTEGRATION WITH ROISTAT -->
<script type='text/javascript'>
var getCookie = window.getCookie = function (name) {
    var matches = document.cookie.match(new RegExp("(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"));
return matches ? decodeURIComponent(matches[1]) : undefined;
};
function jivo_onLoadCallback() {
    jivo_api.setUserToken(getCookie('roistat_visit'));
    }
</script>
<!-- END JIVOSITE INTEGRATION WITH ROISTAT --> 
  <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-125273923-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-125273923-1');
</script>
  <!-- Yandex.Metrika counter -->
<script type="text/javascript" >
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter35421525 = new Ya.Metrika2({
                    id:35421525,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true,
                    trackHash:true
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/tag.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks2");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/35421525" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
<!-- Rating@Mail.ru counter -->
<script type="text/javascript">
var _tmr = window._tmr || (window._tmr = []);
_tmr.push({id: "3064512", type: "pageView", start: (new Date()).getTime()});
(function (d, w, id) {
  if (d.getElementById(id)) return;
  var ts = d.createElement("script"); ts.type = "text/javascript"; ts.async = true; ts.id = id;
  ts.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//top-fwz1.mail.ru/js/code.js";
  var f = function () {var s = d.getElementsByTagName("script")[0]; s.parentNode.insertBefore(ts, s);};
  if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); }
})(document, window, "topmailru-code");
</script><noscript><div>
<img src="//top-fwz1.mail.ru/counter?id=3064512;js=na" style="border:0;position:absolute;left:-9999px;" alt="" />
</div></noscript>
<!-- //Rating@Mail.ru counter -->
        <section class=" bd-section-4 bd-page-width bd-tagstyles bd-bootstrap-img bd-img-responsive bd-bootstrap-tables bd-table-striped bd-table-bordered bd-table-hover bd-table-condensed bd-table-responsive " id="section4" data-section-title="Two Columns">
    <div class="bd-container-inner bd-margins clearfix">
        <div class=" bd-layoutcontainer-13 bd-page-width  bd-columns bd-no-margins">
    <div class="bd-container-inner">
        <div class="container-fluid">
            <div class="row 
 bd-row-flex 
 bd-row-align-middle">
                <div class=" bd-columnwrapper-24 
 col-md-6
 col-sm-6">
    <div class="bd-layoutcolumn-24 bd-column" ><div class="bd-vertical-align-wrapper"><?php
$app = JFactory::getApplication();
$themeParams = $app->getTemplate(true)->params;
$sitename = $app->getCfg('sitename');
$logoSrc = '';
ob_start();
?>
src="<?php echo JURI::base() . 'templates/' . JFactory::getApplication()->getTemplate(); ?>/images/designer/2c4f323790c241e86a2fac327e52f261_mojaika_10_logo.png"
<?php

$logoSrc = ob_get_clean();
$logoLink = 'https://moz10.ru';

if ($themeParams->get('logoFile'))
    $logoSrc = 'src="' . JURI::root() . $themeParams->get('logoFile') . '"';

if ($themeParams->get('logoLink'))
    $logoLink = $themeParams->get('logoLink');

if (!$logoLink)
    $logoLink = JUri::base(true);

?>
<a class=" bd-logo-6 animated bd-animation-13" data-animation-name="pulse" data-animation-event="hover" data-animation-duration="1000ms" data-animation-delay="0ms" data-animation-infinited="false" href="<?php echo $logoLink; ?>">
<img class="   img-responsive" <?php echo $logoSrc; ?> alt="<?php echo $sitename; ?>">
</a></div></div>
</div>
	
		<div class=" bd-columnwrapper-29 
 col-md-6
 col-sm-6">
    <div class="bd-layoutcolumn-29 bd-column" ><div class="bd-vertical-align-wrapper"><div class=" bd-layoutbox-19 hidden-xs bd-no-margins clearfix">
    <div class="bd-container-inner">
        <p class=" bd-textblock-9 animated bd-animation-12 bd-content-element" data-animation-name="pulse" data-animation-event="onload" data-animation-duration="1000ms" data-animation-delay="0ms" data-animation-infinited="true">
    <?php
echo <<<'CUSTOM_CODE'
<a href="tel:+7(495)788-03-03" draggable="false" class="roistat-phone">+7(495)788-03-03</a><br>
 г. Москва, Можайское шоссе, д.10
<br>На связи 24/7&nbsp;
CUSTOM_CODE;
?>
</p>
    </div>
</div>
	
		<form id="search-4" role="form" class=" bd-search-4 hidden-xs form-inline" name="search" <?php echo funcBuildRoute(JFactory::getDocument()->baseurl . '/index.php', 'action'); ?> method="post">
    <div class="bd-container-inner">
        <input type="hidden" name="task" value="search">
        <input type="hidden" name="option" value="com_search">
        <div class="bd-search-wrapper">
            
                <input type="text" name="searchword" class=" bd-bootstrapinput-9 form-control" placeholder="Поиск">
                <a href="#" class="bd-icon-51 bd-icon " link-disable="true"></a>
        </div>
        <script>
            (function (jQuery, $) {
                jQuery('.bd-search-4 .bd-icon-51').on('click', function (e) {
                    e.preventDefault();
                    jQuery('#search-4').submit();
                });
            })(window._$, window._$);
        </script>
    </div>
</form></div></div>
</div>
            </div>
        </div>
    </div>
</div>
    </div>
</section>
	
		<div data-affix
     data-offset=""
     data-fix-at-screen="top"
     data-clip-at-control="top"
     
 data-enable-lg
     
 data-enable-md
     
 data-enable-sm
     
 data-enable-xs
     class=" bd-affix-5 bd-no-margins bd-margins "><section class=" bd-section-3 bd-page-width bd-tagstyles bd-bootstrap-img bd-img-responsive bd-bootstrap-tables bd-table-striped bd-table-bordered bd-table-hover bd-table-condensed bd-table-responsive  " id="section7" data-section-title="Menu with Search and Social Icons">
    <div class="bd-container-inner bd-margins clearfix">
        <div class=" bd-layoutbox-16 bd-page-width  bd-no-margins clearfix">
    <div class="bd-container-inner">
        <div class=" bd-layoutbox-18 bd-page-width  bd-no-margins clearfix">
    <div class="bd-container-inner">
        <?php
    renderTemplateFromIncludes('hmenu_2', array());
?>
    </div>
</div>
    </div>
</div>
	
		<div class=" bd-layoutbox-5 hidden-md hidden-sm hidden-lg bd-page-width animated bd-animation-3  bd-no-margins clearfix" data-animation-name="pulse" data-animation-event="onload" data-animation-duration="1000ms" data-animation-delay="0ms" data-animation-infinited="true">
    <div class="bd-container-inner">
        <p class=" bd-textblock-17 animated bd-animation-1 bd-content-element" data-animation-name="pulse" data-animation-event="scrollloop" data-animation-duration="1000ms" data-animation-delay="0ms" data-animation-infinited="true">
    <?php
echo <<<'CUSTOM_CODE'
<a href="tel:+7(495)788-03-03" draggable="false" class="roistat-phone">+7(495)788-03-03</a>&nbsp;<br>На связи 24/7&nbsp;
CUSTOM_CODE;
?>
</p>
    </div>
</div>
    </div>
</section></div>
</header>
	
		<div class=" bd-stretchtobottom-7 bd-stretch-to-bottom" data-control-selector=".bd-contentlayout-2">
<div class="bd-contentlayout-2 bd-page-width   bd-sheetstyles-6  bd-no-margins bd-margins" >
    <div class="bd-container-inner">

        <div class="bd-flex-vertical bd-stretch-inner bd-contentlayout-offset">
            
 <?php renderTemplateFromIncludes('sidebar_area_1'); ?>
            <div class="bd-flex-horizontal bd-flex-wide bd-no-margins">
                
 <?php renderTemplateFromIncludes('sidebar_area_3'); ?>
                <div class="bd-flex-vertical bd-flex-wide bd-no-margins">
                    
 <?php renderTemplateFromIncludes('sidebar_area_4'); ?>

                    <div class=" bd-layoutitemsbox-18 bd-flex-wide bd-no-margins">
    <div class=" bd-content-2">
    <?php
            $document = JFactory::getDocument();
            echo $document->view->renderSystemMessages();
    $document->view->componentWrapper('common');
    echo '<jdoc:include type="component" />';
    ?>
</div>
</div>

                    
 <?php renderTemplateFromIncludes('sidebar_area_5'); ?>
                </div>
                
            </div>
            
 <?php renderTemplateFromIncludes('sidebar_area_2'); ?>
        </div>

    </div>
</div></div>
	
		<footer class=" bd-footerarea-1 bd-margins">
        <section class=" bd-section-7 bd-page-width bd-tagstyles bd-bootstrap-img bd-img-responsive bd-bootstrap-tables bd-table-striped bd-table-bordered bd-table-hover bd-table-condensed bd-table-responsive " id="section4" data-section-title="One Сolumn">
    <div class="bd-container-inner bd-margins clearfix">
        <div class=" bd-layoutcontainer-12 bd-page-width  bd-columns bd-no-margins">
    <div class="bd-container-inner">
        <div class="container-fluid">
            <div class="row 
 bd-row-flex 
 bd-row-align-middle">
                <div class=" bd-columnwrapper-23 
 col-xs-12">
    <div class="bd-layoutcolumn-23 bd-column" ><div class="bd-vertical-align-wrapper"><h5 class=" bd-textblock-6 bd-content-element">
    <?php
echo <<<'CUSTOM_CODE'
Cхема проезда
CUSTOM_CODE;
?>
</h5>
	
		<div class="bd-googlemap-6 bd-own-margins   img-responsive ">
    <div class="embed-responsive" style="height: 100%; width: 100%;">
        <iframe class="embed-responsive-item"
                src="//maps.google.com/maps?output=embed&q=клиника Марии Фроловой  &z=18&t=m&hl=ru"></iframe>
    </div>
</div></div></div>
</div>
            </div>
        </div>
    </div>
</div>
    </div>
</section>
	
		<section class=" bd-section-54 bd-page-width bd-tagstyles bd-bootstrap-img bd-img-responsive bd-bootstrap-tables bd-table-striped bd-table-bordered bd-table-hover bd-table-condensed bd-table-responsive " id="section4" data-section-title="Footer Four Columns Dark">
    <div class="bd-container-inner bd-margins clearfix">
        <div class=" bd-layoutcontainer-89 bd-page-width  bd-columns bd-no-margins">
    <div class="bd-container-inner">
        <div class="container-fluid">
            <div class="row 
 bd-row-flex 
 bd-row-align-top">
                <div class=" bd-columnwrapper-283 
 col-md-3
 col-sm-6">
    <div class="bd-layoutcolumn-283 bd-column" ><div class="bd-vertical-align-wrapper"><h2 class=" bd-textblock-3 bd-content-element">
    <?php
echo <<<'CUSTOM_CODE'
О клинике
CUSTOM_CODE;
?>
</h2>
	
		<div class=" bd-spacer-2 clearfix"></div>
	
		<?php
$app = JFactory::getApplication();
$themeParams = $app->getTemplate(true)->params;
$sitename = $app->getCfg('sitename');
$logoSrc = '';
ob_start();
?>
src="<?php echo JURI::base() . 'templates/' . JFactory::getApplication()->getTemplate(); ?>/images/designer/ad6f35c185efa3661c25e7548ead253a_mojaika_10_logo.png"
<?php

$logoSrc = ob_get_clean();
$logoLink = 'https://moz10.ru';

if ($themeParams->get('logoFile'))
    $logoSrc = 'src="' . JURI::root() . $themeParams->get('logoFile') . '"';

if ($themeParams->get('logoLink'))
    $logoLink = $themeParams->get('logoLink');

if (!$logoLink)
    $logoLink = JUri::base(true);

?>
<a class=" bd-logo-2" href="<?php echo $logoLink; ?>">
<img class="   img-responsive" <?php echo $logoSrc; ?> alt="<?php echo $sitename; ?>">
</a>
	
		<div class=" bd-spacer-5 clearfix"></div>
	
		<p class=" bd-textblock-376 bd-content-element">
    <?php
echo <<<'CUSTOM_CODE'
ПЕРВЫЙ&nbsp;<br style="margin: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; line-height: inherit; font-family: &quot;Roboto Condensed&quot;, Helvetica, sans-serif; outline: none; letter-spacing: 0.6px; text-transform: uppercase; background-color: rgb(109, 145, 203);">МОСКОВСКИЙ&nbsp;<br style="margin: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; line-height: inherit; font-family: &quot;Roboto Condensed&quot;, Helvetica, sans-serif; outline: none; letter-spacing: 0.6px; text-transform: uppercase; background-color: rgb(109, 145, 203);">МЕДИЦИНСКИЙ ЦЕНТР&nbsp;<br style="margin: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; line-height: inherit; font-family: &quot;Roboto Condensed&quot;, Helvetica, sans-serif; outline: none; letter-spacing: 0.6px; text-transform: uppercase; background-color: rgb(109, 145, 203);">МАРИИ ФРОЛОВОЙ<br><a href="//odisseya.github.io/moz10/articles/620-garantiya-vozvrata-sredstv-esli-lechenie-vam-ne-pomozhet" style="background-position: 0px 0px; background-color: rgb(109, 145, 203); margin: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; line-height: inherit; font-family: &quot;Roboto Condensed&quot;, Helvetica, sans-serif; outline: 0px;" draggable="false">*Мы гарантируем эффективность лечения, при условии соблюдения всех рекомендаций врача</a><br><br>
CUSTOM_CODE;
?>
</p></div></div>
</div>
	
		<div class=" bd-columnwrapper-285 
 col-md-3
 col-sm-6">
    <div class="bd-layoutcolumn-285 bd-column" ><div class="bd-vertical-align-wrapper"><h2 class=" bd-textblock-378 bd-content-element">
    <?php
echo <<<'CUSTOM_CODE'
контакты
CUSTOM_CODE;
?>
</h2>
	
		<div class=" bd-spacer-7 clearfix"></div>
	
		<div class=" bd-layoutbox-3 bd-no-margins clearfix">
    <div class="bd-container-inner">
        <span class="bd-iconlink-1 bd-own-margins bd-icon-7 bd-icon "></span>
	
		<p class=" bd-textblock-382 bd-no-margins bd-content-element">
    <?php
echo <<<'CUSTOM_CODE'
121374, Россия, г. Москва, Можайское шоссе, д.10<br>&nbsp;На&nbsp;связи 24/7, без праздников и выходных.
CUSTOM_CODE;
?>
</p>
    </div>
</div>
	
		<div class=" bd-spacer-9 clearfix"></div>
	
		<div class=" bd-layoutbox-7 bd-no-margins clearfix">
    <div class="bd-container-inner">
        <span class="bd-iconlink-3 bd-own-margins bd-icon-11 bd-icon "></span>
	
		<p class=" bd-textblock-13 bd-no-margins bd-content-element">
    <?php
echo <<<'CUSTOM_CODE'
<a href="tel:+7(495)788-03-03" draggable="false" class="roistat-phone">+7(495)788-03-03</a>&nbsp;<br>На связи 24/7&nbsp;
CUSTOM_CODE;
?>
</p>
    </div>
</div>
	
		<div class=" bd-spacer-11 clearfix"></div>
	
		<div class=" bd-layoutbox-11 bd-no-margins clearfix">
    <div class="bd-container-inner">
        <span class="bd-iconlink-10 bd-own-margins bd-icon-52 bd-icon "></span>
	
		<p class=" bd-textblock-19 bd-no-margins bd-content-element">
    <?php
echo <<<'CUSTOM_CODE'
<a href="mailto:info@moz10.ru">info@moz10.ru</a><br><a href="#" draggable="false">//odisseya.github.io/moz10/</a>
CUSTOM_CODE;
?>
</p>
    </div>
</div></div></div>
</div>
	
		<div class=" bd-columnwrapper-289 
 col-md-3
 col-sm-6">
    <div class="bd-layoutcolumn-289 bd-column" ><div class="bd-vertical-align-wrapper"><h2 class=" bd-textblock-23 bd-content-element">
    <?php
echo <<<'CUSTOM_CODE'
Навигация
CUSTOM_CODE;
?>
</h2>
	
		<div class=" bd-spacer-13 clearfix"></div>
	
		<p class=" bd-textblock-26 bd-no-margins bd-content-element">
    <?php
echo <<<'CUSTOM_CODE'
<a href="//odisseya.github.io/moz10/garantiya-polnoj-anonimnosti">Гарантия полной анонимности</a>
CUSTOM_CODE;
?>
</p>
	
		<div class="bd-separator-2  bd-separator-center bd-separator-content-center clearfix" >
    <div class="bd-container-inner">
        <div class="bd-separator-inner">
            
        </div>
    </div>
</div>
	
		<p class=" bd-textblock-28 bd-no-margins bd-content-element">
    <?php
echo <<<'CUSTOM_CODE'
<a href="//odisseya.github.io/moz10/politika-konfidentsialnosti">Политика кондифицальности</a>
CUSTOM_CODE;
?>
</p>
	
		<div class="bd-separator-8  bd-separator-center bd-separator-content-center clearfix" >
    <div class="bd-container-inner">
        <div class="bd-separator-inner">
            
        </div>
    </div>
</div>
	
		<p class=" bd-textblock-30 bd-no-margins bd-content-element">
    <?php
echo <<<'CUSTOM_CODE'
<a href="//odisseya.github.io/moz10/vse-otzyvy">Все отзывы</a>&nbsp;
CUSTOM_CODE;
?>
</p>
	
		<div class="bd-separator-12  bd-separator-center bd-separator-content-center clearfix" >
    <div class="bd-container-inner">
        <div class="bd-separator-inner">
            
        </div>
    </div>
</div>
	
		<p class=" bd-textblock-32 bd-no-margins bd-content-element">
    <?php
echo <<<'CUSTOM_CODE'
<a href="//odisseya.github.io/moz10/tsentr-reabilitatsii">Центр реабилитации</a>
CUSTOM_CODE;
?>
</p>
	
		<div class="bd-separator-16  bd-separator-center bd-separator-content-center clearfix" >
    <div class="bd-container-inner">
        <div class="bd-separator-inner">
            
        </div>
    </div>
</div>
	
		<p class=" bd-textblock-34 bd-no-margins bd-content-element">
    <?php
echo <<<'CUSTOM_CODE'
<a href="//odisseya.github.io/moz10/gruppy-dlya-sozavisimykh">Группы для созависимых</a>
CUSTOM_CODE;
?>
</p></div></div>
</div>
	
		<div class=" bd-columnwrapper-26 
 col-md-3
 col-sm-6">
    <div class="bd-layoutcolumn-26 bd-column" ><div class="bd-vertical-align-wrapper"><div class=" bd-spacer-15 clearfix"></div>
	
		<div class="bd-separator-20  bd-separator-center bd-separator-content-center clearfix" >
    <div class="bd-container-inner">
        <div class="bd-separator-inner">
            
        </div>
    </div>
</div>
	
		<p class=" bd-textblock-42 bd-no-margins bd-content-element">
    <?php
echo <<<'CUSTOM_CODE'
<a href="//odisseya.github.io/moz10/rodstvennikam">Родственникам</a>
CUSTOM_CODE;
?>
</p>
	
		<div class="bd-separator-22  bd-separator-center bd-separator-content-center clearfix" >
    <div class="bd-container-inner">
        <div class="bd-separator-inner">
            
        </div>
    </div>
</div>
	
		<p class=" bd-textblock-46 bd-no-margins bd-content-element">
    <?php
echo <<<'CUSTOM_CODE'
<a href="//odisseya.github.io/moz10/index.php?option=com_jmap&amp;view=sitemap">Карта сайта</a>
CUSTOM_CODE;
?>
</p>
	
		<h5 class=" bd-textblock-4 bd-content-element">
    <?php
echo <<<'CUSTOM_CODE'
Мы в соц сетях&nbsp;
CUSTOM_CODE;
?>
</h5>
	
		<a class="bd-iconlink-4 bd-own-margins bd-iconlink " href="https://www.facebook.com/moz10.ru/"
 target="_blank">
    <span class="bd-icon-16 bd-icon "></span>
</a>
	
		<a class="bd-iconlink-25 bd-own-margins bd-iconlink " href="https://ok.ru/group/53307417362638/"
 target="_blank">
    <span class="bd-icon-97 bd-icon "></span>
</a>
	
		<a class="bd-iconlink-22 bd-own-margins bd-iconlink " href="https://vk.com/moz10"
 target="_blank">
    <span class="bd-icon-94 bd-icon "></span>
</a>
	
		<a class="bd-iconlink-19 bd-own-margins bd-iconlink " href="https://www.youtube.com/channel/UCiRryWyf3wAU0hzRKVf86_Q"
 target="_blank">
    <span class="bd-icon-91 bd-icon "></span>
</a>
	
		<a class="bd-iconlink-16 bd-own-margins bd-iconlink " href="https://twitter.com/moz10_ru/"
 target="_blank">
    <span class="bd-icon-86 bd-icon "></span>
</a>
	
		<a class="bd-iconlink-8 bd-own-margins bd-iconlink " href="https://www.instagram.com/medmariafrolova/"
 target="_blank">
    <span class="bd-icon-58 bd-icon "></span>
</a></div></div>
</div>
            </div>
        </div>
    </div>
</div>
	
		<div class=" bd-layoutbox-4 bd-page-width  bd-no-margins clearfix">
    <div class="bd-container-inner">
        <p class=" bd-textblock-15 bd-content-element">
    <?php
echo <<<'CUSTOM_CODE'
<b>&nbsp;Материалы, размещенные на сайте , носят исключительно информационный характер и не могут использоваться в качестве медицинских рекомендаций. Постановка диагноза и выбор методики лечения остается прерогативой Вашего лечащего врача! Специальные предложения и цены не являются офертой! Необходима консультация специалиста!</b><br><b>&nbsp;Согласно части 5 ст.15 Федерального Закона №326-ФЗ от 29.11.2010 года «Об обязательном медицинском страховании в Российской Федерации» граждане имеют возможность получить соответствующие виды и объемы медицинской помощи без взимания платы в рамках программы государственных гарантий бесплатного оказания гражданам медицинской помощи и территориальной программы государственных гарантий бесплатного оказания гражданам медицинской помощи в медицинских организациях, участвующих в указанных программах.</b><br>Копирование материалов разрешено только с указанием прямой ссылки на&nbsp; &nbsp;moz10.ru<br>Государственная лицензия № ЛО-77-01-017222<br><br>Все права защищены © 2017<br>
CUSTOM_CODE;
?>
</p>
    </div>
</div>
    </div>
</section>
</footer>
	
		<div data-smooth-scroll data-animation-time="250" class=" bd-smoothscroll-3"><a href="#" class=" bd-backtotop-1 ">
    <span class="bd-icon-66 bd-icon "></span>
</a></div>
</body>
</html>