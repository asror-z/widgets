<?php

/**
 *
 *
 * @author:  Obidov Yasin
 * @license: MurodovMirbosit
 *
 */

namespace zetsoft\widgets\navigat;


use zetsoft\system\kernels\ZWidget;

class ZAccOnlyForGrapes extends ZWidget
{
    public $config = [];
    public $_config = [
       'content' => '',
       'title' => ''
    ];
    public static $grapes = [
        'enable' => true,
        'icon' => '',
        'image' => '/render/navigat/ZCollapsesWidget/image/icon.png',
        'name' => Azl . 'ZAccOnlyForGrapes',
        'title' => Azl . 'ZAccOnlyForGrapes',
    ];

    public function asset()
    {
        //$this->fileCss('render/navigat/ZOnlyForGrapes/asset/main.css');
    }
    public $layout = [];
    public $_layout = [
        'item' => <<<HTML
    
            
    <div class="ac-menu-{id}">
        <li class="ac-item-{id}" id="ac-profile">
            <a href="#ac-profile-{id}" class="ac-btn-{id}">
                <i class="fas fa-user"></i>
                <span>{headerTitle}</span>
            </a>
              <div class="ac-smenu-{id} d-flex justify-content-around flex-wrap">
                {content}
              </div>
        </li>
    </div>


HTML,
        

        'css' => <<<CSS
 
        .ac-menu-{id} {
            width: 100%;
            border-radius: 8px;
            overflow: hidden;
            margin: 1px;
        }
        .ac-menu-{id} li {
            list-style: none;
            width: 100%;
        }
        .ac-menu-{id} li a {
            text-decoration: none;
            display: flex;
            justify-content: right;
        }
        .ac-item-{id} {
            border: 1px solid #eeeeee;
            overflow: hidden;
            margin: 1px;
        }
        .ac-btn-{id} {
            display: block;
            padding: 16px 20px;
            background: #fff;
            color: #000;
            position: relative;
        }
        .ac-btn-{id}:before {
            content: "";
            position: absolute;
            width: 14px;
            height: 14px;
            background: #fff;
            left: 20px;
            bottom: -7px;
            transform: rotate(45deg);
        }
        .ac-btn-{id} i {
            margin-right: 10px;
            width: 8%;
        }
        .ac-smenu-{id} {
            background: #eeeeee;
            overflow: hidden;
            transition: max-height .3s;
            max-height: 0;
        }
        .ac-smenu-{id} a {
            display: block;
            padding: 16px;
            color: #fff;
            font-size: 14px;
            margin: 4px 0;
            position: relative;
        }
        .ac-smenu-{id} a:before {
            content: "";
            position: absolute;
            width: 6px;
            height: 100%;
            background: #fff;
            left: 0;
            top: 0;
            transition: .3s;
            opacity: 0;
        }
        .ac-smenu-{id} a:hover:before {
            opacity: 1;
        }
        
        .max-height {
            max-height: 20em;
            overflow-y: scroll;
        }

CSS,


        'js' => <<<JS

        $('.ac-item-{id}').on('click', function() {
          
            $('.ac-smenu-{id}').toggleClass('max-height')
          
        })
                    
JS,
    ];


    public function codes()
    {
        $this->htm = strtr($this->_layout['item'], [
           '{content}' => $this->_config['content'],
           '{headerTitle}' => $this->_config['title'],
           '{id}' => $this->id
        ]);
        $this->css = strtr($this->_layout['css'], [
           '{id}' => $this->id
        ]);
        $this->js = strtr($this->_layout['js'], [
           '{id}' => $this->id 
        ]);


    }
}

