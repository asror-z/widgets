<?php

namespace zetsoft\widgets\inputes;

use phpDocumentor\Reflection\Types\This;
use Yii;
use \kartik\range\RangeInput;
use zetsoft\system\kernels\ZWidget;

/**
 * Class ZKRangeInputWidget
 * @package widgets\inputes
 * http://demos.krajee.com/widget-details/rangeinput
 *
 * Refactored: Zoxidjon Ergashev
 */
class ZKRangeInputWidget extends ZWidget
{

    public $config = [];
    public $_config = [
        'value' => '',
        'size' => 'lg',
        'width' => '100%',
        'html5Option' => ['min' => 0, 'max' => 100],
        'min' => 0,
        'max' => 100,

    ];
    public static $grapes = [
        'enable' => true,
        'icon' => '',
        'image' => '/render/inputes/ZKRangeInputWidget/image/icon.png',
        'name' => Azl . 'RangeInput',
        'title' => Azl . '<b>safasfsa</b><img src="/render/inputes/ZKRangeInputWidget/image/icon.png"/>',

    ];

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
          <i class="{icon} prefix icon-prefix"></i>
HTML,
    ];

    public function codes()
    {

            $geticon = strtr($this->_layout['main'], [
                '{icon}' => $this->_config['icon'],
                
                '{readonly}' => $this->_config['readonly'] ? 'readonly' : '',
            ]);

        $this->options = [
            'name' => $this->name,
            'model' => $this->model,
            'attribute' => $this->attribute,
            'noSupport' => true,
            'size' => $this->_config['size'],
            'addon' => ['append' => ['content' => $this->_config['hasIcon'] ? $geticon : '']],
            'width' => $this->_config['width'],
            'value' => $this->value,
            'options' => [
                'id' => $this->id,
                'placeholder' => $this->_config['hasPlace'] ? $this->_config['placeholder'] : '',
                'class' => $this->_config['class'],
            ],
            'orientation' => 'horizontal',//vertical
            'html5Container' => [],
            'noSupportOptions' => [],
            'bsVersion' => $this->bsVersion,
            'html5Options' => ['min' => $this->_config['min'], 'max' => $this->_config['max']],
        ];


        $this->htm = RangeInput::widget($this->options);
    }

    private function addon($content)
    {

        if ($content) {
            return ['content' => $content];
        }

        return false;

    }

}
