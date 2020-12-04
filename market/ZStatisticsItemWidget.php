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

class ZStatisticsItemWidget extends ZWidget
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
    <div class="statistic">
    <div class="container">
        <div class="row">
            <div class="col-4 d-flex text-uppercase pl-5">
                <div class="statistic-count ">
                    <span>более <span class="deep-orange-text font-weight-bold">8 лет</span></span> <br> на рынке узбекистана
                </div>
            </div>
            <div class="col-4 d-flex pl-5 text-uppercase">
                <div class="statistic-count ">
                    <span>более <span class="deep-orange-text font-weight-bold">302626</span></span> <br> товаров и услуг
                </div>
            </div>
            <div class="col-4 d-flex pl-5 text-uppercase">
                <div class="statistic-count">
                    <span>более <span class="deep-orange-text font-weight-bold">16007</span></span> <br> активных компаний
                </div>
            </div>
        </div>
    </div>
</div>x 


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
