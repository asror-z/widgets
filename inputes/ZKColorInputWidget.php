<?php

/**
 *
 *
 * Author:  Asror Zakirov
 *
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */


namespace zetsoft\widgets\inputes;

use zetsoft\system\Az;
use zetsoft\system\kernels\ZWidget;
use kartik\widgets\ColorInput;
use yii\web\JsExpression;



/**
 * Class ZKColorInputWidget
 * @package widgets\inputes
 *
 * Refactored Bunyod yoqubjonov
 * 
 * http://demos.krajee.com/widget-details/colorinput
 */
class ZKColorInputWidget extends ZWidget
{

    public $config = [];
    public $_config = [
        'preferredName' => ZKColorInputWidget::name['name'],
        'value' => '#8a2f13',
        'isNative' => false,
        'inputSize' => ZKColorInputWidget::inputSize["lg"],
        'width' => '',
        'addonContent' => '',
        'disabled' => false,
        'readonly' => false,
        'isShowDefaultPalette' => true,
        'palette' => [['#000', '#444'],
            ['#000', '#444']],
        'selectionPallete' => ['#000', '#444'],
        'isShowPalette' => true,
        'isShowPaletteOnly' => false,
        'maxSelectionSize' => 1,
        'color' => 'yellow',
        'isFlat' => false,
        'isShowInput' => true,
        'isAllowEmpty' => false,
        'isShowAlpha' => true,
        'isPluginDisabled' => false,
        'isLocalStorageKey' => true,
        'isShowSelectionPalette' => true,
        'isShowInitial' => false,
        'isTogglePaletteOnly' => true,

    ];
    public static $grapes = [
        'enable' => true,
        'icon' => '',
        'image' => '/render/inputes/ZKColorInputWidget/image/icon.png',
        'name' => Azl . 'ColorInput',
        'title' => Azl . '<b>safasfsa</b>',

    ];

    public $event = [];
    public $_event = [
        'change' => ' console.log("ColorInput | $eventChange") ',
        'move' => '  console.log("ColorInput | $eventMove") ',
        'hide' => '  console.log("ColorInput | $eventHide") ',
        'show' => '  console.log("ColorInput | $eventShow")',
        'beforeshow' => '   console.log("ColorInput | $eventBeforeShow")',
        'dragstart' => '   console.log("ColorInput | $eventDragstart")',
        'dragstop' => '  console.log("ColorInput | $eventDragstop")'
    ];

    /**
     *
     * Constants
     */
    public const name = [
        'hex' => 'hex',
        'hex3' => 'hex3',
        'hsl' => 'hsl',
        'rgb' => 'rgb',
        'name' => 'name',
    ];

    public const inputSize = [
        'lg' => 'lg',
        'md' => 'md',
        'sm' => 'sm',
        'xs' => 'xs'
    ];


    
    private function addon($content)
    {

        if ($content) {
            $prepend['content'] = $content;
        }
        $prepend['asButton'] = true;

        return $prepend;

    }

    public function codes()
    {
        $this->options = [
            'name' => $this->name,
            'model' => $this->model,
            'attribute' => $this->attribute,
            'value' => $this->_config["value"],
            'width' => $this->_config["width"],
            'useNative' => $this->_config["isNative"],
            'bsVersion' => $this->bsVersion,

            'options' => [
                'placeholder' => Az::l('Choose your color ...'),
                'id' => $this->id,
                'class' => $this->_config['class'],

            ],

            'addon' => $this->addon($this->_config["addonContent"]),
            'showDefaultPalette' => $this->_config["isShowDefaultPalette"],
            'size' => $this->_config["inputSize"],
            'html5Options' => [],
            'disabled' => $this->_config["disabled"],
            'readonly' => $this->_config["readonly"],
            'html5Container' => [],
            'noSupport' => false,
            'noSupportOptions' => [],

            'pluginOptions' => [
                'color' => $this->_config["color"],
                'flat' => $this->_config["isFlat"],
                'showInput' => $this->_config["isShowInput"],
                'showInitial' => $this->_config["isShowInitial"],
                'allowEmpty' => $this->_config["isAllowEmpty"],
                'showAlpha' => $this->_config["isShowAlpha"],
                'disabled' => $this->_config["isPluginDisabled"],
                'localStorageKey' => $this->_config["isLocalStorageKey"],
                'showPalette' => $this->_config["isShowPalette"],
                'showPaletteOnly' => $this->_config["isShowPaletteOnly"],
                'togglePaletteOnly' => $this->_config["isTogglePaletteOnly"],
                'showSelectionPalette' => $this->_config["isShowSelectionPalette"],
                'clickoutFiresChange' => true,
                'cancelText' => Az::l('Cancel'),
                'chooseText' => Az::l('Choose'),
                'togglePaletteMoreText' => Az::l('more'),
                'togglePaletteLessText' => Az::l('less'),
                'containerClassName' => '',
                'replacerClassName' => '',
                'preferredFormat' => $this->_config["preferredName"],
                'maxSelectionSize' => $this->_config["maxSelectionSize"],//int
                'palette' => $this->_config["palette"],
                'selectionPalette' => $this->_config["selectionPallete"]
            ],

            

            'pluginEvents' => $this->eventsAll([
                'change' => 'change',
                'move' => 'move',
                'hide' => 'hide',
                'show' => 'show',
                'beforeShow' => 'beforeShow',
                'dragstart' => 'dragstart',
                'dragstop' => 'dragstop',
            ]),
        ];
      

        $this->htm = ColorInput::widget($this->options);

    }

}
