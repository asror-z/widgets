<?php

/*
 * Author:
 * Refactored: AzimjonToirov
 * */

namespace zetsoft\widgets\cards;


use yii\bootstrap\Html;
use zetsoft\dbitem\shop\ProductItem;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\navigat\ZButtonWidget;

class ZCartReviewWidget extends Zwidget
{
    public $config = [];
    public $_config = [
    ];


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
    /*   */
    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
      <!-- Logo Area 2 -->
        <div class="cart-box ml-auto text-center">
            <div class="d-flex topNavbarIcons">
                <div class="wsh-box cart-btn" id="addToCartButton">
                    <a
                        id="showCartBtn"
                        data-toggle="tooltip"
                        data-placement="top"
                        
                        ic-post-to="/core/product/getCartProductItems.aspx"
                        ic-target=".cart-contento"
                        ic-push-url="false"
                    >
                                       
                    <i class="fas fa-shopping-cart fa-lg text-black-50 navbarIconsFontSize">
                        <b class="ZCartReviewIconText">Корзина</b>
                    </i>
                    <span class="ZCartIcon" id="cart_total_amount">{amount}</span>
                    </a>
                </div>
            </div>
        </div>
      
        <!-- End Logo Area 2 -->

        <!-- Cart Body -->
        <div id="cartReview">
            <div class="cart-body">
                <div class="close-btn">
                    <i class="fa fa-times close-cart text-center">&nbsp;&nbsp;{close}</i>
                </div>
                <div class="crt-bd-box">
                    <div class="cart-heading text-center">
                        <h5>{title}</h5>
                    </div>
                    
                    <div class="cart-contento">
                    
                        {product}
                    
                    
                    </div>
                                                  
                </div>
            </div>
        </div>
        <div class="cart-overlay"></div>
          
HTML,

        'product' => <<<HTML
        
HTML,

        'js' => <<<JS
    
    	/***** Shopping Cart *****/
	$('#showCartBtn').on('click', function (event){
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


    ];


    public function asset()
    {
        $this->fileCss('/render/market/ZCartReviewWidget/assets/css/styleZCartReviewWidget.css');
    }

    public function codes()
    {

        $this->options['class'] = 'alert alert-primary text-center';
        $this->options['role'] = 'alert';
        $alert = HTML::tag('div', Az::l('Корзинке пока нет товаров'), $this->options);

        $cart = Az::$app->cores->session->get('cart');

        $amount = 0;
        if (is_array($cart))
            foreach ($cart as $item)
                $amount += $item['amount'];


        $this->htm .= strtr($this->_layout['main'], [
            //'{id}' => $this->id,
            //'{badge}' => $badge_code,
            '{title}' => Az::l('Корзинка'),
            '{subTotal}' => Az::l('ПРОМЕЖУТОЧНЫЙ ИТОГ'),
            /*'{total}' => $total,
            '{currency}' => $currency,
            '{button}' => $button,*/
            '{product}' => $alert,
            '{close}' => Az::l('Закрыть'),
            '{amount}' => $amount
        ]);

        $this->js = strtr($this->_layout['js'], [
            '{id}' => $this->id
        ]);
    }
}
