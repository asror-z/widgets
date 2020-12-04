<?php

/*
 * Author: AzimjonToirov
 *  
 * */

namespace zetsoft\widgets\cards;


use yii\bootstrap\Html;
use zetsoft\dbitem\shop\ProductItem;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\navigat\ZButtonWidget;

class ZCartViewWidget extends Zwidget
{
    public $config = [];
    public $_config = [
        'url' => '',
        'text' => 'Корзина',
        'icon' => 'fas fa-shopping-cart grey-text',
        'amount' => 0,
        'hint' => 'Корзина',
        'iconSize' => '26px'
    ];

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
        <a href="{url}" data-pjax="0">
            <span class="hint--bottom" aria-label="{hint}">
                <i class="{icon} pr-2"></i>
                <span id="{id}" class="counter success-color {class}">{amount}</span>
                {text}
            </span>
        </a>&nbsp;
HTML,

        'css' => <<<CSS
    .viewWidgetClass .fa, .viewWidgetClass .far,.viewWidgetClass .fas {
        font-size: __iconSize__;
    }
    
    .nmfr .fa, .nmfr .far,.nmfr .fas {
        font-size: __iconSize__;
    }
CSS,
     

    ];

    public function codes()
    {
        $class = '';
        if ($this->_config['amount'] === 0)
             $class = 'd-none';

         //vdd($this->_config['amount']);

        $this->htm .= strtr($this->_layout['main'], [
            '{id}' => $this->id,
            '{url}' => $this->_config['url'],
            '{amount}' => $this->_config['amount'],
            '{text}' => $this->_config['text'],
            '{icon}' => $this->_config['icon'],
            '{class}' => $class,
            '{hint}' => $this->_config['hint'],
        ]);
        $this->css .= strtr($this->_layout['css'], [
            '__iconSize__' => $this->_config['iconSize']
        ]);

  

    }
}
