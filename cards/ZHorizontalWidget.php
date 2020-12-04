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

use zetsoft\models\drag\DragForm;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\inputes\ZKStarRatingWidget;
use zetsoft\widgets\inputes\ZKTouchSpinWidget;
use zetsoft\widgets\market\ZStarDobtcoWidget;


/**
 *
 *
 * Created By: Shahzod Gulomqodirov
 * Refactored By: Shahzod Gulomqodirov
 *
 * https://www.figma.com/file/phwYNQp2ce9O6Kd9dMrReU/ProductCard?node-id=0%3A1
 */

class ZHorizontalWidget extends ZWidget
{
    /**
     * Configuration
     */
    public $config = [];
    public $_config = [

    /*'src' => 'https://images.pexels.com/photos/376464/pexels-photo-376464.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500',

    'icon'=> 'https://www.iconpacks.net/icons/1/free-certificate-icon-1356-thumb.png',
    'price'=>'',
    'review'=> '',
    'name'=>'',
    'isHave'=>'',
    'currency'=> '',
    'add_card'=>'',
    'image'=>'https://c7.hotpng.com/preview/194/1006/470/dashboard-laptop-logo-business-plecto-laptop.jpg'*/


        'sale_name' => 'Sale',
        'cardImage650x700' => '/render/market/XeMart - Ecommerce Template/html/images/tab-1.png',
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
            {lists}
HTML,

        'list' => <<<HTML
       <div class="col-md-10 offset-md-1 zlist" id="{id}">
            <div class="row d-flex shadow-lg pt-2 mt-5 pb-2 rounded">
                                   
                 <div class="col-md-4 p-1 resp-photo-mob resp-card-size">
                    <!--<img width="auto" height="204px" src="{cardImage650x700}"  alt="">
                    -->
                    
                    <div class="mini-card--image--all-horizontal" id="mini-card--image-horizontal-{id}">
                    
                    <!--<img class="w-100 h-50" src="{image}">-->
                    
                   </div>
                </div>
                 
                 <div class="col-md-8">
                            <div class="row text-center wrap pl-3">
                                <h2 class="ml-5 resp-text">{name}</h2>
                                <h2 class="ml-5 resp-text">200г</h2>
                            </div>
                            <div class="row w-50 mt-3 ml-5">
                                  <p class="text-success fz-16">{isHave}</p>
                                  <p class="ml-4 text-black-50">art:1434234</p>
                            </div>
                            <div class="row mt-2">
                                <div class="d-flex col-md-12">

                                     <div class="col-md-6 d-flex p-0">
                                      
                                            <img width="20%"  height="60%" src="/render/market/ZGlotrCardWidget/medal_new.svg"/>
                                       
                                         
                                         <div class"resp-margin">
                                             {rate}
                                             <p class="ml-4">(2 отзыва)</p>
                                         </div>

                                     </div>

                                     <div class="col-md-5 ml-auto ">
                                          <h2 class="text-success text-center summary resp-text mb-1">{price}</h2>
                                          <h3 class="text-center text-black-50 fp-22 pb-n4 summary resp-text">{currency} за 1шт</h3>
                                     </div>

                                </div>
                </div>
                           
                 <div class="col-md-12">
                                <div class="row">
                                    <div class="d-flex align-items-center col-md-6">
                                        <i class="far fa-heart grey-text fa-2x pr-2 ml-2 resp-text"></i>
                                        <p class="ml-1 resp-text">избраннoе</p>
                                        <i class="fa fa-chart-bar grey-text fa-2x pr-2 ml-5 resp-text"></i>
                                        <p class="ml-1 resp-text">сравнить</p>
                                    </div>
                                    <div class="col-md-6 w-100 ml-auto">
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
            <button class="w-100 border border-0 bg-success p-2 rounded text-white fz-20 addtocard" id="addtocard-{id}"><i class=""></i>Добавить в корзину</button>
            <div class="inputhide" id="inputhide-{id}">       
                 <div class="d-flex">
                      {input_amount}
                      <button class="clearcard btn p-1" id="clearcard-{id}">
                           <i class="fas fa-backspace fa-3x"></i>
                      </button>
                 </div>
            </div>
HTML,

        'js' => <<<JS
       $("#inputhide-{id}").hide();
    if ($('#addtocard-{id}').is(':visible')) {
          $('#addtocard-{id}').click(function () {
              $('#addtocard-{id}').hide();
              $('#inputhide-{id}').addClass('d-flex');
              console.log($('#inputhide-{id}'));
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
        
          
           .mini-card--image--all-horizontal{
            background-position: center center;
            background-size:  contain;
            background-repeat:  no-repeat;
            width: 100%;
            height: 200px;
          }
          #mini-card--image-horizontal-_id_{
            background-image: url("_image_");
          }
          .card-title-horizontal{
            white-space: nowrap; 
                  width: 100%; 
                  overflow: hidden;
                  text-overflow: ellipsis; 

           
          }

CSS,

    ];

    /**
     *
     * Constants
     */


    public function asset()
    {

        $this->fileCss('https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300&display=swap" rel="stylesheet');
        $this->fileCss('https://fonts.googleapis.com/css2?family=Righteous&display=swap');
        $this->fileCss('/render/market/ZHorizontalWidget/asset/style.css');
    }

    public function codes()
    {
        $lists = '';
        $item=$this->model;
       /* $items = Az::$app->market->product->allProducts(35);
        foreach($items as $value){
          $addCartBtn = '';
          $addCartBtn.=strtr($this->_layout['add_card'],[
             '{id}'=>$value->id,
             '{input_amount}'=>ZKTouchSpinWidget::widget([
                'name'=> $value->name,
                'config'=>[
                    'id'=>$value->id,
                    'hintText' =>'',
                    'step' => $value->measureStep,
                    'buttonup_txt' => '<i class="fa fa-plus"></i>',
                    'buttondown_txt' => '<i class="fa fa-minus"></i>',
                    'buttonup_class' => 'btn btn-success p-2',
                    'buttondown_class' => 'btn btn-success p-2',
                    'class' => 'text-center btn-lg',
                ],
             ]),
          ]);


          

        }
         $this->htm=strtr($this->_layout['main'],[
            '{lists}'=>$lists
      ]);*/

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
            '{id}'=>$item->id,
            '{name}'=>$item->name,
            /*'{sale_name}' => \Dash\Curry\count($item->price_old) > 1 ? Az::l("Sale") : '',*/
            //'{cardImage650x700}' =>$item->images[0],
            '{sale}' => '50',
            '{title}' =>$item->title,
            '{review}' => '2 sfvsfdgv',
            '{price}' =>ZArrayHelper::getValue($item->price, 0),
            /*'{price_old}' => \Dash\Curry\count($item->price_old) > 1 ?$item->price_old[0]: '',*/
            '{currency}' =>$item->currency,
            /*'{sale_price}' => \Dash\Curry\count($item->price_old) > 1 ?$item->price_old[0] -$item->price[0] : '',*/
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
                ]
            ]),
            '{active}' => $wish ? 'text-danger' : '',
            '{product_id}' =>$item->id,
            '{compareActive}' => $compare ? 'text-success' : '',
        ]);

        $this->css .= strtr($this->_layout['css'], [
            '_id_'=>$item->id,
            //'_image_'=>$item->images[0]
        ]);

        $this->js .= strtr($this->_layout['js'], [
            '{id}' => $item->id,
            '{categoryId}' => $item->id,
            '{val}'=>$item->cart_amount
        ]);


        $this->htm .= strtr($this->_layout['main'], [
            '{lists}' =>$lists
        ]);



        /* $this->htm.=strtr($this->_layout['list'],[
             '{review}'=>$this->_config['review'],
             '{src}'=>$this->_config['src'],
             '{name}'=>$this->_config['name'],
             '{price}'=>$this->_config['price'],
             '{isHave}'=>$this->_config['isHave'],
             '{currency}'=>$this->_config['currency'],
             '{add_card}'=>$this->_config['add_card'],
             '{image}'=>$this->_config['image'],
             '{rate}' => ZStarDobtcoWidget::widget([
                 'data' => $items,
                 'config' => [
                     'quantity' => 5,
                     'placeholder' => '',
                     'icon' => 'fas fa-star resp-text',
                     'class' => '',
                 ]
             ]),

         ]);*/

        /*$this->js .= strtr($this->_layout['js'], [
            '{id}' => $this->id,
            '{categoryId}' => $this->id,

        ]);*/
    }
}
