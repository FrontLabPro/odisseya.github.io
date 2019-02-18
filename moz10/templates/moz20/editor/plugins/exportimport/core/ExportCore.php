<?php

require_once dirname(__FILE__) . '/Mappers.php';

class ExportCore
{

    public static $imagesContentObject = array();
    public static $sectionsContentObject = array();
    public static $imagesContentFolder;

    private $_rootUrl;
    private $_tmpPath;

    private $_limit;
    private $_template;
    private $_plugin;

    public function __construct($data) {
        jimport('joomla.filesystem.folder');
        jimport('joomla.filesystem.file');

        $this->_tmpPath = JPATH_SITE . '/tmp';
        if (!file_exists($this->_tmpPath))
            JFolder::create($this->_tmpPath);

        $this->_limit = isset($data['count']) ? (int)$data['count'] : 100;
        $this->_template = isset($data['template']) ? $data['template'] : '';
        $this->_plugin = isset($data['plugin']) ? true : false;

        if (!$this->_template || $this->_plugin)
            $this->_rootUrl = dirname(dirname(dirname(dirname(dirname(JURI::current())))));
        else
            $this->_rootUrl = dirname(dirname(dirname(dirname(JURI::current()))));

    }

    public function export()
    {
        $contentFolder = $this->_tmpPath . '/content';
        if (file_exists($contentFolder))
            JFolder::delete($contentFolder);

        JFolder::create($contentFolder);
        $contentImagesFolder = $contentFolder . '/images';
        JFolder::create($contentImagesFolder);

        ExportCore::$imagesContentFolder = $contentImagesFolder;

        $result = array();

        $state = 1;

        $db = JFactory::getDBO();
        $db->setQuery("select * from #__content where state = '" . $state . "' ORDER BY modified DESC LIMIT 0, " . $this->_limit);
        $list = $db->loadObjectList();

        jimport('joomla.application.categories');
        $categories = array();
        $categoriesObj = JCategories::getInstance('Content', array());

        $posts = array();
        foreach($list as $item) {
            $post = array();
            $post['caption'] = $item->title;

            $text = $item->introtext;
            if ('' != $item->fulltext)
                $text .= '<!--CUT-->' . $item->fulltext;

            $text = $this->proccessImages($text);

            $post['content'] = $text;

            $images = json_decode($item->images, true);

            $imageIntro = isset($images['image_intro']) ? $images['image_intro'] : '';
            $post['image'] = $this->_proccessImage($imageIntro, $imageIntro);
            $fullImageIntro = isset($images['image_fulltext']) ? $images['image_fulltext'] : '';
            $post['fullImage'] = $this->_proccessImage($fullImageIntro, $fullImageIntro);

            $post['categories'] = '[category_' . $item->catid . ']';
            if (!isset($categories[$item->catid])) {
                $categoryObj   = $categoriesObj->get($item->catid);
                $category['caption'] = $categoryObj->title;
                $categories[$item->catid] = $category;
            }
            $posts[$item->id] = $post;
        }
        $result['Posts'] = $posts;
        $result['Categories'] = $categories;
        $result['Images'] = ExportCore::$imagesContentObject;
        $result['Sections'] = ExportCore::$sectionsContentObject;

        if ($this->_template) {
            $exportData = $this->exportMenusAndModules($this->_template);
            $result['Menus']  = $exportData['menus'];
            $result['Widgets']  = $exportData['widgets'];
        }
        if (!defined('JSON_PRETTY_PRINT')) {
            define('JSON_PRETTY_PRINT', 128);
        }
        $jsonStr = json_encode($result, JSON_PRETTY_PRINT);
        JFile::write($contentFolder . '/content.json', $jsonStr);

        if (!$this->_template || $this->_plugin) {
            $zipFile = $this->_createContentZip($contentFolder, 'content.zip');
            $this->_outPutToBrowser($zipFile);
            $this->clearTempData();
        } else {
            return $contentFolder;
        }
    }

    public function exportMenusAndModules($template)
    {
        jimport('joomla.application.module.helper');
        JFactory::$application = JApplication::getInstance('site');

        $pathToManifest = JPATH_SITE . '/templates/' . $template . '/templateDetails.xml';
        $modules = PluginExportImport_Data_Mappers::get('module');
        if (file_exists($pathToManifest)) {
            $menuModules = array();
            $xml = simplexml_load_file($pathToManifest);
            if (isset($xml->positions[0])) {
                foreach ($xml->positions[0] as $position) {
                    $finds = $modules->find(array('published' => '1', 'position' => (string)$position, 'module' => 'mod_menu'));
                    foreach ($finds as $mod)
                        $menuModules[] =  array('position' => (string)$position, 'object' => $mod);
                }
            }
        }

        $menuMapper = PluginExportImport_Data_Mappers::get('menu');
        $menus = array();
        $widgets = array();
        $menuTypes = array();
        if (count($menuModules) > 0) {
            $homeSetted = false;
            foreach ($menuModules as $key => $module) {
                $params = new JRegistry;
                $params->loadString($module['object']->params);
                $res = $menuMapper->find(array('menutype' => $params->get('menutype')));

                if (count($res) < 1) continue;

                $menuType = 'ct-' . $res[0]->menutype;
                if (!in_array($menuType, $menuTypes)) {
                    $menu = array();
                    $menu['caption'] = 'Content / ' . $res[0]->title;
                    $menu['positions'] = '';
                    $menu['name'] = $menuType;
                    array_push($menuTypes, $menu['name']);

                    $menu['items'] = array();

                    $menuItemMapper = PluginExportImport_Data_Mappers::get('menuItem');
                    $menuitems = $menuItemMapper->find(array('menu' => $res[0]->menutype));
                    if (count($menuitems) < 1) continue;
                    foreach($menuitems as $i => $menuitem) {
                        $item = array();
                        $item['caption'] = $menuitem->title;
                        $item['name'] = 'ct-' . $menuitem->alias;
                        $item['href'] = '';
                        $item['type'] = '';
                        if ($menuitem->type == 'url') {
                            $item['href'] = $menuitem->link;
                        }
                        if (preg_match('/option=com_content&view=article&id=(\d+)/', $menuitem->link, $matches)) {
                            if (!$homeSetted && $menuitem->home == '1') {
                                $item['default'] = '1';
                                $homeSetted = true;
                            }
                            $item['href'] = '[post_' . $matches[1] . ']';
                            $item['type'] = 'single-article';
                        }
                        if (preg_match('/option=com_content&view=category&layout=blog&id=(\d+)/', $menuitem->link, $matches)) {
                            if (!$homeSetted && $menuitem->home == '1') {
                                $item['default'] = '1';
                                $homeSetted = true;
                            }
                            $item['href'] = '[category_' . $matches[1] . ']';
                            $item['type'] = 'category-blog-layout';
                        }
                        if ($menuitem->parent_id != 1)
                            $item['parent'] = $menuitem->parent_id;
                        $menu['items'][$menuitem->id] = $item;
                    }
                    $menus[$key + 1] = $menu;
                }
                // create widget
                $widget = array();
                $widget['title'] = $module['object']->title;
                $widget['showTitle'] = true;
                $widget['position'] = $module['position'];
                $widget['type'] = 'menu';
                $widget['menu'] = $menuType;
                $widgets[$key + 1] = $widget;
            }
        }
        JFactory::$application = JApplication::getInstance('administrator');
        return array('menus' => $menus, 'widgets' => $widgets);
    }

    private function _outPutToBrowser($file)
    {
        header('Content-Type: application/zip');
        header('Content-Disposition: inline; filename="content.zip"');
        header('Pragma: no-cache');

        @readfile($file);
    }

    public function proccessImages($content)
    {
        if ('' == $content)
            return $content;

        $regexs = array('/src=["\']?([^\'"]+)["\']/', '/url\((["\']?([^\'"]*?)["\']?)\)/', '/image=["\']?([^\'"]*)["\']/');
        foreach($regexs as $regex){
            $content = preg_replace_callback($regex, array( &$this, '_proccessImages'), $content);
        }
        return $content;
    }

    private function _proccessImages($match)
    {
        $full = $match[0];
        $path = $match[1];

        if (preg_match('/^' . htmlentities('"') . '(.+)' . htmlentities('"') .'$/', $path, $newmatch)) {
            $path = $newmatch[1];
        }
        if (($result = $this->_proccessImage($path, $full)) != false)
            return $result;

        return $full;
    }

    private function _proccessImage($path, $full)
    {
        $root = $this->_rootUrl;
        if (preg_match('/^http/', $path) && strpos($full, $root) == false )
            return $full;

        if ('' !== $path) {
            foreach(ExportCore::$imagesContentObject as $key => $object)
                if ($object['fileName'] == basename($path))
                    return str_replace($path, '[image_' . $key . ']', $full);

            if (file_exists(JPATH_SITE . '/' . $path)) {
                JFile::copy(JPATH_SITE . '/' . $path, ExportCore::$imagesContentFolder . '/' . basename($path));
                ExportCore::$imagesContentObject[count(ExportCore::$imagesContentObject) + 1] = array('fileName' => basename($path));
                return str_replace($path, '[image_' . count(ExportCore::$imagesContentObject) . ']', $full);
            }

            if (strpos($path, $root) !== -1) {
                $file = str_replace($root, JPATH_SITE, $path);
                if (file_exists($file)) {
                    JFile::copy($file, ExportCore::$imagesContentFolder . '/' . basename($file));
                    ExportCore::$imagesContentObject[count(ExportCore::$imagesContentObject) + 1] = array('fileName' => basename($file));
                    return str_replace($path, '[image_' . count(ExportCore::$imagesContentObject) . ']', $full);
                }
            }
        }
        return $full;
    }

    private function _createContentZip($folderToZip, $zipName = 'content.zip')
    {
        $rootPath = realpath($folderToZip);
        $zipPath = dirname($rootPath) . '/' . $zipName;
        $zip = new ZipArchive();
        $zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE);

        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($rootPath),
            RecursiveIteratorIterator::LEAVES_ONLY
        );

        foreach ($files as $name => $file)
        {
            // Skip directories (they would be added automatically)
            if (!$file->isDir())
            {
                // Get real and relative path for current file
                $filePath = $file->getRealPath();
                $relativePath = substr($filePath, strlen($rootPath) + 1);

                // Add current file to archive
                $zip->addFile($filePath, $relativePath);
            }
        }

        $zip->close();

        return $zipPath;
    }

    public function clearTempData()
    {
        JFolder::delete($this->_tmpPath);
        JFolder::create($this->_tmpPath);
    }
}