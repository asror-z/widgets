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


use zetsoft\system\kernels\ZWidget;

class ZSidebarWidget extends ZWidget
{
    public $config = [];
    public $_config = [
        'li' => [
            'a_tag' => ['Главная', 'Для слабовидящих', 'Мобильная интерпретация', 'Читай вслух', 'Карта сайта'],
            'a_link' => ['#', '#', '#', '#', '#'],
            'a_class' => ['home-link', 'eye-left vi-open', 'btn-adaptive', 'ovoz-left', 'sitemap-left'],
            'a_title' => ['Главная', 'Для слабовидящих', 'Мобильная интерпретация', 'Читай вслух', 'Карта сайта'],
        ],
        'font_size' => '14px',
    ];

    public $layout = [];
    public $_layout = [

        'main' => <<<HTML
   <ul class="menu-left" style="font-size: {font_size}">
       <!--{li}-->
         <li><a href="#"><span class="fas fa-archive"></span></a></li>
         <li><a href="#"><span class="far fa-heart"></span></a></li>
         <li><a href="#"><span class="fas fa-history"></span></a></li>
    </ul>
     
HTML,

        'css' => <<<CSS

    .menu-left {
        position: fixed;
        /* top: 0; */
        right: 0;
        background: #303030;
        /* height: 100%; */
        list-style-type: none;
        margin: 0px;
        padding: 0;
        padding-top:15%;
        z-index: 9999;
        bottom: 50%;
        height: 100%;
        transform: translateY(50%);
    }

    .menu-left li a {
        display: block;
        height: 40px;
        width: 40px;
        //text-indent: -500em;
        line-height: 55px;
        text-align: center;
        vertical-align: middle;
        padding-top: 0px!important;
        color: #ffffff;
        background: transparent;
        position: relative;
        transition: background 0.3s ease-in-out;
    }
     .menu-left li a span{
        position:absolute;
        margin-top: 11px;
        margin-left: -8px;        
     }

    /*.menu-left li a:before {
        font-family: 'Font Awesome 5 Free', 'Font Awesome 5 Brands';
        speak: none;
        text-indent: 0em;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        font-size: 1.4em;
        font-weight: 700;
        
    }  

    .menu-left li a.home-link:before {
        content: "\\f015";
    }

    .menu-left li a.btn-adaptive:before {
        content: "\\f10b";
    }

    .menu-left li a.sitemap-left:before {
        content: "\\f0e8";
    }

    .menu-left li a.eye-left:before {
        content: "\\f06e";
    }

    .menu-left li a.ovoz-left:before {
        content: "\\f028";
    }

    .menu-left li a.virtual-left:before {
        content: "\\f2f6";
    }

    .menu-left li a.resetFont:before {
        content: "\\f122";
    }  
    
    */

    .menu-left li a:hover {
         background-color: #FE2A2A;
        color: #f7ecec;
    }

    .menu-left li.current-left a {
        background: #ff5e5e;
        color: #fff;
    }

    .menu-left li a.active-left {
        background: #0651b8;
        color: #fff;
    }

    .menu-left li a.active-left:after {
        position: absolute;
        left: 70px;
        top: 0;
        content: "";
        border: 35px solid transparent;
        border-left-color: #0651b8;
        border-width: 35px 14px;
    }

    .menu-left li {
        position: relative;
    }



CSS,

    ];

    public function asset()
    {
        $this->fileCss('https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
        $this->fileCss('https://cdnjs.cloudflare.com/ajax/libs/bootswatch/4.5.0/cerulean/bootstrap.min.css');
    }

    public function genaret($arr = [])
    {
        $htmll = '';
        for ($i = 0, $max = count($arr['a_title']); $i < $max; $i++) {
            $htmll .= <<<HTML
               <li>
                     <a href="{$arr['a_link'][$i]}" class="{$arr['a_class'][$i]}" title="{$arr['a_title'][$i]}">{$arr['a_tag'][$i]}
                        <i class="fa fa-box-alt"></i>
                     </a>
                </li>
       
HTML;

        }
        return $htmll;

    }

    public function codes()
    {

        $this->htm = strtr($this->_layout['main'], [

            //'{li}' => $this->genaret($this->_config['li']),
            '{font_size}' => $this->_config['font_size'],

        ]);

        $this->css = strtr($this->_layout['css'], []);
        /*{$this->genaret($this->_config['li'])}*/

    }
}
