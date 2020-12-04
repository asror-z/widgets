<?php

namespace zetsoft\widgets\cards;

use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\inputes\ZKStarRatingWidget;
use zetsoft\widgets\inputes\ZKTouchSpinWidget;
use zetsoft\widgets\market\ZSVGWidget;

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */
class ZHCommonSaleWidget2 extends Zwidget
{
    public $config = [];
    public $_config = [
        'nameOn' => 'Арахисовая паста с мёдом 200г',
        'price' => '14,890 - 18,000',
        'price_old' => '20,000',
        'per'  => '' ,
        'measurement' => self::units['шт'],
        'img' => 'https://images.pexels.com/photos/461198/pexels-photo-461198.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" class="card-img img-fluid',
        'review' => '2',
        'id' => 'id'
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

                <div class="position-absolute " style="left: 3%; top: 5% ">
        <span class="danger-color pl-2 pr-2 py-2 text-white rounded fe-10">
                -10%
            </span>
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
                        <div class="text-danger text-center mr-4">
                            <strike class="">{price_old}</strike>
                        </div>
                          <div class="d-flex flex-wrap">
                              <div class="text-center text-success fe-18 font-weight-bold mx-auto">{price}</div>
                          </div>
                        <div class="text-center fe-16 mt-1 ml-1 text-muted">сум за {per}{measurement}</div>
                        
                        
                        
                        
                        
                        
                        
                        <button id="add-cart-{id}" class="btn btn-success add-cart">Добавить в корзину</button>

                        <div id="input-{id}" class="touch-main d-none">
                            <div class="d-flex justify-content-end">
                                <div class="d-flex parent-clear w-75">
                                    {plus}
                                </div>
                                <div id="basket-delete-{id}">
                                    {delete}
                                </div>
                            </div>
                        </div>
                        
                        
                        

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 
 
HTML,
        'Js' => <<<JS
         $(document).ready(function () {
        $('#add-cart-{id}').on("click", function () {
            $(this).addClass('d-none');

            var childTouch =$("#input-{id}");
            childTouch.removeClass("d-none");
            $('#input-{id} input').val(1);
        });
    });


    $(document).ready(function () {
        $('#basket-delete-{id}').on("click", function () {
            var clear = $(this).parent(".parent-clear");
            var first = clear.children(".bootstrap-touchspin");
            var second = first.children(".clear-add-btn");
            $('#add-cart-{id}').removeClass("d-none");
            $('#input-{id}').addClass("d-none");
            second.val("");
            $('#input-{id} input').val(0);
        })

    })
JS,


    ];

    public function codes()
    {
        $this->htm = strtr($this->_layout['main'], [
            '{nameOn}' => $this->_config['nameOn'],
            '{img}' => $this->_config['img'],
            '{id}' => $this->_config['id'],
            '{per}' => $this->_config['per'],
            '{review}' => $this->_config['review'],
            '{measurement}'=>$this->_config['measurement'],
            '{price}' => $this->_config['price'],
            '{price_old}' => $this->_config['price_old'],
            '{plus}'=>
                                     ZKTouchSpinWidget::widget([
                                        'name' => 'asds',

                                        'config' => [
                                            'min' => '0',
                                            'buttonup_txt' => '<i class="fa fa-plus px-2"></i>',
                                            'buttondown_txt' => '<i class="fa fa-minus px-2"></i>',
                                            'buttonup_class' => 'btn btn-success fp-18 rounded-right p-1',
                                            'buttondown_class' => 'btn btn-success fp-18 rounded-left p-1',
                                            'class' => 'text-center clear-add-btn',
                                            'initVal' => '1'

                                        ]
                                    ])
                                    ,
            '{delete}'=>
                                    ZSVGWidget::widget([
                                        'config' => [
                                            'type' => ZSVGWidget::type['basket_delete']
                                        ]
                                    ])
                                    ,
            '{star}' =>
                ZKStarRatingWidget::widget([
                    'name' => 'gggfg',
                    'config' => [
                        'show' => false
                    ]
                ])
            ,
            '{svg}' =>
                ZSVGWidget::widget([
                    'config' => [
                            'type' => ZSVGWidget::type['top_sell']
                    ]
                ])
        ]);
        $this->js = strtr($this->_layout['Js'], [
            '{id}' => $this->_config['id'],
        ]);
    }
}
