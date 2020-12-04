<?php

namespace zetsoft\widgets\cards;

use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\inputes\ZKStarRatingWidget;
use zetsoft\widgets\market\ZSVGWidget;

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */
class ZHCommonSaleWidget1 extends Zwidget
{
    public $config = [];
    public $_config = [
        'nameOn' => 'Арахисовая паста с мёдом 200г',
        'price' => '14,890 - 18,000',
        'per'  => '' ,
        'measurement' => self::units['шт'],
        'img' => 'https://images.pexels.com/photos/461198/pexels-photo-461198.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" class="card-img img-fluid',
        'review' => '2'
    ];

    public $event = [];
    public $_event = [];

    public const units = [
        'кг' => 'кг',
        'шт' => 'шт',
    ];

    public function asset()
    {

    }

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
           <div class="card mb-3">
    <div class="row no-gutters">
        <div class="col-md-4 d-flex align-items-center">

            <div class="position-relative overflow-hidden">
                <div class="position-absolute p-2">
        <span style="left: 10%; top: 10% " class="position-absolute ml-auto danger-color pl-2 pr-2 py-2 text-white rounded fe-10">
                -10%
            </span>
                </div>
            </div>
            <img src="{img}"  alt="...">

        </div>
        <div class="col-md-8">
            <div class="card-body">
                <div class="fe-20">{nameOn}</div>
                <div class="d-flex justify-content-between">
                    <div class="green-text-color fe-14">В наличии <span class="text-muted ml-3 fe-8">Арт:1434234</span>
                        <div class="d-flex mt-3">
                        <div>
                            {svg}
                        </div>
                            <div class="mt-1">
                                {star}
                                <p class="text-center text-muted fe-10">({review} отзыва)</p>
                            </div>
                        </div>
                        <div class="d-flex card-text align-items-center mt-2">
                            <i class="far fa-heart grey-text pr-1 ml-2 mb-3 mt-4 h4"></i>
                            <p class="fe-12 ml-2 mt-4">Избранное</p>
                            <i class="fa fa-chart-bar grey-text pr-1 ml-4 mb-2 mt-4 h4"></i>
                            <p class="ml-2 mt-4">Сравнить</p>
                        </div>

                    </div>
                    <div>
                        <div class="text-danger d-flex ml-4">
                        </div>
                          <div class="d-flex flex-wrap">
                              <div class="text-center text-success fe-18 font-weight-bold">{price}</div>
                          </div>
                        <div class="text-center fe-16 mt-1 ml-1 text-muted">сум за {per}{measurement}</div>
                        

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 
 
HTML,
        'Js' => <<<JS

JS,


    ];

    public function codes()
    {
        $this->htm = strtr($this->_layout['main'], [
            '{nameOn}' => $this->_config['nameOn'],
            '{img}' => $this->_config['img'],
            '{per}' => $this->_config['per'],
            '{review}' => $this->_config['review'],
            '{measurement}'=>$this->_config['measurement'],
            '{star}' =>
                ZKStarRatingWidget::widget([
                    'name' => 'gggfg',
                    'config' => [
                        'show' => false
                    ]
                ])
            ,
            '{price}' => $this->_config['price'],
            '{svg}' =>
                ZSVGWidget::widget([
                    'config' => [
                        'type' => ZSVGWidget::type['top_sell']
                    ]
                ])
        ]);
        $this->js = strtr($this->_layout['Js'], [

        ]);
    }
}
