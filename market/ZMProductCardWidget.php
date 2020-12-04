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
 * Class ZMProductCardWidget
 * http://demos.krajee.com/widget-details/select2
 *
 * Created By: Akhrorkhuja Azamkhujaev
 */
class ZMProductCardWidget extends ZWidget
{


    public $config = [];
    public $_config = [
        'status'        => '<i class="fa fa-circle"></i> Есть в наличии',
        'productLink'   => '#',
        'productName'   => 'Телевизор Samsung 43RU7400UZ',
        'url'      => '/render/market/ZMProductCardWidget/asset/demo_1_files/Samsung_43RU7400UZ.jpg',
        'addToCartIcon' => 'https://www.mediapark.uz/themes/mp/assets/images/basket_white.png',
        'addToCartText' => 'Заказать',
        'allPlayImg'    => 'https://www.mediapark.uz/upload/file/mp/products/ArtelTV/allplay.jpg',
        'gift'          => 'https://www.mediapark.uz/upload/file/mp/ribbons/present.svg',
        'giftName'      => 'Супер предложение',
        'message1'       => 'При покупке на сайте',
        'message2'       => '+ ПОДАРОК',
    ];

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML

    <div class="super-offer super-offer-carousel carousel-item slick-slide" style="width: 258px;">
        <span class="status active ">{status}</span>
        <div class="img">
            <a href="{productLink}">
                <img
                        class="img-responsive" src="{url}"
                        alt="{productName}">
                <img class="icon"
                     src="{gift}"
                     alt="{giftName}">
            </a>
        </div>
        <span class="red-msg">{message1}</span>
        <h3 class="title">
            <a href="{productLink}">{productName}</a>
        </h3>
        <span class="yellow-msg">{message2}</span>
        <br>
        <a
                class="pull-left child"
                href="#"
        >
            <img src="{allPlayImg}"
                 alt=""
                 title=""
                 style="width:100px;">
        </a>
        <button class="btn pull-right add-to-cart">&nbsp;</button>
        <a class="btn quick-checkout pull-right"
           href="{productLink}">{addToCartText}</a>
        <div class="clearfix"></div>
    </div>
        

HTML,

        'css' => <<<CSS

    .status {
        font-family: ProximaNovaSemibold, sans-serif;

        }
   
    
    .add-to-cart {
        padding: 10px 10px 10px 40px;
        background: #ff0a13 url("{addToCartIcon}") no-repeat left 10px center;
        background-size: 30px;
        /*outline: none !important;*/
        /*color: #ffffff !important;*/
        /*font-weight: 600;*/
        font-size: 16px; }
    .add-to-cart:hover {
        /*background: #f91019 url("{addToCartIcon}") no-repeat left 7px center;*/
        background-size: 36px;
        /*color: #ffffff;*/
        }
    .quick-checkout {
        background-color: #ed1c24;
        /*outline: none !important;*/
        color: #ffffff !important;
        }
    /*.quick-checkout.btn-lg {*/
    /*    font-size: 16px;*/
    /*    padding: 10px 15px;*/
    /*    }*/
    .quick-checkout:hover {
        background-color: #193a68;
        /*color: #ffffff;*/
        }
    .super-offer .block-name {
        color: #000000;
        font-size: 24px;
        font-weight: 600;
        margin: 40px 0 0;
    }

    .super-offer .block-name.red {
        /*color: #ed1c24;*/
    }

    .super-offer.carousel-item {
        display: unset;
        /*background-color: #ffffff;*/
        margin: 0 5px;
        padding: 10px;
        outline: none;
        min-height: 350px;
        -webkit-box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
        -moz-box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
        box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
    }

    .super-offer.carousel-item .img {
        position: relative;
        display: block;
    }

    .super-offer.carousel-item .img img.icon {
        position: absolute;
        width: 60px;
        left: 20px;
        top: 20px;
    }

    .super-offer.carousel-item img:hover {
        opacity: 0.75;
    }

    .super-offer.carousel-item .red-msg {
        color: #ed1c24;
        font-size: 14px;
        font-family: RalewayBold, sans-serif;
    }

    .super-offer.carousel-item .title {
        font-size: 18px;
        font-weight: 600;
        min-height: 60px;
    }

    .super-offer.carousel-item .title a {
        color: #000000;
        text-decoration: none;
    }

    .super-offer.carousel-item .title a:hover {
        color: #ed1c24;
    }

    .super-offer.carousel-item .yellow-msg {
        font-family: ProximaNovaSemibold, sans-serif;
        color: #ed1c24;
        padding: 5px;
        border-radius: 5px;
        font-size: 14px;
        font-weight: 600;
        background-color: #fede00;
    }

    .super-offer.carousel-item .pull-left,
    .super-offer.carousel-item .pull-right {
        margin-top: 10px;
    }
    
CSS,

    ];

    public function init()
    {
        parent::init();
        ob_start();
    }


    public function asset()
    {
        $this->fileCss("https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css");
    }

    public function codes()
    {


        $this ->htm = strtr($this ->_layout['main'], [
            '{status}'      => $this->_config['status'] ? $this->_config['status'] : '',
            '{productLink}' => $this->_config['productLink'] ? $this->_config['productLink'] : '',
            '{productName}' => $this->_config['productName'] ? $this->_config['productName'] : '',
            '{url}'    => $this->_config['url'] ? $this->_config['url'] : '',
            '{allPlayImg}'  => $this->_config['allPlayImg'] ? $this->_config['allPlayImg'] : '',
            '{gift}'        => $this->_config['gift'] ? $this->_config['gift'] : '',
            '{giftName}'        => $this->_config['giftName'] ? $this->_config['giftName'] : '',
            '{message1}'      => $this->_config['message1'] ? $this->_config['message1'] : '',
            '{message2}'      => $this->_config['message2'] ? $this->_config['message2'] : '',
            '{addToCartText}'      => $this->_config['addToCartText'] ? $this->_config['addToCartText'] : '',
        ]);

        $this->css = strtr($this->_layout['css'], [
            '{addToCartIcon}' => $this->_config['addToCartIcon'] ? $this->_config['addToCartIcon'] : '',
        ]);


    }

}
