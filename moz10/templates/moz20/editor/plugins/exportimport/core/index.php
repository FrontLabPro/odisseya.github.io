<?php

define('_JEXEC', 1);
define('DS', DIRECTORY_SEPARATOR);

define('JPATH_BASE', dirname(dirname(dirname(dirname(dirname(__FILE__))))) . DS . 'administrator');
require_once JPATH_BASE . DS . 'includes' . DS . 'defines.php';
require_once JPATH_BASE . DS . 'includes' . DS . 'framework.php';
require_once JPATH_BASE . DS . 'includes' . DS . 'helper.php';
$prefix = version_compare(JVERSION, '3.9', '>=') ? 'sub' : '';
require_once JPATH_BASE . DS . 'includes' . DS . $prefix . 'toolbar.php';
$app = JFactory::getApplication('administrator');

$data = array_merge($_GET, $_POST);

if (isset($data['action']))
{
    switch($data['action']) {
        case 'export':
            require_once 'ExportCore.php';
            $core = new ExportCore($data);
            echo $core->export();
            break;
        case 'import':
            require_once 'ImportCore.php';
            $core = new ImportCore($data);
            echo $core->import();
            break;
        default:
    }
}