<?php

/**
 *
 *
 * Author:  jamshid Tojiboyev
 *
 */

namespace zetsoft\widgets\bozor;


use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\inputes\ZImageCheckboxWidget;


class ZPaymentJamWidget extends ZWidget
{
    public $config = [];
    public $_config = [
        'Payment' => 'Оплата',
    ];

    public $event = [];
    public $_event = [
    ];

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
            <div class="checkout-payment m-5">
    <div class="step-header"><h4 class="step-header-opened">{Payment}</h4></div>
    <div class="callout">
        <div class="payment-methods">
            <div class="getway-list">
                            <div class="payment-card d-flex">
                                {payments}
                            </div>
            </div>
        </div>
    </div>
</div>
HTML,

        'payment' => <<<HTML
           
              
                    <div class="check-border w-50 d-block custom-{type} {class}">
                            <img src="{src}" class="checkable {class}">
                            <input name="{name}" value="0" type="hidden" id="{id}-hidden"> 
                    </div>
              
               
          
HTML,


        'css' => <<<CSS
        
CSS,

        'js' => <<<JS
  
JS,

    ];

    public function asset()
    {
    }

    public function codes()
    {

        $items = $this->_config['data'];
        $items_code='';

        foreach ($items as $item){
            $items_code .=strtr($this->_layout['payment'],[
                '{id}'=>$item['id'],
                '{name}'=>$item['name'],
                '{src}'=>$item['src'],
                '{class}'=>$item['class'],
                '{type}'=>$item['type']
            ]);
        }



        $this->htm .= strtr($this->_layout['main'], [

        ]);

    }


}
