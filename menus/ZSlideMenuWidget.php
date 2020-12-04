<?php

/**
 *
 *
 * Author:
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\menus;


use zetsoft\dbitem\wdg\MenuItem;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZWidget;


class ZSlideMenuWidget extends ZWidget
{
    public $config = [];
    public $_config = [

    ];

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
<div class="wrapper">
    <ul class="slide-menu-container">
        <li id="slide-menu-burger">
            <div id="slide-menu-button">
                <div class="slide-bar"></div>
                <div class="slide-bar"></div>
                <div class="slide-bar"></div>
            </div>
        </li>
        <li id="first-slide-link" class="slide-link">Journal</li>
        <li id="second-slide-link" class="slide-link">Services</li>
        <li id="third-slide-link" class="slide-link">About Us</li>
        <li id="fourth-slide-link" class="slide-link">Contact</li>
    </ul>
</div>
HTML,

'js' => <<<JS
     var menu = $('#slide-menu-burger');
    var menuButton = $('#slide-menu-button');
    var journal = $('#first-slide-link');
    var services = $('#second-slide-link');
    var about = $('#third-slide-link');
    var contact = $('#fourth-slide-link');

//Look at this mess, I'll have to refactor it
    menu.on('click',() => {
        menuButton.toggleClass('active');
        if(menuButton.hasClass('active')){
            journal.animate({'left':'110px','opacity':'1','z-index':'8'},500);
            services.animate({'left':'210px','opacity':'1','z-index':'6'},500);
            about.animate({'left':'310px','opacity':'1','z-index':'4'},500);
            contact.animate({'left':'410px','opacity':'1','z-index':'2'},500);
        }
        else {
            journal.animate({'left':'0','opacity':'0'},500);
            services.animate({'left':'0','opacity':'0'},500);
            about.animate({'left':'0','opacity':'0'},500);
            contact.animate({'left':'0','opacity':'0'},500);
        }
    });
JS,

    ];

    public function asset()
    {
        $this->fileCss('/render/grapeAssets/menus/slideMenu/styleMenu.css');

    }



    public function codes()
    {
        $this->htm = strtr($this->_layout['main'],[]);
        $this->js = strtr($this->_layout['js'],[]);
    }
}
