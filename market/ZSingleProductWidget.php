<?php

/**
 *
 *
 * Author:  Shahzod Gulomqodirov
 *
 */

namespace zetsoft\widgets\market;


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
   <div class="sg-product">
       <div class="ht-offer">
            <div class="sec-title">
                <h1>{name}</h1>
            </div>
            <div class="ht-body">
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
   </div>
HTML,

    'star' => <<<HTML
       <li class="list-inline-item"><i class="fa fa-star"></i></li> 
HTML,

        <<<CSS

CSS,
    ];

    

    public function codes()
    {

        if (empty($this->_config['cards']))
            return Az::warning($this->_config['cards'], Az::l('Card data not gound'));

        /** @var Orders $card */
        foreach ($this->_config['cards'] as $card) {
            if ($card->photo !== null)
                $card->photo = $this->_config['image'];

            $this->htm .= strtr($this->_layout['main'], [
                '{title}' => $card->title,
                '{name}' => $card->name,
                '{image}' => $card->photo,
                '{price}' => $card->price,
                '{sale}' => $card->sale,
                '{oldPrice}' => $card->price_old,
                '{star}' => $card->star,

            ]);
        }

    }

}

