<?php

/**
 *
 *
 * Author:  Zoirjon Sobirov
 * https://t.me/zoirjon_sobirov
 *
 */

namespace zetsoft\widgets\market;


use zetsoft\dbitem\market\MyOrder;
use zetsoft\models\App\eyuf\Order;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZWidget;

class ZOrderSummaryWidget extends Zwidget
{
    public $config = [];
    public $_config = [

        'orders' => [],
        'grapes' => true,

    ];


    public $event = [];
    public $_event = [
        'click' => ' console.log("self | $eventClick") ',
        'dblclick' => ' console.log("self | $eventDblclick") ',
        'mouseenter' => ' console.log("self | $eventMouseEnter") ',
        'mouseleave' => ' console.log("self | $eventMouseLeave") ',
        'keyup' => ' console.log("self | $eventKeyup") ',
        'onload' => 'console.log("self | $eventOnLoad")',
        'onclick' => 'console.log("self | $eventOnClick")',
    ];
    /*   */
    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
            
    <section class="shopping-cart">
                    <div class="crt-sumry">
                        <h5>Cart Summery</h5>
                        <ul class="list-unstyled">
                            <li>{subtotalTitle} <span>{subtotal}</span></li>
                            <li>Shipping &amp; Tax <span>{shipTax}</span></li>
                            <li>Grand Total <span>{grand}</span></li>
                        </ul>
                        <div class="cart-btns text-right">
                            <button type="button" class="up-cart">Update Cart</button>
                            <button type="button" class="chq-out">Checkout</button>
                        </div>
        </div>
    </section>
          
          
HTML,
        'js' => <<<JS
                                     
     
            
JS,
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
                    .shopping-cart .crt-sumry {
                      background: #f1f1f1;
                      padding: 23px 30px 30px;
                     
                    }
                    
                    .shopping-cart .crt-sumry h5 {
                      color: #444444;
                      font-weight: 600;
                      margin-bottom: 20px;
                    }
                    
                    .shopping-cart .crt-sumry ul {
                      margin-bottom: 30px;
                    }
                    
                    .shopping-cart .crt-sumry ul li {
                      font-size: 15px;
                      color: #666666;
                      font-weight: 600;
                      margin-bottom: 5px;
                    }
                    
                    .shopping-cart .crt-sumry ul li span {
                      float: right;
                      color: #444444;
                      font-weight: 700;
                    }
                    
                    .shopping-cart .crt-sumry ul li:nth-child(2) {
                      border-bottom: 1px solid #dddddd;
                      padding-bottom: 10px;
                      margin-bottom: 10px;
                    }
                    
                    .shopping-cart .crt-sumry button.up-cart {
                      font-size: 15px;
                      color: #5677fc;
                      background: transparent;
                      border: 1px solid #5677fc;
                      -webkit-border-radius: 30px;
                      -moz-border-radius: 30px;
                      -ms-border-radius: 30px;
                      border-radius: 30px;
                      padding: 5px 18px;
                      font-weight: 600;
                    }
                    
                    .shopping-cart .crt-sumry button.up-cart:hover {
                      color: #fff;
                      background: #5677fc;
                    }
                    
                    .shopping-cart .crt-sumry button.chq-out {
                      font-size: 15px;
                      color: #fff;
                      background: #e45151;
                      border: 1px solid #e45151;
                      -webkit-border-radius: 30px;
                      -moz-border-radius: 30px;
                      -ms-border-radius: 30px;
                      border-radius: 30px;
                      padding: 5px 18px;
                      font-weight: 600;
                      margin-left: 10px;
                    }
                    
                    .shopping-cart .crt-sumry button.chq-out:hover {
                      color: #e45151;
                      background: transparent;
                    }
                    
                    .shopping-cart .wsh-list {
                      margin-bottom: 0;
                    }

CSS,


    ];

    public function asset()
    {


    }

    public function codes()
    {

        if (empty($this->_config['orders']))
            return Az::warning($this->_config['orders'], Az::l('Orders are empty'));

        /* @var MyOrder $order */
        foreach ($this->_config['orders'] as $order) {
            $this->htm .= strtr($this->_layout['main'], [
                '{shipTax}' => $order->shipTax,
                '{subtotal}' => $order->shipTax,
                '{grand}' => $order->cost,

                '{subtotalTitle}' => Az::l('Цена товара'),

            ]);
        }


        $this->js .= strtr($this->_layout['event'], [
            '{id}' => $this->id,
            '{click}' => $this->eventCode('click'),
            '{keyup}' => $this->eventCode('keyup'),
            '{dblclick}' => $this->eventCode('dblclick'),
            '{mouseenter}' => $this->eventCode('mouseenter'),
            '{mouseleave}' => $this->eventCode('mouseleave'),
        ]);


        $this->js .= strtr($this->_layout['js'], [
            '{id}' => $this->id,
            '{icon}' => $this->modelCheck() ? $this->value : '',
        ]);

        $this->css = strtr($this->_layout['css'], []);
    }
}

