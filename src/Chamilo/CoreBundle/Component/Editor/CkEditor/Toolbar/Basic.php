<?php
/* For licensing terms, see /license.txt */

namespace Chamilo\CoreBundle\Component\Editor\CkEditor\Toolbar;

use Chamilo\CoreBundle\Component\Editor\Toolbar;

/**
 * Class Basic
 * @package Chamilo\CoreBundle\Component\Editor\CkEditor\Toolbar
 */
class Basic extends Toolbar
{
    /**
     * Default plugins that will be use in all toolbars
     * In order to add a new plugin you have to load it in default/layout/head.tpl
     * @var array
     */
    public $defaultPlugins = array(
        'asciimath',
        'asciisvg',
        'a11yhelp',
        'about',
        'adobeair',
        'ajax',
        'audio',
        'bidi',
        'clipboard',
        'codesnippet',
        'codesnippetgeshi',
        'colorbutton',
        'colordialog',
        'dialog',
        'dialogui',
        'dialogadvtab',
        'div',
        'divarea',
        'docprops',
        'find',
        'flash',
        'font',
        'forms',
        'glossary',
        'iframe',
        'iframedialog',
        'image',
        'image2',
        'indentblock',
        'justify',
        'language',
        'leaflet',
        'lineutils',
        'link',
        'liststyle',
        'magicline',
        'mathjax',
        'newpage',
        'oembed',
        'pagebreak',
        'panelbutton',
        'pastefromword',
        'placeholder',
        'preview',
        'print',
        'save',
        'scayt',
        'selectall',
        'sharedspace',
        'showblocks',
        'smiley',
        'sourcedialog',
        'specialchar',
        'stylesheetparser',
        'table',
        'tableresize',
        'toolbarswitch',
        'tabletools',
        'templates',
        'uicolor',
        'video',
        'widget',
        'wikilink',
        'wordcount',
        'wsc',
        'xml',
        'youtube'
    );

    /**
     * Plugins this toolbar
     * @var array
     */
    public $plugins = array();

    /**
     * @inheritdoc
     */
    public function __construct(
        $toolbar = null,
        $config = array(),
        $prefix = null
    ) {
        // Adding plugins depending of platform conditions
        $plugins = array();

        if (api_get_setting('youtube_for_students') == 'true') {
            $plugins[] = 'youtube';
        } else {
            if (api_is_allowed_to_edit() || api_is_platform_admin()) {
                $plugins[] = 'youtube';
            }
        }

        if (api_get_setting('enabled_googlemaps') == 'true') {
            $plugins[] = 'leaflet';
        }

        if (api_get_setting('math_asciimathML') == 'true') {
            $plugins[] = 'asciimath';
        }

        if (api_get_setting('enabled_mathjax') == 'true') {
            $plugins[] = 'mathjax';
        }

        if (api_get_setting('enabled_asciisvg') == 'true') {
            $plugins[] = 'asciisvg';
        }

        if (api_get_setting('enabled_wiris') == 'true') {
            // Commercial plugin
            //$plugins[] = 'ckeditor_wiris';
        }

        if (api_get_setting('enabled_imgmap') == 'true') {
            $plugins[] = 'mapping';
        }

        if (api_get_setting('block_copy_paste_for_students') == 'true') {
            // Missing
        }

        $this->defaultPlugins = array_merge($this->defaultPlugins, $plugins);
        parent::__construct($toolbar, $config, $prefix);
    }

    /**
     * @return array
     */
    public function getConfig()
    {
        $config['toolbar_minToolbar'] = [
            ['Save', 'NewPage', 'Templates', '-', 'PasteFromWord'],
            ['Undo', 'Redo'],
            ['Link', 'Image', 'Video', 'Flash', 'YouTube', 'Audio', 'Table', 'Asciimath', 'Asciisvg'],
            ['BulletedList', 'NumberedList', 'HorizontalRule'],
            ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'],
            ['Format', 'Font', 'FontSize', 'Bold', 'Italic', 'Underline', 'TextColor', 'BGColor', 'Source'],
            ['Toolbarswitch']
        ];

        $config['toolbar_maxToolbar'] = [
            ['Save', 'NewPage', 'Templates', '-', 'Preview', 'Print'],
            ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord'],
            ['Undo', 'Redo', '-', 'SelectAll', 'Find', '-', 'RemoveFormat'],
            ['Link', 'Unlink', 'Anchor', 'Glossary'],
            [
                'Image',
                'Mapping',
                'Video',
                'Oembed',
                'Flash',
                'YouTube',
                'Audio',
                'leaflet',
                'Smiley',
                'SpecialChar',
                'Asciimath',
                'Asciisvg'
            ],
            '/',
            ['Table', '-', 'CreateDiv'],
            ['BulletedList', 'NumberedList', 'HorizontalRule', '-', 'Outdent', 'Indent', 'Blockquote'],
            ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'],
            ['Bold', 'Italic', 'Underline', 'Strike', '-', 'Subscript', 'Superscript', '-', 'TextColor', 'BGColor'],
            ['Styles', 'Format', 'Font', 'FontSize'],
            ['PageBreak', 'ShowBlocks', 'Source'],
            ['Toolbarswitch'],
        ];

        // file manager (elfinder)

        // http://docs.cksource.com/ckeditor_api/symbols/CKEDITOR.config.html
        $config['filebrowserBrowseUrl'] = api_get_path(WEB_LIBRARY_PATH).'elfinder/filemanager.php';

        $config['customConfig'] = api_get_path(WEB_LIBRARY_PATH).'javascript/ckeditor/config_js.php';

        /*filebrowserFlashBrowseUrl
        filebrowserFlashUploadUrl
        filebrowserImageBrowseLinkUrl
        filebrowserImageBrowseUrl
        filebrowserImageUploadUrl
        filebrowserUploadUrl*/

        $config['extraPlugins'] = $this->getPluginsToString();

        //$config['oembed_maxWidth'] = '560';
        //$config['oembed_maxHeight'] = '315';

        //$config['allowedContent'] = true;

        /*$config['wordcount'] = array(
            // Whether or not you want to show the Word Count
            'showWordCount' => true,
            // Whether or not you want to show the Char Count
            'showCharCount' => true,
            // Option to limit the characters in the Editor
            'charLimit' => 'unlimited',
            // Option to limit the words in the Editor
            'wordLimit' => 'unlimited'
        );*/

        $config['toolbar'] = 'minToolbar';
        $config['smallToolbar'] = 'minToolbar';
        $config['maximizedToolbar'] = 'maxToolbar';

        //$config['skins'] = 'moono';

        if (isset($this->config)) {
            $this->config = array_merge($config, $this->config);
        } else {
            $this->config = $config;
        }

        //$config['width'] = '100';
        //$config['height'] = '200';
        return $this->config;
    }
}
