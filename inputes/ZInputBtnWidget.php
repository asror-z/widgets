<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * Date:    21.05.2019
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\inputes;

use zetsoft\system\assets\ZColor;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\former\ZMultiWidget;
use zetsoft\widgets\navigat\ZButtonWidget;

/**
 * Class ZInputWidget
 * @package widgets\inputes
 * https://www.yiiframework.com/doc/api/2.0/yii-helpers-basehtml#input()-detail
 * https://mdbootstrap.com/docs/jquery/forms/inputs/
 *
 * Clean Css By: Jasur Shukurov
 *
 */
class ZInputBtnWidget extends ZWidget
{

    public $config = [];
    public $_config = [
        'type' => ZInputWidget::type['text'],
        'grapes' => true,
        'class' => '',
        'isLabel' => false,
        'inputId' => 'text',
        'buttonText' => '',
        'classButton' => '',
    ];

    public $event = [];
    public $_event = [
        'buttonClick' => ' console.log("click") '
    ];

    public const type = [
        'button' => 'button',
        'color' => 'color',
        'date' => 'date',
        'datetime-local' => 'datetime-local',
        'email' => 'email',
        'file' => 'file',
        'hidden' => 'hidden',
        'image' => 'image',
        'month' => 'month',
        'number' => 'number',
        'password' => 'password',
        'radio' => 'radio',
        'range' => 'range',
        'reset' => 'reset',
        'search' => 'search',
        'submit' => 'submit',
        'tel' => 'tel',
        'text' => 'text',
        'time' => 'time',
        'url' => 'url',
        'week' => 'week',
        'checkbox' => 'checkbox',
    ];

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
    <div id="{idApp}" class="m-0 d-flex {class}">
        {geticon}
            
            <input 
                type="{type}" 
                id="{inputId}" 
                class="m-0 form-control"
                placeholder ="{placeholder}" 
                name="{name}" 
                value ="{value}"
                {readonly}>
                
            <div class="w-25"> 
                {button}
            </div>
                
                {range}
          
    </div>
HTML,

        'label' => <<<HTML
     <label for="{inputId}" class="ZInputWidget  grapesInput">{label}</label>
HTML,

        'range' => <<<HTML
        <p class="range-value">50</p>
HTML,

        'icon' => <<<HTML
        <i class="prefix icon-prefix {icon} mr-2"></i>
HTML,

        'css' => <<<CSS

CSS,
    ];

    public function codes()
    {

        $range = '';
        if ($this->_config['type'] === 'range')
            $range = $this->_layout['range'];
        $geticon = strtr($this->_layout['icon'], [
            '{icon}' => $this->_config['icon']
        ]);
        
        if ($this->_config['isLabel']) {
            $this->htm .= strtr($this->_layout['label'], [
                '{label}' => $this->_config['placeholder'],
                '{inputId}' => $this->id,
            ]);
        }

        $button = ZButtonWidget::widget([
            'config' => [
                'btn' => true,
                'btnType' => ZButtonWidget::btnType['button'],
                'btnStyle' => ZButtonWidget::btnStyle['btn-outline-dark'],
                'btnRounded' => false,
                'btnFloating' => false,
                'btnSize' => ZColor::btnSize['btn-micro'],
                'text' => $this->_config['buttonText'],
                'class' => 'my-0 px-4' . $this->_config['classButton'],
            ],
            'event' => [
                'click' => $this->eventCode('buttonClick'),

            ]
        ]);

        $this->htm .= strtr($this->_layout['main'], [
            '{name}' => $this->name,
            '{id}' => $this->id,
            '{inputId}' => $this->id,
            '{idApp}' => $this->idApp,
            '{label}' => $this->_config['placeholder'],
            '{value}' => $this->value,
            '{type}' => $this->_config['type'],
            '{class}' => $this->_config['class'],
            '{placeholder}' => $this->_config['placeholder'],
            '{geticon}' => $this->_config['hasIcon'] ? $geticon : null,
            '{range}' => $range,
            '{button}' => $button,
            '{readonly}' => $this->_config['readonly'] ? 'disabled' : '',
        ]);

        if ($this->_config['readonly'])
            $this->htm .= ZHHiddenInputWidget::widget([
                'model' => $this->model,
                'attribute' => $this->attribute
            ]);


        $this->js = <<<JS
        $('#{$this->id}').on('change', {$this->eventCode('change')})
JS;


    }
}

