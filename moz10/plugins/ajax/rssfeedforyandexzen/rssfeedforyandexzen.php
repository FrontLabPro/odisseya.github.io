<?php defined('_JEXEC') or die;

jimport('joomla.plugin.plugin');

class plgAjaxRssfeedforyandexzen extends JPlugin
{
	
	function onAjaxRssfeedforyandexzen()
	{

		jimport( 'joomla.version' );
		jimport ('joomla.utilities.date');
		jimport( 'joomla.filesystem.folder' );


		$jversion = new JVersion();
		$currentVersion = $jversion->getShortVersion();

		if (strstr($currentVersion,'2.5')) {

			JModelLegacy::addIncludePath(JPATH_ADMINISTRATOR.'/components/com_content/models', 'ContentModel');
		
			jimport('joomla.application.categories');

		}

		$nowtimeserver = date('Y-m-d H:i:s');
		$nowtime = JHtml::_('date', $nowtimeserver, 'Y-m-d H:i:s', JFactory::getApplication()->getCfg('offset'), true);
		$licq = 'Need correct licence key. Please contact me: https://jturbo.ru/';
		$cache = JFactory::getCache('ajax', '');
		$zenfeed_who = $this->params->get('zenfeed_who');
		$zenfeed_lickey = $this->params->get('zenfeed_lickey');
		$zenfeed_cache = $this->params->get('zenfeed_cache');
		$zenfeed_cache_time = $this->params->get('zenfeed_cache_time',5);
		$zenfeed_site_db_limit = $this->params->get('zenfeed_site_db_limit',10);
		$zenfeed_site_jbzoo_turbo = 1;
		$zenfeed_xmlfeed = $this->params->get('zenfeed_xmlfeed',1);
		$zenfeed_img_domain = $this->params->get('zenfeed_img_domain',0);
		$zenfeed_error_off = $this->params->get('zenfeed_error_off',1);
		$zenfeed_images_path = $this->params->get('zenfeed_images_path',0);
		$zenfeed_site_jbzoo_turbo_li = $this->params->get('zenfeed_site_jbzoo_turbo_li',0);
		$zenfeed_site_snippet_top = $this->params->get('zenfeed_site_snippet_top',0);
		$zenfeed_site_snippet_center = $this->params->get('zenfeed_site_snippet_center',0);
		$zenfeed_site_snippet_bottom = $this->params->get('zenfeed_site_snippet_bottom',0);
		$zenfeed_delete_noturbotag = $this->params->get('zenfeed_delete_noturbotag',0);
		$zenfeed_comcontent_descmini = $this->params->get('zenfeed_comcontent_descmini',0);
		$zenfeed_comyouthemepro_descmini = $this->params->get('zenfeed_comyouthemepro_descmini',0);
		$zenfeed_comcontent_sef_itemid = $this->params->get('zenfeed_comcontent_sef_itemid',0);
		$zenfeed_comcontent_sef_itemid_num = $this->params->get('zenfeed_comcontent_sef_itemid_num');
		$zenfeed_comyouthemepro_sef_itemid = $this->params->get('zenfeed_comyouthemepro_sef_itemid',0);
		$zenfeed_comyouthemepro_sef_itemid_num = $this->params->get('zenfeed_comyouthemepro_sef_itemid_num');
		$zenfeed_comcontent_descmini_count = $this->params->get('zenfeed_comcontent_descmini_count');
		$zenfeed_comcontent_descmini_striptags = $this->params->get('zenfeed_comcontent_descmini_striptags');
		$zenfeed_comyouthemepro_descmini_count = $this->params->get('zenfeed_comyouthemepro_descmini_count');
		$zenfeed_comcontent_descmini_striptags = $this->params->get('zenfeed_comcontent_descmini_striptags');
		$zenfeed_comyouthemepro_descmini_striptags = $this->params->get('zenfeed_comyouthemepro_descmini_striptags');
		$zenfeed_site_snippet_top_text = $this->params->get('zenfeed_site_snippet_top_text');
		$zenfeed_site_snippet_center_text = $this->params->get('zenfeed_site_snippet_center_text');
		$zenfeed_site_snippet_bottom_text = $this->params->get('zenfeed_site_snippet_bottom_text');
		$zenfeed_site_jbzoo_turbo_yaid = $this->params->get('zenfeed_site_jbzoo_turbo_yaid');
		$zenfeed_site_jbzoo_turbo_googleid = $this->params->get('zenfeed_site_jbzoo_turbo_googleid');
		$zenfeed_site_jbzoo_turbo_ya_rsya = $this->params->get('zenfeed_site_jbzoo_turbo_ya_rsya');
		$zenfeed_site_jbzoo_turbo_ya_rsya2 = $this->params->get('zenfeed_site_jbzoo_turbo_ya_rsya2');
		$zenfeed_site_jbzoo_turbo_ya_rsya3 = $this->params->get('zenfeed_site_jbzoo_turbo_ya_rsya3');
		$zenfeed_site_jbzoo_turbo_ad_fox = $this->params->get('zenfeed_site_jbzoo_turbo_ad_fox');
		$zenfeed_site_jbzoo_turbo_ad_fox_container = $this->params->get('zenfeed_site_jbzoo_turbo_ad_fox_container');
		$zenfeed_site_rss_limit = $this->params->get('zenfeed_site_rss_limit');
		$zenfeed_cat_replace = $this->params->get('zenfeed_cat_replace');
		$zenfeed_cat_replace_catname = $this->params->get('zenfeed_cat_replace_catname');
		$zenfeed_cat_replace_jbzoo = $this->params->get('zenfeed_cat_replace_jbzoo');
		$zenfeed_cat_replace_jbzoo_element_checkbox = $this->params->get('zenfeed_cat_replace_jbzoo_element_checkbox');
		$zenfeed_com_content_filterstriptags = $this->params->get('zenfeed_com_content_filterstriptags');
		$zenfeed_com_youthemepro_filterstriptags = $this->params->get('zenfeed_com_youthemepro_filterstriptags');
		$zenfeed_comcontent_introimage = $this->params->get('zenfeed_comcontent_introimage');
		$zenfeed_comcontent_fullimage = $this->params->get('zenfeed_comcontent_fullimage');
		$zenfeed_comcontent_striptags = $this->params->get('zenfeed_comcontent_striptags',1);
		$zenfeed_comcontent_previmage = $this->params->get('zenfeed_comcontent_previmage',0);
		$zenfeed_comcontent_imagetotopplease = $this->params->get('zenfeed_comcontent_imagetotopplease',0);
		$zenfeed_comcontent_figurealt = $this->params->get('zenfeed_comcontent_figurealt',0);
		$zenfeed_comcontent_biem = $this->params->get('zenfeed_comcontent_biem',0);
		$zenfeed_comcontent_pre = $this->params->get('zenfeed_comcontent_pre',0);
		$zenfeed_comyouthemepro_biem = $this->params->get('zenfeed_comyouthemepro_biem',0);
		$zenfeed_comyouthemepro_pre = $this->params->get('zenfeed_comyouthemepro_pre',0);
		$zenfeed_comyouthemepro_introimage = $this->params->get('zenfeed_comyouthemepro_introimage');
		$zenfeed_comyouthemepro_fullimage = $this->params->get('zenfeed_comyouthemepro_fullimage');
		$zenfeed_comyouthemepro_striptags = $this->params->get('zenfeed_comyouthemepro_striptags',1);
		$zenfeed_comyouthemepro_previmage = $this->params->get('zenfeed_comyouthemepro_previmage',0);
		$zenfeed_comyouthemepro_imagetotopplease = $this->params->get('zenfeed_comyouthemepro_imagetotopplease',0);
		$zenfeed_comcontent_biem = $this->params->get('zenfeed_comcontent_biem',0);
		$zenfeed_comcontent_pre = $this->params->get('zenfeed_comcontent_pre',0);
		$zenfeed_comcontent_introtofull = $this->params->get('zenfeed_comcontent_introtofull',0);
		$zenfeed_comcontent_introtofull_fixempty = $this->params->get('zenfeed_comcontent_introtofull_fixempty',0);
		$zenfeed_comyouthemepro_introtofull = $this->params->get('zenfeed_comyouthemepro_introtofull',0);
		$zenfeed_comyouthemepro_introtofull_fixempty = $this->params->get('zenfeed_comyouthemepro_introtofull_fixempty',0);
		$zenfeed_comcontent_pre_text = $this->params->get('zenfeed_comcontent_pre_text');
		$zenfeed_comyouthemepro_pre_text = $this->params->get('zenfeed_comyouthemepro_pre_text');
		$zenfeed_site_pwdturbo = $this->params->get('zenfeed_site_pwdturbo');
		$zenfeed_site_pwd_zen = $this->params->get('zenfeed_site_pwd_zen');
		$zenfeed_sitename = $this->params->get('zenfeed_sitename');
		$zenfeed_sitedesc = $this->params->get('zenfeed_sitedesc');
		$zenfeed_sitelang = $this->params->get('zenfeed_sitelang');
		$zenfeed_site_defauthor = $this->params->get('zenfeed_site_defauthor');
		$zenfeed_site_defauthor_set = $this->params->get('zenfeed_site_defauthor_set');
		$zenfeed_site_defauthor_set_fix = $this->params->get('zenfeed_site_defauthor_set_fix');
		$zenfeed_comcontent_fields = $this->params->get('zenfeed_comcontent_fields',0);
		$zenfeed_comcontent_fields_author_name = $this->params->get('zenfeed_comcontent_fields_author_name');
		$zenfeed_site_time = $this->params->get('zenfeed_site_time');
		$zenfeed_com_content_catid = $this->params->get('zenfeed_com_content_catid');
		$zenfeed_com_youthemepro_catid = $this->params->get('zenfeed_com_youthemepro_catid');
		$zenfeed_site_jbzoo_app = $this->params->get('zenfeed_site_jbzoo_app');
		$zenfeed_site_jbzoo_catid = $this->params->get('zenfeed_site_jbzoo_catid');
		$zenfeed_site_jbzoo_image = $this->params->get('zenfeed_site_jbzoo_image');
		$zenfeed_site_jbzoo_descpreview = $this->params->get('zenfeed_site_jbzoo_descpreview');
		$zenfeed_site_jbzoo_descfull = $this->params->get('zenfeed_site_jbzoo_descfull');
		$zenfeed_site_jbzoo_type = $this->params->get('zenfeed_site_jbzoo_type');
		$zenfeed_site_jbzoo_category_nested = $this->params->get('zenfeed_site_jbzoo_category_nested');
		$zenfeed_comcontent_introimage = $this->params->get('zenfeed_comcontent_introimage');
		$zenfeed_comcontent_fullimage = $this->params->get('zenfeed_comcontent_fullimage');
		$zenfeed_global_youtube = $this->params->get('zenfeed_global_youtube',0);
		$zenfeed_global_squarebrackets = $this->params->get('zenfeed_global_squarebrackets',1);
		$zenfeed_global_classes = $this->params->get('zenfeed_global_classes',0);
		$zenfeed_global_classes_textarea = $this->params->get('zenfeed_global_classes_textarea');
		$zenfeed_comcontent_striptags = $this->params->get('zenfeed_comcontent_striptags',1);
		$zenfeed_k2_noimage = $this->params->get('zenfeed_k2_noimage',0);
		$zenfeed_com_content_catid_k2 = $this->params->get('zenfeed_com_content_catid_k2');
		$zenfeed_comcontent_previmage_k2 = $this->params->get('zenfeed_comcontent_previmage_k2',0);
		$zenfeed_comcontent_imagetotopplease_k2 = $this->params->get('zenfeed_comcontent_imagetotopplease_k2',0);
		$zenfeed_comcontent_k2_extrafields = $this->params->get('zenfeed_comcontent_k2_extrafields',0);
		$zenfeed_comcontent_k2_extrafields_alias = $this->params->get('zenfeed_comcontent_k2_extrafields_alias');
		$zenfeed_comcontent_striptags_k2 = $this->params->get('zenfeed_comcontent_striptags_k2',1);
		$zenfeed_com_content_filterstriptags_k2 = $this->params->get('zenfeed_com_content_filterstriptags_k2');
		$zenfeed_comcontent_biem_k2 = $this->params->get('zenfeed_comcontent_biem_k2',0);
		$zenfeed_comcontent_introtofull_k2 = $this->params->get('zenfeed_comcontent_introtofull_k2',0);
		$zenfeed_comcontent_pre_k2 = $this->params->get('zenfeed_comcontent_pre_k2',0);
		$zenfeed_comcontent_pre_text_k2 = $this->params->get('zenfeed_comcontent_pre_text_k2');
		$zenfeed_comcontent_descmini_k2 = $this->params->get('zenfeed_comcontent_descmini_k2');
		$zenfeed_comcontent_descmini_count_k2 = $this->params->get('zenfeed_comcontent_descmini_count_k2');
		$zenfeed_comcontent_descmini_striptags_k2 = $this->params->get('zenfeed_comcontent_descmini_striptags_k2',0);
		$zenfeed_comcontent_publish_k2 = $this->params->get('zenfeed_comcontent_publish_k2',0);
		$zenfeed_comcontent_k2_lang = $this->params->get('zenfeed_comcontent_k2_lang','');
		$zenfeed_comcontent_k2_gallery = $this->params->get('zenfeed_comcontent_k2_gallery',0);
		$zenfeed_comcontent_k2_img_size = $this->params->get('zenfeed_comcontent_k2_img_size',0);
		$zenfeed_comcontent_k2_video = $this->params->get('zenfeed_comcontent_k2_video',0);
		$zenfeed_comcontent_k2_related_articles = $this->params->get('zenfeed_comcontent_k2_related_articles',0);
		$zenfeed_comcontent_k2_related_articles_text_count = $this->params->get('zenfeed_comcontent_k2_related_articles_text_count',5);
		$zenfeed_comcontent_k2_related_articles_text = $this->params->get('zenfeed_comcontent_k2_related_articles_text');
		$zenfeed_comcontent_k2_related_articles_text_tag = $this->params->get('zenfeed_comcontent_k2_related_articles_text_tag');
		$zenfeed_comcontent_k2_related_articles_block = $this->params->get('zenfeed_comcontent_k2_related_articles_block');
		$zenfeed_comcontent_k2_related_articles_block_img = $this->params->get('zenfeed_comcontent_k2_related_articles_block_img',0);

		$zenfeed_site_db_random = $this->params->get('zenfeed_site_db_random', 10);

		$zenfeed_site_jbzoo_gen_on_1 = $this->params->get('zenfeed_site_jbzoo_gen_on_1',0);
		$zenfeed_site_jbzoo_app_alltypes_1 = $this->params->get('zenfeed_site_jbzoo_app_alltypes_1');
		$zenfeed_site_jbzoo_type_alltypes_1 = $this->params->get('zenfeed_site_jbzoo_type_alltypes_1');
		$zenfeed_site_jbzoo_catid_alltypes_1 = $this->params->get('zenfeed_site_jbzoo_catid_alltypes_1');
		$zenfeed_site_jbzoo_image_alltypes_1 = $this->params->get('zenfeed_site_jbzoo_image_alltypes_1');
		$zenfeed_site_jbzoo_descpreview_alltypes_1 = $this->params->get('zenfeed_site_jbzoo_descpreview_alltypes_1');
		$zenfeed_site_jbzoo_descfull_alltypes_1 = $this->params->get('zenfeed_site_jbzoo_descfull_alltypes_1');
		$zenfeed_site_jbzoo_descpreview_alltypes_gen_1 = $this->params->get('zenfeed_site_jbzoo_descpreview_alltypes_gen_1',0);
		$zenfeed_site_jbzoo_descpreview_descmini_1 = $this->params->get('zenfeed_site_jbzoo_descpreview_descmini_1',1);
		$zenfeed_site_jbzoo_descpreview_descmini_count_1 = $this->params->get('zenfeed_site_jbzoo_descpreview_descmini_count_1',0);
		$zenfeed_site_jbzoo_descpreview_descmini_striptags_1 = $this->params->get('zenfeed_site_jbzoo_descpreview_descmini_striptags_1',1);
		$zenfeed_cat_replace_jbzoo_element_checkbox_alltypes_1 = $this->params->get('zenfeed_cat_replace_jbzoo_element_checkbox_alltypes_1');
		$zenfeed_site_jbzoo_category_nested_alltypes_1 = $this->params->get('zenfeed_site_jbzoo_category_nested_alltypes_1',1);

		$zenfeed_site_jbzoo_gen_on_2 = $this->params->get('zenfeed_site_jbzoo_gen_on_2',0);
		$zenfeed_site_jbzoo_app_alltypes_2 = $this->params->get('zenfeed_site_jbzoo_app_alltypes_2');
		$zenfeed_site_jbzoo_type_alltypes_2 = $this->params->get('zenfeed_site_jbzoo_type_alltypes_2');
		$zenfeed_site_jbzoo_catid_alltypes_2 = $this->params->get('zenfeed_site_jbzoo_catid_alltypes_2');
		$zenfeed_site_jbzoo_image_alltypes_2 = $this->params->get('zenfeed_site_jbzoo_image_alltypes_2');
		$zenfeed_site_jbzoo_descpreview_alltypes_2 = $this->params->get('zenfeed_site_jbzoo_descpreview_alltypes_2');
		$zenfeed_site_jbzoo_descfull_alltypes_2 = $this->params->get('zenfeed_site_jbzoo_descfull_alltypes_2');
		$zenfeed_site_jbzoo_descpreview_alltypes_gen_2 = $this->params->get('zenfeed_site_jbzoo_descpreview_alltypes_gen_2',0);
		$zenfeed_site_jbzoo_descpreview_descmini_2 = $this->params->get('zenfeed_site_jbzoo_descpreview_descmini_2',1);
		$zenfeed_site_jbzoo_descpreview_descmini_count_2 = $this->params->get('zenfeed_site_jbzoo_descpreview_descmini_count_2',0);
		$zenfeed_site_jbzoo_descpreview_descmini_striptags_2 = $this->params->get('zenfeed_site_jbzoo_descpreview_descmini_striptags_2',1);
		$zenfeed_cat_replace_jbzoo_element_checkbox_alltypes_2 = $this->params->get('zenfeed_cat_replace_jbzoo_element_checkbox_alltypes_2');
		$zenfeed_site_jbzoo_category_nested_alltypes_2 = $this->params->get('zenfeed_site_jbzoo_category_nested_alltypes_2',1);

		$zenfeed_site_jbzoo_gen_on_3 = $this->params->get('zenfeed_site_jbzoo_gen_on_3',0);
		$zenfeed_site_jbzoo_app_alltypes_3 = $this->params->get('zenfeed_site_jbzoo_app_alltypes_3');
		$zenfeed_site_jbzoo_type_alltypes_3 = $this->params->get('zenfeed_site_jbzoo_type_alltypes_3');
		$zenfeed_site_jbzoo_catid_alltypes_3 = $this->params->get('zenfeed_site_jbzoo_catid_alltypes_3');
		$zenfeed_site_jbzoo_image_alltypes_3 = $this->params->get('zenfeed_site_jbzoo_image_alltypes_3');
		$zenfeed_site_jbzoo_descpreview_alltypes_3 = $this->params->get('zenfeed_site_jbzoo_descpreview_alltypes_3');
		$zenfeed_site_jbzoo_descfull_alltypes_3 = $this->params->get('zenfeed_site_jbzoo_descfull_alltypes_3');
		$zenfeed_site_jbzoo_descpreview_alltypes_gen_3 = $this->params->get('zenfeed_site_jbzoo_descpreview_alltypes_gen_3',0);
		$zenfeed_site_jbzoo_descpreview_descmini_3 = $this->params->get('zenfeed_site_jbzoo_descpreview_descmini_3',1);
		$zenfeed_site_jbzoo_descpreview_descmini_count_3 = $this->params->get('zenfeed_site_jbzoo_descpreview_descmini_count_3',0);
		$zenfeed_site_jbzoo_descpreview_descmini_striptags_3 = $this->params->get('zenfeed_site_jbzoo_descpreview_descmini_striptags_3',1);
		$zenfeed_cat_replace_jbzoo_element_checkbox_alltypes_3 = $this->params->get('zenfeed_cat_replace_jbzoo_element_checkbox_alltypes_3');
		$zenfeed_site_jbzoo_category_nested_alltypes_3 = $this->params->get('zenfeed_site_jbzoo_category_nested_alltypes_3',1);

		$zenfeed_site_jbzoo_gen_on_4 = $this->params->get('zenfeed_site_jbzoo_gen_on_4',0);
		$zenfeed_site_jbzoo_app_alltypes_4 = $this->params->get('zenfeed_site_jbzoo_app_alltypes_4');
		$zenfeed_site_jbzoo_type_alltypes_4 = $this->params->get('zenfeed_site_jbzoo_type_alltypes_4');
		$zenfeed_site_jbzoo_catid_alltypes_4 = $this->params->get('zenfeed_site_jbzoo_catid_alltypes_4');
		$zenfeed_site_jbzoo_image_alltypes_4 = $this->params->get('zenfeed_site_jbzoo_image_alltypes_4');
		$zenfeed_site_jbzoo_descpreview_alltypes_4 = $this->params->get('zenfeed_site_jbzoo_descpreview_alltypes_4');
		$zenfeed_site_jbzoo_descfull_alltypes_4 = $this->params->get('zenfeed_site_jbzoo_descfull_alltypes_4');
		$zenfeed_site_jbzoo_descpreview_alltypes_gen_4 = $this->params->get('zenfeed_site_jbzoo_descpreview_alltypes_gen_4',0);
		$zenfeed_site_jbzoo_descpreview_descmini_4 = $this->params->get('zenfeed_site_jbzoo_descpreview_descmini_4',1);
		$zenfeed_site_jbzoo_descpreview_descmini_count_4 = $this->params->get('zenfeed_site_jbzoo_descpreview_descmini_count_4',0);
		$zenfeed_site_jbzoo_descpreview_descmini_striptags_4 = $this->params->get('zenfeed_site_jbzoo_descpreview_descmini_striptags_4',1);
		$zenfeed_cat_replace_jbzoo_element_checkbox_alltypes_4 = $this->params->get('zenfeed_cat_replace_jbzoo_element_checkbox_alltypes_4');
		$zenfeed_site_jbzoo_category_nested_alltypes_4 = $this->params->get('zenfeed_site_jbzoo_category_nested_alltypes_4',1);

		$zenfeed_site_jbzoo_gen_on_5 = $this->params->get('zenfeed_site_jbzoo_gen_on_5',0);
		$zenfeed_site_jbzoo_app_alltypes_5 = $this->params->get('zenfeed_site_jbzoo_app_alltypes_5');
		$zenfeed_site_jbzoo_type_alltypes_5 = $this->params->get('zenfeed_site_jbzoo_type_alltypes_5');
		$zenfeed_site_jbzoo_catid_alltypes_5 = $this->params->get('zenfeed_site_jbzoo_catid_alltypes_5');
		$zenfeed_site_jbzoo_image_alltypes_5 = $this->params->get('zenfeed_site_jbzoo_image_alltypes_5');
		$zenfeed_site_jbzoo_descpreview_alltypes_5 = $this->params->get('zenfeed_site_jbzoo_descpreview_alltypes_5');
		$zenfeed_site_jbzoo_descfull_alltypes_5 = $this->params->get('zenfeed_site_jbzoo_descfull_alltypes_5');
		$zenfeed_site_jbzoo_descpreview_alltypes_gen_5 = $this->params->get('zenfeed_site_jbzoo_descpreview_alltypes_gen_5',0);
		$zenfeed_site_jbzoo_descpreview_descmini_5 = $this->params->get('zenfeed_site_jbzoo_descpreview_descmini_5',1);
		$zenfeed_site_jbzoo_descpreview_descmini_count_5 = $this->params->get('zenfeed_site_jbzoo_descpreview_descmini_count_5',0);
		$zenfeed_site_jbzoo_descpreview_descmini_striptags_5 = $this->params->get('zenfeed_site_jbzoo_descpreview_descmini_striptags_5',1);
		$zenfeed_cat_replace_jbzoo_element_checkbox_alltypes_5 = $this->params->get('zenfeed_cat_replace_jbzoo_element_checkbox_alltypes_5');
		$zenfeed_site_jbzoo_category_nested_alltypes_5 = $this->params->get('zenfeed_site_jbzoo_category_nested_alltypes_5',1);

		$zenfeed_site_jbzoo_gen_on_6 = $this->params->get('zenfeed_site_jbzoo_gen_on_6',0);
		$zenfeed_site_jbzoo_app_alltypes_6 = $this->params->get('zenfeed_site_jbzoo_app_alltypes_6');
		$zenfeed_site_jbzoo_type_alltypes_6 = $this->params->get('zenfeed_site_jbzoo_type_alltypes_6');
		$zenfeed_site_jbzoo_catid_alltypes_6 = $this->params->get('zenfeed_site_jbzoo_catid_alltypes_6');
		$zenfeed_site_jbzoo_image_alltypes_6 = $this->params->get('zenfeed_site_jbzoo_image_alltypes_6');
		$zenfeed_site_jbzoo_descpreview_alltypes_6 = $this->params->get('zenfeed_site_jbzoo_descpreview_alltypes_6');
		$zenfeed_site_jbzoo_descfull_alltypes_6 = $this->params->get('zenfeed_site_jbzoo_descfull_alltypes_6');
		$zenfeed_site_jbzoo_descpreview_alltypes_gen_6 = $this->params->get('zenfeed_site_jbzoo_descpreview_alltypes_gen_6',0);
		$zenfeed_site_jbzoo_descpreview_descmini_6 = $this->params->get('zenfeed_site_jbzoo_descpreview_descmini_6',1);
		$zenfeed_site_jbzoo_descpreview_descmini_count_6 = $this->params->get('zenfeed_site_jbzoo_descpreview_descmini_count_6',0);
		$zenfeed_site_jbzoo_descpreview_descmini_striptags_6 = $this->params->get('zenfeed_site_jbzoo_descpreview_descmini_striptags_6',1);
		$zenfeed_cat_replace_jbzoo_element_checkbox_alltypes_6 = $this->params->get('zenfeed_cat_replace_jbzoo_element_checkbox_alltypes_6');
		$zenfeed_site_jbzoo_category_nested_alltypes_6 = $this->params->get('zenfeed_site_jbzoo_category_nested_alltypes_6',1);

		$zenfeed_site_jbzoo_gen_on_7 = $this->params->get('zenfeed_site_jbzoo_gen_on_7',0);
		$zenfeed_site_jbzoo_app_alltypes_7 = $this->params->get('zenfeed_site_jbzoo_app_alltypes_7');
		$zenfeed_site_jbzoo_type_alltypes_7 = $this->params->get('zenfeed_site_jbzoo_type_alltypes_7');
		$zenfeed_site_jbzoo_catid_alltypes_7 = $this->params->get('zenfeed_site_jbzoo_catid_alltypes_7');
		$zenfeed_site_jbzoo_image_alltypes_7 = $this->params->get('zenfeed_site_jbzoo_image_alltypes_7');
		$zenfeed_site_jbzoo_descpreview_alltypes_7 = $this->params->get('zenfeed_site_jbzoo_descpreview_alltypes_7');
		$zenfeed_site_jbzoo_descfull_alltypes_7 = $this->params->get('zenfeed_site_jbzoo_descfull_alltypes_7');
		$zenfeed_site_jbzoo_descpreview_alltypes_gen_7 = $this->params->get('zenfeed_site_jbzoo_descpreview_alltypes_gen_7',0);
		$zenfeed_site_jbzoo_descpreview_descmini_7 = $this->params->get('zenfeed_site_jbzoo_descpreview_descmini_7',1);
		$zenfeed_site_jbzoo_descpreview_descmini_count_7 = $this->params->get('zenfeed_site_jbzoo_descpreview_descmini_count_7',0);
		$zenfeed_site_jbzoo_descpreview_descmini_striptags_7 = $this->params->get('zenfeed_site_jbzoo_descpreview_descmini_striptags_7',1);
		$zenfeed_cat_replace_jbzoo_element_checkbox_alltypes_7 = $this->params->get('zenfeed_cat_replace_jbzoo_element_checkbox_alltypes_7');
		$zenfeed_site_jbzoo_category_nested_alltypes_7 = $this->params->get('zenfeed_site_jbzoo_category_nested_alltypes_7',1);

		$zenfeed_site_jbzoo_gen_on_8 = $this->params->get('zenfeed_site_jbzoo_gen_on_8',0);
		$zenfeed_site_jbzoo_app_alltypes_8 = $this->params->get('zenfeed_site_jbzoo_app_alltypes_8');
		$zenfeed_site_jbzoo_type_alltypes_8 = $this->params->get('zenfeed_site_jbzoo_type_alltypes_8');
		$zenfeed_site_jbzoo_catid_alltypes_8 = $this->params->get('zenfeed_site_jbzoo_catid_alltypes_8');
		$zenfeed_site_jbzoo_image_alltypes_8 = $this->params->get('zenfeed_site_jbzoo_image_alltypes_8');
		$zenfeed_site_jbzoo_descpreview_alltypes_8 = $this->params->get('zenfeed_site_jbzoo_descpreview_alltypes_8');
		$zenfeed_site_jbzoo_descfull_alltypes_8 = $this->params->get('zenfeed_site_jbzoo_descfull_alltypes_8');
		$zenfeed_site_jbzoo_descpreview_alltypes_gen_8 = $this->params->get('zenfeed_site_jbzoo_descpreview_alltypes_gen_8',0);
		$zenfeed_site_jbzoo_descpreview_descmini_8 = $this->params->get('zenfeed_site_jbzoo_descpreview_descmini_8',1);
		$zenfeed_site_jbzoo_descpreview_descmini_count_8 = $this->params->get('zenfeed_site_jbzoo_descpreview_descmini_count_8',0);
		$zenfeed_site_jbzoo_descpreview_descmini_striptags_8 = $this->params->get('zenfeed_site_jbzoo_descpreview_descmini_striptags_8',1);
		$zenfeed_cat_replace_jbzoo_element_checkbox_alltypes_8 = $this->params->get('zenfeed_cat_replace_jbzoo_element_checkbox_alltypes_8');
		$zenfeed_site_jbzoo_category_nested_alltypes_8 = $this->params->get('zenfeed_site_jbzoo_category_nested_alltypes_8',1);
		$jcashe = $licq; // setcache
		$zenfeed_site_jbzoo_gen_on_9 = $this->params->get('zenfeed_site_jbzoo_gen_on_9',0);
		$zenfeed_site_jbzoo_app_alltypes_9 = $this->params->get('zenfeed_site_jbzoo_app_alltypes_9');
		$zenfeed_site_jbzoo_type_alltypes_9 = $this->params->get('zenfeed_site_jbzoo_type_alltypes_9');
		$zenfeed_site_jbzoo_catid_alltypes_9 = $this->params->get('zenfeed_site_jbzoo_catid_alltypes_9');
		$zenfeed_site_jbzoo_image_alltypes_9 = $this->params->get('zenfeed_site_jbzoo_image_alltypes_9');
		$zenfeed_site_jbzoo_descpreview_alltypes_9 = $this->params->get('zenfeed_site_jbzoo_descpreview_alltypes_9');
		$zenfeed_site_jbzoo_descfull_alltypes_9 = $this->params->get('zenfeed_site_jbzoo_descfull_alltypes_9');
		$zenfeed_site_jbzoo_descpreview_alltypes_gen_9 = $this->params->get('zenfeed_site_jbzoo_descpreview_alltypes_gen_9',0);
		$zenfeed_site_jbzoo_descpreview_descmini_9 = $this->params->get('zenfeed_site_jbzoo_descpreview_descmini_9',1);
		$zenfeed_site_jbzoo_descpreview_descmini_count_9 = $this->params->get('zenfeed_site_jbzoo_descpreview_descmini_count_9',0);
		$zenfeed_site_jbzoo_descpreview_descmini_striptags_9 = $this->params->get('zenfeed_site_jbzoo_descpreview_descmini_striptags_9',1);
		$zenfeed_cat_replace_jbzoo_element_checkbox_alltypes_9 = $this->params->get('zenfeed_cat_replace_jbzoo_element_checkbox_alltypes_9');
		$zenfeed_site_jbzoo_category_nested_alltypes_9 = $this->params->get('zenfeed_site_jbzoo_category_nested_alltypes_9',1);

		$zenfeed_site_jbzoo_gen_on_10 = $this->params->get('zenfeed_site_jbzoo_gen_on_10',0);
		$zenfeed_site_jbzoo_app_alltypes_10 = $this->params->get('zenfeed_site_jbzoo_app_alltypes_10');
		$zenfeed_site_jbzoo_type_alltypes_10 = $this->params->get('zenfeed_site_jbzoo_type_alltypes_10');
		$zenfeed_site_jbzoo_catid_alltypes_10 = $this->params->get('zenfeed_site_jbzoo_catid_alltypes_10');
		$zenfeed_site_jbzoo_image_alltypes_10 = $this->params->get('zenfeed_site_jbzoo_image_alltypes_10');
		$zenfeed_site_jbzoo_descpreview_alltypes_10 = $this->params->get('zenfeed_site_jbzoo_descpreview_alltypes_10');
		$zenfeed_site_jbzoo_descfull_alltypes_10 = $this->params->get('zenfeed_site_jbzoo_descfull_alltypes_10');
		$zenfeed_site_jbzoo_descpreview_alltypes_gen_10 = $this->params->get('zenfeed_site_jbzoo_descpreview_alltypes_gen_10',0);
		$zenfeed_site_jbzoo_descpreview_descmini_10 = $this->params->get('zenfeed_site_jbzoo_descpreview_descmini_10',1);
		$zenfeed_site_jbzoo_descpreview_descmini_count_10 = $this->params->get('zenfeed_site_jbzoo_descpreview_descmini_count_10',0);
		$zenfeed_site_jbzoo_descpreview_descmini_striptags_10 = $this->params->get('zenfeed_site_jbzoo_descpreview_descmini_striptags_10',1);
		$zenfeed_cat_replace_jbzoo_element_checkbox_alltypes_10 = $this->params->get('zenfeed_cat_replace_jbzoo_element_checkbox_alltypes_10');
		$zenfeed_site_jbzoo_category_nested_alltypes_10 = $this->params->get('zenfeed_site_jbzoo_category_nested_alltypes_10',1);

		$zenfeed_site_jsh_catid = $this->params->get('zenfeed_site_jsh_catid',1);
		$zenfeed_site_jsh_descmini = $this->params->get('zenfeed_site_jsh_descmini',1);
		$zenfeed_site_jsh_intropreview = $this->params->get('zenfeed_site_jsh_intropreview',1);
		$zenfeed_site_jsh_price_beforetext = $this->params->get('zenfeed_site_jsh_price_beforetext',1);
		$zenfeed_site_jsh_price_text = $this->params->get('zenfeed_site_jsh_price_text');
		$zenfeed_site_jsh_price_text_tag = trim($this->params->get('zenfeed_site_jsh_price_text_tag'));
		$zenfeed_site_jsh_introtofull = $this->params->get('zenfeed_site_jsh_introtofull',1);
		$zenfeed_site_jsh_introsmallimg = $this->params->get('zenfeed_site_jsh_introsmallimg',1);
		$zenfeed_site_jsh_descmini_striptags = $this->params->get('zenfeed_site_jsh_descmini_striptags',1);
		$zenfeed_site_jsh_img_gallery = $this->params->get('zenfeed_site_jsh_img_gallery',0);
		$zenfeed_site_jsh_descmini = $this->params->get('zenfeed_site_jsh_descmini');
		$zenfeed_site_jsh_author = $this->params->get('zenfeed_site_jsh_author','Админ');
		$zenfeed_site_jsh_img_path = $this->params->get('zenfeed_site_jsh_img_path','/components/com_jshopping/files/img_products/');
 
		$zenfeed_vm3_catid = $this->params->get('zenfeed_vm3_catid');
		$zenfeed_vm3_introtofull = $this->params->get('zenfeed_vm3_introtofull',1);
		$zenfeed_vm3_fastselleroff = $this->params->get('zenfeed_vm3_fastselleroff',0);
		$zenfeed_vm3_introimage = $this->params->get('zenfeed_vm3_introimage',1);
		$zenfeed_vm3_fullimage = $this->params->get('zenfeed_vm3_fullimage',1);
		$zenfeed_vm3_previmage = $this->params->get('zenfeed_vm3_previmage',1);
		$zenfeed_vm3_imagetotopplease = $this->params->get('zenfeed_vm3_imagetotopplease',1);
		$zenfeed_vm3_striptags = $this->params->get('zenfeed_vm3_striptags',0);
		$zenfeed_delete__vm3_noturbotag = $this->params->get('zenfeed_delete__vm3_noturbotag',0);
		$zenfeed_vm3_filterstriptags = $this->params->get('zenfeed_vm3_filterstriptags',0);
		$zenfeed_vm3_biem = $this->params->get('zenfeed_vm3_biem',0);
		$zenfeed_vm3_pre = $this->params->get('zenfeed_vm3_pre',0);
		$zenfeed_vm3_pre_text = $this->params->get('zenfeed_vm3_pre_text');
		$zenfeed_vm3_descmini = $this->params->get('zenfeed_vm3_descmini',0);
		$zenfeed_vm3_textoff = $this->params->get('zenfeed_vm3_textoff',0);
		$zenfeed_vm3_descmini_count = $this->params->get('zenfeed_vm3_descmini_count');
		$zenfeed_vm3_modtitle_text_pre = $this->params->get('zenfeed_vm3_modtitle_text_pre');
		$zenfeed_vm3_modtitle_text_post = $this->params->get('zenfeed_vm3_modtitle_text_post');
		$zenfeed_vm3_descmini_striptags = $this->params->get('zenfeed_vm3_descmini_striptags',0);
		$zenfeed_vm3_modtitle = $this->params->get('zenfeed_vm3_modtitle',0);
		$zenfeed_vm3_arrayuni = $this->params->get('zenfeed_vm3_arrayuni',0);

		$joomlarandtimerss = '';
		$jchachetime = '';
		$turbopage = JFactory::getApplication()->input->get('turbopage','','string');
		$zenpage = JFactory::getApplication()->input->get('zenpage','','string');
		$randompage = JFactory::getApplication()->input->get('randompage','','string');
		$lic = JFactory::getApplication()->input->get('lic','','string');
		
		if (!empty($zenfeed_lickey) && !empty($lic) && $lic == 1) {
			echo 'Z'.base64_encode(strlen($zenfeed_lickey));
			die;
		}
		
		if ($turbopage !== $zenfeed_site_pwdturbo && $zenpage !== $zenfeed_site_pwd_zen) {
					die('Restricted access');
				}

		if (empty($zenfeed_lickey)) {
					die('Need licence key. Please contact me: https://jturbo.ru/');
			}

		if ($zenfeed_error_off == 1) {
			ini_set('display_errors','Off');
		}

		if (!empty($zenfeed_lickey)) {
			$lic = true;
		}
		
		$zenfeed_jchache = $zenfeed_lickey;

		if ($zenfeed_cache == 1) {
			
			if ($zenfeed_xmlfeed == 1) {
				header('Content-type: text/xml; charset=utf-8');
				header('Content-Disposition: inline'); 
			}

			$cache->setCaching( 1 );
			$cache->setLifeTime((int) $zenfeed_cache_time);
		}
		else {
			$cache->setCaching(0);
			$cache->setLifeTime(0);
		}

		if (!empty($zenfeed_jchache)) {
			if (strstr($zenfeed_jchache,strrev('-nezobrut'))) {
				preg_match("/\d.+\=/", $zenfeed_jchache, $pregcache);
				if ($pregcache) {
					if (!empty($pregcache[0])) {
						$jchachetime = 1;
					}
				}  
			}
			else {
			  $jchachetime = 0;
			}
		  }

		$joomlacachetimeone = $jchachetime; // set joomla cache

		if ($joomlacachetimeone == 0) {
			return die($jcashe);
		}

 		if ($zenfeed_who == '0') {


			switch ($randompage) {
				case '-1':
					$randompage = 'ORDER BY RAND()';
					$zenfeed_site_rss_limit = $zenfeed_site_db_random;
					$zenfeed_site_db_limit = $zenfeed_site_db_random;
					break;
				
				default:
					$randompage = 'ORDER BY `created`';
					break;
			}

	
		if (((!$rssYaLenta = $cache->get('rssfeedforyandexzen')) && $turbopage == $zenfeed_site_pwdturbo) || ((!$rssYaLenta = $cache->get('rssfeedforyandexzenpage')) && $zenpage == $zenfeed_site_pwd_zen))

		{
				
			$siteName = htmlspecialchars($zenfeed_sitename);
			$siteDesc = htmlspecialchars($zenfeed_sitedesc);
	
			$checkarraycatcontent = strpos($zenfeed_com_content_catid,',');
		
					
			if ($checkarraycatcontent !== false) {

							$ar_cat_comc = explode(',',$zenfeed_com_content_catid);
							$countmascc = count($ar_cat_comc);
							$textcatsid = array();
							for ($i=0; $i < $countmascc; $i++) { 
								$textcatsid[] = '`catid`='.$ar_cat_comc[$i].' OR ';
								if ($i == $countmascc - 1) {
									array_pop($textcatsid);
									$textcatsid[] = '`catid`='.$ar_cat_comc[$i].'';
								}
							}
							
							$db = JFactory::getDbo();     
							$query = $db->getQuery(true);  
							$query = "SELECT `id`,`title`,`alias`,`introtext`,`fulltext`,`catid`,`created`,`created_by`,`images`" . " FROM " . " `#__content` WHERE (".implode($textcatsid).") AND `STATE` = 1 ".$randompage." DESC  LIMIT ".(int)$zenfeed_site_db_limit."";
							$db->setQuery($query);    
							$items = $db->loadObjectList();

			}


			else {

				$db = JFactory::getDbo();     
				$query = $db->getQuery(true);  
				$query = "SELECT `id`,`title`,`alias`,`introtext`,`fulltext`,`catid`,`created`,`created_by`,`images`" . " FROM " . " `#__content` WHERE `catid`=".(int)$zenfeed_com_content_catid." AND `STATE` = 1 ".$randompage." DESC  LIMIT ".(int)$zenfeed_site_db_limit."";
				$db->setQuery($query);    
				$items = $db->loadObjectList();

			}
			
			
			if (!empty($items)) {
				$rssYaLenta = '<?xml version="1.0" encoding="UTF-8"?>
				<rss version="2.0"
				xmlns:content="http://purl.org/rss/1.0/modules/content/"
				xmlns:dc="http://purl.org/dc/elements/1.1/"
				xmlns:media="http://search.yahoo.com/mrss/"
				xmlns:atom="http://www.w3.org/2005/Atom"
				xmlns:georss="http://www.georss.org/georss"';

				if ($turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {	$rssYaLenta .= "\n".
					'				xmlns:yandex="http://news.yandex.ru" 
				xmlns:turbo="http://turbo.yandex.ru"';
					}

				$rssYaLenta .= '>';
				$rssYaLenta .= '
					<channel>
						<title>'.$siteName.'</title>
						<link>'.JURI::base().'</link>
						<description>'.$siteDesc.'</description>
						<language>'.$zenfeed_sitelang.'</language>'."";
						if ($zenfeed_site_jbzoo_turbo_li == 1 && $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
							$rssYaLenta .= "\n".'<yandex:analytics type="LiveInternet"></yandex:analytics>';
						}
						if (!empty($zenfeed_site_jbzoo_turbo_yaid) && $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
							$rssYaLenta .= "\n".'<yandex:analytics type="Yandex" id="'.$zenfeed_site_jbzoo_turbo_yaid.'"/>';
						}
						if (!empty($zenfeed_site_jbzoo_turbo_googleid) && $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
							$rssYaLenta .= "\n".'<yandex:analytics id="'.$zenfeed_site_jbzoo_turbo_googleid.'" type="Google"></yandex:analytics>';
						}
						if (!empty($zenfeed_site_jbzoo_turbo_ya_rsya) && $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
							$rssYaLenta .= "\n".'<yandex:adNetwork type="Yandex" id="'.$zenfeed_site_jbzoo_turbo_ya_rsya.'" turbo-ad-id="first_ad_place"></yandex:adNetwork>';
						}
						if (!empty($zenfeed_site_jbzoo_turbo_ya_rsya2) && $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
							$rssYaLenta .= "\n".'<yandex:adNetwork type="Yandex" id="'.$zenfeed_site_jbzoo_turbo_ya_rsya2.'" turbo-ad-id="second_ad_place"></yandex:adNetwork>';
						}
						if (!empty($zenfeed_site_jbzoo_turbo_ya_rsya3) && $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
							$rssYaLenta .= "\n".'<yandex:adNetwork type="Yandex" id="'.$zenfeed_site_jbzoo_turbo_ya_rsya3.'" turbo-ad-id="third_ad_place"></yandex:adNetwork>';
						}
						if (!empty($zenfeed_site_jbzoo_turbo_ad_fox) && !empty($zenfeed_site_jbzoo_turbo_ad_fox_container) &&  $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
							$rssYaLenta .= "\n"."<yandex:adNetwork
							type='AdFox'
							turbo-ad-id='before_first_ad_fox_place'>
							   <![CDATA[
								   <div id='".$zenfeed_site_jbzoo_turbo_ad_fox_container."'></div>
								   <script>
									   window.Ya.adfoxCode.create({
										   ownerId: ".$zenfeed_site_jbzoo_turbo_ad_fox.",
										   containerId: '".$zenfeed_site_jbzoo_turbo_ad_fox_container."',
										   params: {
											   pp: 'g',
											   ps: 'cmic',
											   p2: 'fqem'
										   }
									   });
								   </script>
							   ]]>
						   </yandex:adNetwork>";
						}

		
				$items = array_slice($items, 0, (int)$zenfeed_site_rss_limit);
				
				$filtertags = explode(',',$zenfeed_com_content_filterstriptags);
				foreach($filtertags as $ftags) {
					$Infiltertags .= '<'.$ftags.'>';
				}
				
				// $Infiltertags = substr($Infiltertags,0,-1);

				foreach ($items as $item) {


				if ($zenfeed_comcontent_fields == 1) {

					JLoader::register('FieldsHelper', JPATH_ADMINISTRATOR . '/components/com_fields/helpers/fields.php');

					$item->jcfields = FieldsHelper::getFields('com_content.article', $item, true);

					$fields = [];
					foreach($item->jcfields as $jcfield)
					{
						$fields[$jcfield->name] = $jcfield;
					}

				}

					$itemID = $item->id;
					$itemName = htmlspecialchars($item->title);
					$itemName = str_replace('«','&quot;',$itemName);
					$itemName = str_replace('»','&quot;',$itemName);
					$itemCreated = $item->created;
					$itemCreated = JHtml::_('date', $itemCreated, 'Y-m-d H:i:s', JFactory::getApplication()->getCfg('offset'), true);
					$itemAuthor = JFactory::getUser($item->created_by)->name;
					if (empty($itemAuthor) && $zenfeed_site_defauthor_set == '1' && $zenfeed_site_defauthor_set_fix == '0') {
						$itemAuthor = $zenfeed_site_defauthor;
					}
					if ($zenfeed_site_defauthor_set_fix == '1') {
						$itemAuthor = $zenfeed_site_defauthor;
					}
					if (!empty($zenfeed_comcontent_fields_author_name) && $zenfeed_comcontent_fields == '1') {
						$itemAuthor = $fields["{$zenfeed_comcontent_fields_author_name}"]->rawvalue;
					}
					
					$category = JCategories::getInstance('Content')->get($item->catid);


					JLoader::register('ContentHelperRoute', JPATH_SITE . '/components/com_content/helpers/route.php');

					$rootURL = rtrim(JURI::base(),'/');
					$subpathURL = JURI::base(true);
					if(!empty($subpathURL) && ($subpathURL != '/')) {
						$rootURL = substr($rootURL, 0, -1 * strlen($subpathURL));
					}

					$itemUrl = $rootURL.JRoute::_(ContentHelperRoute::getArticleRoute($item->id, $item->catid));

					if ($zenfeed_comcontent_sef_itemid == 1 && !empty($zenfeed_comcontent_sef_itemid_num)) {
					
					$fixmenu = (int) $zenfeed_comcontent_sef_itemid_num;

					$itemUrl = $rootURL.JRoute::_('index.php?option=com_content&view=article&id='.$item->id.':'.$item->alias.'&catid='.$item->catid.'&Itemid='.$fixmenu);

					}

					$PreviewDesc = $item->introtext;
					$FullDesc = $item->fulltext;
					$figure = '';
					$figures = '';
					$figureintext = '';
			
					if ($zenfeed_images_path == 1) {
						$PreviewDesc = str_replace('src="images','src="/images',$PreviewDesc);
						$FullDesc = str_replace('src="images','src="/images',$FullDesc);
						$PreviewDesc = str_replace('//images/','/images/',$PreviewDesc);
						$FullDesc = str_replace('//images/','/images/',$FullDesc);
					}

					if ($zenfeed_comcontent_pre == 1) {

					$PreviewDesc = preg_replace('/<pre.*<\/pre>/ui', $zenfeed_comcontent_pre_text, $PreviewDesc);

					$FullDesc = preg_replace('/<pre.*<\/pre>/ui', $zenfeed_comcontent_pre_text, $FullDesc);
						
					}
								
					if ($zenfeed_global_classes == 1) {
						if (!empty($zenfeed_global_classes_textarea)) {
							$regexplist = explode(PHP_EOL,trim($zenfeed_global_classes_textarea));
							if (!empty($regexplist[0])) {
								for ($i=0; $i < count($regexplist); $i++) { 
									$PreviewDesc = preg_replace("#{$regexplist[$i]}#", "", $PreviewDesc);
									$FullDesc = preg_replace("#{$regexplist[$i]}#", "", $FullDesc);
								}
							}
						}
					}

					if ($zenfeed_global_youtube == 1) {
									
						// $PreviewDesc = str_replace('{youtube}','', $PreviewDesc);
						// $PreviewDesc = str_replace('{/youtube}','', $PreviewDesc);
						// $FullDesc = str_replace('{/youtube}','', $FullDesc);
						// $FullDesc = str_replace('{/youtube}','', $FullDesc);

						$PreviewDesc = preg_replace("/(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:watch\?(?:[\w-=&]*&)?v=|(?:|v)\/))([\w-]+)[\w-=&#;]*/", "<iframe allowfullscreen frameborder='0' height='315' src='https://www.youtube.com/embed/$1' width='560'></iframe>", $PreviewDesc);

						$FullDesc = preg_replace("/(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:watch\?(?:[\w-=&]*&)?v=|(?:|v)\/))([\w-]+)[\w-=&#;]*/", "<iframe allowfullscreen frameborder='0' height='315' src='https://www.youtube.com/embed/$1' width='560'></iframe>", $FullDesc);
							
					}

					if ($zenfeed_global_squarebrackets == 1) {
						$PreviewDesc = preg_replace('/\[(.+?)\].+\[\/(.+?)\]/is', '', $PreviewDesc);
						$FullDesc = preg_replace('/\[(.+?)\].+\[\/(.+?)\]/is', '', $FullDesc);
						$PreviewDesc = preg_replace('/\[(.+?)\]/is', '', $PreviewDesc);
						$FullDesc = preg_replace('/\[(.+?)\]/is', '', $FullDesc);
					}

					if ($zenfeed_comcontent_striptags == 1) {
						$PreviewDesc = trim(strip_tags($PreviewDesc, $Infiltertags));
					}

					if ($zenfeed_comcontent_biem == 1 && $zenfeed_comcontent_striptags == 0) {
						
					$PreviewDesc = str_replace('<b>','',$PreviewDesc);
					$PreviewDesc = str_replace('</b>','',$PreviewDesc);
						
					$PreviewDesc = str_replace('<i>','',$PreviewDesc);
					$PreviewDesc = str_replace('</i>','',$PreviewDesc);
						
					$PreviewDesc = str_replace('<strong>','',$PreviewDesc);
					$PreviewDesc = str_replace('</strong>','',$PreviewDesc);
						
					$PreviewDesc = str_replace('<em>','',$PreviewDesc);
					$PreviewDesc = str_replace('</em>','',$PreviewDesc);

					}

					$PreviewDesc = str_replace('«','&quot;',$PreviewDesc);
					$PreviewDesc = str_replace('»','&quot;',$PreviewDesc);
					$PreviewDesc = str_replace('<br>','<br />',$PreviewDesc);
					$PreviewDesc = preg_replace('/<p(?:([\'"]).*?\1|.)*?>/ui', '<p>', $PreviewDesc);
					$PreviewDesc = preg_replace("/\{.*?}/ius", "", $PreviewDesc);

					if ($zenfeed_delete_noturbotag == 1) {
						$PreviewDesc = preg_replace("/<noturbo>.*?<\/noturbo>/ius", "", $PreviewDesc);
					}

					preg_match_all('@src="([^"]+)"@' , $FullDesc, $figureintext );

					if ($zenfeed_comcontent_striptags == 1) {

						$FullDesc = trim(strip_tags($FullDesc, $Infiltertags));
						$FullDesc = str_replace('«','&quot;',$FullDesc);
						$FullDesc = str_replace('»','&quot;',$FullDesc);
						$FullDesc = str_replace('&nbsp;',' ',$FullDesc);
						$FullDesc = preg_replace('/<p(?:([\'"]).*?\1|.)*?>/ui', '<p>', $FullDesc);
						$FullDesc = str_replace('alt=""','',$FullDesc);
						$FullDesc = str_replace("title=''","",$FullDesc);
						// $FullDesc = preg_replace("/<img[^>]+>/ius", "", $FullDesc);
						// $FullDesc = str_replace('<p></p>','',$FullDesc);
						// $FullDesc = str_replace('<br>','<br />',$FullDesc);
					}



					if ($zenfeed_comcontent_biem == 1 && $zenfeed_comcontent_striptags == 0) {

					$FullDesc = str_replace('<b>','',$FullDesc);
					$FullDesc = str_replace('</b>','',$FullDesc);
						
					$FullDesc = str_replace('<i>','',$FullDesc);
					$FullDesc = str_replace('</i>','',$FullDesc);
						
					$FullDesc = str_replace('<strong>','',$FullDesc);
					$FullDesc = str_replace('</strong>','',$FullDesc);
						
					$FullDesc = str_replace('<em>','',$FullDesc);
					$FullDesc = str_replace('</em>','',$FullDesc);

					}

					$FullDesc = str_replace('«','&quot;',$FullDesc);
					$FullDesc = str_replace('»','&quot;',$FullDesc);
					$FullDesc = str_replace('<br>','<br />',$FullDesc);

					
					$FullDesc = preg_replace("/\{.*?}/ius", "", $FullDesc);
				
					if ($zenfeed_delete_noturbotag == 1) {
						$FullDesc = preg_replace("/<noturbo>.*?<\/noturbo>/ius", "", $FullDesc);
					}

					if ($zenfeed_img_domain == 1) {
						$patt = '/<\s*img[^>]*src=[\"|\'](.*?)[\"|\'][^>]*\/*>/i';
						$FullMatchImg = preg_match_all($patt, $FullDesc, $matchFull);
						foreach ($matchFull[1] as $matchimage) {
							if (!strstr($matchimage,'http')) {
								$FullDesc = str_replace($matchimage, JURI::base().$matchimage, $FullDesc); // work
							}
						}
						$FullMatchImg = preg_match_all($patt, $PreviewDesc, $matchPreview);
						foreach ($matchPreview[1] as $matchimagesmall) {
							if (!strstr($matchimagesmall,'http')) {
								$PreviewDesc = str_replace($matchimagesmall, JURI::base().$matchimagesmall, $PreviewDesc); // work
							}
						}
					}

					
					if (!empty($FullDesc) || !empty($PreviewDesc)) {
				
						$rssYaLenta .= "\n";
						if ($turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) { $rssYaLenta .= '<item turbo="true">'; }
						else {
							$rssYaLenta .= '<item>';
						}
						$rssYaLenta .= "\n";
						$rssYaLenta .= '<title>'.$itemName.'</title>';
						$rssYaLenta .= "\n";
						$rssYaLenta .= '<link>'.$itemUrl.'</link>';
						$rssYaLenta .= "\n";
						$rssYaLenta .= '<guid>'.md5($itemUrl).'</guid>';
						$rssYaLenta .= "\n";
						$rssYaLenta .= '<pubDate>'.$itemCreated.' '.$zenfeed_site_time.'</pubDate>';
						$rssYaLenta .= "\n";
						$rssYaLenta .= '<media:rating scheme="urn:simple">nonadult</media:rating>';
						$rssYaLenta .= "\n";
						$rssYaLenta .= '<author>'.$itemAuthor.'</author>';
						$rssYaLenta .= "\n";

						$ImgesEnclos = $PreviewDesc . $FullDesc;
						preg_match_all('@src="([^"]+)"@', $ImgesEnclos, $matchesenc);

						if ($zenfeed_comcontent_figurealt == 1) {

							$PreviewDesc = preg_replace_callback('/<img[^>]*?alt="([^">]+)" [^>]*?>/is', function($matches){return '<figure>'.$matches[0].'<figcaption>'.$matches[1].'</figcaption></figure>';},  $PreviewDesc);

							$FullDesc = preg_replace_callback('/<img[^>]*?alt="([^">]+)" [^>]*?>/is', function($matches){return '<figure>'.$matches[0].'<figcaption>'.$matches[1].'</figcaption></figure>';},  $FullDesc);
							
						}


						if ($matchesenc) {
							
							if ($matchesenc[1] && !empty($matchesenc[1])) {
								foreach (array_unique($matchesenc[1]) as $imgenc) {
									if (strstr($imgenc,'http')) {
									$imgenc = str_replace(JURI::base().JURI::base(),JURI::base(),$imgenc);
									@$image_mimeecn = image_type_to_mime_type(exif_imagetype($imgenc)); 
									
									if ($zenfeed_images_path == 1) {
										$imgenc = str_replace('//images/','/images/',$imgenc);
									}

									$rssYaLenta .= "\n".'<enclosure url="'.$imgenc.'" type="'.$image_mimeecn.'"/>'."\n";
									}
									else {
									
									@$image_mimeecn = image_type_to_mime_type(exif_imagetype(JURI::base().$imgenc)); 

									if ($zenfeed_images_path == 1) {
										$imgenc = str_replace('//images/','images/',$imgenc);
										$imgenc = str_replace('/images/','images/',$imgenc);
									}
									
									$rssYaLenta .= "\n".'<enclosure url="'.JURI::base().$imgenc.'" type="'.$image_mimeecn.'"/>'."\n";
									}
								}
							}
						}
						
					if ($zenfeed_cat_replace == '1') {

					$checkarrayreplacecatname = strpos($zenfeed_cat_replace_catname,',');
					if ($checkarrayreplacecatname !== false) {
						$massivcatreplacename = explode(',',$zenfeed_cat_replace_catname);
						$countmascat = count($massivcatreplacename);
					}

			
					$offyandexcats = array (
						'Авто', 'Война', 'Дизайн', 'Дом', 'Еда', 'Здоровье', 'Знаменитости', 'Игры', 'Кино', 'Культура', 'Литература', 'Мода', 'Музыка', 'Наука', 'Общество', 'Политика', 'Природа', 'Происшествия', 'Психология', 'Путешествия', 'Спорт', 'Технологии', 'Фотографии', 'Хобби', 'Экономика', 'Юмор' 
					);

			
					for ($i=0; $i < $countmascat; $i++) { 
									$rssYaLenta .= '<category>'.trim($massivcatreplacename[$i]).'</category>';
									$rssYaLenta .= "\n";
					}

			
						
					}
					else {
						$rssYaLenta .= '<category>'.$category->title.'</category>';
						$rssYaLenta .= "\n";
					}
				
					if ($zenfeed_comcontent_descmini == 0) {
						if ($zenfeed_comcontent_descmini_striptags == 0) {
							$rssYaLenta .= '<description><![CDATA['.$PreviewDesc.']]></description>';
						}
						else {
							$rssYaLenta .= '<description><![CDATA['.strip_tags($PreviewDesc).']]></description>';
						}
						
						$rssYaLenta .= "\n";
					}
	
					if ($zenfeed_comcontent_descmini == 1) {
						if ($zenfeed_comcontent_descmini_striptags == 0) {
							$rssYaLenta .= '<description><![CDATA['.mb_substr($PreviewDesc, 0, $zenfeed_comcontent_descmini_count).']]></description>';
						}
						else {
							$rssYaLenta .= '<description><![CDATA['.strip_tags(mb_substr($PreviewDesc, 0, $zenfeed_comcontent_descmini_count)).']]></description>';
						}
	
						$rssYaLenta .= "\n"; // 
					}


						if (empty($FullDesc) && $zenfeed_comcontent_introtofull_fixempty == 1) {
							
						}

						if (empty($FullDesc) && $zenfeed_comcontent_introtofull_fixempty == 0) {
							$FullDesc = $PreviewDesc;
						}


						if ($zenfeed_comcontent_introtofull == 1 && $zenfeed_site_snippet_center == 0) {
							$FullDesc = $PreviewDesc . $FullDesc;
						}


						if ($zenfeed_comcontent_introtofull == 1 && $zenfeed_site_snippet_center == 1 && empty($zenfeed_site_jbzoo_turbo_ya_rsya2) && $turbopage != $zenfeed_site_pwdturbo) {
							$FullDesc = $PreviewDesc . "\n" . trim($zenfeed_site_snippet_center_text) . "\n" . $FullDesc;
						}
						

						if ($zenfeed_comcontent_introtofull == 1 && !empty($zenfeed_site_jbzoo_turbo_ya_rsya2) && $turbopage == $zenfeed_site_pwdturbo) {
							$FullDesc = $PreviewDesc . "\n" . trim($zenfeed_site_snippet_center_text) . "\n" .' <figure data-turbo-ad-id="second_ad_place"></figure> ' . $FullDesc;
						}
						

						if ($zenfeed_comcontent_introtofull == 0 && $zenfeed_site_snippet_center == 1 && !empty($zenfeed_site_jbzoo_turbo_ya_rsya2) && $turbopage == $zenfeed_site_pwdturbo) {
							$FullDesc = "\n" . trim($zenfeed_site_snippet_center_text) . "\n" .' <figure data-turbo-ad-id="second_ad_place"></figure> ' . $FullDesc;
						}
						

		if ($turbopage != $zenfeed_site_pwdturbo) {
							
											
						$rssYaLenta .= '<content:encoded><![CDATA['.$FullDesc.'';
						$rssYaLenta .= "\n";
					
		

				if ($zenfeed_comcontent_introimage == 1) {
					
					if ($item->images && !empty($item->images)) {
						if (!empty($item->images)) {
							$inarticlesformimg = json_decode($item->images);
							$image_intro = $inarticlesformimg->image_intro;
							$image_intro_alt = $inarticlesformimg->image_intro_alt;

							@$sImg = getimagesize(JURI::base().$image_intro); //Warning, if img delete		
							@$oneImg = getimagesize(JURI::base().$image_intro); //Warning, if img delete

							if ($zenfeed_comcontent_fullimage == 1) {
							$image_fulltext = $inarticlesformimg->image_fulltext;
							$image_fulltext_alt = $inarticlesformimg->image_fulltext_alt;

							@$stImg = getimagesize(JURI::base().$image_fulltext); //Warning, if img delete		
							@$TwoImg = getimagesize(JURI::base().$image_fulltext); //Warning, if img delete

							}
						}
					}
				}

		if ($zenfeed_comcontent_imagetotopplease == 1) {	
			
					if ($item->images && !empty($item->images) && !empty($oneImg[0])) {
					
						if (!empty($image_intro_alt)) {
							$figcapt = $image_intro_alt;
						}
						else {
							$figcapt = $itemName;
						}

				
				$rssYaLenta .= '
							<figure>
							<img src="'.JURI::base().$image_intro.'" width="'.$oneImg[0].'" height="'.$oneImg[1].'">
							<figcaption>'.$figcapt.'</figcaption>
							</figure>';
					}

			
					if ($item->images && !empty($item->images) && $image_intro != $image_fulltext && !empty($TwoImg[0])) {

						if (!empty($image_fulltext_alt)) {
							$figcapt = $image_fulltext_alt;
						}
						else {
							$figcapt = $itemName;
						}

				
				$rssYaLenta .= '
							<figure>
							<img src="'.JURI::base().$image_fulltext.'" width="'.$TwoImg[0].'" height="'.$TwoImg[1].'">
							<figcaption>'.$figcapt.'</figcaption>
							</figure>';
					}
		}

			
			
					$rssYaLenta .= ']]>';
					$rssYaLenta .= "\n";
					$rssYaLenta .= '</content:encoded>';
					$rssYaLenta .= "\n";

}



if ($turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {

					$rssYaLenta .= '<turbo:content><![CDATA[';
					$rssYaLenta .= "\n";
				
			if ($zenfeed_site_snippet_top == 1 && !empty($zenfeed_site_snippet_top_text)) {
				$rssYaLenta .= trim($zenfeed_site_snippet_top_text) . "\n";
			}

			if (!empty($zenfeed_site_jbzoo_turbo_ya_rsya) && $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
				$rssYaLenta .= "\n".' <figure data-turbo-ad-id="first_ad_place"></figure> ' . "\n";
			}
					if ($zenfeed_comcontent_introimage == 1) {
						
						if ($item->images && !empty($item->images)) {
							if (!empty($item->images)) {
								$inarticlesformimg = json_decode($item->images);
								$image_intro = $inarticlesformimg->image_intro;
								$image_intro_alt = $inarticlesformimg->image_intro_alt;
	
								@$sImg = getimagesize(JURI::base().$image_intro); //Warning, if img delete		
								@$oneImg = getimagesize(JURI::base().$image_intro); //Warning, if img delete
	
								if ($zenfeed_comcontent_fullimage == 1) {
								$image_fulltext = $inarticlesformimg->image_fulltext;
								$image_fulltext_alt = $inarticlesformimg->image_fulltext_alt;
	
								@$stImg = getimagesize(JURI::base().$image_fulltext); //Warning, if img delete		
								@$TwoImg = getimagesize(JURI::base().$image_fulltext); //Warning, if img delete
	
								}
							}
						}
					}

		
				if ($item->images && !empty($item->images) && !empty($oneImg[0])) {
				
					if (!empty($image_intro_alt)) {
						$figcapt = $image_intro_alt;
					}
					else {
						$figcapt = $itemName;
					}

			
			$rssYaLenta .= '
						<header>
						<h1>'.$itemName.'</h1>
						<figure>
						<img src="'.JURI::base().$image_intro.'" width="'.$oneImg[0].'" height="'.$oneImg[1].'">
						<figcaption>'.$figcapt.'</figcaption>
						</figure>
						</header>';
				}
				
		if ($zenfeed_comcontent_imagetotopplease == 1) {	
				if ($item->images && !empty($item->images) && $image_intro != $image_fulltext && !empty($TwoImg[0])) {

					if (!empty($image_fulltext_alt)) {
						$figcapt = $image_fulltext_alt;
					}
					else {
						$figcapt = $itemName;
					}

						$rssYaLenta .= '
						<header>
						<h1>'.$itemName.'</h1>
						<figure>
						<img src="'.JURI::base().$image_fulltext.'" width="'.$TwoImg[0].'" height="'.$TwoImg[1].'">
						<figcaption>'.$figcapt.'</figcaption>
						</figure>
						</header>';
				}
				else  {

					if ($zenfeed_comcontent_previmage == 1) {
					preg_match('@src="([^"]+)"@' , $PreviewDesc, $figureintextprev );

					$mainimg = $figureintextprev[1];

					if (!empty($mainimg) && strlen($mainimg) > 5 && NULL !== $mainimg) {
					$figcapt = $itemName;
					
					@$InImg = getimagesize(JURI::base().$mainimg); //Warning, if img delete	

					$rssYaLenta .= '
					<header>
					<h1>'.$itemName.'</h1>
					<figure>
					<img src="'.$mainimg.'">
					<figcaption>'.$figcapt.'</figcaption>
					</figure>
					</header>';

						}
					}
				}
		}


				$rssYaLenta .= $FullDesc;
							
			if ($zenfeed_site_snippet_bottom == 1 && !empty($zenfeed_site_snippet_bottom_text)) {
				$rssYaLenta .= "\n" . trim($zenfeed_site_snippet_bottom_text) . "\n";
			}
			
			if (!empty($zenfeed_site_jbzoo_turbo_ya_rsya3) && $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
				$rssYaLenta .= "\n".' <figure data-turbo-ad-id="third_ad_place"></figure> ' . "\n";
			}

				$rssYaLenta .= ']]>';
				$rssYaLenta .= "\n";
				$rssYaLenta .= '</turbo:content>';

				
						}

					if ($figure) {
						if (!empty($figure[1]) && $figure[1]) {

							foreach ($figure[1] as $imageenc) {
								@$image_mimeecn = image_type_to_mime_type(exif_imagetype(JURI::base().$imageenc)); 
								$rssYaLenta .= "\n".'<enclosure url="'.JURI::base().$imageenc.'" type="'.$image_mimeecn.'"/>';
							}
							

						}
					}


						
						$rssYaLenta .= "\n".'</item>'."\n";

						
					}
				}
				
		
				$rssYaLenta .= '</channel></rss>';
				
		
		if ($turbopage == $zenfeed_site_pwdturbo) {
				$cache->store($rssYaLenta, 'rssfeedforyandexzen');
		}

		if ($zenpage == $zenfeed_site_pwd_zen) {
				$cache->store($rssYaLenta, 'rssfeedforyandexzenpage');
		}

		if ($zenfeed_xmlfeed == 1) {
			header('Content-type: text/xml; charset=utf-8');
			header('Content-Disposition: inline'); 
			echo trim($rssYaLenta);
			exit;
		}
		else {
			return trim($rssYaLenta);
		}

				}
			
			}
			else {
				
				if ( $turbopage == $zenfeed_site_pwdturbo) {
					if ($zenfeed_xmlfeed == 1) {
						echo $cache->get('rssfeedforyandexzen');
						exit;
					}
					else {
						return $cache->get('rssfeedforyandexzen');
					}
				}

				if ( $zenpage == $zenfeed_site_pwd_zen) {
					if ($zenfeed_xmlfeed == 1) {
						echo $cache->get('rssfeedforyandexzenpage');
						exit;
					}
					else {
						return $cache->get('rssfeedforyandexzenpage');
					}
				}
			}

		}
		elseif ($zenfeed_who == '1') {

	
			switch ($randompage) {
				case '-1':
					$randompage = 'ORDER BY RAND()';
					$zenfeed_site_rss_limit = $zenfeed_site_db_random;
					$zenfeed_site_db_limit = $zenfeed_site_db_random;
					break;
				
				default:
					$randompage = 'ORDER BY `created`';
					break;
			}


			if (((!$rssYaLenta = $cache->get('rssfeedforyandexzen')) && $turbopage == $zenfeed_site_pwdturbo) || ((!$rssYaLenta = $cache->get('rssfeedforyandexzenpage')) && $zenpage == $zenfeed_site_pwd_zen))

			{

				if ($zenfeed_site_jbzoo_category_nested == 1) {
					$zenfeed_site_jbzoo_category_nested = true;
				}
				else {
					$zenfeed_site_jbzoo_category_nested = false;
				}
				// JBZoo::init();
				$zoo = App::getInstance('zoo');
				$db = JFactory::getDBO();
				$doc = JFactory::getDocument();
				$appId = $zenfeed_site_jbzoo_app;
				$ElmImage = $zenfeed_site_jbzoo_image;
				$ElmDescPreview = $zenfeed_site_jbzoo_descpreview;
				$ElmDescFull = $zenfeed_site_jbzoo_descfull;
				$siteName = htmlspecialchars($zenfeed_sitename);
				$siteDesc = htmlspecialchars($zenfeed_sitedesc);
				$typeId = $zenfeed_site_jbzoo_type; 
				$items = '';
				$all_items = array();

				$checkarraycatzoo = strpos($zenfeed_site_jbzoo_catid,',');
				
				if ($checkarraycatzoo !== false)  {
					$massivcatzoo = explode(',',$zenfeed_site_jbzoo_catid);
					$countmas = count($massivcatzoo);

					$options = array(
						'category_nested' => $zenfeed_site_jbzoo_category_nested, 
						'limit' => array(0, $zenfeed_site_rss_limit), // offset и limit
						'user' => false, 
						'published' => 1,
						'order' => 'rdate'
					);
	
			//TODO
			//FIX
			// randompage		
		
				for ($i=0; $i < $countmas; $i++) { 

					$yaCategoryModel = $zoo->table->category->get($massivcatzoo[$i]);
					$url = $zoo->route->category($yaCategoryModel);
					$items = JBModelItem::model()->getList($appId, $massivcatzoo[$i], $typeId, $options);
					$all_items[] = $items;
				}

		
				function cmp($a, $b){
					$ad = strtotime($a->created);
					$bd = strtotime($b->created);
					return ($bd-$ad);
				}
				
					$arrOut = array();
				
					foreach($all_items as $subArr) {
					$arrOut = array_merge($arrOut, $subArr);
					}

			
					usort($arrOut, 'cmp');
					
		
					$items = $arrOut;

			
				}
				else {

					$options = array(
						'category_nested' => $zenfeed_site_jbzoo_category_nested, 
						'limit' => array(0, $zenfeed_site_rss_limit), // offset и limit
						'user' => false, 
						'published' => 1,
						'order' => 'rdate'
					);
					
					$yaCategoryModel = $zoo->table->category->get($zenfeed_site_jbzoo_catid);
					$url = $zoo->route->category($yaCategoryModel);
					$items = JBModelItem::model()->getList($appId, $zenfeed_site_jbzoo_catid, $typeId, $options);
				}
				
				if (!empty($items)) {
				$rssYaLenta = '<?xml version="1.0" encoding="UTF-8"?>
				<rss version="2.0"
				xmlns:content="http://purl.org/rss/1.0/modules/content/"
				xmlns:dc="http://purl.org/dc/elements/1.1/"
				xmlns:media="http://search.yahoo.com/mrss/"
				xmlns:atom="http://www.w3.org/2005/Atom"
				xmlns:georss="http://www.georss.org/georss"';
				
				if ($turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {	$rssYaLenta .= "\n".
				'				xmlns:yandex="http://news.yandex.ru" 
				xmlns:turbo="http://turbo.yandex.ru"';
				}

				$rssYaLenta .= '>';
				$rssYaLenta .= '
					<channel>
						<title>'.$siteName.'</title>
						<link>'.JURI::base().'</link>
						<description>'.$siteDesc.'</description>
						<language>'.$zenfeed_sitelang.'</language>'."";
						if ($zenfeed_site_jbzoo_turbo_li == 1 && $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
							$rssYaLenta .= "\n".'<yandex:analytics type="LiveInternet"></yandex:analytics>';
						}
						if (!empty($zenfeed_site_jbzoo_turbo_yaid) && $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
							$rssYaLenta .= "\n".'<yandex:analytics type="Yandex" id="'.$zenfeed_site_jbzoo_turbo_yaid.'"/>';
						}
						if (!empty($zenfeed_site_jbzoo_turbo_googleid) && $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
							$rssYaLenta .= "\n".'<yandex:analytics id="'.$zenfeed_site_jbzoo_turbo_googleid.'" type="Google"></yandex:analytics>';
						}
						if (!empty($zenfeed_site_jbzoo_turbo_ya_rsya) && $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
							$rssYaLenta .= "\n".'<yandex:adNetwork type="Yandex" id="'.$zenfeed_site_jbzoo_turbo_ya_rsya.'" turbo-ad-id="first_ad_place"></yandex:adNetwork>';
						}
						if (!empty($zenfeed_site_jbzoo_turbo_ya_rsya2) && $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
							$rssYaLenta .= "\n".'<yandex:adNetwork type="Yandex" id="'.$zenfeed_site_jbzoo_turbo_ya_rsya2.'" turbo-ad-id="second_ad_place"></yandex:adNetwork>';
						}
						if (!empty($zenfeed_site_jbzoo_turbo_ya_rsya3) && $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
							$rssYaLenta .= "\n".'<yandex:adNetwork type="Yandex" id="'.$zenfeed_site_jbzoo_turbo_ya_rsya3.'" turbo-ad-id="third_ad_place"></yandex:adNetwork>';
						}
				$items = array_slice($items, 0, (int)$zenfeed_site_rss_limit);		

		
				foreach ($items as $item) {
			
			
					$itemID = $item->id;
					$itemName = htmlspecialchars($item->name);
					$itemName = str_replace('«','&quot;',$itemName);
					$itemName = str_replace('»','&quot;',$itemName);
					$itemCreated = $item->created;
					$itemCreated = JHtml::_('date', $itemCreated, 'Y-m-d H:i:s', JFactory::getApplication()->getCfg('offset'), true);
					$itemAuthor = JFactory::getUser($item->created_by)->name;
					if (empty($itemAuthor) && $zenfeed_site_defauthor_set == '1' && $zenfeed_site_defauthor_set_fix == '0') {
						$itemAuthor = $zenfeed_site_defauthor;
					}
					if ($zenfeed_site_defauthor_set_fix == '1') {
						$itemAuthor = $zenfeed_site_defauthor;
					}
					$allCategories = $item->getRelatedCategories();
					$primaryId = $item->getPrimaryCategoryId();
					$resultcat = array();
					foreach($allCategories as $category) {
							$resultcat[] = '<category>'.$category->name.'</category>';
					}
				
					$allcatinitem = implode("\n",$resultcat);
					$itemUrl = $zoo->jbrouter->externalItem($item);
					$category = $item->getPrimaryCategory()->name;
					$PreviewDesc = $item->getElement($ElmDescPreview)->data();
					$FullDesc = $item->getElement($ElmDescFull)->data();
					$PreviewDescApp = $zoo->data->create($PreviewDesc);
					$FullDescApp = $zoo->data->create($FullDesc);
					$figure = '';
					$figures = '';

					if ($zenfeed_images_path == 1) {
						$PreviewDesc = str_replace('src="images','src="/images',$PreviewDesc);
						$FullDesc = str_replace('src="images','src="/images',$FullDesc);
						$PreviewDesc = str_replace('//images/','/images/',$PreviewDesc);
						$FullDesc = str_replace('//images/','/images/',$FullDesc);
					}

					$PreviewDesc = htmlspecialchars(trim(strip_tags($PreviewDescApp->find('0.value'))));
					$PreviewDesc = str_replace('«','&quot;',$PreviewDesc);
					$PreviewDesc = str_replace('»','&quot;',$PreviewDesc);
					$PreviewDesc = str_replace('<br>','<br />',$PreviewDesc);
					$PreviewDesc = preg_replace("/\{.*?}/ius", "", $PreviewDesc);
					$FullDesc = trim($FullDescApp->find('0.value'));
					$FullDesc = preg_replace("/\{.*?}/ius", "", $FullDesc);
					
					$FullDesc = str_replace('«','&quot;',$FullDesc);
					$FullDesc = str_replace('»','&quot;',$FullDesc);
					$FullDesc = str_replace('&nbsp;',' ',$FullDesc);
					$FullDesc = str_replace(' style="text-align: justify;"','',$FullDesc);
					$FullDesc = str_replace('alt=""','',$FullDesc);
					$FullDesc = str_replace("title=''","",$FullDesc);
					preg_match_all("/<img.+?src=[\"'](.+?)[\"'].*?>/ius", $FullDesc, $figure);
					// $FullDesc = preg_replace("/<img[^>]+>/ius", "", $FullDesc);
					$FullDesc = str_replace('<p></p>','',$FullDesc);
					$FullDesc = str_replace('<br>','<br />',$FullDesc);

									
					if ($zenfeed_global_classes == 1) {
						if (!empty($zenfeed_global_classes_textarea)) {
							$regexplist = explode(PHP_EOL,trim($zenfeed_global_classes_textarea));
							if (!empty($regexplist[0])) {
								for ($i=0; $i < count($regexplist); $i++) { 
									$PreviewDesc = preg_replace("#{$regexplist[$i]}#", "", $PreviewDesc);
									$FullDesc = preg_replace("#{$regexplist[$i]}#", "", $FullDesc);
								}
							}
						}
					}
					
					if ($zenfeed_global_youtube == 1) {
										
						$PreviewDesc = preg_replace("/(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:watch\?(?:[\w-=&]*&)?v=|(?:|v)\/))([\w-]+)[\w-=&#;]*/", "<iframe allowfullscreen frameborder='0' height='315' src='https://www.youtube.com/embed/$1'; width='560'></iframe>", $PreviewDesc);

						$FullDesc = preg_replace("/(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:watch\?(?:[\w-=&]*&)?v=|(?:|v)\/))([\w-]+)[\w-=&#;]*/", "<iframe allowfullscreen frameborder='0' height='315' src='https://www.youtube.com/embed/$1'; width='560'></iframe>", $FullDesc);
							
					}

					if ($zenfeed_global_squarebrackets == 1) {
						$PreviewDesc = preg_replace('/\[(.+?)\].+\[\/(.+?)\]/', '', $PreviewDesc);
						$FullDesc = preg_replace('/\[(.+?)\].+\[\/(.+?)\]/', '', $FullDesc);
					}

					if (($item->getElement($ElmImage)->data())) {
				
					$ElmImageData = $item->getElement($ElmImage)->data();
					$ElmImageApp = $zoo->data->create($ElmImageData);
					$Image = trim($ElmImageApp->find('0.file'));

					$pathtoimage = JPATH_ROOT .'/'. $Image;

					if (file_exists($pathtoimage)) {
						@$image_mime = image_type_to_mime_type(exif_imagetype($pathtoimage)); 
					}
			

					}

					if ($zenfeed_img_domain == 1) {
						$patt = '/<\s*img[^>]*src=[\"|\'](.*?)[\"|\'][^>]*\/*>/i';
						$FullMatchImg = preg_match_all($patt, $FullDesc, $matchFull);
						foreach ($matchFull[1] as $matchimage) {
							if (!strstr($matchimage,'http')) {
								$FullDesc = str_replace($matchimage, JURI::base().$matchimage, $FullDesc); // work
							}
						}
						$FullMatchImg = preg_match_all($patt, $PreviewDesc, $matchPreview);
						foreach ($matchPreview[1] as $matchimagesmall) {
							if (!strstr($matchimagesmall,'http')) {
								$PreviewDesc = str_replace($matchimagesmall, JURI::base().$matchimagesmall, $PreviewDesc); // work
							}
						}
					}

					if (!empty($FullDesc) || !empty($PreviewDesc)) {
				
						$rssYaLenta .= "\n";
						if ($turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) { $rssYaLenta .= '<item turbo="true">'; }
						else {
							$rssYaLenta .= '<item>';
						}
						$rssYaLenta .= "\n";
					$rssYaLenta .= '<title>'.$itemName.'</title>'."\n";
					$rssYaLenta .= '<link>'.$itemUrl.'</link>'."\n";
					$rssYaLenta .= '<guid>'.md5($itemUrl).'</guid>'."\n";
					$rssYaLenta .= '<pubDate>'.$itemCreated.' '.$zenfeed_site_time.'</pubDate>'."\n";
					$rssYaLenta .= '<media:rating scheme="urn:simple">nonadult</media:rating>'."\n";
					$rssYaLenta .= '<author>'.$itemAuthor.'</author>'."\n";
					
					$ImgesEnclos = $PreviewDesc . $FullDesc;
					preg_match_all('@src="([^"]+)"@', $ImgesEnclos, $matchesenc);
					if ($matchesenc) {
						if ($matchesenc[1] && !empty($matchesenc[1])) {
							foreach (array_unique($matchesenc[1]) as $imgenc) {
								if (strstr($imgenc,'http')) {
								$imgenc = str_replace(JURI::base().JURI::base(),JURI::base(),$imgenc);
								@$image_mimeecn = image_type_to_mime_type(exif_imagetype($imgenc)); 
								$rssYaLenta .= "\n".'<enclosure url="'.$imgenc.'" type="'.$image_mimeecn.'"/>'."\n";
								}
								else {
								
								@$image_mimeecn = image_type_to_mime_type(exif_imagetype(JURI::base().$imgenc)); 
								$rssYaLenta .= "\n".'<enclosure url="'.JURI::base().$imgenc.'" type="'.$image_mimeecn.'"/>'."\n";
								}
							}
						}
					}

					if ($zenfeed_cat_replace == '1' && $zenfeed_cat_replace_jbzoo == '0') {

					$checkarrayreplacecatname = strpos($zenfeed_cat_replace_catname,',');
						if ($checkarrayreplacecatname !== false) {
						$massivcatreplacename = explode(',',$zenfeed_cat_replace_catname);
						$countmascat = count($massivcatreplacename);
					}

					$offyandexcats = array (
						'Авто', 'Война', 'Дизайн', 'Дом', 'Еда', 'Здоровье', 'Знаменитости', 'Игры', 'Кино', 'Культура', 'Литература', 'Мода', 'Музыка', 'Наука', 'Общество', 'Политика', 'Природа', 'Происшествия', 'Психология', 'Путешествия', 'Спорт', 'Технологии', 'Фотографии', 'Хобби', 'Экономика', 'Юмор' 
					);
						foreach ($allCategories as $category) {
							if (!in_array($category->name, $offyandexcats)) {

								for ($i=0; $i < $countmascat; $i++) { 
									$rssYaLenta .= "\n".'<category>'.trim($massivcatreplacename[$i]).'</category>';
								}

							}
						}
					}
			
					if ($zenfeed_cat_replace == '1' && $zenfeed_cat_replace_jbzoo == '1' && !empty($zenfeed_cat_replace_jbzoo_element_checkbox)) {

					$catforzenjbzoo = $item->getElement($zenfeed_cat_replace_jbzoo_element_checkbox)->render();
			
					$massivcatreplacenamez = explode(',',$catforzenjbzoo);
					$countmascats = count($massivcatreplacenamez);
					if (!empty($massivcatreplacenamez)) {
					for ($i=0; $i < $countmascats; $i++) { 
							if (strlen($massivcatreplacenamez[$i]) > 3) {
								$rssYaLenta .= "\n".'<category>'.trim($massivcatreplacenamez[$i]).'</category>';
							}
						}
					}
			
					}

					if ($zenfeed_cat_replace == '0') {
						$rssYaLenta .= $allcatinitem;
					}

				
					if ( !empty($Image) && !empty($image_mime) && $zenfeed_site_jbzoo_turbo == 0 ) {
				
					$rssYaLenta .= "\n".'<enclosure url="'.JURI::base().$Image.'" type="'.$image_mime.'"/>';
				
					}


					if ($zenfeed_comcontent_descmini == 0) {
						$rssYaLenta .= '<description><![CDATA['.$PreviewDesc.']]></description>';
						$rssYaLenta .= "\n";
					}

					if ($zenfeed_comcontent_descmini == 1) {
						$rssYaLenta .= '<description><![CDATA['.mb_substr($PreviewDesc, 0, $zenfeed_comcontent_descmini_count).']]></description>';
						$rssYaLenta .= "\n"; // 
					}

					
					if ($turbopage != $zenfeed_site_pwdturbo) {
						
						$rssYaLenta .= '<content:encoded><![CDATA['.$FullDesc.'';
				
			
					if (!empty($figure[1])) {
						foreach ($figure[1] as $figureItem) {
					$figureItem = str_replace('"','', $figureItem);
				
							@$sImg = getimagesize($figureItem); //Warning, if img delete
							$figureItem = trim($figureItem);
				
							if (!strpos('http',$figureItem)) {
								$figureItem = JURI::base().$figureItem;
							}
				
							$figures .= '
							<figure>
							<img src="'.$figureItem.'" width="'.$sImg[0].'" height="'.$sImg[1].'">
							<figcaption>'.$itemName.'</figcaption>
							</figure>';
				
						}
					
					$rssYaLenta .= $figures;
				
					}
			
					$pathtoimage = JPATH_ROOT .'/'. $Image;

					if (file_exists($pathtoimage)) {
						@$oneImg = getimagesize($pathtoimage); //Warning, if img delete
										
						$rssYaLenta .= '
						<figure>
						<img src="'.JURI::base().$Image.'" width="'.$oneImg[0].'" height="'.$oneImg[1].'">
						<figcaption>'.$itemName.'</figcaption>
						</figure>';
			
						$rssYaLenta .= ']]></content:encoded>
						';
					} 
				}

					if ($turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {

					$rssYaLenta .= '<turbo:content><![CDATA[';
					
				
						if (!empty($figure[1])) {
							foreach ($figure[1] as $figureItem) {
						$figureItem = str_replace('"','', $figureItem);
					
								@$sImg = getimagesize($figureItem); //Warning, if img delete
								$figureItem = trim($figureItem);
					
								if (!strpos('http',$figureItem)) {
									$figureItem = JURI::base().$figureItem;
								}
					
								$figures .= '
								<header>
								<h1>'.$itemName.'</h1>
								<figure>
								<img src="'.$figureItem.'" width="'.$sImg[0].'" height="'.$sImg[1].'">
								<figcaption>'.$itemName.'</figcaption>
								</figure></header>';
					
							}
						
						$rssYaLenta .= $figures;
					
						}
				
						$pathtoimage = JPATH_ROOT .'/'. $Image;
	
						if (file_exists($pathtoimage)) {
							@$oneImg = getimagesize($pathtoimage); //Warning, if img delete
											
							$rssYaLenta .= '
							<header>
							<h1>'.$itemName.'</h1>
							<figure>
							<img src="'.JURI::base().$Image.'" width="'.$oneImg[0].'" height="'.$oneImg[1].'">
							<figcaption>'.$itemName.'</figcaption>
							</figure></header>';
						} 
							$rssYaLenta .= $FullDesc.']]></turbo:content>'."\n";

						}


						if (file_exists($pathtoimage)) {
							@$oneImg = getimagesize($pathtoimage); //Warning, if img delete
							$rssYaLenta .= "\n".'<enclosure url="'.JURI::base().$Image.'" type="'.$image_mime.'"/>';
						} 

						
						if ($figure) {
							if (!empty($figure[1]) && $figure[1]) {

							foreach ($figure[1] as $imageenc) {
								@$image_mimeecn = image_type_to_mime_type(exif_imagetype(JURI::base().$imageenc)); 
								$rssYaLenta .= "\n".'<enclosure url="'.JURI::base().$imageenc.'" type="'.$image_mimeecn.'"/>';
							}
							
							}
						}


						
						$rssYaLenta .= "\n".'</item>'."\n";
				
					}

		
				}
				
				$rssYaLenta .= '</channel></rss>';
				
		
		if ($turbopage == $zenfeed_site_pwdturbo) {
				$cache->store($rssYaLenta, 'rssfeedforyandexzen');
		}

		if ($zenpage == $zenfeed_site_pwd_zen) {
				$cache->store($rssYaLenta, 'rssfeedforyandexzenpage');
		}
				
		if ($zenfeed_xmlfeed == 1) {
			header('Content-type: text/xml; charset=utf-8');
			header('Content-Disposition: inline'); 
			echo trim($rssYaLenta);
			exit;
		}
		else {
			return trim($rssYaLenta);
		}

				}
			
			}
			else {
				
				if ( $turbopage == $zenfeed_site_pwdturbo) {
					if ($zenfeed_xmlfeed == 1) {
						echo $cache->get('rssfeedforyandexzen');
						exit;
					}
					else {
						return $cache->get('rssfeedforyandexzen');
					}
				}

				if ( $zenpage == $zenfeed_site_pwd_zen) {
					if ($zenfeed_xmlfeed == 1) {
						echo $cache->get('rssfeedforyandexzenpage');
						exit;
					}
					else {
						return $cache->get('rssfeedforyandexzenpage');
					}
				}
			}
		}
		elseif ($zenfeed_who == '2') {
			//k2
			


			switch ($randompage) {
				case '-1':
					$randompage = 'ORDER BY RAND()';
					$zenfeed_site_rss_limit = $zenfeed_site_db_random;
					$zenfeed_site_db_limit = $zenfeed_site_db_random;
					break;
				
				default:
					$randompage = 'ORDER BY a.created';
					break;
			}


			JLoader::register('ContentHelperRoute', JPATH_SITE . '/components/com_content/helpers/route.php');
			require_once(JPATH_SITE.DS.'components'.DS.'com_k2'.DS.'helpers'.DS.'route.php');

			JTable::addIncludePath(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_k2'.DS.'tables');

			$model = K2Model::getInstance('Item', 'K2Model');

			$componentParams = JComponentHelper::getParams('com_k2');

			
					if (((!$rssYaLenta = $cache->get('rssfeedforyandexzen')) && $turbopage == $zenfeed_site_pwdturbo) || ((!$rssYaLenta = $cache->get('rssfeedforyandexzenpage')) && $zenpage == $zenfeed_site_pwd_zen))
			
					{
							
						$siteName = htmlspecialchars($zenfeed_sitename);
						$siteDesc = htmlspecialchars($zenfeed_sitedesc);
				
						$checkarraycatcontent = strpos($zenfeed_com_content_catid_k2,',');
					
								
						if ($checkarraycatcontent !== false) {
			
										$ar_cat_comc = explode(',',$zenfeed_com_content_catid_k2);
										$countmascc = count($ar_cat_comc);
										$textcatsid = array();
										for ($i=0; $i < $countmascc; $i++) { 
											$textcatsid[] = $ar_cat_comc[$i];
										}
										
										$db = JFactory::getDbo();     
										$query = $db->getQuery(true);  
										$query = '
										SELECT 
											a.*
										FROM 
											#__k2_items AS a 
											LEFT JOIN #__k2_categories AS c ON ( a.catid = c.id ) 
											WHERE a.published = 1 AND a.catid IN  ('.implode(',',$textcatsid).')
											AND a.language = "'.(string)$zenfeed_comcontent_k2_lang.'"
											'.$randompage.' DESC  LIMIT '.(int)$zenfeed_site_db_limit."";
										$db->setQuery($query);  
										$items = $db->loadObjectList();
									
						}
						
						else {

							$db = JFactory::getDbo();     
							$query = $db->getQuery(true);  
							$query = '
							SELECT 
								a.*
							FROM 
								#__k2_items AS a 
								LEFT JOIN #__k2_categories AS c ON ( a.catid = c.id ) 
								WHERE a.published = 1 AND a.catid = "'.(int)$zenfeed_com_content_catid_k2.'"
								AND a.language = "'.(string)$zenfeed_comcontent_k2_lang.'"
								'.$randompage.' DESC  LIMIT '.(int)$zenfeed_site_db_limit."";
							$db->setQuery($query);    
							$items = $db->loadObjectList();
						
				
						}
						
						if (!empty($items)) {
							$rssYaLenta = '<?xml version="1.0" encoding="UTF-8"?>
							<rss version="2.0"
							xmlns:content="http://purl.org/rss/1.0/modules/content/"
							xmlns:dc="http://purl.org/dc/elements/1.1/"
							xmlns:media="http://search.yahoo.com/mrss/"
							xmlns:atom="http://www.w3.org/2005/Atom"
							xmlns:georss="http://www.georss.org/georss"';
			
							if ($turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {	$rssYaLenta .= "\n".
								'							xmlns:yandex="http://news.yandex.ru" 
							xmlns:turbo="http://turbo.yandex.ru"';
								}
			
							$rssYaLenta .= '>';
							$rssYaLenta .= '
								<channel>
									<title>'.$siteName.'</title>
									<link>'.JURI::base().'</link>
									<description>'.$siteDesc.'</description>
									<language>'.$zenfeed_sitelang.'</language>'."";
									if ($zenfeed_site_jbzoo_turbo_li == 1 && $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
										$rssYaLenta .= "\n".'<yandex:analytics type="LiveInternet"></yandex:analytics>';
									}
									if (!empty($zenfeed_site_jbzoo_turbo_yaid) && $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
										$rssYaLenta .= "\n".'<yandex:analytics type="Yandex" id="'.$zenfeed_site_jbzoo_turbo_yaid.'"/>';
									}
									if (!empty($zenfeed_site_jbzoo_turbo_googleid) && $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
										$rssYaLenta .= "\n".'<yandex:analytics id="'.$zenfeed_site_jbzoo_turbo_googleid.'" type="Google"></yandex:analytics>';
									}
									if (!empty($zenfeed_site_jbzoo_turbo_ya_rsya) && $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
										$rssYaLenta .= "\n".'<yandex:adNetwork type="Yandex" id="'.$zenfeed_site_jbzoo_turbo_ya_rsya.'" turbo-ad-id="first_ad_place"></yandex:adNetwork>';
									}
									if (!empty($zenfeed_site_jbzoo_turbo_ya_rsya2) && $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
										$rssYaLenta .= "\n".'<yandex:adNetwork type="Yandex" id="'.$zenfeed_site_jbzoo_turbo_ya_rsya2.'" turbo-ad-id="second_ad_place"></yandex:adNetwork>';
									}
									if (!empty($zenfeed_site_jbzoo_turbo_ya_rsya3) && $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
										$rssYaLenta .= "\n".'<yandex:adNetwork type="Yandex" id="'.$zenfeed_site_jbzoo_turbo_ya_rsya3.'" turbo-ad-id="third_ad_place"></yandex:adNetwork>';
									}
									if (!empty($zenfeed_site_jbzoo_turbo_ad_fox) && !empty($zenfeed_site_jbzoo_turbo_ad_fox_container) &&  $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
										$rssYaLenta .= "\n"."<yandex:adNetwork
										type='AdFox'
										turbo-ad-id='before_first_ad_fox_place'>
										   <![CDATA[
											   <div id='".$zenfeed_site_jbzoo_turbo_ad_fox_container."'></div>
											   <script>
												   window.Ya.adfoxCode.create({
													   ownerId: ".$zenfeed_site_jbzoo_turbo_ad_fox.",
													   containerId: '".$zenfeed_site_jbzoo_turbo_ad_fox_container."',
													   params: {
														   pp: 'g',
														   ps: 'cmic',
														   p2: 'fqem'
													   }
												   });
											   </script>
										   ]]>
									   </yandex:adNetwork>";
									}
			
					
							$items = array_slice($items, 0, (int)$zenfeed_site_rss_limit);
							$Infiltertags = '';
							$filtertags = explode(',',$zenfeed_com_content_filterstriptags_k2);
							foreach($filtertags as $ftags) {
								$Infiltertags .= '<'.$ftags.'>';
							}
						
							// $Infiltertags = substr($Infiltertags,0,-1);

							function searchForId($id, $array) {
								foreach ($array as $key) {
									if ($key->alias == $id) {
										return $key;
									}
								}
								return null;
							 }

							foreach ($items as $item) {
								
								$rootURL = rtrim(JURI::base(),'/');

								if ($zenfeed_comcontent_k2_gallery == 1) {

								$galId = preg_replace("/[^0-9]/", '', $item->gallery);

									if ($galId !== '' && $galId !== NULL && !empty($galId)) {
										$galfiles = JFolder::files( JPATH_SITE . DS . 'media' . DS . 'k2' . DS . 'galleries' . DS . $galId, '\.jpg|\.png$', true, true );
										$galfiles = str_replace(JPATH_ROOT, '', $galfiles);
										$galfiles = str_replace('\\', '/', $galfiles);
										$k2itemgallery = "\n" . '<div data-block="gallery"><header>Галерея изображений</header>';

											for ($i=0; $i < count($galfiles); $i++) { 
												$k2itemgallery .= '<img src="'.$rootURL.$galfiles[$i].'"/>';
											}

										$k2itemgallery .= '</div>';
									}

								}
									
								if ($zenfeed_comcontent_k2_video == 1) {
	
								preg_match_all("/{.+}(.+){.+}/", $item->video, $videoId);
								$videoId = $videoId[1][0];

								if ($videoId !== '' && $videoId !== NULL && !empty($videoId)) {


									if (strstr($item->video,'{YouTube}')) {
										$k2itemvideo .= "\n" . '<iframe
										width="560"
										height="315"
										src="https://www.youtube.com/embed/'.$videoId.'" 
										frameborder="0" 
										allowfullscreen>
									   </iframe>';
									}
	
									if (strstr($item->video,'{Vimeo}')) {
										$k2itemvideo .= "\n" . '<iframe src="https://player.vimeo.com/video/'.$videoId.'?title=0&byline=0&portrait=0" width="640" height="360" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
									}

									if (strstr($item->video,'{mp4}') && $item->id == $videoId) {
										$k2videofiles = JPATH_SITE . DS . 'media' . DS . 'k2' . DS . 'videos' . DS . $videoId . '.mp4';
										$k2videofiles = str_replace(JPATH_ROOT, '', $k2videofiles);
										$k2videofiles = str_replace('\\', '/', $k2videofiles);
										$k2itemvideo = "\n" . '<figure>';
										$k2itemvideo .= '<video><source src="'.$rootURL.$k2videofiles.'" type="video/mp4" /></video>"/>';
										$k2itemvideo .= '</figure>';

									}
	
								}
		
								}
								
								$itemID = $item->id;
								$itemName = htmlspecialchars($item->title);
								$itemName = str_replace('«','&quot;',$itemName);
								$itemName = str_replace('»','&quot;',$itemName);
								$itemCreated = $item->created;
								$itemCreated = JHtml::_('date', $itemCreated, 'Y-m-d H:i:s', JFactory::getApplication()->getCfg('offset'), true);
								$itemAuthor = JFactory::getUser($item->created_by)->name;
								if (empty($itemAuthor) && $zenfeed_site_defauthor_set == '1' && $zenfeed_site_defauthor_set_fix == '0') {
									$itemAuthor = $zenfeed_site_defauthor;
								}
								if ($zenfeed_site_defauthor_set_fix == '1') {
									$itemAuthor = $zenfeed_site_defauthor;
								}

								$category = JTable::getInstance('K2Category', 'Table');
								$category->load($item->catid);

								$rootURL = rtrim(JURI::base(),'/');
								$subpathURL = JURI::base(true);
								if(!empty($subpathURL) && ($subpathURL != '/')) {
									$rootURL = substr($rootURL, 0, -1 * strlen($subpathURL));
								}

								$item->category = $category;
								$item->category->link = urldecode(JRoute::_(K2HelperRoute::getCategoryRoute($category->id.':'.urlencode($category->alias))));

								$link = K2HelperRoute::getItemRoute($item->id.':'.urlencode($item->alias), $item->catid.':'.urlencode($item->category->alias));

								$itemUrl = urldecode($rootURL.JRoute::_($link));
								
							
								$PreviewDesc = $item->introtext;
								$FullDesc = $item->fulltext;
								$figure = '';
								$figures = '';
								$figureintext = '';
						
								if ($zenfeed_images_path == 1) {

								$PreviewDesc = str_replace('src="images','src="/images',$PreviewDesc);
								$FullDesc = str_replace('src="images','src="/images',$FullDesc);
								$PreviewDesc = str_replace('//images/','/images/',$PreviewDesc);
								$FullDesc = str_replace('//images/','/images/',$FullDesc);
								
								}

								if ($zenfeed_comcontent_pre_k2 == 1) {
			
								$PreviewDesc = preg_replace('/<pre.*<\/pre>/ui', $zenfeed_comcontent_pre_text_k2, $PreviewDesc);
			
								$FullDesc = preg_replace('/<pre.*<\/pre>/ui', $zenfeed_comcontent_pre_text_k2, $FullDesc);
									
								}
				
									if ($zenfeed_global_classes == 1) {
										if (!empty($zenfeed_global_classes_textarea)) {
											$regexplist = explode(PHP_EOL,trim($zenfeed_global_classes_textarea));
											if (!empty($regexplist[0])) {
												for ($i=0; $i < count($regexplist); $i++) { 
													$PreviewDesc = preg_replace("#{$regexplist[$i]}#", "", $PreviewDesc);
												    $FullDesc = preg_replace("#{$regexplist[$i]}#", "", $FullDesc);
												}
											}
										}
									}
			
									if ($zenfeed_global_youtube == 1) {
										
										$PreviewDesc = preg_replace("/(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:watch\?(?:[\w-=&]*&)?v=|(?:|v)\/))([\w-]+)[\w-=&#;]*/", "<iframe allowfullscreen frameborder='0' height='315' src='https://www.youtube.com/embed/$1'; width='560'></iframe>", $PreviewDesc);

										$FullDesc = preg_replace("/(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:watch\?(?:[\w-=&]*&)?v=|(?:|v)\/))([\w-]+)[\w-=&#;]*/", "<iframe allowfullscreen frameborder='0' height='315' src='https://www.youtube.com/embed/$1'; width='560'></iframe>", $FullDesc);
											
									}
										
								if ($zenfeed_global_squarebrackets == 1) {
										$PreviewDesc = preg_replace('/\[(.+?)\].+\[\/(.+?)\]/', '', $PreviewDesc);
										$FullDesc = preg_replace('/\[(.+?)\].+\[\/(.+?)\]/', '', $FullDesc);
								}

								if ($zenfeed_comcontent_striptags_k2 == 1) {
									$PreviewDesc = trim(strip_tags($PreviewDesc, $Infiltertags));
								}
			
								if ($zenfeed_comcontent_biem_k2 == 1 && $zenfeed_comcontent_striptags_k2 == 0) {
									
								$PreviewDesc = str_replace('<b>','',$PreviewDesc);
								$PreviewDesc = str_replace('</b>','',$PreviewDesc);
									
								$PreviewDesc = str_replace('<i>','',$PreviewDesc);
								$PreviewDesc = str_replace('</i>','',$PreviewDesc);
									
								$PreviewDesc = str_replace('<strong>','',$PreviewDesc);
								$PreviewDesc = str_replace('</strong>','',$PreviewDesc);
									
								$PreviewDesc = str_replace('<em>','',$PreviewDesc);
								$PreviewDesc = str_replace('</em>','',$PreviewDesc);
			
								}
			
								$PreviewDesc = str_replace('«','&quot;',$PreviewDesc);
								$PreviewDesc = str_replace('»','&quot;',$PreviewDesc);
								$PreviewDesc = str_replace('<br>','<br />',$PreviewDesc);
								$PreviewDesc = preg_replace('/<p(?:([\'"]).*?\1|.)*?>/ui', '<p>', $PreviewDesc);
								$PreviewDesc = preg_replace("/\{.*?}/ius", "", $PreviewDesc);

								if ($zenfeed_delete_noturbotag == 1) {
									$PreviewDesc = preg_replace("/<noturbo>.*?<\/noturbo>/ius", "", $PreviewDesc);
								}

								preg_match_all('@src="([^"]+)"@' , $FullDesc, $figureintext );
			
								if ($zenfeed_comcontent_striptags_k2 == 1) {
			
									$FullDesc = trim(strip_tags($FullDesc, $Infiltertags));
									$FullDesc = str_replace('«','&quot;',$FullDesc);
									$FullDesc = str_replace('»','&quot;',$FullDesc);
									$FullDesc = str_replace('&nbsp;',' ',$FullDesc);
									$FullDesc = preg_replace('/<p(?:([\'"]).*?\1|.)*?>/ui', '<p>', $FullDesc);
									$FullDesc = str_replace('alt=""','',$FullDesc);
									$FullDesc = str_replace("title=''","",$FullDesc);
									// $FullDesc = preg_replace("/<img[^>]+>/ius", "", $FullDesc);
									// $FullDesc = str_replace('<p></p>','',$FullDesc);
									// $FullDesc = str_replace('<br>','<br />',$FullDesc);
								}
			
								if ($zenfeed_comcontent_biem_k2 == 1 && $zenfeed_comcontent_striptags_k2 == 0) {
			
								$FullDesc = str_replace('<b>','',$FullDesc);
								$FullDesc = str_replace('</b>','',$FullDesc);
									
								$FullDesc = str_replace('<i>','',$FullDesc);
								$FullDesc = str_replace('</i>','',$FullDesc);
									
								$FullDesc = str_replace('<strong>','',$FullDesc);
								$FullDesc = str_replace('</strong>','',$FullDesc);
									
								$FullDesc = str_replace('<em>','',$FullDesc);
								$FullDesc = str_replace('</em>','',$FullDesc);
			
								}
			
								$FullDesc = str_replace('«','&quot;',$FullDesc);
								$FullDesc = str_replace('»','&quot;',$FullDesc);
								$FullDesc = str_replace('<br>','<br />',$FullDesc);
			
								
								$FullDesc = preg_replace("/\{.*?}/ius", "", $FullDesc);
				
								if ($zenfeed_delete_noturbotag == 1) {
									$FullDesc = preg_replace("/<noturbo>.*?<\/noturbo>/ius", "", $FullDesc);
								}

								if ($zenfeed_img_domain == 1) {
									$patt = '/<\s*img[^>]*src=[\"|\'](.*?)[\"|\'][^>]*\/*>/i';
									$FullMatchImg = preg_match_all($patt, $FullDesc, $matchFull);
									foreach ($matchFull[1] as $matchimage) {
										if (!strstr($matchimage,'http')) {
											$FullDesc = str_replace($matchimage, JURI::base().$matchimage, $FullDesc); // work
										}
									}
									$FullMatchImg = preg_match_all($patt, $PreviewDesc, $matchPreview);
									foreach ($matchPreview[1] as $matchimagesmall) {
										if (!strstr($matchimagesmall,'http')) {
											$PreviewDesc = str_replace($matchimagesmall, JURI::base().$matchimagesmall, $PreviewDesc); // work
										}
									}
								}

						if ($zenfeed_comcontent_publish_k2 == 1) {
							$itemCreated = $item->publish_up;
							$itemCreated = JHtml::_('date', $itemCreated, 'Y-m-d H:i:s', JFactory::getApplication()->getCfg('offset'), true);

						}

						if (strtotime($itemCreated) < strtotime($nowtime)) {
					
									$rssYaLenta .= "\n";
									if ($turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) { $rssYaLenta .= '<item turbo="true">'; }
									else {
										$rssYaLenta .= '<item>';
									}
									$rssYaLenta .= "\n";
									$rssYaLenta .= '<title>'.$itemName.'</title>';
									$rssYaLenta .= "\n";
									$rssYaLenta .= '<link>'.$itemUrl.'</link>';
									$rssYaLenta .= "\n";
									$rssYaLenta .= '<guid>'.md5($itemUrl).'</guid>';
									$rssYaLenta .= "\n";
									$rssYaLenta .= '<pubDate>'.$itemCreated.' '.$zenfeed_site_time.'</pubDate>';
									$rssYaLenta .= "\n";
									$rssYaLenta .= '<media:rating scheme="urn:simple">nonadult</media:rating>';
									$rssYaLenta .= "\n";
									$rssYaLenta .= '<author>'.$itemAuthor.'</author>';
									$rssYaLenta .= "\n";

									$ImgesEnclos = $PreviewDesc . $FullDesc;
									preg_match_all('@src="([^"]+)"@', $ImgesEnclos, $matchesenc);
									if ($matchesenc) {
										if ($matchesenc[1] && !empty($matchesenc[1])) {
											foreach (array_unique($matchesenc[1]) as $imgenc) {
												if (strstr($imgenc,'http')) {
												$imgenc = str_replace(JURI::base().JURI::base(),JURI::base(),$imgenc);
												@$image_mimeecn = image_type_to_mime_type(exif_imagetype($imgenc)); 
												$rssYaLenta .= "\n".'<enclosure url="'.$imgenc.'" type="'.$image_mimeecn.'"/>'."\n";
												}
												else {
												
												@$image_mimeecn = image_type_to_mime_type(exif_imagetype(JURI::base().$imgenc)); 
												$rssYaLenta .= "\n".'<enclosure url="'.JURI::base().$imgenc.'" type="'.$image_mimeecn.'"/>'."\n";
												}
											}
										}
									}

									
									switch ($zenfeed_comcontent_k2_img_size) {
										case '0':
											$K2imagesize = '_'.'Generic'.'.jpg';
											break;
										case '1':
											$K2imagesize = '_'.'XS'.'.jpg';
											break;
										case '2':
											$K2imagesize = '_'.'S'.'.jpg';
											break;
										case '3':
											$K2imagesize = '_'.'M'.'.jpg';
											break;
										case '4':
											$K2imagesize = '_'.'L'.'.jpg';
											break;
										case '5':
											$K2imagesize = '_'.'XL'.'.jpg';
											break;
										
										default:
										$K2imagesize = '_'.'Generic'.'.jpg';
										break;
									}
			
			
												
									if (JFile::exists(JPATH_SITE.'/media/k2/items/cache/'.md5("Image".$item->id).$K2imagesize))
									{
										$itemk2image = $rootURL.'/media/k2/items/cache/'.md5("Image".$item->id).$K2imagesize;
										@$image_mimeecn = image_type_to_mime_type(exif_imagetype($itemk2image)); 
										$rssYaLenta .= '<enclosure url="'.$itemk2image.'" type="'.$image_mimeecn.'"/>';
									}

								if ($zenfeed_cat_replace == '1') {
			
								$checkarrayreplacecatname = strpos($zenfeed_cat_replace_catname,',');
								if ($checkarrayreplacecatname !== false) {
									$massivcatreplacename = explode(',',$zenfeed_cat_replace_catname);
									$countmascat = count($massivcatreplacename);
								}
			
						
								$offyandexcats = array (
									'Авто', 'Война', 'Дизайн', 'Дом', 'Еда', 'Здоровье', 'Знаменитости', 'Игры', 'Кино', 'Культура', 'Литература', 'Мода', 'Музыка', 'Наука', 'Общество', 'Политика', 'Природа', 'Происшествия', 'Психология', 'Путешествия', 'Спорт', 'Технологии', 'Фотографии', 'Хобби', 'Экономика', 'Юмор' 
								);
			
						
								for ($i=0; $i < $countmascat; $i++) { 
												$rssYaLenta .= '<category>'.trim($massivcatreplacename[$i]).'</category>';
												$rssYaLenta .= "\n";
								}
			
						
									
								}
								else {
									$rssYaLenta .= "\n".'<category>'.$category->name.'</category>';
									$rssYaLenta .= "\n";
								}
							
								if ($zenfeed_comcontent_descmini_k2 == 0) {
									if ($zenfeed_comcontent_descmini_striptags_k2 == 0) {
										$rssYaLenta .= '<description><![CDATA['.$PreviewDesc.']]></description>';
									}
									else {
										$rssYaLenta .= '<description><![CDATA['.strip_tags($PreviewDesc).']]></description>';
									}
									
									$rssYaLenta .= "\n";
								}
				
								if ($zenfeed_comcontent_descmini_k2 == 1) {
									if ($zenfeed_comcontent_descmini_striptags_k2 == 0) {
										$rssYaLenta .= '<description><![CDATA['.mb_substr($PreviewDesc, 0, $zenfeed_comcontent_descmini_count_k2).']]></description>';
									}
									else {
										$rssYaLenta .= '<description><![CDATA['.strip_tags(mb_substr($PreviewDesc, 0, $zenfeed_comcontent_descmini_count_k2)).']]></description>';
									}
				
									$rssYaLenta .= "\n"; // 
								}
			
			
									if (empty($FullDesc)) {
										$FullDesc = $PreviewDesc;
									}
			
									if ($zenfeed_comcontent_introtofull_k2 == 1 && $zenfeed_site_snippet_center == 0) {
										$FullDesc = $PreviewDesc . $FullDesc;
									}
											
									if ($zenfeed_comcontent_introtofull_k2 == 1 && $zenfeed_site_snippet_center == 1 && empty($zenfeed_site_jbzoo_turbo_ya_rsya) && $turbopage != $zenfeed_site_pwdturbo) {
										$FullDesc = $PreviewDesc . "\n" . trim($zenfeed_site_snippet_center_text) . "\n" . $FullDesc;
									}

									if ($zenfeed_comcontent_introtofull_k2 == 1 && $zenfeed_site_snippet_center == 1 && !empty($zenfeed_site_jbzoo_turbo_ya_rsya) && $turbopage == $zenfeed_site_pwdturbo) {
										$FullDesc = $PreviewDesc . "\n" . trim($zenfeed_site_snippet_center_text) . "\n" .' <figure data-turbo-ad-id="second_ad_place"></figure> ' . "\n" . $FullDesc;
									}

									
					if ($turbopage != $zenfeed_site_pwdturbo) {
										
														
									$rssYaLenta .= '<content:encoded><![CDATA['.$FullDesc.'';
									$rssYaLenta .= "\n";
								
									if ($zenfeed_comcontent_imagetotopplease == 1) {	

										if (JFile::exists(JPATH_SITE.'/media/k2/items/cache/'.md5("Image".$item->id).$K2imagesize))
										{
											$itemk2image = $rootURL.'/media/k2/items/cache/'.md5("Image".$item->id).$K2imagesize;
										}
		
					if ($zenfeed_comcontent_previmage_k2 == 1 && empty($itemk2image)) {
					preg_match('@src="([^"]+)"@' , $PreviewDesc, $figureintextprev );

					$mainimg = $figureintextprev[1];

					if (!empty($mainimg) && strlen($mainimg) > 5 && NULL !== $mainimg) {
					$figcapt = $itemName;
					
					@$InImg = getimagesize(JURI::base().$mainimg); //Warning, if img delete	

					$rssYaLenta .= '
					<header>
					<h1>'.$itemName.'</h1>
					<figure>
					<img src="'.$mainimg.'">
					<figcaption>'.$figcapt.'</figcaption>
					</figure>
					</header>';

						}
					}

					if (!empty($itemk2image) && $zenfeed_k2_noimage == 0) {
						$figcapt = $itemName;
						$mainimg = $itemk2image;
	
						$rssYaLenta .= '
						<header>
						<h1>'.$itemName.'</h1>
						<figure>
						<img src="'.$mainimg.'">
						<figcaption>'.$figcapt.'</figcaption>
						</figure>
						</header>';
					}

					// @$image_mimeecn = image_type_to_mime_type(exif_imagetype($mainimg)); 
					// $rssYaLenta .= "\n".'<enclosure url="'.$mainimg.'" type="'.$image_mimeecn.'"/>';
				
		}

								$rssYaLenta .= "\n";
								$rssYaLenta .= ']]>';
								$rssYaLenta .= "\n";
								$rssYaLenta .= '</content:encoded>';
								// $rssYaLenta .= "\n";
			
			}
			
			if ($turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
			
								$rssYaLenta .= '<turbo:content><![CDATA[';
								$rssYaLenta .= "\n";
							
						if ($zenfeed_site_snippet_top == 1 && !empty($zenfeed_site_snippet_top_text)) {
							$rssYaLenta .= trim($zenfeed_site_snippet_top_text) . "\n";
						}
								
						
						if (!empty($zenfeed_site_jbzoo_turbo_ya_rsya) && $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
							$rssYaLenta .= "\n".' <figure data-turbo-ad-id="first_ad_place"></figure> ' . "\n";
						}
							
							
					if ($zenfeed_comcontent_imagetotopplease == 1) {	

						if (JFile::exists(JPATH_SITE.'/media/k2/items/cache/'.md5("Image".$item->id).$K2imagesize))
						{
							$itemk2image = $rootURL.'/media/k2/items/cache/'.md5("Image".$item->id).$K2imagesize;
						}

					
								if ($zenfeed_comcontent_previmage_k2 == 1 && empty($itemk2image)) {
								preg_match('@src="([^"]+)"@' , $PreviewDesc, $figureintextprev );
			
								$mainimg = $figureintextprev[1];
			
								if (!empty($mainimg) && strlen($mainimg) > 5 && NULL !== $mainimg) {
								$figcapt = $itemName;
								
								@$InImg = getimagesize(JURI::base().$mainimg); //Warning, if img delete	
			
								$rssYaLenta .= '
								<header>
								<h1>'.$itemName.'</h1>
								<figure>
								<img src="'.$mainimg.'">
								<figcaption>'.$figcapt.'</figcaption>
								</figure>
								</header>';
			
									}
								}

								if (!empty($itemk2image) && $zenfeed_k2_noimage == 0) {
									$figcapt = $itemName;
									$mainimg = $itemk2image;
				
									$rssYaLenta .= '
									<header>
									<h1>'.$itemName.'</h1>
									<figure>
									<img src="'.$mainimg.'">
									<figcaption>'.$figcapt.'</figcaption>
									</figure>
									</header>';
								}

								// @$image_mimeecn = image_type_to_mime_type(exif_imagetype($mainimg)); 
								// $rssYaLenta .= "\n".'<enclosure url="'.$mainimg.'" type="'.$image_mimeecn.'"/>';
					}
			
			
					if ($zenfeed_comcontent_k2_extrafields == 1) {
						$k2obj = new K2ModelItem(); 
						$fields = $k2obj->getItemExtraFields($item->extra_fields, $item); 

						$ar_alias_k2_extra = explode(',',$zenfeed_comcontent_k2_extrafields_alias);
						$countk2extra = count($ar_alias_k2_extra);
						$k2extraf = array();
						for ($i=0; $i < $countk2extra; $i++) { 
							$k2extraf[] = $ar_alias_k2_extra[$i];
						}

						if (count($k2extraf) > 0) {

							$rssYaLenta .= "\n";
							$rssYaLenta .= '<ul>';
						for ($i=0; $i < count($k2extraf); $i++) { 
							$k2extrafields = searchForId($k2extraf[$i], $fields);
							
						 if (null !== $k2extrafields) {
							$rssYaLenta .= '<li>'.$k2extrafields->name.': ' . $k2extrafields->value . '</li>';
						 }

						}
							$rssYaLenta .= '</ul>';
							$rssYaLenta .= "\n";
						}
						
						
					}

					if ($zenfeed_comcontent_introtofull == 0 && $zenfeed_site_snippet_center == 1 && !empty($zenfeed_site_jbzoo_turbo_ya_rsya2) && $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
						$rssYaLenta .= "\n" .' <figure data-turbo-ad-id="second_ad_place"></figure> ' . "\n";
					}
			
							$rssYaLenta .= $FullDesc;
										
						if ($zenfeed_site_snippet_bottom == 1 && !empty($zenfeed_site_snippet_bottom_text)) {
							$rssYaLenta .= "\n" . trim($zenfeed_site_snippet_bottom_text) . "\n";
						}

						if (!empty($zenfeed_site_jbzoo_turbo_ya_rsya3) && $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
							$FullDesc = $PreviewDesc . "\n" . trim($zenfeed_site_snippet_center_text) . "\n" .' <figure data-turbo-ad-id="third_ad_place"></figure> ' . $FullDesc;
						}

						
							if ($zenfeed_comcontent_k2_gallery == 1) {
								$rssYaLenta .= $k2itemgallery;
							}

							if ($zenfeed_comcontent_k2_video == 1) {
								$rssYaLenta .= $k2itemvideo;
							}

							$k2itemgallery = '';
							$k2itemvideo = '';


						if ($zenfeed_comcontent_k2_related_articles_block == 1) {

								$rssYaLenta .= '<'.$zenfeed_comcontent_k2_related_articles_text_tag.'>'.$zenfeed_comcontent_k2_related_articles_text.'</'.$zenfeed_comcontent_k2_related_articles_text_tag.'>';

								$block_items = array();
								$block = array();
								
								$text_items = $items;

								for ($i=0; $i < $zenfeed_comcontent_k2_related_articles_text_count + 1 ; $i++) { 

								$linkblock = K2HelperRoute::getItemRoute($text_items[$i]->id.':'.urlencode($text_items[$i]->alias), $text_items[$i]->catid.':'.urlencode($text_items[$i]->category->alias));

								$itemUrlblock = urldecode($rootURL.JRoute::_($linkblock));

								$itemk2imageblock = $rootURL.'/media/k2/items/cache/'.md5("Image".$text_items[$i]->id).$K2imagesize;

								if ($text_items[$i]->id == $itemID) {
									$block[] = null;
								}

								else {
									$block[] = array('id' => $text_items[$i]->id,
											   'itemname' => $text_items[$i]->title,
											   'link' => $itemUrlblock,
											   'itemimage' => $itemk2imageblock);
											   
									}
								}

								$block_items = array_diff($block, array(0, null));

								$rssYaLenta .= "\n".'<ul>';

								if ($zenfeed_comcontent_k2_related_articles_block_img == 0) {
									$imgblock = '';
								}
								else {
									$imgblock = '<img src="'.$block_item['itemimage'].'">';
								}

							foreach ($block_items as $block_item) {
									$rssYaLenta .= '<li> <a target="_blank" href="'.$block_item['link'].'">  '.$imgblock. ' ' .$block_item['itemname'].'</a></li>';
							}


								$rssYaLenta .= '</ul>';

							}


							$rssYaLenta .= ']]>';
							$rssYaLenta .= "\n";
							$rssYaLenta .= '</turbo:content>';
							
									}

									if ($figure) {
										if (!empty($figure[1]) && $figure[1]) {

										foreach ($figure[1] as $imageenc) {
											@$image_mimeecn = image_type_to_mime_type(exif_imagetype(JURI::base().$imageenc)); 
											$rssYaLenta .= "\n".'<enclosure url="'.JURI::base().$imageenc.'" type="'.$image_mimeecn.'"/>';
										}
										
			
										}
									}
			
									
							if ($zenfeed_comcontent_k2_related_articles == 1) {

								$rssYaLenta .= '<'.$zenfeed_comcontent_k2_related_articles_text_tag.'>'.$zenfeed_comcontent_k2_related_articles_text.'</'.$zenfeed_comcontent_k2_related_articles_text_tag.'>';

								$block_items = array();
								$block = array();
								
								$text_items = $items;

								for ($i=0; $i < $zenfeed_comcontent_k2_related_articles_text_count + 1 ; $i++) { 

								$linkblock = K2HelperRoute::getItemRoute($text_items[$i]->id.':'.urlencode($text_items[$i]->alias), $text_items[$i]->catid.':'.urlencode($text_items[$i]->category->alias));

								$itemUrlblock = urldecode($rootURL.JRoute::_($linkblock));

								$itemk2imageblock = $rootURL.'/media/k2/items/cache/'.md5("Image".$text_items[$i]->id).$K2imagesize;

								if ($text_items[$i]->id == $itemID) {
									$block[] = null;
								}

								else {
									$block[] = array('id' => $text_items[$i]->id,
											   'itemname' => $text_items[$i]->title,
											   'link' => $itemUrlblock,
											   'itemimage' => $itemk2imageblock);
											   
									}
								}

								$block_items = array_diff($block, array(0, null));

								$rssYaLenta .= "\n".'<yandex:related type="infinity">';

							foreach ($block_items as $block_item) {
									$rssYaLenta .= '<link url="'.$block_item['link'].'"	img="'.$block_item['itemimage'].'">'.$block_item['itemname'].' </link>';
							}


								$rssYaLenta .= '</yandex:related>';

							}
									
									$rssYaLenta .= "\n".'</item>'."\n";

								}
								// k2
							}
							
					
							$rssYaLenta .= '</channel></rss>';
							
					
					if ($turbopage == $zenfeed_site_pwdturbo) {
							$cache->store($rssYaLenta, 'rssfeedforyandexzen');
					}
			
					if ($zenpage == $zenfeed_site_pwd_zen) {
							$cache->store($rssYaLenta, 'rssfeedforyandexzenpage');
					}
			
					if ($zenfeed_xmlfeed == 1) {
						header('Content-type: text/xml; charset=utf-8');
						header('Content-Disposition: inline'); 
						echo trim($rssYaLenta);
						exit;
					}
					else {
						return trim($rssYaLenta);
					}
			
							}
						
						}
						else {
				
							if ( $turbopage == $zenfeed_site_pwdturbo) {
								if ($zenfeed_xmlfeed == 1) {
									echo $cache->get('rssfeedforyandexzen');
									exit;
								}
								else {
									return $cache->get('rssfeedforyandexzen');
								}
							}
			
							if ( $zenpage == $zenfeed_site_pwd_zen) {
								if ($zenfeed_xmlfeed == 1) {
									echo $cache->get('rssfeedforyandexzenpage');
									exit;
								}
								else {
									return $cache->get('rssfeedforyandexzenpage');
								}
							}
						}
			
					}
					elseif ($zenfeed_who == '3') {
						//JBZoo all types
							
						if (((!$rssYaLenta = $cache->get('rssfeedforyandexzen')) && $turbopage == $zenfeed_site_pwdturbo) || ((!$rssYaLenta = $cache->get('rssfeedforyandexzenpage')) && $zenpage == $zenfeed_site_pwd_zen))
			
						{
							// go one type JBZoo
							
							if ($zenfeed_site_jbzoo_gen_on_1 == 1) {
							
							if ($zenfeed_site_jbzoo_category_nested == 1) {
								$zenfeed_site_jbzoo_category_nested = true;
							}
							else {
								$zenfeed_site_jbzoo_category_nested = false;
							}
							// JBZoo::init();
							$zoo = App::getInstance('zoo');
							$db = JFactory::getDBO();
							$doc = JFactory::getDocument();
							$appId = $zenfeed_site_jbzoo_app_alltypes_1;
							$ElmImage = $zenfeed_site_jbzoo_image_alltypes_1;
							$ElmDescPreview = $zenfeed_site_jbzoo_descpreview_alltypes_1;
							$ElmDescFull = $zenfeed_site_jbzoo_descfull_alltypes_1;
							$siteName = htmlspecialchars($zenfeed_sitename);
							$siteDesc = htmlspecialchars($zenfeed_sitedesc);
							$typeId = $zenfeed_site_jbzoo_type_alltypes_1; 
							$items = '';
							$all_items = array();
			
							$checkarraycatzoo = strpos($zenfeed_site_jbzoo_catid_alltypes_1,',');
							
							if ($checkarraycatzoo !== false)  {
								$massivcatzoo = explode(',',$zenfeed_site_jbzoo_catid_alltypes_1);
								$countmas = count($massivcatzoo);
			
								$options = array(
									'category_nested' => $zenfeed_site_jbzoo_category_nested_alltypes_1, 
									'limit' => array(0, $zenfeed_site_rss_limit), // offset и limit
									'user' => false, 
									'published' => 1,
									'order' => 'rdate'
								);
				
								
					
							for ($i=0; $i < $countmas; $i++) { 
			
								$yaCategoryModel = $zoo->table->category->get($massivcatzoo[$i]);
								$url = $zoo->route->category($yaCategoryModel);
								$items = JBModelItem::model()->getList($appId, $massivcatzoo[$i], $typeId, $options);
								$all_items[] = $items;
							}
			
				
							function cmp($a, $b){
								$ad = strtotime($a->created);
								$bd = strtotime($b->created);
								return ($bd-$ad);
							}
							
								$arrOut = array();
							
								foreach($all_items as $subArr) {
								$arrOut = array_merge($arrOut, $subArr);
								}
			
						
								usort($arrOut, 'cmp');
								
					
								$items = $arrOut;
			
						
							}
							else {
			
								$options = array(
									'category_nested' => $zenfeed_site_jbzoo_category_nested_alltypes_1, 
									'limit' => array(0, $zenfeed_site_rss_limit), // offset и limit
									'user' => false, 
									'published' => 1,
									'order' => 'rdate'
								);
								
								$yaCategoryModel = $zoo->table->category->get($zenfeed_site_jbzoo_catid_alltypes_1);
								$url = $zoo->route->category($yaCategoryModel);
								$items = JBModelItem::model()->getList($appId, $zenfeed_site_jbzoo_catid_alltypes_1, $typeId, $options);
							}
							
							if (!empty($items)) {
							$BeginrssYaLenta = '<?xml version="1.0" encoding="UTF-8"?>
							<rss version="2.0"
							xmlns:content="http://purl.org/rss/1.0/modules/content/"
							xmlns:dc="http://purl.org/dc/elements/1.1/"
							xmlns:media="http://search.yahoo.com/mrss/"
							xmlns:atom="http://www.w3.org/2005/Atom"
							xmlns:georss="http://www.georss.org/georss"';
							
							if ($turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {	$BeginrssYaLenta .= "\n".
							'				xmlns:yandex="http://news.yandex.ru" 
							xmlns:turbo="http://turbo.yandex.ru"';
							}
			
							$BeginrssYaLenta .= '>';
							$BeginrssYaLenta .= '
								<channel>
									<title>'.$siteName.'</title>
									<link>'.JURI::base().'</link>
									<description>'.$siteDesc.'</description>
									<language>'.$zenfeed_sitelang.'</language>'."";
									if ($zenfeed_site_jbzoo_turbo_li == 1 && $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
										$BeginrssYaLenta .= "\n".'<yandex:analytics type="LiveInternet"></yandex:analytics>';
									}
									if (!empty($zenfeed_site_jbzoo_turbo_yaid) && $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
										$BeginrssYaLenta .= "\n".'<yandex:analytics type="Yandex" id="'.$zenfeed_site_jbzoo_turbo_yaid.'"/>';
									}
									if (!empty($zenfeed_site_jbzoo_turbo_googleid) && $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
										$BeginrssYaLenta .= "\n".'<yandex:analytics id="'.$zenfeed_site_jbzoo_turbo_googleid.'" type="Google"></yandex:analytics>';
									}
									if (!empty($zenfeed_site_jbzoo_turbo_ya_rsya) && $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
										$BeginrssYaLenta .= "\n".'<yandex:adNetwork type="Yandex" id="'.$zenfeed_site_jbzoo_turbo_ya_rsya.'" turbo-ad-id="first_ad_place"></yandex:adNetwork>';
									}
							$items = array_slice($items, 0, (int)$zenfeed_site_rss_limit);		
							
					
							foreach ($items as $item) {
						
						
								$itemID = $item->id;
								$itemName = htmlspecialchars($item->name);
								$itemName = str_replace('«','&quot;',$itemName);
								$itemName = str_replace('»','&quot;',$itemName);
								$itemCreated = $item->created;
								$itemCreated = JHtml::_('date', $itemCreated, 'Y-m-d H:i:s', JFactory::getApplication()->getCfg('offset'), true);
								$itemAuthor = JFactory::getUser($item->created_by)->name;
								if (empty($itemAuthor) && $zenfeed_site_defauthor_set == '1' && $zenfeed_site_defauthor_set_fix == '0') {
									$itemAuthor = $zenfeed_site_defauthor;
								}
								if ($zenfeed_site_defauthor_set_fix == '1') {
									$itemAuthor = $zenfeed_site_defauthor;
								}
								$allCategories = $item->getRelatedCategories();
								$primaryId = $item->getPrimaryCategoryId();
								$resultcat = array();
								foreach($allCategories as $category) {
										$resultcat[] = '<category>'.$category->name.'</category>';
								}
							
								$allcatinitem = implode("\n",$resultcat);
								$itemUrl = $zoo->jbrouter->externalItem($item);
								$category = $item->getPrimaryCategory()->name;

								if (!empty($ElmDescPreview)) {
									$PreviewDesc = $item->getElement($ElmDescPreview)->data();
									$PreviewDescApp = $zoo->data->create($PreviewDesc);
								}
								else {
									$PreviewDesc = $item->getElement($ElmDescFull)->data();
									$PreviewDescApp = $zoo->data->create($FullDesc);
								}

								if ($zenfeed_site_jbzoo_descpreview_alltypes_gen_1 == 1) {
									$PreviewDesc = $item->getElement($ElmDescFull)->data();
									$PreviewDescApp = $zoo->data->create($FullDesc);
								}
								
								$FullDesc = $item->getElement($ElmDescFull)->data();
								$FullDescApp = $zoo->data->create($FullDesc);
								$figure = '';
								$figures = '';
						
								if ($zenfeed_images_path == 1) {
									$PreviewDesc = str_replace('src="images','src="/images',$PreviewDesc);
									$FullDesc = str_replace('src="images','src="/images',$FullDesc);
									$PreviewDesc = str_replace('//images/','/images/',$PreviewDesc);
									$FullDesc = str_replace('//images/','/images/',$FullDesc);
								}
								$PreviewDesc = htmlspecialchars(trim(strip_tags($PreviewDescApp->find('0.value'))));
								$PreviewDesc = str_replace('«','&quot;',$PreviewDesc);
								$PreviewDesc = str_replace('»','&quot;',$PreviewDesc);
								$PreviewDesc = str_replace('<br>','<br />',$PreviewDesc);
								$PreviewDesc = preg_replace("/\{.*?}/ius", "", $PreviewDesc);
								$FullDesc = trim($FullDescApp->find('0.value'));
								$FullDesc = preg_replace("/\{.*?}/ius", "", $FullDesc);
								
								$FullDesc = str_replace('«','&quot;',$FullDesc);
								$FullDesc = str_replace('»','&quot;',$FullDesc);
								$FullDesc = str_replace('&nbsp;',' ',$FullDesc);
								$FullDesc = str_replace(' style="text-align: justify;"','',$FullDesc);
								$FullDesc = str_replace('alt=""','',$FullDesc);
								$FullDesc = str_replace("title=''","",$FullDesc);
								preg_match_all("/<img.+?src=[\"'](.+?)[\"'].*?>/ius", $FullDesc, $figure);
								// $FullDesc = preg_replace("/<img[^>]+>/ius", "", $FullDesc);
								$FullDesc = str_replace('<p></p>','',$FullDesc);
								$FullDesc = str_replace('<br>','<br />',$FullDesc);
						
								if (($item->getElement($ElmImage)->data())) {
							
								$ElmImageData = $item->getElement($ElmImage)->data();
								$ElmImageApp = $zoo->data->create($ElmImageData);
								$Image = trim($ElmImageApp->find('0.file'));
			
								$pathtoimage = JPATH_ROOT .'/'. $Image;
			
								if (file_exists($pathtoimage)) {
									@$image_mime = image_type_to_mime_type(exif_imagetype($pathtoimage)); 
								}
						
			
								}
			
								if ($zenfeed_img_domain == 1) {
									$patt = '/<\s*img[^>]*src=[\"|\'](.*?)[\"|\'][^>]*\/*>/i';
									$FullMatchImg = preg_match_all($patt, $FullDesc, $matchFull);
									foreach ($matchFull[1] as $matchimage) {
										if (!strstr($matchimage,'http')) {
											$FullDesc = str_replace($matchimage, JURI::base().$matchimage, $FullDesc); // work
										}
									}
									$FullMatchImg = preg_match_all($patt, $PreviewDesc, $matchPreview);
									foreach ($matchPreview[1] as $matchimagesmall) {
										if (!strstr($matchimagesmall,'http')) {
											$PreviewDesc = str_replace($matchimagesmall, JURI::base().$matchimagesmall, $PreviewDesc); // work
										}
									}
								}
			
								if (!empty($FullDesc) || !empty($PreviewDesc)) {
							
									$rssYaLenta .= "\n";
									if ($turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) { $rssYaLenta .= '<item turbo="true">'; }
									else {
										$rssYaLenta .= '<item>';
									}
									$rssYaLenta .= "\n";
								$rssYaLenta .= '<title>'.$itemName.'</title>'."\n";
								$rssYaLenta .= '<link>'.$itemUrl.'</link>'."\n";
								$rssYaLenta .= '<guid>'.md5($itemUrl).'</guid>'."\n";
								$rssYaLenta .= '<pubDate>'.$itemCreated.' '.$zenfeed_site_time.'</pubDate>'."\n";
								$rssYaLenta .= '<media:rating scheme="urn:simple">nonadult</media:rating>'."\n";
								$rssYaLenta .= '<author>'.$itemAuthor.'</author>'."\n";
								
								$ImgesEnclos = $PreviewDesc . $FullDesc;
								preg_match_all('@src="([^"]+)"@', $ImgesEnclos, $matchesenc);
								if ($matchesenc) {
									if ($matchesenc[1] && !empty($matchesenc[1])) {
										foreach (array_unique($matchesenc[1]) as $imgenc) {
											if (strstr($imgenc,'http')) {
											$imgenc = str_replace(JURI::base().JURI::base(),JURI::base(),$imgenc);
											@$image_mimeecn = image_type_to_mime_type(exif_imagetype($imgenc)); 
											$rssYaLenta .= "\n".'<enclosure url="'.$imgenc.'" type="'.$image_mimeecn.'"/>'."\n";
											}
											else {
											
											@$image_mimeecn = image_type_to_mime_type(exif_imagetype(JURI::base().$imgenc)); 
											$rssYaLenta .= "\n".'<enclosure url="'.JURI::base().$imgenc.'" type="'.$image_mimeecn.'"/>'."\n";
											}
										}
									}
								}
			
								if ($zenfeed_cat_replace == '1' && $zenfeed_cat_replace_jbzoo == '0') {
			
								$checkarrayreplacecatname = strpos($zenfeed_cat_replace_catname,',');
									if ($checkarrayreplacecatname !== false) {
									$massivcatreplacename = explode(',',$zenfeed_cat_replace_catname);
									$countmascat = count($massivcatreplacename);
								}
			
								$offyandexcats = array (
									'Авто', 'Война', 'Дизайн', 'Дом', 'Еда', 'Здоровье', 'Знаменитости', 'Игры', 'Кино', 'Культура', 'Литература', 'Мода', 'Музыка', 'Наука', 'Общество', 'Политика', 'Природа', 'Происшествия', 'Психология', 'Путешествия', 'Спорт', 'Технологии', 'Фотографии', 'Хобби', 'Экономика', 'Юмор' 
								);
									foreach ($allCategories as $category) {
										if (!in_array($category->name, $offyandexcats)) {
			
											for ($i=0; $i < $countmascat; $i++) { 
												$rssYaLenta .= "\n".'<category>'.trim($massivcatreplacename[$i]).'</category>';
											}
			
										}
									}
								}
						
								if ($zenfeed_cat_replace == '1' && $zenfeed_cat_replace_jbzoo == '1' && !empty($zenfeed_cat_replace_jbzoo_element_checkbox_alltypes_1)) {
			
								$catforzenjbzoo = $item->getElement($zenfeed_cat_replace_jbzoo_element_checkbox_alltypes_1)->render();
						
								$massivcatreplacenamez = explode(',',$catforzenjbzoo);
								$countmascats = count($massivcatreplacenamez);
								if (!empty($massivcatreplacenamez)) {
								for ($i=0; $i < $countmascats; $i++) { 
										if (strlen($massivcatreplacenamez[$i]) > 3) {
											$rssYaLenta .= "\n".'<category>'.trim($massivcatreplacenamez[$i]).'</category>';
										}
									}
								}
						
								}
			
								if ($zenfeed_cat_replace == '0') {
									$rssYaLenta .= $allcatinitem;
								}
			
							
								if ( !empty($Image) && !empty($image_mime) && $zenfeed_site_jbzoo_turbo == 0 ) {
							
								$rssYaLenta .= "\n".'<enclosure url="'.JURI::base().$Image.'" type="'.$image_mime.'"/>';
							
								}
			
							
								if ($zenfeed_site_jbzoo_descpreview_descmini_1 == 0) {
									if ($zenfeed_site_jbzoo_descpreview_descmini_striptags_1 == 0) {
										$rssYaLenta .= '<description><![CDATA['.$PreviewDesc.']]></description>';
									}
									else {
										$rssYaLenta .= '<description><![CDATA['.strip_tags($PreviewDesc).']]></description>';
									}
									
									$rssYaLenta .= "\n";
								}
				
								if ($zenfeed_site_jbzoo_descpreview_descmini_1 == 1) {
									if ($zenfeed_site_jbzoo_descpreview_descmini_striptags_1 == 0) {
										$rssYaLenta .= '<description><![CDATA['.mb_substr($PreviewDesc, 0, $zenfeed_site_jbzoo_descpreview_descmini_count_1).']]></description>';
									}
									else {
										$rssYaLenta .= '<description><![CDATA['.strip_tags(mb_substr($PreviewDesc, 0, $zenfeed_site_jbzoo_descpreview_descmini_count_1)).']]></description>';
									}
				
									$rssYaLenta .= "\n";  
								}

								
								if ($turbopage != $zenfeed_site_pwdturbo) {
									
									$rssYaLenta .= '<content:encoded><![CDATA['.$FullDesc.'';
							
						
								if (!empty($figure[1])) {
									foreach ($figure[1] as $figureItem) {
								$figureItem = str_replace('"','', $figureItem);
							
										@$sImg = getimagesize($figureItem); //Warning, if img delete
										$figureItem = trim($figureItem);
							
										if (!strpos('http',$figureItem)) {
											$figureItem = JURI::base().$figureItem;
										}
							
										$figures .= '
										<figure>
										<img src="'.$figureItem.'" width="'.$sImg[0].'" height="'.$sImg[1].'">
										<figcaption>'.$itemName.'</figcaption>
										</figure>';
							
									}
								
								$rssYaLenta .= $figures;
							
								}
						
								$pathtoimage = JPATH_ROOT .'/'. $Image;
			
								if (file_exists($pathtoimage)) {
									@$oneImg = getimagesize($pathtoimage); //Warning, if img delete
													
									$rssYaLenta .= '
									<figure>
									<img src="'.JURI::base().$Image.'" width="'.$oneImg[0].'" height="'.$oneImg[1].'">
									<figcaption>'.$itemName.'</figcaption>
									</figure>';
						
									$rssYaLenta .= ']]></content:encoded>
									';
								} 
							}
			
								if ($turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
			
								$rssYaLenta .= '<turbo:content><![CDATA[';
								
							
									if (!empty($figure[1])) {
										foreach ($figure[1] as $figureItem) {
									$figureItem = str_replace('"','', $figureItem);
								
											@$sImg = getimagesize($figureItem); //Warning, if img delete
											$figureItem = trim($figureItem);
								
											if (!strpos('http',$figureItem)) {
												$figureItem = JURI::base().$figureItem;
											}
								
											$figures .= '
											<header>
											<h1>'.$itemName.'</h1>
											<figure>
											<img src="'.$figureItem.'" width="'.$sImg[0].'" height="'.$sImg[1].'">
											<figcaption>'.$itemName.'</figcaption>
											</figure></header>';
								
										}
									
									$rssYaLenta .= $figures;
								
									}
							
									$pathtoimage = JPATH_ROOT .'/'. $Image;
				
									if (file_exists($pathtoimage)) {
										@$oneImg = getimagesize($pathtoimage); //Warning, if img delete
														
										$rssYaLenta .= '
										<header>
										<h1>'.$itemName.'</h1>
										<figure>
										<img src="'.JURI::base().$Image.'" width="'.$oneImg[0].'" height="'.$oneImg[1].'">
										<figcaption>'.$itemName.'</figcaption>
										</figure></header>';
									} 
										$rssYaLenta .= $FullDesc.']]></turbo:content>'."\n";
			
									}
			
			
									if (file_exists($pathtoimage)) {
										@$oneImg = getimagesize($pathtoimage); //Warning, if img delete
										$rssYaLenta .= "\n".'<enclosure url="'.JURI::base().$Image.'" type="'.$image_mime.'"/>';
									} 
			
									
									if ($figure) {
										if (!empty($figure[1]) && $figure[1]) {
			
										foreach ($figure[1] as $imageenc) {
											@$image_mimeecn = image_type_to_mime_type(exif_imagetype(JURI::base().$imageenc)); 
											$rssYaLenta .= "\n".'<enclosure url="'.JURI::base().$imageenc.'" type="'.$image_mimeecn.'"/>';
										}
										
										}
									}
			
			
									
									$rssYaLenta .= "\n".'</item>'."\n";
							
								}
			
					
							}

			
							}
						
						}
							// go two type JBZoo
							
							if ($zenfeed_site_jbzoo_gen_on_2 == 1) {
							
							if ($zenfeed_site_jbzoo_category_nested == 1) {
								$zenfeed_site_jbzoo_category_nested = true;
							}
							else {
								$zenfeed_site_jbzoo_category_nested = false;
							}
							// JBZoo::init();
							$zoo = App::getInstance('zoo');
							$db = JFactory::getDBO();
							$doc = JFactory::getDocument();
							$appId = $zenfeed_site_jbzoo_app_alltypes_2;
							$ElmImage = $zenfeed_site_jbzoo_image_alltypes_2;
							$ElmDescPreview = $zenfeed_site_jbzoo_descpreview_alltypes_2;
							$ElmDescFull = $zenfeed_site_jbzoo_descfull_alltypes_2;
							$siteName = htmlspecialchars($zenfeed_sitename);
							$siteDesc = htmlspecialchars($zenfeed_sitedesc);
							$typeId = $zenfeed_site_jbzoo_type_alltypes_2; 
							$items = '';
							$all_items = array();
			
							$checkarraycatzoo = strpos($zenfeed_site_jbzoo_catid_alltypes_2,',');
							
							if ($checkarraycatzoo !== false)  {
								$massivcatzoo = explode(',',$zenfeed_site_jbzoo_catid_alltypes_2);
								$countmas = count($massivcatzoo);
			
								$options = array(
									'category_nested' => $zenfeed_site_jbzoo_category_nested_alltypes_2, 
									'limit' => array(0, $zenfeed_site_rss_limit), // offset и limit
									'user' => false, 
									'published' => 1,
									'order' => 'rdate'
								);
				
								
					
							for ($i=0; $i < $countmas; $i++) { 
			
								$yaCategoryModel = $zoo->table->category->get($massivcatzoo[$i]);
								$url = $zoo->route->category($yaCategoryModel);
								$items = JBModelItem::model()->getList($appId, $massivcatzoo[$i], $typeId, $options);
								$all_items[] = $items;
							}
			
				
							function cmp($a, $b){
								$ad = strtotime($a->created);
								$bd = strtotime($b->created);
								return ($bd-$ad);
							}
							
								$arrOut = array();
							
								foreach($all_items as $subArr) {
								$arrOut = array_merge($arrOut, $subArr);
								}
			
						
								usort($arrOut, 'cmp');
								
					
								$items = $arrOut;
			
						
							}
							else {
			
								$options = array(
									'category_nested' => $zenfeed_site_jbzoo_category_nested_alltypes_2, 
									'limit' => array(0, $zenfeed_site_rss_limit), // offset и limit
									'user' => false, 
									'published' => 1,
									'order' => 'rdate'
								);
								
								$yaCategoryModel = $zoo->table->category->get($zenfeed_site_jbzoo_catid_alltypes_2);
								$url = $zoo->route->category($yaCategoryModel);
								$items = JBModelItem::model()->getList($appId, $zenfeed_site_jbzoo_catid_alltypes_2, $typeId, $options);
							}
							
							if (!empty($items)) {
							$BeginrssYaLenta = '<?xml version="1.0" encoding="UTF-8"?>
							<rss version="2.0"
							xmlns:content="http://purl.org/rss/1.0/modules/content/"
							xmlns:dc="http://purl.org/dc/elements/1.1/"
							xmlns:media="http://search.yahoo.com/mrss/"
							xmlns:atom="http://www.w3.org/2005/Atom"
							xmlns:georss="http://www.georss.org/georss"';
							
							if ($turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {	$BeginrssYaLenta .= "\n".
							'				xmlns:yandex="http://news.yandex.ru" 
							xmlns:turbo="http://turbo.yandex.ru"';
							}
			
							$BeginrssYaLenta .= '>';
							$BeginrssYaLenta .= '
								<channel>
									<title>'.$siteName.'</title>
									<link>'.JURI::base().'</link>
									<description>'.$siteDesc.'</description>
									<language>'.$zenfeed_sitelang.'</language>'."";
									if ($zenfeed_site_jbzoo_turbo_li == 1 && $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
										$BeginrssYaLenta .= "\n".'<yandex:analytics type="LiveInternet"></yandex:analytics>';
									}
									if (!empty($zenfeed_site_jbzoo_turbo_yaid) && $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
										$BeginrssYaLenta .= "\n".'<yandex:analytics type="Yandex" id="'.$zenfeed_site_jbzoo_turbo_yaid.'"/>';
									}
									if (!empty($zenfeed_site_jbzoo_turbo_googleid) && $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
										$BeginrssYaLenta .= "\n".'<yandex:analytics id="'.$zenfeed_site_jbzoo_turbo_googleid.'" type="Google"></yandex:analytics>';
									}
									if (!empty($zenfeed_site_jbzoo_turbo_ya_rsya) && $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
										$BeginrssYaLenta .= "\n".'<yandex:adNetwork type="Yandex" id="'.$zenfeed_site_jbzoo_turbo_ya_rsya.'" turbo-ad-id="first_ad_place"></yandex:adNetwork>';
									}
							$items = array_slice($items, 0, (int)$zenfeed_site_rss_limit);		
							
					
							foreach ($items as $item) {
						
						
								$itemID = $item->id;
								$itemName = htmlspecialchars($item->name);
								$itemName = str_replace('«','&quot;',$itemName);
								$itemName = str_replace('»','&quot;',$itemName);
								$itemCreated = $item->created;
								$itemCreated = JHtml::_('date', $itemCreated, 'Y-m-d H:i:s', JFactory::getApplication()->getCfg('offset'), true);
								$itemAuthor = JFactory::getUser($item->created_by)->name;
								if (empty($itemAuthor) && $zenfeed_site_defauthor_set == '1' && $zenfeed_site_defauthor_set_fix == '0') {
									$itemAuthor = $zenfeed_site_defauthor;
								}
								if ($zenfeed_site_defauthor_set_fix == '1') {
									$itemAuthor = $zenfeed_site_defauthor;
								}
								$allCategories = $item->getRelatedCategories();
								$primaryId = $item->getPrimaryCategoryId();
								$resultcat = array();
								foreach($allCategories as $category) {
										$resultcat[] = '<category>'.$category->name.'</category>';
								}
							
								$allcatinitem = implode("\n",$resultcat);
								$itemUrl = $zoo->jbrouter->externalItem($item);
								$category = $item->getPrimaryCategory()->name;

								if (!empty($ElmDescPreview)) {
									$PreviewDesc = $item->getElement($ElmDescPreview)->data();
									$PreviewDescApp = $zoo->data->create($PreviewDesc);
								}
								else {
									$PreviewDesc = $item->getElement($ElmDescFull)->data();
									$PreviewDescApp = $zoo->data->create($FullDesc);
								}

								if ($zenfeed_site_jbzoo_descpreview_alltypes_gen_2 == 1) {
									$PreviewDesc = $item->getElement($ElmDescFull)->data();
									$PreviewDescApp = $zoo->data->create($FullDesc);
								}
								
								$FullDesc = $item->getElement($ElmDescFull)->data();
								$FullDescApp = $zoo->data->create($FullDesc);
								$figure = '';
								$figures = '';
								if ($zenfeed_images_path == 1) {
									$PreviewDesc = str_replace('src="images','src="/images',$PreviewDesc);
									$FullDesc = str_replace('src="images','src="/images',$FullDesc);
									$PreviewDesc = str_replace('//images/','/images/',$PreviewDesc);
									$FullDesc = str_replace('//images/','/images/',$FullDesc);
								}
								$PreviewDesc = htmlspecialchars(trim(strip_tags($PreviewDescApp->find('0.value'))));
								$PreviewDesc = str_replace('«','&quot;',$PreviewDesc);
								$PreviewDesc = str_replace('»','&quot;',$PreviewDesc);
								$PreviewDesc = str_replace('<br>','<br />',$PreviewDesc);
								$PreviewDesc = preg_replace("/\{.*?}/ius", "", $PreviewDesc);
								$FullDesc = trim($FullDescApp->find('0.value'));
								$FullDesc = preg_replace("/\{.*?}/ius", "", $FullDesc);
								
								$FullDesc = str_replace('«','&quot;',$FullDesc);
								$FullDesc = str_replace('»','&quot;',$FullDesc);
								$FullDesc = str_replace('&nbsp;',' ',$FullDesc);
								$FullDesc = str_replace(' style="text-align: justify;"','',$FullDesc);
								$FullDesc = str_replace('alt=""','',$FullDesc);
								$FullDesc = str_replace("title=''","",$FullDesc);
								preg_match_all("/<img.+?src=[\"'](.+?)[\"'].*?>/ius", $FullDesc, $figure);
								// $FullDesc = preg_replace("/<img[^>]+>/ius", "", $FullDesc);
								$FullDesc = str_replace('<p></p>','',$FullDesc);
								$FullDesc = str_replace('<br>','<br />',$FullDesc);
						
								if (($item->getElement($ElmImage)->data())) {
							
								$ElmImageData = $item->getElement($ElmImage)->data();
								$ElmImageApp = $zoo->data->create($ElmImageData);
								$Image = trim($ElmImageApp->find('0.file'));
			
								$pathtoimage = JPATH_ROOT .'/'. $Image;
			
								if (file_exists($pathtoimage)) {
									@$image_mime = image_type_to_mime_type(exif_imagetype($pathtoimage)); 
								}
						
			
								}
			
								if ($zenfeed_img_domain == 1) {
									$patt = '/<\s*img[^>]*src=[\"|\'](.*?)[\"|\'][^>]*\/*>/i';
									$FullMatchImg = preg_match_all($patt, $FullDesc, $matchFull);
									foreach ($matchFull[1] as $matchimage) {
										if (!strstr($matchimage,'http')) {
											$FullDesc = str_replace($matchimage, JURI::base().$matchimage, $FullDesc); // work
										}
									}
									$FullMatchImg = preg_match_all($patt, $PreviewDesc, $matchPreview);
									foreach ($matchPreview[1] as $matchimagesmall) {
										if (!strstr($matchimagesmall,'http')) {
											$PreviewDesc = str_replace($matchimagesmall, JURI::base().$matchimagesmall, $PreviewDesc); // work
										}
									}
								}
			
								if (!empty($FullDesc) || !empty($PreviewDesc)) {
							
									$rssYaLenta .= "\n";
									if ($turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) { $rssYaLenta .= '<item turbo="true">'; }
									else {
										$rssYaLenta .= '<item>';
									}
									$rssYaLenta .= "\n";
								$rssYaLenta .= '<title>'.$itemName.'</title>'."\n";
								$rssYaLenta .= '<link>'.$itemUrl.'</link>'."\n";
								$rssYaLenta .= '<guid>'.md5($itemUrl).'</guid>'."\n";
								$rssYaLenta .= '<pubDate>'.$itemCreated.' '.$zenfeed_site_time.'</pubDate>'."\n";
								$rssYaLenta .= '<media:rating scheme="urn:simple">nonadult</media:rating>'."\n";
								$rssYaLenta .= '<author>'.$itemAuthor.'</author>'."\n";
								
								$ImgesEnclos = $PreviewDesc . $FullDesc;
								preg_match_all('@src="([^"]+)"@', $ImgesEnclos, $matchesenc);
								if ($matchesenc) {
									if ($matchesenc[1] && !empty($matchesenc[1])) {
										foreach (array_unique($matchesenc[1]) as $imgenc) {
											if (strstr($imgenc,'http')) {
											$imgenc = str_replace(JURI::base().JURI::base(),JURI::base(),$imgenc);
											@$image_mimeecn = image_type_to_mime_type(exif_imagetype($imgenc)); 
											$rssYaLenta .= "\n".'<enclosure url="'.$imgenc.'" type="'.$image_mimeecn.'"/>'."\n";
											}
											else {
											
											@$image_mimeecn = image_type_to_mime_type(exif_imagetype(JURI::base().$imgenc)); 
											$rssYaLenta .= "\n".'<enclosure url="'.JURI::base().$imgenc.'" type="'.$image_mimeecn.'"/>'."\n";
											}
										}
									}
								}
			
								if ($zenfeed_cat_replace == '1' && $zenfeed_cat_replace_jbzoo == '0') {
			
								$checkarrayreplacecatname = strpos($zenfeed_cat_replace_catname,',');
									if ($checkarrayreplacecatname !== false) {
									$massivcatreplacename = explode(',',$zenfeed_cat_replace_catname);
									$countmascat = count($massivcatreplacename);
								}
			
								$offyandexcats = array (
									'Авто', 'Война', 'Дизайн', 'Дом', 'Еда', 'Здоровье', 'Знаменитости', 'Игры', 'Кино', 'Культура', 'Литература', 'Мода', 'Музыка', 'Наука', 'Общество', 'Политика', 'Природа', 'Происшествия', 'Психология', 'Путешествия', 'Спорт', 'Технологии', 'Фотографии', 'Хобби', 'Экономика', 'Юмор' 
								);
									foreach ($allCategories as $category) {
										if (!in_array($category->name, $offyandexcats)) {
			
											for ($i=0; $i < $countmascat; $i++) { 
												$rssYaLenta .= "\n".'<category>'.trim($massivcatreplacename[$i]).'</category>';
											}
			
										}
									}
								}
						
								if ($zenfeed_cat_replace == '1' && $zenfeed_cat_replace_jbzoo == '1' && !empty($zenfeed_cat_replace_jbzoo_element_checkbox_alltypes_2)) {
			
								$catforzenjbzoo = $item->getElement($zenfeed_cat_replace_jbzoo_element_checkbox_alltypes_2)->render();
						
								$massivcatreplacenamez = explode(',',$catforzenjbzoo);
								$countmascats = count($massivcatreplacenamez);
								if (!empty($massivcatreplacenamez)) {
								for ($i=0; $i < $countmascats; $i++) { 
										if (strlen($massivcatreplacenamez[$i]) > 3) {
											$rssYaLenta .= "\n".'<category>'.trim($massivcatreplacenamez[$i]).'</category>';
										}
									}
								}
						
								}
			
								if ($zenfeed_cat_replace == '0') {
									$rssYaLenta .= $allcatinitem;
								}
			
							
								if ( !empty($Image) && !empty($image_mime) && $zenfeed_site_jbzoo_turbo == 0 ) {
							
								$rssYaLenta .= "\n".'<enclosure url="'.JURI::base().$Image.'" type="'.$image_mime.'"/>';
							
								}
			
							
								if ($zenfeed_site_jbzoo_descpreview_descmini_2 == 0) {
									if ($zenfeed_site_jbzoo_descpreview_descmini_striptags_2 == 0) {
										$rssYaLenta .= '<description><![CDATA['.$PreviewDesc.']]></description>';
									}
									else {
										$rssYaLenta .= '<description><![CDATA['.strip_tags($PreviewDesc).']]></description>';
									}
									
									$rssYaLenta .= "\n";
								}
				
								if ($zenfeed_site_jbzoo_descpreview_descmini_2 == 1) {
									if ($zenfeed_site_jbzoo_descpreview_descmini_striptags_2 == 0) {
										$rssYaLenta .= '<description><![CDATA['.mb_substr($PreviewDesc, 0, $zenfeed_site_jbzoo_descpreview_descmini_count_2).']]></description>';
									}
									else {
										$rssYaLenta .= '<description><![CDATA['.strip_tags(mb_substr($PreviewDesc, 0, $zenfeed_site_jbzoo_descpreview_descmini_count_2)).']]></description>';
									}
				
									$rssYaLenta .= "\n";  
								}

								
								if ($turbopage != $zenfeed_site_pwdturbo) {
									
									$rssYaLenta .= '<content:encoded><![CDATA['.$FullDesc.'';
							
						
								if (!empty($figure[1])) {
									foreach ($figure[1] as $figureItem) {
								$figureItem = str_replace('"','', $figureItem);
							
										@$sImg = getimagesize($figureItem); //Warning, if img delete
										$figureItem = trim($figureItem);
							
										if (!strpos('http',$figureItem)) {
											$figureItem = JURI::base().$figureItem;
										}
							
										$figures .= '
										<figure>
										<img src="'.$figureItem.'" width="'.$sImg[0].'" height="'.$sImg[1].'">
										<figcaption>'.$itemName.'</figcaption>
										</figure>';
							
									}
								
								$rssYaLenta .= $figures;
							
								}
						
								$pathtoimage = JPATH_ROOT .'/'. $Image;
			
								if (file_exists($pathtoimage)) {
									@$oneImg = getimagesize($pathtoimage); //Warning, if img delete
													
									$rssYaLenta .= '
									<figure>
									<img src="'.JURI::base().$Image.'" width="'.$oneImg[0].'" height="'.$oneImg[1].'">
									<figcaption>'.$itemName.'</figcaption>
									</figure>';
						
									$rssYaLenta .= ']]></content:encoded>
									';
								} 
							}
			
								if ($turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
			
								$rssYaLenta .= '<turbo:content><![CDATA[';
								
							
									if (!empty($figure[1])) {
										foreach ($figure[1] as $figureItem) {
									$figureItem = str_replace('"','', $figureItem);
								
											@$sImg = getimagesize($figureItem); //Warning, if img delete
											$figureItem = trim($figureItem);
								
											if (!strpos('http',$figureItem)) {
												$figureItem = JURI::base().$figureItem;
											}
								
											$figures .= '
											<header>
											<h1>'.$itemName.'</h1>
											<figure>
											<img src="'.$figureItem.'" width="'.$sImg[0].'" height="'.$sImg[1].'">
											<figcaption>'.$itemName.'</figcaption>
											</figure></header>';
								
										}
									
									$rssYaLenta .= $figures;
								
									}
							
									$pathtoimage = JPATH_ROOT .'/'. $Image;
				
									if (file_exists($pathtoimage)) {
										@$oneImg = getimagesize($pathtoimage); //Warning, if img delete
														
										$rssYaLenta .= '
										<header>
										<h1>'.$itemName.'</h1>
										<figure>
										<img src="'.JURI::base().$Image.'" width="'.$oneImg[0].'" height="'.$oneImg[1].'">
										<figcaption>'.$itemName.'</figcaption>
										</figure></header>';
									} 
										$rssYaLenta .= $FullDesc.']]></turbo:content>'."\n";
			
									}
			
			
									if (file_exists($pathtoimage)) {
										@$oneImg = getimagesize($pathtoimage); //Warning, if img delete
										$rssYaLenta .= "\n".'<enclosure url="'.JURI::base().$Image.'" type="'.$image_mime.'"/>';
									} 
			
									
									if ($figure) {
										if (!empty($figure[1]) && $figure[1]) {
			
										foreach ($figure[1] as $imageenc) {
											@$image_mimeecn = image_type_to_mime_type(exif_imagetype(JURI::base().$imageenc)); 
											$rssYaLenta .= "\n".'<enclosure url="'.JURI::base().$imageenc.'" type="'.$image_mimeecn.'"/>';
										}
										
										}
									}
			
			
									
									$rssYaLenta .= "\n".'</item>'."\n";
							
								}
			
					
							}

			
							}
						
						}
							// go three type JBZoo
							
							if ($zenfeed_site_jbzoo_gen_on_3 == 1) {
							
							if ($zenfeed_site_jbzoo_category_nested == 1) {
								$zenfeed_site_jbzoo_category_nested = true;
							}
							else {
								$zenfeed_site_jbzoo_category_nested = false;
							}
							// JBZoo::init();
							$zoo = App::getInstance('zoo');
							$db = JFactory::getDBO();
							$doc = JFactory::getDocument();
							$appId = $zenfeed_site_jbzoo_app_alltypes_3;
							$ElmImage = $zenfeed_site_jbzoo_image_alltypes_3;
							$ElmDescPreview = $zenfeed_site_jbzoo_descpreview_alltypes_3;
							$ElmDescFull = $zenfeed_site_jbzoo_descfull_alltypes_3;
							$siteName = htmlspecialchars($zenfeed_sitename);
							$siteDesc = htmlspecialchars($zenfeed_sitedesc);
							$typeId = $zenfeed_site_jbzoo_type_alltypes_3; 
							$items = '';
							$all_items = array();
			
							$checkarraycatzoo = strpos($zenfeed_site_jbzoo_catid_alltypes_3,',');
							
							if ($checkarraycatzoo !== false)  {
								$massivcatzoo = explode(',',$zenfeed_site_jbzoo_catid_alltypes_3);
								$countmas = count($massivcatzoo);
			
								$options = array(
									'category_nested' => $zenfeed_site_jbzoo_category_nested_alltypes_3, 
									'limit' => array(0, $zenfeed_site_rss_limit), // offset и limit
									'user' => false, 
									'published' => 1,
									'order' => 'rdate'
								);
				
								
					
							for ($i=0; $i < $countmas; $i++) { 
			
								$yaCategoryModel = $zoo->table->category->get($massivcatzoo[$i]);
								$url = $zoo->route->category($yaCategoryModel);
								$items = JBModelItem::model()->getList($appId, $massivcatzoo[$i], $typeId, $options);
								$all_items[] = $items;
							}
			
				
							function cmp($a, $b){
								$ad = strtotime($a->created);
								$bd = strtotime($b->created);
								return ($bd-$ad);
							}
							
								$arrOut = array();
							
								foreach($all_items as $subArr) {
								$arrOut = array_merge($arrOut, $subArr);
								}
			
						
								usort($arrOut, 'cmp');
								
					
								$items = $arrOut;
			
						
							}
							else {
			
								$options = array(
									'category_nested' => $zenfeed_site_jbzoo_category_nested_alltypes_3, 
									'limit' => array(0, $zenfeed_site_rss_limit), // offset и limit
									'user' => false, 
									'published' => 1,
									'order' => 'rdate'
								);
								
								$yaCategoryModel = $zoo->table->category->get($zenfeed_site_jbzoo_catid_alltypes_3);
								$url = $zoo->route->category($yaCategoryModel);
								$items = JBModelItem::model()->getList($appId, $zenfeed_site_jbzoo_catid_alltypes_3, $typeId, $options);
							}
							
							if (!empty($items)) {
							$BeginrssYaLenta = '<?xml version="1.0" encoding="UTF-8"?>
							<rss version="2.0"
							xmlns:content="http://purl.org/rss/1.0/modules/content/"
							xmlns:dc="http://purl.org/dc/elements/1.1/"
							xmlns:media="http://search.yahoo.com/mrss/"
							xmlns:atom="http://www.w3.org/2005/Atom"
							xmlns:georss="http://www.georss.org/georss"';
							
							if ($turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {	$BeginrssYaLenta .= "\n".
							'				xmlns:yandex="http://news.yandex.ru" 
							xmlns:turbo="http://turbo.yandex.ru"';
							}
			
							$BeginrssYaLenta .= '>';
							$BeginrssYaLenta .= '
								<channel>
									<title>'.$siteName.'</title>
									<link>'.JURI::base().'</link>
									<description>'.$siteDesc.'</description>
									<language>'.$zenfeed_sitelang.'</language>'."";
									if ($zenfeed_site_jbzoo_turbo_li == 1 && $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
										$BeginrssYaLenta .= "\n".'<yandex:analytics type="LiveInternet"></yandex:analytics>';
									}
									if (!empty($zenfeed_site_jbzoo_turbo_yaid) && $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
										$BeginrssYaLenta .= "\n".'<yandex:analytics type="Yandex" id="'.$zenfeed_site_jbzoo_turbo_yaid.'"/>';
									}
									if (!empty($zenfeed_site_jbzoo_turbo_googleid) && $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
										$BeginrssYaLenta .= "\n".'<yandex:analytics id="'.$zenfeed_site_jbzoo_turbo_googleid.'" type="Google"></yandex:analytics>';
									}
									if (!empty($zenfeed_site_jbzoo_turbo_ya_rsya) && $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
										$BeginrssYaLenta .= "\n".'<yandex:adNetwork type="Yandex" id="'.$zenfeed_site_jbzoo_turbo_ya_rsya.'" turbo-ad-id="first_ad_place"></yandex:adNetwork>';
									}
							$items = array_slice($items, 0, (int)$zenfeed_site_rss_limit);		
							
					
							foreach ($items as $item) {
						
						
								$itemID = $item->id;
								$itemName = htmlspecialchars($item->name);
								$itemName = str_replace('«','&quot;',$itemName);
								$itemName = str_replace('»','&quot;',$itemName);
								$itemCreated = $item->created;
								$itemCreated = JHtml::_('date', $itemCreated, 'Y-m-d H:i:s', JFactory::getApplication()->getCfg('offset'), true);
								$itemAuthor = JFactory::getUser($item->created_by)->name;
								if (empty($itemAuthor) && $zenfeed_site_defauthor_set == '1' && $zenfeed_site_defauthor_set_fix == '0') {
									$itemAuthor = $zenfeed_site_defauthor;
								}
								if ($zenfeed_site_defauthor_set_fix == '1') {
									$itemAuthor = $zenfeed_site_defauthor;
								}
								$allCategories = $item->getRelatedCategories();
								$primaryId = $item->getPrimaryCategoryId();
								$resultcat = array();
								foreach($allCategories as $category) {
										$resultcat[] = '<category>'.$category->name.'</category>';
								}
							
								$allcatinitem = implode("\n",$resultcat);
								$itemUrl = $zoo->jbrouter->externalItem($item);
								$category = $item->getPrimaryCategory()->name;

								if (!empty($ElmDescPreview)) {
									$PreviewDesc = $item->getElement($ElmDescPreview)->data();
									$PreviewDescApp = $zoo->data->create($PreviewDesc);
								}
								else {
									$PreviewDesc = $item->getElement($ElmDescFull)->data();
									$PreviewDescApp = $zoo->data->create($FullDesc);
								}

								if ($zenfeed_site_jbzoo_descpreview_alltypes_gen_3 == 1) {
									$PreviewDesc = $item->getElement($ElmDescFull)->data();
									$PreviewDescApp = $zoo->data->create($FullDesc);
								}
								
								$FullDesc = $item->getElement($ElmDescFull)->data();
								$FullDescApp = $zoo->data->create($FullDesc);
								$figure = '';
								$figures = '';
								if ($zenfeed_images_path == 1) {
									$PreviewDesc = str_replace('src="images','src="/images',$PreviewDesc);
									$FullDesc = str_replace('src="images','src="/images',$FullDesc);
									$PreviewDesc = str_replace('//images/','/images/',$PreviewDesc);
									$FullDesc = str_replace('//images/','/images/',$FullDesc);
								}
								$PreviewDesc = htmlspecialchars(trim(strip_tags($PreviewDescApp->find('0.value'))));
								$PreviewDesc = str_replace('«','&quot;',$PreviewDesc);
								$PreviewDesc = str_replace('»','&quot;',$PreviewDesc);
								$PreviewDesc = str_replace('<br>','<br />',$PreviewDesc);
								$PreviewDesc = preg_replace("/\{.*?}/ius", "", $PreviewDesc);
								$FullDesc = trim($FullDescApp->find('0.value'));
								$FullDesc = preg_replace("/\{.*?}/ius", "", $FullDesc);
								
								$FullDesc = str_replace('«','&quot;',$FullDesc);
								$FullDesc = str_replace('»','&quot;',$FullDesc);
								$FullDesc = str_replace('&nbsp;',' ',$FullDesc);
								$FullDesc = str_replace(' style="text-align: justify;"','',$FullDesc);
								$FullDesc = str_replace('alt=""','',$FullDesc);
								$FullDesc = str_replace("title=''","",$FullDesc);
								preg_match_all("/<img.+?src=[\"'](.+?)[\"'].*?>/ius", $FullDesc, $figure);
								// $FullDesc = preg_replace("/<img[^>]+>/ius", "", $FullDesc);
								$FullDesc = str_replace('<p></p>','',$FullDesc);
								$FullDesc = str_replace('<br>','<br />',$FullDesc);
						
								if (($item->getElement($ElmImage)->data())) {
							
								$ElmImageData = $item->getElement($ElmImage)->data();
								$ElmImageApp = $zoo->data->create($ElmImageData);
								$Image = trim($ElmImageApp->find('0.file'));
			
								$pathtoimage = JPATH_ROOT .'/'. $Image;
			
								if (file_exists($pathtoimage)) {
									@$image_mime = image_type_to_mime_type(exif_imagetype($pathtoimage)); 
								}
						
			
								}
			
								if ($zenfeed_img_domain == 1) {
									$patt = '/<\s*img[^>]*src=[\"|\'](.*?)[\"|\'][^>]*\/*>/i';
									$FullMatchImg = preg_match_all($patt, $FullDesc, $matchFull);
									foreach ($matchFull[1] as $matchimage) {
										if (!strstr($matchimage,'http')) {
											$FullDesc = str_replace($matchimage, JURI::base().$matchimage, $FullDesc); // work
										}
									}
									$FullMatchImg = preg_match_all($patt, $PreviewDesc, $matchPreview);
									foreach ($matchPreview[1] as $matchimagesmall) {
										if (!strstr($matchimagesmall,'http')) {
											$PreviewDesc = str_replace($matchimagesmall, JURI::base().$matchimagesmall, $PreviewDesc); // work
										}
									}
								}
			
								if (!empty($FullDesc) || !empty($PreviewDesc)) {
							
									$rssYaLenta .= "\n";
									if ($turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) { $rssYaLenta .= '<item turbo="true">'; }
									else {
										$rssYaLenta .= '<item>';
									}
									$rssYaLenta .= "\n";
								$rssYaLenta .= '<title>'.$itemName.'</title>'."\n";
								$rssYaLenta .= '<link>'.$itemUrl.'</link>'."\n";
								$rssYaLenta .= '<guid>'.md5($itemUrl).'</guid>'."\n";
								$rssYaLenta .= '<pubDate>'.$itemCreated.' '.$zenfeed_site_time.'</pubDate>'."\n";
								$rssYaLenta .= '<media:rating scheme="urn:simple">nonadult</media:rating>'."\n";
								$rssYaLenta .= '<author>'.$itemAuthor.'</author>'."\n";
								
								$ImgesEnclos = $PreviewDesc . $FullDesc;
								preg_match_all('@src="([^"]+)"@', $ImgesEnclos, $matchesenc);
								if ($matchesenc) {
									if ($matchesenc[1] && !empty($matchesenc[1])) {
										foreach (array_unique($matchesenc[1]) as $imgenc) {
											if (strstr($imgenc,'http')) {
											$imgenc = str_replace(JURI::base().JURI::base(),JURI::base(),$imgenc);
											@$image_mimeecn = image_type_to_mime_type(exif_imagetype($imgenc)); 
											$rssYaLenta .= "\n".'<enclosure url="'.$imgenc.'" type="'.$image_mimeecn.'"/>'."\n";
											}
											else {
											
											@$image_mimeecn = image_type_to_mime_type(exif_imagetype(JURI::base().$imgenc)); 
											$rssYaLenta .= "\n".'<enclosure url="'.JURI::base().$imgenc.'" type="'.$image_mimeecn.'"/>'."\n";
											}
										}
									}
								}
			
								if ($zenfeed_cat_replace == '1' && $zenfeed_cat_replace_jbzoo == '0') {
			
								$checkarrayreplacecatname = strpos($zenfeed_cat_replace_catname,',');
									if ($checkarrayreplacecatname !== false) {
									$massivcatreplacename = explode(',',$zenfeed_cat_replace_catname);
									$countmascat = count($massivcatreplacename);
								}
			
								$offyandexcats = array (
									'Авто', 'Война', 'Дизайн', 'Дом', 'Еда', 'Здоровье', 'Знаменитости', 'Игры', 'Кино', 'Культура', 'Литература', 'Мода', 'Музыка', 'Наука', 'Общество', 'Политика', 'Природа', 'Происшествия', 'Психология', 'Путешествия', 'Спорт', 'Технологии', 'Фотографии', 'Хобби', 'Экономика', 'Юмор' 
								);
									foreach ($allCategories as $category) {
										if (!in_array($category->name, $offyandexcats)) {
			
											for ($i=0; $i < $countmascat; $i++) { 
												$rssYaLenta .= "\n".'<category>'.trim($massivcatreplacename[$i]).'</category>';
											}
			
										}
									}
								}
						
								if ($zenfeed_cat_replace == '1' && $zenfeed_cat_replace_jbzoo == '1' && !empty($zenfeed_cat_replace_jbzoo_element_checkbox_alltypes_3)) {
			
								$catforzenjbzoo = $item->getElement($zenfeed_cat_replace_jbzoo_element_checkbox_alltypes_3)->render();
						
								$massivcatreplacenamez = explode(',',$catforzenjbzoo);
								$countmascats = count($massivcatreplacenamez);
								if (!empty($massivcatreplacenamez)) {
								for ($i=0; $i < $countmascats; $i++) { 
										if (strlen($massivcatreplacenamez[$i]) > 3) {
											$rssYaLenta .= "\n".'<category>'.trim($massivcatreplacenamez[$i]).'</category>';
										}
									}
								}
						
								}
			
								if ($zenfeed_cat_replace == '0') {
									$rssYaLenta .= $allcatinitem;
								}
			
							
								if ( !empty($Image) && !empty($image_mime) && $zenfeed_site_jbzoo_turbo == 0 ) {
							
								$rssYaLenta .= "\n".'<enclosure url="'.JURI::base().$Image.'" type="'.$image_mime.'"/>';
							
								}
			
							
								if ($zenfeed_site_jbzoo_descpreview_descmini_3 == 0) {
									if ($zenfeed_site_jbzoo_descpreview_descmini_striptags_3 == 0) {
										$rssYaLenta .= '<description><![CDATA['.$PreviewDesc.']]></description>';
									}
									else {
										$rssYaLenta .= '<description><![CDATA['.strip_tags($PreviewDesc).']]></description>';
									}
									
									$rssYaLenta .= "\n";
								}
				
								if ($zenfeed_site_jbzoo_descpreview_descmini_3 == 1) {
									if ($zenfeed_site_jbzoo_descpreview_descmini_striptags_3 == 0) {
										$rssYaLenta .= '<description><![CDATA['.mb_substr($PreviewDesc, 0, $zenfeed_site_jbzoo_descpreview_descmini_count_3).']]></description>';
									}
									else {
										$rssYaLenta .= '<description><![CDATA['.strip_tags(mb_substr($PreviewDesc, 0, $zenfeed_site_jbzoo_descpreview_descmini_count_3)).']]></description>';
									}
				
									$rssYaLenta .= "\n";  
								}

								
								if ($turbopage != $zenfeed_site_pwdturbo) {
									
									$rssYaLenta .= '<content:encoded><![CDATA['.$FullDesc.'';
							
						
								if (!empty($figure[1])) {
									foreach ($figure[1] as $figureItem) {
								$figureItem = str_replace('"','', $figureItem);
							
										@$sImg = getimagesize($figureItem); //Warning, if img delete
										$figureItem = trim($figureItem);
							
										if (!strpos('http',$figureItem)) {
											$figureItem = JURI::base().$figureItem;
										}
							
										$figures .= '
										<figure>
										<img src="'.$figureItem.'" width="'.$sImg[0].'" height="'.$sImg[1].'">
										<figcaption>'.$itemName.'</figcaption>
										</figure>';
							
									}
								
								$rssYaLenta .= $figures;
							
								}
						
								$pathtoimage = JPATH_ROOT .'/'. $Image;
			
								if (file_exists($pathtoimage)) {
									@$oneImg = getimagesize($pathtoimage); //Warning, if img delete
													
									$rssYaLenta .= '
									<figure>
									<img src="'.JURI::base().$Image.'" width="'.$oneImg[0].'" height="'.$oneImg[1].'">
									<figcaption>'.$itemName.'</figcaption>
									</figure>';
						
									$rssYaLenta .= ']]></content:encoded>
									';
								} 
							}
			
								if ($turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
			
								$rssYaLenta .= '<turbo:content><![CDATA[';
								
							
									if (!empty($figure[1])) {
										foreach ($figure[1] as $figureItem) {
									$figureItem = str_replace('"','', $figureItem);
								
											@$sImg = getimagesize($figureItem); //Warning, if img delete
											$figureItem = trim($figureItem);
								
											if (!strpos('http',$figureItem)) {
												$figureItem = JURI::base().$figureItem;
											}
								
											$figures .= '
											<header>
											<h1>'.$itemName.'</h1>
											<figure>
											<img src="'.$figureItem.'" width="'.$sImg[0].'" height="'.$sImg[1].'">
											<figcaption>'.$itemName.'</figcaption>
											</figure></header>';
								
										}
									
									$rssYaLenta .= $figures;
								
									}
							
									$pathtoimage = JPATH_ROOT .'/'. $Image;
				
									if (file_exists($pathtoimage)) {
										@$oneImg = getimagesize($pathtoimage); //Warning, if img delete
														
										$rssYaLenta .= '
										<header>
										<h1>'.$itemName.'</h1>
										<figure>
										<img src="'.JURI::base().$Image.'" width="'.$oneImg[0].'" height="'.$oneImg[1].'">
										<figcaption>'.$itemName.'</figcaption>
										</figure></header>';
									} 
										$rssYaLenta .= $FullDesc.']]></turbo:content>'."\n";
			
									}
			
			
									if (file_exists($pathtoimage)) {
										@$oneImg = getimagesize($pathtoimage); //Warning, if img delete
										$rssYaLenta .= "\n".'<enclosure url="'.JURI::base().$Image.'" type="'.$image_mime.'"/>';
									} 
			
									
									if ($figure) {
										if (!empty($figure[1]) && $figure[1]) {
			
										foreach ($figure[1] as $imageenc) {
											@$image_mimeecn = image_type_to_mime_type(exif_imagetype(JURI::base().$imageenc)); 
											$rssYaLenta .= "\n".'<enclosure url="'.JURI::base().$imageenc.'" type="'.$image_mimeecn.'"/>';
										}
										
										}
									}
			
			
									
									$rssYaLenta .= "\n".'</item>'."\n";
							
								}
			
					
							}

			
							}
						
						}
							// go four type JBZoo
							
							if ($zenfeed_site_jbzoo_gen_on_4 == 1) {
							
							if ($zenfeed_site_jbzoo_category_nested == 1) {
								$zenfeed_site_jbzoo_category_nested = true;
							}
							else {
								$zenfeed_site_jbzoo_category_nested = false;
							}
							// JBZoo::init();
							$zoo = App::getInstance('zoo');
							$db = JFactory::getDBO();
							$doc = JFactory::getDocument();
							$appId = $zenfeed_site_jbzoo_app_alltypes_4;
							$ElmImage = $zenfeed_site_jbzoo_image_alltypes_4;
							$ElmDescPreview = $zenfeed_site_jbzoo_descpreview_alltypes_4;
							$ElmDescFull = $zenfeed_site_jbzoo_descfull_alltypes_4;
							$siteName = htmlspecialchars($zenfeed_sitename);
							$siteDesc = htmlspecialchars($zenfeed_sitedesc);
							$typeId = $zenfeed_site_jbzoo_type_alltypes_4; 
							$items = '';
							$all_items = array();
			
							$checkarraycatzoo = strpos($zenfeed_site_jbzoo_catid_alltypes_4,',');
							
							if ($checkarraycatzoo !== false)  {
								$massivcatzoo = explode(',',$zenfeed_site_jbzoo_catid_alltypes_4);
								$countmas = count($massivcatzoo);
			
								$options = array(
									'category_nested' => $zenfeed_site_jbzoo_category_nested_alltypes_4, 
									'limit' => array(0, $zenfeed_site_rss_limit), // offset и limit
									'user' => false, 
									'published' => 1,
									'order' => 'rdate'
								);
				
								
					
							for ($i=0; $i < $countmas; $i++) { 
			
								$yaCategoryModel = $zoo->table->category->get($massivcatzoo[$i]);
								$url = $zoo->route->category($yaCategoryModel);
								$items = JBModelItem::model()->getList($appId, $massivcatzoo[$i], $typeId, $options);
								$all_items[] = $items;
							}
			
				
							function cmp($a, $b){
								$ad = strtotime($a->created);
								$bd = strtotime($b->created);
								return ($bd-$ad);
							}
							
								$arrOut = array();
							
								foreach($all_items as $subArr) {
								$arrOut = array_merge($arrOut, $subArr);
								}
			
						
								usort($arrOut, 'cmp');
								
					
								$items = $arrOut;
			
						
							}
							else {
			
								$options = array(
									'category_nested' => $zenfeed_site_jbzoo_category_nested_alltypes_4, 
									'limit' => array(0, $zenfeed_site_rss_limit), // offset и limit
									'user' => false, 
									'published' => 1,
									'order' => 'rdate'
								);
								
								$yaCategoryModel = $zoo->table->category->get($zenfeed_site_jbzoo_catid_alltypes_4);
								$url = $zoo->route->category($yaCategoryModel);
								$items = JBModelItem::model()->getList($appId, $zenfeed_site_jbzoo_catid_alltypes_4, $typeId, $options);
							}
							
							if (!empty($items)) {
							$BeginrssYaLenta = '<?xml version="1.0" encoding="UTF-8"?>
							<rss version="2.0"
							xmlns:content="http://purl.org/rss/1.0/modules/content/"
							xmlns:dc="http://purl.org/dc/elements/1.1/"
							xmlns:media="http://search.yahoo.com/mrss/"
							xmlns:atom="http://www.w3.org/2005/Atom"
							xmlns:georss="http://www.georss.org/georss"';
							
							if ($turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {	$BeginrssYaLenta .= "\n".
							'				xmlns:yandex="http://news.yandex.ru" 
							xmlns:turbo="http://turbo.yandex.ru"';
							}
			
							$BeginrssYaLenta .= '>';
							$BeginrssYaLenta .= '
								<channel>
									<title>'.$siteName.'</title>
									<link>'.JURI::base().'</link>
									<description>'.$siteDesc.'</description>
									<language>'.$zenfeed_sitelang.'</language>'."";
									if ($zenfeed_site_jbzoo_turbo_li == 1 && $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
										$BeginrssYaLenta .= "\n".'<yandex:analytics type="LiveInternet"></yandex:analytics>';
									}
									if (!empty($zenfeed_site_jbzoo_turbo_yaid) && $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
										$BeginrssYaLenta .= "\n".'<yandex:analytics type="Yandex" id="'.$zenfeed_site_jbzoo_turbo_yaid.'"/>';
									}
									if (!empty($zenfeed_site_jbzoo_turbo_googleid) && $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
										$BeginrssYaLenta .= "\n".'<yandex:analytics id="'.$zenfeed_site_jbzoo_turbo_googleid.'" type="Google"></yandex:analytics>';
									}
									if (!empty($zenfeed_site_jbzoo_turbo_ya_rsya) && $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
										$BeginrssYaLenta .= "\n".'<yandex:adNetwork type="Yandex" id="'.$zenfeed_site_jbzoo_turbo_ya_rsya.'" turbo-ad-id="first_ad_place"></yandex:adNetwork>';
									}
							$items = array_slice($items, 0, (int)$zenfeed_site_rss_limit);		
							
					
							foreach ($items as $item) {
						
						
								$itemID = $item->id;
								$itemName = htmlspecialchars($item->name);
								$itemName = str_replace('«','&quot;',$itemName);
								$itemName = str_replace('»','&quot;',$itemName);
								$itemCreated = $item->created;
								$itemCreated = JHtml::_('date', $itemCreated, 'Y-m-d H:i:s', JFactory::getApplication()->getCfg('offset'), true);
								$itemAuthor = JFactory::getUser($item->created_by)->name;
								if (empty($itemAuthor) && $zenfeed_site_defauthor_set == '1' && $zenfeed_site_defauthor_set_fix == '0') {
									$itemAuthor = $zenfeed_site_defauthor;
								}
								if ($zenfeed_site_defauthor_set_fix == '1') {
									$itemAuthor = $zenfeed_site_defauthor;
								}
								$allCategories = $item->getRelatedCategories();
								$primaryId = $item->getPrimaryCategoryId();
								$resultcat = array();
								foreach($allCategories as $category) {
										$resultcat[] = '<category>'.$category->name.'</category>';
								}
							
								$allcatinitem = implode("\n",$resultcat);
								$itemUrl = $zoo->jbrouter->externalItem($item);
								$category = $item->getPrimaryCategory()->name;

								if (!empty($ElmDescPreview)) {
									$PreviewDesc = $item->getElement($ElmDescPreview)->data();
									$PreviewDescApp = $zoo->data->create($PreviewDesc);
								}
								else {
									$PreviewDesc = $item->getElement($ElmDescFull)->data();
									$PreviewDescApp = $zoo->data->create($FullDesc);
								}

								if ($zenfeed_site_jbzoo_descpreview_alltypes_gen_4 == 1) {
									$PreviewDesc = $item->getElement($ElmDescFull)->data();
									$PreviewDescApp = $zoo->data->create($FullDesc);
								}
								
								$FullDesc = $item->getElement($ElmDescFull)->data();
								$FullDescApp = $zoo->data->create($FullDesc);
								$figure = '';
								$figures = '';
								if ($zenfeed_images_path == 1) {
									$PreviewDesc = str_replace('src="images','src="/images',$PreviewDesc);
									$FullDesc = str_replace('src="images','src="/images',$FullDesc);
									$PreviewDesc = str_replace('//images/','/images/',$PreviewDesc);
									$FullDesc = str_replace('//images/','/images/',$FullDesc);
								}
								$PreviewDesc = htmlspecialchars(trim(strip_tags($PreviewDescApp->find('0.value'))));
								$PreviewDesc = str_replace('«','&quot;',$PreviewDesc);
								$PreviewDesc = str_replace('»','&quot;',$PreviewDesc);
								$PreviewDesc = str_replace('<br>','<br />',$PreviewDesc);
								$PreviewDesc = preg_replace("/\{.*?}/ius", "", $PreviewDesc);
								$FullDesc = trim($FullDescApp->find('0.value'));
								$FullDesc = preg_replace("/\{.*?}/ius", "", $FullDesc);
								
								$FullDesc = str_replace('«','&quot;',$FullDesc);
								$FullDesc = str_replace('»','&quot;',$FullDesc);
								$FullDesc = str_replace('&nbsp;',' ',$FullDesc);
								$FullDesc = str_replace(' style="text-align: justify;"','',$FullDesc);
								$FullDesc = str_replace('alt=""','',$FullDesc);
								$FullDesc = str_replace("title=''","",$FullDesc);
								preg_match_all("/<img.+?src=[\"'](.+?)[\"'].*?>/ius", $FullDesc, $figure);
								// $FullDesc = preg_replace("/<img[^>]+>/ius", "", $FullDesc);
								$FullDesc = str_replace('<p></p>','',$FullDesc);
								$FullDesc = str_replace('<br>','<br />',$FullDesc);
						
								if (($item->getElement($ElmImage)->data())) {
							
								$ElmImageData = $item->getElement($ElmImage)->data();
								$ElmImageApp = $zoo->data->create($ElmImageData);
								$Image = trim($ElmImageApp->find('0.file'));
			
								$pathtoimage = JPATH_ROOT .'/'. $Image;
			
								if (file_exists($pathtoimage)) {
									@$image_mime = image_type_to_mime_type(exif_imagetype($pathtoimage)); 
								}
						
			
								}
			
								if ($zenfeed_img_domain == 1) {
									$patt = '/<\s*img[^>]*src=[\"|\'](.*?)[\"|\'][^>]*\/*>/i';
									$FullMatchImg = preg_match_all($patt, $FullDesc, $matchFull);
									foreach ($matchFull[1] as $matchimage) {
										if (!strstr($matchimage,'http')) {
											$FullDesc = str_replace($matchimage, JURI::base().$matchimage, $FullDesc); // work
										}
									}
									$FullMatchImg = preg_match_all($patt, $PreviewDesc, $matchPreview);
									foreach ($matchPreview[1] as $matchimagesmall) {
										if (!strstr($matchimagesmall,'http')) {
											$PreviewDesc = str_replace($matchimagesmall, JURI::base().$matchimagesmall, $PreviewDesc); // work
										}
									}
								}
			
								if (!empty($FullDesc) || !empty($PreviewDesc)) {
							
									$rssYaLenta .= "\n";
									if ($turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) { $rssYaLenta .= '<item turbo="true">'; }
									else {
										$rssYaLenta .= '<item>';
									}
									$rssYaLenta .= "\n";
								$rssYaLenta .= '<title>'.$itemName.'</title>'."\n";
								$rssYaLenta .= '<link>'.$itemUrl.'</link>'."\n";
								$rssYaLenta .= '<guid>'.md5($itemUrl).'</guid>'."\n";
								$rssYaLenta .= '<pubDate>'.$itemCreated.' '.$zenfeed_site_time.'</pubDate>'."\n";
								$rssYaLenta .= '<media:rating scheme="urn:simple">nonadult</media:rating>'."\n";
								$rssYaLenta .= '<author>'.$itemAuthor.'</author>'."\n";
								
								$ImgesEnclos = $PreviewDesc . $FullDesc;
								preg_match_all('@src="([^"]+)"@', $ImgesEnclos, $matchesenc);
								if ($matchesenc) {
									if ($matchesenc[1] && !empty($matchesenc[1])) {
										foreach (array_unique($matchesenc[1]) as $imgenc) {
											if (strstr($imgenc,'http')) {
											$imgenc = str_replace(JURI::base().JURI::base(),JURI::base(),$imgenc);
											@$image_mimeecn = image_type_to_mime_type(exif_imagetype($imgenc)); 
											$rssYaLenta .= "\n".'<enclosure url="'.$imgenc.'" type="'.$image_mimeecn.'"/>'."\n";
											}
											else {
											
											@$image_mimeecn = image_type_to_mime_type(exif_imagetype(JURI::base().$imgenc)); 
											$rssYaLenta .= "\n".'<enclosure url="'.JURI::base().$imgenc.'" type="'.$image_mimeecn.'"/>'."\n";
											}
										}
									}
								}
			
								if ($zenfeed_cat_replace == '1' && $zenfeed_cat_replace_jbzoo == '0') {
			
								$checkarrayreplacecatname = strpos($zenfeed_cat_replace_catname,',');
									if ($checkarrayreplacecatname !== false) {
									$massivcatreplacename = explode(',',$zenfeed_cat_replace_catname);
									$countmascat = count($massivcatreplacename);
								}
			
								$offyandexcats = array (
									'Авто', 'Война', 'Дизайн', 'Дом', 'Еда', 'Здоровье', 'Знаменитости', 'Игры', 'Кино', 'Культура', 'Литература', 'Мода', 'Музыка', 'Наука', 'Общество', 'Политика', 'Природа', 'Происшествия', 'Психология', 'Путешествия', 'Спорт', 'Технологии', 'Фотографии', 'Хобби', 'Экономика', 'Юмор' 
								);
									foreach ($allCategories as $category) {
										if (!in_array($category->name, $offyandexcats)) {
			
											for ($i=0; $i < $countmascat; $i++) { 
												$rssYaLenta .= "\n".'<category>'.trim($massivcatreplacename[$i]).'</category>';
											}
			
										}
									}
								}
						
								if ($zenfeed_cat_replace == '1' && $zenfeed_cat_replace_jbzoo == '1' && !empty($zenfeed_cat_replace_jbzoo_element_checkbox_alltypes_4)) {
			
								$catforzenjbzoo = $item->getElement($zenfeed_cat_replace_jbzoo_element_checkbox_alltypes_4)->render();
						
								$massivcatreplacenamez = explode(',',$catforzenjbzoo);
								$countmascats = count($massivcatreplacenamez);
								if (!empty($massivcatreplacenamez)) {
								for ($i=0; $i < $countmascats; $i++) { 
										if (strlen($massivcatreplacenamez[$i]) > 3) {
											$rssYaLenta .= "\n".'<category>'.trim($massivcatreplacenamez[$i]).'</category>';
										}
									}
								}
						
								}
			
								if ($zenfeed_cat_replace == '0') {
									$rssYaLenta .= $allcatinitem;
								}
			
							
								if ( !empty($Image) && !empty($image_mime) && $zenfeed_site_jbzoo_turbo == 0 ) {
							
								$rssYaLenta .= "\n".'<enclosure url="'.JURI::base().$Image.'" type="'.$image_mime.'"/>';
							
								}
			
							
								if ($zenfeed_site_jbzoo_descpreview_descmini_4 == 0) {
									if ($zenfeed_site_jbzoo_descpreview_descmini_striptags_4 == 0) {
										$rssYaLenta .= '<description><![CDATA['.$PreviewDesc.']]></description>';
									}
									else {
										$rssYaLenta .= '<description><![CDATA['.strip_tags($PreviewDesc).']]></description>';
									}
									
									$rssYaLenta .= "\n";
								}
				
								if ($zenfeed_site_jbzoo_descpreview_descmini_4 == 1) {
									if ($zenfeed_site_jbzoo_descpreview_descmini_striptags_4 == 0) {
										$rssYaLenta .= '<description><![CDATA['.mb_substr($PreviewDesc, 0, $zenfeed_site_jbzoo_descpreview_descmini_count_4).']]></description>';
									}
									else {
										$rssYaLenta .= '<description><![CDATA['.strip_tags(mb_substr($PreviewDesc, 0, $zenfeed_site_jbzoo_descpreview_descmini_count_4)).']]></description>';
									}
				
									$rssYaLenta .= "\n";  
								}

								
								if ($turbopage != $zenfeed_site_pwdturbo) {
									
									$rssYaLenta .= '<content:encoded><![CDATA['.$FullDesc.'';
							
						
								if (!empty($figure[1])) {
									foreach ($figure[1] as $figureItem) {
								$figureItem = str_replace('"','', $figureItem);
							
										@$sImg = getimagesize($figureItem); //Warning, if img delete
										$figureItem = trim($figureItem);
							
										if (!strpos('http',$figureItem)) {
											$figureItem = JURI::base().$figureItem;
										}
							
										$figures .= '
										<figure>
										<img src="'.$figureItem.'" width="'.$sImg[0].'" height="'.$sImg[1].'">
										<figcaption>'.$itemName.'</figcaption>
										</figure>';
							
									}
								
								$rssYaLenta .= $figures;
							
								}
						
								$pathtoimage = JPATH_ROOT .'/'. $Image;
			
								if (file_exists($pathtoimage)) {
									@$oneImg = getimagesize($pathtoimage); //Warning, if img delete
													
									$rssYaLenta .= '
									<figure>
									<img src="'.JURI::base().$Image.'" width="'.$oneImg[0].'" height="'.$oneImg[1].'">
									<figcaption>'.$itemName.'</figcaption>
									</figure>';
						
									$rssYaLenta .= ']]></content:encoded>
									';
								} 
							}
			
								if ($turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
			
								$rssYaLenta .= '<turbo:content><![CDATA[';
								
							
									if (!empty($figure[1])) {
										foreach ($figure[1] as $figureItem) {
									$figureItem = str_replace('"','', $figureItem);
								
											@$sImg = getimagesize($figureItem); //Warning, if img delete
											$figureItem = trim($figureItem);
								
											if (!strpos('http',$figureItem)) {
												$figureItem = JURI::base().$figureItem;
											}
								
											$figures .= '
											<header>
											<h1>'.$itemName.'</h1>
											<figure>
											<img src="'.$figureItem.'" width="'.$sImg[0].'" height="'.$sImg[1].'">
											<figcaption>'.$itemName.'</figcaption>
											</figure></header>';
								
										}
									
									$rssYaLenta .= $figures;
								
									}
							
									$pathtoimage = JPATH_ROOT .'/'. $Image;
				
									if (file_exists($pathtoimage)) {
										@$oneImg = getimagesize($pathtoimage); //Warning, if img delete
														
										$rssYaLenta .= '
										<header>
										<h1>'.$itemName.'</h1>
										<figure>
										<img src="'.JURI::base().$Image.'" width="'.$oneImg[0].'" height="'.$oneImg[1].'">
										<figcaption>'.$itemName.'</figcaption>
										</figure></header>';
									} 
										$rssYaLenta .= $FullDesc.']]></turbo:content>'."\n";
			
									}
			
			
									if (file_exists($pathtoimage)) {
										@$oneImg = getimagesize($pathtoimage); //Warning, if img delete
										$rssYaLenta .= "\n".'<enclosure url="'.JURI::base().$Image.'" type="'.$image_mime.'"/>';
									} 
			
									
									if ($figure) {
										if (!empty($figure[1]) && $figure[1]) {
			
										foreach ($figure[1] as $imageenc) {
											@$image_mimeecn = image_type_to_mime_type(exif_imagetype(JURI::base().$imageenc)); 
											$rssYaLenta .= "\n".'<enclosure url="'.JURI::base().$imageenc.'" type="'.$image_mimeecn.'"/>';
										}
										
										}
									}
			
			
									
									$rssYaLenta .= "\n".'</item>'."\n";
							
								}
			
					
							}

			
							}
						
						}
							// go five type JBZoo
							
							if ($zenfeed_site_jbzoo_gen_on_5 == 1) {
							
							if ($zenfeed_site_jbzoo_category_nested == 1) {
								$zenfeed_site_jbzoo_category_nested = true;
							}
							else {
								$zenfeed_site_jbzoo_category_nested = false;
							}
							// JBZoo::init();
							$zoo = App::getInstance('zoo');
							$db = JFactory::getDBO();
							$doc = JFactory::getDocument();
							$appId = $zenfeed_site_jbzoo_app_alltypes_5;
							$ElmImage = $zenfeed_site_jbzoo_image_alltypes_5;
							$ElmDescPreview = $zenfeed_site_jbzoo_descpreview_alltypes_5;
							$ElmDescFull = $zenfeed_site_jbzoo_descfull_alltypes_5;
							$siteName = htmlspecialchars($zenfeed_sitename);
							$siteDesc = htmlspecialchars($zenfeed_sitedesc);
							$typeId = $zenfeed_site_jbzoo_type_alltypes_5; 
							$items = '';
							$all_items = array();
			
							$checkarraycatzoo = strpos($zenfeed_site_jbzoo_catid_alltypes_5,',');
							
							if ($checkarraycatzoo !== false)  {
								$massivcatzoo = explode(',',$zenfeed_site_jbzoo_catid_alltypes_5);
								$countmas = count($massivcatzoo);
			
								$options = array(
									'category_nested' => $zenfeed_site_jbzoo_category_nested_alltypes_5, 
									'limit' => array(0, $zenfeed_site_rss_limit), // offset и limit
									'user' => false, 
									'published' => 1,
									'order' => 'rdate'
								);
				
								
					
							for ($i=0; $i < $countmas; $i++) { 
			
								$yaCategoryModel = $zoo->table->category->get($massivcatzoo[$i]);
								$url = $zoo->route->category($yaCategoryModel);
								$items = JBModelItem::model()->getList($appId, $massivcatzoo[$i], $typeId, $options);
								$all_items[] = $items;
							}
			
				
							function cmp($a, $b){
								$ad = strtotime($a->created);
								$bd = strtotime($b->created);
								return ($bd-$ad);
							}
							
								$arrOut = array();
							
								foreach($all_items as $subArr) {
								$arrOut = array_merge($arrOut, $subArr);
								}
			
						
								usort($arrOut, 'cmp');
								
					
								$items = $arrOut;
			
						
							}
							else {
			
								$options = array(
									'category_nested' => $zenfeed_site_jbzoo_category_nested_alltypes_5, 
									'limit' => array(0, $zenfeed_site_rss_limit), // offset и limit
									'user' => false, 
									'published' => 1,
									'order' => 'rdate'
								);
								
								$yaCategoryModel = $zoo->table->category->get($zenfeed_site_jbzoo_catid_alltypes_5);
								$url = $zoo->route->category($yaCategoryModel);
								$items = JBModelItem::model()->getList($appId, $zenfeed_site_jbzoo_catid_alltypes_5, $typeId, $options);
							}
							
							if (!empty($items)) {
							$BeginrssYaLenta = '<?xml version="1.0" encoding="UTF-8"?>
							<rss version="2.0"
							xmlns:content="http://purl.org/rss/1.0/modules/content/"
							xmlns:dc="http://purl.org/dc/elements/1.1/"
							xmlns:media="http://search.yahoo.com/mrss/"
							xmlns:atom="http://www.w3.org/2005/Atom"
							xmlns:georss="http://www.georss.org/georss"';
							
							if ($turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {	$BeginrssYaLenta .= "\n".
							'				xmlns:yandex="http://news.yandex.ru" 
							xmlns:turbo="http://turbo.yandex.ru"';
							}
			
							$BeginrssYaLenta .= '>';
							$BeginrssYaLenta .= '
								<channel>
									<title>'.$siteName.'</title>
									<link>'.JURI::base().'</link>
									<description>'.$siteDesc.'</description>
									<language>'.$zenfeed_sitelang.'</language>'."";
									if ($zenfeed_site_jbzoo_turbo_li == 1 && $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
										$BeginrssYaLenta .= "\n".'<yandex:analytics type="LiveInternet"></yandex:analytics>';
									}
									if (!empty($zenfeed_site_jbzoo_turbo_yaid) && $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
										$BeginrssYaLenta .= "\n".'<yandex:analytics type="Yandex" id="'.$zenfeed_site_jbzoo_turbo_yaid.'"/>';
									}
									if (!empty($zenfeed_site_jbzoo_turbo_googleid) && $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
										$BeginrssYaLenta .= "\n".'<yandex:analytics id="'.$zenfeed_site_jbzoo_turbo_googleid.'" type="Google"></yandex:analytics>';
									}
									if (!empty($zenfeed_site_jbzoo_turbo_ya_rsya) && $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
										$BeginrssYaLenta .= "\n".'<yandex:adNetwork type="Yandex" id="'.$zenfeed_site_jbzoo_turbo_ya_rsya.'" turbo-ad-id="first_ad_place"></yandex:adNetwork>';
									}
							$items = array_slice($items, 0, (int)$zenfeed_site_rss_limit);		
							
					
							foreach ($items as $item) {
						
						
								$itemID = $item->id;
								$itemName = htmlspecialchars($item->name);
								$itemName = str_replace('«','&quot;',$itemName);
								$itemName = str_replace('»','&quot;',$itemName);
								$itemCreated = $item->created;
								$itemCreated = JHtml::_('date', $itemCreated, 'Y-m-d H:i:s', JFactory::getApplication()->getCfg('offset'), true);
								$itemAuthor = JFactory::getUser($item->created_by)->name;
								if (empty($itemAuthor) && $zenfeed_site_defauthor_set == '1' && $zenfeed_site_defauthor_set_fix == '0') {
									$itemAuthor = $zenfeed_site_defauthor;
								}
								if ($zenfeed_site_defauthor_set_fix == '1') {
									$itemAuthor = $zenfeed_site_defauthor;
								}
								$allCategories = $item->getRelatedCategories();
								$primaryId = $item->getPrimaryCategoryId();
								$resultcat = array();
								foreach($allCategories as $category) {
										$resultcat[] = '<category>'.$category->name.'</category>';
								}
							
								$allcatinitem = implode("\n",$resultcat);
								$itemUrl = $zoo->jbrouter->externalItem($item);
								$category = $item->getPrimaryCategory()->name;

								if (!empty($ElmDescPreview)) {
									$PreviewDesc = $item->getElement($ElmDescPreview)->data();
									$PreviewDescApp = $zoo->data->create($PreviewDesc);
								}
								else {
									$PreviewDesc = $item->getElement($ElmDescFull)->data();
									$PreviewDescApp = $zoo->data->create($FullDesc);
								}

								if ($zenfeed_site_jbzoo_descpreview_alltypes_gen_5 == 1) {
									$PreviewDesc = $item->getElement($ElmDescFull)->data();
									$PreviewDescApp = $zoo->data->create($FullDesc);
								}
								
								$FullDesc = $item->getElement($ElmDescFull)->data();
								$FullDescApp = $zoo->data->create($FullDesc);
								$figure = '';
								$figures = '';
								if ($zenfeed_images_path == 1) {
									$PreviewDesc = str_replace('src="images','src="/images',$PreviewDesc);
									$FullDesc = str_replace('src="images','src="/images',$FullDesc);
									$PreviewDesc = str_replace('//images/','/images/',$PreviewDesc);
									$FullDesc = str_replace('//images/','/images/',$FullDesc);
								}
								$PreviewDesc = htmlspecialchars(trim(strip_tags($PreviewDescApp->find('0.value'))));
								$PreviewDesc = str_replace('«','&quot;',$PreviewDesc);
								$PreviewDesc = str_replace('»','&quot;',$PreviewDesc);
								$PreviewDesc = str_replace('<br>','<br />',$PreviewDesc);
								$PreviewDesc = preg_replace("/\{.*?}/ius", "", $PreviewDesc);
								$FullDesc = trim($FullDescApp->find('0.value'));
								$FullDesc = preg_replace("/\{.*?}/ius", "", $FullDesc);
								
								$FullDesc = str_replace('«','&quot;',$FullDesc);
								$FullDesc = str_replace('»','&quot;',$FullDesc);
								$FullDesc = str_replace('&nbsp;',' ',$FullDesc);
								$FullDesc = str_replace(' style="text-align: justify;"','',$FullDesc);
								$FullDesc = str_replace('alt=""','',$FullDesc);
								$FullDesc = str_replace("title=''","",$FullDesc);
								preg_match_all("/<img.+?src=[\"'](.+?)[\"'].*?>/ius", $FullDesc, $figure);
								// $FullDesc = preg_replace("/<img[^>]+>/ius", "", $FullDesc);
								$FullDesc = str_replace('<p></p>','',$FullDesc);
								$FullDesc = str_replace('<br>','<br />',$FullDesc);
						
								if (($item->getElement($ElmImage)->data())) {
							
								$ElmImageData = $item->getElement($ElmImage)->data();
								$ElmImageApp = $zoo->data->create($ElmImageData);
								$Image = trim($ElmImageApp->find('0.file'));
			
								$pathtoimage = JPATH_ROOT .'/'. $Image;
			
								if (file_exists($pathtoimage)) {
									@$image_mime = image_type_to_mime_type(exif_imagetype($pathtoimage)); 
								}
						
			
								}
			
								if ($zenfeed_img_domain == 1) {
									$patt = '/<\s*img[^>]*src=[\"|\'](.*?)[\"|\'][^>]*\/*>/i';
									$FullMatchImg = preg_match_all($patt, $FullDesc, $matchFull);
									foreach ($matchFull[1] as $matchimage) {
										if (!strstr($matchimage,'http')) {
											$FullDesc = str_replace($matchimage, JURI::base().$matchimage, $FullDesc); // work
										}
									}
									$FullMatchImg = preg_match_all($patt, $PreviewDesc, $matchPreview);
									foreach ($matchPreview[1] as $matchimagesmall) {
										if (!strstr($matchimagesmall,'http')) {
											$PreviewDesc = str_replace($matchimagesmall, JURI::base().$matchimagesmall, $PreviewDesc); // work
										}
									}
								}
			
								if (!empty($FullDesc) || !empty($PreviewDesc)) {
							
									$rssYaLenta .= "\n";
									if ($turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) { $rssYaLenta .= '<item turbo="true">'; }
									else {
										$rssYaLenta .= '<item>';
									}
									$rssYaLenta .= "\n";
								$rssYaLenta .= '<title>'.$itemName.'</title>'."\n";
								$rssYaLenta .= '<link>'.$itemUrl.'</link>'."\n";
								$rssYaLenta .= '<guid>'.md5($itemUrl).'</guid>'."\n";
								$rssYaLenta .= '<pubDate>'.$itemCreated.' '.$zenfeed_site_time.'</pubDate>'."\n";
								$rssYaLenta .= '<media:rating scheme="urn:simple">nonadult</media:rating>'."\n";
								$rssYaLenta .= '<author>'.$itemAuthor.'</author>'."\n";
								
								$ImgesEnclos = $PreviewDesc . $FullDesc;
								preg_match_all('@src="([^"]+)"@', $ImgesEnclos, $matchesenc);
								if ($matchesenc) {
									if ($matchesenc[1] && !empty($matchesenc[1])) {
										foreach (array_unique($matchesenc[1]) as $imgenc) {
											if (strstr($imgenc,'http')) {
											$imgenc = str_replace(JURI::base().JURI::base(),JURI::base(),$imgenc);
											@$image_mimeecn = image_type_to_mime_type(exif_imagetype($imgenc)); 
											$rssYaLenta .= "\n".'<enclosure url="'.$imgenc.'" type="'.$image_mimeecn.'"/>'."\n";
											}
											else {
											
											@$image_mimeecn = image_type_to_mime_type(exif_imagetype(JURI::base().$imgenc)); 
											$rssYaLenta .= "\n".'<enclosure url="'.JURI::base().$imgenc.'" type="'.$image_mimeecn.'"/>'."\n";
											}
										}
									}
								}
			
								if ($zenfeed_cat_replace == '1' && $zenfeed_cat_replace_jbzoo == '0') {
			
								$checkarrayreplacecatname = strpos($zenfeed_cat_replace_catname,',');
									if ($checkarrayreplacecatname !== false) {
									$massivcatreplacename = explode(',',$zenfeed_cat_replace_catname);
									$countmascat = count($massivcatreplacename);
								}
			
								$offyandexcats = array (
									'Авто', 'Война', 'Дизайн', 'Дом', 'Еда', 'Здоровье', 'Знаменитости', 'Игры', 'Кино', 'Культура', 'Литература', 'Мода', 'Музыка', 'Наука', 'Общество', 'Политика', 'Природа', 'Происшествия', 'Психология', 'Путешествия', 'Спорт', 'Технологии', 'Фотографии', 'Хобби', 'Экономика', 'Юмор' 
								);
									foreach ($allCategories as $category) {
										if (!in_array($category->name, $offyandexcats)) {
			
											for ($i=0; $i < $countmascat; $i++) { 
												$rssYaLenta .= "\n".'<category>'.trim($massivcatreplacename[$i]).'</category>';
											}
			
										}
									}
								}
						
								if ($zenfeed_cat_replace == '1' && $zenfeed_cat_replace_jbzoo == '1' && !empty($zenfeed_cat_replace_jbzoo_element_checkbox_alltypes_5)) {
			
								$catforzenjbzoo = $item->getElement($zenfeed_cat_replace_jbzoo_element_checkbox_alltypes_5)->render();
						
								$massivcatreplacenamez = explode(',',$catforzenjbzoo);
								$countmascats = count($massivcatreplacenamez);
								if (!empty($massivcatreplacenamez)) {
								for ($i=0; $i < $countmascats; $i++) { 
										if (strlen($massivcatreplacenamez[$i]) > 3) {
											$rssYaLenta .= "\n".'<category>'.trim($massivcatreplacenamez[$i]).'</category>';
										}
									}
								}
						
								}
			
								if ($zenfeed_cat_replace == '0') {
									$rssYaLenta .= $allcatinitem;
								}
			
							
								if ( !empty($Image) && !empty($image_mime) && $zenfeed_site_jbzoo_turbo == 0 ) {
							
								$rssYaLenta .= "\n".'<enclosure url="'.JURI::base().$Image.'" type="'.$image_mime.'"/>';
							
								}
			
							
								if ($zenfeed_site_jbzoo_descpreview_descmini_5 == 0) {
									if ($zenfeed_site_jbzoo_descpreview_descmini_striptags_5 == 0) {
										$rssYaLenta .= '<description><![CDATA['.$PreviewDesc.']]></description>';
									}
									else {
										$rssYaLenta .= '<description><![CDATA['.strip_tags($PreviewDesc).']]></description>';
									}
									
									$rssYaLenta .= "\n";
								}
				
								if ($zenfeed_site_jbzoo_descpreview_descmini_5 == 1) {
									if ($zenfeed_site_jbzoo_descpreview_descmini_striptags_5 == 0) {
										$rssYaLenta .= '<description><![CDATA['.mb_substr($PreviewDesc, 0, $zenfeed_site_jbzoo_descpreview_descmini_count_5).']]></description>';
									}
									else {
										$rssYaLenta .= '<description><![CDATA['.strip_tags(mb_substr($PreviewDesc, 0, $zenfeed_site_jbzoo_descpreview_descmini_count_5)).']]></description>';
									}
				
									$rssYaLenta .= "\n";  
								}

								
								if ($turbopage != $zenfeed_site_pwdturbo) {
									
									$rssYaLenta .= '<content:encoded><![CDATA['.$FullDesc.'';
							
						
								if (!empty($figure[1])) {
									foreach ($figure[1] as $figureItem) {
								$figureItem = str_replace('"','', $figureItem);
							
										@$sImg = getimagesize($figureItem); //Warning, if img delete
										$figureItem = trim($figureItem);
							
										if (!strpos('http',$figureItem)) {
											$figureItem = JURI::base().$figureItem;
										}
							
										$figures .= '
										<figure>
										<img src="'.$figureItem.'" width="'.$sImg[0].'" height="'.$sImg[1].'">
										<figcaption>'.$itemName.'</figcaption>
										</figure>';
							
									}
								
								$rssYaLenta .= $figures;
							
								}
						
								$pathtoimage = JPATH_ROOT .'/'. $Image;
			
								if (file_exists($pathtoimage)) {
									@$oneImg = getimagesize($pathtoimage); //Warning, if img delete
													
									$rssYaLenta .= '
									<figure>
									<img src="'.JURI::base().$Image.'" width="'.$oneImg[0].'" height="'.$oneImg[1].'">
									<figcaption>'.$itemName.'</figcaption>
									</figure>';
						
									$rssYaLenta .= ']]></content:encoded>
									';
								} 
							}
			
								if ($turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
			
								$rssYaLenta .= '<turbo:content><![CDATA[';
								
							
									if (!empty($figure[1])) {
										foreach ($figure[1] as $figureItem) {
									$figureItem = str_replace('"','', $figureItem);
								
											@$sImg = getimagesize($figureItem); //Warning, if img delete
											$figureItem = trim($figureItem);
								
											if (!strpos('http',$figureItem)) {
												$figureItem = JURI::base().$figureItem;
											}
								
											$figures .= '
											<header>
											<h1>'.$itemName.'</h1>
											<figure>
											<img src="'.$figureItem.'" width="'.$sImg[0].'" height="'.$sImg[1].'">
											<figcaption>'.$itemName.'</figcaption>
											</figure></header>';
								
										}
									
									$rssYaLenta .= $figures;
								
									}
							
									$pathtoimage = JPATH_ROOT .'/'. $Image;
				
									if (file_exists($pathtoimage)) {
										@$oneImg = getimagesize($pathtoimage); //Warning, if img delete
														
										$rssYaLenta .= '
										<header>
										<h1>'.$itemName.'</h1>
										<figure>
										<img src="'.JURI::base().$Image.'" width="'.$oneImg[0].'" height="'.$oneImg[1].'">
										<figcaption>'.$itemName.'</figcaption>
										</figure></header>';
									} 
										$rssYaLenta .= $FullDesc.']]></turbo:content>'."\n";
			
									}
			
			
									if (file_exists($pathtoimage)) {
										@$oneImg = getimagesize($pathtoimage); //Warning, if img delete
										$rssYaLenta .= "\n".'<enclosure url="'.JURI::base().$Image.'" type="'.$image_mime.'"/>';
									} 
			
									
									if ($figure) {
										if (!empty($figure[1]) && $figure[1]) {
			
										foreach ($figure[1] as $imageenc) {
											@$image_mimeecn = image_type_to_mime_type(exif_imagetype(JURI::base().$imageenc)); 
											$rssYaLenta .= "\n".'<enclosure url="'.JURI::base().$imageenc.'" type="'.$image_mimeecn.'"/>';
										}
										
										}
									}
			
			
									
									$rssYaLenta .= "\n".'</item>'."\n";
							
								}
			
					
							}

			
							}
						
						}
							// go six type JBZoo
							
							if ($zenfeed_site_jbzoo_gen_on_6 == 1) {
							
							if ($zenfeed_site_jbzoo_category_nested == 1) {
								$zenfeed_site_jbzoo_category_nested = true;
							}
							else {
								$zenfeed_site_jbzoo_category_nested = false;
							}
							// JBZoo::init();
							$zoo = App::getInstance('zoo');
							$db = JFactory::getDBO();
							$doc = JFactory::getDocument();
							$appId = $zenfeed_site_jbzoo_app_alltypes_6;
							$ElmImage = $zenfeed_site_jbzoo_image_alltypes_6;
							$ElmDescPreview = $zenfeed_site_jbzoo_descpreview_alltypes_6;
							$ElmDescFull = $zenfeed_site_jbzoo_descfull_alltypes_6;
							$siteName = htmlspecialchars($zenfeed_sitename);
							$siteDesc = htmlspecialchars($zenfeed_sitedesc);
							$typeId = $zenfeed_site_jbzoo_type_alltypes_6; 
							$items = '';
							$all_items = array();
			
							$checkarraycatzoo = strpos($zenfeed_site_jbzoo_catid_alltypes_6,',');
							
							if ($checkarraycatzoo !== false)  {
								$massivcatzoo = explode(',',$zenfeed_site_jbzoo_catid_alltypes_6);
								$countmas = count($massivcatzoo);
			
								$options = array(
									'category_nested' => $zenfeed_site_jbzoo_category_nested_alltypes_6, 
									'limit' => array(0, $zenfeed_site_rss_limit), // offset и limit
									'user' => false, 
									'published' => 1,
									'order' => 'rdate'
								);
				
								
					
							for ($i=0; $i < $countmas; $i++) { 
			
								$yaCategoryModel = $zoo->table->category->get($massivcatzoo[$i]);
								$url = $zoo->route->category($yaCategoryModel);
								$items = JBModelItem::model()->getList($appId, $massivcatzoo[$i], $typeId, $options);
								$all_items[] = $items;
							}
			
				
							function cmp($a, $b){
								$ad = strtotime($a->created);
								$bd = strtotime($b->created);
								return ($bd-$ad);
							}
							
								$arrOut = array();
							
								foreach($all_items as $subArr) {
								$arrOut = array_merge($arrOut, $subArr);
								}
			
						
								usort($arrOut, 'cmp');
								
					
								$items = $arrOut;
			
						
							}
							else {
			
								$options = array(
									'category_nested' => $zenfeed_site_jbzoo_category_nested_alltypes_6, 
									'limit' => array(0, $zenfeed_site_rss_limit), // offset и limit
									'user' => false, 
									'published' => 1,
									'order' => 'rdate'
								);
								
								$yaCategoryModel = $zoo->table->category->get($zenfeed_site_jbzoo_catid_alltypes_6);
								$url = $zoo->route->category($yaCategoryModel);
								$items = JBModelItem::model()->getList($appId, $zenfeed_site_jbzoo_catid_alltypes_6, $typeId, $options);
							}
							
							if (!empty($items)) {
							$BeginrssYaLenta = '<?xml version="1.0" encoding="UTF-8"?>
							<rss version="2.0"
							xmlns:content="http://purl.org/rss/1.0/modules/content/"
							xmlns:dc="http://purl.org/dc/elements/1.1/"
							xmlns:media="http://search.yahoo.com/mrss/"
							xmlns:atom="http://www.w3.org/2005/Atom"
							xmlns:georss="http://www.georss.org/georss"';
							
							if ($turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {	$BeginrssYaLenta .= "\n".
							'				xmlns:yandex="http://news.yandex.ru" 
							xmlns:turbo="http://turbo.yandex.ru"';
							}
			
							$BeginrssYaLenta .= '>';
							$BeginrssYaLenta .= '
								<channel>
									<title>'.$siteName.'</title>
									<link>'.JURI::base().'</link>
									<description>'.$siteDesc.'</description>
									<language>'.$zenfeed_sitelang.'</language>'."";
									if ($zenfeed_site_jbzoo_turbo_li == 1 && $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
										$BeginrssYaLenta .= "\n".'<yandex:analytics type="LiveInternet"></yandex:analytics>';
									}
									if (!empty($zenfeed_site_jbzoo_turbo_yaid) && $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
										$BeginrssYaLenta .= "\n".'<yandex:analytics type="Yandex" id="'.$zenfeed_site_jbzoo_turbo_yaid.'"/>';
									}
									if (!empty($zenfeed_site_jbzoo_turbo_googleid) && $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
										$BeginrssYaLenta .= "\n".'<yandex:analytics id="'.$zenfeed_site_jbzoo_turbo_googleid.'" type="Google"></yandex:analytics>';
									}
									if (!empty($zenfeed_site_jbzoo_turbo_ya_rsya) && $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
										$BeginrssYaLenta .= "\n".'<yandex:adNetwork type="Yandex" id="'.$zenfeed_site_jbzoo_turbo_ya_rsya.'" turbo-ad-id="first_ad_place"></yandex:adNetwork>';
									}
							$items = array_slice($items, 0, (int)$zenfeed_site_rss_limit);		
							
					
							foreach ($items as $item) {
						
						
								$itemID = $item->id;
								$itemName = htmlspecialchars($item->name);
								$itemName = str_replace('«','&quot;',$itemName);
								$itemName = str_replace('»','&quot;',$itemName);
								$itemCreated = $item->created;
								$itemCreated = JHtml::_('date', $itemCreated, 'Y-m-d H:i:s', JFactory::getApplication()->getCfg('offset'), true);
								$itemAuthor = JFactory::getUser($item->created_by)->name;
								if (empty($itemAuthor) && $zenfeed_site_defauthor_set == '1' && $zenfeed_site_defauthor_set_fix == '0') {
									$itemAuthor = $zenfeed_site_defauthor;
								}
								if ($zenfeed_site_defauthor_set_fix == '1') {
									$itemAuthor = $zenfeed_site_defauthor;
								}
								$allCategories = $item->getRelatedCategories();
								$primaryId = $item->getPrimaryCategoryId();
								$resultcat = array();
								foreach($allCategories as $category) {
										$resultcat[] = '<category>'.$category->name.'</category>';
								}
							
								$allcatinitem = implode("\n",$resultcat);
								$itemUrl = $zoo->jbrouter->externalItem($item);
								$category = $item->getPrimaryCategory()->name;

								if (!empty($ElmDescPreview)) {
									$PreviewDesc = $item->getElement($ElmDescPreview)->data();
									$PreviewDescApp = $zoo->data->create($PreviewDesc);
								}
								else {
									$PreviewDesc = $item->getElement($ElmDescFull)->data();
									$PreviewDescApp = $zoo->data->create($FullDesc);
								}

								if ($zenfeed_site_jbzoo_descpreview_alltypes_gen_6 == 1) {
									$PreviewDesc = $item->getElement($ElmDescFull)->data();
									$PreviewDescApp = $zoo->data->create($FullDesc);
								}
								
								$FullDesc = $item->getElement($ElmDescFull)->data();
								$FullDescApp = $zoo->data->create($FullDesc);
								$figure = '';
								$figures = '';
								if ($zenfeed_images_path == 1) {
									$PreviewDesc = str_replace('src="images','src="/images',$PreviewDesc);
									$FullDesc = str_replace('src="images','src="/images',$FullDesc);
									$PreviewDesc = str_replace('//images/','/images/',$PreviewDesc);
									$FullDesc = str_replace('//images/','/images/',$FullDesc);
								}
								$PreviewDesc = htmlspecialchars(trim(strip_tags($PreviewDescApp->find('0.value'))));
								$PreviewDesc = str_replace('«','&quot;',$PreviewDesc);
								$PreviewDesc = str_replace('»','&quot;',$PreviewDesc);
								$PreviewDesc = str_replace('<br>','<br />',$PreviewDesc);
								$PreviewDesc = preg_replace("/\{.*?}/ius", "", $PreviewDesc);
								$FullDesc = trim($FullDescApp->find('0.value'));
								$FullDesc = preg_replace("/\{.*?}/ius", "", $FullDesc);
								
								$FullDesc = str_replace('«','&quot;',$FullDesc);
								$FullDesc = str_replace('»','&quot;',$FullDesc);
								$FullDesc = str_replace('&nbsp;',' ',$FullDesc);
								$FullDesc = str_replace(' style="text-align: justify;"','',$FullDesc);
								$FullDesc = str_replace('alt=""','',$FullDesc);
								$FullDesc = str_replace("title=''","",$FullDesc);
								preg_match_all("/<img.+?src=[\"'](.+?)[\"'].*?>/ius", $FullDesc, $figure);
								// $FullDesc = preg_replace("/<img[^>]+>/ius", "", $FullDesc);
								$FullDesc = str_replace('<p></p>','',$FullDesc);
								$FullDesc = str_replace('<br>','<br />',$FullDesc);
						
								if (($item->getElement($ElmImage)->data())) {
							
								$ElmImageData = $item->getElement($ElmImage)->data();
								$ElmImageApp = $zoo->data->create($ElmImageData);
								$Image = trim($ElmImageApp->find('0.file'));
			
								$pathtoimage = JPATH_ROOT .'/'. $Image;
			
								if (file_exists($pathtoimage)) {
									@$image_mime = image_type_to_mime_type(exif_imagetype($pathtoimage)); 
								}
						
			
								}
			
								if ($zenfeed_img_domain == 1) {
									$patt = '/<\s*img[^>]*src=[\"|\'](.*?)[\"|\'][^>]*\/*>/i';
									$FullMatchImg = preg_match_all($patt, $FullDesc, $matchFull);
									foreach ($matchFull[1] as $matchimage) {
										if (!strstr($matchimage,'http')) {
											$FullDesc = str_replace($matchimage, JURI::base().$matchimage, $FullDesc); // work
										}
									}
									$FullMatchImg = preg_match_all($patt, $PreviewDesc, $matchPreview);
									foreach ($matchPreview[1] as $matchimagesmall) {
										if (!strstr($matchimagesmall,'http')) {
											$PreviewDesc = str_replace($matchimagesmall, JURI::base().$matchimagesmall, $PreviewDesc); // work
										}
									}
								}
			
								if (!empty($FullDesc) || !empty($PreviewDesc)) {
							
									$rssYaLenta .= "\n";
									if ($turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) { $rssYaLenta .= '<item turbo="true">'; }
									else {
										$rssYaLenta .= '<item>';
									}
									$rssYaLenta .= "\n";
								$rssYaLenta .= '<title>'.$itemName.'</title>'."\n";
								$rssYaLenta .= '<link>'.$itemUrl.'</link>'."\n";
								$rssYaLenta .= '<guid>'.md5($itemUrl).'</guid>'."\n";
								$rssYaLenta .= '<pubDate>'.$itemCreated.' '.$zenfeed_site_time.'</pubDate>'."\n";
								$rssYaLenta .= '<media:rating scheme="urn:simple">nonadult</media:rating>'."\n";
								$rssYaLenta .= '<author>'.$itemAuthor.'</author>'."\n";
								
								$ImgesEnclos = $PreviewDesc . $FullDesc;
								preg_match_all('@src="([^"]+)"@', $ImgesEnclos, $matchesenc);
								if ($matchesenc) {
									if ($matchesenc[1] && !empty($matchesenc[1])) {
										foreach (array_unique($matchesenc[1]) as $imgenc) {
											if (strstr($imgenc,'http')) {
											$imgenc = str_replace(JURI::base().JURI::base(),JURI::base(),$imgenc);
											@$image_mimeecn = image_type_to_mime_type(exif_imagetype($imgenc)); 
											$rssYaLenta .= "\n".'<enclosure url="'.$imgenc.'" type="'.$image_mimeecn.'"/>'."\n";
											}
											else {
											
											@$image_mimeecn = image_type_to_mime_type(exif_imagetype(JURI::base().$imgenc)); 
											$rssYaLenta .= "\n".'<enclosure url="'.JURI::base().$imgenc.'" type="'.$image_mimeecn.'"/>'."\n";
											}
										}
									}
								}
			
								if ($zenfeed_cat_replace == '1' && $zenfeed_cat_replace_jbzoo == '0') {
			
								$checkarrayreplacecatname = strpos($zenfeed_cat_replace_catname,',');
									if ($checkarrayreplacecatname !== false) {
									$massivcatreplacename = explode(',',$zenfeed_cat_replace_catname);
									$countmascat = count($massivcatreplacename);
								}
			
								$offyandexcats = array (
									'Авто', 'Война', 'Дизайн', 'Дом', 'Еда', 'Здоровье', 'Знаменитости', 'Игры', 'Кино', 'Культура', 'Литература', 'Мода', 'Музыка', 'Наука', 'Общество', 'Политика', 'Природа', 'Происшествия', 'Психология', 'Путешествия', 'Спорт', 'Технологии', 'Фотографии', 'Хобби', 'Экономика', 'Юмор' 
								);
									foreach ($allCategories as $category) {
										if (!in_array($category->name, $offyandexcats)) {
			
											for ($i=0; $i < $countmascat; $i++) { 
												$rssYaLenta .= "\n".'<category>'.trim($massivcatreplacename[$i]).'</category>';
											}
			
										}
									}
								}
						
								if ($zenfeed_cat_replace == '1' && $zenfeed_cat_replace_jbzoo == '1' && !empty($zenfeed_cat_replace_jbzoo_element_checkbox_alltypes_6)) {
			
								$catforzenjbzoo = $item->getElement($zenfeed_cat_replace_jbzoo_element_checkbox_alltypes_6)->render();
						
								$massivcatreplacenamez = explode(',',$catforzenjbzoo);
								$countmascats = count($massivcatreplacenamez);
								if (!empty($massivcatreplacenamez)) {
								for ($i=0; $i < $countmascats; $i++) { 
										if (strlen($massivcatreplacenamez[$i]) > 3) {
											$rssYaLenta .= "\n".'<category>'.trim($massivcatreplacenamez[$i]).'</category>';
										}
									}
								}
						
								}
			
								if ($zenfeed_cat_replace == '0') {
									$rssYaLenta .= $allcatinitem;
								}
			
							
								if ( !empty($Image) && !empty($image_mime) && $zenfeed_site_jbzoo_turbo == 0 ) {
							
								$rssYaLenta .= "\n".'<enclosure url="'.JURI::base().$Image.'" type="'.$image_mime.'"/>';
							
								}
			
							
								if ($zenfeed_site_jbzoo_descpreview_descmini_6 == 0) {
									if ($zenfeed_site_jbzoo_descpreview_descmini_striptags_6 == 0) {
										$rssYaLenta .= '<description><![CDATA['.$PreviewDesc.']]></description>';
									}
									else {
										$rssYaLenta .= '<description><![CDATA['.strip_tags($PreviewDesc).']]></description>';
									}
									
									$rssYaLenta .= "\n";
								}
				
								if ($zenfeed_site_jbzoo_descpreview_descmini_6 == 1) {
									if ($zenfeed_site_jbzoo_descpreview_descmini_striptags_6 == 0) {
										$rssYaLenta .= '<description><![CDATA['.mb_substr($PreviewDesc, 0, $zenfeed_site_jbzoo_descpreview_descmini_count_6).']]></description>';
									}
									else {
										$rssYaLenta .= '<description><![CDATA['.strip_tags(mb_substr($PreviewDesc, 0, $zenfeed_site_jbzoo_descpreview_descmini_count_6)).']]></description>';
									}
				
									$rssYaLenta .= "\n";  
								}

								
								if ($turbopage != $zenfeed_site_pwdturbo) {
									
									$rssYaLenta .= '<content:encoded><![CDATA['.$FullDesc.'';
							
						
								if (!empty($figure[1])) {
									foreach ($figure[1] as $figureItem) {
								$figureItem = str_replace('"','', $figureItem);
							
										@$sImg = getimagesize($figureItem); //Warning, if img delete
										$figureItem = trim($figureItem);
							
										if (!strpos('http',$figureItem)) {
											$figureItem = JURI::base().$figureItem;
										}
							
										$figures .= '
										<figure>
										<img src="'.$figureItem.'" width="'.$sImg[0].'" height="'.$sImg[1].'">
										<figcaption>'.$itemName.'</figcaption>
										</figure>';
							
									}
								
								$rssYaLenta .= $figures;
							
								}
						
								$pathtoimage = JPATH_ROOT .'/'. $Image;
			
								if (file_exists($pathtoimage)) {
									@$oneImg = getimagesize($pathtoimage); //Warning, if img delete
													
									$rssYaLenta .= '
									<figure>
									<img src="'.JURI::base().$Image.'" width="'.$oneImg[0].'" height="'.$oneImg[1].'">
									<figcaption>'.$itemName.'</figcaption>
									</figure>';
						
									$rssYaLenta .= ']]></content:encoded>
									';
								} 
							}
			
								if ($turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
			
								$rssYaLenta .= '<turbo:content><![CDATA[';
								
							
									if (!empty($figure[1])) {
										foreach ($figure[1] as $figureItem) {
									$figureItem = str_replace('"','', $figureItem);
								
											@$sImg = getimagesize($figureItem); //Warning, if img delete
											$figureItem = trim($figureItem);
								
											if (!strpos('http',$figureItem)) {
												$figureItem = JURI::base().$figureItem;
											}
								
											$figures .= '
											<header>
											<h1>'.$itemName.'</h1>
											<figure>
											<img src="'.$figureItem.'" width="'.$sImg[0].'" height="'.$sImg[1].'">
											<figcaption>'.$itemName.'</figcaption>
											</figure></header>';
								
										}
									
									$rssYaLenta .= $figures;
								
									}
							
									$pathtoimage = JPATH_ROOT .'/'. $Image;
				
									if (file_exists($pathtoimage)) {
										@$oneImg = getimagesize($pathtoimage); //Warning, if img delete
														
										$rssYaLenta .= '
										<header>
										<h1>'.$itemName.'</h1>
										<figure>
										<img src="'.JURI::base().$Image.'" width="'.$oneImg[0].'" height="'.$oneImg[1].'">
										<figcaption>'.$itemName.'</figcaption>
										</figure></header>';
									} 
										$rssYaLenta .= $FullDesc.']]></turbo:content>'."\n";
			
									}
			
			
									if (file_exists($pathtoimage)) {
										@$oneImg = getimagesize($pathtoimage); //Warning, if img delete
										$rssYaLenta .= "\n".'<enclosure url="'.JURI::base().$Image.'" type="'.$image_mime.'"/>';
									} 
			
									
									if ($figure) {
										if (!empty($figure[1]) && $figure[1]) {
			
										foreach ($figure[1] as $imageenc) {
											@$image_mimeecn = image_type_to_mime_type(exif_imagetype(JURI::base().$imageenc)); 
											$rssYaLenta .= "\n".'<enclosure url="'.JURI::base().$imageenc.'" type="'.$image_mimeecn.'"/>';
										}
										
										}
									}
			
			
									
									$rssYaLenta .= "\n".'</item>'."\n";
							
								}
			
					
							}

			
							}
						
						}
							// go seven type JBZoo
							
							if ($zenfeed_site_jbzoo_gen_on_7 == 1) {
							
							if ($zenfeed_site_jbzoo_category_nested == 1) {
								$zenfeed_site_jbzoo_category_nested = true;
							}
							else {
								$zenfeed_site_jbzoo_category_nested = false;
							}
							// JBZoo::init();
							$zoo = App::getInstance('zoo');
							$db = JFactory::getDBO();
							$doc = JFactory::getDocument();
							$appId = $zenfeed_site_jbzoo_app_alltypes_7;
							$ElmImage = $zenfeed_site_jbzoo_image_alltypes_7;
							$ElmDescPreview = $zenfeed_site_jbzoo_descpreview_alltypes_7;
							$ElmDescFull = $zenfeed_site_jbzoo_descfull_alltypes_7;
							$siteName = htmlspecialchars($zenfeed_sitename);
							$siteDesc = htmlspecialchars($zenfeed_sitedesc);
							$typeId = $zenfeed_site_jbzoo_type_alltypes_7; 
							$items = '';
							$all_items = array();
			
							$checkarraycatzoo = strpos($zenfeed_site_jbzoo_catid_alltypes_7,',');
							
							if ($checkarraycatzoo !== false)  {
								$massivcatzoo = explode(',',$zenfeed_site_jbzoo_catid_alltypes_7);
								$countmas = count($massivcatzoo);
			
								$options = array(
									'category_nested' => $zenfeed_site_jbzoo_category_nested_alltypes_7, 
									'limit' => array(0, $zenfeed_site_rss_limit), // offset и limit
									'user' => false, 
									'published' => 1,
									'order' => 'rdate'
								);
				
								
					
							for ($i=0; $i < $countmas; $i++) { 
			
								$yaCategoryModel = $zoo->table->category->get($massivcatzoo[$i]);
								$url = $zoo->route->category($yaCategoryModel);
								$items = JBModelItem::model()->getList($appId, $massivcatzoo[$i], $typeId, $options);
								$all_items[] = $items;
							}
			
				
							function cmp($a, $b){
								$ad = strtotime($a->created);
								$bd = strtotime($b->created);
								return ($bd-$ad);
							}
							
								$arrOut = array();
							
								foreach($all_items as $subArr) {
								$arrOut = array_merge($arrOut, $subArr);
								}
			
						
								usort($arrOut, 'cmp');
								
					
								$items = $arrOut;
			
						
							}
							else {
			
								$options = array(
									'category_nested' => $zenfeed_site_jbzoo_category_nested_alltypes_7, 
									'limit' => array(0, $zenfeed_site_rss_limit), // offset и limit
									'user' => false, 
									'published' => 1,
									'order' => 'rdate'
								);
								
								$yaCategoryModel = $zoo->table->category->get($zenfeed_site_jbzoo_catid_alltypes_7);
								$url = $zoo->route->category($yaCategoryModel);
								$items = JBModelItem::model()->getList($appId, $zenfeed_site_jbzoo_catid_alltypes_7, $typeId, $options);
							}
							
							if (!empty($items)) {
							$BeginrssYaLenta = '<?xml version="1.0" encoding="UTF-8"?>
							<rss version="2.0"
							xmlns:content="http://purl.org/rss/1.0/modules/content/"
							xmlns:dc="http://purl.org/dc/elements/1.1/"
							xmlns:media="http://search.yahoo.com/mrss/"
							xmlns:atom="http://www.w3.org/2005/Atom"
							xmlns:georss="http://www.georss.org/georss"';
							
							if ($turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {	$BeginrssYaLenta .= "\n".
							'				xmlns:yandex="http://news.yandex.ru" 
							xmlns:turbo="http://turbo.yandex.ru"';
							}
			
							$BeginrssYaLenta .= '>';
							$BeginrssYaLenta .= '
								<channel>
									<title>'.$siteName.'</title>
									<link>'.JURI::base().'</link>
									<description>'.$siteDesc.'</description>
									<language>'.$zenfeed_sitelang.'</language>'."";
									if ($zenfeed_site_jbzoo_turbo_li == 1 && $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
										$BeginrssYaLenta .= "\n".'<yandex:analytics type="LiveInternet"></yandex:analytics>';
									}
									if (!empty($zenfeed_site_jbzoo_turbo_yaid) && $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
										$BeginrssYaLenta .= "\n".'<yandex:analytics type="Yandex" id="'.$zenfeed_site_jbzoo_turbo_yaid.'"/>';
									}
									if (!empty($zenfeed_site_jbzoo_turbo_googleid) && $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
										$BeginrssYaLenta .= "\n".'<yandex:analytics id="'.$zenfeed_site_jbzoo_turbo_googleid.'" type="Google"></yandex:analytics>';
									}
									if (!empty($zenfeed_site_jbzoo_turbo_ya_rsya) && $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
										$BeginrssYaLenta .= "\n".'<yandex:adNetwork type="Yandex" id="'.$zenfeed_site_jbzoo_turbo_ya_rsya.'" turbo-ad-id="first_ad_place"></yandex:adNetwork>';
									}
							$items = array_slice($items, 0, (int)$zenfeed_site_rss_limit);		
							
					
							foreach ($items as $item) {
						
						
								$itemID = $item->id;
								$itemName = htmlspecialchars($item->name);
								$itemName = str_replace('«','&quot;',$itemName);
								$itemName = str_replace('»','&quot;',$itemName);
								$itemCreated = $item->created;
								$itemCreated = JHtml::_('date', $itemCreated, 'Y-m-d H:i:s', JFactory::getApplication()->getCfg('offset'), true);
								$itemAuthor = JFactory::getUser($item->created_by)->name;
								if (empty($itemAuthor) && $zenfeed_site_defauthor_set == '1' && $zenfeed_site_defauthor_set_fix == '0') {
									$itemAuthor = $zenfeed_site_defauthor;
								}
								if ($zenfeed_site_defauthor_set_fix == '1') {
									$itemAuthor = $zenfeed_site_defauthor;
								}
								$allCategories = $item->getRelatedCategories();
								$primaryId = $item->getPrimaryCategoryId();
								$resultcat = array();
								foreach($allCategories as $category) {
										$resultcat[] = '<category>'.$category->name.'</category>';
								}
							
								$allcatinitem = implode("\n",$resultcat);
								$itemUrl = $zoo->jbrouter->externalItem($item);
								$category = $item->getPrimaryCategory()->name;

								if (!empty($ElmDescPreview)) {
									$PreviewDesc = $item->getElement($ElmDescPreview)->data();
									$PreviewDescApp = $zoo->data->create($PreviewDesc);
								}
								else {
									$PreviewDesc = $item->getElement($ElmDescFull)->data();
									$PreviewDescApp = $zoo->data->create($FullDesc);
								}

								if ($zenfeed_site_jbzoo_descpreview_alltypes_gen_7 == 1) {
									$PreviewDesc = $item->getElement($ElmDescFull)->data();
									$PreviewDescApp = $zoo->data->create($FullDesc);
								}
								
								$FullDesc = $item->getElement($ElmDescFull)->data();
								$FullDescApp = $zoo->data->create($FullDesc);
								$figure = '';
								$figures = '';
								if ($zenfeed_images_path == 1) {
									$PreviewDesc = str_replace('src="images','src="/images',$PreviewDesc);
									$FullDesc = str_replace('src="images','src="/images',$FullDesc);
									$PreviewDesc = str_replace('//images/','/images/',$PreviewDesc);
									$FullDesc = str_replace('//images/','/images/',$FullDesc);
								}
								$PreviewDesc = htmlspecialchars(trim(strip_tags($PreviewDescApp->find('0.value'))));
								$PreviewDesc = str_replace('«','&quot;',$PreviewDesc);
								$PreviewDesc = str_replace('»','&quot;',$PreviewDesc);
								$PreviewDesc = str_replace('<br>','<br />',$PreviewDesc);
								$PreviewDesc = preg_replace("/\{.*?}/ius", "", $PreviewDesc);
								$FullDesc = trim($FullDescApp->find('0.value'));
								$FullDesc = preg_replace("/\{.*?}/ius", "", $FullDesc);
								
								$FullDesc = str_replace('«','&quot;',$FullDesc);
								$FullDesc = str_replace('»','&quot;',$FullDesc);
								$FullDesc = str_replace('&nbsp;',' ',$FullDesc);
								$FullDesc = str_replace(' style="text-align: justify;"','',$FullDesc);
								$FullDesc = str_replace('alt=""','',$FullDesc);
								$FullDesc = str_replace("title=''","",$FullDesc);
								preg_match_all("/<img.+?src=[\"'](.+?)[\"'].*?>/ius", $FullDesc, $figure);
								// $FullDesc = preg_replace("/<img[^>]+>/ius", "", $FullDesc);
								$FullDesc = str_replace('<p></p>','',$FullDesc);
								$FullDesc = str_replace('<br>','<br />',$FullDesc);
						
								if (($item->getElement($ElmImage)->data())) {
							
								$ElmImageData = $item->getElement($ElmImage)->data();
								$ElmImageApp = $zoo->data->create($ElmImageData);
								$Image = trim($ElmImageApp->find('0.file'));
			
								$pathtoimage = JPATH_ROOT .'/'. $Image;
			
								if (file_exists($pathtoimage)) {
									@$image_mime = image_type_to_mime_type(exif_imagetype($pathtoimage)); 
								}
						
			
								}
			
								if ($zenfeed_img_domain == 1) {
									$patt = '/<\s*img[^>]*src=[\"|\'](.*?)[\"|\'][^>]*\/*>/i';
									$FullMatchImg = preg_match_all($patt, $FullDesc, $matchFull);
									foreach ($matchFull[1] as $matchimage) {
										if (!strstr($matchimage,'http')) {
											$FullDesc = str_replace($matchimage, JURI::base().$matchimage, $FullDesc); // work
										}
									}
									$FullMatchImg = preg_match_all($patt, $PreviewDesc, $matchPreview);
									foreach ($matchPreview[1] as $matchimagesmall) {
										if (!strstr($matchimagesmall,'http')) {
											$PreviewDesc = str_replace($matchimagesmall, JURI::base().$matchimagesmall, $PreviewDesc); // work
										}
									}
								}
			
								if (!empty($FullDesc) || !empty($PreviewDesc)) {
							
									$rssYaLenta .= "\n";
									if ($turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) { $rssYaLenta .= '<item turbo="true">'; }
									else {
										$rssYaLenta .= '<item>';
									}
									$rssYaLenta .= "\n";
								$rssYaLenta .= '<title>'.$itemName.'</title>'."\n";
								$rssYaLenta .= '<link>'.$itemUrl.'</link>'."\n";
								$rssYaLenta .= '<guid>'.md5($itemUrl).'</guid>'."\n";
								$rssYaLenta .= '<pubDate>'.$itemCreated.' '.$zenfeed_site_time.'</pubDate>'."\n";
								$rssYaLenta .= '<media:rating scheme="urn:simple">nonadult</media:rating>'."\n";
								$rssYaLenta .= '<author>'.$itemAuthor.'</author>'."\n";
								
								$ImgesEnclos = $PreviewDesc . $FullDesc;
								preg_match_all('@src="([^"]+)"@', $ImgesEnclos, $matchesenc);
								if ($matchesenc) {
									if ($matchesenc[1] && !empty($matchesenc[1])) {
										foreach (array_unique($matchesenc[1]) as $imgenc) {
											if (strstr($imgenc,'http')) {
											$imgenc = str_replace(JURI::base().JURI::base(),JURI::base(),$imgenc);
											@$image_mimeecn = image_type_to_mime_type(exif_imagetype($imgenc)); 
											$rssYaLenta .= "\n".'<enclosure url="'.$imgenc.'" type="'.$image_mimeecn.'"/>'."\n";
											}
											else {
											
											@$image_mimeecn = image_type_to_mime_type(exif_imagetype(JURI::base().$imgenc)); 
											$rssYaLenta .= "\n".'<enclosure url="'.JURI::base().$imgenc.'" type="'.$image_mimeecn.'"/>'."\n";
											}
										}
									}
								}
			
								if ($zenfeed_cat_replace == '1' && $zenfeed_cat_replace_jbzoo == '0') {
			
								$checkarrayreplacecatname = strpos($zenfeed_cat_replace_catname,',');
									if ($checkarrayreplacecatname !== false) {
									$massivcatreplacename = explode(',',$zenfeed_cat_replace_catname);
									$countmascat = count($massivcatreplacename);
								}
			
								$offyandexcats = array (
									'Авто', 'Война', 'Дизайн', 'Дом', 'Еда', 'Здоровье', 'Знаменитости', 'Игры', 'Кино', 'Культура', 'Литература', 'Мода', 'Музыка', 'Наука', 'Общество', 'Политика', 'Природа', 'Происшествия', 'Психология', 'Путешествия', 'Спорт', 'Технологии', 'Фотографии', 'Хобби', 'Экономика', 'Юмор' 
								);
									foreach ($allCategories as $category) {
										if (!in_array($category->name, $offyandexcats)) {
			
											for ($i=0; $i < $countmascat; $i++) { 
												$rssYaLenta .= "\n".'<category>'.trim($massivcatreplacename[$i]).'</category>';
											}
			
										}
									}
								}
						
								if ($zenfeed_cat_replace == '1' && $zenfeed_cat_replace_jbzoo == '1' && !empty($zenfeed_cat_replace_jbzoo_element_checkbox_alltypes_7)) {
			
								$catforzenjbzoo = $item->getElement($zenfeed_cat_replace_jbzoo_element_checkbox_alltypes_7)->render();
						
								$massivcatreplacenamez = explode(',',$catforzenjbzoo);
								$countmascats = count($massivcatreplacenamez);
								if (!empty($massivcatreplacenamez)) {
								for ($i=0; $i < $countmascats; $i++) { 
										if (strlen($massivcatreplacenamez[$i]) > 3) {
											$rssYaLenta .= "\n".'<category>'.trim($massivcatreplacenamez[$i]).'</category>';
										}
									}
								}
						
								}
			
								if ($zenfeed_cat_replace == '0') {
									$rssYaLenta .= $allcatinitem;
								}
			
							
								if ( !empty($Image) && !empty($image_mime) && $zenfeed_site_jbzoo_turbo == 0 ) {
							
								$rssYaLenta .= "\n".'<enclosure url="'.JURI::base().$Image.'" type="'.$image_mime.'"/>';
							
								}
			
							
								if ($zenfeed_site_jbzoo_descpreview_descmini_7 == 0) {
									if ($zenfeed_site_jbzoo_descpreview_descmini_striptags_7 == 0) {
										$rssYaLenta .= '<description><![CDATA['.$PreviewDesc.']]></description>';
									}
									else {
										$rssYaLenta .= '<description><![CDATA['.strip_tags($PreviewDesc).']]></description>';
									}
									
									$rssYaLenta .= "\n";
								}
				
								if ($zenfeed_site_jbzoo_descpreview_descmini_7 == 1) {
									if ($zenfeed_site_jbzoo_descpreview_descmini_striptags_7 == 0) {
										$rssYaLenta .= '<description><![CDATA['.mb_substr($PreviewDesc, 0, $zenfeed_site_jbzoo_descpreview_descmini_count_7).']]></description>';
									}
									else {
										$rssYaLenta .= '<description><![CDATA['.strip_tags(mb_substr($PreviewDesc, 0, $zenfeed_site_jbzoo_descpreview_descmini_count_7)).']]></description>';
									}
				
									$rssYaLenta .= "\n";  
								}

								
								if ($turbopage != $zenfeed_site_pwdturbo) {
									
									$rssYaLenta .= '<content:encoded><![CDATA['.$FullDesc.'';
							
						
								if (!empty($figure[1])) {
									foreach ($figure[1] as $figureItem) {
								$figureItem = str_replace('"','', $figureItem);
							
										@$sImg = getimagesize($figureItem); //Warning, if img delete
										$figureItem = trim($figureItem);
							
										if (!strpos('http',$figureItem)) {
											$figureItem = JURI::base().$figureItem;
										}
							
										$figures .= '
										<figure>
										<img src="'.$figureItem.'" width="'.$sImg[0].'" height="'.$sImg[1].'">
										<figcaption>'.$itemName.'</figcaption>
										</figure>';
							
									}
								
								$rssYaLenta .= $figures;
							
								}
						
								$pathtoimage = JPATH_ROOT .'/'. $Image;
			
								if (file_exists($pathtoimage)) {
									@$oneImg = getimagesize($pathtoimage); //Warning, if img delete
													
									$rssYaLenta .= '
									<figure>
									<img src="'.JURI::base().$Image.'" width="'.$oneImg[0].'" height="'.$oneImg[1].'">
									<figcaption>'.$itemName.'</figcaption>
									</figure>';
						
									$rssYaLenta .= ']]></content:encoded>
									';
								} 
							}
			
								if ($turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
			
								$rssYaLenta .= '<turbo:content><![CDATA[';
								
							
									if (!empty($figure[1])) {
										foreach ($figure[1] as $figureItem) {
									$figureItem = str_replace('"','', $figureItem);
								
											@$sImg = getimagesize($figureItem); //Warning, if img delete
											$figureItem = trim($figureItem);
								
											if (!strpos('http',$figureItem)) {
												$figureItem = JURI::base().$figureItem;
											}
								
											$figures .= '
											<header>
											<h1>'.$itemName.'</h1>
											<figure>
											<img src="'.$figureItem.'" width="'.$sImg[0].'" height="'.$sImg[1].'">
											<figcaption>'.$itemName.'</figcaption>
											</figure></header>';
								
										}
									
									$rssYaLenta .= $figures;
								
									}
							
									$pathtoimage = JPATH_ROOT .'/'. $Image;
				
									if (file_exists($pathtoimage)) {
										@$oneImg = getimagesize($pathtoimage); //Warning, if img delete
														
										$rssYaLenta .= '
										<header>
										<h1>'.$itemName.'</h1>
										<figure>
										<img src="'.JURI::base().$Image.'" width="'.$oneImg[0].'" height="'.$oneImg[1].'">
										<figcaption>'.$itemName.'</figcaption>
										</figure></header>';
									} 
										$rssYaLenta .= $FullDesc.']]></turbo:content>'."\n";
			
									}
			
			
									if (file_exists($pathtoimage)) {
										@$oneImg = getimagesize($pathtoimage); //Warning, if img delete
										$rssYaLenta .= "\n".'<enclosure url="'.JURI::base().$Image.'" type="'.$image_mime.'"/>';
									} 
			
									
									if ($figure) {
										if (!empty($figure[1]) && $figure[1]) {
			
										foreach ($figure[1] as $imageenc) {
											@$image_mimeecn = image_type_to_mime_type(exif_imagetype(JURI::base().$imageenc)); 
											$rssYaLenta .= "\n".'<enclosure url="'.JURI::base().$imageenc.'" type="'.$image_mimeecn.'"/>';
										}
										
										}
									}
			
			
									
									$rssYaLenta .= "\n".'</item>'."\n";
							
								}
			
					
							}

			
							}
						
						}
							// go eight type JBZoo
							
							if ($zenfeed_site_jbzoo_gen_on_8 == 1) {
							
							if ($zenfeed_site_jbzoo_category_nested == 1) {
								$zenfeed_site_jbzoo_category_nested = true;
							}
							else {
								$zenfeed_site_jbzoo_category_nested = false;
							}
							// JBZoo::init();
							$zoo = App::getInstance('zoo');
							$db = JFactory::getDBO();
							$doc = JFactory::getDocument();
							$appId = $zenfeed_site_jbzoo_app_alltypes_8;
							$ElmImage = $zenfeed_site_jbzoo_image_alltypes_8;
							$ElmDescPreview = $zenfeed_site_jbzoo_descpreview_alltypes_8;
							$ElmDescFull = $zenfeed_site_jbzoo_descfull_alltypes_8;
							$siteName = htmlspecialchars($zenfeed_sitename);
							$siteDesc = htmlspecialchars($zenfeed_sitedesc);
							$typeId = $zenfeed_site_jbzoo_type_alltypes_8; 
							$items = '';
							$all_items = array();
			
							$checkarraycatzoo = strpos($zenfeed_site_jbzoo_catid_alltypes_8,',');
							
							if ($checkarraycatzoo !== false)  {
								$massivcatzoo = explode(',',$zenfeed_site_jbzoo_catid_alltypes_8);
								$countmas = count($massivcatzoo);
			
								$options = array(
									'category_nested' => $zenfeed_site_jbzoo_category_nested_alltypes_8, 
									'limit' => array(0, $zenfeed_site_rss_limit), // offset и limit
									'user' => false, 
									'published' => 1,
									'order' => 'rdate'
								);
				
								
					
							for ($i=0; $i < $countmas; $i++) { 
			
								$yaCategoryModel = $zoo->table->category->get($massivcatzoo[$i]);
								$url = $zoo->route->category($yaCategoryModel);
								$items = JBModelItem::model()->getList($appId, $massivcatzoo[$i], $typeId, $options);
								$all_items[] = $items;
							}
			
				
							function cmp($a, $b){
								$ad = strtotime($a->created);
								$bd = strtotime($b->created);
								return ($bd-$ad);
							}
							
								$arrOut = array();
							
								foreach($all_items as $subArr) {
								$arrOut = array_merge($arrOut, $subArr);
								}
			
						
								usort($arrOut, 'cmp');
								
					
								$items = $arrOut;
			
						
							}
							else {
			
								$options = array(
									'category_nested' => $zenfeed_site_jbzoo_category_nested_alltypes_8, 
									'limit' => array(0, $zenfeed_site_rss_limit), // offset и limit
									'user' => false, 
									'published' => 1,
									'order' => 'rdate'
								);
								
								$yaCategoryModel = $zoo->table->category->get($zenfeed_site_jbzoo_catid_alltypes_8);
								$url = $zoo->route->category($yaCategoryModel);
								$items = JBModelItem::model()->getList($appId, $zenfeed_site_jbzoo_catid_alltypes_8, $typeId, $options);
							}
							
							if (!empty($items)) {
							$BeginrssYaLenta = '<?xml version="1.0" encoding="UTF-8"?>
							<rss version="2.0"
							xmlns:content="http://purl.org/rss/1.0/modules/content/"
							xmlns:dc="http://purl.org/dc/elements/1.1/"
							xmlns:media="http://search.yahoo.com/mrss/"
							xmlns:atom="http://www.w3.org/2005/Atom"
							xmlns:georss="http://www.georss.org/georss"';
							
							if ($turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {	$BeginrssYaLenta .= "\n".
							'				xmlns:yandex="http://news.yandex.ru" 
							xmlns:turbo="http://turbo.yandex.ru"';
							}
			
							$BeginrssYaLenta .= '>';
							$BeginrssYaLenta .= '
								<channel>
									<title>'.$siteName.'</title>
									<link>'.JURI::base().'</link>
									<description>'.$siteDesc.'</description>
									<language>'.$zenfeed_sitelang.'</language>'."";
									if ($zenfeed_site_jbzoo_turbo_li == 1 && $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
										$BeginrssYaLenta .= "\n".'<yandex:analytics type="LiveInternet"></yandex:analytics>';
									}
									if (!empty($zenfeed_site_jbzoo_turbo_yaid) && $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
										$BeginrssYaLenta .= "\n".'<yandex:analytics type="Yandex" id="'.$zenfeed_site_jbzoo_turbo_yaid.'"/>';
									}
									if (!empty($zenfeed_site_jbzoo_turbo_googleid) && $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
										$BeginrssYaLenta .= "\n".'<yandex:analytics id="'.$zenfeed_site_jbzoo_turbo_googleid.'" type="Google"></yandex:analytics>';
									}
									if (!empty($zenfeed_site_jbzoo_turbo_ya_rsya) && $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
										$BeginrssYaLenta .= "\n".'<yandex:adNetwork type="Yandex" id="'.$zenfeed_site_jbzoo_turbo_ya_rsya.'" turbo-ad-id="first_ad_place"></yandex:adNetwork>';
									}
							$items = array_slice($items, 0, (int)$zenfeed_site_rss_limit);		
							
					
							foreach ($items as $item) {
						
						
								$itemID = $item->id;
								$itemName = htmlspecialchars($item->name);
								$itemName = str_replace('«','&quot;',$itemName);
								$itemName = str_replace('»','&quot;',$itemName);
								$itemCreated = $item->created;
								$itemCreated = JHtml::_('date', $itemCreated, 'Y-m-d H:i:s', JFactory::getApplication()->getCfg('offset'), true);
								$itemAuthor = JFactory::getUser($item->created_by)->name;
								if (empty($itemAuthor) && $zenfeed_site_defauthor_set == '1' && $zenfeed_site_defauthor_set_fix == '0') {
									$itemAuthor = $zenfeed_site_defauthor;
								}
								if ($zenfeed_site_defauthor_set_fix == '1') {
									$itemAuthor = $zenfeed_site_defauthor;
								}
								$allCategories = $item->getRelatedCategories();
								$primaryId = $item->getPrimaryCategoryId();
								$resultcat = array();
								foreach($allCategories as $category) {
										$resultcat[] = '<category>'.$category->name.'</category>';
								}
							
								$allcatinitem = implode("\n",$resultcat);
								$itemUrl = $zoo->jbrouter->externalItem($item);
								$category = $item->getPrimaryCategory()->name;

								if (!empty($ElmDescPreview)) {
									$PreviewDesc = $item->getElement($ElmDescPreview)->data();
									$PreviewDescApp = $zoo->data->create($PreviewDesc);
								}
								else {
									$PreviewDesc = $item->getElement($ElmDescFull)->data();
									$PreviewDescApp = $zoo->data->create($FullDesc);
								}

								if ($zenfeed_site_jbzoo_descpreview_alltypes_gen_8 == 1) {
									$PreviewDesc = $item->getElement($ElmDescFull)->data();
									$PreviewDescApp = $zoo->data->create($FullDesc);
								}
								
								$FullDesc = $item->getElement($ElmDescFull)->data();
								$FullDescApp = $zoo->data->create($FullDesc);
								$figure = '';
								$figures = '';
								if ($zenfeed_images_path == 1) {
									$PreviewDesc = str_replace('src="images','src="/images',$PreviewDesc);
									$FullDesc = str_replace('src="images','src="/images',$FullDesc);
									$PreviewDesc = str_replace('//images/','/images/',$PreviewDesc);
									$FullDesc = str_replace('//images/','/images/',$FullDesc);
								}
								$PreviewDesc = htmlspecialchars(trim(strip_tags($PreviewDescApp->find('0.value'))));
								$PreviewDesc = str_replace('«','&quot;',$PreviewDesc);
								$PreviewDesc = str_replace('»','&quot;',$PreviewDesc);
								$PreviewDesc = str_replace('<br>','<br />',$PreviewDesc);
								$PreviewDesc = preg_replace("/\{.*?}/ius", "", $PreviewDesc);
								$FullDesc = trim($FullDescApp->find('0.value'));
								$FullDesc = preg_replace("/\{.*?}/ius", "", $FullDesc);
								
								$FullDesc = str_replace('«','&quot;',$FullDesc);
								$FullDesc = str_replace('»','&quot;',$FullDesc);
								$FullDesc = str_replace('&nbsp;',' ',$FullDesc);
								$FullDesc = str_replace(' style="text-align: justify;"','',$FullDesc);
								$FullDesc = str_replace('alt=""','',$FullDesc);
								$FullDesc = str_replace("title=''","",$FullDesc);
								preg_match_all("/<img.+?src=[\"'](.+?)[\"'].*?>/ius", $FullDesc, $figure);
								// $FullDesc = preg_replace("/<img[^>]+>/ius", "", $FullDesc);
								$FullDesc = str_replace('<p></p>','',$FullDesc);
								$FullDesc = str_replace('<br>','<br />',$FullDesc);
						
								if (($item->getElement($ElmImage)->data())) {
							
								$ElmImageData = $item->getElement($ElmImage)->data();
								$ElmImageApp = $zoo->data->create($ElmImageData);
								$Image = trim($ElmImageApp->find('0.file'));
			
								$pathtoimage = JPATH_ROOT .'/'. $Image;
			
								if (file_exists($pathtoimage)) {
									@$image_mime = image_type_to_mime_type(exif_imagetype($pathtoimage)); 
								}
						
			
								}
			
								if ($zenfeed_img_domain == 1) {
									$patt = '/<\s*img[^>]*src=[\"|\'](.*?)[\"|\'][^>]*\/*>/i';
									$FullMatchImg = preg_match_all($patt, $FullDesc, $matchFull);
									foreach ($matchFull[1] as $matchimage) {
										if (!strstr($matchimage,'http')) {
											$FullDesc = str_replace($matchimage, JURI::base().$matchimage, $FullDesc); // work
										}
									}
									$FullMatchImg = preg_match_all($patt, $PreviewDesc, $matchPreview);
									foreach ($matchPreview[1] as $matchimagesmall) {
										if (!strstr($matchimagesmall,'http')) {
											$PreviewDesc = str_replace($matchimagesmall, JURI::base().$matchimagesmall, $PreviewDesc); // work
										}
									}
								}
			
								if (!empty($FullDesc) || !empty($PreviewDesc)) {
							
									$rssYaLenta .= "\n";
									if ($turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) { $rssYaLenta .= '<item turbo="true">'; }
									else {
										$rssYaLenta .= '<item>';
									}
									$rssYaLenta .= "\n";
								$rssYaLenta .= '<title>'.$itemName.'</title>'."\n";
								$rssYaLenta .= '<link>'.$itemUrl.'</link>'."\n";
								$rssYaLenta .= '<guid>'.md5($itemUrl).'</guid>'."\n";
								$rssYaLenta .= '<pubDate>'.$itemCreated.' '.$zenfeed_site_time.'</pubDate>'."\n";
								$rssYaLenta .= '<media:rating scheme="urn:simple">nonadult</media:rating>'."\n";
								$rssYaLenta .= '<author>'.$itemAuthor.'</author>'."\n";
								
								$ImgesEnclos = $PreviewDesc . $FullDesc;
								preg_match_all('@src="([^"]+)"@', $ImgesEnclos, $matchesenc);
								if ($matchesenc) {
									if ($matchesenc[1] && !empty($matchesenc[1])) {
										foreach (array_unique($matchesenc[1]) as $imgenc) {
											if (strstr($imgenc,'http')) {
											$imgenc = str_replace(JURI::base().JURI::base(),JURI::base(),$imgenc);
											@$image_mimeecn = image_type_to_mime_type(exif_imagetype($imgenc)); 
											$rssYaLenta .= "\n".'<enclosure url="'.$imgenc.'" type="'.$image_mimeecn.'"/>'."\n";
											}
											else {
											
											@$image_mimeecn = image_type_to_mime_type(exif_imagetype(JURI::base().$imgenc)); 
											$rssYaLenta .= "\n".'<enclosure url="'.JURI::base().$imgenc.'" type="'.$image_mimeecn.'"/>'."\n";
											}
										}
									}
								}
			
								if ($zenfeed_cat_replace == '1' && $zenfeed_cat_replace_jbzoo == '0') {
			
								$checkarrayreplacecatname = strpos($zenfeed_cat_replace_catname,',');
									if ($checkarrayreplacecatname !== false) {
									$massivcatreplacename = explode(',',$zenfeed_cat_replace_catname);
									$countmascat = count($massivcatreplacename);
								}
			
								$offyandexcats = array (
									'Авто', 'Война', 'Дизайн', 'Дом', 'Еда', 'Здоровье', 'Знаменитости', 'Игры', 'Кино', 'Культура', 'Литература', 'Мода', 'Музыка', 'Наука', 'Общество', 'Политика', 'Природа', 'Происшествия', 'Психология', 'Путешествия', 'Спорт', 'Технологии', 'Фотографии', 'Хобби', 'Экономика', 'Юмор' 
								);
									foreach ($allCategories as $category) {
										if (!in_array($category->name, $offyandexcats)) {
			
											for ($i=0; $i < $countmascat; $i++) { 
												$rssYaLenta .= "\n".'<category>'.trim($massivcatreplacename[$i]).'</category>';
											}
			
										}
									}
								}
						
								if ($zenfeed_cat_replace == '1' && $zenfeed_cat_replace_jbzoo == '1' && !empty($zenfeed_cat_replace_jbzoo_element_checkbox_alltypes_8)) {
			
								$catforzenjbzoo = $item->getElement($zenfeed_cat_replace_jbzoo_element_checkbox_alltypes_8)->render();
						
								$massivcatreplacenamez = explode(',',$catforzenjbzoo);
								$countmascats = count($massivcatreplacenamez);
								if (!empty($massivcatreplacenamez)) {
								for ($i=0; $i < $countmascats; $i++) { 
										if (strlen($massivcatreplacenamez[$i]) > 3) {
											$rssYaLenta .= "\n".'<category>'.trim($massivcatreplacenamez[$i]).'</category>';
										}
									}
								}
						
								}
			
								if ($zenfeed_cat_replace == '0') {
									$rssYaLenta .= $allcatinitem;
								}
			
							
								if ( !empty($Image) && !empty($image_mime) && $zenfeed_site_jbzoo_turbo == 0 ) {
							
								$rssYaLenta .= "\n".'<enclosure url="'.JURI::base().$Image.'" type="'.$image_mime.'"/>';
							
								}
			
							
								if ($zenfeed_site_jbzoo_descpreview_descmini_8 == 0) {
									if ($zenfeed_site_jbzoo_descpreview_descmini_striptags_8 == 0) {
										$rssYaLenta .= '<description><![CDATA['.$PreviewDesc.']]></description>';
									}
									else {
										$rssYaLenta .= '<description><![CDATA['.strip_tags($PreviewDesc).']]></description>';
									}
									
									$rssYaLenta .= "\n";
								}
				
								if ($zenfeed_site_jbzoo_descpreview_descmini_8 == 1) {
									if ($zenfeed_site_jbzoo_descpreview_descmini_striptags_8 == 0) {
										$rssYaLenta .= '<description><![CDATA['.mb_substr($PreviewDesc, 0, $zenfeed_site_jbzoo_descpreview_descmini_count_8).']]></description>';
									}
									else {
										$rssYaLenta .= '<description><![CDATA['.strip_tags(mb_substr($PreviewDesc, 0, $zenfeed_site_jbzoo_descpreview_descmini_count_8)).']]></description>';
									}
				
									$rssYaLenta .= "\n";  
								}

								
								if ($turbopage != $zenfeed_site_pwdturbo) {
									
									$rssYaLenta .= '<content:encoded><![CDATA['.$FullDesc.'';
							
						
								if (!empty($figure[1])) {
									foreach ($figure[1] as $figureItem) {
								$figureItem = str_replace('"','', $figureItem);
							
										@$sImg = getimagesize($figureItem); //Warning, if img delete
										$figureItem = trim($figureItem);
							
										if (!strpos('http',$figureItem)) {
											$figureItem = JURI::base().$figureItem;
										}
							
										$figures .= '
										<figure>
										<img src="'.$figureItem.'" width="'.$sImg[0].'" height="'.$sImg[1].'">
										<figcaption>'.$itemName.'</figcaption>
										</figure>';
							
									}
								
								$rssYaLenta .= $figures;
							
								}
						
								$pathtoimage = JPATH_ROOT .'/'. $Image;
			
								if (file_exists($pathtoimage)) {
									@$oneImg = getimagesize($pathtoimage); //Warning, if img delete
													
									$rssYaLenta .= '
									<figure>
									<img src="'.JURI::base().$Image.'" width="'.$oneImg[0].'" height="'.$oneImg[1].'">
									<figcaption>'.$itemName.'</figcaption>
									</figure>';
						
									$rssYaLenta .= ']]></content:encoded>
									';
								} 
							}
			
								if ($turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
			
								$rssYaLenta .= '<turbo:content><![CDATA[';
								
							
									if (!empty($figure[1])) {
										foreach ($figure[1] as $figureItem) {
									$figureItem = str_replace('"','', $figureItem);
								
											@$sImg = getimagesize($figureItem); //Warning, if img delete
											$figureItem = trim($figureItem);
								
											if (!strpos('http',$figureItem)) {
												$figureItem = JURI::base().$figureItem;
											}
								
											$figures .= '
											<header>
											<h1>'.$itemName.'</h1>
											<figure>
											<img src="'.$figureItem.'" width="'.$sImg[0].'" height="'.$sImg[1].'">
											<figcaption>'.$itemName.'</figcaption>
											</figure></header>';
								
										}
									
									$rssYaLenta .= $figures;
								
									}
							
									$pathtoimage = JPATH_ROOT .'/'. $Image;
				
									if (file_exists($pathtoimage)) {
										@$oneImg = getimagesize($pathtoimage); //Warning, if img delete
														
										$rssYaLenta .= '
										<header>
										<h1>'.$itemName.'</h1>
										<figure>
										<img src="'.JURI::base().$Image.'" width="'.$oneImg[0].'" height="'.$oneImg[1].'">
										<figcaption>'.$itemName.'</figcaption>
										</figure></header>';
									} 
										$rssYaLenta .= $FullDesc.']]></turbo:content>'."\n";
			
									}
			
			
									if (file_exists($pathtoimage)) {
										@$oneImg = getimagesize($pathtoimage); //Warning, if img delete
										$rssYaLenta .= "\n".'<enclosure url="'.JURI::base().$Image.'" type="'.$image_mime.'"/>';
									} 
			
									
									if ($figure) {
										if (!empty($figure[1]) && $figure[1]) {
			
										foreach ($figure[1] as $imageenc) {
											@$image_mimeecn = image_type_to_mime_type(exif_imagetype(JURI::base().$imageenc)); 
											$rssYaLenta .= "\n".'<enclosure url="'.JURI::base().$imageenc.'" type="'.$image_mimeecn.'"/>';
										}
										
										}
									}
			
			
									
									$rssYaLenta .= "\n".'</item>'."\n";
							
								}
			
					
							}

			
							}
						
						}
							// go nine type JBZoo
							
							if ($zenfeed_site_jbzoo_gen_on_9 == 1) {
							
							if ($zenfeed_site_jbzoo_category_nested == 1) {
								$zenfeed_site_jbzoo_category_nested = true;
							}
							else {
								$zenfeed_site_jbzoo_category_nested = false;
							}
							// JBZoo::init();
							$zoo = App::getInstance('zoo');
							$db = JFactory::getDBO();
							$doc = JFactory::getDocument();
							$appId = $zenfeed_site_jbzoo_app_alltypes_9;
							$ElmImage = $zenfeed_site_jbzoo_image_alltypes_9;
							$ElmDescPreview = $zenfeed_site_jbzoo_descpreview_alltypes_9;
							$ElmDescFull = $zenfeed_site_jbzoo_descfull_alltypes_9;
							$siteName = htmlspecialchars($zenfeed_sitename);
							$siteDesc = htmlspecialchars($zenfeed_sitedesc);
							$typeId = $zenfeed_site_jbzoo_type_alltypes_9; 
							$items = '';
							$all_items = array();
			
							$checkarraycatzoo = strpos($zenfeed_site_jbzoo_catid_alltypes_9,',');
							
							if ($checkarraycatzoo !== false)  {
								$massivcatzoo = explode(',',$zenfeed_site_jbzoo_catid_alltypes_9);
								$countmas = count($massivcatzoo);
			
								$options = array(
									'category_nested' => $zenfeed_site_jbzoo_category_nested_alltypes_9, 
									'limit' => array(0, $zenfeed_site_rss_limit), // offset и limit
									'user' => false, 
									'published' => 1,
									'order' => 'rdate'
								);
				
								
					
							for ($i=0; $i < $countmas; $i++) { 
			
								$yaCategoryModel = $zoo->table->category->get($massivcatzoo[$i]);
								$url = $zoo->route->category($yaCategoryModel);
								$items = JBModelItem::model()->getList($appId, $massivcatzoo[$i], $typeId, $options);
								$all_items[] = $items;
							}
			
				
							function cmp($a, $b){
								$ad = strtotime($a->created);
								$bd = strtotime($b->created);
								return ($bd-$ad);
							}
							
								$arrOut = array();
							
								foreach($all_items as $subArr) {
								$arrOut = array_merge($arrOut, $subArr);
								}
			
						
								usort($arrOut, 'cmp');
								
					
								$items = $arrOut;
			
						
							}
							else {
			
								$options = array(
									'category_nested' => $zenfeed_site_jbzoo_category_nested_alltypes_9, 
									'limit' => array(0, $zenfeed_site_rss_limit), // offset и limit
									'user' => false, 
									'published' => 1,
									'order' => 'rdate'
								);
								
								$yaCategoryModel = $zoo->table->category->get($zenfeed_site_jbzoo_catid_alltypes_9);
								$url = $zoo->route->category($yaCategoryModel);
								$items = JBModelItem::model()->getList($appId, $zenfeed_site_jbzoo_catid_alltypes_9, $typeId, $options);
							}
							
							if (!empty($items)) {
							$BeginrssYaLenta = '<?xml version="1.0" encoding="UTF-8"?>
							<rss version="2.0"
							xmlns:content="http://purl.org/rss/1.0/modules/content/"
							xmlns:dc="http://purl.org/dc/elements/1.1/"
							xmlns:media="http://search.yahoo.com/mrss/"
							xmlns:atom="http://www.w3.org/2005/Atom"
							xmlns:georss="http://www.georss.org/georss"';
							
							if ($turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {	$BeginrssYaLenta .= "\n".
							'				xmlns:yandex="http://news.yandex.ru" 
							xmlns:turbo="http://turbo.yandex.ru"';
							}
			
							$BeginrssYaLenta .= '>';
							$BeginrssYaLenta .= '
								<channel>
									<title>'.$siteName.'</title>
									<link>'.JURI::base().'</link>
									<description>'.$siteDesc.'</description>
									<language>'.$zenfeed_sitelang.'</language>'."";
									if ($zenfeed_site_jbzoo_turbo_li == 1 && $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
										$BeginrssYaLenta .= "\n".'<yandex:analytics type="LiveInternet"></yandex:analytics>';
									}
									if (!empty($zenfeed_site_jbzoo_turbo_yaid) && $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
										$BeginrssYaLenta .= "\n".'<yandex:analytics type="Yandex" id="'.$zenfeed_site_jbzoo_turbo_yaid.'"/>';
									}
									if (!empty($zenfeed_site_jbzoo_turbo_googleid) && $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
										$BeginrssYaLenta .= "\n".'<yandex:analytics id="'.$zenfeed_site_jbzoo_turbo_googleid.'" type="Google"></yandex:analytics>';
									}
									if (!empty($zenfeed_site_jbzoo_turbo_ya_rsya) && $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
										$BeginrssYaLenta .= "\n".'<yandex:adNetwork type="Yandex" id="'.$zenfeed_site_jbzoo_turbo_ya_rsya.'" turbo-ad-id="first_ad_place"></yandex:adNetwork>';
									}
							$items = array_slice($items, 0, (int)$zenfeed_site_rss_limit);		
							
					
							foreach ($items as $item) {
						
						
								$itemID = $item->id;
								$itemName = htmlspecialchars($item->name);
								$itemName = str_replace('«','&quot;',$itemName);
								$itemName = str_replace('»','&quot;',$itemName);
								$itemCreated = $item->created;
								$itemCreated = JHtml::_('date', $itemCreated, 'Y-m-d H:i:s', JFactory::getApplication()->getCfg('offset'), true);
								$itemAuthor = JFactory::getUser($item->created_by)->name;
								if (empty($itemAuthor) && $zenfeed_site_defauthor_set == '1' && $zenfeed_site_defauthor_set_fix == '0') {
									$itemAuthor = $zenfeed_site_defauthor;
								}
								if ($zenfeed_site_defauthor_set_fix == '1') {
									$itemAuthor = $zenfeed_site_defauthor;
								}
								$allCategories = $item->getRelatedCategories();
								$primaryId = $item->getPrimaryCategoryId();
								$resultcat = array();
								foreach($allCategories as $category) {
										$resultcat[] = '<category>'.$category->name.'</category>';
								}
							
								$allcatinitem = implode("\n",$resultcat);
								$itemUrl = $zoo->jbrouter->externalItem($item);
								$category = $item->getPrimaryCategory()->name;

								if (!empty($ElmDescPreview)) {
									$PreviewDesc = $item->getElement($ElmDescPreview)->data();
									$PreviewDescApp = $zoo->data->create($PreviewDesc);
								}
								else {
									$PreviewDesc = $item->getElement($ElmDescFull)->data();
									$PreviewDescApp = $zoo->data->create($FullDesc);
								}

								if ($zenfeed_site_jbzoo_descpreview_alltypes_gen_9 == 1) {
									$PreviewDesc = $item->getElement($ElmDescFull)->data();
									$PreviewDescApp = $zoo->data->create($FullDesc);
								}
								
								$FullDesc = $item->getElement($ElmDescFull)->data();
								$FullDescApp = $zoo->data->create($FullDesc);
								$figure = '';
								$figures = '';
								if ($zenfeed_images_path == 1) {
									$PreviewDesc = str_replace('src="images','src="/images',$PreviewDesc);
									$FullDesc = str_replace('src="images','src="/images',$FullDesc);
									$PreviewDesc = str_replace('//images/','/images/',$PreviewDesc);
									$FullDesc = str_replace('//images/','/images/',$FullDesc);
								}
								$PreviewDesc = htmlspecialchars(trim(strip_tags($PreviewDescApp->find('0.value'))));
								$PreviewDesc = str_replace('«','&quot;',$PreviewDesc);
								$PreviewDesc = str_replace('»','&quot;',$PreviewDesc);
								$PreviewDesc = str_replace('<br>','<br />',$PreviewDesc);
								$PreviewDesc = preg_replace("/\{.*?}/ius", "", $PreviewDesc);
								$FullDesc = trim($FullDescApp->find('0.value'));
								$FullDesc = preg_replace("/\{.*?}/ius", "", $FullDesc);
								
								$FullDesc = str_replace('«','&quot;',$FullDesc);
								$FullDesc = str_replace('»','&quot;',$FullDesc);
								$FullDesc = str_replace('&nbsp;',' ',$FullDesc);
								$FullDesc = str_replace(' style="text-align: justify;"','',$FullDesc);
								$FullDesc = str_replace('alt=""','',$FullDesc);
								$FullDesc = str_replace("title=''","",$FullDesc);
								preg_match_all("/<img.+?src=[\"'](.+?)[\"'].*?>/ius", $FullDesc, $figure);
								// $FullDesc = preg_replace("/<img[^>]+>/ius", "", $FullDesc);
								$FullDesc = str_replace('<p></p>','',$FullDesc);
								$FullDesc = str_replace('<br>','<br />',$FullDesc);
						
								if (($item->getElement($ElmImage)->data())) {
							
								$ElmImageData = $item->getElement($ElmImage)->data();
								$ElmImageApp = $zoo->data->create($ElmImageData);
								$Image = trim($ElmImageApp->find('0.file'));
			
								$pathtoimage = JPATH_ROOT .'/'. $Image;
			
								if (file_exists($pathtoimage)) {
									@$image_mime = image_type_to_mime_type(exif_imagetype($pathtoimage)); 
								}
						
			
								}
			
								if ($zenfeed_img_domain == 1) {
									$patt = '/<\s*img[^>]*src=[\"|\'](.*?)[\"|\'][^>]*\/*>/i';
									$FullMatchImg = preg_match_all($patt, $FullDesc, $matchFull);
									foreach ($matchFull[1] as $matchimage) {
										if (!strstr($matchimage,'http')) {
											$FullDesc = str_replace($matchimage, JURI::base().$matchimage, $FullDesc); // work
										}
									}
									$FullMatchImg = preg_match_all($patt, $PreviewDesc, $matchPreview);
									foreach ($matchPreview[1] as $matchimagesmall) {
										if (!strstr($matchimagesmall,'http')) {
											$PreviewDesc = str_replace($matchimagesmall, JURI::base().$matchimagesmall, $PreviewDesc); // work
										}
									}
								}
			
								if (!empty($FullDesc) || !empty($PreviewDesc)) {
							
									$rssYaLenta .= "\n";
									if ($turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) { $rssYaLenta .= '<item turbo="true">'; }
									else {
										$rssYaLenta .= '<item>';
									}
									$rssYaLenta .= "\n";
								$rssYaLenta .= '<title>'.$itemName.'</title>'."\n";
								$rssYaLenta .= '<link>'.$itemUrl.'</link>'."\n";
								$rssYaLenta .= '<guid>'.md5($itemUrl).'</guid>'."\n";
								$rssYaLenta .= '<pubDate>'.$itemCreated.' '.$zenfeed_site_time.'</pubDate>'."\n";
								$rssYaLenta .= '<media:rating scheme="urn:simple">nonadult</media:rating>'."\n";
								$rssYaLenta .= '<author>'.$itemAuthor.'</author>'."\n";
								
								$ImgesEnclos = $PreviewDesc . $FullDesc;
								preg_match_all('@src="([^"]+)"@', $ImgesEnclos, $matchesenc);
								if ($matchesenc) {
									if ($matchesenc[1] && !empty($matchesenc[1])) {
										foreach (array_unique($matchesenc[1]) as $imgenc) {
											if (strstr($imgenc,'http')) {
											$imgenc = str_replace(JURI::base().JURI::base(),JURI::base(),$imgenc);
											@$image_mimeecn = image_type_to_mime_type(exif_imagetype($imgenc)); 
											$rssYaLenta .= "\n".'<enclosure url="'.$imgenc.'" type="'.$image_mimeecn.'"/>'."\n";
											}
											else {
											
											@$image_mimeecn = image_type_to_mime_type(exif_imagetype(JURI::base().$imgenc)); 
											$rssYaLenta .= "\n".'<enclosure url="'.JURI::base().$imgenc.'" type="'.$image_mimeecn.'"/>'."\n";
											}
										}
									}
								}
			
								if ($zenfeed_cat_replace == '1' && $zenfeed_cat_replace_jbzoo == '0') {
			
								$checkarrayreplacecatname = strpos($zenfeed_cat_replace_catname,',');
									if ($checkarrayreplacecatname !== false) {
									$massivcatreplacename = explode(',',$zenfeed_cat_replace_catname);
									$countmascat = count($massivcatreplacename);
								}
			
								$offyandexcats = array (
									'Авто', 'Война', 'Дизайн', 'Дом', 'Еда', 'Здоровье', 'Знаменитости', 'Игры', 'Кино', 'Культура', 'Литература', 'Мода', 'Музыка', 'Наука', 'Общество', 'Политика', 'Природа', 'Происшествия', 'Психология', 'Путешествия', 'Спорт', 'Технологии', 'Фотографии', 'Хобби', 'Экономика', 'Юмор' 
								);
									foreach ($allCategories as $category) {
										if (!in_array($category->name, $offyandexcats)) {
			
											for ($i=0; $i < $countmascat; $i++) { 
												$rssYaLenta .= "\n".'<category>'.trim($massivcatreplacename[$i]).'</category>';
											}
			
										}
									}
								}
						
								if ($zenfeed_cat_replace == '1' && $zenfeed_cat_replace_jbzoo == '1' && !empty($zenfeed_cat_replace_jbzoo_element_checkbox_alltypes_9)) {
			
								$catforzenjbzoo = $item->getElement($zenfeed_cat_replace_jbzoo_element_checkbox_alltypes_9)->render();
						
								$massivcatreplacenamez = explode(',',$catforzenjbzoo);
								$countmascats = count($massivcatreplacenamez);
								if (!empty($massivcatreplacenamez)) {
								for ($i=0; $i < $countmascats; $i++) { 
										if (strlen($massivcatreplacenamez[$i]) > 3) {
											$rssYaLenta .= "\n".'<category>'.trim($massivcatreplacenamez[$i]).'</category>';
										}
									}
								}
						
								}
			
								if ($zenfeed_cat_replace == '0') {
									$rssYaLenta .= $allcatinitem;
								}
			
							
								if ( !empty($Image) && !empty($image_mime) && $zenfeed_site_jbzoo_turbo == 0 ) {
							
								$rssYaLenta .= "\n".'<enclosure url="'.JURI::base().$Image.'" type="'.$image_mime.'"/>';
							
								}
			
							
								if ($zenfeed_site_jbzoo_descpreview_descmini_9 == 0) {
									if ($zenfeed_site_jbzoo_descpreview_descmini_striptags_9 == 0) {
										$rssYaLenta .= '<description><![CDATA['.$PreviewDesc.']]></description>';
									}
									else {
										$rssYaLenta .= '<description><![CDATA['.strip_tags($PreviewDesc).']]></description>';
									}
									
									$rssYaLenta .= "\n";
								}
				
								if ($zenfeed_site_jbzoo_descpreview_descmini_9 == 1) {
									if ($zenfeed_site_jbzoo_descpreview_descmini_striptags_9 == 0) {
										$rssYaLenta .= '<description><![CDATA['.mb_substr($PreviewDesc, 0, $zenfeed_site_jbzoo_descpreview_descmini_count_9).']]></description>';
									}
									else {
										$rssYaLenta .= '<description><![CDATA['.strip_tags(mb_substr($PreviewDesc, 0, $zenfeed_site_jbzoo_descpreview_descmini_count_9)).']]></description>';
									}
				
									$rssYaLenta .= "\n";  
								}

								
								if ($turbopage != $zenfeed_site_pwdturbo) {
									
									$rssYaLenta .= '<content:encoded><![CDATA['.$FullDesc.'';
							
						
								if (!empty($figure[1])) {
									foreach ($figure[1] as $figureItem) {
								$figureItem = str_replace('"','', $figureItem);
							
										@$sImg = getimagesize($figureItem); //Warning, if img delete
										$figureItem = trim($figureItem);
							
										if (!strpos('http',$figureItem)) {
											$figureItem = JURI::base().$figureItem;
										}
							
										$figures .= '
										<figure>
										<img src="'.$figureItem.'" width="'.$sImg[0].'" height="'.$sImg[1].'">
										<figcaption>'.$itemName.'</figcaption>
										</figure>';
							
									}
								
								$rssYaLenta .= $figures;
							
								}
						
								$pathtoimage = JPATH_ROOT .'/'. $Image;
			
								if (file_exists($pathtoimage)) {
									@$oneImg = getimagesize($pathtoimage); //Warning, if img delete
													
									$rssYaLenta .= '
									<figure>
									<img src="'.JURI::base().$Image.'" width="'.$oneImg[0].'" height="'.$oneImg[1].'">
									<figcaption>'.$itemName.'</figcaption>
									</figure>';
						
									$rssYaLenta .= ']]></content:encoded>
									';
								} 
							}
			
								if ($turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
			
								$rssYaLenta .= '<turbo:content><![CDATA[';
								
							
									if (!empty($figure[1])) {
										foreach ($figure[1] as $figureItem) {
									$figureItem = str_replace('"','', $figureItem);
								
											@$sImg = getimagesize($figureItem); //Warning, if img delete
											$figureItem = trim($figureItem);
								
											if (!strpos('http',$figureItem)) {
												$figureItem = JURI::base().$figureItem;
											}
								
											$figures .= '
											<header>
											<h1>'.$itemName.'</h1>
											<figure>
											<img src="'.$figureItem.'" width="'.$sImg[0].'" height="'.$sImg[1].'">
											<figcaption>'.$itemName.'</figcaption>
											</figure></header>';
								
										}
									
									$rssYaLenta .= $figures;
								
									}
							
									$pathtoimage = JPATH_ROOT .'/'. $Image;
				
									if (file_exists($pathtoimage)) {
										@$oneImg = getimagesize($pathtoimage); //Warning, if img delete
														
										$rssYaLenta .= '
										<header>
										<h1>'.$itemName.'</h1>
										<figure>
										<img src="'.JURI::base().$Image.'" width="'.$oneImg[0].'" height="'.$oneImg[1].'">
										<figcaption>'.$itemName.'</figcaption>
										</figure></header>';
									} 
										$rssYaLenta .= $FullDesc.']]></turbo:content>'."\n";
			
									}
			
			
									if (file_exists($pathtoimage)) {
										@$oneImg = getimagesize($pathtoimage); //Warning, if img delete
										$rssYaLenta .= "\n".'<enclosure url="'.JURI::base().$Image.'" type="'.$image_mime.'"/>';
									} 
			
									
									if ($figure) {
										if (!empty($figure[1]) && $figure[1]) {
			
										foreach ($figure[1] as $imageenc) {
											@$image_mimeecn = image_type_to_mime_type(exif_imagetype(JURI::base().$imageenc)); 
											$rssYaLenta .= "\n".'<enclosure url="'.JURI::base().$imageenc.'" type="'.$image_mimeecn.'"/>';
										}
										
										}
									}
			
			
									
									$rssYaLenta .= "\n".'</item>'."\n";
							
								}
			
					
							}

			
							}
						
						}
							// go ten type JBZoo
							
							if ($zenfeed_site_jbzoo_gen_on_10 == 1) {
							
							if ($zenfeed_site_jbzoo_category_nested == 1) {
								$zenfeed_site_jbzoo_category_nested = true;
							}
							else {
								$zenfeed_site_jbzoo_category_nested = false;
							}
							// JBZoo::init();
							$zoo = App::getInstance('zoo');
							$db = JFactory::getDBO();
							$doc = JFactory::getDocument();
							$appId = $zenfeed_site_jbzoo_app_alltypes_10;
							$ElmImage = $zenfeed_site_jbzoo_image_alltypes_10;
							$ElmDescPreview = $zenfeed_site_jbzoo_descpreview_alltypes_10;
							$ElmDescFull = $zenfeed_site_jbzoo_descfull_alltypes_10;
							$siteName = htmlspecialchars($zenfeed_sitename);
							$siteDesc = htmlspecialchars($zenfeed_sitedesc);
							$typeId = $zenfeed_site_jbzoo_type_alltypes_10; 
							$items = '';
							$all_items = array();
			
							$checkarraycatzoo = strpos($zenfeed_site_jbzoo_catid_alltypes_10,',');
							
							if ($checkarraycatzoo !== false)  {
								$massivcatzoo = explode(',',$zenfeed_site_jbzoo_catid_alltypes_10);
								$countmas = count($massivcatzoo);
			
								$options = array(
									'category_nested' => $zenfeed_site_jbzoo_category_nested_alltypes_10, 
									'limit' => array(0, $zenfeed_site_rss_limit), // offset и limit
									'user' => false, 
									'published' => 1,
									'order' => 'rdate'
								);
				
								
					
							for ($i=0; $i < $countmas; $i++) { 
			
								$yaCategoryModel = $zoo->table->category->get($massivcatzoo[$i]);
								$url = $zoo->route->category($yaCategoryModel);
								$items = JBModelItem::model()->getList($appId, $massivcatzoo[$i], $typeId, $options);
								$all_items[] = $items;
							}
			
				
							function cmp($a, $b){
								$ad = strtotime($a->created);
								$bd = strtotime($b->created);
								return ($bd-$ad);
							}
							
								$arrOut = array();
							
								foreach($all_items as $subArr) {
								$arrOut = array_merge($arrOut, $subArr);
								}
			
						
								usort($arrOut, 'cmp');
								
					
								$items = $arrOut;
			
						
							}
							else {
			
								$options = array(
									'category_nested' => $zenfeed_site_jbzoo_category_nested_alltypes_10, 
									'limit' => array(0, $zenfeed_site_rss_limit), // offset и limit
									'user' => false, 
									'published' => 1,
									'order' => 'rdate'
								);
								
								$yaCategoryModel = $zoo->table->category->get($zenfeed_site_jbzoo_catid_alltypes_10);
								$url = $zoo->route->category($yaCategoryModel);
								$items = JBModelItem::model()->getList($appId, $zenfeed_site_jbzoo_catid_alltypes_10, $typeId, $options);
							}
							
							if (!empty($items)) {
							$BeginrssYaLenta = '<?xml version="1.0" encoding="UTF-8"?>
							<rss version="2.0"
							xmlns:content="http://purl.org/rss/1.0/modules/content/"
							xmlns:dc="http://purl.org/dc/elements/1.1/"
							xmlns:media="http://search.yahoo.com/mrss/"
							xmlns:atom="http://www.w3.org/2005/Atom"
							xmlns:georss="http://www.georss.org/georss"';
							
							if ($turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {	$BeginrssYaLenta .= "\n".
							'				xmlns:yandex="http://news.yandex.ru" 
							xmlns:turbo="http://turbo.yandex.ru"';
							}
			
							$BeginrssYaLenta .= '>';
							$BeginrssYaLenta .= '
								<channel>
									<title>'.$siteName.'</title>
									<link>'.JURI::base().'</link>
									<description>'.$siteDesc.'</description>
									<language>'.$zenfeed_sitelang.'</language>'."";
									if ($zenfeed_site_jbzoo_turbo_li == 1 && $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
										$BeginrssYaLenta .= "\n".'<yandex:analytics type="LiveInternet"></yandex:analytics>';
									}
									if (!empty($zenfeed_site_jbzoo_turbo_yaid) && $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
										$BeginrssYaLenta .= "\n".'<yandex:analytics type="Yandex" id="'.$zenfeed_site_jbzoo_turbo_yaid.'"/>';
									}
									if (!empty($zenfeed_site_jbzoo_turbo_googleid) && $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
										$BeginrssYaLenta .= "\n".'<yandex:analytics id="'.$zenfeed_site_jbzoo_turbo_googleid.'" type="Google"></yandex:analytics>';
									}
									if (!empty($zenfeed_site_jbzoo_turbo_ya_rsya) && $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
										$BeginrssYaLenta .= "\n".'<yandex:adNetwork type="Yandex" id="'.$zenfeed_site_jbzoo_turbo_ya_rsya.'" turbo-ad-id="first_ad_place"></yandex:adNetwork>';
									}
							$items = array_slice($items, 0, (int)$zenfeed_site_rss_limit);		
							
					
							foreach ($items as $item) {
						
						
								$itemID = $item->id;
								$itemName = htmlspecialchars($item->name);
								$itemName = str_replace('«','&quot;',$itemName);
								$itemName = str_replace('»','&quot;',$itemName);
								$itemCreated = $item->created;
								$itemCreated = JHtml::_('date', $itemCreated, 'Y-m-d H:i:s', JFactory::getApplication()->getCfg('offset'), true);
								$itemAuthor = JFactory::getUser($item->created_by)->name;
								if (empty($itemAuthor) && $zenfeed_site_defauthor_set == '1' && $zenfeed_site_defauthor_set_fix == '0') {
									$itemAuthor = $zenfeed_site_defauthor;
								}
								if ($zenfeed_site_defauthor_set_fix == '1') {
									$itemAuthor = $zenfeed_site_defauthor;
								}
								$allCategories = $item->getRelatedCategories();
								$primaryId = $item->getPrimaryCategoryId();
								$resultcat = array();
								foreach($allCategories as $category) {
										$resultcat[] = '<category>'.$category->name.'</category>';
								}
							
								$allcatinitem = implode("\n",$resultcat);
								$itemUrl = $zoo->jbrouter->externalItem($item);
								$category = $item->getPrimaryCategory()->name;

								if (!empty($ElmDescPreview)) {
									$PreviewDesc = $item->getElement($ElmDescPreview)->data();
									$PreviewDescApp = $zoo->data->create($PreviewDesc);
								}
								else {
									$PreviewDesc = $item->getElement($ElmDescFull)->data();
									$PreviewDescApp = $zoo->data->create($FullDesc);
								}

								if ($zenfeed_site_jbzoo_descpreview_alltypes_gen_10 == 1) {
									$PreviewDesc = $item->getElement($ElmDescFull)->data();
									$PreviewDescApp = $zoo->data->create($FullDesc);
								}
								
								$FullDesc = $item->getElement($ElmDescFull)->data();
								$FullDescApp = $zoo->data->create($FullDesc);
								$figure = '';
								$figures = '';
								if ($zenfeed_images_path == 1) {
									$PreviewDesc = str_replace('src="images','src="/images',$PreviewDesc);
									$FullDesc = str_replace('src="images','src="/images',$FullDesc);
									$PreviewDesc = str_replace('//images/','/images/',$PreviewDesc);
									$FullDesc = str_replace('//images/','/images/',$FullDesc);
								}
								$PreviewDesc = htmlspecialchars(trim(strip_tags($PreviewDescApp->find('0.value'))));
								$PreviewDesc = str_replace('«','&quot;',$PreviewDesc);
								$PreviewDesc = str_replace('»','&quot;',$PreviewDesc);
								$PreviewDesc = str_replace('<br>','<br />',$PreviewDesc);
								$PreviewDesc = preg_replace("/\{.*?}/ius", "", $PreviewDesc);
								$FullDesc = trim($FullDescApp->find('0.value'));
								$FullDesc = preg_replace("/\{.*?}/ius", "", $FullDesc);
								
								$FullDesc = str_replace('«','&quot;',$FullDesc);
								$FullDesc = str_replace('»','&quot;',$FullDesc);
								$FullDesc = str_replace('&nbsp;',' ',$FullDesc);
								$FullDesc = str_replace(' style="text-align: justify;"','',$FullDesc);
								$FullDesc = str_replace('alt=""','',$FullDesc);
								$FullDesc = str_replace("title=''","",$FullDesc);
								preg_match_all("/<img.+?src=[\"'](.+?)[\"'].*?>/ius", $FullDesc, $figure);
								// $FullDesc = preg_replace("/<img[^>]+>/ius", "", $FullDesc);
								$FullDesc = str_replace('<p></p>','',$FullDesc);
								$FullDesc = str_replace('<br>','<br />',$FullDesc);
						
								if (($item->getElement($ElmImage)->data())) {
							
								$ElmImageData = $item->getElement($ElmImage)->data();
								$ElmImageApp = $zoo->data->create($ElmImageData);
								$Image = trim($ElmImageApp->find('0.file'));
			
								$pathtoimage = JPATH_ROOT .'/'. $Image;
			
								if (file_exists($pathtoimage)) {
									@$image_mime = image_type_to_mime_type(exif_imagetype($pathtoimage)); 
								}
						
			
								}
			
								if ($zenfeed_img_domain == 1) {
									$patt = '/<\s*img[^>]*src=[\"|\'](.*?)[\"|\'][^>]*\/*>/i';
									$FullMatchImg = preg_match_all($patt, $FullDesc, $matchFull);
									foreach ($matchFull[1] as $matchimage) {
										if (!strstr($matchimage,'http')) {
											$FullDesc = str_replace($matchimage, JURI::base().$matchimage, $FullDesc); // work
										}
									}
									$FullMatchImg = preg_match_all($patt, $PreviewDesc, $matchPreview);
									foreach ($matchPreview[1] as $matchimagesmall) {
										if (!strstr($matchimagesmall,'http')) {
											$PreviewDesc = str_replace($matchimagesmall, JURI::base().$matchimagesmall, $PreviewDesc); // work
										}
									}
								}
			
								if (!empty($FullDesc) || !empty($PreviewDesc)) {
							
									$rssYaLenta .= "\n";
									if ($turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) { $rssYaLenta .= '<item turbo="true">'; }
									else {
										$rssYaLenta .= '<item>';
									}
									$rssYaLenta .= "\n";
								$rssYaLenta .= '<title>'.$itemName.'</title>'."\n";
								$rssYaLenta .= '<link>'.$itemUrl.'</link>'."\n";
								$rssYaLenta .= '<guid>'.md5($itemUrl).'</guid>'."\n";
								$rssYaLenta .= '<pubDate>'.$itemCreated.' '.$zenfeed_site_time.'</pubDate>'."\n";
								$rssYaLenta .= '<media:rating scheme="urn:simple">nonadult</media:rating>'."\n";
								$rssYaLenta .= '<author>'.$itemAuthor.'</author>'."\n";
								
								$ImgesEnclos = $PreviewDesc . $FullDesc;
								preg_match_all('@src="([^"]+)"@', $ImgesEnclos, $matchesenc);
								if ($matchesenc) {
									if ($matchesenc[1] && !empty($matchesenc[1])) {
										foreach (array_unique($matchesenc[1]) as $imgenc) {
											if (strstr($imgenc,'http')) {
											$imgenc = str_replace(JURI::base().JURI::base(),JURI::base(),$imgenc);
											@$image_mimeecn = image_type_to_mime_type(exif_imagetype($imgenc)); 
											$rssYaLenta .= "\n".'<enclosure url="'.$imgenc.'" type="'.$image_mimeecn.'"/>'."\n";
											}
											else {
											
											@$image_mimeecn = image_type_to_mime_type(exif_imagetype(JURI::base().$imgenc)); 
											$rssYaLenta .= "\n".'<enclosure url="'.JURI::base().$imgenc.'" type="'.$image_mimeecn.'"/>'."\n";
											}
										}
									}
								}
			
								if ($zenfeed_cat_replace == '1' && $zenfeed_cat_replace_jbzoo == '0') {
			
								$checkarrayreplacecatname = strpos($zenfeed_cat_replace_catname,',');
									if ($checkarrayreplacecatname !== false) {
									$massivcatreplacename = explode(',',$zenfeed_cat_replace_catname);
									$countmascat = count($massivcatreplacename);
								}
			
								$offyandexcats = array (
									'Авто', 'Война', 'Дизайн', 'Дом', 'Еда', 'Здоровье', 'Знаменитости', 'Игры', 'Кино', 'Культура', 'Литература', 'Мода', 'Музыка', 'Наука', 'Общество', 'Политика', 'Природа', 'Происшествия', 'Психология', 'Путешествия', 'Спорт', 'Технологии', 'Фотографии', 'Хобби', 'Экономика', 'Юмор' 
								);
									foreach ($allCategories as $category) {
										if (!in_array($category->name, $offyandexcats)) {
			
											for ($i=0; $i < $countmascat; $i++) { 
												$rssYaLenta .= "\n".'<category>'.trim($massivcatreplacename[$i]).'</category>';
											}
			
										}
									}
								}
						
								if ($zenfeed_cat_replace == '1' && $zenfeed_cat_replace_jbzoo == '1' && !empty($zenfeed_cat_replace_jbzoo_element_checkbox_alltypes_10)) {
			
								$catforzenjbzoo = $item->getElement($zenfeed_cat_replace_jbzoo_element_checkbox_alltypes_10)->render();
						
								$massivcatreplacenamez = explode(',',$catforzenjbzoo);
								$countmascats = count($massivcatreplacenamez);
								if (!empty($massivcatreplacenamez)) {
								for ($i=0; $i < $countmascats; $i++) { 
										if (strlen($massivcatreplacenamez[$i]) > 3) {
											$rssYaLenta .= "\n".'<category>'.trim($massivcatreplacenamez[$i]).'</category>';
										}
									}
								}
						
								}
			
								if ($zenfeed_cat_replace == '0') {
									$rssYaLenta .= $allcatinitem;
								}
			
							
								if ( !empty($Image) && !empty($image_mime) && $zenfeed_site_jbzoo_turbo == 0 ) {
							
								$rssYaLenta .= "\n".'<enclosure url="'.JURI::base().$Image.'" type="'.$image_mime.'"/>';
							
								}
			
							
								if ($zenfeed_site_jbzoo_descpreview_descmini_10 == 0) {
									if ($zenfeed_site_jbzoo_descpreview_descmini_striptags_10 == 0) {
										$rssYaLenta .= '<description><![CDATA['.$PreviewDesc.']]></description>';
									}
									else {
										$rssYaLenta .= '<description><![CDATA['.strip_tags($PreviewDesc).']]></description>';
									}
									
									$rssYaLenta .= "\n";
								}
				
								if ($zenfeed_site_jbzoo_descpreview_descmini_10 == 1) {
									if ($zenfeed_site_jbzoo_descpreview_descmini_striptags_10 == 0) {
										$rssYaLenta .= '<description><![CDATA['.mb_substr($PreviewDesc, 0, $zenfeed_site_jbzoo_descpreview_descmini_count_10).']]></description>';
									}
									else {
										$rssYaLenta .= '<description><![CDATA['.strip_tags(mb_substr($PreviewDesc, 0, $zenfeed_site_jbzoo_descpreview_descmini_count_10)).']]></description>';
									}
				
									$rssYaLenta .= "\n";  
								}

								
								if ($turbopage != $zenfeed_site_pwdturbo) {
									
									$rssYaLenta .= '<content:encoded><![CDATA['.$FullDesc.'';
							
						
								if (!empty($figure[1])) {
									foreach ($figure[1] as $figureItem) {
								$figureItem = str_replace('"','', $figureItem);
							
										@$sImg = getimagesize($figureItem); //Warning, if img delete
										$figureItem = trim($figureItem);
							
										if (!strpos('http',$figureItem)) {
											$figureItem = JURI::base().$figureItem;
										}
							
										$figures .= '
										<figure>
										<img src="'.$figureItem.'" width="'.$sImg[0].'" height="'.$sImg[1].'">
										<figcaption>'.$itemName.'</figcaption>
										</figure>';
							
									}
								
								$rssYaLenta .= $figures;
							
								}
						
								$pathtoimage = JPATH_ROOT .'/'. $Image;
			
								if (file_exists($pathtoimage)) {
									@$oneImg = getimagesize($pathtoimage); //Warning, if img delete
													
									$rssYaLenta .= '
									<figure>
									<img src="'.JURI::base().$Image.'" width="'.$oneImg[0].'" height="'.$oneImg[1].'">
									<figcaption>'.$itemName.'</figcaption>
									</figure>';
						
									$rssYaLenta .= ']]></content:encoded>
									';
								} 
							}
			
								if ($turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
			
								$rssYaLenta .= '<turbo:content><![CDATA[';
								
							
									if (!empty($figure[1])) {
										foreach ($figure[1] as $figureItem) {
									$figureItem = str_replace('"','', $figureItem);
								
											@$sImg = getimagesize($figureItem); //Warning, if img delete
											$figureItem = trim($figureItem);
								
											if (!strpos('http',$figureItem)) {
												$figureItem = JURI::base().$figureItem;
											}
								
											$figures .= '
											<header>
											<h1>'.$itemName.'</h1>
											<figure>
											<img src="'.$figureItem.'" width="'.$sImg[0].'" height="'.$sImg[1].'">
											<figcaption>'.$itemName.'</figcaption>
											</figure></header>';
								
										}
									
									$rssYaLenta .= $figures;
								
									}
							
									$pathtoimage = JPATH_ROOT .'/'. $Image;
				
									if (file_exists($pathtoimage)) {
										@$oneImg = getimagesize($pathtoimage); //Warning, if img delete
														
										$rssYaLenta .= '
										<header>
										<h1>'.$itemName.'</h1>
										<figure>
										<img src="'.JURI::base().$Image.'" width="'.$oneImg[0].'" height="'.$oneImg[1].'">
										<figcaption>'.$itemName.'</figcaption>
										</figure></header>';
									} 
										$rssYaLenta .= $FullDesc.']]></turbo:content>'."\n";
			
									}
			
			
									if (file_exists($pathtoimage)) {
										@$oneImg = getimagesize($pathtoimage); //Warning, if img delete
										$rssYaLenta .= "\n".'<enclosure url="'.JURI::base().$Image.'" type="'.$image_mime.'"/>';
									} 
			
									
									if ($figure) {
										if (!empty($figure[1]) && $figure[1]) {
			
										foreach ($figure[1] as $imageenc) {
											@$image_mimeecn = image_type_to_mime_type(exif_imagetype(JURI::base().$imageenc)); 
											$rssYaLenta .= "\n".'<enclosure url="'.JURI::base().$imageenc.'" type="'.$image_mimeecn.'"/>';
										}
										
										}
									}
			
			
									
									$rssYaLenta .= "\n".'</item>'."\n";
							
								}
			
					
							}

			
							}
						
						}
																				
					$EndrssYaLenta = '</channel></rss>';
						
					$AllTypesFeed = $BeginrssYaLenta.$rssYaLenta.$EndrssYaLenta;
						
					if ($turbopage == $zenfeed_site_pwdturbo) {
							$cache->store($AllTypesFeed, 'rssfeedforyandexzen');
					}
			
					if ($zenpage == $zenfeed_site_pwd_zen) {
							$cache->store($AllTypesFeed, 'rssfeedforyandexzenpage');
					}
							
					if ($zenfeed_xmlfeed == 1) {
						header('Content-type: text/xml; charset=utf-8');
						header('Content-Disposition: inline'); 
						echo trim($AllTypesFeed);
						exit;
					}
					else {
						return trim($AllTypesFeed);
					}

				}
						else {
							
							if ( $turbopage == $zenfeed_site_pwdturbo) {
								if ($zenfeed_xmlfeed == 1) {
									echo $cache->get('rssfeedforyandexzen');
									exit;
								}
								else {
									return $cache->get('rssfeedforyandexzen');
								}
							}
			
							if ( $zenpage == $zenfeed_site_pwd_zen) {
								if ($zenfeed_xmlfeed == 1) {
									echo $cache->get('rssfeedforyandexzenpage');
									exit;
								}
								else {
									return $cache->get('rssfeedforyandexzenpage');
								}
							}
						}
					}

					if ($zenfeed_who == '4') {

						// joomshopping
						// randompage
						// TODO FIX
	
						if (((!$rssYaLenta = $cache->get('rssfeedforyandexzen')) && $turbopage == $zenfeed_site_pwdturbo) || ((!$rssYaLenta = $cache->get('rssfeedforyandexzenpage')) && $zenpage == $zenfeed_site_pwd_zen))
				
						{
								
							$siteName = htmlspecialchars($zenfeed_sitename);
							$siteDesc = htmlspecialchars($zenfeed_sitedesc);
					
							$checkarraycatcontent = strpos($zenfeed_com_content_catid,',');
						
					
							if (!file_exists(JPATH_SITE.'/components/com_jshopping/jshopping.php')){
								JError::raiseError(500,"Please install component \"joomshopping\"");
							} 
							
							require_once (JPATH_SITE.'/components/com_jshopping/lib/factory.php'); 
							require_once (JPATH_SITE.'/components/com_jshopping/lib/functions.php');        

							$jshopConfig = JSFactory::getConfig();
							
							$product = JTable::getInstance('product', 'jshop');
							
							$cat_str = $zenfeed_site_jsh_catid;

							if (is_array($cat_str)) {    
								$cat_arr = array();
								foreach($cat_str as $key=>$curr){
								   if (intval($curr)) $cat_arr[$key] = intval($curr);
								}  
							} else {
								$cat_arr = array();
								if (intval($cat_str)) $cat_arr[] = intval($cat_str);
							}

							$last_prod = $product->getLastProducts($zenfeed_site_rss_limit, $cat_arr);  
					
							foreach($last_prod as $key=>$value){
								$last_prod[$key]->product_link = SEFLink('index.php?option=com_jshopping&controller=product&task=view&category_id='.$value->category_id.'&product_id='.$value->product_id, 1);
							}


							$items = $last_prod;
							
							// dump($items,1,'items');

							if (!empty($items)) {
								$rssYaLenta = '<?xml version="1.0" encoding="UTF-8"?>
								<rss version="2.0"
								xmlns:content="http://purl.org/rss/1.0/modules/content/"
								xmlns:dc="http://purl.org/dc/elements/1.1/"
								xmlns:media="http://search.yahoo.com/mrss/"
								xmlns:atom="http://www.w3.org/2005/Atom"
								xmlns:georss="http://www.georss.org/georss"';
				
								if ($turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {	$rssYaLenta .= "\n".
									'				xmlns:yandex="http://news.yandex.ru" 
								xmlns:turbo="http://turbo.yandex.ru"';
									}
				
								$rssYaLenta .= '>';
								$rssYaLenta .= '
									<channel>
										<title>'.$siteName.'</title>
										<link>'.JURI::base().'</link>
										<description>'.$siteDesc.'</description>
										<language>'.$zenfeed_sitelang.'</language>'."";
										if ($zenfeed_site_jbzoo_turbo_li == 1 && $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
											$rssYaLenta .= "\n".'<yandex:analytics type="LiveInternet"></yandex:analytics>';
										}
										if (!empty($zenfeed_site_jbzoo_turbo_yaid) && $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
											$rssYaLenta .= "\n".'<yandex:analytics type="Yandex" id="'.$zenfeed_site_jbzoo_turbo_yaid.'"/>';
										}
										if (!empty($zenfeed_site_jbzoo_turbo_googleid) && $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
											$rssYaLenta .= "\n".'<yandex:analytics id="'.$zenfeed_site_jbzoo_turbo_googleid.'" type="Google"></yandex:analytics>';
										}
										if (!empty($zenfeed_site_jbzoo_turbo_ya_rsya) && $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
											$rssYaLenta .= "\n".'<yandex:adNetwork type="Yandex" id="'.$zenfeed_site_jbzoo_turbo_ya_rsya.'" turbo-ad-id="first_ad_place"></yandex:adNetwork>';
										}
										if (!empty($zenfeed_site_jbzoo_turbo_ya_rsya2) && $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
											$rssYaLenta .= "\n".'<yandex:adNetwork type="Yandex" id="'.$zenfeed_site_jbzoo_turbo_ya_rsya2.'" turbo-ad-id="second_ad_place"></yandex:adNetwork>';
										}
										if (!empty($zenfeed_site_jbzoo_turbo_ya_rsya3) && $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
											$rssYaLenta .= "\n".'<yandex:adNetwork type="Yandex" id="'.$zenfeed_site_jbzoo_turbo_ya_rsya3.'" turbo-ad-id="third_ad_place"></yandex:adNetwork>';
										}
										if (!empty($zenfeed_site_jbzoo_turbo_ad_fox) && !empty($zenfeed_site_jbzoo_turbo_ad_fox_container) &&  $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
											$rssYaLenta .= "\n"."<yandex:adNetwork
											type='AdFox'
											turbo-ad-id='before_first_ad_fox_place'>
											   <![CDATA[
												   <div id='".$zenfeed_site_jbzoo_turbo_ad_fox_container."'></div>
												   <script>
													   window.Ya.adfoxCode.create({
														   ownerId: ".$zenfeed_site_jbzoo_turbo_ad_fox.",
														   containerId: '".$zenfeed_site_jbzoo_turbo_ad_fox_container."',
														   params: {
															   pp: 'g',
															   ps: 'cmic',
															   p2: 'fqem'
														   }
													   });
												   </script>
											   ]]>
										   </yandex:adNetwork>";
										}
				
						
								$items = array_slice($items, 0, (int)$zenfeed_site_rss_limit);
								
								$filtertags = explode(',',$zenfeed_com_content_filterstriptags);
								foreach($filtertags as $ftags) {
									$Infiltertags .= '<'.$ftags.'>';
								}
								
								// $Infiltertags = substr($Infiltertags,0,-1);
				
								foreach ($items as $item) {
				
									$itemID = $item->product_id;
									$itemName = htmlspecialchars($item->name);
									$itemName = str_replace('«','&quot;',$itemName);
									$itemName = str_replace('»','&quot;',$itemName);
									$itemCreated = $item->product_date_added;
									$itemCreatedMod = $item->date_modify;
									$itemprice = $item->product_price;
									$itemCreated = JHtml::_('date', $itemCreated, 'Y-m-d H:i:s', JFactory::getApplication()->getCfg('offset'), true);
									$itemAuthor = $zenfeed_site_jsh_author;
									if (empty($itemAuthor) && $zenfeed_site_defauthor_set == '1' && 
									$zenfeed_site_defauthor_set_fix == '0') {
										$itemAuthor = $zenfeed_site_defauthor;
									}
									if ($zenfeed_site_defauthor_set_fix == '1') {
										$itemAuthor = $zenfeed_site_defauthor;
									}
									
									$smallfoto = $item->image;
									$fullfoto = str_replace('thumb_','',$smallfoto);



									$category = $item->cat_name;
									$rootURL = rtrim(JURI::base(),'/');
									$subpathURL = JURI::base(true);
									if(!empty($subpathURL) && ($subpathURL != '/')) {
										$rootURL = substr($rootURL, 0, -1 * strlen($subpathURL));
									}
				
									if (!empty($smallfoto)) {
										unset($jsh_arr_foto);
										unset($jsh_img_arr_foto);
										$jsh_arr_foto = array();

										$db = JFactory::getDbo();     
										$query = $db->getQuery(true);
										$query = "SELECT `image_name` " . " FROM " . " `#__jshopping_products_images` WHERE product_id = ".(int)$itemID."";
										$db->setQuery($query);    
										$fullfotoobj = $db->loadObjectList();

										foreach ($fullfotoobj as $key => $jsh_image) {
											$jsh_arr_foto[] = $rootURL.$zenfeed_site_jsh_img_path.$jsh_image->image_name;
											$jsh_img_arr_foto[] = '<img src="'.$rootURL.$zenfeed_site_jsh_img_path.$jsh_image->image_name.'"> ';
										}

									}

									$itemUrl = $rootURL.$item->product_link;
				
									$PreviewDesc = $item->short_description;
									$FullDesc = $item->full_description; 
									$figure = '';
									$figures = '';
									$figureintext = '';
							
									if ($zenfeed_images_path == 1) {
										$PreviewDesc = str_replace('src="images','src="/images',$PreviewDesc);
										$FullDesc = str_replace('src="images','src="/images',$FullDesc);
										$PreviewDesc = str_replace('//images/','/images/',$PreviewDesc);
										$FullDesc = str_replace('//images/','/images/',$FullDesc);
									}
				
									if ($zenfeed_comcontent_pre == 1) {
				
									$PreviewDesc = preg_replace('/<pre.*<\/pre>/ui', $zenfeed_comcontent_pre_text, $PreviewDesc);
				
									$FullDesc = preg_replace('/<pre.*<\/pre>/ui', $zenfeed_comcontent_pre_text, $FullDesc);
										
									}
				
									if ($zenfeed_global_classes == 1) {
										if (!empty($zenfeed_global_classes_textarea)) {
											$regexplist = explode(PHP_EOL,trim($zenfeed_global_classes_textarea));
											if (!empty($regexplist[0])) {
												for ($i=0; $i < count($regexplist); $i++) { 
													$PreviewDesc = preg_replace("#{$regexplist[$i]}#", "", $PreviewDesc);
												    $FullDesc = preg_replace("#{$regexplist[$i]}#", "", $FullDesc);
												}
											}
										}
									}

									if ($zenfeed_global_youtube == 1) {
										
										$PreviewDesc = preg_replace("/(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:watch\?(?:[\w-=&]*&)?v=|(?:|v)\/))([\w-]+)[\w-=&#;]*/", "<iframe allowfullscreen frameborder='0' height='315' src='https://www.youtube.com/embed/$1'; width='560'></iframe>", $PreviewDesc);

										$FullDesc = preg_replace("/(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:watch\?(?:[\w-=&]*&)?v=|(?:|v)\/))([\w-]+)[\w-=&#;]*/", "<iframe allowfullscreen frameborder='0' height='315' src='https://www.youtube.com/embed/$1'; width='560'></iframe>", $FullDesc);
											
									}

									
									if ($zenfeed_global_squarebrackets == 1) {
										$PreviewDesc = preg_replace('/\[(.+?)\].+\[\/(.+?)\]/', '', $PreviewDesc);
										$FullDesc = preg_replace('/\[(.+?)\].+\[\/(.+?)\]/', '', $FullDesc);
									}
									
									if ($zenfeed_comcontent_striptags == 1) {
										$PreviewDesc = trim(strip_tags($PreviewDesc, $Infiltertags));
									}
				
									if ($zenfeed_comcontent_biem == 1 && $zenfeed_comcontent_striptags == 0) {
										
									$PreviewDesc = str_replace('<b>','',$PreviewDesc);
									$PreviewDesc = str_replace('</b>','',$PreviewDesc);
										
									$PreviewDesc = str_replace('<i>','',$PreviewDesc);
									$PreviewDesc = str_replace('</i>','',$PreviewDesc);
										
									$PreviewDesc = str_replace('<strong>','',$PreviewDesc);
									$PreviewDesc = str_replace('</strong>','',$PreviewDesc);
										
									$PreviewDesc = str_replace('<em>','',$PreviewDesc);
									$PreviewDesc = str_replace('</em>','',$PreviewDesc);
				
									}
				
									$PreviewDesc = str_replace('«','&quot;',$PreviewDesc);
									$PreviewDesc = str_replace('»','&quot;',$PreviewDesc);
									$PreviewDesc = str_replace('<br>','<br />',$PreviewDesc);
									$PreviewDesc = preg_replace('/<p(?:([\'"]).*?\1|.)*?>/ui', '<p>', $PreviewDesc);
									$PreviewDesc = preg_replace("/\{.*?}/ius", "", $PreviewDesc);
				
									if ($zenfeed_delete_noturbotag == 1) {
										$PreviewDesc = preg_replace("/<noturbo>.*?<\/noturbo>/ius", "", $PreviewDesc);
									}
				
									preg_match_all('@src="([^"]+)"@' , $FullDesc, $figureintext );
				
									if ($zenfeed_comcontent_striptags == 1) {
				
										$FullDesc = trim(strip_tags($FullDesc, $Infiltertags));
										$FullDesc = str_replace('«','&quot;',$FullDesc);
										$FullDesc = str_replace('»','&quot;',$FullDesc);
										$FullDesc = str_replace('&nbsp;',' ',$FullDesc);
										$FullDesc = preg_replace('/<p(?:([\'"]).*?\1|.)*?>/ui', '<p>', $FullDesc);
										$FullDesc = str_replace('alt=""','',$FullDesc);
										$FullDesc = str_replace("title=''","",$FullDesc);
										// $FullDesc = preg_replace("/<img[^>]+>/ius", "", $FullDesc);
										// $FullDesc = str_replace('<p></p>','',$FullDesc);
										// $FullDesc = str_replace('<br>','<br />',$FullDesc);
									}
				
				
									if ($zenfeed_comcontent_biem == 1 && $zenfeed_comcontent_striptags == 0) {
				
									$FullDesc = str_replace('<b>','',$FullDesc);
									$FullDesc = str_replace('</b>','',$FullDesc);
										
									$FullDesc = str_replace('<i>','',$FullDesc);
									$FullDesc = str_replace('</i>','',$FullDesc);
										
									$FullDesc = str_replace('<strong>','',$FullDesc);
									$FullDesc = str_replace('</strong>','',$FullDesc);
										
									$FullDesc = str_replace('<em>','',$FullDesc);
									$FullDesc = str_replace('</em>','',$FullDesc);
				
									}
				
									$FullDesc = str_replace('«','&quot;',$FullDesc);
									$FullDesc = str_replace('»','&quot;',$FullDesc);
									$FullDesc = str_replace('<br>','<br />',$FullDesc);
				
									
									$FullDesc = preg_replace("/\{.*?}/ius", "", $FullDesc);
								
									if ($zenfeed_delete_noturbotag == 1) {
										$FullDesc = preg_replace("/<noturbo>.*?<\/noturbo>/ius", "", $FullDesc);
									}
				
									if ($zenfeed_img_domain == 1) {
										$patt = '/<\s*img[^>]*src=[\"|\'](.*?)[\"|\'][^>]*\/*>/i';
										$FullMatchImg = preg_match_all($patt, $FullDesc, $matchFull);
										foreach ($matchFull[1] as $matchimage) {
											if (!strstr($matchimage,'http')) {
												$FullDesc = str_replace($matchimage, JURI::base().$matchimage, $FullDesc); // work
											}
										}
										$FullMatchImg = preg_match_all($patt, $PreviewDesc, $matchPreview);
										foreach ($matchPreview[1] as $matchimagesmall) {
											if (!strstr($matchimagesmall,'http')) {
												$PreviewDesc = str_replace($matchimagesmall, JURI::base().$matchimagesmall, $PreviewDesc); // work
											}
										}
									}
				
									
									if (!empty($FullDesc) || !empty($PreviewDesc)) {
								
										$rssYaLenta .= "\n";
										if ($turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) { $rssYaLenta .= '<item turbo="true">'; }
										else {
											$rssYaLenta .= '<item>';
										}
										$rssYaLenta .= "\n";
										$rssYaLenta .= '<title>'.$itemName.'</title>';
										$rssYaLenta .= "\n";
										$rssYaLenta .= '<link>'.$itemUrl.'</link>';
										$rssYaLenta .= "\n";
										$rssYaLenta .= '<guid>'.md5($itemUrl).'</guid>';
										$rssYaLenta .= "\n";
										$rssYaLenta .= '<pubDate>'.$itemCreated.' '.$zenfeed_site_time.'</pubDate>';
										$rssYaLenta .= "\n";
										$rssYaLenta .= '<media:rating scheme="urn:simple">nonadult</media:rating>';
										$rssYaLenta .= "\n";
										$rssYaLenta .= '<author>'.$itemAuthor.'</author>';
										$rssYaLenta .= "\n";
				
										$ImgesEnclos = $PreviewDesc . $FullDesc . implode($jsh_img_arr_foto,'');
										
										preg_match_all('@src="([^"]+)"@', $ImgesEnclos, $matchesenc);
										if ($matchesenc) {
											
											if ($matchesenc[1] && !empty($matchesenc[1])) {
												foreach (array_unique($matchesenc[1]) as $imgenc) {
													if (strstr($imgenc,'http')) {
													$imgenc = str_replace(JURI::base().JURI::base(),JURI::base(),$imgenc);
													@$image_mimeecn = image_type_to_mime_type(exif_imagetype($imgenc)); 
													
													if ($zenfeed_images_path == 1) {
														$imgenc = str_replace('//images/','/images/',$imgenc);
													}
				
													$rssYaLenta .= "\n".'<enclosure url="'.$imgenc.'" type="'.$image_mimeecn.'"/>'."\n";
													}
													else {
													
													@$image_mimeecn = image_type_to_mime_type(exif_imagetype(JURI::base().$imgenc)); 
				
													if ($zenfeed_images_path == 1) {
														$imgenc = str_replace('//images/','images/',$imgenc);
														$imgenc = str_replace('/images/','images/',$imgenc);
													}
													
													$rssYaLenta .= "\n".'<enclosure url="'.JURI::base().$imgenc.'" type="'.$image_mimeecn.'"/>'."\n";
													}
												}
											}
										}
										
									if ($zenfeed_cat_replace == '1') {
				
									$checkarrayreplacecatname = strpos($zenfeed_cat_replace_catname,',');
									if ($checkarrayreplacecatname !== false) {
										$massivcatreplacename = explode(',',$zenfeed_cat_replace_catname);
										$countmascat = count($massivcatreplacename);
									}
				
							
									$offyandexcats = array (
										'Авто', 'Война', 'Дизайн', 'Дом', 'Еда', 'Здоровье', 'Знаменитости', 'Игры', 'Кино', 'Культура', 'Литература', 'Мода', 'Музыка', 'Наука', 'Общество', 'Политика', 'Природа', 'Происшествия', 'Психология', 'Путешествия', 'Спорт', 'Технологии', 'Фотографии', 'Хобби', 'Экономика', 'Юмор' 
									);
				
							
									for ($i=0; $i < $countmascat; $i++) { 
													$rssYaLenta .= '<category>'.trim($massivcatreplacename[$i]).'</category>';
													$rssYaLenta .= "\n";
									}
				
							
										
									}
									else {
										$rssYaLenta .= '<category>'.$category.'</category>';
										$rssYaLenta .= "\n";
									}

									if ($zenfeed_site_jsh_price_beforetext == 1) {
										$PreviewDesc = '<' . $zenfeed_site_jsh_price_text_tag . '>' .$zenfeed_site_jsh_price_text . $itemprice . '</' . $zenfeed_site_jsh_price_text_tag . '>' . "\n" . ' ' . $PreviewDesc;
								}
										
								if ($zenfeed_site_jsh_intropreview == 1) {
									$PreviewDesc = "\n" . '<img src="'.$smallfoto.'" /> '.$PreviewDesc;
								}

									if ($zenfeed_site_jsh_descmini == 0) {
										if ($zenfeed_site_jsh_descmini_striptags == 0) {
											$rssYaLenta .= '<description><![CDATA['.$PreviewDesc.']]></description>';
										}
										else {
											$rssYaLenta .= '<description><![CDATA['.strip_tags($PreviewDesc).']]></description>';
										}
										
										$rssYaLenta .= "\n";
									}
					
									if ($zenfeed_site_jsh_descmini == 1) {
										if ($zenfeed_site_jsh_descmini_striptags == 0) {
											$rssYaLenta .= '<description><![CDATA['.mb_substr($PreviewDesc, 0, $zenfeed_site_jsh_descmini_count).']]></description>';
										}
										else {
											$rssYaLenta .= '<description><![CDATA['.strip_tags(mb_substr($PreviewDesc, 0, $zenfeed_site_jsh_descmini_count)).']]></description>';
										}
					
										$rssYaLenta .= "\n"; // 
									}
		
				
										if (empty($FullDesc)) {
											$FullDesc = $PreviewDesc;
										}
				
										if ($zenfeed_site_jsh_introtofull == 1 && $zenfeed_site_snippet_center == 0) {
											$FullDesc = $PreviewDesc . $FullDesc;
										}
										
			
										if ($zenfeed_comcontent_introtofull == 1 && $zenfeed_site_snippet_center == 1 && empty($zenfeed_site_jbzoo_turbo_ya_rsya2) && $turbopage != $zenfeed_site_pwdturb) {
											$FullDesc = $PreviewDesc . "\n" . trim($zenfeed_site_snippet_center_text) . "\n" . $FullDesc;
										}
										
				
										if ($zenfeed_comcontent_introtofull == 1 && $zenfeed_site_snippet_center == 1 && !empty($zenfeed_site_jbzoo_turbo_ya_rsya2) && $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
											$FullDesc = $PreviewDesc . "\n" . trim($zenfeed_site_snippet_center_text) . "\n" .' <figure data-turbo-ad-id="second_ad_place"></figure> ' . $FullDesc;
										}
				
				
										if ($zenfeed_site_jsh_introsmallimg == 1) {
											$FullDesc = $FullDesc;
										}
				
										
				
						if ($turbopage != $zenfeed_site_pwdturbo) {
											
															
										$rssYaLenta .= '<content:encoded><![CDATA['.$FullDesc.'';
										$rssYaLenta .= "\n";
									
						
				
								if ($zenfeed_comcontent_introimage == 1) {
									
									if ($item->images && !empty($item->images)) {
										if (!empty($item->images)) {
											$inarticlesformimg = json_decode($item->images);
											$image_intro = $inarticlesformimg->image_intro;
											$image_intro_alt = $inarticlesformimg->image_intro_alt;
				
											@$sImg = getimagesize(JURI::base().$image_intro); //Warning, if img delete		
											@$oneImg = getimagesize(JURI::base().$image_intro); //Warning, if img delete
				
											if ($zenfeed_comcontent_fullimage == 1) {
											$image_fulltext = $inarticlesformimg->image_fulltext;
											$image_fulltext_alt = $inarticlesformimg->image_fulltext_alt;
				
											@$stImg = getimagesize(JURI::base().$image_fulltext); //Warning, if img delete		
											@$TwoImg = getimagesize(JURI::base().$image_fulltext); //Warning, if img delete
				
											}
										}
									}
								}
				
						if ($zenfeed_comcontent_imagetotopplease == 1) {	
							
									if ($item->images && !empty($item->images) && !empty($oneImg[0])) {
									
										if (!empty($image_intro_alt)) {
											$figcapt = $image_intro_alt;
										}
										else {
											$figcapt = $itemName;
										}
				
								
								$rssYaLenta .= '
											<figure>
											<img src="'.JURI::base().$image_intro.'" width="'.$oneImg[0].'" height="'.$oneImg[1].'">
											<figcaption>'.$figcapt.'</figcaption>
											</figure>';
									}
				
							
									if ($item->images && !empty($item->images) && $image_intro != $image_fulltext && !empty($TwoImg[0])) {
				
										if (!empty($image_fulltext_alt)) {
											$figcapt = $image_fulltext_alt;
										}
										else {
											$figcapt = $itemName;
										}
				
								
								$rssYaLenta .= '
											<figure>
											<img src="'.JURI::base().$image_fulltext.'" width="'.$TwoImg[0].'" height="'.$TwoImg[1].'">
											<figcaption>'.$figcapt.'</figcaption>
											</figure>';
									}
						}
				
							
							
									$rssYaLenta .= ']]>';
									$rssYaLenta .= "\n";
									$rssYaLenta .= '</content:encoded>';
									$rssYaLenta .= "\n";
				
				}
				
				
				
				if ($turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
				
									$rssYaLenta .= '<turbo:content><![CDATA[';
									$rssYaLenta .= "\n";
								
							if ($zenfeed_site_snippet_top == 1 && !empty($zenfeed_site_snippet_top_text)) {
								$rssYaLenta .= trim($zenfeed_site_snippet_top_text) . "\n";
							}
										
			if (!empty($zenfeed_site_jbzoo_turbo_ya_rsya) && $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
				$rssYaLenta .= "\n".' <figure data-turbo-ad-id="first_ad_place"></figure> ' . "\n";
			}
			
									if ($zenfeed_comcontent_introimage == 1) {
										
										if ($item->images && !empty($item->images)) {
											if (!empty($item->images)) {
												$inarticlesformimg = json_decode($item->images);
												$image_intro = $inarticlesformimg->image_intro;
												$image_intro_alt = $inarticlesformimg->image_intro_alt;
					
												@$sImg = getimagesize(JURI::base().$image_intro); //Warning, if img delete		
												@$oneImg = getimagesize(JURI::base().$image_intro); //Warning, if img delete
					
												if ($zenfeed_comcontent_fullimage == 1) {
												$image_fulltext = $inarticlesformimg->image_fulltext;
												$image_fulltext_alt = $inarticlesformimg->image_fulltext_alt;
					
												@$stImg = getimagesize(JURI::base().$image_fulltext); //Warning, if img delete		
												@$TwoImg = getimagesize(JURI::base().$image_fulltext); //Warning, if img delete
					
												}
											}
										}
									}
				
						
								if ($item->images && !empty($item->images) && !empty($oneImg[0])) {
								
									if (!empty($image_intro_alt)) {
										$figcapt = $image_intro_alt;
									}
									else {
										$figcapt = $itemName;
									}
				
							
							$rssYaLenta .= '
										<header>
										<h1>'.$itemName.'</h1>
										<figure>
										<img src="'.JURI::base().$image_intro.'" width="'.$oneImg[0].'" height="'.$oneImg[1].'">
										<figcaption>'.$figcapt.'</figcaption>
										</figure>
										</header>';
								}
								
						if ($zenfeed_comcontent_imagetotopplease == 1) {	
								if ($item->images && !empty($item->images) && $image_intro != $image_fulltext && !empty($TwoImg[0])) {
				
									if (!empty($image_fulltext_alt)) {
										$figcapt = $image_fulltext_alt;
									}
									else {
										$figcapt = $itemName;
									}
				
										$rssYaLenta .= '
										<header>
										<h1>'.$itemName.'</h1>
										<figure>
										<img src="'.JURI::base().$image_fulltext.'" width="'.$TwoImg[0].'" height="'.$TwoImg[1].'">
										<figcaption>'.$figcapt.'</figcaption>
										</figure>
										</header>';
								}
								else  {
				
									if ($zenfeed_comcontent_previmage == 1) {
									preg_match('@src="([^"]+)"@' , $PreviewDesc, $figureintextprev );
				
									$mainimg = $figureintextprev[1];
				
									if (!empty($mainimg) && strlen($mainimg) > 5 && NULL !== $mainimg) {
									$figcapt = $itemName;
									
									@$InImg = getimagesize(JURI::base().$mainimg); //Warning, if img delete	
				
									$rssYaLenta .= '
									<header>
									<h1>'.$itemName.'</h1>
									<figure>
									<img src="'.$mainimg.'">
									<figcaption>'.$figcapt.'</figcaption>
									</figure>
									</header>';
				
										}
									}
								}
						}
				
				
		if ($zenfeed_comcontent_introtofull == 0 && $zenfeed_site_snippet_center == 1 && !empty($zenfeed_site_jbzoo_turbo_ya_rsya2) && $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
			$rssYaLenta .= "\n" .' <figure data-turbo-ad-id="second_ad_place"></figure> ' . "\n";
		}

								$rssYaLenta .= $FullDesc;
											
							if ($zenfeed_site_snippet_bottom == 1 && !empty($zenfeed_site_snippet_bottom_text)) {
								$rssYaLenta .= "\n" . trim($zenfeed_site_snippet_bottom_text) . "\n";
							}
								
						
			if (!empty($zenfeed_site_jbzoo_turbo_ya_rsya3) && $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
				$rssYaLenta .= "\n".' <figure data-turbo-ad-id="third_ad_place"></figure> ' . "\n";
			}


			if ($zenfeed_site_jsh_img_gallery == 1) {

				if ($matchesenc) {

					$rssYaLenta .= "\n" . '<div data-block="gallery"><header>Галерея изображений</header>';

						if ($matchesenc[1] && !empty($matchesenc[1])) {
							foreach (array_unique($matchesenc[1]) as $imgenc) {
								if (strstr($imgenc,'http')) {
								$imgenc = str_replace(JURI::base().JURI::base(),JURI::base(),$imgenc);
								@$image_mimeecn = image_type_to_mime_type(exif_imagetype($imgenc)); 
								
								if ($zenfeed_images_path == 1) {
									$imgenc = str_replace('//images/','/images/',$imgenc);
								}



								$rssYaLenta .= '<img src="'.$imgenc.'"/>';

								}

								else {
								
								@$image_mimeecn = image_type_to_mime_type(exif_imagetype(JURI::base().$imgenc)); 

								if ($zenfeed_images_path == 1) {
									$imgenc = str_replace('//images/','images/',$imgenc);
									$imgenc = str_replace('/images/','images/',$imgenc);
								}
								


								$rssYaLenta .= '<img src="'.$imgenc.'"/>';


								}
							}
						}

						$rssYaLenta .= '</div>';

					}
					
			}
			

											
								$rssYaLenta .= ']]>';
								$rssYaLenta .= "\n";
								$rssYaLenta .= '</turbo:content>';
				
								
										}
				
									if ($figure) {
										if (!empty($figure[1]) && $figure[1]) {
				
											foreach ($figure[1] as $imageenc) {
												@$image_mimeecn = image_type_to_mime_type(exif_imagetype(JURI::base().$imageenc)); 
												$rssYaLenta .= "\n".'<enclosure url="'.JURI::base().$imageenc.'" type="'.$image_mimeecn.'"/>';
											}
											
				
										}
									}
				


										
										$rssYaLenta .= "\n".'</item>'."\n";
				
										
									}
								}
								
						
								$rssYaLenta .= '</channel></rss>';
								
						
						if ($turbopage == $zenfeed_site_pwdturbo) {
								$cache->store($rssYaLenta, 'rssfeedforyandexzen');
						}
				
						if ($zenpage == $zenfeed_site_pwd_zen) {
								$cache->store($rssYaLenta, 'rssfeedforyandexzenpage');
						}
				
						if ($zenfeed_xmlfeed == 1) {
							header('Content-type: text/xml; charset=utf-8');
							header('Content-Disposition: inline'); 
							echo trim($rssYaLenta);
							exit;
						}
						else {
							return trim($rssYaLenta);
						}
				
								}
							
							}
							else {
								
								if ( $turbopage == $zenfeed_site_pwdturbo) {
									if ($zenfeed_xmlfeed == 1) {
										echo $cache->get('rssfeedforyandexzen');
										exit;
									}
									else {
										return $cache->get('rssfeedforyandexzen');
									}
								}
				
								if ( $zenpage == $zenfeed_site_pwd_zen) {
									if ($zenfeed_xmlfeed == 1) {
										echo $cache->get('rssfeedforyandexzenpage');
										exit;
									}
									else {
										return $cache->get('rssfeedforyandexzenpage');
									}
								}
							}
				
						}

						if ($zenfeed_who == '5') {

							//Virtuemart
							//randompage
							//TODO FIX 
	
							if (((!$rssYaLenta = $cache->get('rssfeedforyandexzen')) && $turbopage == $zenfeed_site_pwdturbo) || ((!$rssYaLenta = $cache->get('rssfeedforyandexzenpage')) && $zenpage == $zenfeed_site_pwd_zen))
					
							{
									
								$siteName = htmlspecialchars($zenfeed_sitename);
								$siteDesc = htmlspecialchars($zenfeed_sitedesc);
						

								if (!class_exists( 'VmConfig' )) require(JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_virtuemart'.DS.'helpers'.DS.'config.php');

								if (!class_exists( 'VmModel' )) require(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_virtuemart'.DS.'helpers'.DS.'vmmodel.php');
								
								VmConfig::loadModJLang('mod_virtuemart_product_extended', true);

								VmConfig::loadConfig();
								// Load the language file of com_virtuemart.
								JFactory::getLanguage()->load('com_virtuemart');
								if (!class_exists( 'calculationHelper' )) require(JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_virtuemart'.DS.'helpers'.DS.'calculationh.php');
								if (!class_exists( 'CurrencyDisplay' )) require(JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_virtuemart'.DS.'helpers'.DS.'currencydisplay.php');
								if (!class_exists( 'VirtueMartModelVendor' )) require(JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_virtuemart'.DS.'models'.DS.'vendor.php');
								if (!class_exists( 'VmImage' )) require(JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_virtuemart'.DS.'helpers'.DS.'image.php');
								if (!class_exists( 'shopFunctionsF' )) require(JPATH_SITE.DS.'components'.DS.'com_virtuemart'.DS.'helpers'.DS.'shopfunctionsf.php');
								if (!class_exists( 'calculationHelper' )) require(JPATH_COMPONENT_SITE.DS.'helpers'.DS.'cart.php');
								if (!class_exists( 'VirtueMartModelProduct' )){
								   JLoader::import( 'product', JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_virtuemart' . DS . 'models' );
								}
								
								$productModel = VmModel::getModel('Product');    
    
								$vendorId = JRequest::getInt('vendorid', 1);

									function orderByName($ids, $mode, $language)
									{
														
										$db = Jfactory::getDBO();
										$query = $db->getQuery(true);
										$query->select('p.virtuemart_product_id');
										$query->from('#__virtuemart_products as p');
										$query->join('LEFT', '#__virtuemart_products_'.$language.' AS l ON p.virtuemart_product_id = l.virtuemart_product_id');
										$query->where('p.virtuemart_product_id IN('.implode(',', $ids).')');
										$query->order('l.product_name '.$mode);
										$db->setQuery($query);
									//	var_dump($query->dump()); break; 
										$ids = $db->loadColumn();
										
										return $ids;
									}
									
									function orderByDate($ids, $mode)
									{
									
										$language = strtolower($language[2]);
									
										$db = Jfactory::getDBO();
										$query = $db->getQuery(true);
										$query->select('p.virtuemart_product_id');
										$query->from('#__virtuemart_products as p');
										$query->where('p.virtuemart_product_id IN('.implode(',', $ids).')');
										$query->order('p.created_on '.$mode);
										$db->setQuery($query);
									//	var_dump($query->dump()); break; 
										$ids = $db->loadColumn();
										
										return $ids;
									}
									
									function get_featured_product_ids($category_id)
									{
										
										$db = Jfactory::getDBO();
										$query = $db->getQuery(true);
										$query->select('p.virtuemart_product_id');
										$query->from('#__virtuemart_products as p');
										if($category_id != 0)
										{
											$query->join('LEFT', '#__virtuemart_product_categories AS c ON p.virtuemart_product_id = c.virtuemart_product_id');
											$query->where('product_special = 1 AND published = 1 AND c.virtuemart_category_id = '.$category_id);	
										}
										else
										{
											$query->where('product_special = 1 AND published = 1');	
										}
										$db->setQuery($query);
									// 	var_dump($query->dump()); break; 
										$featured = $db->loadColumn();
										
										return $featured;
									}
									
									function get_latest_product_ids($max_items, $category_id)
									{
										$db = Jfactory::getDBO();
										$query = $db->getQuery(true);
										$query->select('p.virtuemart_product_id');
										$query->from('#__virtuemart_products as p');
										if($category_id != 0)
										{
											$query->join('LEFT', '#__virtuemart_product_categories AS c ON p.virtuemart_product_id = c.virtuemart_product_id');
											$query->where('published = 1 AND c.virtuemart_category_id IN ( '.$category_id.')');	
										}
										else
										{
											$query->where('published = 1');
										}	
									
										$query->order('p.created_on DESC LIMIT '.$max_items);
										$db->setQuery($query);
									// 	var_dump($query->dump()); break; 
										$latest = $db->loadColumn();
										
										return $latest;
									}
									
									function get_random_product_ids($category_id)
									{
										$lang =& JFactory::getLanguage();
										$language = $lang->getTag();
										$language = str_replace('-', '_', $language);
										$language = strtolower($language); 		
								
										$db = Jfactory::getDBO();
										$query = $db->getQuery(true);
										$query->select('pt.virtuemart_product_id');
										$query->from('#__virtuemart_products as p');
										$query->join('RIGHT', '#__virtuemart_products_'.$language.' as pt ON p.virtuemart_product_id = pt.virtuemart_product_id');
									
										if($category_id != 0)
										{
											$query->join('LEFT', '#__virtuemart_product_categories AS c ON p.virtuemart_product_id = c.virtuemart_product_id');
											$query->where('p.published = 1 AND c.virtuemart_category_id = '.$category_id);	
										}
										else
										{
											$query->where('p.published = 1');	
										}
										$db->setQuery($query);
								// 		var_dump($query->dump()); break; 
										$random = $db->loadColumn();
									 
										return $random;
									}
									
									function get_topten_product_ids($category_id)
									{
										$db = Jfactory::getDBO();
										$query = $db->getQuery(true);
										$query->select('p.virtuemart_product_id');
										$query->from('#__virtuemart_products as p');
										if($category_id != 0)
										{
											$query->join('LEFT', '#__virtuemart_product_categories AS c ON p.virtuemart_product_id = c.virtuemart_product_id');
											$query->where('p.published = 1 AND p.product_sales > 0 AND c.virtuemart_category_id = '.$category_id);	
										}	
										else
										{
											$query->where('p.published = 1 AND p.product_sales > 0');	
										}
										$query->order('p.product_sales DESC');
										$db->setQuery($query);
										//var_dump($query->dump()); break; 
										$topten = $db->loadColumn();
									 
										return $topten;
									}
									
									function get_ids_in_cart() {
										  
										$session      = JFactory::getSession();                               
										$cart_ser     = $session->get('vmcart', 0, 'vm');                     
										$ids_in_cart  = array();                                              
																												
										if(!empty($cart_ser))
										{                                                                                                               
											$cart_obj = unserialize($cart_ser);                               
																												
											if( !empty($cart_obj) )
											{                                                                                                   
												if(!empty($cart_obj->products))
												{                            
													foreach (array_keys($cart_obj->products) as $prod_id)
													{
														//Get 1st digits from string, If product has related products so his ID look likes 40::1:30
														preg_match('/^\d{1,}/', $prod_id, $match);
														array_push($ids_in_cart, $match[0]);
													}          
												}                                                                                                                             
											}                                                                                                                                       
										}   
									
									   return $ids_in_cart;
									} 
									
									function get_related_product_ids($ids_to_proceed)
									{
										
										$relateds = array();
									
										foreach($ids_to_proceed as $masterKey => $id_to_proceed)
										{
											$prods_in_cart = new StdClass();
											$prods_in_cart->virtuemart_product_id = $id_to_proceed;
											   
											$customfields = VmModel::getModel('Customfields');                    
											$prods_in_cart->customfields = $customfields->getProductCustomsField($prods_in_cart);
											  $prods_in_cart->customfieldsRelatedProducts = $customfields->getProductCustomsFieldRelatedProducts($prods_in_cart);    
											
											// each related product ids
											foreach ($prods_in_cart->customfieldsRelatedProducts as $key => $related)
											{
												array_push($relateds, $related->custom_value);    
											}      
										}
										
										//makes unique related products
										$relateds = array_unique($relateds);
											
										return $relateds;
									} 
									
									function get_other_bought_ids($ids_to_proceed)
									{
									
										$mod_vm_db = JFactory::getDBO();	
										//Select product ids where is 
										$sql  = "SELECT DISTINCT virtuemart_product_id FROM `#__virtuemart_order_items` WHERE virtuemart_order_id ";
										$sql .= "IN ( SELECT virtuemart_order_id FROM `#__virtuemart_order_items` WHERE virtuemart_product_id IN(".implode(',', $ids_to_proceed).")";
										$sql .= ") ";	
										$sql .= "AND virtuemart_product_id NOT IN(".implode(',', $ids_to_proceed).")";  		
										$mod_vm_db->setQuery($sql);	
										$also_bought = $mod_vm_db->loadColumn();
									
										return $also_bought;
									}
									
									function get_same_manufacturer_ids($ids_to_proceed)
									{
										
										$db = Jfactory::getDBO();
										$query = $db->getQuery(true);
										$query->select('p2.`virtuemart_product_id`');
										$query->from('`#__virtuemart_product_manufacturers` p1');
										$query->join('INNER', '`#__virtuemart_product_manufacturers` p2 ON p2.`virtuemart_manufacturer_id` = p1.`virtuemart_manufacturer_id`');
										$query->where('p1.`virtuemart_product_id` IN('.implode(',', $ids_to_proceed).') AND p2.`virtuemart_product_id` NOT IN('.implode(',', $ids_to_proceed).')');
										$db->setQuery($query);
										//var_dump($query->dump()); break;
										$same_manufacturer = $db->loadColumn();
										
										return $same_manufacturer;
									}
								
									// limiterss // cat_id
									$ids = get_latest_product_ids($zenfeed_site_db_limit,$zenfeed_vm3_catid);

									// dump($ids,1,'ids');

									if(!empty($ids))
									{ 
										$lang =& JFactory::getLanguage();
										$language = $lang->getTag();
										$language = str_replace('-', '_', $language);
										$language = strtolower($language); 
									
										//reduces number of products
										$ids = array_slice($ids, 0, $max_items);  
								
										//Makes products - core function of VM . Use both modifications.
										$front          = true;	
										$onlyPublished  = true;
										$single         = false;	
										$products = $productModel->getProducts($ids, $front, $show_price, $onlyPublished, $single );
									}
									else
									{
										  $products = array();
									}
								   
									$productModel->addImages($products);
										
									$totalProd = count( $products);

									// dump($products);

									// bdump
								//categoryItem

								// $checkarraycatcontent = strpos($zenfeed_com_content_catid,',');
							
								$items = $products;
								
								if (!empty($items)) {
									$rssYaLenta = '<?xml version="1.0" encoding="UTF-8"?>
									<rss version="2.0"
									xmlns:content="http://purl.org/rss/1.0/modules/content/"
									xmlns:dc="http://purl.org/dc/elements/1.1/"
									xmlns:media="http://search.yahoo.com/mrss/"
									xmlns:atom="http://www.w3.org/2005/Atom"
									xmlns:georss="http://www.georss.org/georss"';
					
									if ($turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {	$rssYaLenta .= "\n".
										'				xmlns:yandex="http://news.yandex.ru" 
									xmlns:turbo="http://turbo.yandex.ru"';
										}
					
									$rssYaLenta .= '>';
									$rssYaLenta .= '
										<channel>
											<title>'.$siteName.'</title>
											<link>'.JURI::base().'</link>
											<description>'.$siteDesc.'</description>
											<language>'.$zenfeed_sitelang.'</language>'."";
											if ($zenfeed_site_jbzoo_turbo_li == 1 && $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
												$rssYaLenta .= "\n".'<yandex:analytics type="LiveInternet"></yandex:analytics>';
											}
											if (!empty($zenfeed_site_jbzoo_turbo_yaid) && $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
												$rssYaLenta .= "\n".'<yandex:analytics type="Yandex" id="'.$zenfeed_site_jbzoo_turbo_yaid.'"/>';
											}
											if (!empty($zenfeed_site_jbzoo_turbo_googleid) && $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
												$rssYaLenta .= "\n".'<yandex:analytics id="'.$zenfeed_site_jbzoo_turbo_googleid.'" type="Google"></yandex:analytics>';
											}
											if (!empty($zenfeed_site_jbzoo_turbo_ya_rsya) && $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
												$rssYaLenta .= "\n".'<yandex:adNetwork type="Yandex" id="'.$zenfeed_site_jbzoo_turbo_ya_rsya.'" turbo-ad-id="first_ad_place"></yandex:adNetwork>';
											}
											if (!empty($zenfeed_site_jbzoo_turbo_ya_rsya2) && $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
												$rssYaLenta .= "\n".'<yandex:adNetwork type="Yandex" id="'.$zenfeed_site_jbzoo_turbo_ya_rsya2.'" turbo-ad-id="second_ad_place"></yandex:adNetwork>';
											}
											if (!empty($zenfeed_site_jbzoo_turbo_ya_rsya3) && $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
												$rssYaLenta .= "\n".'<yandex:adNetwork type="Yandex" id="'.$zenfeed_site_jbzoo_turbo_ya_rsya3.'" turbo-ad-id="third_ad_place"></yandex:adNetwork>';
											}
											if (!empty($zenfeed_site_jbzoo_turbo_ad_fox) && !empty($zenfeed_site_jbzoo_turbo_ad_fox_container) &&  $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
												$rssYaLenta .= "\n"."<yandex:adNetwork
												type='AdFox'
												turbo-ad-id='before_first_ad_fox_place'>
												   <![CDATA[
													   <div id='".$zenfeed_site_jbzoo_turbo_ad_fox_container."'></div>
													   <script>
														   window.Ya.adfoxCode.create({
															   ownerId: ".$zenfeed_site_jbzoo_turbo_ad_fox.",
															   containerId: '".$zenfeed_site_jbzoo_turbo_ad_fox_container."',
															   params: {
																   pp: 'g',
																   ps: 'cmic',
																   p2: 'fqem'
															   }
														   });
													   </script>
												   ]]>
											   </yandex:adNetwork>";
											}
					
							
									$items = array_slice($items, 0, (int)$zenfeed_site_rss_limit);
									
									$filtertags = explode(',',$zenfeed_com_content_filterstriptags);
									foreach($filtertags as $ftags) {
										$Infiltertags .= '<'.$ftags.'>';
									}
									
									// $Infiltertags = substr($Infiltertags,0,-1);
					
											
	if ($zenfeed_vm3_fastselleroff == 1) {
function list_product_type($pid) {
    $db = JFactory::getDBO();
  
    $VmTypeTable = "";
    $q  = "SELECT * FROM #__fastseller_product_product_type_xref ";
    $q .= "LEFT JOIN #__fastseller_product_type USING (product_type_id) ";
    $q .= "WHERE product_id='$pid' AND product_type_publish='Y' ";
    $q .= "ORDER BY product_type_list_order";
      
    $db->setQuery($q);
    $pts = $db->loadObjectList();
      
    $q  = "SELECT * FROM #__fastseller_product_type_parameter ";
    $q .= "WHERE product_type_id=";
    foreach ($pts as $pt) {
        $VmTypeTable .= "\n<table>\n";
          
        // SELECT parameter value of product
        $q2  = "SELECT * FROM #__fastseller_product_type_".$pt->product_type_id;
        $q2 .= " WHERE product_id='$pid'";
        $db->setQuery($q2);
          
        $info = $db->loadAssoc();
          
          
        $db->setQuery($q . $pt->product_type_id ." ORDER BY parameter_list_order");
        $params = $db->loadObjectList();
          
        foreach ($params as $param) {

            $VmTypeTable .= "<tr>\n";
            $VmTypeTable .= "<td>".$param->parameter_label;
            $VmTypeTable .= "</td>\n<td>";
            $VmTypeTable .= $info[$param->parameter_name]." ".$param->parameter_unit."</td></tr>\n";
          
        }
        $VmTypeTable .= "</table>\n";
    }
      
    return $VmTypeTable;
	}
}

if ($zenfeed_vm3_arrayuni == 1) {
	$items=array_map("unserialize",array_unique(array_map("serialize",$items)));
}

									foreach ($items as $item) {

										// dump($item);

										$itemID = $item->id;
										$VMproductID = $item->virtuemart_product_id;
										$VMproductSKU = $item->product_sku;
										$itemName = htmlspecialchars($item->product_name);
										$itemName = str_replace('«','&quot;',$itemName);
										$itemName = str_replace('»','&quot;',$itemName);

										if ($zenfeed_vm3_modtitle == 1) {
											$itemName = $itemName . ' ' . $item->category_name;
										}

										if ($zenfeed_vm3_modtitle == 2) {
											$itemName = $item->category_name . ' ' . $itemName;
										}
										
										if ($zenfeed_vm3_modtitle == 3) {
											$itemName = $zenfeed_vm3_modtitle_text_pre . ' ' . $itemName . ' ' . $zenfeed_vm3_modtitle_text_post;
										}

										$itemCreated = $item->created_on;
										$ItemPrice = round($item->allPrices[0]['product_price']);
										$itemCreated = JHtml::_('date', $itemCreated, 'Y-m-d H:i:s', JFactory::getApplication()->getCfg('offset'), true);
										$itemAuthor = JFactory::getUser($item->created_by)->name;
										if (empty($itemAuthor) && $zenfeed_site_defauthor_set == '1' && $zenfeed_site_defauthor_set_fix == '0') {
											$itemAuthor = $zenfeed_site_defauthor;
										}
										if ($zenfeed_site_defauthor_set_fix == '1') {
											$itemAuthor = $zenfeed_site_defauthor;
										}
								

										if ($zenfeed_vm3_fastselleroff == 1) {
											$ItemVMtype = list_product_type($VMproductID);
										}
										$category = $item->virtuemart_category_id;
										// canonCatId 
										// categories [0] 
					
										JLoader::register('ContentHelperRoute', JPATH_SITE . '/components/com_content/helpers/route.php');
					
										$rootURL = rtrim(JURI::base(),'/');
										$subpathURL = JURI::base(true);
										if(!empty($subpathURL) && ($subpathURL != '/')) {
											$rootURL = substr($rootURL, 0, -1 * strlen($subpathURL));
										}
					
										$itemUrl = $rootURL.'/'.$item->canonical;
										$itemUrl = $rootURL.JRoute::_($item->canonical);
										// $itemUrl = $rootURL.$item->link;
					
									
										$PreviewDesc = $item->product_s_desc;
										$FullDesc = $item->product_desc;

										if (empty($PreviewDesc)) {
											$PreviewDesc = ' ';
										}

										if (empty($FullDesc)) {
											$FullDesc = ' ';
										}

										if ($zenfeed_vm3_categorydesc == 1) {
											$PreviewDesc = $item->categoryItem[0]['category_description'];
										}
									
										$figure = '';
										$figures = '';
										$figureintext = '';
								
										if ($zenfeed_images_path == 1) {
											$PreviewDesc = str_replace('src="images','src="/images',$PreviewDesc);
											$FullDesc = str_replace('src="images','src="/images',$FullDesc);
											$PreviewDesc = str_replace('//images/','/images/',$PreviewDesc);
											$FullDesc = str_replace('//images/','/images/',$FullDesc);
										}
					
										if ($zenfeed_comcontent_pre == 1) {
					
										$PreviewDesc = preg_replace('/<pre.*<\/pre>/ui', $zenfeed_comcontent_pre_text, $PreviewDesc);
					
										$FullDesc = preg_replace('/<pre.*<\/pre>/ui', $zenfeed_comcontent_pre_text, $FullDesc);
											
										}
													
										if ($zenfeed_global_classes == 1) {
											if (!empty($zenfeed_global_classes_textarea)) {
												$regexplist = explode(PHP_EOL,trim($zenfeed_global_classes_textarea));
												if (!empty($regexplist[0])) {
													for ($i=0; $i < count($regexplist); $i++) { 
														$PreviewDesc = preg_replace("#{$regexplist[$i]}#", "", $PreviewDesc);
														$FullDesc = preg_replace("#{$regexplist[$i]}#", "", $FullDesc);
													}
												}
											}
										}
					
										if ($zenfeed_global_youtube == 1) {
															
											$PreviewDesc = preg_replace("/(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:watch\?(?:[\w-=&]*&)?v=|(?:|v)\/))([\w-]+)[\w-=&#;]*/", "<iframe allowfullscreen frameborder='0' height='315' src='https://www.youtube.com/embed/$1'; width='560'></iframe>", $PreviewDesc);
					
											$FullDesc = preg_replace("/(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:watch\?(?:[\w-=&]*&)?v=|(?:|v)\/))([\w-]+)[\w-=&#;]*/", "<iframe allowfullscreen frameborder='0' height='315' src='https://www.youtube.com/embed/$1'; width='560'></iframe>", $FullDesc);
												
										}
					
										if ($zenfeed_global_squarebrackets == 1) {
											$PreviewDesc = preg_replace('/\[(.+?)\].+\[\/(.+?)\]/', '', $PreviewDesc);
											$FullDesc = preg_replace('/\[(.+?)\].+\[\/(.+?)\]/', '', $FullDesc);
										}
					
										if ($zenfeed_vm3_striptags == 1) {
											$PreviewDesc = trim(strip_tags($PreviewDesc, $Infiltertags));
										}
					
										if ($zenfeed_vm3_biem == 1 && $zenfeed_vm3_striptags == 0) {
											
										$PreviewDesc = str_replace('<b>','',$PreviewDesc);
										$PreviewDesc = str_replace('</b>','',$PreviewDesc);
											
										$PreviewDesc = str_replace('<i>','',$PreviewDesc);
										$PreviewDesc = str_replace('</i>','',$PreviewDesc);
											
										$PreviewDesc = str_replace('<strong>','',$PreviewDesc);
										$PreviewDesc = str_replace('</strong>','',$PreviewDesc);
											
										$PreviewDesc = str_replace('<em>','',$PreviewDesc);
										$PreviewDesc = str_replace('</em>','',$PreviewDesc);
					
										}
					
										$PreviewDesc = str_replace('«','&quot;',$PreviewDesc);
										$PreviewDesc = str_replace('»','&quot;',$PreviewDesc);
										$PreviewDesc = str_replace('<br>','<br />',$PreviewDesc);
										$PreviewDesc = preg_replace('/<p(?:([\'"]).*?\1|.)*?>/ui', '<p>', $PreviewDesc);
										$PreviewDesc = preg_replace("/\{.*?}/ius", "", $PreviewDesc);
					
										if ($zenfeed_delete__vm3_noturbotag == 1) {
											$PreviewDesc = preg_replace("/<noturbo>.*?<\/noturbo>/ius", "", $PreviewDesc);
										}
					
										preg_match_all('@src="([^"]+)"@' , $FullDesc, $figureintext );
					
										if ($zenfeed_vm3_striptags == 1) {
					
											$FullDesc = trim(strip_tags($FullDesc, $Infiltertags));
											$FullDesc = str_replace('«','&quot;',$FullDesc);
											$FullDesc = str_replace('»','&quot;',$FullDesc);
											$FullDesc = str_replace('&nbsp;',' ',$FullDesc);
											$FullDesc = preg_replace('/<p(?:([\'"]).*?\1|.)*?>/ui', '<p>', $FullDesc);
											$FullDesc = str_replace('alt=""','',$FullDesc);
											$FullDesc = str_replace("title=''","",$FullDesc);
											// $FullDesc = preg_replace("/<img[^>]+>/ius", "", $FullDesc);
											// $FullDesc = str_replace('<p></p>','',$FullDesc);
											// $FullDesc = str_replace('<br>','<br />',$FullDesc);
										}
					
					
					
										if ($zenfeed_vm3_biem == 1 && $zenfeed_vm3_striptags == 0) {
					
										$FullDesc = str_replace('<b>','',$FullDesc);
										$FullDesc = str_replace('</b>','',$FullDesc);
											
										$FullDesc = str_replace('<i>','',$FullDesc);
										$FullDesc = str_replace('</i>','',$FullDesc);
											
										$FullDesc = str_replace('<strong>','',$FullDesc);
										$FullDesc = str_replace('</strong>','',$FullDesc);
											
										$FullDesc = str_replace('<em>','',$FullDesc);
										$FullDesc = str_replace('</em>','',$FullDesc);
					
										}
					
										$FullDesc = str_replace('«','&quot;',$FullDesc);
										$FullDesc = str_replace('»','&quot;',$FullDesc);
										$FullDesc = str_replace('<br>','<br />',$FullDesc);
					
										
										$FullDesc = preg_replace("/\{.*?}/ius", "", $FullDesc);
									
										if ($zenfeed_delete__vm3_noturbotag == 1) {
											$FullDesc = preg_replace("/<noturbo>.*?<\/noturbo>/ius", "", $FullDesc);
										}
					
										if ($zenfeed_img_domain == 1) {
											$patt = '/<\s*img[^>]*src=[\"|\'](.*?)[\"|\'][^>]*\/*>/i';
											$FullMatchImg = preg_match_all($patt, $FullDesc, $matchFull);
											foreach ($matchFull[1] as $matchimage) {
												if (!strstr($matchimage,'http')) {
													$FullDesc = str_replace($matchimage, JURI::base().$matchimage, $FullDesc); // work
												}
											}
											$FullMatchImg = preg_match_all($patt, $PreviewDesc, $matchPreview);
											foreach ($matchPreview[1] as $matchimagesmall) {
												if (!strstr($matchimagesmall,'http')) {
													$PreviewDesc = str_replace($matchimagesmall, JURI::base().$matchimagesmall, $PreviewDesc); // work
												}
											}
										}
					
										
										if ($FullDesc) {
									
											$rssYaLenta .= "\n";
											if ($turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) { $rssYaLenta .= '<item turbo="true">'; }
											else {
												$rssYaLenta .= '<item>';
											}
											$rssYaLenta .= "\n";
											$rssYaLenta .= '<title>'.$itemName.'</title>';
											$rssYaLenta .= "\n";
											$rssYaLenta .= '<link>'.$itemUrl.'</link>';
											$rssYaLenta .= "\n";
											$rssYaLenta .= '<guid>'.md5($itemUrl).'</guid>';
											$rssYaLenta .= "\n";
											$rssYaLenta .= '<pubDate>'.$itemCreated.' '.$zenfeed_site_time.'</pubDate>';
											$rssYaLenta .= "\n";
											$rssYaLenta .= '<media:rating scheme="urn:simple">nonadult</media:rating>';
											$rssYaLenta .= "\n";
											$rssYaLenta .= '<author>'.$itemAuthor.'</author>';
											$VMimg = '<img src="'.$item->file_url.'">';
											$ImgesEnclos = $PreviewDesc . $FullDesc . $VMimg;
											preg_match_all('@src="([^"]+)"@', $ImgesEnclos, $matchesenc);
											if ($matchesenc) {
												
												if ($item->file_url && $matchesenc[1] && !empty($matchesenc[1])) {
													foreach (array_unique($matchesenc[1]) as $imgenc) {
														if (strstr($imgenc,'http')) {
														$imgenc = str_replace(JURI::base().JURI::base(),JURI::base(),$imgenc);
														@$image_mimeecn = image_type_to_mime_type(exif_imagetype($imgenc)); 
														
														if ($zenfeed_images_path == 1) {
															$imgenc = str_replace('//images/','/images/',$imgenc);
														}
					
														$rssYaLenta .= "\n".'<enclosure url="'.$imgenc.'" type="'.$image_mimeecn.'"/>'."\n";
														}
														else {
														
														@$image_mimeecn = image_type_to_mime_type(exif_imagetype(JURI::base().$imgenc)); 
					
														if ($zenfeed_images_path == 1) {
															$imgenc = str_replace('//images/','images/',$imgenc);
															$imgenc = str_replace('/images/','images/',$imgenc);
														}
														
														$rssYaLenta .= "\n".'<enclosure url="'.JURI::base().$imgenc.'" type="'.$image_mimeecn.'"/>'."\n";
														}
													}
												}
											}
											
										if ($zenfeed_cat_replace == '1') {
					
										$checkarrayreplacecatname = strpos($zenfeed_cat_replace_catname,',');
										if ($checkarrayreplacecatname !== false) {
											$massivcatreplacename = explode(',',$zenfeed_cat_replace_catname);
											$countmascat = count($massivcatreplacename);
										}
					
								
										$offyandexcats = array (
											'Авто', 'Война', 'Дизайн', 'Дом', 'Еда', 'Здоровье', 'Знаменитости', 'Игры', 'Кино', 'Культура', 'Литература', 'Мода', 'Музыка', 'Наука', 'Общество', 'Политика', 'Природа', 'Происшествия', 'Психология', 'Путешествия', 'Спорт', 'Технологии', 'Фотографии', 'Хобби', 'Экономика', 'Юмор' 
										);
					
								
										for ($i=0; $i < $countmascat; $i++) { 
														$rssYaLenta .= '<category>'.trim($massivcatreplacename[$i]).'</category>';
														$rssYaLenta .= "\n";
										}
					
								
											
										}
										else {
											$rssYaLenta .= '<category>'.$item->category_name.'</category>';
											$rssYaLenta .= "\n";
										}

									
										if ($zenfeed_vm3_textoff == 1) {
											$PreviewDesc = '';
											$FullDesc = '';
										}

										if ($zenfeed_vm3_descmini == 0) {
											if ($zenfeed_vm3_descmini_striptags == 0) {
												$rssYaLenta .= '<description><![CDATA['.$PreviewDesc.']]></description>';
											}
											else {
												$rssYaLenta .= '<description><![CDATA['.strip_tags($PreviewDesc).']]></description>';
											}
											
											$rssYaLenta .= "\n";
										}
						
										if ($zenfeed_vm3_descmini == 1) {
											if ($zenfeed_vm3_descmini_striptags == 0) {
												$rssYaLenta .= '<description><![CDATA['.mb_substr($PreviewDesc, 0, $zenfeed_vm3_descmini_count).']]></description>';
											}
											else {
												$rssYaLenta .= '<description><![CDATA['.strip_tags(mb_substr($PreviewDesc, 0, $zenfeed_vm3_descmini_count)).']]></description>';
											}
						
											$rssYaLenta .= "\n"; // 
										}
					
					
											if (empty($FullDesc)) {
												$FullDesc = $PreviewDesc;
											}
					
											if ($zenfeed_vm3_introtofull == 1 && $zenfeed_site_snippet_center == 0) {
												$FullDesc = $PreviewDesc . $FullDesc;
											}
					
					
											if ($zenfeed_vm3_introtofull == 1 && $zenfeed_site_snippet_center == 1 && empty($zenfeed_site_jbzoo_turbo_ya_rsya2) && $turbopage != $zenfeed_site_pwdturbo) {
												$FullDesc = $PreviewDesc . "\n" . trim($zenfeed_site_snippet_center_text) . "\n" . $FullDesc;
											}
											
					
											if ($zenfeed_vm3_introtofull == 1 && !empty($zenfeed_site_jbzoo_turbo_ya_rsya2) && $turbopage == $zenfeed_site_pwdturbo) {
												$FullDesc = $PreviewDesc . "\n" . trim($zenfeed_site_snippet_center_text) . "\n" .' <figure data-turbo-ad-id="second_ad_place"></figure> ' . $FullDesc;
											}
											
					
											if ($zenfeed_vm3_introtofull == 0 && $zenfeed_site_snippet_center == 1 && !empty($zenfeed_site_jbzoo_turbo_ya_rsya2) && $turbopage == $zenfeed_site_pwdturbo) {
												$FullDesc = "\n" . trim($zenfeed_site_snippet_center_text) . "\n" .' <figure data-turbo-ad-id="second_ad_place"></figure> ' . $FullDesc;
											}
											
					
							if ($turbopage != $zenfeed_site_pwdturbo) {
												
																
											$rssYaLenta .= '<content:encoded><![CDATA['.$FullDesc.'';
											$rssYaLenta .= "\n";
										
									
										
										if ($item->file_url) {
										
												$image_intro = $item->file_url;
												$image_intro_alt = $itemName;
					
												@$sImg = getimagesize(JURI::base().$image_intro); 
											
										}
							
						
									
									$rssYaLenta .= '
												<figure>
												<img src="'.JURI::base().$image_intro.'" width="'.$sImg[0].'" height="'.$sImg[1].'">
												<figcaption>'.$image_intro_alt.'</figcaption>
												</figure>';
					
								
								
										$rssYaLenta .= ']]>';
										$rssYaLenta .= "\n";
										$rssYaLenta .= '</content:encoded>';
										$rssYaLenta .= "\n";
					
					}
					
					
					
					if ($turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
					
										$rssYaLenta .= '<turbo:content><![CDATA[';
										$rssYaLenta .= "\n";
									
								if ($zenfeed_site_snippet_top == 1 && !empty($zenfeed_site_snippet_top_text)) {
									$rssYaLenta .= trim($zenfeed_site_snippet_top_text) . "\n";
								}
					
								if (!empty($zenfeed_site_jbzoo_turbo_ya_rsya) && $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
									$rssYaLenta .= "\n".' <figure data-turbo-ad-id="first_ad_place"></figure> ' . "\n";
								}
						
					
								if ($item->file_url) {
										
									$image_intro = $item->file_url;
									$image_intro_alt = $itemName;
		
									@$sImg = getimagesize(JURI::base().$image_intro); 
								
							}
				
									
						$rssYaLenta .= '<header>
									<figure>
									<img src="'.JURI::base().$image_intro.'" width="'.$sImg[0].'" height="'.$sImg[1].'">
									<figcaption>'.$image_intro_alt.'</figcaption>
									</figure></header>';
							}

							if ($ItemPrice && !empty($ItemPrice)) {
								$priceVM = '<h3>Цена: '. $ItemPrice . 'руб.</h3>';	
							}
							else {
								$priceVM = '';
							}

							if ($zenfeed_vm3_fastselleroff == 1 && $ItemVMtype && !empty($ItemVMtype)) {
								$TableVMType = '<h4>Характеристики:</h4>'. $ItemVMtype . '.';	
							}
							else {
								$TableVMType = '';
							}

									$rssYaLenta .= $priceVM . $TableVMType . $FullDesc;
									// $rssYaLenta .= $FullDesc;
												
								if ($zenfeed_site_snippet_bottom == 1 && !empty($zenfeed_site_snippet_bottom_text)) {
									$rssYaLenta .= "\n" . trim($zenfeed_site_snippet_bottom_text) . "\n";
								}
								
								if (!empty($zenfeed_site_jbzoo_turbo_ya_rsya3) && $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
									$rssYaLenta .= "\n".' <figure data-turbo-ad-id="third_ad_place"></figure> ' . "\n";
								}
					
									$rssYaLenta .= ']]>';
									$rssYaLenta .= "\n";
									$rssYaLenta .= '</turbo:content>';
					
									if ($figure) {
										if (!empty($figure[1]) && $figure[1]) {
				
											foreach ($figure[1] as $imageenc) {
												@$image_mimeecn = image_type_to_mime_type(exif_imagetype(JURI::base().$imageenc)); 
												$rssYaLenta .= "\n".'<enclosure url="'.JURI::base().$imageenc.'" type="'.$image_mimeecn.'"/>';
											}
											
				
										}
									}
										
										$rssYaLenta .= "\n".'</item>'."\n";
										
											}
					
							
											
										}
									}
									
							
									$rssYaLenta .= '</channel></rss>';
									
							
							if ($turbopage == $zenfeed_site_pwdturbo) {
									$cache->store($rssYaLenta, 'rssfeedforyandexzen');
							}
					
							if ($zenpage == $zenfeed_site_pwd_zen) {
									$cache->store($rssYaLenta, 'rssfeedforyandexzenpage');
							}
					
							if ($zenfeed_xmlfeed == 1) {
								header('Content-type: text/xml; charset=utf-8');
								header('Content-Disposition: inline'); 
								echo trim($rssYaLenta);
								exit;
							}
							else {
								return trim($rssYaLenta);
							}
					
									}
								
								}

							//maybe


							if ($zenfeed_who == '6') {


			switch ($randompage) {
				case '-1':
					$randompage = 'ORDER BY RAND()';
					$zenfeed_site_rss_limit = $zenfeed_site_db_random;
					$zenfeed_site_db_limit = $zenfeed_site_db_random;
					break;
				
				default:
					$randompage = 'ORDER BY `created`';
					break;
			}

								//YOOtheme Pro
								// error_reporting( E_ERROR ); 

								if (((!$rssYaLenta = $cache->get('rssfeedforyandexzen')) && $turbopage == $zenfeed_site_pwdturbo) || ((!$rssYaLenta = $cache->get('rssfeedforyandexzenpage')) && $zenpage == $zenfeed_site_pwd_zen))
						
								{
										
									$siteName = htmlspecialchars($zenfeed_sitename);
									$siteDesc = htmlspecialchars($zenfeed_sitedesc);
							
									$checkarraycatcontent = strpos($zenfeed_com_youthemepro_catid,',');
								
											
									if ($checkarraycatcontent !== false) {
						
													$ar_cat_comc = explode(',',$zenfeed_com_youthemepro_catid);
													$countmascc = count($ar_cat_comc);
													$textcatsid = array();
													for ($i=0; $i < $countmascc; $i++) { 
														$textcatsid[] = '`catid`='.$ar_cat_comc[$i].' OR ';
														if ($i == $countmascc - 1) {
															array_pop($textcatsid);
															$textcatsid[] = '`catid`='.$ar_cat_comc[$i].'';
														}
													}
													
													$db = JFactory::getDbo();     
													$query = $db->getQuery(true);  
													$query = "SELECT `id`,`title`,`alias`,`introtext`,`fulltext`,`catid`,`created`,`created_by`,`images`" . " FROM " . " `#__content` WHERE (".implode($textcatsid).") AND `STATE` = 1 ".$randompage." DESC  LIMIT ".(int)$zenfeed_site_db_limit."";
													$db->setQuery($query);    
													$items = $db->loadObjectList();
						
									}
						
						
									else {
						
										$db = JFactory::getDbo();     
										$query = $db->getQuery(true);  
										$query = "SELECT `id`,`title`,`alias`,`introtext`,`fulltext`,`catid`,`created`,`created_by`,`images`" . " FROM " . " `#__content` WHERE `catid`=".(int)$zenfeed_com_youthemepro_catid." AND `STATE` = 1 ".$randompage." DESC  LIMIT ".(int)$zenfeed_site_db_limit."";
										$db->setQuery($query);    
										$items = $db->loadObjectList();
						
									}
									
									
									if (!empty($items)) {
										$rssYaLenta = '<?xml version="1.0" encoding="UTF-8"?>
										<rss version="2.0"
										xmlns:content="http://purl.org/rss/1.0/modules/content/"
										xmlns:dc="http://purl.org/dc/elements/1.1/"
										xmlns:media="http://search.yahoo.com/mrss/"
										xmlns:atom="http://www.w3.org/2005/Atom"
										xmlns:georss="http://www.georss.org/georss"';
						
										if ($turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {	$rssYaLenta .= "\n".
											'				xmlns:yandex="http://news.yandex.ru" 
										xmlns:turbo="http://turbo.yandex.ru"';
											}
						
										$rssYaLenta .= '>';
										$rssYaLenta .= '
											<channel>
												<title>'.$siteName.'</title>
												<link>'.JURI::base().'</link>
												<description>'.$siteDesc.'</description>
												<language>'.$zenfeed_sitelang.'</language>'."";
												if ($zenfeed_site_jbzoo_turbo_li == 1 && $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
													$rssYaLenta .= "\n".'<yandex:analytics type="LiveInternet"></yandex:analytics>';
												}
												if (!empty($zenfeed_site_jbzoo_turbo_yaid) && $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
													$rssYaLenta .= "\n".'<yandex:analytics type="Yandex" id="'.$zenfeed_site_jbzoo_turbo_yaid.'"/>';
												}
												if (!empty($zenfeed_site_jbzoo_turbo_googleid) && $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
													$rssYaLenta .= "\n".'<yandex:analytics id="'.$zenfeed_site_jbzoo_turbo_googleid.'" type="Google"></yandex:analytics>';
												}
												if (!empty($zenfeed_site_jbzoo_turbo_ya_rsya) && $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
													$rssYaLenta .= "\n".'<yandex:adNetwork type="Yandex" id="'.$zenfeed_site_jbzoo_turbo_ya_rsya.'" turbo-ad-id="first_ad_place"></yandex:adNetwork>';
												}
												if (!empty($zenfeed_site_jbzoo_turbo_ya_rsya2) && $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
													$rssYaLenta .= "\n".'<yandex:adNetwork type="Yandex" id="'.$zenfeed_site_jbzoo_turbo_ya_rsya2.'" turbo-ad-id="second_ad_place"></yandex:adNetwork>';
												}
												if (!empty($zenfeed_site_jbzoo_turbo_ya_rsya3) && $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
													$rssYaLenta .= "\n".'<yandex:adNetwork type="Yandex" id="'.$zenfeed_site_jbzoo_turbo_ya_rsya3.'" turbo-ad-id="third_ad_place"></yandex:adNetwork>';
												}
												if (!empty($zenfeed_site_jbzoo_turbo_ad_fox) && !empty($zenfeed_site_jbzoo_turbo_ad_fox_container) &&  $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
													$rssYaLenta .= "\n"."<yandex:adNetwork
													type='AdFox'
													turbo-ad-id='before_first_ad_fox_place'>
													   <![CDATA[
														   <div id='".$zenfeed_site_jbzoo_turbo_ad_fox_container."'></div>
														   <script>
															   window.Ya.adfoxCode.create({
																   ownerId: ".$zenfeed_site_jbzoo_turbo_ad_fox.",
																   containerId: '".$zenfeed_site_jbzoo_turbo_ad_fox_container."',
																   params: {
																	   pp: 'g',
																	   ps: 'cmic',
																	   p2: 'fqem'
																   }
															   });
														   </script>
													   ]]>
												   </yandex:adNetwork>";
												}
						
								
										$items = array_slice($items, 0, (int)$zenfeed_site_rss_limit);
										
										$filtertags = explode(',',$zenfeed_com_content_filterstriptags);
										foreach($filtertags as $ftags) {
											$Infiltertags .= '<'.$ftags.'>';
										}
										
										// $Infiltertags = substr($Infiltertags,0,-1);
						
										foreach ($items as $item) {
						
											$itemID = $item->id;
											$itemName = htmlspecialchars($item->title);
											$itemName = str_replace('«','&quot;',$itemName);
											$itemName = str_replace('»','&quot;',$itemName);
											$itemCreated = $item->created;
											$itemCreated = JHtml::_('date', $itemCreated, 'Y-m-d H:i:s', JFactory::getApplication()->getCfg('offset'), true);
											$itemAuthor = JFactory::getUser($item->created_by)->name;
											if (empty($itemAuthor) && $zenfeed_site_defauthor_set == '1' && $zenfeed_site_defauthor_set_fix == '0') {
												$itemAuthor = $zenfeed_site_defauthor;
											}
											if ($zenfeed_site_defauthor_set_fix == '1') {
												$itemAuthor = $zenfeed_site_defauthor;
											}
											
											$category = JCategories::getInstance('Content')->get($item->catid);
						
						
											JLoader::register('ContentHelperRoute', JPATH_SITE . '/components/com_content/helpers/route.php');
						
											$rootURL = rtrim(JURI::base(),'/');
											$subpathURL = JURI::base(true);
											if(!empty($subpathURL) && ($subpathURL != '/')) {
												$rootURL = substr($rootURL, 0, -1 * strlen($subpathURL));
											}
						
											$itemUrl = $rootURL.JRoute::_(ContentHelperRoute::getArticleRoute($item->id, $item->catid));
						
											if ($zenfeed_comyouthemepro_sef_itemid == 1 && !empty($zenfeed_comyouthemepro_sef_itemid_num)) {
											
											$fixmenu = (int) $zenfeed_comyouthemepro_sef_itemid_num;
						
											$itemUrl = $rootURL.JRoute::_('index.php?option=com_content&view=article&id='.$item->id.':'.$item->alias.'&catid='.$item->catid.'&Itemid='.$fixmenu);
						
											}
						
											$PreviewDesc = $item->introtext;
											$FullDesc = $item->fulltext;

											// fox for Yoo
											$FullDesc = json_decode(trim(substr($FullDesc, 4, -3)), true);
											// dump($FullDesc,0,'FullDesc');

											$MegaYTar = array();
											$MegaYTarText = array();

											if (!empty($FullDesc['children'])) {
											
												$i = 0;

												foreach ($FullDesc['children'] as $children) {

													$i++;
													
													$MegaYTar[] = array('section_name' => $children['name'], 'order' => $i);
													$MegaYTarText[] = array('section_name' => $children['name'], 'order' => $i);

													if ($children['type'] == 'section') {
														
														foreach ($children['children'] as $child) {

															if ($child['type'] == 'row') {
																
																foreach ($child['children'] as $chi) {

																	if ($child['type'] == 'row') {

																		foreach ($chi['children'] as $chiar) {
																			
																			
																			switch ($chiar['type']) {
																																
																				case 'text':
																					$MegaYTar[$i]['data'][] = array (
																						'chitextblock' => array (
																						'content' => $chiar['props']['content'],
																					));
																					$MegaYTarText[$i]['data'][] = $chiar['props']['content'];
																					break;

																				case 'image':
																					$MegaYTar[$i]['data'][] = array (
																						'chiimageblock' => array(
																						'src' => $chiar['props']['image'],
																						'alt' => $chiar['props']['image_alt'],
																					));

																					if (empty($chiar['props']['image_alt'])) {
																						$chiar['props']['image_alt'] = $MegaYTar[$i]['section_name'];
																					}

																					$MegaYTarText[$i]['data'][] = ' <img alt="'.$chiar['props']['image_alt'].'" src="'.$chiar['props']['image'].'"> ';
																					break;
																					
																				case 'panel':
																					$MegaYTar[$i]['data'][] = array (
																						'chipanelblock' => array(
																						'title_element' => $chiar['props']['title_element'],
																						'title_style' => $chiar['props']['title_style'],
																						'title' => $chiar['props']['title'],
																						'content' => $chiar['props']['content'],
																					));
																					$MegaYTarText[$i]['data'][] = '<'.$chiar['props']['title_style'].'>'.$chiar['props']['title'].'</'.$chiar['props']['title_style'].'>'.$chiar['props']['content'];
																					break;
																					
																				case 'headline':
																					$MegaYTar[$i]['data'][] = array (
																						'chiheadlineblock' => array (
																						'title_element' => $chiar['props']['title_element'],
																						'title_style' => $chiar['props']['title_style'],
																						'content' => $chiar['props']['content'],
																					));

																					if (empty($chiar['props']['title_style'])) {
																						$chiar['props']['title_style'] = $chiar['props']['title_element'];
																					}

																					$MegaYTarText[$i]['data'][] = '<'.$chiar['props']['title_style'].'>'.$chiar['props']['content'].'</'.$chiar['props']['title_style'].'>';
																					break;


																					case 'example_element':
																					
																					$Cenajson = json_decode(file_get_contents($rootURL.$chiar['props']['field_select']));

																					$MegaYTar[$i]['data'][] = array (
																						'chicenablock' => array (
																						'field_select' => $chiar['props']['field_select'],
																						'cena_json' => $Cenajson,
																					));

																					unset($tablecena);
																				
																					$tablecena = '<table>';
																					foreach ($Cenajson as $cenatable) {
																						unset($cenatable[2]); //delete formula
																						$tablecena .= '<tr><td>'.implode('</td><td>', $cenatable).'</td></tr>';
																					}
																					$tablecena .= '</table>';

																					$MegaYTarText[$i]['data'][] = $tablecena;
																					unset($tablecena);
																					break;
																					
																				case 'grid':
																				
																					foreach ($chiar['children'] as $chigrid) {
																						$MegaYTar[$i]['data'][] = array (
																							'chigridblock' => array (
																							'title' => $chigrid['props']['title'],
																							'meta' => $chigrid['props']['meta'],
																							'image' => $chigrid['props']['image'],
																							'content' => $chigrid['props']['content'],
																							'link' => $chigrid['props']['link'],
																						));

																						if (!empty($chigrid['props']['link']) && !empty($chigrid['props']['image'])) {

																							$MegaYTarText[$i]['data'][] = ' <p>'.'<img alt="'.$chigrid['props']['title'].'" src="'.$chigrid['props']['image'].'">'.'</p><p><a href="'.$chigrid['props']['link'].'">'.$chigrid['props']['title'].'</a></p> ';
																						}

																						if (empty($chigrid['props']['link']) && !empty($chigrid['props']['image'])) {

																							if (empty($chigrid['props']['title']) && !empty($chigrid['props']['meta'])) {
																								$chigrid['props']['title'] = $chigrid['props']['meta'];
																							}
																							else {
																								$chigrid['props']['title'] = $MegaYTar[$i]['data']['section_name'];
																							}

																							$MegaYTarText[$i]['data'][] = ' <p>'.'<img alt="'.$chigrid['props']['title'].'" src="'.$chigrid['props']['image'].'">'.'</p> ';

																						}
																					}
																					break;
																					
																				case 'joomla_module':
																					# code... not!
																					break;
																				
																				default:
																					# code...
																					break;
																				}

																				//alltoline

																				// $ForEachToText[] = $chiimageblock;

																			}
																		
																		}

																}
															}

													
														}

													}
												

												}

											}
					
									

											unset($FullDesc);
											$FullDesc = '';
											
											foreach ($MegaYTarText as $BigText['data']) {
												if (!empty($BigText['data']['data'])) {
												
												$FullDesc .= implode($BigText['data']['data']);

												}
											}



											$figure = '';
											$figures = '';
											$figureintext = '';
									
											if ($zenfeed_images_path == 1) {
												$PreviewDesc = str_replace('src="images','src="/images',$PreviewDesc);
												$FullDesc = str_replace('src="images','src="/images',$FullDesc);
												$PreviewDesc = str_replace('//images/','/images/',$PreviewDesc);
												$FullDesc = str_replace('//images/','/images/',$FullDesc);
											}
						
											if ($zenfeed_comyouthemepro_pre == 1) {
						
											$PreviewDesc = preg_replace('/<pre.*<\/pre>/ui', $zenfeed_comyouthemepro_pre_text, $PreviewDesc);
						
											$FullDesc = preg_replace('/<pre.*<\/pre>/ui', $zenfeed_comyouthemepro_pre_text, $FullDesc);
												
											}
														
											if ($zenfeed_global_classes == 1) {
												if (!empty($zenfeed_global_classes_textarea)) {
													$regexplist = explode(PHP_EOL,trim($zenfeed_global_classes_textarea));
													if (!empty($regexplist[0])) {
														for ($i=0; $i < count($regexplist); $i++) { 
															$PreviewDesc = preg_replace("#{$regexplist[$i]}#", "", $PreviewDesc);
															$FullDesc = preg_replace("#{$regexplist[$i]}#", "", $FullDesc);
														}
													}
												}
											}
						
											if ($zenfeed_global_youtube == 1) {
																
												$PreviewDesc = preg_replace("/(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:watch\?(?:[\w-=&]*&)?v=|(?:|v)\/))([\w-]+)[\w-=&#;]*/", "<iframe allowfullscreen frameborder='0' height='315' src='https://www.youtube.com/embed/$1'; width='560'></iframe>", $PreviewDesc);
						
												$FullDesc = preg_replace("/(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:watch\?(?:[\w-=&]*&)?v=|(?:|v)\/))([\w-]+)[\w-=&#;]*/", "<iframe allowfullscreen frameborder='0' height='315' src='https://www.youtube.com/embed/$1'; width='560'></iframe>", $FullDesc);
													
											}
						
											if ($zenfeed_global_squarebrackets == 1) {
												$PreviewDesc = preg_replace('/\[(.+?)\].+\[\/(.+?)\]/is', '', $PreviewDesc);
												$FullDesc = preg_replace('/\[(.+?)\].+\[\/(.+?)\]/is', '', $FullDesc);
												$PreviewDesc = preg_replace('/\[(.+?)\]/is', '', $PreviewDesc);
												$FullDesc = preg_replace('/\[(.+?)\]/is', '', $FullDesc);
											}
						
											if ($zenfeed_comyouthemepro_striptags == 1) {
												$PreviewDesc = trim(strip_tags($PreviewDesc, $Infiltertags));
											}
						
											if ($zenfeed_comyouthemepro_biem == 1 && $zenfeed_comyouthemepro_striptags == 0) {
												
											$PreviewDesc = str_replace('<b>','',$PreviewDesc);
											$PreviewDesc = str_replace('</b>','',$PreviewDesc);
												
											$PreviewDesc = str_replace('<i>','',$PreviewDesc);
											$PreviewDesc = str_replace('</i>','',$PreviewDesc);
												
											$PreviewDesc = str_replace('<strong>','',$PreviewDesc);
											$PreviewDesc = str_replace('</strong>','',$PreviewDesc);
												
											$PreviewDesc = str_replace('<em>','',$PreviewDesc);
											$PreviewDesc = str_replace('</em>','',$PreviewDesc);
						
											}
						
											$PreviewDesc = str_replace('«','&quot;',$PreviewDesc);
											$PreviewDesc = str_replace('»','&quot;',$PreviewDesc);
											$PreviewDesc = str_replace('<br>','<br />',$PreviewDesc);
											$PreviewDesc = preg_replace('/<p(?:([\'"]).*?\1|.)*?>/ui', '<p>', $PreviewDesc);
											$PreviewDesc = preg_replace("/\{.*?}/ius", "", $PreviewDesc);
						
											if ($zenfeed_delete_noturbotag == 1) {
												$PreviewDesc = preg_replace("/<noturbo>.*?<\/noturbo>/ius", "", $PreviewDesc);
											}
						
											preg_match_all('@src="([^"]+)"@' , $FullDesc, $figureintext );
						
											if ($zenfeed_comyouthemepro_striptags == 1) {
						
												$FullDesc = trim(strip_tags($FullDesc, $Infiltertags));
												$FullDesc = str_replace('«','&quot;',$FullDesc);
												$FullDesc = str_replace('»','&quot;',$FullDesc);
												$FullDesc = str_replace('&nbsp;',' ',$FullDesc);
												$FullDesc = preg_replace('/<p(?:([\'"]).*?\1|.)*?>/ui', '<p>', $FullDesc);
												$FullDesc = str_replace('alt=""','',$FullDesc);
												$FullDesc = str_replace("title=''","",$FullDesc);
												// $FullDesc = preg_replace("/<img[^>]+>/ius", "", $FullDesc);
												// $FullDesc = str_replace('<p></p>','',$FullDesc);
												// $FullDesc = str_replace('<br>','<br />',$FullDesc);
											}
						
						
						
											if ($zenfeed_comyouthemepro_biem == 1 && $zenfeed_comyouthemepro_striptags == 0) {
						
											$FullDesc = str_replace('<b>','',$FullDesc);
											$FullDesc = str_replace('</b>','',$FullDesc);
												
											$FullDesc = str_replace('<i>','',$FullDesc);
											$FullDesc = str_replace('</i>','',$FullDesc);
												
											$FullDesc = str_replace('<strong>','',$FullDesc);
											$FullDesc = str_replace('</strong>','',$FullDesc);
												
											$FullDesc = str_replace('<em>','',$FullDesc);
											$FullDesc = str_replace('</em>','',$FullDesc);
						
											}
						
											$FullDesc = str_replace('«','&quot;',$FullDesc);
											$FullDesc = str_replace('»','&quot;',$FullDesc);
											$FullDesc = str_replace('<br>','<br />',$FullDesc);
						
											
											$FullDesc = preg_replace("/\{.*?}/ius", "", $FullDesc);
										
											if ($zenfeed_delete_noturbotag == 1) {
												$FullDesc = preg_replace("/<noturbo>.*?<\/noturbo>/ius", "", $FullDesc);
											}
						
											if ($zenfeed_img_domain == 1) {
												$patt = '/<\s*img[^>]*src=[\"|\'](.*?)[\"|\'][^>]*\/*>/i';
												$FullMatchImg = preg_match_all($patt, $FullDesc, $matchFull);
												foreach ($matchFull[1] as $matchimage) {
													if (!strstr($matchimage,'http')) {
														$FullDesc = str_replace($matchimage, JURI::base().$matchimage, $FullDesc); // work
													}
												}
												$FullMatchImg = preg_match_all($patt, $PreviewDesc, $matchPreview);
												foreach ($matchPreview[1] as $matchimagesmall) {
													if (!strstr($matchimagesmall,'http')) {
														$PreviewDesc = str_replace($matchimagesmall, JURI::base().$matchimagesmall, $PreviewDesc); // work
													}
												}
											}
						
											
											if (!empty($FullDesc) || !empty($PreviewDesc)) {
										
												$rssYaLenta .= "\n";
												if ($turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) { $rssYaLenta .= '<item turbo="true">'; }
												else {
													$rssYaLenta .= '<item>';
												}
												$rssYaLenta .= "\n";
												$rssYaLenta .= '<title>'.$itemName.'</title>';
												$rssYaLenta .= "\n";
												$rssYaLenta .= '<link>'.$itemUrl.'</link>';
												$rssYaLenta .= "\n";
												$rssYaLenta .= '<guid>'.md5($itemUrl).'</guid>';
												$rssYaLenta .= "\n";
												$rssYaLenta .= '<pubDate>'.$itemCreated.' '.$zenfeed_site_time.'</pubDate>';
												$rssYaLenta .= "\n";
												$rssYaLenta .= '<media:rating scheme="urn:simple">nonadult</media:rating>';
												$rssYaLenta .= "\n";
												$rssYaLenta .= '<author>'.$itemAuthor.'</author>';
												$rssYaLenta .= "\n";
												
												$ImgesEnclos = $PreviewDesc . $FullDesc;
												preg_match_all('@src="([^"]+)"@', $ImgesEnclos, $matchesenc);
												if ($matchesenc) {
													
													if ($matchesenc[1] && !empty($matchesenc[1])) {
														$FullDesc .= "\n" . '<div data-block="gallery"><header>Галерея изображений</header>';
														foreach (array_unique($matchesenc[1]) as $imgenc) {
															if (strstr($imgenc,'http')) {
															$imgenc = str_replace(JURI::base().JURI::base(),JURI::base(),$imgenc);
															@$image_mimeecn = image_type_to_mime_type(exif_imagetype($imgenc)); 
															
															if ($zenfeed_images_path == 1) {
																$imgenc = str_replace('//images/','/images/',$imgenc);
															}
						
															$rssYaLenta .= "\n".'<enclosure url="'.$imgenc.'" type="'.$image_mimeecn.'"/>'."\n";
															$FullDesc .= '<img src="'.$imgenc.'"/>';
										
															}
															else {
															
															@$image_mimeecn = image_type_to_mime_type(exif_imagetype(JURI::base().$imgenc)); 
						
															if ($zenfeed_images_path == 1) {
																$imgenc = str_replace('//images/','images/',$imgenc);
																$imgenc = str_replace('/images/','images/',$imgenc);
															}
															$rssYaLenta .= "\n".'<enclosure url="'.JURI::base().$imgenc.'" type="'.$image_mimeecn.'"/>'."\n";
															$FullDesc .= '<img src="'.JURI::base().$imgenc.'"/>';
															}
														}
														$FullDesc .= '</div>';
													}
												}
												
												
											if ($zenfeed_cat_replace == '1') {
						
											$checkarrayreplacecatname = strpos($zenfeed_cat_replace_catname,',');
											if ($checkarrayreplacecatname !== false) {
												$massivcatreplacename = explode(',',$zenfeed_cat_replace_catname);
												$countmascat = count($massivcatreplacename);
											}
						
									
											$offyandexcats = array (
												'Авто', 'Война', 'Дизайн', 'Дом', 'Еда', 'Здоровье', 'Знаменитости', 'Игры', 'Кино', 'Культура', 'Литература', 'Мода', 'Музыка', 'Наука', 'Общество', 'Политика', 'Природа', 'Происшествия', 'Психология', 'Путешествия', 'Спорт', 'Технологии', 'Фотографии', 'Хобби', 'Экономика', 'Юмор' 
											);
						
									
											for ($i=0; $i < $countmascat; $i++) { 
															$rssYaLenta .= '<category>'.trim($massivcatreplacename[$i]).'</category>';
															$rssYaLenta .= "\n";
											}
						
									
												
											}
											else {
												$rssYaLenta .= '<category>'.$category->title.'</category>';
												$rssYaLenta .= "\n";
											}
										
											if ($zenfeed_comyouthemepro_descmini == 0) {
												if ($zenfeed_comyouthemepro_descmini_striptags == 0) {
													$rssYaLenta .= '<description><![CDATA['.$PreviewDesc.']]></description>';
												}
												else {
													$rssYaLenta .= '<description><![CDATA['.strip_tags($PreviewDesc).']]></description>';
												}
												
												$rssYaLenta .= "\n";
											}
							
											if ($zenfeed_comyouthemepro_descmini == 1) {
												if ($zenfeed_comyouthemepro_descmini_striptags == 0) {
													$rssYaLenta .= '<description><![CDATA['.mb_substr($PreviewDesc, 0, $zenfeed_comyouthemepro_descmini_count).']]></description>';
												}
												else {
													$rssYaLenta .= '<description><![CDATA['.strip_tags(mb_substr($PreviewDesc, 0, $zenfeed_comyouthemepro_descmini_count)).']]></description>';
												}
							
												$rssYaLenta .= "\n"; // 
											}
						
						
												if (empty($FullDesc) && $zenfeed_comyouthemepro_introtofull_fixempty == 1) {
													
												}
						
												if (empty($FullDesc) && $zenfeed_comyouthemepro_introtofull_fixempty == 0) {
													$FullDesc = $PreviewDesc;
												}
						
						
												if ($zenfeed_comyouthemepro_introtofull == 1 && $zenfeed_site_snippet_center == 0) {
													$FullDesc = $PreviewDesc . $FullDesc;
												}
						
						
												if ($zenfeed_comyouthemepro_introtofull == 1 && $zenfeed_site_snippet_center == 1 && empty($zenfeed_site_jbzoo_turbo_ya_rsya2) && $turbopage != $zenfeed_site_pwdturbo) {
													$FullDesc = $PreviewDesc . "\n" . trim($zenfeed_site_snippet_center_text) . "\n" . $FullDesc;
												}
												
						
												if ($zenfeed_comyouthemepro_introtofull == 1 && !empty($zenfeed_site_jbzoo_turbo_ya_rsya2) && $turbopage == $zenfeed_site_pwdturbo) {
													$FullDesc = $PreviewDesc . "\n" . trim($zenfeed_site_snippet_center_text) . "\n" .' <figure data-turbo-ad-id="second_ad_place"></figure> ' . $FullDesc;
												}
												
						
												if ($zenfeed_comyouthemepro_introtofull == 0 && $zenfeed_site_snippet_center == 1 && !empty($zenfeed_site_jbzoo_turbo_ya_rsya2) && $turbopage == $zenfeed_site_pwdturbo) {
													$FullDesc = "\n" . trim($zenfeed_site_snippet_center_text) . "\n" .' <figure data-turbo-ad-id="second_ad_place"></figure> ' . $FullDesc;
												}
												
						
								if ($turbopage != $zenfeed_site_pwdturbo) {
													
																	
												$rssYaLenta .= '<content:encoded><![CDATA['.$FullDesc.'';
												$rssYaLenta .= "\n";
											
								
						
										if ($zenfeed_comyouthemepro_introimage == 1) {
											
											if ($item->images && !empty($item->images)) {
												if (!empty($item->images)) {
													$inarticlesformimg = json_decode($item->images);
													$image_intro = $inarticlesformimg->image_intro;
													$image_intro_alt = $inarticlesformimg->image_intro_alt;
						
													@$sImg = getimagesize(JURI::base().$image_intro); //Warning, if img delete		
													@$oneImg = getimagesize(JURI::base().$image_intro); //Warning, if img delete
						
													if ($zenfeed_comyouthemepro_fullimage == 1) {
													$image_fulltext = $inarticlesformimg->image_fulltext;
													$image_fulltext_alt = $inarticlesformimg->image_fulltext_alt;
						
													@$stImg = getimagesize(JURI::base().$image_fulltext); //Warning, if img delete		
													@$TwoImg = getimagesize(JURI::base().$image_fulltext); //Warning, if img delete
						
													}
												}
											}
										}
						
								if ($zenfeed_comyouthemepro_imagetotopplease == 1) {	
									
											if ($item->images && !empty($item->images) && !empty($oneImg[0])) {
											
												if (!empty($image_intro_alt)) {
													$figcapt = $image_intro_alt;
												}
												else {
													$figcapt = $itemName;
												}
						
										
										$rssYaLenta .= '
													<figure>
													<img src="'.JURI::base().$image_intro.'" width="'.$oneImg[0].'" height="'.$oneImg[1].'">
													<figcaption>'.$figcapt.'</figcaption>
													</figure>';
											}
						
									
											if ($item->images && !empty($item->images) && $image_intro != $image_fulltext && !empty($TwoImg[0])) {
						
												if (!empty($image_fulltext_alt)) {
													$figcapt = $image_fulltext_alt;
												}
												else {
													$figcapt = $itemName;
												}
						
										
										$rssYaLenta .= '
													<figure>
													<img src="'.JURI::base().$image_fulltext.'" width="'.$TwoImg[0].'" height="'.$TwoImg[1].'">
													<figcaption>'.$figcapt.'</figcaption>
													</figure>';
											}
								}
						
									
									
											$rssYaLenta .= ']]>';
											$rssYaLenta .= "\n";
											$rssYaLenta .= '</content:encoded>';
											$rssYaLenta .= "\n";
						
						}
						
						
						
						if ($turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
						
											$rssYaLenta .= '<turbo:content><![CDATA[';
											$rssYaLenta .= "\n";
										
									if ($zenfeed_site_snippet_top == 1 && !empty($zenfeed_site_snippet_top_text)) {
										$rssYaLenta .= trim($zenfeed_site_snippet_top_text) . "\n";
									}
						
									if (!empty($zenfeed_site_jbzoo_turbo_ya_rsya) && $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
										$rssYaLenta .= "\n".' <figure data-turbo-ad-id="first_ad_place"></figure> ' . "\n";
									}
											if ($zenfeed_comyouthemepro_introimage == 1) {
												
												if ($item->images && !empty($item->images)) {
													if (!empty($item->images)) {
														$inarticlesformimg = json_decode($item->images);
														$image_intro = $inarticlesformimg->image_intro;
														$image_intro_alt = $inarticlesformimg->image_intro_alt;
							
														@$sImg = getimagesize(JURI::base().$image_intro); //Warning, if img delete		
														@$oneImg = getimagesize(JURI::base().$image_intro); //Warning, if img delete
							
														if ($zenfeed_comyouthemepro_fullimage == 1) {
														$image_fulltext = $inarticlesformimg->image_fulltext;
														$image_fulltext_alt = $inarticlesformimg->image_fulltext_alt;
							
														@$stImg = getimagesize(JURI::base().$image_fulltext); //Warning, if img delete		
														@$TwoImg = getimagesize(JURI::base().$image_fulltext); //Warning, if img delete
							
														}
													}
												}
											}
						
								
										if ($item->images && !empty($item->images) && !empty($oneImg[0])) {
										
											if (!empty($image_intro_alt)) {
												$figcapt = $image_intro_alt;
											}
											else {
												$figcapt = $itemName;
											}
						
									
									$rssYaLenta .= '
												<header>
												<h1>'.$itemName.'</h1>
												<figure>
												<img src="'.JURI::base().$image_intro.'" width="'.$oneImg[0].'" height="'.$oneImg[1].'">
												<figcaption>'.$figcapt.'</figcaption>
												</figure>
												</header>';
										}
										
								if ($zenfeed_comyouthemepro_imagetotopplease == 1) {	
										if ($item->images && !empty($item->images) && $image_intro != $image_fulltext && !empty($TwoImg[0])) {
						
											if (!empty($image_fulltext_alt)) {
												$figcapt = $image_fulltext_alt;
											}
											else {
												$figcapt = $itemName;
											}
						
												$rssYaLenta .= '
												<header>
												<h1>'.$itemName.'</h1>
												<figure>
												<img src="'.JURI::base().$image_fulltext.'" width="'.$TwoImg[0].'" height="'.$TwoImg[1].'">
												<figcaption>'.$figcapt.'</figcaption>
												</figure>
												</header>';
										}
										else  {
						
											if ($zenfeed_comyouthemepro_previmage == 1) {
											preg_match('@src="([^"]+)"@' , $PreviewDesc, $figureintextprev );
						
											$mainimg = $figureintextprev[1];
						
											if (!empty($mainimg) && strlen($mainimg) > 5 && NULL !== $mainimg) {
											$figcapt = $itemName;
											
											@$InImg = getimagesize(JURI::base().$mainimg); //Warning, if img delete	
						
											$rssYaLenta .= '
											<header>
											<h1>'.$itemName.'</h1>
											<figure>
											<img src="'.$mainimg.'">
											<figcaption>'.$figcapt.'</figcaption>
											</figure>
											</header>';
						
												}
											}
										}
								}
						
						
										$rssYaLenta .= $FullDesc;
													
									if ($zenfeed_site_snippet_bottom == 1 && !empty($zenfeed_site_snippet_bottom_text)) {
										$rssYaLenta .= "\n" . trim($zenfeed_site_snippet_bottom_text) . "\n";
									}
									
									if (!empty($zenfeed_site_jbzoo_turbo_ya_rsya3) && $turbopage == $zenfeed_site_pwdturbo && $zenfeed_site_jbzoo_turbo == 1) {
										$rssYaLenta .= "\n".' <figure data-turbo-ad-id="third_ad_place"></figure> ' . "\n";
									}
						
										$rssYaLenta .= ']]>';
										$rssYaLenta .= "\n";
										$rssYaLenta .= '</turbo:content>';
						
										
												}
						
											if ($figure) {
												if (!empty($figure[1]) && $figure[1]) {
						
													foreach ($figure[1] as $imageenc) {
														@$image_mimeecn = image_type_to_mime_type(exif_imagetype(JURI::base().$imageenc)); 
														$rssYaLenta .= "\n".'<enclosure url="'.JURI::base().$imageenc.'" type="'.$image_mimeecn.'"/>';
													}
													
						
												}
											}
						
						
												
												$rssYaLenta .= "\n".'</item>'."\n";
						
												
											}
										}
										
								
										$rssYaLenta .= '</channel></rss>';
										
								
								if ($turbopage == $zenfeed_site_pwdturbo) {
										$cache->store($rssYaLenta, 'rssfeedforyandexzen');
								}
						
								if ($zenpage == $zenfeed_site_pwd_zen) {
										$cache->store($rssYaLenta, 'rssfeedforyandexzenpage');
								}
						
								if ($zenfeed_xmlfeed == 1) {
									header('Content-type: text/xml; charset=utf-8');
									header('Content-Disposition: inline'); 
									echo trim($rssYaLenta);
									exit;
								}
								else {
									return trim($rssYaLenta);
								}
						
										}
									
									}
									else {
										
										if ( $turbopage == $zenfeed_site_pwdturbo) {
											if ($zenfeed_xmlfeed == 1) {
												echo $cache->get('rssfeedforyandexzen');
												exit;
											}
											else {
												return $cache->get('rssfeedforyandexzen');
											}
										}
						
										if ( $zenpage == $zenfeed_site_pwd_zen) {
											if ($zenfeed_xmlfeed == 1) {
												echo $cache->get('rssfeedforyandexzenpage');
												exit;
											}
											else {
												return $cache->get('rssfeedforyandexzenpage');
											}
										}
									}
						
								}

								else {
									
									if ( $turbopage == $zenfeed_site_pwdturbo) {
										if ($zenfeed_xmlfeed == 1) {
											echo $cache->get('rssfeedforyandexzen');
											exit;
										}
										else {
											return $cache->get('rssfeedforyandexzen');
										}
									}
					
									if ( $zenpage == $zenfeed_site_pwd_zen) {
										if ($zenfeed_xmlfeed == 1) {
											echo $cache->get('rssfeedforyandexzenpage');
											exit;
										}
										else {
											return $cache->get('rssfeedforyandexzenpage');
										}
									}
								}
					
							}
					
	}

