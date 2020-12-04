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
 * Created By: Jahogir Qudratov
 */
class ZCKeditorJsWidget_ extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [

    ];

    /**
     *
     * Plugin Events
     * https://select2.org/programmatic-control/events
     */
    public $event = [];
    public $_event = [

    ];

    public $plugins = [
        'quicktable' => '/publish/editor/Usability/Quicktable/quicktable_1.0.6/quicktable/plugin.js',
        'html5audio' => '/publish/inputs/ckeditor/plugins/html5audio/plugin.js',
    ];

    public $layout = [];
    public $_layout = [

        'main' => <<<HTML
            <textarea id="{id}" placeholder="{placeholder}" name="{name}"> {value}
            </textarea>
HTML,

        'js' => <<<JS

    /**
     *  all config documentation here
     * https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_config.html
     *
     */
     //Usability
    CKEDITOR.plugins.addExternal('video', '/publish/inputs/ckeditor/video/plugin.js');
    CKEDITOR.plugins.addExternal('html5audio', '/publish/inputs/ckeditor/plugins/html5audio/plugin.js');
    CKEDITOR.plugins.addExternal('allowsave', '/publish/editor/Usability/Allow Save/allowsave_1.0/allowsave/plugin.js');
    CKEDITOR.plugins.addExternal('btbutton', '/publish/editor/Usability/Bootstrap 3 Button Widget/btbutton_1.0/btbutton/plugin.js');

    CKEDITOR.plugins.addExternal('closedialogoutside', '/publish/editor/Usability/Close Dialog Outside/closedialogoutside_1.0.0.1/closedialogoutside/plugin.js'); // toolbarga chiqmadi
    CKEDITOR.plugins.addExternal('closedialogoutside', '/render/inputes/ZCkEditorJsWidget/assets/Usability/Close Dialog Outside/closedialogoutside_1.0.0.1/closedialogoutside/plugin.js'); // toolbarga chiqmadi
    CKEDITOR.plugins.addExternal('codemirror', '/publish/editor/Usability/CodeMirror (Source) Syntax Highlighting/codemirror_1.17.13/codemirror/plugin.js'); // toolbarga chiqmadi
    CKEDITOR.plugins.addExternal('pre', '/publish/editor/Usability/Collapsible Snippet/pre_1.0b2/pre/plugin.js'); 
    CKEDITOR.plugins.addExternal('powrcomments', '/publish/editor/Usability/Comments/powrcomments/plugin.js'); // toolbarga chiqmadi

    CKEDITOR.plugins.addExternal('deselect', '/publish/editor/Usability/Deselect for IE11 bugfix/deselect/plugin.js'); // toolbarga chiqmadi
    CKEDITOR.plugins.addExternal('imagerotate', '/publish/editor/Usability/Image Rotate/imagerotate/plugin.js'); // toolbarga chiqmadi
    CKEDITOR.plugins.addExternal('closebtn', '/publish/editor/Usability/Inline Close Button/closebtn/plugin.js'); 
    CKEDITOR.plugins.addExternal('locationmap', '/publish/editor/Usability/Location Map (Google)/locationmap/plugin.js');
    CKEDITOR.plugins.addExternal('nbsp', '/publish/editor/Usability/Non-breaking space/nbsp_1.1/nbsp/plugin.js'); //toolbarga chiqmadi
    CKEDITOR.plugins.addExternal('notification', '/publish/editor/Usability/Notification/notification_4.13.1/notification/plugin.js'); // toolbarga chiqmadi
    CKEDITOR.plugins.addExternal('numericinput', '/publish/editor/Usability/Numeric Input/numericinput_0.2/numericinput/plugin.js'); // toolbarga chiqmadi
    CKEDITOR.plugins.addExternal('openlink', '/publish/editor/Usability/Open Link/openlink_1.0.4/openlink/plugin.js'); 
    CKEDITOR.plugins.addExternal('quicktable', '/publish/editor/Usability/Quicktable/quicktable_1.0.6/quicktable/plugin.js'); // toolbarga chiqmadi
    // CKEDITOR.plugins.addExternal('resizewithwindow', '/publish/editor/Usability/Resize with window/resizewithwindow_4.3.3/resizewithwindow/plugin.js');
    CKEDITOR.plugins.addExternal('save', '/publish/editor/Usability/Save/save_4.13.1/save/plugin.js');
    CKEDITOR.plugins.addExternal('showblocks', '/publish/editor/Usability/Show Blocks/showblocks_4.13.1/showblocks/plugin.js'); // toolbarga chiqmadi
    CKEDITOR.plugins.addExternal('showprotected', '/publish/editor/Usability/Show Protected/showprotected_1.0.0/showprotected/plugin.js'); // toolbarga chiqmadi
    CKEDITOR.plugins.addExternal('smallerselection', '/publish/editor/Usability/Smaller Selection/smallerselection_0.1.1/smallerselection/plugin.js'); // toolbarga chiqmadi
    // CKEDITOR.plugins.addExternal('ckeditortablecellsselection', '/publish/editor/Usability/Table Cells Selection/ckeditortablecellsselection_0.0.2/ckeditortablecellsselection/plugin.js');
    CKEDITOR.plugins.addExternal('toc', '/publish/editor/Usability/Table of Contents/toc_3.1/toc/plugin.js');
    CKEDITOR.plugins.addExternal('tableselection', '/publish/editor/Usability/Table Selection/tableselection_4.13.1/tableselection/plugin.js'); // toolbarga chiqmadi
    CKEDITOR.plugins.addExternal('toolbarswitch', '/publish/editor/Usability/Toolbar switch on Maximize/toolbarswitch_4.3.2/toolbarswitch/plugin.js');
    CKEDITOR.plugins.addExternal('xmltemplates', '/publish/editor/Usability/XML Templates/xmltemplates_1.0/xmltemplates/plugin.js'); // toolbarga chiqmadi
    CKEDITOR.plugins.addExternal('youtubebootstrap', '/publish/editor/Usability/Youtube bootstrap/youtubebootstrap_1.0/youtubebootstrap/plugin.js');
    CKEDITOR.plugins.addExternal('zoom', '/publish/editor/Usability/Zoom/zoom_2.2/zoom/plugin.js');
    //UI
    CKEDITOR.plugins.addExternal("panel", "/publish/editor/UI/Panel/panel_4.13.1/panel/plugin.js");
    CKEDITOR.plugins.addExternal(  "floatpanel", "/publish/editor/UI/Floating Panel/floatpanel_4.13.1/floatpanel/plugin.js");
    CKEDITOR.plugins.addExternal("googlesearch", "/publish/editor/UI/Google Search/googlesearch_1.1/googlesearch/plugin.js");
    CKEDITOR.plugins.addExternal("autogrow", "/publish/editor/UI/Auto Grow/autogrow_4.13.1/autogrow/plugin.js");
    CKEDITOR.plugins.addExternal("balloonpanel", "/publish/editor/UI/Balloon Panel/balloonpanel_4.13.1/balloonpanel/plugin.js");
    CKEDITOR.plugins.addExternal("colordialog","/publish/editor/UI/Color Dialog/colordialog_4.13.1/colordialog/plugin.js");
    CKEDITOR.plugins.addExternal("dialogui","/publish/editor/UI/Dialog User Interface/dialogui_4.13.1/dialogui/plugin.js");
    CKEDITOR.plugins.addExternal("divarea","/publish/editor/UI/Div Editing Area/divarea_4.13.1/divarea/plugin.js");
    CKEDITOR.plugins.addExternal("html5video","/publish/editor/UI/HTML5 video/html5video_1.2/ckeditor-html5-video-master/html5video/plugin.js");
    CKEDITOR.plugins.addExternal("iframedialog","/publish/editor/UI/IFrame Dialog Field/iframedialog_4.13.1/iframedialog/plugin.js");
    CKEDITOR.plugins.addExternal("imageresizerowandcolumn","/publish/editor/UI/Image Resizer(Width and Height)/imageresizerowandcolumn_1.0.0/imageresizerowandcolumn/plugin.js");
    CKEDITOR.plugins.addExternal("symbol","/publish/editor/UI/Insert Symbol/symbol_1.07_0/symbol/plugin.js");
    CKEDITOR.plugins.addExternal("listblock","/publish/editor/UI/List Block/listblock_4.13.1/listblock/plugin.js");
    /*
    CKEDITOR.plugins.addExternal("lite","/publish/editor/UI/LoopIndex Track Changestive Edit/liveedit_0.3/liveedit/plugin.js");*/
    //CKEDITOR.plugins.addExternal("lite","/publish/editor/UI//lite_1.2.30/lite/plugin.js");  //Oshibka
    CKEDITOR.plugins.addExternal("menu","/publish/editor/UI/Menu/menu_4.13.1/menu/plugin.js");  //oshibka
    CKEDITOR.plugins.addExternal("menubutton","/publish/editor/UI/Menu Button/menubutton_4.13.1/menubutton/plugin.js");
    CKEDITOR.plugins.addExternal("notificationaggregator","/publish/editor/UI/Notification Aggregator/notificationaggregator_4.13.1/notificationaggregator/plugin.js");
    CKEDITOR.plugins.addExternal("pacatube","/publish/editor/UI/PacaTube/pacatube_0.1/pacatube/plugin.js");
    CKEDITOR.plugins.addExternal("panel","/publish/editor/UI/Panel/panel_4.13.1/panel/plugin.js");
    CKEDITOR.plugins.addExternal("panelbutton","/publish/editor/UI/Panel Button/panelbutton_4.13.1/panelbutton/plugin.js");
    CKEDITOR.plugins.addExternal("richcombo","/publish/editor/UI/Rich Combo/richcombo_4.13.1/richcombo/plugin.js");
    CKEDITOR.plugins.addExternal("sharedspace","/publish/editor/UI/Shared Space/sharedspace_4.13.1/sharedspace/plugin.js");
    CKEDITOR.plugins.addExternal("html5audio","/publish/editor/UI/Simple HTML5 audio/html5audio_1.5.2/html5audio/plugin.js");
    CKEDITOR.plugins.addExternal("staticspace","/publish/editor/UI/Static Space/staticspace_1.2.0/staticspace/plugin.js");
    CKEDITOR.plugins.addExternal("tabletoolstoolbar","/publish/editor/UI/Table Tools Toolbar/tabletoolstoolbar_0.0.1/tabletoolstoolbar/plugin.js");
    CKEDITOR.plugins.addExternal("button","/publish/editor/UI/UI Button/button_4.13.1/button/plugin.js");
   

   /*  
    Accessibility 
    */

    CKEDITOR.plugins.addExternal('a11ystylescombo', '/publish/editor/Accessibility/A11yFirst Character Style/a11ystylescombo_1.2.3/a11ystylescombo/plugin.js');
    CKEDITOR.plugins.addExternal('a11yheading', '/publish/editor/Accessibility/A11yFirst Heading/a11yheading/plugin.js');
    CKEDITOR.plugins.addExternal('a11yimage', '/publish/editor/Accessibility/A11yFirst Image/a11yimage/plugin.js');
    CKEDITOR.plugins.addExternal('a11ylink', '/publish/editor/Accessibility/A11yFirst Link/a11ylink_1.2.3/a11ylink/plugin.js');
    CKEDITOR.plugins.addExternal('ckwebspeech', '/publish/editor/Accessibility/CKWebSpeech Voice to Text/ckwebspeech_1.0.0/ckwebspeech/plugin.js');
    CKEDITOR.plugins.addExternal('easykeymap', '/publish/editor/Accessibility/Easy Keymap/easykeymap_1.2/ckeditor-easykeymap-plugin-master/easykeymap/plugin.js');
    CKEDITOR.plugins.addExternal('FMathEditor', '/publish/editor/Accessibility/FMath Editor/fmatheditor_3.3/FMathEditor/plugin.js');
    CKEDITOR.plugins.addExternal('inlinecancel', '/publish/editor/Accessibility/Inline Cancel/inlinecancel_2.7.1/inlinecancel/plugin.js');
    CKEDITOR.plugins.addExternal('textselection', '/publish/editor/Accessibility/Keep TextSelection/textselection_1.08/textselection/plugin.js');
    CKEDITOR.plugins.addExternal('language', '/publish/editor/Accessibility/Language/language_4.13.1/language/plugin.js');
    CKEDITOR.plugins.addExternal('performx', '/publish/editor/Accessibility/PerformX OpenAccess/performx/plugin.js');
    CKEDITOR.plugins.addExternal('sketchfab', '/publish/editor/Accessibility/Sketchfab CKEditor Plugin/sketchfab_1.0rc/ckeditor-plugin-master/src/ckeditor-plugin/sketchfab/plugin.js');
    CKEDITOR.plugins.addExternal('widgetcontextmenu', '/publish/editor/Accessibility/Widget Context Menu/widgetcontextmenu_1.13/widgetcontextmenu/plugin.js');
    /*
    Clipboard
    */

    CKEDITOR.plugins.addExternal('copyformatting', '/publish/editor/Clipboard/Copy Formatting/copyformatting_4.13.1/copyformatting/plugin.js');
    CKEDITOR.plugins.addExternal('extraformattributes', '/publish/editor/Clipboard/Extra Form Attributes/extraformattributes_1.0_0/extraformattributes/plugin.js');
    CKEDITOR.plugins.addExternal('imagepaste', '/publish/editor/Clipboard/Image Paste/imagepaste_1.1.1/imagepaste/plugin.js');
    CKEDITOR.plugins.addExternal('imageuploader', '/publish/editor/Clipboard/Image Uploader and Browser for CKEditor/imageuploader_4.1.8/imageuploader/plugin.js');
    CKEDITOR.plugins.addExternal('inserthtml4x', '/publish/editor/Clipboard/inserthtml4x/inserthtml4x_2.0_0/inserthtml4x/plugin.js');
    CKEDITOR.plugins.addExternal('pastecode', '/publish/editor/Clipboard/Paste code/pastecode_0.1/pastecode/plugin.js');
    CKEDITOR.plugins.addExternal('pasteFromGoogleDoc', '/publish/editor/Clipboard/Paste From Google Doc/pastefromgoogledoc_1.0/pasteFromGoogleDoc/plugin.js');
    CKEDITOR.plugins.addExternal('pastebase64', '/publish/editor/Clipboard/Paste image as base64/pastebase64_1.0/pastebase64/plugin.js');
    CKEDITOR.plugins.addExternal('pastetools', '/publish/editor/Clipboard/Paste Tools/pastetools_4.13.1/pastetools/plugin.js');
    //CKEDITOR.plugins.addExternal('pasteUploadImage', '/publish/editor/Clipboard/Paste Upload Image/pasteuploadimage_0.3/pasteUploadImage/plugin.js');
    //CKEDITOR.plugins.addExternal('uploadfile', '/publish/editor/Clipboard/Upload File/uploadfile_4.13.1/uploadfile/plugin.js');
    CKEDITOR.plugins.addExternal('uploadwidget', '/publish/editor/Clipboard/Upload Widget/uploadwidget_4.13.1/uploadwidget/plugin.js');

    /**
        Contents
    */
    CKEDITOR.plugins.addExternal('ccmsacdc', '/publish/editor/Contents/ACDC Placeholder/ccmsacdc_1.1/ccmsacdc/plugin.js');
    CKEDITOR.plugins.addExternal('autocomplete', '/publish/editor/Contents/Autocomplete/autocomplete_4.13.1/autocomplete/plugin.js');
    CKEDITOR.plugins.addExternal('base64image', '/publish/editor/Contents/Base64 Image/base64image_1.3/base64image/plugin.js');
    CKEDITOR.plugins.addExternal('templates', '/publish/editor/Contents/Content Templates/templates_4.13.1/templates/plugin.js');
    CKEDITOR.plugins.addExternal('emoji', '/publish/editor/Contents/Emoji/emoji_4.13.1/emoji/plugin.js');
    CKEDITOR.plugins.addExternal('image2', '/publish/editor/Contents/Enhanced Image/image2_4.13.1/image2/plugin.js');
    CKEDITOR.plugins.addExternal('fastimage', '/publish/editor/Contents/FastImage/fastimage_0.2a/fastimage/plugin.js');
    CKEDITOR.plugins.addExternal('flash', '/publish/editor/Contents/Flash Dialog/flash_4.13.1/flash/plugin.js');
    CKEDITOR.plugins.addExternal('forms', '/publish/editor/Contents/Form Elements/forms_4.13.1/forms/plugin.js');
    CKEDITOR.plugins.addExternal('googledocs', '/publish/editor/Contents/Google Docs/googledocs_1.0/googledocs/plugin.js');
    CKEDITOR.plugins.addExternal('imagebrowser', '/publish/editor/Contents/Image Browser/imagebrowser_2.0.2_0/imagebrowser/plugin.js');
    CKEDITOR.plugins.addExternal('imageresize', '/publish/editor/Contents/Image Resize/imageresize_1.0.2/imageresize/plugin.js'); // toolbarga chiqmadi
    CKEDITOR.plugins.addExternal('insertpre', '/publish/editor/Contents/Insert element/insertpre_1.1/insertpre/plugin.js');
    CKEDITOR.plugins.addExternal('smiley', '/publish/editor/Contents/Insert Smiley/smiley_4.13.1/smiley/plugin.js');
    CKEDITOR.plugins.addExternal('lightbox', '/publish/editor/Contents/Lightbox/lightbox_2.1/lightbox/plugin.js');
    CKEDITOR.plugins.addExternal('oembed', '/publish/editor/Contents/Media (oEmbed) Plugin/oembed_1.18.1/oembed/plugin.js');
    // CKEDITOR.plugins.addExternal('embed', '/publish/editor/Contents/Media Embed/embed_4.13.1/embed/plugin.js');
    CKEDITOR.plugins.addExternal('tliyoutube2', '/publish/editor/Contents/Minimal YouTube [multi-language]/tliyoutube2_1.1/tliyoutube2/plugin.js');
    CKEDITOR.plugins.addExternal('page2images', '/publish/editor/Contents/Online Website Screenshot Generator/page2images_1.0.2/page2images/plugin.js'); //toolbarga chiqmadi
    CKEDITOR.plugins.addExternal('pagebreak', '/publish/editor/Contents/Page Break/pagebreak_4.13.1/pagebreak/plugin.js');
    CKEDITOR.plugins.addExternal('ccmssourcedialog', '/publish/editor/Contents/Read only Source Dialog/ccmssourcedialog_1.0rc_0/ccmssourcedialog/plugin.js'); //toolbarga chiqmadi
    CKEDITOR.plugins.addExternal('replaceTagNameByBsquochoai', '/publish/editor/Contents/Replace (change) tagName of current element/replacetagnamebybsquochoai_1.2/replaceTagNameByBsquochoai/plugin.js'); //toolbarga chiqmadi
    CKEDITOR.plugins.addExternal('save-to-pdf', '/publish/editor/Contents/save-to-pdf/plugin.js'); // toolbarga chiqmadi
    CKEDITOR.plugins.addExternal('simplebutton', '/publish/editor/Contents/Simple Button/simplebutton_0.0.9/simplebutton/plugin.js');// toolbarga chiqmadi
    CKEDITOR.plugins.addExternal('tangy-checkbox', '/publish/editor/Contents/tangy-checkbox/tangy-checkbox_1.0.0/tangy-checkbox/plugin.js');
    CKEDITOR.plugins.addExternal('tangy-gps', '/publish/editor/Contents/tangy-gps/tangy-gps_1.0.0/tangy-gps/plugin.js'); //toolbarga chiqmadi
    CKEDITOR.plugins.addExternal('tangy-input', '/publish/editor/Contents/tangy-input/tangy-input_1.0.0_0/tangy-input/plugin.js');//toolbarga chiqmadi
    CKEDITOR.plugins.addExternal('textsignature', '/publish/editor/Contents/Text Signature/textsignature_1.0_0/textsignature/plugin.js');//toolbarga chiqmadi
    CKEDITOR.plugins.addExternal('linkayt', '/publish/editor/Contents/URL link as you type (linkayt)/linkayt_1.0.1/linkayt/plugin.js');
    CKEDITOR.plugins.addExternal('videoembed', '/publish/editor/Contents/Video Embed/videoembed_1.1/videoembed/plugin.js');
    CKEDITOR.plugins.addExternal('videosnapshot', '/publish/editor/Contents/Video Snapshot/videosnapshot_0.0.2/videosnapshot/plugin.js');
    CKEDITOR.plugins.addExternal('wenzgmap', '/publish/editor/Contents/Wenz Google Map Free/wenzgmap_1.0/wenzgmap/plugin.js');// toolbarga chiqmadi
    CKEDITOR.plugins.addExternal('yaqr', '/publish/editor/Contents/Yet Another QR-Code Image Generator/yaqr_1.1_0/plugin.js');
    //editor

   CKEDITOR.plugins.addExternal(
      "video",
      "/publish/inputs/ckeditor/video/plugin.js"
    );
    CKEDITOR.plugins.addExternal(
      "html5audio",
      "/publish/inputs/ckeditor/plugins/html5audio/plugin.js"
    );
    CKEDITOR.plugins.addExternal(
      "html5video",
      "/publish/editor/UI/HTML5 video/html5video_1.2/ckeditor-html5-video-master/html5video/plugin.js"
    );
    CKEDITOR.plugins.addExternal(
      "youtube",
      "/publish/inputs/ckeditor/plugins/youtube/plugin.js"
    );
    CKEDITOR.plugins.addExternal(
      "save-to-pdf",
      "/publish/editor/Contents/save-to-pdf/plugin.js"
    );
    CKEDITOR.plugins.addExternal(
      "allowsave",
      "/publish/editor/Usability/Allow Save/allowsave_1.0/allowsave/plugin.js"
    );
    //Tools
    CKEDITOR.plugins.addExternal(
      "codesnippet",
      "/publish/editor/Tools/Code Snippet/codesnippet_4.13.1/codesnippet/plugin.js"
    );
    CKEDITOR.plugins.addExternal(
      "codesnippetgeshi",
      "/publish/editor/Tools/Code Snippet GeSHi/codesnippetgeshi_4.13.1/codesnippetgeshi/plugin.js"
    );
    CKEDITOR.plugins.addExternal(
      "pbckcode",
      "/publish/editor/Tools/pbckcode/plugin.js"
    );
    CKEDITOR.plugins.addExternal(
      "niftytimers",
      "/publish/editor/Tools/Countdown Timers/niftytimers_1.2/plugins/niftytimers/plugin.js"
    );
    CKEDITOR.plugins.addExternal(
      "custimage",
      "/publish/editor/Tools/Custom Image Dialog _ Custom Dialog/custimage_1.0_0/custimage/plugin.js"
    );
    CKEDITOR.plugins.addExternal(
      "eqneditor",
      "/publish/editor/Tools/Equation Editor/eqneditor_2.2/ckeditor_v4.1/plugins/eqneditor/plugin.js"
    );
    CKEDITOR.plugins.addExternal(
      "googlethisterm",
      "/publish/editor/Tools/Google This Term/googlethisterm_1.2/plugin.js"
    );
    CKEDITOR.plugins.addExternal(
      "xmas",
      "/publish/editor/Tools/Greetings Card/xmas_1.0.3/ckeditor-plugin-xmas-1.0.3/plugin.js"
    );
    CKEDITOR.plugins.addExternal(
      "contextmenu",
      "/publish/editor/Tools/context_menu/contextmenu/plugin.js"
    );
    CKEDITOR.plugins.addExternal(
      "inserthtmlfile",
      "/publish/editor/Tools/Insert HTML From File/inserthtmlfile_1.0/inserthtmlfile/plugin.js"
    );
    CKEDITOR.plugins.addExternal(
      "internallink",
      "/publish/editor/Tools/Internal Link/internallink_1.0/plugin.js"
    );
    CKEDITOR.plugins.addExternal(
      "lineutils",
      "/publish/editor/Tools/Line Utilities/lineutils_4.13.1/lineutils/plugin.js"
    );

    CKEDITOR.plugins.addExternal(
      "mathedit",
      "/publish/editor/Tools/Math Editor/mathedit_0.0.2/mathedit/plugin.js"
    );
    CKEDITOR.plugins.addExternal(
      "onchange",
      "/publish/editor/Tools/onChange/onchange_1.8/onchange/plugin.js"
    );
    CKEDITOR.plugins.addExternal(
      "niftyimages",
      "/publish/editor/Tools/Personalized Images/niftyimages_1.0/plugins/niftyimages/plugin.js"
    );
    CKEDITOR.plugins.addExternal(
      "placeholder",
      "/publish/editor/Tools/Placeholder/placeholder_4.13.1/placeholder/plugin.js"
    );

    CKEDITOR.plugins.addExternal(
      "qrc",
      "/publish/editor/Tools/QRCode generator/qrc_1.1_0/qrc/plugin.js"
    );
    CKEDITOR.plugins.addExternal(
      "savemarkdown",
      "/publish/editor/Tools/Save Markdown/savemarkdown_1.0.0/savemarkdown/plugin.js"
    );

    CKEDITOR.plugins.addExternal(
      "selectallcontextmenu",
      "/publish/editor/Tools/Select All Context Menu/selectallcontextmenu_1.1/selectallcontextmenu/plugin.js"
    );
    CKEDITOR.plugins.addExternal(
      "soundPlayer",
      "/publish/editor/Tools/Sound Player/soundplayer_1.0/soundPlayer/plugin.js"
    );
    CKEDITOR.plugins.addExternal(
      "tableresize",
      "/publish/editor/Tools/Table Resize/tableresize_4.13.1/tableresize/plugin.js"
    );
    CKEDITOR.plugins.addExternal(
      "textmatch",
      "/publish/editor/Tools/Text Match/textmatch_4.13.1/textmatch/plugin.js"
    );
    CKEDITOR.plugins.addExternal(
      "texttransform",
      "/publish/editor/Tools/Text Transform/texttransform_1.1/texttransform/plugin.js"
    );
    CKEDITOR.plugins.addExternal(
      "textwatcher",
      "/publish/editor/Tools/Text Watcher/textwatcher_4.13.1/textwatcher/plugin.js"
    );
    CKEDITOR.plugins.addExternal(
      "token",
      "/publish/editor/Tools/Token Insertion/token_1.1/token-replacement-ckeditor-plugin-1.1/plugin.js"
    );
    //editor
    CKEDITOR.plugins.addExternal('grid', '/publish/editor/Layout/Grid Widget/grid_2.10/grid/plugin.js');
    CKEDITOR.plugins.addExternal('gallery', '/publish/editor/Semantics/Gallery Widget/gallery_2.10/gallery/plugin.js');

    //styling
    CKEDITOR.plugins.addExternal( 'backgrounds', '/publish/editor/Styling/Background Image for Tables and Cells/backgrounds_1.5.1/backgrounds/plugin.js');
    CKEDITOR.plugins.addExternal( 'footnotes', '/publish/editor/Styling/CKEditor Footnotes/footnotes_1.0.10/CKEditorFootnotes-1.0.10/footnotes/plugin.js');
    CKEDITOR.plugins.addExternal( 'computedstyles', '/publish/editor/Styling/Computed Styles/computedstyles_1.0.1/computedstyles/plugin.js');
    CKEDITOR.plugins.addExternal( 'fontawesome', '/publish/editor/Styling/Font Awesome/fontawesome_2.0/plugin.js');
    CKEDITOR.plugins.addExternal( 'font', '/publish/editor/Styling/Font Size and Family/font_4.13.1/font/plugin.js');
    CKEDITOR.plugins.addExternal( 'ckeditorfa', '/publish/editor/Styling/FontAwesome/ckeditorfa_2.3/ckeditorfa/plugin.js');
    CKEDITOR.plugins.addExternal( 'indent', '/publish/editor/Styling/Indent _ Outdent/indent_4.13.1/indent/plugin.js');
    CKEDITOR.plugins.addExternal( 'indentblock', '/publish/editor/Styling/Indent Block/indentblock_4.13.1/indentblock/plugin.js');
    CKEDITOR.plugins.addExternal( 'justify', '/publish/editor/Styling/Justify/justify_4.13.1/justify/plugin.js');
    CKEDITOR.plugins.addExternal( 'letterspacing', '/publish/editor/Styling/Letter-spacing/letterspacing_0.1.2/ckeditor-letterspacing-0.1.2/plugin.js');
    CKEDITOR.plugins.addExternal( 'textindent', '/publish/editor/Styling/Paragraph Indentation/textindent_1.2.2/textindent-1.2.2/textindent/plugin.js');
    CKEDITOR.plugins.addExternal( 'prism', '/publish/editor/Styling/Prism Syntax Highlighter/prism_1.0.1/prism/plugin.js');
    CKEDITOR.plugins.addExternal( 'scribens', '/publish/editor/Styling/Scribens/scribens_1.2/plugin.js');
    CKEDITOR.plugins.addExternal( 'spacingsliders', '/publish/editor/Styling/Spacing Sliders/spacingsliders_1.3/spacingsliders/plugin.js');   
    CKEDITOR.plugins.addExternal( 'syntaxhighlight', '/publish/editor/Styling/Syntaxhighlighter Interface/syntaxhighlight_1.7.0/plugins/syntaxhighlight/plugin.js');

   CKEDITOR.plugins.addExternal('oembed', '/publish/editor/Contents/Media (oEmbed) Plugin/oembed_1.18.1/oembed/plugin.js');
   //semantics НАДО ЗАНОВО СДЕЛАТЬ
   CKEDITOR.plugins.addExternal('video', '/publish/inputs/ckeditor/video/plugin.js');
   CKEDITOR.plugins.addExternal('html5audio', '/publish/inputs/ckeditor/plugins/html5audio/plugin.js');
   CKEDITOR.plugins.addExternal('html5video', '/publish/editor/UI/HTML5 video/html5video_1.2/ckeditor-html5-video-master/html5video/plugin.js');
   CKEDITOR.plugins.addExternal('youtube', '/publish/inputs/ckeditor/plugins/youtube/plugin.js');
   CKEDITOR.plugins.addExternal( 'save-to-pdf', '/publish/editor/Contents/save-to-pdf/plugin.js');
   CKEDITOR.plugins.addExternal( 'basewidget', '/publish/editor/Layout/Basewidgetbasewidget_1.0.0/basewidget/plugin.js'); 
   CKEDITOR.plugins.addExternal( 'glyphicons', '/publish/editor/Layout/Bootstrap Glyphicon/glyphicons_2.2/glyphicons/plugin.js');
   CKEDITOR.plugins.addExternal( 'bootstrapVisibility', '/publish/editor/Layout/Bootstrap Responsive Visibility/bootstrapvisibility_1.0/bootstrapVisibility/plugin.js');
   CKEDITOR.plugins.addExternal( 'bootstrapTabs', '/publish/editor/Layout/Bootstrap Tabs/bootstraptabs_1.1/bootstrapTabs/plugin.js');
   CKEDITOR.plugins.addExternal( 'brclear', '/publish/editor/Layout/BR Clear/brclear/plugin.js');
   CKEDITOR.plugins.addExternal( 'btgrid', '/publish/editor/Layout/Bootstrap grid/btgrid/plugin.js');
   CKEDITOR.plugins.addExternal( 'label', '/publish/editor/Layout/Form Field Label/label_1.0rc/label/plugin.js');
   CKEDITOR.plugins.addExternal( 'lineheight', '/publish/editor/Layout/Line Height/lineheight_1.0.4/lineheight/plugin.js');  
   CKEDITOR.plugins.addExternal( 'powrmultislider', '/publish/editor/Layout/Multi Slider/powrmultislider_1.0/plugin.js');  
   CKEDITOR.plugins.addExternal( 'powrpopup', '/publish/editor/Layout/Popup/powrpopup_1.2/plugin.js');  
   CKEDITOR.plugins.addExternal( 'powrsocialfeed', '/publish/editor/Layout/Social Feed/powrsocialfeed_1.2/plugin.js');
   CKEDITOR.plugins.addExternal( 'strinsert', '/publish/editor/Layout/StrInsert - Custom Dropdown for CKEditor4/strinsert_0.01/plugin.js');
   //data
   CKEDITOR.plugins.addExternal('texzilla', '/publish/editor/Data/(La)TeX2MathML/texzilla_1.2.1/src/plugin.js');
   CKEDITOR.plugins.addExternal('ajax', '/publish/editor/Data/Ajax Data Loading/ajax_4.13.1/ajax/plugin.js');
   CKEDITOR.plugins.addExternal('autoembed', '/publish/editor/Data/Auto Embed/autoembed_4.13.1/autoembed/plugin.js');
   CKEDITOR.plugins.addExternal('autoplaceholder', '/publish/editor/Data/Autoplaceholder/autoplaceholder_1.1.4/autoplaceholder/plugin.js');//error in plugin.js
   CKEDITOR.plugins.addExternal('bbcode', '/publish/editor/Data/BBCode Output Format/bbcode_4.13.1/bbcode/plugin.js');
   //CKEDITOR.plugins.addExternal('browser', '/publish/editor/Data/Browser/browser_2.10/browser/plugin.js');
   CKEDITOR.plugins.addExternal('cavacnote', '/publish/editor/Data/Cavac Note/cavacnote_1.0/cavacnote/plugin.js');
   CKEDITOR.plugins.addExternal('chart', '/publish/editor/Data/Chart/chart_1.0.2/chart-1.0.2/plugin.js');
   CKEDITOR.plugins.addExternal('simpleImageUpload', '/publish/editor/Data/Simple image upload - no filebrowser required/simpleimageupload_1.0/simpleImageUpload/plugin.js');
   CKEDITOR.plugins.addExternal('xdsoft_translater', '/publish/editor/Data/Translater/xdsoft_translater_1.0.4/xdsoft_translater/plugin.js');
   CKEDITOR.plugins.addExternal('video', '/publish/editor/Data/Video/video_1.2/video/plugin.js');
   CKEDITOR.plugins.addExternal('videoPlusCKEditorPlugin-master', '/publish/editor/Data/VideoPlus/videoplus_3.5_0/videoPlusCKEditorPlugin-master/plugin.js');
   CKEDITOR.plugins.addExternal('widget', '/publish/editor/Data/Widget/widget_4.13.1/widget/plugin.js');
   CKEDITOR.plugins.addExternal('widgetselection', '/publish/editor/Data/Widget Selection/widgetselection_4.13.1/widgetselection/plugin.js');

   
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

        extraPlugins: 'autocomplete, autoembed,image2,uploadimage,tableresize,notification,language,emoji,a11ystylescombo,a11yheading,a11yimage,a11ylink,ckwebspeech,easykeymap,FMathEditor,inlinecancel,textselection,language,performx,sketchfab,widgetcontextmenu, copyformatting, pastecode, pastetools, ccmsacdc, base64image, templates, imageresize, lightbox, smiley, oembed, tliyoutube2, pagebreak, videosnapshot, yaqr, texzilla,cavacnote,chart,autoplaceholder,powrsocialfeed,powrmultislider,lineheight,label,brclear,bootstrapTabs,bootstrapVisibility,glyphicons,powrpopup,strinsert,save-to-pdf,youtube,image2,uploadimage,notification,language,emoji,video,html5audio,html5video,pastetools,oembed,justify,footnotes,indent,ckeditorfa,syntaxhighlight,prism,spacingsliders,scribens,textindent,letterspacing,font,fontawesome,backgrounds,computedstyles,token,grid,gallery,textwatcher,texttransform,textmatch,tableresize,soundPlayer,selectallcontextmenu,savemarkdown,qrc,placeholder,niftyimages,onchange,mathedit,lineutils,internallink,inserthtmlfile,xmas,contextmenu,googlethisterm,eqneditor,custimage,niftytimers,pbckcode,codesnippet,codesnippetgeshi, allowsave,save-to-pdf,youtube,image2,uploadimage,tableresize,notification,language,emoji,video,html5audio,html5video,pastetools,button,tabletoolstoolbar,staticspace,html5audio,sharedspace,richcombo,panelbutton,panel,pacatube,notificationaggregator,menubutton,menu,listblock,symbol,imageresizerowandcolumn,iframedialog,html5video,divarea,dialogui,colordialog,autogrow,googlesearch,floatpanel,panel,balloonpanel,toolbarswitch, image2, uploadimage, tableresize, notification, language, emoji, video, html5audio, allowsave, btbutton, closedialogoutside, codemirror, pre, powrcomments, deselect, imagerotate, closebtn, locationmap, nbsp, notification, numericinput, openlink, quicktable, save, showblocks, showprotected, smallerselection, toc, tableselection, toolbarswitch, xmltemplates, closebtn,youtubebootstrap,save,zoom',

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

        font_style : {},


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

        linkDefaultProtocol : 'http://', // 'http://, 'https://', 'ftp://', 'news://'

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

        scayt_serviceProtocol : 'http',

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
         * When enabled, causes the Arrow keys navigation to cycle within the current toolbar group. Otherwise the Arrow keys will move through all items available in the toolbar. The Tab key will still be used to quickly jump among the toolbar groups.
         */

        toolbarGroupCycling : true,

        /**  Default setting.
         config.toolbarGroups = [
         { name: 'document',    groups: [ 'mode', 'document', 'doctools' ] },
         { name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
         { name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
         { name: 'forms' },
         '/',
         { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
         { name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
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



    ckeditorjs.on('afterPaste', function () {
        console.log('ZCkeditorwidget | afterPaste');
        
        ckeditorjs.showNotification( 'paste', 'warning', 3000 ); // info | warning | success | progress
       
        

    });
    ckeditorjs.on('afterPasteFromWord', function () {
        console.log('ZCkeditorwidget | afterPasteFromWord');
        ckeditorjs.showNotification('Paste from Word', 'info',3000);
       
    });

    ckeditorjs.on( 'focus', function( e ) {
        console.log( 'ZCkeditorwidget | focus' );
    } );

    ckeditorjs.on('activeEnterModeChange', {activeEnterModeChange});

    ckeditorjs.on('activeFilterChange', function () {
        console.log('ZCkeditorWidget | activeFilterChange');
    });

    ckeditorjs.on('afterCommandExec', function () {
        console.log('ZCkeditorWidget | afterCommandExec');
    });

    ckeditorjs.on('afterInsertHtml', function () {
        console.log('ZCkeditorWidget | afterInsertHtml');
    });

    ckeditorjs.on('afterSetData', function () {
        console.log('ZCkeditorWidget | afterSetData');
    });

    ckeditorjs.on('afterUndoImage', function () {
        console.log('ZCkeditorWidget | afterUndoImage');

    });

    ckeditorjs.on('ariaEditorHelpLabel', function () {
        console.log('ZCkeditorWidget | ariaEditorHelpLabel');
    });
    ckeditorjs.on('ariaWidget', function () {
        console.log('ZCkeditorWidget | ariaWidget');
    });

    ckeditorjs.on('autogrow', function () {
        console.log('ZCkeditorWidget | autogrow');
    });

    ckeditorjs.on('activeEnterModeChange', function () {
        console.log('ZCkeditorWidget | activeEnterModeChange');
    });

    ckeditorjs.on('beforeCommandExec', function () {
        console.log('ZCkeditorWidget | beforeCommandExec');
    });
    ckeditorjs.on('beforeDestroy', function () {
        console.log('ZCkeditorWidget | beforeDestroy');
    });

    ckeditorjs.on('beforeGetData', function () {
        console.log('ZCkeditorWidget | beforeGetData');
    });

    ckeditorjs.on('beforeModeUnload', function () {
        console.log('ZCkeditorWidget | beforeModeUnload');
    });

    ckeditorjs.on('beforeSetMode', function () {
        console.log('ZCkeditorWidget | beforeSetMode');
    });

    ckeditorjs.on('blur', function () {
        console.log('ZCkeditorWidget | blur');
    });

    ckeditorjs.on('change', function () {
        console.log('ZCkeditorWidget | change');
    });

    ckeditorjs.on('configLoaded', function () {
        console.log('ZCkeditorWidget | configLoaded');
    });

    ckeditorjs.on('contentDirChanged', function () {
        console.log('ZCkeditorWidget | contentDirChanged');
    });


    ckeditorjs.on('contentDom', function () {
        console.log('ZCkeditorWidget | contentDom');
    });

    

    ckeditorjs.on('contentDomInvalidated', function () {
        console.log('ZCkeditorWidget | contentDomInvalidated');
    });

    ckeditorjs.on('contentDomUnload', function () {
        console.log('ZCkeditorWidget | contentDomUnload');
    });

    ckeditorjs.on('customConfigLoaded', function () {
        console.log('ZCkeditorWidget | customConfigLoaded');
    });

    ckeditorjs.on('dataFiltered', function () {
        console.log('ZCkeditorWidget | dataFiltered');
    });

    ckeditorjs.on('dataReady', function () {
        console.log('ZCkeditorWidget | dataReady');
    });

    ckeditorjs.on('destroy', function () {
        console.log('ZCkeditorWidget | destroy');
    });

    ckeditorjs.on('dialogHide', function () {
        console.log('ZCkeditorWidget | dialogHide');
    });

    ckeditorjs.on('dialogShow', function () {
        console.log('ZCkeditorWidget | dialogShow');
    });

    ckeditorjs.on('dirChanged', function () {
        console.log('ZCkeditorWidget | dirChanged');
    });

    ckeditorjs.on('doubleclick', function () {
        console.log('ZCkeditorWidget | doubleclick');
    });

    ckeditorjs.on('dragend', function () {
        console.log('ZCkeditorWidget | dragend');
    });

    ckeditorjs.on('dragstart', function () {
        console.log('ZCkeditorWidget | dragstart');
    });

    ckeditorjs.on('drop', function () {
        console.log('ZCkeditorWidget | drop');
    });

    ckeditorjs.once('elementsPathUpdate', function () {
        console.log('ZCkeditorWidget | elementsPathUpdate');
    });

    ckeditorjs.once('fileUploadRequest', function () {
        console.log('ZCkeditorWidget | fileUploadRequest');
        //ckeditorjs.showNotification('Image Upload', 'info');
        alert('request');
    });

    ckeditorjs.on('fileUploadResponse', function () {
        console.log('ZCkeditorWidget | fileUploadResponse');
        alert('response');
    });

    ckeditorjs.on('floatingSpaceLayout', function () {
        console.log('ZCkeditorWidget | floatingSpaceLayout');
    });

    ckeditorjs.on('getData', function () {
        console.log('ZCkeditorWidget | getData');
    });

    ckeditorjs.on('getSnapshot', function () {
        console.log('ZCkeditorWidget | getSnapshot');
    });

    ckeditorjs.on('insertElement', function () {
        console.log('ZCkeditorWidget | insertElement');
    });

    ckeditorjs.on('insertText', function () {
        console.log('ZCkeditorWidget | insertText');
    });


    ckeditorjs.on('key', function () {
        console.log('ZCkeditorWidget | key');
    });

    ckeditorjs.on('langLoaded', function () {
        console.log('ZCkeditorWidget | langLoaded');
    });

    ckeditorjs.on('loadSnapshot', function () {
        console.log('ZCkeditorWidget | loadSnapshot');
    });

    ckeditorjs.on('loaded', function () {
        console.log('ZCkeditorWidget | loaded');
    });

    ckeditorjs.on('lockSnapshot', function () {
        console.log('ZCkeditorWidget | lockSnapshot');
    });

    ckeditorjs.on('maximize', function () {
        console.log('ZCkeditorWidget | maximize');
    });

    ckeditorjs.on('menuShow', function () {
        console.log('ZCkeditorWidget | menuShow');
    });

    ckeditorjs.on('mode', function () {
        console.log('ZCkeditorWidget | mode');
    });

    ckeditorjs.on('notificationHide', function () {
        console.log('ZCkeditorWidget | notificationHide');
    });

    ckeditorjs.on('notificationShow', function () {
        console.log('ZCkeditorWidget | notificationShow');
    });

    ckeditorjs.on('notificationUpdate', function () {
        console.log('ZCkeditorWidget | notificationUpdate');
    });

    ckeditorjs.on('paste', function () {
        console.log('ZCkeditorWidget | paste');
    });

    ckeditorjs.on('pasteFromWord', function () {
        console.log('ZCkeditorWidget | pasteFromWord');
    });


    ckeditorjs.on('pluginsLoaded', function () {
        console.log('ZCkeditorWidget | pluginsLoaded');
    });

    ckeditorjs.on('readOnly', function () {
        console.log('ZCkeditorWidget | readOnly');
    });

    ckeditorjs.on('removeFormatCleanup', function () {
        console.log('ZCkeditorWidget | removeFormatCleanup');
    });

    ckeditorjs.on('required', function () {
        console.log('ZCkeditorWidget | required');
    });

    ckeditorjs.on('resize', function () {
        console.log('ZCkeditorWidget | resize');
    });

    ckeditorjs.on('save', function () {
        console.log('ZCkeditorWidget | save');
    });

    ckeditorjs.on('saveSnapshot', function () {
        console.log('ZCkeditorWidget | saveSnapshot');
    });

    ckeditorjs.on('selectionChange', function () {
        console.log('ZCkeditorWidget | selectionChange');
    });

    ckeditorjs.on('setData', function () {
        console.log('ZCkeditorWidget | setData');
    });

    ckeditorjs.on('stylesSet', function () {
        console.log('ZCkeditorWidget | stylesSet');
    });

    ckeditorjs.on('template', function () {
        console.log('ZCkeditorWidget | template');
    });

    ckeditorjs.on('toDataFormat', function () {
        console.log('ZCkeditorWidget | toDataFormat');
    });

    ckeditorjs.on('toHtml', function () {
        console.log('ZCkeditorWidget | toHtml');
    });

    ckeditorjs.on('uiSpace', function () {
        console.log('ZCkeditorWidget | uiSpace');
    });

    ckeditorjs.on('unlockSnapshot', function () {
        console.log('ZCkeditorWidget | unlockSnapshot');
    });

    ckeditorjs.on('updateSnapshot', function () {
        console.log('ZCkeditorWidget | updateSnapshot');
    });

    ckeditorjs.on('widgetDefinition', function () {
        console.log('ZCkeditorWidget | widgetDefinition');
    });


    
         $('#getDate').on('click', function(){
            var value = CKEDITOR.instances['{id}'].getData();
            console.log(value);
                    
         
         });  
         
 /*         ckeditorjs.on('change', function () {
           var value = CKEDITOR.instances['{id}'].getData();
            console.log(value);
            document.querySelector('#hiddenEditor').value = value;
            
    });*/
         
   /*   $('#{getDate}').on('click', function(){
       var date = Date();
        $('#{iconPicker}').val(date.getDate());
         });
       */  
        /* ckeditorjs.on( 'change', function( evt ) {
                console.log(ckeditorjs.getData());
            });*/
    
    

    

    


JS,

    ];


    public function asset()
    {
        // $this->fileJs('/publish/yarner/ckeditor4-dev/ckeditor.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/ckeditor4-dev@4.14.0/ckeditor.js');
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

        $this->js = strtr($this->_layout['js'], [
            '{id}' => $this->id
        ]);

    }

}
