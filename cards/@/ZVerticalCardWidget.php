<?php

namespace zetsoft\widgets\cards\newWidgets;

use zetsoft\system\Az;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\inputes\ZKStarRatingWidget;
use zetsoft\widgets\inputes\ZKTouchSpinWidget;
use zetsoft\widgets\market\ZStarDobtcoWidget;
use zetsoft\widgets\market\ZSVGWidget;


class ZVerticalCardWidget extends ZWidget
{
    public $config = [];
    public $_config = [

    ];
    public $event = [];
    public $_event = [];

    public function asset()
    {
    }

    public $layout = [];
    public $_layout = [
        'group' => <<<HTML
            <div class="card-group">
                {cards}
</div>
HTML,

        'main' => <<<HTML
         <div class="card m-2 col-3 p-0">

            <div class="position-relative overflow-hidden">
                <div class="position-absolute p-2 d-flex">
                    
                    <div class="">
                        {topSell}
                    </div>
                    <div>
                        {freeDelivery}
                    </div>
                </div>
                <span style="right: 2%; top: 4%" class="position-absolute ml-auto danger-color pl-2 pr-2 py-2 mr-2 text-white rounded fe-10">
                {discount} %
            </span>

                <img src="https://images.pexels.com/photos/461198/pexels-photo-461198.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" class="card-img-top" alt="...">
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div class="card-title fe-12">{itemName}</div>
                    <div class="d-flex mt-1">
                        <a role="button" class="heart" href="#" onclick="add_wish_list({product_id}, $(this))"><i class="far fa-heart grey-text mr-2 h5 {wishActive}"></i></a>
                        <a href="#" role="button" onclick="add_compare_list({product_id}, $(this),false)"><i class="fa fa-chart-bar grey-text h5 {compareActive}"></i></a>
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <div class="text-success fe-12">{itemAmount}</div>
                    <div class="text-muted card-text"><!--Art: 34234234--></div>
                </div>

                <div class="d-flex flex-wrap justify-content-between">
                    <div>
                        <div class="d-flex flex-wrap">
                            <div class="text-muted d-flex align-items-center fe-08">{itemBeforeCurrency}</div>
                            <div class="text-success fe-12">{itemPrice}</div>
                            <div class="text-muted d-flex align-items-center fe-08">{itemAfterCurrency} за 1 {itemMeasure}</div>
                        </div>
                        <div class="text-danger mt-n2"><strike class="fe-10">{itemOldPrice}</strike></div>
                    </div>
                    <div class="card-text">
                        {starRating}
                        <h6 class="card-text text-muted text-center">(2 отзыва)</h6>
                    </div>
                </div>

                <div>

                </div>
            </div>
            <button id="add-cart-{id}" class="btn btn-success text-white add-cart {buttonHidden}">Добавить в корзину</button>


            <div id="input-{id}" class="touch-main d-none">
                <div class="d-flex justify-content-center">
                    <div class="d-flex parent-clear w-75">
                        {touchspin}
                    </div>    
                    <div id="basket-delete-{id}">
                        
                        {basketDelete}

                    </div>
                </div>
            </div>
        </div>
HTML,

        'js' => <<<JS
        $('#add-cart-{id}').on("click", function () {
            $(this).addClass('d-none');
            var childTouch = $("#input-{id}");
            childTouch.removeClass("d-none");
            $('#input-{id} input').val(1);
            $.ajax({
                  url: '/shop/core/product/setToCart.aspx',
                  method: 'GET',
                  data: {
                      catalog_id: {id},
                      amount: 1,
                  },
                  success: function (data) {
                      $('#cart_total_amount').html(data);
                      console.log(data, $('#cart_total_amount').html(data))
                  },
                  error: function (error) {
                     console.log(error);
                  }
              })
        });


        $('#basket-delete-{id}').on("click", function () {
            var clear = $(this).parent(".parent-clear");
            var first = clear.children(".bootstrap-touchspin");
            var second = first.children(".clear-add-btn");
            $('#add-cart-{id}').removeClass("d-none");
            $('#input-{id}').addClass("d-none");
            second.val("");
            $('#input-{id} input').val(0);
            $.ajax({
                  url: '/shop/core/product/setToCart.aspx',
                  method: 'GET',
                  data: {
                      catalog_id: {id},
                      amount: 0,
                  },
                  success: function (data) {
                      $('#cart_total_amount').html(data);
                      console.log(data, $('#cart_total_amount').html(data))
                  },
                  error: function (error) {
                     console.log(error);
                  }
              })
        })

JS,

    ];

    public function codes()
    {

        $model = Az::$app->market->product->allProducts();
        //vdd($model);
        $cards = '';
        foreach ($model as $key => $value){
            $wish = Az::$app->market->product->inWish($value->id);
            $compare = Az::$app->market->product->inCompare($value->id);
            if($value->amount > 0){
                $itemAmount = 'В наличии';
            } else {
                $itemAmount = 'Нет в наличии';
            };
            if(count($value->price) == 1){
                $itemPrice = $value->price;
            } else {
                $itemMaxPrice = Max($value->price);
                $itemMinPrice = Min($value->price);
                $itemPrice = $itemMinPrice . ' - ' . $itemMaxPrice;
            };
            if(count($value->price_old) == 1){
                $itemOldPrice = $value->price_old;
            } else {
                $itemMaxOldPrice = Max($value->price_old);
                $itemMinOldPrice = Min($value->price_old);
                $itemOldPrice = $itemMinOldPrice . ' - ' . $itemMaxOldPrice;
            }
            if(count($value->price) == 1){
              $priceDifference = $itemOldPrice - $itemPrice;
              $discount = round($priceDifference / $itemOldPrice * 100);
            } else {
                $priceDifference = $itemMaxOldPrice - $itemMaxPrice;
                $discount = round($priceDifference / $itemMaxOldPrice * 100);
            }
            $topSell = '';
            $freeDelivery = '';


            foreach ($value->status as $_key => $_value){
                if ($_value == 'top_sell'){
                    $topSell = ZSVGWidget::widget([
                        'config' => [
                            'type' => 'top_sell'
                        ]
                    ]);


                }else if($_value == 'free_delivery'){
                    $freeDelivery = ZSVGWidget::widget([
                        'config' => [
                            'type' => 'free_delivery'
                        ]
                    ]);
                }
                 else {
                    $topSell = ' ';
                }
            }

            $itemBeforeCurrency = '';
            $itemAfterCurrency = '';
            if($value->currencyType == 'before'){
                $itemBeforeCurrency = $value->currency;
            }else if ($value->currencyType == 'after'){
                $itemAfterCurrency = $value->currency;
            }
            $btnHidden = '';
            if(count($value->price) > 1){
                $btnHidden = 'd-none';
            }

            $categoryId = $value->id;
            $cards = $this->htm .= strtr($this->_layout['main'], [
                '{itemName}' => $value->name,
                '{itemAmount}' => $itemAmount,
                '{itemPrice}' => $itemPrice,
                '{itemBeforeCurrency}' => $itemBeforeCurrency,
                '{itemAfterCurrency}' => $itemAfterCurrency,
                '{itemMeasure}' => $value->measure,
                '{starRating}' => ZKStarRatingWidget::widget([
                    'name' => 'gggfg',
                    'config' => [
                        'value' => $value->rating,
                    ]
                ]),
                '{itemOldPrice}' => $itemOldPrice,
                '{touchspin}' => ZKTouchSpinWidget::widget([
                    'name' => 'asds',

                    'config'=> [
                        'min' => '0',
                        'buttonup_txt' => '<i class="fa fa-plus px-2"></i>',
                        'buttondown_txt' => '<i class="fa fa-minus px-2"></i>',
                        'buttonup_class' => 'btn btn-success fp-18 rounded-right p-1',
                        'buttondown_class' => 'btn btn-success fp-18 rounded-left p-1',
                        'class' => 'text-center clear-add-btn',
                        'initVal' => '1',
                    ],
                    'event' => [
                        'startupspin' => <<<JS
                            function() {
                        let amount = $("#input-" + $value->id + " input").val();
                                       $.ajax({
                                          url: '/shop/core/product/setToCart.aspx',
                                          method: 'GET',
                                          data: {
                                              catalog_id: $categoryId,
                                              amount: amount,
                                          },
                                          success: function (data) {
                                              $('#cart_total_amount').html(data);
                                          },
                                          error: function (error) {
                                             console.log(error);
                                          }
                                      }) 
                                    }
JS,
                        'startdownspin'=> <<<JS
                                        function() {
                                            let amountMinus = $("#input-" + $value->id + " input").val();
                                            $.ajax({
                                          url: '/shop/core/product/setToCart.aspx',
                                          method: 'GET',
                                          data: {
                                              catalog_id: $categoryId,
                                              amount: amountMinus --,
                                          },
                                          success: function (data) {
                                              $('#cart_total_amount').html(data);
                                          },
                                          error: function (error) {
                                             console.log(error);
                                          }
                                      })  
                                        
                                        }
JS

                    ]
                ]),
                '{basketDelete}' => ZSVGWidget::widget([
                    'config' => [
                        'type' => 'basket_delete',
                    ]
                ]),
                '{id}' => $value->id,
                '{discount}' => $discount,
                '{topSell}' => $topSell,
                '{freeDelivery}' => $freeDelivery,
                '{wishActive}' => $wish ? 'text-danger' : '',
                '{product_id}' => $value->id,
                '{compareActive}' => $compare ? 'text-success' : '',
                '{buttonHidden}' => $btnHidden,

            ]);


            $this->js .= strtr($this->_layout['js'], [
                '{id}' => $value->id,
                '{categoryId}' => $value->categoryId,
            ]);
        }

        $this->htm = strtr($this->_layout['group'], [
            '{cards}' => $cards,
        ]);


    }
}
