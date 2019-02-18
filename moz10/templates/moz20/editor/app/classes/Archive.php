<?php

class Archive
{
    public function __construct() {}

    public function getArchive($base, $oldThemeName, $newThemeName, $options = array())
    {
        if (class_exists('ZipArchive'))
            $this->_nativeArchiving($base, $oldThemeName, $newThemeName, $options);
        else
            $this->_joomlaArchiving($base, $oldThemeName, $newThemeName, $options);
    }

    private function _nativeArchiving($base, $oldThemeName, $newThemeName, $options = array())
    {
        $tmp = dirname($base) . '/tmp';
        Helper::createDir($tmp);

        $dest = $tmp . '/' . sha1(microtime());
        Helper::createDir($dest);

        Helper::copyDir($base, $dest);

        $lowerOldThemeName = strtolower($oldThemeName);
        $lowerNewThemeName = strtolower($newThemeName);
        $archiveName = $lowerNewThemeName . '.zip';

        $rootPath = realpath($dest);
        $zipPath = dirname($rootPath) . '/' . $archiveName;
        $zip = new ZipArchive();
        $zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE);

        $flags = FilesystemIterator::CURRENT_AS_FILEINFO | FilesystemIterator::SKIP_DOTS | FilesystemIterator::UNIX_PATHS;
        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($rootPath, $flags),
            RecursiveIteratorIterator::LEAVES_ONLY
        );

        foreach ($files as $file)
        {
            // Skip directories (they would be added automatically)
            if (!$file->isDir())
            {
                $name = $files->getSubPathname();
                if (preg_match('/^(tmp)/', $name))
                    continue;
                if (!$options['includeEditor'] && (preg_match('/^(app|editor)/', $name) || 'fields/designer.php' === $name)) {
                    continue;
                }
                if (preg_match('/^(data)/', $name) && 'data/install.php' != $name) {
                    continue;
                }
                $filePath = $file->getRealPath();
                $data = Helper::readFile($files->getPathName());
                $info = pathinfo($name);
                $dirNameParts = explode('/', $info['dirname']);
                $type = '';
                if (count($dirNameParts) > 2 && 'html' == $dirNameParts[0]) {
                    $componentParts = explode('_', $dirNameParts[1]);
                    $type = array_shift($componentParts);
                }
                $parts      = explode('.', $info['basename']);
                $fname      = $parts[0];
                if (!$options['includeEditor'] && ('com' === $type || 'mod' === $type || 'pagination' === $fname || 'error' === $fname
                        || 'modules' === $fname || 'index.php' === $name || 'modrender.php' === $name)) {
                    $data = preg_replace('/\<\?php\s+\/\*BEGIN_EDITOR_OPEN\*\/([\s\S]*?)\/\*BEGIN_EDITOR_CLOSE\*\/\s+\?\>/s', '', $data);
                    $data = preg_replace('/<\?php\s+\/\*END_EDITOR_OPEN\*\/([\s\S]*?)\/\*END_EDITOR_CLOSE\*\/\s+\?\>/s', '', $data);
                }
                if ('language/en-GB/en-GB.tpl_' . $lowerOldThemeName . '.ini' === $files->getSubPathname()) {
                    $newFilePathname = dirname($filePath) . '/en-GB.tpl_' . $lowerNewThemeName . '.ini';
                    Helper::renameFile($filePath, $newFilePathname);
                    $filePath = $newFilePathname;
                }
                if ('language/en-GB/en-GB.tpl_' . $lowerOldThemeName . '.sys.ini' === $files->getSubPathname()) {
                    $data = str_replace(strtoupper($lowerOldThemeName), strtoupper($lowerNewThemeName), $data);
                    $newFilePathname = dirname($filePath) . '/en-GB.tpl_' . $lowerNewThemeName . '.sys.ini';
                    Helper::renameFile($filePath, $newFilePathname);
                    $filePath = $newFilePathname;
                }
                if ('templateDetails.xml' === $files->getSubPathname()) {
                    $xml = simplexml_load_string($data);
                    $xml->name = $newThemeName;
                    $path = $xml->config->fields['addfieldpath'];
                    $xml->config->fields['addfieldpath'] = str_replace($lowerOldThemeName, $lowerNewThemeName, $path);
                    foreach($xml->languages->language as $node) {
                        $language = $node[0];
                        $node[0] = str_replace($lowerOldThemeName, $lowerNewThemeName, $language);
                    }
                    if (!$options['includeEditor']) {
                        $newChildren = array();
                        foreach($xml->files->children() as  $type => $filesName) {
                            if (($filesName == 'app' || $filesName == 'editor')) {
                                continue;
                            }
                            $newChildren[] = array('type' => $type, 'name' => $filesName->__toString());
                        }
                        unset($xml->files->folder);
                        foreach($newChildren as $child) {
                            if ($child['type'] == 'folder')
                                $xml->files->addChild($child['type'], $child['name']);
                        }
                        list($designer) = $xml->xpath('//field[@type="designer"]');
                        unset($designer[0]);
                    }
                    // Save dom to xml file
                    if (class_exists('DOMDocument')) {
                        $dom = new DOMDocument('1.0', 'utf-8');
                        $dom->preserveWhiteSpace = false;
                        $dom->formatOutput = true;
                        $dom->loadXML($xml->asXML());
                        $data = $dom->saveXML();
                    } else {
                        $data = $xml->asXML();
                    }
                }
                Helper::writeFile($filePath, $data);
                // Get real and relative path for current file
                $relativePath = $lowerNewThemeName . '/' . substr($filePath, strlen($rootPath) + 1);

                // Add current file to archive
                $zip->addFile($filePath, str_replace('\\','/', $relativePath));
            }
        }
        $core = null;
        $exportCoreFile = JPATH_PLUGINS . '/content/themlerexportimport/core/ExportCore.php';
        if ($options['includeContent'] && file_exists($exportCoreFile)) {
            require_once $exportCoreFile;
            try {
                $core = new ExportCore(array('template' => $lowerOldThemeName));
                $folder = $core->export();

                if (file_exists($folder) && !Helper::isEmptyDir($folder)) {
                    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($folder, $flags));
                    foreach ($iterator as $fileInfo) {
                        if (!$file->isDir()) {
                            $filePath = $fileInfo->getRealPath();
                            $relativePath = $lowerNewThemeName . '/data/' . substr($filePath, strlen(realpath($folder)) + 1);
                            $zip->addFile($filePath, str_replace('\\','/', $relativePath));
                        }
                    }
                }
            } catch(Exception $e) {}
        }

        $zip->close();

        header('Content-Type: application/zip');
        header('Content-Disposition: inline; filename="'. $archiveName .'"');
        header('Pragma: no-cache');

        Helper::outputFile($zipPath);

        // clear tmp folders
        if ($core != null)
            $core->clearTempData();
        Helper::removeDir($tmp);
    }

    private function _joomlaArchiving($base, $oldThemeName, $newThemeName, $options = array())
    {
        $lowerOldThemeName = strtolower($oldThemeName);
        $lowerNewThemeName = strtolower($newThemeName);
        $zipFilesArray = array();
        $flags = FilesystemIterator::CURRENT_AS_FILEINFO | FilesystemIterator::SKIP_DOTS | FilesystemIterator::UNIX_PATHS;
        $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($base, $flags));
        foreach ($iterator as $fileInfo) {
            if (preg_match('/^(tmp)/', $iterator->getSubPathname()))
                continue;
            if (!$options['includeEditor'] && (preg_match('/^(app|editor)/', $iterator->getSubPathname()) ||
                    'fields/designer.php' === $iterator->getSubPathname()))
                continue;
            if (preg_match('/^(data)/', $iterator->getSubPathname()) && 'data/install.php' != $iterator->getSubPathname())
                continue;
            $name = $iterator->getSubPathname();
            $data = Helper::readFile($fileInfo->getPathName());
            $info = pathinfo($name);
            $dirNameParts = explode('/', $info['dirname']);
            $type = '';
            if (count($dirNameParts) > 2 && 'html' == $dirNameParts[0]) {
                $componentParts = explode('_', $dirNameParts[1]);
                $type = array_shift($componentParts);
            }
            $parts      = explode('.', $info['basename']);
            $fname      = $parts[0];
            if (!$options['includeEditor'] && ('com' === $type || 'mod' === $type || 'pagination' === $fname || 'error' === $fname
                || 'modules' === $fname || 'index.php' === $name || 'modrender.php' === $name)) {
                $data = preg_replace('/\<\?php\s+\/\*BEGIN_EDITOR_OPEN\*\/([\s\S]*?)\/\*BEGIN_EDITOR_CLOSE\*\/\s+\?\>/s', '', $data);
                $data = preg_replace('/<\?php\s+\/\*END_EDITOR_OPEN\*\/([\s\S]*?)\/\*END_EDITOR_CLOSE\*\/\s+\?\>/s', '', $data);
            }
            if ('language/en-GB/en-GB.tpl_' . $lowerOldThemeName . '.ini' === $iterator->getSubPathname()) {
                $name = 'language/en-GB/en-GB.tpl_' . $lowerNewThemeName . '.ini';
            }
            if ('language/en-GB/en-GB.tpl_' . $lowerOldThemeName . '.sys.ini' === $iterator->getSubPathname()) {
                $name = 'language/en-GB/en-GB.tpl_' . $lowerNewThemeName . '.sys.ini';
                $data = str_replace(strtoupper($lowerOldThemeName), strtoupper($lowerNewThemeName), $data);
            }
            if ('templateDetails.xml' === $iterator->getSubPathname()) {
                $xml = simplexml_load_string($data);
                $xml->name = $newThemeName;
                $path = $xml->config->fields['addfieldpath'];
                $xml->config->fields['addfieldpath'] = str_replace($lowerOldThemeName, $lowerNewThemeName, $path);
                foreach($xml->languages->language as $node) {
                    $language = $node[0];
                    $node[0] = str_replace($lowerOldThemeName, $lowerNewThemeName, $language);
                }
                if (!$options['includeEditor']) {
                    $newChildren = array();
                    foreach($xml->files->children() as  $type => $filesName) {
                        if (($filesName == 'app' || $filesName == 'editor')) {
                            continue;
                        }
                        $newChildren[] = array('type' => $type, 'name' => $filesName->__toString());
                    }
                    unset($xml->files->folder);
                    foreach($newChildren as $child) {
                        if ($child['type'] == 'folder')
                            $xml->files->addChild($child['type'], $child['name']);
                    }
                    list($designer) = $xml->xpath('//field[@type="designer"]');
                    unset($designer[0]);
                }
                // Save dom to xml file
                if (class_exists('DOMDocument')) {
                    $dom = new DOMDocument('1.0', 'utf-8');
                    $dom->preserveWhiteSpace = false;
                    $dom->formatOutput = true;
                    $dom->loadXML($xml->asXML());
                    $data = $dom->saveXML();
                } else {
                    $data = $xml->asXML();
                }
            }
            $zipFilesArray[] = array('name' => $lowerNewThemeName . '/' . $name, 'data' => $data);
        }

        $exportCoreFile = JPATH_PLUGINS . '/content/themlerexportimport/core/ExportCore.php';
        if ($options['includeContent'] && file_exists($exportCoreFile)) {
            require_once $exportCoreFile;
            try {
                $core = new ExportCore(array('template' => $lowerOldThemeName));
                $folder = $core->export();
                $files = Helper::enumerateRecursive($folder);
                foreach ($files as $filePath => $content)
                    $zipFilesArray[] = array('name' => $lowerNewThemeName . '/data/' . $filePath, 'data' => $content);
                $core->clearTempData();
            } catch(Exception $e) {}
        }

        $tmp = $base . '/tmp';
        Helper::createDir($tmp);

        jimport('joomla.filesystem.archive');
        jimport('joomla.filesystem.file');
        $archiveName = $lowerNewThemeName . '.zip';
        $zip = JArchive::getAdapter('zip');
        $zip->create($tmp . '/' . $archiveName, $zipFilesArray);

        header('Content-Type: application/zip');
        header('Content-Disposition: inline; filename="'. $archiveName .'"');
        header('Pragma: no-cache');

        Helper::outputFile($tmp . '/' . $archiveName);
        Helper::removeDir($tmp);
    }
}