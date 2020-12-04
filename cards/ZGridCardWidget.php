<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\cards;


use zetsoft\system\Az;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\inputes\ZKTouchSpinWidget;
use zetsoft\widgets\market\ZStarDobtcoWidget;



/**
 * Class    ZGridCardWidget
 * @package zetsoft\widgets\cards
 *
 * https://www.figma.com/file/phwYNQp2ce9O6Kd9dMrReU/ProductCard?node-id=0%3A1
 */
class ZGridCardWidget extends ZWidget
{
    public $config = [];
    public $_config = [
        'sale_name' => 'Sale',
        'sale' => '50',
        'title' => 'Samsung A78',
        'review' => '2 sfvsfdgv',
        'price' => '200',
        'price_old' => '70',
        'currency' => '$',
        'sale_price' => '123213',
        'isHave' => 'В наличии',
        'isAdd' => true
    ];

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
        {cols}

HTML,

        'col' => <<<HTML

  <div class="col-md-12 zcol " id="{id}">
            <!-- Card -->
  <div class="card mb-4 p-2">

    <!--Card image-->
    <div class="view overlay">
    <a>
   <!--   <img class="card-img-top" src="{cardImage650x700}" style="width: 400px; height: 300px"
        alt="Card image cap">-->
         <div class="mini-card--image--all-vertical" id="mini-card--image-vertical-{id}">
                    <!--<img class="w-100 h-50" src="{image}">-->
                   </div>
      <span style="right: 15px" class="counter position-absolute mt-5 p-2 "><h5>{sale} %</h5></span>
             
          </a>
             <img class="position-absolute" style="left: 6%; top: 3%; transform: scale(1.1) rotate(-45deg);" width="45px" height="45px" src="/render/market/ZGlotrCardWidget/medal_new.svg" alt="">
            
    </div>

    <!--Card content-->
    <div class="card-body">

      <!--Title-->
      
      <div class="card-title">
      <div class="row align-items-center">
      <div class="col-md-7 text-left p-0">
                    <div class="h4 card-title-vertical">{title}</div>
                </div>
      <div class="col-md-5 text-right p-0 ">
                    <a class="text-muted iconhover pr-3 h4" onclick="add_wish_list({product_id}, $(this),true)"><i class="fa fa-heart {active}"></i></a>
                    <a class="text-muted iconhover h4" onclick="add_compare_list({product_id},$(this),true)"><i class="fa fa-chart-bar"></i></a>
       </div>
      </div>
      
       
      <!--Text-->
      <div class="card-text">
        <div class="row">
        <div class="col-md-12 pl-0 d-flex justify-content-between">
                <span class="text-left text-success h5 py-2 ">{isHave}</span>
                <span class="font-weight-bold text-left text-black-50 py-2 "></span>
            </div>     
        <div class="col-md-12 d-flex justify-content-between mr-0 pl-0 pr-0">
                    <div class="col-6 pl-0 text-left">
                    {rate}
</div>
                    <div class="col-6 text-right pr-0">
                    <span class="h6">{review}</span>
</div>
                </div>
        <div class="d-flex justify-content-between">
                <div class="">
                    <h4 class="font-weight-bold text-left indigo-text py-2  text-success">{price} {currency}/ {measure}.</h4>
                    <!-- Text -->
                    <p class="card-text text-left h5"><strike>{price_old}</strike>
                        <a href="#" class="deep-orange-text">
                            {sale_name}: <b>{sale_price} {currency}</b>
                        </a>
                    </p>
                </div>               
            </div>
            </div>
      </div>
     
      
      
    </div>
    <!-- Card footer -->
    <div class="p-2 text-muted text-center p-0">

            {add_cart}
            
    </div>

  </div>
  <!-- Card -->

</div>

</div>
            
HTML,

        'add_cart' => <<<HTML
        <button class="w-100 border border-0 bg-success  p-3  pl-4 pr-4 rounded text-white addtocard" id="addtocard-{id}" style="display: {showBtn}"><h6>Добавить в корзину</h6></button>
        <div class="inputhide" id="inputhide-{id}" style="display: {showInput}">       
             <div class="d-flex">
                  {input_amount}
                  <a class="clearcard py-1" id="clearcard-{id}">
                       <i class="far fa-times-circle fa-2x mt-1"></i>
                  </a>
             </div>
        </div>
        
        HTML,
        'js' => <<<JS
   
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
        'css' => <<<CSS
        
          
           .mini-card--image--all-vertical{
            background-position: center center;
            background-size:  contain;
            background-repeat:  no-repeat;
            width: 100%;
            height: 200px;
          }
          #mini-card--image-vertical-_id_{
            background-image: url("_image_");
          }
          .card-title-vertical{
            white-space: nowrap; 
  width: 100%; 
  overflow: hidden;
  text-overflow: ellipsis; 

           
          }

CSS,

    ];

    public function asset()
    {

    }

    public function codes()
    {



        $cols = '';
        $item=$this->model;

        /*foreach ($this->model as $item) { */
             
            $items = Az::$app->forms->modelz->data();
            $compare = Az::$app->market->product->inCompare($item->id);
            $wish = Az::$app->market->product->inWish($item->id);
            $addCartBtn = '';
            $addCartBtn .= strtr($this->_layout['add_cart'], [
                '{id}' =>$item->id,
                '{input_amount}' => ZKTouchSpinWidget::widget([
                    'name' =>$item->name,
                    'config' => [
                        'id' =>$item->id,
                        'hintText' => '',
                        'step' =>$item->measureStep,
                        'buttonup_txt' => '<i class="fa fa-plus"></i>',
                        'buttondown_txt' => '<i class="fa fa-minus"></i>',
                        'buttonup_class' => 'btn btn-success p-2',
                        'buttondown_class' => 'btn btn-success p-2',
                        'class' => 'text-center btn-lg',
                        'decimals' => '1',

                    ],
                    'event' => [
                        'startupspin' => <<<JS
                                    function() {
                        let amount =$('#inputhide-'+$item->id+' input').val();
                                       $.ajax({
                                          url: '/shop/core/product/setToCart.aspx',
                                          method: 'GET',
                                          data: {
                                              catalog_id:'$item->id',
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
                                            let amountMinus = $('#inputhide-'+$item->id+' input').val();
                                            $.ajax({
                                          url: '/shop/core/product/setToCart.aspx',
                                          method: 'GET',
                                          data: {
                                              catalog_id:$item->id,
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
                    ]
                ]),
                '{showInput}' =>$item->cart_amount !== null ? 'block' : 'none',
                '{showBtn}' =>$item->cart_amount !== null ? 'none' : 'block',
                '{isNull}' =>$item->cart_amount !== null ? false : true
            ]);

            $cols .= strtr($this->_layout['col'], [
                '{id}'=>$item->id,
                '{name}'=>$item->name,
                '{sale_name}' => count($item->price_old) > 1 ? Az::l("Sale") : '',
                '{cardImage650x700}' =>$item->images[0],
                '{sale}' => '50',
                '{title}' =>$item->title,
                '{review}' => '2 sfvsfdgv',
                '{price}' =>$item->price[0],
                '{price_old}' => count($item->price_old) > 1 ?$item->price_old[0]: '',
                '{currency}' =>$item->currency,
                '{sale_price}' => count($item->price_old) > 1 ?$item->price_old[0] -$item->price[0] : '',
                '{isHave}' => 'В наличии',
                '{isAdd}' => $this->_config['isAdd'],
                '{add_cart}' => $this->_config['isAdd'] ? $addCartBtn : null,
                '{rate}' => ZStarDobtcoWidget::widget([
                    'data' => $items,
                    'config' => [
                        'quantity' => 5,
                        'placeholder' => '',
                        'icon' => 'fas fa-star',
                        'class' => '',
                        'rating' => $this->model->rating,
                    ]
                ]),
                '{active}' => $wish ? 'text-danger' : '',
                '{product_id}' =>$item->id,
                '{compareActive}' => $compare ? 'text-success' : '',
                '{measure}' => $this->model->measure,

            ]);

            $this->css .= strtr($this->_layout['css'], [
               '_id_'=>$item->id,
               '_image_'=>$item->images[0]
            ]);

            $this->js .= strtr($this->_layout['js'], [
                '{id}' => $item->id,
                '{categoryId}' => $item->id,
                '{val}'=>$item->cart_amount
            ]);



        /*}*/

        /*$this->htm .= strtr($this->_layout['cols'], [
            '{sale_name}' => $this->_config['sale_name'],
            '{cardImage650x700}' => $this->_config['cardImage650x700'],
            '{sale}' => $this->_config['sale'],
            '{title}' => $this->_config['title'],
            '{review}' => $this->_config['review'],
            '{price}' => $this->_config['price'],
            '{price_old}' => $this->_config['price_old'],
            '{currency}' => $this->_config['currency'],
            '{sale_price}' => $this->_config['sale_price'],
            '{isHave}' => $this->_config['isHave'],
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
            '{active}' => $wish ? 'text-danger' : '',
            '{product_id}' =>$item[0]->id,
            '{compareActive}' => $compare ? 'text-success' : '',
        ]);*/
        
        $this->htm .= strtr($this->_layout['main'], [
            '{cols}' => $cols
        ]);

        

    }
}
