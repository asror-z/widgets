<?php

namespace zetsoft\widgets\cards;

use zetsoft\dbitem\shop\CompanyCardItem;
use zetsoft\dbitem\shop\ProductItem;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\inputes\ZKStarRatingWidget;
use zetsoft\widgets\market\ZStarDobtcoWidget;

/**
 * https://www.figma.com/file/phwYNQp2ce9O6Kd9dMrReU/ProductCard?node-id=0%3A1
 *
 */
class ZMiniStoreWidget extends ZWidget
{
    public $config = [];
    public $_config = [
        'item'
    ];

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
        <div class="col-12 col-sm-12 col-lg-12 col-xl-12 mainContain">
            <div class="d-flex">
                <div class="d-block mr-3 text-center">
                    <div class="d-flex mt-xl-2">
                        <h2 class="pl-1 m-0 fp-20 font-weight-bolder">{logoname}</h2>
                    </div>
                    {staraiting}
                </div>

                <div class="d-block mr-3 text-center">
                    <img class="mt-1" height="40px" width="50px"
                     src="{logoimg}" alt="adidas logo">
                    <p class="fp-12">{reviews}</p>

                </div>
                <div>
                    <h5 class="text-success text-center mt-1">
                 
                        {currency_before}   
                        {price}
                        {currency_after}
                     </h5>
                    <p  class="text-center text-black-50 fp-14">
                        {count}
                    </p>
                </div>

            </div>
        </div>
HTML,

        'css' => <<<CSS
    .mainContain {
        height: 60px !important;
        width: 100% !important;
        margin-top: 5px;
    }
CSS,

    ];

    public function codes()
    {
        /*
         * 'logoname' => $value->name,
                'price' => $value->new_price,
                'currency' => $value->currency,
                'logoimg' => $value->image,


        'logoname' => 'Adidas',
        'price' => '1480.00',
        'reviews' => '(2 отзыва)',
        'count' => ' за 1шт',
        'currency' => '',
        'logoimg' => 'https://s3.amazonaws.com/stripgenerator/strip/36/54/95/00/00/full.png'
         */
        /** @var CompanyCardItem $item */
        $item = $this->_config['item'];

        $currency_before = '';
        $currency_after = '';
        if ($item->currencyType == ProductItem::currencyType['before'])
            $currency_before = $item->currency;
        if ($item->currencyType == ProductItem::currencyType['after'])
            $currency_after = $item->currency;

        $this->htm = strtr($this->_layout['main'], [
            '{staraiting}' => ZStarDobtcoWidget::widget([
                'data' => [1, 2, 3, 4, 5],
                'config' => [
                    'quantity' => 5,
                    'rating' => 3,
                    'icon' => 'fa fa-star',
                    'hasIcon' => true
                ]
            ]),
            '{logoname}' => $item->name,
            '{logoimg}' => $item->image ?? 'https://s3.amazonaws.com/stripgenerator/strip/36/54/95/00/00/full.png',
            '{price}' => number_format($item->new_price, 2, ',', ' '),
            '{reviews}' => $item->reviewCount,
            //'{count}' => $item->amount,
            '{count}' => ' за 1 ' . $item->measure,
            '{currency_before}' => $currency_before,
            '{currency_after}' => $currency_after,
        ]);

        $this->css = strtr($this->_layout['css'], [

        ]);
    }
}
