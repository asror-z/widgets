<?php

namespace zetsoft\widgets\cards;

use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\widgets\inputes\ZKSelect2Widget;
use function GuzzleHttp\Psr7\str;
use zetsoft\system\kernels\ZWidget;
use kartik\widgets\Select2;
use yii\web\JsExpression;

/**
 *
 * Class ZKSelect2Widget
 * https://github.com/chinchang/hint.css
 * Created By: Malika Parmanova
 * Refactored: Malika Parmanova
 */

class ZMCardItemWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'products'=>[
            'product'=>[
                'name'=>'kolbasa',
                'quantity'=>3,
                'price'=>1000
            ],
            'product1'=>[
                'name'=>'sosiska',
                'quantity'=>4,
                'price'=>3000
            ] ,
            'product2'=>[
                'name'=>'non',
                'quantity'=>2,
                'price'=>4000
            ]
        ]  ,
        'total-price'=>0,
        'total-quantity'=>0,
        'currency'=>'UZS',
        'delivery'=>5000,
        'grapes' => true,
        'text-delivery'=>'delivery'

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

        'main' => <<<HTML
         <div class="container container-full">
            {content}
    
</div>
HTML,

        'shipping-cart'=><<<HTML
        
                    <div style="border: 1px solid green">
                    <div class="col-lg-12 d-flex p-2" >
                        <h6> {your_order} </h6>
                        <h6 class="ml-auto shopping-cart-product-quantity"> {quantity} {product_lang} </h6>
                    </div>
                    <div class="col-lg-12 d-flex p-2" >
                        <h6> {name}</h6>
                        <h6 class="ml-auto shopping-cart-product-price" > {price} {currency}</h6>
                    </div>
</div>
                    
                   
                
HTML,

        'result-cart'=><<<HTML
        
                <div class="card card-header">
                    <div class="d-flex col-lg-12">
                        <span class="shopping-cart-icon">
                            <i class="fas fa-cart"></i>
                        </span>
                        <div class="shopping-cart-quantity-container">
                            <div class="shopping-cart-quantity">
                                <h6>{total_quantity}</h6>
                            </div>
                        </div>
                        <div class="ml-auto">
                            <h6 class="shopping-cart-total-price">{total_price} {currency}</h6>
                        </div>
                    </div>
                </div>
HTML,

        'delivery'=><<<HTML
                                    
                <div class="col-lg-12 d-flex mb-4" >
                        <h6> {text-delivery}</h6>
                        <h6 class="ml-auto shopping-cart-product-price" > +{delivery} {currency}</h6>
                </div>
HTML,

        'pay'=><<<HTML
            <div class="col-lg-12">
                        <div class="col-lg-12 ml-auto mr-auto">
                            <button class="btn w-100 btn-md btn-success "> {pay} </button>
                        </div>
                   </div>
HTML,


        'css' => <<<CSS
        
        .container-full{
            margin-top: 10px;
        }
        .card-header{
            background-color: limegreen;
            height: 50px;
            padding: 0 !important;
        }
        .shopping-cart-icon {
            color: #ffffff;
            padding: 15px;
        }
        .shopping-cart-quantity-container {
            background-color: #ffffff;
            width: 30px;
            height: 26px;
            margin: 10px;
            border-radius: 20%;
        }
        .shopping-cart-quantity {
            margin-bottom: 2px;
            margin-left: 10px;
        }
        .shopping-cart-total-price{
            color: #ffffff;
            padding: 10px
        }
        .shopping-cart-body{
            height: 430px;
            border: 2px solid lightgray;
            padding:10px;
        }
        .shopping-cart-product-quantity, .shopping-cart-product-price{
            color: limegreen;
        }
        
        
  
CSS,
        

    ];

    /**
     *
     * Constants
     */


    public function asset()
    {

        $this->fileCss('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css');



    }

    public function codes()
    {
       // $this->htm = strtr($this->_layout['main'], []);
        $this->css = strtr($this->_layout['css'],[]);

        $products=$this->_config['products'];
        $content='';
        $total_price=0;
        $total_quantity=0;
        $length=count($products);
        $i=0;
        foreach ($products as $product){
            $i++;
            $content.=strtr($this->_layout['shipping-cart'],[
               '{name}'=>$product['name'],
               '{quantity}'=>$product['quantity'],
               '{price}'=>$product['price'],
               '{currency}'=>$this->_config['currency'],
               '{your_order}'=>Az::l('Quantity'),
               '{product_lang}'=>Az::l('products')
            ]);
            $total_price+=$product['price']*$product['quantity'];
            $total_quantity+=$product['quantity'];
            
            if($i===$length){
                $total_price+=$this->_config['delivery'];
                $content.=strtr($this->_layout['delivery'],[
                    '{text-delivery}'=>$this->_config['text-delivery'],
                    '{delivery}'=>$this->_config['delivery'],
                    '{currency}'=>$this->_config['currency']
                ]);
                $content.=strtr($this->_layout['result-cart'],[
                    '{total_quantity}'=>$total_quantity,
                    '{total_price}'=>$total_price,
                    '{currency}'=>$this->_config['currency']
                ]);
                $content.=strtr($this->_layout['pay'],[
                    '{pay}'=>Az::l("Pay")
                ]);

        }


        $this->htm=strtr($this->_layout['main'],[
           '{content}'=>$content
        ]);

        
        }
    }
}




