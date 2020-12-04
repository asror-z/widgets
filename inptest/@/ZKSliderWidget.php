<?php

namespace zetsoft\widgets\inptest;

use kartik\slider\Slider;
use yii\web\JsExpression;
use zetsoft\actions\webs\apps\ZWebAction;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\inputes\ZKTreeInputWidget;

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */
class ZKSliderWidget extends ZWidget
{


    /**
     *
     * Configuration
     */
    public $config = [];
    public $_config = [
        'orientation' => self::orientation['horizontal']

    ];


    public $layout = [];
    public $_layout = [

    ];

    public $event = [];
    public $_event = [
        'slideStart' => ' console.log("ZKSliderWidget | slideStart") ',
        'slideStop' => ' console.log("ZKSliderWidget | slideStop") ',
        'slideEnabled' => ' console.log("ZKSliderWidget | slideEnabled") ',
        'slideDisabled' => ' console.log("ZKSliderWidget | slideDisabled") ',
        'slide' => ' console.log("ZKSliderWidget | slide") ',
    ];


    public const orientation = [
        'vertical' => 'vertical',
        'horizontal' => 'horizontal',
    ];


    public function codes()
    {
        $this->options = [
            'name' => $this->name,
            'model' => $this->model,
            'attribute' => $this->attribute,
            'value' => 7.427, // Slider will instantiate showing 7.43 due to specified precision
            'sliderColor' => Slider::TYPE_PRIMARY,
            'handleColor' => Slider::TYPE_PRIMARY,
            'pluginEvents' => [
                'slideStart' => $this->eventCode('slideStart'),
                'slide' => $this->eventCode('slide'),
                'slideStop' => $this->eventCode('slideStop'),
                'slideEnabled' => $this->eventCode('slideEnabled'),
                'slideDisabled' => $this->eventCode('slideDisabled'),
            ],
            'pluginOptions' => [
                'precision' => 2,
                'orientation' => $this->_config['orientation'],
                'handle' => 'square',
                'step' => 0.01,
                'reversed' => true,
                'tooltip' => 'always'
            ],
        ];

        $this->htm = Slider::widget($this->options);
    }


}
