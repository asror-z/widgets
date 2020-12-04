<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

/**
 *
 *
 * CreatedBy: prZafar
 */

namespace zetsoft\widgets\market;


use zetsoft\system\kernels\ZWidget;

class ZFooterBottomWidget extends ZWidget
{
    public $config = [];

    public $_config = [
        'check'=>true
    ];

    public $event = [];
    public $_event = [

    ];

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
        <div class="footer_bottom {class}">
            <div class="container">
                <p class="copy float-md-left d-flex">© 2020 MarketPlace. Все права защищены.</p>
                <p class="web_studio float-md-right d-flex">Copyright © 2020 | MarketPlace by <a target="_blank" rel="nofollow" href="https://zetsoft/">ZetSoft</a></p>
            </div>
        </div>
HTML,

        'css' => <<<CSS
        .footer_bottom {
            background: #FBFBFB;
            padding: 20px 0;
        }
        .footer_bottom p {
            font-size: 12px;
            color: #304455;
        }
        .footer_bottom p a {
            font-weight: 600;
            color: #304455;
        }
CSS,
        

    ];


    public function codes()
    {
        
        $this->htm .= strtr($this->_layout['main'], [
            '{class}'=>$this->_config['check']===true?'':'d-none'
        ]);


        $this->css .= strtr($this->_layout['css'], [

        ]);
    }


}
