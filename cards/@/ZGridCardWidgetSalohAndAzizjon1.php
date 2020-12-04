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
use function Spatie\SslCertificate\length;


class ZGridCardWidgetSalohAndAzizjon1 extends ZWidget
{
    public $config = [];
    public $_config = [

    'img' => 'https://images.pexels.com/photos/376464/pexels-photo-376464.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500',

    'icon'=> 'https://www.iconpacks.net/icons/1/free-certificate-icon-1356-thumb.png',
        'isHave' => 'В наличии',
        'isAdd' => true,

    ];


    /**
     *
     * Plugin Events
     * https://select2.org/programmatic-control/events
     */
    public $event = [];
    public $_event = [

    ];

    public $layout = [];
    public $_layout = [

        'main'=><<<HTML
            {lists},
HTML,

        'list' => <<<HTML
       <div class="container col-md-11 zlist" id="{id}">
            <div class="d-flex shadow-lg pt-2 mt-5 rounded">
                                   
                 <div class="col-md-4 p-1 resp-photo-mob resp-card-size">
<!--
                    <img width="auto" height="250px" src="{cardImage650x700}"  alt="">
-->
                    <img src="https://images.pexels.com/photos/376464/pexels-photo-376464.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" class="resp-photo w-100" alt="">

                </div>
                

                        <div class="col-md-8">
                            <div class="container row text-center wrap">
                                <h2 class="ml-5 resp-text">{name}</h2>
                                <h2 class="ml-5 resp-text">200г</h2>
                                <p class="text-success ml-4 resp-text">{isHave}</p>
                                <p class="ml-4 text-black-50 resp-text mt-1">art:1434234</p>
                            </div>
                            <div class="row w-50 mt-1">
                                  <p class="text-success fz-16">{isHave}</p>
                                <p class="ml-4 text-black-50">art:1434234</p>
                            </div>
                            <div class="row mt-2">
                                <div class="d-flex list-md-12">

                                     <div class="col-md-6 d-flex p-0">
                                      
                                            <img width="20%" height="60%" src="/render/market/ZGlotrCardWidget/medal_new.svg"/>
                                       
                                         
                                         <div class"resp-margin">
                                             {rate}
                                             <p class="ml-4">(2 отзыва)</p>
                                         </div>




                                     </div>

                                     <div class="col-md-5 ml-auto ">
                                          <h2 class="text-success text-center summary resp-text">{price}</h2>
                                          <h3 class="text-center text-black-50 fp-22 pb-n4 summary resp-text">{currency} за 1шт</h3>
                                     </div>

                                </div>

                            </div>
                            
                            <div class="row col-md-12">
                                <div class="d-flex align-items-center col-md-6">
                                    <i class="far fa-heart grey-text pr-1 ml-2 resp-text"></i>
                                    <p class="ml-1 resp-text">избраннoе</p>
                                    <i class="fa fa-chart-bar grey-text pr-1 ml-4 resp-text"></i>
                                    <p class="ml-1 resp-text">сравнить</p>
                                </div>
                                <div class="col-md-5 ml-auto mb-2 resp-btn ">
                                     <!--<button class="btn btn-success w-100 fs-1x">Добавить в корзину
                                     -->
                                     {add_card}
                                </div>
                            </div>
                        </div>
                    </div>
</div>

          
HTML,

        'add_card' => <<<HTML
        <button class="w-100 border border-0 bg-success  p-3  pl-4 pr-4 rounded text-white addtocard" id="addtocard-{id}" style="display: {showBtn}"><h6 class="pl-4 pr-4">Добавить в корзину</h6></button>
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
        
          .mini-card--image--all{
            width: 100px;
            height: 100px;
          }
          
           .mini-card--image--main, .mini-card--image--all{
            background-position: center center;
            background-size:  cover;
            background-repeat:  no-repeat;
            border-radius: 10px;
          }
          
          .mini-card--image--main{
            width: 85px;
            height: 85px;
          }
          
          #mini-card--image-_name_{
            background-image: url("https://images.pexels.com/photos/1624487/pexels-photo-1624487.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940");
          }

CSS,

    ];

    public function asset()
    {
        $this->fileCss('https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300&display=swap" rel="stylesheet');
        $this->fileCss('https://fonts.googleapis.com/css2?family=Righteous&display=swap');
        $this->fileCss('/render/market/ZHorizontalWidget/asset/style.css');
    }

    public function codes()
    {



        $lists = '';

        foreach ($this->model as $item) {
             
            $items = Az::$app->forms->modelz->data();
            $compare = Az::$app->market->product->inCompare($item->id);
            $wish = Az::$app->market->product->inWish($item->id);
            $addCartBtn = '';
            $addCartBtn .= strtr($this->_layout['add_card'], [
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
                    ],
                    'event' => [
                        'startupspin' => <<<JS
                                    function() {
                        let amount =$('#inputhide-'+$item->id+' input').val();
                                       $.ajax({
                                          url: '/shop/core/product/setToCart.aspx',
                                          method: 'GET',
                                          data: {
                                              catalog_id:$item->id,
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

            $lists .= strtr($this->_layout['list'], [
                '{sale_name}' => count($item->price_old) > 1 ? Az::l("Скидка") : '',
                '{cardImage650x700}' =>$item->images[0],
                '{sale}' => '50',
                '{title}' =>$item->title,
                '{review}' => '2 sfvsfdgv',
                '{price}' =>$item->price[0],
                '{price_old}' => count($item->price_old) > 1 ?$item->price_old[0]: '',
                '{currency}' =>$item->currency,
                '{sale_price}' => count($item->price_old) > 1 ?$item->price_old[0] -$item->price[0] : '',
                '{isHave}' => 'В наличии',
                '{isAdd}' => true,
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
                '{product_id}' =>$item->id,
                '{compareActive}' => $compare ? 'text-success' : '',
            ]);





        }
        /*$this->htm .= strtr($this->_layout['lists'], [
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
            '{lists}' => $lists
        ]);
        $this->js .= strtr($this->_layout['js'], [

        ]);

    }
}
