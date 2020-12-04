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
use zetsoft\widgets\market\ZSVGWidget;


/**
 *
 *
 * Created By: Shahzod Gulomqodirov
 * Refactored By: Shahzod Gulomqodirov
 *
 * https://www.figma.com/file/phwYNQp2ce9O6Kd9dMrReU/ProductCard?node-id=0%3A1
 */

class ZHorizontalWidgetUMiD extends ZWidget
{
    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        
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
       <div class="card mb-3">
    <div class="row no-gutters">
        <div class="col-md-4 d-flex align-items-center">
            <img src="https://images.pexels.com/photos/461198/pexels-photo-461198.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" class="card-img img-fluid"  alt="...">
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title fe-16">{name} &nbsp; 200г</h5>
                <div class="d-flex justify-content-between">
                    <div class="text-success">{isHave} <span class="text-muted">art:1434234</span>
                        <div class="d-flex mt-3">
                        <div>  
                                {logosvg}
                        </div>
                            <div class"resp-margin">
                                {rate}
                                <p class="text-center text-muted">(2 отзыва)</p>
                            </div>
                        </div>
                        <div class="d-flex card-text align-items-center mt-2">
                            <a role="button" class="heart" href="#" onclick="add_wish_list({product_id}, $(this))"><i class="far fa-heart grey-text {wishActive} pr-1 ml-2 mb-3 h4"></i></a>
                            <p class="ml-2">Избранное</p>
                            <a href="#" role="button" onclick="add_compare_list({product_id}, $(this),false)"><i class="fa fa-chart-bar {compareActive} grey-text pr-1 ml-4 mb-2 h4"></i></a>
                            <p class="ml-2">Сравнить</p>
                        </div>

                    </div>
                    <div class="">
                        <div class="text-center text-success card-title fe-20">{price}</div>
                        <div class="text-center text-muted fe-16">{currency} за 1шт</div>
                        <div class="col-12">
                            {add_cart}
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>
</div>
          
HTML,

        'add_cart'=><<<HTML
            <button class="btn btn-success addtocard" id="addtocard-{id}"><i class=""></i>Добавить в корзину</button>
            <div class="inputhide " id="inputhide-{id}">       
                 <div class="d-flex">
                      {input_amount} {basket_clear}
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
    $('.clear-add').on("click", function() {
         $('#inputhide-{id}').removeClass('d-flex');
         $('#inputhide-{id}').hide();
         $('#addtocard-{id}').show();
    });
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
           
          
          
          

CSS,

    ];

    /**
     *
     * Constants
     */


    public function asset()
    {
                  
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
            '{basket_clear}'=> ZSVGWidget::widget([
                'config' => [
                    'type' => 'basket_delete',
                    ]
                ]),
            '{input_amount}' => ZKTouchSpinWidget::widget([
                'name' =>$item->name,
                'config' => [
                    'id' =>$item->id,
                    'hintText' => '',
                    'step' =>$item->measureStep,
                    'buttonup_txt' => '<i class="fa fa-plus bg-wight"></i>',
                    'buttondown_txt' => '<i class="fa fa-minus "></i>',
                    'buttonup_class' => 'btn btn-success p-2',
                    'buttondown_class' => 'btn btn-success p-2',
                    'class' => 'text-center btn-lg clear-add-btn',
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
            '{sale_name}' => count($item->price_old) > 1 ? Az::l("Sale") : '',
            '{cardImage650x700}' =>$item->images[0],
            '{sale}' => '50',
            '{title}' =>$item->title,
            '{review}' => '2 sfvsfdgv',
            '{price}' => '162.000'/*ZArrayHelper::getValue($item->price, 0)*/,
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
                ]
            ]),
            '{logosvg}'=> ZSVGWidget::widget([
                'config' => [
                    'type' => ZSVGWidget::type['top_sell']
                ]
            ]),
            '{wishActive}' => $wish ? 'text-danger' : '',
            '{product_id}' =>$item->id,

            '{compareActive}' => $compare ? 'text-success' : '',
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


        $this->htm .= strtr($this->_layout['main'], [
            '{lists}' =>$lists,
        ]);
    }
}
