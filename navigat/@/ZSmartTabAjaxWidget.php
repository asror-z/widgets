<?php

/**
 *
 *
 * Author:  Anvar Jabborov
 *
 *
 */

namespace zetsoft\widgets\navigat;

use zetsoft\system\kernels\ZWidget;

class ZSmartTabAjaxWidget extends ZWidget
{


    #region Consts
    public const orientation = [
        'horizontal' => 'horizontal',
        'vertical' => 'vertical',
    ];
    public const theme = [
        'Default' => 'default',
        'Classic' => 'classic',
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
    public const selectedTab = [
        'one' => 0,
        'two' => 1,
        'three' => 2,
        'four' => 3,
        'five' => 4,
    ];
    public const justified = [
        'true' => 'true',
        'false' => 'false',
    ];
    public const speed = [
        '400' => '400',
    ];
    public const method = [
        'GET' => 'GET',
        'POST' => 'POST',
    ];
    public static $grapes = [
        'enable' => true,
        'icon' => '',
        'image' => '/render/navigat/ZAccLayWidget/image/icon.png',
        'name' => Azl . 'AccLay',
        'title' => Azl . '<b>safasfsa</b><img src="/render/navigat/ZAccLayWidget/image/icon.png"/>',
    ];
    #endregion
    public $config = [];
    public $_config = [

        'theme' => self::theme['Default'],
        'animation' => self::animation['slide-horizontal'],
        'selectedTab' => self::selectedTab['one'],
        'justified' => self::justified['true'],
        'speed' => self::speed['400'],
        'orientation' => self::orientation['horizontal'],
        /*'toolbarPosition' => self::toolbarPosition['bottom'],
        'toolbarButtonPosition' => self::toolbarButtonPosition['right'],
        'buttonNextText' => self::buttonNextText['next'],
        'buttonPrevText' => self::buttonPrevText['previous'],
        'toolbarExtraButtons' => self::toolbarExtraButtons['none'],*/
        'method' => self::method['GET'],


    ];

    #region Arrays


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
        'gotToTab_change' => ' $("#got_to_tab").on("change", function() {
                // Go to tab
                var tab_index = $(this).val() - 1;
                $(\'#smarttab\').smartTab("goToTab", tab_index);
                return true;
            });',

        'vertical_click' => ' $("#is_vertical").on("click", function() {
                // Change Orientation
                var options = {
                  orientation: ($(this).prop("checked") == true) ? \'vertical\' : \'horizontal\'
                };
                $(\'#smarttab\').smartTab("setOptions", options);
                return true;
            });',

        'justified_click' => '$("#is_justified").on("click", function() {
                // Change Justify
                var options = {
                  justified: $(this).prop("checked")
                };

                $(\'#smarttab\').smartTab("setOptions", options);
                return true;
            });',

        'animation_change' => ' $("#animation").on("change", function() {
                // Change animation
                var options = {
                  transition: {
                      animation: $(this).val()
                  },
                };
                $(\'#smarttab\').smartTab("setOptions", options);
                return true;
            });',

        'themeSelector_change' => '$("#theme_selector").on("change", function() {
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
<div id="smarttab">
          
    <ul class="nav" >
        {nav_li}
    </ul>

    <div class="tab-content" >
        {tab_content_div}
    </div>       
                       
</div>

HTML,

        'navLi' => <<<HTML
  <li>
      <a class="nav-link" href="#tab-{id}" data-repo="{repo}">
       <span> <strong > {tab_description} </strong> </span> 
      </a>
  </li>
HTML,

        'tabContentDiv' => <<<HTML
<div id="tab-{id}" class="tab-pane" role="tabpanel">
     
</div>

HTML,

        'css' => <<<CSS
                     
CSS,

        'js' => <<<JS
    $(document).ready(function() {

              // Ajax content loading with "tabContent" event
              $("#smarttab").on("tabContent", function(e, anchorObject, stepIndex) {

                var repo    = anchorObject.data('repo');
                var ajaxURL =  repo;
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
                      // console.log(res);

                      var html = res.collected.metadata.name;                         

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

            // SmartTab initialize with options (options are optional)
            $('#smarttab').smartTab({
              selected: {first}, // Initial selected tab, 0 = first tab
              theme: '{default}', // theme for the tab, related css need to include for other than default theme
              orientation: '{horizontal}', // Nav menu orientation. horizontal/vertical
              justified: {true}, // Nav menu justification. true/false
              autoAdjustHeight: false, // Automatically adjust content height
              backButtonSupport: true, // Enable the back button support
              enableURLhash: true, // Enable selection of the tab based on url hash
              transition: {
                  animation: '{none}', // Effect on navigation, none/fade/slide-horizontal/slide-vertical/slide-swing
                  speed: '{400}', // Transion animation speed
                  easing:'' // Transition animation easing
              },
              autoProgress: { // Auto navigate tabs on interval
                  enabled: false, // Enable/Disable Auto navigation
                  interval: 3500, // Auto navigate Interval (used only if "autoProgress" is set to true)
                  stopOnFocus: true, // Stop auto navigation on focus and resume on outfocus
              }
            });

            // Demo Button Events
            {gotToTab_change}              
            {vertical_click}
            {justified_click}
            {animation_change}
            {themeSelector_change}

        });
JS,

    ];

    public function asset()
    {
        $this->fileCss('https://cdn.jsdelivr.net/npm/jquery-smarttab@3.0.1/dist/css/smart_tab_all.min.css');

        $this->fileJs('https://cdn.jsdelivr.net/npm/jquery-smarttab@3.0.1/dist/js/jquery.smartTab.min.js');
    }

    public function codes()
    {
        $navLi_code = '';
        $tabContentDiv_code = '';
        $i = 1;
        $items = $this->data;
        foreach ($items as $item) {
            $navLi_code .= strtr($this->_layout['navLi'], [
                '{repo}' => $item->url,
                '{tab_description}' => $item->title,
                '{id}' => $i,
            ]);
            $tabContentDiv_code .= strtr($this->_layout['tabContentDiv'], [
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


        $this->js = strtr($this->_layout['js'], [
            '{first}' => $this->_config['selectedTab'],
            '{default}' => $this->_config['theme'],
            '{true}' => $this->_config['justified'],
            '{none}' => $this->_config['animation'],
            '{400}' => $this->_config['speed'],
            '{horizontal}' => $this->_config['orientation'],

            '{GET}' => $this->_config['method'],
            '{gotToTab_change}' => $this->eventCode('gotToTab_change'),
            '{vertival_click}' => $this->eventCode('vertical_click'),

            '{justified_click}' => $this->eventCode('justified_click'),
            '{animation_change}' => $this->eventCode('animation_change'),
            '{themeSelector_change}' => $this->eventCode('themeSelector_change'),

        ]);

    }
}
