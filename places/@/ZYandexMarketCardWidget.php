<?php

namespace zetsoft\widgets\places;

use zetsoft\system\kernels\ZWidget;

/**
 * Author:  jamshid Tojiboyev
 */

class ZYandexMarketCardWidget extends Zwidget
{
    public $config = [];
    public $_config = [
    ];

    public $event = [];
    public $_event = [];

    public const units = [
    ];

    public function asset()
    {

    }

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
                      <section class="yandex-card col-md-4 z-depth-1-half h-100vh">
            <header class="yandex-card-hat">
                    <span class="number stores">1<span>магазина</span></span>
                    <div class="d-flex">
                        <button class="w-50 btn-warning btn-rounded ">Пункты выдачи</button>
                        <button class="w-50 btn-warning btn-rounded  ml-3">Торговые залы</button>
                    </div>
            </header>
            <hr>
     </section>
 
HTML,

'css' => <<<CSS
            .yandex-card {
                height: 100vh;
            }
CSS,

        'Js' => <<<JS
         
JS,


    ];

    public function codes()
    {
        $this->htm = strtr($this->_layout['main'], [

        ]);

        $this->css = strtr($this->_layout['css'], [

        ]);

        $this->js = strtr($this->_layout['Js'], [

        ]);
    }
}
