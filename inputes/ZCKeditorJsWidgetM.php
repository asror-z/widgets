<?php

namespace zetsoft\widgets\inputes;

use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use function GuzzleHttp\Psr7\str;
use zetsoft\system\kernels\ZWidget;
use kartik\widgets\Select2;
use yii\web\JsExpression;


/**
 * Class    ZCKeditorJsWidget
 * @package zetsoft\widgets\inptest
 *
 * https://github.com/ckeditor/ckeditor5
 * https://ckeditor.com/ckeditor-4/demo/
 * https://classic.yarnpkg.com/en/package/ckeditor4
 *
 * http://eyuf.zoft.uz/render/Inputs/Wysiwig/CSSJS/CKeditor/clean_14_ui.html
 * http://eyuf.zoft.uz/render/Inputs/Wysiwig/CSSJS/CKeditor/1_19_cleanall.html
 *
 *
 *
 */
class ZCKeditorJsWidgetM extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [

    ];
    public static $grapes = [
        'enable' => true,
        'icon' => '',
        'image' => '/render/inputes/ZCKeditorJsWidget/image/icon.png',
        'name' => Azl . 'Datepicker',
        'title' => Azl . '<b>safasfsa</b>',

    ];

    public $active = [];
    public $_active = [
        'focus' => false,
        'afterPaste' => false,
        'focus' => false,
        'focus' => false,

    ];

    /**
     *
     * Plugin Events
     * https://select2.org/programmatic-control/events
     */
    public $event = [];
    public $_event = [
        'focus' => "function( e ) {
        console.log( '{classname} | {event}' );
    }",
        'afterPaste' => "function () {
        console.log('{classname} | {event}');
        
        ckeditorjs.showNotification( 'paste', 'warning', 3000 ); 
    }",
        'afterPasteFromWord' => "function () {
        console.log('{classname} | {event}');
        
        ckeditorjs.showNotification('Paste from Word', 'info',3000);
    }",

        'activeEnterModeChange' => "function () {
          console.log('{classname} |{event}');
    }",

        'activeFilterChange' => "function () {
        console.log('{classname} | {event}');
    }",
        'afterCommandExec' => "function () {
        console.log('{classname} | {event}');
    }",
        'afterInsertHtml' => "function () {
        console.log('{classname} | {event}');
    }",
        'afterSetData' => "function () {
        console.log('{classname} | {event}');
    }",
        'afterUndoImage' => "function () {
        console.log('{classname} | {event}');
    }",
        'ariaEditorHelpLabel' => "function () {
        console.log('{classname} | {event}');
    }",
        'ariaWidget' => "function () {
        console.log('{classname} | {event}');
    }",
        'autogrow' => "function () {
        console.log('{classname} | {event}');
    }",
        'beforeCommandExec' => "function () {
        console.log('{classname} | {event}');
    }",
        'beforeDestroy' => "function () {
        console.log('{classname} | {event}');
    }",
        'beforeGetData' => "function () {
        console.log('{classname} | {event}');
    }",
        'beforeModeUnload' => "function () {
        console.log('{classname} | {event}');
    }",
        'beforeSetMode' => "function () {
        console.log('{classname} | {event}');
    }",
        'blur' => "function () {
        console.log('{classname} | {event}');
    }",
        'change' => "function () {
        console.log('{classname} | {event}');
    }",
        'configLoaded' => "function () {
        console.log('{classname} | {event}');
    }",
        'contentDirChanged' => "function () {
        console.log('{classname} | {event}');
    }",
        'contentDom' => "function () {
        console.log('{classname} | {event}');
    }",
        'contentDomInvalidated' => "function () {
        console.log('{classname} | {event}');
    }",
        'contentDomUnload' => "function () {
        console.log('{classname} | {event}');
    }",
        'customConfigLoaded' => "function () {
        console.log('{classname} | {event}');
    }",
        'dataFiltered' => "function () {
        console.log('{classname} | {event}');
    }",
        'dataReady' => "function () {
        console.log('{classname} | {event}');
    }",
        'destroy' => "function () {
        console.log('{classname} | {event}');
    }",
        'dialogHide' => "function () {
        console.log('{classname} | {event}');
    }",
        'dialogShow' => "function () {
        console.log('{classname} | {event}');
    }",
        'dirChanged' => "function () {
        console.log('{classname} | {event}');
    }",
        'doubleclick' => "function () {
        console.log('{classname} | {event}');
    }",
        'dragend' => "function () {
        console.log('{classname} | {event}');
    }",
        'dragstart' => "function () {
        console.log('{classname} | {event}');
    }",
        'drop' => "function () {
        console.log('{classname} | {event}');
    }",
        'elementsPathUpdate' => "function () {
        console.log('{classname} | {event}');
    }",
        'fileUploadRequest' => "function () {
        console.log('{classname} | {event}');
        alert('request');
    }",
        'fileUploadResponse' => "function () {
        console.log('{classname} | {event}');
        alert('response');
    }",
        'floatingSpaceLayout' => "function () {
        console.log('{classname} | {event}');
    }",
        'getData' => "function () {
        console.log('{classname} | {event}');
    }",
        'getSnapshot' => "function () {
        console.log('{classname} | {event}');
    }",
        'insertElement' => "function () {
        console.log('{classname} | {event}');
    }",
        'insertText' => "function () {
        console.log('{classname} | {event}');
    }",
        'key' => "function () {
        console.log('{classname} | {event}');
    }",
        'langLoaded' => "function () {
        console.log('{classname} | {event}');
    }",
        'loadSnapshot' => "function () {
        console.log('{classname} | {event}');
    }",
        'loaded' => "function () {
        console.log('{classname} | {event}');
    }",
        'lockSnapshot' => "function () {
        console.log('{classname} | {event}');
    }",
        'maximize' => "function () {
        console.log('{classname} | {event}');
    }",
        'menuShow' => "function () {
        console.log('{classname} | {event}');
    }",
        'mode' => "function () {
        console.log('{classname} | {event}');
    }",
        'notificationHide' => "function () {
        console.log('{classname} | {event}');
    }",
        'notificationShow' => "function () {
        console.log('{classname} | {event}');
    }",
        'notificationUpdate' => "function () {
        console.log('{classname} | {event}');
    }",
        'paste' => "function () {
        console.log('{classname} | {event}');
    }",
        'pasteFromWord' => "function () {
        console.log('{classname} | {event}');
    }",
        'pluginsLoaded' => "function () {
        console.log('{classname} | {event}');
    }",
        'readOnly' => "function () {
        console.log('{classname} | {event}');
    }",
        'removeFormatCleanup' => "function () {
        console.log('{classname} | {event}');
    }",
        'required' => "function () {
        console.log('{classname} | {event}');
    }",
        'resize' => "function () {
        console.log('{classname} | {event}');
    }",
        'save' => "function () {
        console.log('{classname} | {event}');
    }",
        'saveSnapshot' => "function () {
        console.log('{classname} | {event}');
    }",
        'selectionChange' => "function () {
        console.log('{classname} | {event}');
    }",
        'setData' => "function () {
        console.log('{classname} | {event}');
    }",
        'stylesSet' => "function () {
        console.log('{classname} | {event}');
    }",
        'template' => "function () {
        console.log('{classname} | {event}');
    }",
        'toDataFormat' => "function () {
        console.log('{classname} | {event}');
    }",
        'toHtml' => "function () {
        console.log('{classname} | {event}');
    }",
        'uiSpace' => "function () {
        console.log('{classname} | {event}');
    }",
        'unlockSnapshot' => "function () {
        console.log('{classname} | {event}');
    }",
        'updateSnapshot' => "function () {
        console.log('{classname} | {event}');
    }",
        'widgetDefinition' => "function () {
        console.log('{classname} | {event}');
    }",
    ];

    public $plugins = [
        'quicktable' => '/render/inputes/ZCkEditorJsWidget/assets/Usability/Quicktable/quicktable_1.0.6/quicktable/plugin.js',
        'video' => '/render/inputes/ZCkEditorJsWidget/assets/ckeditor/video/plugin.js',
        'html5audio' => '/render/inputes/ZCkEditorJsWidget/assets/ckeditor/plugins/html5audio/plugin.js',
        'allowsave' => '/render/inputes/ZCkEditorJsWidget/assets/Usability/Allow Save/allowsave_1.0/allowsave/plugin.js',
        'btbutton' => '/render/inputes/ZCkEditorJsWidget/assets/Usability/Bootstrap 3 Button Widget/btbutton_1.0/btbutton/plugin.js',
        'closedialogoutside' => '/render/inputes/ZCkEditorJsWidget/assets/Usability/Close Dialog Outside/closedialogoutside_1.0.0.1/closedialogoutside/plugin.js',
        'codemirror' => '/render/inputes/ZCkEditorJsWidget/assets/Usability/CodeMirror (Source) Syntax Highlighting/codemirror_1.17.13/codemirror/plugin.js',
        'pre' => '/render/inputes/ZCkEditorJsWidget/assets/Usability/Collapsible Snippet/pre_1.0b2/pre/plugin.js',
        'powrcomments' => '/render/inputes/ZCkEditorJsWidget/assets/Usability/Comments/powrcomments/plugin.js',
        'deselect' => '/render/inputes/ZCkEditorJsWidget/assets/Usability/Deselect for IE11 bugfix/deselect/plugin.js',
        'imagerotate' => '/render/inputes/ZCkEditorJsWidget/assets/Usability/Image Rotate/imagerotate/plugin.js',
        'closebtn' => '/render/inputes/ZCkEditorJsWidget/assets/Usability/Inline Close Button/closebtn/plugin.js',
        'locationmap' => '/render/inputes/ZCkEditorJsWidget/assets/Usability/Location Map (Google)/locationmap/plugin.js',
        'nbsp' => '/render/inputes/ZCkEditorJsWidget/assets/Usability/Non-breaking space/nbsp_1.1/nbsp/plugin.js',
        'notification' => '/render/inputes/ZCkEditorJsWidget/assets/Usability/Notification/notification_4.13.1/notification/plugin.js',
        'numericinput' => '/render/inputes/ZCkEditorJsWidget/assets/Usability/Numeric Input/numericinput_0.2/numericinput/plugin.js',
        'openlink' => '/render/inputes/ZCkEditorJsWidget/assets/Usability/Open Link/openlink_1.0.4/openlink/plugin.js',

        'save' => '/render/inputes/ZCkEditorJsWidget/assets/Usability/Save/save_4.13.1/save/plugin.js',
        'showblocks' => '/render/inputes/ZCkEditorJsWidget/assets/Usability/Show Blocks/showblocks_4.13.1/showblocks/plugin.js',
        'showprotected' => '/render/inputes/ZCkEditorJsWidget/assets/Usability/Show Protected/showprotected_1.0.0/showprotected/plugin.js',
        'smallerselection' => '/render/inputes/ZCkEditorJsWidget/assets/Usability/Smaller Selection/smallerselection_0.1.1/smallerselection/plugin.js',

        'toc' => '/render/inputes/ZCkEditorJsWidget/assets/Usability/Table of Contents/toc_3.1/toc/plugin.js',
        'tableselection' => '/render/inputes/ZCkEditorJsWidget/assets/Usability/Table Selection/tableselection_4.13.1/tableselection/plugin.js',
        'toolbarswitch' => '/render/inputes/ZCkEditorJsWidget/assets/Usability/Toolbar switch on Maximize/toolbarswitch_4.3.2/toolbarswitch/plugin.js',
        'xmltemplates' => '/render/inputes/ZCkEditorJsWidget/assets/Usability/XML Templates/xmltemplates_1.0/xmltemplates/plugin.js',
        'youtubebootstrap' => '/render/inputes/ZCkEditorJsWidget/assets/Usability/Youtube bootstrap/youtubebootstrap_1.0/youtubebootstrap/plugin.js',
        'zoom' => '/render/inputes/ZCkEditorJsWidget/assets/Usability/Zoom/zoom_2.2/zoom/plugin.js',
        'panel' => '/render/inputes/ZCkEditorJsWidget/assets/UI/Panel/panel_4.13.1/panel/plugin.js',
        'floatpanel' => '/render/inputes/ZCkEditorJsWidget/assets/UI/Floating Panel/floatpanel_4.13.1/floatpanel/plugin.js',

        /*
            Clipboard
        */
        // 507
        //
        'copyformatting' => '/render/inputes/ZCkEditorJsWidget/assets/Clipboard/Copy Formatting/copyformatting_4.13.1/copyformatting/plugin.js',
        'extraformattributes' => '/render/inputes/ZCkEditorJsWidget/assets/Clipboard/Extra Form Attributes/extraformattributes_1.0_0/extraformattributes/plugin.js',
        'imagepaste' => '/render/inputes/ZCkEditorJsWidget/assets/Clipboard/Image Paste/imagepaste_1.1.1/imagepaste/plugin.js',
        'imageuploader' => '/render/inputes/ZCkEditorJsWidget/assets/Clipboard/Image Uploader and Browser for CKEditor/imageuploader_4.1.8/imageuploader/plugin.js',
        'inserthtml4x' => '/render/inputes/ZCkEditorJsWidget/assets/Clipboard/inserthtml4x/inserthtml4x_2.0_0/inserthtml4x/plugin.js',
        'pastecode' => '/render/inputes/ZCkEditorJsWidget/assets/Clipboard/Paste code/pastecode_0.1/pastecode/plugin.js',
        'pasteFromGoogleDoc' => '/render/inputes/ZCkEditorJsWidget/assets/Clipboard/Paste From Google Doc/pastefromgoogledoc_1.0/pasteFromGoogleDoc/plugin.js',
        'pastebase64' => '/render/inputes/ZCkEditorJsWidget/assets/Clipboard/Paste image as base64/pastebase64_1.0/pastebase64/plugin.js',
        'pastetools' => '/render/inputes/ZCkEditorJsWidget/assets/Clipboard/Paste Tools/pastetools_4.13.1/pastetools/plugin.js',
        'uploadwidget' => '/render/inputes/ZCkEditorJsWidget/assets/Clipboard/Upload Widget/uploadwidget_4.13.1/uploadwidget/plugin.js',
        /*
        Contents
         */
        'autocomplete' => '/render/inputes/ZCkEditorJsWidget/assets/Contents/Autocomplete/autocomplete_4.13.1/autocomplete/plugin.js',
        'ccmsacdc' => '/render/inputes/ZCkEditorJsWidget/assets/Contents/ACDC Placeholder/ccmsacdc_1.1/ccmsacdc/plugin.js',
        'base64image' => '/render/inputes/ZCkEditorJsWidget/assets/Contents/Base64 Image/base64image_1.3/base64image/plugin.js',
        'templates' => '/render/inputes/ZCkEditorJsWidget/assets/Contents/Content Templates/templates_4.13.1/templates/plugin.js',
        'emoji' => '/render/inputes/ZCkEditorJsWidget/assets/Contents/Emoji/emoji_4.13.1/emoji/plugin.js',
        'image2' => '/render/inputes/ZCkEditorJsWidget/assets/Contents/Enhanced Image/image2_4.13.1/image2/plugin.js',
        'fastimage' => '/render/inputes/ZCkEditorJsWidget/assets/Contents/FastImage/fastimage_0.2a/fastimage/plugin.js',
        'flash' => '/render/inputes/ZCkEditorJsWidget/assets/Contents/Flash Dialog/flash_4.13.1/flash/plugin.js',
        'forms' => '/render/inputes/ZCkEditorJsWidget/assets/Contents/Form Elements/forms_4.13.1/forms/plugin.js',
        'googledocs' => '/render/inputes/ZCkEditorJsWidget/assets/Contents/Google Docs/googledocs_1.0/googledocs/plugin.js',
        'imagebrowser' => '/render/inputes/ZCkEditorJsWidget/assets/Contents/Image Browser/imagebrowser_2.0.2_0/imagebrowser/plugin.js',
        'imageresize' => '/render/inputes/ZCkEditorJsWidget/assets/Contents/Image Resize/imageresize_1.0.2/imageresize/plugin.js',
        'insertpre' => '/render/inputes/ZCkEditorJsWidget/assets/Contents/Insert element/insertpre_1.1/insertpre/plugin.js',
        'smiley' => '/render/inputes/ZCkEditorJsWidget/assets/Contents/Insert Smiley/smiley_4.13.1/smiley/plugin.js',
        'lightbox' => '/render/inputes/ZCkEditorJsWidget/assets/Contents/Lightbox/lightbox_2.1/lightbox/plugin.js',
        'oembed' => '/render/inputes/ZCkEditorJsWidget/assets/Contents/Media (oEmbed) Plugin/oembed_1.18.1/oembed/plugin.js',
        'tliyoutube2' => '/render/inputes/ZCkEditorJsWidget/assets/Contents/Minimal YouTube [multi-language]/tliyoutube2_1.1/tliyoutube2/plugin.js',
        'page2images' => '/render/inputes/ZCkEditorJsWidget/assets/Contents/Online Website Screenshot Generator/page2images_1.0.2/page2images/plugin.js',
        'pagebreak' => '/render/inputes/ZCkEditorJsWidget/assets/Contents/Page Break/pagebreak_4.13.1/pagebreak/plugin.js',
        'ccmssourcedialog' => '/render/inputes/ZCkEditorJsWidget/assets/Contents/Read only Source Dialog/ccmssourcedialog_1.0rc_0/ccmssourcedialog/plugin.js',
        'replaceTagNameByBsquochoai' => '/render/inputes/ZCkEditorJsWidget/assets/Contents/Replace (change) tagName of current element/replacetagnamebybsquochoai_1.2/replaceTagNameByBsquochoai/plugin.js',
        'save-to-pdf' => '/render/inputes/ZCkEditorJsWidget/assets/Contents/save-to-pdf/plugin.js',
        'simplebutton' => '/render/inputes/ZCkEditorJsWidget/assets/Contents/Simple Button/simplebutton_0.0.9/simplebutton/plugin.js',
        'tangy-checkbox' => '/render/inputes/ZCkEditorJsWidget/assets/Contents/tangy-checkbox/tangy-checkbox_1.0.0/tangy-checkbox/plugin.js',
        'tangy-gps' => '/render/inputes/ZCkEditorJsWidget/assets/Contents/tangy-gps/tangy-gps_1.0.0/tangy-gps/plugin.js',
        'tangy-input' => '/render/inputes/ZCkEditorJsWidget/assets/Contents/tangy-input/tangy-input_1.0.0_0/tangy-input/plugin.js',
        'textsignature' => '/render/inputes/ZCkEditorJsWidget/assets/Contents/Text Signature/textsignature_1.0_0/textsignature/plugin.js',
        'linkayt' => '/render/inputes/ZCkEditorJsWidget/assets/Contents/URL link as you type (linkayt)/linkayt_1.0.1/linkayt/plugin.js',
        'videoembed' => '/render/inputes/ZCkEditorJsWidget/assets/Contents/Video Embed/videoembed_1.1/videoembed/plugin.js',
        'videosnapshot' => '/render/inputes/ZCkEditorJsWidget/assets/Contents/Video Snapshot/videosnapshot_0.0.2/videosnapshot/plugin.js',
        'wenzgmap' => '/render/inputes/ZCkEditorJsWidget/assets/Contents/Wenz Google Map Free/wenzgmap_1.0/wenzgmap/plugin.js',
        'yaqr' => '/render/inputes/ZCkEditorJsWidget/assets/Contents/Yet Another QR-Code Image Generator/yaqr_1.1_0/plugin.js',


        'html5video' => '/render/inputes/ZCkEditorJsWidget/assets/UI/HTML5 video/html5video_1.2/ckeditor-html5-video-master/html5video/plugin.js',
        'youtube' => 'https://cdn.jsdelivr.net/npm/ckeditor-youtube-plugin@2.1.14/youtube/plugin.js',


        'codesnippet' => '/render/inputes/ZCkEditorJsWidget/assets/Tools/Code Snippet/codesnippet_4.13.1/codesnippet/plugin.js',
        'codesnippetgeshi' => '/render/inputes/ZCkEditorJsWidget/assets/Tools/Code Snippet GeSHi/codesnippetgeshi_4.13.1/codesnippetgeshi/plugin.js',
        'pbckcode' => '/render/inputes/ZCkEditorJsWidget/assets/Tools/pbckcode/plugin.js',
        'niftytimers' => '/render/inputes/ZCkEditorJsWidget/assets/Tools/Countdown Timers/niftytimers_1.2/plugins/niftytimers/plugin.js',
        'custimage' => '/render/inputes/ZCkEditorJsWidget/assets/Tools/Custom Image Dialog _ Custom Dialog/custimage_1.0_0/custimage/plugin.js',
        'eqneditor' => '/render/inputes/ZCkEditorJsWidget/assets/Tools/Equation Editor/eqneditor_2.2/ckeditor_v4.1/plugins/eqneditor/plugin.js',
        'googlethisterm' => '/render/inputes/ZCkEditorJsWidget/assets/Tools/Google This Term/googlethisterm_1.2/plugin.js',
        'xmas' => '/render/inputes/ZCkEditorJsWidget/assets/Tools/Greetings Card/xmas_1.0.3/ckeditor-plugin-xmas-1.0.3/plugin.js',
        'contextmenu' => '/render/inputes/ZCkEditorJsWidget/assets/Tools/context_menu/contextmenu/plugin.js',
        'inserthtmlfile' => '/render/inputes/ZCkEditorJsWidget/assets/Tools/Insert HTML From File/inserthtmlfile_1.0/inserthtmlfile/plugin.js',
        'internallink' => '/render/inputes/ZCkEditorJsWidget/assets/Tools/Internal Link/internallink_1.0/plugin.js',
        'lineutils' => '/render/inputes/ZCkEditorJsWidget/assets/Tools/Line Utilities/lineutils_4.13.1/lineutils/plugin.js',
        'mathedit' => '/render/inputes/ZCkEditorJsWidget/assets/Tools/Math Editor/mathedit_0.0.2/mathedit/plugin.js',
        'onchange' => '/render/inputes/ZCkEditorJsWidget/assets/Tools/onChange/onchange_1.8/onchange/plugin.js',
        'niftyimages' => '/render/inputes/ZCkEditorJsWidget/assets/Tools/Personalized Images/niftyimages_1.0/plugins/niftyimages/plugin.js',
        'placeholder' => '/render/inputes/ZCkEditorJsWidget/assets/Tools/Placeholder/placeholder_4.13.1/placeholder/plugin.js',
        'qrc' => '/render/inputes/ZCkEditorJsWidget/assets/Tools/QRCode generator/qrc_1.1_0/qrc/plugin.js',
        'savemarkdown' => '/render/inputes/ZCkEditorJsWidget/assets/Tools/Save Markdown/savemarkdown_1.0.0/savemarkdown/plugin.js',
        'selectallcontextmenu' => '/render/inputes/ZCkEditorJsWidget/assets/Tools/Select All Context Menu/selectallcontextmenu_1.1/selectallcontextmenu/plugin.js',
        'soundPlayer' => '/render/inputes/ZCkEditorJsWidget/assets/Tools/Sound Player/soundplayer_1.0/soundPlayer/plugin.js',
        'tableresize' => '/render/inputes/ZCkEditorJsWidget/assets/Tools/Table Resize/tableresize_4.13.1/tableresize/plugin.js',
        'textmatch' => '/render/inputes/ZCkEditorJsWidget/assets/Tools/Text Match/textmatch_4.13.1/textmatch/plugin.js',
        'texttransform' => '/render/inputes/ZCkEditorJsWidget/assets/Tools/Text Transform/texttransform_1.1/texttransform/plugin.js',
        'textwatcher' => '/render/inputes/ZCkEditorJsWidget/assets/Tools/Text Watcher/textwatcher_4.13.1/textwatcher/plugin.js',
        'token' => '/render/inputes/ZCkEditorJsWidget/assets/Tools/Token Insertion/token_1.1/token-replacement-ckeditor-plugin-1.1/plugin.js',



        'grid' => '/render/inputes/ZCkEditorJsWidget/assets/Layout/Grid Widget/grid_2.10/grid/plugin.js',
        'gallery' => '/render/inputes/ZCkEditorJsWidget/assets/Semantics/Gallery Widget/gallery_2.10/gallery/plugin.js',
        'backgrounds' => '/render/inputes/ZCkEditorJsWidget/assets/Styling/Background Image for Tables and Cells/backgrounds_1.5.1/backgrounds/plugin.js',
        'footnotes' => '/render/inputes/ZCkEditorJsWidget/assets/Styling/CKEditor Footnotes/footnotes_1.0.10/CKEditorFootnotes-1.0.10/footnotes/plugin.js',
        'computedstyles' => '/render/inputes/ZCkEditorJsWidget/assets/Styling/Computed Styles/computedstyles_1.0.1/computedstyles/plugin.js',
        'fontawesome' => '/render/inputes/ZCkEditorJsWidget/assets/Styling/Font Awesome/fontawesome_2.0/plugin.js',
        'font' => '/render/inputes/ZCkEditorJsWidget/assets/Styling/Font Size and Family/font_4.13.1/font/plugin.js',
        'ckeditorfa' => '/render/inputes/ZCkEditorJsWidget/assets/Styling/FontAwesome/ckeditorfa_2.3/ckeditorfa/plugin.js',
        'indent' => '/render/inputes/ZCkEditorJsWidget/assets/Styling/Indent _ Outdent/indent_4.13.1/indent/plugin.js',
        'indentblock' => '/render/inputes/ZCkEditorJsWidget/assets/Styling/Indent Block/indentblock_4.13.1/indentblock/plugin.js',
        'justify' => '/render/inputes/ZCkEditorJsWidget/assets/Styling/Justify/justify_4.13.1/justify/plugin.js',
        'letterspacing' => '/render/inputes/ZCkEditorJsWidget/assets/Styling/Letter-spacing/letterspacing_0.1.2/ckeditor-letterspacing-0.1.2/plugin.js',
        'textindent' => '/render/inputes/ZCkEditorJsWidget/assets/Styling/Paragraph Indentation/textindent_1.2.2/textindent-1.2.2/textindent/plugin.js',
        'prism' => '/render/inputes/ZCkEditorJsWidget/assets/Styling/Prism Syntax Highlighter/prism_1.0.1/prism/plugin.js',
        'scribens' => '/render/inputes/ZCkEditorJsWidget/assets/Styling/Scribens/scribens_1.2/plugin.js',
        'spacingsliders' => '/render/inputes/ZCkEditorJsWidget/assets/Styling/Spacing Sliders/spacingsliders_1.3/spacingsliders/plugin.js',
        'syntaxhighlight' => '/render/inputes/ZCkEditorJsWidget/assets/Styling/Syntaxhighlighter Interface/syntaxhighlight_1.7.0/plugins/syntaxhighlight/plugin.js',

        'basewidget' => '/render/inputes/ZCkEditorJsWidget/assets/Layout/Basewidgetbasewidget_1.0.0/basewidget/plugin.js',
        'glyphicons' => '/render/inputes/ZCkEditorJsWidget/assets/Layout/Bootstrap Glyphicon/glyphicons_2.2/glyphicons/plugin.js',
        'bootstrapVisibility' => '/render/inputes/ZCkEditorJsWidget/assets/Layout/Bootstrap Responsive Visibility/bootstrapvisibility_1.0/bootstrapVisibility/plugin.js',
        'bootstrapTabs' => '/render/inputes/ZCkEditorJsWidget/assets/Layout/Bootstrap Tabs/bootstraptabs_1.1/bootstrapTabs/plugin.js',
        'brclear' => '/render/inputes/ZCkEditorJsWidget/assets/Layout/BR Clear/brclear/plugin.js',
        'btgrid' => '/render/inputes/ZCkEditorJsWidget/assets/Layout/Bootstrap grid/btgrid/plugin.js',
        'label' => '/render/inputes/ZCkEditorJsWidget/assets/Layout/Form Field Label/label_1.0rc/label/plugin.js',
        'lineheight' => '/render/inputes/ZCkEditorJsWidget/assets/Layout/Line Height/lineheight_1.0.4/lineheight/plugin.js',
        'powrmultislider' => '/render/inputes/ZCkEditorJsWidget/assets/Layout/Multi Slider/powrmultislider_1.0/plugin.js',
        'powrpopup' => '/render/inputes/ZCkEditorJsWidget/assets/Layout/Popup/powrpopup_1.2/plugin.js',
        'powrsocialfeed' => '/render/inputes/ZCkEditorJsWidget/assets/Layout/Social Feed/powrsocialfeed_1.2/plugin.js',
        'strinsert' => '/render/inputes/ZCkEditorJsWidget/assets/Layout/StrInsert - Custom Dropdown for CKEditor4/strinsert_0.01/plugin.js',


        'texzilla' => '/render/inputes/ZCkEditorJsWidget/assets/Data/(La)TeX2MathML/texzilla_1.2.1/src/plugin.js',
        'ajax' => '/render/inputes/ZCkEditorJsWidget/assets/Data/Ajax Data Loading/ajax_4.13.1/ajax/plugin.js',
        'autoembed' => '/render/inputes/ZCkEditorJsWidget/assets/Data/Auto Embed/autoembed_4.13.1/autoembed/plugin.js',
        'autoplaceholder' => '/render/inputes/ZCkEditorJsWidget/assets/Data/Autoplaceholder/autoplaceholder_1.1.4/autoplaceholder/plugin.js',
        'bbcode' => '/render/inputes/ZCkEditorJsWidget/assets/Data/BBCode Output Format/bbcode_4.13.1/bbcode/plugin.js',
        'cavacnote' => '/render/inputes/ZCkEditorJsWidget/assets/Data/Cavac Note/cavacnote_1.0/cavacnote/plugin.js',
        'chart' => '/render/inputes/ZCkEditorJsWidget/assets/Data/Chart/chart_1.0.2/chart-1.0.2/plugin.js',
        'simpleImageUpload' => '/render/inputes/ZCkEditorJsWidget/assets/Data/Simple image upload - no filebrowser required/simpleimageupload_1.0/simpleImageUpload/plugin.js',
        'xdsoft_translater' => '/render/inputes/ZCkEditorJsWidget/assets/Data/Translater/xdsoft_translater_1.0.4/xdsoft_translater/plugin.js',
        'video_data' => '/render/inputes/ZCkEditorJsWidget/assets/Data/Video/video_1.2/video/plugin.js',
        'videoPlusCKEditorPlugin-master' => '/render/inputes/ZCkEditorJsWidget/assets/Data/VideoPlus/videoplus_3.5_0/videoPlusCKEditorPlugin-master/plugin.js',
        'widget' => '/render/inputes/ZCkEditorJsWidget/assets/Data/Widget/widget_4.13.1/widget/plugin.js',
        'widgetselection' => '/render/inputes/ZCkEditorJsWidget/assets/Data/Widget Selection/widgetselection_4.13.1/widgetselection/plugin.js',
    ];

    public $layout = [];
    public $test = 'aaaaa';
    public $_layout = [

        'main' => <<<HTML
           <div>
          <textarea 
                id="{id}" 
                placeholder="{placeholder}" 
                name="{name}">{value} 
            </textarea>      
</div>
            
HTML,

        'js' => <<<JS

         {plugins}
         
   var tokenList = {
        "animals.cats.persian": {
          value: "27392032932"
        },
        "animals.cats.korat": {
          value: "51432132312"
        },
        "animals.cats.ragdoll": {
          value: "51212325242"
        },
        "animals.cats.bengal": {
          value: "8732523235"
        },
        "animals.dogs.corgi": {
          value: "241264343"
        },
        "animals.dogs.beagle": {
          value: "24212415156"
        },
        "animals.dogs.collie": {
          value: "64542124252"
        },
        "animals.birds.parrot": {
          value: "6112261235"
        },
        "animals.birds.pigeon": {
          value: "63243151224"
        },
        "animals.bears.grizzly": {
          value: "47328329832"
        },
        "animals.bears.brown": {
          value: "434838933"
        }
      };
    
    var ckeditorjs = CKEDITOR.replace( '{id}',{
        toolbar : [
            { name: 'document', items: [ '-', 'Templates', 'Source', '-', 'Save', 'NewPage', 'Preview', 'Print', '-',  ] },
            { name: 'clipboard', items: [ 'basewidget', 'Cut', 'Copy', 'PasteText', 'PasteFromWord','Pastetools', '-', 'Undo', 'Redo', ] },
            { name: 'editing', items: [ 'Find', 'Replace', '-', 'SelectAll', 'Scayt',  ] },
            { name: 'forms', items: [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField',   ] },
            '/',
            { name: 'basicstyles', items: [  'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'CopyFormatting', 'RemoveFormat', ] },
            { name: 'paragraph', items: [  'Language', 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', ] },
            { name: 'links', items: [ 'Link', 'Unlink', 'Anchor', 'youtube', 'lightbox', "googlesearch", "pacatube", 'openLink', 'openlink_enableReadOnly' ] },
            { name: 'ggenInsertrt', items: [ 'Image', 'Html5video', 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe', 'Html5audio', 'CodeSnippet', 'Youtube', 'FontAwesome', '-', 'LocationMap', 'Smiley', 'PageBreak'] },
            '/',
            { name: 'styles', items: [ 'Font', '-', 'Styles', 'Format', 'FontSize', ] },
            { name: 'colors', items: [  'TextColor', 'BGColor', ] },
            { name: 'tools', items: [ "Maximize", "ShowBlocks", "save-to-pdf", "pbckcode", "niftytimers", "custimage", "EqnEditor", "googlethisterm", "Xmas", "inserthtmlfile", "Internallink", "Lineutils", "Mathedit", "Onchange", "Niftyimages", "Placeholder", "CodeSnippet", "CodeSnippetGeshi", "qrc", "saveMarkdown", "SelectAllContextMenu", "soundPlayer", "tableResize", "Textmatch", "Texttransform", "Textwatcher", "token"  ] },
            { name: 'about', items: [ 'About', ], },
            { name: 'video', items: ['video','Sketchfab', 'TextSelection','FMathEditor','Autosave']},
            { name: 'all', items : ['LoopIndexTrackChangestive Edit', 'CopyFormatting', 'PasteCode', 'pastetools', 'ccmsacdc', 'base64image', 'emoji', 'oembed', 'tliyoutube2', 'page2images', 'videosnapshot', 'Yaqr', 'cavacnote', 'Chart', "Autoplaceholder", "texzilla", 'strinsert','CollapsibleItem','Glyphicons','Bootstrapvisibility','BootstrapTabs','brclear','Label','lineheight','PowrMultiSlider','oembed','justify', 'computedstyles','FootNotes','backgrounds','Indent', 'Indent_Block', 'ckeditorfa', 'font', 'letterspacing', 'textindent', 'Scribens', 'spacingsliders', 'Prism', 'Syntaxhighlight', 'TabbedImageBrowser', 'btbutton','Deselect','imagerotate','pre', 'closebtn', 'smallerselection', 'toc', 'youtubebootstrap', 'Zoom', 'ShowBlocks', ]}
        ],
        allowedContent: true,
        autoEmbed_widget : 'embed,embedSemantic',
        autoGrow_bottomSpace : 0,
        autoGrow_maxHeight : 400,
        autoGrow_onStartup : false,
        autoUpdateElement : true,
        autocomplete_commitKeystrokes : [ 9, 13 ],
        autolink_commitKeystrokes : [ 13, 32 ],
        baseFloatZIndex : 10000,
        baseHref : '',
        basicEntities : true,
        blockedKeystrokes : [
            CKEDITOR.CTRL + 66, // Ctrl+B
            CKEDITOR.CTRL + 73, // Ctrl+I
            CKEDITOR.CTRL + 85 // Ctrl+U
        ],
        bodyClass : '',
        bodyId : '',
        browserContextMenuOnCtrl : true,
        clipboard_defaultContentType : 'html',
        clipboard_notificationDuration : 10000,
        cloudServices_tokenUrl: '',
        cloudServices_uploadUrl: '',
        codeSnippetGeshi_url : '',
        codeSnippet_codeClass : 'hljs',
        codeSnippet_languages : null,
        codeSnippet_theme : 'default',
        colorButton_backStyle : {
            element: 'span',
            styles: { 'background-color': '#(color)' }
        },
        colorButton_colors :
        '000,800000,8B4513,2F4F4F,008080,000080,4B0082,696969,' +
        'B22222,A52A2A,DAA520,006400,40E0D0,0000CD,800080,808080,' +
        'F00,FF8C00,FFD700,008000,0FF,00F,EE82EE,A9A9A9,' +
        'FFA07A,FFA500,FFFF00,00FF00,AFEEEE,ADD8E6,DDA0DD,D3D3D3,' +
        'FFF0F5,FAEBD7,FFFFE0,F0FFF0,F0FFFF,F0F8FF,E6E6FA,FFF',
        colorButton_colorsPerRow : 6,
        colorButton_enableAutomatic : true,
        colorButton_enableMore : true,
        colorButton_foreStyle : {
            element: 'span',
            styles: { color: '#(color)' }
        },
        colorButton_normalizeBackground : true,
        /**
        *The writing direction of the language which is used to create editor content
        */
        contentsLangDirection : '',

        /**
         * Language code of the writing language which is used to author the editor content. This option accepts one single entry value in the format defined in the Tags for Identifying Languages (BCP47) IETF document and is used in the lang attribute.
         */

        contentsLanguage : '',

        /**
        * The CSS file(s) to be used to apply the style to the context menu content.
        */
        contextmenu_contentsCss : '',

        /**
        * Defines rules for the elements from which the styles should be fetched. If set to true, it will disable filtering.
        */
        copyFormatting_allowRules : 'b; s; u; strong; span; p; div; table; thead; tbody; ' + 'tr; td; th; ol; ul; li; (*)[*]{*}',

        /**
        * Defines which contexts should be enabled in the Copy Formatting plugin. Available contexts are:
        *    See source
        *    'text' – Plain text context.
        *    'list' – List context.
        *    'table' – Table context.
         */
        copyFormatting_allowedContexts : true,   // 'text' | 'list' | 'table'

         /**
         * Defines rules for the elements from which fetching styles is explicitly forbidden (eg. widgets).
         */

        copyFormatting_disallowRules : '*[data-cke-widget*,data-widget*,data-cke-realelement](cke_widget*)',

        /**
        *Defines if the "disabled" cursor should be attached to the whole page when the Copy Formatting plugin is active.
        */

        copyFormatting_outerCursor : true,

        /**
        *The style definition that applies the bold style to the text.
        */

        coreStyles_bold :{element: 'strong', overrides: 'b'},

        /**
        *The style definition that applies the italics style to the text.
        */

        coreStyles_italic : { element: 'em', overrides: 'i' },

        /**
        *  The style definition that applies the strikethrough style to the text
        */
        
        coreStyles_strike : {element: 's', overrides: 'strike'},

        /**
        *   The style definition that applies the subscript style to the text.
        */

        coreStyles_subscript : {element: 'sub'},

        /**
        * The style definition that applies the superscript style to the text
        */

        coreStyles_superscript: {element: 'sup'},

        /**
        * The style definition that applies the underline style to the text
        */

        coreStyles_underline: {element: 'u'},

        /**
        *The URL path to the custom configuration file to be loaded. If not overwritten with inline configuration, it defaults to the config.js file present in the root of the CKEditor installation directory
        */
               
        customConfig: "https://cdn.jsdelivr.net/npm/ckeditor4-dev@4.14.0/config.js",

        /**
        *The characters to be used for indenting HTML output produced by the editor. Using characters different from ' ' (space) and '\t' (tab) is not recommended as it will mess the code
        */

        dataIndentationChars : '\t',



    /**
        *The CSS file(s) to be used to apply style to editor content. It should reflect the CSS used in the target pages where the content is to be displayed.
        */
        contentsCss : ['https://cdn.ckeditor.com/4.8.0/standard-all/contents.css'],


        /**
        *The language to be used if the language setting is left empty and it is not possible to localize the editor to the user language.
        */

        defaultLanguage : 'en',

        /**
        *A setting that stores CSS rules to be injected into the page with styles to be applied to the tooltip element.
        */

        devtools_styles : '',

        /**
        * The color of the dialog background cover. It should be a valid CSS color string
        */

        dialog_backgroundCoverColor : '#000',

        /**
        *The opacity of the dialog background cover. It should be a number within the range [0.0, 1.0]
        */

        dialog_backgroundCoverOpacity : 0.5,

        /**
        *The guideline to follow when generating the dialog buttons. There are 3 possible options:

         See source
         'OS' - the buttons will be displayed in the default order of the user's OS;
         'ltr' - for Left-To-Right order;
         'rtl' - for Right-To-Left order.
        */

        dialog_buttonsOrder : 'OS',   // 'OS' | 'ltr' | 'rtl'

        /**
        *The distance of magnetic borders used in moving and resizing dialogs, measured in pixels.
        */

        dialog_magnetDistance : 20,

        /**
        *Tells if user should not be asked to confirm close, if any dialog field was modified. By default it is set to false meaning that the confirmation dialog will be shown.
        */

        dialog_noConfirmCancel : false,

        /**
        * If the dialog has more than one tab, put focus into the first tab as soon as dialog is opened
        */

        dialog_startupFocusTab : false,

        /**
        * Disables the built-in spell checker if the browser provides one.
        */

        disableNativeSpellChecker : true,

        /**
        * Whether to wrap the entire table instead of individual cells when creating a <div> in a table cell
        */

        div_wrapTable : false,
        
        /**
        *
        */

        docType : '<!DOCTYPE html>',

        easyimage_class : 'easyimage',

        easyimage_defaultStyle : 'full',

        easyimage_styles : {},

        easyimage_toolbar : [ 'EasyImageFull', 'EasyImageSide', 'EasyImageAlt' ],

        emailProtection : '',

        embed_provider : '',

        emoji_emojiListUrl : '',

        emoji_minChars : 2,

        enableContextMenu : true,

        enableTabKeyTools : true,

        enterMode : CKEDITOR.ENTER_P,

        entities : true,

        entities_additional : '#39',

        entities_greek : true,

        entities_latin : true,

        entities_processNumerical : false,

        extraAllowedContent : '',

        extraPlugins: 'autocomplete, autoembed,image2,uploadimage,tableresize,notification,language,emoji,language, copyformatting, pastecode, pastetools, ccmsacdc, base64image, templates, imageresize, lightbox, smiley, oembed, tliyoutube2, pagebreak, videosnapshot, yaqr, texzilla,cavacnote,chart,autoplaceholder,powrsocialfeed,powrmultislider,lineheight,label,brclear,bootstrapTabs,bootstrapVisibility,glyphicons,powrpopup,strinsert,save-to-pdf,youtube,image2,uploadimage,notification,language,emoji,video,html5audio,html5video,pastetools,oembed,justify,footnotes,indent,ckeditorfa,syntaxhighlight,prism,spacingsliders,scribens,textindent,letterspacing,font,fontawesome,backgrounds,computedstyles,token,grid,gallery,textwatcher,texttransform,textmatch,tableresize,soundPlayer,selectallcontextmenu,savemarkdown,qrc,placeholder,niftyimages,onchange,mathedit,lineutils,internallink,inserthtmlfile,xmas,contextmenu,googlethisterm,eqneditor,custimage,niftytimers,pbckcode,codesnippet,codesnippetgeshi, allowsave,save-to-pdf,youtube,image2,uploadimage,tableresize,notification,language,emoji,video,html5audio,html5video,pastetools,button,html5audio,sharedspace,richcombo,panelbutton,panel,notificationaggregator,menubutton,menu,listblock,iframedialog,html5video,divarea,dialogui,colordialog,autogrow,floatpanel,panel,balloonpanel,toolbarswitch, image2, uploadimage, tableresize, notification, language, emoji, video, html5audio, allowsave, btbutton, closedialogoutside, codemirror, pre, powrcomments, deselect, imagerotate, closebtn, locationmap, nbsp, notification, numericinput, openlink, quicktable, save, showblocks, showprotected, smallerselection, toc, tableselection, toolbarswitch, xmltemplates, closebtn,youtubebootstrap,save,zoom',

         autoplaceholder: {
          tokenList: tokenList,
          defaultText: "Add Value"
        },        
        
        fileTools_defaultFileName : '',

        fileTools_requestHeaders : {},

        filebrowserBrowseUrl : '', //' /browser/browser.php',

        filebrowserFlashBrowseUrl : '',

        filebrowserFlashUploadUrl : '', //' /upload/upload.php',

        filebrowserImageBrowseLinkUrl : '',

        filebrowserImageBrowseUrl : '',

        filebrowserImageUploadUrl : '',

        filebrowserUploadMethod : 'xhr', // 'xhr' | 'form'

        filebrowserUploadUrl : '',

        filebrowserWindowFeatures : '',

        filebrowserWindowHeight : '70%',

        filebrowserWindowWidth : '80%',

        fillEmptyBlocks : true,

        find_highlight : {element: 'span', styles: {'background-color': '#004', color: '#fff'}},

        flashAddEmbedTag : false,

        flashConvertOnEdit : false,

        flashEmbedTagOnly : false,

        floatSpaceDockedOffsetX : 0,

        floatSpaceDockedOffsetY : 0,

        floatSpacePinnedOffsetX : 0,

        floatSpacePinnedOffsetY : 0,


        fontSize_defaultLabel : '14',

        fontSize_sizes : '8/8px;9/9px;10/10px;11/11px;12/12px;13/13px;14/14px;15/15px;16/16px;18/18px;20/20px;22/22px;24/24px;26/26px;36/36px;48/48px;72/72px;',

        //fontSize_style : {},

        font_defaultLabel : 'Times New Roman',

        font_names : 'Arial/Arial, Helvetica, sans-serif;' +
            'Comic Sans MS/Comic Sans MS, cursive;' +
            'Courier New/Courier New, Courier, monospace;' +
            'Georgia/Georgia, serif;' +
            'Lucida Sans Unicode/Lucida Sans Unicode, Lucida Grande, sans-serif;' +
            'Tahoma/Tahoma, Geneva, sans-serif;' +
            'Times New Roman/Times New Roman, Times, serif;' +
            'Trebuchet MS/Trebuchet MS, Helvetica, sans-serif;' +
            'Verdana/Verdana, Geneva, sans-serif',

        /**
        *
        *  {
        *        element:        'span',
        *        styles:         { 'font-family': '#(family)' },
        *        overrides:      [ { element: 'font', attributes: { 'face': null } } ]
        *    }
        *
        *
        */

        font_style : {
        },

        forceEnterMode : false,

        forcePasteAsPlainText : false, // false | true | 'allow-word'

        forceSimpleAmpersand : false,

        format_address : { element: 'address' },

        format_div : { element: 'div'},

        format_h1 : {element: 'h1'},

        format_h2 : {element: 'h2'},


        format_h3 : {element: 'h3'},

        format_h4 : {element: 'h4'},

        format_h5 : {element: 'h5'},
        
        format_h6 : {element: 'h6'},

        format_p : {element: 'p'},

        format_pre : {element : 'pre'},

        format_tags : 'p;h1;h2;h3;h4;h5;h6;pre;address;div',

        fullPage : false,

        grayt_autoStartup : false,

        height : 450,

        htmlEncodeOutput : false,

        ignoreEmptyParagraph : true,

        image2_alignClasses : null, // String[]

        image2_altRequired : false,

        image2_captionedClass : 'image',

        image2_disableResizer : false,

        image2_maxSize : '', // Object.<String, Number | String>
        /** config.image2_maxSize = {
                height: 300,
                width: 250
            };
         */

        image2_prefillDimensions : true,

        image_previewText : 'Lorem ipsum dolor...', // Padding text to set off the image in the preview area.


        image_removeLinkByEmptyURL : true,

        indentClasses : null, //config.indentClasses = ['Indent1', 'Indent2', 'Indent3'];

        indentOffset : 40,

        indentUnit : 'px', // 'pm'

        jqueryOverrideVal : false,

        justifyClasses : null,  // [ 'AlignLeft', 'AlignCenter', 'AlignRight', 'AlignJustify' ]

        keystrokes : [],

        language : '',

        language_list : [ 'ar:Arabic:rtl', 'fr:French', 'es:Spanish' ],

        linkDefaultProtocol : 'https://', // 'http://, 'https://', 'ftp://', 'news://'

        linkJavaScriptLinksAllowed : false,

        linkPhoneMsg : '', // linkPhoneMsg = "Invalid number";

        linkPhoneRegExp : '', // config.linkPhoneRegExp = /^[0-9]{9}$/

        linkShowAdvancedTab : true,

        linkShowTargetTab : true,

        magicline_color : '#FF0000',

        magicline_everywhere : false,

        magicline_holdDistance : 0.5,

        //magicline_keystrokeNext : CKEDITOR.CTRL + CKEDITOR.SHIFT + 52 (CTRL + SHIFT + 4),

        //magicline_keystrokePrevious : CKEDITOR.CTRL + CKEDITOR.SHIFT + 51 (CTRL + SHIFT + 3),

        magicline_tabuList : [ 'data-widget-wrapper' ],

        magicline_triggerOffset : 30,

        mathJaxClass : 'math-tex',

        mathJaxLib : '',

        //mentions : configDefinition[],

        menu_groups : '', // Defaults to see source. menu_groups = 'clipboard,table,anchor,link,image';

        menu_subMenuDelay : 400,

        newpage_html : '',

        notification_duration : 5000,

        on : {}, // Sets listeners on editor events.

        pasteFilter : '\'semantic-content\' in Chrome and Safari and `null` in other browsers',
        /** Possible values are:

         See source
         'plain-text' – Content will be pasted as a plain text.
         'semantic-content' – Known tags (except div, span) with all attributes (except style and class) will be kept.
         'h1 h2 p div' – Custom rules compatible with CKEDITOR.filter.
         null – Content will not be filtered by the paste filter (but it still may be filtered by Advanced Content Filter). This value can be used to disable the paste filter in Chrome and Safari, where this option defaults to 'semantic-content'.
         */

         pasteFromWordCleanupFile : '',

         pasteFromWordNumberedHeadingToList : false,

         pasteFromWordPromptCleanup : false,

         pasteFromWordRemoveStyles : true,

         pasteFromWord_heuristicsEdgeList : true,

         pasteFromWord_inlineImages : true,

         pasteTools_keepZeroMargins : false,

         //plugins : '', //  String | String[]

         protectedSource : [],

         readOnly : false,

         removeButtons : '',

         removeDialogTabs : '',

         removeFormatAttributes : 'class,style,lang,width,height,align,hspace,valign',

         removeFormatTags : 'b,big,cite,code,del,dfn,em,font,i,ins,kbd,q,s,samp,small,span,strike,strong,sub,su',

         removePlugins : 'image', // String | String[]

         resize_dir : 'vertical',

         resize_enabled : true,

         resize_maxHeight : 3000,

         resize_maxWidth : 3000,

         //resize_minHeight : 250,

         //resize_minWidth : 750,

         scayt_autoStartup : false,

         scayt_cacheSize : 4000,

        /**
         off – Disables all options.
         all – Enables all options.
         ignore – Enables the "Ignore" option.
         ignoreall – Enables the "Ignore All" option.
         add – Enables the "Add Word" option.
         option – Enables the "Options" menu item.
         language – Enables the "Languages" menu item.
         dictionary – Enables the "Dictionaries" menu item.
         about – Enables the "About" menu item.
         */

        scayt_contextCommands : 'ignoreall|add', // 'add|ignore|ignoreall'  |  'off' | 'all' | 'ignore' | 'ignoreall' | 'add' | 'option' | 'language' | 'dictionary' | 'about'

        /**
         *suggest – The main suggestion word list.
         moresuggest – The "More suggestions" word list.
         control – SCAYT commands, such as "Ignore" and "Add Word".
         */

        scayt_contextMenuItemsOrder : 'suggest|moresuggest|control', // 'moresuggest|control|suggest'  |  'suggest' | 'moresuggest' | 'control'

        scayt_customDictionaryIds : '', // '3021,3456,3478'

        scayt_customPunctuation : '', // '-'

        scayt_customerId : '1:WvF0D4-UtPqN1-43nkD4-NKvUm2-daQqk3-LmNiI-z7Ysb4-mwry24-T8YrS3-Q2tpq2',

        scayt_disableCache : false,

        /**
         *   Disabling one option.
         scayt_disableOptionsStorage = 'all';

         Disabling several options.
         scayt_disableOptionsStorage = ['lang', 'ignore-domain-nameOn', 'ignore-words-with-numbers'];
         */

        scayt_disableOptionsStorage : '', // 'options' | 'ignore-all-caps-words' | 'ignore-domain-nameOn' | 'ignore-words-with-mixed-cases' | 'ignore-words-with-numbers' | 'lang' | 'all'

        scayt_elementsToIgnore : 'style', // 'del,pre'

        scayt_handleCheckDirty : true,

        scayt_handleUndoRedo : true,

        scayt_ignoreAllCapsWords : false,

        scayt_ignoreDomainNames : false,

        scayt_ignoreWordsWithMixedCases : false,

        scayt_ignoreWordsWithNumbers : false,

        scayt_inlineModeImmediateMarkup : false,

        /**
         * // Display only three suggestions in the main context menu.
         config.scayt_maxSuggestions = 3;

         // Do not show the suggestions directly.
         scayt_maxSuggestions = 0;
         */

        scayt_maxSuggestions : 3,

        scayt_minWordLength : 3, // Set the minimum length of words that will be collected from editor text.
        // scayt_minWordLength = 5;

        scayt_moreSuggestions : 'on', // 'off'

        scayt_multiLanguageMode : false,

        /**
         *  Display misspellings in French language with green color and underlined with red waveline.
         config.scayt_multiLanguageStyles = {
                    'fr': 'color: green'
                 };

         *  Display misspellings in Italian language with green color and underlined with red waveline and German misspellings with red color only.
         config.scayt_multiLanguageStyles = {
                    'it': 'color: green',
                    'de': 'background-image: none; color: red'
                 };
         */

        scayt_multiLanguageStyles : {},

        scayt_sLang : 'en_US', // 'da_DK', 'de_DE', 'el_GR', 'en_CA', 'en_GB', 'en_US', 'es_ES', 'fi_FI', 'fr_CA', 'fr_FR', 'it_IT', 'nb_NO' 'nl_NL', 'sv_SE'
        //Customers with dedicated SCAYT license may also set 'pt_BR' and 'pt_PT'

        scayt_serviceHost : 'svc.webspellchecker.net',  // Defines the host for the WebSpellChecker service (ssrv.cgi) path.
        // config.scayt_serviceHost = 'my-host';

        scayt_servicePath : 'spellcheck31/script/ssrv.cgi',

        scayt_servicePort : '80',

        scayt_serviceProtocol : 'https',

        scayt_srcUrl : '//svc.webspellchecker.net/spellcheck31/wscbundle/wscbundle.js',

        scayt_uiTabs : '1,1,1', // scayt_uiTabs = '1,0,1'

        scayt_userDictionaryName : '', // scayt_userDictionaryName = 'MyDictionary';

        /** Place the toolbar inside the element with an ID of "someElementId" and the elements path into the element with an  ID of "anotherId".
         config.sharedSpaces = {
                top: 'someElementId',
                bottom: 'anotherId'
            };
         Place the toolbar inside the element with an ID of  "someElementId". The elements path will remain attached to the editor UI.
         config.sharedSpaces = {
                top: 'someElementId'
            };

         (Since 4.5.0)
         Place the toolbar inside a DOM element passed by a reference. The elements path will remain attached to the editor UI.
         var htmlElement = document.getElementById( 'someElementId' );
         config.sharedSpaces = {
                top: htmlElement
            };
         */

        sharedSpaces : {},

        /**
         * CKEDITOR.ENTER_P (1) – New <p> paragraphs are created.
         CKEDITOR.ENTER_BR (2) – Lines are broken with <br> elements.
         CKEDITOR.ENTER_DIV (3) – New <div> blocks are created.
         */
        shiftEnterMode : CKEDITOR.ENTER_BR,

        skin : '', // 'skin_name,skin_path'

        smiley_columns : 8,  //The number of columns to be generated by the smilies matrix.

        smiley_descriptions : ['smiley', 'sad', 'wink', 'laugh', 'frown', 'cheeky', 'blush', 'surprise', 'indecision', 'angry', 'angel', 'cool', 'devil', 'crying', 'enlightened', 'no', 'yes', 'heart', 'broken heart', 'kiss', 'mail'],

        smiley_images : ['regular_smile.png', 'sad_smile.png', 'wink_smile.png', 'teeth_smile.png', 'confused_smile.png', 'tongue_smile.png', 'embarrassed_smile.png', 'omg_smile.png', 'whatchutalkingabout_smile.png', 'angry_smile.png', 'angel_smile.png', 'shades_smile.png', 'devil_smile.png', 'cry_smile.png', 'lightbulb.png', 'thumbs_down.png', 'thumbs_up.png', 'heart.png', 'broken_heart.png', 'kiss.png', 'envelope.png'],

        smiley_path : CKEDITOR.basePath + 'plugins/smiley/images/',

        sourceAreaTabSize : 4,

        specialChars : ['!', '&quot;', '#', '$', '%', '&amp;', "'", '(', ')', '*', '+', '-', '.', '/', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', ':', ';', '&lt;', '=', '&gt;', '?', '@', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', '[', ']', '^', '_', '`', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', '{', '|', '}', '~', '&euro;', '&lsquo;', '&rsquo;', '&ldquo;', '&rdquo;', '&ndash;', '&mdash;', '&iexcl;', '&cent;', '&pound;', '&curren;', '&yen;', '&brvbar;', '&sect;', '&uml;', '&copy;', '&ordf;', '&laquo;', '&not;', '&reg;', '&macr;', '&deg;', '&sup2;', '&sup3;', '&acute;', '&micro;', '&para;', '&middot;', '&cedil;', '&sup1;', '&ordm;', '&raquo;', '&frac14;', '&frac12;', '&frac34;', '&iquest;', '&Agrave;', '&Aacute;', '&Acirc;', '&Atilde;', '&Auml;', '&Aring;', '&AElig;', '&Ccedil;', '&Egrave;', '&Eacute;', '&Ecirc;', '&Euml;', '&Igrave;', '&Iacute;', '&Icirc;', '&Iuml;', '&ETH;', '&Ntilde;', '&Ograve;', '&Oacute;', '&Ocirc;', '&Otilde;', '&Ouml;', '&times;', '&Oslash;', '&Ugrave;', '&Uacute;', '&Ucirc;', '&Uuml;', '&Yacute;', '&THORN;', '&szlig;', '&agrave;', '&aacute;', '&acirc;', '&atilde;', '&auml;', '&aring;', '&aelig;', '&ccedil;', '&egrave;', '&eacute;', '&ecirc;', '&euml;', '&igrave;', '&iacute;', '&icirc;', '&iuml;', '&eth;', '&ntilde;', '&ograve;', '&oacute;', '&ocirc;', '&otilde;', '&ouml;', '&divide;', '&oslash;', '&ugrave;', '&uacute;', '&ucirc;', '&uuml;', '&yacute;', '&thorn;', '&yuml;', '&OElig;', '&oelig;', '&#372;', '&#374', '&#373', '&#375;', '&sbquo;', '&#8219;', '&bdquo;', '&hellip;', '&trade;', '&#9658;', '&bull;', '&rarr;', '&rArr;', '&hArr;', '&diams;', '&asymp;'],

        startupFocus : false, // String | Boolean 'start', 'end'

        startupMode : 'wysiwyg',

        startupOutlineBlocks : false,

        startupShowBorders : true,

        stylesSet: [
            /* Inline Styles */
            { name: 'Marker',			element: 'span', attributes: { 'class': 'marker' } },
            { name: 'Cited Work',		element: 'cite' },
            { name: 'Inline Quotation',	element: 'q' },
            /* Object Styles */
            {
                name: 'Special Container',
                element: 'div',
                styles: {
                    padding: '5px 10px',
                    background: '#eee',
                    border: '1px solid #ccc'
                }
            },
            {
                name: 'Compact table',
                element: 'table',
                attributes: {
                    cellpadding: '5',
                    cellspacing: '0',
                    border: '1',
                    bordercolor: '#ccc'
                },
                styles: {
                    'border-collapse': 'collapse'
                }
            },
            { name: 'Borderless Table',		element: 'table',	styles: { 'border-style': 'hidden', 'background-color': '#E6E6FA' } },
            { name: 'Square Bulleted List',	element: 'ul',		styles: { 'list-style-type': 'square' } },
            /* Widget Styles */
            // We use this one to style the brownie picture.
            { name: 'Illustration', type: 'widget', widget: 'image', attributes: { 'class': 'image-illustration' } },
            // Media embed
            { name: '240p', type: 'widget', widget: 'embedSemantic', attributes: { 'class': 'embed-240p' } },
            { name: '360p', type: 'widget', widget: 'embedSemantic', attributes: { 'class': 'embed-360p' } },
            { name: '480p', type: 'widget', widget: 'embedSemantic', attributes: { 'class': 'embed-480p' } },
            { name: '720p', type: 'widget', widget: 'embedSemantic', attributes: { 'class': 'embed-720p' } },
            { name: '1080p', type: 'widget', widget: 'embedSemantic', attributes: { 'class': 'embed-1080p' } }
        ], //  String | Array | Boolean

        stylesheetParser_skipSelectors : '/(^body\.|^\.)/i',

        stylesheetParser_validSelectors : '/\\w+\\.\\w+/',

        tabIndex : 0, // tabIndex : 1

        tabSpaces : 0,  // Number

        templates : 'default',

        templates_files : [],

        templates_replaceContent : true,

        title : '',  // String | Boolean, Defaults to based on editor.name

        toolbarCanCollapse : false,

        /**
         * When enabled, causes the Arrow keys navigation to cycle within the current toolbar group. Otherwise the Arrow keys will move through all items available in the toolbar. The Tab key will still be used to quickly jump among the toolbar group.
         */

        toolbarGroupCycling : true,

        /**  Default setting.
         config.toolbarGroups = [
         { name: 'document',    group: [ 'mode', 'document', 'doctools' ] },
         { name: 'clipboard',   group: [ 'clipboard', 'undo' ] },
         { name: 'editing',     group: [ 'find', 'selection', 'spellchecker' ] },
         { name: 'forms' },
         '/',
         { name: 'basicstyles', group: [ 'basicstyles', 'cleanup' ] },
         { name: 'paragraph',   group: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
         { name: 'links' },
         { name: genInsertt' },
         '/',
         { name: 'styles' },
         { name: 'colors' },
         { name: 'tools' },
         { name: 'others' },
         { name: 'about' }
         ];
         */

        toolbarGroups : [],


        toolbarLocation : 'top', // 'bottom'

        toolbarStartupExpanded : true,

        uiColor : '', //  '#AADC6E', 'Gold';

        undoStackSize : '20',

        uploadUrl : '',

        useComputedState : true,

        width : ' ', // String | Number '850', '75%'

        wsc_cmd : 'speel',

        wsc_customDictionaryIds : ' ',

        wsc_customLoaderScript : ' ',

        wsc_customerId : '1:ua3xw1-2XyGJ3-GWruD3-6OFNT1-oXcuB1-nR6Bp4-hgQHc-EcYng3-sdRXG3-NOfFk',



        wsc_lang : 'en_US', // 'da_DK', 'de_DE', 'el_GR', 'en_CA', 'en_GB', 'en_US', 'es_ES', 'fi_FI', 'fr_CA', 'fr_FR', 'it_IT', 'nb_NO' 'nl_NL', 'sv_SE'

        wsc_left : '', // Defaults to In the middle of the screen

        wsc_top : '', // Defaults to In the middle of the screen.

        wsc_userDictionaryName : '',

        wsc_width : '580',

        codemirror : {
	
	// Whether or not you want Brackets to automatically close themselves
	autoCloseBrackets: true,

     // Whether or not you want tags to automatically close themselves
	autoCloseTags: true,

     // Whether or not to automatically format code should be done when the editor is loaded
	autoFormatOnStart: true, 
	
	// Whether or not to automatically format code which has just been uncommented
	autoFormatOnUncomment: true,
	
	// Whether or not to continue a comment when you press Enter inside a comment block
	continueComments: true,

     // Whether or not you wish to enable code folding (requires 'lineNumbers' to be set to 'true')
	enableCodeFolding: true,
	
	// Whether or not to enable code formatting
	enableCodeFormatting: true,
	
	// Whether or not to enable safe tools, CTRL+F (Find), CTRL+SHIFT+F (Replace), CTRL+SHIFT+R (Replace All), CTRL+G (Find Next), CTRL+SHIFT+G (Find Previous)
	enableSearchTools: true,
	
	// Whether or not to highlight all matches of current word/selection
	highlightMatches: true,

     // Whether, when indenting, the first N*tabSize spaces should be replaced by N tabs
	indentWithTabs: false,

     // Whether or not you want to show line numbers
	lineNumbers: true,
	
	// Whether or not you want to use line wrapping
	lineWrapping: true,

     // Define the language specific mode 'htmlmixed' for html  including (css, xml, javascript), 'application/x-httpd-php' for php mode including html, or 'text/javascript' for using java script only 
	mode: 'htmlmixed',
	
	// Whether or not you want to highlight matching braces
	matchBrackets: true,
	
	// Whether or not you want to highlight matching tags
	matchTags: true,

	// Whether or not to show the showAutoCompleteButton   button on the toolbar
	showAutoCompleteButton: true,
     
     // Whether or not to show the comment button on the toolbar
	showCommentButton: true,

	// Whether or not to show the format button on the toolbar
	showFormatButton: true,

     // Whether or not to show the safe Code button on the toolbar
	showSearchButton: true,

     // Whether or not to show Trailing Spaces
	showTrailingSpace: true,
	
	// Whether or not to show the uncomment button on the toolbar
	showUncommentButton: true,
     // Whether or not to highlight the currently active line

	styleActiveLine: true,

     // Set this to the theme you wish to use (codemirror themes)
	theme: 'default',
	
	// "Whether or not to use Beautify for auto formatting On start
	useBeautifyOnStart: false,

    ckfinder: true, 

    numericinput_modifyfields: {
    'table': {
        'info' : {
            'txtRows': {
                'min': 1
            },
            'txtCols': {
                'min': 1
            },
            'txtBorder': {
                'min': 0,
                'controlStyle': 'width: 4em',
            },
            'txtCellSpace': {
                'min': 0,
                'controlStyle': 'width: 4em',
            },
            'txtCellPad': {
                'min': 0,
                'controlStyle': 'width: 4em',
            }
        }
    }
}
 },
 openlink_enableReadOnly: true,

 openlink_target: '_self',
  
     });
    
    ckeditorjs.on('afterPaste', {afterPaste});
    
    ckeditorjs.on('afterPasteFromWord', {afterPasteFromWord});

    ckeditorjs.on( 'focus', {focus} );

    ckeditorjs.on('activeEnterModeChange', {activeEnterModeChange});

    ckeditorjs.on('activeFilterChange', {activeFilterChange});

    ckeditorjs.on('afterCommandExec', {afterCommandExec});

    ckeditorjs.on('afterInsertHtml', {afterInsertHtml});

    ckeditorjs.on('afterSetData', {afterSetData});

    ckeditorjs.on('afterUndoImage', {afterUndoImage});

    // ckeditorjs.on('ariaEditorHelpLabel', {ariaEditorHelpLabel});
    
    ckeditorjs.on('ariaWidget', {ariaWidget});

    ckeditorjs.on('autogrow', {autogrow});
    
    ckeditorjs.on('beforeCommandExec', {beforeCommandExec});
    
    ckeditorjs.on('beforeDestroy', {beforeDestroy});

    ckeditorjs.on('beforeGetData', {beforeGetData});

    ckeditorjs.on('beforeModeUnload', {beforeModeUnload});

    ckeditorjs.on('beforeSetMode', {beforeSetMode});

    ckeditorjs.on('blur', {blur});

    ckeditorjs.on('change', {change});

    ckeditorjs.on('configLoaded', {configLoaded});

    ckeditorjs.on('contentDirChanged', {contentDirChanged});
    
    ckeditorjs.on('contentDom', {contentDom});

    ckeditorjs.on('contentDomInvalidated', {contentDomInvalidated});

    ckeditorjs.on('contentDomUnload', {contentDomUnload});

    ckeditorjs.on('customConfigLoaded', {customConfigLoaded});

    ckeditorjs.on('dataFiltered', {dataFiltered});

    ckeditorjs.on('dataReady', {dataReady});

    ckeditorjs.on('destroy', {destroy});

    ckeditorjs.on('dialogHide', {dialogHide});

    ckeditorjs.on('dialogShow', {dialogShow});

    ckeditorjs.on('dirChanged', {dirChanged});

    ckeditorjs.on('doubleclick', {doubleclick});

    ckeditorjs.on('dragend', {dragend});

    ckeditorjs.on('dragstart', {dragstart});

    ckeditorjs.on('drop', {drop});

    ckeditorjs.once('elementsPathUpdate', {elementsPathUpdate});

    ckeditorjs.once('fileUploadRequest', {fileUploadRequest});

    //ckeditorjs.on('fileUploadResponse', {fileUploadResponse});

    ckeditorjs.on('floatingSpaceLayout', {floatingSpaceLayout});

    //ckeditorjs.on('getData', {getData});

    ckeditorjs.on('getSnapshot', {getSnapshot});

    ckeditorjs.on('insertElement', {insertElement});

    ckeditorjs.on('insertText', {insertText});

    ckeditorjs.on('key', {key});

    ckeditorjs.on('langLoaded', {langLoaded});

    ckeditorjs.on('loadSnapshot', {loadSnapshot});

    ckeditorjs.on('loaded', {loaded});

    ckeditorjs.on('lockSnapshot', {lockSnapshot});

    ckeditorjs.on('maximize', {maximize});

    ckeditorjs.on('menuShow', {menuShow});

    ckeditorjs.on('mode', {mode});

    ckeditorjs.on('notificationHide', {notificationHide});

    ckeditorjs.on('notificationShow', {notificationShow});

    ckeditorjs.on('notificationUpdate', {notificationUpdate});

    ckeditorjs.on('paste', {paste});

    ckeditorjs.on('pasteFromWord', {pasteFromWord});

    ckeditorjs.on('pluginsLoaded', {pluginsLoaded});

    ckeditorjs.on('readOnly', {readOnly});

    ckeditorjs.on('removeFormatCleanup', {removeFormatCleanup});

    ckeditorjs.on('required', {required});

    ckeditorjs.on('resize', {resize});

    ckeditorjs.on('save', {save});

    ckeditorjs.on('saveSnapshot', {saveSnapshot});

    ckeditorjs.on('selectionChange', {selectionChange});

    ckeditorjs.on('setData', {setData});

    ckeditorjs.on('stylesSet', {stylesSet});

    ckeditorjs.on('template', {template});

    ckeditorjs.on('toDataFormat', {toDataFormat});

    ckeditorjs.on('toHtml', {toHtml});

    ckeditorjs.on('uiSpace', {uiSpace});

    ckeditorjs.on('unlockSnapshot', {unlockSnapshot});

    ckeditorjs.on('updateSnapshot', {updateSnapshot});

    ckeditorjs.on('widgetDefinition', {widgetDefinition});
    
    
    
     $('#getDate').on('click', function(){
        var value = CKEDITOR.instances['{id}'].getData();
        console.log(value);
     });  
         
     /*    ckeditorjs.on('change', function () {
           var value = CKEDITOR.instances['{id}'].getData();
            document.querySelector('#hiddenEditor').value = value;
            
    });
         
     $('#{getDate}').on('click', function(){
       var date = Date();
        $('#{iconPicker}').val(date.getDate());
         });
        
         ckeditorjs.on( 'change', function( evt ) {
                console.log(ckeditorjs.getData());
            });*/

JS,
    ];
    /**
     *
     * Constants
     */

    public function asset()
    {
        // $this->fileJs('/publish/yarner/ckeditor4-dev/ckeditor.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/ckeditor4-dev@4.14.0/ckeditor.js');
        $this->fileJs('https://cdn.ckeditor.com/ckeditor5/18.0.0/inline/ckeditor.js');

    }
    public function codes()
    {
        /*$className = bname($this->model::className());*/

        $this->htm = strtr($this->_layout['main'], [
            '{id}' => $this->id,
            '{name}' => $this->name,
            '{value}' => $this->value,

            '{placeholder}' => $this->_config['placeholder'],

        ]);
        $pluginsReplace = '';
        foreach($this->plugins as $key => $value) {
            $pluginsReplace .= "CKEDITOR.plugins.addExternal($key, $value);";

        };

        $this->js = strtr($this->_layout['js'], [
            '{plugins}' => $pluginsReplace,
            '{id}' => $this->id,
            '{focus}' => $this->eventCode('focus'),
            '{afterPaste}' => $this->eventCode('afterPaste'),
            '{afterPasteFromWord}' => $this->eventCode('afterPasteFromWord'),
            '{activeEnterModeChange}' => $this->eventCode('activeEnterModeChange'),
            '{activeFilterChange}' => $this->eventCode('activeFilterChange'),
            '{afterCommandExec}' => $this->eventCode('afterCommandExec'),
            '{afterInsertHtml}' => $this->eventCode('afterInsertHtml'),
            '{afterSetData}' => $this->eventCode('afterSetData'),
            '{afterUndoImage}' => $this->eventCode('afterUndoImage'),
            '{ariaWidget}' => $this->eventCode('ariaWidget'),
            '{autogrow}' => $this->eventCode('autogrow'),
            '{beforeCommandExec}' => $this->eventCode('beforeCommandExec'),
            '{beforeDestroy}' => $this->eventCode('beforeDestroy'),
            '{beforeGetData}' => $this->eventCode('beforeGetData'),
            '{beforeModeUnload}' => $this->eventCode('beforeModeUnload'),
            '{beforeSetMode}' => $this->eventCode('beforeSetMode'),
            '{blur}' => $this->eventCode('blur'),
            '{change}' => $this->eventCode('change'),
            '{configLoaded}' => $this->eventCode('configLoaded'),
            '{contentDirChanged}' => $this->eventCode('contentDirChanged'),
            '{contentDom}' => $this->eventCode('contentDom'),
            '{contentDomInvalidated}' => $this->eventCode('contentDomInvalidated'),
            '{contentDomUnload}' => $this->eventCode('contentDomUnload'),
            '{customConfigLoaded}' => $this->eventCode('customConfigLoaded'),
            '{dataFiltered}' => $this->eventCode('dataFiltered'),
            '{dataReady}' => $this->eventCode('dataReady'),
            '{destroy}' => $this->eventCode('destroy'),
            '{dialogHide}' => $this->eventCode('dialogHide'),
            '{dialogShow}' => $this->eventCode('dialogShow'),
            '{dirChanged}' => $this->eventCode('dirChanged'),
            '{doubleclick}' => $this->eventCode('doubleclick'),
            '{dragend}' => $this->eventCode('dragend'),
            '{dragstart}' => $this->eventCode('dragstart'),
            '{drop}' => $this->eventCode('drop'),
            '{fileUploadRequest}' => $this->eventCode('fileUploadRequest'),
            '{elementsPathUpdate}' => $this->eventCode('elementsPathUpdate'),
            '{floatingSpaceLayout}' => $this->eventCode('floatingSpaceLayout'),
            '{getDatat}' => $this->eventCode('getData'),
            '{getSnapshot}' => $this->eventCode('getSnapshot'),
            '{insertElement}' => $this->eventCode('insertElement'),
            '{insertText}' => $this->eventCode('insertText'),
            '{key}' => $this->eventCode('key'),
            '{langLoaded}' => $this->eventCode('langLoaded'),
            '{loadSnapshot}' => $this->eventCode('loadSnapshot'),
            '{loaded}' => $this->eventCode('loaded'),
            '{lockSnapshot}' => $this->eventCode('lockSnapshot'),
            '{maximize}' => $this->eventCode('maximize'),
            '{menuShow}' => $this->eventCode('menuShow'),
            '{mode}' => $this->eventCode('mode'),
            '{notificationHide}' => $this->eventCode('notificationHide'),
            '{notificationShow}' => $this->eventCode('notificationShow'),
            '{notificationUpdate}' => $this->eventCode('notificationUpdate'),
            '{paste}' => $this->eventCode('paste'),
            '{pasteFromWord}' => $this->eventCode('pasteFromWord'),
            '{pluginsLoaded}' => $this->eventCode('pluginsLoaded'),
            '{readOnly}' => $this->eventCode('readOnly'),
            '{removeFormatCleanup}' => $this->eventCode('removeFormatCleanup'),
            '{required}' => $this->eventCode('required'),
            '{resize}' => $this->eventCode('resize'),
            '{save}' => $this->eventCode('save'),
            '{saveSnapshot}' => $this->eventCode('saveSnapshot'),
            '{selectionChange}' => $this->eventCode('selectionChange'),
            '{setData}' => $this->eventCode('setData'),
            '{stylesSet}' => $this->eventCode('stylesSet'),
            '{template}' => $this->eventCode('template'),
            '{toDataFormat}' => $this->eventCode('toDataFormat'),
            '{toHtml}' => $this->eventCode('toHtml'),
            '{uiSpace}' => $this->eventCode('uiSpace'),
            '{unlockSnapshot}' => $this->eventCode('unlockSnapshot'),
            '{updateSnapshot}' => $this->eventCode('updateSnapshot'),
            '{widgetDefinition}' => $this->eventCode('widgetDefinition'),
        ]);
    }
}
