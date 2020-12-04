<?php

/*
 * Created By: Xakimjon Ergashov
 * */

namespace zetsoft\widgets\cards;


use rmrevin\yii\fontawesome\FA;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\inputes\ZKStarRatingWidget;
use zetsoft\widgets\inputes\ZKTouchSpinWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use \Dash\Curry;

class ZMarketCardsOnlyWidget3 extends ZWidget

{

    public $config = [];
    public $_config = [
        'name' => 'Hello!!!',
        'type' => ZMarketCardsOnlyWidget3::type['col'],
        'price' => '100',
        'price_old' => '70',
        'title' => 'ZMarketCardsWidget Title',
        'cardImage100x100' => '/render/market/XeMart - Ecommerce Template/html/images/tab-1.png',
        'cardImage650x700' => '/render/market/XeMart - Ecommerce Template/html/images/tab-1.png',
        'categoryName' => 'Smart LEd',
        'isSale' => 'd-none',
        'button' => false,
        'isAdd' => true,
    ];

    public const type = [
        'col' => 'col',
        'list' => 'list',
        'grid' => 'grid'
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
        'commonCard' => <<<HTML
            <div class="card overflow-hidden card-cascade mt-3" id="{id}">
                <div class="row ml-0">
                    <div class="col-md-3 z-card-img view view-cascade overlay border border-light">
                     
                        <img class="card-img-top img-fluid" src="{cardImage650x700}" alt="">
                    
                    <a href="{url}">
                        <div class="mask rgba-white-slight"></div>
                    </a>
                </div>
                    <div class="card-body pl-5 z-card-content col-md-5 card-body-cascade text-center">
                  
                    <div class="d-block">
                    <ul class="list-unstyled list-inline cate">
                        <li class="list-inline-item"><a href="{categoryUrl}">{categoryName}</a></li>
                        <li class="list-inline-item"><a href="#"></a></li>
                    </ul>
                    <a href="{url}" class="card-title">{name}</a>
                    
                    <span class="{isSale} badge badge-danger p-2 d-inline alig-items-end w-25">Sale</span>
                     {rate}
                    <ul class="list-unstyled list-inline price text-right mt-4">
                        <li class="list-inline-item badge badge-primary"><h6>{currency}{price}</h6></li>
                        <li class="list-inline-item"><del>{currency}{price_old}</del></li>
                    </ul>
</div>
<p class="text-muted text-truncate pl-3">{title}</p>
                </div>
                  
                    <div class="z-card-btns col-md-4 card-footer text-muted text-center d-flex p-0">
                            {button}
                            <button onclick="add_wish_list({product_id})" class="w-100 border border-0 p-2 bg-danger text-white" data-toggle="tooltip" data-placement="top" title="" data-original-title="Favourite">
                                <i class="fas fa-heart text-white"></i>
                            </button>
                             <button onclick="add_compare_list({product_id})" class="w-100 border border-0 p-2 bg-dark text-white" data-toggle="tooltip" data-placement="top" title="" data-original-title="Compare">
                                <i class="fa 
                             fa-random text-white" aria-hidden="true"></i>
                             </button>
                               </div>
                        </div>
                    </div>
                </div>
            </div>
HTML,

        'addButton' => <<<HTML
                  {addButton}
HTML,

        'description' => <<<HTML
                  {description}
HTML,
        //commonCard
        'col' => <<<HTML
            <div class="col-12 tab-item zcol h-100" id="{id}">

            <!-- Card Regular -->
                <div class="card h-100 card-cascade rounded-lg position-relative overflow-hidden">

        <!-- Card image -->

        <div class="m-1 text-center height="100px">
            <a href="{url}">
            <img width="auto" class="card-img-top mx-100" style=" height: 200px; width: auto" src="{cardImage650x700}" alt="Card image cap">
             
            <span style="right: 15px" class="counter position-absolute mt-5">{sale} %</span>
             
            </a>

               
        </div>
            <img class="position-absolute" style="left: 6%; top: 3%; transform: scale(1.1) rotate(-45deg);" width="35px" height="35px" src="/render/market/ZGlotrCardWidget/medal_new.svg" alt="">
        <!-- Card content -->
        <div class="card-body card-body-cascade text-center p-3">

            <!-- Title -->
            <h4 class=" d-flex">
                <div class="col-7 text-left p-0 mw-100">
                    <a href="{url}">
                        <strong class="">{title}</strong>
                    </a>
                </div>
                <div class="col-5 text-right p-0">
                    <a class="text-muted iconhover pr-3 i-wish" onclick="add_wish_list({product_id}, $(this))"><i class="fa fa-heart {active}"></i></a>
                    <a class="text-muted iconhover" onclick="add_compare_list({product_id}, $(this))">
                        <i class="fa fa-chart-bar {compareActive}"></i>
                    </a>
                </div>
            </h4>
            
             <div class="d-flex justify-content-between">
                <span class="text-left text-left text-success py-2">{isHave}</span>
                <span class="font-weight-bold text-left text-black-50 py-2"></span>
            </div>
            
             <div class="d-flex justify-content-between mr-0">
                    <div class="col-6 pl-0 text-left">
                    {rate}
</div>
                    <div class="col-6 text-right">
                    <span class="small">(2 отзыва)</span>
</div>
                </div>
            <!-- Subtitle -->
            
            <div class="d-flex justify-content-between">
                <div class="">
                    <h6 class="font-weight-bold text-left indigo-text py-2 text-danger">{price} {currency}/ шт.</h6>
                    <!-- Text -->
                    <p class="card-text text-left"><strike>{price_old}</strike>
                        <a href="#" class="deep-orange-text">
                            Скидка: <b>{sale_price} {currency}</b>
                        </a>
                    </p>
                </div>               
            </div>
           
        </div>

        <!-- Card footer -->
        <div class="px-4 pb-4 text-muted text-center p-0">

            {add_cart}
            
        </div>

    </div>
            <!-- Card Regular -->

            </div>
HTML,

        'list' => <<<HTML
        <div class="col-md-12 zlist" id="{id}">
            <div class="d-flex horizontal-card p-4">
                                   
                 <div class="col-md-4 p-1">
                    <img width="auto" height="250px" src="{cardImage650x700}"  alt="">
                </div>
                

                        <div class="col-md-8">
                            <div class="row text-center">
                                <h2 class="mt-1 ml-3 texts">{name}</h2>
                                <h2 class="mt-1 ml-5 texts">200г</h2>
                            </div>
                            <div class="row w-50 ml-1">
                                  <p class="text-success">{isHave}</p>
                                <p class="ml-4 text-black-50">art:1434234</p>
                            </div>
                            <div class="row mt-2">
                                <div class="d-flex col-md-12">

                                     <div class="col-md-6 d-flex p-0">
                                      
                                            <img width="20%" height="60%" src="/render/market/ZGlotrCardWidget/medal_new.svg"/>
                                       
                                         
                                         <div class="">
                                             {rate}
                                             <p class="ml-4">(2 отзыва)</p>
                                         </div>




                                     </div>

                                     <div class="col-md-5 ml-auto">
                                          <h2 class="text-success text-center summary ">{price}</h2>
                                          <h3 class="text-center text-black-50 summary">{currency} за 1шт</h3>
                                     </div>

                                </div>

                            </div>
                            
                            <div class="row col-md-12 horizontal-card-bottom position-absolute left-0 mb-3">
                                <div class="d-flex align-items-center col-md-6">
                                    <i class="far fa-heart grey-text fa-2x pr-2 ml-2"></i>
                                    <p class="ml-2">избранние</p>
                                    <i class="fa fa-chart-bar grey-text fa-2x pr-2 ml-5"></i>
                                    <p class="ml-2">сравнить</p>
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

        'main' => <<<HTML
            {cols}
            {lists}
HTML,

        'add_cart'=><<<HTML
        <button class="w-100 border border-0 bg-success p-2 rounded text-white fz-20 addtocard" id="addtocard-{id}" style="display: {showBtn}">Добавить в корзину</button>
        <div class="inputhide" id="inputhide-{id}" style="display: {showInput}">       
             <div class="d-flex">
                  {input_amount}
                  <a class="clearcard py-1" id="clearcard-{id}">
                       <i class="far fa-times-circle text-danger fa-2x mt-1" ></i>
                  </a>
             </div>
        </div>
HTML,

+
        'js'=><<<JS
   
    $('#inputhide-{id} input').val('{val}')
    
    

    if ($('#addtocard-{id}').is(':visible')) {
          $('#addtocard-{id}').click(function () {
              $('#addtocard-{id}').hide();
              $('#inputhide-{id}').addClass('d-flex');
              console.log($('#inputhide-{id}'))
              $('#inputhide-{id}').show();
             $('#inputhide-{id} input').val('1');
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
          let backspace = $('#inputhide-{id} input').val();
          $.ajax({
              url: '/shop/core/product/setToCart.aspx',
              method: 'GET',
              data: {
                  catalog_id: '{id}',
                  amount: 0,
              },
              success: function (data) {
                  $('#cart_total_amount').html(data);
                  console.log(data)
              },
              error: function (error) {
                  console.log(error);
              }
          })
      });

JS,
    ];


    public function codes()
    {

        $button_text = '';
        /* if ($this->_config['type'] === self::type['main']) $button_text = Az::l("Add To Cart");*/
        if ($this->model->id !== null) {
            $addCart = ZButtonWidget::widget([
                'config' => [
                    'class' => 'w-100 border rounded-0 border-0 p-2 bg-success m-0 text-white',
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

        }

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
        if (!empty($minOld))
            $sale = ($minOld - $min) * 100 / $minOld;


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
                        'step' => 2,
                        'buttonup_txt' => '<i class="fa fa-plus p-0"></i>',
                        'buttondown_txt' => '<i class="fa fa-minus p-0"></i>',
                        'buttonup_class' => 'btn btn-success p-1',
                        'buttondown_class' => 'btn btn-success p-1',
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

        $categoryId = $this->model->categoryId;

        $addCartBtn = '';

        $items = Az::$app->forms->modelz->data();
        $addCartBtn .= strtr($this->_layout['add_cart'], [
            '{id}' => $p_id,
            '{input_amount}' => ZKTouchSpinWidget::widget([
                'name' => $this->model->name,
                'config' => [
                    'id' => $p_id,
                    'hintText' => '',
                    'step' => $this->model->measureStep,
                    'buttonup_txt' => '<i class="fa fa-plus"></i>',
                    'buttondown_txt' => '<i class="fa fa-minus"></i>',
                    'buttonup_class' => 'btn btn-success py-2 px-3',
                    'buttondown_class' => 'btn btn-success py-2 px-3',
                    'class' => 'text-center btn mb-2',
                ],
                'event' => [
                    'startupspin' => <<<JS
                                    function() {
                        let amount =$('#inputhide-'+$p_id+' input').val();
                                       $.ajax({
                                          url: '/shop/core/product/setToCart.aspx',
                                          method: 'GET',
                                          data: {
                                              catalog_id: $p_id,
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
                    'startdownspin' => <<<JS
                             function() {
                                            let amountMinus = $('#inputhide-'+$p_id+' input').val();
                                            $.ajax({
                                          url: '/shop/core/product/setToCart.aspx',
                                          method: 'GET',
                                          data: {
                                              catalog_id: $p_id,
                                              amount: amountMinus!==1?amountMinus--:amountMinus,
                                          },
                                          success: function (data) {
                                              $('#cart_total_amount').html(data);
                                              console.log(data)
                                          },
                                          error: function (error) {
                                             console.log(error);
                                          }
                                      })  
                                        
                                        }
JS,
               ]]),
            '{showInput}'=>$this->model->cart_amount!==null?'block':'none',
            '{showBtn}'=>$this->model->cart_amount!==null?'none':'block',
            '{isNull}'=>$this->model->cart_amount!==null?false:true
        ]);

        $wish = Az::$app->market->product->inWish($this->model->id);
        $compare = Az::$app->market->product->inCompare($this->model->id);

        /*$col = strtr($this->_layout['col'], [
            '{id}' => $this->id,
            '{name}' => $this->model->name,
            '{price}' => $price,
            '{title}' => $this->model->title,
            '{isHave}' => Az::l('В наличии'),
            '{price_old}' => $price_old,
            '{cardImage100x100}' => $defaultImage,
            '{cardImage650x700}' => $defaultImage,
            '{currency}' => $this->model->currency,
            '{product_id}' => $this->model->id,
            '{button}' => $addCart,
            '{description}' => $description,
            '{isEmptyCurrency}' => $isEmptyCurrency,
            '{url}' => $this->model->url,
            '{active}' => $wish ? 'text-danger' : '',
            '{compareActive}' => $compare ? 'text-success' : '',
            '{sale_price}' => ($minOld - $min),
            '{sale}' => (int)$sale,
            '{add_cart}' => $this->_config['isAdd'] ? $addCartBtn : null,

            '{rate}' => ZStarDobtcoWidget::widget([
                'data' => $items,
                'config' => [
                    'quantity' => 5,
                    'placeholder' => '',
                    'icon' => 'fas fa-star',
                    'class' => '',
                    'disabled' => true,
                ]
            ]),

        ]);

        $list = strtr($this->_layout['list'], [
            '{id}' => $this->id,
            '{name}' => $this->model->name,
            '{price}' => $price,
            '{title}' => $this->model->title,
            '{isHave}' => Az::l('В наличии'),
            '{cardImage650x700}' => $defaultImage,
            '{currency}' => $this->model->currency,
            '{isSale}' => $isSale,
            '{product_id}' => $this->model->id,
            '{button}' => $addCart,
            '{url}' => $this->model->url,
            '{add_cart}' => $this->_config['isAdd'] ? $addCartBtn : null,
            '{rate}' => ZStarDobtcoWidget::widget([
                'data' => $items,
                'config' => [
                    'quantity' => 5,
                    'placeholder' => '',
                    'icon' => 'fas fa-star',
                    'class' => '',
                ]
            ]),
        ]);*/


        $this->css .= <<<CSS
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

        $col=ZGridCardWidget::widget([
            'model'=>$this->model
        ]);

        $list=ZHorizontalWidget::widget([
            'model'=>$this->model
        ]);

        /*$this->htm .= strtr($this->_layout['main'], [
            '{cols}' => $col,
            '{lists}' => $list
        ]);*/



        $this->htm .= strtr($this->_layout['main'], [
            '{cols}' => $col,
            '{lists}' => $list
        ]);

        $this->js .= strtr($this->_layout['js'], [
            '{id}' => $this->model->id,
            '{categoryId}' => $p_id,
            '{val}'=>$this->model->cart_amount
        ]);

    }
}

