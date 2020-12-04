<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\navigat\archive;

use rmrevin\yii\fontawesome\FA;
use zetsoft\system\kernels\ZWidget;

class ZjQuerySmartTabAjaxWidget extends ZWidget
{
    public $config = [];
    public $_config = [
        // 'bgColor' => ZAccLayWidget::bgColor['bg-primary-dark'],
        'theme' => ZjQuerySmartTabAjaxWidget::themeSelector['Brick'],
        'animation' => ZjQuerySmartTabAjaxWidget::Transition['animation']['none'],
        'orientation' => ZjQuerySmartTabAjaxWidget::orientationTab['horizontal'],
        'justified' => ZjQuerySmartTabAjaxWidget::Justified['true'],
        'class' => ZjQuerySmartTabAjaxWidget::navUlClass['nav nav-tabs md-tabs  blue'],
        'isStopOnFocus' => ZjQuerySmartTabAjaxWidget::autoProgress['stopOnFocus']['true'],
        'isEnabledAutonavigation' => ZjQuerySmartTabAjaxWidget::autoProgress['enabled']['false'],
        'easingEmpty' => ZjQuerySmartTabAjaxWidget::Transition['easing']['empty'],
        'isEnableURLhash' => ZjQuerySmartTabAjaxWidget::enableURLhash['true'],
        'isBackButtonSupport' => ZjQuerySmartTabAjaxWidget::backButtonSupport['true'],
        'isAutoAdjustHeight' => ZjQuerySmartTabAjaxWidget::autoAdjustHeight['true'],
        'selectedFirst' => ZjQuerySmartTabAjaxWidget::selectedTab['first'],
        'navigateInterval' => ZjQuerySmartTabAjaxWidget::autoProgress['interval']['3500'],
        'animationSpeed' => ZjQuerySmartTabAjaxWidget::Transition['speed']['400'],
        'url' => ZjQuerySmartTabAjaxWidget::ajaxUrl['url'],
        'method' => ZjQuerySmartTabAjaxWidget::ajaxMethod['GET'],

    ];
    public static $grapes = [
        'enable' => true,
        'icon' => '',
        'image' => '/render/navigat/ZAccLayWidget/image/icon.png',
        'name' => Azl . 'AccLay',
        'title' => Azl . '<b>safasfsa</b><img src="/render/navigat/ZAccLayWidget/image/icon.png"/>',

    ];
        public const ajaxUrl=[
        'url'=>'https://api.npms.io/v2/package/'
        ];
    public const ajaxMethod=[
        'GET'=>'GET' ,
        'POST'=>'POST',
        'PUT'=>'PUT'
    ];
    public const orientationTab = [
        'horizontal' => 'horizontal',
        'vertical' => 'vertical',
    ];

    public const themeSelector = [
        'Default' => 'default',
        'Classic' => 'classic',
        'Dark' => 'dark',
        'Brick' => 'brick',
        'Bootstrap Tabs' => 'bstabs',
        'Bootstrap Pills' => 'bspills',
        'No Theme' => '',
    ];
    /*public const animationSelector = [
        'none' => 'none',
        'fade' => 'fade',
        'slide-horizontal' => 'slide-horizontal',
        'slide-vertical' => 'slide-vertical',
        'slide-swing' => 'slide-swing',
    ];       */
    public const Justified = [
        'true' => true,
        'false' => false,
    ];
    public const selectedTab = [
        'first' => 1,
        'two' => 2,
        'three' => 3,
    ];
    public const autoAdjustHeight = [
        'true' => true,
        'false' => false,
    ];
    public const backButtonSupport = [
        'true' => true,
        'false' => false,
    ];
    public const enableURLhash = [
        'true' => true,
        'false' => false,
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

    public const navUlClass = [
        'nav nav-tabs md-tabs  blue' => 'nav nav-tabs md-tabs  blue',
        'nav' => 'nav'
    ];
    public $navLi = [
        ['SmartTab', 'repository details from GitHub', 1],
        ['SmartWizard', 'repository details from GitHub', 2],
        ['SmartCart', 'repository details from GitHub', 3],
    ];
    public $tabContentDiv = [
        ['Tab 1 Content', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1],
        ['Tab 2 Content', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 2],
        ['', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 3],
    ];
    public $layout = [];
    public $_layout = [
        'item' => <<<HTML
                <!--  <p>
      <label>Theme:</label>
      <select id="theme_selector">
            <option value="default" selected>Default</option>
            <option value="classic">Classic</option>
            <option value="dark">Dark</option>
            <option value="brick">Brick</option>
            <option value="bstabs">Bootstrap Tabs</option>
            <option value="bspills">Bootstrap Pills</option>
            <option value="">No Theme</option>
      </select>

      &nbsp;&nbsp;&nbsp;&nbsp;
      <input type="checkbox" id="is_vertical" value="1" />
      <label for="is_vertical">Vertical</label>

      &nbsp;&nbsp;&nbsp;&nbsp;
      <input type="checkbox" id="is_justified" value="1" checked />
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
    <br />  -->


    <!-- SmartTab html -->
    <div id="smarttab">

        <ul class="{nav nav-tabs md-tabs  blue}" id="tab-panel-id" role="tablist">
                   {nav_li}
           <!--<li>
              <a class="nav-link" href="#tab-1" data-repo="smarttab">
                <strong>SmartTab</strong><br />repository details from GitHub
              </a>
            </li>
            <li>
              <a class="nav-link" href="#tab-2" data-repo="smartwizard">
                <strong>SmartWizard</strong><br />repository details from GitHub
              </a>
            </li>
            <li>
              <a class="nav-link" href="#tab-3" data-repo="jquery-smartcart">
                <strong>SmartCart</strong><br />repository details from GitHub
              </a>
            </li>  -->
        </ul>

        <div class="tab-content">
                     {tab_content_div}
            <!--<div id="tab-1" class="tab-pane" role="tabpanel">
                <h3>Tab 1 Content</h3>
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
            </div>
            <div id="tab-2" class="tab-pane" role="tabpanel">
                <h3>Tab 2 Content</h3>
                <div>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. </div>
            </div>
            <div id="tab-3" class="tab-pane" role="tabpanel">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
            </div>  -->
        </div>
    </div>
HTML,
        'navLi' => <<<HTML
  <li>
      <a class="nav-link" href="#tab-{id}">
          <strong>{tab_name}</strong><br /> {tab_description}
      </a>
  </li>
HTML,

        'tabContentDiv' => <<<HTML
<div id="tab-{id}" class="tab-pane" role="tabpanel" style="display: none;">
      <h3>{tabContentName}</h3>
      {content}
</div>
HTML,

        'css' => <<<CSS
            body {
            padding-right: 0%;
            padding-left: 0%;
        }
           #tab-1, #tab-2, #tab-3{
          height: auto;
          }
          .md-tabs{
          margin-left: 0px;
          }
          .md-tabs, .modal-dialog.cascading-modal .modal-header .close{
          margin-right: 0px;
          }

CSS,

        'js' => <<<JS
                    
              $(document).ready(function() {

              // Ajax content loading with "tabContent" event
              $("#smarttab").on("tabContent", function(e, anchorObject, stepIndex) {

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
                          $('#smarttab').smartTab("loader", "show");
                      }
                  }).done(function( res ) {
                      // console.log(res);

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
            }
        });

            // Demo Button Events
            $("#got_to_tab").on("change", function() {
                // Go to tab
                var tab_index = $(this).val() - 1;
                $('#smarttab').smartTab("goToTab", tab_index);
                return true;
            });

            $("#is_vertical").on("click", function() {
                // Change Orientation
                var options = {
                  orientation: ($(this).prop("checked") == true) ? 'vertical' : 'horizontal'
                };
                $('#smarttab').smartTab("setOptions", options);
                return true;
            });

            $("#is_justified").on("click", function() {
                // Change Justify
                var options = {
                  justified: $(this).prop("checked")
                };

                $('#smarttab').smartTab("setOptions", options);
                return true;
            });

            $("#animation").on("change", function() {
                // Change animation
                var options = {
                  transition: {
                      animation: $(this).val()
                  },
                };
                $('#smarttab').smartTab("setOptions", options);
                return true;
            });

            $("#theme_selector").on("change", function() {
                // Change theme
                var options = {
                  theme: $(this).val()
                };
                $('#smarttab').smartTab("setOptions", options);
                return true;
            });

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
        foreach ($this->navLi as $i) {
            $navLi_code .= strtr($this->_layout['navLi'], [
                '{tab_name}' => $i[0],
                '{tab_description}' => $i[1],
                '{id}' => $i[2],
            ]);
        }
        $tabContentDiv_code = '';
        foreach ($this->tabContentDiv as $i) {
            $tabContentDiv_code .= strtr($this->_layout['tabContentDiv'], [
                '{tabContentName}' => $i[0],
                '{content}' => $i[1],
                '{id}' => $i[2],
            ]);
        }
        $this->htm = strtr(
            $this->_layout['item'], [
            // '{class}' => $this->_config['class'],
            '{nav_li}' => $navLi_code,
            '{tab_content_div}' => $tabContentDiv_code,
            '{nav nav-tabs md-tabs  blue}' => $this->_config['class'],

            // '{readonly}' => $this->_config['readonly'] ? 'readonly' : '',
        ]);
        
        $this->css = strtr($this->_layout['css'], [

        ]);
        $this->js = strtr($this->_layout['js'], [
            '{animationEffect}' => $this->jscode($this->_config['animation']),
            '{themeForTheTab}' => $this->jscode($this->_config['theme']),
            '{NavMenuOrientation}' => $this->jscode($this->_config['orientation']),
            '{isNavMenuJustification}' => $this->jscode($this->_config['justified']),
            '{selectedFirst}' => $this->jscode($this->_config['selectedFirst']),
            '{isAutoAdjustHeight}' => $this->jscode($this->_config['isAutoAdjustHeight']),
            '{isBackButtonSupport}' => $this->jscode($this->_config['isBackButtonSupport']),
            '{isEnableURLhash}' => $this->jscode($this->_config['isEnableURLhash']),
            '{animationSpeed}' => $this->jscode($this->_config['animationSpeed']),
            '{easingEmpty}' => $this->jscode($this->_config['easingEmpty']),
            '{isEnabledAutonavigation}' => $this->jscode($this->_config['isEnabledAutonavigation']),
            '{navigateInterval}' => $this->jscode($this->_config['navigateInterval']),
            '{isStopOnFocus}' => $this->jscode($this->_config['isStopOnFocus']),
            '{ajaxUrl}' => $this->jscode($this->_config['url']),
            '{GET}' => $this->jscode($this->_config['method']),
        ]);


    }
}
