<?php

/**
 *
 *
 * Author:  Khojiakbar Kodirov
 *
 */

namespace zetsoft\widgets\bozor;


use zetsoft\system\kernels\ZWidget;

class ZCardOneWidget extends ZWidget
{
    public $config = [];
    public $_config = [
        'currency' => 'UZS',
        'sub-total' => '0.0',
        'shipping-price' => '10000.0',
        'grand-total' => '0.0',
        'products' =>[
            [

                'product-name'=>'Product Name Here',
                'product-quantity'=>'1',
                'product-price'=>'40000',

            ],
            [
                'product-name'=>'Product Name Here',
                'product-quantity'=>'1',
                'product-price'=>'50000',
            ],
            [
                'product-name'=>'Product Name Here',
                'product-quantity'=>'1',
                'product-price'=>'90000',
            ],
            

        ]
    ];

    public function asset()
    {

    }

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
           <table>
             <thead>
                  <tr>
                    <th>Cart 2</th>
                  </tr>
                </thead>
               <tbody>
                     {content}
                <tr>
                    <td class='delivery'>Delivery Fee</td>
                    <td class='price'>{shipping-price} {currency}</td>
                </tr>
            
                <tr id='total'>
                    <td>Total:</td>
                    <td class='price'>{sub-total} {currency}</td>
                </tr>
                <tr>
                    <td class='grandTotal'>Grand Total:</td>
                    <td class='price grTotal'>{grand-total} {currency}</td>
                </tr>
            </tbody>
           </table>
        HTML,


        'css' => <<<CSS
         table{
        margin:40px ;
    }
    td{
        margin-bottom: 5px ;
    }
    th{
        font-size: 2rem ;
        color: #0be370 ;
    }
    .price{
        float: right ;
        position: relative ;
        left: 90px ;
    }
    .product .delivery .total .grandTotal{
        float: left ;
    }
    .price{
        border-bottom: 2px solid grey;
        margin-left: 10px ;
    }
    .grTotal{
        color: #0be370 ;
    }

CSS,
        'js' => <<<JS
           
JS,
    ];


    public function codes()
    {
        $subTotal=$this->_config['sub-total'] ;
        $grandTotal=$this->_config['grand-total'] ;
        $shippingPrice=$this->_config['shipping-price'] ;
        $content = '';
        foreach ($this->_config['products'] as $product) {

            $productName= $product['product-name'] ;
            $productNumber= $product['product-quantity'] ;
            $productPrice= $product['product-price'] ;
            $currency = $this->_config['currency'] ;
            $subTotal= $subTotal+$productPrice ;


            $content .= "
                 <tr>
                    <td class='product'>$productName ($productNumber pc)</td>
                    <td class='price'>$productPrice $currency</td>
                </tr>
            ";

        }
        $subTotal = $subTotal+ $shippingPrice ;
        $grandTotal+=$subTotal ;
        $this->htm .= strtr($this->_layout['main'], [
            '{content}' => $content,
            '{currency}' => $this->_config['currency'],
            '{shipping-price}'=>$this->_config['shipping-price'],
            '{grand-total}' =>$grandTotal,
            '{sub-total}' =>$subTotal,
        ]);

        $this->css = ($this->_layout['css']);



    }
}

