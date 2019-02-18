<?php

defined('JPATH_BASE') or die();

jimport('joomla.form.formfield');

class JFormFieldExport extends JFormField 
{

    var $type = 'export';

    function getInput() {
        ob_start();

        $root = dirname(dirname((JURI::current())));
        $action = $root . '/plugins/content/themlerexportimport/core/index.php?action=export';
        ?>

        <button name="<?php echo $this->name; ?>" id="<?php echo $this->id; ?>" class="btn"><?php echo JText::_('PLG_CONTENT_THEMLEREXPORTIMPORT_EXPORTBUTTON_TEXT'); ?></button>
        <script>
            jQuery(function ($) {
                $('#<?php echo $this->id; ?>').click(function(e) {
                    e.preventDefault();
                    var count = parseInt($('input[id*="articlesnumber"]').val());
                    var iframe = document.getElementById('tempo-frame');
                    var href = '<?php echo $action; ?>' + '&count=' + count;
                    if (iframe) {
                        iframe.parentNode.removeChild(iframe);
                    }
                    iframe = document.createElement('iframe');
                    iframe.setAttribute('id', 'tempo-frame');
                    iframe.setAttribute('style', 'position:absolute;width:10px;height:10px;top:-1000px;left:-1000px;');
                    iframe.onload = function () {
                        var download = iframe.contentDocument.createElement('a');
                        download.setAttribute('href', href);
                        iframe.contentDocument.body.appendChild(download);
                        download.click();
                    };
                    document.body.appendChild(iframe);
                });
            });
        </script>
<?php
        return ob_get_clean();
	}
}