<?php

/**
 *
 *
 * Author:  Daho
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\menus;


use zetsoft\system\kernels\ZWidget;

class ZSmartMenuWidget extends ZWidget
{
    public $config = [];
    public $_config = [
        'data' => [],

    ];

    public function asset()
    {
       /* $this->fileCss('/publish/yarner/smartmenus/dist/css/sm-core-css.css');
        $this->fileCss('/publish/yarner/jquery-smartmenu/css/smartMenu.css');
        $this->fileCss('/publish/yarner/smartmenus/dist/css/sm-blue/sm-blue.css');

        $this->fileJs('/publish/yarner/smartmenus/dist/jquery.smartmenus.min.js');   */

                            /* cdn.jsdelivr*/
        $this->fileCss('https://cdn.jsdelivr.net/npm/smartmenus@1.1.0/dist/css/sm-core-css.css');
        $this->fileCss('https://cdn.jsdelivr.net/npm/jquery-smartmenu@1.0.0/css/smartMenu.css');
        $this->fileCss('https://cdn.jsdelivr.net/npm/smartmenus@1.1.0/dist/css/sm-blue/sm-blue.css');

        $this->fileJs('https://cdn.jsdelivr.net/npm/smartmenus@1.1.0/dist/jquery.smartmenus.min.js');
    }


    private function menuGenerator($items = []) {
        $menu = <<<HTML
          
<nav class="navbar navbar-expand-lg navbar-dark primary-color">
        <button class="navbar-toggler mr-0" type="button" data-toggle="collapse" data-target="#mycollapse" aria-controls="mycollapse" >
        <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="mycollapse">
  
      <ul id="main-menu" class="sm sm-blue">
       <li class="pl-2 pr-3">
           <span id="hamburger" class="Sticky">
                <a href="#menu" class="mburger mburger--collapse">
                    <b></b>
                    <b></b>
                    <b></b>
                </a>
           </span>
       </li>

HTML;
        foreach ($items as $key => $value){
            if(is_array($value)){
                   $menu .= <<<HTML
    <li><a href="#">{$key}</a>
    <ul>
HTML;
            foreach ($value as $k => $v){
                $menu .= <<<HTML
       <li><a href="{$v}">{$k}</a></li>
HTML;

            }
            $menu .= <<<HTML
        </ul>
  </li>
HTML;

            } else{
                 $menu .= <<<HTML
<li><a href="{$value}">{$key}</a> </li>
HTML;
            }
        }

        $menu .= <<<HTML
</ul>
</div>
</nav>
HTML;
     return $menu;

    }

    public function codes()
    {
        $this->htm = Az::$app->menuGenerator($this->_config['data']);
        $this->js = <<<JS
     $(function() {
  $('#main-menu').smartmenus();
});

JS;
    }
}
