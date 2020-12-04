<?php

namespace zetsoft\widgets\market;

use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use function GuzzleHttp\Psr7\str;
use zetsoft\system\kernels\ZWidget;
use kartik\widgets\Select2;
use yii\web\JsExpression;

/**
 *
 * Class ZKSelect2Widget
 * http://demos.krajee.com/widget-details/select2
 *
 * Created By: Maftuna Kodirova,
 * Refactored By: Khojiakbar Kodirov,

 */

class ZMCardItemWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'currency'=>'UZS',
        'shipping-price'=>'5000',
        'total-product'=>'0',
        'grand-total'=>'0',
        'products'=>[
            [
                'product-name'=>'meat',
                'product-price'=>'40000',
            ],
            [
                'product-name'=>'meat',
                'product-price'=>'40000',
            ],
            [
                'product-name'=>'meat',
                'product-price'=>'40000',
            ],
            [
                'product-name'=>'meat',
                'product-price'=>'40000',
            ]
        ],
        'grapes' => true,
    ];


    /**
     *
     * Plugin Events
     * https://select2.org/programmatic-control/events
     */
    public $event = [];
    public $_event = [

    ];

    public function asset()
    {
        $this->fileCss("https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.12.1/css/all.min.css");
        $this->fileJs("https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css");
    }

      public $layout =[];
      public $_layout =[
          'main' => <<<HTML

          <div class="container container-full" '  {readonly}  >
            <div class="row ">
            <div class="col-lg-12">
                <div class="col-lg-12 ">
                    <div class="card card-header">
                        <div class="d-flex col-lg-12">
                            <span class="shopping-cart-icon">
                                <i class="fas fa-shopping-cart"></i>
                            </span>
                            <div class="shopping-cart-quantity-container">
                                <div class="shopping-cart-quantity">
                                    <h6>{total-product}</h6>
                                </div>
                            </div>
                            <div class="ml-auto">
                                <h6 class="shopping-cart-total-price">{grand-total} {currency}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          </div>
          <div class="row ">
            <div class="col-lg-12">
                <div class="col-lg-12 ">
                    <div class="shopping-cart-body">
                        <div class="col-lg-12 d-flex" >
                            <h6> Ваш заказ </h6>
                            <h6 class="ml-auto shopping-cart-product-quantity"> {total-product} товара </h6>
                        </div>
                        <hr>
                            {content}
                        <hr>
                        <div class="col-lg-12 d-flex">
                            <h6> Доставка</h6>
                            <h6 class="ml-auto shopping-cart-product-price"> {shipping-price} {currency} </h6>
                        </div>
                        <hr>
                        <div class="col-lg-12 d-flex" >
                            <h6 > Итого </h6>
                            <h6 class="ml-auto shopping-cart-product-price"> {grand-total} {currency} </h6>
                        </div>
                        <hr>
                        <div class="col-lg-12">
                            <div class="col-lg-12 ml-auto mr-auto">
                                <button class="btn w-100 btn-md btn-success "> Оплатить </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          </div>
      </div>           
        

HTML,

     'css' => <<<CSS

    .container-full{
        margin-top: 10px;
    }
        .card-header{
            background-color: limegreen !important;
            height: 50px;
            padding: 0 !important;
        }
        .shopping-cart-icon {
            color: #ffffff;
            padding: 15px;
            font-family: "Lucida Console", Courier, monospace;;
        }
        .shopping-cart-quantity-container {
            background-color: #ffffff;
            width: 30px;
            height: 30px;
            margin: 10px;
            border-radius: 20%;
            text-align: center;
        }
        .shopping-cart-quantity {
            margin-top: 4px;
        }
        .shopping-cart-total-price{
            color: #ffffff;
            position: relative;
            top: 15px ;
        }
        .shopping-cart-body{
            height: 430px;
            border: 2px solid lightgray;
            padding:10px;
        }
        .shopping-cart-product-quantity, .shopping-cart-product-price{
            color: limegreen;
        }
        .btn{
            position: relative;
            width: 1000px;
            right: 5px;
        }
    
CSS,

      ];



    public function codes()
    {
        $content = '';
        foreach ($this->_config['products'] as $product) {
            $productName= $product['product-name'] ;
            $productPrice= $product['product-price'] ;
            $currency = $this->_config['currency'] ;
            $this->_config['total-product']+=1 ;
            $this->_config['grand-total']+=$productPrice ;

            $content .= "
            <div class=\"col-lg-12 d-flex\" >
                <h6>$productName</h6>
                <h6 class=\"ml-auto shopping-cart-product-price\" > $productPrice $currency </h6>
            </div>
            ";

        }
        $this ->htm = strtr($this ->_layout['main'],[
            '{content}' => $content,
            $this->_config['grand-total']+=$this->_config['shipping-price'],
            '{currency}' => $this->_config['currency'],
            '{shipping-price}'=>$this->_config['shipping-price'],
            '{total-product}' =>$this->_config['total-product'],
            '{grand-total}' =>$this->_config['grand-total'],
            '{readonly}' => $this->_config['readonly'] ? 'readonly' :'',
        ]);

        $this ->css = strtr($this ->_layout['css'],[
            ]);


    }

}
