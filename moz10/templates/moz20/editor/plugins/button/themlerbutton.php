<?php

defined('_JEXEC') or die;

class PlgButtonThemlerbutton extends JPlugin
{

    private $_cmsPath;
    private $_isAdmin;

    public function __construct(& $subject, $config)
    {
        parent::__construct($subject, $config);
        $this->loadLanguage();

        $app = JFactory::getApplication();
        $this->_isAdmin = $app->isAdmin();
        $this->_cmsPath = $this->_isAdmin ? dirname(dirname(JPATH_THEMES)) : dirname(JPATH_THEMES);
    }

    public function onDisplay($name)
    {
        $app = JFactory::getApplication('administrator');
        $domain = JRequest::getCmd('domain', '');
        $option = JRequest::getCmd('option');
        $aid = JRequest::getCmd('id', '');
        if(!in_array($option, array('com_content')) || '' == $aid || !$this->_isAdmin)
            return;

        $themlerJs = $this->_getThemlerJs();

        if ($themlerJs == '')
            return;

        $doc = JFactory::getDocument();
        $doc->addScriptDeclaration($themlerJs);

        $button = new JObject;
        $button->set('class', 'btn themler-button');
        $button->set('title', JText::_('PLG_EDITORS-XTD_THEMLERBUTTON_BUTTON_TITLE'));
        $button->set('text', JText::_('PLG_EDITORS-XTD_THEMLERBUTTON_BUTTON_TEXT'));
        $button->set('name', 'edit');
        $button->set('onclick', 'runThemler(); return false;');
        $button->link = '#';

        return $button;
    }

    private function _getActiveTemplateStyle()
    {
        $db = JFactory::getDBO();
        $query = $db->getQuery(true);
        $query->select('*');
        $query->from('#__template_styles');
        $query->where('client_id = \'0\'');
        $query->where('home=1');
        $db->setQuery($query);
        return $db->loadObject();
    }

    private function _checkingActiveTheme($template)
    {
        $themeDir = $this->_cmsPath . '/templates/' . $template;
        $projectFile = $themeDir . '/app/project.json';

        if (!file_exists($projectFile))
            return array( 'message' => JText::_('PLG_EDITORS-XTD_THEMLERBUTTON_NOTHEMLER_THEME'), 'startEdit' => false, 'show' => false);

        $pluginFile = $themeDir . '/plugins/content.zip';
        if (!file_exists($pluginFile))
            return array( 'message' => JText::_('PLG_EDITORS-XTD_THEMLERBUTTON_ACTIVETHEME_NOPLUGIN'), 'startEdit' => false, 'show' => true);

        return array( 'message' => '', 'startEdit' => true, 'show' => true);
    }

    private  function _getThemlerJs()
    {
        $styleObject = $this->_getActiveTemplateStyle();
        $templateName = $styleObject->template;
        $result = $this->_checkingActiveTheme($templateName);

        if (!$result['show'])
            return '';

        $url = '';
        $message = '';
        if (true === $result['startEdit']) {
            $versionFile = $this->_cmsPath . '/templates/' . $templateName . '/app/themler.version';
            $version = file_exists($versionFile) ? '&ver=' . file_get_contents($versionFile) : '' ;
            $articleId = JURI::getInstance()->getVar('id');
            $url = JURI::root() . 'administrator/index.php?option=com_templates&view=style&layout=edit&id=' .
                $styleObject->id . '&editor=1&theme=' . $templateName . $version . '&postId=' . $articleId;

            $session = JFactory::getSession();
            $registry = $session->get('registry');
            if (null !== $registry)
                $registry->set('com_templates.edit.style.id', $styleObject->id);
        } else {
            $message = $result['message'];
        }

        $js = <<<EOF
function runThemler()
{
    var url = '$url';
    if (url){
        window.open(url, '_blank');
    } else {
        alert('$message');
    }
}
EOF;
        return $js;
    }
}