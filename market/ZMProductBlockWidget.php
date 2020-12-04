<?php

/**
 *
 *
 *
 * Created By: Malika Parmanova
 * Refactored: Zoirjon Sobirov
 */
namespace zetsoft\widgets\market;

use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\widgets\inputes\ZKSelect2Widget;
use function GuzzleHttp\Psr7\str;
use zetsoft\system\kernels\ZWidget;
use kartik\widgets\Select2;
use yii\web\JsExpression;


class ZMProductBlockWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'currency'  => 'UZS',
        'products'  => [
            [
                'imageSrc'             => '#',
                'expireDate'         => '12+',
                'day'                => 'дней',
                'productImage'       => 'https://web.lebazar.uz/resources/product/2017/0/19/small_1484813094725080301-00089.jpg',
                'productName'        => 'Орех  400г',
                'productQuantity'    =>'1',
                'closeBtn'           =>'x',
                'productPrice'       =>'20.000',
            ],
        ]

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

        'container' => <<<HTML
            <div class="product-category">
               {content}
            </div>

HTML,
        'css' => <<<CSS
     
.save {
            /*display: flex;*/
            flex-direction: column;
        }

        .save .save-num {
            font-size: 25px;
            font-weight: 700;
            color: #27b82f;
        }

        .save .save-day {
            margin-left: 22px;
            margin-top: -12px;
        }

        .product-img {
            width: 100%;
            height: auto;
        }

        .product-category {
            display: flex;
            justify-content: space-between;
            border: 1px solid #d2d2d2;
            border-radius: 5px;
            padding: 10px;
        }

        .product-content{
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .product-titel{
            font-weight: 500;
            width: 70%;
        }
        .product-content .star .fa{
            font-size: 23px;
            color: #ffd600;
        }
            .page-link{
                color: black;
            }
        .product-content .star-5 .fa{
            color: #ababab;
        }

        .product-price{
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .shopping-cancel{
            text-align: end;
            margin-top: -10px;
        }
        .close{
            text-align: end;
            color: #ce5856;
            margin-top: -10px;
        }
        .price-num{
            font-size: 25px;
            font-weight: 700;
            color: #53b929;
        }
        .shopping-price{
            display: flex;
            align-items: flex-end;
        }

  
CSS,
    ];

    public function asset(){}

    public function codes()
    {
        $content = '';

        foreach ($this->_config['products'] as $product) {
            $imgSrc           = $product['imageSrc'];
            $expireDate       = $product['expireDate'];
            $day              = $product['day'];
            $productImage     = $product['productImage'];
            $productName      = $product['productName'];
            $productQuantity  = $product['productQuantity'];
            $closeBtn         = $product['closeBtn'];
            $productPrice     = $product['productPrice'];
            $currency         = $this->_config['currency'];
            $content .= " <div class=\"product-image\">
                    <div class=\"save\">
                        <span class='save-num'><img src='$imgSrc' alt=''>$expireDate</span>
                        <span class='save-day'>$day</span>
                    </div>
                    <img src='$productImage' class='product-img' alt='png'>
                </div>

                <div class='product-content pl-4'>
                    <p class='product-titel mb-1'>$productName</p>
                    <p class='reviews-rating mb-1'>
                        <a href='#' class='star-1 star'><i class='fa fa-star' aria-hidden='true'></i></a>
                        <a href='#' class='star-2 star'><i class='fa fa-star' aria-hidden='true'></i></a>
                        <a href='#' class='star-3 star'><i class='fa fa-star' aria-hidden='true'></i></a>
                        <a href='#' class='star-4 star'><i class='fa fa-star' aria-hidden='true'></i></a>
                        <a href='#' class='star-5 star'><i class='fa fa-star' aria-hidden='true'></i></a>
                    </p>
                    <nav aria-label='Page navigation example'>
                        <ul class='pagination'>

                            <li class='page-item'><a class='page-link' style='background: lightgrey;' href='#'>-</a></li>
                            <li class='page-item'><a class='page-link pr-4 pl-4' href='#'>$productQuantity</a></li>
                            <li class='page-item'><a class='page-link' style='background: lightgrey;' href='#'>+</a></li>

                        </ul>
                    </nav>
                </div>
                <div class='product-price'>
                    <button type='button' class='close' aria-label='Close'>
                        <span aria-hidden='true'>$closeBtn</span>
                    </button>

                    <p class='shopping-price'><span class='price-num pr-2'>$productPrice </span> $currency</p>
                </div>";

        }
        $this->htm = strtr($this->_layout['container'], [
            '{content}' => $content
        ]);
        $this ->css = strtr($this ->_layout['css'],[

        ]);
    }

}






