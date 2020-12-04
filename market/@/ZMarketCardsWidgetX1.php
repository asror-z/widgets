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
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\former\ZAjaxWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use \Dash\Curry;

class ZMarketCardsWidgetX1 extends Zwidget
{
    public $config = [];
    public $_config = [
        'type' => self::type['featureVertical'],
        'name' => 'Hello!!!',
        'currency' => '$',
        'price' => '100',
        'price_old' => '70',
        'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
        'cardImage100x100' => '/render/market/XeMart - Ecommerce Template/html/images/tab-1.png',
        'cardImage650x700' => '/render/market/XeMart - Ecommerce Template/html/images/tab-1.png',
        'categoryName' => 'SMart LEd',
        'isSale' => 'd-none',
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
        <div class="tab-item/* w-25*/" id="{id}">
            <div class="tab-img">
                <img class="main-img img-fluid" src="{cardImage650x700}" alt="">
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
                    {addCart}
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
                           <img class="main-img img-fluid" src="{cardImage650x700}" alt="">
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
                                   <li class="list-inline-item {isEmptyCurrency}">{currency}{price_old}</li>
                               </ul>
                           </div>
                       </div>
                       <div class="item-content">
                           <p>{title}</p>
                           {addCart}
                           <button onclick="add_compare_list({product_id})" class="it-fav btn btn-success btn-rounded" data-toggle="tooltip" data-placement="top" title="" data-original-title="Favourite"><img src="/render/market/@template/XeMart%20-%20Ecommerce%20Template/html/images/it-fav.png" alt=""></button>
                           <button onclick="add_wish_list({product_id})" class="it-comp btn btn-success btn-rounded" data-toggle="tooltip" data-placement="top" title="" data-original-title="Compare"><img src="/render/market/@template/XeMart%20-%20Ecommerce%20Template/html/images/it-comp.png" alt=""></button>
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
                                      <li class="list-inline-item {isEmptyCurrency}">{currency}{price_old}</li>
                                  </ul>
                         </div>
            </div>
</div>
           
</div>
           
</div>
HTML,

        'counterCard' => <<<HTML
        <div class="d-flex">
        <div class="col-md-4">
            <div class="">
              <div class="col-md-12 card-lb">
                <div class="card-lb-header">
                    <img src="{cardImage650x700}" alt="">
                </div>
                <div class="card-lb-content">
                    <h3>{name}</h3>
                    <div class="d-flex card-lb-content--items">
                        <p class="card-lb-price">{currency}{price}</p>
                        <p class="card-price-env">UZS for 1pc</p>
                    </div>
                </div>
                <div class="card-lb-footer">
                    <button class="btn btn-outline-success card-lb-btn" id="{id}"><i class="fas fa-cart-arrow-down"></i>Add to card</button>
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

        'js' => <<<JS
            
    $('#card-lb-btn').hide();
    $('.card-lb').mouseleave(  function() {
        $('#card-lb-btn').hide();
    })

    $('.card-lb').mouseover( function() {
        $('#card-lb-btn').show();
    });

    let templ = "<div class='card-lb-counter d-flex' style='margin-left:10%'>" +
        "<button  type='button' disabled class='btn btn-success minCounters' style='opacity: 0.2; cursor: no-drop'" +
         "'>-</button>"+ "<div style='width: 50%; border: 1px solid lightgray' " +
          "class='counters'>1</div>" +"<button class='btn btn-success addCounter' type='button' '" +
           " '>+</button>"+
        "</div>";

    let shopIcon = "<i id='iconShop' class=\"fas fa-shopping-cart ml-auto\"></i>";

    let badge = "<div class='badge-counter' style='width: 50px; text-align: center; height: 50px;background-color:green; color: white; border-radius: 50%;position: absolute; top: 2%;right: 5%'>1</div>";




    let cardLengt = $('.card-lb').length;
    
    
    let butt = $('.card-lb-btn');
    butt.on('click', function () {
        counts = 0;
        
        let btn = $(this);
        let parent_s_header = null;
        let parent_s_footer = btn.parent('.card-lb-footer');
        parent_s_header = parent_s_footer.siblings('.card-lb-header');
        parent_s_header.append(badge);
        $(this).remove();
        parent_s_footer.html(templ);
        let url = "/render/market/LeBazar Card/counter.js";
        let url2 = "/render/market/LeBazar Card/counter2.js";
        $.ajax({
            url: url,
            method:'GET',
            success: function(response) {
              
            },
            error: function (event) {
              console.log(e);
            }
        });
        
        $.ajax({
            url: url2,
            method:'GET',
            success: function(response) {
              
            },
            error: function (event) {
              console.log(e);
            }
        });
      
    });
   
               
  
    




    /***** Shopping Cart *****/
    $('.cart-btn').on('click', function (event){
        e.preventDefault();
        $('.cart-overlay').addClass('visible');
        $('.cart-body').addClass('open');
    });
    $('.close-cart, .cart-overlay').on('click', function (event){
        e.preventDefault();
        $('.cart-overlay').removeClass('visible');
        $('.cart-body').removeClass('open');
    });







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
    text-decoration: none !important;
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

.card-lb {
    height: 400px;
    padding: 10px;
    border: 2px solid lightgray;
    position: relative;
    border-radius: 5px;
}

.card-lb-header {
    padding: 10px;
}

.card-lb-header img {
    width: 100%;
    height: 200px;
}

.card-lb-content {
    margin-top: 10px;
}

.card-lb-content h3{
    text-align: left;
    font-size: 18px;
}

.card-lb-price {
    text-align: left;
    color: green;
    font-size: 18px;
}

.card-price-env {
    text-align: left;
    margin-left: 5px;
    margin-top: 3px;
    font-size: 15px;
    color: gray;
}

.card-lb-footer {
    width: 100%;
    margin-top: 10px;
    text-align: center;
    display: flex;
    justify-content: center;
}
.card-lb-footer button{
    width: 90%!important;
    
}
.card-lb-footer .card-lb-counter  .btn-success {
    width: 45px!important;
    height: 45px!important;
}
.card-lb-footer button .fas{
    margin-right: 10px;
}
.card-lb-footer .card-lb-counter{
    margin: 0px!important;
}
.card-lb-footer .card-lb-counter div{
    padding: 10px!important;
    border-radius: 5px;
}
#badgeCounter {
    display: flex;
    justify-content: center;
    align-items: center;
}
.card-lb-content .fa-shopping-cart{
    color: red;
}





.logo-area2 {
    height: 125px;
    padding-top: 25px;
    border-bottom: 1px solid #e5e5e5;
}
.logo-area2 .carts-area {
    padding-top: 15px;
    padding-left: 70px;
}
.logo-area2 .carts-area .wsh-box {
    margin-right: 8px;
    padding-top: 5px;
    position: relative;
}


.logo-area2 .carts-area .cart-box {
    margin-right: 8px;
    padding-top: 5px;
    position: relative;

}

.logo-area2 .carts-area .cart-box a span {
    background-color: #e8104a;
    height: 1.75rem;
    width: 1.75rem;
    line-height: 1.75rem;
    color: #fff;
    border-radius: 100%;
    background-clip: padding-box;
    position: absolute;
    top: -21px;

    font-size: 16px;
    text-align: center;
    padding: 0;
}
/* =======================================
     Cart Body
   ======================================= */
.cart-body {
    background: #fff;
    width: 450px;
    position: fixed;
    top: 0;
    right: -450px;
    z-index: 99999;
    height: 100%;
    padding: 25px;
    -webkit-box-shadow: 0 3px 15px rgba(0, 0, 0, 0.1);
    box-shadow: 0 3px 15px rgba(0, 0, 0, 0.1);
    -webkit-transition: 0.3s ease;
    -moz-transition: 0.3s ease;
    -ms-transition: 0.3s ease;
    -o-transition: 0.3s ease;
    transition: 0.3s ease;

}
.cart-body .close-btn {

    border-bottom: .0625rem solid #eee;

    position: relative;
    background-color: #fff;



}
/* .cart-body {
     font-family: Roboto,Helvetica Neue,Helvetica,Arial,sans-serif;
     font-style: normal;
     color: inherit;
     text-rendering: optimizeLegibility;
     margin-top: 0;
     margin-bottom: .5rem;
     line-height: 1.4;

 }    */
.cart-body .close-btn .fa-times{
    margin-left: 250px;

}
.cart-body .close-btn button.close-cart img {
    max-width: 10px;
    margin-right: 8px;
    margin-top: -3px;
}
.cart-body .crt-bd-box {
    padding: 20px;
}
.cart-body .crt-bd-box .cart-heading h5 {

    font-family: Roboto,Helvetica Neue,Helvetica,Arial,sans-serif;
    font-style: normal;
    color: inherit;
    text-rendering: optimizeLegibility;
    margin-top: 0;
    margin-bottom: .5rem;
    line-height: 1.4;
}

/* .cart-body .crt-bd-box .cart-heading span{
     font-size: 13px;
     margin-left: 30px;
 color:#28a745 ;

 }         */
/*  .cart-body .crt-bd-box .cart-content {
       border-bottom: 1px solid #e5e5e5;
       margin-bottom: 40px;
   }
   .cart-body .crt-bd-box .cart-content .content-item {
       margin-bottom: 35px;
   }
   .cart-body .crt-bd-box .cart-content .content-item .cart-img a img {
       -webkit-border-radius: 3px;
       -moz-border-radius: 3px;
       -ms-border-radius: 3px;
       border-radius: 3px;
   }
   .cart-body .crt-bd-box .cart-content .content-item .cart-disc p a {
       font-size: 15px;
   }
   .cart-body .crt-bd-box .cart-content .content-item .cart-disc p a:hover {
       color: #5677fc;
   }
   .cart-body .crt-bd-box .cart-content .content-item .cart-disc span {
       font-size: 16px;
       color: #222222;
       font-weight: 600;
   }
   .cart-body .crt-bd-box .cart-content .content-item .delete-btn a i {
       color: #969696;
       margin-top: 15px;
   }
   .cart-body .crt-bd-box .cart-content .content-item .delete-btn a i:hover {
       color: #444444;
   }
   .cart-body .crt-bd-box .cart-btm p {
       font-size: 16px;
       text-transform: uppercase;
       margin-bottom: 50px;
   }
   .cart-body .crt-bd-box .cart-btm p span {
       font-size: 20px;
       color: #222222;
       font-weight: 600;
       margin-left: 10px;
   }
   .cart-body .crt-bd-box .cart-btm a {
       font-size: 16px;
       color: #fff;
       background: #5677fc;
       display: block;
       text-align: center;
       padding: 8px;
       text-transform: uppercase;
       -webkit-border-radius: 30px;
       -moz-border-radius: 30px;
       -ms-border-radius: 30px;
       border-radius: 30px;
   }
   .cart-body .crt-bd-box .cart-btm a:hover {
       background: #e45151;
   } */
.cart-body.open {
    right: 0;
}
.cart-overlay {
    position: fixed;
    left: 0;
    top: 0;
    height: 100%;
    width: 100%;
    display: block;
    background-color: rgba(0, 0, 0, 0.8);
    z-index: 99990;
    visibility: hidden;
    opacity: 0;
    -webkit-transition: 0.3s ease;
    -moz-transition: 0.3s ease;
    -ms-transition: 0.3s ease;
    -o-transition: 0.3s ease;
    transition: 0.3s ease;
}
.cart-overlay.visible {
    visibility: visible;
    opacity: 1;
}

.button{
    display: inline-block;
    text-align: center;
    line-height: 1;
    cursor: pointer;
    -webkit-appearance: none;
    transition: background-color .25s ease-out,color .25s ease-out;
    vertical-align: middle;
    border: 1px solid transparent;
    border-radius: 4px;
    padding: .85em 1em;
    margin: 0 0 1rem;
    font-size: .9rem;
    background-color: #28a745;
    color: #fff;
}
.button .cart-box a{
    vertical-align: middle;
    color: #fff;
    font-size: 20px;
    text-transform: capitalize;
    font-weight:bold;
}
.button .cart-box a:hover {
    text-decoration: none!important;
}





@media screen and (max-width: 74.9375em) {
    .swipe-cart .swipe-container .reveal-body {
        padding: .625rem .9375rem;
    }
}
.swipe-cart .swipe-container .reveal-body {
    padding: 1.25rem 1.875rem 4.1875rem;
    border: .0625rem solid #eee;
    border-bottom: 0;
}
.swipe-cart .swipe-container .reveal-body {
    padding: 1.25rem 1.875rem 4.1875rem;
    border: .0625rem solid #eee;
    border-bottom: 0;
}

.swipe-cart .swipe-container .reveal-body, .swipe-cart .swipe-container .reveal-header {
    width: 100%;
}
.add-cart.vertical .product-counter-widget {
    display: block;
    text-align: center;
}
.product-counter-widget {
    margin-bottom: 0;
}

.add-cart.vertical .product-counter-widget button {
    background: none;
    padding: 5px 10px;
    margin: 0;
    color: #777;
}

.button-up {
    display: inline-block;
    text-align: center;
    line-height: 1;
    cursor: pointer;
    -webkit-appearance: none;
    transition: background-color .25s ease-out,color .25s ease-out;
    vertical-align: middle;
    border: 1px solid transparent;
    border-radius: 4px;
    padding: .85em 1em;
    margin: 0 0 1rem;
    font-size: .9rem;
    background-color: #757575;
    color: #fff;
    text-transform: none;
    overflow: visible;
}
.fa-caret-up:before {
    content: "\F0D8";
}
.add-cart.vertical .product-counter-widget .measurement-field {
    display: block;
    min-width: 50px;
    color: #777;

}
.add-cart.vertical .product-counter-widget .measurement-field .quantity-value {
    display: inline-block;
    font-size: 15px;
}
.add-cart.vertical .product-counter-widget .measurement-field .unit-name {
    display: inline-block;
    margin-left: 3px;
    font-size: 14px;
}
.button.disabled, .button[disabled] {
    opacity: .25;
    cursor: not-allowed;
}

.add-cart.vertical .product-counter-widget button {
    background: none;
    padding: 5px 10px;
    margin: 0;
    color: #777;
}
.fa-caret-down:before {
    content: "\F0D7";
}
img.product-img.square-80 {
    width: 70px;
    min-height: 80px;
    background-size: 80px;
}
.cart-items .table tr td:first-child+td+td {
    padding-left: 5px;
}
.cart-items .table tr td {
    vertical-align: middle;
    padding: 7px 0;
}
.align-self-top {
    align-self: flex-start;
}
table td, table th {
    font-size: .875rem;
    vertical-align: top;
}
.cart-items .table tr td .product-info .title {
    margin-bottom: 5px;
    font-size: 15px;
    width: 90%;
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
}
strong {
    font-weight: 700;

    line-height: inherit;
}
.cart-items .table tr td .remove-from-cart {
    position: absolute;
    right: -328px;
    top: 27px;
}

CSS,

    ];

    public function asset()
    {
        $this->fileCss('/render/market/XeMart - Ecommerce Template/html/css/material.css');
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
        $isEmptyCurrency = '';
        if (empty($this->model->price_old))
        {
            $isSale = 'd-none';
            $isEmptyCurrency = 'd-none';
        }
            
        $this->htm = strtr($this->_layout[$this->_config['type']], [
            '{id}' => $this->id,
            '{name}' => $this->model->name,
            '{price}' => $price,
            '{price_old}' => $price_old,
            '{cardImage100x100}' => $this->model->images[0],
            '{cardImage650x700}' => $this->model->images[0],
            '{currency}' => $this->model->currency,
            '{title}' => $this->model->title,
            '{categoryName}' => $this->model->categoryName,
            '{isSale}' => $isSale,
            '{addCart}' => $addCart,
            '{product_id}' => $this->model->id,
            '{isEmptyCurrency}' => $isEmptyCurrency
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
        $this->js =strtr($this->_layout['js'], [
            '{id}' => $this->id
        ]);

    }
}

