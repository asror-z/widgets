<?php

/**
 *
 *
 * Author:  Shahzod Gulomqodirov
 *
 */

namespace zetsoft\widgets\market\AUWs;


use Mpdf\Tag\Th;
use zetsoft\dbitem\market\MyCard;
use zetsoft\dbitem\market\MyOrder;
use zetsoft\models\App\eyuf\Card;
use zetsoft\service\menu\Orders;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\inputes\ZKStarRatingWidget;

class ZSingleProductWidget extends ZWidget
{
    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'url' => '/eyuf/cores/main/index.aspx',
        'image' => 'https://micoedward.com/wp-content/uploads/2018/04/Love-your-product.png',
        'about' => 'Items Title Name Enter Here',
        'disPercentage' => '- 59%',
        'title' => 'hhhhhhhhhhh',
        'oldPrice' => '$150.00',
        'discountPrice' => '$120.00',
        'days' => '111',
        'hrs' => '22',
        'mins' => '33',
        'sec' => '45',
        'star' => null,
        'cards' => []
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
   <section class="sg-product border border-danger">
       <div class="ht-offer">
            <div class="sec-title">
                <h6>{name}</h6>
            </div>
            <div class="ht-body owl-carousel">
                <div class="ht-item">
                    <div class="ht-img">
                        <a href="{url}"><img src="{image}" alt="" class="img-fluid"></a>
                        <span>{sale}</span>
                    </div>
                    <div class="ht-content">
                        <p><a href="{url}">{title}</a></p>
                        <ul class="list-unstyled list-inline fav">
                           {star} <li class="list-inline-item"><i class="fa fa-star"></i></li>
                        </ul>
                        <ul class="list-unstyled list-inline price">
                            <li class="list-inline-item">{price}</li>
                            <li class="list-inline-item">{oldPrice}</li>
                        </ul>
                    </div>
                </div>
            </div>
       </div>
   </section>
HTML,

        'css' => <<<CSS
     a, button {
    -webkit-transition: 0.2s ease;
    -moz-transition: 0.2s ease;
    -ms-transition: 0.2s ease;
    -o-transition: 0.2s ease;
    transition: 0.2s ease;
}
a, a:hover {
    color: #555555;
}

p, li, a, button {
    font-size: 14px;
    font-family: "Source Sans Pro", sans-serif;
    margin: 0;
    letter-spacing: 0.2px;
}
.sg-product {
    padding: 50px 0;
}
.sg-product .ht-offer {
    margin-bottom: 40px;
}
.sg-product .ht-offer .sec-title h6 {
    color: #444444;
    text-transform: uppercase;
    font-weight: 600;
    border-bottom: 1px solid #eeeeee;
    padding-bottom: 15px;
    margin-bottom: 18px;
}
.sg-product .ht-offer .ht-body {
    position: relative;
}
.sg-product .ht-offer .ht-body .ht-item .ht-img {
    position: relative;
}
.sg-product .ht-offer .ht-body .ht-item .ht-img a img {
    margin-bottom: 15px;
}

.owl-carousel .owl-item img {
    -webkit-transform-style: unset;
    transform-style: unset;
}
.sg-product .ht-offer .ht-body .ht-item .ht-img span {
    font-size: 13px;
    color: #fff;
    font-weight: 600;
    background: sandybrown;
    text-transform: uppercase;
    width: 42px;
    height: 42px;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    -ms-border-radius: 50%;
    border-radius: 50%;
    text-align: center;
    padding-top: 12px;
    position: absolute;
    top: 0;
    left: 0;
    z-index: 2;
    margin-left: 15px;
    margin-top: 15px;
}
.sg-product .ht-offer .ht-body .ht-item .ht-img ul.counter-box {
    text-align: center;
    position: absolute;
    bottom: 0;
    left: 0;
    margin-bottom: 15px;
    width: 100%;
}
.sg-product .ht-offer .ht-body .ht-item .ht-img ul.counter-box li {
    background: #fff;
    border: 1px solid #e5e5e5;
    width: 45px;
    height: 45px;
    margin: 5px;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    -ms-border-radius: 50%;
    border-radius: 50%;
    font-size: 13px;
    font-weight: 700;
    padding-top: 5px;
}
.sg-product .ht-offer .ht-body .ht-item .ht-img ul.counter-box li p {
    font-size: 11px;
    font-weight: 500;
    margin-top: -3px;
    text-transform: uppercase;
}

.sg-product .ht-offer .ht-body .owl-nav div.owl-prev {
    margin-right: 25px;
}

.sg-product .ht-offer .ht-body .owl-nav div {
    position: absolute;
    top: 0;
    right: 0;
    font-size: 13px;
    border: 1px solid #e5e5e5;
    width: 20px;
    height: 20px;
    text-align: center;
    z-index: 1;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    -ms-border-radius: 50%;
    border-radius: 50%;
    margin-top: -54px;
}
.sg-product .ht-offer .ht-body .owl-nav div {
    position: absolute;
    top: 0;
    right: 0;
    font-size: 13px;
    border: 1px solid #e5e5e5;
    width: 20px;
    height: 20px;
    text-align: center;
    z-index: 1;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    -ms-border-radius: 50%;
    border-radius: 50%;
    margin-top: -54px;
}
.sg-product .ht-offer .ht-body .ht-item .ht-content ul.price li {
    font-size: 15px;
    color: #444444;
    font-weight: 600;
    margin-right: 0;
    letter-spacing: 0;
}
.sg-product .ht-offer .ht-body .ht-item .ht-content ul.price li:last-child {
    font-size: 14px;
    color: #969696;
    margin-left: 10px;
    font-weight: normal;
    text-decoration: line-through;
}

.sg-product .ht-offer .ht-body .ht-item .ht-content ul.price li {
    font-size: 15px;
    color: #444444;
    font-weight: 600;
    margin-right: 0;
    letter-spacing: 0;
}
.sg-product .ht-offer .ht-body .ht-item .ht-content ul.fav li {
    font-size: 13px;
    color: #fdba2d;
    margin-right: 0;
}
CSS,
    ];

    public function codes()
    {
        


        if (empty($this->_config['cards']))
            return Az::warning($this->_config['cards'], Az::l('Card data not gound'));

        /** @var Orders $card */
        foreach ($this->_config['cards'] as $card) {
            if ($card->image !== null)
                $card->image = $this->_config['image'];

            $this->htm .= strtr($this->_layout['main'], [
                '{title}' => $card->title,
                '{name}' => $card->name,
                '{image}' => $card->image,
                '{price}' => $card->price,
                '{sale}' => $card->sale,
                '{oldPrice}' => $card->price_old,
                '{days}' => $this->_config['days'],
                '{hrs}' => $this->_config['hrs'],
                '{mins}' => $this->_config['mins'],
                '{sec}' => $this->_config['sec'],
                '{star}' => $card->star,
            ]);
        }

        $this->css = strtr($this->_layout['css'], []);
    }

}

