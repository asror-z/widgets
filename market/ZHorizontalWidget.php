<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\market;

use zetsoft\models\drag\DragForm;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\inputes\ZKStarRatingWidget;
use zetsoft\widgets\inputes\ZKTouchSpinWidget;

/**
 *
 * Class ZXeContactsWidget
 *
 * Created By: Shahzod Gulomqodirov
 */

class ZHorizontalWidget extends ZWidget
{
    /**
     * Configuration
     */
    public $config = [];
    public $_config = [

    'img' => 'https://images.pexels.com/photos/376464/pexels-photo-376464.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500',

    'icon'=> 'https://www.iconpacks.net/icons/1/free-certificate-icon-1356-thumb.png',

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
                    <!--<img src="https://images.pexels.com/photos/376464/pexels-photo-376464.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" class="resp-photo w-100" alt="">-->
                    <div class="mini-card--image--all-vertical" id="mini-card--image-vertical-{id}">
                    <!--<img class="w-100 h-50" src="{image}">-->
                   </div>

                </div>
                

                        <div class="col-md-8 container">
                            <div class="container row text-center wrap">
                                <h2 class="ml-5 resp-text">{name}</h2>
                                <h2 class="ml-5 resp-text">200г</h2>
                                <p class="text-success ml-4 resp-text wrap">{isHave}</p>
                                <p class="ml-4 text-black-50 resp-text mt-1 wrap">art:1434234</p>
                            </div>
                            <div class="row w-50 ml-1">
                                  
                            </div>
                            <div class="row mt-2">
                                <div class="d-flex col-md-12">

                                     <div class="col-md-6 d-flex p-0 resp-text">
                                      
                                            <img width="20%" height="60%" src="/render/market/ZGlotrCardWidget/medal_new.svg"/>
                                       
                                         
                                         <div class"resp-margin resp-text">
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

        'add_card'=><<<HTML
            <button class="w-100 border border-0 bg-success py-2 rounded text-white resp-text addtocard" id="addtocard-{id}"><i class=""></i>Добавить в корзину</button>
            <div class="inputhide" id="inputhide-{id}">       
                 <div class="d-flex">
                      {input_amount}
                      <button class="clearcard btn p-1" id="clearcard-{id}">
                           <i class="fas fa-backspace fa-2x"></i>
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

        'css'=><<<CSS
        
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
        $items = Az::$app->market->product->allProducts(35);      
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
          $lists.=strtr($this->_layout['list'],[
              '{id}' => $value->id,
              '{name}' => $value->name,
             /* '{price}' => $price,*/
              '{title}' =>$value->title,
              '{isHave}'=>Az::l('В наличии'),
        /*      '{cardImage650x700}' => $defaultImage,*/
              '{currency}' => $value->currency,
           /*   '{isSale}' => $isSale,*/
              '{product_id}' => $value->id,
    /*          '{button}' => $addCart,*/
              '{url}' => $value->url,
              '{add_card}'=>$addCartBtn,
              /*'{rate}' =>ZKStarRatingWidget::widget([
                  'name' => $value->name,
                  'config' => [
                      'show' => false,
                      'size' => 'xs',
                      'class' => 'pl-0'
                  ]
              ]),
              ]);*/
              
              '{rate}' => ZStarDobtcoWidget::widget([
                  'data' => $items,
                  'config' => [
                      'quantity' => 5,
                      'placeholder' => '',
                      'icon' => '', //ishlamadi
                      'class' => '',
                  ]
              ]),
          ]);

            $this->js .= strtr($this->_layout['js'], [
                '{id}' => $value->id,
                '{categoryId}' => $value->id,
            ]);
            $this->css .= strtr($this->_layout['css'], [
                '_id_'=>$value->id,
                '_image_'=>$value->images[0]
            ]);


        }


        $this->htm=strtr($this->_layout['main'],[
            '{lists}'=>$lists
      ]);


    }
}
