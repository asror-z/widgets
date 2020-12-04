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

use zetsoft\dbitem\App\eyuf\CheckboxItem;
use zetsoft\system\kernels\ZWidget;

class ZGrapeNavbarWidget extends ZWidget
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
        'navbarBrand' => 'Zetsoft',
        'search' => true,
        'links' => [
            'Home' => 'Home',
            'About' => 'About',
            'Gallery' => 'Gallery',
            'Contact' => 'Contact',
        ],
        'navbarBackground' => ZGrapeNavbarWidget::navbarBackground['white'],
        'buttonColor' => ZGrapeNavbarWidget::buttonColor['success'],
        'textColor' => ZGrapeNavbarWidget::textColor['dark'],
    ];

    public $branch = [];
    public $_branch = [
        'widget' => [
           'navbarBrand',
           'search',
           'links',
           'navbarBackground',
           'buttonColor',
           'textColor'
        ],
    ];

    public const navbarBackground = [
      'primary' => 'primary',
      'secondary' => 'secondary',
      'success' => 'success',
      'danger' => 'danger',
      'warning' => 'warning',
      'info' => 'info',
      'light' => 'light',
      'dark' => 'dark',
      'white' => 'white',
    ];

    public const textColor = [
        'primary' => 'primary',
        'secondary' => 'secondary',
        'success' => 'success',
        'danger' => 'danger',
        'warning' => 'warning',
        'info' => 'info',
        'light' => 'light',
        'dark' => 'dark',
        'white' => 'white',
        'muted' => 'muted',
    ];

    public const buttonColor = [
        'primary' => 'primary',
        'secondary' => 'secondary',
        'success' => 'success',
        'danger' => 'danger',
        'warning' => 'warning',
        'info' => 'info',
        'light' => 'light',
        'dark' => 'dark',
        'white' => 'white',
    ];

    public $branchLabel = [];
    public $_branchLabel = [
        'widget' => Azl . 'Опции Navbar'
    ];
    
    public $event = [];
    public $_event = [
                                  
    ];

    public $layout = [];
    public $_layout = [

        'main' => <<<HTML
         <nav class="navbar navbar-expand-lg navbar-light bg-{navbarBackground}">
        <a class="navbar-brand text-{brandColor}" href="#">{navbarBrand}</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          {links}
        </ul>
        {search}
  </div>
</nav>
HTML,

        'links' => <<<HTML
        <li class="nav-item">
            <a class="nav-link text-{textColor}" href="#">{listTitle}</a>
        </li>
HTML,

        'search' => <<<HTML
          <form class="form-inline my-2 my-lg-0">
              <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-{buttonColor} my-2 my-sm-0" type="submit">Search</button>
          </form>
HTML,


        'css' => <<<CSS
   
CSS,

        'js' => <<<JS
    
JS,
    ];

    public function asset()
    {
       
    }

    public function codes()
    {

        if ($this->_config['search'])
            $search = strtr($this->_layout['search'], [
                '{buttonColor}' => $this->_config['buttonColor'],
            ]);
        else
            $search = '';


        $links = '';
        foreach ($this->_config['links'] as $key => $value){
            $links .= strtr($this->_layout['links'], [
               '{listTitle}' => $value,
               '{textColor}' => $this->_config['textColor'],
            ]);
        }

        $this->htm = strtr($this->_layout['main'],[
           '{navbarBrand}' => $this->_config['navbarBrand'],
           '{search}' => $search,
           '{links}' => $links,
           '{navbarBackground}' => $this->_config['navbarBackground'],
           '{brandColor}' => $this->_config['textColor'],
        ]);

        $this->js = strtr($this->_layout['js'], [
            
        ]);
        $this->css = strtr($this->_layout['css'], [
        ]);
    }
}
