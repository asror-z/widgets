<?php

namespace zetsoft\widgets\inputes;

use zetsoft\system\kernels\ZWidget;
use kartik\time\TimePicker;
use yii\web\JsExpression;

/**
 * Class ZKTimePickerWidget
 * @package widgets\inputes
 * https://demos.krajee.com/widget-details/timepicker
 * Refactored: Doston Rakhmatov
 */
class ZKTimePickerWidget extends ZWidget
{

    public $config = [];
    public $_config = [
        'size' => ZKTimePickerWidget::size['md'],
        'containerOption' => [],
        'addonOption' => [
            'class' => 'btn btn-outline-primary waves-effect'
        ],
        'format' => 'm',
        'htm' => 'dropdown',
        'minuteStep' => 15,
        'secondStep' => 15,
        'defaultTime' => 15,
        'isShowSeconds' => true,
        'isShowMeridian' => false,
    ];



    /**
     *
     * Constants
     */
    public const size = [
        'lg' => 'lg',
        'md' => 'md',
        'sm' => 'sm',
        'xs' => 'xs'
    ];

    public $event = [];
    public $_event = [
        'show' => 'function (event) { console.log("ZKTimePickjer | $eventShow") }',
        'hide' => 'function (event) { console.log("ZKTimePickjer | $eventHide") }',
        'update' => 'function (event) { console.log("ZKTimePickjer | $eventUpdate") }',
    ];


    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
<div class="md-form" {readonly}></div>  
HTML
];

    public function codes()
    {

        $this->options = [
            'id' => $this->id,
            'value' => $this->value,
            'attribute' => $this->attribute,
            'model' => $this->model,
            'name' => $this->name,
            'bsVersion' => $this->bsVersion,
            'size' => $this->_config['size'],
            'addonOptions' => $this->_config['addonOption'],
            'containerOptions' => $this->_config['containerOption'],
            'disabled' => $this->_config['disabled'],
            'readonly' => $this->_config['readonly'],

            'options' => [
                'class'=>$this->_config['class'],
                'placeholder' =>$this->_config['hasPlace'] ? $this->_config['placeholder'] : '',
            ],
            
            'pluginOptions' => [
                'template' => $this->_config['htm'],
                'minuteStep' => $this->_config['minuteStep'],
                'secondStep' => $this->_config['secondStep'],
                'showSeconds' => $this->_config['isShowSeconds'],
                'showMeridian' => $this->_config['isShowMeridian'],
                'showInputs' => true,
                'disableFocus' => false,
                'disableMousewheel' => false,
                'modalBackdrop' => false,
            ],

            'pluginEvents' => $this->eventsAll([
                'show' => 'show',
                'hide' => 'hide',
                'update' => 'update',
            ])
        ];

        
        

    /*    $this->htm = <<<HTML
       <div class="md-form"  {readonly}>
HTML;
        $this->htm.= TimePicker::widget($this->options);
        
        $this->htm .= <<<HTML
            
          </div>
HTML;          */


        $this->htm = strtr($this->_layout['main'], [
            '{placeholder}' =>$this->_config['hasPlace'] ? $this->_config['placeholder'] : '',
            '{readonly}' => $this->_config['readonly'] ? 'readonly' : '',
        ]);

        $this->htm.= TimePicker::widget($this->options);



    }

}
