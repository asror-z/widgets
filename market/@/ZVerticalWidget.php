<?php

/*
 * Created By: Xakimjon Ergashov
 * */

namespace zetsoft\widgets\market;


use rmrevin\yii\fontawesome\FA;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\inputes\ZKTouchSpinWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use \Dash\Curry;

class ZVerticalWidget extends ZWidget

{

    public $config = [];
    public $_config = [
        'name' => 'Hello!!!',
        'price' => '100',
        'price_old' => '70',
        'title' => 'ZMarketCardsWidget Title',
        'cardImage100x100' => '/render/market/XeMart - Ecommerce Template/html/images/tab-1.png',
        'cardImage650x700' => '/render/market/XeMart - Ecommerce Template/html/images/tab-1.png',
        'categoryName' => 'Smart LEd',
        'isSale' => 'd-none',
        'button' => false,
        'isAdd'=>true,
    ];

    public const type=[
        'col'=>'col',
        'list'=>'list',
        'grid'=>'grid'
    ];


    /*
     * Events
     * */
    public $event = [];
    public $_event = [

    ];

    /*
     * Constants
     * */


    /*
     * Layouts
     * */
    public $layout = [];
    public $_layout = [
         //main


        'list'=><<<HTML
        <div class="col-md-12 zlist" id="{id}">
            <div class="d-flex horizontal-card p-4">
                                   
                 <div class="col-md-4 p-1">
                    <img width="auto" height="250px" src="{cardImage650x700}"  alt="">
                </div>
                

                        <div class="col-md-8">
                            <div class="row text-center">
                                <h2 class="mt-3 ml-3 texts">{name}</h2>
                                <h2 class="mt-3 ml-5 texts">200г</h2>
                            </div>
                            <div class="row w-50 mt-3 ml-1">
                                  <p class="text-success fz-16">{isHave}</p>
                                <p class="ml-4 text-black-50">art:1434234</p>
                            </div>
                            <div class="row mt-2">
                                <div class="d-flex col-md-12">

                                     <div class="col-md-6 d-flex p-0">
                                      
                                            <img width="20%" height="60%" src="/render/market/ZGlotrCardWidget/medal_new.svg"/>
                                       
                                         
                                         <div class="pb-5">
                                             {rate}
                                             <p class="ml-4">(2 отзыва)</p>
                                         </div>




                                     </div>

                                     <div class="col-md-5 ml-auto ">
                                          <h2 class="text-success text-center summary ">{price}</h2>
                                          <h3 class="text-center text-black-50 fz-22 summary">{currency} за 1шт</h3>
                                     </div>

                                </div>

                            </div>
                            
                            <div class="row col-md-12 horizontal-card-bottom position-absolute left-0 mb-3">
                                <div class="d-flex align-items-center col-md-6">
                                    <i class="far fa-heart grey-text fa-2x pr-2 ml-2"></i>
                                    <p class="ml-2 fz-14">избранние</p>
                                    <i class="fa fa-chart-bar grey-text fa-2x pr-2 ml-5"></i>
                                    <p class="ml-2 fz-14">сравнить</p>
                                </div>
                                <div class="col-md-5 w-100 ml-auto mb-2">
                                     <!--<button class="btn btn-success w-100 fs-1x">Добавит в корзину
                                     -->
                                     {add_cart}
                                </div>
                            </div>
                        </div>
                    </div>
</div>

HTML,

         'add_cart'=><<<HTML
        <button class="w-100 border border-0 bg-success p-2 rounded text-white fz-20 addtocard" id="addtocard-{id}"><i class="" ></i>Добавить в корзину</button>
        <div class="inputhide" id="inputhide-{id}">       
             <div class="d-flex">
                  {input_amount}
                  <button class="clearcard btn p-1" id="clearcard-{id}">
                       <i class="fas fa-backspace fa-3x" ></i>
                  </button>
             </div>
        </div>
HTML,

        'js'=><<<JS
       $("#inputhide-{id}").hide();
    if ($('#addtocard-{id}').is(':visible')) {
          $('#addtocard-{id}').click(function () {
              $('#addtocard-{id}').hide();
              $('#inputhide-{id}').addClass('d-flex');
              console.log($('#inputhide-{id}'))
              $('#inputhide-{id}').show();
              $('#inputhide-{id}').val('1');
              $('#w2').val('1');
              $.ajax({
                  url: '/shop/core/product/setToCart.aspx',
                  method: 'GET',
                  data: {
                      catalog_id: {categoryId},
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
    }
    $('#clearcard-{id}').click(function () {
          $('#addtocard-{id}').show();
          $('#inputhide-{id}').removeClass('d-flex');
          $('#inputhide-{id}').hide();
          $('#w2').val('1')
      });

JS,
    ];


    public function codes()
    {

        $button_text = '';
        /* if ($this->_config['type'] === self::type['main']) $button_text = Az::l("Add To Cart");*/
        if ($this->model->id !== null)
            $addCart = ZButtonWidget::widget([
                'config' => [
                    'class'=>'w-100 border rounded-0 border-0 p-2 bg-success m-0 text-white',
                    'hasIcon' => true,
                    'icon' => 'fa fa-' . FA::_SHOPPING_CART,
                    'text' => $button_text,
                    'btnIconSize' => ZButtonWidget::btnScale['2.5'],
                    'ajax' => true,
                    'url' => ZUrl::to("/core/product/addToCart.aspx"),
                    'data' => '{product_id:' . $this->model->id . '}'

                    //todo:  // xato bervotti tuzatib keyin ulela!!!!
                ],
                'event' => [
                    'complete' => "function(data , textStatus , jqXHR){
                     console.log(data['responseText']);
                     $('#cart_total_amount').html(data['responseText']);
                }"
                ]
            ]);

        if (\Dash\count($this->model->properties) == 0) $addCart = '';
        $min = Curry\min($this->model->price);
        $max = Curry\max($this->model->price);
        $minOld = Curry\min($this->model->price_old);
        $maxOld = Curry\max($this->model->price_old);

        if ($min !== $max)
            $price = Curry\min($this->model->price) . ' - ' . Curry\max($this->model->price);
        else
            $price = $min;
        $price_old = '';
        $isSale = '';
        $isEmptyCurrency = 'd-none';
        if (!empty($this->model->price_old) && $this->model->price_old !== null) {
            if ($minOld !== $maxOld)
                $price_old = $minOld . ' - ' . $maxOld;
            else {
                $price_old = $minOld;
                $isSale = '';
            }
        } else {
            $this->model->currency = '';
            $isEmptyCurrency = '';
        }
        $sale = null;
        if(!empty($minOld))
            $sale = ($minOld-$min)*100/$minOld;
        

        if (empty($this->model->price_old)) {
            $isSale = 'd-none';
        }

        $defaultImage = ZArrayHelper::getValue($this->model->images, 0);
        if (empty($defaultImage)) {
            $defaultImage = 'https://c7.hotpng.com/preview/194/1006/470/dashboard-laptop-logo-business-plecto-laptop.jpg';
        }

        //$this->_config['button']=true;

        $p_id = $this->model->id;
        $button = '';
        if ($this->_config['button'])
            $button = strtr($this->_layout['addButton'], [
                '{addButton}' => ZKTouchSpinWidget::widget([
                    'value' => $this->model->cart_amount,
                    'name' => $this->model->name,
                    'config' => [
                        'min' => 0,
                        'max' => 10000,
                        'step' => 1,
                        'buttonup_txt' => '<i class="fa fa-plus"></i>',
                        'buttondown_txt' => '<i class="fa fa-minus"></i>',
                        'buttonup_class' => 'btn btn-success',
                        'buttondown_class' => 'btn btn-success',
                        'class' => 'touchSpins'
                    ],
                    'event' => [
                        'startupspin' => <<<JS
                function () {
                var amount = $(this).val();
                   $.ajax({
                      url: '/shop/core/product/setToCart.aspx',
                      data: {
                            catalog_id: $p_id,
                            amount: amount,
                      },
                      success: function(data) {
                        $('#cart_total_amount').html(data);
                      }
                      
                   })
                }
JS,
                    ]
                ]),
            ]);

        $description = '';
        if ($this->model->properties != null) {
            $button = '';
            $description .= strtr($this->_layout['description'], [
                '{description}' => $this->model->title
            ]);
        }

        $categoryId=$this->model->categoryId;

        $addCartBtn ='';

        $items = Az::$app->forms->modelz->data();
        $addCartBtn .=strtr($this->_layout['add_cart'],[
            '{id}'=>$p_id,
            '{input_amount}'=>ZKTouchSpinWidget::widget([
               'name'=> $this->model->name,
               'config'=>[
                   'id'=>$p_id,
                   'hintText' => '',
                   'step' => $this->model->measureStep,
                   'buttonup_txt' => '<i class="fa fa-plus"></i>',
                   'buttondown_txt' => '<i class="fa fa-minus"></i>',
                   'buttonup_class' => 'btn btn-success',
                   'buttondown_class' => 'btn btn-success',
                   'class' => 'text-center btn-lg',
               ],
               'event' => [
                   'startupspin' => <<<JS
                                    function() {
                        let amount = $("#touchCount-"+$p_id).val();
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
                                            let amountMinus = $("#touchCount-"+$p_id).val();
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
               ]])
        ]);

        $list=strtr($this->_layout['list'],[
            '{id}' => $this->id,
            '{name}' => $this->model->name,
            '{price}' => $price,
            '{title}' =>$this->model->title,
            '{isHave}'=>Az::l('В наличии'),
            '{cardImage650x700}' => $defaultImage,
            '{currency}' => $this->model->currency,
            '{isSale}' => $isSale,
            '{product_id}' => $this->model->id,
            '{button}' => $addCart,
            '{url}' => $this->model->url,
            '{add_cart}'=>$this->_config['isAdd']?$addCartBtn:null,
            /*'{rate}' =>ZKStarRatingWidget::widget([
                'name' => $this->model->name,
                'config' => [
                    'show' => false,
                    'size' => 'xs',
                    'class' => 'pl-0'
                ]
            ]),*/

            '{rate}' => ZStarDobtcoWidget::widget([
                'data' => $items,
                'config' => [
                    'quantity' => 5,
                    'placeholder' => '',
                    'icon' => 'fas fa-star',
                    'class' => '',
                ]
            ]),
        ]);

        
        
        $this->css .=<<<CSS
    .iconhover:hover{
        color: green!important;
    }
    .cardborder{
        border: green 2px solid!important;
        border-radius: 2%!important;
    }
    .summary {
        font-family: 'Righteous', cursive;
    }
   .horizontal-card {
           
            margin-top: 10px;
            position: relative;
            height: 75%;
            /*border: 2px solid limegreen;*/
            border-radius: 5px;
            box-shadow: -1px 0px 15px -2px rgba(173, 170, 170, 0.55);
          
        }
    .rating-container .clear-rating{
        padding: 0!important;
    }
CSS;


        $this->htm .= strtr($this->_layout['main'],[

            '{lists}'=>$list
        ]);
        $this->js.=strtr($this->_layout['js'],[ 
            '{id}'=>$this->model->id,
            '{categoryId}'=>$p_id
        ]);


    }
}

