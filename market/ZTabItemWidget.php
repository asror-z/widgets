<?php

/*
 * Author: AzimjonToirov
 * */

namespace zetsoft\widgets\market;


use PhpOffice\PhpWord\Reader\HTML;
use zetsoft\dbitem\shop\ProductItem;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\navigat\ZButtonWidget;

class ZTabItemWidget extends Zwidget
{
    public $config = [];
    public $_config = [
        'type' => self::type['vertical'],
        'firstPrice' => self::firstPrice['100'],
        'salePrice' => self::salePrice['50'],
        'cardImage' => '/render/market/XeMart - Ecommerce Template/html/images/sbar-1.png',
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
        'horizontal' => 'horizontal',
        'vertical' => 'vertical',
        'bestDeals' => 'bestDeals',
    ];


    public const firstPrice = [
        '100' => '$100',
        '200' => '$200',
    ];


    public const salePrice = [
        '70' => '$70',
        '50' => '$50',
    ];


    /*
     * Layouts
     * */
    public $layout = [];
    public $_layout = [
        'vertical' => <<<HTML
        <div class="tab-item mb-30 border border-secondary overflow-hidden w-25" id="{id}">
            <div class="tab-img">
                <img class="main-img img-fluid" src="/render/market/@template/XeMart%20-%20Ecommerce%20Template/html/images/tab-1.png" alt="">
                <div class="layer-box">
                    <a href="" class="it-comp" data-toggle="tooltip" data-placement="left" title="Compare"><img src="/render/market/@template/XeMart%20-%20Ecommerce%20Template/html/images/it-comp.png" alt=""></a>
                    <a href="" class="it-fav" data-toggle="tooltip" data-placement="left" title="Favourite"><img src="/render/market/@template/XeMart%20-%20Ecommerce%20Template/html/images/it-fav.png" alt=""></a>
                </div>
            </div>
            <div class="tab-heading">
                <p class="pl-3"><a href="">Samsung Smart Led Tv 42"</a></p>
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
                        <li class="list-inline-item">$120.00</li>
                        <li class="list-inline-item">$150.00</li>
                    </ul>
                </div>
                <div>
                    <a href="" data-toggle="tooltip" data-placement="top" title="Add to Cart"><img src="/render/market/@template/XeMart%20-%20Ecommerce%20Template/html/images/it-cart.png" alt=""></a>
                </div>
            </div>
        </div>
HTML,

        'horizontal' => <<<HTML
<div class="row">
      <div class="col-md-12">
       <div class="tab-item2" id="{id}">
               <div class="row">
                   <div class="col-lg-4 col-md-12">
                       <div class="tab-img">
                           <img class="main-img img-fluid" src="/render/market/@template/XeMart%20-%20Ecommerce%20Template/html/images/tab-1.png" alt="">
                       </div>
                   </div>
                   <div class="col-lg-8 col-md-12">
                       <div class="item-heading d-flex justify-content-between">
                           <div class="item-top">
                               <ul class="list-unstyled list-inline cate">
                                   <li class="list-inline-item"><a href="#">Home Appliance,</a></li>
                                   <li class="list-inline-item"><a href="#">Smart Led</a></li>
                               </ul>
                               <p><a href="">Samsung Smart Led Tv 42"</a></p>
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
                                   <li class="list-inline-item">$120.00</li>
                                   <li class="list-inline-item">$150.00</li>
                               </ul>
                           </div>
                       </div>
                       <div class="item-content">
                           <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem atque dolores aliquid culpa maiores beatae est quod officia veniam fugit? Molestiae, illum voluptatibus nisi error recusandae cum expedita. Laborum, expedita!</p>
                           <a href="" class="it-cart"><span class="it-img"><img src="images/it-cart.png" alt=""></span><span class="it-title">Add To Cart</span></a>
                           <a href="" class="it-fav" data-toggle="tooltip" data-placement="top" title="" data-original-title="Favourite"><img src="/render/market/@template/XeMart%20-%20Ecommerce%20Template/html/images/it-fav.png" alt=""></a>
                           <a href="" class="it-comp" data-toggle="tooltip" data-placement="top" title="" data-original-title="Compare"><img src="/render/market/@template/XeMart%20-%20Ecommerce%20Template/html/images/it-comp.png" alt=""></a>
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
               <a href="#"><img src="{cardImage}" alt=""></a>
                </div>
</div>

            <div class="col-md-8">
                 <div class="bt-content">
                          <p><a href="">Items Title Here</a></p>
                                 <ul class="list-unstyled list-inline fav">
                                   <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                      <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                      <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                        <li class="list-inline-item"><i class="fa fa-star-o"></i></li>
                                          </ul>
                                             <ul class="list-unstyled list-inline price">
                                               <li class="list-inline-item">{firstPrice}</li>
                                      <li class="list-inline-item">{salePrice}</li>
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
       
CSS,

    ];

    public function asset()
    {
        $this->fileCss('/render/market/ZTabItemWidget/assets/style.css');
       /* $this->fileCss('/render/market/XeMart - Ecommerce Template/html/css/material.css');*/
        /*$this->fileCss('/render/market/XeMart - Ecommerce Template/html/css/assets/animate.css');*/
        $this->fileCss('https://cdn.statically.io/gh/animate-css/animate.css/master/source/animate.css');
        /*$this->fileCss('/render/market/XeMart - Ecommerce Template/html/css/assets/owl.carousel.min.css');*/
        $this->fileCss('https://cdn.statically.io/gh/OwlCarousel2/OwlCarousel2/develop/dist/assets/owl.carousel.min.css');
        $this->fileJs('/render/market/XeMart - Ecommerce Template/html/js/custom.js');
    }

    public function codes()
    {

        $this->htm = strtr($this->_layout[$this->_config['type']], [
            '{id}' => $this->id,
            '{firstPrice}' => $this->_config['firstPrice'],
            '{salePrice}' => $this->_config['salePrice'],
            '{cardImage}' => $this->_config['cardImage'],
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
        ]);
        /*
         * Css Code
         * */
        $this->css = $this->_layout['css'];
    }
}

