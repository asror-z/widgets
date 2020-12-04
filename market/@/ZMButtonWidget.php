<?php
/*
 *
 *
 *
 * Refactored by : Zoirjon Sobirov
 * Refactored By: Xakimjon Ergashov
 *
 * */

namespace zetsoft\widgets\market;


use zetsoft\system\kernels\ZWidget;

class ZMButtonWidget extends Zwidget
{
    public $config = [];
    public $_config = [
        'price' => '55',
        'currency' => '$',
        'number' => 1,

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
   
   <div class="container">
       <div class="row">
            
           <div class="col-lg-7">
               <div class="basket d-flex justify-content-between align-items-end mt-4 pb-2">
                   <a href="#" class="icon-basket"><i class="fa fa-shopping-cart" aria-hidden="true"></i>
                       <span class="basket-text ml-4">Корзина №{number}</span></a>
                   <span class="price-basket">{currency}{price}</span>
               </div>
           </div>
       </div>
   </div>
          
          
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
       .icon-basket {
               border: 1px solid #53b929;
               border-radius: 5px;
               padding: 6px 27px;
               display: flex;
               justify-content: space-between;
               align-items: center;
               background: #53b929;
               color: #ffffff;
               text-decoration: none;

           }

           .icon-basket img {
               color: #ffffff;
           }

           .clean-icon {
               font-size: 22px;
               color: gray;
           }
           .basket .fa{
               font-size: 25px;
           }

           .basket {
               border-bottom: 1px solid rgba(128, 128, 128, 0.548);
           }

           .price-basket {
               font-size: 18px;
               font-weight: 500;
               color: #53b929;
           }

CSS,



    ];

    public function asset()
    {

    }

    public function codes()
    {
        $this->js .= strtr($this->_layout['event'], [
            '{id}' => $this->id,
            '{click}' => $this->eventCode('click'),
            '{keyup}' => $this->eventCode('keyup'),
            '{dblclick}' => $this->eventCode('dblclick'),
            '{mouseenter}' => $this->eventCode('mouseenter'),
            '{mouseleave}' => $this->eventCode('mouseleave'),
        ]);


        $this->htm .= strtr($this->_layout['main'], [
            '{name}' => $this->name,
            '{value}' => $this->value,
            /*'{price}' => $this->_config['price'],
            '{currency}' => $this->_config['currency'],*/
            '{price}' => $this->model->price[0],
            '{currency}' => $this->model->currency,
            '{number}' => $this->_config['number'],

        ]);


        $this->js .= strtr($this->_layout['js'], [
            '{id}' => $this->id,
            '{icon}' => $this->modelCheck() ? $this->value : '',
        ]);

        $this->css = strtr($this->_layout['css'], []);
    }
}

