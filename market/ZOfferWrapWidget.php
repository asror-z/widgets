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

class ZOfferWrapWidget extends ZWidget
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
    <div class="offer-wrap">
    <div class="container">
        <h3 class="text-center text-info">Наши Преимущества</h3>
        <div class="row justify-content-center mt-4">
            <div class="col col-lg-3 text-center">
                <a href="#" class="offer-item">
                     <span class="reddit-ic btn-floating btn-tw"><i class="fab fa-lg fa-reddit-alien "></i></span>
                    <h5 class="font-weight-bold">Контроль качества</h5>
                    <p class="pt-3">Утконос проверяет свежесть и качество всех товоров</p>
                </a>
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
