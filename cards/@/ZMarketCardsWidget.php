<?php

/*
 * Created By: Xakimjon Ergashov
 * */

namespace zetsoft\widgets\cards;


use PhpOffice\PhpWord\Reader\HTML;
use rmrevin\yii\fontawesome\FA;
use zetsoft\dbitem\shop\ProductItem;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\former\ZAjaxWidget;
use zetsoft\widgets\inputes\ZKStarRatingWidget;
use zetsoft\widgets\inputes\ZKTouchSpinWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use \Dash\Curry;

class ZMarketCardsWidget extends Zwidget
{
    public $config = [];
    public $_config = [
        'type' => self::type['featureVertical'],
        'name' => 'Hello!!!',
        /*'currency' => '$',*/
        'price' => '100',
        'price_old' => '70',
        'title' => 'ZMarketCardsWidget Title',
        'cardImage100x100' => '/render/market/XeMart - Ecommerce Template/html/images/tab-1.png',
        'cardImage650x700' => '/render/market/XeMart - Ecommerce Template/html/images/tab-1.png',
        'categoryName' => 'SMart LEd',
        'isSale' => 'd-none',
        'button' => false,

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
    public const type = [
        'featureHorizontal' => 'featureHorizontal',
        'featureVertical' => 'featureVertical',
        'bestDeals' => 'bestDeals',
        'counterCard' => 'counterCard',
        'vertical' => 'vertical'
    ];


    /*
     * Layouts
     * */
    public $layout = [];
    public $_layout = [

        'featureVertical' => <<<HTML
            <div class="tab-item2 h-100 mt-3 pt-3" id="{id}">
                <div class="tab-img">
                    <a href="{url}">
                        <img class="main-img img-fluid pl-4" src="{cardImage650x700}" alt="">
                    </a>
                    <span class="sale {isSale}">Sale</span>
                </div>
                <div class="item-heading d-flex justify-content-between pl-5">
                    <div class="item-top">
                        <ul class="list-unstyled list-inline cate">
                            <li class="list-inline-item"><a href="{categoryUrl}">{categoryName}</a></li>
                            <li class="list-inline-item"><a href="#"></a></li>
                        </ul>
                        <p><a href="{url}">{name}</a></p>
                        <ul class="list-unstyled list-inline fav">
                            <li class="list-inline-item"><i class="fa fa-star"></i></li>
                            <li class="list-inline-item"><i class="fa fa-star"></i></li>
                            <li class="list-inline-item"><i class="fa fa-star"></i></li>
                            <li class="list-inline-item"><i class="fa fa-star"></i></li>
                            <li class="list-inline-item"><i class="fa fa-star-o"></i></li>
                        </ul>
                    </div>
                    <div class="item-price">
                        <ul class="list-unstyled list-inline price">
                            <li class="list-inline-item">{currency}{price}</li>
                            <li class="list-inline-item">{currency}{price_old}</li>
                        </ul>
                    </div>
                </div>
                <div class="item-content pl-5">
                    <p class="paragraph">{title}</p>
                    {button}
                    <div class="fav-btn my-2 position-absolute">
                  
                        <div class="">
                           <button onclick="add_wish_list({product_id})" class="it-fav btn btn-success text-white" data-toggle="tooltip" data-placement="top" title="" data-original-title="Favourite"><i class="fas fa-heart"></i></button>
                        <button onclick="add_compare_list({product_id})" class="it-comp btn btn-success text-white" data-toggle="tooltip" data-placement="top" title="" data-original-title="Compare"><i class="fa fa-random" aria-hidden="true"></i></button>
                        </div>
                        
                    </div>
                </div>
            </div>
HTML,

        'vertical' => <<<HTML
           <!-- Card -->
<div class="card w-25 d-flex">

  <!-- Card image -->
  <div class="view overlay">
    <img class="card-img-top" src="https://mdbootstrap.com/img/Photos/Others/food.jpg" alt="Card image cap">
    <a>
      <div class="mask rgba-white-slight"></div>
    </a>
  </div>

  <!-- Button -->
  <a class="btn-floating btn-action ml-auto mr-4 mdb-color lighten-3"><i
      class="fas fa-chevron-right pl-1"></i></a>

  <!-- Card content -->
  <div class="card-body">

    <!-- Title -->
    <h4 class="card-title">Card title</h4>
    <hr>
    <!-- Text -->
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's
      content.</p>

  </div>

  <!-- Card footer -->
  <div class="rounded-bottom mdb-color lighten-3 text-center pt-3">
    <ul class="list-unstyled list-inline font-small">
      <li class="list-inline-item pr-2 white-text"><i class="far fa-clock pr-1"></i>05/10/2015</li>
      <li class="list-inline-item pr-2"><a href="#" class="white-text"><i
            class="far fa-comments pr-1"></i>12</a></li>
      <li class="list-inline-item pr-2"><a href="#" class="white-text"><i class="fab fa-facebook-f pr-1">
          </i>21</a></li>
      <li class="list-inline-item"><a href="#" class="white-text"><i class="fab fa-twitter pr-1"> </i>5</a></li>
    </ul>
  </div>

</div>
<!-- Card -->
HTML,

        'featureUniversal' => <<<HTML
        <div class="tab-item w-50" id="{id}">
            <div class="tab-img">
            <a href="{url}">
                <img class="main-img img-fluid" src="{cardImage650x700}" alt="">
            </a>
                <div class="layer-box">
                    <button onclick="add_compare_list({product_id})" class="it-comp" data-toggle="tooltip" data-placement="left" title="Compare"><i class="fas fa-random"></i></button>
                    <button onclick="add_wish_list({product_id})" id="add_wish_list"   class="it-fav" data-toggle="tooltip" data-placement="left" title="Favourite"><i class="fas fa-heart"></i></button>
                </div>         
                <span class="sale {isSale}">Sale</span>
            </div>
            <div class="tab-heading">
                <p class="pl-3"><a href="{url}">{name}</a></p>
            </div>
            <div class="img-content d-flex justify-content-between">
                <div>
                    <ul class="list-unstyled list-inline fav">
                        <li class="list-inline-item"><i class="fa fa-star"></i></li>
                        <li class="list-inline-item"><i class="fa fa-star"></i></li>
                        <li class="list-inline-item"><i class="fa fa-star"></i></li>
                        <li class="list-inline-item"><i class="fa fa-star"></i></li>
                        <li class="list-inline-item"><i class="fa fa-star-o"></i></li>
                    </ul>
                    <ul class="list-unstyled list-inline price">
                        <li class="list-inline-item">{currency}{price}</li>
                        <li class="list-inline-item {isEmptyCurrency}">{currency}{price_old}</li>
                    </ul>
                </div>
                <div>
                  
                 
                </div>
            </div>
        </div>
HTML,

        'featureHorizontal' => <<<HTML
<div class="row">
      <div class="col-md-12">
       <div class="tab-item2" id="{id}">
               <div class="row">
                   <div class="col-lg-4 col-md-12">
                       <div class="tab-img">
                           <a href="{url}">
                               <img class="main-img img-fluid" src="{cardImage650x700}" alt="">
                           </a>    
                           <span class="sale {isSale}">Sale</span>
                       </div>
                   </div>
                   <div class="col-lg-8 col-md-12">
                       <div class="item-heading d-flex justify-content-between">
                           <div class="item-top">
                               <ul class="list-unstyled list-inline cate">
                                   <li class="list-inline-item"><a href="{categoryUrl}">{categoryName}</a></li>
                               </ul>
                               <p><a href="{url}">{name}</a></p>
                           </div>
                           <div class="item-price">
                               <ul class="list-unstyled list-inline price">
                                   <li class="list-inline-item">{currency}{price}</li>
                                   <li class="list-inline-item {isEmptyCurrency}">{currency}{price_old}</li>
                               </ul>
                           </div>
                       </div>
                       <div class="item-content">
                           <p>{title}</p> 
                           <button onclick="add_wish_list({product_id})" class="it-fav btn btn-rounded" style="background: white;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Favourite" id="add_wish_list"><i class="far fa-heart"></i></button>
                           <button onclick=""  id="add_wish_list"  class="it-comp btn btn-rounded" style="background: white; data-toggle="tooltip" 
                            data-placement="top" title="" 
                            data-original-title="Compare" >
                                <i class="fas fa-random"></i>
                            </button>
                            {button}
                       </div>
                   </div>
               </div>
           </div>
           
</div>
</div>
                                          
HTML,

        'bestDeals' => <<<HTML
          <div class="row">
   
           <div class="col-md-12">
           
           <div class="row">
           
           <div class="col-md-4">
            <div class="bt-img">
               <a href="{url}"><img src="{cardImage100x100}" alt=""></a>
                </div>
</div>

            <div class="col-md-8">
                 <div class="bt-content">
                          <p><a href="{url}">{name}</a></p>
                                 <ul class="list-unstyled list-inline fav">
                                   <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                      <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                      <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                        <li class="list-inline-item"><i class="fa fa-star-o"></i></li>
                                          </ul>
                                             <ul class="list-unstyled list-inline price">
                                               <li class="list-inline-item">{currency}{price}</li>
                                      <li class="list-inline-item {isEmptyCurrency}">{currency}{price_old}</li>
                                  </ul>
                         </div>
            </div>
</div>
           
</div>
           
</div>
HTML,

        'counterCard' => <<<HTML
       <div class="tab-item w-50" id="{id}">   
           <div class="col-md-12 card-lb tab-img">
               <div class="card-lb-header ">
                   <!--<div class="card-lb-events">
                       <div class="term d-flex">
                           <i class="fas fa-leaf"></i>
                           <p>Срок 10дней</p>
                       </div>                        
                   </div>-->                       
                   <div class="card-lb-img">
                   <a href="{url}" >
                      <img src="{cardImage650x700}">
                   </a>
                       
                   </div>        
               </div>
               <div class="layer-box mt-3">
                   <span role="button" onclick="add_compare_list({product_id})" class="it-comp " data-toggle="tooltip" data-placement="left" title="Compare"><i class="fas fa-random"></i></span>
                   <span role="button"  data-elemid="{product_id}"  class="it-fav add_wish_list" data-toggle="tooltip" data-placement="left" title="Favourite"><i class="fas fa-heart "></i></span>
               </div>   
               <div class="card-lb-content">
                   <h3 class="text-sm">{name}</h3>
                   <div class=" card-lb-content--items">
                       <h3 class="card-lb-price">{currency}{price}</h3>
                       <h3 class="card-price-env">{currency}{price_old}</h3>
                   </div>
                       <h5 class="text-left text-dark mt-1"> Lorem ipsum dolor sit amet lorem ipsum dolor sit amet {description}</h5>
               </div>
               <div class="card-lb-footer">
                   <div class="ml-auto">
                       {button}
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

    ];

    public function asset()
    {
    //    $this->fileCss('/render/market/ZMarketCardsWidget/asset/css/main.css');
    }

    public function codes()
    {
        /*$str = $this->model->title;
        if (strlen($str) > 10)
            $str = substr($str, 0, 7) . '...';*/

        $button_text = '';
        if ($this->_config['type'] === self::type['featureVertical']) $button_text = Az::l("Add To Cart");
        //vd($this->model->id);


        if ($this->model->id !== null)
            $addCart = ZButtonWidget::widget([
                'config' => [
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

        if (empty($this->model->price_old)) {
            $isSale = 'd-none';
        }

        $defaultImage = ZArrayHelper::getValue($this->model->images, 0);
        if (empty($defaultImage)) {
            $defaultImage = 'https://c7.hotpng.com/preview/194/1006/470/dashboard-laptop-logo-business-plecto-laptop.jpg';
        }


        $p_id = $this->model->id;
        $button = '';
        if ($this->_config['button'])
            $button = strtr($this->_layout['addButton'], [
                '{addButton}' => ZKTouchSpinWidget::widget([
                    'value'=> $this->model->cart_amount,
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

        //vdd($this->model);

        $description = '';
        if ($this->model->properties != null) {
            $button = '';
            $description .= strtr($this->_layout['description'], [
                '{description}' => $this->model->title
            ]);
        }


        $this->htm = strtr($this->_layout[$this->_config['type']], [
            '{id}' => $this->id,
            '{name}' => $this->model->name,
            '{price}' => $price,
            '{price_old}' => $price_old,
            '{cardImage100x100}' => $defaultImage,
            '{cardImage650x700}' => $defaultImage,
            '{currency}' => $this->model->currency,
            '{title}' => $this->model->title,
            '{categoryName}' => $this->model->categoryName,
            '{isSale}' => $isSale,
            '{product_id}' => $this->model->id,
            '{button}' => $button,
            '{description}' => $description,
            '{isEmptyCurrency}' => $isEmptyCurrency,
            '{url}' => $this->model->url
        ]);

   

        /*
         * Css Code
         * */
        /*$this->css = $this->_layout['css'];*/
    }
}

