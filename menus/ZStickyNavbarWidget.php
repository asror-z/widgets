<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\menus;


use PharIo\Manifest\Url;
use PhpOffice\PhpWord\Reader\HTML;
use zetsoft\dbitem\wdg\MenuItem;
use zetsoft\service\menu\ALL;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZHTML;
use zetsoft\system\helpers\ZStringHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZWidget;



class ZStickyNavbarWidget extends ZWidget
{
    public $config = [];
    public $_config = [
    ];
    public const type = [
        'navbar' => 'navbar'
    ];
    public $layout=[];
    public $_layout=[

        'main'=><<<HTML
<div id="navbar">
    <a class="active" href="#Home">Home</a>
    <a href="#About">About</a>
    <a href="#Services">Services</a>
    <a href="#Contact">Contact</a>
</div>
HTML,
        'css'=><<<CSS
#navbar {
        overflow: hidden;
        background-color: #4CAF50;
    }

    #navbar a {
        float: left;
        display: block;
        color: #f2f2f2;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
        font-size: 17px;
    }

    #navbar a:hover {
        background-color: #ddd;
        color: black;
        }
CSS,
        'js'=><<<JS
$(function () {
        $('.header').stickyNavbar({
            activeClass: "active",
            sectionSelector: "scrollto",
            animDuration: 250,
            startAt: 0,
            easing: "linear",
            animateCSS: true,
            animateCSSRepeat: false,
            cssAnimation: "fadeInDown",
            jqueryEffects: false,
            jqueryAnim: "slideDown",
            selector: "a",
            mobile: false,
            mobileWidth: 480,
            zindex: 9999,
            stickyModeClass: "sticky",
            unstickyModeClass: "unsticky"
        });
    });
JS,


    ];
    public function asset()
    {
        $this->fileJs('https://cdn.jsdelivr.net/npm/stickyNavbar.js@1.3.3/jquery.stickyNavbar.min.js');
    }

    public function codes()
    {

        $this->htm = strtr($this->_layout["main"],[
        ]);
        $this->js = strtr($this->_layout["js"],[]);
        $this->css = strtr($this->_layout["css"],[]);
    }

}

