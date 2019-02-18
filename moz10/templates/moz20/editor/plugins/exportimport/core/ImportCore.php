<?php

require_once dirname(__FILE__) . '/Mappers.php';

class ImportCore
{

    private $_rootUrl;
    private $_template;
    
    private $_contentDir = '';
    private $_contentObject = null;
    private $_newIdsData = array();

    public function __construct($data) {
        jimport('joomla.filesystem.folder');
        jimport('joomla.filesystem.file');

        $this->_filename = isset($data['filename']) ? $data['filename'] : '';


        $this->_replaceStatus = isset($data['replaceStatus']) ? ($data['replaceStatus'] == "yes" ? true : false) : true;
        $this->_template = isset($data['template']) ? $data['template'] : '';
        if (!$this->_template || $this->_filename)
            $this->_rootUrl = dirname(dirname(dirname(dirname(dirname(JURI::current())))));
        else
            $this->_rootUrl = dirname(dirname(dirname(dirname(JURI::current()))));

        $contentDir = '';

        if (isset($data['filename'])) {
            $fileName = $data['filename'];
            $isLast = isset($data['last']) ? $data['last'] : '';
            if ('' === $fileName) {
                trigger_error('Empty file name', E_USER_ERROR);
            } else {
                $uploadPath = dirname(__FILE__) . '/' . $fileName;
                $result = $this->_uploadFileChunk($uploadPath, $isLast);
                if ($result['status'] == 'done') {
                    $contentDir = $this->_contentUnZip($uploadPath);
                }
            }
        }

        if (!$contentDir && isset($data['contentDir']))
            $contentDir = $data['contentDir'];

        if ($contentDir && file_exists($contentDir . '/content.json')) {
            // copy images
            if (file_exists($contentDir . '/images')) {
                JFolder::create(JPATH_SITE . '/images/editor-content');
                JFolder::copy($contentDir . '/images', JPATH_SITE . '/images/editor-content', '', true);
            }
            $this->_contentObject = json_decode(file_get_contents($contentDir . '/content.json'), true);
            $this->_contentDir = $contentDir;

            if (!isset($this->_contentObject['Images']))
                $this->_contentObject['Images'] = array();
        }
    }

    public function import()
    {
        if ($this->_contentObject != null) {
            $this->_createContent();
            $this->_createMenus();
            $this->_createModules();
            $this->_updateContent();
            $this->_configureModulesVisibility();
            $this->_configureEditor();
        }

        if (!$this->_template && $this->_contentDir)
            JFolder::delete($this->_contentDir);

        $serializeIdsData = serialize($this->_newIdsData);
        $this->setIdsDataParamToPlugin($serializeIdsData);
        return $serializeIdsData;
    }

    public function isInstalled()
    {
        $categories = PluginExportImport_Data_Mappers::get('category');
        $menus = PluginExportImport_Data_Mappers::get('menu');
        $modules = PluginExportImport_Data_Mappers::get('module');

        foreach ($this->_contentObject['Categories'] as $key => $categoryData) {
            $categoriesList = $categories->find(array('title' => $categoryData['caption']));
            if (0 != count($categoriesList))
                return true;
        }

        foreach ($this->_contentObject['Menus'] as $key => $menuData) {
            $menusList = $menus->find(array('title' => $menuData['caption']));
            if (0 != count($menusList))
                return true;
        }

        foreach ($this->_contentObject['Widgets'] as $key => $widgetData) {
            $modulesList = $modules->find(array('title' => $widgetData['title']));
            if (0 != count($modulesList))
                return true;
        }

        return false;
    }

    public function setParameters()
    {
        if (!isset($this->_contentObject['Parameters']))
            return json_encode('');

        $db = JFactory::getDBO();
        $query = $db->getQuery(true);
        $query->select('params')->from('#__template_styles')->where('template=' . $db->quote($this->_template));
        $db->setQuery($query);
        $parameters = $this->_stringToParams($db->loadResult());

        foreach ($this->_contentObject['Parameters'] as $key => $parameterData)
            $parameters[$key] = $parameterData;

        $query = $db->getQuery(true);
        $query->update('#__template_styles')->set(
            $db->quoteName('params') . '=' .
            $db->quote($this->_paramsToString($parameters))
        )->where('template=' . $db->quote($this->_template));

        $db->setQuery($query);
        $db->query();

        $parameters = array();
        foreach ($this->_contentObject['Parameters'] as $key => $parameterData){
            $parameters['jform_params_' . $key] = $parameterData;
        }
        return json_encode($parameters);
    }

    private function _createContent()
    {
        if (!isset($this->_contentObject['Sections']))
            $this->_contentObject['Sections'] = array();
        if (!isset($this->_contentObject['Categories']))
            $this->_contentObject['Categories'] = array();
        if (!isset($this->_contentObject['Posts']))
            $this->_contentObject['Posts'] = array();

        $categoryMapper = PluginExportImport_Data_Mappers::get('category');
        $content = PluginExportImport_Data_Mappers::get('content');

        if ($this->_replaceStatus) {
            $idsData = $this->getIdsDataParamFromPlugin();
            if (isset($idsData['categoriesIds'])) {
                $categoryIds = explode(',', $idsData['categoriesIds']);
                foreach($categoryIds as $categoryId)
                {
                    $res = $categoryMapper->find(array('id' => $categoryId));
                    if (count($res) > 0)
                        $categoryMapper->delete($categoryId);
                }
            }
        }

        // create categories
        $categories = $this->_contentObject['Categories'];
        if (!isset($this->_newIdsData['categoriesIds']))
            $this->_newIdsData['categoriesIds'] = '';
        foreach($categories as $key => $category) {
            $categoryObj = $categoryMapper->create();
            $categoryObj->title = $category['caption'];
            $categoryObj->extension = 'com_content';
            $categoryObj->metadata = $this->_paramsToString(array('robots' => '', 'author' => '', 'tags' => ''));
            $status = $categoryMapper->save($categoryObj);
            if (is_string($status))
                trigger_error($status, E_USER_ERROR);
            $this->_contentObject['Categories'][$key]['joomla_id'] = $categoryObj->id;
            $this->_newIdsData['categoriesIds'] = ($this->_newIdsData['categoriesIds'] ? $this->_newIdsData['categoriesIds'] . ',' : '') . $categoryObj->id;
        }

        if (count($this->_contentObject['Sections']) > 0) {
            $tableList = JFactory::getDbo()->getTableList();
            $upageTable = JFactory::getConfig()->get('dbprefix') . 'upage_sections';
            if (!in_array($upageTable, $tableList)) {
                $db = JFactory::getDBO();
                $query = <<<EOL
CREATE TABLE IF NOT EXISTS `#__upage_sections` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `title` varchar(255) NOT NULL DEFAULT '',
    `content` mediumtext NOT NULL,
    `image` text NOT NULL DEFAULT '',
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
EOL;
                $db->setQuery($query);
                $db->query();
            }
        }

        $posts = $this->_contentObject['Posts'];
        if (!isset($this->_newIdsData['postsIds']))
            $this->_newIdsData['postsIds'] = '';
        foreach($posts as $key => $post) {
            $article = $content->create();
            $postcats = explode(',', $post['categories']);
            $article->catid = $this->_contentObject['Categories'][substr($postcats[0], 10, -1)]['joomla_id'];
            $article->title = $this->_getPropertyValue('caption', $post, 'post_' . round(microtime(true)));
            $date = new JDate();
            $article->alias = $date->format('Y-m-d-H-i-s') . '-' . $key;
            $article->introtext = $post['content'];
            //process images
            $images = json_decode('{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}');
            $images->image_intro = $this->_replacePlaceholdersForImages($this->_getPropertyValue('image', $post, ''), true);
            $images->image_fulltext = $this->_replacePlaceholdersForImages($this->_getPropertyValue('fullImage', $post, ''), true);
            $article->images = json_encode($images);
            $article->attribs = $this->_paramsToString(array
            (
                'show_title' => '',
                'link_titles' => '',
                'show_intro' => '',
                'show_category' => '',
                'link_category' => '',
                'show_parent_category' => '',
                'link_parent_category' => '',
                'show_author' => '',
                'link_author' => '',
                'show_create_date' => '',
                'show_modify_date' => '',
                'show_publish_date' => '',
                'show_item_navigation' => '',
                'show_icons' => '',
                'show_print_icon' => '',
                'show_email_icon' => '',
                'show_vote' => '',
                'show_hits' => '',
                'show_noauth' => '',
                'alternative_readmore' => '',
                'article_layout' => ''
            ));
            if (isset($post['description']))
                $article->metadesc = $post['description'];
            if (isset($post['keywords']))
                $article->metakey = $post['keywords'];
            $article->metadata = $this->_paramsToString(array('robots' => '', 'author' => '', 'rights' => '', 'xreference' => '', 'tags' => ''));
            $status = $content->save($article);
            if (is_string($status))
                trigger_error($status, E_USER_ERROR);
            $this->_newIdsData['postsIds'] = ($this->_newIdsData['postsIds'] ? $this->_newIdsData['postsIds'] . ',' : '') . $article->id;
            $this->_contentObject['Posts'][$key]['joomla_id'] = $article->id;
        }
    }

    private function _createMenus()
    {
        if (!isset($this->_contentObject['Menus']))
            return;

        if (count($this->_contentObject['Menus']) > 0 && $this->_template) {
            $menusMapper = PluginExportImport_Data_Mappers::get('menu');
            $menuItemsMapper = PluginExportImport_Data_Mappers::get('menuItem');

            $home = $menuItemsMapper->find(array('home' => 1));
            $defaultMenuDataFound = false;
            foreach ($this->_contentObject['Menus'] as $menuData) {
                foreach ($menuData['items'] as $key => $itemData) {
                    if (isset($itemData['default']) && $itemData['default']) {
                        $defaultMenuDataFound = true;
                    }
                }
            }
            // Create a temporary menu with one item to clean up the Home flag:
            $rndMenu = null;
            if (count($home) > 0 && $defaultMenuDataFound) {
                $rndMenu = $menusMapper->create();
                $rndMenu->title = $rndMenu->menutype = substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'), 0, 10);
                $status = $menusMapper->save($rndMenu);
                if (is_string($status))
                    trigger_error($status, E_USER_ERROR);
                $rndItem = $menuItemsMapper->create();
                $rndItem->home = '1';
                $rndItem->checked_out = $home[0]->checked_out;
                $rndItem->menutype = $rndMenu->menutype;
                $rndItem->alias = $rndItem->title = $rndMenu->menutype;
                $rndItem->link = 'index.php?option=com_content&view=article&id=';
                $rndItem->type = 'component';
                $rndItem->component_id = '22';
                $rndItem->params = $this->_paramsToString(array());
                $status = $menuItemsMapper->save($rndItem);
                if (is_string($status))
                    trigger_error($status, E_USER_ERROR);
            }


            foreach ($this->_contentObject['Menus'] as $menuData) {
                $menuList = $menusMapper->find(array('title' => $menuData['caption']));
                foreach ($menuList as $menuListItem) {
                    $status = $menusMapper->delete($menuListItem->id);
                    if (is_string($status))
                        trigger_error($status, E_USER_ERROR);
                }
            }

            foreach ($this->_contentObject['Menus'] as $index => $menuData) {
                $menu = $menusMapper->create();
                $menu->title = $menuData['caption'];
                $menu->menutype = $menuData['name'];
                $status = $menusMapper->save($menu);
                if (is_string($status))
                    trigger_error($status, E_USER_ERROR);

                foreach ($menuData['items'] as $key => $itemData) {
                    $item = $menuItemsMapper->create();

                    if (isset($itemData['default']) && $itemData['default']) {
                        $item->home = '1';
                    }

                    $item->menutype = $menu->menutype;
                    $item->title = $itemData['caption'];
                    $item->alias = $itemData['name'];

                    $href = $this->_getPropertyValue('href', $itemData, '');
                    $type = $this->_getPropertyValue('type', $itemData, '');

                    $postId = '';

                    if (preg_match('/\[post_(\d+)\]/', $href, $matches))
                        if (isset($this->_contentObject['Posts'][$matches[1]]['joomla_id'])) {
                            $type = 'single-article';
                            $postId = $this->_contentObject['Posts'][$matches[1]]['joomla_id'];
                        }

                    $categoryId = $this->_getPropertyValue('category', $itemData, '');;
                    if (preg_match('/\[category_(\d+)\]/', $href, $matches))
                        if (isset($this->_contentObject['Categories'][$matches[1]]['joomla_id'])) {
                            $type = 'category-blog-layout';
                            $categoryId = $this->_contentObject['Categories'][$matches[1]]['joomla_id'];
                        }

                    switch ($type) {
                        case 'single-article':
                            $item->link = 'index.php?option=com_content&view=article&id=' . $postId;
                            $item->type = 'component';
                            $item->component_id = '22';
                            $params = array
                            (
                                'show_title' => '1',
                                'link_titles' => '',
                                'show_intro' => '',
                                'show_category' => '0',
                                'link_category' => '',
                                'show_parent_category' => '0',
                                'link_parent_category' => '',
                                'show_author' => '0',
                                'link_author' => '',
                                'show_create_date' => '0',
                                'show_modify_date' => '0',
                                'show_publish_date' => '0',
                                'show_item_navigation' => '0',
                                'show_vote' => '0',
                                'show_icons' => '0',
                                'show_print_icon' => '0',
                                'show_email_icon' => '0',
                                'show_hits' => '0',
                                'show_noauth' => '',
                                'menu-anchor_title' => '',
                                'menu-anchor_css' => '',
                                'menu_image' => '',
                                'menu_text' => '1',
                                'page_title' => '',
                                'show_page_heading' => '0',
                                'page_heading' => '',
                                'pageclass_sfx' => '',
                                'menu-meta_description' => '',
                                'menu-meta_keywords' => '',
                                'robots' => '',
                                'secure' => '0',
                                'page_title' => ''
                            );
                            break;
                        case 'category-blog-layout':
                            $item->link = 'index.php?option=com_content&view=category&layout=blog&id=' . $categoryId;
                            $item->type = 'component';
                            $item->component_id = '22';
                            $params = array
                            (
                                'layout_type' => 'blog',
                                'show_category_title' => '',
                                'show_description' => '',
                                'show_description_image' => '',
                                'maxLevel' => '',
                                'show_empty_categories' => '',
                                'show_no_articles' => '',
                                'show_subcat_desc' => '',
                                'show_cat_num_articles' => '',
                                'page_subheading' => '',
                                'num_leading_articles' => '0',
                                'num_intro_articles' => '4',
                                'num_columns' => '1',
                                'num_links' => '',
                                'multi_column_order' => '',
                                'show_subcategory_content' => '',
                                'orderby_pri' => '',
                                'orderby_sec' => 'order',
                                'order_date' => '',
                                'show_pagination' => '',
                                'show_pagination_results' => '',
                                'show_title' => '',
                                'link_titles' => '',
                                'show_intro' => '',
                                'show_category' => '',
                                'link_category' => '',
                                'show_parent_category' => '',
                                'link_parent_category' => '',
                                'show_author' => '',
                                'link_author' => '',
                                'show_create_date' => '',
                                'show_modify_date' => '',
                                'show_publish_date' => '',
                                'show_item_navigation' => '',
                                'show_vote' => '',
                                'show_readmore' => '',
                                'show_readmore_title' => '',
                                'show_icons' => '',
                                'show_print_icon' => '',
                                'show_email_icon' => '',
                                'show_hits' => '',
                                'show_noauth' => '',
                                'show_feed_link' => '',
                                'feed_summary' => '',
                                'menu-anchor_title' => '',
                                'menu-anchor_css' => '',
                                'menu_image' => '',
                                'menu_text' => 1,
                                'page_title' => '',
                                'show_page_heading' => 0,
                                'page_heading' => '',
                                'pageclass_sfx' => '',
                                'menu-meta_description' => '',
                                'menu-meta_keywords' => '',
                                'robots' => '',
                                'secure' => 0,
                                'page_title' => ''
                            );
                            break;
                        default:
                            $item->link = $href;
                            $item->type = 'url';
                            $item->component_id = '0';
                            $params = array
                            (
                                'menu-anchor_title' => '',
                                'menu-anchor_css' => '',
                                'menu_image' => '',
                                'menu_text' => 1
                            );
                    }

                    // parameters:
                    $item->params = $this->_paramsToString($params);

                    // parent:
                    if (isset($itemData['parent']))
                        $item->setLocation($this->_contentObject['Menus'][$index]['items'][$itemData['parent']]['joomla_id'], 'last-child');

                    $status = $menuItemsMapper->save($item);
                    if (is_string($status))
                        trigger_error($status, E_USER_ERROR);

                    $this->_contentObject['Menus'][$index]['items'][$key]['joomla_id'] = $item->id;
                }
            }
            if ($rndMenu) {
                $status = $menusMapper->delete($rndMenu->id);
                if (is_string($status))
                    trigger_error($status, E_USER_ERROR);
            }
        }
    }

    private function _createModules()
    {
        if (!isset($this->_contentObject['Widgets']))
            return;

        $modulesMapper = PluginExportImport_Data_Mappers::get('module');

        foreach ($this->_contentObject['Widgets'] as $moduleData) {
            $modulesList = $modulesMapper->find(array('title' => $moduleData['title']));
            foreach ($modulesList as $modulesListItem) {
                $status = $modulesMapper->delete($modulesListItem->id);
            }
        }

        $order = array();

        foreach ($this->_contentObject['Widgets'] as $key => $moduleData) {
            $module = $modulesMapper->create();
            $module->title = $moduleData['title'];
            $module->position = $moduleData['position'];
            $style = isset($moduleData['style']) ? $moduleData['style'] : '';
            $params = array();
            switch ($moduleData['type']) {
                case 'menu':
                    $module->module = 'mod_menu';
                    $params = array
                    (
                        'menutype' => $moduleData['menu'],
                        'startLevel' => '1',
                        'endLevel' => '0',
                        'showAllChildren' => '1',
                        'tag_id' => '',
                        'class_sfx' => '',
                        'window_open' => '',
                        'layout' => '_:default',
                        'moduleclass_sfx' => $style,
                        'cache' => '1',
                        'cache_time' => '900',
                        'cachemode' => 'itemid'
                    );
                    break;
                case 'login':
                    $module->module = 'mod_login';
                    $params = array
                    (
                        'pretext' => '',
                        'posttext' => '',
                        'login' => '',
                        'logout' => '',
                        'greeting' => '1',
                        'name' => '0',
                        'usesecure' => '0',
                        'layout' => '_:default',
                        'moduleclass_sfx' => '',
                        'cache' => '0'
                    );
                    break;
                case 'search':
                    $module->module = 'mod_search';
                    $params = array
                    (
                        'layout' => '_:default',
                        'moduleclass_sfx' => '',
                        'cache' => '0'
                    );
                    break;
                case 'custom':
                    $module->module = 'mod_custom';
                    $module->content = $this->_processingContent($moduleData['content']);
                    $params = array
                    (
                        'prepare_content' => '1',
                        'layout' => '_:default',
                        'moduleclass_sfx' => '',
                        'cache' => '1',
                        'cache_time' => '900',
                        'cachemode' => 'static'
                    );
                    break;
            }
            $module->showtitle = 'true' == $moduleData['showTitle'] ? '1' : '0';
            // style:
            if (isset($moduleData['style']) && isset($params['moduleclass_sfx']))
                $params['moduleclass_sfx'] = $moduleData['style'];
            // parameters:
            $module->params = $this->_paramsToString($params);

            // ordering:
            if (!isset($order[$moduleData['position']]))
                $order[$moduleData['position']] = 1;
            $module->ordering = $order[$moduleData['position']];
            $order[$moduleData['position']]++;

            $status = $modulesMapper->save($module);
            if (is_string($status))
                trigger_error($status, E_USER_ERROR);
            $this->_contentObject['Widgets'][$key]['joomla_id'] = $module->id;
        }
    }

    private function _updateContent()
    {
        $content = PluginExportImport_Data_Mappers::get('content');

        foreach ($this->_contentObject['Posts'] as $articleData) {
            $article = $content->fetch($articleData['joomla_id']);
            if (!is_null($article)) {
                $text = $this->_processingContent($articleData['content']);
                $parts = explode('<!--CUT-->', $text);
                $article->introtext = $parts[0];
                if (count($parts) > 1)
                    $article->fulltext = $parts[1];
                $status = $content->save($article);
                if (is_string($status))
                    trigger_error($status, E_USER_ERROR);
            }
        }
    }

    private function _parseHref($matches)
    {
        $path = urldecode($matches[1]);
        $menuItems = PluginExportImport_Data_Mappers::get('menuItem');
        foreach ($this->_contentObject['Menus'] as $menuData)
        {
            foreach ($menuData['items'] as $itemData)
            {
                if (isset($itemData['path']) && $path === $itemData['path']) {
                    $menuItem = $menuItems->fetch($itemData['joomla_id']);
                    if (!is_null($menuItem))
                        return 'href="' . $menuItem->link . '&Itemid=' . $menuItem->id . '"';
                }
            }
        }

        $content = PluginExportImport_Data_Mappers::get('content');
        $count = count($this->_contentObject['Menus']);
        $menu = null;
        if ($count > 0)
            $menu = $this->_contentObject['Menus'][$count];
        if ($menu != null && isset($menu['type']) && $menu['type'] == 'special') {
            $specialMenuItems = $menu['items'];
            foreach ($this->_contentObject['Posts'] as $articleData) {
                if (isset($articleData['path']) && $path === $articleData['path']) {
                    $article = $content->fetch($articleData['joomla_id']);
                    $item = strstr($path, '/Blog Posts/') ? $specialMenuItems[1] : $specialMenuItems[2];
                    if (!is_null($article))
                        return 'href="index.php?option=com_content&amp;view=article'.
                        '&amp;id=' . $article->id . '&amp;catid=' . $article->catid .
                        '&amp;Itemid=' . $item['joomla_id'] . '"';
                }
            }
        }
        if ('' === $matches[1])
            return 'href="#"';
        else
            return $matches[0];
    }

    private function _processingContent($content) {

        $config = JFactory::getConfig();
        $live_site = $config->get('live_site');
        $root = trim($live_site) != '' ? JURI::root(true) : dirname(dirname(dirname(JURI::root(true))));
        if ('/' === substr($root, -1))
            $root  = substr($root, 0, -1);

        $content = $this->_replacePlaceholdersForImages($content);
        $content = $this->_replacePlaceholdersForSections($content);
        if ($this->_template)
            $content = preg_replace('/src="images\/template\//', 'src="' . $root .'/templates/' . $this->_template . '/images/', $content);
        $content = str_replace('url(\\\'images/', 'url(\\\'' . $root . '/images/', $content);
        $content = preg_replace_callback('/href="?([^"]*)"/', array( &$this, '_parseHref'), $content);
        return $content;
    }

    private function _configureModulesVisibility()
    {
        if (!isset($this->_contentObject['Widgets']))
            return;
        if (!isset($this->_contentObject['Menus']))
            return;

        $contentMenuItems = array();

        foreach ($this->_contentObject['Menus'] as $menuData)
            foreach ($menuData['items'] as $itemData)
                $contentMenuItems[] = $itemData['joomla_id'];

        $contentModules = array();
        foreach ($this->_contentObject['Widgets'] as $widgetData)
            $contentModules[] = $widgetData['joomla_id'];

        $modules = PluginExportImport_Data_Mappers::get('module');
        $menuItems = PluginExportImport_Data_Mappers::get('menuItem');

        $userMenuItems = array();
        $menuItemList = $menuItems->find(array('scope' => 'site'));
        foreach ($menuItemList as $menuItem) {
            if (in_array($menuItem->id, $contentMenuItems))
                continue;
            $userMenuItems[] = $menuItem->id;
        }

        $moduleList = $modules->find(array('scope' => 'site'));
        foreach ($moduleList as $moduleListItem) {
            if (in_array($moduleListItem->id, $contentModules)) {
                $modules->enableOn($moduleListItem->id, $contentMenuItems);
            } else {
                $pages = $modules->getAssignment($moduleListItem->id);
                if (1 == count($pages) && '0' == $pages[0])
                    $modules->disableOn($moduleListItem->id, $contentMenuItems);
                if (0 < count($pages) && 0 > $pages[0]) {
                    $disableOnPages = array_unique(array_merge(array_map('abs', $pages), $contentMenuItems));
                    $modules->disableOn($moduleListItem->id, $disableOnPages);
                }
            }
        }
    }

    private function _configureEditor()
    {
        $extensions = PluginExportImport_Data_Mappers::get('extension');
        $tinyMce = $extensions->findOne(array('element' => 'tinymce'));
        if (is_string($tinyMce))
            trigger_error($tinyMce, E_USER_ERROR);
        if (!is_null($tinyMce)) {
            $params = $this->_stringToParams($tinyMce->params);
            $elements = strlen($params['extended_elements']) ? explode(',', $params['extended_elements']) : array();
            $invalidElements = strlen($params['invalid_elements']) ? explode(',', $params['invalid_elements']) : array();
            if (in_array('script', $invalidElements))
                array_splice($invalidElements, array_search('script', $invalidElements), 1);
            if (!in_array('style', $elements))
                $elements[] = 'style';
            if (!in_array('script', $elements))
                $elements[] = 'script';
            if (!in_array('div[*]', $elements))
                $elements[] = 'div[*]';
            $params['extended_elements'] = implode(',', $elements);
            $params['invalid_elements'] = implode(',', $invalidElements);
            $tinyMce->params = $this->_paramsToString($params);
            $status = $extensions->save($tinyMce);
            if (is_string($status))
                trigger_error($status, E_USER_ERROR);
        }
        return null;
    }

    private function _updateIndexPage()
    {
        if ($this->_template) {
            $index = dirname(dirname(dirname(dirname(__FILE__)))) .  DS . 'index.php';
            $content = file_get_contents($index);
            file_put_contents($index, $this->_processingContent($content));
        }
    }

    private function _contentUnZip($zipPath)
    {
        $zip = new ZipArchive;
        $tmpdir = dirname($zipPath) . '/' . md5(round(microtime(true)));
        if ($zip->open($zipPath) === TRUE) {
            $zip->extractTo($tmpdir);
            $zip->close();
        }
        JFile::delete($zipPath);
        return $tmpdir;
    }

    private function _replacePlaceholdersForSections($content)
    {
        if ('' == $content)
            return $content;
        $content = preg_replace_callback('/\[section_(\d+)\]/', array( &$this, '_replacerSections'), $content);
        return $content;
    }

    private function _replacerSections($match)
    {
        $id = $match[1];

        if (isset($this->_contentObject['Sections'][$id])){
            $section = $this->_contentObject['Sections'][$id];
        }
        $db = JFactory::getDBO();
        $row = new UpageSectionTable($db);
        $row->title = $section['caption'];
        $row->content = $this->_replacePlaceholdersForImages($section['content']);
        $row->image = $this->_replacePlaceholdersForImages($section['image']);
        if (!$row->check())
            trigger_error('Checking section error', E_USER_ERROR);
        if (!$row->store())
            trigger_error('Store section error', E_USER_ERROR);
        return '[upage_section id=' . $row->id . ']';
    }

    private function _replacePlaceholdersForImages($content, $relative = false) {
        $old = $this->_rootUrl;
        if ($relative)
            $this->_rootUrl = '';
        $content = preg_replace_callback('/\[image_(\d+)\]/', array( &$this, '_replacerImages'), $content);
        $this->_rootUrl = $old;
        return $content;
    }

    private function _replacerImages($match)
    {
        $root = $this->_rootUrl ? $this->_rootUrl . '/' : '';
        $full = $match[0];
        $n = $match[1];
        if (isset($this->_contentObject['Images'][$n])) {
            $imageName = $this->_contentObject['Images'][$n]['fileName'];
            if (file_exists(JPATH_SITE . '/images/editor-content/' . $imageName))
                return $root . 'images/editor-content/' . $imageName;
        }
        return $full;
    }

    private function _uploadFileChunk($uploadPath, $isLast)
    {
        if (!isset($_FILES['chunk']) || !file_exists($_FILES['chunk']['tmp_name'])) {
            trigger_error('Empty chunk data', E_USER_ERROR);
        }
        $contentRange = $_SERVER['HTTP_CONTENT_RANGE'];
        if ('' === $contentRange && '' === $isLast) {
            trigger_error('Empty Content-Range header', E_USER_ERROR);
        }

        $rangeBegin = 0;

        if ($contentRange) {
            $contentRange = str_replace('bytes ', '', $contentRange);
            list($range, $total) = explode('/', $contentRange);
            list($rangeBegin, $rangeEnd) = explode('-', $range);
        }

        $tmpPath = dirname(__FILE__) . '/tmp/' . basename($uploadPath);
        JFolder::create(dirname($tmpPath));

        $f = fopen($tmpPath, 'c');

        if (flock($f, LOCK_EX)) {
            fseek($f, (int) $rangeBegin);
            fwrite($f, file_get_contents($_FILES['chunk']['tmp_name']));

            flock($f, LOCK_UN);
            fclose($f);
        }

        if ($isLast) {
            if (file_exists($uploadPath)) {
                JFile::delete($uploadPath);
            }
            JFolder::create(dirname($uploadPath));
            JFile::move($tmpPath, $uploadPath);
            JFolder::delete(dirname($tmpPath));

            return array(
                'status' => 'done'
            );
        } else {
            return array(
                'status' => 'processed'
            );
        }
    }

    public function getIdsDataParamFromPlugin()
    {
        $db = JFactory::getDBO();
        $query = $db->getQuery(true);
        $query->select('params')->from('#__extensions')
            ->where('type = ' . $db->quote('plugin'))
            ->where('element = ' . $db->quote('themlerexportimport'));
        $db->setQuery($query);
        $parameters = $this->_stringToParams($db->loadResult());

        $idsData = '';
        if (isset($parameters['idsData']))
            $idsData = $parameters['idsData'];
        return unserialize($idsData);
    }

    public function setIdsDataParamToPlugin($idsData)
    {
        $db = JFactory::getDBO();
        $query = $db->getQuery(true);
        $query->select('params')->from('#__extensions')
            ->where('type = ' . $db->quote('plugin'))
            ->where('element = ' . $db->quote('themlerexportimport'));
        $db->setQuery($query);
        $parameters = $this->_stringToParams($db->loadResult());

        $parameters['idsData'] = $idsData;

        $query = $db->getQuery(true);
        $query->update('#__extensions')->set(
            $db->quoteName('params') . '=' .
            $db->quote($this->_paramsToString($parameters)))
            ->where('type = ' . $db->quote('plugin'))
            ->where('element = ' . $db->quote('themlerexportimport'));

        $db->setQuery($query);
        $db->query();
    }

    private function _getPropertyValue($property, $a = array(), $default = '')
    {
        if (array_key_exists($property, $a))
            return $a[$property];
        return $default;
    }

    private function _paramsToString($params)
    {
        $registry = new JRegistry();
        $registry->loadArray($params);
        return $registry->toString();
    }

    private function _stringToParams($string)
    {
        $registry = new JRegistry();
        $registry->loadString($string);
        return $registry->toArray();
    }
}