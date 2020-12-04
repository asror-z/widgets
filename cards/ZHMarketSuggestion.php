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
 * CreatedBy: Mirshod Ibodov
 */

namespace zetsoft\widgets\cards;


use zetsoft\system\Az;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\inputes\ZKStarRatingWidget;
use zetsoft\widgets\inputes\ZKTouchSpinWidget;
use zetsoft\widgets\market\ZSVGWidget;

class ZHMarketSuggestion extends ZWidget
{

    public $config = [];

    public $_config = [
        'items' => [],

        /*'name' => 'SAMSUNG',
         'productColor' => 'красный',
        'review' => '400',
        'stars-size' => '12px',
        'delivery_cost' => 'Бесплатно'*/
    ];


    public $event = [];
    public $_event = [

    ];
    public function asset()
    {
        $this->fileJs('/render/cards/ZVMarketWidget/asset/main2.js');
    }

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
        {content}
HTML,


        'content' => <<<HTML
<div class="container-fluid mt-2">
    <div class="row">
        <div class="card w-100 ml-5">
            <div class="card-body d-flex">
            <div class="col-lg-3 col-md-3 col-sm-3 border-right border-light d-flex flex-column justify-content-center">
                <div class="fp-20 text-primary font-weight-bold d-flex justify-content-center px-3"><!--{name}-->Samsung</div>
                <div class="mx-auto">
                    <div id="starRatingId">{starRating} </div>           
                    <a href="" class="d-flex justify-content-center">{review} отзывов</a>
                </div>
                <a href="" class="d-flex justify-content-center">
                    <i class="fas fa-phone fp-21" aria-hidden="true"></i>
                    <span class="fp-14 ml-1">Показать телефон</span>
                </a>
            </div>
   
                <div class="col-lg-4 col-md-4 col-sm-4 d-flex flex-column justify-content-center border-right border-light">          
                    <div  class="text-success">{delivery_cost} курьером</div>
                    <div><a href="">Все варианты доставки.</a></div>
                    <div><h6>Варианты оплаты уточняйте в магазине.</h6></div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-3 border-right border-light" >
                <div>
                    <span class="d-flex "> 
                        <strike class="font-weight-bold text-muted">{price_old}</strike> 
                        <bolder style="background: #ec0000;color: white;border-radius: 9px 2px 2px 9px; font-weight:800; margin-left: 10px;" class="fp-14 d-flex align-items-center px-1">
                        {discount}%
                        </bolder> 
                        </span>
                    <div class="font-weight-bold fp-24">{new_price}</div>
                    
                    <span class="d-flex"> 
                        <div><a href="" class="fp-16">Цвет товара: </a></div>
                        <div class="ml-1 text-success fp-16">{productColor}</div>
                     </span>
                    <span class="d-flex"> <a href="" class="fp-14">Еще 2 варианта</a> </span>
                </div>
                  
                </div>
               
                
                <div class="col-lg-2 col-md-2 col-sm-2 d-flex align-items-center ">
                <div class="mx-2 footer-main">
                    <button id="add-card-{id}"
                     class="mx-0 btn-sm add-card btn btn-success {cart_amount}"
                     data-catalog-id="{catalogId}"
                     onclick="addToCart($(this))">
                     {add_card}
                    </button>
                    
                    <div id="input-{id}" class="touch-main {cart_amount-touch_spin}">
                         <div class="d-flex touch-main-children justify-content-center">
                         <div class="d-flex parent-clear w-75">{touch_spin}</div>
                         <div class="v-card-clear-add align-self-center ml-2" data-catalog-id="{catalogId}"
                              onclick="deleteFromCart($(this))">
                                {basket_delete}
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


        'css' => <<<CSS
       
CSS,

        'js' => <<<JS
             $('#starRatingId').find('.fas,.fa-star').css({
                "font-size": "{stars-size}"
             });  

        
JS,

    ];

    public function codes()
    {
        $code = '';
        $items = $this->_config['items'];
        foreach ($items as $item) {
            if ($item->cart_amount === null) {
                $item->cart_amount = 0;
            }
            $code .= strtr($this->_layout['content'], [
                '{name}' => $item->name,
                '{productColor}' => $item->productColor,
                '{starRating}' => ZKStarRatingWidget::widget([
                    'name' => 'gggfg',
                    'config' => [
                        'show' => false,
                    ]
                ]),
                '{review}' => $item->review,
                '{delivery_cost}' => $item->delivery_cost,
                '{price_old}' => $item->price_old,
                '{new_price}' => $item->new_price,
                '{discount}' => $item->discount,
                '{id}' => $item->id,
                '{cart_amount}'=>$item->cart_amount > 0 ? "d-none" : "",
                '{cart_amount-touch_spin}'=>$item->cart_amount > 0 ? " " : "d-none",
                '{catalogId}'=>$item->catalogId,
                '{add_card}'=>Az::l('Добавить в корзину'),
                '{touch_spin}'=> ZKTouchSpinWidget::widget([
                    'name' => 'asds',
                    'config' => [
                        'min' => '0',
                        'buttonup_txt' => '<i class="fas fa-plus px-2"></i>',
                        'buttondown_txt' => '<i class="fas fa-minus px-2"></i>',
                        'buttonup_class' => 'btn btn-success fp-18 rounded-right p-1',
                        'buttondown_class' => 'btn btn-success fp-18 rounded-left p-1',
                        'class' => 'text-center clear-add-btn h-25',
                        'initVal' => '1'
                    ],
                    'event' => [
                    'startupspin' => <<<JS
                                    function(){
                                     //spinUp(item->id,item->catalogId);
                                    }
JS,
                    'startdownspin' => <<<JS
                                    function(){
                                     //spinDown(item->id,item->catalogId);
                                    }
JS,
                    ]]),
                '{basket_delete}'=> ZSVGWidget::widget([
                                    'config' => [
                                        'type' => 'basket_delete',
                                        'width_basket' => 30,
                                        'height_basket' => 26,
                                    ]
                                    ]),

            ]);

        }


        $this->htm = strtr($this->_layout['main'], [
            '{content}' => $code
        ]);

        $this->css = strtr($this->_layout['css'], [

        ]);
        $this->js .= strtr($this->_layout['js'], [
            '{stars-size}' => $this->_config['stars-size']
        ]);
    }


}
