<?php

/**
 *
 *
 * Author:  Obidov Yasin
 *
 */

namespace zetsoft\widgets\cards;

use zetsoft\system\kernels\ZWidget;


class ZCatalogWidget extends ZWidget
{
    public $config = [];
    public $_config = [
        'product_image' => 'https://gcdn.utkonos.ru/resample/940x300q95/images/banner/2020/05/19/46657_234607.png',
        'product_name' => 'lorem ipsum',
    ];


    public $event = [];
    public $_event = [

    ];


    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
        {content}
<div class="row">
    <div class="col-12 mt-3">
    
        
        
    </div>
</div>
HTML,

        'mains' => <<<HTML
        <div class="card" style="width: 100%;">
            <img class="card-img-top"
                 src="{product_image}"
                 alt="Card image cap">
            <div class="p-2 text-center">
                <h5 class="card-text">{product_name} </h5>
            </div>
        </div>
HTML,


    ];


    public function codes()
    {
        /*
         *
         * 'yogurt' => 'https://milkalliance.com.ua/blog/images/articles/zakvaska7.jpg',
           'gosht' => 'https://milkalliance.com.ua/blog/images/articles/zakvaska7.jpg',
           'telefon' => 'https://milkalliance.com.ua/blog/images/articles/zakvaska7.jpg',
         *
         *
         * */
        $mains = '';
        foreach ($this->data as $productName => $url) {
            $mains .= strtr($this->_layout['mains'], [
                '{product_name}' => $productName,
                '{product_image}' => $url,
            ]);
        }

        $this->htm .= strtr($this->_layout['main'], [
            '{content}' => $mains
        ]);
    }
}
