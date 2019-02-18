<?php

/**
 * Base data mapper class.
 */
class PluginExportImport_Data_Mapper
{
    protected $_db;
    protected $_entity;
    protected $_table;
    protected $_pk;

    public function __construct($entity, $table, $pk)
    {
        $this->_entity = $entity;
        $this->_table = $table;
        $this->_pk = $pk;
        $this->_db = JFactory::getDBO();
    }

    public function exists($filter = array())
    {
        $row = $this->findOne($filter);
        if (is_string($row))
            return $this->_error($list, 1);
        return !is_null($row);
    }

    public function findOne($filter = array())
    {
        $filter['limit'] = 1;
        $list = $this->find($filter);
        if (is_string($list))
            return $this->_error($list, 1);
        if (0 == count($list)) {
            $null = null;
            return $null;
        }
        return $list[0];
    }

    public function find($filter = array())
    {
        $result = $this->_loadObjects();
        return $result;
    }


    public function fetch($id)
    {
        $row = JTable::getInstance($this->_entity);
        $row->load($id);
        return $row;
    }

    public function delete($id)
    {
        $row = $this->fetch($id);
        if (!$row->delete($id))
            return $this->_error($row->getError(), 1);
        return null;
    }

    public function save($row)
    {
        if (!$row->check())
            return $this->_error($row->getError(), 1);
        if (!$row->store())
            return $this->_error($row->getError(), 1);
        if (!$row->checkin())
            return $this->_error($row->getError(), 1);
        return null;
    }

    protected function _create()
    {
        $result = JTable::getInstance($this->_entity);
        return $result;
    }

    protected function _loadObjects($where = array(), $limit = 0)
    {
        $query = 'SELECT * FROM #__' . $this->_table
            . (count($where) ? ' WHERE ' . implode(' AND ', $where) : '')
            . ' ORDER BY ' . $this->_pk;
        $this->_db->setQuery($query, 0, $limit);
        $rows = $this->_db->loadAssocList();
        if ($this->_db->getErrorNum())
            return $this->_error($this->_db->stderr(), 1);
        $result = array();
        for ($i = 0; $i < count($rows); $i++) {
            $result[$i] = JTable::getInstance($this->_entity);
            $result[$i]->bind($rows[$i]);
        }
        return $result;
    }

    protected function _cascadeDelete($mapper, $filter)
    {
        $menuItems = PluginExportImport_Data_Mappers::get($mapper);
        $itemsList = $menuItems->find($filter);
        if (is_string($itemsList))
            return $this->_error($itemsList, 1);
        foreach ($itemsList as $item) {
            $status = $menuItems->delete($item->id);
            if (is_string($status))
                return $this->_error($status, 1);
        }
        return null;
    }

    protected function _error($error, $code)
    {
        PluginExportImport_Data_Mappers::error($error, $code);
    }
}

class PluginExportImport_Data_CategoryMapper extends PluginExportImport_Data_Mapper
{
    public function __construct()
    {
        parent::__construct('Category', 'categories', 'id');
    }

    public function find($filter = array())
    {
        $where = array();
        if (isset($filter['id']))
            $where[] = 'id = ' . intval($filter['id']);
        if (isset($filter['extension']))
            $where[] = 'extension = ' . $this->_db->Quote($filter['extension']);
        if (isset($filter['title']))
            $where[] = 'title = ' . $this->_db->Quote($filter['title']);

        $result = $this->_loadObjects($where, isset($filter['limit']) ? (int)$filter['limit'] : 0, true);
        return $result;
    }

    public function create()
    {
        $row = $this->_create();
        $row->setLocation(1, 'last-child');
        $row->published = 1;
        $row->params = '{"category_layout":"","image":""}';
        $row->metadata = '{"author":"","robots":""}';
        $row->language = '*';
        return $row;
    }

    public function delete($id)
    {
        $status = $this->_cascadeDelete('content', array('category' => $id));
        if (is_string($status))
            return $this->_error($status, 1);
        return parent::delete($id);
    }

    public function save($category)
    {
        $status = parent::save($category);
        if (is_string($status))
            return $this->_error($status, 1);
        if (!$category->rebuildPath($category->id))
            return $this->_error($category->getError(), 1);
        if (!$category->rebuild($category->id, $category->lft, $category->level, $category->path))
            return $this->_error($category->getError(), 1);
        return null;
    }
}

class PluginExportImport_Data_ContentMapper extends PluginExportImport_Data_Mapper
{
    function __construct()
    {
        parent::__construct('content', 'content', 'id');
    }

    function find($filter = array())
    {
        $where = array();
        if (isset($filter['id']))
            $where[] = 'id = ' . intval($filter['id']);
        if (isset($filter['section']))
            $where[] = 'sectionid = ' . intval($filter['section']);
        if (isset($filter['category']))
            $where[] = 'catid = ' . intval($filter['category']);
        if (isset($filter['title']))
            $where[] = 'title = ' . $this->_db->Quote($this->_db->escape($filter['title'], true), false);
        $result = $this->_loadObjects($where, isset($filter['limit']) ? (int)$filter['limit'] : 0);
        return $result;
    }

    function create()
    {
        $row = $this->_create();
        $row->state = '1';
        $row->version = '1';
        $row->language = '*';
        $row->created = JFactory::getDate()->toSql();
        $row->publish_up = $row->created;
        $row->publish_down = $this->_db->getNullDate();
        return $row;
    }

    function save($row)
    {
        JPluginHelper::importPlugin('content');

        $isNew = (bool)$row->id;
        if (!$row->check())
            return $this->_error($row->getError(), 1);
        $dispatcher = JDispatcher::getInstance();
        $result = $dispatcher->trigger('onBeforeContentSave', array($row, $isNew));
        if(in_array(false, $result, true))
            return $this->_error($row->getError(), 1);
        if (!$row->store())
            return $this->_error($row->getError(), 1);
        $row->checkin();
        $row->reorder('catid = ' . (int)$row->catid . ' AND state >= 0');
        $cache = JFactory::getCache('com_content');
        $cache->clean();
        $dispatcher->trigger('onAfterContentSave', array($row, $isNew));
        return null;
    }
}

class PluginExportImport_Data_MenuMapper extends PluginExportImport_Data_Mapper
{
    function __construct()
    {
        parent::__construct('MenuType', 'menu_types', 'id');
    }

    function find($filter = array())
    {
        $where = array();
        if (isset($filter['menutype']))
            $where[] = 'menutype = ' . $this->_db->Quote($this->_db->escape($filter['menutype'], true), false);
        if (isset($filter['title']))
            $where[] = 'title = ' . $this->_db->Quote($this->_db->escape($filter['title'], true), false);
        $result = $this->_loadObjects($where, isset($filter['limit']) ? (int)$filter['limit'] : 0);
        return $result;
    }

    function create()
    {
        $row = $this->_create();
        return $row;
    }

    function delete($id)
    {
        // Delete related records in the modules_menu table.

        // Start with checking whether this menu exists:
        $menu = $this->fetch($id);
        if (is_string($menu))
            return $this->_error($menu, 1);

        // Get the menu:
        $this->_db->setQuery('SELECT menutype FROM #__menu_types WHERE id=' . $this->_db->Quote($id));
        $menutype = $this->_db->loadResult();
        if ($this->_db->getErrorNum())
            return $this->_error($this->_db->stderr(), 1);

        if (is_string($menutype)) {
            // Select items for the specified menu:
            $this->_db->setQuery('SELECT id FROM #__menu WHERE menutype=' . $this->_db->Quote($menutype) . ' ORDER BY id');
            $items = $this->_db->loadColumn(0);
            if ($this->_db->getErrorNum())
                return $this->_error($this->_db->stderr(), 1);

            $items = array_map('intval', $items);

            if (0 < count($items)) {
                // Delete "Only on the pages selected" assignments:
                $this->_db->setQuery('DELETE FROM #__modules_menu WHERE menuid in (' . implode(',', $items) . ')');
                $this->_db->query();
                if ($this->_db->getErrorNum())
                    return $this->_error($this->_db->stderr(), 1);

                // Invert items:
                for ($i = 0, $limit = count($items); $i < $limit; $i++)
                    $items[$i] = -$items[$i];

                // Get the modules that are not shown on the menu items that are about to be deleted:
                $this->_db->setQuery('SELECT moduleid FROM #__modules_menu WHERE menuid in (' . implode(',', $items) . ')');
                $modules = $this->_db->loadColumn(0);
                if ($this->_db->getErrorNum())
                    return $this->_error($this->_db->stderr(), 1);

                $modules = array_unique($modules);

                // delete "On all pages except those selected" assignment:
                $this->_db->setQuery('DELETE FROM #__modules_menu WHERE menuid in (' . implode(',', $items) . ')');
                $this->_db->query();
                if ($this->_db->getErrorNum())
                    return $this->_error($this->_db->stderr(), 1);

                // restore modules "On all pages" state:
                foreach ($modules as $module) {
                    $this->_db->setQuery('SELECT COUNT(*) FROM #__modules_menu WHERE moduleid=' . $this->_db->Quote($module));
                    $count = (int)$this->_db->loadResult();
                    if ($this->_db->getErrorNum())
                        return $this->_error($this->_db->stderr(), 1);

                    if (0 == $count) {
                        $this->_db->setQuery('INSERT INTO #__modules_menu (moduleid, menuid) VALUES (' . $this->_db->Quote($module) . ', 0)');
                        $this->_db->query();
                        if ($this->_db->getErrorNum())
                            return $this->_error($this->_db->stderr(), 1);
                    }
                }
            }
        }
        return parent::delete($id);
    }
}

class PluginExportImport_Data_MenuItemMapper extends PluginExportImport_Data_Mapper
{
    function __construct()
    {
        parent::__construct('Menu', 'menu', 'id');
    }

    function find($filter = array())
    {
        $where = array();
        if (isset($filter['menu']))
            $where[] = 'menutype = ' . $this->_db->Quote($filter['menu']);
        if (isset($filter['title']))
            $where[] = 'title = ' . $this->_db->Quote($filter['title']);
        if (isset($filter['home']))
            $where[] = 'home = ' . $this->_db->Quote($filter['home']);
        if (isset($filter['scope']) && ('site' == $filter['scope'] || 'administrator' == $filter['scope']))
            $where[] = 'client_id = ' . ('site' == $filter['scope'] ? '0' : '1');
        $result = $this->_loadObjects($where, isset($filter['limit']) ? (int)$filter['limit'] : 0);
        return $result;
    }

    function create()
    {
        $row = $this->_create();
        $row->published = '1';
        $row->access = 1;
        $row->language = '*';
        $row->setLocation(1, 'last-child');
        return $row;
    }
}

class PluginExportImport_Data_ModuleMapper extends PluginExportImport_Data_Mapper
{
    function __construct()
    {
        parent::__construct('module', 'modules', 'id');
    }

    function find($filter = array())
    {
        $where = array();
        if (isset($filter['published']))
            $where[] = 'published = ' . $this->_db->Quote($filter['published'], false);
        if (isset($filter['module']))
            $where[] = 'module = ' . $this->_db->Quote($filter['module'], false);
        if (isset($filter['position']))
            $where[] = 'position = ' . $this->_db->Quote($filter['position'], false);
        if (isset($filter['title']))
            $where[] = 'title = ' . $this->_db->Quote($this->_db->escape($filter['title'], true), false);
        if (isset($filter['scope']) && ('site' == $filter['scope'] || 'administrator' == $filter['scope']))
            $where[] = 'client_id = ' . ('site' == $filter['scope'] ? '0' : '1');
        $result = $this->_loadObjects($where, isset($filter['limit']) ? (int)$filter['limit'] : 0);
        return $result;
    }

    function fetch($id)
    {
        $result = parent::fetch($id);
        return $result;
    }

    function delete($id)
    {
        $status = $this->enableOn($id, array());
        if (is_string($status))
            return $status;
        return parent::delete($id);
    }

    function create()
    {
        $row = $this->_create();
        $row->published = 1;
        $row->language = '*';
        $row->showtitle = 1;
        return $row;
    }

    function enableOn($id, $items)
    {
        $query = 'DELETE FROM #__modules_menu WHERE moduleid = ' . $this->_db->Quote($id);
        $this->_db->setQuery($query);
        $this->_db->query();
        if ($this->_db->getErrorNum())
            return $this->_error($this->_db->stderr(), 1);
        foreach ($items as $i) {
            $query = 'INSERT INTO #__modules_menu (moduleid, menuid) VALUES ('
                . $this->_db->Quote($id) . ',' . $this->_db->Quote($i) . ')';
            $this->_db->setQuery($query);
            $this->_db->query();
            if ($this->_db->getErrorNum())
                return $this->_error($this->_db->stderr(), 1);
        }
        return null;
    }

    function disableOn($id, $items)
    {
        $query = 'DELETE FROM #__modules_menu WHERE moduleid = ' . $this->_db->Quote($id);
        $this->_db->setQuery($query);
        $this->_db->query();
        if ($this->_db->getErrorNum())
            return $this->_error($this->_db->stderr(), 1);
        foreach ($items as $i) {
            $query = 'INSERT INTO #__modules_menu (moduleid, menuid) VALUES ('
                . $this->_db->Quote($id) . ',' . $this->_db->Quote('-' . $i) . ')';
            $this->_db->setQuery($query);
            $this->_db->query();
            if ($this->_db->getErrorNum())
                return $this->_error($this->_db->stderr(), 1);
        }
        return null;
    }

    function getAssignment($id)
    {
        $query = 'SELECT menuid FROM #__modules_menu WHERE moduleid = ' . $this->_db->Quote($id);
        $this->_db->setQuery($query);
        $this->_db->query();
        $rows = $this->_db->loadColumn(0);
        if ($this->_db->getErrorNum())
            return $this->_error($this->_db->stderr(), 1);
        return $rows;
    }
}

class PluginExportImport_Data_Mappers
{
    public static function errorCallback($callback, $get = false)
    {
        static $errorCallback;
        if (!$get)
            $errorCallback = $callback;
        return $errorCallback;
    }

    public static function get($name)
    {
        $className = 'PluginExportImport_Data_' . ucfirst($name) . 'Mapper';
        $mapper = new $className();
        return $mapper;
    }

    public static function error($error, $code)
    {
        $null = null;
        $callback = PluginExportImport_Data_Mappers::errorCallback($null, true);
        if (isset($callback))
            call_user_func($callback, $error, $code);
        return $error;
    }
}

class PluginExportImport_Data_ExtensionMapper extends PluginExportImport_Data_Mapper
{
    function __construct()
    {
        parent::__construct('Extension', 'extensions', 'extension_id');
    }

    function find($filter = array())
    {
        $where = array();
        if (isset($filter['element']))
            $where[] = 'element = ' . $this->_db->Quote($this->_db->escape($filter['element'], true), false);
        $result = $this->_loadObjects($where, isset($filter['limit']) ? (int)$filter['limit'] : 0);
        return $result;
    }

    function create()
    {
        $row = $this->_create();
        return $row;
    }
}

class UpageSectionTable extends JTable
{
    public function __construct($db)
    {
        parent::__construct('#__upage_sections', 'id', $db);
    }
}