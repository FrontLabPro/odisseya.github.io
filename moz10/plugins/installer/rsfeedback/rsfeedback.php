<?php
/**
* @package RSFeedback!
* @copyright (C) 2015 www.rsjoomla.com
* @license GPL, http://www.gnu.org/copyleft/gpl.html
*/

defined('_JEXEC') or die;

class plgInstallerRSFeedback extends JPlugin
{
	public function onInstallerBeforePackageDownload(&$url, &$headers)
	{
		$uri 	= JUri::getInstance($url);
		$parts 	= explode('/', $uri->getPath());
		
		if ($uri->getHost() == 'www.rsjoomla.com' && in_array('com_rsfeedback', $parts)) {
			if (!file_exists(JPATH_ADMINISTRATOR.'/components/com_rsfeedback/helpers/rsfeedback.php')) {
				return;
			}
			
			if (!file_exists(JPATH_ADMINISTRATOR.'/components/com_rsfeedback/helpers/version.php')) {
				return;
			}
			
			// Load our config
			require_once JPATH_ADMINISTRATOR.'/components/com_rsfeedback/helpers/rsfeedback.php';
			
			// Load our version
			require_once JPATH_ADMINISTRATOR.'/components/com_rsfeedback/helpers/version.php';
			
			// Load language
			JFactory::getLanguage()->load('plg_installer_rsfeedback');
			
			// Get the version
			$version = new RSFeedbackVersion;
			
			// Get the update code
			$code = RSFeedbackHelper::getConfig('global_register_code');
			
			// No code added
			if (!strlen($code)) {
				JFactory::getApplication()->enqueueMessage(JText::_('PLG_INSTALLER_RSFEEDBACK_MISSING_UPDATE_CODE'), 'warning');
				return;
			}
			
			// Code length is incorrect
			if (strlen($code) != 20) {
				JFactory::getApplication()->enqueueMessage(JText::_('PLG_INSTALLER_RSFEEDBACK_INCORRECT_CODE'), 'warning');
				return;
			}
			
			// Compute the update hash			
			$uri->setVar('hash', md5($code.$version->key));
			$uri->setVar('domain', JUri::getInstance()->getHost());
			$uri->setVar('code', $code);
			$url = $uri->toString();
		}
	}
}
