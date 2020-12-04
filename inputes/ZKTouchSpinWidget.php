<?php

namespace zetsoft\widgets\inputes;

use zetsoft\system\kernels\ZWidget;
use kartik\widgets\TouchSpin;
use yii\web\JsExpression;

/**
 * Class ZKTouchSpinWidget
 * http://demos.krajee.com/widget-details/touchspin
 *
 * Refactored: Doston Rakhmatov
 */
class ZKTouchSpinWidget extends ZWidget

    /*widgets/inputes/ZKTouchSpinWidget.php*/
{

    public $config = [];
    public $_config = [
        'id' => '',
        'readonly' => false,
        'multiple' => false,
        'min' => '0',
        'max' => 99999999999999999999999999999,
        'step' => '1',
        'initVal' => '',
        'label' => '',
        'forceStepDivisibility' => ZKTouchSpinWidget::visibility['floor'],
        'decimals' => '',/*2 = 99.00*/
        'prefix' => '',
        'isLabel' => false,
        'hintText' => '',
        'postfix' => '',
        'disabled' => false,
        'class' => '',
        'buttonup_txt' => '<i class="fal fa-plus"></i>',
        'buttondown_txt' => '<i class="fal fa-minus"></i>',
        'buttonup_class' => 'btn btn-sm btn-outline-default',
        'buttondown_class' => 'btn btn-sm btn-outline-default',


    ];
    public static $grapes = [
        'enable' => true,
        'icon' => 'fa fa-save',
        'image' => '/render/inputes/ZKTouchSpinWidget/image/icon.png',
        'name' => Azl . 'TouchSpin',
        'title' => Azl . '<b>safasfsa</b><img src="/render/inputes/ZKTouchSpinWidget/image/icon.png"/>',

    ];

    /**
     *
     * Constants
     */
    public const visibility = [
        'round' => 'round',
        'none' => 'none',
        'floor' => 'floor',
        'ceil' => 'ceil'
    ];

    /**
     * Plugin Evenst
     * https://www.virtuosoft.eu/code/bootstrap-touchspin/
     */

    public $event = [];
    public $_event = [
        'change' => ' console.log("ZKTouchSpinWidget | $eventChange")',
        'startspin' => ' console.log("ZKTouchSpinWidget | $eventStartspin")',
        'startupspin' => 'function() { 
        }',
        'startdownspin' => ' console.log("ZKTouchSpinWidget | $eventStartdownspin")',
        'stopspin' => ' console.log("ZKTouchSpinWidget | $eventStopspin")',
        'stopupspin' => ' console.log("ZKTouchSpinWidget | $eventStopupspin")',
        'stopdownspin' => ' console.log("ZKTouchSpinWidget | $eventStopdownspin")',
        'min' => ' console.log("ZKTouchSpinWidget | $eventMin")',
        'max' => ' console.log("ZKTouchSpinWidget | $eventMax")',
    ];


    public function codes()
    {

        $this->_layout = [
            'hint' => <<<HTML
            <label class="">{label}</label>
        <div class="hint {class} mt-n3" id="{id}">
            <p class="hint-text" readonly="readonly">{hintText}</p>
        </div>
HTML,
            'js' => <<<JS
            $('.touchCount').attr('id','touchCount-{id}');
JS,

        ];


        $this->options = [
            'model' => $this->model,
            'attribute' => $this->attribute,
            'name' => $this->name,
            'value' => $this->value,
            'bsVersion' => $this->bsVersion,
            'disabled' => $this->_config['readonly'],
            'readonly' => $this->_config['readonly'],
            'options' => [
                'id' => $this->id,
                'placeholder' => $this->_config['hasPlace'] ? $this->_config['placeholder'] : '',
                'class' => $this->_config['class'],
                'multiple' => $this->_config['multiple'],
            ],
            'pluginOptions' => [
                'initval' => $this->_config['initVal'],
                'min' => $this->_config['min'],
                'max' => $this->_config['max'],
                'step' => $this->_config['step'],
                'forcestepdivisibility' => $this->_config['forceStepDivisibility'],
                'decimals' => $this->_config['decimals'],
                'stepinterval' => 100,
                'stepintervaldelay' => 500,
                'verticalbuttons' => false,
                'verticalupclass' => 'glyphicon glyphicon-chevron-up',
                'verticaldownclass' => 'glyphicon glyphicon-chevron-down',
                'buttonup_txt' => $this->_config['buttonup_txt'],
                'buttondown_txt' => $this->_config['buttondown_txt'],

                'prefix' => $this->_config['prefix'],
                'postfix' => $this->_config['postfix'],
                'prefix_extrclasses' => '',
                'postfix_extrclasses' => '',
                'booster' => true, //If enabled, the the spinner is continually becoming faster as holding the button.
                'boostat' => '5', //Boost at every nth step.
                'maxboostedstep' => '10',
                'mousewheel' => true,
                'buttondown_class' => $this->_config['buttondown_class'],
                'buttonup_class' => $this->_config['buttonup_class']
            ],


            'pluginEvents' => $this->eventsAll([
                'change' => 'change',
                'touchspin.on.startspin' => 'startspin',
                'touchspin.on.startupspin' => 'startupspin',
                'touchspin.on.startdownspin' => 'startdownspin',
                'touchspin.on.stopspin' => 'stopspin',
                'touchspin.on.stopdownspin' => 'stopdownspin',
                'touchspin.on.min' => 'min',
                'touchspin.on.max' => 'max',

            ]),
        ];

        if ($this->_config['isLabel'])
            $this->htm = strtr($this->_layout['hint'], [
                '{id}' => $this->_config['id'] === -1 ? '' : $this->_config['id'],
                '{label}' => $this->_config['placeholder'],
                '{hintText}' => $this->_config['hintText'],
                '{class}' => $this->_config['class'],
            ]);


        $this->htm .= TouchSpin::widget($this->options);

        $this->js .= strtr($this->_layout['js'], [
            '{id}' => $this->_config['id'] === -1 ? '' : $this->_config['id'],
        ]);

        $this->css .= <<<CSS
        .bootstrap-touchspin {
            display: flex;
            align-items: center;
        }

        .hint-text {
            font-size: 14px;
            opacity: 0.5;
        }
        
          
CSS;


    }

}
