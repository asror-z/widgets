<?php

/**
 *
 *
 * Author:  Khojiakbar Kodirov
 *
 */

namespace zetsoft\widgets\market;


use zetsoft\system\kernels\ZWidget;

class ZXeMartProductReviewWidget extends ZWidget
{
    public $config = [];
    public $_config = [
        'currency' => '$',
        'sub-total' => '0.0',
        'shipping-price' => '0.0',
        'grand-total' => '0.0',
        'products' =>[
            [
                'imageSrc'=>'https://bit.ly/2ybBUxB',
                'product-name'=>'Product Name Here',
                'product-number'=>'1',
                'product-price'=>'0',
                'total-product-price'=>'0',
            ],
            [
                'imageSrc'=>'https://bit.ly/2ybBUxB',
                'product-name'=>'Product Name Here',
                'product-number'=>'1',
                'product-price'=>'0',
                'total-product-price'=>'0',
            ],
            [
                'imageSrc'=>'https://bit.ly/2ybBUxB',
                'product-name'=>'Product Name Here',
                'product-number'=>'1',
                'product-price'=>'0',
                'total-product-price'=>'0',
            ],
            

        ]
    ];

    public function asset()
    {

    }

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
            <div class="order-review">
                <h5>Order Review</h5>
                <div class="review-box">
                    <ul class="list-unstyled">
                        {content} 
                     
                        <li class='fifth'>Sub Total <span class="fifth-span">{currency}{sub-total}</span></li>
                        <li class='sixth'>Shipping & Tax <span class="sixt/li>
                        <li h-span">{currency}{shipping-price}</span><class='seventh'>Grand Total <span class="seventh-span">{currency}{grand-total}</span></li>
                    </ul>
                </div>
            </div>
        HTML,


        'css' => <<<CSS
        .order-review {
            background: #f1f1f1;
            padding: 28px 35px 20px;
            margin: 35px;
        }

        .order-review .review-box ul li {
            margin-bottom: 15px;
        }

        .order-review .review-box ul li .first-span {
            float: right;
          
                padding-left: 10px;
           
        }
p, li, a, button {
    /* font-size: 14px; */
    font-family: "Source Sans Pro", sans-serif;
    margin: 3px;
    letter-spacing: 0.2px;
}
        .order-review .review-box ul li div.pro {
            width: 70%;
        }

        .order-review .review-box ul li div.pro img {
            max-width: 60px;
            float: left;
            margin-right: 10px;
        }

        .order-review .review-box ul li .fifth {

            border-top: 1px solid #e5e5e5;
            border-bottom: 1px solid #e5e5e5;

        }

        .order-review .review-box ul li .fifth-span{
            float: right;
        }

        .order-review .review-box ul li .sixth {
            border-bottom: 1px solid #dddddd;
        }

        .order-review .review-box ul li .sixth-span {
            float: right;
        }

        .order-review .review-box ul li .seventh-span {
            float: right;

        }
.prc{
font-family:"Segoe UI";


}
CSS,
        'js' => <<<JS
           
JS,
    ];


    public function codes()
    {
        $content = '';
        foreach ($this->_config['products'] as $product) {
            $src = $product['imageSrc'];
            $productName= $product['product-name'] ;
            $productNumber= $product['product-number'] ;
            $productPrice= $product['product-price'] ;
            $currency = $this->_config['currency'] ;
            $TotalProductPrice=$product['total-product-price'] ;

            $content .= "
                         <li class='first'><span class='first-span'>Total</span></li>                         <li class='d-flex justify-content-between'>
                                <div class='pro'>
                                    <img src='$src' alt='product image'>
                                    <p>$productName</p>
                                    <span>$productNumber X $currency $productPrice</span>
                                </div>
                                <div class='prc'>
                                    <p>$currency $TotalProductPrice</p>
                                </div>
                          </li>
            ";

        }
        $this->htm .= strtr($this->_layout['main'], [
            '{content}' => $content,
            '{currency}' => $this->_config['currency'],
            '{shipping-price}'=>$this->_config['shipping-price'],
            '{grand-total}' =>$this->_config['grand-total'],
            '{sub-total}' =>$this->_config['sub-total'],
        ]);

        $this->css = ($this->_layout['css']);



    }
}

