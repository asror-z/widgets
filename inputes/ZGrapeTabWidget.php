<?php

/**
 *
 *
 * Author: Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\inputes;

use zetsoft\system\kernels\ZWidget;

class ZGrapeTabWidget extends ZWidget
{
    /**
     * https://iqbalfn.github.io/bootstrap-image-checkbox/#
     * https://github.com/iqbalfn/bootstrap-image-checkbox
     * /core/tester/asror/main.aspx?path=render/inputes/ZBootstrapImgCheckboxWidget/active.php
     */
    public static $grapes = [
        'enable' => true,
        'icon' => '',
        'height' => '600px',
        'width' => '840px',
        'image' => '/render/inputes/ZFileInputWidget/image/icon.png',
        'name' => Azl . 'Select2',
        'title' => Azl . '<b>Title</b>',
    ];

    public $config = [];
    public $_config = [
        'grapes' => true,
        
    ];
    
    public const animationClass = [
       'transition' => 'transition',
       'only' => 'only',
       'notAnimation' => 'notAnimation',
    ];

    public const buttonClass = [
      'primary' => 'primary',
      'danger' => 'danger',
      'info' => 'info',
      'dark' => 'dark',
      'warning' => 'warning',
    ];

    public const headerColor = [
        'primary' => 'primary',
        'danger' => 'danger',
        'info' => 'info',
        'dark' => 'dark',
        'warning' => 'warning',
    ];

    public const buttonSize = [
      'lg' => 'lg',
      'md' => 'md',
      'sm' => 'sm',
      'block' => 'block',
    ];

    public const shadowSize = [
      'sm' => 'sm',
      'lg' => 'lg',
    ];
    
    public $branch = [];
    public $_branch = [
        'widget' => [
            
        ],
    ];

    public $branchLabel = [];
    public $_branchLabel = [
        
    ];


    public $event = [];
    public $_event = [

    ];

    
    public $layout = [];
    public $_layout = [

        'main' => <<<HTML
<div class="container mt-3">
    <!-- Nav tabs -->
  <ul class="nav nav-tabs">
    <li class="nav-item text-center mx-0 px-0 col">
      <a class="nav-link active" href="#home">Home</a>
    </li>
    <li class="nav-item text-center mx-0 px-0 col">
      <a class="nav-link" href="#menu1">Menu 1</a>
    </li>
    <li class="nav-item text-center mx-0 px-0 col">
      <a class="nav-link" href="#menu2">Menu 2</a>
    </li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content border rounded-bottom mb-3">
    <div id="home" class="container tab-pane active"><br>
      <h3>HOME</h3>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
    </div>
    <div id="menu1" class="container tab-pane fade"><br>
      <h3>Menu 1</h3>
      <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
    </div>
    <div id="menu2" class="container tab-pane fade"><br>
      <h3>Menu 2</h3>
      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
    </div>
  </div>
</div>

HTML,

        'css' => <<<CSS

CSS,
        
        'js' => <<<JS
          $(document).ready(function(){
  $(".nav-tabs a").click(function(){
    $(this).tab('show');
  });
  $('.nav-tabs a').on('shown.bs.tab', function(event){
    var x = $(event.target).text();         // active tab
    var y = $(event.relatedTarget).text();  // previous tab
    $(".act span").text(x);
    $(".prev span").text(y);
  });
});
JS,
    ];

    public function asset()
    {

    }

    public function codes()
    {

        $this->htm = strtr($this->_layout['main'], [
            
        ]);

        $this->js = strtr($this->_layout['js'], [

        ]);
        
        $this->css = strtr($this->_layout['css'], [

        ]);
        
    }
}
