<?php


namespace zetsoft\widgets\inputes;

use zetsoft\system\kernels\ZWidget;
use kartik\checkbox\CheckboxX;
use yii\web\JsExpression;

/**
 * Class ZKCheckboxXWidget
 * @package widgets\inputes
 *
 * http://demos.krajee.com/checkbox-x
 *
 * Refactored: Zoxidjon Ergashev
 */
class ZKCheckboxXWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'isAutoLabel' => false,
        /*'pluginOption' => [
            'size' => 'sm',
            'iconChecked' => '<b>&check;</b>',
            'iconUnchecked' => '<b>X</b>',
        ],*/
        'labelsetting' => [
            'label' => 'Blue Small', 'options' => ['class' => 'text-info']
        ],
        'position' => CheckboxX::LABEL_RIGHT,
        'initInputType' => CheckboxX::INPUT_CHECKBOX,
        'isInline' => false,
        'size' => 'md',
        'isUseNative' => false,
        'theme' => '',
        'icon' => 'fa-users',
        'iconchecked' => 'fas fa-check',
        'iconunchecked' => '',
        'iconnull' => 'fas fa-times',

    ];

    public static $grapes = [
        'enable' => true,
        'icon' => '',
        'image' => '/render/inputes/ZKCheckboxXWidget/image/icon.png',
        'name' => Azl . 'Checkbox',
        'title' => Azl . '<b>safasfsa</b><img src="/render/inputes/ZKCheckboxXWidget/image/icon.png"/>',

    ];

    public $event = [];
    public $_event = [
        'change' => ' console.log("ZKCheckboxXWidget | EventChange") ',
        'reset' => ' console.log("ZKCheckboxXWidget | EventReset") ',
    ];

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
        <div class="form-control my-check border-0 d-flex {class}">
            {iconCode} &nbsp;&nbsp;&nbsp; {input} {place} 
</div>
HTML,

        'icon' => <<<HTML
        <i class="prefix icon-prefix {icon}"></i>
HTML,

        'place' => <<<HTML
        <div class="ml-3 mt-2">{placeholder}</div>
HTML,

       
    ];

    /**
     * @return string
     * @throws \Exception
     */
    public function codes()
    {
        $this->options = [
            'name' => $this->name,
            'model' => $this->model,
            //'attribute' => $this->attribute,
            'value' => $this->value,
            'bsVersion' => $this->bsVersion,
            'autoLabel' => $this->_config["isAutoLabel"],
            'initInputType' => $this->_config["initInputType"],
            'labelSettings' => [
                // 'label' => '',
                'position' => $this->_config['position'],
                'options' => []
            ],
            'disabled' => $this->_config['disabled'],
            'readonly' => $this->_config['readonly'],
            'options' => [
                'id' => $this->id,
                'class' => $this->_config['class'],

            ],
            'pluginLoading' => true,

            /**
             * Plugin Events
             * http://plugins.krajee.com/checkbox-x#events
             */

            'pluginEvents' => $this->eventsAll([
                'change' => 'change',
                'reset' => 'reset',
            ]),

            /**
             * Plugin Options
             * http://plugins.krajee.com/checkbox-x#options
             */
            'pluginOptions' => [
                'theme' => $this->_config["theme"],
                'threeState' => false,
                'allowThreeValOnInit' => false,
                'inline' => $this->_config["isInline"],
                'iconChecked' => "<i class='{$this->_config['iconchecked']}'/>",
                'iconUnchecked' => "<i class='{$this->_config["iconunchecked"]}'/>",
                'iconNull' => "<i class='{$this->_config["iconnull"]}'/>",
                'valueChecked' => '1',
                'valueUnchecked' => '0',
                'valueNull' => '',
                'size' => $this->_config["size"],
                'enclosedLabel' => false,
                'useNative' => $this->_config["isUseNative"],
                'tabindex' => 1000,
            ],
        ];


        $iconCode = '';
        if ($this->_config['hasIcon'])
            $iconCode = strtr($this->_layout['icon'], [
                '{icon}' => $this->_config['icon'],
            ]);


        $getPlace = '';
        if ($this->_config['hasPlace'])
            $getPlace = strtr($this->_layout['place'], [
                '{placeholder}' => $this->_config['placeholder'],
            ]);


        $input = CheckboxX::widget($this->options);

        $this->htm = strtr($this->_layout['main'], [
            '{iconCode}' => $iconCode,
            '{input}' => $input,
            '{place}' => $getPlace,
            '{class}' => $this->_config['class'],
            '{readonly}' => $this->_config['readonly'] ? 'readonly' : '',
        ]);


    }

}
