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

class ZTabItemWidgetOld extends Zwidget
{
    public $config = [];
    public $_config = [
        'type' => self::type['vertical'],
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
        'vertical' => 'vertical'
    ];


    /*
     * Layouts
     * */
    public $layout = [];
    public $_layout = [
        'vertical' => <<<HTML
        <div class="tab-item w-25" id="{id}">
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
            border: 1px solid #eeeeee;
            margin-bottom: 30px;
        }
        .tab-img {
            margin-bottom: 10px;
            position: relative;
        }
        .img-content {
            padding: 0 15px 10px;
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
        .tab-item .tab-img {
            margin-bottom: 10px;
            position: relative;
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
CSS,

    ];

    public function asset()
    {
        $this->fileCss('/render/market/XeMart - Ecommerce Template/html/css/material.css');
    }

    public function codes()
    {

        $this->htm = strtr($this->_layout[$this->_config['type']], [
            '{id}' => $this->id,
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

