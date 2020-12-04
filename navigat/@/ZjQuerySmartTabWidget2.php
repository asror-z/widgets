<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\navigat;

use rmrevin\yii\fontawesome\FA;
use yii\console\ExitCode;
use yii\web\JsExpression;
use zetsoft\system\kernels\ZWidget;

class ZjQuerySmartTabWidget2 extends ZWidget
{
    public $config = [];
    public $_config = [
        'theme' => ZSmartTabWidget::Theme['Brick'],
        'animation' => ZSmartTabWidget:: Animation['none'],
        'orientation' => ZSmartTabWidget::Orientation['horizontal'],
        'justified' => ZSmartTabWidget::Justified['true'],
        'classCSS' => ZSmartTabWidget::classCSS['nav'],
        'isKeyNavigation' => ZSmartTabWidget::isKeyNavigation['true'],
        'isStopOnFocus' => ZSmartTabWidget::isStopOnFocus['true'],
        'isEnabledAutonavigation' => ZSmartTabWidget::isEnabledAutonavigation['false'],
        'easing' => ZSmartTabWidget::easingEmpty['empty'],
        'isEnableURLhash' => ZSmartTabWidget::isEnableURLhash['true'],
        'isBackButtonSupport' => ZSmartTabWidget::isBackButtonSupport['true'],
        'isAutoAdjustHeight' => ZSmartTabWidget::isAutoAdjustHeight['false'],
        'selectedTab' => ZSmartTabWidget::selectedTab['first'],
        'navigateInterval' => ZSmartTabWidget::navigateInterval['3500'],
        'animationSpeed' => ZSmartTabWidget::animationSpeed['400'],
        'ajaxUrl' => ZSmartTabWidget::ajaxUrl['url'],
        'method' => ZSmartTabWidget::ajaxMethod['GET'],
        'ajaxtabContent' => ZSmartTabWidget::ajaxtabContent['false'],
        'ajaxHtml' => ZSmartTabWidget::ajaxHTML['default'],
        'isMultiple' => ZSmartTabWidget::isMultiple['false'],
        // 'itemTab' => ZjQuerySmartTabWidget::itemTab['first'],

    ];
    public static $grapes = [
        'enable' => true,
        'icon' => '',
        'image' => '/render/navigat/ZAccLayWidget/image/icon.png',
        'name' => Azl . 'AccLay',
        'title' => Azl . '<b>safasfsa</b><img src="/render/navigat/ZAccLayWidget/image/icon.png"/>',

    ];

    #region Consts

    public const Orientation = [
        'horizontal' => 'horizontal',
        'vertical' => 'vertical',
    ];
    public const itemTab = [
        'first' => 'first',
        'two' => 'two',
    ];
    public const ajaxUrl = [
        'url' => 'https://api.npms.io/v2/package/'
    ];
    public const ajaxHTML = [
        'default' => 'default',
        'html' => 'var html = \'<h2>Ajax data loaded from localhost</h2><br><br>\';
  resolve(html);',
    ];
    public const ajaxMethod = [
        'GET' => 'GET',
        'POST' => 'POST',
        'PUT' => 'PUT'
    ];
    public const Theme = [
        'Default' => 'default',
        'Classic' => 'classic',
        'green' => 'green',
        'Dark' => 'dark',
        'Brick' => 'brick',
        'Bootstrap Tabs' => 'bstabs',
        'Bootstrap Pills' => 'bspills',
        'No Theme' => '',
    ];
    public const Animation = [
        'none' => 'none',
        'fade' => 'fade',
        'slide-horizontal' => 'slide-horizontal',
        'slide-vertical' => 'slide-vertical',
        'slide-swing' => 'slide-swing',
    ];
    public const Justified = [
        'true' => true,
        'false' => false,
    ];
    public const isMultiple = [
        'true' => true,
        'false' => false,
    ];
    public const ajaxtabContent = [
        'true' => 'tabContent',
        'false' => false,
    ];
    public const selectedTab = [
        'first' => 1,
        'two' => 2,
        'three' => 3,
        'four' => 4,
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
    public const Transition = [
        'animation' => [
            'none' => 'none',
            'fade' => 'fade',
            'slide-horizontal' => 'slide-horizontal',
            'slide-vertical' => 'slide-vertical',
            'slide-swing' => 'slide-swing',
        ],
        'speed' => [
            '400' => '400',
        ],
        'easing' => [
            'empty' => '',
        ],
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
    public const autoProgress = [
        'enabled' => [
            'true' => true,
            'false' => false,
        ],
        'interval' => [
            '3500' => 3500,
            '5000' => 5000,
        ],
        'stopOnFocus' => [
            'true' => true,
            'false' => false,
        ],
    ];
    public const isKeyNavigation = [
        'true' => true,
        'false' => false,
    ];
    public const keyboardSettings = [
        'keyNavigation' => [
            'true' => true,
            'false' => false,
        ],
        'keyLeft' => [
            '37' => 37,
        ],
        'keyRight' => [
            '39' => 39,
        ],
    ];
    public const classCSS = [
        'nav nav-tabs md-tabs  blue' => 'nav pilltab ',
        'nav' => 'nav'
    ];
    #endregion

    #region Arrays

    public $navLi = [
        ['Tab 1', 'This is tab title', 1],
        ['Tab 2', 'This is tab title', 2],
        ['Tab 3', 'This is tab title', 3],
        ['Tab 4', 'This is tab title', 4],
    ];
    public $tabContentDiv = [
        ['Tab 1 Content', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1],
        ['Tab 2 Content', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 2],
        ['', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 3],
        ['Tab 4 Content', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
     Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 4],
    ];
#endregion

    public $label = [];
    public $_label = [
        'default' => Azl . 'По умолчанию',
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
                  <!--    <p>
    <label>Theme:</label>
    <select id="theme_selector">
        <option value="default" selected="">Default</option>
        <option value="classic">Classic</option>
        <option value="dark">Dark</option>
        <option value="brick">Brick</option>
        <option value="bstabs">Bootstrap Tabs</option>
        <option value="bspills">Bootstrap Pills</option>
        <option value="">No Theme</option>
    </select>

    &nbsp;&nbsp;&nbsp;&nbsp;
    <input type="checkbox" id="is_vertical" value="1">
    <label for="is_vertical">Vertical</label>

    &nbsp;&nbsp;&nbsp;&nbsp;
    <input type="checkbox" id="is_justified" value="1" checked="">
    <label for="is_justified">Justified</label>

    &nbsp;&nbsp;&nbsp;&nbsp;
    <label>Animation:</label>
    <select id="animation">
        <option value="none">None</option>
        <option value="fade">Fade</option>
        <option value="slide-horizontal">Slide Horizontal</option>
        <option value="slide-vertical">Slide Vertical</option>
        <option value="slide-swing">Slide Swing</option>
    </select>

    &nbsp;&nbsp;&nbsp;&nbsp;
    <label>Go To:</label>
    <select id="got_to_tab">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
    </select>
</p>
<br> -->

<!-- SmartTab html -->
<div id="smarttab{item}" class="st st-justified st-theme- st-theme-default st-vertical">
          
    <ul class="{nav nav-tabs md-tabs  blue}" id="tab-panel-id" role="tablist">
    {nav_li}
       
    </ul>

    <div class="tab-content" id="tab-content">
    {tab_content_div}
        
    </div>       
    
</div>

HTML,
        'items' => <<<HTML

           {firstTab}
           <br><br>
           {secondTab}
           <br>
HTML,

        'navLi' => <<<HTML
  <li class="bg-success">
      <a class="nav-link" href="#tab{item}-{id}" >
       <span>  <strong>{tab_name}</strong> {tab_description} </span> 
      </a>
  </li>
HTML,

        'tabContentDiv' => <<<HTML
<div id="tab{item}-{id}" class="tab-pane " role="tabpanel" style="display: none;">
      <h3>{tabContentName}</h3>
      {content}
</div>

HTML,


        'css' => <<<CSS
            
          #tab-1, #tab-2, #tab-3, #tab-4{
          height: auto;
          } 
          #tab2-1, #tab2-2, #tab2-3, #tab2-4{
          height: auto;
          }
          .pilltab{
          background-color: #2d9ef8;
          padding: 0.5rem;
          box-shadow: 0 5px 11px 0 rgba(0,0,0,0.18),0 4px 15px 0 rgba(0,0,0,.15);
          border-radius: 5px;
          }
          #tab-content{
          height: auto;          
          }
                     
CSS,

        'js' => <<<JS
                    
              $(document).ready(function() {

                  {js1}
                  {js2}
                  
                 //$("#tab-content").removeAttr("style");

    });
               
JS,
        'js_html' => <<<JS
var html = '<h2>Ajax data about ' + repo + ' loaded from GitHub</h2>';
                      html += '<br>URL: <strong>' + ajaxURL + '</strong>';
                      html += '<br>Name: <strong>' + res.collected.metadata.name + '</strong>';
                      html += '<br>Description: ' + res.collected.metadata.title;
                      html += '<br>Homepage: <a href="' + res.collected.github.homepage + '" >'+ res.collected.github.homepage +'</a>';
                      html += '<br>Keywords: ' + res.collected.metadata.keywords.join(', ');

                      // html += '<br>Clone URL: ' + res.clone_url;
                      html += '<br>Stars: ' + res.collected.github.starsCount;
                      html += '<br>Forks: ' + res.collected.github.forksCount;
                      html += '<br>Watchers: ' + res.collected.github.subscribersCount;
                      html += '<br>Open Issues: ' + res.collected.github.issues.openCount + '/' + res.collected.github.issues.count;

                      html += '<br><br>Popularity: ' + parseInt(res.score.detail.popularity * 100);
                      html += '<br>Quality: ' + parseInt(res.score.detail.quality * 100);
                      html += '<br>Maintenance: ' + parseInt(res.score.detail.maintenance * 100);

                      // Resolve the Promise with the tab content
                      resolve(html);
JS,
        'ajax' => <<<JS
         $("#smarttab{item}").on("{ajaxtabContent}", function(e, anchorObject, stepIndex) {

                var repo    = anchorObject.data('repo');
                var ajaxURL = '{ajaxUrl}' + repo;
                // Return a promise object
                return new Promise((resolve, reject) => {

                  // Ajax call to fetch your content
                  $.ajax({
                      method  : '{GET}',
                      url     : ajaxURL,
                      beforeSend: function( xhr ) {
                          // Show the loader
                          $('#smarttab{item}').smartTab("loader", "show");
                      }
                  }).done(function( res ) {
                      // console.log(res);

                             {js_htnl}

                      // Hide the loader
                      $('#smarttab{item}').smartTab("loader", "hide");
                  }).fail(function(err) {

                    // Reject the Promise with error message to show as tab content
                    reject( "An error loading the resource" );

                    // Hide the loader
                    $('#smarttab{item}').smartTab("loader", "hide");
                  });

                });

            });  
JS,
        'js_init' => <<<JS
        // SmartTab initialize
        $('#smarttab{item}').smartTab({
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

        'js1' => <<<JS
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
JS,
        'js2' => <<<JS
   // Ajax content loading with "tabContent" event
             {ajaxContent}
                 
        {js_init}
        
         // Multiple tab
         $('#smarttab2').smartTab({
             // theme: 'dark'
            });
             // Demo Button Events 2
            $("#got_to_tab2").on("change", function() {
                // Go to tab
                var tab_index = $(this).val() - 1;
                $('#smarttab2').smartTab("goToTab", tab_index);
                return true;
            });

            $("#is_vertical2").on("click", function() {
                // Change Orientation
                var options = {
                  orientation: ($(this).prop("checked") == true) ? 'vertical' : 'horizontal'
                };
                $('#smarttab2').smartTab("setOptions", options);
                return true;
            });

            $("#is_justified2").on("click", function() {
                // Change Justify
                var options = {
                  justified: $(this).prop("checked")
                };

                $('#smarttab2').smartTab("setOptions", options);
                return true;
            });

            $("#animation2").on("change", function() {
                // Change theme
                var options = {
                  transition: {
                      animation: $(this).val()
                  },
                };
                $('#smarttab2').smartTab("setOptions", options);
                return true;
            });

            $("#theme_selector2").on("change", function() {
                // Change theme
                var options = {
                  theme: $(this).val()
                };
                $('#smarttab2').smartTab("setOptions", options);
                return true;
            });    
JS,


    ];

    public function asset()
    {
        $this->fileCss('https://cdn.jsdelivr.net/npm/jquery-smarttab@3.0.1/dist/css/smart_tab_all.min.css');
        // $this->fileCss('/render/navigat/ZjQuerySmartTabWidget/assets/style.css') ;

        $this->fileJs('https://cdn.jsdelivr.net/npm/jquery-smarttab@3.0.0/dist/js/jquery.smartTab.min.js');
    }

    public function codes()
    {
        $navLi_code = '';
        foreach ($this->navLi as $i) {
            $navLi_code .= strtr($this->_layout['navLi'], [
                '{tab_name}' => $i[0],
                '{tab_description}' => $i[1],
                '{id}' => $i[2],
                '{item}' => '',
            ]);
        }
        $tabContentDiv_code = '';
        foreach ($this->tabContentDiv as $i) {
            $tabContentDiv_code .= strtr($this->_layout['tabContentDiv'], [
                '{tabContentName}' => $i[0],
                '{content}' => $i[1],
                '{id}' => $i[2],
                '{item}' => '',
            ]);
        }
        $navLi_code2 = '';
        $tabContentDiv_code2 = '';
        if ($this->_config['isMultiple'] == true) {

            foreach ($this->navLi as $i) {
                $navLi_code2 .= strtr($this->_layout['navLi'], [
                    '{tab_name}' => $i[0],
                    '{tab_description}' => $i[1],
                    '{id}' => $i[2],
                    '{item}' => '2',
                ]);
            }

            foreach ($this->tabContentDiv as $i) {
                $tabContentDiv_code2 .= strtr($this->_layout['tabContentDiv'], [
                    '{tabContentName}' => $i[0],
                    '{content}' => $i[1],
                    '{id}' => $i[2],
                    '{item}' => '2',
                ]);
            }

        }
        $item2 = '';
        $item2 .= strtr($this->_layout['item'], [
            '{nav_li}' => $navLi_code2,
            '{tab_content_div}' => $tabContentDiv_code2,
            '{nav nav-tabs md-tabs  blue}' => $this->_config['classCSS'],
            '{item}' => '2',
        ]);
        $item0 = '';
        $item0 .= strtr($this->_layout['item'], [
            '{nav_li}' => $navLi_code,
            '{tab_content_div}' => $tabContentDiv_code,
            '{nav nav-tabs md-tabs  blue}' => $this->_config['classCSS'],
            '{item}' => '',
        ]);
        $this->htm = strtr(
            $this->_layout['items'], [
            // '{class}' => $this->_config['class'],
            '{firstTab}' => $item0,
            '{secondTab}' => ($this->_config['isMultiple'] == false) ? '' : $item2,
            // '{readonly}' => $this->_config['readonly'] ? 'readonly' : '',
        ]);


        $this->css = strtr($this->_layout['css'], [

        ]);
        $js_html_code = new JsExpression($this->_layout['js_html'], [

        ]);
        $ajax = strtr($this->_layout['ajax'], [
            '{item}' => '',
            '{js_htnl}' => ($this->_config['ajaxHtml'] === 'default') ? $js_html_code : new JsExpression($this->_config['ajaxHtml'], []),
            '{ajaxUrl}' => $this->jscode($this->_config['ajaxUrl']),
            '{GET}' => $this->jscode($this->_config['method']),
            '{ajaxtabContent}' => $this->jscode($this->_config['ajaxtabContent']),
        ]);
        $ajax2 = strtr($this->_layout['ajax'], [
            '{item}' => '2',
            '{js_htnl}' => ($this->_config['ajaxHtml'] === 'default') ? $js_html_code : new JsExpression($this->_config['ajaxHtml'], []),
            '{ajaxUrl}' => $this->jscode($this->_config['ajaxUrl']),
            '{GET}' => $this->jscode($this->_config['method']),
            '{ajaxtabContent}' => $this->jscode($this->_config['ajaxtabContent']),
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
            '{item}' => '',
        ]);
        $js_init2 = strtr($this->_layout['js_init'], [
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
            '{item}' => '2',
        ]);
        $js1 = strtr($this->_layout['js1'], [
            '{js_init}' => $js_init,
            '{ajaxContent}' => $ajax,
            '{got_to_tab_change}' => $this->eventCode('got_to_tab_change'),
            '{is_vertical_click}' => $this->eventCode('is_vertical_click'),
            '{is_justified_click}' => $this->eventCode('is_justified_click'),
            '{animation_change}' => $this->eventCode('animation_change'),
            '{theme_selector_change}' => $this->eventCode('theme_selector_change'),
        ]);
        $js2 = strtr($this->_layout['js2'], [
            '{js_init}' => $js_init2,
            '{ajaxContent}' => $ajax2,
        ]);
        $this->js = strtr($this->_layout['js'], [
            '{js1}' => $js1,
            '{js2}' => ($this->_config['isMultiple'] == false) ? '' : $js2,
        ]);


    }


}
