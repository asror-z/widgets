<?php
namespace zetsoft\widgets\cards;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\inputes\ZKTouchSpinWidget;
use zetsoft\widgets\market\ZSVGWidget;


/**
 * Class    ZGridCardWidget
 * @package zetsoft\widgets\cards
 *  created by Mirshod Ibodov
 */
class ZTouchSpPriceWidget extends ZWidget
{
    public static $grapes = [
        'enable' => true,
        'icon' => '',
        'height' => '600px',
        'width' => '840px',
        'image' => '',
        'name' => Azl . 'Touchspin',
        'title' => Azl . '<b>touchspin</b>',
    ];

    public $config = [];
    public $_config = [
        'grapes'=>true,
        'price_old' => '18.900',
        'discount' => 'скидка:8000 UZS',
        'price' => '20.000',
        'quantity' => 'сум за 1 шт.',
    ];

    public $branch = [];
    public $_branch = [
        'widget' => [
            'grapes',
            'price_old',
            'discount',
            'price',
            'quantity',
        ],
    ];

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
           <div class="row">
    <div class="col-md-3 ml-2 mt-2">
        <a>
            <span class="price_old text-danger"><del class="fp-30">{price_old}</del></span>
            <span class="discount fp-20 text-danger ml-5">{discount}</span>
        </a>
        <br>
        <a>
            <span class="fp-35 text-success">{price}</span>
            <span class="fp-25 text-light">{quantity}</span>
        </a>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        <div class="d-flex">
           {touchspin}
              <div class="d-block ml-1 mt-1">
           {svg}
              </div>
        </div>


HTML,


        'js' => <<<JS
   
   
JS,
        'css' => <<<CSS
        
          

CSS,

    ];

    public function asset()
    {

    }

    public function codes()
    {
        $this->htm .= strtr($this->_layout['main'], [
            '{touchspin}' => ZKTouchSpinWidget::widget([
                'name' => $this->name,
                'model' => $this->model,
                'attribute' => $this->attribute,
                'config' => [
                    'min' => '0',
                    'max' => '10000',
                    'step' => '1',
                    'buttonup_txt' => '<i class="fa fa-plus fa-2x"></i>',
                    'buttondown_txt' => '<i class="fa fa-minus text-danger fa-2x"></i>',
                    'buttonup_class' => 'btn btn-outline-success btn-sm',
                    'buttondown_class' => 'btn btn-outline-danger btn-sm',
                    'class' => 'text-center touch-single'
                ],
            ]),
            '{svg}' => ZSVGWidget::widget([
                'config' => [
                    'type' => 'basket_delete'
                ]
            ]),
            '{price_old}' => $this->_config['price_old'],
            '{discount}' => $this->_config['discount'],
            '{price}' => $this->_config['price'],
            '{quantity}' => $this->_config['quantity'],

        ]);

    }
}
