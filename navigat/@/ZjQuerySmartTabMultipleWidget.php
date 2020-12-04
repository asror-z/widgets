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

class ZjQuerySmartTabMultipleWidget extends ZWidget
{
    public $config = [];
    public $_config = [
        // 'bgColor' => ZAccLayWidget::bgColor['bg-primary-dark'],
         'default' => ZSmartTabWidgetMusor::themeSelector['Brick'],
         'none' => ZSmartTabWidgetMusor::animationSelector['none'],

    ];
    public static $grapes = [
        'enable' => true,
        'icon' => '',
        'image' => '/render/navigat/ZAccLayWidget/image/icon.png',
        'name' => Azl . 'AccLay',
        'title' => Azl . '<b>safasfsa</b><img src="/render/navigat/ZAccLayWidget/image/icon.png"/>',

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
    public const animationSelector = [
        'none' => 'none',
        'fade' => 'fade',
        'slide-horizontal' => 'slide-horizontal',
        'slide-vertical' => 'slide-vertical',
        'slide-swing' => 'slide-swing',
    ];
    /* public const gottoTab = [
         '1 chi tab' => 1,
         '2 chi tab' => 2,
         '3 chi tab' => 3,
         '4 chi tab' => 4,
     ]    /* public const orient = [
     '1 chi tab' => 'horizontal',
     '2 chi tab' => 'vertical',
 ];
     public $theme = [
         ['default', 'Default'],
         ['classic', 'Classic'],
         ['dark', 'Dark'],
         ['brick', 'Brick'],
         ['bstabs', 'Bootstrap Tabs'],
         ['bspills', 'Bootstrap Pills'],
         ['', 'No Theme'],
     ];

     public $animation = [
         ['none', 'None'],
         ['fade', 'Fade'],
         ['slide-horizontal', 'Slide Horizontal'],
         ['slide-vertical', 'Slide Vertical'],
         ['slide-swing', 'Slide Swing'],
     ];
     public $gottotab = [
         1, 2, 3, 4,
     ];
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
       */
    public $layout = [];
    public $_layout = [
        'item' => <<<HTML
                 <p>
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
    <br />

    <!-- SmartTab html -->
    <div id="smarttab">

        <ul class="nav">
            <li>
              <a class="nav-link" href="#tab-1">
                <strong>Tab 1</strong> This is tab title
              </a>
            </li>
            <li>
              <a class="nav-link" href="#tab-2">
                <strong>Tab 2</strong> This is tab title
              </a>
            </li>
            <li>
              <a class="nav-link" href="#tab-3">
                <strong>Tab 3</strong> This is tab title
              </a>
            </li>
            <li>
              <a class="nav-link" href="#tab-4">
                <strong>Tab 4</strong> This is tab title
              </a>
            </li>
        </ul>

        <div class="tab-content">
            <div id="tab-1" class="tab-pane" role="tabpanel">
                <h3>Tab 1 Content</h3>
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
            </div>
            <div id="tab-2" class="tab-pane" role="tabpanel">
                <h3>Tab 2 Content</h3>
                <div>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. </div>
            </div>
            <div id="tab-3" class="tab-pane" role="tabpanel">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
            </div>
            <div id="tab-4" class="tab-pane" role="tabpanel">
                <h3>Tab 4 Content</h3>
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
            </div>
        </div>
    </div>

    <br /><br />
    <p>
      <label>Theme:</label>
      <select id="theme_selector2">
            <option value="default" selected>Default</option>
            <option value="classic">Classic</option>
            <option value="dark">Dark</option>
            <option value="brick">Brick</option>
            <option value="bstabs">Bootstrap Tabs</option>
            <option value="bspills">Bootstrap Pills</option>
            <option value="">No Theme</option>
      </select>

      &nbsp;&nbsp;&nbsp;&nbsp;
      <input type="checkbox" id="is_vertical2" value="1" />
      <label for="is_vertical2">Vertical</label>

      &nbsp;&nbsp;&nbsp;&nbsp;
      <input type="checkbox" id="is_justified2" value="1" checked />
      <label for="is_justified2">Justified</label>

      &nbsp;&nbsp;&nbsp;&nbsp;
      <label>Animation:</label>
      <select id="animation2">
            <option value="none">None</option>
            <option value="fade">Fade</option>
            <option value="slide-horizontal">Slide Horizontal</option>
            <option value="slide-vertical">Slide Vertical</option>
            <option value="slide-swing">Slide Swing</option>
      </select>

      &nbsp;&nbsp;&nbsp;&nbsp;
      <label>Go To:</label>
      <select id="got_to_tab2">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
      </select>
    </p>
    <br />

    <!-- SmartTab html -->
    <div id="smarttab2">

        <ul class="nav">
            <li>
              <a class="nav-link" href="#tab2-1">
                <strong>Tab 1</strong> This is tab title
              </a>
            </li>
            <li>
              <a class="nav-link" href="#tab2-2">
                <strong>Tab 2</strong> This is tab title
              </a>
            </li>
            <li>
              <a class="nav-link" href="#tab2-3">
                <strong>Tab 3</strong> This is tab title
              </a>
            </li>
            <li>
              <a class="nav-link" href="#tab2-4">
                <strong>Tab 4</strong> This is tab title
              </a>
            </li>
        </ul>

        <div class="tab-content">
            <div id="tab2-1" class="tab-pane" role="tabpanel">
                <h3>Tab 1 Content</h3>
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
            </div>
            <div id="tab2-2" class="tab-pane" role="tabpanel">
                <h3>Tab 2 Content</h3>
                <div>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. </div>
            </div>
            <div id="tab2-3" class="tab-pane" role="tabpanel">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
            </div>
            <div id="tab2-4" class="tab-pane" role="tabpanel">
                <h3>Tab 4 Content</h3>
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
            </div>
        </div>
    </div>
HTML,
         

        'css' => <<<CSS
            body {
            padding-right: 5%;
            padding-left: 5%;
        }
         

CSS,

        'js' => <<<JS
                    
               $(document).ready(function() {

            // SmartTab initialize
            $('#smarttab').smartTab();
            $('#smarttab2').smartTab({
              theme: 'dark'
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
                // Change theme
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

            // Set selected theme on page refresh
            $("#theme_selector").change();

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
        /*$theme_code = '';
        foreach ($this->theme as $i) {
            $theme_code .= strtr($this->_layout['options_theme'], [
                '{default}' => $i[0],
                '{theme_default}' => $i[1],

            ]);
        }
        $animation_code = '';
        foreach ($this->animation as $i) {
            $animation_code .= strtr($this->_layout['options_animation'], [
                '{none}' => $i[0],
                '{animationNone}' => $i[1],

            ]);
        }
        $gottotab_code = '';
        foreach ($this->gottotab as $i) {
            $gottotab_code .= strtr($this->_layout['options_gottotab'], [
                '{key_gottotab}' => $i,
                '{content_gottotab}' => $i,
            ]);
        }
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
        }  */
        $this->htm = strtr(
            $this->_layout['item'], [
            // '{class}' => $this->_config['class'],
           /* '{option_theme}' => $theme_code,
            '{option_animation}' => $animation_code,
            '{option_gottotab}' => $gottotab_code,
            '{nav_li}' => $navLi_code,
            '{tab_content_div}' => $tabContentDiv_code,     */


            // '{readonly}' => $this->_config['readonly'] ? 'readonly' : '',
        ]);
        $this->css = strtr($this->_layout['css'], [

        ]);
        $this->js = strtr($this->_layout['js'], [
           
        ]);


    }
}
