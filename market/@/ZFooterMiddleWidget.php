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

class ZFooterMiddleWidget extends ZWidget
{
    public $config = [];

    public $_config = [

    ];


    public $event = [];
    public $_event = [

    ];


    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
    <div class="footer_middle bg-secondary py-3">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <p class="text-center">Скачайте наше приложение</p>
                <ul class="text-center">
                    <li class="border_none"><a href="javascript:void(0);"><img src="/render/market/ZFooterMarket/assets/img/app-store.png" alt=""></a></li>
                    <li class="border_none"><a href="javascript:void(0);"><img src="/render/market/ZFooterMarket/assets/img/google-play-badge.png" alt=""></a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <p class="text-center">Мы в социальных сетях</p>
                <ul class="text-center">
                    <li class="border_side"><a href="#" target="_blank" rel="nofollow" title="MarketPlace в Facebook"><i class="fab fa-facebook "></i></a></li>
                    <li class="border_side"><a href="#" target="_blank" rel="nofollow" title="MarketPlace в Instagram"><i class="fab fa-instagram "></i></a></li>
                    <li class="border_side"><a href="#" target="_blank" rel="nofollow" title="MarketPlace в Telegram"><i class="fab fa-telegram "></i></a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <p class="text-center">Мы принимаем к оплате</p>
                <ul class="text-center">
                    <li class="border_side"><a href=""><img src="/render/market/ZFooterMarket/assets/img/click.png" alt=""></a></li>
                    <li class="border_side"><a href=""><img src="/render/market/ZFooterMarket/assets/img/payme.png" alt=""></i></a></li>
                    <li class="border_side"><a href=""><img src="/render/market/ZFooterMarket/assets/img/uzcard.png" alt=""></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>


HTML,

        'css' => <<<CSS
       
CSS,
        'js' => <<<JS
             
             
JS,

    ];


    public function codes()
    {
        
        $this->htm .= strtr($this->_layout['main'], [


        ]);

        $this->js = strtr($this->_layout['js'], [

        ]);
        $this->css .= strtr($this->_layout['css'], [

        ]);
    }


}
