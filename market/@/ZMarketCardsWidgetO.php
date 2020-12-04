<?php

/*
 * Created By: Xakimjon Ergashov
 * */

namespace zetsoft\widgets\market;


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

class ZMarketCardsWidgetO extends Zwidget
{
    public $config = [];
    public $_config = [
        'type' => self::type['featureVertical'],
        'name' => 'Hello!!!',
        /*'currency' => '$',*/
        'price' => '100',
        'price_old' => '70',
        'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
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
        'click' => ' console.log("ZCartReviewWidget | $eventClick") ',
        'dblclick' => ' console.log("ZCartReviewWidget | $eventDblclick") ',
        'mouseenter' => ' console.log("ZCartReviewWidget | $eventMouseEnter") ',
        'mouseleave' => ' console.log("ZCartReviewWidget | $eventMouseLeave") ',
        'keyup' => ' console.log("ZCartReviewWidget | $eventKeyup") ',
        'onload' => 'console.log("ZCartReviewWidget | $eventOnLoad")',
        'onclick' => 'console.log("ZCartReviewWidget | $eventOnClick")',
    ];

    /*
     * Constants
     * */
    public const type = [
        'featureHorizontal' => 'featureHorizontal',
        'featureVertical' => 'featureVertical',
        'bestDeals' => 'bestDeals',
        'counterCard' => 'counterCard'
    ];


    /*
     * Layouts
     * */
    public $layout = [];
    public $_layout = [
        'featureVertical' => <<<HTML
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
                <p class="pl-3">
                    <a href="{url}">{name}</a>
                </p>
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
                  
                    <!--<a href="" data-toggle="tooltip" data-placement="top" title="Add to Cart"><img src="/render/market/XeMart - Ecommerce Template/html/images/it-cart.png" alt=""></a>-->
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
                       <div class="item-content">
                           <p>{title}</p>
                           {addCart}
                           <button onclick="add_compare_list({product_id})" class="it-fav btn btn-success" data-toggle="tooltip" data-placement="top" title="" data-original-title="Favourite"><img src="/render/market/@template/XeMart%20-%20Ecommerce%20Template/html/images/it-fav.png" alt=""></button>
                           <button onclick="add_wish_list({product_id})" class="it-comp btn btn-success" data-toggle="tooltip" data-placement="top" title="" data-original-title="Compare"><img src="/render/market/@template/XeMart%20-%20Ecommerce%20Template/html/images/it-comp.png" alt=""></button>
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
               <a href="#"><img src="{cardImage100x100}" alt=""></a>
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
                                      <li class="list-inline-item">{currency}{price_old}</li>
                                  </ul>
                         </div>
            </div>
</div>
           
</div>
           
</div>
HTML,


        'event' => <<<JS
             $('#{id}')
            .on('click', {click})
            .on('dblclick', {dblclick})
            .on('keyup', {keyup})
            .on('mouseenter', {mouseenter})
            .on('mouseleave', {mouseleave})
            .on('onload',{onload})
            .on('onclick',{onclick});
            
            

            
            
JS,

        'css' => <<<CSS

         .tab-item {
            overflow: hidden;
            border: 1px solid #0e0e0e;
            margin-bottom: 30px;
            width: 250px!important;
        }
        .tab-img {
            margin-bottom: 10px;
            position: relative;
        }
        .img-content {
            padding: 0 15px 10px;
            position: relative;
        }     
        .img-content ul.fav li i {
            font-size: 13px;
            color: #fdba2d;
        }
        .img-content a {
            background: #eeeeee;
            display: inline-block;
            padding: 10px 12px;
            border: 1px solid #dddddd;
            -webkit-border-radius: 50%;
            -moz-border-radius: 50%;
            -ms-border-radius: 50%;
            border-radius: 50%;
            margin-top: 8px;
        }
        .img-content a:hover{
            border-color: #e45151;
        }
        .img-content ul.price li {
            font-size: 18px;
            color: #444444;
            font-weight: 600;
            letter-spacing: 0;
        }
        /*.tab-item .tab-img {
            margin-bottom: 10px;
            position: relative;
        }*/
        
         .tab-item {
    overflow: hidden;
    border: 1px solid #eeeeee;
    margin-bottom: 30px;
}
        .tab-item:hover .tab-img .layer-box a {
            right: 0;
            visibility: visible;
            opacity: 1;
        } 
        .tab-item .tab-img .layer-box a {
            border: 1px solid #dddddd;
            padding: 5px 7px;
            -webkit-border-radius: 50%;
            -moz-border-radius: 50%;
            -ms-border-radius: 50%;
            border-radius: 50%;
            background: #fff;
            position: absolute;
            top: 0;
            right: -45px;
            margin-right: 10px;
            -webkit-transition: 0.3s ease;
            -moz-transition: 0.3s ease;
            -ms-transition: 0.3s ease;
            -o-transition: 0.3s ease;
            transition: 0.3s ease;
            z-index: 9;
            opacity: 0;
            visibility: hidden;
        } 
        .tab-item .tab-img .layer-box a.it-fav {
            margin-top: 15px;
            -webkit-transition-delay: 0.0s;
            -o-transition-delay: 0.0s;
            transition-delay: 0.0s;
        }
        .tab-item .tab-img .layer-box a.it-fav:hover {
            border-color: #e45151;
        }
        .tab-item .tab-img .layer-box a.it-comp {
            margin-top: 60px;
            -webkit-transition-delay: 0.0s;
            -o-transition-delay: 0.0s;
            transition-delay: 0.0s;
        }
        .tab-item .tab-img .layer-box a.it-comp:hover {
            border-color: #e45151;
        }
        .tab-item .img-content ul.price li:last-child {
            font-size: 14px;
            color: #969696;
            font-weight: normal;
            text-decoration: line-through;
        }
        
         ul.fav li {
    font-size: 13px;
    color: #fdba2d;
    margin-right: 0;
} 

.product-area .bt-deal .bt-body .bt-items .bt-box .bt-content ul.price li {
    color: #444444;
    font-weight: 600;
    margin-right: 0;
    letter-spacing: 0;
}

li:last-child {
    font-size: 13px;
    color: #969696;
    margin-left: 5px;
    font-weight: normal;
    text-decoration: line-through;
}

 a.it-comp:hover {
    border-color: #5677fc;
}

a.it-fav:hover {
    border-color: #5677fc;
}

 a.it-comp {
    border: 1px solid #dddddd;
    display: inline-block;
    padding: 7px 10px;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    -ms-border-radius: 50%;
    border-radius: 50%;
    margin-right: 8px;
}

 a.it-fav {
    border: 1px solid #dddddd;
    display: inline-block;
    padding: 7px 10px;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    -ms-border-radius: 50%;
    border-radius: 50%;
    margin-right: 8px;
}

.bt-img{
    max-width: 100px;
}
.tab-img{
    max-width: 230px;
}

 span.it-img {
    background: #fff;
    display: inline-block;
    padding: 7px 10px;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    -ms-border-radius: 50%;
    border-radius: 50%;
}

 a.it-cart {
    background: #eeeeee;
    display: inline-block;
    padding-right: 10px;
    border: 1px solid #dddddd;
    -webkit-border-radius: 30px;
    -moz-border-radius: 30px;
    -ms-border-radius: 30px;
    border-radius: 30px;
    margin-right: 8px;
}

a.it-cart:hover {
    border-color: #5677fc;
}
.tab-heading{
    width: 250px;
}
.img-content{
    width: 250px!important;
}
.tab-item2 {
    overflow: hidden;
    border: 1px solid #eeeeee;
    margin-bottom: 30px;
}

 .tab-item2 .item-heading .item-price ul.price li {
    font-size: 20px;
    color: #444444;
    font-weight: 600;
    letter-spacing: 0;
}

li:last-child {
    font-size: 15px!important;
    color: #969696;
    font-weight: normal!important;
    text-decoration: line-through!important;
}

 .tab-item2 .item-heading {
    padding-right: 30px;
    padding-top: 22px;
}
.tab-item2 .item-heading .item-top p a {
    font-size: 18px;
    color: #5677fc;
    font-weight: 600;
}
 .tab-item2 .item-content p {
    font-size: 15px;
    line-height: 26px;
    margin-bottom: 20px;
}
/*p, li, a, button {
    font-size: 14px;
    font-family: "Source Sans Pro", sans-serif;
    margin: 0;
    letter-spacing: 0.2px;
}*/

.tab-item .tab-heading p a {
    font-size: 16px;
    color: #5677fc;
    font-weight: 600;
}

.tab-img span.sale {
    font-size: 12px;
    color: #fff;
    font-weight: 600;
    background: #e45151;
    text-transform: uppercase;
    width: 42px;
    height: 42px;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    -ms-border-radius: 50%;
    border-radius: 50%;
    text-align: center;
    padding-top: 12px;
    position: absolute;
    top: 0;
    left: 0;
    z-index: 2;
    margin-left: 15px;
    margin-top: 15px;
}

CSS,

    ];

    public function asset()
    {
        $this->fileCss('/render/market/XeMart - Ecommerce Template/html/css/style.css');
        $this->fileCss('/render/market/XeMart - Ecommerce Template/html/css/assets/animate.css');
        $this->fileCss('/render/market/XeMart - Ecommerce Template/html/css/assets/owl.carousel.min.css');
        $this->fileJs('/render/market/XeMart - Ecommerce Template/html/js/custom.js');
    }

    public function codes()
    {
        /*$str = $this->model->title;
        if (strlen($str) > 10)
            $str = substr($str, 0, 7) . '...';*/

        $button_text = '';
        if ($this->_config['type'] === self::type['featureHorizontal']) $button_text = Az::l("Add To Cart");
        //vd($this->model->id);
        if ($this->model->id !== null)
            $addCart = ZButtonWidget::widget([
                'config' => [
                    'hasIcon' => true,
                    'icon' => 'fa fa-' . FA::_SHOPPING_CART,
                    'text' => $button_text,
                    //'type' => ZAjaxWidget::type['post'],
                    //'color' => ZColor::color['white']
                    /*'btnPaddingLeft' => ZButtonWidget::btnScale['0'],
                    'btnPaddingRight' => ZButtonWidget::btnScale['0'],
                    'btnPaddingTop' => ZButtonWidget::btnScale['0'],
                    'btnPaddingBottom' => ZButtonWidget::btnScale['0'],*/
                    'btnIconSize' => ZButtonWidget::btnScale['2.5'],
                    'ajax' => true,
                    'url' => ZUrl::to("/core/product/addToCart.aspx"),
                    'data' => '{product_id:' . $this->model->id . '}'
                ],
                'event' => [
                    'complete' => "function(data , textStatus , jqXHR){
                     console.log(data['responseText']);
                     $('#cart_total_amount').html(data['responseText']);
                }"
                ]
            ]);

        if (\Dash\count($this->model->properties) == 0) $addCart = '';
        /*vd($this->model->price);*/
        $min = Curry\min($this->model->price);
        $max = Curry\max($this->model->price);
        $minOld = Curry\min($this->model->price_old);
        $maxOld = Curry\max($this->model->price_old);
        if ($min !== $max)
            $price = Curry\min($this->model->price) . ' - ' . Curry\max($this->model->price);
        else
            $price = $min;
        $price_old = '';
        $isSale = 'd-none';
        if (!empty($this->model->price_old) && $this->model->price_old !== null) {
            if ($minOld !== $maxOld)
                $price_old = $minOld. ' - ' . $maxOld;
            else
                $price_old = $minOld;
            $isSale = '';
        }
        if (empty($this->model->price_old))
        {
            $isSale = 'd-none';
        }

        $this->htm = strtr($this->_layout[$this->_config['type']], [
            '{id}' => $this->id,
            '{name}' => $this->model->name,
            '{price}' => $price,
            '{raiting}' => ZKStarRatingWidget::widget([
                'name'=>'name',
            ]),
            '{price_old}' => $price_old,
            '{cardImage100x100}' => $this->model->images[0],
            '{cardImage650x700}' => $this->model->images[0],
            '{currency}' => $this->model->currency,
            '{title}' => $this->model->title,
            '{categoryName}' => $this->model->categoryName,
            '{isSale}' => $isSale,
            '{addCart}' => $addCart,
            '{product_id}' => $this->model->id,
        ]);

        /*
         * Events
         * */
        $this->js = strtr($this->_layout['event'], [
            '{id}' => $this->id,
            '{click}' => $this->eventCode('click'),
            '{keyup}' => $this->eventCode('keyup'),
            '{dblclick}' => $this->eventCode('dblclick'),
            '{mouseenter}' => $this->eventCode('mouseenter'),
            '{mouseleave}' => $this->eventCode('mouseleave'),
            //  '{options}' => $this->model->properties,
        ]);

        /*
         * Css Code
         * */
        $this->css = $this->_layout['css'];
    }
}

