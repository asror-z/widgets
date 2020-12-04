<?php

/**
 *
 *
 * Author:  Anvar Jabborov
 *
 *
 */

namespace zetsoft\widgets\navigat;

use rmrevin\yii\fontawesome\FA;
use yii\console\ExitCode;
use yii\web\JsExpression;
use zetsoft\system\kernels\ZWidget;

class ZSmartTabWidgetMobile extends ZWidget
{
    public $config = [];
    public $_config = array(

        'theme' => ZSmartTabWidgetMobile::theme['Classic'],
        'animation' => ZSmartTabWidgetMobile:: animation['none'],
        'orientation' => ZSmartTabWidgetMobile::orientation['horizontal'],
        'justified' => ZSmartTabWidgetMobile::justified['true'],
        'isKeyNavigation' => false,
        'isStopOnFocus' => true,
        'isEnabledAutonavigation' => ZSmartTabWidgetMobile::isEnabledAutonavigation['false'],
        'easing' => ZSmartTabWidgetMobile::easingEmpty['empty'],
        'isEnableURLhash' => ZSmartTabWidgetMobile::isEnableURLhash['true'],
        'isBackButtonSupport' => ZSmartTabWidgetMobile::isBackButtonSupport['true'],
        'isAutoAdjustHeight' => ZSmartTabWidgetMobile::isAutoAdjustHeight['false'],
        'selectedTab' => ZSmartTabWidgetMobile::selectedTab['first'],
        'navigateInterval' => ZSmartTabWidgetMobile::navigateInterval['3500'],
        'animationSpeed' => ZSmartTabWidgetMobile::animationSpeed['400'],
        'ajaxUrl' => ZSmartTabWidgetMobile::ajaxUrl['url'],
        'method' => ZSmartTabWidgetMobile::method['GET'],
        'isAjax' => ZSmartTabWidgetMobile::isAjax['false'],
        'ajaxtabContent' => '<h1>ajax</h1>',
        'tab-margin' => '',
        'tab-padding'=>''


    );
    public static $grapes = [
        'enable' => true,
        'icon' => '',
        'image' => '/render/navigat/ZAccLayWidget/image/icon.png',
        'name' => Azl . 'AccLay',
        'title' => Azl . '<b>safasfsa</b><img src="/render/navigat/ZAccLayWidget/image/icon.png"/>',
    ];

    #region Consts

    public const orientation = [
        'horizontal' => 'horizontal',
        'vertical' => 'vertical',
    ];

    public const ajaxUrl = [
        'url' => 'https://api.npms.io/v2/package/'
    ];

    public const method = [
        'GET' => 'GET',
        'POST' => 'POST',
        'PUT' => 'PUT'
    ];
    public const theme = [
        'Default' => 'default',
        'Classic' => 'classic',
        /*'green' => 'green',*/
        'Dark' => 'dark',
        'Brick' => 'brick',
        'Bootstrap Tabs' => 'bstabs',
        'Bootstrap Pills' => 'bspills',
        'No Theme' => '',
    ];
    public const animation = [
        'none' => 'none',
        'fade' => 'fade',
        'slide-horizontal' => 'slide-horizontal',
        'slide-vertical' => 'slide-vertical',
        'slide-swing' => 'slide-swing',
    ];
    public const justified = [
        'true' => true,
        'false' => false,
    ];

    public const isAjax = [
        'true' => 'tabContent',
        'false' => false,
    ];
    public const selectedTab = [
        'first' => 0,
        'two' => 1,
        'three' => 2,
        'four' => 3,
        'five' => 4,
        'sex' => 5,
    ];
    public const isAutoAdjustHeight = [
        'true' => true,
        'false' => false,
    ];
    public const isBackButtonSupport = [
        'true' => true,
        'false' => false,
    ];
    public const isEnableURLhash = [
        'true' => true,
        'false' => false,
    ];
    public const easingEmpty = [
        'empty' => '',
    ];
    public const animationSpeed = [
        '400' => '400',
    ];

    public const isStopOnFocus = [
        'true' => true,
        'false' => false,
    ];
    public const isEnabledAutonavigation = [
        'true' => true,
        'false' => false,
    ];
    public const navigateInterval = [
        '3500' => 3500,
    ];

    public const isKeyNavigation = [
        'true' => true,
        'false' => false,
    ];

    #endregion

    #region Arrays

    /* public $navLi = [
          ['Tab 1', 'This is tab title', 1],
          ['Tab 2', 'This is tab title', 2],
          ['Tab 3', 'This is tab title', 3],
          ['Tab 4', 'This is tab title', 4],
          ['Tab 5', 'This is tab title', 5],
          ['Tab 6', 'This is tab title', 6],
      ];
      public $tabContentDiv = [
          ['Tab 1 Content', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1],
          ['Tab 2 Content', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 2],
          ['asd', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 3],
          ['Tab 4 Content', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
       Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 4],
       ['Tab 4 Content', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
       Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 5],
       ['Tab 4 Content', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
       Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 6],
      ];  */
#endregion

    public $label = [];
    public $_label = [
        'default' => Azl . 'По умолчанию',
    ];
    public $data = [];
    public $_data = [

    ];

    public $event = [];
    public $_event = [
        'got_to_tab_change' => '$("#got_to_tab").on("change", function() {
            // Go to tab
            var tab_index = $(this).val() - 1;
            $("#smarttab").smartTab("goToTab", tab_index);
            
            return true;
        });',
        'is_vertical_click' => ' $("#is_vertical").on("click", function() {
            // Change Orientation
            var options = {
                orientation: ($(this).prop("checked") == true) ? \'vertical\' : \'horizontal\'
            };
            $(\'#smarttab\').smartTab("setOptions", options);
            return true;
        });',
        'is_justified_click' => ' $("#is_justified").on("click", function() {
            // Change Justify
            var options = {
                justified: $(this).prop("checked")
            };

            $(\'#smarttab\').smartTab("setOptions", options);
            return true;
        });',

        'animation_change' => ' $("#animation").on("change", function() {
            // Change theme
            var options = {
                transition: {
                    animation: $(this).val()
                },
            };
            $(\'#smarttab\').smartTab("setOptions", options);
            return true;
        });',

        'theme_selector_change' => '$("#theme_selector").on("change", function() {
            // Change theme
            var options = {
                theme: $(this).val()
            };
            $(\'#smarttab\').smartTab("setOptions", options);
            return true;
        });',

    ];

    public $layout = [];
    public $_layout = [
        'item' => <<<HTML
                
<!-- SmartTab html -->
<div id="smarttab" class="st st-justified st-theme- st-theme-default st-vertical bg-white rounded-lg">
          
    <ul class="nav font-weight-bold" id="tab-panel-id" role="tablist">
        {nav_li}
    </ul>

    <div class="tab-content p-0 bg-white" id="tab-content">
        {tab_content_div}
    </div>       
                       
</div>

HTML,

        'navLi' => <<<HTML
  <li class="{tab-padding} {tab-margin}">
      <a class="nav-link p-3 border d-flex justify-content-center align-items-center " href="#tab-{id}" >
       <span> <strong class="font-weight-bold fp-20"> {tab_description} </strong> </span> 
      </a>
  </li>
HTML,

        'tabContentDiv' => <<<HTML
<div id="tab-{id}" class="tab-pane p-5" role="tabpanel" style="display: none;">
      {content}
</div>

HTML,

        'css' => <<<CSS
                  
                  .st-theme-classic>.nav .nav-link{
                        color: #A49D9D!important;
                        border: #C7C4C4;
                        background-image: linear-gradient(to top,#EEEEEE 0,#EEEEEE 47%,#EEEEEE 100%);
                   }
                  .st-theme-classic>.nav .nav-link.active{
                       color: #2db329!important;
                       border-bottom: none!important;
                       background-image: linear-gradient(to top,#ffffff 0,#ffffff 47%,#ffffff 100%);
                   }      
CSS,

        'js' => <<<JS
                    
              $(document).ready(function() {
              // Ajax content loading with "tabContent" event
          {ajaxContent}
                 
          {js_init}
        
        // Demo Button Events
        {got_to_tab_change}
        {is_vertical_click}
        {is_justified_click}
        {animation_change}
        {theme_selector_change}
        
        // Set selected theme on page refresh
         $("#theme_selector").change();
    });
               
JS,

        'ajax' => <<<JS
         // Ajax content loading with "tabContent" event
$("#smarttab").on("{tabContent}", function(e, anchorObject, tabIndex) {
 
    var repo    = anchorObject.data('repo');
    var ajaxURL = "{url}" + repo;
 
    // Return a promise object
    return new Promise((resolve, reject) => {
 
      // Ajax call to fetch your content
      $.ajax({
          method  : "{GET}",
          url     : ajaxURL,
          beforeSend: function( xhr ) {
              // Show the loader
              $('#smarttab').smartTab("loader", "show");
          }
      }).done(function( res ) {
 
          var html = '{ajax_html_content}';
          
         /* html += 'Popularity: ' + parseInt(res.score.detail.popularity * 100);*/
 
          // Resolve the Promise with the tab content
          resolve(html);
 
          // Hide the loader
          $('#smarttab').smartTab("loader", "hide");
      }).fail(function(err) {
 
        // Reject the Promise with error message to show as tab content
        reject( "An error loading the resource" );
 
        // Hide the loader
        $('#smarttab').smartTab("loader", "hide");
      });
 
    });
 
}); 
JS,
        'js_init' => <<<JS
        // SmartTab initialize
        $('#smarttab').smartTab({
            selected: {selectedFirst}, //0,// Initial selected tab, 0 = first tab
            theme: '{themeForTheTab}', // theme for the tab, related css need to include for other than default theme
            orientation: '{NavMenuOrientation}', // Nav menu orientation. horizontal/vertical
            justified: {isNavMenuJustification}, //false,// Nav menu justification. true/false
            autoAdjustHeight: {isAutoAdjustHeight},//true, // Automatically adjust content height
            backButtonSupport: {isBackButtonSupport},//true, // Enable the back button support
            enableURLhash: {isEnableURLhash},//true, // Enable selection of the tab based on url hash
            transition: {
                animation: '{animationEffect}', // Effect on navigation, none/fade/slide-horizontal/slide-vertical/slide-swing
                speed: '{animationSpeed}', //'400',// Transion animation speed
                easing:'{easingEmpty}'//'' // Transition animation easing. Not supported without a jQuery easing plugin
            },
            autoProgress: { // Auto navigate tabs on interval
                enabled: {isEnabledAutonavigation},//false, // Enable/Disable Auto navigation
                interval: {navigateInterval},//3500, // Auto navigate Interval (used only if "autoProgress" is set to true)
                stopOnFocus: {isStopOnFocus},//true, // Stop auto navigation on focus and resume on outfocus
            },
            keyboardSettings: {
                keyNavigation: {isKeyNavigation},//true, // Enable/Disable keyboard navigation(left and right keys are used if enabled)
                keyLeft: [37], // Left key code
                keyRight: [39] // Right key code
            }
        });   
         
JS,

    ];

    public function asset()
    {
        $this->fileCss('https://cdn.jsdelivr.net/npm/jquery-smarttab@3.0.1/dist/css/smart_tab_all.min.css');

        $this->fileJs('https://cdn.jsdelivr.net/npm/jquery-smarttab@3.0.0/dist/js/jquery.smartTab.min.js');
    }

    public function codes()
    {
        $navLi_code = '';
        $tabContentDiv_code = '';
        $i = 1;
        $items = $this->data;
        foreach ($items as $item) {
            $navLi_code .= strtr($this->_layout['navLi'], [
                '{bg-success}' => $item->class,
                '{tab_description}' => $item->title,
                '{id}' => $i,
                '{tab-padding}' => $this->_config['tab-padding'],
                '{tab-margin}'=>$this->_config['tab-margin']
            ]);
            $tabContentDiv_code .= strtr($this->_layout['tabContentDiv'], [
                '{content}' => $item->content,
                '{id}' => $i,
            ]);
            $i++;
        }

        $this->htm = strtr(
            $this->_layout['item'], [
            '{nav_li}' => $navLi_code,
            '{tab_content_div}' => $tabContentDiv_code,
        ]);


        $this->css = strtr($this->_layout['css'], [

        ]);

        $js_init = '';
        $js_init .= strtr($this->_layout['js_init'], [
            '{animationEffect}' => $this->jscode($this->_config['animation']),
            '{themeForTheTab}' => $this->jscode($this->_config['theme']),
            '{NavMenuOrientation}' => $this->jscode($this->_config['orientation']),
            '{isNavMenuJustification}' => $this->jscode($this->_config['justified']),
            '{selectedFirst}' => $this->jscode($this->_config['selectedTab']),
            '{isAutoAdjustHeight}' => $this->jscode($this->_config['isAutoAdjustHeight']),
            '{isBackButtonSupport}' => $this->jscode($this->_config['isBackButtonSupport']),
            '{isEnableURLhash}' => $this->jscode($this->_config['isEnableURLhash']),
            '{animationSpeed}' => $this->jscode($this->_config['animationSpeed']),
            '{easingEmpty}' => $this->jscode($this->_config['easing']),
            '{isEnabledAutonavigation}' => $this->jscode($this->_config['isEnabledAutonavigation']),
            '{navigateInterval}' => $this->jscode($this->_config['navigateInterval']),
            '{isStopOnFocus}' => $this->jscode($this->_config['isStopOnFocus']),
            '{isKeyNavigation}' => $this->jscode($this->_config['isKeyNavigation']),

        ]);
        $ajax = '';
        $ajax .= strtr($this->_layout['ajax'], [
            '{tabContent}' => $this->jscode($this->_config['isAjax']),
            '{url}' => $this->jscode($this->_config['ajaxUrl']),
            '{GET}' => $this->jscode($this->_config['method']),
            '{ajax_html_content}' => $this->jscode($this->_config['ajaxtabContent']),


        ]);

        $this->js = strtr($this->_layout['js'], [
            '{js_init}' => $js_init,
            '{ajaxContent}' => ($this->_config['isAjax'] !== 'false') ? $ajax : '',
            '{got_to_tab_change}' => $this->eventCode('got_to_tab_change'),
            '{is_vertical_click}' => $this->eventCode('is_vertical_click'),
            '{is_justified_click}' => $this->eventCode('is_justified_click'),
            '{animation_change}' => $this->eventCode('animation_change'),
            '{theme_selector_change}' => $this->eventCode('theme_selector_change'),
        ]);

    }
}
